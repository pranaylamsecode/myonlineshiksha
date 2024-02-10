
<?php

$lessonsch = array();

$lessonshasvalue = false;

foreach ($days as $day){

$lessonsch = $this->Program_model->getLessons($day->id);

if(empty($lessonsch)){

continue;

}

else{

$lessonshasvalue = true;

break;

}

}

//echo ($lessonshasvalue)?'show program':'hide program';

$pro_id = (isset($programs->id)) ? $programs->id : '';

$coursetype_details = $this->Program_model->getCourseTypeDetails ($pro_id);





///if($user_id > 0 && $coursetype_details[0]["course_type"] != 0  && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE){?>

              <!--<td align="left">

			<?php //echo JText::_("GURU_AVAILABILITY"); ?>

		</td>-->

      <?php //}



if($user_id > 0){

	$date_enrolled = $this->Program_model->datebuynow($pro_id, $user_id);

	if(count($date_enrolled) > 0){

	$not_show = true;

	}

	else{

	$not_show = false;

	}

	if(!$hasaccess){

	$not_show = FALSE;

	}

	$date_enrolled = (count($date_enrolled) > 0) ? $date_enrolled->buydate : '';

	$date_enrolled = strtotime($date_enrolled);

}





if(isset($date_enrolled)){

	$start_relaese_date1 = (isset($coursetype_details[0]["start_release"])) ? $coursetype_details[0]["start_release"] : '';

	$start_relaese_date = strtotime($start_relaese_date1);

	$start_date =  $date_enrolled;



	$datestring = "%Y-%m-%d";

	$time = time();

	$date_9 = mdate($datestring, $time);

	//$date9 = strtotime($date9);

	$date9 = $date_9;

	$date_9 = date("Y-m-d",strtotime($date9));



	$date9 = strtotime($date9);

	$interval = abs($date9 - $start_date);



	$dif_days = floor($interval/(60*60*24));

	$dif_week = floor($interval/(60*60*24*7));

	$dif_month = floor($interval/(60*60*24*30));



	if((isset($coursetype_details[0]["course_type"])) && $coursetype_details[0]["course_type"] == 1){

		if($coursetype_details[0]["lesson_release"] == 1){

			$diff_start = $dif_days+1;

			$diff_date = $dif_days+1;



		}

		elseif((isset($coursetype_details[0]["lesson_release"])) && $coursetype_details[0]["lesson_release"] == 2){

			//$dif_days_enrolled = $dif_days_enrolled /7;

			$diff_start = $dif_week+1;

			$diff_date = $dif_week+1;

		}

		elseif((isset($coursetype_details[0]["lesson_release"])) && $coursetype_details[0]["lesson_release"] == 3){

			//$dif_days_enrolled = $dif_days_enrolled /30;

			$diff_start = $dif_month+1;

			$diff_date = $dif_month+1;

		}

	}

}

//echo $diff_start;

$step_less = 0;



?>





<!--lightbox scripts and style      -->



<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/udamy1.css" media="screen" />-->

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

<script type="text/javascript">

