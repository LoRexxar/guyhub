<?php

	class Deletep_model extends CI_model
	{
			function __construct()
			{
					parent::__construct();
					$auto_db=$this->load->database('test');
			}
			
			public function delete($method,$name)
			{
					$sql = "select * from hctf_project where $method = ?";
					$re = $this->db->query($sql, $name);
					$res = $re->result_array();
					if(isset($res[0]))
					{
						$this->db->where($method,$name);
						$bool=$this->db->delete('hctf_project');
						return $bool;
					}
					else
					{
						$bool=0;
						return $bool;
					}
			}
	}

?>
