<link rel="stylesheet" type="text/css" href="/public/js/exam/exam.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
   <script src="<?php echo base_url() ?>public/js/form-master/jquery.form.js"></script> 

<script src="<?php echo base_url(); ?>public/js/exam/exam.js"></script>

<style type="text/css">
	textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{
		width: 220px;
	}

.paradesc{
	float: left!important;
	font-size: 12px!important;
}
label{
	float: left;
	width: 130px;
	font-size: medium;
}
.full-label{
	width: 100%;
	float: left;
	text-align: left!important;
}
</style>
<style type="text/css">

.validateerror {
   float: left;
   text-align: center;
   width: 40%;
   margin-left: 235px;
   color: red;
}
.help-block {
   display: block;
   width: 100% !important;
   margin: 0 -229px auto !important;
}

.validateerrorbox
{
	border-color: red !important;
}
div#preview_modal {
    margin: 0px auto;
    width: auto;
    max-width: 70%;
    height: auto;
    max-height: 80%;
}
</style>

<script type="text/javascript">
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



<!--/lightbox scripts and style ------------------------ -->

<div>
    <h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>

    <?php if($updType != 'edit'){

	$qid = '';

	}?>



<span class="clearFix">&nbsp;</span>
</div>

<header>
	<section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>
            <?php echo (($updType == 'edit')?'Edit Exam':'Create Exam');?> </h2>
        </div>
      </div>
    </div>
  </section>
</header>
<!-- The Modal -->
  <div class="modal fade" id="preview_modal">
    <div class="modal-dialog exam_preview modal-dialog-centered modal-lg">
    	<button type="button" class="close exam_preview_close_btn" data-dismiss="modal" id="popclose">&times;</button>
        <!-- Modal body -->
        <div class="modal-body">
        	
        </div>
      </div>
    </div>

<div class="page-container">
<?php

    $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?>  

<div class="main-content" style="min-height: 820px;">
	<div class="row">
<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top:5px; margin-right:20px; margin-bottom:10px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>
<div id="mySidenav" class="sidenav exam-txt">
			  <a href="javascript:void(0)" class="closebtn" >&times;</a>

<div style="float: right"><button class='deletebtn' type='button' id="" ><img src='/public/css/image/delete.3f3ed9f0.png' border='0' alt='Delete page' title='Delete page'></button></div>

		<div id="variety" class="two_btn">
			<a id="setmanual" class="set-manual_btn">Set manually</a>
			<a id="setexist" class="set_form_btn">Set Form Question Pool</a>
		</div>
		<div id="Qexist" style="display: none">
			<?php echo $this->load->view('exams/quesetting'); ?>
				<div class="instrctn_btn123 view-que">
					<button class="getQues exit_btn123" type="button">View Questions</button>
					<button id="addselected" class="exit_btn123" type="button" >Add Selected Questions</button>
				</div>
			<div id='SortQlist'>
				<TABLE id="dataTable" border="1">
			    <tr>
			        <th>
			            <INPUT type="checkbox" onchange="checkAll(this)" name="chk[]" />
			        </th>
			        <th>Select All Question</th>
			    </tr>
				</TABLE>
			</div>

		</div>
		<div id="Qform">
			<?php  echo $this->load->view('exams/addquestion'); ?>
		</div>
		<div id="sectab">
			<!-- <div class="create-question-style">
			   <h2 class="que-h2-style" style='padding-left: 10px;'>Create Page Section</h2>
			</div> -->
			<h2 class="sidebar_title">Section</h2>
			<div class="sidebar_gap">
				<label class="col-sm-12 no-padding">Section title</label>
				<input class="col-sm-7 no-padding tempinput" id="secTitle" placeholder="Section title" ><br><br>
				<label class="col-sm-12 no-padding">Section Description</label><br><br><br>
				<textarea id="secDesc" name="txtQuestion" class="form-control  tempinput editordesc" rows="6"/></textarea>
				<!-- <input class="col-sm-7 tempinput" id="secDesc" placeholder="Optional description" > -->

				<!-- ****** -->
				<div style="display: none;" id="autoQuetab">
					<?php echo $this->load->view('exams/quesetting_sec'); ?>

						
				</div>
			</div>
		</div>
		<div id="pagetab">
			<!-- <div class="create-question-style">
				<h2 class="que-h2-style" style='padding-left: 10px;'>Create Exam Page</h2>
			</div> -->
			<h2 class="sidebar_title">Page</h2>
			<div class="sidebar_gap">	
			<label class="col-sm-12 no-padding">Page title</label>
			<input class="col-sm-12 no-padding tempinput" id="pageTitle" placeholder="Page title" ><br><br>
			<label class="col-sm-12 no-padding">Page Description</label><br><br><br>
			<textarea id="pageDesc" name="txtQuestion" class="form-control tempinput editordesc" rows="6"/></textarea>
			<!-- <input class="col-sm-12 tempinput" id="pageDesc" placeholder="Optional description" > -->


			</div>
		</div>
		
	</div>


<?php
$attributes = array('class' => 'tform', 'id' => 'examsubmitid');
echo ($updType == 'create') ? form_open_multipart(base_url().'exams/exam_submit', $attributes) : form_open_multipart(base_url().'exams/edit/'.$qid, $attributes);
?>

<input type="hidden" name="exam_category" id="exam_category">
<div id="sticky-anchor"><div class='totshow'><h2><b>Total Marks : <span> <?php echo (isset($quiz)) ? $quiz->total_marks : '0'; ?> </span><input value="0" name="total_marks" class='totmk' type="hidden"> </b></div>
</div>
<div id="sticky" class="">
<?php if ($updType == 'create'): ?>
<?php if ($parent_id != "0"): ?>
	<?php
	if($this->session->userdata('addExamToCourse'))
	{
		?>
		<a href='<?php echo base_url().$this->session->userdata('addExamToCourse');?>' style="float: right;" class='btn btn-danger'>Cancel</a>
		<?php
	}else
	{
		?>
		<a href='<?php echo base_url(); ?>manage-exams' style="float: right;" class='btn btn-danger'>Cancel</a>
		<?php
	}
	?>
<?php else: ?>
<a href='<?php echo base_url(); ?>quizzes/<?php echo $page?>/' style="float: right;" class='btn btn-danger'>Cancel</a>
<?php endif ?>
<?php else: ?>
<?php if ($qid != "0"): ?>

    	<a href='<?php echo base_url(); ?>manage-exams' style="float: right;" class='btn btn-danger'>Cancel</a>

	    <?php else: ?>

	    	 <a href='<?php echo base_url(); ?>quizzes/newque/<?php echo $page?>/' style="float: right;" class='btn btn-dangers'>Cancel</a>

	    <?php endif ?>

    <?php endif ?>

 <a style="float: right; margin-right:10px; margin-top: 2px;">
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?>
            </a> 
  <a href="#" id="getpreview" style="float: right; margin-right:10px; margin-top: 4px;" class="btn btn-info" data-toggle="modal" data-target="#preview_modal">Preview</a>
</div>
<div>
<span class="clearFix"> </span>
</div>
			<div class="clr"></div>

<hr />



<div>
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active general">
				<a href="#home" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">General</span>
				</a>
			</li>
			<li>
				<a href="#Questions" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Questions</span>
				</a>
			</li>
			<!--<li>
				<a href="#messages" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-mail"></i></span>
					<span class="hidden-xs">Publishing</span>
				</a>
			</li>
			<li>
				<a href="#settings" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Settings</span>
				</a>
			</li>-->
		</ul>
		
<div class="tab-content">

