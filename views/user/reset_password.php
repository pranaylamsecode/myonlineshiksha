<style>
.btn-primary_red {
/* float: left; */
color: #fff;
padding: 5px 10px 5px 10px;
font-size: 14px;
font-family: 'Open Sans', sans-serif;
font-weight: 600;
line-height: 31px;
margin: 10px auto;
display: block;
height: 40px;
border: 0;
border-radius: 4px;
text-align: center;
text-transform: uppercase;
text-shadow: none;
}
</style>

<section class="container courses">
           <div class="row-fluid ">

<?php

if(!isset($prstatus) || $prstatus=='')

{

?>

<div class="fullcontent">

            <?php $attributes = array('class' => 'rpform', 'id' => 'rpform');

            echo form_open_multipart(base_url().'users/mlmsreset_password', $attributes); ?>

            

			<div class="title">Reset Password</div>

				<div>

					<div>

						<label>Password: <span class="error">*</span></label>

						<input id="pass" type="password" size="15" name="pass" autocomplete="off" value="<?php echo set_value('pass'); ?>"  />

                        <span class="error"><?php echo form_error('pass'); ?></span>

					</div>	

					<div>

						<label>Confirm Password: <span class="error">*</span></label>

						<input id="cfpass" type="password" size="15" name="cfpass" autocomplete="off" value="<?php echo set_value('cfpass'); ?>"  />

                        <span class="error"><?php echo form_error('cfpass'); ?></span>

					</div>					

					<div>						

					<label>

					<input type='hidden' name='uid' value='<?php echo $userid; ?>' />

					</label>												

					<?php echo form_submit( 'submit', 'Reset Password', "class='btn-primary_red'"); ?>                        					

					</div>

					

				</div>

				

                 <?php echo form_close();?>

</div>

<?php

}else

{

?>

<div class="fullcontent

	<div class="title"><?php echo $prstatus;?></div>

	<div><a href='<?php echo base_url()?>users/login/'>Login</a></div>

</div>

<?php

}

?>

</div>
</section>