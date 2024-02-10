<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class webinars extends MLMS_Controller {

	protected $before_filter = array(

		//'action' => 'is_logged_in',

		//'except' => array('index')

		//'only' => array('index')

	);

	
    var $configarr;
 
	function __construct()
	{        
		parent::__construct();

		$this->authenticate();
		$this->load->helper('email');
		$this->load->helper('url');		
		$this->load->helper('form'); 
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->helper('cookie');
		$this->load->helper('commonmethods');
        $this->load->helper('text');
        $this->load->model('admin/programs_model');		
        $this->load->model('login_model');
		$this->load->model('webinars_model');
		$this->load->library('email');
		$this->load->library('webinar_library');
		$this->load->model('admin/settings_model');

		$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$this->template->set("configarr", $configarr);
		date_default_timezone_set($configarr[0]['time_zone']);

		$this->load->config('features_config');
		$webinar = $this->config->item('webinar');				
		$this->lang->load('tooltip', 'english');
		
			if($webinar['status']==FALSE)
			{

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You dont have webinar feature.' ));

			redirect('programs');

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



     public function listings($proid = NULL)
	{
		 

		$config_webinar = $this->config->item('webinar');	
         $webinar_limit = $config_webinar['classes_permonth'];
         $total_webinar = $this->webinars_model->totalWebinar();


        $configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);   

		$proid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;


		//if(isset($_POST['task']) || $_POST['task']=='orderdown' ){

		if(isset($_POST['checkval']) && $_POST['checkval']){

		$checkval = $_POST['checkval'];

		//	$id = $checkval["0"];

		$order = $_POST['order'];

		$res = $this->webinars_model->orderdown($checkval,$order);

		if($res){

		   echo	$msg = "success";

			//$this->setRedirect($link, $msg);

		}

		else{

			echo $msg ="error";

			//$this->setRedirect($link, $msg, 'notice');

		}  }

       // }

     if(isset($_POST['order'])){

      $order = $_POST['order'];

      $cid = $_POST['cid'];

      $order = array_values($order);

      $cid = array_values($cid);

      $total = count($cid);



      	for($i=0; $i<$total; $i++){

        $data = array(

			'ordering' => $order[$i]

		);

       	$this->webinars_model->updateOrder($cid[$i],$data);

		}

      }

      $sess_pcat = $this->session->userdata('sess_pcat');
	  

      if($this->input->post('reset') == 'Reset'){

      $search_string = $this->input->post('search_text', TRUE);

      $this->session->unset_userdata('sess_pcat');

      $search_string = '';

      $status = '';

      }else{

      $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_pcat['searchterm'];

       $searchdata = array(

				 "searchterm" => $search_string

				 );

	   $this->session->set_userdata('sess_pcat', $searchdata);

        }
     
       $path=base_url() . "webinars/listings/".$proid."/";

       $baseurl = base_url() . "webinars/listings/".$proid."/";
	   
	   

       $this->load->library('pagination');

       //$config['total_rows'] = $this->mcategories_model->getmcatcount($search_string,$search_cat,$search_type);	   
       
       $config['total_rows'] = $this->webinars_model->getpcatcount($search_string ,$proid); 

       $config["base_url"] = $baseurl;

       $config['per_page'] = 10;

       $config['enable_query_strings'] = true;

       $config['uri_segment'] = 4;

       $start = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : 0;

       $this->pagination->initialize($config);

       $this->template->title('Course Webinar List');

       $this->template->set("webinar_limit", $webinar_limit);

       $this->template->set("total_webinar", $total_webinar);

       $this->template->set("search_string", $search_string);

       $this->template->set("proid", $proid);

       //$this->template->set("webinars", $this->mcategories_model->getItems($proid));

       $this->template->set("webinars", $this->webinars_model->getItems($proid,null,$config['per_page'],$start,$search_string));

	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

	   $this->template->build('webinars/list');

}

	function create($s_id = FALSE,$proid = FALSE)
	{
        error_reporting(0);

		$dbname = $this->db->database;  
	  
	  $db_uname = substr($dbname,0,-7);

        $sessionarray = $this->session->userdata('logged_in');

        $user_id = $sessionarray['id'];
		
        $email_id = $sessionarray['email'];
		
		$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl); 

		$this->template->append_metadata(block_submit_button());

		// $proid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('proid', TRUE);
		$proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('proid', TRUE);

		$proid = ($proid != 0) ? filter_var($proid, FILTER_VALIDATE_INT) : 0;
		

        $this->_set_rules();

		

		/*webinar monthly count settings*/

		$webinar = $this->config->item('webinar');

		$meetings_limit = $webinar['meetings_permonth'];

		$limited_meetings = $webinar['limited_meetings'];

		$monthlywebcount = $this->webinars_model->getCurrentMonthWebinarsCount();
		
		$this->template->set('programs', $this->webinars_model->getProgram($proid));

		if($limited_meetings){

			if($monthlywebcount >= $meetings_limit){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have reached your limit of '.$meetings_limit.' webinars' ));

			   redirect('webinars/listings/'.$proid);

			   }

		   }

		/*webinar monthly count settings*/

		$success_msg = $this->uri->segment(5);
		
		if($success_msg == "success")
		{
            
			     $configarr = $this->settings_model->getItems();	

                $authorName = $this->webinars_model->getAuthorName($user_id); 

             
 

                  $proName = $this->webinars_model->getProgramName($proid);
                 

                   $authorEmail = $this->webinars_model->getAuthorEmail($user_id);

               

                  $userInfo = $this->session->all_userdata();



     //              	$urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
                  if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain'); 


                  //Email to teacher
                    $subject = "Webinar '".$userInfo['webinar_title']."' is created for '".$proName."' Course";
					$toemail =  $authorEmail; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($authorName)).',<br /><br />';
					$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us. <br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .= 'Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
				    $message = $this->load->view('email_formates/admin_email_formate.php',$data,true);

				  
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;  //$configarr[0]['fromemail'];		
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
                    $subject = 'Webinar "'.$userInfo['webinar_title'].'" scheduled successfully for Course "'.$proName.'"';
					$toemail = $admininfo->email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully scheduled for course "'.$proName.'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully scheduled for course named "'.$proName.'" on '.$userInfo['fromdate'].' form '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .='Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;   //$configarr[0]['fromemail'];		
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
                        

                    $buyUsers = $this->programs_model->getBuyUsers($proid);

                   
				     
                   // for students
				        foreach ($buyUsers as $id) {

				        	$userEmail = $this->webinars_model->getAuthorEmail($id->userid);

				        	 $userName = $this->webinars_model->getAuthorName($id->userid); 

				        	$subject = 'Webinar "'.$userInfo['webinar_title'].'" is created for "'.$proName.'" Course';
							$toemail =  $userEmail; 
							
							$content = '';
							//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
							$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							$content .= '<p>Dear '.trim(ucfirst($userName)).',<br /><br />';
							$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
							//$content .= 'A Webinar named "'.$userInfo['webinar_title'].'" is scheduled for course named "'.$proName.'" in '.$configarr[0]['institute_name'].'.<br /><br />';
							//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
							$content .='If you need help or have any questions, please contact us. <br /><br />';
							$content .= '<br /><br />';
							$content .='...</p>';
							$content .= $configarr[0]['signature'].'</p>';
							//$content .= 'Best regards,<br /><br />';
							//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
							$data['content'] = $content; 
$data['fromemail'] = $urldomain;
							$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							
							//$message = '<a href="'.$link.'">Click on link to reset password</a>';
							//$fromemail='admin@createonlineacademy.com';
							$fromemail=$urldomain;    //$configarr[0]['fromemail'];		
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
				        
				        }
		   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Webinar Created Successfully' ));

			   redirect('webinars/listings/'.$proid);
		}

		
		$this->template->set('title', 'Create Webinar Meeting');

		$this->template->set('updType', 'create');

		$this->template->set('proid',$proid);		

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('title','title', 'required');

		//$this->form_validation->set_rules('category_id', 'webinar', 'required');

        //$maxrow = $this->webinars_model->maxRow($proid);

		if ($this->form_validation->run() === FALSE)

		{

			$this->template->build('webinars/create');

		}

		else

		{

		   //$maxrow = $this->webinars_model->maxRow($proid);

           $orderingval = 0;

		  // $orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;

           $this->session->set_userdata('fromdate', $this->input->post('fromdate', TRUE ));
	        $this->session->set_userdata('fromtime', $this->input->post('fromtime', TRUE ));
	        // $this->session->set_userdata('totime', $this->input->post('totime', TRUE ));
	          $this->session->set_userdata('webinar_title', $this->input->post('title', TRUE ));
	          $this->session->set_userdata('web_duration', $this->input->post('web_duration', TRUE ));
		$proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('proid', TRUE);
		// $proid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('proid', TRUE);


           $data = array(

					       	'proid' => $proid,

					       	'title' => $this->input->post('title', TRUE ),

					       	'type' => $this->input->post('type', TRUE ),

					       	'privacy' => $this->input->post('privacy', TRUE ),

					       	'fromdate' => $this->input->post('fromdate', TRUE ),

					       	'fromtime' => $this->input->post('fromtime', TRUE ),

					       	'web_duration' => $this->input->post('web_duration', TRUE ),

					       	// 'todate' => $this->input->post('todate', TRUE ),

					       	// 'totime' => $this->input->post('totime', TRUE ),

					       	'allday' => ($this->input->post('allday', TRUE ))?1:0,

					       	'repeate' => $this->input->post('repeate', TRUE ),

					       	'untilldate' => $this->input->post('untilldate', TRUE ),

					       	'start_recording' => ($this->input->post('start_recording', TRUE ))?1:0,

					       	'status' => $this->input->post('status', TRUE ),
							
							'created_by' => $user_id,
							
							'creator_email' => $email_id,
							
							'attendees_limit' => '',

							'time_zone' => $configarr[0]['time_zone'],

						); 
						
						
                      //  $webinar_id = $this->webinars_model->insertItems($data);	
					//	$data2 = array ('webinar_new_id' => $webinar_id);
					//	$data = array_merge($data, $data2);

						//require_once("WiZiQ/WiZiQ.Class/WiZiQService.php");
						
						$web_data = $this->webinar_library->create_webinar($data);

				  		   if($web_data['wiziq_class_id'] != NULL || $web_data['webinar_msg'] != 'fail')
				  		   {
				  		   		 $data2 = array(
				        		'wiziq_class_id' => $web_data['wiziq_class_id'],
								'wiziq_recording_url' => $web_data['wiziq_recording_url'],
								'wiziq_presenter_email' => $web_data['wiziq_presenter_email'],
								'wiziq_presenter_url' => $web_data['wiziq_presenter_url']
							);
				  		$data = array_merge($data, $data2);
  		   			    $webinar_id = $this->webinars_model->insertItems($data);
  		  //  			    $data2 = array ('webinar_new_id' => $webinar_id);
						// $data = array_merge($data, $data2);
  		   			   // $web_id = $this->program_model->insertWebinar($data);

    	                   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

    	                   redirect('webinars/listings/'.$proid);
						
			}
			else{
				

				 //$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'web_create_failed' ) );
				if($web_data['errorcode'] == '1012')
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' =>'Given time slot is already scheduled. Schedule webinar at another time slot.') );
				}
				else if($web_data['errorcode'] == '1022')
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' =>'Given Datetime is invalid.') );
				}
				else{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' =>'Given Datetime is invalid.' ) );
				}
				redirect('webinars/create/'.$proid);
			}			
						
           

		}

	}

		//Function to Add product webinar

