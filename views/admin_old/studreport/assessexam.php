<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

<?php 
$this->load->model('admin/programs_model');
$this->load->model('admin/studreport_model');


?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
		<ul style="list-style:none; float: right;">
		<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
						<!--<a href="<?php echo base_url(); ?>admin/programs/enrolled/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">-->
						<a href="<?php echo base_url(); ?>admin/studreport/viewusers/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">						
						<span class="icon-32-new">
						</span>
						Back</a>
						</li>
		</ul>
		<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Exam Details</h2></div>
		<h4>Exam :- </h4>
	</div>
</div>
<!-- new code start -->
<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=2 class="text-center"><b>User Details</b></th>
			</tr>
		</thead>		
		<tbody>
		<?php
		$this->load->model('admin/programs_model');
		$userinfo=$this->programs_model->getUserInfo($this->uri->segment(6));
		?>
			<tr>
				<td class="text-center">User ID</td>
				<td><?php echo $userinfo->id; ?></td>
			</tr>			
			<tr>
				<td class="text-center">User Name</td>
				<td><?php echo $userinfo->username; ?></td>				
			</tr>			
			<tr>
				<td class="text-center">Full Name</td>
				<td><?php echo $userinfo->first_name .' '. $userinfo->last_name; ?></td>				
			</tr>			
			<tr>
				<td class="text-center">Email</td>
				<td><?php echo $userinfo->email; ?></td>				
			</tr>			
		</tbody>
</table>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=2 class="text-center"><b>Course Details</b></th>
			</tr>
		</thead>		
		<tbody>
		<?php
		$this->load->model('admin/programs_model');    
		$courseinfo=$this->programs_model->getProgramById($this->uri->segment(7)); 
		 ?>
			<tr>
				<td class="text-center">Course ID</td>
				<td><?php echo $courseinfo->id; ?></td>
			</tr>			
			<tr>
				<td class="text-center">Trainer</td>
				<td><?php echo (($courseinfo->author)?$this->programs_model->getUserName($courseinfo->author):'');?></td>				
			</tr>			
			<tr>
				<td class="text-center">Has Final Exam</td>
				<td><?php echo (($courseinfo->id_final_exam)?'Yes':'No');?></td>				
			</tr>			
			<tr>
				<td class="text-center">Has Certificate</td>
				<td><?php echo (($courseinfo->certificate_term=='1')?'No':'Yes');?></td>				
			</tr>			
		</tbody>
</table>
<!-- new code end here -->
<div style="text-align:center; margin-bottom:5px;"></div>

