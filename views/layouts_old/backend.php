<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php
  $CI =& get_instance();
  $CI->load->helper('commonmethods');
  $CI->load->model('admin/settings_model'); 
  $getTheme = $CI->settings_model->getItems();

  $status = $getTheme[0]['status'];

  $blocked = $getTheme[0]['is_block'];

  if($status == '0')
  {
    //exit('Website has been Blocked');
      redirect('admin/users/expired');
  }

   if($blocked == '1')
  {
    //exit('Website has been Blocked');
    redirect('admin/users/blocked');
  }

  
  extract($getTheme[0]);
?>
<html xmlns="https://www.w3.org/1999/xhtml">
  <head>
  <title><?php echo $template['title'];?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='pragma' content='no-cache'>
  <meta http-equiv='expires' content='1200' />
  <meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />
  <meta content="" name="generator">
<link rel="icon" href="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $getTheme[0]['favicon']; ?>" type="image/gif">
  <!--<base href="<?php echo $this->config->item('base_url') ?>/public/" />-->

  <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
  <link rel="stylesheet" href="<?php echo base_url("assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css"); ?>" id="style-resource-1">
  <link rel="stylesheet" href="<?php echo base_url("assets/css/font-icons/entypo/css/entypo.css"); ?>" id="style-resource-2">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" id="style-resource-3">
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
  <!--<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.0.min.js"); ?>"></script>
  <script>$.noConflict();</script>
  <link rel="stylesheet" href="<?php echo base_url();?>public/css/csstext.css" media="screen" type="text/css"  />
 <!--  <link rel="stylesheet" href="<?php echo base_url();?>public/css/progress_bar.css" media="screen" type="text/css"  /> -->
  
  <?php //echo $template['metadata']; ?>

  <!--wizard script-->

  <script type="text/javascript">

function funStep1(){

  location.href="<?php echo base_url();?>admin/admin/step1";

  }

function funSkipStep1(){

  location.href="<?php echo base_url();?>admin/admin/skipstep1";}

function funStep2() { var institutename=$('#institutename').val();  if(institutename==''){  $('#institutenameerror').html('<span class="error">Institute name field is required!</span>');  return false;     }     $.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/updateinstname'); ?>",        data: {institutename:institutename},        success: function(msg)        {     location.href="<?php echo base_url();?>admin/admin/step2";      /*$('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */            }            else            {                $("#ajax").html(msg);             }         }    }); }

function funSkipStep2(){  location.href="<?php echo base_url();?>admin/admin/skipstep2";} function funStep3(){  var logoimagename=$('#logoimagename').val();  if(logoimagename == ''){  $('#logouplaoderror').html('<span class="error">Please upload Logo.</span>'); return false; }     $.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/updateinstlogo'); ?>",        data: {logoimagename:logoimagename},        success: function(msg)        {     location.href="<?php echo base_url();?>admin/admin/step3";      /*$('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */            }            else            {                $("#ajax").html(msg);             }         }    }); }  function funSkipStep3(){ location.href="<?php echo base_url();?>admin/admin/skipstep3";}

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



                         function funSkipStep4(){ location.href="<?php echo base_url();?>admin/admin/skipstep4";}

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

  location.href="<?php echo base_url();?>admin/admin/skipstep5";}    function funStep6() {  var wtitle = $("#wtitle").val();  if(wtitle ==''){  $('#wtitleerror').html('<span class="error">Welcome title is required!</span>');  return false;   }else{  $('#wtitleerror').html(''); } var wdesc = $("#wdesc").val();  if(wdesc ==''){ $('#wdescerror').html('<span class="error">Welcome description field is required!</span>'); return false;   }else{  $('#wdescerror').html('');  }     $.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/update_process'); ?>",        data: $("#welcomeform").serialize(),        success: function(msg)        {     location.href="<?php echo base_url();?>admin/admin/step6";      /* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    }); } function funSkipStep6(){ location.href="<?php echo base_url();?>admin/admin/skipstep6";}     function funStep7() { var atitle = $("#atitle").val();  if(atitle ==''){  $('#atitleerror').html('<span class="error">Welcome title is required!</span>');  return false;   }else{  $('#atitleerror').html(''); } var adesc = $("#adesc").val();  if(adesc ==''){ $('#adescerror').html('<span class="error">Welcome description field is required!</span>'); return false;   }else{  $('#adescerror').html('');  }    $.ajax({         type: "post",        url: "<?php echo base_url('admin/admin/update_aboutus_process'); ?>",        data: $("#aboutform").serialize(),        success: function(msg)        {     location.href="<?php echo base_url();?>admin/admin/step7";      /* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    }); }  function funSkipStep7(){  location.href="<?php echo base_url();?>admin/admin/skipstep7";}   function updatecontact_content() {  var address = $("#address").val();  if(address ==''){ $('#addresserror').html('<span class="error">Address is required!</span>'); return false;   }else{  $('#address').html(''); }     var phone = $("#phone").val();  if(phone ==''){ $('#phoneerror').html('<span class="error">Phone field is required!</span>'); return false;   }else{  $('#phone').html(''); }     var email = $("#email").val();  if(email ==''){ $('#emailerror').html('<span class="error">Email field is required!</span>'); return false;   }else{  $('#email').html(''); }   var web = $("#web").val();  if(web ==''){ $('#weberror').html('<span class="error">Web field is required!</span>'); return false;   }else{  $('#web').html(''); } var mapcode = $("#mapcode").val();  if(mapcode ==''){ $('#mapcodeerror').html('<span class="error">Map Code field is required!</span>');  return false;   }else{  $('#mapcode').html(''); }     $.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/update_contact_process'); ?>",        data: $("#contactform").serialize(),        success: function(msg)        {     location.href="<?php echo base_url();?>admin/admin/step8";      /* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    }); }   function funSkipStep8(){ location.href="<?php echo base_url();?>admin/admin/skipstep8";}function funFinish() { $.ajax({        type: "post",        url: "<?php echo base_url('admin/admin/update_finish_process'); ?>",        success: function(msg)        {      location.href="<?php echo base_url();?>admin/admin/finish";     /* $('body,html').animate({ scrollTop: 0 }, 200); */            if(msg.substring(1,7) != 'script')            {                $("#ajax").html(msg);                $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>');            }            else            {                $("#ajax").html(msg);             }        }    });   }
  </script><!--wizard script closed-->
<style>
  body .page-container .sidebar-menu #main-menu li ul > li > a.active {
background-color: #E6E6FF;
}
</style>
  
  </head>

  <body class="page-body skin-white page-left-in" data-url="https://demo.neontheme.com" cz-shortcut-listen="true">
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

    <div class="sidebar-menu" id='sidemenu' style="min-height: 1409px;">
    <header class="logo-env"> 
        
        <!-- logo -->
        <div class="logo">
          <a href="#" onclick="tabMenu('tab19');">
            <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $getTheme[0]['logoimage'];?>" alt="">
          </a>
        </div>
        
        <!-- logo collapse icon -->
        
        <div class="sidebar-collapse"> <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
          <i class="entypo-menu"></i> </a> </div>
        
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs"> <a href="#" class="with-animation"><!-- add class "with-animation" to support animation --> 
          <i class="entypo-menu"></i> </a> </div>
      </header>
    <div class="sidebar-user-info">
        <div class="sui-normal"> <a href="#" class="user-link"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $my_image;?>" alt="" class="img-circle" width='44'> <span style="font-family: 'AvenirNextLTPro-Regular';">Welcome,</span> <strong style="font-family: 'AvenirNextLTPro-Demi';"><?php echo ucfirst($this->session->userdata['loggedin']['first_name']);?></strong> </a> </div>
        <div class="sui-hover inline-links animate-in"> <a href="#"> <i class="entypo-pencil"></i> New Page </a> <a href="#"> <i class="entypo-mail"></i> Inbox </a> <a href="<?php echo base_url(); ?>admin/signout/destradmin"> <i class="entypo-lock"></i> Log Off </a> <span class="close-sui-popup">×</span> </div>
      </div>
    <ul id="main-menu" class="main-menu" style="">
        <!-- <li id="search" class="root-level">
        <form method="get" action="">
            <input type="text" name="q" class="search-input" placeholder="Search something...">
            <button type="submit"><i class="entypo-search"></i></button>
          </form>
    </li> -->
        <?php
        //$amt = $this->session->userdata('activeM');
