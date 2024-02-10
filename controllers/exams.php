<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exams extends MLMS_Controller {

  
  function __construct()
  {
        parent::__construct();
        //$this->load->helper(array('form', 'url'));
        $this->load->model('questions_model'); 
        $this->load->model('exam_model');       
        $this->load->model('admin/settings_model');   
    $configarr = $this->settings_model->getItems(); 
    // date_default_timezone_set($configarr[0]['time_zone']);

        $this->load->model('quizzes_model');
        $this->load->model('login_model');
        $this->load->helper('commonmethods');
        $this->template->set_layout('backend');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
        $this->load->helper('form');
        $this->load->helper('url'); 
        $this->lang->load('tooltip', 'english');
        $this->load->library('form_validation');
        //new one
                $this->configarr = $configarr;
        $this->template->set_layout($configarr[0]['layout_template']);
        $this->template->set("configarr", $configarr);  
        ob_start();

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
          //$this->template->set_layout('backend');
  
      $tmpl = $this->configarr[0]['layout_template'];
      $this->template->set("tmpl", $tmpl);
      $this->template->title('Quizzes List');
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

       //$search_status = (is_numeric($this->input->post('status')) && $this->input->post('status') == '0' || $this->input->post('status') == '1' ) ? $this->input->post('status') : $sess_quiz['status'];
       $searchdata = array(
         "searchterm" => $search_string,
         "searchstatus" => $search_status,
         "searchtype" => $search_type
         );
     $this->session->set_userdata('sess_quiz', $searchdata);
       }
       //$path=base_url() . "manage-exams/index/";

       $start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
       $baseurl = base_url() . "exams/index/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $config['total_rows'] = $this->exam_model->getexamcount($search_string,$search_status,$search_type,$user_id);
       $this->template->title('Exam List');
       $this->pagination->initialize($config);
     
       $this->template->set("quizzes", $this->exam_model->getItems($parent_id,$user_id,$config['per_page'],$start,$search_string,$search_status,$search_type,$user_id));
       $this->template->set("search_string", $search_string);
       $this->template->set("status", $search_status);
     $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
     $this->template->build('exams/examlist');
     }
     else
     {
        $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to View Quizes' ));
    
        redirect('exams');
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
        
    //this code is for adding front end look
    $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);
    
    $this->template->append_metadata(block_submit_button());    
    $pid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('pid', TRUE);
    $pid =  ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;
    $did = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('did', TRUE);
    $did =  ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;
    $this->template->title("Create Exam");
    $this->template->set('title', 'Create Exam');//lang('web_category_create'));
    $this->template->set('updType', 'create');
    $this->template->set('pid',$pid);
    $this->template->set('did',$did);   
    $this->form_validation->set_rules('name', 'name', 'required');
  //  $this->form_validation->set_rules('step_access', 'step access', 'required');
    $this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');
    

    if ($this->form_validation->run() === false)
    {  
          $parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
        $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
        $this->template->set('parent_id',$parent_id);
      $this->template->build('exams/create');
    }
    else
    {
     
      $alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
      
        ?>
            <script type="text/javascript">
            //window.parent.location.href = "<?php echo base_url(); ?>/days/index/<?php echo $pid?>";
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

  function edit_exam($exam_id = NULL, $parent_id = false)  
  {
    
    $u_data = $this->session->userdata('logged_in');
    $maccessarr=$this->session->userdata('maccessarr');
    if(($u_data['groupid']==4) || ($maccessarr['courses']=='own'))
    { 
        
    //this code is for adding front end look
    $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);
    // exit('59');
    $this->template->append_metadata(block_submit_button());    
    $qid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('qid', TRUE);
   
    $this->template->title("Edit Exam");
    $this->template->set('title', 'Edit Exam');
    //lang('web_category_create'));
    $this->template->set('updType', 'edit');
    $this->template->set('qid',$qid);
    $this->form_validation->set_rules('name', 'name', 'required');
  //  $this->form_validation->set_rules('step_access', 'step access', 'required');
    $this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');
    

    if ($this->form_validation->run() === false)
    {  
          $this->template->set('quiz', $this->exam_model->getItems($qid));
          $parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
        $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
        $this->template->set('parent_id',$parent_id);
      $this->template->build('exams/edit');
    }
    else
    {
      // if($_POST)
      // {
      //   print_r($_POST);
      //   exit('11');
      // }
      $alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
      
        ?>
            <script type="text/javascript">
            //window.parent.location.href = "<?php echo base_url(); ?>/days/index/<?php echo $pid?>";
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
      $this->template->title('Quizzes List');
        //$this->template->set_layout('backend');
        $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);

    //new code end
        $this->authenticate();
        $u_data = $this->session->userdata('logged_in');
        $maccessarr = $this->session->userdata('maccessarr');

        //if($this->input->post('reset') == 'Reset')
        $this->template->set('quizzes', $this->exam_model->getItems());
    if(!empty($_POST['submit_search']))
        {
          $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_quizlist['searchterm'];

          $searchdata = array(
         "searchterm" => $search_string
         );
        $this->session->set_userdata('sess_quizlist', $searchdata);
        // $this->template->set("questions",$this->quizzes_model->getQuesByTag($queid,$search_string));          
          
        }
        else
        {
          $search_string = $this->input->post('search_text', TRUE);
          $this->session->unset_userdata('sess_quizlist');
          $search_string = '';
          // $this->template->set("questions",$this->quizzes_model->getQuestionsNew($user_id,$queid,$search_string));
        // $this->template->set("questions",$this->exam_model->getExamlist($user_id));
        }

        //$this->template->title('Questions List');
      //$this->template->set("questions",$this->quizzes_model->getQuestionsNew($queid,$search_string));

    // $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

    $this->template->build('exams/examlist');

        if($this->input->post('submit'))
        {
          $quizid = $this->input->post('cb');
          $quizzes_ids = implode(',',$quizid);
          $data = array(
              'qid' => '0',
        'quizzes_ids' => ",$quizzes_ids",
        'published' => $this->input->post('published'),
      );
          // if($this->quizzes_model->insertFinalQuizzes($data))
          // {
          //     if($qid){ ?>
              <script type="text/javascript">

          //     window.parent.location.href = "<?php echo base_url(); ?>/quizzes/edit/<?php echo $qid?>";
          //     </script>
           <?php // }else{ ?>
             <script type="text/javascript">
          //       window.parent.location.href = "<?php echo base_url(); ?>/quizzes/create/";
          //       </script><?php
          //   }
          ?>

             <?php
      // }
    }
  }


function autosave($update = NULL){
     print_r($_POST);
 // // echo "44";
      exit('me');
      $u_data = $this->session->userdata('logged_in');
      $maccessarr = $this->session->userdata('maccessarr');
       $current_date = date("Y-m-d H:i:s");
       $insert ='';
       $user_id = $u_data['id'];
      $answer = '';

      $post = $this->input->post();
      $retn[0] = $post['tmp_val']; 

    if($post['q_type'] == 'regular')
    {
         if(!empty($post['txtQuestion'])){
                  $que_opt = array(); 
                  // print_r($post['txtRegOpt'.$Qkey]);
                  $i = 1;
                  foreach ($post['txtRegOpt_reg'] as $Regkey => $Regvalue) {
                    if($Regvalue)
                    {

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
                                   
                   $data = array(

                    'que_title' =>  $post['txtQuestion'],
                    // 'que_tag'   =>  $post['txtQuestionTag'],
                    'instruction' =>  $post['txtInstruction_reg'],
                    'que_type'    =>  $post['q_type'],
                    'options'         =>  $options,
                    // 'que_option'   =>  '',
                    'correct_ans'     =>  $answer,    
                    'que_marks'       =>  $post['txtPoints_reg'],
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date, 
                    // 'page_id'         =>  $pagecounter,
                    // 'page_title'      =>  $page_title,
                    // 'page_description'=>  $page_desc,
                    // 'section_id'      =>  $sectioncounter,
                    // 'section_title'   =>  $sec_title,
                    // 'section_description'=>$sec_desc,

                  );
                    $answer = '';
                         // print_r($data);
    }
    else if($post['q_type'] == 'matching')
    {
          $que_opt = array();            
                $pair_opt =array();
               $ans_series = '';
                if(!empty($post['txtQuestion'])){
               $i=1;
                 foreach ($post['txtMatchque'] as $Mkey => $Mvalue) {
                  if($Mvalue)
                  {
                    $arr = array($i => $Mvalue);
                    array_push($que_opt, $arr); 
                     if($post['txtMatchpair'][$Mkey])
                        {
                          $arr2 = array($i => $post['txtMatchpair'][$Mkey]);
                          array_push($pair_opt, $arr2);
                          //array_push($ans_series, $i);

                          $ans_series = $ans_series.$i.'_';
                        }
                        $i++;
                  }
                 } 
                }

                  $options = json_encode($que_opt);
                  $pair_options = json_encode($pair_opt);
                  // $answer = json_encode($ans_series);
                   $answer = $ans_series;
                   $data = array(

                    'que_title' =>  $post['txtQuestion'],
                    // 'que_tag'   =>  $post['txtQuestionTag'],
                    'instruction' =>  $post['txtInstruction_reg'],
                    'que_type'    =>  $post['q_type'],
                    'options'         =>  $options,
                    'que_option'      =>  $pair_options,
                    'correct_ans'     =>  $answer,    
                    'que_marks'       =>  $post['txtPoints_mat'],
                    'published'       =>  '1',
                    'created_by'      =>  $user_id,
                    'created_date'    =>  $current_date,
                    'modified_date'   =>  $current_date, 
                    // 'page_id'         =>  $pagecounter,
                    // 'page_title'      =>  $page_title,
                    // 'page_description'=>  $page_desc,
                    // 'section_id'      =>  $sectioncounter,
                    // 'section_title'   =>  $sec_title,
                    // 'section_description'=>$sec_desc,

                  );
                    $answer = '';
                     // print_r($data);
    }
    else if($post['q_type'] == 'truefalse')//for true false question type
              {
                if(!empty($post['txtQuestion'])){

                if(!empty($post['rbTrueFalse']))
                  $answer = 1;
                else $answer = 0;
              }
                  $data = array(
                      'que_title' =>  $post['txtQuestion'],
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'  =>  $post['txtInstruction_tf'],
                      'que_type'     =>  $post['q_type'],
                      'correct_ans'  =>  $answer, //1-true, 0-false   
                      'que_marks'       =>  $post['txtPoints_tf'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      // 'page_id'         =>  $pagecounter,
                      // 'page_title'      =>  $page_title,
                      // 'page_description'=>  $page_desc,
                      // 'section_id'      =>  $sectioncounter,
                      // 'section_title'   =>  $sec_title,
                      // 'section_description'=>$sec_desc,
        
                    );
                   $answer = '';
                     // print_r($data);
       
              }
              else if($post['qtype_'.$sectioncounter][$Qkey] == 'subjective')//for subjective
              {

                if(!empty($post['txtQuestion'])){
                  $data = array(
                      'que_title' =>  $post['txtQuestion'],
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'     =>  $post['txtInstruction_sub'],
                      'que_type'        =>  $post['q_type'],
                      'que_marks'       =>  $post['txtPoints_sub'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      // 'page_id'         =>  $pagecounter,
                      // 'page_title'      =>  $page_title,
                      // 'page_description'=>  $page_desc,
                      // 'section_id'      =>  $sectioncounter,
                      // 'section_title'   =>  $sec_title,
                      // 'section_description'=>$sec_desc,        
                    );
                }
                  // print_r($data);
              }

              else if($post['q_type'] == 'mcq')//for multiple question type
              {
                $que_opt = array();
                // $chk_arr = array();    
                $mark_arr = array();
                $chk_str = '';
                    if(!empty($post['txtQuestion'])){
                   $i=1;
                     foreach ($post['txtMultiOpt'] as $Mkey => $Mvalue) {
                      if($Mvalue)
                      {
                        $arr = array($i => $Mvalue);
                        array_push($que_opt, $arr); 
                        echo $post['chkMulti_'.$Mkey]."***".$Mkey;
                         if(isset($post['chkMulti_'.$i]) && $post['chkMulti_'.$i] == '1')
                            {                  
                              // array_push($chk_arr, $i);
                              $chk_str = $chk_str.$i.'_';
                            }
                         
                            $i++;
                      }
                     } 
                    }

                 

                    $options = json_encode($que_opt);
                    // $chk_arr = json_encode($chk_arr);
                   // $mk_arr = json_encode($mark_arr);

                 $data = array(
                      'que_title' =>  $post['txtQuestion'],
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'    =>  $post['txtInstruction_mul'],
                      'que_type'    =>  $post['q_type'],
                      'options'          =>  $options,
                      // 'que_option'   =>  '',
                      'correct_ans'     =>  $chk_str, //$chk_arr,  //srt index separated by :   
                      'que_marks'       =>  $post['txtPoints_mul'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      // 'page_id'         =>  $pagecounter,
                      // 'page_title'      =>  $page_title,
                      // 'page_description'=>  $page_desc,
                      // 'section_id'      =>  $sectioncounter,
                      // 'section_title'   =>  $sec_title,
                      // 'section_description'=>$sec_desc,          
                    );
                 // print_r($data);
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
                       
                          // echo $name;

                    }
            }
           
                $file_name = $name;
             if($file_name){

                  if(!empty($post['txtQuestion'])){
                  $que_opt = array(); 
                  // print_r($post['txtRegOpt'.$Qkey]);
                  $i = 1;
                  foreach ($post['txtMediaOpt'] as $Mkey => $Mvalue) {
                    if($Mvalue)
                    {

                      $arr = array($i => $Mvalue);
                     // print_r($arr);
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
                   $data = array(
                      'que_title' =>  $post['txtQuestion'],
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'    =>  $post['txtInstruction_media'],
                      'que_type'    =>  $post['q_type'],
                      'options'          =>  $options,
                      'que_attachment'  =>  $file_name,
                      // 'que_option'   =>  '',
                      'correct_ans'     =>  $answer,  //srt index separated by :   
                      'que_marks'       =>  $post['txtPoints_media'],
                      'published'       =>  '1',
                      'created_by'      =>  $user_id,
                      'created_date'    =>  $current_date,
                      'modified_date'   =>  $current_date,
                      // 'page_id'         =>  $pagecounter,
                      // 'page_title'      =>  $page_title,
                      // 'page_description'=>  $page_desc,
                      // 'section_id'      =>  $sectioncounter,
                      // 'section_title'   =>  $sec_title,
                      // 'section_description'=>$sec_desc,          
                    );

                $answer = '';
                 // print_r($data);
              }
              // echo $update;
              // print_r($data); exit('cccccccccccc');
              if(isset($update)){
                // $status = 'up';
                $qid = $post['Q_id'];
                // echo $qid;
            $update = $this->exam_model->exam_AutoQupdate($data, $qid);
               if($update)
                {
                   $retn[1] = $update; 
                }
                // print_r($retn);
              }
              else{
                $status = 'new';
                $qid = '';
             
                $insert = $this->exam_model->exam_quesauto($data, $status, $qid);

              if($insert)
              {
                 $retn[1] = $insert;
              }
            }
            echo json_encode($retn);
  
}



  function exam_submit()
  {
      $this->template->title('create exam');
        //$this->template->set_layout('backend');
        $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);

    //new code end
        $this->authenticate();
        $u_data = $this->session->userdata('logged_in');
        $maccessarr = $this->session->userdata('maccessarr');
       $current_date = date("Y-m-d H:i:s");
       $insert ='';
       $user_id = $u_data['id'];
      $answer = '';

      $post = $this->input->post();

 // print_r($post); exit('me');
      $exam_arr = array(
        'exam_title' => $post['name'],
        'description' => $post['description'],
        'exam_type' => $post['exam_type'],
        'instructions' => $post['instructions'],
        'total_marks' => $post['total_marks'],
        'passing_score' => $post['pass_score'],
        'published' => $post['published'],
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
     


 // echo $this->exam_model->strtable();
          $que_order = 0;
           $pagecounter = 1;
           $sectioncounter = 1;
           $quecounter = 1;

      foreach ($post['page_title'] as $key => $value) {
        $page_title = $value;
        $page_desc = $post['page_Desc'][$key];
       
        foreach ($post['section_'.$pagecounter] as $Sec_key => $Sec_value) {
          $sec_title = $Sec_value;
           $sec_desc = $post['secDesc_'.$pagecounter][$Sec_key];

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

           else if($post['exam_category']=='2'){  // manual
            
          foreach ($post['txtQuestion_'.$sectioncounter] as $Qkey => $Qvalue) {
            
                if(!empty($post['txtQuestion_'.$sectioncounter][$Qkey])){
                  $que_order++;

                  // if($post['queid_'.$sectioncounter][$Qkey])
                  // {
                  //   // $status = 'up';
                  //   $qid = $post['queid_'.$sectioncounter][$Qkey];
                  //   $data = array(
                  //     'exam_id'         =>  $exam,
                  //     'page_id'         =>  $pagecounter,
                  //     'page_title'      =>  $page_title,
                  //     'page_description'=>  $page_desc,
                  //     'section_id'      =>  $sectioncounter,
                  //     'section_title'   =>  $sec_title,
                  //     'section_description'=>$sec_desc,
                  //    );

                  //     $insert = $this->exam_model->exam_AutoQupdate($data, $qid);

                  // }
                  // else{

            if($post['qtype_'.$sectioncounter][$Qkey] == 'regular')//for regular question type
            { 
                            
                
                 if(!empty($post['txtRegOpt_'.$quecounter])){
                  $que_opt = array(); 
                  // print_r($post['txtRegOpt'.$Qkey]);
                  $i = 1;
                 foreach ($post['txtRegOpt_'.$quecounter] as $Regkey => $Regvalue) {

                  if($Regvalue)
                  {
                    $arr = array($i => $Regvalue);
                   // print_r($arr);
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
                    // 'que_tag'   =>  $post['txtQuestionTag'],
                    'instruction' =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                    'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                    'options'         =>  $options,
                    // 'que_option'   =>  '',
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
                       //  print_r($data);
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
                          //array_push($ans_series, $i);

                          $ans_series = $ans_series.$i.'_';
                        }
                        $i++;
                  }
                 } 
                }

                  $options = json_encode($que_opt);
                  $pair_options = json_encode($pair_opt);
                  // $answer = json_encode($ans_series);
                   $answer = $ans_series;
                   $data = array(

                    'que_title' =>  $Qvalue,
                    // 'que_tag'   =>  $post['txtQuestionTag'],
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
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
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
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
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
                // $chk_arr = array();    
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
                              // array_push($chk_arr, $i);
                              $chk_str = $chk_str.$i.'_';
                            }
                         
                            $i++;
                      }
                     } 
                    }

                 

                    $options = json_encode($que_opt);
                    // $chk_arr = json_encode($chk_arr);
                   // $mk_arr = json_encode($mark_arr);

                 $data = array(
                      'que_title' =>  $Qvalue,
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'    =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'options'          =>  $options,
                      // 'que_option'   =>  '',
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
            //   if($_POST['updType'] == 'edit')
            //   {
            //     if($_FILES['file_i']['name'])
            //     {
            //       $file_name = $this->upload_image($_FILES);
            //     }
            //     else
            //     {
            //       $file_name = $this->input->post('file_nm');
            //     }
            //   }
              // else
              // {
                $file_name = $post['MediaImg_'.$sectioncounter][$Qkey];
              // }

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
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'    =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'options'          =>  $options,
                      'que_attachment'  =>  $file_name,
                      // 'que_option'   =>  '',
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
              // print_r($data);
        // exit('post');
                if(!$post['queid_'.$sectioncounter][$Qkey]){
                $status = 'new';
                $qid = '';
              }else { $status = 'up'; 
                  $qid = $post['queid_'.$sectioncounter][$Qkey];
            }
               $insert = $this->exam_model->exam_ques($data, $exam, $que_order, $status, $qid);
             // }
           // if(@$post['status_'.$sectioncounter][$Qkey])
           //  {
           //    echo @$post['status_'.$sectioncounter][$Qkey];
           //  }
 //              echo $insert;
 // print_r($data);
                                  
            }  
            $quecounter++; 
          }

          } 
            
          $sectioncounter++;
        }
        $pagecounter++;
       }

    if($insert)
    {
      echo $insert;
    }
        
  }

  function edit()
  {

      $this->template->title('create exam');
        //$this->template->set_layout('backend');
        $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);

    //new code end
        $this->authenticate();
        $u_data = $this->session->userdata('logged_in');
        $maccessarr = $this->session->userdata('maccessarr');
       $current_date = date("Y-m-d H:i:s");
       $insert ='';
       $user_id = $u_data['id'];
      $answer = '';

      $post = $this->input->post();

// print_r($post); exit('me');
      $exam_arr = array(
        'exam_title' => $post['name'],
        'description' => $post['description'],
        'exam_type' => $post['exam_type'],
        'instructions' => $post['instructions'],
        'total_marks' => $post['total_marks'],
        'passing_score' => $post['pass_score'],
        'published' => $post['published'],
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

           else if($post['exam_category']=='2'){  // manual
             // echo $post['exam_category']; exit('11');
          foreach ($post['txtQuestion_'.$sectioncounter] as $Qkey => $Qvalue) {
            
                if(!empty($post['txtQuestion_'.$sectioncounter][$Qkey])){
                                    $que_order++;

                  if($post['queid_'.$sectioncounter][$Qkey])
                  {
                    // $status = 'up';
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
                    // print_r($data); exit('up11');
                      $insert = $this->exam_model->exam_AutoQupdate($data, $qid);

                  }
                  else{
            if($post['qtype_'.$sectioncounter][$Qkey] == 'regular')//for regular question type
            { 
                 $que_opt = array();            
                
                 if(!empty($post['txtRegOpt_'.$quecounter])){
                 // print_r($post['txtRegOpt'.$Qkey]);
                  $i = 1;
                 foreach ($post['txtRegOpt_'.$quecounter] as $Regkey => $Regvalue) {

                  if($Regvalue)
                  {
                    $arr = array($i => $Regvalue);
                   // print_r($arr);
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
                    // 'que_tag'   =>  $post['txtQuestionTag'],
                    'instruction' =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                    'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                    'options'         =>  $options,
                    // 'que_option'   =>  '',
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
                          //array_push($ans_series, $i);

                          $ans_series = $ans_series.$i.'_';
                        }
                        $i++;
                  }
                 } 
                }

                  $options = json_encode($que_opt);
                  $pair_options = json_encode($pair_opt);
                  // $answer = json_encode($ans_series);
                   $answer = $ans_series;
                   $data = array(

                    'que_title' =>  $Qvalue,
                    // 'que_tag'   =>  $post['txtQuestionTag'],
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
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
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
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
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
                // $chk_arr = array();    
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
                              // array_push($chk_arr, $i);
                              $chk_str = $chk_str.$i.'_';
                            }
                         
                            $i++;
                      }
                     } 
                    }

                 

                    $options = json_encode($que_opt);
                    // $chk_arr = json_encode($chk_arr);
                   // $mk_arr = json_encode($mark_arr);

                 $data = array(
                      'que_title' =>  $Qvalue,
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'    =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'options'          =>  $options,
                      // 'que_option'   =>  '',
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
            //   if($_POST['updType'] == 'edit')
            //   {
            //     if($_FILES['file_i']['name'])
            //     {
            //       $file_name = $this->upload_image($_FILES);
            //     }
            //     else
            //     {
            //       $file_name = $this->input->post('file_nm');
            //     }
            //   }
              // else
              // {
                $file_name = $post['MediaImg_'.$sectioncounter][$Qkey];
              // }

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
                      // 'que_tag'   =>  $this->input->post('txtQuestionTag'),
                      'instruction'    =>  $post['txtInstruction_'.$sectioncounter][$Qkey],
                      'que_type'    =>  $post['qtype_'.$sectioncounter][$Qkey],
                      'options'          =>  $options,
                      'que_attachment'  =>  $file_name,
                      // 'que_option'   =>  '',
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
              // print_r($data);
        // exit('post');
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
           
 //              echo $insert;
 // print_r($data);
                                  
            }  
            $quecounter++; 
          }

          } 
            
          $sectioncounter++;
        }
        $pagecounter++;
       }

    if($insert)
    {
      echo $insert;
    }
        
  }


  function examdelete($id = NULL)
    {

     $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

    //redirect if it´s no correct
    if (!$id){
      $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
      redirect('exams/');
    }
    // else{

     $isdelete=$this->exam_model->exam_delete($id);
// $isdelete = '';
     

    //delete the item
    if ($isdelete)
    {
        // $this->quizzes_model->deleteQuizFinalQuestions($id);
      $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ) );
    }
    else
    {
      $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    }

   
     redirect('exams');

    // }
  }


  function questions($parent_id = FALSE)
    {   //new code start by jyoti
  // print_r($this->exam_model->strtable());
      $from = $this->uri->segment(3); 
  
      $this->template->title('Quizzes List');
        //$this->template->set_layout('backend');
        $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems();
    $this->template->set_layout($configarr[0]['layout_template']);
    $tmpl = $configarr[0]['layout_template'];
    $this->template->set("tmpl", $tmpl);

    //new code end
        $this->authenticate();
        $u_data = $this->session->userdata('logged_in');
        $maccessarr = $this->session->userdata('maccessarr');
        if(($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))   
        {
            $this->template->append_metadata(block_submit_button());

            $this->_set_rules(); //
            $this->template->set('title', 'Questions');
            $this->template->set('updType', 'create');

            $this->form_validation->set_rules('txtQuestionTag', 'txtQuestionTag', 'required');

            //if ($this->form_validation->run() === FALSE)
            if($this->input->post('btnSave') == '')
          {
                //new code start sachin
                $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
          //new code end
          $this->template->build('exams/question');
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
                    // 'que_option'   =>  '',
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
                          //array_push($ans_series, $i);

                          $ans_series = $ans_series . $i . ",";
                        }
                        // if($this->input->post('txtMatchpoints'.$i))
                        // {
                        //   $arr = array($i => $this->input->post('txtMatchpoints'.$i));
                        //   array_push($opt_marks, $arr);
                        // }
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
                      // if($this->input->post('txtMultiPoints'.$i))
                      // {
                      //    $arr2 = array($i => $this->input->post('txtMultiPoints'.$i));
                      //     array_push($mark_arr, $arr2);
                      // }
                    }

                  }

                  $options = json_encode($que_opt);
                  $chk_arr = json_encode($chk_arr);
                 // $mk_arr = json_encode($mark_arr);

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
      $q_id = $this->uri->segment(3);
      $createdBy = $this->exam_model->questionCreatedBy($q_id);
      if((@$createdBy[0]->created_by != $u_data['id'] && $u_data['groupid'] != '4') || empty($createdBy))
      {
          redirect('category/pagenotfound'); 
      }
      
      $this->template->title('Quizzes List');
      //$this->template->set_layout('backend');
      $tmpl = $this->configarr[0]['layout_template'];
      $this->template->set("tmpl", $tmpl);

      $this->authenticate();
      $u_data = $this->session->userdata('logged_in');
      $maccessarr = $this->session->userdata('maccessarr');
      if(($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))   
      {   
        //$user_info = $this->questions_model->getQuestions(($uid));

        $this->template->title("Edit Question");
        $this->template->append_metadata(block_submit_button());
        
        $this->template->set('updType', 'edit');
      
       $this->template->set('questions',$this->exam_model->getQuestions($qid));

        //if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        if($this->input->post('btnSave') == '')
        {
          $this->template->build('exams/question');
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
//        print_r($_FILES);
// exit('upload');      
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
      // $this->template->build('exams/create');
      $this->load->view('exams/addquestion');
    }

    function getsubcategory($cat=NULL)
    {
      $subcate = $this->exam_model->getQuesubcat($cat);
      $Qtypes = $this->exam_model->getQuetypecat($cat);
      $Qcount = $this->exam_model->countQues($cat);
      // echo  $Qcount->Qcount;exit('jj');
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
         // converts json data into array
        // $arr_data = json_decode($jsondata, true);
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
            //  $data2 = $jsondata.',';
            // $data3 = '['.$data2;
      if($seclen == $seccount) 
        $data3 = $jsondata;
      else{
             $data3 = '['.$jsondata;
            // $data3 = '['.$data2;
          }
      }
      // array_push($arr_data,$Qlist);
     
   
  // if(file_exists($myFile)){
if(file_put_contents($myFile, $data3, FILE_APPEND)) {
          echo $file_name;
      }
    // }
     // else 
         // echo "error";

   }
   catch (Exception $e) {
      //echo 'Caught exception: ',  $e->getMessage(), "\n";
   }

// $fp = fopen(base_url().'public/JSON/exam_preview.json', 'w'); 
// fwrite($fp, json_encode($jsonObject)); 
// fclose($fp);
        // echo file_put_contents(base_url().'public/JSON/exam_preview.json', "Hello World. Testing!");
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
      echo $this->load->view('exams/exam_preview', $data, TRUE);
    }

function excel_upload(){
   // print_r($_POST);
   // print_r($_FILES);
   //  exit('88');

$i='0';
  if (isset($_FILES)) {
    $ok = true;
    $file = $_FILES['file_i']['tmp_name'];

    $handle = fopen($file, "r");
    if ($file == NULL) {
       $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please select a file to import' ));
      // error(_('Please select a file to import'));
      redirect('exams');
    }
    else {
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          $i++;
          // print_r($filesop); exit();

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
            // 'que_title' => $filesop[17],
            // 'que_title' => $filesop[18],
            // 'que_title' => $filesop[19],
            // 'que_title' => $filesop[20],
            // 'que_title' => $filesop[21],
            // 'que_title' => $filesop[22],
           
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
      
      // print_r($data);
      echo json_encode($set);
  }
}

function addselected(){
  print_r($_POST);
  exit('sssss');
}


    
    } ?>
