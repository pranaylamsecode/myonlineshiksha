<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userreport extends MLMS_Controller {

	function __construct()
	{
		parent::__construct();		$this->authenticate();//when not login redirect to login page
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('admin/Userreport_model');		
        $this->lang->load('tooltip', 'english');
       // $this->load->model('Myinfo_model');
       // $this->load->model('Tasks_model');
        $this->load->helper('time_difference');	
        
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


    public function index()
	{	
     $this->template->set_layout('backend');

     $this->template->set('action',"coursereport");


      $this->template->set("courses", $this->Userreport_model->getPrograms());

     $this->template->build('admin/userreport/viewreport');
    }







 private function _set_rules($type = 'create', $id = NULL)
	{
		//validate form input
		$this->form_validation->set_rules('firstname', 'lang:web_name', 'required|xss_clean');
		$this->form_validation->set_rules('lastname', 'lang:web_lastname', 'required|xss_clean');
		$this->form_validation->set_rules('uname', 'lang:web_uname', 'required|xss_clean');

    	$this->form_validation->set_rules('email_id', 'lang:web_email', 'required|valid_email|is_unique[users.email]|xss_clean');

    	$this->form_validation->set_rules('cpassword', 'lang:web_password', 'min_length[' . $this->config->item('min_password_length') . ']|max_length[' . $this->config->item('max_password_length') . ']|matches[password_confirm]');

    	$this->form_validation->set_rules('cpassword_confirm', 'lang:web_password_confirm', '');

		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	}


   public function printcertificate(){
      $this->load->model('Myinfo_model');
      $this->load->model('admin/certificates_model');
      $this->load->model('Lessons_model');
      $tmpl = "default";
      $this->template->set("tmpl", $tmpl);
      $sessionarray = $this->session->userdata('logged_in');
      $this->template->set("username", $sessionarray);
      $op = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

      $coursename = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

      $author_name = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : NULL;
      $certificateid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : NULL;
      $date_completed = ( $this->uri->segment(7) )  ? $this->uri->segment(7) : NULL;
      $cid = ( $this->uri->segment(8) )  ? $this->uri->segment(8) : NULL;
      $opt = ( $this->uri->segment(9) )  ? $this->uri->segment(9) : NULL;
      $this->template->set("coursename", trim(urldecode($coursename)));
      $this->template->set("author_name", $author_name);
      $this->template->set("certificateid", $certificateid);
      $this->template->set("date_completed", $date_completed);
      $this->template->set("opt", $opt);
      $this->template->set("op", $op);
      $this->template->set("cid", $cid);
      $cetificate_background = $this->certificates_model->getItems();
      $this->template->set("imagename", $cetificate_background);
      $cetificate_msg = $this->Lessons_model->getCertificateMsg($cid);
      $this->template->set("cetificate_msg", $cetificate_msg);
      $this->template->build('myinfo/printcertificate');

   }

    public function courseDetail(){

            $courseid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : NULL;

            $enrolllist=$this->Userreport_model->getEnrolledUser($courseid);

            $this->template->set_layout('backend');

            $this->template->set('action',"courseenrollreport");



            $this->template->set("enrolledusers", $enrolllist);

            $this->template->build('admin/userreport/viewreport');



      }


}
?>