function create2($s_id = FALSE,$proid = FALSE)
	{

        error_reporting(0);

		$dbname = $this->db->database;  
	  
	  $db_uname = substr($dbname,0,-7);

        $sessionarray = $this->session->userdata('logged_in');

        $user_id = $sessionarray['id'];
		
        $email_id = $sessionarray['email'];
		
		$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl); 

		$this->template->append_metadata(block_submit_button());

		$s_id = $this->uri->segment(3);

		// $proid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('proid', TRUE);
		$proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('proid', TRUE);

		$proid = ($proid != 0) ? filter_var($proid, FILTER_VALIDATE_INT) : 0;
		

        $this->_set_rules();

		

		/*webinar monthly count settings*/

		$webinar = $this->config->item('webinar');

		$meetings_limit = $webinar['meetings_permonth'];

		$limited_meetings = $webinar['limited_meetings'];

		$monthlywebcount = $this->webinars_model->getCurrentMonthWebinarsCount();
		
		$this->template->set('programs', $this->webinars_model->getProgram($proid));

		if($limited_meetings){

			if($monthlywebcount >= $meetings_limit){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have reached your limit of '.$meetings_limit.' webinars' ));

			   redirect('webinars/listings/'.$proid);

			   }

		   }
		

		
		$this->template->set('title', 'Create Webinar Meeting');

		$this->template->set('updType', 'create');

		$this->template->set('proid',$proid);		

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('title','title', 'required');

		//$this->form_validation->set_rules('category_id', 'webinar', 'required');

        //$maxrow = $this->webinars_model->maxRow($proid);

		   //$maxrow = $this->webinars_model->maxRow($proid);

           $orderingval = 0;

		  // $orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;

           $this->session->set_userdata('fromdate', $this->input->post('fromdate', TRUE ));
	        $this->session->set_userdata('fromtime', $this->input->post('fromtime', TRUE ));
	        // $this->session->set_userdata('totime', $this->input->post('totime', TRUE ));
	          $this->session->set_userdata('webinar_title', $this->input->post('title', TRUE ));
	          $this->session->set_userdata('web_duration', $this->input->post('web_duration', TRUE ));
		// $proid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('proid', TRUE);
		$proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('proid', TRUE);

           $data = array(

					       	'proid' => $proid,

					       	 'section_id' => $s_id,

					       	'title' => $this->input->post('title', TRUE ),

					       	'type' => $this->input->post('type', TRUE ),

					       	'privacy' => $this->input->post('privacy', TRUE ),

					       	'fromdate' => $this->input->post('fromdate', TRUE ),

					       	'fromtime' => $this->input->post('fromtime', TRUE ),

					       	'web_duration' => $this->input->post('web_duration', TRUE ),

					       	// 'todate' => $this->input->post('todate', TRUE ),

					       	// 'totime' => $this->input->post('totime', TRUE ),

					       	'allday' => ($this->input->post('allday', TRUE ))?1:0,

					       	'repeate' => $this->input->post('repeate', TRUE ),

					       	'untilldate' => $this->input->post('untilldate', TRUE ),

					       	'start_recording' => ($this->input->post('start_recording', TRUE ))?1:0,

					       	'status' => $this->input->post('status', TRUE ),
							
							'created_by' => $user_id,
							
							'creator_email' => $email_id,
							
							'attendees_limit' => '',

							'time_zone' => $configarr[0]['time_zone'],

						); 
						
						
                      //  $webinar_id = $this->webinars_model->insertItems($data);	
					//	$data2 = array ('webinar_new_id' => $webinar_id);
					//	$data = array_merge($data, $data2);

						//require_once("WiZiQ/WiZiQ.Class/WiZiQService.php");
						
						$web_data = $this->webinar_library->create_webinar($data);
						
				  		   if($web_data['wiziq_class_id'] != NULL || $web_data['webinar_msg'] != 'fail')
				  		   {
				  		   		 $data2 = array(
				        		'wiziq_class_id' => $web_data['wiziq_class_id'],
								'wiziq_recording_url' => $web_data['wiziq_recording_url'],
								'wiziq_presenter_email' => $web_data['wiziq_presenter_email'],
								'wiziq_presenter_url' => $web_data['wiziq_presenter_url']
							);
				  		$data = array_merge($data, $data2);
  		   			    $webinar_id = $this->webinars_model->insertItems($data);
  		  //  			    $data2 = array ('webinar_new_id' => $webinar_id);
						// $data = array_merge($data, $data2);
  		   			   // $web_id = $this->program_model->insertWebinar($data);

    	                  // $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
  						$this->load->model('days_model');
  		   			   
  		   			    $data3 = array(
					       	'p_id' => $proid,
					       	'section_id' => $s_id,
					       	'name' => $this->input->post('title', TRUE ),
							'ordering' => $this->days_model->maxorderWeb($s_id,$proid),
					       	'is_webinar' => $webinar_id,
					       	'layoutid' => '22'
					       	);
  		   			   $lecture_id = $this->days_model->insertLectWeb($data3);

    	        $configarr = $this->settings_model->getItems();	

                $authorName = $this->webinars_model->getAuthorName($user_id); 

             
 

                  $proName = $this->webinars_model->getProgramName($proid);
                 

                   $authorEmail = $this->webinars_model->getAuthorEmail($user_id);

               

                  $userInfo = $this->session->all_userdata();



     //              	$urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
                  	if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain'); 

                  //Email to teacher
                    $subject = "Webinar '".$userInfo['webinar_title']."' is created for '".$proName."' Course";
					$toemail =  $authorEmail; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($authorName)).',<br /><br />';
					$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us. <br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .= 'Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
				    $message = $this->load->view('email_formates/admin_email_formate.php',$data,true);

				  
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;  //$configarr[0]['fromemail'];		
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
                    $subject = 'Webinar "'.$userInfo['webinar_title'].'" scheduled successfully for Course "'.$proName.'"';
					$toemail = $admininfo->email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully scheduled for course "'.$proName.'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully scheduled for course named "'.$proName.'" on '.$userInfo['fromdate'].' form '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .='Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;   //$configarr[0]['fromemail'];		
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
                        

                    $buyUsers = $this->programs_model->getBuyUsers($proid);

                   
				     
                   // for students
				        foreach ($buyUsers as $id) {

				        	$userEmail = $this->webinars_model->getAuthorEmail($id->userid);

				        	 $userName = $this->webinars_model->getAuthorName($id->userid); 

				        	$subject = 'Webinar "'.$userInfo['webinar_title'].'" is created for "'.$proName.'" Course';
							$toemail =  $userEmail; 
							
							$content = '';
							//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
							$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							$content .= '<p>Dear '.trim(ucfirst($userName)).',<br /><br />';
							$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
							//$content .= 'A Webinar named "'.$userInfo['webinar_title'].'" is scheduled for course named "'.$proName.'" in '.$configarr[0]['institute_name'].'.<br /><br />';
							//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
							$content .='If you need help or have any questions, please contact us. <br /><br />';
							$content .= '<br /><br />';
							$content .='...</p>';
							$content .= $configarr[0]['signature'].'</p>';
							//$content .= 'Best regards,<br /><br />';
							//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
							$data['content'] = $content; 
$data['fromemail'] = $urldomain;
							$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							
							//$message = '<a href="'.$link.'">Click on link to reset password</a>';
							//$fromemail='admin@createonlineacademy.com';
							$fromemail=$urldomain;    //$configarr[0]['fromemail'];		
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
				        
				        }
    	                   echo "success";
    	                   // redirect('webinars/listings/'.$proid);
						
			}
			else{
					echo $web_data['errormsg'];

			}			
						
           

		

	}

