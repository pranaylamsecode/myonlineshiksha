<?php
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('logged_in');
	$maccessarr=$this->session->userdata('maccessarr');
	//print_r($maccessarr);
?>
<style type="text/css">
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

.validateerrorbox
{
	border-color: red !important;
}
</style>
<script>
function saveorder(n, task) 
{
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

<script>
function sticky1_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor1').offset().top;
    if (window_top > div_top) {
        $('#sticky1').addClass('stick1');
    } else {
        $('#sticky1').removeClass('stick1');
    }
}

$(function () {
    $(window).scroll(sticky1_relocate);
    sticky1_relocate();
});
</script>

<script>
function sticky2_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor2').offset().top;
    if (window_top > div_top) {
        $('#sticky2').addClass('stick2');
    } else {
        $('#sticky2').removeClass('stick2');
    }
}

$(function () {
    $(window).scroll(sticky2_relocate);
    sticky2_relocate();
});
</script>

<script>
function sticky3_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor3').offset().top;
    if (window_top > div_top) {
        $('#sticky3').addClass('stick3');
    } else {
        $('#sticky3').removeClass('stick3');
    }
}

$(function () {
    $(window).scroll(sticky3_relocate);
    sticky3_relocate();
});
</script>

<script>
function sticky4_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor4').offset().top;
    if (window_top > div_top) {
        $('#sticky4').addClass('stick4');
    } else {
        $('#sticky4').removeClass('stick4');
    }
}

$(function () {
    $(window).scroll(sticky4_relocate);
    sticky4_relocate();
});
</script>

<script>
function sticky5_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor5').offset().top;
    if (window_top > div_top) {
        $('#sticky5').addClass('stick5');
    } else {
        $('#sticky5').removeClass('stick5');
    }
}

$(function () {
    $(window).scroll(sticky5_relocate);
    sticky5_relocate();
});
</script>



<style type="text/css">
	.tab-pane {
  border-right: 0 !important;
  border-bottom: 0 !important;
  border-left: 0 !important;
}

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

<header>


<section class="breadcrumb">
<div class="container">

      <span class="page-title">
        <?php echo (($updType == 'edit')?'Edit Question':'Create New Question');?>
      </span>

      <div class="bread-view">
	    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
	    <span class="ng-hide">/ </span>
	    <a href="#"><?php echo (($updType == 'edit')?'Edit Question':'Create New Question');?></a>
	</div>

</div>
</section>


</header>

<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box;">
<?php
//echo $tmpl;
    $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?>  


<div class="main-content">


	<div class="row">

<div class="sidebar-collapse sb-toggle-left" style="float: left; margin: 0 20px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<p style="padding:0 20px;">Choose the type of the Question you with to create from the below tabs</p>

<div style="clear:both;"></div>

<div class="clr"></div>

<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>


<?php
//$attributes = array('class' => 'tform', 'name' => 'topform11');
//echo form_open_multipart(base_url().'questions/',$attributes)
?>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<div class="clear"></div>
<?php echo form_close(); ?>

<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ new code start @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
<!--<h2><?php echo (($updType == 'edit')?'Edit Question':'Create Question');?></h2>-->

