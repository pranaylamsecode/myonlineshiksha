<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $heading;?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/default/css/lecture_dashboard.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/default/css/my_lecture_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/new_template/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
</head>
<body>
	<style type="text/css">
		#course-taking-page{
			height: auto !important;
		}
	</style>
<div id="course-taking-page" class="ud-dashboard wrapper lesson_page" style="position: fixed;">
	<div class="lecture_prev_top">
		<a id="go-back" href="<?php echo base_url(); ?><?php echo $urlCourse;?>/lectures/<?php echo $pro_id; ?>" class="pos-r zi1 ml15 mt15 dif text-topaz back_to_course_btn fs12 bold ml0-md"> <i class="icon-chevron-sign-left fs16 mr5"></i> <span class="back_to_course">Back to Course</span></a>
		<span class="course_title"><?php echo ucwords($program_name);?> :</span> <span class="lesson_title"><?php echo ucwords($assignment->assign_title); ?></span>   
	</div>
</div>

<div class="panel panel-primary" data-collapsed="0" style="margin-top: 55px">
   <div class="panel-heading">
      <div class="panel-title" style="padding-bottom: 0px;">
         <p style="margin-top: 0;margin-bottom: 0px; text-align:left;">Assignment : <span style="color:#fff;font-weight: 700"><?php echo ucwords($assignment->assign_title); ?></span>
         <a id="go-back" href="#" type="button" onclick="return goto_instr()" class="pos-r zi1 ml15 mt15 dif text-topaz back_to_course_btn fs12 bold ml0-md" style="float: right;border: 0px!important"> <i class="icon-chevron-sign-left fs16 mr5"></i><span class="back_to_course">Back to Instructions</span></a>
         </p>
      </div>
   </div>
   <div class="panel-body col-sm-12 col-xs-12 form-horizontal form-groups-bordered" id="assign_div" style="margin-left: 20px;width: 95%">
      <div class="form-group">
         <label>Description :</label>
         <span class="quiz_description" style="  margin-top: 20px;">
            <?php echo $assignment->assign_description;?>
         </span>
      </div>
      <div class="form-group">
         <label>Instructions:</label>
         <span class="quiz_description" style="  margin-top: 20px;"><?php echo $assignment->assign_instruction;?></span>
      </div>
      <div class="form-group">
      	<?php if(!empty($assignment->instruction_videos)){ ?>
         <div class="col-sm-4 col-xs-12">
         	<label>Instruction Video</label>
            <video style="width:100% !important;" controls="">
			  <source src="<?php echo base_url();?>public/uploads/assignments/instr_vdo/<?php echo $assignment->instruction_videos; ?>">
			  Your browser does not support the video tag.
			</video>
         </div>
     	<?php }if(!empty($assignment->resources_files)){ ?>
         <div class="col-sm-4 col-xs-12">
            <iframe src="<?php echo base_url();?>public/uploads/assignments/resource_file/<?php echo $assignment->resources_files; ?>" style="width: 100%;height: 250px;"></iframe>
            <a class="col-sm-12" style="float: left;font-size: 15px;" href="<?php echo base_url();?>public/uploads/assignments/resource_file/<?php echo $assignment->resources_files; ?>" target="_blank">Click here to download Resource File / Instructions File</a>
         </div>
     	<?php } ?>
      </div>
      <div class="form-group">
         <div class="col-sm-5 col-xs-12">
            <p>Total Questions: <span style="color:#42943F"><?php echo $total_ques; ?></span></p>
         </div>
      </div>
      
      <hr style="margin:0;">
      <div class="form-group">
         <div class="col-sm-5 col-xs-12">
         </div>
      </div>
      <div class="form-group">
         <div class="col-sm-2 col-xs-12">
            <button type="button" id="btn_start" class="btn btn-success form-control" onclick="start_assignment();">Start Assignment</button>
            <button id="ques_div" class="btn btn-success form-control " style="display: none;">
				<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please Wait...
			</button>
         </div>
      </div>
   	</div>
   <!-- Questions start from here -->
 	<div class="panel-body col-sm-12 col-xs-12 form-horizontal form-groups-bordered" id="question_div" style="display: none;margin-left: 20px;width: 95%">
 		<?php
 		$i = 1;
 		foreach ($getques as $key){
 			$con = "que_id = ".$key->q_id." and user_id = ".$user_id;
 			$getans = $this->Crud_model->get_single('mlms_assignment_log',$con);
 		?>
 			
      <div class="form-group">
        <div class="col-sm-6 col-xs-12">
	        <label>Q. <?php echo $i++; ?> :</label>
	         <span class="quiz_description" style="margin-top: 20px;">
	            <?php echo $key->que_text;?>
	         </span>
	      	<?php if(!empty($key->que_attachment)){ ?>
	         <div class="col-sm-12 col-xs-12">
	         	<label>Question Attachments</label>
	            <a class="col-sm-12 col-xs-12" style="font-size: 15px;" href="<?php echo base_url();?>public/uploads/assignments/question/<?php echo $key->que_attachment; ?>" target="_blank">Click here to download Attachment</a>
	         </div>
	     	<?php } ?>
	      </div>
         <div class="col-sm-6">
         	<form id="ques_form" method="post" action="" enctype="multipart/form-data">
	            <div class="form-group">
			         <div class="col-sm-12 col-xs-12">
			            <p>Answer: <span style="color: red;" id="err_<?php echo $key->q_id;?>"></span></p>
			            <textarea class="description" id="ans_txt_<?php echo $key->q_id;?>"><?php if(!empty($getans)){if($getans->answer){echo $getans->answer;} } ?></textarea>
			        </div>
			        <div class="col-sm-12 col-xs-12">
			            <h5><b>Attach Files <span style="color: red;" id="uploaderr_<?php echo $key->q_id;?>"></span></b>
			            	<?php if(!empty($getans)){if($getans->ans_attach){?><a href="<?php echo base_url('public/uploads/assignments/stud_answer/'.$getans->ans_attach);?>" style="padding-left: 50px;" target="_blank"><i class="fa fa-eye"></i> View Files</a> <?php } } ?>
			            </h5>
			            <input type="file" class="image" id="attachment_<?php echo $key->q_id;?>" accept=".doc, .docx, application/msword, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, audio/*, video/*, image/*">
			        </div>
			    </div>
	            <div class="form-group">
			         <div class="col-sm-4 col-xs-12">
			            <button type="button" id="btn_answer_<?php echo $key->q_id;?>" class="btn btn-success form-control" onclick="return update_answer(<?php echo $key->q_id;?>,<?php echo $user_id;?>,<?php echo $assign_id;?>);">Add Answer</button>
			            <button id="ans_div_<?php echo $key->q_id;?>" class="btn btn-success form-control " style="display: none;">
							<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please Wait...
						</button>
			         </div>
			         <!-- Teacher remark Div -->
			         <?php if(!empty($getans->remark)){ ?>
			         <div class="col-sm-4 col-xs-12">
						<span style="display: none" id="remark_<?php echo $getans->id;?>"><?php echo $getans->remark;?></span>
						<span style="display: none" id="remark_attach_<?php echo $getans->id;?>"><?php if(!empty($getans->remark_attach)){ echo base_url().'public/uploads/assignments/remarks/'.$getans->remark_attach;} ?></span>
						<a type="button" class="btn btn-info form-control" onclick="return show_remark(<?php echo $getans->id;?>)">Show Teacher Remarks</a>
					</div>
						<?php } ?>

			         <div class="col-sm-6 col-xs-12">
			            <span id="message_<?php echo $key->q_id;?>"></span>
			         </div>
			    </div>
			</form>
         </div>
      </div>
      <hr style="margin:0 0 15px 0;border: 1px solid;">
 	<?php } ?>
		<div class="form-group">
	        <div class="col-sm-2 col-sm-offset-10 col-xs-12">
	        	<form method="post" action="<?php echo base_url('programs/notify_assignment/'.$user_id.'/'.$assign_id);?>">
	            	<button type="submit" class="btn btn-primary form-control">Save & Exit</button>    
	            </form>
	        </div>
	    </div>
   </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Teacher Remarks </h4>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div id="remark_text"></div>
	        <div id="remark_attachment"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="base_url" value="https://mos.veerit.com/">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.0.min.js'); ?>"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src='<?php echo base_url() ?>public/js/tinymce/tinymce.min.js'></script>
