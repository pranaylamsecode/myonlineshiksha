<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Paypal extends CI_Controller {

    /**
     * Index Page for this controller.
     */
  
    public function __construct() 
	{
	    parent::__construct();
		$this->load->model('admin/settings_model');
		$this->load->model('admin/programs_model');
		$this->load->model('program_model');
		$this->load->model('login_model');
$configarr = $this->settings_model->getItems();	
date_default_timezone_set($configarr[0]['time_zone']);
    }

    public function index() 
	{
	   	    
		$sessionarray = $this->session->userdata('logged_in');
		
		$firstname = $sessionarray['first_name'];
		$lastname = $sessionarray['last_name'];
		$fullname = $firstname.' '. $lastname;
		$email = $sessionarray['email'];
		$user_id = $sessionarray['id'];
		$pay_setting = $this->settings_model->getAccountMode();


		
		if($pay_setting[0]['status'] == 1) // for Live Mode
		{
			
			$api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
			$api_url = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		else // for testing mode
		{
		  
			$api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
			$api_url = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		
		if( !isset($user_id) || $user_id == 0)
		{
			redirect('users/login');
		}
		else
		{
		 $settings = array('api_username' => 'jayesh.n.jibhakate-facilitator_api1.gmail.com' , // 'paypal-facilitator_api1.veerit.com'
						   'api_password' => '72ANKCYBPXAAEQ8U',  //  FDVH2YJGFW74NVQV
						   'api_signature' => 'Aaym.wj-XoPU4mK7xpdLWhOwmU2AAOYyocLeXIByjtSvFrG3y7zlfA--', //   AFcWxV21C7fd0v3bYYYRCpSSRl31Al28XiIq-oaqqvB-JHRGru4v7Lcc
						   'api_endpoint' => $api_endpoint,
						   'api_url' => $api_url,
						   'api_version' => '65.1',
						   'payment_type' => 'Sale',
						   'currency' => $pay_setting[0]['currency']  //$pay_setting[0]['currency']
						   );

			// $settings = array('api_username' => 'paypal-facilitator_api1.veerit.com' , // 'paypal-facilitator_api1.veerit.com'
			// 			   'api_password' => 'FDVH2YJGFW74NVQV',  //  FDVH2YJGFW74NVQV
			// 			   'api_signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31Al28XiIq-oaqqvB-JHRGru4v7Lcc', //   AFcWxV21C7fd0v3bYYYRCpSSRl31Al28XiIq-oaqqvB-JHRGru4v7Lcc
			// 			   'api_endpoint' => $api_endpoint,
			// 			   'api_url' => $api_url,
			// 			   'api_version' => '65.1',
			// 			   'payment_type' => 'Sale',
			// 			   'currency' => $pay_setting[0]['currency']  //$pay_setting[0]['currency']
			// 			   );
						   
	
		 $this->load->library('paypalexpress', $settings);		  
		 if(!isset($_GET['token'])) 
		 {		
			$program_id = $this->uri->segment(3);
			$this->session->set_userdata('program_id',$program_id);
			$price = $this->uri->segment(4);           
     		
			$course_name = $this->settings_model->getProgramName($program_id);
			$paypalData = array(
					'userid' => $user_id,									
					'courses' => $program_id,					
					'amount_paid' => $price					
				);
				$this->session->set_userdata('paypalData', $paypalData);
				
		       // Setting up your intial variable to send payment process.
			 $url = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);	
			   
			   
			   
			   $paypalData = $this->session->userdata('paypalData');

               $urlCourse = strtolower($course_name['name']);			
			   $urlCourse = trim(str_replace(' ', '-', $urlCourse));
			   $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

			   $personName  = $fullname;
			   $L_NAME0   = @$course_name['name'];
			   $L_AMT0  = $paypalData['amount_paid'];
			   $L_QTY0  =	'1';
			   $returnURL = urlencode($url.'/paypal');
			   $cancelURL = urlencode(base_url().'course/'.$urlCourse.'/'.$paypalData['courses']);
			   $itemamt = 0.00;
			   $itemamt = $L_QTY0*$L_AMT0;
			   $amt = $paypalData['amount_paid'];
			   $nvpstr = "&L_NAME0=".$L_NAME0."&L_AMT0=".$L_AMT0."&L_QTY0=".$L_QTY0."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&L_NUMBER0=1000&L_DESC0=Size: 8.8-oz&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$settings['currency']."&PAYMENTACTION=".$settings['payment_type'];
		        // calling initial api.
			    
				$initresult = $this->paypalexpress->process_payment($nvpstr);

				if(isset($initresult) && $initresult['ACK'] == 'Failure') 
				{
				   
				   // redirect to view with error message.

  	   					$urlCourse = strtolower($course_name['name']);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
				  
					    $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => "Something went wrong, Please Try Again." ));
					    redirect('course/'.$urlCourse.'/'.$paypalData['courses']);
				}
         }//if
		 else 
		 {
			
			$token = urlencode($_GET['token']);
			$result = $this->paypalexpress->make_payment($token);	

					
			
			if(isset($result) && $result['ACK'] == 'Failure') 
			{   
			    // redirect to view with error message.
			    $this->session->set_flashdata('error_message', 'Please check your details and try again');			   
			    $upd_data = array(					
					'order_date' => $result['TIMESTAMP'],
					'status' => $result['ACK'],
					'published' => '0',
					'processor' => 'paypal'					
				);
				$paypalData = $this->session->userdata('paypalData');
				$pay_Insert = $this->settings_model->insertPaypalSuccess($paypalData);	
				$this->session->unset_userdata('paypalData');
				$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);	
				redirect('category');				
			}//if
			else 
			{
				
				/**/if($result['PAYMENTSTATUS'] == 'Paid')
				{	
					$published = '1';
				}
				else
				{
					$published = '0';
				}
				
				$upd_data = array(
					'order_date' => $result['ORDERTIME'],
					'status' => $result['PAYMENTSTATUS'],
					'pending_reason' => $result['PENDINGREASON'],
					'amount' => $result['AMT'],
					'amount_paid' => $result['AMT'],
					'published' => $published,
					'processor' => 'paypal',
					'currency' => $result['CURRENCYCODE'],
					'transactionid' =>$result['TRANSACTIONID'],
					'order_status' =>'New Order'
				);
				
				$this->load->model('Program_model');
				$paypalData = $this->session->userdata('paypalData');


				
				$plans = $this->programs_model->getSubscriptionPlans($paypalData['courses'],$paypalData['amount_paid']);
				

			/*
			Array([0] => Array([term] => 3 [period] => Month(s) [plan_id] => 1))*/
			if($plans)
			{
			  
				if($plans[0]['period'] == 'Month(s)')
				{			   
					$future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
					$date=strtotime(date('Y-m-d'));  // if today :2013-05-23

					 $Expire_Date = date('Y-m-d',strtotime($future_date,$date));	 
                    $plan_id = $plans[0]['plan_id']; 
					
						
				}
				elseif($plans[0]['period'] == 'Year(s)')
				{
					
					$future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,4);
					$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
					 $Expire_Date = date('Y-m-d',strtotime($future_date,$date));
					 $plan_id = $plans[0]['plan_id']; 
					 
				}
			}
			else
			{
				$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
				 $Expire_Date = date('Y-m-d',strtotime('+5 year',$date));	
                $plan_id = 4; 
              			
			}
			
			
			
				$paypalData = $this->session->userdata('paypalData');
				$pay_Insert = $this->settings_model->insertPaypalSuccess($paypalData);					
				$currency = $result['CURRENCYCODE'];
				$ordertime = $result['ORDERTIME'];
				$amt = $result['AMT'];
				$transaction_id = $result['TRANSACTIONID'];
				if($result['PAYMENTSTATUS'] == 'Completed') // by jayesh
				{
				    $external_id = $this->session->userdata('external_id');
		             
					if($external_id)
					{						
						$this->settings_model->updateExternalIncome($external_id, $pay_Insert);	
					}
					
					$buy_courses = $this->settings_model->insertBuyCourse($paypalData, $pay_Insert, $currency, $ordertime, $Expire_Date, $plan_id,$amt);
					// set user to student
					$data_user = $this->Program_model->getUserInfo($user_id);                   
					
					
						if($data_user->is_student == 0)
						{						   
							$this->Program_model->updateStudent($user_id);
						}
						
					$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);		
					$this->session->set_userdata('transaction_id',$result['TRANSACTIONID']);
					$this->session->set_userdata('payReceivedMsg','Payment Received Successfully');				
					$this->session->set_userdata('pending_reason',$result['PENDINGREASON']);								
					$this->session->set_userdata('amount',$result['AMT']);	
					$this->session->set_userdata('ack',$result['ACK']);	
					
							
					
				    $this->load->model('myinfo_model');
				
					$program_id = $this->session->userdata('program_id');
				    
					$configarr = $this->settings_model->getItems();
					$programinfo = $this->Program_model->getProgram($program_id); 
			
					//$programinfo = $programinfo[0];
					$programinfo->id;
					$programinfo->name;
					$programinfo->author;
				
					$userdetail = $this->myinfo_model->getUser($user_id);
					
					$userdetail->email;
					$userdetail->first_name;
					$userdetail->last_name;
				
					$authordetail = $this->myinfo_model->getUser($programinfo->author);
					
					$authordetail->email;
					$authordetail->first_name;
					$authordetail->last_name;
		// $urldomain = base_url();
		// $urldomain = str_replace('http://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
					if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

					//1. Order mail to user
					$subject1 = 'Your course purchase details - '.$configarr[0]['institute_name'];
					$toemail1 = $userdetail->email; // $userdetail->email
					$content = '';
					//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> Your Order of '.$result['AMT'] .' '.$pay_setting[0]['currency'] .' was Successfully recieved by '.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
					
					$content .= '<p>Hi '.trim(ucfirst($userdetail->first_name)).',<br /><br />';
					$content .= 'Thank you for your purchase. Here are your course purchase details:<br /><br />';
					//$content .= " Course ordered: '".$programinfo->name."' course.<br /><br />";
					$content .= ' Course Name: '.$programinfo->name.'<br />';
					$content .= ' Transaction Id: '.$result['TRANSACTIONID'].'<br />';
					$content .= ' Status: '.$result['PAYMENTSTATUS'].'<br />';
					$content .= ' Amount: '.$result['AMT'].'<br /><br />';
					$content .= " Your purchase was successfull! You can find ".$programinfo->name." under the menu 'My Courses' in the Academy once you login.<br /><br />";

					$content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> ';
					// $content .=' If you need help or have any questions, please contact us.<br /><br />';
					// $content .='<br /><br />';
					// $content .= '...</p>';
					// $content .= $configarr[0]['signature'].'</p>';
					//$content .=' Regards,<br /><br />';
					//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
					$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					$fromemail = $urldomain;    //$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject1);
					$this->email->to($toemail1);
					$this->email->message($message1);
					$this->email->send();
				
					$admininfo = $this->login_model->getadminInfo(4);
					//3. Mail To admin 
					$subject1 = 'New course purchased in '.$configarr[0]['institute_name'];
					$toemail3 = $admininfo->email;// admin mail
					$content = '';	
					$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">New course purchased in '.$configarr[0]['institute_name'].'</p>';
					$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					//$content .= "<p>You have received a new order for '".$programinfo->name."' by ".trim(ucfirst($sessionarray['first_name']))." ".trim(ucfirst($sessionarray['last_name']))." <br /><br />";
					$content .= trim(ucfirst($sessionarray['first_name'])).' have made a purchase of a course. The details are given below: <br /><br /> ';
					$content .= ' Course Name: '.$programinfo->name.'<br />';
					$content .= ' Transaction Id: '.$result['TRANSACTIONID'].'<br />';
					$content .= ' Status: '.$result['PAYMENTSTATUS'].'<br />';
					//$content .= ' Amount: '.$result['ACK'].'<br />';
					$content .= ' Amount: '.$result['AMT'].'<br />';
					// $content .= '<br /><br />';
					// $content .= '...</p>';
					// $content .= $configarr[0]['signature'].'</p>';
					//$content .=' Regards,<br /><br />';
					//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
					//$message3 = $content;
					$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
					$message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					$fromemail3 = 'noreply@'.$urldomain;   //$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject1);
					$this->email->to($toemail3);
					$this->email->message($message3);
					$this->email->send();	
				
				
					//1. mail to user $userdetail->email
					//$subject1 = "You have Enrolled Successfully to '".$programinfo->name."' in ".$configarr[0]['institute_name'];
				$subject1 = trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name;
				$toemail1 = $userdetail->email;
				$content = '';
				//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> '.$configarr[0]['institute_name'].'</h6>';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name.'</p>';

				$content .= '<p>Hello '.trim(ucfirst($userdetail->first_name)).',<br /><br />';
				$content .= " You have Successfully enrolled in '".$programinfo->name."'! You can now find '".$programinfo->name."' under the menu 'My Courses' in  <a style='color: #55c5eb;' href =".base_url().">".base_url()." </a>  once you log in.<br /><br />";
				$content .=' If you need help or have any questions, please contact us.<br />';
				// $content .= '<br /><br />';
				// $content .= '...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				//$content .=' Regards,<br /><br />';
				//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
				$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
				$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
				$fromemail = $urldomain;         //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject1);
				$this->email->to($toemail1);
				$this->email->message($message1);
				$this->email->send();	
				
					//2. mail to teacher
				//$subject2 = trim(ucfirst($userdetail->first_name))." ".trim(ucfirst($userdetail->last_name))." Has Successfully Enrolled to '".$programinfo->name."'";
				$subject2 = trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name;
				$toemail2 = $authordetail->email;
				$content = '';
				//$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name.'</p>';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($authordetail->first_name)).',<br /><br />';
				$content .=  trim(ucfirst($userdetail->first_name))." ".trim(ucfirst($userdetail->last_name))." has Successfully enrolled in '".$programinfo->name."'.<br /><br />";
				$content .='If you need help or have any questions, please contact us.<br />';
				// $content .='<br /><br />';
				// $content .= '...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				//$content .='Regards,<br /><br />';
				//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
				$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
				$message2 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
				$fromemail2 = 'noreply@'.$urldomain; //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail2, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject2);
				$this->email->to($toemail2);
				$this->email->message($message2);
				$this->email->send();		
			
			
			   $admininfo1 = $this->login_model->getadminInfo(4);
					//3. Mail To admin 
				//$subject3 = trim(ucfirst($userdetail->first_name))." ".trim(ucfirst($userdetail->last_name))." Has Successfully Enrolled to '".$programinfo->name."'";
			    $subject3 = trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name;
				$toemail3 = $admininfo1->email;// admin mail
				$content = '';	
				//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($admininfo1->first_name)).',<br /><br />';
				$content .=  trim(ucfirst($userdetail->first_name))." ".trim(ucfirst($userdetail->last_name))."  has Successfully enrolled in '".$programinfo->name."'!.<br /><br />";
				$content .='If you need help or have any questions, please contact us.<br />';
				// $content .='<br /><br />';
				// $content .= '...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				//$content .='Regards,<br /><br />';
				//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
				//$message3 = $content;
				$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
				$message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
				$fromemail3 = 'noreply@'.$urldomain;      //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject3);
				$this->email->to($toemail3);
				$this->email->message($message3);
				$this->email->send();	
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
				
					
					redirect('programs/programs/'.$paypalData['courses']);	
					$this->session->unset_userdata('paypalData');
				}
				elseif($result['PAYMENTSTATUS'] == 'Pending')// by jayesh
				{
					$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);	
					$this->session->set_userdata('transaction_id',$result['TRANSACTIONID']);	
					$this->session->set_userdata('payReceivedMsg',' Pending');				
					$this->session->set_userdata('pending_reason',$result['PENDINGREASON']);								
					$this->session->set_userdata('amount',$result['AMT']);				
				    $this->session->set_userdata('ack',$result['ACK']);				
					redirect('programs/programs/'.$paypalData['courses']);	
					$this->session->unset_userdata('paypalData');
				}
				elseif($result['PAYMENTSTATUS'] == 'Failed')// by jayesh
				{
					$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);	
					$this->session->set_userdata('transaction_id',$result['TRANSACTIONID']);	
					$this->session->set_userdata('payReceivedMsg','Failed');				
					$this->session->set_userdata('pending_reason',$result['PENDINGREASON']);								
					$this->session->set_userdata('amount',$result['AMT']);	
				    $this->session->set_userdata('ack',$result['ACK']);	
					redirect('programs/programs/'.$paypalData['courses']);	
					$this->session->unset_userdata('paypalData');
				}
				
				/*
				//mail send process
				$from = 'prshah83@gmail.com';
				$to = 'yogeshdangre31aug@gmail.com';
				$message = 'Hi Your payment received. <br> Transaction ID : ';
				$this->load->library('email');
				$this->email->from($from, 'Prashant');
				$this->email->to($to); 
				$this->email->subject('Email Test Payment Received');
				$this->email->message($message);
				$this->email->send();			
				*/
			}//else
	     }//else
		}//else
	}

	public function renewPlan() 
	{
		 
	    //$this->uri->segment(3); //course id
		// $this->uri->segment(4); // price
		//echo $this->uri->segment(5); //buy id
		//exit('drfg');
		
		
	   	
		   
		$sessionarray = $this->session->userdata('logged_in');
		
		$firstname = $sessionarray['first_name'];
		$lastname = $sessionarray['last_name'];
		$fullname = $firstname.' '. $lastname;
		$email = $sessionarray['email'];
		$user_id = $sessionarray['id'];
		$pay_setting = $this->settings_model->getAccountMode();
		
		
		if($pay_setting[0]['status'] == 1) // for Live Mode
		{
			
			$api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
			$api_url = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		else // for testing mode
		{
		  
			$api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
			$api_url = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		
		if( !isset($user_id) || $user_id == 0)
		{
			redirect('users/login');
		}
		else
		{
		 $settings = array('api_username' => 'jayesh.n.jibhakate-facilitator_api1.gmail.com' , // 'paypal-facilitator_api1.veerit.com'
						   'api_password' => '72ANKCYBPXAAEQ8U',  //  FDVH2YJGFW74NVQV
						   'api_signature' => 'Aaym.wj-XoPU4mK7xpdLWhOwmU2AAOYyocLeXIByjtSvFrG3y7zlfA--', //   AFcWxV21C7fd0v3bYYYRCpSSRl31Al28XiIq-oaqqvB-JHRGru4v7Lcc
						   'api_endpoint' => $api_endpoint,
						   'api_url' => $api_url,
						   'api_version' => '65.1',
						   'payment_type' => 'Sale',
						   'currency' => $pay_setting[0]['currency']
						   );
						   
	
		 $this->load->library('paypalexpress', $settings);		  
		 if(!isset($_GET['token'])) 
		 {		 
			$program_id = $this->uri->segment(3);
			$this->session->set_userdata('program_id',$program_id);
			$price = $this->uri->segment(4);       
			$buy_id = $this->uri->segment(5);       

		   $buy_data = $this->settings_model->getBuyData($this->uri->segment(5));
		   $exp_date = $buy_data->expired_date;
     		
			$course_name = $this->settings_model->getProgramName($program_id);
			$paypalData = array(
					'userid' => $user_id,									
					'courses' => $program_id,					
					'amount_paid' => $price,
                    'exp_date' => $exp_date,				
                    'buy_id' => $buy_id					
				);
				$this->session->set_userdata('paypalData', $paypalData);
				
		       // Setting up your intial variable to send payment process.
			   $url = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);
			   
			   
			   $personName  = $fullname;
			   $L_NAME0   = @$course_name['name'];
			   $L_AMT0  = '1';
			   $L_QTY0  =	'1';
			   $returnURL = urlencode($url.'/paypal');
			   $cancelURL = urlencode("$url/paypal");
			   $itemamt = 0.00;
			   $itemamt = $L_QTY0*$L_AMT0;
			   $amt = 1.00;
			   $nvpstr = "&L_NAME0=".$L_NAME0."&L_AMT0=".$L_AMT0."&L_QTY0=".$L_QTY0."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&L_NUMBER0=1000&L_DESC0=Size: 8.8-oz&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$settings['currency']."&PAYMENTACTION=".$settings['payment_type'];
		        // calling initial api.
				$initresult = $this->paypalexpress->process_payment($nvpstr);
				if(isset($initresult) && $initresult['ACK'] == 'Failure') 
				{
				  // redirect to view with error message.
				  $this->session->set_flashdata('error_message', 'Please check your details and try again');
				  redirect('myview','refresh');
				}
         }//if
		 else 
		 {			
			$token = urlencode($_GET['token']);
			$result = $this->paypalexpress->make_payment($token);
			
			if(isset($result) && $result['ACK'] == 'Failure') 
			{
			    // redirect to view with error message.
			    $this->session->set_flashdata('error_message', 'Please check your details and try again');			   
			    $upd_data = array(					
					'order_date' => $result['TIMESTAMP'],
					'status' => $result['ACK'],
					'published' => '0',
					'processor' => 'paypal'					
				);
				$paypalData = $this->session->userdata('paypalData');
				$pay_Insert = $this->settings_model->insertPaypalSuccess($paypalData);	
				$this->session->unset_userdata('paypalData');
				$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);	
				redirect('category');				
			}//if
			else 
			{
				/**/if($result['PAYMENTSTATUS'] == 'Paid')
				{	
					$published = '1';
				}
				else
				{
					$published = '0';
				}
				
				$upd_data = array(
					'order_date' => $result['ORDERTIME'],
					'status' => $result['PAYMENTSTATUS'],
					'pending_reason' => $result['PENDINGREASON'],
					'amount' => $result['AMT'],
					'amount_paid' => $result['AMT'],
					'published' => $published,
					'processor' => 'paypal',
					'currency' => $result['CURRENCYCODE'],
					'transactionid' =>$result['TRANSACTIONID'],
					'order_status' =>'Renewal'
				);
				
				$this->load->model('Program_model');
				$paypalData = $this->session->userdata('paypalData');
				
				$plans = $this->programs_model->getSubscriptionPlans($paypalData['courses'],$paypalData['amount_paid']);
		        if(time() > strtotime($paypalData['exp_date']))
                {
				if($plans)
			    {			  
				if($plans[0]['period'] == 'Month(s)')
				{			   
					$future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
					$date=strtotime(date('Y-m-d'));  // if today :2013-05-23

					$Expire_Date = date('Y-m-d',strtotime($future_date,$date));	 
                    $plan_id = $plans[0]['plan_id']; 						
				}
				elseif($plans[0]['period'] == 'Year(s)')
				{
					$future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
					$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
					 $Expire_Date = date('Y-m-d',strtotime($future_date,$date));
					 $plan_id = $plans[0]['plan_id'];					 
				}
			}
			else
			{
				$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
				 $Expire_Date = date('Y-m-d',strtotime('+5 year',$date));	
                $plan_id = 4; 
              			
			}
        }
		else
		{
			$exp = strtotime($paypalData['exp_date']);
			$today = time();
			$difference = $exp - $today;
			$days_rem = floor($difference / (60 * 60 * 24));		
			
			
			if($plans)
			{
			  
				if($plans[0]['period'] == 'Month(s)')
				{			   
					$future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
					$date=strtotime(date('Y-m-d'));  // if today :2013-05-23

					 $Expire_Date = date('Y-m-d',strtotime($future_date,$date));	
					 $date1=strtotime(date($Expire_Date));
			         $Expire_Date = date('Y-m-d',strtotime('+'.$days_rem.' Day',$date1));
                    $plan_id = $plans[0]['plan_id']; 
					
						
				}
				elseif($plans[0]['period'] == 'Year(s)')
				{
					$future_date = "+".$plans[0]['term'].' '.substr($plans[0]['period'],0,5);
					$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
					 $Expire_Date = date('Y-m-d',strtotime($future_date,$date));
					 $date1=strtotime(date($Expire_Date));
			         $Expire_Date = date('Y-m-d',strtotime('+'.$days_rem.' Day',$date1));
					 $plan_id = $plans[0]['plan_id']; 
					 
				}
			}
			else
			{
				$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
				 $Expire_Date = date('Y-m-d',strtotime('+1 year',$date));
				 $date1=strtotime(date($Expire_Date));
			     $Expire_Date = date('Y-m-d',strtotime('+'.$days_rem.' Day',$date1));
                $plan_id = 4; 
              			
			}
			
		}	
			   
			/*
			Array([0] => Array([term] => 3 [period] => Month(s) [plan_id] => 1))*/
			
			
			
			
				$paypalData = $this->session->userdata('paypalData');
				$pay_Insert = $this->settings_model->insertPaypalSuccess($paypalData);					
				$currency = $result['CURRENCYCODE'];
				$ordertime = $result['ORDERTIME'];
				$amt = $result['AMT'];
				$transaction_id = $result['TRANSACTIONID'];
				if($result['PAYMENTSTATUS'] == 'Completed') // by jayesh
				{
				    $external_id = $this->session->userdata('external_id');
		             
					if($external_id)
					{						
						$this->settings_model->updateExternalIncome($external_id, $pay_Insert);	
					}
					
					$buy_courses = $this->settings_model->updateBuyCourse($paypalData, $pay_Insert, $currency, $ordertime, $Expire_Date, $plan_id,$amt,$paypalData['buy_id']);
					// set user to student
					$data_user = $this->Program_model->getUserInfo($user_id);                   
					
					
						if($data_user->is_student == 0)
						{						   
							$this->Program_model->updateStudent($user_id);
						}
						
					$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);		
					$this->session->set_userdata('transaction_id',$result['TRANSACTIONID']);
					$this->session->set_userdata('payReceivedMsg','Payment Received Successfully');				
					$this->session->set_userdata('pending_reason',$result['PENDINGREASON']);								
					$this->session->set_userdata('amount',$result['AMT']);	
					$this->session->set_userdata('ack',$result['ACK']);	
					
							
					
				    $this->load->model('myinfo_model');
				
					$program_id = $this->session->userdata('program_id');
				    
					$configarr = $this->settings_model->getItems();
					$programinfo = $this->Program_model->getProgram($program_id); 
			
					//$programinfo = $programinfo[0];
					$programinfo->id;
					$programinfo->name;
					$programinfo->author;
				
					$userdetail = $this->myinfo_model->getUser($user_id);
					
					$userdetail->email;
					$userdetail->first_name;
					$userdetail->last_name;
				
					$authordetail = $this->myinfo_model->getUser($programinfo->author);
					
					$authordetail->email;
					$authordetail->first_name;
					$authordetail->last_name;
				
		// 			$urldomain = base_url();
		// $urldomain = str_replace('http://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
					if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
					//1. Order mail to user
					//$subject1 = 'Your Subscription for '.$configarr[0]['institute_name'].' Has Been Successfully Renewed';
					$subject1 = 'Your course renewed successfully - '.$configarr[0]['institute_name'];
					$toemail1 = $userdetail->email; // $userdetail->email
					$content = '';
					//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> Your Order of '.$result['AMT'] .' '.$pay_setting[0]['currency'] .' was Successfully recieved by '.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course renewed successfully - '.$configarr[0]['institute_name'].'</p>';
					$content .= '<p>Dear '.trim(ucfirst($userdetail->first_name)).',<br /><br />';
					$content .= 'Thank you for renewing your course subscription. Here are your renewal details:<br /><br />';
					$content .= "Course renewed: ".$programinfo->name."<br />";
					$content .= ' Transaction Id: '.$result['TRANSACTIONID'].'<br />';
					$content .= ' Amount: '.$result['AMT'].'<br />';
					$content .= ' Status: '.$result['PAYMENTSTATUS'].'<br /><br />';
					
					//$content .= " You can find '".$programinfo->name."' under the menu 'My Courses' in  <a href =".base_url().">".base_url()."</a> once you login.<br /><br />";

					$content .= " You can find ".$programinfo->name." under the menu 'My Courses' in the Academy once you login.<br /><br />";

                    $content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /><br />';
					$content .=' If you need help or have any questions, please contact us.<br />';
					// $content .=' <br /><br />';
					// $content .= '...</p>';
					// $content .= $configarr[0]['signature'].'</p>';
					//$content .=' Regards,<br /><br />';
					//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
					
					$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
					$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					$fromemail = $urldomain;       //$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject1);
					$this->email->to($toemail1);
					$this->email->message($message1);
					$this->email->send();
				
				$admininfo3 = $this->login_model->getadminInfo(4);
					//3. Mail To admin 
					//$subject1 = trim(ucfirst($userdetail->first_name)).''.trim(ucfirst($userdetail->last_name)).' Has Successfully Renewed '.$configarr[0]['institute_name'];
				    $subject1 = 'Course renewed successfully - '.$configarr[0]['institute_name'];
					$toemail3 = $admininfo3->email;// admin mail
					$content = '';	
					//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Course renewed successfully - '.$configarr[0]['institute_name'].'</p>';
					$content .= '<p>Dear '.trim(ucfirst($admininfo3->first_name)).',<br /><br />';
					$content .=  trim(ucfirst($userdetail->first_name)).' has renewed their subscribed course. Here are the renewal details: <br /><br />';
					$content .= " Course Name: '".$programinfo->name."' course.<br />";
					$content .= ' Transaction Id: '.$result['TRANSACTIONID'].'<br />';
					$content .= ' Amount: '.$result['AMT'].'<br />';
					$content .= ' Status: '.$result['PAYMENTSTATUS'].'<br />';
					
					// $content .= '<br /><br />';
					// $content .= '...</p>';
					// $content .= $configarr[0]['signature'].'</p>';
					//$content .=' Regards,<br /><br />';
					//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
					//$message3 = $content;
					$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
					$message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					$fromemail3 = 'noreply@'.$urldomain;       //$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject1);
					$this->email->to($toemail3);
					$this->email->message($message3);
					$this->email->send();	
				
				
					//1. mail to user
					// $subject1 = 'Course renewal in '.$configarr[0]['institute_name'];
					// $toemail1 = $userdetail->email; // $userdetail->email
					// $content = '';
					// $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> New User Enrolled in '.$configarr[0]['institute_name'].'</h6>';
					// $content .= '<p>Dear '.$userdetail->first_name.' '.$userdetail->last_name.',<br /><br />';
					// $content .= " Renewal Successfully! You can find ".$programinfo->name." course under 'My Courses'.<br /><br />";
					// $content .=' If you need help or have any questions, please contact us.<br /><br />';
					// $content .= $configarr[0]['signature'].'</p>';
					// //$content .=' Best Regards,<br /><br />';
					// //$content .= $configarr[0]['institute_name'].'</p>';
					
					// $data['content'] = $content;
					// $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					// $fromemail1=$configarr[0]['fromemail'];// admin mail
					// $config['charset'] = 'utf-8';
					// $config['mailtype'] = 'html';
					// $config['wordwrap'] = TRUE;
					// $this->email->initialize($config);
					// $this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
					// $this->email->subject($subject1);
					// $this->email->to($toemail1);
					// $this->email->message($message1);
					// $this->email->send();	
				
					//2. mail to teacher
					// $subject2 = 'Course Subscription extended in '.$configarr[0]['institute_name'];
					// $toemail2 = $authordetail->email; //$authordetail->email
					// $content = '';
					// $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> New Course Enrolled in '.$configarr[0]['institute_name'].'</h6>';
					// $content .= '<p>Dear '.$authordetail->first_name.' '.$authordetail->last_name.',<br /><br />';
					// $content .= " One Student extend his/her subscription in ".$programinfo->name.". .<br /><br />";
					// $content .='If you need help or have any questions, please contact us.<br /><br />';
					// $content .= $configarr[0]['signature'].'</p>';
					// //$content .='Best regards,<br /><br />';
					// //$content .= $configarr[0]['institute_name'].'</p>';
					
					// $data['content'] = $content;
					// $message2 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					// $fromemail2 = $configarr[0]['fromemail'];// admin mail
					// $config['charset'] = 'utf-8';
					// $config['mailtype'] = 'html';
					// $config['wordwrap'] = TRUE;
					// $this->email->initialize($config);
					// $this->email->from($fromemail2, $configarr[0]['fromname']);// admin mail);
					// $this->email->subject($subject2);
					// $this->email->to($toemail2);
					// $this->email->message($message2);
					// $this->email->send();	
			
			
			  // 		 $admininfo4 = $this->login_model->getadminInfo(4);
					// //3. Mail To admin 
					// $subject3 = 'Old User Extend subscription to '.$configarr[0]['institute_name'];
					// $toemail3 = $configarr[0]['fromemail'];// admin mail
					// $content = '';	
					// $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					// $content .= '<p>Dear '.$admininfo4->first_name.',<br /><br />';
					// $content .= '<p>Old User is Extend For Course :- '.$programinfo->name.' named '.$sessionarray['first_name'].' '.$sessionarray['last_name'].' <br /><br />';
					// $content .= $configarr[0]['signature'].'</p>';
					// //$content .='Best regards,<br /><br />';
					// //$content .=''.$configarr[0]['institute_name'].'</p>';
					// //$message3 = $content;
					// $data['content'] = $content;
					// $message3 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					// $fromemail3 = $configarr[0]['fromemail'];// admin mail
					// $config['charset'] = 'utf-8';
					// $config['mailtype'] = 'html';
					// $config['wordwrap'] = TRUE;
					// $this->email->initialize($config);
					// $this->email->from($fromemail3,$configarr[0]['fromname']);// admin mail);
					// $this->email->subject($subject3);
					// $this->email->to($toemail3);
					// $this->email->message($message3);
					// $this->email->send();	
					
					redirect('programs/programs/'.$paypalData['courses']);	
					$this->session->unset_userdata('paypalData');
				}
				elseif($result['PAYMENTSTATUS'] == 'Pending')// by jayesh
				{
					$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);	
					$this->session->set_userdata('transaction_id',$result['TRANSACTIONID']);	
					$this->session->set_userdata('payReceivedMsg',' Pending');				
					$this->session->set_userdata('pending_reason',$result['PENDINGREASON']);								
					$this->session->set_userdata('amount',$result['AMT']);				
				    $this->session->set_userdata('ack',$result['ACK']);				
					redirect('programs/programs/'.$paypalData['courses']);	
					$this->session->unset_userdata('paypalData');
				}
				elseif($result['PAYMENTSTATUS'] == 'Failed')// by jayesh
				{
					$this->settings_model->updatePaypalSuccess($upd_data, $pay_Insert);	
					$this->session->set_userdata('transaction_id',$result['TRANSACTIONID']);	
					$this->session->set_userdata('payReceivedMsg','Failed');				
					$this->session->set_userdata('pending_reason',$result['PENDINGREASON']);								
					$this->session->set_userdata('amount',$result['AMT']);	
				    $this->session->set_userdata('ack',$result['ACK']);	
					redirect('programs/programs/'.$paypalData['courses']);	
					$this->session->unset_userdata('paypalData');
				}
				
				/*
				//mail send process
				$from = 'prshah83@gmail.com';
				$to = 'yogeshdangre31aug@gmail.com';
				$message = 'Hi Your payment received. <br> Transaction ID : ';
				$this->load->library('email');
				$this->email->from($from, 'Prashant');
				$this->email->to($to); 
				$this->email->subject('Email Test Payment Received');
				$this->email->message($message);
				$this->email->send();			
				*/
			}//else
	     }//else
		}//else
	}


}