$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
$active_menu =$this->session->userdata('Active_menu');

$active_submenu =$this->uri->segment(2);
$active_submenu3 =$this->uri->segment(3);

//print_r($amt);
if(($u_data['groupid']=='4') || (in_array('users',$this->session->userdata('mparr'))))
{
?>    <li class="root-level" onclick="viewsite();" > <a href="javascript:void(0);"><i class="entypo-vcard"></i><span>View Front Site</span></a> </li>
        <li class="root-level" onclick="tabMenu('tab19');" > <a href="#"><i class="entypo-gauge"></i><span>Dashboard</span></a> </li>
      <?php
if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))) || (in_array('media',$this->session->userdata('mparr'))) || (in_array('quizzes',$this->session->userdata('mparr'))) )
{  
?>
        <?php  $varmenu1 = $active_menu == 'tab1' || ($active_submenu =='programs' || $active_submenu =='medias' || $active_submenu =='pcategories' || $active_submenu =='mcategories' || $active_submenu =='quizzes' )  ? 'opened':''; ?>
        <li class="root-level has-sub <?php echo $varmenu1 ?>" onclick="tabMenu('tab1');"> <a href="#"><i class="entypo-flow-tree"></i><span>Training Content</span><!--<span class="badge badge-info badge-roundless">New Items</span>--></a>
        <ul>
            <?php
            if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))))
            {
            ?>
                  <?php 
                  
                   $submenu1 = $active_submenu =='programs' ? 'active':'';
                   ?>
                <li> <a href="<?php echo base_url(); ?>admin/course-manager" class="<?php echo $submenu1; ?>" ><span>Course Manager</span></a> </li>
                <?php $submenu2 = $active_submenu =='pcategories' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/course-categories/" class="<?php echo $submenu2; ?>"><span>Course Categories</span></a> </li>
              
            <?php  } ?>
            <?php
            if(($u_data['groupid']==='4')|| (in_array('media',$this->session->userdata('mparr'))))
            {
            ?>  
                  <?php $submenu3 = $active_submenu =='medias' ? 'active':''; ?>
                 <li> <a href="<?php echo base_url(); ?>admin/medias/" class="<?php echo $submenu3; ?>"><span>Course Media</span></a> </li>
                <?php $submenu4 = $active_submenu =='mcategories' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/media-categories/" class="<?php echo $submenu4; ?>"><span>Media Categories</span></a> </li>
               
              
            <?php  } ?>
            <?php
               if(($u_data['groupid']==='4')||(in_array('quizzes',$this->session->userdata('mparr'))))
               {
                ?>
                <?php $submenu5 = $active_submenu =='quizzes' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/exam-papers/" class="<?php echo $submenu5; ?>" style="background-position: 0px 0px;"><span>Exam Papers</span> </a> </li>
            <?php $submenu6 = $active_submenu =='questions' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/questions/" class="<?php echo $submenu6; ?>" style="background-position: 0px 0px;"><span>Questions Bank</span> </a> </li>
            <?php  } ?>
          </ul>
      </li>
        <?php } ?>
    
     <?php
