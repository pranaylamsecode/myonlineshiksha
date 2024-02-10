<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.mousewheel-3.0.6.pack.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />-->
<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url() ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>-->
<style>
	.table {
    width: 100%;
    margin-bottom:0!important;
}
.dataTable .table-title {
    padding: 0px !important;
    color: #95aac9 !important;
    font-size: 10px !important;
    font-weight: 600 !important;
    letter-spacing: .08em;
    text-transform: uppercase;
}
</style>
<script type="text/javascript">

		$(document).ready(function() {

			/*

			 *  Simple image gallery. Uses default settings

			 */



			$('.fancybox').fancybox();



			/*

			 *  Different effects

			 */



			// Change title type, overlay closing speed

			$(".fancybox-effects-a").fancybox({

				helpers: {

					title : {

						type : 'outside'

					},

					overlay : {

						speedOut : 0

					}

				}

			});



			// Disable opening and closing animations, change title type

			$(".fancybox-effects-b").fancybox({

				openEffect  : 'none',

				closeEffect	: 'none',



				helpers : {

					title : {

						type : 'over'

					}

				}

			});



			// Set custom style, close if clicked, change title type and overlay color

			$(".fancybox-effects-c").fancybox({

				wrapCSS    : 'fancybox-custom',

				closeClick : true,



				openEffect : 'none',



				helpers : {

					title : {

						type : 'inside'

					},

					overlay : {

						css : {

							'background' : 'rgba(238,238,238,0.85)'

						}

					}

				}

			});



			// Remove padding, set opening and closing animations, close if clicked and disable overlay

			$(".fancybox-effects-d").fancybox({

				padding: 0,



				openEffect : 'elastic',

				openSpeed  : 150,



				closeEffect : 'elastic',

				closeSpeed  : 150,



				closeClick : true,



				helpers : {

					overlay : null

				}

			});



			/*

			 *  Button helper. Disable animations, hide close button, change title type and content

			 */



			$('.fancybox-buttons').fancybox({

				openEffect  : 'none',

				closeEffect : 'none',



				prevEffect : 'none',

				nextEffect : 'none',



				closeBtn  : false,



				helpers : {

					title : {

						type : 'inside'

					},

					buttons	: {}

				},



				afterLoad : function() {

					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');

				}

			});





			/*

			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked

			 */



			$('.fancybox-thumbs').fancybox({

				prevEffect : 'none',

				nextEffect : 'none',



				closeBtn  : false,

				arrows    : false,

				nextClick : true,



				helpers : {

					thumbs : {

						width  : 50,

						height : 50

					}

				}

			});



			/*

			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.

			*/

			$('.fancybox-media')

				.attr('rel', 'media-gallery')

				.fancybox({

					openEffect : 'none',

					closeEffect : 'none',

					prevEffect : 'none',

					nextEffect : 'none',



					arrows : false,

					helpers : {

						media : {},

						buttons : {}

					}

				});



			/*

			 *  Open manually

			 */



			$("#fancybox-manual-a").click(function() {

				$.fancybox.open('1_b.jpg');

			});



			$("#fancybox-manual-b").click(function() {

				$.fancybox.open({

					href : 'iframe.html',

					type : 'iframe',

					padding : 5

				});

			});



			$("#fancybox-manual-c").click(function() {

				$.fancybox.open([

					{

						href : '1_b.jpg',

						title : 'My title'

					}, {

						href : '2_b.jpg',

						title : '2nd title'

					}, {

						href : '3_b.jpg'

					}

				], {

					helpers : {

						thumbs : {

							width: 75,

							height: 50

						}

					}

				});

			});

		});

	</script>
<!--/lightbox scripts and style-->
<!-- Fancy Box End -->
<?php
$auth = $this->session->userdata('loggedin');
    $cancelurl='';

    if($action == 'courseenrollusers' || $action == 'quizCompletedUsers')
    {
      $cancelurl='/studreport';
    }
    if($action == 'userdetail')
    {
        $cancelurl='/studreport/viewusers/'.$courseinfo->id;
    }
