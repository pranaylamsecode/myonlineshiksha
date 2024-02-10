<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
	.rep_msg{
		text-align: center;
	}
	.btn{
		margin-bottom: 60px!important;
		margin-top: 30px;
	}
	.QuesList{
		margin-bottom: 10px;
	}
	.QuesList ol {
	font-size: 16px;
	margin: 10px 0px 15px 0px;
}
.Qtitle {
	font-size: 19px;
}
.QuesList .answer {
	color: #333 !important;
	text-transform: none;
	font-size: 16px;
}
.QuesList .correct_ans {
	color: #333 !important;
	text-transform: none;
	font-size: 16px;
}
.QuesList {
	border-bottom: 1px solid #ddd;
	padding: 20px 50px;
}
.QuesList ol li {
	line-height: 1.7em;
}
.innner_final_submit_txt {
    text-align: center;
}
.asset-container{
	height: 90%;
}
.thx_msg{
	text-align: center;
	display: block!important;
}
</style>
<div class="final_submit_txt">
	<!-- <h3>Thank you for attending the assessment.</h3> -->
	<h3 class="thx_msg"><?php echo $msg; ?></h3>
	<div class="innner_final_submit_txt">


		<?php if($show_result == '1'){ ?>
		
		<h2><span><?php echo $obt_marks ? round($obt_marks) : '0'; ?></span></h2>
		
		<p>Score Out Of <span> <?php echo $examinfo->total_marks; ?></span></p>

		
			 <!-- <?php // $pr = floatval($obt_marks*100)/$examinfo->total_marks; ?> -->
			<!-- <div class="correction_sect">
				<div class="correct"><p class="result_green">0</p><p>Correct</p></div>
				<div class="incorrect"><p class="result_red">0</p><p>InCorrect</p></div>
				<div class="skipped"><p class="result_silver">20</p><p>Skipped</p></div>
			</div> -->
			<h2><span>You have got <?php echo round($pr).'%'; ?></span></h2>
			<h2><span><?php echo $status;
			// if($examinfo->passing_score < $pr) echo "PASS"; else echo "fail"; 
			?></span></h2> 
		<?php }
		 if($show_result == '2'){ ?>
			  

					<h2><span>Your result is in hold!</span></h2>
		<?php	}
		 ?>

	</div>
	

		<?php 
		
		if($examinfo->exam_type == 1)
		{ 
			?>
			<div>
				<h3>Your Attempt</h3>

				<?php 
				 $examQue = $this->exam_model->getExamQues($examinfo->exam_id);
				 $i=0;
				 foreach ($examQue as $ques) { 
				 	$i++;
				 	 $array = json_decode($ques->options);
				 	 // print_r($array);
				 	 $submitedQue = $this->exam_model->getsubmitedQue($ques->que_id,$attempt,$examinfo->exam_id,$stud_id,$program_id);
				 	 // print_r($submitedQue);
				 	 ?>
				 	<div class="QuesList">
				 		<span class="Qtitle"><?php echo $i.') '.$ques->que_title ?></span>
				 		
				 		<?php $stud_ans_color = '';
				 		$correct = false;
				 		$corr_ans = '';
				 		if($ques->que_type == 'subjective')
				 		{
				 			$stud_ans_color = '';
				 		}
				 		else{
				 			echo "<ol>";
				 		 foreach ($array as $arr) {
				 			foreach ($arr as $key => $que_option) {

				 			if($ques->que_type == 'mcq'){
				 					$string = $submitedQue->stud_given_ans;
									$stringParts = str_split($string);
									$comp = sort($stringParts);
									$right_res = implode('', str_replace('_','',$stringParts));
									if(str_replace('_','',$ques->correct_ans) == $right_res){
			 							$correct = true;
			 						}
			 						else{
			 							$correct = false;
			 						}
			 						if(in_array($key,str_split($ques->correct_ans)))
			 						{
			 							$stud_ans_color = 'green';
			 							$corr_ans .= $que_option.", ";
			 						}
			 						else
			 						{
			 							$stud_ans_color = 'red';		
			 						}
				 			}else if($ques->que_type == 'regular'){
				 				if($key == $ques->correct_ans)
				 				{				 					
				 					$corr_ans = $key.'. '.$que_option;
				 				}
				 				if(@$submitedQue->stud_given_ans){
				 					if($key == $submitedQue->stud_given_ans)
				 					{
				 						if($key == $ques->correct_ans)
				 						{
				 							$stud_ans_color = 'green';
				 							$correct = true;
				 						}
				 						else{
				 							$stud_ans_color = 'red';		
				 							$correct = false;
				 						}
				 					}
				 					else{
				 						$stud_ans_color = '';
				 					}
				 				}
				 				else{
			 						$stud_ans_color = '';
			 					}
				 			}
				 			
				 			?>
				 			
				 			<li style="color: <?php echo $stud_ans_color; ?>"><?php echo $que_option;?></li>
				 			<?php
				 			}
				 		} echo "</ol>";
				 	}?>
				 		
				 		<?php
				 		if($ques->que_type == 'subjective'){ ?>
				 			<span class="answer">Your Answer is: <?php echo $submitedQue->stud_given_ans; ?></span><br>
				 				<?php
				 		}
				 		else{
				 		 if($correct){ ?>
				 	
				 		<span class="answer">Your Answer is: <i class="fas fa-check " style="color:green" aria-hidden="true"></i></span><br>
				 		<?php 
				 		} else{ ?>
				 			<span class="answer">Your Answer is: <i class="fas fa-times" style="color: red"></i></span><br>
				 		<span class="correct_ans"><b>Correct answer:</b> <span style="color: green"> <?php echo $corr_ans; ?></span></span><br>
				 	<?php }
				 }
				 	if(!empty($ques->explanation)){
				 	?>
				 		<span class="correct_ans"><b>Explanation : </b> <span style="text-align: justify;"> <?php echo $ques->explanation;?></span></span>
				 	<?php } ?>
				 	</div>
				 			
				 		
				<?php 	
				 }

				 ?>
			</div>
<?php	}

		 ?>
</div>
