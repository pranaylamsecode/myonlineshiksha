<?php
 // Program for frontend(user)
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programs extends MLMS_Controller 
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
		$this->load->model('days_model');
		$this->load->model('admin/medias_model');
		$this->load->model('medias_model');
		$this->load->model('Myinfo_model');
		$this->load->model('login_model');
		$this->load->model('lessons_model');
        if($this->uri->segment(2) != 'teach_info' && $this->uri->segment(2) != 'preview' && $this->uri->segment(2) != 'payment' && $this->uri->segment(2) != 'cropcourseimg')
		{
			$configarr = $this->settings_model->getItems();	
			$this->configarr = $configarr;
			$this->template->set_layout($configarr[0]['layout_template']);
			$this->template->set("configarr", $configarr);	
		}	
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->lang->load('tooltip', 'english');
        //$this->load->helper('unirowclient');
		//$longlife = 60*60*24*60; //60 days
		//$shortlife = 60*60*24*10; //10 days
		//$this->input->set_cookie('LongRemember', $user.'::'.$hashbrown, $longlife, '.example.com', '/');		
		$maccessarr = $this->session->userdata('maccessarr');
		//$this->output->enable_profiler(TRUE);

		$this->load->config('features_config');
	}
	
   /*	function authenticate()
    {
      $session = $this->session->userdata('logged_in');
      if(!$this->session->userdata('logged_in'))
      {
	   
       redirect('users/login');
      }
    } */
	
	public function index($pro_id = NULL)
	{	 //exit("yes");
        error_reporting(0);        
        //$this->input->set_cookie('AutoRemember', 'yes', '86500', '.example.com', '/');
	    $sessionarray = $this->session->userdata('logged_in');		
		
	    $user_id = $sessionarray['id'];
	    $group_id = $sessionarray['groupid'];			
	    
        $this->load->helper('date');
        $tmpl = $this->configarr[0]['layout_template'];
        $this->load->model('Program_model');
        $this->load->model('myinfo_model');
	    $program_title = $this->Program_model->getProgram($pro_id);
	    $this->template->title($program_title->name);
	    $pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
	    $this->template->title("Enroll Course");
        if(!isset($pro_id) && $pro_id == '')
        {
          	redirect('category');
	    }

        $this->template->set("tmpl", $tmpl);
        $this->template->set("category", $this->Program_model->getCateg());
        $this->template->set("webinars", $this->Program_model->getWebinarsNewAll($pro_id));
        $this->template->set("exercise", $this->Program_model->getExercise($pro_id));
		$this->load->model('Category_model');
        $this->template->set("wishlist", $this->Category_model->getProgramWishlist($user_id,$pro_id));
        $this->template->set("configsetting", $this->Program_model->getConfigSettings());
	    $program = $this->Program_model->getProgram($pro_id);

	     $assigned = $this->Program_model->getAssignUser($program->selected_course,$user_id);

        $currency = $this->settings_model->getItems();
	    $currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
	   
		//if($currency[0]['currency'] == 'USD')
		if($currencysign)
		{
			$currency_symbol = $currencysign->sign;
		}
		else
		{

		$currency_symbol = " ";	
		
		}
		$this->template->set("currency_symbol", $currency_symbol);
		$this->template->set("assigned", $assigned);
		$date_enrolled = $this->program_model->datebuynow($pro_id, $user_id);
		
		$isEnrolled =  count($date_enrolled);

		$block_enrolled1 = $this->program_model->checkblockenroll($pro_id, $user_id);  //new code
		$block_enrolled =count($block_enrolled1);
		$this->template->set("block_enrolled", $block_enrolled);
		
		$this->template->set("exp_date", $date_enrolled->expired_date);
		$this->template->set("isEnrolled", $isEnrolled);	    

		
		if(empty($program) || count($program)<=0)
		{

			redirect('category');

		}
        if(isset($user_id))
        {		   
			$userdetail = $this->myinfo_model->getUser($user_id);
			if(empty($userdetail))
			{
				$this->session->unset_userdata('logged_in');
				redirect('users/login');
			}

			$uroomid=$program->roomid;
			$useremail=$userdetail->email;
			$userfname=$userdetail->first_name;
			$userlname=$userdetail->last_name;
			$uname=$userdetail->username;
			$webstatus=$userdetail->webstatus;

			if($program->webstatus=='active')
			{
				if($this->Program_model->checkEnrolled($user_id,$pro_id))
				{
					$uroomid="16960";
					// $studwebinar=$this->addStudent($uroomid,$userfname,$useremail);
					$studwebinar="";
				}
				else
				{
					$studwebinar="";
				}
			}
			else
			{
				$studwebinar="";
			}
			//$studwebinar=$this->addStudent($uroomid,$userfname,$useremail);
        }
        else
        {
			$useremail='';
			$userfname='';
			$userlname='';
			$uname='';
			$webstatus='';
			$studwebinar='';
        }
	   
		if(isset($program->author))
		{
			$teacher_id = (isset($program->author)) ? $program->author : '';
			$teacher_info = $this->Program_model->getTeacherInfo($teacher_id);
			$teachercourse = $this->Program_model->getTeacherCourse($teacher_id);
			
		}
		else
		{
			$teacher_info = '';
			$teachercourse = '';
		}

		$price = $this->Program_model->getPrice($pro_id);
		$this->template->set('pay_setting',$this->settings_model->getAccountMode());
		$this->template->set("user_id", $user_id);
		$this->template->set("programs", $program);
		$this->template->set("teacher_info", $teacher_info);
		$this->template->set("teacher_course", $teachercourse);
		$this->template->set("pro_price", $price);
		$this->template->set("usermail",$useremail);
		$this->template->set("userfname",$userfname);
		$this->template->set("webstatus",$webstatus);
		$this->template->set("reviews", $this->program_model->getAllReview($pro_id));
		$this->template->set("count_5", $this->program_model->getFiveReview($pro_id));
		$this->template->set("count_4", $this->program_model->getFourReview($pro_id));
		$this->template->set("count_3", $this->program_model->getThreeReview($pro_id));
		$this->template->set("count_2", $this->program_model->getTwoReview($pro_id));
		$this->template->set("count_1", $this->program_model->getOneReview($pro_id));
		$this->template->set("default_plans", $this->Program_model->getDefaultPlans($pro_id));
		$this->template->set("program_plans", $this->Program_model->getProgramPlans($pro_id));
		$this->template->set("count_program_plans", $this->Program_model->getCountProgramPlans($pro_id));
		$this->template->set("reviewcount", $this->program_model->getAllReview($pro_id));
		$currency = $this->settings_model->getItems(); 
		
		//$this->template->set("userlname",$userdetail->last_name);
		//$this->template->set("uname",$userdetail->username);
		$this->template->set("roomid",$program->roomid);
		$this->template->set("days", $this->Program_model->getlistDays($pro_id));
		$this->template->set("ViewedLessons", $this->Program_model->countViewedLesson($user_id, $pro_id));
		$course_days = $this->Program_model->getlistDaysarray($pro_id);		
	
		//$course_days =  array_map($course_days);
		//$buybutton = $this->createButton('buy_bg', $pro_id, 'buy', $program, $course_days);
		$hasaccess = $this->haveAccess($pro_id, $program, $course_days);
		$hasaccess = (in_array('hasaccess',$hasaccess))? TRUE : FALSE;
		$this->template->set("buybutton", $buybutton);
		$this->template->set("hasaccess", $hasaccess);
	
		//$last_page_url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$last_page_url = $_SERVER["REQUEST_URI"];
		$this->session->set_userdata('last_page_url',$last_page_url);
		
		$this->createButton($buy_background, $course_id, $buy_class, $program, $program_content);				
        $this->template->set("addstudresponse",$studwebinar);
		$this->template->build(getOverridePath($tmpl,'programs/program123','views'));	 		
	}	
	
	public function add_wishlist()
	{	
		if($this->session->userdata('logged_in'))
		{  
			$sessionarray = $this->session->userdata('logged_in');
			$user_id = $sessionarray['id'];
			$program_id = $this->input->post('pro_id');	  
		  
			$this->load->model('Category_model');        
		  
			$data = array(
			'user_id' => $user_id,
			'program_id' => $program_id,
			'wishlist_date' => date("Y-m-d")
			);
	 		
			$wishlist_id = $this->Category_model->getInsertWishlist($data);
		 
			$Program_name = $this->settings_model->getCourseName($program_id);
		
			$data_activity = array(
				'activity' => $Program_name.' course added to your wishlist',
				'sender_id' => $user_id ,
				'receiver_id' => $user_id ,
				'activity_type' => 'wishlist',
				'activity_date' => date("Y-m-d"),
				'visit_id' => '0'
			);
		  
			$this->Category_model->insertActivity($data_activity);
		  
			$author = $this->settings_model->getTeacherId($program_id);
			$name = $this->settings_model->getName($user_id);
		   
			$data_activity = array(
				'activity' => $name.' wishlisted course '.$Program_name,
				'sender_id' => $user_id ,
				'receiver_id' => $author ,
				'activity_type' => 'wishlist',
				'activity_date' => date("Y-m-d"),
			    'visit_id' => $user_id
			);
		 
			echo "<a href='javascript:void(0)' class='btn-primary_sub' onclick='ajax_deletewishlist($program_id,$wishlist_id)' style='margin-left: -15px; margin-right: -15px'><i class='entypo-heart' style='color:#fff; margin-right:10px;'></i><span>Wishlisted</span></a>";
			return;	  	
		}  
	}
	
	public function delete_wishlist()
	{	  
		if($this->session->userdata('logged_in'))
		{
			$sessionarray = $this->session->userdata('logged_in');
			$user_id = $sessionarray['id'];
			$wishlist_id = $this->input->post('wishlist_id');
			$program_id = $this->input->post('pro_id');	  
		  
	        $this->load->model('Category_model');	  
		 
	 		
			$this->Category_model->deleteWishlist($wishlist_id);
		  
			$Program_name = $this->settings_model->getCourseName($program_id);
		
				$data_activity = array(
				'activity' => $Program_name.' course remove from your wishlist',
				'sender_id' => $user_id ,
				'receiver_id' => $user_id ,
				'activity_type' => 'wishlist',
				'activity_date' => date("Y-m-d"),
				'visit_id' => '0'
				);

					  
			$this->Category_model->insertActivity($data_activity);
		  
			echo "
			<a href='javascript:void(0)' class='btn-primary_sub' onclick='ajax_addwishlist($program_id)' style='margin-left: -15px; margin-right: -15px'>
					<i class='entypo-heart' style='color:#fff; margin-right:10px;''></i>
					<span>Add To Wishlist</span>
					</a>";
			//<a href='javascript:void(0)' onclick='ajax_addwishlist($program_id)' class=btn-primary_sub'  style='margin-left: -15px; margin-right: -15px'><i class='entypo-heart' style='color:#fff; margin-right:10px;'></i><span>Add To Wishlist</span></a>";
			return;	  	
		}  
	}
	
	public function payment()
	{	 
		
					$this->load->model('admin/settings_model');
					$this->load->model('admin/programs_model');
					$this->load->model('Program_model');
				 	$this->load->model('myinfo_model');
				 	$this->load->model('orders_model'); 
		 $price = $this->input->post('price'); 
		$course_id = $this->input->post('course_id');	
	    // $price2 = $this->orders_model->getPrice($course_id);
	     $pay_setting = $this->settings_model->getAccountMode();
		$external_id = $this->program_model->getExternalId($course_id);
		
		if($external_id)
		{	
		
			$this->session->set_userdata('external_id',$external_id->id);
		}
		
		
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		if(!$this->session->userdata('logged_in'))
		{	   
			redirect('users/login_form');
		}
		elseif($_POST['submit'] == 'Go To Paypal')
		{	    
			redirect('paypal/index/'.$course_id.'/'.$price);
		}
		elseif($_POST['submit'] == 'Buy Now')
		{
			exit('aaa');
		} 
		elseif($_POST['submit'] == 'Direct Payment')
		{
			$request  = $this->program_model->getRequest($user_id,$course_id);

			if($request > 0)
			{
				$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Request Already Exist' ));
               redirect('programs/programs/'.$course_id);
			}
			else
            {
			
			$data = array(
					'userid' => $user_id,									
					'courses' => $course_id,					
					'order_date' => date('Y-m-d h:i:s'),
					'status' => 'Pending',
					'pending_reason' => 'none',
					'amount' => $price,
					'amount_paid' => $price,
					'published' => 1,
					'processor' => 'Direct Payment',
					'currency' => $pay_setting[0]['currency'],
					'transactionid' =>''
				);

		
				
				 $successid = $this->settings_model->insertDirectSuccess($data);
				 if($successid)
				 {	
				 	$urldomain = base_url();
		$urldomain = str_replace('http://', '', $urldomain);
		$urldomain = str_replace('/', '', $urldomain);
		$urldomain = str_replace('www.', '', $urldomain);

				 	$configarr = $this->settings_model->getItems();
				 	$userdetail = $this->myinfo_model->getUser($user_id);
				 	$programinfo = $this->Program_model->getProgram($course_id);
				 	
			//1. Order mail to user
					//$subject1 = 'You Have Successfully Placed an Order in '.$configarr[0]['institute_name'];
					$subject1 = 'Your course purchase details - '.$configarr[0]['institute_name'];
					$toemail1 = $userdetail->email; // $userdetail->email
					$content = '';
					//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;"> Your Order of '.$price.' '.$pay_setting[0]['currency'].' was Successfully recieved by '.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';
					$content .= '<p>Hi '.trim(ucfirst($userdetail->first_name)).',<br /><br />';
					$content .= 'Thank you for your order. Here are your order details:<br /><br />';
					$content .= ' Course Name: '.$programinfo->name.'<br />';
					//$content .= ' Transaction Id :'.$result['TRANSACTIONID'].'<br /><br />';
					$content .= ' Payment Method: Direct Payment <br />';
					$content .= ' Status: Pending <br />';
					$content .= ' Amount:'.$price.'<br /><br />';
					//$content .= " Your Order was successfully completed! You can find '".$programinfo->name."' under the menu 'My Courses' in  <a href =".base_url().">".base_url()."</a> once you login.<br /><br />";
					$content .= " Your purchase was successfull! You can find ".$programinfo->name." under the menu 'My Courses' in the Academy once you login.<br /><br />";

					$content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> ';
					// $content .=' If you need help or have any questions, please contact us.<br /><br />';
					// $content .=' <br /><br />';
					// $content .= '...</p>';
					// $content .= $configarr[0]['signature'].'</p>';
					$data['content'] = $content;
					$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					$fromemail1= 'noreply@'.$urldomain;   //$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject1);
					$this->email->to($toemail1);
					$this->email->message($message1);
					$this->email->send();

					$admininfo = $this->login_model->getadminInfo(4);
					//3. Mail To admin 
					$subject1 = 'New Order Placed in '.$configarr[0]['institute_name'];
					$toemail3 = $admininfo->email;// admin mail
					$content = '';	
					//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> Your course purchase details - '.$configarr[0]['institute_name'].'</p>';

					$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					//$content .= "<p>You have received a new order for '".$programinfo->name."' by ".ucfirst($sessionarray['first_name'])." ".ucfirst($sessionarray['last_name'])." <br /><br />";

					$content .= trim(ucfirst($sessionarray['first_name'])).' have made a purchase of a course. The details are given below: <br /><br /> ';
					//$content .= ' Transaction Id :'.$result['TRANSACTIONID'].'<br /><br />';
					$content .= ' Course Name: '.$programinfo->name.'<br />';
					$content .= ' Payment Method: Direct Payment <br />';
					$content .= ' Status: Pending <br />';
					$content .= ' Amount:'.$price.'<br />';					
					// $content .=' <br /><br />';
					// $content .= '...</p>';
					// $content .= $configarr[0]['signature'].'</p>';
					$data['content'] = $content;
					$message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					//$message3 = $content;
					$fromemail3 = 'noreply@'.$urldomain;//$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject1);
					$this->email->to($toemail3);
					$this->email->message($message3);
					$this->email->send();

				 	redirect('/orders');
				 }
				}
		}  
	}


	
	public function copy()
	{
		 // Academy Configuaration data

         $config_course = $this->config->item('webinar');	
           $course_limit = $config_course['courselimit'];

          $countprogConfig = $this->programs_model->getProgramforConfig();
    
        if($course_limit <= $countprogConfig)
        {
            
           	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please upgrade subscription to create more courses' ));
			
		   redirect('manage/courses/');
        }	

	    $u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($maccessarr['courses']=='own') || ($maccessarr['courses']=='modify_all'))
		{
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CbCourse', 'CbCourse', 'required');
		if($this->form_validation->run() === FALSE)
		{		
			$this->template->build('programs/copy');
		}
		else
		{		
			$course_id = $this->input->post('CbCourse');

			$select_course = $this->programs_model->getCourseForCopy($course_id);

			$select_days = $this->programs_model->getDaysForCopy($course_id);             
             
			
						
			$data = array(
				'catid' => $select_course->catid,
				'name' => $select_course->name.' '.'Copy',
				'alias' => $select_course->alias.' '.'Copy',
				'description' => $select_course->description,				
				'introtext' => $select_course->introtext,
				'image' => $select_course->image,
				'emails' => $select_course->emails,
				
				'published' => $select_course->published,
				'startpublish' => $select_course->startpublish,
				'endpublish' => $select_course->endpublish,
				'metatitle' => $select_course->metatitle,
				'metakwd' => $select_course->metakwd,
				'metadesc' => $select_course->metadesc,
				
				'ordering' => $select_course->ordering,
				'pre_req' => $select_course->pre_req,
				'pre_req_books' => $select_course->pre_req_books,
				'reqmts' => $select_course->reqmts,
				'author' => $select_course->author,			
				
				'level' => $select_course->level,
				'priceformat' => $select_course->priceformat,
				'fixedrate' => $select_course->fixedrate,
				'skip_module' => $select_course->skip_module,
				'chb_free_courses' => $select_course->chb_free_courses,
				'step_access_courses' => $select_course->step_access_courses,
				'selected_course' => $select_course->selected_course,
				'course_type' => $select_course->course_type,
				
				'lesson_release' => $select_course->lesson_release,
				'lessons_show' => $select_course->lessons_show,
				'start_release' => $select_course->start_release,
				'id_final_exam' => $select_course->id_final_exam,
				'certificate_term' => $select_course->certificate_term,
				'hasquiz' => $select_course->hasquiz,
				'updated' => $select_course->updated,
				
				'certificate_course_msg' => $select_course->certificate_course_msg,
				'webcam_option' => $select_course->webcam_option,
				'roomid' => $select_course->roomid,
				'webstatus' => $select_course->webstatus,
				'roomid' => $select_course->roomid,
				'status' => $select_course->status,
				'webnardescription' => $select_course->webnardescription,
				'created_by' => $select_course->created_by
			);
			
			$parent_id = NULL;
			$program_id = $this->programs_model->insertItems($data);

			foreach($select_days as $days)
			{
               $data_days = array(
				'pid' => $program_id,
				'title' => $days->title,
				'alias' => $days->alias,
				'description' => $days->description,				
				'image' => $days->image,
				'published' => $days->published,
				'startpublish' => $days->startpublish,
				'endpublish' => $days->endpublish,
				'metatitle' => $days->metatitle,
				'metakwd' => $days->metakwd,
				'metadesc' => $days->metadesc,
				
				'afterfinish' => $days->afterfinish,
				'url' => $days->url,
				'pagetitle' => $days->pagetitle,
				'pagecontent' => $days->pagecontent,
				'ordering' => $days->ordering,
				'locked' => $days->locked,
				'media_id' => $days->media_id,
				'access' => $days->access
				);

               $day_id = $this->programs_model->insertDaysItems($data_days);

               $lessons = $this->days_model->getLessonsData($days->id);

               foreach($lessons as $lesson)
               {
               		$data_task = array(
               				'name' => $lesson->name, 
               				'alias' => $lesson->alias,
               				'category' => $lesson->category,
               				'difficultylevel' => $lesson->difficultylevel,
               				'points' => $lesson->points,
               				'image' => $lesson->image,
               				'published' => $lesson->published,
               				'startpublish' => $lesson->startpublish,
               				'endpublish' => $lesson->endpublish,
               				'metatitle' => $lesson->metatitle,
               				'metakwd' => $lesson->metakwd,
               				'metadesc' => $lesson->metadesc,
               				'ordering' => $lesson->ordering,
               				'step_access' => $lesson->step_access,
               				'final_lesson' => $lesson->final_lesson,
               				'created_by' => $lesson->created_by
               	          );

               		$tid = $this->programs_model->insertTaskItems($data_task);
                }                       
			}			
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			//$this->template->build('admin/programs/list');
			redirect('manage/courses');
		}
		}
		else 
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to Copy any course' ));		
			redirect('category/pagenotfound');
		}
	}
	
	public function preview()
	{	$this->load->model('medias_model');
		$media_id = $this->uri->segment(3);
		$sectionname = $this->program_model->getSectionName($media_id);
		//echo"<pre>";
		//echo $sectionname->media_id;
		  $this->template->set('db_media', $this->medias_model->getMediaExeFile($sectionname->media_id));
		//print_r($media);
		//exit('yes');
		$this->template->set('sectionname', $sectionname);
		//$this->template->set('db_media', $this->program_model->getMedia_oflayout('mod_m',$media_id));
		$this->template->set('db_text', $this->program_model->getMedia_oflayout('mod_t',$media_id));
		$this->template->build('programs/preview');
	}
	
	public function teach_info()
	{
	   $sessionarray = $this->session->userdata('logged_in');
	 
	   $user_id = $sessionarray['id'];
	   
	   $name = $sessionarray['first_name'].' '.$sessionarray['last_name'];
		
		$this->template->append_metadata(block_submit_button());
		$this->load->helper('form');
		
		
		$this->load->model('Program_model');
	    $teacher_id = $this->uri->segment(3);
	    $program_id = $this->uri->segment(4);
        $teacher_info = $this->Program_model->getTeacherInfo($teacher_id);
	   	
	    $this->template->set("teacher_info", $teacher_info);
	    $this->template->set("user_id", $user_id);
	    $this->template->set("program_id", $program_id);
	    $this->template->set("name", $name);
		$this->template->build('programs/information');
		//redirect('programs/information');
		
	}
	
	
	public function teach_profile()
	{
	 
	   $sessionarray = $this->session->userdata('logged_in');
	 
	   $user_id = $sessionarray['id'];
	   
	   $name = $sessionarray['first_name'].' '.$sessionarray['last_name'];
		
		$configarr = $this->settings_model->getItems();
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $configarr[0]['layout_template'];		
		$this->template->set("tmpl", $tmpl);
		$this->template->append_metadata(block_submit_button());
		$this->load->helper('form');
		
		
		$this->load->model('Program_model');
		$this->load->model('Myinfo_model');
		$this->load->model('Category_model');
	    $teacher_id = $this->uri->segment(3);
        $teacher_info = $this->Program_model->getTeacherInfo($teacher_id);
		$this->template->set("wishlist", $this->Category_model->getWishlist($user_id));
	    $this->template->set("teachingcourses", $this->Myinfo_model->getTeachingCourses($teacher_id));
	    $this->template->set("teachingcourses1", $this->Myinfo_model->getTeachingCourses($teacher_id));
	    $this->template->set("teacher_info", $teacher_info);
	    $this->template->set("user_id", $user_id);
	    $this->template->set("name", $name);
		$this->template->build('programs/profile');
		//redirect('programs/information');		
	}
	
	
	public function addwishlist()
	{
	    if($this->session->userdata('logged_in'))
	    {
			$sessionarray = $this->session->userdata('logged_in');
			$user_id = $sessionarray['id'];
			$program_id = $this->input->post('pro_id');
			$hover_id = $this->input->post('hover_id');
			$this->load->model('Category_model');

			$data = array(
			'user_id' => $user_id,
			'program_id' => $program_id,
			'wishlist_date' => date("Y-m-d")
			);

			$wishlist_id = $this->Category_model->getInsertWishlist($data);
			if($wishlist_id)
			{
				echo "<i class='entypo-heart' style='color:#D04D66;'></i><span class='in-wishlist none' onclick='ajax_deletewishlist($program_id,$wishlist_id,$hover_id)'>Wishlisted</span>";
				return;	  
			}
		}	  
	}
	
	public function deletewishlist()
	{
	  
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
	  $wishlist_id = $this->input->post('wishlist_id');  
	  $program_id = $this->input->post('pro_id');	
      $hover_id = $this->input->post('hover_id');		  
	  
        $this->load->model('Category_model');	  
	 
 		
	  $this->Category_model->deleteWishlist($wishlist_id);
      echo "<i class='entypo-heart' style='color:#D04D66;'></i> <span class='in-wishlist' onclick='ajax_addwishlist($program_id,$hover_id)'>Wishlist</span>";
       return;	  
	  
	}

	
	
	public function send_mail()
    {
	  
	  /*$teacher_id = $this->input->post('teacher_id');
	  $pro_id = $this->input->post('program_id'); 
	  

      $ques = $this->input->post('ask_question'); 
	  
	   $teach_email = $this->input->post('teacher_email');
	   
	  $your_name = $this->input->post('your_name'); */

	       $teacher_id = $_POST['teacher_id'];
           $pro_id = $_POST['program_id'];  
         

           $ques = $_POST['ask_question'];  
         
            $teach_email =  $_POST['teacher_email'];
          
            $your_name = $_POST['your_name'];
         
	 		
	 		list($fname1,$lname1) = explode(' ',$your_name);

	    $sessionarray = $this->session->userdata('logged_in');
	    $user_id = $sessionarray['id'];
	    $user_email = $sessionarray['email'];
	  
	    $this->load->library('email');

		// $this->email->from($user_email,$your_name);
		// $this->email->to($teach_email);
		// $this->email->subject('Queries');
		// $this->email->message($ques);
		//new code
		$this->load->model('admin/programs_model');
		//$coursename = $this->programs_model->getCoursename5($pro_id);
		
		$configarr = $this->settings_model->getItems();	
		$teacher_name =  $this->programs_model->getUserName($teacher_id);
		//$teacher_email =  $this->programs_model->getUserNameEmail($sessionarray['email']);

		$urldomain = base_url();
		$urldomain = str_replace('http://', '', $urldomain);
		$urldomain = str_replace('/', '', $urldomain);
		$urldomain = str_replace('www.', '', $urldomain);
            
            //Email to teacher
                    $subject = trim(ucfirst($fname1))." ".trim(ucfirst($lname1)) ." Have Query";
					$toemail = $teach_email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($teacher_name)).',<br /><br />';
					$content .= "Here Are Query  Details :<br /><br />";
					$content .= ' Query :<br /><br />';
					$content .=  '"'.$ques.'"<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';					
					// $content .='<br /><br />';
					// $content .='...</p>';
					// $content .= $configarr[0]['signature'].'</p>';				
					
					$data['content'] = $content;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);					
					
					$fromemail = 'noreply@'.$urldomain; //$configarr[0]['fromemail'];// admin mail		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();

		//code end	
      
		//$this->email->send();
		
		if($ques)
		{
		    //$this->email->send();
			
			$data = array(
				'subject' => 'Queries',
				'message' => $ques,
				'receiver_id' => $teacher_id,
				'sender_id' => $user_id,
				'program_id' => $pro_id,
				'message_date' => date("Y-m-d h:i:s")				
			);
			
			$this->load->model('Program_model');
			$message_id = $this->Program_model->insertMessage($data);			
			$name = $this->settings_model->getName($user_id);			

			$data_activity ="";
			if($user_id != $teacher_id)
			{
				$data_activity = array(
				'activity' => 'You received a new message from '.$name,
				'sender_id' => $user_id ,
				'receiver_id' => $teacher_id ,
				'activity_type' => 'message',
				'activity_date' => date("Y-m-d"),
				'visit_id' => $message_id
			    );

			    $this->load->model('Category_model');  
			    $this->Category_model->insertActivity($data_activity);
			    echo "<font color='green'>Email Successfully Send</font>";
		    }
		    else
		    {
		    echo "<font color='red'>You Can not send this message </font>";	
		    }		  
		 
		    

			//$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Message Sent Successfully!' ));
			
		}
		else
		{
		    //$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please Enter Question' ));
		    echo "<font color='red'>Please Enter Question</font>";
		}
        ?>
		<!--<script type="text/javascript">
			window.parent.location.href = "<?php echo base_url(); ?>category";
		</script>-->
		<?php
	}
	
	public function lists($parent_id = NULL)
	{
	   	$u_data = $this->session->userdata('logged_in');
	   
		$maccessarr = $this->session->userdata('maccessarr');
		/*echo '<pre>';
		print_r($maccessarr);
		echo '</pre>';
		*/
		if(($maccessarr['courses']=='view_all') || ($maccessarr['courses']=='own') || ($maccessarr['courses']=='modify_all'))
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
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$sess_programs = $this->session->userdata('sess_programs');

	    // Academy Configuaration data
        $config_course = $this->config->item('webinar');	
        $course_limit = $config_course['courselimit'];
        $this->template->set("course_limit",$course_limit);	
        // end

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
	
		//$path=base_url() . "programs/lists/";
		$path=base_url() . "manage/courses/";
	
		$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
		//$baseurl = base_url() . "programs/lists";
		$baseurl = base_url() . "manage/courses";
		$this->load->library('pagination');
		$config["base_url"] = $baseurl;
		$config['per_page'] = 10;
		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 3;
	    $config['total_rows'] = $this->program_model->getprogramcount($search_string,$search_status,$search_cate,$user_id);		
		$this->template->title('Courses List');
		$this->pagination->initialize($config);
 
       //$this->db->last_query();
		
		//new code
		
	
		/*** V S **/
	
		$u_data=$this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		
		if(($u_data['groupid']==='4') || (@$maccessarr[2]=='modify_all'))
			$progassign=$this->program_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$user_id);
		else
		$progassign=$this->program_model->getItems1($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$user_id);
	
		/** V E **/
	
		$this->template->set("programs",$progassign);
		$this->template->set('categories',$this->programs_model->getcategories());
		$this->template->set("search_string", $search_string);
		$this->template->set("status", $search_status);
		$this->template->set("countprograms", $this->program_model->getcountprogram($user_id));
		 $this->template->set("countprogConfig", $this->program_model->getProgramforConfig());
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('programs/list');
		}
		else
		{
		 	//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to Copy any course' ));
			redirect('category/pagenotfound');
		}
	}	
	
	public function enrolled($id = NULL)
	{	       
	    //$sessionarray = $this->session->userdata('logged_in');
        //$u_id = $sessionarray['id'];
		//$enroll=$this->programs_model->getEnrollstudentslist($id);
		$course = $this->uri->segment(3);
		$enroll=$this->program_model->getEnrolledUser($course);
		
		$this->template->set("enroll",$enroll);
		$configarr = $this->settings_model->getItems(); 
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
		$this->template->title("Enrolled Students");
		$this->template->build('programs/enrolled');
	}
	
	public function lectures($id = NULL)
	{	
	          	
        if(!$this->session->userdata('logged_in'))
		{
		   redirect('users/login');
		}	
		$sessionarray = $this->session->userdata('logged_in');
		

	    $user_id = $sessionarray['id'];
	    $usermail = $sessionarray['email'];
	    $userfname = $sessionarray['first_name'];

	    $this->template->set('usermail',$usermail);
	    $this->template->set('userfname',$userfname);
		
		$configarr = $this->settings_model->getItems(); 
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);		
		
		$course_id = $this->uri->segment(3);
		$programs = $this->program_model->getProgram($course_id);
		
		$course_days = $this->program_model->getlistDaysarray($course_id);
		
		//$hasaccess = $this->haveAccess($course_id, $programs, $course_days);
		//$hasaccess = (in_array('hasaccess',$hasaccess))? TRUE : FALSE;
		//$this->template->set("buybutton", $buybutton);
		//$this->template->set("hasaccess", $hasaccess);
		
		$students = $this->program_model->getEnrolledUser($course_id);
		$this->template->set("webinars", $this->program_model->getWebinarsNewAll($course_id));
	 	$this->template->set('course_id',$course_id);
	 	$this->template->set('students',$students);
		$date_enrolled = $this->program_model->datebuynow($course_id, $user_id); // stdClass Object ( [buydate] => 2015-01-22 )
		
		$this->load->model('Category_model');
		
		if(count($date_enrolled) == 0 || (time() > strtotime($date_enrolled->expired_date)))
		{
		    $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Enroll or Buy Now to View this Course' ) );
			redirect('programs/programs/'.$course_id);
		} 
			
		$students = $this->program_model->getEnrolledUser($course_id);
	 	$this->template->set('students',$students);
		$this->template->set("ViewedLessons", $this->program_model->countViewedLesson($user_id, $course_id));
		$this->template->set("days", $this->program_model->getlistDays($course_id));
		$this->template->set("quizcomment", $this->program_model->getLessonQuery($course_id));
		$this->template->set("followers", $this->program_model->getFollower($user_id));		
		$this->template->set("user_id", $user_id);
		$this->template->set("reviews", $this->program_model->getReview($user_id,$course_id));
		$this->template->set('programs',$programs);	
		$this->template->set("reviewsnew", $this->program_model->getAllReview($course_id));			
		$this->template->build('programs/lectures');
	}
	
	
	public function SaveAndGetQueryList()
	{
	//print_r($_POST);exit;

	$this->load->helper('form');

	$this->load->model('Tasks_model');

	$sessionarray = $this->session->userdata('logged_in');

	$user_id = $sessionarray['id'];

	$group_id = $sessionarray['groupid'];	

	

	$query_title = $this->input->post('query_title');

	$query_text = $this->input->post('query_text');

	$pro_id = $this->input->post('qpid');

	

	if(isset($query_title) && isset($pro_id)){

	 $data = array(

		'query_title' => $query_title,

		'query_text' => $query_text,

		'user_id' => $user_id,

		'pro_id' => $pro_id,

		'dateandtime' => date("Y-m-d h:i:s")

		);

	 $query_id = $this->Tasks_model->saveLessonQueryAsk($data);
	
	
	 $this->load->model('Category_model');	  
	 
	  $Program_name = $this->settings_model->getCourseName($pro_id);
	  $author = $this->settings_model->getTeacherId($pro_id);
	  
	  if($user_id != $author)
	  {	   
		  $data_activity = array(
			'activity' => $name.' asked question on '.$Program_name,
			'sender_id' => $user_id ,
			'receiver_id' => $author ,
			'activity_type' => 'question',
			'activity_date' => date("Y-m-d"),
			'visit_id' => $pro_id
		  );
		  
		} 
	
	  $this->Category_model->insertActivity($data_activity);

	}

    else{

   	$pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;

   	$mod_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : 0;

	$lesson_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;

	}

	$wheredata = array(
	
	   'user_id' => $user_id,
	

		'pro_id' => $pro_id		

		);

       // print_r($wheredata); exit;

		$query_details =$this->Tasks_model->getLessonQueriesAsked($wheredata);

        //print_r($query_details); exit;

		$querydata = array();

		foreach($query_details as $querydetail){

		$querydata[] = array("__class" => "question",

			"id" => $querydetail["query_id"],

			"title" => $querydetail["query_title"],

			"body" =>$querydetail["pro_id"],

			"course_id" =>$querydetail["mod_id"],

			"lecture_id" =>$querydetail["lesson_id"],

			"user" => $querydetail["user_id"],

			"created" =>$querydetail["dateandtime"]
			);
		}

		
		echo json_encode($querydata);
	} 
	
	public function students($id = NULL)
	{	       
		$configarr = $this->settings_model->getItems(); 
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);		
		
		$course_id = $this->uri->segment(3);
		$students = $this->program_model->getEnrolledUser($course_id);
		$prog_name = $this->program_model->getProgramName($course_id);
		/*echo '<pre>';
		print_r($students);
		echo '</pre>';*/		
		$this->template->set('programname',$prog_name);
		$this->template->set('students',$students);
		$this->template->build('programs/students');
	}
	
	public function statistics()
	{
		$configarr = $this->settings_model->getItems(); 
		$this->template->set("configarr", $configarr);
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);	
		$this->template->title("Statistics");	
		$this->template->build('programs/statistics');
	}
	
	
	public function saveanswer()

	{    
      
	$this->load->helper('form');

	$this->load->model('Tasks_model');

	$sessionarray = $this->session->userdata('logged_in');

	$user_id = $sessionarray['id'];

	$group_id = $sessionarray['groupid'];



	//$datestring = "%Y-%m-%d %h:%i:%s";

	//$time = time();

	//$currdate = mdate($datestring, $time);

     

    $answer = $this->input->post('answer');

  	$query_id = $this->input->post('query_id');

   //	$query_id = $this->input->post('query_id');

	$pro_id = $this->input->post('pid');

	//$mod_id = $this->input->post('mod_id');

	//$lesson_id = $this->input->post('lesson_id');

	
    if(isset($answer)){

    	 $data = array(

    		'answer' => $answer,

    		'query_id' => $query_id,

    		'pid' => $pro_id,

    		'user_id' => $user_id,

    		'dateandtime' => date("Y-m-d h:i:s")

    		);  
        
		
	   

     	 $ans_id = $this->Tasks_model->saveLessonAnswer($data); // open it
		  
		  $this->load->model('Category_model');     
		  
		  $author = $this->settings_model->getTeacherId($pro_id);
	      
		  $Program_name = $this->settings_model->getCourseName($pro_id);
		  
		  if($user_id == $author)
		  {
			$name = 'You';
		  }
		  else
		  {
			$name = $this->settings_model->getName($user_id);
		  }
	
		  $data_activity = array(
			'activity' => $name.' comments in '.$Program_name,
			'sender_id' => $user_id ,
			'receiver_id' => $author ,
			'activity_type' => 'comment',
			'activity_date' => date("Y-m-d"),
			'visit_id' => $pro_id
		  );
		  
		 

        $this->Category_model->insertActivity($data_activity); // open it		  
		  

       // print_r($wheredata); exit;

		$query_details =$this->program_model->getLessonAnswer($query_id);

		$querydata = array();

		foreach($query_details as $querydetail){

		$querydata[] = array("__class" => "question",

			"ans_id" => $querydetail["ans_id"],

			"answer" => $querydetail["answer"],

			"query_id" =>$querydetail["query_id"],

			"pid" =>$querydetail["pid"],

			"mod_id" =>$querydetail["mod_id"],

			"lesson_id" => $querydetail["lesson_id"],
			
			"user_id" => $querydetail["user_id"],
			
			"dateandtime" => $querydetail["dateandtime"]
			
			);
		}
		
		

		//echo json_encode($querydata);
		//new code strat
		$lessonAns = $this->program_model->getLessonAnswer($query_id);
		foreach($lessonAns as $answer)
		{
			$timeago=$this->get_timeago(strtotime($answer['dateandtime']));
		$userData = $this->program_model->getStudentsInfo($answer['user_id']);
		echo"<li id=li".$answer['ans_id'].">
				<div class='comment'>
						<div class='comment-thumb'><a href='#'><img src=".base_url()."public/uploads/users/img/thumbs/".$userData->images ." alt='' class='img-circle' width='44'></a></div>
						<div class='comment-content'>
							<div class='comment-author' style='font-size: 13px;'> <a href='#'>".$userData->first_name ." ".$userData->last_name."</a> - Commented On ".$timeago."</div>															
							<div class='comment-text'>".$answer['answer']."</div>
						</div>
				</div>
			</li>";
		
		}
		//new code end
		
		

      }


     return true;
	}
	
	
	public function like()
	{
	  
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
	  
	  $query_id = $this->input->post('query_id');
	  $questioner_id = $this->input->post('questioner_id');
	  $pro_id = $this->input->post('pro_id');
	  
	  
        $this->load->model('Category_model');
        
	  
	  $data = array(		
		'query_id' => $query_id,
		'pro_id' => $pro_id,
		'user_id' => $user_id,
		'like_date' => date("Y-m-d")
	  );
 		
	 $like_id = $this->Category_model->getInsertLike($data);
	 
	 $total_likes = $this->Category_model->getAllLike($query_id); 
	 
	
	  
	
	   if($user_id == $questioner_id)
	   {
			$name = 'You';
	   }
	   else
	   {
			$name = $this->settings_model->getName($user_id);
	   }
		  $data_activity = array(
			'activity' => $name.' likes your Question',
			'sender_id' => $user_id ,
			'receiver_id' => $questioner_id ,
			'activity_type' => 'like',
			'activity_date' => date("Y-m-d"),
		    'visit_id' => $pro_id
		  );
	  
	  $this->Category_model->insertActivity($data_activity);
	  
	  if($like_id)
	  {
      echo " <i class='entypo-heart'></i><span onclick='unlike($like_id,$query_id,$questioner_id,$pro_id)'>Liked<span>($total_likes)</span></span>";
       return;	  
	  }
	  
	}
	
	public function unlike()
	{
	  
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
	  
	  $like_id = $this->input->post('like_id');
	  $query_id = $this->input->post('query_id');
	  $questioner_id = $this->input->post('questioner_id');
	  $pro_id = $this->input->post('pro_id');	  
	  
         $this->load->model('Category_model');
	 
	  $this->Category_model->getDeleteLike($like_id);
	  
	  $total_likes = $this->Category_model->getAllLike($query_id); 
	
	 
	  
	  if($user_id == $questioner_id)
	   {
			$name = 'You';
	   }
	   else
	   {
			$name = $this->settings_model->getName($user_id);
	   }
	
		  $data_activity = array(
			'activity' => $name.' unlikes your Question',
			'sender_id' => $user_id ,
			'receiver_id' => $questioner_id ,
			'activity_type' => 'like',
			'activity_date' => date("Y-m-d"),
		    'visit_id' => $pro_id
		  );
	  
	  $this->Category_model->insertActivity($data_activity);
	  
	  
      echo " <i class='entypo-heart'></i><span onclick='like($query_id,$questioner_id,$pro_id)'>Like<span>($total_likes)</span></span>";
       return;	  
	 
	  
	}
	
	public function follow()
	{
	  
	  $sessionarray = $this->session->userdata('logged_in');
	  $follower_id = $sessionarray['id'];
	  $followee_id = $this->input->post('followee_id');  
        
	  
	  $data = array(
		'followee_id' => $followee_id,
		'follower_id' => $follower_id,
		'follow_date' => date("Y-m-d h:i:s")
	  );
 		
		 $this->load->model('Category_model');  
	     $follow_id = $this->Category_model->InsertFollower($data); 
	  
	     $name = $this->settings_model->getName($follower_id);
	   
		  $data_activity = array(
			'activity' => $name.' is now following You',
			'sender_id' => $follower_id ,
			'receiver_id' => $followee_id ,
			'activity_type' => 'follow',
			'activity_date' => date("Y-m-d"),
			'visit_id' => '0'
		  );
	  
	      $this->Category_model->insertActivity($data_activity);
	  
	  if($follow_id)
	  {	  
		echo "<a href='javascript:void(0)' onclick='ajax_following($followee_id,$follow_id)' class='btn btn-success'>Following</a> <a href='#' class='btn'>Message</a>";
		return;	  
      }		
	  
	}
	
	public function following()
	{
	  
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
	  $follow_id = $this->input->post('follow_id');  
	  $followee_id = $this->input->post('followee_id');    
	  
 	  $this->load->model('Category_model');  
	  $this->Category_model->deleteFollower($follow_id); 
	  
	  $name = $this->settings_model->getName($user_id);
	  
	  
	   
		  $data_activity = array(
			'activity' => $name.' stop following You',
			'sender_id' => $user_id ,
			'receiver_id' => $followee_id ,
			'activity_type' => 'follow',
			'activity_date' => date("Y-m-d"),
			'visit_id' => '0'
		  );
		  
	   $this->Category_model->insertActivity($data_activity);
	  
      echo "<a href='javascript:void(0)' onclick='ajax_follow($followee_id)' class='btn btn-info'>Follow</a> <a href='#' class='btn'>Message</a>";
       return;	    
	  
	}
	
	// public function upload_image2()
	// {
	//    error_reporting(0);
 //       $this->load->helper('directory');
	//    $this->load->helper('file');
	//    $status = "";
	//    $msg = "";
	//    $ftpfiles_i = array();
	//    $file_element_name = 'file_i';
	//    if(empty($_POST['type']))
	//    {
	// 	  $status = "error";
	// 	  $status = "done";
	// 	  $msg = "Please select a type";
	//    }

	//    if ($status != "error")
	//    {
	// 	  $config['upload_path'] = 'public/uploads/programs/img';
	// 	  $config['allowed_types'] = 'gif|jpg|png|jpeg';
	// 	  $config['max_size']  = 1024 * 8;
	// 	  $config['encrypt_name'] = TRUE;
	// 	  $config['overwrite'] = TRUE;
	// 	  $config['file_name'] = $_FILES['orig_name'];
 //          $ftpfiles_i = $_FILES['orig_name'];
	// 	  $this->load->library('upload', $config);

	// 	  if (!$this->upload->do_upload($file_element_name))
	// 	  {
	// 		 $status = 'error';
	// 		 $msg = $this->upload->display_errors('', '');
	// 	  }
	// 	  else
	// 	  {
 //            ///$ftpfiles_i = $this->medias_model->fileslist('public/uploads/images', 'image');
	// 		 $file_id = true;
 //            $data = $this->upload->data();
	// 		 $file_id = true;
	// 		 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
	// 		 if($file_id)
	// 		 {
               
 //                $status = "success";
 //          		$msg = "File successfully uploaded";
 //                $config = array();
 //        		$config['image_library'] = 'gd2';
 //        		// $config['source_image'] = FCPATH.'public/uploads/programs/img/'.$data['file_name'];
 //        		$config['source_image'] = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
 //        		$config['new_image'] = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
 //        		$config['create_thumb'] = TRUE;
 //        		$config['maintain_ratio'] = FALSE;
 //        		$config['master_dim'] = 'width';
 //                //$config['width'] = 291;
 //                //$config['height'] = 164;
 //                $config['width'] = 291;
 //                $config['height'] = 164;
 //                $config['x_axis'] = 0;
	// 			$config['y_axis'] = 0;
 //        		$config['thumb_marker'] = '';
 //                $this->load->library('image_lib', $config);
 //                //$this->image_lib->resize();
 //                if(!$this->image_lib->crop())
	// 			 {
 //        		echo $this->image_lib->display_errors();
	// 			 }
	// 		 }
	// 		 else
	// 		 {
	// 			unlink($data['full_path']);
	// 			$status = "error";
	// 			$msg = "Something went wrong when saving the file, please try again.";
	// 		 }
	// 	  }
 //         // echo $_FILES[$file_element_name];
	// 	  @unlink($_FILES[$file_element_name]);
	//    }
	//    //echo 'success';
	//   // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	//     json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	// }

	public function upload_image()
	{
		$date = date('d');
      $month = date('m');
      $year = date('Y');
      $random_no = rand(1000,5000);
      $generate = $random_no.'_'.$year.'-'.$month.'-'.$date;

	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file_i';
	   if(empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/programs/img';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
          $ftpfiles_i = $generate.$_FILES['orig_name'];
		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
            ///$ftpfiles_i = $this->medias_model->fileslist('public/uploads/images', 'image');
			 $file_id = true;
            $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
               
                $status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/programs/img/'.$data['file_name'];
        		$config['new_image'] = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
        		$config['width'] = 291;
                $config['height'] = 164;
                $config['x_axis'] = 0;
				$config['y_axis'] = 0;
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
               if($this->image_lib->resize())
               {
    //             if(!$this->image_lib->crop())
				// {
    //     		echo $this->image_lib->display_errors();
				// }
				//$this->upload_image2();
			    }
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	    $imgupload = json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
		return $imgupload;
	}

	function cropcourseimg()
	{
		$this->template->build('programs/cropcourseimg');
	}

	

	public function uploadcourseimg()
    {			  
    	$data = $_POST['img'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);		
		
		//$folder = $this->session->userdata("shot_upload_folder_name");
		$capturedate = date("Y-m-d H:i:s");
		$datetime1 = explode(' ',$capturedate);
		$name1 = 'scr_'.$datetime1[0].'_'.$datetime1[1];

		$generate1 = "";
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;

  	   // echo $generate1 . '.png';
		 $f1 = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$generate1 .'.png';
         $f2 = FCPATH.'public/uploads/programs/img/thumbs/'. $generate1 . '.png';

         if(file_exists($f1) || file_exists($f2))
         {      	
         	    $generate1 = "";
				$date = date('d');
		  		$month = date('m');
		  		$year = date('Y');
		  		$random_no = rand(1000,5000);
		  		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;
		  		echo $generate1 . '.png';
         }
         else
         {
         	echo $generate1 . '.png';
         }

		$file2 = FCPATH.'public/uploads/programs/img/thumb_232_216/'. $generate1 . '.png';
		if(file_put_contents($file2, $data))//for upload file to the server
		{	
			$imageorig = FCPATH.'public/uploads/programs/img/thumb_232_216/'. $generate1 . '.png';  
			 			list($width, $height, $type, $attr) = getimagesize($imageorig);			 		
			 	     $newhgt =  $height / $width * 130;
			
				
			   $orig = FCPATH.'public/uploads/programs/img/thumb_232_216/'. $generate1 . '.png';
               $newsizeimg = FCPATH.'public/uploads/programs/img/thumbs/'. $generate1 . '.png';

            $this->load->helper('create_square_image');

            create_square_image($orig,$newsizeimg,130);


		}
		$course_id = $this->uri->segment(3);
		//echo $this->uri->segment(4);
		if($this->uri->segment(4) == 'courseedit')
		{

		$form_data =  array(						
					'image' => $generate1.".png"						
					);
 		$this->program_model->updateItem($course_id,$form_data);

 	   } 
 	   //else if($this->uri->segment(4) == 'coursecreate')
		// {
			
		// }
		
    }

	public function create()
	{	
         // Academy Configuaration data

           $config_course = $this->config->item('webinar');	
           $course_limit = $config_course['courselimit'];

           $config_exam = $this->config->item('webinar');	
           $exam_facility = $config_exam['examfacility'];

          $countprogConfig = $this->programs_model->getProgramforConfig();
    	  $this->template->title("Create Course");
        if($course_limit <= $countprogConfig)
        {
            
           	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please upgrade subscription to create more courses' ));
			//$this->template->build('admin/programs/list');
			redirect('manage/courses/');
        }	

		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($maccessarr['courses']=='own') || ($maccessarr['courses']=='modify_all'))
		{
		$sessionarray = $this->session->userdata('logged_in');

        $user_id = $sessionarray['id'];
        $groupid = $sessionarray['groupid'];  
         
		if( !isset($user_id) || $user_id == 0)
		{
			redirect('users/login');
		}
		else
		{		
		$this->load->model('/settings_model');
		$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
		
        $this->load->model('admin/medias_model');
	   	$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$this->_set_rules();
		$this->template->set('facility',$exam_facility);
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
        $get_media_ids = $this->input->post('media_id');
        $this->template->set('get_media_ids',$get_media_ids);
        $get_req_ids = $this->input->post('req_id');
        $this->template->set('get_req_ids',$get_req_ids);
		$this->template->set('categories',$this->programs_model->get_formatted_combo($parent_id));
		$this->template->set('teachers',$this->programs_model->getUsers('Trainer'));
		$this->template->set('renewalplans',$this->programs_model->getRenewalPlans($parent_id));

        $this->template->set('groups',$this->programs_model->getGroup());
        $this->template->set('courses',$this->programs_model->getCourse());
        $this->template->set('plans',$this->programs_model->getPlans($parent_id));
		$this->template->set('finalexamlist',$this->programs_model->getFinalQuiz(0));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        if($groupid == '4')
        {
        	$this->form_validation->set_rules('teacher_id', 'Teacher', 'required');
        }
		
		$plan = $this->input->post('plan');
		
		if($plan == 'subscription')
		{
        	if(($this->input->post('chb_free_courses') == 0 && $this->input->post('step_access_courses') == 0 && $plan =='subscription') || ($this->input->post('chb_free_courses') == 1 && $plan =='subscription'))
			{
				if($this->input->post('chb_free_courses')=='on' && $this->input->post('step_access_courses')=='0')    
				{
					$this->form_validation->set_rules('selected_course', 'course', 'required');
				}
					
				if($this->input->post('chb_free_courses')=='on')
				{
					$this->form_validation->set_rules('subscription_default', 'subscription', 'required');
				}
				if($this->input->post('subscription_default'))
				{
					$this->form_validation->set_rules('subscriptions', 'subscription checkbox', 'required');

					if(count($this->input->post('subscription_price'))>0)
					{
						$subplanarr=$this->input->post('subscription_price');
						foreach($subplanarr as $key=>$eachval)
						{
							if($eachval !='')
							{
								$this->form_validation->set_rules("subscription_price[$key]", 'price', 'required|greater_than[0]');
							}
						}
					}
				}

				if($this->form_validation->set_rules('subscription_default', 'subscription', 'required'));
			}
		}
		else if($plan == 'fixed')
		{				

			if(($this->input->post('chb_free_courses') == 0 && $this->input->post('step_access_courses') == 0 && $plan =='fixed') || ($this->input->post('chb_free_courses') == 1 && $plan =='fixed'))
			{
			   
				$this->form_validation->set_rules('fixedrate', 'fixedrate', 'required');
			}
		}

		
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('programs/create');
		}
		else
		{				  
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
			$orderingval = $this->programs_model->maxorder();
			//$imagename = ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg';
		
			//$this->upload_image();		
			//$imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : 'no_image.jpg';
			$uploadName= $this->upload_image();
			$data5 = json_decode($uploadName,true);  
      		$imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : 'big-image-default.jpg';

		$reminders=$this->input->post('reminders');
		if($reminders)
		{
			$reminders = implode(',',$reminders);
		}

        $free_courses = $this->input->post('chb_free_courses');
        $access_courses = $this->input->post('step_access_courses');
        if(isset($access_courses) && $access_courses == '0'){
        if($this->input->post('selected_course'))
		{
			$selected_course_string = '';
			$selected_course1 = $this->input->post('selected_course');
			if(isset($selected_course1))
			{
				foreach($selected_course1 as $key=>$value) 
				{
						if($value == "-1") 
						{
							$selected_course_string='-1';
							break;
						}
						else 
						{
							$selected_course_string.=$value."|";
						}
				}
			}
			else
			{
				$selected_course_string = NULL;
			}
        }
		else
		{
           $selected_course_string = NULL;
		}
		}
		else
		{
			$selected_course_string = NULL;
		}
 		
 		//@@@@@@@@@@new code add by sachin for assistant teacher start here
            	
            	
                 if($this->input->post('assistant_id')){
                  $assistant_teachers = '';
                  $assistant_id = $this->input->post('assistant_id');
                      if(isset($assistant_id)){
                          foreach($assistant_id as $key=>$keyvalue) {
						      
                  		   		if($keyvalue == "-1") {
                                       $assistant_teachers='-1';
                                      break;
                  				}
                  				else {
                  					 $assistant_teachers.=$keyvalue."|";
                                 }
              		   }
					  
                     }else{
                           $assistant_teachers = NULL;
                     }
                 }else{
                       $assistant_teachers = NULL;
                 }
            
            //@@@@@@@@@@ new code for assistant teacher end here
            //@@@@@@@@@ new code for exersice file start here
			       if($this->input->post('media_id') != ''){
			       //$mediafile_id = rtrim($this->input->post('media_id'), ",");
			      $mediafile_id1 = implode(',', $this->input->post('media_id'));
			      $mediafile_id = rtrim($mediafile_id1, ",");
			       }else{			        
			        $mediafile_id =null;
			       }
			       
             //@@@@@@@@@ new code for exersice file end here 
	//@@@@@@@@@@@@@@@@@@@@@@@new code for Prerequisites file start here
			       if($this->input->post('req_id')!= ''){
			       	$preqfiles_id1 = implode(',', $this->input->post('req_id'));
			        $preqfiles_id = rtrim($preqfiles_id1, ",");
			       }else{			        
			        $preqfiles_id =null;
			       }

			    //@@@@@@@@@@@@@@@@@@@@@@@ new code for Prerequisites file end here 


      	$subprice = $this->input->post('subscription_price');
      	$subplans = $this->input->post('subscriptions');
      	$chb_free_courses = $this->input->post('chb_free_courses');

      	$chb_free_courses = (isset($chb_free_courses) && ($chb_free_courses == 'on')) ? 1 : 0;
      	$webcam_option = $this->input->post('webcam_option');
      	$webcam_option = (isset($webcam_option) && ($webcam_option == 'on')) ? 1 : 0;
      	$published = $this->input->post('published');
      	$showresult_option = $this->input->post('show_result');            
        $showresult_option = (isset($showresult_option) && ($showresult_option == 'on')) ? 1 : 0;
      	
      	// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
      	$fixedrate ="0.00";

		$free_coursesforcond = $this->input->post('chb_free_courses');
        $access_coursesforcond = $this->input->post('step_access_courses');
        $planforcond = $this->input->post('plan'); 
        $selected_course = $this->input->post('selected_course');	       

		if(($free_coursesforcond == 0 && $access_coursesforcond == 0 && $planforcond =='fixed') || ($free_coursesforcond == 1 && $planforcond =='fixed'))
		{			
			$fixedrate = $this->input->post('fixedrate');

		} 
		 
		if(($free_coursesforcond == 1 && $planforcond =='fixed') || ($free_coursesforcond == 1 && $planforcond =='subscription'))
		{
			$access_coursesforcond = 0; 
			    	
		}

		// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

      	$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'alias' => $alias,
				'catid' => $this->input->post('category_id'),
				//'introtext' => $this->input->post('category_id'),
				'image' => $this->input->post('cropimage'), // $imagename
				'emails' => $reminders,
				'published' => $published,
				'startpublish' => $this->input->post('startpublish'),
				'endpublish' => $this->input->post('endpublish'),
				'metatitle' => $this->input->post('metatitle'),
				'metakwd' => $this->input->post('metakwd'),
				'metadesc' => $this->input->post('metadesc'),
				'ordering' => $orderingval,
				'pre_req' => $this->input->post('pre_req'),
				'pre_req_books' => $this->input->post('pre_req_books'),
				'reqmts' => $this->input->post('reqmts'),
				//'author' => $this->input->post('teacher_id'),
				'author' => $user_id,
				'level' => $this->input->post('level'),
				//'priceformat' => $this->input->post('level'),
				'fixedrate'	=> $fixedrate,  //$this->input->post('fixedrate'),
				'skip_module' => '0',     //$this->input->post('skip_module'),
				'chb_free_courses' => $free_coursesforcond, //$chb_free_courses,
				'step_access_courses' => $access_coursesforcond, //$this->input->post('step_access_courses'),
				'selected_course' => trim($selected_course_string,"|"),  //$this->input->post('selected_course'), //$selected_course_string
				'course_type' => $this->input->post('course_type'),
                'lesson_release' => $this->input->post('lesson_release'),
				'lessons_show' => $this->input->post('lessons_show'),
				'start_release' => $this->input->post('startpublish'),
				'id_final_exam' => $this->input->post('final_quizzes'),
				'certificate_term' => $this->input->post('certificate_setts'),
				//'hasquiz' => $this->input->post('final_quizzes'),
				'updated' => $this->input->post('certificate_setts'),
				'certificate_course_msg' => $this->input->post('coursemessage'),
                'webcam_option' => $webcam_option,
                'created_by' => $user_id,
                'webstatus' => $this->input->post('webstatus'),
                'webnardescription' => $this->input->post('webnardescription'),
                'time_for_webcam' => $this->input->post('CbShot'),
                'show_result' => $showresult_option,
                'introtext' => $assistant_teachers,
                'programmedias'=>$mediafile_id,
                'prerequisitesfiles'=>$preqfiles_id,
			);	
		
			
        $inserted_id = $this->program_model->insertItems($data);
        $pro_id = $this->programs_model->maxprogramid();


        $configarr = $this->settings_model->getItems();	

		$cat_name = $this->programs_model->getCatNameByCatID($sessionarray['groupid']);
		$teacher_name =  $this->programs_model->getUserName($sessionarray['id']);
		$teacher_email =  $this->programs_model->getUserNameEmail($sessionarray['email']);
		$category_name = $this->programs_model->getcategory_name($this->input->post('category_id')); 
		
		$urldomain = base_url();
		$urldomain = str_replace('http://', '', $urldomain);
		$urldomain = str_replace('/', '', $urldomain);
		$urldomain = str_replace('www.', '', $urldomain);
            
            //Email to teacher
                   // $subject = "New Course '".trim(ucfirst($this->input->post('name')))."' has been created in ".$configarr[0]['institute_name'];
                    $subject = "New Course '".trim(ucfirst($this->input->post('name')))."' created in ".$configarr[0]['institute_name'];
					$toemail = $sessionarray['email'];//$teacher_email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= "<p style='font-size: 17px; font-weight: bold; text-transform: uppercase'>New Course '".trim(ucfirst($this->input->post('name')))."' created in ".$configarr[0]['institute_name']."</p>";
					$content .= '<p>Dear '.trim(ucfirst($teacher_name)).',<br /><br />';
					$content .= "New course  '".$this->input->post('name')."' has been successfully created in '".$configarr[0]['institute_name']."' under '".$category_name->name."'.<br /><br />";
					$content .=' Now you can access and manage this course in the "My Courses" section under the "Teaching Zone" of the  <a style="color:#55c5eb" href ='.base_url().'>'.base_url().' </a>.<br /><br />';
					$content .='If you need help or have any questions, please contact us.';					
					// $content .='<br /><br />';
					// $content .='...</p>';
					// $content .= $configarr[0]['signature'].'</p>';					
					//$content .='Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team</p>';
					
					$data['content'] = $content;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail = 'noreply@'.$urldomain; //$configarr[0]['fromemail'];// admin mail		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();

					$admininfo1 = $this->login_model->getadminInfo(4);
			//Email to admin
                    //$subject = 'New Course "'.$this->input->post('name').'" has been created in '.$configarr[0]['institute_name'].' by '.ucfirst($teacher_name);
                    $subject = "New Course '".trim(ucfirst($this->input->post('name')))."' created in your ".$configarr[0]['institute_name'];
					$toemail = $admininfo1->email; // $teacher_email
					//$toemail = $teacher_email;
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					//$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= "<p style='font-size: 17px; font-weight: bold; text-transform: uppercase'>New Course '".trim(ucfirst($this->input->post('name')))."' created in your ".$configarr[0]['institute_name']."</p>";
					$content .= '<p>Dear '.trim(ucfirst($admininfo1->first_name)).',<br /><br />';
					$content .= 'New course "'.$this->input->post('name').'" has been successfully created in "'.$configarr[0]['institute_name'].'" by '.ucfirst($teacher_name).'.<br /><br />';
					$content .='You can also edit the access granted to this teacher by going to the “Users and Permissions” section in <a style="color: #55c5eb;" href = '.base_url().'admin >'.base_url().'admin</a>.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br />';					
					// $content .='<br /><br />';
					// $content .='...</p>';
					// $content .=$configarr[0]['signature'].'</p>';
					//$content .='Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail = 'noreply@'.$urldomain;     //$configarr[0]['fromemail'];		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();

  if(($free_coursesforcond == 0 && $access_coursesforcond == 0 && $planforcond =='subscription') || ($free_coursesforcond == 1 && $planforcond =='subscription'))
	 {

		$plans = $this->input->post('subscriptions');
		$plans = (!empty($plans)) ? $plans : array(0=>0);
		$price = ($this->input->post('subscription_price')) ? $this->input->post('subscription_price') : '0';
		$sub_default = $this->input->post('subscription_default');
		if($plans[0] !=0 ){
		$i=0;
			foreach($plans as $element) 
			{
		    $sub_default == $element ? $default = '1' : $default = '0';
				$plans_data = array(
						   'product_id' => $pro_id,
						   'default' => $default,
						   'default_new' => $default,
						   'plan_id' => $plans[$i],
						   'price' => $price[$element]
					   );
				$this->programs_model->insertPlans($plans_data);
				$i++;
			}
		}

       $ren_plans = $this->input->post('renewals');
	   $ren_plans = (!empty($ren_plans)) ? $ren_plans : array(0=>0);
       $renprice = $this->input->post('renewalprice');
       $ren_default = $this->input->post('renewal_default');
		if($ren_plans[0] !=0 ){
		   $j=0; 
		   foreach($ren_plans as $element1) {
		   $ren_default == $element1 ? $default = '1' : $default = '0';
				$renplans_data = array(
						   'product_id' => $pro_id,
						   'default' => $default,
						   'default_new' => $default,
						   'plan_id' => $ren_plans[$j],
						   'price' => $renprice[$element1]
					   );
				$this->programs_model->insertRenewals($renplans_data);
				$j++;
		   }
		}

	}
         if($this->input->post('avg_cert')){
          //$upd_data = $this->input->post('avg_cert');
           $upd_data = array(
						   'avg_cert' => $this->input->post('avg_cert')
					   );
          $this->programs_model->updateCertificates($upd_data);
        }
        	$this->load->model('admin/programs_model');
				$coursename=$this->programs_model->getCoursename5($pro_id);
				
						$urlCourse = strtolower($coursename->name);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			// redirect('days/index/'.$inserted_id);

			// if((!empty($_POST['save2'])) && ($_POST['save2']=='Save And Continue'))
			if((!empty($_POST['save2'])) && ($_POST['save2']=='Save & Back to list'))
			   	{
			   			
			   	// redirect('sections-manage/'.$inserted_id.'/'.$urlCourse);
			   		redirect('manage/courses/'.$parent_id);


			   }
			   // else
			   // {
			   // 	 redirect('manage/courses/'.$parent_id);
			   
			   // }
			    if((!empty($_POST['submit'])) && ($_POST['submit']=='Save Changes'))
			   {

			   		//redirect('sections-manage/'.$inserted_id.'/'.$urlCourse);
			   	redirect('sections-manage/'.$inserted_id.'/'.$urlCourse);

			   }
			//redirect('sections-manage/'.$inserted_id.'/'.$urlCourse);
			    if((!empty($_POST['redirect'])) && ($_POST['redirect']=='redirect'))
			   {
			   			
			   		redirect('manage/courses/'.$parent_id);
			   }
		}
		}
		/*
		//temp commneted by yogesh 
		$this->load->model('/settings_model');
		$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
		$this->template->set('updType', 'create');
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$this->template->set('parent_id',$parent_id);
		$this->template->set('renewalplans',$this->programs_model->getRenewalPlans($parent_id));
		$this->template->set('plans',$this->programs_model->getPlans($parent_id));
		$this->template->set('categories',$this->programs_model->getcategories());
		$this->template->set('teachers',$this->programs_model->getUsers('Trainer'));
		
		if(isset($this->session->userdata['logged_in']['groupid']) == 2)//for instructor only i.e. teachers
		{
			$this->template->build('programs/create');		
		}	
		else
		{
			echo 'Access Denied';
		}*/
		}
		else
		{
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category/pagenotfound');
		}
	}
	
	function trash($id = NULL)
{
//filter & Sanitize $id
$users_id = $this->programs_model->getBuyUsers($id);
if($users_id)
{
	redirect('manage/courses');
}
else
{

$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

//redirect if it´s no correct
if (!$id){
$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
redirect('manage/courses');
//redirect('programs/lists/');
}
$isdelete=$this->programs_model->trashItem($id);
//delete the item
if ($isdelete)
{
//$this->programs_model->deleteProgramPlan($id);
//$ExerciseFile = $this->medias_model->deleteExerciseFile($id);
//$Reqfiles = $this->medias_model->deleteReqfiles($id);
$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
}
else
{
$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
}
//redirect('programs/lists/');
redirect('manage/courses');
}
}

	
	function edit($id = FALSE, $parent_id = FALSE)
	{
		$parent_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('parent_id', TRUE);
		$u_data = $this->session->userdata('logged_in');
		$authorOf = $this->programs_model->courseCreatedBy_new($parent_id);
		// echo"<pre>";
		// echo $u_data['id'].'|';
		// print_r($authorOf);
		// echo"</pre>";
		 $ss = explode('|',$authorOf[0]->introtext);
		 $sss = in_array($u_data['id'],$ss);
		
		//if((@$authorOf[0]->author != $u_data['id'] && $u_data['groupid'] != '4' && @$authorOf[0]->introtext != $u_data['id'].'|') || empty($authorOf))
		if((@$authorOf[0]->author != $u_data['id'] && $u_data['groupid'] != '4' && empty($sss)) || empty($authorOf))
		{    
			
			redirect('category/pagenotfound'); 
		}

		 $config_exam = $this->config->item('webinar');	
         $exam_facility = $config_exam['examfacility'];
		
		$maccessarr=$this->session->userdata('maccessarr');
		if(($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
		{	    
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
        $this->load->model('medias_model');
		
		//Rules for validation
		$this->_set_rules('edit');
				
		//for selection of front end template layout
			$configarr = $this->settings_model->getItems();
			$logoimage=$configarr[0]['logoimage'];
			$this->template->set("configarr", $configarr); 
			$configarr = $this->settings_model->getItems();	  
			$tmpl = $configarr[0]['layout_template'];      
			$this->template->set("tmpl",$tmpl);
			$this->template->set('updType', 'create');			
			$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
			$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;		
         
		//get the parent id and sanitize
		$parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
	    $id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct

		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('programs/');
		}
		//create control variables
	    //$this->template->title(lang("web_category_edit"));
        $type = 'preq';
		$this->template->title("Edit Course");
		$this->template->set('facility',$exam_facility);
        $this->template->set('groups',$this->programs_model->getGroup());
        $this->template->set('courses',$this->programs_model->getCourse());
        $this->template->set("medias", $this->medias_model->getMediaRel($id)); 


        //$this->template->set("rerequisites", $this->medias_model->getReqRel($id));

		$this->template->set('program', $this->programs_model->getItems($id,'','',''));
		$this->template->set('updType', 'edit');
		$this->template->set('id', $id);
		$this->template->set('parent_id', $parent_id);
		$this->template->set('categories',$this->programs_model->get_formatted_combo($parent_id));
		$this->template->set('countplans',$this->programs_model->countPlans($id));
		$this->template->set('renewalplans',$this->programs_model->getRenewalPlans($id));
		$this->template->set('teachers',$this->programs_model->getUsers('Trainer'));
        $this->template->set('plans',$this->programs_model->getPlans($id));
        $this->template->set('renewalplans',$this->programs_model->getRenewalPlans($id));
        $this->template->set('program_plans',$this->programs_model->getProgramPlans($id));
		$this->template->set('finalexamlist',$this->programs_model->getFinalQuiz(0));

        $get_media_ids = $this->input->post('media_id');
        $this->template->set('get_media_ids',$get_media_ids);
        $get_req_ids = $this->input->post('req_id');
        $this->template->set('get_req_ids',$get_req_ids);

        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('category_id', 'category_id', 'required');
		//$this->form_validation->set_rules('teacher_id', 'teacher_id', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
		
		

        $this->load->model('medias_model');

        $plan = $this->input->post('plan');
		
		if($plan == 'subscription')
		{	
			if(($this->input->post('chb_free_courses') == 0 && $this->input->post('step_access_courses') == 0 && $plan =='subscription') || ($this->input->post('chb_free_courses') == 1 && $plan =='subscription'))
			{
        
				if($this->input->post('chb_free_courses')=='on' && $this->input->post('step_access_courses')=='0')    
				{
					$this->form_validation->set_rules('selected_course', 'course', 'required');
				}
					
				if($this->input->post('chb_free_courses')=='on')
				{
					$this->form_validation->set_rules('subscription_default', 'subscription', 'required');
				}
				if($this->input->post('subscription_default'))
				{
					$this->form_validation->set_rules('subscriptions', 'subscription checkbox', 'required');

					if(count($this->input->post('subscription_price'))>0)
					{
						$subplanarr=$this->input->post('subscription_price');
						foreach($subplanarr as $key=>$eachval)
						{
							if($eachval !='')
							{
								$this->form_validation->set_rules("subscription_price[$key]", 'price', 'required|greater_than[0]');
							}
						}
					}
				}

				if($this->form_validation->set_rules('subscription_default', 'subscription', 'required'));
			}
		}
		elseif($plan == 'fixed')
		{
			if(($this->input->post('chb_free_courses') == 0 && $this->input->post('step_access_courses') == 0 && $plan =='fixed') || ($this->input->post('chb_free_courses') == 1 && $plan =='fixed'))
			{

				$this->form_validation->set_rules('fixedrate', 'fixedrate', 'required');
			}
		}

		
       
		 if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			 
			//load the view and the layout
			$this->template->build('programs/create');
		} 
		
		else
		{
		   
		    
			$data['programs'] = $this->programs_model->getItems($this->input->post('id', TRUE));			
            //$orderingval = $this->programs_model->maxorder();
			$this->template->set('programs',$data['programs']);
			
			

		/*	foreach ($_FILES as $index => $value)
			{
				if ($value['name'] != '')
				{
					//initializing the upload library
					$this->load->library('upload');
					$this->upload->initialize($this->set_upload_options('programs'));

					//upload the image
					if ( ! $this->upload->do_upload($index))
					{
						$this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));

						//load the view and the layout
						$this->template->build('programs/create');

						return FALSE;
					}
					else
					{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();

						//Save the name an array to save on BD before
						$form_data_aux[$index]		=	$info_upload["file_name"];

						//Save the name of old files to delete
						array_push($files_to_delete, $data['programs']->$index);

						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
						$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'programs'));

						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));

							//load the view and the layout
							$this->template->build('programs/create');

							return FALSE;
						}
					}
				}
			} */
            $imagename = null;
            //$this->upload_image();
            $uploadName= $this->upload_image();
			  $data5 = json_decode($uploadName,true);  
      		  $imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : $this->input->post('imagename');
		    //$imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
            $reminders=$this->input->post('reminders');
			if($reminders){
			$reminders = implode(',',$reminders);
			}
            $free_courses = $this->input->post('chb_free_courses');
            $access_courses = $this->input->post('step_access_courses');
            if(isset($access_courses) && $access_courses == '0'){
                 if($this->input->post('selected_course')){
                  $selected_course_string = '';
                  $selected_course1 = $this->input->post('selected_course');
                      if(isset($selected_course1)){
                          foreach($selected_course1 as $key=>$value) {
						      
                  		   		if($value == "-1") {
                                       $selected_course_string='-1';
                                      break;
                  				}
                  				else {
                  					 $selected_course_string.=$value."|";
                                 }
              		   }
					  
                     }else{
                           $selected_course_string = NULL;
                     }
                 }else{
                       $selected_course_string = NULL;
                 }
            }else{
                       $selected_course_string = NULL;
            }
             //@@@@@@@@@@new code add by sachin for assistant teacher start here
            	
            	
                 if($this->input->post('assistant_id')){
                  $assistant_teachers = '';
                  $assistant_id = $this->input->post('assistant_id');
                      if(isset($assistant_id)){
                          foreach($assistant_id as $key=>$keyvalue) {
						      
                  		   		if($keyvalue == "-1") {
                                       $assistant_teachers='-1';
                                      break;
                  				}
                  				else {
                  					 $assistant_teachers.=$keyvalue."|";
                                 }
              		   }
					  
                     }else{
                           $assistant_teachers = NULL;
                     }
                 }else{
                       $assistant_teachers = NULL;
                 }
            
            //@@@@@@@@@@ new code for assistant teacher end here
             //@@@@@@@@@ new code for exersice file start here
			       if($this->input->post('media_id') != ''){
			       //$mediafile_id = rtrim($this->input->post('media_id'), ",");
			      $mediafile_id1 = implode(',', $this->input->post('media_id'));
			      $mediafile_id = rtrim($mediafile_id1, ",");
			       }else{			        
			        $mediafile_id =null;
			       }
			       
             //@@@@@@@@@ new code for exersice file end here 
			    //@@@@@@@@@@@@@@@@@@@@@@@new code for Prerequisites file start here
			       if($this->input->post('req_id')!= ''){
			       	$preqfiles_id1 = implode(',', $this->input->post('req_id'));
			        $preqfiles_id = rtrim($preqfiles_id1, ",");
			       }else{			        
			        $preqfiles_id =null;
			       }

			    //@@@@@@@@@@@@@@@@@@@@@@@ new code for Prerequisites file end here 
            $chb_free_courses = $this->input->post('chb_free_courses');
            $chb_free_courses = (isset($chb_free_courses) && ($chb_free_courses == 'on')) ? 1 : 0;
            $webcam_option = $this->input->post('webcam_option');
            $webcam_option = (isset($webcam_option) && ($webcam_option == 'on')) ? 1 : 0;

            $showresult_option = $this->input->post('show_result');            
            $showresult_option = (isset($showresult_option) && ($showresult_option == 'on')) ? 1 : 0;
            //$published = ($this->input->post('published' && ($this->input->post('published') == 0))) ? 1 : 0;
            //echo $published = $this->input->post('published');exit;
            $published = $this->input->post('published');

            // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
      	$fixedrate ="0.00";

		$free_coursesforcond = $this->input->post('chb_free_courses');
        $access_coursesforcond = $this->input->post('step_access_courses');
        $planforcond = $this->input->post('plan'); 
        $selected_course = $this->input->post('selected_course');	       

		if(($free_coursesforcond == 0 && $access_coursesforcond == 0 && $planforcond =='fixed') || ($free_coursesforcond == 1 && $planforcond =='fixed'))
		{			
			$fixedrate = $this->input->post('fixedrate');

		} 
		 
		if(($free_coursesforcond == 1 && $planforcond =='fixed') || ($free_coursesforcond == 1 && $planforcond =='subscription'))
		{
			$access_coursesforcond = 0; 
			    	
		}

		// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


			$form_data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'alias' => $alias,
				'catid' => $this->input->post('category_id'),
				//'introtext' => $this->input->post('category_id'),
				//'image' => $imagename,
				'emails' => $reminders,
				'published' => $published,
				'startpublish' => $this->input->post('startpublish'),
				'endpublish' => $this->input->post('endpublish'),
				'metatitle' => $this->input->post('metatitle'),
				'metakwd' => $this->input->post('metakwd'),
				'metadesc' => $this->input->post('metadesc'),
				//'ordering' => $orderingval,
				'pre_req' => $this->input->post('pre_req'),
				'pre_req_books' => $this->input->post('pre_req_books'),
				'reqmts' => $this->input->post('reqmts'),
				'author' => $this->input->post('teacher_id'),
				'level' => $this->input->post('level'),
				//'priceformat' => $this->input->post('level'),
				'fixedrate' => $fixedrate,//$this->input->post('fixedrate'),
				'skip_module' => '0',    //$this->input->post('skip_module'),
				'chb_free_courses' => $free_coursesforcond,  //$chb_free_courses,
				'step_access_courses' => $access_coursesforcond, //$this->input->post('step_access_courses'),
				'selected_course' => trim($selected_course_string,"|"),   //$selected_course_string,
				'course_type' => $this->input->post('course_type'),
                'lesson_release' => $this->input->post('lesson_release'),
				'lessons_show' => $this->input->post('lessons_show'),
				'start_release' => $this->input->post('startpublish'),
				'id_final_exam' => $this->input->post('final_quizzes'),
				'certificate_term' => $this->input->post('certificate_setts'),
			   //	'hasquiz' => $this->input->post('final_quizzes'),
				'updated' => $this->input->post('certificate_setts'),
				'certificate_course_msg' => $this->input->post('coursemessage'),
                'webstatus' => $this->input->post('webstatus'),
                'webnardescription' => $this->input->post('webnardescription'),
                'webcam_option' => $webcam_option,
                'show_result' => $showresult_option,
                'introtext' => $assistant_teachers,
                'programmedias'=>$mediafile_id,
                'prerequisitesfiles'=>$preqfiles_id,
			);
			
		

			/*echo '<pre>';
			print_r($imagename);
			echo '</pre>';
			exit('aa');*/

			$isupdated=$this->programs_model->updateItem($id,$form_data);
            $this->programs_model->deleteProgramPlan($id);
            $this->programs_model->deleteProgramRenewals($id);

            if(($free_coursesforcond == 0 && $access_coursesforcond == 0 && $planforcond =='subscription') || ($free_coursesforcond == 1 && $planforcond =='subscription'))
	 		{

            $plans = $this->input->post('subscriptions');
            $price = $this->input->post('subscription_price');
            $sub_default = $this->input->post('subscription_default');
			if($plans){
				$i=0; foreach($plans as $element) {
				$sub_default == $element ? $default = '1' : $default = '0';
                 //if($plans[$i] != '' && $price[$i] == ''){
              //$plans[$i] = '0';
		  // }
				$plans_data = array(
						   'product_id' => $id,
						   'default' => $default,
						   'default_new' => $default,
						   'plan_id' => $plans[$i],
						   //'price' => $price[$i]
						   'price' => $price[$element]
					   );
                  //print_r($plans_data);
				$this->programs_model->insertPlans($plans_data);
				$i++;
			}
		}  // exit;
           $ren_plans = $this->input->post('renewals');
           $renprice = $this->input->post('renewalprice');
           $ren_default = $this->input->post('renewal_default');
			if($ren_plans){
			   $j=0; foreach($ren_plans as $element) {
			   $ren_default == $element ? $default = '1' : $default = '0';
				$renewal_data = array(
						   'product_id' => $id,
						   'default' => $default,
						   'default_new' => $default,
						   'plan_id' => $ren_plans[$j],
						   'price' => $renprice[$element]
					   );
				//print_r($renewal_data);
				$this->programs_model->insertRenewals($renewal_data);
				$j++;
			}
		}
      
      }
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				//exit('srgsg');
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				foreach ($files_to_delete as $index)
				{
					if ( is_file(FCPATH.'public/uploads/programs/img/'.$index) )
						unlink(FCPATH.'public/uploads/programs/img/'.$index);

					if ( is_file(FCPATH.'public/uploads/programs/img/thumbs/'.$index) )
						unlink(FCPATH.'public/uploads/programs/img/thumbs/'.$index);
				}
			   	// redirect('programs/lists/'.$parent_id);
			   	if((!empty($_POST['edit2'])) && ($_POST['edit2']=='Save & Back to list'))
			   	{
			   			redirect('manage/courses/'.$parent_id);
			   	

			   }
			   else
			   {
			   	 redirect('programs/edit/'.$id);
			   
			   }
			}
			//if ($category->is_invalid())
			else
			{	
				if((!empty($_POST['edit2'])) && ($_POST['edit2']=='Edit And Exit'))
			   	{
			   			redirect('manage/courses/'.$parent_id);
			   	

			   }
			   else
			   {
			   	 redirect('programs/edit/'.$id);
			   
			   }


				//exit('yes');
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );				
				//redirect('manage/courses/'.$parent_id);
			}
	  	}
		}	  
		else
		{  
			//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to modify' ) );
			redirect('category/pagenotfound');
		}
	}

    public function view()
	{ 
        //$tmpl = "default";
        //$this->template->set("tmpl", $tmpl);
        //$this->template->set("category", $this->categs_model->getCateg());
		//$this->template->build('gurucategs/gurupcategs');
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
			//redirect('category/');
			redirect('courses/');
		}
		$this->load->model("Category_model");
		$coursesname = $this->Program_model->getProgram($course_id);

			$coursename = strtolower($coursesname->name);			
			$coursename = trim(str_replace(' ', '-', $coursename));
			$coursename = preg_replace('/[^A-Za-z0-9\-]/', '', $coursename);

		//$course_page = 'course/'.$coursename.'/'.$course_id;
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
                     

					if($this->Program_model->buySelectedCourse($selected_course,$user_id))
					{
					  
						 $result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
						
					}
					else
					{

						 $result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
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
			 
			/*if(isset($user_id) && ($step_access_courses == 0)){
			
				$result = ""; 
			}	*/	// by jayesh
			
			
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
				
					$urldomain = base_url();
		$urldomain = str_replace('http://', '', $urldomain);
		$urldomain = str_replace('/', '', $urldomain);
		$urldomain = str_replace('www.', '', $urldomain);
				//1. mail to user 
				$subject1 = trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name;
				$toemail1 = $userdetail->email;
				$content = '';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($userdetail->first_name)).',<br /><br />';
				$content .= " You have Successfully enrolled in '".$programinfo->name."'! <br /><br />";
				$content .= " You can now find '".$programinfo->name."'  under the menu 'My Courses' in  <a style='color: #55c5eb;' href =".base_url().">".base_url()."</a>  once you log in.<br /><br />";
				$content .=' If you need help or have any questions, please contact us.<br />';
				// $content .=' <br /><br />';
				// $content .= '...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				//$content .=' Regards,<br /><br />';
				//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
				$data['content'] = $content;
				$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
				$fromemail1 = 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail1, $configarr[0]['fromname']);
				$this->email->subject($subject1);
				$this->email->to($toemail1);
				$this->email->message($message1);
				$this->email->send();	


				//2. mail to teacher
				$subject2 = trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name;
				$toemail2 = $authordetail->email;
				$content = '';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($authordetail->first_name)).',<br /><br />';
				$content .=  trim(ucfirst($userdetail->first_name))." ".trim(ucfirst($userdetail->last_name))." has Successfully enrolled in '".$programinfo->name."'! <br /><br />";
				$content .='If you need help or have any questions, please contact us.<br />';
				// $content .='<br /><br />';
				// $content .= '...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				//$content .='Regards,<br /><br />';
				//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
				$data['content'] = $content;
				$message2 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
				$fromemail2 = 'noreply@'.$urldomain;        //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail2, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject2);
				$this->email->to($toemail2);
				$this->email->message($message2);
				$this->email->send();	
			
			
			   $admininfo2 = $this->login_model->getadminInfo(4);
				//3. Mail To admin 
				$subject3 = trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name;
				$toemail3 = $admininfo2->email;// admin mail
				$content = '';	
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase"> '.trim(ucfirst($userdetail->first_name)).' has enrolled to '.$programinfo->name.'</p>';
				$content .= '<p>Hello '.trim(ucfirst($admininfo2->first_name)).',<br /><br />';
				$content .=  trim(ucfirst($userdetail->first_name))." ".trim(ucfirst($userdetail->last_name))." has Successfully enrolled in '".$programinfo->name."'!<br /><br />";
				$content .='If you need help or have any questions, please contact us.<br />';
				// $content .='<br /><br />';
				// $content .= '...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				//$content .='Regards,<br /><br />';
				//$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
				//$message3 = $content;
				$data['content'] = $content;
				$message3 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
				$fromemail3 = 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];// admin mail
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail3, $configarr[0]['fromname']);// admin mail);
				$this->email->subject($subject3);
				$this->email->to($toemail3);
				$this->email->message($message3);
				$this->email->send();	
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully, Now you can view this lessons under My Course" ));
				//redirect('programs/lectures/'.$course_id);
				
				redirect($coursename.'/lectures/'.$course_id);

			}
			elseif($result == 'old')
			{
			 	
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "You have successfully enrolled to the course. Begin learning now!" ));
				//redirect('programs/lectures/'.$course_id);
				redirect($coursename.'/lectures/'.$course_id);
				//redirect('lectures/'.$coursename.'/'.$course_id);	
			}
			elseif($result == '')
			{
				/*$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => "You can't access this course.you don't have Permission." ) );
				$urlCourse = strtolower($coursesname->name);                        
                $urlCourse = trim(str_replace(' ', '-', $urlCourse));
                $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
				redirect('course/'.$urlCourse.'/'.$course_id);*/

				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "You have successfully enrolled to the course. Begin learning now!"));
				//redirect('programs/lectures/'.$course_id);
				redirect($coursename.'/lectures/'.$course_id);
				//redirect('lectures/'.$coursename.'/'.$course_id);	
			}
			// elseif($result == 'now1')
			// {
			// 	$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully! You can find this course under 'my courses' page" ));
			// 	//redirect('programs/programs/'.$course_id);
			// 	$urlCourse = strtolower($coursesname->name);                        
   //              $urlCourse = trim(str_replace(' ', '-', $urlCourse));
   //              $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
			// 	redirect($coursename.'/lectures/'.$course_id);
			// } 
			
		}
	}
	
	function add_reviews()
	{
	    $sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$review_rate = $this->input->post('review_point');
		$program_id = $this->input->post('pro_id');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');

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
	    $insert_id = $this->Program_model->insertReview($data);
		
		
		$author = $this->settings_model->getTeacherId($program_id);
		$Program_name = $this->settings_model->getCourseName($program_id);
	
	    if($user_id == $author)
	   {
			$name = 'You';
	   }
	   else
	   {
			$name = $this->settings_model->getName($user_id);
	   }
		  $data_activity = array(
			'activity' => $name.' has given review on '.$Program_name,
			'sender_id' => $user_id,
			'receiver_id' => $author,
			'activity_type' => 'review',
			'activity_date' => date("Y-m-d"),
			'visit_id' => $program_id
		  );
	  
	  $this->Category_model->insertActivity($data_activity);
		
		if($insert_id)
		{
		  echo 'Edit Reviews';	
		  return;
		}
		
	}

	public function coursepreview()
	{
		ob_start();
		$tmpl = "default";
		$uid = '1';
		$this->load->helper('date');
		$this->load->model('Tasks_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');
		$this->load->model('Myinfo_model');

		 $this->load->model('lessons_model');

      
		
		$this->load->model('admin/programs_model');
		
		$this->load->model('program_model');
		
		$this->load->model('Category_model');

		 $today=getdate();

        $this->th=$today['hours'];

        $this->tm=$today['minutes'];

        $this->tmonth=$today['mon'];
       
		
		$sessionarray = $this->session->userdata('logged_in');
			  	
		$user_id = $sessionarray['id'];	  	
			if($user_id=='')
			{
		    redirect('users/login');
			}

			$group_id = $sessionarray['groupid'];
			$settings = $this->settings_model->getItems();

	  $program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

      $day_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

	  $lesson_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

      $this->template->set("lesson_id", $lesson_id);

      if (!$program_id || !$day_id || !$lesson_id){

			redirect('category/');

		}

      $wheredata = array(

		'user_id' => $user_id,

		'pro_id' => $program_id,

		'mod_id' => $day_id,

		'lesson_id' => $lesson_id

		);

		$this->template->set("days", $this->program_model->getlistDays($program_id));
	    $this->template->set("quizcomment", $this->program_model->getLessonQuery($program_id));

	  $query_details =$this->Tasks_model->getLessonQueriesAsked($wheredata);

     // $lesson_answers = $this->Tasks_model->getLessonAnswer($wheredata);

	  $programdetail = $this->Tasks_model->getLessonsName($program_id);

      $this->template->set("courses", $this->Myinfo_model->getCourses($user_id,$program_id,''));

	  $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);

	  $viewedLesson = $this->Tasks_model->countViewedLesson($user_id,$program_id);

      $quiz_taken = $this->quizzes_model->quizTaken($user_id,$program_id);

      $this->template->set("quiztaken", $quiz_taken);

	$isComplete = 0;

	if(!empty($viewedLesson)){

	$isComplete = ($viewedLesson[0]['completed'] > 0) ? $viewedLesson[0]['completed'] : 0;

	}

	  $idFinalExam = (isset($programdetail[0]['id_final_exam'])) ? $programdetail[0]['id_final_exam'] : '';

	  $idcertificate = (isset($programdetail[0]['certificate_term'])) ? $programdetail[0]['certificate_term'] : '';

		  if(isset($idFinalExam) and ($idFinalExam != 0) and ($isComplete > 0)){

			$this->template->set("finalexamid", $idFinalExam);

		  }

		  if(isset($idcertificate) and ($idcertificate != 0) and ($isComplete > 0)){

			$this->template->set("certificateid", $idcertificate);

		  }

	  //	$date_enrolled = $this->Tasks_model->datebuynow($program_id, $user_id);

		/*if(count($date_enrolled) > 0)
		{
			$not_show = true;
		}
		else
		{
			$not_show = false;
		}*/

		$this->template->set("programnavarray", $programnavarray);

		//$this->template->set("lesson_answers", $lesson_answers);
		$lessonsContent = $this->program_model->getLessonContent($lesson_id,$day_id,$program_id);
		$this->template->set("lessonsContent",$lessonsContent);
	
		$lessoninfo = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);

		$this->template->set("exercise", $this->program_model->getExercise($program_id));

		 $this->template->set("webinars", $this->program_model->getWebinars($program_id));
	
		$this->template->set("query_details", $query_details);
	
	//	$this->template->set("date_enrolled", $date_enrolled);
	
		$this->template->set("settings", $settings);
	
		$this->template->set("tmpl", $tmpl);
	
		$this->template->set("program_id", $program_id);
	
		$this->template->set("user_id", $user_id);
	
		$this->template->set("programdetail", $programdetail);

		$this->template->set("moduleid", $day_id);
	
		$this->template->set("viewedLesson", $viewedLesson);
	
		$this->template->set("isComplete", $isComplete);
	
		$this->template->set("lesson", $this->Tasks_model->getLessonNew2($program_id,$day_id,$lesson_id));
	
		$this->template->set("lessoncontent", $this->Tasks_model->getLessonContent($lesson_id));
       
		$this->template->set("lec_content", $this->Tasks_model->getContent($lesson_id));
	
		$this->template->set('db_media', $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id));
	
		$this->template->set('db_mediatext', $this->Tasks_model->getMedia_oflayout('scr_t',$lesson_id));
	
		$this->template->set("isfinalview", false);
	
		$this->template->set("iscertificateview", false);
	
		$mediajumpids = $this->Tasks_model->getMedia_oflayout('jump',$lesson_id);

		foreach($mediajumpids as $mediajumpid)
		{

			$jumpbut = $this->Tasks_model->getJumpbutton($mediajumpid->media_id);

			$jumpbut = $jumpbut->button;

			$this->template->set('jump_but'.$jumpbut, $this->Tasks_model->getJumpbutton($mediajumpid->media_id));

		}

		//$this->template->set("layoutid", $this->Tasks_model->getLessonContent($lesson_id));

		//$this->template->set("layoutid", '3');

		//$this->template->set("lessonview", $this->Tasks_model->getViewLesson($lesson_id));



		$datestring = "%Y-%m-%d %h:%i:%s";

		$time = time();

		

      //  $count = $this->Tasks_model->countViewedLesson($uid,$program_id);

	 //  $access = isAccess($program_id,$day_id,$lesson_id);

		 

		  $this->template->build('programs/coursepreview');

		
	}

	public function coursepreview_new()
	{
		$tmpl = "default";
		$uid = '1';
		$this->load->model('Tasks_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');

		$sessionarray = $this->session->userdata('logged_in');

		$user_id = $sessionarray['id'];	  	
		if($user_id=='')
		{
		redirect('users/login');
		}

		$group_id = $sessionarray['groupid'];
		$settings = $this->settings_model->getItems();

		$program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

		$day_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

		$lesson_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

		$this->template->set("lesson_id", $lesson_id);

		

		if (!$program_id || !$day_id || !$lesson_id){

		redirect('category/');

		}

		$wheredata = array(

		'user_id' => $user_id,

		'pro_id' => $program_id,

		'mod_id' => $day_id,

		'lesson_id' => $lesson_id

		);

		$this->template->set("days", $this->program_model->getlistDays($program_id));
		$this->template->set("quizcomment", $this->program_model->getLessonQuery($program_id));

		$query_details =$this->Tasks_model->getLessonQueriesAsked($wheredata);

		// $lesson_answers = $this->Tasks_model->getLessonAnswer($wheredata);

		$programdetail = $this->Tasks_model->getLessonsName($program_id);

		$this->template->set("courses", $this->Myinfo_model->getCourses($user_id,$program_id,''));
		

		$programnavarray = $this->Tasks_model->getCoursenavArray($program_id);

		$viewedLesson = $this->Tasks_model->countViewedLesson($user_id,$program_id);

		$quiz_taken = $this->quizzes_model->quizTaken($user_id,$program_id);
		
		$this->template->set("quiztaken", $quiz_taken);

		$isComplete = 0;

		if(!empty($viewedLesson)){

		$isComplete = ($viewedLesson[0]['completed'] > 0) ? $viewedLesson[0]['completed'] : 0;

		}

		$idFinalExam = (isset($programdetail[0]['id_final_exam'])) ? $programdetail[0]['id_final_exam'] : '';

		$idcertificate = (isset($programdetail[0]['certificate_term'])) ? $programdetail[0]['certificate_term'] : '';

		if(isset($idFinalExam) and ($idFinalExam != 0) and ($isComplete > 0)){

		$this->template->set("finalexamid", $idFinalExam);

		}

		if(isset($idcertificate) and ($idcertificate != 0) and ($isComplete > 0)){

		$this->template->set("certificateid", $idcertificate);

		}

		$date_enrolled = $this->Tasks_model->datebuynow($program_id, $user_id);
		
		if(count($date_enrolled) > 0)
		{
		$not_show = true;
		}
		else
		{
		$not_show = false;
		}

		$this->template->set("programnavarray", $programnavarray);

		//$this->template->set("lesson_answers", $lesson_answers);

		$lessoninfo = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);
		$lessonsContent = $this->program_model->getLessonContent($lesson_id,$day_id,$program_id);

		$this->template->set("course_id",$program_id);
		$this->template->set("section_id",$day_id);
		$this->template->set("lecture_id",$lesson_id);
		$this->template->set("lessonsContent",$lessonsContent);

		$this->template->set("exercise", $this->program_model->getExercise($program_id));

		$this->template->set("webinars", $this->program_model->getWebinars($program_id));

		$this->template->set("query_details", $query_details);

		$this->template->set("date_enrolled", $date_enrolled);

		$this->template->set("settings", $settings);

		$this->template->set("tmpl", $tmpl);

		$this->template->set("program_id", $program_id);

		$this->template->set("user_id", $user_id);

		$this->template->set("programdetail", $programdetail);

		$this->template->set("moduleid", $day_id);

		$this->template->set("viewedLesson", $viewedLesson);

		$this->template->set("isComplete", $isComplete);

		$this->template->set("lesson", $this->Tasks_model->getLessonNew2($program_id,$day_id,$lesson_id));
		//$this->template->set("lesson", $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id)); //contain mediarel table
		
		$this->template->set("lessoncontent", $this->Tasks_model->getLessonContent($lesson_id));

		//$this->template->set("lec_content", $this->Tasks_model->getContent($lesson_id));
		//$this->template->set("txt_content", $this->Tasks_model->getContent2($lesson_id));
		$this->template->set("lec_content", 1);
		$this->template->set("txt_content", 1);

		$this->template->set('db_media', $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id)); //contain mediarel table

		$this->template->set('db_mediatext', $this->Tasks_model->getMedia_oflayout('scr_t',$lesson_id));

		$this->template->set("isfinalview", false);

		$this->template->set("iscertificateview", false);

		$mediajumpids = $this->Tasks_model->getMedia_oflayout('jump',$lesson_id);

		foreach($mediajumpids as $mediajumpid)
		{
			$jumpbut = $this->Tasks_model->getJumpbutton($mediajumpid->media_id);
			$jumpbut = $jumpbut->button;
			$this->template->set('jump_but'.$jumpbut, $this->Tasks_model->getJumpbutton($mediajumpid->media_id));
		}

		//$this->template->set("layoutid", $this->Tasks_model->getLessonContent($lesson_id));

		//$this->template->set("layoutid", '3');

		//$this->template->set("lessonview", $this->Tasks_model->getViewLesson($lesson_id));

		$datestring = "%Y-%m-%d %h:%i:%s";

		$time = time();

		$currdate = mdate($datestring, $time);

		$count = $this->Tasks_model->countViewedLesson($uid,$program_id);

		$access = isAccess($program_id,$day_id,$lesson_id);

		if(isset($user_id))
		{
		//if(($not_show === TRUE) && ($access == true))//commented by yogesh on dated 06-12-2014 , solved issue first for $access
		if(($not_show === TRUE))
		{
			$this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);
			$this->template->build('programs/lessonpreview');
		}
		else
		{
			//$this->template->build('user/login_user');
			echo '<div style="margin-top: 25px; font-family: arial; text-align: center; color: #F9966B;">You have to Enroll first !!<br>By clicking on Buy Now or Enroll now button</div>';
		}
		}else
		{
			$this->template->build('user/login_user');
		}
	}

		public function ajaxlesson()
	{
		$this->load->model('Tasks_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');
		$sessionarray = $this->session->userdata('logged_in');	  
		$user_id = $sessionarray['id'];	  	
		
		if($user_id=='')
		{
			redirect('users/login');
		}

		$group_id = $sessionarray['groupid'];
		$settings = $this->settings_model->getItems();
		
		$program_id = $this->input->post('pro_id');
		$day_id = $this->input->post('mod_id');
	    $lesson_id = $this->input->post('lesson_id');

	    $mediajumpids = $this->Tasks_model->getMedia_oflayout('jump',$lesson_id);
       

		foreach($mediajumpids as $mediajumpid)
		{

			$jumpbut = $this->Tasks_model->getJumpbutton($mediajumpid->media_id);

			$jumpbut = $jumpbut->button;

			$buttonarr[]  = $this->Tasks_model->getJumpbutton($mediajumpid->media_id);


		}
      
    

		$db_media = $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id);
	    $db_mediatext = $this->Tasks_model->getMedia_oflayout('scr_t',$lesson_id);

	    $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);	   

		//$lesson = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);	
		$lesson = $this->Tasks_model->getAjaxLesson($program_id,$day_id,$lesson_id);

		
		$lec_content = 1;//$this->Tasks_model->getContent($lesson_id);
		$txt_content = 1;//$this->Tasks_model->getContent2($lesson_id);   
		//$coursetype_details = $this->Tasks_model->getCourseTypeDetails ($program_id);
	    $sequential = false;
		$isfinalview = false;
	    if($isfinalview == false)
		{	   
			(int) $M_currkey  = array_search($day_id, $programnavarray);
 
			(int) $M_prevkey = $M_currkey - 1;
			(int) $M_nextkey = $M_currkey + 1;
			(int) $M_lastkey = count($programnavarray)/2;
			(int) $M_lastkey = $M_lastkey - 1;
 
			(int) $L_currkey  = array_search($lesson->id, $programnavarray['lessons'.$M_currkey]);
 
			(int) $L_prevkey = $L_currkey - 1;
			(int) $L_nextkey = $L_currkey + 1;
			(int) $L_lastkey = array_search(end($programnavarray['lessons'.$M_currkey]), $programnavarray['lessons'.$M_currkey]);
			$prevLval = ($L_prevkey >= 0) ? $programnavarray['lessons'.$M_currkey][$L_prevkey] : NULL;
			$nextLval = ($L_nextkey <= $L_lastkey) ? $programnavarray['lessons'.$M_currkey][$L_nextkey] : NULL;


		if($prevLval != NULL )
		{
		  
			if($sequential == true){
			
			$prevurl = (lessondate($programnavarray, $prevLval, $diff_start)=='open') ? ($prevLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$prevLval."/" : NULL : NULL; //Lurl($program_id, $day_id, $prevLval)
			}
			else
			{ 
				$prevurl = ($prevLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$prevLval."/" : NULL;// Lurl($program_id, $day_id, $prevLval);
			}
		}
		else
		{
			$prevMval = ($M_currkey >= 0) ? $programnavarray[$M_currkey] : NULL;
			$programnavarray['lessons'.$M_currkey][0];
			$prevurl = ($prevMval != NULL) ? base_url()."lessons/module/".$program_id."/".$prevMval."/" : NULL; // Murl($program_id, $prevMval)
		}

		if($nextLval != NULL )
		{			
			if($sequential == true)
			{
				$nexturl = (lessondate($programnavarray, $nextLval, $diff_start)=='open') ? ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$moduleid."/".$nextLval."/" : NULL : NULL; //Lurl($program_id, $moduleid, $nextLval)	
			}
			else
			{ 
				$nexturl = ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$nextLval."/" : NULL ;//Lurl($program_id, $day_id, $nextLval);
			}
		}
		else
		{
			$nextMval = ($M_nextkey <= $M_lastkey) ? $programnavarray[$M_nextkey] : NULL;

			if($sequential == true)
			{ 
				$nexturl = (lessondate($programnavarray, $L_nextMod, $diff_start)=='open') ? ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL : NULL; //Murl($program_id, $nextMval)
			}
			else
			{  
				$nexturl = ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL ;//Murl($program_id, $nextMval);
			}
		}
		$modcount = count($programnavarray)/2;
		$modcurr = array_search($day_id, $programnavarray)+1;
		$lescount = count($programnavarray['lessons'.$M_currkey]);
		$lescurr = $L_currkey+1;
		}
		else
		{
			$nexturl = NULL;
			$prevurl = NULL;
		}    
     
		$purl = explode('/',@$prevurl);
		$premodule_id = @$purl[7];
		$preless_id = @$purl[8];    
			  
		$nurl = explode('/',@$nexturl);	
		$nextmodule_id = @$nurl[7];
		$nextless_id = @$nurl[8];    
    
		//$lesson = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id); 
		//echo $lesson->layoutid;
		//print_r($lesson);
		//exit('yes');
		switch($lesson->layoutid)
		{
			case '1':
						echo $lesson->lecture_content;

						return true;
						
						break;			
						
			case '12':
						//echo $program_id.'--'.$lesson_id;
						//echo 'yoyo';//chages done by yo
						/*$dayss = $this->program_model->getlistDays($program_id);
					    foreach($dayss as $day)
					    {
							$lessons = $this->program_model->getLessons($day->id);
							foreach($lessons as $lesson)
							{	
								$lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $program_id);		
								if(!empty($lesson_viewed2))
								{
									foreach($lesson_viewed2 as $compltData)
									{	
										if(strpos($compltData->mark_as_completed, $lesson->id) !== false)
										{

										}	
										else
										{*/
						//$db_media = $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id);
						//$media = $db_media[14]->media_id;
						$media = $lesson->is_exam;
						//print_r($db_media);
						//$quiz_data = $this->ajaxquizztotask($media,15,'',$program_id);
						//echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='media_15' >";
						echo "<div id='media_15' >";
						//echo $this->ajaxquizztotask($media,15,'',$program_id);
						echo $this->ajaxQuestionsDisplay($media,15,'',$program_id,'', $lesson->layoutid);
						echo "</div>
						<div>
						<table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
						<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						}

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}		
										
						echo "</tr>
								</tbody></table>
      	<div>";
											/*}
											else
											{
												exit('Cant Give Test');
											}*/
										/*}									
									}
								}							
							 					 	
							}
					    }*/

						/*$media = $db_media[14]->media_id;
						//$quiz_data = $this->ajaxquizztotask($media,15,'',$program_id);
			            echo "<div id='media_15' >";
						echo $this->ajaxquizztotask($media,15,'',$program_id);
						echo "</div>";*/
						return true;						
						break;
						
			case 'finalexam':	

								/*echo "<div id='finalexam'>";
								$this->ajaxquizztotask($finalexamid,16,$programdetail[0],$pro_id);
									$enablewebcam = true;
									if($enablewebcam && $webcamoption==1 )
									{
									echo "<div id='webid2'>
									<script type='text/javascript'>
										var streaming = false,
										video        = document.querySelector('#video'),
										canvas       = document.querySelector('#canvas'),
										photo        = document.querySelector('#photo'),
										startbutton  = document.querySelector('#startbutton'),
										width = 320,
										height = 0;

										navigator.getMedia = ( navigator.getUserMedia ||
											 navigator.webkitGetUserMedia ||
											 navigator.mozGetUserMedia ||
											 navigator.msGetUserMedia);

										navigator.getMedia(
										{
											video: true,
											audio: false
										},
										function(stream) 
										{
												if (navigator.mozGetUserMedia) {
												video.mozSrcObject = stream;
												} else {
												var vendorURL = window.URL || window.webkitURL;
												video.src = vendorURL.createObjectURL(stream);
													}
												video.play();
													}	,
										function(err) 
										{
											console.log('An error occured! ' + err);
										}
										);

										video.addEventListener('canplay', function(ev){
										if (!streaming) 
											{
												height = video.videoHeight / (video.videoWidth/width);
												video.setAttribute('width', width);
												video.setAttribute('height', height);
												//canvas.setAttribute('width', width);
												//canvas.setAttribute('height', height);
												streaming = true;
											}
										}, false);

											function takepicture() 
											{
												//canvas.width = width;
												//canvas.height = height;
												canvas.getContext('2d').drawImage(video, 0, 0,294,240);
												var data = canvas.toDataURL('image/png');
												if(data != '')
												{
													photo.setAttribute('src', data);
													getdetails(data);
												}
											}

										startbutton.addEventListener('click', function(ev)
										{			
													takepicture();
													ev.preventDefault();
										}, false);
										var abc=setInterval(autoclick,10000);
										function autoclick()
											{
												startbutton.click();
											}

											function stopTimer()
											{
												window.clearInterval(abc);
											}
											function stopTimer1()
											{
												window.clearInterval(abc);
											}
											</script>  
											</div>";
											
											}
								echo "</div>

								<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}			
										
						echo "</tr>
								</tbody></table>
      	<div>";*/
								return true;
								break;		
		}		
	}

	public function ajaxlesson_old()
	{
		$this->load->model('Tasks_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');
		$sessionarray = $this->session->userdata('logged_in');	  
		$user_id = $sessionarray['id'];	  	
		
		if($user_id=='')
		{
			redirect('users/login');
		}

		$group_id = $sessionarray['groupid'];
		$settings = $this->settings_model->getItems();
		
		$program_id = $this->input->post('pro_id');
		$day_id = $this->input->post('mod_id');
	    $lesson_id = $this->input->post('lesson_id');

	    $mediajumpids = $this->Tasks_model->getMedia_oflayout('jump',$lesson_id);
       

		foreach($mediajumpids as $mediajumpid)
		{

			$jumpbut = $this->Tasks_model->getJumpbutton($mediajumpid->media_id);

			$jumpbut = $jumpbut->button;

			$buttonarr[]  = $this->Tasks_model->getJumpbutton($mediajumpid->media_id);


		}
      
    

		$db_media = $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id);
	    $db_mediatext = $this->Tasks_model->getMedia_oflayout('scr_t',$lesson_id);

	    $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);	   

		$lesson = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);	

		$lec_content = $this->Tasks_model->getContent($lesson_id);   
		//$coursetype_details = $this->Tasks_model->getCourseTypeDetails ($program_id);
	    $sequential = false;
		$isfinalview = false;
	    if($isfinalview == false)
		{	   
			(int) $M_currkey  = array_search($day_id, $programnavarray);
 
			(int) $M_prevkey = $M_currkey - 1;
			(int) $M_nextkey = $M_currkey + 1;
			(int) $M_lastkey = count($programnavarray)/2;
			(int) $M_lastkey = $M_lastkey - 1;
 
			(int) $L_currkey  = array_search($lesson->id, $programnavarray['lessons'.$M_currkey]);
 
			(int) $L_prevkey = $L_currkey - 1;
			(int) $L_nextkey = $L_currkey + 1;
			(int) $L_lastkey = array_search(end($programnavarray['lessons'.$M_currkey]), $programnavarray['lessons'.$M_currkey]);
			$prevLval = ($L_prevkey >= 0) ? $programnavarray['lessons'.$M_currkey][$L_prevkey] : NULL;
			$nextLval = ($L_nextkey <= $L_lastkey) ? $programnavarray['lessons'.$M_currkey][$L_nextkey] : NULL;


		if($prevLval != NULL )
		{
		  
			if($sequential == true){
			
			$prevurl = (lessondate($programnavarray, $prevLval, $diff_start)=='open') ? ($prevLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$prevLval."/" : NULL : NULL; //Lurl($program_id, $day_id, $prevLval)
			}
			else
			{ 
				$prevurl = ($prevLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$prevLval."/" : NULL;// Lurl($program_id, $day_id, $prevLval);
			}
		}
		else
		{
			$prevMval = ($M_currkey >= 0) ? $programnavarray[$M_currkey] : NULL;
			$programnavarray['lessons'.$M_currkey][0];
			$prevurl = ($prevMval != NULL) ? base_url()."lessons/module/".$program_id."/".$prevMval."/" : NULL; // Murl($program_id, $prevMval)
		}

		if($nextLval != NULL )
		{			
			if($sequential == true)
			{
				$nexturl = (lessondate($programnavarray, $nextLval, $diff_start)=='open') ? ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$moduleid."/".$nextLval."/" : NULL : NULL; //Lurl($program_id, $moduleid, $nextLval)	
			}
			else
			{ 
				$nexturl = ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$nextLval."/" : NULL ;//Lurl($program_id, $day_id, $nextLval);
			}
		}
		else
		{
			$nextMval = ($M_nextkey <= $M_lastkey) ? $programnavarray[$M_nextkey] : NULL;

			if($sequential == true)
			{ 
				$nexturl = (lessondate($programnavarray, $L_nextMod, $diff_start)=='open') ? ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL : NULL; //Murl($program_id, $nextMval)
			}
			else
			{  
				$nexturl = ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL ;//Murl($program_id, $nextMval);
			}
		}
		$modcount = count($programnavarray)/2;
		$modcurr = array_search($day_id, $programnavarray)+1;
		$lescount = count($programnavarray['lessons'.$M_currkey]);
		$lescurr = $L_currkey+1;
		}
		else
		{
			$nexturl = NULL;
			$prevurl = NULL;
		}    
     
		$purl = explode('/',@$prevurl);
		$premodule_id = @$purl[7];
		$preless_id = @$purl[8];    
			  
		$nurl = explode('/',@$nexturl);	
		$nextmodule_id = @$nurl[7];
		$nextless_id = @$nurl[8];    
    
		//$lesson = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id); 
		//echo $lesson->layoutid;
		switch($lesson->layoutid)
		{
			case '1':
						$media = $db_media[0]->media_id;
		                $text = $db_mediatext[0]->media_id;
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='media_1'><script type='text/javascript'>jQuery('#media_1').load('".base_url()."lessons/ajaxmediaview/".$media."/1')</script></div><div id='text_1' class='content11'><script type='text/javascript'>jQuery('#text_1').load('".base_url()."lessons/ajaxmediaview/".$text."/1')</script>
						</div>

						<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
									
                      if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	
										
						echo "</tr>
								</tbody></table>
      	<div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
			case '2':
						$media = $db_media[1]->media_id;
		                $text = $db_mediatext[0]->media_id;
						$media1 = $db_media[2]->media_id;
						
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='media_2' style='width: 50%;float: left;'>					
									<script type='text/javascript'>
										jQuery('#media_2').load('".base_url()."lessons/ajaxmediaview/".$media."/2');
									</script>
							</div>
							<div id='text_2' class='content11'>				
									<script type='text/javascript'>
										jQuery('#text_2').load('".base_url()."lessons/ajaxmediaview/".$text."/1');
									</script>
							</div>
							<div id='media_3' style='width: 50%;float: left;'>
									<div style='text-align:center'><i></i></div>
										<script type='text/javascript'>
										jQuery('#media_3').load('".base_url()."lessons/ajaxmediaview/".$media1."/1');
										</script>
							</div>

						<div>
      		                <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
								<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	
										
						echo "</tr>
								</tbody></table>
      	<div>";

							
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'media1'=>$media1,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '3':
						$media = $db_media[3]->media_id;
						$text = $db_mediatext[2]->media_id;
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='media_3'>
								<div style='text-align:center'><i></i></div>
					
									<script type='text/javascript'>
										jQuery('#media_3').load('".base_url()."lessons/ajaxmediaview/".$media."/1');
									</script>
							  </div>
							 <div id='text_3' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_3').load('".base_url()."lessons/ajaxmediaview/".$text."/3');
								</script>
							</div>

							<div>
      		               	<table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
							<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	
										
						echo "</tr>
								</tbody></table>
      	<div>";

						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '4':
						$media = $db_media[4]->media_id;
						$media1 = $db_media[5]->media_id;
						$text = $db_mediatext[3]->media_id;
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='media_5' style='width: 50%;float: left;'>					
								<script type='text/javascript'>
									jQuery('#media_5').load('".base_url()."lessons/ajaxmediaview/".$media."/5');
								</script>
							</div>
							<div id='media_6' style='width: 50%;float: left;'>
								<script type='text/javascript'>
									jQuery('#media_6').load('".base_url()."lessons/ajaxmediaview/".$media1."/6');
								</script>
							</div>
							<div id='text_4' class='content11' style='float: inherit;'>
								<script type='text/javascript'>
									jQuery('#text_4').load('".base_url()."lessons/ajaxmediaview/".$text."/4');
								</script>
							</div>

							<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	

						echo "</tr>
								</tbody></table>
      	<div>";
							return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'media1'=>$media1,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '5':
						 $text = $db_mediatext[4]->media_id;
						 echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='text_5' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_5').load('".base_url()."lessons/ajaxmediaview/".$text."/5');
								</script>
								</div>

								<table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}		
										
						echo "</tr>
								</tbody></table>
      	<div>";

						 //$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						 //echo json_encode($querydata);
						 break;
						 
			case '6':
						 $media = $db_media[6]->media_id;
						 echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='media_7' style='position: relative;height: 360px;'>
				
									<script type='text/javascript'>
										jQuery('#media_7').load('".base_url()."lessons/ajaxmediaview/".$media."/7');
									</script>
								</div>	

								<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}		
										
						echo "</tr>
								</tbody></table>
      	<div>";
						return true;
						 //$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						 //echo json_encode($querydata);
						 break;
						 
			case '7':
						$media = $db_media[7]->media_id;
		
						$text = $db_mediatext[5]->media_id;
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='text_6' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_6').load('".base_url()."lessons/ajaxmediaview/".$text."/6');
								</script>
							</div>
							<div id='media_8' style='float: left !important;width: 50%;'>				
								<script type='text/javascript'>
									jQuery('#media_8').load('".base_url()."lessons/ajaxmediaview/".$media."/1');
								</script>
							</div>

							<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	
										
						echo "</tr>
								</tbody></table>
      	<div>";
					    return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '8':
						$media = $db_media[8]->media_id;
					    $media1 = $db_media[9]->media_id;						
						$text = $db_mediatext[6]->media_id;
						
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='text_7' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_7').load('".base_url()."lessons/ajaxmediaview/".$text."/7');
								</script>
							 </div>
							<div id='media_8'>					
								<script type='text/javascript'>
									jQuery('#media_8').load('".base_url()."lessons/ajaxmediaview/".$media."/8');
								</script>
							</div>
							<div id='media_9'>
					
								<script type='text/javascript'>
									jQuery('#media_9').load('".base_url()."lessons/ajaxmediaview/".$media1."/9');
								</script>
							</div>	

							<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	
										
						echo "</tr>
								</tbody></table>
      	<div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '9':
						 $media = $db_media[10]->media_id;
		
						$text = $db_mediatext[7]->media_id;
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='text_8' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_8').load('".base_url()."lessons/ajaxmediaview/".$text."/8');
								</script>
							</div>
							<div id='media_11'>
								<script type='text/javascript'>
									jQuery('#media_11').load('".base_url()."lessons/ajaxmediaview/".$media."/11');
								</script>
							</div>	

							<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	

						echo "</tr>
								</tbody></table>
      	<div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'pro_id'=>$program_id,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '10':
						$media = $db_media[11]->media_id;
						$media1 = $db_media[12]->media_id;
						$text = $db_mediatext[8]->media_id;
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='text_9' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_9').load('".base_url()."lessons/ajaxmediaview/".$text."/9');
								</script>
							 </div>
							<div id='media_12'>
					
								<script type='text/javascript'>
									jQuery('#media_12').load('".base_url()."lessons/ajaxmediaview/".$media."/12');
								</script>
							</div>
							<div id='media_13' style='width: 50%;float: left;'>
					
								<script type='text/javascript'>
									jQuery('#media_13').load('".base_url()."lessons/ajaxmediaview/".$media1."/13');
								</script>
							</div>

							<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	
										
						echo "</tr>
								</tbody></table>
      	<div>";					
      		return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'media1'=>$media1,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '11':
						$text = $db_mediatext[9]->media_id;		 
						$media = $db_media[13]->media_id;
						$text1 = $db_mediatext[10]->media_id;
						echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='text_10' class='content11'>					
								<script type='text/javascript'>
									jQuery('#text_10').load('".base_url()."lessons/ajaxmediaview/".$text."/10');
								</script>					
							</div>
							<div id='media_14'>
								<div style='text-align:center'><i></i></div>
									<script type='text/javascript'>
										jQuery('#media_14').load('".base_url()."lessons/ajaxmediaview/".$media."/14');
									</script>
								</div>
							<div id='text_11' class='content11'>
								<script type='text/javascript'>
									jQuery('#text_11').load('".base_url()."lessons/ajaxmediaview/".$text1."/11');
								</script>
					
						    </div>	

						    <div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}	
										
						echo "</tr>
								</tbody></table>
      	<div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '12':
						//echo $program_id.'--'.$lesson_id;
						//echo 'yoyo';//chages done by yo
						/*$dayss = $this->program_model->getlistDays($program_id);
					    foreach($dayss as $day)
					    {
							$lessons = $this->program_model->getLessons($day->id);
							foreach($lessons as $lesson)
							{	
								$lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $program_id);		
								if(!empty($lesson_viewed2))
								{
									foreach($lesson_viewed2 as $compltData)
									{	
										if(strpos($compltData->mark_as_completed, $lesson->id) !== false)
										{

										}	
										else
										{*/
						$db_media = $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id);
						$media = $db_media[14]->media_id;
						//print_r($db_media);
						//$quiz_data = $this->ajaxquizztotask($media,15,'',$program_id);
						//echo "<div class='texteditor_layoout'>".$lec_content."</div><div id='media_15' >";
						echo "<div id='media_15' >";
						//echo $this->ajaxquizztotask($media,15,'',$program_id);
						echo $this->ajaxQuestionsDisplay($media,15,'',$program_id,'', $lesson->layoutid);
						echo "</div>
						<div>
						<table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
						<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						}

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}		
										
						echo "</tr>
								</tbody></table>
      	<div>";
											/*}
											else
											{
												exit('Cant Give Test');
											}*/
										/*}									
									}
								}							
							 					 	
							}
					    }*/

						/*$media = $db_media[14]->media_id;
						//$quiz_data = $this->ajaxquizztotask($media,15,'',$program_id);
			            echo "<div id='media_15' >";
						echo $this->ajaxquizztotask($media,15,'',$program_id);
						echo "</div>";*/
						return true;						
						break;
						
			case 'finalexam':	

								/*echo "<div id='finalexam'>";
								$this->ajaxquizztotask($finalexamid,16,$programdetail[0],$pro_id);
									$enablewebcam = true;
									if($enablewebcam && $webcamoption==1 )
									{
									echo "<div id='webid2'>
									<script type='text/javascript'>
										var streaming = false,
										video        = document.querySelector('#video'),
										canvas       = document.querySelector('#canvas'),
										photo        = document.querySelector('#photo'),
										startbutton  = document.querySelector('#startbutton'),
										width = 320,
										height = 0;

										navigator.getMedia = ( navigator.getUserMedia ||
											 navigator.webkitGetUserMedia ||
											 navigator.mozGetUserMedia ||
											 navigator.msGetUserMedia);

										navigator.getMedia(
										{
											video: true,
											audio: false
										},
										function(stream) 
										{
												if (navigator.mozGetUserMedia) {
												video.mozSrcObject = stream;
												} else {
												var vendorURL = window.URL || window.webkitURL;
												video.src = vendorURL.createObjectURL(stream);
													}
												video.play();
													}	,
										function(err) 
										{
											console.log('An error occured! ' + err);
										}
										);

										video.addEventListener('canplay', function(ev){
										if (!streaming) 
											{
												height = video.videoHeight / (video.videoWidth/width);
												video.setAttribute('width', width);
												video.setAttribute('height', height);
												//canvas.setAttribute('width', width);
												//canvas.setAttribute('height', height);
												streaming = true;
											}
										}, false);

											function takepicture() 
											{
												//canvas.width = width;
												//canvas.height = height;
												canvas.getContext('2d').drawImage(video, 0, 0,294,240);
												var data = canvas.toDataURL('image/png');
												if(data != '')
												{
													photo.setAttribute('src', data);
													getdetails(data);
												}
											}

										startbutton.addEventListener('click', function(ev)
										{			
													takepicture();
													ev.preventDefault();
										}, false);
										var abc=setInterval(autoclick,10000);
										function autoclick()
											{
												startbutton.click();
											}

											function stopTimer()
											{
												window.clearInterval(abc);
											}
											function stopTimer1()
											{
												window.clearInterval(abc);
											}
											</script>  
											</div>";
											
											}
								echo "</div>

								<div>
      		               <table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
									<tbody><tr>";
										
						if(isset($buttonarr[0]))
						{
						echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						 }

							if(isset($buttonarr[1])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								echo '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}			
										
						echo "</tr>
								</tbody></table>
      	<div>";*/
								return true;
								break;		
		}			
	}


	//helper of mine on date 15-05-2015
