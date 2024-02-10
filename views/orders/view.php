<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style type="text/css">
	.info_page_breadcrumb h3 {
	    margin-bottom: 0px;
	}
	.content.cources_main_content {
	    padding: 40px 0px;
	}
	.receipt_head span {
	    color: #29303B;
	    font-size: 19px;
	}
	.receipt_head a {
	    float: right;
	    border: 1px solid #2d3b92;
	    color: #2d3b92;
	    font-weight: normal;
	    padding: 5px 15px;
	    border-radius: 50px;
	    position: relative;
	    top: -10px;
	}
	.receipt_head a:hover {
	    background: #2d3b92;
	    color: #fff;
	    border: 1px solid #fff;
	}
	.receipt_head {
	    border-bottom: 1px solid #ddd;
	    padding: 0px;
	    margin: 0px;
	}
	.receipt_details {
	    padding: 60px 0px 0px 0px !important;
	}
	.sold_to {
	    padding: 25px 0px;
	    border-top: 1px solid #ddd;
	    border-bottom: 1px solid #ddd;
	    margin: 20px 0px;
	}
	.course_det_head {
	    padding: 10px 0px;
	}
	.mobile_head{
		display: none;
	}
	.row.course_details {
	    padding: 0px;
	}
	.total, .discount, .total_amount {
	    padding: 0px;
	}
	.order_details {
	    margin-top: 90px;
	}
	.total_amount {
	    border: 0px !important;
	}
	.total {
	    font-weight: normal;
	}
	.receipt_details span {
	    font-size: 24px !important;
	    line-height: 2.3em;
	}
