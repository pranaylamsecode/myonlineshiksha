<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restapiservices extends MLMS_Controller {

	
	
	function __construct()
	{		
		parent::__construct();		
		$this->load->model('restapiservices_model');	
		$this->load->model('settings_model');	
	}



	public function responses($status,$message,$response='',$id='')
	{

		if(isset($response) && $response != ''){

			return json_encode(array('status'=>$status,'message'=>$message,'data'=>$response));
			die;

		}elseif(isset($id) && $id != ''){

			return json_encode(array('status'=>$status,'message'=>$message,'id'=>$id));
			die;

		}elseif((isset($id) && $id != '') && (isset($response) && $response != '') ){

			return json_encode(array('status'=>$status,'message'=>$message,'id'=>$id,'data'=>$response));
			die;

		}else{

			return json_encode(array('status'=>$status,'message'=>$message));
			die;

		}

	}

	
	public function signUp()
	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST')
		{

			echo $this->responses(400,'Bad request.');
			//echo json_encode(array('status' => 400,'message' => 'Bad request.')); die;

		}
		else
		{
			
			$fname = trim($_POST['firstname']);
			$lname = trim($_POST['lastname']);
			$email = strtolower(trim($_POST['email']));			
			$password = trim($_POST['password']);
			$c_password = trim($_POST['confirmpassword']);
			$lenpass =strlen($password);
		  
			 if($password != $c_password)
			{
				echo $this->responses(400,'Password and confirm password is not equal.');
				
			}		
			else if($fname == '' || $lname == '' || $email== '' || $password == '' || $c_password == '')
			{
				echo $this->responses(400,'Please fill proper data.');
				
			}
			else if($this->restapiservices_model->email_exists($email))
			{

				echo $this->responses(400,'Email Already Exist.');
				

			}
			else if($lenpass < 6)
			{
					
				echo $this->responses(400,'Password atleast 6 digits');
					
			}
			else
			{
				    $activationcode=$this->getActivationCode();
					$activationcode=md5($activationcode);
					
		            $data = array(
		      			'username'		=>	$email,
		      			'email'			=>	$email,
		      			'first_name' 	=> 	$fname,
		      			'last_name' 	=> 	$lname,
		      			'images'        =>  'default.jpg',
		                'active' 	    =>  '0',
						'is_student' 	=>  '1',//one is for yes
						'is_instructor'	=>  '0',//zero is for no
		                'created_at' 	    =>  date('Y-m-d H:i:s'),
		                'password' 		=>  md5($password),
		                'activation_code' 		=> $activationcode,
		                'group_id' 		=>  '1',
		                'webstatus' 	=> 	''
					);
					
					$usergroups = '1';
					$insertid = $this->restapiservices_model->insertData('mlms_users',$data);
					 
					if($insertid > 1)
					{
						$user_id = $this->restapiservices_model->maxuserid();
						$group_data = array(
							'user_id'		=>	$insertid,
							'group_id'      =>  $usergroups
						);
					$this->restapiservices_model->insertData('mlms_users_groups', $group_data);
					// =========================================

					// =========================================
					
					echo $this->responses(201,'Data save Successfully',$data);



					}

			}

		}


	}


	function getActivationCode() 
	{
	    
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


	public function login()
	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST')
		{
			echo $this->responses(400,'Bad request.');			

		}
		else
		{

			$email = isset($_POST['email']) ? $_POST['email'] : "";

			$password = isset($_POST['password']) ? $_POST['password'] : "";

			//$groupid = isset($_POST['groupid']) ? $_POST['groupid'] : "";


			if(strlen($email) == 0 || strlen($password) == 0)
			{
			 
				echo $this->responses(401,'Missing Parameter');

			}

			$email = strtolower(trim($_POST['email']));		
			$password = trim($_POST['password']);				
			$result = $this->restapiservices_model->newvalidate($email, $password);
			       
			if($result)       
			{	
				$data = array(
					'id' => $result->id,
					'groupid' => $result->gid,
                    'fbsql_username(link_identifier)' => $result->username,
					'first_name' => $result->first_name,
					'last_name' => $result->last_name,
					'email' => $result->email,
                    'group' => $result->title,
                    'validated' => true,
                    'avatarURL' =>"http://create-online-academy.com/public/uploads/users/img/thumbs/".$result->images,
                    'is_student'=>$result->is_student
					);

				//return array('status' => 201,'message' => 'Successfully login.','data' => $data);

				echo $this->responses(201,'Successfully login.',$data);	
			}
			else
			{		
				echo $this->responses(403,'Authentication Failed');	
				//return array('status' => 403,'message' => 'Authentication Failed');	
			}    
		}   
		
	}


	public function myallcourse()
	{
				
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'GET')
		{
			echo $this->responses(400,'Bad request.');			

		}
		else
		{

			$results = $this->restapiservices_model->myallcourse(1);
			       
			if($results)       
			{	
				$i = 0;
			    $data = array();

				foreach ($results as $result ) 
				{

					$datatemp = array(
					'id' => $result->id,
					'course_id' => $result->course_id,
					'course_name' => $result->course_name,
					'fixedrate' => $result->fixedrate,
					'price' => $result->price,
					'image' => "http://create-online-academy.com/public/uploads/programs/img/thumb_232_216/".$result->image,
					'description'=>$result->description,					
					);

					array_push($data, $datatemp);
				
				}
							

				echo $this->responses(201,'Success',$data);	
			}
			else
			{		
				echo $this->responses(403,'Failed');	
					
			}    
		}   
		
	}



}
	