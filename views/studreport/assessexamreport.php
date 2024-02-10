<style type="text/css">
.text-center {
    text-align: center !important;
    color: #303641 !important; 
    font-weight: bold !important;
}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />-->

<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>

<!--<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>-->

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
    $cancelurl='';

    if($action == 'courseenrollusers')
    {
      $cancelurl='/studreport';
    }
    if($action == 'userdetail')
    {
        $cancelurl='/studreport/viewusers/'.$courseinfo->id;
    }
?>


<header>
    <section class="breadcrumb">
	<div class="container">

	<span class="page-title">Modarate Exam</span>

		<div class="bread-view">
		<a href="<?php echo base_url;?>"><i class="entypo-home"></i></a>
		<span class="ng-hide">/ </span>
		<a href="<?php echo base_url();?>student-course-report">Certification</a>

		<span class="ng-hide">/ </span>
		<a href="<?php echo base_url();?>lessons/enrolled-students/<?php echo $this->uri->segment(6);?>">Enrolled Users</a>

		<span class="ng-hide">/ </span>
		<a href="<?php echo base_url();?>student-course-reports/user/<?php echo $this->uri->segment(5).'/'.$this->uri->segment(6);?>">Users Exam Detail Report</a>

		<span class="ng-hide">/ </span>
		<a href="#">Assess Exam</a>
	</div>

	</div>
	</section>
</header>

<div class="clearfix"></div>


<div class="page-container">

  <div style="background-color: #F5F5F5; display:-webkit-box;">
    <div class="sidebar-menu sb-left"> 
      <!-- Your left Slidebar content. --> 
      <!-- Classes Examples -->
      <ul id="main-menu">
        <li class="root-level"><a href="<?php echo base_url(); ?>courses-manage"><span>My Courses</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>My Exams</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
      </ul>
    </div>
    <div class="main-content">
    <?php
    $showtext = $this->uri->segment(1);    
     if($showtext == "studreport" && $this->uri->segment(2) == "") 
     {
     	?>
    <p class="pcertificate">Following  is  a list of courses taught by you in the Online Academy. Click to view the students courses  progress details. Thereafter you can see their scores and approve the certificates consequently. If the exam is subjective type,you shall have to check the answers,allot the marks and  issue  certificates accordingly.If you have opted for the “ Fool Proof ” exams in the Courses Settings then you can also view the  screen shots and webcam shots of the examinees taken during the exam prior to issuing certificates. </p>
      <?php } ?>
      <div class="row">
        <div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0px;"> <a href="#" class="sidebar-collapse-icon with-animation"> 
          <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
          <i class="entypo-menu"></i> </a> </div>

<!--<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
        <?php
            if($cancelurl != '')
            {
	         	?>
	            <ul style="float:right; list-style:none;">
	               <li id="toolbar-new" class="listbutton">
	                   <a href='<?php echo base_url(); ?><?php echo $cancelurl; ?>/' class='btn btn-danger'>Cancel</a>
	               </li>
	            </ul>
	         	<?php
          	}
        ?>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2></h2></div>
	</div>
</div>-->

<?php
    $this->load->model('Studreport_model');

if($action == 'coursereport')
{
?>
<div class="col-md-12"> 
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<thead>
				<tr>					
					<th style="font-weight: bold">Course</th>
					<th style="font-weight: bold">Enrolled Students</th>
					<th style="font-weight: bold">Students Completed the Course</th>
					<th style="font-weight: bold">Students Completed the Final Exam</th>
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
					<td><?php echo $eachcourse->name ?></td>
					<?php
					$urlcourse = strtolower($eachcourse->name);			
					$urlcourse = trim(str_replace(' ', '-', $urlcourse));
					$urlcourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlcourse);
					?>
					<!-- <td><a href="<?php echo base_url(); ?>studreport/viewusers/<?php echo $eachcourse->id; ?>"><?php echo 'View ('.count($estud).')'; ?></a></td> -->
					<td><a href="<?php echo base_url(); ?><?php echo $urlcourse ?>/enrolled-students/<?php echo $eachcourse->id; ?>"><?php echo 'View ('.count($estud).')'; ?></a></td>
					
					<td><a href="<?php echo base_url(); ?><?php echo $urlcourse ?>/students-completed-course/<?php echo $eachcourse->id; ?>"><?php echo 'View ('.count($ccstud).')'; ?></a></td>
					
					<td><a href="<?php echo base_url(); ?><?php echo $urlcourse ?>/students-completed-exam/<?php echo $eachcourse->id; ?>"><?php echo 'View ('.count($quiz_id).')'; ?></a></td>				
					
				
				
					<!--<td><a href="<?php echo base_url(); ?>studreport/viewusers/<?php echo $eachcourse->id; ?>">

