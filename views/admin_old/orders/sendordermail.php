<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div class="panel-heading" >
<div class="panel-title" style="border-bottom: 1px solid #ebebeb; float:none;">
Order Invoice
<!--<p style="margin-left: 1094px;margin-top: -20px;"> <a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="http://www.create-online-academy.com/public/default/images/email.png" title="Email this certificate"></a></p>-->
<p style="margin-left: 1120px;margin-top: -35px;"><a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="<?php echo base_url(); ?>/public/default/images/download.png" title="Download your Order Invoice as PDF"></a></p>
</div>

<div class="panel-body"> 
	<fieldset class="adminform">
		<div class="admintable form-horizontal form-groups-bordered">
<?php
$sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
        $order_id  = $this->uri->segment(4) ; 
        $orders = $this->users_model->getIndividualOrder($order_id);
?>
		<div style="border-bottom: 1px solid #ebebeb;">
				<label>Order ID :</label>
				<label><?php echo $orders->id;?></label>
           </div>
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>User Name :</label>
				<label><?php echo $orders->first_name.' '.$orders->last_name; ?></label>
                  
			</div>

			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Course Name :</label>
				<label><?php echo $this->orders_model->getProgramName($orders->courses);?></label>
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Order Date :</label>
				<label><?php echo $orders->order_date;?></label>
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Order Status :</label>
				<label><?php echo $orders->status;?></label>
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Total Amount :</label>
				<label><?php echo $orders->amount;?></label> 
			</div>
			
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Amount paid :</label>
				<label><?php echo $orders->amount_paid;?></label>
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Currency :</label>
				<label><?php echo $orders->currency;?></label>
				   <?php  $signs= $this->settings_model->getCurrenciesign($orders->currency); ?>
				    <label style="margin-left: -192px;">(<?php echo $signs ? $signs->sign : '';?>)</label>				
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Promocodes :</label>
				<label><?php ?></label>
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Payment Getway :</label>
				<label><?php echo $orders->processor;?></label>
            </div>
            <div>
				<label>Transaction ID :</label>
				<label><?php echo $orders->transactionid;?></label>
            </div>

			
		</div>
	</fieldset>
	
</div>	
</div>

<div class="panel-heading" >
<div class="panel-title" style="border-bottom: 1px solid #ebebeb; float:none;">
Send Mail
<!--<p style="margin-left: 1094px;margin-top: -20px;"> <a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="http://www.create-online-academy.com/public/default/images/email.png" title="Email this certificate"></a></p>-->
<p style="margin-left: 1120px;margin-top: -35px;"><a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="<?php echo base_url(); ?>/public/default/images/download.png" title="Download your Order Invoice as PDF"></a></p>
</div>
<fieldset>
<div class="admintable form-horizontal form-groups-bordered">
<form  action="#" method="post">
			<div style="border-bottom: 1px solid #ebebeb;">

				<label>Email to:</label>
				<input type="text" name ="sendto" id ="sendto" class="form-control" />
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Personal Message: :</label>
				<textarea name="msgbody" id="msgbody"></textarea>
            </div>
            <div>
				<label></label>
				<input type="button" value="send" name="send" onclick="sendOrderMail(<?php echo $orders->id;?>);" >
            </div>
            </form>
            </div>
            </fieldset>
</div>
<script>
	function sendOrderMail(id)
	{
		var sendto = document.getElementById("sendto").value;

		var msgbody = document.getElementById("msgbody").value;
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>orders/sendOrderMail/"+id,
			data: {sendto:sendto,msgbody:msgbody}, 
			success: function(response)
			{	
				//alert(response);	
				//$("#queAns").html(response);				
			}
		  		});
	}
</script>