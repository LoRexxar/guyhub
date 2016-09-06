<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
	class Find extends CI_controller
	{
		
		function __construct()
		{
			parent::__construct(); 
			$title='forget password';
			$data['title']=$title;
			$data['is_login'] = 0;
			$this->load->helper("url");
			$this->load->helper("form");
			$this->load->library('session');
			$this->load->helper("captcha");
			$this->load->library('form_validation');  
			$this->load->view('public/header',$data); 
		}

		public function index()
		{
			$this -> load -> library('form_validation'); 
			$this-> load -> library('captcha');
			$cap = $this -> captcha -> code();
			$this -> session -> set_userdata('capture', $cap['word']);  
			$this->load->view('Index/find1',$cap);
			$this->load->view('public/foot');
		}

		public function change()
		{
			//$this -> load -> library('form_validation');  

			$username=$this->input->post('username');
			$username = $this->security->xss_clean($username); 

			if(empty($username))
			{
				echo "<script>alert('Please input username')</script>";
				echo "<script>window.location.href='/Find/index'</script> ";
			}
			else
			{
				$this->load->model('Find_model');
				$res=$this->Find_model->get($username,0);
				if($res['username']===false && $res['question']===false)
				{
						echo "<script>alert('This username dose not exists')</script>" ;
						echo "<script>window.location.href='/Find/index'</script>" ;
				}
				else
				{
						$this-> load -> library('captcha');
						$cap = $this -> captcha -> code();
						$this -> session -> set_userdata('capture', $cap['word']); 
						$this -> session -> set_userdata('username',$res['username']);
						$this -> session -> set_userdata('question', $res['question']);
						$this->load->view('Index/find2',$cap);
				}
			}
			$this->load->view('public/foot');
		}

		public function done()
		{
			$answer = $this->input->post('answer');
			$answer = $this->security->xss_clean($answer); 

			$password = $this->input->post('password');
			$passwprd = $this->security->xss_clean($password); 
			$hash     = md5($password);
			
			$code = $this->input->post('code');
			$code = $this->security->xss_clean($code); 			
			
			if(empty($answer)||empty($password))
			{
				echo "<script>alert('Please input answer and password')</script>";
				echo "<script>windows.location.href='/Find/change'</script> ";
			}
			else
			{
				$username = $this->session->userdata('username');
				$this->load->model('Find_model');

				$res=$this->Find_model->get($username,1);
				
				if($res['result']['answer']===$answer&&$res['bool']==1)
				{
					$data=array('password' => $hash);
					$where=array('username'=> $username);
					$this->db->update("hctf_user",$data,$where);
					echo "<script>alert('Succeed')</script>";
					echo "<script>window.location.href=\"/WebIndex/login\"</script>";
				}
				else if($res['result']['answer']!==$answer)
				{						
						echo "<script>alert('Please input  right answer')</script>";
						$title="Forget Password";
						$data=array('title',$title);
						$this-> load -> view('public/header', $data);
						$this-> load -> library('captcha');
						$cap = $this -> captcha -> code();
						$this -> session -> set_userdata('capture', $cap['word']); 
						$this -> session -> set_userdata('username',$res['result']['username']);
						$this -> session -> set_userdata('question', $res['result']['question']);
						$this->load->view('Index/find2',$cap);
				}
				else if($res['bool']!=1)
				{
						$title = "Forget Password";
						$data=array('title' => $title);
						$this->load->view('public/header',$data);
						$this -> load -> library('form_validation'); 
						$this-> load -> library('captcha');
						$this-> load -> library('session');
						$cap = $this -> captcha -> code();
						$this -> session -> set_userdata('capture', $cap['word']);  
						$this->load->view('Index/find2',$cap);
						$this->load->view('public/foot');
				}
			}

		}
		
		public function vcode()
		{	
		
				if (strtolower($_SESSION['capture']) == strtolower(trim($this->input->post('code', TRUE)))) {
					return true;
				} else {
					$this->form_validation->set_message('vcode', 'error');
 
					return false;
				}
				
	    }

	}
?>
