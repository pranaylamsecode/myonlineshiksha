<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
.pagetitle h4 {
    display: none;
}
.form-body{
  margin: 0px 15px 25px 15px !important;
}
.pagetitle i {
    margin-left: 10px;
    position: relative;
    top: 1px;
    cursor: pointer;
}
.pagetitle i:hover{
  color: #444;
}
.page-container .main-content {
    padding: 10px 30px 68px 30px !important;
}
.generate_coupon_btn{
  display: inline-block;
  float: left !important;
  margin-bottom: 25px;
  width: auto;
}
.generate_coupon_btn_box{
  display: inline-block;
  width: 100%;
  padding-left: 15px;
}
.reseller_table_section {
    display: inline-block;
}
.pagetitle{
  margin-bottom: 25px;
}
.form-body {
    border: 1px solid #ebebeb!important;
    border-radius: 2px!important;
    padding: 25px 15px 40px 15px!important;
    margin: 0px 0px 25px 0px;
}
/*.form-body.collapse {
    display: inline-block;
}*/
@media (max-width: 991px){
  .form-body {
    margin: 15px 0px 25px 0px !important;
}
  footer.main {
    padding: 20px 15px 20px 10px !important;
    width: 100%;
    left: 0px;
}
.generate_coupon_btn {
    display: inline-block;
    float: left !important;
    margin-bottom: 0px;
    width: auto;
}
.generate_coupon_btn_box {
    display: inline-block;
    width: 100%;
    padding-left: 0px;
    margin-bottom: 10px;
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
body .form-body {
    border: 1px solid #ebebeb!important;
    border-radius: 2px!important;
    padding: 25px 0px 40px 0px!important;
    width: 100%;
}

.panel-body.form-body .col-md-8, .panel-body.form-body .col-md-4, .panel-body.form-body .col-sm-12 {
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
.reseller_table_section button {
    display: inline-block;
    float: left !important;
    margin-bottom: 25px;
    width: auto;
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
#course_id option{
  content: "\20B9";
}

#message123 {
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

<?php //if(!empty($msg)){ 
      $msg ="";
      $msg = $this->session->userdata('reg_msg');
      $this->session->unset_userdata('reg_msg');
      if($msg != ''){
  ?>
    <span id="message123">
      <div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"></i> </a> <strong class="fa fa-check" aria-hidden="true"> </strong> <?php echo $msg; ?> </div>
    </span>

<?php } ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="col-sm-12 col-xs-12 pagetitle icon-48-generic">
	<h2>Coupons<i class="fas fa-info-circle"></i></h2>
	<h4>Generate a coupon code to sell the courses in cash.
You will have to pay the amount collected (minus commission) to MyOnlineShiksha, once the coupon code gets redeemed (used by your customer).
<h4>
Online Courses को नकद में बेचने के लिए एक कूपन कोड बनाएं।
कूपन कोड Redeem(ग्राहक द्वारा उपयोग) हो जाने के बाद, आपको एकत्र की गई यह राशि (माइनस आपका कमीशन) MyOnlineShiksha को भुगतान करना होगा।
</h4></h4>
</div>
<div class="generate_coupon_btn_box">
  <form method="post" action="<?php echo base_url(); ?>reseller_Settlements/create_coupon" target="_blank">
      <strong style="font-size: 20px; color: #373e4a;padding-right: 20px;">Generate New Coupon Code</strong>
      <button class="btn btn-success btn-md control-label" type="submit" style="font-size: 18px;height: auto;"> Generate Coupon </button>
  </form>
</div>
<!-- pay_history -->
<!-- <div class="panel-body form-body">
   <div class="form-group form-border"> -->
<div class="col-md-12 col-xs-12 reseller_table_section">
   <label class="col-sm-12 col-xs-12 control-label field-title">List of Coupons Generated
   </label>

   <div class="table_section_outer">
     <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
        <thead>
           <tr role="row">
              <th class="sorting col-md-2 col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
                 <div class="col-sm-12 no-padding table-title">Coupon Code</div>
              </th>
              <th class="sorting col-md-2 col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
                 <div class="col-sm-12 no-padding table-title">Customer Name</div>
              </th>
              <th class="sorting col-md-2 col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
                 <div class="col-sm-12 no-padding table-title">Course Name</div>
              </th>
              <th class="sorting col-md-2 col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
                 <div class="col-sm-12 no-padding table-title">Amount (<i class='fa fa-inr'></i>)</div>
              </th>
              <th class="sorting col-md-2 col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
                 <div class="col-sm-12 no-padding table-title">Creation Date</div>
              </th>
              <th class="sorting col-md-2 col-sm-2 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
                 <div class="col-sm-12 no-padding table-title">Status ( Unused / Redeemed on)</div>
              </th>
           </tr>
        </thead>
        <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
           <?php
            if(!empty($coupons)){
            foreach ($coupons as $key) {
             // $getstud = $this->Crud_model->get_single('mlms_users',"id ='".$key->student_id."'");
             if(!empty($key->course_id) || $key->course_id != '')
              {
                $getcourse = $this->Crud_model->get_single('mlms_program',"id ='".$key->course_id."'",'name,fixedrate');
                $course_name = ucfirst($getcourse->name);
                $fixedrate = $getcourse->fixedrate;
              }
              else{
                $course_name = "-";
                $fixedrate = 0;
              }
             
            if(!empty($key->student_name) || $key->student_name !='')
            {
              if(is_numeric($key->student_name))
              {
                $std_data = $this->Crud_model->get_single('mlms_users',"id = ".$key->student_name,'first_name,last_name');
                if(!empty($std_data))
                {
                  if(!empty($std_data->last_name)){
                    $student_name = $std_data->first_name.' '.$std_data->last_name;
                  }  
                  else{
                    $student_name = $std_data->first_name;
                  }
                }
                else{
                  $student_name = "-";  
                }
              }
              else{
                $student_name = $key->student_name;
              }
            }
            else
            {
              $student_name = "-";
            }

             if($key->status=='Redeemed')
                $status = $key->status." on ".date('d-m-Y h:i A',strtotime($key->modified));
             else
                $status = $key->status;
           ?>
           <tr class="camp0">
              <td class="field-title" style="color: #949494; text-align:center !important;"><?php echo $key->coupon_code;?></td>
              <td class="field-title" style="text-transform: capitalize; color: #949494; text-align:center !important;"><?php echo $student_name;?></td>
              <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;"><?php echo $course_name;?></td>
              <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;"><i class='fa fa-inr'></i> <?php echo number_format($fixedrate,2);?></td>
              <td class="field-title" style="text-transform: capitalize;color: #949494; text-align:center !important;"><?php echo date('d-m-Y h:i A',strtotime($key->created));?></td>
              <td class="field-title" style="text-transform: capitalize; color: #949494; text-align:center !important;"><?php echo $status; ?></td>
           </tr>
           <?php } }else{ ?>
            <tr class="camp0">
              <td colspan="6" style="padding-left: 20px;">No data found.</td>
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

<script type="text/javascript" src="<?= base_url();?>assets/js/custom_js/common.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/custom_js/coupons.js"></script>
<script>
  setTimeout(function(){$("#message123").html("");},100);
  jQuery(document).ready(function(){
    jQuery('.pagetitle i').click(function() {
        jQuery('.pagetitle h4').slideToggle();
      });
  });


jQuery( "div.generate_coupon_btn_box form button" ).click(function() {
    setTimeout(function(){location.reload(true);},3000);
});
</script>