<div class="col-md-12"> 
		<div class="panel panel-primary" data-collapsed="0"> 
			<div class="panel-heading" style="<?php echo (($updType == 'edit') ? 'display:none' : 'display:block' ); ?>" > 
				<div class="panel-title">
				<select onchange="dispTab(this.value)" class="form-control"  name="q_type" id="q_type">
				<option value="regular">Regular</option>
	        	<option value="matching">Match The Pair</option>
	        	<option value="truefalse">True/False</option>
	        	<option value="subjective">Subjective</option>
	        	<option value="mcq">Multiple Choice</option>
	        	<option value="mediaq">Media Question</option>
				</select>
				</div> 
			</div>


		<div>		


				<div class="tab-content"> 

				<!-- .......................Regular......................................... -->

					<div class="tab-pane <?php echo (($updType == 'edit' && @$questions->que_type == 'regular') ? 'active' : ($updType == 'create') ? 'active' : ''); ?>" id="regular">

						<form action="<?php echo base_url();?>exams/questions" method='post' name='frmRegular' id='frmRegular' onsubmit='return regularSubmit();' novalidate >
						  <input type='hidden' name="updType" value='<?php echo $updType; ?>' >
						  <?php if($updType == 'edit') { ?>
						  <input type='hidden' name="que_id" value='<?php echo $questions->que_id; ?>' >
						  <?php } ?>
						<div class="panel-heading">
							<div class="panel-title" style="padding-bottom: 0px;">	
								<h3 style="margin-top: 0;">Regular</h3>
								<p style="margin-bottom: 0px;">This would be a Multiple Type question having only one correct answer</p>
							</div>
							<div  class="panel-options">
							<div id="sticky-anchor"></div>
							<div id="sticky">	
							<input style="margin-top:2px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a style="margin-top:0;" href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
							</div>
						</div>  
						</div>
						<hr style="margin-bottom:0px;">
						
			
						<div class="panel-body form-horizontal form-groups-bordered"> 
			
					
							<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->que_tag)) ? $questions->que_tag : '' ) ?>">

	                      		<p>Put a relavent keyword for better searchability during the selection of the question for the exam paper</p>
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
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='regular' >
							</div>
							
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtRegQuestion" name="txtQuestion" class="form-control txteditor" rows="6"  data-validation="required" data-validation-error-msg="Enter valid Question"
	                      		 ><?php echo (($updType == 'edit' && isset($questions->que_title)) ? $questions->que_title : '' ) ?> </textarea>
	                      		<div id='errorRQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
		                      		<span class="tooltipcontainer">
									<!--<span type="text" id="que" class="tooltipicon" title="Click Here" style="margin-left: 420px;margin-top: -68px;"></span>--><span type="text" id="que" class="tooltipicon" title="Click Here" style="margin-left: 420px;"></span>
									<span class="que  tooltargetdiv" style="display: none;" >
									<span class="closetooltip"></span>
									<!--tip containt-->	
									<?php echo 'Enter Question'; //echo lang('que_line');?>
									<!--/tip containt-->
									</span>
									</span>
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Marks</label>							
							<div class="col-sm-5">							
	                      		<input type='number' id="txtPoints" name="txtPoints" class="form-control" onkeypress="return isNumberKey(event)"  data-validation="number" data-validation-error-msg="Enter valid Marks" value="<?php echo (($updType == 'edit' && isset($questions->que_marks)) ? $questions->que_marks : '' ) ?>">

	                      		<p>The Marks which this question would carry</p>
	                      		<div id='errorRPoints'></div>
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
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->instruction)) ? $questions->instruction : '' ) ?>" >

	                      		<p>Put some relevant instruction for examinees,if necessary</p>

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
								<h3 style="margin-bottom: 0;">Enter the option of answers for above question</h3>
							</div> 
						</div>
						<div id='errorROptions'></div> 
						<div class="panel-body with-table">
							<table class="table table-bordered table-responsive"> 
							
								<thead>
									<tr>
										<th>#</th> 
										<th>Options
										
					                    <!--<span class="tooltipcontainer">
										<span type="text" id="que-option" class="tooltipicon" title="Click Here"></span>
										<span class="que-option  tooltargetdiv" style="display: none;" >
										<span class="closetooltip"></span>
										
										<?php echo lang('que_option');?>
										
										</span>
										</span>-->
										
										</th> 
										<th>Check the correct answer
										
	                      				<!-- <span class="tooltipcontainer">

						<span type="text" id="que-correct" class="tooltipicon" title="Click Here"></span>

						<span class="que-correct  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

	

						<?php echo lang('que_correct');?>

						

						</span>

						</span>-->
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($updType == 'edit'){
										$i=1;
										$reg_option = json_decode($questions->options);
									foreach ($reg_option as $st) {
										foreach ($st as $val) {

										$txtRegOpt = 'txtRegOpt'.$i;
										$chkReg = 'chkReg'.$i;
										?>
										<tr>
										 	<td><?php echo $i;?></td>
										 	<td><input type='text' class='form-control' name="<?php echo $txtRegOpt?>" id="<?php echo $txtRegOpt?>" value="<?php echo $val;?>" 
										 		<?php if($i==1 || $i==2){ echo " data-validation='required' data-validation-error-msg='Enter valid Option'"; }?> ></td>
										 	<td><input type='checkbox' name="<?php echo $chkReg?>" id="chkReg" <?php echo ($questions->correct_ans == $i) ? 'checked' : ''; ?>  ></td> 
										</tr>
										<?php	
										$i++;	
										}

									}
									}
									else{ for ($i=1; $i <= 5; $i++) { 
										echo "
									<tr>
									 	<td>".$i."</td> 
									 	<td><input type='text' class='form-control' name='txtRegOpt".$i."' id='txtRegOpt".$i."'";
									 	if($i==1 || $i==2){ echo " data-validation='required' data-validation-error-msg='Enter valid Option'";
									 		}
									 		echo " ></td>
									 	<td><input type='checkbox' name='chkReg".$i."' id='chkReg".$i."'></td> 
									</tr>";
									} 
									}?>

									
								</tbody>
							
							</table>
						</div> 

						</form>
					</div>

					<!--........................... Match the pairs.............................................. -->

					
					<div class="tab-pane <?php echo (($updType == 'edit' && @$questions->que_type == 'match_the_pair') ? 'active' : ''); ?>" id="matchthepair" >

					<form action="<?php echo base_url();?>exams/questions" method='post' name='frmMatch' id='frmMatch' onsubmit='return matchThePairSubmit()' novalidate >
						  <input type='hidden' name="updType" value='<?php echo $updType; ?>' >
						  <?php if($updType == 'edit') { ?>
						  <input type='hidden' name="que_id" value='<?php echo $questions->que_id; ?>' >
						  <?php } ?>

					<div class="panel-heading">
							<div class="panel-title" style="padding-bottom: 0px;">	
								<h3 style="margin-top: 0;">Match The Pair</h3>
								<p style="margin-bottom: 0px;">This would be a set of maximum five pairs of items which the examinees needs to match as per the relevance.</p>
							</div>
							<div id="sticky-anchor1"></div>
							<div  class="panel-options" id="sticky1">	
							<input style="margin-top:2px;"  type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a style="margin-top:0px;" href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
							</div>   
						</div>
						<hr style="margin-bottom:0px;">

						<div class="panel-body form-horizontal form-groups-bordered"> 
							<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->que_tag)) ? $questions->que_tag : '' ) ?>">
	                      		<p>Put a relavent keyword for better searchability during the selection of the question for the exam paper</p>

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
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='match_the_pair' >
							</div>
							
						</div>
						
						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtRQuestion" name="txtQuestion" class="form-control txteditor" rows="6"  data-validation="required" data-validation-error-msg="Enter valid Question" >
	                      		<?php echo (($updType == 'edit' && isset($questions->que_title)) ? $questions->que_title : '' ); ?></textarea>
	                      		<div id='errorRQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
		                      		<span class="tooltipcontainer">
									<!--<span type="text" id="que" class="tooltipicon" title="Click Here" style="margin-left: 420px;margin-top: -68px;"></span>--><span type="text" id="que" class="tooltipicon" title="Click Here" style="margin-left: 420px;"></span>
									<span class="que  tooltargetdiv" style="display: none;" >
									<span class="closetooltip"></span>
									<!--tip containt-->	
									<?php echo 'Enter Question'; //echo lang('que_line');?>
									<!--/tip containt-->
									</span>
									</span>
								<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Marks</label>							
							<div class="col-sm-5">							
	                      		<input type='number' id="txtPoints" name="txtPoints" class="form-control" onkeypress="return isNumberKey(event)"  data-validation="number" data-validation-error-msg="Enter valid Marks" value="<?php echo (($updType == 'edit' && isset($questions->que_marks)) ? $questions->que_marks : '' ) ?>" >
	                      		<p>The Marks which this question would carry</p>
	                      		<div id='errorRPoints'></div>
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
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->instruction))? $questions->instruction : '' ) ?>">>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>Put some relevant instruction for examinees,if necessary</p>
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
						<p>The Marks which this question would carry</p>
							<table class="table table-bordered table-responsive">
							
								<thead>
									<tr>
										<th>#</th> <th>Questions
							
										</th>
										 <th>Matching pairs (Answers)
										
										 </th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($updType == 'edit'){

										$i=1;
										$option = json_decode($questions->options);
										$pair_option = json_decode($questions->que_option);
										$ans_series = json_decode($questions->correct_ans);
										
										$opt1_arr = array();
										$opt2_arr = array();
										foreach ($option as $st) {
										foreach ($st as $val) {
											array_push($opt1_arr, $val);
										}
									}
									foreach ($pair_option as $st) {
										foreach ($st as $val) {
											array_push($opt2_arr, $val);
										}
									}
									// print_r($opt1_arr);
									// print_r($opt2_arr);

									foreach(array_combine($opt1_arr, $opt2_arr) as $key => $value) {

											echo "
									<tr>
									 	<td>".$i."</td> 
									 	<td><input type='text' class='form-control' name='txtMatchque".$i."' id='txtMatchque".$i."' onblur='addAtributeRequired(".$i.")'";
									 	if($i==1 || $i==2){ echo "data-validation='required' data-validation-error-msg='Enter valid Question'";
									 	}
									 		echo " value='".$key."' > </td>
									 	<td><input type='text' class='form-control' name='txtMatchpair".$i."' id='txtMatchpair".$i."'";
									 	if($i==1 || $i==2){ echo " data-validation='required' data-validation-depends-on='txtMatchque".$i."' data-validation-error-msg='Enter valid Pair'";
									 	}
										echo " value='".$value."' ></td></tr>";
									 		$i++;
										}

									
									}
									else{
									 for ($i=1; $i <= 5; $i++) { 
										echo "
									<tr>
									 	<td>".$i."</td> 
									 	<td><input type='text' class='form-control' name='txtMatchque".$i."' id='txtMatchque".$i."' onblur='addAtributeRequired(".$i.")'";
									 	if($i==1 || $i==2){ echo "data-validation='required' data-validation-error-msg='Enter valid Question'";
									 	}
									 		echo " ></td>
									 	<td><input type='text' class='form-control' name='txtMatchpair".$i."' id='txtMatchpair".$i."'";
									 	if($i==1 || $i==2){ echo " data-validation='required' data-validation-depends-on='txtMatchque".$i."' data-validation-error-msg='Enter valid Pair'";
									 	}
									 	// 	echo " ></td> 
									 	// <td><input type='text' class='form-control' name='txtMatchpoints".$i."' id='txtMatchpoints".$i."' onkeypress='return isNumberKey(event)'";
									 	// if($i==1 || $i==2){ echo " data-validation='required' data-validation-depends-on='txtMatchpair".$i."' data-validation-error-msg='Enter valid score'";
									 	// }
									 		echo " >
									 	</td></tr>";
									 	}	
									 	}	
									?>
									
								</tbody>
							</table> 	 
						
							</div> 

					</form>
					
					</div>

				    <!--........................... True False.............................................. -->

					<div class="tab-pane <?php echo (($updType == 'edit' && @$questions->que_type == 'true_false') ? 'active' : ''); ?>" id="truefalse">

					<form action="<?php echo base_url();?>exams/questions" method='post' name='frmTrueFalse' id='frmTrueFalse' onsubmit='return truefalseSubmit()' novalidate >
						  <input type='hidden' name="updType" value='<?php echo $updType; ?>' >
						  <?php if($updType == 'edit') { ?>
						  <input type='hidden' name="que_id" value='<?php echo $questions->que_id; ?>' >
						  <?php } ?>

						<div class="panel-heading">
							<div class="panel-title" style="padding-bottom: 0px;">	
								<h3 style="margin-top: 0;">True or False</h3>
								<p style="margin-bottom: 0px;">This would be a question where the examinees would have to select either True or False as the answer.</p>
							</div>
							<div id="sticky-anchor2"></div>
							<div id="sticky2" class="panel-options">
								<input style="margin-top:2px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
								<a style="margin-top:0px;" href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
							</div>  
						</div>
						<hr style="margin-bottom:0px;">

						<div class="panel-body form-horizontal form-groups-bordered"> 
						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->que_tag)) ? $questions->que_tag : '' ) ?>">
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>Put a relavent keyword for better searchability during the selection of the question for the exam paper</p>
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
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='true_false' >
							</div>
							
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtTFQuestion"  name="txtTFQuestion"  class="form-control txteditor" rows="6" data-validation="required" data-validation-error-msg="Enter valid Question">
	                      			<?php echo (($updType == 'edit' && isset($questions->que_title)) ? $questions->que_title : '' ) ?></textarea>
	                      		<div id='errorTFQuestion'></div>
							<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<!--<span type="text" id="que2" class="tooltipicon" title="Click Here" style="margin-left: 421px;margin-top: -69px;"></span>-->
                        <span type="text" id="que2" class="tooltipicon" title="Click Here" style="margin-left: 421px;"></span>

						<span class="que2  tooltargetdiv" style="display: none;margin-left: 421px;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo 'Enter Question'; //echo lang('que_line');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="instruction">Instruction</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->instruction)) ? $questions->instruction : '' ) ?>" >
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>Put some relevant instruction for examinees,if necessary</p>
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
	                      		<input type='text' id="txtTFPoints" name="txtTFPoints" class="form-control" onkeypress="return isNumberKey(event)" data-validation="number" data-validation-error-msg="Enter valid Mark" value="<?php echo (($updType == 'edit' && isset($questions->que_marks)) ? $questions->que_marks : '' ) ?>" >

	                      		<p>The Marks which this question would carry</p>
	                      		<div id='errorTFPoints'></div>
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
							<div class="radio"> 
								<label><input type='radio' name="rbTrueFalse" value='1' id='txtTrue' <?php echo (($updType == 'edit' && @$questions->correct_ans == '1') ? 'checked' : '' ) ?> > True</label> 
							</div> 
							<div class="radio"> 
								<label> <input type='radio' name="rbTrueFalse" value='0' id='txtFalse' <?php echo (($updType == 'edit' && @$questions->correct_ans == '0') ? 'checked' : '' ) ?> > False</label> 
							</div> 

	                      		<div id='errorTFAnswer'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
		                      		<span class="tooltipcontainer">
									<span type="text" id="que-correct3" class="tooltipicon" title="Click Here"></span>
									<span class="que-correct3  tooltargetdiv" style="display: none;">
									<span class="closetooltip" ></span>
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
					
					</div>

					<!--........................... subjective.............................................. -->
					<div class="tab-pane <?php echo (($updType == 'edit' && @$questions->que_type == 'subjective') ? 'active' : ''); ?>" id="subjective"> 

					<form action="<?php echo base_url();?>exams/questions" method='post' name='frmsubjective' id='frmsubjective' onsubmit='return subjectiveSubmit()' novalidate >
						  <input type='hidden' name="updType" value='<?php echo $updType; ?>' >	
						  <?php if($updType == 'edit') { ?>
						  <input type='hidden' name="que_id" value='<?php echo $questions->que_id; ?>' >
						  <?php } ?>

					<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h3 style="margin-top: 0;">Subjective</h3>
							<p style="margin-bottom: 0px;">Subjective Questions will enable the students to provide long and detailed answers in response to your question</p>
						</div>
						<div id="sticky-anchor3"></div>
						<div id="sticky3" class="panel-options">
							<input style="margin-top:2px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a style="margin-top:0px;" href="<?php echo base_url();?>questions/" class="btn btn-danger">Cancel</a>
						</div>  
					</div>
					<hr style="margin-bottom:0px;">

					<div class="panel-body form-horizontal form-groups-bordered"> 
						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->que_tag)) ? $questions->que_tag : '' ); ?>">
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='subjective' >
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>
							Put a relevant keyword for better searchability during the selection of the question for the exam paper
							</p>
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
							
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Subjective Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtSubjective"  name="txtSubjective"  class="form-control txteditor" rows="6" data-validation="required" data-validation-error-msg="Please enter valid question" >
	                      			<?php echo (($updType == 'edit' && isset($questions->que_title)) ? $questions->que_title : '' ); ?>
	                      		</textarea>
	                      		<input name="image" type="file" id="upload" class="hidden" onchange="">
	                      		<div id='errorSQuestion'></div>
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
							<div class="col-sm-7">							
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->instruction)) ? $questions->instruction : '' ); ?>" >
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>
							Put some relevant instruction for examinees,if necessary
							</p>
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

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Score</label>							
							<div class="col-sm-7">							
	                      		<input type='text' id="txtPoints" name="txtPoints" onkeypress="return isNumberKey(event)" class="form-control" data-validation="required" data-validation-error-msg="Please enter valid score" value="<?php echo (($updType == 'edit' && isset($questions->que_marks)) ? $questions->que_marks : '' ); ?>" >
	                      		<div id='errorSPoints'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>
							The Marks which this question would carry
							</p>
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

					</div>
					
					</form>
					
					</div>

					<!--........................... Multiple Choice.............................................. -->
					<div class="tab-pane <?php echo (($updType == 'edit' && @$questions->que_type == 'multiple_choice') ? 'active' : ''); ?>" id="multipletype"> 

					<form action="<?php echo base_url();?>exams/questions" method='post' name='frmMultiple' id='frmMultiple' onsubmit='return multipleTypeSubmit()' novalidate >
						  <input type='hidden' name="updType" value='<?php echo $updType; ?>' >
						  <?php if($updType == 'edit') { ?>
						  <input type='hidden' name="que_id" value='<?php echo $questions->que_id; ?>' >
						  <?php } ?>

						<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h3 style="margin-top: 0;">Multiple Choice</h3>
							<p style="margin-bottom: 0px;">This would be a multiple choice question having more than one correct answer.</p>
						</div>
						<div id="sticky-anchor4"></div>
						<div id="sticky4" class="panel-options">
							<input style="margin-top:2px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a style="margin-top:0px;" href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
						</div>  
					</div>
					<hr style="margin-bottom:0px;">

					<div class="panel-body form-horizontal form-groups-bordered"> 

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->que_tag)) ? $questions->que_tag : '' ); ?>" >
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>Put a relevant keyword for better searchability during the selection of the question for the exam paper</p>
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
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='multiple_choice' >
							</div>
							
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question for multiple answers</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtMTQuestion" name="txtMTQuestion" class="form-control txteditor" rows="6"  ><?php echo (($updType == 'edit' && isset($questions->que_title)) ? $questions->que_title : '' ); ?></textarea>
	                      		<div id='errorMLTQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<!--<span class="tooltipcontainer" style="margin-left: 417px;margin-top: -67px;"  required>-- >
                                <span class="tooltipcontainer" style="margin-left: 417px;">

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
							<label class="col-sm-3 control-label" for="points">Enter Marks</label>							
							<div class="col-sm-5">							
	                      		<input type='number' id="txtPoints" name="txtPoints" class="form-control" onkeypress="return isNumberKey(event)"  data-validation="number" data-validation-error-msg="Enter valid Marks" value="<?php echo (($updType == 'edit' && isset($questions->que_marks)) ? $questions->que_marks : '' ); ?>">
	                      		<p>The Marks which this question would carry</p>
	                      		<div id='errorRPoints'></div>
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
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->instruction)) ? $questions->instruction : '' ); ?>" >
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>Put some relevant instruction for examinees,if necessary</p>
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
					<div id='errorROptions1'></div> 
					<div class="panel-body with-table">
						<p>The Marks which this question would carry</p>
						<table class="table table-bordered table-responsive">
						

							<thead>
									<tr>
										<th>#</th> 
										<th>Options</th> 
										<th>Check corrected answer</th>
										<!--  <th>Score</th> -->
									</tr>
								</thead>
								<tbody>
									<?php 
									if($updType == 'edit'){
										$i=1;
										$reg_option = json_decode($questions->options);
										$ans_series = json_decode($questions->correct_ans);
									 	
									foreach ($reg_option as $st) {
										foreach ($st as $val) {
										echo "
									<tr>
									 	<td>".$i."</td>
									 	<td><input type='text' class='form-control' name='txtMultiOpt".$i."' id='txtMultiOpt".$i."'";
									 	if($i==1 || $i==2){ echo " data-validation='required' data-validation-error-msg='Enter valid Option'";
									 		}

									 		echo "value='".$val."' onblur='addAtributeRequiredMultiple(".$i.")'>
									 		</td>
									 	<td><input type='checkbox' name='chkMulti".$i."' id='chkMulti".$i."'";
									 	if (in_array($i, $ans_series))
									 		{	echo 'checked';	}
									 	echo " ></td> 
									 	
									</tr>";
										
										$i++;	
										}

									}
									}
									else{
									 for ($i=1; $i <= 5; $i++) { 
										echo "
									<tr>
									 	<td>".$i."</td>
									 	<td><input type='text' class='form-control' name='txtMultiOpt".$i."' id='txtMultiOpt".$i."'";
									 	if($i==1 || $i==2){ echo " data-validation='required' data-validation-error-msg='Enter valid Option'";
									 		}
									 		echo " onblur='addAtributeRequiredMultiple(".$i.")'></td>
									 	<td><input type='checkbox' name='chkMulti".$i."' id='chkMulti".$i."'  ></td> 
									 	
									</tr>";

									// <td><input type='text' class='form-control' name='txtMultiPoints".$i."' id='txtMultiPoints".$i."' onkeypress='return isNumberKey(event)' ></td>

										} 
									}   ?>

									
								</tbody>
							</table>	 

						</div> 
						</form>
					</div>		

					<!--........................... Media Questions.............................................. -->
					<div class="tab-pane <?php echo (($updType == 'edit' && @$questions->que_type == 'media_type') ? 'active' : ''); ?>" id="mediaquestion">

					<form action="<?php echo base_url();?>exams/questions" method='post' name='frmMedia' id='frmMedia'  enctype="multipart/form-data" onsubmit='return mediaTypeSubmit()' novalidate >
						  <input type='hidden' name="updType" value='<?php echo $updType; ?>' >
						  <?php if($updType == 'edit') { ?>
						  <input type='hidden' name="que_id" value='<?php echo $questions->que_id; ?>' >
						  <?php } ?>

					<div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h3 style="margin-top: 0;">Media Question</h3>
							<p style="margin-bottom: 0px;">This would be a multiple choice question having one correct answer and the question would consist of any video, image etc. With the texts.</p>
						</div>
						<div id="sticky-anchor5"></div>
						<div id="sticky5" class="panel-options">
							<input style="margin-top:2px;" type='submit' name='btnSave' id='btnSave' class="btn btn-success" value='Save'>
							<a style="margin-top:0px;" href="<?php echo base_url();?>index.php/questions/" class="btn btn-danger">Cancel</a>
						</div>  
					</div>
					<hr style="margin-bottom:0px;">

					<div class="panel-body form-horizontal form-groups-bordered"> 

					<div class="form-group">						
							<label class="col-sm-3 control-label" for="question">Enter Question Tag</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtQuestionTag" name="txtQuestionTag" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->que_tag)) ? $questions->que_tag : '' ); ?>" >
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>Put a relevant keyword for better searchability during the selection of the question for the exam paper</p>

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
	                      		<input type='hidden' id="txtQuestionType" name="txtQuestionType" value='media_type' >
							</div>
							
						</div>

						<div class="form-group">		
							<label class="col-sm-3 control-label" for="question">Enter Question</label>							
							<div class="col-sm-5">							
	                      		<textarea id="txtMediaQuestion" name="txtMediaQuestion" class="form-control txteditor" rows="6" required>
	                      			<?php echo (($updType == 'edit' && isset($questions->que_title)) ? $questions->que_title : '' ); ?>
	                      		</textarea>
	                      		<div id='errorMedQuestion'></div>
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que6" class="tooltipicon" title="Click Here"></span>

						<span class="que6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php // echo 'Enter Question'; //echo lang('que_line');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
							</div>
						</div>

						<div class="form-group">						
							<label class="col-sm-3 control-label" for="points">Enter Marks</label>							
							<div class="col-sm-5">							
	                      		<input type='text' id="txtMedPoints" name="txtPoints" class="form-control" onkeypress="return isNumberKey(event)" value="<?php echo (($updType == 'edit' && isset($questions->que_marks)) ? $questions->que_marks : '' ); ?>" required >
	                      		<div id='errorMedPoints'></div>
	                      		<p>The Marks which this question would carry</p>
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
	                      		<input type='text' id="txtInstruction" name="txtInstruction" class="form-control" value="<?php echo (($updType == 'edit' && isset($questions->instruction)) ? $questions->instruction : '' ); ?>" >
	                      		<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<p>Put some relevant instruction for examinees,if necessary</p>
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
	                      		<!--<input type='file' id="flMedia" name="flMedia" class="form-control" >-->
	                      		<?php if(($updType == 'edit' && isset($questions->que_attachment)))
	                      		{
	                      			echo "<img src='".base_url()."public/uploads/questions/".$questions->que_attachment."' width='200' >";
	                      			echo "<input type='hidden' name='file_nm' value='".$questions->que_attachment."' >";

	                      		} ?>
	                      		<input type='file' id="file_i" name="file_i" class="form-control" accept="audio/*,video/*,image/*" value="<?php echo (($updType == 'edit' && isset($questions->que_attachment)) ? $questions->que_attachment : '' ); ?>" <?php echo (($updType == 'create') ? 'required' : ''); ?> >
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
							<h3 style="margin-bottom: 0;">Enter the option of answers for above question</h3>
						</div> 
					</div>
					<div id='errorMedOptions'></div> 
					<div class="panel-body with-table">

						<table class="table table-bordered table-responsive">
						<thead>
									<tr>
										<th>#</th> <th>Options
										<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span class="tooltipcontainer">

						<span type="text" id="que-option6" class="tooltipicon" title="Click Here"></span>

						<span class="que-option6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_option');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th> 
										<th>Check the correct answer
											<!-- @@@@@tooltip start@@@@@@@@ -->
	                      		<span style="display: none;" class="tooltipcontainer">

						<span type="text" id="que-correct6" class="tooltipicon" title="Click Here"></span>

						<span class="que-correct6  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->	

						<?php echo lang('que_correct');?>

						<!--/tip containt-->

						</span>

						</span>
						<!-- @@@@@@@@@@@@ tooltip end @@@@@@@@ -->
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if($updType == 'edit'){
										$i=1;
										$reg_option = json_decode($questions->options);
									foreach ($reg_option as $st) {
										foreach ($st as $val) {

										echo "
											<tr>
											 	<td>".$i."</td>
											 	<td><input type='text' class='form-control' name='txtMediaOpt".$i."' id='txtMediaOpt".$i."'";
											 	if($i==1 || $i == 2){ echo " data-validation='required' data-validation-error-msg='Enter valid Option'"; }

											 	echo " value='".$val."' ></td>
											 	<td><input type='checkbox' name='chkMedia".$i."' id='chkMedia".$i."'";

											 	if($i == $questions->correct_ans) { 
											 		echo 'checked'; } 
											 	echo "></td> 
											</tr>";	
										$i++;	
										}

									}
									}
									else{ 
									for ($i=1; $i <= 5; $i++) { 
										echo "
									<tr>
									 	<td>".$i."</td>
									 	<td><input type='text' class='form-control' name='txtMediaOpt".$i."' id='txtMediaOpt".$i."'";
									 	if($i==1 || $i == 2){ echo " data-validation='required' data-validation-error-msg='Enter valid Option'"; }
									 	echo " ></td>
									 	<td><input type='checkbox' name='chkMedia".$i."' id='chkMedia".$i."' ></td> 
									</tr>";
										} 
									}	?>

									
								</tbody>

						</table> 	 

					</div> 

						</form>
					</div>
					<!--........................... Media Questions End.............................................. -->
				</div>
				</div>	


			
		</div> 
	</div> 



      
			
		




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
//	jQuery('.tooltipicon').click(function(){
//		
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
	//var txtque =  tinymce.get('txtRegQuestion').getContent();
	if(tinymce.get('txtRegQuestion').getContent() == '')
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

	if(tinymce.get('txtRQuestion').getContent() == '')
	{
		document.getElementById('errorRQuestion').innerHTML = "<font color='red'>Please Enter Question!</font>";
		return false;
	}

	if(document.getElementById('txtMatchque1').value == '' || document.getElementById('txtMatchque2').value == '' || document.getElementById('txtMatchpair1').value == '' || document.getElementById('txtMatchpair2').value == '' || document.getElementById('txtMatchpoints1').value == '' || document.getElementById('txtMatchpoints2').value == '')
	{		
		document.getElementById('errorMctOptions').innerHTML = "<font color='red'>Please Fill proper information!</font>";
		return false;
	}

	return true;	
}

