<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Aclp extends MLMS_Controller
{
function __construct()
	{
        parent::__construct();
        $this->authenticate();
        $this->load->model('admin/groups_model');
        //$this->load->model('admin/accessgroups_model');
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
	  $this->load->model('admin/accessgroups_model');
	  $this->template->title('User Permissions');
	  $this->template->set("groups", $this->accessgroups_model->getItems($parent_id));
	  $this->template->build('admin/aclp/list');
	}

   function create($parent_id = FALSE)
   {
            $this->load->model('admin/accessgroups_model');
            $this->template->title('Create User Permissions');
            $grpid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) :$this->input->post('grpiid');

            if(isset($grpid)&& $grpid!='')
            {
                $grpobj=$this->accessgroups_model->getGroupDetail($grpid);
            }
            else
            {
                 $grpobj=array();
            }


			$this->template->append_metadata(block_submit_button());

            $this->template->set('grpobj',$grpobj);
            $this->template->set('grpid',$grpid);
			$this->template->set('updType', 'create');

            $this->form_validation->set_rules('modules', 'modules', 'required');
		    $this->form_validation->set_rules('permission', 'permission', 'required');
		    $this->form_validation->set_rules('access','access','required');


            if($this->input->post('grpiid') && $this->input->post('modules'))
            {
                $this->form_validation->set_rules('chkgrp','','callback_checkExiste');
            }

			if ($this->form_validation->run() === FALSE)
			{
				$this->template->build('admin/aclp/create');
			}
			else
			{

			    $data = array(
				'group_id' =>$this->input->post('grpiid'),
				'modules' => $this->input->post('modules'),
				'permission' => $this->input->post('permission'),
				'access' => $this->input->post('access')
			);

                //print_r($data);		        //exit('aaa');
                $gpid=$this->input->post('grpiid');
				$this->accessgroups_model->insertItems($data);                 echo $this->db->last_query();								
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
			   	//redirect('admin/aclp/'.$parent_id);
			   	redirect('admin/user-permissions/');
			}
		}

    function checkExiste()
    {
       $group_id =$this->input->post('grpiid');
	   $modules =$this->input->post('modules');

       if($this->accessgroups_model->checkExisteModules($group_id,$modules))
        return false;
       else
        return true;
    }

    function edit($qid = FALSE)
	{
		$this->load->model('admin/accessgroups_model');
		$parent_id = $this->uri->segment(4);
        $u_data = $this->session->userdata('loggedin');
        $accessBy = $this->accessgroups_model->accessPresent($parent_id);
        if((@$accessBy[0]->group_id != $u_data['id'] && $u_data['groupid'] != '4') || empty($accessBy))
        {
            redirect('admin/users/page404'); 
        }

		//load block submit helper and append in the head
        $modid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

       
		$this->template->append_metadata(block_submit_button());

		//Rules for validation
		$this->_set_rules('edit');
		//get the $qid and sanitize
		//$qid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

		//$qid = ($qid != 0) ? filter_var($qid, FILTER_VALIDATE_INT) : NULL;
		$modid = ($modid != 0) ? filter_var($modid, FILTER_VALIDATE_INT) : NULL;

        $grpmodobj=$this->accessgroups_model->getModuleDetail($modid);

        $grpobj=$this->accessgroups_model->getGroupDetail($grpmodobj->group_id);

		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
	   /*	if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/groups/');
		}   */

        if (!$modid)
        {
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/user-permissions/');
        }

		$this->template->title("Edit Module");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'edit');
        //$this->template->set('groups',$this->groups_model->getItems($qid));

        $this->template->set('grpobj',$grpobj);
        $this->template->set('grpmodobj',$grpmodobj);
		//$this->template->set('id', $qid);
		$this->template->set('id', $modid);


		$this->form_validation->set_rules('permission', 'permission', 'required');
        $this->form_validation->set_rules('access', 'access', 'required');



		if ($this->form_validation->run() === FALSE) // validation hasn't been passed
		{
			$this->template->build('admin/aclp/create');
		}
		else
			{
                $form_data = array(
				'permission' => $this->input->post('permission'),
				'access' => $this->input->post('access'),
				'modules' => $this->input->post('modules'),
			    );

			   	//print_r($form_data);
				$isupdated = $this->accessgroups_model->updateItem($modid,$form_data);

			   if ($isupdated) // the information has therefore been successfully saved in the db
				{
				    $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/user-permissions');
				}else{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				   	redirect('admin/aclp/edit/'.$modid);
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
    		redirect('admin/groups/');
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

    		redirect('admin/groups');

    }


     function set_rules($id = NULL)
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


    public function publish($qid = FALSE){

      $this->load->model('admin/accessgroups_model');

	$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/user-permissions/');
			}
		else{
				$upd_data = array(
					'access'=>'1'
				);
				$in_ids = $qid;
				$publish=$this->accessgroups_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Access Groups published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Access Groups publish action fail or already published!' ) );
				}
				redirect('admin/user-permissions');

			}
	}

    	public function unpublish($qid = FALSE){

    	  $this->load->model('admin/accessgroups_model');
		$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;

		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/user-permissions/');
			}
		else{
				$upd_data = array(
					'access' => '0'
				);
				$in_ids = $qid;
				$unpublish=$this->accessgroups_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Access Groups unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Access Groups unpublish action fail or already unpublished!' ) );
				}
			  	redirect('admin/user-permissions');

			}
	}


}