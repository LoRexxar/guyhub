<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
 class Find_model extends CI_Model
 {
 	function __construct()
 	{
 		parent::__construct();
        $auto_db=$this->load->database('test');
      
        $this->load->helper("url");
            
        $this->load->helper("form");
            
        $this->load->library('session');
            
        $this->load->helper("captcha");
            
        $this->load->library('form_validation');    
 	}

 	public function get($username,$open)
 	{
 		if($open==1)
 		{  
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]');

            $this->form_validation->set_rules('answer', 'Answer', 'required');
            
            $this->form_validation->set_rules('code', 'Code', 'trim|required|callback_vcode');

            $bool=$this->form_validation->run();

            $sql="select * from hctf_user where username=?";

 			$re=$this->db->query($sql,$username);
 			$res=$re->result_array();
 			$false=array('answer'=>' ' );
 			if(isset($res[0]))
					$data = array('result'=>$res[0] ,'bool'=>$bool);
			else
					$data = array('result'=>$false, 'bool'=>$bool);
 			return $data;
 		}
 		else
 		{
 			$sql="select * from hctf_user where username=?";
 			$re=$this->db->query($sql,$username);
 			$res=$re->result_array();
 			$false = array('username'=> false,  'question' => false);
 			if(isset($res[0]))
				return $res[0];
			else
				return $false;
 		}
 	}
 	
 	
 }

?>
