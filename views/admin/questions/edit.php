<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script>
$(function() {    $( document ).tooltip();  });
</script>

<?php
foreach($questions as $questions)
{
?>
<div class="main-container">
<div class="main_title"><h2>Edit Question</h2></div>
<div class="field_container">
<div class="row">
	<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
		<div>		
				<!--<ul class="nav nav-tabs bordered">
					<li class="active"><a href="#regular" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Regular</span></a></li> 
					<li> <a href="#matchthepair" data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Match The Pair</span></a></li>
					<li> <a href="#truefalse" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">True/False</span></a></li> 
					<li> <a href="#multipletype" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Multiple Type</span></a></li>
					<li> <a href="#mediaquestion" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Media Question</span></a></li>
				</ul>-->
				<div class="tab-content form-body"> 
			<!-- ........................... Regular.............................................. -->
				<?php
				if($questions->question_type == 'regular')
				{
				?>			
				<h4 class="col-sm-12 field-title" style="font-size:15px;">Question Type : <?php echo ucfirst($questions->question_type);?></h4>					
					<form action="<?php echo base_url();?>admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmRegular' id='frmRegular'>
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align: right;margin-right: 15px;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag
								<p>(Put a relavent keyword for better searchability during the selection of the question for the exam paper.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" value="<?php echo $questions->question_tag;?>" class="form-control form-height"  />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_tag');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='regular' />
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question</label>							
							<div class="col-sm-12">							
	                      		<textarea id="txtQuestion" name="txtQuestion" class="form-control select-box-border" rows="6" required /><?php echo $questions->question;?></textarea>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que" class="tooltipicon" title="Click Here"></span>

						<span class="que  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_line');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="points">Enter Score
								<p>(The Marks which this question would carry.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtPoints" name="txtPoints" value="<?php echo $questions->points?>" class="form-control form-height" required />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-score" class="tooltipicon" title="Click Here"></span>

						<span class="que-score  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_score');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction
								<p>(Put some relevant instruction for examinees,if necessary)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control form-height" />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-instruct" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_instructions');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="col-sm-12 form-group form-border" style="padding-top: 2%!important;">						
						  <div class="grey-background">	
							<label class="col-sm-2 no-padding" for="pool">In Question Pool</label>							
														
	                      		<input type='checkbox' id="chkInpool" name="chkInpool" <?php echo ($questions->in_questions_pool = '1') ? 'checked' : '';?> />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-pool" class="tooltipicon" title="Click Here"></span>

						<span class="que-pool  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

							

						<?php echo lang('que_pool');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->

							
							</div>
						</div>
					
						<p style="font-size:15px;padding-top:3%;padding-top:1.5%;padding-left:15px;font-family:'AvenirNextLTPro-Regular';">Enter the option for above question</p>
							<div class="main-table">
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-option" class="tooltipicon" title="Click Here"></span>

						<span class="que-option  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('que_option');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Check corrected answer
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-correct" class="tooltipicon" title="Click Here"></span>

						<span class="que-correct  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_correct');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
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
										 	<td><input type='checkbox' name="<?php echo $chkReg?>" id="chkReg" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : ''; ?> ></td> 
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
										 	<td><input type='checkbox' name="<?php echo $chkReg?>" id="chkReg"></td> 
										</tr>
										<?php
									}
									?>
								</tbody>
							</table> 
							</div>
						</form>					
					<?php
					}
					?>

				<!--........................... Match the pairs.............................................. -->
					<?php
					if($questions->question_type == 'match_the_pair')
					{
					?>
					<h4 class="col-sm-12 field-title" style="font-size:15px;">Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMatch' id='frmMatch'>
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align: right;margin-right: 15px;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" value="<?php echo $questions->question_tag;?>" class="form-control form-height" required />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag1" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>
 -->
						<!--tip containt-->	

						<!-- <div><?php echo lang('que_tag');?></div> -->

						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='match_the_pair' />
							</div>
						</div>
						
						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions?>" class="form-control form-height" />
							
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-instruct1" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span> -->

						<!--tip containt-->	

						<!-- <div><?php echo lang('que_instructions');?></div> -->

						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
						<div class="col-sm-12 form-group form-border" style="padding-top: 2%!important;">						
						  <div class="grey-background">						
							<label class="col-sm-2 no-padding control-label" for="pool">In Question Pool</label>							
								<input type='checkbox' id="chkInpool" name="chkInpool"  <?php echo ($questions->in_questions_pool = '1') ? 'checked' : '';?> />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-pool1" class="tooltipicon" title="Click Here"></span>

						<span class="que-pool1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span> -->

						<!--tip containt-->	

						<!-- <div><?php echo lang('que_pool');?></div> -->

						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->

							</div>
						</div>
					
						<h4 class="col-sm-12 field-title" style="font-size:15px;padding-top:3%;">Match the pairs</h4>
						<div class="main-table">
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Questions
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que1" class="tooltipicon" title="Click Here"></span>

						<span class="que1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span> -->

						<!--tip containt-->	

						<!-- <div><?php echo lang('que_line');?></div> -->

						<!--/tip containt-->
<!-- 
						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Matching pairs (Answers)
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-pairs" class="tooltipicon" title="Click Here"></span>

						<span class="que-pairs  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span> -->

						<!--tip containt-->	

						<!-- <div><?php echo lang('que_pairs');?></div> -->

						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Score
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-score1" class="tooltipicon" title="Click Here"></span>

						<span class="que-score1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>
 -->
						<!--tip containt-->	

						<!-- <div><?php echo lang('que_score');?></div> -->

						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
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
							</div>		
						</form>				
				    <?php
					}
					?>

				<!--........................... True False.............................................. -->
					<?php
					if($questions->question_type == 'true_false')
					{
					?>
					<h4 class="col-sm-12 field-title" style="font-size:15px;">Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmTrueFalse' id='frmTrueFalse'>
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align: right;margin-right: 15px;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height" value="<?php echo $questions->question_tag;?>" required />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag2" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag2  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_tag');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='true_false' />
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question</label>							
							<div class="col-sm-12">							
	                      		<textarea id="txtTFQuestion"  name="txtTFQuestion" class="form-control select-box-border" rows="6" required/><?php echo $questions->question;?></textarea>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que2" class="tooltipicon" title="Click Here"></span>

						<span class="que2  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_line');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control form-height" />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-instruct3" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct3  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_instructions');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="points">Enter Score</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtTFPoints" name="txtTFPoints" class="form-control form-height" value="<?php echo $questions->points;?>" required/>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-score3" class="tooltipicon" title="Click Here"></span>

						<span class="que-score3  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_score');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="col-sm-12 form-group form-border" style="padding-top: 2%!important;">
						  <div class="grey-background">							
							<label class="col-sm-3 no-padding control-label" for="question">Select correct Answer</label>							
														
	                      		<input type='radio' name="rbTrueFalse" value='True' <?php echo ($questions->is_correct_answer == 'True') ? 'checked' : '';?> required>  True
	                      		<input type='radio' name="rbTrueFalse" value='False' <?php echo ($questions->is_correct_answer == 'False') ? 'checked' : '';?> required>  False
							
						</div>
						</form>			
					<?php
					}
					?>

				<!--........................... Subjective.............................................. -->
				<?php
				if($questions->question_type == 'subjective')
				{
				?>
					<h4 class="col-sm-12 field-title" style="font-size:15px;">Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmsubjective' id='frmsubjective'>
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align: right;margin-right: 15px;">		
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"></span>Cancel</a>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height" value="<?php echo $questions->question_tag;?>" required />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='subjective' />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

								<span type="text" id="que-tag4" class="tooltipicon" title="Click Here"></span>

								<span class="que-tag4  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								

								<?php echo lang('que_tag');?>

								

								</span>

								</span> -->
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question for subjective</label>							
							<div class="col-sm-12">							
	                      		<textarea id="txtSubjective"  name="txtSubjective"  class="form-control" rows="6" required /><?php echo $questions->question;?></textarea>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

								<span type="text" id="que-multiple" class="tooltipicon" title="Click Here"></span>

								<span class="que-multiple  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								

								<?php echo lang('que_line');?>

								

								</span>

								</span> -->
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control form-height" value="<?php echo $questions->instructions;?>" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

								<span type="text" id="que-instruct5" class="tooltipicon" title="Click Here"></span>

								<span class="que-instruct5  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								

								<?php echo lang('que_instructions');?>

								

								</span>

								</span> -->
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="points">Enter Score</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control form-height" value="<?php echo $questions->points;?>" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

								<span type="text" id="que-score3" class="tooltipicon" title="Click Here"></span>

								<span class="que-score3  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								

								<?php echo lang('que_score');?>

							

								</span>

								</span> -->
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>			
					</form>
					</div>
				<?php
				}
				?>

				<!--........................... Multiple Type.............................................. -->
					<?php
					if($questions->question_type == 'multiple_type')
					{
					?>
					<h4 class="col-sm-12 field-title" style="font-size:15px;">Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMultiple' id='frmMultiple'>
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align: right;margin-right: 15px;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height" value="<?php echo $questions->question_tag;?>" required />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag4" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag4  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('que_tag');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='multiple_type' />
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question for multiple answers</label>							
							<div class="col-sm-12">							
	                      		<textarea id="txtMTQuestion" name="txtMTQuestion" class="form-control select-box-border" rows="6" required/><?php echo $questions->question;?></textarea>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-multiple" class="tooltipicon" title="Click Here"></span>

						<span class="que-multiple  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_line');?>

						
						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control form-height" />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-instruct5" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct5  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_instructions');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
						<h4 class="col-sm-12 field-title" style="font-size:15px;padding-top:3%">Enter the option for above question</h4>
							<div class="main-table">
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options
											<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-option5" class="tooltipicon" title="Click Here"></span>

						<span class="que-option5  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_option');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Check corrected answer
											<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-correct5" class="tooltipicon" title="Click Here"></span>

						<span class="que-correct5  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_correct');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Score
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-score5" class="tooltipicon" title="Click Here"></span>

						<span class="que-score5  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('que_score');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
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
										 	<td><input type='text' class='form-control' name="<?php echo $txtMultiOpt?>" id="<?php echo $txtMultiOpt?>"></td>
										 	<td><input type='checkbox'  name="<?php echo $chkMulti?>" id="<?php echo $chkMulti?>"></td> 
										 	<td><input type='text' class='form-control' name="<?php echo $txtMultiPoints?>" id="<?php echo $txtMultiPoints?>"></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
							</div>
						</form>
					<?php
					}
					?>
				<!--........................... Media Questions.............................................. -->
					<?php
					if($questions->question_type == 'media_type')
					{
					?>
					<h4 class="col-sm-12 field-title" style="font-size:15px;">Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form enctype="multipart/form-data" action="<?php echo base_url();?>admin/questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMedia' id='frmMedia'>
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align: right;margin-right: 15px;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>index.php/admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height" value="<?php echo $questions->question_tag;?>" required/>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag6" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_tag');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='media_type' />
							</div>
						</div>

						<div class="form-group form-border">					
							<label class="col-sm-12 control-label field-title" for="question">Enter Question</label>							
							<div class="col-sm-12">							
	                      		<textarea id="txtMediaQuestion" name="txtMediaQuestion" class="form-control select-box-border" rows="6" required/><?php echo $questions->question?></textarea>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que6" class="tooltipicon" title="Click Here"></span>

						<span class="que6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_line');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="points">Enter Score</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control form-height" value="<?php echo $questions->points;?>" required />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-score6" class="tooltipicon" title="Click Here"></span>

						<span class="que-score6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_score');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control form-height" />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-instruct6" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_instructions');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
						<input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $questions->attachment_url;?>" name="imagename" id="imagename">
						<div class="form-group form-border">				
							<label class="col-sm-12 field-title control-label" for="question">Select Media</label>							
							<div class="col-sm-12">							
	                      		<input type='file' id="file_i" name="file_i" class="form-control" style="border: none;  padding-left: 0;" required/>
                                
                                 	
                             
	                      		 <embed src="<?php echo base_url() ?>public/uploads/questions/<?php echo $questions->attachment_url;?>" autostart="false" loop="false" height="130" width="200"></embed>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-media" class="tooltipicon" title="Click Here"></span>

						<span class="que-media  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_media');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
					
							<h4 class="col-sm-12 field-title" style="font-size:15px;padding-top:3%">Enter the option for above question</h4>
							<div class="main-table">
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-option6" class="tooltipicon" title="Click Here"></span>

						<span class="que-option6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_option');?>
						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Check corrected answer
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-correct6" class="tooltipicon" title="Click Here"></span>

						<span class="que-correct6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_correct');?>

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
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
										 	<td><input type='checkbox'  name="<?php echo $chkMedia?>" id="chkMedia" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : '';?>></td> 
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
										 	<td><input type='checkbox'  name="<?php echo $chkMedia?>" id="chkMedia"></td> 
										</tr>
										<?php
									}
									?>						
								</tbody>
							</table>
							</div> 
						</form>
					<?php
					}
					?>	
		</div>	
	</div>
</div>
</div>
</div>
</div>
<?php
}
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />

<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>

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

<script>
$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[id='" + $box.attr("id") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>

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

<script src='<?php echo base_url(); ?>public/js/tinymce/tinymce.min.js'></script>
  <script>
   tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
readonly : "readonly",
selector : "#txtSubjective"
});
</script> 