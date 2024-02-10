<style>
.link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}
.disabled {cursor:not-allowed;color: #bccfd8;}
.current {background: #bccfd8;}
.first{border-left:#bccfd8 1px solid;}
.question {font-weight:bold;}
.answer{padding-top: 10px;}
#pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}
.dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}
.page-content {padding: 20px;margin: 0 auto;}
.pagination-setting {padding:10px; margin:5px 0px 10px;border:#bccfd8  1px solid;color:#607d8b;}
</style>
<div class="panel-heading">
   <div class="panel-title mb_20" style="padding: 0;width:100%;">
      <h2 class="tab_heading"><?= $type; ?> Orders</h2>
      <!-- <p>Manage the Resellers orders</p> -->
   </div>
</div>

   <table class="table table-bordered table-striped datatable dataTable example_datatable" id="table-2" aria-describedby="table-2_info">
      <thead>
         <tr role="row">
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Order ID</div>
            </th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Student Name</div>
            </th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Course Name</div>
            </th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Amount Paid</div>
            </th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Ordered Date</div>
            </th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Status</div>
            </th>
         </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="ajax_content">
         <?php if(!empty($ref_data)){
         foreach ($ref_data as $key) { 
               $students = $this->Crud_model->get_single('mlms_users',"id ='".$key->userid."'");
               $course = $this->Crud_model->get_single('mlms_program',"id ='".$key->courses."'");
         ?>
         <tr class="camp0">
            <td class="field-title" style="text-transform: capitalize;text-align:center!important;"><?php echo $key->id; ?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php if(!empty($students->last_name)){ echo $students->first_name." ".$students->last_name;} else{ echo $students->first_name;}?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $course->name; ?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->amount; ?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->order_date;?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $key->status; ?></td>
         </tr>
         <?php } }else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="6" style="padding-left: 3% !important;">No Orders yet generated.</td>
          </tr>
         <?php } ?>
      
      </tbody>
   </table>
<input type="hidden" id="reseller_id" value="<?php if(!empty($reff_info)){echo $reff_info->id;}?>">

<?php 
if($paging) { ?>     
<div class="row">
   <div class="col-xs-6 col-left">
      <div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start; ?> of <?php echo $total_data; ?> entries</div>
   </div>
    <div class="col-xs-6 col-right">
       <div class="dataTables_paginate paging_bootstrap">
          <ul class="pagination pagination-sm" id="ajax_links">
            <?php echo $paging; ?>
          </ul> 
       </div>
    </div>
</div>
<?php } ?>

