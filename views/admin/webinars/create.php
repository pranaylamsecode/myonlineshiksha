<?php


 if($this->input->get('msg') == 1012)
 {
	echo 'Given time slot is already scheduled. Schedule webinar at another time slot.'; 
 }
 if($this->input->get('msg') == 1022)
 {
  echo 'Given Datetime is invalid.'; 
 }
 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#todate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#untilldate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
  </script>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>



<!--<script type="text/javascript">



 function validate() {



        if (document.getElementById('allday').checked) {



            document.getElementById("todatearea").style.display="none";



        } else {



            document.getElementById("todatearea").style.display="";



        }



    }

</script>-->






<?php



//print_r($category);



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'create') ? form_open(base_url().'admin/webinars/create', $attributes) : form_open(base_url().'admin/webinars/edit/', $attributes);



?>






			






<div class="pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? "Create Webinar" : "Edit Webinar"?></h2></div>








<div class="col-md-12"> 
	<div class="panel panel-primary" data-collapsed="0"> 
		<div class="panel-heading"> 
			<div class="panel-title"><?php echo ($updType == 'create') ? "Create webinar for ".$programs->name : "Edit webinar"?></div> 
			<div class="panel-options"> 
            	<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> 
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> 
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> 
			</div> 
		</div> 
        <div class="panel-body"> 
        	<fieldset class="adminform form-horizontal form-groups-bordered"> 
            	
                <div class="form-group"> 
                    <label class="col-sm-3 control-label" for="title"><?php echo 'Subject'?> <span class="required">*</span></label> 
                    <div class="col-sm-5"> 
                        <input id="title" type="text" name="title" maxlength="256" class="form-control" value="<?php echo set_value('title', (isset($webinar->title)) ? $webinar->title : ''); ?>"  />



  <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="subject-target" class="tooltipicon"></span>

						<span class="subject-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_subject');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
					</div> 
                    <span class="error"><?php echo form_error('title'); ?></span>
				</div> 
                
                <div class="form-group"> 
                    <label class="col-sm-3 control-label" for="type"><?php echo 'Type'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    
                        <select id="type" name="type" class="form-control">



	<option value="webinar" <?php if(isset($webinar->type) && $webinar->type == "webinar") echo "selected"; ?>>Webinar</option>



	<option value="meeting" <?php if(isset($webinar->type) && $webinar->type == "meeting") echo "selected"; ?>>Meeting</option>



	</select>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="type-target" class="tooltipicon"></span>

						<span class="type-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_type');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
					</div>
                    <span class="error"><?php echo form_error('type'); ?></span> 
				</div>
                
                <div class="form-group"> 
                	
                    <label class="col-sm-3 control-label" for="privacy"><?php echo 'Privacy'?> <span class="required">*</span></label>

                    <div class="col-sm-5"> 
                    	
                        <select id="privacy" name="privacy" class="form-control">


							<option value="private" <?php if(isset($webinar->privacy) && $webinar->privacy == "private") echo "selected"; ?>>Private</option>



							<option value="public" <?php if(isset($webinar->privacy) && $webinar->privacy == "public") echo "selected"; ?>>Public</option>



						</select>



					<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="privacy-target" class="tooltipicon"></span>

						<span class="privacy-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_privacy');?>

                         <!--/tip containt-->

						</span>

						</span>

						<!-- tooltip area finish -->

					</div> 
                    <span class="error"><?php echo form_error('privacy'); ?></span>
				</div> 
                
                <div class="form-group"> 
                    <label class='col-sm-3 control-label' for="fromdate"><?php echo 'Starts On'?> <span class="required">*</span></label>
                    <div class="col-sm-3"> 
                        <input class="form-control" id="fromdate" type="text" name="fromdate" maxlength="256" value="<?php echo set_value('fromdate', (isset($webinar->fromdate)) ? $webinar->fromdate : ''); ?>"  /> 
					</div> 
                    <div class="col-sm-2" style="float:left;"> 
                      <input type="time" name="fromtime" id="fromtime" value="<?php if($updType=='create'){echo $gmtime;} else{ echo set_value('fromtime', (isset($webinar->fromtime)) ? $webinar->fromtime : ''); }?>"> 
                    	
                        <!-- <select id="fromtime" name="fromtime" class="form-control">



