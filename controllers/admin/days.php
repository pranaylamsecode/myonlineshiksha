<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Days extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in'
		//'except' => array('index')
		//'only' => array('index')
	);
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate();
		$this->load->model('admin/days_model');		
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
		//echo 'ssss'.$parent_id;exit;
		$this->template->set_layout('backend');
		$this->template->title('Section Management');
				$parent_id = ($parent_id) ? $parent_id : 0 ;
				if($parent_id!=0){
				$program = $this->days_model->getProgram($parent_id);
				$this->template->set("program", $program);
			}

			$this->template->set("days", $this->days_model->getlistDays($parent_id));
			$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		
		$this->template->build('admin/days/list');
	}
	
	public function addjumplist($pid = NULL)
	{ 	//echo 'ssss'.$parent_id;exit;

	//$this->template->set_layout('backend');
	
	$this->template->title('Modules List');
		$pid = $this->uri->segment(4);
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;
		$pid = ($pid) ? $pid : 0 ;
		$srno = $this->uri->segment(5);
		$srno = ($srno != 0) ? filter_var($srno, FILTER_VALIDATE_INT) : NULL;
		$jumpbutid = $this->uri->segment(6);
		$jumpbutid = ($jumpbutid != 0) ? filter_var($jumpbutid, FILTER_VALIDATE_INT) : NULL;
			if($pid!=0){
			//$program = $this->days_model->getProgram($pid);
			$this->template->set("pid", $pid);
			$this->template->set("jumpbutid", $jumpbutid);
			$this->template->set("butsrno", $srno);
			$this->template->set("jmpbutinfo", $this->days_model->getJumpbutton($jumpbutid));
		}
		$this->template->set("days", $this->days_model->getlistDays($pid));
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	$this->template->build('admin/days/addjumplist');
	}
	
	function ajaxjumpbutton(){

		
	error_reporting(0);
	$butsrno = $this->input->post('butsrno', TRUE);
	$jump_step = $this->input->post('jump_step', TRUE);
	$jumpbutid = ($this->input->post('jumpbutid', TRUE)) ? $this->input->post('jumpbutid', TRUE) : 0;
	$jumptxt = $this->input->post('jumptxt', TRUE);
	$module_id = $this->input->post('module_id', TRUE);
	$type_selected = $this->input->post('type_selected', TRUE);
		if($jumpbutid != 0){
		$data = array(
				'button' => $butsrno,
				'text' => $jumptxt,
				'jump_step' => $jump_step,
				'module_id' => $module_id,
				'type_selected' => $type_selected
				);
			$this->days_model->updateJumpbutton($data,$jumpbutid);
		}else{
		$data = array(
				'button' => $butsrno,
				'text' => $jumptxt,
				'jump_step' => $jump_step,
				'module_id' => $module_id,
				'type_selected' => $type_selected
				);
			$insertbuttonid = $this->days_model->insertJumpbutton($data);
			echo $insertbuttonid;
		}
	}
	
	function create($parent_id = false) 
	{		 
		$this->template->set_layout('backend');
		$this->template->title("Create Section");	
		$this->template->append_metadata(block_submit_button());
		
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_rules('title', 'title', 'required');
	   //$this->form_validation->set_rules('access', 'access', 'required');
		
		if ($this->form_validation->run() === false)
		{
			$this->template->build('admin/days/create');
		}
		else
		{
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('title');
			$data = array(
				'pid' => $parent_id,
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'alias' => $alias,
				//'access' => $this->input->post('access'),
				'published' => $this->input->post('published'),
				'ordering' => $this->days_model->maxorder($parent_id),
				'media_id' => $this->input->post('db_media_1')
			);


			
			$modinsertid = $this->days_model->insertItems($parent_id,$data);
			
			// $mediamedia = $this->input->post('db_media_1');
			// $datatext = array(
			// 				'type' => 'mod_m',
			// 				'type_id' => $modinsertid,
			// 				'media_id' => $mediamedia
			// 				);
			// $this->days_model->insertItemsRel($datatext);
			// $mediatext = $this->input->post('db_text_1');
			// $datatext = array(
			// 				'type' => 'mod_t',
			// 				'type_id' => $modinsertid,
			// 				'media_id' => $mediatext
			// 					);
			// $this->days_model->insertItemsRel($datatext);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				//redirect('admin/days/'.$parent_id);
			?>
         <script type="text/javascript">
         window.parent.location.href = "<?php echo base_url(); ?>admin/section-management/<?php echo $parent_id;?>/";
         </script>
         <?php 
		}
	}



	function section_ajax($parent_id)
	{
		$parent_id = $parent_id ? $parent_id : NULL;
		// $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$data['updType'] = 'create';
		$data['parent_id'] = $parent_id;
		$this->load->view('admin/days/create_popup',$data);
		// $this->load->view('admin/days/create_popup',$data);

	}
	function section_edit($id = NULL, $parent_id = NULL)
	{
		$parent_id = $parent_id ? $parent_id : NULL;

		//get the $id and sanitize
		$id = $id ? $id : NULL;
		$data = array('updType' => 'edit',
			'parent_id' => $parent_id,
			'id' => $id,
			'day' => $this->days_model->getDay($id),
	);

		
		$this->load->view('admin/days/create_popup',$data);

	}
	
	function edit($id = FALSE, $parent_id = FALSE) 
	{
		
		//load block submit helper and append in the head
		$this->template->set_layout('backend');	
	
		$this->template->append_metadata(block_submit_button());
				
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
			redirect('admin/section-management/'.$parent_id);
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));
		$this->template->title("Edit Section");
		$this->template->set('day', $this->days_model->getDay($id));
		$this->template->set('updType', 'edit');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('db_media', $this->days_model->getMedia_oflayout('mod_m',$id));
		$this->template->set('db_mediatext', $this->days_model->getMedia_oflayout('mod_t',$id));
		
		$this->form_validation->set_rules('title', 'title', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		//$this->form_validation->set_rules('category_id', 'category_id', 'required');
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/days/create');
		}
		else
		{	

			
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('title');
			$form_data = array(
				'pid' => $parent_id,
				'title' => $this->input->post('title'),
				'access' => $this->input->post('access'),
				'description' => $this->input->post('description'),
				'alias' => $alias,
				'published' => $this->input->post('published'),
				'media_id' => $this->input->post('db_media_1')
			);
			
			// $mediamedia = $this->input->post('db_media_1');

			// $datatext = array('media_id' => $mediamedia	);

			//  $this->days_model->updateMediarel($id,$datatext,'mod_m');

			// $mediatext = $this->input->post('db_text_1');
			// 					$datatext = array(
			// 					'media_id' => $mediatext
			// 					);
			// $this->days_model->updateMediarel($id,$datatext,'mod_t');
			
			 $isupdated = $this->days_model->updateItem($id,$form_data);
			
            
			if($isupdated) // the information has therefore been successfully saved in the db
			{

				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				//redirect('admin/days/'.$parent_id);
				?>
         <script type="text/javascript">
         window.parent.location.href = "<?php echo base_url(); ?>admin/section-management/<?php echo $parent_id;?>/";
         </script>
         <?php 
			}
			else{
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				//redirect('admin/days/'.$parent_id);	
				?>
         <script type="text/javascript">
         window.parent.location.href = "<?php echo base_url(); ?>admin/section-management/<?php echo $parent_id;?>/";
         </script>
         <?php 
			}	
	  	} 
	}

	function edit_popup($parent_id = NULL, $id = NULL){
		// $parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
		// $id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('title');
			$form_data = array(
				'pid' => $parent_id,
				'title' => $this->input->post('title'),
				// 'access' => $this->input->post('access'),
				'description' => $this->input->post('description'),
				// 'alias' => $alias,

				'published' => $this->input->post('published'),
				// 'media_id' => $this->input->post('db_media_1')
			);

			if($this->input->post('updType') == 'edit'){
 				$isupdated = $this->days_model->updateItem($id,$form_data);
			
	            
				if($isupdated) // the information has therefore been successfully saved in the db
				{
					$response = array('did' => $id, 'title'=> $this->input->post('title') );
					echo json_encode($response);

				}
				
			}
			else{
				// array_merge($form_data, array('ordering' => $this->days_model->maxorder($parent_id)));
				$form_data['ordering'] = $this->days_model->maxorder($parent_id);
				$modinsertid = $this->days_model->insertItems($parent_id,$form_data);
				if($modinsertid) // the information has therefore been successfully saved in the db
				{
					$response = array('did' => $modinsertid, 'title'=> $this->input->post('title'), 'pid'=> $parent_id );
					echo json_encode($response);

				}
			
			}
			
	  	} 

	
	function delete($id = NULL,$parent_id = FALSE)
	{
		

		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		$lect_ids = $this->days_model->getchildcount($id);
		
		
		//redirect if it´s no correct
		if (!$id){
			echo "This Chapter has lessons!";
			// $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This Module has lessons!' ) );
			// redirect('admin/section-management/');
		}
		
		//search child items count
		
		elseif (count($lect_ids)>0)
		{
			if($this->input->post('del_lecture') == 1)
			{
				$ids = array();
				foreach ($lect_ids as $lect_id) {
					array_push($ids, $lect_id->id);
				}
				$lectdelete=$this->days_model->deleteAllLectures($ids);
				$isdelete=$this->days_model->deleteItem($id);
				if($lectdelete && $isdelete)
					echo "success";
			}
			else{
				echo "This Section contains lectures. Please delete lectures first.";
			}
			
		}

     	else{		
			$isdelete=$this->days_model->deleteItem($id);	
			
			//delete the item
			if ($isdelete) 
			{
				echo "success";
				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
			}
			else
			{
				echo lang('web_delete_failed');
				// $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
			}	
		}
	}

	public function getImage()
	{
	   error_reporting(0);
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
		  $config['max_size']  = 1024 * 8;
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

	function sortingorder()
	{
		$ordering =$_POST['lectureSortIDS'];
		$sectionOrdering =$_POST['sectionSortIDS'];
		$sectionSorting =$_POST['sectionSorting'];		
		 	
		
		if($sectionOrdering)
		{
			foreach ($sectionOrdering as $key => $section)
			{			
				$orderNo =1;
				
				foreach ($ordering[$key] as $value)
					{
						$keyvalue = explode("_",$value);					

						$data = array(
							'ordering' =>$orderNo, 
					 		);					

						$this->days_model->orderingUpdate($keyvalue[1],$data);
						
						$data1 = array(
							'section_id' =>$section, 
							);
						$isupdated = $this->days_model->relationUpdate($keyvalue[0],$keyvalue[1],$data1);
						//echo $isupdated;

						 	$orderNo++;

					}	
						
		 	}
	    }

	 	$orderNo1 =1;
	 	if($sectionSorting)
	 	{
			 	foreach ($sectionSorting as $key => $sectionsorted)
				{
				 	foreach ($sectionsorted as $sss)
						{
							$keyvalue = explode("_",$sss);	

							$data = array(
							'ordering' =>$orderNo1, 
							);

							$this->days_model->sortingsection($keyvalue[1],$data);	 	       

				 	       $orderNo1++;
						}	 	
					
			    	
			    }
	    }

	    //echo "success";
	}

	function relationUpdate()
	{
		$eleId =$_POST['eleId'];
		$parent_id =$_POST['parent_id'];		
		
		$keyvalue = explode("_",$eleId);
			// echo $keyvalue[0];
			 //echo $keyvalue[1];			
			
			$data = array(
				'section_id' =>$parent_id, 
				);
		$isupdated = $this->days_model->relationUpdate($keyvalue[0],$keyvalue[1],$data);
		echo $isupdated;
		 
	}

	function sortingsection()
	{
		$ordering =$_POST['sortedIDs'];		
		$orderNo =1;
		foreach ($ordering as $key => $value)
		 {
		 	 $keyvalue = explode("_",$value);
			 //echo $keyvalue[1];
			
			$data = array(
				'ordering' =>$orderNo, 
				);
		$isupdated = $this->days_model->sortingsection($keyvalue[1],$data);
		echo $isupdated;
		 $orderNo++;
		 }
	}


	function assignment($program_id='',$section_id='')
	{
		$data = array(
					'updType' => "Save & Continue",
					'heading' => "Create New Assignment",
					'assign_title' => set_value(''),
					'assign_description' => set_value(''),
					'assign_instruction' => set_value(''),
					'instruction_videos' => set_value(''),
					'assign_id' => set_value(''),
					'resources_files' => set_value(''),
					'course_id' => $program_id,
					'section_id' => $section_id,
					'assign_ques' => set_value(''),
		);
		$this->template->set_layout('backend');
      	$this->template->title('Assignment');
		$this->template->build('admin/days/create_assignment',$data);
	}

	function create_assignment()
	{
		// print_r($_POST);exit;
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		$instruction = $this->input->post('instruction');
		$course_id = $this->input->post('course_id');
		$section_id = $this->input->post('section_id');
		$assign_id = $this->input->post('assign_id');
		$assignment = '';
		$resource_ftype = '';
		if(!empty($assign_id) && $assign_id != '')
		{
			$assignment = $this->Crud_model->get_single('mlms_assignment',"assign_id = ".$assign_id,"instruction_videos,resources_files,resource_ftype,course_id,section_id");
			$course_id = $assignment->course_id;
			$section_id = $assignment->section_id;
		}
		if( $_FILES['instruction_videos']['error']=='0' )
        {
        	if(!empty($assignment))
        	{
        		if(!empty($assignment->instruction_videos) && !file_exists("/public/uploads/assignments/instr_vdo/".$assignment->instruction_videos))
        		{
        			unlink(getcwd().'/public/uploads/assignments/instr_vdo/'.$assignment->instruction_videos);
        		}
        	}
            $file_element_name = 'instruction_videos';
            $config['upload_path'] = getcwd().'/public/uploads/assignments/instr_vdo/';
            $config['allowed_types'] = 'mp4|3gp|avi|m4p';
            // $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $error =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
                echo 'error';exit;
            }
            $instr_file = $this->upload->data();
            $_POST['instruction_videos'] = $instr_file['file_name'];   
        }
        else if(!empty($assignment))
    	{
    		if(!empty($assignment->instruction_videos))
    		{
    			$_POST['instruction_videos'] = $assignment->instruction_videos;
    		}
    	}
	    else{
	    	$_POST['instruction_videos'] = '';
	    }
		if( $_FILES['resources_files']['error']=='0' )
        {
        	if(!empty($assignment))
        	{
        		if(!empty($assignment->resources_files) && !file_exists("/public/uploads/assignments/resource_file/".$assignment->resources_files))
        		{
        			unlink(getcwd().'/public/uploads/assignments/resource_file/'.$assignment->resources_files);
        		}
        	}
            $file_element_name = 'resources_files';
            $config['upload_path'] = getcwd().'/public/uploads/assignments/resource_file/';
            $config['allowed_types'] = 'jpg|JPG|png|PNG|jpeg|JPEG|gif|GIF|docx|doc|pdf|ppt|xls|xlsx|txt|mp4|mp3|3gp|avi|m4p';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $error =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
                echo "error";exit;
            }
            $res_file = $this->upload->data();
            $_POST['resources_files'] = $res_file['file_name'];  
            $resource_ftype =  $_FILES['resources_files']['type'];
        }
        else if(!empty($assignment))
    	{
    		if(!empty($assignment->resources_files))
    		{
    			$_POST['resources_files'] = $assignment->resources_files;
				$resource_ftype =  $assignment->resource_ftype;  
    		}
    	}
	    else{
	    	$_POST['resources_files'] = '';
	    }
        if(empty($assign_id)){
	        $data = array(
	        			'assign_title' => $name,
	        			'assign_description' => $description,
	        			'assign_instruction' => $instruction,
	        			'instruction_videos' => $_POST['instruction_videos'],
	        			'resources_files' => $_POST['resources_files'],
	        			'course_id' => $course_id,
	        			'section_id' => $section_id,
	        			'resource_ftype' => $resource_ftype,
	        			'created' => date('Y-m-d H:i:s'),
	        			'modified' =>  date('Y-m-d H:i:s')
	        );
        	$this->Crud_model->SaveData('mlms_assignment',$data);
        	echo $this->db->insert_id();
        }
        else{
	        $data = array(
	        			'assign_title' => $name,
	        			'assign_description' => $description,
	        			'assign_instruction' => $instruction,
	        			'instruction_videos' => $_POST['instruction_videos'],
	        			'resources_files' => $_POST['resources_files'],
	        			'course_id' => $course_id,
	        			'section_id' => $section_id,
	        			'resource_ftype' => $resource_ftype,
	        			'modified' =>  date('Y-m-d H:i:s')
	        );
        	$this->Crud_model->SaveData('mlms_assignment',$data,"assign_id = ".$assign_id);
        	echo "Updated";
        }
	}

	public function add_ques()
	{
		$que_text = $this->input->post('que_text');
		$assign_id = $this->input->post('assign_id');
		$q_id = $this->input->post('q_id');
		
		$assignment = '';
		if(!empty($q_id) && $q_id != '')
		{
			$assignment = $this->Crud_model->get_single('mlms_assign_que',"q_id = ".$q_id,"que_attachment");
		}
		if( $_FILES['que_attachment']['error']=='0' )
        {
        	if(!empty($assignment))
        	{
        		if(!empty($assignment->que_attachment) && !file_exists("/public/uploads/assignments/question/".$assignment->que_attachment))
        		{
        			unlink(getcwd().'/public/uploads/assignments/question/'.$assignment->que_attachment);
        		}
        	}
            $file_element_name = 'que_attachment';
            $config['upload_path'] = getcwd().'/public/uploads/assignments/question/';
            $config['allowed_types'] = 'jpg|JPG|png|PNG|jpeg|JPEG|gif|GIF|docx|doc|pdf|ppt|xls|xlsx|txt|mp4|mp3|3gp|avi|m4p';
            // $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $error =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
                echo "error";exit;
            }
            $instr_file = $this->upload->data();
            $_POST['que_attachment'] = $instr_file['file_name'];    
        }
        else if(!empty($assignment))
    	{
    		if(!empty($assignment->que_attachment))
    		{
    			$_POST['que_attachment'] = $assignment->que_attachment;
    		}
    	}
	    else{
	    	$_POST['que_attachment'] = '';
	    }
        if(empty($q_id)){
	        $data = array(
	        			'assign_id' => $assign_id,
	        			'que_text' => $que_text,
	        			'que_attachment' => $_POST['que_attachment'],
	        			'created' => date('Y-m-d H:i:s'),
	        			'modified' => date('Y-m-d H:i:s')
	        );
        	$this->Crud_model->SaveData('mlms_assign_que',$data);
        	echo $this->db->insert_id();
        }
        else{
			$data = array(
	        			'assign_id' => $assign_id,
	        			'que_text' => $que_text,
	        			'que_attachment' => $_POST['que_attachment'],
	        			'modified' => date('Y-m-d H:i:s')
	        );
        	$this->Crud_model->SaveData('mlms_assign_que',$data,"q_id = ".$q_id);
        	echo "Updated";
        }
	}

	public function delete_assign()
	{
		$data = array(
				'trash' => 1,
				'modified' => date('Y-m-d H:i:s')
		);
		$this->Crud_model->SaveData('mlms_assignment',$data,"assign_id = ".$this->input->post('id'));
		echo 'assignment deleted';
	}

	public function delete_ques(){
		$q_id = $this->input->post('q_id');
		$data = array(
				'trash' => 1,
				'modified' => date('Y-m-d H:i:s')
		);
		$this->Crud_model->SaveData('mlms_assign_que',$data,"q_id = ".$q_id);
		
	}

	function update_assign($assign_id='')
	{
		$assignment = $this->Crud_model->get_single('mlms_assignment',"assign_id = ".$assign_id);
		$assign_ques = $this->Crud_model->GetData('mlms_assign_que',"","assign_id = ".$assign_id." and trash = 0");
		
		$data = array(
					'updType' => "Save & Continue",
					'heading' => "Edit Assignment",
					'assign_title' => $assignment->assign_title,
					'assign_description' => $assignment->assign_description,
					'assign_instruction' => $assignment->assign_instruction,
					'instruction_videos' => $assignment->instruction_videos,
					'resources_files' => $assignment->resources_files,
					'assign_id' => $assign_id,
					'resource_type' => $type,
					'section_id' => $assignment->section_id,
					'assign_ques' => $assign_ques,
					'course_id' => $assignment->course_id
		);
		$this->template->set_layout('backend');
      	$this->template->title('Assignment');
		$this->template->build('admin/days/create_assignment',$data);
	}

	public function add_ans()
	{
		$ans_text = $this->input->post('ans_text');
		$q_id = $this->input->post('q_id');
		
		$assignment = $this->Crud_model->get_single('mlms_assign_que',"q_id = ".$q_id,"ans_attachment");
		if( $_FILES['ans_attachment']['error']=='0' )
        {
        	if(!empty($assignment->ans_attachment) && !file_exists("/public/uploads/assignments/answer/".$assignment->ans_attachment))
    		{
    			unlink(getcwd().'/public/uploads/assignments/answer/'.$assignment->ans_attachment);
    		}
            $file_element_name = 'ans_attachment';
            $config['upload_path'] = getcwd().'/public/uploads/assignments/answer/';
            $config['allowed_types'] = 'jpg|JPG|png|PNG|jpeg|JPEG|gif|GIF|docx|doc|pdf|ppt|xls|xlsx|txt|mp4|mp3|3gp|avi|m4p';
            // $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $error =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
                echo $error;exit;
            }
            $instr_file = $this->upload->data();
            $_POST['ans_attachment'] = $instr_file['file_name'];    
        }
        else if(!empty($assignment->ans_attachment))
		{
			$_POST['ans_attachment'] = $assignment->ans_attachment;
		}
	    else{
	    	$_POST['ans_attachment'] = '';
	    }
        $data = array(
        			'ans_text' => $ans_text,
        			'ans_attachment' => $_POST['ans_attachment'],
        			'modified' => date('Y-m-d H:i:s')
        );
        $this->Crud_model->SaveData('mlms_assign_que',$data,"q_id = ".$q_id);
        echo "1";
	}
}