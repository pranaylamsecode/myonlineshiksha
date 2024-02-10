<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blogs extends MLMS_Controller
{
    function __construct()
    {
		parent::__construct();
		
		$this->template->set_layout('backend');		
		$this->load->helper(array('pages'));
		//$this->load->helper(array('form', 'url'));	   
		$this->load->model('blogs_model');
		$this->authenticate();
		$this->load->library('pagination');	
		
		$this->lang->load('tooltip', 'english');
    $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);
		/*	$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation'); */				
		// $this->load->model("pages_model"); // Load Pages model
		// $this->load->library('form_validation'); // Load form validation library		
    }

     

	public function index($user_id = NULL)
	{
	    /*$user_id = NULL;	    
		$start = ( $this->uri->segment(3)) ? $this->uri->segment(3) : 0;	 	  	     	   
		$baseurl = base_url() . "admin/blogs/";
		$this->load->library('pagination');	
		$config["base_url"] = $baseurl; 
		$config['per_page'] = 10;	  
		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->blogs_model->getusercount();*/
		
		$this->authenticate();
        $user_id = NULL;                
        $this->template->set_layout('backend');        
        $sess_usersgroup = $this->session->userdata('sess_usersgroup');        
       
      if($this->input->post('reset') == 'Reset')
		  {        
    			$search_string = $this->input->post('search_text', TRUE);    
    			$search_ugroup = $this->input->post('search_group', TRUE);  
    			$this->session->unset_userdata('sess_usersgroup');

    			$search_string = '';       
    			
    			$search_ugroup = '';   		
      } 
		  else
		  {        
  			$search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_usersgroup['searchterm'];
  			
  			$search_ugroup = ($this->input->post('search_group', TRUE)) ? $this->input->post('search_group', TRUE) : $sess_usersgroup['searchgroup'];
  				   
  			$searchdata = array(
			
					 "searchterm" => $search_string,			 

					 "searchgroup" => $search_ugroup				 

					 );

		    $this->session->set_userdata('sess_usersgroup', $searchdata);
      }

        $path=base_url() . "admin/blogs/index/";
	    
        $start = ( $this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        $baseurl = base_url() . "admin/blogs/index/";
        
        $this->load->library('pagination');
        
        $config["base_url"] = $baseurl;
        
        $config['per_page'] = 10;
        
        $config['enable_query_strings'] = true;
        
        $config['uri_segment'] = 4;
        
        $config['total_rows'] = $this->blogs_model->getusercount($search_string,$search_ugroup);
        
        $this->template->title('Blogs List');

		//$this->load->view('admin/header');
        //$this->load->view('admin/blogs/blog_list',$data);
        //$this->load->view('admin/footer');	 
	 
	    $this->pagination->initialize($config);	    
		$this->template->set('countblogs',$this->blogs_model->getusercount());
	    $this->template->set('blogs',$this->blogs_model->blog_list_view($user_id,$config['per_page'],$start,$search_string,$search_ugroup));
	    $this->template->build('admin/blogs/bloglist_view');
	}


	function create_blog()
    {
	   $action='createblog';
	   $this->template->set('blogtype',$action);
     $this->template->title("Create Blog");
       $this->template->build('admin/blogs/create_view');
    }
	
	
	function create_process()
    {

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Content', 'required');

        if( $this->form_validation->run() == FALSE )
        {
            $action='createblog';
			$this->template->set('blogtype',$action);
			$this->template->build('admin/blogs/create_view');
        }
        else
        {       
           	 if( $this->blogs_model->create_blog())
            {
				$operationstatus='Blog Posted Successfully';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo '<script>location.href="'.base_url('admin/blogs/').'";</script>';
            }
            else
            {
				$operationstatus='Blog Already Exist';				
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
				echo '<script>location.href="'.base_url('admin/blogs/').'";</script>';
				
                //echo $this->lang->line('technical_problem');
            }
        }
    }
	
	function edit_blog()
    {
	   $action='editblog';
	    $bid=$this->uri->segment(4);
	  $this->template->title("Edit Blog");
	   $blogdata = $this->blogs_model->getBlog($bid);
	   
	   $this->template->set('blogtype',$action);
	   $this->template->set('blogdata',$blogdata);
       $this->template->build('admin/blogs/create_view');
    }

    public function blogDetailview()
    {
         $bid=$this->uri->segment(4);
         $action='editblog';

	 $data = $this->blogs_model->getBlog($bid);

     $this->template->set('blogtype',$action);
     $this->template->set('blogsDetail', $data);
	 $this->template->build('admin/blogs/blogdetail_view');

    }

    function post_comment_process()
    {
		$bid = $this->input->post('bid');
		$comment = $this->input->post('comment');
		
		$sessionarray = $this->session->userdata('loggedin');
		$cby = $sessionarray['id'];

        if( $this->blogs_model->create_post_comment($comment,$bid,$cby) )
        {
            echo '<script>location.href="'.base_url('admin/blogs/blogDetailview/'.$bid.'').'";</script>';
			//redirect('maincontroller/');
        }
        else
        {
            echo "Technical Problem";
        }

    }

	function edit_process()
    {
		
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Content', 'required');

        if( $this->form_validation->run() == FALSE )
        {
            $action='editblog';
			$bid=$this->input->post('bid');
	  
			$blogdata = $this->blogs_model->getBlog($bid);
	   
			$this->template->set('blogtype',$action);
			 $this->template->set('blogdata',$blogdata);
			 
			
			$this->template->build('admin/blogs/create_view');
        } 
        else
        { 
          // print_r($this->input->post());
		  
		   $bid=$this->input->post('id');
		   
            if( $this->blogs_model->update_blog($bid))
            {
				$operationstatus='Blog Edited Successfully';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo '<script>location.href="'.base_url('admin/blogs/').'";</script>';
            }
            else
            {
				$operationstatus='Unable To Edit Blog';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
				$this->session->set_flashdata('itemmsg', 'Unable To Edit Blog');
                echo $this->lang->line('technical_problem');
            }
        }
    }
	
	public function publishBlog()
	{
		 $bid=$this->uri->segment(4);
		
		
			if( $this->blogs_model->publishBlog($bid) )
            {
				$operationstatus='Blog Publish Successfully';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo '<script>location.href="'.base_url('admin/blogs/').'";</script>';
            }
            else
            {
				$operationstatus='Unable To Publish Blog';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                //echo $this->lang->line('technical_problem');
            }
	
	}
	
	public function unPublishBlog()
	{
	        $bid=$this->uri->segment(4);
		
		
		
			if( $this->blogs_model->unPublishBlog($bid) )
            {
				$operationstatus='Blog Unpublish Successfully';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo '<script>location.href="'.base_url('admin/blogs/').'";</script>';
            }
            else
            {
				$operationstatus='Unable To Unpublish Blog';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                //echo $this->lang->line('technical_problem');
            }
		
	}
	
	
	public function deleteBlog()
	{
		$bid=$this->uri->segment(4);
		if( $this->blogs_model->deleteBlog($bid) )
        {
				$operationstatus='Blog Deleted Successfully';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo '<script>location.href="'.base_url('admin/blogs/').'";</script>';
        }
        else
        {
				$operationstatus='Unable To Delete Blog';
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => $operationstatus));
                echo $this->lang->line('technical_problem');
        }
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
       $this->template->set_layout('login');
       $this->template->title('Login');
       $this->template->build('admin/users/login');
       $user_name = $this->input->post('user_name');
       $password = $this->input->post('password');
       $this->form_validation->set_rules('user_name', 'username', 'required');
       $this->form_validation->set_rules('password', 'password', 'required');
        
       if ($this->form_validation->run() === FALSE)
      	{
      	   $this->template->build('admin/users/login');
      	}else{
       $result = $this->users_model->validate($user_name, $password);
       if($result)
         {

        if($this->session->userdata('loggedin')){
          $session_data = $this->session->userdata('loggedin');
          $data['user_name'] = $session_data['user_name'];

                  redirect('admin/');

               }else{

                  redirect('admin/');
               }

         }else{
          // $this->template->set('title', 'Invlaid user name');
           //	$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
           //$this->form_validation->set_message('terminal_login_check','Invlaid user name');

       //    echo "Invlaid user name.";

         }
          }
      }
   function logout() {
     // $this->session->sess_destroy();
        $this->session->unset_userdata('loggedin');
        $this->session->set_userdata(array('user_name' => ''));
        redirect('login','refresh');
   }
   function index1($parent_id = NULL)
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
    	$this->template->append_metadata(block_submit_button());
    	$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
    	$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
    	$this->_set_rules();
    	$this->template->set('title', lang('web_category_create'));
    	$this->template->set('updType', 'create');
    	$this->template->set('parent_id',$parent_id);
       // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mlms_users.email]');
       $this->form_validation->set_rules('username', 'username', 'required');
       	if ($this->form_validation->run() === FALSE)
    	{
    	  	$this->template->build('admin/users/create_user');

    	}
    	else
      	{
      	  $imagename = ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg';
          $data = array(
            'username'		=>	$this->input->post('username'),
            'email'			=>	trim($this->input->post('email')),
            'first_name' 	=> 	$this->input->post('first_name'),
            'last_name' 	=> 	$this->input->post('last_name'),
            'images'        =>  $imagename,
            'password' 		=>  md5($this->input->post('password')),
            'author_title' 	=>  $this->input->post('author_title'),
            // 'emaillink' 	=>  $this->input->post('email'),
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
            'show_twitter' 	=>  $this->input->post('show_twitter')
          );

       $usergroups = $this->input->post('group_id');
       if($this->users_model->insertItems($data)){
             $user_id = $this->users_model->maxuserid();
             //$i=0;
       //foreach($usergroups as $usergroup){
                $group_data = array(
    					'user_id'		=>	$user_id,
    					'group_id'      =>  $usergroups

        	);
       $this->users_model->insertUserGroup($group_data);
                //$i++;
                //}
       }

       $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
       redirect('admin/users/'.$parent_id);
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
        $config['upload_path'] = 'public/uploads/users/img';
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
        echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
    }
    function edit($uid = FALSE)
    {
        $this->authenticate();
        //load block submit helper and append in the head
        $this->template->append_metadata(block_submit_button());
             	//Rules for validation
        $this->_set_rules('edit');
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
         	$this->template->title("Edit Users");
        $this->template->set('title', lang('web_category_create'));
        $this->template->set('updType', 'edit');
        $this->template->set('user',$this->users_model->getItems(($uid != 0) ? filter_var($uid, FILTER_VALIDATE_INT) : 0));
        $gids = array();
        foreach($this->users_model->getGroup($uid) as $gid){
             $gids[] = $gid->group_id;
        }
        $this->template->set('groups', $gids);
        $this->template->set('id', $uid);
        $this->form_validation->set_rules('username', 'username', 'required');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
        {
        	$this->template->build('admin/users/create_user');
        }
        else
        	{
        	  $imagename = ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg';
              $data = array(
              'username'		=>	$this->input->post('username'),
              'email'			=>	$this->input->post('email'),
              'first_name' 	    => 	$this->input->post('first_name'),
              'last_name'   	=> 	$this->input->post('last_name'),
              'images'          =>  $imagename,
              'password' 		=>  md5($this->input->post('password')),
              'author_title' 	=>$this->input->post('author_title'),
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
              'show_twitter' 	=>  $this->input->post('show_twitter')

        	);
        		$this->users_model->updateItem($uid,$data);
                $this->users_model->deleteUserGroup($uid);
                $usergroups = $this->input->post('group_id');
                //$i=0; foreach($usergroups as $usergroup){
                $group_data = array(
    							'user_id'		=>	$uid,
    							'group_id'      =>  $usergroups
    		    	);
                $isupdated = $this->users_model->insertUserGroup($group_data);
                //$i++;
              //  }
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

    function delete($id = NULL)
    {
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
    {
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
    {
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
