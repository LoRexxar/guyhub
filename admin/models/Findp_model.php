<?php

	class Findp_model extends CI_model
	{
			function __construct()
			{
					parent::__construct();
					$auto_db=$this->load->database('test');
			}
			
			public function find($method,$name)
			{
					$sql = "select * from hctf_project where $method = ?";
					$re = $this->db->query($sql, $name);
					$res = $re->result_array();
					return $res;
			}
	}

?>