function ajaxQuestionsDisplay($media_id = NULL, $frame_id = NULL, $programdetail,$pro_id = NULL,$viewque = NULL, $layoutid)
{
	//commented on dated 10-07-2015
	/*$CIq =& get_instance();
	                $quizz = $CIq->quizzes_model->getItems($media_id);

	                $CIless =& get_instance();//on dated 15-05-2015
	                $settings = $CIless->lessons_model->getQuestionIds($media_id);		
					if($settings)
					{
						foreach($settings as $sett_ques)
						{			
							$expl_quest = explode(',',$sett_ques->quizzes_ids);
							$totalquestions = count($expl_quest);
						}
					}
	                ?>
	                <div class="quiz_timer">
						<table>
						<tbody>
						<tr>
							<td colspan="2">Exam Name :- <span style="color:#42943F"><?php echo $quizz->name;?></span>
							</td>
						</tr>
						<tr>
							<td>
								<?php if($quizz->show_limit_time == '0'){?>Exam time limit: <span style="color:#42943F"><?php echo $quizz->limit_time;?></span> minutes
								<?php }?>	
							</td>
							<td style="padding-left:25px;">
								<?php if($quizz->pbl_max_score == '0'){?>Minimum score to pass this quiz: <span style="color:#42943F"><?php echo $quizz->max_score;?>%</span>
				         		<?php }?>
				        	</td>
						</tr>
						<tr>
							<td>Questions: <span style="color:#42943F"><?php echo $totalquestions;?></span></td>
							<?php
							if($quizz->time_quiz_taken == '11')
							{
								$time_quiz_taken = 'Unlimited';
							}else{
								$time_quiz_taken = $quizz->time_quiz_taken;								
							}
							?>
							<td style="padding-left:25px;"><?php if($quizz->show_nb_quiz_taken == '0'){?>This exam can be taken up to: <span style="color:#42943F"><?php echo $time_quiz_taken;?></span> times<?php }?></td>
						</tr>
						</tbody>
						</table>
						
						<table>
						<tbody>
						<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
				        //echo $remainingExamTimes;
				        ?>
						<tr>
							<td style="padding-top:15px;">You can give exam <?php echo $remainingExamTimes;?> more times</td>
						</tr>
							<?php }?>
						<tr>
							<td style="padding-top:15px;">You can always see your exam results on your My Courses page</td>
						</tr>
						</tbody>
						</table>
					</div>					
					<hr/>
    				
					<span class="quiz_description"><?php echo $quizz->description;?></span>
					<br><br>	
								
					<input type='button' class="btn btn-sm btn-success btn-update" onclick="start_exam('<?php echo $quizz->name;?>',<?php echo $media_id;?>,<?php echo $pro_id;?>,'1');" value='Start Exam' name='btnStartexam' id='btnStartexam'>
					
					<script>
						function setCookie(cname,cvalue,exdays)
						{
							var d = new Date();
							d.setTime(d.getTime()+(exdays*24*60*60*1000));
							var expires = "expires="+d.toGMTString();
							document.cookie = cname + "=" + cvalue + "; " + expires;
						}
						function getCookie(cname)
						{
							var name = cname + "=";
							var ca = document.cookie.split(';');
							for(var i=0; i<ca.length; i++) 
							  {
							  var c = ca[i].trim();
							  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
							  }
							return "";
						}

						//check existing cookie
						cook=getCookie("my_cookie");

						if(cook==""){
						   //cookie not found, so set seconds=60
						   var seconds = 60;
						}else{
						     //seconds = cook;
						     //console.log(cook);
						     var seconds = <?php echo $quizz->limit_time;?>*60;
						     //var seconds = 60;
						}

						function secondPassed() 
						{
							if(document.getElementById('countdown'))
						    {
							    var minutes = Math.round((seconds - 30)/60);
							    var remainingSeconds = seconds % 60;
							    if (remainingSeconds < 10) {
							        remainingSeconds = "0" + remainingSeconds; 
							    }
							    //store seconds to cookie
							    setCookie("my_cookie",seconds,5); //here 5 is expiry days
							    
							    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;	
							    
							    if (seconds == 0) 
							    {
							        clearInterval(countdownTimer);
							        document.getElementById('countdown').innerHTML = "Time Out";
							        quizTimeOut();
							    } else {    
							        seconds--;
							    }
							}
						}

						var countdownTimer = setInterval(secondPassed, 1000);
						</script>

					<?php*/
?>
	<!--<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">--> <!--<img src="http://prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
		      	<!--<div id="overlay">
					<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
				</div>-->

				<!--<div class="texteditor_layoout">
					<?php
							echo @$lec_content;
					?>
				</div>-->
	          	<!--<div id="media_15">-->
	          		<div class='my_main'>
	          		<div id='my_middle_content'>
	           		<?php                                           	                       
	                $quizz = $this->quizzes_model->getItems($media_id);
	                
	                $settings = $this->lessons_model->getQuestionIds($media_id);		
					if($settings)
					{
						foreach($settings as $sett_ques)
						{			
							$expl_quest = explode(',',$sett_ques->quizzes_ids);
							$totalquestions = count($expl_quest);
						}
					}
	                ?>
	                <div class="quiz_timer">
						<table>
						<tbody>
						<tr>
							<td colspan="2">Exam Name :- <span style="color:#42943F"><?php echo $quizz->name;?></span>
							</td>
						</tr>
						<tr>
							<td>
								<?php
								if($quizz->show_limit_time == '0')
								{
									?>Exam time limit: <span style="color:#42943F"><?php echo $quizz->limit_time;?></span> minutes
								<?php 
								}
								?>	
							</td>
						</tr>
						<tr>
							<td>
								<?php if($quizz->pbl_max_score == '0'){?>Minimum score to pass this exam :- <span style="color:#42943F"><?php echo $quizz->max_score;?>%</span>
				         		<?php }?>
				        	</td>
						</tr>
						<tr>
							<?php
							if($quizz->time_quiz_taken == '11')
							{
								$time_quiz_taken = 'Unlimited';
								$remaining = '';
								$remainAttempts = 1;//always set to 1 when unlimited attempts
							}
							else
							{
								$time_quiz_taken = $quizz->time_quiz_taken;								
								$remaining_attempts = $this->lessons_model->getAttempts($quizz->id, $pro_id);
								$remainAttempts = ($time_quiz_taken - count($remaining_attempts));
								
									
								
							}
							?>
							<td>Questions: <span style="color:#42943F"><?php echo $totalquestions;?></span></td>
						</tr>
						<tr>
							<td>This exam can be taken up to: <span style="color:#42943F"><?php echo $time_quiz_taken;?></span> times</td>
						</tr>
						</tbody>
						</table>
						
						<table>
						<tbody>
						<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
				        //echo $remainingExamTimes;
				        ?>
						<tr>
							<td style="padding-top:15px;">You can give exam <?php echo $remainingExamTimes;?> more times</td>
						</tr>
							<?php }?>
						<tr>
							<td style="padding-top:15px;">You can always see your exam results on your My Courses page</td>
						</tr>
						</tbody>
						</table>
					</div>					
					<hr/>
    				
					<span class="quiz_description"><?php echo $quizz->description;?></span>
					<br>

					
						<input type='button' class="btn btn-sm btn-success btn-update" onclick="start_exam('<?php echo $quizz->name;?>',<?php echo $media_id;?>,<?php echo $pro_id;?>,'<?php echo $layoutid;?>','1','0');" value='Start Exam' name='btnStartexam' id='btnStartexam'>
		           		
	          	</div>
	          	</div>
				<!--</div>-->
				<table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody><tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr>
								</tbody></table>
        			</div>

					<?php
					if(isset($quizz->limit_time))//for timer count down
					{
					?>
						<script>
						function setCookie(cname,cvalue,exdays)
						{
							var d = new Date();
							d.setTime(d.getTime()+(exdays*24*60*60*1000));
							var expires = "expires="+d.toGMTString();
							document.cookie = cname + "=" + cvalue + "; " + expires;
						}
						function getCookie(cname)
						{
							var name = cname + "=";
							var ca = document.cookie.split(';');
							for(var i=0; i<ca.length; i++) 
							  {
							  var c = ca[i].trim();
							  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
							  }
							return "";
						}

						//check existing cookie
						cook=getCookie("my_cookie");

						if(cook==""){
						   //cookie not found, so set seconds=60
						   //var seconds = 60;
						   var seconds = <?php echo $quizz->limit_time;?>*60;
						}else{
						     //seconds = cook;
						     //console.log(cook);
						     var seconds = <?php echo $quizz->limit_time;?>*60;
						     //var seconds = 60;
						}

						function secondPassed() 
						{
							if(document.getElementById('countdown'))
						    {
							    var minutes = Math.round((seconds - 30)/60);
							    var remainingSeconds = seconds % 60;
							    if (remainingSeconds < 10) {
							        remainingSeconds = "0" + remainingSeconds; 
							    }
							    //store seconds to cookie
							    setCookie("my_cookie",seconds,5); //here 5 is expiry days
							    
							    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;	
							    
							    if (seconds == 0) 
							    {
							        clearInterval(countdownTimer);
							        document.getElementById('countdown').innerHTML = "Time Out";
							        quizTimeOut();
							    } else {    
							        seconds--;
							    }
							}
						}

						var countdownTimer = setInterval(secondPassed, 1000);
						</script>
					<?php
					}
					?>


        	<?php
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
	//$this->load->model('admin/programs_model');

    $publishID = $_POST['id'];
	$result = $this->programs_model->addtopublish_model($publishID);
	if($result)
	{
		echo"add";
		return true;
	}
	return false;
}

