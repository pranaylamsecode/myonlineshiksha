<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
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
#mesg {
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
    width: 50%;
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
.published{
  background-position: -340px 0 !important;
}
.unpublished{
  background-position: -308px 0 !important;
}
.search-btn{
  padding-top: 12px;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
        $( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
    });
</script>

<span id="mesg"></span>
<div class="main-container">
<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic"><h2>Orders</h2></div>
    <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
      <ul id="sticky" style="list-style: none; float: right;">
        <li id="toolbar-new" class="listbutton">
          <a href="<?php echo base_url();?>admin/orders/create/" class="btn">
          <i class="entypo entypo-popup"></i>
          <span class="icon-32-new">
          </span> New </a>
        </li>
      </ul>
     
    </div>
    
  </div>
</div>
<div class="top-head-box" >
  
      <!-- <div id="table-3_length" class="dataTables_length"> -->
  <div id="table-3_length">
    <span >
        <input type="text" value="" id="search_text" class="form-height form-control" placeholder="Orders List">
    </span>
  <!-- </div> -->
  
  <!-- <div class="dataTables_filter" id="table-3_filter"> -->
   <!--  <div id="table-3_filter"> -->
      <span >
           <select placeholder="Select Teacher" id='teacher_id' size="1" class="form-control form-height">
        <option value="">Select Teacher</option>
        <?php foreach($teachers as $user){ ?>
        <option value='<?php echo $user->id;?>'><?php echo ucwords($user->first_name.' '.$user->last_name); ?></option>
        <?php } ?>
      </select>
    </span>
    <span class="from-to-date">
      <input type="text" placeholder="From" id="from_date" value="" class="form-control form-height">
    </span>
    <span class="from-to-date">
      <input type="text" placeholder="To" id="to_date" value="" class="form-control form-height">
    </span>
    <span>
      <select placeholder="Select Period" id="period" class="form-control form-height">
        <option value="">Select Period</option>
        <option value='today'>Today</option>
        <option value='week'>1 Week</option>
        <option value='month'>1 Month</option>
        <option value='year'>1 Year</option>
        <option value='all'>All</option>
      </select>
    </span>
    <span>
       <select placeholder="Select Status" id='status_id' class="form-control form-height">
        <option value="">Select Status</option>  
        <option value="SUCCESS">Success</option>
        <option value="PENDING">Pending</option>
        <option value="FAILURE">Failure</option>                         
      </select>
    </span>
    <span>
      <button type="button" value="Search" id="submit_search" class="search-btn" onclick="return get_payout(0,'admin/orders');"><span class="lnr lnr-magnifier"></span></button>
     
      <!-- <button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>  -->    
      </span>
    </div>
  </div>

<div class="reseller_table_section" id="meetingList" >
  <div class="table_section_outer">
    <div class="card table-responsive">
    <table class="table table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
        <tr role="row">
          <th>
            <div class="no-padding table-title">#</div>
          </th>
          <th>
            <div class="no-padding table-title">User Name</div>
          </th>
          <th>
            <div class="no-padding table-title">Course Name</div>
          </th>
          <th>
            <div class="no-padding table-title">Price</div>
          </th>
          <th>
            <div class="no-padding table-title">Plan</div>
          </th>
          <th>
            <div class="no-padding table-title">Order Date</div>
          </th>
          <th>
            <div class="no-padding table-title">Amount Paid</div>
          </th>
          <th>
            <div class="no-padding table-title">Payment Method</div>
          </th>
          <th>
            <div class="no-padding table-title">Status</div>
          </th>
          <th>
            <div class="no-padding table-title">Options</div>
          </th>
        </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all" id="payout_content">
        <?php 
        if(!empty($orders)){
          foreach ($orders as $key){
            $coursearr=explode('-',$key->courses);
            $plan_id = $this->users_model->getPlanId(@$coursearr[0]);
          ?>
        <tr class="camp0 parent_<?php echo $key->id;?>">
          <td class="field-title"><?php echo $key->id; ?></td>
          <td class="field-title"><?= ucwords($key->first_name.' '.$key->last_name);?></td>
          <td class="field-title"><?= ucwords($key->program_name);?></td>
          <td class="field-title"><?= $key->amount;?></td>
          <td class="field-title"><?= $this->users_model->getPlanName(@$plan_id);?></td>
          <td class="field-title"><?= $key->order_date.' GMT';?></td>
          <td class="field-title"><?= $key->amount_paid;?></td>
          <td class="field-title"><?= $key->processor;?></td>
          <td class="field-title"><?= $key->status;?></td>
          <td class="editdelete">
            <a class="" href="<?php echo base_url().'admin/orders/edit/'.$key->id;?>/"><div class="sprite 2edit" style="background-position: -32px 0;" title="Edit"></div></a>
            <a class="" onclick="return delete_order(<?php echo $key->id;?>)"><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
          </td>
        </tr>
        <?php } } else{ ?>
          <tr class="camp0">
            <td class="field-title" colspan="10">No orders yet.</td>
          </tr>
        <?php }  ?>
      </tbody>
    </table>
 <!--  </div>
</div> -->
<div class="row pagination">
<?php 
if($paying){ ?>     
   <div class="col-xs-6">
      <div class="dataTables_info" id="table-3_info">Showing <?php echo $firstp;?> to <?php echo $startp; ?> of <?php echo $total_payout; ?> entries</div>
   </div>
    <div class="col-xs-6">
       <div class="dataTables_paginate paging_bootstrap">
          <ul class="pagination pagination-sm" id="ajax_payout">
            <?php echo $paying;?>
          </ul> 
       </div>
    </div>
<?php } ?>
</div><!-- row -->
</div>
</div>
</div>
</div>

<script type="text/javascript">
  $("#period").on('change',function(){
    $("#from_date").val('');
    $("#to_date").val('');
      if(this.value != '')
        $(".from-to-date").css('display','none');
      else
        $(".from-to-date").css('display','block');
  });


var $ = jQuery.noConflict();
  $(document).ready(function(){
      setTimeout(function(){$("#mesg").html('');},3000);
  });

  function get_payout(pay_page,controller) {
    var teacher_id = $("#teacher_id").val().trim();
    var search_text = $("#search_text").val().trim();
    var from_date = $("#from_date").val().trim();
    var to_date = $("#to_date").val().trim();
    var period = $("#period").val().trim();
    var status_id = $("#status_id").val().trim();
    if(pay_page==0)
    {
      pay_page =1;
    }
    var url = "<?php echo base_url()?>"+controller+"/";
    $.ajax({
      url : url,
      type : "post",
      cache : false,
      data :  {pay_page : pay_page, teacher_id : teacher_id,search_text : search_text, from_date : from_date, to_date : to_date, period : period, status_id : status_id},
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
  }

  function delete_order(id){
    $.confirm({
      title: 'Confirm!',
      content: '<h4 style="text-align: center;">Do you really want to delete ?</h4>',
      confirm: function () {
        $.ajax({
          type : "post",
          cache: false,
          url : "<?php echo base_url();?>admin/orders/delete/",
          data: {id : id},
          success : function(res){
            if(res == '0')
              $(".parent_"+id).html('<td class="field-title" colspan="6" style="color: #949494; text-align:center !important;">No Data Available.</td>');
            else{
              $(".parent_"+id).html('<td style="color : #ac1818" colspan="10"><strong class="fa fa-check" aria-hidden="true"></strong> Order deleted.</td>').fadeIn('slow').css('background-color','#ffc9c9');
              setTimeout(function(){
                $(".parent_"+id).remove().fadeOut();
              },2000);
            }
          }
        });
      },
      cancel: function () {
      }
    });
  }
</script>