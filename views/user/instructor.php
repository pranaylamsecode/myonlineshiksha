<section class="container courses">
           <div class="row-fluid ">
<br>
<!--<div class="logdivcon">-->
    <div class="fullcontent">
    <?php
    $attributes = array('class' => 'tform', 'id' => 'register');
    echo form_open('/users/instructor', $attributes);
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

	
	<?php
	if($this->session->userdata('logged_in'))
	{
	?>
	<div class="login-box-container">
        <div id="login-form-wrapper" class="cell">
            <div class="admintable">
                <!--<div class="logtitle">Become an Instructor</div>-->
							 <div>
            					<!--<label>Email<span style="color:#FF0000;" class="error">*</span></label>-->
            					<input id="teach" type="text" name="teach" maxlength="60" value="<?php echo set_value('teach', (isset($teach)) ? $teach : ''); ?>" placeholder="What do you want to teach?" />
								<span class="error"><?php echo form_error('teach'); ?></span>
            				 </div>
							 
                            <div>
            							<?php echo form_submit( 'submit', 'Sign Up', "class='beditform'"); ?>
										or <a href="#" >Login</a>
            			   	</div>
        </div>
        </div>
    </div>
	<?php
	}
	else
	{
	?>
	<div class="titleholder"><h5>Discover a supportive community of online instructors. Get instant access to all course creation resources.</h5></div>

    <div class="login-box-container">

        <div id="login-form-wrapper-cont" class="cell">

            <div class="admintable">

                <!--<div class="logtitle">Become an Instructor</div>-->

                             <div>
            					<!--<label>First Name<span style="color:#FF0000;" class="error">*</span></label> -->
            					<input id="first_name" type="text" name="first_name" maxlength="256" value="<?php echo set_value('first_name', (isset($first_name)) ? $first_name : ''); ?>" placeholder="First Name" />
                                <span class="error"><?php echo form_error('first_name'); ?></span>
            	             </div>

            				 <div>
            					<!--<label>Last Name<span style="color:#FF0000;" class="error">*</span></label>-->
            					<input id="last_name" type="text" name="last_name" maxlength="256" value="<?php echo set_value('last_name', (isset($last_name)) ? $last_name : ''); ?>" placeholder="Last Name" />
                                <span class="error"><?php echo form_error('last_name'); ?></span>
            				 </div>

                             <div>
            					<!--<label>Email<span style="color:#FF0000;" class="error">*</span></label>-->
            					<input id="email" type="text" name="email" maxlength="256" value="<?php echo set_value('email', (isset($email)) ? $email : ''); ?>" placeholder="Email" />
								<span class="error"><?php echo form_error('email'); ?></span>
            				 </div>

                            <div>
            					<!--<label>Password<span style="color:#FF0000;" class="error">*</span></label>-->
            					<input id="password" type="password" name="password" maxlength="256" autocomplete="off" value="<?php echo set_value('password'); ?>" placeholder="Password" />
                                <span class="error"><?php echo form_error('password'); ?></span>
            				 </div>

                             <div>
								<!--<label>Confirm Password<span style="color:#FF0000;" class="error">*</span></label> -->
            					<input id="password_confirm" type="password" name="password_confirm" autocomplete="off" maxlength="256" value="<?php echo set_value('password_confirm'); ?>" placeholder="Confirm Password" />
                                <span class="error"><?php echo form_error('password_confirm'); ?></span>
            				 </div>
							 
							 <div>
            					<!--<label>Email<span style="color:#FF0000;" class="error">*</span></label>-->
            					<input id="teach" type="text" name="teach" maxlength="60" value="<?php echo set_value('teach', (isset($teach)) ? $teach : ''); ?>" placeholder="What do you want to teach?" />
								<span class="error"><?php echo form_error('teach'); ?></span>
            				 </div>
							 
                            <div>
            							<?php echo form_submit( 'submit', 'Sign Up', "class='btn-primary_stb'"); ?>
										<span style="margin-right:10px;">or</span> <a href="<?php echo base_url(); ?>/users/login/" >Login</a>
            			   	</div>
        </div>
        </div>
    </div>
	<?php
	}
	?>
    <?php echo form_close(); ?>
    </div>
<!--</div>-->
</div>
</section>