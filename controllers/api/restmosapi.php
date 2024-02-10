<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*----------------------------------------------------------------------------------
REST_Controller is downloaded from 
https://github.com/chriskacerguis/codeigniter-restserver/tree/v2.4
https://github.com/chriskacerguis/codeigniter-restserver/blob/v2.4/application/libraries/REST_Controller.php

----------------------------------------------------------------------------------*/
//require(APPPATH.'libraries/REST_Controller.php');
require(APPPATH.'libraries/REST_Controller.php');

class Restmosapi extends REST_Controller
{ 
  public $rest;
  public $rest_format;
  public $methods;

  function __construct()
  {
    parent::__construct();

    $this->load->model('api_model');
    $this->load->model('login_model');

    $this->load->library('email');

    $this->load->database();  
    $this->rest_format = 'json';
    $this->rest = new stdClass;
    $this->rest->level = NULL;
    $this->methods = array('get','post','put','delete');
 
  }

  public function getAPIVersion_get(){
    

    $data = array('returned: ' => 'hello','version'=>CI_VERSION);

        $this->response($data,200);

  }

  public function terms_get()
  {
  
    $resourcepage=$this->api_model->getPageById('13');
$tab = $this->session->userdata('page_tab');
    $str = '<div class="section-text press-head">
    <h1 class="press-tittle story-title">'.$resourcepage[0]['heading'].'</h1>
  </div>
<div class="container">
  <div class="terms_tab">
        <div class="col-sm-3">
            <ul class="nav nav-tabs tabs-left">
                <li class="terms';
                  $str .= $tab == 'terms' ? 'active' : '';
                  $str .= '"><a href="https://myonlineshiksha.com/terms-of-use" >Terms of Use</a></li>
               
            </ul>
        </div>
        <div class="col-sm-8">
            <div class="tab-content" style="text-align: justify !important;">'.
                            $resourcepage[0]['content'].'
                    </div>

                    <div class="col-sm-4" style="display: none;">
                    <h3>Graduates Testimonials</h3>
                    <div class="carousel" style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; height: 300px;">
                    <ul class="testimonials" style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1; height: 1500px; top: -800px;">
                    </ul>
                    </div>
                    <a href="#" class="navi-right next"></a>
                    <a href="#" class="navi-left prev"></a>
                    </div>
            </div>
          </div>
        </div>';
    
    $response['content'] = $str;
      return $this->response($response,200);
  }

  public function privacypolicy_get()
  {
    
    $resourcepage=$this->api_model->getPageById("14");
      $response['content'] = $resourcepage[0]["content"];
       return $this->response($response,200);
  }

  public function contact_post()
  {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $body = $this->input->post('body');
        $configarr = $this->api_model->getConfig();

        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

        $fromemail=$urldomain;       

        $admininfo = $this->api_model->getadminInfo(4);       

        $admin_email= $admininfo->email;
        $subject1 = 'Request a call back - '.$mobile.' - MOS App';
        // 'Enuiry received from app - '.$configarr[0]['institute_name'];
        $toemail = $admin_email;
        
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">
                    REQUEST A CALL ENQUIRY</p>';
        $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
        $content .='There is a new Enquiry. Here are the details:<br /><br />';
        $content .= 'Email : <a style="color:#55c5eb" href="mailto:'.$email.'" target="_blank">'.$email.'</a><br />';
        $content .= 'Contact No. : '.$mobile.'<br />';
        $content .= 'Message : '.$body.'<br />';
        $content .= 'toemail : '.$toemail.'<br />';
        $data['content'] = $content;
        $message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
        
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail,$configarr[0]['fromname']);
        $this->email->to("prshah83@gmail.com");
        $this->email->cc($toemail);
        // $this->email->cc("jyotisorte4@gmail.com");
        $this->email->subject($subject1);
        $this->email->message($message1);
        
