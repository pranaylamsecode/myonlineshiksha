<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">

<div class="main-container">

<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/testimonials/create', $attributes) : form_open_multipart(base_url().'admin/testimonials/edit/'.$id, $attributes);
?>

<div id="toolbar-box">

	<div class="m top_main_content">

		<div id="toolbar" class="toolbar-list">
        			
			<div class="clr"></div>

		</div>

		<div class="col-sm-12 pagetitle icon-48-generic"><h2><?php echo (($updType == 'edit')?'Edit Testimonial':'Create Testimonial');?></h2></div>

	</div>

</div>
<div class="field_container">
<div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">	
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php //echo (($updType == 'edit')?'Edit Testimonial':'Create Testimonial');?>
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
						<label for="field-1" class="col-sm-12 control-label field-title">Name<span style="color:#FF0000;">*</span></label>
						
						<div class="col-sm-12">							                  
                            <input id="name" class="form-control form-height" placeholder="Title" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($testimonials->name)) ? $testimonials->name : ''); ?>"  />

<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>
						<span class="name-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('testimonial_fld_title');?>
                         
						</span>
						</span> -->
<!-- tooltip area finish -->
                            <span class="error"> <?php echo form_error('name'); ?></span>

						</div>
					</div>
					
					<div class="form-group form-border top-padding">
						<label for="field-ta" class="col-sm-12 field-title control-label">Testimonial
						</label>
						
						<div class="col-sm-12">							
                            <textarea name="description" id="description" class="form-control" rows="6" placeholder="Description">                            
                            <?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($testimonials->description) && $testimonials->description!='') ? $testimonials->description : ''); ?>
                            </textarea>
                            <input name="image" type="file" id="upload" class="hidden" onchange="">
                            <span class="error"> <?php echo form_error('description'); ?></span>
                            <!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="desc-target" class="tooltipicon" title="Click Here"></span>
						<span class="desc-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('testimonial_fld_description');?> -->
                        
<!--						</span>
						</span>-->
<!-- tooltip area finish -->                         

						</div>
					</div>
                   
					<div class="form-group form-border top-padding">
						<label for="field-1" class="col-sm-12 field-title control-label">Image</label>
						
						<div class="col-sm-12">
							
                            
                            <div id="localimage_i" class="upload_test_image_sec">
                            <div class="col-sm-6 img-grey-border upload_test_image">	
                            <?php if (isset($testimonials->image)){ ?>

                                 <img class="" src="<?php echo base_url();?>public/uploads/testimonials/img/thumb_56_56/<?php echo $testimonials->image?>" id="imgname">

                            <?php }else{    ?>

                                 <img class="" src="<?php echo base_url();?>public/uploads/testimonials/img/thumb_56_56/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_image.jpg'  ?>" id="imgname">

                            <?php } ?>


                            </div>
                            <div class="col-sm-6">
                            	 <input type="file" name="file_i" id="file_i" class="form-control form-height browse_btn" value="">
                            	<?php  $imagepath = (isset($testimonials->image)) ? $testimonials->image : 'no_image.jpg'; ?>

                                <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">
                            </div>
                         </div>
                         

                         

                         <div class="qq-upload-button" style="margin: 10px 0 0 0;">

                                <!--Choose file position: relative; overflow: hidden; direction: ltr;-->

                                                              	


                         </div>

                         
						</div>
					</div>
                    
					
					<div class="form-group form-border chkbox_top_padding">
						<div class="col-sm-12">
							
							<div class="grey-background" style="display: -webkit-box;">
								
								<div class="no-padding">
								 <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($testimonials->published)) && $testimonials->published == '1' ? "checked" : ''; ?> />
								 <label class='no-padding control-label dark_label labelforminline' for='active'> Publish </label>
								 </div>
                         

<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="upload_img-target" class="tooltipicon" title="Click Here"></span>
						<span class="upload_img-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php // echo lang('testimonial_fld_active');?>
                         
						</span>
						</span> -->
<!-- tooltip area finish -->
						
							
							
						</div>
					</div>
					</div>

					<div class="form-group form-border" style="padding-top:2%!important;">
						<div class="col-sm-5">						
                        <a>
        			<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Update' : 'Update', (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>
        			</a>
                    <a href='<?php echo base_url('admin/templates/editoptions/45'); ?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
					</div>
					</div>
				</form>				
			</div>		
		</div>
	</div>
	</div>	
	</div>
	</div>
<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$testimonials->id); ?>
<?php endif ?>
<?php echo form_close(); ?>
<!-- tool tip script -->

<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>


<script type="text/javascript">

$(function() {		

	$('#file_i').live('change',function(e) {

	var ftpfilearray;

	e.preventDefault();

	$.ajaxFileUpload({

  		url :'<?php echo base_url(); ?>admin/testimonials/upload_image/',

  		secureuri :false,

  		fileElementId :'file_i',

  		dataType : 'json',

      		data : {

      		    'type' : $('select#type').val()

      		},

      		success : function (data, status)

      		{

      			if(data.status != 'error')

      			{

          			$('#msgstatus_i').html('<p>Reloading files...</p>');

          			$('#file_i').val('');

          			$('#msgstatus_i').html('');

          			ftpfileoptions = '<img src="<?php echo base_url(); ?>public/uploads/testimonials/img/thumb_56_56/'+data.ftpfilearray+'">';

          			$('#localimage_i').html(ftpfileoptions);

          			ftpfilearray = data.ftpfilearray;

          			document.getElementById("imagename").value = ftpfilearray;

      			}

      		}

        });

	 return false;

  });

});



</script>   

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
