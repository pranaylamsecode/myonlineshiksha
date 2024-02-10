<?php defined('BASEPATH') OR exit('No direct script access allowed');
class member_login extends MLMS_Controller
{
	function __construct()
    {
    	parent::__construct();
    	$this->load->model('login_model');
    }

    public function index()
    {
    	$this->load->view('partner/partner_login');
    }

    public function registration()
    {
		$fname = trim($_POST['firstname']);
		$lname = trim($_POST['lastname']);
		$email = strtolower(trim($_POST['email']));
		//$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$c_password = trim($_POST['password_confirm']);
		$lenpass =strlen($password);
	  
		 if($password != $c_password)
		{
			echo 'Password and confirm password is not equal...';
		}		
		else if($fname == '' || $lname == '' || $email== '' || $password == '' || $c_password == '')
		{
			echo "Please fill proper data...";
		}
		else if($this->login_model->email_exists($email))
		{
				echo "Email Already Exist.";
		}else if($lenpass < 6)
		{
				echo"Password atleast 6 digits";
		}
		else
		{
			$ref = $this->randomPassword(8);
			$data = array(
      			'username'		=>	$email,
      			'email'			=>	$email,
      			'first_name' 	=> 	$fname,
      			'last_name' 	=> 	$lname,
      			'images'        =>  'default.jpg',
                'active' 	    =>  '0',
				'is_student' 	=>  '0',//one is for yes
				'is_instructor'	=>  '0',//zero is for no
                'created_at' 	=>  date('Y-m-d H:i:s'),
                'password' 		=>  md5($password),
                'group_id' 		=>  '5',
                'referral_code' =>  $ref,
			);
			$usergroups = '5';
			$insertid = $this->login_model->insertItems($data);
			 
			if($insertid > 1)
			{
				$user_id = $this->login_model->maxuserid();
				$group_data = array(
					'user_id'		=>	$insertid,
					'group_id'      =>  $usergroups
				);
				$this->login_model->insertUserGroup($group_data);
			}
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Registered Successfully, Account Activation Link has been Sent To Your Mail,Please Check Your Mail') );		
			echo 'success';					
    	}
    }

    function email_exists($email) 
	{
	    $check_email = $this->login_model->email_exists($email);
	    if($check_email > 0) 
		{
	        $this->form_validation->set_message('email_exists', 'This email is already in use');
	        return FALSE;
	    }
	    else 
		{
	        return TRUE;
	    }
	}

	function randomPassword($length) {
	   $alphabet = "MaG9BdWeFn7pTqCDz0R1fgKhZvJiXjkUoL2bQcN83ErsYtOxIy4P5uSw6lHmA";
	   //$alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
	   $pass = array(); //remember to declare $pass as an array
	   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	   for ($i = 0; $i < $length; $i++) {
	       $n = rand(0, $alphaLength);
	       $pass[] = $alphabet[$n];
	   }
	   return implode($pass); //turn the array into a string
	}
	
	public function loginPopup()
	{
		if($this->session->userdata('logged_in'))
		{
			$last_page_url = $this->session->userdata('last_page_url');
			if($last_page_url == '')
			{
               echo 'myinfo/myaccount';
            }
			else
			{
                echo $last_page_url;
            }
		}
		$email = strtolower(trim($_POST['email']));
		$password = trim($_POST['password']);
		$result = $this->login_model->newvalidate($email, $password);
		if($result == true)
		{	
			$last_page_url = $this->session->userdata('last_page_url');
			$dataNew= $this->login_model->setSessionData($email,$password);
			$session = $this->session->set_userdata('loggedin',$dataNew);
		}
	}

}