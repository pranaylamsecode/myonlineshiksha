<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quizzes extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);

	function __construct()
	{
		parent::__construct();
		$this->authenticate();
       // error_reporting(0);
	 	$this->load->model('admin/quizzes_model');
	 	$this->load->model('admin/questions_model');	
        $this->load->model('admin/Studreport_model');
        $this->load->library('ckeditor');	
		$this->lang->load('tooltip', 'english');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';

        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);
	}
    //check session
	function authenticate()
    {
		$session = $this->session->userdata('loggedin');
		// print_r($session);
		if(!$this->session->userdata('loggedin'))
		{
			redirect('admin/users/login');
		}
    }
   	//get quiz list
	/* public function reorder_fun($order_number){

     // print_r($order_number);
      $order = $order_number['order'];
      $cid = $order_number['cid'];
      $order = array_values($order);
      $cid = array_values($cid);
      $total = count($cid);

      	for($i=0; $i<$total; $i++){
        $data = array(
			'ordering' => $order[$i]
		);
       	$this->quizzes_model->updateOrder($cid[$i],$data);

		}
	} */
	
	public function index($parent_id = NULL)	
	{      
		if(isset($_POST) && !empty($_POST))	  
		{
			$this->reorder_fun($_POST);
		}
		$this->session->unset_userdata('sess_quiz');
		$parent_id = NULL;
		$this->template->set_layout('backend');
		$this->template->title('Exam List');
		$sess_quiz = $this->session->userdata('sess_quiz');
		if($this->input->post('reset') == 'Reset')
		{
			$search_string = $this->input->post('search_text', TRUE);
			$search_status = $this->input->post('status', TRUE);
			$search_type = $this->input->post('type', TRUE);
			$this->session->unset_userdata('sess_quiz');
			$search_string = '';
			$search_status = '';
			$search_type = '';
		}
		else
		{
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
        $path=base_url() . "admin/quizzes/";        
        $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
        $baseurl = base_url() . "admin/quizzes/";
        $this->load->library('pagination');
        $config["base_url"] = $baseurl;
        $config['per_page'] = 10;
        $config['enable_query_strings'] = true;
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->quizzes_model->getquizcount($search_string,$search_status,$search_type);
        $this->template->title('Exam List');
        $this->pagination->initialize($config);
        $this->template->set("quizzes", $this->quizzes_model->getItems($parent_id,$config['per_page'],$start,$search_string,$search_status,$search_type));
        $this->template->set("search_string", $search_string);
        $this->template->set("status", $search_status);
	    $this->template->set("countquiz", $this->quizzes_model->getcountquiz());
	    $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	    $this->template->build('admin/quizzes/list');
	}

	public function ajaxquizztotask($media_id = NULL)
    {
    $media_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : '' ;
    $frame_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : '' ;
    $questions = $this->quizzes_model->getQuestions($media_id);
    if($questions)
    {
        $qids = explode(',',$questions->quizzes_ids);
       
        $qindex = 0;
        foreach ($qids as $id) {
            $qindex++;
            
            $quest = $this->quizzes_model->getQues($id);



            echo '<br><b>Q'.$qindex.')</b> '. $quest['0']->question.'<br/>';

            if($quest['0']->question_type == 'regular')
            {

                $ans_option = $this->quizzes_model->getQuesAnsOption($id);
                foreach ($ans_option as $option) {

                    echo '<input type="checkbox" ';
                    if($option->is_correct_answer == 1)
                    {
                        echo 'checked';
                    }
                    echo' disabled="disabled"  />'. $option->ans_option.'<br/>';
                }

            }

            if($quest['0']->question_type == 'true_false')
            {
                $ans_option = $this->quizzes_model->getQuesAnsOption($id);
                foreach ($ans_option as $option) {

                    echo '<input type="checkbox" ';
                        if($option->is_correct_answer == 'True')
                        {
                            echo 'checked';
                        }
                    echo ' /> TRUE<br/>';
                    echo '<input type="checkbox" ';
                        if($option->is_correct_answer == 'False')
                        {
                            echo 'checked';
                        }
                    echo ' /> FALSE<br/>';
                }

            }

            if($quest['0']->question_type == 'media_type')
            {

                $ans_option = $this->quizzes_model->getQuesAnsOption($id);
                foreach ($ans_option as $option) {

                    echo '<input type="checkbox" ';
                    if($option->is_correct_answer == 1)
                    {
                        echo 'checked';
                    }
                    echo' disabled="disabled"  />'. $option->ans_option.'<br/>';
                }

            }
        }
    }

    
    /*$qindex = 0;
    foreach($questions as $que)
        {
        $qindex++;
        $anskey = array();
        $anskey = explode('|||',$que->answers);

        echo '<br><b>Q'.$qindex.' </b> '.$que->text;
            for($qi=1; $qi<=10; $qi++){
            $qin='a'.$qi;
                if($que->$qin != '' && isset($que->$qin) && $que->$qin != null){
                $nidell = $qi.'a';
                echo '<br>';
                echo (in_array($nidell,$anskey))? '<input type="checkbox" checked="checked"  disabled="disabled"/>' : '<input type="checkbox" disabled="disabled" />';
                echo $que->$qin;
                }
            }
        echo '<br>';

        }*/
    }
	
	public function addquestion($id = NULL)
	{
		$this->load->view('admin/quizzes/addquestion');
	}

	public function create_question($parent_id = FALSE)
    {
       	$this->authenticate();
		    $u_data = $this->session->userdata('loggedin');
	      
		    if(($u_data['groupid']=='4'))		
		    {
    	      $this->template->append_metadata(block_submit_button());

           	$this->_set_rules(); //
    	      $this->template->set('title', 'Questions');
    	      $this->template->set('updType', 'create');

            $this->form_validation->set_rules('txtQuestionTag', 'txtQuestionTag', 'required');

       	  //if ($this->form_validation->run() === FALSE)
          if($this->input->post('btnSave') == '')
    	    {
                //echo 'plplpl';
			    $this->template->build('admin/questions/create');
    	    }
          else
      	  {		
                date_default_timezone_set("Asia/Kolkata");
                $current_date = date("Y-m-d H:i:s");
                $user_id = $u_data['id'];

                if($this->input->post('chkInpool') == 'on')
                {
                    $in_pool = '1'; 
                }else{$in_pool = '0';}
			
              if($this->input->post('txtQuestionType') == 'regular')//for regular question type
              {
			        $questionAdd = $this->input->post('txtQuestion');
                    $data = array(
                    'question_tag'		=>	$this->input->post('txtQuestionTag'),
                    'question_type'		=>	$this->input->post('txtQuestionType'),
                    'question'			=>	$this->input->post('txtQuestion'),
                    'instructions' 	=> 	$this->input->post('txtInstruction'),
                    //'in_questions_pool' 	=> 	$in_pool,       
                    'published' => '1',
                    'created_by' => $user_id,
                    'created_date' =>  $current_date           
			            );
			
                $inserted_qid = $this->questions_model->insertQuestions($data);

    					  if($inserted_qid)
    		        {
                  //$user_id = $this->questions_model->maxuserid();
                  $points = $this->input->post('txtPoints');

                  for($i = 1;$i<=5;$i++)
                  {
                    $txtValue = 'txtRegOpt'.$i;
                    
                    $chkValue = 'chkReg'.$i;
                    if($this->input->post($chkValue))
                    {
                        $chk_option = '1';
                    }else{$chk_option = '0';}

                    if($this->input->post($txtValue) != '')
                    {
                        $ansOption = array(

                      			'question_id'		=>	$inserted_qid,                    

                      			'ans_option'  =>  $this->input->post($txtValue),

                            'is_correct_answer' => $chk_option,

                            'points' => $points,

                  			);
                        $this->questions_model->insertAnswerOption($ansOption);
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'match_the_pair')//for match the pair question type
            {
                $questionAdd = 'Match the pair';
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    'Match the pair',
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1',
                    'created_by' => $user_id,
                    'created_date' =>  $current_date           
                  );
      
                $inserted_qid = $this->questions_model->insertQuestions($data);

                if($inserted_qid)
                {
                  //$user_id = $this->questions_model->maxuserid();                 

                  for($i = 1;$i<=5;$i++)
                  {                    
                    $txtMatque = 'txtMatchque'.$i;
                    $txtMatpair = 'txtMatchpair'.$i;                    
                    $txtpoints = 'txtMatchpoints'.$i;                   

                    if($this->input->post($txtMatque) != '')
                    {
                        $ansOption = array(

                            'question_id'   =>  $inserted_qid,                    

                            'ans_option'  =>  $this->input->post($txtMatque),

                            'is_correct_answer' => $this->input->post($txtMatpair),

                            'points' => $this->input->post($txtpoints),
                        );
                        $this->questions_model->insertAnswerOption($ansOption);
                        $points+=$this->input->post($txtpoints);
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'true_false')//for true false question type
            {
                $questionAdd = $this->input->post('txtTFQuestion');
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    $this->input->post('txtTFQuestion'),
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1',
                    'created_by' => $user_id,
                    'created_date' =>  $current_date           
                );
      
                $inserted_qid = $this->questions_model->insertQuestions($data);

                if($inserted_qid)
                {     
                    $ansOption = array(
                            'question_id'   =>  $inserted_qid,  
                            'ans_option'  =>  'true/false',
                            'is_correct_answer' => $this->input->post('rbTrueFalse'),
                            'points' => $this->input->post('txtTFPoints'),
                        );
                        $this->questions_model->insertAnswerOption($ansOption);        
                        $points = $this->input->post('txtTFPoints');           
                }
            }

            if($this->input->post('txtQuestionType') == 'multiple_type')//for multiple question type
            {
                $questionAdd = $this->input->post('txtMTQuestion');
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    $this->input->post('txtMTQuestion'),
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1',
                    'created_by' => $user_id,
                    'created_date' =>  $current_date           
                );
      
                $inserted_qid = $this->questions_model->insertQuestions($data);

                if($inserted_qid)
                {
                  //$user_id = $this->questions_model->maxuserid();     
                  for($i = 1;$i<=5;$i++)
                  {                    
                    $txtMultiOpt = 'txtMultiOpt'.$i;                                       
                    $txtpoints = 'txtMultiPoints'.$i;                   

                    $chkValue = 'chkMulti'.$i;
                    if($this->input->post($chkValue))
                    {
                        $chk_option = '1';
                    }else{$chk_option = '0';}

                    if($this->input->post($txtMultiOpt) != '')
                    {
                        $ansOption = array(

                            'question_id'   =>  $inserted_qid,                    

                            'ans_option'  =>  $this->input->post($txtMultiOpt),

                            'is_correct_answer' => $chk_option,

                            'points' => $this->input->post($txtpoints),
                        );
                        $this->questions_model->insertAnswerOption($ansOption);
                        $points+= $this->input->post($txtpoints); 
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'subjective')//for subjective
            {
                $questionAdd = $this->input->post('txtSubjective');
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    $this->input->post('txtSubjective'),
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1',
                    'created_by' => $user_id,
                    'created_date' =>  $current_date           
                );
      
                $inserted_qid = $this->questions_model->insertQuestions($data);     

                if($inserted_qid)
                {     
                    $ansOption = array(
                            'question_id'   =>  $inserted_qid,  
                            'ans_option'  =>  'subjective',
                            'is_correct_answer' => '',
                            'points' => $this->input->post('txtPoints'),
                        );
                        $this->questions_model->insertAnswerOption($ansOption);                   
                        $points = $this->input->post('txtPoints');
                }           
            }
              
    		if($this->input->post('txtQuestionType') == 'media_type')//for media question type
            {
                $json_decode = $this->upload_image();            

               if($json_decode['ftpfilearray'])
                {
                    $imagename = ($json_decode['ftpfilearray']) ? ($json_decode['ftpfilearray']) : 'no_images.jpg';
                    $img_name = $json_decode['ftpfilearray'];
                } 
                else
                {
                   $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => $json_decode['msg'] ));
                   redirect('admin/questions/create');
                }  

                $questionAdd = $this->input->post('txtMediaQuestion');
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    $this->input->post('txtMediaQuestion'),
                    'attachment_url' =>  $img_name,
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1',
                    'created_by' => $user_id,
                    'created_date' =>  $current_date           
                );
      
                $inserted_qid = $this->questions_model->insertQuestions($data);

                if($inserted_qid)
                {
                  //$user_id = $this->questions_model->maxuserid();
                  $points = $this->input->post('txtPoints');

                  for($i = 1;$i<=5;$i++)
                  {
                    $txtMedOpt = 'txtMediaOpt'.$i;
                    
                    $chkValue = 'chkMedia'.$i;
                    if($this->input->post($chkValue))
                    {
                        $chk_option = '1';
                    }else{$chk_option = '0';}

                    if($this->input->post($txtMedOpt) != '')
                    {
                        $ansOption = array(
                            'question_id'   =>  $inserted_qid,       

                            'ans_option'  =>  $this->input->post($txtMedOpt),

                            'is_correct_answer' => $chk_option,

                            'points' => $points,

                        );
                        $this->questions_model->insertAnswerOption($ansOption);
                    }
                  }
                }       

              }
                //$this->session->set_userdata('lastQuestionId', $inserted_qid);//sets session
    		    //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
		        //redirect('admin/questions/'.$parent_id);
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
                                  }
                                  else
                                  {
                                    $('#totalmark',parent.document).val('$points'); 
                                  }  
                                  //parent.jQuery.fancybox.close();
                                  $('#cboxClose',parent.document).click();

                        </script>";                  
    		  }
    		}
    		else
    		{
    			  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
    			  //redirect('admin');
    		}
            
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
        $config['upload_path'] = FCPATH.'public/uploads/questions/';
        //$config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = '*';//for all
        $config['max_size']  = 1024 * 8;
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
        $file_id = true;

        $data = $this->upload->data();

        $file_id = true;

        if($file_id)

        {

            $status = "success";

            $msg = "File successfully uploaded";

          $config = array();

            $config['image_library'] = 'gd2';

          $config['source_image'] = FCPATH.'public/uploads/questions/img/'.$data['file_name'];

            //$config['new_image'] = FCPATH.'public/uploads/questions/img/thumbs/'.$data['file_name'];
            
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

         return $json_encode = array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']);
            
    }


	public function quizstudents($id = NULL)
	{
		$quiz = $this->uri->segment(4);
		$students = $this->quizzes_model->getQuizStudents($quiz);
		
		//$students = array_unique($students);
		$this->template->set("students",$students);
		$this->template->set_layout('backend');
		$this->template->build('admin/quizzes/quizstudents');
	}
	
	public function quizesaddtotask($parent_id = NULL)
	{ 	$this->template->title('Exam add to Layout');
        $this->template->set('updType', 'create'); 
        if($this->input->post('search_text') != '')
        {
            $search_text = $this->input->post('search_text');
            $this->template->set("quizzes", $this->quizzes_model->getFinalQuiz($parent_id,$search_text));
        }
        else
        {
	        //if($parent_id){
		    $this->template->set("quizzes", $this->quizzes_model->getFinalQuiz($parent_id));
	        //	}else{
	        //	$this->template->set("quizzes", $this->quizzes_model->getFinalQuiz($parent_id));
	        //	}
        }
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/quizzes/quizesaddtotask');

        if($this->input->post('submit'))
        {
            $quizid = $this->input->post('cb');
            $quizzes_ids = implode(',',$quizid);
            $data = array(
                'qid' => '0',
    			'quizzes_ids' => ",$quizzes_ids",
    			'published' => $this->input->post('published')
    		);
            if($this->quizzes_model->insertFinalQuizzes($data))
            {
        	    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
        		?>
                <script type="text/javascript">
                window.parent.location.href = "<?php echo base_url(); ?>/admin/quizzes/create_final/";
                </script>
                <?php
            }
        }
    }

    public function quizesaddlist($queid = NULL)
	{  
		//$this->template->set_layout('backend');
		$this->template->title('Exam add List');
       $this->template->set('updType', 'create');
       $sess_quizlist = $this->session->userdata('sess_quizlist');
       if($this->input->post('reset') == 'Reset'){
       $search_string = $this->input->post('search_text', TRUE);

       $this->session->unset_userdata('sess_quizlist');
       $search_string = '';

      }else{
       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_quizlist['searchterm'];

       $searchdata = array(
				 "searchterm" => $search_string
				 );
	   $this->session->set_userdata('sess_quizlist', $searchdata);
       }
       //$this->load->library('pagination');
      //  $path=base_url() . "admin/quizzes/quizesaddlist";
     // $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
      // $baseurl = base_url() . "admin/quizzes/quizesaddlist";
     //  $config["base_url"] = $baseurl;
       //$config['per_page'] = 2;
       //$config['enable_query_strings'] = true;
      // $config['uri_segment'] = 4;
       //$config['total_rows'] = $this->quizzes_model->getfinalquizcount($search_string);
       //$config['total_rows'] = 4;
       $this->template->title('Exam List');
     //  $this->pagination->initialize($config);

        $this->template->set("quizzes",$this->quizzes_model->getFinalQuiz($queid,$search_string));

		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/quizzes/quizesaddlist');
		//$this->template->build('admin/quizzes/questlist');
        if($this->input->post('submit')){
        $quizid = $this->input->post('cb');
        $quizzes_ids = implode(',',$quizid);
        $data = array(
            'qid' => '0',
			'quizzes_ids' => ",$quizzes_ids",
			'published' => $this->input->post('published')
		);
        if($this->quizzes_model->insertFinalQuizzes($data))
        {
            if($qid){ ?>
    				<script type="text/javascript">

    				window.parent.location.href = "<?php echo base_url(); ?>/admin/edit/exam-paper/<?php echo $qid?>";
    				</script>
					<?php }else{ ?>
					<script type="text/javascript">
      				window.parent.location.href = "<?php echo base_url(); ?>/admin/create/exam-paper/";
      				</script><?php
					}
		 ?>

         <?php
		}
		}
	}
	
 	public function questlist($queid = NULL)
	{  
		//$this->template->set_layout('backend');
		$this->template->title('Question Add List');
        $this->template->set('updType', 'create');
        $sess_quizlist = $this->session->userdata('sess_quizlist');

        $this->template->title('Questions List'); //new code here

        //if($this->input->post('reset') == 'Reset')

	if(!empty($_POST['submit_search']))
        {
        	$search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_quizlist['searchterm'];

       		$searchdata = array(
				 "searchterm" => $search_string
				 );
	   		$this->session->set_userdata('sess_quizlist', $searchdata);
	   		$this->template->set("questions",$this->quizzes_model->getQuestionsNew2($queid,$search_string));        	
        	
      	}
      	else
      	{
       		$search_string = $this->input->post('search_text', TRUE);
        	$this->session->unset_userdata('sess_quizlist');
        	$search_string = '';
        	$this->template->set("questions",$this->quizzes_model->getQuestionsNew($queid,$search_string));
       	}

       	//$this->template->title('Questions List');
	    //$this->template->set("questions",$this->quizzes_model->getQuestionsNew($queid,$search_string));

		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/quizzes/questlist');

        if($this->input->post('submit'))
        {
	        $quizid = $this->input->post('cb');
	        $quizzes_ids = implode(',',$quizid);
	        $data = array(
	            'qid' => '0',
				'quizzes_ids' => ",$quizzes_ids",
				'published' => $this->input->post('published')
			);
	        if($this->quizzes_model->insertFinalQuizzes($data))
	        {
	            if($qid){ ?>
	    				<script type="text/javascript">

	    				window.parent.location.href = "<?php echo base_url(); ?>/admin/edit/exam-paper/<?php echo $qid?>";
	    				</script>
						<?php }else{ ?>
						<script type="text/javascript">
	      				window.parent.location.href = "<?php echo base_url(); ?>/admin/create/exam-paper/";
	      				</script><?php
						}
			 		?>

	        	 <?php
			}
		}
	}


	public function newque($parent_id = NULL)
	{
		$this->template->title('Exam List');
        $this->template->set_layout('backend');
		if($parent_id){
		$this->template->set("quiz", $this->quizzes_model->getItems($parent_id));
		}else{
		$this->template->set("quizzes", $this->quizzes_model->getItems($parent_id));
		}
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/quizzes/newque.php');
	}
	
	public function copy()
	{
		$this->template->set_layout('backend');
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->template->title("Copy Exam");
		$this->form_validation->set_rules('CbQuiz', 'CbQuiz', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/quizzes/copy');
		}
		else
		{		
			$quiz_id = $this->input->post('CbQuiz');
			$select_quiz = $this->quizzes_model->getQuiz($quiz_id);
						
			$data = array(
				'name' => $select_quiz->name.' '.'Copy',
				'description' => $select_quiz->description,
				'image' => $select_quiz->image,
				'published' => $select_quiz->published,
				'startpublish' => $select_quiz->startpublish,
				'endpublish' => $select_quiz->endpublish,
				'ordering' => $select_quiz->ordering,
				'max_score' => $select_quiz->max_score,
				'pbl_max_score' => $select_quiz->pbl_max_score,
				'time_quiz_taken' => $select_quiz->time_quiz_taken,
				'show_nb_quiz_taken' => $select_quiz->show_nb_quiz_taken,
				'final_quiz' => $select_quiz->final_quiz,
				'nb_quiz_select_up' => $select_quiz->nb_quiz_select_up,
				'show_nb_quiz_select_up' => $select_quiz->show_nb_quiz_select_up,
				'limit_time' => $select_quiz->limit_time,
				'show_limit_time' => $select_quiz->show_limit_time,
				'show_countdown' => $select_quiz->show_countdown,
				'limit_time_f' => $select_quiz->limit_time_f,
				'show_finish_alert' => $select_quiz->show_finish_alert,
				'is_final' => $select_quiz->is_final,
				'student_failed_quiz' => $select_quiz->student_failed_quiz,
				'hide' => $select_quiz->hide,
				'created_by' => $select_quiz->created_by
			);
			
			$this->quizzes_model->insertItems($data);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			//$this->template->build('admin/quizzes/list');
			redirect('admin/exam-papers');
		}
	}
	
    //Function to Add Regular Quiz
	function create($parent_id = FALSE)
	{   
      // echo '<pre>';
     //  print_r($_POST);
     //  exit('dfbgd');
        error_reporting(0);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        if($this->uri->segment(4) == 'addExamToCourse' && (!empty($seg5)) && (!empty($seg6)))
        {
            $redirectlink = 'admin/tasks/quiz/'.$seg5.'/'.$seg6;
            $this->session->set_userdata('addExamToCourse', $redirectlink);            
        }
        if($this->uri->segment(4) == 'editExamToCourse' && (!empty($seg5)) && (!empty($seg6)))
        {
            $seg7 = $this->uri->segment(7);
            $redirectlink = 'admin/tasks/quizedit/'.$seg5.'/'.$seg6.'/'.$seg7;
            $this->session->set_userdata('addExamToCourse', $redirectlink);            
        }

        $u_data=$this->session->userdata('loggedin');
	   
	   	if(($u_data['groupid']=='4'))			
	  	{
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
		$this->template->append_metadata(block_submit_button());
        $this->template->set_layout('backend');
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$this->_set_rules();
        $this->template->title("Create Exam Paper");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		
		$this->template->set('questions',$this->quizzes_model->getQuestionsNew(($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : 0));
		//on dated temp 02-06-2015 by yo
        //$this->template->set('count_que',$this->quizzes_model->get_count_questions(($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : 0));

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');

        $qidck = $_POST['qidck'];

        if($qidck == ''){
             $this->form_validation->set_rules('qidck', 'Quiz', 'integer|required|xss_clean');

        }

       // if($this->input->post('show_limit_time') == '0'){
        $this->form_validation->set_rules('limit_time_l', 'Limit time for exam', 'required|greater_than[1]');
       // }
        if($this->input->post('show_finish_alert') == '0'){
         	$this->form_validation->set_rules('limit_time_f', 'Time finished alert', 'required');
        }
        //if($this->input->post('show_max_score_pass') == '0'){
         	$this->form_validation->set_rules('max_score_pass', 'Minimum score to pass the quiz', 'required');
        //}

		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/quizzes/create');
		}
		else
		{
			foreach ($_FILES as $index => $value)
			{
				if ($value['name'] != '')
				{

					$this->load->library('upload');
					$this->upload->initialize($this->set_upload_options('programs'));

					//upload the image
					if ( ! $this->upload->do_upload($index))
					{
						$this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
						//load the view and the layout
						$this->template->build('admin/quizzes/create');

						return FALSE;
					}
					else
					{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();

						//Save the name an array to save on BD before
						$form_data_aux[$index]		=	$info_upload["file_name"];

						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
						$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'programs'));

						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));

							//load the view and the layout
							$this->template->build('admin/quizzes/create');

							return FALSE;
						}
					}
				}
			}
		$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');

		$orderingval = $this->quizzes_model->maxorder();
		//$imagename=($form_data_aux[$index])?$form_data_aux[$index]:'blank.png';
        $data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			//'image' => $imagename,
			'published' => $this->input->post('published'),
			'startpublish' => $this->input->post('startpublish'),
			'endpublish' => $this->input->post('endpublish'),
			'ordering' => $orderingval,
			'max_score' => $this->input->post('max_score_pass'),
			'pbl_max_score' => $this->input->post('show_max_score_pass'),
			'time_quiz_taken' => $this->input->post('nb_quiz_taken'),
			'show_nb_quiz_taken' => $this->input->post('show_nb_quiz_taken'),
			'final_quiz' => $this->input->post('final_quiz'),
			'nb_quiz_select_up' => $this->input->post('nb_quiz_select_up'),
			'show_nb_quiz_select_up' => $this->input->post('show_nb_quiz_select_up'),
			'limit_time' => $this->input->post('limit_time_l'),
			'show_limit_time' => $this->input->post('show_limit_time'),
			'show_countdown' => $this->input->post('show_countdown'),
			'limit_time_f' => $this->input->post('limit_time_f'),
			'show_finish_alert' => $this->input->post('show_finish_alert'),
			'is_final' => $this->input->post('quiz_type'),
			'student_failed_quiz' => $this->input->post('student_failed_quiz'),
            'created_by' => $user_id,
			'hide' => $this->input->post('hide')
		);

			$insertid = $this->quizzes_model->insertItems($data);
			/*if($insertid)
			{
				$where_in = $this->input->post('qidin');
				$qdata = array(
					'qid' => $insertid
				);
				$where_in = explode(',',$where_in);
				//here update the question which are added by us when creating quiz (Adding quiz means ,
				//it stores in the database without quiz id, hence update it)
				if($this->quizzes_model->updateQuestionquid($qdata,$where_in))
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
					redirect('admin/quizzes/'.$parent_id);
				}

	           	$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				redirect('admin/quizzes/'.$parent_id);
			}*/
			if($insertid)
		   	{
			    //$where_in = $this->input->post('qidin');                
    				$quizzes_ids = implode(',',@$_POST['qidck']);
    				$qdata = array(
    				'qid' => $insertid,
    				'quizzes_ids'=> $quizzes_ids
    				);
    				if($this->quizzes_model->insertQuizfinalrel($qdata))
    				{
    					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

    					//code for exam creating from the course on dated 15-07-2015, redirect to task                        
                            if($this->session->userdata('addExamToCourse'))
                            {            
                                //$this->session->set_userdata('addExamToCourse',$insertid);
                                //public function quizesaddtotask($parent_id = NULL)
                                $newSession = $this->session->userdata('addExamToCourse').'/'.$insertid;
                                $this->session->set_userdata('addExamToCourse', $newSession);
                                redirect($this->session->userdata('addExamToCourse'));  
                            }else
                            {
                                redirect('admin/exam-papers/');    
                            }       
    				}
	            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));               		
		    }
			else
			{
			  //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
              redirect('admin/quizzes/'.$parent_id);
			}
		}
	   }
      else {
        $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'You have not permission to create' ));
              redirect('admin');
      }	  
	}
    //Function to Add Final Exam Quiz
	
	function create_final($parent_id = FALSE)
	{
	  //print_r($_POST);exit;
	     $this->template->set_layout('backend');
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$this->_set_rules();
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
        $maxquizid = $this->quizzes_model->maxquizid()+1;
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'name', 'required');
        $qidck = $_POST['qidck'];
        //print_r($qidck);
        $this->template->set('get_quiz_ids',$qidck);
        if($qidck == ''){
             $this->form_validation->set_rules('qidck', 'Quiz', 'integer|required|xss_clean');

        }

         if($this->input->post('show_limit_time') == '0'){

          $this->form_validation->set_rules('limit_time_l', 'Limit time for exam', 'required|greater_than[1]');


        }
        if($this->input->post('show_finish_alert') == '0'){
           	$this->form_validation->set_rules('limit_time_f', 'Time finished alert', 'required');
        }

        // if($this->input->post('show_max_score_pass') == '0'){
           	$this->form_validation->set_rules('max_score_pass', 'Minimum score to pass the quiz', 'required');
      //  }

		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/quizzes/create_final');
			//$this->load->view('templates/header', $data);
			//$this->load->view('admin/quizzes/create');
			//$this->load->view('templates/footer');

		}
		else
		{
			foreach ($_FILES as $index => $value)
			{
				if ($value['name'] != '')
				{
					$this->load->library('upload');
					$this->upload->initialize($this->set_upload_options('programs'));

					//upload the image
					if ( ! $this->upload->do_upload($index))
					{
						$this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
						//load the view and the layout
						$this->template->build('admin/quizzes/create_final');

						return FALSE;
					}
					else
					{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();

						//Save the name an array to save on BD before
						$form_data_aux[$index]		=	$info_upload["file_name"];

						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
						$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'programs'));

						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));

							//load the view and the layout
							$this->template->build('admin/quizzes/create_final');

							return FALSE;
						}
					}
				}
			}
		$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');

		$orderingval = $this->quizzes_model->maxorder();
