<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Pagecreator extends MLMS_Controller {



	protected $before_filter = array(

	);

	

	function __construct()

	{

		parent::__construct();

		$this->authenticate();

        $this->load->helper('url');
		
		 

        $this->load->helper('form');

        //$this->load->library('session');

        $this->load->library('form_validation');

        $this->load->library('ckeditor');

        $this->load->model('admin/Pagecreator_model');

        $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';				
        $this->lang->load('tooltip', 'english');

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
	  
	      //$this->authenticate();
		  
	     $this->template->set_layout('backend');
		 
		 $sess_pagec = $this->session->userdata('sess_pagec');

	     $this->template->title('Page Manager');
		 
            if($this->input->post('reset') == 'Reset'){
	    $search_string = $this->input->post('search_text', TRUE);
	   
		//$search_status = $this->input->post('status', TRUE);
		//$search_cate = $this->input->post('catid', TRUE);
		//$this->input->post('search_text')='';
		$this->session->unset_userdata('sess_pagec');
		$search_string = '';
		//$search_status = '';
		//$search_type = '';
		}else{
         $search_string = ($this->input->post('search_text', TRUE)) ? $this->input->post('search_text', TRUE) : $sess_pagec['searchterm'];
		
		
        // $search_status = ($this->input->post('status') == '1' || is_numeric($this->input->post('status')) && $this->input->post('status') == '0') ? $this->input->post('status') : $sess_orders['searchstatus'];
        // $search_cate = ($this->input->post('catid', TRUE)) ? $this->input->post('catid', TRUE) : $sess_orders['searchtcate'];
        $searchdata = array(
				 "searchterm" => $search_string
				 );
				 
	    $this->session->set_userdata('sess_pagec', $searchdata);
        }

       $path=base_url() . "admin/pagecreator/";
        $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;	   
       $baseurl = base_url() . "admin/pagecreator/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;
	 
       $config['total_rows'] = $this->Pagecreator_model->getPagesCount($search_string);	 
	   
       //echo $this->users_model->getOrdersCount($search_string);
      
       $this->pagination->initialize($config);			
	      

       $allpages = $this->Pagecreator_model->getPages($config['per_page'],$start,$search_string);
			

            $this->template->set('allpages',$allpages);  
		
			
            $this->template->set("countpages", $this->Pagecreator_model->getcountpages());			

            $this->template->build('admin/pagecreator/list');
	}



    public function createPage($parent_id = NULL)

	{

	        $this->template->set_layout('backend');

	        $this->template->title('Create Page');

            $this->template->set('updType',"create");



            $heading=$this->input->post('heading');

            $content=$this->input->post('description');

            $show_in_menu=$this->input->post('show_in_menu');

            $metaTit = $this->input->post('metaTitle');

            $meta_descript = $this->input->post('meta_descript');

            $metaKword = $this->input->post('metaKword');


            $this->form_validation->set_rules('heading', 'Title', 'required');

            $this->form_validation->set_rules('description', 'Description', 'required');



            if ($this->form_validation->run() == FALSE)

		    {

			       $this->template->build('admin/pagecreator/create');

		    }

		    else

		    {
		            $session = $this->session->userdata('loggedin');

                  	$data = array(

    				'heading' => $heading,

    				'content' => $content,

    				'show_in_menu' => $show_in_menu,

    				'createdon' => date("Y-m-d"),

                    'createdby' => $session['id'],

                    'meta_title' => $metaTit,

                    'meta_desc' => $meta_descript,

                    'meta_keyword' => $metaKword

    			);

                $this->Pagecreator_model->insertItems($data);

                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

                redirect('admin/other-pages-design-setting/');
	        }
	}

    public function editPage()
    {

           $this->template->set_layout('backend');

	       $this->template->title('Edit Page');

           $this->template->set('updType',"edit");

           $pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('id')));

           $page=$this->Pagecreator_model->getPageById($pid);

           $this->template->set('page',$page);

           $this->template->set('id',$pid);

           $heading=$this->input->post('heading');

           $content=$this->input->post('description');

           $show_in_menu=$this->input->post('show_in_menu');

           $metaTit = $this->input->post('metaTitle');

            $meta_descript = $this->input->post('meta_descript');

            $metaKword = $this->input->post('metaKword');

           $this->form_validation->set_rules('heading', 'Title', 'required');

           $this->form_validation->set_rules('description', 'Summery', 'required');

            if ($this->form_validation->run() == FALSE)
		    {

			       $this->template->build('admin/pagecreator/create');

		    }
		    else
		    {

                  	$data = array(

    				'heading' => $heading,

    				'content' => $content,

    				'show_in_menu' => $show_in_menu,

    				'meta_title' => $metaTit,

                    'meta_desc' => $meta_descript,

                    'meta_keyword' => $metaKword

    			);

                $this->Pagecreator_model->updateItem($pid,$data);
				
                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
               	redirect('admin/other-pages-design-setting/');
	        }
    }



    public function editAboutPage()

    {

           $this->template->set_layout('backend');

	       $this->template->title('Page Creater');

           $this->template->set('updType',"edit");



           $pid = $this->uri->segment(4);



           $page=$this->Pagecreator_model->getPageById($pid);



           $this->template->set('page',$page);



           $heading=$this->input->post('heading');

           $content=$this->input->post('description');



           $this->form_validation->set_rules('heading', 'Title', 'required');

           $this->form_validation->set_rules('description', 'Summery', 'required');





            if ($this->form_validation->run() == FALSE)

		    {

			       $this->template->build('admin/pagecreator/contactpage');

		    }

		    else

		    {

		            $settingarr=array(

                     'address'=>$address,

                     'phone'=>$phone,

                     'email'=>$email,

                     'weburl'=>$weburl,

                     'mapcode'=>$mapcode,

                    );



		            $session = $this->session->userdata('loggedin');

                  	$data = array(

    				'heading' => $heading,

    				'content' => $content,

    				'settings' => json_encode($settingarr),

    				'createdon' => date("Y-m-d"),

                    'createdby' => $session['id']

    			);



                $this->Pagecreator_model->updateItem($pageid,$data);



                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

               	redirect('admin/other-pages-design-setting/');



	        }



    }



    public function editContactPage()

    {

         $this->template->set_layout('backend');

	     $this->template->title('Edit Contact Us Page');





         $pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('pageid')));



         $page=$this->Pagecreator_model->getPageById($pid);



         $this->template->set('page',$page);



         $heading=$this->input->post('heading');

         $content=trim($this->input->post('description'));

         $address=$this->input->post('address');

         $phone=$this->input->post('phone');

         $email=$this->input->post('email');

         $weburl=$this->input->post('weburl');

         $mapcode=$this->input->post('mapcode');

         $pageid=$this->input->post('pageid');



            $this->form_validation->set_rules('heading', 'Title', 'required');

            //$this->form_validation->set_rules('address', 'Address', 'required');

            $this->form_validation->set_rules('phone', 'Phone', 'max_length[10]|numeric');

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            //$this->form_validation->set_rules('weburl', 'Web Address', 'required');





            if ($this->form_validation->run() == FALSE)

		    {

			       $this->template->build('admin/pagecreator/contactpage');

		    }

		    else

		    {

		            $settingarr=array(

                     'address'=>$address,

                     'phone'=>$phone,

                     'email'=>$email,

                     'weburl'=>$weburl,

                     'mapcode'=>$mapcode,

                    );



		            $session = $this->session->userdata('loggedin');

                  	$data = array(

    				'heading' => $heading,

    				'content' => $content,

    				'settings' => json_encode($settingarr),

    				'createdon' => date("Y-m-d"),

                    'createdby' => $session['id']

    			);



                $this->Pagecreator_model->updateItem($pageid,$data);



                $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

               	redirect('admin/other-pages-design-setting/');



	        }





    }





     public function publish($qid = FALSE){







	    $qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;



		if (!$qid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('admin/other-pages-design-setting/');

			}

		else{

				$upd_data = array(

					'status'=>'active'

				);

				$in_ids = $qid;

				$publish=$this->Pagecreator_model->publish_unpublishItem($in_ids,$upd_data);



				//Publish the item

				if ($publish)

				{

					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Page published successfully!' ));

				}

				else

				{

					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Page publish action fail or already published!' ) );

				}

				redirect('admin/other-pages-design-setting');



			}

	}









    public function unpublish($qid = FALSE){





		$qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;



		if (!$qid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );

			redirect('admin/other-pages-design-setting/');

			}

		else{

				$upd_data = array(

					'status' => 'inactive'

				);

				$in_ids = $qid;

				$unpublish=$this->Pagecreator_model->publish_unpublishItem($in_ids,$upd_data);



				//Publish the item

				if ($unpublish)

				{

					$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Page unpublished successfully!' ));

				}

				else

				{

					$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Page unpublish action fail or already unpublished!' ) );

				}

			  	redirect('admin/other-pages-design-setting');



			}

	}













	function layoutstructure()

	{	$layoutstructure = array();

		$layoutstructure[] = (object) array('id'=> '1', 'scr_m' => '1', 'scr_t' => '1');

		$layoutstructure[] = (object) array('id'=> '2', 'scr_m' => '2,3', 'scr_t' => '2');

		$layoutstructure[] = (object) array('id'=> '3', 'scr_m' => '4', 'scr_t' => '3');

		$layoutstructure[] = (object) array('id'=> '4', 'scr_m' => '5,6', 'scr_t' => '4');

		$layoutstructure[] = (object) array('id'=> '5', 'scr_m' => '', 'scr_t' => '5');

		$layoutstructure[] = (object) array('id'=> '6', 'scr_m' => '7', 'scr_t' => '');

		$layoutstructure[] = (object) array('id'=> '7', 'scr_m' => '8', 'scr_t' => '6');

		$layoutstructure[] = (object) array('id'=> '8', 'scr_m' => '9,10', 'scr_t' => '7');

		$layoutstructure[] = (object) array('id'=> '9', 'scr_m' => '11', 'scr_t' => '8');

		$layoutstructure[] = (object) array('id'=> '10', 'scr_m' => '12,13', 'scr_t' => '9');

		$layoutstructure[] = (object) array('id'=> '11', 'scr_m' => '14', 'scr_t' => '10,11');

		$layoutstructure[] = (object) array('id'=> '12', 'scr_m' => '15', 'scr_t' => '');

		return $layoutstructure;

	}

	function create($did = false ,$pid = false)

	{

	    //print_r($_POST);exit;

		$this->template->append_metadata(block_submit_button());

		

		$pid = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('pid', TRUE);

		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;



		$did = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('did', TRUE);

		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;

		$this->template->set('title', 'Create Lesson');//lang('web_category_create'));

		$this->template->set('updType', 'create');

		$this->template->set('pid',$pid);

		$this->template->set('did',$did);

		

	  	//$this->load->helper('form');

		//$this->load->library('form_validation');



		$this->form_validation->set_rules('name', 'name', 'required');

		$this->form_validation->set_rules('step_access', 'step access', 'required');

		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');



		if ($this->form_validation->run() === false)

		{

			$this->template->build('admin/tasks/create');

		}

		else

		{

			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');

			$data = array(

				'name' => $this->input->post('name'),

				'alias' => $alias,

				'difficultylevel' => $this->input->post('difficultylevel'),

				'metatitle' => $this->input->post('title'),

				'metakwd' => $this->input->post('key_description'),

				'metadesc' => $this->input->post('description'),

				'step_access' => $this->input->post('step_access'),

				'startpublish' => $this->input->post('startpublish'),

				'endpublish' => $this->input->post('endpublish'),

				'published' => $this->input->post('published'),

				'ordering' => $this->tasks_model->maxorder()

			);

		

			$tid=$this->tasks_model->insertItems($pid,$data);

				if($tid)

				{

					$data = array(

					'type' => 'scr_l',

					'type_id' => $tid,

					'media_id' => $this->input->post('layout_db')

					);

					if($this->tasks_model->insertItemsRel($data))

					{

						$data = array(

						'type' => 'dtask',

						'type_id' => $did,

						'media_id' => $tid

						);

						$istaskrelinsert = $this->tasks_model->insertItemsRel($data);

						

						

						

						if($istaskrelinsert)

						{

						$layoutstructure = self::layoutstructure();

						/*echo '<pre>';

						print_r($layoutstructure);

						echo '</pre>';*/

						$i=0;

						foreach($layoutstructure as $layout){

							$i++;

							$layoutvalarr = array();

							$layoutvalarr = explode(',',$layout->scr_m);

							if($layout->scr_m!=''){

							for($m = 0;$m < count($layoutvalarr);$m++){

							$mediamedia = $this->input->post('db_media_'.$layoutvalarr[$m]);

								

								$datamedia = array(

								'type' => 'scr_m',

								'type_id' => $tid,

								'media_id' => $mediamedia,

								'layout' => $layoutvalarr[$m]

								);

							$this->tasks_model->insertItemsRel($datamedia);

								}

							}

							$textlayoutarr = array();

							$textlayoutarr = explode(',',$layout->scr_t);

							if($layout->scr_t!=''){

							for($t = 0;$t < count($textlayoutarr);$t++){

							$mediatext = $this->input->post('db_text_'.$textlayoutarr[$t]);

								$datatext = array(

								'type' => 'scr_t',

								'type_id' => $tid,

								'media_id' => $mediatext,

								'layout' => $textlayoutarr[$t]

								);

							$this->tasks_model->insertItemsRel($datatext);

								}

							}

						}	

							for($ji=1;$ji<=4;$ji++){

							$jumpbutval = 'jumpbutval'.$ji;

							$$jumpbutval = $this->input->post('jumpbutton'.$ji);

							if($$jumpbutval != 0){

								$datajump = array(

									'type' => 'jump',

									'type_id' => $tid,

									'media_id' => $$jumpbutval

									);

								$this->tasks_model->insertItemsRel($datajump);

								}

							}

							$this->tasks_model->updatetaskcount($pid);

							$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

							?><script type="text/javascript">

							window.parent.location.href = "<?php echo base_url(); ?>/admin/days/<?php echo $pid?>";

							</script><?php

						}

					}

				}

			

		}

	}



	function edit($tid = true ,$did = true ,$pid = true) 

	{

		//load block submit helper and append in the head

		$this->template->append_metadata(block_submit_button());

		//$this->load->helper('form');

		//Rules for validation

		$this->_set_rules('edit');



		//get the parent id and sanitize

		$pid = ( $this->uri->segment(6) )  ? $this->uri->segment(6) : $this->input->post('pid', TRUE);

		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;

		

		$did = ( $this->uri->segment(5) )  ? $this->uri->segment(5) : $this->input->post('did', TRUE);

		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;



		//get the $tid and sanitize

		$tid = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('id', TRUE);

		$tid = ($tid != 0) ? filter_var($tid, FILTER_VALIDATE_INT) : NULL;

		//variables for check the upload

		$form_data_aux			= array();

		$files_to_delete 		= array();

		//redirect if it´s not correct

		if (!$tid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('admin/days/'.$pid);

		}

		$this->template->title("Edit Lesson");

		$this->template->set('db_media', $this->tasks_model->getMedia_oflayout('scr_m',$tid));

		$this->template->set('db_mediatext', $this->tasks_model->getMedia_oflayout('scr_t',$tid));

		$mediajumpids = $this->tasks_model->getMedia_oflayout('jump',$tid);

		foreach($mediajumpids as $mediajumpid){

		$jumpbut = $this->tasks_model->getJumpbutton($mediajumpid->media_id);

		$jumpbut = $jumpbut->button;

		$this->template->set('jump_but'.$jumpbut, $this->tasks_model->getJumpbutton($mediajumpid->media_id));

		}

		$this->template->set('task', $this->tasks_model->getLesson($tid,$did,$pid));

		$this->template->set('jmpbuttoninfo', $this->tasks_model->getMedia_oflayout('jump',$tid));

		$this->template->set('updType', 'edit');

		$this->template->set('pid', $pid);

		$this->template->set('did', $did);



        $this->form_validation->set_rules('name', 'name', 'required');

		$this->form_validation->set_rules('step_access', 'step access', 'required');

		$this->form_validation->set_rules('difficultylevel', 'difficultylevel', 'required');

	   		

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed

		{

			//load the view and the layout

			$this->template->build('admin/tasks/create');

		}

		else

		{	



			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');

            $form_data = array(

				'name' => $this->input->post('name'),

				'alias' => $alias,

				'difficultylevel' => $this->input->post('difficultylevel'),

				'metatitle' => $this->input->post('title'),

				'metakwd' => $this->input->post('key_description'),

				'metadesc' => $this->input->post('description'),

				'step_access' => $this->input->post('step_access'),

				'startpublish' => $this->input->post('startpublish'),

				'endpublish' => $this->input->post('endpublish'),

				'published' => $this->input->post('published'),

				'ordering' => $this->tasks_model->maxorder()

			);





            /*$form_data = array(

				'name' => $this->input->post('name'),

				'alias' => $alias,

				'step_access' => $this->input->post('step_access'),

				'published' => $this->input->post('published')

			);*/



			$typeid=$this->input->post('layout_db');

			

				if(isset($typeid)){

					$medrel_data = array(

						'media_id' => $this->input->post('layout_db')				

					);

					$this->tasks_model->updateMediarel($tid,0,$medrel_data,'scr_l');

					$layoutstructure = self::layoutstructure();

					

						$i=0;

						foreach($layoutstructure as $layout){

							$i++;

							$layoutvalarr = array();

							$layoutvalarr = explode(',',$layout->scr_m);

							if($layout->scr_m!=''){

							for($m = 0;$m < count($layoutvalarr);$m++){

							$mediamedia = $this->input->post('db_media_'.$layoutvalarr[$m]);

								

								$datamedia = array(

								'media_id' => $mediamedia

								);

							$this->tasks_model->updateMediarel($tid,$layoutvalarr[$m],$datamedia,'scr_m');

							

								}

							}

							$textlayoutarr = array();

							$textlayoutarr = explode(',',$layout->scr_t);

							if($layout->scr_t!=''){

							for($t = 0;$t < count($textlayoutarr);$t++){

							$mediatext = $this->input->post('db_text_'.$textlayoutarr[$t]);

								$datatext = array(

								'media_id' => $mediatext

								);

							$this->tasks_model->updateMediarel($tid,$textlayoutarr[$t],$datatext,'scr_t');

								}

							}

						}

					

					

				}

				$this->tasks_model->deleteJumprel('jump',$tid);

				//$countjmpbut = count($jmpbutinfo);

				//$ispresent = array();

				//foreach($jmpbutinfo as $jmpbut ){

				//$ispresent[] = $jmpbut->media_id;

				//}

				//if($countjmpbut < 4):

							for($ji = 1; $ji <= 4; $ji++){

							$jumpbutval = 'jumpbutval'.$ji;

							$$jumpbutval = $this->input->post('jumpbutton'.$ji);

							if($$jumpbutval != 0){

								$datajump = array(

									'type' => 'jump',

									'type_id' => $tid,

									'media_id' => $$jumpbutval

									);

								$this->tasks_model->insertItemsRel($datajump);

								}

							}		

				//endif;

				$isupdated=$this->tasks_model->updateItem($tid,$form_data);

				$this->tasks_model->updatetaskcount($pid);

			if ($isupdated) // the information has therefore been successfully saved in the db

			{

				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));

				?><script type="text/javascript">

				//parent.jQuery.fancybox.close();

				window.parent.location.href = "<?php echo base_url(); ?>/admin/days/<?php echo $pid?>";

				</script><?php

				//redirect('admin/days/'.$pid);

			}

			else{

				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );

				?><script type="text/javascript">

				//parent.jQuery.fancybox.close();

				window.parent.location.href = "<?php echo base_url(); ?>/admin/days/<?php echo $pid?>";

				</script><?php

				//redirect('admin/days/'.$pid);	

			}	

	  	} 

	}

	

	function delete($tid = true ,$did = true ,$pid = true)

	{

		//filter & Sanitize $id

		$tid = ($tid != 0) ? filter_var($tid, FILTER_VALIDATE_INT) : NULL;

		$did = ($did != 0) ? filter_var($did, FILTER_VALIDATE_INT) : NULL;

		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;



		//redirect if it´s no correct

		if (!$tid){

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('admin/other-pages-design-setting/');

		}

		

		//search the item to delete

		

		/*elseif ( $this->pcategories_model->getchildcount($id) )

		{

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('admin/pcategories/');

		}

		*/

		

		$isdelete=$this->Pagecreator_model->deleteItem($tid);

        //$this->Pagecreator_model->updatetaskcount($pid);



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

			//redirect('admin/pagecreator/'.$pid);
			redirect('admin/other-pages-design-setting/');


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

	
// custom page builder starts from here
	public function custom_page_builder()
	{
		$udata = $this->session->userdata('loggedin');
		$gettemplates = $this->Crud_model->GetData('mlms_templates');
		$this->template->set('templatelist',$gettemplates);
		$this->template->set('getpage','');
		$this->template->set('button','create');
		$this->template->set_layout('backend');
		$this->template->build('admin/page_builder/custom_page');
	}

	public function edit_custom_page($id = null)
	{
		$udata = $this->session->userdata('loggedin');
		if(!empty($udata)){
			$gettemplates = $this->Crud_model->GetData('mlms_templates');
			$this->template->set('templatelist',$gettemplates);
			$getpage = $this->Crud_model->get_single('mlms_pagecreater',"page_id = ".$id);
			$this->template->set('getpage',$getpage);
			$this->template->set('button','edit');
			$this->template->set_layout('backend');
			$this->template->build('admin/page_builder/custom_page');
		}else{
			redirect(base_url());
		}
	}

	public function custom_page_list(){
		$auth = $this->session->userdata('logged_in');
		if(!empty($auth)){
			$total_pages = $this->Crud_model->get_single('mlms_pagecreater','','count(page_id) as total');
			if($this->input->post('pay_page'))
		    {
		        $currpage = $this->input->post('pay_page');
		        if(empty($this->input->post('pay_page')) || $this->input->post('pay_page')==1)
		        {
		          	$firstp = 0;
		        }
		        else{
		          	$firstp = intval(intval($this->input->post('pay_page'))-1) * 10 ;
		        }
		        if((intval($firstp)+intval(10)) > $total_pages->total)
		        {
		          	$startp = $total_pages->total;
		        }
		        else{
		          	$startp = $firstp + 10;
		        }
		        $pages = $this->Crud_model->GetData('mlms_pagecreater','page_id,heading,show_in_menu,status','','',"page_id DESC",10,'',$firstp);
		    }
		    else{
		        $currpage = 1;
		        $firstp = 0;
		        $startp = 10;
		        $pages = $this->Crud_model->GetData('mlms_pagecreater','page_id,heading,show_in_menu,status','','',"page_id DESC",10,'',$firstp);
		    }
		    $pagination = '';
		    $pagesp = ceil(intval($total_pages->total)/10);
		    if($pagesp>1) {
		        if(intval($currpage) == 1) 
		          	$pagination .= '<li data-ci-pagination-page="1" class="disabled"><a>&lsaquo; First</a></li>
		                      <li class="disabled"><a>&lt;</a></li>';
		        else  
		          	$pagination .= '<li data-ci-pagination-page="1" onclick="getpayout(1,\'admin/pagecreator/custom_page_list\')"><a>&lsaquo; First</a></li>
		              	<li data-ci-pagination-page="'.(intval($currpage)-1).'" onclick="getpayout('.(intval($currpage)-1).',\'admin/pagecreator/custom_page_list\')"><a>&lt;</a></li>';

		        if((intval($currpage)-3)>0) {
		          	if($currpage == 1)
		            	$pagination .= '<li data-ci-pagination-page="1" class="disabled active"><a>&lsaquo; First</a></li>';
		        }
		        if((intval($currpage)-3)>1) {
		            $pagination .= '<li>...</li>';
		        }
		        for($i=(intval($currpage)-2); $i<=(intval($currpage)+2); $i++)  {
		          	if($i<1) continue;
		          	if($i>$pagesp) break;
		          	if(intval($currpage) == $i)
		            	$pagination .= '<li class="active" data-ci-pagination-page="'.$currpage.'"><a>'.$currpage.'</a></li>';
		          	else        
		            	$pagination .= '<li data-ci-pagination-page="'.$i.'" onclick="getpayout('.$i.',\'admin/pagecreator/custom_page_list\')"><a>'.$i.'</a></li>';
		        }
		        if(($pagesp-(intval($currpage)+2))>1) {
		            $pagination .= '<li><a>...</a></li>';
		        }
		        if(($pagesp-(intval($currpage)+2))>0) {
		          	if(intval($currpage) == $pagesp)
		            	$pagination .= '<li id=' .$pagesp.' class="active" data-ci-pagination-page="'.$pagesp.'" ><a>'.$pagesp.'</a></li>';
		          	else        
		            	$pagination .= '<li data-ci-pagination-page="'.$pagesp.'" onclick="getpayout('.$pagesp.',\'admin/pagecreator/custom_page_list\')"><a>'.$pagesp.'</a></li>';
		        }
		        if(intval($currpage) < $pagesp)
		          	$pagination .= '<li onclick="getpayout('.(intval($currpage)+1).',\'admin/pagecreator/custom_page_list\')" ><a> > </a></li>
		                  <li onclick="getpayout('.$pagesp.',\'admin/pagecreator/custom_page_list\')" ><a>Last &rsaquo;</a></li>';
		        else        
		          	$pagination .= '<li class="disabled" data-ci-pagination-page="'.$pagesp.'"><a> > </a></li><li data-ci-pagination-page="'.$pagesp.'" class="disabled"><a>Last &rsaquo;</a></li>';
		    }
		    if($this->input->post('pay_page'))
		    {
		        $output = "";
		        $i = ((intval($currpage) - 1) * 10) + 1;
		        foreach ($pages as $key)
		        {
		        	// $end_time = date('Y-m-d H:i:s',strtotime($key->start_time . " +".$key->duration." minutes"));
		          	if($key->status == 'active'){$status = 'w_active';}else{$status = 'w_inactive';}
		          	$output .= '
		          	<tr class="camp0">
		            <td class="field-title">'.$i++.'</td>
					<td class="field-title">'.ucwords($key->heading).'</td>
					<td class="field-title">'.ucwords($key->show_in_menu).'</td>
					<td class="field-title">
						<a title="Change status" id="status_'.$key->page_id.'" onclick="return change_status('.$key->page_id.',\''.$key->status.'\')" type="button"><div class="sprite 999publish center '.$status.'"></div></a>
					</td>';
					if($key->page_id != 1){
					$output .= '<td class="field-title">
						<a href="'.base_url().'admin/pagecreator/edit_custom_page/'.$key->page_id.'"><div class="sprite center " style="background-position: -32px 0;" title="Edit pages"></div></a>
					</td>';
		            }else{
		            $output .= '<td class="field-title"></td>';
		            }
		          	$output .= '</tr>';
		        }
				$data1['payoutdata'] = $output;
				$data1['lastpage'] = $pagesp;
				$data1['links'] = $this->input->post('pay_page');
				$data1['firstp'] = $firstp + 1;
				$data1['startp'] = $startp;
				$data1['paying'] = $pagination;
				$data1['total_payout'] = $total_pages->total;
				echo json_encode($data1);
		    }
		    else{
				$data = array(
						'pages'  => $pages,
						'paying' => $pagination,
						'firstp' => $firstp + 1,
						'startp' => $startp,
						'total_payout' => $total_pages->total,
				);
				// print_r($data);exit;
				$this->template->set_layout('backend');
				$this->template->build('admin/page_builder/page_list',$data);            
		    }
		}
		else
		{
			redirect(base_url());
		}
	}

	public function build_page()
	{
		$udata = $this->session->userdata('loggedin');
		if(!empty($udata)){
			$page_id = $this->input->post('page_id');
			$titleURL = strtolower(url_title($this->input->post('page_slug')));
	        $title2 = $titleURL;
	        if(empty($this->input->post('page_slug'))){
				$titleURL = strtolower(url_title($this->input->post('page_title')));
	        	$title2 = $titleURL;
			}
	        $avail_slug = $this->Pagecreator_model->match_slug($titleURL,$page_id);
	        $i = 0;
	        if(in_array($titleURL, $avail_slug))
	        {
			    do{
			      $i++;
			      $titleURL = $title2.'-'.$i;
			    } while(in_array($titleURL, $avail_slug));
			}
			/*$is_homepage = $this->input->post('is_homepage');
			if($is_homepage == 'yes'){
				$data1 = array('set_as_homepage' => 'no');
				$this->Crud_model->SaveData('mlms_pagecreater',$data1,"set_as_homepage = 'yes'");
			}*/
			if(empty($page_id)){
				$data = array(
						'heading'		=> $this->input->post('page_title'),
						'slug'			=> $titleURL,
						'content' 		=> $this->input->post('page_content'),
						'show_in_menu' 	=> $this->input->post('show_in_menu'),
						'status' 		=> $this->input->post('published_id'),
						// 'set_as_homepage'=> $is_homepage,
						'createdon' 	=> date('Y-m-d'),
						'static' 		=> 1,
						'createdby'		=> $udata['id']
				);
				$this->Crud_model->SaveData('mlms_pagecreater',$data);
				echo $this->db->insert_id();
			}
			else{
				$data = array(
						'heading'		=> $this->input->post('page_title'),
						'slug'			=> $titleURL,
						'content' 		=> $this->input->post('page_content'),
						'show_in_menu' 	=> $this->input->post('show_in_menu'),
						'status' 		=> $this->input->post('published_id'),
						// 'set_as_homepage'=> $is_homepage,
				);
				$this->Crud_model->SaveData('mlms_pagecreater',$data,"page_id = ".$page_id);
				if($page_id == 1){
					$settingarr=array(
						'address'=>$this->input->post('address'),
						'phone'=>$this->input->post('phone'),
						'email'=>$this->input->post('email'),
						'weburl'=>$this->input->post('weburl'),
						'mapcode'=>$this->input->post('mapcode'),
                    );

					$data1 = array(
						'settings' => json_encode($settingarr)
					);
					$this->Crud_model->SaveData('mlms_pagecreater',$data1,"page_id = ".$page_id);
				}
				echo 'update';
			}

		}
	}
	public function upload_blog_image(){
		if( $_FILES['upload_image']['error']=='0' )
        {
            $file_element_name = 'upload_image';
            $config['upload_path'] = getcwd().'/public/uploads/blog_images/';
            $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
            // $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload($file_element_name))
            {
                $error =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
                $data = array('error' => $error);
            }
            $instr_file = $this->upload->data();
            $_POST['upload_image'] = $instr_file['file_name'];   
        	echo base_url().'public/uploads/blog_images/'.$_POST['upload_image'];
        }else{
        	echo '';
        }
	}

	public function upload_blog_image1(){
        $config['upload_path'] = getcwd().'/public/uploads/blog_images/';
        $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $img1 = $error1 = '';
        $img2 = $error2 = '';
        $img3 = $error3 = '';
        $img4 = $error4 = '';
        $img5 = $error5 = '';
        $img6 = $error6 = '';
		if($_FILES['upload_image1']['error']=='0' )
        {
            $file_element_name1 = 'upload_image1';

            if (!$this->upload->do_upload($file_element_name1))
            {
                $error1 =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
            }
            $instr_file1 = $this->upload->data();
            $_POST['upload_image1'] = $instr_file1['file_name'];   
        	$img1 = base_url().'public/uploads/blog_images/'.$_POST['upload_image1'];
        }
        if($_FILES['upload_image2']['error']=='0' )
        {
            $file_element_name2 = 'upload_image2';

            if (!$this->upload->do_upload($file_element_name2))
            {
                $error2 =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
            }
            $instr_file2 = $this->upload->data();
            $_POST['upload_image2'] = $instr_file2['file_name'];   
        	$img2 = base_url().'public/uploads/blog_images/'.$_POST['upload_image2'];
        }
        if($_FILES['upload_image3']['error']=='0' )
        {
            $file_element_name3 = 'upload_image3';

            if (!$this->upload->do_upload($file_element_name3))
            {
                $error3 =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
            }
            $instr_file3 = $this->upload->data();
            $_POST['upload_image3'] = $instr_file3['file_name'];   
        	$img3 = base_url().'public/uploads/blog_images/'.$_POST['upload_image3'];
        }
        if($_FILES['upload_image4']['error']=='0' )
        {
            $file_element_name4 = 'upload_image4';

            if (!$this->upload->do_upload($file_element_name4))
            {
                $error4 =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
            }
            $instr_file4 = $this->upload->data();
            $_POST['upload_image4'] = $instr_file4['file_name'];   
        	$img4 = base_url().'public/uploads/blog_images/'.$_POST['upload_image4'];
        }
        if($_FILES['upload_image5']['error']=='0' )
        {
            $file_element_name5 = 'upload_image5';

            if (!$this->upload->do_upload($file_element_name5))
            {
                $error5 =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
            }
            $instr_file5 = $this->upload->data();
            $_POST['upload_image5'] = $instr_file5['file_name'];   
        	$img5 = base_url().'public/uploads/blog_images/'.$_POST['upload_image5'];
        }
        if($_FILES['upload_image6']['error']=='0' )
        {
            $file_element_name6 = 'upload_image6';

            if (!$this->upload->do_upload($file_element_name6))
            {
                $error6 =$this->upload->display_errors('<p style="color:#AF5655;">', '</p>');
            }
            $instr_file6 = $this->upload->data();
            $_POST['upload_image6'] = $instr_file6['file_name'];   
        	$img6 = base_url().'public/uploads/blog_images/'.$_POST['upload_image6'];
        }
        $data1 = array(
    			'img1' 		=> $img1,
				'img2' 		=> $img2,
				'img3' 		=> $img3,
				'img4' 		=> $img4,
				'img5' 		=> $img5,
				'img6' 		=> $img6,
				'err_img1' 	=> $error1,
				'err_img2' 	=> $error2,
				'err_img3' 	=> $error3,
				'err_img4' 	=> $error4,
				'err_img5' 	=> $error5,
				'err_img6' 	=> $error6,
        );
        echo json_encode($data1);
	}

	public function change_status(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$data = array(
					'status' => $status
		);
		$this->Crud_model->SaveData('mlms_pagecreater',$data,"page_id = ".$id);
		echo $status;
	}

	public function demo(){
		/*$pages = $this->Crud_model->GetData('mlms_pagecreater','page_id,heading,slug');
		foreach ($pages as $key) {
	        $titleURL = strtolower(url_title($key->heading));
	        $title2 = $titleURL;
	        $avail_slug = $this->Pagecreator_model->match_slug($titleURL,$key->page_id);
	        $i = 0;
	        echo $title2.'...';
	        if(in_array($titleURL, $avail_slug))
	        {
			    do{
			      $i++;
			      $titleURL = $title2.'-'.$i;
			      echo $titleURL." ......... ";
			    } while(in_array($titleURL, $avail_slug));
			}
		}*/

	}
}

	