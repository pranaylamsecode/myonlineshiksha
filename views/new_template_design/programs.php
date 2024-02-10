<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends MLMS_Controller {

	protected $before_filter = array();

	function __construct()
	{   
		parent::__construct();
        $this->load->library('phpqrcode/qrlib');
		$this->authenticate();
        $this->load->helper('url');
        $this->load->helper('form');
        //$this->load->helper('myform');
		$this->load->model('program_model');
		$this->load->model('admin/programs_model');
        $this->load->model('admin/medias_model');
	    //$this->template->set_layout('backend');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
		$this->lang->load('tooltip', 'english');		
		$this->load->library('form_validation');
		$this->load->model('admin/settings_model');

		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
		error_reporting(0);

		$this->load->model('admin/days_model');
		$this->load->model('login_model');

		$this->load->config('features_config');

		//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	}

	function authenticate()
    {   	 
 	$session = $this->session->userdata('loggedin');
      if(!$session)
      {
       redirect('admin/users/login');
      }
      else if($session['groupid'] == 4 || $session['groupid'] == 2)
      {
      }
      else{
      	$this->session->unset_userdata("loggedin");
      	redirect('admin/users/login');
      }
    }


    public function reorder_fun($order_number){

      //$order = $order_number['order'];
      $cid = $order_number['cid'];
      $order = array_values($order);
      $cid = array_values($cid);
      $total = count($cid);

      	for($i=0; $i<$total; $i++){
        $data = array(
			'ordering' => $order[$i]
		);
        //print_r($data);
       	$this->programs_model->updateOrder($cid[$i],$data);

		}
	}

    public function index($parent_id = NULL)
	{

        if(isset($_POST) && !empty($_POST))
		{
            if(isset($_POST['order']))
            {
             $this->reorder_fun($_POST);
            }
		}
		
	    $this->authenticate();
        $parent_id = NULL;
        $this->session->unset_userdata('sess_programs');
        $this->template->set_layout('backend');
        $this->template->title('Courses List');
        $sess_programs = $this->session->userdata('sess_programs');

        // Academy Configuaration data
        $config_course = $this->config->item('webinar');	
        $course_limit = $config_course['courselimit'];	
         $this->template->set("course_limit",$course_limit);
         // $u_data = $this->session->userdata('loggedin');
         $u_data = $this->session->userdata('loggedin');
        // en 
         if($u_data['groupid'] ==4)
         {
         	$userid = NULL;

         }
         else { $userid = $u_data['id']; }

       if($this->input->post('reset') == 'Reset'){
        $search_string = $this->input->post('search_text', TRUE);
	   
       $search_status = $this->input->post('status', TRUE);
       $search_cate = $this->input->post('catid', TRUE);
       $this->session->unset_userdata('sess_programs');
       $search_string = '';
       $search_status = '';
       $search_type = '';
      }else{
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

       $path=base_url() . "admin/course-manager/";
       $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
       $baseurl = base_url() . "admin/course-manager/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3; 
       $config['total_rows'] = $this->programs_model->getprogramcount($search_string,$search_status,$search_cate,$userid);
       $this->template->title('Courses List');
       $this->pagination->initialize($config);

       /*** V S **/

       $u_data=$this->session->userdata('loggedin');
       

         $progassign=$this->programs_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$userid);
       /*else
       $progassign=$this->programs_model->getItems1($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate,$u_data['id']);*/

       /** V E **/
       //$this->template->set("webicount",$this->webinars_model->getpcatcount($search_string));
       $this->template->set("programs",$progassign);
       $this->template->set('categories',$this->programs_model->getcategories());
       $this->template->set("search_string", $search_string);
       $this->template->set("status", $search_status);
	   $this->template->set("countprog", $this->programs_model->getcountprogram($userid));
	    $this->template->set("countprogConfig", $this->programs_model->getProgramforConfig());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/programs/list');
	}	


	 public function reviews_old($parent_id = NULL)
	{
       
		
	    $this->authenticate();
        $parent_id = NULL;
        $this->session->unset_userdata('sess_programs');
        $this->template->set_layout('backend');
        $this->template->title('Reviews');
        $sess_programs = $this->session->userdata('sess_programs'); 

        $pro_id = $this->uri->segment(4);

        $reviews = $this->programs_model->getReviews($pro_id);  
          $this->template->set('pro_id', $pro_id);
        $this->template->set('reviews', $reviews);

          
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/programs/reviewslist');
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
			//$this->template->build('admin/programs/list');
			redirect('admin/course-manager');
        }	

		$this->template->set_layout('backend');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('CbCourse', 'CbCourse', 'required');
		if ($this->form_validation->run() === FALSE)
		{		
			$this->template->build('admin/programs/copy');
		}
		else
		{		
			$course_id = $this->input->post('CbCourse');
			$course_name = $this->input->post('Coursename');
			$select_course = $this->programs_model->getCourseForCopy($course_id);
			$select_days = $this->programs_model->getDaysForCopy($course_id);
			$orderingval = $this->programs_model->maxorder();			
			$data = array(
				'catid' => $select_course->catid,
				'name' =>  $course_name,//$select_course->name.' '.'Copy',
				'alias' => $course_name,       //$select_course->alias.' '.'Copy',
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
				
				'ordering' => $orderingval,
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
				'created_by' => $select_course->created_by,
				'modify_date' => date('M d, Y'),
				'is_drip_course' => $this->input->post('dripstatus'),
                'release_type' => $this->input->post('release_type'),
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

               // $lessons = $this->days_model->getLessonsData($days->id);
               $lessons = $this->days_model->getLessonsData2($days->id);
               

               foreach($lessons as $lesson)
               {
               		$data_task = array(
               				'name' => $lesson->name, 
               				'alias' => $lesson->alias,
               				'category' => $lesson->category,
               				'difficultylevel' => $lesson->difficultylevel,
               				'points' => $lesson->points,
               				'image' => $lesson->image,
               				'lecture_video' => $lesson->lecture_video,
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
               		$tid = $this->programs_model->insertLectItems($data_task);

               		// $tid = $this->programs_model->insertTaskItems($data_task);

               }            
               
              
			}


			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			//$this->template->build('admin/programs/list');
			redirect('admin/course-manager');
		}
	}
	
	public function copy_template(){
		// print_r($_POST);
				$config_course = $this->config->item('webinar');	
          $course_limit = $config_course['courselimit'];

          $countprogConfig = $this->programs_model->getProgramforConfig();
    
        if($course_limit <= $countprogConfig)
        {
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please upgrade subscription to create more courses' ));
			//$this->template->build('admin/programs/list');
			redirect('admin/course-manager');
  
        }
        else
        {
        	


        	$u_data = $this->session->userdata('loggedin');
        	$course_id = $this->input->post('id');
			$course_name = $this->input->post('coursename');
			$select_course = $this->programs_model->getCourseCopyForTemplate($course_id);
			$select_days = $this->programs_model->getDaysCopyForTemplate($course_id);
			$orderingval = $this->programs_model->maxorder();	

			$title = $course_name;
	      		    
	                $titleURL = strtolower(url_title($title));
	                $title2 = $titleURL;
	            
                $avail_slug = $this->programs_model->matchCourse_slug($titleURL,$course_id);
                $i = 0;
	               if(in_array($titleURL, $avail_slug))
	               {
				    do{
				      $i++;
				      $titleURL = $title2.'-'.$i;
				    } while(in_array($titleURL, $avail_slug));
				  }

			$data = array(
				'catid' => $select_course->catid,
				'name' =>  $course_name,//$select_course->name.' '.'Copy',
				'slug' => $titleURL,
				'alias' => $course_name,       //$select_course->alias.' '.'Copy',
				'description' => $select_course->description,				
				'introtext' => $select_course->introtext,
				// 'image' => $select_course->image,
				'emails' => $select_course->emails,
				
				'published' => $select_course->published,
				'startpublish' => $select_course->startpublish,
				'endpublish' => $select_course->endpublish,
				'metatitle' => $select_course->metatitle,
				'metakwd' => $select_course->metakwd,
				'metadesc' => $select_course->metadesc,
				
				'ordering' => $orderingval,
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
				'created_by' => $u_data['id'],
				'modify_date' => date('M d, Y'),
				'is_drip_course' => $select_course->is_drip_course,
				'release_type' => $select_course->release_type,
				'learn_points' => $select_course->learn_points,
				'preview' => $select_course->preview,
				'is_live_class' => $select_course->is_live_class,
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

               $lessons = $this->days_model->getLessonsData2_template($days->id);
               foreach($lessons as $lesson)
               {
               		$data_task = array(
               				'name' => $lesson->name, 
               				'section_id' => $day_id,
               				'p_id' => $program_id,
               				// 'alias' => $lesson->alias ? $lesson->alias : $lesson->name,
               				// 'category' => $lesson->category,
               				'difficultylevel' => $lesson->difficultylevel,
               				// 'points' => $lesson->points,
               				// 'image' => $lesson->image,

               				// 'lecture_video' => $lesson->lecture_video,
               				'published' => $lesson->published,
               				'startpublish' => $lesson->startpublish,
               				'endpublish' => $lesson->endpublish,
               				'metatitle' => $lesson->metatitle,
               				'metakwd' => $lesson->metakwd,
               				'metadesc' => $lesson->metadesc,
               				'ordering' => $lesson->ordering,
               				// 'step_access' => $lesson->step_access ? $lesson->step_access : '1',
               				// 'final_lesson' => $lesson->final_lesson ? $lesson->final_lesson : '0',
               				'created_by' => $lesson->created_by,
               				'lecture_content' => $lesson->lecture_content,
               				'layoutid' => $lesson->layoutid,
               				'is_exam' => $lesson->is_exam,
               				'is_demo' => $lesson->is_demo,
               				'lecture_duration' => $lesson->lecture_duration,
               				'lecture_type' => $lesson->lecture_type

               	          );

               		// $tid = $this->programs_model->insertTaskItems($data_task);
               		$tid = $this->programs_model->insertLectItems($data_task);
               		// echo $tid; exit('me');
               }            
               
              
			}

			$progassign=$this->programs_model->getProgramById($program_id);
							
		$days = $this->program_model->getlistDays($program_id);

          $lessons = $this->program_model->getLessons(@$days[0]->id);
			$data = array(
				'u_data' => $u_data,
				'program' => $progassign,
				'lessons' => $lessons,
				'days' => $days,
				'course_name' => $course_name,
		);
			$this->template->build('admin/programs/append_row', $data);

			//echo "success";
			
		
        }
	}

	public function review_delete($id)
	{

		$del = $this->program_model->review_del($id);
		
		if($del){
			echo "success";
		}
		else{
			echo "This review is not exist!";
		}
	}
	
	public function discussions($course_id)
	{		
		$this->template->set_layout('backend');

		$program = $this->program_model->getProgram($course_id);

		$this->template->set("programs", $program);	
		$this->template->set("quizcomment", $this->program_model->getLessonQuery($course_id));

		$this->template->build('admin/programs/discussion_view');
	}

	public function reviews($course_id)
	{		
		$program = $this->program_model->getProgram($course_id);
		$this->template->set("programs", $program);		
		$sessionarray = $this->session->userdata('logged_in');

	    $user_id = $sessionarray['id'];
		if(isset($program->author))
		{
			$teacher_id = (isset($program->author)) ? $program->author : '';
			$teacher_info = $this->program_model->getTeacherInfo($teacher_id);
			$teachercourse = $this->program_model->getTeacherCourse($teacher_id);
		}
		else
		{
			$teacher_info = '';
			$teachercourse = '';
		}
		$this->template->set("teacher_info", $teacher_info);
		$this->template->set("reviews", $this->program_model->getAllReview($course_id));
		$this->template->set("count_5", $this->program_model->getFiveReview($course_id));
		$this->template->set("count_4", $this->program_model->getFourReview($course_id));
		$this->template->set("count_3", $this->program_model->getThreeReview($course_id));
		$this->template->set("count_2", $this->program_model->getTwoReview($course_id));
		$this->template->set("count_1", $this->program_model->getOneReview($course_id));
		$this->template->set("reviewcount", $this->program_model->getAllReview($course_id));		
		$this->template->set_layout('backend');
		$this->template->build('admin/programs/rating_view');
	}

	public function addcourse()
	{		
		
	   $parent_id = NULL;
	  
	  $this->load->model('/settings_model');
		$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
	  
       $this->template->title('Courses List');
       $sess_programs = $this->session->userdata('sess_programs');
       if($this->input->post('reset') == 'Reset'){
       $search_string = $this->input->post('search_text', TRUE);
       $search_status = $this->input->post('status', TRUE);
       $search_cate = $this->input->post('catid', TRUE);
       $this->session->unset_userdata('sess_programs');
       $search_string = '';
       $search_status = '';
       $search_type = '';
      }else{
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
       $path=base_url() . "admin/programs/";

       $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
       $baseurl = base_url() . "admin/programs/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->programs_model->getprogramcount($search_string,$search_status,$search_cate);
       $this->template->title('Courses List');
       $this->pagination->initialize($config);
       $this->template->set("programs", $this->programs_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate));
       $this->template->set('categories',$this->programs_model->getcategories());
       $this->template->set("search_string", $search_string);
       $this->template->set("status", $search_status);
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/programs/addcourse');
	}
	
	public function addcourse1()
	{		
		
	   $parent_id = NULL;
       $this->template->title('Courses List');
       $sess_programs = $this->session->userdata('sess_programs');
       if($this->input->post('reset') == 'Reset'){
       $search_string = $this->input->post('search_text', TRUE);
       $search_status = $this->input->post('status', TRUE);
       $search_cate = $this->input->post('catid', TRUE);
       $this->session->unset_userdata('sess_programs');
       $search_string = '';
       $search_status = '';
       $search_type = '';
      }else{
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
       $path=base_url() . "admin/course-manager/";

       $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
       $baseurl = base_url() . "admin/course-manager/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->programs_model->getprogramcount($search_string,$search_status,$search_cate);
       $this->template->title('Courses List');
       $this->pagination->initialize($config);
       $this->template->set("programs", $this->programs_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate));
       $this->template->set('categories',$this->programs_model->getcategories());
       $this->template->set("search_string", $search_string);
       $this->template->set("status", $search_status);
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/programs/addcourse1');
	}
	
	public function enrolled($id = NULL)
	{
		//$enroll=$this->programs_model->getEnrollstudentslist($id);
		$course = $this->uri->segment(4);
		$enroll=$this->programs_model->getEnrolledUser($course);
		$this->template->set("enroll",$enroll);
		$this->template->set_layout('backend');
		$this->template->build('admin/programs/enrolled');
	}
	
	public function trashdata($parent_id = NULL)
	{
		$search_string = '';
		
        $search_status = '';
		
        $search_type = '';
         $parent_id = NULL;
		
		$sess_programs = $this->session->userdata('sess_programs');
		
		$search_cate = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_programs['searchtcate'];
		
		////////////////////
		   $path=base_url() . "admin/programs/trashdata";
	       $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
	       $baseurl = base_url() . "admin/programs/trashdata";
	       $this->load->library('pagination');
	       $config["base_url"] = $baseurl;
	       $config['per_page'] = 10;
	       $config['enable_query_strings'] = true;
	       $config['uri_segment'] = 4; 
	       $config['total_rows'] = $this->programs_model->getProgramTrashcount($search_string,$search_status,$search_cate);
	       $this->template->title('Courses List');
	       $this->pagination->initialize($config);

		////////////////


		//$start = '0';
		
		$progassign=$this->programs_model->gettrashItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_cate);
		
		$this->template->set("countprog", $this->programs_model->getProgramTrashcount($search_string,$search_status,$search_cate));

		$this->template->set("programs",$progassign);
		
		$this->template->set_layout('backend');
		
		$this->template->build('admin/programs/trash');
	}	
	
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
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
          $ftpfiles_i = $_FILES['orig_name'];
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
                $config['width'] = 251;
                $config['height'] = 142;

        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';

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

	function create($parent_id = FALSE)
	{	 

         // Academy Configuaration data

        $config_course = $this->config->item('webinar');	
        $course_limit = $config_course['courselimit'];

        $config_exam = $this->config->item('webinar');	
        $exam_facility = $config_exam['examfacility'];

        $countprogConfig = $this->programs_model->getProgramforConfig();
    
        if($course_limit <= $countprogConfig)
        {
            
           	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please upgrade subscription to create more courses' ));
			//$this->template->build('admin/programs/list');
			redirect('admin/course-manager');
        }	



		$u_data = $this->session->userdata('loggedin');
		if(($u_data['groupid']=='4'))			
		{	    
		  	$pay_setting = $this->settings_model->getAccountMode();
		    if(empty($pay_setting['0']['api_username']) && empty($pay_setting['0']['api_password']))
		    {
          		$text = "Your Payment Settings are Incomplete. <a href='".base_url()."admin/settings/account'>Click here to Add Settings</a>";  
	     		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => $text ));
	     	}
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
        $this->template->set_layout('backend');
        $this->load->model('admin/medias_model');
	    //$this->template->append_metadata(block_submit_button());
	   	$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$this->_set_rules();
		$this->template->set('facility',$exam_facility);
		$this->template->title("Create Course");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		$this->template->set('user_id',$user_id);
        $get_media_ids = $this->input->post('media_id');
        $this->template->set('get_media_ids',$get_media_ids);
        $get_req_ids = $this->input->post('req_id');
        $this->template->set('get_req_ids',$get_req_ids);

        // $this->template->set("medias", $this->medias_model->getMedia($this->input->post('media_id')));

		$this->template->set('categories',$this->programs_model->get_formatted_combo($parent_id));
		$this->template->set('teachers',$this->programs_model->getUsers('Trainer'));
		$this->template->set('renewalplans',$this->programs_model->getRenewalPlans($parent_id));

        $this->template->set('groups',$this->programs_model->getGroup());
        $this->template->set('courses',$this->programs_model->getCourse());
        $this->template->set('plans',$this->programs_model->getPlans($parent_id));
		$this->template->set('finalexamlist',$this->programs_model->getFinalQuiz(0));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        //if($this->input->post('category_id') == '-1'){
        //$this->form_validation->set_rules('category_id','category','required');
	    $this->form_validation->set_rules('category_id', 'category_id', 'required');
        //}
        //if($this->input->post('teacher_id') == '- select -'){
	    $this->form_validation->set_rules('teacher_id', 'teacher_id', 'required');
        //$this->form_validation->set_rules('teacher_id','teacher','required');
        // }

		$plan = $this->input->post('fixedrate');
		
		if($plan == 'subscription')
		{

        if($this->input->post('chb_free_courses')=='on' && $this->input->post('step_access_courses')=='0')    
		{
			$this->form_validation->set_rules('selected_course', 'course', 'required');
        }
			
		if($this->input->post('chb_free_courses')=='on')
		{
			$this->form_validation->set_rules('subscription_default', 'subscription', 'required');
        }
        //if($this->input->post('subscription_default') == '1')
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

        $this->form_validation->set_rules('subscription_default', 'subscription', 'required');
		}		
		elseif($plan == 'fixed')
		{
			$this->form_validation->set_rules('fixedrate', 'fixedrate', 'required');
		}
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/programs/create');
		}
		else
		{
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
			$orderingval = $this->programs_model->maxorder();
			//$this->upload_image();
			$uploadName= $this->upload_image();
			$data5 = json_decode($uploadName,true);  
      		$imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : 'no_images_course.jpg';

			//$imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : 'no_image.jpg';
			$reminders=$this->input->post('reminders');
			if($reminders){
			$reminders = implode(',',$reminders);
			}
	    	//$selected_course_array = $this->input->post('selected_course');
	    	//$selected_course_string = (!empty($selected_course_array)) ? implode(',',$selected_course_array) : NULL;
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
							$selected_course_string.= $value."|";
						}
				}

			}
			else
			{
				$selected_course_string = NULL;
			}
        }
		else{
           $selected_course_string = NULL;
		}
		}
		else{
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
            
            //@@@@@@@@@ new code for assistant teacher end here
            //@@@@@@@@@ new code for exersice file start here
			       if($this->input->post('media_id') != ''){
			       //$mediafile_id = rtrim($this->input->post('media_id'), ",");
			      $mediafile_id1 = implode(',', $this->input->post('media_id'));
			      $mediafile_id = rtrim($mediafile_id1, ",");
			       }else{			        
			        $mediafile_id =null;
			       }
			       
            //@@@@@@@@@ new code for exersice file end here 
			//@@@@@@@@@ new code for Prerequisites file start here
			       if($this->input->post('req_id')!= ''){
			       	$preqfiles_id1 = implode(',', $this->input->post('req_id'));
			        $preqfiles_id = rtrim($preqfiles_id1, ",");
			       }else{			        
			        $preqfiles_id =null;
			       }

			//@@@@@@@@@ new code for Prerequisites file end here 

       
  		$subprice = $this->input->post('subscription_price');
		$subplans = $this->input->post('subscriptions');
		$chb_free_courses = $this->input->post('chb_free_courses');
	
		$chb_free_courses = (isset($chb_free_courses) && ($chb_free_courses == '1')) ? 1 : 0;
		$webcam_option = $this->input->post('webcam_option');
		$webcam_option = (isset($webcam_option) && ($webcam_option == 'on')) ? 1 : 0;
		$published = $this->input->post('published');

		$showresult_option = $this->input->post('show_result');            
        $showresult_option = (isset($showresult_option) && ($showresult_option == 'on')) ? 1 : 0;
		
		$fixedrate ="0.00";

		$free_coursesforcond = $this->input->post('chb_free_courses');
        $access_coursesforcond = $this->input->post('step_access_courses');
        $planforcond = $this->input->post('plan'); 
        $selected_course = $this->input->post('selected_course');	       

		if(($free_coursesforcond == 0 && $access_coursesforcond == 0 && $planforcond =='fixed') || ($free_coursesforcond == 1 && $planforcond =='fixed'))
		{			
			$fixedrate = $this->input->post('fixedrate');

		}  

		$step_access_courses = $this->input->post('step_access_courses'); 
		if(($free_coursesforcond == 1 && $planforcond =='fixed') || ($free_coursesforcond == 1 && $planforcond =='subscription'))
		{
			$step_access_courses = 0; 
			$selected_course =0;     	
		}

		$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'alias' => $alias,
				'catid' => $this->input->post('category_id'),
				//'introtext' => $this->input->post('category_id'),
				'image' => $this->input->post('cropimage'),               //$imagename,
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
				'author' => $this->input->post('teacher_id'),
				'level' => $this->input->post('level'),
				//'priceformat' => $this->input->post('level'),
				'fixedrate'	=> $fixedrate,              //$this->input->post('fixedrate'),
				'skip_module' => '0',    //$this->input->post('skip_module'),
				'chb_free_courses' => $chb_free_courses,
				'step_access_courses' => $step_access_courses,  //$this->input->post('step_access_courses'),
				'selected_course' => trim($selected_course_string,"|"), //$this->input->post('selected_course'), // $selected_course_string
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
                'demoprice' => $this->input->post('demofixedrate'),
                'modify_date' => date('M d, Y'),
                'is_drip_course' => $this->input->post('dripstatus'),
                'release_type' => $this->input->post('release_type'),
			);
				      

        $inserted_id = $this->programs_model->insertItems($data);

        $configarr = $this->settings_model->getItems();	

		$cat_name = $this->programs_model->getCatNameByCatID($this->input->post('category_id'));
		$teacher_name =  $this->programs_model->getUserName($this->input->post('teacher_id'));
		$teacher_email =  $this->programs_model->getUserNameEmail($this->input->post('teacher_id'));
		   
		// $urldomain = base_url();
		// $urldomain = str_replace('http://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
		if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain');
            
            //Email to teacher
                   // $subject =  "'".$this->input->post('name')."' Has Been Assigned to You";
                    $subject =  "Course '".$this->input->post('name')."' assigned to you";
					$toemail =  $teacher_email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= "<p style='font-size: 17px; font-weight: bold; text-transform: uppercase'>Course '".$this->input->post('name')."' assigned to you</p>";
					$content .= '<p>Dear '.trim(ucfirst($teacher_name)).',<br /><br />';
					//$content .= 'A course "'.$this->input->post('name').'" has been assigned to you in  "'.$configarr[0]['institute_name'].'".<br /><br />';
					$content .= "A course '".$this->input->post('name')."' has been assigned to you in ".$configarr[0]['institute_name'].".<br /><br />";
					$content .=' Now you can access and manage this course under "My Courses" section in the "Teaching Zone" in the academy once you log in.<br /><br />';

					$content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.base_url().'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Go to Academy Now</a></div><br /> <br />';

					$content .='If you need help or have any questions, please contact us.';
					// $content .= '<br /><br />';
					// $content .='...</p>';
					// $content .= $configarr[0]['signature'].'</p>';
					//$content .= 'Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
 $data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= $urldomain;   //$configarr[0]['fromemail'];		
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

					$admininfo = $this->login_model->getadminInfo(4);
			//Email to admin
                    //$subject = 'New Course "'.$this->input->post('name').'" Has Been Assigned to '.ucfirst($teacher_name);
                    $subject = "Course '".$this->input->post('name')."' is assigned to ".ucfirst($teacher_name);
					$toemail = "veerit1511@gmail."; //$admininfo->email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= "<p style='font-size: 17px; font-weight: bold; text-transform: uppercase'>Course '".$this->input->post('name')."'  is assigned to ".ucfirst($teacher_name)."</p>";
					$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					$content .="Course '".$this->input->post('name')."' has been successfully assigned to ".trim(ucfirst($teacher_name)).".<br /><br />";
					$content .='If you want to make any changes in the above assignment go to the "Course Manager" section in <a style="color: #55c5eb;" href = '.base_url().'admin >'.base_url().'admin</a>  with your login details.<br /><br />';
					 $content .='If you need help or have any questions, please contact us.<br />';
					// $content .= '<br /><br />';
					// $content .='...</p>';
					//$content .= $configarr[0]['signature'].'</p>';
					//$content .='Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
 $data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= $urldomain;  //$configarr[0]['fromemail'];		
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


        $pro_id = $this->programs_model->maxprogramid();

 //       $plans = $this->input->post('plan'); 

     
	 if(($free_coursesforcond == 0 && $access_coursesforcond == 0 && $planforcond =='subscription') || ($free_coursesforcond == 1 && $planforcond =='subscription'))
	 {
        $plans = $this->input->post('subscriptions');
	    $plans = (!empty($plans)) ? $plans : array(0=>0);
        $price = ($this->input->post('subscription_price')) ? $this->input->post('subscription_price') : '0';
        $sub_default = $this->input->post('subscription_default');
		if($plans[0] !=0 ){
		$i=0;
		 foreach($plans as $element) {
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
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			redirect('admin/course-manager');
			// if((!empty($_POST['save2'])) && ($_POST['save2']=='Save And Continue'))
				
		}
	   }
      else {
          $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
			
			redirect('admin');
      }	

	}
                

	public function editreview()
	{
		  $u_data = $this->session->userdata('loggedin');
		  $user_id = $u_data['id'];
          $this->template->set_layout('backend');
		  $this->template->append_metadata(block_submit_button());

		  $id = $this->uri->segment(4);
		  $pid = $this->uri->segment(5);
		  $this->template->set('updType', 'edit');
		  $this->template->set('id', $id);
		  $this->template->set('pid', $pid);
		  $review = $this->programs_model->getReviewById($id);
		  $this->template->set('review', $review);
		  $this->_set_rules('edit');

		  $this->form_validation->set_rules('review_title', 'review_title', 'required');
		$this->form_validation->set_rules('review_desc', 'review_desc', 'required');

		 if($this->form_validation->run() == FALSE)
		 {
		  	$this->template->build('admin/programs/editreview');
		 }
		 else
		 {
		 	$data = array(
		 	  'title' => $this->input->post('review_title'), 
		 	  'description' => $this->input->post('review_desc')
		 	  );

		 	$isupdate = $this->programs_model->updatereview($data,$id);

		 	if($isupdate)
		 	{
		 		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
            	redirect('admin/programs/reviews/'.$pid);
		 	}
		 	else
		 	{
		 		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				redirect('admin/programs/reviews/'.$pid);
		 	}
		}		 
	}

	function edit_course($id = FALSE, $parent_id = FALSE)
	{
			$multicat = '';
			$multicatid = $this->input->post('multicat');
            $i = 0;
            if(!empty($multicatid)){
	            foreach ($multicatid as $key => $value) {
	            	$multicat .= $value;
	            	if(count($multicatid) > 1 && $i < count($multicatid)-1)
	            		$multicat .=",";
	            	$i++;
	            }
	        }
            /*echo $multicat;
            exit; */

			$data['programs'] = $this->programs_model->getItems($this->input->post('id', TRUE));			
           	$imagename = null;
            $uploadName= $this->upload_image();
			  $data5 = json_decode($uploadName,true);  
      		  $imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : $this->input->post('imagename');

      		   $title = $this->input->post('slug') ? strip_tags($this->input->post('slug')) : strip_tags($this->input->post('name'));
	      		    
	                $titleURL = strtolower(url_title($title));
	                $title2 = $titleURL;
	            
                $avail_slug = $this->programs_model->matchCourse_slug($titleURL,$id);
                if(!empty($id))
                {
                	$avail_slug = $this->programs_model->matchCourse_slug($titleURL,$id);
                	if(!empty($avail_slug))
                	{
                		print_r("fail");exit;
                	}
                }
                $i = 0;
	               if(in_array($titleURL, $avail_slug))
	               {
				    do{
				      $i++;
				      $titleURL = $title2.'-'.$i;
				    } while(in_array($titleURL, $avail_slug));
				  }
           
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
                          foreach($selected_course1 as $value) {
                  		   		if($value == "-1") {
                                      $selected_course_string='-1';
                                      break;
                  				}
                  				else {
                  					$selected_course_string .= $value."|";
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
            $chb_free_courses = (isset($chb_free_courses) && ($chb_free_courses == 1)) ? 1 : 0;
            $webcam_option = $this->input->post('webcam_option');
            $showresult_option = $this->input->post('show_result');
            $webcam_option = (isset($webcam_option) && ($webcam_option == 'on')) ? 1 : 0;
            $showresult_option = (isset($showresult_option) && ($showresult_option == 'on')) ? 1 : 0;
            //$published = ($this->input->post('published' && ($this->input->post('published') == 0))) ? 1 : 0;
            //echo $published = $this->input->post('published');exit;
            $published = $this->input->post('published');

            	$fixedrate = "0.00";
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

		
				$crpimg = $this->input->post('cropimage');
				$crpimg = preg_replace('/\s+/', '', trim($crpimg));;
			$form_data = array(
				'name' => $this->input->post('name'),
				'slug' => $titleURL,
				'description' => $this->input->post('description'),
				'alias' => $alias,
				'catid' => $this->input->post('category_id'),
				//'introtext' => $this->input->post('category_id'),
				//'image' => $imagename,
								'image' => $crpimg,               //$imagename,

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
				'fixedrate' => $fixedrate,     //$this->input->post('fixedrate'),
				'skip_module' => '0',          //$this->input->post('skip_module'),
				'chb_free_courses' => $chb_free_courses,
				'step_access_courses' => $access_coursesforcond,//$this->input->post('step_access_courses'),
				'selected_course' => trim($selected_course_string,"|"),
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
                'time_for_webcam' => $this->input->post('CbShot'),
                'show_result' => $showresult_option,
                'introtext' => $assistant_teachers,
                'programmedias'=>$mediafile_id,
                'prerequisitesfiles'=>$preqfiles_id,
                'demoprice' => $this->input->post('demofixedrate'),
                'modify_date' => date('M d, Y'),
                'is_drip_course' => $this->input->post('dripstatus'),
                'release_type' => $this->input->post('release_type'),
                'learn_points' => $this->input->post('learn_pnt'),
                'preview' => $this->input->post('preview'),
                'multicat' => $multicat,
                'is_live_class' => $this->input->post('is_live_class'),
                // 'qrcode' => $text1234,
                // 'qr_image' => $file_name1,
                // 'url_link' => $text1234,
			);
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
				$this->programs_model->insertRenewals($renewal_data);
				$j++;
			}
		}

	}
      
		if ($isupdated) // the information has therefore been successfully saved in the db
		{
			// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
			foreach ($files_to_delete as $index)
			{
				if ( is_file(FCPATH.'public/uploads/programs/img/'.$index) )
					unlink(FCPATH.'public/uploads/programs/img/'.$index);

				if ( is_file(FCPATH.'public/uploads/programs/img/thumbs/'.$index) )
					unlink(FCPATH.'public/uploads/programs/img/thumbs/'.$index);
			}
		   	//redirect('admin/programs/'.$parent_id);
		   	echo "Lecture successfully updated";
		}
		else{
				// $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
			echo "Fail to update lecture, please try again!";
				// redirect('admin/course-manager/'.$parent_id);
			}
	  	

	}

	function edit($id = FALSE, $parent_id = FALSE)
	{	   

		$parent_id = $this->uri->segment(4);
		if($this->session->userdata('logged_in'))
	        $u_data = $this->session->userdata('logged_in');
	      else $u_data = $this->session->userdata('loggedin');		
	     $authorOf = $this->programs_model->courseCreatedBy($parent_id);
		if((@$authorOf[0]->author != $u_data['id'] && $u_data['groupid'] != '4') || empty($authorOf))
		{
			redirect('admin/users/page404'); 
		}

		$config_exam = $this->config->item('webinar');	
        $exam_facility = $config_exam['examfacility'];

		// $u_data = $this->session->userdata('loggedin');
		$user_id = $u_data['id'];
		if($u_data['groupid']=='4' || $u_data['groupid']=='2')		
		{
		//load block submit helper and append in the head

        $this->template->set_layout('backend');
		$this->template->append_metadata(block_submit_button());
        $this->load->model('admin/medias_model');

		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		$parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
	    $id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct

		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-manager/');
		}
		//create control variables
	    //$this->template->title(lang("web_category_edit"));
        $type = 'preq';
		$this->template->title("Edit Course");
		$this->template->set('facility',$exam_facility);
        $this->template->set('groups',$this->programs_model->getGroup());
        $this->template->set('courses',$this->programs_model->getCourse());
        $this->template->set("medias", $this->medias_model->getMediaRel($id));
        $this->template->set("rerequisites", $this->medias_model->getReqRel($id));
		$this->template->set('program', $this->programs_model->getItems($id,'','',''));
		$this->template->set('updType', 'edit');
		$this->template->set('id', $id);
		$this->template->set('user_id', $user_id);
		$this->template->set('parent_id', $parent_id);
		$this->template->set('categories',$this->programs_model->get_formatted_combo($parent_id));
		$this->template->set('teachers',$this->programs_model->getUsers());
        $this->template->set('plans',$this->programs_model->getPlans($id));
        $this->template->set('countplans',$this->programs_model->countPlans($id));
        $this->template->set('renewalplans',$this->programs_model->getRenewalPlans($id));
        $this->template->set('program_plans',$this->programs_model->getProgramPlans($id));
		$this->template->set('finalexamlist',$this->programs_model->getFinalQuiz(0));
		$this->template->set('pay_setting', $this->settings_model->getAccountMode());

        $get_media_ids = $this->input->post('media_id');
        $this->template->set('get_media_ids',$get_media_ids);
        $get_req_ids = $this->input->post('req_id');
        $this->template->set('get_req_ids',$get_req_ids);

        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('category_id', 'category_id', 'required');
		$this->form_validation->set_rules('teacher_id', 'teacher_id', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');

        $this->load->model('admin/medias_model');
        //if($this->input->post('chb_free_courses')=='0'){
       // $this->form_validation->set_rules('subscription_default', 'subscription_default', 'required');
       // }
	   
	    $plan = $this->input->post('plan');
		if($plan == 'subscription')
		{
         if($this->input->post('chb_free_courses')=='on' && $this->input->post('step_access_courses')=='0')     {
         $this->form_validation->set_rules('selected_course', 'courses', 'required');

        }
        if($this->input->post('chb_free_courses')=='on'){
        $this->form_validation->set_rules('subscription_default', 'subscription', 'required');
        }


        //if($this->input->post('subscription_default') == '1')
        if($this->input->post('subscription_default')){
        $this->form_validation->set_rules('subscriptions', 'subscription checkbox', 'required');

                $subarr=$this->input->post('subscription_price');
                 if(count($subarr)>0)
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

         $this->form_validation->set_rules('subscription_default', 'subscription', 'required');
        }
		elseif($plan == 'fixed')
		{
			$this->form_validation->set_rules('fixedrate', 'fixedrate', 'required');
		}

		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{ 
		    
			//load the view and the layout
			$this->template->build('admin/programs/create');
		}
		else
		{
		  
		    $data['programs'] = $this->programs_model->getItems($this->input->post('id', TRUE));			
			
            //$orderingval = $this->programs_model->maxorder();
			$this->template->set('programs',$data['programs']);
			
			
		
			
			
			//$this->upload_image();			 
            $imagename = null;
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
                          foreach($selected_course1 as $value) {
                  		   		if($value == "-1") {
                                      $selected_course_string='-1';
                                      break;
                  				}
                  				else {
                  					$selected_course_string .= $value."|";
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
            $chb_free_courses = (isset($chb_free_courses) && ($chb_free_courses == 1)) ? 1 : 0;
            $webcam_option = $this->input->post('webcam_option');
            $showresult_option = $this->input->post('show_result');
            $webcam_option = (isset($webcam_option) && ($webcam_option == 'on')) ? 1 : 0;
            $showresult_option = (isset($showresult_option) && ($showresult_option == 'on')) ? 1 : 0;
            //$published = ($this->input->post('published' && ($this->input->post('published') == 0))) ? 1 : 0;
            //echo $published = $this->input->post('published');exit;
            $published = $this->input->post('published');

            	$fixedrate = "0.00";
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
				'fixedrate' => $fixedrate,     //$this->input->post('fixedrate'),
				'skip_module' => '0',          //$this->input->post('skip_module'),
				'chb_free_courses' => $chb_free_courses,
				'step_access_courses' => $access_coursesforcond,//$this->input->post('step_access_courses'),
				'selected_course' => trim($selected_course_string,"|"),
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
                'time_for_webcam' => $this->input->post('CbShot'),
                'show_result' => $showresult_option,
                'introtext' => $assistant_teachers,
                'programmedias'=>$mediafile_id,
                'prerequisitesfiles'=>$preqfiles_id,
                'demoprice' => $this->input->post('demofixedrate'),
                'modify_date' => date('M d, Y'),
			);
		
		

         // echo"<pre>";
         // echo "free_coursesforcond".$free_coursesforcond."<br>";
         // echo "access_coursesforcond".$access_coursesforcond."<br>";
         // echo "planforcond".$planforcond."<br>";
         // print_r($_POST);
         // print_r($form_data);
         // exit('yes');
			
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
				$this->programs_model->insertRenewals($renewal_data);
				$j++;
			}
		}

	}
      // if($this->input->post('media_id')){


      // if($mediaid){
        //$get_mediaid = $mediaid;
      // $mediafile_id = $this->input->post('mediafiles');
     //  }else{
      
      // if($this->input->post('mediafiles') != ''){
      //  $mediafile_id = rtrim($this->input->post('mediafiles'), ",");
      //  $get_mediaid = explode(',',$mediafile_id);
      //  $count_mediaid = count($get_mediaid);
      //  $access = ($this->input->post('access') ? $this->input->post('access') : 0);

      //  }else{
      //   $this->medias_model->deleteExerciseFile($id);
      //   $mediaid = $this->input->post('media_id');
        
      //   $access = ($this->input->post('access') ? $this->input->post('access') : 0);
      //   $get_mediaid = $mediaid;
      //  }
    
      //  if(isset($get_mediaid) && $get_mediaid != ''){
      //  $i=0; foreach($get_mediaid as $getmediaid){

      //        $ins_data = array(
						//    'type' => 'pmed',
						//    'type_id' => $id,
						//    'media_id' => $get_mediaid[$i],
						//    'mainmedia' => 1,
      //                      'access' => $access[$i]
					 //   );


      //                  $this->programs_model->insertMediarel($ins_data);
      //                  $i++;
      //   }  }

  //       if($this->input->post('preqfiles')!= ''){
  //       $reqfile_id = rtrim($this->input->post('preqfiles'), ",");
  //       $get_reqid = explode(',',$reqfile_id);
  //       $count_mediaid = count($get_reqid);

  //       }else{
  //       $this->medias_model->deleteReqfiles($id);
  //       $reqid = $this->input->post('req_id');
  //       $get_reqid = $reqid;
  //       }
  //       if(isset($get_reqid) && $get_reqid != '')
		// {
		// 	$i=0; foreach($get_reqid as $getreqid){
		// 		 $ins_data = array(
		// 					   'type' => 'preq',
		// 					   'type_id' => $id,
		// 					   'media_id' => $get_reqid[$i],
		// 					   'mainmedia' => 1
		// 				   );

		// 				   $this->programs_model->insertMediarel($ins_data);
		// 				   $i++;
		// 	}
		// }
		
		if ($isupdated) // the information has therefore been successfully saved in the db
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
			foreach ($files_to_delete as $index)
			{
				if ( is_file(FCPATH.'public/uploads/programs/img/'.$index) )
					unlink(FCPATH.'public/uploads/programs/img/'.$index);

				if ( is_file(FCPATH.'public/uploads/programs/img/thumbs/'.$index) )
					unlink(FCPATH.'public/uploads/programs/img/thumbs/'.$index);
			}
		   	//redirect('admin/programs/'.$parent_id);
		   		if((!empty($_POST['edit2'])) && ($_POST['edit2']=='Save & Back to list'))
			   	{
			   			//redirect('manage/courses/'.$parent_id);
			   	redirect('admin/course-manager/'.$parent_id);

			   }
			   else
			   {
			   	 redirect('admin/edit/courses/'.$id);
			   	 
			   
			   }
		}
		else{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				redirect('admin/course-manager/'.$parent_id);
			}
	  	}
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
			redirect('admin');
		}
	}
	

	function trash($id = NULL)
	{
		$users_id = $this->programs_model->getBuyUsers($id);
		$users_id2 = $this->programs_model->getBuyUsers2($id);
		if($users_id && $users_id2)
		{
			echo "Users are Enrolled to this Course. You cannot delete it.";
		//alert('Users are Enrolled to this Course. You cannot delete it.');
		
		}
		else
		{
   
				//filter & Sanitize $id
				$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

				//redirect if it´s no correct
				if (!$id){
					echo "Course not exists!";
				}
				$isdelete=$this->programs_model->trashItem($id);
				//delete the item
				if ($isdelete)
				{
				    echo "Course has been deleted.";
				}
				
			   	// redirect('admin/course-manager');
				}
	}
	
	
	/*function trash($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/programs/');
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
	   	redirect('admin/programs');
	} */
	
	function trashstudent($id = NULL)
	{
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-manager/');
		}
		$isdelete=$this->programs_model->trashEnroll($id);
	   	redirect('admin/course-manager');
	}
	function trashEnrollstudent($id = NULL)   //new action for trash enrolled student
	{
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		 $course_id= $this->uri->segment(5);
		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-manager/');
		}
		$isdelete=$this->programs_model->trashEnrollStud($id,$course_id);
	   	redirect('admin/programs/enrolled/'.$course_id);
	}

	function getenrollstudent($id = NULL)     //new action for show enrolled student
	{
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
			$course_id= $this->uri->segment(5);
		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-manager/');
		}
		$isdelete=$this->programs_model->repostTrashEnroll($id,$course_id);
	   	redirect('admin/programs/enrolled/'.$course_id);
	}
	
	function enrollstudent($id = NULL)
	{
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-manager/');
		}
		$isdelete=$this->programs_model->repostTrash($id);
	   	redirect('admin/course-manager');
	}
	
	function repost($id = NULL)
	{
		$isdelete = $this->programs_model->repostItem($id);
		redirect('admin/course-manager');
	}


	function deletereview()
	{
		$id = $this->uri->segment(4);
		$pid = $this->uri->segment(5);


       if ($id){
			
			$deleted =  $this->programs_model->deletereview($id);

			if($deleted)
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
                redirect('admin/programs/reviews/'.$pid);
			}
		}
	}
	
	function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-manager/');
		}
		$isdelete=$this->programs_model->deleteItem($id);
		//delete the item
		if ($isdelete)
		{
		    $this->programs_model->deleteProgramPlan($id);
            $ExerciseFile = $this->medias_model->deleteExerciseFile($id);
            $Reqfiles = $this->medias_model->deleteReqfiles($id);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}
	   	redirect('admin/course-manager');

	}

	public function publish($pid = FALSE){
	$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/course-manager/');
			}
		else{
				$upd_data = array(
					'published' => 1
				);
				$in_ids = $pid;
				$publish=$this->programs_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course publish action fail or already published!' ) );
				}
				redirect('admin/course-manager');

			}
	}

	public function unpublish($pid = FALSE){
		$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/course-manager/');
			}
		else{
				$upd_data = array(
					'published' => 0
				);
				$in_ids = $pid;
				$unpublish=$this->programs_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course unpublish action fail or already unpublished!' ) );
				}
				redirect('admin/course-manager');

			}
	}

	public function activation($action = FALSE, $pid = FALSE)
	{
	$this->uri->segment(5);
	$pid = ($this->uri->segment(5) != 0) ? filter_var($this->uri->segment(5), FILTER_VALIDATE_INT) : NULL;
	$action = ($this->uri->segment(4) != '') ? filter_var($this->uri->segment(4), FILTER_SANITIZE_STRING) : NULL;
		//redirect if it´s no correct
		if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/course-manager/');
			}
		if($action=='deactivate'){
		$action=0;
		}else if($action=='activate'){
		$action=1;
		}else{
		$action=NULL;
		}

	$activation=$this->programs_model->activationItem($pid,$action);

		//delete the item
		if ($activation)
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course activation updated successfully!' ));
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course activation fail!' ) );
		}
		redirect('admin/course-manager');
	}

	private function set_upload_options($controller)
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = FCPATH.'public/uploads/'.$controller.'/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']	= TRUE;
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		//create controller upload folder if not exists
		if (!is_dir($config['upload_path']))
		{
			mkdir(FCPATH."public/uploads/$controller/");
			mkdir($config['upload_path']);
			mkdir($config['upload_path']."thumbs/");
		}

		return $config;
	}


	private function set_thumbnail_options($info_upload, $controller)
	{
		$config = array();
		$config['image_library'] = 'gd2';
		$config['source_image'] = FCPATH.'public/uploads/'.$controller.'/img/'.$info_upload["file_name"];
		$config['new_image'] = FCPATH.'public/uploads/'.$controller.'/img/thumbs/'.$info_upload["file_name"];
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['master_dim'] = 'width';
		$config['width'] = 100;
		$config['height'] = 100;
		$config['thumb_marker'] = '';

		return $config;
	}
    function check_default($post_string)
    {
      return $post_string == '-1' ? FALSE : TRUE;
    }
	
	public function viewuserreport()
    {
        $userid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
        $progid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

        $userinfo=$this->programs_model->getUserInfo($userid);
        $courseinfo=$this->programs_model->getProgramById($progid);
        $finalexamid=$courseinfo->id_final_exam;
        $certterm=$courseinfo->certificate_term;

        if($finalexamid)
        {
            $coursequizinfo=$this->programs_model->getQuizTakenByUIdPID($userid,$progid,$finalexamid);
            if(count($coursequizinfo)>0)
            {
            list($rq,$tq)=explode('|',$coursequizinfo[0]['score_quiz']);
            $res=($rq/$tq)*100;
            }
            else
            {
              $res=0;
            }
            //print_r($coursequizinfo);
        }
        else
        {
			$coursequizinfo=array();
			$rq=0;
			$tq=0;
			$res=0;
        }
	   
       $coursecompleted=$this->programs_model->courseCompleted($userid,$progid); // view all lession
       $quizinfo=$this->programs_model->getQuiz($finalexamid);
       $scores_avg_quizzes=$this->programs_model->getAvgScoresQ($userid,$progid);
       $avg_quizzes_cert=$this->programs_model->getAvgpercert();

       $hascertficate = FALSE;
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
		
       $this->template->set_layout('backend');
       $this->template->set('action',"userdetail");
       $this->template->set("userinfo", $userinfo);
       $this->template->set("courseinfo", $courseinfo);
       $this->template->set("coursequizinfo", $coursequizinfo);
       $this->template->set("hascertficate", $hascertficate);
       $this->template->set("certterm", $certterm);
       $this->template->build('admin/programs/seereport');
    }
	
	public function viewuserquiz()
    {
        $userid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
        $progid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;

		$userinfo=$this->programs_model->getUserInfo($userid);
        $courseinfo=$this->programs_model->getProgramById($progid);
		
        $quizinfo=$this->programs_model->getQuizInfo($userid,$progid);				
        $this->template->set_layout('backend');
        $this->template->set('action',"userdetal");
		$this->template->set("userinfo", $userinfo);
        $this->template->set("courseinfo", $courseinfo);
        $this->template->set("quizinfo", $quizinfo);
        $this->template->build('admin/programs/seequiz');
    }
	
	public function viewresult()
    {
        $userid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
		$quizid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;		
		$userinfo=$this->programs_model->getUserInfo($userid);
		$resultinfo=$this->programs_model->getUserQuizResult($quizid);		
        $this->template->set_layout('backend');
		$this->template->set("userinfo", $userinfo);
		$this->template->set("resultinfo", $resultinfo);
        $this->template->build('admin/programs/quizresult');
    }
    public function deleteDemo()
    {
    	$this->programs_model->deleteDemo_model();
    	$this->programs_model->deleteDemocategory_model();
    	$this->programs_model->deletemediacategory_model();
    	$this->programs_model->deletemedia_model();
    	$this->programs_model->deleteDemoUser_model();
    	echo"delete";
    }

   function cropcourseimg($img)
	{
		$course_id = $this->uri->segment(5);
		if($img == '') $img = 'no_images_course.png';
		$data['img'] = $img;
		$data['course_id'] = $course_id;
		$this->template->build('admin/programs/cropcourseimg_new', $data);
	}

	public function uploadcourseimg()
    {			  

    	   
    $data = $_POST['img']; 
 
    	$img_name = trim($_POST['img_name']);  
    	// $data = str_replace('data:image/png;base64,', '', $data);
    	$str_img = explode(',', $data);
    	// $data = str_replace('data:image\/[a-z]+;base64,',  '', $data);
    	$data = $str_img[1];
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
  		$generate1 = date('His').'_'.$month.'-'.$date.'-'.$year;

		/*	$imgnm = explode('.', $img_name);
  		if($imgnm[0]=='no_images' || $imgnm[0]=='no_images_course' || $imgnm[0]=='no_images_category')
  		{
  			$img_name = '';
  		}
  		if($img_name)
  		{
  			  		

  			if($imgnm[1])
  			{
  				echo $img_name;

  			}else{
  				$img_name = $img_name.'.jpg';
  			echo $img_name;

  			}
  			
  		}
  		else
  		{
  			$img_name = $generate1.'.jpg';
  			echo $img_name;
  		}*/
  		$img_name = $generate1.'.jpg';
  		echo $img_name;
		
  		//echo $generate1 . '.png';
  		$f1 = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$img_name;
         $f2 = FCPATH.'public/uploads/programs/img/thumbs/'. $img_name;

    //      if(file_exists($f1) || file_exists($f2))
    //      {      	
    //      	    $generate1 = "";
				// $date = date('d');
		  // 		$month = date('m');
		  // 		$year = date('Y');
		  // 		$random_no = rand(1000,5000);
		  // 		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;
		  // 		echo $img_name;
    //      }
    //      else
    //      {
         	// echo $img_name;
         // }
		
		$file2 = FCPATH.'public/uploads/programs/img/thumb_232_216/'. $img_name;
		if(file_put_contents($file2, $data))//for upload file to the server
		{
			$imageorig = FCPATH.'public/uploads/programs/img/thumb_232_216/'. $img_name;  
			 			list($width, $height, $type, $attr) = getimagesize($imageorig);			 		
			 	     $newhgt =  $height / $width * 130;		
			

			 	     $orig = FCPATH.'public/uploads/programs/img/thumb_232_216/'. $img_name;
               $newsizeimg = FCPATH.'public/uploads/programs/img/thumbs/'. $img_name;
               ///////////

            $this->load->helper('create_square_image');

            create_square_image($orig,$newsizeimg,130);
           // file_put_contents($file2_sm, $data);
		}
		////////////small img////////////////
	

		 $source_path =  FCPATH.'public/uploads/programs/img/thumb_232_216/'.trim($img_name);
      $target_path = FCPATH.'public/uploads/programs/img/thumb_232_216/'.'thumbnail/';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'create_thumb' => TRUE,
          'thumb_marker' => '',
          'width' => 305,
          'height' => 172
      );


      $this->load->library('image_lib', $config_manip);
       if (!$this->image_lib->resize()) {
          $this->image_lib->display_errors();
      }


      $this->image_lib->clear();

		$course_id = $this->uri->segment(4);
		//echo $this->uri->segment(4);
		if($this->uri->segment(5) == 'courseedit')
		{

		$form_data =  array(						
					'image' => trim($img_name)						
					);
 		$this->programs_model->updateItem($course_id,$form_data);

 	   } 
 	   
		
    }

	

    function removeEnrollstudent($id = NULL)   //new action for trash enrolled student
	{
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		 $course_id= $this->uri->segment(5);
		 $enroll_id= $this->uri->segment(6);
		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-manager/');
		}
		$isdelete=$this->programs_model->removeEnrollStud($id,$course_id,$enroll_id);
	   	redirect('admin/programs/enrolled/'.$course_id);
	}

	public function view_frontsite()
    {       

      $u_data=$this->session->userdata('loggedin');
         
                $quizzes = 0;
                $courses = 0;
                $media = 0;
                $users = 0;
                $course = 0;
          foreach($u_data['modper'] as $permi)
          {    
              if($permi['modules'] == 'quizzes')
               {
                  $quizzes = $permi['permission'];
               }
               else if($permi['modules'] == 'courses')
               {
                  $courses = $permi['permission'];
               }
               else if($permi['modules'] == 'media')
               {
                  $media = $permi['permission'];
               }
               else if($permi['modules'] == 'users')
               {
                  $users = $permi['permission'];
               }
               else if($permi['modules'] == 'course media')
               {
                  $quizzes = $permi['permission'];
               }
            
          }
          $data = array('quizzes' =>$quizzes , 
              'courses' =>$courses ,
              'media' =>$media ,
              'users' => $users,
              'course media' =>$quizzes ,
                       );
           
               
         $this->session->set_userdata('logged_in',$u_data);
         $datanew = $this->session->userdata('logged_in');

         $this->session->set_userdata('maccessarr',$data);
         $maccessarr = $this->session->userdata('maccessarr');        
        return true;
    }

    public function coursepreview($program_id1,$day_id1,$lesson_id1)
	{	

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

	  $program_id = ( $program_id1 )  ? $program_id1 : NULL;

      $day_id = ( $day_id1 )  ? $day_id1 : NULL;

	  $lesson_id = ( $lesson_id1 )  ? $lesson_id1 : NULL;

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
		$this->template->set("date_enrolled", $date_enrolled);

	  $lessonsContent = $this->program_model->getLessonContent($lesson_id,$day_id,$program_id);
		$this->template->set("lessonsContent",$lessonsContent);

		$this->template->set("programnavarray", $programnavarray);

		
	
		$lessoninfo = $this->Tasks_model->getLesson($program_id,$day_id,$lesson_id);

		$this->template->set("exercise", $this->program_model->getExercise($program_id));

		 $this->template->set("webinars", $this->program_model->getWebinars($program_id));
	
		$this->template->set("query_details", $query_details);
	
	
	
		$this->template->set("settings", $settings);
	
		$this->template->set("tmpl", $tmpl);
	
		$this->template->set("program_id", $program_id);
	
		$this->template->set("user_id", $user_id);
	
		$this->template->set("programdetail", $programdetail);

		$this->template->set("moduleid", $day_id);
	
		$this->template->set("viewedLesson", $viewedLesson);
	
		$this->template->set("isComplete", $isComplete);
	
		$this->template->set("lesson", $this->Tasks_model->getLessonNew($program_id,$day_id,$lesson_id));
	
		//$this->template->set("lessoncontent", $this->Tasks_model->getLessonContent($lesson_id));
       
		//$this->template->set("lec_content", $this->Tasks_model->getContent($lesson_id));
	
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




		$datestring = "%Y-%m-%d %h:%i:%s";

		$time = time();
		$fff = $this->Tasks_model->getLessonNew($program_id,$day_id,$lesson_id);
		
		  $this->template->build('programs/coursepreview');

		
	}

	function popup_after_course()
	{
		$this->template->build('admin/programs/create_lectr_pop');
	}

	function copyCourse()
	{
		    $course_id = $_POST['cbcourse'];
			$course_name = $_POST['coursename'];

			$select_course = $this->programs_model->getCourseForCopy($course_id);
			$select_days = $this->programs_model->getDaysForCopy($course_id);
			$orderingval = $this->programs_model->maxorder();		
			$title = $course_name;
	      		    
	                $titleURL = strtolower(url_title($title));
	                $title2 = $titleURL;
	            
                $avail_slug = $this->programs_model->matchCourse_slug($titleURL,$course_id);
                $i = 0;
	               if(in_array($titleURL, $avail_slug))
	               {
				    do{
				      $i++;
				      $titleURL = $title2.'-'.$i;
				    } while(in_array($titleURL, $avail_slug));
				  }
	
			$data = array(
				'catid' => $select_course->catid,
				'name' =>  $course_name,//$select_course->name.' '.'Copy',
				'slug' => $titleURL,
				'alias' => $course_name,       //$select_course->alias.' '.'Copy',
				'description' => $select_course->description,				
				'introtext' => $select_course->introtext,
				// 'image' => $select_course->image,
				'emails' => $select_course->emails,
				
				'published' => $select_course->published,
				'startpublish' => $select_course->startpublish,
				'endpublish' => $select_course->endpublish,
				'metatitle' => $select_course->metatitle,
				'metakwd' => $select_course->metakwd,
				'metadesc' => $select_course->metadesc,
				
				'ordering' => $orderingval,
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
				'created_by' => $select_course->created_by,
				'modify_date' => date('M d, Y'),
				'is_drip_course' => $select_course->is_drip_course,
                'release_type' => $select_course->release_type,
                 'learn_points' => $select_course->learn_points,
                'preview' => $select_course->preview,
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

               $lessons = $this->days_model->getLessonsData2($days->id);

               foreach($lessons as $lesson)
               {
               		$data_task = array(
               				'name' => $lesson->name, 
               				'section_id' => $day_id,
               				'p_id' => $program_id,
               				// 'alias' => $lesson->alias ? $lesson->alias : $lesson->name,
               				// 'category' => $lesson->category,
               				'difficultylevel' => $lesson->difficultylevel,
               				// 'points' => $lesson->points,
               				// 'image' => $lesson->image,
               				
               				'lecture_video' => $lesson->lecture_video,
               				'published' => $lesson->published,
               				'startpublish' => $lesson->startpublish,
               				'endpublish' => $lesson->endpublish,
               				'metatitle' => $lesson->metatitle,
               				'metakwd' => $lesson->metakwd,
               				'metadesc' => $lesson->metadesc,
               				'ordering' => $lesson->ordering,
               				// 'step_access' => $lesson->step_access ? $lesson->step_access : '1',
               				// 'final_lesson' => $lesson->final_lesson ? $lesson->final_lesson : '0',
               				'created_by' => $lesson->created_by,
               				'lecture_content' => $lesson->lecture_content,
               				'layoutid' => $lesson->layoutid,
               				'is_exam' => $lesson->is_exam,
               				'is_demo' => $lesson->is_demo,
               				'lecture_duration' => $lesson->lecture_duration,
               				'lecture_type' => $lesson->lecture_type

               	          );

               		// $tid = $this->programs_model->insertTaskItems($data_task);
               		$tid = $this->programs_model->insertLectItems($data_task);
               		echo $tid; 
               }            
               
              
			}
	}

	function update_slug(){
		$all_pro = $this->programs_model->getProgram();
			foreach ($all_pro as $pro) {
				echo $pro->name.' -> '.$pro->id.' <br>';
				$title = strip_tags($pro->name);
                $titleURL = strtolower(url_title($title));
                $title2 = $titleURL;
                $avail_slug = $this->programs_model->matchCourse_slug($titleURL,$pro->id);
                $i = 0;
	               if(in_array($titleURL, $avail_slug))
	               {
				    do{
				      $i++;
				      $titleURL = $title2.'-'.$i;
				    } while(in_array($titleURL, $avail_slug));
				}

				$form_data = array(
				'name' => $pro->name,
				'slug' => $titleURL,);
			$isupdated=$this->programs_model->updateItem($pro->id,$form_data);
			echo "update: ".$isupdate."<br>";

			}
			
	}

	public function check_dup()
	{
		$slug = $this->input->post('slug');
		$id = $this->input->post('id');
		
		$get_res = $this->programs_model->matchCourse_slug($slug,$id);
		if(!empty($get_res))
		{
			print_r("0");
		}
		else
		{
			print_r("1");
		}
	}

	public function generate_QR()
	{
		$id = $this->input->post('id');
		$catid = $this->input->post('catid');
		$url_link = "https://myonlineshiksha.com/";
      	$text1234 = $url_link."online-courses/".$catid."/";
      	$SERVERFILEPATH = getcwd().'/public/uploads/programs/qr_code/';
       
      	$text1= substr($text1234, 8,8);
      
      	$folder = $SERVERFILEPATH;
      	$file_name1 = $text1.$id."-Qrcode".rand(0,9999).".png";
      	$file_name = $folder.$file_name1;
      	QRcode::png($text1234,$file_name,8,8);
      	$form_data = array(
      			'qrcode' => $text1234,
                'qr_image' => $file_name1,
                'url_link' => $text1234,
			);
			
		$isupdated=$this->programs_model->updateItem($id,$form_data);
		echo $file_name1;
	}

	public function create_batch($course_id){
		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
			$data = array(
						'heading' 			=> "Create new Batch",
						'action_url' 		=> base_url().'admin/programs/action_create',
						'batch_name'		=> set_value('batch_name'),
						'batch_from'		=> set_value('batch_from'),
						'batch_start_time' 	=> set_value('batch_start_time'),
						'batch_end_time' 	=> set_value('batch_end_time'),
						'enroll_limit' 		=> set_value('enroll_limit'),
						'teacher_id' 		=> set_value('teacher_id'),
						'id' 				=> set_value('id'),
						'course_id' 		=> $course_id,
						'button'			=> 'Create'
			);
			$this->template->set_layout('backend');
			$this->template->build('admin/live_classes/create',$data);
		}
		else
		{
			redirect(base_url());
		}
	}

	public function update_batch($batch_id,$course_id){
		$auth = $this->session->userdata('logged_in');		
		if(!empty($auth)){
			$batch = $this->Crud_model->get_single('mlms_batches',"id = ".$batch_id);
			if(!empty($batch)){
				$data = array(
							'heading' 			=> "Edit Batch details",
							'action_url' 		=> base_url().'admin/programs/action_create',
							'batch_name'		=> $batch->batch_name,
							'batch_from'		=> date('Y-m-d',strtotime($batch->batch_from)),
							'batch_start_time' 	=> $batch->batch_start_time,
							'batch_end_time' 	=> $batch->batch_end_time,
							'enroll_limit' 		=> $batch->enroll_limit,
							'teacher_id' 		=> $batch->teacher_id,
							'id' 				=> $batch_id,
							'course_id' 		=> $course_id,
							'button'			=> 'Update'
				);
				$this->template->set_layout('backend');
				$this->template->build('admin/live_classes/create',$data);
			}else{
				redirect('admin/edit/courses/'.$course_id);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function delete_batch(){
		$id = $this->input->post('id');
		$events = $this->Crud_model->GetData('zoom_meeting_list','','is_delete = "no" and batch_id = '.$id);
		if(!empty($events)){
			echo "denied";
		}else{
			$data = array(
						'is_delete'=> 'yes'
			);
			$this->Crud_model->SaveData('mlms_batches',$data,"id = ".$id);
			echo "deleted";
		}
	}

	public function action_create(){
		$course_id = $this->input->post('course_id');
		$id = $this->input->post('id');

		$batch_name = $this->input->post('batch_name');
		$batch_from = $this->input->post('batch_from');
		$batch_start_time = $this->input->post('batch_start_time');
		$batch_end_time = $this->input->post('batch_end_time');
		$enroll_limit = $this->input->post('enroll_limit');
		$teacher_id = $this->input->post('teacher_id');
		if(empty($teacher_id))
			$teacher_id = null;

		$data = array(
				'course_id' 		=> $course_id,
				'batch_name' 		=> $batch_name,
				'batch_from' 		=> date('Y-m-d',strtotime($batch_from)),
				'batch_start_time' 	=> date('H:i:s',strtotime($batch_start_time)),
				'batch_end_time' 	=> date('H:i:s',strtotime($batch_end_time)),
				'enroll_limit' 		=> $enroll_limit,
				'teacher_id' 		=> $teacher_id,
		);
		// print_r($data);exit;
		if(!empty($id)){
			$this->Crud_model->SaveData('mlms_batches',$data,"id = ".$id);
			$this->session->set_flashdata('message',array( 'type' => 'success', 'text' => 'Batch Updated.'));
		}else{
			$this->Crud_model->SaveData('mlms_batches',$data);
			$id = $this->db->insert_id();
			$this->session->set_flashdata('message',array( 'type' => 'success', 'text' => 'Batch Created.'));
		}
		$this->session->set_userdata('webmsg',$id);
		redirect('admin/edit/courses/'.$course_id);
	}

}