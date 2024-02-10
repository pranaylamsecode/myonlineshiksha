<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Learn extends MLMS_Controller {

  function __construct()
	{
		parent::__construct();
		        $this->load->model('admin/settings_model');		

		$configarr = $this->settings_model->getItems();	
		// $this->template->set_layout($configarr[0]['layout_template']);
		$this->template->set("configarr", $configarr);
        $this->load->model('Courses_model');
        $this->load->model('crud_model');		

		date_default_timezone_set($configarr[0]['time_zone']);
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		// error_reporting(0);

	}

	public function index($cate_id = null){

		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template']; 
		$this->load->view('new_template_design/header', array("tmpl" => $tmpl));
		$condition = 'parent_id is NULL';
			$category = $this->crud_model->getData('mlms_learning_category', 'id, parent_id, name, slug, description', $condition,'','','','','');
			// print_r($category);
			/*$sub_cate = $this->crud_model->getData('mlms_learning_category', 'name,id,parent_id, slug', array('parent_id'=>$category[0]->id),'','','','','');*/
		
		/*print_r($category);
		print_r($sub_cate);
		print_r($tmpl);*/
		/*$this->template->set("tmpl", $tmpl);
		$this->template->set("sub_cate", $sub_cate);
		$this->template->set("category", $category[0]);
		$this->template->build(getOverridePath($tmpl,'category/learn_content','views'));*/
			$data = array("tmpl" => $tmpl,
			"sub_cate" => @$sub_cate,
			"category" => @$category);
		// $this->template->set("category", $category[0]);
		$this->load->view('category/learn_content', $data);
		$this->load->view('new_template_design/footer');
	}

	public function content($cate_id){
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template']; 
		$this->load->view('new_template_design/header', array("tmpl" => $tmpl));
		if(is_numeric($cate_id))
			$condition = array('id'=>$cate_id);
		else $condition = array('slug'=>$cate_id);

		$category = $this->crud_model->getData('mlms_learning_category', 'id, parent_id, name, slug, description', $condition,'','','','','');
		$sub_cate = $this->crud_model->getData('mlms_learning_category', 'name,id,parent_id, slug', array('parent_id'=>$category[0]->id),'','','','','');
		/*print_r($category);
		print_r($sub_cate);
		print_r($tmpl);*/
		/*$this->template->set("tmpl", $tmpl);
		$this->template->set("sub_cate", $sub_cate);
		$this->template->set("category", $category[0]);
		$this->template->build(getOverridePath($tmpl,'category/learn_content','views'));*/
			$data = array("tmpl" => $tmpl,
			"sub_cate" => $sub_cate,
			"category" => @$category[0]);
		// $this->template->set("category", $category[0]);
		$this->load->view('category/learn_content', $data);
		$this->load->view('new_template_design/footer');
	}

	public function contentAllPages($Pcate_id, $cate_id){

		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template']; 
		$this->load->view('new_template_design/header', array("tmpl" => $tmpl));
		if(!is_numeric($Pcate_id))
		{
			$Pcate_id = $this->Courses_model->getCatIdbySlug('mlms_learning_category',$Pcate_id);
		}
		/*
		$sub_cate = $this->crud_model->getData('mlms_learning_category', 'name,id,parent_id, slug', array('parent_id'=>$Pcate_id),'','','','','');*/

		if(!is_numeric($cate_id))
		{
			$cate_id = $this->Courses_model->getCatIdbySlug('mlms_learning_category',$cate_id, $Pcate_id);
		}
		$related_pg = $this->crud_model->getData('mlms_learncontent', 'page_id, catid, heading,slug, image', array('catid'=>$cate_id),'','','','','');
		$data = array('pages' => $related_pg);
		// print_r($related_pg);
		/*print_r($category);
		print_r($sub_cate);
		print_r($tmpl);*/
		/*$this->template->set("tmpl", $tmpl);
		$this->template->set("sub_cate", $sub_cate);
		$this->template->set("category", $category[0]);
		$this->template->build(getOverridePath($tmpl,'category/learn_content','views'));*/
			
		// $this->template->set("category", $category[0]);
		$this->load->view('category/allPages', $data);
		$this->load->view('new_template_design/footer');
	}

	public function contentPage($Pcate_id, $cate_id, $page_id=''){
		$configarr = $this->settings_model->getItems();	  
		$tmpl = $configarr[0]['layout_template']; 
		$this->load->view('new_template_design/header', array("tmpl" => $tmpl));
		if(!is_numeric($Pcate_id))
		{
			$Pcate_id = $this->Courses_model->getCatIdbySlug('mlms_learning_category',$Pcate_id);
		}
		if(!is_numeric($cate_id))
		{
			$cate_id = $this->Courses_model->getCatIdbySlug('mlms_learning_category',$cate_id, $Pcate_id);
		}


		
		// $category = $this->crud_model->getData('mlms_learning_category', 'id, parent_id, name, slug, description', array('id'=>$cate_id),'','','','','');
		if($page_id)
			$pg_content = $this->crud_model->getData('mlms_learncontent', 'page_id, catid, heading,slug,content,doc_file, image', array('catid'=>$cate_id, 'slug'=>$page_id),'','','','','');
		else $pg_content = $this->crud_model->getData('mlms_learncontent', 'page_id, catid, heading,slug,content,doc_file, image', array('catid'=>$cate_id),'','page_id ASC','','','');

		$related_pg = $this->crud_model->getData('mlms_learncontent', 'page_id, catid, heading,slug', array('catid'=>$cate_id),'','','','','');
		
			    $auth = $this->session->userdata('logged_in');

		$data = array("auth" => $auth,
			"page" => $pg_content[0],
			"related_pg" => $related_pg
						);
		// $this->template->set("category", $category[0]);
		$this->load->view('category/learn_page', $data);
		$this->load->view('new_template_design/footer');

		// $this->template->build(getOverridePath($tmpl,'category/learn_page','views'));
	}

/*	function pdf_download(){
		$data = array('user_id' => 1, 
							'catid' => 1,
							'page_id' => 2);
					$add_user = $this->crud_model->SaveUpdateData('mlms_resourceUser', 'id', $data);
					print_r($add_user);

	}*/


	function pdf_download()
	{
		$post = $_POST;
		$auth = $this->session->userdata('logged_in');
		if($auth){
			$pdf = $this->crud_model->getData('mlms_learncontent', 'doc_file', array('page_id' => $post['page_id']),'','','',1,'');
			$data = array('user_id' => $auth['id'], 
							'catid' => $post['catid'],
							'page_id' => $post['page_id'],
							'file' => $pdf->doc_file);

			$add_user = $this->crud_model->SaveUpdateData('mlms_resourceUser', 'id', $data);
			$response = array('success' => true, 'download' => 1, "pdf" => "https://mos.veerit.com/public/LearnContent/pdf_file/".$pdf->doc_file);
		
		}
		else $response = array('error' => 'Invalid User!');
		echo json_encode($response);
		// https://mos.veerit.com/public/js/pdfjs-2.5.207-es5-dist/web/viewer.html?file=
		

		// echo "success";
		// echo base_url()."public/LearnContent/pdf_file/";
	}
}

?>