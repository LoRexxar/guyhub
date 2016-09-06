<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
    class Reg_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $auto_db=$this->load->database('test');
        }
        public function check($username,$email)
        {
            $this->load->helper("url");
            
            $this->load->helper("form");
            
            $this->load->library('session');
            
            $this->load->library('form_validation');    //加载表单
            
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[2]|max_length[12]');
            
            //制定规则
            $this->form_validation->set_rules('code', 'Captcha', 'trim|required|callback_vcode');

            $this->form_validation->set_rules('password', 'Password', 'required|matches[vpassword]|min_length[5]|max_length[15]');
            
            $this->form_validation->set_rules('vpassword', 'Verify Password', 'required');
            
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
            $this->form_validation->set_rules('question', 'Question', 'required');

            $this->form_validation->set_rules('answer', 'Answer', 'required');

            
            $res = $this->form_validation->run();

            $sql1="select * from hctf_user where username = ?";
            $re1=$this->db->query($sql1,$username);
            $num1=$re1->num_rows();
            
            $sql2="select * from hctf_user where email = ?";
            $re2=$this->db->query($sql2,$email);
            $num2=$re2->num_rows();
            $dbre=array('num1' =>$num1 ,'num2' =>$num2 ,'res'=>$res);
            return $dbre;
        }
    }

?>
