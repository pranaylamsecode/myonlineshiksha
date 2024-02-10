<style type="text/css">
.table {
    width: 100%;
    margin-bottom:0!important;
}
.dataTable .table-title {
    padding: 0px !important;
    color: #95aac9 !important;
    font-size: 10px !important;
    font-weight: 600 !important;
    letter-spacing: .08em;
    text-transform: uppercase;
}
  .reseller_table_section .control-label.field-title {
    padding: 15px 0px 10px 0px;
    font-size: 20px !important;
}

  .reseller_table_section table{
    width: 100%;
  }
.reseller_table_section button {
    display: inline-block;
    float: left !important;
    margin-bottom: 25px;
    width: auto;
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
}
.listbutton .btn-green{
    background-color: #11ca15 !important;
    border-color: #11ca15 !important;
    border-radius: 20px !important;
}
.listbutton .btn-primary{
    background-color: #303641 !important;
    border-color: #303641 !important;
    border-radius: 20px !important;  
}
.field-title .btn-black{
  border-radius: 20px !important;
    font-weight: bold;
    width: 50%;
}
.field-title .btn-warning{
    background-color: #fbaf24 !important;
    border-color: #fbaf24 !important;
    border-radius: 20px !important;
    font-weight: bold;
    width: 50%;
}
.new_course_select_sec{
  height: auto !important;
}
.new_course_select_sec h4{
  line-height: 1.63;
}
.new_course_select_sec h4 a{
  color: #2d3b92;
  border-bottom: 1px solid;
  font-size: 17px;
}
.new_course_popup{
    width: 35%;
  }
@media (max-width: 767px){
  .new_course_popup{
    width: 90%;
  }
}
@media (max-width: 991px){
  .new_course_popup{
    width: 80%;
  }
}

#ajax_payout{
  margin: 0;
  float: right;
}
.timer{
  display: inline-block;
  width: 100%;
  margin-top: 5px;
  text-align: center;
}
</style>

<?php /*if($msg == '0' || $msg == '1'){
  if($msg == '0'){
 ?>
  <span id="message">
    <div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-exclamation-triangle" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Meeting cannot be created due to following error :<br> The Token's Signature resulted invalid when verified using the Algorithm: HmacSHA256<br>or Token's Signature expired! </span></div>
  </span>
<?php }else{ ?>
  <span id="message">
    <div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-check" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Meeting created successfully. </span></div>
  </span>
<?php } }*/ ?>
<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic"><h2>Conferences</h2></div>
    <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
      <ul id="sticky" style="list-style:none; float: right;/*padding-right: 20px;*/  display: flex;">
        <li id="toolbar-new" class="listbutton" style="padding-right: 10px;">
          <a href="<?php echo base_url('conference-create/create');?>" class="btn">
            <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Schedule a new Meeting
          </a>
        </li>
        <li id="toolbar-new" class="listbutton" style="padding-right: 10px;">
          <a href="javascript:void(0)" class="btn" onclick="return open_popup()">
            <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Add License User
          </a>
        </li>
        <li id="toolbar-new" class="listbutton">
          <a href="<?php echo base_url();?>conference-settings" class="btn">
            <span class="icon-32-new"></span><i class="entypo entypo-cog"></i> Settings 
          </a>
        </li>
      </ul>
     
    </div>
    
  </div>
