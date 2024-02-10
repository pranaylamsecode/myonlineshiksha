<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
  $this->load->model('admin/programs_model');
  $this->load->model('admin/Studreport_model');
?>


<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
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
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

<?php

    $cancelurl='';
    if($action == 'courseenrollusers')
    {
      $cancelurl='/teachercourses';
    }
    if($action == 'userdetail')
    {
         $cancelurl='/teachercourses/viewusers/'.$courseinfo->id;
    }


?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">

        <?php
            if($cancelurl != '')
            {
         ?>
            <ul>
               <li id="toolbar-new" class="listbutton">
                   <a href='<?php echo base_url(); ?>admin<?php echo $cancelurl; ?>/' class='bforward'><span class="icon-32-cancel"> </span>Cancel</a>
               </li>
            </ul>
          <?php
          }
          ?>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'My Courses';?></h2></div>
	</div>
</div>


<?php

if($action == 'mycoursereport')
{
  if(count($programs)>0)
  {
?>
<div class="content">
	<div class="clr"></div>

    <table class="adminlist" width="100%">
<thead>
	<tr>
	   <th width="5">
        <input type="checkbox" value="" name="toggle" onclick="checkAll(5)">
       </th>
	   <th width="20">ID</th>
	   <th>Course</th>
	   <th>Category	</th>
	   <th>Students Enrolled</th>
	  <!-- <th>Publish</th>     -->
       <th width="100">Action</th>
   </tr>
</thead>
<?php if ($programs): ?>
<tbody>
<?php $i=0;?>
<?php foreach ($programs as $program): ?>
	<tr class="camp<?php echo $i;?>">

		<td>
            <input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $program->id?>">
        </td>

        <td>
	     	<?php echo $program->id;?>
        </td>

	    <td>

		    <?php /* ?><a href="<?php echo base_url(); ?>admin/days/<?php echo $program ->id?>" class="a_mlms"> <?php */ ?>
			<?php echo $program->name?>
           <?php /* ?> </a> <?php */ ?>
		</td>

    	<td>
			<?php echo $this->programs_model->getCatNameByCatID($program->catid)?>
        </td>

		<td align="center">
              <?php
                $estud=$this->programs_model->getEnrolledUser($program->id);
                echo count($estud);
              ?>
		</td>


	   <?php /* ?>	<td align="center">
    	   	<a title="Unpublish Item" href="<?php echo base_url(); ?>admin/programs/unpublish/<?php echo $program ->id?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>

    		<a title="Publish Item" href="<?php echo base_url(); ?>admin/programs/publish/<?php echo $program ->id?>"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>
        </td>   <?php */ ?>


        <td>

            <a href="<?php echo base_url(); ?>admin/teachercourses/viewusers/<?php echo $program->id; ?>">
                <img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View Enrolled Student">
            </a>

        </td>
</tr>
<?php endforeach ?>
<?php else: ?>
<tr>
    <td colspan="6">
<?=lang('web_no_elements');?>
</td>
</tr>
<?php endif ?>
</tbody>
</table>
</div>
<?php
}
else
{
?>
<div id="toolbar-box">
	        <div class="m"><span class='error' style='font-size:20px'>No Course Assign Yet</span></div>
</div>
<?php
}
}// end of action
?>



