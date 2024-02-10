<?php 
$this->load->view('new_template_design/header'); 
?> 
<?php
  $hover_id = 1;
  $CI =& get_instance();
  $CI->load->model('customs_model');
  $no_stud = $CI->customs_model->getEnrollstudents($teacher_info->id);
  $tot_courses = $CI->customs_model->getUserCoursecount($teacher_info->id);
  $rates1 = $CI->customs_model->getInstRating1($teacher_info->id);
  $courses = $CI->customs_model->getteachCourses($teacher_info->id);
  
  // updated calculation of ratings of all courses of teacher starts here
  // $avgrates = $CI->customs_model->getInstRating2($teacher_info->id);
  // $newrates = 

  // updated calculation of ratings of all courses of teacher ends here

  $filepath = "";
  if(!empty($teacher_info->images))
  {
    $files = $_SERVER['DOCUMENT_ROOT']."/public/uploads/users/img/".$teacher_info->images;
    if (file_exists($files)) {
      $filepath = "public/uploads/users/img/".$teacher_info->images;
    }
    else{
      $filepath = "public/uploads/users/img/thumbs/".$teacher_info->images;
    }
  }
  else{
    $filepath = "public/uploads/users/img/default.jpg";
  }    
?>

<body class="">
  <div class="jumbotron jumbotron-header-bar bg-secondary-force">
    <div class="container">
      <div class="jumbotron-header-bar__inner">
        <div>
          <h1 data-purpose="user-name"><?php echo $teacher_info->first_name." ".$teacher_info->last_name; ?></h1>
          <h2><?php 
            if($teacher_info->designation){ $brk = $teacher_info->designation;
            }
            else{ 
                 if($teacher_info->group_id == 4) $brk = "Admin";
            else if($teacher_info->group_id == 3) $brk = "Assistant";
            else if($teacher_info->group_id == 2) $brk = "Trainer";
            else if($teacher_info->group_id == 1) $brk = "Learner"; 
          }
          echo $brk;
          ?></h2>
        </div>
      </div>
    </div>
  </div>
<div class="container profile_main_content">
<?php
   
