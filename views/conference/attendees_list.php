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
</style>
<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic">
      <span style="font-size: 18px"><?php echo count($events);if(count($events)<=1) echo ' Student ';else echo ' Students ';?> attended lecture - 
        <span style="font-size: 20px;font-weight: bold;"><?php echo ucwords($topic);?></span>
      </span>
      <h5>Date : <?php echo $lect_date;?></h5>
    </div>
  </div>
</div>
<div class="col-md-12 col-xs-12 reseller_table_section" id="meetingList" style="padding-top: 30px; ">
  <div class="table_section_outer">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting" style="text-align: center;font-weight: bold;width: 10%;">
            <div class="col-sm-12 no-padding table-title">Sr.No.</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Student Name</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Attended Date & Time</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php 
        $i = 1;
        if(!empty($events)){
          foreach ($events as $key) {
            if(!empty($key->first_name))
              $name = ucwords($key->first_name.' '.$key->last_name);
            else
              $name = ucwords($key->name);
          ?>
        <tr class="camp0">
          <td class="field-title" style="text-transform: capitalize; color: #949494; font-weight: bold; padding-left: 2%"><?php echo $i;?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;"><?php echo $name;?></td>
          <td class="field-title" style="color: #949494; text-align:center !important;"><?php echo date('M d Y, h:i A',strtotime($key->created));?></td>
          
        </td>
        </tr>
        <?php } }else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="6" style="color: #949494; text-align:center !important;">No User attended this lecture.</td>
          </tr>
        <?php }  ?>
      </tbody>
    </table>
  </div>
</div>