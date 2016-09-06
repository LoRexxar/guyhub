<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Getfile
{
	private $CI;
	function __construct()
	{
		$this -> CI =& get_instance();
		$this -> CI -> load -> model('Web_model', 'udb');
	}
	
	public function get_path()
	{
		$i = $this -> CI -> udb -> id_get_project();
		return $i['code_addr']."/";
	}

	public function get_size($fn)
	{
		$r = array(
			'size' => array()
		);
		if (is_array($fn)) {
			foreach ($fn as $value) {
				$fb = filesize($value);
				if ($fb > 1024) {
					$fb = round($fb / 1024, 2) . " KB"; 
				}
				else{
					$fb .= " B";
				}
				array_push($r['size'], $fb);
			}
			return $r;
		}
		else{
			$fb = filesize($fn);
			if ($fb > 1024) {
				$fb = round($fb / 1024, 2) . " KB"; 
			}
			else{
				$fb .= " B";
			}
			return $fb;
		}
	}
	
	public function get_atime($fn)
	{
		$ft = array(
			'atime' => array()
		);
		if (is_array($fn)) {
			foreach ($fn as $value) {
				$a = fileatime($value);
				$t = date("m-d H:i:s",$a);
				array_push($ft['atime'], $t);
			}
			return $ft;
		}
		else{
			$a = fileatime($fn);
			$t = date("m-d H:i:s",$a);
			return $t;
		}
	}

	public function get_index()
	{
		$files = array();
		$path = $this -> get_path();
		
		$f = $this -> get_file($path);
		$t = $this -> get_atime($f['fullname']);
		$s = $this -> get_size($f['fullname']);
		$files = array_merge($f, $t, $s);
		return $files;
	}

	public function get_file($path)
	{
		$f = array(
			'fname' => array(),
			'fullname' => array()
			);
		if (is_dir($path)) {
			if ($dh = opendir($path)) {
				while (($file = readdir($dh)) != False) {
					if (filetype($path.$file) == 'file') {
						array_push($f['fname'], $file);
						array_push($f['fullname'], $path.$file);
					}
				}
			}
		}
		return $f;
	}

}