<img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View Course Report">



          </a></td>-->

                        </tr>

                 <?php

                  }

                 ?>
				
			</tbody>
</table> 

</div>





<?php

}

?>





<?php

if($action == 'courseenrollusers')

{

    if(count($enrolledusers)>0)

    {

?>
<div class="clr"></div>
<h3>Details of Student Enrolled in: <?php echo $this->Studreport_model->getProgramName($enrolledusers[0]['course_id']);   ?></h3>
<h4><?php echo $this->Studreport_model->getProgramName($enrolledusers[0]['course_id']);?></h4>

<br />




<div class="col-md-12"> 
	<table class="table table-bordered responsive"> 
    	<thead> 
        	<tr> 
            	<th>User ID</th>
    			<th>User Name</th>
    			<th>Date Of Enroll</th>
    			<th>Progress</th>
    			<th>Certificate Status</th>
    			<th>Status</th> 
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

    				        <td><?php echo $eachuser['buy_date'].' GMT'; ?></td>

    				        <td>
							<?php
                            $completedprogress = $this->Studreport_model->courseCompleted($eachuser['userid'],$eachuser['course_id']);
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

                                //echo $lesson_module_progress;

                        	}

                        	else{

                        	  //print_r($course->course_id);

                                $lesson_module_progress = $this->Studreport_model->getLastViewedLessandMod($eachuser['userid'],$eachuser['course_id']);

                                //print_r($lesson_module_progress);

                                }

                            if(isset($lesson_module_progress)){

                        	    echo $lesson_module_progress;

                        	}else{

                			    echo "";

                			}
                			$this->load->model('admin/programs_model');
							$coursename=$this->programs_model->getCoursename5($eachuser['course_id']);
							//print_r($coursename->name);
                			  $studName = $this->Studreport_model->getUserName($eachuser['userid']);

       //          			$urlstudcourse = strtolower($coursename->name);			
							// $urlstudcourse = trim(str_replace(' ', '-', $urlstudcourse));
							// $urlstudcourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlstudcourse);

                			$urlstudname = strtolower($studName);			
							$urlstudname = trim(str_replace(' ', '-', $urlstudname));
							$urlstudname = preg_replace('/[^A-Za-z0-9\-]/', '', $urlstudname);

							$certifi_term = $this->programs_model->getCertifiTerm($eachuser['course_id'],$eachuser['userid']);

						

                         ?>





                            </td>

    				        <td><?php echo (($this->Studreport_model->checkCertificateStatus($eachuser['userid'],$eachuser['course_id']))?'Issued':'Not Issued'); ?></td>

    				        <!-- <td><a class="btn btn-blue" href="<?php echo base_url(); ?>studreport/viewuserreport/<?php echo $eachuser['userid']; ?>/<?php echo $eachuser['course_id']; ?>/"> -->
    				        <td><a class="btn btn-blue" href="<?php echo base_url(); ?>student-course-reports/<?php echo $urlstudname ?>/<?php echo $eachuser['userid']; ?>/<?php echo $eachuser['course_id']; ?>/">

<!--<img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View Course Report">-->
View
</a></td>

              </tr>

        <?php
          }
        }

        ?>
		</tbody> 
	</table> 
    
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
</div>


