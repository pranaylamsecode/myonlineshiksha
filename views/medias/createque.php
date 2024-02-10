<base href="<?php echo $this->config->item('base_url') ?>/public/" />

<script>
function checkvalid(){
        var i;
        var completed;
	   	for(i=1; i<=10; i++){
		  if(document.getElementById('a'+i).value!='')
					completed = i;
		}
		var existing_answer = 0;
		for(i=1; i<=completed; i++){

		  if(document.getElementById(i+'a').checked == true){
				existing_answer = 1;
			}
		}
	   	if (document.checkque.text.value=='') {
		  	alert("Please enter the question text.");
			return false;
		}
	   if (document.checkque.a1.value=='') {
			alert("You must have at least one answer for your question");
			return false;
	   }
       for(i=1; i<=10; i++){
       if (document.getElementById(i+'a').checked == true &&  document.getElementById('a'+i).value=='')       {
  		  	alert("Please enter the answer text.");
  			return false;
  	   }}
  	   if (existing_answer == 0) {
  			alert("Please check at least one answer as the correct answer");
  			return false;
  	    }

 return true;
}
</script>


<link rel="stylesheet" href="css/colour_standard.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<?php
$attributes = array('class' => 'tform', 'id' => 'checkque', 'name' => 'checkque', 'onsubmit' => 'return checkvalid();');
echo ($updType == 'create') ? form_open(base_url().'/admin/quizzes/createque/', $attributes) : form_open(base_url().'/admin/quizzes/editque/'.$question->id.'/'.$qid, $attributes);
?>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul>
			<li id="toolbar-new" class="listbutton">
			<a>
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "" : "", (($updType == 'create') ? "id='submit' class='save_btn'" : "id='submit' class='save_btn'") ); ?><br />Save
			</a>
			</li>
            <li id="toolbar-new" class="listbutton">
            <a href='<?php echo base_url(); ?>/admin/quizzes/create/' class='bforward' id="forward" onclick="window.parent.location.href = '<?php echo base_url(); ?>/admin/quizzes/create/';">
<span class="icon-32-cancel"></span>Cancel</a>
			</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Select Questions';?></h2></div>
	</div>
</div>
<div>
    <h2><?php ($updType == 'create') ? "Create Lesson" : "Edit Lesson";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2>
</div>  

<table cellspacing="0" cellpadding="0" border="0">
		<tbody><tr>
			<td width="60%" nowrap="" style="border-bottom:1px solid #cccccc;">
				<label class='labelform' for="text"><?php echo 'Question'//echo lang('web_name')?> <span class="required">*</span></label>
			</td>
			<td width="40%" nowrap="" style="border-bottom:1px solid #cccccc;">
				<strong>Answer</strong>
				&nbsp;(Check the box next to each correct answer)
			</td>
		</tr>
		<tr>
			<td valign="top" align="left" style="border-bottom:1px solid #cccccc;padding: 5px;">
				<textarea id="text" name="text" cols="40" rows="7"><?php echo set_value('text', (isset($question->text)) ? $question->text : ''); ?></textarea>
               <div id="que_error"> </div>
                <span>
                <?php echo form_error('text'); ?>
                </span>
				<br><br><br><br><br>
				<!--<input type="image" src="" onclick="addquestion()">-->
				<?php //echo form_submit( 'submit', ($updType == 'edit') ? lang('web_question_edit') : lang('web_add_question'), (($updType == 'create') ? "id='submit' class='bcreateform'" : "id='submit' class='beditform'") ); ?>
			</td>
			<?php
				$icarray = array();
				if(isset($question->answers)):
				$icstring = $question->answers;
				$icarray = explode('|||',$icstring);
				endif;
			?>
			<td valign="top" style="border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;">
				<table cellspacing="2" cellpadding="2">
					<tbody><tr>
						<td>1</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a1', (isset($question->a1)) ? $question->a1 : ''); ?>" id="a1" name="a1">
 <span class="error"><?php echo form_error('a1'); ?></span>

&nbsp;<input type="checkbox" <?php echo (in_array('1a',$icarray))? 'checked' : ''; ?> id="1a" name="1a">

						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a2', (isset($question->a2)) ? $question->a2 : ''); ?>" id="a2" name="a2">&nbsp;<input type="checkbox" <?php echo (in_array('2a',$icarray))? 'checked' : ''; ?> id="2a" name="2a">
						</td>
					</tr>
					<tr>
						<td>3</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a3', (isset($question->a3)) ? $question->a3 : ''); ?>" id="a3" name="a3">&nbsp;<input type="checkbox" <?php echo (in_array('3a',$icarray))? 'checked' : ''; ?> id="3a" name="3a">
						</td>
					</tr>
					<tr>
						<td>4</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a4', (isset($question->a4)) ? $question->a4 : ''); ?>" id="a4" name="a4">&nbsp;<input type="checkbox" <?php echo (in_array('4a',$icarray))? 'checked' : ''; ?> id="4a" name="4a">
						</td>
					</tr>
					<tr>
						<td>5</td>
						<td><input type="text" size="32" value="<?php echo set_value('a5', (isset($question->a5)) ? $question->a5 : ''); ?>" id="a5" name="a5">&nbsp;<input type="checkbox" <?php echo (in_array('5a',$icarray))? 'checked' : ''; ?> id="5a" name="5a">
						</td>
					</tr>
					<tr>
						<td>6</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a6', (isset($question->a6)) ? $question->a6 : ''); ?>" id="a6" name="a6">&nbsp;<input type="checkbox" <?php echo (in_array('6a',$icarray))? 'checked' : ''; ?> id="6a" name="6a">
						</td>
					</tr>
					<tr>
						<td>7</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a7', (isset($question->a7)) ? $question->a7 : ''); ?>" id="a7" name="a7">&nbsp;<input type="checkbox" <?php echo (in_array('7a',$icarray))? 'checked' : ''; ?> id="7a" name="7a">
						</td>
					</tr>
					<tr>
						<td>8</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a8', (isset($question->a8)) ? $question->a8 : ''); ?>" id="a8" name="a8">&nbsp;<input type="checkbox" <?php echo (in_array('8a',$icarray))? 'checked' : ''; ?> id="8a" name="8a">
						</td>
					</tr>
					<tr>
						<td>9</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a9', (isset($question->a9)) ? $question->a9 : ''); ?>" id="a9" name="a9">&nbsp;<input type="checkbox" <?php echo (in_array('9a',$icarray))? 'checked' : ''; ?> id="9a" name="9a">
						</td>
					</tr>
					<tr>
						<td>10</td>
						<td>
							<input type="text" size="32" value="<?php echo set_value('a10', (isset($question->a10)) ? $question->a10 : ''); ?>" id="a10" name="a10">&nbsp;<input type="checkbox" <?php echo (in_array('10a',$icarray))? 'checked' : ''; ?> id="10a" name="10a">
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
	</tbody></table>
	<?php echo form_hidden('qid',$qid) ?>
	<?php echo form_hidden('queid',$queid) ?>
<?php if ($updType == 'edit'): ?>
<?php endif ?>
<?php echo form_close(); ?>