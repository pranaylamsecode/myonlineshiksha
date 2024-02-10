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
if($this->config->item('step1','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>
<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
        <div class="popcontent">
        <p class="poptitle"><font color="#6ec218">Greeting!,</font> <font color="#d9534f"><?php echo $sessionarray['email'];  ?></font></p>
        <p class="popwelcome">Welcome to your <font color="#2bc6d8">Institute!</font></p>
        <p>Let me help you, and complete your Institute in less than 5 minutes!</p>
        <p>&nbsp;</p>
        <p class="padleft"><font color="#2bc6d8">Don&acute;t worry, you can edit everything later!</font></p>
        <div class="popbottom">
        <input type="button" value="Let's get started" class="btngreen" onclick='funStep1()' />
        
        <input type="button" value="Skip" class="btnblue" onclick='funSkipStep1()' />
        </div>
        </div>
    </div>
</div>
<?php
}elseif($this->config->item('step2','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{

?>

<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
        <div class="popcontent">
        <p class="poptitle"><font color="#d9534f">Update your Institute Name:</font></p>
        <p>Give your Institute a cool name.</p>
        <input type="text" name="institutename" id='institutename' value="" placeholder="Enter your institute name here..." class="popinput" />
        <div class="popbottom">
        <input type="button" name="updateinstitutename" value="Next" class="btngreen" onclick='funStep2();' />
        <input type="button" value="Skip" class="btnblue" onclick='funSkipStep2()' />
        </div>
        </div>
    </div>
</div>
<?php
}elseif($this->config->item('step3','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>

<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
        <div class="popcontent">
        <p class="poptitle"><font color="#d9534f">Update your Institute logo:</font></p>
        <p>Give your Institute a logo, It&acute;s shows up on top left corner.</p>
        <table>
            <tr>
                <td><div id="previewimage"><img src="images/nologofound.jpg" alt="" /></div></td>
                <td valign="bottom" style="padding: 0 0 0 010px;">
				<input type="file" name='logoimage' id='logoimage' value="Upload Logo" /></td>
				<input type='hidden' name='logoimagename' id='logoimagename' value='' />
            </tr>
        </table>
        <div class="popbottom">
        <input type="button" name='updatelogo' value="Next" class="btngreen" onclick='funStep3()' />
        <input type="button" value="Skip" class="btnblue" onclick='funSkipStep3()' />
        </div>
        </div>
    </div>
</div>
<?php
}elseif($this->config->item('step4','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>

<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
        <div class="popcontent">
        <p class="poptitle"><font color="#d9534f">Update Website Theme:</font></p>
        <p>Here, you can select your Website theme.</p>
        <table cellpadding="0" cellspacing="0" width="100%" class="tabletheme">
          <tr>
            <td><img src="<?php echo base_url(); ?>public/images/theme_default.png" alt="" /><br />Default<br />
			<input type="radio" value="style.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_brown.png" alt="" /><br />Brown<br />
			<input type="radio" value="style_brown.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_dark.png" alt="" /><br />Dark<br />
			<input type="radio" value="style_dark.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_red.png" alt="" /><br />Red<br />
			<input type="radio" value="style_darkorange.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_eastblue.png" alt="" /><br />East Blue<br />
			<input type="radio" value="style_eastblue.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_green.png" alt="" /><br />Green<br />
			<input type="radio" value="style_green.css" name="institutetheme" id='institutetheme' /></td>
          </tr>
        </table>
        <div class="popbottom">
        <input type="button" name="updatetheme" value="Next" class="btngreen" onclick='funStep4()' />
       <input type="button" value="Skip" class="btnblue" onclick='funSkipStep4()' />
        </div>
        </div>
    </div>
</div>
<?php
}elseif($this->config->item('step5','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>

<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
        <div class="popcontent">
        <p class="poptitle"><font color="#d9534f">Update Website Layout:</font></p>
        <p>Here, you can manage your Website's layout as per your requirement.</p>
        <table width="100%" cellpadding="0" cellspacing="0" class="tablelayout">
          <tr>
            <td width="15">Sr.</td>
            <td>Positions</td>
            <td>value</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Position of Top Menu</td>
            <td><input type="radio" checked="checked" name="topmenu" />Left <input type="radio" name="topmenu" />Right</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Position of Search Box</td>
            <td><input type="radio" checked="checked" name="searchbox" />Enable <input type="radio" name="searchbox" />Desable</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Position of SignUp Box</td>
            <td><input type="radio" checked="checked" name="signupbox" />Left <input type="radio" name="signupbox" />Right</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Position of Sidebar</td>
            <td><input type="radio" checked="checked" name="sidebar" />Left <input type="radio" name="sidebar" />Right</td>
          </tr>
        </table>
        <div class="popbottom">
        <input type="submit"  name="updatelayout" value="Next" class="btngreen" onclick='funStep5()' />
        <input type="button" value="Skip" class="btnblue" onclick='funSkipStep5()' />
        </div>
        </div>
    </div>
</div>
<?php
}elseif($this->config->item('step6','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>
<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
	<form id="welcomeform" enctype="multipart/form-data">
        <div class="popcontent">
        <p class="poptitle"><font color="#d9534f">Update Welcome Message Content:</font></p>
        <p>Title</p>
        <input type="text" name="wtitle" id='wtitle' value="" placeholder="Enter welcome message title" class="popinput" />
		<p>Description</p>
		<textarea name='wdesc' id='wdesc'></textarea>
		<p>Image</p>
        <input type="file" name="wimage" id='wimage' />
	    <input type='hidden' name='wimagename' id='wimagename' value='' />
		<div id='previewwelcomeimage'></div>
        <div class="popbottom">
        <input type="button" name="updatewelcomemsg" value="Next" class="btngreen" onclick='updatewelcome_content()' />
        <input type="button" value="Skip" class="btnblue" onclick='funSkipStep6()' />
        </div>
        </div>
	</form>
    </div>
</div>
<?php
}elseif($this->config->item('step7','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4' )
{
?>

<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
	<form id="aboutform" enctype="multipart/form-data">
        <div class="popcontent">
        <p class="poptitle"><font color="#d9534f">Update About Us Content:</font></p>
        <p>Title</p>
        <input type="text" name="atitle" id='atitle' value="" placeholder="Enter title" class="popinput" />
		<p>Description</p>
		<textarea name='adesc' id='adesc'></textarea>
        <div class="popbottom">
        <input type="button" name="updateabtcont" value="Next" class="btngreen" onclick='updateabout_content()' />
        <input type="button" value="Skip" class="btnblue" onclick='funSkipStep7()' />
        </div>
        </div>
	</form>
    </div>
</div>
<?php
}elseif($this->config->item('step8','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>
<div id="mlmspopdiv">
<div class="popoverlay"></div>
<div class="popdiv">
<div class="popcontent">
<p class="poptitle"><font color="#6ec218">Congratulations!,</font> <font color="#d9534f"><?php echo $sessionarray['email']; ?></font></p>
<p class="popwelcome">All changes has been done successfully on your<br /><font color="#2bc6d8"><?php  echo ($getTheme[0]['institute_name']) ? $getTheme[0]['institute_name']:'Demo Institute'; ?>!</font></p>
<!--
<p>if you want to create your institute Courses, simply click below link.</p>
<a href="#" class="poplink">Create Course</a>  -->
<div class="popbottom">
<!--<input type="checkbox" value="" />Do not want this wizard agail! -->
<input type="button" value="Finish" class="btngreen" onclick='funFinish();' />
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

<script>
function funStep1()
{
	location.href="<?php echo base_url();?>category/step1";
}
function funSkipStep1()
{
	location.href="<?php echo base_url();?>category/skipstep1";
}




function funStep2()
 {
	var institutename=$('#institutename').val();
	
	
	$.ajax({

        type: "post",
        url: "<?php echo base_url('category/updateinstname'); ?>",
        data: {institutename:institutename},
        success: function(msg)
        {
			location.href="<?php echo base_url();?>category/step2";
			/*$('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg);

               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */
            }
            else
            {
                $("#ajax").html(msg); 
            } 
        }

    });

 }

function funSkipStep2()
{
	location.href="<?php echo base_url();?>category/skipstep2";
}
 
</script>

<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<script type="text/javascript">
$(function() {
	$('#logoimage').live('change',function(e) {
	 var ftpfilename;

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

			}
		}
		});

	});
	
});
</script>

<script>
function funStep3()
 {
	var logoimagename=$('#logoimagename').val();
	
	
	$.ajax({

        type: "post",
        url: "<?php echo base_url('category/updateinstlogo'); ?>",
        data: {logoimagename:logoimagename},
        success: function(msg)
        {
			location.href="<?php echo base_url();?>category/step3";
			/*$('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg);

               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */
            }
            else
            {
                $("#ajax").html(msg); 
            } 
        }

    });

 }
 
function funSkipStep3()
{
	location.href="<?php echo base_url();?>category/skipstep3";
}
 
 function funStep4()
 {
	var institutetheme=$('#institutetheme').val();
	var institutetheme = $('input[name=institutetheme]');
	var institutethemeval = institutetheme.filter(':checked').val();
	
	$.ajax({

        type: "post",
        url: "<?php echo base_url('category/updatetheme'); ?>",
        data: {institutethemeval:institutethemeval},
        success: function(msg)
        {
			location.href="<?php echo base_url();?>category/step4";
			/*$('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg);

               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */
            }
            else
            {
                $("#ajax").html(msg); 
            } 
        }

    });
	
 }
 
function funSkipStep4()
{
	location.href="<?php echo base_url();?>category/skipstep4";
}

 function funStep5()
 {
	location.href="<?php echo base_url();?>category/step5";
	
 }
 
 function funSkipStep5()
{
	location.href="<?php echo base_url();?>category/skipstep5";
}
 
 $(document).ready(
 function()
 {
	
     $('#wdesc').redactor();
	 $('#adesc').redactor();
 }
 );
 
 
 function updatewelcome_content()
 {

    $.ajax({

        type: "post",
        url: "<?php echo base_url('category/update_process'); ?>",
        data: $("#welcomeform").serialize(),
        success: function(msg)
        {
			location.href="<?php echo base_url();?>category/step6";
			/* $('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg);

                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');
            }
            else
            {
                $("#ajax").html(msg); 
            }
        }

    });

 }
 
function funSkipStep6()
{
	location.href="<?php echo base_url();?>category/skipstep6";
}
 
 function updateabout_content()
 {
 

    $.ajax({

        type: "post",
        url: "<?php echo base_url('category/update_aboutus_process'); ?>",
        data: $("#aboutform").serialize(),
        success: function(msg)
        {
			location.href="<?php echo base_url();?>category/step7";
			/* $('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg);

                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');
            }
            else
            {
                $("#ajax").html(msg); 
            }
        }

    });

 }
 
function funSkipStep7()
{
	location.href="<?php echo base_url();?>category/step7";
}

 function funFinish()
 {
	$.ajax({

        type: "post",
        url: "<?php echo base_url('category/update_finish_process'); ?>",
        success: function(msg)
        {
			location.href="<?php echo base_url();?>category/finish";
			/* $('body,html').animate({ scrollTop: 0 }, 200); */
            if(msg.substring(1,7) != 'script')
            {

                $("#ajax").html(msg);

                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');
            }
            else
            {
                $("#ajax").html(msg); 
            }
        }

    });
	
 }
</script>

</body>

</html>