<?php

if($action == 'quizCompletedUsers')

{
         if(count($CourseCompusers)>0)

        {
	
 
?>
<div class="clr"></div>

<h3> Details of Student Completed Final Exam of the course:Non-Sequential cum final exam Course</h3>
<h4><?php echo $this->Studreport_model->getProgramName($CourseCompusers[0]['pid']);?></h4>

<br />

    <table class="table table-bordered">
		
		
		<thead>
			<tr>
				<th class="text-center">Username</th>
			    <!--<th class="text-center">Quiz ID</th>-->
				<th class="text-center">Exam Name</th>
				<th class="text-center">Date/Time Taken</b></th>
				<th class="text-center">Score</th>
				<th class="text-center">View Certificate</th>
			</tr>
		</thead>	
		
		<tbody>
			<?php
			foreach($quizinfo as $quizzz)
			{
			   /*  echo '<pre>';
					print_r($quizzz);
			    echo '</pre>'; */
				 $uid=getUserIdExist($quizzz->user_id);
				  if($uid)
				  {
				    
				?>
				<tr>
					<td class="text-center"><?php echo $this->programs_model->getUserName($quizzz->user_id)?></td>
					<!--<td class="text-center"><?php echo $quizzz->quiz_id?></td>-->
					<td class="text-center">
						<?php
							$quizrept = $this->programs_model->getQuiz($quizzz->quiz_id);		
							echo ucfirst($quizrept->name);
						?>
						<?php
						// 	$urlCourse5 = strtolower($this->Studreport_model->getProgramName($CourseCompusers[0]['pid']));			
						// $urlCourse5 = trim(str_replace(' ', '-', $urlCourse5));
						// $urlCourse5 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse5);

						$urlCourse6 = strtolower($this->programs_model->getUserName($quizzz->user_id));			
						$urlCourse6 = trim(str_replace(' ', '-', $urlCourse6));
						$urlCourse6 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse6);
						?>
					</td>
					<td class="text-center"><?php echo $quizzz->date_taken_quiz?></td>
					<td class="text-center"><?php echo str_replace('|','/',$quizzz->score_quiz)?></td>	
					<!-- <td class="text-center"><a class="btn btn-blue" href='<?php echo base_url(); ?>studreport/getUserCertificate/<?php echo $quizzz->user_id; ?>/<?php echo $quizzz->pid; ?>/'>View</a></td> -->
					<td class="text-center"><a class="btn btn-blue" href='<?php echo base_url(); ?>student-course-report/<?php echo $urlCourse6 ?>/<?php echo $quizzz->user_id; ?>/<?php echo $quizzz->pid; ?>/'>View</a></td>
				
				</tr>		
				<?php
				}
			}
			?>
		</tbody>
</table>
<?php
  }

}

?>

<?php

if($action == 'courseCompleteusers')

