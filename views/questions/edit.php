<?php
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('logged_in');
	$maccessarr=$this->session->userdata('maccessarr');
	//print_r($maccessarr);
?>
<script>
function saveorder(n, task) 
{
    //alert(n);
	checkAll_button(n, task);
}
function checkAll_button(n, task) 
{
	if (!task) {
		task = 'saveorder';
	}
    document.orderform.submit();
}
</script>
<script>
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


<header>

<section class="breadcrumb">
<div class="container">

      <span class="page-title">
        <?php echo 'Edit Question';?>
      </span>

      <div class="bread-view">
	    <a href="http://create-online-academy.com/"><i class="entypo-home"></i></a>
	    <span class="ng-hide">/ </span>
	    <a href="#"><?php echo 'Edit Question';?></a>
	</div>

</div>
</section>

</header>

<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box;">
<?php
  $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?>   

<div class="main-content">
	<div class="row">

<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0;margin-left: 20px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<div class="clr"></div>

<div id="sticky-anchor"></div>
<div id="sticky">
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>


<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
echo form_open_multipart('questions/',$attributes)
?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<div class="clear"></div>
<?php echo form_close(); ?>	
<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ new code start @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
	<?php
foreach($questions as $questions)
{
?>
<!--<h2>Edit Question</h2>-->
<div class="row">
	<div class="col-md-12">		
		<div class="panel panel-primary" data-collapsed="0">
<!-- ........................... Regular.............................................. -->
				<?php
				if($questions->question_type == 'regular')
				{
				?>							
					<form action="<?php echo base_url();?>questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmRegular' id='frmRegular'>

					<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h3 style="margin-top: 0;">Question Type : <?php echo ucfirst($questions->question_type);?></h3>
						</div>
						<div  class="panel-options">
							<input style="margin-top:8px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
						</div>  
					</div>
					<hr style="margin-bottom:0px;">

					<div class="panel-body form-horizontal form-groups-bordered"> 
<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" value="<?php echo $questions->question_tag;?>" class="form-control"  />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-tag" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_tag');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='regular' />
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtQuestion" name="txtQuestion" class="form-control" rows="6" required  READONLY/><?php echo $questions->question;?></textarea>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que" class="tooltipicon" title="Click Here"></span>

						<span class="que  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_line');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Marks</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtPoints" name="txtPoints" value="<?php echo $questions->points?>" class="form-control" READONLY/>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-score" class="tooltipicon" title="Click Here"></span>

						<span class="que-score  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_score');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-instruct" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_instructions');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
					</div>


					<div style="clear:both"></div>
						<div class="panel-heading"> 
							<div class="panel-title" style="padding-bottom: 5px;">
								<h3 style="margin-bottom: 0;">Enter the option for above question</h3>
							</div> 
						</div>
				
						<div class="panel-body with-table">

							<table class="table table-bordered table-responsive">
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
										 	<td><input type='checkbox' name="<?php echo $chkReg?>" id="chkReg" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : ''; ?> onclick="return false" ></td> 
										</tr>
										<?php	
										$i++;									
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

					<form action="<?php echo base_url();?>questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMatch' id='frmMatch'>
					<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h3 style="margin-top: 0;">Question Type : <?php echo ucfirst($questions->question_type);?></h3>
							<p style="margin-bottom: 0px;"></p>
						</div>
						<div  class="panel-options">
							<input style="margin-top:8px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
						</div>  
					</div>
					<hr style="margin-bottom:0px;">

					<div class="panel-body form-horizontal form-groups-bordered"> 

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" value="<?php echo $questions->question_tag;?>" class="form-control"  />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-tag1" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_tag');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='match_the_pair' />
							</div>
						</div>
						
						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions?>" class="form-control" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-instruct1" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_instructions');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
					</div>

					<div style="clear:both"></div>
						<div class="panel-heading"> 
							<div class="panel-title" style="padding-bottom: 5px;">
								<h3 style="margin-bottom: 0;">Match the pairs</h3>
							</div> 
						</div>
						<div id='errorROptions'></div> 
						<div class="panel-body with-table">
<p style="color:red">Please note You can edit the Question, instruction and answers. But you cannot add or remove options because it may result in change of the Score of this type of question.</p>
							<table class="table table-bordered table-responsive">
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
										 	<td><input type='text' class='form-control' name="<?php echo $txtMatchpoints?>" id="<?php echo $txtMatchpoints?>" value="<?php echo $regData['points']?>" readonly></td>
										</tr>
										<?php	
										$i++;									
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

	
						<form action="<?php echo base_url();?>questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmTrueFalse' id='frmTrueFalse'>
						

						<div class="panel-heading">
							<div class="panel-title" style="padding-bottom: 0px;">	
								<h3 style="margin-top: 0;">Question Type : <?php echo ucfirst($questions->question_type);?></h3>
								<p style="margin-bottom: 0px;"></p>
							</div>
							<div  class="panel-options">
								<input style="margin-top:8px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
								<a href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
							</div>  
						</div>
						<hr style="margin-bottom:0px;">

						<div class="panel-body form-horizontal form-groups-bordered"> 

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo $questions->question_tag;?>"  />
	                      		
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-tag2" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag2  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_tag');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='true_false' />
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtTFQuestion"  name="txtTFQuestion" class="form-control" rows="6" required readonly /><?php echo $questions->question;?></textarea>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que2" class="tooltipicon" title="Click Here"></span>

						<span class="que2  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_line');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-instruct3" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct3  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_instructions');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Marks</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtTFPoints" name="txtTFPoints" class="form-control" value="<?php echo $questions->points;?>" readonly />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-score3" class="tooltipicon" title="Click Here"></span>

						<span class="que-score3  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_score');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Select correct Answer</label>							
							<div class="col-sm-5">							
	                      		<input type='radio' name="rbTrueFalse" value='True' <?php echo ($questions->is_correct_answer == 'True') ? 'checked' : '';?> required onclick="return false" >  True
	                      		<input type='radio' name="rbTrueFalse" value='False' <?php echo ($questions->is_correct_answer == 'False') ? 'checked' : '';?> required onclick="return false" >  False
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-correct3" class="tooltipicon" title="Click Here"></span>

						<span class="que-correct3  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_correct');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

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
					<h4>Question Type : <?php echo ucfirst($questions->question_type);?></h4>	
						<form action="<?php echo base_url();?>questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmsubjective' id='frmsubjective'>
						<div class="form-group" style="text-align:right;">		
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
							<a href="<?php echo base_url();?>index.php/questions/" class="btn btn-red"><span class="icon-32-cancel"></span>Cancel</a>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-7">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo $questions->question_tag;?>" required />
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='subjective' />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

								<span type="text" id="que-tag4" class="tooltipicon" title="Click Here"></span>

								<span class="que-tag4  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								<!--tip containt-->	

								<?php echo lang('que_tag');?>

								<!--/tip containt-->

								</span>

								</span>
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question for subjective</label>							
							<div class="col-sm-7">							
	                      		<textarea id="txtSubjective" name="txtSubjective" readonly class="form-control" rows="6" required /><?php echo $questions->question;?></textarea>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

								<span type="text" id="que-multiple" class="tooltipicon" title="Click Here"></span>

								<span class="que-multiple  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								<!--tip containt-->	

								<?php echo lang('que_line');?>

								<!--/tip containt-->

								</span>

								</span>
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div><br><br><br><br><br><br><br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-7">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" value="<?php echo $questions->instructions;?>" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

								<span type="text" id="que-instruct5" class="tooltipicon" title="Click Here"></span>

								<span class="que-instruct5  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								<!--tip containt-->	

								<?php echo lang('que_instructions');?>

								<!--/tip containt-->

								</span>

								</span>
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>	<br><br><br>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-7">							
	                      		<input type='text' id="txtPoints" name="txtPoints" readonly class="form-control" value="<?php echo $questions->points;?>" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

								<span type="text" id="que-score3" class="tooltipicon" title="Click Here"></span>

								<span class="que-score3  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span>

								<!--tip containt-->	

								<?php echo lang('que_score');?>

								<!--/tip containt-->

								</span>

								</span>
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>	<br><br><br>				
					</form>
					</div>
				<?php
				}
				?>

				<!--........................... Fill in the blanks.............................................. -->
				<!--........................... Multiple Type.............................................. -->
					<?php
					if($questions->question_type == 'multiple_type')
					{
					?>

					<form action="<?php echo base_url();?>questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMultiple' id='frmMultiple'>
					<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h3 style="margin-top: 0;">Question Type : <?php echo ucfirst($questions->question_type);?></h3>

						</div>
						<div  class="panel-options">
							<input style="margin-top:8px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
						</div>  
					</div>
					<hr style="margin-bottom:0px;">

					<div class="panel-body form-horizontal form-groups-bordered"> 

					<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo $questions->question_tag;?>" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-tag4" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag4  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_tag');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='multiple_type' />
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question for multiple answers</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtMTQuestion" name="txtMTQuestion" class="form-control" rows="6" required readonly /><?php echo $questions->question;?></textarea>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-multiple" class="tooltipicon" title="Click Here"></span>

						<span class="que-multiple  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_line');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-instruct5" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct5  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_instructions');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

					</div>

					<div style="clear:both"></div>
					<div class="panel-heading"> 
						<div class="panel-title" style="padding-bottom: 5px;">
							<h3 style="margin-bottom: 0;">Enter the option for above question</h3>
						</div> 
					</div>
					<div class="panel-body with-table">
						<p style="color:red">Please note You can edit the Question, instruction and answers. But you cannot add or remove options because it may result in change of the Score of this type of question.</p>
						<table class="table table-bordered table-responsive">
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
										 	<td><input type='checkbox'  name="<?php echo $chkMulti?>" id="<?php echo $chkMulti?>" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : '';?> ></td> 
										 	<td><input type='text' class='form-control' name="<?php echo $txtMultiPoints?>" id="<?php echo $txtMultiPoints?>" value="<?php echo $regData['points']?>" readonly></td>
										</tr>
										<?php	
										$i++;									
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

					<form action="<?php echo base_url();?>questions/edit/<?php echo $questions->question_id;?>/" method='post' name='frmMedia' id='frmMedia'  enctype="multipart/form-data">

					<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h3 style="margin-top: 0;">Question Type : <?php echo ucfirst($questions->question_type);?></h3>
							<p style="margin-bottom: 0px;"></p>
						</div>
						<div  class="panel-options">
							<input style="margin-top:8px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
						</div>  
					</div>
					<hr style="margin-bottom:0px;">

					<div class="panel-body form-horizontal form-groups-bordered"> 

					<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo $questions->question_tag;?>"  />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-tag6" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_tag');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='media_type' />
							</div>
						</div>

						<div class="form-group">					
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtMediaQuestion" name="txtMediaQuestion" class="form-control" rows="6" required readonly /><?php echo $questions->question?></textarea>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que6" class="tooltipicon" title="Click Here"></span>

						<span class="que6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_line');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Marks</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control" value="<?php echo $questions->points;?>" required readonly />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-score6" class="tooltipicon" title="Click Here"></span>

						<span class="que-score6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_score');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" value="<?php echo $questions->instructions;?>" class="form-control" />
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-instruct6" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_instructions');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">				
							<label class="col-sm-3 control-label" for="question">Select Media</label>							
							<div class="col-sm-5">							
	                      		<!--<input type='file' id="flMedia" name="flMedia" class="form-control" />-->
	                      		<input type='file' id="file_i" name="file_i" class="form-control" required/>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-media" class="tooltipicon" title="Click Here"></span>

						<span class="que-media  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_media');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

					</div>
					<div style="clear:both"></div>
					<div class="panel-heading"> 
						<div class="panel-title" style="padding-bottom: 5px;">
							<h3 style="margin-bottom: 0;">Enter the option for above question</h3>
						</div> 
					</div>
					<div id='errorROptions'></div> 
					<div class="panel-body with-table">

						<table class="table table-bordered table-responsive">
								<thead>
									<tr>
										<th>#</th> 
										<th>Options</th> 
										<th>Check corrected answer</th>
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
										 	<td><input type='checkbox'  name="<?php echo $chkMedia?>" id="chkMedia" <?php echo ($regData['is_correct_answer'] == '1') ? 'checked' : '';?> onclick="return false" ></td> 
										</tr>
										<?php	
										$i++;									
									}									
									?>						
								</tbody>
						</table> 	 
					</div> 					
					</form>
					<?php
					}
					?>
					<!--........................... Media Questions End.............................................. -->
				</div>
				</div>	
				</div>
	<?php
}
?>
				


<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ new code End @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->



<div class="containerpg">

<div class="pagination">
    <?php echo $this->pagination->create_links();  ?>
</div>
</div>
</div>    
</div> 
</div>
</div> 
</div>
<div class="clr"></div>

<!--
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
</script>-->

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
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
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