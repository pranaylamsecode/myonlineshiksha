<?php defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Users extends MLMS_Controller
{
	function __construct()
	{  
		parent::__construct();
        $this->load->helper(array('form', 'url'));				
		$this->load->helper('commonmethods');		
        $this->load->library('session');
        $this->load->model('login_model');
        $this->load->model('Crud_model');
        $this->load->model('reseller_model');
        $this->load->helper('cookie');
        $this->load->library('phpqrcode/qrlib');
       // $this->session->set_userdata('last_page_url', $_SERVER['PHP_SELF']);
	$this->load->library('user_agent');
	if ($this->agent->is_referral())
	{
	   $this->session->set_userdata('last_page_url', $this->agent->referrer());
	}
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->library('email');
		$this->load->model('admin/settings_model');
		$this->load->model('admin/users_model');
		$configarr = $this->settings_model->getItems();	
		
		date_default_timezone_set($configarr[0]['time_zone']);
		
		$this->template->set_layout($configarr[0]['layout_template']);
		$socailloginarray = json_decode($configarr[0]['sociallogin']);
		$socailloginarray->facebook->appid;
		$socailloginarray->facebook->appsecretkey;
		$this->load->library('facebook/facebook', array('appId' => $socailloginarray->facebook->appid, 'secret' => $socailloginarray->facebook->appsecretkey));
		
		//$this->load->library('googleplus/Googleplus', array('appId' => $socailloginarray->facebook->appid, 'secret' => $socailloginarray->facebook->appsecretkey));
        $this->load->helper('cookie');
		ob_start();
	}
    public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			redirect('myinfo/myaccount');
		}
	
        $this->template->set_layout('frontend');
        $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		
		$tmpl = $configarr[0]['layout_template'];      
        $this->template->set("tmpl", $tmpl);
		redirect('users/login/');
        //$this->load->model('myinfo/myaccount');
    }

    function blocked()
    {
    	$this->load->view('user/blocked');
    }

     function expired()
    {
    	$this->load->view('user/expired');
    }
	
    function login()
    {
    	redirect();exit;
		if($this->session->userdata('logged_in'))
		{
			$last_page_url = $this->session->userdata('last_page_url');

			if($last_page_url == '')
			{
                redirect('myinfo/myaccount');
            }
			else
			{
                header("Location: $last_page_url");
            }
			
		}
		
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $logoimage=$configarr[0]['logoimage'];
        // $this->template->set("configarr", $configarr);
        $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();
         	 
		$tmpl = $configarr[0]['layout_template'];     
		// $this->template->set("tmpl",$tmpl);
        // $this->template->title('Login');
        	$data['tmpl'] = $tmpl;
			$data['title'] = 'Login';
			$data['configarr'] = $configarr;
		
		// $this->load->view('new_template_design/header');
  //       $this->load->view('user/login', $data);
  //       $this->load->view('new_template_design/footer');	
		// $this->template->build(getOverridePath($tmpl,'user/login','views'));	
			
	    $email = strtolower(trim($this->input->post('email')));
        //$email = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));
        // $this->_set_rules();
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']');
        if(isset($email)&& $email!="" && isset($password)&& $password!="")
        {
			$this->form_validation->set_rules('mymsg','','callback_check_login');
        }

        if ($this->form_validation->run() === FALSE)
        {
			/*login with facebook*/
			$fbloginUrl = $this->facebook->getLoginUrl(
			array(
			'scope' => 'user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_online_presence,user_photo_video_tags,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,user_work_history,email,read_friendlists,read_insights,read_mailbox,read_requests,read_stream,xmpp_login,ads_management,create_event,manage_friendlists,manage_notifications,offline_access,publish_checkins,publish_stream,rsvp_event,sms,publish_actions,manage_pages',
			'redirect_uri'	=> base_url().'users/registration'
			));
			// $this->template->set("fbloginUrl", $fbloginUrl);
			$data['fbloginUrl'] = $fbloginUrl;
			/*login with facebook*/
			//$loginUrl;			
			$this->load->view('new_template_design/header');
        $this->load->view('user/login', $data);
        $this->load->view('new_template_design/footer');	
		    // $this->template->build('user/login');
		}
		else
		{
            $result = $this->login_model->newvalidate($email, $password ,$logoimage);
			
            $courses_from_cart = $this->session->userdata('courses_from_cart');
            $login_page_url = $_SERVER["REQUEST_URI"];
            if($result == true )
            {
                $last_page_url = $this->session->userdata('last_page_url');
				
				//added on date 13-01-2015 by yogesh
				//$this->login_model->validate();
				$user_name = $this->input->post('user_name');
				$dataNew= $this->login_model->setSessionData($email,$password);
				$this->session->set_userdata('logged_in',$dataNew);
				$this->session->set_userdata('loggedin',$dataNew);
                if($this->session->userdata('logged_in'))
				{   $this->view_frontsite();
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
							// $urldomain = str_replace('https://', '', $urldomain);
							// $urldomain = str_replace('/', '', $urldomain);
							// $urldomain = str_replace('www.', '', $urldomain);
							if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

							$this->load->model('admin/settings_model');
							$configarr = $this->settings_model->getItems();
							$this->template->set("configarr", $configarr);
							$subject = 'Welcome to '.$configarr[0]['institute_name'];
							$toemail = $email;
							$content = '';
							//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Welcome to '.$configarr[0]['institute_name'].'</p>';
							$content .= '<p>Dear '.trim(ucfirst($first->first_name)).' '.trim(ucfirst($first->last_name)).',<br /><br />';
							$content .= 'Welcome to '.$configarr[0]['institute_name'].'. We are glad to have you on board!<br /><br />';
							$content .= 'You can now find out and subscribe to the courses as per your requirements, participate in discussions with your fellow students and teachers and also attend Webinars or live online classes during the courses.<br /><br />';
							$content .= '<a style="color:#55c5eb" href = "'.base_url().'" >Discover Courses Now</a>.<br /><br />';							
							$content .= 'If you need help or have any questions, please contact us.<br />';
							// $content .= '<br /><br />';
							// $content .='...</p>';
							//  $content .= $configarr[0]['signature'].'</p>';
							//$message = $content;
							 $data['content'] = $content; 
							$data['fromemail'] = $urldomain;
							$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							//$fromemail=$configarr[0]['fromemail'];// admin mail	
							$fromemail = $urldomain;
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
    }
	
	public function loginPopup()
	{
		if($this->session->userdata('logged_in'))
		{
			$last_page_url = $this->session->userdata('last_page_url');

			if($last_page_url == '')
			{
               echo 'myinfo/myaccount';
            }
			else
			{
                // header("Location: $last_page_url");
                echo $last_page_url;
            }
			//redirect('myinfo/myaccount');
		}
		
		//$this->load->model('admin/settings_model');
        //$configarr = $this->settings_model->getItems();
        //$logoimage=$configarr[0]['logoimage'];
        //$this->template->set("configarr", $configarr);
        //$this->load->model('admin/settings_model');      
		//$configarr = $this->settings_model->getItems();
        // 	 
		//$tmpl = $configarr[0]['layout_template'];     
		//$this->template->set("tmpl",$tmpl);
        //$this->template->title('Login');
		//$this->template->build(getOverridePath($tmpl,'user/login','views'));
		
		$email = strtolower(trim($_POST['email']));
		//$email = trim($_POST['email']);
		$password = trim($_POST['password']);	
				
		$result = $this->login_model->newvalidate($email, $password);
		//echo"<pre>";
		//print_r($result);
		//echo"</pre>";
		$courses_from_cart = $this->session->userdata('courses_from_cart');
        $login_page_url = $_SERVER["REQUEST_URI"];
		if($result == true)
		{	
			$last_page_url = $this->session->userdata('last_page_url');

			$dataNew= $this->login_model->setSessionData($email,$password);
			$this->session->set_userdata('logged_in',$dataNew);
			$this->session->set_userdata('loggedin',$dataNew);
			
			//echo 'success';	
				if($this->session->userdata('logged_in'))
				{  
					// new redeem code
					// print_r($this->session);exit;
					// new redeem code
					$this->view_frontsite();
                    $auth = $this->session->userdata('logged_in');

                    $data['user_name'] = $auth['user_name'];
                    if($auth['groupid'] === '5' || $auth['groupid'] === '2')
                    {
                    	echo base_url('partner/coupons');
                    }
                    else if(isset($courses_from_cart) && $courses_from_cart != '' && $auth['groupid'] == '1')
					{

						if($last_page_url == '')
						{
							echo 'buyitems/cart';
			                //redirect('buyitems/cart');
			            }
						else
						{
							echo $last_page_url;
			                // header("Location: $last_page_url");
			            }
						// redirect('buyitems/cart');
                    }
                    else if($auth['groupid']=="1")
                    {
                    	// new code
                    	$user_id = $auth['id'];
				        $coupon_code = $this->session->userdata('coupon_code');
				        $course_id = $this->session->userdata('crs_id');

				        if(!empty($coupon_code))
                    	{
				        	$getcourse = $this->Crud_model->get_single('mlms_program',"id = ".$course_id,"name,slug,id");
                    		$getorder = $this->Crud_model->get_single('mlms_order',"courses = '".$course_id."' AND userid = '".$user_id."'");
					        if(!empty($getorder))
					        {
					        	$this->session->set_userdata('msg_redeem','Already');
					        	echo base_url().$getcourse->slug.'/lectures/'.$getcourse->id;
					        	
					        }
                    		$newdata = array(
										'course_id' => $course_id,
										'student_name' => $user_id,
										'status' => "Redeemed",
					                    'modified' => date('Y-m-d H:i:s')
							);
							$cond = "coupon_code = '".$coupon_code."' AND status ='Unused'";
							$this->Crud_model->SaveData('mlms_reseller_coupon',$newdata,$cond);
							$this->load->model('reseller_model');
					        $con = "rc.coupon_code ='".$coupon_code."'";        
					        $get_code = $this->reseller_model->get_redeem_code($con);
					        if(!empty($get_code))
					        {
					          	$order = array(
					                        'userid' => $user_id,
					                        'order_date' => date('Y-m-d H:i:s'),
					                        'courses' => $get_code->course_id,
					                        'status' => 'SUCCESS',
					                        'pending_reason' => 'New Order',
					                        'amount' => $get_code->fixedrate,
					                        'amount_paid' => $get_code->fixedrate,
					                        'processor' => 'Cash',
					                        'currency' => 'INR',
					                        'published' => 1,
					                        'transactionid' => $coupon_code,
					                        'order_status' => 'New Order',
					                        'referred_code' => $get_code->referral_code,
					          );
					          $this->Crud_model->SaveData('mlms_order',$order);
					          $order_id = $this->db->insert_id();

					          $buy_course = array(
					                        'userid' => $user_id,
					                        'order_id' => $order_id,
					                        'course_id' => $get_code->course_id,
					                        'price' => $get_code->fixedrate,
					                        'currency' => "INR",
					                        'buy_date' => date('Y-m-d H:i:s'),
					                        'finalexam_status' => "notgiven"
					          );
					          $this->Crud_model->SaveData('mlms_buy_courses',$buy_course);
					          if($get_code->reseller_id != $get_code->author)
					          {
					            $reseller_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->reseller_id);
					            $rcom = floatval($get_code->fixedrate) * floatval($get_code->assessment) /100 ;
					            $reseller_total = floatval($reseller_payout->total_amount) + floatval($rcom);
					            $reseller_paid = floatval($reseller_payout->paid_amount) + floatval($rcom);
					            $reseller = array(
					                          'total_amount' => $reseller_total,
					                          'paid_amount' => $reseller_paid,
					                          'modified' => date('Y-m-d H:i:s')
					            );
					            $this->Crud_model->SaveData('mlms_payout',$reseller,"user_id =".$get_code->reseller_id);

					            $pay_log = array(
					                            'payout_id' => $reseller_payout->id,
					                            'user_id' => $get_code->reseller_id,
					                            'pay_mode' => 'Cash',
					                            'paid_amount' => $rcom,
					                            'paid_date' => date('Y-m-d H:i:s'),
					                            'memo' => "Payment automatically SETTLED in case of Offline selling a course.",
					            );
					            $this->Crud_model->SaveData('mlms_payout_log',$pay_log);
					            
					            $log_comm1 = array(
					                          'order_id' => $order_id,
					                          'reseller_id' => $get_code->reseller_id,
					                          'commission' => $rcom,
					                          'comm_percent' => $get_code->assessment,
					                          'created' => date("Y-m-d H:i:s")
					            );
					            $this->Crud_model->SaveData('mlms_commission_log',$log_comm1);

					            // teacher commision
					            $teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->author);
						          $tcom = floatval($get_code->fixedrate) * (floatval($get_code->coursepercent) - floatval($get_code->assessment)) /100 ;

						          $teacher_total = floatval($teacher_payout->total_amount) + floatval($tcom);
						          $teacher_paid = floatval($teacher_payout->paid_amount) + floatval($tcom);

						          $teacher = array(
						                        'total_amount' => $teacher_total,
						                        'paid_amount' => $teacher_paid,
						                        'modified' => date('Y-m-d H:i:s')
						          );
						          $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id =".$get_code->author);
						          $log_comm2 = array(
						                        'order_id' => $order_id,
						                        'reseller_id' => $get_code->author,
						                        'commission' => $tcom,
						                        'comm_percent' => (floatval($get_code->coursepercent) - floatval($get_code->assessment)),
						                        'created' => date("Y-m-d H:i:s")
						          );
						          $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);

						          $amount_liable = floatval($get_code->fixedrate) - floatval($rcom);
						          $offline_payment = array(
						                        'reseller_id' => $get_code->reseller_id,
						                        'order_id' => $order_id,
						                        'amount' => round(floatval($amount_liable),2)
						          );
						          $this->Crud_model->SaveData('mlms_offline_payment',$offline_payment);
					          }
					          else{
					        	$teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->author);
						          $tcom = floatval($get_code->fixedrate) * floatval($get_code->coursepercent) /100 ;
						          $teacher_total = floatval($teacher_payout->total_amount) + floatval($tcom);
						          $teacher_paid = floatval($teacher_payout->paid_amount) + floatval($tcom);

						          $teacher = array(
						                        'total_amount' => $teacher_total,
						                        'paid_amount' => $teacher_paid,
						                        'modified' => date('Y-m-d H:i:s')
						          );
						          $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id =".$get_code->author);
						          $log_comm2 = array(
						                        'order_id' => $order_id,
						                        'reseller_id' => $get_code->author,
						                        'commission' => $tcom,
						                        'comm_percent' => $get_code->coursepercent,
						                        'created' => date("Y-m-d H:i:s")
						          );
						          $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);

						          $amount_liable = floatval($get_code->fixedrate) - floatval($tcom);
						          $offline_payment = array(
						                        'reseller_id' => $get_code->author,
						                        'order_id' => $order_id,
						                        'amount' => round(floatval($amount_liable),2)
						          );
						          $this->Crud_model->SaveData('mlms_offline_payment',$offline_payment);
						      }
							//
								/*$this->load->library('email');
						        $this->load->model('admin/settings_model');           
						        $configarr = $this->settings_model->getItems();   
						        
						        if($configarr[0]['fromemail'])  
						            $urldomain = $configarr[0]['fromemail']; 
						        else 
						            $urldomain = 'noreply@mytonlineshiksha.com';
						        
						        $userdata = $this->Crud_model->get_single('mlms_users',"id = ".$payTMData['user_id'],"email,first_name,last_name,mobile");
						        $coursedetails = $this->Crud_model->get_single('mlms_program',"id = ".$payTMData['course_id'],"name,slug");
						        $subject = 'Order #112233445566778899'.' Pending';
						        $toemail = 'nikhil.b@veerit.com';
						        $content = '';
						        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #112233445566778899'.' is Pending.</p>';
						        $content .= 'Hello ,<br/><br/>';
						        $content .= 'Order details : <br/><br/>';
						        $content .= 'Customer Name : Nikhil Borikar<br/>';
						        $content .= 'Customer Email : borikarn153@gmail.com<br/>';
						        $content .= 'Customer Mobile : 9021315313<br/>';
						        $content .= 'Course Name : <a href="'.base_url().'online-courses/gravitation-chapter-10-class-9th-science-ncert-cbse/">Gravitation - Chapter 10 - Class 9th Science - NCERT / CBSE</a><br/>';
						        $content .= 'Course Price : 99<br/>';
						        $content .= '<br/>';
						        $data['content'] = $content; 
						                    $data['fromemail'] = $urldomain;
						        $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
						        $fromemail = $urldomain;
						        $config['charset'] = 'utf-8';
						        $config['mailtype'] = 'html';
						        $config['wordwrap'] = TRUE;
						        $this->email->initialize($config);
						        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
						        $this->email->subject($subject);
						        $this->email->to($toemail);
						        $this->email->message($message);
						        $this->email->send(); */
						    //
						    	
						    	$this->session->unset_userdata('coupon_code');
						    	$this->session->unset_userdata('crs_id');
						    	$this->session->set_userdata('msg_redeem', 'Congratulations');
					          	echo base_url().$getcourse->slug.'/lectures/'.$getcourse->id;
					        }
					    }
					    else if($last_page_url == '')
						{
							echo 'index/';
                        }
						else
						{    
							echo $last_page_url;
                        }
                    	// new code
                    }
					else
					{
						$first = $this->login_model->first_time_login($email);
						if($first->first_time_login == '0')//if zero i.e. first time
						{	

		// $urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
			


							// $this->load->model('admin/settings_model');
							// $configarr = $this->settings_model->getItems();
							// $this->template->set("configarr", $configarr);
							// $subject = 'Welcome to '.$configarr[0]['institute_name'];
							// $toemail = $email;
							// $content = '';
							// $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							// $content .= '<p>Dear '.trim(ucfirst($first->first_name)).' '.trim(ucfirst($first->last_name)).',<br /><br />';
							// $content .='Thanks For Login, Now Academy is opened for you.<br /><br />';
							// $content .='<br /><br />';
							// $content .='...</p>';
							//  $content .= $configarr[0]['signature'].'</p>';
							// $data['content'] = $content;
					  //       $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							// //$fromemail=$configarr[0]['fromemail'];// admin mail
							// $fromemail = $urldomain;
							// $config['charset'] = 'utf-8';
							// $config['mailtype'] = 'html';
							// $config['wordwrap'] = TRUE;
							// $this->email->initialize($config);
							// $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
							// $this->email->subject($subject);
							// $this->email->to($toemail);
							// $this->email->message($message);
							// $this->email->send();

							$this->load->model('admin/settings_model');
							$configarr = $this->settings_model->getItems();
							if($configarr[0]['fromemail'])  
					        $urldomain = $configarr[0]['fromemail']; 
					        else $urldomain = 'noreply@'.$this->config->item('urldomain');


							$this->template->set("configarr", $configarr);
							$subject = 'Welcome to '.$configarr[0]['institute_name'];
							$toemail = $email;
							$content = '';
							$content .= '<p>Dear '.trim(ucfirst($first->first_name)).' '.trim(ucfirst($first->last_name)).',<br /><br />';
							$content .= 'Welcome to '.$configarr[0]['institute_name'].'. We are glad to have you on board!<br /><br />';
							$content .= 'You can now find out and subscribe to the courses as per your requirements, participate in discussions with your fellow students and teachers and also attend Webinars or live online classes during the courses.<br /><br />';
							$content .= '<a style="color:#55c5eb" href = "'.base_url().'" >Discover Courses Now</a>.<br /><br />';							
							$content .= 'If you need help or have any questions, please contact us.<br />';
							// $content .= '<br /><br />';
							// $content .='...</p>';
							//  $content .= $configarr[0]['signature'].'</p>';
							//$message = $content;
							 $data['content'] = $content; 
							$data['fromemail'] = $urldomain;
							$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							//$fromemail=$configarr[0]['fromemail'];// admin mail	
							$fromemail = $urldomain;
							$config['charset'] = 'utf-8';
							$config['mailtype'] = 'html';
							$config['wordwrap'] = TRUE;
							$this->email->initialize($config);
							$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
							$this->email->subject($subject);
							$this->email->to($toemail);
							$this->email->message($message);
							
							if(!is_numeric($email))
							{
								if($this->email->send())
								{
									$maildetails = array('emailsent' => 1, );
									$this->login_model->emailsent($insertid,$maildetails);
								}
							}
							// $this->email->send();		
												
							$this->login_model->update_first_users($email);						
						}
						
                        if($last_page_url == '')
						{
							echo 'index/';
							//echo 'success';
                            // redirect('category/');
							
                        }
						else
						{    
							echo $last_page_url;
                   //         echo 'success123';
			                // header("Location: $last_page_url");
						   
                        }
                    }
                }
				else
				{
					//echo 'success';
					if($last_page_url == '')
						{
							echo 'category/';
			                //redirect('category/');
			            }
						else
						{
							echo $last_page_url;
			                //header("Location: $last_page_url");
			            }
                    //redirect('category/');
                }
		}
		else
		{		
			//echo 'denied';
		} 
		return true;
	}
	
	function newr()
	{
		redirect($_POST['newurl']);
	}
	
	function randomPassword($length) {
	   $alphabet = "a9den7pqz01fghijko2bc83rstxy45uw6lm";
	   $pass = array(); //remember to declare $pass as an array
	   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	   for ($i = 0; $i < $length; $i++) {
	       $n = rand(0, $alphaLength);
	       $pass[] = $alphabet[$n];
	   }
	   if($this->login_model->getReffCode(implode($pass)))
	   {
	       $this->randomPassword(8);
	   }
	   return implode($pass);
	}

	public function instructor()
    {		

		if($this->session->userdata('logged_in'))// when fresh login, send to instructor with all fields
		{	
			$this->load->model('admin/settings_model');
			$configarr = $this->settings_model->getItems();
			$logoimage=$configarr[0]['logoimage'];
			$this->template->set("configarr", $configarr);
			$this->load->model('admin/settings_model');     
			$configarr = $this->settings_model->getItems();	  
			$tmpl = $configarr[0]['layout_template'];      
			$this->template->set("tmpl",$tmpl);
			$this->template->build('user/instructor');		
		}
		else// else with single fields
		{	
		 	if(empty($this->input->post('email')) || empty($this->input->post('first_name')) || empty($this->input->post('last_name')) || empty($this->input->post('password')) || empty($this->input->post('contact_no')))
		 	{
		 		redirect();
		 	}
			$this->load->model('admin/settings_model');
			$configarr = $this->settings_model->getItems();
			$logoimage=$configarr[0]['logoimage'];
			$this->template->set("configarr", $configarr);
			$this->load->model('admin/settings_model');     
			$configarr = $this->settings_model->getItems();	  
			$tmpl = $configarr[0]['layout_template'];      
			// $this->template->set("tmpl",$tmpl);
			// $this->template->title('Login');
			// $this->template->build(getOverridePath($tmpl,'user/instructor','views'));
			
			$email = trim($this->input->post('email'));
			$password = trim($this->input->post('password'));
			$ref = $this->randomPassword(8);
			if($email == '')
			{
				$email = $ref."@mos.com";
			}
			
			$first_name = $this->input->post('first_name');
	        $last_name = $this->input->post('last_name');
	        $fname = '';
	        $lname = '';
	        $fn = explode(' ',str_replace('.',' ',$first_name));
	        $ln = explode(' ',str_replace('.',' ',$last_name));
	        $cntf = count($fn);
	        $cntl = count($ln);
	        $i = 1;
	        $j = 1;
	        foreach ($fn as $key) {
	          $fname .= $key;
	          if(intval($i) < intval($cntf))
	          {
	            if(!empty(trim($key)))
	              $fname .= '-';
	          }
	          $i++;
	        }
	        foreach ($ln as $key) {
	          $lname .= $key;
	          if(intval($j) < intval($cntl))
	          {
	            if(!empty(trim($key)))
	              $lname .= '-';
	          }
	          $j++;
	        }
	        $slug = strtolower($fname."-".$lname);
			$data = array(
						'email'			=>	$this->input->post('email'),
						'first_name' 	=> 	$first_name,
						'last_name' 	=> 	$last_name,
						'name'			=>  $first_name." ".$last_name,
						'is_student' 	=>  '0',
						'is_instructor'	=>  '1',
						'active' 	    =>  '0',
						'group_id'	    =>  '2',
						'images'        =>  '',
						'password' 		=>  md5($this->input->post('password')),
						'webstatus' 	=> 	$this->input->post('webinarstatus'),
						'mobile'		=>  $this->input->post('contact_no'),
						'referral_code' =>  $ref,
						'slug'			=> 	$slug
			);		
					
			$insertid = $this->login_model->insertItems($data);		
			
			$text1234 = base_url()."category/courses?ref=".$ref;
	      	$SERVERFILEPATH = getcwd().'/public/uploads/resellers_QR/';
	       
	      	$text1= $ref;
	      
	      	$folder = $SERVERFILEPATH;
	      	$file_name1 = $text1."-Qrcode".rand(0,9999).".png";
	      	$file_name = $folder.$file_name1;
	      	QRcode::png($text1234,$file_name,8,8);
	      	$form_data = array(
		                'referral_qr' => $file_name1,
		                'url_link' => $text1234,
			);
			$this->reseller_model->updateItem($insertid , $form_data);

			$data1 = array(
						'user_id'		=>	$insertid,
						'want_to_teach' =>  $this->input->post('teach')
			);
			$instructor_id = $this->login_model->insertInst_Desc($data1);
					
			$data_for_bank = array(
						'user_id'	=> $insertid
			);
					
		    $this->login_model->insertforBankAcc($data_for_bank);
					
					//exit('ganesh');
			$usergroups = '2';// 2 for trainer - group
			if($insertid >= 1)
			{
				$user_id = $this->login_model->maxuserid();
				$group_data = array(
							'user_id'	=>	$insertid,
							'group_id'	=>  $usergroups
				);
				$this->login_model->insertUserGroup($group_data);

				$pay_data = array(
								'user_id' => $insertid,
								'modified' => date('Y-m-d H:i:s')
				);
				$this->Crud_model->SaveData('mlms_payout',$pay_data);
				$assess_data = array(
									'user_id' => $insertid,
									'ass_type' => 2,
									'assessment' => '15',
									'created' => date('Y-m-d H:i:s'),
									'modified' => date('Y-m-d H:i:s'),
				);
				$this->Crud_model->SaveData('mlms_assessment',$assess_data);
			}		
				
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			$_SESSION['user_to_instructor'] = $instructor_id;
				
					//////////////***********email set
			$course = $this->login_model->getInst_Desc();
			
			$userinfo = $this->login_model->getUserInfo($course->user_id);
			$admininfo = $this->login_model->getadminInfo(4);

		// 		$urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
			if($configarr[0]['fromemail'])  
        	$urldomain = $configarr[0]['fromemail']; 
        	else $urldomain = 'noreply@'.$this->config->item('urldomain');
			//mail to user
					$subject = 'Your registration is successful to '.$configarr[0]['institute_name'];
					$toemail = $userinfo->email; // $userinfo->email
					// $toemail = "jyotisorte4@gmail.com";
					//$userdata1=$this->login_model->getUserInfoByEmail($toemail);
					//$link=base_url().'users/reset_password/'.$userdata1->id;
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($userinfo->first_name)).' '.trim(ucfirst($userinfo->last_name)).' Ji,<br /><br />';
					$content .='Welcome to '.$configarr[0]['institute_name'].',<br /><br />Your request to join us as a Knowledge Partner is successfully submitted. We will approve it within 72 hours.<br /><br />';
					$content .='On approval, you will receive an e-mail with further instructions.<br /><br />';
					$content .='If you need any help or have any questions, please mail us at info@myonlineshiksha.com or WhatsApp on +918668983852.<br /><br />';
					$content .='<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					//$fromemail=$configarr[0]['fromemail'];// admin mail	
					$fromemail = $urldomain;
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
					
				// Mail To admin 
					$subject3 = 'New Request of External Trainer for '.$configarr[0]['institute_name'];
					$toemail3 = $admininfo->email;// admin mail
					$content = '';	
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear'.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					$content .= '<p>New Request for External Trainer by '.trim(ucfirst($userinfo->first_name)).' '.trim(ucfirst($userinfo->last_name)).'  <br /><br />';
					$content .= trim(ucfirst($userinfo->first_name)).' '.trim(ucfirst($userinfo->last_name)).' is waiting for your approval. <br /><br />';
					$content .= ucfirst($userinfo->first_name).' '.ucfirst($userinfo->first_name)." want to teach '". $course->want_to_teach."'. <br /><br />";
					$content .='His/Her goal of teaching on '.$configarr[0]['institute_name'].' is '.$this->input->post('primary_goal').'.<br /><br />';
					$content .='His/Her ideal course creation experience '.$this->input->post('ideal_course').'.<br /><br />';
					$content .='His/Her ready to promote his/her course by '.$this->input->post('subscriber').'.<br /><br />';
					$content .='<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$message3 = $content;
					$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
					$message3 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					$fromemail3 =  'noreply@'.$urldomain;//$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject3);
					$this->email->to($toemail3);
					$this->email->message($message3);
					$this->email->send();
				$this->session->set_flashdata('message',array('type' => 'success','text' => lang('web_create_success')));
				unset($_SESSION['user_to_instructor']);
				redirect('teachers');
			}
    }

    public function thanks_page()
    {
    	/*$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
		$this->template->set_layout($configarr[0]['layout_template']);
		$this->template->title('Thanks');
		$this->template->build(getOverridePath($tmpl,'new_template_design/thanks_page','views'));*/

    	$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/thanks_page');	
		$this->load->view('new_template_design/footer');
    }

    public function cust_chat()
    {
    	$this->load->view('new_template_design/header');
    	$this->load->view('new_template_design/cust_chat');	
		$this->load->view('new_template_design/footer');

    }
	
	public function get_response()
	{
		print_r($_POST);
		exit('post');
	}
	public function inst_desc()
    {
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr);
		$this->load->model('admin/settings_model');     
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
		$this->template->title('Login');
		$this->template->build(getOverridePath($tmpl,'user/instructor','views'));
		
		$email = trim($this->input->post('email'));
		$password = trim($this->input->post('password'));
		// $this->_set_rules();
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']');
		if(isset($email)&& $email!="" && isset($password)&& $password!="")
		{
			$this->form_validation->set_rules('mymsg','','callback_check_login');
		}

		$this->template->build('user/inst_desc');//first time without submit
	}
	
	public function inst_desc_save()
    {
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		
		
		if(isset($_SESSION['user_to_instructor']))
		{
			$instructor_desc = array(
				'language'			=>	$this->input->post('language'),
				'category'			=>	$this->input->post('category'),
				'primary_goal'		=>	$this->input->post('primary_goal'),
				'idl_crs_crtn_exp'	=>	$this->input->post('ideal_course'),
				'exst_eml_sbsbr_lt'	=>  $this->input->post('promote_course'),
				'sbsb_on_youtube'	=>	$this->input->post('subscriber')
			);			
			
			$insertid = $this->login_model->updateInst_Desc($instructor_desc);
			
			$course = $this->login_model->getInst_Desc();
			
			$userinfo = $this->login_model->getUserInfo($course->user_id);
			$admininfo = $this->login_model->getadminInfo(4);
			
		// 				$urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
			if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
			//mail to user
					$subject = 'Registration to '.$configarr[0]['institute_name'];
					$toemail = $userinfo->email; // $userinfo->email
					//$userdata1=$this->login_model->getUserInfoByEmail($toemail);
					//$link=base_url().'users/reset_password/'.$userdata1->id;
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($userinfo->first_name)).' '.trim(ucfirst($userinfo->last_name)).',<br /><br />';
					$content .='Welcome to Institue, Your request for the external trainer will approve as early as possible.<br /><br />';
					$content .='On approval of your account you will receive an e-mail with further instructions.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .='<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					//$fromemail=$configarr[0]['fromemail'];// admin mail	
					$fromemail = $urldomain;
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
					
				// Mail To admin 
					$subject3 = 'Request of External Trainer for '.$configarr[0]['institute_name'];
					$toemail3 = $admininfo->email;// admin mail
					$content = '';	
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear'.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					$content .= '<p>New Request for External Trainer by '.trim(ucfirst($userinfo->first_name)).' '.trim(ucfirst($userinfo->last_name)).'  <br /><br />';
					$content .= trim(ucfirst($userinfo->first_name)).' '.trim(ucfirst($userinfo->last_name)).' is waiting for your approval. <br /><br />';
					$content .= ucfirst($userinfo->first_name).' '.ucfirst($userinfo->first_name)." want to teach '". $course->want_to_teach."'. <br /><br />";
					$content .='His/Her goal of teaching on '.$configarr[0]['institute_name'].' is '.$this->input->post('primary_goal').'.<br /><br />';
					$content .='His/Her ideal course creation experience '.$this->input->post('ideal_course').'.<br /><br />';
					$content .='His/Her ready to promote his/her course by '.$this->input->post('subscriber').'.<br /><br />';
					$content .='<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$message3 = $content;
					$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
					$message3 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					$fromemail3 =  'noreply@'.$urldomain;//$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject3);
					$this->email->to($toemail3);
					$this->email->message($message3);
					$this->email->send();
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			
			
			unset($_SESSION['user_to_instructor']);
		}
		redirect('users/login'); // by jayesh
	}
	
    public function check_login()
    {
        $email = $this->input->post('email');
        $password = trim($this->input->post('password'));
       // print_r($this->login_model->checkUserLogin($email,$password));
        if($this->login_model->checkUserLogin($email,$password))
        {
                return true;
        }
        return false;
    }


    function registration()
    {   	
    	redirect();
		$this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        // $this->template->set("configarr", $configarr);
		$data['configarr'] = $configarr;
		if($this->session->userdata('logged_in'))
		{
			redirect('myinfo/myaccount');
		}
		
		/*login with facebook if not equal to zero*/
        //$username = $this->input->post('username');
		$fbuser = $this->facebook->getUser();
		
		if($fbuser)
		{
		//$fbuser = '';
		$fbuserdata = $this->facebook->api('/me?fields=name,email,password');
		$fbemail = $fbuserdata['email'];
				
		if($this->login_model->checkUserName($fbemail) || $this->login_model->email_exists($fbemail))
		{			
			if($this->login_model->validate($fbemail,'fbuser'))
			{
				$last_page_url = $this->session->userdata('last_page_url');
                    if($this->session->userdata('logged_in'))
					{
                        $auth = $this->session->userdata('logged_in');
                        $data['username'] = $auth['username'];
                        if(isset($courses_from_cart) && $courses_from_cart != '' && $auth['groupid'] == '1')
						{
                            redirect('buyitems/cart');
                        }else
						{
                                if($last_page_url == ''){
                                    redirect('category/');
                                }else{
                                    header("Location: $last_page_url");
                                }
                        }
                    }
					else
					{
                        redirect('category/');
                    }
			}
		}
		else
		{
			// $this->template->set("fbuserdata", $fbuserdata);
			print_r($data['fbuserdata']); exit('fb hold');
			$data['fbuserdata'] = $fbuserdata;
			$data = array(
						   //	'username'		=>	$this->input->post('username'),
							//'email'			=>	$fbuserdata['email'],
				            'email'			=>	strtolower($fbuserdata['email']),
							'first_name' 	=> 	$fbuserdata['first_name'],
							'last_name' 	=> 	$fbuserdata['last_name'],
							'images'        =>  '',
							'active' 	    =>  '1',
							'is_student' 	=>  '1',//one is for yes
							'is_instructor'	=>  '0',//zero is for no
							'password' 		=>  md5('facebook'),
							'group_id' 		=>  '1',
							'webstatus' 	=> 	$this->input->post('webinarstatus')
			);
			$usergroups = '1';
			//print_r($data);
			$insertid = $this->login_model->insertItems($data);
			if($insertid > 1){
					   $user_id = $this->login_model->maxuserid();
						  $group_data = array(
								'user_id'		=>	$insertid,
								'group_id'      =>  $usergroups

					);
			
		// 	$urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
		if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');		
		//$subject = 'Welcome to '.$configarr[0]['institute_name'];
		$subject = 'Registration to '.$configarr[0]['institute_name'];
		$toemail = $fbuserdata['email'];
		$userdata1=$this->login_model->getUserInfoByEmail($toemail);
		$link=base_url().'users/reset_password/'.$userdata1->id;
		$content = '';
		//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
		//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
		$content .= '<p>Dear '.trim(ucfirst($fbuserdata['first_name'])).' '.trim(ucfirst($fbuserdata['last_name'])).',<br /><br />';
		$content .='Welcome to Academy, Academy has a course to help you get there faster.<br /><br />';
		$content .='If you need help or have any questions, please contact us.<br /><br />';
		// $content .='<br /><br />';
		// $content .='...</p>';
		// $content .= $configarr[0]['signature'].'</p>';
        $data['content'] = $content; 
							$data['fromemail'] = $urldomain;
		$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
		
		//$message = '<a href="'.$link.'">Click on link to reset password</a>';
		//$fromemail='admin@createonlineacademy.com';
		//$fromemail=$configarr[0]['fromemail'];// admin mail		
		$fromemail = $urldomain;
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
		$this->email->subject($subject);
		$this->email->to($toemail);
		//$this->email->cc('vikas.gorle@veerit.com');
		$this->email->message($message);
		$this->email->send();	


						redirect('users/registration');
					 }
				 }
	}
	else
	{
		$fbloginUrl = $this->facebook->getLoginUrl(
		array( 
		'scope' => 'user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_online_presence,user_photo_video_tags,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,user_work_history,email,read_friendlists,read_insights,read_mailbox,read_requests,read_stream,xmpp_login,ads_management,create_event,manage_friendlists,manage_notifications,offline_access,publish_checkins,publish_stream,rsvp_event,sms,publish_actions,manage_pages',
		'redirect_uri'	=> base_url().'users/registration'
		));
		
		// $this->template->set("fbloginUrl", $fbloginUrl);
		$data['fbloginUrl'] = $fbloginUrl;
	}
	
		//send link to email for registration
        $email = $this->input->post('email');
        $this->load->model('admin/settings_model');  
		$configarr = $this->settings_model->getItems();	 
		$tmpl = $configarr[0]['layout_template'];     
		// $this->template->set("tmpl",$tmpl);
        // $this->template->title('Registration');
        $data['tmpl'] = $tmpl;
        $data['title'] = 'Registration';
        $this->_set_rules();
        //$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|callback_user_exists');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');
		//$this->form_validation->set_rules('password', 'lang:web_password', 'min_length[6]|max_length[20]|matches[password_confirm]');
		//$this->form_validation->set_rules('password_confirm', 'lang:web_password_confirm', '');
        if($this->form_validation->run() === FALSE)
      	{		
			if((!empty($_POST['submit2'])))
			{
			redirect(base_url());
			}
			else
			{
				$this->load->view('new_template_design/header', TRUE);
           		$this->load->view('user/registration', $data);
           		$this->load->view('new_template_design/footer');
				// $this->template->build('user/registration');
			}
			//$this->template->build('template/classic/slider1');
      	}
      	else
        {
			/*********** Activation Code **********/
			$activationcode=$this->getActivationCode();
			$activationcode=md5($activationcode);
			/*********** Activation Code End **********/
            $data = array(
      			'username'		=>	$this->input->post('email'),
      			'email'			=>	$this->input->post('email'),
      			'first_name' 	=> 	$this->input->post('first_name'),
      			'last_name' 	=> 	$this->input->post('last_name'),
      			'images'        =>  '',
                'active' 	    =>  '0',
				'is_student' 	=>  '1',//one is for yes
				'is_instructor'	=>  '0',//zero is for no
                'created_at' 	=>  date('Y-m-d H:i:s'),
                'password' 		=>  md5($this->input->post('password')),
                'activation_code' =>  $activationcode,
                'group_id' 		=>  '1',
                'webstatus' 	=> 	$this->input->post('webinarstatus')
			);
			$usergroups = '1';
			$insertid = $this->login_model->insertItems($data);
			 
			if($insertid > 1)
			{
				$user_id = $this->login_model->maxuserid();
				$group_data = array(
					'user_id'		=>	$insertid,
					'group_id'      =>  $usergroups
				);
				$this->login_model->insertUserGroup($group_data);
			}
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			$fstuser = ucfirst($this->input->post('first_name'));

		// 	$urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
			if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
		// New Registration Send To User
		$subject = "Activate your account, ".$fstuser;
		$toemail = $this->input->post('email');
		$userdata1=$this->login_model->getUserInfoByEmail($toemail);
		$link=base_url().'users/activate_account/'.$activationcode;
		$content = '';
		//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
		$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Activate your account, '.$fstuser.'</p>';
		$content .= '<p>Hi '.trim($fstuser).',<br /><br />';
		$content .= 'Please confirm your "'.$configarr[0]['institute_name'].'" account.<br /><br />';
		$content .= 'Please Click on link to activate your account <br />';
		$content .= '<a style="color: #55c5eb;" class="btn" href ='.$link.'>Confirm now</a><br /><br />';
		$content .= 'OR  <br /><br />';
		$content .= 'Paste the Url in your browser. <br /><br />';
		$content .= '<a style="color: #55c5eb;" href ='.$link.'>'.$link.'</a><br /><br />';
		$content .= 'Once you confirm, you will have full access to "'.$configarr[0]['institute_name'].'" and all the future notifications will be sent to this email address.<br />';
		// $content .= '<br /><br />';
		// $content .= '...</p>';
		// $content .= $configarr[0]['signature'].'</p>';
        $data['content'] = $content; 
							$data['fromemail'] = $urldomain;
		$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
		//$fromemail=$configarr[0]['fromemail'];// admin mail		
		$fromemail = $urldomain;
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
		$this->email->subject($subject);
		$this->email->to($toemail);
		$this->email->message($message);
		//$this->email->send();
		if($this->email->send())
		{
			$maildetails = array('emailsent' => 1, );

			$this->login_model->emailsent($insertid,$maildetails);
		}
		//new code start
		/*$this->load->library('email');
		//$this->email->set_mailtype("html");
		//$this->email->set_newline("\r\n");
		//$email_body = "<a href='".$link."'>Link</a> ";		
		//$email_body.= "<p>'".$configarr[0]['institute_name']."'</p>";        
		//$fromemail='prshah83@gmail.com';		
		$this->email->from('sachengawai@gmail.com','Prashant');
		$this->email->subject('subject vfgvf');
		$this->email->to("sachin.g@veerit.com");
		$this->email->message("test");
		$this->email->send();*/
		
		//new code end
		
		$admininfo = $this->login_model->getadminInfo(4);
		//Mail To Admin For New Registration
		$subject = 'Student '.$configarr[0]['institute_name'].' registered to your academy';
		$toemail = $admininfo->email;// admin mail
		$content = '';	
		$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Student '.trim(ucfirst($admininfo->first_name)).' registered to your academy</p>';
		$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
		$content .= '<p>'.trim(ucfirst($this->input->post('first_name'))).' '.trim(ucfirst($this->input->post('last_name'))).' has registered in your Academy.<br />';
		// $content .='<br /><br />';
		// $content .='...</p>';
		// $content .= $configarr[0]['signature'].'</p>';
        //$message = $content;
        $data['content'] = $content; 
							$data['fromemail'] = $urldomain;
		$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
		//$fromemail=$configarr[0]['fromemail'];// admin mail	
		$fromemail = $urldomain;
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
		$this->email->subject($subject);
		$this->email->to($toemail);
		$this->email->message($message);
		$this->email->send();	
        $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Registered Successfully, Account Activation Link has been Sent To Your Mail,Please Check Your Mail') );
		redirect('users/login');
		}
	}
	
	public function thank_you(){
		$lasturl = $this->session->userdata('lasturl');
		$data = array('lasturl' => $lasturl);
		$this->load->view('new_template_design/header');
		$this->load->view('new_template_design/register_thanks',$data);
		$this->load->view('new_template_design/footer');
	}

	function registrationPopup()
	{
		$this->load->model('admin/settings_model');
		$this->load->model('login_model');
		$fname = trim($_POST['firstname']);
		$a = trim($_POST['email']);
		$password = trim($_POST['password']);
		$lasturl = $this->input->post('lasturl');
		$this->session->set_userdata('lasturl',$lasturl);
		$lenpass =strlen($password);
		$mobile = null;
		$email = null;
		if(is_numeric($a))
		{
			$mobile = $a;
		}
		else
		{
			$email = strtolower($a);
		}
		if($email != null)
		{
			$check_email = $this->Crud_model->get_single('mlms_users',"email = '".$email."'");
			if(!empty($check_email))
			{
				echo "Failed";exit;
			}
		}
		if($mobile != null)
		{
			$check_mobile = $this->Crud_model->get_single('mlms_users',"mobile = ".$mobile);
			if(!empty($check_mobile))
			{
				echo "Failed1";exit;
			}
		}

		$activationcode = $this->getActivationCode();
		$activationcode = md5($activationcode);
		$dataaa = array(
  			'username'		=>	$a,
  			'email'			=>	$email,
  			'first_name' 	=> 	$fname,
  			// 'last_name' 	=> 	$lname,
  			'images'        =>  '',
            'active' 	    =>  '1',
			'is_student' 	=>  '1',//one is for yes
			'is_instructor'	=>  '0',//zero is for no
            'created_at' 	=>  date('Y-m-d H:i:s'),
            'password' 		=>  md5($password),
            'activation_code'=>  $activationcode,
            'group_id' 		=>  '1',
            'webstatus' 	=> 	'',
            'mobile'		=> $mobile
		);
		$usergroups = '1';
		$insertid = $this->login_model->insertItems($dataaa);
		 
		if($insertid > 1)
		{
			$user_id = $this->login_model->maxuserid();
			$group_data = array(
				'user_id'		=>	$insertid,
				'group_id'      =>  $usergroups
			);
			$this->login_model->insertUserGroup($group_data);
		}
		$email = strtolower($a);
		$result = $this->login_model->newvalidate($email, $password);
		if($result== true){
			$dataNew= $this->login_model->setSessionData($email,$password);
			$this->session->set_userdata('logged_in',$dataNew);

			$user_id = $insertid;
			$coupon_code = $this->session->userdata('coupon_code');
			$course_id = $this->session->userdata('crs_id');
	    	if(!empty($coupon_code))
	    	{
		        $newdata = array(
							'course_id' => $course_id,
							'student_name' => $user_id,
							'status' => "Redeemed",
		                    'modified' => date('Y-m-d H:i:s')
				);
				$con1 = "coupon_code = '".$coupon_code."' AND status = 'Unused'"; 
				$this->Crud_model->SaveData('mlms_reseller_coupon',$newdata,$con1);

				$this->load->model('reseller_model');
		        $con = "rc.coupon_code = '".$coupon_code."'";        
		        $get_code = $this->reseller_model->get_redeem_code($con);

		        if(!empty($get_code))
		        {
		          	$order = array(
		                        'userid' => $user_id,
		                        'order_date' => date('Y-m-d H:i:s'),
		                        'courses' => $get_code->course_id,
		                        'status' => 'SUCCESS',
		                        'pending_reason' => 'New Order',
		                        'amount' => $get_code->fixedrate,
		                        'amount_paid' => $get_code->fixedrate,
		                        'processor' => 'Cash',
		                        'currency' => 'INR',
		                        'published' => 1,
		                        'transactionid' => $coupon_code,
		                        'order_status' => 'New Order',
		                        'referred_code' => $get_code->referral_code,
		          	);
		          	$this->Crud_model->SaveData('mlms_order',$order);
		          	$order_id = $this->db->insert_id();

		          	$buy_course = array(
		                        'userid' => $user_id,
		                        'order_id' => $order_id,
		                        'course_id' => $get_code->course_id,
		                        'price' => $get_code->fixedrate,
		                        'currency' => "INR",
		                        'buy_date' => date('Y-m-d H:i:s'),
		                        'finalexam_status' => "notgiven"
		          	);
			        $this->Crud_model->SaveData('mlms_buy_courses',$buy_course);
			        if($get_code->reseller_id != $get_code->author)
			        {
			            $reseller_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->reseller_id);
			            $rcom = floatval($get_code->fixedrate) * floatval($get_code->assessment) /100 ;
			            $reseller_total = floatval($reseller_payout->total_amount) + floatval($rcom);
			            $reseller_paid = floatval($reseller_payout->paid_amount) + floatval($rcom);
			            $reseller = array(
			                          'total_amount' => $reseller_total,
			                          'paid_amount' => $reseller_paid,
			                          'modified' => date('Y-m-d H:i:s')
			            );
			            $this->Crud_model->SaveData('mlms_payout',$reseller,"user_id =".$get_code->reseller_id);

			            $pay_log = array(
			                            'payout_id' => $reseller_payout->id,
			                            'user_id' => $get_code->reseller_id,
			                            'pay_mode' => 'Cash',
			                            'paid_amount' => $rcom,
			                            'paid_date' => date('Y-m-d H:i:s'),
			                            'memo' => "Payment automatically SETTLED in case of Offline selling a course.",
			            );
			            $this->Crud_model->SaveData('mlms_payout_log',$pay_log);
			            
			            $log_comm1 = array(
			                          'order_id' => $order_id,
			                          'reseller_id' => $get_code->reseller_id,
			                          'commission' => $rcom,
			                          'comm_percent' => $get_code->assessment,
			                          'created' => date("Y-m-d H:i:s")
			            );
			            $this->Crud_model->SaveData('mlms_commission_log',$log_comm1);

			            // teacher commision
			            $teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->author);
				          $tcom = floatval($get_code->fixedrate) * (floatval($get_code->coursepercent) - floatval($get_code->assessment)) /100 ;

				          $teacher_total = floatval($teacher_payout->total_amount) + floatval($tcom);
				          $teacher_paid = floatval($teacher_payout->paid_amount) + floatval($tcom);

				          $teacher = array(
				                        'total_amount' => $teacher_total,
				                        'paid_amount' => $teacher_paid,
				                        'modified' => date('Y-m-d H:i:s')
				          );
				          $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id =".$get_code->author);
				          $log_comm2 = array(
				                        'order_id' => $order_id,
				                        'reseller_id' => $get_code->author,
				                        'commission' => $tcom,
				                        'comm_percent' => (floatval($get_code->coursepercent) - floatval($get_code->assessment)),
				                        'created' => date("Y-m-d H:i:s")
				          );
				          $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);

				          $amount_liable = floatval($get_code->fixedrate) - floatval($rcom);
				          $offline_payment = array(
				                        'reseller_id' => $get_code->reseller_id,
				                        'order_id' => $order_id,
				                        'amount' => round(floatval($amount_liable),2)
				          );
				          $this->Crud_model->SaveData('mlms_offline_payment',$offline_payment);
			        }
			        else{
			        	$teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->author);
				        $tcom = floatval($get_code->fixedrate) * floatval($get_code->coursepercent) /100 ;
				        $teacher_total = floatval($teacher_payout->total_amount) + floatval($tcom);
				        $teacher_paid = floatval($teacher_payout->paid_amount) + floatval($tcom);

				        $teacher = array(
			                        'total_amount' => $teacher_total,
			                        'paid_amount' => $teacher_paid,
			                        'modified' => date('Y-m-d H:i:s')
				        );
				        $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id =".$get_code->author);
				        $log_comm2 = array(
			                        'order_id' => $order_id,
			                        'reseller_id' => $get_code->author,
			                        'commission' => $tcom,
			                        'comm_percent' => $get_code->coursepercent,
			                        'created' => date("Y-m-d H:i:s")
				        );
				        $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);

				        $amount_liable = floatval($get_code->fixedrate) - floatval($tcom);
				        $offline_payment = array(
			                        'reseller_id' => $get_code->author,
			                        'order_id' => $order_id,
			                        'amount' => round(floatval($amount_liable),2)
				        );
				        $this->Crud_model->SaveData('mlms_offline_payment',$offline_payment);
				    }
				    $getcourse = $this->Crud_model->get_single('mlms_program',"id = ".$get_code->course_id,"name,slug,id");
			    	$this->session->set_userdata('msg_redeem', 'Congratulations');
			    	$this->session->unset_userdata('coupon_code');
					$this->session->unset_userdata('crs_id');
		          	echo base_url().$getcourse->slug.'/lectures/'.$getcourse->id;exit;
		        }
		    }
		}

		echo 'success';		
			
			$configarr = $this->settings_model->getItems();	 
			// New Registration Send To User
			// $subject = 'Welcome to '.$configarr[0]['institute_name'];
			// $toemail = $email; //$email
			// $userdata1 = $this->login_model->getUserInfoByEmail($toemail);
			// $link = base_url().'users/activate_account/'.$activationcode;
			// $content = '';
			// //$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
			// $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">Welcome to '.$configarr[0]['institute_name'].'</h6>';
			// $content .= '<p>Dear '.$fname.' '.$lname.',<br /><br />';
			// $content .= $configarr[0]['institute_name'].' has a course to help you get there faster.<br /><br />';
			// $content .= 'Please Click on link to activate your account <br /><br />';
			// $content .= $link.'<br /><br />';
			// $content .= 'If you need help or have any questions, please contact us.<br /><br />';
			// //$content .= 'Best regards,<br /><br />';
			// //$content .= $configarr[0]['institute_name'].'</p>';
			// $content .= $configarr[0]['signature'].'</p>';
			// $data['content'] = $content;
			// $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
			// $fromemail = $configarr[0]['fromemail'];// admin mail	
			// $config['charset'] = 'utf-8';
			// $config['mailtype'] = 'html';
			// $config['wordwrap'] = TRUE;
			// $this->email->initialize($config);
			// $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
			// $this->email->subject($subject);
			// $this->email->to($toemail);
			// $this->email->message($message);
			// $this->email->send();
		// 	$urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
			if($configarr[0]['fromemail'])  
        			$urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

			$subject = "Activate your account, ".trim(ucfirst($fname));
		$toemail = $this->input->post('email');
		$userdata1=$this->login_model->getUserInfoByEmail($toemail);
		$link=base_url().'users/activate_account/'.$activationcode;
		$content = '';
		//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
		$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Activate your account, '.trim(ucfirst($fname)).'</p>';
		$content .= '<p>Hi '.trim(ucfirst($fname)).',<br /><br />';
		$content .= 'Please confirm your "'.$configarr[0]['institute_name'].'" account.<br /><br />';
		$content .= 'Please Click on link to activate your account <br /><br />';
		$content .= '<a style="color: #55c5eb;" class =btn href ='.$link.'>Confirm now</a><br /><br />';
		$content .= 'OR <br /><br />';
		$content .= 'Paste the Url in your browser <br />';
		$content .= '<a style="color: #55c5eb;" href ='.$link.'>'.$link.'</a><br /><br />';
		$content .= 'Once you confirm, you will have full access to "'.$configarr[0]['institute_name'].'" and all the future notifications will be sent to this email address.<br />';
		// $content .= '<br /><br />';
		// $content .= '...</p>';
		// $content .= $configarr[0]['signature'].'</p>';
        $data['content'] = $content; 
							$data['fromemail'] = $urldomain;
		$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
		//$fromemail=$configarr[0]['fromemail'];// admin mail		
		$fromemail = $urldomain;
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
		$this->email->subject($subject);
		$this->email->to($toemail);
		$this->email->message($message);
		// $this->email->send();
		if(!is_numeric($a))
		{
			if($this->email->send())
			{
				$maildetails = array('emailsent' => 1, );
				$this->login_model->emailsent($insertid,$maildetails);
			}
		}
             
			$admininfo = $this->login_model->getadminInfo(4);
             // New Registration Send To Admin
			$subject = 'Student '.trim(ucfirst($fname)).' registered to your academy';
			$toemail = $admininfo->email; // prshah83@gmail.com
			$userdata1 = $this->login_model->getUserInfoByEmail($toemail);
			$link = base_url().'users/activate_account/'.$activationcode;
			$content = '';
			$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Student '.trim(ucfirst($fname)).' registered to your academy</p>';
			//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
			//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">Welcome to '.$configarr[0]['institute_name'].'</h6>';
			$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
			$content .= trim(ucfirst($fname)).' '.' has register in your Academy.<br />';
			// $content .= '<br /><br />';
			// $content .= '...</p>';
			// $content .= $configarr[0]['signature'].'</p>';
			$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
			$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
			//$fromemail = $configarr[0]['fromemail'];// admin mail		
			$fromemail = $urldomain;
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;
			$this->email->initialize($config);
			$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
			$this->email->subject($subject);
			$this->email->to($toemail);
			$this->email->message($message);
			$this->email->send();
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Registered Successfully, Account Activation Link has been Sent To Your Mail,Please Check Your Mail') );		
		
		/*$prstatus = "hi";
		$data = array(
					'prstatus' => $prstatus
		);
		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $prstatus) );
		redirect(base_url(),$data);*/
	}