<option value='0'>Select time</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:00AM") echo "selected"; ?>>12:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:15AM") echo "selected"; ?>>12:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:30AM") echo "selected"; ?>>12:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:45AM") echo "selected"; ?>>12:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:00AM") echo "selected"; ?>>01:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:15AM") echo "selected"; ?>>01:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:30AM") echo "selected"; ?>>01:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:45AM") echo "selected"; ?>>01:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:00AM") echo "selected"; ?>>02:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:15AM") echo "selected"; ?>>02:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:30AM") echo "selected"; ?>>02:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:45AM") echo "selected"; ?>>02:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:00AM") echo "selected"; ?>>03:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:15AM") echo "selected"; ?>>03:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:30AM") echo "selected"; ?>>03:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:45AM") echo "selected"; ?>>03:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:00AM") echo "selected"; ?>>04:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:15AM") echo "selected"; ?>>04:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:30AM") echo "selected"; ?>>04:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:45AM") echo "selected"; ?>>04:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:00AM") echo "selected"; ?>>05:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:15AM") echo "selected"; ?>>05:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:30AM") echo "selected"; ?>>05:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:45AM") echo "selected"; ?>>05:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:00AM") echo "selected"; ?>>06:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:15AM") echo "selected"; ?>>06:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:30AM") echo "selected"; ?>>06:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:45AM") echo "selected"; ?>>06:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:00AM") echo "selected"; ?>>07:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:15AM") echo "selected"; ?>>07:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:30AM") echo "selected"; ?>>07:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:45AM") echo "selected"; ?>>07:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:00AM") echo "selected"; ?>>08:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:15AM") echo "selected"; ?>>08:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:30AM") echo "selected"; ?>>08:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:45AM") echo "selected"; ?>>08:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:00AM") echo "selected"; ?>>09:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:15AM") echo "selected"; ?>>09:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:30AM") echo "selected"; ?>>09:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:45AM") echo "selected"; ?>>09:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:00AM") echo "selected"; ?>>10:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:15AM") echo "selected"; ?>>10:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:30AM") echo "selected"; ?>>10:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:45AM") echo "selected"; ?>>10:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:00AM") echo "selected"; ?>>11:00 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:15AM") echo "selected"; ?>>11:15 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:30AM") echo "selected"; ?>>11:30 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:45AM") echo "selected"; ?>>11:45 AM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:00PM") echo "selected"; ?>>12:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:15PM") echo "selected"; ?>>12:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:30PM") echo "selected"; ?>>12:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:45PM") echo "selected"; ?>>12:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:00PM") echo "selected"; ?>>01:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:15PM") echo "selected"; ?>>01:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:30PM") echo "selected"; ?>>01:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:45PM") echo "selected"; ?>>01:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:00PM") echo "selected"; ?>>02:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:15PM") echo "selected"; ?>>02:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:30PM") echo "selected"; ?>>02:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:45PM") echo "selected"; ?>>02:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:00PM") echo "selected"; ?>>03:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:15PM") echo "selected"; ?>>03:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:30PM") echo "selected"; ?>>03:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:45PM") echo "selected"; ?>>03:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:00PM") echo "selected"; ?>>04:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:15PM") echo "selected"; ?>>04:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:30PM") echo "selected"; ?>>04:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:45PM") echo "selected"; ?>>04:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:00PM") echo "selected"; ?>>05:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:15PM") echo "selected"; ?>>05:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:30PM") echo "selected"; ?>>05:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:45PM") echo "selected"; ?>>05:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:00PM") echo "selected"; ?>>06:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:15PM") echo "selected"; ?>>06:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:30PM") echo "selected"; ?>>06:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:45PM") echo "selected"; ?>>06:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:00PM") echo "selected"; ?>>07:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:15PM") echo "selected"; ?>>07:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:30PM") echo "selected"; ?>>07:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:45PM") echo "selected"; ?>>07:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:00PM") echo "selected"; ?>>08:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:15PM") echo "selected"; ?>>08:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:30PM") echo "selected"; ?>>08:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:45PM") echo "selected"; ?>>08:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:00PM") echo "selected"; ?>>09:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:15PM") echo "selected"; ?>>09:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:30PM") echo "selected"; ?>>09:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:45PM") echo "selected"; ?>>09:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:00PM") echo "selected"; ?>>10:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:15PM") echo "selected"; ?>>10:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:30PM") echo "selected"; ?>>10:30 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:45PM") echo "selected"; ?>>10:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:00PM") echo "selected"; ?>>11:00 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:15PM") echo "selected"; ?>>11:15 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:30PM") echo "selected"; ?>>11:30 PM</option>