/*function formSubmit()

{

window.getElementById("webinarpost").submit();

}function formSubmit(){

		$('#webinarpost').submit();

		}*/

		

		$(document).ready(function() {

		

		

		$('.fancybox').fancybox();

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

		<?php if($user_id > 0){?>

		.fancybox-image, .fancybox-iframe{

		overflow: auto !important;

		

		}

		.fancybox-inner .fancybox-iframe body{

		background: url(<?php echo base_url(); ?>public/default/images/lmsbg.jpg) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;

		}

		.fancybox-overlay{

		background: none repeat scroll 0 0 rgba(0, 0, 0, 0) !important;

		}

		<?php }else{?>

		/*.fancybox-image, .fancybox-iframe{

		overflow: auto !important;*/

		}

		<?php }?>

	</style>

<!--/lightbox scripts and style-->

<script type="text/javascript">

$(function(){

	$(".show_sub").click(function () {

	$('.subcat').slideDown();

	});



	$(".close_sub").click(function () {

	$('.subcat').slideUp();

	});

});

	$(function(){

		$('dl.tabs dt').click(function(){

			$(this)

				.siblings().removeClass('selected').end()

				.next('dd').andSelf().addClass('selected');

		});

	});



function show_hidde(id, patth){

  //alert(id);

  //alert(patth);

  	var div = document.getElementById("table_"+id);

   //	var div = document.getElementById("table");

     //alert(div);

	var td = document.getElementById("td_"+id);

   // alert(td);

	var img= document.getElementById("img_"+id);

    //alert(td);

   //	if(div != null){

		if(div.style.display == "block"){

            //alert("test1");

			img.src=patth+"arrow-down.gif";

			div.style.display = "none";

			td.style.borderBottom="none";

		}

		else{

		  //alert("test2");

			img.src=patth+"arrow-right.gif";

			div.style.display = "block";

			td.style.borderBottom="2px solid rgb(247, 247, 247)";

		}



  //	}

}



</script>



        <div id="system-message-container"></div>

        <?php

        if(isset($programs) && !empty($programs)){ ?>

          <?php $this->load->helper('access');

              if(isset($programs->level) && $programs->level == 0){

                 $level = 'Beginner';

               }

                if(isset($programs->level) && $programs->level == 1){

                 $level = 'Intermediate';

               }

                if(isset($programs->level) && $programs->level == 2){

                 $level = 'Advanced';

               }

           ?>

<div class="coursedetailpage">

<div class="span8">

    <div class="coursebannerinner">

        <!--<img src="<?php echo base_url(); ?>public/default/images/big_courseimg.jpg" alt="" /> -->

        <div class="coursecontentholder">

            <h1><?php echo $programs->name;?></h1>

            <h3>

            <?php echo character_limiter(strip_tags($programs->description),120); ?>

           </h3>
        <?php if($programs->image){ ?>

        <img src="<?php echo base_url(); ?>public/uploads/programs/img/<?php echo $programs->image;?>">

        <?php  ?>

        <?php } ?>

		   <?php if($not_show==false){ 

		   if($user_id >0){

		   $linkfreeandbuy = ($programs->chb_free_courses)?base_url().'programs/enroll/'.$programs->id:base_url().'buyitems/buynow/'.$programs->id;

		   }else{

		    $linkfreeandbuy = base_url().'users/login';

		   }

		   ?>

            <p><a href="<?php echo $linkfreeandbuy; ?>" class="buy-button-link ud-popup"><?php echo (($programs->chb_free_courses) ? "Start Learning Now":"Take This Course");?>

            <span>

            <?php if($programs->chb_free_courses)

            {

                echo "Free";

            }else

            {

              $courseprice=$this->Program_model->getCoursePrice($programs->id);

              echo "$".$courseprice;

            } ?></span></a></p><?php }?>

            <?php if(isset($teacher_info->first_name)) { ?>

            <ul>

            <li><b>Released:</b> <?php echo date('d-m-Y',strtotime($programs->startpublish)); ?><?php } ?></li>

            <li><b>Trainer:</b> <?php echo $teacher_info->first_name." ".$teacher_info->last_name; ?></li>

            <li><b>Level:</b> <?php echo $level; ?></li>

            </ul>

        </div>

<div>

    <h1><?php //echo "About ".$programs->name;?></h1>

    <h4><i>by</i> <?php echo $teacher_info->first_name." ".$teacher_info->last_name; ?></h4>

    <?php echo $programs->description;?>

    <p><b>Category:</b> <a href="<?php echo base_url()."category/view/".$programs->catid;?>"><?php echo $this->Program_model->getCategoryName($programs->catid); ?></a></p>

</div>

<?php if ($days){ ?>

<div class="leftcontent">

 <?php if ($days){ ?>

    <div class="buy_background">

                              <?php if(is_array($buybutton)){

                              echo $buybutton["0"];

                              }

                              else{

                                    echo $buybutton;

                              } ?>

    </div>

   <?php } ?>

</div>

   <!-- course section start -->



        <?php $allLessonIds = array();

        $i=0;

         ?>

        <?php foreach ($days as $day){ ?>

<div class="leftcontent">

        <div id="coursesection">

            <div class="title">

             <?php /* ?>   <div onclick="javascript:show_hidde('<?php echo $day->id;?>','<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/')" class="day">

                <img id='img_<?php echo $day->id; ?>' src='<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/arrow-right.gif'/>

                <?php echo $day->title;?>   <?php */ ?>

                <?php echo "Section ".++$i." : ".$day->title;



             ?>



             </div>

             <div id="coursesectionlecture">



             <?php



                $lessons = $this->Program_model->getLessons($day->id);

                $dayaccess = $day->access;

             ?>

             <ul class="course_cat1">

             <?php

                $j=0;

                //echo "<pre>";

                //print_r($lessons);

                //echo "</pre>";

                foreach ($lessons as $lesson)

                {

                    $allLessonIds[] = $lesson->id;

                    if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE)

                    {

                                      if($coursetype_details[0]["course_type"] == 1)

                                      {

                                          if($coursetype_details[0]["lesson_release"] == 1)

                                          {

                                          $date_to_display = strtotime ( '+'.$step_less++.' day' , $start_date) ;

                                          }

                                          elseif($coursetype_details[0]["lesson_release"] == 2)

                                          {

                                          $date_to_display = strtotime ( '+'.$step_less++.' week' , $start_date) ;

                                          }

                                          elseif($coursetype_details[0]["lesson_release"] == 3)

                                          {

                                          $date_to_display = strtotime ( '+'.$step_less++.' month' , $start_date) ;

                                          }

                                      }



                                  if($diff_start >0){

                                    ?>

                                   <?php /* ?>    <span  style="float:right; margin-right:10px; margin-left:30px; color:#66CC00;"><?php echo 'Available';?></span>    <?php */ ?>

                                    <?php

                                    }

                                    else{

                                    ?>

                                   <?php /* ?>       <span  style="float:right; margin-right:10px; margin-left:15px;"><?php echo date('m-d-Y', $date_to_display);?></span>  <?php */ ?>

                                    <?php

                                        }

                    }



                    $lessonAccess = $lesson->step_access;

                    $access = isAccess($programs->id,$day->id,$lesson->id);





                    if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)

                              {

                                    if($diff_start >0)

                                    { ?>

                                    <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='outeranchor <?php //echo "fancybox fancybox.iframe";?>' ><span class="s_underline"> <?php echo $lesson->name;?></span></a>

                                    <?php }

                                    else

                                    { ?>

                                    <a href="<?php echo 'javascript:void(0)';?>" class='outeranchor' ><span class="s_underline"> <?php echo $lesson->name;?></span></a>

                                    <?php }

                              }else

                              { ?>

                              <a href="<?php echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='outeranchor <?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><span class="s_underline"> <?php //echo $lesson->name;?></span></a>

                              <?php } ?>

                <li>

                    <div class="catimg"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>

                    <div class="cattext">

                  <?php  if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)

                  {

                        if($diff_start >0)

                        { ?>

                            <h4><a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' ><?php echo "Lecture ". ++$j ;?></a></h4>

							<div class="smltext">

                           <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' ><?php echo $lesson->name; ?></a>  <br>

                           <!--Available: --><?php //echo $level; ?>

                        </div>

                  <?php }

                        else

                        { ?>

                            <h4><a href="<?php echo 'javascript:void(0)';?>" class='' ><?php echo "Lecture ". ++$j ;?></a></h4>

							<div class="smltext">

                           <a href="javascript:void(0)"><!--Title : --><?php echo $lesson->name; ?></a>  <br>

                           <!--Available: --><?php //echo $level; ?>

                        </div>

                  <?php }

                  }

                  else

                  { ?>

                        <h4><?php echo "Lecture ". ++$j ;?><!--<a href="<?php //echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='<?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><?php //echo "Lecture ". ++$j ;?></a>--></h4>

						<div class="smltext">

                           <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' ><?php echo $lesson->name; ?></a>  <br>

                           <!--Available: --><?php //echo $level; ?>

                        </div>

             <?php } ?>

                        

					<?php

                    $lesson_viewed = $this->Program_model->getViewLesson($lesson->id,$user_id);

                    if(!$lesson_viewed){

                              $display = "none";

                    }

                    else{

                        $display = "inherit";

                    }

                    ?>

					<?php

                          if($lesson->difficultylevel == 'easy'){

                          $image_name = 'level_icon.png';

                          }

                          if($lesson->difficultylevel == 'medium'){

                          $image_name = 'level_intmed_icon.png';

                          }

                          if($lesson->difficultylevel == 'hard'){

                          $image_name = 'level_advance_icon.png';

                          }

                          @$diff_start--;

                          ?>

                        <p><span style="display:<?php echo $display;?>">Viewed <img src="<?php echo base_url(); ?>public/default/images/view_icon.png" alt="" /></span><span> Level <img src="<?php echo base_url(); ?>public/default/images/<?php echo $image_name;?>" alt="" /></span></p>

                    </div>



                    



                  <?php /* ?>  <div class="view" style="display:<?php echo $display; ?>;" id="viewed-2">

                          <img align="viewed" src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/view_icon.png">

                    </div>

                   <?php */ ?>





                   

                 <?php /* ?>         <div class="level">

                          <img src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/<?php echo $image_name; ?>">

                          </div>

                 <?php */ ?>



                </li>

             <?php

                } // end of foreach lessions

             ?>

             </ul>

             </div>

        </div>    <!-- course section End -->

</div>

 <?php } // end of foreach section(day)

