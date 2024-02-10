<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/js/exam/exam.css">

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
h2 {
	margin-top: 0px !important;
}
label{
	float: left;
	width: 130px;
	font-size: medium;
	color: #555;
}
.full-label{
	width: 100% !important;
	float: left;
	text-align: left!important;
}
#home input[type="radio"] {
	position: relative;
	top: 2px;
}
.Quetitle {
	height: auto !important;
	min-height: 100% !important;
	max-height: 100% !important;
}
.icon_add_new_pg {
	font-size: 30px !important;
	font-weight: 100;
}
.add_page:hover .square-button__arrow-container {
	width: auto !important;
}
button.add_page {
	padding: 0px 1.8rem 4px;
	border: 0px;
	display: inline-block;
	width: auto;
}
 #submit{
	margin-right: 0px !important;
}
#home .radio.radio-inline {
	font-size: 16px;
	color: #555;
	padding-top: 0px;
}
#home .note {
	display: block;
	font-size: 13px !important;
	color: #777;
}
#home .note1 {
	font-size: 13px !important;
	color: #777;
	padding-left: 15px;
}
#home .form-group {
	border-bottom: 1px solid #ebebeb;
	padding: 15px 0px !important;
}
#btnQues a {
	background: #09c;
	color: #fff;
	width: auto;
	font-size: 14px;
	padding: 10px 10px;
	margin: 0px 5px;
}
#btnQues a:hover {
	background: #1199e1;
}
#btnQues {
	text-align: center;
	padding: 20px 0px 0px 0px;
}

.nav.nav-tabs > li > a, .nav.nav-tabs > li > a:hover, .nav.nav-tabs > li > a:focus {
	padding: 10px 25px !important;
	font-size: 14px;
	color: #454545;
	margin-right: 0px !important;
	background: #f0eef2;
	margin-left: 0px !important;
	border: 0px !important;
}
.main-container .nav-tabs > li.active > a, .main-container .nav-tabs > li.active > a:hover, .main-container .nav-tabs > li.active > a:focus {
	border-bottom: 0px !important;
	background: #00ADEF !important;
	color: #fff !important;
	border: 0px !important;
}
.nav-tabs.bordered + .tab-content {
	border: 1px solid #ebebeb !important;
	margin-bottom: 40px !important;
}
#sticky a.btn, #sticky input {
	background: #65bd67 !important;
	padding: 8px 20px !important;
	font-size: 16px !important;
	border-radius: 5px;
	color: #fff;
	border: 0px !important;
}
#home .checkbox {
	margin-top: 0px !important;
	padding-top: 0px !important;
}
#sticky a{
	margin-top: 0px !important;
}
#sticky {
	display: inline-block;
	float: right;
	width: auto;
}
#sticky-anchor {
	display: inline-block;
}
#home .radio-set.radioGraySet {
	/*width: auto !important;
	display: inline-block !important;
	position: relative !important;*/
	width: 74% !important;
	display: inline-block !important;
	position: relative !important;
	padding-left: 15px;
}
#home legend {
	padding-left: 0px !important;
	border-bottom: 0px !important;
	padding-bottom: 0px !important;
	margin-bottom: 0px !important;
}
#home input, textarea {
	background: transparent !important;
	border: 1px solid #ccc !important;
	border-radius: 3px !important;
	padding: 5px 10px !important;
}
.main-container .nav-tabs > li.active > a{
	border-bottom: 0px !important;
}
div#home {
	padding: 0px 0px !important;
}	
.full-label{
	width: 100%;
	float: left;
	text-align: left!important;
}
.breadcrumb {
	background-color: #fff !important;
	padding: 0px !important;
}
.breadcrumb .container{
	width: 100% !important;
	max-width: 100% !important;
	padding: 0px;
}
.form-group label{
	width: 115px;
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

<style>
	.stick #inform_btn {
  display: none;
}
.page-container.sidebar-collapsed .sidebar-menu .logo-env {
  display: block;
  padding: 20px 15px !important;
}
.page-container.sidebar-collapsed .sidebar-menu{
  width: 60px !important;
}
.page-container .sidebar-menu{
  width: 60px !important;
}
body .page-container .sidebar-menu #main-menu li a .list_text {
  display: none !important;
}
.page-container .sidebar-menu .logo-env > div.logo {
  width: 0px !important;
  overflow: hidden;
}
body .page-container .sidebar-menu #main-menu li.has-sub > a::before {
  display: none;
}
.page-container {
  padding-left: 60px;
}
</style>