        if($this->email->send())
        {
          $response['status'] = "send";
        }
        else $response['status'] = "fail";
        echo json_encode($response);
    
  }

  public function getHash_post()
  {
    
    $u_id=$_POST["u_id"];
    $course_id=$_POST["course_id"];
    // $course_ids = json_decode($_POST['course_id']);
    $key=$_POST["key"];
    $txnid=$_POST["txnid"];
    $amount=$_POST["amount"]; //Please use the amount value from database
    $productinfo=$_POST["productinfo"];
    $firstname=$_POST["firstname"];
    $email=$_POST["email"];
    // $salt="I93ku9W1B3"; //jyoti
    $salt="PjFlHQzo6r"; 
    $udf3=$_POST["udf3"]; 
    $udf4=$_POST["udf4"]; 


    $hashSeq = $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|'.$u_id.'|'.$course_id.'|'.$udf3.'|'.$udf4.'|||||||'.$salt;

    $hash = hash("sha512", $hashSeq);

    echo $hash;
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
                            $comm = floatval($_POST['net_amount_debit']) * floatval($getteacher->coursepercent) /100 ;
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

  

  public function getWishlist_post()
  {
    $user_id = $this->input->post('user_id');
    $type = $this->input->post('type') ? $this->input->post('type') : '0';
    $tot_fix = 0;
    $tot_demo = 0;
    if($user_id){
      $wishlist = $this->api_model->getWishlist($user_id,$type);
      foreach ($wishlist as $key => $result) {
        $wishlist[$key]['image'] = $wishlist[$key]['image'] ? $wishlist[$key]['image'] : "https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/no_images_course.png";
        if($type == "2")
        {
         
          $plan_id = $this->api_model->getData('mlms_program_plans', 'plan_id', array('product_id'=> $wishlist[$key]['id']),'','','','1');
          // $plan_id = $this->api_model->getPlanId($wishlist[$key]['id']);
          if($plan_id) $wishlist[$key]['plan_id'] = $plan_id->plan_id;
          else $wishlist[$key]['plan_id'] = 0;
        }
        $tot_fix = $tot_fix + (@$wishlist[$key]['fixedrate'] ? @$wishlist[$key]['fixedrate'] : 0);
        $tot_demo = $tot_demo + (@$wishlist[$key]['demoprice'] ? @$wishlist[$key]['demoprice'] : 0);
         $getReview = $this->api_model->getAvgReview($wishlist[$key]['id']);
      $wishlist[$key]['review'] = $getReview;
      $wishlist[$key]['tot_fix'] = $tot_fix;
      $wishlist[$key]['tot_demo'] = $tot_demo;
      }
      
      return $this->response($wishlist,200);
    }
    else{

      $errors['message'] = "user not found";

      $errors['error'] = true;

      return $this->response($errors,205);
    
    }

  }

  public function orderDelete_post()
  {
    $this->api_model->delete_buy('mlms_buy_courses', array('userid'=>'1'), "course_id", array("68","158"));
    // print_r($this->api_model->com());
    $this->api_model->delete_buy('mlms_order', array('userid'=>'1'), "courses", array("68","158"));
    $this->api_model->delete_buy('mlms_commission_log', "", "order_id", array("165","48","164"));
    $this->api_model->update_buy('mlms_payout', "", "user_id", array("76","776"), array('total_amount'=>'0','balance_amount'=>"0"));
   
  }

  public function addWhishlist_post()
  {
    $user_id = $this->input->post('user_id');
    $type = $this->input->post('type');
    $pro_id = $this->input->post('course_id');

    if($user_id && $pro_id)
    {
      $insert = $this->api_model->addWhishlist($user_id,$pro_id,$type);

      // if($insert)
      // {
        $response['insert'] = $insert;
        $response['message'] = "success";
        $response['error'] = false;
        return $this->response($response,200);
      // }

    }
    else{
      $errors['post'] = $_POST;
      $errors['message'] = "Invalid post";

      $errors['error'] = true;

      return $this->response($errors,205);
    
    }

  }

  public function removeWish_post()
  {
    $del = $this->api_model->removeWish();
    $response['delete'] = $del;
    $response['message'] = "success";
    $response['error'] = false;
    return $this->response($response,200);
  }

  public function getCatCourses_post()
  {
     
    if(@$this->input->post('course_ids'))
    {
        if(@$this->input->post('free') != "")
        {
            $courses = $this->api_model->getCatCourses_free("(p.fixedrate <= 0) and p.published = 1 and p.trash = 0",8);
        }
        else{
            $ids = @$this->input->post('course_ids') ? json_decode(@$this->input->post('course_ids')) : NULL;
          $courses = $this->api_model->getCatCourses(NULL, NULL, $ids);
        }
    }
   
    else{
    $limit = @$this->input->post('limit') ? @$this->input->post('limit') : NULL;
    $catid = @$this->input->post('cat_id') ? @$this->input->post('cat_id') : '';
    $author_id = $this->input->post('author_id') ? $this->input->post('author_id') : '';
    if($catid)
      $courses = $this->api_model->getCatCourses($catid, $limit);
    else if($author_id) $courses = $this->api_model->getAuthCourses($author_id, $limit);
    }
    if($courses){
    foreach ($courses as $key => $result) {

          $rem_html = strip_tags($result['description']);
          $rem_spaces = preg_replace("/\s+/", " ", $rem_html);
          $rem_white = preg_replace('/\s+/', ' ', $rem_spaces);
          $rem_special_chars = preg_replace("/&#?[a-z0-9]+;/i"," ",$rem_white);
                   
          $desc = str_replace('         ',' ',$rem_special_chars);
          $courses[$key]['description'] = $desc;

          $course_img = $result['image'] ? $result['image'] : 'no_images_course.png';
          $courses[$key]['course_image'] = "https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/".$course_img;
          

          if( !empty($courses[$key]['author'])){
              
              $courses[$key]['author'] = $this->api_model->getTeacherInfoForRest($courses[$key]['author']);
              // foreach ($author as $key1 => $value1) {
              //  array_push($courses[$key], array($author[$key1] => $author[$value1]));
              // }
              
           
          }
          $getReview = $this->api_model->getAvgReview($courses[$key]['id']);
          $courses[$key]['review'] = $getReview;


          if( !empty($courses[$key]['catid'])){
              
              $courses[$key]['catid'] = $this->api_model->getCategoryForRest($courses[$key]['catid']);
              
          }


        }


      return $this->response($courses,200);
    }
    else{
      $errors['message'] = $this->input->post('free')."Id not found";

      $errors['error'] = true;

      return $this->response($errors,205);
    }

  }

  public function getCourses_post()
  {

    if(@$this->input->post('id'))
    {
      $ids = @$this->input->post('id');
      $ids = trim($ids, '""');
      $arr = explode(',', $ids);
      $courses['ids'] = $ids;
      // return $this->response($courses,200);
    }
    else{ $arr = NULL; }

    $limit = @$this->input->post('limit') ? @$this->input->post('limit') : NULL;
    $search = @$this->input->post('search_text') ? @$this->input->post('search_text') : NULL;
    $topRate = @$this->input->post('topRate') ? @$this->input->post('topRate') : NULL;
    $auth_id = @$this->input->post('auth_id') ? @$this->input->post('auth_id') : NULL;
    $courses = $this->api_model->getApiCourses($arr, $limit, $search, $topRate, $auth_id);
    foreach ($courses as $key => $result) {

          $rem_html = strip_tags($result['description']);
          $rem_spaces = preg_replace("/\s+/", " ", $rem_html);
          $rem_white = preg_replace('/\s+/', ' ', $rem_spaces);
          $rem_special_chars = preg_replace("/&#?[a-z0-9]+;/i"," ",$rem_white);
                   
          $desc = str_replace('         ',' ',$rem_special_chars);
          $courses[$key]['description'] = $desc;

          $course_img = $result['image'] ? $result['image'] : 'no_images_course.png';
          $courses[$key]['course_image'] = "https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/".$course_img;
          
          if($auth_id){
            $courses[$key]['enrolled'] =$this->api_model->getEnrolledUser($courses[$key]['id']);                                   
            $courses[$key]['completed'] = $this->api_model->getcourseCompleted($courses[$key]['id']);

          }
          if( !empty($courses[$key]['author'])){
              
              $courses[$key]['author'] = $this->api_model->getTeacherInfoForRest($courses[$key]['author']);
              // foreach ($author as $key1 => $value1) {
              //  array_push($courses[$key], array($author[$key1] => $author[$value1]));
              // }
              
           
          }
          $getReview = $this->api_model->getAvgReview($courses[$key]['id']);
          $courses[$key]['review'] = $getReview;

// print_r($courses);
          if( !empty($courses[$key]['catid'])){
            
              $courses[$key]['catid'] = $this->api_model->getCategoryForRest($courses[$key]['catid']);
              // print_r($this->api_model->getCategoryForRest($courses[$key]['catid']));
          }
          else{
          $courses[$key]['catid'] = [];
            $courses[$key]['catid'] = array_merge($courses[$key]['catid'], array("cat_id"=> "147",
            "cat_name"=> "All Courses"));
          }
           // 

          if(is_null($courses[$key]['image']))
            $courses[$key]['image'] = "default.jpg";
        }


    return $this->response($courses,200);
  }

  public function getTopRateCourse_post()
  {
    if(@$this->input->post('id'))
    {
      $ids = @$this->input->post('id');
      $ids = trim($ids, '""');
      $arr = explode(',', $ids);
      $courses['ids'] = $ids;
      // return $this->response($courses,200);
    }
    else{ $arr = NULL; }
    $limit = @$this->input->post('limit') ? @$this->input->post('limit') : NULL;
    $search = @$this->input->post('search_text') ? @$this->input->post('search_text') : NULL;
    $courses = $this->api_model->getTopRateCourses($arr, $limit, $search);

    foreach ($courses as $key => $result) {

          $rem_html = strip_tags($result['description']);
          $rem_spaces = preg_replace("/\s+/", " ", $rem_html);
          $rem_white = preg_replace('/\s+/', ' ', $rem_spaces);
          $rem_special_chars = preg_replace("/&#?[a-z0-9]+;/i"," ",$rem_white);
                   
          $desc = str_replace('         ',' ',$rem_special_chars);
          $courses[$key]['description'] = $desc;

          $course_img = $result['image'] ? $result['image'] : 'no_images_course.png';
          $courses[$key]['course_image'] = "https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/".$course_img;
          

          if( !empty($courses[$key]['author'])){
              
              $courses[$key]['author'] = $this->api_model->getTeacherInfoForRest($courses[$key]['author']);
              // foreach ($author as $key1 => $value1) {
              //  array_push($courses[$key], array($author[$key1] => $author[$value1]));
              // }
              
           
          }
          $getReview = $this->api_model->getAvgReview($courses[$key]['id']);
          $courses[$key]['review'] = $getReview;


          if( !empty($courses[$key]['catid'])){
              
              $courses[$key]['catid'] = $this->api_model->getCategoryForRest($courses[$key]['catid']);
              
          }


        }


    return $this->response($courses,200);
  }


  function getNotes_post()
  {
     $user_id = $this->input->post('user_id');
    $pro_id = $this->input->post('pro_id');
    $notes = $this->api_model->getNotes($user_id, $pro_id);
    // $response['notes'] = $notes;
    // $notes = array_merge($notes,$notes,$notes);
   return $this->response($notes,200);
  }

   function addNotes_post()
  {
     $user_id = $this->input->post('user_id');
    $pro_id = $this->input->post('pro_id');
    $mod = $this->input->post('mod');
    $lesson_id = $this->input->post('les');
    $note = $this->input->post('note');
    $data=array(
            'pid'=> $pro_id ,
            'module_id'=> $mod ,
            'lesson_id'=> $lesson_id ,
            'notes'=> $note ,
            'userid'=> $user_id );

    $notes = $this->api_model->InsertData('mlms_notes', $data);
    $sec_nm = $this->api_model->GetData('mlms_days','title',array('id'=>$mod),'','','',1)->title;

    $response['ins_id'] = $notes;
    $response['sec_name'] = $sec_nm;
   return $this->response($response,200);
  }

  function delNote_post()
  {
    $nid = $this->input->post('nid');
    $del = $this->api_model->deleteRecord("mlms_notes", array("nid" => $nid));
    $response['delete'] = $del;
    $response['message'] = $del>0 ? 'delete' : '';
    return $this->response($response);
  }

  function updateNote_post()
  {
    $nid = $this->input->post('nid');
    $newPoints = $this->input->post('newPoints');
    $update = $this->api_model->update("mlms_notes",array("notes" => $newPoints), array("nid" => $nid));
    $response['update'] = $update;
    $response['message'] = $update>0 ? 'updated' : '';
    return $this->response($response);
  }

  function getDisc_post()
  {
     $user_id = $this->input->post('user_id');
    $pro_id = $this->input->post('pro_id');
    // $disc = $this->api_model->GetData("mlms_lesson_queries", "query_id,");
    $discussion = $this->api_model->getDiscussion($user_id, $pro_id);

    foreach ($discussion as $key => $disc) {
        $likes = $this->api_model->getLikes($pro_id, $disc['query_id']);
        // if($disc['query_id'])
        $discussion[$key]['TMago']=$this->get_timeago(strtotime($disc['dateandtime']));

        $discussion[$key]['tot_likes']=count($likes);
        $discussion[$key]['likes']=$likes;

        $replies = $this->api_model->getData('mlms_lesson_answers','user_id,answer,dateandtime',array('query_id'=>$disc['query_id'], 'pid'=>$pro_id),'','','',"");
        $discussion[$key]['replies'] = $replies;
    }
   
    $response['discussion'] = $discussion;
    // $response['replies'] = $replies;
    // $notes = array_merge($notes,$notes,$notes);
   return $this->response($response,200);
  }

  function sendRply_post(){
    $user_id = $this->input->post('user_id');
    $pro_id = $this->input->post('pro_id');
    $txtrply = $this->input->post('txtrply');
    $qid = $this->input->post('qid');
    $lect_id = $this->input->post('lect_id');
    $mod_id = $this->input->post('mod_id');

    // $info = $this->api_model->auth_email($pro_id, $lesson_id);
    $data = array("user_id" => $user_id,
                "pid" => $pro_id,
                "answer" => $txtrply,
                "query_id" => $qid,
                "lesson_id" => $lect_id,
                "mod_id" => $mod_id,
                "dateandtime" => date("Y-m-d H:i:s"));
    $response['ins_id'] = $this->api_model->InsertData("mlms_lesson_answers", $data);
    $response['status'] = "send";
    $response['data'] = $data;

    return $this->response($response,200);
  }

  function getReply_post()
  {

     $user_id = $this->input->post('user_id');
    $pro_id = $this->input->post('pro_id');
    $qid = $this->input->post('qid');
    // $disc = $this->api_model->GetData("mlms_lesson_queries", "query_id,");
    $replies = $this->api_model->getData('mlms_lesson_answers','user_id,answer,dateandtime',array('query_id'=>$qid,'user_id'=>$user_id, 'pid'=>$pro_id),'','','',"");
    // foreach ($discussion as $key => $disc) {
    //     $likes = $this->api_model->getLikes($pro_id, $disc['query_id']);
    //     // if($disc['query_id'])
    //     $discussion[$key]['TMago']=$this->get_timeago(strtotime($disc['dateandtime']));

    //     $discussion[$key]['tot_likes']=count($likes);
    //     $discussion[$key]['likes']=$likes;
    // }
   
    $response['replies'] = $replies;
    // $notes = array_merge($notes,$notes,$notes);
   return $this->response($response,200);
  }

  function addDisc_post()
  {
    
    $Qtitle = $this->input->post('Qtitle');
    $Qdesc = $this->input->post('Qdesc');
    $user_id = $this->input->post('user_id');
    $lesson_id = $this->input->post('selLect');
    $pro_id = $this->input->post('course_id');

    $info = $this->api_model->auth_email($pro_id, $lesson_id);
    $data = array("query_title" => $Qtitle,
                "query_text" => $Qdesc,
                "user_id" => $user_id,
                "lesson_id" => $lesson_id,
                "pro_id" => $pro_id,
                "dateandtime" => date("Y-m-d H:i:s"));
    $response['ins_id'] = $this->api_model->InsertData("mlms_lesson_queries", $data);

    $subject1 = "You have a Query on lecture '".$info->lecture_nm."'";
    $toemail = $info->email;
        $configarr = $this->api_model->getConfig();

        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

        $fromemail=$urldomain;       

        $content = '';
       
        $content .= '<p>Dear '.trim(ucfirst($info->first_name)).',<br />';
         $content .= "<p>
                    You have received new query on lecture '".$info->lecture_nm."' of course '".$info->cname."'</p><br />";
        $content .='The query is:<br /><br />';
        if($Qtitle)
        $content .= '<b>'.$Qtitle.'</b><br />';
        if($Qdesc)
        $content .= $Qdesc.'<br />';
        $data['content'] = $content;
        $message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
        
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail,$configarr[0]['fromname']);
        $this->email->to($info->email);
        $this->email->cc("prshah83@gmail.com");
        // $this->email->cc("jyotisorte4@gmail.com");
        $this->email->subject($subject1);
        $this->email->message($message1);
        
        if($this->email->send())
        {
          $response['status'] = "send";
        }
        else $response['status'] = "fail";

    return $this->response($response,200);

  }

  function getResources_post()
  {
    $pro_id = $this->input->post('pro_id');
    // $disc = $this->api_model->GetData("mlms_lesson_queries", "query_id,");
    $resource = $this->api_model->getResource($pro_id);
  
    $response['resource'] = $resource;
    // $notes = array_merge($notes,$notes,$notes);
   return $this->response($response,200);
  }

  function settlement_post(){
    $auth_id = $this->input->post('auth_id');
    if($auth_id)
    {
        $con1 = array("user_id " => $auth_id);
        $payouts = $this->api_model->GetData('mlms_payout','total_amount,paid_amount,balance_amount',$con1,'','','',1);
        
        $pay_history = $this->api_model->GetData('mlms_payout_log',"paid_date,paid_amount,pay_mode,memo",$con1);
    
        $paying_amount = $this->api_model->GetData('mlms_offline_payment','sum(amount) as offline_payment',
            array("reseller_id " => $auth_id, "status" => "Pending"),'','','',1)->offline_payment;

        $response['payouts'] = $payouts;
        $response['paying_amount'] = $paying_amount ? $paying_amount : '0.00';
        $response['pay_history'] = $pay_history;


          return $this->response($response,200);
    }
  }

  function getEnrollStud_post(){
    $pid = $this->input->post('pro_id');
    if($pid){
        $stud = $this->api_model->getEnrolledUserList($pid);
        $days = $this->api_model->getlistDays($pid);
        $Lecture_list = array();

            if($days)
            {
            foreach ($stud as $key => $studs) {
                $lecture_ids =array();
                $complated_lecture_ids = array();
                $my_lesson_total = 0;
                $my_viewed_lesson_total = 0;
                $bar_percentage = 0;
              foreach ($days as $day)
              {
                
                  $lessons = $this->api_model->getLessonNew($day->id);
                  $my_lesson_total += count($lessons);
                  foreach ($lessons as $lesson)
                  { if($lesson->id)
                    {
                      array_push($lecture_ids,$lesson->id);
                    }                    
                    
                    $lesson_viewed = $this->api_model->getCompletedLesson2($lesson->id,$studs['user_id'],$pid);
                        if(!empty($lesson_viewed))
                        {  
                            // echo "$day->id : " . $lesson->id."<br>";
                          array_push($complated_lecture_ids,$lesson->id);
                          $my_viewed_lesson_total++;
                        }
                  }

                  if($key == 0){
                    $day_list = array_merge((array)$day, array("lectures" => $lessons));
                    $Lecture_list = array_merge((array)$Lecture_list, array($day_list));
                  }
              }
              // echo "******<br><br>";
              if($my_lesson_total!=0)
                { 
                  $bar_percentage = $my_viewed_lesson_total * 100/ $my_lesson_total;
                }
                $stud[$key]['bar_percentage'] = number_format($bar_percentage,2,".","");
                $lesson_viewed_arrary = (array)$this->api_model->getCompletedList($studs['user_id'],$pid);
                if(isset($lesson_viewed_arrary['mark_as_completed']))
                {
                    $mark = explode('||',  $lesson_viewed_arrary['mark_as_completed']);
                    $mark = str_replace('|', '', $mark);
                }
                else $mark = array();
                if(isset($lesson_viewed_arrary['viewed']))
                {
                    $viewed = explode("||", $lesson_viewed_arrary['viewed']);
                    $viewed = str_replace('|', '', $viewed);
                }
                else $viewed = array();
                // $stud[$key]['lesson_viewed_arrary'] = $lesson_viewed_arrary;
                $arr_1 = array_diff($viewed, $mark);
                // $stud[$key]['viewed'] = $viewed;
                $arr_2 = array_diff($mark, $viewed);
                // $stud[$key]['mark'] = $mark;
                $stud[$key]['mark'] = $mark;
                $stud[$key]['viewed'] = $arr_1;


            }
        }
        $response['complated_lecture_ids'] = $complated_lecture_ids;
        $response['stud'] = $stud;
         $response["days"] = $Lecture_list;

               
        return $this->response($response,200);
    }
  }

  function sales_post()
  {
    $auth_id = $this->input->post('auth_id');

    $getdata = $this->api_model->getData('mlms_users','referral_qr,referral_code,group_id',array('id'=>$auth_id),'','','',1);
    $get_comm = $this->api_model->getData('mlms_assessment','assessment,ass_type',array('user_id'=>$auth_id),'','','',1);
    $response['link'] = base_url()."category/courses?ref=".$getdata->referral_code;
    if($getdata->referral_qr)
    $response['referral_qr'] = base_url()."public/uploads/resellers_QR/".$getdata->referral_qr;
    else $response['referral_qr'] = "";

    if($getdata->group_id=='5')
    {
        // $totalref_data = $this->api_model->get_salesorders($getdata->referral_code);

        $ref_data = $this->api_model->get_salesorders($getdata->referral_code);
        $success_count = $this->api_model->count_Orders($getdata->referral_code,'SUCCESS');
        
    }
    else if($getdata->group_id=='2'){
        // $totalref_data = $this->api_model->get_Torders('mu.id ="'.$auth_id.'" OR referred_code = "'.$getdata->referral_code.'"');

         $ref_data = $this->api_model->get_Torders('mu.id ="'.$auth_id.'" OR referred_code = "'.$getdata->referral_code.'"');
                 $success_count = $this->api_model->count_Orders($getdata->referral_code,'SUCCESS');

        $success_count = $this->api_model->count_TOrders('mo.referred_code ="'.$getdata->referral_code.'" AND mo.status ="SUCCESS" OR mu.id ="'.$auth_id.'" AND mo.status ="SUCCESS"', $getdata->referral_code, $auth_id);
    }
    $ref_data = $ref_data;
    foreach ($ref_data as $key => $ref) {
        if($ref->status=="SUCCESS"){
            $get_comm = (array)$this->api_model->getData('mlms_commission_log','commission,comm_percent',array('reseller_id' =>$auth_id,'order_id' =>$ref->id),'','','',1,'');
            if($get_comm){
            $comm = $get_comm['commission'];
            if($comm!=0)
              $com_per = " (@".$get_comm['comm_percent']."%)";
            else
              $com_per = "";
            $ref_data[$key]->commission = number_format($comm,2).$com_per;
            }
            else{
            $ref_data[$key]->commission = ' 0.00';
          }
          }
          else{
            $ref_data[$key]->commission = ' 0.00';
          }

           if(!empty($ref->referred_code)){
            if($getdata->referral_code==$ref->referred_code)
                $ref_data[$key]->ref_by = "Self";
            else $ref_data[$key]->ref_by = "Others";
        } else $ref_data[$key]->ref_by = "Self";
    }

    $response['success_count'] = $success_count;
    $response['ref_data'] = $ref_data;
        return $this->response($response,200);
  }

