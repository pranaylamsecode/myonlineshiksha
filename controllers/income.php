<?php
 // Program for frontend(user)
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Income extends MLMS_Controller 
{
	var $configarr;
	function __construct()
	{
		parent::__construct();
		//$this->authenticate();
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
		$this->load->model('admin/medias_model');
		$this->load->model('medias_model');
        if($this->uri->segment(2) != 'teach_info' && $this->uri->segment(2) != 'preview' && $this->uri->segment(2) != 'payment')
		{
			$configarr = $this->settings_model->getItems();	
					date_default_timezone_set($configarr[0]['time_zone']);	

			$this->configarr = $configarr;
			$this->template->set_layout($configarr[0]['layout_template']);
			$this->template->set("configarr", $configarr);

		}	
		$this->load->library('email');
		$this->load->library('form_validation');
        //$this->load->helper('unirowclient');
		//$longlife = 60*60*24*60; //60 days
		//$shortlife = 60*60*24*10; //10 days
		//$this->input->set_cookie('LongRemember', $user.'::'.$hashbrown, $longlife, '.example.com', '/');		
	}
	
   /*	function authenticate()
    {
      $session = $this->session->userdata('logged_in');
      if(!$this->session->userdata('logged_in'))
      {
	   
       redirect('users/login');
      }
    } */
	
	
	
	
	
	
	
	public function lists($parent_id = NULL)
	{
	   $u_data = $this->session->userdata('logged_in');
	   
		$maccessarr=$this->session->userdata('maccessarr');
		
		if(($u_data['groupid'] == 4) || ($maccessarr['courses']=='own') || ($maccessarr['courses']=='modify_all'))
	
	   {
	     error_reporting(0);
        if(isset($_POST) && !empty($_POST))
		{
            if(isset($_POST['order']))
            {
             $this->reorder_fun($_POST);
            }
        }
		
		$sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
		
        $parent_id = NULL;
        $this->session->unset_userdata('sess_programs');
        $this->template->title('Courses List');
	    $configarr = $this->settings_model->getItems(); 
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl); 
		$this->template->set('updType', 'create');
		$this->template->set('user_id', $user_id);
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$sess_programs = $this->session->userdata('sess_programs');

		if($this->input->post('reset') == 'Reset')
		{
			$search_string = $this->input->post('search_text', TRUE);
			$search_status = $this->input->post('status', TRUE);
			$search_cate = $this->input->post('catid', TRUE);
			$this->session->unset_userdata('sess_programs');
			$search_string = '';
			$search_status = '';
			$search_type = '';
		}
		else
		{
			$search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_programs['searchterm'];
			$search_status = ($this->input->post('status') == '1' || is_numeric($this->input->post('status')) && $this->input->post('status') == '0') ? $this->input->post('status') : $sess_programs['searchstatus'];
			$search_cate = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_programs['searchtcate'];
			$searchdata = array(
					 "searchterm" => $search_string,
					 "searchstatus" => $search_status,
					 "searchtcate" => $search_cate
					 );
			$this->session->set_userdata('sess_programs', $searchdata);
		}
	
		$path=base_url() . "programs/lists/";
	
		$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
		$baseurl = base_url() . "programs/lists";
		$this->load->library('pagination');
		$config["base_url"] = $baseurl;
		$config['per_page'] = 10;
		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->program_model->getprogramcount($search_string,$search_status,$search_cate,$user_id);		
		$this->template->title('Courses List');
		$this->pagination->initialize($config);
		//new code
		
	
		/*** V S **/
	
		$u_data=$this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		
		if(($u_data['groupid']==='4') || (@$maccessarr[2]=='modify_all'))
			$progassign=$this->program_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$user_id);
		else
		$progassign=$this->program_model->externalcourse_list($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$u_data['id'],$user_id);
	    
		/** V E **/
	
		$this->template->set("programs",$progassign);
		$this->template->set('categories',$this->programs_model->getcategories());
		$this->template->set("search_string", $search_string);
		$this->template->set("status", $search_status);
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('income/list');
		}
		else
		{
		 // $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to Copy any course' ));
		
			redirect('category/pagenotfound');
		}
	}	
	
	public function myBuyers($id = NULL)
	{	       
	    $sessionarray = $this->session->userdata('logged_in');
		
        $u_id = $sessionarray['id'];
		//$enroll=$this->programs_model->getEnrollstudentslist($id);
		$course = $this->uri->segment(3);
		$enroll = $this->program_model->getPurchasedUser($course,$u_id);
		
		$unwithdraw_list=$this->program_model->getUnWithdrawList($u_id,$course);
		
		$request_list=$this->program_model->getWithdrawRequestList();	
       
	
		$total_amt = $this->program_model->getTotalAmount($course);
		$this->template->set("total_amt",$total_amt);
		$this->template->set("request_list",$request_list);
		$this->template->set("default_plans", $this->program_model->getDefaultPlans($course));
		$this->template->set("unwithdraw_list",$unwithdraw_list);
		$this->template->set("enroll",$enroll);
		$configarr = $this->settings_model->getItems(); 
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
		
		$this->template->build('income/withdraw');
	}
	
	

   

	function enroll()
    {
		
	     if(!$this->session->userdata('logged_in'))
		  {
		   
		   redirect('users/login');
		  }
		$this->load->model('Program_model');
		$sessionarray = $this->session->userdata('logged_in');
		 $user_id = $sessionarray['id'];
		 $group_id = $sessionarray['groupid']; 
		
		$course_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
        if (!$course_id)
		{
			redirect('category/');
		}
		$course_page = 'programs/programs/'.$course_id;
		$graybox = "false";
		$registered_user = "";
		//$sql = "SELECT chb_free_courses, step_access_courses, selected_course  FROM `#__guru_program` where id = ".intval($course_id);
        $programplan = $this->Program_model->getProgramPlan($course_id);

        //print_r($programplan); exit;
		$result = $this->Program_model->getProgram($course_id);
        $plan_id = (isset($programplan->plan_id)) ? $programplan->plan_id : '';

		//$result= $db->loadAssocList();
		$chb_free_courses = (isset($result->chb_free_courses)) ? $result->chb_free_courses : '';
		$step_access_courses = (isset($result->step_access_courses)) ? $result->step_access_courses : '';
		$selected_course = (isset($result->selected_course)) ? $result->selected_course : '';
		if($graybox == "true" || $graybox == "1")
		{
			
			//$model = $this->getModel("guruProgram");
			$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
			
           
			if($result == 'now')
			{			
				$msg = "Enrolled Successfully!! You can find this course under 'my courses' page";
			}
			else
			{
				
				$msg = "You have successfully enrolled to the course. Begin learning now!";				
			}
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $msg ));
			
			//redirect('programs/lectures/'.$course_id);
					
			//$_SESSION["joomlamessage"] = $msg;

			
		}
		
		if( !isset($user_id) || $user_id == 0)
		{
			redirect('users/login');
		}
		else
		{
		  
			//now become a student , update a is_student field from student table
			$data_user = $this->Program_model->getUserInfo($user_id);		
			
			
			if($data_user->is_student == 0)
			{
			   
				$this->Program_model->updateStudent($user_id);
			}
						
			//for admin
			if($group_id == 4 || $result->author == $user_id)
			{
				$where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id), 'order_id >=' =>  '0');
				$adresult = $this->Program_model->getBuyCourses($where);
				$adresult = count($adresult);
				if($adresult == 0 )
				{
					$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);			
				}
				else
				{
					redirect($course_page);
				}
			}
			
			//end		
		
			//$model = $this->getModel("guruProgram");
			//if(isset($registered_user) && $registered_user == 1){
			if(isset($user_id) && $user_id != 0)
			{ 
			 
				if($chb_free_courses == 1 && $step_access_courses !=0)
				{ 
				  
					$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
				}
				elseif($chb_free_courses == 1 && $step_access_courses ==0 && $selected_course ==-1)
				{
				  
					if($this->hasAtLeastOneCourse($course_id)){
					
						$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
					}
					else{
					   
						redirect($course_page);
					}				
				}
				elseif($chb_free_courses == 1 && $step_access_courses ==0 && $selected_course !=-1)
				{
					if($this->buySelectedCourse($selected_course))
					{
					  
						$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
					}
					else
					{
						redirect($course_page);
					}
				}
				else
				{
					
					$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
					
				}
			}
			
			
			/*else{
				if($chb_free_courses == 1 && $step_access_courses ==0 && $selected_course !=-1){
					if($this->buySelectedCourse($selected_course)){
						$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
					}
					else{
						redirect($course_page);
					}
				}
				else{
					$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
				}
			}	*/
			//$course_page = JRoute::_("index.php?option=com_guru&view=guruPrograms&cid=".$course_id."&Itemid=".$Itemid, false);
			
			if(isset($user_id) && ($step_access_courses == 0)){
			
				$result = ""; 
			}		
			
			
			if($result == 'now')
			{	
			  
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully! You can find this course under 'my courses' page" ));
			    
				$this->load->model('myinfo_model');
				
				$configarr = $this->settings_model->getItems();
				$programinfo = $this->Program_model->getProgram($course_id); 
				
				//$programinfo = $programinfo[0];
				$programinfo->id;
				$programinfo->name;
				$programinfo->author;
				
				$userdetail = $this->myinfo_model->getUser($user_id);
				
				$userdetail->email;
				$userdetail->first_name;
				$userdetail->last_name;
				
				$authordetail = $this->myinfo_model->getUser($programinfo->author);
				
				$authordetail->email;
				$authordetail->first_name;
				$authordetail->last_name;
				
				//1. mail to user
				$subject1 = 'Course enrollment in '.$configarr[0]['institute_name'];
				$toemail1 = $userdetail->email;
				$content = '';
				$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> New User Enrolled in '.$configarr[0]['institute_name'].'</h6>';
				$content .= '<p>Dear '.$userdetail->first_name.' '.$userdetail->last_name.',<br /><br />';
				$content .= " Enrolled Successfully! You can find ".$programinfo->name." course under 'My Courses'.<br /><br />";
				$content .=' If you need help or have any questions, please contact us.<br /><br />';
				$content .=' Best Regards,<br /><br />';
				$content .= $configarr[0]['institute_name'].'</p>';
				$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
				$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
				$fromemail1=$urldomain;// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail1, 'Prashant');
				$this->email->subject($subject1);
				$this->email->to($toemail1);
				$this->email->message($message1);
				$this->email->send();	
				//2. mail to teacher
				$subject2 = 'New user added in '.$configarr[0]['institute_name'];
				$toemail2 = $authordetail->email;
				$content = '';
				$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> New Course Enrolled in '.$configarr[0]['institute_name'].'</h6>';
				$content .= '<p>Dear '.$authordetail->first_name.' '.$authordetail->last_name.',<br /><br />';
				$content .= " One Student enrolled in ".$programinfo->name.". .<br /><br />";
				$content .='If you need help or have any questions, please contact us.<br /><br />';
				$content .='Best regards,<br /><br />';
				$content .= $configarr[0]['institute_name'].'</p>';
				$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
				$message2 = $this->load->view('email_formates/common_email_formate.php',$data,true);
				$fromemail2 = $urldomain;//admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail2, 'Prashant');
				$this->email->subject($subject2);
				$this->email->to($toemail2);
				$this->email->message($message2);
				$this->email->send();	
			
			
			   
				//3. Mail To admin 
				$subject3 = 'New User Enrolled to '.$configarr[0]['institute_name'];
				$toemail3 = 'prshah83@gmail.com';//admin mail	
				$content = '';	
				$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
				$content .= '<p>Dear Prashant'.',<br /><br />';
				$content .= '<p>New User Is Enrolled For Course :- '.$programinfo->name.' named '.$sessionarray['first_name'].' '.$sessionarray['last_name'].' <br /><br />';
				$content .='Best regards,<br /><br />';
				$content .=''.$configarr[0]['institute_name'].'</p>';
				$message3 = $content;
				$fromemail3 = $urldomain;
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail3, 'Prashant');
				$this->email->subject($subject3);
				$this->email->to($toemail3);
				$this->email->message($message3);
				$this->email->send();	
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
				redirect('programs/lectures/'.$course_id);
			}
			elseif($result == 'old')
			{
			 
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "You have successfully enrolled to the course. Begin learning now!" ));
				redirect('programs/lectures/'.$course_id);	
			}
			elseif($result == '')
			{
			 
				redirect('programs/programs/'.$course_id);
			} 
			
		}
	}
	
	
	
	 function withdraw($id = NULL)
    {
		$ids = $this->session->userdata('id_arr');
		
	    
		$sessionarray = $this->session->userdata('logged_in');
		$configarr = $this->settings_model->getItems(); 
       //$withdraw_id = $this->uri->segment(3);
        $courses_id = $this->uri->segment(3);
	   
	  
    	//redirect if it´s no correct

    	if ($ids){
			
			foreach($ids as $id)
			{
				$isupdate = $this->program_model->withdraw_request($id);
			}    		
			
			$this->session->unset_userdata($ids);
			if ($isupdate)

			{			

				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Request Sent Successfully' ));
			    //2. mail to teacher
				$subject2 = 'Request for Withdraw of Amount Sent Successfully';
				$toemail2 = $sessionarray['email'];
				$content = '';
				$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> New Course Enrolled in '.$configarr[0]['institute_name'].'</h6>';
				$content .= '<p>Dear '.$sessionarray['first_name'].' '.$sessionarray['last_name'].',<br /><br />';
				$content .= "Your Request for the Withdraw of Amount to institute has been sent Successfully.<br /><br />";
				$content .= 'Institute will send further information regarding to your request.<br /><br />';
				$content .='Best regards,<br /><br />';
				$content .= $configarr[0]['institute_name'].'</p>';
				$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
				$message2 = $this->load->view('email_formates/common_email_formate.php',$data,true);
				$fromemail2 = $urldomain;//admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail2, 'Prashant');
				$this->email->subject($subject2);
				$this->email->to($toemail2);
				$this->email->message($message2);
				$this->email->send();	
			
			
			   
				//3. Mail To admin 
				$subject3 = 'New Request for Withdrawal of Amount';
				$toemail3 = 'prshah83@gmail.com';//admin mail	
				$content = '';	
				$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
				$content .= '<p>Dear Prashant'.',<br /><br />';
				$content .= '<p>You have receive new request from '.$sessionarray['first_name'].' '.$sessionarray['last_name'].' regarding to withdraw of Amount. <br /><br />';
				$content .='Best regards,<br /><br />';
				$content .=''.$configarr[0]['institute_name'].'</p>';
				$message3 = $content;
				$fromemail3 = $urldomain;
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

			else

			{

				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Please Try Again'  ) );

			}
			redirect('income/myBuyers/'.$courses_id);

    	}
		else
		{
			redirect('income/myBuyers/'.$courses_id);
		}
    	
    }
	
	function update_reviews()
	{
	   
	    $sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$review_rate = $this->input->post('review_point');
		$program_id = $this->input->post('pro_id');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$review_id = $this->input->post('review_id');

		$data = array(
			'review_rate' => $review_rate,
			'title' => $title,
			'description' => $desc,
			'program_id' => $program_id,			
			'user_id' => $user_id,			
			'review_date' => date("Y-m-d")
		);
		
		$this->load->model('Program_model');
		$this->load->model('Category_model');	  
		$update_id = $this->Program_model->updateReview($data,$review_id);
		
		$name = $this->settings_model->getName($user_id);
		$author = $this->settings_model->getTeacherId($program_id);
		$Program_name = $this->settings_model->getCourseName($program_id);
		
	
	
		  $data_activity = array(
			'activity' => $name.' has updated his review on '.$Program_name,
			'sender_id' => $user_id,
			'receiver_id' => $author,
			'activity_type' => 'review',
			'activity_date' => date("Y-m-d"),
			'visit_id' => $program_id
		  );
	  
	  $this->Category_model->insertActivity($data_activity);
		
		if($update_id)
		{
		  	
		  return;
		}
		
	}
	
	function hasAtLeastOneCourse($course_id){
		$course_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) :$course_id;
		$this->load->model('Program_model');
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$group_id = $sessionarray['groupid'];
		$result = $this->Program_model->buy_courses_hasAtLeastOne(intval($user_id), $course_id);
		$result = count($result);

		if(isset($result) && $result > 0){
			return true;
		}
		else{	
			return false;
		}
	}