public function removeToPublish()
{
	//$this->load->model('admin/programs_model');

    $publishID = $_POST['id'];
	$result = $this->programs_model->removetopublish_model($publishID);
	if($result)
	{
		echo"remove";
		return true;
	}
	return false;
}
public function searchDiscuss()
{
	$searchitem = $_POST['searchitem'];
	$course_id =$_POST['course_id'];	
 	$quizcomment = $this->program_model->getLessonQuerysearch($course_id,$searchitem);	
 	$sessionarray = $this->session->userdata('logged_in');		
	 $user_id = $sessionarray['id'];
	 if(!empty($quizcomment))
	 {
	 $this->getDiscussionCode($quizcomment,$user_id);
	 }
	 else
	 {
	 	echo"here were no results. Try another search or start a discussion.";
	 }
	return true;
}


function startexam()//new question set, ajax test given for single 
	{
		error_reporting(0);
		 $this->load->model('lessons_model');
		$sessionarray = $this->session->userdata('logged_in');	  	 
		$user_id = $sessionarray['id'];
		$media_id = $_POST['media_id'];
		$proid = $_POST['proid'];	
		$indexy = $_POST['indexy'];	
		$qname = $_POST['qname'];	
		$layoutid = $_POST['layoutid'];	

		$show_countdown = $this->lessons_model->getCountdown($media_id);

		if($indexy == '1')//exam started
		{
			if(!$show_countdown)
			{
				?>
				<strong>Time Remaining : <span style='color:red' id="countdown" class="timer"></span></strong>
				<?php
			}					
			//insert score
			date_default_timezone_set("Asia/Kolkata");
			$currentdate = date("Y-m-d H:i:s");
			$generate = rand(1000,9999);
			$date_gen = date('Y-m-d');
			$exam_attempt_code = $generate.'_'.$date_gen;
			$this->session->unset_userdata('attempt_code');//unset session of attempt code
			$this->session->unset_userdata('subjectivePresent');//unset session for subjective question present or not in exam

			$this->session->set_userdata("attempt_code", $exam_attempt_code);

			$examExist = $this->lessons_model->getQuizGivenAttemptCount($proid, $media_id, $user_id);
			$countExamExist = count($examExist);
			$attempt_no = $countExamExist +1;
			
			if($layoutid == 'finalexam')
			{
				$dirname = $user_id.'_'.$media_id.'_'.$proid;	
			}else
			{
				$dirname = '';
			}

			/*$dataIns = array(
					'user_id' => $user_id,
					'quiz_id' => $media_id,
					'score_quiz' => '',
					'date_taken_quiz' => $currentdate,
					'pid' => $proid,
					'attempt_code' => $exam_attempt_code,
					'time_quiz_taken_per_user' => '',
					'attempt_no' => $attempt_no,
					'snapfoldername' => $dirname,
				);
			$this->lessons_model->insertScoreMarks($dataIns);

			if($layoutid == 'finalexam')//make folder for webcam			
			{				
				$filename = FCPATH."public/uploads/webshotuploads/".$dirname;
				if(!file_exists($filename)) 
				{
				    mkdir(FCPATH."public/uploads/webshotuploads/".$dirname);			    
				}
				$nextfoldername = 'attempt_'.$attempt_no;
				mkdir(FCPATH."public/uploads/webshotuploads/".$dirname.'/'.$nextfoldername);

				$setFolder = $dirname.'/'.$nextfoldername;			
				$this->session->unset_userdata('shot_upload_folder_name');//unset session of attempt code
				$this->session->set_userdata("shot_upload_folder_name", $setFolder);
			}*/
		}
	?>	

		<div id='my_middle_content_question'>
		<table width='100%'>
		<tbody>
		<tr><th colspan='2'>Exam Name :- <span style="color:#42943F"><?php echo $qname;?></span></th></tr>
		<?php	
		$optionArr = array();
		$optionAnsArr = array();
		$array1 = array();
		$array2 = array();
		$totalquestions = 0;
		$settings = $this->lessons_model->getQuestionIds($media_id);		
		if($settings)
		{
		foreach($settings as $sett_ques)
		{			
			$expl_quest = explode(',',$sett_ques->quizzes_ids);
			$totalquestions = count($expl_quest);
			foreach($expl_quest as $key=>$quest)
			{			
				if($key+1 == $indexy)
				{		
					$myquestions = $this->lessons_model->getMyQuestions($quest);					
					foreach($myquestions as $myquest)
					{
						$myoptions = $this->lessons_model->getMyOptions($myquest->question_id);
						?>
						<tr><td colspan='3'><?php echo '<b>'.$indexy.'. </b>';?>&nbsp;&nbsp;<?php echo $myquest->question;?></td></tr>
						<?php
							if($myquest->question_type == 'media_type')
							{
						?>
							<tr><td colspan='3'><embed src="<?php echo base_url() ?>public/uploads/questions/<?php echo $myquest->attachment_url;?>" autostart="false" loop="false" height="200" width="500">
<noembed>Sorry, your browser doesn't support the embedding of multimedia.</noembed>
</embed></td></tr>
						<?php
							}
						?>
						<tr><td colspan='3'><?php echo '<b>Instructions : </b>'.' '.$myquest->instructions;?></td></tr>
						<?php
						$option_index = 1;						
						if($myquest->question_type == 'regular')
						{
							foreach($myoptions as $myopt)
							{						
								?>
								<tr>
									<td colspan='2'><?php echo $option_index.'. ';?>
									<input type='radio' name='btnRegular' onclick='updateMulti(this.value);' value="<?php echo $myopt->option_id.'^'.$myopt->question_id?>">&nbsp;&nbsp;<?php echo $myopt->ans_option;?></td>
								</tr>							
								<?php
								$option_index++;
							}
						}
						else if($myquest->question_type == 'media_type')
						{
							foreach($myoptions as $myopt)
							{						
								?>
								<tr>
									<td colspan='2'><?php echo $option_index.'. ';?>
									<input type='radio' name='btnMedia' onclick='updateMulti(this.value);' value="<?php echo $myopt->option_id.'^'.$myopt->question_id?>">&nbsp;&nbsp;<?php echo $myopt->ans_option;?></td>
								</tr>							
								<?php
								$option_index++;
							}
						}
						else if($myquest->question_type == 'true_false')
						{
							foreach($myoptions as $myopt)
							{						
								?>
								<tr>
									<td colspan='2'>
										<?php echo '1'.'. ';?>
										<input type='radio' onclick='updateTF(this.value);' name='btnTrueFalse' value="<?php echo 'True'.'^'.$myopt->question_id?>">&nbsp;&nbsp;True
									</td>
								</tr>	
								<tr>
									<td colspan='2'>
										<?php echo '2'.'. ';?>
										<input type='radio' onclick='updateTF(this.value);' name='btnTrueFalse' value="<?php echo 'False'.'^'.$myopt->question_id?>">&nbsp;&nbsp;False
									</td>
								</tr>						
								<?php
								$option_index++;
							}
						}
						else if($myquest->question_type == 'subjective')
						{
							foreach($myoptions as $myopt)
							{
							?>
								<tr>
									<td><textarea name='txtSubjective' id='txtSubjective' onblur="updateSubjective(this.value,'<?php echo $myopt->question_id?>')" ></textarea></td>
								</tr>
							<?php
							}
							$this->session->set_userdata('subjectivePresent','yes');
						}
						else if($myquest->question_type == 'multiple_type')
						{
							foreach($myoptions as $myopt)
							{						
								?>
								<tr>
									<td colspan='2'><?php echo $option_index.'. ';?>
									<input type='hidden' id='txtOption<?php echo $option_index;?>' name='txtOption<?php echo $option_index;?>' value='<?php echo $myopt->option_id;?>'>	
									<input type='checkbox' name='btnMultiple' onclick='updateMultipleType(this.value);' id='btnMultiple<?php echo $option_index;?>' value="<?php echo $myopt->option_id.'^'.$myopt->question_id?>">&nbsp;&nbsp;<?php echo $myopt->ans_option;?>
									</td>
								</tr>	
								<input type='hidden' id='txtQuestionId' name='txtQuestionId' value='<?php echo $myopt->question_id;?>'>														
								<?php
								$option_index++;
							}
						}
						else if ($myquest->question_type == 'match_the_pair')
						{	
							$arrayShuffle = array();
							foreach($myoptions as $myopt)
							{
								array_push($arrayShuffle, $myopt->is_correct_answer);
							}	
							shuffle($arrayShuffle);		
							
							foreach($myoptions as $myopt)
							{																					
								?>
								<tr>
									<td><?php echo $option_index.'. '.$myopt->ans_option;?><input type='hidden' name="txtQuestion<?php echo $option_index;?>" id="txtQuestion<?php echo $option_index;?>" value="<?php echo $myopt->option_id;?>"></td>
									<td><?php echo $option_index.'. ';?><input type='text' readonly='readonly' name="txtOption<?php echo $option_index;?>" id="txtOption<?php echo $option_index;?>" value="<?php echo $arrayShuffle[$option_index-1];?>" /></td>
									<td><input type='text' name='btnMatchPair<?php echo $option_index;?>' id='btnMatchPair<?php echo $option_index;?>'></td>
									<!--<td><input type='text' onchange="updateMatches(this.value,'<?php echo $myopt->question_id?>')" name='btnMatchPair' id='btnMatchPair'></td>-->
								</tr>							
								<input type='hidden' id='txtQuestionId' name='txtQuestionId' value='<?php echo $myopt->question_id;?>'>
								<?php
								$option_index++;
							}
						}
						?>
						<input type='hidden' name='txtMulti' id='txtMulti' >
						<?php
					}	

					if($totalquestions == $key+1)
					{
						?>
						<tr><td colspan='2'><input type='button' value='End Quiz' name='btnName' id='btnName' class="btn btn-sm btn-success btn-update" onclick="clearInterval(countdownTimer), endquiz('<?php echo $qname;?>',<?php echo $media_id;?>,<?php echo $proid;?>,'<?php echo $layoutid;?>',<?php echo $indexy+1;?>,'<?php echo $myquest->question_type;?>');">
						<?php
					}
					else
					{
						?>
						<tr><td colspan='2'><input type='button' value='Next Question' name='btnName' id='btnName' class="btn btn-sm btn-success btn-update" onclick="nextQuestion('<?php echo $qname;?>',<?php echo $media_id;?>,<?php echo $proid;?>,'<?php echo $layoutid;?>',<?php echo $indexy+1;?>,'<?php echo $myquest->question_type;?>');">
						<?php
					}
				}							
			}
		}
	}//if
	else
	{

	}
	?>
		</tbody>
		</table>
		</div>
		<?php		
	}

	function endquiz()
	{      

		$qname = $_POST['qname'];     
		
		?>
		<table>
		<tbody>
		<tr><th colspan='2'>Exam Name :- <span style="color:#42943F"><?php echo $qname;?></span></th></tr>
		<tr><th colspan='2'><span style="color:#42943F">Exam Ends</span></th></tr>
		</tbody>
		</table>
		<?php		
	}


	public function finalexamnew()
	{
		$this->load->model('Tasks_model');
	  	$this->load->model('admin/quizzes_model');
	  	$this->load->model('admin/settings_model');
	  	 $this->load->model('lessons_model');
		$program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
      	$final_exam_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
      	$sessionarray = $this->session->userdata('logged_in');	  	
		$user_id = $sessionarray['id'];	 

      /*$date_enrolled = $this->Tasks_model->datebuynow($program_id, $user_id);
		if(count($date_enrolled) > 0)
		{
			$not_show = true;
		}
		else
		{
			$not_show = false;
		} */
			 	
		$this->template->set("program_id", $program_id);	
		$this->template->set("user_id", $user_id);		
		$this->template->set("isfinalview", 'true');
		$this->load->model('Program_model');
		   

		$this->template->build('programs/coursepreview');
	}



