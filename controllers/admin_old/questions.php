<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Questions extends MLMS_Controller
{
    function __construct()
    {
        parent::__construct();

        //$this->load->helper(array('form', 'url'));

        $this->load->model('admin/questions_model');		
		
			  $this->load->model('admin/settings_model');

    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);
		
        $this->load->model('login_model');

        $this->template->set_layout('backend');

        $this->load->library('ckeditor');

        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';

        $this->load->helper('form');

        $this->load->helper('url');	

		    $this->lang->load('tooltip', 'english');

        $this->load->library('form_validation');
        ob_start();
    }

    function authenticate()
    {
        $session = $this->session->userdata('loggedin');

        if(!$this->session->userdata('loggedin'))
        {

          redirect('admin/users/login');

        }
    }

   	
	public function index($user_id = NULL)
	{
	   	$this->authenticate();
      $user_id = NULL;
      //$this->session->unset_userdata('sess_questionsgroup');
      $this->template->set_layout('backend');
      $this->template->title('Question List');
      $sess_questionsgroup = $this->session->userdata('sess_questionsgroup');
      
      if($this->input->post('reset') == 'Reset')
      {
          $search_string = $this->input->post('search_text', TRUE);       
          $search_ugroup = $this->input->post('search_group', TRUE);       
          $this->session->unset_userdata('sess_questionsgroup');
          $search_string = '';       
          $search_ugroup = '';       
      }
      else
      {
          $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_questionsgroup['searchterm'];
          $search_ugroup = ($this->input->post('search_group', TRUE)) ? $this->input->post('search_group', TRUE) : $sess_questionsgroup['searchgroup'];
          
          $searchdata = array(
        			 "searchterm" => $search_string,			 
          		 "searchgroup" => $search_ugroup				 
		      );
     	    $this->session->set_userdata('sess_questionsgroup', $searchdata);
      }
      
      $path=base_url() . "admin/questions/";
     
      $start = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $baseurl = base_url() . "admin/questions/index/";
      $this->load->library('pagination');
      $config["base_url"] = $baseurl;
      $config['per_page'] = 10;
      $config['enable_query_strings'] = true;
      $config['uri_segment'] = 4;
      $config['total_rows'] = $this->questions_model->getQuestioncount($search_string,$search_ugroup);
      $this->template->title('Question List');
      $this->pagination->initialize($config);

      $this->template->set("questions", $this->questions_model->getQuestions($user_id,$config['per_page'],$start,$search_string,$search_ugroup));
	    $this->template->set("countusers", $this->questions_model->getcountQuestion());
      $this->template->set("search_string", $search_string);    
      $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
      $this->template->build('admin/questions/list');
	}
	
	public function external($user_id = NULL)

	{
		
		$this->authenticate();

       $user_id = NULL;

       //$this->session->unset_userdata('sess_questionsgroup');

       $this->template->set_layout('backend');

       $this->template->title('User List');

       $sess_questionsgroup = $this->session->userdata('sess_questionsgroup');

	   //print_r($sess_questionsgroup);


       if($this->input->post('reset') == 'Reset'){

       $search_string = $this->input->post('search_text', TRUE);       

       $search_ugroup = $this->input->post('search_group', TRUE);       

       $this->session->unset_userdata('sess_questionsgroup');

       $search_string = '';       

       $search_ugroup = '';       

      }else{

       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_questionsgroup['searchterm'];

       $search_ugroup = ($this->input->post('search_group', TRUE)) ? $this->input->post('search_group', TRUE) : $sess_questionsgroup['searchgroup'];
  

       $searchdata = array(

				 "searchterm" => $search_string,			 

				 "searchgroup" => $search_ugroup				 

				 );

	   $this->session->set_userdata('sess_questionsgroup', $searchdata);

       }



       $path=base_url() . "admin/users/external";



       $start = ( $this->uri->segment(4)) ? $this->uri->segment(4) : 0;

       $baseurl = base_url() . "admin/users/external";

       $this->load->library('pagination');

       $config["base_url"] = $baseurl;

       $config['per_page'] = 10;

       $config['enable_query_strings'] = true;

       $config['uri_segment'] = 4;

       $config['total_rows'] = $this->users_model->getExternalcount($search_string,$search_ugroup);

       $this->template->title('External List');

       $this->pagination->initialize($config);	   

       $this->template->set("users", $this->users_model->getExternals($user_id,$config['per_page'],$start,$search_string,$search_ugroup));
	   
	  
	   $this->template->set("countusers", $this->users_model->getcountExternal());

	      

       $this->template->set("search_string", $search_string);    
	  

	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

	   $this->template->build('admin/users/externals');

	}
	
	function repostuser($id = NULL)
	{
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/users/');
		}
		$isdelete=$this->users_model->repostTrash($id);
	   	redirect('admin/users');
	}


    function create_old($parent_id = FALSE)
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
                $que1 = trim($this->input->post('txtQuestion'));
                $quepoint1 = trim($this->input->post('txtPoints'));

                $quechkReg1 = trim($this->input->post('chkReg1'));
                $quechkReg2 = trim($this->input->post('chkReg2'));
                $quechkReg3 = trim($this->input->post('chkReg3'));
                $quechkReg4 = trim($this->input->post('chkReg4'));
                $quechkReg5 = trim($this->input->post('chkReg5'));

                $queRegOpt1 = trim($this->input->post('txtRegOpt1'));
                $queRegOpt2 = trim($this->input->post('txtRegOpt2'));

                if(empty($que1))
                {
                  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please Enter Question' ));
                  redirect('admin/questions/create');
                  //exit('yes');
                }
                else if(empty($quepoint1))
                {
                  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please Enter Score' ));
                  redirect('admin/questions/create');
                }
                else if(empty($queRegOpt1) && empty($queRegOpt2))
                {
                  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please Enter options' ));
                  redirect('admin/questions/create');
                }
                else
                {
			          $data = array(
                    'question_tag'		=>	$this->input->post('txtQuestionTag'),
                    'question_type'		=>	$this->input->post('txtQuestionType'),
                    'question'			=>	  $this->input->post('txtQuestion'),
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

	                      		'question_id' =>  $inserted_qid,                    

	                      		'ans_option'  =>  $this->input->post($txtValue),

	                            'is_correct_answer' => $chk_option,

	                            'points' => $points,

	                  			);
	                        $this->questions_model->insertAnswerOption($ansOption);
	                    }
                    }
                }
              	} //validation if condition end here
            }

            if($this->input->post('txtQuestionType') == 'match_the_pair')//for match the pair question type
            {
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
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'true_false')//for true false question type
            {
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
                }
            }

            if($this->input->post('txtQuestionType') == 'multiple_type')//for multiple question type
            {
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
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'subjective')//for subjective
            {
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
    		    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
		        redirect('admin/questions/'.$parent_id);
    		  }
    		}
    		else
    		{
    			  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
    			  redirect('admin');
    		}
    }


    function create($parent_id = FALSE)
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
                $this->template->build('admin/questions/question_create');
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
                $que1 = trim($this->input->post('txtQuestion'));
               // $quepoint1 = trim($this->input->post('txtPoints'));

                $quechkReg1 = trim($this->input->post('chkReg1'));
                $quechkReg2 = trim($this->input->post('chkReg2'));
                $quechkReg3 = trim($this->input->post('chkReg3'));
                $quechkReg4 = trim($this->input->post('chkReg4'));
                $quechkReg5 = trim($this->input->post('chkReg5'));

                $queRegOpt1 = trim($this->input->post('txtRegOpt1'));
                $queRegOpt2 = trim($this->input->post('txtRegOpt2'));

                if(empty($que1))
                {
                  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please Enter Question' ));
                  redirect('admin/questions/create');
                  //exit('yes');
                }                
                else if(empty($queRegOpt1) && empty($queRegOpt2))
                {
                  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please Enter options' ));
                  redirect('admin/questions/create');
                }
                else
                {

                  $tempOptionArray = array();
                  $tempOptionAns = "";

                for($i = 1;$i<=5;$i++)
                  {
                        $txtValue = 'txtRegOpt'.$i;                        
                        $chkValue = 'chkReg'.$i;
                        if($this->input->post($chkValue))
                        {
                            $tempOptionAns.= $i;
                        }                        

                       if($this->input->post($txtValue) != '')
                       {
                           $ansOption = array('OptionIndex_'.$i  =>  $this->input->post($txtValue));
                          array_push($tempOptionArray, $ansOption);
                       }
                  }


                $data = array(
                    'que_title'        =>    $this->input->post('txtQuestion'),
                    'que_options' =>  json_encode($tempOptionArray),
                    'correct_ans'     =>  $tempOptionAns,                    
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'instructions'    =>  $this->input->post('txtInstruction'),
                    'published'       => '1',
                    'created_by'      => $user_id,
                    'created_date'    =>  $current_date           
                  );
                
                $inserted_qid = $this->questions_model->insertData('mlms_exam_que_bank',$data);
                                
              } 
            }

            if($this->input->post('txtQuestionType') == 'match_the_pair')//for match the pair question type
            {
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
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'true_false')//for true false question type
            {
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
                }
            }

            if($this->input->post('txtQuestionType') == 'multiple_type')//for multiple question type
            {
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
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'subjective')//for subjective
            {
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
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
            redirect('admin/questions/'.$parent_id);
          }
        }
        else
        {
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
            redirect('admin');
        }
    }

    function valid_url($url)

    {

        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";

        return (bool) preg_match($pattern, $url);

    }

    /*function valid_url ($url){

	$pattern = '/' . '^(https?:\/\/)[^\s]+$' . '/';

	preg_match($pattern, $url, $matches);

	$CI =& get_instance();

	$CI->form_validation->set_message('valid_url', "The url must start with 'http://' or contain no spaces");

	return (empty($matches)) ? FALSE : TRUE;

	}*/

     function user_exists($username) {



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
	
	

    function edit($qid = FALSE)
    {    	
        $this->authenticate();
		    $u_data = $this->session->userdata('loggedin');
		    if(($u_data['groupid']=='4'))		
		    {		
        //$user_info = $this->questions_model->getQuestions(($uid));
		    $this->template->title("Edit Questions");
		    $this->template->append_metadata(block_submit_button());

        //Rules for validation
        /*$this->_set_rules2();               
        $uid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
        $uid = ($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : NULL;
        //variables for check the upload
        $form_data_aux			= array();
        $files_to_delete 		= array();
        //redirect if it´s no correct
		    if (!$uid)
        {
        	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
        	redirect('admin/questions/create');
        }*/
        //$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

        $this->template->set('updType', 'edit');
       
        $this->template->set('questions',$this->questions_model->getQuestionEdit($qid));

        //if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        if($this->input->post('btnSave') == '')
        {
        	 $this->template->build('admin/questions/edit');
        }
        else
        {
            if($this->input->post('chkInpool') == 'on')
            {
                $in_pool = '1'; 
            }else{$in_pool = '0';}

        if($this->input->post('txtQuestionType') == 'regular')//for regular question type
        {
            	$data = array(
                    'question_tag'		=>	$this->input->post('txtQuestionTag'),
                    'question_type'		=>	$this->input->post('txtQuestionType'),
                    'question'			=>	  $this->input->post('txtQuestion'),
                    'instructions' 	=> 	$this->input->post('txtInstruction'),
                    'in_questions_pool' 	=> 	$in_pool,       
                    'published' => '1'                       
			    );
			
                $this->questions_model->updateQuestions($qid, $data);
                $this->questions_model->deleteAnswerOption($qid);

    			if($qid)
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

	                      			'question_id'		=>	$qid,                    

	                      			'ans_option'  =>  $this->input->post($txtValue),

	                            'is_correct_answer' => $chk_option,

	                            'points' => $points,
	                  			);
	                        $isupdated = $this->questions_model->insertAnswerOption($ansOption);
	                    }
                  	}
                }
            }

            if($this->input->post('txtQuestionType') == 'match_the_pair')//for match the pair question type
            {
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    'Match the pair',
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    'in_questions_pool'   =>  $in_pool,       
                    'published' => '1'                   
                  );
      
                $this->questions_model->updateQuestions($qid, $data);
                $this->questions_model->deleteAnswerOption($qid);

                if($qid)
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

                            'question_id'   =>  $qid,                    

                            'ans_option'  =>  $this->input->post($txtMatque),

                            'is_correct_answer' => $this->input->post($txtMatpair),

                            'points' =>  $this->input->post($txtpoints),

                        );
                        $isupdated = $this->questions_model->insertAnswerOption($ansOption);
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'true_false')//for true false question type
            {
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    $this->input->post('txtTFQuestion'),
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1'                
                );
      
                $this->questions_model->updateQuestions($qid, $data);
                $this->questions_model->deleteAnswerOption($qid);

                if($qid)
                {     
                    $ansOption = array(
                            'question_id'   =>  $qid,  
                            'ans_option'  =>  'true/false',
                            'is_correct_answer' => $this->input->post('rbTrueFalse'),
                            'points' => $this->input->post('txtTFPoints'),
                        );
                    $isupdated = $this->questions_model->insertAnswerOption($ansOption);            
                }
            }

            if($this->input->post('txtQuestionType') == 'subjective')//for subjective question type
            {
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    $this->input->post('txtSubjective'),
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1'                
                );
      
                $this->questions_model->updateQuestions($qid, $data);
                $this->questions_model->deleteAnswerOption($qid);

                if($qid)
                {     
                    $ansOption = array(
                            'question_id'   =>  $qid,  
                            'ans_option'  =>  '',
                            'is_correct_answer' => '',
                            'points' => $this->input->post('txtPoints'),
                        );
                    $isupdated = $this->questions_model->insertAnswerOption($ansOption);            
                }
            }

            if($this->input->post('txtQuestionType') == 'multiple_type')//for multiple question type
            {
                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'      =>    $this->input->post('txtMTQuestion'),
                    'instructions'  =>  $this->input->post('txtInstruction'),
                    //'in_questions_pool'   =>  $in_pool,       
                    'published' => '1'                
                );
      
                $this->questions_model->updateQuestions($qid, $data);
                $this->questions_model->deleteAnswerOption($qid);

                if($qid)
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

                            'question_id'   =>  $qid,                    

                            'ans_option'  =>  $this->input->post($txtMultiOpt),

                            'is_correct_answer' => $chk_option,

                            'points' => $this->input->post($txtpoints),

                        );
                        $isupdated = $this->questions_model->insertAnswerOption($ansOption);            
                    }
                  }
                }
            }

            if($this->input->post('txtQuestionType') == 'media_type')//for media question type
            {
                $json_decode = $this->upload_image();       

                if($json_decode['ftpfilearray'])
                {
                    $imagename = ($json_decode['ftpfilearray']) ? ($json_decode['ftpfilearray']) : $this->input->post('imagename');
                    $img_name = $json_decode['ftpfilearray'];    
                } 
                else
                {
                    $imagename = ($json_decode['ftpfilearray']) ? ($json_decode['ftpfilearray']) : $this->input->post('imagename');
                    $img_name = $imagename;
                }

                $data = array(
                    'question_tag'    =>  $this->input->post('txtQuestionTag'),
                    'question_type'   =>  $this->input->post('txtQuestionType'),
                    'question'        =>  $this->input->post('txtMediaQuestion'),
                    'attachment_url'  =>  $img_name,
                    'instructions'    =>  $this->input->post('txtInstruction'),
                    'in_questions_pool'=> $in_pool,       
                    'published' => '1'                       
                );
      
                $this->questions_model->updateQuestions($qid, $data);
                $this->questions_model->deleteAnswerOption($qid);

                if($qid)
                {
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

                            'question_id'   =>  $qid,                    

                            'ans_option'  =>  $this->input->post($txtMedOpt),

                            'is_correct_answer' => $chk_option,

                            'points' => $points,

                        );
                        $isupdated = $this->questions_model->insertAnswerOption($ansOption); 
                    }
                  }
                }                   
            }
            //conditions ends
		    
				  if($isupdated) // the information has therefore been successfully saved in the db
        	{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
        			redirect('admin/questions');
        		}
        		else{

        			redirect('admin/questions');
        		}
	        }
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
			redirect('admin');
		}		
    }
	
	  function view_request($uid = FALSE)
    {
        $this->authenticate();
		    $u_data = $this->session->userdata('loggedin');
		    if(($u_data['groupid']=='4'))		
		    {		
        $user_info = $this->users_model->getItems(($uid));
    		$this->template->title("Edit Users");
		    //$this->template->set('title', lang('web_category_create'));
        
        $user_email = @$user_info->email;

        $emailid = (isset($_POST['email'])) ? $_POST['email'] : '';

        //load block submit helper and append in the head

        $this->template->append_metadata(block_submit_button());

        //Rules for validation

        //$this->_set_rules();               

        $uid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

        $uid = ($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : NULL;

        //variables for check the upload

        $form_data_aux			= array();

        $files_to_delete 		= array();

        //redirect if it´s no correct

        if (!$uid){

        	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

        	redirect('admin/users/create_user');

        }       

        $this->template->set('updType', 'edit');

        $this->template->set('user',$this->users_model->getItems(($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : 0));
		
        $this->template->set('userinfo',$this->users_model->getInst_Desc(($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : 0));
		
        

        $gids = array();

        foreach($this->users_model->getGroup($uid) as $gid){

             $gids[] = $gid->group_id;

        }

        $this->template->set('groups', $gids);

        $this->template->set('id', $uid);

        
        if($user_email != $emailid)
    		{

		  	/*$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|callback_user_exists'); */

			  $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');

        }
		    else
		    {

			  /*$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');    */

			  $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

        }

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed

        {

        	$this->template->build('admin/users/viewrequest');

        }

        else

        {
			    /*
				
					[first_name] => jayesh
					[last_name] => jibhakate
					[group_id] => 2
					[payment_mode] => 
					[payment_type] => 
					
					[course] => codeigniter
					[goal] => Technology Awareness
					[experiance] => Online Marketing
					[subscriber] => YouTube
					[acc_status139] => Disapproved
					[description] => 
				  sdfr sdfg

					[submit] => Save
					[id] => 139
			*/
			$id = $this->input->post('id');
			
			$status = $this->input->post('acc_status');
			
			if($status == 'Approved')
			{
				$data = array('active' => '1');
			}
			else 
			{
				$data = array('active' => '0');
			}
			$configarr = $this->settings_model->getItems();	
			
			$isapprove = $this->users_model->approve_status($id,$data);
			
			$reason = array('reason' => $this->input->post('description'));
			
			$this->users_model->updateInst_Desc($id,$reason);			
			
			if($status == 'Approved')
			{
				  //$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Approved.';
					$toemail = $this->input->post('email');
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.$this->input->post('first_name').''.$this->input->post('last_name').',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].'  team regrets to inform you that your request for the External Trainer Account for our institute has been approved.<br /><br />';
					$content .='Now you can login to our institute.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .='Best regards,<br /><br />';
					$content .=''.$configarr[0]['institute_name'].'</p>';
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail='prshah83@gmail.com';		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, 'Prashant');
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
			}
			else if($status == 'Disapproved')
			{
				//$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Disapproved.';
				    $toemail = $this->input->post('email');
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.$this->input->post('first_name').''.$this->input->post('last_name').',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].' team regrets to inform you that your request for the External Trainer Account for our institute has been disapproved.<br /><br />';
					$content .='Reason : '.$this->input->post('description').'<br /><br />';
					$content .='Thank you for choosing '.$configarr[0]['institute_name'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .='Best regards,<br /><br />';
					$content .=''.$configarr[0]['institute_name'].'</p>';
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail='prshah83@gmail.com';		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, 'Prashant');
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
			}            
			redirect('admin/users/external');
        }
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
			redirect('admin');
		}		
    }
	
	function approved()
	{
		
		$id = $this->uri->segment(4);
		$data = array('active' => '1');
	    $email = $this->users_model->getEmail($id);
	    $name = $this->users_model->getUserName($id);
	  
	    $configarr = $this->settings_model->getItems();	
		
		$isapprove = $this->users_model->approve_status($id,$data);
	
		
		if($isapprove)
		{
				//$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Approved.';
					$toemail = $email;
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.$name.',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].'  team regrets to inform you that your request for the External Trainer Account for our institute has been approved.<br /><br />';
					$content .='Now you can login to our institute.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .='Best regards,<br /><br />';
					$content .=''.$configarr[0]['institute_name'].'</p>';
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail='prshah83@gmail.com';		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, 'Prashant');
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
				
				
		}
	}
	
	function disapproved()
	{
		$id = $this->uri->segment(4);
		$data = array('active' => '0');
		$email = $this->users_model->getEmail($id);
	    $name = $this->users_model->getUserName($id);
	  
	    $configarr = $this->settings_model->getItems();	
		
		$isapprove = $this->users_model->approve_status($id,$data);
	
		
		if($isapprove)
		{
				//$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Disapproved.';
					$toemail = $email;
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.$name.',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].' team regrets to inform you that your request for the External Trainer Account for our institute has been disapproved.<br /><br />';
					$content .='Thank you for choosing '.$configarr[0]['institute_name'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .='Best regards,<br /><br />';
					$content .=''.$configarr[0]['institute_name'].'</p>';
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail='prshah83@gmail.com';		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, 'Prashant');
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
				
				
		}
	}

	function trash($id = NULL)
  {
	   	$this->authenticate();

    	//filter & Sanitize $id

    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

    	//redirect if it´s no correct

    	if (!$id)
		{

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

    		redirect('admin/questions/');

    	}

		$isdelete = $this->users_model->trashItem($id);
		if ($isdelete)
    	{
    			
    			//toastr.success('User Successfully Deleted.', 'Deleted');

    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "User Successfully Deleted." ));
    	}
    	else
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}
    	redirect('admin/users');
    }


    function delete($id = NULL)
    {
        $quizzez_ids = $this->questions_model->getQuizzesids();

        $msg = 0;

        foreach($quizzez_ids as $quiz_id)
        {
            $quizid = explode(',', $quiz_id->quizzes_ids);

            if(in_array($id, $quizid))
            {
                $msg = 'yes';
            }
        }

       

        if($msg)
        {
          ?>
          <script>
              //alert('You cannot delete this question. This question must be assigned to any of the course(s).');
              document.location.href = '/admin/questions/';
          </script>
          <?php
        }

        else
        {
            $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
          //redirect if it´s no correct
          if (!$id)
          {
              $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
              redirect('admin/questions/');
          }
          if($this->questions_model->deleteItem($id))
          {
              $isdelete = $this->questions_model->deleteAnswerOption($id);
          }

          //delete the item
          if ($isdelete)
          {
              $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
          }
          else
          {
              $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
          }
          redirect('admin/questions');
        }
    }



   /* function delete($id = NULL)
    {
		    $this->authenticate();
    	  //filter & Sanitize $id
      	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
      	//redirect if it´s no correct
      	if (!$id)
        {
        		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
        		redirect('admin/questions/');
      	}
    		if($this->questions_model->deleteItem($id))
        {
            $isdelete = $this->questions_model->deleteAnswerOption($id);
        }

    	  //delete the item
      	if ($isdelete)
      	{
      	   	$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
      	}
      	else
      	{
        		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
      	}
      	redirect('admin/questions');
    } */

    //activate the user

    function activate($id, $code=false)

    {$this->authenticate();

    if ($code !== false)

    	$activation = User::activate($id, $code);

    else if ($this->sangar_auth->is_admin())

    	$activation = User::activate($id);



    if ($activation)

    {

    	//redirect them to the forgot password page

    	$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('activate_successful')) );





    	if (!$this->sangar_auth->logged_in())

    		redirect("login/", 'refresh');

    	else

    		redirect("/admin/users/", 'refresh');

    }

    else

    {

    	//redirect them to the forgot password page

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('activate_unsuccessful')) );

    	redirect("login/", 'refresh');

    }



    }



    //deactivate the user

    function deactivate($id = NULL)

    {$this->authenticate();

    // no funny business, force to integer

    $id = (int) $id;



    if ($this->sangar_auth->is_admin())

    {

    	$code = User::deactivate($id);



    	if ($code)

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('deactivate_successful')) );

    	}

    	else

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('deactivate_unsuccessful')) );

    	}



    	redirect("/admin/users/", 'refresh');

    }

    else

    {

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_not_do_this')) );

    	redirect("/admin/users/", 'refresh');

    }

    }









    private function _set_rules($type = 'create', $id = NULL)

    {

    //validate form input

    $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');

    $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|xss_clean');
	
	

    //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');



    	if ($id)

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email.id.'.$id.']|xss_clean');

		}

		else

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

		}





   /* if ($id)

    {

    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

    }

    else

    {

    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

    }*/



    if ($type == 'edit')

    	$this->form_validation->set_rules('password', 'Password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');

    else

    	$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');



    if($type == 'edit')
    {
    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', '');
    }
    else
    {

    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');
    }


    $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

    }

    //new rules for edit


    private function _set_rules2($type = 'create', $id = NULL)

    {

    //validate form input

    $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');

    $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|xss_clean');
	
	

    //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');



    	if ($id)

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email.id.'.$id.']|xss_clean');

		}

		else

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

		}   



    //if ($type == 'edit')

    	$this->form_validation->set_rules('password', 'Password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');

   // else

    	//$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');



   // if($type == 'edit')
    //{
    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', '');
   // }
   //else
    //{

    	//$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');
    //}


    $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

    }

    //forgot password

    function forgot_password()

    {

      	$this->template->set_layout('frontend');

    $this->template->title('Login');



    $this->form_validation->set_rules('email', 'lang:web_email', 'required|trim|clean_xss|valid_email');

    $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');



    if ($this->form_validation->run() == false)

    {

    	//setup the input

    	$this->template->set('email', array('name' => 'email', 'id' => 'email',));



    	//set any errors and display the form

    	$this->template->set('message', (validation_errors()) ? validation_errors() : $this->session->flashdata('message'));



    	$this->template->build('users/forgot_password');

    }

    else

    {

    	//run the forgotten password method to email an activation code to the user

    	$forgotten = $this->sangar_auth->forgotten_password($this->input->post('email'));



    	if ($forgotten)

    	{

    		//if there were no errors

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('remember_pass_successful') ));

    		redirect("/login", 'refresh'); //we should display a confirmation page here instead of the login page

    	}

    	else

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('remember_pass_unsuccessful') ));

    		redirect("/forgot_password", 'refresh');

    	}

    }

    }

    public function reset_password($code)

    {

    $reset = $this->sangar_auth->forgotten_password_complete($code);



    if ($reset)

    {

    	//if the reset worked then send them to the login page

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('password_change_successful')) );

    	redirect("/login", 'refresh');

    }

    else

    {

    	//if the reset didnt work then send them back to the forgot password page

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('password_change_unsuccessful')) );

    	redirect("/forgot_password", 'refresh');

    }

    }



}

