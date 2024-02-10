<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MLMS_Controller {

	protected $before_filter = array(
	   //	'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);
	
	function __construct()
	{
		parent::__construct();
        $this->authenticate();
		$this->template->set_layout('backend');
        $this->config->load('installation_config');
        $this->load->model('admin/settings_model');

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


    
   
	public function index()
	{
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));
		
		/* load the view */

		$pay_setting = $this->settings_model->getAccountMode();
		    if(empty($pay_setting['0']['api_username']) && empty($pay_setting['0']['api_password']))
		    {
          		$text = "Your Payment Settings are Incomplete. <a href='".base_url()."admin/settings/account'>Click here to Add Settings</a>";  
	     		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => $text ));
	     	}
		if($pay_setting['0']['paypal_status'] == '0' && $pay_setting['0']['directpay_status'] == '0'){
		$payment_status = ''; }
		else{ $payment_status = '1'; }
		$this->template->set('payment_status', $payment_status);

		$this->template->set('groups',$this->settings_model->getLatestUsers());
		
		$this->template->set('num_of_new_signup',$this->settings_model->getNewSignup()); 

		$this->template->set('num_of_users',$this->settings_model->getAllUsers()); // get numbers of registerd users

		$this->template->set('total_courses',$this->settings_model->getPublishedCourses()); // get total published courses
		
	    $this->template->set('certificate',$this->settings_model->getCertficatesReport()); // certificates
		
		$this->template->set('selling_courses',$this->settings_model->getSellingCourses()); // best selling courses
		
		$this->template->set('usergroups',$this->settings_model->getGroups()); // users groups
		
		$this->template->set('all_user_data',$this->settings_model->getUsers()); // all users 
		
		$this->template->set('totalSale',$this->settings_model->totalSale());

		$overall_sale = $this->Crud_model->get_single('mlms_order','status = "SUCCESS"',"sum(amount) as overall_sale");
		$this->template->set('overall_Sale',$overall_sale->overall_sale);
		
		$this->template->set('totalSales_in_year',$this->settings_model->totalSales_in_year());

		$this->template->set('get_currency',$this->settings_model->getAccountCurrency());		
		
		$this->template->set('getTotalOrders',$this->settings_model->getTotalOrders());
		
		$this->template->set('getRecentOrders',$this->settings_model->getRecentOrders());
		
		$this->template->set('getTotalCourses',$this->settings_model->getTotalCourses());
		
		$this->template->set('getTotalStudents',$this->settings_model->getTotalStudents());


		//@@@@@@@
		//here is the external database connection
		//@@@@@@
		$row ="";
      /*  if($row)
        {

			 $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => $row['days'].' day(s) remaining to expire your subscription.'));
		} */
		//$getExpireDays = $this->settings_model->getExpireDays(1,'mlms_academydetails');
		//$this->template->set('getExpireDays',$getExpireDays);
		$this->template->set('expiring',$row);	
		
	  	$this->template->build('admin/index');
	}

	public function ckeditor()
	{
		$url = FCPATH.'public/uploads/ckeditor/'.time()."_".$_FILES['upload']['name'];
		
		$url_aux = substr($url, strlen(FCPATH) - 1);
			
	    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
	    {
	       $message = "No file uploaded.";
	    }
	    else if(file_exists(FCPATH.'public/uploads/ckeditor/'.$_FILES['upload']['name']))
	    {
	    	$message = "File already exists";
	    }
	    else if ($_FILES['upload']["size"] == 0)
	    {
	       $message = "The file is of zero length.";
	    }
	    else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
	    {
	       $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
	    }
	    else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
	    {
	       $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
	    }
	    else 
	    {
	       $message = "Image uploaded correctly";
	       
	       move_uploaded_file($_FILES['upload']['tmp_name'], $url);
	    }

	    
		$funcNum = $_GET['CKEditorFuncNum'] ;
		$url = $url_aux;
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";

	}


    /*  php script for wizard*/