//Function to Add product webinar

	function create_new($proid = FALSE)
	{
        error_reporting(0);
       
		$dbname = $this->db->database;  
	  
	  $db_uname = substr($dbname,0,-7);

        $sessionarray = $this->session->userdata('logged_in');

        $user_id = $sessionarray['id'];
		
        $email_id = $sessionarray['email'];
		
		$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl); 

		$this->template->append_metadata(block_submit_button());

		$proid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('proid', TRUE);

		$proid = ($proid != 0) ? filter_var($proid, FILTER_VALIDATE_INT) : 0;

		

		

        //$this->_set_rules();

		

		/*webinar monthly count settings*/

		$webinar = $this->config->item('webinar');

		$meetings_limit = $webinar['meetings_permonth'];

		$limited_meetings = $webinar['limited_meetings'];

		$monthlywebcount = $this->webinars_model->getCurrentMonthWebinarsCount();
		
		$this->template->set('programs', $this->webinars_model->getProgram($proid));

		if($limited_meetings){

			if($monthlywebcount >= $meetings_limit){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have reached your limit of '.$meetings_limit.' webinars' ));

			   redirect('webinars/listings/'.$proid);

			   }

		   }

		/*webinar monthly count settings*/

		$success_msg = $this->uri->segment(4);
		
		if($success_msg == "success")
		{
            
			     $configarr = $this->settings_model->getItems();	

                $authorName = $this->webinars_model->getAuthorName($user_id); 

             
 

                  $proName = $this->webinars_model->getProgramName($proid);
                 

                   $authorEmail = $this->webinars_model->getAuthorEmail($user_id);

               

                  $userInfo = $this->session->all_userdata();



     //              	$urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
                  if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain'); 


                  //Email to teacher
                    $subject = "Webinar '".$userInfo['webinar_title']."' is created for '".$proName."' Course";
					$toemail =  $authorEmail; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($authorName)).',<br /><br />';
					$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us. <br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .= 'Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
				    $message = $this->load->view('email_formates/admin_email_formate.php',$data,true);

				  
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;  //$configarr[0]['fromemail'];		
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
                    $subject = 'Webinar "'.$userInfo['webinar_title'].'" scheduled successfully for Course "'.$proName.'"';
					$toemail = $admininfo->email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully scheduled for course "'.$proName.'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully scheduled for course named "'.$proName.'" on '.$userInfo['fromdate'].' form '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .='Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;   //$configarr[0]['fromemail'];		
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
                        

                    $buyUsers = $this->programs_model->getBuyUsers($proid);

                   
				     
                   // for students
				        foreach ($buyUsers as $id) {

				        	$userEmail = $this->webinars_model->getAuthorEmail($id->userid);

				        	 $userName = $this->webinars_model->getAuthorName($id->userid); 

				        	$subject = 'Webinar "'.$userInfo['webinar_title'].'" is created for "'.$proName.'" Course';
							$toemail =  $userEmail; 
							
							$content = '';
							//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
							$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							$content .= '<p>Dear '.trim(ucfirst($userName)).',<br /><br />';
							$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
							//$content .= 'A Webinar named "'.$userInfo['webinar_title'].'" is scheduled for course named "'.$proName.'" in '.$configarr[0]['institute_name'].'.<br /><br />';
							//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
							$content .='If you need help or have any questions, please contact us. <br /><br />';
							$content .= '<br /><br />';
							$content .='...</p>';
							$content .= $configarr[0]['signature'].'</p>';
							//$content .= 'Best regards,<br /><br />';
							//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
							$data['content'] = $content; 
$data['fromemail'] = $urldomain;
							$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							
							//$message = '<a href="'.$link.'">Click on link to reset password</a>';
							//$fromemail='admin@createonlineacademy.com';
							$fromemail=$urldomain;    //$configarr[0]['fromemail'];		
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
				        
				        }
		   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Webinar Created Successfully' ));

			   redirect('webinars/listings/'.$proid);
		}

		
		$this->template->set('title', 'Create Webinar Meeting');

		$this->template->set('updType', 'create');

		$this->template->set('proid',$proid);		

		$this->load->helper('form');

		$this->load->library('form_validation');

		//$this->form_validation->set_rules('title','title', 'required');

		//$this->form_validation->set_rules('category_id', 'webinar', 'required');

        //$maxrow = $this->webinars_model->maxRow($proid);

		if ($this->form_validation->run() === FALSE)

		{
			//echo"yes";
			$this->template->build('webinars/create');

		}

		

	}
    //Function to upload images

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

		  $config['upload_path'] = 'public/uploads/webinars/img';

		  $config['allowed_types'] = 'gif|jpg|png';

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

                $config = array();

        		$config['image_library'] = 'gd2';

        		$config['source_image'] = FCPATH.'public/uploads/webinars/img/'.$data['file_name'];

        		$config['new_image'] = FCPATH.'public/uploads/webinars/img/thumb_232_216/'.$data['file_name'];

        		$config['create_thumb'] = TRUE;

        		$config['maintain_ratio'] = FALSE;

        		$config['master_dim'] = 'width';

                $config['width'] = 291;

                $config['height'] = 164;

               // $config['width'] = 232;

               // $config['height'] = 216;

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

         // echo $_FILES[$file_element_name];

		  @unlink($_FILES[$file_element_name]);

	   }

	   //echo 'success';

	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));

	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));

	}

  
     //Function to edit product webinar

	function edit2($sec_id = FALSE, $id = FALSE, $proid = FALSE)
	{
		$s_id = $this->uri->segment(4);	

		$dbname = $this->db->database;  
	 	$db_uname = substr($dbname,0,-7);
      	$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);  
	

        $sessionarray = $this->session->userdata('logged_in');

        $user_id = $sessionarray['id'];
		//load block submit helper and append in the head

		$this->template->append_metadata(block_submit_button());

		//Rules for validation

		$this->_set_rules('edit');

		//get the parent id and sanitize

		// $proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('proid', TRUE);
		$proid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : $this->input->post('proid', TRUE);

		$proid = ($proid != 0) ? filter_var($proid, FILTER_VALIDATE_INT) : NULL;



		//get the $id and sanitize

		// $id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('id', TRUE);
		$id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('id', TRUE);

	    $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;


		//redirect if it큦 no correct

		if (!$id){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('webinars/listings/'.$proid);

		}

		$this->template->title("Edit Course webinar");
		//$webinar = $this->webinars_model->getItems($id,$proid);
		$this->template->set('webinar', $this->webinars_model->getItems($id,$proid));

		$this->template->set('updType', 'edit');

		$this->template->set('proid', $proid);

		$this->template->set('id', $id);

		$this->form_validation->set_rules('title', 'title', 'required');
				//$class_data = $this->webinars_model->getItems($proid,$id);
		
		//$class_id = $class_data->wiziq_class_id;
		

        //$this->form_validation->set_rules('category_id', 'webinar', 'required');


			// build array for the model

            $form_data = array(

					       	'proid' => $this->input->post('proid', TRUE ),

					       	 'section_id' => $s_id,
					       					       
					       	'title' => $this->input->post('title', TRUE ),

					       	'type' => $this->input->post('type', TRUE ),

					       	'privacy' => $this->input->post('privacy', TRUE ),

					       	'fromdate' => $this->input->post('fromdate', TRUE ),

					       	'fromtime' => $this->input->post('fromtime', TRUE ),
					       	
					       	'web_duration' => $this->input->post('web_duration', TRUE ),

					       	'attendees_limit' => '',

					       	// 'todate' => $this->input->post('todate', TRUE ),

					       	// 'totime' => $this->input->post('totime', TRUE ),

					       	// 'allday' => ($this->input->post('allday', TRUE ))?1:0,

					       	// 'repeate' => $this->input->post('repeate', TRUE ),

					       	// 'untilldate' => $this->input->post('untilldate', TRUE ),

					       	// 'start_recording' => ($this->input->post('start_recording', TRUE ))?1:0,

					       	'status' => $this->input->post('status', TRUE ),

					       	'created_by' => $this->input->post('created_by', TRUE),

							'wiziq_class_id' => $this->input->post('class_id', TRUE),

							'time_zone' => $configarr[0]['time_zone'],
						);
        	
        			$this->session->set_userdata('sessionmsg',"flash run");
         	$web_data = $this->webinar_library->edit_webinar($form_data);
         	
         
			if($web_data['method'] != NULL || $web_data['modify'] == 'true')
        	 {
         		$webid = $this->input->post('id', TRUE);
         		 $set = $this->webinars_model->updateItem($webid,$form_data);
         	

    			// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// redirect('webinars/listings/'.$this->input->post('proid', TRUE ));
         		  $configarr = $this->settings_model->getItems();	

                $authorName = $this->webinars_model->getAuthorName($user_id); 

             
 

                  $proName = $this->webinars_model->getProgramName($proid);
                 

                   $authorEmail = $this->webinars_model->getAuthorEmail($user_id);

               

                  $userInfo = $this->session->all_userdata();



     //              	$urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
                  if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain'); 


                  //Email to teacher
                    $subject = "Webinar '".$userInfo['webinar_title']."' is Updated of The '".$proName."' Course";
					$toemail =  $authorEmail; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($authorName)).',<br /><br />';
					$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us. <br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .= 'Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
				    $message = $this->load->view('email_formates/admin_email_formate.php',$data,true);

				  
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;  //$configarr[0]['fromemail'];		
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
                    $subject = 'Webinar "'.$userInfo['webinar_title'].'" scheduled updated successfully for Course "'.$proName.'"';
					$toemail = $admininfo->email; // $teacher_email
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
					$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully upadate scheduled for course "'.$proName.'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
					//$content .= 'Webinar "'.$userInfo['webinar_title'].'" is successfully scheduled for course named "'.$proName.'" on '.$userInfo['fromdate'].' form '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					//$content .='Best regards,<br /><br />';
					//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content; 