public function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'Just Now';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
} 

  public function course_post()
  {
    $id = $this->input->post('id');
    $user_id = @$this->input->post('user_id') ? @$this->input->post('user_id') : "";
    if($id){
        $course = $this->api_model->getCourse_detail($id);
        if($course){
          $img = $course->image ? $course->image : "no_images_course.png";
        $course->image = "https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/".$img;

          // $rem_html = strip_tags($course->description);
        //       $rem_spaces = preg_replace("/\s+/", " ", $rem_html);
        //       $rem_white = preg_replace('/\s+/', ' ', $rem_spaces);
        //       $rem_special_chars = preg_replace("/&#?[a-z0-9]+;/i"," ",$rem_white);
                       
        //       $desc = str_replace('         ',' ',$rem_special_chars);
        //       $course->description = $desc;

              if($course->preview)
              {
                 $path = $course->preview;
                 $arr = explode("/", $path);
                 if(sizeof($arr)>2)
                  $course->preview = $arr[3];
                else $course->preview = "";

                 // https://vimeo.com/318214259
           // $video_src = '';
           // if(strpos($path, 'youtu') > 0){
                       
           //         $video_src1 = str_replace("youtu.be", "youtube.com/embed/", $path);
           //         $course->preview = str_replace(".com/watch?v=", "", $video_src1);
           // }
           // else if(strpos($path, 'vimeo') > 0)
           //  {
           //         $course->preview = str_replace("vimeo.com/", "player.vimeo.com/video/", $path);
           //  } 
              }
              else{
                $course->preview="";
              }

              if( !empty($course->author)){
              
                    
               
              $info = $this->api_model->getTeacherInfo($course->author);

              $rem_html = strip_tags($info->prof_info);
                  $rem_spaces = preg_replace("/\s+/", " ", $rem_html);
                  $rem_white = preg_replace('/\s+/', ' ', $rem_spaces);
                  $rem_special_chars = preg_replace("/&#?[a-z0-9]+;/i"," ",$rem_white);
                           
                  $desc = str_replace('         ',' ',$rem_special_chars);
                  $info->prof_info = $desc;
                  
                  $info->images = "https://myonlineshiksha.com/public/uploads/users/img/".$info->images;
                  $no_stud = $this->api_model->getEnrollstudents($course->author);
                  $rates = $this->api_model->getInstRating($course->author);
                  $courses = $this->api_model->getUserCourses($course->author);
                  $ids = '';
                  foreach ($courses as $course2) {
                    $ids .= $course2->id.',';
                  }
                  $tot_courses = count($courses);
                  // $tot_courses = $this->api_model->getUserCoursecount($teacher_info->id);

            
            $response = array();
            $response['data'] = $info;
            $response['courses'] = $ids;
            $response['no_stud'] = $no_stud;
            $response['tot_courses'] = $tot_courses;
            $response['rates'] = $rates;

            if($tot_courses>0){
              $str = str_split($rates/count($courses), 3);
                  $response['avarage_rate'] = $str[0];
              } else $response['avarage_rate'] = 0;

            
                                  // $course->author = $this->api_model->getTeacherInfoForRest($course->author);

              }

        $Enroll_students = $this->api_model->getEnrolledUser($id);
// $reviews = $CI->program_model->getListReview($programs->id,0);

        $reviews = $this->api_model->getAllReview($id);
        // print_r($reviews);
        $count_reviews = count($reviews);
        $reviews_info = array();
              $rcount = 0;
               $rate_arr = array();
               $rate_bar = array();
               $i=0;
               $one = 0; $two = 0; $three = 0; $four = 0; $five = 0;

            foreach ($reviews as $review) {
              $imgpath = "https://myonlineshiksha.com/public/uploads/users/img/";
              $img = $review->images ? $imgpath.$review->images : $imgpath."default.jpg";

            $reviews_info[$i] = array_merge(array("title"=>$review->title,"description"=>$review->description, "review_rate"=>$review->review_rate,"u_name"=>$review->first_name." ".$review->last_name, "time"=>$this->get_timeago(strtotime($review->review_date)), "u_img"=> $img));
            $i++;
            switch ($review->review_rate) {
              case 1:
                $one++;
                break;
              case 2:
                $two++;
                break;
              case 3:
                $three++;
                break;
              case 4:
                $four++;
                break;
              case 5:
                $five++;
                break;
              
            }
            
              // $review[0][''] get_timeago(strtotime($rev->review_date));
              $rcount = $rcount + $review->review_rate;   
              array_push($rate_arr, $review->review_rate);  
            }
           
          $vals = array_count_values($rate_arr);

          if(in_array('5', $rate_arr)){
                   // $Rpercent = round(($vals[5] / $Enroll_students)*100);
                   $Rpercent = round((100/$count_reviews) * $five);
                   array_push($rate_bar, $Rpercent);
                   } else{ array_push($rate_bar, 0); }

                 if(in_array('4', $rate_arr)){
                  $Rpercent = round((100/$count_reviews) * $four);

                   // $Rpercent = round(($vals[4] / $Enroll_students)*100);
                   array_push($rate_bar, $Rpercent);
                   } else{ array_push($rate_bar, 0); }

                 if(in_array('3', $rate_arr)){
                  $Rpercent = round((100/$count_reviews) * $three);
                   // $Rpercent = round(($vals[3] / $Enroll_students)*100);
                   array_push($rate_bar, $Rpercent);
                   } else{ array_push($rate_bar, 0); }

                if(in_array('2', $rate_arr)){
                  $Rpercent = round((100/$count_reviews) * $two);
                   // $Rpercent = round(($vals[2] / $Enroll_students)*100);
                   array_push($rate_bar, $Rpercent);
                   } else{ array_push($rate_bar, 0); }

                if(in_array('1', $rate_arr)){
                  $Rpercent = round((100/$count_reviews) * $one);
                   // $Rpercent = round(($vals[1] / $Enroll_students)*100);
                   array_push($rate_bar, $Rpercent);
                   } else{ array_push($rate_bar, 0); }


             $avgreview = $this->api_model->getAvgReview($id); 
          $str1 = str_split($avgreview->avg_review, 3);
                       
                $star_rate = $str1[0];

            $tot_hr = $this->api_model->countallDuration($id); 
            $totLect = $this->api_model->countalllecture($id);

            if(intval($course->demoprice) > 0 && intval($course->fixedrate) > 0){
                $offer_amt = $course->demoprice - $course->fixedrate;
                // echo $offer_amt;
                $str = str_split((($offer_amt/$course->demoprice)*100), 5);
                    $per_off = round((intval($course->demoprice) > 0 ? $str[0] : '100'));

               } 
               else if(intval($course->demoprice) > 0 && intval($course->fixedrate) <= 0)
               {
                 $offer_amt = $course->demoprice - $course->fixedrate;
                // echo $offer_amt;
                $str = str_split((($offer_amt/$course->demoprice)*100), 5);
                    $per_off = round((intval($course->demoprice) > 0 ? $str[0] : '100'));

               }
               else{
                  $per_off= '';
               }
            //    $ptn = $course->learn_points;
             // $points = explode('* ', trim($ptn, '* '));
               $course->learn_points = str_replace("              ", ' ', $course->learn_points);

               $enrolled = 0;
               $wishType = 0;
               if($user_id)
               {
                  $where = array('userid' => intval($user_id), 'course_id' =>  intval($id));
                  $chkBuyCourse = $this->api_model->getBuyCourses($where);
                  if($chkBuyCourse > 0)
                    $enrolled = 1;
                  $where = array('user_id' => intval($user_id), 'program_id' =>  intval($id));
                  $chkWish = $this->api_model->chkUserWish($where);
                  $wishType = 0;
                  if(count($chkWish) >0)
                  {
                    $wishType = $chkWish->type;
                  }

               }
               $getCourse = array_merge((array)$course, array("enroll_stud"=>$Enroll_students,"per_off"=>$per_off.'%', "star_rate" => $star_rate, "reviews" => $rcount, "rate_bar" => $rate_bar ,"tot_hr"=>round($tot_hr), "totLect"=> $totLect, "author" => $response, "enrolled" => $enrolled, "wishType" => $wishType, "reviews_info" => $reviews_info));
        
        $errors['message'] = "success";

        $errors['error'] = false;
        return $this->response($getCourse,200);
      }
      else{
        $errors['message'] = "ID is invalid!";

        $errors['error'] = true;

        return $this->response($errors,205);
      }
    }
    else{
      $errors['message'] = "Id not found";

      $errors['error'] = true;

      return $this->response($errors,205);
    }
    
    return $this->response($response);
  }

  public function LectureList_post()
  {
    $lesson_viewed2 = array();
    $id = $this->input->post('id');
    $user_id = $this->input->post('user_id') ? $this->input->post('user_id') :"";
    if($id)
    {
      if($user_id){
            $lesson_viewed2 = $this->api_model->getViewLesson2($user_id, $id);
            if($lesson_viewed2)
            {
              $mark_comp = explode("|", $lesson_viewed2[0]->mark_as_completed);
              $viewed_arr = explode("|", $lesson_viewed2[0]->lesson_id);
            }
          }

      $course_info = $this->api_model->course_info($id);
      // print_r($course_info);
       $days = $this->api_model->getlistDays($id);
                $Lecture_list = array();
                foreach ($days as $day) {
                  $marked = 0;
                  $lessons = $this->api_model->getLessonNew($day->id);
                  
                    $i =0;
                      foreach ($lessons as $lesson) {
                        if($lesson->lecture_content)
                        {
                            
                            $str = " \n               \n                <select class=\"form-control\" name=\"Alignment\" onchange=\"setAlign(this)\">                 \n                 <option value=\"Left\">Left</option>\n                 <option value=\"Center\">Center</option> \n                 <option value=\"Right\">Right</option> \n               </select>\n\n\n               ";

                            $cont = str_replace($str, "", $lesson->lecture_content);
                            $str2 = " \n                <a class=\"btn mock\" style=\"\" data-toggle=\"modal\" href=\"#\" onclick=\"openmyModalyoutube(this.id);\" id=\"a_2\">Click Here To Add / edit Videos</a>\n              ";
                            $cont = str_replace($str2, "", $cont);
                            $str3 = "<div class=\"preview\"> \n                 <i class=\"sprite_old text\"></i> \n                <div class=\"element-desc\">Paragraph</div> \n               </div>\n                ";
                                                        $cont = str_replace($str3, "", $cont);
                            $str4 = "\n\n              <div class=\"preview\"> \n              <i class=\"sprite_old video\"></i> \n                <div class=\"element-desc\">Videos</div> \n              </div> \n\n";
                            $cont = str_replace($str4, "", $cont);
                            $lesson->lecture_content = $cont;

                        }
                        // $lesson_stat = $this->api_model->lectStatistic($user_id, $id, $day->id, $lesson->id);
                        $lesson->statistic =  "0.55";
                        if($lesson_viewed2)
                        {
                        // array("marked"=>$marked, "viewed"=>$viewed)
                        if(in_array($lesson->id, $mark_comp))
                          $marked = 2;
                        else if(in_array($lesson->id, $viewed_arr))
                          $marked = 1;
                        else $marked = 0;     // 0-not, 1-viewed, 2-marked
                       
                        $lesson->status = $marked;
                        // $i++;
                        }
                        else $lesson->status = 0;
                    }
                  // $lessons = array_merge((array)$lessons, array("marked"=>$marked, "viewed"=>$viewed));
                  $day_list = array_merge((array)$day, array("lectures" => $lessons));
                  $Lecture_list = array_merge((array)$Lecture_list, array($day_list));
                }
                       // echo $this->db->last_query();

                // $response['viewed'] = $lesson_viewed2;
            $response["course_info"] = array($course_info);
            $response["days"] = $Lecture_list;
            $response['message'] = "success";
      $response['error'] = false;

      return $this->response($response,200);
    }
    else{
      $errors['message'] = "Id not found";

      $errors['error'] = true;

      return $this->response($errors,205);
    }
    
  }

  public function lecStatistic_post()
    {
      $user_id    = $_POST['user_id'];
      $program_id = $_POST['program_id'];
      $lesson_id  = $_POST['lesson_id']; 
      $day_id     = $_POST['day_id'];
      $data = array(
        'spend_time' => $_POST['sptime'],
        'video_progress' => $_POST['percent'],
        'tot_duration' => $_POST['duration'],
        'date_last_visit' => date("Y-m-d")
      );

      $update = $this->api_model->insertLecStatistic($data,$user_id,$program_id,$lesson_id,$day_id);
      $response['message'] = "success";
      $response['error'] = false;
      return $this->response($response,200);
    }
  
  public function catHasCourses_post()
  {
    $categories = $this->api_model->catHasCourses('',10);
    return $this->response($categories,200);
  }

  public function categoryList_post()
  {
    $limit = @$_POST['limit'] ? @$_POST['limit'] : '';
    $fix = @$_POST['fix'] ? @$_POST['fix'] : NULL;
    if($fix)
      $cat_ids = array(50,52,53,54,56,101,193,29,63,174,194,197,175,124,32);
    else $cat_ids = array();
//         $cat_ids = array(50,52,53,54,56,101,193,29,63,174,194,197,175,124,32);

    $categories = $this->api_model->getCategoryForRest('',$limit,$cat_ids);
    // foreach ($categories as $key => $value) {
                
   //        // $categories[$key]['image'] = 'https://myonlineshiksha.com/public/uploads/pcategories/img/thumb_232_216/'.$categories[$key]['image'];
                
           
   //      }
    return $this->response($categories,200);
  }

  public function enroll_post()
  {
    // $error = array();
    // $response = array();
    $user_id = $this->input->post('user_id');
    $course_id = $this->input->post('course_id');

    $isselected = 0;
    if (!$course_id || !$user_id)
    {
      $errors['message'] = "Invalid ID";
      $errors['error'] = true;
    }
    else
    { 
      $user = $this->api_model->getUserInfo($user_id);
      $result = $this->api_model->getCourseProperty($course_id);

      if($user && $result)
      {

      $course_name = $result->name;
      $author = $result->author;

      $coursename = strtolower($course_name);     
      $coursename = trim(str_replace(' ', '-', $coursename));
      $coursename = preg_replace('/[^A-Za-z0-9\-]/', '', $coursename);

            $chb_free_courses = (isset($result->chb_free_courses)) ? $result->chb_free_courses : '';
        $step_access_courses = (isset($result->step_access_courses)) ? $result->step_access_courses : '';
          $selected_course = (isset($result->selected_course)) ? $result->selected_course : '';
        $buy_date = date("Y-m-d H:i:s");
        // echo $buy_date; exit('jyoti');
        $where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id));
      $adresult = $this->api_model->getBuyCourses($where);
      if($adresult == 0 )
      {
          $data = "";

          if($chb_free_courses == 0 && $step_access_courses ==1)
          {           

            $data = array(
                  'userid' => $user_id,
                  'order_id' => 0,
                  'course_id' => $course_id,
                  'price' => 0,
                  'buy_date' => $buy_date,                  
                  'plan_id' => 0,
                  'email_send' => 1
                  );

            $data_activity = array(
                'activity' => $user->name.' enrolled '.$course_name,
                'sender_id' => $user_id ,
                'receiver_id' => $author ,
                'activity_type' => 'enroll',
                'activity_date' => date("Y-m-d"),
                'visit_id' => '0'
                  );          
            

          }
          else if($selected_course)
          {
            $selected_course_array = explode('|',$selected_course);
            $selected_to_count = count($selected_course_array);
            for($i=0; $i<$selected_to_count -1; $i++)
            {


              $where = array('userid' => intval($user_id), 'course_id' =>  intval($selected_course_array[$i]));
              $adresult = $this->api_model->getBuyCourses($where);
              
              if($adresult)
              {
                $isselected = 1;
              }

            }


            if($isselected = 1)
            {

              $data = array(
                  'userid' => $user_id,
                  'order_id' => 0,
                  'course_id' => $course_id,
                  'price' => 0,
                  'buy_date' => $buy_date,                  
                  'plan_id' => 0,
                  'email_send' => 1
                  );

            $data_activity = array(
                'activity' => $user_info->name.' enrolled '.$course_name,
                'sender_id' => $user_id ,
                'receiver_id' => $author ,
                'activity_type' => 'enroll',
                'activity_date' => date("Y-m-d"),
                'visit_id' => '0'
                  );
            }



          }
      // ====================================
               if($data)
               {

        $this->api_model->freeEnrollment($data);

        $this->api_model->UserEnrollActivity($data_activity);

          if($user->is_student == 0)
          {
             
            $this->api_model->updateStudent($user_id);
          }
          $remove_cart = $this->api_model->remove_cart($user_id, $course_id);

        
         $configarr = $this->api_model->getConfig();
        
        $authordetail = $this->api_model->getTeacherInfo($result->author);
        
        
        // $urldomain = base_url();
        // $urldomain = str_replace('http://', '', $urldomain);
        // $urldomain = str_replace('/', '', $urldomain);
        // $urldomain = str_replace('www.', '', $urldomain);
        if($configarr[0]['fromemail'])  
            $urldomain = $configarr[0]['fromemail']; 
            else $urldomain = 'noreply@'.$this->config->item('urldomain');
        //1. mail to user 
        $subject1 = trim(ucfirst($user->name)).' has enrolled to '.$result->name;
        $toemail1 =  $user->email;
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($user->name)).' has enrolled to '.$result->name.'</p>';
        $content .= '<p>Hello '.trim(ucfirst($user->name)).',<br /><br />';
        $content .= " You have Successfully enrolled in '".$result->name."'! <br /><br />";
        $content .= " You can now find '".$result->name."'  under the menu 'My Courses' in  <a style='color: #55c5eb;' href =".base_url().">".base_url()."</a>  once you log in.<br /><br />";
        $content .=' If you need help or have any questions, please contact us.<br />';
        
        $data['content'] = $content; 
    $data['fromemail'] = $urldomain;
        $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
        $fromemail1 = $urldomain;    //$configarr[0]['fromemail'];// admin mail
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail1, $configarr[0]['fromname']);
        $this->email->subject($subject1);
        $this->email->to($toemail1);
        $this->email->message($message1);
        $this->email->send(); 


        //2. mail to teacher
        $subject2 = trim(ucfirst($user->name)).' has enrolled to '.$result->name;
        $toemail2 = $authordetail->email;
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($user->name)).' has enrolled to '.$result->name.'</p>';
        $content .= '<p>Hello '.trim(ucfirst($authordetail->author_name)).',<br /><br />';
        $content .=  trim(ucfirst($user->name))." has Successfully enrolled in '".$result->name."'! <br /><br />";
        $content .='If you need help or have any questions, please contact us.<br />';
        
        $data['content'] = $content; 
    $data['fromemail'] = $urldomain;
        $message2 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
        $fromemail2 = $urldomain;        //$configarr[0]['fromemail'];// admin mail
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail2, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject2);
        $this->email->to($toemail2);
        $this->email->message($message2);
        $this->email->send(); 
      
      
         $admininfo2 = $this->api_model->getadminInfo(4);
        //3. Mail To admin 
        $subject3 = trim(ucfirst($user->name)).' has enrolled to '.$result->name;
        $toemail3 = $admininfo2->email;// admin mail
        $content = '';  
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($user->name)).' has enrolled to '.$result->name.'</p>';
        $content .= '<p>Hello '.trim(ucfirst($admininfo2->first_name)).',<br /><br />';
        $content .=  trim(ucfirst($user->name))." has Successfully enrolled in '".$result->name."'!<br /><br />";
        $content .='If you need help or have any questions, please contact us.<br />';
        
        $data['content'] = $content; 
    $data['fromemail'] = $urldomain;
        $message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
        $fromemail3 = $urldomain;    //$configarr[0]['fromemail'];// admin mail
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject3);
        $this->email->to($toemail3);
        $this->email->message($message3);
        $this->email->send(); 
        

        $response['message'] = "success";
        $response['error'] = false;
       }

          
      }
      else
      {
        $errors['message'] = "Course has already enrolled!";
        $errors['error'] = true;
      }
        
        }
        else{
          $errors['message'] = "Invalid Course";
        $errors['error'] = true;
        }
    

      }

        if(@$errors)
          return $this->response($errors,205);
        elseif(@$response)
          return $this->response($response,200);

  }

  function demo_post()
  {
    // $aff = $this->api_model->testQuery();
    // echo $aff;
    // print_r($aff);
//     $homepage = file_get_contents('https://myonlineshiksha.com/public/uploads/tmp_video/file_example_MP4_480_1_5MG.mp4');
// print_r($homepage);
//     if(is_file("https://myonlineshiksha.com/public/uploads/tmp_video/file_example_MP4_480_1_5MG.mp4"))
//         echo "yes";
//     else echo "no";
      // echo getcwd();

    // phpinfo();
    // echo "basic" . base64_encode("2d00d7135bf8a0d597cafc7c2fdb4ed1570bb667" .":" ."550RPr5rNuBFTlvqBuUzIFRFdj3iIzqqh0OIlbLhx0FXRM/39KV374SgPE+x60sW86lbnUw9QS8/NJvZtxmHgSS8OIQqtftC5ONGe9/798PZGjV+tDJwkVIjQJvsKaB");
    // echo date('Y-m-d h:i:s');
    // echo date('Y-m-d h:i:s', strtotime('+ 10 days'));
    // $email_id = $_POST['email'];
    // $email_exist = $this->api_model->getData('mlms_users','*',array('email'=>$email_id), '','','','','');
    // print_r($email_exist);
    // echo md5("VeerIT123!");
    // echo "<br><br>";
    // echo md5("123456");
  }


  public function login_post()
  {

    $errors = array();

    if($_POST){

      $email = $_POST['email'];
      $auth = $this->api_model->checkUserLogin($email);

      if(is_object($auth)){

        $response = array();

        $where = array('userid' => intval($auth->id));
      $chkBuyCourse = $this->api_model->getBuyCourses($where);
      if($chkBuyCourse > 0)
        $enrolled = 1;
      else
        $enrolled = 0;
        $auth = (array)$auth;
        $auth['enrolled'] = $enrolled;

        $response['user'] = $auth;

        $response['error'] = false;
        $response['message'] = "Logged in successfully...";
        
        // echo json_encode($response);

        return $this->response($response,202);

      }else if(is_array($auth) && empty($auth)){
        $errors['message'] = "Invalid credential! Enter valid email & password.";

        $errors['error'] = true;
        $errors['user'] = array();

        return $this->response($errors,205);

      }
      
      // if($auth){
      //  echo "User Login successfully!";
      // }  
    }
    else{

      $errors['message'] = "Please enter your details.";

      $errors['error'] = true;
      $errors['user'] = array();

      return $this->response($errors,205);
      
    }
  }

   

  public function updateProfile_post()
  {
    
     $id = $_POST['id'];
     $firstname = trim($_POST['firstname']);
     $email = @$_POST['email'] ? strtolower(trim(@$_POST['email'])) : NULL;
     $mobile = strtolower(trim($_POST['mob']));
     $password = @$_POST['password'] ? @$_POST['password'] : NULL;
     if($id || $fname || $mobile)
    {
        $data = array(
            'mobile'=> $mobile,
            'username' => $firstname,
            'first_name' => $firstname,
            'last_name' => ''
        );
        if($email)
            $data['email'] = $email;
        if($password)
            $data['password'] = md5($password);
        if($_POST['myBitmap']){

             $old = $_POST['old_img'];
                $image = rand(500,100000);
                $fileName = 'public/uploads/users/img/'.$image.'_'.date('Y-m-d').'.jpg';
                    file_put_contents($fileName,base64_decode($_POST['myBitmap']));
                $data['images'] = $image.'_'.date('Y-m-d').'.jpg';
                unlink('public/uploads/users/img/'.$old);
                // $response['status'] = $update;
                // $response['image'] = $image;
                // return $this->response($response,200);
        }
        else $data['images'] = $_POST['old_img'];
        $where = array('id'=>$id);

        $update = $this->api_model->update("mlms_users", $data, $where);
                $data['id'] = $id;
        $data['email'] = $email;
        $response['user'] = $data;
        $response['message'] =  "Updated successfully";
        $response['error'] = false;
              return $this->response($response,200);


    }
    else{
        $response['message'][] =  "Please fill proper data...";
      $response['error'] = true;
    return $this->response($response,205);

    }
   
  }

  public function signup_post()
  {
    

    $data['message'] = array();
    $data['error'] = false;
  
    if($_POST){
    if(isset($_POST['firstname'])){
      $firstname = $_POST['firstname'];
    }else{
      $firstname ='';
    }


    if(isset($_POST['lastname'])){
      $lastname = $_POST['lastname'];
    }else{
      $lastname ='';
    }


    if(isset($_POST['email'])){
      $tmail = $_POST['email'];
    }else{
      $tmail = null;
    }

    if(isset($_POST['mob'])){
      $mob = $_POST['mob'];
    }else{
      $mob ='';
    }

    if(isset($_POST['password'])){
      $password = $_POST['password'];
    }else{
      $password ='';
    }

    $fname = trim($firstname);
    $lname = trim($lastname);
    $email = strtolower(trim($tmail));
    $mob = strtolower(trim($mob));
    //$email = trim($_POST['email']);
    $password = trim($password);
    // $c_password = trim($password_confirm);

     // || $c_password == ''

    $lenpass =strlen($password);

    if($fname == '' || $mob== '' || $password == '')
    {
      
      $data['message'][] =  "Please fill proper data...";
      $data['error'] = true;
    }

    // if($this->api_model->email_exists($email))
    // {
        
    //     $data['message'][] = "Email Already Exist.";
        
    //     $data['error'] = true;
    // }

    if($this->api_model->email_exists($mob))
    {
        
        $data['message'][] = "Mobile Number Already Exist.";
        
        $data['error'] = true;
    }


    if($lenpass < 6)
    {
        
        $data['message'][] = "Password atleast 6 digits";
        
        $data['error'] = true;
        $data['lenpass'] = $lenpass;
        
    }

    //  if($password != $c_password)
    // {
      
    //  $data['message'][] = 'Password and confirm password are not matched..';
      
    //  $data['error'] = true;
    // }


    if($data['error'] == false)
    {
    
      $activationcode = $this->getActivationCode();
      $activationcode = md5($activationcode);
      $data = array(
            'username'    =>  $email,
            'email'     =>  $email,
            'mobile'    =>  $mob,
            'first_name'  =>  $fname,
            'last_name'   =>  $lname,
                'active'      =>  '1',
        'is_student'  =>  '1',//one is for yes
        'is_instructor' =>  '0',//zero is for no
                'created_at'  =>  date('Y-m-d H:i:s'),
                'password'    =>  md5($password),
                'activation_code'=>  $activationcode,
                'group_id'    =>  '1',
                'webstatus'   =>  ''
      );

      $user = array(
            'username'    =>  $email,
            'email'     =>  $email,
            'mobile'    =>  $mob,
            'first_name'  =>  $fname,
            'last_name'   =>  $lname,
            'images'        =>  'https://myonlineshiksha.com/public/uploads/users/img/default.jpg',
                'active'      =>  '1',
        'is_student'  =>  '1',//one is for yes
        'is_instructor' =>  '0',//zero is for no
                'created_at'  =>  date('Y-m-d H:i:s'),
                'password'    =>  md5($password),
                'activation_code'=>  $activationcode,
                'group_id'    =>  '1',
                'webstatus'   =>  ''
      );
      $usergroups = '1';
      $insertid = $this->api_model->insertUser($data);
         $user['id']  =  $insertid;
      if($insertid > 1)
      {
        // $user_id = $this->api_model->maxuserid();
        $group_data = array(
          'user_id'   =>  $insertid,
          'group_id'      =>  $usergroups
        );
        $this->api_model->insertUserGroup($group_data);
        $data ='';
        $data['error'] = false;

        $data['message'] = "Registered successfully! We send you an email please check and verify your email.";
        $data['status'] = "success";

        $data['user'] = $user;
//email send

        $configarr = $this->api_model->getConfig();
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
    $content .= '<form action="http://hastrk.com/serve?action=click&publisher_id=1&site_id=2" target="_blank">
        <input type="submit" value="Download" />
    </form>';

    $content .= '<form action="http://schemas.android.com/apk/res/android/com.example.veerit.myapplication/.well-known/assetlinks.json.">';
    $content .='<input type="hidden" name="activation_code" value='.$activationcode.'>
        <input type="submit" value="Open App" /></form>';


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
    if($this->email->send())
    {
      $maildetails = array('emailsent' => 1, );
      $this->login_model->emailsent($insertid,$maildetails);
    }
             
      $admininfo = $this->api_model->getadminInfo(4);
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
      $content .= trim(ucfirst($fname)).' '.trim(ucfirst($lname)).' has register in your Academy.<br />';
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
      
      $data['email_status'] = "success";  

//end email       
    }
      

      // echo $insertid;

      
      
      return $this->response($data,201);

    }else{
      // $data['data'] = $this->input->post();
      return $this->response($data,406);      
    }

    
    
  }
  else{
      $data['message'][] = "Please enter your details";
      $data['error'] = true;
      return $this->response($data,205);
    
  }   
    /*echo json_encode($data);*/


}
function singleupload_post()
{
    $target_dir = "public/uploads";
$target_file_name = $target_dir .basename($_FILES["file"]["name"]);
$response = array();

// Check if image file is a actual image or fake image
if (isset($_FILES["file"])) 
{
   if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_name)) 
   {
     $success = true;
     $message = "Successfully Uploaded";
   }
   else 
   {
      $success = false;
      $message = "Error while uploading";
   }
}
else 
{
      $success = false;
      $message = "Required Field Missing";
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);

}
function multiUpload_post(){
      $target_dir = "public/uploads/test";  
$target_file_name1 = $target_dir .basename($_FILES["file1"]["name"]);  
$target_file_name2 = $target_dir .basename($_FILES["file2"]["name"]);  
$response = array();  
// Check if image file is an actual image or fake image  
if (isset($_FILES["file1"]) && isset($_FILES["file2"]))  
   {  
   if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file_name1)  
   && move_uploaded_file($_FILES["file2"]["tmp_name"], $target_file_name2))  
      {  
         $success = true;  
         $message = "Successfully Uploaded";  
      }  
   else  
      {  
         $success = false;  
         $message = "Error while uploading";  
      }  
   }  
