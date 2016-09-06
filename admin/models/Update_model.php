<?php

	class Update_model extends CI_model
	{
			function __construct()
			{
					parent::__construct();
					$auto_db=$this->load->database('test');
			}
			
			public function update($type,$username,$name)
			{
					if($type=='email')
					{
							$sql="select * from hctf_user where email = ?";
							$re=$this->db->query($sql,$name);
							$res=$re->result_array();

							if(isset($res[0]))
							{
									$bool=0;
									return $bool;
							}
							else
							{

								$where=array('username'=>$username);
								$data=array('email'=>$name);

								$bool = $this->db->update('hctf_user',$data,$where);
						
								$sql="select * from hctf_user where username = ?";
								$re=$this->db->query($sql,$username);
								$res=$re->result_array();
				
								if(isset($res[0]))
								{
									$id=$res[0]['id'];
									$email=$res[0]['email'];
									$dataemail=array('email'=>$email);
					
									$bool1=$this->db->update('hctf_discuss',$dataemail,$where);
									$bool2=$this->db->update('hctf_dis_anw',$dataemail,$where);
					
									$bool= $bool and $bool1 and $bool2;
					
									return $bool;
								}
								else
								{
										$bool=0;
										return $bool;
								}
							}
					}
					else
					{
						echo 1;
						$where=array('username'=>$username);
						$data=array($type=>$name);
						$bool = $this->db->update('hctf_user',$data,$where);
						
						$sql="select * from hctf_user where username = ?";
						$re=$this->db->query($sql,$username);
						$res=$re->result_array();
				
						if(isset($res[0]))
						{
							$id=$res[0]['id'];
							$email=$res[0]['email'];
							$dataemail=array('email'=>$email);
					
							$bool1=$this->db->update('hctf_discuss',$dataemail,$where);
							$bool2=$this->db->update('hctf_dis_anw',$dataemail,$where);
							$bool3=$this->db->update('hctf_advise',$dataemail,$where);
					
							$bool= $bool and $bool1 and $bool2 and $bool3;
					
							return $bool;
						}
						else
						{
								$bool=0;
								return $bool;
						}
					}
					
					
			}
	}

?>
