
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />


<base href="<?php echo $this->config->item('base_url') ?>public/" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
<style>
.error{
	color: red;
	font-size:13px;
}

.redactor-editor {
  min-width: 0px!important; 
}
.main-table {
  display: block!important;
  width: 100%!important;
}
</style>




<div class="main-container">
<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'create') ? form_open(base_url().'admin/days/create', $attributes) : form_open(base_url().'admin/days/edit', $attributes);



?>



<div id="toolbar-box">



	<div class="m top_main_content">



		<div id="toolbar">


			<div id="sticky-anchor"></div>
			<ul id="sticky" class="main-content-btn" style="list-style: none; float: right;">



            <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
				<?php 
				//echo form_button( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'") ); 
				?>			
				<input type="submit" id='submit' name='submit' value='Save & Back To List' class='btn btn-success btn-blue'>
			</li>
			
			<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



			<a href='<?php echo base_url(); ?>admin/section-management/<?php echo $parent_id?>' class='btn btn-danger btn-dark-grey' id="forward" style="color:#FFF;">Cancel</a>



			</li>            



			</ul>



			<div class="clr"></div>



		</div>



		<div class="col-sm-7 pagetitle icon-48-generic no-padding"><h2><?php echo ($updType == 'edit')? 'Edit Section':'Create New Section';?></h2></div>



	</div>



</div>



<div class="field_container">
<div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
<div class="panel primary-border panel-primary" data-collapsed="0">
<div class="panel-heading">
	<div class="panel-title">
	 
    </div>
	
	<div class="panel-options">
		<!--<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
		<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
		<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
		<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>-->
	</div>
</div>
			
<div class="panel-body form-body main-table">
				
				<fieldset class="adminform form-horizontal form-groups-bordered" style="width:100%;">	
				
                    <div class="form-group form-border">
                    
                    <label class='col-sm-12 field-title control-label' for="title"><?php echo 'Section Name'//echo lang('web_name')?> <span class="required">*</span></label>

										
					    <div class="col-sm-12">							
							<input id="title" type="text" name="title" class="form-control form-height" maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : ((isset($day->title)) ? $day->title : ''); ?>"  />



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="title-target" class="tooltipicon"></span>

						<span class="title-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('section_fld_title');?>

                         

						</span>

						</span> -->
                        <span class="error"><?php echo form_error('title'); ?> </span>

					<!-- tooltip area finish -->
						</div>
						
							<!-- <p style="text-align: -webkit-center; padding-right: 4px;"> Enter Your Course Title Here when preview should be dynamic</p> -->
						
					</div>
                    
                    <div class="form-group no-padding form-border">
                    <div class="col-sm-12">
                   <div class="grey-background grey-background-display">
                    <label class='control-label'><?//=lang('web_active')?></label>
                    
                    	<div class="col-sm-12 no-padding">
                    <?php //echo ($this->input->post('published') == 1) ? 'checked' : ((isset($day->published) && $day->published == 1) ? 'checked' : ''); ?>



	<input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == 1) ? 'checked' : ((isset($day->published) && $day->published == 1) ? 'checked' : ''); ?> <?php echo ($updType == 'create')? 'checked':'';?>/>







  <!--  <label class='control-label dark_label' for='active'> Activate<?//=lang('web_is_active')?> </label>
 -->
  <label class='control-label dark_label' for='active'> Publish<?//=lang('web_is_active')?> </label>



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('section_fld_published');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->



	<?php echo form_error('published'); ?>
                    	</div>
                    </div>
                    </div>
                    </div>
                    
                    <!--<div class="form-group">
                    <label class='col-sm-3 control-label'>Access</label>
                    
                    	<div class="col-sm-5">
	 <select name="access" class="form-control">



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



                    	</div>
                    
                    </div>-->
                    <div class="seperator"></div>
<div class="col-sm-12 no-padding">
<div></div>
<input type="checkbox" name="preview_check" value="1" id="preview_check"><label class="control-label dark_label">&nbsp; Click here for Section Preview </label>
</div>
                   <div id="preview-mode" style="display: none;">
                     <div class="form-group form-border">
				          <label class="col-sm-12 field-title control-label" for="description"><!-- <?php echo lang('web_description')?> -->Preview Description</label>
				          <div class="col-sm-12">
				            <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
				            <textarea  name="description" id="description" class="form-control" rows="4"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($day->description)) ? $day->description : '');?></textarea>
				            
				            <!-- tooltip area --> 
				            
				            <!-- <span class="tooltipcontainer"> <span type="text" id="description-target" class="tooltipicon" title="Click Here"></span> <span class="description-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span>  -->
				            
				            <!--tip containt--> 
				            
				            <!-- <?php echo lang('course_fld_description');?> --> </span> </span> <span class="error"><?php echo form_error('description'); ?></span> </div>
				        </div>
                    </div>
               
					
					</fieldset>
                    
                    


<?php 



	 $layout_media1_flag = (isset($day->media_id)) ? true : false;



	 $layout_text1_flag = (isset($db_mediatext[0]->media_id)) ? true : false;



