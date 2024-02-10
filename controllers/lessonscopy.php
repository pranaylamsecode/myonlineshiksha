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
		
		$this->load->model('admin/programs_model');
		
		$this->load->model('program_model');
		
		$this->load->model('Category_model');

        $today=getdate();

        $this->th=$today['hours'];

        $this->tm=$today['minutes'];

        $this->tmonth=$today['mon'];

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

	public function lesson()
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
	   //$this->template->set("quizcomment", $this->program_model->getLessonQuery($program_id));
		$this->template->set("quizcomment", $this->program_model->getlessionDiscussion_model2($program_id,$day_id,$lesson_id));
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
	
		$this->template->set("lesson", $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id));
	
		$this->template->set("lessoncontent", $this->Tasks_model->getLessonContent($lesson_id));
	
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

		$currdate = mdate($datestring, $time);

        $count = $this->Tasks_model->countViewedLesson($uid,$program_id);

	   $access = isAccess($program_id,$day_id,$lesson_id);



		if(isset($user_id))
		{
		  //if(($not_show === TRUE) && ($access == true))//commented by yogesh on dated 06-12-2014 , solved issue first for $access
		  if(($not_show === TRUE))
		  {

		  $this->Tasks_model->saveLessonViewed($user_id,$lesson_id,$day_id,$program_id,$currdate);

		  $this->template->build('lessons/lesson');

		  }
		  else
		  {

		  //$this->template->build('user/login_user');

		  echo '<div style="margin-top: 25px; font-family: arial; text-align: center; color: #F9966B;">You have to Enroll first !!<br>By clicking on Buy Now or Enroll now button</div>';

		  }

		 }else{

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
		
		$db_media = $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id);
	    $db_mediatext = $this->Tasks_model->getMedia_oflayout('scr_t',$lesson_id);

	    $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);	   

		$lesson = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);	   
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
	    
		switch($lesson->layoutid)
		{
			case '1':
						$media = $db_media[0]->media_id;
		                $text = $db_mediatext[0]->media_id;
						echo "<div id='media_1'><script type='text/javascript'>jQuery('#media_1').load('".base_url()."lessons/ajaxmediaview/".$media."/1')</script></div><div id='text_1' class='content11'><script type='text/javascript'>jQuery('#text_1').load('".base_url()."lessons/ajaxmediaview/".$text."/1')</script></div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
			case '2':
						$media = $db_media[1]->media_id;
		                $text = $db_mediatext[0]->media_id;
						$media1 = $db_media[2]->media_id;
						
						echo "<div id='media_2'>					
									<script type='text/javascript'>
										jQuery('#media_2').load('".base_url()."lessons/ajaxmediaview/".$media."/2');
									</script>
							</div>
							<div id='text_2' class='content11'>				
									<script type='text/javascript'>
										jQuery('#text_2').load('".base_url()."lessons/ajaxmediaview/".$text."/1');
									</script>
							</div>
							<div id='media_3'>
									<div style='text-align:center'><i></i></div>
										<script type='text/javascript'>
										jQuery('#media_3').load('".base_url()."lessons/ajaxmediaview/".$media1."/1');
										</script>
							</div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'media1'=>$media1,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '3':
						$media = $db_media[2]->media_id;
						$text = $db_mediatext[2]->media_id;
						echo "<div id='media_3'>
								<div style='text-align:center'><i></i></div>
					
									<script type='text/javascript'>
										jQuery('#media_3').load('".base_url()."lessons/ajaxmediaview/".$media."/1');
									</script>
							  </div>
							 <div id='text_3' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_3').load('".base_url()."lessons/ajaxmediaview/".$text."/3');
								</script>
							</div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '4':
						$media = $db_media[4]->media_id;
						$media1 = $db_media[5]->media_id;
						$text = $db_mediatext[3]->media_id;
						echo "<div id='media_5'>					
								<script type='text/javascript'>
									jQuery('#media_5').load('".base_url()."lessons/ajaxmediaview/".$media."/5');
								</script>
							</div>
							<div id='media_6'>
								<script type='text/javascript'>
									jQuery('#media_6').load('".base_url()."lessons/ajaxmediaview/".$media1."/6');
								</script>
							</div>
							<div id='text_4' class='content11'>
								<script type='text/javascript'>
									jQuery('#text_4').load('".base_url()."lessons/ajaxmediaview/".$text."/4');
								</script>
							</div>";
							return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'media1'=>$media1,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '5':
						 $text = $db_mediatext[4]->media_id;
						 echo "<div id='text_5' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_5').load('".base_url()."lessons/ajaxmediaview/".$text."/5');
								</script>
								</div>";
						return true;
						 //$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						 //echo json_encode($querydata);
						 break;
						 
			case '6':
						 $media = $db_media[6]->media_id;
						 echo "<div id='media_7'>
				
									<script type='text/javascript'>
										jQuery('#media_7').load('".base_url()."lessons/ajaxmediaview/".$media."/7');
									</script>
								</div>	";
						return true;
						 //$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						 //echo json_encode($querydata);
						 break;
						 
			case '7':
						$media = $db_media[7]->media_id;
		
						$text = $db_mediatext[5]->media_id;
						echo "<div id='text_6' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_6').load('".base_url()."lessons/ajaxmediaview/".$text."/6');
								</script>
							</div>
							<div id='media_8'>				
								<script type='text/javascript'>
									jQuery('#media_8').load('".base_url()."lessons/ajaxmediaview/".$media."/1');
								</script>
							</div>";
					    return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '8':
						$media = $db_media[7]->media_id;
					    $media1 = $db_media[9]->media_id;						
						$text = $db_mediatext[6]->media_id;
						
						echo "<div id='text_7' class='content11'>
					
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
							</div>	";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '9':
						 $media = $db_media[10]->media_id;
		
						$text = $db_mediatext[7]->media_id;
						echo "<div id='text_8' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_8').load('".base_url()."lessons/ajaxmediaview/".$text."/8');
								</script>
							</div>
							<div id='media_11'>
								<script type='text/javascript'>
									jQuery('#media_11').load('".base_url()."lessons/ajaxmediaview/".$media."/11');
								</script>
							</div>	";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'pro_id'=>$program_id,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '10':
						$media = $db_media[11]->media_id;
						$media1 = $db_media[12]->media_id;
						$text = $db_mediatext[8]->media_id;
						echo "<div id='text_9' class='content11'>
					
								<script type='text/javascript'>
									jQuery('#text_9').load('".base_url()."lessons/ajaxmediaview/".$text."/9');
								</script>
							 </div>
							<div id='media_12'>
					
								<script type='text/javascript'>
									jQuery('#media_12').load('".base_url()."lessons/ajaxmediaview/".$media."/12');
								</script>
							</div>
							<div id='media_13'>
					
								<script type='text/javascript'>
									jQuery('#media_13').load('".base_url()."lessons/ajaxmediaview/".$media1."/13');
								</script>
							</div>";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'media1'=>$media1,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '11':
						$text = $db_mediatext[9]->media_id;		 
						$media = $db_media[13]->media_id;
						$text1 = $db_mediatext[10]->media_id;
						echo "<div id='text_10' class='content11'>					
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
					
						    </div>	";
						return true;
						//$querydata = array('layoutid' => $lesson->layoutid,'media'=>$media,'text'=>$text,'pro_id'=>$program_id,'mod_id'=>$nextmodule_id,'lesson_id'=>$nextless_id,'premodule_id'=>$premodule_id,'preless_id'=>$preless_id);
						//echo json_encode($querydata);
						break;
						
			case '12':
						//echo $program_id.'--'.$lesson_id;
						$dayss = $this->program_model->getlistDays($program_id);
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
										{
											if($lesson_id == $lesson->id)
											{
												$media = $db_media[14]->media_id;
												//$quiz_data = $this->ajaxquizztotask($media,15,'',$program_id);
									            echo "<div id='media_15' >";
												echo $this->ajaxquizztotask($media,15,'',$program_id);
												echo "</div>";
											}
											else
											{
												exit('Cant Give Test');
											}
										}									
									}
								}							
							 					 	
							}
					    }

						/*$media = $db_media[14]->media_id;
						//$quiz_data = $this->ajaxquizztotask($media,15,'',$program_id);
			            echo "<div id='media_15' >";
						echo $this->ajaxquizztotask($media,15,'',$program_id);
						 echo "</div>";*/
						return true;						
						break;
						
			case 'finalexam':								
								echo "<div id='finalexam'>";
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
								echo "</div>";
								return true;
								break;		
		}		
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
		
		echo "<a class='autoplay on' data-name='lectureAutoStart'> Auto Play <span class='autoplay-text-on'>ON</span> <span class='autoplay-text-off none'>OFF</span> </a> <span class='next-lecture' id='next-lecture' style='left: 132px;cursor:pointer'  onclick='nextslide($program_id,$nextmodule_id,$nextless_id)' >NEXT LECTURE</span>";

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
								<b>Mark as Uncompleted</b>
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
			 $lessons = $this->program_model->getLessons($day->id);
			 foreach($lessons as $lesson)
			 {
			 	$array_my[] = $program_id.'^'.$day->id.'^'.$lesson->id.'^'.$counter;
			 	$counter++;
			 }
	    }
	    $nextLink = $srno+1;//pus for next lecture
	    if(!empty($array_my[$nextLink]))
	    {
	    	$data = str_replace('^', ',', $array_my[$nextLink]);
	    	echo "<span class='next-lecture' id='next-lecture' style='left: 132px;cursor:pointer' onclick=nextslide($data)>NEXT LECTURE</span>";
	    }
	    else
	    {
	    	echo "<span class='next-lecture' id='next-lecture' style='left: 132px;'>NEXT LECTURE</span>";	
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
			 $lessons = $this->program_model->getLessons($day->id);
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
	    	echo "<a href='javascript:void(0)'><i class='icon-chevron-up'></i></a><span style='cursor:pointer' onclick='nextslide($data)'>Previous Lecture</span>";	    
	    }
	    else
	    {
	    	echo "<a href='javascript:void(0)'><i class='icon-chevron-up'></i></a><span style='cursor:pointer'>Previous Lecture</span>";	
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



	 //print_r($this->Myinfo_model->getCourses($user_id,$program_id,'')); exit;

	  $programdetail = $this->Tasks_model->getLessonsName($program_id);

	  $programnavarray = $this->Tasks_model->getCoursenavArray($program_id);

	  $idFinalExam = $programdetail[0]['id_final_exam'];

	  $idcertificate = $programdetail[0]['certificate_term'];



	  if(isset($idFinalExam) and ($idFinalExam != 0)){

		$this->template->set("finalexamid", $idFinalExam);

	  }

	  $quizinfo = $this->Tasks_model->getQuiz($idFinalExam);

      //print_r($quizinfo);

      $time_limit=$quizinfo->limit_time;

      $this->template->set("limit_time", $time_limit);



	  if(isset($idcertificate) and ($idcertificate != 0) and isset($user_id)){

		$takenwhere = array(

					'user_id'      => $user_id,

					'quiz_id'      => $idFinalExam

					);

		$quiztakeninfo = $this->Tasks_model->getQuizTaken($takenwhere);

		//print_r($quiztakeninfo);

		$first= explode("|", @$quiztakeninfo[0]->score_quiz);

		@$res = intval(($first[0]/$first[1])*100);

		if($res >= $quizinfo->max_score){

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

	function saveInDbQuiz(){





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

		$pdffile = base_url().'public/uploads/documents/'.$media->local;

		echo '<div style="max-width:680px; max-height:900px; overflow:scroll;align:center">'; // 

		//echo '<iframe src="http://docs.google.com/gview?url='.$pdffile.'" frameborder="0"></iframe>';

		//echo read_file('public/uploads/documents/'.$media->local);

		//echo file_get_contents(base_url().'public/uploads/documents/'.$media->local);

		echo '<a href="'.base_url().'public/uploads/documents/'.$media->local.'" target="_blank">'.base_url().'public/uploads/documents/'.$media->local."</a><br>The selected element is a text file that can't have a preview";

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

		echo "This file can't have a preview";

		exit;

		}elseif(isset($media->type) && $media->type == "image"){

		echo "<img  src=\"".base_url()."public/uploads/images/".$media->local."\">";

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

							controlbar: 'bottom',

                            primary: "flash",
							
							autostart: true,
							
							skin: "bekle",

							width: '400',

							height: '300'

						});

					</script>



	<?php

	}

	public function uploadwebshorts(){

   //echo $_POST['imagedata'];

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
	
// Helper	
	function ajaxquizztotask($media_id = NULL, $frame_id = NULL, $programdetail,$pro_id = NULL,$viewque = NULL){





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


     /* echo "<pre>";


         print_r($quizz);


      echo "</pre>"; */


	$qids = array();





	if(@$quizz->is_final)


    {





	$quizzFinal = $CIq->quizzes_model->getFinalQuizz($media_id);





    /* echo "<pre>";


         print_r($quizzFinal);


      echo "</pre>";     */





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





	$quiztaken = $CIq->quizzes_model->getQuizTaken(@$quizz->id,$userid,$pro_id);


    //print_r($quiztaken);


   // print_r($viewque);


   /* if($viewque){


      $view = 'result';


    }else{


      $view = 'exam';


    }*/


    $view = '';


   //	(int) $timequiztakenbyuser = (empty($quiztaken)) ?  intval($quizz->time_quiz_taken)-1 : $quiztaken->time_quiz_taken_per_user;


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


        else{





            $remainingExamTimes = intval($quizz->time_quiz_taken) - intval($quiztaken->time_quiz_taken_per_user);


    	}


    }








	?><?php if($view != 'result'){





    // $quizz->show_countdown;


    ?>


	<?php if(@$quizz->show_countdown == '0')


    {


     //echo "Helllo";


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





   <?php }?>








	<span class="quiz_title"><?php //echo $quizz->name;?></span>


    <?php //print_r($quizz); ?>


	<div class="quiz_timer">


		<table><tbody>


		<tr><td><?php if(@$quizz->show_limit_time == '0'){?>Quiz time limit: <span style="color:#669900"><?php echo $quizz->limit_time;?></span> minutes


		<?php }?>	</td>


		<td style="padding-left:25px;"><?php if(@$quizz->pbl_max_score == '0'){?>Minimum score to pass this quiz: <span style="color:#669900"><?php echo $quizz->max_score;?>%</span>


         <?php }?>


        </td>


		</tr>


		<tr><td>Questions: <span style="color:#669900"><?php echo count($questions);?></span></td><td style="padding-left:25px;"><?php if(@$quizz->show_nb_quiz_taken == '0'){?>This quiz can be taken up to: <span style="color:#669900"><?php echo $quizz->time_quiz_taken;?></span> times<?php }?></td>


		</tr></tbody></table>


		


		<table><tbody>


		<?php if((@$quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){


        //echo $remainingExamTimes;


        ?>


		<tr><td style="padding-top:15px;">You can give exam <?php echo $remainingExamTimes;?> more times</td></tr>


		<?php }?>


		<tr><td style="padding-top:15px;">You can always see your quiz results on your My Courses page</td></tr>


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


		//print_r($que);


		$qindex++;


		$anskey = array();


		$anskey = explode('|||',$que->answers);


		echo '<ul>';


		echo '<li class="question"><b>'.$qindex.' </b>'.$que->text;


		echo '</li>';


		$rightansstring = array();


		$allansstring = array();


			for($qi=1; $qi<=10; $qi++){


			$qin='a'.$qi;


				if($que->$qin != '' && isset($que->$qin) && $que->$qin != null){


				$nidell = $qi.'a';


				//echo '<br>';


				echo '<li class="answer">';


				//echo (in_array($nidell,$anskey))? '<input type="checkbox" />' : '<input name="q'.$qi.'" onclick="javascript:setQuestionValue(1, \'aa\',\'2a \')" type="checkbox"/>';


				echo '<input name="q'.$qindex.'" value="'.$qi.'a'.$qindex.'" onclick="javascript:setQuestionValue('.$qindex.', \''.$que->$qin.'\',\''.$qi.'a\')" type="checkbox"/>';


				echo $que->$qin;


				echo '</li>';


				if(in_array($nidell,$anskey)){ 


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


<input type="button" onclick="get_quiz_result();" value="Submit" id="submitbutton" class="btn btn-sm btn-success btn-update" name="submitbutton">


</div>


<?php


if(!isset($_COOKIE['m1']) && !isset($_COOKIE['m2'])){


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


  	if($res < intval($quizz->max_score)){


		@$quiz_result_content .='<div class ="quiz-timer">';


		$quiz_result_content .='<span> Quiz Failed. Your score: <span style="color:#669900;">'.$score.'</span>, Minimum score to pass is: <span style="color:#669900;">'.$quizz->max_score.'%</span></span>';


		$quiz_result_content .='</div><br/>';








	}else{


		@$quiz_result_content .="";


		if(isset($programdetail['certificate_term']) and $programdetail['certificate_term']>0){


		$quiz_result_content .="<div style=\"border: 1px solid #FFCC00; background-color:#F7F7F7; padding:10px;\">";


		$quiz_result_content .="<span style=\"font-size:16px;\">Congratulations for passing the final exam! You are now eligible for a certificate for this course.Go to <a href=\"#\">My Certificates</a> to view, share and download your certificate.</span><br></div>";


		}





		$quiz_result_content .='<div class ="guru-quiz-timer">';


		$quiz_result_content .='<span>Quiz Passed!. Your score:<span style="color:#669900;">'.$score.'</span> Minimum score to pass is: <span style="color:#669900;">'.$quizz->max_score.'%</span></span>';


		$quiz_result_content .='<br/>'.'<span>Congratulations!</span>';


		$quiz_result_content .='<br/></br>'.'<span>Please continue this course by clicking the next button on top</span>';


		$quiz_result_content .='</div><br/>';


        $statust="Timeout";


		}


		$qindex = 0;


	echo $quiz_result_content;


	echo '<div id="the_quiz">';


	//print_r($questions);


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


		//echo '<ul class="result_list">';


    	//echo '<li class="'.$qclass.'"><b>'.$qindex.' </b>'.$que->text;


    	//echo '</li>';


    	for($qi=1; $qi<=10; $qi++){


  	    $qin='a'.$qi;


  		if($que->$qin != '' && isset($que->$qin) && $que->$qin != null){


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


?>





<?php


	//	}	


		echo '</div>';


	}


?>











<?php


     //echo base_url().'lessons/stopWeb';


  //return $statust;


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
	$data =array( 'pid' => $_POST['pro'],
			'module_id' => $_POST['mod'],
			'lesson_id' => $_POST['les'],
			'notes' => $_POST['message'] 
		   );
		 $this->lessons_model->saveNotes_model($data);  
		
	}
	public function getNotes()
	{
	//exit("get");
	$data =array( 'pid' => $_POST['pro_id'],
			'module_id' => $_POST['mod_id'],
			'lesson_id' => $_POST['lesson_id']			 
		   );
		 $result = $this->lessons_model->getNotes_model($data);
		 //echo"<pre>";
		 //print_r($result);
		 //echo"</pre>";
        if($result)
		{		
		foreach($result as $result1)
		{
		//echo"<li><p>".$result1->notes ."</p></li>";
		echo"<li onmouseover ='showdel($result1->nid)' onmouseout ='hidedel($result1->nid )' ><p> => &nbsp <span id='span$result1->nid' onclick ='showarea($result1->nid);'>$result1->notes</span><textarea id ='area$result1->nid' onblur='showspan($result1->nid );' style='width: 202px; display :none' onkeydown ='updateNote($result1->nid );' >$result1->notes </textarea> &nbsp <span id ='delspan$result1->nid' onclick ='delNotes($result1->nid);' ></span> </p></li>";
		}		
		}
		else
		{
		echo"";
		
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
		
			if(!empty($lesson_viewed2))
			{
				foreach($lesson_viewed2 as $compltData)
				{					
					$marks = '|'.$lesson_id.'|';
				 	if( strpos($compltData->mark_as_completed, $marks) !== false )
				 	{
				 		$lessonData = str_replace($marks,'',$compltData->mark_as_completed);//if found then replace to blank

				 		echo "<div onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Completed</b></span></div>";
				 	}
				 	else
				 	{
						$lessonData = $compltData->mark_as_completed.$marks;//if not found then concat two fields
						echo "<div style='background:#17aa1c' onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Uncompleted</b></span></div>";
				 	}
				}
				$this->lessons_model->updateViewLesson($lesson_id,$user_id,$pid,$module_id,$lessonData);
			}
			else
			{
				$lessonData = '|'.$lesson_id.'|';
				$this->lessons_model->updateViewLesson($lesson_id,$user_id,$pid,$module_id,$lessonData);	
				echo "<div style='background:#17aa1c' onclick ='markCompleted();' class='mark mini-tooltip'>
					         	<span class='tooltip-content'><b>Mark as Uncompleted</b></span></div>";
			}
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
				 		echo "<div style='background:#17aa1c' onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Uncompleted</b></span></div>";				 		
				 	}
				 	else
				 	{
						//if not found then show black
						echo "<div onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Completed</b></span></div>";
				 	}
				}				
			}
			else
			{				
				echo "<div onclick ='markCompleted();' class='mark mini-tooltip'><span class='tooltip-content'><b>Mark as Completed</b></span></div>";
			}
		}
	}

}

    ?>