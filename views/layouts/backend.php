<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/backend.css">

<!-- <script type='application/javascript' src='<?php //echo base_url();?>public/js/fastclick.js'></script> -->
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
<?php function get_timeago2( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'Just Now';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}  ?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title><?php echo $template['title'];?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='pragma' content='no-cache'>
  <meta http-equiv='expires' content='1200' />
  <meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />
  <meta content="" name="generator">
  <meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="icon" href="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $getTheme[0]['favicon']; ?>" type="image/gif">
  <!--<base href="<?php echo $this->config->item('base_url') ?>/public/" />-->

  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css'); ?>" id="style-resource-1">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-icons/entypo/css/entypo.css'); ?>" id="style-resource-2">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" id="style-resource-3">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/skins/white.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-min.css'); ?>" id="style-resource-4">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/neon-core-min.css'); ?>" id="style-resource-5">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/neon-forms-min.css'); ?>" id="style-resource-7">
   <link rel="stylesheet" href="<?php echo base_url('assets/css/custom-min.css'); ?>" id="style-resource-8">
   <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!--<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.0.min.js'); ?>"></script>
  <script>$.noConflict();</script>
  <link rel="stylesheet" href="<?php echo base_url();?>public/css/csstext.css" media="screen" type="text/css"  />
  <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
 
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
<!-- page-left-in -->
  <body class="page-body skin-white " data-url="http://demo.neontheme.com" cz-shortcut-listen="true">
<?php

$sessionarray = $this->session->userdata('loggedin');
$auth = $this->session->userdata('logged_in');
if(!empty($sessionarray))
$user_id = $sessionarray['id'];
else
$user_id = $auth['id'];

  // $CI =& get_instance();

  // $CI->load->model('admin/settings_model'); 

  $getTheme = $CI->settings_model->getItems();
  $getImage = $CI->settings_model->getUserImage($user_id);
  $my_image = $getImage[0]->images;

  if(!empty($my_image))
  {    
    $filepath = "";
    $files = $_SERVER['DOCUMENT_ROOT']."/public/uploads/users/img/".$my_image;
    if (file_exists($files)) {
      $my_image = "public/uploads/users/img/".$my_image;
    }
    else{
      $my_image = "public/uploads/users/img/thumbs/".$my_image;
    }
  }
  else{
    $my_image = "public/uploads/users/img/default.jpg";
  }

$notification = $CI->settings_model->getNotification($auth['id']);
$viewed = 0;
foreach($notification as $notify)
{
  if($notify->viewed == 0)
  {
    $viewed++;
  }
}
  $get_discussion = $CI->settings_model->getDiscussion();

