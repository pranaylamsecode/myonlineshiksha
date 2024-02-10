<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_url extends MLMS_Controller 
{
	 function __construct()
  {
    parent::__construct();

    $this->load->model('api_model');
    // $this->load->model('login_model');

    $this->load->library('email');

    $this->load->database();  
    // $this->rest_format = 'json';
    // $this->rest = new stdClass;
    // $this->rest->level = NULL;
    // $this->methods = array('get','post','put','delete');
 
  }
  public function index()
  {
    echo "string";
  }

public function payuSuccess_post()
  {

        $expired_date ="";
        $plan_id = 0;
        $order_date = date("Y-m-d H:i:s",strtotime($_POST['addedon']));

        $user_id = $_POST['udf1'];
        $course_id = $_POST['udf2'];
        $txnStatus = strtolower($_POST['status']);
        $txnid = $_POST['payuMoneyId'];

        $order_date = date("Y-m-d H:i:s",strtotime($_POST['addedon']));

        $published = $txnStatus == 'success' ? '1' : $txnStatus == 'pending' ? '0' : $txnStatus == 'failure' ? '0' : '0';


        // $course_id = "46"; $user_id = '1'; $txnid = '';
        $course_details = $this->api_model->getData('mlms_program', 'id,name,fixedrate', array('id' => $course_id, 'published' => 1), '','','', 1);
        $is_Alreadybuy = $this->api_model->getData('mlms_buy_courses', 'id', array('userid' => $user_id, 'course_id' => $course_id), '','','', 1);

        $getOrderDetails = $this->api_model->getData('mlms_order','id', array('userid' => $user_id, 'courses' => $course_id, 'transactionid' => $txnid), '','','', 1 );   
            
         if(empty($is_Alreadybuy))
           {
                if(empty($getOrderDetails))
                {
                    $upd_data = array(
                                    'userid' => $user_id, 
                                    'order_date' => $_POST['addedon'],                                  
                                    'courses' => $course_id,                        
                                    'status' => $txnStatus,
                                    'pending_reason' => $_POST['error_Message'] ? $_POST['error_Message']:'none',
                                    'amount' => $_POST['amount'],
                                    'amount_paid' => $_POST['net_amount_debit'],
                                    'processor' => 'payumoney ( '.$_POST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$txnid,
                                    'order_status' =>'New Order',
                                    // 'referred_code' => $referred_code
                                     );

                     $pay_Insert = $this->api_model->SaveData('mlms_order', $upd_data); 
                }
                else
                {

                    $upd_data = array(
                                    'order_date' => $_POST['addedon'],                                  
                                    'status' => $txnStatus,
                                    'pending_reason' => $_POST['error_Message'] ? $_POST['error_Message']:'none',
                                    'amount' => $_POST['amount'],
                                    'amount_paid' => $_POST['net_amount_debit'],
                                    'processor' => 'payumoney ( '.$_POST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$txnid,
                                    'order_status' =>'New Order',
                                    // 'referred_code' => $referred_code
                                     );

                    $pay_Insert = $this->api_model->SaveData('mlms_order', $upd_data, array('userid' => $user_id, 'courses' => $course_id, 'transactionid' => $txnid));

                    $pay_Insert = $getOrderDetails->id;

                }
                if($txnStatus == 'success')
                       {
                            $fixedrate = $course_details->fixedrate;
                            $program_plans = $this->api_model->getProgramPlans($course_id);
                  $plan_id = @$program_plans[0]->id ? $program_plans[0]->id : '';


                            if($fixedrate == 0.00)
                            {   
                              
                                 $getPlanDetails = $this->api_model->getPlanDetails($course_id,$plan_id);
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
                                    'price' => $_POST['amount'],
                                    'currency' => "INR",
                                    'buy_date' => date("Y-m-d H:i:s"),
                                    'expired_date' => $expired_date,
                                    'plan_id' => $plan_id,
                                    'email_send' => 1,
                                    'finalexam_status' => "notgiven",
                                    'average' => 0,
                                    'finalexamid' => 0,
                                    'certification' => "notissued",
                                    'status' => 0,
                            );
                                   
                       
                            $buy_courses = $this->api_model->SaveData('mlms_buy_courses', $buyCourseDetails);
                            $remove_cart = $this->api_model->remove_cart($user_id, $course_id);

                            $program_id = $course_id;
                            $getcourse = $this->api_model->GetData('mlms_program','author',array('id' => $program_id),'','','',1);
                            $getteacher = $this->api_model->GetData('mlms_users','referral_code, coursepercent',array('id'=>$getcourse->author),'','','',1);
                            $getteacherpayout = $this->api_model->GetData('mlms_payout','id,total_amount,balance_amount',array('user_id' => $getcourse->author),'','','',1);

                            $comm = 0;
                            $t_comm = 0;
                            $comm1 = 0;
                            $r_comm = 0;
                            $comm_log = 0;
                           
                                $comm = floatval($_POST['net_amount_debit']) * 50 /100;
                                $t_comm = round($comm,2);
                            $comm = floatval($_POST['net_amount_debit']) * floatval(@$getteacher->coursepercent) /100 ;
                            $t_comm = round($comm,2);

                            if($getteacherpayout){
                            $teacherPayout = floatval($getteacherpayout->total_amount) + floatval($t_comm);
                            $teacherbalancePayout = floatval($getteacherpayout->balance_amount) + floatval($t_comm);
                            $data = array(
                                        'total_amount' => $teacherPayout,
                                        'modified' => date("Y-m-d H:i:s"),
                                        'balance_amount' => $teacherbalancePayout
                            );
                            $this->api_model->SaveData('mlms_payout',$data, array('user_id' => $getcourse->author));
                            }
                            $log_comm = array(
                                             'order_id' => $pay_Insert,
                                             'reseller_id' => $getcourse->author,
                                             'commission' => $t_comm,
                                             'created' => date("Y-m-d H:i:s"),
                            );
                            $this->api_model->SaveData('mlms_commission_log',$log_comm);                       
                          echo "Successfully Enrolled";
                        }
                        else echo "Your order is in ".$txnStatus."! \n we are checking your order & get back you soon..";
                        

            }
            else echo "You are already enrolled..!";

  }

  public function payuSuccessCart_post()
  {
        $expired_date ="";
        $plan_id = 0;
     
        $course_ids = explode(',', substr($_POST['udf2'],1,-1));
        $c_prices   = explode(',', substr($_POST['udf3'],1,-1));
        $c_planid   = explode(',', substr($_POST['udf4'],1,-1));

        $order_date = date("Y-m-d H:i:s",strtotime($_POST['addedon']));

        $user_id = $_POST['udf1'];
        $txnStatus = strtolower($_POST['status']);
        $txnid = $_POST['payuMoneyId'];

        $published = $txnStatus == 'success' ? '1' : $txnStatus == 'pending' ? '0' : $txnStatus == 'failure' ? '0' : '0';
   
        $is_Alreadybuy = $this->api_model->getData_json("mlms_buy_courses", "course_id", array('userid'=> $user_id), 'course_id', $course_ids,'','','','');

        
        if($is_Alreadybuy){
            foreach ($is_Alreadybuy as $buy_id) {
                
                $course_ids = array_diff((array)$course_ids, array($buy_id->course_id));
                $remove_cart = $this->api_model->remove_cart($user_id, $buy_id->course_id);
            }
         }

       
        $i = 0;
                
        if($course_ids){
            $course_detail = $this->api_model->getData_json("mlms_program", "id,name,fixedrate",array('published'=> '1'), 'id', $course_ids,'','','','');
            foreach ($course_ids as $course_id) {
              $getOrderDetails = $this->api_model->getData('mlms_order','id', array('userid' => $user_id, 'courses' => $course_id, 'transactionid' => $txnid), '','','', 1 ); 
               if(empty($getOrderDetails))
                {
                    $upd_data = array(
                                    'userid' => $user_id, 
                                    'order_date' => $_POST['addedon'],                                  
                                    'courses' => $course_id,                        
                                    'status' => $txnStatus,
                                    'pending_reason' => $_POST['error_Message'] ? $_POST['error_Message']:'none',
                                    'amount' => $c_prices[$i],
                                    'amount_paid' => $c_prices[$i],
                                    'processor' => 'payumoney ( '.$_POST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$txnid,
                                    'order_status' =>'New Order',
                                    // 'referred_code' => $referred_code
                                     );

                     $pay_Insert = $this->api_model->SaveData('mlms_order', $upd_data); 
                }
                else
                {

                    $upd_data = array(
                                    'order_date' => $_POST['addedon'],                                  
                                    'status' => $txnStatus,
                                    'pending_reason' => $_POST['error_Message'] ? $_POST['error_Message']:'none',
                                    'amount' => $c_prices[$i],
                                    'amount_paid' => $c_prices[$i],
                                    'processor' => 'payumoney ( '.$_POST['PG_TYPE'].' )',
                                    'currency' => 'INR',
                                    'published' => $published,
                                    'transactionid' =>$txnid,
                                    'order_status' =>'New Order',
                                    // 'referred_code' => $referred_code
                                     );

                    $pay_Insert = $this->api_model->SaveData('mlms_order', $upd_data, array('userid' => $user_id, 'courses' => $course_id, 'transactionid' => $txnid));

                    $pay_Insert = $getOrderDetails->id;

                }
                if($txnStatus == 'success')
                   {
                        $fixedrate = $course_detail[$i]->fixedrate;

                        if($fixedrate == "0.00")
                        { 
                            $plan_id = $c_planid[$i];

                                $course_id = $course_id;

                                $getPlanDetails = $this->api_model->getPlanDetails($course_id,$plan_id);

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
                                    'price' => $c_prices[$i],
                                    'currency' => "INR",
                                    'buy_date' => $order_date,
                                    'expired_date' => $expired_date,
                                    'plan_id' => $c_planid[$i],
                                    'email_send' => 1,
                                    'finalexam_status' => "notgiven",
                                    'average' => 0,
                                    'finalexamid' => 0,
                                    'certification' => "notissued",
                                    'status' => 0,
                            );
                        $buy_courses = $this->api_model->SaveData('mlms_buy_courses', $buyCourseDetails);                         
                        $remove_cart = $this->api_model->remove_cart($user_id, $course_id);

                            $program_id = $course_id;
                            $getcourse = $this->api_model->GetData('mlms_program','author',array('id' => $program_id),'','','',1);

                            $getteacher = $this->api_model->GetData('mlms_users','referral_code, coursepercent',array('id'=>$getcourse->author),'','','',1);

                            $getteacherpayout = $this->api_model->GetData('mlms_payout','id,total_amount,balance_amount',array('user_id' => $getcourse->author),'','','',1);

                            $comm = 0;
                            $t_comm = 0;
                            $comm1 = 0;
                            $r_comm = 0;
                            $comm_log = 0;
                            $comm = floatval($c_prices[$i]) * floatval($getteacher->coursepercent) /100 ;
                            $t_comm = round($comm,2); 

                               

                            $teacherPayout = floatval($getteacherpayout->total_amount) + floatval($t_comm);
                            $teacherbalancePayout = floatval($getteacherpayout->balance_amount) + floatval($t_comm);
                            $data = array(
                                        'total_amount' => $teacherPayout,
                                        'modified' => date("Y-m-d H:i:s"),
                                        'balance_amount' => $teacherbalancePayout
                            );
                            $this->api_model->SaveData('mlms_payout',$data, array('user_id' => $getcourse->author));

                            $log_comm = array(
                                             'order_id' => $pay_Insert,
                                             'reseller_id' => $getcourse->author,
                                             'commission' => $t_comm,
                                             'created' => date("Y-m-d H:i:s"),
                            );
                            $this->api_model->SaveData('mlms_commission_log',$log_comm);                       
                        
                        
                    }
                   
                $i++;

            }  echo "Successfully Enrolled";
        }
        else echo "You are already enrolled..!";

       
  }

  public function payuFail_post()
  {
    echo "Something wents wrong. Your enrollment has Failed, Please try again!..";
  }

}

 ?>