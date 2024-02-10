<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// header('X-Frame-Options: DENY');
// header('X-Frame-Options: SAMEORIGIN');
class Tasks extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_loggedin'
		//'except' => array('index')
		//'only' => array('index')
	);

	function __construct()
	{
		parent::__construct();
		$this->authenticate();
		$this->load->model('admin/tasks_model');
        //$this->load->helper('form');
         $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('ckeditor');
        $this->lang->load('tooltip', 'english');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';

        $this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		date_default_timezone_set($configarr[0]['time_zone']);
		// error_reporting(0);
       // $this->output->clear_all_cache();
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
	{ 	//echo 'ssss'.$parent_id;exit;
	$this->template->set_layout('backend');
	$this->template->title('Modules List');
			$parent_id = ($parent_id) ? $parent_id : 0 ;
			if($parent_id!=0){
			//$program = $this->days_model->getProgram($parent_id);
			//$this->template->set("program", $program);
		}
		//$this->template->set("days", $this->days_model->getlistDays($parent_id));
		//$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	//$this->template->build('admin/days/list');
	}
	function layoutstructure()
	{	$layoutstructure = array();
		$layoutstructure[] = (object) array('id'=> '1', 'scr_m' => '1', 'scr_t' => '1');
		$layoutstructure[] = (object) array('id'=> '2', 'scr_m' => '2,3', 'scr_t' => '2');
		$layoutstructure[] = (object) array('id'=> '3', 'scr_m' => '4', 'scr_t' => '3');
		$layoutstructure[] = (object) array('id'=> '4', 'scr_m' => '5,6', 'scr_t' => '4');
		$layoutstructure[] = (object) array('id'=> '5', 'scr_m' => '', 'scr_t' => '5');
		$layoutstructure[] = (object) array('id'=> '6', 'scr_m' => '7', 'scr_t' => '');
		$layoutstructure[] = (object) array('id'=> '7', 'scr_m' => '8', 'scr_t' => '6');
		$layoutstructure[] = (object) array('id'=> '8', 'scr_m' => '9,10', 'scr_t' => '7');
		$layoutstructure[] = (object) array('id'=> '9', 'scr_m' => '11', 'scr_t' => '8');
		$layoutstructure[] = (object) array('id'=> '10', 'scr_m' => '12,13', 'scr_t' => '9');
		$layoutstructure[] = (object) array('id'=> '11', 'scr_m' => '14', 'scr_t' => '10,11');
		$layoutstructure[] = (object) array('id'=> '12', 'scr_m' => '15', 'scr_t' => '');
		return $layoutstructure;
	}

	function create($did = false ,$pid = false)
	{
	    //print_r($_POST);exit;
		$this->template->set_layout('backend');
		$this->template->title("Create Lecture");

		$this->template->append_metadata(block_submit_button());
		$pid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('pid', TRUE);
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;
		$did = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('did', TRUE);
		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;
		$this->template->set('title', 'Create Lesson');
		$this->template->set('updType', 'create');
		$this->template->set('pid',$pid);
		$this->template->set('did',$did);
		 $u_data = $this->session->userdata('loggedin');


		$loadImageMedia =$this->tasks_model->loadImageMediaLibrary($u_data['id']);
		$loadVideoMedia =$this->tasks_model->loadVideoMediaLibrary($u_data['id']);
		$loadpdfMedia = $this->tasks_model->loadpdfMediaLibrary($u_data['id']);
		$loadaudioMedia = $this->tasks_model->loadaudioMediaLibrary($u_data['id']);
		$loadflashMedia = $this->tasks_model->loadflashMediaLibrary($u_data['id']);
		$loadtemplates = $this->tasks_model->loadtemplatesList($u_data['id']);

		$this->template->set('loadVideo',$loadVideoMedia);
		$this->template->set('loadImage',$loadImageMedia);
		$this->template->set('loadPdf',$loadpdfMedia);
		$this->template->set('loadAudio',$loadaudioMedia);
		$this->template->set('loadflash',$loadflashMedia);
		$this->template->set('templatelist',$loadtemplates);
	  	//$this->load->helper('form');
		//$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('step_access', 'step access', 'required');
		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');

		if ($this->form_validation->run() === false)
		{
			$this->template->build('admin/tasks/create');
		}
		else
		{

		}
	}

	function test_popup()
	{
		$this->load->view('admin/tasks/popuppage');
	}


	function lecture_popup($did = NULL, $pid = NULL)
	{
			$data = array('updType' => 'create',
			'pid' => $pid,
			'did' => $did,
		 );
		$this->load->view('admin/tasks/create_popup', $data);
	}

	function quiz_popup($did = NULL, $pid = NULL)
	{
			$data = array('updType' => 'create',
			'pid' => $pid,
			'did' => $did,
		 );
		$this->load->view('admin/tasks/quiz_popup', $data);
	}

	public function inform()
	{
		$pro_id = $this->uri->segment(4);
		$sec_id = $this->uri->segment(5);
		$lec_id = $this->uri->segment(6);

	    $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];

         $this->template->set('pro_id', $pro_id);
         $this->template->set('sec_id', $sec_id);
         $this->template->set('lec_id', $lec_id);

		$this->template->append_metadata(block_submit_button());

		$this->load->helper('form');
		$this->load->library('form_validation');


	    $this->template->build('admin/tasks/inform');


	}

	function inform_students($pro_id,$sec_id,$lec_id)
	{


        $inform_message = $this->input->post('inform_message');


        $this->load->model('admin/settings_model');
        $this->load->model('admin/programs_model');


         $pro_name = $this->programs_model->getProgramName($pro_id);

         $lecture_name = $this->programs_model->getLectureName($lec_id);

        $user_ids = $this->programs_model->getBuyUsers($pro_id);

         $authorid = $this->programs_model->getAuthorId($pro_id);
         $trainerData = $this->programs_model->getUserInfo($authorid);

         $configarr = $this->settings_model->getItems();

       foreach($user_ids as $id)
       {
       	   $userdata = $this->programs_model->getUserInfo($id->userid);

     //   	   	 		$urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
       	   if($configarr[0]['fromemail'])
        $urldomain = $configarr[0]['fromemail'];
        else $urldomain = $this->config->item('urldomain');

       	            $subject = 'Lecture "'.$lecture_name.'" under Course "'.$pro_name.'" is modified by Admin';
					$toemail =  $userdata->email; // $teacher_email

					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($userdata->first_name)).',<br /><br />';
					$content .= 'This is notify that there are few updates made to the Lecture "'.$lecture_name.'" in Course "'.$pro_name.'" by the Admin<br /><br />';
					$content .= 'Message from the instructor about the updates is given below:<br /><br />';
					$content .=  $inform_message.'<br /><br />';
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
					$fromemail= $urldomain;    //$configarr[0]['fromemail'];
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

              //Email to Trainer
     //               $urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
       				if($configarr[0]['fromemail'])
        $urldomain = $configarr[0]['fromemail'];
        else $urldomain = $this->config->item('urldomain');

                   $subject = 'Lecture "'.$lecture_name.'" under Course "'.$pro_name.'" is modified by Admin';
					$toemail =  $trainerData->email; // $teacher_email

					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($trainerData->first_name)).',<br /><br />';
					$content .= 'This is notify that there are few updates made to the Lecture "'.$lecture_name.'" in Course "'.$pro_name.'" by the Admin<br /><br />';
					$content .= 'Message from the instructor about the updates is given below:<br /><br />';
					$content .=  $inform_message.'<br /><br />';
					$content .= 'If you need help or have any questions, please contact us. <br /><br />';
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
					$fromemail= $urldomain;    //$configarr[0]['fromemail'];
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

		function edit($tid = true ,$did = true ,$pid = true)
	{

		$this->template->set_layout('backend');
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
		//$this->load->helper('form');
		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		$pid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : $this->input->post('pid', TRUE);
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;

		$did = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('did', TRUE);
		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;

		//get the $tid and sanitize
		$tid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		$tid = ($tid != 0) ? filter_var($tid, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s not correct
		if (!$tid)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/section-management/'.$pid);
		}
		$this->template->title("Edit Lecture");
		$this->template->set('db_media', $this->tasks_model->getMedia_oflayout('scr_m',$tid));
		$this->template->set('db_mediatext', $this->tasks_model->getMedia_oflayout('scr_t',$tid));
		$mediajumpids = $this->tasks_model->getMedia_oflayout('jump',$tid);
		foreach($mediajumpids as $mediajumpid){
		$jumpbut = $this->tasks_model->getJumpbutton($mediajumpid->media_id);
		$jumpbut = $jumpbut->button;
		$this->template->set('jump_but'.$jumpbut, $this->tasks_model->getJumpbutton($mediajumpid->media_id));
		}
		$this->template->set('task', $this->tasks_model->getLessonedit($tid,$did,$pid));
		$this->template->set('jmpbuttoninfo', $this->tasks_model->getMedia_oflayout('jump',$tid));
		$this->template->set('updType', 'edit');
		$this->template->set('pid', $pid);
		$this->template->set('did', $did);
		$this->template->set('tid', $tid);

		$this->template->set('dripstatus',$this->tasks_model->getDripstatus($pid));

		$u_data = $this->session->userdata('loggedin');
		$loadtemplates = $this->tasks_model->loadtemplatesList($u_data['id']);
		$this->template->set('templatelist',$loadtemplates);

        $this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('step_access', 'step access', 'required');
		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/tasks/edit_lecture');
		}
		else
		{
			$is_exam = $this->input->post('db_media_15');


			$txt = $this->input->post('txt_content_val');
            $txtcontent = $this->input->post('txt_content'.$txt) ? $this->input->post('txt_content'.$txt):"";
            $lec_content = $this->input->post('lec_content1') ? $this->input->post('lec_content1'):$this->input->post('lec_content');

			$alias = ($this->input->post('name'))?$this->input->post('name'):$this->input->post('name');
            $form_data = array(
				'name' => $this->input->post('name'),
				'alias' => $alias,
				'difficultylevel' => $this->input->post('difficultylevel'),
				'content' => $lec_content,
				'metatitle' => $this->input->post('title'),
				'metakwd' => $this->input->post('key_description'),
				'metadesc' => $this->input->post('description'),
				//'step_access' => $this->input->post('step_access'),
				'startpublish' => $this->input->post('startpublish'),
				'endpublish' => $this->input->post('endpublish'),
				'published' => $this->input->post('published'),
				//'ordering' => $this->tasks_model->maxorder()
				'is_exam'=>$is_exam,
				// 'release_date' => $release_date,
				'txt_content' => $txtcontent
			);


            /*$form_data = array(
				'name' => $this->input->post('name'),
				'alias' => $alias,
				'step_access' => $this->input->post('step_access'),
				'published' => $this->input->post('published')
			);*/

			 $typeid=$this->input->post('layout_db');


				if(isset($typeid)){
					$medrel_data = array(
						'media_id' => $this->input->post('layout_db')
					);

					$this->tasks_model->updateMediarel($tid,0,$medrel_data,'scr_l');
					$layoutstructure = self::layoutstructure();

						$i=0;
						foreach($layoutstructure as $layout){
							$i++;
							$layoutvalarr = array();
							$layoutvalarr = explode(',',$layout->scr_m);
							if($layout->scr_m!=''){
							for($m = 0;$m < count($layoutvalarr);$m++){
							$mediamedia = $this->input->post('db_media_'.$layoutvalarr[$m]);

								$datamedia = array(
								'media_id' => $mediamedia
								);
							$this->tasks_model->updateMediarel($tid,$layoutvalarr[$m],$datamedia,'scr_m');

								}
							}
							$textlayoutarr = array();
							$textlayoutarr = explode(',',$layout->scr_t);
							if($layout->scr_t!=''){
							for($t = 0;$t < count($textlayoutarr);$t++){
							$mediatext = $this->input->post('db_text_'.$textlayoutarr[$t]);
								$datatext = array(
								'media_id' => $mediatext
								);
							$this->tasks_model->updateMediarel($tid,$textlayoutarr[$t],$datatext,'scr_t');
								}
							}
						}


				}
				$this->tasks_model->deleteJumprel('jump',$tid);
				//$countjmpbut = count($jmpbutinfo);
				//$ispresent = array();
				//foreach($jmpbutinfo as $jmpbut ){
				//$ispresent[] = $jmpbut->media_id;
				//}
				//if($countjmpbut < 4):
							for($ji = 1; $ji <= 4; $ji++){
							$jumpbutval = 'jumpbutval'.$ji;
							$$jumpbutval = $this->input->post('jumpbutton'.$ji);
							if($$jumpbutval != 0){
								$datajump = array(
									'type' => 'jump',
									'type_id' => $tid,
									'media_id' => $$jumpbutval
									);
								$this->tasks_model->insertItemsRel($datajump);
								}
							}
				//endif;
				$isupdated=$this->tasks_model->updateItem($tid,$form_data);
				$this->tasks_model->updatetaskcount($pid);

				echo $isupdated;
			if($isupdated)
			{
				if($this->input->post('inform_msg') != '')
		            {

		            	$this->inform_students($p_id,$section_id,$lec_id);
		            }
			}
			//
		}
	}

	function delete_jumpbutton()
	{

            $jump_button_id = $this->input->post('jump_button_id');

            $this->load->model('admin/tasks_model');

            $deleted1 = $this->tasks_model->deleteButton($jump_button_id);

            if($deleted1)
            {
            	$deleted2 = $this->tasks_model->deleteJumprel('jump',$jump_button_id);

            	 if($deleted2)
		           {
		           	 echo 'success';
		           }
            }


	}

	function delete($tid = true ,$did = true ,$pid = true)
	{
		$tid = ($tid != 0) ? filter_var($tid, FILTER_VALIDATE_INT) : NULL;
		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;

		if (!$tid){
			echo lang('web_object_not_exit');

		}

		else{
			$isdelete=$this->tasks_model->deleteItemNew($tid);
	        $this->tasks_model->updatetaskcount($pid);

			if ($isdelete)
			{
				echo "success";
			}
			else
			{
				echo lang('web_delete_failed');
			}
		}
	}

	function quiz($did = false ,$pid = false)
	{
	    //print_r($_POST);exit;
		$this->template->set_layout('backend');
		$this->template->title("Create Exam");
		$this->template->append_metadata(block_submit_button());
		$pid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('pid', TRUE);
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;
		$did = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('did', TRUE);
		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;
		$this->template->set('title', 'Create Lesson');//lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('pid',$pid);
		$this->template->set('did',$did);
	  	//$this->load->helper('form');
		//$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('step_access', 'step access', 'required');
		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');

		if ($this->form_validation->run() === false)
		{
			$this->template->build('admin/days/quiz');
		}
		else
		{

			$alias = ($this->input->post('name'))?$this->input->post('name'):$this->input->post('name');
			$data = array(
				'name' => $this->input->post('name'),
				'alias' => $alias,
				'difficultylevel' => $this->input->post('difficultylevel'),
				//'metatitle' => '',
				//'metakwd' => '',
				//'metadesc' => '',
				//'step_access' => $this->input->post('step_access'),
				//'startpublish' => $this->input->post('startpublish'),
				//'endpublish' => $this->input->post('endpublish'),
				'published' => $this->input->post('published'),
				'endpublish' => date('Y-m-d h:i:s'),
				'startpublish' => date('Y-m-d h:i:s'),
				'ordering' => $this->tasks_model->maxorder()
			);

			$tid=$this->tasks_model->insertItems($pid,$data);
				if($tid)
				{
					$data = array(
					'type' => 'scr_l',
					'type_id' => $tid,
					'media_id' => $this->input->post('layout_db')
					);
					if($this->tasks_model->insertItemsRel($data))
					{
						$data = array(
						'type' => 'dtask',
						'type_id' => $did,
						'media_id' => $tid
						);
						$istaskrelinsert = $this->tasks_model->insertItemsRel($data);



						if($istaskrelinsert)
						{
						$layoutstructure = self::layoutstructure();
						/*echo '<pre>';
						print_r($layoutstructure);
						echo '</pre>';*/
						$i=0;
						foreach($layoutstructure as $layout){
							$i++;
							$layoutvalarr = array();
							$layoutvalarr = explode(',',$layout->scr_m);
							if($layout->scr_m!=''){
							for($m = 0;$m < count($layoutvalarr);$m++){
							$mediamedia = $this->input->post('db_media_'.$layoutvalarr[$m]);

								$datamedia = array(
								'type' => 'scr_m',
								'type_id' => $tid,
								'media_id' => $mediamedia,
								'layout' => $layoutvalarr[$m]
								);
							$this->tasks_model->insertItemsRel($datamedia);
								}
							}
							$textlayoutarr = array();
							$textlayoutarr = explode(',',$layout->scr_t);
							if($layout->scr_t!=''){
							for($t = 0;$t < count($textlayoutarr);$t++){
							$mediatext = $this->input->post('db_text_'.$textlayoutarr[$t]);
								$datatext = array(
								'type' => 'scr_t',
								'type_id' => $tid,
								'media_id' => $mediatext,
								'layout' => $textlayoutarr[$t]
								);
							$this->tasks_model->insertItemsRel($datatext);
								}
							}
						}
							for($ji=1;$ji<=4;$ji++){
							$jumpbutval = 'jumpbutval'.$ji;
							$$jumpbutval = $this->input->post('jumpbutton'.$ji);
							if($$jumpbutval != 0){
								$datajump = array(
									'type' => 'jump',
									'type_id' => $tid,
									'media_id' => $$jumpbutval
									);
								$this->tasks_model->insertItemsRel($datajump);
								}
							}
							$this->tasks_model->updatetaskcount($pid);
							$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
							?><script type="text/javascript">
							window.parent.location.href = "<?php echo base_url(); ?>/admin/section-management/<?php echo $pid?>";
							</script><?php
						}
					}
				}

		}
	}


	function quizedit($tid = true ,$did = true ,$pid = true)
	{

		$this->template->set_layout('backend');
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
		//$this->load->helper('form');
		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		$pid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : $this->input->post('pid', TRUE);
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;

		$did = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('did', TRUE);
		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;

		//get the $tid and sanitize
		$tid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		$tid = ($tid != 0) ? filter_var($tid, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s not correct
		if (!$tid)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/section-management/'.$pid);
		}
		$this->template->title("Edit Exam");
		$this->template->set('db_media', $this->tasks_model->getMedia_oflayout('scr_m',$tid));
		$this->template->set('db_mediatext', $this->tasks_model->getMedia_oflayout('scr_t',$tid));
		$mediajumpids = $this->tasks_model->getMedia_oflayout('jump',$tid);
		foreach($mediajumpids as $mediajumpid){
		$jumpbut = $this->tasks_model->getJumpbutton($mediajumpid->media_id);
		$jumpbut = $jumpbut->button;
		$this->template->set('jump_but'.$jumpbut, $this->tasks_model->getJumpbutton($mediajumpid->media_id));
		}
		$this->template->set('task', $this->tasks_model->getLessonedit($tid,$did,$pid));
		$this->template->set('jmpbuttoninfo', $this->tasks_model->getMedia_oflayout('jump',$tid));
		$this->template->set('updType', 'edit');
		$this->template->set('pid', $pid);
		$this->template->set('did', $did);
		$this->template->set('tid', $tid);
		$this->template->set('dripstatus',$this->tasks_model->getDripstatus($pid));

        $this->form_validation->set_rules('name', 'name', 'required');
		//$this->form_validation->set_rules('step_access', 'step access', 'required');
		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			// $this->template->build('admin/days/quiz');
			$this->template->build('admin/tasks/edit_quiz');
		}
		else
		{
			$alias = ($this->input->post('name'))?$this->input->post('name'):$this->input->post('name');
            $form_data = array(
				'name' => $this->input->post('name'),
				//'alias' => $alias,
				'difficultylevel' => $this->input->post('difficultylevel'),
				'metatitle' => $this->input->post('title'),
				'metakwd' => $this->input->post('key_description'),
				'metadesc' => $this->input->post('description'),
				//'step_access' => $this->input->post('step_access'),
				'startpublish' => $this->input->post('startpublish'),
				'endpublish' => $this->input->post('endpublish'),
				'published' => $this->input->post('published'),
				//'ordering' => $this->tasks_model->maxorder()
			);


            /*$form_data = array(
				'name' => $this->input->post('name'),
				'alias' => $alias,
				'step_access' => $this->input->post('step_access'),
				'published' => $this->input->post('published')
			);*/

			 $typeid=$this->input->post('layout_db');


				if(isset($typeid)){
					$medrel_data = array(
						'media_id' => $this->input->post('layout_db')
					);

					$this->tasks_model->updateMediarel($tid,0,$medrel_data,'scr_l');
					$layoutstructure = self::layoutstructure();

						$i=0;
						foreach($layoutstructure as $layout){
							$i++;
							$layoutvalarr = array();
							$layoutvalarr = explode(',',$layout->scr_m);
							if($layout->scr_m!=''){
							for($m = 0;$m < count($layoutvalarr);$m++){
							$mediamedia = $this->input->post('db_media_'.$layoutvalarr[$m]);

								$datamedia = array(
								'media_id' => $mediamedia
								);
							$this->tasks_model->updateMediarel($tid,$layoutvalarr[$m],$datamedia,'scr_m');

								}
							}
							$textlayoutarr = array();
							$textlayoutarr = explode(',',$layout->scr_t);
							if($layout->scr_t!=''){
							for($t = 0;$t < count($textlayoutarr);$t++){
							$mediatext = $this->input->post('db_text_'.$textlayoutarr[$t]);
								$datatext = array(
								'media_id' => $mediatext
								);
							$this->tasks_model->updateMediarel($tid,$textlayoutarr[$t],$datatext,'scr_t');
								}
							}
						}


				}
				$this->tasks_model->deleteJumprel('jump',$tid);
				//$countjmpbut = count($jmpbutinfo);
				//$ispresent = array();
				//foreach($jmpbutinfo as $jmpbut ){
				//$ispresent[] = $jmpbut->media_id;
				//}
				//if($countjmpbut < 4):
							for($ji = 1; $ji <= 4; $ji++){
							$jumpbutval = 'jumpbutval'.$ji;
							$$jumpbutval = $this->input->post('jumpbutton'.$ji);
							if($$jumpbutval != 0){
								$datajump = array(
									'type' => 'jump',
									'type_id' => $tid,
									'media_id' => $$jumpbutval
									);
								$this->tasks_model->insertItemsRel($datajump);
								}
							}
				//endif;
				$isupdated=$this->tasks_model->updateItem($tid,$form_data);
				$this->tasks_model->updatetaskcount($pid);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				?><script type="text/javascript">
				//parent.jQuery.fancybox.close();
				window.parent.location.href = "<?php echo base_url(); ?>/admin/section-management/<?php echo $pid?>";
				</script><?php
				//redirect('admin/days/'.$pid);
			}
			else{
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				?><script type="text/javascript">
				//parent.jQuery.fancybox.close();
				window.parent.location.href = "<?php echo base_url(); ?>/admin/section-management/<?php echo $pid?>";
				</script><?php
				//redirect('admin/days/'.$pid);
			}
	  	}
	}



	public function getImage()
	{
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file';
	   if(empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/default/images';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  $config['max_size']  = 1024 * 100;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['orig_name'];
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
        		$config['source_image'] = base_url().'public/default/images/'.$data['file_name'];
        		$config['new_image'] =  FCPATH.'public/default/images/'.$data['file_name'];
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

				//$this->image_lib->resize();
				// if ( ! $this->image_lib->crop())
				// {
				//    echo $this->image_lib->display_errors();
				// }

                //$this->load->library('md_image');
                //$config = array();
                /*$this->load->library('upload', $config);
		        $source=FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
		        $width=250;
		        $height=140;
		        $size = getimagesize($source);
		        $resize_height=($size[1]*250)/$size[0];
		        $dest = FALSE;
	            $config['image_library'] = 'gd2';//imagemagik
	            //$config['source_image'] = 'assets/img/hotellist/'.$data1['hotel_pictures'];
	            $config['source_image'] = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
	            $config['create_thumb'] = FALSE;
	            $config['maintain_ratio'] = TRUE;
	            $config['width']     = 250;
	            $config['height']   = $resize_height;
	            //$config['height']   = 141;
	            $config['quality']   = 75;
	            $config['encrypt_name'] = TRUE;
	            $config['remove_spaces'] = TRUE;
	            $img =$config['source_image'];
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();*/
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
	    echo json_encode(array('filelink' => $config['source_image']));
	}

	function set_lecture_preview()
	{

		// if($this->session->userdata('lecture_preview'))
		// {
		// 	//echo"sachin";
		// $this->session->unset_userdata('lecture_preview');
	 //    }
		 // $first_media =$_POST['first_media'];
		 // $second_media =$_POST['second_media'];
		 // $txt_content =$_POST['txt_content'];
		 $layoutno =$_POST['txt_content_val'];
		 // $lec_content =$_POST['lec_content'];
		 // $lec_content1 =$_POST['lec_content1'];

		   //$this->session->set_userdata('lecture_preview',$layoutno);
		   //$previewData = $this->session->userdata('lecture_preview');

		  $data = array(
						//'first_media' => $first_media,
						//'second_media' => $second_media,
						//'txt_content' => $txt_content,
						'layoutno'=>$layoutno,
						//'txt_lec_content'=>$lec_content,
						//'txt_lec_content1'=>$lec_content1
						);

				$this->session->set_userdata('lecture_preview',$data);

		if($this->session->userdata('lecture_preview'))
		{
			$previewData = $this->session->userdata('lecture_preview');

		}
		 echo"<pre>";
		 print_r($previewData);
		 echo"</pre>";


	}

	function lecture_preview()
	{
		$previewData['previewData1'] = $this->session->userdata('lecture_preview');

        $this->load->view('admin/tasks/lecture_preview',$previewData);
        //$this->load->view('admin/tasks/lecture_preview');
	}


	function upload_media()
    {
    	$insertid = 0;
    	$newfilename =0;
    	$media_type = $_POST['media_type'];

    	if($media_type =='Image')
    	{
		$output_dir = FCPATH."public/uploads/images/";
		$whitelist = array('jpg', 'jpeg', 'png', 'gif');
		}
		else if($media_type =='Video')
		{
		$output_dir = FCPATH."public/uploads/videos/";
		$whitelist = array('mp4', 'avi');
		}
		else if($media_type =='Document')
		{
		$output_dir = FCPATH."public/uploads/documents/";
		$whitelist = array('pdf', 'docx', 'dotx', 'ppt', 'doc', 'txt');
		}
		else if($media_type =='Audio')
		{
		$output_dir = FCPATH."public/uploads/videos/";
		$whitelist = array('mpeg', 'mp3');
		}
		else if($media_type =='Flash')
		{
		$output_dir = FCPATH."public/uploads/videos/";
		$whitelist = array('swf');
		}
					$name      = null;
					$error     = 'No file uploaded.';
// print_r($_FILES);
					if(isset($_FILES)) {
						if(isset($_FILES['file_i'])) {
							$tmp_name = $_FILES['file_i']['tmp_name'];
							$name     = basename($_FILES['file_i']['name']);
							$newfilename = basename($_FILES['file_i']['name']);
							$error    = $_FILES['file_i']['error'];
						   $file_type = $_FILES['file_i']['type'];

							if ($error === UPLOAD_ERR_OK) {
								$extension = pathinfo($name, PATHINFO_EXTENSION);

								if (!in_array($extension, $whitelist)) {
									$error = 'Invalid file type uploaded.';
								} else {
									//move_uploaded_file($tmp_name, $name);
									$date = date('d');
							  		$month = date('m');
							  		$year = date('Y');
							  		$random_no = rand(1000,5000);
							  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;

							  		$temp = explode(".", $_FILES["file_i"]["name"]);
									$newfilename = round(microtime(true)).'-'.$generate.'.'.end($temp);
							  		move_uploaded_file($tmp_name,$output_dir.$newfilename);
							  		// if($media_type =='Video'){

			// 				  			$newfilename_new = 'new_'.$newfilename;
			// 				  			$new_dir = base_url()."public/uploads/thmb_img/";
			// 	exec(base_url()."public/uploads/thmb_img/ffmpeg -i ".$new_dir."  -vcodec libx264 ".$newfilename_new);
			// 	$newfilename_img = 'img_'.$newfilename;
		 // exec(base_url().'public/uploads/thmb_img/ffmpeg -i '.$new_dir.' -f mjpeg -vframes 2 -s 150x150 -an '.$newfilename_img);
// exit('me22');

							  		// }
									//move_uploaded_file($tmp_name,$output_dir.$_FILES["file_i"]["name"]);
								$insertid = $this->Save_media_data($newfilename);
								}
							}
						}
					}



					echo json_encode(array(
						'name'  => $newfilename,
						'error' => $error,
						'rowid' =>$insertid,
					));
					die();

    }

    function multi_upload_media()
    {
    	$insertid1[] = array();
    	$newfilename1[] =array();
    	$media_type = $_POST['media_type'];

    	if($media_type =='Image')
    	{
		$output_dir = FCPATH."public/uploads/images/";
		$whitelist = array('jpg', 'jpeg', 'png', 'gif');
		}

					$name      = null;
					$error     = 'No file uploaded.';

					if(isset($_FILES)) {
						if(isset($_FILES['file_i'])) {

						foreach($_FILES['file_i']['tmp_name'] as $key => $tmp_name ){

									$tmp_name =$_FILES['file_i']['tmp_name'][$key];
									$name = basename($_FILES['file_i']['name'][$key]);
									$newfilename = basename($_FILES['file_i']['name'][$key]);
									$file_size =$_FILES['file_i']['size'][$key];
									$file_type=$_FILES['file_i']['type'][$key];
									$error    = $_FILES['file_i']['error'][$key];



							// $tmp_name = $_FILES['file_i']['tmp_name'];
							// $name     = basename($_FILES['file_i']['name']);
							// $newfilename = basename($_FILES['file_i']['name']);
							// $error    = $_FILES['file_i']['error'];
						 //   $file_type = $_FILES['file_i']['type'];

							if ($error === UPLOAD_ERR_OK) {
								$extension = pathinfo($name, PATHINFO_EXTENSION);

								if (!in_array($extension, $whitelist)) {
									$error = 'Invalid file type uploaded.';
								} else {
									//move_uploaded_file($tmp_name, $name);
									$date = date('d');
							  		$month = date('m');
							  		$year = date('Y');
							  		$random_no = rand(1000,5000);
							  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;

							  		$temp = explode(".", $_FILES["file_i"]["name"][$key]);
									$newfilename = round(microtime(true)).'-'.$generate.'.'.end($temp);
							  		move_uploaded_file($tmp_name,$output_dir.$newfilename);
									//move_uploaded_file($tmp_name,$output_dir.$_FILES["file_i"]["name"]);
								$insertid = $this->Save_media_data($newfilename);
								$newfilename1[] = $newfilename;
								$insertid1[] = $insertid;
								}
							}
						 }
						}
					}

					//echo $json_encode(array('error' => $error,'name'  => $newfilename1['imgname'], 'rowid' =>$insertid1['iid']));
					//print_r($insertid1);
					echo json_encode(array(
						'name'  => $newfilename1,
						'error' => $error,
						'rowid' =>$insertid1,
					));

					die();

    }

    function save_media_data($nametitle)
    {

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('admin');
		}


		$name = $nametitle;
		$p_id = $_POST['course_id'];
		$section_id = $_POST['section_id'];
		$type = $_POST['media_type'];
		$category_id ="1";
		$published ="1";
		$created_by = $session['id'];



		$data = array(
					'media_title' => $name,
					'alt_title' => $name,
					'course_id' => $p_id,
					'section_id' => $section_id,
					'type' => $type,
					'category_id' => $category_id,
					'publish' => $published,
					'created_by' => $created_by,
			        );


			$this->load->model('tasks_model');

			$tid=$this->tasks_model->insert_media($data);
			return $tid;


    }

    function update_images_data()
    {

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$name_title = $_POST['title_media'];
		$namechange = $_POST['alt_title_image'];
		$m_id = $_POST['image_id'];

		$data = array(
					'alt_title' => $namechange,
			        );

		$tid=$this->tasks_model->update_media_data($m_id,$data);
		//echo $name_title;
		$name_title = $this->tasks_model->get_only_name($m_id);
	    echo $name_title->media_title;


    }

    function loadImageMediaLibrary()
    {
    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}
		$created_by = $session['id'];

    	$data = $this->tasks_model->loadImageMediaLibrary_admin($created_by);

		 echo json_encode($data);
    }


    function loadMediaLibrary()
    {
    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}
		$created_by = $session['id'];
		$m_type =$this->uri->segment(4);

    	$data = $this->tasks_model->loadMediaLibrary_admin($m_type);

		 echo json_encode($data);
    }

	//new code

	function update_video_data()
    {

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$name_title = $_POST['title_video'];
		$namechange = $_POST['alt_title_video'];
		$m_id = $_POST['video_id'];

$newfilename = $name_title;
		$newfilename_new = 'new_'.$newfilename;
		$new_dir = base_url()."public/uploads/thmb_img/";
				exec("ffmpeg -i ".$new_dir." -vcodec h264 -acodec mp2 ".$newfilename_new);
				// $newfilename_img = 'img_'.$newfilename;
		 // shell_exec(base_url().'public/uploads/thmb_img/ffmpeg -i '.$new_dir.' -f mjpeg -vframes 2 -s 150x150 -an '.$newfilename_img);

		$data = array(
					'alt_title' => $namechange,
			        );

		$tid=$this->tasks_model->update_media_data($m_id,$data);
		//echo $name_title;
		$name_title = $this->tasks_model->get_only_name($m_id);
	    echo $name_title->media_title;


    }

    function update_audio_data()
    {

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$name_title = $_POST['title_audio'];
		$namechange = $_POST['alt_title_audio'];
		$m_id = $_POST['audio_id'];

		$data = array(
					'alt_title' => $namechange,
			        );

		$tid=$this->tasks_model->update_media_data($m_id,$data);
		//echo $name_title;
		$name_title = $this->tasks_model->get_only_name($m_id);
	    echo $name_title->media_title;


    }

    function update_pdf_data()
    {
    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$name_title = $_POST['title_pdf'];
		$namechange = $_POST['alt_title_pdf'];
		$m_id = $_POST['pdf_id'];

		$data = array(
					'alt_title' => $namechange,
			        );

		$tid=$this->tasks_model->update_media_data($m_id,$data);
		//echo $name_title;
		$name_title = $this->tasks_model->get_only_name($m_id);
	    echo $name_title->media_title;
    }

    function update_flash_data()
    {
      $session = $this->session->userdata('loggedin');
    if(!$this->session->userdata('loggedin'))
    {
      redirect('users/login');
    }

    $name_title = $_POST['title_flash'];
    $namechange = $_POST['alt_title_flash'];
    $m_id = $_POST['flash_id'];

    $data = array(
          'alt_title' => $namechange,
              );

    $tid=$this->tasks_model->update_media_data($m_id,$data);
    //echo $name_title;
    $name_title = $this->tasks_model->get_only_name($m_id);
	    echo $name_title->media_title;
    }


    function saveTemplate()
    {

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$templates_name = $_POST['txt_templates_name'];
		$templates_containt = $_POST['txt_templates_containt'];
        $created_by = $session['id'];

		$data = array(
					'template_title' => $templates_name,
					'template_containt' => $templates_containt,
					'created_by' => $created_by,
			        );


			//$this->load->model('tasks_model');

			$tid=$this->tasks_model->save_template($data);
			return $tid;


    }

    function getTemplates()
    {
    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}
		$created_by = $session['id'];

		$templates_id = $_POST['id'];

    	$data = $this->tasks_model->getTemplates($templates_id);

		echo $data->template_containt;
		//echo json_encode($data);
    }

    function deleteTemplates()
    {
    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}
		$created_by = $session['id'];

		$templates_id = $_POST['id'];

    	$data = $this->tasks_model->deleteTemplates($templates_id);

		echo $data->template_containt;
		//echo json_encode($data);
    }

    function update_gallery_data()
    {
    	$image_id =$_POST['imgid'] ? $_POST['imgid']:"";

    	$jsondata = json_encode($image_id);

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$created_by = $session['id'];

		$data = array(
					'medias_id' => $jsondata,
					'created_by' => $created_by,
			        );

		$tid=$this->tasks_model->save_gallery($data);
		echo $tid;
    }

    function edit_gallery_data()
    {
    	$image_id =$_POST['imgid'] ? $_POST['imgid']:"";
    	$jsondata = json_encode($image_id);

    	$gallery_id =$_POST['txtpara'] ? $_POST['txtpara']:"";

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$created_by = $session['id'];

		$data = array(
					'medias_id' => $jsondata,
					'created_by' => $created_by,
			        );

		$tid=$this->tasks_model->edit_gallery($data,$gallery_id);
		echo $tid;
    }

    function save_lecture($did=NULL, $pid = NULL)
	{
		$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}

		$section_id = $this->uri->segment(4) ? $this->uri->segment(4) : $did ? $did : "";
		$p_id = $this->uri->segment(5) ? $this->uri->segment(5) : $pid ? $pid : "";
		$name = $this->input->post('name') ? $this->input->post('name'):'';
		$difficultylevel = 'medium';//$this->input->post('difficultylevel');
		$published = $this->input->post('published');
		$startpublish = date('Y-m-d h:i:s');
		$endpublish = date('Y-m-d h:i:s');
		$metatitle = $this->input->post('title');
		$metakwd = $this->input->post('key_description');
		$metadesc = $this->input->post('description');
		$created_by = $session['id'];
		// $lecture_content ='$this->input->post('content_lecture')';
		$lecture_type =$this->input->post('lecture_type');
		$lecture_duration =$this->input->post('lecture_duration');
