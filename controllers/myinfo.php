<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myinfo extends MLMS_Controller 
{
    function __construct()
    {
      parent::__construct();
      $this->authenticate();
      $this->load->helper('commonmethods');
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->model('admin/programs_model');
      $this->load->model('program_model');
      $this->load->model('Myinfo_model');
      $this->load->model('admin/settings_model');
      $this->load->model('admin/users_model');
      $this->load->model('Tasks_model');
      $this->load->helper('time_difference'); 
      $this->lang->load('tooltip', 'english');
      $this->load->library('pdf'); // Load library
      $this->pdf->fontpath = 'font/'; // Specify font folder
      $this->load->model('Crud_model');

      $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);
    error_reporting(0);
    }
  
    function authenticate()
    {
      $session = $this->session->userdata('logged_in');
      // print_r($session);
      if(!$this->session->userdata('logged_in'))
      {
       redirect('users/login');
      }
    }

    public function index()
    {
    $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);
    redirect('myinfo/myaccount/');
    //$this->load->model('myinfo/myaccount');
    }

    public function mycertificates()
    {
      $this->session->unset_userdata('sess_cert');
      $this->session->set_userdata(array('searchterm' => ''));
      $configarr = $this->settings_model->getItems();
      // $this->template->set_layout($configarr[0]['layout_template']);
      $tmpl = $configarr[0]['layout_template'];
      $sess_cert = $this->session->userdata('sess_cert');

      if($this->input->post('reset') == 'Reset')
      {
         $search_string = $this->input->post('search_certificates', TRUE);
         $search_string = '';
      }
      else
      {
          $search_string = ($this->input->post('search_certificates', TRUE)) ? $this->input->post('search_certificates', TRUE) : $sess_cert['searchterm'];
          $searchdata = array(
             "searchterm" => $search_string
          );
          $this->session->set_userdata('sess_cert', $searchdata);
      }

      // $this->template->set("tmpl", $tmpl);
      $auth = $this->session->userdata('logged_in');
      $this->load->model('admin/settings_model');
      $user_id = $auth['id'];
      $user_name = $auth['first_name'];
      // $this->template->set("user_name", $user_name);
      // $this->template->set("user_id", $user_id);
      // //$this->template->set("certiapprovestatus", $this->Studreport_model->checkCertificateStatus($user_id));
      // $this->template->set("courses", $this->Myinfo_model->getCourses($user_id,'',addslashes($search_string)));
      // $this->template->set("courseidslist", $this->Myinfo_model->getCourseidsList($user_id));
      // //$this->template->set("coursecompleted", $this->Myinfo_model->courseCompleted($user_id));
      // $this->template->set("config", $this->settings_model->getItems());

      $data['tmpl'] = $tmpl;
      $data['user_name'] = $user_name;
      $data['user_id'] = $user_id;
      $data['courses'] = $this->Myinfo_model->getCourses($user_id,'',addslashes($search_string));
      $data['courseidslist'] = $this->Myinfo_model->getCourseidsList($user_id);
      $data['config'] = $this->settings_model->getItems();

      if($this->session->userdata('logged_in')){

        $this->load->view('new_template_design/header');
        $this->load->view('myinfo/my_certificates', $data);
        $this->load->view('new_template_design/footer');
         // $this->template->build(getOverridePath($tmpl,'myinfo/my_certificates','views'));



       }else{

        $this->load->view('new_template_design/header');
        $this->load->view('user/login', $data);
        $this->load->view('new_template_design/footer');

       }



       $last_page_url = $_SERVER["REQUEST_URI"];



       $this->session->set_userdata('last_page_url',$last_page_url);



    }











  /*  public function mycertificates_org($cid = NULL)



  {



       $tmpl = "default";



       $this->template->set("tmpl", $tmpl);



       $auth = $this->session->userdata('logged_in');



       $user_id = $auth['id'];



       $user_name = $auth['first_name'];



       $id_final_exam = $this->Myinfo_model->getCoursesById($user_id);



       //$quiztaken = $this->template->set("my_certificates", $this->Myinfo_model->getQuizScore($user_id));







       //print_r($auth);



       foreach($id_final_exam as $final_exam){



       $final_exam_id = $final_exam->id_final_exam;



       $nb_ofscores = $final_exam->hasquiz;







       }



       if($final_exam_id !=0){



        $result = $this->Myinfo_model->getScoreQuiz($user_id,$final_exam_id);











    }



    else{



    $result = $this->Myinfo_model->getScoreQuiz($user_id);







    }



          $s = 0;



    foreach ($result as $key=>$value){



      $score = $value->score_quiz;



      if($score !=""){



        $score = explode("|",$score );







         $how_many_right_answers = $score[0];



         $number_of_questions = $score[1];



         $score = intval(($how_many_right_answers/$number_of_questions)*100);



         $s +=$score;



      }







    }



        $nb_ofscores;



        if($nb_ofscores != 0){



      $result_score = intval($s / $nb_ofscores);



    }



       // if(isset($result_score))



     // return $result_score;



       //$result_score;







       $coursecompleted = $this->Myinfo_model->courseCompleted($user_id);



      // echo $maxscore = $this->Myinfo_model->getMaxScore($id_final_exam);



       $this->template->set("score", $score);



       $this->template->set("user_name", $user_name);



       $this->template->set("coursecompleted", $coursecompleted);



       $this->template->set("scores_avg_quizzes", $result_score);



       $this->template->set("avg_quizzes_cert", $this->Myinfo_model->getAvgpercert());



       $this->template->set("courses", $this->Myinfo_model->getCoursesById($user_id));



       $this->template->set("certificates", $this->Myinfo_model->getCertificates($user_id));



     $this->template->build('Myinfo/my_certificates');



  } */


  public function uploadUserimg()
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

        $generate1 . '.png';
    
    $file2 = FCPATH.'public/uploads/users/img/thumbs/'. $generate1 . '.png';
    if(file_put_contents($file2, $data))//for upload file to the server
    {
      
        
    }
    $user_id = $this->uri->segment(3);
    //echo $this->uri->segment(4);
    if($this->uri->segment(4) == 'imageedit')
    {
      $form_data =  array(            
          'images' => $generate1.".png"            
          );
      $this->Myinfo_model->updateItem($user_id,$form_data);
    } 
   }

  public function renew()
  {  
      $course_id = $this->uri->segment(3);  
      $price =  $this->uri->segment(4); 
      $buy_id =  $this->uri->segment(5);  

      //$price = $this->input->post('price'); 
      //$course_id = $this->input->post('course_id'); 

      $external_id = $this->program_model->getExternalId($course_id);

      if($external_id)
      { 
          $this->session->set_userdata('external_id',$external_id->id);
      }

      $sessionarray = $this->session->userdata('logged_in');
      if(!$this->session->userdata('logged_in'))
      {    
          redirect('users/login_form');
      }
      else
      {  
          $this->load->helper('url'); 
          redirect('paypal/renewPlan/'.$course_id.'/'.intval($price).'/'.$buy_id,'refresh');
          //$this->template->build(getOverridePath($tmpl,'paypal/renewPlan/'.$course_id.'/'.intval($price).'/'.$buy_id,'views'));
      }   
  }

  public function mycourses($cid = NULL)
  {
      $this->session->unset_userdata('sess_course');



      $this->session->set_userdata(array('searchterm' => ''));



   $configarr = $this->settings_model->getItems();
    //$this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];



      $sess_course = $this->session->userdata('sess_course');



      if($this->input->post('reset') == 'Reset'){



      $search_string = $this->input->post('search_course', TRUE);



      $search_string = '';



      }else{



      $search_string = ($this->input->post('search_course', TRUE)) ? $this->input->post('search_course', TRUE) : $sess_course['searchterm'];







      $searchdata = array(



      "searchterm" => $search_string



      );



      $this->session->set_userdata('sess_course', $searchdata);



      }



       // $this->template->set("tmpl", $tmpl);

       $data['tmpl'] = $tmpl;

       $auth = $this->session->userdata('logged_in');



       //print_r($auth);



       $user_id = $auth['id'];



       $user_name = $auth['first_name'];



       // $this->template->set("user_name", $user_name);

        $data['user_name'] = $user_name;
         $data['user_id'] = $user_id;
          $data['courses'] = $this->Myinfo_model->getCoursesNew($user_id,'',addslashes($search_string));
           $data['teachingcourses'] = $this->Myinfo_model->getTeachingCourses($user_id,'',addslashes($search_string));
            $data['get_gid'] = $this->Myinfo_model->get_groupid($user_id,'',addslashes($search_string));
             $data['coursecompleted'] = $this->Myinfo_model->courseCompleted($user_id);
             

  //      $this->template->set("user_id", $user_id);



  //      //print_r($this->Myinfo_model->getCourses($user_id,'',$search_string));



  //      //$this->template->set("courses", $this->Myinfo_model->getCourses($user_id,'',addslashes($search_string)));
       
  //      $this->template->set("courses", $this->Myinfo_model->getCoursesNew($user_id,'',addslashes($search_string)));

    // $this->template->set("teachingcourses", $this->Myinfo_model->getTeachingCourses($user_id,'',addslashes($search_string)));
    
    // $this->template->set("get_gid", $this->Myinfo_model->get_groupid($user_id,'',addslashes($search_string)));






  //      $this->template->set("coursecompleted", $this->Myinfo_model->courseCompleted($user_id));











       if($this->session->userdata('logged_in')){

        $this->load->view('new_template_design/header');
        $this->load->view('myinfo/my_courses2', $data);
        $this->load->view('new_template_design/footer');
         // $this->template->build(getOverridePath($tmpl,'myinfo/my_courses','views'));



       }else{

        $this->load->view('new_template_design/header');
        $this->load->view('user/login', $data);
        $this->load->view('new_template_design/footer');
       }



       $last_page_url = $_SERVER["REQUEST_URI"];



       $this->session->set_userdata('last_page_url',$last_page_url);



  }

 public function subscription_plan_popup()
 {
     $pro_id = $this->uri->segment(3);    
    
   $this->load->view('myinfo/subscription_planpop',$pro_id);
 }


     public function listquizstud(){


        error_reporting(0);
       //$this->template->set_layout('frontend');


    $configarr = $this->settings_model->getItems();
    $tmpl = $configarr[0]['layout_template'];



       $pid = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



       if (!$pid){



      redirect('myinfo/mycourses/');



    }



       $this->load->model('Myinfo_model');



       $this->load->model('Tasks_model');



       $this->load->model('Program_model');



       $this->template->set("tmpl", $tmpl);



       $auth = $this->session->userdata('logged_in');



       $user_id = $auth['id']; 



       $stud_name = $auth['first_name'].' '.$auth['last_name'];



       $this->template->set("stud_name", $stud_name);



      //$this->template->set("my_quizzes", $this->Tasks_model->getQuizScore($user_id));



       $my_quizzes = $this->template->set("my_quizzes", $this->Myinfo_model->getQuizNameF($user_id,$pid));



       $courses = $this->template->set("my_courses", $this->Myinfo_model->getCourses($user_id,$pid));



       //  $days = $this->Program_model->getlistDays($pid);



       $this->template->set("days", $this->Program_model->getlistDays($pid));



       /*$days = $this->Program_model->getlistDays($pid);



       foreach($days as $day){



       $lessons = $this->Program_model->getLessons($day->id);



         foreach($lessons as $lesson){



         //  print_r($lesson);



           $this->template->set("lessons_id",$lesson->id);







           }



       }*/



       //print_r($days);









       $this->template->build(getOverridePath($tmpl,'myinfo/listquizstud','views'));

     

       $last_page_url = $_SERVER["REQUEST_URI"];



       $this->session->set_userdata('last_page_url',$last_page_url);



     }



    public function show_quizz_res()
    {
      //$this->template->set_layout('frontend');
      $this->load->model('Program_model');
      $pid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
      $quiz_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
      if (!$pid || !$quiz_id)
      {
          redirect('myinfo/mycourses/');
      }
      $configarr = $this->settings_model->getItems();
      $tmpl = $configarr[0]['layout_template'];
      $this->template->set("tmpl", $tmpl);
      $auth = $this->session->userdata('logged_in');
      $user_id = $auth['id'];
      $user_name = $auth['first_name'];
      $this->template->set("user_name", $user_name);
      $this->template->set("user_id", $user_id);
      $this->template->set("pid", $pid);
      $this->template->set("quiz_id", $quiz_id);
      $this->template->set("courses", $this->Myinfo_model->getCourses($user_id));
      $this->template->set("coursecompleted", $this->Myinfo_model->courseCompleted($user_id));
      // $this->template->set('db_media', $this->Tasks_model->getMedia_oflayout('scr_m',$lesson_id));
      $this->template->build(getOverridePath($tmpl,'myinfo/show_quizz_res','views'));
      $last_page_url = $_SERVER["REQUEST_URI"];
      $this->session->set_userdata('last_page_url',$last_page_url);
    }

    function cropUserImg()
  {
    $this->template->build('myinfo/cropUserImg');
  }

    public function myaccount($cid = NULL)
    {   


  
    $configarr = $this->settings_model->getItems();
    // $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->load->model('Myinfo_model');
    $this->load->model('login_model');
    // $this->template->set("tmpl", $tmpl);
    $auth = $this->session->userdata('logged_in'); 
          
    $user_id = $auth['id'];
    $group_id = $auth['groupid'];
    $user_password = $this->Myinfo_model->getUser($user_id);    
    
  //   $this->template->set("user_id", $user_id);
    // $this->template->set("user", $this->Myinfo_model->getUser($user_id));
    // $this->template->set("bank_info", $this->Myinfo_model->getBankinfo($user_id));
    $data['tmpl'] = $tmpl;
    $data['user_id'] = $user_id;
    $data['user'] = $this->Myinfo_model->getUser($user_id);
    $data['bank_info'] = $this->Myinfo_model->getBankinfo($user_id);

    // $this->template->build(getOverridePath($tmpl,'myinfo/my_account','views'));
    $this->_set_rules();
    //$this->form_validation->set_rules('uname', 'uname', 'trim|required|xss_clean|callback_user_exists');
    //$this->form_validation->set_rules('email_id', 'email_id', 'trim|required|valid_email|callback_email_exists');
    //$this->form_validation->set_rules('email_id', 'email_id', 'trim|required|valid_email|callback__is_unique_email[email_id]');
    $this->form_validation->set_rules('uname', 'uname', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email_id', 'email_id', 'trim|required|valid_email');

    $this->form_validation->set_rules('firstname', 'firstname', 'required|xss_clean');

    $this->form_validation->set_rules('lastname', 'lastname', 'required|xss_clean');
  
    //validate account info
    if($group_id == 5)
    {
      $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');   
      $this->form_validation->set_rules('bank_location', 'Bank Location', 'trim|required');
      $this->form_validation->set_rules('acc_number', 'Account Number', 'trim|required');
      $this->form_validation->set_rules('branch_code', 'Branch Code', 'trim|required');
      $this->form_validation->set_rules('ifcs_code', 'IFSC Code', 'trim|required');
    }
    
    
    
    
    if ($this->form_validation->run() === FALSE)
    {

      if($this->session->userdata('logged_in'))
      {  
        
        $this->load->view('new_template_design/header');
        $this->load->view('myinfo/my_account', $data);
        $this->load->view('new_template_design/footer');

        // $this->template->build(getOverridePath($tmpl,'myinfo/my_account','views'));
      }else{
        $this->load->view('new_template_design/header');
        $this->load->view('user/login', $data);
        $this->load->view('new_template_design/footer');
          // $this->template->build(getOverridePath($tmpl,'user/login','views'));
          
          }
    }
    else
    {
      //exit('yes');
        $rs= $this->upload_image();  
       
      // print_r($rs); 
      $data5 = json_decode($rs,true);
      //$users=$data5['users'];
      $imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : $this->input->post('imagename');
    
       //$imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');
      
      // if($_FILES['file_i']['name'])
      //       {
      //   $imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : $this->input->post('imagename');
         
        
      //     $img_name = $json_decode['ftpfilearray'];    
      //       } 
      //       else
      //       {
      //   $imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : $this->input->post('imagename');
      //   $img_name = $imagename;
      //       } 

       
      if($this->input->post('submit'))
      {
        if($this->input->post('cpassword'))
        {
          //echo 'ram';
          $password = md5($this->input->post('cpassword'));
        }
        else
        {
          //echo 'lakk';
          $password = $user_password->password;
        }

        if($this->input->post('prof_detail'))
        {
            $details = $this->input->post('prof_detail');
        }
        else
        {
            $details = "";
        }
        if($this->input->post('designation'))
        {
          $dest = $this->input->post('designation');
        }
        else
        {
          $dest ="";
        }
        
        //exit('ram');
        $data = array(
  
          'first_name'  =>  $this->input->post('firstname'),
  
          'last_name'   =>  $this->input->post('lastname'),

          'full_bio'   =>  $this->input->post('about_me'),
  
          'username'    =>  $this->input->post('uname'),
          
          'designation'    =>  $dest,
          
          'prof_info'    =>  $details,
  
          'email'     =>  $this->input->post('email_id'),
  
          'password'    =>  $password,
          
          //'images'    =>  $imagename,
  
          'webstatus'   =>  $this->input->post('webinarstatus')
        );
        

        
        $this->Myinfo_model->updateUser($user_id,$data);
        
        if($group_id == 5)
        {
          $bank_details = array(
            
            'bank_name' => $this->input->post('bank_name'),
            
            'branch_location' => $this->input->post('bank_location'),
            
            'acc_number' => $this->input->post('acc_number'),
            
            'branch_code' => $this->input->post('branch_code'),
            
            'ifsc_code' => $this->input->post('ifcs_code')
          );
          
          $this->Myinfo_model->updateBankInfo($user_id,$bank_details);
        }
           
        $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
  
        // redirect('myinfo/myaccount');
        redirect('my-account');
      }
    }
    $last_page_url = $_SERVER["REQUEST_URI"];
    $this->session->set_userdata('last_page_url',$last_page_url);
  }

   public function delete_wishlist()
  {
    
    $sessionarray = $this->session->userdata('logged_in');
    $user_id = $sessionarray['id'];
    $wishlist_id = $this->input->post('wishlist_id');  
    $program_id = $this->input->post('pro_id');   
    
        $this->load->model('Category_model');   
   
    
    $deleted = $this->Category_model->deleteWishlist($wishlist_id);
    
    if($deleted) 
    {
   
      return;
  
        }  
    
  }
   
   public function mywishlists()
   {
      $sessionarray = $this->session->userdata('logged_in');
      $user_id = $sessionarray['id'];
    
        $this->load->model('admin/settings_model');  
    $configarr = $this->settings_model->getItems();
        // $this->template->set_layout($configarr[0]['layout_template']);   
    $tmpl = $configarr[0]['layout_template'];   
    // $this->template->set("tmpl", $tmpl);
    
     
    $this->load->model('Category_model');   
        // $this->template->set("programs", $this->Category_model->getAllProgramWishlist($user_id));       
    $data['tmpl'] = $tmpl;
    $data['programs'] = $this->Category_model->getAllProgramWishlist($user_id);
    
        $this->load->view('new_template_design/header');
        $this->load->view('myinfo/my_wishlist', $data);
        $this->load->view('new_template_design/footer');
    // $this->template->build(getOverridePath($tmpl,'myinfo/my_wishlist','views'));
  } 

 public function upload_image()

    {    
        $date = date('d');
      $month = date('m');
      $year = date('Y');
      $random_no = rand(1000,5000);
      $generate = $random_no.'_'.$year.'-'.$month.'-'.$date;

      $this->authenticate();

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

        $config['upload_path'] = FCPATH.'public/uploads/users/img/thumbs/';

        $config['allowed_types'] = 'gif|jpg|png';

        $config['max_size']  = 1024 * 8;

        $config['encrypt_name'] = TRUE;

        $config['overwrite'] = TRUE;

        $config['file_name'] = $generate.$_FILES['orig_name'];

              $ftpfiles_i = $generate.$_FILES['orig_name'];

           //print_r($config);

        $this->load->library('upload', $config);



        if (!$this->upload->do_upload($file_element_name))

        {

         $status = 'error';

         $msg = $this->upload->display_errors('', '');

        }

        else

        {

        $file_id = true;

        $data = $this->upload->data();

        $file_id = true;

        if($file_id)

        {

          $status = "success";

          $msg = "File successfully uploaded";

            $config = array();

        $config['image_library'] = 'gd2';

          $config['source_image'] = FCPATH.'public/uploads/users/img/'.$data['file_name'];

        $config['new_image'] = FCPATH.'public/uploads/users/img/thumbs/'.$data['file_name'];
      
      $config['create_thumb'] = TRUE;

        $config['maintain_ratio'] = FALSE;

        $config['master_dim'] = 'width';

            $config['width'] = 75;

            $config['height'] = 50;

        $config['thumb_marker'] = '';



            $this->load->library('image_lib', $config);



            $this->image_lib->resize();

          }

          else

      {

        unlink($data['full_path']);

        $status = "error";

        $msg = "Something went wrong when saving the file, please try again.";

      }

        }

        @unlink($_FILES[$file_element_name]);

        }

         $jsn = json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
         return $jsn;
    }



  function user_exists($username) 
  {







                 $user_check = $this->login_model->checkUserName($username);









          if($user_check > 0) {



              $this->form_validation->set_message('user_exists', 'This username is already taken');



              return FALSE;



          }



          else {



              return TRUE;



          }







      }



      function email_exists($email) {







          $check_email = $this->login_model->email_exists($email);







          if($check_email > 0) {



              $this->form_validation->set_message('email_exists', 'This email is already in use');



              return FALSE;



          }



          else {



              return TRUE;



          }







      }







  private function _set_rules($type = 'create', $id = NULL)
  {
    //validate form input
    $this->form_validation->set_rules('firstname', 'lang:web_name', 'required|xss_clean');

    $this->form_validation->set_rules('lastname', 'lang:web_lastname', 'required|xss_clean');

    //$this->form_validation->set_rules('uname', 'lang:web_uname', 'required|xss_clean');

    //$this->form_validation->set_rules('email_id', 'lang:web_email', 'required|valid_email|is_unique[users.email]|xss_clean');

    $this->form_validation->set_rules('cpassword', 'lang:web_password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[cpassword_confirm]');

    $this->form_validation->set_rules('cpassword_confirm', 'lang:web_password_confirm', '');

    $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
  }



  public function myquizandfexam(){


      $this->session->unset_userdata('sess_quiz');

      $sess_quiz = $this->session->userdata('sess_quiz');



     $configarr = $this->settings_model->getItems();
    //$this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];



      if($this->input->post('reset') == 'Reset'){



      $search_string = $this->input->post('search_quiz', TRUE);



      $search_courses = $this->input->post('selectcourses', TRUE);



      $search_type = $this->input->post('selecttype', TRUE);



      $this->session->unset_userdata('sess_quiz');



      $search_string = '';



      $search_courses = '';



      $search_type = '';



      $search_status = '';



      }else{



     // $this->session->unset_userdata('sess_quiz');



      $search_string = ($this->input->post('search_quiz', TRUE)) ? $this->input->post('search_quiz', TRUE) : $sess_quiz['searchterm'];



      $search_courses = ($this->input->post('selectcourses', TRUE)) ? $this->input->post('selectcourses', TRUE) : $sess_quiz['courses'];



      $search_type = ($this->input->post('selecttype', TRUE)) ? $this->input->post('selecttype', TRUE) : $sess_quiz['type'];



      $search_status = ($this->input->post('selectstatus', TRUE)) ? $this->input->post('selectstatus', TRUE) : $sess_quiz['status'];



      $searchdata = array(



      "searchterm" => $search_string,



      "courses" => $search_courses,



      "type" => $search_type,



      "status" => $search_status



      );



      $this->session->set_userdata('sess_quiz', $searchdata);



      }



      $this->load->model('Myinfo_model');



      $this->load->model('Tasks_model');



      // $this->template->set("tmpl", $tmpl);
      $data['tmpl'] = $tmpl;






      $auth = $this->session->userdata('logged_in');



      $user_id = $auth['id'];



      // $this->template->set("user_id", $user_id);
      $data['user_id'] = $user_id;






     // $quiztaken = $this->template->set("my_quizzes", $this->Tasks_model->getQuizScore($user_id,$search_string,$search_courses,$search_type,$search_status));



      // $quiztaken = $this->template->set("my_quizzes", $this->Myinfo_model->quizScoreNew($user_id,$search_string,$search_courses,$search_type,$search_status));


      $data['my_quizzes'] = $this->Myinfo_model->quizScoreNew($user_id,$search_string,$search_courses,$search_type,$search_status);
      $data['getid'] = $this->Myinfo_model->getDistinctId($user_id);




      //print_r($this->Tasks_model->getQuizScore($user_id,$search_string,$search_courses,$search_type,$search_status));



      //$getid = $this->template->set("getid", $this->Myinfo_model->getDistinctId($user_id));



      if($this->session->userdata('logged_in')){

         $this->load->view('new_template_design/header');
        $this->load->view('myinfo/my_quizandfexam', $data);
        $this->load->view('new_template_design/footer');
      // $this->template->build(getOverridePath($tmpl,'myinfo/my_quizandfexam','views'));

      }else{

        $this->load->view('new_template_design/header');
        $this->load->view('user/login', $data);
        $this->load->view('new_template_design/footer');

      }



      $last_page_url = $_SERVER["REQUEST_URI"];



      $this->session->set_userdata('last_page_url',$last_page_url);



   }

