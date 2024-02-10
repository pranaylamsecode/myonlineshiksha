<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include the facebook.php from libraries directory
require_once APPPATH.'libraries/facebook_new/facebook.php';

class Fbci extends CI_Controller {

   public function __construct(){
	    parent::__construct();
	   // $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
	    $this->load->model('settings_model');
	    $this->load->helper('url');
		$this->load->model('login_model');
		// $this->load->library('facebook');
	    $this->load->library('session');  //Load the Session 
		$this->config->load('facebook'); //Load the facebook.php file which is located in config directory
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
		$this->config->item( 'permissions', 'facebook' );
		$this->load->model('Crud_model');
		
    }
	public function index()
	{
		// echo "hi";exit;
	  $this->load->view('flogin/main'); //load the main.php file for view
	}
	
	function logout(){
		$base_url=$this->config->item('base_url'); //Read the baseurl from the config.php file
		$this->session->sess_destroy();  //session destroy
		header('Location: '.$base_url."fbci");  //redirect to the home page
		
	}

	function test(){
		$email = $this->input->post('email');
		$password = 'fbuser';
		$result = $this->login_model->validateforFB($email, $password);
		print_r($is_exist);
	}
	function fblogin()
	{	
		
		$loginDet = $this->settings_model->getItems();
		
		extract($loginDet[0]);
		$socialloginarray = json_decode($sociallogin);

		$fbApp = $socialloginarray->facebook->appid;
		$fbSecrete = $socialloginarray->facebook->appsecretkey;
		if($fbApp != "" && $fbSecrete != "")
		{
			// echo $fbApp;
			// exit('yes');
		 //Read the baseurl from the config.php file
		
		//get the Facebook appId and app secret from facebook.php which located in config directory for the creating the object for Facebook class
    	$facebook = new Facebook(array(
		'appId'		=> $fbApp, //$this->config->item('appID'), 
		'secret'	=> $fbSecrete,//$this->config->item('appSecret'),
		'cookie' => true,
		'permissions' => 'public_profile,email,publish_actions',
		 'default_graph_version' => 'v2.10'

		));
		 // $helper = $facebook->getRedirectLoginHelper();
 
   $permissions = ['scope','public_profile','email','user_location','user_birthday','publish_actions']; 
// For more permissions like user location etc you need to send your application for review

   // $loginUrl = $helper->getLoginUrl('http://localhost/sampleproject/login/fbcallback', $permissions);
		
		$user = $facebook->getUser(); // Get the facebook user id 
		

// print_r($user); exit();

		$access_token =$facebook->getAccessToken();
		if($user){
			
			try
			{
				// $user_profile = $this->facebook->api('/' . $user, NULL, ['fields' => $key]);
    //             $this->details[$key] = isset($fields[$key]) ? $fields[$key] : NULL;

				// $user_profile = $facebook->api('/me');  //Get the facebook user profile data
				$user_profile = $facebook->api('/'.$user.'?scope=email&fields=name,email,id&'.$access_token, $permissions);
				// $response = $facebook->get( '/'.$user.'?fields=id,name,email,first_name,last_name,birthday,location,gender', $access_token );
				// $response = $facebook->get('/me?locale=en_US&fields=name,email');
// $userNode = $response->getGraphUser();
				// $userNode = $user_profile->getGraphUser();

				// try {
  // Returns a `FacebookFacebookResponse` object
  // $response = $facebook->api(
  //   '/'.$user,
  //   array (
  //     'fields' => 'birthday','email','hometown'
  //   ),
  //   $access_token
  // );
	// $response = $facebook->api('/'.$user.'?scope=email&fields=name,email,id,birthday&'.$access_token);

// $graphNode = $response->getGraphNode();
// print_r($user_profile); exit("888");
				
				$is_exist ="";
				$urldomain =$this->config->item('urldomain');
if (isset($user_profile['email'])) {
	$email =   $user_profile['email'];
}else{
	$email =  $user_profile['id'].'@'.$urldomain;
}
// echo $email; exit();
				
				if(isset($email)&& $email!="")
				{ 
					$is_exist = $this->login_model->email_exists_ajax($email);

				}

		// echo $is_exist; 
	

				if($is_exist)
				{
						$password = 'fbuser';
						$logoimage = Null;
						$result = $this->login_model->validateforFB($email, $password);
			         	// print_r($result); exit();
						$courses_from_cart = $this->session->userdata('courses_from_cart');
						$login_page_url = $_SERVER["REQUEST_URI"];
						if($result)
						{  
							$last_page_url = $this->session->userdata('last_page_url');
							
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
									$first = $this->login_model->first_time_login_fb($email);
									if($first->first_time_login == '0')//if zero i.e. first time
									{

										$urldomain = base_url();
										$urldomain = str_replace('http://', '', $urldomain);
										$urldomain = str_replace('/', '', $urldomain);
										$urldomain = str_replace('www.', '', $urldomain);
										
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
										$coupon_code = $this->session->userdata('coupon_code');
										$course_id = $this->session->userdata('crs_id');
										// redeem code

                    	// new code
                    	$user_id = $auth['id'];
                    	if(!empty($coupon_code))
                    	{
                    		$getcourse = $this->Crud_model->get_single('mlms_program',"id = ".$course_id,"name,slug,id");
					        $getorder = $this->Crud_model->get_single('mlms_order',"courses = '".$course_id."' AND userid = '".$user_id."'");
					        if(!empty($getorder))
					        {
					        	$this->session->set_userdata('msg_redeem','Already');
					        	echo base_url().$getcourse->slug.'/lectures/'.$getcourse->id;
					        	// exit;
					        }
							$this->load->model('reseller_model');
							$newdata = array(
										'course_id' => $course_id,
										'student_name' => $user_id,
										'status' => "Redeemed",
					                    'modified' => date('Y-m-d H:i:s')
							);
							$cond = "coupon_code = '".$coupon_code."' AND status = 'Unused'";
							$this->Crud_model->SaveData('mlms_reseller_coupon',$newdata,$cond);

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
					            
					            $rcomper = $get_code->assessment;
					            $amount_liable = floatval($get_code->fixedrate) - floatval($rcom);
			            		$offresaleId = $get_code->reseller_id;
					            // payments for the agent / sub-resellers
                                if(!empty($get_code->parent_id)){
                                    $getparent = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$get_code->parent_id,"assessment");
                                    $parent_comm = floatval($getparent->assessment) - floatval($rcomper);
                                    $rcomper = $getparent->assessment;
                                    $parent_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->parent_id);
                                    $pcom = floatval($_REQUEST['net_amount_debit']) * floatval($parent_comm) /100;
                                    $parent_total = floatval($parent_payout->total_amount) + floatval($pcom);
                                    $parent_paid = floatval($parent_payout->paid_amount) + floatval($pcom);
                                    $parent_reseller = array(
                                                    'total_amount' => $parent_total,
                                                    'paid_amount' => $parent_paid,
                                                    'modified' => date('Y-m-d H:i:s')
                                    );
                                    $this->Crud_model->SaveData('mlms_payout',$parent_reseller,"user_id =".$get_code->parent_id);
                                    $parent_pay_log = array(
			                            'payout_id' => $parent_payout->id,
			                            'user_id' => $get_code->parent_id,
			                            'pay_mode' => 'Cash',
			                            'paid_amount' => $pcom,
			                            'paid_date' => date('Y-m-d H:i:s'),
			                            'memo' => "This order is made by Agent. Collect payment from Agent. Payment automatically SETTLED in case of Offline selling a course.",
						            );
						            $this->Crud_model->SaveData('mlms_payout_log',$parent_pay_log);

                                    $parent_log_comm = array(
                                                'order_id' => $order_id,
                                                'reseller_id' => $get_code->parent_id,
                                                'commission' => $pcom,
                                                'comm_percent' => $parent_comm,
                                                'created' => date("Y-m-d H:i:s")
                                    );
                                    $this->Crud_model->SaveData('mlms_commission_log',$parent_log_comm);
                                    $amount_liable = floatval($amount_liable) - floatval($pcom);
			            			$offresaleId = $get_code->parent_id;
                                }

					            // teacher commision
					            $teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->author);
						          $tcom = floatval($get_code->fixedrate) * (floatval($get_code->coursepercent) - floatval($rcomper)) /100 ;

						          $teacher_total = floatval($teacher_payout->total_amount) + floatval($tcom);
						          $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($tcom);

						          $teacher = array(
						                        'total_amount' => $teacher_total,
						                        'balance_amount' => $teacher_balance,
						                        'modified' => date('Y-m-d H:i:s')
						          );
						          $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id =".$get_code->author);
						          $log_comm2 = array(
						                        'order_id' => $order_id,
						                        'reseller_id' => $get_code->author,
						                        'commission' => $tcom,
						                        'comm_percent' => (floatval($get_code->coursepercent) - floatval($rcomper)),
						                        'created' => date("Y-m-d H:i:s")
						          );
						          $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);

						          $amount_liable = floatval($get_code->fixedrate) - floatval($rcom);
						          $offline_payment = array(
						                        'reseller_id' => $offresaleId,
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
						          $teacher_pay_log = array(
			                            'payout_id' => $teacher_payout->id,
			                            'user_id' => $get_code->author,
			                            'pay_mode' => 'Cash',
			                            'paid_amount' => $tcom,
			                            'paid_date' => date('Y-m-d H:i:s'),
			                            'memo' => "Payment automatically SETTLED in case of Offline selling a course.",
						          );
						          $this->Crud_model->SaveData('mlms_payout_log',$teacher_pay_log);
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
						    	$this->session->set_userdata('nr',base_url().$getcourse->slug.'/lectures/'.$getcourse->id);
						    	redirect(base_url('thank_you/'));
					        }
					    }
                    	// new code
                    
										// redeem code 
					    			$last_url = $this->session->userdata('last_url');
					    			if(!empty($last_url))
					    			{
					    				redirect($last_url);
					    				$this->session->unset_userdata('last_url');
					    			}
									else
									{
										redirect('my-courses');
									}	
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
								redirect('category/courses');
								//echo 'success';
							}
						}
				}
				else
				{		
						$username = explode(' ',$user_profile['name']); 
						// $email = $email;
						$first_name = $username[0];
						$last_name = $username[1];
						$image = "https://graph.facebook.com/".$user_profile['id']."/picture";
						
						$content = file_get_contents($image);
						//Store in the filesystem.
						$image = rand(500,100000);
						$fileName = 'public/uploads/users/img/'.$image.'_'.date('Y-m-d').'.jpg';
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
							'group_id' 		=>  '1',
							'created_at'	=> date('Y-m-d H:i:s')
							);
							$usergroups = '1';						
							

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
								