<div class="tab-pane active" id="home">
				
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
	<div class="scrollable" data-height="120" style="overflow: hidden; width: auto; height: auto;">
					
         <!-- class="<?php echo ($questions)?'':'selected' ?>"  -->
 <dd>           
        <div>
		
		<div class="" data-collapsed="0">		
			 <legend style="font-size:14px; color: #09C; font-weight:bold; text-transform: uppercase;">New Exam</legend>
			<div class="panel-body form-horizontal form-groups-bordered" style="padding-left:6%;">
				
				
                <?php if($updType == 'create'){ ?>
				<!--<legend style="font-size: 16px; color: #c42140;">New Exam</legend>-->
                
				<?php } ?>
				<?php if($updType == 'edit'){ ?>
				<!--<legend style="font-size: 16px;">Edit Exam</legend>-->
                <legend style="color: #09c; font-size: 14px; font-weight: bold; text-transform: uppercase;">Edit Exam</legend>
				<?php } ?>
                <input id="exam_id" type="hidden" class="" name="exam_id" maxlength="256" value="<?php echo (isset($quiz->exam_id) ? $quiz->exam_id : '0'); ?>" >

					<div class="form-group">
						
						<label for="name"><?php echo lang('web_name')?>
						<span class="required">*</span></label>
						<div class="col-sm-9">
							
                           <input id="ex_name" type="text" class="" name="name" maxlength="256" value="<?php echo set_value('name', (isset($quiz->exam_title)) ? $quiz->exam_title : ''); ?>"   data-validation-error-msg="Enter valid exam name." />

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_name-target" class="tooltipicon"></span>

						<span class="reg_quizz_name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-name');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->



                    <span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>

                   
					
					<div class="form-group">
						
						<label for="description"><?php echo lang('web_description')?></label>


						<div class="col-sm-9">
							
                             <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''));?>



                      	<textarea id="description"  name="description"  class="ex-desc" rows="6"/><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>
                      	<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_desc-target" class="tooltipicon"></span>

						<span class="reg_quizz_desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-description');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>

                                     
                    <div class="form-group">
						<label>Exam Type</label>
						
						
							<div class="radio-set radioGraySet">
                                <span class="radio radio-inline" style="margin-right: 20px">
                                    <input type="radio" class="extype" id="practice" name="exam_type"
                                     value="1" <?php echo ($quiz->exam_type==1) ? 'checked' : ''; ?> > Try and Learn</span> 
                                <span class="radio radio-inline">
                                    <input type="radio" class="extype" id="term" name="exam_type" value="2" <?php echo ($quiz->exam_type==2) ? 'checked' : ''; ?> >Regular Exam</span>
                                    <br>    
                                <p style="display: <?php echo ($quiz->exam_type==1) ? 'block' : 'none'; ?>" class="type_info practice">
                                	This is like a practice test and can be used to give learners a tool to check out their level of knowledge adequacy. 
                                </p>
                                <p style="display: <?php echo ($quiz->exam_type==2) ? 'block' : 'none'; ?>" class="type_info term">This is a test given to students during the course of study or training. Although the term can be used in the context of  training.</p>
                            </div>
					 <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="quiz_type-target" class="tooltipicon"></span>

						<span class="quiz_type-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo 'Select Exam Type'; //echo lang('quizz_fld_regular-show_countdown');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->




						
                       
					</div>

					

                    <div class="form-group">
	                        <label>Instructions</label>
	                        <span>(Give clear instructions for your exam)</span>
	                        <div class="col-sm-9"> 
	                        <textarea style="width: 100%" name="instructions" rows="4"><?php echo ($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($quiz->instructions)) ? $quiz->instructions : ''); ?></textarea></div>
                	</div>
                  <div class="form-group">

                    <div class="col-sm-6">
                        <label>Passing Score <i>*</i></label>
                        
                        <div>
                        <input required="" class="" name="pass_score" id="pass_score" type="number" min="0" max="100" value="<?php echo $quiz->passing_score ? $quiz->passing_score : ''; ?>" style="width: 100px;background-image: url('/public/images/images/percent3.jpg');background-repeat: no-repeat;background-position: center right 30%"><br><span>(Give the passing score for your exam.The passing score must be a positive number and cannot be greater than 100.)</span>
                        <!-- ngIf: validateForm.pass_score.$invalid && !validateForm.pass_score.$pristine -->
                        <!-- <span class="tooltipcontainer">

						<span type="text" id="pass_score-target" class="tooltipicon"></span>

						<span class="pass_score-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip" ></span>

						 The passing score must be a positive number and cannot be greater than 100.

						</span>

						</span> -->
						</div>

                    </div>
                    	<div class="col-sm-6">  
                         <label>Publish</label>
							<div class="checkbox">
                            <?php //$published = ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''; ?>
								<label class="cb-wrapper" style="margin-bottom:0; width:auto;">
                                <input id="published" type="checkbox" name="published" value='1' <?php echo (isset($quiz->published)) ? "checked" : ''?> <?php echo $updType == 'create' ? 'checked' :''; ?> />
                              
                                </label>
								
								<label class='labelforminline' for='published' style="margin-bottom:0; width:auto;">Published</label>

								<?php echo form_error('published'); ?>
								<!-- <span class="tooltipcontainer">

						<span type="text" id="reg_quizz_published-target" class="tooltipicon"></span>

						<span class="reg_quizz_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

				

						<?php echo lang('quizz_fld_regular-published-active');?>


						</span>

						</span> -->
							</div>
						

						


						</div>
                </div>
					
                	<div class="form-group">
	                    <div class="col-sm-6">
	                        <label class="full-label">Feedback / Pass <i>*</i>
	                        <span>(Feedback for students if they pass)</span></label>
	                        <textarea required=""  name="pass_feedback" rows="4" ><?php echo ((isset($quiz->pass_feedback)) ? $quiz->pass_feedback : 'Congratulations, you passed.'); ?></textarea>
	                        <!-- ngIf: validateForm.pass.$invalid && !validateForm.pass.$pristine -->
	                    </div>
	                   <div class="col-sm-6">
	                        <label class="full-label">Feedback / Fail <i>*</i>
	                        <span>(Feedback for students if they fail)</span></label>
	                        <textarea required="" name="fail_feedback" rows="4" ><?php echo ((isset($quiz->fail_feedback)) ? $quiz->fail_feedback : 'Sorry, you failed.'); ?></textarea>
	                        <!-- ngIf: validateForm.fail.$invalid && !validateForm.fail.$pristine -->
	                    </div>
                  	</div>
                    <div class="form-group">
                    	<div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Show Score Realtime</label>
                            <span>(Students can see their score after each answer. If 'Yes' students won't be able to go back and change answers)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="view_score_realtime" value="1" <?php echo ($quiz->view_score_realtime==1) ? "checked" : ($updType == 'create') ? 'checked' :''; ?> > Yes </label>
                                <label class="radio">
                                    <input type="radio" name="view_score_realtime"  value="0" <?php echo ($quiz->view_score_realtime==0) ? "checked" : ($updType == 'create') ? 'checked' :''; ?> > 
                                No </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Order of questions</label>
                            <span>(Questions will appear in the order you choose)<br>&nbsp;</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="order_type"  value="1" <?php echo ($quiz->order_type==1) ? "checked" : ($updType == 'create') ? 'checked' :''; ?> > Static                                </label>
                                <label class="radio">
                                    <input type="radio" name="order_type" value="0" <?php echo ($quiz->order_type==0) ? "checked" : ($updType == 'create') ? 'checked' :''; ?> > Random                                </label>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Students can skip Questions</label>
                            <span>(Students can skip a question and answer it by going back before submitting the exam)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="skip" value="1" <?php echo (($quiz->skip==1) ? "checked" : ''); ?> > Yes                                </label>
                                <label class="radio">
                                    <input type="radio" name="skip" value="0" <?php echo (($quiz->skip==0) ? "checked" : ''); ?> > No                                </label>
                            </div>
                        </div>
                    </div>  
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Students can retake the exam</label>
                            <span>(Students can retake the exam to improve their score)<br>&nbsp;</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" class="retake" name="retake" value="1" <?php  echo (($quiz->retake==1) ? "checked" : ''); ?> > Yes                                </label>
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" class="retake" name="retake" value="0" <?php  echo (($quiz->retake==0) ? "checked" : ''); ?> > No                                </label>
                               
                                    <div id="times" style="text-align: center;padding: 0px;margin: 0px;float: left;display: <?php  echo (($quiz->retake==1) ? 'block' : 'none'); ?> ">
                                        <select name="attempt_limit" style="margin-left: 10px">
                                        	<option value="11" <?php echo (($quiz->attempt_limit == '11') ? 'selected' : ''); ?> >Unlimited times</option>
                                   <?php for ($i=2; $i <=10; $i++) { 
                                        	
                                        	echo '<option value='.$i.' '.(($quiz->attempt_limit == $i) ? 'selected' : '').' >'.$i.' times</option>';	
                                        	} ?>
                                       
                                            
                                        </select>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Exam has Time Limit</label>
                            <span>(Students have to finish the exam within this time limit)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input  type="radio" name="time_limit_b" value="1" class="exam_time" <?php  echo (($quiz->time_limit_b==1) ? "checked" : ''); ?> > Yes</label>
                                <label class="radio">
                                    <input type="radio" name="time_limit_b" value="0" class="exam_time" <?php  echo (($quiz->time_limit_b==0) ? "checked" : ''); ?> > No </label>
                                <!-- ngIf: exam.time_limit_b == 1 -->
                            </div>

                            
                        </div><br>
                        <div class="row" id="exam_time" style="padding-top: 20px;margin-bottom: 0px;display: <?php  echo (($quiz->time_limit_b==1) ? 'block' : 'none'); ?>" >
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px;float: left;">
                                        <input name="duration_h" hours-only="" type="text" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->duration_h)) ? $quiz->duration_h : ''); ?> " ><br>Hours                           
                                    </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0pxfloat: left;">
                                        <input name="duration_m" minutes-only="" type="text" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->duration_m)) ? $quiz->duration_m : ''); ?> " ><br>Minutes                         
                                    </div>
                            </div>
                    </div>
                    <div class="col-xs-6 form-inline">
                            <label class="full-label">Waiting Period</label>
                            <span>(The period students have to wait before they can retake the exam)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="wait_b" value="1" class="wait_time" <?php  echo (($quiz->wait_b==1) ? "checked" : ''); ?> > Yes </label>
                                <label class="radio">
                                    <input type="radio" name="wait_b" value="0" class="wait_time"  class="wait_time" <?php  echo (($quiz->wait_b==0) ? "checked" : ''); ?> > No </label>
                                
                        </div><br>
                        <div class="row" id="wait_time" style="padding-top: 20px;margin-bottom: 0px;display: <?php  echo (($quiz->wait_b==1) ? 'block' : 'none'); ?>" >
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px;">
                                        <input name="wait_w" type="text"  weeks-only="" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->wait_w)) ? $quiz->wait_w : ''); ?> " ><br>Weeks                                   
                                         </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px">
                                        <input name="wait_d" type="text" days-only="" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->wait_d)) ? $quiz->wait_d : ''); ?> " ><br>Days                                    
                                    </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px">
                                        <input name="wait_h" type="text"  hours-only="" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->wait_h)) ? $quiz->wait_h : ''); ?> " ><br>Hours                                   
                                    </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px">
                                        <input name="wait_m" type="text" minutes-only="" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->wait_m)) ? $quiz->wait_m : ''); ?> " ><br>Minutes                                    
                                    </div>
                                </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Score after submitting exam</label>
                            <span>(Student can see score after submitting the exam)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="see_result"  value="1" <?php  echo (($quiz->see_result==1) ? "checked" : ''); ?>> Yes</label>
                                <label class="radio">
                                    <input type="radio" name="see_result" value="0" <?php  echo (($quiz->see_result==0) ? "checked" : ''); ?> > No </label>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Answers Visibility</label>
                            <span>(Student can see answers only once, after submitting the exam)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input  type="radio" name="show_right_answers" value="1" <?php  echo (($quiz->show_right_answers==1) ? "checked" : ''); ?> > Yes </label>
                                <label class="radio">
                                    <input type="radio" name="show_right_answers" value="0" <?php  echo (($quiz->show_right_answers==0) ? "checked" : ''); ?> >  No  </label>

                            </div>
                        </div>
                    </div>
                </div>


				</form>	
			<div id="btnQues">
				<a href="#Questions" class="Qselect autobtn btn">Auto Set Exam Questions</a>
				<a href="#Questions" class="Qselect manualbtn btn">Manually create Exam Questions</a>
			</div>			
			</div>		
		</div>	
	</div>                    
