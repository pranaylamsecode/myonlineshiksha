<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" id="style-resource-3">
<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/js/exam/exam.css"); ?>' >
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
		  });
		 }
		 else{
		   
		   jQuery('#payment_field').css("display","none");
		 }
	   
	   });
	});
</script>

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
 	$(function() {    $( document ).tooltip();  });
</script>

<style>
/*css*/
body{
	margin:0!important;
}
.nxtBtn{
	display: none;
}

.row {
  margin-left: 0px!important;
  margin-right: 0px!important;
}
.create-question-style {
  background-color: #f1f1f1;
  height: 73px;
}
.que-h2-style{
   margin-top: 0px;
  color: #c42140;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 21px!important;
  text-align: center!important;
  padding: 17px 30px 0 13px !important;
  border-bottom: 0px!important;
}
/*end of css*/
.validateerror {
float: left;
text-align: center;
width: 40%;
/*margin-left: 235px;*/
margin-left: 281px;
margin-bottom: -40px;
color: red;
}
.help-block {
display: block;
width: 100% !important;
margin: 0 -165px auto !important;
}
.exam-txt .form-group {
    margin-bottom: 15px;
    display: inline-block;
}
.validateerrorbox
{
border-color: red !important;
}
textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{
	width:100%;
}
.control-label {
    font-family: inherit;
    font-weight: 100;
    color: #000;
}
.pquestionsub {
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
    margin-bottom: 20px;
}
.tab-pane h3{
	margin-top: 10px;
}
select#qtype {
    -webkit-appearance: menulist;
    -moz-appearance: menulist;
    appearance: menulist;
}
input#file_i {
    border: none!important;
    box-shadow: none;
    padding: 0px;
    transition: none;
}
#errorRQuestion, #errorRPoints, #errorROptions,#errorMedPoints, #errorMLTOptions, #errorMLTQuestion{
	color: red;
	font-size: 15px;
}

</style>
<?php $attributes = array('class' => 'tform', 'id' => 'proform',
	// 'onsubmit'=>'return formvalid()'
);

echo form_open_multipart('#', $attributes); ?>
<?php
// $attributes = array('class' => 'tform', 'id' => 'attsave');
// echo form_open_multipart($attributes);
?>
<!-- <div class="create-question-style">
<h2 class="que-h2-style" style='padding-left: 10px;'>Create Question</h2>
</div> -->

