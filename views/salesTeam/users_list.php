<div id="toolbar-box">
  <div class="m">
    <div id="toolbar" class="toolbar-list">
      <ul id="sticky" style="list-style:none; float: right;  display: flex;">
        <li id="toolbar-new" class="listbutton">
          <a href="<?php echo base_url();?>SalesTeam/add-new-user/" class="btn btn-green">
            <span class="icon-32-new"></span><i class="entypo entypo-popup"></i> Add new User
          </a>
        </li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pagetitle icon-48-generic"><h2>Manage Users</h2></div>
  </div>
</div>
<div class="col-md-12 col-xs-12 reseller_table_section">
  <div class="col-sm-12 top-head-box no-padding" style="display:inline-block;">
  <label class="control-label field-title pull-left" for="name">Users List</label>
    <div id="table-3_length">
      <div class="col-sm-offset-7 col-sm-4">
        <a href="<?php echo base_url();?>SalesTeam/users/" value="Search" class="search-btn pull-right" style="padding-top: 10px;padding-left: 10px;"><span class="lnr lnr-sync" style="color: #666666;font-size: 23px;"></span></a>
        <form method="post" action="<?php echo base_url();?>SalesTeam/users/">
          <button type="submit" value="Search" name="submit_search" class="search-btn pull-right" style="padding-top: 10px;"><span class="lnr lnr-magnifier" style="color: #666666;font-size: 23px;"></span></button>
          <span class="pull-right">
            <input type="text" value="<?php echo $search_text; ?>" name="search_text" class="form-height form-control" placeholder="users List">
          </span>
        </form> 
      </div>
      <!-- <form method="post" action="<?php echo base_url();?>SalesTeam/users/">
        <button type="submit" value="Search" name="submit_search" class="search-btn pull-right" style="padding-top: 10px;"><span class="lnr lnr-magnifier" style="color: #666666;font-size: 23px;"></span></button>
        <span class="pull-right">
          <input type="text" value="<?php echo $search_text; ?>" name="search_text" class="form-height form-control" placeholder="users List">
        </span>
      </form> --> 
    </div>
  </div>
  <div class="table_section_outer">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting col-sm-1 col-xs-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">#</div>
          </th>
          <th class="sorting col-sm-3 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Users Name</div>
          </th>
          <th class="sorting col-sm-3 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Email ID</div>
          </th>
          <th class="sorting col-sm-2 col-xs-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Mobile</div>
          </th>
          <th class="sorting col-sm-3 col-xs-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;">
            <div class="col-sm-12 no-padding table-title">Date</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php
        if(!empty($users)){
          $i = 1;
        foreach ($users as $key) { ?>
        <tr class="camp0">
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= $i++;?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?= ucwords($key->first_name." ".$key->last_name);?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?php if(!empty($key->email)){echo $key->email;}else{echo '---';}?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?php if(!empty($key->mobile)){echo $key->mobile;}else{ echo "---";} ?></td>
          <td class="field-title" style="color: #949494;text-align:center!important;"><?php echo date('Y-m-d h:i A',strtotime($key->created_at));?></td>
        </tr>
        <?php } }
        else{ ?>
        <tr class="camp0">
          <td class="field-title" style="color: #949494;padding-left: 20px;" colspan="5">No Users.</td>
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
  function getusers(pay_page,controller,search_text) {
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