//		$imagename=($form_data_aux[$index])?$form_data_aux[$index]:'blank.png';
        $data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			//'image' => $imagename,
			'published' => $this->input->post('published'),
            'startpublish' => $this->input->post('startpublish'),
			'endpublish' => $this->input->post('endpublish'),
			'ordering' => $orderingval,
			'max_score' => $this->input->post('max_score_pass'),
			'pbl_max_score' => $this->input->post('show_max_score_pass'),
			'time_quiz_taken' => $this->input->post('nb_quiz_taken'),
			'show_nb_quiz_taken' => $this->input->post('show_nb_quiz_taken'),
			'final_quiz' => $this->input->post('final_quiz'),
			'nb_quiz_select_up' => $this->input->post('nb_quiz_select_up'),
			'show_nb_quiz_select_up' => $this->input->post('show_nb_quiz_select_up'),
			'limit_time' => $this->input->post('limit_time_l'),
			'show_limit_time' => $this->input->post('show_limit_time'),
			'show_countdown' => $this->input->post('show_countdown'),
			'limit_time_f' => $this->input->post('limit_time_f'),
			'show_finish_alert' => $this->input->post('show_finish_alert'),
			'is_final' => 1,
			'student_failed_quiz' => $this->input->post('student_failed_quiz'),
			'hide' => $this->input->post('hide')
		);
	    //	print_r($data);exit;
		    $insertid = $this->quizzes_model->insertItems($data);
            //echo $maxquizid = $this->quizzes_model->maxquizid();
            //print_r($this->input->post('qidin'));
            //  echo $insertid; exit;
		   	if($insertid)
		   	{
			    //$where_in = $this->input->post('qidin');
				$quizzes_ids = implode(',',@$_POST['qidck']);
				$qdata = array(
				'qid' => $insertid,
				'quizzes_ids'=> $quizzes_ids
				);
				if($this->quizzes_model->insertQuizfinalrel($qdata))
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
					redirect('admin/exam-papers/');
				}
	            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				redirect('admin/exam-papers/');
		    }
		}
	}
	
    //Function to Edit Regular quiz
	function edit($qid = FALSE)
	{
        $parent_id = $this->uri->segment(4);
        $this->template->title("Edit Exam Paper");
        $u_data = $this->session->userdata('loggedin');
        $created = $this->quizzes_model->examCreatedBy($parent_id);
        if((@$created[0]->created_by != $u_data['id'] && $u_data['groupid'] != '4') || empty($created))
        {
            redirect('admin/users/page404'); 
        }

	    $u_data=$this->session->userdata('loggedin');
	    if(($u_data['groupid']=='4'))			
		{
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
        $this->template->set_layout('backend');
		//Rules for validation
		$this->_set_rules('edit');
		//get the $qid and sanitize
		$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('qid', TRUE);
		$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/exam-papers/');
		}
		//create control variables
		//$this->template->title("Edit Program");
		//$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'edit');
		//$this->template->set('questions',$this->quizzes_model->getQuestions(($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : 0));//commented on date 12-05-2015 for new question section
        $this->template->set('questions',$this->quizzes_model->getQuizes($qid));
        //$this->template->set('count_que',$this->quizzes_model->get_count_questions(($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : 0));
		$this->template->set('quizzes',$this->quizzes_model->getQuizes($qid));
		$this->template->set('quiz', $this->quizzes_model->getItems($qid));

        $this->template->set('quiz_pending', $this->quizzes_model->getPendingQuizzes($qid));
		
		$this->template->set('qid', $qid);
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
       	//$this->form_validation->set_rules('qidin', 'question', 'required');
        // if($this->input->post('show_limit_time') == '0'){

        $this->form_validation->set_rules('limit_time_l', 'Limit time for exam', 'required|greater_than[1]');

        if($this->input->post('show_finish_alert') == '0')
        {
         	$this->form_validation->set_rules('limit_time_f', 'Time finished alert', 'required');
        }
        if($this->input->post('show_max_score_pass') == '0')
        {
         	$this->form_validation->set_rules('max_score_pass', 'Minimum score to pass the quiz', 'required');
        }

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{		
			//load the view and the layout
			$this->template->build('admin/quizzes/create');
		}
		else
		{		
			$data['programs'] = $this->quizzes_model->getItems($this->input->post('qid', TRUE));
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
						$this->template->build('admin/quizzes/create');

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
							$this->template->build('admin/quizzes/create');
							return FALSE;
						}
					}
				}
			}

            $form_data = array(
			'name' => $this->input->post('name'),
			'description' => trim($this->input->post('description')),
			//'image' => $imagename,
			'published' => $this->input->post('published'),
            'startpublish' => $this->input->post('startpublish'),
			'endpublish' => $this->input->post('endpublish'),
			//'ordering' => $orderingval,
			'max_score' => $this->input->post('max_score_pass'),
			'pbl_max_score' => $this->input->post('show_max_score_pass'),
			'time_quiz_taken' => $this->input->post('nb_quiz_taken'),
			'show_nb_quiz_taken' => $this->input->post('show_nb_quiz_taken'),
			'final_quiz' => $this->input->post('final_quiz'),
			'nb_quiz_select_up' => $this->input->post('nb_quiz_select_up'),
			'show_nb_quiz_select_up' => $this->input->post('show_nb_quiz_select_up'),
			'limit_time' => $this->input->post('limit_time_l'),
			'show_limit_time' => $this->input->post('show_limit_time'),
			'show_countdown' => $this->input->post('show_countdown'),
			'limit_time_f' => $this->input->post('limit_time_f'),
			'show_finish_alert' => $this->input->post('show_finish_alert'),
			'is_final' => $this->input->post('quiz_type'),
			'student_failed_quiz' => $this->input->post('student_failed_quiz'),
			'hide' => $this->input->post('hide')
		);
		  
		  	$isupdated = $this->quizzes_model->updateItem($qid,$form_data);
			//my code on date 12-05-2015
             $qidck4 = @$_POST['qidck'] ? @$_POST['qidck']:'';
           	//$quizzes_ids = implode(',',@$_POST['qidck']);
             if($qidck4)
             {
             $quizzes_ids1 = implode(',',$qidck4);
             }
             else
             {
                $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Can not edit'));
                redirect('admin/edit/exam-paper/'.$qid.'/');
             }
             $quizzes_ids = $quizzes_ids1 ? $quizzes_ids1 :''; 
				$qdata = array(
					'quizzes_ids'=> $quizzes_ids,
					'qid'=>$qid,
					'published'=>'1'
				);
				$this->quizzes_model->deleteFinalQuizzes($qid);
				if($this->quizzes_model->insertFinalQuizzes($qdata))
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/exam-papers/');
				}
	            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('admin/exam-papers/');	

			/*$delquearray = explode(',',$this->input->post('delids'));
			$this->quizzes_model->deleteQuestions($delquearray);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('admin/quizzes');
			}else{
				redirect('admin/quizzes');
			}*/
	  	}
	  }
	  else
	  {
	     $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'You have not permission to edit'));
				redirect('admin');
	  }
	}
    //Function to Edit Final quiz
    function editFinalQuiz($qid = FALSE)
	{
	  
	  //print_r($_POST);exit;
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
         $this->template->set_layout('backend');
		//Rules for validation
		$this->_set_rules('edit');

		//get the parent qid and sanitize
		//$parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		//$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $qid and sanitize
		$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('qid', TRUE);
		$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/exam-papers/');
		}
       // print_r($this->quizzes_model->getQuizes($qid));
		$this->template->title("Edit Program");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'edit');
		$this->template->set('quizzes',$this->quizzes_model->getQuizes($qid));
		$this->template->set('quiz', $this->quizzes_model->getItems($qid));
		$this->template->set('qid', $qid);

		$this->form_validation->set_rules('name', 'name', 'required');
        $qidck = $_POST['qidck'];
        if($qidck == ''){
           $this->form_validation->set_rules('qidck', 'Quiz', 'integer|required|xss_clean');

        }
         //if($this->input->post('show_limit_time') == '0'){
          $this->form_validation->set_rules('limit_time_l', 'Limit time for exam', 'required|greater_than[1]');
        //}
        if($this->input->post('show_finish_alert') == '0'){
         	$this->form_validation->set_rules('limit_time_f', 'Time finished alert', 'required');
        }
        // if($this->input->post('show_max_score_pass') == '0'){
         	$this->form_validation->set_rules('max_score_pass', 'Minimum score to pass the quiz', 'required');
      //  }
		//$this->form_validation->set_rules('description', 'description', 'required');
		//$this->form_validation->set_rules('qidckemptee', 'qidckemptee', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/quizzes/create_final');
		}
		else
		{
		   
		     
			$data['programs'] = $this->quizzes_model->getItems($this->input->post('qid', TRUE));
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
						$this->template->build('admin/quizzes/create_final');

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
							$this->template->build('admin/quizzes/create_final');

							return FALSE;
						}
					}
				}
			}