/************ Getting Activation Code ************** */

function getActivationCode() 
{
    //srand ((double) microtime( )*1000000);
    $digits = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 0 ,1, 2, 3, 4, 5, 6, 7, 8, 9, 0 );
    shuffle($digits);
    $actcode = 0;
    for($i = 0; $i < 9; $i++)
    {
        if($i == 0)
        {
            while($digits[0] == 0)
                shuffle($digits);
        }
        /*if($i >= 2)
        {
            while(($random_agtno % 100) == $digits[0])
                shuffle($digits);
        }*/
        $actcode *= 10;
        $actcode += $digits[0];
        array_splice($digits, 0, 1);
    }
    if($this->checkActCode($actcode))
    {
        $this->getActivationCode();
    }
    return $actcode;
}

function checkActCode($rpno)
{
    return $this->login_model->checkActivationCode($rpno);
}

/******** Getting Activation Code End **********/
function user_exists($username) 
{
    $user_check = $this->login_model->checkUserName($username);
	if($user_check > 0) 
	{
        $this->form_validation->set_message('user_exists', 'This username is already taken');
    return FALSE;
    }
    else 
	{
        return TRUE;
    }
}

function email_exists($email) 
{
    $check_email = $this->login_model->email_exists($email);
    if($check_email > 0) 
	{
        $this->form_validation->set_message('email_exists', 'This email is already in use');
        return FALSE;
    }
    else 
	{
        return TRUE;
    }
}

      function login_user()
           {
             $this->load->model('admin/settings_model');      $configarr = $this->settings_model->getItems();	  $tmpl = $configarr[0]['layout_template'];      $this->template->set("tmpl",$tmpl);
           $this->template->title('Login');
           $this->template->build('user/login_user');
           $email = $this->input->post('email');
           $password = $this->input->post('password');

           $result = $this->login_model->validate($email, $password);
          // print_r($result);
           if($result)
             {
              if($this->session->userdata('logged_in')){
              // print_r($this->session->userdata('logged_in'));exit;
              $auth = $this->session->userdata('logged_in');
              $data['username'] = $auth['username']; ?>
                   <script type="text/javascript">
      				parent.jQuery.fancybox.close();
      			   //	window.parent.location.href = "<?php echo base_url(); ?>/category/";
      				</script>
                   <?php //redirect('category/');

                   }else{ ?>
                     <script type="text/javascript">
      				parent.jQuery.fancybox.close();
      			   //	window.parent.location.href = "<?php echo base_url(); ?>/category/";
      				</script>
                  <?php }

             } ?>
               <script type="text/javascript">
      				parent.jQuery.fancybox.close();
      			   //	window.parent.location.href = "<?php echo base_url(); ?>/category/";
      				</script>

          <?php 
    }

    function logout() 
    {
    	
		$sessionarray = $this->session->all_userdata();
		if(@$sessionarray['isfblogin'] == 1)
		{
			redirect('hauth/logout/Facebook');
		}
		  
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('last_page_url');
        $this->session->set_userdata(array('username' => ''));
        $this->session->unset_userdata('maccessarr');
        $this->session->sess_destroy();

        //backend logout
	    $this->session->sess_destroy();
	    $this->session->unset_userdata('loggedin');
	    $this->session->unset_userdata('mparr');
	    $this->session->unset_userdata('Active_menu');
	    $this->load->helper('cookie');
	    
	   
		$days = 2;
		$date_of_expiry = time() - 60 * 60 * 24 * $days ;
		setcookie("referral_code", '',$date_of_expiry,'TRUE');

	    redirect(base_url());
    }

	private function _set_rules($type = 'create', $id = NULL)
	{
		//validate form input
		$this->form_validation->set_rules('first_name', 'lang:web_name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'lang:web_lastname', 'required|xss_clean');

		if ($id)
		{
			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[users.email.id.'.$id.']|xss_clean');
		}
		else
		{
			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[users.email]|xss_clean');
		}

		if ($type == 'edit')
			$this->form_validation->set_rules('password', 'lang:web_password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');
		else
			$this->form_validation->set_rules('password', 'lang:web_password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');

		if ($type == 'edit')
			$this->form_validation->set_rules('password_confirm', 'lang:web_password_confirm', '');
		else
			$this->form_validation->set_rules('password_confirm', 'lang:web_password_confirm', 'required');

		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
	}
	
	//forgot password
	function forgot_password()
	{
		redirect();
    	$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		// $this->template->set("tmpl",$tmpl);
        $rmsg='';
		// $this->template->set("resetmsg", $rmsg);
		// $this->template->title('Forgot Password');
		$data['tmpl'] = $tmpl;
		$data['resetmsg'] = $rmsg;
		$data['title'] = 'Forgot Password';
		$this->form_validation->set_rules('email','Email ID', 'required|trim|clean_xss|valid_email');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('new_template_design/header', TRUE);
			           $this->load->view('user/forgot_password', $data);
			           $this->load->view('new_template_design/footer');
			// $this->template->build('user/forgot_password');
		}
		else
		{
			$email_id = $this->input->post('email');
			$email_exist = $this->login_model->email_exists($email_id);
			
			if($email_exist)
			{	
				// $urldomain = base_url();
				// $urldomain = str_replace('https://', '', $urldomain);
				// $urldomain = str_replace('/', '', $urldomain);
				// $urldomain = str_replace('www.', '', $urldomain);
				if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

				$user_info = $this->login_model->getUserInfoByEmail($email_id);

				$subject = 'Reset your password - '.$configarr[0]['institute_name'];
				$toemail = $this->input->post('email');
				$userdata1 = $this->login_model->getUserInfoByEmail($toemail);
				$randpassword = $this->createRandomUniquePasswordNo();
				$this->login_model->updatelostpw($randpassword,$userdata1->id);
				$randpassword = md5($randpassword);
				//$link=base_url().'users/reset_password/'.$userdata1->id;
				$link = base_url().'users/mlmsreset_password/'.$randpassword;
				$content = '';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Reset your password - '.$configarr[0]['institute_name'].'</p>';
				$content .= 'Hello '.trim(ucfirst($user_info->first_name)).',<br/><br/>';
				$content .= 'Click on link to reset password<br/><br />';
				$content .= '<a style="color:#55c5eb" href="'.$link.'">'.$link.'</a><br/><br />';
				$content .= 'If you need help or have any questions, please contact us.<br/>';
				// $content .= '<br /><br />';
		  //       $content .= '...</p>';
		  //       $content .= $configarr[0]['signature'].'</p>';
				$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
				$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
				
				//$message = '<a href="'.$link.'">Click on link to reset password</a>';
				//$fromemail = $configarr[0]['fromemail'];// admin mail
				$fromemail = $urldomain;
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject);
				$this->email->to($toemail);
				//$this->email->cc('vikas.gorle@veerit.com');
				$this->email->message($message);
				if($this->email->send())
				{
					/* echo "Mail sent successfully to ".$toemail; */
					$rmsg = "Reset password link has been sent to your email";
					// $this->template->set("resetmsg", $rmsg);
							$data['resetmsg'] = $rmsg;
						$this->load->view('new_template_design/header', TRUE);
			           $this->load->view('user/forgot_password', $data);
			           $this->load->view('new_template_design/footer');
					// $this->template->build('user/forgot_password');
				}
				else
				{
					/* echo "Unable to sent mail to ".$toemail .'<br />'.$this->email->print_debugger(); */
					// $this->template->build('user/forgot_password');
					$this->load->view('new_template_design/header', TRUE);
			           $this->load->view('user/forgot_password', $data);
			           $this->load->view('new_template_design/footer');
				}
			}
			else
			{
				$rmsg="Email Id not available in the records";
				// $this->template->set("resetmsg", $rmsg);
						$data['resetmsg'] = $rmsg;
						$this->load->view('new_template_design/header', TRUE);
			           $this->load->view('user/forgot_password', $data);
			           $this->load->view('new_template_design/footer');
				// $this->template->build('user/forgot_password');
			}
		}
	}
	
	//forgot password Popup
	function forgetPasswordPopup()
	{   
    	$this->load->model('admin/settings_model');    	      
		$configarr = $this->settings_model->getItems();	  
		//$tmpl = $configarr[0]['layout_template'];		    
		$email_id = trim($_POST['emailForget']);
		$email_exist = $this->login_model->email_exists_ajax($email_id);
			// print_r($email_exist);
			if($email_exist)
			{
		// 		$urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
				if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
		
				$user_info = $this->login_model->getUserInfoByEmail($email_id);

				$subject = 'Reset your password - '.$configarr[0]['institute_name'];
				$toemail = $_POST['emailForget'];
				$userdata1 = $this->login_model->getUserInfoByEmail($toemail);
				$randpassword = $this->createRandomUniquePasswordNo();
				$this->login_model->updatelostpw($randpassword,$userdata1->id);
				$randpassword = md5($randpassword);
				//$link=base_url().'users/reset_password/'.$userdata1->id;
				$link = base_url().'users/mlmsreset_password/'.$randpassword;
				$content = '';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Reset your password - '.$configarr[0]['institute_name'].'</p>';
				$content .= 'Hello '.trim(ucfirst($user_info->first_name)).',<br/><br/>';
				$content .= 'Click on link to reset password<br/><br/>';
				$content .= '<a style="color:#55c5eb" href="'.$link.'">'.$link.'</a><br/><br/>';
				$content .= 'If you need help or have any questions, please contact us.<br/>';
				// $content .= '<br /><br />';
		  //       $content .= '...</p>';
		  //       $content .= $configarr[0]['signature'].'</p>';
				$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
				$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
				
				//$fromemail = $configarr[0]['fromemail'];// admin mail
				$fromemail = $urldomain;
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject);
				$this->email->to($toemail);
				$this->email->message($message);
				if($this->email->send())
				{
					//echo $rmsg = "Reset password link has been sent to your email";
					/*$this->template->set("resetmsg", $rmsg);
					$this->template->build('user/forgot_password');*/
					echo "success";
				}
				else
				{
					//$this->template->build('user/forgot_password');
				}
			}
			else
			{
				//echo $rmsg="Email Id is not available in the records";
				/*$this->template->set("resetmsg", $rmsg);
				$this->template->build('user/forgot_password');*/
				echo 'denied';
			}			
		return true;
	}	
	

	function check_emailexiste($email)
	{
		if($this->login_model->checkUserName($email))
		{
		return true;
		}
		return false;
	}

	function createRandomUniquePasswordNo() 
	{
		//srand ((double) microtime( )*1000000);
		$digits = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 0 ,1, 2, 3, 4, 5, 6, 7, 8, 9, 0 );
		shuffle($digits);
		$random_pass = 0;
		for($i = 0; $i < 9; $i++)
		{
			if($i == 0)
			{
				while($digits[0] == 0)
					shuffle($digits);
			}
			/*if($i >= 2)
			{
				while(($random_agtno % 100) == $digits[0])
					shuffle($digits);
			}*/
			$random_pass *= 10;
			$random_pass += $digits[0];
			array_splice($digits, 0, 1);
		}
		if($this->checkRanPassExiste($random_pass))
		{
			$this->createRandomUniquePasswordNo();
		}
		return $random_pass;
	}

	function checkRanPassExiste($rpno)
	{
		return $this->login_model->checkRanExiste($rpno);
	}

	function mlmsreset_password()
	{
		$this->load->model('admin/settings_model');      $configarr = $this->settings_model->getItems();	  $tmpl = $configarr[0]['layout_template'];      $this->template->set("tmpl",$tmpl);
		$prstatus=''; 
		$userid=$this->uri->segment(3,1);
	
		$this->template->set("userid", $userid); 
		$this->template->set("prstatus", $prstatus);
		$this->template->title('Reset Password');
		//$this->form_validation->set_rules('pass','Password', 'required|trim|clean_xss');
		
		$this->form_validation->set_rules('pass','Password', 'required|trim|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|xss_clean');
		
		$this->form_validation->set_rules('cfpass','Confirm Password', 'required|trim|clean_xss|matches[pass]');
		if ($this->form_validation->run() == FALSE)		
		{
			$this->template->build('user/reset_password');
		}
		else
		{
			$uid=$this->input->post('uid');
			$this->login_model->updatePassword($uid);
			$prstatus = 'Your password reset successfully';
			//$this->template->set("prstatus", $prstatus);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $prstatus) );
			redirect('users/login');
		}
	}

	public function reset_password($code)
	{
		$reset = $this->sangar_auth->forgotten_password_complete($code);

		if ($reset)
		{
			//if the reset worked then send them to the login page
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('password_change_successful')) );
			redirect("/login", 'refresh');
		}
		else
		{
			//if the reset didnt work then send them back to the forgot password page
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('password_change_unsuccessful')) );
			redirect("/forgot_password", 'refresh');
		}
	}

    public function activate_account()
    {
		$activecode=$this->uri->segment(3,1);
	
		if($this->login_model->checkActivationCode1($activecode))
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Account Activated Successfully. Please Login') );
			redirect("users/login");
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Activation Failed !') );
			redirect("users/login");
		}
    }

    public function view_frontsite()
    {
         $u_data=$this->session->userdata('logged_in');
         if($this->session->userdata('loggedin'))
         {
         	$this->session->unset_userdata('loggedin');
         }
         $this->session->set_userdata('loggedin',$u_data);
         $datanew = $this->session->userdata('loggedin');       
        return true; 
        //redirect('admin');
    }

    public function mainLogin()
	{
	
		if($this->session->userdata('logged_in'))
		{
			 redirect('myinfo/myaccount');
			//redirect(base_url());
		}
		
		$email = $_GET['eml'];
		
		$first1 = $this->login_model->first_time_login_main($email);
			 
				//$password = md5($_POST['strPassword'],TRUE);  
		if($first1)
		{	
		$result = $this->login_model->newvalidateMain($email);
		
		$courses_from_cart = $this->session->userdata('courses_from_cart');
        $login_page_url = $_SERVER["REQUEST_URI"];
		if($result == true)       
		{	

			 $last_page_url = $this->session->userdata('last_page_url');

			$dataNew= $this->login_model->setSessionDataMain($email);
			
			$this->session->set_userdata('logged_in',$dataNew);
			$this->session->set_userdata('loggedin',$dataNew);
			// echo"<pre>";
			// print_r($this->session->userdata('logged_in'));
			//echo 'success';	
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
							// $urldomain = str_replace('https://', '', $urldomain);
							// $urldomain = str_replace('/', '', $urldomain);
							// $urldomain = str_replace('www.', '', $urldomain);
							if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

							$this->load->model('admin/settings_model');
							$configarr = $this->settings_model->getItems();
							$this->template->set("configarr", $configarr);
							$subject = 'Welcome to '.$configarr[0]['institute_name'];
							$toemail = $email;
							$content = '';
							$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							$content .= '<p>Dear '.trim(ucfirst($first->first_name)).' '.trim(ucfirst($first->last_name)).',<br /><br />';
							$content .= 'Welcome to '.$configarr[0]['institute_name'].'. We are glad to have you on board!<br /><br />';
							$content .= 'You can now find out and subscribe to the courses as per your requirements, participate in discussions with your fellow students and teachers and also attend Webinars or live online classes during the courses.<br /><br />';
							$content .= '<a href = "'.base_url().'" >Discover Courses Now</a>.<br /><br />';							
							$content .= 'If you need help or have any questions, please contact us.<br />';
							// $content .= '<br /><br />';
							// $content .='...</p>';
							//  $content .= $configarr[0]['signature'].'</p>';
							$data['content'] = $content; 
							$data['fromemail'] = $urldomain;
					        $message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
							//$fromemail=$configarr[0]['fromemail'];// admin mail
							$fromemail = $urldomain;
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
                            
                            redirect(base_url());
							//echo 'success';
                        }
						else
						{
                           
						   echo 'success123';
                        }
                    }
                }
				else
				{
                    //redirect('category/');
					echo 'success';
                }


			
		}
		else
		{		
			echo 'denied';
		}       
		//return true;
	}
	return true;
	}
    
     public function mainLoginAdmin()
	{
	
		if($this->session->userdata('loggedin'))
		{
			 redirect('admin');
			//redirect(base_url());
		}
		
		$email = $_GET['eml'];
		
		$first1 = $this->login_model->first_time_login_main($email);
			// echo"<pre>";
			// echo $first1->group_id; exit();
				//$password = md5($_POST['strPassword'],TRUE);  
		if($first1)
		{
			if($first1->group_id == 4)
				{
		$result = $this->login_model->newvalidateMain($email);
		
		$courses_from_cart = $this->session->userdata('courses_from_cart');
        $login_page_url = $_SERVER["REQUEST_URI"];
		if($result == true)       
		{	

			 $last_page_url = $this->session->userdata('last_page_url');

			$dataNew= $this->login_model->setSessionDataMain($email);
			
			$this->session->set_userdata('loggedin',$dataNew);
			
			// echo"<pre>";
			// print_r($this->session->userdata('loggedin'));
			//echo 'success';	
				if($this->session->userdata('loggedin'))
				{
                    $auth = $this->session->userdata('loggedin');
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
							// $urldomain = str_replace('https://', '', $urldomain);
							// $urldomain = str_replace('/', '', $urldomain);
							// $urldomain = str_replace('www.', '', $urldomain);
							if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

							$this->load->model('admin/settings_model');
							$configarr = $this->settings_model->getItems();
							$this->template->set("configarr", $configarr);
							// $subject = 'Welcome to '.$configarr[0]['institute_name'];
							// $toemail = $email;
							// $content = '';
							// $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							// $content .= '<p>Dear '.trim(ucfirst($first->first_name)).' '.trim(ucfirst($first->last_name)).',<br /><br />';
							// $content .='Thanks For Login, Now Academy is opened for you.<br /><br />';
							// $content .='<br /><br />';
							// $content .='...</p>';
							//  $content .= $configarr[0]['signature'].'</p>';
							// $data['content'] = $content;
					  //       $message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
							// //$fromemail=$configarr[0]['fromemail'];// admin mail
							// $fromemail = $urldomain;
							// $config['charset'] = 'utf-8';
							// $config['mailtype'] = 'html';
							// $config['wordwrap'] = TRUE;
							// $this->email->initialize($config);
							// $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
							// $this->email->subject($subject);
							// $this->email->to($toemail);
							// $this->email->message($message);
							// $this->email->send();		
												
							$this->login_model->update_first_users($email);						
						}
						
                        if($last_page_url == '')
						{
                            
                            redirect('admin');
							//echo 'success';
                        }
						else
						{
                           redirect('admin');
						   //echo 'success123';
                        }
                    }
                }
				else
				{
                    redirect('admin');
					//echo 'success';
                }


			
		}
		else
		{		redirect('admin');
			//echo 'denied';
		}       
		//return true;
	}
	else
	{
	redirect(base_url());	
	}
	}
	return true;
	}

