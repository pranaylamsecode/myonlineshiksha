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
    margin-bottom: 40px;
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
.entypo.entypo-pencil
{
  border: 1px solid;border-top: none; border-right: none; border-radius: 3px;
}
.camp0 td.field-title{
  color: #949494;
  text-align: center !important;
}
.sorting{
  text-align: center;
  font-weight: bold;
}
.w_active{
  background-position: -340px 0 !important;
}
.w_inactive{
  background-position: -308px 0 !important;
}
</style>

  <span id="message"> </span>
<div id="toolbar-box">
  <div class="m">
    <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
      <ul id="sticky" style="list-style:none; float: right;/*padding-right: 20px;*/  display: flex;">
        <li id="toolbar-new" class="listbutton">
          <a href="<?php echo base_url();?>admin/custom-page-builder/" class="btn btn-green">
            <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Build new page</a>
        </li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pagetitle icon-48-generic"><h2>Custom Page List</h2></div>
  </div>
</div>

<div class="col-md-12 col-xs-12 reseller_table_section" id="meetingList" style="padding-top: 30px; ">
  <!-- <label class="col-sm-12 control-label field-title" for="name">Meetings</label> -->
  <div class="table_section_outer">
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">#</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Heading</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Show in Menu</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Status</div>
          </th>
          <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">
            <div class="col-sm-12 no-padding table-title">Option</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php 
        if(!empty($pages)){
          $i=1;
        foreach ($pages as $key) {
        ?>
        <tr class="camp0">
          <td class="field-title"><?php echo $i;?></td>
          <td class="field-title"><?php echo ucwords($key->heading); ?></td>
          <td class="field-title"><?php echo ucwords($key->show_in_menu); ?> </td>
          <td class="field-title">
            <a title="Change status" id="status_<?php echo $key->page_id;?>" onclick="return change_status('<?php echo $key->page_id;?>','<?php echo $key->status;?>')" type="button"><div class="sprite 999publish center <?php if($key->status == 'active'){echo 'w_active';}else{echo 'w_inactive';}?>"></div></a>
          </td>
          <td class="field-title">
            <a href="<?php echo base_url().'admin/pagecreator/edit_custom_page/'.$key->page_id;?>"><div class="sprite center " style="background-position: -32px 0;" title="Edit pages"></div></a>
          </td>
          
        </tr>
        <?php $i++;} }else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="8" style="color: #949494; text-align:center !important;">No pages Available. <a href="#">&nbsp; Create one now.</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php
if($paying) { ?>     
<div class="row" style="padding-bottom: 70px;">
   <div class="col-xs-6 col-left">
      <div class="dataTables_info" id="table-3_info">Showing <?php echo $firstp;?> to <?php echo $startp; ?> of <?php echo $total_payout; ?> entries</div>
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

<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){$("#message").html("");},1000);
  });
  function change_status(id,status){
    if(status == 'active'){
      status = 'inactive';
    }else{
      status = 'active';
    }
    $.ajax({
        type: "post",
        cache: false,
        url : '<?php echo base_url();?>admin/pagecreator/change_status',
        data : {id : id ,status : status},
        success: function(data){
          $("#status_"+id).removeAttr('onclick').attr('onclick',"return change_status("+id+",'"+data+"')");
          if(data == 'active'){
              $("#status_"+id+" div.w_inactive").addClass('w_active ').removeClass('w_inactive');
              var str = '<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-check" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> pages activated. </span></div>';
          }else{
              $("#status_"+id+" div.w_active").addClass('w_inactive ').removeClass('w_active');
              var str = '<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-exclamation-triangle" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> pages deactivated! </span></div>';
          }
          $("#message").html(str).fadeIn("slow");
          setTimeout(function(){
              $("#message").html("");
          },3000);
        }
    });
  }
</script>