?>





<?php

 if(isset($programs->id_final_exam) && ($programs->id_final_exam > 0))

 {

    //print_r($finalexaminfo->name);?>

<div class="leftcontent">

<!-- final exam view --->





<div class="title"><?php echo "Final Exam"; ?></div>

                          <div class="submtwo">

                          <?php



                          $finalexaminfo = $this->Program_model->getQuiz($programs->id_final_exam);



                          $takenwhere = array(

                          'user_id'      => $user_id,

                          'quiz_id'      => $programs->id_final_exam

                          );



                          $quiztakeninfo = $this->Program_model->getQuizTaken($takenwhere);



                          if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE){



                          if($coursetype_details[0]["course_type"] == 1){



                            if($coursetype_details[0]["lesson_release"] == 1){



                            $date_to_display = strtotime ( '+'.$step_less++.' day' , $start_date) ;



                            }

                            elseif($coursetype_details[0]["lesson_release"] == 2){



                            $date_to_display = strtotime ( '+'.$step_less++.' week' , $start_date) ;



                            }

                            elseif($coursetype_details[0]["lesson_release"] == 3){



                            $date_to_display = strtotime ( '+'.$step_less++.' month' , $start_date) ;



                            }

                          }





                          if(isset($diff_start)){



                          if($diff_start >=0){

                          ?>

                          <span  style="float:right; margin-right:10px; margin-left:30px; color:#66CC00;"><?php echo 'Available';?></span>

                          <?php

                          }

                          else{

                          ?>

                          <span  style="float:right; margin-right:10px; margin-left:15px;"><?php echo date('m-d-Y', $date_to_display);?></span>

                          <?php

                          }

                          }

                          ?>

                          <?php

                          }

                          ?>





                          <div id="table_28" class="subcat">

                  		<?php $finalexamactiveflag = false;



                  		if($programs->course_type == 0){



                  			$finalexamactiveflag = true;

                  		}else{

                  		$viewedLessonIds = explode('||',trim($ViewedLessons[0]['lesson_id'],'|'));

                  		$commonLessonIds = array_intersect($allLessonIds,$viewedLessonIds);

                  		if( ($programs->lesson_release == 0) && (count($allLessonIds) == count($commonLessonIds)) ){

                  			$finalexamactiveflag = true;

                  			}

                  			elseif((isset($diff_start))&&($diff_start >=0)){

                  			$finalexamactiveflag = true;

                  			}



                  		}



                  		?>





                         <?php

                         //print_r($finalexamactiveflag);

                        if(($user_id >0) && $not_show === TRUE){

                        ?>

                           <a class="<?php //echo ($finalexamactiveflag) ? 'fancybox fancybox.iframe' : ''?>" href="<?php echo ($finalexamactiveflag) ? base_url().'lessons/finalexam/'.$programs->id.'/'.$programs->id_final_exam : 'javascript:void(0);'?>"><span class="s_underline"> Final Exam:<?php echo $finalexaminfo->name;?></span></a>

                          <?php }else{ ?>

                           <a href="<?php echo 'javascript:void(0)';?>" class='' ><span class="s_underline"> Final Exam:<?php echo $finalexaminfo->name;?></span></a>



                          <?php } ?>

                          <div class="view" id="viewed-2">

                          <img style="display:<?php echo (count($quiztakeninfo) > 0) ? '':'none';?>" align="viewed" src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/view_icon.png">

                          </div>



                          <div class="level">

                          <img src="<?php echo base_url(); ?>public/<?php echo $tmpl;?>/images/level_advance_icon.png">

                          </div>



                          <hr />

                          </div>

                          </div>

                          </div>

                          <?php }?>



