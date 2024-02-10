<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Templates extends MLMS_Controller {

	protected $before_filter = array(
	);
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate();
        $this->load->helper('url');
        $this->load->helper('form');
        //$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('ckeditor');
		$this->load->model('admin/settings_model');
        $this->load->model('admin/Templates_model');
        $this->load->model('admin/medias_model');
        $this->load->model('admin/certificates_model');

        $this->load->model('admin/programs_model');
        $this->load->model('admin/subplans_model');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';				
        $this->lang->load('tooltip', 'english');

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
	        $this->template->set_layout('backend');
	        $this->template->title('Manage Templates');

            $allpages=$this->Templates_model->getTemplates();
            $this->template->set('templates',$allpages);

            $this->template->build('admin/templates/list2'); //orginal page is 'list' it has change list2
	}

   
	
	public function addlayout()
		    {
		    	
		    	$this->template->title("Add Template");
				$this->template->set('title', "Layout Settings");
				$this->template->set('updType', 'save');
				$this->template->build('admin/templates/addlayout.php');
		    }
		    public function layout_upload($value='')
		    {
		    	$filename = $_FILES['file_i']['name'];
		    	if (empty($filename)) {
		    		echo json_encode(array('status' => 'error', 'msg' => 'File can not be empty!.', 'ftpfilearray' => ''));
		    	}
		    	if ($_FILES['file_i']['type'] == 'application/x-rar-compressed' || $_FILES['file_i']['type'] == 'application/octet-stream' || $_FILES['file_i']['type'] == 'application/zip' || $_FILES['file_i']['type'] == 'application/octet-stream') {
		    		$filepath = 'temp/';
						if(move_uploaded_file($_FILES['file_i']["tmp_name"],$filepath.$filename)) {
						echo json_encode(array('status' => 'success', 'msg' => 'Template uploaded successfully!', 'ftpfilearray' => $filename ));	
						}
						else
						{
							echo json_encode(array('status' => 'error', 'msg' => 'File uploading fail.', 'ftpfilearray' => $filename));
						}
						
					} else {
						echo json_encode(array('status' => 'error', 'msg' => 'File is not in zip formate.', 'ftpfilearray' => $filename));
					}
		    }
		    public function layout_install()
		    {
		    	if ($_POST['filename']) {
					$filename = trim($_POST['filename']); 		
					/*if (!file_exists('temp/'.$filename.'.zip')) {
						echo json_encode(array('status' => 'error', 'msg' => 'uploaded zip not found file not found', 'ftpfilearray' => $filename));
						exit;
					}*/
					$zip = new ZipArchive;
					$this->load->helper('commonmethods');
					$res = $zip->open('temp/classic.zip');
					if ($res === TRUE) {
					  $zip->extractTo('temp/');
					  $zip->close();
					 
					  if (file_exists("temp/layoutDetails.xml")) {
					  	$xml=simplexml_load_file("temp/layoutDetails.xml");
						
						$layoutName = (string)$xml->name;
						$layoutName = trim($layoutName);
						
						$layoutdirectory = (string)$xml->layoutdirectory;
						$layoutdirectory = trim($layoutdirectory);

						$templatedirectory = (string)$xml->templatedirectory;
						$templatedirectory = trim($templatedirectory);

						$publicdirectory = (string)$xml->publicdirectory;
						$publicdirectory = trim($publicdirectory);
						
						if (file_exists('application/views/layouts/'.$layoutName.'.php') || file_exists('application/views/layouts/'.$layoutName.'Options.xml') ) {
							echo json_encode(array('status' => 'error', 'msg' => $layoutName.' template already found.', 'ftpfilearray' => $filename));
							exit();
						}else{
							if (file_exists('temp/'.$layoutdirectory.$layoutName.'.php') && file_exists('temp/'.$layoutdirectory.$layoutName.'Options.xml') ) {
							rename('temp/'.$layoutdirectory.$layoutName.'.php', 'application/views/layouts/'.$layoutName.'.php');
							rename('temp/'.$layoutdirectory.$layoutName.'Options.xml', 'application/views/layouts/'.$layoutName.'Options.xml');
							} else {
							echo json_encode(array('status' => 'error', 'msg' => 'Some files not found in '.$layoutName.' template.', 'ftpfilearray' => $filename));
							exit();	
							}
						}
						$source = 'temp/'.$templatedirectory;
						$dest = 'application/views/template/'.$layoutName;
						if(smartCopy($layoutName,$source, $dest)){

						}else{
							echo json_encode(array('status' => 'error', 'msg' => $layoutName.' template seems to be duplicate.', 'ftpfilearray' => $filename));
							exit();	
						}
						$source = 'temp/'.$publicdirectory;
						$dest = 'public/'.$layoutName;
						if(smartCopy($layoutName,$source, $dest)){

						}else{
							echo json_encode(array('status' => 'error', 'msg' => $layoutName.' template seems to be duplicate.', 'ftpfilearray' => $filename));
							exit();	
						}
						$themes = (array)$xml->themes;
						$themes = $themes['theme'];
						$temparray = $this->Templates_model->getTemplateByname($layoutName);
						if (!empty($temparray)) {
							echo json_encode(array('status' => 'error', 'msg' => $layoutName.' template already exist.', 'ftpfilearray' => $filename));
							exit();
						}
						$dataArray = array(
									'name' => $layoutName, 
									'type' => 'template',
									'parent' => '0',
									'options' => '' );
						$insertid = $this->Templates_model->insertLayout($dataArray);
						foreach ($themes as $key => $theme) {
							$dataArray = array(
									'name' => $theme, 
									'type' => 'theme',
									'parent' => $insertid,
									'options' => '' );
							$this->Templates_model->insertLayout($dataArray);
						}
						echo json_encode(array('success' => 'error', 'msg' => 'Template successfully installed.', 'ftpfilearray' => $filename));

					  } else {
					  	echo json_encode(array('status' => 'error', 'msg' => 'layoutDetails.xml file not found', 'ftpfilearray' => $filename));
					  }
					  
					  
					} else {
					 echo json_encode(array('status' => 'error', 'msg' => 'Can not extract file.', 'ftpfilearray' => $filename));
					}

		    	} else {
		    		 echo json_encode(array('status' => 'error', 'msg' => 'zip not found..', 'ftpfilearray' => ''));
		    	}
		    	
		    }

     public function courselist($queid = NULL)
	{  
         $no_of_courses = $this->uri->segment(4);
         
		//$this->template->set_layout('backend');
		$this->template->title('Courses Add List');
        $this->template->set('updType', 'create');
        $this->template->set('no_of_courses', $no_of_courses);
       
        $sess_quizlist = $this->session->userdata('sess_quizlist');

        $this->template->title('Courses List'); //new code here

        //if($this->input->post('reset') == 'Reset')

	if(!empty($_POST['submit_search']))
        {
        	$search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_quizlist['searchterm'];

       		$searchdata = array(
				 "searchterm" => $search_string
				 );
	   		$this->session->set_userdata('sess_courselist', $searchdata);
	   		$this->template->set("courses",$this->Templates_model->getCourseNew2($queid,$search_string));        	
        	
      	}
      	else
      	{
       		$search_string = $this->input->post('search_text', TRUE);
        	$this->session->unset_userdata('sess_courselist');
        	$search_string = '';
        	//$this->template->set("courses",$this->Templates_model->getCoursesNew($queid,$search_string));
        	$this->template->set("courses",$this->Templates_model->getCoursesNewww($queid,$search_string));
       	}

       	//$this->template->title('Questions List');
	    //$this->template->set("questions",$this->quizzes_model->getQuestionsNew($queid,$search_string));

		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/templates/courselist');

        if($this->input->post('submit'))
        {
	        $courseid = $this->input->post('cb');
	        $course_ids = implode(',',$courseid);
	        $data = array(
	            'qid' => '0',
				'quizzes_ids' => ",$quizzes_ids",
				'published' => $this->input->post('published')
			);
	        if($this->quizzes_model->insertFinalQuizzes($data))
	        {
	            if($qid){ ?>
	    				<script type="text/javascript">

	    				window.parent.location.href = "<?php echo base_url(); ?>admin/home-page/design-options/45/";
	    				</script>
						<?php }else{ ?>
						<script type="text/javascript">
	      				window.parent.location.href = "<?php echo base_url(); ?>admin/home-page/design-options/45/";
	      				</script><?php
						}
			 		?>

	        	 <?php
			}
		}
	}


    public function editoptions()
    { 
    	
		ini_set('display_errors', '1');
        $this->template->set_layout('backend');
	    $this->template->title('Template options');
        $this->template->set('updType',"edit");
        $this->load->helper('commonmethods');
        $pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('id')));

        $templateData = $this->Templates_model->getTemplateById($pid);
		$this->template->set('alllayouts',$this->settings_model->getallLayouts());
        $this->template->set('settings',$this->settings_model->getItems());
        $this->template->set('templateData',$templateData);
        $this->template->set('id',$pid);
        $templateOptions = json_decode($templateData[0]['options']);

        $result = $this->settings_model->getItems();
        
		extract($result[0]);      
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
		$this->template->set('signature', $signature);

        $this->template->set('templateOptions',$templateOptions);
        if(file_exists('application/views/layouts/'.$templateData[0]['name'].'Options.xml')) {
	        $templatename = 'application/views/layouts/'.$templateData[0]['name'].'Options.xml';
	        $templatefields = getTemplatefields($templatename);
	        $this->template->set('templatefields',$templatefields);
        }
        else{
        exit('Template option File not found');
        }
	
        $rules = array();
        $filefields = array();
        foreach ($templatefields as $key => $templatefield) {
        	$i = 0;
        		foreach ($templatefield as $fields) {
        			
        			if ($fields['type'] =='file') {
        				$filefields[$key][$i] = array('name' => $fields['name'] ,'filetypes' => $fields['allowedfiles'] );;
        				$i++;
        			}
        			if (isset($fields['rule']) && $fields['rule'] == 'required') {
		           		$fieldname = ($fields['type'] =='file') ? $fields['name'] : trim($key).'['.$fields['name'].']';
		           		$rules[] = array(
		                     'field'   => $fieldname, 
		                     'label'   => $fields['label'], 
		                     'rules'   => $fields['rule']
		                  );
		           	}
           		}
           }

            $this->form_validation->set_rules($rules);
            
         	$data = $this->input->post();
         	$this->template->set('postdata',$data);  
         	unset($data['submit']);
         		

            if ($this->form_validation->run() == FALSE)
		    {
		       $this->template->build('admin/templates/options');
		    }
		    else
		    {
// print_r($_POST); exit('44');
		    	 $bdata = $this->upload_banner();	

		    	 	 
		       
			    
			   $bannername = ($bdata['ftpfilearray_banner']) ? $bdata['ftpfilearray_banner'] : $this->input->post('bannername');
			        	
				
				 $ldata = $this->upload_image();		
		       
		    
			   
				$imagename = ($ldata['ftpfilearray_image']) ? $ldata['ftpfilearray_image'] : $this->input->post('imagename');

				$fdata = $this->upload_favicon();           

		    	

				
				$faviconame = ($fdata['ftpfilearray_fav']) ? $fdata['ftpfilearray_fav'] : $this->input->post('favname');
                $logoimage = $imagename;
                $layouttemplate = 'classic';	
                 $layout_theme = $this->input->post('layouttemplate');	
                 if($layout_theme)
                $layoutstyle = $layouttheme = $this->input->post('layouttheme');
            	else
                $layoutstyle = $layouttheme = 'blue.css';

                $universitytitle = $this->input->post('menu_title');
                $banneTitle = $this->input->post('banneTitle') ? $this->input->post('banneTitle') : '' ;
                $totalcourse = $this->input->post('total_course') ? $this->input->post('total_course') : 3 ;
				$institutename = $this->input->post('insti_title');
				$tagline_font = $this->input->post('tagline_font') ? $this->input->post('tagline_font') :'';
				$tagline_font_size = $this->input->post('tagline_font_size') ? $this->input->post('tagline_font_size') :'';
				$tagline_font_color = $this->input->post('tagline_font_color') ? $this->input->post('tagline_font_color') :'';
				$meta_title = $this->input->post('meta_title');
				$meta_desc = $this->input->post('meta_desc');
				$meta_keyword = $this->input->post('meta_keyword');

				$form_data =  array(					
					//'logoimage' => $logoimage,					
					'layouttheme' => $layoutstyle,	
					//'bannerimage' => 
					'layout_template' => $layouttemplate,
					'univer_title' => $universitytitle,
					'banneTitle' =>	$banneTitle,	
					'course_total' => $totalcourse,
					'course_ids' => $ids,
					//'favicon' => $faviconame,
					'institute_name' => $institutename,
					'tagline_font' => $tagline_font,
					'tagline_font_size' => $tagline_font_size,
					'tagline_font_color' => $tagline_font_color,
					'meta_title' => $meta_title,	
					'meta_desc' => $meta_desc,	
					'meta_keyword' => $meta_keyword		
					);


				$this->settings_model->updateItem($form_data);
				
		    	$fileresponses = array();
         		$filepath = 'public/'.$templateData[0]['name'].'/images/';
				$templateOptions = (array)$templateOptions ;
         		foreach ($filefields as $key => $value) {
         			foreach ($value as $filefield) {
         				$filename = $_FILES[$filefield['name']];
         				$date = date('d');
  						$month = date('m');
  						$year = date('Y');
  						$random_no = rand(1000,5000);
  						$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
         				if(!empty($filename['name'])){
							if (($_FILES[$filefield['name']]["type"] == "image/gif") || ($_FILES[$filefield['name']]["type"] == "image/jpeg") || ($_FILES[$filefield['name']]["type"] == "image/png")) {
								if(move_uploaded_file($_FILES[$filefield['name']]["tmp_name"],$filepath.$generate)) {
								$data[$key][$filefield['name']] = $filepath.$generate; //$_FILES[$filefield['name']]["name"];					
								}
							}else{
							
							}
						}
						else
						{
							if($_POST['slide_image1'])
							{
								$data['slider']['slide_image1'] = $data['slide_image1'];
							}
							if($_POST['slide_image2'])
							{
								$data['slider']['slide_image2'] = $data['slide_image2'];
							}
							if($_POST['slide_image3'])
							{
								$data['slider']['slide_image3'] = $data['slide_image3'];
							}
							if($_POST['slide_image4'])
							{
								$data['slider']['slide_image4'] = $data['slide_image4'];
							}
							if($_POST['bg_image4'])
							{
								$data['slider']['bg_image4'] = $data['bg_image4'];
							}


							//$tpl_opt = (array)$templateOptions[$key];
							//$data[$key][$filefield['name']] = $tpl_opt[$filefield['name']];		
						}
         				
         			}
         		}
				
			   
		    	$jsonoptions = json_encode($data);
		    	// echo"<pre>";
		    	// print_r($jsonoptions);exit();
			    $qid = $data['id'];
			    $form_data = array('options' => $jsonoptions, );
		    	$this->Templates_model->updateItem($qid,$form_data);

		    	if($_POST['widget'] == 'widget')
		    	{
		    			redirect('admin/widgets/index');
		    	} 
		    	else if($_POST['testinomial'] == 'testinomial')
		    	{
		    		redirect('admin/testimonials');
		    	}
		    	else if($_POST['sociallink'] == 'sociallink')
		    	{
		    		redirect('admin/sociallinks/createLink');
		    	}

                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Template options updated successfully..' ));
               	
               	redirect('admin/home-page/design-options/45');

	        }

    }

     

     public function saveData()
     {
          $acadname = $_POST['acadname'];
		  $themecolor = $_POST['themecolor'];

		 $form_data =  array(					
						
					'layouttheme' => $themecolor,					
					'institute_name' => $acadname
					
					);

		  $this->settings_model->updateItem($form_data);

		  $fromname = $_POST['fromname'];		
		  $signature = $_POST['signature'];

		  $frmdata =  array(
					'fromname' => $fromname,				
					'signature' =>$signature
				);

		  $this->settings_model->updateItem($frmdata);

		  echo 'success';
     }


	
	 public function upload_image()
	{
		$generate = "";
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(5000,9000);
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;

		$fileexist = file_exists(FCPATH.'public/uploads/settings/img/logo/'.$generate);
		if($fileexist)
		{
			$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(5000,9000);
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;

		}
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
		  $config['upload_path'] = 'public/uploads/settings/img/logo';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = FALSE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
          $ftpfiles_i = $generate.$_FILES['orig_name'];
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
            $data_image = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data_image['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   
	   //json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	   return (array('status' => $status, 'msg' => $msg, 'ftpfilearray_image' => $data_image['file_name']));
	}

	public function upload_image_old()
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
		  $config['upload_path'] = 'public/uploads/settings/img/logo';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
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

      	  $config['source_image'] = FCPATH.'public/uploads/settings/img/logo/'.$data['file_name'];

      		//$config['new_image'] = FCPATH.'public/uploads/questions/img/thumbs/'.$data['file_name'];
  			
  			  $config['create_thumb'] = TRUE;

      		$config['maintain_ratio'] = FALSE;

      		$config['master_dim'] = 'width';

          $config['width'] = 164;

          $config['height'] = 44;

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
	   json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	}
	public function upload_favicon()
	{
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(10000,15000);
  		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file_f';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/settings/img/logo';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = FALSE;
		  $config['file_name'] = $generate.$_FILES['orig_name'];
          $ftpfiles_i = $generate.$_FILES['orig_name'];
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
            $data_favicon = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
				$config = array();

      		$config['image_library'] = 'gd2';

      	  $config['source_image'] = FCPATH.'public/uploads/settings/img/logo/'.$data_favicon['file_name'];

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
				unlink($data_favicon['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	   // json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	   return (array('status' => $status, 'msg' => $msg, 'ftpfilearray_fav' => $data_favicon['file_name']));
	}

	 public function upload_banner()
	{
		$generate1 = "";
		$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate1 = $random_no.'_'.$month.'-'.$date.'-'.$year;

  		$fileexist = file_exists(FCPATH.'public/uploads/settings/img/logo/'.$generate1);
		if($fileexist)
		{
			$date = date('d');
  		$month = date('m');
  		$year = date('Y');
  		$random_no = rand(1000,5000);
  		$generate1 = $random_no.'_'.$year.'-'.$month.'-'.$date;

		}

	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file_b';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/settings/img/logo';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  //$config['width'] = 1140;
		  //$config['height'] = 360;

		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = FALSE;
		  $config['file_name'] = $generate1.$_FILES['orig_name'];
          $ftpfiles_i = $generate1.$_FILES['orig_name'];
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
            $data_banner = $this->upload->data();
			$file_id = true;
			//$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			if($file_id)
			{
				/*$status = "success";
				$msg = "File successfully uploaded";

				$config['x_axis'] = '0';
				$config['y_axis'] = '0';
				$this->load->library('upload', $config);
				if ( ! $this->upload->crop())
				{
				   echo $this->upload->display_errors();
				}*/
				$status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/settings/img/logo/'.$data_banner['file_name'];
        		//$config['new_image'] = FCPATH.'public/uploads/settings/img/logo/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
        		$config['width'] = 1140;
		  		$config['height'] = 360;
                $config['x_axis'] = 0;
				$config['y_axis'] = 0;
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
    //             if(!$this->image_lib->crop())
				// {
    //     		echo $this->image_lib->display_errors();
				// }
			 }
			 else
			 {
				unlink($data_banner['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	   // json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	   return (array('status' => $status, 'msg' => $msg, 'ftpfilearray_banner' => $data_banner['file_name']));
	}
	

    function do_upload($filename, $filepath, $filetypes)
	{
		  $config['upload_path'] = $filepath;
		  $config['allowed_types'] = $filetypes;
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['slide1'];
          /*$ftpfiles_i = $_FILES['orig_name'];*/
          $this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$uploadestatus = array('error' => $this->upload->display_errors());

			}
			else
			{
				$uploadestatus = array('success' => $filepath.'/'.$filename['name']);


			}
			return $uploadestatus;
		
	}
    public function editAboutPage()
    {
           $this->template->set_layout('backend');
	       $this->template->title('Page Creater');
           $this->template->set('updType',"edit");

           $pid = $this->uri->segment(4);

           $page=$this->Templates_model->getPageById($pid);

           $this->template->set('page',$page);

           $heading=$this->input->post('heading');
           $content=$this->input->post('description');

           $this->form_validation->set_rules('heading', 'Title', 'required');
           $this->form_validation->set_rules('description', 'Summery', 'required');


            if ($this->form_validation->run() == FALSE)
		    {
			       $this->template->build('admin/pagecreator/contactpage');
		    }
		    else
		    {
		            $settingarr=array(
                     'address'=>$address,
                     'phone'=>$phone,
                     'email'=>$email,
                     'weburl'=>$weburl,
                     'mapcode'=>$mapcode,
                    );

		            $session = $this->session->userdata('loggedin');
                  	$data = array(
    				'heading' => $heading,
    				'content' => $content,
    				'settings' => json_encode($settingarr),
    				'createdon' => date("Y-m-d"),
                    'createdby' => $session['id']
    			);

                $this->Templates_model->updateItem($pageid,$data);

                //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
               	redirect('admin/pagecreator/');

	        }

    }

    public function editContactPage()
    {
         $this->template->set_layout('backend');
	     $this->template->title('Page Creater');


         $pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('pageid')));

         $page=$this->Templates_model->getPageById($pid);

         $this->template->set('page',$page);

         $heading=$this->input->post('heading');
         $content=$this->input->post('description');
         $address=$this->input->post('address');
         $phone=$this->input->post('phone');
         $email=$this->input->post('email');
         $weburl=$this->input->post('weburl');
         $mapcode=$this->input->post('mapcode');
         $pageid=$this->input->post('pageid');

            $this->form_validation->set_rules('heading', 'Title', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[10]|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('weburl', 'Web Address', 'required');


            if ($this->form_validation->run() == FALSE)
		    {
			       $this->template->build('admin/pagecreator/contactpage');
		    }
		    else
		    {
		            $settingarr=array(
                     'address'=>$address,
                     'phone'=>$phone,
                     'email'=>$email,
                     'weburl'=>$weburl,
                     'mapcode'=>$mapcode,
                    );

		            $session = $this->session->userdata('loggedin');
                  	$data = array(
    				'heading' => $heading,
    				'content' => $content,
    				'settings' => json_encode($settingarr),
    				'createdon' => date("Y-m-d"),
                    'createdby' => $session['id']
    			);

                $this->Templates_model->updateItem($pageid,$data);

                //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
               	redirect('admin/pagecreator/');

	        }


    }


     public function publish($qid = FALSE){



	    $qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/pagecreator/');
			}
		else{
				$upd_data = array(
					'status'=>'active'
				);
				$in_ids = $qid;
				$publish=$this->Templates_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Page published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Page publish action fail or already published!' ) );
				}
				redirect('admin/pagecreator');

			}
	}




    public function unpublish($qid = FALSE){


		$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/pagecreator/');
			}
		else{
				$upd_data = array(
					'status' => 'inactive'
				);
				$in_ids = $qid;
				$unpublish=$this->Templates_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Page unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Page unpublish action fail or already unpublished!' ) );
				}
			  	redirect('admin/pagecreator');

			}
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
		$this->form_validation->set_rules('step_access', 'step access', 'required');
		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');

		if ($this->form_validation->run() === false)
		{
			$this->template->build('admin/tasks/create');
		}
		else
		{
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
			$data = array(
				'name' => $this->input->post('name'),
				'alias' => $alias,
				'difficultylevel' => $this->input->post('difficultylevel'),
				'metatitle' => $this->input->post('title'),
				'metakwd' => $this->input->post('key_description'),
				'metadesc' => $this->input->post('description'),
				'step_access' => $this->input->post('step_access'),
				'startpublish' => $this->input->post('startpublish'),
				'endpublish' => $this->input->post('endpublish'),
				'published' => $this->input->post('published'),
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
							window.parent.location.href = "<?php echo base_url(); ?>/admin/days/<?php echo $pid?>";
							</script><?php
						}
					}
				}
			
		}
	}

	function edit($tid = true ,$did = true ,$pid = true) 
	{
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
		if (!$tid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/days/'.$pid);
		}
		$this->template->title("Edit Lesson");
		$this->template->set('db_media', $this->tasks_model->getMedia_oflayout('scr_m',$tid));
		$this->template->set('db_mediatext', $this->tasks_model->getMedia_oflayout('scr_t',$tid));
		$mediajumpids = $this->tasks_model->getMedia_oflayout('jump',$tid);
		foreach($mediajumpids as $mediajumpid){
		$jumpbut = $this->tasks_model->getJumpbutton($mediajumpid->media_id);
		$jumpbut = $jumpbut->button;
		$this->template->set('jump_but'.$jumpbut, $this->tasks_model->getJumpbutton($mediajumpid->media_id));
		}
		$this->template->set('task', $this->tasks_model->getLesson($tid,$did,$pid));
		$this->template->set('jmpbuttoninfo', $this->tasks_model->getMedia_oflayout('jump',$tid));
		$this->template->set('updType', 'edit');
		$this->template->set('pid', $pid);
		$this->template->set('did', $did);

        $this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('step_access', 'step access', 'required');
		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');
	   		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/tasks/create');
		}
		else
		{	

			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
            $form_data = array(
				'name' => $this->input->post('name'),
				'alias' => $alias,
				'difficultylevel' => $this->input->post('difficultylevel'),
				'metatitle' => $this->input->post('title'),
				'metakwd' => $this->input->post('key_description'),
				'metadesc' => $this->input->post('description'),
				'step_access' => $this->input->post('step_access'),
				'startpublish' => $this->input->post('startpublish'),
				'endpublish' => $this->input->post('endpublish'),
				'published' => $this->input->post('published'),
				'ordering' => $this->tasks_model->maxorder()
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
				window.parent.location.href = "<?php echo base_url(); ?>/admin/days/<?php echo $pid?>";
				</script><?php
				//redirect('admin/days/'.$pid);
			}
			else{
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				?><script type="text/javascript">
				//parent.jQuery.fancybox.close();
				window.parent.location.href = "<?php echo base_url(); ?>/admin/days/<?php echo $pid?>";
				</script><?php
				//redirect('admin/days/'.$pid);	
			}	
	  	} 
	}
	
	function delete($tid = true ,$did = true ,$pid = true)
	{
		//filter & Sanitize $id
		$tid = ($tid != 0) ? filter_var($tid, FILTER_VALIDATE_INT) : NULL;
		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$tid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/days/');
		}
		
		//search the item to delete
		
		/*elseif ( $this->pcategories_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/pcategories/');
		}
		*/
		
		$isdelete=$this->tasks_model->deleteItem($tid);
        $this->tasks_model->updatetaskcount($pid);

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
			redirect('admin/days/'.$pid);

	}

	// function tabActive()
	// {
		
	// 	$tabname =$_POST['tabname'] ? $_POST['tabname'] :'tab1';
			

	// 	$this->session->set_userdata('Active_tab',$tabname);

	// 	$Active_tab =$this->session->userdata('Active_tab');
	// 		print_r($Active_tab);

	// 		return true;
	// }
	
	function tabActive($tabname=NULL)
	{
		$tabname =$_POST['tabname'] ? $_POST['tabname'] :'tab4';
		$this->session->set_userdata('Active_tab',$tabname);

		$Active_tab =$this->session->userdata('Active_tab');
		

		switch ($tabname) {
			case 'tab1':
				$this->load->view('admin/settings/gene');
			break;

		case 'tab2':

			
		$data = array(
			 'title'=> "Payment Account" ,
			 'updType' =>'save',
			'currency'=>  $currency,
			'currencies'=> $this->settings_model->getCurrencies(),
			'pay_setting'=> $this->settings_model->getAccountMode(),
		 );
    	$this->form_validation->set_rules('paypal_bsns_email', 'paypal_bsns_email ', 'required');
			$this->load->view('admin/settings/account', $data);
		break;

		case 'tab3':

		$data['title'] = 'Plan List';
		$parent_id = NULL;
		if($parent_id){
		$data['subplans'] = $this->subplans_model->getItems($parent_id);
		}else{

		$data['subplans'] = $this->subplans_model->getItems($parent_id);
		}
		// $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

		$this->load->view('admin/subplans/list', $data);
		break;

		case 'tab4':
			
		$result = $this->certificates_model->getItems();
					extract($result[0]);
		$ftpfiles = scandir($path, 1);
		foreach($ftpfiles as $ftpfile){

			 $ftpfileinfo = get_mime_by_extension($path.$ftpfile);
            	if($ftpfileinfo){
				    $ftpfileinfoarray = explode('/',$ftpfileinfo);

            		if($filetype == 'image'){
					    $fileslist['image'][] =  (object) array('filename' =>  $ftpfile, 'filepath' => $path,   'type' => 'image');
					}
				   else if($filetype == 'document'){

				     if(in_array('application' , $ftpfileinfoarray) || in_array('text' , $ftpfileinfoarray)){

					$fileslist['document'][] =  (object) array('filename' =>  $ftpfile, 'filepath' => $path,   'type' => 'document');
                      }
					}
					else if($filetype == 'audio'){
                    if(in_array('audio' , $ftpfileinfoarray)){
					$fileslist['audio'][] =  (object) array('filename' =>  $ftpfile, 'filepath' => $path,   'type' => 'audio');
                        }
					}
					else if($filetype == 'video'){
					if(in_array('video' , $ftpfileinfoarray)){

					    $fileslist['video'][] =  (object) array('filename' =>  $ftpfile, 'filepath' => $path,   'type' => 'video');
                    }
					}
                    else if($filetype == 'file'){
                   if(!in_array('text',$ftpfileinfoarray)){
				   $fileslist['file'][] =  (object) array('filename' =>  $ftpfile, 'filepath' => $path,   'type' => 'file');
                      }
				 }
				}
			}


        $data = array(
			 'title'=> "Certificate Settings",
			 'updType' =>'save',
			// 'ftpimage'=> $this->medias_model->fileslist('public/uploads/certificates', 'image'),
			 'ftpimage' => $fileslist['image'],
			'id'=> $id,
			'design_background'=> $design_background,
			'design_background_color'=> $design_background_color,
			'design_text_color'=> $design_text_color,
			'font_certificate'=> $font_certificate,
			'templates1'=> $templates1,
			'templates2'=> $templates2,
			'templates3'=> $templates3,
			'templates4'=> $templates4,
			'subjectt3'=> $templates5,
			'subjectt4'=> $templates6,
					 );
			$this->load->view('admin/certificates/certificates', $data);
		break;

		case 'tab5':
				 // include_once(base_url('controllers/admin/settings.php')); //include controller
     //        $aObj = new Settings();  //create object 
     //        $aObj->sociallg();

				$result = $this->settings_model->getItems();

		extract($result[0]);

		 $socialloginarray = json_decode($sociallogin);

		$data = array('title' => "Social Logins",
			'updType' => "Save",
			'id' => $id,
			'sociallogins' => $socialloginarray,
			// 'sociallogins' => $socialloginarray
	);
		
		
		
			$this->load->view('admin/settings/sociallogins', $data);
		break;

		case 'tab6':
			$this->template->title("Email Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
				$result = $this->settings_model->getItems();

		extract($result[0]);
		$data = array('title' => "Social Logins",
			'updType' => "Save",
			'id' => $id,
			'fromname' => $fromname,
			'fromemail' => $fromemail,
				'signature' => $signature,
		);
		$this->load->view('admin/settings/email_setting', $data);
		break;

		case 'tab7':
		$result = $this->settings_model->getItems();

		extract($result[0]);
			$data = array('title' => "General Settings",
			'updType' => "Save",
			'id' => $id,
			'fromname' => $fromname,
			'fromemail' => $fromemail,
	);
			
	$this->load->view('admin/settings/payment_details', $data);
		break;
		}
	}

	function tabMenu()
	{
		
		$tabname =$_POST['tabname'] ? $_POST['tabname'] :'';
			
		$this->session->unset_userdata('Active_menu');
		$this->session->set_userdata('Active_menu',$tabname);

		$Active_tab =$this->session->userdata('Active_menu');
			print_r($Active_tab);

			return true;
	}
	function activeMenu()
	{ 
		$tabname =$_POST['tabname'] ? $_POST['tabname'] :'';
		$menuname =$_POST['menuname'] ? $_POST['menuname'] :'';
			$data = array(
						'tname' =>$tabname,
						'mname' =>$menuname
						);
			$this->session->unset_userdata('Active_menu2');
		$this->session->set_userdata('Active_menu2',$data);

		$Active_tab =$this->session->userdata('Active_menu2');
			print_r($Active_tab['mname']);

			return true;

	}

	function cropimage()
	{	//exit('yes');
		//$this->template->build('admin/templates/cropop');
		$this->template->build('admin/templates/cropbannerimgnew');
	}

	function croplogo()
	{
		$this->template->build('admin/templates/croplogo');
	}


	public function uploadScreenShots()
    {			  
    	
    	$data = $_POST['img'];
    	$img_name = $_POST['img_name'];      	
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

  		if($img_name){
  			echo $img_name;
  		}
  		else{
  			$img_name = $generate1;
  			echo $img_name;
 		} 		
		$file = FCPATH.'public/uploads/settings/img/'.$img_name;
		//$file = FCPATH.'public/uploads/settings/img/logo/'. $generate1 . '.png';
		if(file_put_contents($file, $data))//for upload file to the server
		{
			//executed
			    $status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/uploads/settings/img/'.$img_name;
        		$config['new_image'] = FCPATH.'public/uploads/settings/img/logo/'.$img_name;
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';        		
                $config['width'] = 1140;
                $config['height'] = 353;
                
        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';
		}

		if($this->uri->segment(4) == 'banner')
		{
		$form_data =  array(					
					//'logoimage' => $logoimage,					
					//'layouttheme' => $layoutstyle,	
					'bannerimage' => $img_name						
					);


 		$this->settings_model->updateItem($form_data);
 	  } 
		
    }



    public function uploadSlider()
    {		

       	  
    	$data = $_POST['img']; 
    	$img_name = $_POST['img_name'];      	
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

  		if($img_name){
  			echo $img_name;
  		}
  		else{
  			$img_name = $generate1;
  			echo $img_name;
 		} 
		
		if($this->uri->segment(4) == 'bg_image4')
		{
			$file = FCPATH.'public/classic/'.$img_name;

				if(file_put_contents($file, $data))//for upload file to the server
				{
					$status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/classic/'.$img_name;
        		$config['new_image'] = FCPATH.'public/classic/images/'.$img_name;
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 1350;
                $config['height'] = 400;

        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';//executed

					
				}

    }
    else
    {
    	$file = FCPATH.'/'.$img_name;

    	if(file_put_contents($file, $data))//for upload file to the server
	   {
		
	   }

    }
		
    }

     public function uploadSliderbg()
    {		
       	  
    	$data = $_POST['img']; 
    	$img_name = $_POST['img_name'];       	
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

  		if($img_name){
  			echo $img_name;
  		}
  		else{
  			$img_name = $generate1;
  			echo $img_name;
 		} 
		if($this->uri->segment(4) == 'bg_image4')
		{
			$file = FCPATH.'/'.$img_name;

				if(file_put_contents($file, $data))//for upload file to the server
				{
					$status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'/'.$img_name;
        		$config['new_image'] = FCPATH.'/'.$img_name;
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 1350;
                $config['height'] = 400;

        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';//executed

					
				}

    }
    else
    {
    	$file = FCPATH.'/'.$img_name;

    	if(file_put_contents($file, $data))//for upload file to the server
	   {
		
	   }

    }
		
    }


   public function uploadlogo()
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

  		if($img_name){
  			echo $img_name;
  		}
  		else{
  			$img_name = $generate1;
  			echo $img_name;
 		} 
  		
		$file = FCPATH.'public/uploads/settings/img/logo/'.$img_name;
		file_put_contents($file, $data);//for upload file to the server
		

		 if($this->uri->segment(4) == 'logo')
		{
			$form_data =  array(					
					'logoimage' => $img_name					
											
					);


 		$this->settings_model->updateItem($form_data);
		}
		else if($this->uri->segment(4) == 'icon')
		{
				$form_data =  array(					
					'favicon' => $img_name					
											
					);


 		$this->settings_model->updateItem($form_data);
		}
    }

    function cropSlider()
	{
		$this->template->build('admin/templates/cropslider');
	}

	function cropSliderBg()
	{
		$this->template->build('admin/templates/cropsliderimgnew');
	}

	function proSaveHome()
	{   
		$inst_name = $_POST['inst_name'];
		$form_data =  array(					
					'institute_name' =>$inst_name,											
					);

 		$this->settings_model->updateProgressPopup($form_data,'mlms_config');

 		$data = array('home_status' => 1, );

    	$lecture_id = $this->settings_model->updateProgressPopup($data,'mlms_socialstatus');
	    
	    $getsocialstatus = $this->settings_model->getSocialStatus(1,"mlms_socialstatus");
  		$totalprogress1 = $getsocialstatus->home_status + $getsocialstatus->payment_status + $getsocialstatus->course_status + $getsocialstatus->lecture_status + $getsocialstatus->social_status;
  		echo $totalprogress = $totalprogress1 * 20;
	}

	function savePaymentSetting()
	{			
		$form_data =  array(
					// 'api_username ' => $this->input->post('api_username'),
					// 'api_password ' => $this->input->post('api_password'),
					// 'api_signature ' => $this->input->post('api_signature'),					
					//'name ' => $this->input->post('name'),					
					'status ' => $this->input->post('isLive'),
					'directinfo' =>$this->input->post('othertxt'),
					'directpay_status' => ($this->input->post('otherckb')) ? $this->input->post('otherckb') : '0',
					'paypal_status' => ($this->input->post('paypalckb')) ? $this->input->post('paypalckb') : '0',

					'paypal_bsns_email' => $this->input->post('paypal_bsns_email'),
				);

 	 	$this->settings_model->updateProgressPopup($form_data,'mlms_account');
	   
	    $data = array('payment_status' => 1 );

    	$this->settings_model->updateProgressPopup($data,'mlms_socialstatus');

    	$getsocialstatus = $this->settings_model->getSocialStatus(1,"mlms_socialstatus");
  		$totalprogress1 = $getsocialstatus->home_status + $getsocialstatus->payment_status + $getsocialstatus->course_status + $getsocialstatus->lecture_status + $getsocialstatus->social_status;
  		echo $totalprogress = $totalprogress1 * 20;
	}

	function createCourse()
	{	
		
		
		$session = $this->session->userdata('loggedin');

		$this->load->model('admin/programs_model');
		$orderingval = $this->programs_model->maxorder();

		$categoryData = array(
							  'name' => $this->input->post('coursename'),
							  'alias' => $this->input->post('coursename'),							   
							  'published' => 1,
							  'description'=>"",						  
							  'image' => 'no_images.jpg',
							  'ordering'=>1,
							  'created_by' =>$session['id'],
							  'demorecords'=>0,
							  );
		$catagory_id = $this->settings_model->createCategoryNCourse($categoryData,'mlms_category');

		$categoryDataRel = array('parent_id' =>0 ,
								 'child_id'=>$catagory_id,);

		$catagory_id2 = $this->settings_model->createCategoryNCourse($categoryDataRel,'mlms_categoryrel');

		//$freecourse2 = $this->input->post('courseprice');
		//$freecourse = $freecourse2[0] == "free" ? 1 : 0;

		$freecourse2 = $this->input->post('courseprice');		
		$chb_free_courses =0;
		$step_access_courses=1;
		if($freecourse2[0]=="paid")
		{
			$chb_free_courses =1;
			$step_access_courses=0;
		}

		$fixedrate = "0.00";
		if($chb_free_courses == 1 && $step_access_courses == 0)
		{
			 $fixedrate = $this->input->post('fixedrate');	
		}

		$courseData = array(
				'name' => $this->input->post('coursename'),
				'description' => $this->input->post('descriptionpop'),
				'alias' => $this->input->post('coursename'),
				'catid' => $catagory_id,				
				'image' => $this->input->post('cropimage'),             
				'emails' => 0,
				'published' => 1,
				'startpublish' => '',
				'endpublish' => '',
				'metatitle' => '',
				'metakwd' => '',
				'metadesc' => '',
				'ordering' => $orderingval,
				'pre_req' => '',
				'pre_req_books' => '',
				'reqmts' => '',
				'author' => $session['id'],
				'level' => 0,
				'priceformat' => 1,
				'fixedrate'	=> $fixedrate, //$this->input->post('fixedrate'),
				'skip_module' => '0',    
				'chb_free_courses' => $chb_free_courses,
				'step_access_courses' => $step_access_courses,
				'selected_course' => "", 
				'course_type' => 0,
                'lesson_release' => 0,
				'lessons_show' => 0,
				'start_release' => "",
				'id_final_exam' => 0,
				'certificate_term' => 1,				
				'updated' => $session['id'],
				'certificate_course_msg' => "",
                'webcam_option' => 0,
                'created_by' =>$session['id'],
                'webstatus' => "inactive",
                'webnardescription' => '',
                'time_for_webcam' => '10Sec',
                'show_result' => 0,
                'introtext' => NULL,
                'programmedias'=>NULL,
                'prerequisitesfiles'=>NULL,
			);	

	  $catagory_id = $this->settings_model->createCategoryNCourse($courseData,'mlms_program');

		  $courseDetails = array(
                   'course_id'  => $catagory_id,
                   'name' => $this->input->post('coursename'),                   
               );
		  	if($this->session->userdata('courseDetails'))
		  	{
		  		$this->session->unset_userdata('courseDetails');
		  	}
			$this->session->set_userdata('courseDetails',$courseDetails);
		if($catagory_id)
		{
			//echo"success";
		}

		$data = array('course_status' => 1 );

    	$this->settings_model->updateProgressPopup($data,'mlms_socialstatus');

    	$getsocialstatus = $this->settings_model->getSocialStatus(1,"mlms_socialstatus");
  		$totalprogress1 = $getsocialstatus->home_status + $getsocialstatus->payment_status + $getsocialstatus->course_status + $getsocialstatus->lecture_status + $getsocialstatus->social_status;
  		echo $totalprogress = $totalprogress1 * 20;
	}


	function createLecture()
    {    
	    	$insertid = 0;
	    	$lectureText = NULL;
	    	$newfilename = NULL;
	    	$file_type = NULL;
	    	$mediatype = NULL;
			$name      = NULL;
			$error     = 0;

		if(isset($_FILES)) {
			if(isset($_FILES['file_i'])) {
				$tmp_name = $_FILES['file_i']['tmp_name'];
				$name     = basename($_FILES['file_i']['name']);
				$newfilename = basename($_FILES['file_i']['name']);
				$error    = $_FILES['file_i']['error'];
			   $file_type = $_FILES['file_i']['type'];
			   ///validate media start 
			   $mediatype = explode('/',$file_type);
			   if($mediatype[0] =='image')
		    	{
					$output_dir = FCPATH."public/uploads/images/";
					$whitelist = array('jpg', 'jpeg', 'png', 'gif');
				}
				else if($mediatype[0] =='video')
				{
					$output_dir = FCPATH."public/uploads/videos/";
					$whitelist = array('mp4', 'avi');	
				}
			   //validate media end 
				$whitelist = array('jpg', 'jpeg', 'png', 'gif','mp4', 'avi');

				if ($error === UPLOAD_ERR_OK) {
					$extension = pathinfo($name, PATHINFO_EXTENSION);

					if (!in_array($extension, $whitelist)) {
						$error = 'Invalid file type uploaded.';

						echo json_encode(array(
							'file_type' => $mediatype,
							'lectureText' => $lectureText,
							'newfilename'  => $newfilename,
							'error' => $error,
							'rowid' => $insertid,
						));
						die();
						//exit('yes');

					} else {						
						$date = date('d');
				  		$month = date('m');
				  		$year = date('Y');
				  		$random_no = rand(1000,5000);
				  		$generate = $random_no.'-'.$year.'-'.$month.'-'.$date;
				  		
				  		$temp = explode(".", $_FILES["file_i"]["name"]);
						$newfilename = round(microtime(true)).'-'.$generate.'.'.end($temp);
				  		move_uploaded_file($tmp_name,$output_dir.$newfilename);
						//move_uploaded_file($tmp_name,$output_dir.$_FILES["file_i"]["name"]);
					//$insertid = $this->Save_media_data($newfilename,$file_type);
					}
				}
			}
		}
			 
		if($mediatype)
   		{
   			$mediatype = $mediatype[0];
   		}
   		$insertid = $this->Save_media_data($newfilename,$mediatype);
		//$courseDetails = $this->session->userdata('courseDetails');
		$dataaa = array('lecture_status' => 1 );

    	$this->settings_model->updateProgressPopup($dataaa,'mlms_socialstatus');

   		$lectureText = $this->input->post('lectureText');
   		
		echo json_encode(array(
			'file_type' => $mediatype,
			'lectureText' => $lectureText,
			'newfilename'  => $newfilename,
			'error' => $error,
			'rowid' => $insertid,
		));
		die();	 

}
   
   function save_media_data($nametitle=null,$type=null)
    {
    	$str1="";
    	$str="";
    	$clickmethod="";
    	$session = $this->session->userdata('loggedin');
		if(!$this->session->userdata('loggedin'))
		{
			redirect('admin');
		}

		$courseDetails = $this->session->userdata('courseDetails');
		if($courseDetails)
		{
			$course_id = $courseDetails['course_id'];

			$lecturename = $this->input->post('lecturename');
			$lectureText = $this->input->post('lectureText');
			
			$courseid = $course_id;
			$startpublish = date('Y-m-d h:i:s');
			$endpublish = date('Y-m-d h:i:s');
		
			$sectionData = array(
				'pid' => $courseid,
				'title' => 'section 1',
				'alias' => 'section 1',
				'description' => '',
				'alias' => 'section 1',
				'image'=>"",
				//'access' => $this->input->post('access'),
				'published' => 1,
				'ordering' => 1,
				'media_id' => 0,
				'access'=>0,
				);

		 $section_id = $this->settings_model->createCategoryNCourse($sectionData,'mlms_days');
		 
			if($type)
			{
				$mediaData = array(
						'media_title' => $nametitle,
						'alt_title' => $nametitle,	
						'course_id' => $courseid,			
						'section_id' => $section_id,
						'type' => $type,
						'category_id' => 1,			
						'publish' => 1,				
						'created_by' => $session['id'],				
				        );
				$media_id = $this->settings_model->createCategoryNCourse($mediaData,'mlms_medias');
	          	if($type=="image")
	          	{
	          		$media ='<img src="'.base_url().'public/uploads/images/'.$nametitle.'" width="100%">';
	          		$clickmethod ='openmyModalImage(this.id);';
	          	}
	          	else if($type=="video")
	          	{
	          		$media ='<video width="100%" height="auto" controls="" preload="none" poster="'.base_url().'/public/css/image/video-play.jpg">';
                    $media.='<source src="'.base_url().'public/uploads/videos/'.$nametitle.'" type="video/mp4">';
                    $media.='<source src="movie.ogg" type="video/ogg"></video>';
	          		
	          		$clickmethod ='openmyModalyoutube(this.id);';
	          	}
	          	    
	          	    
	          	    
	           if($nametitle)
				 {
		 			//  $str1='<div class="lyrow ui-draggable" id="lyrow_2" style="display: block;">';
					 // $str1.='<a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);" id="remove_2"><i class="entypo-cancel"></i></a>'; 
					 // $str1.='<a class="drag btn btn-default btn-xs" id="drag_3"><i class="sprite onecol"></i><i class="entypo-window"></i></a>'; 
					 // $str1.='<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);" id="clone_2"><i class="entypo-docs"></i></a>'; 
					 // $str1.='<div class="preview"><span></span></div>'; 
					 // $str1.='<div class="view" style="display: block;">';
					 // $str1.='<div class="row clearfix">';
					 // $str1.='<div class="col-md-12 column ui-sortable" id="column_2">';
					 // $str1.='<div class="box box-element ui-draggable" data-type="image" id="box_2" style="display: block;">'; 
					 // $str1.='<a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);" id="removeinner_2"><i class="entypo-cancel"></i></a>'; 
					 // $str1.='<a class="drag btn btn-default btn-xs" id="drag_4"><i class="entypo-window"></i></a>'; 
					 // $str1.='<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_2"><i class="entypo-docs"></i></a>'; 
					 // $str1.='<span class="configuration">';
					 // $str1.='<a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="'.$clickmethod.'" id="settings_2"><i class="fa fa-gear"></i></a></span>'; 
					 // $str1.='<select class="form-control" name="Alignment" onchange="setAlign(this)"><option value="Left">Left</option><option value="Center">Center</option> <option value="Right">Right</option></select>';
					 // $str1.='<div class="preview"><i class="sprite image"></i><div class="element-desc">Image</div></div>'; 
					 // $str1.='<div class="view" id="view_2">'.$media.'</div>'; 
					 // $str1.='</div></div></div></div></div>';
				 		$str='<div class="lyrow ui-draggable" id="lyrow_1" style="display: block;">';
						$str.='<div class="layout-main-table">';
						$str.='<div class="layout-blue-bg layout-orange-bg">';
						$str.='<a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);" id="remove_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> ';
						$str.='<a class="drag-layout-btn drag btn btn-default btn-xs" title="drop &amp; drag" id="drag_1">';
						$str.='<i class="sprite_old onecol"></i>';
						$str.='<i class="entypo-window"></i>';
						$str.='</a>';
						$str.='<a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);" id="clone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> ';
						$str.='<div class="preview"><span></span></div> ';
						$str.='<div class="view right_view_content" style="display: block;">';
						$str.='<div class="row clearfix" style="margin:0px;">';
						$str.='<div class="col-md-12 column ui-sortable" style="float:right;" id="column_1">					        			';
						$str.='<div class="box box-element ui-draggable" data-type="image" style="display: flex;" id="box_1">';
						$str.='<div class="element-blue-bg"> ';
						$str.='<a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);" id="removeinner_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> ';
						$str.='<a class="element-drag-btn drag btn btn-default btn-xs" id="drag_2"><i class="entypo-window"></i></a> ';
						$str.='<a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> ';
						$str.='<span class="element-warning-btn configuration">';
						$str.='<a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="'.$clickmethod.'" id="settings_1">';
						$str.='<div class="sprite 7settings" style="background-position: -184px 0" title="Course Settings"></div></a></span> ';
						$str.='<select class="form-control" name="Alignment" onchange="setAlign(this)">						     ';
						$str.='<option value="Left">Left</option>';
						$str.='<option value="Center">Center</option>';
						$str.='<option value="Right">Right</option>';
						$str.='</select>';
						$str.='<div class="preview">';
						$str.='<i class="sprite_old image"></i> ';
						$str.='<div class="element-desc">Image</div>';
						$str.='</div> ';
						$str.='<div class="element-view-content view" id="view_1">'.$media.'</div> ';
						$str.='</div></div></div></div></div></div></div></div>';

				 }  

		   }
	   if(trim($lectureText)!="")
	   {
		    // $str='<div class="lyrow ui-draggable" id="lyrow_1">';
		    // $str.='<a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);" id="remove_1">';
		    // $str.='<i class="entypo-cancel"></i></a>'; 
		    // $str.='<a class="drag btn btn-default btn-xs" id="drag_1"><i class="sprite onecol"></i><i class="entypo-window"></i></a>';
		    // $str.='<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);" id="clone_1"><i class="entypo-docs"></i></a>'; 
		    // $str.='<div class="preview"><span></span></div>'; 
		    // $str.='<div class="view" style="display: block;">';
		    // $str.='<div class="row clearfix">';
		    // $str.='<div class="col-md-12 column ui-sortable" id="column_1">';
		    // $str.='<div class="box box-element ui-draggable" data-type="paragraph" id="box_1" style="display: block;">';
		    // $str.='<a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);" id="removeinner_1"><i class="entypo-cancel"></i></a>';
		    // $str.='<a class="drag btn btn-default btn-xs" id="drag_2"><i class="entypo-window"></i></a>';
		    // $str.='<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_1"><i class="entypo-docs"></i></a>'; 
		    // $str.='<span class="configuration"><a class="btn btn-xs btn-warning settings" data-toggle="modal" onclick="openMymodal(this.id);" id="settings_1"><i class="fa fa-gear"></i></a></span>'; 
		    // $str.='<select class="form-control" name="Alignment" onchange="setAlign(this)"><option value="Left">Left</option><option value="Center">Center</option><option value="Right">Right</option></select>';
		    // $str.='<div class="preview"><i class="sprite text"></i><div class="element-desc">Paragraph</div></div>';
		    // $str.='<div class="view" id="view_1">'.$lectureText.'</div>'; 
		    // $str.='</div></div></div></div></div>';
	   			$str1='<div class="lyrow ui-draggable" id="lyrow_2" style="display: block;">';
				$str1.='<div class="layout-main-table">';
				$str1.='<div class="layout-blue-bg layout-orange-bg">';
				$str1.='<a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);" id="remove_3"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> ';
				$str1.='<a class="drag-layout-btn drag btn btn-default btn-xs" id="drag_3">';
				$str1.='<i class="sprite_old onecol"></i>';
				$str1.='<i class="entypo-window"></i>';
				$str1.='</a> ';
				$str1.='<a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);" id="clone_3"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> ';
				$str1.='<div class="preview">';
				$str1.='<span></span>';
				$str1.='</div> ';
				$str1.='<div class="view right_view_content" style="display: block;">';
				$str1.='<div class="row clearfix right-main-content" style="margin:0px;">';
				$str1.='<div class="col-md-12 column ui-sortable" style="float:right;" id="column_2">					        			';
				$str1.='<div class="box box-element ui-draggable" data-type="paragraph" style="display: flex;" id="box_2">';
				$str1.='<div class="element-green-bg" id="">';
				$str1.='<a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);" id="removeinner_2">';
				$str1.='<div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>';
				$str1.='</a> ';
				$str1.='<a class="element-drag-btn drag btn btn-default btn-xs" id="drag_4">';
				$str1.='<i class="entypo-window"></i>';
				$str1.='</a>';
				$str1.='<a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_2"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> ';
				$str1.='<span class="element-warning-btn element-warning-btn configuration"> ';
				$str1.='<a class="btn btn-xs settings" data-toggle="modal" onclick="openMymodal(this.id);" id="settings_2">';
				$str1.='<div class="sprite 7settings" style="background-position: -184px 0" title="Course Settings"></div>';
				$str1.='</a> ';
				$str1.='</span>';
				$str1.='<select class="form-control" name="Alignment" onchange="setAlign(this)">						     ';
				$str1.='<option value="Left">Left</option>';
				$str1.='<option value="Center">Center</option> ';
				$str1.='<option value="Right">Right</option> ';
				$str1.='</select>';
				$str1.='<div class="preview"> ';
				$str1.='<i class="sprite_old text"></i> ';
				$str1.='<div class="element-desc">Paragraph</div> ';
				$str1.='</div>';
				$str1.='<div class="element-view-content view" id="view_2"><p>'.$lectureText.'</p></div> ';
				$str1.='</div> ';
				$str1.='</div></div> ';
				$str1.='</div> ';
				$str1.='</div> ';
				$str1.='</div>';
				$str1.='</div>';
				$str1.='</div>';
		 }

		

			$lecturedata = array(				
				'section_id' => $section_id,
				'p_id' => $courseid,
				'name' => $lecturename,			
				'difficultylevel' => 'easy',
				'published' => 1,
				'startpublish' => $startpublish, 
				'endpublish' => $endpublish, 
				'metatitle' => null,
				'metakwd' => null,
				'metadesc' => null,				
				'ordering' => 1,
				'created_by' => $session['id'],
				'lecture_content' => $str."".$str1,
				'layoutid'=>1,
			);


			$lecture_id = $this->settings_model->createCategoryNCourse($lecturedata,'mlms_lectures');
		return $lecture_id;
		}		

    }

    function social_status()
    {
    	 $sociaLogin = $this->input->post('socialLogin');
    	$socialIcon = $this->input->post('socialIcon');
    		 $socialIcon = $socialIcon == 1 ? 1:0;
    		 $sociaLogin = $sociaLogin == 1 ? 1:0;
    	$data = array('social_login' => $sociaLogin,
    				  'social_icon' => $socialIcon,
    				  'social_status' => 1, );

    	$lecture_id = $this->settings_model->updateProgressPopup($data,'mlms_socialstatus');
    	
    	$getsocialstatus = $this->settings_model->getSocialStatus(1,"mlms_socialstatus");
  		$totalprogress1 = $getsocialstatus->home_status + $getsocialstatus->payment_status + $getsocialstatus->course_status + $getsocialstatus->lecture_status + $getsocialstatus->social_status;
  		echo $totalprogress = $totalprogress1 * 20;

    } 

}
	