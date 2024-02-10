<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buyitems extends MLMS_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Buyitem_model');
		$this->template->set_layout('frontend');
		$this->load->library('session');
		$this->load->library('paypal_class');
        $this->load->helper('date');
	}

	public function index()
	{
	}
	public function cart()
	{
	   //$this->session->unset_userdata('discount_value');
//       print_r($this->session->userdata('discount_value'));
     // $this->session->unset_userdata('discount_value');
      //$this->session->set_userdata('discount_value','');
       //exit;
	  //print_r($_POST);
      if($this->input->post('checkout')){
       $plan_course_id = $_POST['plan_course_id'];
       $plan_id =$_POST['plan_id'][$plan_course_id];

       //$currencyChar = $this->session->userdata('currencyChar');
      // print_r($coursestotal); exit;
       $promocode = $this->input->post('promocode');
       $processor = $this->input->post('processor');
       $this->session->set_userdata('processor',$processor);
       $gettotal_price = $this->Buyitem_model->getPromo($promocode);
       $discount = (isset($gettotal_price->discount)) ? $gettotal_price->discount : '0';

       $this->session->set_userdata('discount',$discount);
       $coursestotal = $this->session->userdata('courses_total');
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
             $total_value = ($discount / 100)*$coursestotal;
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
    $this->session->set_userdata('promo_code',$this->input->post('promocode'));
	$total = "";
	$order_id = isset($_SESSION["order_id"]) ? intval($_SESSION["order_id"]) : "";
	$promocode = "";
    //$sessionarray = $this->session->userdata('promo_code');
	if($this->session->userdata('promo_code')){
		$promocode = $this->session->userdata('promo_code');
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
	if($action == ""){
	$courses_from_cart = $this->session->userdata('courses_from_cart');
		if(isset($courses_from_cart)){
			$all_product = $courses_from_cart;
		}
	}
	else{
		$all_product = $_SESSION["renew_courses_from_cart"];
	}
	if($user_id != "0" && $action == ""){

	}
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
	 $this->template->build('buyitems/cart');
	}
	function buynow($course_id){//exit('here');
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$group_id = $sessionarray['groupid'];
		//$db =& JFactory::getDBO();
		if( !isset($user_id) || $user_id == 0){
			redirect('users/login');
		}
		$course_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
		$action  = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

		//$course_id = JRequest::getVar("course_id", 0);
		$selectPlan = 'price';
		$wherePlan = array('product_id' => intval($course_id), 'default' => 1);
		$plandetails = $this->Buyitem_model->getDefaultPlanDetails($selectPlan,$wherePlan);

        $price = '';
        if(!empty($plandetails)){
		$price = $plandetails[0]['price'];
        }

		if(!isset($price) && $price == NULL){
			$price = "0";
		}


		$program = $this->Buyitem_model->getCourseDetails($course_id);

		$name = $program[0]['name'];
		$plan_id = $program[0]['plan_id'];


		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$group_id = $sessionarray['groupid'];

		$plan = "buy";
		if($user_id != "0"){

			$user_courses = $this->Buyitem_model->getUserCourses($user_id);
			if(isset($user_courses) && $user_courses != NULL && is_array($user_courses) && count($user_courses) > 0){

				if(in_array($course_id,$user_courses)){
					$plan = "renew";
					$price = "";
				}
			}
		}

		if($action == "renewemail"){
			$plan = "renew";
		}

		if(isset($_SESSION["courses_from_cart"])){
		//if(!empty($cartContent)){
			$temp_array = array("course_id"=>$course_id, "value"=>$price, "name"=>$name,"plan_id"=>$plan_id, "plan"=>$plan);
			$new_value = $_SESSION["courses_from_cart"];
			$new_value[$course_id] = $temp_array;
			$this->session->set_userdata('courses_from_cart',$new_value);

		}
		else{
			$temp_array = array("course_id"=>$course_id, "value"=>$price, "name"=>$name,"plan_id"=>$plan_id, "plan"=>$plan);
			$new_value = array();
			$new_value[$course_id] = $temp_array;
			$this->session->set_userdata('courses_from_cart',$new_value);

		}
	   	redirect('buyitems/cart');
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
    $processor = $this->session->userdata('processor');
    $session_discount = $this->session->userdata('discount_value');
    $total_value = $this->session->userdata('total_value');
    $total_val = $this->session->userdata('total');
 	$promo_details = $this->Buyitem_model->getPromo();
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
        //  print_r($checkval); exit;
         if($checkval){
           // $promocode = JRequest::getVar("promocode", "");
			//$procesor = JRequest::getVar("processor", "");
            $this->session->set_userdata('promocode',$promocode);
            $this->session->set_userdata('processor','');
            $this->updatecart($this->input->post('promocode'));

         }
		//$this->updatecart();

        $order_id = "";
        $sessionarray = $this->session->userdata('logged_in');
	    $user_id = $sessionarray['id'];
		$group_id = $sessionarray['groupid'];
		// Check Login
		if($user_id == ''){
			// sincronize courses from session with courses from request;
			$courses_request =  $plan_id;
            $courses_session = $this->session->userdata('courses_from_cart');
         //    $courses_from_cart = $this->session->userdata('courses_from_cart');
           // print_r($courses_session);exit;

			//$courses_session = $_SESSION["courses_from_cart"];

			if(isset($courses_request) && count($courses_request) > 0){
               /*	foreach($courses_request as $key=>$value){
					$courses_session[$key]["value"] = $value;
				}*/
				//$_SESSION["courses_from_cart"] = $courses_session;
                $courses_fromcart = $this->session->set_userdata('courses_from_cart',$courses_session);
                //$this->session->set_userdata('courses_from_cart',$new_value);

			}

                redirect('users/login');
			return true;
		}

        foreach($courses_from_cart as $key=>$value){
					$courses_fromcart = $value;
				}

             $total_val = (isset($total_value) && $total_value != '0') ? $total_value : $courses_fromcart['value'];

            $customer = $this->Buyitem_model->getCustomer();

            $res = $this->Buyitem_model->checkProfileCompletion($customer);
            $details_user =$this->Buyitem_model->getUserF($user_id);

            if(isset($details_user) && !empty($details_user && isset($res) && !empty($res))){
      		$username = $details_user["0"]["username"];
      		$email = $details_user["0"]["email"];
      		$first_name = $details_user["0"]["first_name"];
      		$last_name = $details_user["0"]["last_name"];

            if($res < 1){
			$this->Buyitem_model->saveCustomer($user_id,$first_name,$last_name);
	    	}
         }
         $total = 0;
       // $params = array();
		$configs = $this->Buyitem_model->getConfigs();
		$items = $this->Buyitem_model->getCartItems();

        $order_id = $this->Buyitem_model->saveNewOrder();
        if($processor == 'paypaypal'){
          //$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
         // $this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
         $this->paypal_class->paypal_url = 'https://www.paypal.com/ca/cgi-bin/webscr';     // paypal url
         $this->paypal_class->add_field('currency_code', 'CHF');
         $this->paypal_class->add_field('business', 'rajesh.pelne90@gmail.com');
          //$this->paypal_class->add_field('business', $this->config->item('bussinessPayPalAccount') );

         $this->paypal_class->add_field('return', base_url().'/buyitems/cart'); // return url
         $this->paypal_class->add_field('cancel_return', base_url().'/buyitems/cart'); // cancel url
          //$this->paypal_class->add_field('notify_url', $this->base.'/validate/validatePaypal'); // notify url
         $totalPrice = $this->session->userdata('totalPrice');
         // $this->session->set_userdata('courses_price',$courses_fromcart['value']);
         $item_name = $this->paypal_class->add_field('item_name', $courses_fromcart['name']);
         //$amount = $this->paypal_class->add_field('amount', $courses_fromcart['value']);
         $amount = $this->paypal_class->add_field('amount', $total_val);
         $this->paypal_class->add_field('custom', 'kanchan');
         $this->paypal_class->submit_paypal_post();

         exit;
         }
        $tmpl = "default";
        $this->template->set("tmpl", $tmpl);
        $this->template->build('buyitems/checkout');
	}

   function updatecart($discount_code = ''){
    // print_r($discount_code);exit;
		$all_courses = array();
        $action = "buy";
        $configs = $this->Buyitem_model->getConfigs();
    	$currency = $configs["0"]["currency"];
    	$currencypos = $configs["0"]["currencypos"];
    	$character = "CURRENCY_".$currency;
    	switch($character){
    		case 'CURRENCY_INR' :
    		$currencyChar = "Rs.";
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
       	if(trim($action) == "buy"){
		$all_courses = $this->session->userdata('courses_from_cart');
		}
		else{
	    $all_courses = $this->session->userdata('renew_courses_from_cart');
		}
        //print_r($all_courses);
       // printr($data_info);
       /*	if(trim($action) == ""){
			$all_courses = $_SESSION["courses_from_cart"];
		}
		else{
			$all_courses = $_SESSION["renew_courses_from_cart"];
		}*/
        //$prices = $data_info['plan_id'][''];
		//$discount_code = $data_info['promocode'];
		//$discount_code = 'promocode';
        //$prices = $all_courses;
        /*$prices = JRequest::getVar("plan_id", array());
		$discount_code = JRequest::getVar("promocode", "");*/
		$total = 0.0;
          //print_r($all_courses);
		if(isset($all_courses) && is_array($all_courses) && count($all_courses) > 0){
			foreach($all_courses as $key=>$value){
				//$all_courses[$key]["value"] = $prices[$key];
				//$total += $prices[$key];
			}
			if(trim($action) == ""){
			   //	$_SESSION["courses_from_cart"] = $all_courses;
                $this->session->set_userdata('courses_from_cart',$all_courses);
			}
			else{
			   //	$_SESSION["renew_courses_from_cart"] = $all_courses;
                $this->session->set_userdata('renew_courses_from_cart',$all_courses);
			}
		}
		$old_total = $total;
		if(trim($discount_code) != ""){
			//$_SESSION["promo_code"] = $discount_code;
            $this->session->set_userdata('promo_code',$discount_code);
		  //	$model = $this->Buyitem_model->getPromo();
			$promo_details = $this->Buyitem_model->getPromo();
            //print_r($promo_details);
			if(!isset($promo_details)){// promo expired

				$promo_code = "";
				$discount_value = "";
                $this->session->set_userdata('promo_code',$promo_code);
                $this->session->set_userdata('discount_value',$discount_value);
			}
			else{
				$set_discount = false;
				if(trim($promo_details->codelimit) != 0){
					if(trim($promo_details->codelimit) > trim($promo_details->codeused)){
						$set_discount = true;
					}
				}
				else{
					$set_discount = true;
				}

				if($set_discount === TRUE){
					//$configs = $model->getConfigs();
					//$currency = $configs["0"]["currency"];
				   //	$currencypos = $configs["0"]["currencypos"];
				   //	$character = JText::_("GURU_CURRENCY_".$currency);

					if($promo_details->typediscount == '0') {//use absolute values
						$difference = $total - (float)$promo_details->discount;
						if($difference < 0){
							$total = 0;
						}
						else{
							$total = $difference;
						}
						//$model = $this->getModel('gurubuy');
						if($currencypos  == 0){
						   $discount_value = $character." ".$promo_details->discount;
                           $this->session->set_userdata('discount_value',$discount_value);
						}
						else{
							$discount_value = $promo_details->discount." ".$character;
                            $this->session->set_userdata('discount_value',$discount_value);
						}


					}
					else{//use percentage
						$total = ($promo_details->discount / 100)*$total;
						$difference = $old_total - $total;
							if($difference < 0){
								if($currencypos == 0){
									$discount_value =  $character." "."0";
                                    //$this->session->set_userdata('courses_from_cart',$new_value);
                                    $this->session->set_userdata('discount_value',$discount_value);
								}
								else{
									$discount_value =  "0"." ".$character;
                                    $this->session->set_userdata('discount_value',$discount_value);
								}

						}
						else{
							$discount = $old_total - $difference;
							$point_poz = strpos($discount, ".");
							$discount = substr($discount, 0, $point_poz+3);
							if($currencypos == 0){
								$discount_value =  $character." ".(float)$discount;
                                $this->session->set_userdata('discount_value',$discount_value);
							}
							else{
								$discount_value =  (float)$discount." ".$character;
                                $this->session->set_userdata('discount_value',$discount_value);
							}

							$total = (float)$old_total - (float)$discount;
						}

					}
				// unset($_SESSION["msg"]	);
				}
				else{
					$promo_code = "";
					$discount_value = "";
					$msg = "";
                    $this->session->set_userdata('promo_code',$promo_code);
                    $this->session->set_userdata('discount_value',$discount_value);
                    $this->session->set_userdata('msg',$msg);
					//$_SESSION["discount_value"] = "";
				   //	$_SESSION["msg"] = $msg;
				}
			}// if promo is not expired

		}
		else{
			$promo_code = "";
			$discount_value = "";
            $this->session->set_userdata('promo_code',$promo_code);
            $this->session->set_userdata('discount_value',$discount_value);
		}
		$point_poz = strpos($total, ".");
		$total = substr($total, 0, $point_poz+3);
		//$_SESSION["max_total"] = $total;
        $this->session->set_userdata('max_total',$total);

		if(trim($action) != ""){
		   //$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruBuy&action=".trim($action)));
             redirect('buyitems/checkout/');
		}
		else{
			//$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruBuy"));
            redirect('buyitems/cart');
		}
	}


   /* function setPromoTest($total = NULL){
		$old_total = $total;
		$model = $this->getModel("guruBuy");
        $promo_details =  $this->Buyitem_model->getPromo();
      //  print_r($promo_details);
		//$promo_details = $model->getPromo();
		//$configs = $model->getConfigs();
	   //	$currency = $configs["0"]["currency"];
		//$currencypos = $configs["0"]["currencypos"];
		//$character = JText::_("GURU_CURRENCY_".$currency);

     /*if($promo_details->typediscount == '0') {//use absolute values
			$difference = $total - (float)$promo_details->discount;
			if($difference < 0){
				$total = 0;
			}
			else{
				$total = $difference;
			}
			$model = $this->getModel('gurubuy');
			if($currencypos == 0){
				$_SESSION["discount_value"] = $character." ".$promo_details->discount;
			}
			else{
				$_SESSION["discount_value"] = $promo_details->discount." ".$character;
			}
		}
		else{//use percentage
			$total = ($promo_details->discount / 100)*$total;
			$difference = $old_total - $total;
			if($difference < 0){
				if($currencypos == 0){
					$_SESSION["discount_value"] =  $character." "."0";
				}
				else{
					$_SESSION["discount_value"] =  "0"." ".$character;
				}

			}
			else{
				$discount = $old_total - $difference;
				$point_poz = strpos($discount, ".");
				$discount = substr($discount, 0, $point_poz+3);
				if($currencypos == 0){
					$_SESSION["discount_value"] =  $character." ".(float)$discount;
				}
				else{
					$_SESSION["discount_value"] =  (float)$discount." ".$character;
				}
				$total = (float)$old_total - (float)$discount;
			}
		}
		return $promo_details;
	  //	return $total;
	}*/

	/*
	function cancelreturn(){
		$msg = JText::_("GURU_OPERATION_CANCELED");
		$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruBuy"), $msg);
	}
	function updatecart(){
		$all_courses = array();
		$msg=JText::_("GURU_PROMO_EXPIRED");
		$action = JRequest::getVar("action", "");
		if(trim($action) == ""){
			$all_courses = $_SESSION["courses_from_cart"];
		}
		else{
			$all_courses = $_SESSION["renew_courses_from_cart"];
		}
		$prices = JRequest::getVar("plan_id", array());
		$discount_code = JRequest::getVar("promocode", "");
		$total = 0.0;

		if(isset($all_courses) && is_array($all_courses) && count($all_courses) > 0){
			foreach($all_courses as $key=>$value){
				$all_courses[$key]["value"] = $prices[$key];
				$total += $prices[$key];
			}
			if(trim($action) == ""){
				$_SESSION["courses_from_cart"] = $all_courses;
			}
			else{
				$_SESSION["renew_courses_from_cart"] = $all_courses;
			}
		}
		$old_total = $total;
		if(trim($discount_code) != ""){
			$_SESSION["promo_code"] = $discount_code;
			$model = $this->getModel("guruBuy");
			$promo_details = $model->getPromo();
			if(!isset($promo_details)){// promo expired
				$_SESSION["promo_code"] = "";
				$_SESSION["discount_value"] = "";
			}
			else{
				$set_discount = false;
				if(trim($promo_details->codelimit) != 0){
					if(trim($promo_details->codelimit) > trim($promo_details->codeused)){
						$set_discount = true;
					}
				}
				else{
					$set_discount = true;
				}

				if($set_discount === TRUE){
					$configs = $model->getConfigs();
					$currency = $configs["0"]["currency"];
					$currencypos = $configs["0"]["currencypos"];
					$character = JText::_("GURU_CURRENCY_".$currency);

					if($promo_details->typediscount == '0') {//use absolute values
						$difference = $total - (float)$promo_details->discount;
						if($difference < 0){
							$total = 0;
						}
						else{
							$total = $difference;
						}
						$model = $this->getModel('gurubuy');
						if($currencypos == 0){
							$_SESSION["discount_value"] = $character." ".$promo_details->discount;
						}
						else{
							$_SESSION["discount_value"] = $promo_details->discount." ".$character;
						}


					}
					else{//use percentage
						$total = ($promo_details->discount / 100)*$total;
						$difference = $old_total - $total;
							if($difference < 0){
								if($currencypos == 0){
									$_SESSION["discount_value"] =  $character." "."0";
								}
								else{
									$_SESSION["discount_value"] =  "0"." ".$character;
								}

						}
						else{
							$discount = $old_total - $difference;
							$point_poz = strpos($discount, ".");
							$discount = substr($discount, 0, $point_poz+3);
							if($currencypos == 0){
								$_SESSION["discount_value"] =  $character." ".(float)$discount;
							}
							else{
								$_SESSION["discount_value"] =  (float)$discount." ".$character;
							}

							$total = (float)$old_total - (float)$discount;
						}

					}
				 unset($_SESSION["msg"]	);
				}
				else{
					$_SESSION["promo_code"] = "";
					$_SESSION["discount_value"] = "";
					$_SESSION["msg"] = $msg;
				}
			}// if promo is not expired

		}
		else{
			$_SESSION["promo_code"] = "";
			$_SESSION["discount_value"] = "";
		}
		$point_poz = strpos($total, ".");
		$total = substr($total, 0, $point_poz+3);
		$_SESSION["max_total"] = $total;
		if(trim($action) != ""){
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruBuy&action=".trim($action)));
		}
		else{
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruBuy"));
		}
	}
	function checkout(){
		$Itemid = JRequest::getVar("Itemid", "0");
		$db = JFactory::getDBO();
		$from = JRequest::getVar("from", "");
		if(trim($from) == ""){
			$promocode = JRequest::getVar("promocode", "");
			$procesor = JRequest::getVar("processor", "");
			$_SESSION["promocode"] = trim($promocode);
			$_SESSION["processor"] = trim($procesor);
			$this->updatecart();
		}

		//$this->updatecart();

		$order_id = "";
		$_Itemid = $Itemid;
		$cart = $this->getModel('gurubuy');
		$plugins_enabled = $cart->getPluginList();
		$user =& JFactory::getUser();
		$user_id = $user->id;
		// Check Login
		if($user_id == "0"){
			// sincronize courses from session with courses from request;
			$courses_request = JRequest::getVar("plan_id", array());
			$courses_session = $_SESSION["courses_from_cart"];
			if(isset($courses_request) && count($courses_request) > 0){
				foreach($courses_request as $key=>$value){
					$courses_session[$key]["value"] = $value;
				}
				$_SESSION["courses_from_cart"] = $courses_session;
			}
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruLogin&returnpage=checkout"));
			return true;
		}

		$customer = $cart->getCustomer();

		// Check Payment Plugin installed
		if(empty($plugins_enabled)) {
			$msg = JText::_('Payment plugins not installed');
			$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruBuy&Itemid=".$_Itemid), $msg);
			return;
		}
		$res = $cart->checkProfileCompletion($customer);
		$details_user =$cart->getJoomlaUserF($user_id);
		$username = $details_user["0"]["username"];
		$email = $details_user["0"]["email"];
		$name = $details_user["0"]["name"];

		$temp = explode(" ", $name);
		if(isset($temp) && count($temp) > 1){
			$last_name = $temp[count($temp) - 1];
			unset($temp[count($temp) - 1]);
			$first_name = implode(" ", $temp);
		}
		else{
			if(count($temp) == 1){
				$first_name = $name;
				$last_name  = $name;
			}
		}


		if($res < 1){
			//$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruProfile&task=edit&returnpage=checkout&Itemid=".$_Itemid));
			$db = JFactory::getDBO();
			$sql = "insert into #__guru_customer(`id`, `firstname`, `lastname`) values (".intval($user_id).", '".addslashes(trim($first_name))."', '".addslashes(trim($last_name))."')";
			$db->setQuery($sql);
			$db->query();

		}
		$total = 0;

		$configs = $cart->getConfigs();
		$items = $cart->getCartItems($customer, $configs);

		$dispatcher = & JDispatcher::getInstance();
		$params['user_id'] = $customer["0"]["id"];

		if ( isset($this->_customer) && isset($this->_customer->_customer) ) {
			$params['customer'] = ($this->_customer->_customer);
			// get email from user and set to customer
			$user = JFactory::getUser();
			$params['customer']->email = $user->get('email');
		}

		$params['products'] = $items; // array of products
		$params['config'] = $configs;
		$params['processor'] = $_SESSION["processor"];
		$gataways = JPluginHelper::getPlugin('gurupayment', $params['processor']);

		if(is_array($gataways)){
			foreach($gataways as $gw){
				if($gw->name == $prosessor){
					$params['params'] = $gw->params;
					break;
				}
			}
		}
		else{
			$params['params'] = $gataways->params;
		}

		$character = JText::_("GURU_CURRENCY_".$configs["0"]["currency"]);
		$discount_value = $_SESSION["discount_value"];
		$discount_value = str_replace($character, "", $discount_value);
		$discount_value = trim($discount_value);

		$order_id = $cart->saveNewOrder();
		$params['order_id'] = $order_id;
		$params['sid'] = $order_id;
		$params['option'] = 'com_guru';
		$params['controller'] = 'guruBuy';
		$params['task'] = 'payment';
		$params['order_amount'] = $discount_value;
		$params['order_currency'] = $configs["0"]['currency'];
		$params['Itemid'] = JRequest::getInt('Itemid');
		$params["customer_id"] = $customer["0"]["id"];
		JPluginHelper::importPlugin('gurupayment');
		$result = $dispatcher->trigger('onSendPayment', array(&$params));

		//check if the price is 0(zero), to not redirect to paypal
		$total_prices = 0;
		foreach($items as $key=>$value){
			$total_prices += $value["value"];
		}

		if($total_prices == "0" || $total_prices == "0.00" || (isset($discount_value) && trim($discount_value) != "" && ($total_prices - $discount_value) == 0)){
			$model = $this->getModel("guruBuy");
			$submit_array = array("customer_id"=>$customer["0"]["id"], "order_id"=>$order_id, "price"=>"0");
			$model->proccessSuccess("guruBuy", $submit_array, false);
		}

		$form_created = $result["0"];
		if(trim($form_created) == "" && isset($result["1"])){
			$form_created = $result["1"];
		}

		$db =& JFactory::getDBO();
		$sql = "update #__guru_order set form='".trim(addslashes($form_created))."' where id=".intval($order_id);
		$db->setQuery($sql);
		$db->query();

		//for https ---------------------------------------
		$processor = $_SESSION["processor"];
		if($processor == "payauthorize"){
			$page_url = $this->getPageURL();
			$reqhttps = "1";
			if(is_file(JPATH_SITE.DS."plugins".DS."gurupayment".DS."payauthorize".DS."install")){
				$content = JFile::read(JPATH_SITE.DS."plugins".DS."gurupayment".DS."payauthorize".DS."install");
				$reqhttps = $this->getReqhttps($content);
				if($reqhttps == "1"){//https
					if(strpos($page_url, "https") === FALSE){
						$site = JURI::root();
						$site = str_replace("http", "https", $site);
						$page_url = $site."index.php?option=com_guru&view=guruBuy&action2=submit&order_id=".$order_id."&Itemid=".intval($Itemid);
						$this->setRedirect(JRoute::_($page_url));
						return true;
					}
				}
			}
		}

		$this->setRedirect(JRoute::_("index.php?option=com_guru&view=guruBuy&action2=submit&order_id=".$order_id."&Itemid=".intval($Itemid)));

		//for https ---------------------------------------
	}
	function payment(){
		$model = $this->getModel("guruBuy");
		if(JRequest::getVar('processor', '') == ''){
			return false;
		}

		$_SESSION["creditCardNumber"] = JRequest::getVar("creditCardNumber", "");
		$_SESSION["expDateMonth"] = JRequest::getVar("expDateMonth", "");
		$_SESSION["expDateYear"] = JRequest::getVar("expDateYear", "");
		$_SESSION["cvv2Number"] = JRequest::getVar("cvv2Number", "");

		$dispatcher = & JDispatcher::getInstance();
		JPluginHelper::importPlugin('gurupayment');
		$params = JPluginHelper::getPlugin('gurupayment', JRequest::getVar('processor'))->params;

		$param = array_merge(JRequest::get('request'), array('params' => $params));
		$param['handle'] = &$this;

		$results_plugins = $dispatcher->trigger('onReceivePayment', array(&$param));

		$result = array();
		foreach($results_plugins as $result_plugin){
			if(!empty($result_plugin)){
				$result = $result_plugin;
			}
		}

		if(empty($result['sid'])){
			$result['sid'] = -1;
		}

		if(empty($result['pay'])){
			$result['pay'] = 'fail';
		}

		if(isset($result) && !empty($result)){
			// set sid if empty
			if((!isset($result['sid']) || empty($result['sid'])) && !empty($result['order_id'])){
				$result['sid'] = $result['order_id'];
			}

			switch($result['pay']){
				case 'success':
					$model->proccessSuccess($this, $result);
					break;
				case 'ipn':
					$model->proccessIPN($this, $result);
					break;
				case 'wait':
					$model->proccessWait($this, $result);
					break;
				case 'fail':
					if($result["processor"] == "paypaypal"){
						$model->proccessFail($this, $result);
					}
					else{
						$model->proccessAuthorizeFail($this, $result);
					}
					break;
				default:
					break;
			}
		}
	}
	function deleteFromSession(){
		$course_id = JRequest::getVar("course_id");
		$action = JRequest::getVar("action", "");
		if(trim($action) == "buy"){
			$all_courses = $_SESSION["courses_from_cart"];
			unset($all_courses[$course_id]);
			$_SESSION["courses_from_cart"] = $all_courses;
		}
		else{
			$all_courses = $_SESSION["renew_courses_from_cart"];
			unset($all_courses[$course_id]);
			$_SESSION["renew_courses_from_cart"] = $all_courses;
		}
	}
    function getReqhttps($content){
		$reqhttps = "1";
		if(trim($content) != ""){
			$by_n = explode("\n", $content);
			if(isset($by_n)){
				foreach($by_n as $key=>$value){
					$by_equal = explode("=", $value);
					if(is_array($by_equal) && count($by_equal) > 0){
						if($by_equal["0"] == "reqhttps"){
							$reqhttps = trim($by_equal["1"]);
						}
					}
				}
			}
		}
		return $reqhttps;
	}
	function getPageURL(){
		$pageURL = 'http';
		if($_SERVER["HTTPS"] == "on"){
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if($_SERVER["SERVER_PORT"] != "80"){
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	*/
}
?>