public function getDiscussionCode($quizcomment,$user_id)
{
	foreach ($quizcomment as $quizComment)
					{
						
						$userData = $this->program_model->getStudentsInfo($quizComment->user_id);
						if(!empty($userData))
						{
						    $lessonName = NULL;
							if($quizComment->lesson_id)
							{
								$lessonName = $this->program_model->getLessonName($quizComment->lesson_id);
							}
						$timeago=$this->get_timeago(strtotime($quizComment->dateandtime));
						$path = base_url()."public/uploads/users/img/thumbs/".$userData->images;
						echo"<li>
							<div class='comment'>
								<div class='comment-thumb'> <a href='#'> <img src='$path' alt='' class='img-circle' width='44'> </a> </div>
								<div class='comment-content'>
								  <div class='comment-author' style='font-size: 13px;'> <a href='#'>$userData->first_name &nbsp $userData->last_name;</a> posted a discussion <b>$lessonName</b> 
								 <div class='comment-info'>- Commented On $timeago </div>
								</div>
								<div class='comment-head'>$quizComment->query_title</div>
								<div class='comment-text'>$quizComment->query_text</div>

								<a href='javascript:void(0)' class='liked' id='like$quizComment->query_id'  style='margin: 0 45px;'> <i class='entypo-heart'></i>";
												$this->load->model('Category_model');									
										  $total_likes = $this->Category_model->getAllLike($quizComment->query_id);
										  $likes = $this->Category_model->getLikes($quizComment->query_id,$user_id);
										   $liked = NULL;
                                           foreach($likes as $like)
										   {
												if($user_id == $like->user_id && $quizComment->query_id == $like->query_id)
												{
													 $liked = 'yes';
													 $like_id = $like->like_id;
												}
										   }
										 if($liked)
										 {
									  
									echo"<span onclick='unlike($like_id,$quizComment->query_id,$quizComment->user_id,$quizComment->pro_id)'>Liked($total_likes) </span> ";
									
										}
										else
										{
									
									echo"<span onclick='like($quizComment->query_id,$quizComment->user_id,$quizComment->pro_id)'>Like($total_likes) </span>";
									
										}
										
									
								echo"</a>";

								$countcomment = $this->program_model->getLessonAnswer2($quizComment->query_id);

								echo"<a href='javascript:void(0)' id='comment$quizComment->query_id' onclick='show_div($quizComment->query_id)'> <i class='entypo-comment'></i>Comments <span id='comment_count$quizComment->query_id'>(<span id='countComment$quizComment->query_id' >$countcomment->count1</span>)</span></a>
								<div id='comment_div$quizComment->query_id' style='display:none'>									    
										<ul id='question_list$quizComment->query_id'>";
											
											$lessonAns = $this->program_model->newGetLessonAnswer($quizComment->query_id);						
												


											foreach($lessonAns as $answer)
											{
												$userData = $this->program_model->getStudentsInfo($answer->user_id);
													$timeago2 = $this->get_timeago(strtotime($answer->dateandtime));
												echo"<li id='li$answer->ans_id'>
													<div class='comment'>
														
														<div class='comment-content'>
															<div class='comment-author' style='font-size: 13px'><a href='#'>$userData->first_name &nbsp $userData->last_name</a> - Commented On $timeago2</div>
															
															<div class='comment-text'>$answer->answer</div>															
														</div>
													</div>
												</li>";
											
											}									 
																					
										echo"</ul>
										<ul>
											<li>
												<div>
													<textarea name='comment_box$quizComment->query_id' placeholder='Write Reply' id='comment_box$quizComment->query_id'></textarea>
													<input class='btn btn-success' type='button' onclick='add_comment($quizComment->query_id,$quizComment->pro_id);' name='replyBtn$quizComment->query_id' id='replyBtn$quizComment->query_id' value='Reply'/>
												</div>
											</li>										
										</ul>							       
								</div>								
							</div>							
						</li>"; 
						unset($liked);
							}
					}
}

