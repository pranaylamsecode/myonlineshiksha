<div class="final_submit_txt">

<?php 
		     $examid = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;  //$examid;  
    $stud_id = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;  //$stud_id; 
    $program_id =  $this->uri->segment(6) ? $this->uri->segment(6) : NULL;   //$attempt; 
    $attempt =  0;   //$pro_id;
// print_r($examinfo);
		// if($examinfo->exam_type == 1)
		// { 
			?>
			<div>
				<center><h3>Student Attempt</h3></center>

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
				 				if($submitedQue->stud_given_ans){
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
<?php //	}

		 ?>
</div>