if($this->config->item('step1','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

{

?>
<div id="mlmspopdiv">
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

}elseif($this->config->item('step2','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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

}elseif($this->config->item('step3','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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

}elseif($this->config->item('step4','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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

}elseif($this->config->item('step5','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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

}elseif($this->config->item('step6','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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

}elseif($this->config->item('step7','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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

}elseif($this->config->item('step8','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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

}elseif($this->config->item('step9','steps')=='no' && (!empty($sessionarray)) && $getTheme[0]['visited']=='No' && ($sessionarray['groupid']=='4' || $sessionarray['groupid']=='2'))

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
 <div class="popup_overlay_lec">
</div>
<div class="course_popup">
  <div class="course_popup_header">
      <span class="popup_heading"></span>
      <span class="lnr lnr-cross cross_icon"></span>
  </div>
  <div class="course_select_sec">
  </div>
</div>




<div class="page-container">

    <div class="sidebar-menu" id='sidemenu' style="min-height: 1409px;">
      <div class="sidebar-inner">
      <header class="logo-env"> 
          
          <!-- logo -->
          <div class="close_mobile_sidebar">
              <a href="javascript:void(0)" class="sidebar-collapse-icon with-animation"> 
                  <span class="lnr lnr-cross close_ad_sidemenu"></span>
              </a>
          </div>
          <div class="logo">
            <a title="Dashboard" href="<?php echo base_url();?>admin" >
              <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $getTheme[0]['logoimage'];?>" alt="">
            </a>
          </div>
          <div class="home_link">
             <a title="Visit front site" href="<?php echo base_url();?>"> <img src="<?php echo base_url(); ?>public/images/external-link.png" ></a>
          </div>
      </header>

    <?php 
    $u_data=$this->session->userdata('logged_in');
    $maccessarr=$this->session->userdata('maccessarr');
    $active_menu =$this->session->userdata('Active_menu');

    $active_submenu =$this->uri->segment(2);
    $active_submenu3 =$this->uri->segment(3);
    $varmenu2 = "";
    $submenu532 ="";
    $submenu533 ="";
     ?>

        <ul id="main-menu" class="main-menu" style="">
           
                <?php
                // print_r((in_array('courses',$this->session->userdata('mparr'))));exit;
    if((($u_data['groupid']==='4' || $u_data['groupid']==='2') || (in_array('courses',$this->session->userdata('mparr'))) || (in_array('media',$this->session->userdata('mparr'))) || (in_array('quizzes',$this->session->userdata('mparr'))) ) && $u_data['groupid'] !== '6' )
    {  
       $varmenu1 = $active_menu == 'tab1' || ($active_submenu =='programs' || $active_submenu =='medias' || $active_submenu =='pcategories' || $active_submenu =='mcategories' || $active_submenu =='course-manager' || $active_submenu =='quizzes' || $this->uri->segment(1) =='conference' )  ? 'opened':''; 
    ?>
            <li class="root-level has-sub <?php echo $varmenu1 ?>" onclick="tabMenu('tab1');"> <a href="#"><span class="lnr lnr-book"></span><span class="list_text">Learning Content</span></a>
              <ul>

                 <?php
                if(($u_data['groupid']==='4' || $u_data['groupid']==='2') || (in_array('courses',$this->session->userdata('mparr'))))
                {
                ?>
                      <?php 
                       $submenu1 = $active_submenu =='programs' ? 'active':'';
                       $submenu01 = $active_submenu =='course-manager' ? 'active':'';
                       ?>
                    <li> <a href="<?php if($u_data['groupid']==='2'){echo base_url().'teacher';}else{echo base_url().'admin';} ?>/course-manager" class="<?php echo $submenu01; ?>" ><span>Courses</span></a> </li>
                    <?php if($u_data['groupid'] === '4') { ?>
                    <?php $submenu2 = $active_submenu =='pcategories' ? 'active':''; ?>
                    <li> <a href="<?php echo base_url(); ?>admin/course-categories/" class="<?php echo $submenu2; ?>"><span>Categories</span></a> </li>


                  
                <?php  }
                }

                if(($u_data['groupid']==='4')|| (in_array('media',$this->session->userdata('mparr'))))
                {
                  $submenu31 = $active_submenu =='learningpage' ? 'active':'';
                ?>  
                <li> <a href="<?php echo base_url(); ?>admin/learning-category/" class="<?php echo $submenu2; ?>"><span>Learning Categories</span></a> </li>
                <li> <a href="<?php echo base_url(); ?>admin/learningpage/" class="<?php echo $submenu31; ?>"><span>Learning Content Pages</span></a> </li>
                      <?php $submenu3 = $active_submenu =='medias' ? 'active':''; ?>
                     <li> <a href="<?php echo base_url(); ?>admin/medias/" class="<?php echo $submenu3; ?>"><span>Media</span></a> </li>

                   
                  
                <?php  } ?>
                <?php
                   if(($u_data['groupid']==='4') || (in_array('quizzes',$this->session->userdata('mparr'))))
                   {
                    ?>
                    <?php $submenu5 = $active_submenu =='quizzes' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/exams/examlist/" class="<?php echo $submenu5; ?>" style="background-position: 0px 0px;"><span>Quizzes</span> </a> </li>
                
                <?php $submenu6 = $active_submenu =='questions' ? 'active':''; ?>
              
                <?php  } ?>

        <?php $submenu12 = $active_submenu3 =='studentstati' ? 'active':''; ?>
        <?php $submenu13 = ($active_submenu =='course-report' && $active_submenu3 =='')  ? 'active':''; ?>
                    <li> <a href="<?php if($u_data['groupid']==='2'){echo base_url().'teacher';}else{echo base_url().'admin';} ?>/course-report/" class="<?php echo $submenu13; ?>"><span>Reports</span></a> </li>
             <?php $submenu14 = $active_submenu3 =='coursestati' ? 'active':''; ?>
           
                   <?php $submenu15 = $active_submenu3 =='sales' ? 'active':'';
                   if(($u_data['groupid']==='4')){
                   $submenu_zoom = ($this->uri->segment(1) =='conference')  ? 'active':''; ?>
                   <li> <a href="<?php echo base_url(); ?>admin/quiz-report/"><span>Quiz Report</span></a></li>
                   <li> <a href="<?php echo base_url(); ?>conference/list" class="<?php echo $submenu_zoom; ?>"><span>Conference</span></a> </li>
                 <?php }
                  ?>
                  <li> <a href="<?php echo base_url(); ?>upcoming-events" class="<?php echo $submenu_zoom; ?>"><span>Upcoming Events</span></a> </li>
              </ul>
            </li>
    <?php } ?>


    <?php 
    if($u_data['groupid']==='4'){ ?>
             <li class="root-level has-sub <?php echo $varmenu2; ?>" onclick="tabMenu('tab2');" > <a href="#"><span class="lnr lnr-license"></span><span class="list_text">Academy</span></a>
              <ul>
                <?php $submenu26 = $active_submenu3 =='editoptions' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/home-page/design-options/45/" class="<?php echo $submenu26; ?>"><span><?php echo 'Customize'?></span></a> </li>
                    <?php  $varmenu9 = $active_menu == 'tab8' ? 'visible':''; ?>
     <?php $submenu19 = $active_submenu =='pagecreator' ? 'active':''; ?>
                               <li> <a href="<?php echo base_url(); ?>admin/other-pages-design-setting/" class="<?php echo $submenu19; ?>"><span>Pages</span></a> </li>
                    <?php $submenu20 = $active_submenu3 =='index' ? 'active':''; ?>
                    <li> <a href="<?php echo base_url(); ?>admin/blogs/" class="<?php echo $submenu20; ?>"><!--<i class="entypo-window"></i>--><span>Blog</span></a> </li>
                      <li> <a href="<?php echo base_url(); ?>admin/settings/" class="<?php echo $submenu20; ?>"><!--<i class="entypo-window"></i>--><span>Settings</span></a> </li>
                    <!--    <li> <a href="<?php echo base_url(); ?>admin/certificates/" class="<?php echo $submenu20; ?>"><span>Certificate Settings</span></a> </li> -->
              </ul>
             </li>
          <?php } ?>
              <li class="root-level has-sub <?php echo @$varmenu2; if($u_data['groupid']==='6' || $u_data['groupid']==='5' || $u_data['groupid']==='2' || $active_submenu =='tcs_orders'){echo 'opened';}?>"  onclick="tabMenu('tab3');" > <a href="#"><span class="lnr lnr-chart-bars"></span><span class="list_text">Market & Sell</span></a>
                <ul class="<?php if($u_data['groupid']==='5' || $u_data['groupid']==='2'){echo 'visible';}?>">
                <?php 
                $submenu7 = $active_submenu =='orders' ? 'active':''; 
                $submenu7ts = $active_submenu =='tcs_orders' ? 'active':''; 
                if($u_data['groupid']==='4')
                {
                ?>
                  <li> <a href="<?php echo base_url();?>admin/orders/" class="<?php echo $submenu7;?>"><span>Orders</span></a> </li> 
                  <li> <a href="<?php echo base_url();?>admin/tcs_orders/" class="<?php echo $submenu7ts;?>"><span>TCS Orders</span></a> </li> 
                <?php 
                }

                if($u_data['groupid']==='5' || $u_data['groupid']==='2')
                {
                ?> 
                <?php 
                $submenu8 = $active_submenu =='your-sales' ? 'active':'';
                $submenu9 = $active_submenu =='settlements' ? 'active':'';
                $submenu10 = $active_submenu =='coupons' ? 'active':'';
                $submenu08 = $active_submenu =='settings' ? 'active':'';
                $submenu080 = $active_submenu =='sub-reseller-list' ? 'active':'';
                ?>
                      <li> <a href="<?php echo base_url(); ?>partner/your-sales" class="<?php echo $submenu8; ?>" ><span>Sales</span></a> </li> 
                      <li> <a href="<?php echo base_url(); ?>partner/coupons" class="<?php echo $submenu10; ?>"><span>Coupons</span></a> </li>
                      <li> <a href="<?php echo base_url(); ?>partner/settlements" class="<?php echo $submenu9; ?>" ><span>Settlements</span></a> </li>
                      <?php $gettype = $this->Crud_model->get_single('mlms_assessment',"user_id = ".$auth['id'],'ass_type');
                      if($gettype->ass_type == '1'){ ?>
                      <li> <a href="<?php echo base_url(); ?>partner/sub-reseller-list" class="<?php echo $submenu080; ?>"><span>Sub Reseller</span></a> </li>
                     <?php } ?>
                      <?php if ($u_data['groupid']==='5') { ?>
                      <li> <a href="<?php echo base_url(); ?>partner/settings" class="<?php echo $submenu08; ?>"><span>Settings</span></a> </li>
                      
                   <?php }
                }

                if($u_data['groupid']==='6')
                {
                ?> 
                <?php 
                $sales1 = $active_submenu =='users' ? 'active':'';
                $sales2 = $active_submenu =='orders' ? 'active':'';
                ?>
                      <li> <a href="<?php echo base_url(); ?>SalesTeam/users" class="<?php echo $sales1; ?>" ><span>Users</span></a> </li> 
                      <li> <a href="<?php echo base_url(); ?>SalesTeam/orders" class="<?php echo $sales2; ?>"><span>Orders</span></a> </li>
                <?php }


                if($u_data['groupid']==='4')
                {
                ?> 
                 <?php $submenu8 = $active_submenu3 =='sales' ? 'active':''; ?>
                      <li> <a href="<?php echo base_url();?>enrolled-users/"><span>Enrolled Users</span></a> </li> 
                      <li> <a href="<?php echo base_url(); ?>admin/promocodes/"><span>Coupons</span></a> </li>
                      <li> <a href="<?php echo base_url(); ?>admin/sales/report/" class="<?php echo $submenu8; ?>" ><span>Co-Teacher Sales</span></a> </li>
                      <?php $submenu15 = $active_submenu3 =='sales' ? 'active':''; ?>
                      <li> <a href="<?php echo base_url(); ?>admin/sales/report/" class="<?php echo $submenu15; ?>"><span>Sales Reports</span></a> </li>
                   <?php 
                } 
                ?>
                <?php
                if($u_data['groupid']==='4')
                {

                ?>  
                <?php  $varmenu6 = $active_menu == 'tab6' ||($active_submenu == 'settings' && $active_submenu3 == 'index') || $active_submenu3 =='account' || $active_submenu3 =='emailsetting' || $active_submenu =='subplans' ? 'opened':''; ?>
                <li class="root-level"> <a href="<?php echo base_url() ?>admin/manage/chat-app"><span>Live Chat </span></a> </li>

                
                
                <?php $submenu11 = $active_submenu =='subscriptions' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/newsletter-subscriptions/" class="<?php echo $submenu11; ?>"><span>Newsletters</span></a> </li>
                <?php } ?> 
                </ul>
             </li>
             <?php if($u_data['groupid']==='4'){ ?>
              <li class="root-level has-sub <?php echo @$varmenu2; ?>" onclick="tabMenu('tab4');" > <a href="#"><span class="lnr lnr-users"></span><span class="list_text">Users</span></a>
                <ul>
                   <?php $submenu21 = $active_submenu =='users' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/users/" class="<?php echo $submenu21; ?>"><span>Manage Users</span></a> 
                </li>
                   <?php $submenu25 = $active_submenu =='resellers' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/resellers/" class="<?php echo $submenu25; ?>"><span>Manage Resellers</span></a> 
                </li>

                <?php $submenu22 = ($active_submenu =='groups' && $active_submenu3 =='' ) ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/users-category/" class="<?php echo $submenu22; ?>"><span>User Roles</span></a> </li>
                <?php
                    if($u_data['groupid']==='4' || $u_data['groupid']==='2')
                    {
                    ?>
                    <?php $submenu23 = $active_submenu =='aclp' ? 'active':''; ?>
                <li> <a href="<?php echo base_url(); ?>admin/user-permissions/" class="<?php echo $submenu23; ?>"><span>Access Permissions</span></a> </li>
                <?php
                    }
                    ?>
                  <?php $submenu24 = $active_submenu3 =='external' ? 'active':''; ?> 
                  <li> <a href="<?php echo base_url(); ?>admin/instructor-external/list" class="<?php echo $submenu24; ?>"><span>Co-Teacher</span></a> </li>

                </ul>
             </li>

              <li class="root-level <?php echo @$varmenu2; ?>" onclick="tabMenu('tab5');" > <a href="<?php echo base_url(); ?>admin/your-account"><span class="lnr lnr-user"></span><span class="list_text">Your Account</span></a>
             </li>

            <!-- marketing tools just for advertising -->
            <li class="root-level has-sub <?php echo @$varmenu2; ?>" onclick="tabMenu('tab7');" > <a href="#"><span class="lnr lnr-line-spacing"></span><span class="list_text">Marketing Tools</span></a>
              <ul>
                  <?php $submenu531 = $active_submenu3 =='manage_students' ? 'active':''; ?>
                <li > <a  href="<?php echo base_url(); ?>admin/manage-students" class="<?php echo $submenu531; ?>"><span>Manage Students & Reviews</span></a></li>
                <!-- <li > <a  href="<?php echo base_url(); ?>admin/manage-reseller" class="<?php echo $submenu532; ?>"><span>Reseller QR-code</span></a></li>-->
                <li > <a  href="<?php echo base_url(); ?>admin/manage-coupon-code" class="<?php echo $submenu533; ?>"><span>Reseller Coupon Code</span></a></li>
                  
              </ul>
            </li>
            <!-- marketing tools just for advertising -->

             <li class="root-level has-sub <?php echo $varmenu2; ?>" onclick="tabMenu('tab6');" > <a href="#"><span class="lnr lnr-thumbs-up"></span><span class="list_text">Help</span></a>
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
             <?php } ?>

        </ul>
        <div class="fix_logo_btm">
          <div class="fix_logo_btm_inner 1">
            <div class="logo_btm">
              <a href="<?php echo base_url();?>">
                <img src="<?php echo base_url(); ?>assets/images/create-online-academy-logo.png" class="coa_logo"> 
              </a>
            </div>
            <div id="sidebar-collapse"> 
              <a href="#" class="sidebar-collapse-icon with-animation"> 
                <span class="lnr lnr-menu" style="font-size: 30px;margin-right: 10px"></span>
              </a>
            </div>
           
          </div>
        </div>
        </div>
      </div>
    <div class="main-content" style="min-height: 1409px;">
      <div class="row admin_header"> 
        <!-- Profile Info and Notifications -->
        <?php if(@$expiring['days'] =='www'){ ?>
          <!-- <div class="" style=""> -->
            <?php }else{ ?>
            <?php
               // $CI = & get_instance();
               // $CI->load->model('admin/settings_model');
               $getExpireDays = $CI->settings_model->getExpireDays(1,'mlms_academydetails');
               if($getExpireDays)
               {
                //print_r($getExpireDays);
                
                $currentdate = date('Y-m-d');
                $date1 = new DateTime($currentdate);
                $date2 = new DateTime($getExpireDays->academy_expired);
                $interval = $date2->diff($date1);
               }
               
               ?>
               <?php 
               if ($interval->days <= 0){
                $this->load->helper('url');
                redirect(base_url().'admin/users/expired_academy');
               }
            ?>

           <?php if($interval->days <= 30 && $interval->invert =='1'){ ?>
          <!-- <div class="col-md-6 clearfix acdmy_exp" style=""> -->
           <!-- <div style="" class="exp_text"> Academy Expiring in:  Days -->

              <?php
              if($currentdate <= $getExpireDays->academy_expired)
              {
              ?>
              <!-- <div style="" class="exp_text"> <div id="academy_expiring" style="float: left;padding: 5px 0 0 0;">Academy Expiring in: <span style="font-weight:bold;"><?php //echo $interval->days == 0 ? 'today' :$interval->days." Days"; ?></span>
              </div> </div> -->
              <?php
              }
               else
               {
                $this->load->helper('url');
                redirect(base_url().'admin/users/expired_academy');
               ?>
              <!-- <div style="" class="exp_text"><div style="float: left;padding: 4px 0 0 0;"> Academy had expired before: <span style="font-family: 'AvenirNextLTPro-Demi';"><?php echo $interval->days; ?> </span>days ago</div> </div> -->
               <?php 
              }
              ?>  

              <!-- <span class="exp-acdmy">  -->
              <?php 
              if(($this->uri->segment(2)!="create" && $this->uri->segment(3)!="lecture") || ($this->uri->segment(2)!="edit" && $this->uri->segment(3)!="lecture"))
                {

              ?>
              <!-- <a class="btn btn-success renew_account" style="margin-right: 2px;padding: 3px 14px 3px 11px;" onclick="openRenewalPopup('#renewalpopup'); "><span class="lnr lnr-sync"></span>Renew</a> 
              <a class="btn btn-orange account_options" style="    padding: 3px 10px 3px 10px;" onclick="openRenewalPopup('#accountoption');"> <span class="lnr lnr-user"></span>Account Options</a>  -->
            <?php } ?>
                <!-- </span>
           </div> -->

           <?php }  
           else if($currentdate > $getExpireDays->academy_expired)
           {
              $this->load->helper('url');
                redirect(base_url().'admin/users/expired_academy');
               ?>
              <!-- <div style="" class="exp_text"><div style="float: left;padding: 4px 0 0 0;"> Academy had expired before: <span style="font-family: 'AvenirNextLTPro-Demi';"><?php //echo $interval->days; ?> </span>days ago</div> </div> -->
               <?php
           }
         }?>

          <div class="col-md-6 clearfix header_right_sec">
            <div class="open_mobile_sidebar">
              <a href="#" class="sidebar-collapse-icon"> 
                  <span class="lnr lnr-menu" style="font-size: 30px;margin-right: 10px"></span>
              </a>
            </div>
            <ul class="right_menus">
              <li class="time_date">
               <span style="color: #5a5a5a;font-family: 'Roboto', sans-serif;"> <?php echo date("d M Y"); ?><br> <span id="servertime"></span> IST 
               </span>
              </li>
              <?php if($u_data['groupid']==='4'){ /*?>
              <li class="upgrade_menu">
                <a href="javaScript:void(0)" onclick="openRenewalPopup('#accountoption');"><i class="fas fa-star"></i>Upgrade</a>
              </li>
            <?php } */ }?>
              <!-- <li class="message_menu">
                <a href="#"><span class="lnr lnr-bubble" style=" font-size: 25px;position: relative;top: -4px;"></span></a>
              </li> -->
              <li class="chat_menu">
                <ul class="user-info pull-left pull-none-xsm">
                  <ul class="user-info pull-left pull-right-xs pull-none-xsm">
                    <li id="discuss_alert" class="notifications dropdown_alarm dropdown">
                      <a href="#" title="Disscussions" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><span class="lnr lnr-bubble" style="font-size: 25px;position: relative;top: -5px;"></span><?php if(count($get_discussion)>0){ ?><!-- <span class="not_badge"><?php //echo count($get_discussion);?></span> --> <?php } ?>
                      </a>
                      <ul class="dropdown-menu">
                        <li class="top">
                            <p class="small" style="font-family: 'AvenirNextLTPro-Regular';"> <a href="javascript:void(0)" onclick="markreadDis()" style="font-family: 'AvenirNextLTPro-Demi';" class="pull-right">Mark all Read</a> <strong><?php /*echo count($get_discussion);if(count($get_discussion)==1){echo " Query has arise for courses.";}else{echo " Queries are arise for courses.";}*/?>Discussions</strong>
                            </p>
                        </li>
                        <li>
                          <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: none;" tabindex="5001">
                              <?php
                              foreach($get_discussion as $discuss)
                              {         
                                  $notify_date = get_timeago2(strtotime($discuss->dateandtime)); 
                              ?>
                              <li class="unread notification-success"> <a href="<?php echo base_url().'admin/programs/discussions/'.$discuss->id; ?>"> <?php  //if($discuss->viewed == 0) { 
                                      echo "<span class='line'><strong id='strong1'>".$discuss->first_name." ".$discuss->last_name." had query on ".$discuss->name."</strong></span>";
                                      // } else { echo $discuss->first_name." ".$discuss->last_name." has query on ".$discuss->name; } ?> <span class="line small" style="font-size: 85%;"> <?php echo ' '.$notify_date;  ?>  </span>  </a> </li> 
                              <?php

                              }

                                    ?>        
                          </ul>
                        </li>
                      
                      </ul>
                    </li>
                  </ul>
                </ul>
              </li>

              <?php if($u_data['groupid']==='4'){ ?>
              <li class="notification_menu">
                <ul class="user-info pull-left pull-none-xsm">
                  <ul class="user-info pull-left pull-right-xs pull-none-xsm">
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
                    <li class="notifications dropdown">
                      <a href="#" title="Notifications"  class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><span class="lnr lnr-bullhorn" style="font-size: 25px;position: relative;top: -3px;"></span><?php if($notify>0){ echo '<span class="not_badge">'.$notify.'</span>'; } ?>
                      </a>
                      <ul class="dropdown-menu">
                        <li class="top">
                            <p class="small" style="font-family: 'AvenirNextLTPro-Regular';"> <a href="#" style="font-family: 'AvenirNextLTPro-Demi';" onclick="markread()" class="pull-right">Mark all Read</a> You have <strong><?php echo $notify;?></strong> new notifications. 
                            </p>
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
                          </ul>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </ul>
              </li>
              <?php } ?>

              <li class="bookmark_menu">
                <ul class="user-info pull-left pull-none-xsm">
                  <ul class="user-info pull-left pull-right-xs pull-none-xsm">
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
                    <li id="activity_alert" class="notifications dropdown_alarm dropdown">
                      <a href="#" title="Activities" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"><span class="lnr lnr-alarm" style="font-size: 25px;position: relative;top: -3px;"></span><?php if($viewed>0){ echo '<span class="not_badge">'.$viewed.'</span>'; } ?>
                      </a>
                      <ul class="dropdown-menu">
                        <li class="top">
                            <p class="small" style="font-family: 'AvenirNextLTPro-Regular';"> <a href="#" style="font-family: 'AvenirNextLTPro-Demi';" class="pull-right">Mark all Read</a> You have <strong><?php echo $viewed;?></strong> new notifications. 
                            </p>
                        </li>
                        <li>
                          <ul class="dropdown-menu-list scroller" style="overflow: hidden; outline: none;" tabindex="5001">
                              <?php
                              foreach($notification as $notify)
                              {         
                                if($notify->activity_date != date('Y-m-d'))
                                {
                                $datetime1 = date_create($notify->activity_date);
                                $datetime2 = date_create(date('Y-m-d'));
                                $interval = date_diff($datetime1, $datetime2);
                                $notify_date = $interval->format('%a days ago');
                                }
                                else
                                            {
                                  $notify_date = 'Today';
                                            }          
                              ?>
                              <li class="unread notification-success"> <a href="<?php echo base_url().'notification/activity/'.$notify->activity_id; ?>">  <?php  if($notify->viewed == 0) { echo "   <span class='line'><strong id='strong1'>".$notify->activity."</strong></span>"; } else { echo $notify->activity; } ?> <span class="line small" style="font-size: 85%;"> <?php echo ' '.$notify_date;  ?>  </span>  </a> </li> 
                              <?php

                              }

                                    ?>        
                          </ul>
                        </li> 
                        <li class="external"> 
                          <a href="<?php echo base_url().'notification/lists/'; ?>" style="margin: 0; padding: 0;">View all notifications
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </ul>
              </li>
              <li class="account_menu">
                <a href="javascript:void(0)" class="account_menu_open">
                  <span class="user_logo">
                    <img src="<?php echo base_url().$my_image; ?>" alt="" style="width: 100%; height: 100%; border-radius: 50%;"></span>
                  <span class="user_name"><?php echo $sessionarray['first_name']; ?> <span class="lnr lnr-chevron-down"></span></span>
                </a>
                <div class="account_popup">
                      <ul>
                        <li>
                        <?php //$auth = $this->session->userdata('logged_in');
                        ?>
                          <a onclick="<?php if($auth['groupid']=='4'){ ?>logoutPage()<?php }else{ ?>userlogoutPage()<?php } ?>" class="logout" href="javascript:void(0)"><i class="fas fa-sign-out-alt"></i> Log Out </a>
                        </li>
                      </ul>
                    </div>
              </li>
            </ul>
          </div>
    <?php //if($this->uri->segment(2) != 'exams'){ ?>
      </div>
    <?php //} ?>
    <?php $this->load->view("admin/partials/_flashdata");?>
    <?php echo $template['body']; ?> 
    <!-- Footer -->
    <footer class="main">
        <?php $this->load->view('admin/template/footer');?>
      </footer>
  </div>
  </div>
  <?php /*if($auth['groupid']!=5){ ?>
<div class="get_help_fix">
  <span class="ghf-img">
   <!--  <img src="<?php echo base_url();?>public/css/image/gethelp.jpg" alt="gethelp"> -->
   Help
  </span>

  <ul class="ghf-menu">
    <li><a href="<?php echo base_url();?>admin/settings/view_videos">How-To Video Tutorials</a></li>
    <li><a href="<?php echo base_url();?>admin/settings/help_to_manage_academy">Help To Manage Academy</a></li>
    <li><a href="<?php echo base_url();?>admin/settings/support_team">Contact Support</a></li>
    <!-- <li><a href="#">item 4</a></li> -->
  </ul>
</div>
<?php } */?>
<style type="text/css">

</style>

<div id="lean_overlay" style="display: none; opacity: 0;"></div> 
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
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
<!-- <script type='application/javascript' src='<?php //echo base_url();?>public/js/fastclick.js'></script> -->
<link rel="stylesheet" href="<?php echo base_url('assets/js/rickshaw/rickshaw.min.css'); ?>"  id="style-resource-2">
<script type="text/javascript" src="<?php echo base_url('assets/js/gsap/main-gsap.js'); ?>"  id="script-resource-1"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"  id="script-resource-2"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>" id="script-resource-3"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/joinable.js'); ?>" id="script-resource-4"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/resizeable.js'); ?>" id="script-resource-5"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/neon-api.js'); ?>" id="script-resource-6"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/cookies.min.js'); ?>" id="script-resource-7"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/fileinput.js'); ?>" id="script-resource-7"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.nestable.js'); ?>" id="script-resource-7"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-switch.min.js'); ?>" id="script-resource-8"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.sparkline.min.js'); ?>" id="script-resource-10"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/neon-custom.js'); ?>" id="script-resource-17"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>" id="script-resource-20"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/redactor123/assets/redactor.css" />
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/redactor.min.js"></script> 
<script>
   document.onkeydown = function(e) {
    if(e.keyCode == 123) {
     return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
     return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
     return false;
    }
    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
     return false;
    }

    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
     return false;
    }      
 }
</script>
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

var currenttime = '<?php print date("F d, Y H:i:s", time())?>'; 

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
              icon: "http://www.create-online-academy.com/public/uploads/settings/img/logo/2788_09-29-2015.png",
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
 // $this->load->view('admin/progressbar/prograssbarpop');
} 
?>
<?php
// if($this->uri->segment(2)!="tasks" && ($this->uri->segment(3)!="create" || $this->uri->segment(3)!="edit"))
if($this->uri->segment(1)!="" && (($this->uri->segment(2)!="edit" || $this->uri->segment(2)!="create") && $this->uri->segment(3)!="lecture"))
{
 $this->load->view('admin/progressbar/academyrenewal');
} 
?>
<?php
// if($this->uri->segment(2)!="tasks" && ($this->uri->segment(3)!="create" || $this->uri->segment(3)!="edit"))
// if(($this->uri->segment(2)!="edit" && $this->uri->segment(3)!="lecture"))
// {
//  $this->load->view('admin/progressbar/academyrenewal');
// } 
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
      function userlogoutPage()
      {        
        delete_cookie('ci_session');
        window.location.replace("<?php echo base_url(); ?>users/logout");
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

<!--for mobile view -->
<script type="text/javascript">
 /* var viewMode = getCookie("view-mode");
 if (viewMode == "mobile"){
    viewport.setAttribute('content', 'width=1200');
}*/
</script>
 <script>
    

    //for responsive sidebar collapsed
    $(document).ready(function(){
      if ($(window).width() < 767){
          $("#sidebar-collapse").click(function(){
            $(".sidebar-menu").toggleClass("responsive_sidebar");
            $(".main-content").toggleClass("responsive_main_content");  
          });
      }

       $(".open_mobile_sidebar a").click(function(){
         $("body .page-container #sidemenu.sidebar-menu").addClass("sidemenu_mobile");
       });
       $(".close_mobile_sidebar a").click(function(){
         $("body .page-container #sidemenu.sidebar-menu").removeClass("sidemenu_mobile");
       });
       $(document).mouseup(function(e) 
          {
              var container = $("body .page-container #sidemenu.sidebar-menu");
              var container2 = $(".open_mobile_sidebar a");
              // if the target of the click isn't the container nor a descendant of the container
              if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0) 
              {
                  container.removeClass("sidemenu_mobile");
              }
          });

    });

    // For account popip
    $(document).ready(function(){
    $('.account_menu_open').click(function(event){
        event.stopPropagation();
         $(".account_popup").toggle();
    });
    $(".account_popup").on("click", function (event) {
        event.stopPropagation();
    });
    });

    $(document).on("click", function () {
        $(".account_popup").hide();
    });


</script>
<script>
  function markread()
  {
     $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>notification/getUnreadNotific",              
              success: function(data)
              {
                
              $("#activity_alert ul>li strong").css('color','#939496');
          $("#activity_alert ul>li strong").css('font','inherit');
          $("#activity_alert").find(".badge-info").html('0');         
          // $("#newnotify").html('0');
              }
    });
      
     
  }
   function markreadDis()
  {
     $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>notification/getUnreadDis",              
              success: function(data)
              {
                
              $("#discuss_alert ul>li strong").css('color','#939496');
          $("#discuss_alert ul>li strong").css('font','inherit');
          $('#discuss_alert').find(".badge-info").html('0');         
          // $("#newnotify").html('0');
              }
    });
      
     
  }

  function getpayout(pay_page,controller) {
  if(pay_page==0)
  {
    pay_page =1;
  }
    var url = "<?php echo base_url()?>"+controller+"/";
    $.ajax({
      url : url,
      type : "post",
      cache : false,
      data :  {pay_page : pay_page},
      // beforeSend: function(){$("#overlay").show();},
      success: function(data){
          var obj = $.parseJSON(data);
                    $('#payout_content').html(obj.payoutdata);
          $('#ajax_payout').html(obj.paying);
          $("#table-3_info").html("Showing "+obj.firstp+" to "+obj.startp+" of "+obj.total_payout+" entries");
      },
      error: function() 
      {}          
     });
  }

  function getpayoutadmin(pay_page,controller) {
  if(pay_page==0)
  {
    pay_page =1;
  }
    var reseller_id = $('#reseller_id').val().trim();
    var url = "<?php echo base_url()?>admin/"+controller+"/edit/"+reseller_id;
    $.ajax({
      url : url,
      type : "post",
      cache : false,
      data :  {pay_page : pay_page},
      // beforeSend: function(){$("#overlay").show();},
      success: function(data){
          var obj = $.parseJSON(data);
                    $('#payout_content').html(obj.payoutdata);
          $('#ajax_payout').html(obj.paying);
          $("#table-3_info").html("Showing "+obj.firstp+" to "+obj.startp+" of "+obj.total_payout+" entries");
      },
      error: function() 
      {}          
     });
  }
</script>