public function getDiscussion()
{
	$course_id =$_POST['course_id'];
	$quizcomment = $this->program_model->getLessonQueryAjaxfresh($course_id);	
 	$sessionarray = $this->session->userdata('logged_in');		
	 $user_id = $sessionarray['id'];
	 $this->getDiscussionCode($quizcomment,$user_id);
	 return true;
}
public function getlessionDiscussion()
{
		$lesson_id = $_POST['les'];
		$pid = $_POST['pro'];
		$module_id = $_POST['mod'];
	$quizcomment = $this->program_model->getlessionDiscussion_model($pid,$module_id,$lesson_id);	
 	$sessionarray = $this->session->userdata('logged_in');		
	 $user_id = $sessionarray['id'];
	 $this->getDiscussionCode($quizcomment,$user_id);
	 return true;
}

public function insertDiscussion()
{
	$sessionarray = $this->session->userdata('logged_in');
		$query_title =$_POST['query_title'];
		$query_text = $_POST['query_text'];
		$user_id = $sessionarray['id'];
		$lesson_id = $_POST['les'];
		$pid = $_POST['pro'];
		$module_id = $_POST['mod'];
		

	$data = array(
		'query_title' => $query_title,
		'query_text' => $query_text,
		'user_id' => $user_id,
		'pro_id' => $pid,
		'mod_id' => $module_id,
		'lesson_id' => $lesson_id,
		'dateandtime' => date("Y-m-d h:i:s")

		);
	$this->load->model('Tasks_model');
	 $query_id = $this->Tasks_model->saveLessonQueryAsk($data);
	 echo" ";
	 return true;
}
function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'just Now';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}

