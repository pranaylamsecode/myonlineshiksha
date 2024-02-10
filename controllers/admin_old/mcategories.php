<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcategories extends MLMS_Controller {

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
        $this->load->library('pagination');
		$this->load->model('admin/mcategories_model');
		$this->template->set_layout('backend');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';				
        $this->lang->load('tooltip', 'english');

        $this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
	}
    //check session
	function authenticate()
    {
      $session = $this->session->userdata('loggedin');
      if(!$this->session->userdata('loggedin'))
      {
       redirect('admin/users/login');
      }
    }
    //get media category list
    public function index($parent_id = NULL)
	{
	  $this->session->unset_userdata('sess_mcat');
	  $this->template->set_layout('backend');
	  $parent_id = NULL;
      $sess_mcat = $this->session->userdata('sess_mcat');
      //print_r($sess_mcat['status']);
      if($this->input->post('reset') == 'Reset'){
      $search_string = $this->input->post('search_text', TRUE);
      $status = $this->input->post('status');
      $this->session->unset_userdata('sess_mcat');
      $search_string = '';
      $status = '';
      }else{
         $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_mcat['searchterm'];
         $status = ($this->input->post('status') == '1' || is_numeric($this->input->post('status')) && $this->input->post('status') == '0') ? $this->input->post('status') : $sess_mcat['status'];
         $searchdata = array(
				 "searchterm" => $search_string,
				 "status" => $status
				 );
	   $this->session->set_userdata('sess_mcat', $searchdata);
        }
       $path=base_url() . "admin/mcategories/";
       $baseurl = base_url() . "admin/mcategories/";
       $this->load->library('pagination');
       $config['total_rows'] = $this->mcategories_model->getmcatcount($search_string,$status);
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
       $start = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : 0;
       $this->pagination->initialize($config);
       $this->template->title('Media Category List');
       $this->template->set("search_string", $search_string);
       $this->template->set("status", $status);
       $this->template->set("categories", $this->mcategories_model->getItems($parent_id,$config['per_page'],$start,$search_string,$status));	   	   $this->template->set("countmcat", $this->mcategories_model->getcountmcat());
	   $this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
	   $this->template->build('admin/mcategories/list');
	} 
	/*Function to add media category*/
	function create($parent_id = FALSE)
	{
	
        $u_data=$this->session->userdata('loggedin');
	    if(($u_data['groupid']=='4'))
		{
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
		$this->template->append_metadata(block_submit_button());
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		$this->_set_rules();
		$this->template->title("Create Media Category");
		$this->template->set('title', lang('web_category_create'));
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
        //$this->form_validation->set_rules('category_id', 'category', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->template->build('admin/mcategories/create');
		}
		else
		{
		
		$alias = $this->input->post('name');
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'parent_id' => $this->input->post('category_id'),
			'child_id' => $alias,
			'metatitle' => $alias,
			'metakey' => $alias,
			'metadesc' => $alias,
            'created_by' => $user_id,
			'published' => $this->input->post('published')
			);
			$this->mcategories_model->insertItems($data);
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				redirect('admin/mcategories/'.$parent_id);
		}
	    }
        else 
        {
         	$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to create' ));
			redirect('admin');
    	}	   
	}
	
	
   	/*Function to edit media category*/
	function edit($id = FALSE, $parent_id = FALSE)
	{
	   $u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))
    	{
	  
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
				
		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		$parent_id = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
		$id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		
		
      
		//redirect if it´s no correct
	  	if (!$id){  
		   
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/media-categories/');
		} 
		
		//create control variables
		$this->template->title("Edit Media Category");
		$this->template->set('category', $this->mcategories_model->getItems($id));
		$this->template->set('updType', 'edit');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('id',$id);
		
		
		$this->form_validation->set_rules('name', 'name', 'required');
        //$this->form_validation->set_rules('category_id', 'category', 'required');
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
		  //exit('deaef');
			//load the view and the layout
			$this->template->build('admin/mcategories/create');
		}
		else
		{
		     
			
		    $alias = $this->input->post('name');
			$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'parent_id' => $this->input->post('category_id'),
				'child_id' => $alias,
				'metatitle' => $alias,
				'metakey' => $alias,
				'metadesc' => $alias,
				'published' => $this->input->post('published')
				);
				
				
			 $isupdated=$this->mcategories_model->updateItem($id, $data);

			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				redirect('admin/mcategories/'.$parent_id);
			}
			else{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				redirect('admin/mcategories/'.$parent_id);	
			}	
	  	} 
	   }
      else {
         $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to edit' ) );
				redirect('admin');	
      }	  
	}

	function delete($id = NULL)
	{
		$mids = $this->mcategories_model->getMedia($id);
		
		if($mids)
		{
	?>
		<script>
		alert('Any of the Media is assigned under this Category. You cannot delete it');
		document.location.href = window.location.origin+'admin/media-categories';
		</script>
	<?php
		}
		else
		{
				//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/media-categories/');
		}
		
		//search the item to delete
		
		if ( $this->mcategories_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This category can not be removed, because it contains either courses or sub categories' ) );
			redirect('admin/media-categories/');
		}
	
		
		$isdelete=$this->mcategories_model->deletecat($id);
		
		//delete the item
		if ($isdelete) 
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}	

		//if ($category->category_id)
		//redirect('admin/pcategories/'.$category->category_id);
		//else
			redirect('admin/media-categories');
		}
	}
	
	
    /*Function to delete media category*/
	/*function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/mcategories/');
		}
		
		//search the item to delete
		
		if ( $this->mcategories_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This category can not be removed, because it contains either courses or sub categories' ) );
			redirect('admin/mcategories/');
		}
	
		
		$isdelete=$this->mcategories_model->deletecat($id);
		
		//delete the item
		if ($isdelete) 
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}	

		//if ($category->category_id)
		//redirect('admin/pcategories/'.$category->category_id);
		//else
			redirect('admin/mcategories');

	} */
    	/*Function to publish the quiz*/
	public function publish($qid = FALSE){
	$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/media-categories/');
			}
		else{
				$upd_data = array(
					'published' => 1
				);
				$in_ids = $qid;
				$publish=$this->mcategories_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($publish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Media Category published successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Media Category publish action fail or already published!' ) );
				}
				redirect('admin/media-categories');

			}
	}

	/*Function to unpublish the quiz*/
	public function unpublish($qid = FALSE){
		$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/media-categories/');
			}
		else{
				$upd_data = array(
					'published' => 0
				);
				$in_ids = $qid;
				$unpublish=$this->mcategories_model->publish_unpublishItem($in_ids,$upd_data);

				//Publish the item
				if ($unpublish)
				{
					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Media Category unpublished successfully!' ));
				}
				else
				{
					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Media Category unpublish action fail or already unpublished!' ) );
				}
				redirect('admin/media-categories');

			}
	}

	function createcategory()
	{
		
		$this->load->view('admin/mcategories/createmediacategories');
	}

	function savecategory()
	{
		//exit('yesss');
	 $program_name = $this->input->post('name');
	 $program_description = $this->input->post('description');
	 $program_category_id = $this->input->post('category_id');
	 $program_published = $this->input->post('published');	
	   

	 	$u_data=$this->session->userdata('loggedin');
	   
	    if(($u_data['groupid']=='4'))			
	    {
        $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];

	   $cropimagename = ($this->input->post('nameimg')) ? ($this->input->post('nameimg')) : 'no_images.jpg';	
		   //$maxrow = $this->program_model->maxRow($parent_id);
	   		$maxrow=null;
           $orderingval = 0;
		   $orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;
           
           $alias = $program_name;
		$data = array(
			'name' => $program_name,
			'description' => $program_description,
			'parent_id' => $program_category_id,
			'child_id' => $alias,
			'metatitle' => $alias,
			'metakey' => $alias,
			'metadesc' => $alias,
            'created_by' => $user_id,
			'published' => $program_published
			);
		
		$rs =  $this->mcategories_model->insertItemspop($data);      
        
	   echo $rs; 
	   
	 }
	}

	function assigncategory()
	 {
	 	  
	 	   $newId =$_POST['newId'];
	 	    $oldId =$_POST['oldId'];
	 	 
	 	  $rs = $this->mcategories_model->updateAssignCategory($oldId,$newId);
	 	 echo $rs;

	 }
}