<?php $auth = $this->session->userdata('logged_in');
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.page-container .main-content {
    padding: 10px 30px 68px 30px !important;
}
.panel-body.form-body {
     margin: 0px 15px 40px 15px !important;
}
.pagetitle{
  margin-bottom: 25px;
}
.pagetitle h4 {
    display: none;
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
.panel-body.form-body {
    border: 1px solid #ebebeb!important;
    border-radius: 2px!important;
    padding: 25px 15px 40px 15px!important;
    margin: 0px 0px 25px 0px !important;
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
    padding: 10px 15px 58px 15px !important;
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

</style>
<!-- <script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-1e770d86-c971-4cf5-960c-9a2aef38b6ef"></div> -->
<!-- <div class="col-sm-12 pagetitle icon-48-generic">
	<h2>Your Sales</h2>
	<h4>Share your Reseller Link or QR Code in Facebook, WhatsApp, Email, etc to increase your earnings. When someone clicks the Reseller Link or Scans your QR Code and purchases any online courses then you will receive your commission.
<br>
<h4>अपनी कमाई बढ़ाने के लिए Facebook, WhatsApp, Email इत्यादि में अपने Reseller Link या QR Code को शेयर करें।
जब भी कोई आपकी Reseller Link को क्लिक करके या QR Code Scan करके Online Courses खरीदेगा तो आप कमीशन प्राप्त करेंगे। </h4></h4>
</div> -->

<div class="col-sm-12 col-xs-12 pagetitle icon-48-generic">
  <h2>Your Sales <i class="fas fa-info-circle"></i></h2>
  <h4>Share your Reseller Link or QR Code in Facebook, WhatsApp, Email, etc to increase your earnings. When someone clicks the Reseller Link or Scans your QR Code and purchases any online courses then you will receive your commission.
<br>
<h4>अपनी कमाई बढ़ाने के लिए Facebook, WhatsApp, Email इत्यादि में अपने Reseller Link या QR Code को शेयर करें।
जब भी कोई आपकी Reseller Link को क्लिक करके या QR Code Scan करके Online Courses खरीदेगा तो आप कमीशन प्राप्त करेंगे। </h4></h4>
</div>

<div class="panel-body form-body">
   <div class="form-group form-border">
      <div class="col-md-8">
        <label class="col-sm-12 control-label field-title" for="name">Your Reseller Link</label>
      <div class="col-sm-12">
         <input type="text" class="form-control form-height" id="share_link" value="<?php if(!empty($url)){echo $url;}?>" name="search" readonly>
         <span class="error"></span>
      </div>
      <div class="col-sm-12">
        <button class='btn btn-default' id="copybtn" type="button" style="<?php if(!empty($referral_code)) { ?>display:block;<?php }else{ ?>display:none;<?php }?>">
        <span class="icon-32-cancel"> </span>copy link</button> 
        
        <a type="button" id="refbtn" onclick="return generate()" style="<?php if(!empty($referral_code)) { ?>display:none;<?php }?>" class="btn btn-success btn-border-blue">Generate Referrals code</a>
        <span class="error" id="reff_err"></span>
        <?php if($auth['groupid']=='5'){ ?>
        <h4>Your reseller commission payout is &nbsp;<b><?php echo $commission; ?>%</b>&nbsp; share for the sales of courses at Myonlineshiksha.com.</h4>
        <?php }else if($auth['groupid']=='2'){ ?>
        <h4>Your commissions for self-created courses are <b>50%</b> of the course selling price and</h4>
            <h4>for other courses commissions are <b><?php echo $commission; ?>%</b> of the course selling price.</h4>
        <?php } ?>
      </div>
      </div>
      <div class="col-md-4">
        <div class="">
          <img src="<?php echo base_url();?>public/uploads/resellers_QR/<?php if(!empty($qr_image)){echo $qr_image;}else{ echo 'no_image.gif';}?>" width="111px" height="111px" name="qr_image" id="qr_image"/>
        </div>
        <div class="edit_course_image_btn">
        
          <!-- <label for="image" class="col-sm-12 field-title">Print QR-code</label>   19a2sm0f-Qrcode9762.png -->
        <!-- <?php //} else { ?> -->
          <a type="button" id="qrbtn" onclick="return generateQR()" style="<?php if(!empty($qr_image)){ ?>display:none;<?php } ?>" class="btn btn-success btn-border-blue">Generate QR-code</a>
          <a id="anchor_print" href="<?= base_url()?>refer_course/print_qr/<?php echo $qr_image;?>" target="_blank"><button class="btn btn-success btn-border-blue" style="<?php if(!empty($qr_image)){ ?>display: block;<?php }else{ ?> display: none;<?php } ?>" id="qrlabel" >Print QR-code</button></a>
        <?php //} ?>
        </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="item-item col-md-3 col-sm-3 col-xs-8 res_col">
      <div class="panel-body form-body">
         <a href="#">
            <div class="cardhover">
               <label class="col-sm-12 control-label field-title">Sales</label>
               <br>
               <label class="col-sm-12 control-label field-title"><?php print_r($success_count); ?></label>
            </div>
         </a>
      </div>
   </div>
   <div class="item-item col-md-3 col-sm-3 col-xs-8 res_col">
      <div class="panel-body form-body">
         <a href="#">
            <div class="cardhover">
               <label class="col-sm-12 control-label field-title">Pending Sales</label>
               <br>
               <label class="col-sm-12 control-label field-title"><?php print_r($pending_count); ?></label>
            </div>
         </a>
      </div>
   </div>
   <div class="item-item col-md-3 col-sm-3 col-xs-8 res_col">
      <div class="panel-body form-body">
         <a href="#">
            <div class="cardhover">
               <label class="col-sm-12 control-label field-title">Failed Sales</label>
               <br>
               <label class="col-sm-12 control-label field-title"><?php print_r($failure_count); ?></label>
            </div>
         </a>
      </div>
   </div>
  <?php if($auth['id'] == 341){
  if($ass_type == '1'){ 
  ?>
  <a href="<?php echo base_url('partner/sub-resellers-orders/'.$auth['id']);?>/2/" target="_blank">
    <div class="item-item col-md-3 col-sm-3 col-xs-8 res_col">
      <div class="panel-body form-body">
            <div class="cardhover">
               <label class="col-sm-12 control-label field-title">Sub-Resellers Sales</label>
               <br>
               <label class="col-sm-12 control-label field-title"><?php print_r($sub_resale_count); ?></label>
            </div>
      </div>
    </div>
    </a>
 <?php } } ?>
</div>

<script type="text/javascript">
   
document.getElementById("copybtn").addEventListener("click", function(){
  var copyText = document.getElementById("share_link");
  copyText.select();
  document.execCommand("Copy");
});

function generateQR()
{
  $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo base_url();?>refer_course/generate_QR",
        data:{
          // url : url
        },
        success:function(returndata)
        {
          
          if(returndata!=0)
          {
            $("#qr_image").attr('src','<?php echo base_url();?>public/uploads/resellers_QR/'+returndata);
            $("#qrlabel").css('display','block');
            $("#qrbtn").css('display','none');
            $("#anchor_print").removeAttr('href');     
            $("#anchor_print").attr('href',"<?php echo base_url('refer_course/print_qr/')?>"+returndata);
          }
          else{
            $("#reff_err").fadeIn().html(" Please generate Referral Code first.").css('color', 'red');
            setTimeout(function () { $("#reff_err").html(""); }, 3000);
            return false;
          }
        }
  });
}

