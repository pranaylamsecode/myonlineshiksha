<style>
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: auto;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
<div id="toolbar-box">
  <div class="m">
    <div id="toolbar" class="toolbar-list">
      <ul id="sticky" style="list-style:none; float: right;  display: flex;">
        <li id="toolbar-new" class="listbutton">
          <a href="<?php echo base_url();?>SalesTeam/create-new-order/" class="btn btn-green">
            <span class="icon-32-new"></span><i class="entypo entypo-popup"></i> Create new Order
          </a>
        </li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pagetitle icon-48-generic"><h2>Manage Orders</h2></div>
  </div>
</div>
<div class="col-md-12 col-xs-12 reseller_table_section">
  <div class="col-sm-12 top-head-box no-padding" style="display:inline-block;">
  <label class="control-label field-title pull-left" for="name">Orders List</label>
    <div id="table-3_length">
        <!-- <div class=" col-sm-3">
          <select placeholder="Select Teacher" name="teacherid" id="teacherid" size="1" class="form-control form-height pull-right">
            <option value="">Select Teacher</option>
          </select>
        </div> -->
      <div class="col-sm-offset-7 col-sm-4">
        <a href="<?php echo base_url();?>SalesTeam/orders/" value="Search" class="search-btn pull-right" style="padding-top: 10px;padding-left: 10px;"><span class="lnr lnr-sync" style="color: #666666;font-size: 23px;"></span></a>
        <form method="post" action="<?php echo base_url();?>SalesTeam/orders/">
          <button type="submit" value="Search" name="submit_search" class="search-btn pull-right" style="padding-top: 10px;"><span class="lnr lnr-magnifier" style="color: #666666;font-size: 23px;"></span></button>
          <span class="pull-right">
            <input type="text" value="<?php echo $search_text; ?>" name="search_text" class="form-height form-control" placeholder="users List">
          </span>
        </form> 
      </div>
    </div>
  </div>
  <div class="table_section_outer">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting col-sm-1 col-xs-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Order ID</div>
          </th>
          <th class="sorting col-sm-2 col-xs-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Student Name</div>
          </th>
          <th class="sorting col-sm-3 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Program Name</div>
          </th>
          <th class="sorting col-sm-1 col-xs-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Amount</div>
          </th>
          <th class="sorting col-sm-2 col-xs-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Purchase Date</div>
          </th>
          <th class="sorting col-sm-2 col-xs-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Pay Mode</div>
          </th>
          <th class="sorting col-sm-1 col-xs-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Status</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php
        if(!empty($orders)){
        foreach ($orders as $key) { ?>
        <tr class="camp0">
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= $key->id;?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;">
            <span class="popup" onclick="myFunction(<?= $key->id;?>)">
          <?php echo ucwords($key->first_name." ".$key->last_name);
            $contact_details = '';
            if(!empty($key->mobile)){
              $contact_details = 'Mo. No. &nbsp;'.$key->mobile;
            }else if(!empty($key->email)){
              $contact_details = 'Email &nbsp; '.$key->email;
            }
          ?>
                <span class="popuptext" id="myPopup_<?= $key->id;?>"><?php echo $contact_details;?></span>
            </span>
          </td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= ucwords($key->name);?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= number_format($key->amount_paid,2);?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= date('Y-m-d h:i A',strtotime($key->order_date));?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= ucwords($key->processor);?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= $key->status;?></td>
        </tr>
        <?php } }
        else{ ?>
        <tr class="camp0">
          <td class="field-title" style="color: #949494;padding-left: 20px;" colspan="7">No Orders.</td>
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
<div style="padding-bottom: 60px;"></div>

<script type="text/javascript">
  function myFunction(id) {
      var popup = document.getElementById("myPopup_"+id);
      popup.classList.toggle("show");
  }
  
  function getorders(pay_page,controller,search_text) {
  if(pay_page==0)
  {
    pay_page =1;
  }
    var url = "<?php echo base_url()?>"+controller+"/";
    $.ajax({
      url : url,
      type : "post",
      cache : false,
      data :  {pay_page : pay_page,search_text : search_text},
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