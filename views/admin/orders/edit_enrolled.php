<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
<style type="text/css">
#message {
  position: fixed; 
  right: 0;
  float: right;
  clear: both;
  margin-right: 10px;
  font-size: 18px;
  top: 0;
  z-index: 9999;
}
</style>
<span id="message"></span>
<div class="main-container">
	<div id="toolbar-box">
	  <div class="m">
	    <div class="pagetitle icon-48-generic">
	    	<h2>Update Enrolled User</h2>
	    	<h6>This will allow you to manage the Enrollment.</h6>
	    </div>
	  </div>
	</div>

	<div class="field_container">
		<div class="row">
		 
	
		        <div class="form-group form-border" style="margin-bottom: 15px !important;">
		          <label class="col-sm-12 control-label field-title">Student Name</label>
		          <div class="col-sm-12">
		            <input id="stud_name" class="form-control form-height" type="text" value="<?php echo $name;?>" readonly="">
		          </div>
		        </div>
		        <div class="clear"></div>
		        <div class="form-group form-border" style="padding-top: 0!important;margin-bottom: 15px !important;">
		          <label for="Price" class="col-sm-12 control-label field-title">Course Name</label>
		          <div class="col-sm-12">
		            <input id="course_name" class="form-control form-height" type="text" value="<?php echo $course_name;?>" readonly="">
		          </div>
		        </div>
		        <div class="clear"></div>
		        <div class="form-group form-border" style="padding-top: 0!important;margin-bottom: 15px !important;">
		          <label class="col-sm-12 control-label field-title">Batch Name</label>
		          <div class="col-sm-12">
		            <select name="batch_id" id="batch_id" class="form-control form-height">
		              <?php foreach ($batches as $key) { ?>
		              <option value="<?php echo $key->id;?>" <?php if($key->id == $batch_id){echo 'selected="" disabled=""';} ?>><?php echo ucwords($key->batch_name).' &nbsp; (starts from : '.date('Y-m-d',strtotime($key->batch_from))." , ".date('h:i A',strtotime($key->batch_start_time))." To ".date('h:i A',strtotime($key->batch_end_time)).")";?></option>
		              <?php } ?>
		            </select>
		          </div>
		        </div><div class="clear"></div>
		        <div class="form-group form-border" style="padding-top: 0!important;margin-bottom: 15px !important;">
		          <label class="col-sm-12 control-label field-title">Enrollment Type</label>
		          <div class="col-sm-12">
		            <select name="criteria" id="criteria" class="form-control form-height" disabled="">
		              <option value="paid" <?php if($criteria == 'paid'){echo 'selected';} ?>>Paid</option>
		              <option value="trial" <?php if($criteria == 'trial'){echo 'selected';} ?>>Trial</option>
		            </select>
		          </div>
		        </div>
		        <div class="clear"></div>
		        <div class="form-group form-border">
		          <div class="col-sm-5">
		          	<input type="hidden" id="id" value="<?php echo $id;?>">
		            <button type="button" id="btn_update" class="btn" onclick="return update_enroll()">Update</button>     
		            <a href="<?php echo base_url();?>enrolled-users/" class="btn"><span class="icon-32-cancel"> </span>Cancel</a>
		          </div>
		        </div>
		    
		</div>
	</div>
</div>
<script type="text/javascript">
	function update_enroll(){
		var batch_id = $("#batch_id").val().trim();
		var id = $("#id").val().trim();
		$.ajax({
			type : "post",
			cache : false,
			url : "<?php echo base_url();?>admin/orders/update_enroll/",
			data : {batch_id : batch_id, id : id},
			success: function(response){
				var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>New Batch assigned to Student.</div>';
        var note = $(document).find('#message');
        note.html(str);
        note.show();
        note.fadeIn().delay(3000).fadeOut();
			}
		});
	}
</script>