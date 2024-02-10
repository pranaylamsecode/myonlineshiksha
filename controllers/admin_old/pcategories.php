<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pcategories extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);
	
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
     // print_r($session);
      if(!$this->session->userdata('loggedin'))
      {
       redirect('admin/users/login');
      }
    }

     public function index($parent_id = NULL)
	{
     // print_r($_POST); exit;
      //if(isset($_POST['task']) || $_POST['task']=='orderdown' ){
      if(isset($_POST['checkval']) && $_POST['checkval']){
      $checkval = $_POST['checkval'];
       //	$id = $checkval["0"];
       $order = $_POST['order'];
      $res = $this->pcategories_model->orderdown($checkval,$order);
     // print_r($res);
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
        //print_r($_POST);
      $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_pcat['searchterm'];
       $searchdata = array(
				 "searchterm" => $search_string
				 );
	   $this->session->set_userdata('sess_pcat', $searchdata);
        }
       $path=base_url() . "admin/course-categories/";
       $baseurl = base_url() . "admin/course-categories/";
       $this->load->library('pagination');
       //$config['total_rows'] = $this->mcategories_model->getmcatcount($search_string,$search_cat,$search_type);
       $config['total_rows'] = $this->pcategories_model->getpcatcount($search_string);
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $start = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Course Category List');
       $this->template->set("search_string", $search_string);
       //$this->template->set("categories", $this->mcategories_model->getItems($parent_id));
       $this->template->set("categories", $this->pcategories_model->getItems($parent_id,$config['per_page'],$start,$search_string));
	   $this->template->set("countpcat", $this->pcategories_model->getcountpcat());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/pcategories/list');
}
	//Function to Add product category
	function create($parent_id = FALSE)
	{
	    $u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))			
	    {
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : 0;

        $this->_set_rules();
        $this->template->title("Create Course Category");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','name', 'required');
		//$this->form_validation->set_rules('category_id', 'category', 'required');
        //$maxrow = $this->pcategories_model->maxRow($parent_id);
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/pcategories/create');
		}
		else
		{           
		
		   //$this->upload_image();
		   $uploadName= $this->upload_image();
			  $data5 = json_decode($uploadName,true);  
      		  $imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : 'big-image-default.jpg';	
		   //$imagename = NULL;
		   //$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : 'no_images.jpg' ;
		   $cropimagename = ($this->input->post('cropimage')) ? ($this->input->post('cropimage')) : 'no_images.jpg';	
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
			'ordering' => $orderingval,
			'created_by' => $user_id,
            'image' => $cropimagename,
            'slug' => $titleURL,          //$imagename
		);
           $this->pcategories_model->insertItems($data);
    	   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
    	   //redirect('admin/pcategories/'.$parent_id);
		   redirect('admin/course-categories/');
		}
	  }
	  else 
	  { 
	     $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
    	   //redirect('admin/pcategories/'.$parent_id);
		   redirect('admin');
	  }
	}

    //Function to upload images
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
        		$config['source_image'] = FCPATH.'public/uploads/pcategories/img/'.$data['file_name'];
        		$config['new_image'] = FCPATH.'public/uploads/pcategories/img/thumb_232_216/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
        		//$config['quality'] = "100%";
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
				

				// if ( ! $this->image_lib->crop())
				// {
				//    echo $this->image_lib->display_errors();
				// }
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
	    $imgupload = json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
		return $imgupload;
	}
	
	
    //Function to edit product category
	function edit($id = FALSE, $parent_id = FALSE)
	{
	    $u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))			
		{
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
		//Rules for validation
		$this->_set_rules('edit');
		//get the parent id and sanitize
		$parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
		$id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
	    $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-categories/');
		}
		$this->template->title("Edit Course Category");
		$this->template->set('category', $this->pcategories_model->getItems($id));
		$this->template->set('updType', 'edit');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('id', $id);
		$this->form_validation->set_rules('name', 'name', 'required');
        //$this->form_validation->set_rules('category_id', 'category', 'required');
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/pcategories/create');
		}
		else
		{           
			// build array for the model	
			$this->load->helper('security');
			$this->load->library('form_validation');	
			  $uploadName= $this->upload_image();
			  $data5 = json_decode($uploadName,true);  
      		  $imagename = $data5['ftpfilearray'] ? $data5['ftpfilearray'] : $this->input->post('imagename');

			//$imagename = null;
			//$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : $this->input->post('imagename') ;
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
    
            $form_data = array(
					       	'name' => $this->input->post('name', TRUE ),
					       	'description' => $this->input->post('description', TRUE ),
					       	'alias' => $this->input->post('name', TRUE ),
					       	'published' => $this->input->post('published', TRUE ),
					       	'slug' => $titleURL,
                            //'image' => $imagename
						);
										
			$isupdated=$this->pcategories_model->updateItem($id,$form_data);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('admin/course-categories/'.$parent_id);
			}

			else
			{
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				redirect('admin/course-categories/'.$parent_id);
			}
	  	}
        }
	    else 
	    {
	        $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'You have not permission to edit' ) );
			redirect('admin');
	    }	  
	}

	//Function to delete product category
	function delete($id = NULL)
	{
		$pids = $this->pcategories_model->getProgramsByCatId($id);
		$pids2 = $this->pcategories_model->getProgramsByCatId2($id);
		if($pids && $pids2)
		{
		?>
		<script>
			alert('Any of the Course is assigned under this Category. You cannot delete it.');
			document.location.href = window.location.origin+'/admin/course-categories/';
		</script>
		<?php
		}
		else
		{
			//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/course-categories/');
		}
		
		//search the item to delete
		
		if ( $this->pcategories_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This category can not be removed, because it contains either courses or sub categories' ) );
			redirect('admin/course-categories/');
		}
		
		
		$isdelete=$this->pcategories_model->deletecat($id);
		
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
			redirect('admin/course-categories');
		}
	}

	/*function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/pcategories/');
		}
		
		//search the item to delete
		
		if ( $this->pcategories_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This category can not be removed, because it contains either courses or sub categories' ) );
			redirect('admin/pcategories/');
		}
		
		
		$isdelete=$this->pcategories_model->deletecat($id);
		
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
			redirect('admin/pcategories');

	} */

   	/*Function to publish the quiz*/
	public function publish($qid = FALSE){

	$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/course-categories/');
			}
		else{
				$upd_data = array(
					'published' => 1
				);
				$in_ids = $qid;
				$publish=$this->pcategories_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course category published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course category publish action fail or already published!' ) );
				}
				redirect('admin/course-categories');

			}
	}

	/*Function to unpublish the quiz*/
	public function unpublish($qid = FALSE){
		$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/course-categories/');
			}
		else{
				$upd_data = array(
					'published' => 0
				);
				$in_ids = $qid;
				$unpublish=$this->pcategories_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course category unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course category unpublish action fail or already unpublished!' ) );
				}
				redirect('admin/course-categories');

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

	function cropcategoryimg()
	{
		//exit('yes');
		$this->load->view('admin/pcategories/cropcategoryimg');
	}

	public function uploadcourseimg()
    {		
      
    	$data = $_POST['img'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);		
		
		//$folder = $this->session->userdata("shot_upload_folder_name");
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
			//executed
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
		
		if($this->uri->segment(5) == 'categoryedit')
		{

		$form_data =  array(						
					'image' => $generate1.".png"						
					);
 		$this->pcategories_model->updatecropItem($course_id,$form_data);

 	   }
 	     	   
		
    }

    function createcategory()
	{
		//exit('yes');
		$this->load->view('admin/pcategories/createcoursecategories');
	}

	function cropcategoryimgpop()
	{
		//exit('yes');
		$this->load->view('admin/pcategories/cropcategoryimgpop');
	}


	public function uploadcourseimgpop()
    {		
      //exit('yes');
    	$data = $_POST['img'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);		
		
		//$folder = $this->session->userdata("shot_upload_folder_name");
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
			//executed
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
		//exit('yesss');
	 $program_name = $this->input->post('name');
	 $program_description = $this->input->post('description');
	 $program_category_id = $this->input->post('category_id');
	 $program_published = $this->input->post('published');	
	   

	 	$u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))			
	    {
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];

	   $cropimagename = ($this->input->post('nameimg')) ? ($this->input->post('nameimg')) : 'no_images.jpg';	
		   //$maxrow = $this->program_model->maxRow($parent_id);
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

    
}