<!--<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />
<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>-->
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style type="text/css">
.col-sm-9 {
  width: 63%;
}</style>
<script type="text/javascript">
	// jQuery(document).ready(
	// 	function()
	// 	{
	// 		jQuery('#description').redactor({
	// 		        focus: true,
	// 		        imageUpload: window.location.origin+'/admin/blogs/getImage',
	                
	// 		});
	// 	}
	// );
</script>
<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => '');
if($blogtype=='createblog')
{
echo form_open(base_url().'admin/blogs/create_process', $attributes);
?>

<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2><?php echo 'New Blog Post';?></h2></div>
	</div>
</div>


<div class="field_container">
 <div class="row">

				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 control-label field-title">Blog Title<span class='required'>*</span></label>
						
						<div class="col-sm-12">
                        <input id="title" type="text" name="title" maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title'): '' ;?>" class="form-control form-height"  />
						<span class='error'><?php  echo form_error('title'); ?></span>

						<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="title-target" class="tooltipicon"></span>
						<span class="title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('blog_fld_title');?>
                         
						</span>
						</span> -->
						<!-- tooltip area finish -->
						</div>
					</div>
					
					<div class="form-group form-border" style="padding-top:0!important;">
						<label for="field-ta" class="col-sm-12 field-title control-label">Description<span class='required'>*</span></label>
						
						<div class="col-sm-12">
	                        <textarea name="description" id="description" placeholder="Description" class="form-control select-box-border" rows="6">
	                        <?php echo ($this->input->post('description')) ? $this->input->post('description'): '' ;?>
	                        </textarea>
						 	<input name="image" type="file" id="upload" class="hidden" onchange="">
	                        <span class='error'><?php  echo form_error('description'); ?></span>
						 	<!-- tooltip area -->
							<!-- <span class="tooltipcontainer">
							<span type="text" id="desc-target" class="tooltipicon"></span>
							<span class="desc-target  tooltargetdiv" style="display: none;" >
							<span class="closetooltip"></span>
							
							<?php echo lang('blog_fld_desc');?>
	                        
							</span>
							</span> -->
							<!-- tooltip area finish -->						  	
						</div>
					</div>
					<div style="" class="form-group form-border" >

								<label for="field-1" class="col-sm-12 control-label field-title">SEO title
				              	<p>Enter the course title as it will be shown in internet browsers.
				              		</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo isset($blogdata->meta_title) ? $blogdata->meta_title : $blogdata->title ?>"  name="meta_title" class="form-control form-height" id="m_title"  placeholder="Maximum 60 characters.">											
							</div>
							</div>

							<div style="" class="form-group form-border" >
								<label for="field-1" class="col-sm-12 control-label field-title">SEO description
				              <p>Enter the course description that will appear underneath the SEO title.</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo isset($blogdata->meta_desc) ? $blogdata->meta_desc : $blogdata->title ?>"  name="meta_desc" class="form-control form-height" id="m_desc" placeholder="Maximum 320 characters.">											
							</div>
							</div>

							<div style="" class="form-group form-border" >
								<label for="field-1" class="col-sm-12 control-label field-title">Course keywords (optional)
				              <p>To improve your site’s visibility in searches, enter keywords separated by commas.</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo isset($blogdata->meta_keyword) ? $blogdata->meta_keyword : '' ?>" name="meta_keyword" class="form-control form-height" id="m_kwd">											
							</div>
							</div>
							  <div style="clear:both;"></div>
					<div class="form-group form-border">
						<div class="col-sm-5">
                        	<a>
							<?php echo form_submit( 'submit', 'Update', "id='submit' class='btn btn-default btn-green'"); ?>
							</a>
            				<a href='<?php echo base_url(); ?>admin/blogs/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</form>
				
			
		</div>	
	</div>
<?php echo form_close(); ?>

<?php

} // end of blog type create blog

?>