if($u_data['groupid']==='4')
{
?>        <?php  $varmenu2 = $active_menu == 'tab2' ? 'opened':''; ?>
        <li class="root-level has-sub <?php echo $varmenu2; ?>" onclick="tabMenu('tab2');" > <a href="#"><i class="entypo-doc-text"></i><span>Orders And Payments</span></a>
        <ul>
              <?php $submenu7 = $active_submenu =='orders' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/orders/" class="<?php echo $submenu7; ?>" ><span>Order Manager</span></a> </li>
       <?php $submenu8 = $active_submenu3 =='sales' ? 'active':''; ?>
      <li> <a href="<?php echo base_url(); ?>admin/sales/report/" class="<?php echo $submenu8; ?>" ><span>View Sales</span></a> </li>
      <li> <a href="<?php echo base_url(); ?>admin/promocodes/"><span>Promocodes</span></a> </li>
             <?php //$submenu9 = $active_submenu3 =='account' ? 'active':''; ?>
             <!-- <li> <a href="<?php echo base_url(); ?>admin/settings/account" class="<?php echo $submenu9; ?>" onclick="getaccounturl();" ><span><?php echo 'Payment Settings'?></span></a> </li> -->
            <!--<li> <a href="<?php echo base_url(); ?>admin/userreport/"><span>Course + User Report</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/pagecreator/"><span>Page Manager</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/widgets/"><span>Widgets</span></a> </li>
            <li> <a href="<?php echo base_url(); ?>admin/templates/"><span>Templates</span></a> </li>-->
      
      <?php //$submenu10 = $active_submenu =='subplans' ? 'active':''; ?>
      <!-- <li> <a href="<?php echo base_url(); ?>admin/subplans/" class="<?php echo $submenu10; ?>"><!--<i class="entypo-bag"></i>--<span>Subscription Plans</span></a> </li> -->
            
            
          <!--</ul>
      </li>
    
    <li class="root-level has-sub"> <a href="#"><i class="entypo-doc-text"></i><span>Report</span></a>
            <ul>
                <li> <a href="<?php echo base_url(); ?>admin/studreport/"><span>Course Report</span></a> </li>-->
                
                <!--<li> <a href="<?php echo base_url(); ?>admin/studreport/coursestati/"><span>Course Statistics</span></a> </li>
                <li> <a href="<?php echo base_url(); ?>admin/studreport/studentstati/"><span>Students Statistics</span></a> </li>-->
              </ul>
          </li>
        <?php 
} 
?>  <?php  $varmenu3 = $active_menu == 'tab3' ? 'opened':''; ?>
     <li class="root-level has-sub <?php echo $varmenu3; ?>" onclick="tabMenu('tab3');" > <a href="#"><i class="entypo-docs"></i><span>Report</span></a>
            <ul>
            <?php $submenu12 = $active_submenu3 =='studentstati' ? 'active':''; ?>
        <!--<li> <a href="<?php echo base_url(); ?>admin/studreport/studentstati/" class="<?php echo $submenu12; ?>"><span>Students Statistics</span></a> </li>-->
                <?php $submenu13 = ($active_submenu =='studreport' && $active_submenu3 =='')  ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/course-report/" class="<?php echo $submenu13; ?>"><span>Course Report</span></a> </li>
         <?php $submenu14 = $active_submenu3 =='coursestati' ? 'active':''; ?>
         <li> <a href="<?php echo base_url(); ?>admin/course/statistics/" class="<?php echo $submenu14; ?>"><span>Course Statistics</span></a> </li>
               <?php $submenu15 = $active_submenu3 =='sales' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/sales/report/" class="<?php echo $submenu15; ?>"><span>Sales Reports</span></a> </li>
               <?php $submenu11 = $active_submenu =='subscriptions' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/newsletter-subscriptions/" class="<?php echo $submenu11; ?>"><span>Newsletter Subscriptions</span></a> </li>
                
              </ul>
          </li>
          <?php  $varmenu4 = $active_menu == 'tab4' || ($active_submenu =='templates' && $active_submenu3 =='editoptions')  ? 'opened':''; ?>
      <li class="root-level has-sub <?php echo $varmenu4; ?>" onclick="tabMenu('tab4');"  > <a href="#"><i class="entypo-tools"></i><span>Academy Content and Design</span></a>
            <ul>            
                            <?php $submenu26 = $active_submenu3 =='editoptions' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/home-page/design-options/45/" class="<?php echo $submenu26; ?>"><span><?php echo 'Home page'?></span></a> </li>
                <?php  $varmenu9 = $active_menu == 'tab8' ? 'visible':''; ?>
                <!--<ul class="<?php echo $varmenu9; ?>">
                      <?php $submenu16 = $active_submenu =='widgets' ? 'active':''; ?>
                     <li> <a href="<?php echo base_url(); ?>admin/widgets/" class="<?php echo $submenu16; ?>"><span>Widgets</span></a> </li>
                  <?php $submenu17 = $active_submenu =='testimonials' ? 'active':''; ?>
                  <li> <a href="<?php echo base_url(); ?>admin/testimonials/" class="<?php echo $submenu17; ?>"><span>Testimonials</span></a> </li>
                   <?php $submenu18 = $active_submenu3 =='createLink' ? 'active':''; ?>
                   <li> <a href="<?php echo base_url(); ?>admin/sociallinks/createLink" class="<?php echo $submenu18; ?>"><span><?php echo 'Social Links'?></span></a> </li>
                </ul>
               </li>-->
                          <?php $submenu19 = $active_submenu =='pagecreator' ? 'active':''; ?>
                           <li> <a href="<?php echo base_url(); ?>admin/other-pages-design-setting/" class="<?php echo $submenu19; ?>"><span>Other Pages</span></a> </li>
                <?php $submenu20 = $active_submenu3 =='index' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/blogs/" class="<?php echo $submenu20; ?>"><!--<i class="entypo-window"></i>--><span>Blogs</span></a> </li>
                
              </ul>
          </li>
          <?php  $varmenu5 = $active_menu == 'tab5' ? 'opened':''; ?>
        <li class="root-level has-sub <?php echo $varmenu5; ?>" onclick="tabMenu('tab5');" > <a href="#"><i class="entypo-users"></i><span>Users And Permissions</span></a>
        <ul>
            <?php
                if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
                {
                ?>
            <!--<li> <a href="<?php echo base_url(); ?>admin/groups/create/1"><span>Create Group</span></a> </li>-->
            <?php
                }
                ?>
                <?php $submenu21 = $active_submenu =='users' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/users/" class="<?php echo $submenu21; ?>"><span>
           Manage Users
            </span></a> </li>
            <?php
                if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
                {
                ?>
            <!--<li> <a href="<?php echo base_url(); ?>admin/users/create/"><span>Create User</span></a> </li>-->
            <?php
        }
        ?>
        <?php $submenu22 = ($active_submenu =='groups' && $active_submenu3 =='' ) ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/users-category/" class="<?php echo $submenu22; ?>"><span>Users Category</span></a> </li>
      
      <?php
                if($u_data['groupid']==='4')
                {
                ?>
                <?php $submenu23 = $active_submenu =='aclp' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/user-permissions/" class="<?php echo $submenu23; ?>"><span>User Permissions</span></a> </li>
            <?php
                }
                ?>
              <?php $submenu24 = $active_submenu3 =='external' ? 'active':''; ?> 
              <li> <a href="<?php echo base_url(); ?>admin/instructor-external/list" class="<?php echo $submenu24; ?>"><span>Instructor External List</span></a> </li>
            
          </ul>
      </li>
        <?php 
} 
?>
        <?php
