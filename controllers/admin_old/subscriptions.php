<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscriptions extends MLMS_Controller 
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
    $this->load->model('admin/subscriptions_model');
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

public function index($user_id = NULL)
{
    
       $this->authenticate();

       $user_id = NULL;

       //$this->session->unset_userdata('sess_usersgroup');

       $this->template->set_layout('backend');
	  
      $this->template->title('Newsletter Subscriptions');

       $sess_usersgroup = $this->session->userdata('sess_usersgroup');

	   	
       //$user_id = NULL;
	
	   $path=base_url() . "admin/subscriptions/index/";

       $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;

       $baseurl = base_url() . "admin/subscriptions/index/";

       $this->load->library('pagination');

       $config["base_url"] = $baseurl;

       $config['per_page'] = 10;

       $config['enable_query_strings'] = true;

       $config['uri_segment'] = 4;

       $config['total_rows'] = $this->subscriptions_model->getPagesCount();   

     

       $this->pagination->initialize($config);
	   
    
		$allpages=$this->subscriptions_model->getPages($user_id,$config['per_page'],$start);
		
		$this->template->set('allpages',$allpages);
		
		$this->template->set("countpages", $this->subscriptions_model->getPagesCount());
		
		$this->template->build('admin/subscriptions/list');
}

public function createPage($parent_id = NULL)
{
	$this->template->set_layout('backend');
	$this->template->title('Create Subscription');
    $this->template->set('updType',"create");
	
    $name=$this->input->post('name');
	$email=$this->input->post('email');
	
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('email', 'Email', 'callback_rolekey_exists');
	//$this->form_validation->set_message('email', 'Email Address Already Exists');

    if ($this->form_validation->run() == FALSE)
	{
	    $this->template->build('admin/subscriptions/create');
	}
	else
	{
	    $session = $this->session->userdata('loggedin');
        $data = array(
		'name' => $name,
    	'email' => $email,
    	'date_time' => date("Y-m-d h:i:s"),
        'userid' => $session['id']
		);

		

		$this->subscriptions_model->insertItems($data);
        $this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
        redirect('admin/subscriptions/');
	}
}

function rolekey_exists($key)
{
	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		$this->db->where('id !=', $_POST['id']);
	}
	$this->db->where('email',$key);
	$query = $this->db->get('mlms_subscriptions');
    if ($query->num_rows() > 0)
    {
   		//return false;
   		$this->form_validation->set_message(__FUNCTION__, 'Email Address Already Exists');
        return FALSE;
    }
    else
    {
        return true;
    } 
}

public function editPage()
{
	$this->template->set_layout('backend');
	$this->template->title('Edit Subscriptions');
	$this->template->set('updType',"edit");
	
	$pid = (($this->uri->segment(4))?($this->uri->segment(4)):($this->input->post('id')));
	$page=$this->subscriptions_model->getPageById($pid);
	$this->template->set('page',$page);
	$this->template->set('id',$pid);
	
    $name=$this->input->post('name');
	$email=$this->input->post('email');
	
	
	$this->form_validation->set_rules('name', 'UserName', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    //$this->form_validation->set_rules('email', 'Email', 'callback_rolekey_exists');
	
	
	
	if ($this->form_validation->run() == FALSE)
	{
			$this->template->build('admin/subscriptions/create');
	}
	else
	{   
		$data = array(
			'name' => $name,
			'email' => $email,
			);
	
		$this->subscriptions_model->updateItem($pid,$data);
		$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
           	redirect('admin/subscriptions/');
    }
}

    public function publish($qid = FALSE)
	{
	    $qid = ($this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/subscriptions/');
		}
		else
		{
			$upd_data = array(
			//'status'=>'active'
			'status'=>'1'
			);
			$in_ids = $qid;
			$publish=$this->Subscriptions_model->publish_unpublishItem($in_ids,$upd_data);
			//Publish the item
			if ($publish)
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => 'Page published successfully!' ));
			}
			else
			{
				$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => 'Page publish action fail or already published!' ) );
			}
			redirect('admin/subscriptions');
		}
	}









    public function unpublish($qid = FALSE)
	{
		$qid = ((int)$this->uri->segment(4) != 0) ? filter_var($this->uri->segment(4), FILTER_VALIDATE_INT) : NULL;
		if (!$qid)
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'Invalid parameters!' ) );
			redirect('admin/subscriptions/');
		}
		else
		{
			$upd_data = array(
			//'status' => 'inactive'
			'status' => '0'
			);
			$in_ids = $qid;
			$unpublish=$this->Subscriptions_model->publish_unpublishItem($in_ids,$upd_data);

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
		  	redirect('admin/subscriptions');
		}
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
			redirect('admin/subscriptions/');
		}

		$isdelete=$this->subscriptions_model->deleteItem($tid);
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
		redirect('admin/subscriptions/');
	}

	public function excelSheet()
    {
    	$this->load->library('PHPExcel');
    	$title = 'List Of subscriptions Email';   	
		
	   	$studData = $this->subscriptions_model->getsubscriptions();	   	
	   
	    	$heading=array('No','Name','Email','date');
	   

	    $this->load->library('PHPExcel');
	    //Create a new Object
	    $objPHPExcel = new PHPExcel();
	    $objPHPExcel->getActiveSheet()->setTitle($title);
	    //Loop Heading
	    $rowNumberH = 1;
	    $colH = 'A';
	    foreach($heading as $h)
	    {
	        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
	        $colH++;    
	    }
	    //Loop Result
	    $totn = count($studData);
	    $maxrow=$totn+1;
	    //$st_Data = $studData->result();
        $row = 2;
        $no = 1;

	      
	        foreach($studData as $n)
	        {
	            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
	            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n['name']);
	            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$n['email']);
	             $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$n['date_time']);
	            // $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$n->email);
	            // $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$n->active);            
	            $row++;
	            $no++;
	        }
	    
	    

	    //Freeze pane
	    $objPHPExcel->getActiveSheet()->freezePane('A2');
	    //Cell Style
	    $styleArray = array(
	        'borders' => array(
	            'allborders' => array(
	                'style' => PHPExcel_Style_Border::BORDER_THIN
	            )
	        )
	    );
	    $objPHPExcel->getActiveSheet()->getStyle('A1:J'.$maxrow)->applyFromArray($styleArray);
	    //Save as an Excel BIFF (xls) file
	    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');	   

	    
	    	$fileName = 'subscriptionsList.xls';
	    

	    header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="'.$fileName.'"');
	    header('Cache-Control: max-age=0');

	    $objWriter->save('php://output');
	    exit();
    }
}

	