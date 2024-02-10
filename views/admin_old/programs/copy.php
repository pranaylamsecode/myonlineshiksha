<div class="pagetitle"><h2>Copy Course</h2></div>

<div class="col-md-12">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-heading">
	<div class="panel-title">
		Copy Course Module 
    </div>
	
	<div class="panel-options">
		<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
		<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
		<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
		<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
	</div>
</div>
			
<div class="panel-body">
				
<?php
$attributes = array('class' => 'tform', 'id' => '');
echo form_open_multipart(base_url().'admin/programs/copy', $attributes);
?>
					
                    <div class="form-group">
                    
                    <label class='col-sm-3 control-label'>Select Course To Copy</label>
					<?php
					$comboCourse = $this->programs_model->getCourseCombo();
					?>
					
					    <div class="col-sm-8">							
							<select name='CbCourse' id='CbCourse' class="form-control">
								<option value="" >-- Select Course To Copy --</option>
								<?php					
								foreach($comboCourse as $comboQz)
								{
									?>
									<option value="<?php echo $comboQz['id']?>" ><?php echo $comboQz['name'];?></option>
									<?php 
								}
								?>
							</select>							
							<?php echo form_error('CbCourse'); ?>
							
							<br />
							<input type='submit' name='btnSubmit' id='btnSubmit' value='Copy Course' class='btn btn-default'>
							<a href="<?php echo base_url();?>admin/programs/" class="btn btn-default"><span class="icon-32-cancel"> </span>Cancel</a>
								<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="reg_quizz_published-target" class="tooltipicon"></span>
								<span class="reg_quizz_published-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
									<?php echo lang('quizz_fld_regular-published-active');?>
								<!--/tip containt-->
								</span>
								</span>
								<!-- tooltip area finish -->
						</div>
					</div>
					
					</div>
</div></div>