function truefalseSubmit()
{	
	
	if(tinymce.get('txtTFQuestion').getContent() == '')
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
	if(tinymce.get('txtSubjective').getContent() == '')
	{
		document.getElementById('errorSQuestion').innerHTML = "<font color='red'>Please Enter Question!</font>";
		return false;
	}
	if(document.getElementById('txtPoints').value == '')
	{
		
		// document.getElementById('errorSPoints').innerHTML = "<font color='red'>Please Enter Score1!</font>";
		// return false;
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

function addAtributeRequiredMultiple(txtNo)//for Multiple Choice
{
	if(document.getElementById('txtMultiOpt'+txtNo).value != '')
	{
		document.getElementById('txtMultiPoints'+txtNo).setAttribute("required", "require");
	}else
	{
		document.getElementById('txtMultiPoints'+txtNo).removeAttribute("required");
	}
}

function multipleTypeSubmit()//form validation for Multiple Choice form
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
	

		var txtMultiOpt1 = document.getElementById('txtMultiOpt1').value;
		var txtMultiOpt2 = document.getElementById('txtMultiOpt2').value;
	
	if(tinymce.get('txtMTQuestion').getContent() == '')
	// if(document.getElementById('txtMTQuestion').value == '')
	{
		document.getElementById('errorMLTQuestion').innerHTML = "<font color='red'>Please Enter Question</font>";
		return false;
	}

	if(countCheck == 0)
	{   
		document.getElementById('errorROptions1').innerHTML = "";
		document.getElementById('errorROptions1').innerHTML = "<font color='red'>Invalid Data : Please check any one option which is right answer</font>";
		return false;
	}

	if(document.getElementById('txtMultiOpt1').value == '' || document.getElementById('txtMultiOpt2').value == '' || document.getElementById('txtMultiPoints1').value == '' || document.getElementById('txtMultiPoints2').value == '')
	{		
		document.getElementById('errorROptions1').innerHTML = "";
		document.getElementById('errorROptions1').innerHTML = "<font color='red'>Please Fill proper information!</font>";
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

// if(document.getElementById('txtMediaQuestion').value == '')

	// var txtque = tinymce.get('txtMediaQuestion').getContent();
	// if(txtque == '')
	if(tinymce.get('txtMediaQuestion').getContent() == '')
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


<!-- hh<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> -->

<script src="<?php echo base_url();?>public/js/Form-Validator/form-validator/jquery.form-validator.min.js"></script>
<script type="text/javascript"> 

$.validate({
	errorElementClass:"validateerrorbox",
	errorMessageClass:"validateerror",
	borderColorOnError:"red",
	//errorMessagePosition:"top",
	 modules : 'logic',
});  
  
    </script>

<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>
   tinymce.init({ 
   selector : "#txtSubjective, .txteditor",
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