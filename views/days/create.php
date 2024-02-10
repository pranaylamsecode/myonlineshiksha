
<!-- <base href="<?php echo $this->config->item('base_url') ?>/public/" /> -->

<script type="text/javascript">
	// $(document).ready(function() {
	// 	$('#description').redactor();
	// });
</script>

<style>
.seperator {
    border-bottom: 1px dotted #686c70;
    padding: 21px 0 0 0;
}
.error{
	color: red;
	font-size:13px;
}


label {
display: inline-block !important;
margin-bottom:0 !important;
}

</style>

<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
 $(function(){
  $("#forward").click(function() {
   window.parent.location.href = "<?php echo base_url(); ?>days/index/<?php echo $parent_id?>";
   });
});
</script>

<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open(base_url().'days/create', $attributes) : form_open(base_url().'/days/edit', $attributes);

?>

<header>
<section class="breadcrumb">

<div class="container">
  <div class="row">
    <div> 
      <span style="float:left;">
      	<h2><?php echo 'New Section';?></h2>
      </span> 
      <span style="float:right; margin-top: 10px;">
      <a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'") ); ?></a> 
      <a href='<?php echo base_url(); ?>sections-manage/<?php echo $parent_id?>/index' class='btn btn-danger' id="forward">Cancel</a>
      </span> 
    </div>
  </div>
</div>
</section>
</header>
<div class="clr"></div>


<div class="page-container">


<div class="main-content" style="min-height: 820px;">
	<div class="row">

			<div class="col-sm-12" style="width:100%;">

				<div class="panel panel-primary" data-collapsed="0">

					<div class="panel-body form-horizontal form-groups-bordered"> 

						<div class="form-group"> 
							<label for="field-1" class="col-sm-3 control-label"><?php echo 'Section Name'//echo lang('web_name')?> <span class="required">*</span></label> 
							
							<div class="col-sm-5"> 

								<input id="title" class="form-control" type="text" name="title" maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : ((isset($day->title)) ? $day->title : ''); ?>"  />
								<!-- tooltip area -->
									<span class="tooltipcontainer">
									<span type="text" id="title-target" class="tooltipicon"></span>
									<span class="title-target  tooltargetdiv" style="display: none;" >
									<span class="closetooltip"></span>
									<!--tip containt-->
									<?php echo lang('section_fld_title');?>
			                         <!--/tip containt-->
									</span>
									</span>
								<!-- tooltip area finish -->
								<span class="error"><?php echo form_error('title'); ?> </span>
							</div> 

						</div> 

						<div class="form-group"> 
						<!-- <label class="col-sm-3 control-label"><?=lang('web_active')?></label> -->
						<label class="col-sm-3 control-label">Publish</label>  
							<div class="col-sm-5"> 
								<div class="checkbox"> 
									<label> 

										<input type="checkbox">  <?php //echo ($this->input->post('published') == 1) ? 'checked' : ((isset($day->published) && $day->published == 1) ? 'checked' : ''); ?>

										<input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == 1) ? 'checked' : ((isset($day->published) && $day->published == 1) ? 'checked' : ''); ?> <?php echo $updType == 'create' ? 'checked' : ''; ?> />

									    <!--<label class='labelforminline' for='active'> <?=lang('web_is_active')?> </label>-->
									</label> 
									<!-- tooltip area -->
									<span class="tooltipcontainer">
									<span type="text" id="published-target" class="tooltipicon"></span>
									<span class="published-target  tooltargetdiv" style="display: none;" >
									<span class="closetooltip"></span>
									<!--tip containt-->
									<?php echo lang('section_fld_published');?>
			                         <!--/tip containt-->
									</span>
									</span>
								<!-- tooltip area finish -->

									<?php echo form_error('published'); ?>
								</div> 
								
							</div> 
						</div>

						<!--<div>

							<label class='labelform'>Access</label>

						      <select name="access">

						      	<option value="0" <?php echo ($this->input->post('access') == 0) ? 'selected' : ((isset($day->access) && $day->access == 0) ? 'selected' : ''); ?>>Students</option>

						      	<option value="1" <?php echo ($this->input->post('access') == 1) ? 'selected' : ((isset($day->access) && $day->access == 1) ? 'selected' : ''); ?>>Members</option>

						      	<option value="2" <?php echo ($this->input->post('access') == 2) ? 'selected' : ((isset($day->access) && $day->access == 2) ? 'selected' : ''); ?>>Guests</option>

						      </select>


												<span class="tooltipcontainer">
												<span type="text" id="access-target" class="tooltipicon"></span>
												<span class="access-target  tooltargetdiv" style="display: none;" >
												<span class="closetooltip"></span>
											
												<?php echo lang('section_fld_access');?>
						                      
												</span>
												</span>

							</div>-->
                             
                             <?php
                             	
                             	if(empty($day->description))
                             	{
                             		//echo '1';
                             	}
                             ?>
                             <div class="seperator"></div>
