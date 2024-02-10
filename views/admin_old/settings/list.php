<div id="content-top">
    <h2>List Plans</h2>
    <a href='<?php echo base_url(); ?>/admin/subplans/create<?php //echo ($category_id != "")  ? $category_id : "0"?>/<?php //echo $page?>' class='bcreate'>Create Plans</a>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>/admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>	
    <?php endif ?>
    
    <span class="clearFix">&nbsp;</span>
</div>

<div class='clear'></div>
<div id="toolbar-box">
	<div class="m">
		<div class="toolbar-list" id="toolbar">
			<ul>
			<li class="button" id="toolbar-new">
			<a href="<?php echo base_url(); ?>/admin/subplans/create/" onclick="Joomla.submitbutton('edit')" class="toolbar">
			<span class="icon-32-new">
			</span>
			New
			</a>
			</li>

			<li class="button" id="toolbar-edit">
			<a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list');}else{ Joomla.submitbutton('edit')}" class="toolbar">
			<span class="icon-32-edit">
			</span>
			Edit
			</a>
			</li>

			<li class="button" id="toolbar-publish">
			<a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list');}else{ Joomla.submitbutton('publish')}" class="toolbar">
			<span class="icon-32-publish">
			</span>
			Publish
			</a>
			</li>

			<li class="button" id="toolbar-unpublish">
			<a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list');}else{ Joomla.submitbutton('unpublish')}" class="toolbar">
			<span class="icon-32-unpublish">
			</span>
			Unpublish
			</a>
			</li>

			<li class="button" id="toolbar-Are you sure you want to delete this plan?">
			<a href="#" onclick="if (document.adminForm.boxchecked.value==0){alert('Please first make a selection from the list');}else{if (confirm('Are you sure you want to delete this plan?')){Joomla.submitbutton('remove');}}" class="toolbar">
			<span class="icon-32-delete">
			</span>
			Delete
			</a>
			</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Plans Manager</h2></div>
	</div>
</div>
<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF" style="width:90%;">
		<tbody><tr>
			<td>
				<input type="text" value="" name="search_text">
				<input type="submit" value="Search" name="submit_search">
			</td>				
			<td>Published status
				<select name="course_publ_status" onchange="document.topform1.submit()">
					<option value="YN">- select -</option>
					<option value="Y">Published</option>
					<option value="N">Unpublished</option>
				</select>	
			</td>						
		</tr><tr>
	</tr></tbody></table>
	<table class="zone_description" style="width:90%;">
	<tbody><tr>
		<td style=" padding-left: 5px;">Here's where you set up subscription plans for your courses. You can keep the default plans or create new ones</td>
	</tr>
</tbody></table>
<table class="adminlist" style="width: 90%;">
	<thead>
		<tr>
			<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>
			<th width="20">ID</th>
			<th>Name</th>
			<th>Term</th>
			<th>Period</th>
			<th>Re-order<a href="javascript: saveorder(4, 'saveorder')" class="saveorder"></a></th>
			<th>Published</th>
			<th>Delete</th>
		</tr>
	</thead>
<?php if ($subplans): ?>	
<tbody>
<?php $i=0;?>
<?php foreach ($subplans as $palns): ?>
	<tr class="camp<?php echo $i;?>"> 	    
		<td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $palns->id?>"></td>
	    <td><?php echo $palns->id;?></td>		
	    <td><a href="<?php echo base_url(); ?>/admin/subplans/edit/<?php echo $palns ->id?>/<?php //echo ($category_id != "") ? $category_id : "0" ?>/<?php //echo $page?>">
			<?php echo $palns->name?></a></td>
		<td><?php echo $palns->term?></td>
		<td><a href="javascript:void(0)" class="a_mlms">
			<?php echo $palns->period?></a></td>
		
		<td align="center">
			<input type="text" style="text-align: center" class="text_area" value="<?php echo $palns->ordering;?>" size="5" name="order[2]">
		</td>
		<td align="center">
		<?php if($palns->published){?>	
		<a title="Unpublish Item" href="<?php echo base_url(); ?>/admin/subplans/unpublish/<?php echo $palns ->id?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>		</td>		
		<?php }else{?>
		<a title="Publish Item" href="<?php echo base_url(); ?>/admin/subplans/publish/<?php echo $palns ->id?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>		</td>		
		<?php }?>
		<td><a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>/admin/subplans/delete/<?php echo $palns->id?>/<?php echo $this->uri->segment(3)?>'>&nbsp;</a></td>
	</tr>
<?php endforeach ?>
	<tr>
		<td colspan="8"><div class="containerpg">
		<div class="pagination">
		<div class="limit">
			<label for="limit">Display # </label>
				<select size="1" class="inputbox" name="limit" id="limit">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option selected="selected" value="20">20</option>
				<option value="25">25</option>
				<option value="30">30</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="0">All</option>
				</select>
		<button onclick="Joomla.submitform()" type="button" id="pagination-go">Submit</button></div>

		<div class="limit"></div>
		<input type="hidden" value="0" name="limitstart">
		<div class="clr"></div></div></div>
		</td>
		</tr>

</tbody>

	<?php //echo $links; ?>

</table>
<?php else: ?>

	<p class='text'><?=lang('web_no_elements');?></p>

<?php endif ?>
