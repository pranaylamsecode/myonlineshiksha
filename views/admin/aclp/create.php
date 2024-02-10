<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">

<div class="main-container">

<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open(base_url().'admin/aclp/create', $attributes) : form_open(base_url().'admin/aclp/edit/'.$id, $attributes);
?>



<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2>Add permission to new module</h2></div>
		
	</div>
</div>

	<fieldset class="adminform">



<div class="field_container">
<div class="row">

				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">
					<?php echo form_error('chkgrp'); ?>
					<div class="form-group form-border" style="margin:0;">
						<label for="field-1" class="col-sm-3 field-title control-label" style="padding-top:0;">User Role:</label>
						
						<div class="col-sm-8">
							
                            <input type="hidden" name="grpiid" id="grpiid" class="col-sm-9 control-label" value="<?php echo @$grpobj->id; ?>" />

                            <input class="col-sm-9 form-control" type="text" name="" value="<?php echo @$grpobj->title; ?>" readonly >
        



        
						</div>
					</div>
					
					
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-3 field-title control-label" style="padding-top:0;">Module<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-8">
							
                            <?php



                        if($updType == 'edit')



                        {



                            echo ucfirst($grpmodobj->modules);



                        }else



                        { ?>



                       <select name='modules' id='modules' class='form-control form-height'>



                            <option value="Exams">Exams</option>



                            <option value="courses">Courses</option>



                            <option value="media">Media</option>


                            <option value="users">Users</option>
							
							
                            <option value="course media">Course Media</option>



                       </select>



	                   <?php echo form_error('modules');



                       }



                        ?>


                    
						</div>
					</div>
				
                    
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-12 field-title control-label">Access Permission<span class="error">*</span></label>
						<?php 
						if($updType == 'edit')
						{    
						?>
						<div class="col-sm-12">
							
                             <select name='permission' id='permission' class='form-control form-height'>



                            <option value="own" <?php echo (($grpmodobj->permission==='own')?'selected':'') ?>>Own</option>



                            <option value="view_all" <?php echo (($grpmodobj->permission==='view_all')?'selected':'') ?>>View All</option>



                            <option value="modify_all" <?php echo (($grpmodobj->permission==='modify_all')?'selected':'') ?>>Modify All</option>



                       </select>
                       <span class='required'><?php echo form_error('permission'); ?></span>


					</div>
                   
                   
						</div>
                        <?php }else{ ?>
                                             
                        <div class="col-sm-12">
							
                            <select name='permission' id='permission' class='form-control form-height'>



                            <option value="own" >Own</option>



                            <option value="view_all" >View All</option>



                            <option value="modify_all" >Modify All</option>
                       	</select>

                        <span class='required'><?php echo form_error('permission'); ?></span>

				

                            </div>
					
					 <?php } ?>
                   
					
					<div class="form-group form-border" style="margin:0;">
                    <div class="col-sm-12">
			    		<div class="grey-background" style="display:-webkit-box;padding-bottom: 0!important;">
                    <label class="col-sm-3 control-label dark_label">Publish<span style="color:#FF0000;" class="error">*</span></label>
						<div class="col-sm-9">
                        <?php

						if($updType == 'edit'){    
						
						?>
						<div class="radio">
						<input type="radio" name="access" id="access1" value="1" <?php echo (($grpmodobj->access==='1')?'checked':'') ?>/>&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
                       <input type="radio" name="access" id="access0" value="0" <?php echo (($grpmodobj->access==='0')?'checked': ($updType ==='create') ? 'checked' : '') ?>/>&nbsp;&nbsp;No
						</div>


	                   <span style="color:#FF0000;" class="error"><?php echo form_error('access'); ?></span>
				
                            
                            
                            <?php }else{ ?> 
                            
                        <div class="radio">
							<input type="radio" name="access" id="access1" value="1" />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;

						</div>
 						<div class="radio">

                       		<input type="radio" name="access" id="access0" value="0" />&nbsp;&nbsp;No
						</div>


	                   <span style="color:#FF0000;" class="error"><?php echo form_error('access'); ?></span>
					
							
							
						</div>
						</div>
						
					
                    <?php } ?>
                 </div>
					</div>
					<div class="form-group form-border" >
						<div class="col-sm-5">
							
                            <a>
								<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Update' : 'Update', (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>
							</a>
                            
             				<a href='<?php echo base_url(); ?>admin/user-permissions/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</fieldset>
				
			</div>
		
		</div>
	
</fieldset>

</div>





<?php if ($updType == 'edit'): ?>



	<?php //echo form_hidden('id',$user->id); ?>



<?php endif ?>



<?php echo form_close(); ?>





<!-- tool tip script -->

<script type="text/javascript">



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

