<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ConWebinar extends MLMS_Controller {
	function __construct()	{	
		parent::__construct();		
		$this->template->set_layout('frontend');        
		$this->load->helper('cookie');		
		$this->load->model('webinars_model');		
		$this->load->model('admin/settings_model');
		$this->load->helper('date');		
		$this->load->config('features_config');	
		// $this->load->helper('wiziq/webinar');
		$this->load->library('webinar_library');

		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
	}
		
	public function index($pro_id = NULL)
	{	
	   	// $tmpl = $this->configarr[0]['layout_template'];
	   	// $this->template->set("tmpl",$tmpl);
		if($this->input->post('webrecording'))
		{
			$this->template->set("webrecording",$this->input->post('webrecording'));
		}
		$sessionarray = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in')){
		$user_id = $sessionarray['id'];

		//$group_id = $sessionarray['groupid'];
		if($this->input->post('progid'))		
		{
			$username = $this->input->post('ufname');
			$progid = $this->input->post('progid');
			$webinarid = $this->input->post('webinarid');
			$postarray = array('progid' =>$progid, 'webinarid' =>$webinarid );
			$this->session->set_userdata('webinarpost',$postarray);
		}
		else{
			$username = $sessionarray['first_name'];
		}
		
		$webinarpost = $this->session->userdata('webinarpost');	
		$progid = $webinarpost['progid'];	
		$webinarid = $webinarpost['webinarid'];	
		$this->load->model('Program_model');	
		$this->load->model('myinfo_model');	
		$webinar = $this->config->item('webinar');       
		/*date time area*/			
		$datestring = "%Y-%m-%d %h:%i%a";				
		$time = time();	

		//$timezone = new DateTimeZone($configarr[0]['time_zone']);
				
		$date = new DateTime();		
		//$date->setTimezone($timezone);		
		$currdate1 = $date->format( 'Y-m-d' );					
		$currtime1 = $date->format( 'h:ia' );		
		$currdateandtime = $date->format( 'Y-m-d h:ia' );
		// echo $currdateandtime; exit('jyoti');

		// $timezone = new DateTimeZone("Asia/Kolkata" );		
		// $date = new DateTime();		
		// $date->setTimezone($timezone);		
		// $currdate1 = $date->format( 'Y-m-d' );					
		// $currtime1 = $date->format( 'h:ia' );		
		// $currdateandtime = $date->format( 'Y-m-d h:ia' );	

		//date('Y-m-d h:ia');		//$current_date_string = mdate($datestring, $time);		//$current_date_string = date('Y-m-d h:ia');		//$current_date_string = $currdate1.' '.$currtime1;		//$current_date_int = strtotime($currdateandtime);

		// $current_date_int = strtotime(date('Y-m-d h:ia'));	
		$current_date_int = $currdateandtime;		
		$webinarobj = $this->webinars_model->getWebinar($progid,$webinarid);
				
		$webinarfromdateint = strtotime($webinarobj->fromdate.' '.$webinarobj->fromtime);		
		//$webinartodateint = strtotime($webinarobj->todate.' '.$webinarobj->totime);
		$webinartodateint = '';		
		/*date time area*/		
		if(!isset($progid) && $progid == '')	
		{	      	redirect('category');	    }				
		
		$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;	
		$this->template->set_layout($configarr[0]['layout_template']);	
		$tmpl = $this->configarr[0]['layout_template'];	
		$this->template->set("tmpl", $tmpl);	
		$program = $this->Program_model->getProgram($progid);
		if(isset($user_id))
		{
			/* features settings */
			if($webinar['status']==FALSE)			
			{
				redirect('index');
			}			
			else			
			{		
				/*if($webinar['limited_meetings']){
				$meetings_limit = $webinar['meetings_permonth'];
				$current_month;
				}
				if($webinar['limited_classes']){
				$meetings_limit = $webinar['classes_permonth'];
				}*/
		    }
	   /* features settings */
			$userdetail = $this->myinfo_model->getUser($user_id);	
			//$uroomid=$program->roomid;	
			//$uroomid=1123;	
			$grpid=$userdetail->group_id;
			if($grpid==1)
            $ishost=0;
			else
            $ishost=1;
			$useremail=$userdetail->email;	
			$userfname=$userdetail->first_name;	
			$userlname=$userdetail->last_name;	
			$uname=$userdetail->username;	
			$webstatus=$userdetail->webstatus;
			if($program->webstatus=='active')
			{
				if($this->Program_model->checkEnrolled($user_id,$progid))
				{
					$uroomid="16960";
					$studwebinar=null;
					if(($current_date_int>=$webinarfromdateint)&&($current_date_int<=$webinartodateint))
					{
					  //$studwebinar=$this->addStudent($uroomid,$userfname,$useremail,$ishost,$webinarid,$progid);
					}
					//$studwebinar=$this->addEvent($uroomid,$userfname,$useremail,$progid,$ishost);
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


			$this->template->set("progid",$progid);
			
			
		  
			 $dbname = $this->db->database;  
	  
	       $db_uname = substr($dbname,0,-7);
		   
		   if($this->input->get('msg'))
	   {
	   	//$this->load->view('template/classic/header');
			$this->template->build('programs/viewwebinar');
	   }
			
			//require_once("WiZiQ/WiZiQ.Class/WiZiQService_addAttendee.php");

	   //$webinar_data = AddAttendee($webinarobj,$sessionarray,$username);
	   		 $webinar_data = $this->webinar_library->AddAttendee($webinarobj,$sessionarray,@$username);
	   		// print_r($webinar_data); exit('jyoti');
			if(@$webinar_data['status'] == 'ok')
			{

				$row_id = $this->Program_model->getWebinarBuyid($webinarobj->proid,$sessionarray['id']);
				if($row_id->id)
				{
					
					$row_attendee_url = $this->Program_model->getWebinarAttendee($webinarobj->wiziq_class_id);
					$s_id = "false";
					 $id_field = explode(",",$row_attendee_url->wiziq_attendee_id);	
						  
							  foreach($id_field as $id_value)
							  {
								$users_id = explode("^",$id_value);
								$userid_array[] = $users_id;

							  }
						  
						  
						   
						   for($i=0;$i<count($userid_array);$i++)
						   {
							   if(in_array($sessionarray['id'],$userid_array[$i]))
							   {	
								  $s_id = "true";
							   }						  
							   
						   }	
					
						    if($s_id == "false")
							{
								$update_url = $this->Program_model->getAttendeeUpadate($webinar_data,$webinarobj->wiziq_class_id);
								$row_attendee_url = $this->Program_model->getWebinarAttendee($webinarobj->wiziq_class_id);
							}
							
					// print_r($row_attendee_url);

					// if(empty($row_attendee_url->wiziq_attendee_url))
					// {
					// 	$update_url = $this->Program_model->getAttendeeUpadate($webinar_data,$webinarobj->wiziq_class_id);
					// 	$row_attendee_url = $this->Program_model->getWebinarAttendee($webinarobj->wiziq_class_id);
					// }

					 $url_field = explode(",",$row_attendee_url->wiziq_attendee_url);	
							  foreach($url_field as $url_value)
							  {
								$users_id = explode("^",$url_value);
								$userid_array[] = $users_id;
							  }
						  
						   
						   for($i=0;$i<count($userid_array);$i++)
						   {
							   if(in_array($sessionarray['id'],$userid_array[$i]))
							   {
								  $perfect_url = $userid_array[$i][1];
							   }						  
							   
						   }
						   
						   $id_field = explode(",",$row_attendee_url->wiziq_attendee_id);	
						  
							  foreach($id_field as $id_value)
							  {
								$users_id = explode("^",$id_value);
								$userid_array[] = $users_id;
							  }
						  
						  
						   
						   for($i=0;$i<count($userid_array);$i++)
						   {
							   if(in_array($sessionarray['id'],$userid_array[$i]))
							   {
								  $perfect_id = $userid_array[$i][1];
							   }						  
							   
						   }	
					
				}

			}	
			
			
           	$webinarobj = $this->webinars_model->getWebinar($progid,$webinarid);				
			$this->template->set("webinarinfo",$webinarobj);		
			$this->template->set("perfect_url",@$perfect_url);
			
			$this->template->set("addstudresponse",$studwebinar);
          		//$this->load->view('template/classic/header');		
			$this->template->build('programs/viewwebinar');
		}		
		else		
		{
			$this->template->build('user/login');
        }      
	}


			public function ajaxwebinar($pro_id = NULL)
	{
	   	// $tmpl = $this->configarr[0]['layout_template'];
	   	// $this->template->set("tmpl",$tmpl);
		
		$sessionarray = $this->session->userdata('logged_in');
		if($this->session->userdata('logged_in')){
		$user_id = $sessionarray['id'];
			 // print_r($_POST); exit('jyoti');
		$group_id = $sessionarray['groupid'];
		if($this->input->post('progid'))		
		{
			$username = $this->input->post('ufname');
			$progid = $this->input->post('progid');
			$webinarid = $this->input->post('webinarid');

			$postarray = array('progid' =>$progid, 'webinarid' =>$webinarid);
			$this->session->set_userdata('webinarpost',$postarray);
		}
		
		$webinarpost = $this->session->userdata('webinarpost');	
		$progid = $webinarpost['progid'];	
		$webinarid = $webinarpost['webinarid'];	
		$this->load->model('Program_model');	
		$this->load->model('myinfo_model');	
		$webinar = $this->config->item('webinar');       
		/*date time area*/			
		$datestring = "%Y-%m-%d %h:%i%a";				
		$time = time();		
		$date = new DateTime();		
		//$date->setTimezone($timezone);		
		$currdate1 = $date->format( 'Y-m-d' );					
		$currtime1 = $date->format( 'h:ia' );		
		$currdateandtime = $date->format( 'Y-m-d h:ia' );	

		//date('Y-m-d h:ia');		//$current_date_string = mdate($datestring, $time);		//$current_date_string = date('Y-m-d h:ia');		//$current_date_string = $currdate1.' '.$currtime1;		//$current_date_int = strtotime($currdateandtime);

		// $current_date_int = strtotime(date('Y-m-d h:ia'));	
		$current_date_int = $currdateandtime;		
		$webinarobj = $this->webinars_model->getWebinar($progid,$webinarid);
				// print_r($webinarobj);echo $webinarid; exit('jyoti');
		$webinarfromdateint = strtotime($webinarobj->fromdate.' '.$webinarobj->fromtime);		
		//$webinartodateint = strtotime($webinarobj->todate.' '.$webinarobj->totime);
		$webinartodateint = '';		
		/*date time area*/		
		if(!isset($progid) && $progid == '')	
		{	      	redirect('category');	    }				
		
		$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;	
		$this->template->set_layout($configarr[0]['layout_template']);	
		$tmpl = $this->configarr[0]['layout_template'];	
		$this->template->set("tmpl", $tmpl);	
		$program = $this->Program_model->getProgram($progid);
		if(isset($user_id))
		{
			/* features settings */
			if($webinar['status']==FALSE)			{
				redirect('index');
			}			else			{		
				/*if($webinar['limited_meetings']){
				$meetings_limit = $webinar['meetings_permonth'];
				$current_month;
				}
				if($webinar['limited_classes']){
				$meetings_limit = $webinar['classes_permonth'];
				}*/
		    }
	   /* features settings */
			$userdetail = $this->myinfo_model->getUser($user_id);	
			//$uroomid=$program->roomid;	
			//$uroomid=1123;	
			$grpid=$userdetail->group_id;
			if($grpid==1)
            $ishost=0;
			else
            $ishost=1;
			$useremail=$userdetail->email;	
			$userfname=$userdetail->first_name;	
			$userlname=$userdetail->last_name;	
			$uname=$userdetail->username;	
			$webstatus=$userdetail->webstatus;
			if($program->webstatus=='active')
			{
				if($this->Program_model->checkEnrolled($user_id,$progid))
				{
					$uroomid="16960";
					$studwebinar=null;
					if(($current_date_int>=$webinarfromdateint)&&($current_date_int<=$webinartodateint))
					{
					  //$studwebinar=$this->addStudent($uroomid,$userfname,$useremail,$ishost,$webinarid,$progid);
					}
					//$studwebinar=$this->addEvent($uroomid,$userfname,$useremail,$progid,$ishost);
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


			$this->template->set("progid",$progid);
			
			
		  
			 $dbname = $this->db->database;  
	  
	       $db_uname = substr($dbname,0,-7);
		   
		 //   if($this->input->get('msg'))
	  //  {
	  //  	//$this->load->view('template/classic/header');
			// $this->template->build('programs/viewwebinar');
	  //  }
			
			//require_once("WiZiQ/WiZiQ.Class/WiZiQService_addAttendee.php");

	   $webinar_data = $this->webinar_library->AddAttendee($webinarobj,$sessionarray,$username);
	   		//print_r($webinar_data); exit('jyoti');
			if(@$webinar_data['status'] == 'ok')
			{

				$row_id = $this->Program_model->getWebinarBuyid($webinarobj->proid,$sessionarray['id']);
				if($row_id->id)
				{
					

					$row_attendee_url = $this->Program_model->getWebinarAttendee($webinarobj->wiziq_class_id);
					$s_id = "false";
					 $id_field = explode(",",$row_attendee_url->wiziq_attendee_id);	
						  
							  foreach($id_field as $id_value)
							  {
								$users_id = explode("^",$id_value);
								$userid_array[] = $users_id;

							  }
						  
						  
						   
						   for($i=0;$i<count($userid_array);$i++)
						   {
							   if(in_array($sessionarray['id'],$userid_array[$i]))
							   {	
								  $s_id = "true";
							   }						  
							   
						   }	
							// echo $s_id; exit('jyoti');
						    if($s_id == "false")
							{
								$update_url = $this->Program_model->getAttendeeUpadate($webinar_data,$webinarobj->wiziq_class_id);
								$row_attendee_url = $this->Program_model->getWebinarAttendee($webinarobj->wiziq_class_id);
							}
							
					// print_r($row_attendee_url);

					// if(empty($row_attendee_url->wiziq_attendee_url))
					// {
					// 	$update_url = $this->Program_model->getAttendeeUpadate($webinar_data,$webinarobj->wiziq_class_id);
					// 	$row_attendee_url = $this->Program_model->getWebinarAttendee($webinarobj->wiziq_class_id);
					// }

					 $url_field = explode(",",$row_attendee_url->wiziq_attendee_url);	
							  foreach($url_field as $url_value)
							  {
								$users_id = explode("^",$url_value);
								$userid_array[] = $users_id;
							  }
						  
						   
						   for($i=0;$i<count($userid_array);$i++)
						   {
							   if(in_array($sessionarray['id'],$userid_array[$i]))
							   {
								  $perfect_url = $userid_array[$i][1];
							   }						  
							   
						   }
						   
						   $id_field = explode(",",$row_attendee_url->wiziq_attendee_id);	
						  
							  foreach($id_field as $id_value)
							  {
								$users_id = explode("^",$id_value);
								$userid_array[] = $users_id;
							  }
						  
						  
						   
						   for($i=0;$i<count($userid_array);$i++)
						   {
							   if(in_array($sessionarray['id'],$userid_array[$i]))
							   {
								  $perfect_id = $userid_array[$i][1];
							   }						  
							   
						   }	
					
				}

			}	
			
			
           	$webinarobj = $this->webinars_model->getWebinar($progid,$webinarid);				
			$this->template->set("webinarinfo",$webinarobj);	

			// $this->template->set("perfect_url",$perfect_url);
			
			$this->template->set("addstudresponse",$studwebinar);
			//print_r($webinarobj);
			// $currentgmt1 = gmdate('Y-m-d H:i');
			$date = new DateTime();
			$today = $date->format( 'Y-m-d H:i' );

			$currentgmt = strtotime ( '+1 minute' , strtotime ( $today ) ) ;
$currentgmt = date ( 'Y-m-d H:i' , $currentgmt );
			// print_r($perfect_url); exit('jyoti');
			if($webinarobj)
			{
				$web_schedule = $webinarobj->fromdate.' '.$webinarobj->fromtime;

					$newtimestamp1 = strtotime($web_schedule.' + '.$webinarobj->web_duration.' minute');
					$web_time1 = date('Y-m-d H:i:s', $newtimestamp1);

					$webinarobj->web_duration = ($webinarobj->web_duration + '59');					
					$newtimestamp2 = strtotime($web_schedule.' + '.$webinarobj->web_duration.' minute'); 
					 $web_time2 = date('Y-m-d H:i:s', $newtimestamp2);
			
					 	//print_r($webinarobj);
					 	$str ='<div class="iframe_div"><h2>'.$webinarobj->title.'</h2>';

					  if($web_schedule >= $currentgmt)
					 { 
						$str = $str.'<a id="start" data-toggle="tooltip"  title="Class Start On '.$web_schedule.'" >Please wait !.. class will be started soon...</a>';
					 }

					 else if($web_time1 >= $currentgmt && $web_time2 >= $currentgmt)
					 {	
					 	if($group_id == '4')
					 	{ 	
					 		$web_url = $webinarobj->wiziq_presenter_url;	
					 	}	
					 	else {
					 		
					 		$attendee_url =explode("^", $webinarobj->wiziq_attendee_url);
					 		 // print_r($attendee_url);
					 		if(isset($attendee_url[1]))
					 		{
					 			$attendee_url =explode(",", $attendee_url[1]);
					 		}
					 	 	$web_url = $attendee_url[0];
					 	 }

					 	$str = $str.'<button class="btn btn-success start" onclick=web_start("'.$web_url.'") style="margin-top:-10px;color: #fff; font-weight: 700; background: #54b551; font-size: 12px;" id="start" value="Start" name="submit"> Start </button>';

					  }
					else if($currentgmt >= $web_time2)	
					{	
						$recording_url = $webinarobj->wiziq_recording_url;
						$str = $str.'<a href="#" style="margin-right: -10%;" onclick=web_start("'.$recording_url.'") >View Recording</a>';
					 } 
					 else {
 						$str  = $str.'<a id="start" data-toggle="tooltip"  title="Your live class is over!<br> Please Wait a moment, Recording is in progress..." style="margin-right: -10%;"> Class is over!</a>';
					}
						$str = $str."</div>";
					echo $str;

				//echo json_encode($webinarobj);
			}
			else if($perfect_url)
			{
				echo json_encode($perfect_url);
				//return $perfect_url;
			}

          		//$this->load->view('template/classic/header');		
			//$this->template->build('programs/viewwebinar');
		}		
		else		
		{
			//$this->template->build('user/login');
        }      
	}

    function addStudent($roomid,$firstname,$email,$ishost,$webinarid,$pro_id)
    {
        $this->load->helper('unirowclient');
        $apikey = "4baf11ac9f3ab7e326b8ff1e48887ffa";
        $domain = "sailorsclub.unirow.com";
        $username = "sailorsclub";
        $password = "sailorsclub@2013";

       $unirowclient = new unirowClient;
       $unirowclient->connect($username,$password, $domain, $apikey);

        $title ="Welcome to VeerIT";
        $redirectURL=base_url()."programs/programs/".$pro_id;
        //meeting Id
        $id = $webinarid;

        // select the mode you want to start the session =>
        // mode is webinar for learning session

        $mode = "webinar";

        $ishost = $ishost;   // 0 for student


        $startrecording = "0";

        //if deduplicate is set to 1 single user can enter from 2 computers.
        $deduplicate = "1";

        //external user id to check if the user already exists in the session
		$rand = rand(1, 9);
        $ext_user_id = "10".$rand;

        $student = $unirowclient->addUserToRoom($ext_user_id, $firstname, $email, $ishost, $roomid, $id, $title, $redirectURL,$mode, $startrecording, $deduplicate);

        //$this->template->set("stud", $student);
       return $student;

      // return $title;
    }
function eventresponse(){
print_r($_REQUEST);

}
function addEvent($roomid,$firstname,$email,$pro_id,$ishost)
    {
        $this->load->helper('unirowclient');
        $apikey = "4baf11ac9f3ab7e326b8ff1e48887ffa";
        $domain = "sailorsclub.unirow.com";
        $username = "sailorsclub";
        $password = "sailorsclub@2013";

       $unirowclient = new unirowClient;
       $unirowclient->connect($username,$password, $domain, $apikey);

        $meeting_title ="Welcome to VeerIT";
        $redirectURL=base_url()."conwebinar/eventresponse/";
        //meeting Id
        $meeting_id = $pro_id;

        // select the mode you want to start the session =>
        // mode is webinar for learning session

        $mode = "webinar";

        $ishost = $ishost;   // 0 for student
        //$ishost = 1;   // 0 for student


        $startrecording = "0";

        //if deduplicate is set to 1 single user can enter from 2 computers.
        $deduplicate = "1";

        //external user id to check if the user already exists in the session
        $ext_user_id = "100";

        //$student = $unirowclient->addUserToRoom($ext_user_id, $firstname, $email, $ishost, $roomid, $id, $title, $redirectURL,$mode, $startrecording, $deduplicate);
		$unirowclient->addEventUserToRoom($firstname, $email, $ishost, $roomid, $meeting_id, $meeting_title, $redirectURL);

        //$this->template->set("stud", $student);
      return $student;
       //return $unirowclient->getRooms();

      // return $title;
    }

}
?>