if($u_data['groupid']==='4')
{
?>      <?php  $varmenu6 = $active_menu == 'tab6' ||($active_submenu == 'settings' && $active_submenu3 == 'index') || $active_submenu3 =='account' || $active_submenu3 =='emailsetting' || $active_submenu =='subplans' ? 'opened':''; ?>
        <li id ="settingvble" class="root-level has-sub <?php echo $varmenu6; ?>" onclick="tabMenu('tab6');" > <a href="#"><i class="entypo-newspaper" ></i><span>Academy Settings</span></a>
        <ul class="" >
        
        <!--<li> <a href="#" onclick="getaccounturl();" ><span><?php echo 'Payment Account'?></span></a> </li>-->
           <?php $submenu25 = ($active_submenu =='settings' && $active_submenu3 =='index') || ($active_submenu =='settings' && $active_submenu3 =='') ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/settings/" class="<?php echo $submenu25; ?>"><span><?php echo 'General Settings'?></span></a> </li>
            <?php //$submenu26 = $active_submenu3 =='editoptions' ? 'active':''; ?>
            <!-- <li> <a href="<?php echo base_url(); ?>admin/templates/editoptions/45/" class="<?php echo $submenu26; ?>"><span><?php echo 'Design Settings'?></span></a> </li> --> <!--admin/settings/layouts-->
     <?php $submenu29 = $active_submenu3 =='account' ? 'active':''; ?>
      <li> <a href="<?php echo base_url(); ?>admin/payment/settings" class="<?php echo $submenu29; ?>" onclick="getaccounturl();" ><span><?php echo 'Payment Settings'?></span></a> </li>

     <?php $submenu10 = $active_submenu =='subplans' ? 'active':''; ?>
      <li> <a href="<?php echo base_url(); ?>admin/subplans/" class="<?php echo $submenu10; ?>"><!--<i class="entypo-bag"></i>--><span>Subscription Plans Settings</span></a> </li>

      <?php $submenu27 = $active_submenu =='certificates' ? 'active':''; ?>
      <li> <a href="<?php echo base_url(); ?>admin/certificates" class="<?php echo $submenu27; ?>" ><span><?php echo 'Certificates Settings'?></span></a> </li>
      <?php $submenu28 = $active_submenu3 =='sociallogins' ? 'active':''; ?>
      <li> <a href="<?php echo base_url(); ?>admin/social-logins/settings" class="<?php echo $submenu28; ?>"><span><?php echo 'Social Logins'?></span></a> </li>
      
      
            <!--<li> <a href="<?php echo base_url(); ?>admin/settings//progressbar"><span><?php echo 'Progress Bar'?></span></a> </li>-->
      <?php $submenu30 = $active_submenu3 =='emailsetting' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/email/settings" class="<?php echo $submenu30; ?>"><span><?php echo 'Send Email Settings'?></span></a> </li>
            <!--<li> <a href="<?php echo base_url(); ?>admin/settings/promotionbox"><span><?php echo 'Promotion box'?></span></a> </li>-->
            <!--<li> <a href="<?php echo base_url(); ?>admin/languages"><span><?php echo 'Languages'?></span></a> </li>-->
            <!--<li> <a href="<?php echo base_url(); ?>admin/settings/quizcountdown"><span><?php echo 'Quiz Countdown'?></span></a> </li>-->
            <?php $submenu33 = $active_submenu3 =='paymentInstruct' ? 'active':''; ?>
      <li> <a href="<?php echo base_url(); ?>admin/domain/pointing" class="<?php echo $submenu33; ?>"><span><?php echo 'Point Your Domain'?></span></a> </li>
           
            
      
          </ul>
      </li>
        <?php
}
?>
<?php
if($u_data['groupid']==='4')
{

?>  
<?php  $varmenu6 = $active_menu == 'tab6' ||($active_submenu == 'settings' && $active_submenu3 == 'index') || $active_submenu3 =='account' || $active_submenu3 =='emailsetting' || $active_submenu =='subplans' ? 'opened':''; ?>
<li class="root-level"> <a href="<?php echo base_url() ?>admin/manage/chat-app"><i class="entypo-chat"></i><span>Manage Chat App</span></a> </li>
<li class="root-level"> <a href="<?php echo base_url(); ?>/assets/chat_app/livechat/php/app.php?login" target="_blank" id="Login_As_Operator"><i class="entypo-user-add"></i><span>Login As Operator</span></a> </li>
<?php } ?>     
        <?php
if($u_data['groupid']==='4')
{
?>
        <!--<li class="root-level has-sub"> <a href="#"><i class="entypo-doc-text"></i><span>Managers</span></a>
        <ul>-->
        <!-- already commented code strat@@@@@@@@@@@@@@@@@@@@@@@@ -->
            <!--<li> <a href="<?php echo base_url(); ?>admin/orders/"><span>Order Manager</span></a> </li>-->
            <!--<li> <a href="<?php echo base_url(); ?>admin/promocodes/"><span>Promocodes</span></a> </li>-->
            <!--already commented code end@@@@@@@@@@@@@@@@@@@@@@@@ -->
            <!--<li> <a href="<?php echo base_url(); ?>admin/userreport/"><span>Course + User Report</span></a> </li>-->

           
            <!--<li> <a href="<?php echo base_url(); ?>admin/templates/"><span>Templates</span></a> </li>-->
            <!-- already commented code strat@@@@@@@@@@@@@@@@@@@@@@@@ -->
            <!--<li> <a href="<?php echo base_url(); ?>admin/subscriptions/"><span>Subscriptions</span></a> </li>-->
          <!-- already commented code strat@@@@@@@@@@@@@@@@@@@@@@@@ -->
          <!--</ul>
      </li>-->
    
    
        <?php 
} 
?>
        
        <?php
