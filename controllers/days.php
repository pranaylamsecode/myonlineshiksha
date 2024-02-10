<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require 'vimeoapi/vendor/autoload.php';

class Days extends MLMS_Controller {

	protected $before_filter = array(
		//'action' => 'is_logged_in'
		//'except' => array('index')
		//'only' => array('index')
	);
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate();
		$this->load->model('days_model');		
		$this->lang->load('tooltip', 'english');
		$this->load->model('admin/settings_model');

		$configarr = $this->settings_model->getItems();	
		date_default_timezone_set($configarr[0]['time_zone']);
	}

	function authenticate()
    {
		$session = $this->session->userdata('logged_in');
		if(!$this->session->userdata('logged_in'))
		{
			redirect('users/login');
		}
    }

    public function vimeotest()
    {

    	$url = 'https://myonlineshiksha.com/vimeoapi/getvideos.php';
$data = array('project_id'=>'628460','page'=>'1');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

var_dump($result);

//     	$your_video_id='452570055';
// $access_token='ef7981ec72516a437b83d4a566d2ce9b';



// // $clink = "https://api.vimeo.com/videos/$your_video_id";
// $clink = "https://myonlineshiksha.com/vimeoapi/getvideos.php";
// $data= array('project_id'=>'628460','page'=>'1');
// $curl=curl_init(); 
// curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
// curl_setopt($curl,CURLOPT_URL,$clink);
// curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');

// curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
//     'Content-Type: application/json',                                                                                
//     "Authorization: Bearer $access_token")                                                                       
// );  

// curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
// curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

//  $out = curl_exec($curl); 

// $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
// curl_close($curl);


// var_dump($out);
// echo $status;

// if($status==200){
// echo "video found<br>";
// }else{
// echo "There is an issue. Try Again..<br>";
// }
// $lib = new Vimeo\Vimeo($client_id, $client_secret);

// $lib->setToken('ef7981ec72516a437b83d4a566d2ce9b');
// $response = $lib->request($url, [], 'GET');
// var_dump($response['body']);die();

//     		$page = @$this->input->post('page') ?  @$this->input->post('page') : '1';
// 			// $page = 1;
//   	  	$url='https://myonlineshiksha.com/vimeoapi/getvideos.php'; // Specify your url

// 			// $url='https://vimeoapi.createonlineacademy.com/getvideos.php'; // Specify your url
// 		$data= array('project_id'=>'628460','page'=>$page); // Add parameters in key value

// 		$ch = curl_init(); // Initialize cURL
// 		curl_setopt($ch, CURLOPT_URL,$url);
// 		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 	// // curl_setopt($ch, CURLOPT_PROXY, $proxy); // $proxy is ip of proxy server
// 	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 	// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 	// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
// 	// curl_setopt($ch, CURLOPT_TIMEOUT, 10);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
//     'Content-Type: application/json',                                                                                
//     "Authorization: Bearer $access_token")                                                                       
// ); 
// 	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
// curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);


// 	$result = curl_exec($ch);
// 	curl_close($ch);
// echo "openssl.cafile: ", ini_get('openssl.cafile'), "\n";
// echo "curl.cainfo: ", ini_get('curl.cainfo'), "\n";
// 	// echo"<pre>";
// 	// print_r($result);
// 	echo $result;
    }
	
	public function index($parent_id = NULL)
	{
	   /* $u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid']==4) || ($maccessarr['courses']=='own'))
		{ */
		$configarr = $this->settings_model->getItems();	
		$this->configarr = $configarr;
		$this->template->set_layout($configarr[0]['layout_template']);
		$tmpl = $this->configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		
		$this->template->title('Section Management');
		$parent_id = ($parent_id) ? $parent_id : 0 ;
		if($parent_id!=0)
		{
			$program = $this->days_model->getProgram($parent_id);
			$this->template->set("program", $program);
		}
		$this->template->set("days", $this->days_model->getlistDays($parent_id));
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('days/list');
		/*}
		else 
		{
		     $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not Permission to create' ) );
			redirect('category');
		} */
	}
	
	public function addjumplist($pid = NULL)
	{ 	
		//$this->template->set_layout('backend');
		$this->template->title('Modules List');
		$pid = $this->uri->segment(3);
		$pid = ($pid != 0) ? filter_var($pid, FILTER_VALIDATE_INT) : NULL;
		$pid = ($pid) ? $pid : 0 ;
		$srno = $this->uri->segment(4);
		$srno = ($srno != 0) ? filter_var($srno, FILTER_VALIDATE_INT) : NULL;
		$jumpbutid = $this->uri->segment(5);
		$jumpbutid = ($jumpbutid != 0) ? filter_var($jumpbutid, FILTER_VALIDATE_INT) : NULL;
		if($pid!=0)
		{
			//$program = $this->days_model->getProgram($pid);
			$this->template->set("pid", $pid);
			$this->template->set("jumpbutid", $jumpbutid);
			$this->template->set("butsrno", $srno);
			$this->template->set("jmpbutinfo", $this->days_model->getJumpbutton($jumpbutid));
		}
		$this->template->set("days", $this->days_model->getlistDays($pid));
		$this->template->append_metadata("<script src='js/sortertables.js' type='text/javascript'></script>");
		$this->template->build('days/addjumplist');
	}
	
	function ajaxjumpbutton()
	{
		error_reporting(0);
		$butsrno = $this->input->post('butsrno', TRUE);
		$jump_step = $this->input->post('jump_step', TRUE);
		$jumpbutid = ($this->input->post('jumpbutid', TRUE)) ? $this->input->post('jumpbutid', TRUE) : 0;
		$jumptxt = $this->input->post('jumptxt', TRUE);
		$module_id = $this->input->post('module_id', TRUE);
		$type_selected = $this->input->post('type_selected', TRUE);
		if($jumpbutid != 0){
		$data = array(
				'button' => $butsrno,
				'text' => $jumptxt,
				'jump_step' => $jump_step,
				'module_id' => $module_id,
				'type_selected' => $type_selected
				);
			$this->days_model->updateJumpbutton($data,$jumpbutid);
		}else{
		$data = array(
				'button' => $butsrno,
				'text' => $jumptxt,
				'jump_step' => $jump_step,
				'module_id' => $module_id,
				'type_selected' => $type_selected
				);
			$insertbuttonid = $this->days_model->insertJumpbutton($data);
			echo $insertbuttonid;
		}
	}
	
	function create($parent_id = false) 
	{
	    $u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid']==4) || ($maccessarr['courses']=='own'))
		{ 
		//this code is for adding front end look
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		$this->template->set_layout($configarr[0]['layout_template']);
		$configarr = $this->settings_model->getItems();
		$tmpl = $configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		
		$this->template->append_metadata(block_submit_button());
		
		$parent_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;
		
		$this->template->set('title', lang('web_category_create'));
		$this->template->title("Create Section");
		$this->template->set('updType', 'create');
		$this->template->set('parent_id',$parent_id);
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_rules('title', 'title', 'required');
	   //$this->form_validation->set_rules('access', 'access', 'required');
		
		if ($this->form_validation->run() === false)
		{
			$this->template->build('days/create');
		}
		else
		{
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('title');
			$data = array(
				'pid' => $parent_id,
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'alias' => $alias,
				//'access' => $this->input->post('access'),
				'published' => $this->input->post('published'),
				'ordering' => $this->days_model->maxorder($parent_id),
				'media_id'=>$this->input->post('db_media_1')
			);		
			$modinsertid = $this->days_model->insertItems($parent_id,$data);
				
			// //for media in the section
			// 	$mediamedia = $this->input->post('db_media_1');
			// 	$datatext1 = array(
			// 				'type' => 'mod_m',
			// 				'type_id' => $modinsertid,
			// 				'media_id' => $mediamedia
			// 				);
			// 	$this->days_model->insertItemsRel($datatext1);
			// //for text in the section
			// 	$mediatext = $this->input->post('db_text_1');
			// 	$datatext2 = array(
			// 				'type' => 'mod_t',
			// 				'type_id' => $modinsertid,
			// 				'media_id' => $mediatext
			// 			);
			// 	$this->days_model->insertItemsRel($datatext2);

				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_create_success') ));
				//redirect('days/'.$parent_id);
				$this->load->model('admin/programs_model');
				$coursename5=$this->programs_model->getCoursename5($parent_id);
				$urlCourse5 = strtolower($coursename5->name);			
						$urlCourse5 = trim(str_replace(' ', '-', $urlCourse5));
						$urlCourse5 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse5);
			?>
			<script type="text/javascript">
				// window.parent.location.href = "<?php echo base_url(); ?>days/index/<?php echo $parent_id;?>/";
				window.parent.location.href = "<?php echo base_url(); ?>sections-manage/<?php echo $parent_id;?>/<?php echo $urlCourse5; ?>";
			</script>
			<?php 
		}
	   }
       else
			{
			  $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to Add Section' ));
				redirect('category');
			}
	}

	
	
	function edit($id = FALSE, $parent_id = FALSE) 
	{
	
		$u_data = $this->session->userdata('logged_in');
		$maccessarr=$this->session->userdata('maccessarr');
		if(($u_data['groupid']==4) || ($maccessarr['courses']=='own'))
		{ 
	
		//this code is for adding front end look
		$this->load->model('admin/settings_model');
		$configarr = $this->settings_model->getItems();
		$this->template->set_layout($configarr[0]['layout_template']);
		$configarr = $this->settings_model->getItems();
		$tmpl = $configarr[0]['layout_template'];
		$this->template->set("tmpl", $tmpl);
		
		//load block submit helper and append in the head
		$this->template->append_metadata(block_submit_button());
				
		//Rules for validation
		$this->_set_rules('edit');

		//get the parent id and sanitize
		$parent_id = ( $this->uri->segment(4) )  ? $this->uri->segment(4) : $this->input->post('parent_id', TRUE);
		$parent_id = ($parent_id != 0) ? filter_var($parent_id, FILTER_VALIDATE_INT) : NULL;

		//get the $id and sanitize
		$id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : $this->input->post('id', TRUE);
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;
		//variables for check the upload
		$form_data_aux			= array();
		$files_to_delete 		= array();
		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_object_not_exit') ) );
			redirect('days/'.$parent_id);
		}
		//create control variables
		//$this->template->title(lang("web_category_edit"));
		$this->template->title("Edit Section");
		$this->template->set('day', $this->days_model->getDay($id));
		$this->template->set('updType', 'edit');
		$this->template->set('parent_id', $parent_id);
		$this->template->set('db_media', $this->days_model->getMedia_oflayout('mod_m',$id));
		$this->template->set('db_mediatext', $this->days_model->getMedia_oflayout('mod_t',$id));
		
		$this->form_validation->set_rules('title', 'title', 'required');
		//$this->form_validation->set_rules('description', 'description', 'required');
		//$this->form_validation->set_rules('category_id', 'category_id', 'required');
		
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			//load the view and the layout
			$this->template->build('days/create');
		}
		else
		{	
			$alias = ($this->input->post('aliase'))?$this->input->post('aliase'):$this->input->post('title');
			$form_data = array(
				'pid' => $parent_id,
				'title' => $this->input->post('title'),
				//'access' => $this->input->post('access'),
				'description' => $this->input->post('description'),
				'alias' => $alias,
				'published' => $this->input->post('published'),
				'media_id' => $this->input->post('db_media_1')
			);
			// $mediamedia = $this->input->post('db_media_1');
			// 					$datatext = array(
			// 					'media_id' => $mediamedia
			// 					);
			// $this->days_model->updateMediarel($id,$datatext,'mod_m');
			
			// $mediatext = $this->input->post('db_text_1');
			// 					$datatext = array(
			// 					'media_id' => $mediatext
			// 					);
			// $this->days_model->updateMediarel($id,$datatext,'mod_t');
			
			$isupdated=$this->days_model->updateItem($id,$form_data);

						$this->load->model('admin/programs_model');
						$coursename=$this->programs_model->getCoursename5($parent_id);			

						$urlCourse = strtolower($coursename->name);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

			if ($isupdated) // the information has therefore been successfully saved in the db
			{
				$this->session->set_flashdata('message', array( 'type' => 'success', 'text' => lang('web_edit_success') ));
				//redirect('admin/days/'.$parent_id);
				?>
         <script type="text/javascript">
         // window.parent.location.href = "<?php echo base_url(); ?>days/<?php echo $parent_id;?>/";
          window.parent.location.href = "<?php echo base_url(); ?>sections-manage/<?php echo $parent_id;?>/<?php echo $urlCourse; ?>";
         </script>
         <?php 
			}
			else{
				//$this->session->set_flashdata('message', array( 'type' => 'error', 'text' => lang('web_edit_fail') ) );
				//redirect('admin/days/'.$parent_id);	
				?>
         <script type="text/javascript">
         window.parent.location.href = "<?php echo base_url(); ?>sections-manage/<?php echo $parent_id;?>/<?php echo $urlCourse; ?>";
         </script>
         <?php 
			}	
	  	} 
	   }
	   else 
	   {
	     $this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'You have not permission to Edit Section' ) );
				redirect('category');	
	   }
	}
	
	function delete($id = NULL,$parent_id = FALSE)
	{
		//filter & Sanitize $id
		$id = ($id != 0) ? filter_var($id, FILTER_VALIDATE_INT) : NULL;

		//redirect if it´s no correct
		if (!$id){
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This Module has lessons!' ) );
			redirect('days/');
		}
		
		//search child items count
		
		elseif($this->days_model->getLessonNew($id))// ( $this->days_model->getchildcount($id) )
		{
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => 'This Section has Lecture!' ) );
			//redirect('days/'.$parent_id);

			$this->load->model('admin/programs_model');
						$coursename=$this->programs_model->getCoursename5($parent_id);			

						$urlCourse = strtolower($coursename->name);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
						redirect('sections-manage/'.$parent_id.'/'.$urlCourse);
		}
		
		$isdelete = $this->days_model->deleteItem($id);	
		
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
			//redirect('days/'.$parent_id);
		$this->load->model('admin/programs_model');
						$coursename=$this->programs_model->getCoursename5($parent_id);			

						$urlCourse = strtolower($coursename->name);			
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
						redirect('sections-manage/'.$parent_id.'/'.$urlCourse);

	}

	function sortingorder_old()
	{
		$ordering =$_POST['sortedIDs'];
		//echo count($ordering);
		$orderNo =1;
		foreach ($ordering as $key => $value)
		 {
		 	 $keyvalue = explode("_",$value);
			// echo $keyvalue[1];
			$data = array(
				'ordering' =>$orderNo, 
				);
		$isupdated = $this->days_model->orderingUpdate($keyvalue[1],$data);
		echo $isupdated;
		 $orderNo++;
		 }
	}

	function sortingorder()
	{
		$ordering =$_POST['lectureSortIDS'];
		$sectionOrdering =$_POST['sectionSortIDS'];
		$sectionSorting =$_POST['sectionSorting'];		
		 	
		
		if($sectionOrdering)
		{
			foreach ($sectionOrdering as $key => $section)
			{			
				$orderNo =1;
				
				foreach ($ordering[$key] as $value)
					{
						$keyvalue = explode("_",$value);					

						$data = array(
							'ordering' =>$orderNo, 
					 		);					

						$this->days_model->orderingUpdate($keyvalue[1],$data);
						
						$data1 = array(
							'section_id' =>$section, 
							);
						$isupdated = $this->days_model->relationUpdate($keyvalue[0],$keyvalue[1],$data1);
						//echo $isupdated;

						 	$orderNo++;

					}	
						
		 	}
	    }

	 	$orderNo1 =1;
	 	if($sectionSorting)
	 	{
			 	foreach ($sectionSorting as $key => $sectionsorted)
				{
				 	foreach ($sectionsorted as $sss)
						{
							$keyvalue = explode("_",$sss);	

							$data = array(
							'ordering' =>$orderNo1, 
							);

							$this->days_model->sortingsection($keyvalue[1],$data);	 	       

				 	       $orderNo1++;
						}	 	
					
			    	
			    }
	    }

	    
	}

	function relationUpdate()
	{
		$eleId =$_POST['eleId'];
		$parent_id =$_POST['parent_id'];		
		
		$keyvalue = explode("_",$eleId);
			// echo $keyvalue[0];
			 //echo $keyvalue[1];			
			
			$data = array(
				'section_id' =>$parent_id, 
				);
		$isupdated = $this->days_model->relationUpdate($keyvalue[0],$keyvalue[1],$data);
		echo $isupdated;
		 
	}

	function sortingsection()
	{
		$ordering =$_POST['sortedIDs'];		
		$orderNo =1;
		foreach ($ordering as $key => $value)
		 {
		 	 $keyvalue = explode("_",$value);
			 //echo $keyvalue[1];
			
			$data = array(
				'ordering' =>$orderNo, 
				);
		$isupdated = $this->days_model->sortingsection($keyvalue[1],$data);
		echo $isupdated;
		 $orderNo++;
		 }
	}

}
	