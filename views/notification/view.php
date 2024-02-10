<?php
	/*echo '<pre>';
		print_r($message);
	echo '</pre>';*/
?>
<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box;">
<div class="sidebar-menu sb-left">
<!-- Your left Slidebar content. -->
<!-- Classes Examples -->
	<ul id="main-menu" class="">
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myaccount">My account</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycourses">My courses</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myorder">My Orders</a></li> 
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myquizandfexam">My Quizzes/Final Exams</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycertificates">My Certificates</a></li>
	</ul>
</div>


<div class="main-content">
	<div class="row">
    <div class="holder" id="mrp-container2">
<div id="system-message-container">
</div>
<?php
$attributes = array('class' => 'tform', 'id' => 'user_profile', 'name' => 'user_profile','onclick' => 'return validateForm()');
echo form_open_multipart(base_url().'notification/send_mail', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/
?>
<div class="content">
	
<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 5px; margin-right:10px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>
<div class="table-scroll-resp">
<div class="span12"> 
<div class="panel panel-primary" data-collapsed="0" style="border: 1px solid #ebebeb;"> 
<div class="panel-heading" >
<div class="panel-title" style="border-bottom: 1px solid #ebebeb; float:none;">
Message Details
</div>

<?php 
	foreach($message as $msg)
	{
		$name = $this->settings_model->getName($msg->sender_id);
		$stud_Detail = $this->settings_model->getAllUsersDetail($msg->sender_id);
		
		
		
?>	
<div class="panel-body"> 
	<fieldset class="adminform">
		<div class="admintable form-horizontal form-groups-bordered">
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Sender :</label>
				<label><?php echo $name; ?></label>
                  
			</div>

			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Subject :</label>
				<label><?php echo $msg->subject; ?></label>
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Message :</label>
				<label><?php echo $msg->message; ?></label>
            </div>
			
			<div >
				<label>Reply here:</label>
				<textarea name="reply_msg" id="reply_msg" required ></textarea>
            </div>
			
			
			<input type="hidden" name="sender_id" value="<?php echo $msg->sender_id; ?>" />
			<input type="hidden" name="sender_email" value="<?php echo $stud_Detail[0]['email']; ?>" />	
			<input type="hidden" name="program_id" value='<?php echo $msg->program_id; ?>' />
			
            <div >
				<label></label>
				<input class="btn btn-success" type="submit" name="rplButton" id="rplButton" value="Send" />
            </div>

			
		</div>
	</fieldset>
	
</div>
<?php
	}
?>	
</div>
</div>
</div>
</div>	  
	
</div>
</div>
<?php echo form_close(); ?>
    </div>
</div>

</div>



<div id="main" role="main">

	<div id="rich-text1">
		<div class="weblet-inner">
			<div class="steps-holder">

			</div>
		</div>
	</div>
    
	<div id="rich-text2">
		<div class="weblet-inner">
		<!--<div class="tabs-area">  --><!--</div>   -->
		</div>
	</div>

	<div id="rich-text3">
		<div class="weblet-inner">
			<!--<div class="search-block"></div> -->
		</div>
	</div>

	<div id="rich-text4">
		<div class="weblet-inner">

		</div>
	</div>

<div class="holder2">
	<div class="bottom-boxes">
		<div class="frame"></div>
	</div>
</div>
</div>

</div>
<div class="clr"></div>

	<script>
			(function($) {
				$(document).ready(function() {
					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			}) (jQuery);
	</script>