?>

<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2>Course Report</h2></div>
		<div id="toolbar" class="toolbar-list">
    			<!--
	            <ul style="float:right; list-style:none;">
	               <li id="toolbar-new" class="listbutton">
	                   <a href='<?php echo base_url(); ?>admin/studreport' class='btn btn-blue'>Back</a>
	               </li>
	            </ul>-->	         	
		
			<?php if($auth['groupid']==4){ ?>
			<ul id="sticky" style="list-style: none; float: right;">
	    		<li id="toolbar-new" class="listbutton">
	        		<a href="<?php echo base_url(); ?>admin/course/statistics/"  class="btn btn-success btn-green">
	        			<i class="entypo entypo-popup"></i>
	    				<span class="icon-32-new"></span>
	    				Course Statistics
	    			</a>
				</li>
			</ul>
			<?php } ?>
			
		</div>
	</div>
</div>

<?php
$this->load->model('admin/Studreport_model');
if($action == 'coursereport')
{
?>
<div class="card">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<thead>
				<tr>		
					<th class="col-sm-4"><div class="col-sm-12 no-padding table-title">Course</div></th>
					<th class="col-sm-2"><div class="col-sm-12 no-padding table-title">Students</div></th>
					<th class="col-sm-3"><div class="col-sm-12 no-padding table-title">Course Completed</div></th>
				<!-- 	<th class="col-sm-3" style="font-weight: bold"><div class="col-sm-12 no-padding table-title">Final Exam</div></th> -->
                    <!--<th style="font-weight: bold">Action</th>-->
				</tr>
			</thead>
			
            <?php  $i=0; ?>
			<tbody>
            <?php
                    foreach($courses as $eachcourse)
                    {
                      $estud=$this->Studreport_model->getEnrolledUser($eachcourse->id);				  					  
					  $ccstud=$this->Studreport_model->getcourseCompleted($eachcourse->id);					  
					  $quiz_id = $this->programs_model->getCountNumQuiz($eachcourse->id);
                 	?>
					<tr class="odd camp<?php echo $i;?>">
					<td class="field-title"><?php echo $eachcourse->name ?></td>
					
					<td class="field-title"><a href="<?php echo base_url();if($auth['groupid']==4){echo 'admin';}else{echo 'teacher';}?>/enrolled/users/<?php echo $eachcourse->id; ?>" class="btn btn-primary"><?php echo 'Enrolled ('.count($estud).')'; ?></a></td>
					
					<td class="field-title"><a href="<?php echo base_url();if($auth['groupid']==4){echo 'admin';}else{echo 'teacher';} ?>/users/completed-course/<?php echo $eachcourse->id; ?>" class="btn btn-primary"><?php echo 'Completed ('.count($ccstud).')'; ?></a></td>
					<!-- 
					<td class="field-title" style="color: #666;text-transform: capitalize;"><a href="<?php echo base_url(); ?>admin/users/completed-final-exam/<?php echo $eachcourse->id; ?>" class="btn btn-primary"><?php echo 'View ('.count($quiz_id).')'; ?></a></td>	 -->			
					
				
				
					<!--<td><a href="<?php echo base_url(); ?>admin/studreport/viewusers/<?php echo $eachcourse->id; ?>">

<img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View Course Report">



          </a></td>-->

                        </tr>

                 <?php

                  }

                 ?>
				
		
<?php

	
}
/* ---------------End of page one ----------------------------------------------- */ 
?>	</tbody>
</table> 


