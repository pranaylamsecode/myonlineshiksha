<style>
	#message {
    position: fixed; 
/*    color: green;
*/    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}
	.check-mark{
		    border-radius: 50%;
    float: left;
    height: 16px;
    width: 16px;
    color: #fff;
    text-align: center;
    color: #fff;
    background: #54b551;
	}
	.cross-mark{
		    border-radius: 50%;
    float: left;
    height: 16px;
    width: 16px;
    color: #fff;
    text-align: center;
    color: #fff;
    background: #cc2424;
	}
	p {
	margin: 0 0 8.5px;
	font-size: 15px;
}
	.page-container .main-content{
		margin-bottom: 50px; 
	}
</style>
<?php 
function get_timeago( $ptime )
{
    $estimate_time = $ptime;
    if( $estimate_time < 1 )
    {
        return 'Just Now';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' Spent on lecture';
        }
    }
}
$this->load->model('admin/programs_model');
$this->load->model('admin/studreport_model');
$certidetailarr=array('1'=>'No Certificate','2'=>'On successful completion of all lectures','3'=>'On passing the final exam','4'=>'On passing the exams on an average ','5'=>'On finishing all the lectures and passing the final exam','6'=>'On finishing all the lectures and passing all the exams on an average ');
?>
	  <span id="message"></span>

<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2>Student Report</h2></div>
		<div id="toolbar" class="toolbar-list">
		<ul style="list-style:none; float: right;">
		<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
						<!--<a href="<?php echo base_url(); ?>admin/programs/enrolled/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">-->
						<a href="<?php echo base_url(); ?>admin/enrolled/users/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">						
						<span class="icon-32-new">
						</span>
						Back</a>
						</li>
		</ul>
	
		</div>
		
		<!-- <h4><?php echo $courseinfo->name;?></h4> -->
	</div>
</div>

<div class="stud_profile row">
	<div class="col-md-3 col-xs-6 col-lg-3">
		<div class="stud_image">
			<img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php if(!empty($userinfo->images)){ echo $userinfo->images;}else{echo "default.jpg";} ?>" width="150" id="imgname">
		</div>
	</div>
	<div class="col-md-9 col-xs-6 col-lg-9">
		<div class="stud_deatils">
		    <h3 class="user_prof_name"><?php echo $userinfo->first_name.' '.$userinfo->last_name; ?></h3>
		    <p><i><?php echo $userinfo->email; ?></i></p>
		    <p>Entrolled on : <i><?php echo date('d-m-Y',strtotime($buydate)); ?></i></p>
		    <?php
			$certiStatus=$this->programs_model->checkCertificateStatus($userinfo->id,$courseinfo->id);
			if($certiStatus)
			{
			?>
				<p>Status : Satisfies all certificate terms</p>
				<p>Issued : Yes</p>
				<p>Issued By : <?php echo $this->programs_model->getUserName($certiStatus->issued_by); ?></p>
				<p>Issued On : <?php echo $certiStatus->issued_on;?></p>
		
			<?php
			}
			else
			{
				$statusCerti = $this->Studreport_model->getCompletedStatus($userinfo->id,$courseinfo->id);
		
				if(@$courseinfo->certificate_term == @$statusCerti->certificate_term && @$statusCerti->completed == '1')
				{
				?>
					<p>Status : Satisfies all certificate terms</p>				
					<p><a id="cert_aprrove" onclick="approve_cert()" style='text-decoration:none'>Approve Certificate</a></p>
				<?php
				}else
				{
				
				// echo"<pre>";  
	   //      	 print_r($coursequizinfo2);
					$ct=$courseinfo->certificate_term;		
		        	if( $ct == 3 && $coursequizinfo2)
		        	{	
	        			if($coursequizinfo2)
	        			{
	        	?>
	        				<p>Status : Satisfies all certificate terms</p>				
		   					<p><a id="cert_aprrove" onclick="approve_cert()" style='text-decoration:none'>Approve Certificate</a></p>
	        				<?php        				
	        			}
	            	}
	          		else
	           		{ 
			 		?>
						<p>Status : Course not completed</p>
				<!-- new code end here -->
					<?php
		     		}
				}
			}
			?>
		</div>
	</div>