public function printcertificate1(){

    }

public function printcertificate()
{
    $this->load->model('Myinfo_model');
    $this->load->model('admin/certificates_model');
    $this->load->model('Lessons_model');

    $configarr = $this->settings_model->getItems();
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);
    $sessionarray = $this->session->userdata('logged_in');
    $this->template->set("username", $sessionarray);

    $op = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
    $coursename = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
    $author_name = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;
    $certificateid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;
    $date_completed = ( $this->uri->segment(7) )  ? $this->uri->segment(7) : NULL;
    $cid = ( $this->uri->segment(8) )  ? $this->uri->segment(8) : NULL;
    $opt = ( $this->uri->segment(9) )  ? $this->uri->segment(9) : NULL;

    $this->template->set("coursename", trim(urldecode($coursename)));
    $this->template->set("author_name", $author_name);
    $this->template->set("certificateid", $certificateid);
    $this->template->set("date_completed", $date_completed);
    $this->template->set("opt", $opt);
    $this->template->set("op", $op);
    $this->template->set("cid", $cid);
    $cetificate_background = $this->certificates_model->getItems();
    $this->template->set("imagename", $cetificate_background);
    $cetificate_msg = $this->Lessons_model->getCertificateMsg($cid);
    $this->template->set("cetificate_msg", $cetificate_msg);
    $this->template->build(getOverridePath($tmpl,'myinfo/printcertificate','views'));
}

