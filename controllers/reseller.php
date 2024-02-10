<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reseller extends MLMS_Controller {

  function __construct()
	{
		parent::__construct();
		$this->config->load('installation_config');
		
        $this->load->model('admin/settings_model');	
        $this->load->model('login_model');	
        $this->load->model('reseller_model');	
		$configarr = $this->settings_model->getItems();	
	    $this->template->set_layout($configarr[0]['layout_template']);
		$this->load->model('admin/Pagecreator_model');
        
        $this->load->library('phpqrcode/qrlib');
		$this->template->set("configarr", $configarr);
		$this->load->model('Crud_model');
		error_reporting(0);
	}

	public function index()
	{
		$data = array(
					'first_name' => set_value('first_name'),
					'last_name' => set_value('last_name'),
					'email' => set_value('email'),
					'contact_no' => set_value('contact_no'),
		);
		$this->load->view('new_template_design/header');
		$this->load->view('reseller/reseller_view',$data);	
		$this->load->view('new_template_design/footer');
	}

	function randomPassword($length) {
	   $alphabet = "a9den7pqz01fghijko2bc83rstxy45uw6lm";
	   //$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	   $pass = array(); //remember to declare $pass as an array
	   $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	   for ($i = 0; $i < $length; $i++) {
	       $n = rand(0, $alphaLength);
	       $pass[] = $alphabet[$n];
	   }
	   if($this->login_model->getReffCode(implode($pass)))
	   {
	       $this->randomPassword(8);
	   }
	   return implode($pass); //turn the array into a string
	}

	function email_exists() 
	{
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
	    $check_email = $this->login_model->email_exists($email);
	    $checkmobile = $this->Crud_model->get_single('mlms_users',"mobile = '".$mobile."'",'mobile');

	    if($check_email > 0) 
		{
	        echo "1";
	    }
	    else if(!empty($checkmobile))
	    {
	    	echo "2";
	    }
	    else 
		{
	        echo "0";
	    }
	}

	public function registration()
    {
		$fname = $this->input->post('first_name');
		$lname = $this->input->post('last_name');
		$email = strtolower($this->input->post('email'));
		$password = $this->input->post('password');
		$contact_no = $this->input->post('contact_no');

		if(empty($fname))
		{
			redirect();
		}
		else if(empty($lname))
		{
			redirect();
		}
		else if(empty($contact_no))
		{
			redirect();
		}else{
			$ref = $this->randomPassword(8);
			if($email == '')
			{
				$email = $ref."@mos.com";
			}
			$data = array(
			  			'username'		=>	$email,
			  			'email'			=>	strtolower($email),
			  			'first_name' 	=> 	$fname,
			  			'last_name' 	=> 	$lname,
			  			'images'        =>  '',
			            'active' 	    =>  '0',
						'is_student' 	=>  '0',//one is for yes
						'is_instructor'	=>  '0',//zero is for no
			            'created_at' 	=>  date('Y-m-d H:i:s'),
			            'password' 		=>  md5($password),
			            'group_id' 		=>  '5',
			            'referral_code' =>  $ref,
			            'mobile'		=>  $contact_no
			);
			$usergroups = '5';
			$insertid = $this->login_model->insertItems($data);
			
			// qr code for resellers 
			$text1234 = base_url()."category/courses?ref=".$ref;
	      	$SERVERFILEPATH = getcwd().'/public/uploads/resellers_QR/';
	       
	      	$text1= $ref;
	      
	      	$folder = $SERVERFILEPATH;
	      	$file_name1 = $text1."-Qrcode".rand(0,9999).".png";
	      	$file_name = $folder.$file_name1;
	      	QRcode::png($text1234,$file_name,8,8);
	      	$form_data = array(
		                'referral_qr' => $file_name1,
		                'url_link' => $text1234,
			);
			$this->reseller_model->updateItem($insertid , $form_data);


			if($insertid > 1)
			{
				$user_id = $this->login_model->maxuserid();
				$group_data = array(
								'user_id' => $insertid,
								'group_id' => $usergroups
				);
				$this->login_model->insertUserGroup($group_data);
				
				$pay_data = array(
								'user_id' => $insertid,
								'modified' => date('Y-m-d H:i:s')
				);
				$this->Crud_model->SaveData('mlms_payout',$pay_data);
				$assess_data = array(
									'user_id' => $insertid,
									'ass_type' => 1,
									'assessment' => '15',
									'created' => date('Y-m-d H:i:s'),
									'modified' => date('Y-m-d H:i:s'),
				);
				$this->Crud_model->SaveData('mlms_assessment',$assess_data);
			}
			
			$con = "id = ".$insertid;
			$result = $this->Crud_model->get_single('mlms_users',$con,'id, group_id, username, first_name, last_name, email, referral_code, referral_qr,business_name');

			if(!empty($result))
			{	
				$this->login_model->reseller_session($result->group_id);
				$data = array(
							'id' => $result->id,
							'groupid' => $result->group_id,
		                    'user_name' => $result->username,
							'first_name' => $result->first_name,
							'last_name' => $result->last_name,
							'email' => $result->email,
		                    'modper' => $modpermission,
		                    'validated' => true,
		                    'referral_code' =>$result->referral_code,
		                    'referral_qr' => $result->referral_qr,
		                    'business_name' => $result->business_name
				);
				// $session = $this->session->set_userdata('logged_in',$data);
				$this->session->set_userdata('reg_msg',"done.");
				redirect('become-a-reseller');
			}
		}

    }

    public function loginPopup()
	{
		$email = $this->input->post('login_email');
		$password = $this->input->post('login_password');
		$con = "group_id = 5 AND password = '".md5($password)."' AND email = '".$email."' OR mobile = '".$email."'";
		$result = $this->Crud_model->get_single('mlms_users',$con);
		
		if(!empty($result))
		{	
			$this->login_model->reseller_session($result->group_id);
			$data = array(
						'id' => $result->id,
						'groupid' => $result->group_id,
	                    'user_name' => $result->username,
						'first_name' => $result->first_name,
						'last_name' => $result->last_name,
						'email' => $result->email,
	                    'modper' => $modpermission,
	                    'validated' => true,
	                    'referral_code' =>$result->referral_code,
	                    'referral_qr' => $result->referral_qr,
			);
			$session = $this->session->set_userdata('logged_in',$data);
			redirect('partner/coupons');
		}else
		{
			redirect('become-a-reseller');
		}
	}
	public function validate()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$con = "email = '".$email."'";
		$result = $this->Crud_model->get_single('mlms_users',$con);
		if(!empty($result))
		{
			echo "0";
		}
		else{
			echo "1";
		}
	}

	public function validate1()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$con = "(email = '".$email."' OR mobile = '".$email."') AND password = '".md5($password)."' AND group_id = 5";
		$result = $this->Crud_model->get_single('mlms_users',$con);
		// echo $this->db->last_query();exit;
		if(!empty($result))
		{
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function settings()
	{	
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth)){ 
			$con = "id = ".$auth['id'];
			$reseller = $this->Crud_model->get_single('mlms_users',$con,'id,first_name,last_name,email,mobile,business_name,images');
			$data = array(
						'reseller' => $reseller
			);
			$this->template->set_layout('backend');
			$this->template->build('reseller/reseller_settings',$data);
		}
		else
		{
			redirect(base_url());
		}
	}

	public function update_setting()
	{	
		$reseller_id = $this->input->post('reseller_id');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$last_name = $this->input->post('last_name');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$business_name = $this->input->post('business_name');
		$password = $this->input->post('password');
		$con = "id =".$reseller_id;
		$getresell = $this->Crud_model->get_single('mlms_users',$con,'mobile,business_name,password');
		if($mobile ==""){
			$mobile = $getresell->mobile;
		}
		else{
			$mobile = $mobile;
		}
		if($business_name ==""){
			$business_name = $getresell->business_name;
		}
		else{
			$business_name = $business_name;
		}
		if($password ==""){
			$password = $getresell->password;
		}
		else{
			$password = md5($password);
		}

		if($_FILES['profile']['name']!='')
    	{
	        $_POST['profile']= rand(0000,9999)."_".$_FILES['profile']['name'];
	        $config2['image_library'] = 'gd2';
	        $config2['source_image'] =  $_FILES['profile']['tmp_name'];
	        $config2['new_image'] =   getcwd().'/public/uploads/users/img/'.$_POST['profile'];
	        $config2['upload_path'] =  getcwd().'/public/uploads/users/img/';
	        $config2['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
	        $config2['maintain_ratio'] = FALSE;
	        $config2['width']  = 1024;
            $config2['height'] = 768;
	        $this->image_lib->initialize($config2);
	        if(!$this->image_lib->resize())
	        {
	            echo('<pre>');
	            echo ($this->image_lib->display_errors());
	            exit;
	        }
	        $image  = $_POST['profile'];
	        if (!empty($_POST['old_image'])) {
	        	unlink('public/uploads/users/img/'.$_POST['old_image']);
	        }

	        /*$config3['image_library'] = 'gd2';
	        $config3['source_image'] =  $_FILES['profile']['tmp_name'];
	        $config3['new_image'] =   getcwd().'/public/uploads/users/img/thumbs/'.$_POST['profile'];
	        $config3['upload_path'] =  getcwd().'/public/uploads/users/img/thumbs/';
	        $config3['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
	        $config3['create_thumb'] = TRUE;
	        $config3['maintain_ratio'] = FALSE;
	        $config3['width']  = 75;
            $config3['height'] = 75;
	        $this->image_lib->initialize($config3);
	        if(!$this->image_lib->resize())
	        {
	            echo('<pre>');
	            echo ($this->image_lib->display_errors());
	            exit;
	        }
	        if (!empty($_POST['old_image'])) {
	        	unlink('public/uploads/users/img/thumbs/'.$_POST['old_image']);
	        }*/
	    }
	    else
	    {
	        $image  = $_POST['old_image'];
	    }

		$data = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'mobile' => $mobile,
					'business_name' => $business_name,
					'images' => $image,
					'password' => $password,
					'email' => $email
		);
		$this->Crud_model->SaveData('mlms_users',$data,$con);
		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Profile updated Successfully.'));
		redirect(base_url('partner/settings'));
	}
