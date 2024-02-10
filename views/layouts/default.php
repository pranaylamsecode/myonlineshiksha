<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 

<?php
  $CI =& get_instance();
  $CI->load->model('admin/settings_model'); 
  $getTheme = $CI->settings_model->getItems();
  //$CI->config->load('installation_config');
  
  //print_r($getTheme);
  
  $themestylecss = $getTheme[0]['layouttheme'];
  $pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
  $CI->load->model('program_model'); 
  $getProgram = $CI->program_model->getProgram($pro_id);  
  $meta_title = (isset($getProgram->metatitle) && trim($getProgram->metatitle)!= '') ? trim($getProgram->metatitle) : "MLMS";
  $meta_keyword = (isset($getProgram->metakwd) && trim($getProgram->metakwd)!= '') ? trim($getProgram->metakwd) : "MLMS";
  $meta_description = (isset($getProgram->metadesc) && trim($getProgram->metadesc)!= '') ? trim($getProgram->metadesc) : "MLMS Institute"; 
  
  extract($getTheme[0]);
  $signup = json_decode($psgspage);
  $sigup_pos = $signup->courses_image_alignment;
  $signup_box_pos = ($sigup_pos == 0) ? "signup_box_left" : "signup_box_right";
  $sidebar = json_decode($psgpage);
  $sidebar_pos = $sidebar->course_image_alignment;
  $sidebarpos = ($sidebar_pos == 0) ? "sidebar_left" : "sidebar_right";
 //print_r($sidebar->course_image_alignment);
 // $sigup_pos = $signup->courses_image_alignment);
  // $menu_layout = $menulayout->ctgs_image_alignment;
 // $searchbox_val = $searchbox->ctg_image_alignment;

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  	<title><?php //echo $template['title'];
	echo $getTheme[0]['institute_name'];
	?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv='expires' content='1200' />
	<meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />	
	<meta name="keywords" content="<?php echo $meta_keyword; ?>"/>
	<meta name="description" content="<?php echo $meta_description; ?>" />
	<meta name="generator" content="<?php echo $meta_title; ?>" />
	
    <script src="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>css/bstyles.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>css/colour_standard.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>css/front_style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php echo $tmpl."/"?>css/<?php echo $themestylecss;?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/redactor/css/redactor.css" />
    <script src="<?php echo base_url(); ?>public/js/redactor/redactor.js"></script>
	<?php echo $template['metadata']; ?>

	
	