public function getSearchStudent()
{
	$sessionarray = $this->session->userdata('logged_in');
	$searchitem = $_POST["searchitem"];
	$course_id =$_POST["course_id"];
	$user_id = $sessionarray['id'];

	$students = $this->program_model->getEnrolledUser($course_id);

	
	if($students)
		{
			foreach($students as $stud)
			{
				$user = $this->program_model->getSearchStudentsInfo($stud['userid'],$searchitem);
				
				if(!empty($user)) 
					{
					if($user->id != $user_id)
					{
						
					
						$user_image = $user->images ? $user->images : 'temp.jpg';
						 $path = base_url()."public/uploads/users/img/thumbs/".$user_image;

						echo"<li class='student-list' > <a href=''> <span class='bordered-thumb'><img border='0' alt='' src='$path'></span> </a>
							<h4 style='float:left'>$user->first_name &nbsp $user->last_name</h4>
							<span id='span$user->id' class='btn-wrapper' style='float:right'>";

							$followers = $this->program_model->getFollower($user_id);

								$followed = NULL;
							   foreach ($followers as $follows) 
									  {
										if($follows->followee_id == $user->id)
										{
											  $followed = 'yes';
											  $follow_id = $follows->follow_id;
										}
									  }
							
							
								if($followed)
								{
						   
							echo"<a href='javascript:void(0)' onclick='ajax_following($user->id,$follow_id)' class='btn btn-success'>Following</a> ";
							
								}
								else
								{
							
							echo"<a href='javascript:void(0)' onclick='ajax_follow($user->id)' class='btn btn-info'>Follow</a> ";
							
								}
							
							echo"<a href='#' class='btn'>Message</a> </span> 
								</li>";

					}
				
			    }

			}
		}
		


	return true;
}
public function countcomment()
{
	$countcmt =$_POST["qid"];
	$countcomment1 = $this->program_model->getLessonAnswer2($countcmt);

	echo $countcomment1->count1;
	return true;
}
public function getAllDiscussion()
{

	 $pid = $_POST['course_id'];		
	 $quizcomment = $this->program_model->getAllLessonQuery($pid);	
 	 $sessionarray = $this->session->userdata('logged_in');		
	 $user_id = $sessionarray['id'];
	 $this->getDiscussionCode($quizcomment,$user_id);
	 return true;
}

