<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paymentprocess extends CI_Controller {

    function Paymentprocess()
    {
         parent::__construct();
         $this->load->library('paypal_class');
         $this->load->library('paypalIPN/paypal_lib');
         
         // $this->load->library('form_validation');
         // $this->load->library('email');  

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
        
        $plan_id = $paypalData['plan_id'];
        $user_id = $paypalData['user_id'];
        $response_handler = $paypalData['response_handler'];
        $return_handler = $paypalData['return_handler'];                                  
        $plan_name = $paypalData['plan_name'];
        $plan_price = $paypalData['plan_price'];
        $instituteid = "";

        if($instituteid)
        {
          $uidpid= $plan_id."-".$user_id."-".$instituteid; 
        }
        else
        {
          $uidpid= $plan_id."-".$user_id; 
        }  

        // $this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

        // $this->paypal_class->add_field('currency_code','USD');
        // //$this->paypal_class->add_field('business',  'accountant-facilitator@sailors-club.net'); //  accountant@sailors-club.net  // accountant-facilitator@sailors-club.net  // vikas.gorle@gmail.com
        // $this->paypal_class->add_field('business',  'paypal-facilitator@veerit.com');
        // $this->paypal_class->add_field('return', $response_handler); // return url
        // $this->paypal_class->add_field('cancel_return', $return_handler); // cancel url

        // $item_name = $this->paypal_class->add_field('item_name', $plan_name);
        // $amount = $this->paypal_class->add_field('amount', $plan_price);
        // //$amount = $this->paypal_class->add_field('amount', '400');
        // $this->paypal_class->add_field('notify_url', base_url().'paymentprocess/ipn_response_handler'); 
        // $this->paypal_class->add_field('custom', $uidpid);

        // $this->paypal_class->submit_paypal_post(); 

        $this->paypal_lib->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

        $this->paypal_lib->add_field('currency_code','USD');
        //$this->paypal_class->add_field('business',  'accountant-facilitator@sailors-club.net'); //  accountant@sailors-club.net  // accountant-facilitator@sailors-club.net  // vikas.gorle@gmail.com
        $this->paypal_lib->add_field('business',  'paypal-facilitator@veerit.com');
        $this->paypal_lib->add_field('return', $response_handler); // return url
        $this->paypal_lib->add_field('cancel_return', $return_handler); // cancel url

        $item_name = $this->paypal_lib->add_field('item_name', $plan_name);
        $amount = $this->paypal_lib->add_field('amount', $plan_price);
        //$amount = $this->paypal_class->add_field('amount', '400');
        $this->paypal_lib->add_field('notify_url', base_url().'paymentprocess/ipn_response_handler'); 
        $this->paypal_lib->add_field('custom', $uidpid);

        $this->paypal_lib->paypal_auto_form(); 


    }

    function new_Payment_Process()
    {
        $sessionarray = $this->session->userdata('logged_in');

        
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
            $pay_setting = $this->settings_model->getAccountMode();

            $url = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']); 
            
            if($pay_setting[0]['status'] == 155) // for Live Mode
            {

            }
            else // for sandbox Mode
            {

                $program_id = 451;  //$this->uri->segment(3);              
                  // $program_id = 452;
                $course_details = $this->settings_model->getProgramDetails($program_id);
                
                if($course_details)
                {
                    $chb_free_courses = $course_details->chb_free_courses;
                    $step_access_courses = $course_details->step_access_courses;
                    $fixedrate = $course_details->fixedrate;

                    if($fixedrate != 0.00)
                    {  

                     $paypalData = array( 
                        'plan_id' => 4,
                        'user_id' => $user_id,
                        'response_handler' => base_url().'paymentprocess/response_handler',
                        'return_handler' => base_url().'paymentprocess/return_handler',                                   
                        'plan_name' => $course_details->name,
                        'plan_price' => $course_details->fixedrate, 
                        'course' => $course_details->name, 
                        'course_id' => $program_id,                         
                        );

                    $this->session->set_userdata('paypalData',$paypalData);

                    $this->paypal_box($paypalData); 

                    
                    }
                    else
                    {

                        $getPlanDetails = $this->settings_model->getPlanDetails($program_id,2);

                        $paypalData = array(
                        'userid' => $user_id,                                   
                        'courses' => $course_details->name,                   
                        'amount_paid' => $getPlanDetails->price,                 
                            );

                        echo"<pre>";
                        echo $url; 
                        print_r($getPlanDetails);
                        

                    }
                }
                else
                {
                        echo "their no course availble";
                }               

            }

            
        }

    }

    function response_handler()
    {       

        $paypalData = $this->session->userdata('paypalData');        
        $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
       
        $urlCourse = strtolower($paypalData['course']);          
        $urlCourse = trim(str_replace(' ', '-', $urlCourse));
        $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

        //redirect('course/programs/'.$paypalData['course_id']); 
        //redirect('programs/lectures/'.$paypalData['course_id']); 
        //redirect('programs/lectures/73'); 
        //$this->session->unset_userdata('paypalData');
        // echo"<pre>";
        // print_r($_REQUEST);

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
        
        $upd_data = array(
                        'userid' => $paypalData['user_id'],                                   
                        'courses' => $paypalData['course_id'],
                        'order_date' => $order_date,
                        'status' => $_REQUEST['payment_status'],
                        'pending_reason' => $_REQUEST['pending_reason'] ? $_REQUEST['pending_reason']:'none',
                        'amount' => $_REQUEST['payment_gross'],
                        'amount_paid' => $_REQUEST['payment_gross'],
                        'published' => $published,
                        'processor' => 'paypal',
                        'currency' => $_REQUEST['mc_currency'],
                        'transactionid' =>$_REQUEST['txn_id'],
                        'order_status' =>'New Order'
                         );


         echo"<pre>";
         print_r($upd_data);

        //$pay_Insert = $this->settings_model->insertPaypalSuccessNew($upd_data);  
                   
        //$buy_courses = $this->settings_model->insertBuyCourse($paypalData, $pay_Insert, $currency, $ordertime, $Expire_Date, $plan_id,$amt);

        
    }

    function return_handler()
    {
        echo"<pre>";
        print_r($_REQUEST);
    }


        function ipn_response_handler()
        {
           $ipn_valid = $this->paypal_lib->validate_ipn();
            if($ipn_valid == TRUE)
            {
                $paypalURL = $this->paypal_lib->paypal_url;     
                $result = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
                    
                if(preg_match("/VERIFIED/i",$result))
                {


                    $data_ipn['user_id']            = $this->paypal_lib->ipn_data['custom']; /* get USER_ID from custom field. */
                    $data_ipn['txn_id']             = $this->paypal_lib->ipn_data['txn_id'];
                    $data_ipn['payment_status']     = $this->paypal_lib->ipn_data['payment_status'];
                    $data_ipn['mc_gross']           = $this->paypal_lib->ipn_data['mc_gross'];
                    $data_ipn['mc_fee']             = $this->paypal_lib->ipn_data['mc_fee'];
                    $data_ipn['mc_currency']        = $this->paypal_lib->ipn_data['mc_currency'];
                    $data_ipn['item_number']        = $this->paypal_lib->ipn_data['item_number'];
                   
                


                    // $urldomain = base_url();
                    // $urldomain = str_replace('http://', '', $urldomain);
                    // $urldomain = str_replace('/', '', $urldomain);
                    // $urldomain = str_replace('www.', '', $urldomain);
                    $urldomain = $this->config->item('urldomain');
                   
                    $subject1 = 'Your course renewed successfully';
                    $toemail1 = "veerit1511@gmail.com"; 
                    $content = '';
                    $content .= 'Thank you for renewing your course subscription. Here are your renewal details: <br /><br />';
                    $content .= "Course renewed: ".$data_ipn['item_name']."<br />";
                    $content .= ' Transaction Id: '.$data_ipn['txn_id'].'<br />';
                    $content .= ' Amount: '.$data_ipn['mc_gross'].'<br />';
                    $content .= ' Status: '.$data_ipn['payment_status'].'<br /><br />';                    
                    
                    $data['content'] = $content;
                    $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
                    $fromemail1 = 'noreply@'.$urldomain;       //$configarr[0]['fromemail'];// admin mail
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail1,"testing");// admin mail);
                    $this->email->subject($subject1);
                    $this->email->to($toemail1);
                    $this->email->message($message1);
                    $this->email->send(); 
                } 

            }
        }



    function paypaltest()
    {

        //Set variables for paypal form
        $returnURL = base_url().'paymentprocess/success'; //payment success url
        $cancelURL = base_url().'paymentprocess/cancel'; //payment cancel url
        $notifyURL = base_url().'paymentprocess/ipn'; //ipn url
        //get particular product data
        
        $userID = 1; //current user id
        $logo = base_url().'uploads/settings/img/logo/1264_12-29-2016.png';

        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', "Bank Courses");
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  1);
        $this->paypal_lib->add_field('amount',  500);     
        $this->paypal_lib->image($logo);
        
        $this->paypal_lib->paypal_auto_form();

    }


    function success(){
        //get the transaction data
        $paypalInfo = $this->input->get();
          
        $data['item_number'] = $paypalInfo['item_number']; 
        $data['txn_id'] = $paypalInfo["tx"];
        $data['payment_amt'] = $paypalInfo["amt"];
        $data['currency_code'] = $paypalInfo["cc"];
        $data['status'] = $paypalInfo["st"];
        
        //pass the transaction data to view
        echo"<pre>";
        print_r($data);
        print_r($_REQUEST);
        
     }
     
     function cancel(){
        //$this->load->view('paypal/cancel');
        echo"cancel";
     }
     
     function ipn(){
        //paypal return transaction details array
        $ipn_valid = $this->paypal_lib->validate_ipn();

        $paypalInfo = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id'] = $paypalInfo["item_number"];
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;     
        $result = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
            //$this->product->insertTransaction($data);

             echo"<pre>";
             print_r($data);

                    // $urldomain = base_url();
                    // $urldomain = str_replace('http://', '', $urldomain);
                    // $urldomain = str_replace('/', '', $urldomain);
                    // $urldomain = str_replace('www.', '', $urldomain);
             $urldomain = $this->config->item('urldomain');
                   
                    $subject1 = 'Your course renewed successfully';
                    $toemail1 = "veerit1511@gmail.com"; 
                    $content = '';
                    $content .= 'Thank you for renewing your course subscription. Here are your renewal details:'.$data['payment_status'].' '.$ipn_valid.' status<br /><br />';
                    // $content .= "Course renewed: ".$programinfo->name."<br />";
                    // $content .= ' Transaction Id: '.$result['TRANSACTIONID'].'<br />';
                    // $content .= ' Amount: '.$result['AMT'].'<br />';
                    // $content .= ' Status: '.$result['PAYMENTSTATUS'].'<br /><br />';                    
                    
                    $data['content'] = $content;
                    $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
                    $fromemail1 = 'noreply@'.$urldomain;       //$configarr[0]['fromemail'];// admin mail
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $this->email->from($fromemail1,"testing");// admin mail);
                    $this->email->subject($subject1);
                    $this->email->to($toemail1);
                    $this->email->message($message1);
                    $this->email->send(); 


        }

    }

}


?>