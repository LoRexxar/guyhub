<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');
	class Register extends CI_controller
	{


		public function check()
		{
			$this->load->helper("url");
			$this->load->helper("form");
			$this->load->library('session');
			$this->load->library('form_validation');  

			$username = $this->input->post('username', TRUE);
			$username = $this->security->xss_clean($username);    //XSS Clean
			
			$password = $this->input->post('password', TRUE);
			$password = $this->security->xss_clean($password);    //XSS Clean

			$hash     = md5($password);
			
			$email    = $this->input->post('email', TRUE);
			$email    = $this->security->xss_clean($email);       //XSS Clean
			
			$question = $this->input->post('question', TRUE);
			$question = $this->security->xss_clean($question);      //XSS Clean

			$answer   = $this->input->post('answer', TRUE);
			$answer   = $this->security->xss_clean($answer);
			
/*			if(empty($username)||empty($email))
			{
					echo "<script>alert('Please input username and email')</script>";
					$title='Register';				
					$data=array( 'title'=>$title  );
					$this->load->view('public/header',$data);
					$this-> load -> library('captcha');
					$cap = $this -> captcha -> code();
					$this -> session -> set_userdata('capture', $cap['word']);
					$this->load->view('Index/register',$cap);
					$this->load->view('public/foot');
			}
			else
			{
					
					$this->load->model('Reg_model');
			
					$dbre=$this->Reg_model->check($username,$email);
			
					if($dbre['num1']<1 && $dbre['num2']<1 && $dbre['res']!=0)
					{
							$data = array(
							'username' => $username,
							'password' => $hash,
							'email'    => $email,
							'question' => $question,
							'answer'   => $answer,
							'head_img'=>"/static/head_img/default.gif"
							);
						$this->db->insert('hctf_user',$data);
						$this->db->insert_id();
						echo "<script>alert('register succeed')</script>";
						echo "<script>window.location.href='/WebIndex/login'</script>";
					}
			else
			{
				if($dbre['num1']>=1)
				{
					$title='Register';
					$data=array( 'title'=>$title  );
					$this->load->view('public/header',$data);
					$this-> load -> library('captcha');
					$cap = $this -> captcha -> code();
					$this -> session -> set_userdata('capture', $cap['word']);
					$this->load->view('Index/register',$cap);
					$this->load->view('public/foot');
					echo "<script>alert('same username has been registed')</script>";
				}
				else if($dbre['num2']>=1)
				{
					$title='Register';
					$data=array( 'title'=>$title  );
					$this->load->view('public/header',$data);
					$this-> load -> library('captcha');
					$cap = $this -> captcha -> code();
					$this -> session -> set_userdata('capture', $cap['word']);
					$this->load->view('Index/register',$cap);
					$this->load->view('public/foot');
					echo "<script>alert('same email has been registed')</script>";
				}
				else if($dbre['res']==0)
				{
						$this-> load -> library('captcha');
						$cap = $this -> captcha -> code();
						$title = 'Register';
						$data=array( 'title'=>$title  );
						$this -> session -> set_userdata('capture', $cap['word']);
						$this->load->view('public/header',$title);
						$this->load->view('Index/register',$cap);
						$this->load->view('public/foot');
				}
			}
*/
			}
			}




		public function vcode()
		{	
		

				if (strtolower($_SESSION['capture']) == strtolower(trim($this->input->post('code', TRUE)))) 
				{

					if ($_SESSION['capture'] == trim($this->input->post('code', TRUE))) 
					{
							return true;
					} 
					else 
					{
						$this->form_validation->set_message('vcode', 'error');
						return false;
					}
				
				}
		}
}

?>
