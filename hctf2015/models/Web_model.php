<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
class Web_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this -> load -> database('test');
	}
	public function get_public_project()
	{
		$info = $this -> db -> get_where('project', ['public' => 1]);
		return $info -> result_array();
	}
	public function get_user_info()
	{
		$user['username'] = $_SESSION['username'];
		$info = $this -> db -> get_where('user', $user);
		return $info -> result_array()[0];
	}
	public function insert_pro($value='')
	{
		$status = array(
			'code' => false,
			'msg' => '新建失败',
			);
		$value['build_time'] = date('m-d h:i:s',time());
		$value['praise'] = 0;
		$value['creater_id'] = $_SESSION['id'];
		$salt = $value['project_name'] . $_SESSION['id'];
		$value['code_addr'] = "../views/static/code/" . md5($salt);
		mkdir($value['code_addr']);
		$info = $this -> db -> get_where('project', ['creater_id' => $value['creater_id'], 'project_name' => $value['project_name']]);
		if (count($info->result_array()) > 0) {
			$status['msg'] = '工程名已存在！';
			
		}
		else{
			$sql = $this -> db -> insert_string('project', $value);
			$info = $this -> db -> query($sql);
			$status['code'] = $info;
		}
		return $status;
	}
	public function get_detail($value='')
	{
		$return = array('is_create' => 1);
		$get = $this -> input -> get();
		if (! isset($get['name']) || $get['name'] == '') {
			exit('Hacked by Hcamael~');
		}
		$w = ['project_name' => $get['name']];
		$info = $this -> db -> get_where('project', $w);
		$r = $info -> result_array();
		if (count($r) != 1) {
			exit('Hacked by Hcamael~');
		}
		$r = $r[0];
		$w = ['id' => $r['creater_id']];
		if ($_SESSION['id'] != $w['id']) {
			$return['is_create'] = 0;
		}
		$in = $this -> db -> get_where('user', $w);
		$r['creater_name'] = $in -> result_array()[0]['username'];
		$w = ['project_id' => $r['id']];
		if ($r['public'] == 1) {
			$info2 = $this -> db -> get_where('project_foc', $w);
			$info3 = $this -> db -> get_where('project_com', $w);
			$r2['foc'] = $info2 -> result_array();
			$r3['com'] = $info3 -> result_array();
		}
		$info4 = $this -> db -> get_where('project_sha', $w);
		$r4['sha'] = $info4 -> result_array();
		if (count($r4['sha']) > 0) {
			foreach ($r4['sha'] as $key => $value) {
				$i = $this -> db -> get_where('user', ['username' => $value['username']]) -> result_array()[0];
				$r4['sha'][$key]['email'] = $i['email'];
				$r4['sha'][$key]['head_img'] = $i['head_img']; 
			}
		}
		
		$return = array_merge($return, $r, $r2, $r3,  $r4);
		return $return;

	}
	public function get_pro()
	{
		$id['creater_id'] = $_SESSION['id'];
		$info  = $this -> db -> get_where('project', $id);
		$return = $info -> result_array();
		$i2 = $this -> db -> get_where('project_sha', ['username' => $_SESSION['username']]);
		$p = $i2 -> result_array();
		foreach ($p as $key => $value) {
			$i3 = $this -> db -> get_where('project', ['id' => $value['project_id']]);
			$return = array_merge($return, $i3 -> result_array());
		}
		foreach ($return as $key => $value) {
			$sql1 = "select count(*) AS c from hctf_project_com where project_id = ". $value['id'];
			$sql2 = "select count(*) AS c from hctf_project_foc where project_id = ".$value['id'];
			$inf1 = $this -> db -> query($sql1);
			$inf2 = $this -> db -> query($sql2);
			$return[$key]['com_count'] = $inf1 -> result_array()[0]['c'];
			$return[$key]['foc_count'] = $inf2 -> result_array()[0]['c'];
		}
		return $return;
	}
	public function up_head($value)
	{
		$sql = "update hctf_user set head_img = '".$value."' where username='".$_SESSION['username']."'";
		$info = $this -> db -> query($sql);
		return $info;
	}
	public function up_user_info($value)
	{
		if(isset($value['password'])){
			$value['password'] = md5($value['password']);
		}
		$sql = $this -> db -> update_string('user', $value, ['username' => $_SESSION['username']]);
		$info = $this -> db -> query($sql);
		return $info;
	}
	public function insert_mail($value)
	{
		$i = $this -> db -> get_where('user', ['email' => $value['des']]);
		$f = $i -> result_array();
		if (count($f) == 1) {
			$sql = $this -> db -> insert_string('mail', $value);
			$info = $this -> db -> query($sql);
			return [$info, ''];
		}
		else{
			return [0, '收件方不存在！'];
		}
	}
	public function insert_sha()
	{
		$post = $this -> input -> post();
		$w = array(
			'creater_id' => $_SESSION['id'],
			'project_name' => $post['project_name']
			);
		$info = $this -> db -> get_where('project', $w);
		$c = $info -> result_array();
		if (count($c) != 1) {
			echo "Hacked by Hcamael!";
			return;
		}
		$info = $this -> db -> get_where('user', ['email' => $post['email']]);
		$e = $info -> result_array();
		if (count($e) != 1) {
			echo "该邮箱不存在！";
			return;
		}
		$w = array(
			'username' => $e[0]['username'] ,
			'project_id' => $c[0]['id'],
			'power' => 2
			);
		$sql = $this -> db -> insert_string('project_sha', $w);
		$r = $this -> db -> query($sql);
		return $r;
	}
	public function id_get_project()
	{
		$get = $this -> input -> get();
		$info = $this -> db -> get_where('project', $get);
		return $info->result_array()[0];
	}
	public function is_my_project($value)
	{
		$value['creater_id'] = $_SESSION['id'];
		$inf = $this -> db -> get_where('project', $value);
		$p = $inf -> result_array();
		if (count($p) == 1) {
			return $p[0];
		}
		$w = array(
			'username' => $_SESSION['username'],
			'project_id' => $value['id'],
			'power' => 2
			);
		$inf2 = $this -> db -> get_where('project_sha', $w);
		$p2 = $inf2 ->result_array();
		if (count($p2) == 1) {
			$inf3 = $this -> db -> get_where('project', ['id' => $value['id']]);
			$p3 = $inf3 -> result_array();
			return $p3[0];
		}
		return false;
	}
	public function get_mail()
	{
		$data = array(
			'receive' => array(),
			'send' => array()
		);
		$info1 = $this -> db -> get_where('mail', ['sour' => $_SESSION['email']]);
		$info2 = $this -> db -> get_where('mail', ['des' => $_SESSION['email'], 'status' => 0 ]);
		$info3 = $this -> db -> get_where('mail', ['des' => $_SESSION['email'], 'status' => 1 ]);
		$r = $info1 -> result_array();
		$as = $info2 -> result_array();
		$s = $info3 -> result_array();
		$data['receive']['read'] = $as;
		$data['receive']['noread'] = $s;
		$data['send'] = $r;
		return $data;
	}
	public function get_mail_detail($value)
	{
		if (is_array($value)) {
			$info = $this -> db -> get_where('mail', $value);
			$res = $info -> result_array();
			if (count($res) == 1 && ($_SESSION['email'] == $res[0]['sour'] || $_SESSION['email'] == $res[0]['des'] )) {
				if ($_SESSION['email'] == $res[0]['des'] && $res[0]['status'] == 1) {
					$sql = "update hctf_mail set status = 0 where id = " . $value['id'];
					$this -> db -> query($sql);
				}
				return $res[0];
			}
			exit('Hacked by Hcamael~');
		}
	}
	public function getpro($id)
	{
		if (is_array($id)) {
			$info = $this -> db -> get_where('project', $id);
		}
		else{
			$info = $this -> db -> get_where('project', ['id' => $id]);
		}
		return $info -> result_array();
	}
}
