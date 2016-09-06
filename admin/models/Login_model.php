<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');

	class Login_model extends CI_model
	{
			function __construct()
			{
				parent::__construct();
				$auto_db=$this->load->database('test');
			}
			
			public function check()
			{
					$this->form_validation->set_rules('admin', 'Admin', 'required');
            
					$this->form_validation->set_rules('code', 'Captcha', 'trim|required|callback_vcode');
            
					$this->form_validation->set_rules('password', 'Password', 'required');
					
					$bool=$this->form_validation->run();
					
					$sql = "select * from hctf_user where username = 'admin'";
					$re  = $this->db->query($sql);
					$res=$re->result_array();
					$data=array('result'=>$res[0],'bool'=>$bool);
					return $data; 
			}
	}

?>
