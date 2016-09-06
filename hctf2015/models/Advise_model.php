<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
    class Advise_model extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $auto_db=$this->load->database('test');
        }
        public function check()
        {
            $this->load->helper("url");
            
            $this->load->helper("form");
            
            $this->load->library('session');
            
            $this->load->library('form_validation');    //加载表单
            
            //制定规则
            $this->form_validation->set_rules('code', 'Captcha', 'trim|required|callback_vcode');

            $this->form_validation->set_rules('advise', 'Advise', 'required|min_length[5]|max_length[150]');
            
            $this->form_validation->set_rules('title', 'Title', 'required');
            
            $bool = $this->form_validation->run();
            
            return $bool;
        }
    }

?>