{

    if(count($CourseCompusers)>0)

    {
	
	
?>
<div class="clr"></div>
<h3>Details of Student Completed the course: <?php echo $this->Studreport_model->getProgramName($CourseCompusers[0]['pid']);?></h3>
<h4><?php echo $this->Studreport_model->getProgramName($CourseCompusers[0]['pid']);?></h4>

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
    			<th>Status</th> 
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

    				        <td><?php echo $eachuser['date_completed']; ?></td>

    				        <!--<td>
							<?php
                             $lesson_module_progress = $this->Studreport_model->getLastViewedLessandMod($eachuser['user_id'],$eachuser['pid']);
                   

                            if(isset($lesson_module_progress)){

                        	    echo $lesson_module_progress;

                        	}else{

                			    echo "";

                			}



                         ?>





                            </td>

    				        <td><?php echo (($this->Studreport_model->checkCertificateStatus($eachuser['user_id'],$eachuser['pid']))?'Issued':'Not Issued'); ?></td>-->

    				       <!--  <td><a class="btn btn-blue" href="<?php echo base_url(); ?>studreport/viewuserreport/<?php echo $eachuser['user_id']; ?>/<?php echo $eachuser['pid']; ?>/"> -->
    				       	<?php
    				       		$urlCourse7 = strtolower($this->Studreport_model->getUserName($eachuser['user_id']));			
								$urlCourse7 = trim(str_replace(' ', '-', $urlCourse7));
								$urlCourse7 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse7);
    				       	?>
    				        <td><a class="btn btn-blue" href="<?php echo base_url(); ?>student-course-reports/<?php echo $urlCourse7 ?>/<?php echo $eachuser['user_id']; ?>/<?php echo $eachuser['pid']; ?>/">

<!--<img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View Course Report">-->
View
</a></td>

              </tr>

        <?php
          }
        }

        ?>
		</tbody> 
	</table> 
    
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

    $certidetailarr=array('2'=>'Complete all the lessons','3'=>'Pass the Final exam','4'=>'Pass The Exams in Average','5'=>'Finish All Lessons And Pass Final Exam','6'=>'Finish All Lessons And Pass Exams In Average');

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
background-color: rgba(208, 209, 210, 0.2); text-align:center; color: #303641; font-weight: bold;'>User Detail</div>
</tr>

</thead> 

<tbody>

            <tr>

    				        <th class="text-center">User ID</th>

    				        <th align='left'><?php echo $userinfo->id;?></th>

            </tr>

            <tr>

    				        <th class="text-center">Username</th>

    				        <th align='left'><?php echo $userinfo->username;?></th>

            </tr>

            <tr>

    				        <th class="text-center">Name of student</th>

    				        <th align='left'><?php echo $userinfo->first_name;?>&nbsp;<?php echo $userinfo->last_name;?><input type="hidden" value="<?php echo $userinfo->first_name;?>" id="uname"></th>

            </tr>

            <tr>

    				        <th class="text-center">Email</th>

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
background-color: rgba(208, 209, 210, 0.2); text-align:center; color: #303641; font-weight: bold;'>Course Detail</div>
</tr>

</thead> 

<tbody>

            <tr>

    				        <th class="text-center">Course ID</th>

    				        <th align='left'><?php echo $courseinfo->id;?></th>

            </tr>

            <tr>

    				        <th class="text-center">Trainer</th>

    				        <th align='left'><?php echo (($courseinfo->author)?$this->Studreport_model->getUserName($courseinfo->author):'');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

            </tr>

            <tr>

    				        <th class="text-center"> Course has Final Exam</th>

    				        <th align='left'><?php echo (($courseinfo->id_final_exam)?'Yes':'No');?></th>

            </tr>

            <tr>

    				        <th class="text-center">Course has Certificate</th>

    				        <th align='left'><?php echo (($courseinfo->certificate_term=='1')?'No':'Yes');?></th>

            </tr>

        </tbody>
</table>

<div class="clr"></div>
<!-- new code start here -->

