<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="twitter:card" content="summary">
      <meta name="medium" content="mult">
      <meta http-equiv="Content-Language" content="en-us">

      <?php 
        $CI =& get_instance();
        $CI->load->helper('commonmethods');
        $CI->load->model('admin/settings_model'); 
        $getTheme = $CI->settings_model->getItems();

        $meta_title2 = (isset($getTheme[0]['meta_title']) && trim($getTheme[0]['meta_title'])!= '') ? trim($getTheme[0]['meta_title']) : "MLMS3";
          $meta_keyword2 = (isset($getTheme[0]['meta_keyword']) && trim($getTheme[0]['meta_keyword'])!= '') ? trim($getTheme[0]['meta_keyword']) : "MLMS4";
        $meta_description2 = (isset($getTheme[0]['meta_desc']) && trim($getTheme[0]['meta_desc'])!= '') ? trim($getTheme[0]['meta_desc']) : "MLMS Institute";
        $ogImg= base_url().'public/uploads/settings/img/logo/'.$getTheme[0]['bannerimage'];
      ?>

      <title>
          <?php echo $meta_title2; ?>
      </title>
      <meta name="title" content="<?php echo $meta_title2; ?>" />
      <meta name="description" content="<?php echo $meta_description2; ?>">
      <meta name="keywords" content="<?php echo $meta_keyword2; ?>">
      <link rel="stylesheet" href="<?php echo base_url(); ?>public/new_template/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>public/new_template/css/new_template.min.css" type="text/css" media="screen" />
      <link rel="stylesheet" media="screen and (max-device-width: 1200px)" href="<?php echo base_url(); ?>public/new_template/css/responsive.min.css" type="text/css">
      <link rel="icon" href="<?php echo base_url() ?>public/images/myonlineshiksha-favicon.png" type="image/gif">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/new_template/tooltipster-master/dist/css/tooltipster.bundle.min.css" />

      <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">

        window.addEventListener('load', function() {
            new FastClick(document.body);
        }, false);

        $(document).on('click', '#go', function() {
            closeNav();
        });

        var $ = jQuery.noConflict();

        $(function() {
            $('a[rel*=leanModal]').leanModal({
                closeButton: ".modal_close"
            });

        });

        $(document).ready(function() {
            $("#signup").leanModal();
        });
        $(document).ready(function() {
            $("#signup").leanModal({
                top: 200,
                overlay: 0.4,
                closeButton: ".modal_close"
            });
        });
      </script>
      <script>
        $(function() {
            $('#banner_menu li').on('click', function() {
                $(this).parent().find('li.active').removeClass('active');
                $(this).addClass('active');
            });
        });
        $(function() {
            $('.add_overlay').on('click', function() {
                $('.res_overlay').css("display", "block");
            });
        });
        $(function() {
            $('.close_popup').on('click', function() {
                $('.res_overlay').css("display", "none");
            });
        });
      </script>
