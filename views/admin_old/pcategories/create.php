<?php
 /*echo '<pre>';
	print_r($category);
 echo '</pre>';*/
?>

<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script type="text/javascript">

		jQuery(document).ready(function() {

			/*

			 *  Simple image gallery. Uses default settings

			 */



			jQuery('.fancybox').fancybox();



			/*

			 *  Different effects

			 */



			// Change title type, overlay closing speed

			jQuery(".fancybox-effects-a").fancybox({

				helpers: {

					title : {

						type : 'outside'

					},

					overlay : {

						speedOut : 0

					}

				}

			});



			// Disable opening and closing animations, change title type

			jQuery(".fancybox-effects-b").fancybox({

				openEffect  : 'none',

				closeEffect	: 'none',



				helpers : {

					title : {

						type : 'over'

					}

				}

			});



			// Set custom style, close if clicked, change title type and overlay color

			jQuery(".fancybox-effects-c").fancybox({

				wrapCSS    : 'fancybox-custom',

				closeClick : true,



				openEffect : 'none',



				helpers : {

					title : {

						type : 'inside'

					},

					overlay : {

						css : {

							'background' : 'rgba(238,238,238,0.85)'

						}

					}

				}

			});



			// Remove padding, set opening and closing animations, close if clicked and disable overlay

			jQuery(".fancybox-effects-d").fancybox({

				padding: 0,



				openEffect : 'elastic',

				openSpeed  : 150,



				closeEffect : 'elastic',

				closeSpeed  : 150,



				closeClick : true,



				helpers : {

					overlay : null

				}

			});



			/*

			 *  Button helper. Disable animations, hide close button, change title type and content

			 */



			jQuery('.fancybox-buttons').fancybox({

				openEffect  : 'none',

				closeEffect : 'none',



				prevEffect : 'none',

				nextEffect : 'none',



				closeBtn  : false,



				helpers : {

					title : {

						type : 'inside'

					},

					buttons	: {}

				},



				afterLoad : function() {

					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');

				}

			});

			/*

			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked

			*/

			jQuery('.fancybox-thumbs').fancybox({

				prevEffect : 'none',

				nextEffect : 'none',



				closeBtn  : false,

				arrows    : false,

				nextClick : true,



				helpers : {

					thumbs : {

						width  : 50,

						height : 50

					}

				}

			});



			/*

			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.

			*/

			jQuery('.fancybox-media')

				.attr('rel', 'media-gallery')

				.fancybox({

					openEffect : 'none',

					closeEffect : 'none',

					prevEffect : 'none',

					nextEffect : 'none',



					arrows : false,

					helpers : {

						media : {},

						buttons : {}

					}

				});



			/*

			 *  Open manually

			 */



			jQuery("#fancybox-manual-a").click(function() {

				jQuery.fancybox.open('1_b.jpg');

			});



			jQuery("#fancybox-manual-b").click(function() {

				jQuery.fancybox.open({

					href : 'iframe.html',

					type : 'iframe',

					padding : 5

				});

			});



			jQuery("#fancybox-manual-c").click(function() {

				jQuery.fancybox.open([

					{

						href : '1_b.jpg',

						title : 'My title'

					}, {

						href : '2_b.jpg',

						title : '2nd title'

					}, {

						href : '3_b.jpg'

					}

				], {

					helpers : {

						thumbs : {

							width: 75,

							height: 50

						}

					}

				});

			});

});

</script>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<script type="text/javascript">

$(function() {

	$('#file_i').live('change',function(e) {

	 var ftpfilearray;

	 e.preventDefault();

		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>admin/pcategories/upload_image/',

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

			ftpfileoptions = '<img src="<?php echo base_url(); ?>/public/uploads/pcategories/img/'+data.ftpfilearray+'" width="150">';

		   //	alert(ftpfileoptions);

			$('#localimage_i').html(ftpfileoptions);

			ftpfilearray = data.ftpfilearray;

           // alert(ftpfilearray);

			document.getElementById("imagename").value = ftpfilearray;

			}

		}

		});

	 return false;

	});

});



</script>
<style>
.img-grey-border img {
  max-width: 100%!important;
  width: 100%!important;
}
</style>
<div class="main-container">
<?php

