<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exams extends MLMS_Controller {
  function __construct()
  {
        parent::__construct();
        $this->load->model('questions_model'); 
        $this->load->model('admin/exam_model');       
        $this->load->model('admin/settings_model');   
        $configarr = $this->settings_model->getItems(); 
        $this->load->model('quizzes_model');
        $this->load->model('login_model');
        $this->load->model('crud_model');
        $this->load->helper('commonmethods');
        $this->template->set_layout('backend');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
        $this->load->helper('form');
        $this->load->helper('url'); 
        $this->lang->load('tooltip', 'english');
        $this->load->library('form_validation');
        date_default_timezone_set($configarr[0]['time_zone']);
        error_reporting(0);
        $this->authenticate();
  }

  function authenticate()
  {      
    $sess = $this->session->userdata('logged_in');
      $session = $this->session->userdata('loggedin');
     if(!empty($sess)){
      $this->session->set_userdata('loggedin',$sess);
     }
     else if(!empty($session)){
      $this->session->set_userdata('logged_in',$session);
     }else{
        redirect('admin/users/login');
     }
      /*if(!$sess && !$session)
      {
        redirect('admin/users/login');
      }
      else if($sess && !$session)
      {
        $this->session->set_userdata('loggedin',$sess);
      }
      else if($session['groupid'] == 4 || $session['groupid'] == 2)
      {
      }
      else{
        $this->session->unset_userdata("loggedin");
      }*/
    }

  public function index($parent_id = NULL)  
  {   
      $u_data = $this->session->userdata('logged_in');
      $maccessarr=$this->session->userdata('maccessarr');
      $user_id = $u_data['id'];
      if(!empty($maccessarr['quizzes']))
      {
      if(($maccessarr['quizzes']=='view_all') || ($maccessarr['quizzes']=='own') || ($maccessarr['quizzes']=='modify_all'))
      { 
          error_reporting(0);
          if(isset($_POST) && !empty($_POST))  
          {
              $this->reorder_fun($_POST);
          }
          $this->session->unset_userdata('sess_quiz');
          $parent_id = NULL;
     $this->template->set_layout('backend');

      $this->template->title('Quiz List');
      $sess_quiz = $this->session->userdata('sess_quiz');
       if($this->input->post('reset') == 'Reset'){
       $search_string = $this->input->post('search_text', TRUE);
       $search_status = $this->input->post('status', TRUE);
       $search_type = $this->input->post('type', TRUE);
       $this->session->unset_userdata('sess_quiz');
       $search_string = '';
       $search_status = '';
       $search_type = '';
      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_quiz['searchterm'];
       $search_status = ($this->input->post('status') == '1' || is_numeric($this->input->post('status')) && $this->input->post('status') == '0') ? $this->input->post('status') : $sess_quiz['searchstatus'];
       $search_type = ($this->input->post('type') == '1' || is_numeric($this->input->post('type')) && $this->input->post('type') == '0') ? $this->input->post('type') : $sess_quiz['searchtype'];
       $searchdata = array(
         "searchterm" => $search_string,
         "searchstatus" => $search_status,
         "searchtype" => $search_type
         );
     $this->session->set_userdata('sess_quiz', $searchdata);
       }
       $start = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
       $baseurl = base_url() . "admin/exams/index/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->exam_model->getexamcount($search_string,$search_status,$search_type,$user_id);
       $this->template->title('Quiz List');
       $this->pagination->initialize($config);
       $this->template->set("quizzes", $this->exam_model->getItems($parent_id,$user_id,$config['per_page'],$start,$search_string,$search_status,$search_type,$user_id));
       $this->template->set("search_string", $search_string);
       $this->template->set("status", $search_status);
     $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
     $this->template->build('admin/exams/examlist');
     }
     else
     {
        $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to View Quizes' ));
    
        redirect('admin/exams');
     }
   }
   else
   {
      $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to View Quizes' ));
    
        redirect('category/donotpermission');
   }
  }

  function create($parent_id = FALSE)
  { 
     $u_data = $this->session->userdata('logged_in');
    $maccessarr=$this->session->userdata('maccessarr');
    if(($u_data['groupid']==4) || ($maccessarr['courses']=='own'))
    { 
   /* $u_data = $this->session->userdata('logged_in');
    $maccessarr=$this->session->userdata('maccessarr');
    $user_id = $u_data['id'];
    if(!empty($maccessarr['quizzes']) && (($maccessarr['quizzes']=='view_all') || ($maccessarr['quizzes']=='own') || ($maccessarr['quizzes']=='modify_all')))
    { */
     // $this->session->unset_userdata('sess_quiz');
    $this->template->set_layout('backend');
    $sess_quiz = $this->session->userdata('sess_quiz');    
    $pid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('pid', TRUE);
    $pid =  ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;
    $did = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('did', TRUE);
    $did =  ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;
        $this->template->title("Create Quiz", true);
    $this->template->set('title', 'Create Quiz');//lang('web_category_create'));
    $this->template->set('updType', 'create');
    $this->template->set('pid',$pid);
    $this->template->set('temp_id', $this->getActivationCode());
    $this->template->set('did',$did);   
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');
    if ($this->form_validation->run() === false)
    {  
          $parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
        $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
        $this->template->set('parent_id',$parent_id);
      $this->template->build('admin/exams/create');
    }
    else
    {
      $alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
      
        ?>
            <script type="text/javascript">
            window.parent.location.href = "<?php echo base_url(); ?>sections-manage/<?php echo $pid?>/<?php echo $urlCourse; ?>";
            </script><?php
    }
    }
     else 
     {
       $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'you have not Permission to Add Lecture' ));
     redirect('category');
     }
  }

  function getActivationCode() 
{
    //srand ((double) microtime( )*1000000);
    $digits = array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 0 ,1, 2, 3, 4, 5, 6, 7, 8, 9, 0 );
    shuffle($digits);
    $actcode = 0;
    for($i = 0; $i < 9; $i++)
    {
        if($i == 0)
        {
            while($digits[0] == 0)
                shuffle($digits);
        }
        /*if($i >= 2)
        {
            while(($random_agtno % 100) == $digits[0])
                shuffle($digits);
        }*/
        $actcode *= 10;
        $actcode += $digits[0];
        array_splice($digits, 0, 1);
    }
    if($this->crud_model->get_single("mlms_exam_paper",array("exam_id"=>$actcode),"exam_id"))
    {
        $this->getActivationCode();
    }
    return $actcode;
}

  function edit_exam($exam_id = NULL, $parent_id = false)  
  {
      $u_data = $this->session->userdata('logged_in');
    $maccessarr=$this->session->userdata('maccessarr');
    if(($u_data['groupid']==4) || ($maccessarr['courses']=='own'))
    { 
     $this->session->unset_userdata('sess_quiz');
    $this->template->set_layout('backend');
    $sess_quiz = $this->session->userdata('sess_quiz');

    $qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('qid', TRUE);
   
    $this->template->title("Edit Quiz");
    $this->template->set('title', 'Edit Quiz');
    $this->template->set('updType', 'edit');
    $this->template->set('qid',$qid);
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');
    if ($this->form_validation->run() === false)
    {  
          $this->template->set('quiz', $this->exam_model->getItems($qid));
          $parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
        $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
        $this->template->set('parent_id',$parent_id);
      $this->template->build('admin/exams/edit');
    }
    else
    {
      $alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
      
        ?>
            <script type="text/javascript">
            window.parent.location.href = "<?php echo base_url(); ?>sections-manage/<?php echo $pid?>/<?php echo $urlCourse; ?>";
            </script><?php
    }
     }
     else 
     {
       $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'you have not Permission to Add Lecture' ));
     redirect('category');
     }
  }
    
  public function examlist($queid = NULL)
  {
    $this->template->set_layout('backend');
    $this->template->title('Quizzes');
    $sess_quiz = $this->session->userdata('sess_quiz');
   
      $search_string = $this->input->post('search_text', TRUE);
      $search_status = $this->input->post('status', TRUE);
      $search_type = $this->input->post('type', TRUE);
      $this->session->unset_userdata('sess_quiz');   
              $u_data = $this->session->userdata('logged_in');
        $start = ( $this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $baseurl = base_url() . "admin/exams/examlist";
        $this->load->library('pagination');
        $config["base_url"] = $baseurl;
        $config['per_page'] = 10;
        $config['enable_query_strings'] = true;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->exam_model->getexamcount($search_string,$search_status,$search_type);
        $this->template->set('countprog', $config['total_rows']);
        $this->template->title('List quiz');
        $this->pagination->initialize($config);
        $this->template->set('quizzes', $this->exam_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_type, $u_data['id']));
      $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
      $this->authenticate();
        $sess_quiz = $this->session->userdata('sess_quiz');
    if(!empty($_POST['submit_search']))
        {
          $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_quizlist['searchterm'];

          $searchdata = array(
         "searchterm" => $search_string
         );
        $this->session->set_userdata('sess_quizlist', $searchdata);
        }
        else
        {
          $search_string = $this->input->post('search_text', TRUE);
          $this->session->unset_userdata('sess_quizlist');
          $search_string = '';
        }

      $this->template->build('admin/exams/examlist');
  }
  