// $get_media_ids = $this->input->post('media_id');
//         $this->template->set('get_media_ids',$get_media_ids);


// 		 if($this->input->post('media_id') != ''){
// 			       //$mediafile_id = rtrim($this->input->post('media_id'), ",");
// 			      $mediafile_id1 = implode(',', $this->input->post('media_id'));
// 			      $mediafile_id = rtrim($mediafile_id1, ",");
// 			       }else{
// 			        $mediafile_id =null;
// 			       }


		$data = array(
				'section_id' => $section_id,
				'p_id' => $p_id,
				'name' => $name,
				'difficultylevel' => $difficultylevel,
				'published' => $published,
				'startpublish' => $startpublish, // $this->input->post('endpublish')
				'endpublish' => $endpublish, // $this->input->post('endpublish')
				'metatitle' => $metatitle,
				'metakwd' => $metakwd,
				'metadesc' => $metadesc,
				//'ordering' => $this->tasks_model->maxorder(),
				'is_demo' => $this->input->post('is_demo'),
				'ordering' => $this->tasks_model->maxorder_list(),
				'created_by' => $created_by,
				'lecture_content' => '',
				'layoutid'=>1,
				'lecture_type' => $lecture_type,
				'lecture_duration' => $lecture_duration,
				// 'lecturemedias'=>$mediafile_id,

			);


			$this->load->model('tasks_model');

			$tid=$this->tasks_model->insert_lecture($data);
			 // echo $tid;
			if($published == '1') $publish = "Published";
			else $publish = "Draft";
			$data = array('tid' => $tid, 'name' => $name, 'did' => $did, 'pid' => $p_id, 'published' => $publish, 'lecture_type' => $lecture_type);
			echo json_encode($data);
			//echo '<li class="dd-item right-sect">'+$name+'</li>';

	}

	function edit_lecture()
	{
		// print_r($_POST);
				$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}


		$lec_id = $this->uri->segment(4) ? $this->uri->segment(4):"";
		$section_id = $this->uri->segment(5) ? $this->uri->segment(5):"";
		$p_id = $this->uri->segment(6) ? $this->uri->segment(6):"";

		$name = $this->input->post('name') ? $this->input->post('name'):'';
		$difficultylevel = 'medium'; //$this->input->post('difficultylevel');
		$published = $this->input->post('published');
		$startpublish = date('Y-m-d h:i:s');
		$endpublish = date('Y-m-d h:i:s');
		$metatitle = $this->input->post('title');
		$metakwd = $this->input->post('key_description');
		$metadesc = $this->input->post('description');
		$created_by = $session['id'];
		$lecture_content =$this->input->post('content_lecture');
		$Lec_videoId = $this->input->post('Lec_videoId');
		$lecture_type =$this->input->post('lecture_type');
		$lecture_duration =$this->input->post('lecture_duration');
		$get_media_ids = $this->input->post('media_id');
        // $this->template->set('get_media_ids',$get_media_ids);
         if($this->input->post('media_id') != ''){
			       //$mediafile_id = rtrim($this->input->post('media_id'), ",");
			      $mediafile_id1 = implode(',', $this->input->post('media_id'));
			      $mediafile_id = rtrim($mediafile_id1, ",");
			       }else{
			        $mediafile_id =null;
			       }

			if($_POST['release_type'] != '')
	{
		if($this->input->post('release_type') == '1')
		{
			$release_date = $this->input->post('release_date');
		}
		else if($this->input->post('release_type') == '2')
		{
			$release_date = $this->input->post('release_day');
		}
		// if($this->input->post('email_notify') == 'on')
		// {
		// 	$notify = '1';
		// }
		// else{
		// 	$notify = '0';
		// }
		// echo $release_date;



		$data = array(
				'name' => $name,
				'difficultylevel' => $difficultylevel,
				'published' => '1',
				'startpublish' => $startpublish, // $this->input->post('endpublish')
				'endpublish' => $endpublish, // $this->input->post('endpublish')
				'metatitle' => $metatitle,
				'metakwd' => $metakwd,
				'metadesc' => $metadesc,
				//'ordering' => $this->tasks_model->maxorder(),
				'created_by' => $created_by,
				'lecture_content' => $lecture_content,
				'lecture_video' => $Lec_videoId,
				'lecture_type' => $lecture_type,
				'lecture_duration' => $lecture_duration,
				'release_date' => $release_date,
				// 'email_notify' => $notify,
				// 'email_body' => $this->input->post('body'),
				'lecturemedias'=>$mediafile_id,

				// 'release_type' => $this->input->post('release_type')
			);
			// print_r($data);

			$this->load->model('admin/tasks_model');

			$tid=$this->tasks_model->update_lecture($data,$lec_id,$p_id);
			// echo $tid; exit(" update");
			if($tid)
			{
		            	$this->inform_students($p_id,$section_id,$lec_id);
				/*if($this->input->post('inform_msg') != '')
		            {

		            }

		        $Enroll_notify=$this->tasks_model->Enroll_notify($p_id);
				//print_r($Enroll_notify);
				$En_course = $this->tasks_model->Enroll_course($p_id);

				$trainerData = $this->tasks_model->getauth($En_course->author);
				$inform_message = $this->input->post('body');

				$this->load->model('admin/settings_model');
				$configarr = $this->settings_model->getItems();*/
				// print_r($configarr);
				/*
				foreach ($Enroll_notify as $message)
				{
					if($_POST['release_type']  == '2')
					{
					$buy_date1 = str_replace('-', '/', $message->buy_date);
					$day = $this->input->post('release_day');
					$release_date = date('Y-m-d',strtotime($buy_date1 . "+".$day." days"));
					}
					// error_reporting(0);
     //   	   	 		$urldomain = base_url();
					// $urldomain = str_replace('http://', '', $urldomain);
					// $urldomain = str_replace('/', '', $urldomain);
					// $urldomain = str_replace('www.', '', $urldomain);
					if($configarr[0]['fromemail'])
        $urldomain = $configarr[0]['fromemail'];
        else if($configarr[0]['fromemail'])
        $urldomain = $configarr[0]['fromemail'];
        else $urldomain = $this->config->item('urldomain');
					$subject ="Updates in Lecture '".$name."' under the Course '".$En_course->name."' ";

       	            // $subject = "Lecture '".$name."' release on '".$release_date."' under the Course '".$En_course->name."' ";
					$toemail =  $message->username; // $teacher_email
					//$toemail = "veerit1511@gmail.com";
					// echo "<br>".$toemail;
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					// $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($message->first_name)).',<br /><br />';
					$content .= "This is notify that, Some changes occure in The Lecture '".$name."' of The Course '".$En_course->name."' by the instructor.<br /><br />";
					$content .= 'Message from the instructor about the updates is given below:<br /><br />';
					$content .=  'Instructor: '.trim(ucfirst($trainerData->first_name)).' '.trim(ucfirst($trainerData->last_name)).' <br /><br />';
					$content .=  $inform_message.'<br /><br />';
					$content .='If you need help or have any questions, please contact us. <br /><br />';
					$content .= '<br /><br />';
					$content .='...</p>';
					$content .= $configarr[0]['signature'].'</p>';
					$content .= 'Best regards,<br /><br />';
					$content .='The '.$configarr[0]['institute_name'].' Team.</p>';
					$data['content'] = $content;
 $data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);

					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= $urldomain;    //$configarr[0]['fromemail'];
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					//$this->email->from($fromemail, $configarr[0]['fromname']);
					$this->email->from($fromemail);
					$this->email->subject($subject);
					$this->email->to($toemail);
					// $this->email->cc('veerit1511@gmail.com');
					$this->email->message($message);

					$this->email->send();
      			 }*/

       	   			echo "success";

			}
		}
		else{
		$data = array(
				'name' => $name,
				'difficultylevel' => $difficultylevel,
				'published' => $published,
				'startpublish' => $startpublish, // $this->input->post('endpublish')
				'endpublish' => $endpublish, // $this->input->post('endpublish')
				'metatitle' => $metatitle,
				'metakwd' => $metakwd,
				'metadesc' => $metadesc,
				//'ordering' => $this->tasks_model->maxorder(),
				//'ordering' => $this->tasks_model->maxorder_list(),
				'is_demo' => $this->input->post('is_demo'),
				'created_by' => $created_by,
				'lecture_content' => $lecture_content,
				'lecture_video' => $Lec_videoId,
				'lecture_type' => $lecture_type,
				'lecture_duration' => $lecture_duration,
				'lecturemedias'=>$mediafile_id,

			);
			// print_r($data);

			$this->load->model('tasks_model');

			$tid=$this->tasks_model->update_lecture($data,$lec_id,$p_id);
			echo $tid;
			if($tid)
			{
				if($this->input->post('inform_msg') != '')
		            {

		            	$this->inform_students($p_id,$section_id,$lec_id);
		            }
			}
		}
	}


	function save_exam($did=NULL, $pid = NULL)
	{

		$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('admin');
		}

		// $section_id = $_POST['section_id'];
		// $p_id = $_POST['p_id'];

		$section_id = $this->uri->segment(4) ? $this->uri->segment(4) : $did ? $did : "";
		$p_id = $this->uri->segment(5) ? $this->uri->segment(5) : $pid ? $pid : "";

		$name = $_POST['name'];
		$difficultylevel = $this->input->post('difficultylevel');
		$published = $this->input->post('published') ? $this->input->post('published') : '0';
		$startpublish = date('Y-m-d h:i:s');
		$endpublish = date('Y-m-d h:i:s');
		$metatitle = "";
		$metakwd = "";
		$metadesc = "";
		$created_by = $session['id'];
		$lecture_content = $this->input->post('lec_content');
		$layoutid =12;
		// $is_exam = $_POST['examid'];
		$lecture_duration = $this->input->post('lecture_duration');


		$data = array(
				'section_id' => $section_id,
				'p_id' => $p_id,
				'name' => $name,
				'difficultylevel' => $difficultylevel,
				'published' => $published,
				'startpublish' => $startpublish, // $this->input->post('endpublish')
				'endpublish' => $endpublish, // $this->input->post('endpublish')
				'metatitle' => $metatitle,
				'metakwd' => $metakwd,
				'metadesc' => $metadesc,
				//'ordering' => $this->tasks_model->maxorder(),
				'ordering' => $this->tasks_model->maxorder_list(),
				'created_by' => $created_by,
				'lecture_content' => $lecture_content,
				'layoutid'=>12,
				// 'is_exam'=>$is_exam,
				'lecture_duration' => $lecture_duration,
			);


			$this->load->model('tasks_model');

			$tid=$this->tasks_model->insert_lecture($data);
			if($published == '1') $publish = "Published";
			else $publish = "Draft";
			$data = array('tid' => $tid, 'name' => $name, 'did' => $section_id, 'pid' => $p_id, 'published' => $publish, 'difficultylevel' => $difficultylevel);
			echo json_encode($data);
	}

	function edit_exam()
	{
		// print_r($_POST);
		$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('admin');
		}

		$lecture_id = $_POST['lecture_id'];
		$section_id = $_POST['section_id'];
		$p_id = $_POST['p_id'];

		$name = $_POST['name'];
		$difficultylevel = $_POST['level'];
		$published = $_POST['published'];
		$lecture_content = $_POST['lec_content'];
		$is_exam = $_POST['examid'];
		$lecture_duration = $_POST['lecture_duration'];

		$data = array(
				'name' => $name,
				'difficultylevel' => $difficultylevel,
				'published' => $published,
				'lecture_content' => $lecture_content,
				'is_exam'=>$is_exam,
				'lecture_duration' => $lecture_duration,
			);


			$this->load->model('tasks_model');

			$tid=$this->tasks_model->update_lecture($data,$lecture_id,$p_id);
			echo $tid;
	}

	public function upload_test()
  {
  	 echo"<pre>";
  	 print_r($_FILES);
  	 print_r($_POST);
	exit('111');
  }


	function loadCourses()
    {

    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('admin');
		}
		$created_by = $session['id'];

    	$course_id = $_POST['courseid'];
    	$data = $this->tasks_model->loadCourses($course_id);
		echo json_encode($data);
    }

    function loadOtherCourses()
    {
    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('admin');
		}
		$created_by = $session['id'];

    	//$course_id = $_POST['courseid'];

    	$data = $this->tasks_model->loadOtherCourses($created_by);
		echo json_encode($data);
    }

