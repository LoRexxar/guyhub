<?php

	class Find_model extends CI_model
	{
			function __construct()
			{
					parent::__construct();
					$auto_db=$this->load->database('test');
			}
			
			public function find($method,$name)
			{
					if($method=='power' && $name==0 )
					{
						$sql = "select * from hctf_user where power = 0";
						$re = $this->db->query($sql);
						$res = $re->result_array();
					}
					else
					{
						$sql = "select * from hctf_user where $method = ?";
						$re = $this->db->query($sql, $name);
						$res = $re->result_array();
					}
					return $res;
			}
	}

?>
