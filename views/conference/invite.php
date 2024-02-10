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
#message {
    position: fixed; 
    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
    display: none;
}
</style>
<span id="message">
    <div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-check" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Invitation mail sent. </span></div>
</span>
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
				<!-- <form method="post" action="<?php echo $action_url;?>" enctype="multipart/form-data" id="info_form"> -->
					<div class="form-group form-border">
						<label for="meeting_topic" class="col-sm-12 control-label field-title">Meeting Topic </label>
						<div class="col-sm-12">
              <input id="meeting_topic" type="text" name="meeting_topic" class="form-control form-height" value="<?php echo $meeting_topic; ?>" readonly="" />
						</div>
					</div>
            <div class="form-group form-border">
						<label for="start_time" class="col-sm-12 field-title control-label">Meeting Schedule on </label>
						<div class="col-sm-12">
              <input id="start_time" type="text" name="start_time" class="form-control form-height" value="<?php echo date('d-m-Y h:i A',strtotime($start_time)); ?>" readonly="" />
						</div>
					</div>
          <div class="form-group form-border">
						<label for="duration" class="col-sm-12 field-title control-label">Meeting Duration (in Minutes) </label>
						<div class="col-sm-12">
              <input class="form-control form-height" type="text" value="<?php echo $duration; ?> Minutes" id="duration" name="duration" readonly='' />
						</div>
					</div>
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
                <?php foreach ($users as $key) { 
                  if(!empty($key->email) && trim($key->email) != ''){
                ?>
                <option value="<?php echo $key->email;?>" dataname="<?php echo ucfirst($key->first_name).' '.ucfirst($key->last_name);?>"><?php echo ucfirst($key->first_name).' '.ucfirst($key->last_name); ?></option>
                <?php } } ?>
              </select>
            </div>
          </div>
          
					<input type="hidden" value="<?php echo $id;?>" name="id" id="id">
          <div class="form-group form-border" style="padding-top:2.5%!important">
						<div class="col-sm-4 col-md-4">
              <button type="submit" id="btncheck" class="btn btn-success btn-lg" style="width:45% !important;font-size: 16px;" onclick="return send_invites()">Send</button>
              <div class=" btn btn-md btn-success btn-block buy_course_btn" id="buy_loader" style="display: none; width: 45%;font-size: 16px;">
                  <img src="https://mos.veerit.com/public/images/loader_white.gif" width="40px" height="32px" style="padding-right: 5px;"> Wait
              </div>
              <a type="button" class="btn btn-primary btn-lg pull-right" style="width:45% !important;font-size: 16px;" href="<?php echo base_url();?>conference/list">Cancel</a>
						</div>
<!--             <div class="col-sm-3 col-md-3">
            </div> -->
					</div>
				<!-- </form> -->
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
<script type="text/javascript">
  function send_invites()
  {
    var attendees = $("#attendees").val();
    var attendees_name = $('#attendees option:selected').toArray().map(item => item.text).join();
    var meeting_topic = $("#meeting_topic").val().trim();
    var start_time = $("#start_time").val().trim();
    var duration = $("#duration").val().trim();
    var join_url = $("#join_url").val().trim();
    var id = $("#id").val().trim();
    var password = $("#password").val().trim();
    if(attendees == '' || attendees == null)
    {
        $("#err_attendees").fadeIn().html("Please select at least one attendee!").css('color','red');
        setTimeout(function(){$("#err_attendees").html("");},3000);
        return false;
    }  
    $("#btncheck").css('display',"none");
    $("#buy_loader").css('display',"block");
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
            $("#btncheck").css('display',"block");
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