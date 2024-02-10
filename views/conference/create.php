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
				<form method="post" action="<?php echo $action_url;?>" enctype="multipart/form-data" id="info_form">
					<div class="form-group form-border">
						<label for="meeting_topic" class="col-sm-12 control-label field-title"><?php echo $txt_topic; ?><span class="error">* </span><span id="err_topic"></span></label>
						<div class="col-sm-12">
              <input id="meeting_topic" type="text" name="meeting_topic" class="form-control form-height" value="<?php echo $meeting_topic; ?>" />
						</div>
					</div>
            <div class="form-group form-border">
						<label for="meet_date" class="col-sm-12 field-title control-label"><?php echo $txt_schdl; ?><span class="error">* </span><span id="err_mdate"></span></label>
						<div class="col-sm-12">
              <input id="meet_date" type="hidden" name="meet_date" value="<?php echo $meet_date; ?>" />
              <div class='input-group date' id='datetimepicker1'>
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type='text' id="meet_time" class="form-control" value="<?php echo $meet_date; ?>" />
              </div>
						</div>
					</div>
	       <div class="form-group form-border">
						<label for="duration" class="col-sm-12 field-title control-label"><?php echo $txt_duration; ?><span id="err_duration"></span></label>
						<div class="col-sm-12">
              <input class="form-control form-height" type="text" value="<?php echo $duration; ?>" id="duration" name="duration" onkeypress="return only_number(event)" maxlength="3" />
						</div>
					</div>
					
					<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
          <input type="hidden" value="<?php echo $meeting_id;?>" name="meeting_id" id="meeting_id">
          <input type="hidden" value="<?php echo $merchant_id;?>" id="merchant_id">
          <input type="hidden" value="<?php echo $batch_id;?>" name="batch_id">
          <div class="form-group form-border" style="padding-top:2.5%!important">
            <span id="err_merchant"></span>
						<div class="col-sm-3 col-md-3">
              <button type="submit" id="btncheck" class="btn btn-success btn-lg" style="width: 75% !important;" onclick="return validation()"><?php echo $button; ?></button>
						</div>
					</div>
				</form>