</head>
    
    <!-- course page header -->
    <?php

     $CI =& get_instance();

    $CI->load->model('admin/settings_model');
    $getItemssetting = $CI->settings_model->getItems();
    $callpages = $CI->settings_model->getAllPages();
    $countpage = count($callpages);
    $currenttemplate = $getItemssetting[0]['layout_template'];
    $settings = $CI->settings_model->getTemplateById($currenttemplate);
    $data11 = $settings[0]['options'];
    $data = json_decode($data11);
    $allsociallinks=$CI->settings_model->getSocialLinks();
    $auth = $this->session->userdata('logged_in');
    //echo ($auth['groupid']);
    $logoimage=$getItemssetting[0]['logoimage'];
    $title = $getItemssetting[0]['univer_title'];
    $tagline_font = $getItemssetting[0]['tagline_font'] ? $getItemssetting[0]['tagline_font'] :'';
    $tagline_font_size = $getItemssetting[0]['tagline_font_size'] ? $getItemssetting[0]['tagline_font_size'] :'';
    $tagline_font_color = $getItemssetting[0]['tagline_font_color'] ? $getItemssetting[0]['tagline_font_color'] :'';
    extract($getItemssetting[0]);
    $menulayout = json_decode($ctgspage);
    $searchbox = json_decode($ctgpage);
    $menu_layout = $menulayout->ctgs_image_alignment;
    $searchbox_val = $searchbox->ctg_image_alignment;
    $userDetail = $CI->settings_model->getAllUsersDetail($auth['id']);
    $notification = $CI->settings_model->getNotification($auth['id']);
    $viewed = 0;
    foreach($notification as $notify)
    {
      if($notify->viewed == 0)
      {
        $viewed++;
      }
    }

    $LM =& get_instance();
    $LM->load->model('login_model');
    $get_student_instr = $LM->login_model->get_student_instr();
    ?>
    <nav class="navbar navbar-default topnavbar">
      <div class="container-fluid first_nav">
        <div class="left_header">
          <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/images/MyOnlineShiksha-logo.svg"></a>
          </div>
        </div>
        <div class=" text-right">
          <ul class="nav navbar-nav navbar222">
            <?php //if(!empty($_session['loggedin'])){echo "login success";}else{echo "sign in first";} ?>
            <li class=""><a id="go" rel="leanModal" name="signup" href="#signup" class="btn btn-default btnlogin">Log In</a>
            </li>
            <li class=""><a id="go" rel="leanModal" name="registration" href="#registration" class="btn btn-default btn-signup">Sign Up</a></li>
            <div id="lean_overlay" style="display: none; opacity: 0;"></div>
          </ul>
        </div>
      </div>
    </nav>
      <!-- category submenu  -->
<form role="form" class="tform" action="#" name="studentForm" id="studentForm" method="post">
<div id="signup">
   <span id="msgspan"></span>
   <div id="signup-ct">
      <a class="modal_close close_popup" href="#"><span class="lnr lnr-cross"></span></a>
      <div class="left_panel">
         <h1>Sign in to MyOnlineShiksha</h1>
         <p class="create_new">or <a onclick="closeLogin();" id="go" class="registration sign_up_text" rel="leanModal" name="registration" href="#registration">create new account</a></p>
         <div class="social_btn_space">
            <a href="https://myonlineshiksha.com/hauth/login/Facebook" target="_blank" class="btn btn-fb-social facebook"><i class="entypo-facebook social-icon"></i>
            <span>Login with Facebook</span></a>
         </div>
      </div>
      <div class="right_panel_log_popup">
         <div id="messageStudent"></div>
         <div class="txt-fld">
            <label>Email</label>
            <input id="email1" type="text" size="15" onkeypress="Javascript: if (event.keyCode==13) loginUser();" name="email" autocomplete="off" value="" placeholder="E-mail">
         </div>
         <div class="txt-fld">
            <label>Password</label>
            <input id="password1" type="password" onkeypress="Javascript: if (event.keyCode==13) loginUser();" name="password" autocomplete="off" value="" size="38" placeholder="Password">
         </div>
         <div class="btn-fld">
            <button type="submit" onclick="loginUser();" class="btn-primary_stb" style="width:100%">Sign in <span class="right_arrow"><span class="lnr lnr-arrow-right"></span></span>
            </button>
         </div>
         <div class="forgot_pass">
            <p>
               <a id="go" onclick="closeLogin();" rel="leanModal" name="forget" href="#forget"> Forgot Password</a>
            </p>
         </div>
      </div>
   </div>
