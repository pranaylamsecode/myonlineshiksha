<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title><?php echo $template['title'];?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv='expires' content='1200' />
  <meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />
  <meta content="" name="generator">

  <!--<base href="<?php echo $this->config->item('base_url') ?>/public/" />-->

  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"); ?>" id="style-resource-1">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/font-icons/entypo/css/entypo.css"); ?>" id="style-resource-2">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" id="style-resource-3">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/neon-theme.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/css/neon-core.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/css/skins/white.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/css/neon-forms.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-min.css"); ?>" id="style-resource-4">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/neon-core-min.css"); ?>" id="style-resource-5">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/neon-theme-min.css"); ?>" id="style-resource-6">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/neon-forms-min.css"); ?>" id="style-resource-7">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/custom-min.css"); ?>" id="style-resource-8">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/skins/white.css"); ?>" id="style-resource-9">
  <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.0.min.js"); ?>"></script>
  <script>$.noConflict();</script>
  <?php //echo $template['metadata']; ?>

  <!--wizard script-->

  <script type="text/javascript">

function funStep1(){

	location.href="<?php echo base_url();?>admin/admin/step1";

	}

function funSkipStep1(){

	location.href="<?php echo base_url();?>admin/admin/skipstep1";}

function funStep2() {	var institutename=$('#institutename').val();	if(institutename==''){	$('#institutenameerror').html('<span class="error">Institute name field is required!</span>');	return false;			}			$.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/updateinstname'); ?>",        data: {institutename:institutename},        success: function(msg)        {			location.href="<?php echo base_url();?>admin/admin/step2";			/*$('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */            }            else            {                $("#ajax").html(msg);             }         }    }); }

function funSkipStep2(){	location.href="<?php echo base_url();?>admin/admin/skipstep2";} function funStep3(){	var logoimagename=$('#logoimagename').val();	if(logoimagename == ''){	$('#logouplaoderror').html('<span class="error">Please upload Logo.</span>');	return false;	}			$.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/updateinstlogo'); ?>",        data: {logoimagename:logoimagename},        success: function(msg)        {			location.href="<?php echo base_url();?>admin/admin/step3";			/*$('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */            }            else            {                $("#ajax").html(msg);             }         }    }); }  function funSkipStep3(){	location.href="<?php echo base_url();?>admin/admin/skipstep3";}

function funStep4() {

  var institutetheme=$('#institutetheme').val();

  var institutetheme = $('input[name=institutetheme]');

  var institutethemeval = institutetheme.filter(':checked').val();

  	$.ajax({

  	       type: "post",

           url: "<?php echo base_url('admin/admin/updatetheme'); ?>",

           data: {institutethemeval:institutethemeval},

           success: function(msg){

             		location.href="<?php echo base_url();?>admin/admin/step4";

                    /*$('body,html').animate({ scrollTop: 0 }, 200); */

                      if(msg.substring(1,7) != 'script'){

                                        $("#ajax").html(msg);

                                        /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */

                        }else{

                                         $("#ajax").html(msg);

                        }}

                        });

}



                         function funSkipStep4(){	location.href="<?php echo base_url();?>admin/admin/skipstep4";}

function funStep5()

{



    $.ajax({

  	       type: "post",

           url: "<?php echo base_url('admin/admin/updatelayout_process'); ?>",

           data: $("#updatelayoutthemefrm").serialize(),

           success: function(msg){

             		location.href="<?php echo base_url();?>admin/admin/step5";

                    /*$('body,html').animate({ scrollTop: 0 }, 200); */

                      if(msg.substring(1,7) != 'script'){

                                        $("#ajax").html(msg);

                                        /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */

                        }else{

                                         $("#ajax").html(msg);

                        }}

                        });

  //location.href="<?php echo base_url();?>admin/admin/step5";
}

