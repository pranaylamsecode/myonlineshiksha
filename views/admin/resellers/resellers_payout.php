<style>
/*.link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}*/
.disabled {cursor:not-allowed;color: #bccfd8;}
/*.current {background: #bccfd8;}*/
/*.first{border-left:#bccfd8 1px solid;}*/
/*.question {font-weight:bold;}*/
/*.answer{padding-top: 10px;}*/
/*#pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}*/
/*.dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}*/
/*.page-content {padding: 20px;margin: 0 auto;}*/
/*.pagination-setting {padding:10px; margin:5px 0px 10px;border:#bccfd8  1px solid;color:#607d8b;}*/
#message {
    position: fixed; 
    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
    border-radius: 5px;
}
</style>

<span id="message"></span>
<div class="panel-heading">
   <div class="panel-title mb_20" style="padding: 0;width:100%;">
      <h2 class="tab_heading"><?= $type; ?> Payouts</h2>
      <p>Manage the <?= $type; ?>s Payout</p>
   </div>
</div>

   <div class="form-group form-border">
      <div class="row">
          <div class="col-md-3 col-xs-12">
              <h4 style="font-size: 15px !important;">TOTAL SALES</h4>
              <h3 class="text-info" style="font-size: 21px !important; color: #2c7ea1 !important">&#8377; <?= number_format($total_payout->total_amount,2); ?></h3>
          </div>
          <div class="col-md-3 col-xs-12">
              <h4 style="font-size: 15px !important;">AMOUNT SETTLED</h4>
              <h3 id="comm_h3" class="text-success" style="font-size: 21px !important; color: #045702 !important">&#8377; <?= number_format($total_payout->paid_amount,2); ?></h3>
          </div>
          <div class="col-md-3 col-xs-12">
              <h4 style="font-size: 15px !important;">AMOUNT PENDING</h4>
              <h2 id="comm_h2" class="text-danger" style="font-size: 25px !important; color: #ac1818 !important">&#8377; <?= number_format($total_payout->balance_amount,2); ?></h2>
              <?php if(floatval($total_payout->balance_amount) != 0 || floatval($total_payout->balance_amount) != '0.00' || floatval($total_payout->balance_amount) != ''){ ?>
              <button class="btn btn-info btn-md" type="button" data-toggle="collapse" data-target="#online_div" aria-expanded="false" aria-controls="collapseExample" id="btn_pay"> Pay Now !</button>
              <?php } ?>
          </div>
          <div class="col-md-3 col-xs-12">
              <h4 style="font-size: 15px !important;">AMOUNT TO BE RECEIVE</h4>
              <h2 class="text-danger" id="amounth2" style="font-size: 25px !important; color: #ac1818 !important">&#8377; <?= number_format($offline_payment,2); ?></h2>
              <?php if($offline_payment != 0 || $offline_payment != '0.00' || $offline_payment != ''){ ?>
              <button class="btn btn-info btn-md" type="button" data-toggle="collapse" data-target="#new_coupon" aria-expanded="false" aria-controls="collapseExample" id="btn_settle"> Settle Now !</button>
              <?php } ?>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-xs-12">
            <h4 style="font-size: 15px !important;">Payouts will not be processed until they exceed <b>&#8377; 100 INR.</b></h4>
            <h4 style="font-size: 15px !important;">Your Paypal account associated with payouts is <span class="text-info" style="text-transform: lowercase !important;"><b><?= $reff_info->email; ?></b></span>.</h4>
        </div>
      </div>
   </div>

<!-- offline payment setlement starts here -->
<?php if($offline_payment != 0 || $offline_payment != '0.00' || $offline_payment != ''){ ?>
<div class="form-body collapse" id="new_coupon">
  <label class="col-sm-12 col-xs-12 control-label field-title">make Payment Received
  <div class="row form-border">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <label class="control-label field-title">Amount</label>
      <input type="text" class="form-control field-title" name="off_amount" id="off_amount" value="<?php echo $offline_payment;?>" readonly>
    </div>
    <div class="col-md-8 col-sm-12 col-xs-12">
      <label class="control-label field-title">Remarks : </label>
      <textarea class="form-control field-title" name="remark" id="remark" rows="3"></textarea>
    </div>
  </div>
  <div class="row form-border">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div id="please_wait" class="form-group" style="display: none; float: center; padding-top: 3px;">
        <img src="https://myonlineshiksha.com/public/images/loading.gif" height="30px">
        Please Wait
      </div>
      <button class="btn btn-success btn-md control-label" id="offline_btn" type="button" onclick="return check_error()">Receive Payment</button>
    </div>
  </div>
</div>
<?php } ?>
<!-- offline paymet ends here -->
                                <!-- online payment starts here -->
<?php if(floatval($total_payout->balance_amount) != 0 || floatval($total_payout->balance_amount) != '0.00' || floatval($total_payout->balance_amount) != ''){ ?>
<div class="form-body collapse" id="online_div">
  <label class="col-sm-12 col-xs-12 control-label field-title">make Payment of Commission
  <div class="row form-border">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <label class="control-label field-title">Amount<span class="error">*</span></label>
      <input type="text" class="form-control field-title" name="on_amount" id="on_amount" placeholder="enter Amount" onkeypress="return with_decimal(event);" onkeyup="return check_max(this.value)">
      <input type="hidden" value="<?php echo $total_payout->balance_amount;?>" id="max_amount">
      <span class="error" id="err_amount"></span>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <label class="control-label field-title">Payment Mode</label>
      <select class="form-control field-title" name="pay_mode" id="pay_mode">
        <option value="Cash">Cash</option>
        <option value="Online">Online</option>
      </select>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
      <label class="control-label field-title">Remarks </label>
      <textarea class="form-control field-title" name="memo" id="memo" rows="3" placeholder="enter Remark here"></textarea>
    </div>
  </div>
  <div class="row form-border">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div id="please_waitt" class="form-group" style="display: none; float: center; padding-top: 3px;">
        <img src="https://myonlineshiksha.com/public/images/loading.gif" height="30px">
        Please Wait
      </div>
      <button class="btn btn-success btn-md control-label" id="online_btn" type="button" onclick="return check_online()">Pay Now</button>
    </div>
  </div>
</div>
<?php } ?>
<!-- online paymet ends here -->
<div class="panel-body main-table form-body">
   <table class="table table-bordered table-striped datatable dataTable example_datatable1" id="table-21" aria-describedby="table-2_info">
      <thead>
         <tr role="row">
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Paid Amount</div>
            </th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Payment Date</div>
            </th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Payment Mode</div>
            </th>
            <th class="sorting col-sm-6" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Memo</div>
            </th>
         </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content" >
         <?php 
         foreach ($payout_data as $key) { 
         ?>
         <tr class="camp0">
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->paid_amount; ?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->paid_date; ?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->pay_mode; ?></td>
            <td class="field-title" style="color: #949494;text-align:center!important;"><?php echo $key->memo; ?></td>
         </tr>
         <?php }  ?>
      
      </tbody>
   </table>
<input type="hidden" id="reseller_id" value="<?php if(!empty($reff_info)){echo $reff_info->id;}?>">

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
</div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom_js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/custom_js/payout.js"></script>