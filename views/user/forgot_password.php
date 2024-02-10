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
    text-align: left;
display: inline-block;
width: 100%;
}
.login_btn a {
    text-align: right;
    display: block;
}
.login_btn input {
    margin-bottom: 10px !important;
}
.login_btn {
    display: inline-block;
    float: left;
}
.fb-connect-button.fb_button {
    display: block;
    margin-bottom: 10px;
    margin-top: 30px;
}
.right_arrow span {
    float: right;
    position: absolute;
    top: 11px;
    color: #fff;
    right: 175px;
    font-size: 18px;
}
.login_btn input {
    text-align: center !important;
}
</style>
<section class="container courses">
           <div class="row-fluid ">

<?php
if(!isset($resetmsg) || $resetmsg=='')
{
?><br>
<div class="logdivcon">
    <div class="fullcontent">
<div class="forgot_title">
     <h1>Password Recovery</h1>

    <p>Enter the email address that you used when creating your account and we will send you everything you need to recover your password.</p>
  </div>
<div class="login-box-container" align="center">
<div id="login-form-wrapper" class="cell">
                <?php $attributes = array('class' => 'fpform', 'id' => 'fpform');
                echo form_open_multipart(base_url().'users/forgot_password', $attributes); ?>

    			<!--<div class="title">Forgot Password</div>  -->
                    <span class="error"><?php echo form_error('mymsg') ?></span>
    				<div>
    					<div>
    						<!--<label>Email Id: <span class="error">*</span></label>-->
    						<input id="email" type="text" size="15" name="email" autocomplete="off" value="<?php echo set_value('email'); ?>" placeholder="Email Id" />                       <br />
                            <span class="error"><?php echo form_error('email'); ?></span>
    					</div>
    					<div style="display: inline-block;
width: auto;">
                        <div class="login_btn">
    					<?php echo form_submit( 'submit', 'Reset Password', "class='btn-primary_stb'"); ?>
                        </div>
                <span style="display: inline-block;float: left;margin-top: 10px">
    <a href="<?php echo base_url(); ?>users/login" style="padding: 10px 20px;">Sign in</a></span>
    					</div>

    				</div>
    				
    				<input type="hidden" value="mycourses" name="returnpage">
    				<input type="hidden" value="0" name="cid">
                     <?php echo form_close();?>
    </div>
    </div>
    </div>
</div>
<?php
}else
{
?>
<div class="fullcontent">
	<div class="title"><?php echo $resetmsg;?></div>
</div>
<?php
}
?>

</div>
</section>