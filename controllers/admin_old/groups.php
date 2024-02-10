<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Groups extends MLMS_Controller
{
function __construct()
	{
        parent::__construct();
        $this->authenticate();
        error_reporting(0);
        $this->load->model('admin/groups_model');
        $this->load->helper('form');
		$this->load->library('form_validation');
		$this->template->set_layout('backend');		
		$this->lang->load('tooltip', 'english');

		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);

	}
    function authenticate()
    {
      $session = $this->session->userdata('loggedin');
     // print_r($session);
      if(!$this->session->userdata('loggedin'))
      {
       redirect('admin/users/login');
      }
    }
    function index($parent_id = NULL)
	{
	  $this->template->title('User Categories');
		//if($parent_id){
		$this->template->set("groups", $this->groups_model->getItems($parent_id));
		//}else{
		//$this->template->set("groups", $this->groups_model->get_formatted_combo($parent_id));
		//}
		//$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('admin/groups/list');
	}
   function create($parent_id = FALSE)
   {
		   //  print_r($_POST);

           //echo date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('from-date'))));
          // echo date('Y-m-d', strtotime($this->input->post('from-date')));


           //  exit;
			$this->template->append_metadata(block_submit_button());
			$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
			$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
			$this->_set_rules();
			$this->template->title("Create Category");
			$this->template->set('title', lang('web_category_create'));
			$this->template->set('updType', 'create');
			$this->template->set('parent_id',$parent_id);
            $this->form_validation->set_rules('title', 'title', 'required');
		    //$this->form_validation->set_rules('pid', 'group name', 'required');
			if ($this->form_validation->run() === FALSE)
			{
				$this->template->build('admin/groups/create');
			}
			else
			{
			$data = array(
				'parent_id' => $this->input->post('pid'),
				'title' => $this->input->post('title')
			);
				$this->groups_model->insertItems($data);
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			   	redirect('admin/groups/'.$parent_id);
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
			redirect('admin/users-category/');
		}
		$this->template->title("Edit Category");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'edit');
        $this->template->set('groups',$this->groups_model->getItems($qid));
		$this->template->set('id', $qid);

        $this->form_validation->set_rules('title', 'title', 'required');
		//$this->form_validation->set_rules('pid', 'pid', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->template->build('admin/groups/create');
		}
		else
			{
                $form_data = array(
				'parent_id' => $this->input->post('pid'),
				'title' => $this->input->post('title')
			    );
				//print_r($form_data);
				$isupdated = $this->groups_model->updateItem($qid,$form_data);

				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/users-category');
				}else{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
					redirect('admin/users-category');
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
    		redirect('admin/users-category/');
    	}
       //if($this->users_model->deleteItem($id)){
         $isdelete = $this->groups_model->deleteItem($id);
     //  }
    	//delete the item
    	if ($isdelete)
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
    	}
    	else
    	{
    		$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
    	}

    		redirect('admin/users-category');

    }


	private function set_rules($id = NULL)
	{
		//Creamos los parametros de la funcion del constructor.
		// More validations: http://codeigniter.com/user_guide/libraries/form_validation.html
		if ($id)
		{
			$this->form_validation->set_rules('name', 'name', "required|trim|xss_clean|min_length[0]|max_length[60]|is_unique[groups.name.id.$id]");
		}
		else
		{
			$this->form_validation->set_rules('name', 'name', "required|trim|xss_clean|min_length[0]|max_length[60]|is_unique[groups.name]");
		}


		$this->form_validation->set_rules('description', 'description', 'trim|xss_clean|min_length[0]|max_length[500]');
		$this->form_validation->set_error_delimiters("<br /><span class='error'>", '</span>');
	}		




}