<?php
/* ---------------Start of page two ----------------------------------------------- */ 
if($action == 'courseenrollusers')
{
    if(count($enrolledusers)>0)
    {
	?>
	<div class="clr"></div>
	<h3><?php echo $this->Studreport_model->getProgramName($enrolledusers[0]['course_id']);?></h3>
	<br />

	<div class="col-md-12"> 
	<table class="table table-bordered responsive"> 
    	<thead> 
        	<tr> 
            	<th>User ID</th>
    			<th>User Name</th>
    			<th>Enrollment Date</th>
    			<th>Progress</th>
    			<th>Certificate Status</th>
    			<th>Action</th> 
			</tr> 
		</thead> 
        <tbody> 
        	<?php
            foreach($enrolledusers as $eachuser)
            {
				$uid=getUserIdExist($eachuser['userid']);
				if($uid)
				{
				?>

				<tr>
			        <td><?php echo $eachuser['userid']; ?></td>
			        <td><?php echo $this->Studreport_model->getUserName($eachuser['userid']); ?></td>
			        <td><?php echo date("d-m-Y",strtotime($eachuser['buy_date'])); ?></td>
			        <td>
					<?php
		            /*$completedprogress = $this->Studreport_model->courseCompleted($eachuser['userid'],$eachuser['course_id']);
		            if(isset($completedprogress->completed) && $completedprogress->completed == '1' )
					{
		    		   $completed_progress = "true";
		    		}
					else
					{
		    			$completed_progress = "false";
		    		}



		           // $date_completed = $this->Myinfo_model->dateCourseCompleted($user_id,$course->course_id);

		            if(isset($completedprogress->date_completed) && $completedprogress->date_completed!= '0000-00-00' )
		            {
		      			$date_completed = $completedprogress->date_completed;
		      		}
		      		else{
		      			$date_completed= "";
		      		}
		        	$style_color = "";

		        	if($completed_progress == "true")
		            {
		        		$lesson_module_progress = "completed";
		        		$style_color = 'style="color:#669900"';
		        	}
		        	else
		        	{
		                $lesson_module_progress = $this->Studreport_model->getLastViewedLessandMod($eachuser['userid'],$eachuser['course_id']);
		            }
					if(!empty($lesson_module_progress))
					{
						echo $lesson_module_progress;
					}
					else{
					    echo "Not started yet!";
					}*/
		        
		        
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
						$lessons = $this->program_model->getLessonNew($day->id);
						$my_lesson_total += count($lessons);
						
						//for viewed lesson
						foreach ($lessons as $lesson)
						{	
							if($lesson->id)
							{
							array_push($lecture_ids,$lesson->id);
						    }
							$lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$eachuser['userid'],$eachuser['course_id']);
							
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
		 		if($my_viewed_lesson_total!=0){
		 		echo $my_viewed_lesson_total;?> Lectures completed out of <?php echo $my_lesson_total;?> Lectures
		 			<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $bar_percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bar_percentage;?>%"> <span class="sr-only"><?php echo $bar_percentage;?>% Complete (success)</span> 
						</div>
			    	</div>
			    	<?php }else{
			    		echo "Not started yet!";
			    		} ?>
	            </td>
		        <td><?php echo (($this->Studreport_model->checkCertificateStatus($eachuser['userid'],$eachuser['course_id']))?'Issued':'Not Applicable'); ?></td>
		        <td><a href="<?php echo base_url(); if($auth['groupid']==4){echo 'admin';}else{echo 'teacher';} ?>/enrolled-student/report-manager/<?php echo $eachuser['userid']; ?>/<?php echo $eachuser['course_id']; ?>/" class="btn btn-primary" >View</a></td>
			</tr>
			<?php
			}
		}
		?>
		</tbody> 
		</table>
		</div> 
		<?php
		}
		else
		{
		?>
		<div id="toolbar-box">
		<div class="m"><span class='error' style='font-size:20px'>No Records Available</span></div>
		</div>
		<?php
		}
}