//  function used for demo programs and queries

// function for changing students count and reviews
	public function manage_students()
	{	
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth) && $auth['groupid']=='4' ){ 
			// $this->Crud_model->DeleteData('demo_data');
			$courses = $this->Crud_model->count_review("p.published = 1 AND p.trash = 0");
			$data = array(
						'coursess' => $courses
			);
			$this->template->set_layout('backend');
			$this->template->build('admin/counting/student_count',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function update_count()
	{
		$course_id = $this->input->post('course_id');
		$stud_count = $this->input->post('stud_count');
		$rev_count = $this->input->post('rev_count');
		$getcourse = $this->Crud_model->get_single('demo_data',"course_id = ".$course_id);
		$data = array(
					'course_id' => $course_id,
					'student_count' => $stud_count,
					'review_count' 	=> $rev_count
		);
		if(!empty($getcourse))
		{
			$con = "course_id = ".$course_id;
			$this->Crud_model->SaveData('demo_data',$data,$con);
		}
		else
		{
			$this->Crud_model->SaveData('demo_data',$data);
		}
		// echo "Updated.";
		$courses = $this->Crud_model->count_review("p.published = '1' AND p.trash = '0'");
			$html = "";
		foreach ($courses as $key) {
			$html .= "<option value='".$key->id."' ";
			if($course_id == $key->id)
				$html .= ' selected ';
					
			$html .= ">".$key->name." - ( ".$key->student_count." )</option>";
		}
		echo $html;
	}

	public function update_counts()
	{
		$course_id1 = $this->input->post('course_id1');
		$rev_count = $this->input->post('rev_count');
		$getcourse = $this->Crud_model->get_single('demo_data',"course_id = ".$course_id1);
		$data = array(
					'course_id' 	=> $course_id1,
					'review_count' 	=> $rev_count
		);
		if(!empty($getcourse))
		{
			$con = "course_id = ".$course_id1;
			$this->Crud_model->SaveData('demo_data',$data,$con);
		}
		else
		{
			$this->Crud_model->SaveData('demo_data',$data);
		}
		$courses = $this->Crud_model->count_review("p.published = '1' AND p.trash = '0'");
			$html = "";
		foreach ($courses as $key) {
			$html .= "<option value='".$key->id."'>".$key->name." - ( ".$key->review_count." )</option>";
		}
		echo $html;
	}
// function for changing students count and reviews;
// create resellers qr-code
	public function manage_reseller()
	{	
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth) && $auth['groupid']=='4' ){ 
			// $this->Crud_model->DeleteData('demo_data');
			
			$this->template->set_layout('backend');
			$this->template->build('admin/counting/reseller_qr');
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function manage_resellers_coupons()
	{	
		/*$getusers = $this->Crud_model->GetData('mlms_users','',"id = 29");
		print_r($getusers);exit;*/
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth) && $auth['groupid']=='4' ){ 
			// $this->Crud_model->DeleteData('demo_data');
			$getusers = $this->Crud_model->GetData('mlms_users','',"group_id = 5 AND first_name != '0' AND first_name != ''");
			$data = array(
						'users' => $getusers,
			);
			$this->template->set_layout('backend');
			$this->template->build('admin/counting/reseller_coupons',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function create_coupons()
	{
		$user_id = $this->input->post('user_id');
		$quantity = $this->input->post('quantity');
		if($quantity=='' && $quantity == 0)
		{
			$quantity = 20;
		}
		for ($i=0; $i < $quantity; $i++) { 
			$coupon_code = $this->randomcode();
			$data = array(
						'user_id' => $user_id,
						'coupon_code' => $coupon_code,
						'created' =>date('Y-m-d H:i:s')
			);
			$this->Crud_model->SaveData('mlms_reseller_coupon',$data);
			if($i==0)
			{
				$last_id = $this->db->insert_id();
			}
		}
		echo $last_id;
	}

	public function printdata()
	{
		$last_id = $_POST['data1'];
		$con = "status = 'Unused' AND id >= ".$last_id;
		$getdata = $this->Crud_model->GetData('mlms_reseller_coupon','',$con);
		// print_r($getdata);
		$data = array(
					'coupon_data' => $getdata,
		);
		$this->load->view('reseller/save_print',$data);
	}

	function randomcode() {
		$coupon = rand(10000,99999);
		$getcode = $this->Crud_model->get_single("mlms_reseller_coupon","coupon_code = '".$coupon."'");
	   	if(!empty($getcode))
	   	{
	       	$this->randomcode();
	   	}
	   	return $coupon;
	}

	public function insert_reviews()
	{
		error_reporting(E_ALL);
		// print_r($_FILES);exit;
		$review_rate = $this->input->post('review_rate');
		$title = $this->input->post('review_title');
		$description = $this->input->post('description');
		$program_id = $this->input->post('course_id2');
		if(empty($program_id)){
			$this->session->set_userdata('message','no course selected.');
			redirect('admin/manage-students');
			exit;
		}
		$user_id = $this->input->post('user_id');
		$customer_name = $this->input->post('customer_name');
		$review_date = $this->input->post('review_date');
		if($_FILES['customer_profile']['name']!='')
    	{
	        $_POST['customer_profile']= rand(0000,9999)."_".$_FILES['customer_profile']['name'];
	        $config2['image_library'] = 'gd2';
	        $config2['source_image'] =  $_FILES['customer_profile']['tmp_name'];
	        $config2['new_image'] =   getcwd().'/public/images/review_users/'.$_POST['customer_profile'];
	        $config2['upload_path'] =  getcwd().'/public/images/review_users/';
	        $config2['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
	        $config2['maintain_ratio'] = TRUE;
	        $config2['width']  = 150;
            $config2['height'] = 150;
	        $this->image_lib->initialize($config2);
	        if(!$this->image_lib->resize())
	        {
	            echo('<pre>');
	            echo ($this->image_lib->display_errors());
	            exit;
	        }
	        $image  = $_POST['customer_profile'];
	    }
	    else
	    {
	        $image  = '';
	    }

		if(empty($review_date))
			$review_date = date('Y-m-d');
		if(empty($review_rate))
			$review_rate = 1;
		if(empty($title))
			$title = ' ';

		$data = array(
					'review_rate' 		=> $review_rate,
					'title' 			=> $title,
					'description' 		=> $description,
					'program_id' 		=> $program_id,
					// 'user_id' 			=> $user_id,
					'external' 			=> 1,
					'customer_name' 	=> $customer_name,
					'customer_profile' 	=> $image,
					'review_date' 		=> date("Y-m-d",strtotime($review_date))
		);
		$this->Crud_model->SaveData('mlms_review',$data);
		redirect('admin/manage-students');
	}
}
?>