if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))))
{
?>
        
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
?>        <?php  $varmenu9 = $active_menu == 'tab9' ? 'opened':''; ?>
        <li class="root-level has-sub <?php echo $varmenu9; ?>" onclick="tabMenu('tab9');"> <a href="#"><span>My Courses</span></a>
        <ul>
        <?php $submenu31 = $active_submenu =='teachercourses' ? 'active':''; ?>
            <li> <a href="<?php echo base_url(); ?>admin/teachercourses/" class="<?php echo $submenu31; ?>"><span>Courses</span></a> </li>
        </ul>
      </li>
        <?php } ?>
        
      <?php  $varmenu7 = $active_menu == 'tab7' ? 'opened':''; ?>  
    <li class="root-level has-sub <?php echo $varmenu7; ?> " onclick="tabMenu('tab7');" > <a href="#"><i class="entypo-monitor"></i><span>Wizard to Manage Academy</span></a>
            <ul>
                  <?php $submenu51 = $active_submenu =='smartsettingmanager' ? 'active':''; ?>
                <li > <a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/smartsettingmanager/" class="<?php echo $submenu51; ?>"><span>Steps to manage my online academy</span></a></li>
               <?php $submenu52 = $active_submenu =='smartcoursemanager' ? 'active':''; ?>
                <li > <a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/smartcoursemanager/" class="<?php echo $submenu52; ?>"><span>Steps to manage a course</span></a></li>

                <li > <a id="coursewizardshooter" href="https://createonlineacademy.com/supportsystem" target="_blank"><span>Support</span></a></li>
            </ul>
          </li>

        <?php  $varmenu10 = $active_menu == 'tab10' ? 'opened':''; ?>   
      <li class="root-level has-sub <?php echo $varmenu10; ?> " onclick="tabMenu('tab10');" > <a href="#"><i class="entypo-help"></i><span>Help to Manage Academy</span></a>
            <ul>
                  <?php $submenu53 = $active_submenu3 =='manage_setup' ? 'active':''; ?>
                <li > <a  href="<?php echo base_url(); ?>admin/manage/academy-setup" class="<?php echo $submenu53; ?>"><span>How to Manage the Set up of Your Academy</span></a></li>
                  <?php $submenu54 = $active_submenu3 =='manage_design' ? 'active':''; ?>
                <li > <a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/manage/academy-design" class="<?php echo $submenu54; ?>" ><span>How to Design Your Academy</span></a></li>
                  <?php $submenu55 = $active_submenu3 =='create_page' ? 'active':''; ?>
                <li > <a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/academy/create-page" class="<?php echo $submenu55; ?>"><span>How to Create A Page</span></a></li>
                  <?php $submenu56 = $active_submenu3 =='create_blogs' ? 'active':''; ?>
                <li > <a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/create/blog" class="<?php echo $submenu56; ?>"><span>How to Create A Blog</span></a></li>
            </ul>
          </li>    
       <!--  <li class="root-level has-sub <?php echo $varmenu10; ?> " onclick="notifyMe()" > <a href="#"><i class="entypo-help"></i><span>notify</span></a> -->
        </ul>
  </div>
    <div class="main-content" style="min-height: 1409px;">
    <div class="row"> 
        <!-- Profile Info and Notifications -->
        <div class="col-md-2 col-sm-8 clearfix">
        <ul class="user-info pull-left pull-none-xsm">
            <ul class="user-info pull-left pull-right-xs pull-none-xsm">
            <!-- Raw Notifications -->
              <?php
                  $notify = 0;
                  $socialloginarray = json_decode($sociallogin);//variable sociallogin is come from database field json array
                  if(empty($socialloginarray->facebook->appid))
                      $notify++;
                  if(empty($socialloginarray->facebook->appsecretkey))
                      $notify++;
                  if(empty($socialloginarray->googleplus->clientid))
                      $notify++;
                  if(empty($socialloginarray->googleplus->clientsecreatekey))
                      $notify++;
              ?>
                <li class="notifications dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-attention"></i> <span class="badge badge-info"><?php echo $notify;?></span> </a>
                <ul class="dropdown-menu">
                <li class="top">
                    <p class="small" style="font-family: 'AvenirNextLTPro-Regular';"> <a href="#" style="font-family: 'AvenirNextLTPro-Demi';" class="pull-right">Mark all Read</a> You have <strong><?php echo $notify;?></strong> new notifications. </p>
                </li>
                
                <li>
                  <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: none;" tabindex="5001">
                      <?php
                      if(empty($socialloginarray->facebook->appid))
                      {
                          ?>
                          <li class="notification-info"><a href="<?php echo base_url(); ?>admin/settings/sociallogins"><i class="entypo-info pull-right"></i><span class="line"><strong style="font-family: 'AvenirNextLTPro-Demi';">Please fill the facebook app id</strong></span><span class="line small"></span></a></li>
                          <?php
                      }
                      if(empty($socialloginarray->facebook->appsecretkey))
                      {
                          ?>
                          <li class="notification-info"><a href="<?php echo base_url(); ?>admin/settings/sociallogins"><i class="entypo-info pull-right"></i><span class="line"><strong style="font-family: 'AvenirNextLTPro-Demi';">Please fill the facebook secrete key</strong></span><span class="line small"></span></a></li>
                          <?php
                      }
                      if(empty($socialloginarray->googleplus->clientid))
                      {
                          ?>
                          <li class="notification-info"><a href="<?php echo base_url(); ?>admin/settings/sociallogins"><i class="entypo-info pull-right"></i><span class="line"><strong style="font-family: 'AvenirNextLTPro-Demi';">Please fill the google client id</strong></span><span class="line small"></span></a></li>
                          <?php
                      }
                      if(empty($socialloginarray->googleplus->clientsecreatekey))
                      {
                          ?>
                          <li class="notification-info"><a href="<?php echo base_url(); ?>admin/settings/sociallogins"><i class="entypo-info pull-right"></i><span class="line"><strong style="font-family: 'AvenirNextLTPro-Demi';">Please fill the google client secrete key</strong></span><span class="line small"></span></a></li>
                          <?php
                      }
                      ?>
                      <!--<li class="unread notification-success"> <a href="#"> <i class="entypo-user-add pull-right"></i> <span class="line"> <strong>New user registered</strong> </span> <span class="line small"> 30 seconds ago </span> </a> </li>
                      <li class="unread notification-secondary"> <a href="#"> <i class="entypo-heart pull-right"></i> <span class="line"> <strong>Someone special liked this</strong> </span> <span class="line small"> 2 minutes ago </span> </a> </li>
                      <li class="notification-primary"> <a href="#"> <i class="entypo-user pull-right"></i> <span class="line"> <strong>Privacy settings have been changed</strong> </span> <span class="line small"> 3 hours ago </span> </a> </li>
                      <li class="notification-danger"> <a href="#"> <i class="entypo-cancel-circled pull-right"></i> <span class="line"> John cancelled the event </span> <span class="line small"> 9 hours ago </span> </a> </li>
                      <li class="notification-info"> <a href="#"> <i class="entypo-info pull-right"></i> <span class="line"> The server is status is stable </span> <span class="line small"> yesterday at 10:30am </span> </a> </li>
                      <li class="notification-warning"> <a href="#"> <i class="entypo-rss pull-right"></i> <span class="line"> New comments waiting approval </span> <span class="line small"> last week </span> </a> </li>-->
                  </ul>
                </li>
                <!--<li class="external"> <a href="#">View all notifications</a> </li>
                
                  <div id="ascrail2001" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; position: absolute; top: 0px; left: -10px; height: 0px; cursor: default; display: none;">
                      <div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                    </div>
                  <div id="ascrail2001-hr" class="nicescroll-rails" style="height: 7px; z-index: 1000; top: -7px; left: 0px; position: absolute; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; height: 5px; width: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>-->
              </ul>
              </li>
            
            <!-- Message Notifications -->
            <!--<li class="notifications dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-mail"></i> <span class="badge badge-secondary">10</span> </a>
                <ul class="dropdown-menu">
                <li>
                    <form class="top-dropdown-search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search anything..." name="s">
                      </div>
                  </form>
                    <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: none;" tabindex="5002">
                    <li class="active"> <a href="#"> <span class="image pull-right"> <img src="http://demo.neontheme.com/assets/images/thumb-1.png" alt="" class="img-circle"> </span> <span class="line"> <strong>Luc Chartier</strong> - yesterday </span> <span class="line desc small"> This ain’t our first item, it is the best of the rest. </span> </a> </li>-->
                    
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
                  <!--</ul>
                  </li>
                <li class="external"> <a href="http://demo.neontheme.com/mailbox/main/">All Messages</a> </li>
                <div id="ascrail2002" class="nicescroll-rails" style="padding-right: 3px; width: 10px; z-index: 1000; position: absolute; top: 0px; left: -10px; height: 0px; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; float: right; width: 5px; height: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
                <div id="ascrail2002-hr" class="nicescroll-rails" style="height: 7px; z-index: 1000; top: -7px; left: 0px; position: absolute; cursor: default; display: none;">
                    <div style="position: relative; top: 0px; height: 5px; width: 0px; background-color: rgb(212, 212, 212); border: 1px solid rgb(204, 204, 204); background-clip: padding-box; border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px;"></div>
                  </div>
              </ul>
              </li>-->
            
            <!-- Task Notifications -->
            <!--<li class="notifications dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-list"></i> <span class="badge badge-warning">1</span> </a>
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
              </li>-->
          </ul>
          </ul>
      </div>
      <?php if(@$expiring['days'] =='www'){ ?>
      <div class="col-md-5 col-sm-4 " style="">
      <?php }else{ ?>
      <?php
       $CI = & get_instance();
       $CI->load->model('admin/settings_model');
       $getExpireDays = $CI->settings_model->getExpireDays(1,'mlms_academydetails');
       if($getExpireDays)
       {
        //print_r($getExpireDays);
        
        $currentdate = date('Y-m-d');
        $date1 = new DateTime($currentdate);
        $date2 = new DateTime($getExpireDays->academy_expired);
        $interval = $date2->diff($date1);
       // echo $interval->days;
       }
       
       ?>
       <?php 
       if ($interval->days <= 0){
        $this->load->helper('url');
        // redirect(base_url().'admin/users/expired_academy');
       }
       ?>

      <div class="col-md-6 col-sm-4 clearfix acdmy_exp" style="">
           <!-- <div style="" class="exp_text"> Academy Expiring in:  Days -->
             <?php
                    
       if($currentdate <= $getExpireDays->academy_expired)
       {

      ?>
           <div style="" class="exp_text"> <div id="academy_expiring" style="float: left;padding: 4px 0 4px 125px">Academy Expiring in: <span style="font-weight:bold;"><?php echo $interval->days == 0 ? 'today' :$interval->days." Days"; ?></span></div> 
       <?php 

       }
       else
       {   $this->load->helper('url');
        // redirect(base_url().'admin/users/expired_academy');
       ?>
       <div style="" class="exp_text"><div style="float: left;padding: 4px 0 4px 125px;"> Academy had expired before: <span style="font-family: 'AvenirNextLTPro-Demi';"><?php echo $interval->days; ?> </span>days ago</div> 
       <?php 
       }
       ?>  

              <span class="exp-acdmy"> 
              <?php 
              if(($this->uri->segment(2)!="create" && $this->uri->segment(3)!="lecture") || ($this->uri->segment(2)!="edit" && $this->uri->segment(3)!="lecture"))
                {

              ?>
                    <!-- <a class="btn btn-success" style="margin-right: 2px;padding: 6px 14px 3px 11px;" onclick="openRenewalPopup('#renewalpopup'); "> <i class="entypo entypo-retweet"></i>Renew</a> 
                    <a class="btn btn-orange" style="    padding: 6px 10px 3px 10px;" onclick="openRenewalPopup('#accountoption');"> <i class="entypo entypo-list"></i>Account Options</a> 
                     --><!-- <a href="#" class="btn btn-success" style="margin-right: 2px;padding: 4px;" onclick="accountRenew();"> <i class="entypo entypo-retweet"></i>Renew demo</a> 
                    <a href="#" class="btn btn-orange" style="padding: 4px;" onclick="accountOption();"> <i class="entypo entypo-list"></i>Account Options demo</a> -->
            <?php } ?>
                </span>
           </div>
           <?php }?>
     </div>
        <!-- Raw Links -->
        <div class="col-md-4 col-sm-4 clearfix hidden-xs">
        <ul class="list-inline links-list pull-right">
            <li class="dropdown language-selector"><b style="font-weight: 100;color: #5a5a5a;font-family: 'AvenirNextLTPro-Regular';"> Current Time : <span id="servertime"></span> GMT </b>
