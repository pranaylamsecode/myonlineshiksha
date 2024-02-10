<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercertireport extends MLMS_Controller {

	function __construct()
	{
		parent::__construct();
         $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/Userreport_model');
       // $this->load->model('Myinfo_model');
       // $this->load->model('Tasks_model');
        $this->load->helper('time_difference');
		$this->lang->load('tooltip', 'english');

        $this->load->helper('cookie');

        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);

	}


	public function index()
	{

        $this->template->set_layout('backend');

        $this->template->set('action',"coursereport");



        $this->template->set("enrollcertidetail", $this->Userreport_model->getSpecficEnrollDetail()); //

        $this->template->build('admin/usercertireport/viewreport');


	}


     public function courseDetail(){

            $courseid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

            $enrolllist=$this->Userreport_model->getEnrolledUser($courseid);

            $this->template->set_layout('backend');

            $this->template->set('action',"courseenrollreport");



            $this->template->set("enrolledusers", $enrolllist);

            $this->template->build('admin/userreport/viewreport');



      }

      public function viewcertificate(){

      $this->template->set_layout('backend');

      $qtid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

      $this->template->set("quizdetail", $this->Userreport_model->getQuizTakenById($qtid));


      $this->template->build('admin/usercertireport/aprovecertificate');

   }

   public function approvecerti()
   {
     $qtid=$this->input->post('qtid');
     if($this->Userreport_model->updateIssuedStatus($qtid))
     {
       redirect('admin/usercertireport/');
     }
     redirect('admin/usercertireport/');

   }


    public function view(){
        //$tmpl = "default";
        //$this->template->set("tmpl", $tmpl);
        //$this->template->set("category", $this->categs_model->getCateg());
		//$this->template->build('gurucategs/gurupcategs');
	}

	function enroll()
    {
		$this->load->model('Program_model');
		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		$group_id = $sessionarray['groupid'];
		$course_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
        if (!$course_id){
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
		if($graybox == "true" || $graybox == "1"){
			//$model = $this->getModel("guruProgram");
			$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);

			if($result == 'now'){			
				$msg = "Enrolled Successfully! You can find this course under 'my courses' page";
			}
			else{
				$msg = "You have successfully enrolled to the course. Begin learning now!";
				
			}
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $msg ));
					
			//$_SESSION["joomlamessage"] = $msg;
			echo '<script type="text/javascript">';
			echo 'window.parent.location.reload();';
			echo '</script>';
			die();
		}
		if( !isset($user_id) || $user_id == 0){
			redirect('users/login');
		}
		else{
		//for admin
    	if($group_id == 4 || $result->author == $user_id){
    	$where = array('userid' => intval($user_id), 'course_id' =>  intval($course_id), 'order_id >=' =>  '0');
    	$adresult = $this->Program_model->getBuyCourses($where);
    	$adresult = count($adresult);//exit(print_r($adresult));
       // print_r($adresult);
    		if($adresult == 0 ){
    		$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
           // print_r($result);
    		}else{
    		redirect($course_page);
    		}
	}
	//end
		
		
		
			//$model = $this->getModel("guruProgram");
			//if(isset($registered_user) && $registered_user == 1){
			if(isset($user_id) && $user_id != 0){ 
				if($chb_free_courses == 1 && $step_access_courses !=0){ 
					$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
				}
				elseif($chb_free_courses == 1 && $step_access_courses ==0 && $selected_course ==-1){
					if($this->hasAtLeastOneCourse($course_id)){
						$result = $this->Program_model->enroll(intval($user_id),intval($group_id), $course_id);
					}
					else{
						redirect($course_page);
					}
				
				}
				elseif($chb_free_courses == 1 && $step_access_courses ==0 && $selected_course !=-1){
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
			if($result == 'now'){	
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Enrolled Successfully! You can find this course under 'my courses' page" ));
				redirect($course_page);
			}
			elseif($result == 'old'){
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "You have successfully enrolled to the course. Begin learning now!" ));
			redirect($course_page);	
			}
			elseif($result == ''){
				redirect($course_page);
			}
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
		if(!empty($BuyCourses)){
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
			$expired_date_int = strtotime($expired_date_string);
			$current_date_string = mdate($datestring, $time);
			$current_date_int = strtotime($current_date_string);
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
				$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."buyitems/buynow/".$course_id.'\';" value="Buy now" name="Buy" />';
				$expired = true;
			}
		}
		else{ 
			//$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.JRoute::_("index.php?option=com_guru&view=guruPrograms&task=buy_action&course_id=".$course_id."&Itemid=".$itemid).'\';" value="'.JText::_("GURU_BUY_NOW").'" name="Buy" />';
			$return .= '<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."buyitems/buynow/".$course_id.'\';" value="Buy now" name="Buy" />';
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
			if($step_access_courses == 0 && !$expired){// Students
			if($selected_course == '-1'){// any course
					if($user_id == 0){//not logged
						$return = '	<div>
												<div class="'.$buy_background.'">This course is FREE for students of any of our courses! Are you a student?&nbsp;&nbsp;
													<input type="button" style="" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
												</div>
												<div class="'.$buy_background.'">Not a student?&nbsp;&nbsp;
													<input type="button" style="" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'buyitems/buynow/'.$course_id.'\';" value="Buy now" name="Buy" />
												</div>
										</div>';
					}
					else{
						if($this->hasAtLeastOneCourse($course_id)){
							$return = '	<div>
												<div class="'.$buy_background.'">This course is yours FREE because you are a student&nbsp;&nbsp;
													<input type="button" style="" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
												</div>
										</div>';
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
													<input type="button" style="" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
												</div>

												<div style="" class="'.$buy_background.'">Not a student?&nbsp;&nbsp;
													<input type="button" style="" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'buyitems/buynow/'.$course_id.'\';" value="Buy now" name="Buy" />
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
										foreach($result as $key=>$course){
											//$all_title[] = '<a href="'.JRoute::_("index.php?option=com_guru&view=guruPrograms&layout=view&cid=".$course["id"]."&Itemid=".$itemid).'">'.$course["name"].'</a>';
										$all_title[] = '<a href="">'.$course->name."</a>";
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
														<input type="button" style="padding: 0px;" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url().'programs/enroll/'.$course_id.'\';" value="Enroll Now" name="Enroll" />
													</div>
											</div>';
							}
						//}
					}
				}
			}
			elseif($step_access_courses == 1){// Members
				$return = '<div>
										<div class="'.$buy_background.'">This course is FREE for members!&nbsp;&nbsp;
											<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
										</div>
								</div>';
			}
			elseif($step_access_courses == 2){// Guest
				$return = '<div>
										<div class="'.$buy_background.'">This course is FREE!</div>
										<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
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
												<input type="button" class="'.trim($buy_class).'" onclick="document.location.href=\''.base_url()."programs/enroll/".$course_id.'\';" value="Enroll Now" name="Enroll" />
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
	

	function get_time_difference($start, $end){
    $uts['start'] = $start;
    $uts['end'] = $end;
    if( $uts['start'] !== -1 && $uts['end'] !== -1){
		if($uts['end'] >= $uts['start']){
            $diff = $uts['end'] - $uts['start'];
            if($days=intval((floor($diff/86400)))){
                $diff = $diff % 86400;
			}
				
            if($hours=intval((floor($diff/3600)))){
                $diff = $diff % 3600;
			}	
            
			if($minutes=intval((floor($diff/60)))){
                $diff = $diff % 60;
			}	
            $diff = intval($diff);
            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff));
        }
		else{
			return false;
		}
    }
    return false;
}	
	
function buySelectedCourse($selected_course){
	$sessionarray = $this->session->userdata('logged_in');
	$user_id = $sessionarray['id'];
	$all_courses1 = $this->Program_model->getBuyCoursesDistinctID(intval($user_id));
	$all_courses = array();
	foreach($all_courses1 as $allval){
	$all_courses[] = $allval['course_id'];
	}
	//$sql = "SELECT distinct(`course_id`) FROM #__guru_buy_courses where `userid`=".intval($user_id);
	//$all_courses = $db->loadResultArray();
	$selected_course_final = explode('|', $selected_course);
	$intersect = array_intersect($selected_course_final, $all_courses);//exit(print_r($all_courses));
	if(count($intersect)>0){
		return true;
	}
	else{
		return false;
	}
}


function addStudent($roomid,$firstname,$email)
{



        /******<Segments********/
        $email = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $email;
        $firstname = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $firstname;
        $roomid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $roomid;

        /******Segments>********/
        $this->load->helper('unirowclient');


        $apikey = "4baf11ac9f3ab7e326b8ff1e48887ffa";
        $domain = "sailorsclub.unirow.com";
        $username = "sailorsclub";
        $password = "sailorsclub@2013";

       $unirowclient = new unirowClient;
       $unirowclient->connect($username,$password, $domain, $apikey);

        $title ="Welcome to VeerIT";
        $redirectURL="http://www.google.com";
        //meeting Id
        $id = "";

        // select the mode you want to start the session =>
        // mode is webinar for learning session

        $mode = "webinar";

        $ishost = "0";   // 0 for student


        $startrecording = "0";

        //if deduplicate is set to 1 single user can enter from 2 computers.
        $deduplicate = "1";

        //external user id to check if the user already exists in the session
        $ext_user_id = "100";

       // $student = $unirowclient->addUserToRoom($ext_user_id, $firstname, $email, $ishost, $roomid, $id, $title, $redirectURL,$mode, $startrecording, $deduplicate);

        //$this->template->set("stud", $student);
       //return $student;

       return $title;
    }


}
?>