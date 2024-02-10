<style type="text/css">
.listbutton .btn-green{
    background-color: #11ca15 !important;
    border-color: #11ca15 !important;
    border-radius: 20px !important;  
}

.meeting_section {
   margin: 50px 0px 50px 0px;
}
.meeting_section ul li {
   display: inline-block;
   width: 20%;
   float: left;
   border: 1px solid #eee;
}
.meeting_label li {
   background: #f5f5f6;
   padding: 12px 10px;
   color: #000;
   font-size: 16px;
   text-align: center;
}
.meeting_value li {
   background: #f8f8f8;
   color: #000;
   font-size: 16px;
   text-align: center;
   padding: 10px 10px;
   min-height: 62px;
}
.meeting_label {
   display: inline-block;
   width: 100%;
}
.meeting_label ul, .meeting_value ul {
   width: 100%;
   margin: 0px;
   padding: 0px;
   display: flex;
   height: 100%;
}
.meeting_value {
   display: inline-block;
   width: 100%;
}
.meeting_section ul li a {
   background: #11ca15;
   color: #fff;
   padding: 7px 30px;
   border-radius: 50px;
}

.meeting_section ul li:first-child {
    width: 5%;
}
.meeting_section ul li:nth-child(2) {
    width: 27%;
}
.meeting_section ul li:nth-child(3) {
    width: 23%;
}
.meeting_section ul li:nth-child(4) {
    width: 18%;
}
.meeting_section ul li:nth-child(5) {
    width: 12%;
}
.meeting_section ul li:nth-child(6) {
    width: 15%;
}
.meeting_value ul li:first-child {
    justify-content: flex-start;
    font-weight: bold;
}
}
.meeting_section ul li a {
    background: #11ca15;
    color: #fff;
    padding: 9px 45px;
    border-radius: 50px;
    font-size: 15px;
}
.meeting_value li {
    background: #f8f8f8;
    color: #888888;
    font-size: 16px;
    text-align: center;
    display: flex !important;
    padding: 7px 10px;
    min-height: 55px;
    justify-content: center;
    align-items: center;
}
.meeting_value ul li span {
    display: none;
}
@media (max-width: 767px){
    .meeting_label {
    display: none;
}
.meeting_value ul {
    display: inline-block !important;
}
.meeting_value ul {
    display: inline-block !important;
    background: #f8f8f8;
    border-bottom: 1px solid #eee;
    padding: 15px 0px 18px 0px;
}
.meeting_value ul:last-child {
    border-bottom: 0px;
}
.meeting_value ul li span {
    display: inline-block;
    padding-right: 5px;
}
.meeting_section ul li:first-child {
    width: 100%;
}
.meeting_section ul li:nth-child(2) {
    width: 100%;
}
.meeting_section ul li {
    border: 0px !important;
    text-align: left !important;
    justify-content: flex-start;
    height: auto;
    min-height: unset;
   
}
.meeting_section ul li:nth-child(3), .meeting_section ul li:nth-child(4) {
    width: auto;
    padding-right: 20px;
}
.meeting_section ul li:nth-child(5) {
    width: 100%;
}
.meeting_section ul li a {
    background: #11ca15;
    color: #fff;
    padding: 6px 35px 8px 35px;
    border-radius: 50px;
    line-height: 1.3em;
    font-size: 14px;
}
}
.span_interval{
  flex-direction: column;
}
.span_interval span{
  display: block !important;
  font-size: 12px;
  margin-top: 5px;
}
</style>
<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic"><h2>Upcoming Events / Lectures</h2></div>
  </div>
</div>