function funSkipStep5(){

  location.href="<?php echo base_url();?>admin/admin/skipstep5";}    function funStep6() {	var wtitle = $("#wtitle").val();	if(wtitle ==''){	$('#wtitleerror').html('<span class="error">Welcome title is required!</span>');	return false;		}else{	$('#wtitleerror').html('');	}	var wdesc = $("#wdesc").val();	if(wdesc ==''){	$('#wdescerror').html('<span class="error">Welcome description field is required!</span>');	return false;		}else{	$('#wdescerror').html('');	}	    $.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/update_process'); ?>",        data: $("#welcomeform").serialize(),        success: function(msg)        {			location.href="<?php echo base_url();?>admin/admin/step6";			/* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    }); } function funSkipStep6(){	location.href="<?php echo base_url();?>admin/admin/skipstep6";}     function funStep7() {	var atitle = $("#atitle").val();	if(atitle ==''){	$('#atitleerror').html('<span class="error">Welcome title is required!</span>');	return false;		}else{	$('#atitleerror').html('');	}	var adesc = $("#adesc").val();	if(adesc ==''){	$('#adescerror').html('<span class="error">Welcome description field is required!</span>');	return false;		}else{	$('#adescerror').html('');	}    $.ajax({         type: "post",        url: "<?php echo base_url('admin/admin/update_aboutus_process'); ?>",        data: $("#aboutform").serialize(),        success: function(msg)        {			location.href="<?php echo base_url();?>admin/admin/step7";			/* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    }); }  function funSkipStep7(){	location.href="<?php echo base_url();?>admin/admin/skipstep7";}   function updatecontact_content() {	var address = $("#address").val();	if(address ==''){	$('#addresserror').html('<span class="error">Address is required!</span>');	return false;		}else{	$('#address').html('');	}			var phone = $("#phone").val();	if(phone ==''){	$('#phoneerror').html('<span class="error">Phone field is required!</span>');	return false;		}else{	$('#phone').html('');	} 		var email = $("#email").val();	if(email ==''){	$('#emailerror').html('<span class="error">Email field is required!</span>');	return false;		}else{	$('#email').html('');	}		var web = $("#web").val();	if(web ==''){	$('#weberror').html('<span class="error">Web field is required!</span>');	return false;		}else{	$('#web').html('');	}	var mapcode = $("#mapcode").val();	if(mapcode ==''){	$('#mapcodeerror').html('<span class="error">Map Code field is required!</span>');	return false;		}else{	$('#mapcode').html('');	}	    $.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/update_contact_process'); ?>",        data: $("#contactform").serialize(),        success: function(msg)        {			location.href="<?php echo base_url();?>admin/admin/step8";			/* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    }); }   function funSkipStep8(){	location.href="<?php echo base_url();?>admin/admin/skipstep8";}function funFinish() {	$.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/update_finish_process'); ?>",        success: function(msg)        {			location.href="<?php echo base_url();?>admin/admin/finish";			/* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    });	 }</script><!--wizard script closed-->

  </head>

  <body class="page-body skin-white page-left-in" data-url="http://demo.neontheme.com" cz-shortcut-listen="true">
<?php

$sessionarray = $this->session->userdata('loggedin');
$user_id = $sessionarray['id'];

  $CI =& get_instance();

  $CI->load->model('admin/settings_model'); 

  $getTheme = $CI->settings_model->getItems();
  $getImage = $CI->settings_model->getUserImage($user_id);
  $my_image = $getImage[0]->images;
  
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
        <div id="institutenameerror"></div>
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
            <td valign="bottom" style="padding: 0 0 0 010px;"><input type="file" name='logoimage' id='logoimage' value="Upload Logo" /></td>
            <input type='hidden' name='logoimagename' id='logoimagename' value='' />
          </tr>
        <tr>
            <td colspan="2"><div id='logouplaoderror'></div></td>
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
            <td><img src="<?php echo base_url(); ?>public/images/theme_default.png" alt="" /><br />
            Default<br />
            <input type="radio" value="style.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_brown.png" alt="" /><br />
            Brown<br />
            <input type="radio" value="style_brown.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_dark.png" alt="" /><br />
            Dark<br />
            <input type="radio" value="style_dark.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_red.png" alt="" /><br />
            Red<br />
            <input type="radio" value="style_darkorange.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_eastblue.png" alt="" /><br />
            East Blue<br />
            <input type="radio" value="style_eastblue.css" name="institutetheme" id='institutetheme' /></td>
            <td><img src="<?php echo base_url(); ?>public/images/theme_green.png" alt="" /><br />
            Green<br />
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
        <form name="updatelayoutthemefrm" id='updatelayoutthemefrm'>
        <table width="100%" cellpadding="0" cellspacing="0" class="tablelayout">
            <tr>
            <td width="15">Sr.</td>
            <td>Positions</td>
            <td>value</td>
          </tr>
            <tr>
            <td>1</td>
            <td>Position of Top Menu</td>
            <td><input type="radio" checked="checked" name="topmenu" value='0' checked="checked" />
                Left
                <input type="radio" name="topmenu" value='1'  />
                Right</td>
          </tr>
            <tr>
            <td>2</td>
            <td>Position of Search Box</td>
            <td><input type="radio" checked="checked" name="searchbox" value="0" checked="checked" />
                Enable
                <input type="radio" name="searchbox" value="1" />
                Disable</td>
          </tr>
            <tr>
            <td>3</td>
            <td>Position of SignUp Box</td>
            <td><input type="radio" checked="checked" name="signupbox" value='0' checked="checked" />
                Left
                <input type="radio" name="signupbox" value='1' />
                Right</td>
          </tr>
            <tr>
            <td>4</td>
            <td>Position of Sidebar</td>
            <td><input type="radio" checked="checked" name="sidebar" value='0' checked="checked" />
                Left
                <input type="radio" name="sidebar" value='1' />
                Right</td>
          </tr>
          </table>
      </form>
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
        <p id="wtitleerror"></p>
        <p>Description</p>
        <textarea name='wdesc' id='wdesc'></textarea>
        <p id="wdescerror"></p>
        <p>Image</p>
        <input type="file" name="wimage" id='wimage' />
        <p id="wimageerror"></p>
        <input type='hidden' name='wimagename' id='wimagename' value='' />
        <div id='previewwelcomeimage'></div>
        <div class="popbottom">
            <input type="button" name="updatewelcomemsg" value="Next" class="btngreen" onclick='funStep6()' />
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
        <p id="atitleerror"></p>
        <p>Description</p>
        <textarea name='adesc' id='adesc'></textarea>
        <p id="adescerror"></p>
        <div class="popbottom">
            <input type="button" name="updateabtcont" value="Next" class="btngreen" onclick='funStep7()' />
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
    <form id="contactform" enctype="multipart/form-data">
        <div class="popcontent">
        <p class="poptitle"><font color="#d9534f">Contact Us Detail :</font></p>
        <p>Address </p>
        <textarea name="address" id='address'></textarea>
        <p id="addresserror"></p>
        <p>Phone </p>
        <input type="text" name='phone' id='phone' />
        <p id="phoneerror"></p>
        <p>Email </p>
        <input type="text" name='email' id='email' />
        <p id="emailerror"></p>
        <p>Web </p>
        <input type="text" name='web' id='web' />
        <p id="weberror"></p>
        <p>Map Code </p>
        <textarea id="mapcode" name="mapcode"></textarea>
        <p id="mapcodeerror"></p>
        <div class="popbottom">
            <input type="button" name="updatecontactcont" value="Next" class="btngreen" onclick='updatecontact_content()' />
            <input type="button" value="Skip" class="btnblue" onclick='funSkipStep8()' />
          </div>
      </div>
      </form>
  </div>
  </div>
<?php

}elseif($this->config->item('step9','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')

{

?>
<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv">
    <div class="popcontent">
        <p class="poptitle"><font color="#6ec218">Congratulations!,</font> <font color="#d9534f"><?php echo $sessionarray['email']; ?></font></p>
        <p class="popwelcome">All changes has been done successfully on your<br />
        <font color="#2bc6d8">
          <?php  echo ($getTheme[0]['institute_name']) ? $getTheme[0]['institute_name']:'Demo Institute'; ?>
          !</font></p>
        
        <!--

<p>if you want to create your institute Courses, simply click below link.</p>

<a href="#" class="poplink">Create Course</a>  -->
        
        <div class="popbottom"> 
        
        <!--<input type="checkbox" value="" />Do not want this wizard agail! -->
        
        <input type="button" value="Start Smart Course Manager Wizard" class="btngreen" onclick='funFinish();' />
      </div>
      </div>
  </div>
  </div>
<?php
}
?>
<div class="page-container">
    <div class="sidebar-menu" style="min-height: 1409px;">
    <header class="logo-env" style="background-color: rgba(207, 207, 207, 0.61);"> 
        
        <!-- logo -->
        <div class="logo"> <a href="#"> <img src="http://216.185.43.221/prshah8333/public/img/admin/logo.png" alt=""> </a> </div>
        
        <!-- logo collapse icon -->
        
        <div class="sidebar-collapse"> <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
          <i class="entypo-menu"></i> </a> </div>
        
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs"> <a href="#" class="with-animation"><!-- add class "with-animation" to support animation --> 
          <i class="entypo-menu"></i> </a> </div>
      </header>
    <div class="sidebar-user-info">
        <div class="sui-normal"> <a href="#" class="user-link"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $my_image;?>" alt="" class="img-circle" width='44'> <span>Welcome,</span> <strong><?php echo ucfirst($this->session->userdata['loggedin']['first_name']);?></strong> </a> </div>
        <div class="sui-hover inline-links animate-in"> <a href="#"> <i class="entypo-pencil"></i> New Page </a> <a href="#"> <i class="entypo-mail"></i> Inbox </a> <a href="<?php echo base_url(); ?>admin/users/logout"> <i class="entypo-lock"></i> Log Off </a> <span class="close-sui-popup">×</span> </div>
      </div>
    <ul id="main-menu" class="main-menu" style="">
        <li id="search" class="root-level">
        <form method="get" action="">
            <input type="text" name="q" class="search-input" placeholder="Search something...">
            <button type="submit"><i class="entypo-search"></i></button>
          </form>
		</li>
        <?php
$u_data=$this->session->userdata('loggedin');
if(($u_data['groupid']=='4') || (in_array('users',$this->session->userdata('mparr'))))
{
?>
        <li class="root-level"> <a href="<?php echo base_url(); ?>admin/"><i class="entypo-gauge"></i><span>Dashboard</span></a> </li>
        <li class="root-level has-sub"> <a href="#"><i class="entypo-layout"></i><span>Users Management</span></a>
        <ul>
            <?php
                if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
                {
                ?>
            <li> <a href="<?php echo base_url(); ?>admin/groups/create/1"><span>Create Group</span></a> </li>
            <?php
                }
                ?>
            <li> <a href="<?php echo base_url(); ?>admin/groups/"><span>
            <?=lang('web_groups')?>
            </span></a> </li>
            <?php
                if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
                {
                ?>
            <li> <a href="<?php echo base_url(); ?>admin/users/create/"><span>Create User</span></a> </li>
            <?php
				}
				?>
            <li> <a href="<?php echo base_url(); ?>admin/users/"><span>Users</span></a> </li>
            <?php
                if($u_data['groupid']==='4')
                {
                ?>
            <li> <a href="<?php echo base_url(); ?>admin/aclp/"><span>Access Permissions</span></a> </li>
            <?php
                }
                ?>
          </ul>
      </li>
        <?php 
} 
?>
        <?php
if($u_data['groupid']==='4')
{
?>
        <li class="root-level has-sub"> <a href="#"><i class="entypo-newspaper"></i><span>Settings</span></a>
        <ul>
            <li> <a href="<?php echo base_url(); ?>admin/settings/"><span><?php echo 'General'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/settings/layouts"><span><?php echo 'Layouts'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/settings//progressbar"><span><?php echo 'Progress Bar'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/settings/emailsetting"><span><?php echo 'Email'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/settings/promotionbox"><span><?php echo 'Promotion box'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/languages"><span><?php echo 'Languages'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/settings/quizcountdown"><span><?php echo 'Quiz Countdown'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/certificates"><span><?php echo 'Certificates'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/sociallinks/createLink"><span><?php echo 'Social Links'?></span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/settings/sociallogins"><span><?php echo 'Social Logins'?></span></a> </li>
          </ul>
      </li>
        <?php
}
?>
        <?php
if($u_data['groupid']==='4')
{
?>
        <li class="root-level has-sub"> <a href="#"><i class="entypo-doc-text"></i><span>Managers</span></a>
        <ul>
            <li> <a href="<?php echo base_url(); ?>admin/orders/"><span>Order Manager</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/promocodes/"><span>Promocodes</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/testimonials/"><span>Testimonials</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/userreport/"><span>Course + User Report</span></a> </li>
            <li class="has-sub"> <a href="#"><span>Report</span></a>
            <ul>
                <li> <a href="<?php echo base_url(); ?>admin/studreport/"><span>Course Report</span></a> </li>
                <li> <a href="<?php echo base_url(); ?>admin/studreport/sales/"><span>Sales Report</span></a> </li>
                <li> <a href="<?php echo base_url(); ?>admin/studreport/coursestati/"><span>Course Statistics</span></a> </li>
                <li> <a href="<?php echo base_url(); ?>admin/studreport/studentstati/"><span>Students Statistics</span></a> </li>
              </ul>
          </li>
            <li> <a href="<?php echo base_url(); ?>admin/pagecreator/"><span>Page Manager</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/widgets/"><span>Widgets</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/templates/"><span>Templates</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/subscriptions/"><span>Subscriptions</span></a> </li>
          </ul>
      </li>
        <?php 
} 
?>
        <?php
if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))) || (in_array('media',$this->session->userdata('mparr'))) || (in_array('quizzes',$this->session->userdata('mparr'))) )
{
?>
        <li class="root-level has-sub"> <a href="#"><i class="entypo-flow-tree"></i><span>Training</span><!--<span class="badge badge-info badge-roundless">New Items</span>--></a>
        <ul>
            <?php
            if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))))
            {
            ?>
            <li class="has-sub"> <a href="<?php echo base_url(); ?>admin/programs/"><span>Courses</span> 
              <!--<span class="badge badge-success">3</span>--></a>
            <ul>
                <li> <a href="<?php echo base_url(); ?>admin/programs/"><span>Course</span></a> </li>
                <li> <a href="<?php echo base_url(); ?>admin/pcategories/"><span>Course Categories</span></a> </li>
              </ul>
          </li>
            <?php  } ?>
            <?php
            if(($u_data['groupid']==='4')|| (in_array('media',$this->session->userdata('mparr'))))
            {
            ?>
            <li class="has-sub"> <a href="#"><span class="folder">Media Library</span></a>
            <ul>
                <li> <a href="<?php echo base_url(); ?>admin/mcategories/"><span>Media Categories</span></a> </li>
                <li> <a href="<?php echo base_url(); ?>admin/medias/"><span>Media</span></a> </li>
              </ul>
          </li>
            <?php  } ?>
            <?php
               if(($u_data['groupid']==='4')||(in_array('quizzes',$this->session->userdata('mparr'))))
               {
                ?>
            <li> <a href="<?php echo base_url(); ?>admin/quizzes/" style="background-position: 0px 0px;"><span>Quizzes</span> </a> </li>
            <?php  } ?>
          </ul>
      </li>
        <?php } ?>
        <?php
