<style type="text/css">
.table {
	font-size:12px !important;
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
		
		<?php
		if($action == 'coursereport')
		{
			?>
			<span class="page-title">Certification</span>

			<div class="bread-view">
			<a href="<?php echo base_url;?>"><i class="entypo-home"></i></a>
			<span class="ng-hide">/ </span>
			<a href="#">Certification</a>
			<?php
		}else if ($action == 'courseenrollusers') 
		{
			?>
			<span class="page-title">Enrolled Users</span>

			<div class="bread-view">
			<a href="<?php echo base_url;?>"><i class="entypo-home"></i></a>
			<span class="ng-hide">/ </span>
			<a href="<?php echo base_url();?>student-course-report">Certification</a>

			<span class="ng-hide">/ </span>
			<a href="#">Enrolled Users</a>
			<?php
		}else if ($action == 'userdetail') 
		{
			?>
			<span class="page-title">Users Exam Detail Report</span>

			<div class="bread-view">
			<a href="<?php echo base_url;?>"><i class="entypo-home"></i></a>
			<span class="ng-hide">/ </span>
			<a href="<?php echo base_url();?>student-course-report">Certification</a>

			<span class="ng-hide">/ </span>
			<a href="<?php echo base_url();?>lessons/enrolled-students/<?php echo $this->uri->segment(4);?>">Enrolled Users</a>

			<span class="ng-hide">/ </span>
			<a href="#">Users Exam Detail Report</a>
			<?php
		}
		?>
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
        	<li class="root-level"><a href="<?php echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>Manage Question Papers</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>questions/manage"><span>Manage Questions</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
      </ul>
    </div>
    <div class="main-content">
    <?php
    $showtext = $this->uri->segment(1);    
     if($showtext == "studreport" && $this->uri->segment(2) == "") 
     {
     	?>
    <p>Following  is  a list of courses taught by you in the Online Academy. Click to view the students courses  progress details. Thereafter you can see their scores and approve the certificates consequently. If the exam is subjective type,you shall have to check the answers,allot the marks and  issue  certificates accordingly.If you have opted for the “ Fool Proof ” exams in the Courses Settings then you can also view the  screen shots and webcam shots of the examinees taken during the exam prior to issuing certificates. </p>
      <?php } ?>
      <div class="row">
        <div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0px; margin-left:20px;"> <a href="#" class="sidebar-collapse-icon with-animation"> 
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
      //   if(count($CourseCompusers)>0)

      //  {
	
 
?>
<div class="clr"></div>

<h3> Details of Student Completed Final Exam of the course:Non-Sequential cum final exam Course</h3>
<h4><?php echo $this->Studreport_model->getProgramName($this->uri->segment(3));?></h4>

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
					<td class="text-center"><?php echo $quizzz->date_taken_quiz.' GMT'?></td>
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
 // }

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

    				        <td><?php echo $eachuser['date_completed'].' GMT'; ?></td>

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

    				        <th>Name of student</th>

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

    				        <th> Course has Final Exam</th>

    				        <th align='left'><?php echo (($courseinfo->id_final_exam)?'Yes':'No');?></th>

            </tr>

            <tr>

    				        <th>Course has Certificate</th>

    				        <th align='left'><?php echo (($courseinfo->certificate_term=='1')?'No':'Yes');?></th>

            </tr>

        </tbody>
</table>

<table class="table table-bordered">
		<?php
			if($courseinfo->id_final_exam)
			{
		?>
		<thead>
			<tr>
				<th colspan=7 class="text-center"><b>Exam Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td colspan=4 class="text-center">Final Exam Completed</td>
				<td colspan=3><?php echo (intval($finalexamcomplete) > 0) ? 'Yes' : 'No'; ?></td>
			</tr>	
		</tbody>
		<?php
			}
		?>

		<thead>
			<tr>
				<th class="text-center">Exam Name</th>
				<th class="text-center">Pass Marks(%)</th>
				<th class="text-center">Marks Secured(%)</th>
				<th class="text-center">Result</th>
				<th class="text-center">Exam taken On</th>
				<th class="text-center">Access Exam</th>
				<th class="text-center">Fool Proof Records</th>
			</tr>
		</thead>	
		
		<tbody>
		<?php 		

        if($quizinformation)
        {
		foreach($quizinformation as $quizzz)
        {

		?>
			<tr>
				<td><?php
							$quizrept = $this->programs_model->getQuiz($quizzz->quiz_id);		
							echo ucfirst($quizrept->name);
						?></td>				
				<td><?php echo $maxscore=$this->programs_model->getQuizMaxScoreById($quizzz->quiz_id);?></td>
				<td><?php 
                          if($quizzz->score_quiz)
                          {
							$first= explode("|", @$quizzz->score_quiz);
			                    echo @$res = intval(($first[0]/$first[1])*100); 

			                           @$total_prcnt[] = $first[0];
			                           @$out_of[] = $first[1];
			               }
			               else
			               {
			               	  echo '';
			               }

			                   ?>
                 </td>
				<?php
					if($quizzz->result == 'Pending')
					{
						$user = $this->uri->segment(3);
						$program = $this->uri->segment(4);
						$quiz = $quizzz->quiz_id;
						$attempt = $quizzz->attempt_no;
						?>
						<td><a href='<?php echo base_url(); ?>studreport/pendings/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>'><?php echo $quizzz->result;?></a></td>
						<?php
					}else
					{
						?>
						<td><?php echo $quizzz->result;?></td>
						<?php
					}
				?>
				<td><?php echo $quizzz->date_taken_quiz.' GMT'; ?></td>
				<td><a href="<?php echo base_url()?>studreport/viewexam/<?php echo $quizzz->id; ?>/<?php echo $quizzz->attempt_code; ?>/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>">View Exam</a></td>
				<td><?php
                $webcamstatus=$this->programs_model->checkWebcamStatus($quizzz->pid);
                if($webcamstatus)
                {
                    if($quizzz->snapfoldername !='')
                    {
                    ?>
                    <a href="<?php echo base_url(); ?>studreport/viewsnap/<?php echo $quizzz->snapfoldername; ?>/<?php echo $quizzz->attempt_no; ?>/<?php echo $quizzz->attempt_code; ?>" style='text-decoration:none' class='viewsnap'>View Snap</a>
					<?php
                    }
                    else
                    {
                      echo "No";
                    }
                }
                else
                {
                    echo "No";
                }
                ?></td>
			</tr>		
		<?php
		}
	}
?>
		</tbody>
</table>
<?php
	if($certterm != 1)
	{
?>
<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=2 class="text-center"><b>Certificate Details<b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td class="text-center">Certification Criteria</td>
				<td><?php 
					 $ct=$courseinfo->certificate_term;
                    echo $certidetailarr[$ct];
					?></td>
			</tr>			
			<tr>
				<td class="text-center">Criteria Fulfilled </td>
				<td><?php 

				       if(isset($total_prcnt))
				       {
				          $ciel = 0;
				       

							foreach($total_prcnt as $total_prcnt)
							{
								$ciel += $total_prcnt; 
							}
							$floor = 0;
							foreach($out_of as $out_of)
							{
								$floor += $out_of; 
							}
                       }
						
						@$prcntg = ($ciel/$floor )*100;

						if($prcntg > '40')
						{
							echo $Fulfilled =  'Yes';
						}
						else
						{
							echo $Fulfilled =  'No';
						}
				?></td>				
			</tr>	
		<?php
			$certiStatus=$this->programs_model->checkCertificateStatus($userinfo->id,$courseinfo->id);

			if($certiStatus)
			{
		?>
			<tr>
				<td class="text-center">Issued</td>
				<td align='left'>Yes</td>
			</tr>
			<tr>
				<td class="text-center">Issued By</td>
				<td align='left'><?php echo $this->programs_model->getUserName($certiStatus->issued_by); ?></td>
			</tr>
			<tr>
				<td class="text-center">Issued On</td>
				<td align='left'><?php echo $certiStatus->issued_on.' GMT' ?></td>
			</tr>
		<?php
			}
			else
			{
			 $CI = & get_instance();
	 		$CI->load->model('studreport_model');
	 		$statusCerti = $CI->Studreport_model->getCompletedStatus($userinfo->id,$courseinfo->id);
	 

	  		if(@$courseinfo->certificate_term == @$statusCerti->certificate_term && @$statusCerti->completed == '1')
       			{
	// if($Fulfilled == 'Yes')
	// {

		 //if($ct > 1)
		 //{	
			?>
			<tr>
				<td></td>
				<td align='left'>
				<a href="<?php echo base_url(); ?>studreport/aprovecerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Approve Certificate </a>
				</td>
			</tr>
		<?php
		//}
				}
		  }
		?>
		</tbody>
  </table>
  <?php
  	}
  ?>

<div class="clr"></div>




<?php

}

?>



<div class="clearfix"></div>

</div>
</div>
</div>
</div>

<script>
			//(function($) {
					var $ =jQuery.noConflict();
				$(document).ready(function() {
					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			//}) (jQuery);
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
                               //initialWidth:"100",
                               nitialHeight:"50"
                                                                                                 
                                               })
                       

                   });

                        </script>