<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HAuth extends MLMS_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		  $this->load->library('session');
        $this->load->model('login_model');
			$this->load->library('HybridAuthLib');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
	}

	public function index()
	{
	   
		$this->load->view('hauth/home');
	}

	public function login($provider)
	{
		$provider = str_replace("#_=_", "", $provider);
	  	
		log_message('debug', "controllers.HAuth.login($provider) called");
		
		try
		{
		   
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
		
              
			if ($this->hybridauthlib->providerEnabled($provider))
			{
				
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				 
				$service = $this->hybridauthlib->authenticate($provider);
							
               
				if ($service->isUserConnected())
				{ 
					
					$this->session->set_userdata('isfblogin',1);
										 
					log_message('debug', 'controller.HAuth.login: user authenticated.');

					$user_profile = $service->getUserProfile();

					
					log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));

					$data['user_profile'] = $user_profile;
					
					$email = $data['user_profile']->emailVerified;
					
					$this->load->library('form_validation');
					
					if(isset($email)&& $email!="")
					{ 
						 $is_exist = $this->login_model->email_exists_ajax($email);
						 
					}
					 if (@$is_exist)
                    {  
						$password = 'fbuser';
						$logoimage = Null;
						$result = $this->login_model->validate($email, $password ,$logoimage);
			         
						$courses_from_cart = $this->session->userdata('courses_from_cart');
						$login_page_url = $_SERVER["REQUEST_URI"];
						if($result)
						{  
							$last_page_url = $this->session->userdata('last_page_url');
							
							//added on date 13-01-2015 by yogesh
							//$this->login_model->validate();
							$user_name = $this->input->post('user_name');
							$dataNew= $this->login_model->setSessionData_fb($email);
							$this->session->set_userdata('logged_in',$dataNew);
							
							if($this->session->userdata('logged_in'))
							{
								$auth = $this->session->userdata('logged_in');
								$data['user_name'] = $auth['user_name'];
								if(isset($courses_from_cart) && $courses_from_cart != '' && $auth['groupid'] == '1')
								{
									redirect('buyitems/cart');
								}
								else
								{
									$first = $this->login_model->first_time_login($email);
									if($first->first_time_login == '0')//if zero i.e. first time
									{

										// $urldomain = base_url();
										// $urldomain = str_replace('http://', '', $urldomain);
										// $urldomain = str_replace('/', '', $urldomain);
										// $urldomain = str_replace('www.', '', $urldomain);
										$urldomain = $this->config->item('urldomain');
										
										$this->load->model('admin/settings_model');
										$configarr = $this->settings_model->getItems();
										$this->template->set("configarr", $configarr);
										$subject = 'Welcome to '.$configarr[0]['institute_name'];
										$toemail = $email;
										$content = '';
										$content .= '<p>Dear '.trim(ucfirst($first->first_name)).' '.trim(ucfirst($first->last_name)).',<br /><br />';
										$content .= 'Welcome to '.$configarr[0]['institute_name'].'. We are glad to have you on board!<br /><br />';
										$content .= 'You can now find out and subscribe to the courses as per your requirements, participate in discussions with your fellow students and teachers and also attend Webinars or live online classes during the courses.<br /><br />';
										$content .= '<a href = "'.base_url().'" >Discover Courses Now</a>.<br /><br />';							
										$content .= 'If you need help or have any questions, please contact us.<br />';
										$content .= '<br /><br />';
										$content .= '...</p>';
										 $content .= $configarr[0]['signature'].'</p>';
										//$message = $content;
										 $data['content'] = $content;
										$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
										//$fromemail=$configarr[0]['fromemail'];// admin mail	
										$fromemail='noreply@'.$urldomain;
										$config['charset'] = 'utf-8';
										$config['mailtype'] = 'html';
										$config['wordwrap'] = TRUE;
										$this->email->initialize($config);
										$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
										$this->email->subject($subject);
										$this->email->to($toemail);
										$this->email->message($message);
										$this->email->send();		
															
										$this->login_model->update_first_users($email);						
									}
									
									if($last_page_url == '')
									{
										redirect('category/');
										//echo 'success';
									}
									else
									{
										header("Location: $last_page_url");
									}
								}
							}
							else
							{
								redirect('category/');
								//echo 'success';
							}
						}
					}
					else 
					{ 
						$email = $data['user_profile']->emailVerified;
						$first_name = $data['user_profile']->firstName; // firstName
						$last_name = $data['user_profile']->lastName;
						$image = $data['user_profile']->photoURL;
						
						$content = file_get_contents($image);
						//Store in the filesystem.
						$image = rand(500,100000);
						$fileName = 'public/uploads/users/img/thumbs/'.$image.'_'.date('Y-m-d').'.jpg';
						$fp = fopen($fileName, 'w+');
						fputs($fp, $content);
						fclose($fp);
						
						
						$user_data = array(
						   //	'username'		=>	$this->input->post('username'),
							'email'			=>	$email,
							'fbemail'		=>	$email,
							'first_name' 	=> 	$first_name,
							'last_name' 	=> 	$last_name,
							'active' 	    =>  '1',
							'is_student' 	=>  '1',//one is for yes
							'is_instructor'	=>  '0',//zero is for no
							'images'        =>  $image.'_'.date('Y-m-d').".jpg",
							'group_id' 		=>  '1'		
							);
							$usergroups = '1';
							//print_r($data);
							$this->load->model('login_model');
							$insertid = $this->login_model->insertItems($user_data);
							if($insertid > 1){
									   $user_id = $this->login_model->maxuserid();
										  $group_data = array(
												'user_id'		=>	$insertid,
												'group_id'      =>  $usergroups

									);
									$this->login_model->insertUserGroup($group_data);
							}
							
							if($insertid)
							{
								$last_page_url = $this->session->userdata('last_page_url');
								
								//added on date 13-01-2015 by yogesh
								//$this->login_model->validate();
								$user_name = $this->input->post('user_name');
								$dataNew= $this->login_model->setSessionData_fb($email);
								$this->session->set_userdata('logged_in',$dataNew);
								
								if($this->session->userdata('logged_in'))
								{
									$auth = $this->session->userdata('logged_in');
									$data['user_name'] = $auth['user_name'];
								}
								
								if($last_page_url == '')
								{
										redirect('category/');
										//echo 'success';
								}
								else
								{
									header("Location: $last_page_url");
								}
								//redirect('category/');
							}
                    }
					
					//$this->load->view('hauth/done',$data);
				}
				else // Cannot authenticate user
				{
					  //exit('else');
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	
	}

	public function logout($provider)
	{
		$provider = str_replace("#_=_", "", $provider);
		
        $service = $this->hybridauthlib->authenticate($provider);
		
		$service->logout();
		$this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('last_page_url');
        $this->session->set_userdata(array('username' => ''));
	    $this->session->sess_destroy();
		redirect(base_url());
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
