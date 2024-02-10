<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style>
input, textarea, .uneditable-input {
width: 206px;
}
section.container.courses {
    width: 100%;
    padding: 0px;
    padding-bottom: 0px !important;
    display: inline-block;
    width: 100%;
    text-align: center;
    padding: 50px 0px !important;
    background-color: transparent;
}
body{
    background-color: #f7f7f7;
}
label{
    font-weight: 100;
}
.login_btn a {
    text-align: right;
    display: block;
}
.login_btn input {
    margin-bottom: 10px !important;
}
.login_btn {
    position: relative;
}
.fb-connect-button.fb_button {
    display: block;
    margin-bottom: 10px;
    margin-top: 30px;
}
.right_arrow span {
    float: right;
    position: absolute;
    top: 8px;
    right: 10px;
    color: #fff;
}
</style>
<?php
  $CI =& get_instance();
  $CI->load->helper('commonmethods');
  $CI->load->model('admin/settings_model'); 
  $getTheme = $CI->settings_model->getItems();
  extract($getTheme[0]);
  $socialloginarray = json_decode($sociallogin);//variable sociallogin is come from database field json array onb date 08-09-2015
    if((empty($socialloginarray->facebook->appid)) && (empty($socialloginarray->facebook->appsecretkey)))//if fb details is blank
    {
        $fbUrl = '#';   
    }else
    {
        $fbUrl = base_url().'hauth/login/Facebook';
    }
    if((empty($socialloginarray->googleplus->clientid)) && (empty($socialloginarray->googleplus->clientsecreatekey)))//if googleplus details is blank
    {
        $gpUrl = '#';   
    }else
    {
        $gpUrl = base_url().'auth_oa2/session/google/';
    }
?>

<section class="container courses">
           <div class="row-fluid ">
<div class="logdivcon">
    <div class="fullcontent">
                <?php //$attributes = array('class' => 'tform', 'id' => 'login');
                //echo form_open_multipart(base_url().'users/loginPopup', $attributes); ?>
                <form class="tform" id="login" method="post" action="">
    				<div class="login-box-container">
                    
    					<div id="login-fb-wrapper" class="cell left_panel" style="vertical-align: top; text-align: left;">
                            <!-- <div class="titleholder"><h5>Do you have an account on our site?</h5></div> -->
                           <h1>Sign in to MyOnlineShiksha</h1> 
                           <p class="create_new">or <a href="<?php echo base_url(); ?>index.php/users/registration">create new account</a></p>
                            <!--<a href="<?php echo $fbloginUrl?>" class="fb-connect-button">Login with Facebook</a></div><br />-->
							<!--<a href="<?php echo base_url(); ?>auth_oa2/session/facebook/" class="fb-connect-button">Login with Facebook</a><br /><br />
							<a href="<?php echo $fbUrl;?>" class="fb-connect-button fb_button">Login with Facebook</a>
							
							<a href="<?php echo $gpUrl;?>" class="fb-connect-button google_button">Login with Google+</a>
							-->
                            
                        </div>
        				<div id="login-form-wrapper" class="cell right_panel_log_popup" style="margin:0;text-align: left;">
        					<span id="messageStudent2"></span>
                            <div>
        						<!--<label>Email Id: <span class="error">*</span></label>-->
                                 <label>Email</label>
        						<input id="email2" type="text" size="15" name="email" autocomplete="off" value="<?php echo set_value('email'); ?>" />                    <br />
                                <span class="error"><?php echo form_error('mymsg') ?></span>
                                <span class="error"><?php echo form_error('email'); ?></span>
        					</div>
        					<div>
        						<!--<label>Password: <span class="error">*</span></label>-->
                                 <label>Password</label>
        						<input id="password2" type="password" name="password" autocomplete="off" value="<?php echo set_value('password'); ?>"  size="38"/>
                                <br />
                                <span class="error"><?php echo form_error('password'); ?></span>
        					</div>
                            <div class="login_btn">
                            <?php //echo form_submit( 'submit', 'Login', "class='btn-primary_rockon btn-primary_stb'"); ?>
                            <input type="button" name="submit" value="Login" class="btn-primary_rockon btn-primary_stb" onclick="return loginUser2()">
                                <span class="right_arrow"><span class="lnr lnr-arrow-right"></span></span>
                            
                            <a href="<?php echo base_url()?>users/forgot_password" title="Forgot Password" >Forgot Password?</a></div>


                            <!--<tr>
        						<td></td>
        						<td>
        							<input type="checkbox" value="1" name="rememeber"> Remember Me						</td>
        					</tr>
        					<tr>
        						<td colspan="2">
        														<a href="/Joomla_test/index.php?option=com_users&amp;view=remind">I forgot my username</a> <br>
        														<a href="/Joomla_test/index.php?option=com_users&amp;view=reset">I forgot my password</a>

        						</td>
        					</tr>-->
        					<div>

                            <!--<div><div style="margin-left: 145px;;width:232px;"><div class="or" style="text-align:center;">OR</div><a href="<?php echo $fbloginUrl?>" class="fb-connect-button">Login with Facebook</a></div></div>-->
                            </div>
        				</div>
    				</div>
    				<input type="hidden" value="mycourses" name="returnpage">
    				<input type="hidden" value="0" name="cid">
                     <?php //echo form_close();?>
                     </form>
    </div>
    
    </div>
    </div>
    </section>
<script type="text/javascript">
     function loginUser2() {
            var email = $("#email2").val();
            var password = $("#password2").val();
            if (email=="")
            {
                $("#messageStudent2").fadeIn().html("Please enter email").css('color','red');
                setTimeout(function(){$("#messageStudent2").html("");},2000);
                $("#email2").focus();
                return false;
            }
            if (password=="")
            {
                $("#messageStudent2").fadeIn().html("Please enter password").css('color','red');
                setTimeout(function(){$("#messageStudent2").html("");},2000);
                $("#password2").focus();
                return false;
            }

            // $("#studentLogin").attr('disabled',true);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/loginPopup",
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    //alert(response);
                    if (response) {
                        window.location.replace(window.location.origin);
                    } 
                    else {
                        $("#messageStudent2").fadeIn().html("Invalid username and/or password").css('color','red');
                        setTimeout(function(){$("#messageStudent2").html("");},2000);
                        $("#password2").focus();
                        return false;
                    }
                }
            });
        }
</script>