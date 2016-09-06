<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');

class WebDiscuss extends CI_Controller {
	private $user = array();
	private $is_login = 0;
	
	public function __construct()
	{
		parent::__construct();
		$this -> load -> model('Dis_model', 'dis');
		$this -> load -> helper('checkf');
		if (($this -> session -> userdata('username')) != null) {
			$this -> is_login = 1;
			$this -> user['head_img'] = $_SESSION['head_img'];
			$this -> user['username'] = $_SESSION['username'];
			$this -> user['email'] = $_SESSION['email'];
		}
	}
	public function discuss()
	{
		$db = $this -> dis -> discuss();
		foreach ($db as $key => $value) {
			$db[$key]['url'] = 'detail?id=' . $value['id'];
		}
		$data = array(
			'title' => 'Discuss',
			'db' => $db,
			'is_login' => $this -> is_login,
			'user_info' => $this -> user
			);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('Discuss/Index');
		$this -> load -> view('public/foot');
	}
	public function ask()
	{
		$cap = $this -> captcha -> code();
		$this -> session -> set_userdata('capture', $cap['word']);
		$data = array(
			'title' => '提问',
			'cap' => $cap,
			'is_login' => $this -> is_login,
			'user_info' => $this -> user
			);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('Discuss/Ask');
		$this -> load -> view('public/foot');
	}
	public function detail()
	{
		$inf = $this -> dis -> detail();
		$cap = $this -> captcha -> code();
		$this -> session -> set_userdata('capture', $cap['word']);
		$data = array(
			'title' => '提问详情',
			'ques' => $inf['ques'],
			'cap' => $cap,
			'anw' => $inf['anw'],
			'is_login' => $this -> is_login,
			'user_info' => $this -> user
		);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('Discuss/detail');
		$this -> load -> view('public/foot');
	}
	public function anwsub()
	{		
		$post = $this -> input -> post();
		$return = array(
			'status' => 1,
			'msg' => '' 
		);
		$post['code'] = strtolower($post['code']);
		if ($post['code'] != ($this -> session -> userdata('capture'))) {
			$return['msg'] = "验证码错误！";
			echo json_encode($return);
			return;
		}
		unset($post['code']);
		$k = array('tit_id', 'username', 'email', 'content');
		$m = check_key($post, $k);
		if ($m) {
			$return['msg'] = $m;
			echo json_encode($return);
			return;
		}
		foreach ($post as $key => $value) {
			if (check_isnull($value)) {
				$return['msg'] = $key." is null!";
				echo json_encode($return);
				return;
			}
		}
		if ($this -> dis -> insert_anw($post)) {
			$return['status'] = 0;
			echo json_encode($return);
		}
		else{
			$return['msg'] = 'Fail!';
			echo json_encode($return);
		}
	}
	public function asksub()
	{
		$post = $this -> input -> post();
		$return = array(
			'status' => 1,
			'msg' => '' 
		);
		if ((strtolower($this -> session -> userdata('capture'))) != (strtolower($post['code']))) {
			$return['msg'] = "验证码错误！";
			echo json_encode($return);
			return;
		}
		unset($post['code']);
		$k = array('title', 'username', 'email', 'content');
		$m = check_key($post, $k);
		if ($m) {
			$return['msg'] = $m;
			echo json_encode($return);
			return;
		}
		foreach ($post as $key => $value) {
			if (check_isnull($value)) {
				$return['msg'] = $key." is null!";
				echo json_encode($return);
				return;
			}
		}
		if ($this -> dis -> insert_dis($post)) {
			$return['status'] = 0;
			echo json_encode($return);
		}
		else{
			$return['msg'] = 'Fail!';
			echo json_encode($return);
		}
	}
}
