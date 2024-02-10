<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sociallinks extends MLMS_Controller {

	function __construct()
	{
		  parent::__construct();
      $this->authenticate();
      $this->load->helper('form');
      $this->load->library('form_validation');						
      $this->lang->load('tooltip', 'english');
      $this->load->model('admin/settings_model');

        $configarr = $this->settings_model->getItems(); 
        date_default_timezone_set($configarr[0]['time_zone']);
  }

  public function index()
	{		 
     $this->template->set_layout('backend');
     $this->template->set('action',"listlinks");
     $this->template->build('admin/sociallinks/create');
  }


     public function createLink()
     {
       $this->template->set_layout('backend');
       $this->template->set('action',"createlink");
       $allsociallinks=$this->settings_model->getSocialLinks();
       $this->template->set('allsociallinks',$allsociallinks);



       //echo "<pre>";
       //print_r($allsociallinks);
       //echo "</pre>";


       $furl=$this->input->post('furl');
       $turl=$this->input->post('turl');
       $gplusurl=$this->input->post('gplusurl');
       $rssfeedurl=$this->input->post('rssfeedurl');
       $yturl=$this->input->post('yturl');



       //$this->form_validation->set_rules('heading', 'Site Name', 'required');
       $this->form_validation->set_rules('furl', 'Facebook URL', 'required');

       if ($this->form_validation->run() == FALSE)
	   {
	        $this->template->build('admin/sociallinks/create');
	   }
       else
       {
       //      	$dataarr = array(
    			// 	array('sitename' => 'Facebook',
    			// 	'siteurl' => addslashes($furl)),
       //              array('sitename' => 'Twitter',
    			// 	'siteurl' => addslashes($turl)),
       //              array('sitename' => 'Linkedin',
    			// 	'siteurl' => addslashes($gplusurl)),
       //              array('sitename' => 'Google Plus',
    			// 	'siteurl' => addslashes($rssfeedurl)),
       //              array('sitename' => 'You Tube',
    			// 	'siteurl' => addslashes($yturl))
    			// );

            $dataarr = array(
            array('sitename' => 'Facebook',
            'siteurl' => addslashes($furl)),
                    array('sitename' => 'Twitter',
            'siteurl' => addslashes($turl)),
                    array('sitename' => 'Linkedin',
            'siteurl' => addslashes($gplusurl)),                    
                    array('sitename' => 'You Tube',
            'siteurl' => addslashes($yturl))
          );
                $sociallinkarr=json_encode($dataarr);

                $form_data = array(
    				'socialbuttons' => $sociallinkarr
    			);

                $isupdated = $this->settings_model->updateItem($form_data);
                $social_data =  array(
          'social_icon' => $this->input->post('social_icons'),
          
        );
        $socialTable = 'mlms_socialstatus';
        $socialstatus = $this->settings_model->updateProgressPopup($social_data,$socialTable);

                if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/sociallinks/createLink/');
				}else{
			   		redirect('admin/sociallinks/createLink/');
				}
       }


     }

}
?>