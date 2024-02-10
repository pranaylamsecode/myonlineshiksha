<div class="pagetitle"><h2>Copy Quiz</h2></div>

<div class="col-md-12">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-heading">
	<div class="panel-title">
		Copy Quiz Module 
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
echo form_open_multipart(base_url().'/admin/quizzes/copy', $attributes);
?>
					
                    <div class="form-group">
                    
                    <label class='col-sm-3 control-label'>Select Quiz To Copy</label>
					<?php
					$comboQuiz = $this->quizzes_model->getQuizCombo();
					?>
					
					    <div class="col-sm-8">							
							<select name='CbQuiz' id='CbQuiz' class="form-control">
								<option value="" >-- Select Quiz To Copy --</option>
								<?php					
								foreach($comboQuiz as $comboQz)
								{
									?>
									<option value="<?php echo $comboQz['id']?>" ><?php echo $comboQz['name'];?></option>
									<?php 
								}
								?>
							</select>							
							<?php echo form_error('CbQuiz'); ?>
							
							<br />
							<input type='submit' name='btnSubmit' id='btnSubmit' value='Copy Quiz' class='btn btn-default'>
							<a href="<?php echo base_url();?>admin/exam-papers/" class="btn btn-default"><span class="icon-32-cancel"> </span>Cancel</a>
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