/*function createButton($buy_background, $course_id, $buy_class, $program, $program_content){
		$my = $this->session->userdata('logged_in');
		$this->load->model('Program_model');
		$this->load->helper('date');
		$user_id = $my['id'];
		$group_id = $my['groupid'];
		$expired = false;
		$where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id));
		$BuyCourses = $this->Program_model->getBuyCourses($where);
		$expired_date_string = null;
		if(!empty($BuyCourses)){
		$expired_date_string = $BuyCourses->expired_date;
		}
		$not_show = false;
		$current_date_string = "";
		
		$result = $this->Program_model->isCustomer(intval($user_id),intval($course_id));
		//exit;
		//exit(print_r($result));
		$result = count($result);
			//exit(isset($result));
		if(($expired_date_string != "0000-00-00 00:00:00") || (!isset($result) || intval($result) == 0)){
		
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			$expired_date_int = strtotime($expired_date_string);
			$current_date_string = mdate($datestring, $time);
			$current_date_int = strtotime($current_date_string);
			$renew = false;
			if($current_date_int < $expired_date_int){
				$renew = true;
				
			}
			
			
			$my_courses = $this->Program_model->myCourses("mlms_buy_courses.course_id",intval($user_id));
			$return = '<table width="100%">
					<tr>
						<td colspan="4" class="'.$buy_background.'">Get access to all the tutorials in the course now!&nbsp;&nbsp;';
			
			if(in_array($course_id, $my_courses) && $renew){ // I bought this course
				$difference_int = get_time_difference($current_date_int, $expired_date_int);		
				$difference = $difference_int["days"]." days";
				if($difference_int["days"] == 0){
					if($difference_int["hours"] == 0){
						if($difference_int["minutes"] == 0){
							$difference = "0";
						}
						else{
							$difference = $difference_int["minutes"]." minutes";
						}
					}
					else{
						$difference = $difference_int["hours"]." hours";
					}
				}
				if($expired_date_string == "0000-00-00 00:00:00"){//unlimited
					$difference_int = "1"; //default for unlimited
				}
				if($difference_int !== FALSE){// is not expired			
					$not_show = true;
				}
				else{
					//$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\'index.php?option=com_guru&view=guruPrograms&task=buy_action&course_id=$course_id&Itemid='.$itemid.'\';" value="Buy now" name="Buy" />';
					$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."buyitems/buynow/".$course_id.'\';" value="Buy now" name="Buy" />';
					$expired = true;
				}
			}
			else{
				//$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\'index.php?option=com_guru&view=guruPrograms&task=buy_action&course_id='.$course_id.'\';" value="Buy now" name="Buy" />';
				$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."buyitems/buynow/".$course_id.'\';" value="Buy now" name="Buy" />';
			
			}
		
			$return .= '</td>
					</tr>
				</table>';
		}
		else{//not show the button
			$not_show = true;
		}
		
		$chb_free_courses = $program->chb_free_courses;
		$step_access_courses = $program->step_access_courses;
		$selected_course = $program->selected_course;
		
		if($chb_free_courses == 1){
		
		$where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id), 'order_id >=' =>  '0');
		$result = $this->Program_model->getBuyCourses($where);
		$result = count($result);
			if($result > 0){
				$not_show = true;
			}
			else{
				$not_show = false;
			}
		} //echo $step_access_courses;
		if($not_show && ($chb_free_courses == 0 || ($chb_free_courses == 1 && $step_access_courses > 1) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && isCustomer()) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course == -1 && $this->hasAtLeastOneCourse($course_id)) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && $this->buySelectedCourse($selected_course)))){
		//if($not_show && ($chb_free_courses == 0 || ($chb_free_courses == 1 && $step_access_courses == 1) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && isCustomer()) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course == -1 && $this->hasAtLeastOneCourse($course_id)) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && $this->buySelectedCourse($selected_course)))){
			$return = array("0"=>"");// exit(print_r($program_content));
			if(isset($program_content) && count($program_content) > 0){
				$module_id = $program_content["0"]["id"];
				$lessons = $this->Program_model->getLessons($module_id);//exit(print_r($lessons));
				//$lessons = guruModelguruProgram::getSubCategory($module_id);
				$lesson_name = "";
				if(isset($lessons) && count($lessons) > 0){
					$lesson_name = $lessons[0]->name;
				}
				$return["0"] = '<table  width="100%"><tr><td class="bought_background">Welcome to the "'.$program->name.'" course! Please get started below by clicking on the first lesson "'.$lesson_name.'" below</td></tr></table>';
			}
		}
		else{
			if($chb_free_courses == 1){//checked
				if($step_access_courses == 0 && !$expired){// Students
					if($selected_course == '-1'){// any course
						if($user_id == 0){//not logged
							$return = '	<table width="100%">
											<tr>
												<td colspan="4" class="'.$buy_background.'">This course is FREE for students of any of our courses! Are you a student?&nbsp;&nbsp;
													<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\'index.php?option=com_guru&view=guruprograms&task=enroll&cid='.$course_id.'\';" value="Enroll Now" name="Enroll" />
												</td>
											</tr>
											<tr>	
												<td colspan="4" class="'.$buy_background.'">Not a student?&nbsp;&nbsp;
													<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\'index.php?option=com_guru&view=guruPrograms&task=buy_action&course_id=.$course_id.&Itemid='.$course_id.'\';" value="Buy now" name="Buy" />
												</td>
											</tr>									
										</table>';
						}
						else{				
							if($this->hasAtLeastOneCourse($course_id)){
							$return = '	<table width="100%">
											<tr>
												<td colspan="4" class="'.$buy_background.'">This course is yours FREE because you are a student&nbsp;&nbsp;
													<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\'index.php?option=com_guru&view=guruprograms&task=enroll&cid='.$course_id.'\';" value="Enroll Now" name="Enroll" />
												</td>
											</tr>								
										</table>';		
							}
						}
					}
					else{// selected courses
						if($user_id == 0){// not logged					
							$selected_course_final = explode('|', $selected_course);
							foreach($selected_course_final as $key=>$value){
								if(trim($value) == ""){
									unset($selected_course_final[$key]);
								}
							}
							
							//$db =& JFactory::getDBO();
							if(!empty($selected_course_final)){
							  $result = $this->Program_model->getProgramsIn ("name, id",$selected_course_final);
							  }
							$all_title = array();
							if(isset($result) && count($result) > 0){
								foreach($result as $key=>$course){
									$all_title[] = '<a href="'.base_url().'programs/programs/'.$course["id"].'">'.$course["name"].'</a>';
								}
							}
							$all_title = implode(", ", $all_title);
							
							$not_show = false;
							$return = '<table width="100%">
											<tr>
												<td colspan="4" class="'.$buy_background.' list_courses">This course is FREE for students of the following courses:<br/>
													'.$all_title.'
												</td>
											</tr>
											<tr>	
												<td style="text-align:right; height:0px; line-height:0px; padding-right:10px;" colspan="4" class="'.$buy_background.'">Are you a student of any of these course(s)?&nbsp;&nbsp;
													<input type="button" style="padding: 0px;" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
												</td>
											</tr>
											<tr>	
												<td style="text-align:right; height:0px; line-height:0px; padding-right:10px;" colspan="4" class="'.$buy_background.'">Not a student?&nbsp;&nbsp;
													<input type="button" style="padding: 0px;" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'programs/buyaction/'.$course_id.'\';" value="Buy now" name="Buy" />
												</td>
											</tr>
										</table>';
						}
						
							else{
								if($this->buySelectedCourse($selected_course)){
									$selected_course_final = explode('|', $selected_course);
									foreach($selected_course_final as $key=>$value){
										if(trim($value) == ""){
											unset($selected_course_final[$key]);
										}
									}
									
									if(!empty($selected_course_final)){
									  $result = $this->Program_model->getProgramsIn ("name, id",$selected_course_final);
									  }
									$all_title = array();
									$itemid = JRequest::getVar("Itemid", "0");
									if(isset($result) && count($result) > 0){
										foreach($result as $key=>$course){
											$all_title[] = '<a href="'.JRoute::_("index.php?option=com_guru&view=guruPrograms&layout=view&cid=".$course["id"]."&Itemid=".$itemid).'">'.$course["name"].'</a>';
										}
									}
									$all_title = implode(", ", $all_title);
									$return = '<table width="100%">
													<tr>
														<td colspan="3" class="'.$buy_background.' list_courses">This course is yours FREE because you\'re a student of one of the following courses:
														</td>
													</tr>
													<tr>
														<td style="text-align:left; height:0px; line-height:0px; padding-bottom:10px;" class="'.$buy_background.'">
															'.$all_title.'&nbsp;&nbsp;&nbsp;
															<input type="button"  style="padding: 0px;" class="'.trim($buy_class).'" onclick="document.location.href=\''.JRoute::_("index.php?option=com_guru&view=guruprograms&task=enroll&cid=".$course_id).'\';" value="Enroll Now" name="Enroll" />
														</td>
													</tr>
												</table>';
								}
							//}
						}
					}
				}
			
				elseif($step_access_courses > 1){// Members
					$return = '<table width="100%">
									<tr>
										<td colspan="4" class="'.$buy_background.'">This course is FREE for members!&nbsp;&nbsp;
											<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
										</td>
									</tr>
								</table>';
				}
				elseif($step_access_courses == 1){// students
					$return = '	<table width="100%">
									<tr>
										<td colspan="4" class="'.$buy_background.'">This course is FREE!</td>
										<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
									</tr>
								</table>';
				}
			}
		}

		return $return;	
}*/

