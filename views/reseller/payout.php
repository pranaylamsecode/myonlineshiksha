<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.page-container .main-content {
    padding: 10px 30px 68px 30px !important;
}
.pagetitle{
  margin-bottom: 25px;
}
.form-body{
  margin: 0px 15px 25px 15px !important;
  padding-top: 10px;
}
@media (max-width: 991px){
  footer.main {
    padding: 20px 15px 20px 10px !important;
    width: 100%;
    left: 0px;
}
  .reseller_table_section .control-label.field-title {
    padding: 15px 0px 10px 0px;
    font-size: 20px !important;
}
.pagetitle {
    padding: 15px 0px 15px 0px;
    margin-bottom: 0px;
}
.pagetitle h2 {
    margin: 0px 0px 15px 0px !important;
    font-size: 26px;
}
.pagetitle h4 {
    font-size: 16px;
    line-height: 1.5em;
}
.page-container .form-body {
    border: 1px solid #ebebeb !important;
    border-radius: 2px!important;
    padding: 25px 0px 40px 0px!important;
    margin: 0px 0px 25px 0px !important;
}
.page-container .form-body .col-md-8, .page-container .form-body .col-md-4, .form-body .col-sm-12 {
    padding: 0px !important;
}
  .main-content .admin_header {
    padding: 3px 0px 13px 0px !important;
    margin-left: -15px !important;
    margin-right: -15px !important;
  }
  .page-container #sidemenu.sidebar-menu .logo-env {
    padding: 10px 10px 10px 10px !important;
    display: flex;
}
  .sidebar-collapsed .sidebar-menu .sidebar-collapse-icon span.lnr{
    margin-right: 3px !important;
    color: #333 !important;
    font-size: 30px;
  }
   .page-container .main-content {
    padding: 10px 15px 68px 15px !important;
    left: 0px !important;
  }
  .reseller_table_section {
    padding: 0px;
    margin-bottom: 40px;
  }
  .reseller_table_section table{
    width: 100%;
  }
  .table_section_outer{
     overflow-x: auto; 
  }
  .open_mobile_sidebar{
    display: inline-block !important;
    position: absolute;
    left: 10px;
    top: 5px;
  }
  .close_mobile_sidebar {
    display: inline-block !important;
    position: unset;
    text-align: right;
    width: 15%;
    order: 3;
}
.page-body .page-container .sidebar-menu .logo-env > div.logo {
    width: 70% !important;
    order: 2;
    text-align: center;
    display: inline-block !important;
}
.page-body .page-container .sidebar-menu .logo-env > div.logo img {
    margin: 0px !important;
    width: auto !important;
    max-width: 100% !important;
    max-height: 60px !important;
    padding: 0px;
    height: auto !important;
}
.close_mobile_sidebar span {
    font-size: 25px;
    color: #5a5a5a;
}
body .page-container #sidemenu.sidebar-menu.sidebar-menu.sidemenu_mobile .home_link {
    order: 1;
    text-align: left;
    display: flex;
    width: 15%;
}


