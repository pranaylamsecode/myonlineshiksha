<?php
function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
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
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}	
  
?>
<style >
#review,#discussion {
	width: 404px;
	padding-bottom: 2px;
	display: none;
	background: #FFF;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
	-webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
	-moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
}
#review,#discussion {
	display: none;
	position: fixed;
	opacity: 1;
	z-index: 11000;
	left: 50%;
	margin-left: -202px;
	top: 200px;
}
.general-heading {
	/*background-color: #C42140;*/
	color: #fff;
	font-size: 18px;
	font-weight: 600;
	padding: 10px 40px 10px 40px;
	margin: 0;
	border-radius: 3px 3px 0 0;
}
.pay_main_cont {
	padding: 5px 20px 20px 20px;
}
#review_lean_overlay{
position: fixed;
z-index: 10000;
top: 0px;
left: 0px;
height: 100%;
width: 100%;
background: #000;
display: none;
}
.review_modal_close,.discuss_modal_close{
position: absolute;
top: 12px;
right: 12px;
display: block;
width: 18px;
height: 18px;
background-color: transparent;
z-index: 2;
}

.entypo-cancel-squared
{
	color:#CCC;
}

.entypo-cancel-squared:hover
{
	color:#fff;
}
</style>
<style>

.rate-ex1-cnt{
	width:230px; 
	height: 24px;
	
}
.rate-ex1-cnt .rate-btn{
	width: 24px; height:24px;
	float: left;
	background: url(<?php echo base_url();  ?>public/images/rating_img/rate-btn.png) no-repeat;
	cursor: pointer;
}
.rate-ex1-cnt .rate-btn:hover, .rate-ex1-cnt  .rate-btn-hover, .rate-ex1-cnt  .rate-btn-active{
	background: url(<?php echo base_url(); ?>public/images/rating_img/rate-btn-hover.png) no-repeat;
}

/* rate result */
.rate-result-cnt{
	width: 82px; height: 18px;
	position: relative;
	background-color: #ccc;
	border: #ccc 1px solid;
}
.rate-stars{
	width: 82px; height: 18px;
	background: url(<?php echo base_url(); ?>public/images/rating_img/rate-stars.png) no-repeat;
	position: absolute;
}
.rate-bg{
	height: 18px;
	background-color: #ffbe10;
	position: absolute;
}

