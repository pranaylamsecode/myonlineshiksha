<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MLMS_Controller
{
    function __construct()
    {
        parent::__construct();
        // error_reporting(0);
        //$this->load->helper(array('form', 'url'));

        $this->load->model('admin/users_model');		

        $this->load->model('program_model'); 
		
			  $this->load->model('admin/settings_model');
		
        $this->load->model('login_model');

        $this->template->set_layout('backend');

        $this->load->library('ckeditor');
        $this->load->library('session');

        $this->load->model('Crud_model');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';

        $this->load->helper('form');

        $this->load->helper('url');	

		    $this->lang->load('tooltip', 'english');

        $this->load->library('form_validation');
        $this->session->keep_flashdata('message');
        $this->load->library('phpqrcode/qrlib');    // QR-code library
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);

    error_reporting(0);

        ob_start();
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

function login2(){
   if($_GET['email'])
       {
        // echo $_GET['email']; exit();
        $email = $_GET['email'];
        $password = $_GET['password'];
         // $this->users_model->validate();
                  $data= $this->users_model->setSessionData($email,$password);
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
                    
                    redirect('admin/users/login/invalid');
                  }
      }
      else{
        redirect('admin/users/login');
      }
}


    function login()
    {
		  if($this->session->userdata('loggedin'))
      {
			  redirect('admin');          
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
                  $this->session->set_userdata('logged_in',$data);
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
  
        if(isset($_POST['submit_search']))
        {
          if($this->input->post('search_text', TRUE)=='')
          {
            $search_string = '';
          }
          if($this->input->post('search_group', TRUE)=='')
          {
            $search_ugroup = '';
          }
        }

        if(isset($_POST['search_group']) && $_POST['search_group']=== "") {
            $search_ugroup = '';
        } 
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
	   $this->template->set("countusers", $this->users_model->getcountUsers($search_string,$search_ugroup));

	      

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
    
    function randomPassword($length) {
       $alphabet = "a9den7pqz01fghijko2bc83rstxy45uw6lm";
       $pass = array(); //remember to declare $pass as an array
       $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
       for ($i = 0; $i < $length; $i++) {
           $n = rand(0, $alphaLength);
           $pass[] = $alphabet[$n];
       }
       if($this->Crud_model->get_single('mlms_users',"referral_code = '".implode($pass)."'"))
       {
           $this->randomPassword(8);
       }
       return implode($pass); //turn the array into a string
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

        // $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_exists');

      if ($this->form_validation->run() === FALSE)
    	{
			$this->template->build('admin/users/create_user');
    	}
    	else
      	{		

			 $json_decode = $this->upload_image();	

            

            if($_FILES['file_i']['name'])
            {
				$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : '';
				$img_name = $json_decode['ftpfilearray'];
            }	
            else
            {
				$imagename = ($_FILES['file_i']['name']) ? ($_FILES['file_i']['name']) : '';
				$img_name = $imagename;
            }  
		
			$cropuserimg = ($this->input->post('userimg')) ? ($this->input->post('userimg')) : '';

			// date_default_timezone_set("Asia/Kolkata");
            $current_date = date("Y-m-d H:i:s");
			
			$data = array(
            'username'		=>	$this->input->post('email'),

            'group_id'		=>	$this->input->post('group_id'),

            'email'			=>	trim($this->input->post('email')),
            
            'mobile'     =>  trim($this->input->post('mobile')),

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

                           // $urldomain = base_url();
             // $urldomain = str_replace('http://', '', $urldomain);
             // $urldomain = str_replace('/', '', $urldomain);
             // $urldomain = str_replace('www.', '', $urldomain);
        if($configarr[0]['fromemail'])  
          $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain'); 
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
 $data1['fromemail'] = $urldomain;
              $message = $this->load->view('email_formates/common_email_formate.php',$data1,true);
              $fromemail= $urldomain;  //$configarr[0]['fromemail'];   
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
              // $toemail = 'jyotisorte4@gmail.com';
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
 $data1['fromemail'] = $urldomain;
              $message = $this->load->view('email_formates/admin_email_formate.php',$data1,true);
              $fromemail= $urldomain;    //$configarr[0]['fromemail'];   
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
    if($this->input->post('group_id') == 2 || $this->input->post('group_id') == 5)
    {
      $ref = $this->randomPassword(8);
      $text1234 = base_url()."category/courses?ref=".$ref;
      $SERVERFILEPATH = getcwd().'/public/uploads/resellers_QR/';
      $text1= $ref;
      $folder = $SERVERFILEPATH;
      $file_name1 = $text1."-Qrcode".rand(0,9999).".png";
      $file_name = $folder.$file_name1;
      QRcode::png($text1234,$file_name,8,8);
      if($this->input->post('group_id') == '2')
      {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $fname = '';
        $lname = '';
        $fn = explode(' ',str_replace('.',' ',$first_name));
        $ln = explode(' ',str_replace('.',' ',$last_name));
        $cntf = count($fn);
        $cntl = count($ln);
        $i = 1;
        $j = 1;
        foreach ($fn as $key) {
          $fname .= $key;
          if(intval($i) < intval($cntf))
          {
            if(!empty(trim($key)))
              $fname .= '-';
          }
          $i++;
        }
        foreach ($ln as $key) {
          $lname .= $key;
          if(intval($j) < intval($cntl))
          {
            if(!empty(trim($key)))
              $lname .= '-';
          }
          $j++;
        }
        $slug = strtolower($fname."-".$lname);
        $coursepercent = $this->input->post('sale_per');
      }else{
        $slug = "";
        $coursepercent = "";
      }
      $teacher = array(
        'slug' => $slug,
        'coursepercent' => $coursepercent,
        'referral_code' => $ref,
        'referral_qr' => $file_name1
      );
      
      $con = "id = ".$user_id;
      $this->Crud_model->SaveData('mlms_users',$teacher,$con);
      $data1 = array(
            'user_id' => $user_id,
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s'),
      );
      $this->Crud_model->SaveData('mlms_assessment',$data1);
      $data2 = array(
              'user_id' => $user_id,
              'created' => date('Y-m-d H:i:s'),
              'modified' => date('Y-m-d H:i:s'),
      );
      $this->Crud_model->SaveData('mlms_payout',$data2);
    }

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
            $mobile = (isset($_POST['mobile'])) ? $_POST['mobile'] : '';

            //load block submit helper and append in the head

        $this->template->append_metadata(block_submit_button());

        //Rules for validation

        $this->_set_rules2();               

        $uid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

        $uid = ($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : NULL;

        $form_data_aux			= array();
        $files_to_delete 		= array();
        if (!$uid){
        	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
        	redirect('admin/users/create_user');
        }       

        $this->template->set('updType', 'edit');
        $this->template->set('user',$this->users_model->getItems(($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT): 0));
        $gids = array();

        foreach($this->users_model->getGroup($uid) as $gid){

             $gids[] = $gid->group_id;

        }

        $this->template->set('groups', $gids);

        $this->template->set('id', $uid);

        $con = "user_id = ".$uid;
        $getassessment = $this->Crud_model->get_single('mlms_assessment',$con);
        $this->template->set('assess', $getassessment);

        $this->form_validation->set_rules('website', 'website', 'trim|prep_url|valid_url|xss_clean');

        $this->form_validation->set_rules('blog', 'blog', 'trim|prep_url|valid_url|xss_clean');

        $this->form_validation->set_rules('facebook', 'facebook', 'trim|prep_url|valid_url|xss_clean');

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
      // $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
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
              
              'mobile'     =>  $this->input->post('mobile'),

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

              'mobile'     =>  $this->input->post('mobile'),

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
       if($this->input->post('old_grp_Id')==2){
            $con = "user_id =".$uid;
            $getassessment = $this->Crud_model->get_single('mlms_assessment',$con);
            
            if(!empty($getassessment)){
                $data11 = array(
                              'assessment' => $this->input->post('comm_per'),
                              'modified' => date('Y-m-d H:i:s')
                );
                $this->Crud_model->SaveData('mlms_assessment',$data11,$con);
            }
            else{
                $data11 = array(
                              'user_id' => $uid,
                              'assessment' => $this->input->post('comm_per'),
                              'ass_type' => '2',
                              'created' => date('Y-m-d H:i:s'),
                              'modified' => date('Y-m-d H:i:s')
                );
                $this->Crud_model->SaveData('mlms_assessment',$data11); 
            }
          }
            if($this->input->post('old_grp_Id') != '2')
            {
               if($this->input->post('new_grp_Id') == '2')
               {

                   $grp_name = $this->users_model->getGroupNameById($this->input->post('group_id')); 
  
              $configarr = $this->settings_model->getItems();

    //           $urldomain = base_url();
    // $urldomain = str_replace('http://', '', $urldomain);
    // $urldomain = str_replace('/', '', $urldomain);
    // $urldomain = str_replace('www.', '', $urldomain);
              if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain'); 

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
 $data1['fromemail'] = $urldomain;
              $message = $this->load->view('email_formates/common_email_formate.php',$data1,true);
              $fromemail= $urldomain;       //$configarr[0]['fromemail'];   
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
 $data1['fromemail'] = $urldomain;
              $message = $this->load->view('email_formates/admin_email_formate.php',$data1,true);
              $fromemail= $urldomain;    //$configarr[0]['fromemail'];   
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
			
    //   $urldomain = base_url();
    // $urldomain = str_replace('http://', '', $urldomain);
    // $urldomain = str_replace('/', '', $urldomain);
    // $urldomain = str_replace('www.', '', $urldomain);
      if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain'); 
			
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
 $data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= $urldomain;  //$configarr[0]['fromemail'];		
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
 $data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= $urldomain;   //$configarr[0]['fromemail'];		
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
    //       $urldomain = base_url();
    // $urldomain = str_replace('http://', '', $urldomain);
    // $urldomain = str_replace('/', '', $urldomain);
    // $urldomain = str_replace('www.', '', $urldomain);
      if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain'); 

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
 $data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= $urldomain;    //$configarr[0]['fromemail'];		
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
	
	function disapproved()
	{
    // $urldomain = base_url();
    // $urldomain = str_replace('http://', '', $urldomain);
    // $urldomain = str_replace('/', '', $urldomain);
    // $urldomain = str_replace('www.', '', $urldomain);

    if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain'); 

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
 $data['fromemail'] = $urldomain;
					$message = $this->load->view('email_formates/common_email_formate.php',$data,true);
					
					//$message = '<a href="'.$link.'">Click on link to reset password</a>';
					//$fromemail='admin@createonlineacademy.com';
					$fromemail= $urldomain;     //$configarr[0]['fromemail'];		
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

  function trash($id = NULL)
  {

        $pro_name = $this->program_model->getProgramNameById($id);  

        $user_id = $this->program_model->getAllTrainer($id);        

         $this->template->set('user_id', $user_id);  

        $this->template->set('programs', $pro_name);  

       $this->template->set('trainer_id', $id);

      $this->template->build('admin/users/assigncourse');
  }

	function trash1()
  {
    $id = $this->input->post('id1');
		$this->authenticate();

    	//filter & Sanitize $id

    	$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

    	//redirect if it´s no correct

    	if (!$id)
		{
        echo "data not found!";
    		// $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

    		// redirect('admin/users/');

    	}

		$isdelete = $this->users_model->moveId_trash($id);
		if ($isdelete)
    {
      echo "User Successfully Deleted.";
    			//toastr.success('User Successfully Deleted.', 'Deleted');

    		// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => "User Successfully Deleted." ));
    	}
    	else
    	{
        echo "Failed to delete!";
    		// $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}
    	//redirect('admin/users');
    } 

    function assign_trainer()
    {
      
      $pro_ids = $this->input->post('program_id');
      $user_id = $this->input->post('assign_to');
      $trainer_id = $this->input->post('trainer_id');

      foreach ($pro_ids as $pid) {
        
        $this->program_model->assign_course($pid,$user_id);
      }

      $id = ($trainer_id != 0) ? filter_var($trainer_id, FILTER_VALIDATE_INT) : NULL;

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

    // $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|xss_clean');
	
	

    //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');



    	if ($id)

		{

			// $this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email.id.'.$id.']|xss_clean');

		}

		else

		{

			// $this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

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

    // $this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
	
	//$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|xss_clean');
	
	

    //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');



    	if ($id)

		{

			// $this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email.id.'.$id.']|xss_clean');

		}

		else

		{

			// $this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[mlms_users.email]|xss_clean');

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
    
    // $file2 = FCPATH.'public/uploads/users/img/'.$generate1.'.png';
    $file2 = FCPATH.'public/uploads/users/img/'.$img_name;
    if(file_put_contents($file2, $data))//for upload file to the server
    {
      //executed
        $status = "success";
              $msg = "File successfully uploaded";
                $config = array();
            $config['image_library'] = 'gd2';
            // $config['source_image'] = FCPATH.'public/uploads/users/img/'.$generate1.'.png';
            // $config['new_image'] = FCPATH.'public/uploads/users/img/thumbs/'.$generate1.'.png';
            $config['source_image'] = FCPATH.'public/uploads/users/img/'.$img_name;
            $config['new_image'] = FCPATH.'public/uploads/users/img/thumbs/'.$img_name;
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
          'images' => $img_name            
          );
    $this->users_model->updateItem($course_id,$form_data);

     }
           
    
    }

    function expired_academy()
  {
    //exit('yes');
    $this->load->view('layouts/expired_academy');
  }

  function bulk_upload()
  {
  	$this->authenticate();
	$u_data = $this->session->userdata('loggedin');
	if(($u_data['groupid']=='4'))		
	{		
		 $this->template->append_metadata(block_submit_button());
		$this->template->build('admin/users/bulk_upload');
	}
	else
	{
		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
		redirect('admin');
	}	
   
  }

  function excel_upload(){
  	 $this->template->append_metadata(block_submit_button());
$this->load->model('payment_model');
$i='0';
  if (isset($_FILES)) {
    $ok = true;
    $file = $_FILES['file_i']['tmp_name'];
    $handle = fopen($file, "r");
    if ($file == NULL) {
       $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Please select a file to import' ));
      // error(_('Please select a file to import'));
      redirect('admin/users/bulk_upload');
    }
    else {
      if($this->input->post('type') ==="users")
      {

        $bulk_arr = array();
        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          $i++;
          // print_r($filesop); exit();
          if($filesop[9])
        {
        	$var = $filesop[9];
			$date = date('Y-m-d H:m:s', strtotime($var));      	
        }

          $data = array(
            'first_name' => $filesop[1],
            'last_name' => $filesop[2],
            'email' => $filesop[3],
            'password' => md5($filesop[4]),
            'group_id' => $filesop[5],    
            'is_student' => $filesop[6],
            'is_instructor' => $filesop[7],     
            'active' => $filesop[8],
            'created_at' => $date
           );

          $bulk_arr[] = array_merge($data);
          
          }
        
        if(sizeof($bulk_arr)>0)
          {
            $insert_id = $this->users_model->uploadusers($bulk_arr);
              if($insert_id)
              {
                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'File successfully imported' ));
                redirect('admin/users/bulk_upload');
              }
          }

      }
      else if($this->input->post('type') ==="reviews")
      {
        $bulk_arr2 = array();
        $bulk_enroll = array();
        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          $i++;
            if($filesop[5])
            {
              $var = $filesop[5];
              $date = date('Y-m-d', strtotime($var));
              $entroll_date = date('Y-m-d', strtotime("-1 months", strtotime($date)));

            }

         $user_data = array(
            'first_name' => $filesop[3],
            'email' => str_replace(' ', '', $filesop[3])."@gamil.com",
            'password' => md5("123456"),
            'group_id' => "1",    
            'is_student' => "1",
            'is_instructor' => "0",     
            'active' => "1",
            'created_at' => $entroll_date
           );
         $user_id = $this->users_model->insertEx_users($user_data);

        // $user_id = $this->users_model->getUserid($filesop[1]);
         $link_array = explode('/',$filesop[1]);
         $slug = end($link_array);
        $pro_id = $this->users_model->getCourseid($slug);
        
       
        
        if($pro_id){
	          $data = array(
	            'user_id' => $user_id,
	            'program_id' => $pro_id,
	            // 'title' => $filesop[3],
	            'description' => $filesop[4],
	            'review_rate' => $filesop[2],
	            'review_date' => $date	           
	           );

	           $bulk_arr2[] = array_merge($data);

            $is_Alreadybuy = $this->payment_model->getBuyCourses($user_id,$pro_id);


             if(empty($is_Alreadybuy)){

                  $enroll = array(
                  'userid' => $user_id,
                  'course_id' => $pro_id,
                  'price' => '0',
                  'buy_date' => $entroll_date

                 );

                  $bulk_enroll[] = array_merge($enroll);
              }
       		}
          
          }

          if(sizeof($bulk_enroll)>0)
          {
            $insert_id = $this->users_model->uploadEnrollUsers($bulk_enroll);
          }

        if(sizeof($bulk_arr2)>0)
          {
            $insert_id = $this->users_model->uploadreviews($bulk_arr2);

              if($insert_id)
              {
                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'File successfully imported' ));
                redirect('admin/users/bulk_upload');
              }
          }
          
        }

      }
      
      }

  }




  // demo function for teachers data update and check for pagination
  function editteacher($uid = FALSE)
    {
        $this->authenticate();
        $u_data = $this->session->userdata('loggedin');
        if(($u_data['groupid']=='4'))   
        {  
        $this->load->model('admin/referrals_model');  
            $reff_info = $this->referrals_model->getreferrals(($uid));

            $assess_info = $this->referrals_model->get_assessment($uid);
            
            $con = "referred_code = '".$reff_info->referral_code."' AND referred_code !='' AND referred_code is NOT NULL";
            $total_data = $this->Crud_model->GetData('mlms_order','',$con);

            $con1 = "user_id = '".$uid."'";
            $total_payout = $this->Crud_model->get_single('mlms_payout',$con1);
            $offline_payment = $this->Crud_model->GetData("mlms_offline_payment","sum(amount) as total_pending","reseller_id =".$uid." AND status ='Pending'",'','','',1);
            
            
            $payout_log = $this->Crud_model->GetData('mlms_payout_log','',$con1);

            // print_r($count_payout);exit;
            if($this->input->post('pay_page'))
            {
              $currpage = $this->input->post('pay_page');
              if(empty($this->input->post('pay_page')) || $this->input->post('pay_page')==1)
              {
                $firstp = 0;
              }
              else{
                $firstp = intval(intval($this->input->post('pay_page'))-1) * 10 ;
              }
              if((intval($firstp)+intval(10)) > count($payout_log))
              {
                $startp = count($payout_log);
              }
              else{
                $startp = $firstp + 10;
              }
              $payout_data = $this->Crud_model->GetData('mlms_payout_log','',$con1,'','',10,'',$firstp);

            }
            else{
              $currpage = 1;
              $firstp = 0;
              $startp = 10;
              $payout_data = $this->Crud_model->GetData('mlms_payout_log','',$con1,'','',10,'',$firstp);
            }


            // resellers orders data
            if($this->input->post('pageno'))
            {
              $curpage = $this->input->post('pageno');
              if(empty($this->input->post('pageno')) || $this->input->post('pageno')==1)
              {
                $first = 0;
              }
              else{
                $first = intval(intval($this->input->post('pageno'))-1) * 10 ;
              }
              if((intval($first)+intval(10)) > count($total_data))
              {
                $start = count($total_data);
              }
              else{
                $start = $first + 10;
              }
              $ref_data = $this->Crud_model->GetData('mlms_order','',$con,'','',10,'',$first);

            }
            else{
              $curpage = 1;
              $first = 0;
              $start = 10;
              $ref_data = $this->Crud_model->GetData('mlms_order','',$con,'','',10,'',$first);
            }

            // pagination orders
            $paging = '';
              $pages = ceil(count($total_data)/10);
              if($pages>1) {
                if(intval($curpage) == 1) 
                  $paging .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paging .= '<li data-ci-pagination-page="1" onclick="getresult(1)"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($curpage)-1).'" onclick="getresult('.(intval($curpage)-1).')"><a>&lt;</a></li>';

                if((intval($curpage)-3)>0) {
                  if($curpage == 1)
                    $paging .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
                }
                if((intval($this->curpage)-3)>1) {
                    $paging .= '<li>...</li>';
                }
                
                for($i=(intval($curpage)-2); $i<=(intval($curpage)+2); $i++)  {
                  if($i<1) continue;
                  if($i>$pages) break;
                  if(intval($curpage) == $i)
                    $paging .= '<li class="active" data-ci-pagination-page="'.$curpage.'"><a>'.$curpage.'</a></li>';
                  else        
                    $paging .= '<li data-ci-pagination-page="'.$i.'" onclick="getresult('.$i.')"><a>'.$i.'</a></li>';
                }
                
                if(($pages-(intval($curpage)+2))>1) {
                    $paging .= '<li><a>...</a></li>';
                }
                if(($pages-(intval($curpage)+2))>0) {
                  if(intval($curpage) == $pages)
                    $paging .= '<li id=' .$pages.' class="active" data-ci-pagination-page="'.$pages.'" ><a>'.$pages.'</a></li>';
                  else        
                    $output .= '<li data-ci-pagination-page="'.$pages.'" onclick="getresult('.$pages.')"><a>'.$pages.'</a></li>';
                }
                
                if(intval($curpage) < $pages)
                  $paging .= '<li onclick="getresult('.(intval($curpage)+1).')" ><a> > </a></li>
                          <li onclick="getresult('.$pages.')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paging .= '<li class="disabled" data-ci-pagination-page="'.$pages.'"><a> > </a></li><li data-ci-pagination-page="'.$pages.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }
            // end of pagination orders
              
              // payouts pagination
              $paying = '';
              $pagesp = ceil(count($payout_log)/10);
              if($pagesp>1) {
                if(intval($currpage) == 1) 
                  $paying .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
                              <li class="disabled"><a>&lt;</a></li>';
                else  
                  $paying .= '<li data-ci-pagination-page="1" onclick="getpayoutadmin(1,\'resellers\')"><a>&lsaquo; First</a></li>
                      <li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayoutadmin('.(intval($currpage)-1).',\'resellers\')"><a>&lt;</a></li>';

                if((intval($currpage)-3)>0) {
                  if($currpage == 1)
                    $paying .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
                  
                }
                if((intval($this->currpage)-3)>1) {
                    $paying .= '<li>...</li>';
                }
                
                for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
                  if($i<1) continue;
                  if($i>$pagesp) break;
                  if(intval($currpage) == $i)
                    $paying .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
                  else        
                    $paying .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayoutadmin('.$i.',\'resellers\')"><a>'.$i.'</a></li>';
                }
                
                if(($pagesp-(intval($currpage)+2))>1) {
                    $paying .= '<li><a>...</a></li>';
                }
                if(($pagesp-(intval($currpage)+2))>0) {
                  if(intval($currpage) == $pagesp)
                    $paying .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
                  else        
                    $output .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayoutadmin('.$pagesp.',\'resellers\')"><a>'.$pagesp.'</a></li>';
                }
                
                if(intval($currpage) < $pagesp)
                  $paying .= '<li onclick="getpayoutadmin('.(intval($currpage)+1).',\'resellers\')" ><a> > </a></li>
                          <li onclick="getpayoutadmin('.$pagesp.',\'resellers\')" ><a>Last &rsaquo;</a></li>';
                else        
                  $paying .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
              }
              // payouts pagination ends here

            
            if($this->input->post('pageno'))
            {
              $output = "";
              foreach ($ref_data as $key)
              { 
                 $students = $this->Crud_model->get_single('mlms_users',"id ='".$key->userid."'");
                 $course = $this->Crud_model->get_single('mlms_program',"id ='".$key->courses."'");
                 if(!empty($students->last_name)){ $stud_name = $students->first_name." ".$students->last_name;} else{ $stud_name =  $students->first_name;}
                 $output .= '<tr class="camp0">
                  <td class="field-title" style="text-transform: capitalize;text-align:center!important;">'.$key->id.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$stud_name .'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$course->name.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->amount.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->order_date.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->status.'</td>
              </tr>';
              }
              
              $data1['pagedata'] = $output;
              $data1['lastpage'] = ceil(count($total_data)/10);
              $data1['links'] = $this->input->post('pageno');
              $data1['first'] = $first + 1;
              $data1['start'] = $start;
              $data1['paging'] = $paging;
              $data1['total_data'] = count($total_data);
              echo json_encode($data1);
            }
            else if($this->input->post('pay_page'))
            {
              $output = "";
              foreach ($payout_data as $key)
              {
                $output .= '
                <tr class="camp0">
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->paid_amount.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->paid_date.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->pay_mode.'</td>
                  <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">'.$key->memo.'</td>
                </tr>';
              }
              
              $data1['payoutdata'] = $output;
              $data1['lastpage'] = $pagesp;
              $data1['links'] = $this->input->post('pay_page');
              $data1['firstp'] = $firstp + 1;
              $data1['startp'] = $startp;
              $data1['paying'] = $paying;
              $data1['total_payout'] = count($payout_log);

              echo json_encode($data1);
            }
            else{
              $data = array(
                        'type' => "Teacher",
                        'updType' => "Update",
                        'btnAction' => "update_action",
                        'btn_access' => "update_assess",
                        'reff_info' =>$reff_info,
                        "assess_info" =>$assess_info,
                        'ref_data' => $ref_data,
                        'total_data' => count($total_data),
                        'first' => $first,
                        'start' => $start,
                        'paging' => $paging,
                        
                        'firstp' => $firstp,
                        'startp' => $startp,
                        'paying' => $paying,
                        'total_payout' => $total_payout,
                        'payout_data' => $payout_data,
                        'count_payout' => count($payout_log),
                        'offline_payment' => round($offline_payment->total_pending,2),
              );
              $this->template->build('admin/resellers/create_resellers',$data);
            }
      }
      else
      {
        $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to modify' ) );
        redirect('admin');
      }   
    }

}

