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
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />

<style type="text/css">
.orders_list .btn.btn-default {
	padding: 5px 15px;
	font-size: 14px;
	border: 1px solid #2d3b92;
	color: #2d3b92;
	margin-left: 0px;
}
.orders_list .btn.btn-default:hover {
	background: #2d3b92;
	color: #fff;
}
.orders_list {
	border-bottom: 1px solid #f2f3f5;
	display: inline-block;
	width: 100%;
	padding: 15px 0px 15px 0px !important;
}
.orders_list div {
    padding: 0px 10px 0px 0px;
    font-size: 14px;
}
.heading div {
    padding: 5px 5px 5px 0px !important;
}
.course_img img {
    object-fit: cover;
    width: auto;
    max-width: 100%;
    height: auto;
    max-height: 100%;
}
.course_img {
    padding-right: 0px !important;
}
.product_name {
    padding-left: 15px !important;
}
.table-scroll-resp.order_scroll.inner_pages_table .row:last-child .orders_list {
    border-bottom: 0px;
}
@media (max-width: 767px){
	.heading{
		display: none;
	}
	.orders_list .btn.btn-default {
		width: 190px;
		margin: 10px 0px 0px 0px;
	}
	.orders_list {
		padding: 0px 0px 0px 0px !important;
	}
	.orders_list div {
		margin-bottom: 10px;
	}
}
@media (max-width: 500px){
	.orders_list .btn.btn-default {
	width: 100%;
}
}
</style>
<style>
label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
.table>tbody>tr>td{
	background: #fff !important;
}
</style>

<div class="page-container myinfo_page">
	<div class="main-content">
			<div class="info_page_breadcrumb">
				<div class="info_container">
					<h3>My Orders</h3>
					<p>Here you can view the orders status of the courses you have subscribed to or purchased.</p>
				</div>
			</div>
			<div class="content cources_main_content">
				<div class="info_container">
					<div style="height: 0px">
					    <?php if (isset($control)): ?>
					    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
					    <?php endif ?>
					    <span class="clearFix">&nbsp;</span>
					</div>
					<?php
						$attributes = array('class' => 'tform', 'name' => 'topform1');
						echo form_open_multipart('my-orders/',$attributes);
					?>
					<div id="table-2_wrapper" class="dataTables_wrapper form-inline " role="grid">
						<div class="row">
						    <div class="course_search order_search1" style="margin-top: 10px; float:left;">
						      	<input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Course List">
								<button type="submit" value="Search" name="submit_search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>
						    </div>
						</div>
			 			<?php echo form_close(); ?>
						<div class="table-scroll-resp order_scroll inner_pages_table">
							<div class="row heading">
								<div class="col-sm-12" style="border-bottom: 1px solid #f2f3f5;padding: 15px;">
									
									<div class="col-xs-6"><h4>Courses</h4></div>
									<div class="col-xs-6">
										<div class="col-xs-3">Ordered Date</div>
										<div class="col-xs-3">Price</div>
										<div class="col-xs-3">Payment Method</div>
										<div class="col-xs-3">Invoice</div>
									</div>
								</div>
							</div>
							<?php
								$attributes = array('class' => 'tform', 'name' => 'orderform');
								echo form_open_multipart('admin/programs/',$attributes);
								if ($orders): 
								$i=0;
							   	$iii = 0;
								foreach ($orders as $order):
									$get_courses = $this->orders_model->getProgramName($order->courses);
							  	$coursearr=explode('-',$order->courses);
							  	$plan_id = $this->orders_model->getPlanId(@$coursearr[0]);
							  	// $signs = $this->settings_model->getCurrenciesign($order->currency);
							  	$course_name = $this->orders_model->getProgramName(@$coursearr[0]);
							  	$urlCourse = $course_name->slug;
							?>
							<div class="row">
								<div class="col-sm-12 orders_list" style="padding: 10px;">
									<div class="col-xs-3 col-sm-1 course_img">
										<img src="<?= base_url();?>public/uploads/programs/img/thumb_232_216/<?= $get_courses->image;?>" width="100%">
									</div>
									<div class="col-xs-9 col-sm-5 product_name">
										<?php if($order->status == 'PENDING' || $order->status == 'FAILURE' || $order->processor == 'Direct Payment'){ ?>
										<a href="<?php echo base_url()?>online-courses/<?php echo $urlCourse ?>"><?php echo $course_name->name;?></a>
										
										<?php } else { ?>
										<a href="<?php echo base_url()?><?php echo $urlCourse;?>/lectures/<?php echo @$coursearr[0]; ?>"><?php echo $course_name->name;?></a>
										<?php } ?>
										<p><?php if(!empty(@$plan_id)){echo $this->orders_model->getPlanName(@$plan_id);}else{echo "";}?></p>
									</div>
									<div class="col-xs-12 col-sm-6 course_other_det">
										<div class="col-xs-12 col-sm-3 course_date"><?php echo date('d-m-Y',strtotime($order->order_date));?>
										</div>
										<div class="col-xs-2 col-sm-3 course_price"><?php echo $order->amount ? @$signs->sign.' '.$order->amount : 'Free'; ?>
										</div>
										<div class="col-xs-10 col-sm-3 course_pay_method"><?php echo $order->processor;if($order->status == 'PENDING'){echo " ( Pending )";} elseif($order->status == 'FAILURE'){echo " ( Failure )";}?></div>
										<div class="col-xs-12 col-sm-3 course_receipt">
											<?php if($order->status == 'PENDING' || $order->status == 'FAILURE' || $order->processor == 'Direct Payment'){ } else { ?>
							          		<a class='btn btn-default' href='<?php echo base_url(); ?>my-orders-invoice/<?php echo $urlCourse; ?>/<?php echo $order->id;?>'>Receipt</a>
							        		<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php $iii++; 
			    			endforeach;
							else: ?>
							<div class="col-sm-12 orders_list datatable dataTable">
								No orders yet. <a href="<?php echo base_url(); ?>courses">Create a one now !</a>
							</div>
							<?php endif;
							echo form_close(); ?>
						</div>
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
<style type="text/css">
  .data{
   margin:4%; 
   display: none;
  }

</style>
<script>
var $ =jQuery.noConflict();
			//(function($) {
				$(document).ready(function() {

					$('#more').click( function(){
				        $(this).find('i').toggleClass(' glyphicon glyphicon-plus').toggleClass('glyphicon glyphicon-minus');
				      });

					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			//}) (jQuery);
</script>


<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->