.clear{clear: both;}
.tuto-cnt{width: 480px; background-color: #fff; border:#ccc 1px solid; height:auto; min-height: 400px; margin: 40px auto; padding: 40px; overflow: auto; }


</style>
<?php
$hover_id = 1;
$coursetype_details = $this->program_model->getCourseTypeDetails ($programs->id);

if($user_id > 0)
{
	$date_enrolled = $this->program_model->datebuynow($programs->id, $user_id);
	
	if(count($date_enrolled) > 0)
	{
		$not_show = true;
	}
	else
	{
		$not_show = false;
	}
	/*if(!$hasaccess)
	{
		$not_show = FALSE;
	}*/
	$date_enrolled = (count($date_enrolled) > 0) ? $date_enrolled->buydate : '';
	$date_enrolled = strtotime($date_enrolled);
}

if(isset($date_enrolled))
{
	$start_relaese_date1 = (isset($coursetype_details[0]["start_release"])) ? $coursetype_details[0]["start_release"] : '';
	$start_relaese_date = strtotime($start_relaese_date1);
	$start_date =  $date_enrolled;
}
?>

<section class="container courses">
  <div class="row-fluid ">
    <div id="system-message-container"></div>
    <div class="coursedetailpage"> 
      <!-------------Left-Section-Start---------------------- -->
      <div class="span6">
        <div class="cont_mid">
          <div class="coursebannerinner">
            <div class="leftcontent">
				<div class="breadcrumb">
                <div>
                  <div>
                    <div>
                      <h3><?php echo $programs->name;?></h3>
                    </div>
                  </div>
                </div>
				</div>
				<?php
					$my_lesson_total = 0;
					$my_viewed_lesson_total = 0;
					$bar_percentage = 0;
					if($days)
					{
					foreach ($days as $day)
					{
						//for total lesson
						$lessons = $this->program_model->getLessons($day->id);
						$my_lesson_total += count($lessons);
						
						//for viewed lesson
						foreach ($lessons as $lesson)
						{
							$lesson_viewed = $this->program_model->getViewLesson($lesson->id,$user_id);
							if($lesson_viewed)
							{
								$my_viewed_lesson_total++;
							}
						}
					}
					}
					$bar_percentage = $my_viewed_lesson_total * 100/ $my_lesson_total;
					$bar_percentage = number_format($bar_percentage,2,".","");				
				?>
            <p>You completed <?php echo $my_viewed_lesson_total;?> out of <?php echo $my_lesson_total;?> published items</p>
            <div class="col-md-12">
                <div class="progress">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $bar_percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bar_percentage;?>%"> <span class="sr-only"><?php echo $bar_percentage;?>% Complete (success)</span> </div>
                </div>
            </div>
              <?php
$allLessonIds = array();
$i=0;
$total_lesson = 0;
foreach ($days as $day)
{ 
?>
    <div id="coursesection">
    <div class="title"> <?php echo "Section ".++$i." : ".$day->title; ?> </div>
    <div id="coursesectionlecture">
    <?php
	$lessons = $this->program_model->getLessons($day->id);
	$total_lesson += count($lessons);
	$dayaccess = $day->access;
    ?>
    <ul class="course_cat1">
    <?php
	$j=0;
			
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
                }
			
			$lessonAccess = $lesson->step_access;
			//$access = isAccess($programs->id,$day->id,$lesson->id);

//commmented by yogesh on dated 06-12-2014
//if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0))
{
//exit('ram');
$diff_start = 1;	//hardcoded by yogesh , remove this and solve above issue for $diffstart variable
	if($diff_start >0)
	{ 
		?>
                    <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='outeranchor <?php //echo "fancybox fancybox.iframe";?>' ><span class="s_underline"> <?php echo $lesson->name;?></span></a>
                    <?php 
	}
	else
	{
		?>
                    <a href="<?php echo 'javascript:void(0)';?>" class='outeranchor' ><span class="s_underline"> <?php echo $lesson->name;?></span></a>
                    <?php 
	}
}
else
{ 
//exit('sita');
?>
    <a href="<?php echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='outeranchor <?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><span class="s_underline">
    <?php //echo $lesson->name;?>
    </span></a>
    <?php 
} 
?>
    <li id='<?php echo $hover_id;?>' onmouseover="show_sidebar(this.id)" onmouseout="hide_sidebar(this.id)">
    <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>
    <div class="cattext1" style="display: inline-block; width: 100%;">
    <?php  
	$lesson_viewed = $this->program_model->getViewLesson($lesson->id,$user_id);
	if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
	{
        if($diff_start >0)
        { 						
			?>
			<h4 style="float: left; margin-right: 20px;"><a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' ><?php echo "Lecture ". ++$j ;?></a></h4>
			<div class="smltext" style="margin-top:12px;" onmouseover="show_sidebar()" onmouseout="hide_sidebar()"> <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' > <i class="entypo-book" style=" margin-right: 10px;"></i><?php echo $lesson->name; ?></a> <br>
			  <!--Available: -->
			  <?php //echo $level; ?>
			  <div id="sidebar" style="float:right;"> <a href="#" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start lecture</a> </div>
			</div>
			<?php 
		}
        else
        { 						
			?>
			<h4 style="float: left; margin-right: 20px;"><a href="<?php echo 'javascript:void(0)';?>" class='' ><?php echo "Lecture ". ++$j ;?></a></h4>
			<div class="smltext" style="margin-top:12px;" > 
			<a href="javascript:void(0)"><!--Title : --><i class="entypo-book" style=" margin-right: 10px;"></i><?php echo $lesson->name; ?></a> <br>
				<!--Available: -->
				<?php //echo $level; ?>
				<div id="sidebar" style="float:right;"> <a href="#" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start lecture</a> </div>
			</div>
			<?php 
		}
    }
    else
    {			
	//echo '111';		
	
		?>
        <h4 style="float: left; margin-right: 20px;">
            <div class="ci-progress-container">
			<?php
				if($lesson_viewed)
				{ ?>
 				<span class="ci-progress-mask"></span> 
				<?php
				}
				?>
			</div>
            <?php echo "Lecture ". ++$j ;?><!--<a href="<?php //echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='<?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><?php //echo "Lecture ". ++$j ;?></a>--></h4>
			<div class="smltext1"> 
				<a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" >
				<i class="entypo-book" style="margin-right:10px"></i><?php echo $lesson->name; ?></a> 
				<!--Available: -->	
				<?php
				if($lesson_viewed)
				{ ?>
 				<div id="sidebar<?php echo $hover_id;?>" style="float:right;display:none; margin:10px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Revisit Lecture</a> </div>
				<?php
				}
				else
				{
				?>
				<div id="sidebar<?php echo $hover_id;?>" style="float:right; display:none; margin:10px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start Lecture</a> </div>
				<?php
				}
				?>
				
				<!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
			</div>
        <?php 
		$hover_id++;
	}
	?>
        <?php

    

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
      </div>
      <hr style="margin:0;" />
    </li>
    <?php
    } // end of foreach lessions

	
	
	
	?>
    </ul>
    </div>
    </div>
    <?php
}
?>
    </div>
    </div>
    </div>
    </div>
    <!-------------Left-Section-Ends---------------------- --> 
      
      <!-------------Right-Section-Start---------------------- -->
      
      <div class="span6" style="padding-left: 0; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.15);">
        <div class="tabs-vertical-env">
          <ul class="nav nav-tabs bordered">
            <li class="active"> <a href="#v-diss" data-toggle="tab"> <span class="visible-xs"><i class="entypo-infinity"></i></span> <span class="hidden-xs"><i class="entypo-infinity"></i>Discussions</span> </a> </li>
            <li> <a href="#v-anno" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs"><i class="entypo-megaphone"></i>Announcements</span> </a> </li>
            <li> <a href="#v-user" data-toggle="tab"> <span class="visible-xs"><i class="entypo-mail"></i></span> <span class="hidden-xs"><i class="entypo-users"></i><b><?php echo ' '.$this->program_model->getEnrolledUserCount($programs->id);?></b> Students</span> </a> </li>  <!--href="<?php echo base_url();?>programs/students/<?php echo $programs->id?>"-->
			<li><a id="go" rel="leanModal" name="signup" onclick="showReviewdiv()" href="#signup"><i class="entypo-pencil"></i><?php if(count($reviews) > 0) echo 'Edit Reviews'; else echo 'Write Review'; ?></a> </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="v-diss">
				<div class="commentblock"> <br />
                <div class="diss_search_box">
                  <input type="text" id="searchtext" class="search_box" name="searchtext" value="" placeholder="Search For Discussions" style="margin:0;">
                  or <a rel="leanModal" onclick="showDiscussdiv()" name="signup" href="#signup" class="btn btn-success">Add Discussion</a> </div>
                <hr />				
                <ul class="comments-list1">
					<?php
					$CI = & get_instance();
					$CI->load->model('program_model');
					
					foreach ($quizcomment as $quizComment)
					{
					   
						$userData = $this->program_model->getStudentsInfo($quizComment['user_id']);
						if(!empty($userData))
						{
						     $lessonName = NULL;
							if($quizComment['lesson_id'])
							{
								$lessonName = $this->program_model->getLessonName($quizComment['lesson_id']);
							}
						?>
						<li>
							<div class="comment">
								<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>
								<div class="comment-content">
								<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> posted a discussion <b><?php echo $lessonName;?></b>  
								  <div class="comment-info">- Commented On <?php  $timeago=get_timeago(strtotime($quizComment['dateandtime']));echo $timeago;?></div>
								</div>
								<div class="comment-head"><?php echo $quizComment['query_title']?></div>
								<div class="comment-text"><?php echo $quizComment['query_text']?></div>
								<a href="javascript:void(0);" class="liked" id="like<?php echo $quizComment['query_id']; ?>"  style="margin: 0 45px;"> <i class="entypo-heart"></i>
								      <?php
												
										  $total_likes = $this->Category_model->getAllLike($quizComment['query_id']);
										  $likes = $this->Category_model->getLikes($quizComment['query_id'],$user_id);
										   $liked = NULL;
                                           foreach($likes as $like)
										   {
												if($user_id == $like->user_id && $quizComment['query_id'] == $like->query_id)
												{
													 $liked = 'yes';
													 $like_id = $like->like_id;
												}
										   }
										 if($liked)
										 {
									  ?>
									<span onclick="unlike(<?php echo $like_id; ?>,<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['user_id']; ?>,<?php echo $quizComment['pro_id']; ?>)">Liked(<?php echo $total_likes; ?>) </span> 
									<?php
										}
										else
										{
									?>
									<span onclick="like(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['user_id']; ?>,<?php echo $quizComment['pro_id']; ?>)">Like(<?php echo $total_likes; ?>) </span> 
									<?php
										}
									?>
									
								</a> 
									<?php 
									$countcomment = $this->program_model->getLessonAnswer2($quizComment['query_id']); 
									//if($countcomment)
									//{
									//$countcom = $countcomment;
									//}
									//else
									//{
									//$countcom = 0; 
									//}
									foreach($countcomment as $countcom )
									{
									$ii = $countcom;  
									?>
									<a href="javascript:void(0);" id="comment<?php echo $quizComment['query_id']; ?>" onclick="show_div(<?php echo $quizComment['query_id']; ?>)" > <i class="entypo-comment"></i>Comment <span id="comment_count<?php echo $quizComment['query_id']; ?>">(<?php echo $ii; ?>)</span> </a> 
									<?php
									}
									?>
									<div id="comment_div<?php echo $quizComment['query_id']; ?>" style="display:none">
									    
										<ul id="question_list<?php echo $quizComment['query_id']; ?>">
											<?php
											$lessonAns = $this->program_model->getLessonAnswer($quizComment['query_id']);						
											
											foreach($lessonAns as $answer)
											{
												$userData = $this->program_model->getStudentsInfo($answer['user_id']);
											?>
											<li id="li<?php echo $answer['ans_id'];?>">
													<div class="comment">
														<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>
														<div class="comment-content">
															<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> - Commented On <?php  $timeago=get_timeago(strtotime($answer['dateandtime']));echo $timeago;?></div>
															<!--<div class="comment-head"><?php echo $quizComment['query_title']?></div>-->
															<div class="comment-text"><?php echo $answer['answer']?></div>
															
														</div>
													</div>
											</li>
											<?php
											}
											
																				 
											 
											?>
											
										</ul>
										<ul>
											<li>
												<div>
													<textarea name="comment_box<?php echo $quizComment['query_id']; ?>" placeholder="Write Reply" id="comment_box<?php echo $quizComment['query_id']; ?>"></textarea>
													<input class="btn btn-success" type="button" onclick="add_comment(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['pro_id']; ?>);" name="replyBtn<?php echo $quizComment['query_id']; ?>" id="replyBtn<?php echo $quizComment['query_id']; ?>" value="Reply"  />
												</div>
											</li>
										
										</ul>
							       
								</div>
								
							</div>
							
						</li>                       
						<?php
						 unset($liked);
						}
					}
					?>
                </ul>				
				</div>
            </div>
            <div class="tab-pane" id="v-anno"> . <br />
              <br />
              <ul class="comments-list1">
                <li>
                  <div class="comment">               
                    <div class="comment-content">
						There are no more announcements to show at this time.
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            
            <div class="tab-pane" id="v-user"> 
				<div class="cont_mid">
        <div class="coursebannerinner">
        <div class="stu-tak">
        <div class="sect_head">
            <h4 style="float:left;"> STUDENTS TAKING THIS COURSE </h4>
            <input type='search_student' name='search_student' id='search_student' placeholder='Search By Name' class="search_box_stud">
        </div>
        <?php
