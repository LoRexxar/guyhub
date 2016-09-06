<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
	class Advise extends CI_controller
	{
		function __construct()
		{
            parent::__construct();  
			$this->load->helper("url");
			$this->load->helper("form");
			$this->load->library('session');
			$this->load->library('form_validation');  
			if (($this -> session -> userdata('username')) != null)
			{
				$this -> is_login = 1;
				$this -> user['head_img'] = $_SESSION['head_img'];
				$this -> user['username'] = $_SESSION['username'];
				$this -> user['email'] = $_SESSION['email'];
			}
		}

		public function check()
		{
				$title=$this->input->post('title');
				$title=$this->security->xss_clean($title);
				
				$advise=$this->input->post('advise');
				$advise=$this->security->xss_clean($advise);
				
				$code=$this->input->post('code');
				$code=$this->security->xss_clean($code);
				
				$email=$this->session->userdata('email');
				$username=$this->session->userdata('username');
				
				$this->load->model('Advise_model');
				$bool=$this->Advise_model->check();
				
				if($bool==1)
				{
							$time = date('y-m-d  h:i:s', time());
							$data = array(
							'username' => $username,
							'title' => $title,
							'email'    => $email,
							'content' => $advise,
							'advise_time'   => $time
							);
							$this->db->insert('hctf_advise',$data);
							$this->db->insert_id();
							echo "<script>alert('commit succeed')</script>";
							echo "<script>window.history.go(-2)</script>";
				}
				else
				{
							$cap = $this -> captcha -> code();
							$this -> session -> set_userdata('capture', $cap['word']);
							$data = array(
							'title' => 'Advise',
							//'is_login' => $this -> is_login,
							'user_info' => $this -> user
							);
							$this->load->view('public/header',$data);
							$this->load->view('Index/advise',$cap);
							$this->load->view('public/foot');
				}
				
		}
		

		public function vcode()
		{	
		
				if ($_SESSION['capture'] == strtolower(trim($this->input->post('code', TRUE)))) {
					return true;
				} else {
					$this->form_validation->set_message('vcode', 'error');
 
					return false;
				}
				
	    }
	}
?>