</div>
</form>
    <!---Registration PopUp-->
    <form role="form" class="tform" action="<?php echo base_url();?>member_login/registration/" name="registerPopup" id="registerPopup" method="post">
      <div id="registration">
        <div id="signup-ct">
          <a class="modal_close close_popup" href="#"><span class="lnr lnr-cross"></span></a>

          <div class="register_title">
              <span style="float: left;font-size: 23px;font-weight: 100 !important;margin-top: -9px;">New Account</span>
              <span style="float: right;">Have an account? <a onclick="closeRegi();" id="go" class="registration sign_up_text" rel="leanModal" name="signup" href="#signup">Sign in</a></span></div>
          </div>
          <div class="resister_up_block">
            <div id="messageRegistration"></div>
            <div class="txt-fld" style="margin-top: 5px;">
                <label>First Name</label>
                <input id="first_namePopup" type="text" name="first_namePopup" maxlength="256" value="<?php echo set_value('first_name', (isset($first_name)) ? $first_name : ''); ?>" placeholder="First Name" />
            </div>

            <div class="txt-fld">
                <label>Last Name</label>
                <input id="last_namePopup" type="text" name="last_namePopup" maxlength="256" value="<?php echo set_value('last_name', (isset($last_name)) ? $last_name : ''); ?>" placeholder="Last Name" />
            </div>

            <div class="txt-fld">
                <label>Email</label>
                <input id="emailPopup" type="text" name="emailPopup" maxlength="256" value="<?php echo set_value('email', (isset($email)) ? $email : ''); ?>" placeholder="Email" />
            </div>

            <div class="txt-fld">
                <label>Password</label>
                <input id="passwordPopup" type="password" name="passwordPopup" maxlength="256" autocomplete="off" placeholder="Password" />
            </div>

            <div class="txt-fld">
                <label>Confirm Password</label>
                <input id="password_confirmPopup" type="password" name="password_confirmPopup" autocomplete="off" maxlength="256" placeholder="Confirm Password" />
            </div>
            <div class="fm-btn">
              <input type='submit' id='submitPopup' name='submitPopup' value='Create your account
              ' class='btn-primary_stb'>
              <span class="right_arrow"><span class="lnr lnr-arrow-right"></span></span>
          </div>
        </div>
      </div>
    </form>
    <!--End Registration Form-->

<?php $this->load->view('new_template_design/footer');?>
<script>
        // For Registration
        $(function() {
            var action = '';
            var form_data = '';
            $('#submitPopup').click(function() {
                action = $("#registerPopup").attr("action");
                form_data = {
                    firstname: $("#first_namePopup").val(),
                    lastname: $("#last_namePopup").val(),
                    email: $("#emailPopup").val(),
                    password: $("#passwordPopup").val(),
                    password_confirm: $("#password_confirmPopup").val(),
                };
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: form_data,
                    success: function(response) {
                        //alert(response);
                        if (response == 'success') {
                            $("#signup-ct").slideUp('slow', function() {
                                $("#registration").html('<p style="color:green; text-align:center;"><h2>Please Check your Email.</h2></p>');
                            });

                            setTimeout(
                                function() {
                                    var base_url = window.location.origin;
                                    window.location.replace(base_url);
                                }, 5000);
                        } else if (response == 'Password and confirm password is not equal...') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Password and confirm password is not equal...</b></p></div>');
                        } else if (response == 'Please fill proper data...') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Please fill proper data...</b></p></div>');
                        } else if (response == 'Email Already Exist.') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Email Already Exist.</b></p></div>');
                        } else if (response == 'Password atleast 6 digits') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Password atleast 6 digits</b></p></div>');
                        }
                    }
                });
                return false;
            });
        });
    </script>
<script>
function loginUser() {
    var email = $("#email1").val();
    var password = $("#password1").val();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>member_login/loginPopup",
        data: {
            email: email,
            password: password
        },
        success: function(response) {
            if (response == 'success') {
              
                $('.close_popup').click();
                window.location.replace(window.location.origin + '/index/index');
            } else if (response == 'success123') {
                $('.close_popup').click();
                window.location.replace(window.location.href);
            } else if (response) {
                $('.close_popup').click();
                window.location.replace(response);
            } else {
                $("#messageStudent").html('<p style="font-size: 15px;color:red;text-align:center;padding-bottom:4%;"><b>Invalid username and/or password.</b></p>');
            }
        }
    });
}
function closeLogin() {
            $('#signup').css({
                "display": "none"
            })
        }

        function closeRegi() {
          $('#registration').css({
                "display": "none"
            })
        }

</script>