<!--            <ul class="dropdown-menu pull-right">
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-de.png"> <span>Deutsch</span> </a> </li>
                <li class="active"> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-uk.png"> <span>English</span> </a> </li>
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-fr.png"> <span>François</span> </a> </li>
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-al.png"> <span>Shqip</span> </a> </li>
                <li> <a href="#"> <img src="http://demo.neontheme.com/assets/images/flag-es.png"> <span>Español</span> </a> </li>
              </ul>-->
          </li>
            <!--<li class="sep"></li>
            <li> <a href="#" data-toggle="chat" data-collapse-sidebar="1"> <i class="entypo-chat"></i> Chat <span class="badge badge-success chat-notifications-badge">3</span> </a> </li>-->
            <li class="sep"></li>
            <!-- <li> <a href="<?php echo base_url(); ?>admin/signout/destradmin"> Log Out <i class="entypo-logout right"></i> </a> </li> -->
          <li> <a href="<?php echo base_url() ?>admin/users/logoutadmin" style="cursor: pointer;font-family: 'AvenirNextLTPro-Regular';color: #5a5a5a;" > Log Out
<!--           onclick="logoutPage()"
 -->           <i class="entypo-logout right"></i> </a> </li>
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
<div class="get_help_fix">
  <span class="ghf-img">
    <img src="<?php echo base_url();?>public/css/image/gethelp.jpg" alt="gethelp">
  </span>

  <ul class="ghf-menu">
    <li><a href="<?php echo base_url();?>admin/settings/view_videos">How-To Video Tutorials</a></li>
    <li><a href="<?php echo base_url();?>admin/settings/help_to_manage_academy">Help To Manage Academy</a></li>
    <li><a href="<?php echo base_url();?>admin/settings/support_team">Contact Support</a></li>
    <!-- <li><a href="#">item 4</a></li> -->
  </ul>