$CI = & get_instance();
$CI->load->model('program_model');
?>
        <div class="clr"></div>
        <hr style="margin: 10px 0;"/>
        <ul class="users-container">
        <?php
		if($students)
		{
			foreach($students as $stud)
			{			
				$user = $this->program_model->getStudentsInfo($stud['userid']);
			    if(@$user->id != @$user_id)
				{
					if (!empty($user)) 
					{
						$user_image = $user->images ? $user->images : 'temp.jpg';
						?>
						<li class="student-list" > <a href=""> <span class="bordered-thumb"><img border="0" alt="" src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $user_image;?>"></span> </a>
							<h4 style="float:left;"><?php echo ucfirst($user->first_name).' '.$user->last_name; ?></h4>
							<span id="span<?php  echo $user->id; ?>" class="btn-wrapper" style="float:right;">
							<?php
								$followed = NULL;
							   foreach ($followers as $follows) 
									  {
										if($follows->followee_id == $user->id)
										{
											  $followed = 'yes';
											  $follow_id = $follows->follow_id;
										}
									  }
							?>
							<?php
								if($followed)
								{
						   ?>
							<a href="javascript:void(0)" onclick="ajax_following(<?php echo $user->id;?>,<?php echo $follow_id;  ?>)" class="btn btn-success">Following</a> 
							<?php
								}
								else
								{
							?>
							<a href="javascript:void(0)" onclick="ajax_follow(<?php echo $user->id;?>)" class="btn btn-info">Follow</a> 
							<?php
								}
							?>
							<a href="#" class="btn">Message</a> </span> 
						</li>
						<?php
					}
				}
			}
		}
		?>
              </ul>
              <div class="more"> <a class="btn" href="javascript:void(0)">Load More</a> <span class="ajax-loader-tiny" style="display: none;"></span> </div>
            </div>
          </div>
        </div>
		</div> 
            
          </div>
        </div>
      </div>
      <!-------------Right-Section-Endss---------------------- --> 
      
    </div>
  </div>
  </div>
