<?php 
$this->load->model('admin/programs_model');
/*
echo '<pre>';
print_r($userinfo);
echo '</pre>';

echo '<pre>';
print_r($courseinfo);
echo '</pre>';

echo '<pre>';
print_r($coursequizinfo);
echo '</pre>';

echo '<pre>';
print_r($quizinfo);
echo '</pre>';
*/
?>
<div class="col-sm-6 invoice-right">
	<h2>Exams Results</h2>
	<h4>User Name : <?php echo $userinfo->first_name .' '. $userinfo->last_name;;?></h4>
	<h4>Course    : <?php echo $courseinfo->name;?></h4>
</div>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=6 class="text-center"><b>User Exam Details</b></th>
			</tr>
		</thead>		
		
		<thead>
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">Exam ID</th>
				<th class="text-center">Exam Name</th>
				<th class="text-center">Date/Time Taken</b></th>
				<th class="text-center">Score</th>
				<th class="text-center">Show Exam Result</th>
			</tr>
		</thead>	
		
		<tbody>
			<?php
			foreach($quizinfo as $quizzz)
			{
				?>
				<tr>
					<td class="text-center"><?php echo $quizzz['id']?></td>
					<td class="text-center"><?php echo $quizzz['quiz_id']?></td>
					<td class="text-center">
						<?php
							$quizrept = $this->programs_model->getQuiz($quizzz['quiz_id']);		
							echo ucfirst($quizrept->name);
						?>
					</td>
					<td class="text-center"><?php echo $quizzz['date_taken_quiz']?></td>
					<td class="text-center"><?php echo str_replace('|','/',$quizzz['score_quiz'])?></td>	
					<td class="text-center"><a class="btn btn-blue" href='<?php echo base_url(); ?>admin/programs/viewresult/<?php echo $quizzz['user_id']; ?>/<?php echo $quizzz['quiz_id']; ?>/'>View</a></td>
				</tr>		
				<?php
			}
			?>
		</tbody>
</table>