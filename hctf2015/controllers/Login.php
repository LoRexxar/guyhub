<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
	class Login extends CI_controller
	{
		function __construct()
		{
            parent::__construct();  
			$this->load->helper("url");
			$this->load->helper("form");
			$this->load->library('session');
			$this->load->library('form_validation');  
		}

		public function check()
		{
			$username = $this->input->post('username', TRUE);
			$username = $this->security->xss_clean($username); 
			
			$password = $this->input->post('password', TRUE);
			$password = $this->security->xss_clean($password); 
			
			$hash     = md5($password);
			$code     = $this->input->post('code',TRUE);
			$code     = $this->security->xss_clean($code);

			if(empty($username)||empty($password))
			{
					echo "<script>alert('please input username and password')</script>";
					echo "<script>window.location.href=\"/WebIndex/login\"        </script>";
			}
			else
			{
				$this->load->model('Login_model');
				$data=$this->Login_model->lookfor($username);
				if($data['result']['password']===$hash && $data['bool']==1)
				{
					$this->session->set_userdata('username',$data['result']["username"]);
					
					$this->session->set_userdata('email', $data['result']['email']); 
					
					$this->session->set_userdata('id',$data['result']["id"]);
					
					$this->session->set_userdata('head_img',$data['result']['head_img']);
					
					$this->session->set_userdata('password',$data['result']["password"]);
					
					$last_time = date('y-m-d  h:i:s', time());
					
					$ip = $this->input->ip_address();
					
					$datt=array('last_time' => $last_time, 'last_ip'=>$ip);
					$where=array('username'=> $username);
					$this->db->update("hctf_user",$datt,$where);
					
					//date("m-d H:m:s",time());
					echo "<script>alert('succeed')</script>";
					echo "<script>window.location.href=\"/WebUser/index\"</script>";
				}
				else if($data['result']['password']!==$hash)
				{				
						echo "<script>alert('wrong username or password')</script>";						
						$this-> load -> library('captcha');
						$cap = $this -> captcha -> code();
						$title = 'Login';
						$data=array( 'title'=>$title  );
						$this -> session -> set_userdata('capture', $cap['word']);
						$this->load->view('public/header',$data);
						$this->load->view('Index/login',$cap);
						$this->load->view('public/foot');
				}
				else if($data['bool']!=1)
				{
						$this-> load -> library('captcha');
						$cap = $this -> captcha -> code();
						$title = 'Login';
						$data=array( 'title'=>$title  );
						$this -> session -> set_userdata('capture', $cap['word']);
						$this->load->view('public/header',$data);
						$this->load->view('Index/login',$cap);
						$this->load->view('public/foot');
				}
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
