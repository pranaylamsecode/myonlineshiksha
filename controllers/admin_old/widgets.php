<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widgets extends MLMS_Controller 
{
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
    $this->load->model('admin/Widgets_model');
    $this->ckeditor->basePath = base_url().'public/asset/ckeditor/';	
	$this->lang->load('tooltip', 'english');

	$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
}

function authenticate()
{
    $session = $this->session->userdata('loggedin');
    if(!$this->session->userdata('loggedin'))
    {
		redirect('admin/users/login');
    }
}

public function index($parent_id = NULL)
{
    $this->template->set_layout('backend');
    $this->template->title('Manage Widgets');
    $allpages=$this->Widgets_model->getPages();
    $this->template->set('allpages',$allpages);
	$this->template->set("countpagess", $this->Widgets_model->getcountPages());
    $this->template->build('admin/widgets/list');
}

public function createPage($parent_id = NULL)
{
	$this->template->set_layout('backend');
	$this->template->title('Manage Widgets');
    $this->template->set('updType',"create");
	
    $title=$this->input->post('title');
	//$alias=$this->input->post('alias');
	$description=$this->input->post('description');
	$area=$this->input->post('area');
	$status=$this->input->post('status');
	
   	$this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');

    if ($this->form_validation->run() == FALSE)
	{
	    $this->template->build('admin/widgets/create');
	}
	else
	{
	    $session = $this->session->userdata('loggedin');
	    if($_FILES['media']['name'])
                {
                  $file_name = $this->upload_image($_FILES);
                }
                else $file_name = '';

        $data = array(
		'title' => $title,
    	//'alias' => $alias,
    	'description' => $description,
		'area' => $area,
		'status' => $status,
		'created_on' => date("Y-m-d"),
        'created_by' => $session['id'],
        'media' => $file_name,
		);

		$this->Widgets_model->insertItems($data);
        $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
        redirect('admin/widgets/');
	}
}

public function editPage()
{
	$this->template->set_layout('backend');
	$this->template->title('Manage Widgets');
	$this->template->set('updType',"edit");
	
	$pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('id')));
	$page=$this->Widgets_model->getPageById($pid);
	$this->template->set('page',$page);
	$this->template->set('id',$pid);
	
	$title=$this->input->post('title');
	//$alias=$this->input->post('alias');
	$description=$this->input->post('description');
	$area=$this->input->post('area');
	$status=$this->input->post('status');
	
	//$this->form_validation->set_rules('alias', 'title', 'Title', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');
	
	if ($this->form_validation->run() == FALSE)
	{
			$this->template->build('admin/widgets/create');
	}
	else
	{
		// if($_FILES) print_r($_FILES['media']['name']); exit('11');
		if($_FILES['media']['name'])
                {
                  $file_name = $this->upload_image($_FILES);
                }
                else $file_name = '';


		$data = array(
			'title' => $title,
			//'alias' => $alias,
			'description' => $description,
			'area' => $area,
			'status' => $status,
			'media' => $file_name,
			);
	
		$this->Widgets_model->updateItem($pid,$data);
		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
           	redirect('admin/widgets/');
    }
}