</dd>
</div>
</div>
</div>
<input type="hidden" name="exam_category" id="exam_category" value="<?php echo isset($quiz) ? $quiz->exam_category : '' ?>" >            

  <?php 
  $this->load->model('exam_model');       

  // $que_list = $this->exam_model->getQues($quiz->exam_id);

   // $page_list = $this->exam_model->get_pages($quiz->exam_id);
  	// 		// print_r($page_list);
  	// for ($i=1; $i <= $page_list; $i++) 
  	// { 

  	// 	$sec_list = $this->exam_model->get_section($quiz->exam_id, $i);

  	// 	for ($j=1; $j <= $sec_list; $j++) 
  	// 	{
  	// 		$que_list = $this->exam_model->get_Ques($quiz->exam_id, $i, $j);

  	// 	}
  	// }
?>
<div class="tab-pane" id="Questions">
	 <!-- class="<?php echo ($questions)?'selected': ''?>" -->

<div class="tab-content">


<!-- Side bar settings  -->
	
<input type="hidden" class="col-sm-7 tampval"  placeholder=" Section title" >
	<!-- section page settings  -->
<div id="main" class="no-padding paper_pattern ui-state-default sortable3" style="background-color: #f5f7f8;">

<?php
  $page_list = $this->exam_model->get_pages($quiz->exam_id);
   
  // page settings
  $sec_no = 1; $que_no = 0; 
  $k=0; $j=0; $i=0;
  	foreach($page_list as $pg)
  	 { $i++;  ?>

  		<div class="page_block page ui-state-default sortable2" id="page_<?php echo $i; ?>">
	
		<div class=" ui-state-default mainPageSection">
			<i class='col-sm-1 select_icon page_handle' id='Picon_<?php echo $i; ?>'></i>
<!-- class for sidebar inputopenNav -->
		<div class="col-sm-11 ui-state-disabled"  id='pgbox_<?php echo $i; ?>'>
		<input id="pageTitle_<?php echo $i; ?>" class='title_page openNav' name="page_title[]" placeholder=" Page title" value='<?php echo $pg->page_title; ?>' >
		<textarea id='txt_page_<?php echo $i; ?>' name='page_Desc[]' style='display:none' class=''><?php echo $pg->page_description; ?></textarea>	
		<div id='pageDesc_<?php echo $i; ?>' class='page_Desc paradesc openNav' placeholder='Optional description' ><?php echo $pg->page_description ? $pg->page_description : 'Optional description' ; ?></div>

		<!-- <input id="pageDesc_<?php echo $i; ?>" class='page_Desc ' name="page_Desc[]" placeholder="Optional description" value='<?php echo $pg->page_description; ?>'> -->
		</div>
		<span id="page_<?php echo $i; ?>" class="openNav" ><img src="/public/uploads/settings/img/logo/page.07cfb8cf.png" role="presentation" data-radium="true" style="display: block;"></span>
		<a class='deletePage' style="float:right;display:none;" id="pageDel_<?php echo $i; ?>" ><img src='/public/css/image/red-del-icon.jpg' border='0' alt='Delete page' title='Delete page'></a>
		</div>

 <?php
  		$sec_list = $this->exam_model->get_section($quiz->exam_id, $i);
  		foreach($sec_list as $sec)
  	 	{
  	 		$que_no++;
  	 	 $sec_no = $j; 
  			$j++; ?>

  		<div class="page_block section sortable1" id="section_<?php echo $j; ?>" >
		
			<div class="ui-state-default mainPageSection">
			<i class='col-sm-1 select_icon sec_handle unmoved' id='iconSec_<?php echo $j; ?>'></i>
			<div class="col-sm-11 ui-state-disabled" id='sector_<?php echo $j; ?>'>
			<input id="secTitle_<?php echo $j; ?>" class='title_sec openNav sec' name="section_<?php echo $j
			; ?>[]" placeholder="Section title" value='<?php echo $sec->section_title; ?>' >

			<!-- <input id="secDesc_<?php echo $j; ?>" class='title_Desc  sec' name="secDesc_<?php echo $j; ?>[]" placeholder="Optional description" value='<?php echo $sec->section_description; ?>' > -->
			<textarea id='txt_section_<?php echo $j; ?>' name='secDesc_<?php echo $j; ?>[]' style='display:none' class=''><?php echo $sec->section_description; ?></textarea>	
			<div id='secDesc_<?php echo $j; ?>' class='title_Desc sec paradesc openNav' placeholder='Optional description' ><?php echo $sec->section_description ? $sec->section_description : 'Optional description' ; ?></div>

			<!-- </div> -->
			<input type="hidden" name="Quecat_<?php echo $j; ?>[]" id="Quecat_<?php echo $j; ?>">
			<input type="hidden" name="Quesubcat_<?php echo $j; ?>[]" id="Quesubcat_<?php echo $j; ?>">
			<input type="hidden" name="Questype_<?php echo $j; ?>[]" id="Questype_<?php echo $j; ?>">
			<input type="hidden" name="NumQues_<?php echo $j; ?>[]" id="NumQues_<?php echo $j; ?>" class="NumQues">
			<div id="getautoque_<?php echo $j; ?>"></div>

			<input type="hidden" name="Qids" id="sec_Qids_<?php echo $j; ?>">
			</div>
			<span id="section_<?php echo $j; ?>" class="openNav " ><img src="/public/uploads/settings/img/logo/section.9d6b855f.png" role="presentation" data-radium="true" style="display: block;"></span>
			
			</div>
<?php
  			$que_list = $this->exam_model->get_editQues($quiz->exam_id, $i, $j);
  			// echo "<pre>";
  			echo $quiz->exam_id, $i, $j; 
  			 // print_r($que_list);

 			foreach ($que_list as $Qdata) 
 			{	
 				
 				$k = $que_no;

 				//$k++; ?>

 			<div class="page_block Quetext ui-state-default Ques" id="Que_<?php echo $k; ?>">
				 

			<i class='select_icon handle unmoved Queset Qele' id='icon_<?php echo $k; ?>'></i>

				<div class="ui-state-default ui-state-disabled question_grp">
				<input type="hidden" id='status_<?php echo $k; ?>' name="status_<?php echo $k; ?>[]" value="update">
				
				<input type="hidden" id='qid_<?php echo $k; ?>' name="queid_<?php echo $k; ?>[]" value="<?php echo (isset($Qdata) ? $Qdata->que_id : ''); ?>" >
				<textarea id='ques_<?php echo $k; ?>' name='txtQuestion_<?php echo $k; ?>[]' style='display:none' class='Queset'><?php echo $Qdata->que_title; ?></textarea>	
				<span  id='showQue_<?php echo $k; ?>' class='Quetitle inputopenNav Queset Qele' ><?php if($Qdata->que_title) echo $Qdata->que_title;  else echo ""; ?> </span>

				<input type='hidden' id='qtype_<?php echo $k; ?>' value='<?php echo $Qdata->que_type; ?>' name='qtype_<?php echo $k; ?>[]' class='form-control Queset' >

				<input type='hidden' id='txtPoints_<?php echo $k; ?>' name='txtPoints_<?php echo $k; ?>[]' class='form-control Queset marks' value='<?php echo $Qdata->que_marks; ?>' >
				<!-- <input type='hidden' id='txtQtag_1' name='txtInstruction_1[]' class='form-control Queset' > -->

				<input type='hidden' id='txtInstruction_<?php echo $k; ?>' name='txtInstruction_<?php echo $k; ?>[]' class='form-control Queset' value='<?php echo $Qdata->instruction; ?>' >

				<!-- opt -->
		<!-- 		Array ( [0] => stdClass Object ( [id] => 17 [exam_id] => 32 [que_id] => 41 [que_title] =>
ffffffffffffffffff

[que_description] => [instruction] => [que_type] => regular [options] => [{"1":"9666"},{"2":"778787"}] [que_option] => [correct_ans] => 1 [que_attachment] => [que_level] => 0 [que_marks] => 30 [page_id] => 1 [section_id] => 1 [page_title] => [section_title] => [page_description] => [section_description] => [published] => 1 [created_by] => 1 [created_date] => 2018-04-26 [modified_date] => 2018-04-26 ) ) -->

				<?php 
				$reg_id = 1;
				if($Qdata->que_type== 'regular')					
				{	$array = json_decode($Qdata->options);
					// print_r($array);
					foreach ($array as $arr) {
					
					foreach ($arr as $key => $value) 
					{	$reg_id++;
				  //echo $key;	

				?>
<!-- 				<input type='hidden'  id='<?php echo $key; ?>_txtRegOpt' >
 -->				
<input  type='hidden' class='chkOpt Queset_opt' name='chkReg_<?php echo $k; ?>[]' value='<?php echo ($Qdata->correct_ans == $key) ? 1 : 0 ; ?>' id='chkReg_<?php echo $key; ?>_<?php echo $k; ?>' > 
 <input type='hidden'  id='txtRegOpt_<?php echo $key; ?>_<?php echo $k; ?>' 					class='form-control <?php echo $key; ?> ans_Opt Queset Queset_opt' name='txtRegOpt_<?php echo $k; ?>[]'  value='<?php echo $value; ?>' >
				
					<?php
					 } } 
				} ?>
				<!-- name count == que no -->
				<input type='hidden' class='form-control ans_Opt Queset Queset_opt' name='txtRegOpt_<?php echo $k; ?>[]' id='txtRegOpt_<?php echo $reg_id; ?>_<?php echo $k; ?>' >
				<input  type='hidden' class='chkOpt Queset_opt' name='chkReg_<?php echo $k; ?>[]' value='0' id='chkReg_<?php echo $reg_id; ?>_<?php echo $k; ?>'> 

				<?php
				
// Array ( [0] => stdClass Object ( [id] => 30 [exam_id] => 52 [que_id] => 54 [que_title] =>
// yuuuuuuuuuuuuu

// [que_description] => [instruction] => [que_type] => mcq [options] => [{"1":"jnijmik"},{"2":"77897"},{"3":"959595"},{"4":"errrrrrr"},{"5":"98989"}] [que_option] => [correct_ans] => 2_3_5_ [que_attachment] => [que_level] => 0 [que_marks] => 0 [page_id] => 1 [section_id] => 1 [page_title] => [section_title] => [page_description] => [section_description] => [published] => 1 [created_by] => 1 [created_date] => 2018-05-02 [modified_date] => 2018-05-02 ) )
					$mul_id = 1;
				if($Qdata->que_type== 'mcq')					
				{	$array = json_decode($Qdata->options);
									// print_r($array); 
					$chkans = explode(',', $Qdata->correct_ans);
					foreach ($array as $arr) {
					
					foreach ($arr as $key => $value) 
					{	$mul_id++;
					
				?>
				<input type='hidden' class='form-control mul_Opt Queset Queset_opt' name='txtMultiOpt_<?php echo $k; ?>[]' id='txtMultiOpt_<?php echo $key; ?>_<?php echo $k; ?>'  value='<?php echo $value; ?>'>
				<input type='hidden' class='chkOpt Queset_opt' name='chkMulti_<?php echo $k; ?>[]' id='chkMulti_<?php echo $key; ?>_<?php echo $k; ?>' <?php if(in_array($key, $chkans)){ echo 'value = 1'; } else{ echo 'value = 0' ;} ?> >

				<?php
					 } } 
				} ?>
				<input type='hidden' class='form-control mul_Opt Queset Queset_opt' name='txtMultiOpt_<?php echo $k; ?>[]' id='txtMultiOpt_<?php echo $mul_id; ?>_<?php echo $k; ?>' value=''>
				<input type='hidden' class='chkOpt Queset_opt' name='chkMulti_<?php echo $k; ?>[]' id='chkMulti_<?php echo $mul_id; ?>_<?php echo $k; ?>' value='0' >

<!-- Array ( [0] => stdClass Object ( [id] => 36 [exam_id] => 58 [que_id] => 60 [que_title] =>
what does the mean of the image

[que_description] => [instruction] => [que_type] => mediaq [options] => [{"1":"44444444444"},{"2":"3333333333"}] [que_option] => [correct_ans] => [que_attachment] => 0126_4.png [que_level] => 0 [que_marks] => 5 [page_id] => 1 [section_id] => 1 [page_title] => [section_title] => [page_description] => [section_description] => [published] => 1 [created_by] => 1 [created_date] => 2018-05-03 [modified_date] => 2018-05-03 ) ) -->

				<input type="hidden" class='form-control media_img Queset ' name='MediaImg_<?php echo $k; ?>' id='MediaImg_<?php echo $k; ?>' value='<?php echo $Qdata->que_attachment; ?>'>
				<?php 
				$med_id = 1;
				if($Qdata->que_type== 'mediaq')					
				{	$array = json_decode($Qdata->options);
					foreach ($array as $arr) {
					
					foreach ($arr as $key => $value) 
					{	$med_id++; ?>
				<input type='hidden' class='form-control media_Opt Queset Queset_opt' name='txtMediaOpt_<?php echo $k; ?>[]' id='txtMediaOpt_<?php echo $key; ?>_<?php echo $k; ?>' value='<?php echo $value; ?>' >
				<input type='hidden' class='chkOpt Queset_opt' name='chkMedia_<?php echo $k; ?>[]' id='chkMedia_<?php echo $key; ?>_<?php echo $k; ?>' value='<?php echo ($Qdata->correct_ans == $key) ? 1 : 0 ; ?>' >

				<?php
					 } } 
				} ?>
				
				<input type='hidden' class='form-control media_Opt Queset Queset_opt' name='txtMediaOpt_<?php echo $k; ?>[]' id='txtMediaOpt_<?php echo $med_id; ?>_<?php echo $k; ?>'><input value='0'  type='hidden' class='chkOpt Queset_opt' name='chkMedia_<?php echo $k; ?>[]' id='chkMedia_<?php echo $med_id; ?>_<?php echo $k; ?>'>

				<?php $TF_id = $k;
				if($Qdata->que_type== 'truefalse')					
				{  ?>
					<!-- Array ( [0] => stdClass Object ( [id] => 41 [exam_id] => 63 [que_id] => 65 [que_title] =>
This statement is true

[que_description] => [instruction] => This would be a question where the examinees would have to select either True or False as the answer. [que_type] => truefalse [options] => [que_option] => [correct_ans] => 1 [que_attachment] => [que_level] => 0 [que_marks] => 5 [page_id] => 1 [section_id] => 1 [page_title] => [section_title] => [page_description] => [section_description] => [published] => 1 [created_by] => 1 [created_date] => 2018-05-07 [modified_date] => 2018-05-07 ) ) -->

				<input type='hidden' name="rbTrueFalse_<?php echo $TF_id; ?>" id='txtTrueF_<?php echo $TF_id; ?>' class='Queset' value='<?php echo $Qdata->correct_ans; ?>' > 
				<?php	$TF_id++;
				} ?>
				<input type='hidden' name="rbTrueFalse_<?php echo $TF_id; ?>" id='txtTrueF_<?php echo $TF_id; ?>' class='Queset'> 
				
				<!-- Array ( [0] => stdClass Object ( [id] => 42 [exam_id] => 64 [que_id] => 66 [que_title] =>
find matching pair....

[que_description] => [instruction] => [que_type] => matching [options] => [{"1":"22"},{"2":"33"}] [que_option] => [{"1":"bb"},{"2":"cc"}] [correct_ans] => "1,2," [que_attachment] => [que_level] => 0 [que_marks] => 0 [page_id] => 1 [section_id] => 1 [page_title] => [section_title] => [page_description] => [section_description] => [published] => 1 [created_by] => 1 [created_date] => 2018-05-12 [modified_date] => 2018-05-12 ) )  -->
				
				<?php
				$mque_id = 1; 
				$pair_id = 1;
				if($Qdata->que_type== 'matching')					
				{	$array = json_decode($Qdata->options);
					
					foreach ($array as $arr) {
					
					foreach ($arr as $key => $value) 
					{ ?>

				<input type='hidden' class='form-control match_Opt Queset Queset_opt' name='txtMatchque_<?php echo $k; ?>[]' id='txtMatchque_<?php echo $key; ?>_<?php echo $k; ?>' value='<?php echo $value; ?>' >
				<?php $mque_id++; } } ?>
				<input type='hidden' class='form-control match_Opt Queset Queset_opt' name='txtMatchque_<?php echo $k; ?>[]' id='txtMatchque_<?php echo $mque_id; ?>_<?php echo $k; ?>' >

				<?php $array2 = json_decode($Qdata->que_option);
					foreach ($array2 as $arr) {
					
					foreach ($arr as $key => $value) 
					{	?>

				<input type='hidden' class='form-control Queset Queset_opt' name='txtMatchpair_<?php echo $k; ?>[]' id='txtMatchpair_<?php echo $key; ?>_<?php echo $k; ?>' value='<?php echo $value; ?>' >
				<?php  $pair_id++;  } } ?>
				<input type='hidden' class='form-control Queset Queset_opt' name='txtMatchpair_<?php echo $k; ?>[]' id='txtMatchpair_<?php echo $pair_id; ?>_<?php echo $k; ?>'>
				<?php } ?>
				</div>	

			</div>
 <?php		$que_no++;		
 			} 
 			?>
 				 <!-- additional one que -->
 			<script type='text/javascript'> 				
 				addQue('Que_<?php echo $k; ?>');
 			</script>
 			<?php	$k++; ?>
 				
 				 
			<!-- sec end -->
			</div>
		<?php

  		} 
// <!-- additional one section -->
			
			?> </div>
  		<script type='text/javascript'> 
 				secAdd('secTitle_<?php echo $j; ?>');
 				//addQue('Que_<?php echo $k; ?>');
 		</script>
 		 	<?php $j++;	$k++; ?>

		<!-- page end -->
		
	  </div>
		 <?php

  	} ?> 
  	<br><center><!-- <div class='ui-state-default ui-state-disabled'> --><button type='button' class='add_page' >NEW PAGE<span class="icon_add_new_pg">+<span class="square-button__arrow-container" data-radium="true" style="background-color: rgb(49, 71, 108); position: absolute; top: 0px; bottom: 0px; right: 3rem;"><span data-radium="true" style="border-color: transparent rgb(49, 71, 108) transparent transparent; position: absolute; right: 100%; top: 50%; margin-top: -0.4rem; width: 0px; height: 0px; border-width: 0.4rem 0.4rem 0.4rem 0px; border-style: solid;"></span></span></span></button><!-- </div> --></center><br>