<?php /* ?>
        <!-- meeting -->
        <div class="form-group form-border">
            <label for="duration" class="col-sm-12 field-title control-label">Invitation Link </label>
            <div class="col-sm-12">
              <input class="form-control form-height" type="text" value="<?php echo base_url().'live-meeting/0/'.urlencode($join_url); ?>" id="join_url" name="join_url" readonly='' />
            </div>
          </div>
          <div class="form-group form-border">
            <label for="duration" class="col-sm-12 field-title control-label">Conference Password </label>
            <div class="col-sm-12">
              <input class="form-control form-height" type="text" value="<?php echo $password; ?>" id="password" name="password" readonly='' />
            </div>
          </div>
          <div class="form-group form-border">
            <label for="duration" class="col-sm-12 field-title control-label">Attendees <span class="error">* </span><span id="err_attendees"></span></label>
            <div class="col-sm-6">
              <select class="form-control form-height" id="attendees" name="attendees[]" multiple style="height: 150px !important;">
                <option value="">-- Select user --</option>
                <?php 
                $users = $this->Crud_model->GetData('mlms_users',"first_name,last_name,email","active = 1 and trash = 0");
                foreach ($users as $key1) { 
                  if(!empty($key1->email) && trim($key1->email) != ''){
                ?>
                <option value="<?php echo $key1->email;?>" dataname="<?php echo ucfirst($key1->first_name).' '.ucfirst($key1->last_name);?>"><?php echo ucfirst($key1->first_name).' '.ucfirst($key1->last_name); ?></option>
                <?php } } ?>
              </select>
            </div>
          </div>
          
          <div class="form-group form-border" style="padding-top:2.5%!important">
            <div class="col-sm-4 col-md-4">
              <button type="submit" id="btnsend" class="btn btn-success btn-lg" style="width:45% !important;font-size: 16px;" onclick="return send_invites()">Send</button>
            </div>
<!--             <div class="col-sm-3 col-md-3">
            </div> -->
          </div>
        <!-- meeting -->
<?php */ ?>

			</div>
		  </div>
		</div>
	  </div>
    <?php if(!empty($batch)){
    ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-primary primary-border" data-collapsed="0">
          <div class="panel-heading">
            <h4>Batch Details</h4>
          </div>
          <div class="panel-body form-body">
            <table class="table table-bordered responsive" style="width: 95%;margin: auto">
              <thead>
                <tr>
                  <th>Batch Title</th>
                  <th>Batch Time</th>
                  <th>No. of Students</th>
                  <th>Assigned Teacher</th>
                </tr>
              </thead>
              <tbody id="" style="text-align: center;">
                <tr class="odd">
                  <td><?php echo ucwords($batch->batch_name); ?></td>
                  <td><?php echo date('h:i A',strtotime($batch->batch_start_time)).' - '.date('h:i A',strtotime($batch->batch_end_time)); ?></td>
                  <td><?php echo $batch->enroll_limit; ?></td>
                  <td><?php if(!empty($teacher)){echo ucwords($teacher->first_name.' '.$teacher->last_name);}else{echo "-";}?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
    <input type="hidden" id="min_date" value="<?php if(!empty($batch)){echo date('m/d/Y h:i A',strtotime($min_date)); }else{echo date('m/d/Y');} ?>">
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<script type="text/javascript">
  function validation(){
    $("#meet_date").val($("#meet_time").val());
    var meeting_topic = $('#meeting_topic').val();
    var meet_time = $('#meet_time').val();
    var duration = $('#duration').val();
    var merchant_id = $('#merchant_id').val();
    if(meeting_topic == '')
    {
        $("#err_topic").fadeIn().html("Please enter Title / Topic.").css('color','red');
        setTimeout(function(){$("#err_topic").html("");},3000);
        $("#meeting_topic").focus();
        return false;
    }
    if(meet_time == '')
    {
        $("#err_mdate").fadeIn().html("Please enter date & time").css('color','red');
        setTimeout(function(){$("#err_mdate").html("");},3000);
        $("#meet_time").focus();
        return false;
    }
    if(duration == '')
    {
        $("#err_duration").fadeIn().html("Please enter duration.").css('color','red');
        setTimeout(function(){$("#err_duration").html("");},3000);
        $("#duration").focus();
        return false;
    }
    /*if(merchant_id === 'nikhil.b@veerit.com')
    {
        $("#err_merchant").fadeIn().html('Please check your Zoom Account ID and refresh to create meeting! <a href="<?php echo base_url();?>conference-settings" target="_blank" style="cursor :pointer">click here </a> to check').css('color','red');
        setTimeout(function(){$("#err_merchant").html("");},10000);
        $("#meeting_topic").focus();
        return false;
    }*/
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
  $(document).ready(function(){
    var min_date = $("#min_date").val();
    var btncheck = $("#btncheck").html();
    $("#datetimepicker1").datetimepicker({
      minDate: moment(min_date),
    });
  });


  function send_invites()
  {
    $("#btnsend").html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Please wait');
    return  false;
    var attendees = $("#attendees").val();
    var attendees_name = $('#attendees option:selected').toArray().map(item => item.text).join();
    var meeting_topic = $("#meeting_topic").val().trim();
    var start_time = $("#meet_time").val().trim();
    var duration = $("#duration").val().trim();
    var join_url = $("#join_url").val().trim();
    var id = $("#meeting_id").val().trim();
    var password = $("#password").val().trim();
    if(attendees == '' || attendees == null)
    {
        $("#err_attendees").fadeIn().html("Please select at least one attendee!").css('color','red');
        setTimeout(function(){$("#err_attendees").html("");},3000);
        return false;
    }  
    $.ajax({
        type : 'post',
        cache : false,
        url : "<?php echo base_url();?>send-invitation/",
        data :{ attendees : attendees,
                attendees_name : attendees_name,
                meeting_topic : meeting_topic,
                start_time : start_time,
                duration : duration,
                join_url : join_url,
                id : id,
                password : password
        },
        success : function(response){
          // alert(response);
            $("#btnsend").css('display',"block");
            $("#buy_loader").css('display',"none");
            $("#message").css('display',"block");
            setTimeout(function(){
              $("#message").html('');
            },1500);
            setTimeout(function(){
              window.location.href = "<?php echo base_url();?>conference/list";
            },2000);
        }
    });
  }
</script>