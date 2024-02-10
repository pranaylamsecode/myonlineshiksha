<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Blogs extends MLMS_Controller

{



	function __construct()

	{

		parent::__construct();

        $this->load->helper(array('form', 'url','pages'));

        

        $this->load->library('session');

        $this->load->model("blogs_model");

        $this->template->set_layout('frontend');

        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->load->helper('cookie');

        $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);

	}

    public function index()

	{

     $tmpl = "default";

	 $data = $this->blogs_model->blog_list();

	 

     $this->template->set("tmpl", $tmpl);

     $this->template->set("blogs", $data);

	 $this->template->build('blogs/blog_view');

     

    }

	

	

	function post_comment_process()

    {

		$comment=$this->input->post('comment');

		$bid=$this->input->post('bid');

		$cby=$this->input->post('cby');

        

            if( $this->blogs_model->create_post_comment($comment,$bid,$cby) )

            {

                echo '<script>location.href="'.base_url('blogs/').'";</script>';

				//redirect('maincontroller/');

            }

            else

            {

                echo "Technical Problem";

            }

       

    }

	

	

    function login()

     {

       $tmpl = "default";

       $this->template->set("tmpl", $tmpl);

       $this->template->title('Login');

       $this->template->build('user/login');

       $username = $this->input->post('username');

       $password = $this->input->post('password');

       $result = $this->login_model->validate($username, $password);

       $courses_from_cart = $this->session->userdata('courses_from_cart');

       $login_page_url = $_SERVER["REQUEST_URI"];



      // $this->_set_rules();

       $this->form_validation->set_rules('username', 'username', 'required');

       $this->form_validation->set_rules('password', 'password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']');

       if ($this->form_validation->run() === FALSE)

        	{

        	   $this->template->build('user/login');

        	}else{

                 if($result)

                   {

                      $last_page_url = $this->session->userdata('last_page_url');

                      //echo $login_page_url = $_SERVER["REQUEST_URI"];

                         if($this->session->userdata('logged_in')){

                            $auth = $this->session->userdata('logged_in');

                            $data['username'] = $auth['username'];

                                 if(isset($courses_from_cart) && $courses_from_cart != '' && $auth['groupid'] == '1'){

                                     redirect('buyitems/cart');

                                 }else{

                                        if($last_page_url == ''){

                                            redirect('category/');

                                        }else{

                                            header("Location: $last_page_url");

                                    }

                                 }

                         }else{

                          redirect('category/');

                         }

                  }

          }

    }

    function registration()

     {

         $tmpl = "default";

         $this->template->set("tmpl", $tmpl);

         $this->template->title('Registration');

         $this->_set_rules();

         $this->form_validation->set_rules('username', 'username', 'required');

         if ($this->form_validation->run() === FALSE)

      	 {

      	   $this->template->build('user/registration');

      	 }

      	else

        	{

                $data = array(

      					'username'		=>	$this->input->post('username'),

      					'email'			=>	$this->input->post('email'),

      					'first_name' 	=> 	$this->input->post('first_name'),

      					'last_name' 	=> 	$this->input->post('last_name'),

                        'active' 	    =>  '0',

                        'password' 		=>  md5($this->input->post('password')),

                        'webstatus' 	=> 	$this->input->post('webinarstatus')

      	);

         $usergroups = '5';



         if($this->login_model->insertItems($data)){

               $user_id = $this->login_model->maxuserid();

                  $group_data = array(

      					'user_id'		=>	$user_id,

      					'group_id'      =>  $usergroups



          	);

         $this->login_model->insertUserGroup($group_data);

         }

	     $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

		 redirect('users/registration');

   }

}



function login_user()

     {

     $tmpl = "default";

     $this->template->set("tmpl", $tmpl);

     $this->template->title('Login');

     $this->template->build('user/login_user');

     $username = $this->input->post('username');

     $password = $this->input->post('password');



     $result = $this->login_model->validate($username, $password);

    // print_r($result);

     if($result)

       {

        if($this->session->userdata('logged_in')){

        // print_r($this->session->userdata('logged_in'));exit;

        $auth = $this->session->userdata('logged_in');

        $data['username'] = $auth['username']; ?>

             <script type="text/javascript">

				parent.jQuery.fancybox.close();

			   //	window.parent.location.href = "<?php echo base_url(); ?>/category/";

				</script>

             <?php //redirect('category/');



             }else{ ?>

               <script type="text/javascript">

				parent.jQuery.fancybox.close();

			   //	window.parent.location.href = "<?php echo base_url(); ?>/category/";

				</script>

            <?php }



       } ?>

         <script type="text/javascript">

				parent.jQuery.fancybox.close();

			   //	window.parent.location.href = "<?php echo base_url(); ?>/category/";

				</script>



    <?php }

    function logout() {

   // $this->session->sess_destroy();

    $this->session->unset_userdata('logged_in');

    $this->session->unset_userdata('last_page_url');  

    $this->session->set_userdata(array('username' => ''));

    redirect('users/login','refresh');

    }

	private function _set_rules($type = 'create', $id = NULL)

	{

		//validate form input

		$this->form_validation->set_rules('first_name', 'lang:web_name', 'required|xss_clean');

		$this->form_validation->set_rules('last_name', 'lang:web_lastname', 'required|xss_clean');



		if ($id)

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[users.email.id.'.$id.']|xss_clean');

		}

		else

		{

			$this->form_validation->set_rules('email', 'lang:web_email', 'required|valid_email|is_unique[users.email]|xss_clean');

		}



		if ($type == 'edit')

			$this->form_validation->set_rules('password', 'lang:web_password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');

		else

			$this->form_validation->set_rules('password', 'lang:web_password', 'required|min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');



		if ($type == 'edit')

			$this->form_validation->set_rules('password_confirm', 'lang:web_password_confirm', '');

		else

			$this->form_validation->set_rules('password_confirm', 'lang:web_password_confirm', 'required');



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



			$this->template->build('user/forgot_password');

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

?>