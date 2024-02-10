 <style>
 body.page-body {
    background: url('<?php echo base_url() ?>public/images/nmu-ad-bg.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}
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
 </style>
    <!--<h2><?php lang('web_login_access')?></h2>-->
		<?php
	    $attributes = array('class' => 'tform', 'id' => 'loginfrom');
        echo form_open_multipart(base_url().'admin/users/login_action', $attributes);
        ?>
        
        <span id="msg"></span>
     <label id="username-error" class="error" for="username"><?php echo form_error('mymsg') ?>
    <?php echo form_error('mymsg2') ?></label>
	<div class="form-group">
		<div class="input-group">
		<div class="input-group-addon">
		<i class="entypo-user"></i>
		</div>
		<input id="user_name" class="form-control" placeholder="Username" type="text" name="user_name" maxlength="256" autocomplete="off" value="<?php echo set_value('user_name'); ?>" required />
        
		</div>
		<label id="username-error" class="error" for="username"><?php echo form_error('user_name'); ?></label>
        
	</div>
				
	<div class="form-group">
		<div class="input-group">
		<div class="input-group-addon">
		<i class="entypo-key"></i>
		</div>
		<input id="password" type="password" name="password" placeholder="Password" class="form-control" maxlength="256" autocomplete="off" value="<?php echo set_value('password'); ?>"  required/>
		</div>
		<label id="password-error" class="error" for="password"><?php echo form_error('password'); ?></label>     		
	</div>
	
				
	<!--<div class="form-group">					
	<i class="entypo-login"></i>
	<?php //echo form_submit( 'submit', 'Login', "class='btn btn-primary btn-block btn-login'"); ?>
	</div>-->
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary btn-block btn-login" id ="loginbutton">
		<i class="entypo-login"></i>
		Login
		</button>
	</div>
				
    <!--<div class="login-bottom-links" style="padding-top: 10px;">
		<a href="<?php echo base_url();?>admin/users/register" id="register">Don't have an account? Join Today!</a>						
	</div>
 
	You can also use other social network  -->
	<!--<div class="form-group">
	<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left twitter-button">
	Login with Twitter
	<i class="entypo-twitter"></i>
	</button>
	</div>-->
				
    <!-- Implemented in v1.1.4 -->				
    <!--<div class="form-group">
	<em>- or -</em>
	</div>
		
	<div class="form-group">
		<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">
		Login with Facebook
		<i class="entypo-facebook"></i>
		</button>					
	</div>
                
	<div class="form-group">
		<button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left google-button">
		Login with Google+
		<i class="entypo-gplus"></i>
		</button>
	</div> -->
    <?php echo form_close();?>
    

   	<div class="login-bottom-links" style="padding-top: 10px;">
		<!-- <a target="_top" href="<?php echo base_url();?>mlms/member/login/forgot_password/" id="link-forgot-passwd"> -->
    	<?=lang('web_login_remb')?>
        </a>
	</div>




	<script>
// For Student Login
/*$(function(){
    var action = '';
    var form_data = '';
    $('#loginbutton').click(function () {
    	alert('yes');
         action = $("#loginfrom").attr("action");
		 
         form_data = {
         user_name: $("#user_name").val(),
         password: $("#password").val(),
         is_ajax: '1'};  
		 //alert('aaa');
        $.ajax({
            type: 'POST',
            url: action,
            data: form_data, 
            success: function(response) 
			{
				alert(response);
                if(response == 'success') 
				{
					
							//do something special
					window.location.replace("<?php base_url(); ?>/admin");
																					
                }
				else 
				{ 
					$("#user_name").val('');
					$("#password").val('');
                    $("#msg").html('<p style="color:red;">Invalid username and/or password.</p>');
                }
            }
         }); 
        return false;      
    });  
});*/
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
	
	var optionsLogin = { 
    beforeSend: function() 
    {
    	$("#loginbutton").html('<i class="entypo-login"></i>Loading...');
    	$("#loginbutton").css('disable',true);
        // $("#progress_video").show();        
        // $("#bar_video").width('0%');
        // $("#message").html("");
        // $("#percent_video").html("0%");
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
        // $("#bar_video").width(percentComplete+'%');
        // $("#percent_video").html(percentComplete+'%');
        
 
    },
    success: function(response) 
    {     	
    	if(response == "success")
    	{
    		window.location.replace("<?php echo base_url() ?>admin");
    	}
    	else
    	{
    		//alert(response);

    		var str = '<p style="text-align: center; font-size: large;padding-top: 22px;">'+response+'</p>';

    		$.alert({
				    title: '',
				    content: str,
				});
    	}
       
        
    },
    complete: function(response) 
    {     	
          
        $("#loginbutton").html('<i class="entypo-login"></i>Login');
    	$("#loginbutton").css('disable',false);
         
    },
    error: function()
    {  
      alert('error');    
    }
 
}; 
 
$("#loginfrom").ajaxForm(optionsLogin);
</script>