</div>

<style type="text/css">
#lean_overlay
{
position: fixed;
z-index: 10000;
top: 0px;
left: 0px;
height: 100%;
width: 100%;
background: #000;
}
.get_help_fix {
  position: fixed;
  right: -25px;
  bottom: 0;
  z-index: 10001;
}
.get_help_fix .ghf-img {
  display: block;
  /* cursor: pointer; */
}
.get_help_fix .ghf-img img {
  width: 135px;
}
ul.ghf-menu {
  position: fixed;
  right: 90px;
  bottom: 15px;
  list-style: none;
  border-radius: 6px;
  display: none;
}
ul.ghf-menu li {
  min-width: 175px !important;
  width: auto;
  color: #FFFFFF;
  background: #009A9A;
  height: 30px;
  line-height: 28px;
  text-align: center;
  visibility: visible;
  border-bottom: 1px solid rgba(238, 238, 238, 0.45);
  cursor: pointer;
  border-radius: 6px;
}
ul.ghf-menu li a {
  color: #FFFFFF !important;
}
ul.ghf-menu li:hover {
  background: #006F6F;
}

.acdmy_exp {
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.09), 0 6px 20px 0 rgba(0, 0, 0, 0.11);
}
div#academy_expiring {
  font-size: 13px;
}
.exp_text {
    font-family:'AvenirNextLTPro-Regular';
    font-weight: 500;
    line-height: 1.1;
    color: #5a5a5a;
    font-size: 15px;

}
.strng_cntnr {
    width: 100%;
    padding: 23px 0px 10px 11px;
    /*background-color: #eee;*/
}

.content_text {
    font-size: 16px;
    color: #2c2c2c;
}
.content_text label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: bold !important; 
    margin-right: 3px !important;
}
.jconfirm-box{
  width: 93%;
    margin: 0 auto;
}
.jconfirm-box .title{
      color: #c42140;
    text-transform: uppercase;
    font-size: 21px!important;
    font-weight: bold;
    text-align: center!important;
    padding: 17px 30px 0 13px !important;
    border-bottom: 0px!important;
    margin-top: 0px!important;
    height: 64px!important;
    border-radius: 8px 8px 0px 0;
    background-color: #f1f1f1!important;
}

</style>
 

<div id="lean_overlay" style="display: none; opacity: 0;"></div> 

<script type="text/javascript">
var $ =jQuery.noConflict();

  $(document).ready(function () {
   $('.ghf-img').click(function(evt) {
       $(".ghf-menu").slideToggle('slow');
               evt.stopPropagation();
               $('#lean_overlay').show();
   });
   $('#lean_overlay').click(function(evt) {
       $(".ghf-menu").hide('slow');
               evt.stopPropagation();
               $('#lean_overlay').hide();
   });
});
</script>

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
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.peity.min.js"); ?>" id="script-resource-10"></script> 
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
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/redactor123/assets/redactor.css" />
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/redactor.min.js"></script> 
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/redactor123/assets/redactor.css" />
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/redactor.min.js"></script> -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />

<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>

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
  
  <!--<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

    <script>
    jQuery(document).ready(function() {

    function myStartFunction() { alert('fancy box opened'); }

    jQuery(".fancybox").fancybox({
        'onStart': myStartFunction
    });  
});
  </script>-->
  <script>
  function getaccounturl()
  {
    //alert();
    //$("#settingvble").attr('class','visible'); 
    $("#settingvble").addClass("root-level has-sub open !important");
    //$("#settingvble").addClass("important");
  }
  </script>
  <script>
  function tabMenu(tabname)
  {
    //alert(tabname);
    jQuery.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>admin/templates/tabMenu",
              data: {tabname:tabname}, 
              success: function(data)
              {
                // alert("t1"+data);
                // alert("t2"+tabname);
              //$("#followDiv").html(data);
              if(data == 'tab19')
              {
                var base_url = window.location.origin;
                window.location =base_url+"/admin/";

              }
              }
              });
  }

  </script>
  <script>
  function activeMenu(menuname,path)
  {
    //alert(path);

    jQuery.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>admin/templates/activeMenu",
              data: {menuname:menuname,path:path}, 
              success: function(data)
              {
                // alert(data);
                // alert(menuname);
                // alert(path);
              //$("#followDiv").html(data);
              if(data == menuname)
              {
                var base_url = window.location.origin;
                window.location =base_url+"/"+path;

              }
              }
              });
  }
  </script>
  <script>
  function viewsite()
  {
    //alert(path);

    jQuery.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>admin/users/view_frontsite",
              //data: {menuname:menuname,path:path}, 
              success: function(data)
              {
                //alert(data);
              // var win = window.open('<?php echo base_url(); ?>', '_blank');
              // if(win)
              // {    
              //   win.focus();
              // }
                window.location = '<?php echo base_url(); ?>';
              }
              });
  }

 
  </script>


<script type="text/javascript">

// Current Server Time script (SSI or PHP)- By JavaScriptKit.com (http://www.javascriptkit.com)
// For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
// This notice must stay intact for use.

