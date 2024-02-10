
<div id="all">
<div id="main">

<div id="system-message-container">
</div>
<?php $attributes = array('class' => 'tform', 'id' => '');
      echo form_open_multipart('tasks/buy_course', $attributes); ?>
	<table style="margin:10px;">
		<tbody><tr>
			<td>
				<b>
				<h2>You need to be a subscriber to access this lesson/file.</h2><p>Please select a subscription plan below and click Continue </p>				</b>
			</td>
		</tr>
	</tbody></table>

	<table style="margin-left:50px;">
		        	<tbody>
                    <?php foreach($plans as $plan){
                  //  print_r($plan);
                    ?>
                    <tr>
                            <td style="padding:0.5em;">
                            <input value="<?php echo $plan->plan_id ?>" <?php if(isset($plan->default) && $plan->default == '1') echo "checked"; ?> name="subscription_default" type="radio"></td>
                            <td style="padding:0.5em;"><?php echo $plan->term.' '.$plan->period ?></td><td style="padding:0.5em;"> <?php echo $plan->price; ?>

                            </td>
                        </tr>
                        <?php } ?>
			</tbody></table>
     <input type="hidden" name="planid" value="<?php echo $plan->plan_id;?>">
     <input type="hidden" name="less_id" value="<?php echo $less_id;?>">
    <input type="hidden" name="pro_id" value="<?php echo $pro_id;?>" >
	<input name="option" value="com_guru" type="hidden">
	<input name="controller" value="guruEditplans" type="hidden">
	<input name="task" value="buy" type="hidden">
	<input name="course_id" value="1" type="hidden">

	<br><br>
	<span style="margin:50px;">
	<input name="continue" class="guru_checkout_button" value="Continue >>" type="submit">
	</span>
<?php echo form_close();?>

		</div>
	</div>