?>
<?php
if($action == 'quizCompletedUsers')
{
   // if(count($CourseCompusers)>0)
	//{ 
	?>
	<div class="clr"></div>

	<h3>Course :- <?php echo $this->Studreport_model->getProgramName($this->uri->segment(4));?></h3>
	<h4>( No of User Completed the Final Exam ) </h4>
	<br />

	<table class="table table-bordered">		
		<thead>
			<tr>
				<th class="text-center">Username</th>
			    <!--<th class="text-center">Quiz ID</th>-->
				<th class="text-center">Quiz Name</th>
				<th class="text-center">Date/Time Taken</b></th>
				<th class="text-center">Score</th>
				<th class="text-center">Report</th>
				<th class="text-center">Certificate</th>
			</tr>
		</thead>	
		
		<tbody>
			<?php
			foreach($quizinfo as $quizzz)
			{
			    $uid=getUserIdExist($quizzz->user_id);
				if($uid)
				{				    
				?>
				<tr>
					<td class="text-center"><?php echo $this->programs_model->getUserName($quizzz->user_id)?></td>
					<td class="text-center">
						<?php
							$quizrept = $this->programs_model->getQuiz($quizzz->quiz_id);		
							echo ucfirst($quizrept->name);
						?>
					</td>
					<td class="text-center"><?php echo $quizzz->date_taken_quiz.' GMT'?></td>
					<td class="text-center"><?php echo str_replace('|','/',$quizzz->score_quiz)?></td>	
					<td class="text-center"><a class="btn btn-blue" href='<?php echo base_url(); ?>admin/student-completed-final-exam/report-manager/<?php echo $quizzz->user_id; ?>/<?php echo $quizzz->pid; ?>/'>View Report</a></td>
					<?php
                        //$certificate_text = $this->Myinfo_model->getCertificateId($quizzz->user_id,$quizzz->pid);
    			        $certificate = $this->Myinfo_model->getCertificateData($quizzz->user_id,$quizzz->pid);  // certificate_text
    					$certificateid =(isset($certificate[0]->certificate_term) ? $certificate[0]->certificate_term : '1');
    					$date_completed =(isset($certificate[0]->date_completed) ? $certificate[0]->date_completed : '2013-04-20');
						$author_id =$this->Myinfo_model->getAuthorId($quizzz->pid);

						$pro_name =$this->Myinfo_model->getProgName($quizzz->pid);

						$certificate_text = $this->Myinfo_model->getUser($author_id);

						$author_name= (isset($certificate_text->first_name) ? $certificate_text->first_name : '');

						$cid='156';

						$certiapprovestatus = $this->Myinfo_model->checkCertificateStatus($quizzz->user_id,$quizzz->pid);

						$urlCourse = strtolower($pro_name);     
						$urlCourse = trim(str_replace(' ', '-', $urlCourse));
						$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

						$urlname = strtolower($author_name);     
						$urlname = trim(str_replace(' ', '-', $urlname));
						$urlname = preg_replace('/[^A-Za-z0-9\-]/', '', $urlname);

						if($certiapprovestatus)
						{
							?>
							<td class="text-center"> <a class="btn btn-green" href="javascript:void(0)" onclick="openWinCertificate1('<?php echo $urlCourse; ?>','<?php echo $urlname ?>','<?php echo $certificateid ?>','<?php echo $date_completed ?>','<?php echo $cid;?>','<?php echo $quizzz->user_id; ?>')" >
							View Certificate</a></td>
							<?php
						}
						else
						{
							?>
							<td class="text-center"> <a class="btn btn-green" href="javascript:void(0)" onclick="alert('Certificate Not Approved Yet')" >
							View Certificate</a></td>
							<?php
						}
						?>
				</tr>		
				<?php
				}
			}
			?>
		</tbody>
	</table>
	<?php
	//}
}
/* -----------------------end of page two ----------------------*/
?>

