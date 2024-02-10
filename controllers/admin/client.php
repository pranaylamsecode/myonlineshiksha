<?php
// Client File ( Client.php )
class Client extends CI_Controller
{
// User's Login Credentials
function __construct() {
parent::__construct();
	$this->load->model('admin/settings_model');
	$config =array('server' => 'https://www.createonlineacademy.com',
					'api_key' => 'REST API',
					'api_name' => 'X-API-KEY',
					'http_user' => 'admin',
					'http_pass' => '1234',
					'http_auth' => 'basic',
					);

		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
		error_reporting(0);
//$this->load->library('rest');

$this->rest->initialize($config);
}

function getExpireDays()
{
	$this->load->database();
	
	$getExpireDays = $this->settings_model->getExpireDays(1,'mlms_academydetails');
	if($getExpireDays->status==0)
	{
		$id = "db"; //$this->uri->segment(4);
		$this->rest->format('application/json');
		$params = substr($this->db->database,9); //$this->uri->segment(5);
		$user = $this->rest->get('api/renewacademy/data/'.$id.'/'.$params, '','application/json');

		echo json_encode($user);
		//$this->rest->debug();
		$form_data = array(
			'academy_plan' => $user->name,
			'academy_plan_id'=>$user->plan_id,
			'academy_price' => $user->price,
			'academy_created' => $user->createdon,
			'academy_expired' => $user->expireson,
			'status' => 1, );
		$getExpireDays = $this->settings_model->updateExpireDays($form_data,'mlms_academydetails');

	}
	else
	{

	}
}

function newpayment()
{	
		$this->authenticate();
		$this->load->database();
    	$id = "db"; //$this->uri->segment(4);
		$this->rest->format('application/json');
		$params = substr($this->db->database,9); //$this->uri->segment(5);
		$user = $this->rest->get('api/renewacademy/paymentProcess/'.$id.'/'.$params, '','application/json');
		//print_r($user);
		$user_id = $user->user_id;
		$id = $user->id;
		//$price = $user->price;
		//$name = $user->name;
		//redirect('https://www.createonlineacademy.com/paypalforothersite/payment_process');    
		redirect('https://www.createonlineacademy.com/paypalforothersite/payment_process/'.$id.'/'.$user_id);    
}

function renewpayment()
{	
		$this->authenticate();
		$this->load->database();
    	$id = "db"; //$this->uri->segment(4);
		$this->rest->format('application/json');
		$params = substr($this->db->database,9); //$this->uri->segment(5);
		$user = $this->rest->get('api/renewacademy/paymentProcess/'.$id.'/'.$params, '','application/json');
		//print_r($user);
		$user_id = $user->user_id;
		$id = $user->id;

		$plan_id = $this->uri->segment(4);
		//$price = $user->price;
		//$name = $user->name;
		//redirect('https://www.createonlineacademy.com/paypalforothersite/payment_process');    
		redirect('https://www.createonlineacademy.com/paypalforothersite/upgrade_process/'.$plan_id.'/'.$user_id);    
}

function authenticate()
    {   	 
 	$session = $this->session->userdata('loggedin');
      if(!$session)
      {
       redirect('admin/users/login');
      }
      else if($session['groupid'] == 4 || $session['groupid'] == 2)
      {
      }
      else{
      	$this->session->unset_userdata("loggedin");
      	redirect('admin/users/login');
      }
    }



    public function payment_response()
    {
    	$this->load->database();
		$id = "db"; //$this->uri->segment(4);
		$this->rest->format('application/json');
		$params = substr($this->db->database,9); //$this->uri->segment(5);
		$user = $this->rest->get('api/renewacademy/data/'.$id.'/'.$params, '','application/json');

		//echo json_encode($user);
		//$this->rest->debug();
		$form_data = array(
			'academy_plan' => $user->name,
			'academy_price' => $user->price,
			'academy_created' => $user->createdon,
			'academy_expired' => $user->expireson,
			'status' => 1, );
		
		$getExpireDays = $this->settings_model->updateExpireDays($form_data,'mlms_academydetails');
		redirect('admin');
    }

    function getplanfeatures()
	{			
		$user = $this->rest->get('api/renewacademy/planfeatures/', '','application/json');
		echo json_encode($user);
	}


}
?>