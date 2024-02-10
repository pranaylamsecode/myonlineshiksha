<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MLMS_Controller
{
    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        //$this->load->helper(array('form', 'url'));

        $this->load->model('admin/users_model');		

        $this->load->model('program_model'); 
		
			  $this->load->model('admin/settings_model');

        $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);
		
        $this->load->model('login_model');

        $this->template->set_layout('backend');

        $this->load->library('ckeditor');

        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';

        $this->load->helper('form');

        $this->load->helper('url');	

		    $this->lang->load('tooltip', 'english');

        $this->load->library('form_validation');
        ob_start();
    }

    function authenticate()
    {
        $session = $this->session->userdata('loggedin');

        if(!$this->session->userdata('loggedin'))
        {

         redirect('admin/users/login');

        }
    }


      function blocked()
    {
      $this->load->view('admin/users/blocked');
    }

      function expired()
    {
      $this->load->view('admin/users/expired');
    }

    public function page404()
    {
        $this->template->title('404 Page Found');
        $this->template->build('admin/users/page404');
    }

    public function dberror()
    {
        $this->template->title('DB Error Found');
        $this->template->build('admin/users/dberror');
    }

    public function bugfound()//php error
    {
        $this->template->title('Bug Found');
        $this->template->build('admin/users/bugfound');
    }

    function login()
    {
		  if($this->session->userdata('loggedin'))
      {
			 // redirect('admin'); 
        
       redirect('admin', 'location', 301);        
      }
        
        //echo '<pre>'; print_r($this->session->all_userdata());exit;
        $this->template->set_layout('login');
        $this->template->title('Login');
        //$this->template->build('admin/users/login');
    		$user_name = $this->input->post('user_name');
    		$password = $this->input->post('password');
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
       /* if(isset($user_name)&& $user_name!="" && isset($password)&& $password!="")
        {
			$this->form_validation->set_rules('mymsg','','callback_check_login');
		} */
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/users/login');
		}
		else
		{

		    $ud = $this->users_model->getUsers($user_name);	
        if($ud)
		    {
		      /*  if($ud['0']['group_id'] != '4' && $ud['0']['group_id'] != '3')
			      {
			       		$this->template->build('admin/users/login');
						}
			     else{ */
                  if($this->session->all_userdata())
                  {
                    $this->load->helper('cookie');
                    delete_cookie("ci_session");                    
    							}
                  $this->users_model->validate();
    			       	$data= $this->users_model->setSessionData($user_name,$password);
          				$this->session->set_userdata('loggedin',$data);
          				if($this->session->userdata('loggedin'))
                  {   
                      $this->view_frontsite();
              				$session_data = $this->session->userdata('loggedin');
              				$data['user_name'] = $session_data['user_name'];								
              				redirect('admin/');
          				}
                  else
                  {
              				redirect('admin/');
              				//echo"success";
              				//$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'invalid user' ) );
          				}
      	//	}
		  }
		  else
		  {
		  		//echo"<script> alert('invalid UserName or Password '); </script>";
		  	redirect('admin/users/login/invalid');
        //$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'invalid user' ) );
		  	
		  }
		}
    }

 function login_action()
    {
        if($this->session->userdata('loggedin'))
        {
          $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'You are already loigin' ) );
           // echo"You are already loigin";  
           redirect('admin/');
       
        }

       $user_name = $this->input->post('user_name');
       $password = $this->input->post('password');

       if(trim($user_name)=="")
       {
         $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please enter User Name' ) );
          redirect('admin/users/login');

          //echo"Please enter User Name";
       }

       if(trim($password)=="")
       {
        $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please enter Password' ) );
        redirect('admin/users/login');

        // echo"Please enter Password";
       }

      $ud = $this->users_model->getAdminUsers($user_name); 

      if($ud)
      {

          if(MD5(trim($password)) == $ud->password)
          {
             // =====================

              if($this->session->all_userdata())
                  {
                    $this->load->helper('cookie');
                    delete_cookie("ci_session");                    
                  }
                 
                  $this->users_model->validate();
                  $data= $this->users_model->setSessionData($user_name,$password);
                  $this->session->set_userdata('loggedin',$data);
                  if($this->session->userdata('loggedin'))
                  {   
                      $this->view_frontsite();
                      $session_data = $this->session->userdata('loggedin');
                      $data['user_name'] = $session_data['user_name'];

                    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => ' successfully login'));
                     redirect('admin/');
                  }
                  else
                  {
                     $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Failed to login, Please try again' ) );
                        redirect('admin/users/login');
                      // echo"failed";
                     
                  }

        // ===================
          }
          else
          {
            $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid Password' ) );
           redirect('admin/users/login');

           // echo"Invalid Password";
          }
      }
      else
      {     $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid User' ) );
           redirect('admin/users/login');
            // echo"Invalid User";

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




   function logoutadmin() 
   {     
      $this->session->sess_destroy();
      $this->session->unset_userdata('loggedin');
      $this->session->unset_userdata('mparr');
      $this->session->unset_userdata('Active_menu');
      //$this->session->set_userdata(array('user_name' => ''));

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

       $this->template->title('User List');

       $sess_usersgroup = $this->session->userdata('sess_usersgroup');

	   //print_r($sess_usersgroup);


       if($this->input->post('reset') == 'Reset'){

       $search_string = $this->input->post('search_text', TRUE);       

       $search_ugroup = $this->input->post('search_group', TRUE);       

       $this->session->unset_userdata('sess_usersgroup');

       $search_string = '';       

       $search_ugroup = '';       

      }else{

       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_usersgroup['searchterm'];

       $search_ugroup = ($this->input->post('search_group', TRUE)) ? $this->input->post('search_group', TRUE) : $sess_usersgroup['searchgroup'];
  

       $searchdata = array(

				 "searchterm" => $search_string,			 

				 "searchgroup" => $search_ugroup				 

				 );

	   $this->session->set_userdata('sess_usersgroup', $searchdata);

       }



       $path=base_url() . "admin/users/";



       $start = ( $this->uri->segment(3)) ? $this->uri->segment(3) : 0;

       $baseurl = base_url() . "admin/users/";

       $this->load->library('pagination');

       $config["base_url"] = $baseurl;

       $config['per_page'] = 10;

       $config['enable_query_strings'] = true;

       $config['uri_segment'] = 3;

       $config['total_rows'] = $this->users_model->getusercount($search_string,$search_ugroup);

       $this->template->title('User List');

       $this->pagination->initialize($config);	   

       $this->template->set("users", $this->users_model->getItems($user_id,$config['per_page'],$start,$search_string,$search_ugroup));
	   
	  
	   $this->template->set("countusers", $this->users_model->getcountUsers());

	      

       $this->template->set("search_string", $search_string);    
	  

	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

	   $this->template->build('admin/users/list');

	}
	
	public function external($user_id = NULL)

	{
		
		$this->authenticate();

       $user_id = NULL;

       //$this->session->unset_userdata('sess_usersgroup');

       $this->template->set_layout('backend');

       $this->template->title('User List');

       $sess_usersgroup = $this->session->userdata('sess_usersgroup');

	   //print_r($sess_usersgroup);


       if($this->input->post('reset') == 'Reset'){

       $search_string = $this->input->post('search_text', TRUE);       

       $search_ugroup = $this->input->post('search_group', TRUE);       

       $this->session->unset_userdata('sess_usersgroup');

       $search_string = '';       

       $search_ugroup = '';       

      }else{

       $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_usersgroup['searchterm'];

       $search_ugroup = ($this->input->post('search_group', TRUE)) ? $this->input->post('search_group', TRUE) : $sess_usersgroup['searchgroup'];
  

       $searchdata = array(

				 "searchterm" => $search_string,			 

				 "searchgroup" => $search_ugroup				 

				 );

	   $this->session->set_userdata('sess_usersgroup', $searchdata);

       }



       $path=base_url() . "admin/users/external";



       $start = ( $this->uri->segment(4)) ? $this->uri->segment(4) : 0;

       $baseurl = base_url() . "admin/users/external";

       $this->load->library('pagination');

       $config["base_url"] = $baseurl;

       $config['per_page'] = 10;

       $config['enable_query_strings'] = true;

       $config['uri_segment'] = 4;

       $config['total_rows'] = $this->users_model->getExternalcount($search_string,$search_ugroup);

       $this->template->title('External List');

       $this->pagination->initialize($config);	   

       $this->template->set("users", $this->users_model->getExternals($user_id,$config['per_page'],$start,$search_string,$search_ugroup));
	   
	  
	   $this->template->set("countusers", $this->users_model->getcountExternal());

	      

       $this->template->set("search_string", $search_string);    
	  

	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");

	   $this->template->build('admin/users/externals');

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

    $email_id = $this->users_model->getEmailexist($id);


		//redirect if it´s no correct
		if (!$email_id)
		{
       $isdelete=$this->users_model->moveId_User($id);
       redirect('admin/users');      
			
		}
    else
    {
      $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'User already exist with same email' ) );
      redirect('admin/users/trashusers');
		  
    }
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

    function create($parent_id = FALSE)
    {
       	$this->authenticate();
		    $u_data = $this->session->userdata('loggedin');
    		if(($u_data['groupid']=='4'))		
    		{
    	      $this->template->append_metadata(block_submit_button());

            $loggeduser_data=$this->session->userdata('loggedin');

            //$this->template->title('Create User');
		
		        //$this->template->set('title', lang('web_category_create'));

    	$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);

    	$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

    	$this->_set_rules(); //
    	
      $this->template->set('title', 'User');
    	$this->template->set('updType', 'create');
    	$this->template->set('parent_id',$parent_id);
        $this->form_validation->set_rules('website', 'website', 'trim|prep_url|valid_url|xss_clean');

        $this->form_validation->set_rules('blog', 'blog', 'trim|prep_url|valid_url|xss_clean');

        $this->form_validation->set_rules('facebook', 'facebook', 'trim|prep_url|valid_url|xss_clean');

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');

      if ($this->form_validation->run() === FALSE)
    	{
			$this->template->build('admin/users/create_user');
    	}
    	else
      	{		

        
			 $json_decode = $this->upload_image();	

            

            if($_FILES['file_i']['name'])
            {
				$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : 'default.jpg';
				$img_name = $json_decode['ftpfilearray'];
            }	
            else
            {
				$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : 'default.jpg';
				$img_name = $imagename;
            }  
		
			$cropuserimg = ($this->input->post('userimg')) ? ($this->input->post('userimg')) : 'default.jpg';

			date_default_timezone_set("Asia/Kolkata");
            $current_date = date("Y-m-d H:i:s");
			
			$data = array(
            'username'		=>	$this->input->post('email'),

            'group_id'		=>	$this->input->post('group_id'),

            'email'			=>	trim($this->input->post('email')),

            'first_name' 	=> 	$this->input->post('first_name'),

            'last_name' 	=> 	$this->input->post('last_name'),

            'images'        =>  $cropuserimg,                      //$img_name,

            'password' 		=>  md5($this->input->post('password')),

            'author_title' 	=>  $this->input->post('author_title'),

            'active' 	    =>  $this->input->post('active'),

            'show_email' 	=>  $this->input->post('show_email'),

            'full_bio' 	    =>  $this->input->post('full_bio'),

            'website'   	=>  $this->input->post('website'),

            'show_website' 	=>  $this->input->post('show_website'),

            'blog' 	        =>  $this->input->post('blog'),

            'show_blog' 	=>  $this->input->post('show_blog'),

            'facebook' 	    =>  $this->input->post('facebook'),

            'show_facebook' =>  $this->input->post('show_facebook'),

            'twitter' 	    =>  $this->input->post('twitter'),

            'created_by' 	=>  $loggeduser_data['id'],
			
            'created_at' 	=>  $current_date,

            'show_twitter' 	=>  $this->input->post('show_twitter')
			);

        
              $grp_name = $this->users_model->getGroupNameById($this->input->post('group_id')); 
  
              $configarr = $this->settings_model->getItems();

              $urldomain = base_url();
              $urldomain = str_replace('https://', '', $urldomain);
              $urldomain = str_replace('/', '', $urldomain);
              $urldomain = str_replace('www.', '', $urldomain);
              // Email to User 
              $subject = 'Welcome to '.$configarr[0]['institute_name'];
              $toemail =  $this->input->post('email'); // $this->input->post('email')
              $content = '';
              $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p>Dear '.trim(ucfirst($this->input->post('first_name'))).' '.trim(ucfirst($this->input->post('last_name'))).',<br /><br />';
              $content .='Admin create a account for you, Now Academy is opened for you.<br /><br />';
              $content .='You will act as a "'.$grp_name.'" in Academy.<br /><br />';
              $content .='Please keep the Username and Password safely.<br /><br />';
              $content .='Your login details are as follows :-<br /><br />';
              $content .='UserId : '.$this->input->post('email').'<br /><br />';
              $content .='Password : '.$this->input->post('password').'<br /><br />';
              $content .='<br /><br />';
               $content .='...';
              $content .= $configarr[0]['signature'];
              // if($configarr[0]['signature'])
              // {
              //   $content .= $configarr[0]['signature'];
              // }
              // else
              // {
              //   $content .='Best regards,<br /><br />';
              //   $content .=''.$configarr[0]['institute_name'].'</p>';
              // }
              $data1['content'] = $content;
              $message = $this->load->view('email_formates/common_email_formate.php',$data1,true);
              $fromemail= 'noreply@'.$urldomain;  //$configarr[0]['fromemail'];   
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
              // Email to Admin 
              $subject = 'Account Created Successfully';
              $toemail = $admininfo->email; // $this->input->post('email')
              $content = '';
              $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
              $content .='New account for '.trim(ucfirst($this->input->post('first_name'))).' '.trim(ucfirst($this->input->post('last_name'))).' created Successfully.<br /><br />';
              $content .='He/She will act as a "'.$grp_name.'" in Academy.<br /><br />';
              $content .='His/Her login details are as follows :-<br /><br />';
              $content .='UserId : '.$this->input->post('email').'<br /><br />';
              $content .='Password : '.$this->input->post('password').'<br /><br />';
              $content .='<br /><br />';
              $content .='...';
              $content .= $configarr[0]['signature'];
              
              $data1['content'] = $content;
              $message = $this->load->view('email_formates/admin_email_formate.php',$data1,true);
              $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];   
              $config['charset'] = 'utf-8';
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $this->email->initialize($config);
              $this->email->from($fromemail, $configarr[0]['fromname']);
              $this->email->subject($subject);
              $this->email->to($toemail);
              $this->email->message($message);
              $this->email->send(); 
			
			
           
			$usergroups = $this->input->post('group_id');

		if($this->users_model->insertItems($data))
		{
            $user_id = $this->users_model->maxuserid();

            $group_data = array(

    			'user_id'		=>	$user_id,

    			'group_id'      =>  $usergroups

			);

			$this->users_model->insertUserGroup($group_data);
		}
		//$this->upload_image();	

		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

		redirect('admin/users/'.$parent_id);

		}
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
			redirect('admin');
		}
    }

    function valid_url($url)

    {

        $pattern = "/^(https|httpss|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";

        return (bool) preg_match($pattern, $url);

    }

    /*function valid_url ($url){

	$pattern = '/' . '^(httpss?:\/\/)[^\s]+$' . '/';

	preg_match($pattern, $url, $matches);

	$CI =& get_instance();

	$CI->form_validation->set_message('valid_url', "The url must start with 'https://' or contain no spaces");

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
	    
		$date = date('d');
		$month = date('m');
		$year = date('Y');
		$random_no = rand(1000,5000);
		$generate = $random_no.'_'.$year.'-'.$month.'-'.$date;
		
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

        $config['file_name'] = $generate.$_FILES['orig_name'];
		

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

         return $json_encode = array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']);

    }
	
	

    function edit($uid = FALSE)
    {
        $this->authenticate();
    		$u_data = $this->session->userdata('loggedin');
    		if(($u_data['groupid']=='4'))		
    		{		
            $user_info = $this->users_model->getItems(($uid));

        		$this->template->title("Edit Users");
        		//$this->template->set('title', lang('web_category_create'));

            $user_email = @$user_info->email;

            $emailid = (isset($_POST['email'])) ? $_POST['email'] : '';

            //load block submit helper and append in the head

        $this->template->append_metadata(block_submit_button());

        //Rules for validation

        $this->_set_rules2();               

        $uid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

        $uid = ($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : NULL;

        //variables for check the upload

        $form_data_aux			= array();

        $files_to_delete 		= array();

        //redirect if it´s no correct

        if (!$uid){

        	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

        	redirect('admin/users/create_user');

        }       

        $this->template->set('updType', 'edit');

        $this->template->set('user',$this->users_model->getItems(($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : 0));

        $gids = array();

        foreach($this->users_model->getGroup($uid) as $gid){

             $gids[] = $gid->group_id;

        }

        $this->template->set('groups', $gids);

        $this->template->set('id', $uid);

        $this->form_validation->set_rules('website', 'website', 'trim|prep_url|valid_url|xss_clean');

        $this->form_validation->set_rules('blog', 'blog', 'trim|prep_url|valid_url|xss_clean');

        $this->form_validation->set_rules('facebook', 'facebook', 'trim|prep_url|valid_url|xss_clean');

       // echo $user_email.'!='.$emailid;

        if($user_email != $emailid)
		{

			/*$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|callback_user_exists'); */

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');

        }
		else
		{

			/*$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');    */

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

        }

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed

        {

        	$this->template->build('admin/users/create_user');

        }

        else

        {
			     /*echo $this->input->post('imagename');
				 echo '<br>';
				 echo $_FILES['file_i']['name'];
				 exit('aaa');*/
				 
               $json_decode = $this->upload_image();	  
 

                     

            if($_FILES['file_i']['name'])
            {
				$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : $this->input->post('imagename');
			   
				
			    $img_name = $json_decode['ftpfilearray'];    
            }	
            else
            {
				$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : $this->input->post('imagename');
				$img_name = $imagename;
            }   
				
				//  $imagename = ($file_element_name) ? $file_element_name : 'no_images.jpg';
			 
				// $imagename = ($this->input->post('file_i')) ? $this->input->post('file_i') : 'no_images.jpg';
				
			   
				// $imagename = ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg';

            	if($this->input->post('password'))
            	{
              $data = array(

             /* 'username'		=>	$this->input->post('username'),*/

              'email'			=>	$this->input->post('email'),

              'first_name' 	    => 	$this->input->post('first_name'),

              'last_name'   	=> 	$this->input->post('last_name'),
			  
              'designation'   	=> 	$this->input->post('design'),
			  
              'prof_info'   	=> 	$this->input->post('prof_detail'),

              //'images'          =>  $img_name,

              'password' 		=>  md5($this->input->post('password')),

              'author_title' 	=>$this->input->post('author_title'),
			  
              'group_id' 	=>$this->input->post('group_id'),			  
			                       

              // 'emaillink' 	=>  $this->input->post('email'),

              'active' 	        =>  $this->input->post('active'),

              'show_email' 	    =>  $this->input->post('show_email'),

              'full_bio'    	=>  $this->input->post('full_bio'),

              'website' 	    =>  $this->input->post('website'),

              'show_website' 	=>  $this->input->post('show_website'),

              'blog' 	        =>  $this->input->post('blog'),

              'show_blog' 	    =>  $this->input->post('show_blog'),

              'facebook' 	    =>  $this->input->post('facebook'),

              'show_facebook'   =>  $this->input->post('show_facebook'),

              'twitter' 	    =>  $this->input->post('twitter'),

              'show_twitter' 	=>  $this->input->post('show_twitter'),

              'coursepercent'  =>  $this->input->post('sale_per')

        	);
			 }
			 else
			 {

			 	$data = array(

             /* 'username'		=>	$this->input->post('username'),*/

              'email'			=>	$this->input->post('email'),

              'first_name' 	    => 	$this->input->post('first_name'),

              'last_name'   	=> 	$this->input->post('last_name'),
			  
              'designation'   	=> 	$this->input->post('design'),
			  
              'prof_info'   	=> 	$this->input->post('prof_detail'),

              //'images'          =>  $img_name,

              //'password' 		=>  md5($this->input->post('password')),

              'author_title' 	=>$this->input->post('author_title'),
			  
              'group_id' 	=>$this->input->post('group_id'),			  
			                       

              // 'emaillink' 	=>  $this->input->post('email'),

              'active' 	        =>  $this->input->post('active'),

              'show_email' 	    =>  $this->input->post('show_email'),

              'full_bio'    	=>  $this->input->post('full_bio'),

              'website' 	    =>  $this->input->post('website'),

              'show_website' 	=>  $this->input->post('show_website'),

              'blog' 	        =>  $this->input->post('blog'),

              'show_blog' 	    =>  $this->input->post('show_blog'),

              'facebook' 	    =>  $this->input->post('facebook'),

              'show_facebook'   =>  $this->input->post('show_facebook'),

              'twitter' 	    =>  $this->input->post('twitter'),

              'show_twitter' 	=>  $this->input->post('show_twitter'),
              
              'coursepercent'  =>  $this->input->post('sale_per')

        	);

			 }

            if($this->input->post('old_grp_Id') != '2')
            {
               if($this->input->post('new_grp_Id') == '2')
               {

                   $grp_name = $this->users_model->getGroupNameById($this->input->post('group_id')); 
  
              $configarr = $this->settings_model->getItems();

              $urldomain = base_url();
    $urldomain = str_replace('httpss://', '', $urldomain);
    $urldomain = str_replace('/', '', $urldomain);
    $urldomain = str_replace('www.', '', $urldomain);
              // Email to User 
             // $subject = 'Congratulations! You Have Been Made a Teacher at '.$configarr[0]['institute_name'];
              $subject = 'Congratulations! You Have Been Made a Teacher';
              $toemail =  $this->input->post('email'); // $this->input->post('email')
              $content = '';
             // $content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Congratulations! You Have Been Made a Teacher</p>';
              $content .= 'Dear '.trim(ucfirst($this->input->post('first_name'))).',<br /><br />';
              $content .= 'You have been successfully updated into a Teacher in the "'.$configarr[0]['institute_name'].'".<br /><br />';
              $content .= 'Now you can create, access and manage your courses in the "My Courses" section under the "Teaching Zone" of the <a style="color:#55c5eb" href ='.base_url().'>'.base_url().'</a><br /><br />';
              //$content .='Admin has changed your group, Now Academy is offering new features to you.<br /><br />';
              //$content .='Now you will act as a '.$grp_name.' in Academy.<br /><br />';
              //$content .='Please keep the Username and Password safely.<br /><br />';
              $content .='If you need help or have any questions, please contact us..<br />';              
              // $content .='<br /><br />';
              // $content .='...';
              // $content .= $configarr[0]['signature'];
              //$content .=''.$configarr[0]['institute_name'].'</p>';
              // if($configarr[0]['signature'])
              // {
              //   $content .= $configarr[0]['signature'];
              // }
              // else
              // {
              //   $content .='Best regards,<br /><br />';
              //   $content .=''.$configarr[0]['institute_name'].'</p>';
              // }
              $data1['content'] = $content;
              $message = $this->load->view('email_formates/common_email_formate.php',$data1,true);
              $fromemail= 'noreply@'.$urldomain;       //$configarr[0]['fromemail'];   
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
            

              // Email to Admin 
              $subject = 'Account Changed Successfully';
              $toemail = $admininfo->email; // $this->input->post('email')
              $content = '';
              //$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
              $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Account Changed Successfully </p>';
              $content .= '<p>Dear '.trim(ucfirst($admininfo->first_name)).',<br /><br />';
              $content .= 'Account for '.trim(ucfirst($this->input->post('first_name'))).' '.trim(ucfirst($this->input->post('last_name'))).' has been changed Successfully.<br /><br />';
              $content .='He/She will act as a "'.$grp_name.'" in Academy.<br />';
              //$content .=''.$configarr[0]['institute_name'].'</p>';
              // $content .='<br /><br />';
              // $content .='...';
              // $content .= $configarr[0]['signature'];
              // if($configarr[0]['signature'])
              // {
              //   $content .= $configarr[0]['signature'];
              // }
              // else
              // {
              //   $content .='Best regards,<br /><br />';
              //   $content .=''.$configarr[0]['institute_name'].'</p>';
              // }
              $data1['content'] = $content;
              $message = $this->load->view('email_formates/admin_email_formate.php',$data1,true);
              $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];   
              $config['charset'] = 'utf-8';
              $config['mailtype'] = 'html';
              $config['wordwrap'] = TRUE;
              $this->email->initialize($config);
              $this->email->from($fromemail, $configarr[0]['fromname']);
              $this->email->subject($subject);
              $this->email->to($toemail);
              $this->email->message($message);
              $this->email->send(); 
               }
            }
			    
          
			
        		$this->users_model->updateItem($uid,$data);

                $this->users_model->deleteUserGroup($uid);

                $usergroups = $this->input->post('group_id');

                //$i=0; foreach($usergroups as $usergroup){

                $group_data = array(

    							'user_id'		=>	$uid,

    							'group_id'      =>  $usergroups

    		    	);
					
                $isupdated = $this->users_model->insertUserGroup($group_data);

        		if ($isupdated) // the information has therefore been successfully saved in the db
        		{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
        			redirect('admin/users');
        		}
        		else{

        			redirect('admin/users');

        		}

        }
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
			redirect('admin');
		}		
    }
	
	function view_request($uid = FALSE)
    {

        $this->authenticate();
		$u_data = $this->session->userdata('loggedin');
		if(($u_data['groupid']=='4'))		
		{
		
        $user_info = $this->users_model->getItems(($uid));

		$this->template->title("Edit Users");
		//$this->template->set('title', lang('web_category_create'));
        
        $user_email = @$user_info->email;

        $emailid = (isset($_POST['email'])) ? $_POST['email'] : '';

        //load block submit helper and append in the head

        $this->template->append_metadata(block_submit_button());

        //Rules for validation

        //$this->_set_rules();               

        $uid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

        $uid = ($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : NULL;

        //variables for check the upload

        $form_data_aux			= array();

        $files_to_delete 		= array();

        //redirect if it´s no correct

        if (!$uid){

        	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

        	redirect('admin/users/create_user');

        }       

        $this->template->set('updType', 'edit');

        $this->template->set('user',$this->users_model->getItems(($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : 0));
		
        $this->template->set('userinfo',$this->users_model->getInst_Desc(($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : 0));
		
        

        $gids = array();

        foreach($this->users_model->getGroup($uid) as $gid){

             $gids[] = $gid->group_id;

        }

        $this->template->set('groups', $gids);

        $this->template->set('id', $uid);

        
       // echo $user_email.'!='.$emailid;

        if($user_email != $emailid)
		{

			/*$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|callback_user_exists'); */

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');

        }
		else
		{

			/*$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');    */

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

        }

        if ($this->form_validation->run() == FALSE) // validation hasn't been passed

        {

        	$this->template->build('admin/users/viewrequest');

        }

        else

        {
			    /*
				
					[first_name] => jayesh
					[last_name] => jibhakate
					[group_id] => 2
					[payment_mode] => 
					[payment_type] => 
					
					[course] => codeigniter
					[goal] => Technology Awareness
					[experiance] => Online Marketing
					[subscriber] => YouTube
					[acc_status139] => Disapproved
					[description] => 
				sdfr sdfg


					[submit] => Save
					[id] => 139
				*/
			$id = $this->input->post('id');
			
			$status = $this->input->post('acc_status');
			
			if($status == 'Approved')
			{
				$data = array('active' => '1');
			}
			else 
			{
				$data = array('active' => '0');
			}
			 $configarr = $this->settings_model->getItems();	
			
			$isapprove = $this->users_model->approve_status($id,$data);
			
			$reason = array(
         'want_to_teach' => $this->input->post('course'),
         'primary_goal' => $this->input->post('goal'),
         'idl_crs_crtn_exp' => $this->input->post('experiance'),
         'exst_eml_sbsbr_lt' => $this->input->post('promotion'),
         'sbsb_on_youtube' => $this->input->post('subscriber'),
        'reason' => $this->input->post('description')

        );
			
			$this->users_model->updateInst_Desc($id,$reason);
			
      $urldomain = base_url();
    $urldomain = str_replace('https://', '', $urldomain);
    $urldomain = str_replace('/', '', $urldomain);
    $urldomain = str_replace('www.', '', $urldomain);
			
			if($status == 'Approved')
			{
				//$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Approved';
					$toemail = $this->input->post('email');
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($this->input->post('first_name'))).' '.trim(ucfirst($this->input->post('last_name'))).',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].'  team regrets to inform you that your request for the "External Trainer" Account for our Academy has been approved.<br /><br />';
					$content .='Now you can login to our Academy.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					//$content .='Best regards,<br /><br />';
					//$content .=''.$configarr[0]['institute_name'].'</p>';
          $content .='<br /><br />';
          $content .='...';
           $content .= $configarr[0]['signature'];
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= 'noreply@'.$urldomain;  //$configarr[0]['fromemail'];		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
			}
			else if($status == 'Disapproved')
			{
				//$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Disapproved';
				    $toemail = $this->input->post('email');
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($this->input->post('first_name'))).' '.trim(ucfirst($this->input->post('last_name'))).',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].' team regrets to inform you that your request for the "External Trainer" Account for our Academy has been disapproved.<br /><br />';
					$content .='Reason : '.$this->input->post('description').'<br /><br />';
					$content .='Thank you for choosing '.$configarr[0]['institute_name'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					//$content .='Best regards,<br /><br />';
					//$content .=''.$configarr[0]['institute_name'].'</p>';
          $content .='<br /><br />';
          $content .='...';
          $content .= $configarr[0]['signature'];
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= 'noreply@'.$urldomain;   //$configarr[0]['fromemail'];		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
			}            
			redirect('admin/instructor-external/list');
        }
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
			redirect('admin');
		}		
    }
	
	function approved()
	{
		
		$id = $this->uri->segment(4);
		$data = array('active' => '1');
	    $email = $this->users_model->getEmail($id);
	    $name = $this->users_model->getUserName($id);
	  
	    $configarr = $this->settings_model->getItems();	
		
		$isapprove = $this->users_model->approve_status($id,$data);
	
		
		if($isapprove)
		{
          $urldomain = base_url();
    $urldomain = str_replace('https://', '', $urldomain);
    $urldomain = str_replace('/', '', $urldomain);
    $urldomain = str_replace('www.', '', $urldomain);
				//$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Approved';
					$toemail = $email;
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($name)).',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].'  team regrets to inform you that your request for the "External Trainer" Account for our Academy has been approved.<br /><br />';
					$content .='Now you can login to our Academy.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					//$content .='Best regards,<br /><br />';
					//$content .=''.$configarr[0]['institute_name'].'</p>';
          $content .='<br /><br />';
          $content .='...';
          $content .= $configarr[0]['signature'];
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
				
				
		}
	}
	
	function disapproved()
	{
    $urldomain = base_url();
    $urldomain = str_replace('https://', '', $urldomain);
    $urldomain = str_replace('/', '', $urldomain);
    $urldomain = str_replace('www.', '', $urldomain);

		$id = $this->uri->segment(4);
		$data = array('active' => '0');
		$email = $this->users_model->getEmail($id);
	    $name = $this->users_model->getUserName($id);
	  
	    $configarr = $this->settings_model->getItems();	
		
		$isapprove = $this->users_model->approve_status($id,$data);
	
		
		if($isapprove)
		{
				//$subject = 'Welcome to '.$configarr[0]['institute_name'];
					$subject = 'Your account is Disapproved';
					$toemail = $email;
					
					$content = '';
					//$content = ' To reset your password please follow the link below: <br> <a href="'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('member/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
					$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
					$content .= '<p>Dear '.trim(ucfirst($name)).',<br /><br />';
					$content .='After due consideration the '.$configarr[0]['institute_name'].' team regrets to inform you that your request for the "External Trainer" Account for our Academy has been disapproved.<br /><br />';
					$content .='Thank you for choosing '.$configarr[0]['institute_name'].'.<br /><br />';
					$content .='If you need help or have any questions, please contact us.<br /><br />';
					//$content .='Best regards,<br /><br />';
					//$content .=''.$configarr[0]['institute_name'].'</p>';
          $content .='<br /><br />';
          $content .='...';
          $content .= $configarr[0]['signature'];
					$data['content'] = $content;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= 'noreply@'.$urldomain;     //$configarr[0]['fromemail'];		
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					$this->email->from($fromemail, $configarr[0]['fromname']);
					$this->email->subject($subject);
					$this->email->to($toemail);
					//$this->email->cc('vikas.gorle@veerit.com');
					$this->email->message($message);
					$this->email->send();	
				
				
		}
	}

  function trash($id = NULL)
  {
      $this->authenticate();

        $pro_name = $this->program_model->getProgramNameById($id); 

        if($pro_name)
        { 

           $user_id = $this->program_model->getAllTrainer($id);  

           $admin_id = $this->program_model->admin_id(); 

           $this->template->set('admin_id', $admin_id);      

           $this->template->set('user_id', $user_id);  

          $this->template->set('programs', $pro_name);  

          $this->template->set('trainer_id', $id);

          $this->template->build('admin/users/assigncourse');
       }
       else
       {

          $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

      //redirect if it´s no correct

              if (!$id)
            {

                $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

                redirect('admin/users/');

              }
              
            $isdelete = $this->users_model->moveId_trash($id);
            if ($isdelete)
              {
                  
                  //toastr.success('User Successfully Deleted.', 'Deleted');

                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "User Successfully Deleted." ));
              }
              else
              {
                $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
              }
              redirect('admin/users');


       }
  }

	function trash1($id = NULL)
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

		$isdelete = $this->users_model->moveId_trash($id);
		if ($isdelete)
    	{
    			
    			//toastr.success('User Successfully Deleted.', 'Deleted');

    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "User Successfully Deleted." ));
    	}
    	else
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}
    	redirect('admin/users');
    } 

    function assign_trainer()
    {

      $pro_ids = $this->input->post('program_id');
      $user_id = $this->input->post('assign_to');
      $trainer_id = $this->input->post('trainer_id');

      if($user_id && $trainer_id)
      {

      $courses_id = $this->program_model->getProgramNameById($trainer_id);
      
      if($courses_id)
      {
        foreach ($courses_id as $pids) {

          $pid = $pids['id'];
          $this->program_model->assign_course($pid,$user_id);
        }
      }
     

      // foreach ($pro_ids as $pid) {
        
      //   $this->program_model->assign_course($pid,$user_id);
      // }

      $id = ($trainer_id != 0) ? filter_var($trainer_id, FILTER_VALIDATE_INT) : NULL;

     

      if (!$id)
    {

        $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

        redirect('admin/users/');

      }

    $isdelete = $this->users_model->moveId_trash($id);
    if ($isdelete)
      {
          
          //toastr.success('User Successfully Deleted.', 'Deleted');

        $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "User Successfully Deleted." ));
      }
      else
      {
        $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
      }
      redirect('admin/users');
    }
    else
    {

      $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
      redirect('admin/users');

    }
      
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



    if($type == 'edit')
    {
    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', '');
    }
    else
    {

    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');
    }


    $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

    }

    //new rules for edit


    private function _set_rules2($type = 'create', $id = NULL)

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



    //if ($type == 'edit')

    	$this->form_validation->set_rules('password', 'Password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');

   // else

    	//$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');



   // if($type == 'edit')
    //{
    	$this->form_validation->set_rules('password_confirm', 'Password Confirm', '');
   // }
   //else
    //{

    	//$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');
    //}


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
    public function view_frontsite()
    {
        //  $u_data=$this->session->userdata('loggedin');        
        //  $this->session->set_userdata('logged_in',$u_data);
        //  $datanew = $this->session->userdata('logged_in');       
        // return true; 


      $u_data=$this->session->userdata('loggedin');
          // echo"<pre>";
          // print_r($u_data['modper']);
                $quizzes = 0;
                $courses = 0;
                $media = 0;
                $users = 0;
                $course = 0;
          foreach($u_data['modper'] as $permi)
          {    
              if($permi['modules'] == 'quizzes')
               {
                  $quizzes = $permi['permission'];
               }
               else if($permi['modules'] == 'courses')
               {
                  $courses = $permi['permission'];
               }
               else if($permi['modules'] == 'media')
               {
                  $media = $permi['permission'];
               }
               else if($permi['modules'] == 'users')
               {
                  $users = $permi['permission'];
               }
               else if($permi['modules'] == 'course media')
               {
                  $quizzes = $permi['permission'];
               }
            
          }
          $data = array('quizzes' =>$quizzes , 
              'courses' =>$courses ,
              'media' =>$media ,
              'users' => $users,
              'course media' =>$quizzes ,
                       );
           
               
         $this->session->set_userdata('logged_in',$u_data);
         $datanew = $this->session->userdata('logged_in');

         $this->session->set_userdata('maccessarr',$data);
         $maccessarr = $this->session->userdata('maccessarr');           
        return true; 
    }

    function cropuserimg()
  {
    //exit('yes');
    $this->load->view('admin/users/cropuserimg');
  }

  public function uploadUserimg()
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
    
    $file2 = FCPATH.'public/uploads/users/img/'.$generate1.'.png';
    if(file_put_contents($file2, $data))//for upload file to the server
    {
      //executed
        $status = "success";
              $msg = "File successfully uploaded";
                $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = FCPATH.'public/uploads/users/img/'.$generate1.'.png';
            $config['new_image'] = FCPATH.'public/uploads/users/img/thumbs/'.$generate1.'.png';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = FALSE;
            $config['master_dim'] = 'width';
                $config['width'] = 155;
                $config['height'] = 165;

            $config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
        $config['y_axis'] = '0';

    }
    $course_id = $this->uri->segment(4);    
    
    if($this->uri->segment(5) == 'useredit')
    {

    $form_data =  array(            
          'images' => $generate1.".png"            
          );
    $this->users_model->updateItem($course_id,$form_data);

     }
           
    
    }

    function expired_academy()
  {
    //exit('yes');
    $this->load->view('layouts/expired_academy');
  }

}

