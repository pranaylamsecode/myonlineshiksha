
<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<link rel="stylesheet" type="text/css" href="/public/css/category_css/category.css">
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

<div class="main-container">

<?php



//$category = array();



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'create') ? form_open_multipart(base_url().'admin/mcategories/create', $attributes) : form_open_multipart(base_url().'admin/mcategories/edit/'.$id,$attributes);



?>



<div id="toolbar-box">



	<div class="m top_main_content">



		<div id="toolbar" class="toolbar-list">



			



			<div class="clr"></div>



		</div>



		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2></div>



	</div>



</div>

<div class="field_container">
<div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<!-- <div class="panel-title">
					<?php echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?>
				</div> -->
				
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
						
						<label class='col-sm-12 control-label field-title' for="name"><?php //echo lang('web_name')?>Course Title <span class="required">*</span>
							<p>(e.g. Innovation Management - Please give a short and clear title)</p>
						</label>
						<div class="col-sm-12">
							
                            <input id="name" class="form-control form-height" placeholder="Name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($category->name)) ? $category->name : ''); ?>"  />

    <span class="error"><?php echo form_error('name'); ?></span>

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>

						<span class="name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('media_fld_category-name');?>

						

						</span>

						</span>
 -->
<!-- tooltip area finish -->

						</div>
					</div>
					
					
					<div class="form-group form-border" style="padding-top: 0!important;">
						
						<label class='col-sm-12 control-label field-title' for="description"><?php echo "Description";?>
							<p>(Please give a description of your course)</p>
						</label>
						<div class="col-sm-12">
							
                              <textarea name="description" id="description" placeholder="Description" class="form-control select-box-border" rows="5"><?php echo $this->input->post('description')? $this->input->post('description') :((isset($category->description)) ? $category->description : ''); ?></textarea>

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="description-target" class="tooltipicon" title="Click Here"></span>

						<span class="description-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('media_fld_category-description');?>

						

						</span>

						</span> -->
<!-- tooltip area finish -->
						</div>
					</div>
                       
					
					
					<div class="form-group form-border" style="padding-top: 2%!important;">						
						<label class='col-sm-12 control-label' for='category_id'>Category
							<p>(Please select your Category)</p>
						</label>
						<div class="col-sm-12">							
                            <select name='category_id' id='category_id' class='form-control form-height'>

	<option value=''><?php echo '(0) Top';//echo lang('web_choose_option')?></option>



	<?php



		$combocategories = $this->mcategories_model->get_formatted_combo();



		foreach ($combocategories as $combocat): ?>



       <option value='<?php echo $combocat->id?>' <?php echo ($this->input->post('category_id') == $combocat->id) ? "selected=selected" : (isset($category->id)) && $category->id == $combocat->id  ? "selected=selected" : '' ?>><?php echo $combocat->name?></option>



		<?php endforeach ?>



	</select>

    <span class="error"><?php echo form_error('category_id'); ?></span>

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="category_id-target" class="tooltipicon" title="Click Here"></span>

						<span class="category_id-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('media_fld_category');?>

						

						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
						<!-- <a href="<?php echo base_url(); ?>admin/mcategories/createcategory" id="cropcategory" class="newcat_pop btn btn-success" style="margin-left: 20px;">Create New Category</a>
						<p class="pmcattext">Select this option if you want to create a sub-category</p> -->
					</div>
					
					<div class="form-group form-border" style="padding-top:0!important">
						<div class="col-sm-12">
						  <div class="grey-background">
							<div class="checkbox">
								
                                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') && $this->input->post('published') == 1) ? 'checked == checked' : ((isset($category->published) && $category->published ==1) ? 'checked == checked' : ''); ?> <?php echo $updType == 'create' ? 'checked':''; ?>/><label class='labelforminline' for='active'> <?=lang('web_is_active')?> </label>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('media_fld_category-active');?>

						</span>

						</span>
 -->
<!-- tooltip area finish -->
							</div>
							
						</div>
						</div>
					</div>
                    
					
					
					<div class="form-group form-border" style="padding-top: 2.5%!important;">
						<div class="col-sm-5">					                

			<a>

			<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'") ); ?>

			</a>

			<a href='<?php echo base_url(); ?>admin/media-categories/<?php echo $parent_id?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>


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
		jQuery('#description').redactor();
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
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements

		//$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});	
		$j(".newcat_pop").colorbox({
		iframe:true,
		width:"500px", 
		height:"68%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
	   });
</script>