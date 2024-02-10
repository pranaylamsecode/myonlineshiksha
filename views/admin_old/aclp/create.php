<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">

<div class="main-container">

<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open(base_url().'admin/aclp/create', $attributes) : form_open(base_url().'admin/aclp/edit/'.$id, $attributes);
?>

<div id="toolbar-box">



	<div class="m top_main_content">



		<div id="toolbar" class="toolbar-list">



			


			<div class="clr"></div>



		</div>



		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo 'Access Permission';?></h2></div>



	</div>



</div>







<div>



    <span class="clearFix">&nbsp;</span>



</div>







	<fieldset class="adminform">



<div class="field_container">
<div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="padding-left:0;">
					<?php



        if($updType == 'create')



        echo "Add Modules";



        else



        echo "Edit Module";



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
				
				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">
					<?php echo form_error('chkgrp'); ?>
					<div class="form-group form-border" style="margin:0;">
						<label for="field-1" class="col-sm-3 field-title control-label" style="padding-top:0;">Category Name :</label>
						
						<div class="col-sm-8">
							
                            <input type="hidden" name="grpiid" id="grpiid" class="col-sm-9 control-label" value="<?php echo @$grpobj->id; ?>" />

        <?php echo @$grpobj->title; ?>



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="grpname-target" class="tooltipicon"></span>

						<span class="grpname-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_group-name');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->

        
						</div>
					</div>
					
					
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-3 field-title control-label" style="padding-top:0;">Module<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-8">
							
                            <?php



                        // if($updType == 'edit')



                        // {



                        //     echo ucfirst($grpmodobj->modules);



                        // }else



                        // { ?>



                       <select name='modules' id='modules' class='form-control form-height'>

                            <option value="Exams" <?php echo (($updType == 'edit' && $grpmodobj->modules == 'Exams')? 'selected' : '' ) ?> >Exams</option>



                            <option value="courses" <?php echo (($updType == 'edit' && $grpmodobj->modules == 'courses')? 'selected' : '' ) ?> >Courses</option>



                            <option value="media" <?php echo (($updType == 'edit' && $grpmodobj->modules == 'media')? 'selected' : '' ) ?> >Media</option>


                            <option value="users" <?php echo (($updType == 'edit' && $grpmodobj->modules == 'users')? 'selected' : '' ) ?> >Users</option>
							
							
                            <option value="course media" <?php echo (($updType == 'edit' && $grpmodobj->modules == 'course media')? 'selected' : '' ) ?> >Course Media</option>



                       </select>



	                   <?php echo form_error('modules');



                       // }



                        ?>



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="modules-target" class="tooltipicon"></span>

						<span class="modules-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_module');?>

                        
						</span>

						</span> -->

					<!-- tooltip area finish -->

                    
						</div>
					</div>
				
                    
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-12 field-title control-label">Permissions<span class="error">*</span></label>
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


					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="permission-target" class="tooltipicon"></span>

						<span class="permission-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_permissions');?>

                         

						</span>

						</span>
 -->
					<!-- tooltip area finish -->
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

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="permission-target" class="tooltipicon"></span>

						<span class="permission-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_permissions');?>

                         

						</span>

						</span>
 -->
					<!-- tooltip area finish -->

                            </div>
					
					 <?php } ?>
                   
					
					<div class="form-group form-border" style="padding-top:2%!important;margin:0;">
                    <div class="col-sm-12">
			    		<div class="grey-background" style="display:-webkit-box;padding-bottom: 0!important;">
                    <label class="col-sm-3 control-label dark_label">Access<span style="color:#FF0000;" class="error">*</span></label>
						<div class="col-sm-9">
                        <?php

						if($updType == 'edit'){    
						
						?>
						<div class="radio">
						<input type="radio" name="access" id="access1" value="1" <?php echo (($grpmodobj->access==='1')?'checked':'') ?>/>&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
						<br>
                       <input type="radio" name="access" id="access0" value="0" <?php echo (($grpmodobj->access==='0')?'checked':'') ?>/>&nbsp;&nbsp;No
						</div>


	                   <span style="color:#FF0000;" class="error"><?php echo form_error('access'); ?></span>
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="access-target" class="tooltipicon"></span>

						<span class="access-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('user_fld_access');?>

						</span>

						</span> -->

					<!-- tooltip area finish -->
							
							
                            
                            
                            <?php }else{ ?> 
                            
                        <div class="radio">
							<input type="radio" name="access" id="access1" value="1" />&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;

						</div>
 						<div class="radio">

                       		<input type="radio" name="access" id="access0" value="0" />&nbsp;&nbsp;No
						</div>


	                   <span style="color:#FF0000;" class="error"><?php echo form_error('access'); ?></span>
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="access-target" class="tooltipicon"></span>

						<span class="access-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('user_fld_access');?>

						</span>

						</span>
 -->
					<!-- tooltip area finish -->
							
							
						</div>
						</div>
						
					
                    <?php } ?>
                 </div>
					</div>
					<div class="form-group form-border" style="padding-top:2.5%!important;margin:0;">
						<div class="col-sm-5">
							
                            <a>
								<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>
							</a>
                            
             				<a href='<?php echo base_url(); ?>admin/user-permissions/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</fieldset>
				
			</div>
		
		</div>
	
	</div>




</fieldset>







<?php if ($updType == 'edit'): ?>



	<?php //echo form_hidden('id',$user->id); ?>



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

