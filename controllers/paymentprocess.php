<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paymentprocess extends CI_Controller {

    function Paymentprocess()
    {
         parent::__construct();
         $this->load->library('paypal_class');
         $this->load->library('paypalIPN/paypal_lib');
         // $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('myinfo_model');

        $this->load->model('payment_model');

        $this->load->model('admin/settings_model');
        $this->load->model('admin/programs_model');
        $this->load->model('orders_model');
        $this->load->model('program_model');
        $this->load->model('login_model');
        $this->load->model('Crud_model');
        $this->load->helper('cookie');
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

        $pay_setting = $this->payment_model->getAccountMode();


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

        if($_POST['submit'] == 'Direct Payment')
        {

            $this->direct_Payment();

        }
        else if(strtolower($_POST['submit']) == 'pay now' || strtolower($_POST['submit']) == 'go to paypal')
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
                            $demoprice = $course_details->demoprice;

                            if($fixedrate != 0.00 || $demoprice != 0.00)
                            {
                                // =================
                                if($fixedrate != 0.00){
                                    $course_mrp = $fixedrate;
                                  }
                                 else{
                                    $course_mrp = $demoprice;
                                  }



                                       $coupencode = $this->input->post('coupencode');
                                       $discountprice ="";
                                       $rs = $this->payment_model->getPromoCodeDetails($coupencode);


                                       if($rs)
                                       {
                                            $typediscount = $rs->typediscount;
                                            $discount = $rs->discount;
                                            if($fixedrate != 0.00){
                                                $actulrate = $fixedrate;
                                            }
                                            else{
                                                $actulrate = $demoprice;

                                                 }

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
                                'course_price' => $discountprice ? $discountprice : $course_mrp,
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

    }

    function response_handler()
    {
        $currentdate = date("Y-m-d H:i:s");
        $expired_date ="";
        $plan_id = 0;

        $paypalData = $this->session->userdata('paypalData');


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
			                        'order_status' =>'New Order',
                                    'referred_code' => $referred_code
			                         );

			         $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
			    }
			    else
			    {

			    	$upd_data = array(
		         					'order_date' => $currentdate,
									'status' => $_REQUEST['payment_status']
									 );

					$pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$paypalData['user_id'],$paypalData['course_id'],$_REQUEST['txn_id']);
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


        //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
          //redirect('programs/lectures/'.$paypalData['course_id']);

    }

    function return_handler()
    {
            $this->load->model('admin/settings_model');
            $this->load->model('admin/programs_model');
            $this->load->model('Program_model');
            $this->load->model('myinfo_model');
            $this->load->model('orders_model');
            $this->load->model('login_model');


       $paypalData = $this->session->userdata('paypalData');

       $currentdate = date("Y-m-d H:i:s");
       $published = 1;
       $upd_data = array(
                        'userid' => $paypalData['user_id'],
                        'order_date' => $currentdate,
                        'courses' => $paypalData['course_id'],
                        'status' => 'Failure',
                        'pending_reason' => "Cancel Order",
                        'amount' => $paypalData['course_price'],
                        'amount_paid' => $paypalData['course_price'],
                        'processor' => 'paypal',
                        'currency' => "USD",
                        'published' => $published,
                        'transactionid' =>"cancel",
                        'order_status' =>'Failure',
                        'referred_code' =>$referred_code
                         );

            $price = $paypalData['course_price'];

         $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);

         if($pay_Insert)
         {
                    // $urldomain = base_url();
                    // $urldomain = str_replace('http://', '', $urldomain);
                    // $urldomain = str_replace('/', '', $urldomain);
                    // $urldomain = str_replace('www.', '', $urldomain);
            $urldomain = $this->config->item('urldomain');

                    $configarr = $this->settings_model->getItems();
                    $userdetail = $this->myinfo_model->getUser($paypalData['user_id']);
                    $programinfo = $this->Program_model->getProgram($paypalData['course_id']);


                    $subject1 = 'Order has been canceled - '.$configarr[0]['institute_name'];
                    $toemail1 =  "veerit1511@gmail.com";  //$userdetail->email; // $userdetail->email
                    $content = '';
                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course details - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Hi '.trim(ucfirst($userdetail->first_name)).',<br /><br />';
                    //$content .= 'Thank you for your order. Here are your order details:<br /><br />';
                    $content .= ' Course Name: '.$programinfo->name.'<br />';
                    $content .= ' Payment Method: Paypal <br />';
                    $content .= ' Status: Cancel <br />';
                    $content .= ' Amount:'.$price.'<br /><br />';

                    $content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> ';

                    $data['content'] = $content;
 		$data['fromemail'] = $urldomain;
                    $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
                    $fromemail1= 'noreply@'.$urldomain;   //$configarr[0]['fromemail'];// admin mail
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
                    $subject1 = 'Order has been canceled in '.$configarr[0]['institute_name'];
                    $toemail3 = $admininfo->email;// admin mail
                    $content = '';

                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
                    $content .= trim(ucfirst($userdetail->first_name)).' have canceled order of a course. The details are given below: <br /><br /> ';
                    $content .= ' Course Name: '.$programinfo->name.'<br />';
                    $content .= ' Payment Method: paypal <br />';
                    $content .= ' Status: cancel <br />';
                    $content .= ' Amount:'.$price.'<br />';

                    $data['content'] = $content;
 		$data['fromemail'] = $urldomain;
                    $message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);

                    $fromemail3 = 'noreply@'.$urldomain;
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail3, $configarr[0]['fromname']);
                    $this->email->subject($subject1);
                    $this->email->to($toemail3);
                    $this->email->message($message3);
                    $this->email->send();

         }

       $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
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
						                        'order_status' =>'New Order',
                                                'referred_code' =>$referred_code
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
						                        'order_status' =>'New Order',
                                                'referred_code' =>$referred_code
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


				// $urldomain = base_url();
				// $urldomain = str_replace('http://', '', $urldomain);
				// $urldomain = str_replace('/', '', $urldomain);
				// $urldomain = str_replace('www.', '', $urldomain);
                $urldomain = $this->config->item('urldomain');



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
 		$data['fromemail'] = $urldomain;
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
 		$data['fromemail'] = $urldomain;
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


			//5. Mail To admin for enrolled

			    $subject3 = trim(ucfirst($user_first_name)).' has enrolled to '.$course_name;
				$toemail3 = $admin_email;// admin mail
				$content = '';

				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($user_first_name)).' has enrolled to '.$course_name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($admin_first_name)).',<br /><br />';
				$content .=  trim(ucfirst($user_first_name))." ".trim(ucfirst($user_last_name))."  has Successfully enrolled in '".$course_name."!'.<br /><br />";
				$content .='If you need help or have any questions, please contact us.<br />';

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
                                                                'order_status' =>'Renew Order',
                                                                'referred_code' =>$referred_code
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
                                                'order_status' =>'New Order',
                                                'referred_code' =>$referred_code
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


                // $urldomain = base_url();
                // $urldomain = str_replace('http://', '', $urldomain);
                // $urldomain = str_replace('/', '', $urldomain);
                // $urldomain = str_replace('www.', '', $urldomain);
                $urldomain = $this->config->item('urldomain');



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
 		$data['fromemail'] = $urldomain;
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
 		$data['fromemail'] = $urldomain;
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

        function direct_Payment()
        {

            $course_id = $this->input->post('course_id') ? $this->input->post('course_id') : $this->uri->segment(3);
            $program_id = $course_id;
            if(empty($course_id))
            {
                $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "You are already enrolled to this course" ));
                redirect('course');
            }

            $this->load->model('admin/settings_model');
            $this->load->model('admin/programs_model');
            $this->load->model('Program_model');
            $this->load->model('myinfo_model');
            $this->load->model('orders_model');

            $course_details = $this->payment_model->getProgramDetails($course_id);


            if($course_details)
            {
                $fixedrate = $course_details->fixedrate;

                if($fixedrate != 0.00)
                {
                    $price = $course_details->fixedrate;

                }
                else
                {
                    $plan_id = $this->input->post('plan_id');
                    $getPlanDetails = $this->payment_model->getPlanDetails($program_id,$plan_id);

                    $price = $getPlanDetails->price;

                    // echo"<pre>";
                    // echo $plan_id;
                    // echo"=====";
                    // echo $program_id;
                    // print_r($getPlanDetails);
                    // exit('yes');

                }
            }
            else
            {
                    echo "their no course availble";
            }

            $pay_setting = $this->settings_model->getAccountMode();
            $external_id = $this->program_model->getExternalId($course_id);

        if($external_id)
        {

            $this->session->set_userdata('external_id',$external_id->id);
        }


        $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
        if(!$this->session->userdata('logged_in'))
        {
            redirect('users/login_form');
        }
        elseif($_POST['submit'] == 'Direct Payment')
        {
            $request  = $this->program_model->getRequest($user_id,$course_id);

            if($request > 0)
            {
                $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Your have already sent request' ));
               redirect('programs/programs/'.$course_id);
            }
            else
            {

            $data = array(
                    'userid' => $user_id,
                    'courses' => $course_id,
                    'order_date' => date('Y-m-d h:i:s'),
                    'status' => 'Pending',
                    'pending_reason' => 'none',
                    'amount' => $price,
                    'amount_paid' => $price,
                    'published' => 1,
                    'processor' => 'Direct Payment',
                    'currency' => $pay_setting[0]['currency'],
                    'transactionid' =>'',
                    'referred_code' => $referred_code
                );



                 $successid = $this->settings_model->insertDirectSuccess($data);
                 if($successid)
                 {
        //             $urldomain = base_url();
        // $urldomain = str_replace('http://', '', $urldomain);
        // $urldomain = str_replace('/', '', $urldomain);
        // $urldomain = str_replace('www.', '', $urldomain);
                    $urldomain = $this->config->item('urldomain');

                    $configarr = $this->settings_model->getItems();
                    $userdetail = $this->myinfo_model->getUser($user_id);
                    $programinfo = $this->Program_model->getProgram($course_id);

            //1. Order mail to user

                    $subject1 = 'Your course purchase details - '.$configarr[0]['institute_name'];
                    $toemail1 =  $userdetail->email; // $userdetail->email
                    $content = '';
                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Hi '.trim(ucfirst($userdetail->first_name)).',<br /><br />';
                    $content .= 'Thank you for your order. Here are your order details:<br /><br />';
                    $content .= ' Course Name: '.$programinfo->name.'<br />';
                    $content .= ' Payment Method: Direct Payment <br />';
                    $content .= ' Status: Pending <br />';
                    $content .= ' Amount:'.$price.'<br /><br />';
                    $content .= " Your purchase was successfull! You can find ".$programinfo->name." under the menu 'My Courses' in the Academy once you login.<br /><br />";
                    $content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> ';

                    $data['content'] = $content;
 		$data['fromemail'] = $urldomain;
                    $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
                    $fromemail1= 'noreply@'.$urldomain;   //$configarr[0]['fromemail'];// admin mail
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
                    $subject1 = 'New Order Placed in '.$configarr[0]['institute_name'];
                    $toemail3 = $admininfo->email;// admin mail
                    $content = '';

                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
                    $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
                    $content .= trim(ucfirst($sessionarray['first_name'])).' have made a purchase of a course. The details are given below: <br /><br /> ';
                    $content .= ' Course Name: '.$programinfo->name.'<br />';
                    $content .= ' Payment Method: Direct Payment <br />';
                    $content .= ' Status: Pending <br />';
                    $content .= ' Amount:'.$price.'<br />';

                    $data['content'] = $content;
 		$data['fromemail'] = $urldomain;
                    $message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);

                    $fromemail3 = 'noreply@'.$urldomain;
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail3, $configarr[0]['fromname']);
                    $this->email->subject($subject1);
                    $this->email->to($toemail3);
                    $this->email->message($message3);
                    $this->email->send();

                    redirect('/orders');
                 }
                }
        }


        }

    function orderStatusUpdate()
    {
         $configarr = $this->payment_model->getItems();

          $orderStatus =$this->input->post('selectvalue');
          $orderId =$this->input->post('orderid');
          $userid =$this->input->post('userid');
          $course_id =$this->input->post('course_id');

          $expired_date ="";
          $plan_id = 0;

          $course_details = $this->payment_model->getProgramDetails($course_id);

        $this->load->model('admin/users_model');

        $data = array(
            'status'      =>  $orderStatus

               );
        $isupdated = $this->users_model->updateOrder($orderId,$data);



        if($orderStatus == 'Completed')
        {

     $is_Alreadybuy = $this->payment_model->getBuyCourses($userid,$course_id);
      if($is_Alreadybuy)
      {
        echo"success";
      }
      else
      {
          if($course_details)
          {
             //$order = $this->users_model->getIndividualOrder($orderId);

             $fixedrate = $course_details->fixedrate;

            if($fixedrate == 0.00)
            {


                $getPlanDetails = $this->payment_model->getPlan($program_id);
                $price = $getPlanDetails->price;
                $plan_id = $getPlanDetails->plan_id;

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
             else
             {

                $price = $course_details->fixedrate;
             }

                $currentdate = date("Y-m-d H:i:s");

                $pay_setting = $this->payment_model->getAccountMode();

                $buyCourseDetails = array(
                        'userid' => $userid,
                        'order_id' => $orderId,
                        'course_id' => $course_id,
                        'price' => $price,
                        'currency' => $pay_setting[0]['currency'] ? $pay_setting[0]['currency'] : "USD",
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

                if($buy_courses)
                {
                    $user_data = $this->programs_model->getUserInfo($userid);

                    $pro_data = $this->programs_model->getProgramById($course_id);



                     $subject = "Your Order for course '".$pro_data->name."' is Completed";
                     $toemail =  $user_data->email; // $teacher_email

                      $content = '';
                      //$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
                      $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
                      $content .= '<p>Dear '.trim(ucfirst($user_data->first_name)).',<br /><br />';
                      $content .= "Your order for course '".$pro_data->name."' is completed.<br /><br />";
                      $content .= 'The status of order is changed from pending to completed.<br /><br />';
                      $content .='If you need help or have any questions, please contact us. <br /><br />';
                      $content .= '<br /><br />';
                      $content .='...</p>';
                      $content .= $configarr[0]['signature'].'</p>';
                      //$content .= 'Best regards,<br /><br />';
                      //$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
                      $data['content'] = $content;
 		$data['fromemail'] = $urldomain;
                      $message = $this->load->view('email_formates/common_email_formate.php',$data,true);

                      //$message = '<a href="'.$link.'">Click on link to reset password</a>';
                      //$fromemail='admin@createonlineacademy.com';
                      $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];
                      $config['charset'] = 'utf-8';
                      $config['mailtype'] = 'html';
                      $config['wordwrap'] = TRUE;
                      $this->email->initialize($config);
                      $this->email->from($fromemail, $configarr[0]['fromname']);
                      $this->email->subject($subject);
                      $this->email->to($toemail);
                      //$this->email->cc('vikas.gorle@veerit.com');
                      $this->email->message($message);
                      $this->email->send();


                      $admininfo = $this->login_model->getadminInfo(4);


                          // Email to Admin
                          $subject = "Order for course '".$pro_data->name."' is Completed";
                          $toemail = $admininfo->email; // $this->input->post('email')
                          $content = '';
                          $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
                          $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
                          $content .= "Order for course '".$pro_data->name."' is completed.<br /><br />";
                          $content .='This Order is placed by '.$user_data->first_name.' '.$user_data->last_name.'.<br /><br />';
                          $content .='...';
                          $content .= $configarr[0]['signature'];

                          $data1['content'] = $content;
 		$data1['fromemail'] = $urldomain;
                          $message = $this->load->view('email_formates/admin_email_formate.php',$data1,true);
                          $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];
                          $config['charset'] = 'utf-8';
                          $config['mailtype'] = 'html';
                          $config['wordwrap'] = TRUE;
                          $this->email->initialize($config);
                          $this->email->from($fromemail, $configarr[0]['fromname']);
                          $this->email->subject($subject);
                          $this->email->to($toemail);
                          $this->email->message($message);
                          $this->email->send();

                          echo"success";
                    }


                 }
            }


        }
        else
        {
            echo"fail";
        }

    }

    function payUMoney_Process1()
    {
        // $coupencode = $this->input->post('coupencode');
        $coupencode = 'cowin2021';
        $program_id = $this->input->post('course_id') ? $this->input->post('course_id') : $this->uri->segment(3);
        $validcoupon = $this->input->post('valid_coupon');
        if($validcoupon=='Yes'){
            $con = "(coupon_course like '%\"".$program_id."\"%' OR coupon_for = 0 ) AND code = '".$coupencode."' AND codeend >= now() AND codeused <= codelimit AND published = 1";
        }
        else{
            $con = "(coupon_course like '%\"".$program_id."\"%' OR coupon_for = 0 ) AND code = '".$coupencode."' AND codeend >= now() AND codeused < codelimit AND published = 1";
        }
        $rs = $this->payment_model->getPromoCodeDetails1($con);
        print_r($rs);
    }

    function payUMoney_Process()
    {
        $sessionarray = $this->session->userdata('logged_in');
        // echo $sessionarray['id'];
        if(empty($sessionarray)){
            echo "expired";exit;
        }

        // alert($sessionarray);
        $program_id = $this->input->post('course_id') ? $this->input->post('course_id') : $this->uri->segment(3);

        $promocodeid ="";
        if(empty($program_id))
        {
            $program_id = $this->uri->segment(3);
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "You are already enrolled to this course" ));
            redirect('course/programs/'.$program_id);
        }

        $course_details = $this->payment_model->getProgramDetails($program_id);
        $is_Alreadybuy = $this->payment_model->getBuyCourses($sessionarray['id'],$program_id);

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

                    if($course_details)
                        {
                        $chb_free_courses = $course_details->chb_free_courses;
                        $step_access_courses = $course_details->step_access_courses;
                        $fixedrate = $course_details->fixedrate;
                        $demoprice = $course_details->demoprice;

                        if($fixedrate != 0.00 || $demoprice != 0.00)
                        {

                            // =================
                        $coupencode = $this->input->post('coupencode');
                        $discountprice ="";

                        if($fixedrate != 0.00){
                            $course_mrp = $fixedrate;
                          }
                         else{
                            $course_mrp = $demoprice;
                          }

                        $validcoupon = $this->input->post('valid_coupon');
                        if($coupencode && $validcoupon=='Yes')
                        {
                            if($validcoupon=='Yes'){
                                $con = "(coupon_course like '%\"".$program_id."\"%' OR coupon_for = 0) AND code = '".$coupencode."' AND codeend >= now() AND codeused <= codelimit AND published = 1";
                            }
                            else{
                                $con = "(coupon_course like '%\"".$program_id."\"%' OR coupon_for = 0 ) AND code = '".$coupencode."' AND codeend >= now() AND codeused < codelimit AND published = 1";
                            }
                            $rs = $this->payment_model->getPromoCodeDetails1($con);
                        // $rs = $this->payment_model->getPromoCodeDetails($coupencode);
                          if($rs)
                                   {
                                    $promocodeid = $rs->id;
                                      $typediscount = $rs->typediscount;
                                      $discount = $rs->discount;
                                      // $actulrate = $fixedrate;
                                            if($fixedrate != 0.00){
                                                $actulrate = $fixedrate;
                                            }
                                            else{
                                                $actulrate = $demoprice;

                                                 }

                                      if($typediscount == 0)
                                        {
                                            $discountprice = $actulrate - $discount;

                                        }
                                        else if($typediscount == 1)
                                        {
                                            $discountprice = $actulrate - ($actulrate *($discount / 100));

                                        }
                                    }
                            }
                                // ===============

                             $payTMData = array(
                                'txnid' => "Txn" . rand(10000,99999999),
                                'plan_id' => '',
                                'user_id' => $user_id,
                                'course_name' => $course_details->name,
                                'course_price' => $discountprice ? $discountprice : $course_mrp,
                                'course' => $course_details->name,
                                'course_id' => $program_id,
                                'promocodeid' => $promocodeid
                            );


                            $this->session->set_userdata('payTMData',$payTMData);


                            $this->payumoney_box($payTMData);


                            }
                            else
                            {
                                $plan_id = $this->input->post('plan_id');

                                $getPlanDetails = $this->payment_model->getPlanDetails($program_id,$plan_id);

                                 // =================
                                       $coupencode = $this->input->post('coupencode');
                                       $discountprice ="";
                                $validcoupon = $this->input->post('valid_coupon');
                                if($coupencode && $validcoupon=='Yes')
                                {
                                    if($validcoupon=='Yes'){
                                        $con = "(coupon_course like '%\"".$program_id."\"%' OR coupon_for = 0) AND code = '".$coupencode."' AND codeend >= now() AND codeused <= codelimit AND published = 1";
                                    }
                                    else{
                                        $con = "(coupon_course like '%\"".$program_id."\"%' OR coupon_for = 0 ) AND code = '".$coupencode."' AND codeend >= now() AND codeused < codelimit AND published = 1";
                                    }
                                    $rs = $this->payment_model->getPromoCodeDetails1($con);
                                       // $rs = $this->payment_model->getPromoCodeDetails($coupencode);


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
                                   }

                                // ===============

                               $payTMData = array(
                                'txnid' => "Txn" . rand(10000,99999999),
                                'plan_id' => $plan_id,
                                'user_id' => $user_id,
                                'course_name' => $course_details->name,
                                'course_price' => $discountprice ? $discountprice : $getPlanDetails->price,
                                'course' => $course_details->name,
                                'course_id' => $program_id,
                                'promocodeid' => $promocodeid
                                );

                                $this->session->set_userdata('payTMData',$payTMData);
                                $this->payumoney_box($payTMData);
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
            echo "You are already enrolled to this course";
        }

    }

    function payumoney_box($payTMData)
    {

        $pay_setting = $this->payment_model->getAccountMode();
        if(!empty($pay_setting[0]['currency']))
        {
            $currency_code = $pay_setting[0]['currency'];
        }
        else{
            $currency_code = "USD";
        }
        $sessionarray = $this->session->userdata('logged_in');

        $user_id = $sessionarray['id'];
        $user = $this->Crud_model->get_single('mlms_users',"id = ".$user_id,"mobile");
        $mobile = '';
        if(!empty($user->mobile)){
            $mobile = $user->mobile;
        }
        $userdetail = $this->myinfo_model->getUser($user_id);
        $currentdate = date('Y-m-d H:i:s');
        $data = array();

        $data["udf5"] = "BOLT_KIT_PHP7";
        $data['orderId'] = "order153";
        $data["surl"] = base_url()."paymentprocess/payumoney_success";
        $data["furl"] = base_url()."paymentprocess/payumoney_success";
        // $data["curl"] = base_url()."paymentprocess/payumoney_cancel";
        $data["key"] =  "2kixU6hS";
        $data["salt"] =  "PjFlHQzo6r";
        $data["txnid"] = $payTMData['txnid'];
        $data["amount"] = sprintf("%.2f", $payTMData["course_price"]); //
        $data["pinfo"] =   $payTMData["course_name"];//"P01,P02";
        $data["fname"] =  $userdetail->first_name;
        $data["email"] =  $userdetail->email;
        $data["mobile"] = $mobile;
        $data["hash"] = hash('sha512',  $data["key"].'|'.$data["txnid"].'|'.$data["amount"].'|'.$data["pinfo"].'|'.$data["fname"].'|'.$data["email"].'|||||'.$data["udf5"].'||||||'.$data["salt"]);

        if($payTMData["course_price"])
        {
            $getorders = $this->orders_model->getsaleOrders($payTMData['user_id'],$payTMData['course_id']);
            if(empty($getorders))
            {
                $upd_data = array(
                               'userid' => $payTMData['user_id'],
                               'order_date' => $currentdate,
                               'courses' => $payTMData['course_id'],
                               'status' => 'PENDING',
                               'pending_reason' => 'New Order',
                               'amount' => $payTMData['course_price'],
                               'amount_paid' => '0',
                               'processor' => 'payUMoney',
                               'currency' => $currency_code,
                               'published' => '0',
                               'transactionid' => $data["txnid"],
                               'order_status' => 'New Order',
                               'promocodeid' => $payTMData['promocodeid']
                );
                $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);

                $this->load->library('email');
                $this->load->model('admin/settings_model');
                $configarr = $this->settings_model->getItems();

                if($configarr[0]['fromemail'])
                    $urldomain = $configarr[0]['fromemail'];
                else
                    $urldomain = 'noreply@mytonlineshiksha.com';

                $userdata = $this->Crud_model->get_single('mlms_users',"id = ".$payTMData['user_id'],"email,first_name,last_name,mobile");
                $coursedetails =$this->Crud_model->get_single('mlms_program',"id = ".$payTMData['course_id'],"name,slug");
                $subject = 'Order #'.$pay_Insert.' Pending';
                // $toemail = 'nikhil.b@veerit.com';
                $toemail = 'prashant@veerit.com';
                $toemail1 = 'ashish.gurao@veerit.com';
                $content = '';
                $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$pay_Insert.' is Pending.</p>';
                $content .= 'Hello ,<br/><br/>';
                $content .= 'Order details : <br/><br/>';
                $content .= 'Customer Name : '.ucwords($userdata->first_name.' '.$userdata->last_name).'<br/>';
                $content .= 'Customer Email : '.strtolower($userdata->email).'<br/>';
                $content .= 'Customer Mobile : '.$mobile.'<br/>';
                $content .= 'Course Name : <a href="'.base_url().'online-courses/'.$coursedetails->slug.'/">'.$coursedetails->name.'</a><br/>';
                $content .= 'Course Price : '.$payTMData['course_price'].'<br/>';
                $content .= '<br/>';
                $data1['content'] = $content;
                $data1['fromemail'] = $urldomain;
                $message = $this->load->view('email_formates/common_email_formate.php',$data1,true);
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

                $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
                $this->email->subject($subject);
                $this->email->to($toemail1);
                $this->email->message($message);
                $this->email->send();
            }
            $responseData = array("status" =>'200',"data"=>$data);
            echo json_encode($responseData);
        }
        else
        {
            $responseData = array("status" =>'204',"data"=>$data);
            echo json_encode($responseData);
        }


    }

    function payumoney_success()
    {
    	// print_r($_REQUEST);exit;
        if(empty($this->session->userdata('logged_in')))
        {
            redirect();exit;
        }
        $referred_code = get_cookie('referral_code');
        $currentdate = date("Y-m-d H:i:s");
        $expired_date ="";
        $plan_id = 0;

        $paypalData = $this->session->userdata('payTMData');
        // echo"<pre>";
        // echo $paypalData['plan_id'];
        // print_r($paypalData);
        // exit();
        $order_date = date("Y-m-d H:i:s",strtotime($_REQUEST['addedon']));
        $txnStatus = $_REQUEST['txnStatus'];
         if($_REQUEST['txnStatus'] == 'SUCCESS')
        {
        	$txnStatus = "SUCCESS";
            $published = 1;
        }
        else if($_REQUEST['txnStatus'] == 'PENDING')
        {
        	$txnStatus = "PENDING";
            $published = 0;

        }
        else if($_REQUEST['txnStatus'] == 'FAILED')
        {
        	$txnStatus = "FAILURE";
            $published = 0;
        }
        $user_id = $paypalData['user_id'];
        $course_id = $paypalData['course_id'];
        $txn_id = $paypalData['txnid'];

        $course_details = $this->payment_model->getProgramDetails($paypalData['course_id']);

        $is_Alreadybuy = $this->payment_model->getBuyCourses($paypalData['user_id'],$paypalData['course_id']);

        $getOrderDetails = $this->payment_model->getOrderDetails($paypalData['user_id'],$paypalData['course_id'],$paypalData['txnid']);
// =================

        if(empty($is_Alreadybuy))
           {
                if(empty($getOrderDetails))
                {
                    $upd_data = array(
                                    'userid' => $paypalData['user_id'],
                                    'order_date' => $currentdate,
                                    'courses' => $paypalData['course_id'],
                                    'status' => $txnStatus,
                                    'pending_reason' => $_REQUEST['error_Message'] ? $_REQUEST['error_Message']:'none',
                                    'amount' => $_REQUEST['amount'],
                                    'amount_paid' => $_REQUEST['net_amount_debit'],
                                    'processor' => 'payumoney ( '.$_REQUEST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$_REQUEST['txnid'],
                                    'order_status' =>'New Order',
                                    'referred_code' => $referred_code
                                     );

                     $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
                     // echo $pay_Insert;
                }
                else
                {

                    $upd_data = array(
                                    'order_date' => $currentdate,
                                    'status' => $txnStatus,
                                    'pending_reason' => $_REQUEST['error_Message'] ? $_REQUEST['error_Message']:'none',
                                    'amount' => $_REQUEST['amount'],
                                    'amount_paid' => $_REQUEST['net_amount_debit'],
                                    'processor' => 'payumoney ( '.$_REQUEST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$_REQUEST['txnid'],
                                    'order_status' =>'New Order',
                                    'referred_code' => $referred_code
                                     );

                    $is_updated = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
                    if($is_updated){
                        $pay_Insert = $getOrderDetails->id;
                    }
                }


                       if($_REQUEST['txnStatus'] == 'SUCCESS')
                       {
                            $this->load->library('email');
                            $this->load->model('admin/settings_model');
                            $configarr = $this->settings_model->getItems();

                            if($configarr[0]['fromemail'])
                                $urldomain = $configarr[0]['fromemail'];
                            else
                                $urldomain = 'noreply@mytonlineshiksha.com';

                            $userdata = $this->Crud_model->get_single('mlms_users',"id = ".$paypalData['user_id'],"email,first_name,last_name,mobile");
                            $coursedetails = $this->Crud_model->get_single('mlms_program',"id = ".$paypalData['course_id'],"name,slug");

                            $subject = 'Order #'.$pay_Insert.' SUCCESS';
                            $toemail = 'prashant@veerit.com';
                			$toemail1 = 'ashish.gurao@veerit.com';
                            $content = '';
                            $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$pay_Insert.' is Succeeded.</p>';
                            $content .= 'Hello ,<br/><br/>';
                            $content .= 'Order details : <br/><br/>';
                            $content .= 'Customer Name : '.ucwords($userdata->first_name.' '.$userdata->last_name).'<br/>';
                            $content .= 'Customer Email : '.strtolower($userdata->email).'<br/>';
                            $content .= 'Customer Mobile : '.$userdata->mobile.'<br/>';
                            $content .= 'Course Name : '.$coursedetails->name.'<br/>';
                            $content .= 'Course Price : '.$paypalData['course_price'].'<br/>';
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
                            $this->email->send();

							$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
                            $this->email->subject($subject);
                            $this->email->to($toemail1);
                            $this->email->message($message);
                            $this->email->send();

                            $fixedrate = $course_details->fixedrate;

                            if($fixedrate == 0.00)
                            {

                               // $custom_array = explode('-',$_REQUEST['custom']);

                                $plan_id = $paypalData['plan_id'];

                                $course_id = $paypalData['course_id'];

                                //$getPlanDetails = $this->payment_model->getPlanDetails($custom_array['0'],$custom_array['2']);
                                 $getPlanDetails = $this->payment_model->getPlanDetails($course_id,$plan_id);

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
                                    'price' => $_REQUEST['amount'],
                                    'currency' => "INR",
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

                            //  resellers payout data
                                   // Cookies data
                            $program_id = $paypalData['course_id'];
                            $getcourse = $this->Crud_model->GetData('mlms_program','slug,author',"id = ".$program_id,'','','',1);
                            $getteacher = $this->Crud_model->GetData('mlms_users','referral_code,coursepercent,id',"id = ".$getcourse->author,'','','',1);
                            $teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getteacher->id);

                            $comm = 0;
                            $t_comm = 0;
                            $r_comm = 0;

                            if($referred_code != '')
                            {
                                $getreseller = $this->Crud_model->get_single('mlms_users',"referral_code = '".$referred_code."'",'id');

                                $getassess = $this->Crud_model->get_single('mlms_assessment',"user_id = '".$getreseller->id."'");

                                $getresellerpayout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getreseller->id);

                                if($referred_code === $getteacher->referral_code)
                                {
                                  $comm = floatval($_REQUEST['net_amount_debit']) * floatval($getteacher->coursepercent)/100;
                                  $t_comm = round($comm,2);
                                  $teacher_total = floatval($teacher_payout->total_amount) + floatval($t_comm);
                                  $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($t_comm);

                                  $teacher = array(
                                                'total_amount' => $teacher_total,
                                                'balance_amount' => $teacher_balance,
                                                'modified' => date('Y-m-d H:i:s')
                                  );
                                  $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id = ".$getteacher->id);
                                  $log_comm2 = array(
                                                'order_id' => $pay_Insert,
                                                'reseller_id' => $getteacher->id,
                                                'commission' => $t_comm,
                                                'comm_percent' => $getteacher->coursepercent,
                                                'created' => date("Y-m-d H:i:s")
                                  );
                                  $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);
                                }
                                else
                                {
                                  $reseller_payout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getreseller->id);
                                  $r_comm = floatval($_REQUEST['net_amount_debit']) * floatval($getassess->assessment) /100 ;
                                  $reseller_total = floatval($reseller_payout->total_amount) + floatval($r_comm);
                                  $reseller_balance = floatval($reseller_payout->balance_amount) + floatval($r_comm);
                                  $reseller = array(
                                                'total_amount' => $reseller_total,
                                                'balance_amount' => $reseller_balance,
                                                'modified' => date('Y-m-d H:i:s')
                                  );
                                  $this->Crud_model->SaveData('mlms_payout',$reseller,"user_id = ".$getreseller->id);

                                  $log_comm1 = array(
                                                'order_id' => $pay_Insert,
                                                'reseller_id' => $getreseller->id,
                                                'commission' => $r_comm,
                                                'comm_percent' => $getassess->assessment,
                                                'created' => date("Y-m-d H:i:s")
                                  );
                                  $this->Crud_model->SaveData('mlms_commission_log',$log_comm1);
                                  $rcomper = $getassess->assessment;
                                    // payments for the agent / sub-resellers
                                    if(!empty($getassess->parent_id)){
                                        $getparent = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$getassess->parent_id,"assessment");
                                        $parent_comm = floatval($getparent->assessment) - floatval($rcomper);
                                        $rcomper = $getparent->assessment;
                                        $parent_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$getassess->parent_id);
                                        $pcom = floatval($_REQUEST['net_amount_debit']) * floatval($parent_comm) /100;
                                        $parent_total = floatval($parent_payout->total_amount) + floatval($pcom);
                                        $parent_balance = floatval($parent_payout->balance_amount) + floatval($pcom);
                                        $parent_reseller = array(
                                                        'total_amount' => $parent_total,
                                                        'balance_amount' => $parent_balance,
                                                        'modified' => date('Y-m-d H:i:s')
                                        );
                                        $this->Crud_model->SaveData('mlms_payout',$parent_reseller,"user_id =".$getassess->parent_id);
                                        $parent_log_comm = array(
                                                    'order_id' => $pay_Insert,
                                                    'reseller_id' => $getassess->parent_id,
                                                    'commission' => $pcom,
                                                    'comm_percent' => $parent_comm,
                                                    'created' => date("Y-m-d H:i:s")
                                        );
                                        $this->Crud_model->SaveData('mlms_commission_log',$parent_log_comm);

                                    }
                                  // teacher commision
                                  $t_comm = floatval($_REQUEST['net_amount_debit']) * (floatval($getteacher->coursepercent) - floatval($rcomper)) /100 ;

                                  $teacher_total = floatval($teacher_payout->total_amount) + floatval($t_comm);
                                  $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($t_comm);

                                  $teacher = array(
                                                'total_amount' => $teacher_total,
                                                'balance_amount' => $teacher_balance,
                                                'modified' => date('Y-m-d H:i:s')
                                  );
                                  $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id = ".$getteacher->id);
                                  $log_comm2 = array(
                                                'order_id' => $pay_Insert,
                                                'reseller_id' => $getteacher->id,
                                                'commission' => $t_comm,
                                                'comm_percent' => (floatval($getteacher->coursepercent) - floatval($rcomper)),
                                                'created' => date("Y-m-d H:i:s")
                                  );
                                  $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);
                                }
                            }
                            else{       // teacher payout
                                  $comm = floatval($_REQUEST['net_amount_debit']) * floatval($getteacher->coursepercent) /100 ;
                                  $t_comm = round($comm,2);
                                  $teacher_total = floatval($teacher_payout->total_amount) + floatval($t_comm);
                                  $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($t_comm);

                                  $teacher = array(
                                                'total_amount' => $teacher_total,
                                                'balance_amount' => $teacher_balance,
                                                'modified' => date('Y-m-d H:i:s')
                                  );
                                  $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id = ".$getteacher->id);
                                  $log_comm2 = array(
                                                'order_id' => $pay_Insert,
                                                'reseller_id' => $getteacher->id,
                                                'commission' => $t_comm,
                                                'comm_percent' => $getteacher->coursepercent,
                                                'created' => date("Y-m-d H:i:s")
                                  );
                                  $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);
                            }

                           $this->session->set_userdata('nr',base_url().$getcourse->slug.'/lectures/'.$paypalData['course_id']);
                           redirect("thank_you/");
                        // redirect('programs/lectures/'.$paypalData['course_id']);
                        }
                        else if($_REQUEST['txnStatus'] == 'FAILED')
                        {
                            $this->load->library('email');
                            $this->load->model('admin/settings_model');
                            $configarr = $this->settings_model->getItems();

                            if($configarr[0]['fromemail'])
                                $urldomain = $configarr[0]['fromemail'];
                            else
                                $urldomain = 'noreply@mytonlineshiksha.com';

                            $userdata = $this->Crud_model->get_single('mlms_users',"id = ".$paypalData['user_id'],"email,first_name,last_name,mobile");
                            $coursedetails = $this->Crud_model->get_single('mlms_program',"id = ".$paypalData['course_id'],"name,slug");

                            $subject = 'Order #'.$pay_Insert.' Failed';
                            // $toemail = 'nikhil.b@veerit.com';
                            $toemail = 'prashant@veerit.com';
                            $toemail1 = 'ashish.gurao@veerit.com';
                            $content = '';
                            $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$pay_Insert.' is failed due to '.$_REQUEST['error_Message'].'.</p>';
                            $content .= 'Hello ,<br/><br/>';
                            $content .= 'Order details : <br/><br/>';
                            $content .= 'Customer Name : '.ucwords($userdata->first_name.' '.$userdata->last_name).'<br/>';
                            $content .= 'Customer Email : '.strtolower($userdata->email).'<br/>';
                            $content .= 'Customer Mobile : '.$userdata->mobile.'<br/>';
                            $content .= 'Course Name : '.$coursedetails->name.'<br/>';
                            $content .= 'Course Price : '.$paypalData['course_price'].'<br/>';
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
                            $this->email->send();

                            $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
                            $this->email->subject($subject);
                            $this->email->to($toemail1);
                            $this->email->message($message);
                            $this->email->send();
                            echo "failed";
                        }
            }
            else
            {
                   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
                   redirect('programs/lectures/'.$paypalData['course_id']);
            }

