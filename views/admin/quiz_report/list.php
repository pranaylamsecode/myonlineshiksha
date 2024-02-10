<style type="text/css">

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
</style>

<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic"><h2><?php echo $heading; ?></h2></div>
    <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
      <!-- <ul id="sticky" style="list-style:none; float: right; display: flex;">
        <li id="toolbar-new" class="listbutton" style="padding-right: 10px;">
          <a href="<?php echo base_url('conference-create/create');?>" class="btn btn-green">
            <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Schedule a new Meeting
          </a>
        </li>
        <li id="toolbar-new" class="listbutton">
          <a href="<?php echo base_url();?>conference-settings" class="btn btn-primary">
            <span class="icon-32-new"></span><i class="entypo entypo-cog"></i> Settings 
          </a>
        </li>
      </ul> -->
      <div class="clr"></div>
    </div>
    
  </div>
</div>
<div class=" reseller_table_section" id="meetingList" >
  <!-- <label class="col-sm-12 control-label field-title" for="name">Meetings</label> -->
  <div class="table_section_outer">
    <div class="card">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting">
            <div class="col-sm-12 no-padding table-title">#</div>
          </th>
          <th class="sorting">
            <div class="col-sm-12 no-padding table-title">Quiz Name</div>
          </th>
          <th class="sorting">
            <div class="col-sm-12 no-padding table-title">Course Name</div>
          </th>
          <th class="sorting">
            <div class="col-sm-12 no-padding table-title">Passed</div>
          </th>
          <th class="sorting">
            <div class="col-sm-12 no-padding table-title">Failed</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php /*
        if(!empty($meetings)){
        foreach ($meetings as $key) {
          $end_time = date('Y-m-d H:i:s',strtotime($key->start_time . " +".$key->duration." minutes"));
          $start_time = date('Y-m-d H:i:s',strtotime($key->start_time . " -1 minutes"));

          $datetime1 = new DateTime(date('Y-m-d H:i:s'));
          $datetime2 = new DateTime($key->start_time);
          $inter = $datetime1->diff($datetime2);
          $interval = $inter->format('%h')." Hours ".$inter->format('%i')." Minutes to start";
          $hour_int = $inter->format('%h');
        ?>
        <tr class="camp0">
          <td class="field-title" style="text-transform: capitalize; color: #949494; font-weight: bold; padding-left: 2%"><?php echo ucwords($key->topic); ?></td>
          <td class="field-title" style="color: #949494; text-align:center !important;">Start time: <?php echo date('M d Y, h:i A',strtotime($key->start_time)); ?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;"><?php echo $key->duration; ?> Minutes</td>
          <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;"><?php echo $key->meeting_id;?></td>
          
          <td class="field-title" style=" color: #949494;">
          <?php if(date('Y-m-d',strtotime($key->start_time)) ==  date('Y-m-d')){ 
            if(date('Y-m-d H:i:s') >= $start_time && date('Y-m-d H:i:s') <= $end_time){ ?>
            <a class="btn btn-warning btn-md" href="#" type="button" onclick="return check_zoom('https://zoom.us/wc/<?php echo $key->meeting_id; ?>/start');">Start Meeting</a>
            <a href="<?php echo base_url().'invite/'.$key->meeting_id;?>" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;">Invite Users</a>
           <?php } else if(date('Y-m-d H:i:s') < $start_time){?>
            <a class="btn btn-warning btn-md" href="#" type="button">Wait</a>
            <a href="<?php echo base_url().'invite/'.$key->meeting_id;?>" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;">Invite Users</a><br>
            <span class="interval_span"><?php echo $interval; ?></span>
           <?php } else if(date('Y-m-d H:i:s') > $end_time){ ?>
            <a class="btn btn-warning btn-md" href="#" id="wait" type="button">Finished</a>
           <?php }
          }else if(date('Y-m-d',strtotime($key->start_time)) > date('Y-m-d')){ ?>
          <a class="btn btn-warning btn-md" href="#" type="button">Upcoming</a>
          <a href="<?php echo base_url().'invite/'.$key->meeting_id;?>" style="color: #2d3b92 !important;border-bottom: 1px solid;margin-left: 10px;">Invite Users</a>
          <?php if(intval($hour_int) <= 24){ ?>
          <br><span class="interval_span"><?php echo $interval; ?></span>
          <?php } ?>
          <?php } else if(date('Y-m-d',strtotime($key->start_time)) < date('Y-m-d')){ ?>
          <a class="btn btn-warning btn-md" type="button" href="#" id="wait">Finished</a>
          <?php } ?>
          </td>
        </tr>
        <?php } }else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="6" style="color: #949494; text-align:center !important;">No Meetings Available. <a href="<?php echo base_url('conference-create/create');?>">Create now</a></td>
          </tr>
        <?php } */ ?>
      </tbody>
    </table>
  </div><!-- card -->
  </div>
</div>

<?php /*
if($paying) { ?>     
<div class="row">
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
</div>
<?php }*/ ?>
<script type="text/javascript">
  	$(document).ready(function(){
    	setTimeout(function(){$("#message").html("");},3000);
  	});
</script>