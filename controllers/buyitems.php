<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buyitems extends MLMS_Controller 
{
   
	function __construct()
	{ 
	   
		parent::__construct();
		
		$this->load->model('Buyitem_model');
		$this->template->set_layout('frontend');		
		$this->load->library('session');
		$this->load->library('paypal_class');
        $this->load->helper('date');
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->helper('cookie');
		$this->load->helper('commonmethods');
        $this->load->helper('text');
        $this->load->model('admin/settings_model');
		$this->load->model('admin/programs_model');
		$this->load->model('program_model');
		
		$configarr = $this->settings_model->getItems();	

		date_default_timezone_set($configarr[0]['time_zone']);

		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$this->template->set("configarr", $configarr);
		
		$this->load->library('email');
		$this->load->library('form_validation'); 
	}

	public function index()
	{
	 
	}
   /* public function paypal() {
   // $this->load->librarary('paypal_class');
    $this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
    //$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
    $this->paypal_class->add_field('currency_code', 'CHF');
    $this->paypal_class->add_field('business', $this->config->item('bussinessPayPalAccountTest'));
    //$this->paypal_class->add_field('business', $this->config->item('bussinessPayPalAccount'));
    $this->paypal_class->add_field('return', $this->base.'/checkout/success'); // return url
    $this->paypal_class->add_field('cancel_return', $this->base.'/checkout/step4'); // cancel url
    $this->paypal_class->add_field('notify_url', $this->base.'/validate/validatePaypal'); // notify url
    $totalPrice = $this->session->userdata('totalPrice');
    $this->paypal_class->add_field('item_name', 'Testing');
    $this->paypal_class->add_field('amount', $totalPrice);
    $this->paypal_class->add_field('custom', $this->session->userdata('orderId'));
    $this->paypal_class->submit_paypal_post(); // submit the fields to paypal
    //$p->dump_fields();      // for debugging, output a table of all the fields
    exit;
    }*/

	public function cart()	
	{
    	$this->load->model('admin/settings_model');     		$configarr = $this->settings_model->getItems();	  		$tmpl = $configarr[0]['layout_template'];         
	 if($this->input->post('checkout'))
     {       $plan_course_id = (isset($_POST['plan_course_id'])) ? $_POST['plan_course_id'] : '';  // course id
       $plan_id = (isset($_POST['plan_id'][$plan_course_id])) ? $_POST['plan_id'][$plan_course_id] : ''; // plan price
       $promocode = $this->input->post('promocode');
       $processor = $this->input->post('processor');

       $coursestotal = $plan_id;

       if($promocode !='')
       {
           $gettotal_price = $this->Buyitem_model->getPromo($promocode);
           $discount = (isset($gettotal_price->discount)) ? $gettotal_price->discount : '0';  // discount %/rs on promocode
           $discount_type = (isset($gettotal_price->typediscount) ? $gettotal_price->typediscount : ''); //whether discount is in rs or %

            if($discount_type == 0){
               if($coursestotal){
                  $discountedvalue=$discount;
                 $total_value = $coursestotal - $discount;
               }else{
                 $total_value= '';
               }
           }else{
               if($coursestotal){
                 $discountedvalue = ($discount / 100)*$coursestotal;
                 $total_value = $coursestotal - $discountedvalue;
               }else{
                 $total_value= '';
               }
           }
       }
       else
       {
           $total_value=$plan_id;
           $discountedvalue='0';
       }
       //$total_value is an actual course price after all operation
       $this->session->set_userdata('discount',$discountedvalue);
       $this->session->set_userdata('processor',$processor);

       $this->session->set_userdata('courseprice',$plan_id);
       $this->session->set_userdata('actualcourseprice',$total_value);

       $checkout = $this->checkout($promocode,$plan_id);
       redirect('buyitems/checkout/');
   }

      
	$sessionarray = $this->session->userdata('logged_in');	$email = $sessionarray['email'];
	$user_id = $sessionarray['id'];
	$group_id = $sessionarray['groupid'];
	$this->load->helper('date');
	$tmpl = "default";


    $promocode = $this->input->post('promocode');
    $plan_id = $this->input->post('plan_id');

    $gettotal_price = $this->Buyitem_model->getPromo($promocode);
    $discount = (isset($gettotal_price->discount)) ? $gettotal_price->discount : '0';
    $coursestotal = $this->session->userdata('courses_total');
    if($this->input->post('plan_id'))
    {
        foreach($plan_id as $eachplan){
            $coursestotal=$eachplan;
      }
    }

    //print_r($plan_id);
    $typediscount = (isset($gettotal_price->typediscount)) ? $gettotal_price->typediscount : '';

    if(isset($typediscount) && $typediscount == '1'){
        $total_discount = ($discount*$coursestotal)/100;
    }elseif($typediscount == '0'){
        $total_discount = $discount;
    }else{
        $total_discount = '0';
    }

    $this->session->set_userdata('discount',$total_discount);

    $_SESSION["promo_code"]=$this->input->post('promocode');

	$total = "";
    $order_id = isset($_SESSION["order_id"]) ? intval($_SESSION["order_id"]) : "";
	$promocode = "";

	if(isset($_SESSION["promo_code"])){
		$promocode = $_SESSION["promo_code"];
	}
	
	$action = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : NULL;
	$action2 =  ( $this->uri->segment(4) ) ? $this->uri->segment(4) : NULL;
	$order_id =  ( $this->uri->segment(5) ) ? $this->uri->segment(5) : $order_id;
	$orderResult = $this->Buyitem_model->getOrder($order_id);

	$configs = $this->Buyitem_model->getConfigs();
	$currency = $configs["0"]["currency"];
	$currencypos = $configs["0"]["currencypos"];
	$character = "CURRENCY_".$currency;
	switch($character){
		case 'CURRENCY_INR' :
		$currencyChar = "Rs.";
		break;
		case 'CURRENCY_MXN' :
		$currencyChar = "$";
		break;
		case 'CURRENCY_USD' :
		$currencyChar = "$";
		break;
		case 'CURRENCY_AUD' :
		$currencyChar = "$";
		break;
		case 'CURRENCY_CAD' :
		$currencyChar = "$";
		break;
	}
	//echo $currencyChar;
	//$action = JRequest::getVar("action", "");

	$all_product = array();
	if($action == ""){
	$courses_from_cart = $this->session->userdata('courses_from_cart');
		if(isset($courses_from_cart)){
			$all_product = $courses_from_cart;
		}
	}
	else{
		//$all_product = $_SESSION["renew_courses_from_cart"];
        $renew_courses_from_cart = $this->session->userdata('renew_courses_from_cart');
		if(isset($renew_courses_from_cart)){
			$all_product = $renew_courses_from_cart;
		}
	}

   if($user_id != "0" && $action == "")
   {
   
		//$all_product = $this->refreshCoursesFromCart($all_product);

	 $this->template->set("user_id", $user_id);
	 $this->template->set("all_product", $all_product);
	 $this->template->set("action", $action);
	 $this->template->set("action2", $action2);
	 $this->template->set("orderResult", $orderResult);
	 $this->template->set("currencyChar", $currencyChar);
	 $this->template->set("tmpl", $tmpl);
	 $this->template->set("promocode", $promocode);
	 $this->template->set("total", $total);
	 $this->template->set("order_id", $order_id);
	 $this->template->set("currencypos", $currencypos);

		if(isset($user_id) && $user_id != ''){		$tmpl = $configarr[0]['layout_template'];    
		//$this->template->build('buyitems/cart');		$this->template->build(getOverridePath($tmpl,'buyitems/cart','views'));
		}
		else
		{			
		   $this->template->build('user/login');		
		}	
  }
 }


    /* ******* V S *******/


    public function cart_v1()
	{

     if($this->input->post('checkout'))
     {

       $plan_course_id = (isset($_POST['plan_course_id'])) ? $_POST['plan_course_id'] : '';
       $plan_id = (isset($_POST['plan_id'][$plan_course_id])) ? $_POST['plan_id'][$plan_course_id] : '';

       //$currencyChar = $this->session->userdata('currencyChar');
      // print_r($coursestotal); exit;
       $promocode = $this->input->post('promocode');
       $processor = $this->input->post('processor');
       $this->session->set_userdata('processor',$processor);

       $gettotal_price = $this->Buyitem_model->getPromo($promocode);
       $discount = (isset($gettotal_price->discount)) ? $gettotal_price->discount : '0';

       $this->session->set_userdata('discount',$discount);
       $coursestotal = $this->session->userdata('courses_total');
	   //	print_r($coursestotal); exit;
      // $typediscount = $coursestotal;
       $discount_type = (isset($gettotal_price->typediscount) ? $gettotal_price->typediscount : '');

       if($discount_type == 0){
           if($coursestotal){
             $total_value = $coursestotal - $discount;
           }else{
             $total_value= '';
           }
       }else{
           if($coursestotal){
             //$total_value = $typediscount - $discount;
             $totalvalue = ($discount / 100)*$coursestotal;
             $total_value = $coursestotal - $totalvalue;
           }else{
             $total_value= '';
           }
       }

       $this->session->set_userdata('total_value',$total_value);
       $checkout = $this->checkout($promocode,$plan_id);
       redirect('buyitems/checkout/');

   }


	$sessionarray = $this->session->userdata('logged_in');
	$user_id = $sessionarray['id'];
	$group_id = $sessionarray['groupid'];
	$this->load->helper('date');
	$tmpl = "default";

    $configs = $this->Buyitem_model->getConfigs();
	$currency = $configs["0"]["currency"];
	$currencypos = $configs["0"]["currencypos"];
	$character = "CURRENCY_".$currency;
	switch($character){
		case 'CURRENCY_INR' :
		$currencyChar = "Rs.";
		break;
		case 'CURRENCY_MXN' :
		$currencyChar = "$";
		break;
		case 'CURRENCY_USD' :
		$currencyChar = "$";
		break;
		case 'CURRENCY_AUD' :
		$currencyChar = "$";
		break;
		case 'CURRENCY_CAD' :
		$currencyChar = "$";
		break;
	}


    $all_product = array();
    $courses_from_cart = $this->session->userdata('courses_from_cart');
	if(isset($courses_from_cart)){
			$all_product = $courses_from_cart;
	}


    /* $promocode = $this->input->post('promocode');
    $gettotal_price = $this->Buyitem_model->getPromo($promocode);
    $discount = (isset($gettotal_price->discount)) ? $gettotal_price->discount : '0';
    $coursestotal = $this->session->userdata('courses_total');
    $typediscount = (isset($gettotal_price->typediscount)) ? $gettotal_price->typediscount : '';

    if(isset($typediscount) && $typediscount == '1'){
        $total_discount = ($discount*$coursestotal)/100;
    }elseif($typediscount == '0'){
        $total_discount = $discount;
    }else{
        $total_discount = '0';
    }

    $this->session->set_userdata('discount',$total_discount);

    $_SESSION["promo_code"]=$this->input->post('promocode');

	$total = "";
    $order_id = isset($_SESSION["order_id"]) ? intval($_SESSION["order_id"]) : "";
	$promocode = "";

	if(isset($_SESSION["promo_code"])){
		$promocode = $_SESSION["promo_code"];
	}

	$action = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : NULL;
	$action2 =  ( $this->uri->segment(4) ) ? $this->uri->segment(4) : NULL;
	$order_id =  ( $this->uri->segment(5) ) ? $this->uri->segment(5) : $order_id;
	$orderResult = $this->Buyitem_model->getOrder($order_id);
                                                                 */

	//echo $currencyChar;
	//$action = JRequest::getVar("action", "");





	 $this->template->set("user_id", $user_id);
	 $this->template->set("all_product", $all_product);
	 $this->template->set("currencyChar", $currencyChar);
	 $this->template->set("tmpl", $tmpl);
	 $this->template->set("currencypos", $currencypos);

	 if(isset($user_id) && $user_id != ''){
		$this->template->build('buyitems/cart');
	 }else{
			$this->template->build('user/login');
	 }
}



 function calculateDiscout()
 {
        //ob_start();
       $promocode=$this->input->post('promocode');
       $planprice=$this->input->post('planprice');
       $gettotal_price = $this->Buyitem_model->getPromo($promocode);
       $discount = (isset($gettotal_price->discount)) ? $gettotal_price->discount : '0';
       $discount_type = (isset($gettotal_price->typediscount) ? $gettotal_price->typediscount : '');

       if(isset($discount_type) && $discount_type == '1'){
        $total_discount = ($discount*$planprice)/100;
    }elseif($discount_type == '0'){
        $total_discount = $discount;
    }else{
        $total_discount = '0';
    }

    //$this->session->set_userdata('totaldiscount',$discount);
    $newplanprice=$planprice - $total_discount;
    //$this->session->set_userdata('newcourseprie',$newplanprice);

    //$calAmt=array('discount'=>$discount,'total_value'=>$total_value);
       //echo $planprice;
       //$this->session->set_userdata('totaldiscount',$total_discount);
       //$this->session->set_flashdata('totaldiscount',$total_discount);
       echo $total_discount."/".$newplanprice;
 }
    /****** VE ************/






	function buynow()	
	{		
	   
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$group_id = $sessionarray['groupid'];
		
		if( !isset($user_id) || $user_id == 0)
		{			
			redirect('users/login');		
		}	
		
		$course_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;	
		$action  = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;		
		$selectPlan = 'price';	
		$wherePlan = array('product_id' => intval($course_id), 'default' => 1);	
		$plandetails = $this->Buyitem_model->getDefaultPlanDetails($selectPlan,$wherePlan);	   
		$price = '';    
		if(!empty($plandetails))	
		{		
			$price = $plandetails[0]['price'];  
		}
		
		if(!isset($price) && $price == NULL)
		{
			$price = "0";	
		}
	
		$program = $this->Buyitem_model->getCourseDetails($course_id);
		$name = (isset($program[0]['name'])) ? $program[0]['name'] : '';
		$plan_id = (isset($program[0]['plan_id'])) ? $program[0]['plan_id'] : '';

		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$group_id = $sessionarray['groupid'];
		
		$plan = "buy";
		if($user_id != "0")
		{
			$user_courses = $this->Buyitem_model->getUserCourses($user_id);
			if(isset($user_courses) && $user_courses != NULL && is_array($user_courses) && count($user_courses) > 0)
			{
				if(in_array($course_id,$user_courses))
				{
					$plan = "renew";
					$price = "";
				}
			}
		}

		if($action == "renewemail")
		{
			$plan = "renew";
		}

		if(isset($_SESSION["courses_from_cart"]))
		{
			$temp_array = array("course_id"=>$course_id, "value"=>$price, "name"=>$name,"plan_id"=>$plan_id, "plan"=>$plan);
			$new_value = $_SESSION["courses_from_cart"];
			$new_value[$course_id] = $temp_array;
			$this->session->set_userdata('courses_from_cart',$new_value);
		}
		else
		{
			$temp_array = array("course_id"=>$course_id, "value"=>$price, "name"=>$name,"plan_id"=>$plan_id, "plan"=>$plan);
			$new_value = array();
			$new_value[$course_id] = $temp_array;
			$this->session->set_userdata('courses_from_cart',$new_value);
		}
	   	//redirect('buyitems/cart');
		 $this->template->build(getOverridePath($tmpl,'buyitems/cart','views'));
	}
	

	function deleteFromSession(){
		$course_id = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : NULL;
		$action = ( $this->uri->segment(4) ) ? $this->uri->segment(4) : NULL;
		if(trim($action) == "buy"){
		$all_courses = $this->session->userdata('courses_from_cart');
			//$all_courses = $_SESSION["courses_from_cart"];
			unset($all_courses[$course_id]);
			//$this->session->unset_userdata('courses_from_cart');
			$this->session->set_userdata('courses_from_cart',$all_courses);
			//$_SESSION["courses_from_cart"] = $all_courses;
		}
		else{
			$all_courses = $this->session->userdata('renew_courses_from_cart');
			//$all_courses = $_SESSION["renew_courses_from_cart"];
			unset($all_courses[$course_id]);
			$this->session->set_userdata('renew_courses_from_cart',$all_courses);
			//$_SESSION["renew_courses_from_cart"] = $all_courses;
		}
	}





   function checkout($checkval = '',$plan_id = ''){

   // $checkval---->promocode
   //  $plan_id---->plan price

   $sessionarray = $this->session->userdata('logged_in');
   $user_id = $sessionarray['id'];
   $group_id = $sessionarray['groupid'];

    if($user_id == '')
    {
		//sincronize courses from session with courses from request;
	    $courses_request =  $plan_id;
	    $courses_session = $this->session->userdata('courses_from_cart');

	    if(isset($courses_request) && count($courses_request) > 0)
		{
			$courses_fromcart = $this->session->set_userdata('courses_from_cart',$courses_session);
		}

	    redirect('users/login');
	    return true;
    }

    $processor = $this->session->userdata('processor');
    //$session_discount = $this->session->userdata('discount_value');
    //$total_value = $this->session->userdata('total_value');
    //$total_val = $this->session->userdata('total');
 	//$promo_details = $this->Buyitem_model->getPromo();
    // print_r($session_discount);exit;
    $courses_from_cart = $this->session->userdata('courses_from_cart');
  	$datestring = "%Y-%m-%d %h:%i:%s";
	$time = time();
	$date = mdate($datestring, $time);
	
	$promocode = $checkval;
    $processor = 'paypaypal';

    $checkout_data = array(
       'promocode'=>$promocode,
       'processor'=>$processor
    );

    $order_id = "";
    $order_type = (isset($order_type))?$order_type:'buy';

    foreach($courses_from_cart as $key=>$value)
	{
	    $courses_fromcart = $value;
	}

    //$total_val = $courses_fromcart['value'];
    $total_val = $this->session->userdata('actualcourseprice');
    $courseprice = $this->session->userdata('courseprice');
    $discount = $this->session->userdata('discount');
    //$total_val = 2;
    //$customer = $this->Buyitem_model->getCustomer();
    $customer = $this->Buyitem_model->getCustomerById($user_id);

    $res = $this->Buyitem_model->checkProfileCompletion($customer);

    $details_user =$this->Buyitem_model->getUserF($user_id);

	$username = (isset($details_user["0"]["username"])) ? $details_user["0"]["username"] : '';
    $email = (isset($details_user["0"]["email"])) ? $details_user["0"]["email"] : '';
    $first_name = (isset($details_user["0"]["first_name"])) ? $details_user["0"]["first_name"] : '';
    $last_name = (isset($details_user["0"]["last_name"])) ? $details_user["0"]["last_name"] : '';


	if(isset($details_user) && !empty($details_user) && isset($res) && !empty($res)){
					if($res < 1){
					$this->Buyitem_model->saveCustomer($user_id,$first_name,$last_name);  // inserting data into mlms_customer table
					}
	}

    $total = 0;

    // $params = array();
	$configs = $this->Buyitem_model->getConfigs();
	$currency = $configs["0"]["currency"];
	$items = $this->Buyitem_model->getCartItems();

    //$order_id = $this->Buyitem_model->saveNewOrder($total_value);

    $order_id = $this->Buyitem_model->saveNewOrderModified($total_val,$courseprice,$promocode,$user_id);

    if($processor == 'paypaypal')
	{

          $this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url


         // $this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
         //$this->paypal_class->paypal_url = 'https://www.paypal.com/ca/cgi-bin/webscr';     // paypal url

         //$this->paypal_class->add_field('currency_code', $currency);

         $this->paypal_class->add_field('currency_code', $currency);

         //$this->paypal_class->add_field('business', 'rajesh.pelne90@gmail.com');
         //$this->paypal_class->add_field('business', 'kanchanchawatkar@gmail.com');
         $this->paypal_class->add_field('business', $email);         //$this->paypal_class->add_field('business', $this->config->item('bussinessPayPalAccount') );         $this->paypal_class->add_field('return', base_url().'buyitems/paypal_return_handler'); // return url         $this->paypal_class->add_field('cancel_return', base_url().'/buyitems/paypal_return_handler'); // cancel url        //'<input type=\"hidden\" name=\"discount_rate_cart\" value='".$couponamount."' />'
        //$this->paypal_class->add_field('notify_url', $this->base.'/validate/validatePaypal'); // notify url

        $totalPrice = $this->session->userdata('totalPrice');

        // $this->session->set_userdata('courses_price',$courses_fromcart['value']);

        $item_name = $this->paypal_class->add_field('item_name', $courses_fromcart['name']);
        $item_id = $this->paypal_class->add_field('item_id', $courses_fromcart['course_id']);
        //$item_name = $this->paypal_class->add_field('plan_id', $courses_fromcart['plan_id']);
        $item_name = $this->paypal_class->add_field('user_id', $user_id);
        //$amount = $this->paypal_class->add_field('amount', $courses_fromcart['value']);
        //$amount = $this->paypal_class->add_field('amount', $total_val);
        $amount = $this->paypal_class->add_field('amount', $courseprice);
        //$this->paypal_class->add_field('discount_amount',$session_discount);
        $this->paypal_class->add_field('discount_amount',$discount);
        $this->paypal_class->add_field('order_id', $order_id);
        $this->paypal_class->add_field('custom', $order_id);
        $this->paypal_class->submit_paypal_post();
		
		
	//code on dated 18-12-2014 For Mail To Student :- Order Confirmation
		$this->load->model('admin/settings_model');  
		$configarr = $this->settings_model->getItems();	 
		$subject1 = 'Order Confirmation From '.$configarr[0]['institute_name'];
		$getuser = $this->Buyitem_model->getUser($user_id);	
		$toemail1 = $getuser->email;//admin mail	
		$prog = $this->Buyitem_model->getProgram($courses_fromcart['course_id']);			
		$content = '';	
		$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">Order Confirmed To '.$configarr[0]['institute_name'].'</h6>';
		$content .= '<p>Dear '.$sessionarray['first_name'].' '.$sessionarray['last_name'].',<br /><br />';
		$content .= '<p>Thanks For Order Confirmation in the Course , '.$prog->name.',<br />';
		$content .='Best regards,<br /><br />';
		$content .=''.$configarr[0]['institute_name'].'</p>';
        $message1 = $content;
		$fromemail1='prshah83@gmail.com';//from mail		
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail1, 'Prashant');
		$this->email->subject($subject1);
		$this->email->to($toemail1);
		$this->email->message($message1);
		$this->email->send();	
		
	//mail to teacher
		$getauthor = $this->Buyitem_model->getUser($prog->author);	 
		$subject2 = 'Order Confirmation From '.$configarr[0]['institute_name'];
		$toemail2 = $getauthor->email;
		$prog = $this->Buyitem_model->getProgram($courses_fromcart['course_id']);			
		$content = '';	
		$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">Order Confirmed To '.$configarr[0]['institute_name'].'</h6>';
		$content .= '<p>Dear '.$getauthor->first_name.' '.$getauthor->last_name.',<br /><br />';
		$content .= '<p>New Order Confirmation in the Course <b>, '.$prog->name.',</b> The Student is :- '.$sessionarray['first_name'].' '.$sessionarray['last_name'].',<br />';
		$content .='Best regards,<br /><br />';
		$content .=''.$configarr[0]['institute_name'].'</p>';
        $message2 = $content;
		$fromemail2='prshah83@gmail.com';//from mail		
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail2, 'Prashant');
		$this->email->subject($subject2);
		$this->email->to($toemail2);
		$this->email->message($message2);
		$this->email->send();	

	//mail to Admin
		$subject3 = 'New Order Confirmation From '.$configarr[0]['institute_name'];
		$toemail3 = 'prshah83@gmail.com';
		$prog = $this->Buyitem_model->getProgram($courses_fromcart['course_id']);			
		$content = '';	
		$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">Order Confirmed To '.$configarr[0]['institute_name'].'</h6>';
		$content .= '<p>Dear Prashant'.',<br /><br />';
		$content .= '<p>New Order Confirmation in the Course <b>, '.$prog->name.',</b> The Student is :- '.$sessionarray['first_name'].' '.$sessionarray['last_name'].',<br />';
		$content .='Best regards,<br /><br />';
		$content .=''.$configarr[0]['institute_name'].'</p>';
        $message3 = $content;
		$fromemail3='prshah83@gmail.com';//from mail		
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($fromemail3, 'Prashant');
		$this->email->subject($subject3);
		$this->email->to($toemail3);
		$this->email->message($message3);
		$this->email->send();			
    }
        $tmpl = "default";
        $this->template->set("tmpl", $tmpl);
        $this->template->build('buyitems/checkout');
	}

	function paypal_return_handler_ori(){
	//echo '<pre>';
   //	print_r($_POST);
	//print_r($_REQUEST);
	//print_r($_GET);
   // echo '<pre>';

    /*$datestring = "%Y-%m-%d %h:%i:%s";
	$time = time();
	$date = mdate($datestring, $time);
	$response_array = $this->input->post();
	$course_id = $response_array['course_id'];
	$user_id = $response_array['user_id'];
	$plan_id = $response_array['plan_id'];
	$payment_gross = $response_array['payment_gross'];
	$txn_id = $response_array['txn_id'];
	$mc_currency = $response_array['mc_currency'];    */


	}

    function paypal_return_handler(){

    $order_id = $_REQUEST['custom'];
    $paidamt=$_REQUEST['mc_gross'];

    $this->Buyitem_model->updateOrder($order_id,$paidamt);
    redirect('category/');
	}

}
?>