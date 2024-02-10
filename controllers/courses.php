<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends MLMS_Controller {

  function __construct()
	{
		parent::__construct();
		$this->config->load('installation_config');
		
		$this->load->helper('text');		
		$this->load->helper('commonmethods');
        $this->load->model('admin/settings_model');		
		$configarr = $this->settings_model->getItems();	
		$this->template->set_layout($configarr[0]['layout_template']);
		$this->load->model('admin/Pagecreator_model');
		$this->template->set("configarr", $configarr);

		date_default_timezone_set($configarr[0]['time_zone']);

	}


    public function index($parent_id = NULL)
	{
	   
        $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
        $this->load->model('Courses_model');
        $this->template->set("tmpl", $tmpl);
        $this->template->set("categories", $this->Courses_model->getAllCateg());
	    $auth = $this->session->userdata('logged_in');
        $this->load->model('Program_model');
        $result = $this->settings_model->getItems();
        extract($result[0]);
        $this->template->set('category_list', json_decode($ctgspage));
	    $this->template->build(getOverridePath($tmpl,'category/list','views'));		
	}

	
	
	public function search($parent_id = NULL)
	{
	
         $search_text = $_GET['searchtext'];

    	
         
        // Search courses wise
        $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
        $this->load->model('Courses_model');
        $this->template->set("tmpl", $tmpl);
        $this->template->set("categories", $this->Courses_model->getProgram($search_text));
	    $auth = $this->session->userdata('logged_in');
        $this->load->model('Program_model');
        $result = $this->settings_model->getItems();
        extract($result[0]);
        $this->template->set('category_list', json_decode($ctgspage));
	    $this->template->build(getOverridePath($tmpl,'courses/list','views'));	
		
		// Search category wise
	   
       /* $this->load->model('admin/settings_model');      
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];      
        $this->load->model('Courses_model');
        $this->template->set("tmpl", $tmpl);
        $this->template->set("categories", $this->Courses_model->getAllCateg($search_text));
	    $auth = $this->session->userdata('logged_in');
        $this->load->model('Program_model');
        $result = $this->settings_model->getItems();
        extract($result[0]);
        $this->template->set('category_list', json_decode($ctgspage));
	    $this->template->build(getOverridePath($tmpl,'courses/list','views')); */	
	}

	
	
	public function view($cat_id = NULL)
	{
        $this->load->model('admin/settings_model');     
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template'];     
		$this->load->model('Courses_model');
		$cat_data = $this->Courses_model->getCateg($cat_id);
		$this->template->title($cat_data->name);     
        $cat_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
        if(!isset($cat_id) && $cat_id == '')
		{
			redirect('category');
	    }

        $getProgram = $this->Courses_model->getProgram($cat_id);
		$this->template->set("tmpl", $tmpl);
		$this->template->set("category", $this->Courses_model->getCateg($cat_id));
		$this->template->set("programs", $getProgram);
		$this->template->build(getOverridePath($tmpl,'category/courses','views'));
	}
}
?>