public function step1($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('stepsstatus', array_merge($this->config->item('stepsstatus'), array('step1' => 'complete')));

       /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	/*** step 2 **/
	function updateinstname()
	{
		$instname=$this->input->post('institutename');
		$this->settings_model->updateInstituteName($instname);
			$data = '';
		//echo '<script>location.href="'.base_url('category/step3').'";</script>';
	}

	public function step2($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('stepsstatus', array_merge($this->config->item('stepsstatus'), array('step1' => 'complete','step2' => 'complete')));

       /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');;
	}

	/*** step 2 End ****/


	function upload_image()
    {		$data = array();
		 $data['file_name'] = '';

	      $file_element_name = 'logoimage';
          $status='';


		  $config['upload_path'] = 'public/uploads/settings/img/';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size']	= '100';
          $config['max_width'] = '490';
          //$config['max_height'] = '250';
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;

		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($file_element_name))
		  {			 $status = "error";
			 $msg = $this->upload->display_errors('','');
		  }
		  else
		  {
             $data = $this->upload->data();
			 $status = "success";
			 $msg = "File successfully uploaded";

		  }

		  @unlink($_FILES[$file_element_name]);

	    echo json_encode(array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']));

    }

	function updateinstlogo()
	{

		$instlogo=$this->input->post('logoimagename');
		$this->settings_model->updateInstituteLogo($instlogo);

		echo '<script>location.href="'.base_url('index/step4').'";</script>';
	}


	public function step3($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));

       /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function updatetheme()
	{

		$institutethemeval=$this->input->post('institutethemeval');
		if($institutethemeval=='')
			$institutethemeval="style.css";

		$this->settings_model->updateInstituteTheme($institutethemeval);

		echo '<script>location.href="'.base_url('index/step4').'";</script>';
	}


	public function step4($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	public function step5($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}


    public function updatelayout_process()
    {
          /*  $institutethemeval=$this->input->post('topmenu');
           $institutethemeval=$this->input->post('searchbox');
           $institutethemeval=$this->input->post('signupbox');
           $institutethemeval=$this->input->post('sidebar');    */

           $ctgspagearray= (object) array(

					'ctgs_image_alignment' => $this->input->post('topmenu')

				);
           $ctgpagearray= (object) array(

					'ctg_image_alignment' => $this->input->post('searchbox')

				);

           $psgpagearray= (object) array(

					'course_image_alignment' => $this->input->post('sidebar')

				);

          $psgspagearray= (object) array(

					'courses_image_alignment' => $this->input->post('signupbox')

				);

                $ctgpagestring = json_encode($ctgpagearray);
				$ctgspagestring = json_encode($ctgspagearray);
				$psgspagearray = json_encode($psgspagearray);
				$psgpagearray = json_encode($psgpagearray);

					$form_data =  array(
					'ctgpage' => $ctgpagestring,
					'ctgspage' => $ctgspagestring,
					'psgspage' => $psgspagearray,
					'psgpage' => $psgpagearray
					);

          $isupdated = $this->settings_model->updateItem($form_data);

		echo '<script>location.href="'.base_url('admin/admin/step5').'";</script>';
    }

	function upload_welcome_image()
    {

		  $data['file_name'] = '';
	      $file_element_name = 'wimage';
          $status='';


		  $config['upload_path'] = 'public/uploads/settings/img/';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size']	= '100';
          $config['max_width'] = '300';
          //$config['max_height'] = '222';
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;

		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($file_element_name))
		  {			 $status = "error";
			 $msg = $this->upload->display_errors('','');
		  }
		  else
		  {
             $data = $this->upload->data();
			 $status = "success";
			 $msg = "File successfully uploaded";

		  }

		  @unlink($_FILES[$file_element_name]);

	    echo json_encode(array('status' => $status, 'msg' => $msg, 'filename' => $data['file_name']));

    }

	function update_process()
	{

		$wtitle=$this->input->post('wtitle');
		$wdesc=$this->input->post('wdesc');
		$wimagename=$this->input->post('wimagename');

		$welcomepage=array('banner_title'=>$wtitle,'banner_desc'=>$wdesc,'banner_image'=>$wimagename);
		$contentarr=json_encode($welcomepage);

		$this->settings_model->updateInstituteWelcomeMsg($contentarr);


	}

	public function step6($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step6' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function update_aboutus_process()
	{

		$wtitle=$this->input->post('atitle');
		$wdesc=$this->input->post('adesc');
		$formdata=array('heading'=>$wtitle,'content'=>$wdesc);

		$this->settings_model->updateInstituteAbt($formdata);


	}

	public function step7($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step6' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step7' => 'yes')));

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}


	function update_contact_process()
	{

		$address=$this->input->post('address');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$web=$this->input->post('web');
		$mapcode=$this->input->post('mapcode');

		$settingarr=array(

                     'address'=>$address,

                     'phone'=>$phone,

                     'email'=>$email,

                     'weburl'=>$weburl,

                     'mapcode'=>$mapcode,

                    );

		$data = array(
    				'settings' => json_encode($settingarr),

    				'createdon' => date("Y-m-d")
    			);
		$pageid='1';

		$this->Pagecreator_model->updateItem($pageid,$data);

	}

	public function step8($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step6' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step7' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step8' => 'yes')));

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function update_finish_process()
	{
		$this->settings_model->updateVisitedStatus();
	}


	public function finish($parent_id = NULL)
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step6' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step7' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step8' => 'yes')));

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		redirect('admin/smartcoursemanager');
		/* load the view
	  	$this->template->build('admin/index');
		*/
	}


	function skipstep1()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
         /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function skipstep2()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));

         /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function skipstep3()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function skipstep4()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));

         /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function skipstep5()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function skipstep6()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step6' => 'yes')));

       /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function skipstep7()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step6' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step7' => 'yes')));


        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

	function skipstep8()
	{
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step1' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step2' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step3' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step4' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step5' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step6' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step7' => 'yes')));
		$this->config->set_item('steps', array_merge($this->config->item('steps'), array('step8' => 'yes')));


        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title(lang('web_home'));

		/* load the view */
	  	$this->template->build('admin/index');
	}

/*  php script for wizard closed */



}