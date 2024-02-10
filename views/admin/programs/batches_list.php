<style type="text/css">
  .reseller_table_section {
    display: inline-block;
}
  .reseller_table_section .control-label.field-title {
    padding: 15px 0px 10px 0px;
    font-size: 20px !important;
}
.reseller_table_section {
    padding: 0px;
    margin-bottom: 10px;
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
.interval_span{
  display: inline-block;
  width: 100%;
  margin-top: 5px;
  text-align: center;
}
.fallupcls .lnr-cross{
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  position: absolute;
  right: 5px;
  top: 11px;
}
.fallup_deleted{
  background: #de5151 !important;
  color: #fff;
  font-weight: bold;
}
.field-title .btn-warning{
  background-color: #fbaf24 !important;
  border-color: #fbaf24 !important;
  border-radius: 20px !important;
  font-weight: bold;
  width: 100%;
}
</style>
<?php $auth = $this->session->userdata('logged_in'); ?>
<div id="toolbar-box">
  <div class="m">
    <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
      <ul id="sticky" style="list-style:none; float: right;display: flex;">
        <li id="toolbar-new" class="listbutton">
          <a class="btn btn-default btn-dark-grey pull-right" href="<?php echo ($auth['groupid'] == 4) ? base_url().'admin/programs/create_batch/'.$program->id : 'javascript:alert(\'You are not authorised to access this menu.\')';?>">
            <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Create new Batch
          </a>
        </li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pagetitle icon-48-generic"><h2><span style="font-size:18px;">Batches & Events for</span> <?php echo $program->name;?></h2></div>
  </div>
</div>
<div class="col-md-12 col-xs-12 reseller_table_section" id="meetingList" style="padding-top: 20px;margin-bottom: 50px;">
    <div class="tab-pane" id="webinar">
      <dd class="" sno="9" id="dd_9">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <div id="batchdiv">
            <?php if (!empty($batches)){ ?>
            <ul class="nav tabs-vertical">
              <?php $ij = 1;
              foreach ($batches as $batch) {
              ?>
              <li class="<?php if($ij==1){ ?> active <?php } ?>" id="vtab<?php echo $batch->id; ?>" onclick="return jump_tab('<?php echo $batch->id;?>');">
                <a class="fallupcls" href="#vtab_<?php echo $batch->id; ?>">
                  <i class="entypo-dot"></i><?php echo ucwords($batch->batch_name);?>
                  <span class="lnr lnr-cross" <?php echo ($auth['groupid'] == 4) ? 'onclick="delete_batch('.$batch->id.');"' : 'onclick="alert(\'You are not authorised to access this menu.\');"';?>></span>
                </a>
              </li>
              <?php $ij++; } ?>
              <input type="hidden" id="batch_count" value="<?php echo count($batches);?>">
            </ul>
            <div class="tab-content vtab_div">
              <?php $i = 1;
              foreach ($batches as $batch) {
                $events = $this->Crud_model->GetData('zoom_meeting_list','','is_delete = "no" and conf_type = "batch" and batch_id = '.$batch->id);
              ?>
              <div class="tab-pane <?php if($i==1){ ?> active <?php } ?>" id="vtab_<?php echo $batch->id;?>">
              
                <a href="<?php echo ($auth['groupid'] == 4) ? base_url().'admin/programs/update_batch/'.$batch->id.'/'.$program->id : 'javascript:alert(\'You are not authorised to access this menu.\')';?>"><span class="icon-32-new"></span><i class="lnr lnr-pencil" style="font-weight: bold;"></i>
                <span style="font-size: 18px;padding-left: 5px;text-decoration: underline;"><?php echo ucwords($batch->batch_name); ?> : [ <?php echo date('h:i A',strtotime($batch->batch_start_time)).' - '.date('h:i A',strtotime($batch->batch_end_time)); ?> ]</span></a><br>
                <span style="font-size: 13px;padding-left: 20px;"><?php if($batch->batch_from != '0000-00-00'){ echo 'starts from : '.date('Y-m-d',strtotime($batch->batch_from));} ?></span>

                <a href="<?php echo ($auth['groupid'] == 4) ? base_url().'conference-create/'.$batch->id : 'javascript:alert(\'You are not authorised to access this menu.\')';?>" class="btn btn-default btn-dark-grey pull-right"><span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Create Lecture </a>
                <table class="table table-bordered responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Lecture Title</th>
                      <th>Lecture Date & Time</th>
                      <th>No. of Students</th>
                      <th>Options</th>
                      <th>Start Lecture</th>
                    </tr>
                  </thead>
                  <tbody id="event_body" style="text-align: center;">
                  <?php if(!empty($events)){ $j=1;
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
                    $configarr = $this->settings_model->getItems();
                    foreach ($events as $evt) {
                      $date = new DateTime($evt->start_time, new DateTimeZone($configarr[0]['time_zone']));
                      $date->setTimezone(new DateTimeZone($details->geoplugin_timezone));
                      $time= $date->format('Y-m-d H:i:s');
                      $end_time = date('Y-m-d H:i:s',strtotime($time . " +".$evt->duration." minutes"));
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
                 ?>
                    <tr class="odd" id="event_id_<?php echo $evt->id;?>">
                      <td class="field-title" style="color: #666;"><?php echo $j++; ?></td>
                      <td class="field-title" style="color: #666;">
                      <?php if(date('Y-m-d H:i:s') > $end_time){ ?>
                      <a href="<?php echo base_url().'admin/programs/get_attendees/'.$evt->id;?>"><?php echo ucwords($evt->topic);?></a>
                      <?php }else echo ucwords($evt->topic); ?>
                      </td>
                      <td class="field-title">
                        <?php echo date('Y-m-d h:i A',strtotime($time));
                        if(date('Y-m-d',strtotime($time)) ==  date('Y-m-d')){ 
                          if(date('Y-m-d H:i:s') < $start_time){
                            echo "<br>( ".$interval." )";
                          }
                        }else if(date('Y-m-d',strtotime($evt->start_time)) > date('Y-m-d')){
                          if(intval($hour_int) <= 24){
                            echo "<br>( ".$interval." )";
                          }
                        }
                        ?>
                      </td>
                      <td><?php echo $batch->enroll_limit; ?></td>
                      <td class="editdelete">
                        <a class="col-sm-offset-2 col-sm-4 no-padding" href="<?php echo ($auth['groupid'] == 4) ? base_url().'conference-edit/'.$evt->id.'/batch/' : 'javascript:alert(\'You are not authorised to access this menu.\')';?>"><div class="sprite 2edit" style="background-position: -32px 0;" title="Course Content"></div></a>
                        <a class="col-sm-4" href="#" <?php echo ($auth['groupid'] == 4) ? 'onclick="delete_event('.$evt->id.');"' : 'onclick="alert(\'You are not authorised to access this menu.\');"';?> ><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
                      </td>
                      <td class="field-title">
                        <?php if(date('Y-m-d',strtotime($time)) ==  date('Y-m-d')){ 
                        if(date('Y-m-d H:i:s') >= $start_time && date('Y-m-d H:i:s') <= $end_time){ ?>
                        <a class="btn btn-warning btn-md" href="<?php echo $evt->start_url;?>">Start</a>
                        <?php } else if(date('Y-m-d H:i:s') < $start_time){?>
                        <a class="btn btn-warning btn-md" href="#">Wait</a>
                        <?php } else if(date('Y-m-d H:i:s') > $end_time){ ?>
                        <a class="btn btn-warning btn-md" href="#" id="wait" type="button">Finished</a>
                        <?php }
                        }else if(date('Y-m-d',strtotime($evt->start_time)) > date('Y-m-d')){ ?>
                        <a class="btn btn-warning btn-md" href="#" type="button">Upcoming</a>
                        <?php } else if(date('Y-m-d',strtotime($evt->start_time)) < date('Y-m-d')){ ?>
                        <a class="btn btn-warning btn-md" type="button" href="#" id="wait">Finished</a>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                    <input type="hidden" id="total_events" value="<?php echo intval($j) - 1; ?>">
                    <?php }else{ ?>
                    <tr class="odd">
                      <td colspan="6">
                        No Lectures available. <a href="<?php echo ($auth['groupid'] == 4) ? base_url().'conference-create/'.$batch->id : 'javascript:alert(\'You are not authorised to access this menu.\')';?>">Create one now</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <?php
              $i++;} ?>
            </div>
            <?php }else{ ?>
            <p> No batches available. <a href="<?php echo ($auth['groupid'] == 4) ? base_url().'admin/programs/create_batch/'.$program->id : 'javascript:alert(\'You are not authorised to access this menu.\')';?>">Create one now</a></p>
            <?php } ?>
          </div>
        </fieldset>
      </div>
    </dd>
  </div>
</div>

<div class="popup_overlay" style="display: none;" onclick="return close_popup();"></div>
<div class="new_course_popup" style="display: none;">
    <div class="new_course_popup_header" style="text-align: center;background-color: rgba(66,73,86,.7);">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
    </div>
</div>

<script type="text/javascript" >
  function jump_tab(id){
    $(".tabs-vertical").find('.active').removeClass('active');
    $("#vtab"+id).addClass(' active ');
    $(".vtab_div").find('.active').removeClass('active');
    $("#vtab_"+id).addClass(' active ');
  }
  
function delete_event(id) 
{
  var total_events = $("#total_events").val();       
  $.confirm({
    title: 'Do you really want to delete this lecture ?',
    content: ' ',
    confirm: function(){
      $('.popup_overlay').show();
      $('.new_course_popup').show();
      $.ajax({
          type : 'post',
          cache : false,
          url :"<?php echo base_url();?>conference-delete/",
          data : {id : id},
          success : function(response){
            $(".new_course_popup_header").html('<span style="font-size:22px;color: #fff;">Lecture Deleted</span>');
            setTimeout(function(){
              $('.popup_overlay').hide();
              $('.new_course_popup').hide();
              $(".new_course_popup_header").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
            },1000);
            $("#event_id_"+id).remove();
            total_events = parseInt(total_events) - 1;
            $("#total_events").val(total_events);
            if(total_events == 0){
              var newurl = "<?php echo base_url('conference-create/').$batch->id;?>";
              $("#event_body").html('<tr class="odd"><td colspan="6">No Lectures available. <a href="'+newurl+'">Create one now</a></td></tr>');
            }
          }
      });
    },
    cancel: function(){        
      return true;
    }
  });
}

function delete_batch(id) 
{
  var batch_count = $("#batch_count").val();       
  $.confirm({
    title: 'Do you really want to delete this Batch?',
    content: ' ',
    confirm: function(){ 
      $.ajax({
        type : 'post',
        cache : false,
        url :"<?php echo base_url();?>admin/programs/delete_batch/",
        data : {id : id},
        success : function(response){
          if(response == 'denied'){
            $("#webinar fieldset label").append('<p class="err_batch" style="color:red;">Warning - Unable to delete Batch as it contains some lectures.</p>');
            setTimeout(function(){
              $(".err_batch").remove();
            },5000);

          }else{
            batch_count = parseInt(batch_count) - 1;
            $("#batch_count").val(batch_count);
            $("#vtab"+id+" .fallupcls").html('Deleted').addClass('fallup_deleted');
            setTimeout(function(){
              $("#vtab"+id).remove();
              $('.nav.tabs-vertical li:first-child').addClass('active').click();
            },1000);
            if(batch_count == 0){
              var newurl = "<?php echo base_url().'admin/programs/create_batch/'.$program->id;?>";
              $("#batchdiv").html(' <p> No batches available. <a href="'+newurl+'">Create one now</a></p>');
            }
          }
        }
      });
    },
    cancel: function(){        
      return true;
    }
  });
}

$(document).ready(function(){
    var webmsg = "<?php echo $this->session->userdata('webmsg'); ?>";
    console.log('batch id '+webmsg);
    if(webmsg != ''){
      $(".nav-tabs li.active").removeClass('active');
      $(".field_content").find('.tab-pane').removeClass('active');
      $("#vtab_div div").find('.active').removeClass('active');
      $(".nav-tabs li:nth-child(3)").addClass("active");
      $("#webinar").addClass("active");
      console.log('<?php $this->session->unset_userdata('webmsg'); ?>');
      
      $("#vtab_"+webmsg).addClass('active');
      $(".tabs-vertical").find('.active').removeClass('active');
      $("#vtab"+webmsg).addClass(' active ');
    }
});
</script>