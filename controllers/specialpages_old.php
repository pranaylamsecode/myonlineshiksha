<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specialpages extends MLMS_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('commonmethods');
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		$this->template->set_layout($configarr[0]['layout_template']);
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

				/* $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'myusername@gmail.com',
                'smtp_pass' => 'mypassword',
				);*/
				//$this->load->library(‘email’, $config);
				//$this->load->library('email',$config);
				// $mailto = $this->input->post('mailto');
				// if($mailto == 'Enquiry')
				// {	
				// 	//$admin_email = 'enquiry@createonlineacademy.com';
				// 	//Attached 3 mail for tasks 1. Ticket Generated Email to Student and Ticket Email to Admin
				// 	// i.e f a student sends an enquiry then it will generate an email and sends to support team of the institutes
				// 	$admin_email = 'enquiry@createonlineacademy.com, support@createonlineacademy.com, admin@createonlineacademy.com';
				// //$admin_email =""; 
				// }
				// if($mailto == 'Support')
				// {	
				// 	$admin_email = 'support@createonlineacademy.com';
				// }
				// if($mailto == 'Billing')
				// {	
				// 	$admin_email = 'billing@createonlineacademy.com';
				// }
				// if($mailto == 'Technical')
				// {	
				// 	$admin_email = 'technical@createonlineacademy.com';
				// }
				// if($mailto == 'Sales')
				// {	
				// 	$admin_email = 'sales@createonlineacademy.com';
				// }
				
				$urldomain = base_url();
				$urldomain = str_replace('http://', '', $urldomain);
				$urldomain = str_replace('/', '', $urldomain);
				$urldomain = str_replace('www.', '', $urldomain);

				$fromemail='noreply@'.$urldomain;		 		

				$admininfo = $this->login_model->getadminInfo(4);				


				$admin_email='sachengawai@gmail.com';         //$admininfo->email;

				$admininfo = $this->login_model->getadminInfo(4);
				$configarr = $this->settings_model->getItems();
				$this->load->library('email');
				$subject1 = 'New Enquiry for '.$configarr[0]['institute_name'];
				$toemail = $admin_email;
				$content = '';
				$content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
				$content .='There is a new Enquiry. Here are the details:<br /><br />';
				$content .= 'Email : '.$email.'<br /><br />';
				$content .= 'Subject : '.$subject.'<br /><br />';
				$content .= 'Message : '.$body.'<br /><br />';
				$content .='<br /><br />';
				$content .='...</p>';
				$content .= $configarr[0]['signature'].'</p>';
				$data['content'] = $content;
				$message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
				
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$this->email->initialize($config);
				$this->email->from($fromemail,$configarr[0]['fromname']);
				$this->email->to($toemail);
				$this->email->subject($subject1);
				$this->email->message($message1);
				
				$this->email->send();
				//$this->session->set_userdata('contactmail', 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest');
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest'));
            	redirect('specialpages/contactuspage');
            }
		}
		//print_r($configarr[0]->fromname;$configarr[0]->fromemail);
		$this->template->set("configarr", $configarr);
		$pagetype="contact";
		$contactpage=$this->Pagecreator_model->getPageByType($pagetype);
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

}
?>