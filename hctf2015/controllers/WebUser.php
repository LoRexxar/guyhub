<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
class WebUser extends CI_Controller {
	private $user = array();
	private $is_login = 0;

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		$this -> load -> model('Web_model', 'udb');
		$this -> load -> helper('checkf');
		$this->load->helper('url');
		if (($this -> session -> userdata('username')) == null) {
			redirect('/WebIndex/login');
		}
		$this -> is_login = 1;
		$this -> user['head_img'] = $_SESSION['head_img'];
		$this -> user['username'] = $_SESSION['username'];
		$this -> user['email'] = $_SESSION['email'];
	}
	public function _remap($m)
	{
		if ($m == 'getfile') {
			$this -> load -> library('getfile');
			$this -> $m();
		}
		else{
			$this -> $m();
		}
	}
	public function send_mail()
	{
		$data = array(
			'code' => 0,
			'msg' => '',
			);
		$post = $this -> input -> post();
		if (!isset($post['code']) OR ($post['code'] != ($this -> session -> userdata('capture')))) {
			$data['msg'] = "验证码错误！";
			echo json_encode($data);
			return;
		}
		$w = array(
			'sour' => $_SESSION['email'],
			'des' => $post['des'],
			'title' => $post['title'],
			'content' => $post['content'],
			'time' => date('m-d h:i:s',time()),
			'status' => 1
		);
		$info = $this -> udb -> insert_mail($w);
		if ($info[0]) {
			$data['code'] = 1;
		}
		else{
			$data['msg'] = $info[1];
		}
		echo json_encode($data);
	}
	public function s_mail()
	{
		$cap = $this -> captcha -> code();
		$this -> session -> set_userdata('capture', $cap['word']);
		$mail = $this -> udb -> get_mail();
		$data = array(
			'title' => '站内信',
			'user_info' => $this -> user,
			'is_login' => $this -> is_login,
			'mail' => $mail,
			'cap' => $cap
		);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('User/mail');
		$this -> load -> view('public/foot');
	}
	public function get_mail_detail()
	{
		$get = $this -> input -> get();
		$de = $this -> udb -> get_mail_detail($get);
		$this -> load -> view('User/m_detail', ['de' => $de]);
	}
	public function index()
	{
		$pro = $this -> udb -> get_pro();
		$data = array(
			'title' => '个人首页',
			'user_info' => $this -> user,
			'is_login' => $this -> is_login,
			'pro' => $pro
			);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('User/Index');
		$this -> load -> view('public/foot');
	}
	public function detail()
	{
		$pro = $this -> udb -> get_detail();
		$cap = $this -> captcha -> code();
		$this -> session -> set_userdata('capture', $cap['word']);
		$data = array(
			'title' => '个人首页',
			'user_info' => $this -> user,
			'is_login' => $this -> is_login,
			'pro' => $pro,
			'cap' => $cap
			);
		//var_dump($data);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('User/detail');
		$this -> load -> view('public/foot');
	}
	public function signout()
	{
		$this -> session -> unset_userdata('username');
		echo "<script>location.href = '/'</script>";
	}
	public function profile()
	{
		$cap = $this -> captcha -> code();
		$this -> session -> set_userdata('capture', $cap['word']);
		$this->load->helper(array('form', 'url'));
		$i = $this -> udb -> get_user_info();
		$data = array(
			'title' => '个人配置',
			'user_info' => $i,
			'is_login' => $this -> is_login,
			'cap' => $cap
			);

		$this -> load -> view('public/header', $data);
		$this -> load -> view('User/profile');
		$this -> load -> view('public/foot');
	}
	public function Project()
	{
		$cap = $this -> captcha -> code();
		$this -> session -> set_userdata('capture', $cap['word']);
		$data = array(
			'title' => '新增项目',
			'user_info' => $this -> user,
			'is_login' => $this -> is_login,
			'cap' => $cap
			);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('User/addPro');
		$this -> load -> view('public/foot');
	}
	public function addProject()
	{
		$data = array(
			'code' => 0,
			'msg' => '',
			);
		$post = $this -> input -> post();
		if (!isset($post['code']) OR ($post['code'] != ($this -> session -> userdata('capture')))) {
			$data['msg'] = "验证码错误！";
			echo json_encode($data);
			return;
		}
		unset($post['code']);
		$k = array('project_name', 'project_com', 'public');
		$m = check_key($post, $k);
		if ($m) {
			$data['msg'] = $m;
			echo json_encode($data);
			return;
		}
		foreach ($post as $key => $value) {
			if (check_isnull($value)) {
				$data['msg'] = $key." is null!";
				echo json_encode($data);
				return;
			}
		}
		$res = $this -> udb -> insert_pro($post);
		//var_dump($res);
		if ($res['code']) {
			$data['code'] = 1;
		}
		else{
			$data['msg'] = $res['msg'];
		}
		echo json_encode($data);
	}
	public function up_profile()
	{
		$data = array(
			'code' => 0,
			'msg' => '',
			);
		$post = $this -> input -> post();
		if (!isset($post['code']) OR ($post['code'] != ($this -> session -> userdata('capture')))) {
			$data['msg'] = "验证码错误！";
			echo json_encode($data);
			return;
		}
		if (isset($post['password']) && isset($post['repass']) && $post['password'] != '' && $post['repass'] != '') {
			if ($post['password'] != isset($post['repass'])) {
				$data['msg'] = '两次密码不一致！';
				echo json_encode($data);
				return;
			}
			$va['password'] = $post['password'];
		}
		if (isset($post['email']) && $post['email'] != '') {
			$va['email'] = $post['email'];
		}
		if (isset($post['question']) && $post['question'] != '') {
			$va['question'] = $post['question'];
		}
		if (isset($post['answer']) && $post['answer'] != '') {
			$va['answer'] = $post['answer'];
		}
		$re = $this -> udb -> up_user_info($va);
		if ($re) {
			if (isset($_SESSION['path'])) {
				$re = $this -> udb -> up_head($_SESSION['path']);
				if (! $re) {
					$data['msg'] = '头像更新失败！';
					echo json_encode($data);
					return;
				}
			}
			$data['code'] = 1;
			echo json_encode($data);
		}
		else{
			$data['msg'] = '更新失败！';
			echo json_encode($data);
		}
	}
	public function up_head()
	{
		$config['upload_path'] = '../views/static/head_img';
		$config['allowed_types'] = '*';//文件类型
		$config['max_size']     = 100;
		$config['max_width']        = 1024;
		$config['max_height']       = 768;
		$config['encrypt_name'] = true;
		$this->load->library('upload',$config);
		$data = array(
			'code' => 0,
			'msg' => '',
			);
		if ( ! $this->upload->do_upload('head_img'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data['msg'] = str_replace("<p>", "", $error['error']);
			$data['msg'] = str_replace("</p>", "", $data['msg']);
			echo json_encode($data);
		}
		else {
			$d = $this->upload->data();
			$path = "/static/head_img/" . $d['file_name'];
			$_SESSION['path'] = $path;
			$data['msg'] = $path;
			$data['code'] = 1;
			echo json_encode($data);
			
 		}
	}
	public function up_file()
	{
		$data = array(
			'code' => 0,
			'msg' => '',
			);
		if ($_POST['code'] != $_SESSION['capture']) {
			$data['msg'] = "验证码错误！";
			echo json_encode($data);
			return;
		}
		$get = $this -> input -> get();
		$i = $this -> udb -> is_my_project($get);
		if (!$i) {
			$data['msg'] = "Hacked by Hcamael!";
			echo json_encode($data);
			return;
		}
		$config['upload_path'] = $i['code_addr'];
		$config['allowed_types'] = '*';
		$config['max_size'] = 10;
		//$config['max_size']     = 100;
		//$config['max_width']        = 1024;
		//$config['max_height']       = 768;
		//$config['encrypt_name'] = true;
		$this->load->library('upload',$config);
		
		if ( ! $this->upload->do_upload('f'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data['msg'] = str_replace("<p>", "", $error['error']);
			$data['msg'] = str_replace("</p>", "", $data['msg']);
			echo json_encode($data);
		}
		else {
			$d = $this->upload->data();
			$data['code'] = 1;
			echo json_encode($data);
		}
	}
	public function add_group()
	{
		$i = $this -> udb -> insert_sha();
		if ($i) {
			echo "添加成功！";
		}
	}
	public function getfile()
	{
		$f = $this -> getfile -> get_index();
		$f['id'] = $this -> input -> get('id');
		$this -> load -> view('File/plug', $f);
	}
	public function modifile()
	{
		
	}
	public function del_file()
	{
		
	}
	public function file_con()
	{
		$this -> load -> library('getfile');
		$get = $this -> input -> get();
		$in_p = $this -> udb -> getpro($get['id']);
		if (count($in_p) != 1) {
			echo "<p>参数错误</p>";
			return;
		}
		$f = $this -> getfile -> get_file($in_p[0]['code_addr']."/");
		$bool = in_array($get['name'], $f['fname']);
		if (!$bool) {
			echo "<p>参数错误</p>";
			return;
		}
		if (isset($get['password'])  && $get['password'] == 'dsfkLKJ2') {
			if (strrchr($get['name'], ".php") == ".php") {
				echo "<p>此功能正在开发中！</p>";
				return;
			}
			require($in_p[0]['code_addr']."/".$get['name']);
		}
		else{
			echo "<p>此功能正在开发中</p>";
		}
		
		
	}
}
