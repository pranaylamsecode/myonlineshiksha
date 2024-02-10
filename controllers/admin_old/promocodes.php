<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promocodes extends MLMS_Controller {

	protected $before_filter = array(
	);

	function __construct()
	{
		parent::__construct();
		$this->authenticate();
		$this->load->model('admin/promocode_model');
		$this->template->set_layout('backend');		
    $this->lang->load('tooltip', 'english');

    $this->load->model('admin/settings_model');
        $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);
       // $this->load->library('ckeditor');
        //$this->ckeditor->basePath = base_url().'public/asset/ckeditor/';		
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

    public function index($promoid = NULL)
	{
	   $this->session->unset_userdata('sess_promocode');
	   $promoid = NULL;
	   $this->template->set_layout('backend');
       $sess_promocode = $this->session->userdata('sess_promocode');
       if($this->input->post('reset') == 'Reset'){

       $search_promos = $this->input->post('search_promos', TRUE);
       $search_status = $this->input->post('promos_publ_status', TRUE);
       //$search_pstatus = $this->input->post('promo_status', TRUE);
       $this->session->unset_userdata('sess_promocode');
       $search_promos = '';
       $search_status = '';
       //$search_pstatus = '';
      }else{
       $search_promos = ($this->input->post('search_promos', TRUE)) ? $this->input->post('search_promos', TRUE) : $sess_promocode['search_promos'];
       $search_status = ($this->input->post('promos_publ_status') == '1' || is_numeric($this->input->post('promos_publ_status')) && $this->input->post('promos_publ_status') == '0') ? $this->input->post('promos_publ_status') : $sess_promocode['search_status'];
       //$search_pstatus = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_promocode['search_pstatus'];
       $searchdata = array(
				 "search_promos" => $search_promos,
				 "search_status" => $search_status
				 //"search_pstatus" => $search_pstatus
				 );
	   $this->session->set_userdata('sess_promocode', $searchdata);
       }
       $path=base_url() . "admin/programs/";

      $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
      $baseurl = base_url() . "admin/promocodes/";
      $this->load->library('pagination');
      $config["base_url"] = $baseurl;
      $config['per_page'] = 10;
      $config['enable_query_strings'] = true;
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->promocode_model->getpromocount($search_promos,$search_status);
      $this->template->title('Promocodes Manager');
      $this->pagination->initialize($config);
      $this->template->set("promocodes", $this->promocode_model->getItems($promoid,$config['per_page'],$start,$search_promos,$search_status));
	  $this->template->set("countpromo", $this->promocode_model->getcountpromo());
	  $this->template->build('admin/promocodes/list');
    }
    function create()
	{
	   $this->template->append_metadata(block_submit_button());
       $this->template->set('title', 'Promo Codes');
	   $this->template->set('updType', 'create');
       $this->load->helper('form');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('title', 'title', 'required');
	   $this->form_validation->set_rules('code', 'code', 'required|alpha_numeric');
	   $this->form_validation->set_rules('discount', 'discount', 'required|integer');
	   $this->form_validation->set_rules('codelimit', 'codelimit', 'greater_than[0]');


	   if ($this->form_validation->run() === FALSE)
	   {
		   $this->template->build('admin/promocodes/create');
	   }
	   else
	   {
           $data = array(
			'title' => $this->input->post('title'),
			'code' => $this->input->post('code'),
			'codelimit' => $this->input->post('codelimit'),
			'discount' => $this->input->post('discount'),
			'typediscount' => $this->input->post('typediscount'),
            'codestart' => $this->input->post('codestart'),
            'codeend' => $this->input->post('codeend'),
            'forexisting' => $this->input->post('forexisting'),
            'published' => $this->input->post('published')
		);
           $this->promocode_model->insertItems($data);
    	   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
    	   redirect('admin/promocodes/');
		}

	}
    function edit($id = FALSE)
	{
	   $this->template->append_metadata(block_submit_button());
       $id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);
	   $id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
       $this->template->set("promocodes", $this->promocode_model->getItems($id));
       $this->template->set('title', 'Promo Codes');
	   $this->template->set('updType', 'edit');
       $this->template->set('id', $id);
       if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/promocodes/edit/'.$id);
       }
       $this->load->helper('form');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('title', 'title', 'required');
       $this->form_validation->set_rules('code', 'code', 'required|alpha_numeric');
	   $this->form_validation->set_rules('discount', 'discount', 'required|integer');
	   $this->form_validation->set_rules('codelimit', 'codelimit', 'greater_than[0]');
	   if ($this->form_validation->run() === FALSE)
	   {
		    $this->template->build('admin/promocodes/create');
	   }
	   else
	   {
            $data = array(
			'title' => $this->input->post('title'),
			'code' => $this->input->post('code'),
			'codelimit' => $this->input->post('codelimit'),
			'discount' => $this->input->post('discount'),
			'typediscount' => $this->input->post('typediscount'),
            'codestart' => $this->input->post('codestart'),
            'codeend' => $this->input->post('codeend'),
            'forexisting' => $this->input->post('forexisting'),
            'published' => $this->input->post('published')
		);
           $isupdated = $this->promocode_model->updateItem($id,$data);
           	if ($isupdated) // the information has therefore been successfully saved in the db
			{
        	   $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
        	   redirect('admin/promocodes/');
               }else{
               $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_failed') ) );
    		   redirect('admin/promocodes/');
           }
		}

	}
    function delete($id = NULL)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/promocodes/');
		}
		$isdelete=$this->promocode_model->deleteItem($id);
		if ($isdelete)
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}
	       redirect('admin/promocodes');
	}
    public function publish($pid = FALSE){
      $pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
      if (!$pid){
          $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
          redirect('admin/promocodes/');
      }
      else{
          $upd_data = array(
          'published' => 1
          );
          $in_ids = $pid;
          $publish=$this->promocode_model->publish_unpublishItem($in_ids,$upd_data);

          //Publish the item
          if ($publish)
          {
            $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'promocodes published successfully!' ));
          }
          else
          {
            $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'promocodes publish action fail or already published!' ) );
          }
          redirect('admin/promocodes');
      }
    }

    public function unpublish($pid = FALSE){
      $pid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
      if (!$pid){
          $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
          redirect('admin/promocodes/');
      }
      else{
          $upd_data = array(
          'published' => 0
          );
          $in_ids = $pid;
          $unpublish=$this->promocode_model->publish_unpublishItem($in_ids,$upd_data);

          //Publish the item
          if ($unpublish)
          {
          $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'promocode unpublished successfully!' ));
          }
          else
          {
          $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'promocode unpublish action fail or already unpublished!' ) );
          }
          redirect('admin/promocodes');

      }
    }
}