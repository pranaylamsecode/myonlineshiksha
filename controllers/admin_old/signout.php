<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Signout extends MLMS_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');

        $this->load->helper('url');	

		    $this->lang->load('tooltip', 'english');

        $this->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems(); 
    date_default_timezone_set($configarr[0]['time_zone']);

    }

     public function destradmin() 
   {     
      $this->session->sess_destroy();
      $this->session->unset_userdata('loggedin');
      $this->session->unset_userdata('mparr');
      $this->session->unset_userdata('Active_menu');
      //$this->session->set_userdata(array('user_name' => ''));
      //front end logout
            $sessionarray = $this->session->userdata('logged_in');       
          if($sessionarray)
          {
                    $sessionarray = $this->session->all_userdata();
                  
                  // if($sessionarray['isfblogin'] == 1)
                  // {
                  //   redirect('hauth/logout/Facebook');
                  // }
                   
                      $this->session->unset_userdata('logged_in');
                      $this->session->unset_userdata('last_page_url');
                      $this->session->set_userdata(array('username' => ''));
                      $this->session->unset_userdata('maccessarr');
            //front end logout
        }
      redirect('admin/users/login','location', 301);
      //exit();
   }
}

