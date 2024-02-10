<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restapiservices extends MLMS_Controller {

	
	
	function __construct()
	{		
		parent::__construct();		
		//$this->load->model('Restapiservices_model');		
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
	}

	
	public function signUp()
	{
		$firstname = $_POST['firstname'];

		$lastname = $_POST['lastname'];

		$email = $_POST['email'];

		$password = $_POST['password'];

		$confirmpassword = $_POST['confirmpassword'];

		$data = array('firstname' =>$firstname,
					  'lastname' =>$lastname,
					  'email' =>$email,
					  'password' =>$password,
					  'confirmpassword' =>$confirmpassword);

		echo json_encode(array('status' => 201,'message' => 'success','data'=>$data));

	}

}
	