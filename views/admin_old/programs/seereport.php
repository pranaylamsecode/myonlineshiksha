<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php 
$this->load->model('admin/programs_model');
$certidetailarr=array('1'=>'No Certificate','2'=>'Complete all the lessons','3'=>'Pass the Final exam','4'=>'Pass The Exams In Average','5'=>'Finish All Lessons And Pass Final Exam','6'=>'Finish All Lessons And Exams In Average');
error_reporting(0);
?>
<div class="main-container">
<div id="toolbar-box">
<div class="m">
<div id="toolbar" class="toolbar-list">


<ul style="list-style:none; float: right;">
<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
				<a href="<?php echo base_url(); ?>admin/programs/enrolled/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">
				<span class="icon-32-new">
				</span>
				Back To List</a>
				</li>
</ul>


<div class="clr"></div>
</div>

		<div class="pagetitle icon-48-generic"><h2>Report Manager</h2></div>
		<h4><?php echo $courseinfo->name;?></h4>

	</div>

</div>

<div style="text-align:center; margin-bottom:5px;">

</div>

<!--<div class="col-sm-6 invoice-right">
	<h2>Report Manager</h2>
	<h4><?php echo $courseinfo->name;?></h4>
</div>-->

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan="2" class="text-center"><b>User Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td width="50%" class="text-center">User ID</td>
				<td><?php echo $userinfo->id; ?></td>
			</tr>			
			<tr>
				<td width="50%" class="text-center">User Name</td>
				<td><?php echo $userinfo->username; ?></td>				
			</tr>			
			<tr>
				<td width="50%" class="text-center">Full Name</td>
				<td><?php echo $userinfo->first_name .' '. $userinfo->last_name; ?></td>				
			</tr>			
			<tr>
				<td width="50%" class="text-center">Email</td>
				<td><?php echo $userinfo->email; ?></td>				
			</tr>			
		</tbody>
</table>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan="2" class="text-center"><b>Course Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td width="50%" class="text-center">Course ID</td>
				<td><?php echo $courseinfo->id; ?></td>
			</tr>			
			<tr>
				<td width="50%" class="text-center">Trainer</td>
				<td><?php echo (($courseinfo->author)?$this->programs_model->getUserName($courseinfo->author):'');?></td>				
			</tr>			
			<tr>
				<td width="50%" class="text-center">Has Final Exam</td>
				<td><?php echo (($courseinfo->id_final_exam)?'Yes':'No');?></td>				
			</tr>			
			<tr>
				<td width="50%" class="text-center">Has Certificate</td>
				<td><?php echo (($courseinfo->certificate_term=='1')?'No':'Yes');?></td>				
			</tr>			
		</tbody>
</table>

<table class="table table-bordered">
		<?php
			if($courseinfo->id_final_exam)
			{
		?>
		<thead>
			<tr>
				<th colspan=6 class="text-center"><b>Exam Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td colspan=3 class="text-center">Final Exam Completed</td>
				<td colspan=3>Yes</td>
			</tr>	
		</tbody>

		<?php
			}
		?>

		<thead>
			<tr>
				<th class="text-center">Exam Name</th>
				<th class="text-center">Max Score(%)</th>
				<th class="text-center">Exam Score(%)</th>
				<th class="text-center">Result</th>
				<th class="text-center">Exam On</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>	
		
		<tbody>
		<?php 
		foreach($coursequizinfo as $eachquiz)
        {
		?>
			<tr>
				<td><?php echo ucfirst($this->programs_model->getQuizNameById($eachquiz['quiz_id']));?></td>				
				<td><?php echo $maxscore=$this->programs_model->getQuizMaxScoreById($eachquiz['quiz_id']);?></td>
				<td><?php
                    list($rq,$tq)=explode('|',$eachquiz['score_quiz']);
                    if($rq == '0' || $tq == '0')
                    {
                      echo '0';
                    }
                    else
                    {
                       $avg=($rq/$tq)*100;
                       echo round($avg,2);
                    }
                    ?></td>
				<td>
				<?php
                    if($avg >= $maxscore)
                    {
                      echo "Pass";
                    }
                    else
                    {
                      echo "Fail";
                    }
                ?></td>
				<td><?php echo $eachquiz['date_taken_quiz']; ?></td>
				<td><?php
                $webcamstatus=$this->programs_model->checkWebcamStatus($eachquiz['pid']);
                if($webcamstatus)
                {
                    if($eachquiz['snapfoldername'] !='')
                    {
                    ?>
                    <a href="<?php echo base_url(); ?>admin/studreport/viewsnap/<?php echo $eachquiz['snapfoldername'];?>" style='text-decoration:none' class='fancybox fancybox.iframe'>View Snap</a>
					<?php
                    }
                    else
                    {
                      echo "No Snaps";
                    }
                }
                else
                {
                    echo "No Snaps";
                }
                ?></td>
			</tr>		
		<?php
		}
		?>
		</tbody>
</table>

<?php
	if($certterm != 1)
	{
?>
<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=2 class="text-center"><b>Certificate Details<b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td class="text-center">Certificate Term</td>
				<td><?php 
					 $ct=$courseinfo->certificate_term;
                    echo $certidetailarr[$ct];
					?></td>
			</tr>			
			<tr>
				<td class="text-center">Status</td>
				<td>Satisfied</td>				
			</tr>	
<?php
$certiStatus=$this->programs_model->checkCertificateStatus($userinfo->id,$courseinfo->id);
//print_r($certiStatus);
if($certiStatus)
{
?>
<tr>
<td class="text-center">Issued</td>
<td align='left'>Yes</td>
</tr>
<tr>
<td class="text-center">Issued By</td>
<td align='left'><?php echo $this->programs_model->getUserName($certiStatus->issued_by); ?></td>
</tr>
<tr>
<td class="text-center">Issued On</td>
<td align='left'><?php echo $certiStatus->issued_on ?></td>
</tr>

<tr>
<td></td>
<td align='left'>
<a href="<?php echo base_url(); ?>admin/studreport/rejectcerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Reject Certificate</a>
</td>
</tr>
<?php
}
else
{
?>
<tr>
<td></td>
<td align='left'>
<a href="<?php echo base_url(); ?>admin/studreport/aprovecerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Approve Certificate</a>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php
	}
?>
</div>