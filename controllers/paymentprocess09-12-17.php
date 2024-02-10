<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paymentprocess extends CI_Controller {

    function Paymentprocess()
    {
         parent::__construct();
         $this->load->library('paypal_class');
         $this->load->library('paypalIPN/paypal_lib');         
         // $this->load->library('form_validation');
         $this->load->library('email');  

        $this->load->model('payment_model');

        $this->load->model('admin/settings_model');
        $this->load->model('admin/programs_model');
        $this->load->model('program_model');
        $this->load->model('login_model');

    }

    function index()
	{
		exit('yeeee');
	}

    function paypal_box($paypalData)
    {
        
        $course_id = $paypalData['course_id'];
        $user_id = $paypalData['user_id'];
        $response_handler = $paypalData['response_handler'];
        $return_handler = $paypalData['return_handler']; 
        $notify_url = $paypalData['notify_url'];                                  
        $course_name = $paypalData['course_name'];
        $course_price = $paypalData['course_price'];
        $instituteid = "";
        $currency_code == $pay_setting[0]['currency'] ? $pay_setting[0]['currency'] : "USD";
        $plan_id = $paypalData['plan_id'];
        if($paypalData['plan_id'])
        {
            $uidpid = $course_id."-".$user_id."-".$plan_id;
        }
        else
        {
            $uidpid = $course_id."-".$user_id; 
        }
        
        $pay_setting = $this->payment_model->getAccountMode();

        if($pay_setting[0]['status']==0)
        {
           $this->paypal_lib->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
           //$businessEmail = $pay_setting[0]['api_username'] ? $pay_setting[0]['api_username'] : "paypal-facilitator@veerit.com";
           
           $businessEmail = $pay_setting[0]['paypal_bsns_email'] ? $pay_setting[0]['paypal_bsns_email'] : "paypal-facilitator@veerit.com";
           $this->paypal_lib->add_field('business',  $businessEmail);
          
        }
        else
        {   
            
            $this->paypal_lib->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
            //$businessEmail = $pay_setting[0]['api_username'] ? $pay_setting[0]['api_username'] : "paypal-facilitator@veerit.com";
            $businessEmail = $pay_setting[0]['paypal_bsns_email'] ? $pay_setting[0]['paypal_bsns_email'] : "paypal-facilitator@veerit.com";
            $this->paypal_lib->add_field('business',  $businessEmail);
          
        }

        

        $this->paypal_lib->add_field('currency_code',$currency_code);
        //$this->paypal_class->add_field('business',  'accountant-facilitator@sailors-club.net'); //  accountant@sailors-club.net  // accountant-facilitator@sailors-club.net  // vikas.gorle@gmail.com
        //$this->paypal_lib->add_field('business',  'paypal-facilitator@veerit.com');
        $this->paypal_lib->add_field('return', $response_handler); // return url
        $this->paypal_lib->add_field('cancel_return', $return_handler); // cancel url

        $item_name = $this->paypal_lib->add_field('item_name', $course_name);
        $amount = $this->paypal_lib->add_field('amount', $course_price);
        //$amount = $this->paypal_class->add_field('amount', '400');
        //$this->paypal_lib->add_field('notify_url', base_url().'paymentprocess/ipn_response_handler'); 
        $this->paypal_lib->add_field('notify_url', $notify_url); 
        $this->paypal_lib->add_field('custom', $uidpid);

        $this->paypal_lib->paypal_auto_form(); 


    }

    function payment_Process()
    {   
        $sessionarray = $this->session->userdata('logged_in');
        //$program_id = $this->uri->segment(3);
        $program_id = $this->input->post('course_id') ? $this->input->post('course_id') : $this->uri->segment(3);
        if(empty($program_id))
        {
        	$program_id = $this->uri->segment(3);
        	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "You are already enrolled to this course" ));
            redirect('course/programs/'.$program_id); 
        }

        $course_details = $this->payment_model->getProgramDetails($program_id);
        $is_Alreadybuy = $this->payment_model->getBuyCourses($sessionarray['id'],$program_id);
        // echo"<pre>";
        // print_r($is_Alreadybuy);
        // exit('yes');
        if(empty($is_Alreadybuy))
        {
                if(!isset($sessionarray))
                {
                    redirect('users/login');
                }
                else
                {

                    $firstname = $sessionarray['first_name'];
                    $lastname = $sessionarray['last_name'];
                    $fullname = $firstname.' '. $lastname;
                    $email = $sessionarray['email'];
                    $user_id = $sessionarray['id'];
                    $pay_setting = $this->payment_model->getAccountMode();
                   

                    $url = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']); 
                    
                    if($pay_setting[0]['status'] == 155) // for Live Mode
                    {

                    }
                    else // for sandbox Mode
                    {
                                      
                        
                        //$course_details = $this->payment_model->getProgramDetails($program_id);
                        
                        if($course_details)
                        {
                            $chb_free_courses = $course_details->chb_free_courses;
                            $step_access_courses = $course_details->step_access_courses;
                            $fixedrate = $course_details->fixedrate;

                            if($fixedrate != 0.00)
                            {  

                                // =================
                                       $coupencode = $this->input->post('coupencode');
                                       $discountprice ="";
                                       $rs = $this->payment_model->getPromoCodeDetails($coupencode);    
                                                                             

                                       if($rs)
                                       {
                                            $typediscount = $rs->typediscount;
                                            $discount = $rs->discount;
                                            $actulrate = $fixedrate;

                                           if($typediscount == 0)
                                            {
                                                $discountprice = $actulrate - $discount;
                                                
                                            }
                                            else if($typediscount == 1)
                                            {                       
                                                $discountprice = $actulrate - ($actulrate *($discount / 100));
                                                
                                            }
                                       }
                                       
                                // ===============

                             $paypalData = array( 
                                'plan_id' => '',
                                'user_id' => $user_id,
                                'response_handler' => base_url().'paymentprocess/response_handler',
                                'return_handler' => base_url().'paymentprocess/return_handler', 
                                'notify_url' => base_url().'paymentprocess/ipn_response_handler',                                
                                'course_name' => $course_details->name,
                                'course_price' => $discountprice ? $discountprice : $course_details->fixedrate,  
                                'course' => $course_details->name, 
                                'course_id' => $program_id,                         
                                );

                            $this->session->set_userdata('paypalData',$paypalData);

                            $this->paypal_box($paypalData); 

                            
                            }
                            else
                            {
                            	$plan_id = $this->input->post('plan_id');

                                $getPlanDetails = $this->payment_model->getPlanDetails($program_id,$plan_id);

                                 // =================
                                       $coupencode = $this->input->post('coupencode');
                                       $discountprice ="";
                                       $rs = $this->payment_model->getPromoCodeDetails($coupencode);    
                                                                             

                                       if($rs)
                                       {
                                            $typediscount = $rs->typediscount;
                                            $discount = $rs->discount;
                                            $actulrate = $getPlanDetails->price;

                                           if($typediscount == 0)
                                            {
                                                $discountprice = $actulrate - $discount;
                                                
                                            }
                                            else if($typediscount == 1)
                                            {                       
                                                $discountprice = $actulrate - ($actulrate *($discount / 100));
                                                
                                            }
                                       }
                                       
                                // ===============

                               $paypalData = array( 
                                'plan_id' => $plan_id,
                                'user_id' => $user_id,
                                'response_handler' => base_url().'paymentprocess/response_handler',
                                'return_handler' => base_url().'paymentprocess/return_handler', 
                                'notify_url' => base_url().'paymentprocess/ipn_response_handler',                                  
                                'course_name' => $course_details->name,
                                'course_price' => $discountprice ? $discountprice : $getPlanDetails->price, 
                                'course' => $course_details->name, 
                                'course_id' => $program_id,                         
                                );

                            $this->session->set_userdata('paypalData',$paypalData);

                            $this->paypal_box($paypalData); 
                                

                            }
                        }
                        else
                        {
                                echo "their no course availble";
                        }               

                    }

                    
                }
        }
        else
        {
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "You are already enrolled to this course" ));
           redirect('course/programs/'.$program_id); 
        }

    }

    function response_handler()
    {       
        $currentdate = date("Y-m-d H:i:s"); 
        $expired_date ="";
        $plan_id = 0;

        $paypalData = $this->session->userdata('paypalData');        
        
        if(!empty($_REQUEST))
        {        

        $order_date = date("Y-m-d H:i:s",strtotime($_REQUEST['payment_date']));

        if($_REQUEST['payment_status'] == 'Completed')
        {
        
            $published = 1;
        }
        else if($_REQUEST['payment_status'] == 'Pending')
        {       
            $published = 0;
        }
        else if($_REQUEST['payment_status'] == 'Failure')
        {
            $published = 0;
        }        
           
           $course_details = $this->payment_model->getProgramDetails($paypalData['course_id']);

           $is_Alreadybuy = $this->payment_model->getBuyCourses($paypalData['user_id'],$paypalData['course_id']);
           
           $getOrderDetails = $this->payment_model->getOrderDetails($paypalData['user_id'],$paypalData['course_id'],$_REQUEST['txn_id']);

           if(empty($is_Alreadybuy))
           {
           		if(empty($getOrderDetails))
           		{
			        $upd_data = array(
			                        'userid' => $paypalData['user_id'], 
			                        'order_date' => $currentdate,                                  
			                        'courses' => $paypalData['course_id'],                        
			                        'status' => $_REQUEST['payment_status'],
			                        'pending_reason' => $_REQUEST['pending_reason'] ? $_REQUEST['pending_reason']:'none',
			                        'amount' => $_REQUEST['payment_gross'],
			                        'amount_paid' => $_REQUEST['payment_gross'],
			                        'processor' => 'paypal',
			                        'currency' => $_REQUEST['mc_currency'],
			                        'published' => $published,
			                        'transactionid' =>$_REQUEST['txn_id'],
			                        'order_status' =>'New Order'
			                         );

			         $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data); 
			    }
			    else
			    {

			    	$upd_data = array(
		         					'order_date' => $currentdate,
									'status' => $_REQUEST['payment_status']
									 );

					$pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
			    }


			       	   if($_REQUEST['payment_status'] == 'Completed')
			           {
			           		$fixedrate = $course_details->fixedrate;

                            if($fixedrate == 0.00)
                            {   
                                
                                $custom_array = explode('-',$_REQUEST['custom']);

                                $getPlanDetails = $this->payment_model->getPlanDetails($custom_array['0'],$custom_array['2']);
                                                                
                            	if($getPlanDetails->period == 'Month(s)')
									{			   
										$future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
										$date = strtotime(date('Y-m-d'));  // if today :2013-05-23

										$expired_date = date('Y-m-d',strtotime($future_date,$date));	 
					                    $plan_id = $getPlanDetails->plan_id; 						
									}
									elseif($getPlanDetails->period == 'Year(s)')
									{
										$future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
										$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
										$expired_date = date('Y-m-d',strtotime($future_date,$date));
										$plan_id = $getPlanDetails->plan_id;
									}


                            }

				            $buyCourseDetails = array(
				                    'userid' => $paypalData['user_id'],
				                    'order_id' => $pay_Insert,
				                    'course_id' => $paypalData['course_id'],
				                    'price' => $_REQUEST['payment_gross'],
				                    'currency' => $_REQUEST['mc_currency'],
				                    'buy_date' => $currentdate,
				                    'expired_date' => $expired_date,
				                    'plan_id' => $plan_id,
				                    'email_send' => 1,
				                    'finalexam_status' => "notgiven",
				                    'average' => 0,
				                    'finalexamid' => 0,
				                    'certification' => "notissued",
				                    'status' => 0,
				                     );
				                   
			           
				            $buy_courses = $this->payment_model->insertBuyCourseNew($buyCourseDetails);

				            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
				       
				            $urlCourse = strtolower($paypalData['course']);          
				            $urlCourse = trim(str_replace(' ', '-', $urlCourse));
				            $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);	          
				           
				            redirect('programs/lectures/'.$paypalData['course_id']); 
			            
			        	}

		    }
		    else
		    {
		           $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
		           redirect('programs/lectures/'.$paypalData['course_id']);
		    }


        }
        else
        {
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
            redirect('programs/lectures/'.$paypalData['course_id']);
        }

        //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
          //redirect('programs/lectures/'.$paypalData['course_id']);
        
    }

    function return_handler()
    {
       $paypalData = $this->session->userdata('paypalData');
       //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
       redirect('programs/lectures/'.$paypalData['course_id']);
    }


        function ipn_response_handler()
        {	
            $expired_date ="";
            $plan_id =0;

           $ipn_valid = $this->paypal_lib->validate_ipn();
            if($ipn_valid == TRUE)
            {
                $paypalURL = $this->paypal_lib->paypal_url; 
                $paypalInfo = $this->paypal_lib->ipn_data;
                //$paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';    
                $result = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
                    
                if(preg_match("/VERIFIED/i",$result))
                {
                	 $currentdate = date("Y-m-d H:i:s"); 
                	 $userNcourse_id = explode('-',$this->paypal_lib->ipn_data['custom']);

					 $course_id = $userNcourse_id[0];
					 $user_id = $userNcourse_id[1];
					 $txn_id = $this->paypal_lib->ipn_data['txn_id'];
					 $payment_status = $this->paypal_lib->ipn_data['payment_status'];
					 $mc_gross = $this->paypal_lib->ipn_data['mc_gross'];
					 $mc_fee = $this->paypal_lib->ipn_data['mc_fee'];
					 $mc_currency = $this->paypal_lib->ipn_data['mc_currency'];
					 $item_number = $this->paypal_lib->ipn_data['item_number']; 

					 $course_details = $this->payment_model->getProgramDetails($course_id);

					 $getOrderDetails = $this->payment_model->getOrderDetails($user_id,$course_id,$txn_id);

					 $txn_details = array('txn_id' => $txn_id,
					 					  'payment_status' => $payment_status,
					 					  'mc_gross' => $mc_gross,
					 					  'mc_currency' => $mc_currency ); 
                     
                    if($payment_status=="Completed")
                    {
		                

		                $is_Alreadybuy = $this->payment_model->getBuyCourses($user_id,$course_id);
					    if(empty($is_Alreadybuy))
					    {
					        if(empty($getOrderDetails))
					        {
						            $upd_data = array(
						                        'userid' => $user_id,
						                        'order_date' => $currentdate,                                  
						                        'courses' => $course_id,                        
						                        'status' => $payment_status,
						                        'pending_reason' => 'none',//$_REQUEST['pending_reason'] ? $_REQUEST['pending_reason']:'none',
						                        'amount' => $mc_gross,
						                        'amount_paid' => $mc_gross,
						                        'processor' => 'paypal',
						                        'currency' => $mc_currency,
						                        'published' => 1,
						                        'transactionid' =>$txn_id,
						                        'order_status' =>'New Order'
						                         );

						        	$pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
					         }
					         else
					         {
						         	$upd_data = array(
						         					'order_date' => $currentdate,
													'status' => $payment_status
													 );

					         		$pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
					         }

					        
					        if($payment_status == 'Completed')
					        {
					           
                               $fixedrate = $course_details->fixedrate;

                                if($fixedrate == 0.00)
                                {   
                                    
                                    $custom_array = explode('-',$_REQUEST['custom']);

                                    $getPlanDetails = $this->payment_model->getPlanDetails($custom_array['0'],$custom_array['2']);
                                                                    
                                    if($getPlanDetails->period == 'Month(s)')
                                        {              
                                            $future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
                                            $date = strtotime(date('Y-m-d'));  // if today :2013-05-23

                                            $expired_date = date('Y-m-d',strtotime($future_date,$date));     
                                            $plan_id = $getPlanDetails->plan_id;                        
                                        }
                                        elseif($getPlanDetails->period == 'Year(s)')
                                        {
                                            $future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
                                            $date=strtotime(date('Y-m-d'));  // if today :2013-05-23
                                            $expired_date = date('Y-m-d',strtotime($future_date,$date));
                                            $plan_id = $getPlanDetails->plan_id;
                                        }


                                }



                                $buyCourseDetails = array(
						                    'userid' => $user_id,
						                    'order_id' => $pay_Insert,
						                    'course_id' => $course_id,
						                    'price' => $mc_gross,
						                    'currency' => $mc_currency,
						                    'buy_date' => $currentdate,
						                    'expired_date' => $expired_date,
						                    'plan_id' => $plan_id,
						                    'email_send' => 1,
						                    'finalexam_status' => "notgiven",
						                    'average' => 0,
						                    'finalexamid' => 0,
						                    'certification' => "notissued",
						                    'status' => 0,
						                     );
					                   
					           
					            $buy_courses = $this->payment_model->insertBuyCourseNew($buyCourseDetails);

					            $this->sendEmailToNewPayment($user_id,$course_id,$txn_details);
					        }

					    }
					    

                    }
                    else
                    {
                    	if(empty($getOrderDetails))
					        {
						            $upd_data = array(
						                        'userid' => $user_id,
						                        'order_date' => $currentdate,                                  
						                        'courses' => $course_id,                        
						                        'status' => $payment_status,
						                        'pending_reason' => $_REQUEST['pending_reason'] ? $_REQUEST['pending_reason']:'none',
						                        'amount' => $mc_gross,
						                        'amount_paid' => $mc_gross,
						                        'processor' => 'paypal',
						                        'currency' => $mc_currency,
						                        'published' => 0,
						                        'transactionid' =>$_REQUEST['txn_id'],
						                        'order_status' =>'New Order'
						                         );

						        	$pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
					         }
					         else
					         {
						         	$upd_data = array(
						         					'order_date' => $currentdate,
													'status' => $payment_status
													 );

					         		$pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
					         } 
                    }
                    

                    // $urldomain = base_url();
                    // $urldomain = str_replace('http://', '', $urldomain);
                    // $urldomain = str_replace('/', '', $urldomain);
                    // $urldomain = str_replace('www.', '', $urldomain);
                   
                    // $subject1 = 'Your course renewed successfully';
                    // $toemail1 = "veerit1511@gmail.com"; 
                    // $content = '';
                    // $content .= 'Thank you for renewing your course subscription. Here are your renewal details: <br /><br />';
                    // //$content .= "Course renewed: ".$user_id."<br />";
                    // $content .= ' User Id: '.$user_id.'<br />';
                    // $content .= ' Course Id: '.$course_id.'<br />';
                    // $content .= ' Transaction Id: '.$txn_id.'<br />';
                    // $content .= ' Amount: '.$mc_gross.'<br />';
                    // $content .= ' Status: '.$payment_status.'<br /><br />';                    
                    
                    // $data['content'] = $content;
                    // $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
                    // $fromemail1 = 'noreply@'.$urldomain;       //$configarr[0]['fromemail'];// admin mail
                    // $config['charset'] = 'utf-8';
                    // $config['mailtype'] = 'html';
                    // $config['wordwrap'] = TRUE;
                    // $this->email->initialize($config);
                    // $this->email->from($fromemail1,"testing");// admin mail);
                    // $this->email->subject($subject1);
                    // $this->email->to($toemail1);
                    // $this->email->message($message1);
                    // $this->email->send(); 
                } 

            }
        }