$data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail=$urldomain;   //$configarr[0]['fromemail'];		
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
                        

                    $buyUsers = $this->programs_model->getBuyUsers($proid);

                   
				     
                   // for students
				        foreach ($buyUsers as $id) {

				        	$userEmail = $this->webinars_model->getAuthorEmail($id->userid);

				        	 $userName = $this->webinars_model->getAuthorName($id->userid); 

				        	$subject = 'Update  Webinar "'.$userInfo['webinar_title'].'" for the "'.$proName.'" Course';
							$toemail =  $userEmail; 
							
							$content = '';
							//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
							$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
							$content .= '<p>Dear '.trim(ucfirst($userName)).',<br /><br />';
							$content .= 'A Webinar "'.$userInfo['webinar_title'].'" is scheduled for "'.$proName.'" course in "'.$configarr[0]['institute_name'].'" on '.date("l, F j, Y", strtotime($userInfo['fromdate'])).' at '.$userInfo['fromtime'].' GMT.<br /><br />';
							//$content .= 'A Webinar named "'.$userInfo['webinar_title'].'" is scheduled for course named "'.$proName.'" in '.$configarr[0]['institute_name'].'.<br /><br />';
							//$content .=' The webinar is scheduled on '.$userInfo['fromdate'].' from '.$userInfo['fromtime'].' to '.$userInfo['totime'].'.<br /><br />';
							$content .='If you need help or have any questions, please contact us. <br /><br />';
							$content .= '<br /><br />';
							$content .='...</p>';
							$content .= $configarr[0]['signature'].'</p>';
							//$content .= 'Best regards,<br /><br />';
							//$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
							$data['content'] = $content; 
$data['fromemail'] = $urldomain;
							$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							
							//$message = '<a href="'.$link.'">Click on link to reset password</a>';
							//$fromemail='admin@createonlineacademy.com';
							$fromemail=$urldomain;    //$configarr[0]['fromemail'];		
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
				        
				        }
         		 echo "success";
  
        }
        else{
        	echo $web_data['errormsg'];
     //    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
			 	// redirect('webinars/listings/'.$this->input->post('proid', TRUE ));
     	}
	  	

	}
	function edit($sec_id = FALSE, $id = FALSE, $proid = FALSE)
	{	
		$s_id = $this->uri->segment(4);

		$dbname = $this->db->database;  
	 	$db_uname = substr($dbname,0,-7);
      	$configarr = $this->settings_model->getItems();
		$logoimage=$configarr[0]['logoimage'];
		$this->template->set("configarr", $configarr); 
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);  
	

		//load block submit helper and append in the head

		$this->template->append_metadata(block_submit_button());

		//Rules for validation

		$this->_set_rules('edit');

		//get the parent id and sanitize

		// $proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('proid', TRUE);
		$proid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : $this->input->post('proid', TRUE);

		$proid = ($proid != 0) ? filter_var($proid, FILTER_VALIDATE_INT) : NULL;



		//get the $id and sanitize

		// $id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('id', TRUE);
		$id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('id', TRUE);

	    $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;


		//redirect if it큦 no correct

		if (!$id){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('webinars/listings/'.$proid);

		}

		$this->template->title("Edit Course webinar");
		//$webinar = $this->webinars_model->getItems($id,$proid);
		$this->template->set('webinar', $this->webinars_model->getItems($id,$proid));
		
		$this->template->set('updType', 'edit');

		$this->template->set('proid', $proid);

		$this->template->set('id', $id);

		$this->form_validation->set_rules('title', 'title', 'required');

		//$class_data = $this->webinars_model->getItems($proid,$id);
		
		//$class_id = $class_data->wiziq_class_id;
		

        //$this->form_validation->set_rules('category_id', 'webinar', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed

		{

			//load the view and the layout

			$this->template->build('webinars/create');

		}

		else

		{

			// build array for the model

            $form_data = array(

					       	'proid' => $this->input->post('proid', TRUE ),
					       					       
					       	'title' => $this->input->post('title', TRUE ),

					       	'type' => $this->input->post('type', TRUE ),

					       	'privacy' => $this->input->post('privacy', TRUE ),

					       	'fromdate' => $this->input->post('fromdate', TRUE ),

					       	'fromtime' => $this->input->post('fromtime', TRUE ),
					       	
					       	'web_duration' => $this->input->post('web_duration', TRUE ),

					       	'attendees_limit' => '',

					       	// 'todate' => $this->input->post('todate', TRUE ),

					       	// 'totime' => $this->input->post('totime', TRUE ),

					       	// 'allday' => ($this->input->post('allday', TRUE ))?1:0,

					       	// 'repeate' => $this->input->post('repeate', TRUE ),

					       	// 'untilldate' => $this->input->post('untilldate', TRUE ),

					       	// 'start_recording' => ($this->input->post('start_recording', TRUE ))?1:0,

					       	'status' => $this->input->post('status', TRUE ),

					       	'created_by' => $this->input->post('created_by', TRUE),
							'wiziq_class_id' => $this->input->post('class_id', TRUE),

							'time_zone' => $configarr[0]['time_zone'],
						);
        	
        			$this->session->set_userdata('sessionmsg',"flash run");
         	$web_data = $this->webinar_library->edit_webinar($form_data);
         	
         	
         	if($web_data['method'] != NULL || $web_data['modify'] == 'true')
        	 {
         		$webid = $this->input->post('id', TRUE);
         		 $set = $this->webinars_model->updateItem($webid,$form_data);
         	

         		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('webinars/listings/'.$this->input->post('proid', TRUE ));
  
        }
        else{
        		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
			 	redirect('webinars/listings/'.$this->input->post('proid', TRUE ));
     	}

			// $isupdated=$this->webinars_model->updateItem($id,$form_data);

			// if ($isupdated) // the information has therefore been successfully saved in the db

			// {
			// 	require_once("WiZiQ/WiZiQ.Class/WiZiQService_update.php");
				
			// 	$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));

			// 	redirect('webinars/listings/'.$this->input->post('proid', TRUE ));

			// }



			// else{



			// 	//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );

			// 	redirect('webinars/listings/'.$this->input->post('proid', TRUE ));

			// }

	  	}

	}

	
	//Function to delete product webinar

	function delete($id = NULL, $proid = FALSE,$admin = NULL,$cname = NULL)

	{
		
		// $dbname = $this->db->database;  
	 // 	$db_uname = substr($dbname,0,-7);
		//filter & Sanitize $id
	 	$class_data = $this->webinars_model->getItems($proid,$id);

		//print_r($class_data); 
		$class_id = $class_data->wiziq_class_id;
		// echo $class_id;
		// exit('anisha');
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		$proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
		// echo $proid;
		// exit('jyoti');

		//redirect if it큦 no correct

		if (!$id){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			// redirect('webinars/');
			 if($admin == 'admin') redirect('admin/section-management/'.$proid);
				else redirect('sections-manage/'.$proid.'/'.$cname);

		}

		

		//search the item to delete

		/*

		if ( $this->webinars_model->getchildcount($id) )

		{

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This webinar can not be removed, because it contains either courses or sub webinars' ) );

			redirect('webinars/');

		}*/

		/*elseif ( $this->webinars_model->getchildcount($id) )

		{

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('webinars/');

		}

		*/

		

		//$isdelete=$this->webinars_model->deletewebinar($id);
		// echo $class_id; exit("claas");
		//print_r($isdelete);
		//delete the item

		
			//require_once("WiZiQ/WiZiQ.Class/WiZiQService_delete.php");
		// $flash_success="";
		// $flash_fail="";
			$web_data = $this->webinar_library->delete_webinar($class_id);


			if($web_data == 'ok')
			{ 
				$isdelete=$this->webinars_model->deletewebinar($id);
				$isdelete1=$this->webinars_model->deletewebinarLecture($id);
				 $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
				// redirect('webinars/listings/'.$proid);
				  if($admin == 'admin') redirect('admin/section-management/'.$proid);
				else redirect('sections-manage/'.$proid.'/'.$cname);


				// $flash_success = "Webinar Deleted.";
				// echo "
				// <script src='http://sorte.createonlineacademy.com/public/Session_Plugin_master/jquery.session.js'></script>
				
				// <script>
				// $.session.set('some key', 'a value');
				// document.location.href='webinars/listings/".$proid."'</script>";
				//echo "<script>document.location.href='../../webinars/listings/".$proid."'</script>";
			}
			else
			{
				$flash_fail = "Fail to delete, Session will be expired.";
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
				// redirect('webinars/listings/'.$proid);
				 if($admin == 'admin') redirect('admin/section-management/'.$proid);
				else redirect('sections-manage/'.$proid.'/'.$cname);
			 }	

			// if(!empty($flash_success))
			// {
			// 	$this->template->set('flash',$flash_success);
			// }
			// else if(!empty($flash_fail))
			// {
			// 	$this->template->set('flash',$flash_fail);
			// }

		//if ($webinar->category_id)

		//redirect('webinars/'.$webinar->category_id);

		//else

			//redirect('webinars/listings/'.$proid);

	}