</div>
<div class=" reseller_table_section" id="meetingList">
  <!-- <label class="col-sm-12 control-label field-title" for="name">Meetings</label> -->
  <div class="table_section_outer">
    <div class="card">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Title</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Start Time</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Duration</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">ID</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Options</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php 
        if(!empty($meetings)){
        $ip = $_SERVER['REMOTE_ADDR'];
          $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
          $configarr = $this->settings_model->getItems();
        foreach ($meetings as $key) {
          $date = new DateTime($key->start_time, new DateTimeZone($configarr[0]['time_zone']));
          $date->setTimezone(new DateTimeZone($details->geoplugin_timezone));
          $time= $date->format('Y-m-d H:i:s');
          
          $end_time = date('Y-m-d H:i:s',strtotime($time . " +".$key->duration." minutes"));
          $start_time = date('Y-m-d H:i:s',strtotime($time . " -1 minutes"));

          $datetime1 = new DateTime(date('Y-m-d H:i:s'));
          $datetime2 = new DateTime($time);
          $inter = $datetime1->diff($datetime2);
          if($inter->format('%d') <= 1)
          {
            if($inter->format('%d') == 1)
            {
              $interval = $inter->format('%d')." Day ".$inter->format('%h')." Hours "." to start";
              $hour_int = $inter->format('%h');  
            }else{
              $interval = $inter->format('%h')." Hours ".$inter->format('%i')." Minutes to start";
              $hour_int = $inter->format('%h');
            }
          }else
          {
            $interval = "";
            $hour_int = 25;
          }
        ?>
        <tr class="camp0">
          <td class="field-title" ><?php echo ucwords($key->topic); ?></td>
          <td class="field-title" >Start time: <?php echo date('M d Y, h:i A',strtotime($key->start_time)); ?></td>
          <td class="field-title" ><?php echo $key->duration; ?> Minutes</td>
          <td class="field-title" ><?php echo $key->meeting_id;?></td>
          
          <td class="field-title">
          <?php 
          if(date('Y-m-d',strtotime($time)) ==  date('Y-m-d')){ 
             /*type="button" onclick="return check_zoom('https://zoom.us/wc/<?php echo $key->meeting_id; ?>/start');"*/
            if(date('Y-m-d H:i:s') >= $start_time && date('Y-m-d H:i:s') <= $end_time){ ?>
            <a class="btn btn-success btn-md end_<?php echo $key->id;?>" href="<?php echo $key->start_url;?>">Start Meeting</a>
            <!-- <a href="<?php echo base_url().'invite/'.$key->meeting_id;?>" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;">Invite Users</a> -->
            <span class="end_timer" id="end_<?php echo $key->id;?>" style="display: none;"><?php echo date('M d, Y, H:i:s',strtotime($end_time)); ?></span>
           <?php } else if(date('Y-m-d H:i:s') < $start_time){ ?>
            <span class="end_timer" id="end_<?php echo $key->id;?>" style="display: none;"><?php echo date('M d, Y, H:i:s',strtotime($end_time)); ?></span>
            <span style="display: none" id="url_timer_<?php echo $key->id;?>"><?php echo $key->start_url;?></span>
            <a class="btn btn-warning btn-md end_<?php echo $key->id;?> url_timer_<?php echo $key->id;?>" href="#" type="button">Wait</a>
            <!-- <a href="<?php echo base_url().'invite/'.$key->meeting_id;?>" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;">Invite Users</a> -->
            <br>
            <span class="timer timer_<?php echo $key->id;?>" id="timer_<?php echo $key->id;?>"><?php echo date('M d, Y, H:i:s',strtotime($time . " -1 minutes")); ?></span>

           <?php } else if(date('Y-m-d H:i:s') > $end_time){ ?>
            <a class="btn btn-danger btn-md" href="#" id="wait" type="button">Finished</a>
           <?php }
          }else if(date('Y-m-d',strtotime($key->start_time)) > date('Y-m-d')){ ?>
          <a class="btn btn-warning btn-md" href="#" type="button">Upcoming</a>
          <!-- <a href="<?php echo base_url().'invite/'.$key->meeting_id;?>" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;">Invite Users</a> -->
          <?php if(intval($hour_int) <= 24){ ?>
          <br><span class="interval_span"><?php echo $interval; ?></span>
          <?php }
          } else if(date('Y-m-d',strtotime($key->start_time)) < date('Y-m-d')){ ?>
          <a class="btn btn-danger btn-md" type="button" href="#" id="wait">Finished</a>
          <?php } ?>
          </td>
          <?php //} ?>
        </tr>
        <?php } }else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="6" style="color: #949494; text-align:center !important;">No Meetings Available. <a href="<?php echo base_url('conference-create/create');?>">Create now</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
 <!--  </div>
</div> -->