</div>

  
       	

	
</div>	
</div>
</div>		
</div>
</div>		
</div>
</div>

<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$quiz->exam_id) ?>

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

 
<script>
 function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
               return false;

   return true;
}

</script>
<script type="text/javascript">

// 	 jQuery.browser = {};
// (function () {
//     jQuery.browser.msie = false;
//     jQuery.browser.version = 0;
//     if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
//         jQuery.browser.msie = true;
//         jQuery.browser.version = RegExp.$1;
//     }
// })();
// 	 var $j = jQuery.noConflict(); 

</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script type="text/javascript">
	
	$(document).ready(function() { 
            // bind 'myForm' and provide a simple callback function 
	            // $j('#examsubmitid').ajaxForm(function() { 
	            //     alert("Thank you for your comment!"); 
	            // }); 

	            $j('#examsubmitid').ajaxForm({
	
         beforeSend: function() {
         //	alert('submit');
  		   var ex_title = $('#ex_name').val();
        },
        success: function(insert_id) {
     		console.log(insert_id);
     		 // $('#loading').hide();
        //     $('#subtn').removeAttr("disabled");
            
              if(insert_id)
              {
                 
        var strcontent1 ='<center><h4 style="padding:2%;text-align:center;font-weight:bold;color:#016ac1">Exam Successfully Created! </h4></center>';
  alert(insert_id);
          jQuery.alert({
                 title: "Success",
              content: strcontent1,
             confirm: function()
                         { 
                         	var updType = "<?php echo $updType ?>";
                         	if(updType == 'create')
                         	{
                         	var seg3 = "<?php echo $this->uri->segment(3); ?>";
	            			var seg4 = "<?php echo $this->uri->segment(4); ?>";
		            			if(seg3 && seg4){
	                          		window.location ="<?php echo base_url();?>tasks/quiz/"+seg3+"/"+seg4+"/"+insert_id;
		            			}else{
		            				window.location ="<?php echo base_url();?>exams";
		            			}

                         	}
                         	else{
                          		window.location ="<?php echo base_url();?>exams";
                      		}
                         }
                     });


              } 

             else
              {
              	  alert('insert_id');

                  jQuery.alert({
                    // type: 'error',
                    
                   title: "Error",
                 content: '<center><h4 style="padding:2%;text-align:center;font-weight:bold;color:#016ac1"> Fail to create,<br>Please try again!.. </h4></center>',
                  confirm: function()
                            {
                              // window.location ="<?php echo base_url();?>sections-manage/"+pid+"/"+cname;
                              $('.error').remove();
                            return true;
                 
                             }
                         });

              }
        }
    }); 
        }); 


	 function validatepop(strtitle,strcontent)
  {   
      var strcontent1 ='<p style="text-align: center;font-weight: 700;font-size: 15px;">'+strcontent+'</p>';
  
    $j.alert({
           title: strtitle,
        content: strcontent1,
       confirm: function()
                   {                        
              
                   }
               });
  }

