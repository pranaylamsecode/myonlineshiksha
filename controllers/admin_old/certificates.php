<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Certificates extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);

	function __construct()
	{
		parent::__construct();
		$this->authenticate();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->model('admin/certificates_model');
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
     public	function index_org()
		{
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
         $this->template->build('admin/certificates/certificates');
        }
    
    public function index()
	{
		// if($_POST){
		// 	print_r($_POST);
		// }
		$this->template->append_metadata(block_submit_button());
        $this->load->model('admin/medias_model');
		$this->_set_rules('edit');
		$this->template->title("Certificate Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
        $this->template->set('ftpimage',$this->medias_model->fileslist('public/uploads/certificates', 'image'));
        foreach ($_FILES as $index => $value)
 		{
          	if ($value['name'] != '')
			{
				$this->load->library('upload');
		        $this->upload->initialize($this->set_upload_options('settings'));
                //upload the image
				if ( ! $this->upload->do_upload($index))
				{
					//exit('aaaa');
                    $this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
					//load the view and the layout
				    $this->template->build('admin/certificates/certificates');

					return FALSE;
				}
				else
				{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();
						//Save the name an array to save on BD before
						$form_data_aux[$index] = $info_upload["file_name"];
						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
					   	//$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'settings'));//comm. by yoyo

						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));
							$this->template->build('admin/certificates/certificates');
							return FALSE;
						}
				}
			}
		}
        $result = $this->certificates_model->getItems();

        $this->medias_model->fileslist('public/uploads/audio', 'audio');
	    extract($result[0]);
       // $a = htmlentities($templates1);
       // $b = html_entity_decode($templates1);
       // print_r(html_entity_decode($templates1));exit;
        //$design_background ="";
        $this->template->set('id', $id);
        $this->template->set('design_background', $design_background);
        $this->template->set('design_background_color', $design_background_color);
        $this->template->set('design_text_color', $design_text_color);
        $this->template->set('font_certificate', $font_certificate);
        $this->template->set('templates1', $templates1);
        $this->template->set('templates2', $templates2);
        $this->template->set('templates3', $templates3);
        $this->template->set('templates4', $templates4);
        $this->template->set('subjectt3', $subjectt3);
        $this->template->set('subjectt4', $subjectt4);
        $this->form_validation->set_rules('st_donecolor2', 'st_donecolor2 ', 'required');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/certificates/certificates');
		}
		else
			{

            $form_data = array(
			'design_background' => $this->input->post('imagename'),
			'design_background_color' =>'#FFFFFF',           //$this->input->post('st_donecolor1'),
			'design_text_color' => $this->input->post('st_donecolor2'),
			'font_certificate' => $this->input->post('font'),
			'templates1' => stripslashes($this->input->post('templates1')),
		   	'templates2' => stripslashes($this->input->post('templates2')),
		   	'templates3' => stripslashes($this->input->post('templates3')),
		   	'templates4' => stripslashes($this->input->post('templates4')),
		   	'subjectt3' => $this->input->post('subjectt3'),
		   	'subjectt4' => $this->input->post('subjectt4')
			);
          // print_r($form_data);
           $isupdated=$this->certificates_model->updateItem($form_data);
           if ($isupdated) // the information has therefore been successfully saved in the db
  		    {
  		     redirect('admin/certificates');
            }else{

			 redirect('admin/certificates');
			}
           }
        }


function upload_media()
    {  
       	
		$newfilename =0;	 
    	$media_type = 'Image';

    	if($media_type =='Image')
    	{
		$output_dir = FCPATH."public/uploads/settings/img/";
		$whitelist = array('jpg', 'jpeg', 'png');
		}

		$name      = null;
		$error     = 'No file uploaded.';

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
									$error = 'success';
								}
							}
						}
					}

				
					echo json_encode(array('status' => $error, 'msg' => $error, 'ftpfilearray' => $newfilename));
					die();   
			
		
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
		  $config['upload_path'] = 'public/uploads/settings/img';
		  $config['allowed_types'] = 'gif|jpg|png';
		  $config['max_size']  = 1024 * 8;
		  $config['min_width'] = '800';
		  $config['min_height'] = '600';
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
        		$config['source_image'] = FCPATH.'public/uploads/settings/img/'.$data['file_name'];
        		$config['new_image'] = FCPATH.'public/uploads/settings/img/thumbs/'.$data['file_name'];
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
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	}
    private function set_upload_options($controller)
	{
		//upload an image options

		$config = array();
		$config['upload_path'] = base_url().'public/uploads/'.$controller.'/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']	= TRUE;
		$config['min_width']  = '800';
		$config['min_height']  = '600';

		//create controller upload folder if not exists
		if (!is_dir($config['upload_path']))
		{
			mkdir(base_url()."public/uploads/$controller/");
			mkdir($config['upload_path']);
			mkdir($config['upload_path']."thumbs/");
		}
      // print_r($config);
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
		$config['min_width']  = '800';
		$config['min_height']  = '600';
		$config['thumb_marker'] = '';

		return $config;
	}

    function delete($id = NULL)
		{
			//filter & Sanitize $id
			$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

			//redirect if it´s no correct
			if (!$id){
				$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
				redirect('admin/certificates/certificates');
			}

			$isdelete=$this->certificates_model->deleteItem($id);

			//delete the item
			if ($isdelete)
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
			}

				redirect('admin/certificates/certificates');

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

}