function pdf()
{
    $configarr = $this->settings_model->getItems(); 
    $tmpl = $configarr[0]['layout_template']; 
    $this->load->helper('pdf_helper');
    $this->load->model('admin/certificates_model');
    $this->load->model('Lessons_model');
    $coursename = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
    $author_name = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;
    $certificateid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;
    $date_completed = ( $this->uri->segment(7) )  ? $this->uri->segment(7) : NULL;
    $cid = ( $this->uri->segment(8) )  ? $this->uri->segment(8) : NULL;

    $sessionarray = $this->session->userdata('logged_in');
    $cetificate_background = $this->certificates_model->getItems();

    // print_r($cetificate_msg);exit;
    $cetificate_msg = $this->Lessons_model->getCertificateMsg($cid);
    $this->template->set("date_completed", $date_completed);
    $this->template->set("coursename", $coursename);
    $this->template->set("certificateid", $certificateid);
    $this->template->set("cid", $certificateid);
    $this->template->set("username", $sessionarray);
    $this->template->set("author_name", $author_name);
    $this->template->set("imagename", $cetificate_background);
    $this->template->set("cetificate_msg", $cetificate_msg);
    //$this->load->view('pdfreport', $data);
    $this->template->build(getOverridePath($tmpl,'myinfo/pdfreport','views'));    

    /*
    //commented by yo on dated 08-06-2015
    $sessionarray = $this->session->userdata('logged_in');
    $firstname = $sessionarray['first_name'];
    $lastname = $sessionarray['last_name'];
    $this->load->model('admin/certificates_model');
    $imagename = $this->certificates_model->getItems();
       
    $textData = $imagename[0]["templates1"];

    // Generate PDF by saying hello to the world fpdf
    $image_theme = $imagename[0]["design_background"];    
    $img_file = base_url().'public/uploads/settings/img/'.$image_theme;
    $this->pdf->AddPage();
    //$this->pdf->SetFont('Arial','B',25);
    //$this->pdf->Image(base_url().'public/uploads/settings/img/'.$image_theme, 0, 0, 0, 0);
    //$this->pdf->Cell(45);
    //$this->pdf->Cell(10,10,'Certificate Of Completion');
    //$this->pdf->SetFont('Arial','B',10);
    //$this->pdf->Cell(10,40,$textData);
    $this->WriteHTML(utf8_decode($textData));
    $this->pdf->Output();*/
}

