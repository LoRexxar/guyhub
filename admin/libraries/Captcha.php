<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Captcha
{
	private $CI;
	function __construct()
	{
		$this -> CI =& get_instance();
		$this-> CI -> load -> helper('captcha');
	}
	public function code()
	{
		$vals = array(
			'word'      => '',
			'img_path'  => '../views/static/captcha/',
			'img_url'   => '/static/captcha/',
			'font_path' => '../views/static/fonts/micross.ttf',
			'img_width' => '150',
			'img_height'    => 30,
			'expiration'    => 7200,
			'word_length'   => 4,
			'font_size' => 16,
			'img_id'    => 'Imageid',
 			'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'    => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);
		$c = create_captcha($vals);
		$c['word'] = strtolower($c['word']);
		return $c;
	}
}
