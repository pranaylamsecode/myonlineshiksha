<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_oa2 extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		  $this->load->library('session');
        $this->load->model('login_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
	}
	
	
    public function session($provider_name)
    {
	   
        $this->load->library('session');
        $this->load->helper('url_helper');

        $this->load->library('oauth2/OAuth2');
				$this->load->library('tank_auth');
				$this->load->model('tank_auth/users');
				$this->load->config('oauth2', TRUE);
   
        $provider = $this->oauth2->provider($provider_name, array(
            'id' => $this->config->item($provider_name.'_id', 'oauth2'),
            'secret' => $this->config->item($provider_name.'_secret', 'oauth2'),
        ));
       
        if ( ! $this->input->get('code'))
        { 
            // By sending no options it'll come back here
            $provider->authorize();
        }
        else
        { 
            // Howzit?
            try
            {  
                //$token = $provider->access($_GET['code']);
                 $token = $provider->access($this->input->get('code'));

                 $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                //echo "<pre>Tokens: ";
                //var_dump($token);

                //echo "\n\nUser Info: ";
                //var_dump($user);


				if ($this->tank_auth->is_logged_in()) 
				{	// logged in
			       
					redirect('category');	
				}
				elseif( !is_null($this->users->get_user_by_email($provider_name.'|'.$user['email']))) 
				{ 
					//already registered
					echo 'already';					
					if ($this->tank_auth->login_oa2( $provider_name.'|'.$user['email'], $user['image'] ) ) 
					{	// success
						redirect('category');				
					} 
					else 
					{	
						$errors = $this->tank_auth->get_error_message();
						if (isset($errors['banned'])) 
						{	// banned user
							$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);				
						} 
						elseif (isset($errors['not_activated'])) 
						{				// not activated user
							redirect('/auth/send_again/');				
						} 
						else 
						{	// fail
							foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
						}
					}								
				}
				else
				{	
			        
                 	$email = $user['email'];
					if(isset($email)&& $email!="")
					{ 
						 $is_exist = $this->login_model->email_exists_ajax($email);
						 
					}
					if ($is_exist) 
					{
					  $password = 'googleuser';
						$logoimage = Null;
						$result = $this->login_model->validate($email, $password ,$logoimage);
						
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
										$this->load->model('admin/settings_model');
										$configarr = $this->settings_model->getItems();
										$this->template->set("configarr", $configarr);
										$subject = 'Welcome to '.$configarr[0]['institute_name'];
										$toemail = $email;
										$content = '';
										$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
										$content .= '<p>Dear '.$first->first_name.' '.$first->last_name.',<br /><br />';
										$content .='Thanks For Login, Now Institute is opened for you.<br /><br />';
										$content .='Best regards,<br /><br />';
										$content .=''.$configarr[0]['institute_name'].'</p>';
										$message = $content;
										$fromemail='prshah83@gmail.com';		
										$config['charset'] = 'utf-8';
										$config['mailtype'] = 'html';
										$config['wordwrap'] = TRUE;
										$this->email->initialize($config);
										$this->email->from($fromemail, 'Prashant');
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
						$email = $user['email'];
						$first_name = $user['first_name'];
						$last_name = $user['last_name'];
						$image = $user['image'];
						
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
						
						/*$errors = $this->tank_auth->get_error_message();
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);*/
					}
				}
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }


	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}
}

/* End of file auth_oa2.php */
/* Location: ./application/controllers/auth_oa2.php */