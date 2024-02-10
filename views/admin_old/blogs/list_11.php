<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul>
			<li id="toolbar-new" class="listbutton">
            <a href="<?php echo base_url(); ?>admin/users/create/" onclick="Joomla.submitbutton('edit')" class="toolbar">
			<span class="icon-32-new">
			</span>
			New
			</a>
			</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Blogs Manager';?></h2></div>
	</div>
</div>
<div class='clear'></div>

<table class="adminlist" width="100%">
	<thead>
		<tr>
			<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>
			<th width="20">ID</th>
			<th>order_date</th>
			<th>Price</th>
			<th>User Name</th>
			<th>Student</th>
			<th>Status</th>
			<th>Payment Method</th>
			<th>Options</th>
		</tr>
	</thead>
<?php if ($orders):

//print_r($orders);
?>
<tbody>
<?php $i=0;?>
	<?php foreach ($orders as $order): ?>
	<tr class="camp<?php echo $i;?>">
        <td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $order->id?>"></td>
        <td><?php echo $order->id;?></td>
        <td><?php echo $order->order_date?></td>
        <td><?php echo $order->amount?></td>
        <td>
        <a href="<?php echo base_url();?>admin/users/edit/<?php echo $order->userid?>"><?php echo $order->username?></a>
        </td>
		<td><?php echo $order->first_name.' '.$order->last_name?></td>
		<td><?php echo $order->status;?></td>
		<td><?php echo $order->processor;?></td>
		<td><a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/orders/delete/<?php echo $order->id?>'><?php echo lang('web_delete')?></a>  </td>
	</tr>
<?php endforeach ?>
	<tr>
		<td colspan="9">
            <div class="containerpg">
        		<div class="pagination">
                       <?php echo $this->pagination->create_links();  ?>
        		</div>
    		</div>
		</td>
   </tr>
</tbody>


</table>
<?php else: ?>

	<p class='text'><?=lang('web_no_elements');?></p>

<?php endif ?>