<table class="table table-bordered">
		

		 <thead>
		 			<tr>
						<th colspan=9 class="text-center"><b>Questions Details</b></th>
					</tr>
		               <tr class="guru_orderhead">
                        <th width="15%">Question No.</th>
                         <th width="15%">Question</th>
                        <th width="15%">Question Type</th>
                        <th width="15%">Correct Answer</th>   
                        <th width="15%">Given Answer</th>
                        <th width="15%">Question Marks</th>
                        <th width="15%">Obtain Marks</th>   
                                      
           
                    </tr>
                </thead>
		
		<tbody>
				<?php
				 

				   $iii = 1;
					foreach($activeData as $examinfo)
					{
						$ques_opt = $this->questions_model->getAnsOptions($examinfo->question_id);

						$questionData =  $this->questions_model->getQuestions($examinfo->question_id);
                        
                      
						 $answer = $this->questions_model->getAnswer($examinfo->question_id,$questionData->question_type);
                  						
				?>
			<tr>
				<td><?php echo $iii;   ?></td>
				<td><?php echo $examinfo->question; ?></td>
				<td><?php echo $questionData->question_type; ?></td>
				<td ><a href="<?php echo base_url(); ?>admin/studreport/viewCorrectAns/<?php echo $examinfo->question_id; ?>" class="crct-ans">View</a></td>
					<?php
						//if($questionData->question_type == 'true_false' || $questionData->question_type == 'subjective' )
						//{
					?>
				<td><a href="<?php echo base_url(); ?>admin/studreport/viewGivenAns/<?php echo $examinfo->question_id; ?>/<?php echo $this->uri->segment(5); ?>" class="que-ans">View</a></td>
					<?php
						//}
						//else
						//{
					?>
				<!--<td>View</td>-->
					<?php
						//}
					?>

					<?php
					$totalMarksOutOf =0;
	$totalMarksObtained =0;
	$CI = & get_instance();
	$CI->load->model('lessons_model');


	//$quizzes_ids = $CI->lessons_model->getQuestionIds($examinfo->question_id);
    $totalMarksOutOf1 =0;
	$data_right = $CI->lessons_model->getQuizMarks($examinfo->question_id);	
   


    foreach($data_right as $correctans)
               {

               $givenData =  $CI->questions_model->getGivenAnsOptions($correctans->question_id,$courseinfo->id,$examinfo->attempt_code,$correctans->option_id);
                       $givenDatasecond =  $CI->questions_model->getGivenAnsOptionsecond($correctans->question_id,$courseinfo->id,$examinfo->attempt_code);        
                               

                               foreach($givenData as $givenans)
                                       {

                                         
                                        }
                                                        

                if($correctans->question_type == 'match_the_pair')
                               {
                                       if( $correctans->is_correct_answer == $givenans->answers_gived)
                                       {
                                               $totalMarksOutOf1+= $correctans->points;
                                       }

                               }
                               else if($correctans->question_type == 'true_false')
                               {                                                        
                                       if( $correctans->is_correct_answer ==  $givenDatasecond->answers_gived)
                                       {
                                                $totalMarksOutOf1 = $correctans->points;
                                        }
                               }
                               else if($correctans->question_type == 'multiple_type')
                               {        
                               if( $correctans->is_correct_answer ==  $givenans->answers_gived)
                                       {                                                        
                                       $totalMarksOutOf1+= $correctans->points;
                                       }                                                                
                               }
                               else if($correctans->question_type == 'subjective' && $correctans->option_id )
                               {        

                                                $totalMarksOutOf1 = $givenDatasecond->obtain_marks;        
                                                                                                       
                               }
                               else if($correctans->question_type == 'regular' && $correctans->option_id )
                               {        
                                       if( $correctans->option_id ==  $givenDatasecond->answers_gived)
                                       {                                                         
                                       
                                               $totalMarksOutOf2 = $CI->questions_model->getcorrectans($correctans->question_id,$correctans->option_id);        
                                        $iscorrect = $totalMarksOutOf2->is_correct_answer;
                                        if($iscorrect == 1)
                                        {
                                         $totalMarksOutOf1 = $totalMarksOutOf2->points;
                                            }
                                  
                                   }
                                   
                               }  
                                else if($correctans->question_type == 'media_type' && $correctans->option_id )
                               {        
                                       if( $correctans->option_id ==  $givenDatasecond->answers_gived)
                                       {                                                         
                                       
                                               $totalMarksOutOf2 = $CI->questions_model->getcorrectans($correctans->question_id,$correctans->option_id);        

                                        $iscorrect = $totalMarksOutOf2->is_correct_answer;
                                        if($iscorrect == 1)
                                        {
                                         $totalMarksOutOf1 = $totalMarksOutOf2->points;
                                            }
                                  
                                   }
                                   
                               }

                        
               
               }


  				
foreach($data_right as $rights)
{
	//for right answer							
	if($rights->question_type == 'match_the_pair')
	{								
		$totalMarksOutOf += $rights->points;								
	}
	else if($rights->question_type == 'true_false')
	{							
		// if($rights->is_correct_answer == 'True')
		// {
		 	$totalMarksOutOf = $rights->points;
		// }
	}
	else if($rights->question_type == 'multiple_type')
	{								
		$totalMarksOutOf+= $rights->points;								
	}
	else if($rights->question_type == 'subjective')
	{								
		$totalMarksOutOf+= $rights->points;								
	}
	else 
	{
		$totalMarksOutOf = $rights->points;
	}

				
}
					?>
				<td> <?php echo $totalMarksOutOf; ?></td>
				
				<td><?php echo $questionData->question_type == 'subjective' && $totalMarksOutOf1 == null ? 'Not Assign': $totalMarksOutOf1; ?></td>
			</tr>
			<?php
					 $iii++;
				}
			?>
		
		</tbody>
</table>

