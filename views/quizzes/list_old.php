<script>
function saveorder(n, task) {
  //alert(n);

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
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
?>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
<?php
if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
{
?>
			<ul>
			<li id="toolbar-new" class="listbutton">
            <a href="<?php echo base_url(); ?>admin/quizzes/newque" onclick="Joomla.submitbutton('edit')" class="toolbar">
			<span class="icon-32-new">
			</span>
			New
			</a>
			</li>
			</ul>
<?php
}
?>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Quiz Manager';?></h2></div>
	</div>
</div>
<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>
<!--<form action="<?=site_url('admin/quizzes/')?>" method="post"> -->
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('admin/quizzes/',$attributes);
?>
<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF" style="width: 100%;">
		<tbody><tr>
			<td>
               	<input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">

				<input type="submit" value="Search" name="submit_search">
				<input type="submit" value="Reset" name="reset">

			</td>
			<td>
				Select type
				<select name="type" size="1" class="inputbox" onchange="document.topform1.submit()">
                <option value="">- select -</option>
				<option value="0">Quizzes</option>
				<option value="1">Final Exams</option>
				 </select>
			</td>

			<td>
				Published status
                <select name="status" onchange="document.topform1.submit()">
				<option value="">- select -</option>
                <option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>
				<option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>
				</select>
			</td>

		</tr><tr>
	</tr></tbody></table>
<?php echo form_close(); ?>
	<div class="zone_description">Here you can manage your quizzes. Watch the video on the right side to learn how to create a new quiz</div>
<table class="adminlist" width="100%">
	<thead>
		<tr>
			<!--<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>-->
			<th width="20">ID</th>
			<th>Quiz</th>
			<th>Questions</th>
            <!--<th>Students</th>
			<th>Export</th>-->
			<!--<th>Re-order<a href="javascript: saveorder(4, 'saveorder')" class="saveorder"></a></th>   -->
            <th>Re-order<a class="saveorder" href="javascript: saveorder(<?php echo count($quizzes)-1; ?>, 'saveorder')">__</a></th>
			<th>Published</th>
		   	<th width="120">Options</th>
		</tr>
	</thead>
<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart('admin/quizzes/',$attributes);
?>
<?php if ($quizzes): ?>

<tbody>
<?php $i=0;?>
<?php foreach ($quizzes as $quiz): ?>
    <tr class="camp<?php echo $i;?>">
		<!--<td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $quiz->id?>">--><!--</td> -->  
	    <td><?php echo $quiz->id;?></td>
	    <td>
        <?php if($quiz->is_final == '1'){  ?>
       <?php /* ?> <a href="<?php echo base_url(); ?>admin/quizzes/editFinalQuiz/<?php echo $quiz ->id?>/"> <?php */ ?>
			<?php echo $quiz->name?>

       <?php /* ?>     </a> <?php */ ?>

        <?php }else{?>

       <?php /* ?> <a href="<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz ->id?>/"> <?php */ ?>
			<?php echo $quiz->name?>

       <?php /* ?></a><?php */ ?>
         <?php } ?>
        </td>
		<td><?php echo $this->quizzes_model->get_count_questions($quiz->id)?></td>
       <!--	<td></td>
		<td align="center"></td>-->
		<td align="center">
         <input type="text" name="order[<?php echo $quiz->id; ?>]" size="5" value="<?php echo $quiz->ordering ; ?>" class="text_area" style="text-align: center" />
         <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $quiz->id;?>" class="text_area" style="text-align: center" />
		</td>
		<td align="center">
<?php
if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
{
?>
		<?php if($quiz->published){?>
		<a title="Unpublish Item" href="<?php echo base_url(); ?>admin/quizzes/unpublish/<?php echo $quiz ->id?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>
		<?php }else{?>
		<a title="Publish Item" href="<?php echo base_url(); ?>admin/quizzes/publish/<?php echo $quiz ->id?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>
		<?php }?>
<?php
}
else
echo "No Access";
?>
        </td>
        <td align="center">
<?php
if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
{
?>
        <?php if($quiz->is_final == 0){?>
        <a class='ledit' href='<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz->id?>'><?php echo lang('web_edit')?>
        </a>
        <?php }else{ ?>
        <a class='ledit' href='<?php echo base_url(); ?>admin/quizzes/editFinalQuiz/<?php echo $quiz->id?>'><?php echo lang('web_edit')?>
        </a>
        <?php } ?>

        <a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/quizzes/delete/<?php echo $quiz->id?>'><?php echo lang('web_delete')?></a>
<?php
}
else
echo "No Access";
?>
        </td>

	</tr>
<?php endforeach ?>

</tbody>
 <?php echo form_close(); ?>
</table>
<div class="containerpg"><div class="pagination">
             <?php echo $this->pagination->create_links();  ?>
</div></div>
<?php else: ?>

	<p class='text'><?=lang('web_no_elements');?></p>

<?php endif ?>
