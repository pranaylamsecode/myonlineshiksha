<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style>
.jconfirm .jconfirm-box div.title {
  background: transparent;
  font-size: 18px;
  font-weight: 600;
  font-family: inherit;
  padding: 10px 15px 10px;
  text-align: center;
  display: block;
  color: #c42140;
  text-transform: uppercase;
  font-size: 21px!important;
  font-weight: bold;
  text-align: center!important;
  padding: 17px 30px 0 13px !important;
  border-bottom: 0px!important;
  margin-top: 0px!important;
  background-color: #f1f1f1!important;
  height: 73px!important;
}
button.btn.btn-success {
  background-color: #04A600!important;
}
.jconfirm .jconfirm-box .buttons {
  padding: 20px 15px!important;
}
</style>
<?php

   
 // print_r($this->load->model('admin/Users_model'));
 
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
  $first = $start + 1;

?>

<script type="text/javascript">
jQuery(document).ready(function() {
   jQuery('#period').on('change',function() {
    
	var period_id = jQuery('#period').val();
	//alert(period_id);
	
	if(period_id == '')
	{
	   jQuery('#label_from,#label_to').css("display","block");
	   
	}
	else
	{
	  jQuery('#label_from,#label_to').css("display","none");
	  jQuery('#from_date,#to_date').val('');
	}
	
   });
});
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
$(function() {
$( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
$( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
});
</script>


<!--<div id="toolbar-box">


	<div class="m">


		<div id="toolbar" class="toolbar-list">


			


			<div class="clr"></div>


		</div>


		<div class="pagetitle icon-48-generic"><h2><?php echo 'Order Manager';?></h2></div>


	</div>


</div>


<div class='clear'></div>-->


<div class="main-container">
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php


$attributes = array('class' => 'tform', 'name' => 'topform1');


echo form_open_multipart(base_url().'admin/orders/',$attributes);


?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<div id="sticky-anchor"></div>
			<ul id="sticky" style="list-style: none; float: right;">

			<li id="toolbar-new" class="listbutton">

            <a href="<?php echo base_url(); ?>admin/orders/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">
            <i class="entypo entypo-popup"></i>
			<span class="icon-32-new">

			</span>

			New

			</a>

			</li>

			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Order Manager';?></h2></div>
	</div>
</div>
<br>
<div class='clear'></div>
<div class="row">

  <div class="col-sm-12 top-head-box no-padding" style="display:inline-block;">
	<!-- <div id="table-3_length" class="dataTables_filter" style="height: 105px; text-align: end;"> -->
	<div id="table-3_length">
	  <span>
		<input type="text" value="<?php echo set_value('search_text', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-height form-control" placeholder="Orders List">
	 
	  </span>
	  <span>
		<button type="submit" value="Search" name="submit_search" class="search-btn"><div class='sprite search' title="Search"></div></button>
		<button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>
	  </span>	
	</div>
<br>

 <div class="col-sm-12 no-padding top-head-box">
    <!-- <div class="dataTables_length" id="table-3_filter" style="height: 105px;"> -->
    <div id="table-3_filter">
      <div class="col-sm-8" style="text-align:right;padding-right:0;">
	    <div class="col-sm-offset-1 col-sm-3">
      		<select placeholder="Select Teacher" name="teacherid" id='teacherid' size="1" class="form-control form-height">
    			<option value="">Select Teacher</option>
    			<?php
    			foreach ($users as $user):
                //$cat_name = ($this->input->post('catid') && $this->input->post('catid') == $category->id) ? 'selected="selected"' : '';
                ?>

    			<option value='<?php echo $user->id?>'><?php echo $user->first_name.' '.$user->last_name; ?></option>
				<?php endforeach ?>
			</select>
    	</div>
    	<div class="col-sm-4">
			<label id="label_to" >
	     		<input type="text" placeholder="To" name="to_date" id="to_date" value="" class="form-control form-height" />
	  		</label >
	  	</div>
	  	<div class="col-sm-4">
	  		<label id="label_from" >
	     		<input type="text" placeholder="From" name="from_date" id="from_date" value="" class="form-control form-height" />
	 		</label>
	 	</div>
	  </div>

	  <div class="col-sm-4" style="text-align:right;padding-right:0;">
    	<div class="col-sm-6">
       		<select placeholder="Select Period" name="period" id="period" class="form-control form-height">
				<option value="">Select Period</option>
				<option value='today' >Today</option>
				<option value='week' >1 Week</option>
				<option value='month' >1 Month</option>
				<option value='year' >1 Year</option>
				<option value='all' >All</option>
			</select>
		</div>
		<div class="col-sm-6">
		    <select placeholder="Select Status" name='status_id' id='status_id' class="form-control form-height">
                <option value="">Select Status</option>  
				<option value="Completed">Completed</option>
				<option value="Pending">Pending</option>
				<option value="Failure">Failure</option>                         
			</select>
		</div>
	  </div>
		
    </div>
 </div>
</div>
</div>
<br>   

<?php echo form_close(); ?>
<div class='clear'></div>






	<thead>
		<tr role="row">
        	
            <!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
           
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Order ID</th> 

            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">User Name</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Course</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Price</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Plan</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Ordered Date</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Amount</div></th>
            
			<th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Status</div></th>
			
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Pending Reason</div></th>
		
		
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Payment Method</div></th>
            
            
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Actions</div></th>
            
         </tr>
	
    </thead>
	
<?php if ($orders):
//print_r($orders);
?>

	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;?>


	<?php 
	       $iii = 0;
	    
	  foreach ($orders as $order){


        $coursearr=explode('-',$order->courses);
		
		$plan_id = $this->users_model->getPlanId(@$coursearr[0]);

    ?>
<tr class="camp<?php echo $i;?>">
<!-- <td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $order->id?>">--><!--</td>-->
<!--<td><?php //echo $order->id;?></td>-->
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
             <?php /* ?><td><a href="<?php echo base_url();?>admin/users/edit/<?php echo $order->userid?>"><?php echo $this->users_model->getUserName($order->userid);?></a></td>  <?php */ ?>
			<td class="field-title" style="text-transform: capitalize;text-align:center!important;"><a  href='<?php echo base_url(); ?>admin/orders/vieworder/<?php echo $order->id ?>'><?php echo $order->id; ?></a></td>
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $this->users_model->getUserName($order->userid);?></td>
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $this->users_model->getProgramName(@$coursearr[0]);?></td>
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $this->users_model->getPrice(@$coursearr[0]); ?></td>
            <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $this->users_model->getPlanName(@$plan_id);?></td>
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $order->order_date.' GMT';?></td>
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $order->amount;?></td>
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">
            <form name="statusform<?php echo $order->id; ?>" id="statusform<?php echo $order->id; ?>" method="post" action="<?php echo base_url();?>admin/orders/orderStatusUpdate">
            <select name='status_id<?php echo $order->id; ?>' id='status_id<?php echo $order->id; ?>' class="form-control" onchange="statusorders(<?php echo $order->id; ?>,<?php echo $order->userid; ?>,<?php echo @$coursearr[0]; ?>);" >
                                    <option value=" ">Select</option>  
									<option value="Completed" <?php echo ( @$order->status == 'Completed' )? 'selected="selected"' : '' ?> >Completed</option>
						            <option value="Pending" <?php echo ( @$order->status == 'Pending' )? 'selected="selected"' : '' ?> >Pending</option>
						            <option value="Failure" <?php echo ( @$order->status == 'Failure' )? 'selected="selected"' : '' ?> >Failure</option>                    
			                </select>
			                <span id="span<?php echo $order->id; ?>" style="color:green;"></span>
			</form>
			</td>
			<!-- <td class=" ">
            <?php



		if($order->status == 'Pending')


		{


		?>


		<a href="<?php echo base_url(); ?>admin/orders/paid/<?php echo $order->id;?>/" style="text-decoration:none" ><?php echo $order->status; ?></a>


		<?php


		}


		else


		{


		?>


		<a href="<?php echo base_url(); ?>admin/orders/pending/<?php echo $order->id;?>/" style="text-decoration:none" ><?php echo $order->status; ?></a>


		<?php


		}


		?>
            </td> -->
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $order->pending_reason;?></td>
			<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">
				<?php echo $order->processor;?>
			</td>
			<td class=" " align="center">				
                
                <?php //echo $eachblog->title;?>

			<a class='col-sm-6 no-padding' href="<?php echo base_url(); ?>admin/orders/edit/<?php echo $order->id; ?>"><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>

			<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you sure to delete this order?')" href="<?php echo base_url(); ?>admin/orders/delete/<?php echo $order->id; ?>/"><i class="entypo-cancel"></i>Delete</a> -->
			<a class="col-sm-6" onclick="return deleteconfirm(<?php echo $order->id; ?>);" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
			</td>
            <?php /* ?>	<td><a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/orders/delete/<?php echo $order->id?>'><?php echo lang('web_delete')?></a>  </td> <?php */ ?>
		</tr>
        <?php
		  $iii++;
		} ?>
		
		    <?php else: ?>



           <tr><td colspan="11">


		          <p class='text'><?=lang('web_no_elements');?></p>
		      </td>
              </tr>





             <?php endif ?>


        </tbody>
        </table>






<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countorders; ?> entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>
<?php } ?>
</div>
</div>
<script>

	function selectstatus()
	{
	  var selectvalue = $("#status_id1 option:selected").val();
	 
	  
	}

</script>
<script>
function statusorders(orderid,userid,course_id)
 {

    var action = '';
    var form_data = '';    	
    	
    	action = $("#statusform"+orderid).attr("action");
    	form_data = {         
             selectvalue: $("#status_id"+orderid+" option:selected").val(),
             orderid:orderid,
             userid:userid,
             course_id:course_id
            };
            $.ajax({
            type: 'POST',
            url: action,
            data: form_data, 
            success: function(response) 
			{

				
				if(response =='success')
				{
				$("#span"+orderid).html('Status Changed');
				setTimeout(
						function() 
						{
							
						$("#span"+orderid).slideUp('slow');

						}, 2500);
				$("#span"+orderid).show();
			}
			}
		});
             
      
}
</script>




<script>
var $ =jQuery.noConflict();

		function deleteconfirm(id) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete order ?',
    			content: ' ',
    			confirm: function(){ 
    					 window.location.href = "<?php echo base_url(); ?>admin/orders/delete/"+id;
        
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}
</script>

<script>
var $ =jQuery.noConflict();
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>