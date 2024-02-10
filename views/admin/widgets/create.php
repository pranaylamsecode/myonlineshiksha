<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
  //$this->session->flashdata('message');
?>
<style>
	.img-wrap {
    position: relative;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: red; 
}
.remove_img {
    position: absolute;
    top: -10px;
    right: -25px;
    margin-left: 5px;
    font-size: 20px;
    color: #333;
    cursor: pointer;
}
.img-wrap {
    padding-top: 10px;
    padding-bottom: 5px;
}
.recommend {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
}
.wed_image{
margin-bottom:10px }
.img-wrap {
    width: 400px;
    height: 250px;
}
.img-wrap img, video {
    width: 100%;
    height: 100%;
}
.panel{
		background-color: transparent!important;
}
.panel-body{
	padding: 0;
}
.main-content .form-control {
     margin-bottom: 10px; 
}
</style>
<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/widgets/createPage', $attributes) : form_open_multipart(base_url().'admin/widgets/editPage/'.$id, $attributes);
?>


<div id="toolbar-box">
	<div class="m top_main_content">
		<!-- <div id="toolbar" class="toolbar-list">	
			<div class="clr"></div>
		</div> -->

		<div class="col-sm-12 pagetitle icon-48-generic"><h2 class="text-left"><?php echo ($updType == 'create') ? 'Create Block' : 'Edit Block'?></h2></div>
	</div>
</div>

<div>
    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>
</div>

<div class="field_container">
 
<div class="row tab-content">
	<!--Main fieldset-->
	<fieldset class="adminform">
   
     
     
     <div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">	

		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					 <?php 
					 	/*
					 	if($updType != 'edit'){ ?>
      					Create Widget
					     <?php }else{ ?>
					        Edit Widget
					     <?php }
					     */
					     ?>
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body form-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						
						<label class='col-sm-12 control-label field-title' for="name"><?php echo "Title"; ?><span class="required">*</span></label>
						<div class="col-sm-12">
							
                            <div>
                            <?php echo form_input('title',($this->input->post('title')) ? $this->input->post('title'):(isset($page[0]['title']) ? $page[0]['title']:''),'class="form-control form-height"'); ?>
					</div>
                     <span class="error"><?php echo form_error('title'); ?></span>
						</div>
					</div>
                   
					<div class="form-group form-border top-padding">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "Image/video"; ?></label>
							
						<div class='col-sm-12' >
							<?php
							if(isset($page[0]['image']) && $page[0]['image'] !='')
								{ ?>
									<div class="img-wrap">
									<?php

								 $exploded = explode('.', $page[0]['image']);
							          $img = array('jpg','jpeg','gif','png');
							          $video = array('mp4','mov','ogg','avi','flv','wmv','mpeg');
							          if(in_array(end($exploded), $img))
							          {
							         ?>
							          <img width='341' height='auto' src="<?php echo base_url() ?>public/uploads/widgets/<?php echo $page[0]['image'] ?>">
							      <?php  }
							        else if(in_array(end($exploded), $video)){ ?>
							          <video width='341' height='auto' controlslist="nodownload" controls ><source src="<?php echo base_url() ?>public/uploads/widgets/<?php echo $page[0]['image'] ?>" type="video/mp4"></video>
							    <?php    } ?>
							   		<span class="lnr lnr-cross remove_img" title="Remove"></span> </div><?php
								 } ?>
							<input type="hidden"  id="widgets_img" name="widgets_img" value="<?php echo ($this->input->post('title')) ? $this->input->post('image'):(isset($page[0]['image']) ? $page[0]['image']:'') ?>">
							<div class="recommend">Recommended: The size should be 400 x 250</div>
						</div>
						<div  class='col-sm-12'>
								
							

							<input type="file" class="wed_image" name="wed_image" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/*,video/mp4,video/x-m4v,video/*" />
						</div>
					<div class="form-group form-border top-padding">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "Description"; ?><span class="required">*</span></label>

						<div class="col-sm-12">
							
                            <div>
                    <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''));?>
                    <textarea name="description" class="form-control" id="description" rows="6"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['description'])) ? $page[0]['description'] : ''); ?></textarea>
                    <input name="image" type="file" id="upload" class="hidden" onchange="">
					</div>
                     <span class="error"><?php echo form_error('description'); ?></span>
						</div>
					</div>
                   
					<div class="form-group form-border top-padding">
						<label class='col-sm-12 control-label field-title' for="name"><?php echo "Position"; ?><span class="required">*</span> 
						<!-- <p>(Middle will place the widgets under the top banner and bottom will place it below the courses list.)</p> -->
						</label>
						<div class="col-sm-12">
							
					<select name="area" id="area" class="form-control form-height">
						<option value="middle" <?php echo ($this->input->post('area') == 'middle' ?  'selected="selected"' :( @$page[0]['area'] == 'middle' )? 'selected="selected"' : '');?> >Middle</option>
						<option value="footer" <?php echo ($this->input->post('area') == 'footer' ?  'selected="selected"' :( @$page[0]['area'] == 'footer' )? 'selected="selected"' : '');?> >Bottom</option>
					</select>
					<!-- tooltip area -->
									<!-- <span class="tooltipcontainer">
									<span type="text" id="area-target" class="tooltipicon"></span>
									<span class="area-target  tooltargetdiv" style="display: none;" >
									<span class="closetooltip"></span>
									
									<?php echo lang('widget_fld_area');?>
									
									</span>
									</span> -->
									<!-- tooltip area finish -->
						</div>
					</div>
                  
					<div class="form-group form-border chkbox_top_padding">
					<div class="col-sm-12">
			    		<div class="grey-background" style="display: -webkit-box;">
						
						
						<div class="col-sm-12 no-padding">							
								<input id="status" type="checkbox" name="status" value='1' <?php echo ($this->input->post('status') == '1') ? "checked" : (isset($page[0]['status']) && $page[0]['status'] == '1') ? "checked" : ''?> />
								<label class="no-padding control-label dark_label">Publish</label>									<!-- tooltip area -->
									<!-- <span class="tooltipcontainer">
									<span type="text" id="active-target" class="tooltipicon"></span>
									<span class="active-target  tooltargetdiv" style="display: none;" >
									<span class="closetooltip"></span>
									
									<?php //echo lang('widget_fld_active');?>
									 
									</span>
									</span> -->
									<!-- tooltip area finish -->
						</div>
					</div>
					</div>
					</div>
                    
					<div class="form-group form-border" style="padding-top:2%!important;">
						<div class="col-sm-5">
							
                            
                            <a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?></a>
				
				<a href='<?php echo base_url('admin/templates/editoptions/45'); ?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
     
     
	
	
	</div>	
	</fieldset>
</div>
</div>

<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$id) ?>
<?php endif ?>

<?php echo form_close(); ?>
<!-- tool tip script -->
<script type="text/javascript" src="<?php echo base_url();?>public/default/js/jquery-1.7.1.min.js"></script>

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



 <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 

<script type="text/javascript">
	$(document).on('click', '.remove_img', function(){
    $('.img-wrap').html('');
    $('.img-wrap').hide();
    $('#widgets_img').val('');
});
</script>

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