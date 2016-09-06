<?php

	class Listp_model extends CI_model
	{
				function __construct()
				{
						parent:: __construct();
						$auto_db=$this->load->database('test');
				}
				
				public function get()
				{
						$sql="select * from hctf_project";
						$re = $this->db->query($sql);
						$res=$re->result_array();
						return $res;
				}
	}

?>
