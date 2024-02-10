<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specialpages extends MLMS_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('commonmethods');
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		$this->template->set_layout($configarr[0]['layout_template']);

		date_default_timezone_set($configarr[0]['time_zone']);
        $this->load->helper('cookie');
        $this->load->model('Pagecreator_model');
        $this->load->model('login_model');        
        $this->load->helper('text');

	}
	public function index($pro_id = NULL)
	{
	}

    public function contactuspage()
    {	
    	// echo "<script>window.location.href = '".base_url()."contact_us/';</script>";exit;

		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);
		$this->template->title('Contact Us');      
		//$fromname = $configarr[0]->fromname;
		$admin_email = '';
		//$admin_email = $configarr[0]['fromemail'];
	  
        $btnvalue = $this->input->post('send');
        if($btnvalue == 'send')
	    {
	    	//exit('yes');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $body = $this->input->post('body');
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'subject', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
		//$this->form_validation->set_rules('mailto', 'mailto', 'required');
            if ($this->form_validation->run() === FALSE)
            {
				$this->template->build(getOverridePath($tmpl,'specialpages/contact','views'));  
            }
			else
			{
                // recaptcha validation starts
                $captcha_response = trim($this->input->post('g-recaptcha-response'));
        
        		if($captcha_response != '')
        		{
        			$keySecret = '6LcS-B0eAAAAANh3LYzxwftp80vWi_pQZeStrX6L';
        
        			$check = array(
        				'secret'		=>	$keySecret,
        				'response'		=>	$this->input->post('g-recaptcha-response')
        			);
        
        			$startProcess = curl_init();
        
        			curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        
        			curl_setopt($startProcess, CURLOPT_POST, true);
        
        			curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
        
        			curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
        
        			curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
        
        			$receiveData = curl_exec($startProcess);
        
        			$finalResponse = json_decode($receiveData, true);
        			echo $finalResponse;
        		}
            // recaptcah validation ends

				if($configarr[0]['fromemail'])  
                    $urldomain = $configarr[0]['fromemail']; 
                else $urldomain = 'noreply@'.$this->config->item('urldomain');

				$fromemail = $urldomain;		 		

				$admininfo = $this->login_model->getadminInfo(4);				


				$admin_email= $admininfo->email;

				$configarr = $this->settings_model->getItems();
				$this->load->library('email');
				//$subject1 = 'New Enquiry for '.$configarr[0]['institute_name'];
				$subject1 = 'Enquiry received - '.$configarr[0]['institute_name'];
				$toemail = $admin_email;
				// $toemail = 'jyotisorte4@gmail.com';
				$content = '';
				$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">
                    Enquiry received - '.$configarr[0]['institute_name'].'</p>';
				$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
				$content .='There is a new Enquiry. Here are the details:<br /><br />';
				$content .= 'Email : <a style="color:#55c5eb" href="mailto:'.$email.'" target="_blank">'.$email.'</a><br />';
				$content .= 'Subject : '.$subject.'<br />';
				$content .= 'Message : '.$body.'<br />';
				// $content .='<br /><br />';
				// $content .='...</p>';
				// $content .= $configarr[0]['signature'].'</p>';
				$data['content'] = $content; 
 		        $data['fromemail'] = $urldomain;
				$message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
				
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail,$configarr[0]['fromname']);
				// $this->email->to($toemail);
		        $this->email->to($toemail);
				$this->email->cc("prshah83@gmail.com");
				$this->email->subject($subject1);
				$this->email->message($message1);
				
				if($finalResponse['success']) // if recaptcha is correct, human
				{
				    echo "captcha success";
				    
				    $this->email->send();
				    $this->session->set_userdata('contactmail', 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest');
                    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Your query has been successfully submitted. We will get back to you at the earliest.'));
            	    redirect('contact-us');
				}
				else {
				    // captcha failed
				    // echo "captcha failed";
				    $this->session->set_flashdata('message', array( 'type' => 'failed', 'text' => 'reCaptcha Failed. Please try again.'));
				    redirect('contact-us');
				}
				
            }
		}
		//print_r($configarr[0]->fromname;$configarr[0]->fromemail);
		$this->template->set("configarr", $configarr);
		$pagetype="contact";
		$contactpage=$this->Pagecreator_model->getPageByType($pagetype);
		 if($contactpage[0]['status'] =='inactive')
        {
        	redirect(base_url(),'location',301);
        }
		$this->template->set('contactpage',$contactpage);
		$this->template->build(getOverridePath($tmpl,'specialpages/contact','views'));      
    }

    public function aboutuspage()
    {			  
		$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);	  
		$this->template->title('About Us');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $this->template->set("configarr", $configarr);
        $pagetype="about";
        $aboutpage=$this->Pagecreator_model->getPageByType($pagetype);
        
        if($aboutpage[0]['status'] =='inactive')
        {
        	redirect(base_url(),'location',301);
        }

        $this->load->model('admin/testimonials_model');
        $testimonials=$this->testimonials_model->getTestimonials();
        $this->template->set('testimonials',$testimonials);
        $this->template->set('aboutpage',$aboutpage);
	    $this->template->build(getOverridePath($tmpl,'specialpages/about','views'));
    }

    public function demoweb()
    {			  
		$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);	  
		$this->template->title('About Us');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $this->template->set("configarr", $configarr);
        $pagetype="about";
        $aboutpage=$this->Pagecreator_model->getPageByType($pagetype);
        $this->load->model('admin/testimonials_model');
        $testimonials=$this->testimonials_model->getTestimonials();
        $this->template->set('testimonials',$testimonials);
        $this->template->set('aboutpage',$aboutpage);
	    $this->template->build(getOverridePath($tmpl,'specialpages/demoweb','views'));
    }

    public function uploadwebcamshots()
    {			  
    	$data = $_POST['postData'];      	
    	$data = str_replace('data:image/png;base64,', '', $data);
		$data = str_replace(' ', '+', $data);
		$data = base64_decode($data);
		$file = FCPATH.'public/uploads/webshotuploads/'. uniqid() . '.png';
		if(file_put_contents($file, $data))//for upload file to the server
		{
			//execute
		}
    }

    public function view()
	{
        //$tmpl = "default";
        //$this->template->set("tmpl", $tmpl);
        //$this->template->set("category", $this->categs_model->getCateg());
		//$this->template->build('gurucategs/gurupcategs');
	}

	public function term_app()
	{
        $this->load->view('new_template_design/terms_app');
	}


 function authenticate()
    {

    $sessionarray = $this->session->userdata('logged_in');
		
	 if(!$this->session->userdata('logged_in'))
       {
         redirect('index/index');
       }
		
    }

	public function video_list()
    {	
        $this->authenticate();

		$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);	  
		$this->template->title('Video List');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $this->template->set("configarr", $configarr);
        $pagetype="about";
        $aboutpage=$this->Pagecreator_model->getPageByType($pagetype);
        $this->load->model('admin/testimonials_model');
        $testimonials=$this->testimonials_model->getTestimonials();
        $this->template->set('testimonials',$testimonials);
        $this->template->set('aboutpage','Video List');
	    $this->template->build(getOverridePath($tmpl,'specialpages/view_videos','views'));
    }

    public function help_to_manage_academy()
    {	
    	$this->authenticate();

		$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);	  
		$this->template->title('About Us');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $this->template->set("configarr", $configarr);
        $pagetype="about";
        $aboutpage=$this->Pagecreator_model->getPageByType($pagetype);
        $this->load->model('admin/testimonials_model');
        $testimonials=$this->testimonials_model->getTestimonials();
        $this->template->set('testimonials',$testimonials);
        $this->template->set('aboutpage','Video List');
	    $this->template->build(getOverridePath($tmpl,'specialpages/help_to_manage_academy','views'));
    }

    function manage_setup_new()
        {
        	$this->load->view('specialpages/manage_setup_new');
        }
        function manage_design_new()
        {
        	$this->load->view('specialpages/manage_design_new');
        }
        function create_blogs_new()
        {
        	$this->load->view('specialpages/create_blogs_new');
        }
        function create_page_new()
        {
        	$this->load->view('specialpages/create_page_new');
        }
        function partnership(){
        	// $this->load->view('new_template_design/header');
        	// $this->load->view('new_template_design/terms.php');
        	// $this->load->view('new_template_design/footer.php');
        	$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);	  
		$this->template->title('About Us');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $this->template->set("configarr", $configarr);
        $pagetype="about";
       

      
	    $this->template->build(getOverridePath($tmpl,'new_template_design/terms','views'));
        }

        public function support_team()
    	{		
    			$this->authenticate();

    			$sessionarray = $this->session->userdata('logged_in');		
		
	    				 $user_id = $sessionarray['id'];
	    				 $teacheremail = $sessionarray['email'];
	    				 $teacherName = $sessionarray['first_name'];
	    				 $teacherSurname = $sessionarray['last_name'];
	   					 $group_id = $sessionarray['groupid'];
    			 
	    $this->load->model('login_model'); 
		  
		      	  // $this->form_validation->set_rules('name', 'name', 'required');
		          $this->form_validation->set_rules('email', 'email', 'required|valid_email');
		          $this->form_validation->set_rules('mailto', 'mailto', 'required');
		          $this->form_validation->set_rules('subject', 'subject', 'required');
		          $this->form_validation->set_rules('message', 'message', 'required');

					if ($this->form_validation->run() == FALSE) 
					{						
					   //	$this->template->build('admin/settings/support_team');

					   		$this->load->model('admin/settings_model');      
							$configarr = $this->settings_model->getItems();	  
							$tmpl = $configarr[0]['layout_template'];      
							$this->template->set("tmpl",$tmpl);	  
							$this->template->title('About Us');
					        $this->load->model('admin/settings_model');
					        $configarr = $this->settings_model->getItems();
					        $this->template->set("configarr", $configarr);
					        $pagetype="about";
					        $aboutpage=$this->Pagecreator_model->getPageByType($pagetype);
					        $this->load->model('admin/testimonials_model');
					        $testimonials=$this->testimonials_model->getTestimonials();
					        $this->template->set('testimonials',$testimonials);
					        $this->template->set('aboutpage','Video List');
						    $this->template->build(getOverridePath($tmpl,'specialpages/support_team','views'));


					}
				  else
					{				

						 $rs = $this->upload_attachment();						
						 $attach = json_decode($rs);						
						if($attach->ftpfilearray)
						{
							
					    $newFile  = FCPATH.'public/uploads/settings/img/logo/'.$attach->ftpfilearray;
						}	
				        $email = $this->input->post('email');
				        $mailto = $this->input->post('mailto');
				        $subject = $this->input->post('subject');
				        $message = $this->input->post('message');


				        $admininfo = $this->login_model->getadminInfo(4);
						$admin_email= $admininfo->email;

						// $urldomain = base_url();
						// $urldomain = str_replace('http://', '', $urldomain);
						// $urldomain = str_replace('/', '', $urldomain);
						// $urldomain = str_replace('www.', '', $urldomain);
						if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = 'noreply@'.$this->config->item('urldomain');

						$fromemail = $urldomain;
						$configarr = $this->settings_model->getItems();
						$this->load->library('email');
						$subject1 = 'Support request raised from '.$configarr[0]['institute_name'];
						$toemail =  $admin_email;
						$bccemail = "info@createonlineacademy.com";

						$content = '';
						$content .= '<p>Dear Admin,<br /><br />';
						$content .='We received an support request from Teacher<br /><br />';
						$content .= 'Name : '.trim(ucfirst($teacherName)).' '.trim(ucfirst($teacherSurname)).'<br /><br />';
						$content .= 'Email : '.$teacheremail.'<br /><br />';
						$content .= 'Contact Email Address : '.$email.'<br /><br />';
						$content .= 'Chosen Department : '.$mailto.'<br /><br />';
						$content .= 'Academy URL : '.base_url().'<br /><br />';						
						$content .= 'Subject : '.$subject.'<br /><br />';
						$content .= 'Message : '.$message.'<br /><br />';
						$content .='<br /><br />';
						$content .='...</p>';						
						$content .= 'Regards,<br />';
						$content .= 'Create Online Academy Team</p>';

						$data['content'] = $content; 
 		$data['fromemail'] = $urldomain;
						$message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
						
						$config['charset'] = 'utf-8';
						$config['mailtype'] = 'html';
						$config['wordwrap'] = TRUE;
						$this->email->initialize($config);
						$this->email->from($fromemail,$configarr[0]['fromname']);
						$this->email->to($toemail);
						$this->email->bcc($bccemail); 
						$this->email->subject($subject1);
						$this->email->message($message1);
						if($attach->ftpfilearray)
						{
						$this->email->attach($newFile);
						}						
						$this->email->send();
						
		                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest'));
		            	redirect('specialpages/support_team');
						
					}
    }

    public function upload_attachment()
		{	
			   error_reporting(0);
		       $this->load->helper('directory');
			   $this->load->helper('file');
			   $status = "";
			   $msg = "";
			   $ftpfiles_i = array();
			   $file_element_name = 'file_i';	  

			   if ($status != "error")
			   {
				  $config['upload_path'] = 'public/uploads/settings/img/logo';
				  $config['allowed_types'] = 'jpg|gif|jpeg|jpg|png|bmp|pdf|eml|rar|zip|doc|docx|xls|xlxs|txt|wav';
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
			  
			   $rs = json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
			   return $rs;
	    }

	    public function video_list_stu()
    {	
        $this->authenticate();

		$this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
		$this->template->set("tmpl",$tmpl);	  
		$this->template->title('Video List');
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
        $this->template->set("configarr", $configarr);
        $pagetype="about";
        $aboutpage=$this->Pagecreator_model->getPageByType($pagetype);
        $this->load->model('admin/testimonials_model');
        $testimonials=$this->testimonials_model->getTestimonials();
        $this->template->set('testimonials',$testimonials);
        $this->template->set('aboutpage','Video List');
	    $this->template->build(getOverridePath($tmpl,'specialpages/view_videos_stu','views'));
    }

     public function createPage()
    {  
    	
      $page_id = $this->uri->segment(3);
      $this->load->model('admin/settings_model');      
      $configarr = $this->settings_model->getItems();	  
      $tmpl = $configarr[0]['layout_template'];      
      $this->template->set("tmpl",$tmpl);
	  $this->template->title('Page1');

      $this->load->model('admin/settings_model');
      $configarr = $this->settings_model->getItems();
      $this->template->set("configarr", $configarr);

      $resourcepage=$this->Pagecreator_model->getPageById($page_id);
      if($resourcepage[0]['status'] =='inactive')
        {
        	redirect(base_url(),'location',301);
        }
      $this->template->set('resourcepage',$resourcepage);
	  $this->template->build(getOverridePath($tmpl,'resourcepages/resourcepage','views'));
    }

    public function conference()
    {      
      	$this->load->model('category_model');      
      	$this->load->model('customs_model');      
		$meetings = $this->Crud_model->GetData('zoom_meeting_list','',"status = 'waiting' OR status = 'started'");
		$data = array('meetings' => $meetings);
		$this->load->view('new_template_design/header');
		$this->load->view('conference/front_conference',$data);
		$this->load->view('new_template_design/footer');
    }

    public function more_pages($name = null,$id = null)
	{
		$blog = $this->Crud_model->get_single('mlms_pagecreater',"page_id = ".$id);
        $data = array(
        		'content' =>$blog->content
        );
        $this->load->view('new_template_design/header');
        $this->load->view('category/demo_blog',$data);
        $this->load->view('new_template_design/footer');
	}

	public function upcoming_lectures(){
		$auth = $this->session->userdata('logged_in');
		if (!empty($auth)) {
			// echo "please wait...";exit;
			$batches = $this->Crud_model->GetData('mlms_buy_courses',"course_id,batch_id,criteria,trial_status","is_delete = 'no' and userid = ".$auth['id']);
			$data = array(
					'batches' => $batches
			);
			// print_r($data);exit;
			$this->load->view('new_template_design/header');
			$this->load->view('conference/upcoming_lectures',$data);
			$this->load->view('new_template_design/footer');
		}else{
			redirect(base_url());
		}
	}
}
?>