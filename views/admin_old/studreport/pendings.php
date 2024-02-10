<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">       
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Pendings</h2></div>
	</div>
</div>


<div>
<div>
<?php
	$CI =& get_instance();
	$CI->load->model('admin/Studreport_model');
	$countPend = count($pendings);
	$attributes = array('class' => 'tform', 'id' => 'proform', 'method' => 'POST', 'onsubmit' => 'return notGreaterThanScore('.$countPend.');');
	echo form_open(base_url().'admin/studreport/pendingSave', $attributes);
?>
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>   
		<tr role="row">
			<th>Question Tag</th>
			<th>Question</th>
			<th style="width: 50%;">Given Answer</th>
			<th style='width:65px'>Points</th>
			<th style="width: 11%;">Marks Given</th>
		</tr>
	</thead>
<?php	
$textcount = 1;
	foreach($pendings as $pend)
	{
		$pendingQue = $this->Studreport_model->getPendingQuestion($pend->question_id, $pend->user_id, $pend->quiz_id, $pend->pid, $pend->attempt_code);
		?>
		<tr>
			<td><?php echo $pendingQue->question_tag;?></td>
			<td><?php echo $pendingQue->question;?></td>
			<td style="width: 50%;"><?php echo $pendingQue->answers_gived ? $pendingQue->answers_gived :'<span style="color:red"> Not Attempted </span>' ;?></td>
			<td><input style='background: transparent;border: none;' type="text" class="form-control" name='txtPoints<?php echo $pend->question_id;?>' id='txtPoints<?php echo $textcount;?>' value="<?php echo $pendingQue->points;?>"></td>
			<td style="width: 11%;"><input type="text" name="txtEnterScore<?php echo $pend->question_id;?>" id="txtEnterScore<?php echo $textcount;?>" value="0" class="form-control" required placeholder="Enter Marks" ></td>
		</tr>
		<?php
		$attempt_code1 = $pend->attempt_code;
		$textcount++;
	}
?>
</table>
<?php
if(!empty($pendings))
{
	?>
	<input type='hidden' name='txtGenerate' id='txtGenerate' value="<?php echo $user_id.'^'.$exam_id.'^'.$program_id.'^'.@$attempt_code1;?>">
	<input type='submit' class='btn btn-success' value='Save' name='btnButton' id='btnButton'>
	<?php
}else
{
	echo 'No pending questions...';
}
?>
<?php echo form_close();?></div>
<div class="clr"></div>

<script type="text/javascript">
	function notGreaterThanScore(countPend)
	{
		for(var iii=1;iii<=countPend;iii++)
		{
			var preScore = parseInt(document.getElementById("txtPoints"+iii).value);
			var postScore = parseInt(document.getElementById("txtEnterScore"+iii).value);

			//alert(preScore);
			//alert(postScore);
			if(preScore < postScore)
			{	
				alert('Given Marks should not greater than Max Points');
				document.getElementById("txtEnterScore"+iii).value = 0;
				return false;
			}else
			{
				return true;
			}
		}		
	}
</script>