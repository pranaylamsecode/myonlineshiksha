<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Google_Authentication extends CI_Controller
{
    function __construct() {
		parent::__construct();
		
        $this->load->model('settings_model');
        $this->load->helper('url');
        $this->load->model('login_model');
        $this->load->library('session');

        $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);

        include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        
    }

    public function googleConfig()
    {
        $loginDet = $this->settings_model->getItems();
        
        extract($loginDet[0]);
        $socialloginarray = json_decode($sociallogin);

        $googleclientid = $socialloginarray->googleplus->clientid;
        $googleclientsecreatekey = $socialloginarray->googleplus->clientsecreatekey;
        
        if($googleclientid != "" && $googleclientsecreatekey != "")
        {

            $clientId = $googleclientid;    //"159497180830-dbgtft0e2dtajfme1tbv4nmga2bpla81.apps.googleusercontent.com";
            $clientSecret = $googleclientsecreatekey; //"0vkfjLMjEhsJcwRhOvvzpUxt";
            $redirectUrl = base_url().'google_authentication/';
            
            // Google Client Configuration
            $gClient = new Google_Client();
            $gClient->setApplicationName('Login to codexworld.com');
            $gClient->setClientId($clientId);
            $gClient->setClientSecret($clientSecret);
            $gClient->setRedirectUri($redirectUrl);

            return $gClient;
           
       }
       else
       {
            redirect('category/');
       }

    }
    
    public function index(){
		
        $gClient = $this->googleConfig();
       
        $google_oauthV2 = new Google_Oauth2Service($gClient);


         if (isset($_REQUEST['code'])) 
         {    
            

            $gClient->authenticate();
            $token = $gClient->getAccessToken();            
            $gClient->setAccessToken($token);

         }        

         
        if($gClient->getAccessToken())
         {
            $userProfile = $google_oauthV2->userinfo->get();
           
           if($userProfile)
           {
    			$oauth_provider = 'google';
    			$oauth_uid = $userProfile['id'];
                $first_name = $userProfile['given_name'];
                $last_name = $userProfile['family_name'];
                $email = $userProfile['email'];
    			$gender = $userProfile['gender'];
    			$locale = $userProfile['locale'];
                $profile_url = $userProfile['link'];
                $picture_url = $userProfile['picture'];
                // ======================
                $is_exist ="";
                $email = $userProfile['email'];
                if(isset($email)&& $email!="")
                { 
                    $is_exist = $this->login_model->email_exists_ajax($email);
                     
                }

                if($is_exist)
                {

                     $password = 'fbuser';
                        $logoimage = Null;
                        $result = $this->login_model->validateforFB($email, $password);
                        
                        $courses_from_cart = $this->session->userdata('courses_from_cart');
                        $login_page_url = $_SERVER["REQUEST_URI"];
                        if($result)
                        {  
                            $last_page_url = $this->session->userdata('last_page_url');
                            
                            //added on date 13-01-2015 by yogesh
                            //$this->login_model->validate();
                            //$user_name = $this->input->post('user_name');
                            $dataNew= $this->login_model->setSessionData_fb($email);
                            $this->session->set_userdata('logged_in',$dataNew);
                            
                            if($this->session->userdata('logged_in'))
                            {
                                $auth = $this->session->userdata('logged_in');
                                $data['user_name'] = $auth['user_name'];
                                if(isset($courses_from_cart) && $courses_from_cart != '' && $auth['groupid'] == '1')
                                {
                                    redirect('buyitems/cart');
                                }
                                else
                                {
                                    $first = $this->login_model->first_time_login($email);
                                    if($first->first_time_login == '0')//if zero i.e. first time
                                    {

                                        // $urldomain = base_url();
                                        // $urldomain = str_replace('http://', '', $urldomain);
                                        // $urldomain = str_replace('/', '', $urldomain);
                                        // $urldomain = str_replace('www.', '', $urldomain);
                                        $urldomain = $this->config->item('urldomain');
                                        
                                        $this->load->model('admin/settings_model');
                                        $configarr = $this->settings_model->getItems();
                                        $this->template->set("configarr", $configarr);
                                        $subject = 'Welcome to '.$configarr[0]['institute_name'];
                                        $toemail = $email;
                                        $content = '';
                                        $content .= '<p>Dear '.trim(ucfirst($first->first_name)).' '.trim(ucfirst($first->last_name)).',<br /><br />';
                                        $content .= 'Welcome to '.$configarr[0]['institute_name'].'. We are glad to have you on board!<br /><br />';
                                        $content .= 'You can now find out and subscribe to the courses as per your requirements, participate in discussions with your fellow students and teachers and also attend Webinars or live online classes during the courses.<br /><br />';
                                        $content .= '<a href = "'.base_url().'" >Discover Courses Now</a>.<br /><br />';                            
                                        $content .= 'If you need help or have any questions, please contact us.<br />';
                                        $content .= '<br /><br />';
                                        $content .= '...</p>';
                                         $content .= $configarr[0]['signature'].'</p>';
                                        //$message = $content;
                                         $data['content'] = $content;
                                        $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
                                        //$fromemail=$configarr[0]['fromemail'];// admin mail   
                                        $fromemail='noreply@'.$urldomain;
                                        $config['charset'] = 'utf-8';
                                        $config['mailtype'] = 'html';
                                        $config['wordwrap'] = TRUE;
                                        $this->email->initialize($config);
                                        $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
                                        $this->email->subject($subject);
                                        $this->email->to($toemail);
                                        $this->email->message($message);
                                        $this->email->send();       
                                                            
                                        $this->login_model->update_first_users($email);                     
                                    }
                                    
                                    if($last_page_url == '')
                                    {
                                        redirect('category/');
                                        //echo 'success';
                                    }
                                    else
                                    {
                                        header("Location: $last_page_url");
                                    }
                                }
                            }
                            else
                            {
                                redirect('category/');
                                //echo 'success';
                            }
                        }
                    

                }
                else
                {

                       $emai = $email;
                       $first_name = $first_name;
                       $last_name = $last_name ;                           
                       $image = $picture_url;

                        $content = file_get_contents($image);
                        //Store in the filesystem.
                        $image = rand(500,100000);
                        $fileName = 'public/uploads/users/img/thumbs/'.$image.'_'.date('Y-m-d').'.jpg';
                        $fp = fopen($fileName, 'w+');
                        fputs($fp, $content);
                        fclose($fp);
                        
                        
                        $user_data = array(
                           //   'username'      =>  $this->input->post('username'),
                            'email'         =>  $email,
                            'first_name'    =>  $first_name,
                            'last_name'     =>  $last_name,
                            'active'        =>  '1',
                            'is_student'    =>  '1',//one is for yes
                            'is_instructor' =>  '0',//zero is for no
                            'images'        =>  $image.'_'.date('Y-m-d').".jpg",
                            'group_id'      =>  '1'     
                            );
                            $usergroups = '1';                      
                            
                            $this->load->model('login_model');
                            $insertid = $this->login_model->insertItems($user_data);
                            if($insertid > 1)
                            {
                                       $user_id = $this->login_model->maxuserid();
                                        $group_data = array(
                                                'user_id'       =>  $insertid,
                                                'group_id'      =>  $usergroups

                                    );
                                    $this->login_model->insertUserGroup($group_data);
                            }

                            if($insertid)
                            {
                                $last_page_url = $this->session->userdata('last_page_url');
                                
                            
                                $dataNew= $this->login_model->setSessionData_fb($email);
                                $this->session->set_userdata('logged_in',$dataNew);
                                
                                if($this->session->userdata('logged_in'))
                                {
                                    $auth = $this->session->userdata('logged_in');
                                    $data['user_name'] = $auth['user_name'];
                                }
                                
                                if($last_page_url == '')
                                {
                                        redirect('category/');
                                        //echo 'success';
                                }
                                else
                                {
                                    header("Location: $last_page_url");
                                }
                                //redirect('category/');
                            }
                            
                            

                }

                // =============================
           }
			
           echo"<pre>";
           print_r($userProfile);

            
        } 
        else 
        {
            echo $authUrl = $gClient->createAuthUrl();
        }
		
    }

    public function login()
    {        
        $gClient = $this->googleConfig();
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if(isset($_REQUEST['code'])) 
        {            
            $gClient->authenticate();           
            $token = $gClient->getAccessToken();
            $gClient->setAccessToken($token);
            
        }        

        if($gClient->getAccessToken())
        {
            echo "already";
        } 
        else 
        {           

            echo $data['authUrl'] = $gClient->createAuthUrl();
        }

    }
	
	public function logout() {

		$this->session->unset_userdata('token');
		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();       
		redirect('google_authentication');
    }
}
