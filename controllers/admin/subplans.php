<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subplans extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate();
		error_reporting(0);
		$this->load->model('admin/subplans_model');				
		$this->lang->load('tooltip', 'english');		
		$this->template->set_layout('backend');
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	

		date_default_timezone_set($configarr[0]['time_zone']);
		error_reporting(0);
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

	
	public function index($parent_id = NULL)
	{ 	
		$this->template->title('Plan List');
		if($parent_id){
		$this->template->set("subplans", $this->subplans_model->getItems($parent_id));
		}else{
		$this->template->set("subplans", $this->subplans_model->getItems($parent_id));
		}
		//$this->template->set('questionscount',$this->quizzes_model->get_count_questions($parent_id));
		//$this->template->set('categories',$this->quizzes_model->get_formatted_combo($parent_id));
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/subplans/list');
	}

	function create($parent_id = FALSE) 
	{
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$this->_set_rules();
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
			
		$this->load->helper('form');
		$this->load->library('form_validation');
					
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('term', 'term', 'required');						
		$this->form_validation->set_rules('period', 'period', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/subplans/create');
		
		}
		else
		{
		$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
		
		$orderingval = $this->subplans_model->maxorder();
		$data = array(
			'name' => $this->input->post('name'),
			'term' => $this->input->post('term'),								'period' => $this->input->post('period'),
			'published' => $this->input->post('published'),
			'ordering' => $orderingval
		);
			
			$this->subplans_model->insertItems($data);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				// redirect('admin/subplans/'.$parent_id);
				redirect('admin/settings');
		}
	}
	
	function edit($qid = FALSE) 
	{
	//load block submit helper and append in the head
	$this->template->append_metadata(block_submit_button());
			
	//Rules for validation
	$this->_set_rules('edit');

	//get the $qid and sanitize
	$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
	$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;
	//variables for check the upload
	$form_data_aux			= array();
	$files_to_delete 		= array();
	//redirect if it´s no correct

	if (!$qid){
		$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
		redirect('admin/subplans/');
	}
	//create control variables
	//$this->template->title(lang("web_category_edit"));
	$this->template->title("Edit Plans");
	$this->template->set('title', lang('web_category_create'));
	$this->template->set('updType', 'edit');
	//$this->template->set('parent_id',$parent_id);
	$this->template->set('subplans',$this->subplans_model->getItems(($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : 0));
	$this->template->set('subplans', $this->subplans_model->getItems($qid));
	$this->template->set('id', $qid);
		
    $this->form_validation->set_rules('name', 'name', 'required');
	$this->form_validation->set_rules('term', 'term', 'required');				$this->form_validation->set_rules('period', 'period', 'required');
	//$this->form_validation->set_rules('description', 'description', 'required');
	//$this->form_validation->set_rules('category_id', 'category_id', 'required');
	
	if ($this->form_validation->run() == FALSE) // validation hasn't been passed
	{
		//load the view and the layout
		$this->template->build('admin/subplans/create');
	}
	else
	{					

//			$imagename = ($form_data_aux['image']) ? $form_data_aux['image'] : $data['programs']->$index;
//			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');
			$form_data =  array(
				'name' => $this->input->post('name'),
				'term' => $this->input->post('term'),										'period' => $this->input->post('period'),
				//'image' => $imagename,
				'published' => $this->input->post('published'),					
			);
			//print_r($form_data);
			$isupdated = $this->subplans_model->updateItem($qid,$form_data);
			//$delquearray = explode(',',$this->input->post('delids'));
			//$this->subplans_model->deleteQuestions($delquearray);
			if ($isupdated) // the information has therefore been successfully saved in the db
			{	
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// redirect('admin/subplans');
							redirect('admin/settings');

			}

			//if ($category->is_invalid())
			else{
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				// redirect('admin/subplans');	
				redirect('admin/settings');
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
				redirect('admin/subplans/');
			}
			
			$isdelete=$this->subplans_model->deleteItem($id);	
			
			//delete the item
			if ($isdelete) 
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
			}	

				redirect('admin/subplans');

		}
		
		public function publish($pid = FALSE){
			$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
			if (!$pid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/subplans/');
		}
		else{
				$upd_data = array(
					'published' => '1'
				);
				$in_ids = $pid;
							
				$publish = $this->subplans_model->publish_unpublishItem($in_ids,$upd_data);
				
				
				//Publish the item
				if ($publish) 
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course published successfully!' ));	
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course publish action fail or already published!' ) );
				}
				// redirect('admin/subplans/');		
				redirect('admin/settings/');		

			}
		}
		
		public function unpublish($pid = FALSE){
		$pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
			if (!$pid){
				$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
				redirect('admin/subplans');
				}
			else{
				$upd_data = array(
					'published' => '0' 
				);
				$in_ids = $pid;
				$unpublish = $this->subplans_model->publish_unpublishItem($in_ids,$upd_data);
				
				//Publish the item
				if ($unpublish) 
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Course unpublished successfully!' ));	
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Course unpublish action fail or already unpublished!' ) );
				}
				redirect('admin/settings');		
		
			}
		}
		
	}