</script>
<script>
	 tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
selector : ".editordesc",
setup : function(ed) {
	 

      ed.on('KeyUp', function(ed, e) {
      	var tempval = $('.tampval').val();
		var tempvalarray = tempval.split('_');
           var tempval2 = tinymce.activeEditor.getContent();
               	

			if(tempvalarray[0]=='section'){
  			 $('#txt_section_'+tempvalarray[1]).html(tempval2);
  			 $('#secDesc_'+tempvalarray[1]).html(tempval2);	
  			 secAdd('secTitle_'+tempvalarray[1]);
		
			}
  			else if(tempvalarray[0]=='page')
  			{
  			 $('#txt_page_'+tempvalarray[1]).html(tempval2);
  			 $('#pageDesc_'+tempvalarray[1]).html(tempval2);
  			}

      });
   
      }
});
</script>
<script>
	//select existing ques script
	$(document).ready( function() {
		$(document).find('#Qform').hide();
	});

	$('#setmanual').on('click', function(){
		$(document).find('#Qform').show();
		$(document).find('#Qexist').hide();
	});

	$('#setexist').on('click', function(){
		$(document).find('#Qform').hide();
		$(document).find('#Qexist').show();
		$(document).find('.autoQue').find("option[value='']").attr('selected', true);
		$('table#dataTable tr:not(:first-child)').remove();
		$(document).find('#chk_all').prop("checked", false);
	});