// =================
    }

    function payumoney_cancel()
    {
    	print_r($_REQUEST);
    }

    function payumoney_failed()
    {
    	print_r($_REQUEST);
    }


     function payUMoney_Process_ajax()
    {

        $sessionarray = $this->session->userdata('logged_in');

        $program_id = $this->input->post('course_id') ? $this->input->post('course_id') : $this->uri->segment(3);

        if(empty($program_id))
        {
            $program_id = $this->uri->segment(3);
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "You are already enrolled to this course" ));
            redirect('course/programs/'.$program_id);
        }
         $is_Alreadybuy = $this->payment_model->getBuyCourses_ajax($sessionarray['id'],$program_id);
         if($is_Alreadybuy){
            foreach ($is_Alreadybuy as $buy_id) {
                $program_id = \array_diff($program_id, [$buy_id->course_id]);
            }
         }
         if($program_id)
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
                        $course_detail = $this->payment_model->getProgramDetails_ajax($program_id);

                        $tot_course_mrp = '0';
                        $discountprice='';
                        $discountper_course = 0;
                        $promocodeid ="";
                        $course_array = array();
                        $price_array = array();
                        $cid_array = array();
                        $planid_array = array();
                        $payTMData = array();
                        $ass_courses = array();
                        if($course_detail)
                        {
                            $coupencode = $this->input->post('coupencode');
                             $discountprice ="";

                             if($coupencode)
                            {
                                $rs = $this->payment_model->getPromoCodeDetails($coupencode);
                                if($rs && ( $rs->codelimit == 0 || ($rs->codelimit > 0 && $rs->codelimit !=  $rs->codeused)))
                                {
	                                if($rs->coupon_for == 0)
	                                   {
	                                      $promocodeid = $rs->id;
	                                      $typediscount = $rs->typediscount;
	                                      $discount = $rs->discount;
	                                      $tot_couse = count($program_id);
	                                      $discountper_course = $discount / $tot_couse;
	                                   }
	                                  else if($rs->coupon_for == 1) {
	                                  		$ass_courses = explode(',', $rs->coupon_course);
                                            $promocodeid = $rs->id;
                                              $typediscount = $rs->typediscount;
                                              $discount = $rs->discount;
	                                  	}
                                  } else{ $coupencode = ''; }
                            }
                            // print_r($ass_courses);
                           foreach ($course_detail as $course_details)
                           {

                                $fixedrate = $course_details->fixedrate;
                                $demoprice = $course_details->demoprice;
                                if($fixedrate != 0.00 || $demoprice != 0.00)
                                {

                                     if($fixedrate != 0.00){
                                        $course_mrp = $fixedrate;
                                        $tot_course_mrp = $tot_course_mrp + $fixedrate;
                                      }
                                     else{
                                        $course_mrp = $demoprice;
                                        $tot_course_mrp = $tot_course_mrp + $demoprice;
                                      }
                                      if($coupencode){
                                      	if($ass_courses){
                                      		if(in_array('"'.$course_details->id.'"', $ass_courses))
                                      		{
                                      			if($typediscount == 0)
	                                        	{
	                                        		$discountprice = $course_mrp - $rs->discount;

	                                        	}
	                                        	else{
	                                        		$discountprice = $course_mrp - ($course_mrp *($rs->discount / 100));
	                                        	}
	                                        	$tot_course_mrp = ($tot_course_mrp - $course_mrp) + $discountprice;

                                      		}

                                      	}
                                      	else{
	                                        if($typediscount == 0)
	                                        {
	                                            $discountprice = $course_mrp - $discountper_course;
	                                        }
	                                        else if($typediscount == 1)
	                                        {
	                                            $discountprice = $course_mrp - ($course_mrp *($discountper_course / 100));
	                                        }
	                                    }

                                       }
                                       $plan_id = " ";
                                    array_push($cid_array, $course_details->id);
                                    array_push($course_array, $course_details->name);
                                    array_push($price_array, $discountprice ? $discountprice : $course_mrp);
                                    array_push($planid_array, $plan_id);

                                }
                                else{
                                    // $plan_id = $this->input->post('plan_id');
                                    $plan_id = $this->payment_model->getPlanId($course_details->id);

                                $getPlanDetails = $this->payment_model->getPlanDetails($course_details->id,$plan_id);

                                    $course_mrp = $course_mrp + $getPlanDetails->price;

                                       if($coupencode){
                                        if($ass_courses){
                                      		if(in_array('"'.$course_details->id.'"', $ass_courses))
                                      		{
                                      			if($typediscount == 0)
	                                        	{
	                                        		$discountprice = $course_mrp - $discountper_course;
	                                        	}
	                                        	else{
	                                        		$discountprice = $course_mrp - ($course_mrp *($discountper_course / 100));
	                                        	}

                                      		}

                                      	}
                                      	else{
	                                        if($typediscount == 0)
	                                        {
	                                            $discountprice = $course_mrp - $discountper_course;
	                                        }
	                                        else if($typediscount == 1)
	                                        {
	                                            $discountprice = $course_mrp - ($course_mrp *($discountper_course / 100));
	                                        }
	                                    }

                                       }

                                    array_push($cid_array, $course_details->id);
                                    array_push($course_array, $course_details->name);
                                    array_push($price_array, $discountprice ? $discountprice : $course_mrp);
                                    array_push($planid_array, $plan_id);

                              }
                            }

                            if($coupencode)
                            {
                            	if(empty($ass_courses)){
	                                if($typediscount == 0)
	                                {
	                                    $tot_course_mrp = $tot_course_mrp - $discount;
	                                }
	                                else if($typediscount == 1)
	                                {
	                                    $tot_course_mrp = $tot_course_mrp - ($tot_course_mrp *($discount / 100));
	                                }
	                            }
                            }
                            $payTMData = array(
                                    'plan_id' => json_encode($planid_array),
                                    'user_id' => $user_id,
                                    'course_name' => json_encode($course_array),
                                    'course_price' => json_encode($price_array),
                                    'course_id' => json_encode($cid_array),
                                    'promocodeid' => $promocodeid,
                                    'amount' => $tot_course_mrp
                                    );

                            $this->session->set_userdata('payTMData',$payTMData);

                            $this->payumoney_box_ajax($payTMData);
                        }

                    }
                }
        }
        else
        {
            echo "You are already enrolled to this course";
        }

    }

    function payumoney_box_ajax($payTMData)
    {

        $pay_setting = $this->payment_model->getAccountMode();
        if(!empty($pay_setting[0]['currency']))
        {
            $currency_code = $pay_setting[0]['currency'];
        }
        else{
            $currency_code = "USD";
        }
        $sessionarray = $this->session->userdata('logged_in');

        $user_id = $sessionarray['id'];

        $userdetail = $this->myinfo_model->getUser($user_id);
        $currentdate = date('Y-m-d H:i:s');
        $data = array();

        $data["udf5"] = "BOLT_KIT_PHP7";
        $data['orderId'] = "order153";
        $data["surl"] = base_url()."paymentprocess/payumoney_success_ajax";
        $data["key"] =  "2kixU6hS";
        $data["salt"] =  "PjFlHQzo6r";
        $data["txnid"] = "Txn" . rand(10000,99999999);
        // $data["amount"] = sprintf("%.2f", $payTMData["course_price"]); //
        $data["amount"] = sprintf("%.2f", $payTMData["amount"]); //
        $data["pinfo"] =   $payTMData["course_name"];//"P01,P02";
        $data["fname"] =  $userdetail->first_name;
        $data["email"] =  $userdetail->email;
        $data["mobile"] = "";
        $data["hash"] = hash('sha512',  $data["key"].'|'.$data["txnid"].'|'.$data["amount"].'|'.$data["pinfo"].'|'.$data["fname"].'|'.$data["email"].'|||||'.$data["udf5"].'||||||'.$data["salt"]);

        if($payTMData["amount"])
        {
            $course_ids = json_decode($payTMData['course_id']);
            $c_prices = json_decode($payTMData['course_price']);
            $i = 0;
            foreach ($course_ids as $course_id) {
                $getorders = $this->orders_model->getsaleOrders($payTMData['user_id'],$course_id);
                 if(empty($getorders))
                {
                    $upd_data = array(
                                   'userid' => $payTMData['user_id'],
                                   'order_date' => $currentdate,
                                   'courses' => $course_id,
                                   'status' => 'PENDING',
                                   'pending_reason' => 'New Order',
                                   'amount' => $c_prices[$i],
                                   'amount_paid' => '0',
                                   'processor' => 'payUMoney',
                                   'currency' => $currency_code,
                                   'published' => '0',
                                   'transactionid' => '000',
                                   'order_status' => 'New Order',
                                   'promocodeid' => $payTMData['promocodeid']
                    );
                    $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
                }
                $i++;
            }

            $responseData = array( "status" =>'200',"data"=>$data);
            echo json_encode($responseData);
        }
        else
        {
            $responseData = array("status" =>'204',"data"=>$data);
            echo json_encode($responseData);
        }


    }

    function payumoney_success_ajax()
    {

        $referred_code = get_cookie('referral_code');
        $currentdate = date("Y-m-d H:i:s");
        $expired_date ="";
        $plan_id = 0;

        $paypalData = $this->session->userdata('payTMData');
        $order_date = date("Y-m-d H:i:s",strtotime($_REQUEST['addedon']));
        $txnStatus = strtolower($_REQUEST['txnStatus']);

         $published = $txnStatus == 'success' ? '1' : $txnStatus == 'pending' ? '0' : $txnStatus == 'failure' ? '0' : '0';

        $course_ids = json_decode($paypalData['course_id']);

         $is_Alreadybuy = $this->payment_model->getBuyCourses_ajax($sessionarray['id'],$course_ids);
         $course_detail = $this->payment_model->getProgramDetails_ajax($course_ids);

         if($is_Alreadybuy){
            foreach ($is_Alreadybuy as $buy_id) {
                $course_ids = \array_diff($course_ids, [$buy_id->course_id]);
            }
         }

        $c_prices = json_decode($paypalData['course_price']);
        $c_planid = json_decode($paypalData['plan_id']);
        $i = 0;
        if($course_ids){
            foreach ($course_ids as $course_id) {

            $getOrderDetails = $this->payment_model->getOrderDetails($paypalData['user_id'],$course_id,$_REQUEST['txnid']);


                if(empty($getOrderDetails))
                {
                    $upd_data = array(
                                    'userid' => $paypalData['user_id'],
                                    'order_date' => $currentdate,
                                    'courses' => $course_id,
                                    'status' => $_REQUEST['txnStatus'],
                                    'pending_reason' => $_REQUEST['error_Message'] ? $_REQUEST['error_Message']:'none',
                                    'amount' => $c_prices[$i],
                                    'amount_paid' => $c_prices[$i], //$_REQUEST['net_amount_debit'],
                                    'processor' => 'payumoney ( '.$_REQUEST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$_REQUEST['txnid'],
                                    'order_status' =>'New Order',
                                    'referred_code' => $referred_code
                                     );

                     $pay_Insert = $this->payment_model->insertPaypalSuccessNew($upd_data);
                }
                else
                {

                    $upd_data = array(
                                    'order_date' => $currentdate,
                                    'status' => $_REQUEST['txnStatus'],
                                    'pending_reason' => $_REQUEST['error_Message'] ? $_REQUEST['error_Message']:'none',
                                    'amount' => $c_prices[$i],
                                    'amount_paid' => $c_prices[$i],
                                    'processor' => 'payumoney ( '.$_REQUEST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$_REQUEST['txnid'],
                                    'order_status' =>'New Order',
                                    'referred_code' => $referred_code
                                     );

                    $pay_Insert = $this->payment_model->updateOrderStatus($upd_data,$user_id,$course_id,$txn_id);
                }

                 if($txnStatus == 'success')
                   {
                        $fixedrate = $course_detail[$i]->fixedrate;

                        if($fixedrate == 0.00)
                        {
                            $plan_id = $c_planid[$i];

                                $course_id = $course_id;

                                //$getPlanDetails = $this->payment_model->getPlanDetails($custom_array['0'],$custom_array['2']);
                                 $getPlanDetails = $this->payment_model->getPlanDetails($course_id,$plan_id);

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
                                    'course_id' => $course_id,
                                    'price' => $c_prices[$i],
                                    'currency' => "INR",
                                    'buy_date' => $currentdate,
                                    'expired_date' => $expired_date,
                                    'plan_id' => $c_planid[$i],
                                    'email_send' => 1,
                                    'finalexam_status' => "notgiven",
                                    'average' => 0,
                                    'finalexamid' => 0,
                                    'certification' => "notissued",
                                    'status' => 0,
                            );


                            $buy_courses = $this->payment_model->insertBuyCourseNew($buyCourseDetails);


                            $program_id = $course_id;
                            // $getcourse = $this->Crud_model->GetData('mlms_program','author',"id =".$program_id,'','','',1);
                            $getteacher = $this->Crud_model->GetData('mlms_users','referral_code, coursepercent',"id =".$course_detail[$i]->author,'','','',1);

                            $getteacherpayout = $this->Crud_model->get_single('mlms_payout',"user_id =".$course_detail[$i]->author);

                            $comm = 0;
                            $t_comm = 0;
                            $comm1 = 0;
                            $r_comm = 0;
                            $comm_log = 0;
                            if($referred_code!='')
                            {

								$getReseller = $this->Crud_model->getReseller($referred_code);

                                if($referred_code === $getteacher->referral_code)
                                {

                                    $comm = floatval($c_prices[$i]) * $getteacher->coursepercent /100;
                                    $t_comm = round($comm,2);



                                }else
                                {   // teacher payout

                                    $getassess = $this->Crud_model->get_single('mlms_assessment',"user_id = '".$getReseller->id."'");
                                    $reseller_payout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getReseller->id);

                                     $r_comm = floatval($c_prices[$i]) * floatval($getassess->assessment) /100 ;

                                     $reseller_total = floatval($reseller_payout->total_amount) + floatval($r_comm);
                                  $reseller_balance = floatval($reseller_payout->balance_amount) + floatval($r_comm);
                                  $reseller = array(
                                                'total_amount' => $reseller_total,
                                                'balance_amount' => $reseller_balance,
                                                'modified' => date('Y-m-d H:i:s')
                                  );
                                  $this->Crud_model->SaveData('mlms_payout',$reseller,"user_id = ".$getReseller->id);

                                  $log_comm1 = array(
                                                'order_id' => $pay_Insert,
                                                'reseller_id' => $getReseller->id,
                                                'commission' => $r_comm,
                                                'comm_percent' => $getassess->assessment,
                                                'created' => date("Y-m-d H:i:s")
                                  );
                                  $this->Crud_model->SaveData('mlms_commission_log',$log_comm1);

                                  // teacher commision
                                  $t_comm = floatval($c_prices[$i]) * (floatval($getteacher->coursepercent) - floatval($getassess->assessment)) /100 ;



/////////

                                }
                            }
                            else{       // teacher payout

/////////
                                $comm = floatval($c_prices[$i]) * floatval($getteacher->coursepercent) /100 ;
                                  $t_comm = round($comm,2);



                            }
                           $teacher_total = floatval($getteacherpayout->total_amount) + floatval($t_comm);
                                  $teacher_balance = floatval($getteacherpayout->balance_amount) + floatval($t_comm);

                                  $teacher = array(
                                                'total_amount' => $teacher_total,
                                                'balance_amount' => $teacher_balance,
                                                'modified' => date('Y-m-d H:i:s')
                                  );
                                  $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id = ".$getteacher->id);
                                  $log_comm2 = array(
                                                'order_id' => $pay_Insert,
                                                'reseller_id' => $getteacher->id,
                                                'commission' => $t_comm,
                                                'comm_percent' => $getteacher->coursepercent,
                                                'created' => date("Y-m-d H:i:s")
                                  );
                                  $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);


                        }
                         $i++;
                    } // foreach

                    $remove_cart = $this->payment_model->remove_cart($paypalData['user_id'], $course_ids);
                   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can access this courses under My Course" ));
           			redirect('my-courses');
            }
            else
            {

                   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
                              			redirect('my-courses');

            }

