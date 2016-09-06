<?php
defined('BASEPATH') OR exit('Hacked by Hcamael~');

	class Web_admin extends CI_Controller
	{
			function __construct()
			{
					parent::__construct();
					$this -> load -> library('session'); 
					$this -> load -> library('captcha');
					$this->load->library('form_validation');  
			}
			
			public function index()
			{
					$title = 'Admin';
					$data = array(
					'title'=>$title,
					'is_login'=>0
					);
					$this-> load ->view('public/header',$data);
					$cap = $this -> captcha -> code();
					$this ->session ->set_userdata('capture',$cap['word']);
					$this -> load ->view('Admin/login',$cap);
					$this -> load ->view('public/foot');
			}
			
			public function check()
			{
					$admin  = $this->input->post('admin',TRUE);
					$admin =  $this->security->xss_clean($admin);
					
					$password = $this->input->post('password',TRUE);
					$password = $this->security->xss_clean($password);
					
					$hash = md5($password);
					
					$code = $this->input->post('code',TRUE);
					$code = $this->security->xss_clean($code);
					
					if(empty($admin)||empty($password))
					{
							echo "<script>alert('Please input admin name and password')</script>";
							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else
					{
							$this->load->model('Login_model');
							$res=$this->Login_model->check();
							
							if($res['result']['username']===$admin && $res['result']['password']===$hash && $res['bool']==1)
							{
									$this->session->set_userdata('admin',$admin);
									$this->session->set_userdata('power',$res['result']['power']);
									$this->session->set_userdata('email',$res['result']['email']);
									$this->session->set_userdata('is_login',1);
									$time=date('y-m-d  h:i:s', time());
									$ip=$this->input->ip_address();
									$datt=array('last_ip'=>$ip,'last_time'=>$time);
									$where=array('username'=>$admin);
									$this->db->update('hctf_user',$datt,$where);
									echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
							}
							else if($admin!==$res['result']['username'] || $hash!==$res['result']['password']) 
							{
									echo "<script>alert('wrong adimin name or password')</script>";
									echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
							}
							else if($res['bool']!=1)
							{
									$title = 'Admin';
									$data = array(
										'title'=>$title,
										'is_login'=>0
									);
									$this-> load ->view('public/header',$data);
									$cap = $this -> captcha -> code();
									$this ->session ->set_userdata('capture',$cap['word']);
									$this -> load ->view('Admin/login',$cap);
									$this -> load ->view('public/foot');
							}
					}
			}
			
			public function manage()
			{
					$title='Manage';
					$username=$this->session->userdata('username');
					$email = $this -> session -> userdata('email');
					$user=array('username' => $username , 'email' =>$email);
					$data=array('title'=>$title,'is_login'=>1,'user_info'=>$user);
					$this->load->view('public/head',$data);
					$this->load->view('Admin/manage');
					$this->load->view('public/foot');
			}
			
			
			public function find()
			{
					
					$power = $this->session->userdata('power');
					$is_login = $this->session->userdata('is_login');
					
	
					
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("is_login");
							$this->session -> unset_userdata("power");
							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
									
					else
					{
							$method = $this->input->post('method',TRUE);
							$method = $this->security->xss_clean($method);
					
							$name  = $this->input->post('name',TRUE);
							$name  = $this->security->xss_clean($name);
						
							if(empty($method)||(empty($name) && $name != 0))
							{
									echo "<script>alert('You need input something')</script>";
									echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
							}
							else
							{
									$this->load->model('Find_model');
									$re=$this->Find_model->find($method,$name);
					
									$data=array('title'=>'Find_result','is_login'=>0);
									$res=array('res'=>$re);
									$this->load->view('public/head',$data);
									$this->load->view('Admin/find_result',$res);
									$this->load->view('public/foot');								
							}

					}
			}
			
			public function signout()
			{
					$this->session->unset_userdata("is_login");
					$this->session->unset_userdata("power");
					echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
			}
			
			public function list()
			{
					$power=$this->session->userdata('power');
					$is_login = $this -> session ->userdata('is_login');
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("power");
							$this->session->unset_userdata("is_login");
							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else
					{
							$this->load->model('List_model');
							$res=$this->List_model->get();
							$result=array('res'=>$res);
							$title='List All user';
							$is_login=0;
							$data=array('title'=>$title);
							$this->load->view('public/head',$data);
							$this->load->view('Admin/list',$result);
							$this->load->view('public/foot');
					}
			}
			
			public function delete()
			{
				
					$power=$this->session->userdata('power');
					$is_login=$this->session->userdata('is_login');
					
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
				
					else
					{
							$method=$this->input->post('method');
							$method=$this->security->xss_clean($method);
					
							$name=$this->input->post('name');
							$name=$this->security->xss_clean($name);
					
							if(empty($name)||empty($method))
							{
									echo "<script>alert('Please input something')</script>";
									echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
							}
							else
							{
									$this->load->model('Delete_model');
									$bool=$this->Delete_model->delete($method,$name);
									if($bool==1)
									{
											echo "<script>alert('Delete Succeed')</script>";
											echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
									}
									else
									{
											echo "<script>alert('Failed')</script>";
											echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
									}
							}
					}
					
			}
			
			public function update()
			{
					$username=$this->input->post('username');
					$username=$this->security->xss_clean($username);
					
					$type=$this->input->post('type');
					$type=$this->security->xss_clean($type);
					
					$name=$this->input->post('name');
					$name=$this->security->xss_clean($name);					
					
					$power=$this->session->userdata('power');
					$is_login=$this->session->userdata('is_login');
					
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					
					else
					{
							if(empty($username)||empty($type)||empty($name))
							{
									echo "<script>alert('Please input something')</script>";
									echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";									
							}
							
							else
							{
									$this->load->model('Update_model');
									$bool=$this->Update_model->update($type,$username,$name);
									if($bool==1)
									{
											echo "<script>alert('Update Succeed')</script>";
											echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
									}
									else
									{
											echo "<script>alert('Failed')</script>";
											echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
									}
							}
							
					}					
					
			}
			public function listp()
			{
					$power=$this->session->userdata('power');
					$is_login=$this->session->userdata('is_login');
					
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else
					{
							$this->load->model('Listp_model');
							$res=$this->Listp_model->get();
							$result=array('res'=>$res);
							$title='List All  Project';
							$is_login=0;
							$data=array('title'=>$title);
							$this->load->view('public/head',$data);
							$this->load->view('Admin/listp',$result);
							$this->load->view('public/foot');
					}
			}
			
			public function findp()
			{
					$power = $this->session->userdata('power');
					$is_login = $this->session->userdata('is_login');
					
	
					
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
									
					else
					{
							$method = $this->input->post('method',TRUE);
							$method = $this->security->xss_clean($method);
					
							$name  = $this->input->post('name',TRUE);
							$name  = $this->security->xss_clean($name);
						
							if(empty($method)||empty($name))
							{
									echo "<script>alert('You need input something')</script>";
									echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
							}
							else
							{
									$this->load->model('Findp_model');
									$re=$this->Findp_model->find($method,$name);
					
									$data=array('title'=>'Find_result','is_login'=>0);
									$res=array('res'=>$re);
									$this->load->view('public/head',$data);
									$this->load->view('Admin/findp_result',$res);
									$this->load->view('public/foot');								
							}

					}
			}
			
			public function deletep()
			{
				
					$power=$this->session->userdata('power');
					$is_login=$this->session->userdata('is_login');
					
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
				
					else
					{
							$method=$this->input->post('method');
							$method=$this->security->xss_clean($method);
					
							$name=$this->input->post('name');
							$name=$this->security->xss_clean($name);
					
							if(empty($name)||empty($method))
							{
									echo "<script>alert('Please input something')</script>";
									echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
							}
							else
							{
									$this->load->model('Deletep_model');
									$bool=$this->Deletep_model->delete($method,$name);
									if($bool==1)
									{
											echo "<script>alert('Delete Succeed')</script>";
											echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
									}
									else
									{
											echo "<script>alert('Failed')</script>";
											echo "<script>window.location.href='/admin_qwe.php/Web_admin/manage'</script>";
									}
							}
					}
					
			}
			
			public function lista()
			{
					$power=$this->session->userdata('power');
					$is_login=$this->session->userdata('is_login');
					
					if($power!=1)
					{
							echo "<script>alert('You have no power to do this!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else if($is_login!=1)
					{
							echo "<script>alert('You don't login!')</script>";
							$this -> session ->unset_userdata("is_login");
                                                        $this->session -> unset_userdata("power");

							echo "<script>window.location.href='/admin_qwe.php/Web_admin/index'</script>";
					}
					else
					{
							$this->load->model('Lista_model');
							$res=$this->Lista_model->get();
							$result=array('res'=>$res);
							$title='List All  Advise';
							$is_login=0;
							$data=array('title'=>$title);
							$this->load->view('public/head',$data);
							$this->load->view('Admin/lista',$result);
							$this->load->view('public/foot');
					}
			}
			
			public function vcode()
			{	
		
					if (strtolower($_SESSION['capture']) == strtolower(trim($this->input->post('code', TRUE)))) 
					{
							return true;
					}
					 else
					  {
							$this->form_validation->set_message('vcode', 'error');
							return false;
					  }
				
	    }
	}
