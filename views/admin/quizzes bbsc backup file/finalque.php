<div id="content-top">
    <h2><?php ($updType == 'create') ? "Create Lesson" : "Edit Lesson";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2>
    <a href='<?php echo base_url(); ?>admin/days/<?php echo $pid?>' class='bforward'><?php echo lang('web_back_to_list')?></a>
    <span class="clearFix">&nbsp;</span>
</div>

<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open(base_url().'admin/quizzes/createque', $attributes) : form_open(base_url().'admin/quizzes/editque/'.$question->id.'/'.$qid, $attributes); 
?>
<?php echo form_submit( 'submit', ($updType == 'edit') ? lang('web_category_edit') : lang('web_category_create'), (($updType == 'create') ? "id='submit' class='bcreateform'" : "id='submit' class='beditform'") ); ?>
<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF" style="width: 78%;">
		<tbody><tr>
			<td>
				<input type="text" value="" name="search_text">
				<input type="submit" value="Search" name="submit_search">
			</td>						
		</tr></tbody>
</table>

<table class="adminlist">
	<thead>
		<tr>
			<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>
			<th width="20">ID</th>
			<th>Name</th>
		</tr>
	</thead>
	
<?php if ($quizzes): ?>
<tbody>
<?php $i=0;?>
<?php foreach ($quizzes as $quiz): ?>
	<tr class="camp<?php echo $i;?>"> 	    
		<td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $quiz->id?>"></td>
	    <td><?php echo $quiz->id;?></td>		
	    <td><?php echo $quiz->name?></td>
	</tr>
<?php endforeach ?>
	
</tbody>
	<?php //echo $links; ?>

</table>

<?php else: ?>

	<p class='text'><?=lang('web_no_elements');?></p>
<?php echo form_hidden('qid',$qid) ?>	
<?php endif ?>
<?php echo form_close(); ?>