// =================

    }

    // Razorpay payment gateway starts here
    public function check_login(){
        $auth = $this->session->userdata('logged_in');
        if(!empty($auth))
            echo '1';
        else
            echo '0';
    }

    private function curl_handler($payment_id, $amount)  {
        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id         = $this->config->item('keyId');
        $key_secret     = $this->config->item('keySecret');
        $fields_string  = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        return $ch;
    }

    // callback method
    public function create_order(){
        $user_id = $this->input->post('user_id');
        $course_id = $this->input->post('course_id');
        $batch_id = $this->input->post('batch_id');
        $promocode = $this->input->post('promocode');
        $valid_coupon = $this->input->post('valid_coupon');
        $merchant_amount = $this->input->post('merchant_amount');
        $merchant_order_id = $this->input->post('merchant_order_id');

        $promocodeid = "";
        if($valid_coupon=='Yes'){
          $con = "(coupon_course like '%\"".$course_id."\"%' OR coupon_for = 0 ) AND code = '".$promocode."' AND codeend >= now() AND codeused <= codelimit AND published = 1";
          $rs = $this->payment_model->getPromoCodeDetails1($con);
          if(!empty($rs))
            $promocodeid = $rs->id;
        }

        $referred_code = get_cookie('referral_code');
        $order = array(
                'userid'         => $user_id,
                'order_date'     => date('Y-m-d H:i:s'),
                'courses'        => $course_id,
                'pending_reason' => 'New Order',
                'amount'         => $merchant_amount,
                'amount_paid'    => $merchant_amount,
                'processor'      => 'Razorpay',
                'currency'       => 'INR',
                'order_status'   => 'New Order',
                'status'         => 'PENDING',
                'promocodeid'    => $promocodeid,
                'referred_code'  => $referred_code,
                'transactionid'  => $merchant_order_id,
                // 'batch_id'       => $batch_id,
        );
        $this->Crud_model->SaveData("mlms_order",$order);
        $order_id = $this->db->insert_id();
        // sending mail for pending request
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();

        if($configarr[0]['fromemail'])
        $urldomain = $configarr[0]['fromemail'];
        else
        $urldomain = 'noreply@mytonlineshiksha.com';

        $userdata = $this->Crud_model->get_single('mlms_users','id = '.$user_id,'email,first_name,last_name,mobile');
        $coursedetails =$this->Crud_model->get_single('mlms_program',"id = ".$course_id,"name,slug");
        $subject = 'Order #'.$order_id.' Pending';
        $toemail = 'prashant@veerit.com';
        // $toemail = 'nikhil.b@veerit.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$order_id.' is Pending.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($userdata->first_name.' '.$userdata->last_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($userdata->email).'<br/>';
        $content .= 'Customer Mobile : '.$userdata->mobile.'<br/>';
        $content .= 'Course Name : <a href="'.base_url().'online-courses/'.$coursedetails->slug.'/">'.$coursedetails->name.'</a><br/>';
        $content .= 'Course Price : '.$merchant_amount.'<br/>';
        $content .= '<br/>';
        $data1['content'] = $content;
        $data1['fromemail'] = $urldomain;
        $message = $this->load->view('email_formates/common_email_formate.php',$data1,true);
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
        // sending mail for pending request
    }

    public function callback()
    {
      $json['msg'] = '';
      if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $merchant_order_id = $this->input->post('merchant_order_id');
        $order_info = array('order_status_id' => $merchant_order_id);

        $this->session->set_flashdata('razorpay_payment_id', $razorpay_payment_id);
        $this->session->set_flashdata('merchant_order_id', $merchant_order_id);
        $amount = $this->input->post('merchant_total');
        try {
          $success = false;
          $error = '';
          $ch = $this->curl_handler($razorpay_payment_id, $amount);
          //execute post
          $result = curl_exec($ch);
          $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
          if ($result === false) {
              $success = false;
              $error = 'Curl error: '.curl_error($ch);
          } else {
              $response_array = json_decode($result, true);
                  //Check success response
                  if ($http_status === 200 and isset($response_array['error']) === false) {
                      $success = true;
                  } else {
                      $success = false;
                      if (!empty($response_array['error']['code'])) {
                          $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                      } else {
                          $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                      }
                      header('Content-Type: application/json');
                      $json['msg'] = $error;
                      echo json_encode($json); exit;
                  }
          }
          //close curl connection
          curl_close($ch);
        } catch (Exception $e) {
            $success = false;
            header('Content-Type: application/json');
            $json['msg'] = 'Request to Razorpay Failed';
            echo json_encode($json); exit;
        }

          if ($success === true) {
              if(!empty($this->session->userdata('ci_subscription_keys'))) {
                  $this->session->unset_userdata('ci_subscription_keys');
              }
              if (!$order_info['order_status_id']) {
                  $json['redirectURL'] = $_POST['merchant_surl_id'];
              } else {
                  $json['redirectURL'] = $_POST['merchant_surl_id'];
              }

          } else {
              $json['redirectURL'] = $_POST['merchant_furl_id'];
          }
      } else {
          $json['msg'] = 'An error occured. Contact site administrator, please!';
      }
      header('Content-Type: application/json');
      echo json_encode($json);

    }
    public function razor_success() {

        $order_id = $this->session->flashdata('merchant_order_id');
        $razorpay_payment_id = $this->session->flashdata('razorpay_payment_id');
        $url = 'https://api.razorpay.com/v1/payments/'.$razorpay_payment_id;
        // $order_id = 'Txn63821209';
        /*$key_id = $this->config->item('keyId');
        $key_secret = $this->config->item('keySecret');
        // $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_POST, 0);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response = json_decode($result);
        print_r($response);

        exit;*/


        $order = array(
                'status'  => 'SUCCESS',
        );
        $this->Crud_model->SaveData("mlms_order",$order,'transactionid = "'.$order_id.'"');
        $orders = $this->Crud_model->get_single('mlms_order','transactionid = "'.$order_id.'"');
        $user_id = $orders->userid;
        $order_id = $orders->id;
        $batch_id = $orders->batch_id;
        $course_id = $orders->courses;
        $price = $orders->amount_paid;
        $currency = $orders->currency;
        // print_r($orders);exit;
        $con = "userid = ".$user_id." and course_id = ".$course_id;
        if(!empty($batch_id))
            $con .= " and batch_id = ".$batch_id;

        $check_trial = $this->Crud_model->get_single('mlms_buy_courses',$con);
        $buy_courses = array(
                        'userid'    => $user_id,
                        'order_id'  => $order_id,
                        'course_id' => $course_id,
                        'price'     => $price,
                        'currency'  => $currency,
                        'buy_date'  => date('Y-m-d H:i:s'),
                        'batch_id'  => $batch_id,
                        'criteria'  => 'paid',
                        // 'trial_status'=> '1'
        );

        if(!empty($check_trial))
        {
            if($check_trial->plan_id == 1){
               $buy_courses = array(
                        'userid'    => $user_id,
                        'order_id'  => $order_id,
                        'course_id' => $course_id,
                        'price'     => $price,
                        'currency'  => $currency,
                        'buy_date'  => date('Y-m-d H:i:s'),
                        'expired_date'=> date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s').' +1 month')),
                        'criteria'  => 'paid',
                );
            }
            $this->Crud_model->SaveData('mlms_buy_courses',$buy_courses,$con);
        }
        else{
        $this->Crud_model->SaveData('mlms_buy_courses',$buy_courses);
        }
        // commission and assessment calculations and updations
        $getcourse = $this->Crud_model->get_single('mlms_program',"id = ".$course_id,'slug,author');
        $getteacher = $this->Crud_model->get_single('mlms_users',"id = ".$getcourse->author,'referral_code,coursepercent,id');
        $teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getteacher->id);
        $comm = 0;
        $t_comm = 0;
        $r_comm = 0;
        // $referred_code = '';
        $referred_code = get_cookie('referral_code');
        if($referred_code != '' && $referred_code != '0')
        {
          $getreseller = $this->Crud_model->get_single('mlms_users',"referral_code = '".$referred_code."'",'id');

          $getassess = $this->Crud_model->get_single('mlms_assessment',"user_id = '".$getreseller->id."'");

          $getresellerpayout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getreseller->id);

          if($referred_code === $getteacher->referral_code)
          {
            $comm = floatval($price) * floatval($getteacher->coursepercent)/100;
            $t_comm = round($comm,2);
            $teacher_total = floatval($teacher_payout->total_amount) + floatval($t_comm);
            $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($t_comm);

            $teacher = array(
                          'total_amount' => $teacher_total,
                          'balance_amount' => $teacher_balance,
                          'modified' => date('Y-m-d H:i:s')
            );
            // print_r($teacher);
            $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id = ".$getteacher->id);
            $log_comm2 = array(
                          'order_id' => $order_id,
                          'reseller_id' => $getteacher->id,
                          'commission' => $t_comm,
                          'comm_percent' => $getteacher->coursepercent,
                          'created' => date("Y-m-d H:i:s")
            );
            // print_r($log_comm2);
            $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);
          }
          else
          {
            $reseller_payout = $this->Crud_model->get_single('mlms_payout',"user_id = ".$getreseller->id);
            $r_comm = floatval($price) * floatval($getassess->assessment) /100 ;
            $reseller_total = floatval($reseller_payout->total_amount) + floatval($r_comm);
            $reseller_balance = floatval($reseller_payout->balance_amount) + floatval($r_comm);
            $reseller = array(
                      'total_amount' => $reseller_total,
                      'balance_amount' => $reseller_balance,
                      'modified' => date('Y-m-d H:i:s')
            );
            $this->Crud_model->SaveData('mlms_payout',$reseller,"user_id = ".$getreseller->id);
            // print_r($reseller);
            $log_comm1 = array(
                      'order_id' => $order_id,
                      'reseller_id' => $getreseller->id,
                      'commission' => $r_comm,
                      'comm_percent' => $getassess->assessment,
                      'created' => date("Y-m-d H:i:s")
            );
            // print_r($log_comm1);
            $this->Crud_model->SaveData('mlms_commission_log',$log_comm1);
            $rcomper = $getassess->assessment;
            // payments for the agent / sub-resellers
            if(!empty($getassess->parent_id)){
              $getparent = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$getassess->parent_id,"assessment");
              $parent_comm = floatval($getparent->assessment) - floatval($rcomper);
              $rcomper = $getparent->assessment;
              $parent_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$getassess->parent_id);
              $pcom = floatval($price) * floatval($parent_comm) /100;
              $parent_total = floatval($parent_payout->total_amount) + floatval($pcom);
              $parent_balance = floatval($parent_payout->balance_amount) + floatval($pcom);
              $parent_reseller = array(
                          'total_amount' => $parent_total,
                          'balance_amount' => $parent_balance,
                          'modified' => date('Y-m-d H:i:s')
              );
              $this->Crud_model->SaveData('mlms_payout',$parent_reseller,"user_id =".$getassess->parent_id);
              $parent_log_comm = array(
                          'order_id' => $order_id,
                          'reseller_id' => $getassess->parent_id,
                          'commission' => $pcom,
                          'comm_percent' => $parent_comm,
                          'created' => date("Y-m-d H:i:s")
              );
              $this->Crud_model->SaveData('mlms_commission_log',$parent_log_comm);
            }
            // teacher commision
            $t_comm = floatval($price) * (floatval($getteacher->coursepercent) - floatval($rcomper)) /100 ;
            $teacher_total = floatval($teacher_payout->total_amount) + floatval($t_comm);
            $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($t_comm);
            $teacher = array(
                        'total_amount' => $teacher_total,
                        'balance_amount' => $teacher_balance,
                        'modified' => date('Y-m-d H:i:s')
            );
            // print_r($teacher);
            $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id = ".$getteacher->id);
            $log_comm2 = array(
                        'order_id' => $order_id,
                        'reseller_id' => $getteacher->id,
                        'commission' => $t_comm,
                        'comm_percent' => (floatval($getteacher->coursepercent) - floatval($rcomper)),
                        'created' => date("Y-m-d H:i:s")
            );
            // print_r($log_comm2);
            $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);
          }
        }
        else{       // teacher payout
          $comm = floatval($price) * floatval($getteacher->coursepercent) /100 ;
          $t_comm = round($comm,2);
          $teacher_total = floatval($teacher_payout->total_amount) + floatval($t_comm);
          $teacher_balance = floatval($teacher_payout->balance_amount) + floatval($t_comm);

          $teacher = array(
                    'total_amount' => $teacher_total,
                    'balance_amount' => $teacher_balance,
                    'modified' => date('Y-m-d H:i:s')
          );
        // print_r($getteacher);
          $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id = ".$getteacher->id);
          $log_comm2 = array(
                    'order_id' => $order_id,
                    'reseller_id' => $getteacher->id,
                    'commission' => $t_comm,
                    'comm_percent' => $getteacher->coursepercent,
                    'created' => date("Y-m-d H:i:s")
          );
        // print_r($log_comm2);
          $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);
        }
        // commission and assessment calculations and updations
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        if($configarr[0]['fromemail'])
            $urldomain = $configarr[0]['fromemail'];
        else
            $urldomain = 'noreply@mytonlineshiksha.com';

        // exit;
        $userdata = $this->Crud_model->get_single('mlms_users',"id = ".$user_id,"email,first_name,last_name,mobile");
        $coursedetails = $this->Crud_model->get_single('mlms_program',"id = ".$course_id,"name,slug");
        $subject = 'Order #'.$order_id.' SUCCESS';
        // $toemail = 'nikhil.b@veerit.com';
        $toemail = 'prashant@veerit.com';
        $toemail1 = 'ashish.gurao@veerit.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$order_id.' is Succeeded.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($userdata->first_name.' '.$userdata->last_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($userdata->email).'<br/>';
        $content .= 'Customer Mobile : '.$userdata->mobile.'<br/>';
        $content .= 'Course Name : '.$coursedetails->name.'<br/>';
        $content .= 'Course Price : '.$price.'<br/>';
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
        $this->email->cc($toemail1);
        $this->email->message($message);
        $this->email->send();
        echo "1";
    }

    public function razor_failed() {
        $payment_id = $this->session->flashdata('razorpay_payment_id');
        $order_id = $this->session->flashdata('merchant_order_id');

        /*$url = 'https://api.razorpay.com/v1/payments/'.$payment_id;

        $key_id = 'rzp_test_flW5b8FYDpVWBh';
        $key_secret = 'v5nIVSVOtMGfaiVOKJoWz6vD';
        // $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 0);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);*/
        // echo $result;

        $data = array(
                    'status' => "FAILURE",
        );
        $this->Crud_model->SaveData('mlms_order',$data,'transactionid = "'.$order_id.'"');
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        if($configarr[0]['fromemail'])
        $urldomain = $configarr[0]['fromemail'];
        else
        $urldomain = 'noreply@mytonlineshiksha.com';

        $order = $this->Crud_model->get_single('mlms_order',"transactionid = '".$order_id."'","id,userid,courses,amount");
        $userdata = $this->Crud_model->get_single('mlms_users',"id = ".$order->userid,"email,first_name,last_name,mobile");
        $coursedetails = $this->Crud_model->get_single('mlms_program',"id = ".$order->courses,"name,slug");

        $subject = 'Order #'.$order->id.' Failed';
        // $toemail = 'nikhil.b@veerit.com';
        $toemail = 'prashant@veerit.com';
        $toemail1 = 'ashish.gurao@veerit.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$pay_Insert.' is failed.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($userdata->first_name.' '.$userdata->last_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($userdata->email).'<br/>';
        $content .= 'Customer Mobile : '.$userdata->mobile.'<br/>';
        $content .= 'Course Name : '.$coursedetails->name.'<br/>';
        $content .= 'Course Price : '.$order->amount.'<br/>';
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
        $this->email->cc($toemail1);
        $this->email->message($message);
        $this->email->send();

        /*$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject);
        $this->email->to($toemail1);
        $this->email->message($message);
        $this->email->send();*/
        echo "0";
    }
    // Razorpay payment gateway ends here

}

?>