<table class="table table-bordered">
		
		<thead>
			<tr>
				<th colspan=9 class="text-center"><b>Exams Details</b></th>
			</tr>
			<tr>
				<th class="text-center">Attempt</th>
				<th class="text-center">Exam Name</th>
				<th class="text-center">Exam Type</th>
				<th class="text-center">Passing Min Score(%)</th>
				<th class="text-center">Exam Score(%)</th>
				<th class="text-center">Result</th>
				<th class="text-center">Exam On</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>	
		
		<tbody>
		<?php 
	//	ECHO '<PRE>';print_r($quizdetail);ECHO '</PRE>';

		
		?>
			<tr>
				<td><?php echo $quizdetail->attempt_no;?></td>
				<td><?php echo ucfirst($this->programs_model->getQuizNameById($quizdetail->quiz_id));?></td>
				<?php
					if($quizdetail->snapfoldername !='')
                    {
				?>				
				<td>Final Exam</td>
				<?php
					}
					else
					{
				?>
				<td>Regular Exam</td>
				<?php
					}
				?>
				
				
				<td><?php echo $maxscore=$this->programs_model->getQuizMaxScoreById($quizdetail->quiz_id);?></td>
				<td><?php 
							// echo"<pre>";
							// print_r($quizdetail);
					if($quizdetail->score_quiz)
					{
	                    list($rq,$tq)=explode('|',$quizdetail->score_quiz);
	                    if($rq == '0' || $tq == '0')
	                    {
	                      echo '0';
	                    }
	                    else
	                    {
	                       $avg=($rq/$tq)*100;
	                       echo round($avg,2);
	                    }
	                }else
	                {
	                	echo '';
	                }
                    ?></td>
				
				<?php
					if($quizdetail->result == 'Pending')
					{
						$user = $this->uri->segment(6);
						$program = $this->uri->segment(7);
						$quiz = $quizdetail->quiz_id;
						$attempt = $quizdetail->attempt_no;
						?>
						<!-- <td><a href="<?php echo base_url() ?>admin/studreport/pendings/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>" ><?php echo $quizdetail->result;?></a></td> -->
						<td><a href="<?php echo base_url() ?>admin/studreport/pendings/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>"  ><?php echo $quizdetail->result;?></a></td>
						<?php
					}
					else if($quizdetail->result == '')//for recalculating
					{
						$user = $this->uri->segment(6);
						$program = $this->uri->segment(7);
						$quiz = $quizdetail->quiz_id;
						$attempt = $quizdetail->attempt_no;
						$attempt_code = $quizdetail->attempt_code;
						?>
						<td>Re-Calculate</td>
						<?php
					}
					else
					{
						?>
						<td><?php echo $quizdetail->result;?></td>
						<?php
					}
				?>
				
				
				
				<td><?php echo $quizdetail->date_taken_quiz.' GMT'; ?></td>
				<td><?php
                $webcamstatus=$this->programs_model->checkWebcamStatus($quizdetail->pid);
                if($webcamstatus)
                {
                    if($quizdetail->snapfoldername !='')
                    {
                    ?>
                    <a class="viewsnap" href="<?php echo base_url(); ?>admin/studreport/viewsnap/<?php echo $quizdetail->snapfoldername.'/'.$quizdetail->attempt_no.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$quizdetail->attempt_code;?>" style='text-decoration:none' >View Snap</a>
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
		
		</tbody>
</table>
<?php
            $pid2= $this->uri->segment(7) ? $this->uri->segment(7):'0';
            $quid = $quizdetail->quiz_id ? $quizdetail->quiz_id :'0';
$showresult = $this->lessons_model->getFinalExamResult($pid2);
$showpending = $this->lessons_model->getStatusPending($quid,$pid2);
$showpending2 = $showpending ? $showpending->result :"wrote";


//if(($showresult->show_result == 1 && $showresult->id_final_exam == $quid ) && $showpending2 == "Pending")
//{
?>
<form method="post" id="Examstatus">
<table class="table table-bordered">
		
		<!-- <thead>
			<tr>
				<th colspan=9 class="text-center"><b>Exams Details</b></th>
			</tr>			
		</thead> -->	
		
		<tbody>
		<tr>
		<td class="text-center">
		<b>Assess Result</b>
		</td>
		<td class="text-center">
		<select class="form-control" style="width: 25%;" id="cbstatus" name="cbstatus">
		<option value="noselect">Select</option>
		<option value="Fail">Fail</option>
		<option value="Pass">Pass</option>
		</select><span id="spanmsg" style="color:red"></span>
		</td>
		</tr>		
		<tr >
		<td class="text-center">Assess Note</td>
		<td class="text-center">
		<textarea id="txtareanotice" class="form-control" style="width: 50%;" placeholder ="Enter Notification Text. This text will send with an email to students."><?php echo $quizdetail->assess_note ? $quizdetail->assess_note :''; ?></textarea>
		<span id="spantxtmsg" style="color:red"></span>
		</td>		
		</tr>
		<tr>
		<td class="text-center">send Notification</td>
		<td class="text-center"><input type="checkbox" id="chknotice" name="chknotice" class="form-control" style="width: 15px;"></td>
		</tr>
		<tr>
		<td colspan=2 class="text-center">
			<input type="button" name="btnstatus" value="Save" id="btnstatus" onclick="updateResult('<?php echo $this->uri->segment(6);?>','<?php echo $this->uri->segment(7);?>','<?php echo $quizdetail->quiz_id;?>','<?php echo $this->uri->segment(5);?>');" class="btn btn-success">
		</td>
		</tr>
		</tbody>
</table>
</form>
<?php //}?>

 <script>
function updateResult(user,proid,mediaid,attempt_code)
   {
           var resultstatus = document.getElementById("cbstatus").value;
           var txtareanotice = document.getElementById("txtareanotice").value;
           var sendmail = document.getElementById("chknotice").checked;

           if(resultstatus == 'noselect')
           {
                   //alert("select the assess Result Option");
                   $("#spanmsg").html("select the assess Result Option");
                   
           }            
           else if(txtareanotice.trim() == "")
           {
                   $("#spantxtmsg").html("Please write Note");
           }
           else
           {        
       $.ajax({
                       type: "POST",
                       url: "<?php echo base_url();?>admin/studreport/updateResultStatus",
                       data: {resultstatus:resultstatus,user:user,proid:proid,mediaid:mediaid,attempt_code:attempt_code,txtareanotice:txtareanotice,sendmail:sendmail}, 
                       success: function(data)
                       {
                               
                             //alert(data);
                               location.reload();
                       }
                 });
     
  }

        }
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements

		//$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});	
		$j(".crct-ans").colorbox({
		iframe:true,
		width:"600px", 
		height:"63%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
		$j(".que-ans").colorbox({
		iframe:true,
		width:"600px", 
		height:"63%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
		$j(".viewsnap").colorbox({
		iframe:true,
		width:"700px", 
		height:"100%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
	   });
		</script>