// delete webinar
	function delete2($id = NULL, $proid = FALSE,$admin = NULL,$cname = NULL)

	{
		
		// $dbname = $this->db->database;  
	 // 	$db_uname = substr($dbname,0,-7);
		//filter & Sanitize $id
	 	$class_data = $this->webinars_model->getItems($proid,$id);

		//print_r($class_data); 
		$class_id = $class_data->wiziq_class_id;
		// echo $class_id;
		// exit('anisha');
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		$proid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;
		//echo $proid;
		//exit('anisha');

		//redirect if it큦 no correct

		if (!$id){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			// redirect('webinars/');
			if($admin == 'admin') redirect('admin/section-management/'.$proid);
				else redirect('sections-manage/'.$proid.'/'.$cname);

		}
		else{
				$isdelete=$this->webinars_model->deletewebinar($id);
				$isdelete1=$this->webinars_model->deletewebinarLecture($id);
				if($isdelete)
				{
				 $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
				// redirect('webinars/listings/'.$proid);
				 if($admin == 'admin') redirect('admin/section-management/'.$proid);
				else redirect('sections-manage/'.$proid.'/'.$cname);
				}
				else {
				 $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_failed') ));	
				// redirect('webinars/listings/'.$proid);
				  if($admin == 'admin') redirect('admin/section-management/'.$proid);
				else redirect('sections-manage/'.$proid.'/'.$cname);
				}
		}

	}

   	/*Function to publish the quiz*/

	public function publish($qid = FALSE)
	{

	$qid = ($this->uri->segment(3) != 0) ? filter_var($this->uri->segment(3), FILTER_VALIDATE_INT) : NULL;

	$proid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$qid)
		{

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('webinars/');

		}

		else
		{

				$upd_data = array(

					'status' => 'active'

				);

				$in_ids = $qid;

				$publish=$this->webinars_model->publish_unpublishItem($in_ids,$upd_data);



				//Publish the item

				if ($publish)

				{

					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course webinar published successfully!' ));

				}

				else

				{

					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course webinar publish action fail or already published!' ) );

				}

				redirect('webinars/listings/'.$proid);
		}

	}



	/*Function to unpublish the quiz*/

	public function unpublish($qid = FALSE){

		$qid = ($this->uri->segment(3) != 0) ? filter_var($this->uri->segment(3), FILTER_VALIDATE_INT) : NULL;

		$proid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$qid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('webinars/');

			}

		else{

				$upd_data = array(

					'status' => 'deactive'

				);

				$in_ids = $qid;

				$unpublish=$this->webinars_model->publish_unpublishItem($in_ids,$upd_data);



				//Publish the item

				if ($unpublish)

				{

					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course webinar unpublished successfully!' ));

				}

				else

				{

					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course webinar unpublish action fail or already unpublished!' ) );

				}

				redirect('webinars/listings/'.$proid);



			}

	}
	function submitPage()
	{
		//print_r($_POST);

		   //$maxrow = $this->webinars_model->maxRow($proid);

           $orderingval = 0;

		  // $orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;

           $this->session->set_userdata('fromdate', $this->input->post('fromdate', TRUE ));
	        $this->session->set_userdata('fromtime', $this->input->post('fromtime', TRUE ));
	        $this->session->set_userdata('totime', $this->input->post('totime', TRUE ));
	          $this->session->set_userdata('webinar_title', $this->input->post('title', TRUE ));



           $data = array(

					       	'proid' => $this->input->post('proid', TRUE ),

					       	'title' => $this->input->post('title', TRUE ),

					       	'type' => $this->input->post('type', TRUE ),

					       	'privacy' => $this->input->post('privacy', TRUE ),

					       	'fromdate' => $this->input->post('fromdate', TRUE ),

					       	'fromtime' => $this->input->post('fromtime', TRUE ),

					       	'todate' => $this->input->post('todate', TRUE ),

					       	'totime' => $this->input->post('totime', TRUE ),

					       	'allday' => ($this->input->post('allday', TRUE ))?1:0,

					       	'repeate' => $this->input->post('repeate', TRUE ),

					       	'untilldate' => $this->input->post('untilldate', TRUE ),

					       	'start_recording' => ($this->input->post('start_recording', TRUE ))?1:0,

					       	'status' => $this->input->post('status', TRUE ),
							
							'created_by' => $user_id,
							
							'creator_email' => $email_id

						); 
          // print_r($data);
						
				
                      //  $webinar_id = $this->webinars_model->insertItems($data);	
					//	$data2 = array ('webinar_new_id' => $webinar_id);
					//	$data = array_merge($data, $data2);

						require_once("WiZiQ/WiZiQ.Class/WiZiQService.php");
						
						
  		   
                           
    	                   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
    	                   	//exit('anisha');	
    	                   redirect('webinars/listings/'.$this->input->post('proid', TRUE ));
						
						
						
           

		}

}