<div class="col-sm-12 no-padding">
<div></div>
<input type="checkbox" name="preview_check" value="1" id="preview_check"><label class="control-label dark_label">&nbsp; Click here for Section Preview </label>
</div>
                             <div id="preview-mode" style="display: none;">
							<div class="form-group"> 
								<label class="col-sm-3 control-label">Preview Description</label> 

								<div class="col-sm-5"> 
								<?php $descriptionvalue = ($this->input->post('description')) ? $this->input->post('description') : ((empty($day->description)) ? '' : $day->description );?>
									<textarea class="form-control" name="description" id="description"  rows="4"><?php echo $descriptionvalue;?></textarea>
									<!-- tooltip area --> 
							            
							        <span class="tooltipcontainer"> <span type="text" id="description-target" class="tooltipicon" title="Click Here"></span> <span class="description-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
							            
							        <!--tip containt--> 
                                    <?php echo 'Section Description';?>
                      
									</span>
									</span>
								</div> 
							</div>

							<?php 

								//$layout_media1_flag = (isset($db_media[0]->media_id)) ? true : false;
								$layout_media1_flag = (isset($day->media_id)) ? true : false;

								$layout_text1_flag = (isset($db_mediatext[0]->media_id)) ? true : false;

							?>



					</div>
					</div>
					<div id="media-preview" style="display: none;">
					<div class="panel-body with-table">

					<table class="table table-bordered table-responsive">
						
					<tbody>

						<tr>						

						<td style="text-align:left;" id="menu_med_1">

							<div id="before_menu_med_1" class="col-sm-offset-3 col-sm-5" > <!--style="<?php if($layout_media1_flag){ ?>display:none<?php }?>"-->

							Add Section Media:</br></br>
                            <a href="<?php echo base_url(); ?>medias/ajaxaddmodulemedia/firstmedia/1" class="iframe2 btn">Select Existing Video</a>

                            <!--<a href='<?php echo base_url(); ?>medias/ajaxaddmodulemediatext/firsttext/1' class="fancybox fancybox.iframe btn">Select Existing Text</a>-->
                             <?php
				               	if(@$day->media_id)
								{  
				              ?>
								<input type="button" class="btn btn-danger" name="removemedia" id="removemedia" value="Remove Video" />
							<?php
							    }
							?>

							     <a style="<?php if($layout_media1_flag){ ?>display:none<?php }?>" href="<?php echo base_url(); ?>medias/createsectionmedia" class="iframe btn btn-success">Add New Video</a>
                            </div>
                            
							<!--<div id="before_menu_med_1" class="col-sm-offset-3 col-sm-5" style="<?php if($layout_media1_flag){ ?>display:none<?php }?>">

                         

                           

                            </div>-->

						   <!--	<div id="after_menu_med_1" style="<?php if(!$layout_media1_flag){ ?>display:none<?php }?>"><a style="background-color:#999999; color:#000000; padding:3px 10px; text-decoration:none;" href="<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/1" class="fancybox fancybox.iframe">Replace media</a></div> -->

                            <!--<div>

							or

							<div id="before_menu_txt_1"  style="<?php if($layout_text1_flag){ ?>display:none<?php }?>"><a style="background-color:#999999; color:#000000; padding:3px 10px; text-decoration:none;" href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe">Select Text</a></div>-->

							<!--<div id="after_menu_txt_1" style="<?php if(!$layout_text1_flag){ ?>display:none<?php }?>"><a style="background-color:#999999; color:#000000; padding:3px 10px; text-decoration:none;" href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe">Replace Text</a></div>

							</div>            -->

							<div id="media_1" class="col-sm-offset-3 col-sm-5">

							<?php

							if($layout_media1_flag){ ?>

								<script type="text/javascript">

								jQuery('#media_1').load("<?php echo base_url();?>medias/ajaxmediaview/<?php echo $day->media_id;?>/1");

								</script>

								<?php }else{?>

								<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">

								<?php }?>

							</div>

							<!--<div id="text_1" style="float:left; margin-top:5px;">

							<?php 

								if($layout_text1_flag){ ?>

								<script type="text/javascript">

								jQuery('#text_1').load("<?php echo base_url();?>medias/ajaxmediaview/<?php echo $db_mediatext[0]->media_id;?>/1");

								</script>

								<?php }else{?>

								<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">

								<?php }?>

							</div>-->

							<div id="after_menu_med_1" align="right" class="col-sm-offset-3 col-sm-5" style="display:none; float:left; margin-top:7px; margin-left:5px;">
							<img src="<?php echo base_url()?>public/default/images/delete.gif" title="Remove this media!" alt="Remove" onclick="javascript:deleteMedia('media_1', 'db_media_1');">
							</div>

						</td>

					</tr>

                    <!--<tr>

						<td>

							<table>

								<tbody><tr>

									<td>

										Access									</td>

									<td>

										<select name="access">

											<option value="0">Students</option>

											<option value="1">Members</option>

											<option value="2">Guests</option>

										</select>

									</td>

								</tr>

							</tbody></table>

						</td>

					</tr>-->

					</tbody>
					
					</table>

					<input id="db_media_1" type="hidden" value="<?php echo set_value('db_media_1', (isset($day->media_id)) ? $day->media_id : '0'); ?>" name="db_media_1">

					<input id="db_text_1" type="hidden" value="<?php echo set_value('db_text_1', (isset($db_mediatext[0]->media_id)) ? $db_mediatext[0]->media_id : '0'); ?>" name="db_text_1">



					<?php echo form_hidden('parent_id',$parent_id) ?>	

					<?php if ($updType == 'edit'): ?>

					<?php echo form_hidden('id',$day->id) ?>

					<?php endif ?> 	 

					</div> 

				</div>

			</div>
		</div>

	</div>