</head>
<body class="<?php echo $template['title'];?>">
<?php
$sessionarray = $this->session->userdata('logged_in');
//print_r($sessionarray);
//print_r($this->config->item('steps'));
//print_r($this->config->item('stepsstatus'));
if((!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>
<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv" style="min-height: 215px;">
        <div class="popcontent">
        <p class="poptitle"><font color="#6ec218">Greeting!,</font> <font color="#d9534f"><?php echo $sessionarray['email'];  ?></font></p>
        <p class="popwelcome">Welcome to your <font color="#2bc6d8">Institute!</font></p>
        <p>Let me help you, and complete your Institute in less than 5 minutes! </p>
        <p class="padleft"><font color="#2bc6d8">Please log in by click on "Admin Panel" button.</font></p>
        <div class="popbottom" style="margin:20px 190px;">
        <a href="<?php echo base_url();?>/admin" class="btngreen" >Admin Panel</a>
        
       
        </div>
        </div>
    </div>
</div>
<?php
}
?>
<input type="hidden" id="baseurlfld" name="baseurlfld" value="<?php echo base_url();?>">

<?php //print_r($this->config); ?>
<div id="headernav">
    <?php $this->load->view('template/'.$tmpl.'/header');?>
</div>
<?php if(isset($home)){?>
<div id="bannerdiv">
    <div id="bannerinn">
    <div id="bannercont">
        <div class="leftpanel">
        <?php $this->load->view('template/'.$tmpl.'/banner');?>
		</div>
        <div class="rightpanel <?php echo $signup_box_pos;?>">
            <h2>Login With Facebook</h2>
            <?php $this->load->view('template/'.$tmpl.'/signup');?>
        </div>
    </div>
    </div>
</div>
<?php } ?>
<div id="search-busy">
    <div id="search-inner"></div>
</div>
<!--<?php if(isset($home)){?>
<div id="slidernav">
  <div id="slider">
  <a href="<?php //echo base_url(); ?>"><img border="0" alt="" src="<?php //echo base_url(); ?>public/<?php //echo $tmpl?>/images/slider1.png"></a>
  </div>
</div>
<?php } ?>-->
<!--<div id="welcomenav">
  <div id="welcome">
    <div class="icon_rss">
    <img border="0" alt="" src="<?php //echo base_url(); ?>public/<?php //echo $tmpl?>/images/icon_rss.png">
    </div>
    <div class="wel_title">
        Welcome to <span>mLMS</span> the e-learning website!
    </div>
    <div class="pricing">
        <a href="index.html"><span>See Pricing</span></a>

    </div>
  </div>
</div>-->
<div id="middlenav">
  <div id="middle">
    <div id="courses">
<?php if(isset($home)){?>
        <div class="leftcontent">
        <?php $this->load->view('template/'.$tmpl.'/aboutus');?> 
        </div>
        <div class="contentright <?php echo $sidebarpos;?>">
        <div class="rightsidebar">
        <?php $this->load->view('template/'.$tmpl.'/testimonial');?>
        </div>
        </div>
<?php } ?>
		<?php $this->load->view('/template/'.$tmpl.'/partials/_flashdata');?>
        <?php echo $template['body']; ?>
    </div>
  </div>
</div>
<div id="footernav">
 <?php $this->load->view('template/'.$tmpl.'/footer');?>
</div>



<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<script type="text/javascript">
$(function() {
	$('#logoimage').live('change',function(e) {
	 var ftpfilename;	
	 filenameerror = '';

		$.ajaxFileUpload({
		url :'<?php echo base_url(); ?>category/upload_image/',
		secureuri :false,
		fileElementId :'logoimage',
		dataType : 'json',
		success : function(data,status)
		{
              $('#ajax11').html(data.msg);
		   if(data.status == 'success')
		   {

			ftpfilpreview = '<img src="<?php echo base_url(); ?>public/uploads/settings/img/'+data.filename+'" width="164px" height="44px">';
			$('#previewimage').html(ftpfilpreview);
			ftpfilename = data.filename;
			document.getElementById("logoimagename").value = ftpfilename;
			$('#logouplaoderror').html('');
			}else{
			ftpfilename = data.filename;
			document.getElementById("logoimagename").value = ftpfilename;
			if(ftpfilename==''){
			filenameerror = '';
			}
			$('#logouplaoderror').html('<span class="error">'+data.msg+'</span>');
			}
		}
		});

	});
	
	
	$('#wimage').live('change',function(e) {
	 var ftpfilename;

		$.ajaxFileUpload({
		url :'<?php echo base_url(); ?>category/upload_welcome_image/',
		secureuri :false,
		fileElementId :'wimage',
		dataType : 'json',
		success : function(data,status)
		{

              $('#ajax11').html(data.msg);
		   if(data.status == 'success')
		   {

			ftpfilpreview = '<img src="<?php echo base_url(); ?>public/uploads/settings/img/'+data.filename+'" width="164px" height="44px">';
			$('#previewwelcomeimage').html(ftpfilpreview); 
			ftpfilename = data.filename;
			document.getElementById("wimagename").value = ftpfilename;
			$('#wimageerror').html('');

			}else{
			ftpfilename = data.filename;
			document.getElementById("wimagename").value = ftpfilename;
			if(ftpfilename==''){
			filenameerror = '';
			}
			$('#wimageerror').html('<span class="error">'+data.msg+'</span>');
			}
		}
		});

	});
	
});
</script>

<script>

 
 $(document).ready(
 function()
 {
	
     $('#wdesc').redactor();
	 $('#adesc').redactor();
 }
 );
 

 

 
</script>

</body>

</html>
