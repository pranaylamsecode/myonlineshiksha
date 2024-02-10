<script>
  jQuery(".page-container").addClass('sidebar-collapsed');
</script>
<?php $auth = $this->session->userdata('logged_in');
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
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
}

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <div class="panel-body form-body">
   <div class="form-group form-border"> -->
<div class="col-md-12 col-xs-12 reseller_table_section">
  <label class="col-sm-12 control-label field-title" for="name">Sub-Resellers Orders List</label>
  <div class="table_section_outer">
  <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
    <thead>
      <tr role="row">
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Order<br>ID</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Student Name</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Course Name</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Sold by</div>
        </th>
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Amount<br>(<i class="fa fa-inr"></i>)</div>
        </th>
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Commission<br>Earned (<i class="fa fa-inr"></i>)</div>
        </th>
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
          <div class="col-sm-12 no-padding table-title">Purchase Date</div>
        </th>
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
            if(!empty($key->last_name)){ $uname = $key->first_name." ".$key->last_name;} else{ $uname = $key->first_name;}
      ?>
      <tr class="camp0">
        <td class="field-title" style="text-transform: capitalize;text-align:center!important;"><?php echo $key->id; ?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $uname;?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->name; ?></td>
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php if(!empty($key->rlname)){echo $key->rfname." ".$key->rlname;}else{echo $key->rfname; } ?></td>
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
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php if(!empty($key->referred_code)){if($auth['referral_code']!=$key->referred_code){echo "Self";}else{echo "Others";}} else{ echo "Self";} ?></td>
        <?php } ?>
        
        <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo str_replace("Payumoney", "Payumoney<br>",$key->processor); ?></td>
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