<script type="text/javascript">
	 jQuery(document).ready(function() 
  {
  //$('.sidebar-collapse').find('a').click();
  
  jQuery('div.sidebar-collapse').remove();
  jQuery('.page-container').addClass('sidebar-collapsed');
  
    });
  function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

jQuery(function () {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>



<!--/lightbox scripts and style ------------------------ -->

<div>
    <h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>

    <?php if($updType != 'edit'){

	$qid = '';

	}?>
</div>

<header>
	<section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 no-padding">
          <h2>
            <?php echo (($updType == 'edit')?'Edit Quiz':'Create Quiz');?> </h2>
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
 <div id="ex_overlay"></div>

<div class="main-container" style="min-height: 820px;">
	<div class="row">
<!-- <div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top:5px; margin-right:20px; margin-bottom:10px;">
	<a href="#" class="sidebar-collapse-icon with-animation"> -->
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<!-- <i class="entypo-menu"></i>
	</a>
</div> -->
<div id="mySidenav" class="sidenav exam-txt">
<div id="btn-sticky" >
	<div style="float: left;">
	<!-- <button class='deletebtn' style="float: left" type='button' id="" ><img src='/public/images/delete.3f3ed9f0.png' border='0' alt='Delete' title='Delete'></button> -->
	<button type='button' style="float: left" class="closebtn" title="Cancel">&times;</button>
	</div>
	<div style="float: right;">	<button class='btn btn-primary' id="Qupdate" type='button' >Add Question</button>
</div>

</div>


		<div id="variety" style="display: none;" class="two_btn">
			<a id="setmanual" class="set-manual_btn">Set manually</a>
			<a id="setexist" class="set_form_btn">Set Form Question Pool</a>
		</div>
		<div id="Qexist" style="display: none">
			<?php echo $this->load->view('admin/exams/quesetting'); ?>
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
			<?php  echo $this->load->view('admin/exams/addquestion'); ?>
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
					<?php echo $this->load->view('admin/exams/quesetting_sec'); ?>

						
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
$attributes = array('class' => 'tform', 'id' => 'examsubmitid', 'onSubmit' => 'return validate()');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/exams/exam_submit', $attributes) : form_open_multipart(base_url().'admin/exams/edit/'.$qid, $attributes);
?>

<input type="hidden" name="exam_category" id="exam_category">
<div id="sticky-anchor">
	<div class='totshow'>
		<h2 class="Optional_quiz"><b>Total Questions : <span id="Qspan">0</span></b></h2>
	</div>
</div>
<div id="sticky" class="">
	<h2 class="Optional_quiz" style="display: inline-block;margin: 8px 20px !important;"><b>Total Marks : <span id="mkspan"> <?php echo $quiz->total_marks ? $quiz->total_marks : '0'; ?> </span></b>
	<input value="<?php echo $quiz->total_marks ? $quiz->total_marks : '0'; ?>" name="total_marks" class='totmk' type="hidden"> 
	<input value="<?php echo (isset($quiz->exam_id) ? $quiz->exam_id : '0'); ?>" id="exam_id" name="exam_id" type="hidden"> </h2>
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
		<a href='<?php echo base_url(); ?>admin/exams/examlist' style="float: right;" class='btn btn-danger'>Cancel</a>
		<?php
	}
	?>
<?php else: ?>
<a href='<?php echo base_url(); ?>quizzes/<?php echo $page?>/' style="float: right;" class='btn btn-danger'>Cancel</a>
<?php endif ?>
<?php else: ?>
<?php if ($qid != "0"): ?>

    	<a href='<?php echo base_url(); ?>admin/exams/examlist' style="float: right;" class='btn btn-danger'>Cancel</a>

	    <?php else: ?>

	    	 <a href='<?php echo base_url(); ?>quizzes/newque/<?php echo $page?>/' style="float: right;" class='btn btn-dangers'>Cancel</a>

	    <?php endif ?>

    <?php endif ?>
    	<a style="float: right; margin-right:10px;" class="btn btn-danger" onclick="return validate()">Update</a>
 		<!-- <a style="float: right; margin-right:10px; margin-top: 2px;">
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?>
            </a>  -->
            <span style="display: none;">
            <?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?>
            </span>
  <!-- <a href="#" id="getpreview" style="float: right; margin-right:10px; margin-top: 4px;" class="btn btn-info" data-toggle="modal" data-target="#preview_modal">Preview</a> -->
</div>
<div>
<span class="clearFix"> </span>
</div>
			<div class="clr"></div>

<hr />



<div id="ex_form">
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active general">
				<a href="#home" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">General</span>
				</a>
			</li><li>
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
					
 <dd>           
        <div>
		
		<div class="" data-collapsed="0">
			<div class="panel-body form-horizontal form-groups-bordered">
				
                <div class="form-group">
						
						<label for="name"><?php echo lang('web_name')?>
						<span class="required">*</span></label>
						<div class="col-sm-9">
							
                           <input id="ex_name" type="text" class="" name="name" maxlength="256" value="<?php echo set_value('name', (isset($quiz->exam_title)) ? $quiz->exam_title : ''); ?>"   data-validation-error-msg="Enter valid quiz name." />
                           <span id="err_ex_name" style="color: red;font-size: 15px;"></span>

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_name-target" class="tooltipicon"></span>

						<span class="reg_quizz_name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('quizz_fld_regular-name');?>

						</span>

						</span>

                    <span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>

                   
					
					<div class="form-group">
						
						<label for="description"><?php echo lang('web_description')?></label>

						<div class="col-sm-9">

                      	<textarea id="description"  name="description22"  class="ex-desc" rows="6"/><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>
                      	<!-- tooltip area -->
                      	<textarea id="ex_desc" name="description" style="display: none" ><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_desc-target" class="tooltipicon"></span>

						<span class="reg_quizz_desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('quizz_fld_regular-description');?>

						</span>

						</span>

						</div>
					</div>
                                     
                    <div class="form-group">
						<label>Quiz Type</label>

							<div class="radio-set radioGraySet">
                                <span class="radio radio-inline" style="margin-right: 20px">
                                    <input type="radio" class="extype" id="practice" name="exam_type"
                                     value="1" <?php echo ($quiz->exam_type==1) ? 'checked' : ''; ?> > Try and Learn</span> 
                                <span class="radio radio-inline">
                                    <input type="radio" class="extype" id="term" name="exam_type" value="2" <?php echo ($quiz->exam_type==2) ? 'checked' : ''; ?> >Regular Quiz</span>
                                <span class="radio radio-inline">
                                    <input type="radio" class="extype" id="survey" name="exam_type" value="3" <?php echo ($quiz->exam_type==3) ? 'checked' : ''; ?> >Survey - Feedback</span>
                                    <br>    
                                <p style="display: <?php echo ($quiz->exam_type==1) ? 'block' : 'none'; ?>" class="type_info practice">
                                	This is like a practice test and can be used to give learners a tool to check out their level of knowledge adequacy. 
                                </p>
                                <p style="display: <?php echo ($quiz->exam_type==2) ? 'block' : 'none'; ?>" class="type_info term">This is a test given to students during the course of study or training. Although the term can be used in the context of  training.</p>
                            </div>
					</div>
                    <div class="form-group">
	                        <label>Instructions</label>
	                        <span class="note1">(Give clear instructions for your quiz)</span>
	                        <div class="col-sm-9"> 
	                        <textarea style="width: 100%" name="instructions" rows="4"><?php echo ($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($quiz->instructions)) ? $quiz->instructions : ''); ?></textarea></div>
                	</div>
                	<div class="form-group">
                		<div class="">  
							<div class="checkbox">
								<label class="cb-wrapper" style="margin-bottom:0; width:auto;">
                                <input id="info_hide" type="checkbox" name="info_hide" value='1' <?php echo ($this->input->post('info_hide')) ? "checked" : ($quiz->info_hide==1) ? "checked" : ''?> />
                              
                                </label>
								<label class='labelforminline' for='published' style="margin-bottom:0; width:auto;">Hide instructions at leraner's end</label>
								<?php echo form_error('published'); ?>
							</div>
						</div>
                	</div>
                  <div class="form-group" style="margin: 0px -30px">

                    <div class="col-sm-6 Optional_quiz">
                        <label>Passing Score <span class="required">*</span></label>
                        
                        <div class="col-sm-8">
                        <input required="" class="" name="pass_score" id="pass_score" type="number" min="0" max="100" value="<?php echo $quiz->passing_score ? $quiz->passing_score : ''; ?>" style="width: 100px;background-image: url('/public/images/percent3.jpg')!important;background-repeat: no-repeat!important;background-position: center right 55%!important">
                        <span id="err_pass_score" style="color: red;padding-left: 10px;font-size: 15px;"></span>
                    </div>
                        <div class="col-sm-12" style="display: inline-block;">
                    <span class="note">(Give the passing score for your quiz.The passing score must be a positive number and cannot be greater than 100.)</span>
                </div>
                    </div>
                    	<div class="col-sm-6">
							<div class="checkbox">
								<label class="cb-wrapper" style="margin-bottom:0; width:auto;">
                                <input id="published" type="checkbox" name="published" value='1' <?php echo (isset($quiz->published)) ? "checked" : ''?> <?php echo $updType == 'create' ? 'checked' :''; ?> />
                              
                                </label>
								
								<label class='labelforminline' for='published' style="margin-bottom:0; width:auto;">Published</label>

								<?php echo form_error('published'); ?>
							</div>
						</div>
                </div>

				<div class="Optional_quiz">
                	<div class="form-group" style="margin: 0px -30px">
	                    <div class="col-sm-6">
	                        <label class="full-label">Feedback / Pass <span class="required">*</span>
	                        <span class="note">(Feedback for students if they pass)</span></label>
	                        <textarea required=""  name="pass_feedback" rows="4" ><?php echo ((isset($quiz->pass_feedback)) ? $quiz->pass_feedback : 'Congratulations, you passed.'); ?></textarea>
	                    </div>
	                   <div class="col-sm-6">
	                        <label class="full-label">Feedback / Fail <span class="required">*</span>
	                        <span class="note">(Feedback for students if they fail)</span></label>
	                        <textarea required="" name="fail_feedback" rows="4" ><?php echo ((isset($quiz->fail_feedback)) ? $quiz->fail_feedback : 'Sorry, you failed.'); ?></textarea>
	                    </div>
                  	</div>
                    <div class="form-group" style="margin: 0px -30px">
                    	<div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Show Score Realtime</label>
                            <span class="note">(Students can see their score after each answer. If 'Yes' students won't be able to go back and change answers)</span>
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
                            <span class="note">(Questions will appear in the order you choose)<br>&nbsp;</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="order_type"  value="1" <?php echo ($quiz->order_type==1) ? "checked" : ($updType == 'create') ? 'checked' :''; ?> > Static</label>
                                <label class="radio">
                                    <input type="radio" name="order_type" value="0" <?php echo ($quiz->order_type==0) ? "checked" : ($updType == 'create') ? 'checked' :''; ?> > Random</label>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="form-group" style="margin: 0px -30px">
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Students can skip Questions</label>
                            <span class="note">(Students can skip a question and answer it by going back before submitting the quiz)</span>
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
                            <label class="full-label">Students can retake the quiz</label>
                            <span class="note">(Students can retake the quiz to improve their score)<br>&nbsp;</span>
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

                <div class="form-group" style="margin: 0px -30px">
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Quiz has Time Limit</label>
                            <span class="note">(Students have to finish the quiz within this time limit)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input  type="radio" name="time_limit_b" value="1" class="exam_time" <?php  echo (($quiz->time_limit_b==1) ? "checked" : ''); ?> > Yes</label>
                                <label class="radio">
                                    <input type="radio" name="time_limit_b" value="0" class="exam_time" <?php  echo (($quiz->time_limit_b==0) ? "checked" : ''); ?> > No </label>
                            </div>
                        </div><br>
                        <div class="row" id="exam_time" style="padding-top: 0px;margin-bottom: 0px;display: <?php  echo (($quiz->time_limit_b==1) ? 'block' : 'none'); ?>" >
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px;float: left;width: auto;margin-right: 10px">
                                        <input name="duration_h" hours-only="" type="text" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->duration_h)) ? $quiz->duration_h : ''); ?> " placeholder="00" ><br>Hours                           
                                    </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px;float: left;width: auto;">
                                        <input name="duration_m" minutes-only="" type="text" style="width: 50px;text-align: center" value="<?php echo ((isset($quiz->duration_m)) ? $quiz->duration_m : ''); ?> " placeholder="00"><br>Minutes                         
                                    </div>
                            </div>
                    </div>
                    <div class="col-xs-6 form-inline">
                            <label class="full-label">Waiting Period</label>
                            <span class="note">(The period students have to wait before they can retake the quiz)</span>
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

                <div class="form-group" style="margin: 0px -30px">
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Score after submitting quiz</label>
                            <span class="note">(Student can see score after submitting the quiz)</span>
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
                            <span class="note">(Student can see answers only once, after submitting the quiz)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input  type="radio" name="show_right_answers" value="1" <?php  echo (($quiz->show_right_answers==1) ? "checked" : ''); ?> > Yes </label>
                                <label class="radio">
                                    <input type="radio" name="show_right_answers" value="0" <?php  echo (($quiz->show_right_answers==0) ? "checked" : ''); ?> >  No  </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
				</form>	
			</div>		
		</div>	
	</div>                    