<!-- final exam view End -->







</div>



</div>

<div class="span4">

<div class="rightsidebar">
    <h3>Subscribed Users</h3>
    <p><font color="#000"><b><?php echo $this->Program_model->getEnrolledUserCount($programs->id);?></b></font> users are already taking this course</p>
</div>

<?php if(isset($programs->pre_req) && ($programs->pre_req_books) && ($programs->reqmts))

{ ?>

<div class="rightsidebar">

       <div class="title"><?php echo "Requirement ";?></div>

        <div >  <!--id="content"-->

                <?php



                if($programs->pre_req!="" || $programs->pre_req_books!="" || $programs->reqmts!=""){

                if(trim($programs->pre_req) != ""){

                ?>

                <p><strong>Others:</strong></p>

                <?php

                echo $programs->pre_req;

                }

                if(trim($programs->pre_req_books) != ""){

                ?>

                <p><strong>Books :</strong></p>

                <?php

                echo $programs->pre_req_books;

                }

                if(trim($programs->reqmts) != ""){

                ?>

                <p><strong>Misc:</strong></p>

                <?php

                echo $programs->reqmts;

                }  }?>

</div>

</div>

<?php }

else

?>

    <!--Webinar Start--->

	<?php if(($this->Program_model->checkEnrolled($user_id,$pro_id)) && !empty($exercise)){?>

	<div class="rightsidebar">

                <div class="title">Exercise Files</div><?php //print_r($exercise);

	foreach($exercise as $exfileinfo){

	if($exfileinfo->type=='file'){

	echo '<a target="_blank" href="'.base_url().'public/uploads/files/'.$exfileinfo->local.'">'.$exfileinfo->name.'</a><br />';

	}

	

	}

	?>

	</div>

	<?php }?>

                <?php

                if(($programs->webstatus=="active") && !empty($webinars))

                {

                  

                  if($this->Program_model->checkEnrolled($user_id,$pro_id))

                  {

                ?>

<div class="rightsidebar">

                <div class="title">Webinar</div>

                <?php

                //$this->load->view('webresponse',$addstudresponse);

                 //echo $programs->roomid;

                 //echo $addstudresponse;

                 ?>

                <?php //echo base_url();?> <!-- programs/addStudent/ --><?php //echo $usermail.'/'.$userfname.'/'.$roomid;?>

				 

				

				<?php foreach($webinars as $webinar){ ?>

					

				<?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);

                        echo form_open_multipart('conwebinar', $attributes); ?>

				    <input type="hidden" value="<?php echo $userfname; ?>" name="ufname">

				    <input type="hidden" value="<?php echo $usermail; ?>" name="uemail">

				    <input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">

				    <input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">

                 <p>

				<strong><?php echo $webinar->title;?></strong>  <input type="submit" class="beditform" value="Go" name="submit">

				<?php echo form_close();?>

				</p>

				<?php }?>

				

			   



					





              <?php

                //echo $addstudresponse;



               // echo '<div id="smallDiv">'.

	           //echo $addstudresponse  ;

	           //.'</div>';



                //$student=$programs->addStudent($programs->roomid,$userfname,$usermail);

               // print_r($stud);

                //$student = $this->Program_model->addStudent($programs->roomid,$userfname,$usermail);

                //echo $student;



                ?>

</div>

                <?php

                    }

                }

                ?>

                <!--Webinar End----->



<div class="rightsidebar">

        <!-- Teacher Info -->

        <div>



                <?php

                if($programs->author != '0'){

                $this->load->view('programs/teacher_info');?>

                <?php } ?>



        </div>

       <!-- End Teacher Info -->

</div>

</div>

</div>



<div id="main" role="main">

<div class="holder" id="mrp-container2">











<?php

} // end of if days

else

{

   echo "there is no record in the database";

}

}

 ?>



</div>

</div>