$('.getQues').on('click', function(){
$('table#dataTable tr:not(:first-child)').remove();

	var cat = $('#Quecat').val();
	var subcat = $('#Quesubcat').val();
	var Qno = $('#NumQues').val();
	var Questype = $('#Questype').val();
	if(!Qno){ Qno=''; }
	if(!cat){ cat=''; }
	if(!subcat){ subcat=''; }
	if(!Questype){ Questype=''; }
	$j.ajax({
	 type: 'POST',
        dataType: "json",
        data: {Qno:Qno,cat:cat,subcat:subcat,Qtype:Questype},
        url: base_url+'/exams/noQues',
        success: function(data){
        	if(data){
        		$(document).find('#NumQues').attr('placeholder','Limit upto '+data.length+' Questions');
        		
        		$(document).find('#availQues').val(data.length);
        		// $(document).find('#SortQlist').html('');

        		var table = document.getElementById('dataTable');

        	for (var i=0; i<= data.length - 1; i++) { 
        		var rowCount = table.rows.length;
     			var row = table.insertRow(rowCount);
        		 var cell1 = row.insertCell(0);
			     var element1 = document.createElement("input");
			     element1.type = "checkbox";
			     element1.name = "chkbox[]";
			     element1.className = "Quechk";
			     element1.id = data[i]['que_id'];
			     cell1.appendChild(element1);

			     var cell2 = row.insertCell(1);
			     cell2.innerHTML = data[i]['que_title'];
				// var item = data[i]['que_title'];
				// $(document).find('#SortQlist').append($("<li></li>")
    //                 .text(item)); 
				}
			}
        },
        error: function(data)
		{
			console.log(data.responseText);
		}
    });

});

$('#addselected').on('click', function(){
	    var selected = new Array();

	$('input:checked.Quechk').each(function() {
    // var id = $(this).attr('id');
    selected.push($(this).attr('id'));
	});
	// console.log(selected);
	if(selected)
	{
		$j.ajax({
		 type: 'POST',
		 data: {id:selected},
		 url: base_url+'/exams/appendQues',
	         success: function(data){
	         	var Quesdata = jQuery.parseJSON(data);
	         	// var len = data.length;
			    $.each(Quesdata, function(key, value ){
			    	// console.log(key);
			    	appendSelected(value);
			    	// console.log(value1);
			    });

			  },
			  complete: function(){
			  	addmarks();
			  },
	         error: function(data)
			{
				console.log(data.responseText);
			}
			});
		 
	}
    // console.log(id);
});


 function checkAll(ele) {

     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }


$('.Qselect').on('click', function(){

	$(document).find('#quetab').attr({href:"#Questions", 'data-toggle':"tab"});

	$('.nav-tabs > .active').next('li').find('a').trigger('click');
		if($(this).is('.autobtn')){
		// 1-auto & 2-manual
	$('#exam_category').val('1');
	$(document).find('.Ques').hide();
	// $('#Que_1').hide();
	$('#variety').hide();
	$('#Qexist').hide();
	$('#autoQuetab').show();
	}
	else{
	 $('#exam_category').val('2');
	 	$(document).find('.Ques').show();
	 	$('#variety').show();
		// $('#Qexist').show();
	 	$('#autoQuetab').hide();

	 }

		// $(document).find('#autoQuetab').show();
		// $(document).find('#newQuetab').hide();
		// $(document).find('#examQuetype').val('1');
	});

	$('.newbtn').on('click', function(){

		$(document).find('#autoQuetab').hide();
		$(document).find('#newQuetab').show();
		$(document).find('#examQuetype').val('2');

	});

	function getlist(cat){
		// var cat = $('#Quecat').val();
		if(cat){
			$j.ajax({
        type: 'POST',
        dataType: "json",
        url: base_url+'/exams/getsubcategory/'+cat,
        success: function(data) { 
        	    // var data1 = jQuery.parseJSON(data);
        	// $(document).find('#Quesubcat option').not(':first').remove();
        	   $(document).find('#Quesubcat option').remove();
        	   $(document).find('#Questype option').remove();

        	   $(document).find('#Quesubcat').append('<option value="">SELECT SUBCATEGORY</option>');
        	   $(document).find('#Questype').append('<option value="">SELECT QUESTION TYPE </option>');


        	for (var i=0; i<= data[0].length - 1; i++) {
        		var item = data[0][i]['que_subcategory'];
        		$(document).find('#Quesubcat').append($("<option></option>")
                    .attr("value",item)
                    .text(item)); 
        	}
        	for (var i=0; i<= data[1].length - 1; i++) {
        		var item = data[1][i]['que_type'];
        		$(document).find('#Questype').append($("<option></option>")
                    .attr("value",item)
                    .text(item)); 
        	}
        	$(document).find('#NumQues').attr('placeholder','Limit upto '+data[2]+' Questions');
        	var ele_info = $('.tampval').val();
        	var ele_id = ele_info.split('_');
        	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(data[2]);
        	$(document).find('#availQues').val(data[2]);
        	 // console.log(data);

            // $j(".sidenav").html(data); 
	        }
	    });
		}
		else{
			$(document).find('#Quesubcat option').not(':first').remove();
        	$(document).find('#Questype option').not(':first').remove();

		}
	}


	$('#Quecat').on('change', function(){
		var cat = $(this).val();
		// console.log(cat);
		$('#Quesubcat')
		 .children()
            .remove()
            .end()
            .append('<option value="">Loading...</option>');
        $('#Questype')
		 .children()
	        .remove()
	        .end()
	        .append('<option value="">Loading...</option>');
	    $(document).find('#NumQues').attr('placeholder','Loading...');

		getlist(cat);
	});

	$('#Quesubcat').on('change', function(){
		var subcat = $(this).val();
		var cat = $('#Quecat').val();
		 $('#Questype')
		 .children()
	        .remove()
	        .end()
	        .append('<option value="">Loading...</option>');
	        $(document).find('#NumQues').attr('placeholder','Loading...');
		if(subcat){
			$j.ajax({
        type: 'POST',
        dataType: "json",
        url: base_url+'/exams/getQuetypes/'+subcat+'/'+cat,
        success: function(data){ 
        	    // var data1 = jQuery.parseJSON(data);
        	   // $(document).find('#Questype option').not(':first').remove();
        	    $(document).find('#Questype option').remove();

        	   $(document).find('#Questype').append('<option value="">SELECT QUESTION TYPE</option>');

        	for (var i=0; i<= data[0].length - 1; i++) {  
        		var item = data[0][i]['que_type'];
        		$(document).find('#Questype').append($("<option></option>")
                    .attr("value",item)
                    .text(item)); 
        	}
        	$(document).find('#NumQues').attr('placeholder','Limit upto '+data[1]+' Questions');
        	var ele_info = $('.tampval').val();
        	var ele_id = ele_info.split('_');
        	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(data[1]);
        	   $(document).find('#availQues').val(data[1]);


        	 // console.log(data);

            // $j(".sidenav").html(data); 
	        }
	    });
		}
		else{
			getlist(cat);
		}

	});

	function chkavail(value){
		var Qavail = $(document).find('#availQues').val();
   if(parseInt(value) > Qavail) return false; 
   return true;
}
var oldValue = '';
// var alert = document.getElementById('counterror');
$('#NumQues').on('keyup keydown', function(){
     if(!chkavail(this.value))
     {
         this.value = oldValue;
         counterror.innerHTML = 'Questions not available!';
     }
     else{ oldValue = this.value;   counterror.innerHTML = ''; }
});

// $('.getQues').on('click', function(){
	$('#Questype').on('change', function(){
	var cat = $('#Quecat').val();
	var subcat = $('#Quesubcat').val();
	var Qno = $('#NumQues').val();
	var Questype = $('#Questype').val();
	$(document).find('#NumQues').attr('placeholder','Loading...');

if(!Qno){ Qno=''; }
if(!cat){ cat=''; }
if(!subcat){ subcat=''; }
if(!Questype){ Questype=''; }
	$j.ajax({
	 type: 'POST',
        dataType: "json",
        data: {Qno:Qno,cat:cat,subcat:subcat,Qtype:Questype},
        url: base_url+'/exams/noQues',
        success: function(data){
        	// console.log(data.length);
        	if(data){
        		$(document).find('#NumQues').attr('placeholder','Limit upto '+data.length+' Questions');
        		var ele_info = $('.tampval').val();
        	var ele_id = ele_info.split('_');
        	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(data.length);
        		$(document).find('#availQues').val(data.length);
    //     		$(document).find('#SortQlist').html('');
    //     	for (var i=0; i<= data.length - 1; i++) {  
				// var item = data[i]['que_title'];
				// $(document).find('#SortQlist').append($("<li></li>")
    //                 .text(item)); 
				// }
			}
        },
        error: function(data)
		{
			console.log(data.responseText);
		}
    });

});

$('#getpreview').on('click', function(){
		// alert('me');

	$(document).find('#sidebar').hide();
	 $(document).find('#preview_modal').find('.modal-body').html('');
	var title = $('form#examsubmitid').find('#ex_name').val();
	var duration = $('form#examsubmitid').find('#limit_time_l').val();
	if($('#exam_category').val() == 'manual'){
		var Qlength = 1;
		var totQ = $('.Ques').length;
		for (var i = 1; i <= totQ; i++) {
			var Quetitle = $('#showQue_'+i).text();
			if(Quetitle =="Add a new question by typing here" || Quetitle =="Add a new question here" ) { 
				Qlength = Qlength;
			}else{ Qlength = Qlength + 1; }
		}
	}
	else if($('#exam_category').val() == 'auto'){
		var Qlength = 1;
		$(".NumQues").each(function(){
			var val = $(this).val();
			console.log(Qlength);
			 console.log(val);
			if(!val) val=0;
			 Qlength = parseInt(Qlength) + parseInt(val);
			 console.log('auto');
			 
		});

	}
	var attempt = $('form#examsubmitid').find('#nb_quiz_taken').val();
	var avgscrore = $('form#examsubmitid').find('#max_score_pass').val();
	$.ajax({
		type: 'POST',
		data: {title:title,duration:duration,totQ:Qlength,attempt:attempt,avgscrore:avgscrore},
  url: base_url+'/exams/exampreview/',
        success: function(data){
        	
        	if(data)
        	{
        		$('#preview_modal').find('.modal-body').html(data);
        	}
        }
    });
});

$('#popclose').click(function(){
	// $(document).on('click', '.exam_preview_close_btn', function(){
		 var fname = $(document).find('#filenm').text();
		// var fso = new ActiveXObject('Scripting.FileSystemObject');
  //   fso.DeleteFile('<?php echo base_url() ?>/public/JSON/'+fname, true);
// alert(fname);
  //   fso = null;
    $.ajax({
	      url: base_url+'/exams/deletejsonfile',
          data: {'file' : "<?php echo FCPATH ?>public/JSON/"+fname},
          success: function (response) {
          	console.log(response);
             return true;
          },
          error: function (data) {
            console.log(data);

          }
        });
	});

</script>

<script>
	$('#addselected').on('click', function(){
	    var selected = new Array();

	$('input:checked.Quechk').each(function() {
    // var id = $(this).attr('id');
    selected.push($(this).attr('id'));
	});
	// console.log(selected);
	if(selected)
	{
		$j.ajax({
		 type: 'POST',
		 data: {id:selected},
		 url: base_url+'/exams/appendQues',
	         success: function(data){
	         	var Quesdata = jQuery.parseJSON(data);
	         	// var len = data.length;
			    $.each(Quesdata, function(key, value ){
			    	// console.log(key);
			    	appendSelected(value);
			    	// console.log(value1);
			    });

			  },
			  complete: function(){
			  	addmarks();
			  },
	         error: function(data)
			{
				console.log(data.responseText);
			}
			});
		 
	}
    // console.log(id);
});


 function checkAll(ele) {

     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }


	 $('.exam_Quecat').on('keyup change', function(){

		var cat = $(this).val();
		 console.log(cat);
		$('#exam_Quesubcat')
		 .children()
            .remove()
            .end()
            .append('<option value="">Select / Add New Sub-category</option>');
        getlist(cat, 'exam'); 
    });


///////////
$('.Quecat').on('change', function(){
       var div_info = $(this).attr('id');
       var cat = $(this).val();
       Quecatchange(div_info,cat);
	});