function autosave($update = NULL){
      $u_data = $this->session->userdata('logged_in');
      $maccessarr = $this->session->userdata('maccessarr');
       $current_date = date("Y-m-d H:i:s");
       $insert ='';
       $user_id = $u_data['id'];
      $answer = '';
      $post = $this->input->post();
      $retn[0] = $post['tmp_val']; 

      $txtQuestion = str_replace("'",'&#39;', $post['txtQuestion']);
      $txtexplain = str_replace("'",'&#39;', $post['txtexplain']);
      if(!empty($post['Q_id'])){
        $getimage = $this->Crud_model->get_single('mlms_exam_questions',"id = ".$post['Q_id'],"que_attachment");
        $_POST['que_attach'] = $getimage->que_attachment;
      }
      if($_FILES['que_attach']['error']=='0')
      {
          $_POST['que_attach']= time().".jpg";
          $config2['image_library'] = 'gd2';
          $config2['source_image'] =  $_FILES['que_attach']['tmp_name'];
          $config2['new_image'] =   getcwd().'/public/uploads/questions/'.$_POST['que_attach'];
          $config2['upload_path'] =  getcwd().'/public/uploads/questions/';
          $config2['allowed_types'] = 'jpg|png|JPEG|jpeg|PNG|JPG';
          $config2['maintain_ratio'] = TRUE;
          $config2['height'] = 768;
          $config2['width'] = 1024;

          $this->image_lib->initialize($config2);
          if(!$this->image_lib->resize())
          {
              $data = array('error' => $this->image_lib->display_errors());
              print_r($data);
              exit;
          }
          if($_POST['que_attach'] != '' && !empty($_POST['que_attach'])){
              unlink(getcwd().'/public/uploads/questions/'.$getimage->que_attachment);
          }
      }
      if($post['q_type'] == 'regular')
      {
         if(!empty($txtQuestion)){
          
                  $que_opt = array();
                  $i = 1;
                  foreach ($post['txtRegOpt_reg'] as $Regkey => $Regvalue) {
                    if(($Regvalue) || $Regvalue == "0") 
                    {
                      $Regvalue = str_replace("'",'&#39;', $Regvalue);
                      $arr = array($i => $Regvalue);
                     // print_r($arr);
                      array_push($que_opt, $arr);
                      if(isset($post['chkReg_'.$i]) && ($post['chkReg_'.$i] == 'on' || $post['chkReg_'.$i] == '1') )
                        {                  
                           $answer = $i;
                        }
                    }
                     $i++;
                  }
          }              

                  $options = json_encode($que_opt);
                   $txtInstruction_reg = str_replace("'",'&#39;', $post['txtInstruction_reg']);
                   $data = array(
                    'que_title' =>  $txtQuestion,
                    // 'que_tag'   =>  $post['txtQuestionTag'],
                    'instruction' =>  $txtInstruction_reg,
                    'que_type'    =>  $post['q_type'],
                    'explanation'     =>  $txtexplain,
                    'options'         =>  $options,
                    'correct_ans'     =>  $answer,    
                    'que_marks'       =>  $post['txtPoints_reg'],
                    "que_attachment"  =>  $_POST['que_attach'],
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date,
                  );
                    $answer = '';
    }
    else if($post['q_type'] == 'matching')
    {
          $que_opt = array();            
                $pair_opt =array();
               $ans_series = '';
                if(!empty($txtQuestion)){
               $i=1;
                 foreach ($post['txtMatchque'] as $Mkey => $Mvalue) {
                  if(($Mvalue) || $Mvalue == "0")
                  {
                    $Mvalue = str_replace("'",'&#39;', $Mvalue);
                    $arr = array($i => $Mvalue);
                    array_push($que_opt, $arr); 
                     if($post['txtMatchpair'][$Mkey])
                        {
                           $Mpairval = str_replace("'",'&#39;', $post['txtMatchpair'][$Mkey]);
                          $arr2 = array($i => $Mpairval);
                          array_push($pair_opt, $arr2);
                          $ans_series = $ans_series.$i.'_';
                        }
                        $i++;
                  }
                 } 
                }

                  $options = json_encode($que_opt);
                  $pair_options = json_encode($pair_opt);
                   $answer = $ans_series;
                  $txtInstruction_mat = str_replace("'",'&#39;', $post['txtInstruction_mat']);

                   $data = array(

                    'que_title' =>  $txtQuestion,
                    // 'que_tag'   =>  $post['txtQuestionTag'],
                    'instruction' =>  $txtInstruction_mat,
                    'que_type'    =>  $post['q_type'],
                    'options'         =>  $options,
                    'que_option'      =>  $pair_options,
                    'correct_ans'     =>  $answer,    
                    'que_marks'       =>  $post['txtPoints_mat'],
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date, 
                  );
                    $answer = '';
    }
    else if($post['q_type'] == 'truefalse')//for true false question type
              {
                if(!empty($txtQuestion)){

                if(!empty($post['rbTrueFalse']))
                  $answer = 1;
                else $answer = 0;
              }
              $txtInstruction_tf = str_replace("'",'&#39;', $post['txtInstruction_tf']);
                  $data = array(
                      'que_title' =>  $txtQuestion,
                      'instruction'  =>  $txtInstruction_tf,
                      'que_type'     =>  $post['q_type'],
                      'correct_ans'  =>  $answer, //1-true, 0-false   
                      'que_marks'       =>  $post['txtPoints_tf'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                    );
                   $answer = '';
              }
              else if($post['qtype_'.$sectioncounter][$Qkey] == 'subjective')//for subjective
              {

                if(!empty($txtQuestion)){
                  $txtInstruction_sub = str_replace("'",'&#39;', $post['txtInstruction_sub']);
                  $data = array(
                      'que_title' =>  $txtQuestion,
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'     =>  $txtInstruction_sub,
                      'que_type'        =>  $post['q_type'],
                      'que_marks'       =>  $post['txtPoints_sub'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,       
                    );
                }
              }

              else if($post['q_type'] == 'mcq')//for multiple question type
              {
                $que_opt = array();   
                $mark_arr = array();
                $chk_str = '';
                    if(!empty($txtQuestion)){
                   $i=1;
                     foreach ($post['txtMultiOpt'] as $Mkey => $Mvalue) {
                      if(($Mvalue) || $Mvalue=="0")
                      {
                         $Mvalue = str_replace("'",'&#39;', $Mvalue);
                        $arr = array($i => $Mvalue);
                        array_push($que_opt, $arr); 
                        // echo $post['chkMulti_'.$i]."***".$i."<br>";
                         if(isset($post['chkMulti_'.$i]) && $post['chkMulti_'.$i] == '1')
                            {                  
                              $chk_str = $chk_str.$i.'_';
                            }
                            $i++;
                      }
                     } 
                    }
                    $expld = explode("_",$chk_str);
                    
                    $correct_answer = '';
                    for ($i=0; $i < count($expld); $i++) {
                      $correct_answer .= $expld[$i];
                      if(!empty($expld[$i + 1]))
                        $correct_answer .= "_";
                    }
                 

                    $options = json_encode($que_opt);
                    $txtInstruction_mul = str_replace("'",'&#39;', $post['txtInstruction_mul']);
                 $data = array(
                      'que_title' =>  $txtQuestion,
                      'instruction'    =>  $txtInstruction_mul,
                      'que_type'    =>  $post['q_type'],
                      'explanation'     =>  $post['explain_mul'],
                      'options'          =>  $options,
                      'correct_ans'     =>  $correct_answer, //$chk_arr,  //srt index separated by :   
                      'que_marks'       =>  $post['txtPoints_mul'],
                      "que_attachment"  =>  $_POST['que_attach'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,       
                    );
              }

            else if($post['q_type'] == 'mediaq')//for media question type
            {
               if(isset($_FILES['file_i'])) {
              $tmp_name = $_FILES['file_i']['tmp_name'];
              $name     = $_FILES['file_i']['name'];
              $error    = $_FILES['file_i']['error'];
              $file_type = $_FILES['file_i']['type'];
              if ($error === UPLOAD_ERR_OK) {
                    $output_dir = FCPATH."public/uploads/questions/";
                     $temp = explode(".", $_FILES["file_i"]["name"]);
                     $path_parts = pathinfo($output_dir.$name);
                    $i=1;
                    if(file_exists($output_dir.$name))
                    {
                      do{
                        $name = $path_parts['filename'].'_'.$i.'.'.end($temp);
                        $i++;
                      }
                      while(file_exists($output_dir.$name));
                    }
                    move_uploaded_file($tmp_name,$output_dir.$name);
                    }
            }
           
                $file_name = $name;
             if($file_name){

                  if(!empty($txtQuestion)){
                  $que_opt = array();
                  $i = 1;
                  foreach ($post['txtMediaOpt'] as $Mkey => $Mvalue) {
                    if(($Mvalue) || $Mvalue == "0")
                    {
                       $Mvalue = str_replace("'",'&#39;', $Mvalue);
                      $arr = array($i => $Mvalue);
                      array_push($que_opt, $arr);
                      if(isset($post['chkMedia_'.$i]) && $post['chkMedia_'.$i] == 'on')
                        {                  
                           $answer = $i;
                        }
                    }
                     $i++;
                  }
                     }  
                    $options = json_encode($que_opt);
                  }
                  $txtInstruction_media = str_replace("'",'&#39;', $post['txtInstruction_media']);
                   $data = array(
                      'que_title' =>  $txtQuestion,
                      'instruction'    =>  $txtInstruction_media,
                      'que_type'    =>  $post['q_type'],
                      'options'          =>  $options,
                      'que_attachment'  =>  $file_name,
                      'correct_ans'     =>  $answer,  //srt index separated by :   
                      'que_marks'       =>  $post['txtPoints_media'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,         
                    );

                $answer = '';
              }
              if(isset($update)){
                $qid = $post['Q_id'];
            $update1 = $this->exam_model->exam_AutoQupdate($data, $qid);

            $retn[1] = $update1; 
               if($update1)
                {
                  $Que_data = $this->exam_model->get_Qedit($qid);
                  
                  // $Que_data = htmlspecialchars(json_encode($Que_data), ENT_QUOTES, 'UTF-8');
                   $retn[1] = $update1; 
                   $retn[2] = $Que_data;
                }
              }
              else{
                $status = 'new';
                $qid = '';
                 $pg_des = str_replace("'",'&#39;', $post['pg_des']);
                  $sec_des = str_replace("'",'&#39;', $post['sec_des']);
                   $pageTitle = str_replace("'",'&#39;', $post['pageTitle']);
                    $secTitle = str_replace("'",'&#39;', $post['secTitle']);
                $arr2 = array(
                  'exam_id' => $post['exam_id'], 
                  'page_id' => $post['page_id'], 
                  'section_id' => $post['section_id'],
                  'page_description' => $pg_des,
                  'section_description' => $sec_des,
                  'page_title' => $pageTitle,
                  'section_title' => $secTitle,
                );

                $insert = $this->exam_model->exam_quesauto($data, $status, $qid, $arr2);
  $Que_data = $this->Crud_model->SaveData('mlms_exam_paper',array("modified_date"=>$current_date),"exam_id = '".$post['exam_id']."'");
              if($insert)
              {
                  $Que_data = $this->exam_model->get_Qedit($insert);
                  // $Que_data = htmlspecialchars(json_encode($Que_data), ENT_QUOTES, 'UTF-8');

                 $retn[1] = $insert;
                 $retn[2] = $Que_data;
                 $retn[3] = $exam_id;

              }
            }

            echo json_encode($retn);
}

function autoDelete($q_id, $exam_id){
    $totmk = $_POST['totmk'];
     $delete = $this->exam_model->exam_queDelete($q_id, $exam_id, $totmk);
     // echo $this->db->last_query();
     echo $delete;
}
    function exam_submit()
  {
    // print_r($_POST); exit();
      $this->template->title('Create Quiz');
        $this->authenticate();
        $u_data = $this->session->userdata('logged_in');
        $maccessarr = $this->session->userdata('maccessarr');
       $current_date = date("Y-m-d H:i:s");
       $insert ='';
       $user_id = $u_data['id'];
      $answer = '';
      $post = $this->input->post();
      $exam_arr = array(
        'exam_title' => $post['name'],
        'description' => $post['description'],
        'exam_type' => $post['exam_type'],
        'instructions' => $post['instructions'],
        'total_marks' => $post['total_marks'],
        'passing_score' => $post['pass_score'],
        'published' => $post['published'],
        'compulsory_que' => $post['compulsory_que'],
        'info_hide' => $post['info_hide'],
        'pass_feedback' => $post['pass_feedback'],
        'fail_feedback' => $post['fail_feedback'],
        'view_score_realtime' => $post['view_score_realtime'],
        'order_type' => $post['order_type'],
        'skip' => $post['skip'],
        'retake' => $post['retake'],
        'attempt_limit' => $post['attempt_limit'],
        'time_limit_b' => $post['time_limit_b'],
        'duration_h' => $post['duration_h'],
        'duration_m' => $post['duration_m'],
        'ex_start_date' => $post['ex_start_date'],
        'ex_start_time' => $post['ex_start_time'],
        'ex_end_date' => $post['ex_end_date'],
        'ex_end_time' => $post['ex_end_time'],
        'department' => $post['department'],
        'wait_b' => $post['wait_b'],
        'wait_w' => $post['wait_w'],
        'wait_d' => $post['wait_d'],
        'wait_h' => $post['wait_h'],
        'wait_m' => $post['wait_m'],
        'see_result' => $post['see_result'],
        'show_right_answers' => $post['show_right_answers'],
        'created_by' => $user_id,
        'created_date' => $current_date, 
        'exam_category' => $post['exam_category'],   
);
      $exam = $this->exam_model->create_exam($exam_arr);
          $que_order = 0;
           $pagecounter = 1;
           $sectioncounter = 1;
           $quecounter = 1;
/*if($post['exam_category']=='1'){
      foreach ($post['page_title'] as $key => $value) {
        $page_title = $value;
        $page_desc = $post['page_Desc'][$key];
       
        foreach ($post['section_'.$pagecounter] as $Sec_key => $Sec_value) {
          $sec_title = $Sec_value;
           $sec_desc = $post['secDesc_'.$pagecounter][$Sec_key];

           // if($post['exam_category']=='1'){ //auto type
             $data = array(
                      'set_category'    =>  $post['Quecat_'.$pagecounter][$Sec_key], 
                      'set_subcategory' =>  $post['Quesubcat_'.$pagecounter][$Sec_key],
                      'set_type'        =>  $post['Questype_'.$pagecounter][$Sec_key],
                      'set_numques'     =>  $post['NumQues_'.$pagecounter][$Sec_key],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      'page_id'         =>  $pagecounter,
                      'page_title'      =>  $page_title,
                      'page_description'=>  $page_desc,
                      'section_id'      =>  $sectioncounter,
                      'section_title'   =>  $sec_title,
                      'section_description'=>$sec_desc,          
                    );
              $insert = $this->exam_model->exam_autoQues($exam_arr, $data, $exam);

          $sectioncounter++;
        }
        $pagecounter++;
       }
     }
     else if($post['exam_category']=='2'){*/
      $exam_id = $this->input->post('exam_id');
       $update_ques = $this->exam_model->update_quesid($exam, $exam_id);
     // }
    if($exam)
    {
      echo "examDB-".$exam." *exam_id-".$exam_id.' *update_ques'.@$update_ques;
    } 
  }


  function edit()
  {
      $this->template->title('Edit Quiz');
    $this->template->set_layout('backend');
    $sess_quiz = $this->session->userdata('sess_quiz');
      $this->session->unset_userdata('sess_quiz');
        $this->authenticate();
        $u_data = $this->session->userdata('logged_in');
        $maccessarr = $this->session->userdata('maccessarr');
       $current_date = date("Y-m-d H:i:s");
       $insert ='';
       $user_id = $u_data['id'];
      $answer = '';
      $post = $this->input->post();
      $exam_arr = array(
        'exam_title' => $post['name'],
        'description' => $post['description'],
        'exam_type' => $post['exam_type'],
        'instructions' => $post['instructions'],
        'total_marks' => $post['total_marks'],
        'passing_score' => $post['pass_score'],
        'published' => $post['published'],
        'compulsory_que' => $post['compulsory_que'],
        'info_hide' => $post['info_hide'],
        'pass_feedback' => $post['pass_feedback'],
        'fail_feedback' => $post['fail_feedback'],
        'view_score_realtime' => $post['view_score_realtime'],
        'order_type' => $post['order_type'],
        'skip' => $post['skip'],
        'retake' => $post['retake'],
        'attempt_limit' => $post['attempt_limit'],
        'time_limit_b' => $post['time_limit_b'],
        'duration_h' => $post['duration_h'],
        'duration_m' => $post['duration_m'],
        'ex_start_date' => $post['ex_start_date'],
        'ex_start_time' => $post['ex_start_time'],
        'ex_end_date' => $post['ex_end_date'],
        'ex_end_time' => $post['ex_end_time'],
        'department' => $post['department'],
        'wait_b' => $post['wait_b'],
        'wait_w' => $post['wait_w'],
        'wait_d' => $post['wait_d'],
        'wait_h' => $post['wait_h'],
        'wait_m' => $post['wait_m'],
        'see_result' => $post['see_result'],
        'show_right_answers' => $post['show_right_answers'],
        'created_by' => $user_id,
        'created_date' => $current_date, 
        'exam_category' => $post['exam_category'],   
);
      $exam = $post['exam_id'];
      if($exam){
          $aff_row = $this->exam_model->update_exam($exam_arr,$exam);
        }
          $que_order = 0;
           $pagecounter = 1;
           $sectioncounter = 1;
           $quecounter = 1;
      foreach ($post['page_title'] as $key => $value) {
        $page_title = $value;
        $page_desc = $post['page_Desc'][$key];

        foreach ($post['section_'.$pagecounter] as $Sec_key => $Sec_value) {
          $sec_title = $Sec_value;
           $sec_desc = @$post['secDesc_'.$pagecounter][$Sec_key];
           if($post['exam_category']=='1'){ //auto type
             $data = array(
                      'set_category'    =>  $post['Quecat_'.$pagecounter][$Sec_key], 
                      'set_subcategory' =>  $post['Quesubcat_'.$pagecounter][$Sec_key],
                      'set_type'        =>  $post['Questype_'.$pagecounter][$Sec_key],
                      'set_numques'     =>  $post['NumQues_'.$pagecounter][$Sec_key],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      'page_id'         =>  $pagecounter,
                      'page_title'      =>  $page_title,
                      'page_description'=>  $page_desc,
                      'section_id'      =>  $sectioncounter,
                      'section_title'   =>  $sec_title,
                      'section_description'=>$sec_desc,          
                    );
              $insert = $this->exam_model->exam_autoQues($exam_arr, $data, $exam);
          }   
           /*
           else if($post['exam_category']=='2'){  // manual
          foreach ($post['txtQuestion_'.$sectioncounter] as $Qkey => $Qvalue) {
            
                if(!empty($post['txtQuestion_'.$sectioncounter][$Qkey])){
                                    $que_order++;
                  if($post['queid_'.$sectioncounter][$Qkey])
                  {
                    $qid = $post['queid_'.$sectioncounter][$Qkey];
                    $data = array(
                      'exam_id'         =>  $exam,
                      'page_id'         =>  $pagecounter,
                      'page_title'      =>  $page_title,
                      'page_description'=>  $page_desc,
                      'section_id'      =>  $sectioncounter,
                      'section_title'   =>  $sec_title,
                      'section_description'=>$sec_desc,
                     );
                      $insert = $this->exam_model->exam_AutoQupdate($data, $qid);
                  }
                  else{
            if($post['qtype_'.$sectioncounter][$Qkey] == 'regular')//for regular question type
            { 
                 $que_opt = array();            
                 if(!empty($post['txtRegOpt_'.$quecounter])){
                  $i = 1;
                 foreach ($post['txtRegOpt_'.$quecounter] as $Regkey => $Regvalue) {

                  if($Regvalue)
                  {
                    $arr = array($i => $Regvalue);
                    array_push($que_opt, $arr);
                    if($post['chkReg_'.$quecounter][$Regkey] == '1')
                      {                  
                         $answer = $i;
                      }
                  }
                   $i++;
                 }    }              

                  $options = json_encode($que_opt);
                                   
                   $data = array(

                    'que_title' =>  $Qvalue,
                    'instruction' =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                    'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                    'options'         =>  $options,
                    'correct_ans'     =>  $answer,    
                    'que_marks'       =>  $post['txtPoints_'.$sectioncounter][$Qkey],
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date, 
                    'page_id'         =>  $pagecounter,
                    'page_title'      =>  $page_title,
                    'page_description'=>  $page_desc,
                    'section_id'      =>  $sectioncounter,
                    'section_title'   =>  $sec_title,
                    'section_description'=>$sec_desc,
                  );
                         $answer = '';
              } 
              else if($post['qtype_'.$sectioncounter][$Qkey] == 'matching')//for match the pair question type
              {  
                 $que_opt = array();            
                $pair_opt =array();
               $ans_series = '';
                if(!empty($post['txtMatchque_'.$quecounter])){
               $i=1;
                 foreach ($post['txtMatchque_'.$quecounter] as $Mkey => $Mvalue) {
                  if($Mvalue)
                  {
                    $arr = array($i => $Mvalue);
                    array_push($que_opt, $arr); 
                     if($post['txtMatchpair_'.$quecounter][$Mkey])
                        {
                          $arr2 = array($i => $post['txtMatchpair_'.$quecounter][$Mkey]);
                          array_push($pair_opt, $arr2);
                          $ans_series = $ans_series.$i.'_';
                        }
                        $i++;
                  }
                 } 
                }
                  $options = json_encode($que_opt);
                  $pair_options = json_encode($pair_opt);
                   $answer = $ans_series;
                   $data = array(
                    'que_title' =>  $Qvalue,
                    'instruction' =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                    'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                    'options'         =>  $options,
                    'que_option'      =>  $pair_options,
                    'correct_ans'     =>  $answer,    
                    'que_marks'       =>  $post['txtPoints_'.$sectioncounter][$Qkey],
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date, 
                    'page_id'         =>  $pagecounter,
                    'page_title'      =>  $page_title,
                    'page_description'=>  $page_desc,
                    'section_id'      =>  $sectioncounter,
                    'section_title'   =>  $sec_title,
                    'section_description'=>$sec_desc,
                  );
                    $answer = '';
              }
              else if($post['qtype_'.$sectioncounter][$Qkey] == 'truefalse')//for true false question type
              {
                  $data = array(
                      'que_title' =>  $Qvalue,
                      'instruction'  =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'     =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'correct_ans'  =>  $post['rbTrueFalse_'.$sectioncounter][0], //1-true, 0-false   
                      'que_marks'       =>  $post['txtPoints_'.$sectioncounter][$Qkey],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      'page_id'         =>  $pagecounter,
                      'page_title'      =>  $page_title,
                      'page_description'=>  $page_desc,
                      'section_id'      =>  $sectioncounter,
                      'section_title'   =>  $sec_title,
                      'section_description'=>$sec_desc,
                    );
              }
              else if($post['qtype_'.$sectioncounter][$Qkey] == 'subjective')//for subjective
              {
                  $data = array(
                      'que_title' =>  $Qvalue,
                      'instruction'     =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'        =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'que_marks'       =>  $post['txtPoints_'.$sectioncounter][$Qkey],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      'page_id'         =>  $pagecounter,
                      'page_title'      =>  $page_title,
                      'page_description'=>  $page_desc,
                      'section_id'      =>  $sectioncounter,
                      'section_title'   =>  $sec_title,
                      'section_description'=>$sec_desc,        
                    );
              }
              else if($post['qtype_'.$sectioncounter][$Qkey] == 'mcq')//for multiple question type
              {
                $que_opt = array();    
                $mark_arr = array();
                $chk_str = '';
                    if(!empty($post['txtMultiOpt_'.$quecounter])){
                   $i=1;
                     foreach ($post['txtMultiOpt_'.$quecounter] as $Mkey => $Mvalue) {
                      if($Mvalue)
                      {
                        $arr = array($i => $Mvalue);
                        array_push($que_opt, $arr); 
                         if($post['chkMulti_'.$quecounter][$Mkey] == '1')
                            {
                              $chk_str = $chk_str.$i.'_';
                            }
                            $i++;
                      }
                     } 
                    }
                    $options = json_encode($que_opt);
                 $data = array(
                      'que_title' =>  $Qvalue,
                      'instruction'    =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'options'          =>  $options,
                      'correct_ans'     =>  $chk_str, //$chk_arr,  //srt index separated by :   
                      'que_marks'       =>  $post['txtPoints_'.$sectioncounter][$Qkey],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      'page_id'         =>  $pagecounter,
                      'page_title'      =>  $page_title,
                      'page_description'=>  $page_desc,
                      'section_id'      =>  $sectioncounter,
                      'section_title'   =>  $sec_title,
                      'section_description'=>$sec_desc,          
                    );

              }
           else if($post['qtype_'.$sectioncounter][$Qkey] == 'mediaq')//for media question type
            {
              $file_name = $post['MediaImg_'.$sectioncounter][$Qkey];
              $que_opt = array();

               if(!empty($post['txtMediaOpt_'.$quecounter])){
                   $i=1;
                     foreach ($post['txtMediaOpt_'.$quecounter] as $Mkey => $Mvalue) {
                      if($Mvalue)
                      {
                        $arr = array($i => $Mvalue);
                        array_push($que_opt, $arr); 
                          if($post['chkMedia_'.$quecounter][$Mkey] == '1')
                          {                  
                            $answer = $i;
                          }
                            $i++;
                      }
                     } 
                    }
                    $options = json_encode($que_opt);
                   $data = array(
                      'que_title' =>  $Qvalue,
                      'instruction'    =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'options'          =>  $options,
                      'que_attachment'  =>  $file_name,
                      'correct_ans'     =>  $answer,  //srt index separated by :   
                      'que_marks'       =>  $post['txtPoints_'.$sectioncounter][$Qkey],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      'page_id'         =>  $pagecounter,
                      'page_title'      =>  $page_title,
                      'page_description'=>  $page_desc,
                      'section_id'      =>  $sectioncounter,
                      'section_title'   =>  $sec_title,
                      'section_description'=>$sec_desc,          
                    );
                $answer = '';
              }
              if(!$post['queid_'.$sectioncounter][$Qkey]){
                $status = 'new';
                $qid = '';
              }else { 
                $qid = $post['queid_'.$sectioncounter][$Qkey];
                $status = 'up'; }

              $status = @$post['status_'.$sectioncounter][$Qkey];

              if($status && $status=='update')
              {
                $insert = $this->exam_model->update_ques($data, $exam, $que_order, $status, $qid);
              }
              else{
               $insert = $this->exam_model->exam_ques($data, $exam, $que_order, $status, $qid);
              }
            }                
            }  
            $quecounter++; 
          }
          } */
          $sectioncounter++;
        }
        $pagecounter++;
       }
    // if($insert || $aff_row)
    // {
      echo $exam;
    // } 
  }
  function examdelete($id)
  {
    // $id = $this->input->post('id');
    $assign = $this->exam_model->getAssignCourse($id); 
    if($assign)
    {
      echo "This Quiz assigned in the course '".$assign->course."' ";
      // $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This Section contains lectures. Please delete lectures first.' ) );
      // redirect('admin/section-management/'.$parent_id);
    }
    else{
    $isdelete=$this->exam_model->exam_delete($id);
    if ($isdelete)
    {
      echo "success";
       // $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "Quiz deleted successfully" ));

    }
    else{
      // $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => "Failed to delete quiz" ));
      echo "Failed to delete";
    }
  }
     // redirect("admin/exams/examlist");
  }


  function questions($parent_id = FALSE)
    { 
      $from = $this->uri->segment(4); 
      $this->template->title('List quiz');
   $this->template->set_layout('backend');
        $this->authenticate();
        $u_data = $this->session->userdata('logged_in');
        $maccessarr = $this->session->userdata('maccessarr');
        if(($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))   
        {
            $this->template->append_metadata(block_submit_button());
            $this->_set_rules();
                $this->template->title("Questions");
            $this->template->set('title', 'Questions');
            $this->template->set('updType', 'create');
            $this->form_validation->set_rules('txtQuestionTag', 'txtQuestionTag', 'required');
            if($this->input->post('btnSave') == '')
          {
                $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
          $this->template->build('admin/exams/question');
          }
            else
            {                   
                $current_date = date("Y-m-d H:i:s");
                $user_id = $u_data['id'];
            if($this->input->post('txtQuestionType') == 'regular')//for regular question type
            {
                 $que_opt = array();
                  for($i = 1;$i<=5;$i++)
                  {
                    if($this->input->post('txtRegOpt'.$i))
                    {
                      $arr = array($i => $this->input->post('txtRegOpt'.$i));
                      array_push($que_opt, $arr);
                      if($this->input->post('chkReg'.$i))
                      {                  
                        $answer = $i;
                      }
                    }
                  }
                  $options = json_encode($que_opt);
                   $data = array(
                    'que_title' =>  $this->input->post('txtQuestion'),
                    'que_tag'   =>  $this->input->post('txtQuestionTag'),
                    'instruction'    =>  $this->input->post('txtInstruction'),
                    'que_type'    =>  $this->input->post('txtQuestionType'),
                    'options'          =>  $options,
                    'correct_ans'     =>  $answer,    
                    'que_marks'       =>  $this->input->post('txtPoints'),
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date,        
                  );
                $answer = '';
              }
            if($this->input->post('txtQuestionType') == 'match_the_pair')//for match the pair question type
            {
              $que_opt = array();
              $pair_opt =array();
              $ans_series = '';
                  for($i = 1;$i<=5;$i++)
                  {
                    if($this->input->post('txtMatchque'.$i))
                    {
                      $arr = array($i => $this->input->post('txtMatchque'.$i));
                      array_push($que_opt, $arr); 
                        if($this->input->post('txtMatchpair'.$i))
                        {
                          $arr2 = array($i => $this->input->post('txtMatchpair'.$i));
                          array_push($pair_opt, $arr2);
                          $ans_series = $ans_series . $i . ",";
                        }
                    }
                  }
 
            $options = json_encode($que_opt);      // [option] => [{"1":"opt1"},{"2":"opt22"}]
            $pair_options = json_encode($pair_opt);  //[que_option] =>{"1":"p-11"},{"2":"p-22"}] 
            $answer = json_encode($ans_series);     
                $data = array(
                    'que_title' =>  $this->input->post('txtQuestion'),
                    'que_tag'    =>  $this->input->post('txtQuestionTag'),
                    'que_type'  =>  $this->input->post('txtQuestionType'),
                    'instruction'  =>  $this->input->post('txtInstruction'),
                     'options'      =>  $options,
                     'que_option'   =>  $pair_options,
                    'correct_ans'   =>  $answer,    
                    'que_marks'     =>  $this->input->post('txtPoints'),
                    'published' => '1',
                    'created_by' => $user_id,
                    'created_date' =>  $current_date, 
                    'modified_date' =>  $current_date,        
                  );
                $answer = '';
            }
            if($this->input->post('txtQuestionType') == 'true_false')//for true false question type
            {
                $data = array(
                    'que_title' =>  $this->input->post('txtTFQuestion'),
                    'que_tag'   =>  $this->input->post('txtQuestionTag'),
                    'instruction'    =>  $this->input->post('txtInstruction'),
                    'que_type'    =>  $this->input->post('txtQuestionType'),
                    'correct_ans'     =>  $this->input->post('rbTrueFalse'), //1-true, 0-false   
                    'que_marks'       =>  $this->input->post('txtTFPoints'),
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date,        
                  );
                 $questionAdd = $this->input->post('txtTFQuestion');
                $points+=$this->input->post('txtTFPoints');
            }
            if($this->input->post('txtQuestionType') == 'subjective')//for subjective
            {
                $data = array(
                    'que_title' =>  $this->input->post('txtSubjective'),
                    'que_tag'   =>  $this->input->post('txtQuestionTag'),
                    'instruction'    =>  $this->input->post('txtInstruction'),
                    'que_type'    =>  $this->input->post('txtQuestionType'),
                    'que_marks'       =>  $this->input->post('txtPoints'),
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date,        
                  );
                $questionAdd = $this->input->post('txtSubjective');
                $points+=$this->input->post('txtPoints');
            }
            if($this->input->post('txtQuestionType') == 'multiple_choice')//for multiple question type
            {
              $que_opt = array();
              $chk_arr = array();    
              $mark_arr = array();
                  for($i = 1;$i<=5;$i++)
                  {
                    if($this->input->post('txtMultiOpt'.$i))
                    {
                      $arr = array($i => $this->input->post('txtMultiOpt'.$i));
                      array_push($que_opt, $arr);
                      if($this->input->post('chkMulti'.$i))
                      {                  
                        array_push($chk_arr, $i);
                      }
                    }
                  }
                  $options = json_encode($que_opt);
                  $chk_arr = json_encode($chk_arr);
               $data = array(
                    'que_title' =>  $this->input->post('txtMTQuestion'),
                    'que_tag'   =>  $this->input->post('txtQuestionTag'),
                    'instruction'    =>  $this->input->post('txtInstruction'),
                    'que_type'    =>  $this->input->post('txtQuestionType'),
                    'options'          =>  $options,
                    // 'que_option'   =>  '',
                    'correct_ans'     =>  $chk_arr,  //srt index separated by :   
                    'que_marks'       =>  $this->input->post('txtPoints'),
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date,        
                  );
                 $questionAdd = $this->input->post('txtMTQuestion');
                $points+=$this->input->post('txtPoints');
            }
              
        if($this->input->post('txtQuestionType') == 'media_type')//for media question type
            {
              if($_POST['updType'] == 'edit')
              {
                if($_FILES['file_i']['name'])
                {
                  $file_name = $this->upload_image($_FILES);
                }
                else
                {
                  $file_name = $this->input->post('file_nm');
                }
              }
              else
              {
                $file_name = $this->upload_image($_FILES);
              }

              $que_opt = array();
                  
                  for($i = 1;$i<=5;$i++)
                  {

                    if($this->input->post('txtMediaOpt'.$i))
                    {
                      $arr = array($i => $this->input->post('txtMediaOpt'.$i));
                      array_push($que_opt, $arr);
                      if($this->input->post('chkMedia'.$i))
                      {                  
                        $answer = $i;
                      }
                      
                    }

                  }

                    $options = json_encode($que_opt);

                  $data = array(
                    'que_title' =>  $this->input->post('txtMediaQuestion'),
                    'que_tag'   =>  $this->input->post('txtQuestionTag'),
                    'instruction'    =>  $this->input->post('txtInstruction'),
                    'que_type'    =>  $this->input->post('txtQuestionType'),
                    'options'          =>  $options,
                    'que_attachment'  =>  $file_name,
                    'correct_ans'     =>  $answer,  
                    'que_marks'       =>   $this->input->post('txtPoints'),
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date,        
                  );

                $questionAdd = $this->input->post('txtMTQuestion');
                $points+=$this->input->post('txtPoints');
              }

            if($_POST['updType'] == 'edit')
            {
              $qid = $this->input->post('que_id');
               $update_qid = $this->exam_model->updateQuestions($data,$qid);

                if($update_qid)
                {
                  $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
                  redirect('questions/manage');
                }
            }
            else{

             if($from == 'exam_que')
            {
                $inserted_qid = $this->exam_model->insertQuestions($data);

              echo 'Question Added';
                
                $printingData = '<tr id="qli'.$inserted_qid.'" style="cursor: move;" class="quizrow"><td>'.$inserted_qid.'</td><td>'.$questionAdd.'</td><td><span id="queezmarks'.$inserted_qid.'">'.$points.'</span></td><td><span class="removespan"><a href="javascript:void(0);" onclick="deleteRow(this,'.$points.'), substractMark('.$points.')" class="removeele" id="remove'.$inserted_qid.'">Remove</a></span></td><td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="'.$inserted_qid.'"></td></tr>';

                    echo "
                    <script src='//code.jquery.com/jquery-1.10.2.js'></script>
                    <script type='text/javascript'>

                                $('#quizzestoaddlist',parent.document).append('$printingData'); 

                                var tm = $('#totalmark',parent.document).val();
                                  if(tm.trim())
                                  {
                                    var tmt = $('#totalmark',parent.document).val();
                                      var tmt2 =$points + parseInt(tmt);
                                      $('#totalmark',parent.document).val(tmt2);
                                      $('#norecord',parent.document).css('display','none');
                                  }
                                  else
                                  {
                                    $('#totalmark',parent.document).val('$points'); 
                                    $('#norecord',parent.document).css('display','none');
                                  } 
                                $('#cboxClose',parent.document).click();                          
                        </script>";  
            }
            else{
              $inserted_qid = $this->exam_model->insertQuestions($data);

                if($inserted_qid)
                {
                  $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
                  redirect('questions/manage');
                }
            }
        }
            
            
          }
        }
        else
        {
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
            redirect('courses');
        }
    }

    function question_edit($qid = FALSE)
    {    
      $u_data = $this->session->userdata('logged_in');
      $q_id = $this->uri->segment(4);
      $createdBy = $this->exam_model->questionCreatedBy($q_id);
      if((@$createdBy[0]->created_by != $u_data['id'] && $u_data['groupid'] != '4') || empty($createdBy))
      {
          redirect('category/pagenotfound'); 
      }
      
      $this->template->title('Quiz List');
      //$this->template->set_layout('backend');
     $this->template->set_layout('backend');

      $this->authenticate();
      $u_data = $this->session->userdata('logged_in');
      $maccessarr = $this->session->userdata('maccessarr');
      if(($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))   
      {
        $this->template->title("Edit Question");
        $this->template->append_metadata(block_submit_button());
        
        $this->template->set('updType', 'edit');
      
       $this->template->set('questions',$this->exam_model->getQuestions($qid));
        if($this->input->post('btnSave') == '')
        {
          $this->template->build('admin/exams/question');
        }
    }
    else
    {
      $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
      redirect('category');
    }   
    }

    function upload_image()
    {  
      if(isset($_FILES['file_i'])) {
              $tmp_name = $_FILES['file_i']['tmp_name'];
              $name     = $_FILES['file_i']['name'];
              $error    = $_FILES['file_i']['error'];
              $file_type = $_FILES['file_i']['type'];
      
              if ($error === UPLOAD_ERR_OK) {
                    $output_dir = FCPATH."public/uploads/questions/";
                     $temp = explode(".", $_FILES["file_i"]["name"]);
                     $path_parts = pathinfo($output_dir.$name);
                    $i=1;
                    if(file_exists($output_dir.$name))
                    {
                      do{
                        $name = $path_parts['filename'].'_'.$i.'.'.end($temp);
                        $i++;
                      }
                      while(file_exists($output_dir.$name));
                    }
                    move_uploaded_file($tmp_name,$output_dir.$name);
                          echo $name;
              }
      }
      else{
        echo "fail";
      }
    }
    function delete($id = NULL)
    {
       if (!$id)
        {
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
            redirect('questions/manage');
        }

        $isdelete = $this->exam_model->deleteQuestion($id);

        if ($isdelete)
        {
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
        }
        else
        {
            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
        }
        redirect('questions/manage');
    }

    function sideQues()
    {
      $this->load->view('admin/exams/addquestion');
    }

    function getsubcategory($cat=NULL)
    {
      $subcate = $this->exam_model->getQuesubcat($cat);
      $Qtypes = $this->exam_model->getQuetypecat($cat);
      $Qcount = $this->exam_model->countQues($cat);
      $data[0] = $subcate; 
      $data[1] = $Qtypes;
      $data[2] = $Qcount->Qcount;
      echo json_encode($data);
    }
    function getQuetypes($subcat=NULL,$cat=NULL)
    {
      $Qtypes = $this->exam_model->getQuetypecat($cat,$subcat);
      $Qcount = $this->exam_model->countQues($cat,$subcat);
      $data[0] = $Qtypes;
      $data[1] = $Qcount->Qcount;
      echo json_encode($data);
    }
    function noQues(){
      $Qno = $_POST['Qno'] ? $_POST['Qno'] : '';
      $cat = $_POST['cat'] ? $_POST['cat'] : '';
      $subcat = $_POST['subcat'] ? $_POST['subcat'] : '';
      $Qtype = $_POST['Qtype'] ? $_POST['Qtype'] : '';

       $Qlist = $this->exam_model->Qfilter($Qno,$cat,$subcat,$Qtype);
       echo json_encode($Qlist);

    }
    function filterQue(){
      $Qno = $_POST['Qno'] ? $_POST['Qno'] : '';
      $cat = $_POST['cat'] ? $_POST['cat'] : '';
      $subcat = $_POST['subcat'] ? $_POST['subcat'] : '';
      $Qtype = $_POST['Qtype'] ? $_POST['Qtype'] : '';

       $Qlist = $this->exam_model->Qfilter($Qno,$cat,$subcat,$Qtype);
       echo json_encode($Qlist);
    }

    function getfilterQues($seccount=NULL,$seclen=NULL,$fnm=NULL)
    {  
      $Qno = $_POST['Qno'] ? $_POST['Qno'] : '';
      $cat = $_POST['cat'] ? $_POST['cat'] : '';
      $subcat = $_POST['subcat'] ? $_POST['subcat'] : '';
      $Qtype = $_POST['Qtype'] ? $_POST['Qtype'] : '';

       $Qlist = $this->exam_model->Qfilter($Qno,$cat,$subcat,$Qtype);
// echo json_encode($Qlist);
             $jsonObject = json_encode($Qlist);
             $u_data = $this->session->userdata('logged_in');
$current_date = date("Y-m-d H:i:s");
$cur_date = strtotime($current_date);
$user_id = $u_data['id'];
            if($fnm)
              $file_name = $fnm;
            else
             $file_name = $user_id.'_'.$cur_date.'.json';
           
             $myFile = FCPATH.'public/JSON/'.$file_name;
             // $arr_data = array();
  try
  {
    $data2='';
      if(file_exists($myFile))
      {
        $jsondata = file_get_contents($myFile);
        chmod($myFile, 0777);
      $jsondata = json_encode($Qlist, JSON_PRETTY_PRINT);
             // $data3 = $jsondata.',';
            if($seclen === $seccount){
              // 
              $data3 = ','.$jsondata.']';
            }
            else{
                $data3 = ','.$jsondata;
            }
        }
      else{
      $jsondata = json_encode($Qlist, JSON_PRETTY_PRINT);
      if($seclen == $seccount) 
        $data3 = $jsondata;
      else{
             $data3 = '['.$jsondata;
            // $data3 = '['.$data2;
          }
      }
if(file_put_contents($myFile, $data3, FILE_APPEND)) {
          echo $file_name;
      }
   }
   catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
    }

    function deletejsonfile()
    {
      // echo $_GET['file'];
      unlink($_GET['file']);
    }

    function exampreview()
    { 
      $data['title'] = $_POST['title'];
      $data['duration'] = $_POST['duration'];
      $data['totQ'] = $_POST['totQ'] - 1;
      $data['attempt'] = $_POST['attempt'];
      $data['avgscrore'] = $_POST['avgscrore'];
      echo $this->load->view('admin/exams/exam_preview', $data, TRUE);
    }

/*function excel_upload(){
$i='0';
  if (isset($_FILES)) {
    $ok = true;
    $file = $_FILES['file_i']['tmp_name'];
    $handle = fopen($file, "r");
    if ($file == NULL) {
       $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please select a file to import' ));
      // error(_('Please select a file to import'));
      redirect('admin/exams/examlist');
    }
    else {
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          $i++;
          $data = array(
            // 'que_id' => $filesop[0],
            'que_title' => $filesop[3],
            'que_tag' => $filesop[4],
            'instruction' => $filesop[5],
            'que_category' => $filesop[6],
            'que_subcategory' => $filesop[7],
            'que_type' => $filesop[8],
            'options' => $filesop[9],
            'que_option' => $filesop[10],
            'correct_ans' => $filesop[11],
            'que_marks' => $filesop[12],
            'que_attachment' => $filesop[13],
            'que_level' => $filesop[14],
            'published' => $filesop[15],
            'created_by' => $filesop[16],
            'created_date' => $filesop[17],
            'modified_date' => $filesop[18],
           );
          if(($i > 1 ) && $filesop[3] && $filesop[8] && $filesop[9] && $filesop[11]){
            $insert_id = $this->exam_model->uploadcsv($data);
              echo $insert_id;
          }
        
        }
        if(($filesop = fgetcsv($handle, 1000, ",")) == false){
          $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'File successfully imported' ));
     redirect('admin/exams/examlist');
        }
      }
  }
}*/

public function excel_upload()
{
	$post = $this->input->post();
    $auth = $this->session->userdata('logged_in');
        if(!empty($auth)){
        if (isset($_FILES)) {
          $file = $_FILES['bulk_upload']['tmp_name'];
          $handle = fopen($file, "r");
          if(empty($file)){
              $msgdata = array(
                'msg' => 'empty',
              );
              echo json_encode($msgdata);exit;
          }
          else {
          $i = 0;
          $flag = true;
          $output = '<div class="ui-state-default mainPageSection">
      <i class="col-sm-1 select_icon sec_handle unmoved" id="iconSec_1"></i>
      <div class="col-sm-11 ui-state-disabled" id="sector_1">
      <input id="secTitle_1" class="title_sec sec" name="section_1[]" placeholder="Section title" value="">
      <input type="hidden" name="Quecat_1[]" id="Quecat_1">
      <input type="hidden" name="Quesubcat_1[]" id="Quesubcat_1">
      <input type="hidden" name="Questype_1[]" id="Questype_1">
      <input type="hidden" name="NumQues_1[]" id="NumQues_1" class="NumQues">
      <div id="getautoque_1"></div>
      <input type="hidden" name="Qids" id="sec_Qids_1">
      </div>
      <span id="section_1"><img class="deletebtn" style="float: left; display:none" type="button" id="Secdel_1" src="/public/images/delete.3f3ed9f0.png" alt="Delete" title="Delete Section" border="0"></span>
      </div>';
      $totmk = 0;
              while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
              {
            if($flag) { $flag = false;$i++; continue; }
                $que_opt = array();
                $options = '';
                if(!empty(trim($filesop[4]))){
                    $arr = array(1 => $filesop[4]);
                    array_push($que_opt, $arr);
                } //$options .= '[{&quot;1&quot;:&quot;'.$filesop[4].'&quot;}';
                if(!empty(trim($filesop[5]))){
                    $arr = array(2 => $filesop[5]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;2&quot;:&quot;'.$filesop[5].'&quot;}';
                if(!empty(trim($filesop[6]))){
                    $arr = array(3 => $filesop[6]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;3&quot;:&quot;'.$filesop[6].'&quot;}';
                if(!empty(trim($filesop[7]))){
                    $arr = array(4 => $filesop[7]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;4&quot;:&quot;'.$filesop[7].'&quot;}';
                if(!empty(trim($filesop[8]))){
                    $arr = array(5 => $filesop[8]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;5&quot;:&quot;'.$filesop[8].'&quot;}';
                if(!empty(trim($filesop[9]))){
                    $arr = array(6 => $filesop[9]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;6&quot;:&quot;'.$filesop[9].'&quot;}';
                if(!empty(trim($filesop[10]))){
                    $arr = array(7 => $filesop[10]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;7&quot;:&quot;'.$filesop[10].'&quot;}';
                if(!empty(trim($filesop[11]))){
                    $arr = array(8 => $filesop[11]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;8&quot;:&quot;'.$filesop[11].'&quot;}';
                if(!empty(trim($filesop[12]))){
                    $arr = array(9 => $filesop[12]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;9&quot;:&quot;'.$filesop[12].'&quot;}';
                if(!empty(trim($filesop[13]))){
                    $arr = array(10 => $filesop[13]);
                    array_push($que_opt, $arr);
                } //$options .= ',{&quot;10&quot;:&quot;'.$filesop[13].'&quot;}';

                $totmk = intval($totmk) + intval($filesop[15]);
                $options = json_encode($que_opt);
                // $options .= ']';
                // $pg_des = str_replace("'",'&#39;', $post['pg_des']);
                  $sec_des = str_replace("'",'&#39;', $post['sec_des']);
                   // $pageTitle = str_replace("'",'&#39;', $post['pageTitle']);
                    $secTitle = str_replace("'",'&#39;', $post['secTitle']);

                    $txtQuestion = str_replace("'",'&#39;', $filesop[0]);
                    $options = str_replace("'",'&#39;', $options);
                    $explanation = str_replace("'",'&#39;', $filesop[16]);
                    $correct_ans = explode(',',$filesop[14]);
                    if(count($correct_ans) > 1)
                      $que_type = 'mcq';
                    else
                      $que_type = 'regular';

                  $data = array(
                      'que_title'     => $txtQuestion,
                      'que_category'    => $filesop[1],
                      'que_subcategory'   => $filesop[2],
                      'que_type'      => $que_type,
                      'options'       => $options,
                      'correct_ans'     => str_replace(',', '_',$filesop[14]),
                      'que_marks'     => $filesop[15],
                      'explanation'     => $explanation,
                      'published'     => 1,
                      'created_by'    => 1,
                      'created_date'    => date('Y-m-d'),
                      'modified_date'   => date('Y-m-d'),
                      'page_id' => 1, 
                      'section_id' => $post['section_id'],
                      'page_description' => null,
                      'section_description' => $sec_des,
                      'page_title' => null,
                      'section_title' => $secTitle,
                  );
                  $this->Crud_model->SaveData('mlms_question_bank',$data);
                  $que_id = $this->db->insert_id();
                  $this->Crud_model->SaveData('mlms_exam_questions',$data);
                  $lastid = $this->db->insert_id();
                  $newdata = array(
                        'exam_id' => $post['exam_id'],
                        'que_id' => $que_id
                  );
                  $this->Crud_model->SaveData('mlms_exam_questions',$newdata,"id = ".$lastid);

                  $Que_data = $this->Crud_model->get_single('mlms_exam_questions','id = '.$lastid);

                  /*$Que_data = $this->exam_model->get_Qedit($getlastinsert->que_id);*/
                  $output .= '<div class="page_block Quetext ui-state-default Ques" id="Que_'.$i.'">
       <div class="Qjson" id="Quejson_'.$i.'" style="display: none;" marks="'.$filesop[15].'" data=\''.json_encode($Que_data).'\'></div> 
        <span><img class="deletebtn" style="float: left;" type="button" id="Quedel_'.$i.'" src="/public/images/delete.3f3ed9f0.png" alt="Delete" title="Delete Question" border="0"></span>
        <span style="margin-right: 25px;margin-top: 5px;" class="span_marks"><p id="span_marks_'.$i.'">Marks : '.$filesop[15].'</p></span>
        <div class="ui-state-default ui-state-disabled question_grp">
        <input type="hidden" class="Queset" id="status_'.$i.'" name="status_'.$i.'[]" value="update">
        <input type="hidden" class="Queset" id="qid_'.$i.'" name="queid_'.$i.'[]" value="'.$que_id.'">
        <textarea id="ques_'.$i.'" name="txtQuestion_'.$i.'[]" style="display:none" class="Queset">'.$filesop[0].'</textarea> 
        <span id="showQue_'.$i.'" class="Quetitle inputopenNav Queset Qele"> <p>'.$filesop[0].'</p></span>
        </div>
      </div>';
                  // print_r($data);
                  $i++;
                }
                $output .= '<div class="page_block Quetext ui-state-default Ques" id="Que_'.$i.'"><div class="Qjson" id="Quejson_'.$i.'" style="display: none;"></div><span><img class="deletebtn" style="display: none" type="button" id="Quedel_'.$i.'" src="/public/images/delete.3f3ed9f0.png" alt="Delete" title="Delete Question" border="0"></span><span style="margin-right: 25px;margin-top: 5px;" class="span_marks"><p id="span_marks_'.$i.'"></p></span><div class="ui-state-default ui-state-disabled question_grp"><input type="hidden" id="qid_'.$i.'" class="form-control Queset" name="queid_'.$i.'[]" value=""><textarea id="ques_'.$i.'" name="txtQuestion_'.$i.'[]" style="display:none" class="Queset"></textarea><p type="" id="showQue_'.$i.'" class="demoQue Quetitle inputopenNav Queset Qele" placeholder=" + Add a new question here">+ Add a new question here</p></div></div>';
                $i--;
                /*if($i > 1)
                  $i .= ' Questions ';
                else
                  $i .= ' Question ';*/

                if($i == 0){
                  $msgdata = array(
                  'msg' => 'empty',
                );
                echo json_encode($msgdata);exit;
                }
                $msgdata = array(
                      'msg'   => 'inserted',
                      'total' => $i,
                      'output'  => $output,
                      'totmk' => $totmk,
              );
              echo json_encode($msgdata);
          }
        }
    }else{
      $msgdata = array(
                'msg' => 'expired',
          );
          echo json_encode($msgdata);
    }
  }

function appendQues(){
  if($_POST){
    $ids = $_POST['id'];
    $i = '0';
          $data = $this->exam_model->getbulkQues($ids);  

          $set[0] = $data;

      foreach ($data as $arr) {
         $Que = array(
            'exam_id' => '0',
            'que_id' => $arr->que_id,
            'que_category' => $arr->que_category,
            'que_subcategory' => $arr->que_subcategory,
            'que_title' => $arr->que_title,
            'instruction' => $arr->instruction,
            'explanation' => $arr->explanation,

            'que_type' => $arr->que_type,
            'options' => $arr->options,
            'que_option' => $arr->que_option,
            'correct_ans' => $arr->correct_ans,
            'que_attachment' => $arr->que_attachment,
            'que_level' => $arr->que_level,
            'que_marks' => $arr->que_marks,
            'published' => $arr->published,
            'created_by' => $arr->created_by,
            'created_date' => $arr->created_date,
            'modified_date' => $arr->modified_date,
          );
         $i++;
         $ins_id =  $this->exam_model->bulkinsertQues($Que);
         $set[$i] = $ins_id;
      }
      echo json_encode($set);
  }
}

    function addselected()
    {
        print_r($_POST);
        exit('sssss');
    }

    public function changeStatus()
    {
        $qid = $this->input->post('id');
        $status = $this->input->post('status');
        if($status=='0')
        {
          $published = 1;
        }
        else{
          $published = 0;
        }
        $upd_data = array(
                  'published' => $published
        );
        $in_ids = $qid;
        $publish=$this->exam_model->publish_unpublishItem($in_ids,$upd_data);
        if($published==1)
        {
          echo 'Quiz published successfully!';
        }
        else
        {
          echo 'Quiz unpublished successfully!';
        }
    }

  public function print_exam($exam_id = NULL)  
  {
     $u_data = $this->session->userdata('logged_in');
    $maccessarr=$this->session->userdata('maccessarr');
    if(!empty($u_data)){
      if(($u_data['groupid']==4) || ($maccessarr['courses']=='own'))
      { 
        $getexam = $this->exam_model->get_current_exam('ep.exam_id = '.$exam_id);
        $getexam_ques = $this->Crud_model->GetData('mlms_exam_questions',"que_title, que_type, options, correct_ans, que_marks","exam_id = ".$exam_id);

        $data = array(
                  'title'        => 'Exam - '.$getexam->exam_title,
                  'exam_details' => $getexam,
                  'exam_Ques'    => $getexam_ques
        );
        $this->load->view('admin/exams/print_exam_paper',$data);        
      }
      else 
      {
        $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'you have not Permission to Add Lecture' ));
        redirect(base_url());
      }
    }else 
    {
      $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'session expired. please login and try again.' ));
      redirect(base_url());
    }
  }
}?>