//print_r($category);

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/pcategories/create', $attributes) : form_open_multipart(base_url().'admin/pcategories/edit/'.$id, $attributes);

?>

<div id="toolbar-box">

	<div class="m top_main_content">

		<div id="toolbar" class="toolbar-list">

		</div>

		<div class="col-sm-12 pagetitle icon-48-generic no-padding"><h2><?php echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2></div>

	</div>

</div>



<div class="field_container">
<div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="main_subtitle">
					<p class="pmcat">Here you can create the categories for course of your online acedemy. If you want to create new categories then don't select any parent category. If you want to create sub-category then select any of the existing category as a parent category.</p>
					<?php //echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?>
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
						
						<label class="col-sm-12 control-label field-title" for="name"><?php //echo lang('web_name')?>Course Title  <span class="required">*</span>
							<p>(e.g. Innovation Management - Please give a short and clear title)</p>
						</label>
						<div class="col-sm-12">
							
                            <input id="name" class="form-control form-height" placeholder="Name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($category->name)) ? $category->name : ''); ?>"  />

						<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>
						<span class="name-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('course_fld_category-name');?> -->
						<!--/tip containt-->
						<!-- </span>
						</span> -->
<!-- tooltip area finish -->
<span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>
					
					
					<div class="form-group form-border top-padding">
						
						<label class='col-sm-12 control-label field-title' for="description"><?php echo "Description";?>
							<p>(Please give a description of your course)</p>
						</label>
						<div class="col-sm-12">							
                            <textarea name="description" id="description" class="form-control select-box-border" rows="6" placeholder="Description"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($category->description) && $category->description!='') ? $category->description : ''); ?></textarea>

      <?php //$this->ckeditor->editor("description",(isset($category->description)) ? $category->description : '');?>

	<?php //echo form_error('description'); ?>
<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="description-target" class="tooltipicon" title="Click Here"></span>
						<span class="description-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('course_fld_category-description');?>
						
						</span>
						</span> -->
<!-- tooltip area finish -->
						</div>
					</div>
                    
                                
                    <div class="form-group form-border">
						
						<label class='col-sm-12 control-label field-title pcat_top_padding' for='category_id'>Parent Category
							<p>(Please select your Parent Category)</p>
						</label>
						<div class="col-sm-12">
							
                            <select name='category_id' id='category_id' class="form-control form-height">

		<option value=''>- select</option>
		<?php
		$combocategories = $this->pcategories_model->get_formatted_combo();

		foreach ($combocategories as $combocat): ?>
			<!--<option value='<?php //echo $combocat->id?>' <?php //echo preset_select('category_id', $combocat->id, (isset($category->pid)) ? $category->pid : $parent_id  ) ?>>

<?php //echo $combocat->name?>     -->

<!--</option>   -->
            <option value="<?php echo $combocat->id;?>" <?php echo ($this->input->post('category_id') == $combocat->id) ? "selected=selected" : (isset($category->pid)) && $category->pid == $combocat->id  ? "selected=selected" : $parent_id ?>><?php echo $combocat->name;?></option>
		<?php endforeach ?>

	</select>
<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="category_id-target" class="tooltipicon" title="Click Here"></span>
						<span class="category_id-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('course_fld_parent_category');?>
						
						</span>
						</span> -->
<!-- tooltip area finish -->
    <span class="error"><?php echo form_error('category_id'); ?></span>
						</div>
					</div>
					
                    <div class="form-group form-border top-padding">
						
						<label class='col-sm-12 control-label field-title' for="image"><?=lang( ($updType == 'edit')  ? "web_image_edit" : "web_image_create" )?>
							<p style="margin-bottom:0;">(Please upload Course Image)</p>
						</label>

						<div class="col-sm-12">
							
							 <?php //echo ($this->post->input('imagename')) ? $this->post->input('imagename') : ((isset($category->image)) ? $category->image : '')

              $image_name = (isset($category->image)) ? $category->image : '';
?>
                      <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $image_name ?>" name="imagename" id="imagename">

                    <!--<input type="hidden" value="<?php //echo set_value('imagename', (isset($category->image)) ? $category->image : ''); ?>"     -->