</select>
 -->




<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="fromdate-target" class="tooltipicon"></span>

						<span class="fromdate-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_fromdate');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

					</div> 
                    <span class="error"><?php echo form_error('fromdate'); ?></span><span class="error"><?php echo form_error('fromtime'); ?></span> 
                     <span >GMT</span>
				</div> 
                
                <!-- <div class="form-group"> 
                    <label class='col-sm-3 control-label' for="todate"><?php echo 'To'?> <span class="required">*</span></label> 
                    <div class="col-sm-3"> 
                        <input class="form-control" id="todate" type="text" name="todate" maxlength="256" value="<?php echo set_value('todate', (isset($webinar->fromdate)) ? $webinar->todate : ''); ?>"  /> 
					</div> 
                    <div class="col-sm-2"> 
                    	
                        <select class="form-control" onchange="ValidateDate()" id="totime" name="totime">



<option value='0'>Select time</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:00AM") echo "selected"; ?>>12:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:15AM") echo "selected"; ?>>12:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:30AM") echo "selected"; ?>>12:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:45AM") echo "selected"; ?>>12:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:00AM") echo "selected"; ?>>01:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:15AM") echo "selected"; ?>>01:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:30AM") echo "selected"; ?>>01:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:45AM") echo "selected"; ?>>01:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:00AM") echo "selected"; ?>>02:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:15AM") echo "selected"; ?>>02:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:30AM") echo "selected"; ?>>02:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:45AM") echo "selected"; ?>>02:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:00AM") echo "selected"; ?>>03:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:15AM") echo "selected"; ?>>03:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:30AM") echo "selected"; ?>>03:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:45AM") echo "selected"; ?>>03:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:00AM") echo "selected"; ?>>04:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:15AM") echo "selected"; ?>>04:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:30AM") echo "selected"; ?>>04:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:45AM") echo "selected"; ?>>04:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:00AM") echo "selected"; ?>>05:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:15AM") echo "selected"; ?>>05:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:30AM") echo "selected"; ?>>05:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:45AM") echo "selected"; ?>>05:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:00AM") echo "selected"; ?>>06:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:15AM") echo "selected"; ?>>06:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:30AM") echo "selected"; ?>>06:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:45AM") echo "selected"; ?>>06:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:00AM") echo "selected"; ?>>07:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:15AM") echo "selected"; ?>>07:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:30AM") echo "selected"; ?>>07:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:45AM") echo "selected"; ?>>07:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:00AM") echo "selected"; ?>>08:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:15AM") echo "selected"; ?>>08:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:30AM") echo "selected"; ?>>08:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:45AM") echo "selected"; ?>>08:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:00AM") echo "selected"; ?>>09:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:15AM") echo "selected"; ?>>09:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:30AM") echo "selected"; ?>>09:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:45AM") echo "selected"; ?>>09:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:00AM") echo "selected"; ?>>10:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:15AM") echo "selected"; ?>>10:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:30AM") echo "selected"; ?>>10:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:45AM") echo "selected"; ?>>10:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:00AM") echo "selected"; ?>>11:00 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:15AM") echo "selected"; ?>>11:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:30AM") echo "selected"; ?>>11:30 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:45AM") echo "selected"; ?>>11:45 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:00PM") echo "selected"; ?>>12:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:15PM") echo "selected"; ?>>12:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:30PM") echo "selected"; ?>>12:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:45PM") echo "selected"; ?>>12:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:00PM") echo "selected"; ?>>01:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:15PM") echo "selected"; ?>>01:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:30PM") echo "selected"; ?>>01:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:45PM") echo "selected"; ?>>01:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:00PM") echo "selected"; ?>>02:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:15PM") echo "selected"; ?>>02:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:30PM") echo "selected"; ?>>02:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:45PM") echo "selected"; ?>>02:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:00PM") echo "selected"; ?>>03:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:15PM") echo "selected"; ?>>03:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:30PM") echo "selected"; ?>>03:30 PM</option>


 
<option <?php if(isset($webinar->totime) && $webinar->totime == "03:45PM") echo "selected"; ?>>03:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:00PM") echo "selected"; ?>>04:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:15PM") echo "selected"; ?>>04:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:30PM") echo "selected"; ?>>04:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:45PM") echo "selected"; ?>>04:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:00PM") echo "selected"; ?>>05:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:15PM") echo "selected"; ?>>05:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:30PM") echo "selected"; ?>>05:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:45PM") echo "selected"; ?>>05:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:00PM") echo "selected"; ?>>06:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:15PM") echo "selected"; ?>>06:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:30PM") echo "selected"; ?>>06:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:45PM") echo "selected"; ?>>06:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:00PM") echo "selected"; ?>>07:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:15PM") echo "selected"; ?>>07:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:30PM") echo "selected"; ?>>07:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:45PM") echo "selected"; ?>>07:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:00PM") echo "selected"; ?>>08:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:15PM") echo "selected"; ?>>08:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:30PM") echo "selected"; ?>>08:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:45PM") echo "selected"; ?>>08:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:00PM") echo "selected"; ?>>09:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:15PM") echo "selected"; ?>>09:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:30PM") echo "selected"; ?>>09:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:45PM") echo "selected"; ?>>09:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:00PM") echo "selected"; ?>>10:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:15PM") echo "selected"; ?>>10:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:30PM") echo "selected"; ?>>10:30 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:45PM") echo "selected"; ?>>10:45 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:00PM") echo "selected"; ?>>11:00 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:15PM") echo "selected"; ?>>11:15 PM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:30PM") echo "selected"; ?>>11:30 PM</option>