public function viewresult()
    {
    	$configarr = $this->settings_model->getItems();
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $configarr[0]['layout_template'];		
		$this->template->set("tmpl", $tmpl);
		$this->template->append_metadata(block_submit_button());
		$this->load->helper('form');
		
        $userid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
		$quizid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;		
		$userinfo=$this->programs_model->getUserInfo($userid);
		$resultinfo=$this->programs_model->getUserQuizResult($quizid);		
        //$this->template->set_layout('backend');
		$this->template->set("userinfo", $userinfo);
		$this->template->set("resultinfo", $resultinfo);
        $this->template->build('programs/quizresult');
    }

    function pdf()
    {
    	
    	
    	$this->load->helper('pdf_helper');     
       
       $this->load->view('programs/pdfNotes');     
    }

    function getmorewebinar()
    {
    	$user_id =$_POST['user_id'];
    	$course_id =$_POST['course_id'];
    	$this->load->model('Program_model');
    	if($this->program_model->checkEnrolled($user_id,$course_id));
    	{	
    	     $webinars = $this->Program_model->getWebinarsNewAll($course_id);	
    	    // print_r($webinars);
    		foreach($webinars as $webinar)
			{
				// <input type='hidden' value='$userfname' name='ufname'>
				// <input type='hidden' value='$usermail' name='uemail'>
				//$attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);
    		 	//form_open(base_url().'conwebinar/',$attributes);
    		 	$bas = base_url().'conwebinar';
    		 	echo"<tr><form class = tform id = webinarpost$webinar->proid  name = webinarpost$webinar->proid  action = $bas >
				<input type='hidden' value='$webinar->proid' name='progid'>
				<input type='hidden' value='$webinar->id' name='webinarid'>
				<td><span>$webinar->title</span></td>
                <td><span>$webinar->fromdate</span></td>
                <td><span>$webinar->fromtime GMT </span></td>                
				<td><input type='submit' class='btn btn-gold' value='Go' name='submit'></td></tr> </from>";
    		}
    	}
    	//echo"yes";
    	return true;
    }

    function createcategory()
	{
		$this->load->view('programs/createcoursecategories');
	}

    function savecategory()
	{
	 $program_name = $this->input->post('name');
	 $program_description = $this->input->post('description');
	 $program_category_id = $this->input->post('category_id');
	 $program_published = $this->input->post('published');	
	   

	 	$sessionarray = $this->session->userdata('logged_in');		
	    $user_id = $sessionarray['id'];

	   $cropimagename = ($this->input->post('nameimg')) ? ($this->input->post('nameimg')) : 'no_images.jpg';	
		   //$maxrow = $this->program_model->maxRow($parent_id);
	   		$maxrow=null;
           $orderingval = 0;
		   $orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;
           $data = array(
			'name' => $program_name,
			'description' => $program_description,
			'alias' => $program_name,
			'published' => $program_published,
			'ordering' => $orderingval,
			'created_by' => $user_id,
            'image' => $cropimagename         
		);
        $rs = $this->program_model->insertCategory($data);
	   echo $rs; 
	   //echo $program_published;
	}

	function cropcategoryimg()
	{
		$this->load->view('programs/cropcategoryimg');
	}

	public function uploadcategoryeimg()
    {	//exit('yes');	
      
    	$data = $_POST['img'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);		
		
		
		$capturedate = date("Y-m-d H:i:s");
		$datetime1 = explode(' ',$capturedate);
		$name1 = 'scr_'.$datetime1[0].'_'.$datetime1[1];

		$generate1 = "";
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;

  		echo $generate1 . '.png';
		
		$file2 = FCPATH.'public/uploads/pcategories/img/'.$generate1.'.png';
		if(file_put_contents($file2, $data))//for upload file to the server
		{
			//executed
				$status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/pcategories/img/'.$generate1.'.png';
        		$config['new_image'] = FCPATH.'public/uploads/pcategories/img/thumb_232_216/'.$generate1.'.png';
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 290;
                $config['height'] = 162;

        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';

		}
		$course_id = $this->uri->segment(4);	
 	     	   
		
    }

// function test_mail(){
// 		exit("anisha");
// 		$this->load->helper('all_email');

//    echo test_method('Hello World');
// 	}

}
?>