</div>

<div class="stud_course row">
	<div class="col-md-3 col-xs-6 col-lg-3">
		<div class="stud_image">
			<br>
			<img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php if(!empty($courseinfo->image)){ echo $courseinfo->image;}else{echo "default.jpg";} ?>" width="90%" id="imgname">
		</div>
	</div>
	<div class="col-md-9 col-xs-6 col-lg-9">
		<div class="course_title">
			<h2>Course: <?php echo $courseinfo->name;?>
			</h2>
			<p>Trainer: 
			<?php echo (($courseinfo->author) ? $this->programs_model->getUserName($courseinfo->author):'');?></p>	
			<p>Has Final Exam: <?php echo (($courseinfo->id_final_exam)?'Yes':'No');?></p>
			<p>Has Certificate: <?php echo (($courseinfo->certificate_term=='1')?'No':'Yes');?></p>	
			<?php if($courseinfo->certificate_term > 1){ ?>
				<p>Certificate Term: <?php $ct=$courseinfo->certificate_term;
	                    echo $certidetailarr[$ct]; ?></p>
		<?php } ?>
		</div>
	</div>
	<div class="course_bar"> 
		<?php
		$user_id = $userinfo->id;
		$pro_id = $this->uri->segment('5');
		 $CI = &get_instance();
		$CI->load->model('program_model');
		$lecture_ids =array();
		// print_r($days);
		$complated_lecture_ids = array();

		$my_lesson_total = 0;
		$my_viewed_lesson_total = 0;
		$bar_percentage = 0;
		if($days)
		{
			foreach ($days as $day)
			{
				//for total lesson
				//$lessons = $this->program_model->getLessons($day->id);
				$lessons = $CI->program_model->getLessonNew($day->id);
				$my_lesson_total += count($lessons);
				
				//for viewed lesson
				foreach ($lessons as $lesson)
				{	
					if($lesson->id)
					{
					array_push($lecture_ids,$lesson->id);
				    }
					$lesson_viewed = $CI->program_model->getCompletedLesson2($lesson->id,$userinfo->id,$pro_id);
					
					if(!empty($lesson_viewed))
					{  
						array_push($complated_lecture_ids,$lesson->id);
						$my_viewed_lesson_total++;
					}								
				}
			}

		}
		if($my_lesson_total!=0)
		{
		$bar_percentage = $my_viewed_lesson_total * 100/ $my_lesson_total;
    	}
		$bar_percentage = number_format($bar_percentage,2,".","");	
 		?>
 		<p> <?php echo $my_viewed_lesson_total;?> Lectures completed out of <?php echo $my_lesson_total;?> Lectures</p>
    
	    <div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $bar_percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bar_percentage;?>%"> <span class="sr-only"><?php echo $bar_percentage;?>% Complete (success)</span> 
			</div>
    	</div>	
	</div>
</div>

