<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate();
        $this->load->helper('url');
       	$this->load->helper('pages');
		$this->load->helper('form');
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->model('admin/settings_model');
		$this->template->set_layout('backend');
        $this->load->library('ckeditor');		
		$this->lang->load('tooltip', 'english');
        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';
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


    function general_tab()
    {
    	$this->load->view('admin/settings/general_tab');
    }

    public function sociallg()
    {
    			   	$this->load->view('admin/settings/sociallogins');

    }

  	function sociallogins()
	{
		
		$this->load->config('oauth2', TRUE);	// fetch social variables (facebook,google id,secreatekey)	
		//$this->config->item('facebook_id', 'oauth2');		
		
		$this->load->config('hybridauthlib', TRUE);
		
		$hybridauth = $this->config->item('providers', 'hybridauthlib');	
		
		$facebook_appid = $hybridauth['Facebook']['keys']['id'];
		$facebook_appsecrect = $hybridauth['Facebook']['keys']['secret'];
		
		$this->template->append_metadata(block_submit_button());
		$this->_set_rules('edit');
		$this->template->title("Social Logins");
		$this->template->set('title', "Social Logins");
		$this->template->set('updType', 'save');
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
		 $socialloginarray = json_decode($sociallogin);
		 //echo '<pre>';
		 //print_r($socialloginarray);
        $this->template->set('id', $id);
		$this->template->set('sociallogins', $socialloginarray);
		//$this->template->set('secreatekey', $content_selling);
        //$this->form_validation->set_rules('fbappid', 'Facebook App Id', 'required');
        //$this->form_validation->set_rules('fbsecreatekey', 'Facebook Secret Key', 'required');
        //$this->form_validation->set_rules('googleappid', 'Google Client Id', 'required');
        //$this->form_validation->set_rules('googlesecreatekey', 'Google Client Secret Key', 'required');
        
        //$this->form_validation->set_rules('id', 'id', 'required');

		//if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		if(!$this->input->post('submit'))
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/sociallogins');
		}
		else
			{
				
			$socialloginarray = array(
					'facebook'=>array('appid'=>$this->input->post('fbappid'),'appsecretkey'=>$this->input->post('fbsecreatekey')),'googleplus'=>array('clientid'=>$this->input->post('googleappid'),'clientsecreatekey'=>$this->input->post('googlesecreatekey'))
				);
			
			
				$form_data =  array(
					'sociallogin' => json_encode($socialloginarray)
				);
				//print_r($form_data);exit;

				$isupdated = $this->settings_model->updateItem($form_data);

				$social_data =  array(
					'social_login' => $this->input->post('social_data'),
					
				);
				$socialTable = 'mlms_socialstatus';
				$socialstatus = $this->settings_model->updateProgressPopup($social_data,$socialTable);
				//echo $socialstatus;

				if ($isupdated) // the information has therefore been successfully saved in the db
				{
					    $files[] = 'application/config/oauth2.php';

						$files[] = 'application/config/hybridauthlib.php';
						
						foreach($files as $file){
							if($file == 'application/config/oauth2.php'){
		 
						//$str_to_find1[] = $this->config->item('facebook_id', 'oauth2');
						//$str_to_find1[] =  $this->config->item('facebook_secret', 'oauth2');
						
						$str_to_find1[] =  $this->config->item('google_id', 'oauth2');
						$str_to_find1[] =  $this->config->item('google_secret', 'oauth2');
					

						//$str_to_change1[] = $this->input->post('fbappid');
						//$str_to_change1[] = $this->input->post('fbsecreatekey');
						
						$str_to_change1[] = $this->input->post('googleappid');
						$str_to_change1[] = $this->input->post('googlesecreatekey');
						

	
	                    $path =  'application/config/oauth2.php';
						

	                    $this->check_files($path,$str_to_find1,$str_to_change1);
					   }
					   if($file == 'application/config/hybridauthlib.php'){
		 
						$str_to_find1[] = $facebook_appid;
						$str_to_find1[] =  $facebook_appsecrect;
						
						//$str_to_find1[] =  $this->config->item('google_id', 'oauth2');
						//$str_to_find1[] =  $this->config->item('google_secret', 'oauth2');
					

						$str_to_change1[] = $this->input->post('fbappid');
						$str_to_change1[] = $this->input->post('fbsecreatekey');
						
						//$str_to_change1[] = $this->input->post('googleappid');
						//$str_to_change1[] = $this->input->post('googlesecreatekey');
						

	
	                    $path =  'application/config/hybridauthlib.php';
						

	                    $this->check_files($path,$str_to_find1,$str_to_change1);
					   }
					}
					echo lang('web_edit_success');
				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// 					// redirect('admin/social-logins/settings');

				// 	redirect('admin/settings');
				}else{
					echo lang('web_edit_fail');
					// redirect('admin/settings');
				}
			}
        }
		
		function social_post() {

		// 	$result = $this->settings_model->getItems();
  //       //print_r($result);
		// extract($result[0]);
		//  $socialloginarray = json_decode($sociallogin);
			$socialloginarray = array(
					'facebook'=>array('appid'=>$this->input->post('fbappid'),'appsecretkey'=>$this->input->post('fbsecreatekey')),'googleplus'=>array('clientid'=>$this->input->post('googleappid'),'clientsecreatekey'=>$this->input->post('googlesecreatekey'))
				);
			
			
				$form_data =  array(
					'sociallogin' => json_encode($socialloginarray)
				);
				//print_r($form_data);exit;

				$isupdated = $this->settings_model->updateItem($form_data);

				$social_data =  array(
					'social_login' => $this->input->post('social_data'),
					
				);
				$socialTable = 'mlms_socialstatus';
				$socialstatus = $this->settings_model->updateProgressPopup($social_data,$socialTable);
				//echo $socialstatus;

				if ($isupdated) // the information has therefore been successfully saved in the db
				{
					    $files[] = 'application/config/oauth2.php';

						$files[] = 'application/config/hybridauthlib.php';
						
						foreach($files as $file){
							if($file == 'application/config/oauth2.php'){
		 
						//$str_to_find1[] = $this->config->item('facebook_id', 'oauth2');
						//$str_to_find1[] =  $this->config->item('facebook_secret', 'oauth2');
						
						$str_to_find1[] =  $this->config->item('google_id', 'oauth2');
						$str_to_find1[] =  $this->config->item('google_secret', 'oauth2');
					

						//$str_to_change1[] = $this->input->post('fbappid');
						//$str_to_change1[] = $this->input->post('fbsecreatekey');
						
						$str_to_change1[] = $this->input->post('googleappid');
						$str_to_change1[] = $this->input->post('googlesecreatekey');
						

	
	                    $path =  'application/config/oauth2.php';
						

	                    $this->check_files($path,$str_to_find1,$str_to_change1);
					   }
					   if($file == 'application/config/hybridauthlib.php'){
		 
						$str_to_find1[] = $facebook_appid;
						$str_to_find1[] =  $facebook_appsecrect;
						
						//$str_to_find1[] =  $this->config->item('google_id', 'oauth2');
						//$str_to_find1[] =  $this->config->item('google_secret', 'oauth2');
					

						$str_to_change1[] = $this->input->post('fbappid');
						$str_to_change1[] = $this->input->post('fbsecreatekey');
						
						//$str_to_change1[] = $this->input->post('googleappid');
						//$str_to_change1[] = $this->input->post('googlesecreatekey');
						

	
	                    $path =  'application/config/hybridauthlib.php';
						

	                    $this->check_files($path,$str_to_find1,$str_to_change1);
					   }
					}
					echo lang('web_edit_success');
				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// 					// redirect('admin/social-logins/settings');

				// 	redirect('admin/settings');
				}else{
					echo lang('web_edit_fail');
					// redirect('admin/settings');
				}
			
		}
		
		function check_files($this_file,$str_to_find,$str_to_change)

			{

			 if(!($content = file_get_contents($this_file)))

				   { //echo("<p>Could not check $this_file You should check the contents manually!</p>\n"); 

				   }

				else

					{

					   $in = 0;

					   while(list(,$value)=each($str_to_find))

						   {

							 if (stripos($content, $value) !== false)

								 {

									$strtochange = $str_to_change[$in];

									$strtofind = $str_to_find[$in];

									//echo '<br>';

									$content = str_replace($strtofind,$strtochange,$content);

									file_put_contents($this_file,$content);

									$in++;

								  }

							 }

						

						}

				unset($content);

			}
          

	    function layouts()
		{

		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Layout Settings");
		$this->template->set('title', "Layout Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
		//print_r($result);
		extract($result[0]);
		//echo '<pre>';
		//print_r(json_decode($ctgspage));
		//echo '</pre>';
		
		//$ctgpagestring = json_encode(json_decode($ctgpage));
		$this->template->set('ctgpage', json_decode($ctgpage));
		$this->template->set('st_ctgpage', json_decode($st_ctgpage));
		$this->template->set('ctgspage', json_decode($ctgspage));
		$this->template->set('st_ctgspage', json_decode($st_ctgspage));
		$this->template->set('psgspage', json_decode($psgspage));
		$this->template->set('st_psgspage', json_decode($st_psgspage));
		$this->template->set('psgpage', json_decode($psgpage));
		$this->template->set('st_psgpage', json_decode($st_psgpage));
		$this->template->set('authorspage', json_decode($authorspage));
		$this->template->set('st_authorspage', json_decode($st_authorspage));
		$this->template->set('authorpage', json_decode($authorpage));
		$this->template->set('st_authorpage', json_decode($st_authorpage));
		$this->template->set('alllayouts',$this->settings_model->getallLayouts());
		$this->template->set('settings',$this->settings_model->getItems());
		//$this->template->set('currencies',$this->settings_model->getCurrencies());
		$this->form_validation->set_rules('ctg_image_alignment', 'ctg_image_alignment', 'required');
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/settings/layouts');
		}
		else
		{

			$this->upload_image();		
		       
			$imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');
			
			
                $logoimage = $imagename;
               $layouttemplate = 'classic';	//  $layouttemplate = $this->input->post('layouttemplate');	
                 $layoutstyle = $layouttheme = $this->input->post('layouttheme');
                 $ctgpagearray= (object) array(
					/*'ctg_image_size' => $this->input->post('ctg_image_size'),
					'ctg_image_size_type' => $this->input->post('ctg_image_size_type'),*/
					'ctg_image_alignment' => $this->input->post('ctg_image_alignment'),
					/*'ctg_wrap_image' => $this->input->post('ctg_wrap_image'),
					'ctg_description_length' => $this->input->post('ctg_description_length'),
					'ctg_description_type' => $this->input->post('ctg_description_type'),
					'ctg_description_alignment' => $this->input->post('ctg_description_alignment'),*/
				);
				$ctgspagearray= (object) array(
					/*'ctgslayout' => $this->input->post('ctgslayout'),
					'ctgscols' => $this->input->post('ctgscols'),
					'ctgs_image_size' => $this->input->post('ctgs_image_size'),
					'ctgs_image_size_type' => $this->input->post('ctgs_image_size_type'),*/
					'ctgs_image_alignment' => $this->input->post('ctgs_image_alignment'),
					/*'ctgs_wrap_image' => $this->input->post('ctgs_wrap_image'),
					'ctgs_description_length' => $this->input->post('ctgs_description_length'),
					'ctgs_description_type' => $this->input->post('ctgs_description_type'),
					'ctgs_description_alignment' => $this->input->post('ctgs_description_alignment'),
					'ctgs_read_more' => $this->input->post('ctgs_read_more'),
					'ctgs_read_more_align' => $this->input->post('ctgs_read_more_align'),
					'ctgs_show_empty_catgs' => $this->input->post('ctgs_show_empty_catgs')*/
				);
                $psgspagearray= (object) array(
					/*'courseslayout' => $this->input->post('courseslayout'),
					'coursescols' => $this->input->post('coursescols'),
					'courses_image_size' => $this->input->post('courses_image_size'),
					'courses_image_size_type' => $this->input->post('courses_image_size_type'),*/
					'courses_image_alignment' => $this->input->post('courses_image_alignment'),
					/*'courses_wrap_image' => $this->input->post('courses_wrap_image'),
					'courses_description_length' => $this->input->post('courses_description_length'),
					'courses_description_type' => $this->input->post('courses_description_type'),
					'courses_description_alignment' => $this->input->post('courses_description_alignment'),
					'courses_read_more' => $this->input->post('courses_read_more'),
					'courses_read_more_align' => $this->input->post('courses_read_more_align')*/
				);
                $psgpagearray= (object) array(
					/*'course_image_size' => $this->input->post('course_image_size'),
					'course_image_size_type' => $this->input->post('course_image_size_type'),*/
					'course_image_alignment' => $this->input->post('course_image_alignment'),
					/*'course_wrap_image' => $this->input->post('course_wrap_image'),
					'course_author_name_show' => $this->input->post('course_author_name_show'),
					'course_released_date' => $this->input->post('course_released_date'),
					'course_level' => $this->input->post('course_level'),
					'course_price' => $this->input->post('course_price'),
					'course_price_type' => $this->input->post('course_price_type'),
					'course_table_contents' => $this->input->post('course_table_contents'),
					'course_description_show' => $this->input->post('course_description_show'),
					'course_tab_price' => $this->input->post('course_tab_price'),
					'course_author' => $this->input->post('course_author'),
					'course_requirements' => $this->input->post('course_requirements'),
					'course_buy_button' => $this->input->post('course_buy_button'),
					'course_buy_button_location' => $this->input->post('course_buy_button_location'),
					'show_course_image' => $this->input->post('show_course_image'),
					'show_all_cloase_all' => $this->input->post('show_all_cloase_all')*/
				);
                $authorspagearray= (object) array(
					'banner_title' => $this->input->post('banner_title'),
					'banner_desc' => $this->input->post('banner_desc'),
					'banner_image' => $this->input->post('bannerimagename')
					/*'authors_image_size_type' => $this->input->post('authors_image_size_type'),
					'authors_image_alignment' => $this->input->post('authors_image_alignment'),
					'authors_wrap_image' => $this->input->post('authors_wrap_image'),
					'authors_description_length' => $this->input->post('authors_description_length'),
					'authors_description_type' => $this->input->post('authors_description_type'),
					'authors_description_alignment' => $this->input->post('authors_description_alignment'),
					'authors_read_more' => $this->input->post('authors_read_more'),
					'authors_read_more_align' => $this->input->post('authors_read_more_align')*/
				);
                $authorpagearray= (object) array(
					/*'author_image_size' => $this->input->post('author_image_size'),
					'author_image_size_type' => $this->input->post('author_image_size_type'),
					'author_image_alignment' => $this->input->post('author_image_alignment'),
					'author_wrap_image' => $this->input->post('author_wrap_image'),
					'author_description_length' => $this->input->post('author_description_length'),
					'author_description_type' => $this->input->post('author_description_type'),
					'author_description_alignment' => $this->input->post('author_description_alignment') */                  	);

				$ctgpagestring = json_encode($ctgpagearray);
				$ctgspagestring = json_encode($ctgspagearray);
				$psgspagearray = json_encode($psgspagearray);
				$psgpagearray = json_encode($psgpagearray);
				$authorspagearray = json_encode($authorspagearray);
				$authorpagearray = json_encode($authorpagearray);
					$form_data =  array(
					'ctgpage' => $ctgpagestring,
					'ctgspage' => $ctgspagestring,
					'psgspage' => $psgspagearray,
					'psgpage' => $psgpagearray,
					'authorspage' => $authorspagearray,
					'authorpage' => $authorpagearray,
					'logoimage' => $logoimage,					
					'layouttheme' => $layoutstyle,										
					'layout_template' => $layouttemplate,
					'meta_title' =>$this->input->post('meta_title'),
					'meta_desc' =>$this->input->post('meta_desc'),
					'meta_keyword' =>$this->input->post('meta_keyword')
					);


				//print_r($form_data);
				//exit;
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/layouts');
				}else{
			   		redirect('admin/settings/layouts');
				}
			}
		}

        function styles()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
		extract($result[0]);
		//echo '<pre>';
		//print_r(json_decode($st_ctgspage));
        $this->template->set('st_ctgspage', json_decode($st_ctgspage));
        $this->template->set('st_ctgpage', json_decode($st_ctgpage));
        $this->template->set('st_psgspage', json_decode($st_psgspage));
        $this->template->set('st_psgpage', json_decode($st_psgpage));
        $this->template->set('st_authorspage', json_decode($st_authorspage));
        $this->template->set('st_authorpage', json_decode($st_authorpage));

        $this->template->set('settings',$this->settings_model->getItems());
        $this->form_validation->set_rules('ctgs_page_title', 'ctgs_page_title', 'required');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('admin/settings/styles');
		}
		else
			{
				$ctgpagearray= (object) array(
					'ctgs_page_title' => $this->input->post('ctgs_page_title'),
					'ctgs_categ_name' => $this->input->post('ctgs_categ_name'),
					'ctgs_image' => $this->input->post('ctgs_image'),
					'ctgs_description' => $this->input->post('ctgs_description'),
					'ctgs_st_read_more' => $this->input->post('ctgs_st_read_more'),
				);
                $ctgspagearray= (object) array(
					'ctg_name' => $this->input->post('ctg_name'),
					'ctg_image' => $this->input->post('ctg_image'),
					'ctg_description' => $this->input->post('ctg_description'),
					'ctg_sub_title' => $this->input->post('ctg_sub_title')
                );
                $stpsgspagearray= (object) array(
					'courses_page_title' => $this->input->post('courses_page_title'),
					'courses_name' => $this->input->post('courses_name'),
					'courses_image' => $this->input->post('courses_image'),
					'courses_description' => $this->input->post('courses_description'),
					'courses_st_read_more' => $this->input->post('courses_st_read_more'),
                );
                $stpsgpagearray= (object) array(
					'course_name' => $this->input->post('course_name'),
					'course_image' => $this->input->post('course_image'),
					'course_top_field_name' => $this->input->post('course_top_field_name'),
					'course_top_field_value' => $this->input->post('course_top_field_value'),
					'course_tabs_module_name' => $this->input->post('course_tabs_module_name'),
					'course_tabs_step_name' => $this->input->post('course_tabs_step_name'),
					'course_description' => $this->input->post('course_description'),
					'course_price_field_name' => $this->input->post('course_price_field_name'),
					'course_price_field_value' => $this->input->post('course_price_field_value'),
					'course_author_name' => $this->input->post('course_author_name'),
					'course_author_bio' => $this->input->post('course_author_bio'),
					'course_author_image' => $this->input->post('course_author_image'),
					'course_req_field_name' => $this->input->post('course_req_field_name'),
					'course_req_field_value' => $this->input->post('course_req_field_value'),
					'course_other_button' => $this->input->post('course_other_button'),
					'course_other_background' => $this->input->post('course_other_background'),
                );
                 $stauthorspagearray= (object) array(
					'authors_page_title' => $this->input->post('authors_page_title'),
					'authors_name' => $this->input->post('authors_name'),
					'authors_image' => $this->input->post('authors_image'),
					'authors_description' => $this->input->post('authors_description'),
					'authors_st_read_more' => $this->input->post('authors_st_read_more'),
                );
                 $stauthorpagearray= (object) array(
					'author_name' => $this->input->post('author_name'),
					'author_image' => $this->input->post('author_image'),
					'author_description' => $this->input->post('author_description'),
					'author_st_read_more' => $this->input->post('author_st_read_more'),
                );

                $ctgpagestring = json_encode($ctgpagearray);
                $ctgspagearray = json_encode($ctgspagearray);
                $stpsgspagearray = json_encode($stpsgspagearray);
                $stpsgpagearray = json_encode($stpsgpagearray);
                $stauthorspagearray = json_encode($stauthorspagearray);
                $stauthorpagearray = json_encode($stauthorpagearray);
			  //	$ctgspagestring = json_encode($ctgspagearray);
					$form_data =  array(
					'st_ctgspage' => $ctgpagestring,
				    'st_ctgpage' => $ctgspagearray,
				    'st_psgspage' => $stpsgspagearray,
				    'st_psgpage' => $stpsgpagearray,
				    'st_authorspage' => $stauthorspagearray,
				    'st_authorpage' => $stauthorpagearray,
					);
                  // print_r($form_data);exit;
                 $isupdated = $this->settings_model->updateItem($form_data);
                 if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/styles');
				}else{
			   		redirect('admin/settings/styles');
				}
			}

        }
       function progressbar()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('st_donecolor', $st_donecolor);
		$this->template->set('st_notdonecolor', $st_notdonecolor);
		$this->template->set('st_txtcolor', $st_txtcolor);
		$this->template->set('st_width', $st_width);
		$this->template->set('st_height', $st_height);
		$this->template->set('progress_bar', $progress_bar);
        //$this->template->build('admin/settings/progress_bar');
        $this->form_validation->set_rules('st_donecolor', 'st_donecolor', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/progress_bar');
		}
		else
			{
				$form_data =  array(
					'st_donecolor' => $this->input->post('st_donecolor'),
					'st_notdonecolor' => $this->input->post('st_notdonecolor'),
					'st_txtcolor' => $this->input->post('st_txtcolor'),
					'st_width' => $this->input->post('st_width'),
					'st_height' => $this->input->post('st_height'),
					'progress_bar' => $this->input->post('progress_bar'),
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/progressbar');
				}else{
					redirect('admin/settings/progressbar');
				}
			}



    	//echo '<pre>';
		//print_r(json_decode($ctgspage));
		//echo '</pre>';
        }
        function emailsetting()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Email Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
		$this->template->set('signature', $signature);

        $this->form_validation->set_rules('fromname', 'fromname', 'required');
        // $this->form_validation->set_rules('signaturetxt', 'signature', 'required');
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/email_setting');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail'),
					'signature' =>$this->input->post('signaturetxt')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
					echo lang('web_edit_success');
					  		    	echo "Successfully Updated!";

				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// 	redirect('admin/settings');
					// redirect('admin/email/settings');
				}else{
					echo lang('web_edit_fail');
					// redirect('admin/settings');
				}
			}
        
        }

        function email_post(){
        	$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail'),
					'signature' =>$this->input->post('signaturetxt')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
					// echo lang('web_edit_success');
					  		    	echo "Successfully Updated!";

				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// 	redirect('admin/settings');
					// redirect('admin/email/settings');
				}else{
					echo lang('web_edit_fail');
					// redirect('admin/settings');
				}
        }
        
        function promotionbox()
		{
		$this->template->append_metadata(block_submit_button());
		$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		$result = $this->settings_model->getItems();
       // print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('content_selling', $content_selling);
        $this->form_validation->set_rules('content_selling', 'content_selling ', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/promotion_box');
		}
		else
			{
				$form_data =  array(
					'content_selling ' => $this->input->post('content_selling')
				);

				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/promotionbox');
				}else{
					redirect('admin/settings/promotionbox');
				}
			}
        }
        function quizcountdown()
		{
		$this->template->append_metadata(block_submit_button());
		$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		$result = $this->settings_model->getItems();
       // print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('qct_alignment', $qct_alignment);
		$this->template->set('qct_border_color', $qct_border_color);
		$this->template->set('qct_minsec', $qct_minsec);
		$this->template->set('qct_title_color', $qct_title_color);
		$this->template->set('qct_bg_color', $qct_bg_color);
	   //	$this->template->set('qct_title_color', $qct_title_color);
		$this->template->set('qct_font', $qct_font);
		$this->template->set('qct_width', $qct_width);
		$this->template->set('qct_height', $qct_height);
		$this->template->set('qct_font_nb', $qct_font_nb);
		$this->template->set('qct_font_words', $qct_font_words);
		$this->template->set('currencypos', $currencypos);
        $this->form_validation->set_rules('timer_alignement', 'timer_alignement ', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/quiz_countdown');
		}
		else
			{
				$form_data =  array(
					'qct_alignment ' => $this->input->post('timer_alignement'),
					'qct_border_color ' => $this->input->post('st_donecolor'),
					'qct_minsec ' => $this->input->post('st_notdonecolor'),
					'qct_title_color ' => $this->input->post('st_txtcolor'),
					'qct_bg_color ' => $this->input->post('st_xdonecolor'),
					//'qct_title_color ' => $this->input->post('content_selling ')
					'qct_font ' => $this->input->post('font'),
					'qct_width ' => $this->input->post('st_width'),
					'qct_height ' => $this->input->post('st_height'),
					'qct_font_nb ' => $this->input->post('fontnb'),
					'qct_font_words ' => $this->input->post('fontwords'),
					'currencypos ' => $this->input->post('content_selling '),
				);
               // print_r($form_data); exit;
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/quizcountdown');
				}else{
					redirect('admin/settings/quizcountdown');
				}
			}
        }
		
		function account()
		{
		$this->template->append_metadata(block_submit_button());
		$this->template->title("Payment Settings");
		$this->template->set('title', "Payment Account");
		$this->template->set('updType', 'save');
		$currency = NULL;
		$this->template->set('currency', $currency);
		$this->template->set('currencies',$this->settings_model->getCurrencies());
		$this->template->set('pay_setting',$this->settings_model->getAccountMode());
		
    	$this->form_validation->set_rules('paypal_bsns_email', 'paypal_bsns_email ', 'required');
        //$this->form_validation->set_rules('api_username', 'api_username ', 'required');
        //$this->form_validation->set_rules('api_password', 'api_password ', 'required');
        //$this->form_validation->set_rules('api_signature', 'api_signature ', 'required');
        // $this->form_validation->set_rules('currency', 'currency ', 'required');
        
       

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//exit('yes');
			//load the view and the layout
		   	$this->template->build('admin/settings/account');
		}
		else
			{			 
			   
			   $this->upload_image();		
		       $imagename = ($_FILES['file_i']['name']) ? $_FILES['file_i']['name'] : $this->input->post('imagename');


			   
				$form_data =  array(
					//'api_username ' => $this->input->post('api_username'),
					//'api_password ' => $this->input->post('api_password'),
					//'api_signature ' => $this->input->post('api_signature'),
					// 'currency ' => $this->input->post('currency'),
					//'name ' => $this->input->post('name'),
					//'logo ' => $imagename,
					'status ' => $this->input->post('isLive'),
					'directinfo' =>$this->input->post('othertxt'),
					'directpay_status' => ($this->input->post('otherckb')) ? $this->input->post('otherckb') : '0',
					'paypal_status' => ($this->input->post('paypalckb')) ? $this->input->post('paypalckb') : '0',

					//'bsns_status' => ($this->input->post('bsnsckb')) ? $this->input->post('bsnsckb') : '0',
					'paypal_bsns_email' => $this->input->post('paypal_bsns_email'),

				);
				
				
				$isupdated = $this->settings_model->updateAccount($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
					// echo lang('web_edit_success');
					echo "Successfully Updated!";
				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// 	redirect('admin/payment/settings');
				}else{
					echo lang('web_edit_fail');
					// redirect('admin/payment/settings');
				}
			}
        }
		
      public function certificates()
		{
		//   print_r($_POST);
		$this->template->append_metadata(block_submit_button());
        $this->load->model('admin/medias_model');
		$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
       //print_r($this->medias_model->fileslist('public/uploads/settings/img', 'image'));
        $this->template->set('ftpimage',$this->medias_model->fileslist('public/uploads/settings/img/thumbs', 'image'));
           //  print_r($image);
       foreach ($_FILES as $index => $value)
			{
           // print_r($value['name']);
               	if ($value['name'] != '')
				{

					$this->load->library('upload');
				  $this->upload->initialize($this->set_upload_options('settings'));
                    //upload the image
					if ( ! $this->upload->do_upload($index))
					{
					  echo "test";
                    $this->template->set('upload_error', $this->upload->display_errors("<span class='error'>", "</span>"));
						//load the view and the layout
				   $this->template->build('admin/settings/certificates');

					return FALSE;
					}
					else
					{
						//create an array to send to image_lib library to create the thumbnail
						$info_upload = $this->upload->data();
                       // print_r($info_upload);
						//Save the name an array to save on BD before
						$form_data_aux[$index]		=	$info_upload["file_name"];
                       // print_r($form_data_aux[$index]); exit;
						//Load and initializing the imagelib library to create the thumbnail
						$this->load->library('image_lib');
					   	$this->image_lib->initialize($this->set_thumbnail_options($info_upload, 'settings'));

						//create the thumbnail
						if ( ! $this->image_lib->resize())
						{
							$this->template->set('upload_error',  $this->image_lib->display_errors("<span class='error'>", "</span>"));

							//load the view and the layout
							$this->template->build('admin/settings/certificates');

							return FALSE;
						}
					}

					}
				}
        $result = $this->settings_model->getCertificate();
        $this->medias_model->fileslist('public/uploads/audio', 'audio');
	    extract($result[0]);
        $this->template->set('id', $id);
        $this->template->set('design_background', $design_background);
        $this->template->set('design_background_color', $design_background_color);
        $this->template->set('design_text_color', $design_text_color);
        $this->template->set('font_certificate', $font_certificate);
        $this->form_validation->set_rules('st_donecolor2', 'st_donecolor2 ', 'required');
        if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/certificates');
		}
		else
			{
            $form_data = array(
			'design_background' => $this->input->post('imagename'),
			'design_background_color' => $this->input->post('st_donecolor1'),
			'design_text_color' => $this->input->post('st_donecolor2'),
			'font_certificate' => $this->input->post('font')
			);
           //print_r($form_data);
           $isupdated=$this->settings_model->updateAccount($form_data);
           if ($isupdated) // the information has therefore been successfully saved in the db
  		    {
  		     redirect('admin/settings/certificates');
            }else{

			 redirect('admin/settings/certificates');
			}
           }
        }
		
    public function upload_image()
	{
	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file_i';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/settings/img/logo';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['orig_name'];
          $ftpfiles_i = $_FILES['orig_name'];
	      //print_r($config);
		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
            ///$ftpfiles_i = $this->medias_model->fileslist('public/uploads/images', 'image');
			 $file_id = true;
            $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	   json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	}
	
        function index()
		{
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
				
		//$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//print_r($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
		extract($result[0]);
		$this->template->set('id', $id);
		$this->template->set('currency', $currency);
		$this->template->set('datetype', $datetype);
		$this->template->set('dificulty', $dificulty);
		$this->template->set('influence', $influence);
		$this->template->set('display_tasks', $display_tasks);
		$this->template->set('groupe_tasks', $groupe_tasks);
		$this->template->set('display_media', $display_media);
		$this->template->set('show_unpubl', $show_unpubl);
		$this->template->set('btnback', $btnback);
		$this->template->set('btnhome', $btnhome);
		$this->template->set('btnnext', $btnnext);
		$this->template->set('dofirst', $dofirst);
		$this->template->set('imagesin', $imagesin);
		$this->template->set('videoin', $videoin);
		$this->template->set('audioin', $audioin);
		$this->template->set('docsin', $docsin);
		$this->template->set('filesin', $filesin);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
		$this->template->set('regemail', $regemail);
		$this->template->set('orderemail', $orderemail);
		$this->template->set('video_display', $video_display);
		$this->template->set('audio_display', $audio_display);
		$this->template->set('content_selling', $content_selling);
		$this->template->set('open_target', $open_target);
		$this->template->set('st_donecolor', $st_donecolor);
		$this->template->set('st_notdonecolor', $st_notdonecolor);
		$this->template->set('st_txtcolor', $st_txtcolor);
		$this->template->set('st_width', $st_width);
		$this->template->set('st_height', $st_height);
		$this->template->set('progress_bar', $progress_bar);
		$this->template->set('lesson_window_size', $lesson_window_size);
		$this->template->set('default_video_size', $default_video_size);
		$this->template->set('lesson_window_size_back', $lesson_window_size_back);
		$this->template->set('last_check_date', $last_check_date);
		$this->template->set('hour_format', $hour_format);
		$this->template->set('back_size_type', $back_size_type);
		$this->template->set('notification', $notification);
		$this->template->set('show_bradcrumbs', $show_bradcrumbs);
		$this->template->set('show_powerd', $show_powerd);
		$this->template->set('qct_alignment', $qct_alignment);
		$this->template->set('qct_border_color', $qct_border_color);
		$this->template->set('qct_minsec', $qct_minsec);
		$this->template->set('qct_title_color', $qct_title_color);
		$this->template->set('qct_bg_color', $qct_bg_color);
		$this->template->set('qct_font', $qct_font);
		$this->template->set('qct_width', $qct_width);
		$this->template->set('qct_height', $qct_height);
		$this->template->set('qct_font_nb', $qct_font_nb);
		$this->template->set('qct_font_words', $qct_font_words);
		$this->template->set('currencypos', $currencypos);
		$this->template->set('course_lesson_release', $course_lesson_release);
		$this->template->set('student_group', $student_group);
		
		//$this->template->set('parent_id',$parent_id);
		$this->template->set('settings',$this->settings_model->getItems());
		$this->template->set('currencies',$this->settings_model->getCurrencies());
		$this->form_validation->set_rules('currency', 'currency', 'required');
		$sbtn = $this->input->get('submit', TRUE);
		//if($this->form_validation->run() == FALSE) // validation hasn't been passed		
		if(empty($sbtn))
		{
			// $this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
			//load the view and the layout
			$this->template->build('admin/settings/general');
		}
		else
		{
				$lesson_window_size_back = $this->input->post('lesson_window_size_back_width').'x'.$this->input->post('lesson_window_size_back_width');
				$lesson_window_size = $this->input->post('lesson_window_size_width').'x'.$this->input->post('lesson_window_size_height');
				$default_video_size = $this->input->post('default_video_size_width').'x'.$this->input->post('default_video_size_height');
				$form_data =  array(
					'currency' => $this->input->get('currency'),
					//'currencypos' => $this->input->post('currencypos'),
					'datetype' => $this->input->get('datetype'),					
					'hour_format' => $this->input->get('hour_format'),					
					// 'open_target' => $this->input->post('open_target'),					
					// 'back_size_type' => $this->input->post('back_size_type'),					
					// 'lesson_window_size_back' => $lesson_window_size_back,					
					// 'lesson_window_size' => $lesson_window_size,					
					// 'default_video_size' => $default_video_size,					
					// 'notification' => $this->input->post('notification'),					
					'show_bradcrumbs' => $this->input->get('show_bradcrumbs'),
					'time_zone' => $this->input->get('time_zone'),						
									
				);
				//print_r($form_data);
				$isupdated = $this->settings_model->updateItem($form_data);

				$form_data_account =  array(					
					'currency ' => $this->input->get('currency')
					              );

				$isupdatedAccount = $this->settings_model->updateAccount($form_data_account);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{	
					// echo lang('web_edit_success');
										echo "Successfully Updated!";

				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// 	redirect('admin/settings');
				}

				//if ($category->is_invalid())
				else{
					echo lang('web_edit_fail');
					//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
					// redirect('admin/settings');	
				}	
			}
		}

		function general_post()
		{
				$lesson_window_size_back = $this->input->post('lesson_window_size_back_width').'x'.$this->input->post('lesson_window_size_back_width');
				$lesson_window_size = $this->input->post('lesson_window_size_width').'x'.$this->input->post('lesson_window_size_height');
				$default_video_size = $this->input->post('default_video_size_width').'x'.$this->input->post('default_video_size_height');
				$form_data =  array(
					'currency' => $this->input->post('currency'),
					//'currencypos' => $this->input->post('currencypos'),
					'datetype' => $this->input->post('datetype'),					
					'hour_format' => $this->input->post('hour_format'),					
					// 'open_target' => $this->input->post('open_target'),					
					// 'back_size_type' => $this->input->post('back_size_type'),					
					// 'lesson_window_size_back' => $lesson_window_size_back,					
					// 'lesson_window_size' => $lesson_window_size,					
					// 'default_video_size' => $default_video_size,					
					// 'notification' => $this->input->post('notification'),					
					'show_bradcrumbs' => $this->input->post('show_bradcrumbs'),
					'time_zone' => $this->input->post('time_zone'),						
									
				);
				//print_r($form_data);
				$isupdated = $this->settings_model->updateItem($form_data);

				$form_data_account =  array(					
					'currency ' => $this->input->post('currency')
					              );

				$isupdatedAccount = $this->settings_model->updateAccount($form_data_account);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{	
					// echo lang('web_edit_success');
					echo "Successfully Updated!";
				// $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				// 	redirect('admin/settings');
				}

				//if ($category->is_invalid())
				else{
					echo lang('web_edit_fail');
					//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
					// redirect('admin/settings');	
				}	
			}
		
        function delete($id = NULL)
		{
			//filter & Sanitize $id
			$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

			//redirect if it´s no correct
			if (!$id){
				$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
				redirect('admin/settings/');
			}

			$isdelete=$this->settings_model->deleteItem($id);

			//delete the item
			if ($isdelete)
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
			}

				redirect('admin/settings');

		}
	 /*	function delete($id = NULL)
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
					'published' => 1
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
				redirect('admin/subplans/');		

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
					'published' => 0 
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
				redirect('admin/subplans');		
		
			}
		}  */
    private function set_upload_options($controller)
	{
		//upload an image options

		$config = array();
		$config['upload_path'] = base_url().'public/uploads/'.$controller.'/img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']	= TRUE;
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		//create controller upload folder if not exists
		if (!is_dir($config['upload_path']))
		{
			mkdir(base_url()."public/uploads/$controller/");
			mkdir($config['upload_path']);
			mkdir($config['upload_path']."thumbs/");
		}
      // print_r($config);
		return $config;
	}


	private function set_thumbnail_options($info_upload, $controller)
	{
		$config = array();
		$config['image_library'] = 'gd2';
		$config['source_image'] = FCPATH.'public/uploads/'.$controller.'/img/'.$info_upload["file_name"];
		$config['new_image'] = FCPATH.'public/uploads/'.$controller.'/img/thumbs/'.$info_upload["file_name"];
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['master_dim'] = 'width';
		$config['width'] = 100;
		$config['height'] = 100;
		$config['thumb_marker'] = '';

		return $config;
	}

	function takeBackup(){
	$this->load->library('zip');
	//$path = '/path/to/your/directory/';
	//$path = base_url();
	//$path = dirname(__FILE__);
	$path = 'http://192.168.1.13/lms/';

$this->zip->read_dir($path);

// Download the file to your desktop. Name it "my_backup.zip"
$this->zip->download('my_backup.zip'); 
	}

	public function upload_banner()
	{
	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'banner_image';
	   if (empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/uploads/settings/img';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['orig_name'];
          $ftpfiles_i = $_FILES['orig_name'];
	      //print_r($config);
		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
            ///$ftpfiles_i = $this->medias_model->fileslist('public/uploads/images', 'image');
			 $file_id = true;
            $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {
				$status = "success";
				$msg = "File successfully uploaded";
			 }
			 else
			 {
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			 }
		  }
         // echo $_FILES[$file_element_name];
		  @unlink($_FILES[$file_element_name]);
	   }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	   echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
	}
	function domain_pointing()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Domain Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
        $this->form_validation->set_rules('fromname', 'fromname', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/payment_details');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					// redirect('admin/settings/emailsetting');
					redirect('admin/settings');
				}else{
					redirect('admin/settings');
				}
			}
        
        }

        function manage_setup()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Academy Set up");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
        $this->form_validation->set_rules('fromname', 'fromname', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/manage_setup');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/emailsetting');
				}else{
					redirect('admin/settings/emailsetting');
				}
			}
        
        }
        function manage_design()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Academy Design");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
        $this->form_validation->set_rules('fromname', 'fromname', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/manage_design');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/emailsetting');
				}else{
					redirect('admin/settings/emailsetting');
				}
			}
        
        }

        function manage_support()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Support Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
        $this->form_validation->set_rules('fromname', 'fromname', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/manage_support');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/emailsetting');
				}else{
					redirect('admin/settings/emailsetting');
				}
			}
        
        }

        function create_page()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Create A Page");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
        $this->form_validation->set_rules('fromname', 'fromname', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/create_page');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/emailsetting');
				}else{
					redirect('admin/settings/emailsetting');
				}
			}
        
        }

        function create_blogs()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Create A Blog");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
        $this->form_validation->set_rules('fromname', 'fromname', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/create_blogs');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/emailsetting');
				}else{
					redirect('admin/settings/emailsetting');
				}
			}
        
        }

        public function block()
        {
        	$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("Create A Blog");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		$this->template->build('admin/settings/block');
        }

        public function getImage()
	{
	   error_reporting(0);
       $this->load->helper('directory');
	   $this->load->helper('file');
	   $status = "";
	   $msg = "";
	   $ftpfiles_i = array();
	   $file_element_name = 'file';
	   if(empty($_POST['type']))
	   {
		  $status = "error";
		  $status = "done";
		  $msg = "Please select a type";
	   }

	   if ($status != "error")
	   {
		  $config['upload_path'] = 'public/default/images';
		  $config['allowed_types'] = 'gif|jpg|png|jpeg';
		  $config['max_size']  = 1024 * 8;
		  $config['encrypt_name'] = TRUE;
		  $config['overwrite'] = TRUE;
		  $config['file_name'] = $_FILES['orig_name'];
          $ftpfiles_i = $_FILES['orig_name'];
		  $this->load->library('upload', $config);

		  if (!$this->upload->do_upload($file_element_name))
		  {
			 $status = 'error';
			 $msg = $this->upload->display_errors('', '');
		  }
		  else
		  {
            ///$ftpfiles_i = $this->medias_model->fileslist('public/uploads/images', 'image');
			 $file_id = true;
            $data = $this->upload->data();
			 $file_id = true;
			 //$file_id = $this->files_model->insert_file($data['file_name'], $_POST['title']);
			 if($file_id)
			 {    
                $status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = base_url().'public/default/images/'.$data['file_name'];
        		$config['new_image'] =  FCPATH.'public/default/images/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 251;
                $config['height'] = 142;

        		$config['thumb_marker'] = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $config['x_axis'] = '0';
				$config['y_axis'] = '0';

				//$this->image_lib->resize();
				// if ( ! $this->image_lib->crop())
				// {
				//    echo $this->image_lib->display_errors();
				// }	

                //$this->load->library('md_image');
                //$config = array();
                /*$this->load->library('upload', $config);
		        $source=FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
		        $width=250;
		        $height=140;
		        $size = getimagesize($source);
		        $resize_height=($size[1]*250)/$size[0];
		        $dest = FALSE;
	            $config['image_library'] = 'gd2';//imagemagik
	            //$config['source_image'] = 'assets/img/hotellist/'.$data1['hotel_pictures'];
	            $config['source_image'] = FCPATH.'public/uploads/programs/img/thumb_232_216/'.$data['file_name'];
	            $config['create_thumb'] = FALSE;
	            $config['maintain_ratio'] = TRUE;
	            $config['width']     = 250;
	            $config['height']   = $resize_height;
	            //$config['height']   = 141;
	            $config['quality']   = 75;
	            $config['encrypt_name'] = TRUE;
	            $config['remove_spaces'] = TRUE;
	            $img =$config['source_image'];
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();*/
			}
			else
			{
				unlink($data['full_path']);
				$status = "error";
				$msg = "Something went wrong when saving the file, please try again.";
			}
		}
        // echo $_FILES[$file_element_name];
		@unlink($_FILES[$file_element_name]);
	    }
	   //echo 'success';
	  // echo json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $ftpfiles_i));
	    echo json_encode(array('filelink' => $config['source_image']));
	}


