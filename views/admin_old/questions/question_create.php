<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<link rel="stylesheet" type="text/css" href="/public/css/category_css/category.css"> 
<style type="text/css">
	
	#sticky1.stick1 {
 position: fixed;
 top: 0;
 z-index: 10000;
 border-radius: 0 0 0 10px;
 right: 0;
 padding: 10px 20px 15px 20px;
 background: rgba(228, 228, 228, 0.86);
}
#sticky2.stick2 {
 position: fixed;
 top: 0;
 z-index: 10000;
 border-radius: 0 0 0 10px;
 right: 0;
 padding: 10px 20px 15px 20px;
 background: rgba(228, 228, 228, 0.86);
}
#sticky3.stick3 {
 position: fixed;
 top: 0;
 z-index: 10000;
 border-radius: 0 0 0 10px;
 right: 0;
 padding: 10px 20px 15px 20px;
 background: rgba(228, 228, 228, 0.86);
}
#sticky4.stick4 {
 position: fixed;
 top: 0;
 z-index: 10000;
 border-radius: 0 0 0 10px;
 right: 0;
 padding: 10px 20px 15px 20px;
 background: rgba(228, 228, 228, 0.86);
}
#sticky5.stick5 {
 position: fixed;
 top: 0;
 z-index: 10000;
 border-radius: 0 0 0 10px;
 right: 0;
 padding: 10px 20px 15px 20px;
 background: rgba(228, 228, 228, 0.86);
}
</style>
<script type="text/javascript">
	jQuery(document).ready(function() {
	   jQuery('#add_button').click(function() {
	  
	     jQuery('#desig_field,#details_field').toggle();
	   
	   });	
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('#group_id').on('change',function() {
	   
		 var indexid = jQuery("#group_id").val();
		 
		 if(indexid == 2)
		 {
	      jQuery('#payment_field').css("display","block"); 
		  
		  jQuery('#payment_mode').on('change',function() {
		     
	      var pay_val = jQuery("#payment_mode").val();
		  
		  if(pay_val == "salary" || pay_val == "percent")
		  {
		  
		  jQuery('#payment_type').css("display","block");
		  
		  }
		  else {
		     jQuery('#payment_type').css("display","none");
		  }
		  
		  } );
		 }
		 else{
		   
		   jQuery('#payment_field').css("display","none");
		 }
	   
	   });
	});
</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
 	$(function() {    $( document ).tooltip();  });
</script>
<div class="main-container">
<?php
//$attributes = array('class' => 'tform', 'id' => '');
//echo ($updType == 'create') ? form_open_multipart(base_url().'admin/questions/create', $attributes) : form_open_multipart(base_url().'admin/questions/edit/'.$id, $attributes);
?>

<div class="col-sm-12" style="padding:0;"><h2><?php echo (($updType == 'edit')?'Edit Question':'Create Question');?></h2></div>

<div class="field_container">
<div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
<div class="main_subtitle">
	<p>Choose the type of the Question you with to create from the below tabs</p>