<table class="table table-bordered">
		

		 <thead>
		 			<tr>
						<th colspan=9 class="text-center" style="font-size:16px;"><b>Questions Details</b></th>
					</tr>
		               <tr class="guru_orderhead">
                        <th width="15%" class="text-center">Question No.</th>
                         <th width="15%" class="text-center">Question</th>
                        <th width="15%" class="text-center">Question Type</th>
                        <th width="15%" class="text-center">Correct Answer</th>   
                        <th width="15%" class="text-center">Given Answer</th>
                        <th width="15%" class="text-center">Question Marks</th>
                        <th width="15%" class="text-center">Obtain Marks</th>   
                                      
           
                    </tr>
                </thead>
		
		 <tbody>
				<?php
				 

				   $iii = 1;
					foreach($activeData as $examinfo)
					{	
						// echo"<pre>";
						// print_r($examinfo);
						
						$ques_opt = $this->questions_model->getAnsOptions($examinfo->question_id);

						$questionData =  $this->questions_model->getQuestions($examinfo->question_id);
                        
                      
						 $answer = $this->questions_model->getAnswer($examinfo->question_id,$questionData->question_type);

				?>
			<tr>
				<td><?php echo $iii;   ?></td>
				<td><?php echo $examinfo->question; ?></td>
				<td><?php echo $questionData->question_type; ?></td>
				<td><a href="<?php echo base_url(); ?>studreport/viewCorrectAns/<?php echo $examinfo->question_id?>" class="viewqueans">View</a></td>					
				<td><a href="<?php echo base_url(); ?>studreport/viewGivenAns/<?php echo $examinfo->question_id?>/<?php echo $this->uri->segment(4) ?>" class="viewqueans">View</a></td>
					

					<?php
		$totalMarksOutOf =0;
	$totalMarksObtained =0;
	$CI = & get_instance();
	$CI->load->model('lessons_model');
	$CI->load->model('questions_model');
	
	$totalMarksOutOf1 =0;
	//$givenData =  $CI->questions_model->getGivenAnsOptions($examinfo->question_id,$courseinfo->id,$examinfo->attempt_code);
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
		// echo"<br/>total=>".$totalMarksOutOf1;		
foreach($data_right as $rights)
{	
		
	//for right answer							
	if($rights->question_type == 'match_the_pair')
	{								
		$totalMarksOutOf+= $rights->points;								
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
				<th colspan=9 class="text-center" style="font-size:16px;"><b>Exams Details</b></th>
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
						$user = $this->uri->segment(5);
						$program = $this->uri->segment(6);
						$quiz = $quizdetail->quiz_id;
						$attempt = $quizdetail->attempt_no;
						?>
						<td><!-- <a href="<?php echo base_url(); ?>studreport/pendings/2/25/46/2"><?php echo $quizdetail->result;?></a>  -->
						<a href='<?php echo base_url(); ?>studreport/pendings/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>'><?php echo $quizdetail->result;?></a>
						</td>
						<?php
					}
					else if($quizdetail->result == '')//for recalculating
					{
						$user = $this->uri->segment(5);
						$program = $this->uri->segment(6);
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
                    <a  href="<?php echo base_url(); ?>studreport/viewsnap/<?php echo $quizdetail->snapfoldername.'/'.$quizdetail->attempt_no.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$quizdetail->attempt_code;?>" style='text-decoration:none' class='viewsnap'>View Snap</a>
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
			<input type="button" name="btnstatus" value="Save" id="btnstatus" onclick="updateResult('<?php echo $this->uri->segment(5);?>','<?php echo $this->uri->segment(6);?>','<?php echo $quizdetail->quiz_id;?>','<?php echo $this->uri->segment(4);?>');" class="btn btn-success" style="margin-left: 526px;">
		</td>
		</tr>
		</tbody>
</table>
</form>
<!-- new code end here -->


<?php

}

?>
<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
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


<div class="clearfix"></div>

</div>
</div>
</div>
</div>

<script>
			(function($) {
				$(document).ready(function() {
					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			}) (jQuery);
	</script> 
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
			url: "<?php echo base_url();?>studreport/updateResultStatus",
			data: {resultstatus:resultstatus,user:user,proid:proid,mediaid:mediaid,attempt_code:attempt_code,txtareanotice:txtareanotice,sendmail:sendmail}, 
			success: function(data)
			{
				
				//alert(data);
				//location.reload();
				 var uname= $("#uname").val();
				window.location.href = "<?php echo base_url()?>student-course-report/"+uname+"/"+user+"/"+proid+"/";
			}
		  });
      
   }

 	}
</script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){
                               //Examples of how to assign the Colorbox event to elements
                               
                         //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});                        
                       $j(".viewqueans").colorbox({
                               iframe:true,
                               width:"600px", 
                               height:"420px",
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
                               //initialWidth:"100",
                               nitialHeight:"50"
                                                                                                 
                                               })
                       

                   });

                        </script>