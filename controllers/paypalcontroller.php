<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypalcontroller extends CI_Controller {

    function Paypalcontroller()
    {
         parent::__construct();
         $this->load->library('paypal_class');
         $this->load->model('admin/settings_model');
$configarr = $this->settings_model->getItems(); 
date_default_timezone_set($configarr[0]['time_zone']);
         // $this->load->model('pricing_model');
         // $this->load->model('orders_model');
         // $this->load->library('form_validation');
         // $this->load->library('email');  

    }

	function index()
	{
    exit('rrrrr');
  //       $plan_id = $this->uri->segment(3, 1);

  //       $plandata= $this->pricing_model->getPlanData($plan_id);

  //       $planprice=$plandata->price;

  //        if(trim($planprice) == '0')
  //        {
  //            redirect('institutes/');
  //        }


  //       $data['plan']=$this->pricing_model->get_plan($plan_id);
  //       $this->load->view('pageheader');
	 //    $this->load->view('paypalcontroller/create_basket',$data);
		// $this->load->view('pagefooter');
	}

    function prepare_cart($plan_id)
	{

        //$plan_id = $this->uri->segment(3, 1);

        $data['plan']=$this->pricing_model->get_plan($plan_id);
        $this->load->view('pageheader');
		$this->load->view('paypalcontroller/create_basket',$data);
		$this->load->view('pagefooter');

	}



    function buyplan()
    {

        $plan_id = $this->uri->segment(3, 1);
        //$userid=$this->session->userdata('userid');
        $userid='32';

        $uidpid= $plan_id."-".$userid;

        $plan=$this->pricing_model->get_plan($plan_id);

        $this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

        $this->paypal_class->add_field('currency_code','USD');
        $this->paypal_class->add_field('business', 'vikas.gorle@gmail.com');

        $this->paypal_class->add_field('return', base_url().'paypalcontroller/paypal_response_handler'); // return url
        $this->paypal_class->add_field('cancel_return', base_url().'/paypalcontroller/paypal_return_handler'); // cancel url

        $item_name = $this->paypal_class->add_field('item_name', $plan->name);
        //$amount = $this->paypal_class->add_field('amount', $plan->price);
        $amount = $this->paypal_class->add_field('amount', '10');

        $this->paypal_class->add_field('custom', $uidpid);

        $this->paypal_class->submit_paypal_post();
    }



    function payment_process()
    {

        $this->form_validation->set_rules('plan', 'Plan', 'required');

        if( $this->form_validation->run() === FALSE )
        {


            $this->load->view('pageheader');
		    $this->load->view('institutes/packagedetail/',$data);
	    	$this->load->view('pagefooter');
        }
        else
        {
             $plan_id=$this->input->post('plan');
             $userid=$this->session->userdata('userid');
            if($this->pricing_model->update_planid($userid))
            {
                $plandata= $this->pricing_model->getPlanData($plan_id);
                $planprice=$plandata->price;

               if(trim($planprice) == '0')
               {
                 echo '<script>location.href="'.base_url('institutes/').'";</script>';
               }
               else
               {

                      $uidpid= $plan_id."-".$userid;

                      $plan=$this->pricing_model->get_plan($plan_id);

                      $this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

                      $this->paypal_class->add_field('currency_code','USD');
                      $this->paypal_class->add_field('business', 'vikas.gorle@gmail.com');

                      $this->paypal_class->add_field('return', base_url().'paypalcontroller/paypal_response_handler'); // return url
                      $this->paypal_class->add_field('cancel_return', base_url().'/paypalcontroller/paypal_return_handler'); // cancel url

                      $item_name = $this->paypal_class->add_field('item_name', $plan->name);
                      //$amount = $this->paypal_class->add_field('amount', $plan->price);
                      $amount = $this->paypal_class->add_field('amount', '2');

                      $this->paypal_class->add_field('custom', $uidpid);

                      $this->paypal_class->submit_paypal_post();

               }




            }
            else
            {
               echo $this->lang->line('technical_problem');
            }
        }



}

     function paypal_return_handler(){
        //$this->Buyitem_model->updateOrder($order_id,$paidamt);
        redirect('pricing/');
	}

     function paypal_response_handler(){


       list($pid,$uid)= explode("-",$_REQUEST['custom']);
       $toemail=$_REQUEST['payer_email'];
       //$fromemail=$_REQUEST['receiver_email'];
       $fromemail='prashant@veerit.com';
       $txn_id=$_REQUEST['txn_id'];

       $today=date('Y-m-d H:i:s');
       $order_details = array(
                                    'plan_id' => $pid,
                                    'user_id' => $uid,
                                    'paymentstatus' => 'paid',
                                    'paymentdate' => $today,
                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
                                    'status' => '1'
                                    );


       $this->orders_model->insertData($order_details);
       $this->pricing_model->updatepaymentstep($uid);

           $message="Hi your payment received<br />Transaction ID : ".$txn_id;

            $config['protocol'] = 'sendmail';
            $config['charset'] = 'utf-8';
		    $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from($fromemail, 'Prashant');
            $this->email->to($toemail);
            $this->email->cc($fromemail);
            $this->email->subject('Payment Detail');
            $this->email->message($message);

            $this->email->send();

        redirect('institutes/');
	}

function response_handler()
{
    echo"<pre>";
    print_r($_REQUEST);
}

function return_handler()
{
    echo"<pre>";
    print_r($_REQUEST);
}

function paypal_box()
    {
        exit('yesss');
        $plan_id = 3;
        $user_id = 2;
        $response_handler = base_url().'paypalcontroller/response_handler';
        $return_handler = base_url().'paypalcontroller/return_handler';                                   
        $plan_name = "Advance";
        $plan_price = 200;
        $instituteid = "";

        if($instituteid)
        {
          $uidpid= $plan_id."-".$user_id."-".$instituteid; 
        }
        else
        {
          $uidpid= $plan_id."-".$user_id; 
        }  

        $this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

        $this->paypal_class->add_field('currency_code','USD');
        //$this->paypal_class->add_field('business',  'accountant-facilitator@sailors-club.net'); //  accountant@sailors-club.net  // accountant-facilitator@sailors-club.net  // vikas.gorle@gmail.com
        $this->paypal_class->add_field('business',  'paypal-facilitator@veerit.com');
        $this->paypal_class->add_field('return', $response_handler); // return url
        $this->paypal_class->add_field('cancel_return', $return_handler); // cancel url

        $item_name = $this->paypal_class->add_field('item_name', $plan_name);
        $amount = $this->paypal_class->add_field('amount', $plan_price);
        //$amount = $this->paypal_class->add_field('amount', '400');

        $this->paypal_class->add_field('custom', $uidpid);

        $this->paypal_class->submit_paypal_post();
        

    }

    function payment_process2()
    {
        // $sessionarray = $this->session->userdata('logged_in');    
        // $firstname = $sessionarray['first_name'];
        // $lastname = $sessionarray['last_name'];
        // $fullname = $firstname.' '. $lastname;
        // $email = $sessionarray['email'];
        // $user_id = $sessionarray['id'];
        // $pay_setting = $this->settings_model->getAccountMode();

        // if( !isset($user_id) || $user_id == 0)
        // {
        //   redirect('users/login');
        // }
        // else
        // {
        //     $program_id = $this->uri->segment(3);
        //     $this->session->set_userdata('program_id',$program_id);
        //     $price = $this->uri->segment(4);           
          
        //     $course_name = $this->settings_model->getProgramName($program_id);
        //     $paypalData = array(
        //     'userid' => $user_id,                 
        //     'courses' => $program_id,         
        //     'amount_paid' => $price         
        //     );
        //     $this->session->set_userdata('paypalData', $paypalData);

        // }
    }




}