<?php
if($blogtype=='editblog')
{
echo form_open(base_url().'admin/blogs/edit_process', $attributes);

$blogpost=json_decode($blogdata->post);

?>


<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Edit post';?></h2>
			<h6>Blog Post</h6>
		</div>
	</div>
</div>

<div class="field_container">
				<div class="row">
				<form role="form" class="form-horizontal form-groups-bordered">		  
                    <input id="id" type="hidden" name="id" maxlength="256" class="form-control" value="<?php echo (set_value('id')) ? (set_value('id')) : $blogdata->id; ?>"  />
	
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Blog Title<font color="#FF0000">*</font></label>
						<div class="col-sm-12">
		                    <input id="title" type="text" name="title" maxlength="256" class="form-control form-height" value="<?php echo (set_value('title')) ? (set_value('title')) : $blogdata->title; ?>" />
							<span class='error'><?php echo form_error('title'); ?></span>
						</div>
					</div>
					
					<div class="form-group form-border" style="padding:0!important;">
						<label for="field-ta" class="col-sm-12 field-title control-label">Description<font color="#FF0000">*</font></label>
						
						<div class="col-sm-12">               
                            <textarea name="description" id="description" class="form-control select-box-border" rows="6" placeholder="Description">
							<?php echo (set_value('description')) ? (set_value('description')) : $blogpost->description; ?>
							</textarea>
							<input name="image" type="file" id="upload" class="hidden" onchange="">
							<?php  echo form_error('description'); ?><b>&nbsp;</b>
						</div>
					</div>
<!-- 						<legend style="padding-top: 10px">SEO settings</legend>
 -->
						<div style="" class="form-group form-border" >

								<label for="field-1" class="col-sm-12 control-label field-title">SEO title
				              	<p>Enter the course title as it will be shown in internet browsers.
				              		</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo isset($blogdata->meta_title) ? $blogdata->meta_title : $blogdata->title ?>"  name="meta_title" class="form-control form-height" id="m_title"  placeholder="Maximum 60 characters.">											
							</div>
							</div>

							<div style="" class="form-group form-border" >
								<label for="field-1" class="col-sm-12 control-label field-title">SEO description
				              <p>Enter the course description that will appear underneath the SEO title.</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo isset($blogdata->meta_desc) ? $blogdata->meta_desc : $blogdata->title ?>"  name="meta_desc" class="form-control form-height" id="m_desc" placeholder="Maximum 320 characters.">											
							</div>
							</div>

							<div style="" class="form-group form-border" >
								<label for="field-1" class="col-sm-12 control-label field-title">Course keywords (optional)
				              <p>To improve your site’s visibility in searches, enter keywords separated by commas.</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo isset($blogdata->meta_keyword) ? $blogdata->meta_keyword : '' ?>" name="meta_keyword" class="form-control form-height" id="m_kwd">											
							</div>
							</div>
							  <div style="clear:both;"></div>
					<div class="form-group form-border" >
						<div class="col-sm-5">             
							   
						<a>
						<?php echo form_submit( 'submit', 'Update', "id='submit' class='btn btn-default btn-green'"); ?>
						</a>

						<a href='<?php echo base_url(); ?>admin/blogs/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</form>				
			</div>	
		
	</div>
</div>
<?php 
echo form_hidden('bid',$blogdata->id);
echo form_close(); ?>
<?php
}
?>


 <!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){

//	jQuery('.tooltipicon').click(function(){

//	var dispdiv = jQuery(this).attr('id');

//	jQuery('.'+dispdiv).css('display','inline-block');

//	});

//	jQuery('.closetooltip').click(function(){

//	jQuery(this).parent().css('display','none');

//	});

//	});

jQuery(document).ready(function(){
	jQuery('.tooltipicon').mouseenter(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.tooltipicon').mouseleave(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','none');
	});
	});

	</script>

<!-- tool tip script finish -->
<script src='<?php echo base_url(); ?>public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#description',
  height: 180,
 // min_width: 400,
  plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
    image_title: true,
    automatic_uploads: true,
    images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
    file_picker_types: 'image',
     image_advtab: true, 
    file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('#upload').trigger('click');
            $('#upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },
 	});
   });
  </script>