</section>

<!--<script type="text/javascript">
function show_sidebar(id)
{
	document.getElementById('sidebar').style.visibility="visible";
}

function hide_sidebar(id)
{
document.getElementById('sidebar').style.visibility="hidden";
}
</script>--> 
<script type="text/javascript">
function show_sidebar(idd)
{
	if(document.getElementById(idd).id  == idd)
	{
		document.getElementById('sidebar'+idd).style.display = "block";
		//document.getElementById('sidebar').style.visibility = 'visible';
	}
}

function hide_sidebar(idd)
{
	if(document.getElementById(idd).id  == idd)
	{
		document.getElementById('sidebar'+idd).style.display = "none";
	}
}
</script>


<script type="text/javascript">
	$(document).ready(function () {
    $('.review_modal_close').click(function() {
        $("#review").hide();			
        $("#review_lean_overlay").hide();			
    });
});
</script>

<?php if(@$reviews[0]['review_rate'] == 0) { ?>
<script>
        // rating script
        $(function(){ 
            $('.rate-btn').hover(function(){
                $('.rate-btn').removeClass('rate-btn-hover');
                var therate = $(this).attr('id');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-hover');
                };
            });
                            
           $('.rate-btn').click(function(){    
		        var therate = $(this).attr('id');
				$('.rate-btn').removeClass('rate-btn-active');
				for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };	
				$('#rate').val(therate);
				 }); 
			
			$("#btnReview").click(function(){
				var rate = $('#rate').val();
				var title = $('#review_title').val();
				var desc = $('#review_desc').val();
				var pro_id = <?php echo $programs->id;  ?>;
				var dataRate = rate; //
				
                		
			
			     $("#review").hide();			
                 $("#review_lean_overlay").hide(); 
                $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>index.php/programs/add_reviews",
                    data    : {'review_point':dataRate,'pro_id':pro_id,'title':title,'desc':desc},
                    success:function(data){ 
						$("#go").html(data); 
					}
                });
                
            }); 
			
			
        });
    </script>
