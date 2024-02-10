 <style>
.login-form .form-group .input-group .error {
position: absolute;
right: 10px;
top: 50%;
margin-top: -8px;
font-size: 10px;
}
label {
  display: inline-block;
  margin-bottom: 5px;
  margin-top: 5px;
  margin-bottom: -5px;
}
.login-out-content {
	box-shadow: 5px 7px 20px #bbb;
	/* border: 1px solid #ddd; */
}
.page-body.login-form-fall.loaded.login-form-fall-init {
    background-image: none;
    background: #fff;
}
.login-header .login-out-content img {
    width: auto !important;
    margin: 0 auto !important;
}
 </style>
    <!--<h2><?php lang('web_login_access')?></h2>-->
		<?php
	    $attributes = array('class' => 'tform', 'id' => 'loginfrom');
        echo form_open_multipart(base_url().'admin/users/login', $attributes);
        ?>
        
        <span id="msg"></span>
     <label id="username-error" class="error" for="username"><?php echo form_error('mymsg') ?>
    <?php echo form_error('mymsg2') ?></label>
	<div class="form-group">
		<div class="input-group">
		<div class="input-group-addon">
		<i class="entypo-user"></i>
		</div>
		<input id="user_name" class="form-control" placeholder="Username" type="text" name="user_name" maxlength="256" autocomplete="off" value="<?php echo set_value('user_name'); ?>"  />
        
		</div>
		<label id="username-error" class="error" for="username"><?php echo form_error('user_name'); ?></label>
        
	</div>
				
	<div class="form-group">
		<div class="input-group">
		<div class="input-group-addon">
		<i class="entypo-key"></i>
		</div>
		<input id="password" type="password" name="password" placeholder="Password" class="form-control" maxlength="256" autocomplete="off" value="<?php echo set_value('password'); ?>"  />
		</div>
		<label id="password-error" class="error" for="password"><?php echo form_error('password'); ?></label>     		
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary btn-block btn-login" id ="loginbutton">
		<i class="entypo-login"></i>
		Login
		</button>
	</div>
	
    <?php echo form_close();?>
    

   	<div class="login-bottom-links" style="padding-top: 10px;">
		<a target="_top" href="<?php echo base_url();?>mlms/member/login/forgot_password/" id="link-forgot-passwd">
    	<?=lang('web_login_remb')?>
        </a>
	</div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script >
	$(document).ready(function(){

			$(document).find('.login-out-content').find('a').attr('href','');
	});
</script>

