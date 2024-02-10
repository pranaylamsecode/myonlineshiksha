   
<?php
	//echo '<pre>';
	//print_r($user);
	
	//echo base_url()."public/uploads/users/img/thumbs/et.jpg";
?>
<style>
label
{
	margin-bottom:0 !important;
}
</style>

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
echo form_open_multipart('myinfo/myaccount', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/
?>
<div class="content">
	
<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 5px; margin-right:30px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<div class="table-scroll-resp">
	<fieldset class="adminform form-horizontal form-groups-bordered">
		<div class="admintable">
            <div width="350"> <h3>Profile</h3></div>
            <hr />
			<div>
				<label>First name<span style="color:#FF0000">*</span></label>
					<input type="text" name="firstname" id="firstname" size="30" value="<?php echo set_value('firstname', (isset($user->first_name)) ? $user->first_name : ''); ?>">
                   <span style ="color:red"><?php echo form_error('firstname'); ?></span>
			</div>

			<div>
				<label>Last name<span style="color:#FF0000">*</span></label>
                <input type="text" name="lastname" id="lastname" size="30" value="<?php echo set_value('lastname', (isset($user->last_name)) ? $user->last_name : ''); ?> ">
                   <span style ="color:red"><?php echo form_error('lastname'); ?></span>
			</div>

			<div>
				<label>Company</label>
				<input type="text" name="company" id="company" size="30" value="" >
			</div>
			<?php
				if($user->group_id == '2' || $user->group_id == '5')
				 {
			?>
			<div>
				<label>Designation/Post</label>
				<input type="text" name="designation" id="designation" size="30" value="<?php echo set_value('designation', (isset($user->designation)) ? $user->designation : ''); ?>" >
			</div>
			
			<div>
				<label>Professional Details</label>
				<textarea  name="prof_detail"     id='prof_detail'  ><?php echo set_value('prof_detail', (isset($user->prof_info)) ? $user->prof_info : ''); ?></textarea>
			</div>
			<?php } ?>
			
			<div style="margin-left:20.5%;margin-top: 10px;">
			   <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo (isset($user->images)) ? $user->images : 'temp.jpg'; ?>" width="150" id="imgname">
			   <img id="blah" src="#" alt="your image" width='150'/> <!--8/1/15-->
			</div>
			
			<div>
				<label>Upload Image</label>
				<input type="file" name="file_i" id="file_i" class="upload_btn" >
				<input type='button' id='remove' value='remove' class='hide'/> <!--8/1/15-->
				
				<?php  $imagepath = (isset($user->images)) ? $user->images : 'temp.jpg'; ?>

                <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">
			</div>
			
        </div>
		
		<?php
			if($user->group_id == 5)
			{
		?>
	<hr />
		<div class="admintable">
            <div><h3>Bank Account information</h3></div>
<hr />
			<div>
				<label>Bank Name:<span style="color:#FF0000">*</span></label>
				<input type="text" name="bank_name" id="bank_name" size="30" value="<?php echo set_value('bank_name', (isset($bank_info->bank_name)) ? $bank_info->bank_name : ''); ?>">
                   <span style ="color:red"><?php echo form_error('bank_name'); ?></span>
			</div>

			<div>
				<label>Branch Location:<span style="color:#FF0000">*</span></label>
				<input type="text" name="bank_location" id="bank_location" size="30" value="<?php echo set_value('bank_location', (isset($bank_info->branch_location)) ? $bank_info->branch_location : ''); ?>">
                <span style ="color:red"><?php echo form_error('bank_location'); ?></span>
			</div>
			<div>
				<label>Account Number:<span style="color:#FF0000">*</span></label>
				<input type="text" size="30" id="acc_number" name="acc_number" value="<?php echo set_value('acc_number', (isset($bank_info->acc_number)) ? $bank_info->acc_number : ''); ?>">
                <span style ="color:red"><?php echo form_error('acc_number'); ?></span>
			</div>
			<div>
				<label>Branch Code:<span style="color:#FF0000">*</span></label>
				<input type="text" size="30" id="branch_code" name="branch_code" value="<?php echo set_value('branch_code', (isset($bank_info->branch_code)) ? $bank_info->branch_code : ''); ?>">
                <span style ="color:red"><?php echo form_error('branch_code'); ?></span>
			</div>
			
			<div>
				<label>IFSC Code:<span style="color:#FF0000">*</span></label>
				<input type="text" size="30" id="ifcs_code" name="ifcs_code" value="<?php echo set_value('ifcs_code', (isset($bank_info->ifsc_code)) ? $bank_info->ifsc_code : ''); ?>">
                <span style ="color:red"><?php echo form_error('ifcs_code'); ?></span>
			</div>

			
		</div>
	<?php
			}
	?>
		
<hr />
		<div class="admintable">
            <div><h3>Login information</h3></div>
<hr />
			<div>
				<label>Username<span style="color:#FF0000">*</span></label>
				<input type="text" name="uname" id="uname" size="30" value="<?php echo set_value('uname', (isset($user->username)) ? $user->username : ''); ?>">
                   <span style ="color:red"><?php echo form_error('uname'); ?></span>
			</div>

			<div>
				<label>Email<span style="color:#FF0000">*</span></label>
				<input type="text" name="email_id" id="email_id" size="30" value="<?php echo set_value('email_id', (isset($user->email)) ? $user->email : ''); ?>">
                <span style ="color:red"><?php echo form_error('email_id'); ?></span>
			</div>
			<div>
				<label>Password</label>
				<input type="password" size="30" id="cpassword" name="cpassword" value="<?php echo set_value('cpassword'); ?>">
                <span style ="color:red"><?php echo form_error('cpassword'); ?></span>
			</div>
			<div>
				<label>Verify Password:</label>
				<input type="password" size="30" id="cpassword_confirm" name="cpassword_confirm" value="<?php echo set_value('cpassword_confirm'); ?>">
                <span style ="color:red"><?php echo form_error('cpassword_confirm'); ?></span>
			</div>

			<div style="margin-left:20.5%;">
			<input type="submit" name ="submit" class="btn-primary_rockon" value="Continue">
			</div>
		</div>
	</fieldset>
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
</div>
<div class="clr"></div>

 <hr />
 
 <style>
.hide{
    
    display:none;
}
</style>
<!--<form id="form1" runat="server">
    <input type='button' id='remove' value='remove' class='hide'/>
    <input type='file' id="imgInp" /><br>
    <img id="blah" src="#" alt="your image" width='150'/>
</form>-->

<!--<script type="text/javascript">
jQuery(document).ready(
function()
{
jQuery('#prof_detail').redactor();
//jQuery('#message').redactor();
}
);
</script>-->

<script>
$('#blah').hide();
$('#remove').hide();  
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#file_i").change(function(){
        if( $('#file_i').val()!=""){
            
            $('#remove').show();
            $('#blah').show('slow');
            $('#imgname').hide('slow');
      }
        else{ $('#remove').hide();$('#blah').hide('slow');}
        readURL(this);
    });

  
    $('#remove').click(function(){
          $('#file_i').val('');
          $(this).hide();
          $('#blah').hide('slow');
		  $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
});
</script>

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