function pdf()
{   

	$configarr = $this->settings_model->getItems(); 
    $tmpl = $configarr[0]['layout_template'];

    $this->load->helper('pdf_helper');
  
    $this->load->view('admin/certificates/pdfreport1');     
    //$this->template->build('admin/certificates/pdfreport1');
}

function addvaluessession()
{
	$data = array(
			'descript' => $_POST['t11'],
			'certibg' =>$_POST['t12']
			);
$this->session->set_userdata('certificatedata',$data);
$auth = $this->session->userdata('certificatedata');
print_r($auth);
return true;
}


function view_videos()
		{
		$this->template->append_metadata(block_submit_button());

		$this->_set_rules('edit');
		$this->template->title("General Settings");
		$this->template->set('title', "General Settings");
		$this->template->set('updType', 'save');
		//var_dump($this->settings_model->getItems());
		$result = $this->settings_model->getItems();
        //print_r($result);
		extract($result[0]);
        $this->template->set('id', $id);
		$this->template->set('fromname', $fromname);
		$this->template->set('fromemail', $fromemail);
        $this->form_validation->set_rules('fromname', 'fromname', 'required');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
		   	$this->template->build('admin/settings/view_videos');
		}
		else
			{
				$form_data =  array(
					'fromname' => $this->input->post('fromname'),
					'fromemail' => $this->input->post('fromemail')
				);
				$isupdated = $this->settings_model->updateItem($form_data);
				if ($isupdated) // the information has therefore been successfully saved in the db
				{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
					redirect('admin/settings/emailsetting');
				}else{
					redirect('admin/settings/emailsetting');
				}
			}
        
        }

        function help_to_manage_academy()
		{   	

				$this->template->append_metadata(block_submit_button());

				$this->_set_rules('edit');
				$this->template->title("General Settings");
				$this->template->set('title', "General Settings");
				$this->template->set('updType', 'save');
				//var_dump($this->settings_model->getItems());
				$result = $this->settings_model->getItems();
		        //print_r($result);
				extract($result[0]);
		        $this->template->set('id', $id);
				$this->template->set('fromname', $fromname);
				$this->template->set('fromemail', $fromemail);
		        $this->form_validation->set_rules('fromname', 'fromname', 'required');

				if ($this->form_validation->run() == FALSE) // validation hasn't been passed
				{
					//load the view and the layout
				   	$this->template->build('admin/settings/help_to_manage_academy');
				}
				else
					{
						$form_data =  array(
							'fromname' => $this->input->post('fromname'),
							'fromemail' => $this->input->post('fromemail')
						);
						$isupdated = $this->settings_model->updateItem($form_data);
						if ($isupdated) // the information has therefore been successfully saved in the db
						{
						$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
							redirect('admin/settings/emailsetting');
						}else{
							redirect('admin/settings/emailsetting');
						}
					}
        
        }	

        function manage_setup_new()
        {
        	$this->load->view('admin/settings/manage_setup_new');
        }
        function manage_design_new()
        {
        	$this->load->view('admin/settings/manage_design_new');
        }
        function create_blogs_new()
        {
        	$this->load->view('admin/settings/create_blogs_new');
        }
        function create_page_new()
        {
        	$this->load->view('admin/settings/create_page_new');
        }
        
        function support_team()
        { 
        	$this->load->model('login_model'); 
		  
		      	  // $this->form_validation->set_rules('name', 'name', 'required');
		          $this->form_validation->set_rules('email', 'email', 'required|valid_email');
		          $this->form_validation->set_rules('mailto', 'mailto', 'required');
		          $this->form_validation->set_rules('subject', 'subject', 'required');
		          $this->form_validation->set_rules('message', 'message', 'required');

					if ($this->form_validation->run() == FALSE) 
					{						
					   	$this->template->build('admin/settings/support_team');
					}
				  else
					{
						 $rs = $this->upload_attachment();						
						 $attach = json_decode($rs);						
						if($attach->ftpfilearray)
						{
							
					    $newFile  = FCPATH.'public/uploads/settings/img/logo/'.$attach->ftpfilearray;
						}	
				        $email = $this->input->post('email');
				        $mailto = $this->input->post('mailto');
				        $subject = $this->input->post('subject');
				        $message = $this->input->post('message');


				        $admininfo = $this->login_model->getadminInfo(4);
						$admin_email= $admininfo->email;

						// $urldomain = base_url();
						// $urldomain = str_replace('http://', '', $urldomain);
						// $urldomain = str_replace('/', '', $urldomain);
						// $urldomain = str_replace('www.', '', $urldomain);
						if($configarr[0]['fromemail'])  
        $urldomain = $configarr[0]['fromemail']; 
        else $urldomain = $this->config->item('urldomain');

						$fromemail= $urldomain;
						$configarr = $this->settings_model->getItems();
						$this->load->library('email');
						$subject1 = 'Support request raised from '.$configarr[0]['institute_name'];
						$toemail = "info@createonlineacademy.com";   //$admin_email;

						$content = '';
						$content .= '<p>Dear Admin,<br /><br />';
						$content .='We received an support request from '.base_url().'<br /><br />';
						$content .= 'Name : '.trim(ucfirst($admininfo->first_name)).'<br /><br />';
						$content .= 'Email : '.$admininfo->email.'<br /><br />';
						$content .= 'Contact Email Address : '.$email.'<br /><br />';
						$content .= 'Chosen Department : '.$mailto.'<br /><br />';
						$content .= 'Academy URL : '.base_url().'<br /><br />';						
						$content .= 'Subject : '.$subject.'<br /><br />';
						$content .= 'Message : '.$message.'<br /><br />';
						$content .='<br /><br />';
						$content .='...</p>';						
						$content .= 'Regards,<br />';
						$content .= 'Create Online Academy Team</p>';

						$data['content'] = $content;
						$data['fromemail'] = $urldomain;
						$message1 = $this->load->view('email_formates/admin_email_formate.php',$data,true);
						
						$config['charset'] = 'utf-8';
						$config['mailtype'] = 'html';
						$config['wordwrap'] = TRUE;
						$this->email->initialize($config);
						$this->email->from($fromemail,$configarr[0]['fromname']);
						$this->email->to($toemail);
						$this->email->subject($subject1);
						$this->email->message($message1);
						if($attach->ftpfilearray)
						{
						$this->email->attach($newFile);
						}						
						$this->email->send();
						
		                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Your Query Has Been Successfully Submitted. We will get back to you at the Earliest'));
		            	redirect('admin/settings/support_team');
						
					}
        }

        public function upload_attachment()
		{	
			   error_reporting(0);
		       $this->load->helper('directory');
			   $this->load->helper('file');
			   $status = "";
			   $msg = "";
			   $ftpfiles_i = array();
			   $file_element_name = 'file_i';	  

			   if ($status != "error")
			   {
				  $config['upload_path'] = 'public/uploads/settings/img/logo';
				  $config['allowed_types'] = 'jpg|gif|jpeg|jpg|png|bmp|pdf|eml|rar|zip|doc|docx|xls|xlxs|txt|wav';
				  $config['max_size']  = 1024 * 8;
				  $config['encrypt_name'] = TRUE;
				  $config['overwrite'] = TRUE;
				  $config['file_name'] = $_FILES['orig_name'];
		          $ftpfiles_i = $_FILES['orig_name'];
			      
				  $this->load->library('upload', $config);

				  if (!$this->upload->do_upload($file_element_name))
				  {
					 $status = 'error';
					 $msg = $this->upload->display_errors('', '');
				  }
				  else
				  {
		            
					 $file_id = true;
		            $data = $this->upload->data();
					 $file_id = true;
					 
					 if($file_id)
					 {
						$status = "success";
						$msg = "File successfully uploaded";
					 }
					 else
					 {
						unlink($data['full_path']);
						$status = "error";
						$msg = "Something went wrong when saving the file, please try again.";
					 }
				  }
		        
				  @unlink($_FILES[$file_element_name]);
			   }
			  
			   $rs = json_encode(array('status' => $status, 'msg' => $msg, 'ftpfilearray' => $data['file_name']));
			   return $rs;
	    }
        


	    public function renew(){
	    
	    	$this->template->build('admin/progressbar/academyrenewalpage');
	    }
}