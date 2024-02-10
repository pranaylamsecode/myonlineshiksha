<?php 
$this->load->model('admin/programs_model');
/*echo '<pre>';
print_r($resultinfo);
echo '</pre>';*/
?>

<header>
       <section class="breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-sm-12">
         	<h2></h2>
	<h4>User Name : <?php echo $userinfo->first_name .' '. $userinfo->last_name;;?></h4>
       </div>
     </div>
   </div>
 </section>
</header>

<div class="page-container">
<div class="sidebar-menu sb-left">
	<ul id="main-menu" class="" style="min-height:895px;">
        
      </ul>
</div>

<div class="main-content" style="min-height: 820px;">
	<div class="row">
    	
	    <div class="sidebar-collapse sb-toggle-left" style="float:none; margin-top:5px; margin-left:20px; margin-bottom:10px;">
		<a href="#" class="sidebar-collapse-icon with-animation">
			<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
			<i class="entypo-menu"></i>
		</a>
		</div>
		
		<div class="panel-body with-table">
		<div class="row">

<?php
foreach($resultinfo as $quizzz) 
{
?>


<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th colspan=6 class="text-center"><b>User Quiz Result</b></th>
			</tr>
		</thead>		
		
		<tbody>

			<tr>
				<th class="text-center">ID</th>
				<td class="text-center"><?php echo $quizzz['id']?></td>
			</tr>
			
			<tr>
				<th class="text-center">Quiz ID</th>
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
				<th class="text-center">Quiz Name</th>
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
						error_reporting(0); 
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

</div></div></div></div></div>