function sendEmailToNewPayment($user_id,$course_id,$txn_details)
        {

         	 $configarr = $this->payment_model->getItems();
			 $course_details = $this->payment_model->getProgramDetails($course_id);        			
			 $userdetail = $this->payment_model->getAllUsersDetail($user_id); 
			 $authordetail = $this->payment_model->getAllUsersDetail($course_details->author); 
			 $admininfo = $this->payment_model->getadminInfo(4);


				$user_email = $userdetail->email;
				$user_first_name = $userdetail->first_name;
				$user_last_name = $userdetail->last_name;

				$course_name = $course_details->name;
						
				$author_email = $authordetail->email;
				$author_first_name = $authordetail->first_name;
				$author_last_name = $authordetail->last_name;	

				$admin_email = $admininfo->email;
				$admin_first_name = $admininfo->first_name;

			
				$urldomain = base_url();
				$urldomain = str_replace('http://', '', $urldomain);
				$urldomain = str_replace('/', '', $urldomain);
				$urldomain = str_replace('www.', '', $urldomain);

				

        	//1. Order mail to user for purchase
				$subject1 = 'Your course purchase details - '.$configarr[0]['institute_name'];
				$toemail1 = $user_email; // $userdetail->email
				$content = '';					
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
				$content .= '<p>Hi '.trim(ucfirst($user_first_name)).',<br /><br />';
				$content .= 'Thank you for your purchase. Here are your course purchase details:<br /><br />';
				$content .= ' Course Name: '.$course_name.'<br />';
				$content .= ' Transaction Id: '.$txn_details['txn_id'].'<br />';
				$content .= ' Status: '.$txn_details['payment_status'].'<br />';
				$content .= ' Amount: '.$txn_details['mc_gross'].' '.$txn_details['mc_currency'].'<br /><br />';
				$content .= " Your purchase was successfull! You can find ".$course_name." under the menu 'My Courses' in the Academy once you login.<br /><br />";
				$content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> ';
				
				$data['content'] = $content;
				$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
				$fromemail1= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject1);
				$this->email->to($toemail1);
				$this->email->message($message1);
				$this->email->send();				
			
			//2. Mail To user for enrolled
				//$subject1 = trim(ucfirst($user_first_name)).' has enrolled to '.$course_name;
				$subject1 = "You have Enrolled Successfully to '".$course_name."' in ".$configarr[0]['institute_name'];
				$toemail1 = $user_email;
				$content = '';
				
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> You have Enrolled Successfully to "'.$course_name.'" in '.$configarr[0]['institute_name'].'</p>';
				$content .= '<p>Hello '.trim(ucfirst($user_first_name)).',<br /><br />';
				$content .= " You have Successfully enrolled in '".$course_name."'! You can now find '".$course_name."' under the menu 'My Courses' in  <a style='color: #55c5eb;' href =".base_url().">".base_url()." </a>  once you log in.<br /><br />";
				$content .=' If you need help or have any questions, please contact us.<br />';
				
				$data['content'] = $content;
				$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
				$fromemail1 = 'noreply@'.$urldomain;         //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject1);
				$this->email->to($toemail1);
				$this->email->message($message1);
				$this->email->send();	


			//3. mail to teacher has enrolled
				
				$subject2 = trim(ucfirst($user_first_name)).' has enrolled to '.$course_name;
				$toemail2 = $author_email;
				$content = '';				
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($user_first_name)).' has enrolled to '.$course_name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($author_first_name)).',<br /><br />';
				$content .=  trim(ucfirst($user_first_name))." ".trim(ucfirst($user_last_name))." has Successfully enrolled in '".$course_name."'.<br /><br />";
				$content .='If you need help or have any questions, please contact us.<br />';
				
				$data['content'] = $content;
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

			//4. Mail To admin for purchased details

				$subject1 = 'New course purchased in '.$configarr[0]['institute_name'];
				$toemail3 = $admin_email;// admin mail
				$content = '';	
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">New course purchased in '.$configarr[0]['institute_name'].'</p>';
				$content .= '<p>Dear '.trim(ucfirst($admin_first_name)).',<br /><br />';					
				$content .= trim(ucfirst($user_first_name)).' have made a purchase of a course. The details are given below: <br /><br /> ';
				$content .= ' Course Name: '.$course_name.'<br />';
				$content .= ' Transaction Id: '.$txn_details['txn_id'].'<br />';
				$content .= ' Status: '.$txn_details['payment_status'].'<br />';					
				$content .= ' Amount: '.$txn_details['mc_gross'].' '.$txn_details['mc_currency'].'<br />';					
				$data['content'] = $content;

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


			//5. Mail To admin for enrolled
				
			    $subject3 = trim(ucfirst($user_first_name)).' has enrolled to '.$course_name;
				$toemail3 = $admin_email;// admin mail
				$content = '';	
				
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($user_first_name)).' has enrolled to '.$course_name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($admin_first_name)).',<br /><br />';
				$content .=  trim(ucfirst($user_first_name))." ".trim(ucfirst($user_last_name))."  has Successfully enrolled in '".$course_name."!'.<br /><br />";
				$content .='If you need help or have any questions, please contact us.<br />';
				
				$data['content'] = $content;
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


        }

   function renew_payment_process()
   {
        $sessionarray = $this->session->userdata('logged_in');
        //$program_id = $this->uri->segment(3);
        $program_id = $this->input->post('course_id') ? $this->input->post('course_id') : $this->uri->segment(3);
        if(empty($program_id))
        {
            $program_id = $this->uri->segment(3);
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "You are already enrolled to this course" ));
            redirect('course/programs/'.$program_id); 
        }

        $course_details = $this->payment_model->getProgramDetails($program_id);
        $is_Alreadybuy = $this->payment_model->getBuyCourses($sessionarray['id'],$program_id);

        if($is_Alreadybuy)
        {

        if(!isset($sessionarray))
            {
                redirect('users/login');
            }
            else
            {
                $firstname = $sessionarray['first_name'];
                $lastname = $sessionarray['last_name'];
                $fullname = $firstname.' '. $lastname;
                $email = $sessionarray['email'];
                $user_id = $sessionarray['id'];
                $pay_setting = $this->payment_model->getAccountMode();
               

                $url = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']); 
                
                if($pay_setting[0]['status'] == 155) // for Live Mode
                {

                }
                else // for sandbox Mode
                {

                    if($course_details)
                        {
                               $chb_free_courses = $course_details->chb_free_courses;
                               $step_access_courses = $course_details->step_access_courses;
                               $fixedrate = $course_details->fixedrate;

                            if($fixedrate == 0.00)
                            {
                                $plan_id = $this->input->post('plan_id');

                                $getPlanDetails = $this->payment_model->getRenewPlanDetails($program_id,$plan_id);


                               $paypalData = array( 
                                'plan_id' => $plan_id,
                                'user_id' => $user_id,
                                'response_handler' => base_url().'paymentprocess/renew_response_handler',
                                'return_handler' => base_url().'paymentprocess/renew_return_handler',                                   
                                'notify_url' => base_url().'paymentprocess/renew_ipn_response_handler',                                
                                'course_name' => $course_details->name,
                                'course_price' => $getPlanDetails->price, 
                                'course' => $course_details->name, 
                                'course_id' => $program_id,                         
                                );

                              $this->session->set_userdata('paypalData',$paypalData);

                              $this->paypal_box($paypalData); 
                             

                            }
                        }
                        else
                        {
                                echo "their no course availble";
                        } 



                }




            }

        }
        else
        {
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "You are already enrolled to this course" ));
           redirect('course/programs/'.$program_id); 
        }

   }

   function renew_response_handler()
   {    
        $currentdate = date("Y-m-d H:i:s"); 
        $expired_date ="";
        $plan_id =0;
        $paypalData = $this->session->userdata('paypalData');        
        
        if(!empty($_REQUEST))
        {
                 if($_REQUEST['payment_status'] == 'Completed')
                       {
                            
                            
                            // =============================================
                                   

                                    $course_id = $paypalData['course_id'];
                                    $user_id =  $paypalData['user_id'];
                                    $txn_id = $_REQUEST['txn_id'];
                                    $payment_status = $_REQUEST['payment_status'];
                                    $mc_gross =  $_REQUEST['mc_gross'];
                                    $mc_currency = $_REQUEST['mc_currency'];


                                     $course_details = $this->payment_model->getProgramDetails($course_id);

                                     $getOrderDetails = $this->payment_model->getOrderDetails($user_id,$course_id,$txn_id);

                                     $txn_details = array('txn_id' => $txn_id,
                                                          'payment_status' => $payment_status,
                                                          'mc_gross' => $mc_gross,
                                                          'mc_currency' => $mc_currency ); 
                                     
                                    if($payment_status=="Completed")
                                    {
                                        

                                        $is_Alreadybuy = $this->payment_model->getBuyCourses($user_id,$course_id);
                                        if($is_Alreadybuy)
                                        {
                                            if(empty($getOrderDetails))
                                            {
                                                    $upd_data = array(
                                                                'userid' => $user_id,
                                                                'order_date' => $currentdate,                                  
                                                                'courses' => $course_id,                        
                                                                'status' => $payment_status,
                                                                'pending_reason' => 'none',//$_REQUEST['pending_reason'] ? $_REQUEST['pending_reason']:'none',
                                                                'amount' => $mc_gross,
                                                                'amount_paid' => $mc_gross,
                                                                'processor' => 'paypal',
                                                                'currency' => $mc_currency,
                                                                'published' => 1,
                                                                'transactionid' =>$txn_id,
                                                                'order_status' =>'Renew Order'
                                                                 );

                                                    $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
                                             

                                            
                                            if($payment_status == 'Completed')
                                            {
                                               
                                               $fixedrate = $course_details->fixedrate;

                                                if($fixedrate == 0.00)
                                                {   
                                                    
                                                    
                                                    $custom_array = explode('-',$_REQUEST['custom']);

                                                   $getPlanDetails = $this->payment_model->getRenewPlanDetails($custom_array['0'],$custom_array['2']);
                                                   
                                                    $date = strtotime(date('Y-m-d'));

                                                    $expired_datenew = Date('Y-m-d', strtotime($is_Alreadybuy->expired_date));

                                                    $datetime2 = new DateTime($expired_datenew);
                                                    $interval = date_create('now')->diff($datetime2);                               
                                                    $replacedays  = str_replace('days','',$interval->format('%R%a days'));
                                                    //$replaceplus  = str_replace('+','',$replacedays);
                                                    //$replacefinal  = str_replace('-','',$replaceplus);

                                                   if(0 < $replacedays)
                                                   {
                                                      $date = strtotime(date('Y-m-d', strtotime($interval->format('%R%a days'))));
                                                      
                                                   }

                                                    if($getPlanDetails->period == 'Month(s)')
                                                        {              
                                                            $future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
                                                           // $date = strtotime(date('Y-m-d'));  // if today :2013-05-23

                                                            $expired_date = date('Y-m-d',strtotime($future_date,$date));     
                                                            $plan_id = $getPlanDetails->plan_id;                        
                                                        }
                                                        elseif($getPlanDetails->period == 'Year(s)')
                                                        {
                                                            $future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
                                                            //$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
                                                            $expired_date = date('Y-m-d',strtotime($future_date,$date));
                                                            $plan_id = $getPlanDetails->plan_id;
                                                        }


                                                }



                                                $buyCourseDetails = array(
                                                            'userid' => $user_id,
                                                            'order_id' => $pay_Insert,
                                                            'course_id' => $course_id,
                                                            'price' => $mc_gross,
                                                            'currency' => $mc_currency,
                                                            'buy_date' => $currentdate,
                                                            'expired_date' => $expired_date,
                                                            'plan_id' => $plan_id,
                                                            'email_send' => 1,
                                                            'finalexam_status' => "notgiven",
                                                            'average' => 0,
                                                            'finalexamid' => 0,
                                                            'certification' => "notissued",
                                                            'status' => 0,
                                                             );                                       
                                               
                                                
                                                $data1 = array('userid' => $user_id,
                                                           'courses' => $course_id, );

                                                $buy_courses = $this->payment_model->updateBuyCourse($data1, $pay_Insert, $mc_currency, $currentdate, $expired_date, $plan_id, $mc_gross, $is_Alreadybuy->id);

                                                $this->sendEmailToRenewPayment($user_id,$course_id,$txn_details);
                                            }

                                            }
                                           else
                                            {
                                                $upd_data = array(
                                                                'order_date' => $currentdate,
                                                                'status' => $payment_status
                                                                 );

                                                $pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
                                           }

                                        }
                                        

                                    }

                       
                            // ==============================================

                            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
                       
                            $urlCourse = strtolower($paypalData['course']);          
                            $urlCourse = trim(str_replace(' ', '-', $urlCourse));
                            $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);            
                           
                            redirect('programs/lectures/'.$paypalData['course_id']); 
                        }            
                        else if($_REQUEST['payment_status'] == 'Pending')
                        {
                            //    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
                       
                            // $urlCourse = strtolower($paypalData['course']);          
                            // $urlCourse = trim(str_replace(' ', '-', $urlCourse));
                            // $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);            
                           
                            redirect('programs/lectures/'.$paypalData['course_id']); 

                        }
                        else
                        {
                            ///$this->session->set_flashdata('message', array( 'type' => 'worning', 'text' => "Enrolled Failed, Now you can view this lessons under My Course" ));
                               redirect('programs/lectures/'.$paypalData['course_id']);

                        }

            }
            else
            {
                redirect('programs/lectures/'.$paypalData['course_id']); 
            }


   }

   function renew_ipn_response_handler()
   {
        

    // ======================================================
        $expired_date ="";
            $plan_id =0;

           $ipn_valid = $this->paypal_lib->validate_ipn();
            if($ipn_valid == TRUE)
            {
                $paypalURL = $this->paypal_lib->paypal_url; 
                $paypalInfo = $this->paypal_lib->ipn_data;
                //$paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';    
                $result = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
                    
                if(preg_match("/VERIFIED/i",$result))
                {
                     $currentdate = date("Y-m-d H:i:s"); 
                     $userNcourse_id = explode('-',$this->paypal_lib->ipn_data['custom']);

                     $course_id = $userNcourse_id[0];
                     $user_id = $userNcourse_id[1];
                     $txn_id = $this->paypal_lib->ipn_data['txn_id'];
                     $payment_status = $this->paypal_lib->ipn_data['payment_status'];
                     $mc_gross = $this->paypal_lib->ipn_data['mc_gross'];
                     $mc_fee = $this->paypal_lib->ipn_data['mc_fee'];
                     $mc_currency = $this->paypal_lib->ipn_data['mc_currency'];
                     $item_number = $this->paypal_lib->ipn_data['item_number']; 

                     $course_details = $this->payment_model->getProgramDetails($course_id);

                     $getOrderDetails = $this->payment_model->getOrderDetails($user_id,$course_id,$txn_id);

                     $txn_details = array('txn_id' => $txn_id,
                                          'payment_status' => $payment_status,
                                          'mc_gross' => $mc_gross,
                                          'mc_currency' => $mc_currency ); 
                     
                    if($payment_status=="Completed")
                    {
                        

                        $is_Alreadybuy = $this->payment_model->getBuyCourses($user_id,$course_id);
                        if($is_Alreadybuy)
                        {
                            if(empty($getOrderDetails))
                            {
                                    $upd_data = array(
                                                'userid' => $user_id,
                                                'order_date' => $currentdate,                                  
                                                'courses' => $course_id,                        
                                                'status' => $payment_status,
                                                'pending_reason' => 'none',//$_REQUEST['pending_reason'] ? $_REQUEST['pending_reason']:'none',
                                                'amount' => $mc_gross,
                                                'amount_paid' => $mc_gross,
                                                'processor' => 'paypal',
                                                'currency' => $mc_currency,
                                                'published' => 1,
                                                'transactionid' =>$txn_id,
                                                'order_status' =>'Renew Order'
                                                 );

                                    $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
                             // }
                             // else
                             // {
                             //        $upd_data = array(
                             //                        'order_date' => $currentdate,
                             //                        'status' => $payment_status
                             //                         );

                             //        $pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
                             // }

                            
                            if($payment_status == 'Completed')
                            {
                               
                               $fixedrate = $course_details->fixedrate;

                                if($fixedrate == 0.00)
                                {   
                                    
                                    
                                    $custom_array = explode('-',$_REQUEST['custom']);

                                   $getPlanDetails = $this->payment_model->getRenewPlanDetails($custom_array['0'],$custom_array['2']);
                                   
                                    $date = strtotime(date('Y-m-d'));

                                    $expired_datenew = Date('Y-m-d', strtotime($is_Alreadybuy->expired_date));

                                    $datetime2 = new DateTime($expired_datenew);
                                    $interval = date_create('now')->diff($datetime2);                               
                                    $replacedays  = str_replace('days','',$interval->format('%R%a days'));
                                    //$replaceplus  = str_replace('+','',$replacedays);
                                    //$replacefinal  = str_replace('-','',$replaceplus);

                                   if(0 < $replacedays)
                                   {
                                      $date = strtotime(date('Y-m-d', strtotime($interval->format('%R%a days'))));
                                      
                                   }

                                    if($getPlanDetails->period == 'Month(s)')
                                        {              
                                            $future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
                                           // $date = strtotime(date('Y-m-d'));  // if today :2013-05-23

                                            $expired_date = date('Y-m-d',strtotime($future_date,$date));     
                                            $plan_id = $getPlanDetails->plan_id;                        
                                        }
                                        elseif($getPlanDetails->period == 'Year(s)')
                                        {
                                            $future_date = "+".$getPlanDetails->term.' '.substr($getPlanDetails->period,0,5);
                                            //$date=strtotime(date('Y-m-d'));  // if today :2013-05-23
                                            $expired_date = date('Y-m-d',strtotime($future_date,$date));
                                            $plan_id = $getPlanDetails->plan_id;
                                        }


                                }



                                $buyCourseDetails = array(
                                            'userid' => $user_id,
                                            'order_id' => $pay_Insert,
                                            'course_id' => $course_id,
                                            'price' => $mc_gross,
                                            'currency' => $mc_currency,
                                            'buy_date' => $currentdate,
                                            'expired_date' => $expired_date,
                                            'plan_id' => $plan_id,
                                            'email_send' => 1,
                                            'finalexam_status' => "notgiven",
                                            'average' => 0,
                                            'finalexamid' => 0,
                                            'certification' => "notissued",
                                            'status' => 0,
                                             );
                                       
                               
                                //$buy_courses = $this->payment_model->insertBuyCourseNew($buyCourseDetails);

                                //$this->sendEmailToNewPayment($user_id,$course_id,$txn_details);
                                
                                $data1 = array('userid' => $user_id,
                                           'courses' => $course_id, );

                                $buy_courses = $this->payment_model->updateBuyCourse($data1, $pay_Insert, $mc_currency, $currentdate, $expired_date, $plan_id, $mc_gross, $is_Alreadybuy->id);

                                $this->sendEmailToRenewPayment($user_id,$course_id,$txn_details);
                            }

                         }
                         else
                         {
                                $upd_data = array(
                                                'order_date' => $currentdate,
                                                'status' => $payment_status
                                                 );

                                $pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
                         }

                    }
                        

                    }
                    else
                    {
                        if(empty($getOrderDetails))
                            {
                                    $upd_data = array(
                                                'userid' => $user_id,
                                                'order_date' => $currentdate,                                  
                                                'courses' => $course_id,                        
                                                'status' => $payment_status,
                                                'pending_reason' => $_REQUEST['pending_reason'] ? $_REQUEST['pending_reason']:'none',
                                                'amount' => $mc_gross,
                                                'amount_paid' => $mc_gross,
                                                'processor' => 'paypal',
                                                'currency' => $mc_currency,
                                                'published' => 0,
                                                'transactionid' =>$_REQUEST['txn_id'],
                                                'order_status' =>'New Order'
                                                 );

                                    $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
                             }
                             else
                             {
                                    $upd_data = array(
                                                    'order_date' => $currentdate,
                                                    'status' => $payment_status
                                                     );

                                    $pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
                             } 
                    }
                    

                    
                } 

            }

    // ======================================================


   }

   function renew_return_handler()
   {
      
        redirect('my-courses/');
   }


   function sendEmailToRenewPayment($user_id,$course_id,$txn_details)
        {

             $configarr = $this->payment_model->getItems();
             $course_details = $this->payment_model->getProgramDetails($course_id);                 
             $userdetail = $this->payment_model->getAllUsersDetail($user_id); 
             $authordetail = $this->payment_model->getAllUsersDetail($course_details->author); 
             $admininfo = $this->payment_model->getadminInfo(4);


                $user_email = $userdetail->email;
                $user_first_name = $userdetail->first_name;
                $user_last_name = $userdetail->last_name;

                $course_name = $course_details->name;
                        
                $author_email = $authordetail->email;
                $author_first_name = $authordetail->first_name;
                $author_last_name = $authordetail->last_name;   

                $admin_email = $admininfo->email;
                $admin_first_name = $admininfo->first_name;

            
                $urldomain = base_url();
                $urldomain = str_replace('http://', '', $urldomain);
                $urldomain = str_replace('/', '', $urldomain);
                $urldomain = str_replace('www.', '', $urldomain);

                

            //1. Order mail to user for renew
                 
                 // ===================================================
                    $subject1 = 'Your course renewed successfully - '.$configarr[0]['institute_name'];
                    $toemail1 = $user_email; // $userdetail->email
                    $content = '';                    
                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course renewed successfully - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Dear '.trim(ucfirst($user_first_name)).',<br /><br />';
                    $content .= 'Thank you for renewing your course subscription. Here are your renewal details:<br /><br />';
                    $content .= "Course renewed: ".$course_name."<br />";
                    $content .= ' Transaction Id: '.$txn_details['txn_id'].'<br />';
                    $content .= ' Amount: '.$txn_details['mc_gross'].' '.$txn_details['mc_currency'].'<br />';
                    $content .= ' Status: '.$txn_details['payment_status'].'<br /><br />';
                    $content .= " You can find ".$programinfo->name." under the menu 'My Courses' in the Academy once you login.<br /><br />";
                    $content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /><br />';
                    $content .=' If you need help or have any questions, please contact us.<br />';
                   
                    
                    $data['content'] = $content;
                    $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
                    $fromemail1= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];// admin mail
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
                    $this->email->subject($subject1);
                    $this->email->to($toemail1);
                    $this->email->message($message1);
                    $this->email->send(); 
                // =======================================================
        //2. mail to teacher for renew

                    $subject2 = 'Course renewed successfully - '.$configarr[0]['institute_name'];
                    $toemail2 = $author_email;

                    $content = '';                    
                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Course renewed successfully - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Dear '.trim(ucfirst($author_first_name)).',<br /><br />';
                    $content .=  trim(ucfirst($user_first_name)).' '.trim(ucfirst($user_last_name)).' has renewed their subscribed course. Here are the renewal details: <br /><br />';
                    $content .= " Course Name: '".$course_name."' course.<br />";
                    $content .= ' Transaction Id: '.$txn_details['txn_id'].'<br />';
                    $content .= ' Amount: '.$txn_details['mc_gross'].'<br />';
                    $content .= ' Status: '.$txn_details['payment_status'].'<br />';
                    
                    
                    $data['content'] = $content;
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

                //========================================================
                //3. mail to admin for renew    

                    $subject3 = 'Course renewed successfully - '.$configarr[0]['institute_name'];
                    $toemail3 = $admin_email;

                    $content = '';                    
                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Course renewed successfully - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Dear '.trim(ucfirst($admin_first_name)).',<br /><br />';
                    $content .=  trim(ucfirst($user_first_name)).' '.trim(ucfirst($user_last_name)).' has renewed their subscribed course. Here are the renewal details: <br /><br />';
                    $content .= " Course Name: '".$course_name."' course.<br />";
                    $content .= ' Transaction Id: '.$txn_details['txn_id'].'<br />';
                    $content .= ' Amount: '.$txn_details['mc_gross'].'<br />';
                    $content .= ' Status: '.$txn_details['payment_status'].'<br />';
                    
                    
                    $data['content'] = $content;
                    $message2 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
                    $fromemail2 = 'noreply@'.$urldomain; //$configarr[0]['fromemail'];// admin mail
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail2, $configarr[0]['fromname']);// admin mail);
                    $this->email->subject($subject3);
                    $this->email->to($toemail3);
                    $this->email->message($message2);
                    $this->email->send(); 
                
                       
                //========================================================    


        }


}


?>