</dd>
</div>
</div>
</div>
<input type="hidden" name="exam_category" id="exam_category" value="<?php echo isset($quiz) ? $quiz->exam_category : '' ?>" >            

  <?php 
  $CI = & get_instance();  

  $CI->load->model('admin/exam_model'); 
?>
<div class="tab-pane" id="Questions">
	<span style="color:red;font-size:15px;" id="err_atleast_ques"></span>
	<div class="tab-content">
<input type="hidden" class="col-sm-7 tampval"  placeholder=" Section title" >
<div id="main" class="no-padding paper_pattern ui-state-default sortable3" style="background-color: #f5f7f8;">
<?php
  $page_list = $CI->exam_model->get_pages($quiz->exam_id);

  $k=0; $j=0; $i=0;
   if($page_list){

  // page settings
  $sec_no = 1; $que_no = 0; 
  
  	foreach($page_list as $pg)
  	 { $i++;  ?>

  		<div class="page_block page ui-state-default sortable2" id="page_<?php echo $i; ?>">
 <?php
  		$sec_list = $CI->exam_model->get_section($quiz->exam_id, $i);
  		foreach($sec_list as $sec)
  	 	{
  	 		$que_no++;
  	 	 $sec_no = $j; 
  			$j++; ?>

  		<div class="page_block section ui-state-default sortable2" id="section_<?php echo $j; ?>" >
		
			<div class="ui-state-default mainPageSection">
			<i class='col-sm-1 select_icon sec_handle unmoved' id='iconSec_<?php echo $j; ?>'></i>
			<div class="col-sm-11 ui-state-disabled" id='sector_<?php echo $j; ?>'>
			<input id="secTitle_<?php echo $j; ?>" class='title_sec sec' name="section_<?php echo $j
			; ?>[]" placeholder="Section title" value='<?php echo $sec->section_title; ?>' >
			<input type="hidden" name="Quecat_<?php echo $j; ?>[]" id="Quecat_<?php echo $j; ?>">
			<input type="hidden" name="Quesubcat_<?php echo $j; ?>[]" id="Quesubcat_<?php echo $j; ?>">
			<input type="hidden" name="Questype_<?php echo $j; ?>[]" id="Questype_<?php echo $j; ?>">
			<input type="hidden" name="NumQues_<?php echo $j; ?>[]" id="NumQues_<?php echo $j; ?>" class="NumQues">
			<div id="getautoque_<?php echo $j; ?>"></div>

			<input type="hidden" name="Qids" id="sec_Qids_<?php echo $j; ?>">
			</div>
			<span id="section_<?php echo $j; ?>" class=" " ><img class='deletebtn' style="float: left" type='button' id="Secdel_<?php echo $j; ?>" src='/public/images/delete.3f3ed9f0.png' border='0' alt='Delete' title='Delete Section'></span>
			
			</div>
<?php
  			$que_list = $CI->exam_model->get_editQues($quiz->exam_id, $i, $j);
 			foreach ($que_list as $Qdata) 
 			{
 				$k = $que_no;
 				$Qdata2 = htmlspecialchars(json_encode($Qdata), ENT_QUOTES, 'UTF-8');

 				//$k++; ?>
 				<div class="page_block Quetext ui-state-default Ques" id="Que_<?php echo $k; ?>">
 			<div class='Qjson' id="Quejson_<?php echo $k; ?>" style="display: none;" marks="<?php echo $Qdata->que_marks ?>" data="<?php echo $Qdata2; ?>"></div> 
 				<span><img class='deletebtn' style="float: left" type='button' id="Quedel_<?php echo $k; ?>" src='/public/images/delete.3f3ed9f0.png' border='0' alt='Delete' title='Delete Question'></span>
				<span style='margin-right: 25px;margin-top: 5px;' class="span_marks"><p id='span_marks_<?php echo $k; ?>'>Marks : <?php echo $Qdata->que_marks;?></p></span>

				<div class="ui-state-default ui-state-disabled question_grp">
				<input type="hidden" class="Queset" id='status_<?php echo $k; ?>' name="status_<?php echo $k; ?>[]" value="update">
				
				<input type="hidden" class="Queset" id='qid_<?php echo $k; ?>' name="queid_<?php echo $j; ?>[]" value="<?php echo (isset($Qdata) ? $Qdata->id : ''); ?>" >
				<textarea id='ques_<?php echo $k; ?>' name='txtQuestion_<?php echo $j; ?>[]' style='display:none' class='Queset'><?php echo $Qdata->que_title; ?></textarea>	
				<span  id='showQue_<?php echo $k; ?>' class='Quetitle inputopenNav Queset Qele' ><?php if($Qdata->que_title) echo $Qdata->que_title;  else echo ""; ?> </span>
				
				<!--  -->
				</div>
			</div>
 <?php		$que_no++;		
 			} 
 			?>
 			<script type='text/javascript'> 				
 				addQue('Que_<?php echo $k; ?>');
 			</script>
 			<?php $k++;?>
			</div>
		<?php } ?> </div>
  		<script type='text/javascript'> 
 				secAdd('secTitle_<?php echo $j; ?>');
 		</script>
 		 	<?php $j++;	$k++; ?>
	  </div>
		 <?php

  	}
  	}
  	else{  ?><div class="page_block page ui-state-default sortable2" id="page_1">
	<div class="page_block section ui-state-default sortable2" id="section_1" >		
		
		<div class="ui-state-default mainPageSection">
		<i class='col-sm-1 select_icon sec_handle unmoved' id='iconSec_1'></i>
		<div class="col-sm-11 ui-state-disabled" id='sector_1'>
		<input id="secTitle_1" class='demoSec title_sec sec' name="section_1[]" placeholder="Section title" >
		<input type="hidden" name="Quecat_1[]" id="Quecat_1">
		<input type="hidden" name="Quesubcat_1[]" id="Quesubcat_1">
		<input type="hidden" name="Questype_1[]" id="Questype_1">
		<input type="hidden" name="NumQues_1[]" id="NumQues_1" class="NumQues">
		<div id="getautoque_1"></div>

		<input type="hidden" name="Qids" id="sec_Qids_1">
		<span><img class='deletebtn' style='float: left;display:none' type='button' id='Secdel_1' src='/public/images/delete.3f3ed9f0.png' border='0' alt='Delete' title='Delete Section'></span>
		</div>
		
		
		</div>
		 
		<div class="page_block Quetext ui-state-default Ques" id="Que_1">
				 
		<div class='Qjson' id="Quejson_1" style="display: none;" data="" mark=""></div>
		<span><img style='display:none' class='deletebtn' type='button' id='Quedel_1' src='/public/images/delete.3f3ed9f0.png' border='0' alt='Delete' title='Delete Question'></span>
		<span style='margin-right: 25px;margin-top: 5px;' class="span_marks"><p id='span_marks_1'></p></span>
			<i class='select_icon handle unmoved Queset Qele' id='icon_1'></i>

			<div class="ui-state-default ui-state-disabled question_grp">
			
			<input type="hidden" id='qid_1' class='form-control Queset' name="queid_1[]" value="" >
			<textarea id='ques_1' name='txtQuestion_1[]' style='display:none' class='Queset'></textarea>	
			<p type='' id='showQue_1' class='demoQue Quetitle inputopenNav Queset Qele' placeholder=' + Add a new question here' >+ Add a new question here</p>
			</div>
		</div>
	</div>
</div>
 		<?php
  	} ?>
