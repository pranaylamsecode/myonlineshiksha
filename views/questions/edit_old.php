<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>

 $(function() {    $( document ).tooltip();  });

</script>
<!-- new code start -->

<!-- new code end -->
<?php
foreach($questions as $questions)
{
?>
<h2>Edit Question</h2>
<div class="row">
	<div class="col-md-12">		
		<div>		
				<!--<ul class="nav nav-tabs bordered">
					<li class="active"><a href="#regular" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Regular</span></a></li> 
					<li> <a href="#matchthepair" data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Match The Pair</span></a></li>
					<li> <a href="#truefalse" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">True/False</span></a></li> 
					<li> <a href="#multipletype" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Multiple Type</span></a></li>
					<li> <a href="#mediaquestion" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Media Question</span></a></li>
				</ul>-->

			<!-- ........................... Regular.............................................. -->
				<?php
				if($questions->question_type == 'regular')
				{
				?>			
				<h4>Question Type : <?php echo ucfirst($questions->question_type);?></h4>

				
					
					<form action="<?php echo base_url();?>index.php/admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmRegular' id='frmRegular' style="  border: 1px solid #ebebeb;
  padding: 15px 12px;
  border-radius: 3px;">
						<div class="form-group" style="text-align: right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" value="<?php echo $questions->question_tag;?>" class="form-control" required />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='regular' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtQuestion" name="txtQuestion" class="form-control" rows="6" required /><?php echo $questions->question;?></textarea>
							</div>
						</div><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtPoints" name="txtPoints" value="<?php echo $questions->points?>" class="form-control" required />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="pool">In Question Pool</label>							
							<div class="col-sm-9">							
	                      		<input type='checkbox' id="chkInpool" name="chkInpool" <?php echo ($questions->in_questions_pool = '1') ? 'checked' : '';?> />
							</div>
						</div><br><br><br>
					
						<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i=1;
									$CI = & get_instance();
									$CI->load->model('questions_model');
									$regularData = $this->questions_model->getAnsOptions($questions->question_id);
									$countReg = count($regularData); 

									foreach($regularData as $regData)
									{
										$txtRegOpt = 'txtRegOpt'.$i;
										$chkReg = 'chkReg'.$i;
										?>
										<tr>
										 	<td><?php echo $i;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtRegOpt?>" id="<?php echo $txtRegOpt?>" value="<?php echo $regData['ans_option']?>" ></td>
										 	<td><input type='checkbox' name="<?php echo $chkReg?>" id="<?php echo $chkReg?>" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : ''; ?> ></td> 
										</tr>
										<?php	
										$i++;									
									}

									for($j=$countReg+1;$j<=5;$j++)
									{
										$txtRegOpt = 'txtRegOpt'.$j;
										$chkReg = 'chkReg'.$j;
										?>
										<tr>
										 	<td><?php echo $j;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtRegOpt?>" id="<?php echo $txtRegOpt?>"></td>
										 	<td><input type='checkbox' name="<?php echo $chkReg?>" id="<?php echo $chkReg?>"></td> 
										</tr>
										<?php
									}
									?>
								</tbody>
							</table> 
						</form>					
					<?php
					}
					?>

				<!--........................... Match the pairs.............................................. -->
					<?php
					if($questions->question_type == 'match_the_pair')
					{
					?>
					<h4>Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>index.php/admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMatch' id='frmMatch' style="  border: 1px solid #ebebeb;
  padding: 15px 12px;
  border-radius: 3px;">
						<div class="form-group" style="text-align: right;" >	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" value="<?php echo $questions->question_tag;?>" class="form-control" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='match_the_pair' />
							</div>
						</div><br><br><br>
						
						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions?>" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="pool">In Question Pool</label>							
							<div class="col-sm-9">							
	                      		<input type='checkbox' id="chkInpool" name="chkInpool"  <?php echo ($questions->in_questions_pool = '1') ? 'checked' : '';?> />
							</div>
						</div><br><br><br>

						<h4>Match the pairs</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Questions</th> <th>Matching pairs (Answers)</th> <th>Score</th>
									</tr>
								</thead>
								<tbody>									
									<?php
									$i=1;
									$CI = & get_instance();
									$CI->load->model('questions_model');
									$regularData = $this->questions_model->getAnsOptions($questions->question_id);
									$countReg = count($regularData); 

									foreach($regularData as $regData)
									{
										$txtMatchque = 'txtMatchque'.$i;
										$txtMatchpair = 'txtMatchpair'.$i;
										$txtMatchpoints = 'txtMatchpoints'.$i;

										$chkReg = 'chkReg'.$i;
										?>
										<tr>
										 	<td><?php echo $i;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMatchque?>" id="<?php echo $txtMatchque?>" value="<?php echo $regData['ans_option']?>"></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMatchpair?>" id="<?php echo $txtMatchpair?>" value="<?php echo $regData['is_correct_answer']?>"></td> 
										 	<td><input type='text' class='form-control' name="<?php echo $txtMatchpoints?>" id="<?php echo $txtMatchpoints?>" value="<?php echo $regData['points']?>"></td>
										</tr>
										<?php	
										$i++;									
									}

									for($j=$countReg+1;$j<=5;$j++)
									{
										$txtMatchque = 'txtMatchque'.$j;
										$txtMatchpair = 'txtMatchpair'.$j;
										$txtMatchpoints = 'txtMatchpoints'.$j;

										?>
										<tr>
											<td><?php echo $j;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMatchque?>" id="<?php echo $txtMatchque?>"></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMatchpair?>" id="<?php echo $txtMatchpair?>"></td> 
										 	<td><input type='text' class='form-control' name="<?php echo $txtMatchpoints?>" id="<?php echo $txtMatchpoints?>"></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table> 		
						</form>				
				    <?php
					}
					?>

				<!--........................... True False.............................................. -->
					<?php
					if($questions->question_type == 'true_false')
					{
					?>
					<h4>Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>index.php/admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmTrueFalse' id='frmTrueFalse' style="  border: 1px solid #ebebeb;
  padding: 15px 12px;
  border-radius: 3px;">
						<div class="form-group" style="text-align: right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo $questions->question_tag;?>" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='true_false' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtTFQuestion"  name="txtTFQuestion" class="form-control" rows="6"/><?php echo $questions->question;?></textarea>
							</div>
						</div><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtTFPoints" name="txtTFPoints" class="form-control" value="<?php echo $questions->points;?>" />
							</div>
						</div>	<br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Select correct Answer</label>							
							<div class="col-sm-9">							
	                      		<input type='radio' name="rbTrueFalse" value='True' <?php echo ($questions->is_correct_answer == 'True') ? 'checked' : '';?> >  True
	                      		<input type='radio' name="rbTrueFalse" value='False' <?php echo ($questions->is_correct_answer == 'False') ? 'checked' : '';?> >  False
							</div>
						</div><br><br><br>		
						</form>			
					<?php
					}
					?>

				<!--........................... Fill in the blanks.............................................. -->
					<!--<div class="tab-pane" id="fillintheblanks"> 
						<form action="<?php echo base_url();?>index.php/admin/questions/create" method='post' name='frmFill' id='frmFill'>
						<div class="form-group">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"></span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='fill_in_the_blanks' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question for fill in the blanks</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtFLQuestion"  name="txtFLQuestion"  class="form-control" rows="6"/></textarea>
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" />
							</div>
						</div>						
						
						<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt1' id='txtFLOpt1'></td>
									 	<td><input type='checkbox' name='chkFL1' id='chkFL1'></td> 
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt2' id='txtFLOpt2'></td>
									 	<td><input type='checkbox' name='chkFL2' id='chkFL2'></td> 
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt3' id='txtFLOpt3'></td>
									 	<td><input type='checkbox' name='chkFL3' id='chkFL3'></td> 
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt4' id='txtFLOpt4'></td>
									 	<td><input type='checkbox' name='chkFL4' id='chkFL4'></td> 
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class="form-control" name='txtFLOpt5' id='txtFLOpt5'></td>
									 	<td><input type='checkbox' name='chkFL5' id='chkFL5'></td> 
									</tr>
								</tbody>
							</table>
						</form>
					</div>-->

				<!--........................... Multiple Type.............................................. -->
					<?php
					if($questions->question_type == 'multiple_type')
					{
					?>
					<h4>Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>index.php/admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMultiple' id='frmMultiple' style="  border: 1px solid #ebebeb;
  padding: 15px 12px;
  border-radius: 3px;">
						<div class="form-group" style="text-align: right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo $questions->question_tag;?>" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='multiple_type' />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question for multiple answers</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtMTQuestion" name="txtMTQuestion" class="form-control" rows="6" /><?php echo $questions->question;?></textarea>
							</div>
						</div><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
							</div>
						</div>	<br><br><br>
						
						<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th> <th>Score</th>
									</tr>
								</thead>
								<tbody>									
									<?php
									$i=1;
									$CI = & get_instance();
									$CI->load->model('questions_model');
									$regularData = $this->questions_model->getAnsOptions($questions->question_id);
									$countReg = count($regularData); 

									foreach($regularData as $regData)
									{
										$txtMultiOpt = 'txtMultiOpt'.$i;
										$chkMulti = 'chkMulti'.$i;
										$txtMultiPoints = 'txtMultiPoints'.$i;
										?>
										<tr>
										 	<td><?php echo $i;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMultiOpt?>" id="<?php echo $txtMultiOpt?>" value="<?php echo $regData['ans_option']?>"></td>
										 	<td><input type='checkbox'  name="<?php echo $chkMulti?>" id="<?php echo $chkMulti?>" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : '';?>></td> 
										 	<td><input type='text' class='form-control' name="<?php echo $txtMultiPoints?>" id="<?php echo $txtMultiPoints?>" value="<?php echo $regData['points']?>"></td>
										</tr>
										<?php	
										$i++;									
									}

									for($j=$countReg+1;$j<=5;$j++)
									{
										$txtMultiOpt = 'txtMultiOpt'.$j;
										$chkMulti = 'chkMulti'.$j;
										$txtMultiPoints = 'txtMultiPoints'.$j;

										?>
										<tr>
											<td><?php echo $j;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMultiOpt?>" id="<?php echo $txtMatchque?>"></td>
										 	<td><input type='checkbox'  name="<?php echo $chkMulti?>" id="<?php echo $chkMulti?>"></td> 
										 	<td><input type='text' class='form-control' name="<?php echo $txtMultiPoints?>" id="<?php echo $txtMultiPoints?>"></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</form>
					<?php
					}
					?>
				<!--........................... Media Questions.............................................. -->
					<?php
					if($questions->question_type == 'media_type')
					{
					?>
					<h4>Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>index.php/admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMedia' id='frmMedia' style="  border: 1px solid #ebebeb;
  padding: 15px 12px;
  border-radius: 3px;">
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo $questions->question_tag;?>" />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='media_type' />
							</div>
						</div><br><br><br>

						<div class="form-group">					
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-9">							
	                      		<textarea id="txtMediaQuestion" name="txtMediaQuestion" class="form-control" rows="6"/><?php echo $questions->question?></textarea>
							</div>
						</div><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control" value="<?php echo $questions->points;?>" required />
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-9">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
							</div>
						</div><br><br><br>

						<div class="form-group">				
							<label class="col-sm-3 control-label" for="question">Select Media</label>							
							<div class="col-sm-9">							
	                      		<input type='file' id="flMedia" name="flMedia" class="form-control" />
							</div>
						</div><br><br><br>
					
							<h4>Enter the option for above question</h4>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th> <th>Check corrected answer</th>
									</tr>
								</thead>
								<tbody>									
									<?php
									$i=1;
									$CI = & get_instance();
									$CI->load->model('questions_model');
									$regularData = $this->questions_model->getAnsOptions($questions->question_id);
									$countReg = count($regularData); 

									foreach($regularData as $regData)
									{
										$txtMediaOpt = 'txtMediaOpt'.$i;
										$chkMedia = 'chkMedia'.$i;										
										?>
										<tr>
										 	<td><?php echo $i;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMediaOpt?>" id="<?php echo $txtMediaOpt?>" value="<?php echo $regData['ans_option']?>"></td>
										 	<td><input type='checkbox'  name="<?php echo $chkMedia?>" id="<?php echo $chkMedia?>" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : '';?>></td> 
										</tr>
										<?php	
										$i++;									
									}

									for($j=$countReg+1;$j<=5;$j++)
									{
										$txtMediaOpt = 'txtMediaOpt'.$j;
										$chkMedia = 'chkMedia'.$j;
										?>
										<tr>
											<td><?php echo $j;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtMediaOpt?>" id="<?php echo $txtMediaOpt?>"></td>
										 	<td><input type='checkbox'  name="<?php echo $chkMedia?>" id="<?php echo $chkMedia?>"></td> 
										</tr>
										<?php
									}
									?>						
								</tbody>
							</table> 
						</form>
					<?php
					}
					?>	
		</div>	
	</div>
</div>
<?php
}
?>
<!-- new code start -->

<!-- new code end -->

<link rel="stylesheet" href="<?php echo base_url(); ?>/js/redactor/css/redactor.css" />

<script src="<?php echo base_url(); ?>/js/redactor/redactor.js"></script>

<script>
$(document).ready(

 function()

 {

   //	$('#full_bio').redactor();

 }

 );

 </script>



<?php
/*if ($updType == 'edit'):
echo form_hidden('id',$user->id);
endif*/
?>

<style>
.hide{
    
    display:none;
}
</style>

<script>
$('#blah').hide();
$('#remove_id').hide();  
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#file_i").change(function(){
        if( $('#file_i').val()!=""){
            
            $('#remove_id').show();
            $('#blah').show('slow');
            $('#imgname').hide('slow');
      }
        else{ $('#remove_id').hide();$('#blah').hide('slow');}
        readURL(this);
    });

  
    $('#remove_id').click(function(){
          $('#file_i').val('');
          $(this).hide();
          $('#blah').hide('slow');
		  $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
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