function createButton($buy_background, $course_id, $buy_class, $program, $program_content){
	$this->load->model('Program_model');
	$sessionarray = $this->session->userdata('logged_in');
	//$db =& JFactory::getDBO();
	//$my =& JFactory::getUser();
	$user_id = $sessionarray['id'];
	$group_id = $sessionarray['groupid'];
	$expired = false;
	//$itemid = JRequest::getVar("Itemid", "0");
	
	
	
	$where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id));
		$BuyCourses = $this->Program_model->getBuyCourses($where);
		
		
		
		$expired_date_string = null;

		if(!empty($BuyCourses))
        {
		    $expired_date_string = $BuyCourses->expired_date;
		}
		$not_show = false;
		$current_date_string = "";
		$result = $this->Program_model->isCustomer(intval($user_id),intval($course_id));
		
		if(!empty($result)){
		$result = $result[0]['id'];
		}else{
		$result = 0;
		}
		
		//$result = count($result);
	/*$sql = "select expired_date from #__guru_buy_courses where userid=".intval($user_id)." and course_id=".intval($course_id);
	$db->setQuery($sql);
	$db->query();
	$expired_date_string = $db->loadResult();
	$not_show = false;
	$current_date_string = "";
	
	$sql = "select bc.id from #__guru_buy_courses bc, #__guru_order o where bc.userid=".intval($user_id)." and bc.course_id=".intval($course_id)." and (bc.expired_date >= '".$current_date_string."' or bc.expired_date = '0000-00-00 00:00:00') and bc.order_id = o.id and o.status <> 'Pending'";
	$db->setQuery($sql);
	$db->query();
	$result = $db->loadResult();*/

	
	if(($expired_date_string != "0000-00-00 00:00:00") || (!isset($result) || intval($result) == 0)){
	
	$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
		    $current_date_string = mdate($datestring, $time);
			$current_date_int = strtotime($current_date_string);
			$expired_date_int = strtotime($expired_date_string);
			$renew = 'false';
	
	//exit(print_r($result));
		/*$expired_date_int = strtotime($expired_date_string);
		$jnow =& JFactory::getDate();
		$current_date_string = $jnow->toMySQL();
		$current_date_int = strtotime($current_date_string);
		$renew = "false";*/
		
		if($current_date_int < $expired_date_int){
			$renew = "true";
			
		}
		
		
		$my_courses = $this->Program_model->myCourses("mlms_buy_courses.course_id",intval($user_id));
	    
			$return = '<table width="100%">
					<tr>
						<td colspan="4" class="'.$buy_background.'">Get access to all the tutorials in the course now!&nbsp;&nbsp;';
			
		
		
		/*$sql = "select bc.course_id from #__guru_buy_courses bc, #__guru_order o where o.id=bc.order_id and bc.userid=".intval($user_id)." and o.status='Paid'";
		$db->setQuery($sql);
		$db->query();
		$my_courses = $db->loadResultArray();
		$return = '<table width="100%">
				<tr>
					<td colspan="4" class="'.$buy_background.'">'.JText::_("GURU_ACCESS_BUT_BUTTON")."&nbsp;&nbsp;";*/
				
		if(in_array($course_id, $my_courses) && $renew){ // I bought this course
			
			
			$difference_int = get_time_difference($current_date_int, $expired_date_int);		
			$difference = $difference_int["days"]." days";
			if($difference_int["days"] == 0){
				if($difference_int["hours"] == 0){
					if($difference_int["minutes"] == 0){
						$difference = "0";
					}
					else{
						$difference = $difference_int["minutes"]." minutes";
					}
				}
				else{
					$difference = $difference_int["hours"]." hours";
				}
			}
			if($expired_date_string == "0000-00-00 00:00:00"){//unlimited
				$difference_int = "1"; //default for unlimited
			}
			if($difference_int !== FALSE){// is not expired			
				$not_show = true;
			}
			else{
				//$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.JRoute::_("index.php?option=com_guru&view=guruPrograms&task=buy_action&course_id=".$course_id."&Itemid=".$itemid).'\';" value="'.JText::_("GURU_BUY_NOW").'" name="Buy" />';
				$return .= '<input type="button" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url()."buyitems/buynow/".$course_id.'\';" value="Buy now" name="Buy" />';
				$expired = true;
			}
		}
		else{
			//$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.JRoute::_("index.php?option=com_guru&view=guruPrograms&task=buy_action&course_id=".$course_id."&Itemid=".$itemid).'\';" value="'.JText::_("GURU_BUY_NOW").'" name="Buy" />';
			$return .= '<input type="button" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url()."buyitems/buynow/".$course_id.'\';" value="Buy now" name="Buy" />';
		 }
	
		$return .= '</td>
				</tr>
			</table>';
	}
	else{//not show the button
		$not_show = true;
	}

	/*$sql = "SELECT chb_free_courses, step_access_courses, selected_course  FROM `#__guru_program` where id = ".intval($course_id);
	$db->setQuery($sql);
	$db->query();
	$result= $db->loadAssocList();
	$chb_free_courses = $result["0"]["chb_free_courses"];
	$step_access_courses = $result["0"]["step_access_courses"];
	$selected_course = $result["0"]["selected_course"];*/
	
	$chb_free_courses = (isset($program->chb_free_courses)) ? $program->chb_free_courses : '';
	$step_access_courses = (isset($program->step_access_courses)) ? $program->step_access_courses : '';
	$selected_course = (isset($program->selected_course)) ? $program->selected_course : '';
	
	if($chb_free_courses == 1){
	$where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id), 'order_id >=' =>  '0');
	$result = $this->Program_model->getBuyCourses($where);
	$result = count($result);
	
	//exit(print_r($result));
		/*$sql = "SELECT 	count(*) FROM `#__guru_buy_courses` where `order_id` >='0' and `userid`=".intval($user_id)." and course_id=".intval($course_id);
		$db->setQuery($sql);
		$db->query();
		$result= $db->loadResult();*/
		if($result > 0){
			$not_show = true;
		}
		else{
			$not_show = false;
		}
	}
	if($not_show && ($chb_free_courses == 0 || ($chb_free_courses == 1 && $step_access_courses == 1) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && $this->isCustomer()) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course == -1 && $this->hasAtLeastOneCourse($course_id)) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && $this->buySelectedCourse($selected_course)))){
	//if($not_show && ($chb_free_courses == 0 || ($chb_free_courses == 1 && $step_access_courses == 1) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && isCustomer()) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course == -1 && hasAtLeastOneCourse()) || ($chb_free_courses == 1 && $step_access_courses == 0  && $selected_course != -1 && buySelectedCourse($selected_course)))){
		$return = array("0"=>"");//exit(print_r($program_content));
		if(isset($program_content) && count($program_content) > 0){
			$module_id = $program_content["0"]["id"];
			$lessons = $this->Program_model->getLessons($module_id);//exit(print_r($lessons));
			//$lessons = guruModelguruProgram::getSubCategory($module_id);
			$lesson_name = "";
			if(isset($lessons) && count($lessons) > 0){
				$lesson_name = $lessons["0"]->name;
			}
			$return["0"] = '<div><div class="bought_background">Welcome to the "'.$program->name.'" course! Please get started below by clicking on the first lesson "'.$lesson_name.'" below</div></div>';
		}
	}
	else{
		if($chb_free_courses == 1){//checked
			if($step_access_courses == 0 && !$expired)
			{
			// Students
			if($selected_course == '-1')
			{
			// any course
				if($user_id == 0)
				{//not logged
					$return = '	<div>
											<div class="'.$buy_background.'">This course is FREE for students of any of our courses! Are you a student?&nbsp;&nbsp;
												<input type="button" style="" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
											</div>
											<div class="'.$buy_background.'">Not a student?&nbsp;&nbsp;
												<input type="button" style="" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url().'buyitems/buynow/'.$course_id.'\';" value="Buy now" name="Buy" />
											</div>
									</div>';
				}
				else
				{
					if($this->hasAtLeastOneCourse($course_id))
					{
						$return = '	<div>
											<div class="'.$buy_background.'">This course is yours FREE because you are a student&nbsp;&nbsp;
												<input type="button" style="" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
											</div>
									</div>';
					}
				}
			}
			else
			{// selected courses
					if($user_id == 0)
					{
						// not logged					
						$selected_course_final = explode('|', $selected_course);
						foreach($selected_course_final as $key=>$value){
							if(trim($value) == ""){
								unset($selected_course_final[$key]);
							}
						}
						
						
						
						if(!empty($selected_course_final)){
							  $result = $this->Program_model->getProgramsIn ("name, id",$selected_course_final);
							  }
							$all_title = array();
							if(isset($result) && count($result) > 0){
								foreach($result as $key=>$course){
									$all_title[] = '<a href="'.base_url().'programs/programs/'.$course->id.'">'.$course->name.'</a>';
								}
							}
							$all_title = implode(", ", $all_title);
						
						
						/*$db =& JFactory::getDBO();
						$sql = "select name, id from #__guru_program where id in (".implode(", ", $selected_course_final).")";
						$db->setQuery($sql);
						$db->query();
						$result = $db->loadAssocList();
						$all_title = array();
						$itemid = JRequest::getVar("Itemid", "0");
						if(isset($result) && count($result) > 0){
							foreach($result as $key=>$course){
								$all_title[] = '<a href="'.JRoute::_("index.php?option=com_guru&view=guruPrograms&layout=view&cid=".$course["id"]."&Itemid=".$itemid).'">'.$course["name"].'</a>';
							}
						}
						$all_title = implode(", ", $all_title);*/
						
						$not_show = false;
						$return = '<div>
										<div class="'.$buy_background.' list_courses">This course is FREE for students of the following courses :<br/>
											'.$all_title.'
										</div>
										<div style="" class="'.$buy_background.'">Are you a student of any of these course(s)?&nbsp;&nbsp;
											<input type="button" style="" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
										</div>

										<div style="" class="'.$buy_background.'">Not a student?&nbsp;&nbsp;
											<input type="button" style="" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url().'buyitems/buynow/'.$course_id.'\';" value="Buy now" name="Buy" />
										</div>
										</div>';
					}
					/*else{
						$intersect = buySelectedCourse($selected_course);
						if(count($intersect) > 0){
							$sql = "select name from #__guru_program where id in (".implode(", ", $intersect).")";
							$db->setQuery($sql);
							$db->query();
							$bought_courses = $db->loadResultArray();
							$var_lang = JText::_("GURU_COURSE");
							if(count($bought_courses) >= 2){
								$var_lang = JText::_("GURU_COURSES");
							}
							$return = '<table width="100%">
										<tr>
											<td colspan="3" style="text-align:center !important;" class="'.$buy_background.' list_courses">'.JText::_("GURU_FREE_STUDENTS_SOME_COURSES_SUCCESS").'<br/>
												"'.implode('", "', $bought_courses).'" '.$var_lang.'
											</td>
										</tr>
									</table>';
						}*/
						else{
						 	if($this->buySelectedCourse($selected_course)){
								$selected_course_final = explode('|', $selected_course);
								foreach($selected_course_final as $key=>$value){
									if(trim($value) == ""){
										unset($selected_course_final[$key]);
									}
								}
								if(!empty($selected_course_final)){
									  $result = $this->Program_model->getProgramsIn ("name, id",$selected_course_final);
									  }
									$all_title = array();
									//$itemid = JRequest::getVar("Itemid", "0");
									if(isset($result) && count($result) > 0){
										foreach($result as $key=>$course)
										{
											//$all_title[] = '<a href="'.JRoute::_("index.php?option=com_guru&view=guruPrograms&layout=view&cid=".$course["id"]."&Itemid=".$itemid).'">'.$course["name"].'</a>';
											$all_title[] = '<a href="'.base_url().'programs/enroll/'.$course->id.'">'.$course->name."</a>";
										} 
									}
									$all_title = implode(", ", $all_title);
								
								/*$db =& JFactory::getDBO();
								$sql = "select name, id from #__guru_program where id in (".implode(", ", $selected_course_final).")";
								$db->setQuery($sql);
								$db->query();
								$result = $db->loadAssocList();
								$all_title = array();
								$itemid = JRequest::getVar("Itemid", "0");
								if(isset($result) && count($result) > 0){
									foreach($result as $key=>$course){
										$all_title[] = '<a href="'.JRoute::_("index.php?option=com_guru&view=guruPrograms&layout=view&cid=".$course["id"]."&Itemid=".$itemid).'">'.$course["name"].'</a>';
									}
								}
								$all_title = implode(", ", $all_title);*/
								
								$return = '<div>
													<div class="'.$buy_background.' list_courses">This course is yours FREE because you\'re a student of one of the following courses :
													</div>

													<div style="text-align:left; height:0px; line-height:0px; padding-bottom:10px;" class="'.$buy_background.'">
														'.$all_title.'&nbsp;&nbsp;&nbsp;
														<input type="button" style="padding: 0px;" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
													</div>
											</div>';
							}
						//}
					}
				}
			}
			elseif($step_access_courses == 1)
			{// Members
				$return = '<div>
										<div class="'.$buy_background.'">This course is FREE for members!&nbsp;&nbsp;
											<input type="button" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
										</div>
								</div>';
			}
			elseif($step_access_courses == 2)
			{// Guest
				$return = '<div>
										<div class="'.$buy_background.'">This course is FREE!</div>
										<input type="button" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
								</div>';
			}
		}
	}
	//for admin
	if(isset($user_id) && $user_id > 0 && (isset($group_id) && $group_id == 4 || isset($program->author) && $program->author == $user_id)){

	$where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id), 'order_id >=' =>  '0');

	$adresult = $this->Program_model->getBuyCourses($where);
	$adresult = count($adresult);//exit(print_r($adresult));
		if($adresult == 0 ){
		$return = '<div>
											<div class="'.$buy_background.'">This course is FREE for admin and Trainer of this course!&nbsp;&nbsp;
												<input type="button" class="'.trim($buy_class).' btn btn-info" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
											</div>
									</div>';
		}else{
		$return = '<div>
											<div class="'.$buy_background.'">This course is FREE for admin and Trainer of this course!&nbsp;&nbsp;
											</div>
									</div>';
		}
	}
	//end   
	return $return;
}
public function addToPublish()
{
    //$publishID = $_POST['id'];
	//$this->Programs_model->addtopublish_model($publishID);
}

}
?>