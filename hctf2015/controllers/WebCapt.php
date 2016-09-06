<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');

class WebCapt extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$cap = $this -> captcha -> code();
		$this -> session -> set_userdata('capture', $cap['word']);
		echo $cap['image'];
	}
}
