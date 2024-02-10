<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Languages extends MLMS_Controller
{
    function __construct()
    {
        parent::__construct();

        //$this->load->helper(array('form', 'url'));

        $this->load->model('admin/users_model');	
		
        $this->load->model('admin/language_model');		
		
        $this->load->model('login_model');

        $this->template->set_layout('backend');

        $this->load->library('ckeditor');

        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';

        $this->load->helper('form');

        $this->load->helper('url');	

		$this->lang->load('tooltip', 'english');

        $this->load->library('form_validation');

        $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);

     }



    function authenticate()

    {

        $session = $this->session->userdata('loggedin');

        if(!$this->session->userdata('loggedin'))

        {

         redirect('admin/users/login');

        }

    }

    function login()
    {
		if($this->session->userdata('loggedin'))
        {
			redirect('admin');          
        }

        $this->template->set_layout('login');
        $this->template->title('Login');
        $this->template->build('admin/users/login');
		$user_name = $this->input->post('user_name');
		$password = $this->input->post('password');
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if(isset($user_name)&& $user_name!="" && isset($password)&& $password!="")
        {
			$this->form_validation->set_rules('mymsg','','callback_check_login');
		}
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/users/login');
		}
		else
		{
            $this->users_model->validate();
            $data= $this->users_model->setSessionData($user_name,$password);
            $this->session->set_userdata('loggedin',$data);
            if($this->session->userdata('loggedin')){
            $session_data = $this->session->userdata('loggedin');
            $data['user_name'] = $session_data['user_name'];
			redirect('admin/');
            }else{
            redirect('admin/');
            }
		}
    }
	
	
	function register()
    {
		if($this->session->userdata('loggedin'))
        {
			redirect('admin');          
        }

        $this->template->set_layout('login');
        $this->template->title('Register');
        $this->template->build('admin/users/login');
		$user_name = $this->input->post('user_name');
		$password = $this->input->post('password');
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if(isset($user_name)&& $user_name!="" && isset($password)&& $password!="")
        {
			$this->form_validation->set_rules('mymsg','','callback_check_login');
		}
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/users/register');
		}
		else
		{
		exit('ram');
            $this->users_model->validate();
            $data= $this->users_model->setSessionData($user_name,$password);
            $this->session->set_userdata('loggedin',$data);
            if($this->session->userdata('loggedin')){
            $session_data = $this->session->userdata('loggedin');
            $data['user_name'] = $session_data['user_name'];
			redirect('admin/');
            }else{
            redirect('admin/');
            }
		}
    }

	/***   V ****/
    public function username_check($username)
	{
        if($this->users_model->checkUserName($username))

                {

                     return true;

                }

                return false;

	  }



      public function check_login()

      {

             $username = $this->input->post('user_name');

             $password = $this->input->post('password');

						

            if($this->users_model->checkUserLogin($username,$password))

            {

                     return true;

            }

            return false;

      }

      public function check_login_group()

      {

           $username = $this->input->post('user_name');

           $password = $this->input->post('password');

            if($this->users_model->checkUserLoginGroup($username,$password))

            {



                     return true;

            }

            return false;

      }



      /*** V E ****/







   function logout() 
   {
      $this->session->sess_destroy();
      $this->session->unset_userdata('loggedin');
      $this->session->unset_userdata('mparr');
      $this->session->set_userdata(array('user_name' => ''));
  		?>
		<script>

		var path = window.parent.location.href;

		var pathsegarray = path.split('/');

		if((pathsegarray[3]=='smartcoursemanager') || (pathsegarray[4]=='smartcoursemanager') || (pathsegarray[5]=='smartcoursemanager') || (pathsegarray[6]=='smartcoursemanager') || (pathsegarray[7]=='smartcoursemanager')){

		

		window.parent.location.href = '<?php echo base_url();?>admin';

		}else{

		window.location.href = '<?php echo base_url();?>admin';

		}

		

		</script>

		<?php

        redirect('login','refresh');

   }

   function index_old45($user_id = NULL)
   {
        $this->authenticate();

        $this->template->title('User List');

        if($user_id){

        $this->template->set("users", $this->users_model->getItems($user_id));

        }else{

        $this->template->set("users", $this->users_model->getItems($user_id));

        }

        $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

        $this->template->build('admin/users/list');

    }

  public function index($user_id = NULL)

	{
		
		$this->authenticate();

       $user_id = NULL;

       //$this->session->unset_userdata('sess_usersgroup');

       $this->template->set_layout('backend');

       $this->template->title('Language List');

       $sess_lang = $this->session->userdata('sess_lang');

	   //print_r($sess_usersgroup);


       if($this->input->post('reset') == 'Reset'){

       $search_string = $this->input->post('search_text', TRUE);       

       $search_ugroup = $this->input->post('search_group', TRUE);       

       $this->session->unset_userdata('sess_lang');

       $search_string = '';       

       $search_ugroup = '';       

      }else{

       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_lang['searchterm'];

      // $search_ugroup = ($this->input->post('search_group', TRUE)) ? $this->input->post('search_group', TRUE) : $sess_usersgroup['searchgroup'];

      

       $searchdata = array(

				 "searchterm" => $search_string				 

				 );

	   $this->session->set_userdata('sess_lang', $searchdata);

       }



       $path=base_url() . "admin/languages/";



       $start = ( $this->uri->segment(3)) ? $this->uri->segment(3) : 0;

       $baseurl = base_url() . "admin/languages/";

       $this->load->library('pagination');

       $config["base_url"] = $baseurl;

       $config['per_page'] = 10;

       $config['enable_query_strings'] = true;

       $config['uri_segment'] = 3;

       $config['total_rows'] = $this->language_model->getlangcount($search_string);

       $this->template->title('Language List');

       $this->pagination->initialize($config);	   

       $this->template->set("language", $this->language_model->getLanguage($config['per_page'],$start,$search_string));
	   
	   $this->template->set("countlang", $this->language_model->getcountUsers());

	      

       $this->template->set("search_string", $search_string);

     

	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

	   $this->template->build('admin/languages/list');

	}
	
	public function trashusers($parent_id = NULL)
	{
		$user_id = NULL;
		$start =  0;
        $config['per_page'] = 10;
		$search_string = '';
		$search_ugroup = '';  
		
		$this->template->set("users", $this->users_model->getTrashItems($user_id,$config['per_page'],$start,$search_string,$search_ugroup));
		$this->template->set_layout('backend');
        $this->template->title('Trash Users');
		$this->template->build('admin/users/trashusers');
	}
	
	function repostuser($id = NULL)
	{
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/users/');
		}
		$isdelete=$this->users_model->repostTrash($id);
	   	redirect('admin/users');
	}

   function index_old($parent_id = NULL)

   {

        $this->authenticate();

        $this->template->title('User List');

        if($parent_id){

        $this->template->set("users", $this->users_model->getItems($parent_id));

        }else{

        $this->template->set("users", $this->users_model->getItems($parent_id));

        }

        $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

        $this->template->build('admin/users/list');

    }
	
	public function PublishLang()
	{
		 $bid=$this->uri->segment(4);
		
		
			if( $this->language_model->publishLang($bid) )
            {
				$operationstatus='Language published Successfully';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo '<script>location.href="'.base_url('admin/languages/').'";</script>';
            }
            else
            {
				$operationstatus='Unable To Publish Blog';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                //echo $this->lang->line('technical_problem');
            }
	
	}
	
	public function unPublishLang()
	{
	      
		   $bid=$this->uri->segment(4);
		  
		
		
		
			if( $this->language_model->unPublishLang($bid) )
            {
				$operationstatus='Language unpublished Successfully';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo '<script>location.href="'.base_url('admin/languages/').'";</script>';
            }
            else
            {
				$operationstatus='Unable To Unpublish Blog';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                //echo $this->lang->line('technical_problem');
            }
		
	}

    function create($parent_id = FALSE)

    {
       
    	$this->authenticate();

    	$this->template->append_metadata(block_submit_button());

        $loggeduser_data=$this->session->userdata('loggedin');
		
		//$this->template->set("order", $this->users_model->getIndividualOrder(($parent_id)));



    	$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);

    	$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

    	//$this->_set_rules(); //

    	$this->template->set('title', lang('web_category_create'));

    	$this->template->set('updType', 'create');

    	$this->template->set('parent_id',$parent_id);
		
		
		
		//$this->template->set('username',$this->settings_model->getUsersName());
		//$this->template->set('courses',$this->settings_model->getCourses());
		
		

        $this->form_validation->set_rules('language', 'language', 'required');
		
       // $this->form_validation->set_rules('user_id', 'user_id', 'required');
       // $this->form_validation->set_rules('status_id', 'status_id', 'required');

        //$this->form_validation->set_rules('pending_reason', 'pending_reason', 'trim|required|xss_clean');

       // $this->form_validation->set_rules('processor', 'processor', 'trim|required|xss_clean');



      //  $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');



       	if ($this->form_validation->run() === FALSE)

    	{
          // exit('if');
    	  	$this->template->build('admin/languages/create');



    	}

    	else

      	{
		 
          //exit('derge');
      	 /* Array
			(
				[user_id] => 81
				[course_id] => 251
				[plan] => Economy
				[price] => 2000
				[status_id] => Paid
				[pending_reason] => 
				[amount] => 3000
				[processor] => PayPal
				[submit] => Save
			) */

			 
          $data = array(

            /*'username'		=>	$this->input->post('username'), */

            'name'		=>	$this->input->post('language'),

            'active' 	=>  $this->input->post('active')           

          );

        

      //  $usergroups = $this->input->post('group_id');
	 

       $this->language_model->insertLanguage($data);	   

       $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

       redirect('admin/languages/');

       }

    }





    function valid_url($url)

    {

        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";

        return (bool) preg_match($pattern, $url);

    }



     /*function valid_url ($url){



  $pattern = '/' . '^(https?:\/\/)[^\s]+$' . '/';



  preg_match($pattern, $url, $matches);



  $CI =& get_instance();

  $CI->form_validation->set_message('valid_url', "The url must start with 'http://' or contain no spaces");



  return (empty($matches)) ? FALSE : TRUE;



}*/

     function user_exists($username) {



           $user_check = $this->login_model->checkUserName($username);



          if($user_check > 0) {

              $this->form_validation->set_message('user_exists', 'This username is already taken');

              return FALSE;

          }

          else {

              return TRUE;

          }



      }

      function email_exists($email) {



          $check_email = $this->login_model->email_exists($email);



          if($check_email > 0) {

              $this->form_validation->set_message('email_exists', 'This email is already in use');

              return FALSE;

          }

          else {

              return TRUE;

          }



      }

    public function upload_image()

    {
	
	    $this->authenticate();

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

        $config['upload_path'] = FCPATH.'public/uploads/users/img/thumbs/';

        $config['allowed_types'] = 'gif|jpg|png';

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

      	$file_id = true;

        $data = $this->upload->data();

      	$file_id = true;

      	if($file_id)

      	{

      		$status = "success";

      		$msg = "File successfully uploaded";

            $config = array();

    		$config['image_library'] = 'gd2';

    	    $config['source_image'] = FCPATH.'public/uploads/users/img/'.$data['file_name'];

    		$config['new_image'] = FCPATH.'public/uploads/users/img/thumbs/'.$data['file_name'];
			
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

        @unlink($_FILES[$file_element_name]);

        }

          json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));

    }
	
	

    function edit($id = FALSE)

    {
      
        $this->authenticate();

    	$this->template->append_metadata(block_submit_button());

        $loggeduser_data=$this->session->userdata('loggedin');
		
		$this->template->set("language", $this->language_model->getIndividualLang(($id)));
		
		//$indi_order = $this->users_model->getIndividualOrder(($uid));


        $id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		

    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		

    	//$this->_set_rules(); //

    	$this->template->set('title', lang('web_category_create'));

    	$this->template->set('updType', 'edit');

    	$this->template->set('id',$id);
		
		
		 $this->form_validation->set_rules('language', 'language', 'required');
		

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed

        {

        	$this->template->build('admin/languages/create');

        }

        else

        	{
			
			 
			  
			
			$data = array(

            /*'username'		=>	$this->input->post('username'), */

            'name'		=>	$this->input->post('language'),

            'active' 	=>  $this->input->post('active')           

          );

        		           
               

            $isupdated = $this->language_model->updateLang($id,$data);   
			

               

        		if ($isupdated) // the information has therefore been successfully saved in the db

        		{

        		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				  

        			redirect('admin/languages');

        		}

        		else{

        			redirect('admin/languages');

        		}

        	}

    }

	function trash($id = NULL)
    {
		$this->authenticate();

    	//filter & Sanitize $id

    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

    	//redirect if it´s no correct

    	if (!$id)
		{

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

    		redirect('admin/users/');

    	}

		$isdelete = $this->users_model->trashItem($id);
		if ($isdelete)
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
    	}
    	else
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}
    	redirect('admin/users');
    }

    function delete($id = NULL)
    {
		$this->authenticate();

    	//filter & Sanitize $id

    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

    	//redirect if it´s no correct

    	if (!$id){

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

    		redirect('admin/users/');

    	}

		if($this->users_model->deleteItem($id)){

               $isdelete = $this->users_model->deleteUserGroup($id);

        }

    	//delete the item

    	if ($isdelete)

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));

    	}

    	else

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );

    	}
    	redirect('admin/users');
    }

    //activate the user

    function activate($id, $code=false)

    {$this->authenticate();

    if ($code !== false)

    	$activation = User::activate($id, $code);

    else if ($this->sangar_auth->is_admin())

    	$activation = User::activate($id);



    if ($activation)

    {

    	//redirect them to the forgot password page

    	$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('activate_successful')) );





    	if (!$this->sangar_auth->logged_in())

    		redirect("login/", 'refresh');

    	else

    		redirect("/admin/users/", 'refresh');

    }

    else

    {

    	//redirect them to the forgot password page

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('activate_unsuccessful')) );

    	redirect("login/", 'refresh');

    }



    }



    //deactivate the user

    function deactivate($id = NULL)

    {$this->authenticate();

    // no funny business, force to integer

    $id = (int) $id;



    if ($this->sangar_auth->is_admin())

    {

    	$code = User::deactivate($id);



    	if ($code)

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('deactivate_successful')) );

    	}

    	else

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('deactivate_unsuccessful')) );

    	}



    	redirect("/admin/users/", 'refresh');

    }

    else

    {

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_not_do_this')) );

    	redirect("/admin/users/", 'refresh');

    }

    }









    private function _set_rules($type = 'create', $id = NULL)

    {

    //validate form input

    $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');

    $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|xss_clean');
	
	

    //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');



    	if ($id)

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email.id.'.$id.']|xss_clean');

		}

		else

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

		}





   /* if ($id)

    {

    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

    }

    else

    {

    	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

    }*/



    if ($type == 'edit')

    	$this->form_validation->set_rules('password', 'Password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');

    else

    	$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');



    if ($type == 'edit')

    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', '');

    else

    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');



    $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

    }

    //forgot password

    function forgot_password()

    {

      	$this->template->set_layout('frontend');

    $this->template->title('Login');



    $this->form_validation->set_rules('email', 'lang:web_email', 'required|trim|clean_xss|valid_email');

    $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');



    if ($this->form_validation->run() == false)

    {

    	//setup the input

    	$this->template->set('email', array('name' => 'email', 'id' => 'email',));



    	//set any errors and display the form

    	$this->template->set('message', (validation_errors()) ? validation_errors() : $this->session->flashdata('message'));



    	$this->template->build('users/forgot_password');

    }

    else

    {

    	//run the forgotten password method to email an activation code to the user

    	$forgotten = $this->sangar_auth->forgotten_password($this->input->post('email'));



    	if ($forgotten)

    	{

    		//if there were no errors

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('remember_pass_successful') ));

    		redirect("/login", 'refresh'); //we should display a confirmation page here instead of the login page

    	}

    	else

    	{

    		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('remember_pass_unsuccessful') ));

    		redirect("/forgot_password", 'refresh');

    	}

    }

    }

    public function reset_password($code)

    {

    $reset = $this->sangar_auth->forgotten_password_complete($code);



    if ($reset)

    {

    	//if the reset worked then send them to the login page

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('password_change_successful')) );

    	redirect("/login", 'refresh');

    }

    else

    {

    	//if the reset didnt work then send them back to the forgot password page

    	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('password_change_unsuccessful')) );

    	redirect("/forgot_password", 'refresh');

    }

    }



}