else  
   {  
      $success = false;  
      $message = "Required Field Missing";  
   }  
   $response["success"] = $success;  
   $response["message"] = $message; 
  return $this->response($response,200);
}


function profilePic_post(){

    $response['post'] = $_POST['myBitmap'];
        $old = $_POST['old_img'];
        $email = $_POST['email'];
   
        $image = rand(500,100000);

        // $fileName = $image.'_'.date('Y-m-d').'.jpg';
        $fileName = 'public/uploads/users/img/'.$image.'_'.date('Y-m-d').'.jpg';
                    file_put_contents($fileName,base64_decode($_POST['myBitmap']));

          
         $data = array('image' => $image);
         $where = array('email' => $email);          
        $update = $this->api_model->update("mlms_users", $data, $where);
        if($update)
            unlink('public/uploads/users/img/'.$old);

        $response['status'] = $update;
        $response['image'] = $image;
        return $this->response($response,200);
}

function fbLogin2_post()
  {
    print_r($this->api_model->deleteuser());
    exit("123");
}

  function fbLogin_post()
  {
    $is_exist ="";
    $urldomain =$this->config->item('urldomain');

// $this->input->post('email') = "jyotisorte4@gmail.com";
    if($this->input->post('email')) {
      $email = $this->input->post('email');
    }
    else{
      $email = $this->input->post('id').'@'.$urldomain;
    }
    if(isset($email)&& $email!="")
    { 
      $is_exist = $this->api_model->checkUserLogin($email, "fblogin");
    }
    else{
      $errors['message'] = "Please enter your details.";
      $errors['error'] = true;
        return $this->response($errors,205);
      }

    if($is_exist)
    {
      $password = 'fbuser';
      $logoimage = Null;

        $where = array('userid' => intval($is_exist->id));
      $chkBuyCourse = $this->api_model->getBuyCourses($where);
      if($chkBuyCourse > 0)
        $enrolled = 1;
      else
        $enrolled = 0;
    // $is_exist = (array)$is_exist;
    // $is_exist['enrolled'] = $enrolled;
   
    // array_merge($is_exist, )
        // array_merge((array)$is_exist, array('enrolled' $enrolled));
        // $response['user'] = array('enrolled', $enrolled);

      // $result = $this->api_model->validateforFB($email, $password);
      if($is_exist->first_time_login == '0')//if zero i.e. first time
        {

         $configarr = $this->api_model->getConfig();
            if($configarr[0]['fromemail'])  
                $urldomain = $configarr[0]['fromemail']; 
            else $urldomain = 'noreply@'.$this->config->item('urldomain');
          
          $subject = 'Welcome to '.$configarr[0]['institute_name'];
          $toemail = $email;
          $content = '';
          $content .= '<p>Dear '.trim(ucfirst($is_exist->first_name)).' '.trim(ucfirst($is_exist->last_name)).',<br /><br />';
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
          $fromemail=$urldomain;
          $config['charset'] = 'utf-8';
          $config['mailtype'] = 'html';
          $config['wordwrap'] = TRUE;
          $this->email->initialize($config);
          $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
          $this->email->subject($subject);
          $this->email->to($toemail);
          $this->email->message($message);
          $this->email->send();   
          $data2 = array('first_time_login' => '1');
          $where = array('email' => $email);          
          $this->api_model->update("mlms_users", $data2, $where);            
        }
                $auth = array_merge((array)$is_exist, array('enrolled'=> $enrolled));


        $response['user'] = (array) $auth;
        // $response['is_exist'] = $is_exist;
        $response['fbID'] = $this->input->post('id');
        $response['error'] = false;
        $response['message'] = "Logged in successfully...";
        return $this->response($response,200);

      }
      else
      {
        
        $username = explode(' ',$this->input->post('username'));
        $first_name = $this->input->post('username');
        // $last_name = @$username[1] ? @$username[1] : '';
        $image = "https://graph.facebook.com/".$this->input->post('id')."/picture";
        $content = file_get_contents($image);
            //Store in the filesystem.
        $image = rand(500,100000);
        
        // $fileName = $image.'_'.date('Y-m-d').'.jpg';
        $fileName = 'public/uploads/users/img/'.$image.'_'.date('Y-m-d').'.jpg';
        $fp = fopen($fileName, 'w+');
        fputs($fp, $content);
        fclose($fp);

        $user_data = array(
           // 'username'    =>  $this->input->post('username'),
          'email'     =>  $email,
          'fbemail'   =>  $email,
          'username'    =>  $this->input->post('username'),
          'first_name'  =>  $first_name,
          // 'last_name'   =>  $last_name,
          'active'      =>  '1',
          'is_student'  =>  '1',//one is for yes
          'is_instructor' =>  '0',//zero is for no
          'images'        =>  $image.'_'.date('Y-m-d').".jpg",
          'group_id'    =>  '1'
          );
        $usergroups = '1';

        $insertid = $this->api_model->SaveData("mlms_users", $user_data);
        $user_data['enrolled'] = "0";
          if($insertid > 1){
              $group_data = array(
                'user_id'   =>  $insertid,
                'group_id'      =>  $usergroups
              );
           $this->api_model->SaveData("mlms_users_groups", $group_data);
          }
          $user_data['images'] = $user_data['images'];
        $auth = array_merge((array)$user_data, array('id' => $insertid));

        $response['user'] = (array) $auth;
$response['fbID'] = $this->input->post('id');

        $response['error'] = false;
        $response['message'] = "Logged in successfully...";
        return $this->response($response,200);

      }
      
  }
  
  function activation_post(){
    $data['active_code'] = $this->input->post('activation_code');
    return $this->response($data,201);
  }

  function forgetPass_post()
  {
    $email_id = $this->input->post('email');

        $email_exist = $this->api_model->getData('mlms_users','id,email,first_name',array('email'=>$email_id), '','','',1,'');
        
        if($email_exist)
        {   
            $configarr = $this->api_model->getConfig();
            if($configarr[0]['fromemail'])  
                $urldomain = $configarr[0]['fromemail']; 
            else $urldomain = 'noreply@'.$this->config->item('urldomain');

            $subject = 'Reset your password - '.$configarr[0]['institute_name'];
            $toemail = $email_id;
            $randpassword = $this->createRandomUniquePasswordNo();
            $this->api_model->update('mlms_users', array('lostpw' => $randpassword), array('email'=>$email_id));
            $link = base_url().'users/mlmsreset_password/'.$randpassword;
            $content = '';
            $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Reset your password - '.$configarr[0]['institute_name'].'</p>';
            $content .= 'Hello '.trim(ucfirst($email_exist->first_name)).',<br/><br/>';
            $content .= 'Click on link to reset password<br/><br />';
            $content .= '<a style="color:#55c5eb" href="'.$link.'">'.$link.'</a><br/><br />';
            $content .= 'If you need help or have any questions, please contact us.<br/>';
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
            //$this->email->cc('vikas.gorle@veerit.com');
            $this->email->message($message);
            if($this->email->send())
            {
                $rmsg = "Reset password link has been sent to your email";
                $response['msg'] = $rmsg;
                $response['status'] = '1';
                return $this->response($response,200);
                 
            }
            else
            {
                $rmsg = "Fail to send mail";
                $response['msg'] = $rmsg;
                $response['status'] = '0';
                return $this->response($response,201);
            }
        }
        else
        {
            $rmsg="Email Id not available in the records";
                $response['msg'] = $rmsg;
                $response['status'] = '0';
                return $this->response($response,201);
        }
        
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
            $random_pass *= 10;
            $random_pass += $digits[0];
            array_splice($digits, 0, 1);
        }
        $random_pass = md5($random_pass);
        $Rpass_exist = $this->api_model->getData('mlms_users','id',array('lostpw'=>$random_pass), '','','',1,'');

        if($Rpass_exist)
        {
            $this->createRandomUniquePasswordNo();
        }
        return $random_pass;
    }
   
  function profile_post()
  {
    $user_id = $this->input->post('id');
    if($user_id)
    {
      $info = $this->api_model->getTeacherInfo($user_id);
      $rem_html = strip_tags($info->prof_info);
          $rem_spaces = preg_replace("/\s+/", " ", $rem_html);
          $rem_white = preg_replace('/\s+/', ' ', $rem_spaces);
          $rem_special_chars = preg_replace("/&#?[a-z0-9]+;/i"," ",$rem_white);
                   
          $desc = str_replace('         ',' ',$rem_special_chars);
          $info->prof_info = $desc;
          
          $info->images = "https://myonlineshiksha.com/public/uploads/users/img/thumbs/".$info->images;
      $no_stud = $this->api_model->getEnrollstudents($user_id);
          $rates = $this->api_model->getInstRating($user_id);
          $courses = $this->api_model->getUserCourses($user_id);
          $ids = '';
          foreach ($courses as $course) {
            $ids .= $course->id.',';
          }
          $tot_courses = count($courses);
          // $tot_courses = $this->api_model->getUserCoursecount($teacher_info->id);

    }
    $response = array();
    $response['data'] = $info;
    $response['courses'] = $ids;
    $response['no_stud'] = $no_stud;
    $response['tot_courses'] = $tot_courses;
    $response['rates'] = $rates;

    if($tot_courses>0){
      $str = str_split($rates/count($courses), 3);
          $response['avarage_rate'] = $str[0];
      } else $response['avarage_rate'] = 0;


    return $this->response($response,200);
  }

  public function markcompleted_post()
  {
     $user_id = $_POST['user_id'];
     $lesson_id = $_POST['les'];
     $pid = $_POST['pro'];
     $module_id = $_POST['mod'];
     $read = $_POST['read'];
    if($user_id)
    {
    $response['user_id'] = $user_id;
     $response['pid'] = $pid;
    $lesson_viewed2 = $this->api_model->getViewLesson2($user_id, $pid);

      if(!empty($lesson_viewed2))
      {
        foreach($lesson_viewed2 as $compltData)
        {         
          $marks = '|'.$lesson_id.'|';
          if($read){
              if( strpos($compltData->lesson_id, $marks) !== false )
                $lessonData = str_replace($marks,'',$compltData->lesson_id).$marks;
                else              
                $lessonData = $compltData->lesson_id.$marks;
                
              
              $data = array('lesson_id' => $lessonData);
          }
          else{
              if( strpos($compltData->mark_as_completed, $marks) !== false )
                $lessonData = str_replace($marks,'',$compltData->mark_as_completed);
              else
                $lessonData = $compltData->mark_as_completed.$marks;//if not found then concat two fields
              $data = array('mark_as_completed' => $lessonData);
          }

        }
        
        $this->api_model->updateViewLesson($lesson_id,$user_id,$pid,$module_id,$data);
         $response['status'] = 'updated';
      }
      else
      {
        $lessonData = '|'.$lesson_id.'|';
        if($read)
            $data = array('lesson_id' => $lessonData,'user_id'=>$user_id,'pid'=>$pid);
        else
            $data = array('mark_as_completed' => $lessonData,'user_id'=>$user_id,'pid'=>$pid);

        $this->api_model->InsertViewLesson($lesson_id,$user_id,$pid,$module_id,$data);  
        $response['status'] = 'inserted';
      }
    }
    $response['message'] = "success";
      return $this->response($response,200);
  }

  function getUserEnroll_post()
  {
    $user_id = $this->input->post('user_id');

    $data = $this->api_model->getEnrollCourses($user_id);
    // $sql = $this->db->last_query();
          
          // print_r($data);
         $response = array();
          foreach ($data as $course ) {
            $course['image'] = base_url()."public/uploads/programs/img/thumb_232_216/".$course['image'];
            $auth = $this->api_model->getAuthName($course['author']);

            // $days = $this->api_model->getlistDays($course['pro_id']);
            $my_lesson_total = $this->api_model->getTotlessons($course['pro_id']);
            $lecture_ids =array();
            $complated_lecture_ids = array();
            $my_completed_lesson_total = 0;
            $bar_percentage = 0;
             $my_viewed_lesson_total = 0;
                $lesson_viewed2 = $this->api_model->getViewLesson2($user_id, $course['pro_id']);
            if(!empty($lesson_viewed2))
            {
                 $completed = $lesson_viewed2[0]->mark_as_completed;
                 $viewed = $lesson_viewed2[0]->lesson_id;

                if(empty($completed))
                    $my_completed_lesson_total = 0;
                else{
                    $completed = str_replace("||", "|", $completed);
                    $com = explode("|", $completed);
                    $my_completed_lesson_total = sizeof($com)-2;
                }   
                if(empty($viewed))
                    $my_viewed_lesson_total = 0;
                else{
                    $viewed = str_replace("||", "|", $viewed);
                    $view = explode("|", $viewed);
                    $my_viewed_lesson_total = sizeof($view)-2;
                }
            }

               if($my_lesson_total!=0)
                {
                  $bar_percentage = $my_completed_lesson_total * 100/ $my_lesson_total;
                }
                $bar_percentage = number_format($bar_percentage,2,".","");
                if($bar_percentage > 100)
                    $bar_percentage = "100";

            $info = array_merge((array)$course, (array)$auth, array('progress' => $bar_percentage, 'viewed'=> $my_viewed_lesson_total, 'completed' => $my_completed_lesson_total, 'total_lessons'=> $my_lesson_total));
            array_push($response, $info);
          // ,'sql'=> $sql
        }
         
        return $this->response($response,200);

  }

