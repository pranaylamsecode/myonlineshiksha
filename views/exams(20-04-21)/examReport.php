<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
	#style-5.asset-container.scrollbar {
   width: 100% !important;
}
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
	width: 100%;
    display: flex;
}
.Qtitle >p{
	margin-right: 2px;
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
	padding: 20px 0px;
}
.QuesList ol li {
	line-height: 1.7em;
}
.Qpage{
		margin: 30px;
	}
	.innner_final_submit_txt{
		text-align: center;
	}
</style>
<div class="final_submit_txt">
	<!-- <h3>Thank you for attending the assessment.</h3> -->
	<h3 style="text-align: center;"><?php echo $msg; ?></h3>
	<div class="innner_final_submit_txt">

		<?php if($show_result == '1'){ ?>
		
		<h2><span><?php echo $obt_marks ? round($obt_marks) : '0'; ?></span></h2>
		
		<p>Score Out Of <span> <?php echo $examinfo->total_marks; ?></span></p>

			<h3><span>You have got <?php echo round($pr).'%'; ?></span></h3>
			<h3><span><?php echo $status;
			// if($examinfo->passing_score < $pr) echo "PASS"; else echo "fail"; 
			?></span></h3> 
		<?php }
			else {  ?>

					<h2><span>Your result is in hold!</span></h2>
		<?php	}
		 ?>

	</div>
	

		<?php 
		
		if($examinfo->exam_type == 1)
		{ 
			?>
			<div>
				<center><h3>Your Attempt</h3></center>

				<?php 
				 $examQue = $this->exam_model->getExamQues($examinfo->exam_id);
				 $i=0;
				 foreach ($examQue as $ques) { 
				 	$i++;
				 	 $array = json_decode($ques->options);

				 	 $submitedQue = $this->exam_model->getsubmitedQue($ques->que_id,$attempt,$examinfo->exam_id,$stud_id,$program_id);
				 	 // print_r($submitedQue);
				 	 ?>
				 	<div class="QuesList">
				 		<span class="Qtitle"><?php echo $i.') '.$ques->que_title ?></span>
				 		<ol>
				 		<?php $stud_ans_color = '';
				 		$correct = false;
				 		 foreach ($array as $arr) {
				 			foreach ($arr as $key => $que_option) {
				 				 
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
				 			?>
				 			
				 			<li style="color: <?php echo $stud_ans_color; ?>"><?php echo $que_option;?></li>
				 			<?php
				 			}
				 		} ?>
				 		</ol>
				 		<?php if($correct){ ?>
				 		<span class="answer">Your Answer is: <i class="fas fa-check " style="color:green" aria-hidden="true"></i></span>
				 		<?php 
				 		} else{ ?>
				 			<span class="answer">Your Answer is: <i class="fas fa-times" style="color: red"></i></span><br>
				 		<span class="correct_ans"><b>Correct answer:</b> <span style="color: green"> <?php echo $corr_ans; ?></span></span>
				 	<?php } ?>
				 	</div>
				 			
				 		
				<?php 	
				 }

				 ?>
			</div>
<?php	}

		 ?>
</div>
