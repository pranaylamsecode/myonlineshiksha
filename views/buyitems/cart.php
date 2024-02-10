<div class="fullcontent">
<script type="text/javascript" src="<?php echo base_url();?>public/js/buy.js"> </script>
<script type="text/javascript" src="/Joomla_2.5.8/media/system/js/mootools-core.js"> </script>
<!--<script>
jQuery(function() {
    jQuery('.checkout_button').click(function() {

      var formData = $("#cartform").serialize();

       var promocode = jQuery("input#promocode").val();

      // alert(promocode);

       var dataString = promocode;



       jQuery.ajax({
            type: 'POST',
            url: 'checkout',
           // $.post("checkout", { name: "John", time: "2pm" }),
           //  data: 'promocode=1',
            data: {promocode:+promocode,processor:'processor'},
            error: function()
            {
               alert("Request Failed");
            },
            success: function(data)
            {
              alert("success");
              alert(data);
             //window.location = 'checkout';
             // return false;
            }
               //alert(data);
            });
           $.get('checkout',
            function(data) {
              alert(data);
           // $('.result').html(data);
           window.location = 'checkout';
            //alert('Load was performed.');
            });

        return false;
    });
})
</script>-->




<?php

if(trim($action2) != ""){
	$form = $orderResult;
	echo $form;	
}
elseif(isset($all_product) && count($all_product) > 0){
?>



<!--<form action="index.php" name="adminForm" method="post">   -->
<?php
	//echo $parent_id;exit;
	$attributes = array('class' => 'tform', 'id' => 'cartform');echo form_open_multipart('buyitems/cart/', $attributes);?>
	<div id="cart">
	<table id="mlms_table">	
	<h1 class="contentheading" style="margin-left:5px;">
	<strong><?php echo 'My Cart'; ?></strong>
	</h1>

	<tr>	
		<th><?php echo 'Course Name'; ?></th>	
		<th><?php echo 'Amount'; ?></th>		
		<th><?php echo 'Remove'; ?></th>		
		<th><?php echo 'Total'; ?></th>	
	</tr>			
	
	<?php		
	if(isset($all_product) && is_array($all_product) && count($all_product) > 0)
	{       
		$j = 1;
		$all_ids = array();			
		foreach($all_product as $key=>$value)		
		{		
			$all_ids[] = $key;
		}
		$all_ids = implode(",", $all_ids);
		foreach($all_product as $key=>$value)					
		{						$price = 0;
			$total_price = 0;
			$course_details = $this->Buyitem_model->getCourseDetails($value["course_id"]);
			$course_plans = $this->Buyitem_model->getCoursePlans($value["course_id"], $value["plan"], $action);            ?>
			<tr id="row_<?php echo intval($value["course_id"]); ?>" class="por_dis">
				<td>	
					<ul>
						<?php
						if(isset($course_details["0"]["name"]))
						{
							echo '<li class="product_name">'.$course_details["0"]["name"].'</li>';
						}
						?>

					<li class="details"><strong><?php echo 'Select Plan:'; ?>:
						<?php
							//echo '<select onchange="update_cart('.$value["course_id"].', this.value, \''.$all_ids.'\', \''.trim($currencyChar).'\')" size="1" class="inputbox" id="plan_id'.$value["course_id"].'" name="plan_id['.$value["course_id"].']">';
							echo '<select onchange="update_cart('.$value["course_id"].', this.value, \''.$all_ids.'\', \''.trim($currencyChar).'\')" size="1" class="inputbox" id="plan_id" name="plan_id['.$value["course_id"].']">';
							if(isset($course_plans) && count($course_plans) > 0)
							{
								foreach($course_plans as $key_plam=>$value_plan)
								{
									$selected = "";
									if($value_plan["default"] == "1" && $value["value"] == "" && $value["plan"] == "buy")
									{
										$price = $value_plan["price"];
										$total_price = $price;
										$total += $total_price;
										$selected = ' selected="selected "';
									}
									elseif($value_plan["default"] == "1" && $value["value"] == "" && $value["plan"] == "renew")
									{
										$price = $value_plan["price"];
										$total_price = $price;
										$total += $total_price;
										$selected = ' selected="selected "';
									}
									elseif($value_plan["price"] == $value["value"])
									{
										$price = $value_plan["price"];
										$total_price = $price;
										$total += $total_price;
									   	$selected = ' selected="selected "';
									}
												if($currencypos == 0){
													echo '<option value="'.$value_plan["price"].'" '.$selected.' >'.$value_plan["name"].' - '.$currencyChar.' '.$value_plan["price"].'</option>';
												}
												else{
													echo '<option value="'.$value_plan["price"].'" '.$selected.' >'.$value_plan["name"].' - '.$value_plan["price"].' '.$currencyChar.'</option>';
												}
												
								}
							}
							echo '</select>';
							?>
							</strong></li>
							</ul>

                            <input type="hidden" name="plan_course_id" id="plan_course_id" value=<?php echo $value["course_id"];?> />
                            <input type="hidden" name="currencysym" id="currencysym" value=<?php echo trim($currencyChar);?> />
                            <input type="hidden" name="actualprice" id="actualprice" />
                            
                </td>
											
							<td align="center">
								<span class="cart_amount" id="cart_item_price<?php echo $value["course_id"]; ?>" >
									<?php 
									if($currencypos == 0){
										echo $currencyChar." ".$price; 
									}
									else{
										echo $price." ".$currencyChar; 
									}
									?>
								</span>
							</td>					
							
							<td align="center">
								<?php
									$action_for_request = "buy";
									if(trim($action) == "renew"){
										$action_for_request = "renew";
									}
								?>
								<input type="button" value=" " style="background:url(<?php echo base_url().'public/default/images/icons/icon_trash.png'; ?>) 0 0 no-repeat; width: 26px;" name="remove" onclick="javascript:removeCourse(<?php echo intval($value["course_id"]); ?>, '<?php echo intval($all_ids); ?>', '<?php echo $action_for_request; ?>', '<?php echo addslashes('Your cart is empty'); ?>', '<?php echo base_url().'category'; ?>', '<?php echo addslashes('click here to purchase'); ?>', '<?php echo trim($currencyChar); ?>', '<?php echo base_url(); ?>');" />
							</td>
							
							<td>
								<ul>
									<li class="cart_amount">
										<span id="cart_item_total<?php echo $value["course_id"]; ?>">
											<?php 
											if($currencypos == 0){
												echo $currencyChar." ".$total_price;
											}
											else{
												echo $total_price." ".$currencyChar;
											}
											 ?>
										</span>
									</li>
								</ul>	
							</td>												
						</tr>					
			<?php	
					$j = $j == 1 ? 2 : 1;
					}
				}
			?>
			<tr>
				<td width="45%">      <?php //print_r($promocode); ?>
					<ul>
					   <span class="details"><?php echo 'Promo code'; ?>:</span>
						<input type="text" class="textbox" value="<?php echo $promocode; ?>" name="promocode" id="promocode" />
				 <?php /* ?>		<input type="submit" class="button" value="<?php echo 'Re-Calculate'; ?>" name="Submit"  onclick="document.adminForm.task.value='updatecart'" />  <?php */ ?>
						<input type="button" class="button" value="<?php echo 'Re-Calculate'; ?>" name="Submit"  id='calDis'/> 
					</ul>
				</td>
				<td>
					 <span class="alt"></span>
				</td>
				<td id="discount_td">
               <?php //print_r($_SESSION); ?>
					<ul>
						<?php

                          //$discount_value = $this->session->userdata('discount_value');
                          $discount_value = $this->session->userdata('discount');
                          //print_r($discount_value);

					   //	if(isset($discount_value) && trim($discount_value) != "0"){
						?>
						<li class="cart_total"><?php echo 'Discount'; ?>:</li>
						<?php
					   //	}
						?>
						<li class="cart_total"><?php echo 'Total'; ?>:</li>
					</ul>
				</td>
				<td id="discount_td">
					<ul>
						<?php
						//if(isset($discount_value) && trim($discount_value) != "0"){
						?>
						<li class="cart_amount" id="disval">
                        <?php
                         	echo $currencyChar." ".trim($discount_value);
                        //echo trim($discount_value); ?>
                        </li>
						<?php
					   //	}
						?>
						<li class="cart_amount" id="max_total">

						<?php
							if(isset($_SESSION["promo_code"]) && trim($_SESSION["promo_code"]) != ""){
							    $this->session->set_userdata('courses_total',$total);
							   //	$total = $this->setPromoTest($total);
                               $total = $this->Buyitem_model->setPromoTest($total);
                              // print_r($total);
							   	//$total = $setPromoTest;
                               //print_r($setPromoTest);
								//$total = '';
							}
							if(trim($total) != ""){
								if(!isset($_SESSION["max_total"])){
									if($currencypos == 0){
										echo $currencyChar." ".$total;
									}
									else{
										echo $total." ".$currencyChar;
									}
								}
								elseif($_SESSION["max_total"] != $total){
									$_SESSION["max_total"] = $total;
									if($currencypos == 0){
										echo $currencyChar." ".$total;
									}
									else{
										echo $total." ".$currencyChar;
									}	
								}
								else{
									if($currencypos == 0){
										echo $currencyChar." ".$_SESSION["max_total"];
									}
									else{
										echo $_SESSION["max_total"]." ".$currencyChar;
									}	
								}
							}
						?>
						</li>
					</ul>
				</td>
			</tr>
<script>
price=0;
  $('#calDis').click(function(){

  //alert('<?php echo base_url();?>');

  //promocode=document.cartform.promocode.value;
  promocode=$('#promocode').val();
  planprice=$('#plan_id').val();
  currencysym=$('#currencysym').val();
  //alert(planprice);

  $.ajax({
           type: "POST",
           url: '<?php echo base_url();?>/buyitems/calculateDiscout',
           data:{promocode:promocode,planprice:planprice}
        }).done(function(data){
          pricearr=data.split('/');

          $('#disval').html(currencysym+' '+pricearr[0]);
          $('#max_total').html(currencysym+' '+pricearr[1]);

          //alert(pricearr[0]+' '+pricearr[1]);
        })
   })
</script>
			<tr>
				<td colspan="4">
					<table width="100%">
						<tr>
							<td width="100%" style="border:none !important;">
								<div style="float:left; margin-left:-8px;">
								<input type="button" class="continue_button" onclick="window.location='<?php echo base_url().'category'; ?>';" value="&lt;&lt; <?php echo 'Continue shopping'; ?>" name="continue"/>
								</div>
								<div style="float:right">
								<?php //echo $this->getPlugins(); ?>
                                Payment method: <select size="1" class="inputbox" name="processor" id="processor">
	<option value="paypaypal">PayPal Payment</option>
</select>
<input type="submit" class="checkout_button" id="checkout_button" value="<?php echo 'Checkout'; ?> &gt;&gt;" name="checkout"/>


<!--<input type="submit" class="checkout_button" id="checkout_button" value="<?php echo 'Checkout'; ?> &gt;&gt;" name="checkout" onclick="document.cartform.task.value='updatecart'"/>  -->
                              <!-- <a href="<?php echo base_url()?>/buyitems/paypal/" name="checkout_button">Checkout</a>     -->
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</div>

		<input type="hidden" name="task" value="checkout" />
		<input type="hidden" name="view" value="test" />
		<input type="hidden" name="order_id" id="order_id" value="<?php echo intval($order_id); ?>"/>
		<input type="hidden" value="<?php echo $action; ?>" id="action" name="action" />
	</form>
<?php
}
else{
	echo 'Your cart is empty'.", ".'<a href="'.base_url().'category">'.'click here to purchase'.'</a>';
}
?>
</div>