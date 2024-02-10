<style>
div.m {
  border: none!important;
  padding: 0 8px;
  background-color: #f4f4f4;
  -webkit-border-radius: 0px!important;
  -moz-border-radius: 0px!important;
  border-radius: 0px!important;
  width: 1140px;
  margin-right: auto;
  margin-left: auto; 
}
#toolbar-box, #submenu-box {
  background: #f4f4f4!important;
}
#toolbar-box .m {
  background: #f4f4f4;
  min-height: 90px!important;
  padding: 20px 0px 10px!important;
}
.icon-48-generic {
  padding-left: 0px !important;
  background-repeat: no-repeat;
  margin-left: 0px!important;
  width: 100%!important; 
}
.heading-style{
  text-transform: uppercase!important;
  font-size: 26px!important;
  color: #c42140!important;
  font-weight: 700!important;
  padding: 0!important;
  margin-left: 15px;
  margin-top: 0px;
  margin-bottom: 0px;
  line-height: 1!important;
}
form#proform {
  padding: 20px;
}
.bread-view {
  display: block;
  padding-top: 15px;
  margin-left: 15px;
  font-size: 12px;
}
.form-control {
  display: block;
  width: 120px!important;
  }
</style>

<?php
   

?>
<div id="toolbar-box">
	<div class="m">
		<!-- <div id="toolbar" class="toolbar-list">       
			<div class="clr"></div>
		</div> -->
		<div class="pagetitle icon-48-generic">
			<h2 class="heading-style">Pendings</h2>
			<div class="bread-view">
		<a href="base_url"><i class="entypo-home"></i></a>
		<span class="ng-hide">/ </span>
		<a href="<?php echo base_url(); ?>">Report Manager</a>

		<span class="ng-hide">/ </span>
		<a href="<?php echo base_url(); ?>">Pendings</a>

	</div> 
		</div>
	</div>
</div>


<div>
<div>
<?php
	$CI =& get_instance();
	$CI->load->model('Studreport_model');

	$attributes = array('class' => 'tform', 'id' => 'proform', 'method' => 'POST');
	echo form_open(base_url().'studreport/pendingSave', $attributes);
?>
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>   
		<tr role="row">
			<th style="width:30%;">Question Tag</th>
			<th style="width:30%;">Question</th>
			<th style="width:30%;">Given Answer</th>
			<th>Points</th>
			<th>Marks Given</th>
		</tr>
	</thead>
<?php
$attempt_code1 = '';	
	foreach($pendings as $pend)
	{	
		// echo"<pre>";
		// print_r($pend);
		//  $question_idArray= explode(',',$pend->quizzes_ids);
		//  echo"<pre>";
		//  print_r($question_idArray);
		//  echo $question_idArray[];
		$pendingQue = $this->Studreport_model->getPendingQuestion($pend->question_id, $pend->user_id, $pend->quiz_id, $pend->pid, $pend->attempt_code);
		?>
		<tr>
			<td style="width:30%;"><?php echo $pendingQue->question_tag;?></td>
			<td style="width:30%;"><?php echo $pendingQue->question;?></td>
			<td style="width:30%;"><?php echo $pendingQue->answers_gived ? $pendingQue->answers_gived :'<span style="color:red"> Not Attempted </span>' ;?></td>
			<td><input style='background: transparent;border: none;' type="text" class="form-control" id='txtPoints<?php echo $pend->question_id;?>' name='txtPoints<?php echo $pend->question_id;?>' value="<?php echo $pendingQue->points;?>"></td>
			<td><input type="text" onblur="notGreaterThanScore(<?php echo $pend->question_id;?>);" name="txtEnterScore<?php echo $pend->question_id;?>" id="txtEnterScore<?php echo $pend->question_id;?>" value="0" class="form-control" required placeholder="Enter Marks" ></td>
		</tr>
		<?php
		$attempt_code1 = $pend->attempt_code;
	}
?>
</table>
<?php
if(!empty($pendings))
{
	?>
<input type='hidden' name='txtGenerate' id='txtGenerate' value="<?php echo $user_id.'^'.$exam_id.'^'.$program_id.'^'.$attempt_code1;?>">
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
	function notGreaterThanScore(qid)
	{
		var preScore = parseFloat(document.getElementById('txtPoints'+qid).value);
		var postScore = parseFloat(document.getElementById('txtEnterScore'+qid).value);
		if(preScore < postScore)
		{			
			alert('Given Marks should not greater than Max Points');
			document.getElementById('txtEnterScore'+qid).value = 0;
			return false;
		}else
		{
			return true;
		}
	}
</script>