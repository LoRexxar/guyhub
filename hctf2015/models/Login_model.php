<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
	class Login_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			$auto_db=$this->load->database('test');
		}
		public function lookfor($username)
		{
			$this->form_validation->set_rules('username', 'Username', 'required');
            
            
            $this->form_validation->set_rules('password', 'Password', 'required');

            $bool=$this->form_validation->run();
			$sql="select *  from hctf_user where username=?";
			$re = $this->db->query($sql,$username);
			$res = $re -> result_array();
			$false['password']=0;
			if(isset($res[0]))
					$data = array('result'=>$res[0] ,'bool'=>$bool );
			else
					$data = array('result'=>$false , 'bool'=>$bool);
			//$data=array('password'=> $res['password'] ,'bool'=>$bool);
			return $data;
		}
	}
?>

