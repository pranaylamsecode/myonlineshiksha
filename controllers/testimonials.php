<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*session_start();*/
class Testimonials extends MLMS_Controller
{

	function __construct()
	{
		
		parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('commonmethods');
        $this->load->helper('form');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $this->template->set_layout($configarr[0]['layout_template']);
    	
		date_default_timezone_set($configarr[0]['time_zone']);

        $this->load->model('admin/testimonials_model');
        $this->load->library('session');

	}
    public function index()
	{
       $configarr = $this->settings_model->getItems();
       $this->template->set("configarr", $configarr);	   $tmpl = $configarr[0]['layout_template'];
       $this->template->set("tmpl", $tmpl);	   $this->template->build(getOverridePath($tmpl,'testimonials/view','views'));
    }
    public function view()
	{
		redirect();exit;
	   $tid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
       if(!isset($tid) && $tid == ''){
          redirect(base_url());
	    }		$configarr = $this->settings_model->getItems();       $this->template->set("configarr", $configarr);
       $tmpl = $configarr[0]['layout_template'];
       
       $this->template->set("tmpl", $tmpl);
      
       $testimonials = $this->testimonials_model->getFrontItems($tid);
       $this->template->set("testimonials", $testimonials);
       	   $this->template->build(getOverridePath($tmpl,'testimonials/view','views'));
    }
public function alltestimonials()	{	 
 /*$tid = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;  
     if(!isset($tid) && $tid == ''){          redirect(base_url());	    }*/		
	 
	 $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	 
	 $this->load->library('pagination');
	 $config['base_url'] = base_url().'/testimonials/alltestimonials';
	 $config['total_rows'] = $this->testimonials_model->getCount();
	 $config['per_page'] = 10;
	 $this->pagination->initialize($config); 
	 
	 $userinfo = $this->session->userdata('logged_in');  $configarr = $this->settings_model->getItems(); 	 $this->template->set("configarr", $configarr);
     $tmpl = $configarr[0]['layout_template'];
	 //echo"<pre>";
	 //print_r($userinfo);
	 //echo"</pre>";
	 $this->template->set("tmpl", $tmpl);
	 $userid = $userinfo['id'];	
	 $userproupid = $userinfo['groupid'];
	 //$usergroup = $userinfo['group']; 
	 $this->template->set("userid", $userid);  
     $this->template->set("userproupid", $userproupid);
	// $this->template->set("usergroup", $usergroup);  
     $this->load->model('admin/testimonials_model');	
	 $tid = null;   
	 $testimonials = $this->testimonials_model->getFrontItems($tid,10,$start);	
	 $this->template->set("testimonials", $testimonials); 	 $this->template->build(getOverridePath($tmpl,'testimonials/list','views'));
	 
	 }
	function create($parent_id = FALSE)
		{

		$sessionarray = $this->session->userdata('logged_in');

		$user_id = $sessionarray['id'];	
	/* */$this->template->append_metadata(block_submit_button());	
		$parent_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('parent_id', TRUE);	
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : 0;      
		$this->_set_rules();	      
		$configarr = $this->settings_model->getItems();
		$tmpl = $configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		$this->template->set('title', 'Create Testimonial');
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','name', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		if ($this->form_validation->run() === FALSE)	{
		$this->template->build(getOverridePath($tmpl,'testimonials/create','views'));
		}	else	{
		$this->upload_image(); 
		 $imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');  	
		$created_date = date('Y-m-d h:i:s');
		$data = array(	'name' => $this->input->post('name'),
			'description' => $this->input->post('prof_detail'),
			'alias' => $this->input->post('name'),
			'published' => $this->input->post('published'),
		/*'ordering' => $orderingval,*/
			'createdby' => $user_id,
		   	'image' => $imagename,
			'created_date' => $created_date
			         	);
		$this->testimonials_model->insertItems($data);
		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
		redirect('testimonials/alltestimonials');
				}
		/**/}
		function edit($id = FALSE, $parent_id = FALSE)	
		{
			$sessionarray = $this->session->userdata('logged_in'); 
			$user_id = $sessionarray['id'];		
			
			$this->template->append_metadata(block_submit_button());	
		$this->_set_rules();
			//$this->_set_rules('edit');		
			
			$parent_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('parent_id', TRUE);	
			$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;		
			
			//$id2 = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('id', TRUE);	
				$id2 = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('sgmid', TRUE);
			/*redirect if it´s no correct*/			
			if(empty($id2))
				{	

					$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );		
					redirect('testimonials/alltestimonials');		
				}		
				$this->template->title("Edit testimonial");	       
				$configarr = $this->settings_model->getItems();	  
				$tmpl = $configarr[0]['layout_template'];	
				$this->template->set("tmpl", $tmpl);	
				$this->template->set('testimonials', $this->testimonials_model->getFrontItems($id2));	
				$this->template->set('updType', 'edit');	
				$this->template->set('parent_id', $parent_id);		
				$this->template->set('id', $id2);		
				$this->form_validation->set_rules('name', 'name', 'required');		
						
				if ($this->form_validation->run() == FALSE) 
					/* validation hasn't been passed*/		
				{			
					/*load the view and the layout*/
					$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => "validation error" ) );	
					$this->template->build(getOverridePath($tmpl,'testimonials/edit','views'));	

				}			
				else		
					{	$this->upload_image(); 
		 $imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');	
						/*build array for the model*/ 
						      	/*$created_date = date('Y-m-d h:i:s');*/ 

						if($imagename != "temp.jpg")
						{
						$form_data = array(			
							'name' => $this->input->post('name', TRUE ),		
							'description' => $this->input->post('prof_detail', TRUE ),		
							'alias' => $this->input->post('name', TRUE ),			
							'published' => $this->input->post('published'),                	
							'image' => $imagename  	
									
							);
						}
						else
						{
						$form_data = array(			
							'name' => $this->input->post('name', TRUE ),		
							'description' => $this->input->post('prof_detail', TRUE ),		
							'alias' => $this->input->post('name', TRUE ),			
							'published' => $this->input->post('published') 							  	
									
							);	
						}			
						$isupdated=$this->testimonials_model->updateItem($id2,$form_data);		
						if ($isupdated)	/* the information has therefore been successfully saved in the db*/		
							{		
								$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));			
								redirect('testimonials/alltestimonials');		
							}			
							else
							{			/*$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );*/					
							redirect('testimonials/alltestimonials');				
							}	  	
					}	
				}

 public function upload_image()	{
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
 	       			$config['upload_path'] = 'public/uploads/testimonials/img';		  
 	       			$config['allowed_types'] = 'gif|jpg|png';		  
 	       			$config['max_size']  = 1024 * 8;		  
 	       			$config['encrypt_name'] = TRUE;		  
 	       			$config['overwrite'] = TRUE;		  
 	       			$config['file_name'] = $_FILES['orig_name'];          
 	       			$ftpfiles_i = $_FILES['orig_name'];	      
 	       			/*print_r($config);*/		  
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
 	       						/*$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);*/			 
 	       						if($file_id)			 
 	       							{                
 	       								$status = "success";          		
 	       								$msg = "File successfully uploaded";                
 	       								$config = array();        		
 	       								$config['image_library'] = 'gd2';        		
 	       								$config['source_image'] = FCPATH.'public/uploads/testimonials/img/'.$data['file_name'];        		
 	       								$config['new_image'] = FCPATH.'public/uploads/testimonials/img/thumb_56_56/'.$data['file_name'];        		
 	       								$config['create_thumb'] = TRUE;        		
 	       								$config['maintain_ratio'] = FALSE;        		
 	       								$config['master_dim'] = 'width';                
 	       								$config['width'] = 56;                
 	       								$config['height'] = 56;        		
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
 	       							/* echo $_FILES[$file_element_name];*/		  
 	       							@unlink($_FILES[$file_element_name]);	   
 	       						}	   /*echo 'success';*/	  /* echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));*/	   
 	       						//echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));	
 	       					} 

 	       					function delete($id = NULL)	
 	       					{ /*filter & Sanitize $id*/		
 	       						$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;		
 	       						/*redirect if it´s no correct*/		
 	       						if (!$id)
 	       							{			
 	       								$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );			
 	       								redirect('testimonials/alltestimonials');		
 	       							}		
 	       							$isdelete=$this->testimonials_model->deleteItem($id);		
 	       							/*delete the item*/		
 	       							if ($isdelete)		
 	       								{		    
 	       									/*@unlink($_FILES[$file_element_name]);*/			
 	       									$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));		
 	       								}		
 	       								else		
 	       									{			
 	       										$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );		
 	       									}    	
 	       									redirect('testimonials/alltestimonials');	
 	       								}
public function editTestimonial()
{
		$sessionarray = $this->session->userdata('logged_in');

		$user_id = $sessionarray['id'];

		$id = $this->uri->segment(3);

		$this->upload_image(); 
		 $imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');


		$data = array(	
			'name' => 'sachin'
			/*'description' => $this->input->post('prof_detail'),
			'alias' => $this->input->post('name'),
			'published' => $this->input->post('published'),		
			'createdby' => $user_id,
		   	'image' => $imagename*/			
			         	);

		$isupdated=$this->testimonials_model->updateItem($id,$data);
		if($isupdated)
		{
		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
		redirect('testimonials/alltestimonials');
		}
		else
		{
		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );		
		redirect('testimonials/alltestimonials');
		}
	

}

}
?>