<?php
/* -----------------------Start of page three ----------------------*/
if($action == 'courseCompleteusers')
{
    if(count($CourseCompusers)>0)
    {	
	?>
	<div class="clr"></div>
	<h3><?php echo $this->Studreport_model->getProgramName($CourseCompusers[0]['pid']);?></h3>
	<br />
	<div class="col-md-12"> 
	<table class="table table-bordered responsive"> 
    	<thead> 
        	<tr> 
            	<th>User ID</th>
    			<th>User Name</th>
    			<th>Date Of Completion</th>
    			<!--<th>Progress</th>
    			<th>Certificate Status</th>-->
    			<th>Action</th> 
			</tr> 
		</thead> 
        <tbody> 
        	<?php
            foreach($CourseCompusers as $eachuser)
            {
              	$uid=getUserIdExist($eachuser['user_id']);
              	if($uid)
              	{			      
		        	?>
		            <tr>
    				    <td><?php echo $eachuser['user_id']; ?></td>
    				    <td><?php echo $this->Studreport_model->getUserName($eachuser['user_id']); ?></td>
    				    <td><?php echo $eachuser['date_completed'].' GMT'; ?></td>    				        
    				    <td><a class="btn btn-primary" href="<?php echo base_url(); ?>admin/student-completed-course/report-manager/<?php echo $eachuser['user_id']; ?>/<?php echo $eachuser['pid']; ?>/">
						View
						</a></td>
           			</tr>
       				<?php
          		}
        	}
       	    ?>
		</tbody> 
	</table>
	</div>     
    <?php
    }
    else
    {
    ?>
       <div id="toolbar-box">
	        <div class="m"><span class='error' style='font-size:20px'>No Records Available</span></div>
       </div>
    <?php
    }
}
?>