public function emailsent()
{
	// New Registration Send To User
		$userid = $_POST['id'];

		$activationcode=$this->getActivationCode();
		$activationcode=md5($activationcode);

        $udateuserData = $this->login_model->updateActivationCode1($activationcode,$userid);

		$configarr = $this->settings_model->getItems();

		// $urldomain = base_url();
		// $urldomain = str_replace('https://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
		if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
		
		$getUserDetail = $this->login_model->getUserDetails($userid);
		
		$subject = "Activate your account, ".$getUserDetail->first_name.' '.$getUserDetail->last_name;
		$toemail = $getUserDetail->email;
		
		$link=base_url().'users/activate_account/'.$activationcode;
		$content = '';		
		$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Activate your account, '.$getUserDetail->first_name.' '.$getUserDetail->last_name.'</p>';
		$content .= '<p>Hi '.trim($getUserDetail->first_name).',<br /><br />';
		$content .= 'Please confirm your "'.$configarr[0]['institute_name'].'" account.<br /><br />';
		$content .= 'Please Click on link to activate your account <br />';
		$content .= '<a style="color: #55c5eb;" class="btn" href ='.$link.'>Confirm now</a><br /><br />';
		$content .= 'OR  <br /><br />';
		$content .= 'Paste the Url in your browser. <br /><br />';
		$content .= '<a style="color: #55c5eb;" href ='.$link.'>'.$link.'</a><br /><br />';
		$content .= 'Once you confirm, you will have full access to "'.$configarr[0]['institute_name'].'" and all the future notifications will be sent to this email address.<br />';
		
        $data['content'] = $content; 
							$data['fromemail'] = $urldomain;
		$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
				
		$fromemail = $urldomain;
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
		$this->email->subject($subject);
		$this->email->to($toemail);
		$this->email->message($message);
		if($this->email->send())
		{
			$maildetails = array('emailsent' => 1, );

			$this->login_model->emailsent($getUserDetail->id,$maildetails);
			echo"success";
		}
	}

	public function check_dup()
	{
		/*$email = $this->input->post('email');
		
		$get_res = $this->Crud_model->get_single('mlms_users',"email ='".$email."'");
		if(!empty($get_res))
		{
			print_r("0");
		}
		else
		{
			print_r("1");
		}*/
		$email = $this->input->post('email');
		$mobile = $this->input->post('contact_no');
	    // $check_email = $this->login_model->email_exists($email);
	    $checkmobile = $this->Crud_model->get_single('mlms_users',"mobile = '".$mobile."'",'mobile');

	    $get_res = $this->Crud_model->get_single('mlms_users',"email ='".$email."'");
		if(!empty($get_res))
		{
			echo "1";
		}
	    else if(!empty($checkmobile))
	    {
	    	echo "2";
	    }
	    else 
		{
	        echo "0";
	    }
	}
}
?>