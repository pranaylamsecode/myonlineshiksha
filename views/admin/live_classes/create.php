<style>
.pagetitle {
    padding: 15px 0px 0px 0px;
    margin-bottom: 25px;
}
@media (max-width: 991px){
  footer.main {
      padding: 20px 15px 20px 10px !important;
      width: 100%;
      left: 0px;
  }
  .pagetitle {
      padding: 15px 0px 5px 0px;
      margin-bottom: 0px;
  }
  .pagetitle h2 {
      margin: 0px 0px 15px 0px !important;
      font-size: 26px;
  }
  .panel-body.form-body {
      border: 1px solid #ebebeb!important;
      border-radius: 2px!important;
      padding: 25px 15px 40px 15px!important;
      margin: 0px 0px 25px 0px;
  }
  .panel-body.form-body .col-sm-12 {
      padding: 0px !important;
  }
}
.ui-timepicker-container{
  z-index: 2 !important;
}
</style>
<div class="main-container">
<div class="col-sm-12 pagetitle" >
	<h2><?php echo $heading; ?></h2>
</div>
<div class="field_container">
<div class="row">
	<div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-primary primary-border" data-collapsed="0">
			<!-- <div class="panel-heading">
			</div> -->
			<div class="panel-body form-body">
				<form method="post" action="<?php echo $action_url;?>" enctype="multipart/form-data">
					<div class="form-group form-border">
						<label for="batch_name" class="col-sm-12 control-label field-title">Batch Name <span class="error">* </span><span id="err_name"></span></label>
						<div class="col-sm-12">
              <input id="batch_name" type="text" name="batch_name" class="form-control form-height" value="<?php echo $batch_name; ?>">
						</div>
					</div>
          <div class="form-group form-border">
            <label for="batch_from" class="col-sm-12 control-label field-title">Batch starts from <span class="error">* </span><span id="err_start_from"></span></label>
            <div class="col-sm-12">
              <input id="batch_from" type="hidden" name="batch_from" class="form-control form-height" value="<?php if($batch_from != '0000-00-00'){ echo $batch_from;} ?>">
              <div class='input-group date' id='batch_from1'>
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type='text' id="batch_from2" class="form-control" value="<?php if($batch_from != '0000-00-00'){ echo $batch_from;} ?>"/>
              </div>
            </div>
          </div>
          <div class="form-group form-border">
						<label for="batch_start_time" class="col-sm-12 field-title control-label">Batch Time<span class="error">* </span><span id="err_time"></span></label>
						<div class="col-sm-6">
              <input id="batch_start_time" type="hidden" name="batch_start_time" value="<?php echo $batch_start_time; ?>" />
              <div class='input-group date' id='batch_start_time1'>
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type='text' id="meet_time" class="form-control" value="<?php echo $batch_start_time; ?>" />
              </div>
						</div>
            <div class="col-sm-6">
              <input id="batch_end_time" type="hidden" name="batch_end_time" value="<?php echo $batch_end_time; ?>" />
              <div class='input-group date' id='batch_start_time2'>
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type='text' id="meet_time1" class="form-control" value="<?php echo $batch_end_time; ?>" />
              </div>
            </div>
					</div>
          <div class="form-group form-border">
						<label for="enroll_limit" class="col-sm-12 field-title control-label">Enroll Limit (maximum no. of students to be enroll) <span class="error">* </span><span id="err_limit"></span></label>
						<div class="col-sm-12">
              <input class="form-control form-height" type="text" value="<?php echo $enroll_limit; ?>" id="enroll_limit" name="enroll_limit" onkeypress="return only_number(event)" maxlength="3">
						</div>
					</div>
          <div class="form-group form-border">
            <label class="col-sm-12 field-title control-label">Assign Teacher (if any)</label>
            <div class="col-sm-12">
              <select class="form-control form-height" id="teacher_id" name="teacher_id">
                <option value="">--select teacher--</option>
                <?php $teacher = $this->Crud_model->GetData('mlms_users','id,first_name,last_name','group_id = 2');
                foreach ($teacher as $key) { ?>
                <option value="<?php echo $key->id;?>" <?php if ($teacher_id == $key->id){echo 'selected';} ?> ><?php echo ucwords($key->first_name.' '.$key->last_name); ?></option>
                <?php } ?>

              </select>
            </div>
          </div>
					
					<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
          <input type="hidden" value="<?php echo $course_id;?>" name="course_id" id="course_id">
          <div class="form-group form-border" style="padding-top:2.5%!important">
						<div class="col-sm-3 col-md-3">
              <button type="submit" id="btncheck" class="btn btn-success btn-lg" style="width: 75% !important;" onclick="return validation()"><?php echo $button; ?>
              </button>
						</div>
					</div>

				</form>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script>
$(document).ready(function(){
    $("#batch_start_time1").datetimepicker({format: 'LT'});
    $("#batch_start_time2").datetimepicker({format: 'LT'});
    $("#batch_from1").datetimepicker({format: 'YYYY/MM/DD'});
  });
</script>
<script type="text/javascript">
  function validation(){
    $("#batch_start_time").val($("#meet_time").val());
    $("#batch_end_time").val($("#meet_time1").val());
    $("#batch_from").val($("#batch_from2").val());
    var batch_name = $('#batch_name').val().trim();
    var batch_from = $('#batch_from').val().trim();
    var batch_start_time = $('#batch_start_time').val().trim();
    var batch_end_time = $('#batch_end_time').val().trim();
    var enroll_limit = $('#enroll_limit').val().trim();
    var teacher_id = $('#teacher_id').val().trim();
    
    if(batch_name == '')
    {
        $("#err_name").fadeIn().html("Please enter Batch name. (ex. Batch 1)").css('color','red');
        setTimeout(function(){$("#err_name").html("");},3000);
        $("#batch_name").focus();
        return false;
    }
    if(batch_from == '')
    {
        $("#err_start_from").fadeIn().html("Please enter Batch start date (ex. 12/23/2020 ).").css('color','red');
        setTimeout(function(){$("#err_start_from").html("");},3000);
        $("#batch_from").focus();
        return false;
    }
    if(batch_start_time == '')
    {
        $("#err_time").fadeIn().html("Please enter Start time of batch.").css('color','red');
        setTimeout(function(){$("#err_time").html("");},3000);
        $("#batch_start_time").focus();
        return false;
    }
    if(batch_end_time == '')
    {
        $("#err_time").fadeIn().html("Please enter End time of batch.").css('color','red');
        setTimeout(function(){$("#err_time").html("");},3000);
        $("#batch_end_time").focus();
        return false;
    }
    if(enroll_limit == '')
    {
        $("#err_limit").fadeIn().html("Please enter maximum no. of students.").css('color','red');
        setTimeout(function(){$("#err_limit").html("");},3000);
        $("#enroll_limit").focus();
        return false;
    }
  }
  function only_number(event) {
     var x = event.which || event.keyCode;
     console.log(x);
     if ((x >= 48) && (x <= 57) || x == 8 | x == 9 || x == 13) {
        return;
     } else {
        event.preventDefault();
     }
  }
</script>