public function uploadtoserver()
    {
		// 5 minutes execution time
		@set_time_limit(5 * 60);
		// Uncomment this one to fake upload time
		// usleep(5000);

		// Settings

		$targetDir = FCPATH . "public/uploads/videos";
		//$targetDir = 'uploads';
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds


		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}

		//$path_parts = pathinfo($targetDir.'/'.$fileName);
		//$temp = explode(".", $_FILES["file"]["name"]);
  		$i=1;
  		if(file_exists($targetDir.'/'.$fileName))
  		{

  			// if(file_exists($targetDir.'/'.$fileName))
  			// {

  			// }
  			$fileName1 = $fileName;
	  	 	do{
	   		$fileName = $i.'_'.$fileName1;
	  	 		$i++;

	   		  }
	  	 	while(file_exists($targetDir.'/'.$fileName));
  	    }


		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


		// Remove old temp files
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}


		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off
			rename("{$filePath}.part", $filePath);

			$insertid = $this->Save_media_data($fileName);
			$error = 0;


		die('{"name" : "'.$fileName.'", "error" :"'.$error.'", "rowid" : "'.$insertid.'"}');

		}

		// Return Success JSON-RPC response
		//die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');

    }

  public function getVimeoList_test($page)
  {
  	$page = 1;
  	  	$url='vimeoapi/getvideos.php'; // Specify your url

  	// $url='https://vimeoapi.createonlineacademy.com/getvideos.php'; // Specify your url
	$data= array('project_id'=>'2160581','page'=>$page); // Add parameters in key value

	$ch = curl_init(); // Initialize cURL
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($ch, CURLOPT_PROXY, $proxy); // $proxy is ip of proxy server
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);


	$result = curl_exec($ch);
	curl_close($ch);

	echo"<pre>";
	print_r($result);
	return $result;
	// exit('yes');
  }

  public function getVimeoList($page)
  {
  	$page = 1;
  	  	$url='vimeoapi/getvideos.php'; // Specify your url

  	// $url='https://vimeoapi.createonlineacademy.com/getvideos.php'; // Specify your url
	$data= array('project_id'=>'628460','page'=>$page); // Add parameters in key value

	$ch = curl_init(); // Initialize cURL
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($ch, CURLOPT_PROXY, $proxy); // $proxy is ip of proxy server
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);


	$result = curl_exec($ch);
	curl_close($ch);
	// echo"<pre>";
	// print_r($result);
	return $result;
	// exit('yes');
  }

  function getVimeotest($page)
  {
		$postData = array('project_id'=>'628460','page'=>$page);
		$authToken = "ef7981ec72516a437b83d4a566d2ce9b";
	// Setup cURL
	$ch = curl_init('https://myonlineshiksha.com/vimeoapi/getvideos.php');
	curl_setopt_array($ch, array(
	CURLOPT_POST => TRUE,
	CURLOPT_RETURNTRANSFER => TRUE,
	CURLOPT_HTTPHEADER => array(
	    'Authorization: '.$authToken,
	    'Content-Type: application/json'
	),
	CURLOPT_POSTFIELDS => json_encode($postData)
	));

	// Send the request
	$response = curl_exec($ch);
	return $response;
  }

  public function getAllVimeoVideo_test()
  {

  	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}
		$created_by = $session['id'];
		$m_type =$this->uri->segment(4);

		if($m_type == "Video")
		{
			$page = @$this->input->post('page') ?  @$this->input->post('page') : '1';
			// $page = 1;
  	  	// $url='https://myonlineshiksha.com/vimeoapi/getvideos.php'; // Specify your url
	$url='https://vimeoapi2.createonlineacademy.com/vendor/example/getvideos.php';
  	// $url='https://vimeoapi.createonlineacademy.com/getvideos.php'; // Specify your url
	$data= array('project_id'=>'628460','page'=>$page); // Add parameters in key value

	$ch = curl_init(); // Initialize cURL
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	// curl_setopt($ch, 'CURLOPT_COOKIESESSION', true);
	// curl_setopt($ch, 'CURLOPT_FORBID_REUSE', true);
	// curl_setopt($ch, 'CURLOPT_FRESH_CONNECT', true);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0'
// ));
	$result=curl_exec ($ch);

	curl_close ($ch);
	echo $result;

echo '<pre>';
print_r($result);
echo '</pre>';
			// echo $this->getVimeoList($page);
			// exit('11');

		}
		else
		{

		  $data = $this->tasks_model->loadMediaLibrary_admin($m_type);

		  // exit('22');
		  echo json_encode($data);

		}


  }


  public function getAllVimeoVideo()
  {

  	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}
		$created_by = $session['id'];
		$m_type =$this->uri->segment(4);

		if($m_type == "Video")
		{
			$page = @$this->input->post('page') ?  @$this->input->post('page') : '1';
			// $page = 1;
  	  	// $url='https://myonlineshiksha.com/vimeoapi/getvideos.php'; // Specify your url
	$url='https://vimeoapi2.createonlineacademy.com/vendor/example/getvideos.php';
  	// $url='https://vimeoapi.createonlineacademy.com/getvideos.php'; // Specify your url
	$data= array('project_id'=>'628460','page'=>$page); // Add parameters in key value

	/*$ch = curl_init(); // Initialize cURL
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
	
	$result=curl_exec ($ch);

	curl_close ($ch);
	echo $result;*/

		$url = 'https://api.vimeo.com/me/projects/628460/videos';
		

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$headers = array(); 
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		$headers[] = "Accept: application/json";
		$headers[] = "Authorization: Bearer ef7981ec72516a437b83d4a566d2ce9b";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);

		curl_close($ch);

		

		$videos =  json_decode($result);

		$videos = $videos->data;


		
		$vimeoArray = array();
    if($videos)
    {
        foreach ($videos as $key => $video) 
        {
        	
        	$get_picture_size =  $video->pictures->sizes;
        	foreach($get_picture_size as $get_picture_sizes)
        	{

        	
        		$link_image = $get_picture_sizes->link;
        	}
        
            $arrayName = array('link' =>$video->link,
                               'media_title' =>$video->name,
                               'alt_title' =>$video->name,
                               'description' =>$video->description,
                               'image'=> $link_image
                              );
            array_push($vimeoArray, $arrayName);
        }

        
        echo json_encode($vimeoArray);
    }



		}
		else
		{

		  $data = $this->tasks_model->loadMediaLibrary_admin($m_type);

		  // exit('22');
		  echo json_encode($data);

		}


  }


