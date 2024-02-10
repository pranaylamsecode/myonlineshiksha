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
.field-title .btn-success{
    background-color: #11ca15 !important;
    border-color: #11ca15 !important;
}
.field-title .btn-warning{
    background-color: #fbaf24 !important;
    border-color: #fbaf24 !important;
}
.field-title .btn{
    border-radius: 20px !important;
    font-weight: bold;
    /*width: 50%;*/
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
</style>
<div class="main-container">
<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic"><h2>TCS Internships Orders List</h2>
    <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
     
    </div>
    
    </div>
  </div>
</div>
<div class="reseller_table_section" id="meetingList" >
  <!-- <label class="col-sm-12 control-label field-title" for="name">Meetings</label> -->
  <div class="table_section_outer">
    <div class="card">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th>
            <div class="col-sm-12 no-padding table-title">#</div>
          </th>
          <th>
            <div class="col-sm-12 no-padding table-title">Course Name</div>
          </th>
          <th>
            <div class="col-sm-12 no-padding table-title">Applicants Name</div>
          </th>
          <th>
            <div class="col-sm-12 no-padding table-title">Contact No.</div>
          </th>
          <th>
            <div class="col-sm-12 no-padding table-title">Amount</div>
          </th>
          <th>
            <div class="col-sm-12 no-padding table-title">Date</div>
          </th>
          <th>
            <div class="col-sm-12 no-padding table-title">Status</div>
          </th>
          <th>
            <div class="col-sm-12 no-padding table-title">Options</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php 
        if(!empty($orders)){
          $i = 1;
          foreach ($orders as $key){
          ?>
        <tr class="camp0">
          <td class="field-title"><?php echo $i++; ?></td>
          <td class="field-title">
            <?php echo $key->course_name; ?>
          </td>
          <td class="field-title">
            <?php echo ucwords($key->full_name).'<br>( '.$key->email." )";?>
          </td>
          <td class="field-title">
            <?php echo $key->contact_no;?>
          </td>
          <td class="field-title">
           <i class="fa fa-inr"></i> <?php echo number_format($key->amount,2);?>
          </td>
          <td class="field-title"><?php echo date('d M Y h:i A',strtotime($key->created));?></td>
          <td class="field-title">
            <?php echo $key->status;?>
          </td>
          <td class="field-title active-<?php echo $key->id;?>">
            <?php if($key->status == 'SUCCESS'){
              if(!empty($key->activation_code)){
                echo $key->activation_code;
              }else{
            ?>
            <a href="javascript:void(0)" class="btn btn-green" onclick="return open_popup(<?php echo $key->id; ?>)">
              <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Activate
            </a>
            <?php } }else{ echo 'N/A'; } ?>
          </td>
        </tr>
        <?php } } else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="8" >No Data Available.</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
 <!--  </div>
</div> -->

<div class="row pagination">
<?php 
if($paying) { ?>     
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
<?php } ?>
</div><!-- card -->
</div>
</div>
 </div>
</div>

<div class="popup_overlay" style="display: none;" onclick="return close_popup();"></div>
<div class="new_course_popup" style="display: none;">
    <div class="new_course_popup_header">
        <span class="popup_heading" style="color: #fad839;font-weight: bold;">Activate Account</span>
        <span class="lnr lnr-cross cross_icon" onclick="return close_popup();"></span>
    </div>
    <div class="new_course_select_sec">
      <div class="col-sm-12 form-group">
        <label class="field-title">Activation Code <span id="code_err" style="color: red;"></span></label>
        <input type="text" id="activation_code" class="form-control form-height">
        <input type="hidden" id="order_id">
      </div>
      <div class="col-sm-12 form-group">
        <a class="btn btn-info pull-right next-link" onclick="return add_activation()"> Save </a>
      </div>
    </div>
</div>

<script type="text/javascript">
  function open_popup(id){
      $("#order_id").val(id);
      $('.popup_overlay').show();
      $('.new_course_popup').show();
  }
  function close_popup(){
      $("#order_id").val('');
      $('.new_course_popup').hide();
      $('.popup_overlay').hide();
  }
  function add_activation(){
    var activation_code = $("#activation_code").val().trim();
    var order_id = $("#order_id").val().trim();
    if(activation_code =="")
    {
        $("#code_err").fadeIn().html("Please enter Activation Code").css('color','red');
        setTimeout(function(){$("#code_err").html("");},3000);
        $("#user_email").focus();
        return false;
    }
    $(".next-link").html('wait... <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>').removeAttr('onclick');
    $.ajax({
      type : "post",
      cache: false,
      url : "<?php echo base_url();?>admin/tcs_orders/activate/",
      data : {activation_code : activation_code, order_id : order_id},
      success : function(response){
        $(".active-"+order_id).html(activation_code);
        $(".next-link").html('Save').attr('onclick',"return add_activation()");
        $("#code_err").fadeIn().html("Activation Code added.").css('color','green');
        $("#activation_code").val('');
        setTimeout(function(){
          close_popup();
        },1500);
      }
    });
  }
</script>