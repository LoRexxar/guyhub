<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
class Dis_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$auto_db = array(
				'test',
				'production'
		);
		$this -> load -> database($auto_db[0]);
	}
	public function discuss()
	{
		$sql = "SELECT * from hctf_discuss order by ask_time desc";
		$d = $this -> db -> query($sql);
		return $d -> result_array();
	}
	public function count()
	{
		return $this -> db -> count_all('discuss');
	}
	public function insert_dis($value)
	{
		$value['ask_time'] = date('m-d h:i:s',time());
		$sql = $this -> db -> insert_string('discuss', $value);
		$res = $this -> db -> query($sql);
		return $res;
	}
	public function detail()
	{
		$id = $this -> input -> get();
		if (! isset($id['id'])) {
			exit('Hacked by Hcamael~');
		}
		$db = $this -> db -> get_where('discuss', $id);
		$ques = $db -> result_array();
		if (empty($ques)) {
			exit('Hacked by Hcamael~');
		}
		else{
			$ques = $ques[0];
			$ques['head_img'] = '/static/head_img/default.gif';
		}
		$user['username'] = $ques['username'];
		$db2 = $this -> db -> get_where('user', $user);
		$info = $db2 -> result_array();
		if (! empty($info)) {
			$ques['head_img'] = $info[0]['head_img'];	
		}
		$c['tit_id'] = $id['id'];
		$db3 = $this -> db -> get_where('dis_anw', $c);
		$anw = $db3 -> result_array();
		foreach ($anw as $key => $value) {
			$anw[$key]['head_img'] = '/static/head_img/default.gif';
			$user['username'] = $value['username'];
			$db4 = $this -> db -> get_where('user', $user);
			$info = $db4 -> result_array();
			if (! empty($info)) {
				$anw[$key]['head_img'] = $info[0]['head_img'];	
			}
		}
		return ['ques' => $ques, 'anw' => $anw];
	}
	public function insert_anw($value)
	{
		$value['anw_time'] = date('m-d h:i:s',time());
		$sql = $this -> db -> insert_string('dis_anw', $value);
		$res = $this -> db -> query($sql);
		return $res;
	}
}
