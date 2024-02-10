<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smartcoursemanager extends MLMS_Controller {

	protected $before_filter = array(
	   //	'action' => 'is_logged_in',
		//'except' => array('index')
		//'only' => array('index')
	);
	
	function __construct()
	{
		parent::__construct();
        $this->authenticate();
		$this->template->set_layout('backend');
        $this->config->load('installation_config');
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

	public function index()
	{
		/*if(!$this->user)
		{
			//set message 
			$this->session->set_flashdata('message', array( 'type' => 'warning', 'text' => lang('web_not_logged') ) );
			
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}  */

        /** V **/
        $user_data=$this->session->userdata('loggedin');

        $this->template->set('user_data',$user_data);
        /** E V **/

		/*create control variables */
	   	$this->template->title('Smart Course Manager Wizard');
		echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style type="text/css">
body { margin: 0; overflow-x: hidden; font-family: Arial; font-size: 12px; }
iframe { min-height: 800px; margin: 64px 0 0 0; }
.titlesmt { background-color: #E1F3C1; padding: 0 .5%; border: 1px solid #CEE89E; font-size: 14px; font-weight: 700; margin: 0; position: fixed; width: 99%; }
.pagismt { float: right; }
#titlewizard { font-weight: normal; margin: 5px 0 0 0; font-size: 14px; }
.maindivtitle { display: inline-block; width: 100%; }
.wclose { color: #ff0000; text-decoration: none; float: right; }
.pagismt a { font-weight: 700; background-color: #000; color: #fff; padding: 2px 10px; font-size: 12px; border-radius: 3px; display: block;  text-decoration: none; display: inline-block; }
.pagismt a:hover { text-decoration: underline; }
.titlesmt .descriptionsmt {
    <!--background: none repeat scroll 0 0 #B5E5EF; -->
    <!--border: 1px solid #77BACE;-->
    border-collapse: collapse;
    border-radius: 5px; font-weight: normal;
    font-size: 12px;
    height: auto;
    margin: 0px 0 5px 0;
   <!-- padding: 10px;--> font-weight: normal;
}
</style>
</head>
<body>';?>
<script>
		function keybyvalue(arrayname,arraykeyvalue)
		{
			for (var k=0;k<arrayname.length;k++)
			{			
				if(arrayname[parseInt(k)] == arraykeyvalue)
				{
				return parseInt(k)+1;
				}
			}
		}
		function iframelink(){		
		var nextvalue = '';
		var frameurl = window.smartcourseframe.location.href;
		var segarray = frameurl.split('/');
		var segments = new Array();
		var currvalue = '';
		
		var y = 0;
		var linksarray = new Array();
		linksarray[0] = "subplans";				
		linksarray[1] = "mcategories";				
		linksarray[2] = "medias";
		linksarray[3] = "pcategories";
		linksarray[4] = "programs";
		linksarray[5] = "quizzes";
		var i = 0;
		segarray.forEach(function (item) {
		segments[i] = item;
		if(item == 'admin'){
			y = i+1;
			  }
			  i++;
			})
			
			currvalue = segments[y]; 
			if((currvalue != 'subplans') && (currvalue != 'pcategories') && (currvalue != 'mcategories') && (currvalue != 'medias') && (currvalue != 'programs')){
			window.location.href = '<?php echo base_url();?>admin/';
			}
			nextvalue = linksarray[keybyvalue(linksarray,currvalue)];
			if(keybyvalue(linksarray,currvalue)>linksarray.length){
			nextvalue = 'smartcoursemanager/finishcoursecreate';
			document.getElementById("descriptionsmtid").innerHTML='Course Creation Finished';
			document.getElementById("pagismtid").innerHTML='<a href="<?php echo base_url()?>admin">Finish Wizard<a>';
			}
			if(nextvalue == 'subplans'){
			
			document.getElementById("descriptionsmtid").innerHTML='This step will allow you to create plans for students to choose on different courses which you be creating in next step. You can edit the already added Plans.';
			document.getElementById("wizardtitle").innerHTML='STEP 1: Add Subscription Plans';
			
			}else if(nextvalue == 'pcategories'){
			
			document.getElementById("descriptionsmtid").innerHTML='Add / Edit / Delete Course Categories here.';
			document.getElementById("wizardtitle").innerHTML='STEP 4: Manage Course Category';
			
			}else if(nextvalue == 'programs'){
			
			document.getElementById("descriptionsmtid").innerHTML='Add / Edit / Delete Course Categories here. You can manage section and lessions by clicking on course name. Also You can Add Webinar here';
			document.getElementById("wizardtitle").innerHTML='STEP 5: Manage Courses';
			
			}else if(nextvalue == 'mcategories'){
			
			document.getElementById("descriptionsmtid").innerHTML='Add / Edit / Delete Media Categories here.';
			document.getElementById("wizardtitle").innerHTML='STEP 2: Manage Media / Course Materials Category';
			
			}else if(nextvalue == 'medias'){
			
			document.getElementById("descriptionsmtid").innerHTML='Add / Edit / Delete Medias here.';
			document.getElementById("wizardtitle").innerHTML='STEP 3: Manage Media / Course Materials';
			
			}else if(nextvalue == 'quizzes'){						document.getElementById("descriptionsmtid").innerHTML='You Can Add / Edit / Delete Exam here.';			document.getElementById("wizardtitle").innerHTML='STEP 6: Manage Exam Paper Materials';						}/**//**/
			
			window.smartcourseframe.location.href = '<?php echo base_url();?>admin/'+nextvalue;
		/*window.smartcourseframe.location.href = '<?php echo base_url();?>admin/subplans'; alert(var frameurl = window.smartcourseframe.location.href);
		 window.smartcourseframe.location.href = '<?php echo base_url();?>admin/pcategories';//console.log(entry);
		 window.smartcourseframe.location.href = '<?php echo base_url();?>admin/programs';
		 window.smartcourseframe.location.href = '<?php echo base_url();?>admin/mcategories';
		 window.smartcourseframe.location.href = '<?php echo base_url();?>admin/medias';*/
		 
		}
</script>
		<?php
		echo '
			<div class="titlesmt"><span id="wizardtitle">STEP 1: Add Subscription Plans </span><span><a href="'.base_url().'admin" title="Close Wizard" class="wclose">Close Wizard</a></span><div id="titlewizard">Smart Course Manager Wizard <span class="pagismt"><a href="javascript:void(0)" onclick="javascript:iframelink();">Next Step</a></span> </div><div class="maindivtitle"> </div>
			<div id="descriptionsmtid" class="descriptionsmt">Here&acute;s where you set up subscription plans for your courses. You can keep the default plans or create new ones</div>
			</div>';
		echo '<iframe name="smartcourseframe" src="'.base_url().'admin/subplans" width="100%" height="100%"></iframe>';
		echo '</body></html>';

		/* load the view 
		$this->template->build('admin/index');*/
	}
	
	public function finishcoursecreate()
	{
		echo 'Smart Course Manager Wizard Finished';
	}
}