</div>

	<div class="col-md-12" style="padding:0;">
	    <select onchange="dispTab(this.value)" style="width: 50%" class="form-control form-height" name="q_type" id="q_type">
			<option value="regular">Regular</option>
        	<option value="matching">Match The Pair</option>
        	<option value="truefalse">True/False</option>
        	<option value="subjective">Subjective</option>
        	<option value="mcq">Multiple Type</option>
        	<option value="mediaq">Media Question</option>
		</select>
		<div>		
				<ul class="nav nav-tabs bordered" >
					<!--<li class="active" id="regul"><a   data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Regular</span></a></li> 
					<li id="matching" > <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Match The Pair</span></a></li>
					<li id="tf"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">True/False</span></a></li> 
					<li id="sub"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Subjective</span></a></li>
					<li id="mcq"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Multiple Type</span></a></li>
					<li id="mediaq"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Media Question</span></a></li>-->
				</ul>

				<div class="tab-content form-body"> 
					<!-- ........................... Regular.............................................. -->
					<div class="tab-pane active" id="regular">
					<div class="col-sm-7 field-title" style="font-size:21px">
						<h3>Regular</h3>
						<p>(This would be a Multiple choice question having only one correct answer.)</p>
					</div>
					<!-- <div class="col-sm-5" style="margin-top:17px;">
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div> -->
					<form action="<?php echo base_url();?>admin/questions/create" method='post' name='frmRegular' id='frmRegular' onsubmit='return regularSubmit();'>
						<div class="col-sm-5" style="margin-top:17px;">
						<div id="sticky-anchor"></div>
						<div id="sticky" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag
								<p>(Put a relavent keyword for better searchability during the selection of the question for the exam paper.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height"  />
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
	                      		<textarea id="txtQuestion" name="txtQuestion" class="form-control select-box-border" rows="6" required ></textarea>
	                      		<div id='errorRQuestion'></div>
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

						<!-- <div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="points">Enter Score
							<p>(The Marks which this question would carry)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control form-height" onkeypress="return isNumberKey(event)" required /> 
	                      		<div id='errorRPoints'></div>
	                      		
							</div>
							
						</div> -->

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction
								<p>(Put some relevant instruction for examinees,if necessary)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control form-height" />
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
											
						<p style="font-size:15px;padding-top:1.5%;padding-left:15px;font-family:'AvenirNextLTPro-Regular';">Enter the option for above question</p>
						<div id='errorROptions'></div>
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
										</th>
										<th>Check corrected answer
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
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt1' id='txtRegOpt1' required /></td>
									 	<td><input type='checkbox' name='chkReg1' id='chkReg1' > </td> 
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt2' id='txtRegOpt2' required /></td>
									 	<td><input type='checkbox' name='chkReg2' id='chkReg2' /></td> 
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt3' id='txtRegOpt3' ></td>
									 	<td><input type='checkbox' name='chkReg3' id='chkReg3' /></td> 
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt4' id='txtRegOpt4' ></td>
									 	<td><input type='checkbox' name='chkReg4' id='chkReg4'></td> 
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class='form-control' name='txtRegOpt5' id='txtRegOpt5' ></td>
									 	<td><input type='checkbox' name='chkReg5' id='chkReg5'></td> 
									</tr>
								</tbody>
							</table> 
						  </div>
						</form>						
					</div>

					<!--........................... Match the pairs.............................................. -->
					<div class="tab-pane " id="matchthepair">
					  <div class="col-sm-7 field-title" style="font-size:21px">
						<h3>Match the Pair</h3>
						<p class="pquestionsub">(This would be a set of maximum ten pairs of items which the examinees needs to match as per the relevance.)</p>
					  </div>
					  <!-- <div class="col-sm-5" style="margin-top:17px;">
					  	<div id="sticky-anchor1"></div>
						<div id="sticky1" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					  </div> -->

						<form action="<?php echo base_url();?>admin/questions/create" method='post' name='frmMatch' id='frmMatch' onsubmit='return matchThePairSubmit()'>
						<div class="col-sm-5" style="margin-top:17px;">
					  	<div id="sticky-anchor1"></div>
						<div id="sticky1" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					  </div>
						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag
								<p>(Put a relavent keyword for better searchability during the selection of the question for the exam paper)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height"  />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag1" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_tag');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='match_the_pair' />
							</div>
							
						</div>
						
						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction
							<p>(Put some relevant instruction for examinees,if necessary)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control form-height" />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						 <span type="text" id="que-instruct1" class="tooltipicon" title="Click Here"></span>

						<span class="que-instruct1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_instructions');?>

						

						</span>

						</span>  -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							
						</div>

						<p style="font-size:15px;padding-top:1.5%;padding-left:15px;font-family:'AvenirNextLTPro-Regular';">Match the pairs</p>
						<div id='errorMctOptions'></div>
						<div class="main-table">
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Questions
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que1" class="tooltipicon" title="Click Here"></span>

						<span class="que1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_line');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
										 <th>Matching pairs (Answers)
										 	<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-pairs" class="tooltipicon" title="Click Here"></span>

						<span class="que-pairs  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_pairs');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										 </th> <th>Score (The Marks which this question would carry.)</p>
										 <!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-score1" class="tooltipicon" title="Click Here"></span>

						<span class="que-score1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('que_score');?>

						

						</span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
						
										 </th>
									</tr>
								</thead>
								<tbody>
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class='form-control' name='txtMatchque1' id='txtMatchque1' required onblur='addAtributeRequired(1)' /></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair1' id='txtMatchpair1' /></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints1' id='txtMatchpoints1' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class='form-control' name='txtMatchque2' id='txtMatchque2' required onblur='addAtributeRequired(2)'/></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair2' id='txtMatchpair2' /></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints2' id='txtMatchpoints2' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class='form-control' name='txtMatchque3' id='txtMatchque3' onblur='addAtributeRequired(3)'/></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair3' id='txtMatchpair3' /></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints3' id='txtMatchpoints3' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class='form-control' name='txtMatchque4' id='txtMatchque4' onblur='addAtributeRequired(4)'/></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair4' id='txtMatchpair4' /></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints4' id='txtMatchpoints4' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class='form-control' name='txtMatchque5' id='txtMatchque5' onblur='addAtributeRequired(5)'/></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair5' id='txtMatchpair5' /></td> 
									 	<td><input type='text' class='form-control' name='txtMatchpoints5' id='txtMatchpoints5' onkeypress="return isNumberKey(event)" /></td>
									</tr>
								</tbody>
							</table> 
							</div>		
						</form>				
				    </div> 

				    <!--........................... True False.............................................. -->
					<div class="tab-pane" id="truefalse"> 
					  <div class="col-sm-7 field-title" style="font-size:21px">
						<h3>True or False</h3>
						<p>(This would be a question where the examinees would have to select either True or False as the answer.)</p>
					  </div>
					  <!-- <div class="col-sm-5" style="margin-top:17px;">
					  	<div id="sticky-anchor2"></div>
						<div id="sticky2" class="form-group field-sticky" style="text-align: right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					  </div> -->
						<form action="<?php echo base_url();?>admin/questions/create" method='post' name='frmTrueFalse' id='frmTrueFalse' onsubmit='return truefalseSubmit()'>
						<div class="col-sm-5" style="margin-top:17px;">
					  	<div id="sticky-anchor2"></div>
						<div id="sticky2" class="form-group field-sticky" style="text-align: right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					  </div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag
								<p>(Put a relavent keyword for better searchability during the selection of the question for the exam paper)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height"  />
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
	                      		<textarea id="txtTFQuestion"  name="txtTFQuestion"  class="form-control select-box-border" rows="6" required /></textarea>
	                      		<div id='errorTFQuestion'></div>
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
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction
								<p>(Put some relevant instruction for examinees,if necessary)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control form-height" />

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
							<label class="col-sm-12 control-label field-title" for="points">Enter Score
								<p>(The Marks which this question would carry.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtTFPoints" name="txtTFPoints" class="form-control form-height" onkeypress="return isNumberKey(event)" required />
	                      		<div id='errorTFPoints'></div>
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
							<label class="col-sm-3 control-label field-title" for="question" style="padding-left:0px;">Select correct Answer</label>							
														
	                      		<input type='radio' name="rbTrueFalse" value='True' id='txtTrue' required />  True
	                      		<input style="margin-left:4%;" type='radio' name="rbTrueFalse" value='False' id='txtFalse' required />  False
	                      		<div id='errorTFAnswer'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
		                      		<!-- <span class="tooltipcontainer">
									<span type="text" id="que-correct3" class="tooltipicon" title="Click Here"></span>
									<span class="que-correct3  tooltargetdiv" style="display: none;" >
									<span class="closetooltip"></span>
										
									<?php echo lang('que_correct');?>
									
									</span>
									</span> -->
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							
						</div>
						</div>
						</form>			
					</div>

					<!--........................... subjective.............................................. -->
					<div class="tab-pane" id="subjective"> 
					  <div class="col-sm-7 field-title" style="font-size:21px">
					   	<h3>Subjective</h3>
					  </div>
					  <!-- <div class="col-sm-5">
					  	<div id="sticky-anchor3"></div>
						<div id="sticky3" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"></span>Cancel</a>
						</div>
					  </div> -->
						<form action="<?php echo base_url();?>admin/questions/create" method='post' name='frmsubjective' id='frmsubjective' onsubmit='return subjectiveSubmit()'>
						<div class="col-sm-5">
					  	<div id="sticky-anchor3"></div>
						<div id="sticky3" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"></span>Cancel</a>
						</div>
					  </div>

						<div class="form-group form-border" style="padding-top:0;">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag
								<p>(Put a relevant keyword for better searchability during the selection of the question for the exam paper.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height"  />
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
							<label class="col-sm-12 control-label field-title" for="question">Enter Question for subjective

							</label>							
							<div class="col-sm-12">							
	                      		<textarea id="txtSubjective"  name="txtSubjective"  class="form-control select-box-border" rows="6" /></textarea>
	                      		<input name="image" type="file" id="upload" class="hidden" onchange="">
	                      		<div id='errorSQuestion'></div>
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
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction
								<p>(Put some relevant instruction for examinees,if necessary.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control form-height" />
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
							<label class="col-sm-12 control-label field-title" for="points">Enter Score
								<p>(The Marks which this question would carry.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtPoints" name="txtPoints" class="form-control form-height" onkeypress="return isNumberKey(event)" required />
	                      		<div id='errorSPoints'></div>
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
						</form>
					</div>

					<!--........................... Multiple Type.............................................. -->
					<div class="tab-pane" id="multipletype"> 
					  <div class="col-sm-7 field-title" style="font-size:21px">
						<h3>Multiple Type</h3>
						<p>(This would be a multiple choice question having more than one correct answer.)</p>
					  </div>
					  <!-- <div class="col-sm-5" style="margin-top:17px;">
					  	<div id="sticky-anchor4"></div>
						<div id="sticky4" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					  </div> -->
						<form action="<?php echo base_url();?>admin/questions/create" method='post' name='frmMultiple' id='frmMultiple' onsubmit='return multipleTypeSubmit()'>
						<div class="col-sm-5" style="margin-top:17px;">
					  	<div id="sticky-anchor4"></div>
						<div id="sticky4" class="form-group field-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					  </div>

						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag
								<p>(Put a relevant keyword for better searchability during the selection of the question for the exam paper.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height"  />
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
	                      		<textarea id="txtMTQuestion" name="txtMTQuestion" class="form-control select-box-border" rows="6" required /></textarea>
	                      		<div id='errorMLTQuestion'></div>
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
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction
								<p>(Put some relevant instruction for examinees,if necessary.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control form-height" />
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
						<p style="font-size:15px;padding-top:1.5%;padding-left:15px;font-family:'AvenirNextLTPro-Regular';">
						Enter the option for above question</p>
						<div id='errorMLTOptions'></div>
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
										</th> <th>Score (The Marks which this question would carry)
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
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt1' id='txtMultiOpt1' required onblur='addAtributeRequiredMultiple(1)'></td>
									 	<td><input type='checkbox' name='chkMulti1' id='chkMulti1' ></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints1' id='txtMultiPoints1' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt2' id='txtMultiOpt2' required onblur='addAtributeRequiredMultiple(2)'></td>
									 	<td><input type='checkbox' name='chkMulti2' id='chkMulti2' ></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints2' id='txtMultiPoints2' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt3' id='txtMultiOpt3' onblur="addAtributeRequiredMultiple(3)"></td>
									 	<td><input type='checkbox' name='chkMulti3' id='chkMulti3' ></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints3' id='txtMultiPoints3' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt4' id='txtMultiOpt4' onblur="addAtributeRequiredMultiple(4)"></td>
									 	<td><input type='checkbox' name='chkMulti4' id='chkMulti4'></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints4' id='txtMultiPoints4' onkeypress="return isNumberKey(event)" /></td>
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class="form-control" name='txtMultiOpt5' id='txtMultiOpt5' onblur="addAtributeRequiredMultiple(5)"></td>
									 	<td><input type='checkbox' name='chkMulti5' id='chkMulti5'></td> 
									 	<td><input type='text' class="form-control" name='txtMultiPoints5' id='txtMultiPoints5' onkeypress="return isNumberKey(event)" /></td>
									</tr>
								</tbody>
							</table>
							</div>
						</form>
					</div>		

					<!--........................... Media Questions.............................................. -->
					<div class="tab-pane" id="mediaquestion">
					  <div class="col-sm-7 field-title" style="font-size:21px"> 
						<h3>Media Question</h3>
						<p>(This would be a multiple choice question having one correct answer and the question would consist of any video, image etc. With the texts.)</p>
					</div>
					<!-- <div class="col-sm-5" style="margin-top:17px;">
						<div id="sticky-anchor5"></div>
						<div id="sticky5" class="form-group main-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div> -->
						<form enctype="multipart/form-data" action="<?php echo base_url();?>admin/questions/create" method='post' name='frmMedia' id='frmMedia' onsubmit='return mediaTypeSubmit()'>
						
							<div class="col-sm-5" style="margin-top:17px;">
						<div id="sticky-anchor5"></div>
						<div id="sticky5" class="form-group main-sticky" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default btn-blue" value='Save & Back To List'>
							<a href="<?php echo base_url();?>admin/questions/" class="btn btn-red btn-dark-grey"><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
						<div class="form-group form-border">						
							<label class="col-sm-12 control-label field-title" for="question">Enter Question Tag
								<p>(Put a relevant keyword for better searchability during the selection of the question for the exam paper.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control form-height"  />
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
	                      		<textarea id="txtMediaQuestion" name="txtMediaQuestion" class="form-control select-box-border" rows="6" required /></textarea>
	                      		<div id='errorMedQuestion'></div>
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
							<label class="col-sm-12 control-label field-title" for="points">Enter Score
								<p>(The Marks which this question would carry.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtMedPoints" name="txtPoints" class="form-control form-height" onkeypress="return isNumberKey(event)" required />
	                      		<div id='errorMedPoints'></div>
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
							<label class="col-sm-12 control-label field-title" for="instruction">Instruction
								<p>(Put some relevant instruction for examinees,if necessary.)</p>
							</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control form-height" />
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
						<div class="form-group form-border">		
							<label class="col-sm-12 control-label field-title" for="question">Select Media</label>							
							<div class="col-sm-12">							
	                      		<input type='file' id="file_i" name="file_i" class="form-control form-height" required />

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
						
					
							<p style="font-size:15px;padding-top:1.5%;padding-left:15px;font-family:'AvenirNextLTPro-Regular';">Enter the option for above question</p>
							<div id='errorMedOptions'></div>
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
									<tr>
									 	<td>1</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt1' id='txtMediaOpt1' required></td>
									 	<td><input type='checkbox' name='chkMedia1' id='chkMedia1' ></td> 
									</tr>
									<tr>
									 	<td>2</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt2' id='txtMediaOpt2' required></td>
									 	<td><input type='checkbox' name='chkMedia2' id='chkMedia2' ></td> 
									</tr>
									<tr>
									 	<td>3</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt3' id='txtMediaOpt3'></td>
									 	<td><input type='checkbox' name='chkMedia3' id='chkMedia3'></td> 
									</tr>
									<tr>
									 	<td>4</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt4' id='txtMediaOpt4'></td>
									 	<td><input type='checkbox' name='chkMedia4' id='chkMedia4'></td> 
									</tr>
									<tr>
									 	<td>5</td>
									 	<td><input type='text' class="form-control" name='txtMediaOpt5' id='txtMediaOpt5'></td>
									 	<td><input type='checkbox' name='chkMedia5' id='chkMedia5'></td> 
									</tr>
								</tbody>
							</table> 
							</div>
						</form>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
</div>
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



<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$user->id); ?>

<?php endif ?>

<?php echo form_close(); ?>

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

//jQuery(document).ready(function(){
//
//	jQuery('.tooltipicon').click(function(){
//
//	var dispdiv = jQuery(this).attr('id');
//
//	jQuery('.'+dispdiv).css('display','inline-block');
//
//	});
//
//	jQuery('.closetooltip').click(function(){
//
//	jQuery(this).parent().css('display','none');
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
	function dispTab(val)
	{
		if(val == 'regular')
      {
      	 $('#regular').addClass("active");  
      	 $('#matching').removeClass("active");  
      	 $('#regul').removeClass("active");
      	 $('#tf').removeClass("active");
      	 $('#mcq').removeClass("active");
      	 $('#mediaq').removeClass("active");
      	 $('#sub').removeClass("active");
      	 
      	 $('#matchthepair').removeClass("active"); 
      	 $('#truefalse').removeClass("active"); 
      	 $('#multipletype').removeClass("active");  
      	  $('#mediaquestion').removeClass("active");  
      	  $('#subjective').removeClass("active");      
      	        
      }
      if(val == 'matching')
      {
      	  $('#matchthepair').addClass("active");  
      	  $('#regular').removeClass("active");  
      	  $('#truefalse').removeClass("active");  
      	  $('#multipletype').removeClass("active");  
      	  $('#mediaquestion').removeClass("active");  
      	  $('#subjective').removeClass("active");  

      	 $('#matching').addClass("active");  
      	 $('#regul').removeClass("active");  
      	 $('#tf').removeClass("active");  
      	 $('#mcq').removeClass("active");  
      	 $('#mediaq').removeClass("active");  
      	 $('#sub').removeClass("active");  
      	        
      }
       if(val == 'truefalse')
      {
      	  $('#truefalse').addClass("active");  
      	  $('#regular').removeClass("active");  
      	  $('#matchthepair').removeClass("active");  
      	  $('#multipletype').removeClass("active");  
      	  $('#mediaquestion').removeClass("active");  
      	  $('#subjective').removeClass("active");  
      	  $('#matching').removeClass("active");  
      	  $('#regul').removeClass("active");  
      	  $('#tf').addClass("active");  
      	  $('#mcq').removeClass("active");  
      	  $('#mediaq').removeClass("active");  
      	  $('#sub').removeClass("active");        	        
      }
        if(val == 'mcq')
      {
		$('#multipletype').addClass("active");  
		$('#regular').removeClass("active"); 
		$('#truefalse').removeClass("active"); 
		$('#matchthepair').removeClass("active");
		$('#mediaquestion').removeClass("active");        
		$('#subjective').removeClass("active");        
		$('#matching').removeClass("active");        
		$('#regul').removeClass("active");        
		$('#truefalse').removeClass("active");        

		$('#mcq').addClass("active"); 
		$('#mediaq').removeClass("active");        
		$('#sub').removeClass("active");        	        
      }
      if(val == 'mediaq')
      {
      	 $('#mediaquestion').addClass("active"); 
      	 $('#regular').removeClass("active");        
      	 $('#truefalse').removeClass("active");        
      	 $('#multipletype').removeClass("active");        
      	 $('#matchthepair').removeClass("active");        
      	 $('#subjective').removeClass("active");        
      	 $('#matching').removeClass("active");        
      	 $('#regul').removeClass("active");        
      	 $('#tf').removeClass("active");        
      	 $('#mcq').removeClass("active");     
      	 $('#mediaq').addClass("active"); 
      	 $('#sub').removeClass("active");      	        
      }
      if(val == 'subjective')
      {
			$('#subjective').addClass("active"); 
			$('#regular').removeClass("active");      	        
			$('#truefalse').removeClass("active");      	        
			$('#multipletype').removeClass("active");      	        
			$('#mediaquestion').removeClass("active");      	        
			$('#matchthepair').removeClass("active");      	        
			$('#mediaq').removeClass("active");      	        
			$('#sub').addClass("active"); 
			$('#regul').removeClass("active"); 
			$('#tf').removeClass("active"); 
			$('#mcq').removeClass("active"); 
			$('#matching').removeClass("active");      	        
      }		
	}
</script>
<script>
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
		return false;

    return true;
}	
/*-----Form validation--------------------------------------------------------------------------------------*/
function regularSubmit()//form validation for regular form
{
	var countCheck =0;
	for(var txtNo=1; txtNo<=5; txtNo++)
	{
		if(document.getElementById('txtRegOpt'+txtNo).value != '')
		{
			if(document.getElementById('chkReg'+txtNo).checked)
			{
				countCheck++;
			}
		}		
	}

	if(countCheck == 0)
	{
		document.getElementById('errorROptions').innerHTML = "";
		document.getElementById('errorROptions').innerHTML = "<font color='red'>Invalid Data : Please check any one option which is right answer</font>";
		return false;
	}
	else if(countCheck > 1)
	{
		document.getElementById('errorROptions').innerHTML = "";
		document.getElementById('errorROptions').innerHTML = "<font color='red'>Invalid Data : Only one option should check</font>";
		return false;
	}

	if(document.getElementById('txtQuestion').value == '')
	{		
		document.getElementById('errorRQuestion').innerHTML = "<font color='red'>Please Enter the question!</font>";
		return false;
	}
	if(document.getElementById('txtPoints').value == '')
	{
		document.getElementById('errorRPoints').innerHTML = "<font color='red'>Please Enter the points!</font>";
		return false;
	}
	return true;	
}

function matchThePairSubmit()
{
	if(document.getElementById('txtMatchque1').value == '' || document.getElementById('txtMatchque2').value == '' || document.getElementById('txtMatchpair1').value == '' || document.getElementById('txtMatchpair2').value == '' || document.getElementById('txtMatchpoints1').value == '' || document.getElementById('txtMatchpoints2').value == '')
	{		
		document.getElementById('errorMctOptions').innerHTML = "<font color='red'>Please Fill proper information!</font>";
		return false;
	}	
	return true;	
}

function truefalseSubmit()
{	
	if(document.getElementById('txtTFQuestion').value == '')
	{
		document.getElementById('errorTFQuestion').innerHTML = "<font color='red'>Please Enter Question!</font>";
		return false;
	}
	if(document.getElementById('txtTFPoints').value == '')
	{
		document.getElementById('errorTFPoints').innerHTML = "<font color='red'>Please Enter Score!</font>";
		return false;
	}
	if(!document.getElementById('txtTrue').checked && !document.getElementById('txtFalse').checked)
	{
		document.getElementById('errorTFAnswer').innerHTML = "<font color='red'>Please select answer!</font>";
		return false;
	}	
}

function subjectiveSubmit()
{
	var txtSub = tinymce.get('txtSubjective').getContent();
	// alert(txtSub);
	if(txtSub == '')
	{

		document.getElementById('errorSQuestion').innerHTML = "<font color='red'>Please Enter Question!</font>";
		return false;
	}
	if(document.getElementById('txtPoints').value == '')
	{
		//document.getElementById('errorSPoints').innerHTML = "<font color='red'>Please Enter Score!</font>";
		//return false;
	}
}

function addAtributeRequired(txtNo)//for match the pair
{
	if(document.getElementById('txtMatchque'+txtNo).value != '')
	{
		document.getElementById('txtMatchpair'+txtNo).setAttribute("required","require"); 
		document.getElementById('txtMatchpoints'+txtNo).setAttribute("required", "require");
	}else
	{
		document.getElementById('txtMatchpair'+txtNo).removeAttribute("required"); 
		document.getElementById('txtMatchpoints'+txtNo).removeAttribute("required");
	}
}

function addAtributeRequiredMultiple(txtNo)//for multiple type
{
	if(document.getElementById('txtMultiOpt'+txtNo).value != '')
	{
		document.getElementById('txtMultiPoints'+txtNo).setAttribute("required", "require");
	}else
	{
		document.getElementById('txtMultiPoints'+txtNo).removeAttribute("required");
	}
}

function multipleTypeSubmit()//form validation for multiple type form
{
	var countCheck =0;
	for(var txtNo=1; txtNo<=5; txtNo++)
	{
		if(document.getElementById('txtMultiOpt'+txtNo).value != '')
		{
			if(document.getElementById('chkMulti'+txtNo).checked)
			{
				countCheck++;
			}
		}		
	}

	if(document.getElementById('txtMTQuestion').value == '')
	{
		document.getElementById('errorMLTQuestion').innerHTML = "<font color='red'>Please Enter Question</font>";
	}

	if(countCheck == 0)
	{
		document.getElementById('errorMLTOptions').innerHTML = "";
		document.getElementById('errorMLTOptions').innerHTML = "<font color='red'>Invalid Data : Please check any one option which is right answer</font>";
		return false;
	}

	if(document.getElementById('txtMultiOpt1').value == '' || document.getElementById('txtMultiOpt2').value == '' || document.getElementById('txtMultiPoints1').value == '' || document.getElementById('txtMultiPoints2').value == '')
	{		
		document.getElementById('errorMLTOptions').innerHTML = "";
		document.getElementById('errorMLTOptions').innerHTML = "<font color='red'>Please Fill proper information!</font>";
		return false;
	}	
	return true;	
}

function mediaTypeSubmit()
{
	var countCheck =0;
	for(var txtNo=1; txtNo<=5; txtNo++)
	{
		if(document.getElementById('txtMediaOpt'+txtNo).value != '')
		{
			if(document.getElementById('chkMedia'+txtNo).checked)
			{
				countCheck++;
			}
		}		
	}

	if(document.getElementById('txtMediaQuestion').value == '')
	{
		document.getElementById('errorMedQuestion').innerHTML = "<font color='red'>Please Enter Question</font>";
		return false;
	}
	if(document.getElementById('txtMedPoints').value == '')
	{
		document.getElementById('errorMedPoints').innerHTML = "<font color='red'>Please Enter points</font>";
		return false;
	}

	if(countCheck == 0)
	{
		document.getElementById('errorMedOptions').innerHTML = "";
		document.getElementById('errorMedOptions').innerHTML = "<font color='red'>Invalid Data : Please check any one option which is right answer</font>";
		return false;
	}
	else if(countCheck > 1)
	{
		document.getElementById('errorMedOptions').innerHTML = "";
		document.getElementById('errorMedOptions').innerHTML = "<font color='red'>Invalid Data : Only one option should check</font>";
		return false;
	}
	return true;	
}
</script>
<script type="text/javascript">
var $ =jQuery.noConflict();
// return $.fn.tooltip to previously assigned value
var bootstrapTooltip = $.fn.tooltip.noConflict();
 
// give $().bootstrapTooltip the Bootstrap functionality
$.fn.bootstrapTooltip = bootstrapTooltip
 
// now activate tooltip plugin from jQuery ui
$(document).tooltip();
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
<script>
var $ =jQuery.noConflict();
function sticky_relocate1() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor1').offset().top;
    if (window_top > div_top) {
        $('#sticky1').addClass('stick1');
    } else {
        $('#sticky1').removeClass('stick1');
    }
}

$(function () {
    $(window).scroll(sticky_relocate1);
    sticky_relocate1();
});
</script>
<script>
var $ =jQuery.noConflict();
function sticky_relocate2() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor2').offset().top;
    if (window_top > div_top) {
        $('#sticky2').addClass('stick2');
    } else {
        $('#sticky2').removeClass('stick2');
    }
}

$(function () {
    $(window).scroll(sticky_relocate2);
    sticky_relocate2();
});
</script>
<script>
var $ =jQuery.noConflict();
function sticky_relocate3() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor3').offset().top;
    if (window_top > div_top) {
        $('#sticky3').addClass('stick3');
    } else {
        $('#sticky3').removeClass('stick3');
    }
}

$(function () {
    $(window).scroll(sticky_relocate3);
    sticky_relocate3();
});
</script>
<script>
var $ =jQuery.noConflict();
function sticky_relocate4() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor4').offset().top;
    if (window_top > div_top) {
        $('#sticky4').addClass('stick4');
    } else {
        $('#sticky4').removeClass('stick4');
    }
}

$(function () {
    $(window).scroll(sticky_relocate4);
    sticky_relocate4();
});
</script>
<script>
var $ =jQuery.noConflict();
function sticky_relocate5() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor5').offset().top;
    if (window_top > div_top) {
        $('#sticky5').addClass('stick5');
    } else {
        $('#sticky5').removeClass('stick5');
    }
}

$(function () {
    $(window).scroll(sticky_relocate5);
    sticky_relocate5();
});
</script>
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>
   tinymce.init({ 
   	selector : "#txtSubjective",
	plugins: [
	"eqneditor advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen",
	"insertdatetime media table contextmenu paste" ],
	toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
    image_title: true,
    automatic_uploads: true,
    images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
    file_picker_types: 'image',
     image_advtab: true, 
    file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('#upload').trigger('click');
            $('#upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },

});
</script> 