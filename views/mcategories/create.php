<?php

//$category = array();

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open(base_url().'mcategories/create', $attributes) : form_open(base_url().'mcategories/edit',$attributes);

?>

<header>


<section class="breadcrumb">
<div class="container">

      <span class="page-title">
        <?php echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?>
      </span>

      <div class="bread-view">
	    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
	    <span class="ng-hide">/ </span>
	    <a href="#"><?php echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></a>
	</div>

</div>
</section>


</header>

<div class="page-container">
<div class="sidebar-menu sb-left">
	<ul id="main-menu" class="">
             <li class="root-level"><a href="<?php echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>Manage Question Papers</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>questions/manage"><span>Manage Questions</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
      </ul>
</div>


<div class="main-content">
	<div class="row">
<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0; margin-left: 20px; ">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>




	<div class="col-md-12">	

		<div class="panel panel-primary" data-collapsed="0">

		<div class="panel-heading">
			<div class="panel-title" style="padding-bottom: 0px;">	
				<h3 style="margin-top: 0;"><?php echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h3>
			</div>
			<div  class="panel-options">
				
			</div>  
		</div>
			
			<div class="panel-body form-horizontal form-groups-bordered">
	
					<div class="form-group">
						
						<label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0;" for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						<div class="col-sm-5">
							
                            <input id="name" placeholder="Name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($category->name)) ? $category->name : ''); ?>"  />

    <span class="error" style="color: red;"><br/><?php echo form_error('name'); ?></span>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>

						<span class="name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_category-name');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
					</div>

					
					
					<div class="form-group">
						
						<label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0; " for="description"><?php echo "Description";?></label>
						<div class="col-sm-5">
							
                              <textarea name="description" id="description" placeholder="Description"  rows="6"><?php echo $this->input->post('description')? $this->input->post('description') :((isset($category->description)) ? $category->description : ''); ?></textarea>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="description-target" class="tooltipicon" title="Click Here"></span>

						<span class="description-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_category-description');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
					</div>

                    
                    
      
					
					
					<div class="form-group">
						
						<label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0;" for='category_id'>Category</label>
						<div class="col-sm-5">
							
                            <select name='category_id' id='category_id'>



	<option value=''><?php echo '(0) Top';//echo lang('web_choose_option')?></option>



	<?php

		$combocategories = $this->mcategories_model->get_formatted_combo();



		foreach ($combocategories as $combocat): ?>



       <option value='<?php echo $combocat->id?>' <?php echo ($this->input->post('category_id') == $combocat->id) ? "selected=selected" : (isset($category->id)) && $category->id == $combocat->id  ? "selected=selected" : '' ?>><?php echo $combocat->name?></option>



		<?php endforeach ?>



	</select>
	<p> Select this option if you want to create a sub-category</p>

    <span class="error"><?php echo form_error('category_id'); ?></span>

	<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="category_id-target" class="tooltipicon" title="Click Here"></span>

						<span class="category_id-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_category');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
						
					</div>

					<div class="form-group"> 
					 <label class='col-sm-3 control-label'>Active</label>
						<div class="col-sm-5"> 
							<div class="checkbox"> 
								<label>
								<input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') && $this->input->post('published') == 1) ? 'checked == checked' : ((isset($category->published) && $category->published ==1) ? 'checked == checked' : ''); ?> <?php echo $updType == 'create' ? 'checked == checked':''; ?>/>
								<?=lang('web_is_active')?>
								</label> 
							</div> 
							
<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_category-active');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
							
						</div> 
					</div>


					
					
					<div class="form-group">

						<div class="col-sm-offset-3 col-sm-5">
						<a><?php echo form_submit( 'submit', ($updType == 'edit') ? 'Edit' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-default'") ); ?></a>
						<a style="margin-top:0px;" href='<?php echo base_url(); ?>mcategories/<?php echo $parent_id?>' class='btn btn-danger'>Cancel</a>
						</div>
					</div>

				
			</div>
		
		</div>
	
	</div>

</div>
		
</div>
	
</div>


<div style="clear:both;"></div>

<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />



<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>



<script>



 $(document).ready(



 function()



 {



   	//$('#description').redactor();



 }



 );



 </script>	



	<?php echo form_hidden('parent_id',$parent_id) ?>	







<?php if ($updType == 'edit'): ?>



	<?php echo form_hidden('id',$category->id) ?>



<?php endif ?>







<?php echo form_close(); ?>



<!-- tool tip script -->

<script>
			//(function(jQuery) {

				var $ =jQuery.noConflict();
				jQuery(document).ready(function() {
					var mySlidebars = new jQuery.slidebars();
					
					jQuery('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					jQuery('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			//}) (jQuery);
</script>

<script type="text/javascript">

//$(document).ready(function(){
//
//	$('.tooltipicon').click(function(){
//
//	var dispdiv = $(this).attr('id');
//
//	$('.'+dispdiv).css('display','inline-block');
//
//	});
//
//	$('.closetooltip').click(function(){
//
//	$(this).parent().css('display','none');
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