<h2 class="sidebar_title">Question</h2>
<div class="row" style="padding:15px">
<p class=""><i>Choose the type of the Question you with to create from the below tabs</i></p>
	<div class="col-md-12 no-padding">
	    <select onchange="dispTab(this.value)" style="width: 170px;" class="form-control qty" name="q_type" id="qtype">
			<option value="regular">Regular</option>
        	<!-- <option value="matching">Match The Pair</option> -->
        	<!-- <option value="truefalse">True/False</option> -->
        	<!-- <option value="subjective">Subjective</option> -->
        	<option value="mcq">Multiple Type</option>
        	<!-- <option value="mediaq">Media Question</option> -->
		</select>
			<input type="hidden" name="txtQuestion" value="" id="txtque">
			<input type="hidden" name="Q_id" value="" id="Q_id" value="">
			<input type="hidden" name="tmp_val" value="" id="tmp_val" value="">

		<div>		
				<ul class="nav nav-tabs bordered" >
					<!--<li class="active" id="regul"><a   data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Regular</span></a></li> 
					<li id="matching" > <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Match The Pair</span></a></li>
					<li id="tf"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">True/False</span></a></li> 
					<li id="sub"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Subjective</span></a></li>
					<li id="mcq"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Multiple Type</span></a></li>
					<li id="mediaq"> <a  data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Media Question</span></a></li>-->
				</ul>

				<div class="tab-content"> 
					<!-- ........................... Regular.............................................. -->
					<div class="tab-pane active" id="regular">
					<h3>Regular</h3>
					<p class ="pquestionsub"><i>This would be a Multiple choice question having only one correct answer</i></p>
					<!-- <form action="<?php echo base_url();?>admin/exams/questions/exam_que" method='post' name='frmRegular' id='frmRegular' onsubmit='return regularSubmit();' novalidate> -->
					
						<!-- <div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>							
						</div>
 -->
						<!-- <div class="form-group">						
							<label class="col-sm-12 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control">
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType_reg" name="txtQuestionType" value='regular' />
							<!-- </div>
							<div class="col-sm-12 pquetext">
							<i>Put a relavent keyword for better searchability during the selection of the question for the exam paper</i>
							</div>	
						</div><br/> -->

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="question">Enter Question</label>							
							<div class="col-sm-12 no-padding">			
	                      		<textarea id="que_reg" name="Question_reg" class="form-control txteditor tempinput" rows="6" 
   /></textarea>
	                      		<div id='errorRQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div><br/>

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="instruction">Instruction</label>							
							<div class="col-sm-12 no-padding">		
												<!-- name="txtInstruction" -->
	                      		<input type='text' id="txtInstruction_reg" name="txtInstruction_reg"  class="form-control tempinput "/>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							<i>Put some relevant instruction for examinees,if necessary</i>
							</div>
						</div><br>


						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="points">Enter Score</label>							
							<div class="col-sm-12 no-padding">			
														<!-- name="txtPoints"  -->
	                      		<input type='text' id="txtPoints_reg" name="txtPoints_reg"  class="form-control tempinput point" onkeypress="return isNumberKey(event)" maxlength="2" />
	                      		<div id='errorRPoints'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							<i>The Marks which this question would carry</i>
							</div>
						</div><br>

						<!--<div class="form-group">						
							<label class="col-sm-12 control-label" for="pool">In Question Pool</label>							
							<div class="col-sm-12">							
	                      		<input type='checkbox' id="chkInpool" name="chkInpool"/>
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-pool" class="tooltipicon" title="Click Here"></span>

						<span class="que-pool  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_pool');?>

						</span>

						</span>
						</div>
						</div><br><br><br>-->
					
						<h4>Enter the option for above question</h4>
						<div id='errorROptions'></div>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options</th>
										 <th>Check corrected answer</th>
									</tr>
								</thead>
								<tbody id="regOpt">
									<tr class='tr treg' id="tr_1">
									 	<td>1</td>
									 	<td><input type='text' class='form-control ans_Opt' id='txtRegOpt_reg_1' name="txtRegOpt_reg[]" data-validation='required' data-validation-error-msg='Enter valid Option'></td>
									 	<td><input type='checkbox' class="chkOpt" name='chkReg_1' id='chkReg_reg_1'></td> 
									 </tr>
									<?php 
									// for ($i=1; $i <= 5; $i++) { 
									// 	echo "
									// <tr>
									//  	<td>".$i."</td> 
									//  	<td><input type='text' class='form-control' name='txtRegOpt".$i."' id='txtRegOpt".$i."'";
									//  	if($i==1 || $i==2){ echo " data-validation='required' data-validation-error-msg='Enter valid Option'";
									//  		}
									//  		echo " ></td>
									//  	<td><input type='checkbox' name='chkReg".$i."' id='chkReg".$i."'></td> 
									// </tr>";
									// } 
									?>
								</tbody>
							</table> 
						<!-- </form> -->
					</div>


					<!--........................... Match the pairs.............................................. -->
					<div class="tab-pane" id="matching">
						<h3>Match the Pair</h3>
					<p class="pquestionsub">This would be a set of maximum five pairs of items which the examinees needs to match as per the relevance.</p>
						<!-- <form action="<?php echo base_url();?>admin/exams/questions/exam_que" method='post' name='frmMatch' id='frmMatch'  onsubmit='return matchThePairSubmit()' novalidate>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>
						</div> -->

						<!-- <div class="form-group">						
							<label class="col-sm-12 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control"  /> -->
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag1" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span> -->

						<!--tip containt-->	

						<!-- <?php echo lang('que_tag');?> -->

						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType_mat" name="txtQuestionType_mat" value='match_the_pair' />
							<!-- </div>
							<div class="col-sm-12 pquetext">
							(Put a relavent keyword for better searchability during the selection of the question for the exam paper)
							</div>
						</div><br> -->
						
						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="question">Enter Question</label>							
							<div class="col-sm-12 no-padding">							
	                      		<textarea id="que_mat" name="txtQuestion_mat" class="form-control txteditor" rows="6"    >
	                      		</textarea>
	                      		<div id='errorRQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
		                      		
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

				

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="instruction">Instruction</label>							
							<div class="col-sm-12 no-padding">	
													<!-- name="txtInstruction" -->
	                      		<input type='text' id="txtInstruction_mat" name="txtInstruction_mat"  class="form-control tempinput " />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							(Put some relevant instruction for examinees,if necessary)
							</div>
						</div><br>

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="points">Enter Score</label>							
							<div class="col-sm-12 no-padding">			
											<!-- name="txtPoints" -->
	                      		<input type='number' id="txtPoints_mat" name="txtPoints_mat"  class="form-control tempinput point" onkeypress="return isNumberKey(event)"  >
	                      		<!-- data-validation="number" data-validation-error-msg="Enter valid Marks" -->
	                      		<p>The Marks which this question would carry</p>
	                      		<div id='errorRPoints'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
		                      		
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							
						</div>
						<!--<div class="form-group">						
							<label class="col-sm-12 control-label" for="pool">In Question Pool</label>							
							<div class="col-sm-12">							
	                      		<input type='checkbox' id="chkInpool" name="chkInpool"/>
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-pool1" class="tooltipicon" title="Click Here"></span>

						<span class="que-pool1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('que_pool');?>

						</span>

						</span>
							</div>
						</div><br><br><br>-->

						<h4>Match the pairs</h4>
						<div id='errorMctOptions'></div>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Questions
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
										 <th>Matching pairs (Answers)
										 	<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										 </th> 
									</tr>
								</thead>
								<tbody id='matchPair'>
									<tr class='tr tmatch' id="tr_1">
									 	<td>1</td>
									 	<td><input type='text' class='form-control match_Opt' name='txtMatchque[]' id='txtMatchque_match_1' onblur='addAtributeRequired(1)' data-validation='required' data-validation-error-msg='Enter valid Question'>
									 	</td>

									 	<td><input type='text' class='form-control match_Options' name='txtMatchpair[]' id='txtMatchpair_match_1' data-validation='required' data-validation-depends-on='txtMatchque_match_1' data-validation-error-msg='Enter valid Pair'></td> 
									 </tr>

									<?php //for ($i=1; $i <= 5; $i++) { 
									// 	echo "
									// <tr>
									//  	<td>".$i."</td> 
									//  	<td><input type='text' class='form-control' name='txtMatchque".$i."' id='txtMatchque".$i."' onblur='addAtributeRequired(".$i.")'";
									//  	if($i==1 || $i==2){ echo "data-validation='required' data-validation-error-msg='Enter valid Question'";
									//  	}
									//  		echo " ></td>
									//  	<td><input type='text' class='form-control' name='txtMatchpair".$i."' id='txtMatchpair".$i."'";
									//  	if($i==1 || $i==2){ echo " data-validation='required' data-validation-depends-on='txtMatchque".$i."' data-validation-error-msg='Enter valid Pair'";
									//  	}


									 	// 	echo " ></td> 
									 	// <td><input type='text' class='form-control' name='txtMatchpoints".$i."' id='txtMatchpoints".$i."' onkeypress='return isNumberKey(event)'";
									 	// if($i==1 || $i==2){ echo " data-validation='required' data-validation-depends-on='txtMatchpair".$i."' data-validation-error-msg='Enter valid score'";
									 	// }


									 	// 	echo " >
									 	// </td></tr>";
									 	// }
									 	 ?>
								</tbody>
							</table> 		
						<!-- </form>				 -->
				    </div> 


				     <!--........................... True False.............................................. -->
					<div class="tab-pane" id="truefalse"> 
						<h3>True or False</h3>
						<p class="pquestionsub">This would be a question where the examinees would have to select either True or False as the answer.</p>
					
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType_tf" name="txtQuestionType_tf" value='true_false' />
							
						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="question">Enter Question</label>							
							<div class="col-sm-12 no-padding">							
	                      		<textarea id="que_tf"  name="txtQuestion_tf"  class="form-control txteditor" rows="6"  /></textarea>
	                      		<div id='errorTFQuestion'></div>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      	
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>

						</div><br>

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="instruction">Instruction</label>							
							<div class="col-sm-12 no-padding">	
													<!-- name="txtInstruction" -->
	                      		<input type='text' id="txtInstruction_tf" name="txtInstruction_tf"  class="form-control tempinput " />

	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							Put some relevant instruction for examinees,if necessary
							</div>
						</div><br>

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="points">Enter Score</label>							
							<div class="col-sm-12 no-padding">	
													<!-- name="txtPoints"  -->
	                      		<input type='text' id="txtPoints_tf" name="txtPoints_tf" class="form-control tempinput point"  onkeypress="return isNumberKey(event)"  />
	                      		<div id='errorTFPoints'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		

						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							The Marks which this question would carry
							</div>
						</div>	<br>

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="question">Select correct Answer</label>							
							<div class="col-sm-12 no-padding">							
	                      		<input type='radio' class='tf_Opt' name="rbTrueFalse" id='txtTrue' value='1' >  True
	                      		<input type='radio' class='tf_Opt' name="rbTrueFalse" id='txtFalse' value='0'>  False
	                      		<div id='errorTFAnswer'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div >
						</div><br><br><br>		
						<!-- </form>			 -->
					</div>

					<!--........................... subjective.............................................. -->
					<div class="tab-pane" id="subjective"> 
					   	<h3>Subjective</h3>
						<!-- <form action="<?php echo base_url();?>admin/exams/questions/exam_que" method='post' name='frmsubjective' id='frmsubjective' onsubmit='return subjectiveSubmit()' novalidate>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>							
						</div> -->

					<!-- 	<div class="form-group">						
							<label class="col-sm-12 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control"  /> -->
	                      		<input type='hidden' id="txtQuestionType_sub" name="txtQuestionType_sub" value='subjective' />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

								<span type="text" id="que-tag4" class="tooltipicon" title="Click Here"></span>

								<span class="que-tag4  tooltargetdiv" style="display: none;" >

								<span class="closetooltip"></span> -->

								<!--tip containt-->	

								<!-- <?php echo lang('que_tag');?> -->

								<!--/tip containt-->

								<!-- </span>

								</span> -->
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							<!-- </div>
							<div class="col-sm-12 pquetext">
							Put a relevant keyword for better searchability during the selection of the question for the exam paper
							</div>
						</div><br> -->

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="question">Enter Question for subjective</label>							
							<div class="col-sm-12 no-padding">							
	                      		<!-- <textarea id="txtSubjective"  name="txtSubjective"  class="form-control" rows="6" required   /></textarea> -->
	                      		<textarea id="que_sub"  name="txtQuestion_sub"  class="form-control txteditor" rows="6"  /></textarea>
	                      		<div id='errorSQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div><br>
						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="instruction">Instruction</label>							
							<div class="col-sm-12 no-padding">		
												<!-- name="txtInstruction" -->
	                      		<input type='text' id="txtInstruction_sub" name="txtInstruction_sub"  class="form-control tempinput " />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							Put some relevant instruction for examinees,if necessary
							</div>
						</div><br>		

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="points">Enter Score</label>							
							<div class="col-sm-12 no-padding">		
												<!-- name="txtPoints" -->
	                      		<input type='text' id="txtPoints_sub" name="txtPoints_sub"  class="form-control tempinput point"  onkeypress="return isNumberKey(event)"   />
	                      		<div id='errorSPoints'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							The Marks which this question would carry
							</div>
						</div><br><br><br>
						<!-- </form> -->
					</div>

					<!--........................... Multiple Type.............................................. -->
					<div class="tab-pane" id="mcq"> 
						<h3>Multiple Type</h3>
					<p class="pquestionsub">This would be a multiple choice question having more than one correct answer.</p>
						<!-- <form action="<?php echo base_url();?>admin/exams/questions/exam_que" method='post' name='frmMultiple' id='frmMultiple' onsubmit='return multipleTypeSubmit()' novalidate>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>							
						</div>
 -->
					<!-- 	<div class="form-group">						
							<label class="col-sm-12 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control"  /> -->
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag4" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag4  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span> -->

						<!--tip containt-->	

						<!-- <?php echo lang('que_tag');?>
 -->
						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<input type='hidden' id="txtQuestionType_mul" name="txtQuestionType_mul" value='multiple_choice' />
							<!-- </div>
							<div class="col-sm-12 pquetext">
							Put a relevant keyword for better searchability during the selection of the question for the exam paper.
							</div>
						</div><br> -->

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="question">Enter Question for multiple answers</label>							
							<div class="col-sm-12 no-padding">							
	                      		<textarea id="que_mul" name="txtQuestion_mul" class="form-control txteditor" rows="6"    /></textarea>
	                      		<div id='errorMLTQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div><br>

						
						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="instruction">Instruction</label>							
							<div class="col-sm-12 no-padding">	
													<!-- name="txtInstruction" -->
	                      		<input type='text' id="txtInstruction_mul" name="txtInstruction_mul"  class="form-control tempinput " />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							Put some relevant instruction for examinees,if necessary.							
							</div>
						</div><br>

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="points">Enter Score</label>							
							<div class="col-sm-12 no-padding">		
												<!-- name="txtPoints" -->
	                      		<input type='text' id="txtPoints_mul" name="txtPoints_mul" class="form-control tempinput point"    />
	                      		<div id='errorMedPoints' onkeypress="return isNumberKey(event)" ></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							The Marks which this question would carry.							
							</div>
						</div><br>
						<br><br>	
						
						<h4>Enter the option for above question</h4>
						<div id='errorMLTOptions'></div>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Check corrected answer
											<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> 
									</tr>
								</thead>
								<tbody id="multiOpt">
									<tr class='tr trow' id="tr_1">
									 	<td>1</td>
									 	<td><input type='text' class='form-control mul_Opt' name='txtMultiOpt[]' id='txtMultiOpt_mul_1' data-validation='required' data-validation-error-msg='Enter valid Option'></td>
									 	<td><input type='checkbox' class='chkOpt' name='chkMulti_1' id='chkMulti_mul_1'></td> 
									 </tr>


									
								</tbody>
							</table>
						<!-- </form> -->
					</div>		

					<!--........................... Media Questions.............................................. -->
					<div class="tab-pane" id="mediaq"> 
						<h3>Media Question</h3>
					<p class="pquestionsub" >This would be a multiple choice question having one correct answer and the question would consist of any video, image etc. With the texts.</p>
						<!-- <form action="<?php echo base_url();?>admin/exams/questions/exam_que" 
						 enctype="multipart/form-data" method='post' name='frmMedia' id='frmMedia' onsubmit='return mediaTypeSubmit()' novalidate>
						<div class="form-group" style="text-align:right;">	
							<input type='submit' name='btnSave' id='btnSave' class="btn btn-default" value='Save'>							
						</div>
 -->
					<!-- 	<div class="form-group">						
							<label class="col-sm-12 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-12">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control"  /> -->
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!-- <span class="tooltipcontainer">

						<span type="text" id="que-tag6" class="tooltipicon" title="Click Here"></span>

						<span class="que-tag6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span> -->

						<!--tip containt-->	

					<!-- 	<?php echo lang('que_tag');?> -->

						<!--/tip containt-->

						<!-- </span>

						</span> -->
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
	                      		<!-- <input type='hidden' id="txtQuestionType" name="txtQuestionType" value='media_type' />
							</div>
							<div class="col-sm-12 pquetext">
							Put a relevant keyword for better searchability during the selection of the question for the exam paper							
							</div>
						</div><br> -->

						<div class="form-group">		
							<label class="col-sm-12 no-padding control-label" for="question">Enter Question</label>							
							<div class="col-sm-12 no-padding">							
	                      		<textarea id="que_media" name="txtQuestion_media" class="form-control txteditor" rows="6"    /></textarea>
	                      		<div id='errorMedQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div><br>
						

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="instruction">Instruction</label>							
							<div class="col-sm-12 no-padding">			
											<!-- name="txtInstruction" -->
	                      		<input type='text' id="txtInstruction_media" name="txtInstruction_media"  class="form-control tempinput " />
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							Put some relevant instruction for examinees,if necessary.							
							</div>
						</div><br>

						<div class="form-group">						
							<label class="col-sm-12 no-padding control-label" for="points">Enter Score</label>							
							<div class="col-sm-12 no-padding">	
													<!-- name="txtPoints" -->
	                      		<input type='text' id="txtPoints_media" name="txtPoints_media"  class="form-control tempinput point"    />
	                      		<div id='errorMedPoints' onkeypress="return isNumberKey(event)" ></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
							<div class="col-sm-12 no-padding pquetext">
							The Marks which this question would carry.							
							</div>
						</div><br>

						<div class="form-group">		
							<label class="col-sm-12 no-padding control-label" for="question">Select Media</label>							
							<div class="col-sm-12 no-padding">	
							<!-- <form enctype="multipart/form-data" id="upfile" method="post" action="<?php echo base_url(); ?>admin/exams/upload_image">						 -->
	                      		<input type='file' id="file_i" name="file_i" class="form-control"   accept="audio/*,video/*,image/*" >
	                      		<!-- <input type="submit" id="submitbtn" style="display: none;"> -->
	                      		<div id='mImg' style="display:none"><img style="max-width:225px;max-height:175px" src=""></div>
	                      	<!-- </form> -->
	                      		<!-- @@@@@tooltip start@@@@@@@@
	                      		
						 @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>
						<br>
					
							<h4>Enter the option for above question</h4>
							<div id='errorMedOptions'></div>
							<table class="table responsive">
								<thead>
									<tr>
										<th>#</th> <th>Options
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> <th>Check corrected answer

										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      	
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
									</tr>
									<!-- <tr>
									 	<th>1</th>
									 	<th><input type='text' class='form-control media_Opt' name='txtMediaOpt1' id='txtMediaOpt_med_1' ></th>
									 	<th><input type='checkbox' class='chkOpt' name='chkMedia1' id='chkMedia_med_1' ></th> 
									</tr> -->
									
								</thead>
								<tbody id="mediaOpt">
									
									<tr class='tr tmed' id="tr_1">
									 	<td>1</td>
									 	<td><input type='text' class='form-control media_Opt' name='txtMediaOpt[]' id='txtMediaOpt_med_1' ></td>
									 	<td><input type='checkbox' class='chkOpt' name='chkMedia_1' id='chkMedia_med_1' ></td> 
									</tr>
									
								</tbody>
							</table> 

						
						 
						<!-- </form> -->

					</div>	
		</div>
	
	</div>
	<button type="button" class="nxtBtn" id="nxt_que">Next Question</button>
	<button type="button" class="nxtBtn" id="nxt_sect">Next Section</button>
	<button type="button" class="nxtBtn" id="nxt_pg">Next Page</button>
	<button id="saveQ" type="button" value="" style="float: right; padding: 5%;display: none;"  >Save Question</button>
	<button id="updateQ" type="button" value="" style="float: right; padding: 5%;display: none;"  >Upadate Question</button>

