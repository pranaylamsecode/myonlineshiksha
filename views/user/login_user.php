<link rel="stylesheet" href="http://192.168.1.13/lms/public/default/css/style.css" type="text/css" media="screen" />
<style type="text/css">
body {
  background: #fff;
}
form {
  padding: 20px;
}
input[type="submit"] {
  margin: 5px 0 0 143px;
}


</style>
<div class="content">
<div id="login_container">
			<h6>Login below</h6>
            <?php $attributes = array('class' => 'tform', 'id' => 'login');
            echo form_open_multipart('users/login', $attributes); ?>

				<div>
					<div>
						<label>Username: <span class="error">*</span></label>
						<input id="email" type="text" size="15" name="email" autocomplete="off" value="<?php echo set_value('username'); ?>"  />
                        <span class="error"><?php echo form_error('email'); ?></span>
					</div>
					<div>
						<label>Password: <span class="error">*</span></label>
						<input id="password" type="password" name="password" autocomplete="off" value="<?php echo set_value('password'); ?>"  size="38"/>
                        <span class="error"><?php echo form_error('password'); ?></span>
					</div>
					<div>
					<?php echo form_submit( 'submit', 'Login', "class='beditform'"); ?>
                    </div>
				</div>
				<input type="hidden" value="com_guru" name="option">
				<input type="hidden" value="guruLogin" name="controller">
				<input type="hidden" value="484" name="Itemid">
				<input type="hidden" value="log_in_user" name="task">
				<input type="hidden" value="mycourses" name="returnpage">
				<input type="hidden" value="0" name="cid">
                 <?php echo form_close();?>

</div>
</div>
<!--<table width="100%">
	<tbody><tr>
		<td width="45%" valign="top" style="border-right:1px solid #000000">
			<b>Do you have an account on our site?</b>
			<br>
			<b>Login below</b>
            <?php $attributes = array('class' => 'tform', 'id' => '');
            echo form_open_multipart('users/login_user', $attributes); ?>
				<table width="50%" border="0">
					<tbody><tr>
						<td>Username: <span class="error">*</span></td>
						<td>
                        <input id="username" type="text" size="28" name="username" autocomplete="off" value="<?php echo set_value('username'); ?>"  />
                        <?php echo form_error('username'); ?></td>
					</tr>
					<tr>
						<td>Password: <span class="error">*</span></td>
						<td>
                        <input id="password" type="password" name="password" autocomplete="off" value="<?php echo set_value('password'); ?>"  size="28"/>
                        <?php echo form_error('password'); ?></td>
					</tr>

					<tr>
						<td colspan="2">
							<?php echo form_submit( 'submit', 'Login', "class='beditform'"); ?>

						</td>
					</tr>
				</tbody></table>-->
                <!--<input type="hidden" value="com_guru" name="option">
				<input type="hidden" value="guruLogin" name="controller">
				<input type="hidden" value="484" name="Itemid">
				<input type="hidden" value="log_in_user" name="task">
				<input type="hidden" value="mycourses" name="returnpage">-->
<!--				<input type="hidden" value="0" name="cid">
                 <?php echo form_close();?>
		</td>


	</tr>
</tbody></table>-->