<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends MLMS_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->helper('access');
        $this->load->helper('time_difference');
		$this->load->model('admin/settings_model');

		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);

		$this->load->helper('date');
		$this->load->helper('url');

		$this->load->library('ckeditor');

        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/'; 

        $this->load->model('lessons_model');

        $this->load->model('Myinfo_model');
        $this->load->model('exam_model');
		
		$this->load->model('admin/programs_model');
		
		$this->load->model('program_model');
		
		$this->load->model('Category_model');

        $today=getdate();

        $this->th=$today['hours'];

        $this->tm=$today['minutes'];

        $this->tmonth=$today['mon'];
        ob_start();

        // if(!$this->session->userdata('logged_in'))//if not login redirect to home page
        // {
        // 	redirect('');
        // }
	}

	public function index()
	{

       $tmpl = "default";

       //$this->load->model('Program_model');

       $task_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

       $this->template->set("tmpl", $tmpl);

	   $this->template->set_layout('frontend');

	   $this->template->build('tasks/tasks');

	}

	public function uploadwebcamshots()
    {			  
    	$data = $_POST['postData'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);

		$folder = $this->session->userdata("shot_upload_folder_name");
		$capturedate = date("Y-m-d H:i:s");
		$datetime1 = explode(' ',$capturedate);

		$name1 = 'web_'.$datetime1[0].'_'.$datetime1[1];
		$file = FCPATH.'public/uploads/webshotuploads/'.$folder.'/'. $name1 . '.png';
		if(file_put_contents($file, $data))//for upload file to the server
		{
			//executed
		}
    }

    public function uploadScreenShots()
    {			  
    	$data = $_POST['postDataScreen'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);		

		$folder = $this->session->userdata("shot_upload_folder_name");
		$capturedate = date("Y-m-d H:i:s");
		$datetime1 = explode(' ',$capturedate);
		$name1 = 'scr_'.$datetime1[0].'_'.$datetime1[1];
		$file = FCPATH.'public/uploads/webshotuploads/'.$folder.'/'. $name1 . '.png';
		if(file_put_contents($file, $data))//for upload file to the server
		{
			//executed
		}
    }

    public function calculate()
    {
    	echo $data = $_POST['timeSpent']; 
    }    

    /*public function demo_upload()
    {			  
    	$data = $_POST['postData'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);

		$folder = $this->session->userdata("shot_upload_folder_name");
		
		$file = FCPATH.'public/uploads/webshotuploads/'. uniqid() . '.png';
		if(file_put_contents($file, $data))//for upload file to the server
		{
			//executed
		}
    }*/


public function lesson()
{

		$tmpl = "default";
		$uid = '1';
		$this->load->model('Tasks_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');
		$sessionarray = $this->session->userdata('logged_in');	  
		$user_id = $sessionarray['id'];	  	
		// if($user_id=='')
		// {
		// redirect('users/login');
		// }
		$group_id = $sessionarray['groupid'];
		$settings = $this->settings_model->getItems();

		$program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

		$day_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

		$lesson_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

		$this->template->set("lesson_id", $lesson_id);
		
		$programs = $this->program_model->getProgram($program_id);
		$lesson = $this->Tasks_model->getLessonNew2($program_id,$day_id,$lesson_id);

		if (!$program_id || !$day_id || !$lesson_id){

		redirect('category/');

		}

		$days = $this->program_model->getlistDays($program_id);
		// new code in sequential then rediect to prev lect

		$coursetype_details = $this->program_model->getCourseTypeDetails($program_id);
// print_r($coursetype_details);
				$gotoLesson = false;

		$lessonsIsDemo = $this->program_model->getLessonDemo($lesson_id);

		if($lessonsIsDemo){
			// $this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);
			// $this->template->build('lessons/lesson');
			$gotoLesson = true;
		}
		else if($coursetype_details[0]['course_type'] == 1)
		{

			$lecture_ids =array();
					$complated_lecture_ids = array();

					$my_lesson_total = 0;
					$my_viewed_lesson_total = 0;
					$bar_percentage = 0;
					if($days)
					{
						foreach ($days as $day)
						{
							//for total lesson
							//$lessons = $this->program_model->getLessons($day->id);
							$lessons = $this->program_model->getLessonNew($day->id);
							$my_lesson_total += count($lessons);
							
							//for viewed lesson
							foreach ($lessons as $lesson)
							{	if($lesson->id)
								{
								array_push($lecture_ids,$lesson->id);
							    }
								$lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$user_id,$program_id);
								
								if(!empty($lesson_viewed))
								{  
									array_push($complated_lecture_ids,$lesson->id);
									$my_viewed_lesson_total++;
								}								
							}
						}

						
					}


					////
			$lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$user_id,$program_id);

			 end($complated_lecture_ids);      
						   $lec_key1 = key($complated_lecture_ids);
			    		   $lec_key = array_search($lesson_id,$complated_lecture_ids);
			    		   $lec_key2= $lec_key1+1;

			  if(current($lecture_ids)==$lesson_id)
			    		{ 

			    			$gotoLesson = true;
			    		}
			    else{
			    	if($lec_key || $lecture_ids[$lec_key2] ==$lesson_id)
			    			{
			    				if($my_viewed_lesson_total>=1)
			    				 {
			    				 	$gotoLesson = true;
			    				 }
			    				 else{
			    				 	if($lec_key1 == '') $lec_key2 = 0;

			    				 	$dayId = $this->program_model->getDayId($lecture_ids[$lec_key2], $program_id);

			    				 	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please complete previous lecture first!'));

			    				 	redirect('lessons/lesson/'.$program_id.'/'.$dayId.'/'.$lecture_ids[$lec_key2]);
			    				 }
			    			}
				    	else{
				    		if($lec_key1 == '') $lec_key2 = 0;

			    				 	$dayId = $this->program_model->getDayId($lecture_ids[$lec_key2], $program_id);

			    				 	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please complete previous lecture first!'));

			    				 	redirect('lessons/lesson/'.$program_id.'/'.$dayId.'/'.$lecture_ids[$lec_key2]);
				    	}
			    	}



		}
		else if($programs->is_drip_course == 1)
		{
			$date = new DateTime();

			$currdate1 = $date->format( 'Y-m-d' );		
			$currtime1 = $date->format( 'h:i' );		
			$currdateandtime = $date->format( 'Y-m-d h:ia' );	
			$today_formatted = $date->format('Y-m-d H:i');  	

					  	if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == '') )
							{	
								$gotoLesson = true;

							}
							else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)
							{ 
						
							$gotoLesson = true;

						 }
								// && $lesson->release_date <= gmdate('Y-m-d', time())
						else if($programs->release_type == '2')
							{
								$buy_date1 = str_replace('-', '/', $enrolldata->buy_date);
								$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));
								if($lect_date <= $currdate1)
								{		
									
									$gotoLesson = true;
							 	}
								else{	
									$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This lecture not available to access'));
									redirect($coursetype_details[0]['name'].'/lectures/'.$program_id);

								}
							}
							else{	
								$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This lecture not available to access'));
									redirect($coursetype_details[0]['name'].'/lectures/'.$program_id);
							}	
					 
			}
		// else if()
		else{
			
			$gotoLesson = true;
		}


		//end new code
		if($gotoLesson){
		$this->template->set("days", $days);
		$this->template->set("quizcomment", $this->program_model->getLessonQuery($program_id,$user_id));

			
		$this->template->set("programs", $programs);
		
		// $lesson_answers = $this->Tasks_model->getLessonAnswer($wheredata);


		//$this->template->set("lesson_answers", $lesson_answers);

		$lessonsContent = $this->program_model->getLessonContent($lesson_id,$day_id,$program_id);

		$this->template->set("course_id",$program_id);
		$this->template->set("section_id",$day_id);
		$this->template->set("lecture_id",$lesson_id);
		$this->template->set("lessonsContent",$lessonsContent);

		$this->template->set("exercise", $this->program_model->getExercise($program_id));

		$this->template->set("webinars", $this->program_model->getWebinars($program_id));



		$this->template->set("settings", $settings);

		$this->template->set("tmpl", $tmpl);

		$this->template->set("program_id", $program_id);



		$this->template->set("moduleid", $day_id);

		

		$this->template->set("lesson", $this->Tasks_model->getLessonNew2($program_id,$day_id,$lesson_id));
		//$this->template->set("lesson", $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id)); //contain mediarel table
		$this->template->set("lecture_video", $lesson->lecture_video);
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

					$data2 = array(
					'stud_id' => $user_id,
					'course_id'  => $program_id,
					'lecture_id' => $lesson_id,
					'mod_id' => $day_id,
	                'lecture_viewed' =>'1',
					'date_last_visit' => $currdate,
	                
				);

		if($user_id){
		$lec_act_id = $this->Tasks_model->insertLecStatistic($data2,$user_id,$program_id,$lesson_id,$day_id);

				$this->template->set("lec_act_id", $lec_act_id);
			}


		$count = $this->Tasks_model->countViewedLesson($uid,$program_id);

		$access = isAccess($program_id,$day_id,$lesson_id);

				$programdetail = $this->Tasks_model->getLessonsName($program_id);

		$programnavarray = $this->Tasks_model->getCoursenavArray($program_id);
		$this->template->set("programnavarray", $programnavarray);

$idFinalExam = (isset($programdetail[0]['id_final_exam'])) ? $programdetail[0]['id_final_exam'] : '';

		$idcertificate = (isset($programdetail[0]['certificate_term'])) ? $programdetail[0]['certificate_term'] : '';

		if(isset($idFinalExam) and ($idFinalExam != 0) and ($isComplete > 0)){

		$this->template->set("finalexamid", $idFinalExam);

		}

		if(isset($idcertificate) and ($idcertificate != 0) and ($isComplete > 0)){

		$this->template->set("certificateid", $idcertificate);

		}

		if($user_id)
		{
			$wheredata = array(

		'user_id' => $user_id,

		'pro_id' => $program_id,

		'mod_id' => $day_id,

		'lesson_id' => $lesson_id

		);
					$query_details =$this->Tasks_model->getLessonQueriesAsked($wheredata);
		$this->template->set("query_details", $query_details);

		$this->template->set("courses", $this->Myinfo_model->getCourses($user_id,$program_id,''));

		$viewedLesson = $this->Tasks_model->countViewedLesson($user_id,$program_id);

		$quiz_taken = $this->quizzes_model->quizTaken($user_id,$program_id);

		$this->template->set("quiztaken", $quiz_taken);

		$isComplete = 0;

		if(!empty($viewedLesson)){

		$isComplete = ($viewedLesson[0]['completed'] > 0) ? $viewedLesson[0]['completed'] : 0;

		}
		$date_enrolled = $this->Tasks_model->datebuynow($program_id, $user_id);

		$not_show = '';
		if(count($date_enrolled) > 0)
		{
		$not_show = true;
		}
		else
		{
		$not_show = false;
		}
		$this->template->set("user_id", $user_id);
		$this->template->set("date_enrolled", $date_enrolled);

		$this->template->set("programdetail", $programdetail);
		$this->template->set("viewedLesson", $viewedLesson);

		$this->template->set("isComplete", $isComplete);


		//if(($not_show === TRUE) && ($access == true))//commented by yogesh on dated 06-12-2014 , solved issue first for $access
		if(($not_show === TRUE))
		{
			$this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);
			$this->template->build('lessons/lesson');
		}
		else
		{
			$lessonsIsDemo = $this->program_model->getLessonDemo($lesson_id);
			if($lessonsIsDemo){
				// $this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);
				$this->template->build('lessons/lesson');
			}else{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have to Enroll first!<br>By clicking on Buy Now or Enroll now button' ));
               // redirect('course/programs/'.$program_id);
			redirect('online-courses/'.$program_id);
			}
		}
		}else
		{
			$lessonsIsDemo = $this->program_model->getLessonDemo($lesson_id);
		if($lessonsIsDemo){
			// $this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);
			$this->template->build('lessons/lesson');
		}else{
			// $this->template->build('user/login_user');
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please login first!' ));
			 redirect(base_url());
		}
		}
	}

}


