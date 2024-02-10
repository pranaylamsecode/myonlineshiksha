<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/js/exam/exam.css">
<style type="text/css">
	textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{
		width: 220px;
	}

.paradesc{
	float: left!important;
	font-size: 12px!important;
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
.nav.nav-tabs > li > a, .nav.nav-tabs > li > a:hover {
	padding: 10px 25px !important;
	font-size: 14px;
	color: #454545;
	margin-right: 0px !important;
	background: #f0eef2;
	margin-left: 0px !important;
	border: 0px !important;
}
.main-container .nav-tabs > li.active > a, .main-container .nav-tabs > li.active > a:hover {
	border-bottom: 0px !important;
	background: #00ADEF !important;
	color: #fff !important;
	border: 0px !important;
}

label {
	color: #555;
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
label{
	float: left;
	width: 130px;
	font-size: medium;
}
div#home {
	padding: 0px 0px !important;
}	
.full-label{
	width: 100% !important;
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
<!-- <script src="<?php echo base_url(); ?>public/js/form-master/jquery.form.js"></script>
 -->
<!-- <link rel="stylesheet" href="<?php echo base_url() ?>public/default/css/lecture_dashboard.css"> -->
<!-- <link rel="stylesheet" href="<?php echo base_url() ?>public/css/lesson/lecture_preview.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script> -->
 <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<style type="text/css">
.validateerror {
   float: left;
   text-align: center;
   width: 40%;
   margin-left: 235px;
   color: red;
}
h2 {
	margin-top: 0px !important;
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
.exam_create .main-content{
	padding: 0px !important;
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

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 280px; }
  #sortable li { padding-left: 1.5em; font-size: 1.4em; height: 46px; }
  #sortable li span { margin-left: -1.3em; }
</style>
	
<!--/lightbox scripts and style -------------------------->

<div>
    <h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>

    <?php if($updType != 'edit'){

	$qid = '';

	}?>

<?php $CI = & get_instance();
		$CI->load->model('admin/exam_model');
 ?>
</div>

<header>
  <section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 no-padding">
          <h2>
            <?php echo (($updType == 'edit')?'Edit Quiz':'Create Quiz');?>
          </h2>
        </div>
      </div>
    </div>
  </section>
</header>
 <!-- The Modal -->
  <div class="modal fade" id="preview_modal">
    <div class="modal-dialog exam_preview modal-dialog-centered modal-lg">
    	<button type="button" class="close exam_preview_close_btn" data-dismiss="modal" id="popclose" title="Close">&times;</button>
        <!-- Modal body -->
        <div class="modal-body">
        	
        </div>
      </div>
    </div>
<div id="ex_overlay"></div>
<div class="main-container" style="min-height: 820px;">
	<div class="row">

<div id="mySidenav" class="sidenav exam-txt">
<div id="btn-sticky" >
	<div style="float: left;">
	<button class='deletebtn' style="float: left" type='button' id="" ><img src='/public/images/delete.3f3ed9f0.png' border='0' alt='Delete' title='Delete'></button>
	<button type='button' style="float: left" class="closebtn">&times;</button>
	</div>
	<button class='btn' style="float: right" type='button'  id="import_ques">Import Questions</button>
	<div style="float: right;"><button class='btn' style="float: right" id="Qupdate" type='button' >Add Question</button></div>

</div>
			  
		
		<!-- <div id="variety" style="display: none;" class="two_btn">
			<a id="setmanual" class="set-manual_btn">Set manually</a>
			<a id="setexist" class="set_form_btn">Set Form Question Pool</a>
		</div> -->
		<!-- <div id="Qexist" style="display: none!important" class="qexist-table-sec">
			<div class="inner_content">
			<?php echo $this->load->view('admin/exams/quesetting'); ?>
				<div class="instrctn_btn123 view-que">
					<button class="getQues exit_btn123" type="button">View Questions</button>
					<button id="addselected" class="exit_btn123" type="button" >Add Selected Questions</button>
				</div>
			<div id='SortQlist'>
				<TABLE id="dataTable" border="1">
			    <tr>
			        <th>
			            <input type="checkbox" id="chk_all" onchange="checkAll(this)" name="chk[]" />
			        </th>
			        <th>Select All Question</th>
			    </tr>
				</TABLE>
			</div>
			</div>
		</div> -->
		<div id="Qexist" style="display: none!important; padding-top: 20px;" class="qexist-table-sec">
			<div id="message" style="font-size: 18px;"></div>
			<div class="inner_content">
	            <form method="post" action="" enctype="multipart/form-data">
	    			<div class="col-sm-12" style="padding-top: 20px;">
		    			<label class="control-label field-title">CSV file <span class="error">* </span></label>
	                  	<input id="bulk_upload" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
	    			</div>
	    			<div class="col-sm-12" style="padding-top: 20px;">
	                  	<label class="col-sm-12">you may want to see
	                  	<a href="<?php echo base_url();?>public/uploads/sample_ques.csv" style="color: #36c;padding: 0 !important;font-size: 18px;position: inherit;right: 0;top: 0" download="">the example of the CSV file</a>
	                  		<span id="err_file" style="color: red"></span></label>
                  	</div>
    				<div class="col-sm-4 col-md-4">
                  		<button type="button" id="upd_btn" class="btn btn-success btn-lg" onclick="return upload();" style="width: 75% !important;">Import
                  		</button>
					</div>
            </form>

<script type="text/javascript">
  function upload()
  {
    var fileInput = document.getElementById('bulk_upload'); 
    var filePath = fileInput.value; 
    var allowedExtensions = /(\.csv)$/i; 
    if(filePath == ''){
        $("#err_file").html('select .csv file to import').fadeIn().delay(2500).fadeOut(); 
        fileInput.value = ''; 
        return false; 
    }
    if (!allowedExtensions.exec(filePath)) { 
        $("#err_file").html('invalid file type. please upload only .csv file').fadeIn().delay(2500).fadeOut(); 
        fileInput.value = ''; 
        return false;
    }  
    var base_url = $("#base_url").val().trim();
    var bulk_upload = $("#bulk_upload")[0].files[0];

    Que_id = $(document).find('.tampval').val();
	section_id = $(document).find('#'+Que_id).parent().attr('id').split('_');
	page_id = $(document).find('#'+Que_id).parent().parent().attr('id').split('_');
	pg_des = $(document).find('#txt_page_'+page_id[1]).val();
	sec_des = $(document).find('#secDesc_'+section_id[1]).html();
	pageTitle = $(document).find('#pageTitle_'+page_id[1]).val();
	secTitle = $(document).find('#secTitle_'+section_id[1]).val();
	var exam_id = $('#exam_id').val().trim();
	if(exam_id == '')
		exam_id = "<?php echo $this->uri->segment(4) ? $this->uri->segment(4) : '0'; ?>";


    var new_formdata= new FormData();
    new_formdata.append('bulk_upload',bulk_upload);
    new_formdata.append("exam_id", exam_id);
    new_formdata.append("page_id", page_id[1]);
    new_formdata.append("section_id", section_id[1]);
    new_formdata.append("pg_des", pg_des);
    new_formdata.append("sec_des", sec_des);
    new_formdata.append("pageTitle", pageTitle);
    new_formdata.append("secTitle", secTitle);

    $("#upd_btn").removeAttr('onclick');
    $("#upd_btn").html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Please wait...');
    $.ajax({
      type:"post",
      cache:false,
      contentType:false,
      processData:false,
      timeout: 6000000,
      url : "<?php echo base_url();?>admin/exams/excel_upload",
      data:new_formdata,
      
      success:function(returndata)
      {
          $("#upd_btn").attr('onclick','return upload()');
          $('#upd_btn').html('Import');
          var obj = $.parseJSON(returndata);
          if(obj.msg == 'empty'){
          	var str = '<div class="alert alert-danger alert-dismissible fade in"> <strong class="fa fa-exclamation-triangle" aria-hidden="true"></strong> Please select a file to upload. </div>';
          	$("#message").html(str);
          	setTimeout(function(){
          		$("#message").html('');
          	},2000);
          }else if(obj.msg == 'expired'){
            var str = '<div class="alert alert-danger alert-dismissible fade in"> <strong class="fa fa-exclamation-triangle" aria-hidden="true"></strong> Session Expired. Please re-login and try again. </div>';
          	$("#message").html(str);
          	setTimeout(function(){
          		window.location.href = base_url;
          	},2500);
          }else{
          	if(obj.total == 1)
          		var num_Ques = "1 Question";
     		else
          		var num_Ques = obj.total + " Questions";

          	$("#Qspan").html(obj.total);
          	var str = '<div class="alert alert-success alert-dismissible fade in"> <strong class="fa fa-check" aria-hidden="true"></strong> '+ num_Ques +' Uploaded.</div>';
          	$("#message").html(str);
          	setTimeout(function(){
          		$("#message").html('');

          		$('#ex_overlay').hide();
				$('#main').removeClass('mainAppend');
				$('.page span').css('margin-left', '0');
				document.getElementById("mySidenav").style.width = "0";
				document.getElementById("main").style.marginRight= "0";
				document.getElementById("sticky").style.marginRight = "0";
          	},2000);
          	$("#section_1").html(obj.output);
          	$(document).find('.totmk').val(obj.totmk);
          	$(document).find('#mkspan').html(obj.totmk);
          }
      }
    });
  }
</script>
				</div>
            <input type="hidden" id="base_url" value="<?php echo base_url();?>">
		</div>

		<div id="Qform">

			<?php echo $this->load->view('admin/exams/addquestion'); ?>
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
		<!-- ***** -->

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
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/exams/exam_submit', $attributes) : form_open_multipart(base_url().'quizzes/edit/'.$qid, $attributes);
?>

<input type="hidden" name="exam_category" id="exam_category">
<div id="sticky-anchor">
	<div class='totshow'>
		<h2 class="Optional_quiz"><b>Total Questions : <span id="Qspan">0</span></b></h2>
	</div>
</div>
<div id="sticky" class="">
	<h2 class="Optional_quiz" style="display: inline-block;margin: 8px 20px !important;">
		<b>Total Marks : <span id="mkspan"> 0 </span></b>
		<input value="0" name="total_marks" class='totmk' type="hidden"> 
		<?php $auth = $this->session->userdata('logged_in');
			$temp_id = md5(date("Y-m-d h:i:s").$auth['id']); ?>
		<input value="<?php echo $temp_id;?>" id="exam_id" name="exam_id" type="hidden">
	</h2>
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
<a href='<?php echo base_url(); ?>admin/exams/examlist' style="float: right;" class='btn btn-danger'>Cancel</a>
<?php endif ?>
<?php else: ?>
<?php if ($qid != "0"): ?>

    	<a href='<?php echo base_url(); ?>admin/exams/examlist' style="float: right;" class='btn btn-danger'>Cancel</a>

	    <?php else: ?>

	    	 <a href='<?php echo base_url(); ?>admin/exams/examlist' style="float: right;" class='btn btn-dangers'>Cancel</a>

	    <?php endif ?>

    <?php endif ?>
    		<a style="float: right; margin-right:10px;" class="btn btn-danger" onclick="return validate()">Save</a>
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



<div>
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="general active">
				<a href="#home" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">Quiz Info</span>
				</a>
			</li><li>
				<!-- data-toggle="tab"-->
				<a id="quetab" href="#Questions" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Questions</span>
				</a>
			</li>
			
			<!-- <li>
				<a href="#settings" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Settings</span>
				</a>
			</li> -->
		</ul>
		
<div class="tab-content">

<div class="tab-pane active" id="home">
				
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
	<div class="scrollable" data-height="120" style="overflow: hidden; width: auto; height: auto;">
					
         <!-- class="<?php echo ($questions)?'':'selected' ?>"            -->
<dd>           
        <div>
		
		<div class="" data-collapsed="0">		
			 <!-- <legend style="font-size:14px; color: #09C; font-weight:bold; text-transform: uppercase;">New Exam</legend> -->
			<div class="panel-body form-horizontal form-groups-bordered">
				
				
                <?php if($updType == 'create'){ ?>
				<!--<legend style="font-size: 16px; color: #c42140;">New Exam</legend>-->
                
				<?php } ?>
				<?php if($updType == 'edit'){ ?>
				<!--<legend style="font-size: 16px;">Edit Exam</legend>-->
                <legend style="color: #09c; font-size: 14px; font-weight: bold; text-transform: uppercase;">Edit Quiz</legend>
				<?php } ?>
                <!-- <input id="exam_id" type="hidden" class="" name="exam_id" maxlength="256" value="<?php echo (isset($quiz->exam_id) ? $quiz->exam_id : '0'); ?>" > -->
					<div class="form-group">
						
						<label for="name"><?php echo lang('web_name')?>
						<span class="required">*</span></label>
						<div class="col-sm-9">
							
                           <input id="ex_name" type="text" class="" name="name" maxlength="256" value="<?php echo set_value('name', (isset($quiz->exam_title)) ? $quiz->exam_title : ''); ?>"   data-validation-error-msg="Enter valid exam name." />
                           <span id="err_ex_name" style="color: red;font-size: 15px;"></span>
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



                       	<textarea id="description"  name="description22"  class="ex-desc" rows="6"/><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>
                      	<!-- tooltip area -->
                      	<textarea id="ex_desc" name="description" style="display: none" ><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>

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
						<label>Quiz Type</label>
						
						
							<div class="radio-set radioGraySet">
                                <span class="radio radio-inline" style="margin-right: 20px">
                                    <input type="radio" class="extype" id="practice" name="exam_type" value="1" > Try and Learn</span> 
                                <span class="radio radio-inline">
                                    <input type="radio" class="extype" id="term" name="exam_type" value="2" checked>Regular Quiz</span>
                                <span class="radio radio-inline">
                                    <input type="radio" class="extype" id="survey" name="exam_type" value="3">Survey - Feedback</span>
                                    <br>
                                <p style="display: block;" class="type_info practice">
                                	This is like a practice test and can be used to give learners a tool to check out their level of knowledge adequacy. 
                                </p>
                                <p style="display: none" class="type_info term">This is a test given to students during the course of study or training. Although the term can be used in the context of  training.</p>
                                <p style="display: none" class="type_info survey">Its like a survey questions to determine as a feedback.</p>
                                	 <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="quiz_type-target" class="tooltipicon"></span>

						<span class="quiz_type-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo 'Select Quiz Type'; //echo lang('quizz_fld_regular-show_countdown');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
                            </div>
				




						
                       
					</div>

					

                    <div class="form-group">
	                        <label>Instructions</label>
	                        <span class="note1">(Give clear instructions for your quiz)</span>
	                        <div class="col-sm-9"> 
	                        <textarea style="width: 100%" name="instructions" rows="4"></textarea></div>
                	</div>

                	<div class="form-group">
                	<div>  
                         <!-- <label style="width: 85px;"></label> -->
							<div class="checkbox">
                            <?php //$published = ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''; ?>
								<label class="cb-wrapper" style="margin-bottom:0; width:auto;">
                                <input id="info_hide" type="checkbox" name="info_hide" value='1' <?php echo ($this->input->post('info_hide')) ? "checked" : ($quiz->info_hide==1) ? "checked" : ''?> />
                              
                                </label>
								
								<label class='labelforminline' for='info_hide' style="margin-bottom:0; width:auto;">Hide instructions at learner's end</label>

								<?php echo form_error('info_hide'); ?>
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
                    
                  <div class="form-group" style="margin: 0px -30px">

                    <div class="col-sm-6 Optional_quiz">
                        <label>Passing Score<span class="required">*</span></label>
                        
                        <div class="col-sm-8">
	                        <input required="" class="" name="pass_score" id="pass_score" type="number" min="0" max="100"  style="width: 100px;background-image: url('<?php echo base_url(); ?>public/images/percent3.jpg')!important;background-repeat: no-repeat!important;background-position: center right 55%!important">
	                        <span id="err_pass_score" style="color: red;padding-left: 10px;font-size: 15px;"></span>
	                    </div>
                        <div class="col-sm-12" style="display: inline-block;">
                        <span>(Give the passing score for your quiz.The passing score must be a positive number and cannot be greater than 100.)</span></div>
                        <!-- ngIf: validateForm.pass_score.$invalid && !validateForm.pass_score.$pristine -->
                        <!-- <span class="tooltipcontainer">

						<span type="text" id="pass_score-target" class="tooltipicon"></span>

						<span class="pass_score-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip" ></span>

						 The passing score must be a positive number and cannot be greater than 100.

						</span>

						</span> -->
						<!-- </div> -->

                    </div>
                    	<div class="col-sm-6">  
                         <!-- <label style="width: 85px;">Publish</label> -->
							<div class="checkbox">
                            <?php //$published = ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''; ?>
								<label class="cb-wrapper" style="margin-bottom:0; width:auto;">
                                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''?> <?php echo $updType == 'create' ? 'checked' :''; ?> />
                              
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
                
				<div class="Optional_quiz">
                	<div class="form-group" style="margin: 0px -30px">
	                    <div class="col-sm-6">
	                        <label class="full-label">Feedback / Pass<span class="required">*</span>
	                        <span class="note">(Feedback for students if they pass)</span></label>
	                        <textarea required=""  name="pass_feedback" rows="4" >Congratulations, you passed.</textarea>
	                        <!-- ngIf: validateForm.pass.$invalid && !validateForm.pass.$pristine -->
	                    </div>
	                   <div class="col-sm-6">
	                        <label class="full-label">Feedback / Fail<span class="required">*</span>
	                        <span class="note">(Feedback for students if they fail)</span></label>
	                        <textarea required="" name="fail_feedback" rows="4" >Sorry, you failed.</textarea>
	                        <!-- ngIf: validateForm.fail.$invalid && !validateForm.fail.$pristine -->
	                    </div>
                  	</div>
                    <div class="form-group" style="margin: 0px -30px">
                    	<div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Show Score Realtime</label>
                            <span class="note">(Students can see their score after each answer. If 'Yes' students won't be able to go back and change answers)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="view_score_realtime" value="1"  > Yes </label>
                                <label class="radio">
                                    <input type="radio" name="view_score_realtime"  value="0" checked="checked"> 
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
                                    <input type="radio" name="order_type"  value="1" > Static                                </label>
                                <label class="radio">
                                    <input type="radio" name="order_type" value="0" checked="checked"> Random                                </label>
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
                                    <input type="radio" name="skip" value="1" checked="checked"> Yes                                </label>
                                <label class="radio">
                                    <input type="radio" name="skip" value="0"> No                                </label>
                            </div>
                        </div>
                    </div>  
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Students can retake the quiz</label>
                            <span class="note">(Students can retake the quiz to improve their score)<br>&nbsp;</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" class="retake" name="retake" value="1"> Yes                                </label>
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" class="retake" name="retake" value="0" checked="checked"> No                                </label>
                               
                                    <div id="times" style="text-align: center;padding: 0px;margin: 0px;float: left;display: none">
                                        <select name="attempt_limit" style="margin-left: 10px">
                                        	<option value="11">Unlimited times</option>
                                   <?php for ($i=2; $i <=10; $i++) { 
                                        	
                                        	echo '<option value='.$i.'>'.$i.' times</option>';	
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
                                    <input  type="radio" name="time_limit_b" value="1" class="exam_time"> Yes</label>
                                <label class="radio">
                                    <input type="radio" name="time_limit_b" value="0" class="exam_time" checked="checked"> No </label>
                                <!-- ngIf: exam.time_limit_b == 1 -->
                            </div>

                            
                        </div><br>
                        <div class="row" id="exam_time" style="padding-top: 20px;margin-bottom: 0px;display: none" >
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px;float: left;">
                                        <input name="duration_h" hours-only="" type="text" style="width: 50px;text-align: center" placeholder="00"><br>Hours                           
                                    </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0pxfloat: left;">
                                        <input name="duration_m" id="duration_m" minutes-only="" type="text" style="width: 50px;text-align: center" placeholder="00"><br>Minutes                         
                                    </div>
                            </div>
                    </div>
                    <div class="col-xs-6 form-inline">
                            <label class="full-label">Waiting Period</label>
                            <span class="note">(The period students have to wait before they can retake the quiz)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input type="radio" name="wait_b" value="1" class="wait_time"> Yes </label>
                                <label class="radio">
                                    <input type="radio" name="wait_b" value="0" class="wait_time" checked="checked"> No </label>
                                
                        </div><br>
                        <div class="row" id="wait_time" style="padding-top: 20px;margin-bottom: 0px;display: none">
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px;">
                                        <input name="wait_w" type="text"  weeks-only="" style="width: 50px;text-align: center"><br>Weeks                                   
                                         </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px">
                                        <input name="wait_d" type="text" days-only="" style="width: 50px;text-align: center"><br>Days                                    
                                    </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px">
                                        <input name="wait_h" type="text"  hours-only="" style="width: 50px;text-align: center"><br>Hours                                   
                                    </div>
                                    <div class="col-sm-3" style="text-align: center;padding: 0px;margin: 0px">
                                        <input name="wait_m" type="text" minutes-only="" style="width: 50px;text-align: center"><br>Minutes                                    
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
                                    <input type="radio" name="see_result"  value="1" checked="checked"> Yes</label>
                                <label class="radio">
                                    <input type="radio" name="see_result" value="0"> No </label>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 form-inline">
                        <div>
                            <label class="full-label">Answers Visibility</label>
                            <span class="note">(Student can see answers only once, after submitting the quiz)</span>
                            <div class="radio-set radioGraySet">
                                <label class="radio" style="margin-right: 20px">
                                    <input  type="radio" name="show_right_answers" value="1"> Yes 
                                </label>
                                <label class="radio">
                                    <input type="radio" name="show_right_answers" value="0" checked="checked"> No                                </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

				</form>	
			<!-- <div id="btnQues">
				<a href="#Questions" class="Qselect autobtn btn">Auto Set Quiz Questions</a>
				<a href="#Questions" class="Qselect manualbtn btn">Manually create Quiz Questions</a>
			</div>	 -->		
			</div>		
		</div>	
	</div>                    
</dd>
</div>
</div>
</div>
<input type="hidden" name="examQuestype" id="examQuestype">            
<div class="tab-pane" id="Questions">
	 <!-- class="<?php echo ($questions)?'selected': ''?>" -->
	<span style="color:red;font-size:15px;" id="err_atleast_ques"></span>
<div class="tab-content">
<!-- <button type="button" class="autobtn">Auto Set Exam Questions</button>
<button type="button" class="newbtn">Create/Set Exam Questions</button>
 -->

<!-- Side bar settings  -->
<!-- <div id="newQuetab" >	 -->
 <input type="hidden" class="col-sm-7 tampval"  placeholder=" Section title" >
	<!-- section page settings  -->
<div id="main" class="no-padding paper_pattern ui-state-default sortable3" style="background-color: #f5f7f8;">
<div class="page_block page ui-state-default sortable2" id="page_1">
	
		<!-- <div class=" ui-state-default mainPageSection">
			<i class='col-sm-1 select_icon page_handle' id='Picon_1'></i>
		<div class="col-sm-11 ui-state-disabled"  id='pgbox_1'>
		<input id="pageTitle_1" class='title_page openNav' name="page_title[]" placeholder=" Page title">
		<textarea id='txt_page_1' name='page_Desc[]' style='display:none' class=''></textarea>	
		<div id='pageDesc_1' class='page_Desc paradesc openNav' placeholder='Description (Optional)' >Description (Optional)</div>


		</div>
		<span id="page_1" class="openNav" ><img src="/public/images/page.07cfb8cf.png" role="presentation" data-radium="true" style="display: block;"></span>
		<a class='deletePage' style="float:right;display:none;" id="pageDel_1" ><img src='/public/css/image/red-del-icon.jpg' border='0' alt='Delete page' title='Delete page'></a>
		</div>
 -->

	<div class="page_block section ui-state-default sortable2" id="section_1" >		
		
		<div class="ui-state-default mainPageSection">
		<i class='col-sm-1 select_icon sec_handle unmoved' id='iconSec_1'></i>
		<div class="col-sm-11 ui-state-disabled" id='sector_1'>
		<input id="secTitle_1" class='demoSec title_sec sec' name="section_1[]" placeholder="Section title" >

		<!-- <input id="secDesc_1" class='title_Desc sec openNav' name="secDesc_1[]" placeholder="Optional description" > -->
		<!-- <textarea id='txt_section_1' name='secDesc_1[]' style='display:none' class='sec'></textarea>	
		<div id='secDesc_1' class='title_Desc sec paradesc openNav' placeholder='Description (Optional)' >Description (Optional)</div> -->

			<!-- <p type='' id='secDesc_1' class='title_Desc sec openNav' placeholder='Optional description' ></p> -->


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

			<!-- <input type='hidden' id='qtype_1' value='regular' name='qtype_1[]' class='form-control Queset' > -->

			<!-- <input type='hidden' id='txtPoints_1' name='txtPoints_1[]' class='form-control Queset marks' >

			<input type='hidden' id='txtInstruction_1' name='txtInstruction_1[]' class='form-control Queset' >
			<input type='hidden' id='txtExplain_1' name='txtExplain_1[]' class='form-control Queset' >

			<input type='hidden' class='form-control ans_Opt Queset Queset_opt' name='txtRegOpt_1[]' id='txtRegOpt_1_1' ><input type='hidden' class='chkOpt Queset_opt' name='chkReg_1[]' value='0' id='chkReg_1_1'>

			<input type='hidden' class='form-control mul_Opt Queset Queset_opt' name='txtMultiOpt_1[]' id='txtMultiOpt_1_1'><input value='0' type='hidden' class='chkOpt Queset_opt' name='chkMulti_1[]' id='chkMulti_1_1'>

			<input type='hidden' class='form-control media_Opt Queset Queset_opt' name='txtMediaOpt_1[]' id='txtMediaOpt_1_1'><input value='0' type='hidden' class='chkOpt Queset_opt' name='chkMedia_1[]' id='chkMedia_1_1'>

			<input type="hidden" class='form-control media_img Queset ' name='MediaImg_1' id='MediaImg_1'>

			<input type='hidden' name="rbTrueFalse_1" id='txtTrueF_1' class='Queset '> 

			<input type='hidden' class='form-control match_Opt Queset Queset_opt' name='txtMatchque_1[]' id='txtMatchque_1_1' onblur='addAtributeRequired(1,1)' >
			<input type='hidden' class='form-control Queset Queset_opt' name='txtMatchpair_1[]' id='txtMatchpair_1_1'>
 -->
			</div>

		</div>
	</div>
</div>
	<!-- <br><center><button type='button' class='add_page' >NEW PAGE<span class="icon_add_new_pg">+<span class="square-button__arrow-container" data-radium="true" style="background-color: rgb(49, 71, 108); position: absolute; top: 0px; bottom: 0px; right: 3rem;"><span data-radium="true" style="border-color: transparent rgb(49, 71, 108) transparent transparent; position: absolute; right: 100%; top: 50%; margin-top: -0.4rem; width: 0px; height: 0px; border-width: 0.4rem 1rem 1rem 0px; border-style: solid;"></span></span></span></button></center><br> -->
</div>


</div>	
</div>
</div>		
</div>
</div>		


<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$quiz->id) ?>

<?php endif ?>

<?php echo form_close(); ?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 --> 
   <script src="<?php echo base_url() ?>public/js/form-master/jquery.form.js"></script> 

<script src="<?php echo base_url(); ?>public/js/exam/exam.js"></script>
<script src="<?php echo base_url(); ?>public/js/exam/studexam.js"></script>

<!-- tool tip script -->
<script type="text/javascript">

jQuery(document).ready(function(){
	$('#import_ques').on('click', function(){
		$(document).find('#Qform').hide();
		$(document).find('#Qexist').show();
		$(document).find('.autoQue').find("option[value='']").attr('selected', true);
		$('table#dataTable tr:not(:first-child)').remove();
		$(document).find('#chk_all').prop("checked", false);

	});

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
 	var extype = $('input[name="exam_type"]:checked').val();
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
	if(extype != 3){
		var totmk = $(".totmk").val().trim();
		if(totmk == '' || totmk == 0){
			$(".nav-tabs li.general").removeClass('active').siblings().addClass('active');
			$(".tab-content #home").removeClass('active').siblings().addClass('active');
			$("#err_atleast_ques").html('Please enter atleast one Question.');
			setTimeout(function(){$("#err_atleast_ques").html('');},2000);
			return false;
		}
	}
	
	$("#submit").click();
	var ex_desc = tinymce.get('description').getContent();
	$(document).find('#ex_desc').text(ex_desc);
	// console.log(ex_desc);
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
         var ex_desc = tinymce.get('description').getContent();
     		$(document).find('#ex_desc11').text(ex_desc);
     		// alert(ex_desc);
         set_prop();
     		// var ex_title = $('#ex_name').val();
     		

        },
        success: function(insert_id) {
     		// console.log(insert_id);
     		 // $('#loading').hide();
        //     $('#subtn').removeAttr("disabled");
            
              if(insert_id)
              {
                 
        var strcontent1 ='<center><h4 style="padding:2%;text-align:center;font-weight:bold;color:#016ac1">Quiz Successfully Created! </h4></center>';
  
          $j.alert({
                 title: "Success",
              content: strcontent1,
             confirm: function()
                         { 
                         	var updType = "<?php echo $updType ?>";
                         	if(updType == 'create')
                         	{
                         	var seg3 = "<?php echo $this->uri->segment(4); ?>";
	            			var seg4 = "<?php echo $this->uri->segment(5); ?>";
	            			var seg5 = "<?php echo $this->uri->segment(6); ?>";
		            			if(seg3 && seg4){
		            				"<?php $this->session->set_userdata('sel_quiz','123'); ?>";
		            				// '<%Session["sel_quiz"] = "' + insert_id + '"; %>';
	                          		window.location ="<?php echo base_url();?>admin/edit/exam/"+seg3+"/"+seg4+"/"+seg5;
		            			}else{
		            				window.location ="<?php echo base_url();?>admin/exams/examlist";
		            			}

                         	}
                         	else{
                          		window.location ="<?php echo base_url();?>admin/exams/examlist";
                      		}
                         }
                     });


              } 

             else
              {
                  $j.alert({
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

	$(document).on('click', ".Qslide_opt", function() 
	{
		var Qtot = $('.Qtot').text();
var $tmp = $(this).hasClass("Qnext");
var $tmp2 = $(this).hasClass("Qprev");
var attempt = $('.stu_att').text();
var stud_id = $('.stu_id').text(); 
var pro_id = $('.prog_id').text();
var Qtype = $('#Q_type').val();
// alert(Qtype);
	if(Qtype == 'matching'){
$('#given_ans').val('matching'); }
// if(Qtype == 'subjective'){
//     var subjective = tinymce.get('subtxt').getContent();
//     alert(subjective);
// 	if(subjective){
// 		    $('#subtxt2').text(subjective);
// 	}
// }
		var ele_info = $(this).attr('id');
		var ele_id = ele_info.split('_');
		var postdata = $('#examsubmit11').serializeArray();
// postdata.push({examid:ele_id[0],srno:ele_id[1]});
postdata.push({name: 'examid', value: ele_id[0]});
postdata.push({name: 'srno', value: ele_id[1]});
postdata.push({name: 'att_no', value: attempt});
postdata.push({name: 'stud_id', value: stud_id});
postdata.push({name: 'pro_id', value: pro_id});


// console.log(postdata['3']);
		$.ajax({
		    type:"post",

		    data: postdata,
		  // data:{examid:ele_id[0],srno:ele_id[1]},
		url:"<?php echo base_url();?>lessons/nextQue",
		    dataType: "json",
		    beforeSend:function()
		    {
		    	// $('button.Qslide').attr("disabled", "disabled");
		    	// $('#Qloader').css('display','block');
		    },
		success:function(data)
		    {
		    	
    // var res = $.parseJSON(data);
    // if(data[3]){ console.log(data);  }

		     if(data)
		      {
		      $("#showQue").html(data[0]);  
		  	}
 
		    var ele = parseInt(ele_id[1]) + 1;
		    var ele2 = parseInt(ele_id[1]) - 1;
// alert(ele_id[1]);
// alert(ele2);
		      // $(this).attr('id',ele_id[0]+'_'+ele);
		      $('.Qnext').prop("id",ele_id[0]+'_'+ele+'_'+data[1]);
		      $('.Qprev').prop("id",ele_id[0]+'_'+ele2+'_'+data[1]);

		      //pass data on success

		       $('.Qnext').show();
				$('.Qprev').show();
				$('button.Qslide').removeAttr("disabled", "disabled");
				// $('#Qloader').css('display','none');

		    },
		    error: function()
    		{   			
    			
		  		if(ele_id[1]== Qtot)
		  		{
		  		if (confirm('Are you sure, Do you want to final sumbit the quiz?')) {
				      report(ele_id[0],attempt,stud_id,pro_id);
				    }
				}
		  		$('button.Qslide').removeAttr("disabled", "disabled");
		    	$('#Qloader').css('display','none');

    		}

		  }); 


	});

	$(document).on('click', ".finalsub", function() 
	{
		
		if (confirm('Are you sure, Do you want to submit the quiz?')) {
	        return true;
	    }
	});


	$(document).on('click', ".pgjump", function() 
	{
		var ele_info = $(this).attr('id');
		var ele_id = ele_info.split('_');
		
		var attempt = $('.stu_att').text();
		var stud_id = $('.stu_id').text();
		var exam_id = $('.exam_id').text();
		var pro_id = $('.prog_id').text();

		$.ajax({
		    type:"post",
		 // data:{examid:ele_id[0],srno:ele_id[1]},
		url:"<?php echo base_url();?>lessons/jumpsec/"+ele_id[0]+"/"+ele_id[1]+"/"+stud_id+"/"+pro_id+"/"+attempt,
    dataType: "json",
		success:function(data)
		    {
		      // console.log(data);
		      $('#ExamSection').find('#Quesmarkopt').html(data[0]);

		    }
		  }); 
	});

$(document).ready(function()
{
	$('.bottom').hide();
	$(".page-container").addClass("sidebar-collapsed");
})
</script>
<script> 
	//select existing ques script
	$(document).ready( function() {
		$(document).find('#Qform').hide();
$('#customer-chat-widget').hide();
	});

	$('#setmanual').on('click', function(){
		var tempval = $('.tampval').val();
var tempvalarray = tempval.split('_');
		var Qid = $('#Que_'+tempvalarray[1]).find('div').find('#qid_'+tempvalarray[1]).val();
		// if(!Qid){
		// 	$('#saveQ').show();$('#updateQ').hide();
		// }else{
		// 	$('#saveQ').hide();$('#updateQ').show();
		// }
		$(document).find('#Qform').show();
		$(document).find('#customer-chat-widget').hide();
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

	var cat = $('#Quecat_que').val();
	var subcat = $('#Quesubcat_que').val();
	var Qno = $('#NumQues_que').val();
	var Questype = $('#Questype_que').val();
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
        		$(document).find('#NumQues_que').attr('placeholder','Limit upto '+data.length+' Questions');
        		
        		$(document).find('#availQues_que').val(data.length);
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

$('#getpreview').on('click', function(){
		// alert('me');

	$(document).find('#sidebar').hide();
	 $(document).find('#preview_modal').find('.modal-body').html('');
	var title = $('form#examsubmitid').find('#ex_name').val();
	// var duration = $('form#examsubmitid').find('#limit_time_l').val();
		var duration = $('form#examsubmitid').find('#duration_m').val();

	if($('#exam_category').val() == '2'){
		set_prop();
		var Qlength = 1;
		var totQ = $('.Ques').length;
		for (var i = 1; i <= totQ; i++) {
			var Quetitle = $('#showQue_'+i).text();
			if(Quetitle.trim() ==="Add a new question here" ) { 
				Qlength = Qlength;
			}else{ Qlength = Qlength + 1; }
		}
	}
	else if($('#exam_category').val() == '1'){
		var Qlength = 1;
		$('.page_block').find(".NumQues").each(function(){
			var val = $(this).val();
			// console.log(Qlength);
			//  console.log(val);
			
			if(!val) val=0;
			 Qlength = parseInt(Qlength) + parseInt(val);
			 // console.log('auto');
			 
		});

	}
	// var attempt = $('form#examsubmitid').find('#nb_quiz_taken').val();
	var attempt = '1';
	// var avgscrore = $('form#examsubmitid').find('#max_score_pass').val();
		var avgscrore = $('form#examsubmitid').find('#pass_score').val();

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
	// $(document).on('click', '.exam_preview_close_btn', function(){
		 var fname = $(document).find('#filenm').text();
		// var fso = new ActiveXObject('Scripting.FileSystemObject');
  //   fso.DeleteFile('<?php echo base_url() ?>/public/JSON/'+fname, true);
// alert(fname);
  //   fso = null;
    $.ajax({
	      url: base_url+'admin/exams/deletejsonfile',
          data: {'file' : "<?php echo FCPATH ?>public/JSON/"+fname},
          success: function (response) {
          	// console.log(response);
             return true;
          },
          error: function (data) {
            // console.log(data);

          }
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
	// return $.fn.tooltip to previously assigned value
var bootstrapTooltip = $.fn.tooltip.noConflict();

// give $().bootstrapTooltip the Bootstrap functionality
$.fn.bootstrapTooltip = bootstrapTooltip

// now activate tooltip plugin from jQuery ui
$(document).tooltip();
</script>