if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))))
{
?>
        <li> <a href="<?php echo base_url(); ?>admin/subplans/"><span><i class="entypo-bag"></i>Subscription Plans</span></a> </li>
        <!--<li class="root-level has-sub">
			<a href="#"><i class="entypo-bag"></i><span>Subscription Plans</span></a>
		<ul class style>
			<li>
				<a href="<?php echo base_url(); ?>admin/subplans/"><span>Sub Plans</span></a>
			</li>		
		</ul>
</li>-->
        <?php } ?>
        <?php
if($u_data['groupid']==='2')
{
?>
        <li class="root-level has-sub"> <a href="#"><span>My Courses</span></a>
        <ul>
            <li> <a href="<?php echo base_url(); ?>admin/teachercourses/"><span>Courses</span></a> </li>
        </ul>
      </li>
        <?php } ?>
        <li> <a href="<?php echo base_url(); ?>admin/blogs/index/"><span><i class="entypo-window"></i>Blog Manager</span></a> </li>
        <!--<li class="root-level has-sub">
		<a href="#"><i class="entypo-window"></i><span>Blogs Manager</span></a>
		<ul class style>
			<li>
				<a href="<?php echo base_url(); ?>admin/blogs/"><span><i class="entypo-window"></i>Blog Manager</span></a>
			</li>
		</ul>