/*	public function lesson()
	{
		$tmpl = "default";
		$uid = '1';
		$this->load->model('Tasks_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');

		$sessionarray = $this->session->userdata('logged_in');	  	
		$user_id = $sessionarray['id'];	
		$this->template->set('uname',$sessionarray['first_name'].' '.$sessionarray['last_name']); 
  	
		// if($user_id=='')
		// {
		// redirect('users/login');
		// }

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

		$programs = $this->program_model->getProgram($program_id);
		$this->template->set("programs", $programs);
		
		
		$instuctor = $this->program_model->getinstuctor($programs->created_by);
		
		$this->template->set("instuctor",$instuctor->first_name.' '.$instuctor->last_name);

		$enroll_get = $this->program_model->getEnrolled($user_id,$program_id);
		$this->template->set('enrolldata',$enroll_get);

		$this->template->set("days", $this->program_model->getlistDays($program_id));
		// print_r($this->program_model->getlistDays($program_id)); exit("---");
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
		$lesson = $this->Tasks_model->getLessonNew2($program_id,$day_id,$lesson_id);
		$this->template->set("lesson", $lesson);
		$this->template->set("lecture_video", $lesson->lecture_video);
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
			$datestring = "%Y-%m-%d %h:%i:%s";

		$time = time();

		$currdate = mdate($datestring, $time);

					$data2 = array(
					'stud_id' => $user_id,
					'course_id'  => $program_id,
					'lecture_id' => $lesson_id,
					'mod_id' => $day_id,
	                'lecture_viewed' =>'1',
					'date_last_visit' => $currdate,
	                
				);

		
		$lec_act_id = $this->Tasks_model->insertLecStatistic($data2,$user_id,$program_id,$lesson_id,$day_id);

				$this->template->set("lec_act_id", $lec_act_id);
			
		//if(($not_show === TRUE) && ($access == true))//commented by yogesh on dated 06-12-2014 , solved issue first for $access
		if(($not_show === TRUE) || $lesson->is_demo ==1)
		{
			$this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);
			$this->template->build('lessons/lesson');
		}
		else
		{
			//$this->template->build('user/login_user');
			echo '<div style="margin-top: 25px; font-family: arial; text-align: center; color: #F9966B;">You have to Enroll first !!<br>By clicking on Buy Now or Enroll now button</div>';
		}
		}else
		{
			if($lesson->is_demo ==1)
			{

				// $this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);
				$this->template->build('lessons/lesson');
			}
			else $this->template->build('user/login_user');
		}
	} */

	public function filedownload($fname = null)
	{
		$this->load->helper('download');
		//echo base_url()."public/images/".$_POST['fname'];
		if($fname)
		{
		 $data = file_get_contents(base_url()."public/images/".$fname);
		 if($data)
		 {
			force_download($fname, $data);
		}
		else{
			echo "file not exists!";
		}
	}

		  // if ($fileName) {
    // $file = realpath ( "download" ) . "\\" . $fileName;
    // // check file exists    
    // if (file_exists ( $file )) {
    //  // get file content
    //  $data = file_get_contents ( $file );
    //  //force download
    //  force_download ( $fileName, $data );
    // } else {
    //  // Redirect to base url
    //  redirect ( base_url () );
    // }

	}

	public function ajaxAssignment() 
    {
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
	    $assign_id = $this->input->post('assign_id');
		

	    $getassign_check = $this->program_model->getAssignSub($assign_id,$user_id);
		$assign_checksub = $this->program_model->checkAssignSub($assign_id,$user_id);
	    $assign_check =	count($assign_checksub);
		    $assign_info = $this->program_model->getAssignment($assign_id);
		    $assign_contents = $this->program_model->getAssignContent($assign_id);
		    $assignment =array();
		  
		   
		if($assign_check<='0')
	   	{ // echo json_encode($assign_info);
	   		$assignment = array('status' => '','info' => $assign_info, 'content' =>$assign_contents);
		   echo json_encode($assignment);
		}
		else{
			// $getassign_check = $this->program_model->AssignSubContents($assign_id,$user_id);
			// print_r($getassign_check);
			$assignment = array('status' => 'submitted','info' => $assign_info, 'content' =>$assign_contents, 'stud_content' => $getassign_check, 'date' => $getassign_check[0]['created_date']);
		   echo json_encode($assignment);

		}
	    //$this->template->set("assignInfo", $assign_info);

    	
    }
	
	public function LecActivity()
	{
		$this->load->model('Tasks_model');
		$user_id = $_POST['user_id'];
		$program_id = $_POST['pro_id'];
		$lesson_id = $_POST['lesson_id'];
		$day_id = $_POST['mod_id'];

				$datestring = "%Y-%m-%d %h:%i:%s";

		$time = time();

		$currdate = mdate($datestring, $time);

								$data2 = array(
					'stud_id' => $user_id,
					'course_id'  => $program_id,
					'lecture_id' => $lesson_id,
					'mod_id' => $day_id,
	                'lecture_viewed' =>'1',
					'date_last_visit' => $currdate,
	                
				);

		$lec_act_id = $this->Tasks_model->insertLecStatistic($data2,$user_id,$program_id,$lesson_id,$day_id);
		// print_r($lec_act_id);
		// $lec_id = $lec_act_id->id;
		echo $lec_act_id;
		// echo $lec_act_id['id'];
	}
	
	public function get_user_activity($id){
		if($id)
		{
			$this->load->model('Tasks_model');
			$user_act = $this->Tasks_model->getLecStatistic($id);
			echo json_encode($user_act);
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
						if($lesson->lecture_type == "video")
						{

							$data['content'] = '<div data-vimeo-defer id="made-in-ny"></div>';
							$data['video'] = $lesson->lecture_video;
							// echo '<div data-vimeo-defer id="made-in-ny"></div>';
							// echo '<script>var options = { url: "https://player.vimeo.com/video/'+$lesson->lecture_video+'", width: 649, loop: true };
							// var madeInNy = new Vimeo.Player("made-in-ny", options);';
							// echo '<div id="vimeo_iframe"><iframe src="https://player.vimeo.com/video/'+$lesson->lecture_video+'" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div>';
							

						} else {
							$data['content'] = $lesson->lecture_content;
							$data['video'] = "";
						}
						// print_r($data);
						echo json_encode($data);
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
						$content = "<div id='media_15' >";
						$content += $this->ajaxQuestionsDisplay($media,15,'',$program_id,'', $lesson->layoutid);
						$content += "</div>
						<div>
						<table cellspacing='0' cellpadding='0' align='center' width='100%' style='width: 320px;''>
						<tbody><tr>";
						
										
						if(isset($buttonarr[0]))
						{
						$content += '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[0]->module_id.'/'.$buttonarr[0]->jump_step.'" value="'.$buttonarr[0]->text.'" name="JumpButton"></td>';
						}

							if(isset($buttonarr[1])) {
								$content += '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[1]->module_id.'/'.$buttonarr[1]->jump_step.'" value="'.$buttonarr[1]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[2])) {
								$content += '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[2]->module_id.'/'.$buttonarr[2]->jump_step.'" value="'.$buttonarr[2]->text.'" name="JumpButton"></td>';
							}	

							if(isset($buttonarr[3])) {
								$content += '<td><input type="button" onclick = document.location.href="'.base_url().'lessons/lesson/'.$program_id.'/'.$buttonarr[3]->module_id.'/'.$buttonarr[3]->jump_step.'" value="'.$buttonarr[3]->text.'" name="JumpButton"></td>';
							}		
										
						$content += "</tr>
								</tbody></table>
      	<div>";

      						$data['content'] = $content;
							$data['video'] = "";
							echo json_encode($data);
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

	function startEx()
	{
	// 	$data= "Aa";
 // $output = $this->load->view('exams/start_exam', $data, TRUE);
 // echo $output;
 // echo $data;
 // print_r($output);
		// start_exam('Maths test demo',73,71,'12','1','0');
// print_r($_POST);
 $sessionarray = $this->session->userdata('logged_in');	  	 
		$user_id = $sessionarray['id'];
		$exam_id = $_POST['exam_id'];
		$proid = $_POST['proid'];	
		$indexy = $_POST['indexy'];	
		$qname = $_POST['qname'];
		$layoutid = $_POST['layoutid'];	
		$att_no = $_POST['att_no'];

		$exam = $this->exam_model->getItems($exam_id);
		$examQue = $this->exam_model->getExamQues($exam_id,0,1);

		$data['exam'] = $exam;
// print_r($exam); exit();
		if($examQue)
 		{
			$dataQue['Ques'] = $examQue;
			$ansval = $examQue->correct_ans;
			$arrans = explode('_', $ansval);
			$anscount = count($arrans);
			$dataQue['ans'] = $anscount;
			$dataQue['Qno'] = '1';
			$Qtot = $this->exam_model->get_count_ques($exam_id);
			$dataQue['Qtot'] = $Qtot->Qcount;
				$dataQue['att_no'] = $att_no;
				$dataQue['stud_id'] = $user_id;
				$dataQue['exam_id'] = $exam_id;
				$dataQue['program_id'] = $proid;
	 		$Question = $this->load->view('exams/showQues', $dataQue, TRUE);
 		}
 		
 		$data['Que'] = $Question;

			$currentdate = date("Y-m-d H:i:s");
			$generate = rand(1000,9999);
			$date_gen = date('Y-m-d');
			$exam_attempt_code = $generate.'_'.$date_gen;
			$this->session->unset_userdata('attempt_code');//unset session of attempt code
			$this->session->unset_userdata('subjectivePresent');//unset session for subjective question present or not in exam

			$this->session->set_userdata("attempt_code", $exam_attempt_code);

  $pname = $this->exam_model->getPgname($exam_id);
 $data['pname'] = $pname;

 $cont = $this->exam_model->getpgQues($exam_id,1);
 // $dataSet[3]= $cont;
 $cont2['conts'] = $cont; 
 $Qsrno = $this->exam_model->getSecQuesNo($exam_id,$cont[0]->section_id);
  $cont2['Qsrno'] = $Qsrno;
 		   
 $data['secid'] = $cont[0]->section_id;
 $attempt_no = $this->exam_model->getAttempts($user_id,$exam_id,$proid);
$data['attempt_no'] = $attempt_no+1;
$data['userid'] = $user_id; 
 $data['pro_id'] = $proid; 
 $output = $this->load->view('exams/start_exam', $data, TRUE);
 $dataSet[0] = $output;

 // $cont = $this->exam_model->getpgQues($exam_id,1);
 // // $dataSet[3]= $cont;
 // $cont2['conts'] = $cont; 
   $i=0;
   foreach ($cont as $getsec) {

   	 	$getQue = $this->exam_model->getSecQues($exam_id,$getsec->page_id,$getsec->section_id);
   	 $Ques[$i] = $getQue;
   	 $i++;
   }
   $setQues = json_encode($Ques);
   $cont2['Qdata'] = $setQues;
				$cont2['att_no'] = $att_no;
				$cont2['stud_id'] = $user_id;
				$cont2['exam_id'] = $exam_id;
				$cont2['program_id'] = $proid;
 $notes = $this->load->view('exams/side_note', $cont2, TRUE);



 $dataSet[1] = $notes;

 echo json_encode($dataSet);
  // print_r($dataSet);
  // return $dataSet;
 
 	}
 	function jumpsec($exam_id,$pg_id,$userid,$proid,$att_no)
 	{
 		 $cont = $this->exam_model->getpgQues($exam_id,$pg_id);
 		  $cont2['conts'] = $cont;
 		
 		  $i=0;
 		   $Qsrno = $this->exam_model->getSecQuesNo($exam_id,$cont[0]->section_id);
  $cont2['Qsrno'] = $Qsrno;
 		   foreach ($cont as $getsec) {

 		   	 	$getQue = $this->exam_model->getSecQues($exam_id,$pg_id,$getsec->section_id);
 		   	 $Ques[$i] = $getQue;
 		   	 $i++;
 		   }
		    $setQues = json_encode($Ques);
		    $cont2['Qdata'] = $setQues;
		    $cont2['att_no'] = $att_no;
			$cont2['stud_id'] = $userid;
			$cont2['exam_id'] = $exam_id;
			$cont2['program_id'] = $proid;

 		   $notes = $this->load->view('exams/side_note', $cont2, TRUE);
 			$dataSet[0] = $notes;
 	echo json_encode($dataSet);
 	}

function nextQue()
 	{
//  		$_POST['Q_id'] = 95;
// $_POST['examid'] = 73;
// $_POST['srno'] = 1;
// $_POST['given_ans'] = 1;
// $_POST['Q_type'] = 'regular';

// $_POST['stud_id']=1;
// $_POST['att_no']=1;
 			// $getQdata = $this->exam_model->checkQues(73,95);
 			// echo $getQdata->correct_ans;
 		// $program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
 		$submitedQue = $this->exam_model->getsubmitedQue($_POST['Q_id'],$_POST['att_no'],$_POST['examid'],$_POST['stud_id'],$_POST['pro_id']);


 		if($_POST)
 		{
 			$Qid = $_POST['Q_id'];
 			$exam_id = $_POST['examid'];	
			$srno = $_POST['srno'];
			$program_id =$_POST['pro_id'];
 			$getQdata = $this->exam_model->checkQues($exam_id,$Qid);

 		if($_POST['given_ans'] !=''){
 			$Qcolor = 'green';
 			if($_POST['Q_type'] == 'mcq')
 			{
 				
 				$givenans = explode('_',rtrim($_POST['given_ans'],'_'));
 				$correctans = explode('_', rtrim($getQdata->correct_ans,'_'));
 				$anscount = count($correctans);
 				$per_opt = $getQdata->que_marks/$anscount;
 				$marks = 0;
	 				foreach($givenans as $ans) 
	 				{
	 					if($ans)
	 					{
		 					if(in_array($ans,$correctans))
		 					{
		 						$marks = $marks + $per_opt;					
		 					}
	 				    }
	 				}
 				

 			}
 			else if($_POST['Q_type'] == 'matching')
 			{
 				$marks = 0;
 				if($_POST['Qmove'])
 				{
 				$correctans = explode('_', rtrim($getQdata->correct_ans,'_'));
 				$anscount = count($correctans);
 				$per_opt = $getQdata->que_marks/$anscount;
 				$anstr = '';
 				for ($i=0; $i < $anscount; $i++) { 
 					$anstr = $anstr.$_POST['Mopt'][$i].'_';
 					if($_POST['Mopt'][$i] == $correctans[$i])
 					{
 						$marks = $marks + $per_opt;
 					}
 				}
 				   $_POST['given_ans'] = $anstr;
 				}
 				else{ $_POST['given_ans']= ''; 
 						$Qcolor = 'red';
 						$marks = 0;
 					}
 			}
 			else if($_POST['Q_type'] == 'subjective')
 			{
 				//$_POST['given_ans'] = $_POST['subans'];
 				$marks = 0;
 			}
 			else{
	 			if($_POST['given_ans'] == $getQdata->correct_ans)
	 			{
	 				$marks = $getQdata->que_marks;
	 			}
	 			else
	 			{
	 				$marks = 0;
	 			}
 			}
 		}
 		else{
 			$Qcolor = 'red';
 			$marks = 0;
 		}
 		if($marks > 0){ $is_correct = '1'; } else{ $is_correct = '0'; }
 		$stud_id = $_POST['stud_id'];
 		$att_no =$_POST['att_no'];

 		$data = array('que_id' => $Qid,
 					  'exam_id' => $exam_id,
 					  'stud_id' => $stud_id,
 					  'pro_id' => $program_id,
 					  'correct_ans' => $getQdata->correct_ans,
 					  'stud_given_ans' => $_POST['given_ans'],
 					  'is_correct' => $is_correct,
 					  'attempt_no' => $att_no,
 					  'ans_marks' => $marks);
 		 $insert_data = $this->exam_model->insert_ans($data,$Qid,$stud_id,$exam_id,$program_id,$att_no);

 		}
 		else{
 			$Qcolor = '';      
 		}
 		
		$Qtot = $this->exam_model->get_count_ques($exam_id);
		// echo $srno;

		if($srno < $Qtot->Qcount)
		{
 		$examQue = $this->exam_model->getExamQues($exam_id,$srno,1);

		$dataQue['Qtot'] = $Qtot->Qcount;
		$dataQue['Qno'] = $srno+1;
 		$dataQue['Ques'] = $examQue;
		$ansval = @$examQue->correct_ans;
		$arrans = explode('_', $ansval);
		$anscount = count($arrans);
		$dataQue['ans'] = $anscount;
		$dataQue['att_no'] = $att_no;
		$dataQue['stud_id'] = $stud_id;
		$dataQue['exam_id'] = $exam_id;
		$dataQue['program_id'] = $program_id;


 		if($examQue)
 		{

			// $Qtot = $this->exam_model->get_count_ques($exam_id);
			// $dataQue['Qtot'] = $Qtot->Qcount;
	 		$Question = $this->load->view('exams/showQues', $dataQue, TRUE);
	 		$Que[0] = $Question;
	 		$Que[1] = $examQue->section_id;
	 		$Que[2] = $Qcolor;

	 		$Que[3] = $submitedQue;
	 		 // print_r($Que);
	 		
	 		echo json_encode($Que);
	 	}
	 	}
	 	else{
	 		echo $Qcolor;
	 	}
 		// print_r($examQue);
 	}

 	function deleteAttempt(){
 		$examid = ($_POST['examid']) ? $_POST['examid'] : NULL;	
 	 	$stud_id = ($_POST['stud_id']) ? $_POST['stud_id'] : NULL;	
 	 	$attempt = ($_POST['attempt']) ? $_POST['attempt'] : NULL;	
 	 	$pro_id = ($_POST['pro_id']) ? $_POST['pro_id'] : NULL;
 	 	$del = $this->exam_model->deleteAtt($examid,$stud_id,$pro_id,$attempt);
 	 	if($del)
 	 		echo $del;
 	}

 	function demo_query()
 	{
 		echo "<pre>";
 		print_r($this->exam_model->check_attempt());
 	}

 	function examreport()
 	{
	 		
 		// $examid = '14';	
 	 // 	$stud_id = '3';	
 	 // 	$attempt = '3';	
 	 // 	$pro_id = '182';
 		// print_r($_POST); exit('hh');
 	 	
 		$examid = ($_POST['examid']) ? $_POST['examid'] : NULL;	//$examid;	
 	 	$stud_id = ($_POST['stud_id']) ? $_POST['stud_id'] : NULL;	//$stud_id;	
 	 	$attempt = ($_POST['attempt']) ? $_POST['attempt'] : NULL;	//$attempt;	
 	 	$pro_id = ($_POST['pro_id']) ? $_POST['pro_id'] : NULL;	//$pro_id;

		$obt_marks = $this->exam_model->getmarks($examid,$stud_id,$pro_id,$attempt);
		
		 $exam_detail = $this->exam_model->getexamdetail($examid);
		  // print_r($exam_detail);
		 $str = str_split($obt_marks->obt_marks,3);
		  $data['examinfo'] = $exam_detail;
		$data['obt_marks'] = $str[0];
		$data['user_id'] = $stud_id;
		$data['msg'] = "Thank you for attend the quiz.";
		$data['attempt'] = $attempt;
		$data['stud_id'] = $stud_id;
		$data['program_id'] = $pro_id;

		// echo $obt_marks->obt_marks;
 	 	// print_r($obt_marks);
		$pr = floatval($str[0]*100)/$exam_detail->total_marks;
		$Percentage = round($pr).'%';
		$countsub = $this->exam_model->chkSubjectiveQues($examid);
		if($countsub > 0){
			$status = "Panding";
			$data['show_result'] = '0';
		}
		else{
			if($pr >= $exam_detail->passing_score)
			{
				$status = $exam_detail->pass_feedback; //"Pass";
			} 
			else{
				$status = $exam_detail->fail_feedback; //"Fail";
			}
			$data['show_result'] = '1';
			// $sessionarray = $this->session->userdata('logged_in');	 
			// if($sessionarray){
			// $urldomain = base_url();
			// 		$urldomain = str_replace('http://', '', $urldomain);
			// 		$urldomain = str_replace('/', '', $urldomain);
			// 		$urldomain = str_replace('www.', '', $urldomain);

			// 		// $this->load->model('admin/settings_model');
			// 		$configarr = $this->settings_model->getItems();
			// 		//$subject1 = "Congratulations ".trim(ucfirst($sessionarray['first_name']))."! You Have Successfully Passed '".$_POST['end_exam']."'";
			// 		$subject1 = "Completion of exam assessment";
			// 		$toemail1 = 'jyotisorte4@gmail.com'; 
			// 		$content = '';	
							
			// 		$content .= '<p>Dear '.trim(ucfirst($sessionarray['first_name'])).',<br /><br />';
			// 		$content .= '<p style="font-size: 17px; font-weight: bold;">Congratulations..</p><br>';	
			// 		$content .= "You have successfully attended the assessment exam in '".$configarr[0]['institute_name']."'<br /><br />";	
			// 		$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">You are eligible for the next course which link is mention below</p>';	
			// 		$content .= '<a></a>'
			// 		$content .= "You can view the results in the 'Learning Zone' of the <a style='color: #55c5eb;' href=".base_url().">".base_url()."</a>.<br /><br />";
			// 		$content .=' If you need help or have any questions, please contact us.<br />';
			// 		// $content .=' <br /><br />';
			// 		// $content .='...';
			// 		// $content .= $configarr[0]['signature'].'</p>';
										
			// 		$data['content'] = $content;
			// 		$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
			// 		$fromemail1= 'noreply@'.$urldomain;        //$configarr[0]['fromemail'];// admin mail
			// 		$config['charset'] = 'utf-8';
			// 		$config['mailtype'] = 'html';
			// 		$config['wordwrap'] = TRUE;
			// 		$this->email->initialize($config);
			// 		$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
			// 		$this->email->subject($subject1);
			// 		$this->email->to($toemail1);
			// 		$this->email->message($message1);
			// 		$this->email->send();	
			// 	}
		}  
		$post = array('stud_id' => $stud_id,
		'exam_id' => $examid,
		'pro_id' => $pro_id,
		'attempt_no' => $attempt,
		'obtain_marks' => $str[0],
		'tot_marks' => $exam_detail->total_marks,
		'percentage' => $Percentage,
		'status' => $status,
		'attempt_date' => date('Y-m-d h:i:sa'),
	);
		$data['optmark'] = $obt_marks;
		$data['status'] = $status;
		$data['pr'] = $pr;
		$insert = $this->exam_model->insertReport($post);
		if($insert){
 		$output = $this->load->view('exams/examReport',$data , TRUE);
 		echo $output;
 		}
 	}

	function startexam()//new question set, ajax test given for single 
	{
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
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">        
						<p style="margin-top: 0; text-align:left; float: left;">Exam Name : <span style="color:#fff"><?php echo $qname;?></span></p>
						<p style="margin-bottom: 0px; text-align:right;">Exam time remaining: <span style=' color: black;font-weight:bold;' id="countdown" class="timer"></span>
						</p>
						</div>  
					</div>	
					<div class="panel-body form-horizontal form-groups-bordered">				
				<?php
			}					
			//insert score
			//date_default_timezone_set("Asia/Kolkata");
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

			$dataIns = array(
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
			}
		}
	?>	

			
		<div id='my_middle_content_question'>
		<table width="100%" class="table1" style="font-size: 16px;">
		<tbody>		
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
						
						<input type='hidden' name='txtTotalSpent' id='txtTotalSpent' value='0'>
						<input type='hidden' name='txtTotalLeave' id='txtTotalLeave' value='0'>

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
								<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
								  <script>
								   tinymce.init({ 
								plugins: [
								"eqneditor advlist autolink lists link image charmap print preview anchor",
								"searchreplace visualblocks code fullscreen",
								"insertdatetime media table contextmenu paste" ],
								toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
								selector : "#txtSubjective",
								 init_instance_callback: function (editor) {
								    editor.on('blur', function (e) {
								    	 updateSubjective(e,'<?php echo $myopt->question_id?>')
								      console.log(e);
								    });
								  }
								});
								</script> 
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
						if($myquest->question_type == 'subjective')
						{
						?>
						<tr><td colspan='2'><input type='button' value='Finish Exam' name='btnName' id='btnName' class="btn btn-sm btn-success btn-update" onclick="updateSubjectivesec('<?php echo $myopt->question_id?>'),clearInterval(countdownTimer), endquiz('<?php echo $qname;?>',<?php echo $media_id;?>,<?php echo $proid;?>,'<?php echo $layoutid;?>',<?php echo $indexy+1;?>,'<?php echo $myquest->question_type;?>');">
						<?php
					     }
					     else
					     {
						?>
						<tr><td colspan='2'><input type='button' value='Finish Exam' name='btnName' id='btnName' class="btn btn-sm btn-success btn-update" onclick="clearInterval(countdownTimer), endquiz('<?php echo $qname;?>',<?php echo $media_id;?>,<?php echo $proid;?>,'<?php echo $layoutid;?>',<?php echo $indexy+1;?>,'<?php echo $myquest->question_type;?>');">
						<?php
						}
					}
					else
					{
						if($myquest->question_type == 'subjective')
						{
						?>
						<tr><td colspan='2'><input type='button' value='Next Question' name='btnName' id='btnName' class="btn btn-sm btn-success btn-update" onclick="updateSubjectivesec('<?php echo $myopt->question_id?>'),nextQuestion('<?php echo $qname;?>',<?php echo $media_id;?>,<?php echo $proid;?>,'<?php echo $layoutid;?>',<?php echo $indexy+1;?>,'<?php echo $myquest->question_type;?>');">
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
		}
	}//if
	else
	{

	}
	?>
		</tbody>
		</table>
		</div></div></div>
		<?php		
	}

	function savequestionAns()
	{		
		$totalMarksOutOf=0;
		$totalMarksObtained=0;
		$mediaid = $_POST['media_id'];
		$proid = $_POST['proid'];
		$saveans = $_POST['saveAns'];
		$qtype = $_POST['qtype'];
		$totalTime = $_POST['totalTime'];
		$timeOutOfWindow = $_POST['timeOutOfWindow'];
		$question_id = @$_POST['question_id'];

		$sessionarray = $this->session->userdata('logged_in');	  	 
		$user_id = $sessionarray['id'];	
	
		$this->lessons_model->savequestAns($mediaid, $proid, $saveans, $qtype, $question_id, $totalTime, $timeOutOfWindow);

		//if end of exam then generate certificate
		if(isset($_POST['end_exam']))
		{		
				$showresult = $this->lessons_model->getFinalExamResult($proid);				

			if($this->session->userdata('subjectivePresent') == 'yes')
			{	
			$this->load->model('admin/programs_model');
							$coursename=$this->programs_model->getCoursename5($proid);							

						$urlCourse = strtolower($coursename->name);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);			

				?>
				<table>
					<tbody>
					<tr><th colspan='2'>Exam Name :- <span style="color:#42943F"><?php echo $_POST['end_exam'];?></span></th></tr>
					<tr><th colspan='2'><span style="color:#42943F">Exam Ends</span></th></tr>
					<tr><th colspan='2'><span style="color:#42943F">Thank you for giving exam. After valuation result will be displayed and you will get notification.</span></th></tr>
					<tr><th><a  href="<?php echo base_url(); ?><?php echo $urlCourse; ?>/lectures/<?php echo $proid; ?>" class="btn btn-success">Back to Course</a></th></tr>
					</tbody>
				</table>
				<?php
				//$enddate = date("Y-m-d H:i:s");
				date_default_timezone_set("Asia/Kolkata");
				$enddate = date("Y-m-d H:i:s");
				$dataIns = array(
							'score_quiz' => '',
							'result' => 'Pending',
							'exam_end_time' => $enddate
						);
				$this->lessons_model->updateScoreMarks($user_id, $proid, $mediaid,$dataIns);
			}
			else
			{
				//for out of
				$quizzes_ids = $this->lessons_model->getQuestionIds($mediaid);
			
				foreach($quizzes_ids as $ids)
				{
					$idd = explode(',', $ids->quizzes_ids);
					foreach($idd as $key=>$my_quiz)
					{

						$data_right = $this->lessons_model->getQuizRightAnswers($my_quiz);
												
						foreach($data_right as $rights)
						{
							//for right answer							
							if($rights->question_type == 'match_the_pair')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'true_false')
							{							
								//if($rights->is_correct_answer == 'True')
								//{
									 $totalMarksOutOf+= $rights->points;
								//}
							}
							else if($rights->question_type == 'multiple_type')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'subjective')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else // if($rights->is_correct_answer == 1)
							{
								$totalMarksOutOf+= $rights->points;
							}

							//for given answer
							$dataGiven = $this->lessons_model->getQuizGivenAnswers($proid, $mediaid, $rights->question_id);	
		
							foreach($dataGiven as $givenans)
							{
							    // && $rights->is_correct_answer == $givenans->answers_gived
								if($rights->question_type == 'match_the_pair')
								{
									//echo $rights->option_id.'^'.$givenans->matching_pair.'^'.$rights->is_correct_answer.'^'.$givenans->answers_gived;
									if($rights->option_id == $givenans->matching_pair && $rights->is_correct_answer == $givenans->answers_gived)
									{
										$totalMarksObtained+= $rights->points;
									}
								}
								else if($rights->question_type == 'multiple_type')
								{
									if($rights->option_id == $givenans->matching_pair && $rights->is_correct_answer == $givenans->answers_gived && $givenans->question_id == $rights->question_id)
									{
										$totalMarksObtained+= $rights->points;
										//echo $rights->points;
									}
								}
								else if($rights->question_type == 'true_false') 
								{
									if($rights->is_correct_answer == $givenans->answers_gived && $givenans->question_id == $rights->question_id)
									{
										$totalMarksObtained+= $rights->points;
										//echo $rights->points;
									}
								}
								else
								{
									if($givenans->question_id == $rights->question_id && $rights->option_id == $givenans->answers_gived)
									{
										$totalMarksObtained+= $rights->points;
									}
								}
							}					
						}
					}							
					$myScore = $totalMarksObtained.'|'.$totalMarksOutOf;
				}
				?>
				<div class="panel panel-primary" data-collapsed="0"> 
					<?php 
					if($showresult->show_result == 1 && $showresult->id_final_exam == $mediaid)        //New condition for show result
					{
					}
					else
					{
						?>
						<div class="panel-heading">
			               <div class="panel-title" style="padding-bottom: 0px;">        
	                       <p style="margin-top: 0; text-align:left; float: left;">Exam Name : <span style="color:#fff"><?php echo $_POST['end_exam'];?></span></p>
	                                      
	                       <p style="margin-bottom: 0px; text-align:right;">Exam End
	                       </p>
			               </div>  
				       </div>

				        <div class="panel-body form-horizontal form-groups-bordered"> 
				            
				            <div class="form-group">
				            	<div class="col-sm-12">
				            	 	<span style="color:#42943F"><?php echo 'Total Marks :- '.$totalMarksOutOf;?></span>				                       
				            	</div> 
				            </div>

				            <div class="form-group">
				            	<div class="col-sm-12"> 		
				            		<span style="color:#42943F"><?php echo 'Total Marks Obtained :- '.$totalMarksObtained;?></span>		                       
				            	</div> 
				            </div>   			
						<?php 
					}

				$maxmarks = $this->lessons_model->getMaxmarksExam($mediaid);
				$total_per = $totalMarksObtained / $totalMarksOutOf *100;
				$total_per = round(@$total_per,2);
				$maxmarks = round(@$maxmarks->max_score,2);
				if(@$total_per >= @$maxmarks)
				{	
					if($showresult->show_result == 1 && $showresult->id_final_exam == $mediaid)          //New condition for show result
					{
						$myresult = 'Pending';
					}
				else
				  {				 	
					$myresult = 'Pass';
					
					// $urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
					if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

					$this->load->model('admin/settings_model');
					$configarr = $this->settings_model->getItems();
					//$subject1 = "Congratulations ".trim(ucfirst($sessionarray['first_name']))."! You Have Successfully Passed '".$_POST['end_exam']."'";
					$subject1 = "You have successfully passed the exam";
					$toemail1 = $sessionarray['email']; 
					$content = '';	
					$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">You have successfully passed the exam</p>';			
					$content .= '<p>Dear '.trim(ucfirst($sessionarray['first_name'])).',<br /><br />';
					$content .= "You have successfully passed the '$_POST[end_exam]' exam  in '".$configarr[0]['institute_name']."'<br /><br />";	
				
					$content .= "You can view the results in the 'Learning Zone' of the <a style='color: #55c5eb;' href=".base_url().">".base_url()."</a>.<br /><br />";
					$content .=' If you need help or have any questions, please contact us.<br />';
					// $content .=' <br /><br />';
					// $content .='...';
					// $content .= $configarr[0]['signature'].'</p>';
										
					$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
					$message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
					$fromemail1= $urldomain;        //$configarr[0]['fromemail'];// admin mail
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail1, $configarr[0]['fromname']);// admin mail);
					$this->email->subject($subject1);
					$this->email->to($toemail1);
					$this->email->message($message1);
					$this->email->send();			    
				 }

				}else
				{	
					if($showresult->show_result == 1 && $showresult->id_final_exam == $mediaid)          //New condition for show result
					{
						$myresult = 'Pending';	
					
				    }
				    else
				    {
				       $myresult = 'Fail';
				    }
				}
				?>
					<?php 
					if($showresult->show_result == 1 && $showresult->id_final_exam == $mediaid)        //New condition for show result
					{
						$this->load->model('admin/programs_model');
							$coursename=$this->programs_model->getCoursename5($proid);							

						$urlCourse = strtolower($coursename->name);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
					 ?>
					 <div class="panel-heading">
			               <div class="panel-title" style="padding-bottom: 0px;">        
	                       <p style="margin-top: 0; text-align:left; float: left;">Exam Name : <span style="color:#42943F"><?php echo $_POST['end_exam'];?></span></p>
	                                      
	                       <p style="margin-bottom: 0px; text-align:right;">Exam End
	                       </p>
			               </div>  
				       </div>

				        <div class="panel-body form-horizontal form-groups-bordered"> 
				            
				            <div class="form-group">
				            	<div class="col-sm-12">
				            	 	<span style="color:#42943F">Exam completed successfully...result is pending</span>				                       
				            	</div> 
				            </div>

				            <div class="form-group">
				            	<div class="col-sm-12">
				            	 	<a  href="<?php echo base_url(); ?><?php echo $urlCourse; ?>/lectures/<?php echo $proid; ?>" class="btn btn-success">Back to Course</a>				                       
				            	</div> 
				            </div>													
					<?php 
					}
					else
					{
						$this->load->model('admin/programs_model');
							$coursename=$this->programs_model->getCoursename5($proid);							

						$urlCourse = strtolower($coursename->name);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
					?>

					<div class="form-group">
		            	<div class="col-sm-12"> 		
		            		<span style="color:#42943F"><?php echo 'Total Percentage :- '.$total_per;?></span>	                       
		            	</div> 
		            </div>  

		            <div class="form-group">
		            	<div class="col-sm-12"> 		
		            		<span style="color:#42943F"><?php echo 'Exam Result :- '.$myresult;?></span>
		            	</div> 
		            </div>  

		            <div class="form-group">
		            	<div class="col-sm-12"> 		
		            		<a  href="<?php echo base_url(); ?><?php echo $urlCourse; ?>/lectures/<?php echo $proid; ?>" class="btn btn-success">Back to Course</a>
		            	</div> 
		            </div>  
		            
					<?php 
					}
					?>   
				</div>
				<?php

				$enddate = date("Y-m-d H:i:s");
				$dataIns = array(
							'score_quiz' => $myScore,
							'result' => $myresult,
							'exam_end_time' => $enddate
						);

				$this->lessons_model->updateScoreMarks($user_id, $proid, $mediaid,$dataIns);
			}
		}
	}

	function viewlessonUpdate()
	{
		$this->load->model('Tasks_model');
		$pro_id = $_POST['proid'];
		$sessionarray = $this->session->userdata('logged_in');	  	 
		$user_id = $sessionarray['id'];
		$datestring = "%Y-%m-%d %h:%i:%s";
	    $time = time();
		$currdate = mdate($datestring, $time);

		$this->Tasks_model->saveLessonViewed($user_id,$lesson_id = NULL,$mod_id = NULL,$pro_id,$currdate);
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

	function quiztimeout()
	{		
		echo "<table>
		<tbody>
		<tr><th colspan='2'><span style='color:#42943F'>Exam Time Out</span></th></tr>
		</tbody>
		</table>";	
	}
	
	function getnexturl()	
	{
		print_r($this->session->userdata('myLessonArray'));
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
		
	 
		
		 $db_media = $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id);
	   
	  $db_mediatext = $this->Tasks_model->getMedia_oflayout('scr_t',$lesson_id);
	   
       $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);
	   
	   $lesson = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);
	   
	   //$coursetype_details = $this->Tasks_model->getCourseTypeDetails ($program_id);
	   
	   $sequential = false;

	   
	   $isfinalview = false;
	   
	   if($isfinalview == false){
	  
	   
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
			}else{ 
			$prevurl = ($prevLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$prevLval."/" : NULL;// Lurl($program_id, $day_id, $prevLval);
			
			}

		}else{

		$prevMval = ($M_currkey >= 0) ? $programnavarray[$M_currkey] : NULL;
		$programnavarray['lessons'.$M_currkey][0];
		$prevurl = ($prevMval != NULL) ? base_url()."lessons/module/".$program_id."/".$prevMval."/" : NULL; // Murl($program_id, $prevMval)
		}

		if($nextLval != NULL ){
		  
			if($sequential == true){
			$nexturl = (lessondate($programnavarray, $nextLval, $diff_start)=='open') ? ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$moduleid."/".$nextLval."/" : NULL : NULL; //Lurl($program_id, $moduleid, $nextLval)
			
			}else{ 
			$nexturl = ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$nextLval."/" : NULL ;//Lurl($program_id, $day_id, $nextLval);
			
			}
		}else{

		 $nextMval = ($M_nextkey <= $M_lastkey) ? $programnavarray[$M_nextkey] : NULL;

			if($sequential == true){ 
			$nexturl = (lessondate($programnavarray, $L_nextMod, $diff_start)=='open') ? ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL : NULL; //Murl($program_id, $nextMval)
			}else{  
			 
			 $nexturl = ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL ;//Murl($program_id, $nextMval);
			
			}
		}



		$modcount = count($programnavarray)/2;
		$modcurr = array_search($day_id, $programnavarray)+1;
		$lescount = count($programnavarray['lessons'.$M_currkey]);
		$lescurr = $L_currkey+1;

		}else{
		$nexturl = NULL;
		$prevurl = NULL;
		}
 
     
     
		 $purl = explode('/',@$prevurl);
		 $premodule_id = @$purl[7];
		 $preless_id = @$purl[8];
			
		  
		$nurl = explode('/',@$nexturl);
		
		$nextmodule_id = @$nurl[7];
		$nextless_id = @$nurl[8];
		$count1 = '';
		// echo "<a class='autoplay on' data-name='lectureAutoStart'> Auto Play <span class='autoplay-text-on'>ON</span> <span class='autoplay-text-off none'>OFF</span> </a> <span class='next-lecture' id='next-lecture' style='left: 132px;cursor:pointer'  onclick='nextslide($program_id,$nextmodule_id,$nextless_id)' >NEXT LECTURE</span>";
		echo "<a class='autoplay on' data-name='lectureAutoStart'> Auto Play <span class='autoplay-text-on'>ON</span> <span class='autoplay-text-off none'>OFF</span> </a> <span class='btn chk_mrk_btn' id='next-lecture' style='margin-right: 15px;left: 132px;cursor:pointer'  onclick='nextslide($program_id,$nextmodule_id,$nextless_id,$counter1,$lesson->layoutid,$cont_id)' >Next Lecture</span>";
		
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$pid = $this->uri->segment(3);
       	$lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $pid);
		
			if(!empty($lesson_viewed2))
			{
				foreach($lesson_viewed2 as $compltData)
				{					
					$marks = '|'.$lesson_id.'|';
				 	if(strpos($compltData->mark_as_completed, $marks) !== false)
				 	{
				 		//$lessonData = str_replace($marks,'',$compltData->mark_as_completed);//if found then replace to blank
				 		echo "<div id='mark_as_complete'><a href='#' style='background:#17aa1c' onclick ='markCompleted();' class='mark mini-tooltip'>
							<span class='tooltip-content'>
								<b>Mark as Incomplete</b>
							</span>
						</a></div>";
				 	}
				 	else
				 	{
						echo "<div id='mark_as_complete'><a href='#' onclick ='markCompleted();' class='mark mini-tooltip'>
							<span class='tooltip-content'>
								<b>Mark as Completed</b>
							</span>
						</a></div>";
				 	}
				}				
			}
			else
			{
				echo "<div id='mark_as_complete'><a href='#' onclick ='markCompleted();' class='mark mini-tooltip'>
							<span class='tooltip-content'>
								<b>Mark as Completed</b>
							</span>
						</a></div>";
			}
	    return true;
	}

	function my_getnexturl()
	{
		$tmpl = "default";
		$this->load->model('Tasks_model');
		$this->load->model('program_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');
		$sessionarray = $this->session->userdata('logged_in');	  	 
		$user_id = $sessionarray['id'];	  	
		$group_id = $sessionarray['groupid'];

		$array_my = array();
		$program_id = $_POST['pro_id'];
		$srno = $_POST['srno'];
		$counter = 0;

	    $dayss = $this->program_model->getlistDays($program_id);
	    foreach($dayss as $day)
	    {
			 //$lessons = $this->program_model->getLessons($day->id); 
	    	$lessons = $this->program_model->getLessonNew($day->id);
			 foreach($lessons as $lesson)
			 {
			 	// $array_my[] = $program_id.'^'.$day->id.'^'.$lesson->id.'^'.$counter;
			 	
			 	if($lesson->layoutid == '22'){	$cont_id = $lesson->is_webinar; }
			 	else if($lesson->layoutid == '2'){ $cont_id = $lesson->is_assignment; } 
			 	else { $cont_id = ''; }
			 	$array_my[] = $program_id.'^'.$day->id.'^'.$lesson->id.'^'.$counter.'^'.$lesson->layoutid.'^'.$cont_id;
			 	
			 	$counter++;
			 }
	    }
	    $nextLink = $srno+1;//pus for next lecture
	    if(!empty($array_my[$nextLink]))
	    {
	    	$data = str_replace('^', ',', $array_my[$nextLink]);
	    	echo "<span class='btn chk_mrk_btn' id='next-lecture' style='margin-right: 15px;left: 132px;cursor:pointer' onclick=nextslide($data)>NEXT LECTURE</span>";
	    }
	    else
	    {
	    	//echo "<span class='next-lecture' id='next-lecture' style='left: 132px;'>NEXT LECTURE</span>";	
	    }
	    return true;
	}
	
	function my_getpreurl()
	{
		$tmpl = "default";
		$this->load->model('Tasks_model');
		$this->load->model('program_model');
		$this->load->model('admin/quizzes_model');
		$this->load->model('admin/settings_model');
		$sessionarray = $this->session->userdata('logged_in');	  	 
		$user_id = $sessionarray['id'];	  	
		$group_id = $sessionarray['groupid'];

		$array_my = array();
		$program_id = $_POST['pro_id'];
		$srno = $_POST['srno'];
		$counter = 0;
	   
	    $dayss = $this->program_model->getlistDays($program_id);
	    foreach($dayss as $day)
	    {
			 //$lessons = $this->program_model->getLessons($day->id);
	    	$lessons = $this->program_model->getLessonNew($day->id);
			 foreach($lessons as $lesson)
			 {
			 	$array_my[] = $program_id.'^'.$day->id.'^'.$lesson->id.'^'.$counter;
			 	$counter++;
			 }
	    }
	    $prevLink = $srno-1;//minus for previous lecture
	    if(!empty($array_my[$prevLink]))
	    {
	    	$data = str_replace('^', ',', $array_my[$prevLink]);
	    	echo "<a href='javascript:void(0)' onclick='nextslide($data)' ><i class='icon-chevron-up'></i></a><span style='cursor:pointer' onclick='nextslide($data)'>Previous Lecture</span>";	    
	    }
	    else
	    {
	    	//echo "<a href='javascript:void(0)'><i class='icon-chevron-up'></i></a><span style='cursor:pointer'>Previous Lecture</span>";	
	    }
	    return true;
	}

	
	function getpreurl()	
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
		
	 
		
		 $db_media = $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id);
	   
	  $db_mediatext = $this->Tasks_model->getMedia_oflayout('scr_t',$lesson_id);
	   
       $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);
	   
	   $lesson = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);
	   
	   //$coursetype_details = $this->Tasks_model->getCourseTypeDetails ($program_id);
	   
	   $sequential = false;

	   
	   $isfinalview = false;
	   
	   if($isfinalview == false){
	  
	   
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
			}else{ 
			$prevurl = ($prevLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$prevLval."/" : NULL;// Lurl($program_id, $day_id, $prevLval);
			
			}

		}else{

		$prevMval = ($M_currkey >= 0) ? $programnavarray[$M_currkey] : NULL;
		$programnavarray['lessons'.$M_currkey][0];
		$prevurl = ($prevMval != NULL) ? base_url()."lessons/module/".$program_id."/".$prevMval."/" : NULL; // Murl($program_id, $prevMval)
		}

		if($nextLval != NULL ){
		  
			if($sequential == true){
			$nexturl = (lessondate($programnavarray, $nextLval, $diff_start)=='open') ? ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$moduleid."/".$nextLval."/" : NULL : NULL; //Lurl($program_id, $moduleid, $nextLval)
			
			}else{ 
			$nexturl = ($nextLval != NULL) ? base_url()."lessons/lesson/".$program_id."/".$day_id."/".$nextLval."/" : NULL ;//Lurl($program_id, $day_id, $nextLval);
			
			}
		}else{

		 $nextMval = ($M_nextkey <= $M_lastkey) ? $programnavarray[$M_nextkey] : NULL;

			if($sequential == true){ 
			$nexturl = (lessondate($programnavarray, $L_nextMod, $diff_start)=='open') ? ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL : NULL; //Murl($program_id, $nextMval)
			}else{  
			 
			 $nexturl = ($nextMval != NULL) ? base_url()."lessons/module/".$program_id."/".$nextMval."/" : NULL ;//Murl($program_id, $nextMval);
			
			}
		}



		$modcount = count($programnavarray)/2;
		$modcurr = array_search($day_id, $programnavarray)+1;
		$lescount = count($programnavarray['lessons'.$M_currkey]);
		$lescurr = $L_currkey+1;

		}else{
		$nexturl = NULL;
		$prevurl = NULL;
		}
 
     
     
		 $purl = explode('/',@$prevurl);
		 $premodule_id = @$purl[7];
		 $preless_id = @$purl[8];
			
		  
		$nurl = explode('/',@$nexturl);
		
		$nextmodule_id = @$nurl[7];
		$nextless_id = @$nurl[8];
		
		echo "<a href='javascript:void(0)'><i class='icon-chevron-up'></i></a><span style='cursor:pointer' onclick='nextslide($program_id,$premodule_id,$preless_id)'>Previous Lecture</span>";
	    return true;
	}
	
	
	function lessondate($programnavarray,$lessid,$diff_start){
(int) $daysval = count($programnavarray)/2;
	//$daysval;
	$newarray = array();
	for($ip=0;$ip<$daysval;$ip++){
		if(!empty($programnavarray['lessons'.$ip]))
		{
		$il=0;
		foreach($programnavarray['lessons'.$ip] as $less){
			//$newarray[] = $less;
			if((intval($less) == intval($lessid)) && ($diff_start > 0) ){
			return 'open';
			}
			$diff_start--;
			}
		}
	}
}
	
	function Lurl($program_id,$moduleid,$lid){
return ($lid != NULL) ? base_url()."lessons/lesson/".$program_id."/".$moduleid."/".$lid."/" : NULL;
}
function Murl($program_id,$mid){ 
return ($mid != NULL) ? base_url()."lessons/module/".$program_id."/".$mid."/" : NULL;
}



	public function SaveAndGetQueryList()

	{

   //	  print_r($_POST);exit;

	$this->load->helper('form');

	$this->load->model('Tasks_model');

	$sessionarray = $this->session->userdata('logged_in');

	$user_id = $sessionarray['id'];

	$group_id = $sessionarray['groupid'];

	

	$datestring = "%Y-%m-%d %h:%i:%s";

	$time = time();

	$currdate = mdate($datestring, $time);

	

	$query_title = $this->input->post('query_title');

	$query_text = $this->input->post('query_text');

	$pro_id = $this->input->post('qpid');

	$mod_id = $this->input->post('qmid');

	$lesson_id = $this->input->post('qlid');

	if(isset($query_title) && isset($pro_id) && isset($lesson_id)){

	 $data = array(

		'query_title' => $query_title,

		'query_text' => $query_text,

		'user_id' => $user_id,

		'pro_id' => $pro_id,

		'mod_id' => $mod_id,

		'lesson_id' => $lesson_id,

		'dateandtime' => $currdate

		);

	$query_id = $this->Tasks_model->saveLessonQueryAsk($data);
	
	
	 $this->load->model('Category_model');	  
	 
	  $Program_name = $this->settings_model->getCourseName($pro_id);
	  $author = $this->settings_model->getTeacherId($pro_id);
	  $name = $this->settings_model->getName($user_id);
	
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

		//'user_id' => $user_id,

		'pro_id' => $pro_id,

		'mod_id' => $mod_id,

		'lesson_id' => $lesson_id

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

			"user" => $this->userinfo_array($querydetail["user_id"]),

			"num_answers" => "",

			"chapter_index" => "",

			"lecture_index" => "",

			"created" =>$querydetail["dateandtime"],

			"is_created_by_instructor" => "",

			"created_relative" => "",

			"is_requester_the_owner" => "",

			"is_following" => "");



		}

		echo json_encode($querydata);



	}

    public function GetQueryList()

	{

	$this->load->model('Tasks_model');

    $sessionarray = $this->session->userdata('logged_in');

    $user_id = $sessionarray['id'];

	$group_id = $sessionarray['groupid'];

	$pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;

	$mod_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : 0;

	$lesson_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : 0;

	$wheredata = array(

		//'user_id' => $user_id,

		'pro_id' => $pro_id,

		'mod_id' => $mod_id,

		'lesson_id' => $lesson_id

		);

		$query_details =$this->Tasks_model->getLessonQueriesAsked($wheredata);

		$querydata = array();

		foreach($query_details as $querydetail){

		

		$num_answers = $this->Tasks_model->getLessonAnswersCount($querydetail["query_id"]);

		$querydata[] = array("__class" => "question",

			"id" => $querydetail["query_id"],

			"title" => $querydetail["query_title"],

			"body" =>$querydetail["pro_id"],

			"course_id" =>$querydetail["mod_id"],

			"lecture_id" =>$querydetail["lesson_id"],

			"user" => $this->userinfo_array($querydetail["user_id"]),

			"num_answers" => $num_answers,

			"chapter_index" => "",

			"lecture_index" => "",

			"created" =>$querydetail["dateandtime"],

			"is_created_by_instructor" => "",

			"created_relative" => "",

			"is_requester_the_owner" => "",

			"is_following" => "");



		}

		echo json_encode($querydata);

    }

   	public function saveanswer()

	{

   // print_r($_POST); exit;

	$this->load->helper('form');

	$this->load->model('Tasks_model');

	$sessionarray = $this->session->userdata('logged_in');

	$user_id = $sessionarray['id'];

	$group_id = $sessionarray['groupid'];



	$datestring = "%Y-%m-%d %h:%i:%s";

	$time = time();

	$currdate = mdate($datestring, $time);



    $answer = $this->input->post('anstext');

  	$query_id = $this->input->post('queryid');

   //	$query_id = $this->input->post('query_id');

	$pro_id = $this->input->post('qpid');

	$mod_id = $this->input->post('qmid');

	$lesson_id = $this->input->post('qlid');

    if(isset($answer)){

    	 $data = array(

    		'answer' => $answer,

    		'query_id' => $query_id,

    		'pid' => $pro_id,

    		'mod_id' => $mod_id,

    		'lesson_id' => $lesson_id,

    		'user_id' => $user_id,

    		'dateandtime' => $currdate

    		);  
        
	

     	  $ans_id = $this->Tasks_model->saveLessonAnswer($data);
		  
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

        $this->Category_model->insertActivity($data_activity);

          if($ans_id){

           // $getdata_ans = array('query_id'=>$query_id);

             $ans_id;
			

            //echo $query_id;



          }else{

            echo "error";

          }

      }



	}

   public function GetAnswer()

	{

    $datestring = "%Y-%m-%d %h:%i:%s";

	$time = time();

	$currdate = mdate($datestring, $time);

       	$this->load->helper('form');

	$this->load->model('Tasks_model');

	$sessionarray = $this->session->userdata('logged_in');

	$user_id = $sessionarray['id'];

	$group_id = $sessionarray['groupid'];

       $query_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $query_id;

       //$request = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '';

       $ans_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '';



       $lesson_queries = $this->lessons_model->getLessonQueries($query_id);

       $quser_id = $lesson_queries->user_id;



       $lesson_answers = $this->lessons_model->getLessonAnswer($query_id,$ans_id);

       //print_r($lesson_answers); exit;

       $userinfo_array = $this->userinfo_array($quser_id);

       if($userinfo_array['designation'] == "Trainer"){

          $isCreatedByInstructor = true;

       }else{

          $isCreatedByInstructor = false;

       }

       if($user_id == $quser_id){

           $isRequesterTheOwner = true;



       }else{

          $isRequesterTheOwner = false;

       }



      $response_ans = array();

          foreach($lesson_answers as $lesson_answer){

          $daterelative = getTimeDifference($currdate,$lesson_answer->dateandtime);

          $response_ans[] = array(

    		"__class" => "answer",

    		"id" => $lesson_answer->ans_id,

    		"body" => $lesson_answer->answer,

            "user" => $userinfo_array,

            "questionId"=>$lesson_queries->query_id,

            "voteCount"=>null,

            "created"=>$lesson_queries->dateandtime,

            "createdRelative"=>$daterelative,

            "hasComments"=>false,

            "numComments"=>"0",

            "isCreatedByInstructor"=>$isCreatedByInstructor,

            "isOwner"=>$isRequesterTheOwner,

            "upvoted"=>null,

            "userVote"=>null,

           );

      }

      $response_ans_array = array(

           "data"=>$response_ans,

           "pagination"=>array(

             "page"=>1,

             "pageSize"=>12,

             "total"=>3,

           )

       );

      // print_r($response_ans_array);

      echo json_encode($response_ans_array);



	}

	public function userinfo_array($user_id){

	 $this->load->model('login_model');

	 $this->load->model('program_model');



	 $user_info = $this->login_model->getUserInfo($user_id);

	 $user_courses = $this->program_model->getTeacherCourse($user_id);

     $numcoursecreated = count($user_courses);

     $buy_courses = $this->lessons_model->getBuyCourses($user_id);

     $numcoursesubscribed = $buy_courses->count_buy_courses;

     $img_path = base_url()."public/uploads/users/img/".$user_info->images;

	 $userinfo_array = array( "__class" => "user",

					"id" => $user_info->id,

					"title" => $user_info->first_name.' '.$user_info->last_name,

					"name" => $user_info->first_name,

					"surname" => $user_info->last_name,

					"designation" => $user_info->title,

					"jobTitle" => null,

					//"description" => addslashes($user_info->full_bio),

                    //"description" => "<div class=\"w3c-default\"><\/div>",

    				"locale" => null,

    				"timeZone" => null,

    				"urlTitle" => null,

    				"url" => null,

    				"tagTitles" => null,

                    "numFollowers" => null,

    				"numFollowing" => null,

    				"twitter" => $user_info->twitter,

    				"google" => null,

    				"facebook" => $user_info->facebook,

					"images" => array(

								//"img_50x50" => "https:\/\/udemy-images.s3.amazonaws.com\/user\/50x50\/anonymous.jpg",

								"img_50x50" => $img_path,

								"img_75x75" => $img_path,

								"img_100x100" => $img_path

								),

					"numTaughtCourses" => $numcoursecreated,

					"numSubscribedCourses" => $numcoursesubscribed,

                    "numVisibleTaughtCourses" => 0,

					"numVisibleSubscribedCourses" => 1,

					"isFollowing" => false

					);

                  //  print_r($userinfo_array);

				   return $userinfo_array;

	}

	public function query_responseheader($queryid)

	{

       $datestring = "%Y-%m-%d %h:%i:%s";

       $time = time();

       $currdate = mdate($datestring, $time);

       $sessionarray = $this->session->userdata('logged_in');

	   /* redirect on login if not logged in*/

	   if(empty($sessionarray)){

	   redirect('users/login');

	   }

       $user_id = $sessionarray['id'];

       $group_id = $sessionarray['groupid'];

       $query_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $queryid;

       $request = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '';

       $lesson_queries = $this->lessons_model->getLessonQueries($queryid);

       $quser_id = $lesson_queries->user_id;

       $userinfo_array = $this->userinfo_array($quser_id);

       $lesson_date = $lesson_queries->dateandtime;

	   $this->load->model('Myinfo_model');

       $daterelative = getTimeDifference($currdate,$lesson_date);

	   if($request == 'list'){

       if($userinfo_array['designation'] == "Trainer"){

          $isCreatedByInstructor = true;

       }else{

          $isCreatedByInstructor = false;

       }

       if($user_id == $quser_id){

           $isRequesterTheOwner = true;



       }else{

          $isRequesterTheOwner = false;

       }

       $responseheader = array(

    		"__class" => "question",

    		"id" => $lesson_queries->query_id,

    		"title" => $lesson_queries->query_title,

    		"body" => $lesson_queries->query_text,

    		"courseId" => $lesson_queries->pro_id,

    		"lectureId" => $lesson_queries->lesson_id,

    		"user" => $userinfo_array,

    		"created" => $lesson_date,

    		"isCreatedByInstructor" => $isCreatedByInstructor,

    		"createdRelative" => $daterelative,

    		"isRequesterTheOwner" => $isRequesterTheOwner

    		);

    		echo json_encode($responseheader);

       }

	   

       if($request == 'update'){

          $data = array(

            "query_title" => $this->input->post('query_title'),

    		"query_text" => $this->input->post('query_text')

          );

          $isupdate = $this->lessons_model->updateLessonQueries($queryid,$data);

          if($isupdate){

              echo "update";

          }else{

              echo "not updated";

          }



       }

       if($request == 'delete'){

         $delete = $this->lessons_model->deleteLessonQueries($queryid);

		if($delete){

		echo true;

		}else{

		echo 'error';

		}

       }

	}

    public function answer_responses($queryid)

	{

	 // echo $queryid;

       $this->load->model('Myinfo_model');

       $lesson_queries = $this->lessons_model->getLessonQueries($queryid);

       //print_r($lesson_queries);

       $datestring = "%Y-%m-%d %h:%i:%s";

       $time = time();

       $currdate = mdate($datestring, $time);

       $sessionarray = $this->session->userdata('logged_in');

       $user_id = $sessionarray['id'];

       $group_id = $sessionarray['groupid'];



       $query_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $queryid;

       $request = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '';

       $ans_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '';

       $quser_id = $lesson_queries->user_id;

       $lesson_answers = $this->lessons_model->getLessonAnswer($queryid);

        //print_r($lesson_answers);

       $userinfo_array = $this->userinfo_array($quser_id);

       if($userinfo_array['designation'] == "Trainer"){

          $isCreatedByInstructor = true;

       }else{

          $isCreatedByInstructor = false;

       }

       if($user_id == $quser_id){

           $isRequesterTheOwner = true;



       }else{

          $isRequesterTheOwner = false;

       }

      if($request == 'list'){

      $response_ans = array();

          foreach($lesson_answers as $lesson_answer){

          $daterelative = getTimeDifference($currdate,$lesson_answer->dateandtime);

          $response_ans[] = array(

    		"__class" => "answer",

    		"id" => $lesson_answer->ans_id,

    		"body" => $lesson_answer->answer,

            "user" => $userinfo_array,

            "questionId"=>$lesson_queries->query_id,

            "voteCount"=>null,

            "created"=>$lesson_queries->dateandtime,

            "createdRelative"=>$daterelative,

            "hasComments"=>false,

            "numComments"=>"0",

            "isCreatedByInstructor"=>$isCreatedByInstructor,

            "isOwner"=>$isRequesterTheOwner,

            "upvoted"=>null,

            "userVote"=>null,

           );

      }

      $response_ans_array = array(

           "data"=>$response_ans,

           "pagination"=>array(

             "page"=>1,

             "pageSize"=>12,

             "total"=>3,

           )

       );

      echo json_encode($response_ans_array);

      }

      if($request == 'delete'){

         $delete = $this->lessons_model->deleteLessonAnswer($ans_id);

		if($delete){

		echo true;

		}else{

		echo 'error';

		}

       }

     }



	public function module()

	{

      $tmpl = "default";

      $uid = '1';

	  $this->load->model('Tasks_model');

	  $this->load->model('admin/settings_model');

	  $settings = $this->settings_model->getItems();

      $program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

      $day_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

	  

	  $programdetail = $this->Tasks_model->getLessonsName($program_id);

	  

	  $sessionarray = $this->session->userdata('logged_in');

	   

	  $user_id = $sessionarray['id'];

	  $group_id = $sessionarray['groupid'];

	  $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);

	  

	  $this->template->set("programdetail", $programdetail);

	  $this->template->set("viewedLesson", $this->Tasks_model->countViewedLesson($user_id,$program_id));

	  $this->template->set("programnavarray", $programnavarray);

	  $this->template->set("user_id", $user_id);

	  $this->template->set("tmpl", $tmpl);

	  $this->template->set("program_id", $program_id);

	  $this->template->set("moduleid", $day_id);

	  $this->template->set("settings", $settings);

	  $this->template->set("module", $this->Tasks_model->getModule($day_id));

	  $this->template->set('db_media', $this->Tasks_model->getMedia_oflayout('mod_m',$day_id));

	  $this->template->set('db_mediatext', $this->Tasks_model->getMedia_oflayout('mod_t',$day_id));

	  $this->template->build('lessons/module');

	 }

	public function finalexam()
	{
	  $tmpl = "default";
      $uid = '1';
      $this->load->model('Tasks_model');
	  $this->load->model('admin/quizzes_model');
	  $this->load->model('admin/settings_model');

	  $settings = $this->settings_model->getItems();
	  $sessionarray = $this->session->userdata('logged_in');
	  $user_id = $sessionarray['id'];
	  $program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
      $final_exam_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
	  $programdetail = $this->Tasks_model->getLessonsName($program_id);
	  $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);
	  $idFinalExam = $programdetail[0]['id_final_exam'];
	  $idcertificate = $programdetail[0]['certificate_term'];

	  if(isset($idFinalExam) and ($idFinalExam != 0))
	  {
		$this->template->set("finalexamid", $idFinalExam);
	  }

	  $quizinfo = $this->Tasks_model->getQuiz($idFinalExam);
      //print_r($quizinfo);
      $time_limit = $quizinfo->limit_time;
      $this->template->set("limit_time", $time_limit);

	    if(isset($idcertificate) and ($idcertificate != 0) and isset($user_id))
	    {
			$takenwhere = array(
						'user_id'      => $user_id,
						'quiz_id'      => $idFinalExam
						);

			$quiztakeninfo = $this->Tasks_model->getQuizTaken($takenwhere);

			$first= explode("|", @$quiztakeninfo[0]->score_quiz);

			@$res = intval(($first[0]/$first[1])*100);

			if($res >= $quizinfo->max_score)
			{
				$iscertificate = true;
				$this->template->set("certificateid", $idcertificate);
				$this->template->set("iscertificate", $iscertificate);
			}
	  	}

	  $date_enrolled = $this->Tasks_model->datebuynow($program_id, $user_id);

	  if(count($date_enrolled) > 0){

			$not_show = true;

			}

			else{

				$not_show = false;

			}

	  $this->template->set("viewedLesson", $this->Tasks_model->countViewedLesson($user_id,$program_id));

	  $this->template->set("date_enrolled", $date_enrolled);

	  $this->template->set("user_id", $user_id);

	  $this->template->set("final_exam_id", $final_exam_id);

	  $this->template->set("programnavarray", $programnavarray);

	  $this->template->set("tmpl", $tmpl);

	  $this->template->set("program_id", $program_id);

	  $this->template->set("programdetail", $programdetail);

	  $this->template->set("isfinalview", true);

	  $this->template->set("iscertificateview", false);

	  $this->template->set("settings", $settings);

      //certificate view code

      $this->template->set("courses", $this->Myinfo_model->getCourses($user_id,$program_id,''));

      $this->template->set("coursecompleted", $this->Myinfo_model->courseCompleted($user_id,$program_id));

      //REGULAR QUIZ

          $get_QuizScore =   $this->Myinfo_model->getQuizScore($user_id,$program_id);

          $res = '';

          foreach($get_QuizScore as $getQuizScore){

          $score_quiz = (isset($getQuizScore->score_quiz)) ? $getQuizScore->score_quiz : '';

          $first= explode("|", $score_quiz);

          @$res = intval(($first[0]/$first[1])*100);

          }

          $this->template->set("res", $res);

          $getquizcourses = $this->Myinfo_model->getQuizCourses($program_id);

          //print_r($getquizcourses);

          $nb_ofscores = (isset($getquizcourses->hasquiz)) ? $getquizcourses->hasquiz : '';

          $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';

          $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);

          $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

          $this->template->set("getmaxscore", $getmaxscore);

      	//REGULAR QUIZ

     	//FINAL QUIZ

        	$scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user_id,$program_id);

         	$avg_quizzes_cert =   $this->Myinfo_model->getAvgpercert();

          	$this->template->set("scores_avg_quizzes", $scores_avg_quizzes);

          	$this->template->set("avg_quizzes_cert", $avg_quizzes_cert);

      	//FINAL QUIZ

      	//certificate view code

	  	$count = $this->Tasks_model->countViewedLesson($uid,$program_id);

     	$this->load->model('Program_model');

      	if($this->uri->segment(3))
       	{
            $prog_id =$this->uri->segment(3) ;

            $program = $this->Program_model->getProgram($prog_id);

            $wcoption=$program->webcam_option;
        }
	    $this->template->set("webcamoption", $wcoption);
	  	//$this->template->build('lessons/lesson');
	  	$this->template->build('lessons/finalexam');
	}

	//my final exam new on dated 21-05-2015
	public function finalexamnew()
	{
		$this->load->model('Tasks_model');
	  	$this->load->model('admin/quizzes_model');
	  	$this->load->model('admin/settings_model');
		$program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
      	$final_exam_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
      	$sessionarray = $this->session->userdata('logged_in');	  	
		$user_id = $sessionarray['id'];	 
      	$date_enrolled = $this->Tasks_model->datebuynow($program_id, $user_id);
      	$pname =  $this->program_model->getProgramName($program_id);
      	
		if(count($date_enrolled) > 0)
		{
			$not_show = true;
		}
		else
		{
			$not_show = false;
		}

        $this->template->set("pname", $pname);  
		$this->template->set("date_enrolled", $date_enrolled);      	 	
		$this->template->set("program_id", $program_id);	
		$this->template->set("user_id", $user_id);		
		$this->template->set("isfinalview", 'true');
		$this->load->model('Program_model');
		if($this->uri->segment(3))
       	{
            $prog_id =$this->uri->segment(3) ;

            $program = $this->Program_model->getProgram($prog_id);
  
            $wcoption=$program->webcam_option;
        }
	    $this->template->set("webcamoption", $wcoption);
		$this->template->build('lessons/lesson');
	}

    public function editplan()
	{
      $tmpl = "default";

      $this->load->model('Tasks_model');

      $pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

      $less_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

      $plans = $this->Tasks_model->getPlans($pro_id);

      $this->template->set("plans", $plans);

      $this->template->set("less_id", $less_id);

      $this->template->set("pro_id", $pro_id);

      $this->template->set("tmpl", $tmpl);

	  $this->template->build('tasks/editplan');

	}

    public function buy_course()

	{  //$this->load->library('session');



      $tmpl = "default";

      $this->load->model('Tasks_model');

      $pro_plan_id = $this->input->post('subscription_default');

      $lesson_id = $this->input->post('less_id');

      $pro_id = $this->input->post('pro_id');

      $planid = $this->input->post('planid');

      $plans = $this->Tasks_model->getCartData($pro_plan_id);

     //print_r($plans);



      $lesson_name = $this->Tasks_model->getLessonsName($pro_id);

     // print_r($lesson_name);

      $getplans = $this->Tasks_model->getPlans($pro_id);

     // $getplans4 = $this->Tasks_model->getPlans4($pro_id);

     // $pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

      //$plans = $this->Tasks_model->getPlans($pro_id);



      // print_r($_POST);

      // foreach($plans as $plan){

      if($plans){

        $id = $plans->plan_id;

        $name = $plans->name;

        $price = $plans->price;

        $pro_id = $plans->product_id;



     //  }

       $data = array(

               'id'      => $id,

               'qty'     => 1,

               'price'   => $price,

               'name'    => $name,

               'pro_id' => $pro_id

            );

    // print_r($data);

     // if($planid != $plans->plan_id)

      $this->cart->insert($data);

    //  }else{

     // $data = $_POST;

     // $this->cart->update($data);

     // }

         }

     // $this->cart->insert($plans7);

    //  print_r($this->cart->contents());

     // $this->cart->destroy();

     // print_r($this->cart->total_items());

     // $this->template->set("row_id", $row_id);

      $this->template->set("lesson_name", $lesson_name);

      $this->template->set("getplans", $getplans);

      $this->template->set("plans", $plans);

      $this->template->set("tmpl", $tmpl);

	  $this->template->build('tasks/buy_course');

	}

   public function updateCart(){



        //To update the information in your cart, you must pass an array containing the Row ID

        //and quantity to the $this->cart->update() function.





        //ID and the Quantity can be pass by submiting the form in our cart view.



        //Our cart view can generate a data like this

        //I try add an item to cart then try to submit the form and using var dump I got something like this

        /*

        Array (

            [1] => Array (

                    [rowid] => 79fcbc10fafd6b1ea8202991ba15502c

                    [qty] => 12 )

            [2] => Array (

                    [rowid] => e942e3675eab2e6e688bdf6a851a0a54

                    [qty] => 34 )

            )

        */



        if($_POST){



            $data = $_POST; //for the sake of this example we are going to use the $_POST variable directly



        }



        $this->cart->update($data);



        redirect('cart');

    }

   public function remove($rowid) {

     //$pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

    //if ($rowid=="all"){

        //$this->cart->destroy();

   // }else{

        $data = array(

            'rowid'   => $rowid,

            'qty'     => 0

        );



        $this->cart->update($data);

   // }



    redirect('tasks/buy_course');

    }





	function saveInDb(){

		$this->load->model('Tasks_model');

		//saved_quiz_id, ansgivedbyuser, question_id,quize_id,time_quiz_taken,questions_ids_random

		$sessionarray = $this->session->userdata('logged_in');

		$user_id = $sessionarray['id'];

		$saved_quiz_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;

		/*if($saved_quiz_id==''){

		$saved_quiz_id = 0;

		}*/

		$quiz_id =  ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;

		$ans_givedbyuser = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : 0;

		if(isset($ans_givedbyuser) && $ans_givedbyuser != 0){

		$ans_givedbyuser = implode('||',explode('-',$ans_givedbyuser));

		}

		$qstion_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

		$time_quiz_taken = ( $this->uri->segment(7) )  ? $this->uri->segment(7) : NULL;

		$questions_ids_list = ( $this->uri->segment(8) )  ? $this->uri->segment(8) : NULL;

		$questions_ids_list = implode(',',explode('-',$questions_ids_list));

		$quizinfo = $this->Tasks_model->getQuiz($quiz_id);

	

		//print_r($quizinfo);

		$isfinal = $quizinfo->is_final;

		$show_nb_quiz_select_up = $quizinfo->show_nb_quiz_select_up;

		

		//if($isfinal == 0 && $show_nb_quiz_select_up == 1){

		if($isfinal == 0){

		$sql = "SELECT id FROM mlms_questions WHERE qid=".intval($quiz_id)." ORDER BY `reorder`";

		}else{

		$result_qids = 0;

		$finalquizinfo = $this->Tasks_model->getQuizzesFinal($quiz_id);

		$result_qids = explode(",",trim($finalquizinfo->quizzes_ids,","));

		$sql  = "SELECT id FROM mlms_questions WHERE qid IN (".implode(",", $result_qids).") ORDER BY reorder";

		}

		$quiz_question_id = $this->Tasks_model->getQuestionsCustomSQL($sql);

		//echo $qstion_id; print_r($quiz_question_id);

		$qstion_id = $qstion_id -1;	

		$quiz_question_id = $quiz_question_id[$qstion_id]->id;	

		if($isfinal == 0 && $show_nb_quiz_select_up == 0){

			$quiz_question_id = explode(",",trim($questions_ids_list,","));

			$quiz_question_id  = $quiz_question_id [$qstion_id];

		}

		$data = array(

					'user_id'      => $user_id,

					'show_result_quiz_id'      => $saved_quiz_id,

					'answers_gived'      => $ans_givedbyuser,

					'question_id'      => $quiz_question_id

				);//print_r($data);

		$this->Tasks_model->saveQuizQuestionTaken($data);

		/*if($time_quiz_taken >0 && $time_quiz_taken!="" && $time_quiz_taken < 11 ){

			$data = array(

					'time_quiz_taken_per_user' => $time_quiz_taken+1

				);

			$this->Tasks_model->updateQuizTaken($data,$quiz_id,$user_id);

		}*/

	/*

	$database =& JFactory::getDBO();	

		$user =& JFactory::getUser();

		$user_id = $user->id;

		$saved_quiz_id = JRequest::getVar("saved_quiz_id");

		$quiz_id =  JRequest::getVar("quiz_id");

		$ans_givedbyuser = JRequest::getVar("ans_gived");

		$qstion_id = JRequest::getVar("qstion_id");	

		$time_quiz_taken = JRequest::getVar("time_quiz_taken");	

		$questions_ids_list = JRequest::getVar("questions_ids_list");

		

		$sql = "SELECT is_final from #__guru_quiz where id=".$quiz_id;

		$database->setQuery($sql);

		$database->query();

		$isfinal=$database->loadResult();

		

		$sql = "SELECT show_nb_quiz_select_up from #__guru_quiz where id=".$quiz_id;

		$database->setQuery($sql);

		$database->query();

		$show_nb_quiz_select_up=$database->loadResult();

		

		if($isfinal == 0 && $show_nb_quiz_select_up == 1){

			$sql = "SELECT id FROM #__guru_questions WHERE qid=".intval($quiz_id)." ORDER BY `reorder`";

		}

		else{

			$sql = "SELECT 	quizzes_ids FROM #__guru_quizzes_final WHERE qid=".$quiz_id;

			$database->setQuery($sql);

			$database->query();

			$result=$database->loadResult();	

			$result_qids = explode(",",trim($result,","));

		

			$sql  = "SELECT id FROM #__guru_questions WHERE qid IN (".implode(",", $result_qids).") ORDER BY reorder";

			

		}

		$database->setQuery($sql);

		$database->query();

		$quiz_question_id= $database->loadObjectList();

		$qstion_id = $qstion_id -1;	

		$quiz_question_id = $quiz_question_id[$qstion_id]->id;	

		

		if($isfinal == 0 && $show_nb_quiz_select_up == 0){

			$quiz_question_id = explode(",",trim($questions_ids_list,","));

			$quiz_question_id  = $quiz_question_id [$qstion_id];

		}

		

		$sql = 'INSERT INTO #__guru_quiz_question_taken (`user_id`, `show_result_quiz_id`, `answers_gived`,`question_id`) VALUES ('.$user_id.', '.$saved_quiz_id.', "'.$ans_givedbyuser.'","'.$quiz_question_id.'")';

		$database->setQuery($sql);

		$database->query();

		if($time_quiz_taken >0 && $time_quiz_taken!="" && $time_quiz_taken < 11 ){

			$sql = "UPDATE #__guru_quiz_taken set time_quiz_taken_per_user='".($time_quiz_taken-1)."' WHERE quiz_id=".$quiz_id." AND user_id=".$user_id;

			$database->setQuery($sql);

			$database->query();

		}

	*/

	}

	function saveInDbQuiz()
	{
		$this->load->model('Tasks_model');
	    //quize_id,how_many_right_answers,number_of_questions,course_id
	    //error_reporting(0);
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$quiz_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
		$how_many_right_answers = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
		$number_of_questions = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;
		$course_id = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;
		$score_quiz = $how_many_right_answers."|".$number_of_questions;
		$date = date('Y-m-d h:i:s');
		//"SELECT time_quiz_taken FROM #__guru_quiz WHERE id=".$quiz_id;
		$quizinfo = $this->Tasks_model->getQuiz($quiz_id);
		$resultt = $quizinfo->time_quiz_taken;

		$takenwhere = array(

					'user_id'      => $user_id,

					'quiz_id'      => $quiz_id,

					'pid'      => $course_id

					);



		$quiztakeninfo = $this->Tasks_model->getQuizTaken($takenwhere);



		$resultu = count($quiztakeninfo);

        //print_r($quiztakeninfo); exit;

        if($this->Tasks_model->checkWebCamOption($course_id))

        {

            $snapfoldername=$user_id."_".$course_id."_".$this->session->userdata('session_id');

        }

        else

        {

            $snapfoldername="";

        }

        //print_r($resultu); exit;

		if($resultu == 0){

			$data = array(

						'user_id'      => $user_id,

						'quiz_id'      => $quiz_id,

						'score_quiz'      => $score_quiz,

						'date_taken_quiz'      => $date,

						'pid'      => $course_id,

                        'snapfoldername'      => $snapfoldername,

						'time_quiz_taken_per_user' => 1

					);

			 $mlms_quiz_taken_id=$this->Tasks_model->saveQuizTaken($data);







             /**********************  V Start  *******************/



                $passingscore=$quizinfo->max_score;



                 //$avg=(intval($how_many_right_answers)/intval($number_of_questions))*100;

                 $avg=$passingscore;



                 if($avg < $passingscore)

                 {

                     $finalexam_status='fail';

                 }

                 else

                 {

                      $finalexam_status='pass';

                 }







             $datatoupdate = array(

						'finalexam_status' => $finalexam_status,

						'average' => $avg,

						'finalexamid' => $mlms_quiz_taken_id

					);

             if($quizinfo->is_final)

             {

                $this->Tasks_model->updatemLmsBuyCoursesTbl($datatoupdate,$course_id,$user_id);

             }



               /**      V End        **/

             echo $mlms_quiz_taken_id;



		}else{

        		$wherearray = array(

        						'user_id'      => $user_id,

        					    'show_result_quiz_id' => $quiztakeninfo[0]->id

        		);



        		$results = $this->Tasks_model->getQuizQuestionTaken($wherearray);

                // print_r($results);

        		if(!empty($results)){

        		$delwherequearray = array();

        			foreach($results as $res){

        			$delwherequearray[] = $res->id;

        			}





		            //$this->Tasks_model->deleteQuizTaken($delwherequearray);



		            }



		            $resultt = intval($quiztakeninfo[0]->time_quiz_taken_per_user)+1;

            		$data = array(

            						'user_id'      => $user_id,

            						'quiz_id'      => $quiz_id,

            						'score_quiz'      => $score_quiz,

            						'date_taken_quiz'      => $date,

            						'pid'      => $course_id,

                                    'snapfoldername'      => $snapfoldername,

            						'time_quiz_taken_per_user' => $resultt

            					);

		            $getquizinfo_id = $this->Tasks_model->saveQuizTaken($data,$quiz_id,$user_id,$course_id);

                   // echo $getquizinfo_id;



                    /****   V ********/

                    $passingscore=$quizinfo->max_score;



                 //$avg=(intval($how_many_right_answers)/intval($number_of_questions))*100;

                 $avg=$passingscore;



                 if($avg < $passingscore)

                 {

                     $finalexam_status='fail';

                 }

                 else

                 {

                      $finalexam_status='pass';

                 }







             $datatoupdate = array(

						'finalexam_status' => $finalexam_status,

						'average' => $avg,

						'finalexamid' => $quiztakeninfo[0]->id

					);

             if($quizinfo->is_final)

             {

                $this->Tasks_model->updatemLmsBuyCoursesTbl($datatoupdate,$course_id,$user_id);

             }



               /***** V E *****/







		            //echo $quiztakeninfo[0]->id;

		            echo $getquizinfo_id;





                /* $passingdetail=$this->Tasks_model->getPassingScore($quiz_id);



                 $avg=($how_many_right_answers/$number_of_questions)*100;



                 if($avg < $passingdetail['max_score'])

                 {

                     $finalexam_status='fail';

                 }

                 else

                 {

                      $finalexam_status='pass';

                 }





                    $datatoupdate = array(

						'finalexam_status' => $finalexam_status,

						'average' => $quiz_id

					);

                 echo "<pre>";

                        print_r($datatoupdate);

                 echo "</pre>";    */





		}

				//'.$user_id.', '.$quiz_id.', "'.$score_quiz.'","'.$date.'", '.$course_id.','.$resultt.'

		/*$database =& JFactory::getDBO();	

		$user =& JFactory::getUser();

		$user_id = $user->id;

		$quiz_id = JRequest::getVar("quiz_id");

		$how_many_right_answers = JRequest::getVar("howmrans");

		$number_of_questions = JRequest::getVar("numbofquestions");

		$course_id = JRequest::getVar("course_id");	

		$score_quiz = $how_many_right_answers."|".$number_of_questions;

		$date = date('Y-m-d h:i:s');

		$sql1 = "SELECT time_quiz_taken FROM #__guru_quiz WHERE id=".$quiz_id;

		$database->setQuery($sql1);

		$resultt = $database->loadResult();

		//$sql2 = "SELECT count(user_id) FROM #__guru_quiz_taken WHERE user_id=".$user_id."and quiz_id=".$quiz_id;

		$database->setQuery($sql2);

		$resultu = $database->loadResult();

		if($resultu == 0){

			$sql = 'INSERT INTO  #__guru_quiz_taken (`user_id`, `quiz_id`, `score_quiz`, `date_taken_quiz`, `pid`,`time_quiz_taken_per_user`) VALUES ('.$user_id.', '.$quiz_id.', "'.$score_quiz.'","'.$date.'", '.$course_id.','.$resultt.')';

			$database->setQuery($sql);

			$database->query();

		}

		echo $database->insertid();*/

	}

	function saveInDbaseHowMany(){

	//quize_id,how_many_right_answers,number_of_questions, question_id1, saved_quiz_id

		$this->load->model('Tasks_model');

		$sessionarray = $this->session->userdata('logged_in');

		$user_id = $sessionarray['id'];

		$quiz_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

		$how_many_right_answers = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

		$number_of_questions = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

		$segmentsix = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;

		$segmentsix = implode(',',explode('-',$segmentsix));

		$saved_quiz_id = ( $this->uri->segment(7) )  ? $this->uri->segment(7) : 0;

		$score_quiz = $how_many_right_answers."|".$number_of_questions;

		$data = array(

				   'score_quiz'      => $score_quiz

				);

		$this->Tasks_model->saveHowMany($data,$quiz_id,$saved_quiz_id);

	/*$database =& JFactory::getDBO();

		$user =& JFactory::getUser();

		//$quiz_id = JRequest::getVar("quiz_id");

		//$how_many_right_answers = JRequest::getVar("howmanyans");

		//$number_of_questions = JRequest::getVar("numbofquestions");

		//$saved_quiz_id = JRequest::getVar("saved_quiz_id");

		$score_quiz = $how_many_right_answers."|".$number_of_questions;

		$sql = 'UPDATE #__guru_quiz_taken set `score_quiz`= "'.$score_quiz.'" WHERE quiz_id='.$quiz_id.' and id='.$saved_quiz_id;

		$database->setQuery($sql);

		$database->query();*/



	}

    function viewcertificate(){

   /*$this->load->library('pdf');

	$this->pdf->load_view('lessons/viewcertificate');

	$this->pdf->render();

	$this->pdf->stream("welcome.pdf"); */

    $program_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

    $this->load->model('admin/certificates_model');



    $sessionarray = $this->session->userdata('logged_in');

    $cetificate_background = $this->certificates_model->getItems();

    $cterm = $this->lessons_model->getCertificateMsg($program_id);

    $cetificate_msg = ($cterm) ? $cterm : '';



    $datetype = $this->lessons_model->getDatetype();

    $this->template->set("username", $sessionarray);

    $this->template->set("imagename", $cetificate_background);

    $this->template->set("cetificate_msg", $cetificate_msg);

    $this->template->set("datetype", $datetype);

    $this->template->build('lessons/viewcertificate');

    //$this->template->set("lesson", $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id));



    }



    	public function getVimeoInfo($vimeo)

	{

		$url = parse_url($vimeo);

		if($url['host'] !== 'vimeo.com' &&

				$url['host'] !== 'www.vimeo.com')

			return false;

	   if (preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $vimeo, $match))

	   {

		   $id = $match[1];

	   }

	   else

	   {

		   $id = substr($link,10,strlen($link));

	   }



	   if (!function_exists('curl_init')) die('CURL is not installed!');

	   $ch = curl_init();

	   curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");

	   curl_setopt($ch, CURLOPT_HEADER, 0);

	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	   curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	   $output = unserialize(curl_exec($ch));

	   $output = $output[0];

	   curl_close($ch);

	   return $output['id'];

	}



	public function ajaxmediaview($media_id = NULL){

	$this->load->helper('file');

	$this->load->helper('text');

   //	error_reporting(0);

   

    $this->load->model('admin/medias_model');

    $media_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : '' ;

	$frame_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '' ;

	$media = $this->medias_model->getItems($media_id);
	
   /*echo '<pre>';
	print_r($media);
	echo '</pre>';*/
	
	//$type = $media->type;

    if($media){

	?>

		<div id="movieframe<?php echo $frame_id;?>">

		<?php

		if(isset($media->type) && $media->type == "docs")
		{	

		if($media->local)
		 {
           
			$pdffile = base_url().'public/uploads/documents/'.$media->local;
		 }
		 else
		 {
		 	$pdffile = $media->url;
		 }

			echo '<div style="max-width:1200px; max-height:900px; overflow:scroll;align:center">'; // 

			//echo '<iframe src="http://docs.google.com/gview?url='.$pdffile.'" frameborder="0"></iframe>';

			//echo read_file('public/uploads/documents/'.$media->local);

			//echo file_get_contents(base_url().'public/uploads/documents/'.$media->local);

			//New code start by sachin
			//echo '<a href="'.base_url().'public/uploads/documents/'.$media->local.'" target="_blank">'.base_url().'public/uploads/documents/'.$media->local."</a><br>The selected element is a text file that can't have a preview";
			//echo"<object data='".base_url()."public/uploads/documents/".$media->local."' type='application/vnd.ms-word.document.macroEnabled.12' width='1000px' height='500px'></object>";
			echo"<iframe src=http://docs.google.com/viewer?url=".$pdffile."&embedded=true width='100%' height='500px' frameborder='0' disableprint='true' style ='background:white'>myDocument</iframe>";
			//new code end 
		 
		 
		 exit;

		}
		elseif(@$media->type == "url")
		{ 

		echo "<a href='".$media->url."' target='_blank'>".$media->url."</a>";

		exit;

		}
		elseif(isset($media->type) && $media->type == "text")
		{

		echo $media->code;

		exit;

		}
		elseif(isset($media->type) && $media->type == "file")
		{
			if($media->url)	
		   {
			 	$pdffile = $media->url;
			 	echo '<div style="max-width:1200px; max-height:900px; overflow:scroll;align:center">'; // 

				//echo '<iframe src="http://docs.google.com/gview?url='.$pdffile.'" frameborder="0"></iframe>';

				//echo read_file('public/uploads/documents/'.$media->local);

				//echo file_get_contents(base_url().'public/uploads/documents/'.$media->local);

				//New code start by sachin
				//echo '<a href="'.base_url().'public/uploads/documents/'.$media->local.'" target="_blank">'.base_url().'public/uploads/documents/'.$media->local."</a><br>The selected element is a text file that can't have a preview";
				//echo"<object data='".base_url()."public/uploads/documents/".$media->local."' type='application/vnd.ms-word.document.macroEnabled.12' width='1000px' height='500px'></object>";
				echo"<iframe src='".$pdffile."' width='1000px' height='500px' frameborder='0' disableprint='true' style ='background:white'>myDocument</iframe>";
				//new code end 
			 
			 
			exit;
		 }


		echo "This file can't have a preview";

		exit;

		}elseif(isset($media->type) && $media->type == "image"){

		echo "<img width='100%' src=\"".base_url()."public/uploads/images/".$media->local."\">";

		exit;

		}else{?>

				<?php

				if(isset($media->type) && $media->source == 'url'){
				

				?>

					<?php if(preg_match('/http:\/\/(www\.)*vimeo\.com\/.*/',$media->url)){

					$vimeoid = $this->getVimeoInfo($media->url);

					$this->callvimeoplayer($vimeoid,400,300);

					}else{

					$this->calljwplayer($media->url,'url',$media->type,$frame_id); // $type

					}

				}elseif(isset($media->type) && $media->source == 'local'){

				$this->calljwplayer($media->local,'local',$media->type,$frame_id);

				}elseif(isset($media->type) && $media->source == 'code'){    //changes by sachin add only elseif condition
					echo $media->code;
				}

				?>

				<?php }

				?>

		</div>

		<?php

		}

        }





	public function callvimeoplayer($vimeoid,$width,$height)

	{

	?>

	<object width="<?php echo $width;?>" height="<?php echo $height;?>">

					<param name="allowfullscreen" value="true" />
					
					
					
					<param name="play" value="true">

					<param name="allowscriptaccess" value="always" />

					<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid;?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1" />

					<embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $vimeoid;?>&amp;server=vimeo.com&amp;color=00adef&amp;fullscreen=1"

						type="application/x-shockwave-flash" play="true" allowfullscreen="false" allowscriptaccess="always" width="<?php echo $width;?>" height="<?php echo $height;?>"></embed>

	</object>



	<?php

	}

	function calljwplayer($jwurl,$source,$type,$frame_id)

	{

	  //echo $frame_id;

   /*   echo $jwurl;

      echo "<br />";

      echo $source;

      echo "<br />";

      echo $type;

      echo "<br />";

      echo $frame_id;

      echo "<br />";    */



      //echo base_url()."public/uploads/videos/".$jwurl;



	?>

	<script type="text/javascript" src="<?php echo base_url();?>public/jwplayer/vimeojwplayer.js"></script>

					<?php 
					if($source == "local" && $type == 'video')
					{
						if($frame_id == '7')
						{
							?>
							<video width="100%" height="480" controls>
 							 <source src="<?php echo base_url()."public/uploads/videos/".$jwurl;?>" type="video/mp4">
  							<source src="movie.ogg" type="video/ogg">  
							</video>
							<?php
						}
						else
						{
						?>
						<video width="400" height="300" controls loop>
 						 <source src="<?php echo base_url()."public/uploads/videos/".$jwurl;?>" type="video/mp4">
  						<source src="movie.ogg" type="video/ogg">  
						</video>
						<?php
					   }
					}
					else
					{
					
					?>


				<div id="mediaspace<?php echo $frame_id;?>" style='width:640px;height:480px;'></div>

					<script type='text/javascript'>

						jwplayer('mediaspace<?php echo $frame_id;?>').setup({

							flashplayer: '<?php echo base_url();?>public/jwplayer/player.swf',

							<?php if($source == "local" && $type == 'audio'){?>

							file: '<?php echo base_url()."public/uploads/audio/".$jwurl;?>',

                            <?php } elseif($source == "local" && $type == 'video'){ ?>

                        	file: '<?php echo base_url()."public/uploads/videos/".$jwurl;?>',

                            <?php }else{ ?>

							file: '<?php echo $jwurl;?>',

							<?php }?>

							plugins:'plusone-1',

							controlbar: 'bottom',

                            primary: "flash",
							
						    width: '400',

							height: '300'

						});

					</script>



	<?php
		}
	}

	public function uploadwebshorts()
	{

    //  $img = 'public/uploads/webshotuploads/img'.rand().'.png';

    //$today($m,$d)=explode("-",date('m-d'));

    //$dirpath="public/uploads/webshotuploads/".$_POST['usrid']."_".$this->th."_".$this->tm."_".$this->tmonth;

    $dirpath="public/uploads/webshotuploads/".$_POST['usrid']."_".$_POST['prgid']."_".$this->session->userdata('session_id');

    if(file_exists($dirpath))

    {

            $img = $dirpath."/img".time().".png";

    }

    else

    {

        $dirpath=mkdir($dirpath);

        $img = $dirpath."/img".time().".png";

    }

	//file_put_contents($img, file_get_contents($_POST['imagedata']));

	file_put_contents($img, file_get_contents($_POST['imagedata']));

    echo $dirpath;

	}
	
