<?php
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
  $first = $start + 1;
?>
<script>
function saveorder(n, task) {
checkAll_button(n, task);
}

function checkAll_button(n, task) {
	if (!task) {
		task = 'saveorder';
	}
    document.orderform.submit();
}
</script>

<?php

  $u_data=$this->session->userdata('logged_in');

  $maccessarr=$this->session->userdata('maccessarr');

?>
<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />

<style type="text/css">
  .sidebar-menu.sb-left {
    display: none;
}
#left_menu_sidebar {
  display: none;
}
.sidebar-collapse.sb-toggle-left {
  display: none;
}
</style>
<style>
.sign{
	    font-size: 25px;
    font-weight: bold;
}
.header .sign:after{
  content:"-";
  display:inline-block;      
}
.header.expand .sign:after{
  content:"+";
 }

label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
.table>tbody>tr>td{
	background: #fff !important;
}
</style>

<div class="page-container">
<div style="background-color: #F5F5F5">
<div class="sidebar-menu sb-left">
<!-- Your left Slidebar content. -->
<!-- Classes Examples -->
	<ul id="main-menu">
		<li class="root-level"><a href="<?php echo base_url(); ?>courses-manage"><span>My Courses</span></a></li>  
		<li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>My Exams</span></a></li>   
		<li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>  
		<li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
	</ul>
</div>


<div class="main-content">
<div class="row">

<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0;margin-right: 20px;margin-bottom: 0px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu" ></i>
	</a>
</div>

<p class="right_course_txt">
Here you can view the orders status of the courses you have subscribed to or purchased.
</p>


<div class="clr"></div>
<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('my-orders/',$attributes);
?>


<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">
    <div class="course_search" style="margin-bottom: 20px; float:right;">
	
      	<input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Course List">

		<button type="submit" value="Search" name="submit_search" class="btn btn-info" ><span class="lnr lnr-magnifier"></span></button>

		<!-- <button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: 0px;padding-left: 4px;"><i class="entypo entypo-cw"></i> Reset</button>
 -->  
    </div>

</div>
<div class="clear"></div>
 <?php echo form_close(); ?>

<div class="table-scroll-resp">
<table class="table table-bordered table-striped datatable dataTable inner_pages_table" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">        	           
            <th>Sr.no</th>                       
            <th style="width: 330px;">Student Name</th>
            <th>Course Title</th>
            <th style="width: 84px;">Price</th>			
			<!-- <th>Sale Percentage</th>                     -->
			<th>Payout</th>                    
            <th>Sale Date</th>            
            <th style="width: 150px;" >Status</th>                  
            <th>More</th>           
        </tr>
	</thead>

<?php 
 
 if ($orders):
  ?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>

<?php 
	$ct =1;
   $iii = 0;
foreach ($orders as $order):
    
	
	$orderDetails = $this->orders_model->getsaleOrders($order->userid,$order->course_id);
	// echo"<pre>";
	// print_r($orderDetails);

	$plan_id = $this->orders_model->getPlanId($order->course_id);
	$signs = $this->settings_model->getCurrenciesign($order->currency);
?>


		 
 <tr class="odd camp<?php echo $i;?> header expand">
        
			<td class="product_name"><?php echo $ct; ?></td>
			<td><?php echo ucfirst($order->first_name)." ".ucfirst($order->last_name);  ?></td>
			<td class=" "><?php echo $this->orders_model->getProgramName($order->course_id)->name;?></td>
			<?php $pr = $this->orders_model->getPrice($order->course_id); ?>
			<td style="text-align: center;" class=" "><?php echo $order->price;?><?php echo $signs &&  $order->price ? '('.$signs->sign.')': '';?></td>
            <?php
            $actual_price = $order->price;
            if($coursepercent)
            {
              $fraction_value = $coursepercent->coursepercent/100;
              $get_percentage = $actual_price * $fraction_value;
            }
            else
            {
              $get_percentage = $coursepercent->coursepercent;
            }
            $ass_percent = $this->orders_model->getAssessment($order->userid);
            ?>
            <!-- <td class=" "><?php echo $get_percentage || $get_percentage!=0  ? $get_percentage:""; ?></td> -->
            <td class=" " style="text-align: center;" ><?php echo ($order->price*$ass_percent)/100; ?></td>
            <td class=" "><?php echo $order->buy_date; ?></td>
            <td class=" "><?php echo $orderDetails ? $orderDetails->order_status:'FREE';  ?></td>
			<td style="text-align: center;"><?php echo $orderDetails ? '<span class="sign"></span>':'';?></td>			
  </tr> 
<?php
if($orderDetails)
{
?>
  <tr class="odd camp<?php echo $i;?>" style="display:none">
        	<td></td>
			<td colspan="8">
			<div class=" "><b>Order ID:</b> <?php echo $orderDetails->id; ?></div>
			<div><b>Transaction ID:</b> <?php echo $orderDetails->transactionid; ?></div>
			<div class=" "><b>Plan:</b> <?php echo $this->orders_model->getPlanName(@$plan_id);?></div>
			<div class=" "><b>Payment Method:</b> <?php echo $orderDetails->processor;?></div>
            <div class=" "> <b>Status:</b> <?php echo $orderDetails->status ?></div>
            <div class=" "><b>Sale Date:</b> <?php echo $orderDetails->order_date; ?></div>
            <div class=" "><b>Order Status:</b> <?php echo $orderDetails->order_status ? $orderDetails->order_status:'';  ?>
            </td>
						
  </tr>         
            
<?php  } ?>        
		
		<?php 
		 $ct++;
		  $iii++;
		endforeach ?>

<?php else: ?>

<tr>

  <td colspan="8">

<!-- <?=lang('web_no_elements');?> -->
No course is sale yet.

</td>

</tr>

<?php endif ?>

</tbody>

 

</tbody>
</table>
</div>
</div>       
      
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
</div>
</div>
<div style="clear:both;"></div>

<script>
var $ =jQuery.noConflict();
			//(function($) {
				$(document).ready(function() {
					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
	
$(document).ready(function() 
{
	$('.header').click(function()
	{
     $(this).toggleClass('expand').nextUntil('tr.header').slideToggle(100);
	});	
});	
</script>


<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->