$attributes = array('class' => 'tform', 'id' => $teacher_info->id, 'email' => $teacher_info->email);
echo form_open_multipart('programs/send_mail', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/

?>
    <div class="col-sm-12 profile_content">
      <div class="col-sm-3">
          <div class="instructor_img">
            <img src="<?php echo base_url().$filepath; ?>" width="260" id="imgname" class="img-circle tech_img">
            <!-- <img src="<?php echo base_url(); ?>public/new_template/images/jonas.jpg" class="img-circle"> -->
           </div>
           <div class="instructor_content">
          <p><span class="fa fa-star "></span>&nbsp;<b>
          <?php echo number_format($rates,1);?></b>  <span> Average Rating</span></p>
          <p><i class="fa fa-comment" style=""></i>&nbsp;   <b><?php echo $rates1; ?></b> Reviews</p>
          <p><i class="fa fa-user" style=""></i>&nbsp;  <b><?php echo $no_stud; ?></b> Students</p>
          <p>    <i class="fa fa-play-circle" style=""></i>&nbsp;<b><?php echo $tot_courses->courses; ?></b> Courses</p>
          </div>
      </div>
        <div class="col-sm-9">
        <?php 
            // echo"<pre>";
            // print_r($teacher_info);
            // echo"</pre>";
                      ?>
          <p class="name_tittle"><a><?php echo $teacher_info->first_name.' '.$teacher_info->last_name; ?><!-- Jonas Schmedtmann --></a></p>
          <p class="designation">Designation : <?php echo $brk;?></p>
            <input type="hidden" name="teacher_id" value="<?php echo $teacher_info->id; ?>" />
            <input type="hidden" name="teacher_email" value="<?php echo $teacher_info->email; ?>" />
            <input type="hidden" name="your_name" value='<?php echo $name; ?>' />
          <?php if(!empty($teacher_info->prof_info) && $teacher_info->prof_info != '0'){ ?>
            <p class="mt20 fs18 bold">Professional Details : </p>
          <?php } ?>
            <div style="clear:both;"></div>
            <div class="pos-r">  
              <?php if(!empty($teacher_info->prof_info) && $teacher_info->prof_info != '0'){ ?>
              <div class="fs18 lh18 collapsable-text" data-collapsable-text-height="400">   
                <div id="profile" style="font-size: 18px; line-height: 1.8;">
                  <?php echo $teacher_info->prof_info; ?>
              </div>
            </div>
          <?php } ?>

             <ul class="mt40 fxw fxac ins-details">
            <li>
              <div class="color-cirtus fs34 bold"><?php echo $no_stud; ?></div>
              <div class="color-grey-chateau fs14 mt15"><i class="entypo-user"></i>Students</div>
            </li>
            <li>
              <div class="color-persian-red fs34 bold"><?php echo $tot_courses->courses; ?></div>
              <div class="color-grey-chateau fs14 mt15"><i class="entypo-book"></i>Courses</div>
            </li>
            <li>
              <div class="color-persian-red fs34 bold"><?php echo $rates1; ?></div>
              <div class="color-grey-chateau fs14 mt15"><i class="entypo-quote"></i>Reviews</div>
            </li>
          </ul>
        </div>
</div><br><br>

<!-- feedback section -->
<style type="text/css">
  .feedback .fa.checked {
    font-size: 22px;
  }
</style>
  <div class="col-sm-12 std_feedback std_feedback123">
    <h2>Student Feedback</h2>
    <div class="col-sm-12">
      <div class="col-sm-3">
        <h1 class="rating1"><?php echo number_format($rates,1); ?></h1>
        <p class=" feedback">
          <span class="fa fa-star<?php if($rates>=1){echo "";}else if($rates>0 && $rates<1){echo "-half-o";}else{echo "-o";} ?> checked"></span>
          <span class="fa fa-star<?php if($rates>=2){echo "";}else if($rates>1 && $rates<2){echo "-half-o";}else{echo "-o";} ?> checked"></span>
          <span class="fa fa-star<?php if($rates>=3){echo "";}else if($rates>2 && $rates<3){echo "-half-o";}else{echo "-o";} ?> checked"></span>
          <span class="fa fa-star<?php if($rates>=4){echo "";}else if($rates>3 && $rates<4){echo "-half-o";}else{echo "-o";} ?> checked"></span>
          <span class="fa fa-star<?php if($rates==5){echo "";}else if($rates>4 && $rates<5){echo "-half-o";}else{echo "-o";} ?> checked"></span>
        </p>
        <p>Average Rating</p>
      </div>
      <div class="col-sm-12 progress_rating">
      <!-- row1 -->
      
        <div class="col-xs-12">
          <div class="col-xs-8" >
            <div class="progress" style="height: 20px;">
              <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $five; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col-xs-4">
            <p>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span style="padding-left:20px;"><a><?php echo $five; ?>%</a></span>
            </p>
          </div>
        </div>
      <!-- row2 -->
        <div class="col-xs-12">
          <div class="col-xs-8" >
            <div class="progress" style="height: 20px;">
              <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $four; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col-xs-4" >
            <p>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star-o checked"></span>
              <span style="padding-left:20px;"><a><?php echo $four; ?>%</a></span>
            </p>
          </div>
        </div>
      <!-- row3 -->
        <div class="col-xs-12">
          <div class="col-xs-8" >
            <div class="progress" style="height: 20px;">
              <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $three; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col-xs-4" >
            <p>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star-o checked"></span>
              <span class="fa fa-star-o checked"></span>
              <span style="padding-left:20px;"><a><?php echo $three; ?>%</a></span>
            </p>
          </div>
        </div>
      <!-- row4 -->
        <div class="col-xs-12">
          <div class="col-xs-8" >
            <div class="progress" style="height: 20px;">
              <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $two; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col-xs-4" >
            <p>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star-o checked"></span>
              <span class="fa fa-star-o checked"></span>
              <span class="fa fa-star-o checked"></span>
              <span style="padding-left:20px;"><a><?php echo $two; ?>%</a></span>
            </p>
          </div>
        </div>
     <!-- row5 -->
        <div class="col-xs-12">
          <div class="col-xs-8" >
            <div class="progress" style="height: 20px;">
              <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $one; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col-xs-4" >
            <p>
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star-o checked"></span>
              <span class="fa fa-star-o checked"></span>
              <span class="fa fa-star-o checked"></span>
              <span class="fa fa-star-o checked"></span>
              <span style="padding-left:20px;"><a><?php echo $one; ?>%</a></span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

<!--   <div class="col-sm-12 cust_review">
    <div class="col-sm-12">
      <div class="col-sm-4">
        <div class="col-xs-12 cust_review_main">
        <img src="<?php echo base_url(); ?>public/new_template/images/cr.jpg" class="img-circle">
        <div class="Cust_review_right_txt">
          <p>2 months ago</p>
          <p>Brandon Soares</p>
        </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="col-xs-12">
          <p>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span></p>
          <p class="rev_content">It is realy well organized course.It helps a lot.Thank you!</p>
          <p class="rev_content2">Was this review helpful?&nbsp;<span class="btn btn-sm btn-default">yes</span>&nbsp;
            <span class="btn btn-sm btn-default">No</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Report</span>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12 cust_review">
    <div class="col-sm-12">
      <div class="col-sm-4">
        <div class="col-xs-12 cust_review_main">
          <img src="<?php echo base_url(); ?>public/new_template/images/cr.jpg" class="img-circle">
        <div class="Cust_review_right_txt">
          <p>2 months ago</p>
          <p>Brandon Soares</p>
        </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="col-xs-12">
          <p>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked "></span></p>
          <p class="rev_content">It is realy well organized course.It helps a lot.Thank you!</p>
          <p class="rev_content2">Was this review helpful?&nbsp;<span class="btn btn-sm btn-default">yes</span>&nbsp;
            <span class="btn btn-sm btn-default">No</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Report</span>
          </p>
        </div>
      </div>
    </div>
  </div> -->
<!-- row Review end-->
  <!-- <div class="col-sm-12 cust_review_btn" align="center">
    <button class="btn btn-default" type="button" data-purpose="show-more-review-button" id="btn_rev">Show More Reviews</button>
  </div> -->
</div>
 </div>
<?php

 if($courses){ ?>
<section class="three_slider profile_page_slider">
  <div id="myCarouselWrapper" class="fullwidth-slider-sect container no-padding1">
    <div id="myCarousel" class="carousel slide">
      <h4 style="text-align:center;">More Courses by <?php echo $teacher_info->first_name.' '.$teacher_info->last_name;?></h4>
      <div class="carousel-inner all_courses" role="listbox">
      <?php foreach ($courses as $course) {
        ?>
        <div class="item-item col-md-3 col-sm-4 col-xs-6 res_col no-padding1">
          <a href="<?php echo base_url();?>online-courses/<?php echo $course->slug; ?>">
            <div class="card">
              <div class="cardhover">
                  <img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo $course->image ? $course->image : 'no_images_course.png'; ?>" width="100%">
              </div>
              <h5 class="card_heading2"><?php echo $course->name; ?></h5>
              <p class="jonas"><?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?></p>
              <?php 
                $reviews = $CI->program_model->getAllReview($course->id);
                $rcount = 0;
                if(!empty($reviews)){
                  $rev_count = count($reviews);
                  foreach ($reviews as $review) {
                    $rcount = $rcount + $review->review_rate;
                  }
                  $rcount = floatval($rcount) / floatval($rev_count);
                }else{
                  $getextras = $this->Crud_model->get_single('demo_data',"course_id = ".$course->id,"ratings");
                  $rcount = $getextras->ratings;
                }
                ?>
              <p class="star">
                  <?php for ($i=1; $i <=5 ; $i++) { 
                  echo "<span class='fa fa-star";
                          if($rcount>=$i)
                          {
                            echo "";
                          }
                          else if($rcount>$i-1 && $rcount<$i)
                          {
                            echo "-half-o";
                          }else{
                            echo "-o";
                          }
                          echo " checked'></span>";
                        } ?>
                <span class="small_card"><?php if($rcount>0) echo "( ".number_format($rcount,1)." ratings )"; ?></span>
              </p>

              <p class="rupees" align="right"><span class="del_price"><?php if($course->fixedrate > 0){ echo $currency_symbol.' '.$course->fixedrate; } else { echo 'FREE'; } ?></span>
                <?php if($course->demoprice >0){ ?>
                <span class="del_price2"><?php echo $currency_symbol.' '.$course->demoprice; ?></span>
                <?php } ?>
              </p>
            </div>
          </a>
        </div>
    <?php } ?>
      </div>
    </div>
  </div>
</section>
  <?php } ?>
<?php 
echo $this->load->view('new_template_design/footer'); 
?> 
</body>
</html>