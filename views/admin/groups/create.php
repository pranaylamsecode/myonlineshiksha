<?php
$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/groups/create', $attributes) : form_open_multipart(base_url().'admin/groups/edit/'.$id, $attributes);
?>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<!----- my code-- -->
<div class="main-container">

<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2>Create Category</h2></div>
		
	</div>
</div>
<div class="field_container">
<div class="row">

				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">
	
					<div class="form-group form-border" style="margin:0;">
						<label for="name" class="col-sm-12 field-title control-label"> Select Parent Role<span class="required">*</span> :</label>						
                        <div class="col-sm-12">							
                               
                    <select name='pid' id='pid' class="form-control form-height">

                        <option value=''>No parent</option>

                		<?php

                		$combocategories = $this->groups_model->get_formatted_combo();

                		foreach ($combocategories as $combocat): ?>

						<option value="<?php echo @$combocat->id ?>"  <?php echo preset_select('pid', $combocat->id, (isset($groups->parent_id)) ? $groups->parent_id : @$id  ) ?>><?php echo $combocat->title?></option>

                		<?php endforeach ?>

                	</select>

					<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="name-target" class="tooltipicon"></span>
						<span class="name-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('group_fld_name');?>
						
						</span>
						</span> -->
					<!-- tooltip area finish -->
                     <span class="error"><?php //echo" Please select the Group Parent"; //echo form_error('pid'); ?></span>
						</div>
					</div>
					
				
					
					<div class="form-group form-border" style="margin:0;padding:0!important">
                        
                        <label class='col-sm-12 field-title control-label' for="description">Role name<span class="required">*</span> :</label>
						
                        <div class="col-sm-12">
	
                            
                            <input id='title' type='text' name='title' class="form-control form-height" placeholder="Enter user role name" value="<?php echo set_value('title', (isset($groups->title)) ? $groups->title : ''); ?>"   />

					<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="title-target" class="tooltipicon"></span>
						<span class="title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('group_fld_title');?>
						
						</span>
						</span> -->
					<!-- tooltip area finish -->
                    <span class="error"><?php echo form_error('title'); ?></span>

						</div>
                        
						
					</div>
					
				
                    
					<div class="form-group form-border" style="margin:0;padding:0!important">
						<div class="col-sm-5">
                            <?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit'  class='btn btn-default btn-green'")); ?>
                            <a href='<?php echo base_url(); ?>admin/users-category<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>
						</div>
                       
					</div>
                    
                   
              
				</fieldset>
				
			
</div>



</div>

</div><!-- Footer -->
<!--<footer class="main">
	
		<div class="pull-right">
		<a href="#" target="_blank"><strong>Design by VeerIT</strong></a>
	</div>
		
	© 2014 <strong>MLMS</strong> Admin Theme by <a href="#" target="_blank">VeerIT</a>
	
</footer>	
</div>

</div>-->


<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$groups->id) ?>

<?php endif ?>



<?php echo form_close(); ?>

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