body .page-container #sidemenu.sidebar-menu.sidebar-menu.sidemenu_mobile .home_link img {
    width: auto;
    height: auto;
}
  body .page-container #sidemenu.sidebar-menu.sidebar-menu{
    position: fixed !important;
    left: -280px !important;
    z-index: 9999 !important;
    height: 100vh;
    width: 280px !important;
     transition: 0.5s;
  }
  .page-body .page-container .sidebar-menu li .list_text {
    display: inline-block !important;
}
.page-container .sidebar-menu #main-menu li ul {
    visibility: visible !important;
    height: auto !important;
}
  .fix_logo_btm {
    display: none !important;
}
  .page-container{
    padding-left: 0px !important;
  }
  body .page-container #sidemenu.sidebar-menu.sidebar-menu.sidemenu_mobile{
      left: 0px !important;
    height: 100vh;
    top: 0px !important;
    overflow: auto;
   
}

}
h3 i{
	font-size: 19px !important;
}
h2 i{
	font-size: 22px !important;
}
h4 i{
	font-size: 15px !important;
}
</style>
<style type="text/css">
  .disabled {cursor:not-allowed;color: #bccfd8;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="col-sm-12 col-xs-12 pagetitle icon-48-generic">
	<h2>Settlements</h2>
	<!-- <h4>Create your referral link here : </h4> -->
</div>
<div class="form-body">
   <div class="form-group form-border">
      <div class="col-md-3 col-xs-12">
          <h4>TOTAL COMMISSION EARNED</h4>
          <h3 class="text-info"><i class="fa fa-inr"></i> <?= number_format($payouts->total_amount,2); ?></h3>
      </div>
      <div class="col-md-3 col-xs-12">
          <h4>AMOUNT SETTLED</h4>
          <h3 class="text-success"><i class="fa fa-inr"></i> <?= number_format($payouts->paid_amount,2); ?></h3>
      </div>
      <div class="col-md-3 col-xs-12">
          <h4>AMOUNT PENDING</h4>
          <h2 class="text-danger"><i class="fa fa-inr"></i> <?= number_format($payouts->balance_amount,2); ?></h2>
      </div>
      <div class="col-md-3 col-xs-12">
          <h4>AMOUNT TO BE PAID</h4>
          <h2 class="text-warning"><i class="fa fa-inr"></i> <?= number_format($paying_amount,2); ?></h2>
      </div>
      <div class="col-md-12 col-xs-12">
          <h4>Settlement will not be processed until they exceed &nbsp;<i class="fa fa-inr"></i> <b>100</b>.</h4>
          <h4>Your Paypal account associated is <span class="text-info"><b><?= $upi_id; ?></b></span>.</h4>
      </div>
   </div>
</div>
<!-- pay_history -->

<!-- <div class="panel-body form-body">
   <div class="form-group form-border"> -->
<div class="col-md-12 col-xs-12 reseller_table_section">
  <label class="col-sm-12 control-label field-title" for="name">Settlement History</label>
  <div class="table_section_outer">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Settlement Date</div>
          </th>
          <th class="sorting col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Amount Received</div>
          </th>
          <th class="sorting col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Payment mode</div>
          </th>
          <th class="sorting col-sm-6 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Remarks</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php
        if(!empty($pay_history)){
        foreach ($pay_history as $key) { ?>
        <tr class="camp0">
          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?= date('d-m-Y h:i A',strtotime($key->paid_date));?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><i class="fa fa-inr"></i> <?= $key->paid_amount;?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?= $key->pay_mode;?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php if(!empty($key->memo)){echo $key->memo;}else{ echo "---";} ?></td>
        </tr>
        <?php } }
        else{ ?>
        <tr class="camp0">
          <td class="field-title" style="color: #949494;padding-left: 20px;" colspan="4">No Payment made.</td>
        </tr>
         <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php 
if($paying) { ?>     
<div class="row">
   <div class="col-xs-6 col-left">
      <div class="dataTables_info" id="table-3_info">Showing <?php echo $firstp;?> to <?php echo $startp; ?> of <?php echo $count_payout; ?> entries</div>
   </div>
    <div class="col-xs-6 col-right">
       <div class="dataTables_paginate paging_bootstrap">
          <ul class="pagination pagination-sm" id="ajax_payout">
            <?php echo $paying; ?>
          </ul> 
       </div>
    </div>
</div>
<?php } ?>
<!-- 
</div>
</div> -->

<script type="text/javascript">
/*function getpayout(pay_page) {
  if(pay_page==0)
  {
    pay_page =1;
  }
  var uid = $("#reseller_id").val().trim();
    var url = "<?php echo base_url()?>reseller_Settlements/index/";
    $.ajax({
      url : url,
      type : "post",
      cache : false,
      data :  {pay_page : pay_page},
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
     
}*/
</script>