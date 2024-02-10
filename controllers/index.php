<?php
class Index extends MLMS_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->helper('commonmethods');
        $this->load->helper('text');
		$this->load->model('admin/settings_model');
		$this->load->model('login_model');
		$configarr = $this->settings_model->getItems();
	
		date_default_timezone_set($configarr[0]['time_zone']);

		$this->template->set_layout($configarr[0]['layout_template']);
		$socailloginarray = json_decode($configarr[0]['sociallogin']);
		$socailloginarray->facebook->appid;
		$socailloginarray->facebook->appsecretkey;
		$this->load->library('facebook/facebook', array('appId' => $socailloginarray->facebook->appid, 'secret' => $socailloginarray->facebook->appsecretkey));
	}
	public function index()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		/*$this->form_validation->set_rules('name','name', 'required');
		$this->form_validation->set_rules('email','email', 'required');*/
		
		$this->form_validation->set_rules('Email', 'Email', 'callback_rolekey_exists');

		$sessionarray = $this->session->userdata('logged_in');
		$user_id = $sessionarray['id'];
		if(isset($user_id))
        {
	       //redirect('/category/');
        	//redirect('/category/');//on dated 18-06-2015
	    }
		/*print_r($_POST);	*/
		$this->session->unset_userdata('sess_search_course');
		$this->template->title("Home");
        $page = "home";
        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems();
      
		$tmpl = $configarr[0]['layout_template'];
        $this->load->model('Category_model');
        $this->template->set("tmpl", $tmpl);
        $totalcourse =$configarr[0]['course_total'];    

        /*$this->template->set("categories", $this->Category_model->getAllCateg());
        print_r($this->Category_model->getProgram());*/
        //echo"<pre>";
        //print_r($configarr);
        //echo"</pre>";
        $this->template->set("programs", $this->Category_model->getFeaturedProgram($totalcourse));
        $this->template->set("home", $page);
        $this->template->set("configarr", $configarr);
		 /*login with facebook*/
        	   $fbloginUrl = $this->facebook->getLoginUrl(
	array( 
	'scope' => 'user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_online_presence,user_photo_video_tags,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,user_work_history,email,read_friendlists,read_insights,read_mailbox,read_requests,read_stream,xmpp_login,ads_management,create_event,manage_friendlists,manage_notifications,offline_access,publish_checkins,publish_stream,rsvp_event,sms,publish_actions,manage_pages',
	'redirect_uri'	=> base_url().'users/registration'
	));
	$this->template->set("fbloginUrl", $fbloginUrl);
	/*login with facebook*/
       
        $this->template->build(getOverridePath($tmpl,'index/index','indexviews'));
	}
	
	public function search_result()
	{

       $tmpl = "default";	 
	   $this->load->model('Category_model');	
	   $this->load->model('program_model');	
	   $sess_search_course = $this->session->userdata('sess_search_course');
	   $searchtext = ($this->input->post('searchtext', TRUE)) ? $this->input->post('searchtext', TRUE) : $sess_search_course['searchterm'];

	   $searchdata = array(
				 "searchterm" => $searchtext				
				 );
	   $this->session->set_userdata('sess_search_course', $searchdata);
	   $configarr = $this->settings_model->getItems();
		$tmpl = $configarr[0]['layout_template'];
	   
      // $searchtext = ($this->input->post('searchtext') != '') ? $this->input->post('searchtext') : '';
       $search_results = $this->program_model->get_search_results(addslashes($searchtext));   
       $this->template->set("tmpl", $tmpl);
       $this->template->set("search_results", $search_results);
       $this->template->build(getOverridePath($tmpl,'programs/search_result','views'));
	}

	public function contact($result = NULL)
	{
		$this->template->title(lang('web_contact'));

		$this->_set_rules();
		$configarr = $this->settings_model->getItems();
		$tmpl = $configarr[0]['layout_template'];
		if ($this->form_validation->run() == FALSE)
		{
			$this->template->build(getOverridePath($tmpl,'index/contact','views'));
		}
		else
		{
			$form_data = array(
		       	'name' 		=> $this->input->post('name', TRUE ), 
		       	'lastname' 	=> $this->input->post('lastname', TRUE ), 
		       	'email' 	=> $this->input->post('email', TRUE ), 
		       	'phone' 	=> $this->input->post('phone', TRUE ), 
		       	'comments'	=> $this->input->post('comments', TRUE)
			);

			$this->load->library('email');

			$this->email->from('prshah83@gmail.com', 'Contacto Codeigniter');
			$this->email->to('prshah83@gmail.com');

			$this->email->subject('Formulario de Contacto Codeigniter');

			$message = $this->load->view('index/email/formcontact.tpl.php', $form_data, TRUE);

			$this->email->message($message);

			if ( $this->email->send() )
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_mail_ok') ));
				redirect('contact');
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_mail_ko') ) );
				redirect('contact');				
			}
		}
	}


	 /**
     * Set rules for form
     * @return void
     */
	private function _set_rules()
	{
		//validate form input
		$this->form_validation->set_rules('name', 'lang:web_name', 'required|trim|xss_clean|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('lastname', 'lang:web_lastname', 'required|trim|xss_clean|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('email', 'lang:web_email', 'required|trim|valid_email|xss_clean');
		$this->form_validation->set_rules('phone', 'lang:web_phone', 'required|trim|numeric|xss_clean');
		$this->form_validation->set_rules('comments', 'lang:web_comments', 'required|trim|xss_clean');

		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	}

	public function subscription()
	{
		// $urldomain = base_url();
		// $urldomain = str_replace('http://', '', $urldomain);
		// $urldomain = str_replace('/', '', $urldomain);
		// $urldomain = str_replace('www.', '', $urldomain);
		$urldomain = $this->config->item('urldomain');

		$this->load->helper('form');
		$this->load->library('form_validation');

		/*$this->form_validation->set_rules('name','name', 'required');
		$this->form_validation->set_rules('email','email', 'required');*/
				
		$this->form_validation->set_rules('Email', 'Email', 'callback_rolekey_exists');

		if ($this->form_validation->run() == FALSE)
		{
			redirect('index');
		}
		else
		{	
			$uid = 0;
			$sessionarray = $this->session->userdata('logged_in');
				if($sessionarray)
				{
				$user_id = $sessionarray['id'];
		       $uid = $user_id ? $user_id :'0';	
		       	}
			$data = array(
				'name' => $_POST['Name'],
				'email' => $_POST['Email'],
				'date_time' => date("Y-m-d h:i:s"),
        		'userid' => $uid 
			);
			$this->db->insert('mlms_subscriptions', $data);
			//redirect('index');
			//new code start
							$this->load->model('admin/settings_model');
							$configarr = $this->settings_model->getItems();

							$subject = 'You are now subscribed to '.$configarr[0]['institute_name'].' newsletter';
							$toemail = $_POST['Email'];
							$content = '';
							$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">You are now subscribed to '.$configarr[0]['institute_name'].' newsletter</p>';
							$content .= '<p>Hi '.trim(ucfirst($_POST['Name'])).',<br /><br />';
							$content .="You have Successfully subscribed to '".$configarr[0]['institute_name']."' Newsletter and all the future updates will be sent to this email address.<br />";
							//$content .= 'Thanks,<br /><br />';
		                    //$content .= 'Your '.$configarr[0]['institute_name'].' Team.</p>';
							// $content .= '<br /><br />';
							// $content .= '...</p>';
							// $content .= $configarr[0]['signature'].'</p>';
							//$message = $content;
							$data['content'] = $content;
					        $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
							// $fromemail=$configarr[0]['fromemail'];
							$fromemail='noreply@'.$urldomain;		
							$config['charset'] = 'utf-8';
							$config['mailtype'] = 'html';
							$config['wordwrap'] = TRUE;
							$this->email->initialize($config);
							$this->email->from($fromemail, $configarr[0]['fromname']);
							$this->email->subject($subject);
							$this->email->to($toemail);
							$this->email->message($message);
							$this->email->send();
							
							$admininfo = $this->login_model->getadminInfo(4);

							$subject = trim(ucfirst($_POST['Name'])).' has subscribed to your academy';
							$toemail = $admininfo->email;
							$content = '';
							$content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">'.trim(ucfirst($_POST['Name'])).' has subscribed to your academy</p>';
							$content .= '<p>Hi '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
							$content .= trim(ucfirst($_POST['Name']))." has Successfully subscribed to '".$configarr[0]['institute_name']."' Newsletter.<br />";
							//$content .= 'Regards,<br /><br />';
		                    //$content .= 'The '.$configarr[0]['institute_name'].' Team.</p>';
							//$message = $content;
							// $content .= '<br /><br />';
							// $content .= '...</p>';
							// $content .= $configarr[0]['signature'].'</p>';
							$data['content'] = $content;
							$message = $this->load->view('email_formates/admin_email_formate.php',$data,true);
							// $fromemail = $configarr[0]['fromemail'];
							$fromemail='noreply@'.$urldomain;
							$config['charset'] = 'utf-8';
							$config['mailtype'] = 'html';
							$config['wordwrap'] = TRUE;
							$this->email->initialize($config);
							$this->email->from($fromemail, $configarr[0]['fromname']);
							$this->email->subject($subject);
							$this->email->to($toemail);
							$this->email->message($message);
							

			if ( $this->email->send() )
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Newsletter Subscription Successfully Done' ));
				redirect('index');
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Newsletter Subscription Failed' ) );
				redirect('index');				
			}
			//new code end
		}

		
		//$this->settings_model->insertSubscription($data);
	}

	function rolekey_exists($key)
	{

	     $this->db->where('email',$key);
	    $query = $this->db->get('mlms_subscriptions');
	    if ($query->num_rows() > 0)
	    {
	    		$this->session->set_userdata('error_email', 'Email Already Exists');
	    	    return false;
	    }
	    else
	    {
	        return true;
	    }
	}

}