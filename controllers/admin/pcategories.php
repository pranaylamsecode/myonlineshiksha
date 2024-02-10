<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pcategories extends MLMS_Controller {

	protected $before_filter = array();
	function __construct()
	{
		parent::__construct();
		$this->authenticate();
		error_reporting(0);
		$this->load->model('admin/pcategories_model');
		$this->template->set_layout('backend');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';				
        $this->lang->load('tooltip', 'english');
        $this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
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
      	if(isset($_POST['checkval']) && $_POST['checkval']){
	      	$checkval = $_POST['checkval'];
	       	$order = $_POST['order'];
	      	$res = $this->pcategories_model->orderdown($checkval,$order);
	      	if($res){
			   	echo $msg = "success";		}
			else{
				echo $msg ="error";
			}  
		}
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
       	$this->pcategories_model->updateOrder($cid[$i],$data);
		}
      }
	  $this->template->set_layout('backend');
	  $parent_id = NULL;
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
        }
       $path=base_url() . "admin/course-categories/";
       $baseurl = base_url() . "admin/course-categories/";
       $this->load->library('pagination');
       $config['total_rows'] = $this->pcategories_model->getpcatcount($search_string);
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $start = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Course Category List');
       $this->template->set("search_string", $search_string);
       $this->template->set("categories", $this->pcategories_model->getItems($parent_id,$config['per_page'],$start,$search_string));
	   $this->template->set("countpcat", $this->pcategories_model->getcountpcat());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/pcategories/list');
	}

	function create($parent_id = FALSE)
	{
	    $u_data=$this->session->userdata('loggedin');
	    if(($u_data['groupid']=='4'))			
	    {
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
		$this->template->append_metadata(block_submit_button());
		// $parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		// $parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : 0;

        // $this->_set_rules();
        $this->template->title("Create Course Category");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',0);
		$this->template->set('action','create_action');
		
		/*$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','name', 'required');
		if ($this->form_validation->run() === FALSE)
		{*/
			$this->template->build('admin/pcategories/create');
		/*}
		else
		{
		   	$uploadName= $this->upload_image();
			$data5 = json_decode($uploadName,true);  
      		$imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : '';
		   	$cropimagename = ($this->input->post('cropimage')) ? ($this->input->post('cropimage')) : '';	
		   	$maxrow = $this->pcategories_model->maxRow($parent_id);
           	$orderingval = 0;
		   	$orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;
		    $title = strip_tags($this->input->post('name'));
                $titleURL = strtolower(url_title($title));
                $title2 = $titleURL;
                $avail_slug = $this->pcategories_model->match_slug($titleURL,$id);
                $i = 0;
	               if(in_array($titleURL, $avail_slug))
	               {
				    do{
				      $i++;
				      $titleURL = $title2.'-'.$i;
				    } while(in_array($titleURL, $avail_slug));
				  }
           	$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'alias' => $this->input->post('name'),
						'published' => $this->input->post('published'),
						'metatitle' => $this->input->post('metatitle'),
						'metakwd' => $this->input->post('metakwd'),
						'metadesc' => $this->input->post('metadesc'),
						'ordering' => $orderingval,
						'created_by' => $user_id,
						'slug' => $titleURL, 
			            'image' => $cropimagename          //$imagename
			);
           	$this->pcategories_model->insertItems($data);
    	   	$this->session->set_flashdata('message',array('type'=>'success','text'=>lang('web_create_success')));
		   	redirect('admin/course-categories/');
		}*/
		}
		else 
		{ 
	     	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
		   	redirect('admin');
	  	}
	}

	public function create_action()
	{
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		$category_id = $this->input->post('category_id');
		$metatitle = $this->input->post('metatitle');
		$metadesc = $this->input->post('metadesc');
		$metakwd = $this->input->post('metakwd');
		$is_published = $this->input->post('published');
		$newid = $this->input->post('newid');
		if(!empty($newid))
		{
			$getcat = $this->Crud_model->get_single('mlms_category',"id = ".$newid,"image");
		}
		if($is_published == 'true')
		{
			$published = 1;
		}
		else{
			$published = 0;
		}
		$title = strip_tags($this->input->post('name'));
        $titleURL = strtolower(url_title($title));
        $title2 = $titleURL;
        $avail_slug = $this->pcategories_model->match_slug($titleURL,$id);
        $i = 0;
        if(in_array($titleURL, $avail_slug))
        {
		    do{
		      $i++;
		      $titleURL = $title2.'-'.$i;
		    } while(in_array($titleURL, $avail_slug));
		}
		if( $_FILES['imgname']['error']=='0' )
        {
        	if(!empty($newid) && !empty($getcat->image))
			{
				unlink('public/uploads/pcategories/img/'.$getcat->image);
			}
            $file_element_name = 'imgname';
            $config['upload_path'] = getcwd().'/public/uploads/pcategories/img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
            $config['max_size']  = 1024*2;
            $config['width']  = 1024;
            $config['height']  = 768;

            // $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $error =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
                $data = array('error' => $error);
                echo '0';exit;
            }
            $instr_file = $this->upload->data();
            $_POST['imgname'] = $instr_file['file_name'];    
        }
	    else{
	    	$_POST['imgname'] = '';
	    }
		
        $data = array(
        			'name' 			=> $name,
        			'slug' 			=> $titleURL,
        			'alias' 		=> $name,
        			'description' 	=> $description,
        			'image' 		=> $_POST['imgname'],
        			'metatitle' 	=> $metatitle,
        			'metadesc' 		=> $metadesc,
        			'metakwd' 		=> $metakwd,
        			'published' 	=> $published,
        			'created_by' 	=> 1
        );
        if(empty($newid)){
        	$this->Crud_model->SaveData('mlms_category',$data);
        	$last_id = $this->db->insert_id();
	        $data1 = array(
	        			'parent_id' => $category_id,
	        			'child_id' => $last_id
	        );
	        $this->Crud_model->SaveData('mlms_categoryrel',$data1);
        	echo $last_id;
        }else{
        	$this->Crud_model->SaveData('mlms_category',$data,"id = ".$newid);
        	echo "Category Updated";
        }
        
	}

    public function upload_image()
	{
		$date = date('d');
      $month = date('m');
      $year = date('Y');
      $random_no = rand(1000,5000);
      $generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
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
		  $config['upload_path'] = 'public/uploads/pcategories/img';
		  $config['allowed_types'] = 'gif|jpg|png';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
          $ftpfiles_i = $generate.$_FILES['orig_name'];
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
        		$config['source_image'] = FCPATH.'public/uploads/pcategories/img/'.$data['file_name'];
        		$config['new_image'] = FCPATH.'public/uploads/pcategories/img/thumb_232_216/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
				$config['width'] = 251;
                $config['height'] = 142;
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                	$this->image_lib->resize();
                if ( ! $this->image_lib->resize())
				{
				   echo $this->image_lib->display_errors();
				}
                $config['x_axis'] = '0';
				$config['y_axis'] = '0';
               $this->image_lib->clear();
               $this->image_lib->initialize($config);
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
	    $imgupload = json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
		return $imgupload;
	}
	
	function edit($id = FALSE, $parent_id = FALSE)
	{
	    $u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))			
		{
		$this->template->append_metadata(block_submit_button());
		$this->_set_rules('edit');
		$parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
	    $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-categories/');
		}
		$this->template->title("Edit Course Category");
		$this->template->set('category', $this->pcategories_model->getItems($id));
		$this->template->set('updType', 'edit');
		$this->template->set('action', 'update_action');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('id', $id);
		/*$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{*/
			$this->template->build('admin/pcategories/create');
		/*}
		else
		{		
			  $uploadName= $this->upload_image();
			  $data5 = json_decode($uploadName,true);  
      		  $imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : $this->input->post('imagename') ? $this->input->post('imagename') : '';
			$title = strip_tags($this->input->post('slug'));
                $titleURL = strtolower(url_title($title));
                $title2 = $titleURL;
                $avail_slug = $this->pcategories_model->match_slug($titleURL,$id);
                if(!empty($id))
                {
                	$avail_slug = $this->pcategories_model->match_slug($titleURL,$id);
                	if(!empty($avail_slug))
                	{
                		print_r("fail");exit;
                	}
                }
                $i = 0;
	               if(in_array($titleURL, $avail_slug))
	               {
				    do{
				      $i++;
				      $titleURL = $title2.'-'.$i;
				    } while(in_array($titleURL, $avail_slug));
				  }
            $form_data = array(
					       	'name' => $this->input->post('name', TRUE ),
					       	'description' => $this->input->post('description', TRUE ),
					       	'alias' => $this->input->post('name', TRUE ),
					       	'published' => $this->input->post('published', TRUE ),
					       	'slug' => $titleURL,
					       	'metatitle' => $this->input->post('metatitle', TRUE),
							'metakwd' => $this->input->post('metakwd', TRUE),
							'metadesc' => $this->input->post('metadesc', TRUE),
						);
										
			$isupdated=$this->pcategories_model->updateItem($id,$form_data);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('admin/course-categories/'.$parent_id);
			}

			else
			{
				redirect('admin/course-categories/'.$parent_id);
			}
	  	}*/
        }
	    else 
	    {
	        $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'You have not permission to edit' ) );
			redirect('admin');
	    }	  
	}

	public function update_action()
	{
		// print_r($_POST);exit;
		$name = $this->input->post('name');
		$slug = $this->input->post('slug');
		$description = $this->input->post('description');
		$category_id = $this->input->post('category_id');
		$old_image = $this->input->post('old_image');
		$metatitle = $this->input->post('metatitle');
		$metadesc = $this->input->post('metadesc');
		$metakwd = $this->input->post('metakwd');
		$is_published = $this->input->post('published');
		$id = $this->input->post('id');
		
		if($is_published == 'true')
		{
			$published = 1;
		}
		else{
			$published = 0;
		}
		$getcat = $this->Crud_model->get_single('mlms_category',"id = ".$id,"slug");
		if(empty($getcat) || (!empty($getcat) && $slug != $getcat->slug)){
			$title = strip_tags($this->input->post('name'));
	        $titleURL = strtolower(url_title($title));
	        $title2 = $titleURL;
	        $avail_slug = $this->pcategories_model->match_slug($titleURL,$id);
	        $i = 0;
	        if(in_array($titleURL, $avail_slug))
	        {
			    do{
			      $i++;
			      $titleURL = $title2.'-'.$i;
			    } while(in_array($titleURL, $avail_slug));
			}			
		}else{
			$titleURL = $slug;
		}
		if( $_FILES['imgname']['error']=='0' )
        {
        	if(!empty($old_image))
			{
				unlink('public/uploads/pcategories/img/'.$old_image);
			}
            $file_element_name = 'imgname';
            $config['upload_path'] = getcwd().'/public/uploads/pcategories/img/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPG|JPEG|PNG';
            $config['max_size']  = 1024*2;
            $config['width']  = 1024;
            $config['height']  = 768;

            // $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $error =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
                $data = array('error' => $error);
                echo '0';exit;
            }
            $instr_file = $this->upload->data();
            $_POST['imgname'] = $instr_file['file_name'];    
        }
	    else{
	    	$_POST['imgname'] = $old_image;
	    }
        $data = array(
        			'name' 			=> $name,
        			'slug' 			=> $titleURL,
        			'alias' 		=> $name,
        			'description' 	=> $description,
        			'image' 		=> $_POST['imgname'],
        			'metatitle' 	=> $metatitle,
        			'metadesc' 		=> $metadesc,
        			'metakwd' 		=> $metakwd,
        			'published' 	=> $published,
        );
    	$this->Crud_model->SaveData('mlms_category',$data,"id = ".$id);
    	echo "Category Updated";
	}

	function delete()
	{
		$id = $this->input->post('id');
		$pids = $this->pcategories_model->getProgramsByCatId($id);
		$pids2 = $this->pcategories_model->getProgramsByCatId2($id);
		if($pids && $pids2)
		{
			print_r('Any of the Course is assigned under this Category. You cannot delete it.');	
		}
		else
		{
			$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
			if (!$id){
				$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
				print_r("data not found");
			}
			if ( $this->pcategories_model->getchildcount($id) )
			{
				$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This category can not be removed, because it contains either courses or sub categories' ) );
				print_r('This category can not be removed, because it contains either courses or sub categories');
				
			}
			$isdelete=$this->pcategories_model->deletecat($id);
			if ($isdelete) 
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));		
				echo "Category deleted successfully!";
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
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
			 $file_id = true;
            $data = $this->upload->data();
			 $file_id = true;
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
	    echo json_encode(array('filelink' => $config['source_image']));
	}

	function cropcategoryimg()
	{
		$this->load->view('admin/pcategories/cropcategoryimg');
	}

	public function uploadcourseimg()
    {	   
    	$data = $_POST['img']; 
 
    	$img_name = $_POST['img_name'];  
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);
		$capturedate = date("Y-m-d H:i:s");
		$datetime1 = explode(' ',$capturedate);
		$name1 = 'scr_'.$datetime1[0].'_'.$datetime1[1];
		$generate1 = "";
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;
  		$imgnm = explode('.', $_POST['img_name']);
		if($imgnm[0]=='no_images_course' || $imgnm[0]=='no_images_category')
  		{
  			$img_name = '';
  		}
  		if($img_name)
  		{
  			if(@$imgnm[1])
  			{
  				echo $img_name;
  			}else{
  				$img_name = $img_name.'.png';
  			echo $img_name;
  			}
  		}
  		else
  		{
  			$img_name = $generate1.'.png';
  			echo $img_name;
  		}
		$file2 = FCPATH.'public/uploads/pcategories/img/'.$img_name;
		if(file_put_contents($file2, $data))//for upload file to the server
		{
				$status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/pcategories/img/'.$img_name;
        		$config['new_image'] = FCPATH.'public/uploads/pcategories/img/thumb_232_216/'.$img_name;
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 290;
                $config['height'] = 162;
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $config['x_axis'] = '0';
				$config['y_axis'] = '0';
		}
		$course_id = $this->uri->segment(4);		
		if($this->uri->segment(5) == 'categoryedit')
		{
		$form_data =  array(						
					'image' => $img_name						
					);
 		$this->pcategories_model->updatecropItem($course_id,$form_data);
 	   }
    }

    function createcategory()
	{
		$this->load->view('admin/pcategories/createcoursecategories');
	}

	function cropcategoryimgpop()
	{
		$this->load->view('admin/pcategories/cropcategoryimgpop');
	}

	public function uploadcourseimgpop()
    {
    	$data = $_POST['img'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);
		$capturedate = date("Y-m-d H:i:s");
		$datetime1 = explode(' ',$capturedate);
		$name1 = 'scr_'.$datetime1[0].'_'.$datetime1[1];
		$generate1 = "";
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;
  		echo $generate1 . '.png';
		$file2 = FCPATH.'public/uploads/pcategories/img/'.$generate1.'.png';
		if(file_put_contents($file2, $data))//for upload file to the server
		{
				$status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/pcategories/img/'.$generate1.'.png';
        		$config['new_image'] = FCPATH.'public/uploads/pcategories/img/thumb_232_216/'.$generate1.'.png';
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 290;
                $config['height'] = 162;
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $config['x_axis'] = '0';
				$config['y_axis'] = '0';
		}
		$course_id = $this->uri->segment(4);	
    }


    function savecategory()
	{
	 	$program_name = $this->input->post('name');
	 	$program_description = $this->input->post('description');
	 	$program_category_id = $this->input->post('category_id');
	 	$program_published = $this->input->post('published');	
	 	$u_data=$this->session->userdata('loggedin');
	    if(($u_data['groupid']=='4'))			
	    {
        	$sessionarray = $this->session->userdata('loggedin');
        	$user_id = $sessionarray['id'];
	   		$cropimagename = ($this->input->post('nameimg')) ? ($this->input->post('nameimg')) : 'no_images_category.jpg';
	   		$maxrow=null;
           	$orderingval = 0;
		   	$orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;
           	$data = array(
						'name' => $program_name,
						'description' => $program_description,
						'alias' => $program_name,
						'published' => $program_published,
						'ordering' => $orderingval,
						'created_by' => $user_id,
			            'image' => $cropimagename         
			);
        	$rs = $this->pcategories_model->insertItemspop($data);
	   		echo $rs;
	 	}
	}

	 function assigncategory()
	 {
	 	  $newId =$_POST['newId'];
	 	  $oldId =$_POST['oldId'];	 	 
	 	  $rs = $this->pcategories_model->updateAssignCategory($oldId,$newId);
	 	  echo $rs;
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
		$publish=$this->pcategories_model->publish_unpublishItem($in_ids,$upd_data);
		if($published==1)
		{
			echo 'Course category published successfully!';
		}
		else
		{
			echo 'Course category unpublished successfully!';
		}
	}

	public function check_dup()
	{
		$slug = $this->input->post('slug');
		$id = $this->input->post('id');
		
		$get_res = $this->pcategories_model->match_slug($slug,$id);
		if(!empty($get_res))
		{
			print_r("0");
		}
		else
		{
			print_r("1");
		}
	}
}