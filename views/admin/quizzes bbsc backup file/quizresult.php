<?php 
$this->load->model('admin/programs_model');
/*
echo '<pre>';
print_r($userinfo);
echo '</pre>';
*/
?>
<div class="col-sm-6 invoice-right">
	<h2>Quizzes Results</h2>
	<h4>User Name : <?php echo $userinfo->first_name .' '. $userinfo->last_name;;?></h4>
	<h4>Course    : <?php echo $courseinfo->name;?></h4>
</div>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=6 class="text-center"><b>User Quiz Details</b></th>
			</tr>
		</thead>		
		
		<thead>
			<tr>
				<th class="text-center">ID</th>
				<th class="text-center">Quiz ID</th>
				<th class="text-center">Quiz Name</th>
				<th class="text-center">Date/Time Taken</b></th>
				<th class="text-center">Score</th>
				<th class="text-center">Show Quiz Result</th>
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
							echo $quizrept->name;
						?>
					</td>
					<td class="text-center"><?php echo $quizzz['date_taken_quiz']?></td>
					<td class="text-center"><?php echo $quizzz['score_quiz']?></td>	
					<td class="text-center"><a class="btn btn-blue" href='<?php echo base_url(); ?>admin/programs/viewresult/<?php echo $quizzz['id']; ?>/'>View</a></td>
				</tr>		
				<?php
			}
			?>
		</tbody>
</table>

