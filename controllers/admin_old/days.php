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
	}

	function authenticate()
    {
      $session = $this->session->userdata('loggedin');
     // print_r($session);
      if(!$this->session->userdata('loggedin'))
      {
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
	
	function delete($id = NULL,$parent_id = FALSE)
	{
		

		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This Module has lessons!' ) );
			redirect('admin/section-management/');
		}
		
		//search child items count
		
		elseif ( $this->days_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This Section contains lectures. Please delete lectures first.' ) );
			redirect('admin/section-management/'.$parent_id);
		}

     			
		$isdelete=$this->days_model->deleteItem($id);	
		
		//delete the item
		if ($isdelete) 
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}	

		//if ($category->category_id)
		//redirect('admin/pcategories/'.$category->category_id);
		//else
			redirect('admin/section-management/'.$parent_id);

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

}
	