</li>-->
        
        <li> <a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/smartcoursemanager/"><span><i class="entypo-monitor"></i>Smart Course Manager Wizard</span></a> </li>
        <!--<li class="root-level has-sub">
		<a href="#"><i class="entypo-monitor"></i><span>Smart Course Manager Wizard</span></a>
		<ul class style>
			<li>
				<a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/smartcoursemanager/"><span>Smart Course Manager Wizard</span></a>
			</li>
		</ul>
</li>-->
      </ul>
  </div>
    <div class="main-content" style="min-height: 1409px;">
    <div class="row"> 
        <!-- Profile Info and Notifications -->
        <div class="col-md-6 col-sm-8 clearfix">
        <ul class="user-info pull-left pull-none-xsm">
            <ul class="user-info pull-left pull-right-xs pull-none-xsm">
            <!-- Raw Notifications -->
            <li class="notifications dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-attention"></i> <span class="badge badge-info">6</span> </a>
                <ul class="dropdown-menu">
                <li class="top">
                    <p class="small"> <a href="#" class="pull-right">Mark all Read</a> You have <strong>3</strong> new notifications. </p>
                  </li>
                <li>
                    <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: none;" tabindex="5001">
                    <li class="unread notification-success"> <a href="#"> <i class="entypo-user-add pull-right"></i> <span class="line"> <strong>New user registered</strong> </span> <span class="line small"> 30 seconds ago </span> </a> </li>
                    <li class="unread notification-secondary"> <a href="#"> <i class="entypo-heart pull-right"></i> <span class="line"> <strong>Someone special liked this</strong> </span> <span class="line small"> 2 minutes ago </span> </a> </li>
                    <li class="notification-primary"> <a href="#"> <i class="entypo-user pull-right"></i> <span class="line"> <strong>Privacy settings have been changed</strong> </span> <span class="line small"> 3 hours ago </span> </a> </li>
                    <li class="notification-danger"> <a href="#"> <i class="entypo-cancel-circled pull-right"></i> <span class="line"> John cancelled the event </span> <span class="line small"> 9 hours ago </span> </a> </li>
                    <li class="notification-info"> <a href="#"> <i class="entypo-info pull-right"></i> <span class="line"> The server is status is stable </span> <span class="line small"> yesterday at 10:30am </span> </a> </li>
                    <li class="notification-warning"> <a href="#"> <i class="entypo-rss pull-right"></i> <span class="line"> New comments waiting approval </span> <span class="line small"> last week </span> </a> </li>
                  </ul>
                  </li>
                <li class="external"> <a href="#">View all notifications</a> </li>
                <div id="ascrail2001" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; position: absolute; top: 0px; left: -10px; height: 0px; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
                <div id="ascrail2001-hr" class="nicescroll-rails" style="height: 7px; z-index: 1000; top: -7px; left: 0px; position: absolute; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; height: 5px; width: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
              </ul>
              </li>
            
            <!-- Message Notifications -->
            <li class="notifications dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-mail"></i> <span class="badge badge-secondary">10</span> </a>
                <ul class="dropdown-menu">
                <li>
                    <form class="top-dropdown-search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search anything..." name="s">
                      </div>
                  </form>
                    <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: none;" tabindex="5002">
                    <li class="active"> <a href="#"> <span class="image pull-right"> <img src="http://demo.neontheme.com/assets/images/thumb-1.png" alt="" class="img-circle"> </span> <span class="line"> <strong>Luc Chartier</strong> - yesterday </span> <span class="line desc small"> This ain’t our first item, it is the best of the rest. </span> </a> </li>
                    
                    <!--<li class="active">
			<a href="#">
				<span class="image pull-right">
					<img src="http://demo.neontheme.com/assets/images/thumb-2.png" alt="" class="img-circle">
				</span>
				
				<span class="line">
					<strong>Salma Nyberg</strong>
					- 2 days ago
				</span>
				
				<span class="line desc small">
					Oh he decisively impression attachment friendship so if everything. 
				</span>
			</a>
		</li>
		
		<li>
			<a href="#">
				<span class="image pull-right">
					<img src="http://demo.neontheme.com/assets/images/thumb-3.png" alt="" class="img-circle">
				</span>
				
				<span class="line">
					Hayden Cartwright
					- a week ago
				</span>
				
				<span class="line desc small">
					Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
				</span>
			</a>
		</li>
		
		<li>
			<a href="#">
				<span class="image pull-right">
					<img src="http://demo.neontheme.com/assets/images/thumb-4.png" alt="" class="img-circle">
				</span>
				
				<span class="line">
					Sandra Eberhardt
					- 16 days ago
				</span>
				
				<span class="line desc small">
					On so attention necessary at by provision otherwise existence direction.
				</span>
			</a>
		</li>-->
                  </ul>
                  </li>
                <li class="external"> <a href="http://demo.neontheme.com/mailbox/main/">All Messages</a> </li>
                <div id="ascrail2002" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; position: absolute; top: 0px; left: -10px; height: 0px; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
                <div id="ascrail2002-hr" class="nicescroll-rails" style="height: 7px; z-index: 1000; top: -7px; left: 0px; position: absolute; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; height: 5px; width: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
              </ul>
              </li>
            
            <!-- Task Notifications -->
            <li class="notifications dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-list"></i> <span class="badge badge-warning">1</span> </a>
                <ul class="dropdown-menu">
                <li class="top">
                    <p>You have 6 pending tasks</p>
                  </li>
                <li>
                    <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: none;" tabindex="5003">
                    <li> <a href="#"> <span class="task"> <span class="desc">Procurement</span> <span class="percent">27%</span> </span> <span class="progress"> <span style="width: 27%;" class="progress-bar progress-bar-success"> <span class="sr-only">27% Complete</span> </span> </span> </a> </li>
                    <li> <a href="#"> <span class="task"> <span class="desc">App Development</span> <span class="percent">83%</span> </span> <span class="progress progress-striped"> <span style="width: 83%;" class="progress-bar progress-bar-danger"> <span class="sr-only">83% Complete</span> </span> </span> </a> </li>
                    <li> <a href="#"> <span class="task"> <span class="desc">HTML Slicing</span> <span class="percent">91%</span> </span> <span class="progress"> <span style="width: 91%;" class="progress-bar progress-bar-success"> <span class="sr-only">91% Complete</span> </span> </span> </a> </li>
                    <li> <a href="#"> <span class="task"> <span class="desc">Database Repair</span> <span class="percent">12%</span> </span> <span class="progress progress-striped"> <span style="width: 12%;" class="progress-bar progress-bar-warning"> <span class="sr-only">12% Complete</span> </span> </span> </a> </li>
                    <li> <a href="#"> <span class="task"> <span class="desc">Backup Create Progress</span> <span class="percent">54%</span> </span> <span class="progress progress-striped"> <span style="width: 54%;" class="progress-bar progress-bar-info"> <span class="sr-only">54% Complete</span> </span> </span> </a> </li>
                    <li> <a href="#"> <span class="task"> <span class="desc">Upgrade Progress</span> <span class="percent">17%</span> </span> <span class="progress progress-striped"> <span style="width: 17%;" class="progress-bar progress-bar-important"> <span class="sr-only">17% Complete</span> </span> </span> </a> </li>
                  </ul>
                  </li>
                <li class="external"> <a href="#">See all tasks</a> </li>
                <div id="ascrail2003" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; position: absolute; top: 0px; left: -10px; height: 0px; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
                <div id="ascrail2003-hr" class="nicescroll-rails" style="height: 7px; z-index: 1000; top: -7px; left: 0px; position: absolute; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; height: 5px; width: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
              </ul>
              </li>
          </ul>
          </ul>
      </div>
        
        <!-- Raw Links -->
        <div class="col-md-6 col-sm-4 clearfix hidden-xs">
        <ul class="list-inline links-list pull-right">
            <li class="dropdown language-selector"> Language: &nbsp; <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true"> <img src="http://demo.neontheme.com/assets/images/flag-uk.png"> </a>
            <ul class="dropdown-menu pull-right">
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-de.png"> <span>Deutsch</span> </a> </li>
                <li class="active"> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-uk.png"> <span>English</span> </a> </li>
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-fr.png"> <span>François</span> </a> </li>
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-al.png"> <span>Shqip</span> </a> </li>
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-es.png"> <span>Español</span> </a> </li>
              </ul>
          </li>
            <li class="sep"></li>
            <li> <a href="#" data-toggle="chat" data-collapse-sidebar="1"> <i class="entypo-chat"></i> Chat <span class="badge badge-success chat-notifications-badge">3</span> </a> </li>
            <li class="sep"></li>
            <li> <a href="<?php echo base_url(); ?>admin/users/logout"> Log Out <i class="entypo-logout right"></i> </a> </li>
          </ul>
      </div>
      </div>
    <hr>
    <?php $this->load->view("admin/partials/_flashdata");?>
    <?php echo $template['body']; ?> 
    
    <!-- Footer -->
    <footer class="main">
        <?php $this->load->view('admin/template/footer');?>
      </footer>
  </div>
  </div>