@media (max-width: 767px){
	.course_det_head {
	   display: none;
	}
	.receipt_head a {
	    font-size: 15px;
	}
	.total, .discount, .total_amount {
	    padding: 10px 0px !important;
	    line-height: 1.5em;
	}

	.mobile_head {
	    display: inline-block;
	    font-size: 15px;
	}
	.row.course_details div {
	    width: 100%;
	    padding: 0px;
	}
	.receipt_details {
	    padding: 20px 0px 0px 0px !important;
	}
	.order_details {
	    margin-top: 20px;
	}
	.order_details p {
	    margin: 5px 0px;
	}
	.row.course_details {
	    padding: 0px 15px 20px 15px !important;
	    margin-bottom: 0px !important;
	    line-height: 1.7em;
	}
	.sold_to {
	    padding: 0px 0px 35px 0px;
	    border-top: 0px;
	    border-bottom: 1px solid #ddd;
	    margin: 20px 15px 30px 15px;
	}
	.receipt_head a {
	    display: block;
	    float: left;
	    position: unset;
	    margin-top: 11px;
	    margin-bottom: 15px;
	}
	.receipt_head span {
	    display: block;
	}
	.row.receipt_head {
	    margin: 0px 15px !important;
	}
	.order_details b, .sold_to b {
	    font-size: 15px;
	}
	.receipt_details span {
	    font-size: 20px !important;
	    line-height: 2.3em;
	}
}
</style>
	<div class="page-container myinfo_page">
	    <div class="main-content">
	        <div class="info_page_breadcrumb">
		        <div class="info_container">
		          <h3>Receipt</h3>
		        </div>
	      	</div>
	      	<div class="content cources_main_content">
		        <div class="info_container">	
					<?php
						$course = $this->orders_model->getProgramName($orders->courses);
						$signs = $this->settings_model->getCurrenciesign($orders->currency);
						$attributes = array('class' => 'tform','id'=>'user_profile','name'=>'user_profile','onclick'=>'return validateForm()');
						echo form_open_multipart('orders/view', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/
					?>
					<div class="row receipt_head" style="font-size: 16px;font-weight: bold; padding-top: 10px;">
						<span style="">Receipt - <?php echo date('M. d, Y', strtotime($orders->order_date));?>
						</span>
						<!-- <a href="javascript:void(0)" onclick="sendOrderMail(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="http://www.create-online-academy.com/public/default/images/email.png" title="Email this certificate"></a> -->
						<a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);">Download as PDF</a>
					</div>
					<div class="row receipt_details" style="padding-bottom: 10px; padding-top: 10px;">
						<div class="col-sm-9">
						<span>MyOnlineShiksha</span>
						<p style="font-size: 16px;">5th floor, Sadoday Complex,<br>
						Near Darodkar Chowk, Central Avenue Road,<br>
						Darodkar Chowk, Nagpur,<br>	Maharashtra 440002. <br>
						<a href="<?php echo base_url(); ?>">myonlineshiksha.com</a>
						</p>
						</div>
						<div class="order_details col-sm-3">
						<p><b>Date:</b>  <?php echo date('M. d, Y', strtotime($orders->order_date));?></p>
						<p><b>Order ID: </b><?php echo $orders->id;?></p>
						</div>
					</div>
					<div class="sold_to"><b>Sold to: </b><span><?php echo $orders->first_name.' '.$orders->last_name; ?></span></div>
					<div class="row course_det_head" style="border-bottom: 1px solid #f1f1f1;padding-bottom: 10px;font-weight: bold">
						<div class="col-sm-4">Course Name</div>
						<div class="col-sm-2">Order Date</div>
						<div class="col-sm-2">Coupon Code</div>
						<div class="col-sm-2">Price</div>
						<div class="col-sm-2">Amount</div>
					</div>
					<div class="row course_details" style="border-bottom: 1px solid #f1f1f1;padding-bottom: 10px;padding-top: 10px;">
						<div class="col-sm-4"><span class="mobile_head"><b>Course Name:&nbsp;</b></span><?php echo $course->name;?></div>
						<div class="col-sm-2"><span class="mobile_head"><b>Order Date:&nbsp;</b></span><?php echo date('M. d, Y', strtotime($orders->order_date));?></div>
						<div class="col-sm-2"><span class="mobile_head"><b>Coupon Code:&nbsp;</b></span><?php if(!empty($orders->promocodeid)){
						$promos = $this->orders_model->get_promos($orders->promocodeid);
						echo $promos->code;
						}else{ echo "N/A";} ?>
						</div>
						<div class="col-sm-2"><span class="mobile_head"><b>Price:&nbsp;</b></span><?php echo $signs->sign." ".$course->fixedrate;?></div>
						<div class="col-sm-2"><span class="mobile_head"><b>Amount:&nbsp;</b></span><?php echo $signs->sign." ".$course->fixedrate;?></div>
					</div>
					<div class="row total" style="border-bottom: 1px solid #f1f1f1;padding-bottom: 10px;padding-top: 10px;">
						<div class="col-xs-12 col-sm-offset-8 col-sm-2">Total</div>
						<div class="col-xs-12 col-sm-2"><?php echo $signs->sign." ".$course->fixedrate;?></div>
					</div>
					<div class="row discount" style="border-bottom: 1px solid #f1f1f1;padding-bottom: 10px;padding-top: 10px;">
						<div class="col-xs-12 col-sm-offset-8 col-sm-2">Discount (<b>-</b>)</div>
						<div class="col-xs-12 col-sm-2">
							<?php if(!empty($orders->promocodeid)){
						$promos = $this->orders_model->get_promos($orders->promocodeid);
						echo $signs->sign." ".$promos->discount;
						}else{ echo "0";} ?>
						</div>
					</div>
					<div class="row total_amount" style="border-bottom: 1px solid #f1f1f1;padding-bottom: 10px;padding-top: 10px;">
						<div class="col-xs-12 col-sm-offset-8 col-sm-2">Total Amount</div>
						<div class="col-xs-12 col-sm-2"><?php echo $signs->sign." ".$orders->amount;?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function openWinCertificate4(id)
{
    myWindow=window.open('<?php echo base_url(); ?>orders/pdf/'+id,'','width=800,height=600, resizable = 0');
	myWindow.focus();
}
function sendOrderMail(id)
{
    myWindow=window.open('<?php echo base_url(); ?>orders/sendOrderMail/'+id,'','width=800,height=600, resizable = 0');
	myWindow.focus();
}
</script>