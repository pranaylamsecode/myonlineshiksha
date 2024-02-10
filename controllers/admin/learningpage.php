<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Learningpage extends MLMS_Controller {



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
        $this->load->model('admin/pcategories_model');
        $this->load->model('crud_model');
         $this->load->helper('directory');
	   $this->load->helper('file');
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

       $path=base_url() . "admin/learningpage/";
        $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;	   
       $baseurl = base_url() . "admin/learningpage/";
       $this->load->library('pagination');
       $config["base_url"] = $baseurl;
       $config['per_page'] = 10;
       $config['enable_query_strings'] = true;
       $config['uri_segment'] = 3;

       $config['total_rows'] = $this->Pagecreator_model->getPagesCount($search_string);	 
	   // exit();

       //echo $this->users_model->getOrdersCount($search_string);
      
       $this->pagination->initialize($config);			
	      
       $allpages = $this->Pagecreator_model->getLearnPages($config['per_page'],$start,$search_string);
       // echo "demo test";exit;
			

            $this->template->set('allpages',$allpages);  
		
			
            $this->template->set("countpages", $this->Pagecreator_model->getPagesCount());			

            $this->template->build('admin/learning_pages/list');
	}



    public function createpage($parent_id = NULL)
	{

	        $this->template->set_layout('backend');

	        $this->template->title('Create Page');

            $this->template->set('updType',"create");

			$categories = $this->pcategories_model->getLearningCate();
			 $this->template->set('categories',$categories);

            $heading=$this->input->post('heading');

            $content=$this->input->post('description');

            $show_in_menu=$this->input->post('show_in_menu');

            $metaTit = $this->input->post('metaTitle');

            $meta_descript = $this->input->post('meta_descript');

            $metaKword = $this->input->post('metaKword');


            $this->form_validation->set_rules('heading', 'Title', 'required');

            $this->form_validation->set_rules('description', 'Description', 'required');

		$title = $this->input->post('slug') ? strip_tags($this->input->post('slug')) : strip_tags($this->input->post('heading'));
	      		    
		$titleURL = strtolower(url_title($title));
		$title2 = $titleURL;

            if ($this->form_validation->run() == FALSE)
		    {
			       $this->template->build('admin/learning_pages/create');
		    }

		    else

		    {
		            $session = $this->session->userdata('loggedin');

                  	$data = array(

    				'heading' => $heading,

    				'slug' => $titleURL,

    				'content' => $content,

    				'doc_file' => $heading,

    				'catid' => $this->input->post('category_id'),

    				// 'show_in_menu' => $show_in_menu,

    				'createdon' => date("Y-m-d"),

                    'createdby' => $session['id'],

                    'meta_title' => $metaTit,

                    'meta_desc' => $meta_descript,

                    'meta_keyword' => $metaKword

    			);

                $ins_id = $this->crud_model->SaveData('mlms_learncontent', $data);

                $res[0] = "success";
                $res[1] = $ins_id;
				echo json_encode($res);

                //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

               	//redirect('admin/learningpage');
	        }
	}

	public function ajaxCreate($pid=null)
	{
		 $heading=$this->input->post('heading');

           $content=$this->input->post('description');

           $show_in_menu=$this->input->post('show_in_menu');

           $metaTit = $this->input->post('metaTitle');

            $meta_descript = $this->input->post('meta_descript');

            $metaKword = $this->input->post('metaKword');

           $title = $this->input->post('slug') ? strip_tags($this->input->post('slug')) : strip_tags($this->input->post('heading'));
	      		    
		$titleURL = strtolower(url_title($title));
		$title2 = $titleURL;

		$image_nm = $this->input->post('blog_img');
		    	$pdf_nm = $this->input->post('docfile');
		    	$config['upload_path'] =  getcwd().'/public/LearnContent/images/';
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size']  = 1024 * 100;
				$config['encrypt_name'] = TRUE;
				$config['overwrite'] = TRUE;

		        $this->load->library('upload', $config);

		    	if($_FILES['image']['error']=='0'){
				
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('image')) {
		        	$image_nm = $_FILES['image']['name'];
		            // $data = array('error' => $this->upload->display_errors());
		        }             
		        // $data = array('image_metadata' => $this->upload->data());

			}
		if($_FILES['blog_pdf']['error']=='0'){
		        $config['upload_path'] =  getcwd().'/public/LearnContent/pdf_file/';
		        $config['allowed_types'] = 'pdf'; 
				

	        $this->upload->initialize($config);

	        if ($this->upload->do_upload('blog_pdf')) {
	            // $data = array('error' => $this->upload->display_errors());
	        	$pdf_nm = $_FILES['blog_pdf']['name'];

	        } /*else {
	            $data = array('image_metadata' => $this->upload->data());
	        }*/
	    }

		$session = $this->session->userdata('loggedin');

          		$data = array(

    				'heading' => $heading,

    				'slug' => $titleURL,

    				'content' => $content,

    				'catid' => $this->input->post('category_id'),

    				'show_in_menu' => $show_in_menu,

    				'meta_title' => $metaTit,

                    'meta_desc' => $meta_descript,

                    'meta_keyword' => $metaKword,

                    'doc_file' => $pdf_nm,

                    'image' => $image_nm

    			);


		if($this->input->post('id') || $pid){

			 $this->crud_model->SaveData('mlms_learncontent',$data, array('page_id'=>$pid));
				$res[0] = "success";
				$res[1] = '';
				echo json_encode($res);
			}
			else{
		            
                $ins_id = $this->crud_model->SaveData('mlms_learncontent', $data);

                $res[0] = "success";
                $res[1] = $ins_id;
				echo json_encode($res);
			}

                //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

               	//redirect('admin/learningpage');
	        
	}

    public function editPage()
    {

           $this->template->set_layout('backend');

	       $this->template->title('Edit Page');

           $this->template->set('updType',"edit");

			$categories = $this->pcategories_model->getLearningCate();
			 $this->template->set('categories',$categories);

           $pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('id')));

           $page=$this->Pagecreator_model->getPageLearnById($pid);

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

           $title = $this->input->post('slug') ? strip_tags($this->input->post('slug')) : strip_tags($this->input->post('heading'));
	      		    
		$titleURL = strtolower(url_title($title));
		$title2 = $titleURL;

            if ($this->form_validation->run() == FALSE)
		    {

			       $this->template->build('admin/learning_pages/create');
		    	// echo "fail";

		    }
		    else
		    {
		    	$image_nm = $this->input->post('blog_img');
		    	$pdf_nm = $this->input->post('docfile');
		    	$config['upload_path'] =  getcwd().'/public/LearnContent/images/';
				$config['allowed_types'] = 'gif|jpg|png'; 
				$config['max_size']  = 1024 * 100;
				$config['encrypt_name'] = TRUE;
				$config['overwrite'] = TRUE;

		        $this->load->library('upload', $config);

		    	if($_FILES['image']['error']=='0'){
				
		        $this->upload->initialize($config);

		        if ($this->upload->do_upload('image')) {
		        	$image_nm = $_FILES['image']['name'];
		            // $data = array('error' => $this->upload->display_errors());
		        }             
		        // $data = array('image_metadata' => $this->upload->data());

			}
		if($_FILES['blog_pdf']['error']=='0'){
		        $config['upload_path'] =  getcwd().'/public/LearnContent/pdf_file/';
		        $config['allowed_types'] = 'pdf'; 
				

	        $this->upload->initialize($config);

	        if ($this->upload->do_upload('blog_pdf')) {
	            // $data = array('error' => $this->upload->display_errors());
	        	$pdf_nm = $_FILES['blog_pdf']['name'];

	        } /*else {
	            $data = array('image_metadata' => $this->upload->data());
	        }*/
	    }
                  	$data = array(

    				'heading' => $heading,

    				'slug' => $titleURL,

    				'content' => $content,

    				'catid' => $this->input->post('category_id'),

    				'show_in_menu' => $show_in_menu,

    				'meta_title' => $metaTit,

                    'meta_desc' => $meta_descript,

                    'meta_keyword' => $metaKword,

                    'doc_file' => $pdf_nm,

                    'image' => $image_nm

    			);

                $this->crud_model->SaveData('mlms_learncontent',$data, array('page_id'=>$pid));
				$res[0] = "success";
				$res[1] = '';
				echo json_encode($res);

                // $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
               	// redirect('admin/learningpage');
	        }
    }

    public function createcategory(){

    	$this->load->view('admin/learning_pages/createcoursecategories');

    }

    public function check_slug()
	{
		$slug = $this->input->post('slug');
		$id = $this->input->post('id');
		
		$get_res = $this->Pagecreator_model->matchCourse_slug($slug,$id);
		if(!empty($get_res))
		{
			print_r("0");
		}
		else
		{
			print_r("1");
		}
	}


 	public function savecategory()
	{
	 	$program_name = $this->input->post('name');
	 	$program_description = $this->input->post('description');
	 	$program_category_id = $this->input->post('category_id');
	 	$program_published = $this->input->post('published');	
	 	$u_data=$this->session->userdata('loggedin');
	    if(($u_data['groupid']=='4'))			
	    {
        	$sessionarray = $this->session->userdata('loggedin');
        	$user_id = $sessionarray['id'];
	   		$cropimagename = ($this->input->post('nameimg')) ? ($this->input->post('nameimg')) : 'no_images_category.jpg';
	   		$maxrow=null;
           	$orderingval = 0;
		   	$orderingval = (empty($maxrow)) ? 1 : intval($maxrow->maximum)+1;
		   	$title = @$this->input->post('slug') ? strip_tags(@$this->input->post('slug')) : strip_tags($this->input->post('name'));
	      		    
		$titleURL = strtolower(url_title($title));
		$title2 = $titleURL;
           	$data = array(
						'name' => $program_name,
						'slug' => $slug,
						'description' => $program_description,
						'alias' => $program_name,
						'published' => $program_published,
						'parent_id' => $program_category_id,
						'ordering' => $orderingval,
						'created_by' => $user_id,
			            'image' => $cropimagename         
			);
        	$rs = $this->pcategories_model->insertItemspage($data);
	   		echo $rs;
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

			$this->template->build('admin/learning_pages/create');

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

			redirect('admin/learningpage/');

		}

		

		//search the item to delete

		

		/*elseif ( $this->pcategories_model->getchildcount($id) )

		{

			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );

			redirect('admin/pcategories/');

		}

		*/

		

		$isdelete=$this->crud_model->DeleteData('mlms_learncontent', array('page_id'=>$tid));

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
			redirect(base_url().'admin/learningpage');


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

	public function custom_page_builder()
	{
		$this->load->view('admin/custom_pages/new_page');
	}

	

}

	