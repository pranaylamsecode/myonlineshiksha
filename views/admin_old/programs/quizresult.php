<?php 
$this->load->model('admin/programs_model');
/*echo '<pre>';
print_r($resultinfo);
echo '</pre>';*/
error_reporting(0);
?>
<div class="col-sm-6 invoice-right">
	<h2>Exam Result</h2>
	<h4>User Name : <?php echo $userinfo->first_name .' '. $userinfo->last_name;;?></h4>
</div>
<?php
foreach($resultinfo as $quizzz) 
{
?>
<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=6 class="text-center"><b>User Exam Result</b></th>
			</tr>
		</thead>		
		
		<tbody>

			<tr>
				<th class="text-center">ID</th>
				<td class="text-center"><?php echo $quizzz['id']?></td>
			</tr>
			
			<tr>
				<th class="text-center">Exam ID</th>
				<td class="text-center"><?php echo $quizzz['quiz_id']?></td>
			</tr>
			
			<tr>
				<th class="text-center">Course</th>
				<td class="text-center">
					<?php
						$quizrept = $this->programs_model->getProgramName($quizzz['pid']);
						echo ucfirst($quizrept);
					?>
				</td>
			</tr>
			
			<tr>
				<th class="text-center">Exam Name</th>
				<td class="text-center">
					<?php
						$quizrept = $this->programs_model->getQuiz($quizzz['quiz_id']);		
						echo ucfirst($quizrept->name);
					?>
				</td>
			</tr>
			
			<tr>
				<th class="text-center">Date/Time Taken</th>
				<td class="text-center"><?php echo $quizzz['date_taken_quiz']?></td>
			</tr>
			
			<tr>
				<th style="color:red" class="text-center">Score(%)</th>
				<td style="color:red" class="text-center">
						<?php  
						list($rq,$tq)=explode('|',$quizzz['score_quiz']);
						if($rq == '0' || $tq == '0')
						{
						  echo '0';
						}
						else
						{
						   $avg=($rq/$tq)*100;
						   echo round($avg,2);
						}
						?>
				</td>
			</tr>	
				<?php
			}
			?>
		</tbody>
</table>