</div>

</div>
	

<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>/js/redactor/css/redactor.css" />
 -->
<!-- <script src="<?php echo base_url(); ?>/js/redactor/redactor.js"></script>
 -->
<script>
$('#nxt_que').on('click', function(){
	var ele_info = $('.tampval').val();
	var ele_id = ele_info.split('_');
	var id = parseInt(ele_id[1])+1;
	// alert(id);
	opennav('Que_'+id);
});
$('#nxt_sect').on('click', function(){
	var temp = $('.tampval').val();
	var ele_info = $('#'+temp).parent().attr('id');
	var ele_id = ele_info.split('_');
	var id = parseInt(ele_id[1])+1;
	opennav("secTitle_"+id);
	 
});
$('#nxt_pg').on('click', function(){
	var temp = $('.tampval').val();
	var ele_info = $('#'+temp).parent().parent().attr('id');
	var ele_id = ele_info.split('_');
	var id = parseInt(ele_id[1])+1;
	opennav("pageTitle_"+id);
});
 </script>

<?php echo form_close(); ?>

<style>
.hide{
    
    display:none;
}
</style>
<script>
		 // $('#saveQ').click(function(){

	function deleteQ(){
		var q_id = $('#proform').find('#Q_id').val();
		var exam_id = "<?php echo $this->uri->segment(4); ?>";
		var current_mk = $('#proform').find('.point').val();
		var totmk = parseInt($(document).find('.totmk').val()) - parseInt(current_mk);
		// alert(totmk);
		$.ajax({

			type: "POST",
			url:  "<?php echo base_url(); ?>admin/exams/autoDelete/"+q_id+"/"+exam_id,
			data: {q_id: q_id, exam_id: exam_id, totmk: totmk},
			success: function(data){
				console.log('delete');
				console.log(data);
			}

		});

	}

	function saveQ(tem){
			  		
        event.preventDefault();
        Que_id = $(document).find('.tampval').val();
		section_id = $(document).find('#'+Que_id).parent().attr('id').split('_');
		page_id = $(document).find('#'+Que_id).parent().parent().attr('id').split('_');
		pageTitle = $(document).find('#pageTitle_'+page_id[1]).val();
		pg_des = $(document).find('#txt_page_'+page_id[1]).val();
		sec_des = $(document).find('#secDesc_'+section_id[1]).html();
		secTitle = $(document).find('#secTitle_'+section_id[1]).val();
		var exam_id = $('#exam_id').val();
		if(!exam_id)
			exam_id = "<?php echo $this->uri->segment(4) ? $this->uri->segment(4) : '0'; ?>";
        // Get form
        var form = $('#proform')[0];
		// Create an FormData object 
        var data = new FormData(form);
        data.append("exam_id", exam_id);
        data.append("page_id", page_id[1]);
        data.append("section_id", section_id[1]);
        data.append("pg_des", pg_des);
        data.append("sec_des", sec_des);
        data.append("pageTitle", pageTitle);
        data.append("secTitle", secTitle);
        // console.log(form);
      var Qtxt = $('#mySidenav').find('#Qform').find('#txtque').val();
if(Qtxt){
$.ajax({
 type: "POST",
enctype: 'multipart/form-data',
url:  "<?php echo base_url(); ?>admin/exams/autosave",
 // dataType: "json",

// data: $('#proform').serialize(),
 data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
success: function(ins_id) {
// alert(ins_id);
	var res = $.parseJSON(ins_id);

	if(res[1])
	{
		if($.isNumeric(res[1]))
		{
		
		var tempvalarray = Que_id.split('_');
		var qid = $('#Qform').find('#Q_id').val();
		if(!qid){
			console.log(tempvalarray);
			tempvalarray = tem.split('_');
		$('#'+Que_id).find('div').find('#qid_'+tempvalarray[1]).val(res[1]);
		$('#Qform').find('#Q_id').val('');

		}
		// $('#saveQ').hide();
		// $('#updateQ').show();
		$('#mySidenav').find('#Qform').find('#txtque').val('');
		}

	}
}
});
}
}



	  // $('#updateQ').click(function(){
	  	function updateQ(tem){
	  		// alert(tem);
       // event.preventDefault();

        // Get form
        var form = $('#proform')[0];

		// Create an FormData object 
        var data = new FormData(form);
 var Qtxt = $('#mySidenav').find('#Qform').find('#txtque').val();
 // alert(Qtxt);
if(Qtxt){
$.ajax({
 type: "POST",
enctype: 'multipart/form-data',
url:  "<?php echo base_url(); ?>admin/exams/autosave/update",
// data: $('#proform').serialize(),
 data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
success: function(ins_id) {
	console.log('updateQ');
	console.log(ins_id);
		var res = $.parseJSON(ins_id);
		
if(res[1])
	{
		if($.isNumeric(res[1]))
		{
		
		// var tempval = $('.tampval').val();
		// var tempvalarray = tempval.split('_');
		// var cont = $('#Que_'+tempvalarray[1]).find('div').find('#ques_'+tempvalarray[1]).val();
		// $('#mySidenav').find('#Qform').find('#txtque').val(cont);
		$('#Qform').find('#Q_id').val('');

		
		// $('#saveQ').hide();
		// $('#updateQ').show();
		$('#mySidenav').find('#Qform').find('#txtque').val('');
		}

	}
	else{
		// alert('11');
	}

}
});
}
};