<?php
if($action == 'courseenrollusers')
{
    if(count($enrolledusers)>0)
    {
?>
<div class="content">
    <div style='border: solid 1px;height:30px;font:25px bold;background-color:#d0d1d2;text-align:center'><?php echo $this->programs_model->getProgramName($enrolledusers[0]['course_id']);?></div>
	<div class="clr"></div>
    <table class="adminlist" width="100%">
        <thead>
              <tr>
    				        <th>User ID</th>
    				        <th>User Name</th>
    				        <th>Date Of Enroll</th>
    				        <th>Progress</th>
    				        <th>Certificate Status</th>
    				        <th>Action</th>
              </tr>
        </thead>
        <tbody>
            <?php

            foreach($enrolledusers as $eachuser)
            {
        ?>
             <tr>
    				        <td><?php echo $eachuser['userid']; ?></td>
    				        <td><?php echo $this->programs_model->getUserName($eachuser['userid']); ?></td>
    				        <td><?php echo $eachuser['buy_date']; ?></td>
    				        <td>


                            	<?php
                           $completedprogress = $this->programs_model->courseCompleted($eachuser['userid'],$eachuser['course_id']);

                            if(isset($completedprogress->completed) && $completedprogress->completed == '1' ){
                    		   $completed_progress = "true";
                    		}else{
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
                                $lesson_module_progress = $this->programs_model->getLastViewedLessandMod($eachuser['userid'],$eachuser['course_id']);
                                //print_r($lesson_module_progress);
                                }
                            if(isset($lesson_module_progress)){
                        	    echo $lesson_module_progress;
                        	}else{
                			    echo "";
                			}

                         ?>


                            </td>
    				        <td><?php echo (($this->programs_model->checkCertificateStatus($eachuser['userid'],$eachuser['course_id']))?'Issued':'Not Issued'); ?></td>
    				        <td><a href="<?php echo base_url(); ?>admin/teachercourses/viewuserreport/<?php echo $eachuser['userid']; ?>/<?php echo $eachuser['course_id']; ?>/">
<img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View Course Report">
</a></td>
              </tr>
        <?php
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

<div class="content">

    <div style='border: solid 1px;height:30px;font:25px bold;background-color:#d0d1d2;text-align:center'><?php echo $courseinfo->name;?></div>
    <div>
    <div style='border: solid 1px;height:20px;font:20px bold;background-color:#d0d1d2'>User Detail</div>
    <table class="adminlist" width="100%">

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
    </div>

    <div class="clr"></div>

    <div>
    <div style='border: solid 1px;height:20px;font:20px bold;background-color:#d0d1d2'>Course Detail</div>
    <table class="adminlist" width="100%">

        <tbody>
            <tr>
    				        <th>Course ID</th>
    				        <th align='left'><?php echo $courseinfo->id;?></th>
            </tr>
            <tr>
    				        <th>Trainer</th>
    				        <th align='left'><?php echo (($courseinfo->author)?$this->programs_model->getUserName($courseinfo->author):'');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
    </div>

    <div class="clr"></div>

    <?php
     if(count($coursequizinfo)>0)
     {
    ?>

    <div>
       <div style='border: solid 1px;height:20px;font:20px bold;background-color:#d0d1d2'>Exam Detail</div>

    <table class="adminlist" width="100%">

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
    		    <th><?php echo ucfirst($this->programs_model->getQuizNameById($eachquiz['quiz_id'])); ?></th>
    		    <th><?php echo $maxscore=$this->programs_model->getQuizMaxScoreById($eachquiz['quiz_id']); ?></th>

    		    <th><?php
                            list($rq,$tq)=explode('|',$eachquiz['score_quiz']);
                            if($rq == '0' || $tq == '0')
                            {
                              echo '0';
                            }
                            else
                            {
                              echo $avg=($rq/$tq)*100;
                            }
                 ?></th>
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
    		    <th><?php echo $eachquiz['date_taken_quiz']; ?></th>
    		    <th><?php
                $webcamstatus=$this->programs_model->checkWebcamStatus($eachquiz['pid']);
                if($webcamstatus)
                {
                   if($eachquiz['snapfoldername'] !='')
                    {
                 ?>
                       <a href="<?php echo base_url(); ?>admin/teachercourses/viewsnap/<?php echo $eachquiz['snapfoldername'];?>" style='text-decoration:none' class='fancybox fancybox.iframe'>View Snap</a>
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


</div>
<?php
    }
    if(count($coursequizinfo)==0 && $courseinfo->id_final_exam !='0')
    {
?>
     <div style='border: solid 1px;height:20px;font:20px bold;background-color:#d0d1d2'>Exam Detail</div>
     <div style='border: solid 1px;height:20px;font:16px bold;text-align:center'>Final Exam Not Given</div>
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

    <div>
    <div style='border: solid 1px;height:20px;font:20px bold;background-color:#d0d1d2'>Certificate Detail</div>
    <table class="adminlist" width="100%">

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

                $certiStatus=$this->programs_model->checkCertificateStatus($userinfo->id,$courseinfo->id);
                if($certiStatus)
                {
            ?>
            <tr>
    				        <th>Issued</th>
    				        <th align='left'>Yes</th>
            </tr>
            <tr>
                            <th>Issued By</th>
                            <th align='left'><?php echo $this->programs_model->getUserName($certiStatus->issued_by); ?></th>
            </tr>
            <tr>
                            <th>Issued On</th>
    				        <th align='left'><?php echo $certiStatus->issued_on ?></th>
            </tr>
            <?php
                }
                else
                {
            ?>
              <tr>
    				        <th></th>
    				        <th align='left'>
<a href="<?php echo base_url(); ?>admin/teachercourses/aprovecerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Approve Certificate</a>
</th>
            </tr>
            <?php
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
     <div style='border: solid 1px;height:20px;font:20px bold;background-color:#d0d1d2'>Certificate Detail</div>
     <div style='border: solid 1px;height:40px;font:16px bold;text-align:center'>Certificate Term :<?php $ct=$courseinfo->certificate_term;
                            echo $certidetailarr[$ct];?><br />
                            Status : Failed</div>
<?php
    }
  }
?>




<?php
}
?>