function generate()
{
  $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo base_url();?>refer_course/generate",
        data:{ },
        success:function(returndata)
        {
            $("#share_link").val(returndata);
            $("#copybtn").css('display',"block");
            $("#refbtn").css('display',"none");
        }
  });
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <div class="panel-body form-body">
   <div class="form-group form-border"> -->
<div class="col-md-12 col-xs-12 reseller_table_section">
  <label class="col-sm-12 control-label field-title" for="name"> List of Orders</label>
  <div class="table_section_outer">
  <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
    <thead>
      <tr role="row">
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Order ID</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Student Name</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Course Name</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Amount (<i class="fa fa-inr"></i>)</div>
        </th>
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Commission Earned (<i class="fa fa-inr"></i>)</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Purchase Date</div>
        </th>
        <?php if($auth['groupid']!='5'){ ?>
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Course Created by</div>
        </th>
        <?php } ?>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Payment Mode</div>
        </th>
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Status</div>
        </th>
      </tr>
    </thead>
    <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
      <?php 
        if(!empty($ref_data)){
          // print_r($ref_data);exit();
        foreach ($ref_data as $key) {
          if($auth['groupid']!='5'){
            $con1 = "id =".$key->userid;
            $getcustomer = $this->Crud_model->get_single('mlms_users',$con1,'first_name,last_name');
            if(!empty($getcustomer->last_name)){ $uname = $getcustomer->first_name." ".$getcustomer->last_name;} else{ $uname = $getcustomer->first_name;}
          }
          else
          {
            if(!empty($key->last_name)){ $uname = $key->first_name." ".$key->last_name;} else{ $uname = $key->first_name;}
          }
      ?>
      <tr class="camp0">
        <td class="field-title" style="text-transform: capitalize;text-align:center!important;"><?php echo $key->id; ?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $uname;?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->name; ?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><i class="fa fa-inr"></i> <?php echo number_format($key->amount_paid,2); ?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><i class="fa fa-inr"></i> 
          <?php
          if($key->status=="SUCCESS"){
            $get_comm = $this->Crud_model->get_single('mlms_commission_log',"reseller_id =".$auth['id']." AND order_id =".$key->id,"commission,comm_percent");
            $comm = $get_comm->commission;
            if($comm!=0)
              $com_per = " (@".$get_comm->comm_percent."%)";
            else
              $com_per = "";
            echo number_format($comm,2).$com_per;
          }
          else{
            echo ' 0.00';
          }
          ?>
        </td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo date("d-m-Y h:i A",strtotime($key->order_date)); ?></td>
        <?php if($auth['groupid']!='5'){ ?>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php if(!empty($key->referred_code)){
          if($auth['referral_code']==$key->referred_code){echo "Self";}else{echo "Others";}} else{ echo "Self";} ?></td>
        <?php } ?>
        
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo  str_replace("payumoney", "payumoney<br>",$key->processor);  ?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->status; ?></td>
      </tr>
      <?php } }else{ ?>
      <tr class="camp0">
        <td class="field-title" colspan="9">No Orders found!</td>
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
<script>
  jQuery(document).ready(function(){
    jQuery('.pagetitle i').click(function() {
        jQuery('.pagetitle h4').slideToggle();
      });
  });
</script>