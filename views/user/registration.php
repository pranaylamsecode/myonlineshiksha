
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
	top: 11px;
	color: #fff;
	right: 175px;
	font-size: 18px;
}
.login_btn input {
	text-align: center !important;
}
</style>

<section class='container courses'>



<!-- <div class="titleholder"><h5>Do you have an account on our site?</h5></div>-->

<!--Div for First Section -->

<div class="sign_up_block">

<?php
    $attributes = array('class' => 'tform', 'id' => 'register');

    echo form_open('/users/registration', $attributes);

    if(isset($fbuserdata)){

    $fbfirst_name = $fbuserdata['first_name'];

    $fblast_name = $fbuserdata['last_name'];

    $fbemail = $fbuserdata['email'];

    $fbid = $fbuserdata['id'];

    }

    $first_name = (isset($fbfirst_name))?$fbfirst_name:null;

    $first_name = (isset($user->first_name))?$user->first_name:$first_name;

    $last_name = (isset($fblast_name))?$fblast_name:null;

    $last_name = (isset($user->last_name))?$user->last_name:$last_name;

    $email = (isset($fbemail))?$fbemail:null;

    $email = (isset($user->email))?$user->email:$email;

    ?>
	
<div class="register_title">
<span style="float: left;font-size: 23px;font-weight: 100 !important;margin-top: -9px;">New Account</span>
<span style="float: right;">Have an account? <a href="<?php echo base_url(); ?>users/login">Sign in</input></a></span>
 </div>                          
	<div>
	<!--<label>First Name<span style="color:#FF0000;" class="error">*</span></label> -->
	 <label>First Name</label>
	<input id="first_name" type="text" name="first_name" maxlength="256" value="<?php echo set_value('first_name', (isset($first_name)) ? $first_name : ''); ?>" placeholder="First Name" />
	<span class="error"><?php echo form_error('first_name'); ?></span>

</div>

	<div>
<!--<label>Last Name<span style="color:#FF0000;" class="error">*</span></label>-->
<label>Last Name</label>
<input id="last_name" type="text" name="last_name" maxlength="256" value="<?php echo set_value('last_name', (isset($last_name)) ? $last_name : ''); ?>" placeholder="Last Name" />

<span class="error"><?php echo form_error('last_name'); ?></span>

</div>

	<div>

<!--<label>Email<span style="color:#FF0000;" class="error">*</span></label>-->
<label>Email</label>
<input id="email" type="text" name="email" maxlength="256" value="<?php echo set_value('email', (isset($email)) ? $email : ''); ?>" placeholder="Email" />

<span class="error"><?php echo form_error('email'); ?></span>

</div>

	<div>

<!--<label>Password<span style="color:#FF0000;" class="error">*</span></label>-->
<label>Password</label>
<input id="password" type="password" name="password" maxlength="256" autocomplete="off" value="<?php echo set_value('password'); ?>" placeholder="Password" />

<span class="error"><?php echo form_error('password'); ?></span>

</div>

	<div>
<!--<label>Confirm Password<span style="color:#FF0000;" class="error">*</span></label> -->
<label>Confirm Password</label>
<input id="password_confirm" type="password" name="password_confirm" autocomplete="off" maxlength="256" value="<?php echo set_value('password_confirm'); ?>" placeholder="Confirm Password" />

<span class="error"><?php echo form_error('password_confirm'); ?></span>

</div>

<div class="login_btn">
	<?php echo form_submit( 'submit', 'Submit', "class='btn-primary_stb'"); ?>
	<!-- <span class="right_arrow"><span class="lnr lnr-arrow-right"></span></span> -->
</div>
<div class="social_signup">
<h4>Sign Up With Social Accounts</h4>
	
		<ul class="social-networks">
				<li>
					<a href="<?php echo base_url(); ?>auth_oa2/session/google/">
					<!-- <i class="entypo-gplus"></i> -->Sign Up With Google+
					</a>
				</li>		
				
                <li>
					<a href="<?php echo base_url(); ?>auth_oa2/session/facebook/">
					<!-- <i class="entypo-facebook"></i> -->Sign Up With Facebook
					</a>
				</li>
			</ul>
</div>

	


<?php echo form_close(); ?>


</div>


</div>

</section>