public function certificate_sendmail()
{
    $this->load->model('Myinfo_model');
  
    $this->load->model('admin/certificates_model');
  
    $this->load->model('Lessons_model');
  
    $configarr = $this->settings_model->getItems();
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);
    $sessionarray = $this->session->userdata('logged_in');
    $this->template->set("username", $sessionarray);
    $op = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
    $coursename = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
    $author_name = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;
    $certificateid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;
    $date_completed = ( $this->uri->segment(7) )  ? $this->uri->segment(7) : NULL;
    $cid = ( $this->uri->segment(8) )  ? $this->uri->segment(8) : NULL;
    $opt = ( $this->uri->segment(9) )  ? $this->uri->segment(9) : NULL;
    $this->template->set("coursename", trim(urldecode($coursename)));
    $this->template->set("author_name", $author_name);
    $this->template->set("certificateid", $certificateid);
    $this->template->set("date_completed", $date_completed);
    $this->template->set("opt", $opt);
    $this->template->set("op", $op);
    $this->template->set("cid", $cid);
    $cetificate_background = $this->certificates_model->getItems();
    $this->template->set("imagename", $cetificate_background);
    $cetificate_msg = $this->Lessons_model->getCertificateMsg($cid);
    $this->template->set("cetificate_msg", $cetificate_msg);
    //print_r($_POST);
    //mail
            /*$this->load->library('email');

            $this->email->from('your@example.com', 'Your Name');

            $this->email->to('kanchan.chawatkar@veerit.com');

            $this->email->cc('another@another-example.com');

            $this->email->bcc('them@their-example.com');

            $this->email->subject('Email Test');

            $this->email->message('Testing the email class.');

            $this->email->send();

            echo $this->email->print_debugger();*/

      $this->template->build(getOverridePath($tmpl,'myinfo/printcertificate','views'));
    }











   public function myorder(){

  $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];

    $this->template->set("tmpl", $tmpl);



     



      $auth = $this->session->userdata('logged_in');



      $user_id = $auth['id'];



      $this->load->model('Myinfo_model');



      $this->load->model('Buyitem_model');



      $get_orders = $this->Myinfo_model->getOrders($user_id);



      $get_config = $this->Buyitem_model->getConfigs();



      $this->template->set("get_orders", $get_orders);



      $this->template->set("get_config", $get_config);



      $this->load->model('admin/certificates_model');



      $this->load->model('Lessons_model');


      $this->template->build(getOverridePath($tmpl,'myinfo/my_order','views'));



   }











   public function orderdetails(){



      



      $order_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;



      $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
$this->template->set("tmpl", $tmpl);


      $auth = $this->session->userdata('logged_in');



      //print_r($auth);



      $user_id = $auth['id'];



      $this->load->model('Myinfo_model');



      $this->load->model('Buyitem_model');



      $get_orders = $this->Myinfo_model->getOrders($user_id,$order_id);



      $get_config = $this->Buyitem_model->getConfigs();



      $this->template->set("get_orders", $get_orders);



      $this->template->set("get_config", $get_config);



      $this->template->set("user_info", $auth);



      $this->load->model('admin/certificates_model');



      $this->load->model('Lessons_model');

      $this->template->build(getOverridePath($tmpl,'myinfo/orderdetails','views'));



   }

    public function my_redeem_code()
    {
        $auth = $this->session->userdata('logged_in');

        if(!empty($auth))
        {
            $this->load->view('new_template_design/header');
            $this->load->view('myinfo/redeem_code');
            $this->load->view('new_template_design/footer');
        }
        else
        {
            redirect(base_url());
        }
    }

    public function check_code(){
        $auth = $this->session->userdata('logged_in');
        $user_id = $auth['id'];
        $this->load->model('reseller_model');
        $coupon_code = $this->input->post('coupon_code');
        $con = "rc.coupon_code ='".$coupon_code."' AND rc.status ='Unused'";        
        $get_code = $this->reseller_model->get_redeem_code($con);
        if(!empty($get_code))
        {
          $data = array(
                      'status' => "Redeemed",
                      'modified' => date('Y-m-d H:i:s')
          );
          $con1 = "coupon_code ='".$coupon_code."' AND status ='Unused'"; 
          $this->Crud_model->SaveData('mlms_reseller_coupon',$data,$con1);

          $order = array(
                        'userid' => $user_id,
                        'order_date' => date('Y-m-d H:i:s'),
                        'courses' => $get_code->course_id,
                        'status' => 'SUCCESS',
                        'pending_reason' => 'New Order',
                        'amount' => $get_code->fixedrate,
                        'amount_paid' => $get_code->fixedrate,
                        'processor' => 'Cash',
                        'currency' => 'INR',
                        'published' => 1,
                        'transactionid' => $coupon_code,
                        'order_status' => 'New Order',
                        'referred_code' => $get_code->referral_code,
          );
          $this->Crud_model->SaveData('mlms_order',$order);
          $order_id = $this->db->insert_id();

          $buy_course = array(
                        'userid' => $user_id,
                        'order_id' => $order_id,
                        'course_id' => $get_code->course_id,
                        'price' => $get_code->fixedrate,
                        'currency' => "INR",
                        'buy_date' => date('Y-m-d H:i:s'),
                        'finalexam_status' => "notgiven"
          );
          $this->Crud_model->SaveData('mlms_buy_courses',$buy_course);
          if($get_code->reseller_id != $get_code->author)
          {
            $reseller_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->reseller_id);
            $rcom = floatval($get_code->fixedrate) * floatval($get_code->assessment) /100 ;
            $reseller_total = floatval($reseller_payout->total_amount) + floatval($rcom);
            $reseller_paid = floatval($reseller_payout->paid_amount) + floatval($rcom);
            $reseller = array(
                          'total_amount' => $reseller_total,
                          'paid_amount' => $reseller_paid,
                          'modified' => date('Y-m-d H:i:s')
            );
            $this->Crud_model->SaveData('mlms_payout',$reseller,"user_id =".$get_code->reseller_id);

            $pay_log = array(
                            'payout_id' => $reseller_payout->id,
                            'user_id' => $get_code->reseller_id,
                            'pay_mode' => 'Cash',
                            'paid_amount' => $rcom,
                            'paid_date' => date('Y-m-d H:i:s'),
                            'memo' => "Payment automatically SETTLED in case of Offline selling a course.",
            );
            $this->Crud_model->SaveData('mlms_payout_log',$pay_log);
            
            $log_comm1 = array(
                          'order_id' => $order_id,
                          'reseller_id' => $get_code->reseller_id,
                          'commission' => $rcom,
                          'created' => date("Y-m-d H:i:s")
            );
            $this->Crud_model->SaveData('mlms_commission_log',$log_comm1);
          }
          $teacher_payout = $this->Crud_model->get_single('mlms_payout',"user_id =".$get_code->author);
          $tcom = floatval($get_code->fixedrate) * floatval($get_code->coursepercent) /100 ;
          $teacher_total = floatval($teacher_payout->total_amount) + floatval($tcom);
          $teacher_paid = floatval($teacher_payout->paid_amount) + floatval($tcom);

          $teacher = array(
                        'total_amount' => $teacher_total,
                        'paid_amount' => $teacher_paid,
                        'modified' => date('Y-m-d H:i:s')
          );
          $this->Crud_model->SaveData('mlms_payout',$teacher,"user_id =".$get_code->author);
          $log_comm2 = array(
                        'order_id' => $order_id,
                        'reseller_id' => $get_code->author,
                        'commission' => $tcom,
                        'created' => date("Y-m-d H:i:s")
          );
          $this->Crud_model->SaveData('mlms_commission_log',$log_comm2);

          $amount_liable = floatval($get_code->fixedrate) - floatval($rcom);
          $offline_payment = array(
                        'reseller_id' => $get_code->reseller_id,
                        'order_id' => $order_id,
                        'amount' => round(floatval($amount_liable),2)
          );
          $this->Crud_model->SaveData('mlms_offline_payment',$offline_payment);
          $getcourse = $this->Crud_model->get_single('mlms_program',"id = ".$get_code->course_id,"name,slug,id");
          $coursedata = array(
                    'name' => $getcourse->name,
                    'id' => $getcourse->id,
                    'slug' => $getcourse->slug
          );
          echo json_encode($coursedata);
        }
        else{
          echo "0";
        }
    }

    // stdClass Object ( [coupon_code] => QGzi7a4P [reseller_id] => 341 [course_id] => 77 [referral_code] => 4c65rgn7 [fixedrate] => 99.00 [author] => 66 [coursepercent] => 50 [assessment] => 15 ) 
}



?>