<link rel="stylesheet" href="<?php echo base_url("assets/js/jvectormap/jquery-jvectormap-1.2.2.css"); ?>"  id="style-resource-1">
<link rel="stylesheet" href="<?php echo base_url("assets/js/rickshaw/rickshaw.min.css"); ?>"  id="style-resource-2">
<script type="text/javascript" src="<?php echo base_url("assets/js/gsap/main-gsap.js"); ?>"  id="script-resource-1"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"); ?>"  id="script-resource-2"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>" id="script-resource-3"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/joinable.js"); ?>" id="script-resource-4"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/resizeable.js"); ?>" id="script-resource-5"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/neon-api.js"); ?>" id="script-resource-6"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/cookies.min.js"); ?>" id="script-resource-7"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/fileinput.js"); ?>" id="script-resource-7"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.nestable.js"); ?>" id="script-resource-7"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"); ?>" id="script-resource-8"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-switch.min.js"); ?>" id="script-resource-8"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"); ?>" id="script-resource-9"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.sparkline.min.js"); ?>" id="script-resource-10"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/rickshaw/vendor/d3.v3.js"); ?>" id="script-resource-11"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/rickshaw/rickshaw.min.js"); ?>" id="script-resource-12"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/raphael-min.js"); ?>" id="script-resource-13"></script> 
<!--<script type="text/javascript" src="<?php echo base_url("assets/js/morris.min.js"); ?>" id="script-resource-14"></script>--> 
<script type="text/javascript" src="<?php echo base_url("assets/js/toastr.js"); ?>" id="script-resource-15"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/neon-chat.js"); ?>" id="script-resource-16"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/neon-custom.js"); ?>" id="script-resource-17"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/neon-demo.js"); ?>" id="script-resource-18"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/neon-skins.js"); ?>" id="script-resource-19"></script> 
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.validate.min.js"); ?>" id="script-resource-20"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/redactor-js-master/redactor/redactor.css" />
<script src="<?php echo base_url(); ?>public/js/redactor-js-master/redactor/redactor.min.js"></script> 
<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-28991003-7']);
	  _gaq.push(['_setDomainName', 'demo.neontheme.com']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</body>
</html>