</div>
</div>	
</div>
</div>		
</div>
<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$quiz->exam_id) ?>
<?php endif ?>
<?php echo form_close(); ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#Qspan").html($(".Quetitle:not(.demoQue)").length);
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
 	  tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
selector : ".ex-desc",

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
function validate(){
	var ex_name = $("#ex_name").val().trim();
	var pass_score = $("#pass_score").val().trim();
	var totmk = $(".totmk").val().trim();
	if(ex_name == ''){
		$(".nav-tabs li.general").addClass('active').siblings().removeClass('active');
		$(".tab-content #home").addClass('active').siblings().removeClass('active');
		$("#err_ex_name").html('Please enter name.');
		$("#ex_name").focus();
		setTimeout(function(){$("#err_ex_name").html('');$("#ex_name").focus();},2000);
		return false;
	}
	if(pass_score == ''){
		$(".nav-tabs li.general").addClass('active').siblings().removeClass('active');
		$(".tab-content #home").addClass('active').siblings().removeClass('active');
		$("#err_pass_score").html('Please enter score.');
		$("#pass_score").focus();
		setTimeout(function(){$("#err_pass_score").html('');$("#pass_score").focus();},2000);
		return false;
	}
	if(totmk == '' || totmk == 0){
		$(".nav-tabs li.general").removeClass('active').siblings().addClass('active');
		$(".tab-content #home").removeClass('active').siblings().addClass('active');
		$("#err_atleast_ques").html('Please enter atleast one Question.');
		setTimeout(function(){$("#err_atleast_ques").html('');},2000);
		return false;
	}
	
	$("#submit").click();
	var ex_desc = tinymce.get('description').getContent();
	$(document).find('#ex_desc').text(ex_desc);
	// console.log(ex_desc);
	return true;
}