<div class="course_content" style="font-size: 15px !important">
		<?php 
		$allLessonIds = array();
		$i=0;
		$total_lesson = 0;
		foreach ($days as $day)
		{ $i++; ?>
		<div id="coursesection" style="padding-bottom: 25px !important">
		    <div class="section_title">
			    <div class="section_label"><?php echo "Chapter ".$i. " : " ?>
			    	<span class="section_name"> <?php echo $day->title;?></span>
			    </div>
			    
		</div>
	    <div id="coursesectionlecture">
	    	<?php      
			// $lessons = $this->program_model->getLessons($day->id);
		    $lessons = $CI->program_model->getLessonNew($day->id);
				$total_lesson += count($lessons);
				$dayaccess = $day->access;
		    ?>

		    
		    <ul class="course_cat1">

		    <?php
					
					foreach ($lessons as $lesson)
		            {		
		            		if($lesson->layoutid != '22')
						    {
						          if($lesson->lecture_type == 'article')
						          { 
						            $entypo = 'entypo-newspaper';
						          }
						          else if($lesson->lecture_type == 'video')
						          {
						            $entypo = 'entypo-video';
						          }
						          else if($lesson->lecture_type == 'pdf')
						          {
						            $entypo = 'entypo-docs';
						          }
						          else if($lesson->lecture_type == 'exam')
						          {
						            $entypo = 'entypo-clipboard';
						          }
						           else if($lesson->lecture_type == 'video_article')
						          {
						            $entypo = 'entypo-vcard';
						          }
						          else
						          {
						            $entypo = 'entypo-vcard';
						          }							
							}	  
					    $allLessonIds[] = $lesson->id;
						?>
						<li>
							<div class="cattext1">
								


								
			            		<?php
			            		$con1 = "stud_id = '".$user_id."' and course_id = '".$pro_id."' and lecture_id = '".$lesson->id."'";
								$gettotal_spent = $this->Crud_model->get_single('mlms_lecture_statistics',$con1,'total_time_spent');
								$lesson_viewed = $CI->program_model->getCompletedLesson2($lesson->id,$user_id,$pro_id);
								$lesson_viewed3 = $CI->program_model->getViewLesson($lesson->id,$user_id,$pro_id);
											if(!empty($lesson_viewed) && !empty($lesson_viewed3))
										{
											if($lesson->is_exam > 0){
									 		?>

									 		<a href="<?php echo base_url() ?>admin/studreport/view_attempt/<?php echo $lesson->is_exam ?>/<?php echo $user_id ?>/<?php echo $pro_id ?>/2" target="_blank">View attempt</a>
									 	<?php } ?>
									 		<div class="ci-progress-container">
											<!-- <span class="ci-progress-maskgreencheck"></span> -->
											<div class="check-mark">
												<img title="Completed" src="<?php echo base_url() ?>public/images/admin/check.png" style="width: 12px;padding-top:0px;padding-left:2px;padding-right:2px;">	
						         			</div></div>
						         			<?php	

									 	}
									 	else if(empty($lesson_viewed) && !empty($lesson_viewed3))
									 	{ ?>
									 			<div class="ci-progress-container" style="background: #54b551"  title="Visited">
												<div class="">
						         				</div></div>
									         	<?php			
											}
										else
									 	{ ?>
									 			<div class="ci-progress-container" style="background: #e7e7e7"  title="Not Visited">
												<div class="">
						         				</div></div>
									         	<?php			
											}
									 	?>
									<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>
								<a href="<?php echo 'javascript:void(0)';?>" class='outeranchor ' ><span class="s_underline right-content"> <?php echo $lesson->name;?></span> <span style="padding-left: 10px;"><?php if($gettotal_spent->total_time_spent > 0)echo '( '.get_timeago($gettotal_spent->total_time_spent).' )'; ?></span></a>
								</div>
							</li>
							<?php
			  				} // end of foreach lessions
			  				$assignment = $this->Crud_model->GetData('mlms_assignment',"assign_id,assign_title, course_id,section_id,trash","trash = 0 and section_id = ".$day->id." and course_id = ".$pro_id);
				if(!empty($assignment)){
					foreach ($assignment as $key) {
					$getsubmitted = $this->Crud_model->get_single('mlms_assignment_submitted',"assign_id = ".$key->assign_id." and user_id = ".$user_id);
				?>
				<li>
					<div class="cattext1">
						<?php 
						$linksubmit = "javascript:void(0)";
						if(empty($getsubmitted)){ ?>
	            		<div class="ci-progress-container" style="background: #e7e7e7" title="Not Visited">
							<div class=""></div>
						</div>
						<?php }else{
							$linksubmit = base_url()."admin/studreport/view_assignment/".$user_id."/".$key->assign_id;
						?>
						<div class="ci-progress-container">
							<div class="check-mark">
								<img title="Completed" src="<?php echo base_url() ?>public/images/admin/check-mark.png" style="width: 12px;padding-top:0px;padding-left:2px;padding-right:2px;">	
		         			</div>
		         		</div>
						<?php } ?>
						<i class="entypo-vcard" style="margin-right:10px"></i>
						<a href="<?php echo $linksubmit;?>" class="outeranchor "><span class="s_underline right-content"> <?php echo ucwords($key->assign_title); ?></span></a>
						
					</div>
				</li>
				<?php } }
			  				
					?>


		    </ul>
	    </div>
	</div>
    <?php
} 
 if($courseinfo->id_final_exam){ 
 	$exam_name = $CI->program_model->getFinalExam_Name($courseinfo->id_final_exam);
 	?>
		<div id="coursesection">
		    <div class="section_title">
		    	 <?php if($coursequizinfo2){ ?>
		    	 	<a href="" title="View Quiz"> 
			    <div class="section_label"><?php echo "Final Quiz : " ?>
			    	<span class="section_name"><?php echo $exam_name; ?></span>
			    
					   
					    <div class="ci-progress-container">
							<div class="check-mark">
								<img title="Completed" src="<?php echo base_url() ?>public/images/admin/check-mark.png" style="width: 12px;padding-top:4px;padding-left:2px;padding-right:2px;">	
		         			</div>
		         		</div>
		         	</div></a>
		         	<?php } else{ ?>
		         		<div class="section_label"><?php echo "Final Quiz : " ?>
			    	<span class="section_name"><?php echo $exam_name; ?></span>
					    <div class="ci-progress-container" style="background: #cc2424"  title="Quiz Not Complete">
						<div class=""></div></div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
	<!-- <table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=10 class="text-center"><b>Exam Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td colspan=4 class="text-center">Final Exam Completed</td>
				<td colspan=6><?php echo ((@$finalexamcompleted == 'Pass') ? 'Yes' : 'No');?></td>
			</tr>	
		</tbody>

		<thead>
			<tr>
				<th class="text-center">Attempt</th>
				<th class="text-center">Exam Name</th>
				<th class="text-center">Exam Type</th>
				<th class="text-center">Passing Min Score(%)</th>
				<th class="text-center">Exam Score(%)</th>
				<th class="text-center">Result</th>
				<th class="text-center">Exam On</th>
				<th class="text-center">Moderate Exam</th>
				<th class="text-center">Actions</th>
				<th class="text-center">Archive</th>
			</tr>
		</thead>	
		
		<tbody>
		<?php 
		//ECHO '<PRE>';print_r($coursequizinfo);ECHO '</PRE>';
		foreach($coursequizinfo as $eachquiz)
        {
		?>
			<tr>
				<td><?php echo $eachquiz['attempt_no'];?></td>
				<td><a href="<?php echo base_url()?>admin/studreport/viewexam/<?php echo $eachquiz['id']; ?>/<?php echo $eachquiz['attempt_code']; ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>"><?php echo ucfirst($this->programs_model->getQuizNameById($eachquiz['quiz_id']));?></a></td>
				<?php
					if($eachquiz['snapfoldername'] !='')
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
				<td><?php echo $maxscore=$CI->programs_model->getQuizMaxScoreById($eachquiz['quiz_id']);?></td>
				<td><?php
					if($eachquiz['score_quiz'])
					{
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
	                }else
	                {
	                	echo '';
	                }
                    ?></td>
				
				<?php
					if($eachquiz['result'] == 'Pending')
					{
						$user = $this->uri->segment(4);
						$program = $this->uri->segment(5);
						$quiz = $eachquiz['quiz_id'];
						$attempt = $eachquiz['attempt_no'];
						?>
						<td><a href='<?php echo base_url(); ?>admin/studreport/pendings/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>'><?php echo $eachquiz['result'];?></a></td>
						<?php
					}
					else if($eachquiz['result'] == '')//for recalculating
					{
						$user = $this->uri->segment(4);
						$program = $this->uri->segment(5);
						$quiz = $eachquiz['quiz_id'];
						$attempt = $eachquiz['attempt_no'];
						$attempt_code = $eachquiz['attempt_code'];
						?>
						<td><a href='<?php echo base_url(); ?>admin/studreport/recalculate/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>/<?php echo $attempt_code;?>'>Re-Calculate</a></td>
						<?php
					}
					else
					{
						?>
						<td><?php echo $eachquiz['result'];?></td>
						<?php
					}
				?>
				
				<td><?php echo $eachquiz['date_taken_quiz'].' GMT'; ?></td>
				<td><a href="<?php echo base_url()?>admin/studreport/viewexam/<?php echo $eachquiz['id']; ?>/<?php echo $eachquiz['attempt_code']; ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">View Exam</a></td>
				<td><?php
                $webcamstatus=$CI->programs_model->checkWebcamStatus($eachquiz['pid']);
                if($webcamstatus)
                {
                    if($eachquiz['snapfoldername'] !='')
                    {
                    ?>
                    <a  href="<?php echo base_url(); ?>admin/studreport/viewsnap/<?php echo $eachquiz['snapfoldername'].'/'.$eachquiz['attempt_no'].'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$eachquiz['attempt_code'];?>" style='text-decoration:none' class='viewsnap'>View Snap</a>
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
                <td>
                	<input type="checkbox" onclick="getRadioVal('<?php echo $eachquiz['id']; ?>')" name="archive<?php echo $eachquiz['id']; ?>" id="archive<?php echo $eachquiz['id']; ?>" <?php if($eachquiz['archive'] == '1') { echo 'checked';}?>  value="<?php echo $eachquiz['archive']; ?>" /><span id="span<?php echo $eachquiz['id']; ?>" style="color:green;"></span>

                </td>
			</tr>		
		<?php
		}
		?>
		</tbody>
	</table> -->
<br>
<br>
<br>
<br>

<script>
	function getRadioVal(id)
	{
	
		var arc_val = document.getElementById('archive'+id).value;

		if(arc_val == '0')
		{
			document.getElementById('archive'+id).value = '1';
		}
		else
		{
			document.getElementById('archive'+id).value = '0';
		}
		

		    $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>admin/studreport/doArchive",
            data: {'id':id,'arc_val':arc_val}, 
            success: function(response) 
			{
                
				
				if(response =='archived')
				{
					
				$("#span"+id).html('archived');
				setTimeout(
						function() 
						{
							
						$("#span"+id).slideUp('slow');

						}, 2500);
				$("#span"+id).show();
			}
			else
			{
				
				$("#span"+id).html('Unarchived');
				setTimeout(
						function() 
						{
							
						$("#span"+id).slideUp('slow');

						}, 2500);
				$("#span"+id).show();
			}
			}
		});


	}


	
	function approve_cert(){
		$.confirm({
			title: '<span style="text-transform:unset">Are you sure?',
	    content: '<center><h3> Do you want to approve his/her certificate? </h3></center> ',
	        confirm: function () {
	            $.ajax({
					type: "POST",
					url : "<?php echo base_url(); ?>admin/studreport/aprovecerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>",
					dataType : 'json',


					success: function($data){
						console.log($data);
						if($data && $data['approved'] == 'yes')
						{
							var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>Certificate is successfully approved! </div>';
					             var note = $('#message');
					            note.html(str);
					            note.show();
					            note.fadeIn().delay(3000).fadeOut();
					            $('#cert_aprrove').hide();
					            var str2 = "<p>Issued : Yes</p><p>Issued By : "+$data['issuedby']+"</p><p>Issued On : "+$data['today'];
					            $('.stud_deatils').append(str2);


			            	
						}
					}

				});
	        },
	        cancel: function () {
	            return false;
	        }
	    
		});
		
	}
</script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){
                               //Examples of how to assign the Colorbox event to elements
                               
                         //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});                        
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