<script type="text/javascript">
	/*remark_
remark_attach_*/
	function show_remark(id){
		$("#myModal").modal('show');
		$("#remark_text").html($("#remark_"+id).html());
		var remark_attach = $("#remark_attach_"+id).html();
		if(remark_attach == ''){
			$("#remark_text").addClass('col-sm-12').removeClass('col-sm-6');
			$("#remark_attachment").html('').removeClass('col-sm-6');
		}else{
			$("#remark_text").addClass('col-sm-6').removeClass('col-sm-12');
			$("#remark_attachment").html('<iframe src="'+remark_attach+'" style="width:100%"></iframe>'+
				'<a href="'+remark_attach+'">view File</a>').addClass('col-sm-6');
		}
		/*remark_text
remark_attachment*/

	}

	function start_assignment()
	{
		$("#btn_start").css('display','none');
		$("#ques_div").css('display','block');
		setTimeout(function(){
			$("#btn_start").css('display','block');
			$("#ques_div").css('display','none');
			$("#assign_div").css('display','none');
			$("#question_div").css('display','block');
		},1000);
	}
	function goto_instr()
	{
		$("#assign_div").css('display','block');
		$("#question_div").css('display','none');
	}

	function update_answer(q_id,user_id,assign_id)
	{
		var ans_txt = tinyMCE.get('ans_txt_'+q_id).getContent();
		var q_id = q_id;
		var user_id = user_id;
		var assign_id = assign_id;
		if(ans_txt == ''){
			$("#err_"+q_id).html('Please write your answer.');
	    	tinyMCE.get('ans_txt_'+q_id).focus();
			setTimeout(function(){$("#err_"+q_id).html('');},2000);
			return false;
		}else{
			
			$("#btn_answer_"+q_id).css('display','none');
			$("#ans_div_"+q_id).css('display','block');
			var attachment = $("#attachment_"+q_id)[0].files[0];
			var new_formdata= new FormData();
			new_formdata.append('ans_txt',ans_txt);
			new_formdata.append('attachment',attachment);
			new_formdata.append('q_id',q_id);
			new_formdata.append('user_id',user_id);
			new_formdata.append('assign_id',assign_id);
			$.ajax({
				type : "post",
				cache : false,
				processData: false,
    			contentType: false,
				url : "<?php echo base_url();?>programs/update_answer/",
				data : new_formdata,
				success : function(response)
				{
					$("#btn_answer_"+q_id).css('display','block');
					$("#ans_div_"+q_id).css('display','none');
					if(response == 0){
						$("#uploaderr_"+q_id).html(' The filetype you are attempting to upload is not allowed.');
						$("#attachment_"+q_id).val('');
						setTimeout(function(){$("#uploaderr_"+q_id).html('');},2500);
					}else{
						$("#message_"+q_id).html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"> </i> </a> <strong class="fa fa-check" aria-hidden="true"> '+response+' </strong></div>').fadeIn().delay(2000).fadeOut();

					}
				}
			});
		}
	}

    jQuery(document).ready(function(){
      tinymce.init({
  		selector: '.description',
 		height: 150,
 		// min_width: 400,
 		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen" ],
		toolbar: "eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
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
    });
</script>
</body>
</html>