//			$imagename = ($form_data_aux['image']) ? $form_data_aux['image'] : $data['programs']->$index;
//			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
            $form_data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			//'image' => $imagename,
			'published' => $this->input->post('published'),
            'startpublish' => $this->input->post('startpublish'),
			'endpublish' => $this->input->post('endpublish'),
			//'ordering' => $orderingval,
			'max_score' => $this->input->post('max_score_pass'),
			'pbl_max_score' => $this->input->post('show_max_score_pass'),
			'time_quiz_taken' => $this->input->post('nb_quiz_taken'),
			'show_nb_quiz_taken' => $this->input->post('show_nb_quiz_taken'),
			'final_quiz' => $this->input->post('final_quiz'),
			'nb_quiz_select_up' => $this->input->post('nb_quiz_select_up'),
			'show_nb_quiz_select_up' => $this->input->post('show_nb_quiz_select_up'),
			'limit_time' => $this->input->post('limit_time_l'),
			'show_limit_time' => $this->input->post('show_limit_time'),
			'show_countdown' => $this->input->post('show_countdown'),
			'limit_time_f' => $this->input->post('limit_time_f'),
			'show_finish_alert' => $this->input->post('show_finish_alert'),
			'is_final' => 1,
			'student_failed_quiz' => $this->input->post('student_failed_quiz'),
			'hide' => $this->input->post('hide')
		);
		
		 
			$isupdated = $this->quizzes_model->updateItem($qid,$form_data);

            // if($this->input->post('submit')){
              $quizzes_ids = implode(',',@$_POST['qidck']);
			  $data = array(
                'quizzes_ids' => $quizzes_ids
      		);
             // print_r($data);
            $this->quizzes_model->updateFinalQuizzes($qid,$data);

			//$delquearray = explode(',',$this->input->post('delids'));
			//$this->quizzes_model->deleteQuestions($delquearray);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('admin/exam-papers');
			}

			//if ($category->is_invalid())
			else{
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				redirect('admin/exam-papers');
			}
	  	}
	}
	/*function finalque($qid = false)
	{
		$this->template->title('Courses List');
		if($parent_id){
		$this->template->set("quiz", $this->quizzes_model->getItems($parent_id));
		}else{
		$this->template->set("quizzes", $this->quizzes_model->getItems($parent_id));
		}
		//$this->template->set('questionscount',$this->quizzes_model->get_count_questions($parent_id));
		//$this->template->set('categories',$this->quizzes_model->get_formatted_combo($parent_id));
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/quizzes/finalque.php');
	}*/
	
    //Function to Add Questions
	function createque($qid = false)
	{
		$this->template->append_metadata(block_submit_button());

		$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('qid', TRUE);
	   	$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;

		$queid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('queid', TRUE);
		$queid = ($queid != 0) ? filter_var($queid, FILTER_VALIDATE_INT) : NULL;

		$this->template->set('title', 'Create Question');//lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('qid',$qid);
		$this->template->set('queid',$queid);
		$this->load->helper('form');
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('text', 'text', 'required');
        // $this->form_validation->set_rules('a1', 'a1', 'required');
	    //	$this->form_validation->set_rules('1a', '1a', 'required');
		if ($this->form_validation->run() === false)
		{
			$this->template->build('admin/quizzes/createque');
		}
		else
		{
		$icarray = array();
		for($ic=1;$ic<=10;$ic++){
			if($this->input->post($ic.'a')){
			$icarray[] = $ic.'a';
			}
		}
		$icstring = implode('|||',$icarray);
			$data = array(
				'qid' => ($qid != NULL) ? filter_var($qid, FILTER_VALIDATE_INT) : 0,
				'text' => $this->input->post('text'),
				'a1' => $this->input->post('a1'),
				'a2' => $this->input->post('a2'),
				'a3' => $this->input->post('a3'),
				'a4' => $this->input->post('a4'),
				'a5' => $this->input->post('a5'),
				'a6' => $this->input->post('a6'),
				'a7' => $this->input->post('a7'),
				'a8' => $this->input->post('a8'),
				'a9' => $this->input->post('a9'),
				'a10' => $this->input->post('a10'),
				'answers' => $icstring,
				'published' => $this->input->post('published'),
				'reorder' => $this->quizzes_model->quemaxorder($qid)
			);

			if($this->quizzes_model->insertQuestion($data))
				{
					//$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') )); ?>
					<?php 
					if($qid)
					{
						?>
						<script type="text/javascript">
						//parent.jQuery.fancybox.close();
						window.parent.location.href = "<?php echo base_url(); ?>/admin/edit/exam-paper/<?php echo $qid?>";
						</script>
						<?php 
					}
					else
					{ 
						?>
						<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
						<script type="text/javascript">
						//parent.jQuery.fancybox.close();
						window.parent.location.href = "<?php echo base_url(); ?>/admin/create/exam-paper/";
						
						</script>
						<?php
						//redirect('admin/quizzes/create');
					}
				}


		}
	}
	
    //Function to Edit Questions
	function editque($queid = false ,$qid = false)
	{
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
		//Rules for validation
		$this->_set_rules('edit');
		//get the parent id and sanitize
		$qid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('qid', TRUE);
		$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;

		//get the $queid and sanitize
		$queid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('queid', TRUE);
		$queid = ($queid != 0) ? filter_var($queid, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$queid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
		   	redirect('admin/days/'.$qid);
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));
		$this->template->title("Edit Lesson");
		$this->template->set('question', $this->quizzes_model->getQuestion($queid));
		$this->template->set('updType', 'edit');
		$this->template->set('qid',$qid);
		$this->template->set('queid',$queid);

		$this->form_validation->set_rules('text', 'text', 'required');
        //$this->form_validation->set_rules('description', 'description', 'required');
		//$this->form_validation->set_rules('category_id', 'category_id', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/quizzes/createque');
		}
		else
		{
			$icarray = array();
			for($ic=1;$ic<=10;$ic++){
				if($this->input->post($ic.'a')){
				$icarray[] = $ic.'a';
				}
			}
			$icstring = implode('|||',$icarray);

			$form_data = array(
				'qid' => ($qid != NULL) ? filter_var($qid, FILTER_VALIDATE_INT) : 0,
				'text' => $this->input->post('text'),
				'a1' => $this->input->post('a1'),
				'a2' => $this->input->post('a2'),
				'a3' => $this->input->post('a3'),
				'a4' => $this->input->post('a4'),
				'a5' => $this->input->post('a5'),
				'a6' => $this->input->post('a6'),
				'a7' => $this->input->post('a7'),
				'a8' => $this->input->post('a8'),
				'a9' => $this->input->post('a9'),
				'a10' => $this->input->post('a10'),
				'answers' => $icstring,
				'published' => $this->input->post('published'),
				'reorder' => $this->quizzes_model->quemaxorder($qid)
			);
			$isupdated=$this->quizzes_model->updateQuestion($queid,$form_data);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') )); ?>
               <?php if($qid){ ?>
				<script type="text/javascript">
            	//parent.jQuery.fancybox.close();
				window.parent.location.href = "<?php echo base_url(); ?>/admin/edit/exam-paper/<?php echo $qid?>";
				</script>
				<?php //redirect('admin/quizzes/edit/'.$qid);
				}else{ ?>
				<script type="text/javascript">
            	//parent.jQuery.fancybox.close();
				window.parent.location.href = "<?php echo base_url(); ?>/admin/create/exam-paper/";
				</script>
				<?php
        		//redirect('admin/quizzes/create');
				}
			}
			else{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				if($qid){
				redirect('admin/edit/exam-paper/'.$qid);
				}else{
				redirect('admin/create/exam-paper');
				}
			}
	  	}
	}
    //Function to Edit Quiz
    function editquiz($queid = false ,$qid = false){
        $this->template->title('Exam add List');
         $this->template->set_layout('backend');
        $this->template->set('updType', 'create');
         // print_r($_POST);
        if($this->input->post('search_text') != ''){
        $search_text = $this->input->post('search_text');
        $this->template->set("quizzes", $this->quizzes_model->searchQuiz($search_text));

        }else{
		if($parent_id){
		$this->template->set("quiz", $this->quizzes_model->getItems($parent_id));
		}else{
		$this->template->set("quizzes", $this->quizzes_model->getItems($parent_id));
		}
        }
		//$this->template->set('questionscount',$this->quizzes_model->get_count_questions($parent_id));
		//$this->template->set('categories',$this->quizzes_model->get_formatted_combo($parent_id));
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/quizzes/quizesaddlist');

        if($this->input->post('submit')){
        $quizid = $this->input->post('cb');
        $quizzes_ids = implode(',',$quizid);
        $data = array(
            'qid' => '0',
			'quizzes_ids' => ",$quizzes_ids",
			'published' => $this->input->post('published')
		);
       // print_r($data);
       if($this->quizzes_model->insertFinalQuizzes($data))
       {
	     $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') )); ?>
         <script type="text/javascript">
        //parent.jQuery.fancybox.close();
         window.parent.location.href = "<?php echo base_url(); ?>/admin/quizzes/create_final/";
         </script>
         <?php //if($qid){
        // redirect('admin/quizzes/edit/'.$qid);
      	// }else{
      	// redirect('admin/quizzes/create');
      	//}
      }
     }
    }

    function delete_02_10_2015($id = NULL)
    {          
    	$typeid = $this->quizzes_model->gettypeid($id);
        $pid = $this->quizzes_model->getProgramByFinalquizId($id);

    	if($typeid) // regular exam
    	{
            foreach($typeid as $type)
            {
           		$typesid = $this->quizzes_model->gettypeid($type->type_id);
           		$pids = $this->quizzes_model->getpid($typesid['0']->type_id); 
                $buy_user[] = $this->quizzes_model->getuserid($pids['0']->pid);
                $certified_user[] = $this->quizzes_model->getCertifiedUser($pids['0']->pid);                  
            }     
            $buy_user = call_user_func_array('array_merge', $buy_user);
            $certified_user = call_user_func_array('array_merge', $certified_user);
            $merge_arr = array_merge($buy_user,$certified_user);
            $input = array_map("unserialize", array_unique(array_map("serialize", $merge_arr)));
            ?>
            <script>
            alert('User are ramains to take this Exam. You cannot delete this Exam.');
            document.location.href="/admin/exam-papers/";
            </script>
	        <?php
	    }

	    if($pid)//for final exam
	   	{
            foreach($pid as $pid)
    	   	{
    	   	    $buy_user[] = $this->quizzes_model->getuserid($pid->id);
    	   	  	$certified_user[] = $this->quizzes_model->getCertifiedUser($pid->id);  
            } 
            $buy_user = call_user_func_array('array_merge', $buy_user);
            $certified_user = call_user_func_array('array_merge', $certified_user);
            $merge_arr = array_merge($buy_user,$certified_user);
            $input = array_map("unserialize", array_unique(array_map("serialize", $merge_arr)));
            ?>
            <script>
            alert('User are ramains to take this Exam. You cannot delete this Exam.');
            document.location.href="/admin/exam-papers/";
            </script>
            <?php
    	}
        else
        {
            ?>
            <script>
            alert('User are ramains to take this Exam. You cannot delete this Exam.');
            document.location.href="/admin/exam-papers/";
            </script>
            <?
        }			
    }

    function delete($id = NULL)
    {    
           // error_reporting(0);  
           ob_start();    
        $typeid = $this->quizzes_model->getTypeIdNew($id);
        
        $pid = $this->quizzes_model->getProgramByFinalquizId($id);        

        if($typeid) // regular exam
        {
            foreach($typeid as $type)
            {
                $typesid = $this->quizzes_model->gettypeid($type->type_id);
                $pids = $this->quizzes_model->getpid($typesid['0']->type_id); 
                $buy_user[] = $this->quizzes_model->getuserid($pids['0']->pid);
                $certified_user[] = $this->quizzes_model->getCertifiedUser($pids['0']->pid);                  
            }     
            //$buy_user = call_user_func_array('array_merge', $buy_user);
            //$certified_user = call_user_func_array('array_merge', $certified_user);
            //$merge_arr = array_merge($buy_user,$certified_user);
            //$input = array_map("unserialize", array_unique(array_map("serialize", $merge_arr)));
            if(!empty($buy_user) || !empty($certified_user))
            {
                echo "<script>
                    alert('User are ramains to take this Exam. You cannot delete this Exam. noo'); 
                                     
                </script>";              
            }
            else
            {
                //filter & Sanitize $id
                $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;       
                if (!$id) //redirect if it´s no correct
                {
                    $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
                    redirect('admin/exam-papers/');
                }

                $isdelete=$this->quizzes_model->deleteItem($id);       
                if ($isdelete) //delete the item
                {
                    $this->quizzes_model->deleteQuizFinalQuestions($id);
                    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
                }
                else
                {
                    $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
                }                
            }
            redirect('admin/exam-papers');
        }
        else if($pid)//for final exam
        {
            foreach($pid as $pid)
            {
                //$buy_user[] = $this->quizzes_model->getuserid($pid->id);
                //$certified_user[] = $this->quizzes_model->getCertifiedUser($pid->id); 
                $check_user = $this->quizzes_model->getuserFinalquizId($id,$pid->id); 
                
            } 

            if(!empty($pid) || !empty($check_user))
            {
                
                echo"<script> alert('User are ramains to take this Exam. You cannot delete this Exam. yess');</script>";
                
            }else
            {
                //filter & Sanitize $id
                $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;       
                if (!$id) //redirect if it´s no correct
                {
                    $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
                    redirect('admin/exam-papers/');
                }

                $isdelete=$this->quizzes_model->deleteItem($id);       
                if ($isdelete) //delete the item
                {
                    $this->quizzes_model->deleteQuizFinalQuestions($id);
                    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
                }
                else
                {
                    $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
                }                
            }
            redirect('admin/exam-papers');
        } 
        else
        {
             $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;       
                if (!$id) //redirect if it´s no correct
                {
                    $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
                    redirect('admin/exam-papers/');
                }

                $isdelete=$this->quizzes_model->deleteItem($id);       
                if ($isdelete) //delete the item
                {
                    $this->quizzes_model->deleteQuizFinalQuestions($id);
                    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
                }
                else
                {
                    $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
                }  
                redirect('admin/exam-papers');
        }                          
    }



   //Function to Delete Quiz
	/*function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/quizzes/');
		}

		$isdelete=$this->quizzes_model->deleteItem($id);


		//delete the item
		if ($isdelete)
		{
		    $this->quizzes_model->deleteQuizFinalQuestions($id);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}

		//if ($category->category_id)
		//redirect('admin/quizzes/'.$category->category_id);
		//else
			redirect('admin/quizzes');

	}*/


	/*Function to publish the quiz*/
	public function publish($qid = FALSE){
	$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/exam-papers/');
			}
		else{
				$upd_data = array(
					'published' => 1
				);
				$in_ids = $qid;
				$publish=$this->quizzes_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'quiz published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'quiz publish action fail or already published!' ) );
				}
				redirect('admin/exam-papers');

			}
	}

	/*Function to unpublish the quiz*/
	public function unpublish($qid = FALSE){
		$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/exam-papers/');
			}
		else{
				$upd_data = array(
					'published' => 0
				);
				$in_ids = $qid;
				$unpublish=$this->quizzes_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'quiz unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'quiz unpublish action fail or already unpublished!' ) );
				}
				redirect('admin/exam-papers');

			}
	}

	public function activation($action = FALSE, $pid = FALSE)
	{
	$this->uri->segment(5);
   	$qid = ($this->uri->segment(5) != 0) ? filter_var($this->uri->segment(5), FILTER_VALIDATE_INT) : NULL;
   	$action = ($this->uri->segment(4) != '') ? filter_var($this->uri->segment(4), FILTER_SANITIZE_STRING) : NULL;
   	$pid = ($this->uri->segment(6) != '') ? filter_var($this->uri->segment(6), FILTER_SANITIZE_STRING) : NULL;
   	$updType = ($this->uri->segment(7) != '') ? filter_var($this->uri->segment(7), FILTER_SANITIZE_STRING) : NULL;
		//redirect if it´s no correct

		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/edit/exam-paper/'.$pid);
			}
		if($action=='deactivate'){
		$action=0;
		}else if($action=='activate'){
		$action=1;
		}else{
		$action=NULL;
		}
	   //echo $action;
	  // echo $pid;
	//$activation=$this->quizzes_model->activationItem($pid,$action);
	$activation=$this->quizzes_model->activationQuestion($qid,$action);

		//delete the item
		if ($activation)
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course activation updated successfully!' ));
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course activation fail!' ) );
		}
        if($updType == 'edit'){
		redirect('admin/edit/exam-paper/'.$pid);
        }else{
        redirect('admin/create/exam-paper/');
        }
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
		$userinfo=$this->quizzes_model->getUserInfo($userid);
		$resultinfo=$this->quizzes_model->getUserQuizResult($quizid);		
        $this->template->set_layout('backend');
		$this->template->set("userinfo", $userinfo);
		$this->template->set("resultinfo", $resultinfo);
        $this->template->build('admin/programs/quizresult');
    }
}