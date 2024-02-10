<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonials extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);

	function __construct()
	{
		parent::__construct();
		$this->authenticate();
		$this->load->model('admin/testimonials_model');
		$this->template->set_layout('backend');
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
	  $this->template->set_layout('backend');
	  $parent_id = NULL;
     /* $sess_pcat = $this->session->userdata('sess_pcat');
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
        }*/
       $path=base_url() . "admin/testimonials/index/";
       $baseurl = base_url() . "admin/testimonials/index/";
       $this->load->library('pagination');
       $config['total_rows'] = $this->testimonials_model->getcount();
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 4;
       $start = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Testimonial List');
       $this->template->set("testimonials", $this->testimonials_model->getItems($parent_id,$config['per_page'],$start));
	   $this->template->set("counttesti", $this->testimonials_model->getcount());
	   $this->template->build('admin/testimonials/list');
}
	//Function to Add product category
	
	
	function create($parent_id = FALSE)	
	{	
		$created_date = strtotime(date('Y-m-d h:i:s'));
	    $sessionarray = $this->session->userdata('loggedin');		
	    $user_id = $sessionarray['id'];		
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : 0;

        $this->_set_rules();
		$this->template->set('title', 'Create Testimonial');		$tmpl = 'default';
		$this->template->set('tmpl', $tmpl);		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','name', 'required');
	   	$this->form_validation->set_rules('description', 'description', 'required');
//exit($user_id);
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/testimonials/create');
		}
		else
		{
			 
			 $uploadpath = $this->upload_image();

			 $imagename = ($uploadpath['ftpfilearray']) ? $uploadpath['ftpfilearray'] : $this->input->post('imagename');
             
          
			

           $created_date = date('Y-m-d h:i:s');		 
		   $sessionarray = $this->session->userdata('loggedin');		  
		   $user_id = $sessionarray['id'];
           $data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'alias' => $this->input->post('name'),
			'published' => $this->input->post('published'),
		   'createdby' => $user_id,
		    'image' => $imagename,
            'created_date' => $created_date
		);		
		  				
           $this->testimonials_model->insertItems($data);
    	   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
    	  redirect('admin/testimonials/');
		}
	}
	
	
    function edit($id = FALSE, $parent_id = FALSE)
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
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/testimonials/');
		}
		$this->template->title("Edit testimonial");
		$this->template->set('testimonials', $this->testimonials_model->getItems($id));
		$this->template->set('updType', 'edit');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('id', $id);
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
        //$this->form_validation->set_rules('category_id', 'category', 'required');
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/testimonials/create');
		}
		else
		{
		  $uploadpath = $this->upload_image();
		
		  
		  $imagename = ($uploadpath['ftpfilearray']) ? $uploadpath['ftpfilearray'] : $this->input->post('imagename');
			// build array for the model
            //$created_date = date('Y-m-d h:i:s');
            $form_data = array(
					       	'name' => $this->input->post('name', TRUE ),
					       	'description' => $this->input->post('description', TRUE ),
					       	'alias' => $this->input->post('name', TRUE ),
					       	'published' => $this->input->post('published', TRUE ),
                            'image' => $imagename,
                            //'created_date' => $created_date
						);

			$isupdated=$this->testimonials_model->updateItem($id,$form_data);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('admin/testimonials/'.$parent_id);
			}

			else{

				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				redirect('admin/testimonials/'.$parent_id);
			}
	  	}
	}
	
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
		  $config['upload_path'] = 'public/uploads/testimonials/img';
		  $config['allowed_types'] = 'gif|jpg|png';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['file_i']['name'];
          $ftpfiles_i = $_FILES['file_i']['name'];
	      //print_r($config);
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
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
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
                $config['width'] = 80;
                $config['height'] = 80;
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
	   return array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']);
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
		  $config['upload_path'] = 'public/uploads/testimonials/img/';
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
        		$config['source_image'] = base_url().'public/uploads/testimonials/img/'.$data['file_name'];
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
	
	
    //Function to delete product category
	function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/testimonials/');
		}
		$isdelete=$this->testimonials_model->deleteItem($id);

		//delete the item
		if ($isdelete)
		{
		    //@unlink($_FILES[$file_element_name]);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}
    	redirect('admin/testimonials');

	}
   	/*Function to publish the quiz*/
	public function publish($qid = FALSE){

	$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/testimonials/');
			}
		else{
				$upd_data = array(
					'published' => 1
				);
				$in_ids = $qid;
				$publish=$this->testimonials_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Testimonial published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Testimonial publish action fail or already published!' ) );
				}
				redirect('admin/testimonials');

			}
	}

	/*Function to unpublish the quiz*/
	public function unpublish($qid = FALSE){
		$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/testimonials/');
			}
		else{
				$upd_data = array(
					'published' => 0
				);
				$in_ids = $qid;
				$unpublish=$this->testimonials_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Testimonial unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Testimonial unpublish action fail or already unpublished!' ) );
				}
				redirect('admin/testimonials');

			}
	}

	public function geturl()
	{
		$x =$_POST['x'];
		if(x)
		{
		echo"yes";
		return true;
		}
	}
}