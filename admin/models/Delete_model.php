<?php

	class Delete_model extends CI_model
	{
			function __construct()
			{
					parent::__construct();
					$auto_db=$this->load->database('test');
			}
			
			public function delete($method,$name)
			{
					$sql = "select * from hctf_user where $method = ?";
					$re = $this->db->query($sql, $name);
					$res = $re->result_array();
					if(isset($res[0]))
					{
						$this->db->where($method,$name);
						$bool=$this->db->delete('hctf_user');

						$user=$res[0]['username'];
						$id=$res[0]['id'];
						$email=$res[0]['email'];
						
						$this->db->where('username',$user);
						$bool1=$this->db->delete('hctf_discuss');
						$bool = $bool and $bool1;

						$this->db->where('username',$user);
						$bool1=$this->db->delete('hctf_dis_anw');
						$bool = $bool and $bool1;

						//$this->db->where()     //hctf_mail 不知到那个字段跟外部关联
						
						$this->db->where('creater_id',$id);
						$bool1=$this->db->delete('hctf_project');
						$bool = $bool and $bool1;

						$this->db->where('com_user',$user);
						$bool1=$this->db->delete('hctf_project_com');
						$bool = $bool and $bool1;

						$this->db->where('foc_user',$user);
						$bool1=$this->db->delete('hctf_project_foc');
						$bool = $bool and $bool1;

						$this->db->where('username',$user);
						$bool1=$this->db->delete('hctf_project_sha');
						$bool = $bool and $bool1;
						
						$this->db->where('username',$user);
						$bool1=$this->db->delete('hctf_advise');
						$bool = $bool and $bool1;
						
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