<?php }
	elseif(@$reviews[0]['review_rate'] > 0)
	{
 ?>
 <script>
        // rating script
        $(function(){ 
            $('.rate-btn').hover(function(){
                $('.rate-btn').removeClass('rate-btn-hover');
                var therate = $(this).attr('id');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-hover');
                };
            });
                            
           $('.rate-btn').click(function(){    
		        var therate = $(this).attr('id');
				$('.rate-btn').removeClass('rate-btn-active');
				for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };	
				$('#rate').val(therate);
				 }); 
			
			$("#btnReview").click(function(){
				var rate = $('#rate').val();
				
				var title = $('#review_title').val();
				var desc = $('#review_desc').val();
				var pro_id = <?php echo $programs->id;  ?>;
				var review_id = <?php echo $reviews[0]['review_id']; ?>;
				var dataRate = rate; //
				
                		
			
			     $("#review").hide();			
                 $("#review_lean_overlay").hide(); 
                $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>index.php/programs/update_reviews",
                    data    : {'review_point':dataRate,'pro_id':pro_id,'title':title,'desc':desc,'review_id':review_id},
                    success:function(){  }
                });
                
            }); 
			
			
        });
    </script>
 <?php } ?>
	
	<?php if(@$reviews[0]['review_rate']) 
		   {	
	?>
	<script>
		$('document').ready(function() {
		
			 $('.rate-btn').removeClass('rate-btn-active');
				for (var i = <?php echo $reviews[0]['review_rate']; ?>; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };	
		});
	</script>
	<?php
		}
	?>
	