</div>
</div>
<div style="clear:both;"></div>

<?php echo form_close(); ?>




<!-- tool tip script -->
<script type="text/javascript">
/*$(document).ready(function(){
	$('.tooltipicon').click(function(){
	var dispdiv = $(this).attr('id');
	$('.'+dispdiv).css('display','inline-block');
	});
	$('.closetooltip').click(function(){
	$(this).parent().css('display','none');
	});
	});*/
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

<!--<script type="text/javascript">

		$(document).ready(function() {

			/*

			 *  Simple image gallery. Uses default settings

			 */



			$('.fancybox').fancybox();



			/*

			 *  Different effects

			 */



			// Change title type, overlay closing speed

			$(".fancybox-effects-a").fancybox({

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

			$(".fancybox-effects-b").fancybox({

				openEffect  : 'none',

				closeEffect	: 'none',



				helpers : {

					title : {

						type : 'over'

					}

				}

			});



			// Set custom style, close if clicked, change title type and overlay color

			$(".fancybox-effects-c").fancybox({

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

			$(".fancybox-effects-d").fancybox({

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



			$('.fancybox-buttons').fancybox({

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



			$('.fancybox-thumbs').fancybox({

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

			$('.fancybox-media')

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



			$("#fancybox-manual-a").click(function() {

				$.fancybox.open('1_b.jpg');

			});



			$("#fancybox-manual-b").click(function() {

				$.fancybox.open({

					href : 'iframe.html',

					type : 'iframe',

					padding : 5

				});

			});



			$("#fancybox-manual-c").click(function() {

				$.fancybox.open([

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
</script>-->

<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
		<script>
		   var $j = jQuery.noConflict();
			$j(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				
			  $j(".iframe").colorbox({iframe:true, width:"50%", height:"75%",fixed:true});
			  $j(".iframe2").colorbox({iframe:true, width:"700px", height:"770px",fixed:true});

				
			});
		</script>

<script>
	$('#removemedia').click(function() {
		$('#media_1 #movieframe1').hide();
		$('#db_media_1').val('0');
	});
</script>

<script>
	$('#removetext').click(function() {
		$('#text_1 #movieframe1').hide();
		$('#db_text_1').val('0');
	});
</script>
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#description',
  height: 180,
 // min_width: 400,
  theme: 'modern',
  plugins: [
    'advlist autolink lists print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime nonbreaking save table contextmenu directionality',
    'paste textcolor colorpicker textpattern'
  ],
  menubar: 'file edit insert view format table',
  toolbar1: 'undo redo | bold italic | alignleft aligncenter | alignright alignjustify | bullist numlist | outdent indent | forecolor backcolor fontselect fontsizeselect | print preview fullscreen',
  //toolbar2: 'print preview | forecolor backcolor',
  //toolbar2:'fontselect fontsizeselect | styleselect',
  image_advtab: true,
  paste_as_text: true,  
  // templates: [
  //   { title: 'Test template 1', content: 'Test 1' },
  //   { title: 'Test template 2', content: 'Test 2' }
  // ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
   });
  </script>
  <script type="text/javascript">
  $("#preview_check").click(function() {
    if($(this).is(":checked")) {
        $("#preview-mode").show();
        $("#media-preview").show();
    } else {
        $("#preview-mode").hide();
        $("#media-preview").hide();
    }
});
</script>