// 	  $('#saveQ').click(function(){
// 	 var options = {
// url:  "<?php echo base_url(); ?>admin/exams/autosave",
// data: $('#proform').serialize(),

// 	 };

// 	 $('#proform').submit(function() { 
// 	 	 $(this).ajaxSubmit(options);
// 	 	  return false; 
//     }); 
// });
// }
	 

</script>
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
jQuery(document).ready(function(){
	jQuery('.tooltipicon').click(function(){
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.closetooltip').click(function(){
	jQuery(this).parent().css('display','none');
	});
	});
</script>

<!-- tool tip script finish -->
<script>
$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
   // event.preventDefault();
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
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
		return false;

    return true;
}	
/*-----Form validation--------------------------------------------------------------------------------------*/
</script>


<script>
// var $j =jQuery.noConflict();
// $j.validate({
// errorElementClass:"validateerrorbox",
// errorMessageClass:"validateerror",
// borderColorOnError:"red",
// //errorMessagePosition:"top",
// modules : 'logic',
// }); 

	function dispTab(val)
	{
		if(val == 'regular')
      {
      	$j('.treg').show();
      	$j('.trow').hide();
      	$j('#qtype').val('regular');   
      	 $j('#regular').addClass("active");  
      	 $j('#matching').removeClass("active");  
      	 $j('#regul').removeClass("active");
      	 $j('#tf').removeClass("active");
      	 $j('#mcq').removeClass("active");
      	 $j('#mediaq').removeClass("active");
      	 $j('#sub').removeClass("active");

      	 // $j('#matchthepair').removeClass("active"); 
      	 $j('#truefalse').removeClass("active"); 
      	 // $j('#multipletype').removeClass("active");  
      	  // $j('#mediaquestion').removeClass("active");  
      	  $j('#subjective').removeClass("active");         
      }
      if(val == 'matching')
      {
      	  // $j('#matchthepair').addClass("active");
      	  // $('.txteditor').active(false); 
      	  $j('#qtype').val('matching');    
      	  $j('#regular').removeClass("active");  
      	  $j('#truefalse').removeClass("active");  
      	  // $j('#multipletype').removeClass("active");  
      	  // $j('#mediaquestion').removeClass("active");  
      	  $j('#subjective').removeClass("active");  

      	 $j('#matching').addClass("active");  
      	 $j('#regul').removeClass("active");  
      	 $j('#tf').removeClass("active");  
      	 $j('#mcq').removeClass("active");  
      	 $j('#mediaq').removeClass("active");  
      	 $j('#sub').removeClass("active");  
      	        
      }
      if(val == 'truefalse')
      {
      	$j('#qtype').val('truefalse'); 
      	// $('.txteditor').active(false); 
      	  $j('#truefalse').addClass("active");  
      	  $j('#regular').removeClass("active");  
      	  // $j('#matchthepair').removeClass("active");  
      	  // $j('#multipletype').removeClass("active");  
      	  // $j('#mediaquestion').removeClass("active");  
      	  $j('#subjective').removeClass("active");  
      	  $j('#matching').removeClass("active");  
      	  $j('#regul').removeClass("active");  
      	  $j('#tf').addClass("active");  
      	  $j('#mcq').removeClass("active");  
      	  $j('#mediaq').removeClass("active");  
      	  $j('#sub').removeClass("active");        	        
      }
        if(val == 'mcq')
      {
      	$j('#qtype').val('mcq'); 
      	$j('.treg').hide();
      	$j('.trow').show();
		// $j('#multipletype').addClass("active");  
		$j('#regular').removeClass("active"); 
		$j('#truefalse').removeClass("active"); 
		// $j('#matchthepair').removeClass("active");
		// $j('#mediaquestion').removeClass("active");        
		$j('#subjective').removeClass("active");        
		$j('#matching').removeClass("active");        
		$j('#regul').removeClass("active");        
		$j('#truefalse').removeClass("active");     

		$j('#mcq').addClass("active"); 
		$j('#mediaq').removeClass("active");        
		$j('#sub').removeClass("active");        	        
      }
      if(val == 'mediaq')
      {
      	$j('#mImg').hide();
      	$j('#qtype').val('mediaq'); 
      	 // $j('#mediaquestion').addClass("active"); 
      	 $j('#regular').removeClass("active");        
      	 $j('#truefalse').removeClass("active");        
      	 // $j('#multipletype').removeClass("active");        
      	 // $j('#matchthepair').removeClass("active");        
      	 $j('#subjective').removeClass("active");        
      	 $j('#matching').removeClass("active");        
      	 $j('#regul').removeClass("active");        
      	 $j('#tf').removeClass("active");        
      	 $j('#mcq').removeClass("active");     
      	 $j('#mediaq').addClass("active"); 
      	 $j('#sub').removeClass("active");      	        
      }
      if(val == 'subjective')
      {
      		$j('#qtype').val('subjective'); 
			$j('#subjective').addClass("active"); 
			$j('#regular').removeClass("active");      	        
			$j('#truefalse').removeClass("active");      	        
			// $j('#multipletype').removeClass("active");      	        
			// $j('#mediaquestion').removeClass("active");      	        
			// $j('#matchthepair').removeClass("active");      	        
			$j('#mediaq').removeClass("active");      	        
			$j('#sub').addClass("active"); 
			$j('#regul').removeClass("active"); 
			$j('#tf').removeClass("active"); 
			$j('#mcq').removeClass("active"); 
			$j('#matching').removeClass("active");      	        
      }
      
	}	
