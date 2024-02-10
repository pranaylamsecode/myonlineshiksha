<section class="container courses">
<div class="row-fluid ">
<style>
label
{
	margin-bottom:0 !important;
}
</style>

<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box;">
<!--<div class="sidebar-menu sb-left">
	<ul id="main-menu" class="">
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myaccount">My account</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycourses">My courses</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myorder">My Orders</a></li> 
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myquizandfexam">My Quizzes/Final Exams</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycertificates">My Certificates</a></li>
	</ul>
</div>-->


<div class="main-content">
	<div class="row">
    <div class="holder" id="mrp-container2">
<div id="system-message-container">
</div>
<?php
$attributes = array('class' => 'tform', 'id' => 'testimonials', 'name' => 'testimonials');
echo form_open_multipart('testimonials/edit/', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/
?>
<div class="content">
	
<!--<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 5px; margin-right:30px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<i class="entypo-menu"></i>
	</a>
</div>-->

<div class="table-scroll-resp">
	<fieldset class="adminform form-horizontal form-groups-bordered">
		<div class="admintable">
            <div width="350"> <h3>Edit Testimonials</h3></div>
            <hr />
			<div>
				<label>Title<span style="color:#FF0000">*</span></label>
					<input type="text" name="name" id="name" size="30" value="<?php echo set_value('name',(isset($testimonials->name)) ? $testimonials->name : ''); ?>">
					
                   <span style ="color:red"><?php echo form_error('name'); ?></span>
                   <input type="hidden" name="sgmid" id="sgmid" size="30" value="<?php echo $this->uri->segment(3); ?>">
			</div>

			<div>
				<label>Description</label>
				<textarea  name="prof_detail" id='prof_detail' rows="6"  ><?php echo set_value('prof_detail', (isset($testimonials->description)) ? $testimonials->description : ''); ?></textarea>
			</div>
			
			<div style="margin-left:20.5%;margin-top: 10px;">
			   <img src="<?php echo base_url();?>public/uploads/testimonials/img/thumb_56_56/<?php echo (isset($testimonials->image)) ? $testimonials->image : 'temp.jpg'; ?>" width="150" id="imgname">
			   <img id="blah" src="#" alt="your image" width='150'/> <!--8/1/15-->
			</div>
			
			<div>
				<label>Upload Image</label>
				<input type="file" name="file_i" id="file_i" class="upload_btn" >
				<input type='button' id='remove' value='remove' class='hide'/> <!--8/1/15-->
				
				<?php  $imagepath = (isset($testimonials->images)) ? $testimonials->images : 'temp.jpg'; ?>

                <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">
			</div>

			<div>
				<label>Active</label>
				<input id="published" type="checkbox" name="published" value="1" <?php echo(isset($testimonials->published) && $testimonials->published == '1') ? "checked" : '' ?> >
				<!--<input type="text" name="company" id="company" size="30" value="" >-->
			</div>
			
        </div>			

			<div style="margin-left:20.5%;">
			<input type="submit" name ="submit" class="btn-primary_rockon" value="Save">
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
</div>
</section>