public function getAllVimeoVideo2()
  {

  	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('users/login');
		}
		$created_by = $session['id'];
		$m_type =$this->uri->segment(4);

		if($m_type == "Video")
		{
			$page = @$this->input->post('page') ?  @$this->input->post('page') : '1';
			// $page = 1;
  	  	$url='https://myonlineshiksha.com/vimeoapi/getvideos.php'; // Specify your url

  	// $url='https://vimeoapi.createonlineacademy.com/getvideos.php'; // Specify your url
	$data= array('project_id'=>'628460','page'=>$page); // Add parameters in key value

	$ch = curl_init(); // Initialize cURL
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
// 	curl_setopt($ch, CURLOPT_TIMEOUT, 100);
// 	curl_setopt($ch, 'CURLOPT_COOKIESESSION', true);
// 	curl_setopt($ch, 'CURLOPT_FORBID_REUSE', true);
// 	curl_setopt($ch, 'CURLOPT_FRESH_CONNECT', true);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0'
// ));
	$result=curl_exec ($ch);

	curl_close ($ch);

// echo '<pre>';
print_r($result);
// echo '</pre>';
			// echo $this->getVimeoList($page);
			// exit('11');

		}
		else
		{

		  $data = $this->tasks_model->loadMediaLibrary_admin($m_type);

		  // exit('22');
		  echo json_encode($data);

		}


  }


  public function upload_test121(){
  	 if ($this->input->post('video_upload')) {
            //set preferences
            //file upload destination
            $upload_path = 'public/uploads/';
            $output_dir = FCPATH."public/uploads/videos/";
            print_r($_FILES);
$tmp_name = $_FILES['video_name']['tmp_name'];
$date = date('d');
							  		$month = date('m');
							  		$year = date('Y');
							  		$random_no = rand(1000,5000);
							  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;

							  		$temp = explode(".", $_FILES["video_name"]["name"]);
									$newfilename = round(microtime(true)).'-'.$generate.'.'.end($temp);
							  		move_uploaded_file($tmp_name,$output_dir.$newfilename);

        }
        //load the error and success messages
        $data['errors'] = $this->error;
        $data['success'] = $this->success;
        //load the view along with data
        $this->load->view('admin/tasks/video_upload', $data);


  }

  public function upload_vimeo()
  {
  	// $data = file_get_contents("php://input");

 //  	$output_dir = FCPATH."public/uploads/tmp_video/".$_FILES['file_i']['name'];
	// $moved =move_uploaded_file($_FILES['file_i']['tmp_name'],$output_dir);
// echo $moved;
	// if($moved)
  	  if (isset($_FILES['file_i']) )

  	   {

			$filename  = $_FILES['file_i'];
			$handle    = fopen($filename, "r");
			$data      = fread($handle, filesize($filename));
			$POST_DATA = array(
			// 'file_i' => $filename,
				'file_i' => new \CurlFile($filename['tmp_name'],$filename['type'],$filename['name']),
				'vimeo_title' => $_POST['vimeo_title'],
				'project_id' => '628460',
			);
			$url='https://vimeoapi2.createonlineacademy.com/vendor/example/uploadvideo.php';
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL,$url);
			curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_TIMEOUT, 84600);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
			$response = curl_exec($curl);
			curl_close ($curl);
			echo $response;




			 // curl_setopt($curl, CURLOPT_UPLOAD, 1);
			 // curl_setopt($curl, CURLOPT_INFILE, $handle);
			 // curl_setopt($curl, CURLOPT_BUFFERSIZE, 524);
			 // curl_setopt($curl, CURLOPT_INFILESIZE, filesize($filename));

			 //echo "<h2>File Uploaded</h2>";
			 /*
			 $POST_DATA = array(
			   'file_i' => $_FILES['file_i']['tmp_name'],
			   'vimeo_title' => $_POST['vimeo_title'],
			   'project_id' => '757598',
			 );
$url='https://vimeoapi.createonlineacademy.com/uploadvideo.php';
			 $localFile = $_FILES['file_i']['tmp_name'];

				$fp = fopen($localFile, 'r');

				// Connecting to website.
				$ch = curl_init();

				// curl_setopt($ch, CURLOPT_USERPWD, "dev@createonlineacademy.com:{T1D$ZHE@zcy");
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_UPLOAD, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 86400); // 1 Day Timeout
				curl_setopt($ch, CURLOPT_POSTFIELDS, $POST_DATA);
				curl_setopt($ch, CURLOPT_INFILE, $fp);
				curl_setopt($ch, CURLOPT_NOPROGRESS, false);
				curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'CURL_callback');
				curl_setopt($ch, CURLOPT_BUFFERSIZE, 128);
				curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localFile));
				$response = curl_exec($ch);
			 curl_close ($ch);
			 echo $response;*/
		}
		else
		{
			echo"failed..";
		}

  }

  public function getVimeoVid($vid)
    {

		/* print_r($vid);die;

		$url = 'https: //myonlineshiksha.com/vimeoapi/vendor/example/demo_test.php'; */


    	$url='https://vimeoapi2.createonlineacademy.com/vendor/example/demo_test.php';
		$data= array('project_id'=>'628460','page'=> 1,"video_id" => $vid); // Add parameters in key value
		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 100);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		$result=curl_exec ($ch);
		curl_close ($ch);
		$result2 = json_encode($result);

		echo trim(substr(substr($result,strpos($result,'https://vimeo.com/'),39),28));
    }

}
