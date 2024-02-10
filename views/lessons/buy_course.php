
<?php //print_r($_POST['subscription_default']);
// echo $pro_plan_id = $_POST['subscription_default'];
// $getplan = $this->Tasks_model->getPlans($pro_plan_id);
//print_r($str);
?>
<?php
$attributes = array('class' => 'tform', 'id' => '');
echo form_open('/tasks/buy_course', $attributes);
?>

<?php //echo form_open('path/to/controller/update/function'); ?>

<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

<tr>
  <th>Select Plan</th>
  <th>QTY</th>
  <th>Item Description</th>
   <th>remove</th>
  <th style="text-align:right">Item Price</th>
  <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1; ?>

<?php
    // $items =$this->cart->contents(); 
 foreach ($this->cart->contents() as $items): ?>
      <?php //print_r($items);?>
	<?php echo form_hidden($i.'[rowid]', $items['rowid']);  ?>
     <?php //if($items['pro_id'] != $lesson_name['0']['id']){ ?>
	<tr id="row_<?php echo $items['id']; ?>">
       <td>
				  <ul>
					 <li class="mlms_product_name"> <?php //echo $lesson_name['0']['name']; ?></li>
                     <li class="mlms_details"><strong>
                     Select Plan:

             <select name="plan_id[6]" id="plan_id6" class="inputbox" size="1" onchange="update_cart(6, this.value, '6,7', '$')">
                <?php foreach($getplans as $getplan){ ?>
                <option value="67" <?php if($getplan->name == $plans->name) echo "selected"; ?>>
                <?php echo $getplan->name.'-'.$getplan->price; ?>
                </option>
                <?php } ?>
             </select>									</strong></li>
								</ul>
							</td>
	  <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
	  <td>
		<?php echo $items['name']; ?>

			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

				<p>
					<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

						<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

					<?php endforeach; ?>
				</p>

			<?php endif; ?>

	  </td>
      <td align="center">
      <a href="<?php echo base_url() ?>/tasks/remove/<?php echo $items['rowid']?>">remove</a>
		  <!--<input type="image" onclick="javascript:removeCourse(6, '6', 'buy', 'Your cart is empty', '/Joomla_test/index.php?option=com_guru&amp;view=gurupcategs', 'click here to purchase', '$');" name="remove" src="http://localhost/Joomla_test/components/com_guru/images/icons/icon_trash.png">-->
							</td>
	  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
	  <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
	</tr>
    <?php //} ?>
<?php $i++; ?>

<?php endforeach; ?>

<tr>
  <td colspan="2"> </td>
  <td class="right"><strong>Total</strong></td>
  <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
</tr>

</table>

<p><?php echo form_submit('', 'Update your Cart'); ?></p>