<!--Review Pop-up-->
<div id="review"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct">
    
      <h3 class="general-heading"><?php if(count($reviews) > 0) echo 'Edit Reviews'; else echo 'Rate this Course'; ?></h3>
      <a class="review_modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
      
      
      <div class="pay_main_cont">        
        
        <div class="tab-content" style="padding:10px 0;">
        
			 <div class="rate-ex1-cnt">
				<div id="1" class="rate-btn-1 rate-btn"></div>
				<div id="2" class="rate-btn-2 rate-btn"></div>
				<div id="3" class="rate-btn-3 rate-btn"></div>
				<div id="4" class="rate-btn-4 rate-btn"></div>
				<div id="5" class="rate-btn-5 rate-btn"></div>
			</div>
        </div>
		
		<div>
			<div>
            <input type="text" name="review_title" id="review_title"  placeholder="Enter Review Title here" value="<?php echo (@$reviews[0]['title']) ? @$reviews[0]['title'] : ''  ?>" required style="width:100%" /> </div>
		</div>
		<div style="padding:10px 0;">
			<div><textarea id="review_desc" style="width:100%; height: 100px; padding-bottom:0;" required placeholder="Enter Review here"><?php echo (@$reviews[0]['description']) ? $reviews[0]['description'] : ''  ?></textarea>
			</div>
		</div>
		<div>
		   
			<input type="hidden" name="rate" id="rate" value="" />
			<input type="button" name="btnReview" id="btnReview" value="Add Review" class="btn-primary_red" style="margin:0"/>
		</div>        
      </div>	
  </div>

</div>  
<div id="review_lean_overlay" style="display: none; opacity: 0.5;"> </div> 

<!--Discussion Pop-up-->
<div id="discussion"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: 172px; top: 340px;">
  <div id="payment-ct">
    
      <h3 class="general-heading">Add Discussion</h3>
      <a class="discuss_modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
      
      
      <div class="pay_main_cont">        
        
        <div class="tab-content">
          <div><textarea name="query_title" id="query_title" placeholder="Type your discussion title here and any details below" style="width:360px;height:40px"></textarea> </div>
		   <input type="hidden" name="lqprogid" id="lqprogid" value="<?php echo $course_id; ?>" />
		  <div><textarea name="query_text" id="query_text" placeholder="Discuss the course and topics related it its fields. No promotions please."></textarea></div>
  		      
	       <div><input class="btn btn-success" type="button" onclick="postDisscussion()" name="querysubmit" id="querysubmit" value="POST" /> </div>		  
        </div>        
      </div>

  </div>
</div> 


<script>
	function showReviewdiv()
	{
		if (document.getElementById("review").style.display == 'block') {
               document.getElementById("review").style.display = 'none';
       }else{
               document.getElementById("review").style.display = 'block';
       }
	   
	   if (document.getElementById("review_lean_overlay").style.display == 'block') {
               document.getElementById("review_lean_overlay").style.display = 'none';
       }else{
               document.getElementById("review_lean_overlay").style.display = 'block';
       }
	
	}

</script>

