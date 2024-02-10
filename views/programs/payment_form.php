<?php
 /* echo '<pre>';
  print_r($program);
  echo '</pre>'; */
?>




<form class="container courses" >
           <div class="row-fluid ">
<br><div class="logdivcon">
    <div class="fullcontent">
                
                <div class="titleholder"><h5>Confirm Purchase</h5></div>
    				<div class="row">
<div class="col-md-6" style="width: 100%;">
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li >
				<a href="#credit" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">Credit</span>
				</a>
			</li>
			<li class="active">
				<a href="#paypal" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Paypal</span>
				</a>
			</li>
		</div>
	</div>	
	
	<div class="tab-content">
	<?php
		$attributes = array('class' => 'tform', 'id' => 'payment');

        echo form_open('/programs/payment', $attributes);
	?>
	<div class="tab-pane" id="credit" >
	  <div><input type="text" name='cardholder' placeholder="Name on card"   value=""   /> </div>
	  <div><input type="text" name='cardnumber' placeholder="Card Number"  value=""   /> </div>
	  <div><input type="text" name='expiry_data' placeholder="MM/YY"  value=""   /> </div>
	  <div><input type="text" name='cvc' placeholder="CVC"  value=""   /> </div>
	  <div>
			<select name='country'  id="" >
				<option value="">Select</option>
				<option value="India">India</option>
				
			
			</select>
	  
	  </div>
	  <div><input type="text" name='postal_code' placeholder="Postal Code"  value=""   /> </div>
	   <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
	   <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
	   <input type="hidden" name="price" value="<?php echo $program->fixedrate; ?>" />
	  <div><?php echo form_submit( 'submit', 'Buy Now', "class='btn-primary_stb'"); ?><!--<input type="button" class="buy btn btn-info" onclick="document.location.href='<?php echo base_url(); ?>/paypal/index/<?php echo $course_id; ?>'" value="Buy now" name="Buy">--> </div>
	</div>
	<?php echo form_close(); ?>
	
	<div class="tab-pane active" id="paypal" >
	  <div><input type="submit" name="" class="" id="" value="Go To Paypal" /> </div>
	  <p>You will be redirected to Paypal's payment page and then sent back once you complete your purchase.</p>
 <p>By clicking the "Pay" button, you agree to these Terms of Service.</p>
	</div>
	</div>
    
    </div>
    </div></form>