</script>
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>
   tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
selector : "#txtSubjective, .txteditor",
setup : function(ed) {
	 

      ed.on('KeyUp', function(ed, e) {
      	var tempval = $('.tampval').val();
		var tempvalarray = tempval.split('_');
           var tempval2 = tinymce.activeEditor.getContent();

  			//  $('#showQue_'+tempvalarray[1]).html(tempval2);
  			// $('#ques_'+tempvalarray[1]).text(tempval2);
  			
  			$('#Qform').find('#txtque').val(tempval2);

      });
      ed.on('keydown keyup blur', function(ed, e) {
      	var tempval = $('.tampval').val();
		var tempvalarray = tempval.split('_');
		var chkval =$('#Que_'+tempvalarray[1]).find('#ques_'+tempvalarray[1]).val();
		// console.log(chkval);
		if(chkval)
		{
			addQue(tempval);
			$("#mySidenav").find('button.deletebtn').attr('disabled', false);
				 $j("#mySidenav").find('button.deletebtn').show();
		}
      });
      }
});


</script> 

<script>



</script> 

<script>
	// $j(document).ready(function() { 
 //            // bind 'myForm' and provide a simple callback function 
 //            $j(document).find('#upfile').ajaxForm(function() { 
 //                alert("Thank you for your comment!"); 
 //            }); 
 //        }); 
</script>