function discussion_post()
{
  $course_id = $this->input->post("pid");
  $comment = $this->api_model->getLessonQuery($course_id);
  $response['comment'] = $comment;
  return $this->response($response,200);
}

function InstReview_post()
{
  $course_id = $this->input->post("pid");
  $comment = $this->api_model->getListReview($course_id,0);
  $response['revcomment'] = $comment;
  return $this->response($response,200);
}

 /*$teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
                  
          $catid = $CI->category_model->getCatSlugbyId($othercourse->catid);*/

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

function renderStarRating($rating,$maxRating=5) {
    $fullStar = "<li style='display:inline-block' ><i class = 'fa fa-star checked'></i></li>";
    $halfStar = "<li style='display:inline-block' ><i class = 'fa fa-star-half-full checked'></i></li>";
    $emptyStar = "<li style='display:inline-block' ><i class = 'fa fa-star-o '></i></li>";
    $rating = $rating <= $maxRating?$rating:$maxRating;

    $fullStarCount = (int)$rating;
    $halfStarCount = ceil($rating)-$fullStarCount;
    $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

    $html = str_repeat($fullStar,$fullStarCount);
    $html .= str_repeat($halfStar,$halfStarCount);
    $html .= str_repeat($emptyStar,$emptyStarCount);
    $html = '<ul>'.$html.'</ul>';
    return $html;
}