<div class="row pagination" style="margin-bottom: 70px;">
<?php if($paying) { ?>     
   <div class="col-xs-6 col-left">
      <div class="dataTables_info" id="table-3_info">Showing <?php echo $firstp;?> to <?php echo $startp; ?> of <?php echo $total_payout; ?> entries</div>
   </div>
    <div class="col-xs-6 col-right">
       <div class="dataTables_paginate paging_bootstrap">
          <ul class="pagination pagination-sm" id="ajax_payout">
            <?php echo $paying; ?>
          </ul> 
       </div>
    </div>
<?php } ?>
</div><!-- card -->

</div>

<div class="popup_overlay" style="display: none;" onclick="return close_popup();"></div>
<div class="new_course_popup" style="display: none;">
    <div class="new_course_popup_header">
        <span class="popup_heading" style="color: #fad839;font-weight: bold;">License</span>
        <span class="lnr lnr-cross cross_icon" onclick="return close_popup();"></span>
    </div>
    <div class="new_course_select_sec">
      <div class="col-sm-12 form-group">
        <label class="field-title">Email ID <span id="email_err" style="color: red;"></span></label>
        <input type="text" id="user_email" class="form-control form-height">
      </div>
      <div class="col-sm-12 form-group">
        <a class="btn btn-info pull-right next-link" onclick="return add_license()"> Add License </a>
      </div>
    </div>
</div>



<script type="text/javascript">
  jQuery(document).ready(function(){
    // Set the date we're counting down to
    $('.end_timer').each(function() {
      var id = $(this).attr('id');
      var countDownDate1 = new Date($(this).html()).getTime();
      var x1 = setInterval(function() {
        var now1 = new Date().getTime();
        var distance1 = countDownDate1 - now1;
        console.log(distance1+" ");
        if (distance1 <= 0) {
          console.log('ended ');
          $('.'+id).attr('href','#').html('Lecture Ended').removeClass('btn-success').addClass('btn-danger');
          // $("."+id).html('');
          clearInterval(x1);

          // $("#url_"+id).html('');
        }
      },1000);
    });
    $('.timer').each(function() { 
      var id = $(this).attr('id');
      var countDownDate = new Date($(this).html()).getTime();
      var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        var wait = "";
        if(hours > 0)
          wait += hours+"hrs ";
        if(minutes > 0 || hours > 0)
          wait += minutes+"min ";
        
        if(minutes > 0 || seconds > 0)
          wait += seconds+"sec ";

        wait += " to start";
        $("."+id).html(wait);
        if (distance <= 0) {
          $('.url_'+id).attr('href',$('#url_'+id).html()).html('Start Lecture').removeClass('btn-warning').addClass('btn-success');
          $("."+id).html('');
          $("#url_"+id).html('');
          clearInterval(x);
        }
      }, 1000);
    });


  });
  function open_popup(url){
    // alert('Are you logged in to Zoom. if not please login into zoom first and then click next!');
      $('.popup_overlay').show();
      $('.new_course_popup').show();
  }
  function close_popup(){
      $('.new_course_popup').hide();
      $('.popup_overlay').hide();
  }
  function add_license(){
    var email = $("#user_email").val().trim();
    var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    if(email =="")
    {
        $("#email_err").fadeIn().html("Please enter email").css('color','red');
        setTimeout(function(){$("#email_err").html("");},3000);
        $("#user_email").focus();
        return false;
    }
    else if(!email_pattern.test(email))
    {
        $("#email_err").fadeIn().html("Please enter valid email").css('color','red');
        setTimeout(function(){$("#email_err").html("");},3000);
        $("#user_email").focus();
        return false;
    }

    $(".next-link").html('wait... <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>').removeAttr('onclick');
    $.ajax({
      type : "post",
      cache: false,
      url : "<?php echo base_url();?>add-license/",
      data : {email : email},
      success : function(response){
        console.log(response);
        $(".next-link").html('Add License').attr('onclick',"return add_license()");
        if(response == 0){
          $("#email_err").fadeIn().html("email already exists").css('color','red');
          setTimeout(function(){$("#email_err").html("");},3000);
          $("#user_email").focus();
          return false;
        }else{
          $("#email_err").fadeIn().html("License Added").css('color','green');
          $("#user_email").val('');
          setTimeout(function(){
            close_popup();
          },1500);
        }
      }
    });
  }
</script> 