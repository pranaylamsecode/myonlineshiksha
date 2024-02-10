<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studreport extends MLMS_Controller {

	function __construct()
	{
    		parent::__construct();
        error_reporting(0);
    		$this->authenticate();
        $this->load->helper('form');
    		$this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Studreport_model');
    		$this->load->model('admin/programs_model');
    		$this->load->model('admin/users_model');
        $this->load->helper('time_difference');
        $this->load->helper('pages');
    		$this->lang->load('tooltip', 'english');
        $this->load->helper('cookie');
    		$this->load->model('admin/settings_model');
        $this->load->model('lessons_model');
         $this->load->model('Myinfo_model');

        if($this->uri->segment(2) != 'viewsnap')
        {
            //my new code for template setting
            $configarr = $this->settings_model->getItems(); 
            $this->configarr = $configarr;
            $this->template->set_layout($configarr[0]['layout_template']);
            $this->template->set("configarr", $configarr);
            $tmpl = $this->configarr[0]['layout_template'];
            $this->template->set("tmpl", $tmpl);

            date_default_timezone_set($configarr[0]['time_zone']);
        }
	}

	function authenticate()
  {		
		  $session = $this->session->userdata('logged_in');
      if(!$this->session->userdata('logged_in'))
      {
        redirect('users/login');
      }
  }

	public function index()
	{
        $configarr = $this->settings_model->getItems(); 
        $this->configarr = $configarr;
        // $this->template->set_layout($configarr[0]['layout_template']);
        // $this->template->set("configarr", $configarr);
        $tmpl = $this->configarr[0]['layout_template'];
        // $this->template->set("tmpl", $tmpl);
        // $this->template->title("Certificates");
        // $this->template->set('action',"coursereport");
        $loggeduserdata = $this->session->userdata('logged_in');
        $userId = $loggeduserdata['id'];
        // $this->template->set("courses", $this->Studreport_model->getPrograms($userId)); 
		    // $this->template->set("coursesComp", $this->Studreport_model->getcourseCompleted($userId));

        $data['tmpl'] = $tmpl;
        $data['configarr'] = $configarr;
        $data['title'] = 'Certificates';
        $data['action'] = "coursereport";
        $data['courses'] = $this->Studreport_model->getPrograms($userId);
        $data['coursesComp'] = $this->Studreport_model->getcourseCompleted($userId);


           $this->load->view('new_template_design/header', TRUE);
           $this->load->view('studreport/viewreport', $data);
           $this->load->view('new_template_design/footer');
        // $this->template->build('studreport/viewreport');
	}

	public function designStructure()
	{
        $configarr = $this->settings_model->getItems(); 
        $this->configarr = $configarr;
        $this->template->set_layout($configarr[0]['layout_template']);
        $this->template->set("configarr", $configarr);
        $tmpl = $this->configarr[0]['layout_template'];
        $this->template->set("tmpl", $tmpl);

        $this->template->set('action',"coursereport");
        $loggeduserdata = $this->session->userdata('logged_in');
        $userId = $loggeduserdata['id'];
       // $this->template->set("courses", $this->Studreport_model->getPrograms($userId)); 
		   //$this->template->set("coursesComp", $this->Studreport_model->getcourseCompleted($userId));
        $this->template->build('studreport/designStructure');
	}
	
	function sales($parent_id = NULL)
    { 
        $this->template->set_layout('backend');
        $this->authenticate();
        $sess_orders = $this->session->userdata('sess_orders');
		//print_r($sess_orders);
		
        if($this->input->post('reset') == 'Reset')
		{
			$search_string = $this->input->post('search_text', TRUE);		   
			$search_period = $this->input->post('period', TRUE);			
			$search_cate = $this->input->post('catid', TRUE);
			//$this->input->post('search_text')='';
			$this->session->unset_userdata('sess_orders');
			$search_string = '';
			$search_period = '';
			$search_cate = '';
		}
		else
		{
			$search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_orders['searchterm'];
			$search_period = ($this->input->post('period', TRUE)) ? $this->input->post('period', TRUE) : $sess_orders['searchperiod'];
			$search_cate = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_orders['searchtcate'];
			$searchdata = array(
						"searchterm" => $search_string,
						"searchtcate" => $search_cate,
						"searchperiod" => $search_period
						);
			$this->session->set_userdata('sess_orders', $searchdata);
        }

		$path = base_url() . "admin/studreport/sales";
		$start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;	   
		$baseurl = base_url() . "admin/studreport/sales";
		$this->load->library('pagination');
		$config["base_url"] = $baseurl;
		$config['per_page'] = 10;
		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 4;
		$config['total_rows'] = $this->users_model->getSalesCount($search_string);	   
		//echo $this->users_model->getOrdersCount($search_string);
		$this->template->title('Sales Report');
		$this->pagination->initialize($config);
		$this->template->set("program", $this->programs_model->getProgram());
		$this->template->set("orders", $this->users_model->getSales($config['per_page'],$start,$search_string,$search_period,$search_cate));	   
		$this->template->set("countorders", $this->users_model->getcountOrders());
		$this->session->unset_userdata('sess_orders');
		$this->template->build('admin/studreport/viewsalesreport');
    }
	
	
	
	public function studentstati()
	{
      $this->template->set_layout('backend');
      $this->template->set('action',"coursereport");
      $this->template->set("courses", $this->Studreport_model->getPrograms()); 
      $this->template->build('admin/studreport/studentstati');
	}

    public function viewusers()
    {

        $pid = $this->uri->segment(3);
        $u_data = $this->session->userdata('logged_in');
        $authorOf = $this->Studreport_model->courseCreatedBy($pid);
        if((@$authorOf[0]->author != $u_data['id'] && $u_data['groupid'] != '4') || empty($authorOf))
        {
          redirect('category/pagenotfound'); 
        }

       $courseid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
       $enrolllist=$this->Studreport_model->getEnrolledUser($courseid);
       $this->template->set('action',"courseenrollusers");
       $this->template->title("Enrolled Users");
       $this->template->set("enrolledusers", $enrolllist);
       $this->template->build('studreport/viewreport');
    }
		
	public function viewCourseComplusers()
    {
        $this->template->title("Students");
       $courseid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
       $userCClist=$this->Studreport_model->getcourseCompleted($courseid);
       $this->template->set('action',"courseCompleteusers");
       $this->template->set("CourseCompusers", $userCClist);
        $this->template->build('studreport/viewreport');
    }
	
	public function viewquizcomplusers()
  {
      $progid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
			$userCClist=$this->Studreport_model->getcourseCompleted($progid);
			$quizinfo = $this->programs_model->getCountNumQuiz($progid);
      $this->template->set('action',"quizCompletedUsers");
		  $this->template->set("CourseCompusers", $userCClist);
      $this->template->set("quizinfo", $quizinfo);
      $this->template->title("Students");
      $this->template->build('studreport/viewreport');
  }
	
	public function coursestati()
	{
	    $this->authenticate();
        
        $this->session->unset_userdata('sess_programs');
        $this->template->set_layout('backend');
        $this->template->title('Courses Statistics');
        $sess_programs = $this->session->userdata('sess_programs');
		
		$u_data=$this->session->userdata('logged_in');
        $maccessarr=$this->session->userdata('maccessarr');
		
		 if(($u_data['groupid']==='4') || ($maccessarr['courses']=='modify_all'))
         $progassign=$this->programs_model->getItemsStat();
      /* else
       $progassign=$this->programs_model->getItems1($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$u_data['id']);*/

    

       $this->template->set("programs",$progassign);
       $this->template->set('categories',$this->programs_model->getcategories());
		
		//$configarr = $this->settings_model->getItems(); 
		//$this->template->set("configarr", $configarr);
		$this->template->set_layout('backend');		
		$this->template->build('studreport/statistics');
	}

    public function viewsnap()
    {
      $snapfoldername = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
      $attempt_no = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
        $attempt_code = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

         $activeData = $this->Studreport_model->getActiveData($attempt_code);     

       $this->template->set("activeData",$activeData);
       
      $this->template->set("snapfoldername",$snapfoldername);
      $this->template->set("attempt_no",$attempt_no);
      $this->template->build('studreport/viewsnap');
    }

   public function viewuserreport()
   {  
      $pid = $this->uri->segment(4);
      $u_data = $this->session->userdata('logged_in');
      $authorOf = $this->programs_model->courseCreatedBy($pid);
      if((@$authorOf[0]->author != $u_data['id'] && $u_data['groupid'] != '4') || empty($authorOf))
      {
        redirect('category/pagenotfound'); 
      }

      $loggeduserdata = $this->session->userdata('logged_in');
      $userId = $loggeduserdata['id'];
      $userid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
      $progid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

       $userinfo=$this->Studreport_model->getUserInfo($userid);

       $courseinfo=$this->Studreport_model->getProgramById($progid);
       $finalexamid=$courseinfo->id_final_exam;
       $certterm=$courseinfo->certificate_term;

       $quizinformation = $this->programs_model->getCountNumQuizByUser($userid,$progid);

       if($finalexamid)
       {
           $coursequizinfo=$this->Studreport_model->getQuizTakenByUIdPID($userid,$progid,$finalexamid);
           
           
           
           if(count($coursequizinfo)>0)
           {
            if($coursequizinfo[0]['score_quiz'])
            {
              list($rq,$tq)=explode('|',$coursequizinfo[0]['score_quiz']);
              @$res=($rq/$tq)*100;
             }
             else
             {
                $res = 0;
             }
           }
           else
           {
              $res=0;
           }
       }
       else
       {
          $coursequizinfo=array();
          //$coursequizinfo2=array();
          $rq=0;
          $tq=0;
          $res=0;
       }

       $coursecompleted=$this->Studreport_model->courseCompleted($userid,$progid); // view all lession
       $quizinfo=$this->Studreport_model->getQuiz($finalexamid);
       $scores_avg_quizzes=$this->Studreport_model->getAvgScoresQ($userid,$progid);
       $avg_quizzes_cert=$this->Studreport_model->getAvgpercert();

       $hascertficate =FALSE;
       if($certterm == 2)
       {
            if(count($coursecompleted)>0)
            {
               if($coursecompleted->completed == '1'){
                    $hascertficate = TRUE;
                }
                else{
                    $hascertficate = FALSE;
                }
            }
            else
            {
                $hascertficate = FALSE;
            }

       }

       if($certterm == 3)
       {
                if($res >= @$quizinfo->max_score)
                {
                    $hascertficate = TRUE;
                }
                else
                {
                    $hascertficate = FALSE;
                }
       }

       if($certterm == 4)
       {
                if($scores_avg_quizzes >= intval($avg_quizzes_cert)){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            $hascertficate = FALSE;
       }

       if($certterm == 5)
       {
            if(count($coursecompleted)>0)
            {
                if($coursecompleted->completed == '1' && isset($quizinfo->max_score) && $res >= intval($quizinfo->max_score)){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            }
            else
            {
               $hascertficate = FALSE;
            }
       }

       if($certterm == 6)
       {
            if(count($coursecompleted)>0)
            {
                if($coursecompleted->completed =='1' && isset($scores_avg_quizzes) && ($scores_avg_quizzes >= intval($avg_quizzes_cert))){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            }
       }

      $this->template->set("quizinformation", $quizinformation);
        $this->template->set('finalexamcomplete',$res);

       $this->template->set('action',"userdetail");
       $this->template->set("userinfo", $userinfo);
       $this->template->set("courseinfo", $courseinfo);
       $this->template->set("coursequizinfo", $coursequizinfo);
      // $this->template->set("coursequizinfo2", $coursequizinfo2);
       $this->template->set("hascertficate", $hascertficate);
        $this->template->set("certterm", $certterm);
       $this->template->build('studreport/viewreport');
   }

   public function pendings()
  {
        
        $this->template->set('action',"coursereport");

        $user = $this->uri->segment(3);
        $program = $this->uri->segment(4);
        $exam = $this->uri->segment(5);        
        $attempt = $this->uri->segment(6);

        $this->template->set("pendings", $this->Studreport_model->getPendings($user, $exam, $program, $attempt)); 
        $this->template->set("user_id", $user);
        $this->template->set("exam_id", $exam);
        $this->template->set("program_id", $program);
        $this->template->set("attempt", $attempt); 

        //$this->template->set("coursesComp", $this->Studreport_model->getcourseCompleted());
         
        $this->template->build('studreport/pendings');
    }

    function pendingSave()
    {
      
       
       
    $totalMarksObtained = 0;
    $totalMarksOutOf = 0;
    $totalMarksOutOf1 =0;
    $total =0;
    $totalMarksofmulti =0;

        $explode_id = explode('^', $this->input->post('txtGenerate'));   

        $user = $explode_id[0];
        $mediaid = $explode_id[1];
        $proid = $explode_id[2];
        $attempt_code = $explode_id[3];

        $quizzes_ids = $this->lessons_model->getQuestionIds($mediaid);        
        foreach($quizzes_ids as $ids)
        {
          $idd = explode(',', $ids->quizzes_ids);
          foreach($idd as $key=>$my_quiz)
          {
            $data_right = $this->lessons_model->getQuizRightAnswersForPendings($my_quiz);
    //new code start
            $CI = & get_instance();
            $CI->load->model('admin/questions_model');

        foreach($data_right as $correctans)
          {
            if($correctans->is_correct_answer == 1  || $correctans->is_correct_answer == 'True'  || $correctans->is_correct_answer == 'False'  || $correctans->ans_option == 'subjective' || $correctans->question_type == 'match_the_pair' || ($correctans->question_type == 'multiple_type' && $correctans->is_correct_answer == 0))
                     {
                         $totalMarksOutOf+= $correctans->points;
                     }    

         $givenData =  $CI->questions_model->getGivenAnsOptions($correctans->question_id,$proid,$attempt_code,$correctans->option_id);
                       $givenDatasecond =  $CI->questions_model->getGivenAnsOptionsecond($correctans->question_id,$proid,$attempt_code);        
                               

                               foreach($givenData as $givenans)
                                       {

                                         
                                        } 

          
                              if($correctans->question_type == 'match_the_pair')
                               {
                                       if( $correctans->is_correct_answer == $givenans->answers_gived)
                                       {
                                               $totalMarksObtained+= $correctans->points;
                                       }

                               }
                               else if($correctans->question_type == 'true_false')
                               {       
                                    if($givenDatasecond)
                                    {                                                 
                                       if( $correctans->is_correct_answer ==  $givenDatasecond->answers_gived)
                                       {
                                                $totalMarksObtained+= $correctans->points;
                                        }
                                    }
                               }
                               else if($correctans->question_type == 'multiple_type')
                               {        
                               if( $correctans->is_correct_answer ==  $givenans->answers_gived)
                                       {                                                        
                                       $totalMarksObtained+= $correctans->points;
                                       }                                                                
                               }
                               
                               else if($correctans->question_type == 'regular' && $correctans->option_id)
                               {        
                                  if($givenDatasecond)
                                  {
                                       if( $correctans->option_id == $givenDatasecond->answers_gived)
                                       {                                                         
                                       
                                               $totalMarksOutOf2 = $this->questions_model->getcorrectans($correctans->question_id,$correctans->option_id);        
                                        $iscorrect = $totalMarksOutOf2->is_correct_answer;
                                        if($iscorrect == 1)
                                        {
                                         $totalMarksObtained+= $totalMarksOutOf2->points;
                                        }
                                  
                                      }

                                   }
                               }
                               else if($correctans->question_type == 'media_type' && $correctans->option_id )
                               {        
                                    if($givenDatasecond)
                                      {
                                       if( $correctans->option_id ==  $givenDatasecond->answers_gived)
                                       {                                                         
                                       
                                               $totalMarksOutOf2 = $this->questions_model->getcorrectans($correctans->question_id,$correctans->option_id);        

                                        $iscorrect = $totalMarksOutOf2->is_correct_answer;
                                           if($iscorrect == 1)
                                           {
                                         $totalMarksObtained += $totalMarksOutOf2->points;
                                            }
                                  
                                       }
                                     }
                                   
                               }   

                               else if($correctans->question_id && $correctans->question_type == 'subjective')
                              {
                       
                              $textbx = 'txtEnterScore'.$correctans->question_id; 
                               $data = array('obtain_marks' => $this->input->post($textbx));
                               $obtainupdatemark = $this->lessons_model->updateobtainmarks($proid,$correctans->question_id,$user,$attempt_code,$data); 
                               $totalMarksObtained+= $this->input->post($textbx);                 

                      
                            }  
      
                      }

  //new code end here  
             
        } 
            
               
        $myScore = $totalMarksObtained.'|'.$totalMarksOutOf;
                     //exit();  
            $maxmarks = $this->lessons_model->getMaxmarksExam($mediaid);
      $total_per = $totalMarksObtained / $totalMarksOutOf *100;
       $total_per = round(@$total_per,2);
      $maxmarks = round(@$maxmarks->max_score,2);

      
      
     if(@$total_per >= @$maxmarks)
      {
        


          $myresult = 'Pass';

          $dataIns = array(
            'score_quiz' => $myScore,            
            'result' => $myresult,            
          );
      $this->lessons_model->updateScoreMarksForPendings($user, $proid, $mediaid, $attempt_code, $dataIns);

           $cert_term = $this->lessons_model->getCertficateTermByPro($proid);
          

          if($cert_term == '3')
          {

            //$this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
          }

          if($cert_term == '4')
          {
            
            $getquizcourses = $this->Myinfo_model->getQuizCourses($proid);
            
                $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';
                $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);   

                                $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

                                 $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;
                          

                                $scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user,$proid);

                                

                                                             
                        if($scores_avg_quizzes)
                        {
                          if($scores_avg_quizzes >= intval($getmax_score))
                            {
                              $this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
                            }
                        }
              
           }

          if($cert_term == '5')
          {

            $sql = "SELECT `lesson_id` from mlms_viewed_lesson WHERE `user_id` =".intval($user)." and pid=".$proid;
            $query = $this->db->query($sql);

            $result1 = $query->row();
            if(!empty($result1))
            {
              $result1 = $result1->lesson_id;
            }
              $result1 = explode('||', trim($result1, "||"));
            
              $result1 = array_unique($result1);


              $sql = "SELECT id FROM mlms_task WHERE published = 1 and id IN (SELECT media_id FROM mlms_mediarel WHERE TYPE = 'dtask' AND type_id IN (SELECT id FROM mlms_days WHERE pid ='".$proid."'))";
              /*$db->setQuery($sql);
              $db->query();*/
              $query = $this->db->query($sql);
              $result2 = $query->result_array();
              $taskarray = array();
              if(!empty($result2)){
                foreach($result2 as $res2){
                $taskarray[] = $res2['id'];
                }
              }

        
               $result2 = $taskarray;

              $containsSearch = count(array_intersect($result1, $result2)) == count($result2); // by jayesh

              if($containsSearch)
              {

                //$this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
              }
            }

            if($cert_term == '6')
            {

              $sql = "SELECT `lesson_id` from mlms_viewed_lesson WHERE `user_id` =".intval($user)." and pid=".$proid;
              $query = $this->db->query($sql);

              $result1 = $query->row();
              if(!empty($result1))
              {
                $result1 = $result1->lesson_id;
              }
                $result1 = explode('||', trim($result1, "||"));
            
                $result1 = array_unique($result1);


              $sql = "SELECT id FROM mlms_task WHERE published = 1 and id IN (SELECT media_id FROM mlms_mediarel WHERE TYPE = 'dtask' AND type_id IN (SELECT id FROM mlms_days WHERE pid ='".$proid."'))";
              /*$db->setQuery($sql);
              $db->query();*/
              $query = $this->db->query($sql);
              $result2 = $query->result_array();
              $taskarray = array();
              if(!empty($result2)){
                foreach($result2 as $res2){
                $taskarray[] = $res2['id'];
                }
              }

        
               $result2 = $taskarray;

              $containsSearch = count(array_intersect($result1, $result2)) == count($result2); // by jayesh

              if($containsSearch)
              {

                $getquizcourses = $this->Myinfo_model->getQuizCourses($proid);
                    $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';
                    $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);   

                                    $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

                                      $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;
                                      $scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user,$proid);

                                                              
                        if($scores_avg_quizzes)
                        {
                          if($scores_avg_quizzes >= intval($getmax_score))
                            {
                              $this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
                            }
                        }
              }
            }
      }
      else
      {
        
        $myresult = 'Fail';

        $dataIns = array(
            'score_quiz' => $myScore,            
            'result' => $myresult,            
          );
      $this->lessons_model->updateScoreMarksForPendings($user, $proid, $mediaid, $attempt_code, $dataIns);

      }


      
      //$this->template->build('admin/studreport/viewuserreport/'.$user.'/'.$proid);
      //redirect($last_page_url);
      redirect('studreport/viewuserreport/'.$user.'/'.$proid);
        }
    }

   public function getUserCertificate()
    {   
        $userid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
        $progid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

        $userinfo=$this->programs_model->getUserInfo($userid);
        $courseinfo=$this->programs_model->getProgramById($progid);

       // $change_certifi_term = $this->programs_model->getCertifiTerm($progid,$userid);


       
        $finalexamid=$courseinfo->id_final_exam;
        $certterm=$courseinfo->certificate_term;

        if($finalexamid)
        {
            $coursequizinfo=$this->programs_model->getQuizTakenByUIdPID($userid,$progid,$finalexamid);
             $coursequizinfo2=$this->Studreport_model->getpassrecord($userid,$progid,$finalexamid);

            if(count($coursequizinfo)>0)
            {
              if($coursequizinfo[0]['score_quiz'])
              {
                list($rq,$tq)=explode('|',$coursequizinfo[0]['score_quiz']);
                $res=($rq/$tq)*100;
              }
              else
              {
                $res = 0;
              }
            }
            else
            {

              $res=0;
            }
        }
        else
        {
            $coursequizinfo=array();
            $coursequizinfo2=array();
            $rq=0;
            $tq=0;
            $res=0;
        }


        $quizinformation = $this->programs_model->getCountNumQuizByUser($userid,$progid);
       $coursecompleted=$this->programs_model->courseCompleted($userid,$progid); // view all lession
       $quizinfo=$this->programs_model->getQuiz($finalexamid);
       $scores_avg_quizzes=$this->programs_model->getAvgScoresQ($userid,$progid);
       $avg_quizzes_cert=$this->programs_model->getAvgpercert();

       $hascertficate =FALSE;
       if($certterm == 2)
      {
            if(count($coursecompleted)>0)
            {
               if($coursecompleted->completed == '1')
               {
                    $hascertficate = TRUE;
               }
               else
               {
                    $hascertficate = FALSE;
               }
            }
            else
            {
                $hascertficate = FALSE;
            }
       }

       if($certterm == 3)
     {
                if( $res >= $quizinfo->max_score){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
       }

       if($certterm == 4)
     {
            if($scores_avg_quizzes >= intval($avg_quizzes_cert)){
            $hascertficate = TRUE;
            }
            else{
            $hascertficate = FALSE;
            }
            $hascertficate = FALSE;
        }

        if($certterm == 5)
      {
      if(count($coursecompleted)>0)
            {
                if($coursecompleted->completed == '1' && isset($quizinfo->max_score) && $res >= intval($quizinfo->max_score)){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            }
            else
            {
               $hascertficate = FALSE;
            }
        }

       if($certterm == 6)
     {
            if(count($coursecompleted)>0)
            {
                if($coursecompleted->completed =='1' && isset($scores_avg_quizzes) && ($scores_avg_quizzes >= intval($avg_quizzes_cert))){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            }
        }
        
      // $this->template->set('change_certifi_term',$change_certifi_term);
       $this->template->set('quizinformation',$quizinformation);
       $this->template->set('finalexamcomplete',$res);
       $this->template->set('action',"userdetail");
       $this->template->set("userinfo", $userinfo);
       $this->template->set("courseinfo", $courseinfo);
       $this->template->set("coursequizinfo", $coursequizinfo);
       $this->template->set("coursequizinfo2", $coursequizinfo2);
       $this->template->set("hascertficate", $hascertficate);
       $this->template->build('studreport/seereport');
    }

      public function viewcertificate(){

      $this->template->set_layout('backend');

      $qtid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

      $this->template->set("quizdetail", $this->Userreport_model->getQuizTakenById($qtid));


      $this->template->build('usercertireport/aprovecertificate');

   }

   public function aprovecerti()
   {
     $qtid=$this->input->post('qtid');
     $uid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
     $pid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

     $loggeduserdata=$this->session->userdata('logged_in');
     $issuedby=$loggeduserdata['id'];
     $today=date('Y-m-d');
     $dataarr=array(
     'userid'=>$uid,
     'prog_id'=>$pid,
     'issued_by'=>$issuedby,
     'issued_on'=>$today
     );

     

     
     if($this->Studreport_model->insertCertiData($dataarr))
     {
      //new code for email start
     		  $this->load->model('admin/programs_model');
     		  $infouser = $this->programs_model->getUserInfo($uid);
          $this->load->model('admin/programs_model');
        $coursename=$this->programs_model->getCoursename5($pid);
     		  
              // $urldomain = base_url();
              // $urldomain = str_replace('http://', '', $urldomain);
              // $urldomain = str_replace('/', '', $urldomain);
              // $urldomain = str_replace('www.', '', $urldomain);
        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

              $this->load->model('admin/settings_model');
              $configarr = $this->settings_model->getItems();
              $this->template->set("configarr", $configarr);
              $subject = 'Congratulations! Your certificate is issued';
              $toemail = $infouser->email;
              $content = '';
             // $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Congratulations! Your certificate is issued</p>'; 
              $content .= '<p>Dear '.trim(ucfirst($infouser->first_name)).' '.trim(ucfirst($infouser->last_name)).',<br /><br />';
              $content .="Congratulations! Your certificate is issued for '".$coursename->name."'.<br /><br /> You can now download your certificate from 'My Courses' under the 'Learning Zone' of the <a style='color: #55c5eb;' href=".base_url().">".base_url()."</a> .<br />";
              //$content .='Best regards,<br /><br />';
              //$content .=''.$configarr[0]['institute_name'].'</p>';
              // $content .='<br /><br />';
              // $content .='...</p>';
              $data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
              $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
               //$message = $content;
              //$fromemail='prshah83@gmail.com';
              $fromemail= $urldomain;        //$configarr[0]['fromemail'];   
              $config['charset'] = 'utf-8';
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $this->email->initialize($config);
              $this->email->from($fromemail, $configarr[0]['fromname']);
              $this->email->subject($subject);
              $this->email->to($toemail);
              $this->email->message($message);
              $this->email->send();

              $data_activity = array(
            'activity' => 'Your certificate is approved for course named '.$coursename->name,
            'sender_id' => $issuedby,
            'receiver_id' => $uid,
            'activity_type' => 'Approval',
            'activity_date' => date("Y-m-d"),
            'visit_id' => '0'
              );
            $this->load->model('Category_model');  
           $this->Category_model->insertActivity($data_activity);
      //new code for email end
       redirect('studreport/viewusers/'.$pid);
     }

     //redirect('admin/studreport/viewusers/'.$pid);

   }


    public function view(){
        //$tmpl = "default";
        //$this->template->set("tmpl", $tmpl);
        //$this->template->set("category", $this->categs_model->getCateg());
		//$this->template->build('gurucategs/gurupcategs');
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

public function viewexam()
     {

      //$this->template->set_layout('backend');
      $configarr = $this->settings_model->getItems(); 
        $this->configarr = $configarr;
        $this->template->set_layout($configarr[0]['layout_template']);
        $this->template->set("configarr", $configarr);
        $tmpl = $this->configarr[0]['layout_template'];
        $this->template->set("tmpl", $tmpl);

      $this->load->model('admin/questions_model');
      $this->load->model('admin/Studreport_model');

      $ques_taken_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

      $attempt_code = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;     
      

        
      $quizdetail = $this->Studreport_model->getQuizTakenById($ques_taken_id);
       

        $activeData = $this->Studreport_model->getActiveData($attempt_code); 
        
         
      $this->template->set("quizdetail", $quizdetail);
        
      $this->template->set("activeData", $activeData);

      
      $userid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;
       $progid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;

       $userinfo=$this->Studreport_model->getUserInfo($userid);

       $courseinfo=$this->Studreport_model->getProgramById($progid);
       $finalexamid=$courseinfo->id_final_exam;
       $certterm=$courseinfo->certificate_term;

       if($finalexamid)
       {
           $coursequizinfo=$this->Studreport_model->getQuizTakenByUIdPID($userid,$progid,$finalexamid);

           if(count($coursequizinfo)>0)
           {
            if($coursequizinfo[0]['score_quiz'])
            {
              list($rq,$tq)=explode('|',$coursequizinfo[0]['score_quiz']);
              @$res=($rq/$tq)*100;
             }
             else
             {
                $res = 0;
             }
           }
           else
           {
              $res=0;
           }
       }
       else
       {
          $coursequizinfo=array();
          $rq=0;
          $tq=0;
          $res=0;
       }

       $coursecompleted=$this->Studreport_model->courseCompleted($userid,$progid); // view all lession
       $quizinfo=$this->Studreport_model->getQuiz($finalexamid);
       $scores_avg_quizzes=$this->Studreport_model->getAvgScoresQ($userid,$progid);
       $avg_quizzes_cert=$this->Studreport_model->getAvgpercert();

       $hascertficate =FALSE;
       if($certterm == 2)
       {
            if(count($coursecompleted)>0)
            {
               if($coursecompleted->completed == '1'){
                    $hascertficate = TRUE;
                }
                else{
                    $hascertficate = FALSE;
                }
            }
            else
            {
                $hascertficate = FALSE;
            }

       }

       if($certterm == 3)
       {
                if($res >= @$quizinfo->max_score)
                {
                    $hascertficate = TRUE;
                }
                else
                {
                    $hascertficate = FALSE;
                }
       }

       if($certterm == 4)
       {
                if($scores_avg_quizzes >= intval($avg_quizzes_cert)){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            $hascertficate = FALSE;
       }

       if($certterm == 5)
       {
            if(count($coursecompleted)>0)
            {
                if($coursecompleted->completed == '1' && isset($quizinfo->max_score) && $res >= intval($quizinfo->max_score)){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            }
            else
            {
               $hascertficate = FALSE;
            }
       }

       if($certterm == 6)
       {
            if(count($coursecompleted)>0)
            {
                if($coursecompleted->completed =='1' && isset($scores_avg_quizzes) && ($scores_avg_quizzes >= intval($avg_quizzes_cert))){
                $hascertficate = TRUE;
                }
                else{
                $hascertficate = FALSE;
                }
            }
       }

       $this->template->set('action',"userdetail");
       $this->template->set("userinfo", $userinfo);
       $this->template->set("courseinfo", $courseinfo);
       $this->template->set("coursequizinfo", $coursequizinfo);
       $this->template->set("hascertficate", $hascertficate);
       $this->template->build('studreport/assessexamreport');


   }

   function updateResultStatus()
  {
   //echo 'sfvgsdfvg';
    $myresult =$_POST['resultstatus'];
    $user =$_POST['user'];
    $proid =$_POST['proid'];
    $mediaid =$_POST['mediaid'];
    $attempt_code =$_POST['attempt_code'];
    $txtnotice =$_POST['txtareanotice'];
    $sendmail =$_POST['sendmail'];
     
       $remainAttempts =0;
       $this->load->model('admin/programs_model');
       $this->load->model('quizzes_model');
       $studdetails=$this->programs_model->getuserdetails($user);
       
            $coursename=$this->programs_model->getCoursename5($proid);            
           $remaining_attempts = $this->programs_model->getattemptno($user, $proid, $mediaid, $attempt_code);
           $quizz = $this->quizzes_model->getItems($mediaid);
           $time_quiz_taken = $quizz->time_quiz_taken;
            if($time_quiz_taken == '11')
            {
              $remainAttempts ="No"; 
           }
           else
           {
            $remainAttempts = ($time_quiz_taken - $remaining_attempts->attempt_no); 
            
           }

    $dataIns = array(            
            'result' => $myresult,
            'assess_note' => $txtnotice
          );
      $upt = $this->lessons_model->updateScoreMarksForPendings($user, $proid, $mediaid, $attempt_code, $dataIns);
     
      if($sendmail == "true")
      {
      if($upt == 1)
      {
          // $urldomain = base_url();
          // $urldomain = str_replace('http://', '', $urldomain);
          // $urldomain = str_replace('/', '', $urldomain);
          // $urldomain = str_replace('www.', '', $urldomain);
        if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');
          $sessionarray = $this->session->userdata('logged_in');       
          $user_id = $sessionarray['id'];
          $this->load->model('admin/settings_model');

          $configarr = $this->settings_model->getItems();

          $QuizName = $this->programs_model->getQuizNameById($mediaid);

        if($myresult =='Pass')
        {

          $cert_term = $this->lessons_model->getCertficateTermByPro($proid);

          if($cert_term == '3')
          {
            $userViedLesson = $this->lessons_model->getViewLesson2($user,$proid);

             $userViedLesson = array_filter($userViedLesson);
           
            if(!empty($userViedLesson))
            {
              
                $this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
            }
            else
            {
           
                 $this->lessons_model->InsertViewLessonCert($user,$proid,$cert_term);
            }
          }
          if($cert_term == '4')
          {
            $getquizcourses = $this->Myinfo_model->getQuizCourses($proid);
                $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';
                $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);   

                                $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

                                $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;

                                $scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user,$proid);

                                                              
                        if($scores_avg_quizzes)
                        {
                          if($scores_avg_quizzes >= intval($getmax_score))
                            {
                              $this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
                            }
                        }
              
          }
          if($cert_term == '5')
         {

            $sql = "SELECT `lesson_id` from mlms_viewed_lesson WHERE `user_id` =".intval($user)." and pid=".$proid;
            $query = $this->db->query($sql);

            $result1 = $query->row();
            if(!empty($result1))
            {
              $result1 = $result1->lesson_id;
            }
              $result1 = explode('||', trim($result1, "||"));
            
              $result1 = array_unique($result1);


              $sql = "SELECT id FROM mlms_task WHERE published = 1 and id IN (SELECT media_id FROM mlms_mediarel WHERE TYPE = 'dtask' AND type_id IN (SELECT id FROM mlms_days WHERE pid ='".$proid."'))";
              /*$db->setQuery($sql);
              $db->query();*/
              $query = $this->db->query($sql);
              $result2 = $query->result_array();
              $taskarray = array();
              if(!empty($result2)){
                foreach($result2 as $res2){
                $taskarray[] = $res2['id'];
                }
              }

        
               $result2 = $taskarray;

              $containsSearch = count(array_intersect($result1, $result2)) == count($result2); // by jayesh

              if($containsSearch)
              {

                $this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
              }
            }

            if($cert_term == '6')
         {

            $sql = "SELECT `lesson_id` from mlms_viewed_lesson WHERE `user_id` =".intval($user)." and pid=".$proid;
            $query = $this->db->query($sql);

            $result1 = $query->row();
            if(!empty($result1))
            {
              $result1 = $result1->lesson_id;
            }
              $result1 = explode('||', trim($result1, "||"));
            
              $result1 = array_unique($result1);


              $sql = "SELECT id FROM mlms_task WHERE published = 1 and id IN (SELECT media_id FROM mlms_mediarel WHERE TYPE = 'dtask' AND type_id IN (SELECT id FROM mlms_days WHERE pid ='".$proid."'))";
              /*$db->setQuery($sql);
              $db->query();*/
              $query = $this->db->query($sql);
              $result2 = $query->result_array();
              $taskarray = array();
              if(!empty($result2)){
                foreach($result2 as $res2){
                $taskarray[] = $res2['id'];
                }
              }

        
               $result2 = $taskarray;

              $containsSearch = count(array_intersect($result1, $result2)) == count($result2); // by jayesh

              if($containsSearch)
              {

                $getquizcourses = $this->Myinfo_model->getQuizCourses($proid);
                    $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';
                    $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);   

                                    $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

                                      $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;
                                      $scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user,$proid);

                                                              
                        if($scores_avg_quizzes)
                        {
                          if($scores_avg_quizzes >= intval($getmax_score))
                            {
                              $this->lessons_model->updateViewLessonCert($user,$proid,$cert_term);
                            }
                        }
              }
            }
          

          $subject1 = "Congratulations ".trim(ucfirst($studdetails->first_name))."! You Have Successfully Passed the Exam '".$QuizName."'";
          $toemail1 = $studdetails->email;    //$sessionarray['email']; 
          $content = '';        
          $content .= '<p>Dear '.trim(ucfirst($studdetails->first_name)).',<br /><br />';
          $content .= "Your exam paper has been reviewed by the examiner and here is your exam result.<br /><br />";
          $content .= "Course Name : ".$coursename->name." <br />";
          $content .= "Exam Name : ".$QuizName." <br />";
          $content .= "Result : Pass <br /><br />";
          $content .= "You can view the results in the 'Learning Zone' of the <a href=".base_url().">".$configarr[0]['institute_name']."</a>.<br /><br />";
          $content .=' If you need help or have any questions, please contact us.<br /><br />';
          $content .=' <br /><br />';
          $content .='...';
          $content .= $configarr[0]['signature'].'</p>';
                    
          $data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
          $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
          $fromemail1= 'noreply@'.$urldomain;        //$configarr[0]['fromemail'];// admin mail
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
        else 
        {
          $cert_term = $this->lessons_model->getCertficateTermByPro($proid);

          if($cert_term == '3')
          {

            $this->lessons_model->updateViewLessonCert123($user,$proid,$cert_term);
          }
          if($cert_term == '4')
          {
            $getquizcourses = $this->Myinfo_model->getQuizCourses($proid);
                $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';
                $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);   

                                $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

                                $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;

                                $scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user,$proid);

                                                              
                        if($scores_avg_quizzes)
                        {
                          if($scores_avg_quizzes >= intval($getmax_score))
                            {
                              $this->lessons_model->updateViewLessonCert123($user,$proid,$cert_term);
                            }
                        }
              
          }
          if($cert_term == '5')
         {

            $sql = "SELECT `lesson_id` from mlms_viewed_lesson WHERE `user_id` =".intval($user)." and pid=".$proid;
            $query = $this->db->query($sql);

            $result1 = $query->row();
            if(!empty($result1))
            {
              $result1 = $result1->lesson_id;
            }
              $result1 = explode('||', trim($result1, "||"));
            
              $result1 = array_unique($result1);


              $sql = "SELECT id FROM mlms_task WHERE published = 1 and id IN (SELECT media_id FROM mlms_mediarel WHERE TYPE = 'dtask' AND type_id IN (SELECT id FROM mlms_days WHERE pid ='".$proid."'))";
              /*$db->setQuery($sql);
              $db->query();*/
              $query = $this->db->query($sql);
              $result2 = $query->result_array();
              $taskarray = array();
              if(!empty($result2)){
                foreach($result2 as $res2){
                $taskarray[] = $res2['id'];
                }
              }

        
               $result2 = $taskarray;

              $containsSearch = count(array_intersect($result1, $result2)) == count($result2); // by jayesh

              if($containsSearch)
              {

                $this->lessons_model->updateViewLessonCert123($user,$proid,$cert_term);
              }
            }

             if($cert_term == '6')
         {

            $sql = "SELECT `lesson_id` from mlms_viewed_lesson WHERE `user_id` =".intval($user)." and pid=".$proid;
            $query = $this->db->query($sql);

            $result1 = $query->row();
            if(!empty($result1))
            {
              $result1 = $result1->lesson_id;
            }
              $result1 = explode('||', trim($result1, "||"));
            
              $result1 = array_unique($result1);


              $sql = "SELECT id FROM mlms_task WHERE published = 1 and id IN (SELECT media_id FROM mlms_mediarel WHERE TYPE = 'dtask' AND type_id IN (SELECT id FROM mlms_days WHERE pid ='".$proid."'))";
              /*$db->setQuery($sql);
              $db->query();*/
              $query = $this->db->query($sql);
              $result2 = $query->result_array();
              $taskarray = array();
              if(!empty($result2)){
                foreach($result2 as $res2){
                $taskarray[] = $res2['id'];
                }
              }

        
               $result2 = $taskarray;

              $containsSearch = count(array_intersect($result1, $result2)) == count($result2); // by jayesh

              if($containsSearch)
              {

                $getquizcourses = $this->Myinfo_model->getQuizCourses($proid);
                    $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';
                    $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);   

                                    $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

                                      $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;
                                      $scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user,$proid);

                                                              
                        if($scores_avg_quizzes)
                        {
                          if($scores_avg_quizzes >= intval($getmax_score))
                            {
                              $this->lessons_model->updateViewLessonCert123($user,$proid,$cert_term);
                            }
                        }
              }
            }

         
          $subject1 = "Check your result for '".$QuizName."' Exam";
          $toemail1 = $studdetails->email;              //$sessionarray['email']; 
          $content = '';        
          $content .= '<p>Dear '.trim(ucfirst($studdetails->first_name)).',<br /><br />';
          $content .= "Your exam paper has been reviewed by the examiner and here is your exam result.<br /><br />";
          $content .= "Course Name : ".$coursename->name." <br />";
          $content .= "Exam Name : ".$QuizName." <br />";
          $content .= "Result : Fail <br /><br />";          
          $content .= "You can view the results in the 'Learning Zone' of the <a href=".base_url().">".$configarr[0]['institute_name']."</a>.<br /><br />";
          $content .= "You have ".$remainAttempts." attempts remaining for this exam. You can prepare and give the exam again in the course. <br /><br />";
          $content .=' If you need help or have any questions, please contact us.<br /><br />';
          $content .=' <br /><br />';
          $content .='...';
          $content .= $configarr[0]['signature'].'</p>';
                    
          $data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
          $message1 = $this->load->view('email_formates/common_email_formate.php',$data,true);
          $fromemail1= 'noreply@'.$urldomain;        //$configarr[0]['fromemail'];// admin mail
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
      }
      }
    
    return true;
  }


  function viewCorrectAns()
   {
      $ques_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
               
         $this->load->model('admin/questions_model'); 
              
         $ques_data = $this->questions_model->getQuestions($ques_id);

         $ques_opt = $this->questions_model->getAnsOptions($ques_id);

         $this->template->set("ques_data", $ques_data);

          $this->template->set("ques_opt", $ques_opt);
       
      //$this->template->build('studreport/correctans');
          $this->load->view('studreport/correctans');
   }

   function viewGivenAns()
   {
      $ques_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

      $attempt_code = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
               
         $this->load->model('admin/questions_model'); 
              
         $ques_data = $this->questions_model->getQuestions($ques_id);

         $ques_opt = $this->questions_model->getAnsOptions($ques_id);

         $activeData = $this->Studreport_model->getActiveQuesData($attempt_code,$ques_id); 

           $this->template->set("activeData", $activeData);
        
         $this->template->set("ques_data", $ques_data);

          $this->template->set("ques_opt", $ques_opt);
       
      //$this->template->build('studreport/givenans');
          $this->load->view('studreport/givenans');
   }

    function doArchive()
  {
       $this->load->model('Studreport_model');
       $id = $this->input->post('id');
       $arc_val = $this->input->post('arc_val');

       if($arc_val == '1')
       {
           $formdata = array('archive' => '0');
           $this->Studreport_model->updateQuiz($id,$formdata);
           echo 'unarchived';
       }
       else
      {
           $formdata = array('archive' => '1');
           $this->Studreport_model->updateQuiz($id,$formdata);
           echo 'archived';
      }


  }


}
?>