function Quecatchange(div_info,cat){
       //   var div_info = $(this).attr('id');
       // var cat = $(this).val();
        var div_id = div_info.split('_');
		var ele_info = $('.tampval').val();
        var ele_id = ele_info.split('_');
        $(document).find('#'+ele_info).find('#Quecat_'+ele_id[1]).val(cat);
		// console.log(cat);
		$('#Quesubcat_'+div_id[1])
		 .children()
            .remove()
            .end()
            .append('<option value="">Loading...</option>');
        $('#Questype_'+div_id[1])
		 .children()
	        .remove()
	        .end()
	        .append('<option value="">Loading...</option>');
	    $(document).find('#NumQues_'+div_id[1]).attr('placeholder','Loading...');
	    subcat = $(document).find('#'+ele_info).find('#Quesubcat_'+ele_id[1]).val();
	    Qty = $(document).find('#'+ele_info).find('#Questype_'+ele_id[1]).val();
		getlist(cat,div_id[1],subcat,Qty);
}

	$('.Quesubcat').on('change', function(){
		 var div_info = $(this).attr('id');
		 var subcat = $(this).val();
		Quesubcatchange(div_info,subcat)
	});
		function Quesubcatchange(div_info,subcat){
       
        var div_id = div_info.split('_');
        var ele_info = $('.tampval').val();
        var ele_id = ele_info.split('_');
		
		 $(document).find('#'+ele_info).find('#Quesubcat_'+ele_id[1]).val(subcat);

		var cat = $('#Quecat_'+div_id[1]).val();
		 $('#Questype_'+div_id[1])
		 .children()
	        .remove()
	        .end()
	        .append('<option value="">Loading...</option>');
	        $(document).find('#NumQues_'+div_id[1]).attr('placeholder','Loading...');
		if(subcat){
			$j.ajax({
        type: 'POST',
        dataType: "json",
        url: base_url+'/exams/getQuetypes/'+subcat+'/'+cat,
        success: function(data){ 
        	   
        	$(document).find('#Questype_'+div_id[1]+' option').remove();
        	$(document).find('#Questype_'+div_id[1]).append('<option value="">SELECT QUESTION TYPE</option>');

        	for (var i=0; i<= data[0].length - 1; i++) {  
        		var item = data[0][i]['que_type'];
        		$(document).find('#Questype_'+div_id[1]).append($("<option></option>")
                    .attr("value",item)
                    .text(item)); 
        	}
        	$(document).find('#NumQues_'+div_id[1]).attr('placeholder','Limit upto '+data[1]+' Questions').val('');
        	
        	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(data[1]);
        	   $(document).find('#availQues_'+div_id[1]).val(data[1]);


        	 // console.log(data);

            // $j(".sidenav").html(data); 
	        }
	    });
		}
		else{
			 subcat = $(document).find('#'+ele_info).find('#Quesubcat_'+ele_id[1]).val();
	    Qty = $(document).find('#'+ele_info).find('#Questype_'+ele_id[1]).val();
		getlist(cat,div_id[1],subcat,Qty);

			// getlist(cat,div_id[1]);
		}

	}

	function chkavail(value,id){

		var Qavail = $(document).find('#availQues_'+id).val();
   if(parseInt(value) > Qavail) return false; 
   return true;
}
var oldValue = '';
// var alert = document.getElementById('counterror');
$('.NumQues').on('keyup keydown', function(){
     var div_info = $(this).attr('id');
     var div_id = div_info.split('_');
      var ele_info = $('.tampval').val();
        var ele_id = ele_info.split('_');

     var val = $(this).val();
     if(!chkavail(val,div_id[1]))
     {
         this.value = oldValue;
         document.getElementById('counterror_'+div_id[1]).innerHTML = 'Questions not available!';
         $(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(oldValue);
     }
     else{ oldValue = this.value;   
     	document.getElementById('counterror_'+div_id[1]).innerHTML = '';
     	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(val); }
});


	$('.Questype').on('change', function(){
    var div_info = $(this).attr('id');
     var div_id = div_info.split('_');
      var ele_info = $('.tampval').val();
        var ele_id = ele_info.split('_');

	var cat = $('#Quecat_'+div_id[1]).val();
	var subcat = $('#Quesubcat_'+div_id[1]).val();
	var Qno = $('#NumQues_'+div_id[1]).val();
	var Questype = $('#Questype_'+div_id[1]).val();
	 $(document).find('#'+ele_info).find('#Questype_'+ele_id[1]).val(Questype);
	$(document).find('#NumQues_'+div_id[1]).attr('placeholder','Loading...');

if(!Qno){ Qno=''; }
if(!cat){ cat=''; }
if(!subcat){ subcat=''; }
if(!Questype){ Questype=''; }
	$j.ajax({
	 type: 'POST',
        dataType: "json",
        data: {Qno:Qno,cat:cat,subcat:subcat,Qtype:Questype},
        url: base_url+'/exams/noQues',
        success: function(data){
        	// console.log(data.length);
        	if(data){
        		$(document).find('#NumQues_'+div_id[1]).attr('placeholder','Limit upto '+data.length+' Questions');
        		var ele_info = $('.tampval').val();
        	var ele_id = ele_info.split('_');
        	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(data.length);
        		$(document).find('#availQues_'+div_id[1]).val(data.length);
   
			}
        },
        error: function(data)
		{
			console.log(data.responseText);
		}
    });

});

	function getlist(cat, exam,subcat,qty){
		// var cat = $('#Quecat').val();
		 var exam = exam;
		if(cat){
			$j.ajax({
        type: 'POST',
        dataType: "json",
        url: base_url+'/exams/getsubcategory/'+cat,
        success: function(data) { 
        	    // var data1 = jQuery.parseJSON(data);
        	// $(document).find('#Quesubcat option').not(':first').remove();
        	  
        	   if(exam == 'exam'){
        	   	$(document).find('#sub option').remove();
        	   	$(document).find('input#exam_Quesubcat').val('');
	        	   	for (var i=0; i<= data[0].length - 1; i++) {
	        		var item = data[0][i]['que_subcategory'];
	        		
	        		$('#sub').append($("<option></option>")
	                    .attr("value",item)
	                    .text(item)); 
        			}
        	   }
        	   else{
        	   	 $(document).find('#Quesubcat_'+exam+' option').remove();
        	   $(document).find('#Questype_'+exam+' option').remove();

        	   $(document).find('#Quesubcat_'+exam).append('<option value="">SELECT SUBCATEGORY</option>');
        	   $(document).find('#Questype_'+exam).append('<option value="">SELECT QUESTION TYPE </option>');


        	   		for (var i=0; i<= data[0].length - 1; i++) {
		        		var item = data[0][i]['que_subcategory'];
		        		$(document).find('#Quesubcat_'+exam).append($("<option></option>")
		                    .attr("value",item)
		                    .text(item));

		        	}
		        	
		        	for (var i=0; i<= data[1].length - 1; i++) {
		        		var item = data[1][i]['que_type'];
		        		$(document).find('#Questype_'+exam).append($("<option></option>")
		                    .attr("value",item)
		                    .text(item)); 
		        	}
		        	if(subcat){
		        		$(document).find('#Quesubcat_'+exam).find("option[value="+subcat+"]").attr('selected', true);
		        		}
		        	if(qty){
		        		$(document).find('#Questype_'+exam).find("option[value="+qty+"]").attr('selected', true);
		        		}

		        	$(document).find('#NumQues_'+exam).attr('placeholder','Limit upto '+data[2]+' Questions');
		        	var ele_info = $('.tampval').val();
		        	var ele_id = ele_info.split('_');
		        	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(data[2]);
		        	$(document).find('#availQues_'+exam).val(data[2]);
		        	 // console.log(data);
        	   }
        	  
	        }
	    });
		}
		else{
			$(document).find('#Quesubcat option').not(':first').remove();
        	$(document).find('#Questype option').not(':first').remove();

		}
	}
</script>