<div class="meeting_section">
  <div class="container">
    <div class="meeting_label">
   		<ul>
        <li>#</li>
        <li>Lecture Title</li>
  			<li>Course Name</li>
  			<li>Start Time</li>
  			<li>Duration</li>
  			<li>Options</li>
   		</ul>
    </div>
    <div class="meeting_value">
   	<?php 
    if(!empty($batches)){
      $is_meeting = 0;
      $i = 1;
      foreach ($batches as $batch) {
        $criteria = $batch->criteria;
        $trial_status = $batch->trial_status;
        $course_name = $this->Crud_model->get_single('mlms_program',"id = ".$batch->course_id,"id,name,slug");
        // print_r($course_name);continue;
        $meetings = '';
        if(!empty($batch->batch_id)){
        $meetings = $this->Crud_model->GetData('zoom_meeting_list','',"conf_type = 'batch' and status != 'finished' and left(start_time,10) >= '".date('Y-m-d')."' and batch_id = ".$batch->batch_id,"","start_time ASC");
        }// print_r($meetings);
        if(!empty($meetings)){
          $is_meeting = 1;
          /*$ip = $_SERVER['REMOTE_ADDR'];
          $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
          $configarr = $this->settings_model->getItems();*/
          $j = 0;
          foreach ($meetings as $key) {
            /*$date = new DateTime($key->start_time, new DateTimeZone($configarr[0]['time_zone']));
            $date->setTimezone(new DateTimeZone($details->geoplugin_timezone));
            $time= $date->format('Y-m-d H:i:s');*/
            $time= date('Y-m-d H:i:s',strtotime($key->start_time));

            $end_time = date('Y-m-d H:i:s',strtotime($time . " +".$key->duration." minutes"));
            $start_time = date('Y-m-d H:i:s',strtotime($time . " -5 minutes"));

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
            $join_url = urlencode($key->join_url);
        ?>
      <ul>
        <li><?php echo $i; ?></li>
        <li><?php echo ucwords($key->topic);if($key->status == 'started'){echo "<br>(meeting started join now)";}?></li>
        <li><?php echo ucwords($course_name->name); ?></li>
        <li><?php echo date('M d Y, h:i A',strtotime($time)); ?> IST</li>
        <li><?php echo $key->duration; ?> Minutes</li>
        <!-- <li><span>ID: </span> <?php echo $key->meeting_id; ?></li> -->
        <?php if(date('Y-m-d',strtotime($time)) ==  date('Y-m-d')){
          if(date('Y-m-d H:i:s') >= $start_time && date('Y-m-d H:i:s') <= $end_time){ ?>
          <li>
            <span id="redirect_<?php echo $key->id;?>" style="display: none;"><?php echo $key->join_url;?></span>
            <?php 
            if($criteria == 'paid' || $criteria == 'free'){ ?>
            <a href="javascript:void(0)" class="join_<?php echo $key->id;?>" onclick="return set_attendees(<?php echo $key->id;?>)">Join</a></li>
            <?php }else{
            if($trial_status == 0){ 
              if($j == 0){
              $con = $course_name->id.','.$batch->batch_id.','.$i;?>
            <a id="join_<?php echo $i;?>" href="javascript:void(0);" class="revisit_btn" style="background: #1e8651" onclick="return set_status(<?php echo $con; ?>);"> Join </a>
            <?php
            }else{ ?>
            <a href="<?php echo base_url().'online-courses/'.$course_name->slug;?>" class="revisit_btn" style="background: #1e8651"> Locked </a>
            <?php }
            $j++;
            }else{ ?>
            <a href="<?php echo base_url().'online-courses/'.$course_name->slug;?>" class="revisit_btn" style="background: #1e8651"> Locked </a>
            <?php }
            } 
          } else if(date('Y-m-d H:i:s') < $start_time){
            if($criteria == 'trial'){
              if($trial_status == 0 && $j != 0){ ?>
            <li><a href="<?php echo base_url().'online-courses/'.$course_name->slug;?>" class="revisit_btn" style="background: #1e8651"> Locked </a></li>
             <?php }else{ ?>
              <li class="span_interval">
                <a href="#" id="wait">Wait</a>
                <span><?php echo $interval; ?></span>
              </li>
            <?php $j++; }
           }else{
          ?>
          <li class="span_interval">
            <a href="#" id="wait">Wait</a>
            <span><?php echo $interval; ?></span>
          </li>
         <?php } } else if(date('Y-m-d H:i:s') > $end_time){ ?>
          <li><a href="#" id="wait">Finished</a></li>
         <?php }
        }else{
          if($criteria == 'trial'){
              if($trial_status == 0 && $j != 0){ ?>
            <li><a href="<?php echo base_url().'online-courses/'.$course_name->slug;?>" class="revisit_btn" style="background: #1e8651"> Locked </a></li>
             <?php }else{ ?>
              <li class="span_interval">
                <a href="#" id="wait">Wait</a>
                <span><?php echo $interval; ?></span>
              </li>
            <?php $j++; }
           }else{ ?>
                <li class="span_interval">
          <a href="#" id="wait">Upcoming</a>
          <?php if(intval($hour_int) <= 24){ ?>
          <span><?php echo $interval; ?></span>
          <?php } ?>
        </li>
       <?php }
     } ?>
      </ul>
        <?php $i++;
            }
          }
        }
        if($is_meeting == 0){ ?>
        <ul>
            <li style="width: 100% !important;"><div>No Upcoming meetings found.</div></li>
        </ul>
        <?php }
    }else{ ?>
        <ul>
            <li style="width: 100% !important;text-align: center;"><div style="width: 100%;text-align: center;">Not enrolled to any course. &nbsp; <a href="<?php echo base_url();?>category-teacher/all-teacher/"> Enroll now</a></div></li>
        </ul>
    <?php } ?>
    </div> 
  </div>
</div>
<script type="text/javascript">
  function set_attendees(id){
    $(".join_"+id).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>');
    var spantext = $("#redirect_"+id).html().trim();
    $.ajax({
      type : 'post',
      cache : false,
      url : "<?php echo base_url().'programs/set_attendees/';?>",
      data : {event_id : id},
      success: function(response){
        if(response == 'error'){
          alert('session expired! please login again.');
          location.href = "<?php echo base_url();?>";
        }
        else{
          location.href = spantext;
        }
      }
    });
  }
  function set_status(course_id,batch_id,id){
    $("#join_"+id).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>');
    var spantext = $('#redirect_'+id).html().trim();
    $.ajax({
      type : 'post',
      cache : false,
      url : "<?php echo base_url().'programs/set_trial_status/';?>",
      data : {course_id : course_id, batch_id : batch_id},
      success: function(response){
        if(response == 'error'){
          alert('session expired! please login again.');
          location.href = "<?php echo base_url();?>";
        }
        else{
          // window.open(spantext, '_blank').focus();
          location.href = spantext;
          // $("#join_"+id).attr('href',spantext).attr('target',"_blank");
        }
      }
    });
  }
</script>