?>

<div id="media-preview" style="display: none;">
<div class="row form-border">
<div class="col-sm-12 control-label field-title">Preview Media</div>
<div class="col-sm-12"> 
	<div class="panel form-body panel-primary" data-collapsed="0"> 
		<div class="panel-heading"> 
			<div class="panel-title">
				<a  href="<?php echo base_url() ?>admin/medias/ajaxaddmodulemedia/firstmedia/1" class="iframe btn btn-default btn-border-blue">Select Media</a>
				<a  href="<?php echo base_url() ?>admin/medias/createsectionmedia" class="iframe2 btn btn-default btn-border-green">Create Media</a>
               <?php
               if($updType == 'edit')
               {
               	if($day->media_id)
				{  
               ?>
				<input type="button" class="btn btn-danger btn-border-blue" name="removemedia" id="removemedia" value="Remove Media" />
				<?php
			    }
			   }
				?>
			</div> 
		</div> 
	<div class="panel-body"> 
		<div class="fileinput fileinput-new" data-provides="fileinput">
			

			<div class="fileinput-new thumbnail" data-trigger="fileinput"> 

				<div id="media_1" style="float:left; margin-top:5px;">



							<?php 							

							if($layout_media1_flag)
							{  

						       
						    ?>



								<script type="text/javascript">



								jQuery('#media_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $day->media_id;?>/1");



								</script>                                
                                 	
                                 
                                   
								<?php }else{?>


                                 <div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
								<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



								<?php }?>



							</div>
			
			</div> 
		

		</div> 

	</div> 

	</div> 

</div>

<!--<div class="col-sm-6"> 
	<div class="panel panel-primary" data-collapsed="0"> 
		<div class="panel-heading"> 
			<div class="panel-title">
				<a href='<?php echo base_url() ?>admin/medias/ajaxaddmodulemediatext/firsttext/1' class="fancybox fancybox.iframe btn btn-default">Select Text</a>
                <?php
               	if(@$db_mediatext[0]->media_id)
				{  
               ?>
				<input type="button" class="btn btn-danger" name="removetext" id="removetext" value="Remove Text" />
				<?php
			    }
				?>          
                           &nbsp <span>   This is the content for the introduction page of the section. </span>
			</div> 
		</div> 
	<div class="panel-body"> 
		<div class="fileinput fileinput-new" data-provides="fileinput">
			

			<div class="fileinput-new thumbnail" data-trigger="fileinput"> 

				<div id="text_1" style="float:left;margin-top:5px; text-align: start;  padding: 5px 10px;">



							<?php 



								if($layout_text1_flag){  ?>

										

								<script type="text/javascript">



								jQuery('#text_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[0]->media_id;?>/1");



								</script>



								<?php }else{?>


                               <div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
								<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



								<?php }?>



							</div>
			
			</div> 
		
		
		
		

		</div> 

	</div> 

	</div> -->

	<div id="after_menu_med_1" align="right" style="display:none; float:left; margin-top:7px; margin-left:5px;"><img src="<?php echo base_url()?>public/default/images/delete.gif" title="Remove this media!" alt="Remove" onclick="javascript:deleteMedia('media_1', 'db_media_1');"></div>


	</div>
</div>
</div>




</div>
	</div>
	</div>

			</div>
		</div>
</div>





<input id="db_media_1" type="hidden" value="<?php echo set_value('db_media_1', (isset($day->media_id)) ? $day->media_id : '0'); ?>" name="db_media_1">



<input id="db_text_1" type="hidden" value="<?php echo set_value('db_text_1', (isset($db_mediatext[0]->media_id)) ? $db_mediatext[0]->media_id : '0'); ?>" name="db_text_1">







	<?php echo form_hidden('parent_id',$parent_id) ?>	







<?php if ($updType == 'edit'): ?>



	<?php echo form_hidden('id',$day->id) ?>



<?php endif ?>


	
</div>
</div>


<?php echo form_close(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>public/colorbox-master/jquery.colorbox.js"></script>
		<script>
		   var $j = jQuery.noConflict();
			$j(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				
			  $j(".iframe").colorbox({iframe:true,fixed:true, width:"700px", height:"770px"});			
			  $j(".iframe2").colorbox({iframe:true,fixed:true, width:"713px", height:"591px"});			
			});
		</script>
<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>


<script src="js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>



 <script type="text/javascript">



 $(function(){



  $("#forward").click(function() {



   window.parent.location.href = "<?php echo base_url(); ?>admin/section-management/<?php echo $parent_id?>";



   });



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

<!-- tool tip script -->

<script type="text/javascript">

$(document).ready(function(){

	$('.tooltipicon').click(function(){

	var dispdiv = $(this).attr('id');

	$('.'+dispdiv).css('display','inline-block');

	});

	$('.closetooltip').click(function(){

	$(this).parent().css('display','none');

	});

	});

	</script>

<!-- tool tip script finish -->

<script>
var $ =jQuery.noConflict();
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>
<script src='<?php echo base_url() ?>public/js/tinymce/tinymce.min.js'></script>
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