// function inquery_post()
// {
//     $name = $this->input->post('name');
//         $email = $this->input->post('email');
//         $mobile = $this->input->post('mobile');
//         $body = $this->input->post('body');
            

//         if($configarr[0]['fromemail'])  
//         $urldomain = $configarr[0]['fromemail']; 
//         else $urldomain = 'noreply@'.$this->config->item('urldomain');

//                 $fromemail = $urldomain;                

//                 $admin_email = $this->api_model->getadminInfo(4)->email;               

//                 // $configarr = $this->settings_model->getItems();
//                 //$subject1 = 'New Enquiry for '.$configarr[0]['institute_name'];
//                 $subject1 = 'Enuiry received - '.$configarr[0]['institute_name'];
//                 $toemail = $admin_email;
//                 // $toemail = 'jyotisorte4@gmail.com';
//                 $content = '';
//                 $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">
//                     Enuiry received - '.$configarr[0]['institute_name'].'</p>';
//                 $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
//                 $content .='There is a new Enquiry. Here are the details:<br /><br />';
//                 $content .= 'Email : <a style="color:#55c5eb" href="mailto:'.$email.'" target="_blank">'.$email.'</a><br />';
//                 $content .= 'Subject : '.$subject.'<br />';
//                 $content .= 'Message : '.$body.'<br />';
//                 // $content .='<br /><br />';
//                 // $content .='...</p>';
//                 // $content .= $configarr[0]['signature'].'</p>';
//                 $data['content'] = $content; 
//         $data['fromemail'] = $urldomain;
//                 $message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
                
//                 $config['charset'] = 'utf-8';
//                 $config['mailtype'] = 'html';
//                 $config['wordwrap'] = TRUE;
//                 $this->email->initialize($config);
//                 $this->email->from($fromemail,$configarr[0]['fromname']);
//                 $this->email->to($toemail);
//                 $this->email->subject($subject1);
//                 $this->email->message($message1);
                
//                 $this->email->send();
// }




}

?>