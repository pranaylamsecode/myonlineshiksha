<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom extends MLMS_Controller {

  function __construct()
	{
		parent::__construct();
		$this->config->load('installation_config');
		
		$this->load->helper('text');		
		$this->load->helper('commonmethods');
        $this->load->model('admin/settings_model');	
		$this->load->model('admin/programs_model');
		$this->load->model('program_model');
		$this->load->model('Category_model');
		        $this->load->model('customs_model');

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
        $this->load->model('Category_model');
        $this->template->set("tmpl", $tmpl);
        $this->template->set("categories", $this->Category_model->getAllCateg_new());
	    $auth = $this->session->userdata('logged_in');
	    
        $this->load->model('Program_model');

        $result = $this->settings_model->getItems();
        extract($result[0]);
        $this->template->set('category_list', json_decode($ctgspage));
	    $this->template->build(getOverridePath($tmpl,'custom/courselist','views'));	

	}
	public function course()
	{		
		// $categories['header'] = $this->load->view('new_template_design/header');

		 $categories1 = $this->customs_model->getAllCateg_new();
		 $categories['cate'] = $categories1;
		// $categories['footer'] =  $this->load->view('new_template_design/footer');

		echo $this->load->view('new_template_design/course', $categories, TRUE);

	}

	public function search($course=null,$catid=null)
	{
		// $this->load->view('new_template_design/header');
		$searchCourse = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('searchtext');
		if($searchCourse){
		//$searchCourse = $this->input->post('searchtext');
		if($_POST)
		{
			$searchCourse = $this->input->post('searchtext');
			$getProgram = $this->customs_model->getcourse($searchCourse);
		}
		else{
			$searchCourse = $this->uri->segment(3);
			$getProgram = $this->customs_model->getcourse11($this->uri->segment(3),$this->uri->segment(4));

		}
		$getcate = $this->customs_model->getcate($getProgram->catid);


         $getProgramCategory = $this->Category_model->getcategory1($searchCourse);
          $subcategory = $this->Category_model->subcategory($getProgram->catid);
     

		$categories1 = $this->customs_model->getcategories($getProgram->catid);
		 $categories['cate'] = $categories1;
		 $categories['program'] = $getProgram;
		 $categories['Pcategory'] = $getcate;
		 $categories['subcategory'] = $subcategory;
		}
		 $categories['searchCourse'] = $searchCourse;
		
		// $topcourse = $this->customs_model->getopcourse($getProgram->catid,$getProgram->id);
		// print_r($topcourse); exit('222');

	echo $this->load->view('new_template_design/course', $categories, TRUE);
	}

	// public function search2($value='')
	// {
	// 	$searchCourse = $this->input->post('searchtext');

	//     $sessionarray = $this->session->userdata('logged_in');
	//     $user_id = $sessionarray['id'];
		   
	// 	$this->load->model('Category_model');
		
	// 	$cat_id = NULL;
	// 	$currency = $this->settings_model->getItems();
	// 	$currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
	// 	if($currencysign)
	// 	{
	// 		$currency_symbol = $currencysign->sign;
	// 	}
	// 	else
	// 	{
	// 	$currency_symbol = " ";	
	// 	}
	// 	$this->template->set("currency_symbol", $currency_symbol);
 //        $this->template->set("wishlist", $this->Category_model->getWishlist($user_id));
 //        $getProgram = $this->Category_model->getprogram1($searchCourse);

 //        $getProgramCategory = $this->Category_model->getcategory1($searchCourse);

	// 	$this->template->set("category", $this->Category_model->getCateg($cat_id));
	// 	$this->template->set("programs", $getProgram);

	// 	$this->template->set("programCategory", $getProgramCategory);

	// 	$this->template->build(getOverridePath($tmpl,'category/searchcourses','views'));
	// }
}

?>