function ajaxQuestionsDisplay($media_id = NULL, $frame_id = NULL, $programdetail,$pro_id = NULL,$viewque = NULL, $layoutid)
{ ?> <div class="ud-lectureangular" style="color:#fff;" id="style-5">
            
        <div class="texteditor_layoout">
          <?php
              		$sessionarray = $this->session->userdata('logged_in');	  	 

		$user_id = $sessionarray['id'];

          ?>
        </div>
              <div id="media_15">
                <div class='my_main'>
                <div id='my_middle_content'>
                <?php                                           
                  //ajaxquizztotask($db_media[14]->media_id,15,'',$pro_id);
                  //ajaxQuestionsDisplay($db_media[14]->media_id,15,'',$pro_id);//my new function on date 13-05-2015                      
                 
                  $quizz = $this->exam_model->getItems($media_id);
                  $settings = $this->exam_model->getQues($media_id);
                  // print_r($settings);
                  //$quizz = $CIq->quizzes_model->getItems($db_media[14]->media_id);
                   // print_r($quizz);

                  // $CIless =& get_instance();//on dated 15-05-2015
                  // $settings = $CIless->lessons_model->getQuestionIds($lessonsContent->is_exam);
                 //$settings = $CIless->lessons_model->getQuestionIds($db_media[14]->media_id);   
          if($settings)
          {              
              $quiz_quesarr = $this->exam_model->get_count_ques($media_id);
              $totalquestions = $quiz_quesarr->Qcount;
          }
                  ?>
                  <div class="quiz_timer">

                    <div class="panel panel-primary" data-collapsed="0"> 

              <div class="panel-heading">
                <div class="panel-title" style="padding-bottom: 0px;">  
                  <p style="margin-top: 0;margin-bottom: 0px; text-align:left; float: left;">Quiz: <span style="color:#fff"><?php echo $quizz->exam_title;?></span></p>

              
                
                 <?php
                if($quizz->show_limit_time == '0')
                {
                  ?> <p style="margin-bottom: 0px; text-align:right;">Quiz time limit: <span style="color:#fff;"><?php echo $quizz->duration_m;?></span> minutes </p>
                <?php 
                }
                ?> 
                </div>  
              </div>


              <div class="panel-body col-sm-12 form-horizontal form-groups-bordered"> 
                <div class="form-group">
                  <label>Note:</label>
                    <span class="quiz_description" style="  margin-top: 20px;"><?php echo $quizz->description;?></span>
                </div>
                <div class="form-group">
                   <label>Instructions:</label>
                  <span class="quiz_description" style="  margin-top: 20px;"><?php echo $quizz->instructions;?></span>
                </div>
                <div class="form-group"> 
                  
                  <div class="col-sm-5"> <?php if($quizz->pbl_max_score == '0'){?>Minimum score to pass this quiz : <span style="color:#42943F"><?php echo $quizz->passing_marks;?>%</span>
                    <?php }?>
                  </div> 
                </div>

                
                  <?php // print_r($quizz);
              if($quizz->attempt_limit == '11')
              {
                $time_quiz_taken = 'Unlimited';
                $remaining = '';
                $remainAttempts = 1;//always set to 1 when unlimited attempts
              }
              else
              {
                $time_quiz_taken = $quizz->attempt_limit;               
                 //$remaining_attempts = $this->lessons_model->getAttempts($quizz->exam_id, $pro_id);
                $attempt_limit = $this->exam_model->getStudAttempt($user_id,$quizz->exam_id,$pro_id);
 // echo $attempt_no[0]->att_no;
                 $remainAttempts = ($time_quiz_taken - $attempt_limit[0]->att_no);
         // echo $remainAttempts;
                if($remainAttempts > 0)
                {
                  $remaining = '<font color=red> ('. $remainAttempts.' attempts remaining )</font>';
                }else{
                  $remaining = '<font color=red> ( Your quiz attempts completed )</font>';
                }
              }
              ?>                

                <div class="form-group"> 
                  
                  <div class="col-sm-5">
                  Questions: <span style="color:#42943F"><?php echo $totalquestions;?></span>
                  </div>
                </div>

                <div class="form-group"> 
                  
                  <div class="col-sm-12">
                  <?php if($quizz->retake == '1'){?>This quiz can be taken up to: <span style="color:#42943F"><?php echo $time_quiz_taken;?></span> times<?php echo $remaining; }?>
                  </div>
                </div>
<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
                //echo $remainingExamTimes;
                ?>
                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  You can give quiz <?php echo $remainingExamTimes;?> more times
                  </div>
                </div>
<?php }?>
                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  You can always see your quiz results on your My Courses page
                  </div>
                </div>

                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  </div>
                </div>

                <hr style="margin:0;" />

                <div class="form-group"> 
                  

                  <div class="col-sm-5">

                              
            
        
          </div></div>
          <div class="form-group" > 

          <div class="col-sm-5" >

          <?php
          if($remainAttempts > 0)
          {
            $att = $attempt_limit[0]->att_no + 1;
            ?>
            <input type='button' class="btn btn-sm btn-success btn-update" onClick="start_exam('<?php echo $att ?>','<?php echo $quizz->exam_title;?>',<?php echo $media_id;//$db_media[14]->media_id;?>,<?php echo $pro_id;?>,'<?php echo $layoutid;?>','1','0');" value='Start Quiz' name='btnStartexam' id='btnStartexam'>
                  <?php
                }
                //ajaxquizztotask($db_media[14]->media_id,15)?>

                  </div>
                </div>





              </div>

            </div>



            

          </div>          

              </div>
              </div>
        </div>



        <table cellspacing="0" cellpadding="0" align="center" width="100%">
                  <tbody><tr>
                    <td>
                      <?php if(isset($jump_but1)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
                      <?php }?>
                    </td>
                    <td>
                      <?php if(isset($jump_but2)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
                      <?php }?>
                    </td>
                    <td>
                      <?php if(isset($jump_but3)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
                      <?php }?>
                    </td>
                    <td>
                      <?php if(isset($jump_but4)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
                      <?php }?>
                    </td>
                  </tr>
                </tbody></table>

          </div>

        	<?php
}	


	