</select>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="todate-target" class="tooltipicon"></span>

						<span class="todate-target  tooltargetdiv" style="display: none;" > -->

						<!-- <span class="closetooltip"></span> -->

						<!--tip containt-->

						<?php //echo lang('webinar_fld_todate');?>

                         <!--/tip containt-->

						<!-- </span>

						</span>
 -->
<!-- tooltip area finish -->

					<!-- </div> 
                    <span class="error"><?php echo form_error('todate'); ?></span><span class="error"><?php echo form_error('totime'); ?></span>
                    <span>GMT</span>
				</div>  --> 
                
           <!--<div class="form-group"> 
                	<label class="col-sm-3 control-label" for="allday"><?php echo 'All day'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    	<div class="checkbox"> 
                        	<label> 
                            <input id="allday" type="checkbox" name="allday"  <?php if(isset($webinar->allday) && $webinar->allday == 1) echo "checked"; ?>/>
							</label> 



						<span class="tooltipcontainer">

						<span type="text" id="allday_published-target" class="tooltipicon"></span>

						<span class="allday_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('webinar_fld_allday-published');?>



						</span>

						</span>



                        </div> 
                        <span class="error"><?php echo form_error('allday'); ?></span>
                         
					</div> 
				</div> 
                
                <div class="form-group"> 
                    <label class='col-sm-3 control-label' for="repeate"><?php echo 'Repeate'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    	
                        <select id="repeate" name="repeate" class="form-control">



	<option value="never" <?php if(isset($webinar->repeate) && $webinar->repeate == "never") echo "selected"; ?>>Never</option>



	<option value="every_day" <?php if(isset($webinar->repeate) && $webinar->repeate == "every_day") echo "selected"; ?>>Every Day</option>



	<option value="every_week" <?php if(isset($webinar->repeate) && $webinar->repeate == "every_week") echo "selected"; ?>>Every Week</option>



	<option value="every_month" <?php if(isset($webinar->repeate) && $webinar->repeate == "every_month") echo "selected"; ?>>Every Month</option>



	</select>





						<span class="tooltipcontainer">

						<span type="text" id="repeat-target" class="tooltipicon"></span>

						<span class="repeat-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>


						<?php echo lang('webinar_fld_repeat');?>

                         

						</span>

						</span>




					</div> 
                    <span class="error"><?php echo form_error('repeate'); ?></span> 
				</div> 
                
                <div class="form-group"> 
                
                    <label class='col-sm-3 control-label' for="untilldate"><?php echo 'Untill Date'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                        <input id="untilldate" type="text" name="untilldate" class="form-control" maxlength="256" value="<?php echo set_value('untilldate', (isset($webinar->untilldate)) ? $webinar->untilldate : ''); ?>"  />





						<span class="tooltipcontainer">

						<span type="text" id="untildate-target" class="tooltipicon"></span>

						<span class="untildate-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('webinar_fld_untildate');?>

              

						</span>

						</span>

					</div> 
                    <span class="error"><?php echo form_error('untilldate'); ?></span>
				</div> 
                
                <div class="form-group"> 
                <label class='col-sm-3 control-label' for="start_recording"><?php echo 'Start Recording'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    
                    	<div class="checkbox"> 
                        	<label> <input id="start_recording" type="checkbox" name="start_recording" <?php if(isset($webinar->start_recording) && $webinar->start_recording == 1) echo "checked"; ?>/></label> 





						<span class="tooltipcontainer">

						<span type="text" id="start_recording-target" class="tooltipicon"></span>

						<span class="start_recording-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('webinar_fld_start-recording');?>

               

						</span>

						</span>


                        </div> 
                         <span class="error"><?php echo form_error('start_recording'); ?></span>
					</div> 
				</div> -->
                    <div class="form-group"> 
      <label class="col-sm-3 control-label">
        Duration<span class="required">*</span>
      </label>
      <div class="col-sm-5">

        <div class="" style="float:left; padding: 0;"> 
        <input type="text" placeholder="Ex.30" value="<?php if($updType=='create'){echo '30';} else{ echo set_value('web_duration', (isset($webinar->web_duration)) ? $webinar->web_duration : ''); }?>" id="web_duration" name="web_duration"> (Enter duration between 30 to 300 minutes.)
        </div>
        </div>
    </div>
                <div class="form-group"> 
                    <label class='col-sm-3 control-label' for="status"><?php echo 'Status'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    
                        <select class="form-control" id="status" name="status">



	<option value="active" <?php if(isset($webinar->status) && $webinar->status == "active") echo "selected"; ?>>Active</option>



	<option value="deactive" <?php if(isset($webinar->status) && $webinar->status == "deactive") echo "selected"; ?>>Deactive</option>



	</select>






						<span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('webinar_fld_published');?>

               

						</span>

						</span>

					</div> 
                    <span class="error"><?php echo form_error('status'); ?></span>
				</div> 
                
                <div class="form-group"> 
                	<div class="col-sm-offset-3 col-sm-5"> 
                    <a><?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'") ); ?></a>
					<a href='<?php echo base_url(); ?>admin/webinars/listings/<?php echo $proid?>' class='btn btn-red'><span class="icon-32-cancel"> </span>Cancel </a>
                    </div> 
				</div> 
			</fieldset> 
		</div> 
	</div> 
</div>

<?php echo form_hidden('proid',$proid) ?>

<?php if ($updType == 'edit'): ?>


	<?php echo form_hidden('id',$webinar->id) ?>


<?php endif ?>

<?php echo form_close(); ?>



<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />



<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>



<!--<script>



 $(document).ready(



 function()



 {



 validate();



   	$('#description').redactor(); 



  });


 </script>





 <!-- tool tip script --> 

<script type="text/javascript">

function ValidateDate()
{
	var start_time = $('#fromtime').val();

	var end_time = $('#totime').val();

	var start_date = $('#fromdate').val();

	var end_date = $('#todate').val();
	

	var dtStart = new Date(start_date+' '+ start_time);
	var dtEnd = new Date(end_date+' '+ end_time);
	var difference_in_milliseconds = dtEnd - dtStart;
	if (difference_in_milliseconds < 0)
	{
	alert("End Time is before Start Time!");
	}

}

$(document).ready(function(){

	$('.tooltipicon').click(function(){

	var dispdiv = $(this).attr('id');

	$('.'+dispdiv).css('display','inline-block');

	});

	$('.closetooltip').click(function(){

	$(this).parent().css('display','none');

	});

	});

	</script>