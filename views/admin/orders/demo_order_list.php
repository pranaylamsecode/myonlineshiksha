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
#ajax_payout{
  margin: 0;
  float: right;
}
.camp0 td{
  color: #949494;
  text-align: center !important;
}
</style>
<div id="toolbar-box">
  <div class="m">
    <!-- <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
      <div class="clr"></div>
    </div> -->
    <div class="col-sm-8 pagetitle icon-48-generic"><h2>Enrolled Students</h2></div>
    <?php if($groupid == 4){ ?>
    <div class="col-sm-4 top-head-box" style="padding-top: 15px;">
      <span style="margin-right: 15px;">
        <label class="select_course_category">
          <select id="teacher_id" class="form-control form-height" style="color: #ACACAC" onchange="return get_payout(1,'enrolled-users')">
              <option value="">select Teacher</option>
              <?php
              foreach ($teachers as $key){ ?>
              <option value="<?php echo $key->id;?>"><?php if(!empty($key->first_name)){echo ucwords($key->first_name.' '.$key->last_name);}else{echo ucfirst($key->name);}?></option>
              <?php } ?>
          </select>
        </label>
      </span>
    </div>
    <?php }else{ ?>
      <input type="hidden" id="teacher_id">
    <?php } ?>
  </div>
</div>
<div class="col-md-12 col-xs-12 reseller_table_section" id="meetingList">
  <!-- <label class="col-sm-12 control-label field-title" for="name">Meetings</label> -->
  <div class="table_section_outer">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">#</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Student Name</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Course Name</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Batch Name</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Teacher Name</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Date</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;width: 8%;">
            <div class="col-sm-12 no-padding table-title">Enrolment Type</div>
          </th>
          <th class="sorting" style="text-align: center;font-weight: bold;">
            <div class="col-sm-12 no-padding table-title">Options</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php 
        if(!empty($enrolled_users)){
          $i = 1;
          foreach ($enrolled_users as $key) {
            $batch_name = 'N/A';
            if(!empty($key->batch_id)){
              $batch = $this->Crud_model->get_single('mlms_batches',"id = ".$key->batch_id,"batch_name");
              $batch_name = ucwords($batch->batch_name);
            }
            $criteria = $key->criteria;
            if($key->criteria == 'paid')
              $criteria = "subscribed";
          ?>
        <tr class="camp0">
          <td class="field-title" style="font-weight: bold;"><?php echo $i++;?></td>
          <td class="field-title"><?php if(!empty($key->first_name)){echo ucwords($key->first_name.' '.$key->last_name); }else{ echo ucwords($key->name);} ?></td>
          <td class="field-title"><?php echo ucwords($key->course_name); ?></td>
          <td class="field-title"><?php echo $batch_name; ?></td>
          <td class="field-title"><?php if(!empty($key->t_fname)){echo ucwords($key->t_fname.' '.$key->t_lname); }else{ echo ucwords($key->t_name);} ?></td>
          <td class="field-title"><?php echo date('Y-m-d h:i A',strtotime($key->buy_date));?></td>
          <td class="field-title"><?php echo ucwords($criteria); ?></td>
          <td class="field-title">
            <a class="col-sm-4" href="<?php echo base_url().'admin/orders/edit_enrolled/'.$key->id;?>">
              <div class="sprite 2edit" style="background-position: -32px 0;" title="Update Enrollment"></div>
            </a>
          </td>
        </tr>
        <?php } }else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="7">No users enrolled. </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php
if($paying) { ?>     
<div class="row" style="margin-bottom: 70px;">
   <div class="col-xs-6">
      <div class="dataTables_info" id="table-3_info">Showing <?php echo $firstp;?> to <?php echo $startp; ?> of <?php echo $total_payout; ?> entries</div>
   </div>
    <div class="col-xs-6">
       <div class="dataTables_paginate paging_bootstrap">
          <ul class="pagination pagination-sm" id="ajax_payout">
            <?php echo $paying; ?>
          </ul> 
       </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
  jQuery(document).ready(function(){
    setTimeout(function(){jQuery("#message").html("");},3000);
  });
  function get_payout(pay_page,controller) {
    var teacher_id = $("#teacher_id").val().trim();
    if(pay_page==0)
    {
      pay_page =1;
    }
    var url = "<?php echo base_url()?>"+controller+"/";
    $.ajax({
      url : url,
      type : "post",
      cache : false,
      data :  {pay_page : pay_page, teacher_id : teacher_id},
      // beforeSend: function(){$("#overlay").show();},
      success: function(data){
          var obj = $.parseJSON(data);
          $('#payout_content').html(obj.payoutdata);
          $('#ajax_payout').html(obj.paying);
          $("#table-3_info").html("Showing "+obj.firstp+" to "+obj.startp+" of "+obj.total_payout+" entries");
      },
      error: function() 
      {}          
     });
  }
</script>