//Depending on whether your page supports SSI (.shtml) or PHP (.php), UNCOMMENT the line below your page supports and COMMENT the one it does not:
//Default is that SSI method is uncommented, and PHP is commented:

//var currenttime = '<!--#config timefmt="%B %d, %Y %H:%M:%S"--><!--#echo var="DATE_LOCAL" -->' //SSI method of getting server date
var currenttime = '<?php print date("F d, Y H:i:s", time())?>'; //PHP method of getting server date

///////////Stop editting here/////////////////////////////////

var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
var serverdate=new Date(currenttime)

function padlength(what){
var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+" "+padlength(serverdate.getDate())+", "+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
document.getElementById("servertime").innerHTML=timestring
}

window.onload=function(){
setInterval("displaytime()", 1000)
}

</script>
  
  <script type="text/javascript">
  function adminout()
  {

    //window.location="<?php echo base_url(); ?>admin/signout/destradmin";
    window.location="<?php echo base_url(); ?>assets/chat_app/livechat/php/app.php?logout";
    //http://www.create-online-academy.com/assets/chat_app/livechat/php/app.php?admin
    //window.location="<?php echo base_url(); ?>admin";
    alert('yes');
  }
  </script>

  <script>
function notifyMe() {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check if the user is okay to get some notification
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
  var options = {
        body: "This is the body of the notification",
        icon: "icon.jpg",
        dir : "ltr"
    };
  var notification = new Notification("Hi there",options);
  }

  // Otherwise, we need to ask the user for permission
  // Note, Chrome does not implement the permission static property
  // So we have to check for NOT 'denied' instead of 'default'
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // Whatever the user answers, we make sure we store the information
      if (!('permission' in Notification)) {
        Notification.permission = permission;
      }

      // If the user is okay, let's create a notification
      if (permission === "granted") {
        var options = {
              body: "This is the body of the notification",
              icon: "https://www.create-online-academy.com/public/uploads/settings/img/logo/2788_09-29-2015.png",
              dir : "ltr"
          };
        var notification = new Notification("Hi there",options);
      }
    });
  }

  // At last, if the user already denied any notification, and you
  // want to be respectful there is no need to bother them any more.
}
</script>
<script>
  $(document).ready(function() {
var i = 1;
$('.progress .circle').removeClass().addClass('circle');
$('.progress .bar').removeClass().addClass('bar');
setInterval(function() {
$('.progress .circle:nth-of-type(' + i + ')').addClass('active');

$('.progress .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');

$('.progress .circle:nth-of-type(' + (i - 1) + ') .label').html('&#10003;');

$('.progress .bar:nth-of-type(' + (i - 1) + ')').addClass('active');

$('.progress .bar:nth-of-type(' + (i - 2) + ')').removeClass('active').addClass('done');

i++;

if (i == 0) {
$('.progress .bar').removeClass().addClass('bar');
$('.progress div.circle').removeClass().addClass('circle');
i = 1;
}
}, 1000);
});
</script>

<?php 
if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="create" && $this->uri->segment(3)=="lecture" )
{
$this->load->view('admin/tasks/popuppage'); 
}
?>
<?php 
if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="edit" && $this->uri->segment(3)=="lecture" )
{
$this->load->view('admin/tasks/popuppage'); 
}
?>
<?php
if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="")
{
 $this->load->view('admin/progressbar/prograssbarpop');
} 
?>
<?php
// if($this->uri->segment(2)!="tasks" && ($this->uri->segment(3)!="create" || $this->uri->segment(3)!="edit"))
if(($this->uri->segment(2)!="edit" || $this->uri->segment(2)!="create") && $this->uri->segment(3)!="lecture")
{
 $this->load->view('admin/progressbar/academyrenewal');
} 
?>
<?php
// if($this->uri->segment(2)!="tasks" && ($this->uri->segment(3)!="create" || $this->uri->segment(3)!="edit"))
if(($this->uri->segment(2)!="tasks" && $this->uri->segment(3)!="edit"))
{
 $this->load->view('admin/progressbar/academyrenewal');
} 
?>
</body>
</html>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />

<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script>

var $ =jQuery.noConflict();

  function accountRenew() 
  {
    var str = '<div class="strng_cntnr">'
       str+=  '<div class="content_text" style="padding-bottom: 8px;">'
       str+=  '<span style="width: 58%;">' 
       str+=  '<label>Current Plan:</label>'
       str+=  'Advanced Plan </span>' 
       str+=  '<span style="width: 38%;float: right;">'
       str+=  '<label>Price:</label>'
       str+=  'USD 50/ 3 months</span> </div>'   
       $.alert({
             title: 'Renew',
            content: str,
             confirmButton: 'Make Payment',
            
            });
       
      }
    function accountOption() 
  {
    var str = '<div class="strng_cntnr">'
       str+=  '<div class="content_text" style="padding-bottom: 8px;">'
       str+=  '<div style="">' 
       str+=  '<label>Account Details:</label>'
       str+=  ' </div>' 
       str+=  '<div style="">'
       str+=  '<label>Current Plan:</label>'
       str+=  'Advanced Plan</div> </div>'
       str+=  '<div class="buttons">'
       str+=  '<button class="btn btn-success">Upgrade</button>'
       str+=  '<button class="btn btn-orange">Downgrade</button>'
       str+=  '<button class="btn btn-blue">Renew Now</button></div></div>'
       $.alert({ 
             title: 'Account Options',
             content: str,
             confirmButton: '',
            });

       
      }
      function logoutPage()
      {        
        delete_cookie('ci_session');
        window.location.replace("<?php echo base_url(); ?>admin/signout/destradmin");
      }
      function delete_cookie( name ) {
      document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            }

  function getExpireDays()//for add to favorites
    {
      $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>admin/client/getExpireDays",
          //data: {follow_id:follow_id,student_id:student_id}, 
          success: function(data)
          { 
            // var objNew = jQuery.parseJSON(data);
            // alert(objNew.days);
            //  $("#academy_expiring").html("Academy Expiring in:"+objNew.days);
            // alert(data);
            // console.log(data);
            window.location.reload(true);
          }
          }); 
    }
    
    $(document).ready(function(){
      <?php      
      if($getExpireDays->status==0)
      {
      ?>
      getExpireDays();
      <?php } ?>
    });
</script>
<script type="text/javascript">
  $(".renew-top-close-btn").click(function(){
    $(".modal-open").css("overflow","auto");
});
</script>