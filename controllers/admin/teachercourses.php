<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Teachercourses extends MLMS_Controller {



	function __construct()

	{

		parent::__construct();

		$this->authenticate();

        $this->load->helper('url');

		$this->load->model('admin/programs_model');

        $this->load->library('ckeditor');

        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';

		$this->lang->load('tooltip', 'english');

    $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);
    error_reporting(0);



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


    public function index($parent_id = NULL)

	{

       $parent_id = NULL;



       $this->template->set_layout('backend');

       $this->template->title('My Courses');

       $this->template->title('Courses List');

       $this->template->set('action',"mycoursereport");



       $userloggedinfo=$this->session->userdata('loggedin');



       $assignprogram=$this->programs_model->getCoursesByTeacherId($userloggedinfo['id']);

       //echo "<pre>";

       //print_r($assignprogram);

       //print_r($userloggedinfo);

      // echo "</pre>";

       $this->template->set("programs",$assignprogram);



	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

	   $this->template->build('admin/teachercourses/list');

	}







   public function viewusers()

   {

       $courseid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

       $enrolllist=$this->programs_model->getEnrolledUser($courseid);



       $this->template->set_layout('backend');

       $this->template->set('action',"courseenrollusers");



       $this->template->set("enrolledusers", $enrolllist);

       $this->template->build('admin/teachercourses/list');

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





       $hascertficate =FALSE;

       if($certterm == 2){



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



       if($certterm == 3){





                if( $res >= $quizinfo->max_score){

                $hascertficate = TRUE;

                }

                else{

                $hascertficate = FALSE;

                }





       }



       if($certterm == 4){



                if($scores_avg_quizzes >= intval($avg_quizzes_cert)){

                $hascertficate = TRUE;

                }

                else{

                $hascertficate = FALSE;

                }

            $hascertficate = FALSE;

       }



       if($certterm == 5){



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



       if($certterm == 6){



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

       $this->template->build('admin/teachercourses/list');



   }





    public function viewsnap()

   {

      $snapfoldername = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

      $this->template->set("snapfoldername",$snapfoldername);

      $this->template->build('admin/teachercourses/viewsnap');

   }





   public function aprovecerti()

   {

     $qtid=$this->input->post('qtid');

     $uid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

     $pid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;



     $loggeduserdata=$this->session->userdata('loggedin');

     $issuedby=$loggeduserdata['id'];

     $today=date('Y-m-d');

     $dataarr=array(

     'userid'=>$uid,

     'prog_id'=>$pid,

     'issued_by'=>$issuedby,

     'issued_on'=>$today

     );





     if($this->programs_model->insertCertiData($dataarr))

     {

       redirect('admin/teachercourses/viewusers/'.$pid);

     }



     //redirect('admin/studreport/viewusers/'.$pid);



   }







	public function addcourse()

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



	function create($parent_id = FALSE)

	{



        //print_r($this->input->post('chb_free_courses'));exit;

      //print_r($this->input->post('selected_course'));



        //  echo $course_value;

        //$sub_price = $this->input->post('subscription_price');

        // print_r($sub_price);

        //$this->load->model('admin/medias_model');



        //print_r($get_media_id);exit;



       //$this->template->set("medias", $this->medias_model->getMediaRel($id));

        $sessionarray = $this->session->userdata('loggedin');

        $user_id = $sessionarray['id'];



        $this->template->set_layout('backend');



        $this->load->model('admin/medias_model');

	   //	$this->template->append_metadata(block_submit_button());



		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);

		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		$this->_set_rules();

		$this->template->set('title', lang('web_category_create'));

		$this->template->set('updType', 'create');

		$this->template->set('parent_id',$parent_id);

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



        //if($this->input->post('category_id') == '-1'){

         $this->form_validation->set_rules('category_id','category','required');

	   //	$this->form_validation->set_rules('category_id', 'category_id', 'required');

       // }

       // if($this->input->post('teacher_id') == '- select -'){

	   //	$this->form_validation->set_rules('teacher_id', 'teacher_id', 'required');

        $this->form_validation->set_rules('teacher_id','teacher','required');

       // }

        if($this->input->post('chb_free_courses')=='on' && $this->input->post('step_access_courses')=='0')     {

         $this->form_validation->set_rules('selected_course', 'course', 'required');



        }

        if($this->input->post('chb_free_courses')=='on'){

        $this->form_validation->set_rules('subscription_default', 'subscription', 'required');



        }

        if($this->input->post('subscription_default') == '1'){

        $this->form_validation->set_rules('subscriptions', 'subscription checkbox', 'required');

        //$this->form_validation->set_rules('subscription_price', 'price', 'required');

        }

        $this->form_validation->set_rules('subscription_default', 'subscription', 'required');

		if ($this->form_validation->run() === FALSE)

		{

			$this->template->build('admin/programs/create');

		}

		else

		{

		$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');

		$orderingval = $this->programs_model->maxorder();

		$imagename = ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg';

		$reminders=$this->input->post('reminders');

		if($reminders){

		$reminders = implode(',',$reminders);

		}

	   //$selected_course_array = $this->input->post('selected_course');

	   //$selected_course_string = (!empty($selected_course_array)) ? implode(',',$selected_course_array) : NULL;

       //print_r($_POST);

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

      }

      else{

           $selected_course_string = NULL;

      }



     $subprice = $this->input->post('subscription_price');

     $subplans = $this->input->post('subscriptions');

     // print_r($subprice);

     // print_r($subplans);

      //exit;

      $chb_free_courses = $this->input->post('chb_free_courses');



      $chb_free_courses = (isset($chb_free_courses) && ($chb_free_courses == 'on')) ? 1 : 0;

      $webcam_option = $this->input->post('webcam_option');

      $webcam_option = (isset($webcam_option) && ($webcam_option == 'on')) ? 1 : 0;

      $published = $this->input->post('published');

      $data = array(

				'name' => $this->input->post('name'),

				'description' => $this->input->post('description'),

				'alias' => $alias,

				'catid' => $this->input->post('category_id'),

				//'introtext' => $this->input->post('category_id'),

				'image' => $imagename,

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

				'skip_module' => $this->input->post('skip_module'),

				'chb_free_courses' => $chb_free_courses,

				'step_access_courses' => $this->input->post('step_access_courses'),

				'selected_course' => $selected_course_string,

				'course_type' => $this->input->post('course_type'),

                'lesson_release' => $this->input->post('lesson_release'),

				'lessons_show' => $this->input->post('lessons_show'),

				'start_release' => $this->input->post('startpublish'),

				'id_final_exam' => $this->input->post('final_quizzes'),

				'certificate_term' => $this->input->post('certificate_setts'),

			   //	'hasquiz' => $this->input->post('final_quizzes'),

				'updated' => $this->input->post('certificate_setts'),

				'certificate_course_msg' => $this->input->post('coursemessage'),

                'webcam_option' => $webcam_option,

                'created_by' => $user_id,

                'webstatus' => $this->input->post('webstatus'),

                'webnardescription' => $this->input->post('webnardescription')

			);

       $this->programs_model->insertItems($data);

       $pro_id = $this->programs_model->maxprogramid();



       if($this->input->post('media_id')){

       $mediafile_id = rtrim($this->input->post('mediafiles'), ",");

       $get_mediaid = explode(',',$mediafile_id);

       $count_mediaid = count($get_mediaid);

       //$access = $this->input->post('access');

       $access = ($this->input->post('access') ? $this->input->post('access') : 0);

       $i=0;

       foreach($get_mediaid as $getmediaid){

             $ins_data = array(

						   'type' => 'pmed',

						   'type_id' => $pro_id,

						   'media_id' => $get_mediaid[$i],

						   'access' => $access[$i]

					   );

                     // print_r($ins_data);

                       $this->programs_model->insertMediarel($ins_data);

                       $i++;

                     //  print_r($ins_data);

       }  }

       //exit;



      if($this->input->post('req_id')){

       $mediafile_id = rtrim($this->input->post('preqfiles'), ",");

       $get_reqid = explode(',',$mediafile_id);

       $count_mediaid = count($get_reqid);

       $i=0;

       foreach($get_reqid as $getreqid){

             $ins_data = array(

						   'type' => 'preq',

						   'type_id' => $pro_id,

						   'media_id' => $get_reqid[$i],

						   'mainmedia' => 1

					   );



                       $this->programs_model->insertMediarel($ins_data);

                       $i++;

                     //  print_r($ins_data);

             }



       }



       $plans = $this->input->post('subscriptions');

	   // print_r($plans);exit;

	   $plans = (!empty($plans)) ? $plans : array(0=>0);

       //print_r($plans); exit;

       $price = ($this->input->post('subscription_price')) ? $this->input->post('subscription_price') : '0';

       $sub_default = $this->input->post('subscription_default');

		if($plans[0] !=0 ){

		$i=0;

		 foreach($plans as $element) {

		  // if($plans[$i] != '' && $price[$i] == ''){

             // $plans[$i] = '0';

		  // }

		   $sub_default == $element ? $default = '1' : $default = '0';

				$plans_data = array(

						   'product_id' => $pro_id,

						   'default' => $default,

						   'plan_id' => $plans[$i],

						   //'price' => $price[$i]

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

						   'plan_id' => $ren_plans[$j],

						   'price' => $renprice[$element1]

					   );

				// print_r($renplans_data); exit;

				$this->programs_model->insertRenewals($renplans_data);

				$j++;

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

			redirect('admin/programs/'.$parent_id);

		}

	}



	function edit($id = FALSE, $parent_id = FALSE)

	{ //print_r($_POST);exit;

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

			redirect('admin/programs/');

		}

		//create control variables

		//$this->template->title(lang("web_category_edit"));

      //  print_r($this->medias_model->getMedia($id));

        $type = 'preq';

		$this->template->title("Edit Program");

        $this->template->set('groups',$this->programs_model->getGroup());

        $this->template->set('courses',$this->programs_model->getCourse());

        $this->template->set("medias", $this->medias_model->getMediaRel($id));

        $this->template->set("rerequisites", $this->medias_model->getReqRel($id));

		$this->template->set('program', $this->programs_model->getItems($id,'','',''));

		$this->template->set('updType', 'edit');

		$this->template->set('id', $id);

		$this->template->set('parent_id', $parent_id);

		$this->template->set('categories',$this->programs_model->get_formatted_combo($parent_id));

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

		$this->form_validation->set_rules('teacher_id', 'teacher_id', 'required');



        $this->load->model('admin/medias_model');

        //if($this->input->post('chb_free_courses')=='0'){

       // $this->form_validation->set_rules('subscription_default', 'subscription_default', 'required');

       // }

         if($this->input->post('chb_free_courses')=='on' && $this->input->post('step_access_courses')=='0')     {

         $this->form_validation->set_rules('selected_course', 'courses', 'required');



        }

        if($this->input->post('chb_free_courses')=='on'){

        $this->form_validation->set_rules('subscription_default', 'subscription', 'required');

        }



        if($this->input->post('subscription_default') == '1'){

        $this->form_validation->set_rules('subscriptions', 'subscription checkbox', 'required');

        }

         $this->form_validation->set_rules('subscription_default', 'subscription', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed

		{

			//load the view and the layout

			$this->template->build('admin/programs/create');

		}

		else

		{

			$data['programs'] = $this->programs_model->getItems($this->input->post('id', TRUE));

			$this->template->set('programs',$data['programs']);



			foreach ($_FILES as $index => $value)

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

						$this->template->build('admin/programs/create');



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

							$this->template->build('admin/programs/create');



							return FALSE;

						}

					}

				}

			}

            $imagename = null;

            $imagename = ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg';

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



            $chb_free_courses = $this->input->post('chb_free_courses');

            $chb_free_courses = (isset($chb_free_courses) && ($chb_free_courses == 'on')) ? 1 : 0;

            $webcam_option = $this->input->post('webcam_option');

            $webcam_option = (isset($webcam_option) && ($webcam_option == 'on')) ? 1 : 0;

            //$published = ($this->input->post('published' && ($this->input->post('published') == 0))) ? 1 : 0;

            //echo $published = $this->input->post('published');exit;

            $published = $this->input->post('published');

			$form_data = array(

				'name' => $this->input->post('name'),

				'description' => $this->input->post('description'),

				'alias' => $alias,

				'catid' => $this->input->post('category_id'),

				//'introtext' => $this->input->post('category_id'),

				'image' => $imagename,

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

				'skip_module' => $this->input->post('skip_module'),

				'chb_free_courses' => $chb_free_courses,

				'step_access_courses' => $this->input->post('step_access_courses'),

				'selected_course' => $selected_course_string,

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

                'webcam_option' => $webcam_option

			);



			$isupdated=$this->programs_model->updateItem($id,$form_data);

            $this->programs_model->deleteProgramPlan($id);

            $this->programs_model->deleteProgramRenewals($id);

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

						   'plan_id' => $ren_plans[$j],

						   'price' => $renprice[$element]

					   );

			   // print_r($renewal_data);

				$this->programs_model->insertRenewals($renewal_data);

				$j++;

			}

		}

      // if($this->input->post('media_id')){





      // if($mediaid){

        //$get_mediaid = $mediaid;

      // $mediafile_id = $this->input->post('mediafiles');

     //  }else{

      if($this->input->post('mediafiles') != ''){

       $mediafile_id = rtrim($this->input->post('mediafiles'), ",");

       $get_mediaid = explode(',',$mediafile_id);

       //print_r($get_mediaid); exit;

       $count_mediaid = count($get_mediaid);

       $access = ($this->input->post('access') ? $this->input->post('access') : 0);



       }else{

        $this->medias_model->deleteExerciseFile($id);

        $mediaid = $this->input->post('media_id');

        //$access = $this->input->post('access');

        $access = ($this->input->post('access') ? $this->input->post('access') : 0);

        $get_mediaid = $mediaid;

       }

     //  }

       if(isset($get_mediaid) && $get_mediaid != ''){

       $i=0; foreach($get_mediaid as $getmediaid){



             $ins_data = array(

						   'type' => 'pmed',

						   'type_id' => $id,

						   'media_id' => $get_mediaid[$i],

						   'mainmedia' => 1,

                           'access' => $access[$i]

					   );





                       $this->programs_model->insertMediarel($ins_data);

                       $i++;

                     //  print_r($ins_data);

       }  }

       if($this->input->post('preqfiles')!= ''){

       $reqfile_id = rtrim($this->input->post('preqfiles'), ",");

       $get_reqid = explode(',',$reqfile_id);

      // print_r($get_reqid);

       $count_mediaid = count($get_reqid);



       }else{

        $this->medias_model->deleteReqfiles($id);

        $reqid = $this->input->post('req_id');

        $get_reqid = $reqid;

       }

      // print_r($get_reqid);

      if(isset($get_reqid) && $get_reqid != ''){

       $i=0; foreach($get_reqid as $getreqid){

             $ins_data = array(

						   'type' => 'preq',

						   'type_id' => $id,

						   'media_id' => $get_reqid[$i],

						   'mainmedia' => 1

					   );



                       $this->programs_model->insertMediarel($ins_data);

                       $i++;

                     //  print_r($ins_data);

       }

    }

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

			   	redirect('admin/programs/'.$parent_id);

			}



			//if ($category->is_invalid())

			else{

				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );

				redirect('admin/programs/'.$parent_id);

			}

	  	}

	}

	

	public function upload_image()

	{	

	   error_reporting(0);

       $this->load->helper('directory');

	   $this->load->helper('file');

	   $status = "";

	   $msg = "";

	   $ftpfiles_i = array();

	   $file_element_name = 'file_i';

	   if (empty($_POST['type']))

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

		  $config['file_name'] = $_FILES['orig_name'];

          $ftpfiles_i = $_FILES['orig_name'];

	      //print_r($config);

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

	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));

	}

	

	function delete($id = NULL)

	{

		//filter & Sanitize $id

		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;



		//redirect if it´s no correct

		if (!$id){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('admin/programs/');

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

	   	redirect('admin/programs');



	}



	public function publish($pid = FALSE){

	$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$pid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('admin/programs/');

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

				redirect('admin/programs');



			}

	}



	public function unpublish($pid = FALSE){

		$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$pid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('admin/programs/');

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

				redirect('admin/programs');



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

			redirect('admin/programs/');

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

		redirect('admin/programs');

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





}