</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script type="text/javascript">
	
	$(document).ready(function() { 
        $j('#examsubmitid').ajaxForm({
         	beforeSend: function() {
        	var ex_title = $('#ex_name').val();
        },
        success: function(insert_id) {
     		var msg = "";
            var updType = "<?php echo $updType ?>";
              if(insert_id)
              {
                 
                 if(updType == "create")
                 {
                 	msg = "Quiz successfully created";
                 } else{ msg = "Quiz successfully updated"; }
        var strcontent1 ='<center><h4 style="padding:2%;text-align:center;font-weight:bold;color:#016ac1">'+msg+'! </h4></center>';
          jQuery.alert({
                 title: "Success",
              content: strcontent1,
             confirm: function()
                         { 
                         	var seg2 = "<?php echo $this->uri->segment(2); ?>";
                         	var seg3 = "<?php echo $this->uri->segment(4); ?>";
	            			var seg4 = "<?php echo $this->uri->segment(5); ?>";
                         	if(updType == 'create')
                         	{
                         
		            			if(seg3 && seg4){
	                          		window.location ="<?php echo base_url();?>admin/"+seg2+"/exam/"+seg3+"/"+seg4+"/"+insert_id;
		            			}else{
		            				window.location ="<?php echo base_url();?>admin/exams/examlist";
		            			}

                         	}
                         	else{
                         		
		            			if(seg3 && seg4){
	                          		window.location ="<?php echo base_url();?>admin/"+seg2+"/exam/"+seg3+"/"+seg4+"/"+insert_id;
		            			}else{
                          		window.location ="<?php echo base_url();?>admin/exams/examlist";
                          		}
                      		}
                         }
                     });
              }
             else
              {
                jQuery.alert({
                title: "Error",
                content: '<center><h4 style="padding:2%;text-align:center;font-weight:bold;color:#016ac1"> Fail to '+updType+' quiz,<br>Please try again!.. </h4></center>',
                  confirm: function()
                    {
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
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent",
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

	$(document).ready( function() {
		$(document).find('#Qform').hide();
		var exam_type = "<?php echo $quiz->exam_type ?>";
		if(exam_type==3){
			$('.Optional_quiz').hide();
			$('form#examsubmitid').find('#pass_score').val("0");
		}
		else{
			$('.Optional_quiz').show();
		}
	});

	$('#setmanual').on('click', function(){
		$(document).find('#Qform').show();
		$(document).find('#Qexist').hide();
		var exam_type = $("input[name=exam_type]:checked").val();
		if(exam_type==3){
			$(document).find('#Qform').find('.Optional_quiz').hide();
			$(document).find('#Qform').find('.chkOpt').hide();
		}
		else{
			$(document).find('#Qform').find('.Optional_quiz').show();
			$(document).find('#Qform').find('.chkOpt').show();
		}
	});
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
        url: base_url+'admin/exams/noQues',
        success: function(data){
        	if(data){
        		$(document).find('#NumQues').attr('placeholder','Limit upto '+data.length+' Questions');
        		
        		$(document).find('#availQues').val(data.length);
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
	if(selected)
	{
		$j.ajax({
			type: 'POST',
			data: {id:selected},
			url: base_url+'admin/exams/appendQues',
	        success: function(data){
	         	var Quesdata = jQuery.parseJSON(data);
			    $.each(Quesdata, function(key, value ){
			    	appendSelected(value);
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
        url: base_url+'admin/exams/getsubcategory/'+cat,
        success: function(data) { 
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
        url: base_url+'admin/exams/getQuetypes/'+subcat+'/'+cat,
        success: function(data){ 
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
$('#NumQues').on('keyup keydown', function(){
     if(!chkavail(this.value))
     {
         this.value = oldValue;
         counterror.innerHTML = 'Questions not available!';
     }
     else{ oldValue = this.value;   counterror.innerHTML = ''; }
});
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
        url: base_url+'admin/exams/noQues',
        success: function(data){
        	// console.log(data.length);
        	if(data){
        		$(document).find('#NumQues').attr('placeholder','Limit upto '+data.length+' Questions');
        		var ele_info = $('.tampval').val();
        	var ele_id = ele_info.split('_');
        	$(document).find('#'+ele_info).find('#NumQues_'+ele_id[1]).val(data.length);
        		$(document).find('#availQues').val(data.length);
   			}
        },
        error: function(data)
		{
			console.log(data.responseText);
		}
    });

});

$('#getpreview').on('click', function(){
	
	$(document).find('#sidebar').hide();
	$(document).find('#preview_modal').find('.modal-body').html('');
	var title = $('form#examsubmitid').find('#ex_name').val();
	var duration = $('form#examsubmitid').find('#limit_time_l').val();
	if($('#exam_category').val() == 'manual'){
		var Qlength = 1;
		var totQ = $('.Ques').length;
		for (var i = 1; i <= totQ; i++) {
			var Quetitle = $('#showQue_'+i).text();
			if(Quetitle =="Add a new question by typing here" || Quetitle =="+ Add a new question here" ) { 
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
  url: base_url+'admin/exams/exampreview/',
        success: function(data){
        	
        	if(data)
        	{
        		$('#preview_modal').find('.modal-body').html(data);
        	}
        }
    });
});

$('#popclose').click(function(){
	var fname = $(document).find('#filenm').text();
	$.ajax({
	      url: base_url+'admin/exams/deletejsonfile',
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
		 url: base_url+'admin/exams/appendQues',
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
        url: base_url+'admin/exams/getQuetypes/'+subcat+'/'+cat,
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
	        }
	    });
		}
		else{
			 subcat = $(document).find('#'+ele_info).find('#Quesubcat_'+ele_id[1]).val();
	    Qty = $(document).find('#'+ele_info).find('#Questype_'+ele_id[1]).val();
		getlist(cat,div_id[1],subcat,Qty);
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
        url: base_url+'admin/exams/noQues',
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
        url: base_url+'admin/exams/getsubcategory/'+cat,
        success: function(data) { 
        	  
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