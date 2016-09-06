<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');

class WebIndex extends CI_Controller {
	private $user = array();
	private $is_login = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		//$this->output->enable_profiler(TRUE);
		if (($this -> session -> userdata('username')) != null) {
			$this -> is_login = 1;
			$this -> user['head_img'] = $_SESSION['head_img'];
			$this -> user['username'] = $_SESSION['username'];
			$this -> user['email'] = $_SESSION['email'];
		}
	}
	public function index()
	{
		$this -> load -> model('Web_model', 'udb');
		$pro = $this -> udb -> get_public_project();
		$data = array(
			'title' => 'GayHub',
			'is_login' => $this -> is_login,
			'user_info' => $this -> user,
			'pro' => $pro
			);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('Index/index');
		$this -> load -> view('public/foot');
	}
	public function register()
	{
		$cap = $this -> captcha -> code();
		$data = array(
			'title' => 'Register',
			//'is_login' => $this -> is_login,
			'user_info' => $this -> user
			);
		$this -> session -> set_userdata('capture', $cap['word']);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('Index/register', $cap);
		$this -> load -> view('public/foot');
	}
	public function login()
	{
		$cap = $this -> captcha -> code();
		$data = array(
			'title' => 'Login',
			//'is_login' => $this -> is_login,
			'user_info' => $this -> user
			);
		$this -> session -> set_userdata('capture', $cap['word']);
		$this -> load -> view('public/header', $data);
		$this -> load -> view('Index/login', $cap);
		$this -> load -> view('public/foot');
	}
	public function search()
	{
		
	}
	public function advise()
	{
			$username=$this->session->userdata('username');
			$email=$this->session->userdata('email');
			if(isset($username))
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
			else
			{
					echo "<script>alert('Please login first!')</script>";
						echo "<script>window.location.href='/WebIndex/login'</script>";
			}
			
	}
	
}