<?php
if($action == 'userdetail')
{
    $certidetailarr=array('2'=>'Complete all the lessons','3'=>'Pass the Final exam','4'=>'Pass The Exams In Average','5'=>'Finish All Lessons And Pass Final Exam','6'=>'Finish All Lessons And Exams In Average');
?>
<h3 style="border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2); margin-bottom:0"><?php echo $courseinfo->name;?></h3>

<table class="table table-bordered responsive"> 
<thead> 
<tr>
<div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>User Detail</div>
</tr>
</thead> 

<tbody>
        <tr>

    				        <th>User ID</th>

    				        <th align='left'><?php echo $userinfo->id;?></th>

            </tr>

            <tr>

    				        <th>Username</th>

    				        <th align='left'><?php echo $userinfo->username;?></th>

            </tr>

            <tr>

    				        <th>User Name</th>

    				        <th align='left'><?php echo $userinfo->first_name;?>&nbsp;<?php echo $userinfo->last_name;?></th>

            </tr>

            <tr>

    				        <th>Email</th>

    				        <th align='left'><?php echo $userinfo->email;?></th>

            </tr>

        </tbody>
</table>

   <div class="clr"></div>

<table class="table table-bordered responsive"> 
<thead> 
<tr>
<div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>Course Detail</div>
</tr>

</thead> 

<tbody>

            <tr>

    				        <th>Course ID</th>

    				        <th align='left'><?php echo $courseinfo->id;?></th>

            </tr>

            <tr>

    				        <th>Trainer</th>

    				        <th align='left'><?php echo (($courseinfo->author)?$this->Studreport_model->getUserName($courseinfo->author):'');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

            </tr>

            <tr>

    				        <th>Has Final Exam</th>

    				        <th align='left'><?php echo (($courseinfo->id_final_exam)?'Yes':'No');?></th>

            </tr>

            <tr>

    				        <th>Has Certificate</th>

    				        <th align='left'><?php echo (($courseinfo->certificate_term=='1')?'No':'Yes');?></th>

            </tr>

        </tbody>
</table>

<div class="clr"></div>



<?php

if(count($coursequizinfo)>0)

{

?>






<table class="table table-bordered responsive"> 
<thead> 
<tr>
<div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>Exam Detail</div>
</tr>

</thead> 

        <tbody>

            <tr>

                <th>Final Exam Completed</th>

                <th colspan='5'>Yes</th>

            </tr>

            <tr>

                <th>Exam Name</th>

                <th>Max Score (%)</th>

                <th>Exam Score (%)</th>

                <th>Result</th>

                <th>Exam On</th>

                <th>Action</th>



            </tr>

        <?php        
        foreach($coursequizinfo as $eachquiz)
        {
        ?>
            <tr>

    		    <th><?php echo ucfirst($this->Studreport_model->getQuizNameById($eachquiz['quiz_id'])); ?></th>

    		    <th><?php echo $maxscore=$this->Studreport_model->getQuizMaxScoreById($eachquiz['quiz_id']); ?></th>



    		    <th>
				<?php
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

                 ?>
				 </th>

    		    <th><?php

                    if($avg >= $maxscore)

                    {

                      echo "Pass";

                    }

                    else

                    {

                      echo "Fail";

                    }

                ?></th>

    		    <th><?php echo $eachquiz['date_taken_quiz'].' GMT'; ?></th>

    		    <th>
				<?php
                $webcamstatus=$this->Studreport_model->checkWebcamStatus($eachquiz['pid']);
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

                 ?></th>



            </tr>

        <?php

        }

        ?>



        </tbody>

    </table>







<?php

    }

    if(count($coursequizinfo)==0 && $courseinfo->id_final_exam !='0')

    {

?>

     <div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>Exam Detail</div>

     <div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>Final Exam Not Given</div>

<?php

    }

?>

<?php

  if($courseinfo->certificate_term != '1')

  {

    if($hascertficate)   // fullfilling certificate criteria

    {

?>



    <div class="clr"></div>





<table class="table table-bordered responsive"> 
<thead> 
<tr>
<div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>Certificate Detail</div>
</tr>



        <tbody>

            <tr>

    				        <th>Certificate Term</th>

    				        <th align='left'><?php

                            $ct=$courseinfo->certificate_term;

                            echo $certidetailarr[$ct];?></th>

            </tr>

            <tr>

    				        <th>Status</th>

    				        <th align='left'>Satisfied</th>

            </tr>

            <?php



                $certiStatus=$this->Studreport_model->checkCertificateStatus($userinfo->id,$courseinfo->id);

                if($certiStatus)

                {

            ?>

            <tr>

    				        <th>Issued</th>

    				        <th align='left'>Yes</th>

            </tr>

            <tr>

                            <th>Issued By</th>

                            <th align='left'><?php echo $this->Studreport_model->getUserName($certiStatus->issued_by); ?></th>

            </tr>

            <tr>

                            <th>Issued On</th>

    				        <th align='left'><?php echo $certiStatus->issued_on.' GMT' ?></th>

            </tr>

            <?php

                }

                else

                {

            ?>

              <tr>

    				        <th></th>

    				        <th align='left'>

<a href="<?php echo base_url(); ?>admin/studreport/aprovecerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Approve Certificate</a>

</th>

            </tr>

            <?php

                }

            ?>



        </tbody>

    </table>



<?php

    }

    else

    {

?>

     <div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>Certificate Detail</div>

     <div style='border: solid 1px rgba(219, 217, 217, 0.27);
padding: 10px;
font-size: 16px;
background-color: rgba(208, 209, 210, 0.2);'>Certificate Term :<?php $ct=$courseinfo->certificate_term;

                            echo $certidetailarr[$ct];?><br />

                            Status : Failed</div>

<?php

    }

  }

?>









<?php

}
// else{
// 	?>
<!-- // 			<div id="toolbar-box">
// 		<div class="m"><span style='font-size:20px'>e yet!No any reports availabl</span></div>
// 		</div> -->
	<?php
// }
?>
<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row pagination">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>
<?php } ?>

</div><!-- card -->


<script>
	function openWinCertificate1(t1,t2,t3,t4,t5,t6)
    {
    	
        myWindow=window.open('<?php echo base_url(); ?>admin/studreport/pdf/1/'+t1+'/'+t2+'/'+t3+'/'+t4+'/'+t5+'/'+t6+'','','width=800,height=600, resizable = 0');
		myWindow.focus();
    }
</script>