public function editAboutPage()
{
		$this->template->set_layout('backend');
		$this->template->title('Page Creater');
		$this->template->set('updType',"edit");
		$pid = $this->uri->segment(4);
		$page=$this->Widgets_model->getPageById($pid);
		$this->template->set('page',$page);
		$heading=$this->input->post('heading');
		$content=$this->input->post('description');
		$this->form_validation->set_rules('heading', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Summery', 'required');
        
		if ($this->form_validation->run() == FALSE)
	    {
		    $this->template->build('admin/widgets/contactpage');
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

            $this->Widgets_model->updateItem($pageid,$data);
            //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
           	redirect('admin/widgets/');
        }
}



    public function editContactPage()

    {

         $this->template->set_layout('backend');

	     $this->template->title('Page Creater');

         $pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('pageid')));

         $page=$this->Widgets_model->getPageById($pid);

         $this->template->set('page',$page);

         $heading=$this->input->post('heading');

         $content=$this->input->post('description');

         $address=$this->input->post('address');

         $phone=$this->input->post('phone');

         $email=$this->input->post('email');

         $weburl=$this->input->post('weburl');

         $mapcode=$this->input->post('mapcode');

         $pageid=$this->input->post('pageid');



            $this->form_validation->set_rules('heading', 'Title', 'required');

            $this->form_validation->set_rules('address', 'Address', 'required');

            $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[10]|numeric');

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            $this->form_validation->set_rules('weburl', 'Web Address', 'required');





            if ($this->form_validation->run() == FALSE)

		    {

			       $this->template->build('admin/widgets/contactpage');

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



                $this->Widgets_model->updateItem($pageid,$data);



                //$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));

               	redirect('admin/widgets/');



	        }





    }





    public function publish($qid = FALSE)
	{
	    $qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/widgets/');
		}
		else
		{
			$upd_data = array(
			//'status'=>'active'
			'status'=>'1'
			);
			$in_ids = $qid;
			$publish=$this->Widgets_model->publish_unpublishItem($in_ids,$upd_data);
			//Publish the item
			if ($publish)
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Page published successfully!' ));
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Page publish action fail or already published!' ) );
			}
			redirect('admin/widgets');
		}
	}









    public function unpublish($qid = FALSE)
	{
		$qid = ((int)$this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/widgets/');
		}
		else
		{
			$upd_data = array(
			//'status' => 'inactive'
			'status' => '0'
			);
			$in_ids = $qid;
			$unpublish=$this->Widgets_model->publish_unpublishItem($in_ids,$upd_data);

			//Publish the item
			if ($unpublish)
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Page unpublished successfully!' ));
			}
			else
			{
			echo $unpublish;
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Page unpublish action fail or already unpublished!' ) );
			}
		  	redirect('admin/widgets');
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
			if($_FILES['media']['name'])
                {
                  $file_name = $this->upload_image($_FILES);
                }
                else $file_name = '';

			//$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');

			$data = array(

				'name' => $this->input->post('name'),

				//'alias' => $alias,

				'difficultylevel' => $this->input->post('difficultylevel'),

				'metatitle' => $this->input->post('title'),

				'metakwd' => $this->input->post('key_description'),

				'metadesc' => $this->input->post('description'),

				'step_access' => $this->input->post('step_access'),

				'startpublish' => $this->input->post('startpublish'),

				'endpublish' => $this->input->post('endpublish'),

				'published' => $this->input->post('published'),

				'ordering' => $this->tasks_model->maxorder(),
				'media' => $file_name,

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

function upload_image($arr)
    {
      if(isset($arr['media'])) {
              $tmp_name = $arr['media']['tmp_name'];
              $name     = $arr['media']['name'];
              $error    = $arr['media']['error'];
              $file_type = $arr['media']['type'];
      
              if ($error === UPLOAD_ERR_OK) {

                    $output_dir = FCPATH."public/uploads/";

                     $temp = explode(".", $arr["media"]["name"]);
                     $path_parts = pathinfo($output_dir.$name);

                    $i=1;
                    if(file_exists($output_dir.$name))
                    {
                      do{
                        $name = $path_parts['filename'].'_'.$i.'.'.end($temp);
                        $i++;
                        
                      }
                      while(file_exists($output_dir.$name));
                    }
                    
                    move_uploaded_file($tmp_name,$output_dir.$name);
                          return $name;

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

			//$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('name');

            $form_data = array(

				'name' => $this->input->post('name'),

				//'alias' => $alias,

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

				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );

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
		if (!$tid)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('admin/widgets/');
		}

		$isdelete=$this->Widgets_model->deleteItem($tid);
        //$this->Widgets_model->updatetaskcount($pid);
		//delete the item
		if ($isdelete) 
		{
			$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_delete_success') ));	
		}
		else
		{
			$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_delete_failed') ) );
		}	
		redirect('admin/widgets/');
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
			 	$imageorig = FCPATH.'public/default/images/'.$data['file_name'];  
			 			list($width, $height, $type, $attr) = getimagesize($imageorig);
			 		//$fixwidth =341;
			 	 //list($data['width'], $height, $type, $attr) = getimagesize($imageorig);
			 	 $newhgt =  $height / $width * 341;
			 	 

                $status = "success";
          		$msg = "File successfully uploaded";
                $config = array();
        		$config['image_library'] = 'gd2';
        		$config['source_image'] = FCPATH.'public/default/images/'.$data['file_name'];
        		$config['new_image'] =  FCPATH.'public/default/images/'.$data['file_name'];
        		$config['create_thumb'] = TRUE;
        		$config['maintain_ratio'] = FALSE;
        		$config['master_dim'] = 'width';
                $config['width'] = 341;
                $config['height'] = $newhgt;
                $config['x_axis'] = '0';
			    $config['y_axis'] = '0';
        		$config['thumb_marker'] = '';
        		$config['quality'] = 80;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                
                

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
	    echo json_encode(array('filelink' => base_url().'public/default/images/'.$data['file_name']));
	}

	
}

	