<script>
  // $(function(){
    //   $("#search").click(function(){
	function ajax_follow(followee_id)
	{
	   
        var  dataString = followee_id;        
		
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/follow",
            data    : {'followee_id':dataString},
 
           success: function(data){
              
			  $("#span"+followee_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>	

<script>
  // $(function(){
    //   $("#search").click(function(){
	function ajax_following(followee_id,follow_id)
	{
	   
        var  dataString1 = followee_id;        
        var  dataString2 = follow_id;        
		
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/following",
            data    : {'followee_id':dataString1,'follow_id':dataString2},
 
           success: function(data){
              
			  $("#span"+followee_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>	

<script>
function show_div(id) {
   //alert(id);
    $('#comment_div'+id).toggle();
	$('#comment_box'+id).redactor();	
}
</script>


<script>
function add_comment(query_id,pid)
	{
	   
	   //alert("yes");
        var answer = $('#comment_box'+query_id).val();
		 
        var listresult = '';
		var querylist = '';
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/saveanswer",
            data    : {'query_id':query_id,'pid':pid,'answer':answer},
 
           success: function(data){
		       
			  if(data=='error'){
				alert("Teir was error while processing, try again!");
				}else{
				  
				//listresult = $.parseJSON(data);
				
			//$.each(listresult, function(queryk, querydata){
				  
				/*querylist += '<li'+querydata.ans_id+'>';
				querylist += '<div class="comment">';				
				querylist += '<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>';				
				querylist += '<div class="comment-content">';
				querylist += '<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> - Commented On '+querydata.dateandtime+' </div>';
				querylist += '<div class="comment-text">'+querydata.answer+'</div>';
				querylist += '</div>';
				querylist += '</div>';
				querylist += '</li>';*/
				
				
				//});
					
					if(querylist == ''){
					querylist = 'No questions have been asked so far';
					}
				//$('#question_list'+querydata.query_id).html(querylist);
				$('#question_list'+query_id).html(data);
				}
		    }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>

<script>
  // $(function(){
    //   $("#search").click(function(){
	function like(query_id,questioner_id,pro_id)
	{
	   
        var  query_id = query_id;
        var  questioner_id = questioner_id;
        var  pro_id = pro_id;
		
		
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/like",
            data    : {'query_id':query_id,'questioner_id':questioner_id,'pro_id':pro_id},
 
           success: function(data){
             
			 $("#like"+query_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#query_text').redactor();
	});
</script>

<script type="text/javascript">
function unlike(like_id,query_id,questioner_id,pro_id)
	{
	   
        var  like_id = like_id;
        var  query_id = query_id;
        var  questioner_id = questioner_id;
        var  pro_id = pro_id;
		
		
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/unlike",
            data    : {'like_id':like_id,'query_id':query_id,'questioner_id':questioner_id,'pro_id':pro_id},
 
           success: function(data){
             
			 $("#like"+query_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>

<script type="text/javascript">
	$(document).ready(function () {
    $('.discuss_modal_close').click(function() {
        $("#discussion").hide();			
           	
     });
});
</script>



<script type="text/javascript">
	function showDiscussdiv()
	{
		if (document.getElementById("discussion").style.display == 'block') {
               document.getElementById("discussion").style.display = 'none';
       }else{
               document.getElementById("discussion").style.display = 'block';
       }  
	   
	
	}

</script>

<script>
/************<start askquery code */
	function postDisscussion(){
	  
	    
		var querytitle_val = $('#query_title').val();
	   	var querycont_val = $('#query_text').val();
	  

		if( querytitle_val =='' || querycont_val =='' ){
		return false;
		}
		var qpid_val = $('#lqprogid').val();
		
		
		var listresult = '';
		var querylist = '';
		$.ajax({
		type: "POST",
		url: "<?php echo base_url()?>/programs/SaveAndGetQueryList/",
		data: { 'query_title': querytitle_val, 'query_text': querycont_val, 'qpid': qpid_val }
		}).success(function( data ) {
				if(data=='error'){
		alert('Teir was error while processing, try again!');
		}else{
		listresult = $.parseJSON(data);
		$.each(listresult, function(queryk, querydata){
		
		querylist += '<li>';
        querylist += '<div class="comment">';
        querylist += '<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>';
        querylist += '<div class="comment-content">';
        querylist += '<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> posted a discussion <b><?php echo $lessonName;?></b>  ';
        querylist += '<div class="comment-info">- Commented On '+querydata.dateandtime+'</div>';
        querylist += '</div>';
		querylist += '<div class="comment-head">'+querydata.query_title+'</div>';
        querylist += '<div class="comment-text">'+querydata.query_text+'</div>';
        querylist += '<a href="javascript:void(0);" class="liked" id="like'+querydata.query_id+'"  style="margin: 0 45px;"> <i class="entypo-heart"></i>';
        querylist += '</a>';
		querylist += '</li>';
			});
			
			if(querylist == ''){
			querylist = 'No questions have been asked so far';
			}
		 $("#discussion").hide();
		$("#comments-list1").html(querylist);
		}


		});
	}
</script>





 