// Helper	
	function ajaxquizztotask($media_id = NULL, $frame_id = NULL, $programdetail,$pro_id = NULL,$viewque = NULL)
	{
	$CIq =& get_instance();
	$CIs =& get_instance();
	$sessionarray = $CIq->session->userdata('logged_in');
	$userid = $sessionarray['id'];
	$CIs->load->model('admin/settings_model');
	$settings = $CIs->settings_model->getItems();
	extract($settings[0]);
	$CIq->load->model('admin/quizzes_model');
	$quizz = $CIq->quizzes_model->getItems($media_id);
	$qids = array();

	if(@$quizz->is_final)
    {
		$quizzFinal = $CIq->quizzes_model->getFinalQuizz($media_id);
	    /* echo "<pre>";
	         print_r($quizzFinal);
	      echo "</pre>";     */

		$quizzarray = array();
		$quizzarray = explode(',',trim($quizzFinal[0]->quizzes_ids,','));
		foreach($quizzarray as $qizzid)
		{
			$qids[] = $qizzid;
		}
	}
	else
	{
		$qids[] = $media_id;
	}

	//$questions = $CIq->quizzes_model->getInQuestions($qids);
	$questions = $CIq->quizzes_model->getInQuestionsNew($qids);
	$quiztaken = $CIq->quizzes_model->getQuizTaken(@$quizz->id,$userid,$pro_id);

    /* if($viewque){
      $view = 'result';
    }else{
      $view = 'exam';
    }*/

    $view = '';

    //(int) $timequiztakenbyuser = (empty($quiztaken)) ?  intval($quizz->time_quiz_taken)-1 : $quiztaken->time_quiz_taken_per_user;
    //print_r($quiztaken);
    //echo $quizz->time_quiz_taken;
 
    (int) $timequiztakenbyuser = (empty($quiztaken)) ?  intval(@$quizz->time_quiz_taken)-1 : intval(@$quizz->time_quiz_taken) - intval($quiztaken->time_quiz_taken_per_user);

    //  echo $timequiztakenbyuser;

	//$view = ($timequiztakenbyuser == 0) ? 'result' : 'exam';

	if((!empty($quizz))&&(!empty($quiztaken)))
    {
    	$first= explode("|", @$quiztaken->score_quiz);
    	@$res = intval(($first[0]/$first[1])*100);
    	if($quizz->time_quiz_taken == $quiztaken->time_quiz_taken_per_user)
        {
    	    $view =  'result';
    	}elseif($res >= intval($quizz->max_score))
        {
    	    $view =  'result';
    	}

        else
        {
            $remainingExamTimes = intval($quizz->time_quiz_taken) - intval($quiztaken->time_quiz_taken_per_user);
    	}
    }
	
	if($view != 'result')
	{
		if(@$quizz->show_countdown == '0')
	    {
		    ?>
			<br>    
		    <div style="float: right; margin-right:20px" align="<?php switch($qct_alignment){case 1:echo "left";break;case 2:echo "right";break;case 3:echo "center";break;}?>"><span>
			<div style="width:<?php echo $qct_width; ?>px; height:<?php //echo $qct_height; ?>100px; border: 1px solid; border-color:#<?php echo $qct_border_color; ?>; font-family:<?php echo $qct_font; ?>; background-color:#<?php echo $qct_bg_color; ?>;" id="divtotal">
	        <div align="center" style="border-bottom:1px #000000 solid; font-size:18px; color:#<?php echo $qct_minsec; ?>; background-color:#<?php echo $qct_border_color; ; ?>;" id="timeleft">Time left</div>
	      	<div style="background-color:#<?php echo $qct_bg_color; ?>;" id="totalbg">
	        <div align="center" style="font-size:28px; color:#<?php echo $qct_title_color; ?>;" id="ijoomlaguru_time">00  &nbsp;  00</div>
		    <div align="center" style="font-size:18px;" id="minsec">Minutes  Seconds</div>
	        </div>
			</div>
			</span></div>
		  	<?php
	    }
	    ?>
	    <span class="quiz_title"><?php //echo $quizz->name;?></span>
    	<?php //print_r($quizz); ?>
		<div class="quiz_timer">
		<table><tbody>
		<tr><td><?php if(@$quizz->show_limit_time == '0'){?>Exam time limit: <span style="color:#669900"><?php echo $quizz->limit_time;?></span> minutes
		<?php }?>	</td>
		<td style="padding-left:25px;"><?php if(@$quizz->pbl_max_score == '0'){?>Minimum score to pass this quiz: <span style="color:#669900"><?php echo $quizz->max_score;?>%</span>
        <?php }?>
        </td>
		</tr>
		<?php
			if($quizz->time_quiz_taken == '11')
			{
				$time_quiz_taken = 'Unlimited';
			}else{
				$time_quiz_taken = $quizz->time_quiz_taken;								
			}
		?>
		<tr><td>Questions: <span style="color:#669900"><?php echo count($questions);?></span></td><td style="padding-left:25px;"><?php if(@$quizz->show_nb_quiz_taken == '0'){?>This exam can be taken up to: <span style="color:#669900"><?php echo $time_quiz_taken;?></span> times<?php }?></td>
		</tr></tbody></table>
	<table>
	<tbody>
		<?php if((@$quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
        //echo $remainingExamTimes;
        ?>
		<tr><td style="padding-top:15px;">You can give exam <?php echo $remainingExamTimes;?> more times</td></tr>
		<?php }?>
		<tr><td style="padding-top:15px;">You can always see your exam results on your My Courses page</td></tr>
		</tbody>
		</table>
	</div>
<hr/>

	<span class="quiz_description"><?php echo @$quizz->description;?></span>
	<?php
	$qindex = 0;

	echo '<div id="the_quiz">';

	$listqidstring = array();

	foreach($questions as $que)
	{
		$qindex++;

		$anskey = array();

		$anskey = explode('|||',$que->answers);
		echo '<ul>';
		echo '<li class="question"><b>'.$qindex.' </b>'.$que->text;
		echo '</li>';

		$rightansstring = array();
		$allansstring = array();

		for($qi=1; $qi<=10; $qi++)
		{
			$qin='a'.$qi;
			if($que->$qin != '' && isset($que->$qin) && $que->$qin != null)
			{
				$nidell = $qi.'a';
				//echo '<br>';
				echo '<li class="answer">';
				//echo (in_array($nidell,$anskey))? '<input type="checkbox" />' : '<input name="q'.$qi.'" onclick="javascript:setQuestionValue(1, \'aa\',\'2a \')" type="checkbox"/>';
				echo '<input name="q'.$qindex.'" value="'.$qi.'a'.$qindex.'" onclick="javascript:setQuestionValue('.$qindex.', \''.$que->$qin.'\',\''.$qi.'a\')" type="checkbox"/>';
				echo $que->$qin;
				echo '</li>';
				if(in_array($nidell,$anskey))
				{ 
					$rightansstring[] = $que->$qin;
				}
				$allansstring[] = $que->$qin;
			}
		}
		echo '</ul>';
		$rightansstring = implode('|||',$rightansstring);
		$allansstring = implode('|||',$allansstring);
		$listqidstring[] = $que->id;
	?>
	<input id="question_answergived<?php echo $qindex;?>" type="hidden" name="question_answergived<?php echo $qindex;?>" value="">
	<input id="question_answerright<?php echo $qindex;?>" type="hidden" name="question_answerright<?php echo $qindex;?>" value="<?php echo $rightansstring;?>">
	<input id="question_answergivedbyuser<?php echo $qindex;?>" type="hidden" name="question_answergivedbyuser1" value="">
	<input id="all_answers<?php echo $qindex;?>" type="hidden" name="all_answers<?php echo $qindex;?>" value="<?php echo $allansstring;?>">
	<input id="the_question<?php echo $qindex;?>" type="hidden" name="the_question<?php echo $qindex;?>" value="<?php echo $que->text;?>">
	<br>
	<?php
	}	
	$listqidstring = implode('-',$listqidstring);
	echo '</div>';
    //print_r($quizz->time_quiz_taken);
	?>
	<input id="question_number" type="hidden" name="question_number" value="<?php echo $qindex;?>">
	<!--<input id="quiz_max_score" type="hidden" name="quiz_max_score" value="70"> -->
	<input id="quiz_max_score" type="hidden" name="quiz_max_score" value="<?php echo @$quizz->max_score;?>">
	<input id="time_quiz_taken" type="hidden" name="time_quiz_taken" value="<?php echo @$quizz->time_quiz_taken;?>">
	<input id="time_quiz_taken_user" type="hidden" name="time_quiz_taken_user" value="<?php echo $timequiztakenbyuser;?>">
	<input id="list_questions_id" type="hidden" name="list_questions_id" value="<?php echo $listqidstring?>">
	
	<div align="left" style="padding-left:50px;">
		<input type="hidden" name="quize_name" id="quize_name" value="categories11">
		<input type="hidden" name="quize_id" id="quize_id" value="<?php echo @$quizz->id;?>">
		<!--<input type="button" onclick="get_quiz_result();" value="Submit" id="submitbutton" class="btn btn-sm btn-success btn-update" name="submitbutton">-->

	</div>
<?php
if(!isset($_COOKIE['m1']) && !isset($_COOKIE['m2']))
{
	$timerm1 = @$quizz->limit_time;
	$timerm2=00;
}elseif($_COOKIE['m1'] == 00 && $_COOKIE['m2'] == 00){

$timerm1 = $quizz->limit_time;
$timerm2 = 00;
}else{

$timerm1 = $_COOKIE['m1'];
$timerm2 = $_COOKIE['m2'];
}

//echo $timerm1;exit;
?>

<!--<script type="text/javascript" language="javascript">

window.onload = iJoomlaTimer(<?php echo $timerm1;?>, <?php echo $timerm2;?> , 2,<?php echo @$quizz->show_finish_alert;?>,0 );

</script>-->

<?php

$statust=0;

}   // end of view !=result

else{

$time_quiz_taken_per_user = $quiztaken->time_quiz_taken_per_user;

$first= explode("|", @$quiztaken->score_quiz);

@$res = intval(($first[0]/$first[1])*100);

	//if($res <= intval($quizz->max_score)){

	$k = 0;

	$quiz_id =  intval($quizz->id);

	$id = $quiztaken->id;

	$quiz_name = $quizz->name;

	$number_of_questions = $first[1];

	$score = $res." %"; 

	$ans_right = $questions;

  	if($res < intval($quizz->max_score))
  	{
		@$quiz_result_content .='<div class ="quiz-timer">';
		$quiz_result_content .='<span> Exam Failed. Your score: <span style="color:#669900;">'.$score.'</span>, Minimum score to pass is: <span style="color:#669900;">'.$quizz->max_score.'%</span></span>';
		$quiz_result_content .='</div><br/>';
	}else
	{
		@$quiz_result_content .="";

		if(isset($programdetail['certificate_term']) and $programdetail['certificate_term']>0){
		$quiz_result_content .="<div style=\"border: 1px solid #FFCC00; background-color:#F7F7F7; padding:10px;\">";
		$quiz_result_content .="<span style=\"font-size:16px;\">Congratulations for passing the final exam! You are now eligible for a certificate for this course.Go to <a href=\"#\">My Certificates</a> to view, share and download your certificate.</span><br></div>";
		}

		$quiz_result_content .='<div class ="guru-quiz-timer">';

		$quiz_result_content .='<span>Exam Passed!. Your score:<span style="color:#669900;">'.$score.'</span> Minimum score to pass is: <span style="color:#669900;">'.$quizz->max_score.'%</span></span>';

		$quiz_result_content .='<br/>'.'<span>Congratulations!</span>';

		$quiz_result_content .='<br/></br>'.'<span>Please continue this course by clicking the next button on top</span>';

		$quiz_result_content .='</div><br/>';

        $statust="Timeout";

	}

	$qindex = 0;
	echo $quiz_result_content;

	echo '<div id="the_quiz">';

	foreach($questions as $que)
	{

		//echo '<br>--qid'.$que->id.'<br>--id'.$id.'<br>--uid'.$userid;


		$QuizQuestionsTaken = $CIq->quizzes_model->getQuizQuestionsTaken($userid,$id,$que->id);


		$ans_gived = (empty($QuizQuestionsTaken)) ? null : $QuizQuestionsTaken[0]->answers_gived;


		$qindex++;


		$anskey = array();


		$anskey = explode('|||',$que->answers);


		$ans_gived_array = explode("a||", trim( $ans_gived ,'a||'));

		/*****check answer is right or wrong****/


    	$answer_count = 0;


    	$ans_gived_result = explode("||", trim( $ans_gived ,'||'));


    	//print_r($ans_gived_result );


    	$gasit = false;


    	for($t=0; $t<count($ans_gived_result); $t++){


		if($ans_gived_result[$t] != ""){


		if(!in_array($ans_gived_result[$t], $anskey))
		{
			$gasit = false;
				break;
				}else{
					$gasit = true;
					$answer_count++;
				}
			}
		}
		/*****end****/

		$qclass = ($gasit == true) ? "right" : "wrong";
		//echo '<ul class="result_list">';
    	//echo '<li class="'.$qclass.'"><b>'.$qindex.' </b>'.$que->text;
    	//echo '</li>';
    	for($qi=1; $qi<=10; $qi++)
    	{
  	    	$qin='a'.$qi;
	  		if($que->$qin != '' && isset($que->$qin) && $que->$qin != null)
	  		{
		  		$nidell = $qi.'a';
		  	//	echo '<br>';
		  		$ans_gived_array = explode("||", trim( $ans_gived ,'||'));
		  		$ansclass = (in_array($nidell,$anskey)) ? "correct" : "incorrect";
		  		//echo '<li class="'.$ansclass.'">';
		  		//echo $que->$qin;
		  		//echo '</li>';
		   }
	   	}
		//echo '</ul>';
		//echo '<br/>';
		}
		echo '</div>';
	}
}





function certificate_view($media_id = NULL, $frame_id = NULL, $programdetail,$pro_id = NULL,$viewque = NULL){





	$CIq =& get_instance();


	$CIs =& get_instance();


	$sessionarray = $CIq->session->userdata('logged_in');


	//print_r($sessionarray);


	$userid = $sessionarray['id'];


	$CIs->load->model('admin/settings_model');


	$settings = $CIs->settings_model->getItems();


	extract($settings[0]);


	$CIq->load->model('admin/quizzes_model');


	$quizz = $CIq->quizzes_model->getItems($media_id);


	$qids = array();


	if($quizz->is_final){


    	$quizzFinal = $CIq->quizzes_model->getFinalQuizz($media_id);


		$quizzarray = array();


		$quizzarray = explode(',',trim($quizzFinal[0]->quizzes_ids,','));


    		foreach($quizzarray as $qizzid){


    		    $qids[] = $qizzid;


    		}


	}


	else{


	    $qids[] = $media_id;





	}


    	$questions = $CIq->quizzes_model->getInQuestions($qids);


    	$quiztaken = $CIq->quizzes_model->getQuizTaken($quizz->id,$userid,$pro_id);


        $view = 'result';


	?>


<?php


    $time_quiz_taken_per_user = $quiztaken->time_quiz_taken_per_user;


    $first= explode("|", @$quiztaken->score_quiz);


    @$res = intval(($first[0]/$first[1])*100);


	$k = 0;


	$quiz_id =  intval($quizz->id);


	$id = $quiztaken->id;


	$quiz_name = $quizz->name;


	$number_of_questions = $first[1];


	$score = $res." %";


	$ans_right = $questions;


    $qindex = 0;


	echo '<div id="the_quiz">';


	foreach($questions as $que){


		//echo '<br>--qid'.$que->id.'<br>--id'.$id.'<br>--uid'.$userid;


		$QuizQuestionsTaken = $CIq->quizzes_model->getQuizQuestionsTaken($userid,$id,$que->id);


		$ans_gived = (empty($QuizQuestionsTaken)) ? null : $QuizQuestionsTaken[0]->answers_gived;


		$qindex++;


		$anskey = array();


		$anskey = explode('|||',$que->answers);


		$ans_gived_array = explode("a||", trim( $ans_gived ,'a||'));





		/*****check answer is right or wrong****/


    	$answer_count = 0;


    	$ans_gived_result = explode("||", trim( $ans_gived ,'||'));


    	//print_r($ans_gived_result );


    	$gasit = false;


    	for($t=0; $t<count($ans_gived_result); $t++){


    		if($ans_gived_result[$t] != ""){


    		if(!in_array($ans_gived_result[$t], $anskey)){


    				$gasit = false;


    				break;


    				}else{


    					$gasit = true;


    					$answer_count++;


    				}


    			}


    		}


		/*****end****/





		$qclass = ($gasit == true) ? "right" : "wrong";


		echo '<ul class="result_list">';


			echo '<li class="'.$qclass.'"><b>'.$qindex.'.</b>&nbsp&nbsp'.$que->text;


			echo '</li>';


			for($qi=1; $qi<=10; $qi++){


			    $qin='a'.$qi;


				if($que->$qin != '' && isset($que->$qin) && $que->$qin != null){


				$nidell = $qi.'a';


				echo '<br>';


				$ans_gived_array = explode("||", trim( $ans_gived ,'||'));


				$ansclass = (in_array($nidell,$anskey)) ? "correct" : "incorrect";


				echo '<li class="'.$ansclass.'">';


				echo $que->$qin;


				echo '</li>';


				}


			}


		echo '</ul>';


		echo '<br/>';


		}


    echo '</div>';


	}


	public function saveNotes()
	{
		$sessionarray = $this->session->userdata('logged_in');
		$data =array( 
					'pid' => $_POST['pro'],
					'module_id' => $_POST['mod'],
					'lesson_id' => $_POST['les'],
					'notes' => $_POST['message'],
					'userid' =>$sessionarray['id']
		);
		$this->lessons_model->saveNotes_model($data);  
		
	}
	public function getNotes()
	{
		$sessionarray = $this->session->userdata('logged_in');
	$data =array( 'pid' => $_POST['pro_id'],
			'module_id' => $_POST['mod_id'],
			'lesson_id' => $_POST['lesson_id'],
			'userid' =>$sessionarray['id']			 
		   );
		$result = $this->lessons_model->getNotes_model($data);
		
        if($result)
		{		
		foreach($result as $result1)
		{
		//echo"<li onmouseover ='showdel($result1->nid)' onmouseout ='hidedel($result1->nid )' ><p> => &nbsp <span id='span$result1->nid' onclick ='showarea($result1->nid);'>$result1->notes</span><textarea id ='area$result1->nid' onblur='showspan($result1->nid );' style='width: 202px; display :none' onkeydown ='updateNote($result1->nid );' >$result1->notes </textarea> &nbsp <span id ='delspan$result1->nid' onclick ='delNotes($result1->nid);' ></span> </p><input type='button'  value='save' id ='btn$result1->nid' onclick ='updateNote1($result1->nid);' style='width: 100px; display :none'></li>";
			
		echo "<li>
				<p id='pDiv'><i class='entypo-feather'></i>&nbsp;
				<span id ='span$result1->nid' onclick ='showarea($result1->nid);'>$result1->notes</span>
				<textarea id='area$result1->nid' onblur='showspan($result1->nid);' style='width: 290px;margin: 0 0px 5px -5px;height:100px;display:none' onkeydown ='updateNote($result1->nid);'>$result1->notes;</textarea> 
				&nbsp;
				</p> 
				<div>
				<button class='btn btn-success' type='button'  value='Save' id='btn$result1->nid' onclick='updateNote1($result1->nid);' style='display :none; margin-right: 5px;'><i class='entypo-floppy'></i></button>
				<button class='btn btn-danger delspan' id='delspan$result1->nid' style='display:none' onclick='delNotes($result1->nid);'><i class='entypo-trash'></i></button>
				</div>
			</li>";
		}		
		}
		else
		{
		echo "";
		
		}
		return true;
	}
	public function upadteNotes()
	{
	$data =array( 'pid' => $_POST['pro'],
			'module_id' => $_POST['mod'],
			'lesson_id' => $_POST['les'],
			'notes' => $_POST['message'],
			'nid' => $_POST['nid']
		   );
		 $result = $this->lessons_model->updateNotes_model($data);
	}
	
	public function deleteNotes()
	{
	
		$data =array( 'nid' => $_POST['nid'] );
	
		 $result = $this->lessons_model->deleteNotes_model($data);
	
	}
	
	public function getmarkcompleted()
	{
		$sessionarray = $this->session->userdata('logged_in');	  	 
		if($sessionarray)
		{
		$user_id = $sessionarray['id'];
		$lesson_id = $_POST['les'];
		$pid = $_POST['pro'];
		$module_id = $_POST['mod'];

		$lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $pid);
		// echo "l$lesson_id".$lesson_id;
		// print_r($lesson_viewed2);
		// $count_lesson_viewed = $this->lessons_model->countmarkViewLesson($user_id, $pid);
		// $removedash = str_replace('||',',',$count_lesson_viewed->mark_as_completed);
		// $removedash2 = str_replace('|','',$removedash);		
		// $complated_array = explode(',',$removedash2);
		// $acceptd_to_count = count($complated_array);
		//print_r($acceptd_to_count);		

			if(!empty($lesson_viewed2))
			{
				foreach($lesson_viewed2 as $compltData)
				{					
					$marks = '|'.$lesson_id.'|';
				 	if( strpos($compltData->mark_as_completed, $marks) !== false )
				 	{
				 		$lessonData = str_replace($marks,'',$compltData->mark_as_completed);//if found then replace to blank

				 		//echo "<div onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Completed</b></span></div>";
				 		echo"<input type='button' onclick ='markCompleted();'' value='Mark as Completed' class='btn-default' style='float: right;margin-right: 10px;'>";
				 	}
				 	else
				 	{
						$lessonData = $compltData->mark_as_completed.$marks;//if not found then concat two fields
						//echo "1<div style='background:#17aa1c' onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Incomplete</b></span></div>";
				 	echo "1<input type='button' onclick ='markCompleted();'' value='Mark as Incomplete' class='btn-default' style='float: right;margin-right: 10px;'>";
				 	}
				}
				$this->lessons_model->updateViewLesson($lesson_id,$user_id,$pid,$module_id,$lessonData);
			}
			else
			{
				$lessonData = '|'.$lesson_id.'|';
				$this->lessons_model->updateViewLesson($lesson_id,$user_id,$pid,$module_id,$lessonData);	
				//echo "<div style='background:#17aa1c' onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Incomplete</b></span></div>";
			echo"<input type='button' onclick ='markCompleted();'' value='Mark as Incomplete' class='btn-default' style='float: right;margin-right: 10px;'>";
			}
		}
	}

	public function getnextlecture()
	{
		
		$lesson_id = $_POST['les'];
		$pid = $_POST['pro'];
		$module_id = $_POST['mod'];

		$this->load->model('Tasks_model');
		$this->load->model('program_model');
		$coursetype_details = $this->Tasks_model->getCourseTypeDetails($pid);
		//print_r($coursetype_details);
		 if($coursetype_details[0]['course_type'] == 1)
			{
				$seq = true;

				///////////////
				$days = $this->program_model->getlistDays($pid);
				    $lecture_ids =array();
					$complated_lecture_ids = array();
					$my_viewed_lesson_total=0;					
					if($days)
					{
						foreach ($days as $day)
						{							
							$lessonsss = $this->program_model->getLessonNew($day->id);														
							
							foreach ($lessonsss as $lessonsss)
							{	if($lessonsss->id)
								{
								array_push($lecture_ids,$lessonsss->id);
							    }
							// 	$lesson_viewedsss = $this->program_model->getCompletedLesson2($lessonsss->id,$user_id,$program_id);
								
							// 	if(!empty($lesson_viewedsss))
							// 	{  
							// 		array_push($complated_lecture_ids,$lessonsss->id);
							// 		$my_viewed_lesson_total++;
							// 	}								
							 }
						}

						
					 }

					   //print_r($days);
					  // print_r($lecture_ids);
					
					$lec_key = array_search($lesson_id,$lecture_ids);
			    	$lec_key1 = $lec_key + 1; 
				    $lect_id = $lecture_ids[$lec_key1];
					$lect_data = $this->lessons_model->getlecturedata($lect_id);
                   $lecture_data = array('lect_data' =>$lect_data,'keyid'=>$lec_key1);
                    echo json_encode($lecture_data);
				//////////////

			}
			else
			{
				$seq = false;
			}

		
	}

	public function displayMarkAsCompleted()
	{
		$sessionarray = $this->session->userdata('logged_in');	  	 
		if($sessionarray)
		{
		$user_id = $sessionarray['id'];
		$lesson_id = $_POST['les'];
		$pid = $_POST['pro'];
		$module_id = $_POST['mod'];

		$lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $pid);
		
			if(!empty($lesson_viewed2))
			{
				foreach($lesson_viewed2 as $compltData)
				{					
					$marks = '|'.$lesson_id.'|';
				 	if( strpos($compltData->mark_as_completed, $marks) !== false )
				 	{
				 		//if found then show green
				 		//echo "<div style='background:#17aa1c' onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Incomplete</b></span></div>";				 		
				 	echo"<input type='button' onclick ='markCompleted();'' value='Mark as Incomplete' class='btn-default' style='float: right;margin-right: 10px;'>";
				 	}
				 	else
				 	{
						//if not found then show black
						//echo "<div onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Completed</b></span></div>";
				 	echo"<input type='button' onclick ='markCompleted();'' value='Mark as Completed' class='btn-default' style='float: right;margin-right: 10px;'>";
				 	}
				}				
			}
			else
			{				
				//echo "<div onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Completed</b></span></div>";
			echo"<input type='button' onclick ='markCompleted();'' value='Mark as Completed' class='btn-default' style='float: right;margin-right: 10px;'>";
			}
		}
	}

	public function lec_statistic()
  	{
  		$this->load->model('Tasks_model');

  		$id = $_POST['id'];
  		$data = array(
  			'spend_time' => $_POST['sptime'],
  			'video_progress' => $_POST['percent'],
  			'tot_duration' => $_POST['duration'],
  		);

  		$update = $this->Tasks_model->updateLecStatistic($data,$id);
  		echo $update;
  	}

	public function setViewLesson()
	{
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];	

		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$currdate = mdate($datestring, $time);

		$pro_id = $_POST["pro_id"];
		$mod_id = $_POST["mod_id"];
		$lesson_id = $_POST["lesson_id"];

		$this->load->model('Tasks_model');
		$date_enrolled = $this->Tasks_model->datebuynow($pro_id, $user_id);

		if(count($date_enrolled) > 0)
		{
			$not_show = true;
		}
		else
		{
			$not_show = false;
		}

		
		if(isset($user_id))
		{
		  
		  if(($not_show === TRUE))
		  {

		   $tets= $this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$mod_id,$pro_id,$currdate);
		   
		   $lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $pro_id);
		   	if(!empty($lesson_viewed2))
			{
				foreach($lesson_viewed2 as $compltData)
				{					
					$marks = '|'.$lesson_id.'|';
				 	if( strpos($compltData->mark_as_completed, $marks) === false )
				 	{				 		
				 		echo"success";
				 		
				 	}
				 	
				 }
			}		 

		  }
		  else
		  {		  

		  echo"<script> alert('You have to Enroll first !!By clicking on Buy Now or Enroll now button');</script>";

		  }

		 }else{

		  $this->template->build('user/login_user');

		}   
    return true;
	}


	function lecctureTitle()
	{

		$pid =$_POST['pro_id'];

		$mod_id =$_POST['mod_id'];

		$lesson_id =$_POST['lesson_id'];

		$days = $this->program_model->getlistDays($pid);

		foreach ($days as $day)
                {
                	//echo"<pre>";
                	//print_r($day);
                	if($mod_id == $day->id)
                	{
                   		echo "<b>".$day->title." :</b> ";
                   
                    	//$lessons = $this->program_model->getLessons($day->id);
                    	$lessons = $this->program_model->getLessonNew($day->id);
                  
                    	foreach ($lessons as $lesson)
                    	{
                    		
                    		if($lesson->id == $lesson_id)
                    		{
                         	echo "<span>".$lesson->name."</span>";           
                            }     
                   		}
                   }
                   
                   
               }
               return true;
	}

	function countmarkcomplate()
	{
		$sessionarray = $this->session->userdata('logged_in');	  	 
		if($sessionarray)
		{
			$user_id = $sessionarray['id'];
			$lesson_id = $_POST['les'];
			$pid = $_POST['pro'];
			$module_id = $_POST['mod'];			
			
			$count_lesson_viewed = $this->lessons_model->countmarkViewLesson($user_id, $pid);
			$removedash = str_replace('||',',',$count_lesson_viewed->mark_as_completed);
			$removedash2 = str_replace('|','',$removedash);		
			$complated_array = explode(',',$removedash2);
			$acceptd_to_count = count($complated_array);


		$pid =$_POST['pro'];

		$mod_id =$_POST['mod'];

		$lesson_id =$_POST['les'];

		$days = $this->program_model->getlistDays($pid);
		$i=0;
		foreach ($days as $day)
                {
                	$lessons = $this->program_model->getLessons($day->id);
              		$countvar1 = count($lessons);
              		 
                	foreach ($lessons as $lesson)
                	{
                		
                        $i++;    
               		}
          
               }
               
            if($i == $acceptd_to_count)
            {
            	//echo"Match";
            	$getPro = $this->lessons_model->getProgramFinalExam($pid);            	
            		if($getPro)
            		{
            		 $final_id = $getPro->id_final_exam;

            		 $data = array('status' => 'Match',
            				  'id_final_exam' => $final_id
            				   );
            		}
            		else
            		{
            		$final_id = "";	
            		$data = array('status' => 'Match',
            				  'id_final_exam' => $final_id
            				   );
            		}
            	
            	echo json_encode($data);
            }
		}
	}

}
?>