								$dataNew= $this->login_model->setSessionData_fb($email);
								$this->session->set_userdata('logged_in',$dataNew);
								
								if($this->session->userdata('logged_in'))
								{
									$auth = $this->session->userdata('logged_in');
									$data['user_name'] = $auth['user_name'];
									$coupon_code = $this->session->userdata('coupon_code');
									$course_id = $this->session->userdata('crs_id');
										// redeem code

                    	// new code
                    	$user_id = $auth['id'];
                    	if(!empty($coupon_code))
                    	{
							$this->load->model('reseller_model');
							$newdata = array(
										'course_id' => $course_id,
										'student_name' => $user_id,
										'status' => "Redeemed",
					                    'modified' => date('Y-m-d H:i:s')
							);
							$cond = "coupon_code = '".$coupon_code."' AND status = 'Unused'";
							$this->Crud_model->SaveData('mlms_reseller_coupon',$newdata,$cond);

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
					            $rcomper = $get_code->assessment;
					            $amount_liable = floatval($get_code->fixedrate) - floatval($rcom);
			            		$offresaleId = $get_code->reseller_id;
					                // payments for the agent / sub-resellers
                                if(!empty($get_code->parent_id)){
                                    $getparent = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$get_code->parent_id,"assessment");
                                    $parent_comm = floatval($getparent->assessment) - floatval($rcomper);
                                    $rcomper = $get_code->parent_id;
                                    $parent_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->parent_id);
                                    $pcom = floatval($get_code->fixedrate) * floatval($parent_comm) /100;
                                    $parent_total = floatval($parent_payout->total_amount) + floatval($pcom);
                                    $parent_paid = floatval($parent_payout->paid_amount) + floatval($pcom);
                                    $parent_reseller = array(
                                                    'total_amount' => $parent_total,
                                                    'paid_amount' => $parent_paid,
                                                    'modified' => date('Y-m-d H:i:s')
                                    );
                                    $this->Crud_model->SaveData('mlms_payout',$parent_reseller,"user_id =".$get_code->parent_id);
                                    $parent_pay_log = array(
			                            'payout_id' => $parent_payout->id,
			                            'user_id' => $get_code->parent_id,
			                            'pay_mode' => 'Cash',
			                            'paid_amount' => $pcom,
			                            'paid_date' => date('Y-m-d H:i:s'),
			                            'memo' => "This order is made by Agent. Collect payment from Agent. Payment automatically SETTLED in case of Offline selling a course.",
						            );
						            $this->Crud_model->SaveData('mlms_payout_log',$parent_pay_log);
						            
                                    $parent_log_comm = array(
                                                'order_id' => $order_id,
                                                'reseller_id' => $get_code->parent_id,
                                                'commission' => $pcom,
                                                'comm_percent' => $parent_comm,
                                                'created' => date("Y-m-d H:i:s")
                                    );
                                    $this->Crud_model->SaveData('mlms_commission_log',$parent_log_comm);
                                    $amount_liable = floatval($amount_liable) - floatval($pcom);
			            			$offresaleId = $get_code->parent_id;
                                }
					            // teacher commision
					            $teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->author);
						          $tcom = floatval($get_code->fixedrate) * (floatval($get_code->coursepercent) - floatval($rcomper)) /100 ;

						          $teacher_total = floatval($teacher_payout->total_amount) + floatval($tcom);
						          $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($tcom);

						          $teacher = array(
						                        'total_amount' => $teacher_total,
						                        'balance_amount' => $teacher_balance,
						                        'modified' => date('Y-m-d H:i:s')
						          );
						          $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id =".$get_code->author);
						           $teacher_pay_log = array(
			                            'payout_id' => $teacher_payout->id,
			                            'user_id' => $get_code->author,
			                            'pay_mode' => 'Cash',
			                            'paid_amount' => $tcom,
			                            'paid_date' => date('Y-m-d H:i:s'),
			                            'memo' => "Payment automatically SETTLED in case of Offline selling a course.",
						          );
						          $this->Crud_model->SaveData('mlms_payout_log',$teacher_pay_log);
						          $log_comm2 = array(
						                        'order_id' => $order_id,
						                        'reseller_id' => $get_code->author,
						                        'commission' => $tcom,
						                        'comm_percent' => (floatval($get_code->coursepercent) - floatval($get_code->assessment)),
						                        'created' => date("Y-m-d H:i:s")
						          );
						          $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);

						          // $amount_liable = floatval($get_code->fixedrate) - floatval($rcom);
						          $offline_payment = array(
						                        'reseller_id' => $offresaleId,
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
						          $teacher_pay_log = array(
					                            'payout_id' => $teacher_payout->id,
					                            'user_id' => $get_code->author,
					                            'pay_mode' => 'Cash',
					                            'paid_amount' => $tcom,
					                            'paid_date' => date('Y-m-d H:i:s'),
					                            'memo' => "Payment automatically SETTLED in case of Offline selling a course.",
					            );
					            $this->Crud_model->SaveData('mlms_payout_log',$teacher_pay_log);
						      }
						    	$getcourse = $this->Crud_model->get_single('mlms_program',"id = ".$get_code->course_id,"name,slug,id");
						    	$this->session->set_userdata('msg_redeem', 'Congratulations');
						    	$this->session->unset_userdata('coupon_code');
						    	$this->session->unset_userdata('crs_id');
						    	$this->session->set_userdata('nr',base_url().$getcourse->slug.'/lectures/'.$getcourse->id);
						    	redirect(base_url('thank_you/'));
					          //redirect($getcourse->slug.'/lectures/'.$getcourse->id);
					        }
					    }
                    	// new code
                    
										// redeem code 
					    		$last_url = $this->session->userdata('last_url');
					    			if(!empty($last_url))
					    			{
					    				redirect($last_url);
					    			}
					    			$this->session->unset_userdata('last_url');
								}
								
								if($last_page_url == '')
								{									
										redirect('category/courses');
										//echo 'success';
								}
								else
								{
									header("Location: $last_page_url");
								}
								//redirect('category/');
							}


				}
				
			}
			 catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
			catch(FacebookApiException $e)
			{
				error_log($e);
				$user = NULL;
			}		
		}	
		
	}
	else
	{
		echo"please enter valid facebook app id and secret key";
	}
}
	
}

/* End of file fbci.php */
/* Location: ./application/controllers/fbci.php */