<!--name="imagename" id="imagename">   -->

                   <div id="localimage_i">
                   	 <div class="col-sm-8 no-padding">
                      <?php if ($updType == 'edit'){ ?>
                      <div class="col-sm-6 img-grey-border">
                      <a href="<?php echo base_url(); ?>admin/pcategories/cropcategoryimg/<?php echo $this->uri->segment(4);?>/categoryedit" class="upimg_pop"><img src="<?php echo base_url();?>public/uploads/pcategories/img/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $category->image ?>" width="150" id="imgname"></a>
                      </div>
                      <div class="col-sm-6">
                      <a href="<?php echo base_url(); ?>admin/pcategories/cropcategoryimg/<?php echo $this->uri->segment(4);?>/categoryedit" class="upimg_pop btn btn-success btn-border-blue img-align">Upload Image</a>
                      </div>
                      <?php }else{ ?>
                      <div class="col-sm-6 img-grey-border">
                      <a href="<?php echo base_url(); ?>admin/pcategories/cropcategoryimg/categorycreate" class="upimg_pop"><img src="<?php echo base_url();?>public/uploads/pcategories/img/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg'?>" width="150" id="imgname"></a>
                      </div>
                      <input type="hidden" id="cropimage" name="cropimage" value="" >
                      <div class="col-sm-6">
                      <a href="<?php echo base_url(); ?>admin/pcategories/cropcategoryimg/categorycreate" class="upimg_pop btn btn-success btn-border-blue img-align">Upload Image</a>
                      </div>
                      <?php } ?>
                      </div>
                   </div>

	<?php //echo form_error('image'); ?>

	<?php  echo ( isset($upload_error)) ?  $upload_error  : ""; ?>
 <div class="qq-upload-button" style=" margin: 20px 0 0 0px;">
                <!--Choose file position: relative; overflow: hidden; direction: ltr; -->

                <input type="file" name="file_i" id="file_i" style="display: none;">
<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="image-target" class="tooltipicon" title="Click Here"></span>
						<span class="image-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('course_fld_category_image');?>
						
						</span>
						</span> -->
<!-- tooltip area finish -->
  </div>
					</div>
                    </div>
					
					<div class="form-group form-border chkbox_top_padding">
                    
						<div class="col-sm-12">
                        	<div class="grey-background">
							<div class="checkbox">
                           
								
                                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($category->published)) && $category->published == '1' ? "checked" : ''; ?> <?php echo $updType == 'create' ? 'checked':''; ?> />

<label class='labelforminline dark_label' for='active'> <?=lang('web_is_active')?> </label>

<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>
						<span class="published-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('course_fld_category-active');?>
						
						</span>
						</span> -->
<!-- tooltip area finish -->
	<?php //echo form_error('published'); ?>
							</div>
							</div>
						</div>
					</div>
					
                    
					
					
					<div class="form-group form-border chkbox_top_padding">
						<div class="col-sm-5">
							
                            <a>
			<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'") ); ?>
         					</a>
                            
                            <!-- <a href='<?php echo base_url(); ?>admin/course-categories/<?php echo $parent_id?>' class='btn btn-red btn-dark-grey'> -->
                            <a href='<?php echo base_url(); ?>admin/course-categories/' class='btn btn-red btn-dark-grey'>
                            <span class="icon-32-cancel"> </span>Cancel </a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
	</div>
	</div>
</div>



	<?php echo form_hidden('parent_id',$parent_id) ?>



<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$category->id) ?>

<?php endif ?>



<?php echo form_close(); ?>
<!--<script>
jQuery(document).ready(
	 function()
	 {
		jQuery('#description').redactor({
			        focus: true,
			        imageUpload: window.location.origin+'/admin/pcategories/getImage',
	                
			});
	 }
);
</script>-->


 <!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){
//
//	jQuery('.tooltipicon').click(function(){
//
//	var dispdiv = jQuery(this).attr('id');
//
//	jQuery('.'+dispdiv).css('display','inline-block');
//
//	});
//
//	jQuery('.closetooltip').click(function(){
//
//	jQuery(this).parent().css('display','none');
//
//	});
//
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

<!-- tool tip script finish -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements

		//$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});	
		$j(".upimg_pop").colorbox({
		iframe:true,
		width:"500px", 
		height:"55%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
	   });
</script>