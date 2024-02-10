<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{	
  function __construct()	
  {		
      parent::__construct();	
      $this->load->library('tank_auth');		
      $this->load->model('Pagecreator_model');		
      $this->load->model('admin/settings_model');		
      $configarr = $this->settings_model->getItems();		 
      $this->load->model('login_model');  
      // error_reporting(0);
   }	

   function index()	
   {		

   if (!$this->tank_auth->is_logged_in()) 
   {			

   redirect('/auth/login/');		

   } 
   else 
   {			

   $data['user_id']	= $this->tank_auth->get_user_id();			
   $data['username']	= $this->tank_auth->get_username();			
   $data['fullname']	= $this->session->userdata('firstname') . " " . $this->session->userdata('lastname');			
   $this->load->view('welcome', $data);		

   }	
  }	

  function myStaticPage()	
  {		
    $this->load->view('new_template_design/header');	
    $auth = $this->session->userdata('logged_in');
      $currency = $this->settings_model->getItems();
      $currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
      if($currencysign)
      {
         $currency_symbol = $currencysign->sign;
      }
      else
      {
      $currency_symbol = " "; 
      }
    $courses1 = $this->section_data(0);
    $courses2 = $this->section_data(1);
    $courses3 = $this->section_data(2);
    $courses4 = $this->section_data(3);
    $courses5 = $this->section_data(4);
    $courses6 = $this->section_data(5);
    $courses7 = $this->section_data(6);
    $data = array(
      "currency_symbol"   => $currency_symbol,
      "courses1"          => $courses1,
      "courses2"          => $courses2,
      "courses3"          => $courses3,
      "courses4"          => $courses4,
      "courses5"          => $courses5,
      "courses6"          => $courses6,
      "courses7"          => $courses7
    );
    $this->load->view('onlineshiksha/onlineshikshafront',$data);        

  }


  function section_data($ids)
  {
    $section = ["66,68,98,101,75,76,85,86","99,102,197,108,110,155,160,165","100,147,199","189,100,147,199","188,100,147","158,46,47,192,194,216","87,139,173,183,157"];
    $data = $this->Pagecreator_model->getcourse('p.published = 1 and p.trash = 0 and p.id IN('.$section[$ids].')');
    $currency = $this->Crud_model->get_single('mlms_config','id = 1',"currency");
    $currencysign = $this->Crud_model->get_single('mlms_currencies',"currency_name = '".$currency->currency."'","sign");
    if($currencysign){
        $currency_symbol = $currencysign->sign;
    }
    else{
      $currency_symbol = " "; 
    }
    $output = '';
    foreach ($data as $othercourse)
    { 
      if($othercourse->image){
        $image = $othercourse->image;
      }
      else{
        $image = "no_images_course.png";
      }
      $output .= '
      <div class="item-item col-md-3 col-sm-4">
        <a href="'.base_url().'online-courses/'.$othercourse->slug.'">
          <div class="card card1">
            <div class="cardhover">
                <img src="'.base_url().'public/uploads/programs/img/thumb_232_216/'.$image.'" width="100%">';
               $output .= ' </div>
            <h5 class="card_heading2">'.$othercourse->name.'</h5>
            <p class="jonas">'.ucwords($othercourse->first_name.' '.$othercourse->last_name).'</p>';
              $reviews = $this->Pagecreator_model->getAvgReview($othercourse->id);
                $rcount = floatval($reviews->avg_rate);
              if($rcount == 0)
              {
                $getextras = $this->Crud_model->get_single('demo_data',"course_id = ".$othercourse->id,"ratings");
                $rcount = floatval($getextras->ratings);
              }
              $output .= '<p class="star">';
              for ($i=1; $i <=5 ; $i++) { 
                $output .= '<i class="fa  fa-star';
                  if(floatval($i) <= floatval($rcount))
                    $output .= ' checked">';
                  else if(floatval($i) > floatval($rcount) && floatval($i) <= ceil(floatval($rcount))) 
                    $output .= '-half-full checked">';
                  else if(floatval($i) > floatval($rcount))
                    $output .= '-o checked">';
                  $output .= '</i>';
              } 
              $output .= '<span class="small_card">';
              if($rcount>0) 
                $output .= ' ( '.number_format($rcount,1).' ratings )';
              $output .= '</span>
            </p>
            <p class="rupees" align="right">
              <span class="del_price"> ';
              if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) >0 ){ 
                $output .= $currency_symbol.' '.$othercourse->demoprice.' '; 
              }
              else if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) <= 0) { $output .= 'Free ';}
              else{ $output .= $currency_symbol.' '.$othercourse->fixedrate.' '; 
              }
              if(intval($othercourse->fixedrate) > 0 && intval($othercourse->demoprice) >0){
                $output .= '<span class="del_price2">';
                $output .= $currency_symbol.' '.$othercourse->demoprice;
                $output .= '</span>';
              }
              $output .= '</span>
            </p>
          </div>
        </a>
      </div>';
    }
    return $output;
  }

  public function signup(){
    $this->load->view('new_template_design/header');
    $this->load->view('onlineshiksha/new_signup');
    /*$this->load->view('new_template_design/footer');*/
  }

  public function register(){ 
      $this->load->model('login_model');
      $this->load->model('admin/settings_model');
      $full_name = $this->input->post('full_name');
      $reg_mobile = $this->input->post('reg_mobile');
      $reg_password = $this->input->post('reg_password');
      $check_mobile = $this->Crud_model->get_single('mlms_users',"mobile = ".$reg_mobile);
      
      if(!empty($check_mobile))
      {
        echo "failed";exit;
      }else{
        $data = array(
                  'username'      =>  $reg_mobile,
                  'first_name'    =>  $full_name,
                  'name'          =>  $full_name,
                  'active'        =>  '1',
                  'is_student'    =>  '1',//one is for yes
                  'is_instructor' =>  '0',//zero is for no
                  'created_at'    =>  date('Y-m-d H:i:s'),
                  'password'      =>  md5($reg_password),
                  'group_id'      =>  '1',
                  'webstatus'     =>  '',
                  'mobile'        =>  $reg_mobile
        );
        $this->Crud_model->SaveData('mlms_users',$data);
        $lastid = $this->db->insert_id();
        $group_data = array(
          'user_id'   => $lastid,
          'group_id'  => 1
        );
        $this->Crud_model->SaveData('mlms_users_groups',$group_data);
        $result = $this->login_model->newvalidate($reg_mobile, $reg_password);
        if($result == true){
            $dataNew = $this->login_model->setSessionData($reg_mobile,$reg_password);
            $this->session->set_userdata('logged_in',$dataNew);
        }
        echo $lastid;
        $configarr = $this->settings_model->getItems(); 
        if($configarr[0]['fromemail']) $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
        $admininfo = $this->login_model->getadminInfo(4);
             // New Registration Send To Admin
        $subject = 'Student '.trim(ucfirst($full_name)).' registered to your academy';
        $toemail = $admininfo->email; // prshah83@gmail.com
        $userdata1 = $this->login_model->getUserInfoByEmail($toemail);
        $link = base_url().'users/activate_account/'.$activationcode;
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Student '.trim(ucfirst($full_name)).' registered to your academy</p>';
        $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
        $content .= trim(ucfirst($full_name)).' '.' has register in your Academy.<br />';
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
      }
  }

  public function success(){
    $this->load->view('new_template_design/header');
    $this->load->view('onlineshiksha/success_page');
    $this->load->view('new_template_design/footer');
  }

  public function industry_readiness_program(){
    $this->load->view('onlineshiksha/industry-readiness-program');
  }

  public function tcs_ion_internship(){
    $auth = $this->session->userdata('logged_in');
    $tcs_orders = $this->Crud_model->get_single('mlms_tcs_orders',"(email = '".$auth['email']."' OR contact_no = '".$auth['user_name']."') and status = 'SUCCESS'","activation_code");
    // print_r($tcs_orders);exit;
    $this->load->view('new_template_design/header');
    $this->load->view('onlineshiksha/tcs_ion_internship',array('tcs_orders' => $tcs_orders));
    $this->load->view('new_template_design/footer');
  }

  public function TCSiON_irp_beginner(){
    $camp = isset($_GET['camp']) ? $_GET['camp'] : '';
    $lead_source = isset($_GET['lead-source']) ? $_GET['lead-source'] : '';
    if(!empty($camp) && !empty($lead_source)){
        $this->session->set_userdata('camp',$camp);
        $this->session->set_userdata('lead_source',$lead_source);
    }
    $data = array(
            'camp'            => $camp,
            'lead_source'     => $lead_source,
            'course_name'     => 'TCSiON IRP Beginner',
            'meta_title'      => 'TCS iON Remote Internship Program for Beginners - TCS iON | MyOnlineShiksha.com',
            'meta_description'=> 'TCS iON Beginner Remote internship program offers job seekers a getaway to enter any industry with expert trainers & relevant skill-set. The program is developed to produce the best talent.',
            'meta_keywords'   => 'TCS Remote Internship | TCS Remote Internship program | TCS iON Remote Internship | TCS iON Remote Internship program | TCS Remote Internship | TCS Remote Internship | TCS iON Remote Internship | TCS iON Remote Internship',
            'url'             => 'https://myonlineshiksha.com/tcsion-remote-internship-program-irp-beginner',
            'name'            => 'TCS iON Remote Internship Program for Beginners',
    );
    $this->load->view('onlineshiksha/TCSiON_industry_readiness_program_beginner',$data);
  }

  public function TCSiON_irp_intermediate(){
    $camp = isset($_GET['camp']) ? $_GET['camp'] : '';
    $lead_source = isset($_GET['lead-source']) ? $_GET['lead-source'] : '';
    if(!empty($camp) && !empty($lead_source)){
        $this->session->set_userdata('camp',$camp);
        $this->session->set_userdata('lead_source',$lead_source);
    }
    $data = array(
            'camp'            => $camp,
            'lead_source'     => $lead_source,
            'course_name'     => 'TCSiON IRP Intermediate',
            'meta_title'      => 'TCS iON Remote Internship Program for Intermediate - TCS iON | MyOnlineShiksha.com',
            'meta_description'=> 'TCS iON Intermediate Remote internship program offers job seekers a getaway to enter any industry with expert trainers & relevant skill-set. The program is developed to produce the best talent.',
            'meta_keywords'   => 'TCS Remote Internship | TCS Remote Internship program | TCS iON Remote Internship | TCS iON Remote Internship program | TCS Remote Internship | TCS Remote Internship | TCS iON Remote Internship | TCS iON Remote Internship',
            'url'             => "https://myonlineshiksha.com/tcsion-remote-internship-program-irp-intermediate",
            'name'            => "TCS iON Remote Internship Program for Intermediate",
    );
    $this->load->view('onlineshiksha/TCSiON_industry_readiness_program_intermediate',$data);
  }

  public function TCSiON_irp_advanced(){
    $camp = isset($_GET['camp']) ? $_GET['camp'] : '';
    $lead_source = isset($_GET['lead-source']) ? $_GET['lead-source'] : '';
    if(!empty($camp) && !empty($lead_source)){
        $this->session->set_userdata('camp',$camp);
        $this->session->set_userdata('lead_source',$lead_source);
    }
    $data = array(
            'camp'            => $camp,
            'lead_source'     => $lead_source,
            'course_name'     => 'TCSiON IRP Advanced',
            'meta_title'      => 'TCS iON Advanced Internship Program for Advanced - TCS iON | MyOnlineShiksha.com',
            'meta_description'=> 'TCS iON Advanced internship program offers job seekers a getaway to enter any industry with expert trainers & relevant skill-set. The program is developed to produce the best talent.',
            'meta_keywords'   => 'TCS Remote Internship | TCS Remote Internship program | TCS iON Remote Internship | TCS iON Remote Internship program | TCS Remote Internship | TCS Remote Internship | TCS iON Remote Internship | TCS iON Remote Internship',
            'url'             => "https://myonlineshiksha.com/tcsion-remote-internship-program-irp-advanced",
            'name'            => "TCS iON Remote Internship Program for Advanced",
    );
    $this->load->view('onlineshiksha/TCSiON_industry_readiness_program_advanced',$data);
  }

  public function TCSiON_irp_one(){
    $camp = isset($_GET['camp']) ? $_GET['camp'] : '';
    $lead_source = isset($_GET['lead-source']) ? $_GET['lead-source'] : '';
    if(!empty($camp) && !empty($lead_source)){
        $this->session->set_userdata('camp',$camp);
        $this->session->set_userdata('lead_source',$lead_source);
    }
    $data = array(
            'camp'            => $camp,
            'lead_source'     => $lead_source,
            'course_name'     => 'TCSiON IRP Beginner',
            'meta_title'      => 'TCS iON Remote Internship Program for Beginners - TCS iON | MyOnlineShiksha.com',
            'meta_description'=> 'TCS iON Beginner Remote internship program offers job seekers a getaway to enter any industry with expert trainers & relevant skill-set. The program is developed to produce the best talent.',
            'meta_keywords'   => 'TCS Remote Internship | TCS Remote Internship program | TCS iON Remote Internship | TCS iON Remote Internship program | TCS Remote Internship | TCS Remote Internship | TCS iON Remote Internship | TCS iON Remote Internship',
            'url'             => 'https://myonlineshiksha.com/tcsion-remote-internship-program-irp-beginner',
            'name'            => 'TCS iON Remote Internship Program for Beginners',
    );
    $this->load->view('onlineshiksha/TCSiON_industry_readiness_program_one',$data);
  }

  public function make_inquiry(){
    $course_name = $this->input->post('course_name');
    $name = $this->input->post('enq_name');
    $email = strtolower($this->input->post('enq_email'));
    $contact_no = $this->input->post('enq_contact_no');
    $city = $this->input->post('enq_city');
    $country = $this->input->post('enq_country');
    $state = $this->input->post('enq_state');
    $subject = $this->input->post('enq_subject');
    $form_name = $this->input->post('form_name');
    $checkdup = $this->Crud_model->get_single('mlms_enquiry',"form_name = '".$form_name."' and course_name = '".$course_name."' and (email = '".$email."' OR contact_no = ".$contact_no.")");
    if(!empty($checkdup))
      exit('0');

    $camp = $this->session->userdata('camp');
    $lead_source = $this->session->userdata('lead_source');
    $data = array(
            'name' => $name,
            'contact_no' => $contact_no,
            'course_name' => $course_name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'enquiry_for' => $subject,
            'reference_from' => $camp,
            'lead_source' => $lead_source,
            'form_name' => $form_name,
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
    );
    $this->Crud_model->SaveData('mlms_enquiry',$data);
    $price = '';
    if($form_name == 'download brochure form')
      $subject = "downloading brochure of ".$course_name;
    if($form_name == 'Payment Process Page'){
      $subject = "Payment Processing for ".$course_name;
      if($course_name == 'TCSiON IRP Beginner')
        $price = 2000;
      if($course_name == 'TCSiON IRP Intermediate')
        $price = 3500;
      if($course_name == 'TCSiON IRP Advanced')
        $price = 5000;

      $order = array(
            'full_name'     => $name,
            'course_name'   => $course_name,
            'email'         => $email,
            'contact_no'    => $contact_no,
            'amount'        => $price,
            'currency'      => 'INR',
            'processor'     => 'Razorpay',
            'created'       => date('Y-m-d H:i:s'),
            'modified'      => date('Y-m-d H:i:s'),
      );
      $this->Crud_model->SaveData("mlms_tcs_orders",$order);
      $order_id = $this->db->insert_id();
      $this->session->set_flashdata('order_id', $order_id);
    }
    if($form_name == 'enquiry-form')
      $subject = "Inquiry received for ".$course_name;
    
    $this->load->library('email');        
    $configarr = $this->settings_model->getItems();   
    
    if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
    else 
        $urldomain = 'noreply@mytonlineshiksha.com';
    
    // $subject = 'Inquiry for '.$course_name;
    // $toemail = 'nikhil.b@veerit.com';
    $toemail = 'prshah83@gmail.com';
    $content = '';
    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">'.$subject.'.</p>';
    $content .= 'Hello ,<br/><br/>';
    $content .= 'Details : <br/><br/>';
    $content .= 'Customer Name : '.ucwords($name).'<br/>';
    $content .= 'Customer Email : '.strtolower($email).'<br/>';
    $content .= 'Customer Mobile : '.$contact_no.'<br/>';
    $content .= 'Course Name : '.$course_name.'<br/>';
    if($price != '')
      $content .= 'Price : '.number_format($price,2).'<br/>';

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
    echo "1";
  }

    private function curl_handler($payment_id, $amount)  {
        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        // Live key details
        $key_id         = $this->config->item('keyId');
        $key_secret     = $this->config->item('keySecret');
        // Test keyn details
        /*$key_id         = 'rzp_test_6MFfxqebE6WWyY';
        $key_secret     = 'HDxBNOGr6y8ZCZJbhCqX1WDW';*/
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
        $merchant_amount = $this->input->post('merchant_amount');
        $currency_code = $this->input->post('currency_code');
        $email = $this->input->post('email');
        $contact_no = $this->input->post('contact_no');
        $card_holder_name = $this->input->post('card_holder_name_id');
        $course_name = $this->input->post('course_name');
        $success = false;
        $error = '';
        
        $sess_order_id = $this->session->flashdata('order_id');
        try {
          $order = array(
                'full_name'     => $card_holder_name,
                'course_name'   => $course_name,
                'email'         => $email,
                'contact_no'    => $contact_no,
                'transactionid' => $merchant_order_id,
                'amount'        => $merchant_amount,
                'currency'      => $currency_code,
                'processor'     => 'Razorpay',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s'),
          );
          if(!empty($sess_order_id)){
            $this->Crud_model->SaveData("mlms_tcs_orders",$order,"id = ".$sess_order_id);
            $order_id = $sess_order_id;
          }else{
            $this->Crud_model->SaveData("mlms_tcs_orders",$order);
            $order_id = $this->db->insert_id();
          }
          // sending mail for pending request
          $this->load->library('email');
          $this->load->model('admin/settings_model');           
          $configarr = $this->settings_model->getItems();   
          
          if($configarr[0]['fromemail'])  
              $urldomain = $configarr[0]['fromemail']; 
          else 
              $urldomain = 'noreply@mytonlineshiksha.com';
          
          
          $subject = 'Order #'.$order_id.' Pending';
          $toemail = 'prshah83@gmail.com';
          // $toemail1 = 'ashish.gurao@veerit.com';
          $content = '';
          $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$order_id.' is Pending.</p>';
          $content .= 'Hello ,<br/><br/>';
          $content .= 'Order details : <br/><br/>';
          $content .= 'Customer Name : '.ucwords($card_holder_name).'<br/>';
          $content .= 'Customer Email : '.strtolower($email).'<br/>';
          $content .= 'Customer Mobile : '.$contact_no.'<br/>';
          $content .= 'Course Name : '.$course_name.'<br/>';
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
          // $this->email->cc($toemail1);
          $this->email->message($message);
          $this->email->send();
          // sending mail for pending request
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
        /*$url = 'https://api.razorpay.com/v1/payments/'.$razorpay_payment_id;
        // commission and assessment calculations and updations
      // $order_id = 'Txn63821209';
        $key_id = 'rzp_test_6MFfxqebE6WWyY';
        $key_secret = 'HDxBNOGr6y8ZCZJbhCqX1WDW';
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
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result);*/
        $order = array(
                'status'  => 'SUCCESS',
        );
        $this->Crud_model->SaveData("mlms_tcs_orders",$order,'transactionid = "'.$order_id.'"');
        $orders = $this->Crud_model->get_single('mlms_tcs_orders','transactionid = "'.$order_id.'"');
        
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        if($configarr[0]['fromemail'])
            $urldomain = $configarr[0]['fromemail'];
        else
            $urldomain = 'noreply@mytonlineshiksha.com';
        
        $subject = 'Order #'.$orders->id.' SUCCESS';
        $toemail = 'prshah83@gmail.com';
        // $toemail1 = 'ashish.gurao@veerit.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$orders->id.' is Succeeded.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($orders->full_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($orders->email).'<br/>';
        $content .= 'Customer Mobile : '.$orders->contact_no.'<br/>';
        $content .= 'Course Name : '.$orders->course_name.'<br/>';
        $content .= 'Course Price : '.$orders->amount.'<br/>';
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
        // $this->email->cc($toemail1);
        $this->email->message($message);
        $this->email->send();


        // order mail to customer
        $subject1 = 'Order #'.$orders->id.' SUCCESS';
        $toemail111 = $orders->email;
        // $toemail = 'prashant@veerit.com';
        // $toemail1 = 'ashish.gurao@veerit.com';
        $content1 = '';          
        $content1 .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
        $content1 .= '<p>Hi '.trim(ucfirst($orders->full_name)).',<br /><br />';
        $content1 .= 'Thank you for your purchase. Here are your course purchase details:<br /><br />';
        $content1 .= ' Course Name: '.$orders->course_name.'<br />';
        $content1 .= ' Transaction Id: '.$order_id.'<br />';
        $content1 .= ' Status: Payment Success.<br />';
        $content1 .= ' Amount: '.$orders->amount.'<br /><br />';
        $content1 .= " Your purchase was successfull! <br/>Thank you for enrolling to the ".$orders->course_name.".
We will send instructions with the information to start accessing the content to your registered email.<br/>
For any query, you can contact Mr.Ashish at +91-9960912357.<br /><br />";
        $content1 .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> ';


        $data1['content'] = $content1; 
        $data1['fromemail'] = $urldomain;
        $message1 = $this->load->view('email_formates/common_email_formate.php',$data1,true);
        $fromemail = $urldomain;
        $config1['charset'] = 'utf-8';
        $config1['mailtype'] = 'html';
        $config1['wordwrap'] = TRUE;
        $this->email->initialize($config1);
        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
        $this->email->subject($subject1);
        $this->email->to($toemail111);
        $this->email->message($message1);
        $this->email->send();
        echo "1";
    }

    public function razor_failed() {
        $order_id = $this->session->flashdata('merchant_order_id');
        $data = array(
                    'status' => "FAILURE",
        );
        $this->Crud_model->SaveData('mlms_tcs_orders',$data,'transactionid = "'.$order_id.'"');
        $order = $this->Crud_model->get_single('mlms_tcs_orders','transactionid = "'.$order_id.'"');
        $this->load->library('email');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else 
        $urldomain = 'noreply@mytonlineshiksha.com';

        $subject = 'Order #'.$order->id.' Failed';
        // $toemail = 'nikhil.b@veerit.com';
        $toemail = 'prshah83@gmail.com';
        // $toemail1 = 'ashish.gurao@veerit.com';
        $content = '';
        $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Order Status - #'.$order->id.' is failed.</p>';
        $content .= 'Hello ,<br/><br/>';
        $content .= 'Order details : <br/><br/>';
        $content .= 'Customer Name : '.ucwords($order->full_name).'<br/>';
        $content .= 'Customer Email : '.strtolower($order->email).'<br/>';
        $content .= 'Customer Mobile : '.$order->contact_no.'<br/>';
        $content .= 'Course Name : '.$order->course_name.'<br/>';
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
        // $this->email->cc($toemail1);
        $this->email->message($message);
        $this->email->send();
        echo "0";
    }

}/* End of file welcome.php *//* Location: ./application/controllers/welcome.php */