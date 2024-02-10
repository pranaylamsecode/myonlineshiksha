<?php
// https://vimeo.com/473463421/fc18c20966
$CI = & get_instance();
$CI->load->view('new_template_design/header');
$curr_date = date("Y-m-d");
if($count_program_plans > 0)
{
$subscription = 1;
}
else
{
$subscription = 0;
}
if($user_id){
  if($isEnrolled > 0 && $getBuyCoursesUser==0)
  {
    if($block_enrolled == 0)
    { 
      $btn_msg = "Start learning now";
      $showalready ="Already Subscribed";
    }
    else
    {
      $btn_msg = "Temporary Blocked";
      $showalready =""; 
    }
  }
  else if($isEnrolled > 0 && $curr_date < $exp_date)
  { 
    if($block_enrolled == 0)
    { 
      $btn_msg = "Start learning now";
      $showalready ="Already Subscribed";
    }
    else
    {
      if(intval($programs->fixedrate) <= 0 && intval($programs->demoprice) <= 0)
      { 
        $btn_msg = "Enroll Now";
      }
      else{
        $btn_msg = "Take this course";
        $showalready ="";
      }
    }
  }
  else
  { 
       if($programs->course_type == '2')
       { 
          /*$counts_students = $this->programs_model->getEnrolledUser($programs->id);
          $en_count = count($counts_students);*/
           if($webinars2->attendees_limit == '' || $webinars2->attendees_limit > $en_count)
           {
              $btn_msg = "Take this course";
              $showalready ="";
           }
            else{
              $btn_msg = "Enrol limit is over";
              $showalready ="";
            }
      }
       else{
          if(intval($programs->fixedrate) <= 0 && intval($programs->demoprice) <= 0)
          { 
            $btn_msg = "Enroll Now";
          }
          else{
            $btn_msg = "Take this course";
            $showalready ="";
          }
     }
  } 
}else{
  
      if(intval($programs->fixedrate) <= 0 && intval($programs->demoprice) <= 0)
      { 
        $btn_msg = "Enroll Now";
      }
      else{
        $btn_msg = "Take this course";
        $showalready ="";
      }
}

// code for renewal of a course using subscription
$expires_in = '';
if(!empty($exp_date) && $exp_date != '0000-00-00' && $exp_date < date('Y-m-d'))
{
  $expires_in = '0';
  $btn_msg = "Renew Subscription";
  $showalready ="Subscription Expired";
}
else if(!empty($exp_date) && $exp_date != '0000-00-00' && $exp_date >= date('Y-m-d'))
{
  // $btn_msg = "Already Subscribed";
  // $showalready ="Subscription Expired";
	$date1=date_create(date('Y-m-d'));
	$date2=date_create($exp_date);
	$diff=date_diff($date1,$date2);
	$expires_in = $diff->format("%a");
	if($expires_in <= 3){
		if($expires_in == 1)
			$expires_in_msg = '<span style="color: #DC3F3F;font-weight:bold;">Expiring Tomorrow</span>';
		else if($expires_in == 0){
			$expires_in_msg = '<span style="color: #DC3F3F;font-weight:bold;">Expiring Today</span>';
		}
		else
			$expires_in_msg = '<span style="color: #DC3F3F;font-weight:bold;">Expiring in '.$expires_in.' days</span>';
	}else
		$expires_in_msg = '';
}else
	$expires_in_msg = '';
// code for renewal of a course using subscription
/*$wishlist = $CI->Category_model->getProgramWishlist($user_id,$pro_id);
// print_r($wishlist);exit;
$wishlisted = NULL;
foreach ($wishlist as $wish_list) 
  {
    if($wish_list['program_id'] == $teach_course->id)
    {
          $wishlisted = 'yes';
        $wishlist_id = $wish_list->wishlist_id;
    }
  }*/
 
function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
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
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}  ?>
<style type="text/css">
  .liveclass_bg{
    background: #000;

  }
   .livebadge{
      position: absolute;
      top: -30px;
      padding: 5px 15px 7px 15px;
      border-radius: 0px;
      background: #ea5252;
    }
  @media (max-width: 880px){
    .liveclass_bg .course_detail_top_sec{
      background: #000;
    }
    .livebadge{
      position: relative;
      top: -10px;
    }
  }

</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/new_template/css/course_details.css');?>">
<script type="text/javascript" src="<?php echo base_url('public/new_template/js/course_details.js');?>"></script>
<?php 
function renderStarRating($rating,$maxRating=5) {
    $fullStar = "<li style='display:inline-block' ><i class = 'fa fa-star checked'></i></li>";
    $halfStar = "<li style='display:inline-block' ><i class = 'fa fa-star-half-full checked'></i></li>";
    $emptyStar = "<li style='display:inline-block' ><i class = 'fa fa-star-o checked'></i></li>";
    $rating = $rating <= $maxRating?$rating:$maxRating;

    $fullStarCount = (int)$rating;
    $halfStarCount = ceil($rating)-$fullStarCount;
    $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

    $html = str_repeat($fullStar,$fullStarCount);
    $html .= str_repeat($halfStar,$halfStarCount);
    $html .= str_repeat($emptyStar,$emptyStarCount);
    $html = '<ul>'.$html.'</ul>';
    return $html;
}
if($isEnrolled > 0) { 
  $startTimeStamp = strtotime(date('Y-m-d'));
  $endTimeStamp = strtotime($exp_date);
  $timeDiff = abs($endTimeStamp - $startTimeStamp);
  $numberDays = $timeDiff/86400;  // 86400 seconds in one day
  if($curr_date > $exp_date)
  {
    $message['text'] = "This course has been Expired.Click here to <a href='".base_url()."myinfo/mycourses'>Renew Now</a>";
  }
  else 
  {
    $message['text'] = "You Have ".$numberDays." days remaining to view this course.Click here to <a href='".base_url()."myinfo/mycourses'>Renew Now</a>";  
  }
  $message['type'] = 'error';
  if($message)
  {  
    if ( is_array($message['text']))    
    {   
      echo '<script type="text/javascript">toastr.success("Some by marianne admitted speaking.", "This is a title", opts);</script>';
      echo "<div class='msg_".$message['type']."'>";   
      echo "<ul>";       
      foreach ($message['text'] as $msg)    
      {                  
      echo "<li><span>".$msg."</span></li>";  
      }
      echo "<ul>";
      echo "</div>";   
    }    
    else      
    {
      if($numberDays <= 15)
      {
        if($message['type'] == 'error')
        {
          $save_msg = $message['text'];   
          echo '<script type="text/javascript">toastr.error("'.$save_msg.'","Subscription Alert",opts13);</script>';
        }
      }
    }
  }
}

/*$lessonsch = array();
$lessonshasvalue = false;
foreach ($days as $day)
{
  $lessonsch = $this->Program_model->getLessons($day->id);
  if(empty($lessonsch))
  {
  continue;
  }
  else
  {
  $lessonshasvalue = true;
  break;
  }
}
 
 if($programs->webstatus == 'active' && $programs->course_type == '2')
 {
      $lessonshasvalue = true;
    }
*/

$pro_id = (isset($programs->id)) ? $programs->id : '';
$coursetype_details = $this->Program_model->getCourseTypeDetails ($pro_id);

if($user_id > 0)
{
  $date_enrolled22 = $this->Program_model->datebuynow($pro_id, $user_id);
  
  if(count($date_enrolled22) > 0)
  {
    $not_show = true;
  }
  else
  {
    $not_show = false;
  }
  $date_enrolled1 = (count($date_enrolled22) > 0) ? $date_enrolled22->buydate : '';
  $date_enrolled2 = strtotime($date_enrolled1);
}
else
{
  $not_show = false;
}

if(isset($date_enrolled)){
  $start_relaese_date1 = (isset($coursetype_details[0]["start_release"])) ? $coursetype_details[0]["start_release"] : '';
  $start_relaese_date = strtotime($start_relaese_date1);
  $start_date =  $date_enrolled1;
  $datestring = "%Y-%m-%d";
  $time = time();
  // $date_9 = smate($datestring, $time);
  // $date9 = $date_9;
  $date_9 = date("Y-m-d",strtotime($time));
  $date9 = strtotime($date_9);
  $interval = abs($date9 - $start_date);
  $dif_days = floor($interval/(60*60*24));
  $dif_week = floor($interval/(60*60*24*7));
  $dif_month = floor($interval/(60*60*24*30));
  if((isset($coursetype_details[0]["course_type"])) && $coursetype_details[0]["course_type"] == 1){
    if($coursetype_details[0]["lesson_release"] == 1)
    {
      $diff_start = $dif_days+1;
      $diff_date = $dif_days+1;
    }
    elseif((isset($coursetype_details[0]["lesson_release"])) && $coursetype_details[0]["lesson_release"] == 2){
      $diff_start = $dif_week+1;
      $diff_date = $dif_week+1;
    }
    elseif((isset($coursetype_details[0]["lesson_release"])) && $coursetype_details[0]["lesson_release"] == 3){
      $diff_start = $dif_month+1;
      $diff_date = $dif_month+1;
    }
  }
}
$step_less = 0; ?>
<span id="directpayer" style="display: none"><?php 
if(!empty($this->session->userdata('logged_in'))){
  echo $this->session->userdata('directpay');
}
$this->session->unset_userdata('directpay'); ?></span>
<span id="demo_cookie" style="display: none;"><?php echo $demo_cookie; ?></span>
<div id="message1"></div>
<!-- responsive menu -->
<?php 
if($this->session->userdata('payReceivedMsg'))
{
?>
<!--Payment_Status Pop-up-->
<div id="status"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct">
    <h3 class="general-heading">Payment Information</h3>
    <a class="status_modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
    <div class="pay_main_cont">
      <div class="tab-content">
        <div>
          <p>Transaction Id : <?php echo $this->session->userdata('transaction_id'); ?></p>
        </div>
        <div>
          <p>Payment Status : <?php echo $this->session->userdata('payReceivedMsg'); ?></p>
        </div>
        <div>
          <p>Reason : <?php echo $this->session->userdata('pending_reason'); ?></p>
        </div>
        <div>
          <p>Amount : <?php echo $this->session->userdata('amount'); ?></p>
        </div>
        <div>
          <p>Acknowledgement : <?php echo $this->session->userdata('ack'); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="status_lean_overlay" style="display: none; opacity: 0.5;"> </div>
<!--<div style="background-color: #EBF8A4;padding: 10px;border-radius: 5px;border: 2px solid #A2D246;margin:20px"> <?php //echo $this->session->userdata('payReceivedMsg'); ?> </div>-->
<?php
  $this->session->unset_userdata('payReceivedMsg');
  $this->session->unset_userdata('transaction_id');
  $this->session->unset_userdata('pending_reason');
  $this->session->unset_userdata('amount');
  $this->session->unset_userdata('ack');
}
?>
<div class="clr"></div>
<div class="all_coursesss cat_options">
  <div class="home-items col-md-12 col-sm-12 col-xs-12">
    <div class="btn-divs">
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/9th-Class-CBSE">Class 9th</a>
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/10th-Class-CBSE">Class 10th</a>
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/11th-Class-CBSE">Class 11th</a>
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/class-12th">Class 12th</a>
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/jee-mains">IIT JEE</a>
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/neet">NEET / AIIMS</a>
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/professional-courses">Professionals</a>
      <a type="button" class="btn-hs" href="<?php echo base_url();?>category/courses/it-software">IT Courses</a>
    </div>
  </div>
</div>
  <!-- breadcrumps starts here -->
<div class="breadcrumb flat">
  <div class="container">
  
  <?php
  $getcat = $this->Crud_model->get_single('mlms_category',"id = ".$programs->catid);

  if(!empty($last_Cat)){ ?>
  <a href="<?php echo base_url();?>category/courses/<?php echo $getcat->slug;?>"><span><?php echo $last_Cat; ?></span></a>
  <?php }
  else{ ?>
  <a href="<?php echo base_url();?>category/courses/<?php echo $getcat->slug;?>"><span><?php echo $base; ?></span></a>
  <?php }
  /* ?>
  ** temporary commented **
  <a href="<?php if(empty($last_Cat)){ echo base_url('category/courses').'/'.$programs->catid; }else{echo base_url('category/courses').'/'.$base_id;}?>"><span><?php echo $base; ?></span></a>
  <?php if(!empty($bread_cat)){
    $breadt = count($bread_cat);
     for ($i=$breadt-1; $i >=0 ; $i--) { ?>
    <a href="<?php echo base_url('category/courses').'/'.$bread_id[$i]; ?>"><span><?php echo $bread_cat[$i]; ?></span></a>
    <?php }
  
  }if(!empty($last_Cat)){ ?>
  <a href="<?php echo base_url();?>category/courses/<?php echo $programs->catid;?>"><span><?php echo $last_Cat; ?></span></a>
  <?php } */?>

  
  <a class="active"><?php echo $programs->name; ?></a>
  </div>
</div>

 <ul class="breadcrumbs">
  <?php /* ?>
  <li><a href="#"><span><?php echo $base; ?></span></a></li>
  <?php if(!empty($bread_cat)){
    // print_r($bread_cat);
    foreach ($bread_cat as $key) {
  ?>
  <li><a href="#"><span><?php echo $key; ?></span></a></li>
  <?php } }if(!empty($last_Cat)){ ?>
  <li><a href="<?php echo base_url();?>category/courses/<?php echo $programs->catid;?>"><span><?php echo $last_Cat; ?></span></a></li>
<?php } */?>
<?php if(!empty($last_Cat)){ ?>
  <li><a href="<?php echo base_url();?>category/courses/<?php echo $getcat->slug;?>"><span><?php echo $last_Cat; ?></span></a></li>
  <?php }
  else{ ?>
  <li><a href="<?php echo base_url();?>category/courses/<?php echo $getcat->slug;?>"><span><?php echo $base; ?></span></a></li>
  <?php } ?>
  <li class="active"><?php echo $programs->name; ?></li>
</ul> 
  <!-- breadcrumps ends here -->
<section class=" courses course_detail">
<div class="row-fluid ">
<div id="system-message-container"></div>
<?php
        if(isset($program) && !empty($program))
    { 
      $this->load->helper('access');
      if(isset($programs->level) && $programs->level == 0)
      {
              $level = 'Beginner';
      }
            if(isset($programs->level) && $programs->level == 1)
      {
        $level = 'Intermediate';
      }
            if(isset($programs->level) && $programs->level == 2)
      {
        $level = 'Advanced';  
      } 
  }   ?>

<div class="container-fluid dark-bg <?php if($programs->is_live_class == 1){echo 'liveclass_bg';}?>">
<div class="first_row wishlist_section">
  <div class="container">
    <div class="col-sm-10"></div>
    <div class="col-sm-2"></div>
  </div>
</div>
<!-- second row -->
<div class="container second_section">
     <div class="col-sm-8 course_detail_top_sec">
      <?php if ($programs->is_live_class == 1){ ?>
        <span class="badge livebadge"><i class="fa fa-television" aria-hidden="true" style="font-weight: bold;"></i> &nbsp;LIVE</span>
      <?php } ?>
        <h1 class="">

    <?php echo $programs->name; ?>    </h1>
    <div class="innersect mobile_sec">
          <div class="">
 <?php if($programs->preview){ ?>
          <div class="play-button" style="display: <?php echo ($programs->preview ? 'block' : 'none'); ?> " data-toggle="modal" data-target="#myModal">
          </div>
  <div class="modal fade preview_popup" id="myModal" role="dialog">
<center><button type="button" class="close" data-dismiss="modal">&times;</button>
<?php
 $path = $programs->preview;
 $video_src = '';
 if(strpos($path, 'youtu') > 0){
               $video_src1 = str_replace("youtu.be", "youtube.com/embed/", $path);
               $video_src = str_replace(".com/watch?v=", "", $video_src1);
 }
 else if(strpos($path, 'vimeo') > 0)
  {
         $video_src = str_replace("vimeo.com/", "player.vimeo.com/video/", $path);
  } 
  ?>
<iframe id="my-id" width="720" height="640" src="<?php echo $video_src; ?>?api=1&autoplay=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</center>
  </div>
<script src="<?php echo base_url() ?>public/js/froogaloop2.min.js"></script> 
<?php } ?>    

 <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/<?php echo $programs->image ? $programs->image : 'no_images_course.png'; ?>" width="100%">
            <!--  <img src="img1.jpg"  class="img-responsive"> -->
             </div>
             </div>
    <span class="head2">
      <div style="display: none" id="desc_txt"><?php echo $programs->description; ?></div>
    </span>

<?php $avgreview = $CI->customs_model->getAvgReview($programs->id); 
    $reviews = $CI->program_model->getAllReview($programs->id);
     if(empty($reviews))
      {
        $reviews1 = $this->Crud_model->GetData('mlms_review','',"external = 1 and program_id = ".$programs->id,'','',3);
      }

    $rcount = $avgreview->avg_review;
    if($rcount == 0)
    {
      $getextras = $this->Crud_model->get_single('demo_data',"course_id = ".$programs->id,"ratings");
      $rcount = floatval($getextras->ratings);
    }
    $alllecture = $CI->customs_model->countallDuration($programs->id); 
    $totLect = $CI->customs_model->countalllecture($programs->id,"lect");
    $totexams = $CI->customs_model->countalllecture($programs->id, "exam");
    $totmedia = $CI->customs_model->countalllecture($programs->id, "media");

?>
<div class="row">
  <div class="col-md-6">
    <div class="starsection">
     <?php
      $str1 = str_split($avgreview->avg_review, 3);
      echo renderStarRating($rcount);
      $counts_students = $this->programs_model->getEnrolledUser($programs->id);
      $en_count = count($counts_students);
      if($add_count)
      {
        $addc = $add_count->student_count;
      }
      else{
        $addc = 0;
      }
        ?>
        <span><?php $str1 = str_split($avgreview->avg_review, 3);
        if($rcount>0) echo "( ".$rcount." ratings ) &nbsp;"; ?> </span> <span class="stud_enroll"><?php echo intval($en_count) + intval($addc); if(intval($en_count) + intval($addc)>1){echo " Students";}else{echo " Student";}?> Enrolled </span>
    </div>
    <div class="textsmall">
      <span>Created by <a class="admin_creator" href="<?php echo base_url('teacher-profile/'.$teacher_info->slug);?>"><?php echo ucwords($teacher_info->first_name.' '.$teacher_info->last_name); ?></a></span>
        </div>
       </div>
       <div class="col-md-6 col-sm-6 new_section">
          <div style="padding-top: 0px;">
            <i class="fa fa-file-video-o" aria-hidden="true" style="color: #fff;"></i>
            <span style="color: #ffee33;font-weight: bold;padding-left: 5px;"><?php echo round($alllecture); ?> घंटों के रिकॉर्ड किये हुए videos.</span>
          </div>
          <div style="padding-top: 10px;">
            <span style="color: #ffee33;font-weight: bold;">Teacher से सवाल भी पूछ सकते हैं, जब तक चाहें।</span>
          </div>
        </div>
     </div>
     </div>

<!-- videobox -->
     <div class="col-sm-4 col-xs-12 rightbox">
      <?php
      $sessionarray = $this->session->userdata('logged_in');
       if($sessionarray && $sessionarray['groupid'] == '4'){ ?>
       
       <a class="link_page" target="_blank" style="float: right; color: #ffffff" href="<?php echo base_url().'admin/section-management/'.$programs->id; ?>">
      <span class="lnr lnr-pencil" style="font-size: 15px;"></span>
      <span class="crosslink">Edit Contents</span></a>
      
      <a class="link_page" target="_blank" style="float: right; color: #ffffff;padding-right: 10%" href="<?php echo base_url().'admin/edit/courses/'.$programs->id; ?>">
      <span class="lnr lnr-pencil" style="font-size: 15px;"></span>
      <span class="crosslink">Edit Course</span></a>
     <?php } ?>
      <div class="content">
      <div class="innercontent">
          <div class="innersect desktop_sec">
          <div class="">
 <?php if($programs->preview){ ?>
          <div class="play-button" style="display: <?php echo ($programs->preview ? 'block' : 'none'); ?> " data-toggle="modal" data-target="#myModal1">
          </div>
  <div class="modal fade preview_popup" id="myModal1" role="dialog">
<center><button type="button" class="close" data-dismiss="modal">&times;</button>
<?php
 $path = $programs->preview;
 $video_src = '';
 if(strpos($path, 'youtu') > 0){
               $video_src1 = str_replace("youtu.be", "youtube.com/embed/", $path);
               $video_src = str_replace(".com/watch?v=", "", $video_src1);
 }
 else if(strpos($path, 'vimeo') > 0)
  {
         $video_src = str_replace("vimeo.com/", "player.vimeo.com/video/", $path);
  } 
  ?>
<iframe id="my-id" width="720" height="640" src="<?php echo $video_src; ?>?api=1&autoplay=0" frameborder="0" allow="accelerometer; encrypted-media; gyroscope;" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</center>
  </div>
<script src="<?php echo base_url() ?>public/js/froogaloop2.min.js"></script> 
<?php } ?>    

 <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/<?php echo $programs->image ? $programs->image : 'no_images_course.png'; ?>" width="100%">
            <!--  <img src="img1.jpg"  class="img-responsive"> -->
             </div>
             </div>
              <div class="inner_content2">
                <div class="price" id="price_block" style="text-align: center;">
                  <?php
                  if($btn_msg == 'Renew Subscription'){ ?>
                    <span id="pricerate1" class="pricerate2 current_price" style="font-size: 26px;color: #ea5252;">Subscription Expired</span>
                  <?php }
                  else if($btn_msg == 'Start learning now'){ ?>
                    <span id="pricerate1" class="pricerate2 current_price" style="font-size: 26px;">Already Subscribed</span>
                  <?php }else{
        if(intval($programs->fixedrate) <= 0 && intval($programs->demoprice) >0 ){ $pricerate2 = $currency_symbol.''.$programs->demoprice; }
        else if(intval($programs->fixedrate) <= 0 && intval($programs->demoprice) <= 0) { $pricerate2 = "Free"; } else{ $pricerate2 = $currency_symbol.''.$programs->fixedrate; }

        if(intval($programs->fixedrate) > 0 && intval($programs->demoprice) >0){
          $price2 = $currency_symbol.''.$programs->demoprice;         

          if(intval($programs->fixedrate) > 0){
            $offer_amt = $programs->demoprice - $programs->fixedrate;
            $strr = str_split((($offer_amt/$programs->demoprice)*100), 5);
          }
          else if(intval($programs->demoprice) > 0 && intval($programs->fixedrate) <= 0)
          {
            $offer_amt = $programs->demoprice - $programs->fixedrate;
            $strr = str_split((($offer_amt/$programs->demoprice)*100), 5);
          }
        }
        ?>
                 <span id="pricerate2" class="pricerate2"></span>
                <span id="pricerate1" class="pricerate2 current_price"><?php echo $pricerate2; ?></span>
                <?php if($programs->demoprice){ ?>
                <span class="price2"> <span class="delprice" style="color: #EA939C;"><?php echo $price2; ?></span>  
        <b><span class="per_off"> <?php echo round((intval($programs->demoprice) > 0 ? $strr[0] : '100')); ?></span>% off</b></span>
        <input type="hidden" id="offper" value='<?php echo round((intval($programs->demoprice) > 0 ? $strr[0] : '100')); ?>'>
      <?php } 
    }
    echo $expires_in_msg;
      ?>
                </div>
<?php 
$urlCourse = strtolower($programs->name);     
      $urlCourse = trim(str_replace(' ', '-', $urlCourse));
      $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
      ?><div class=" btn btn-lg btn-primary btn-block buy_course_btn" id='buy_loader' style='display: none;'>
                <img src='<?php echo base_url()."public/images/loading.gif" ?>' width='32px' height='32px' >
              </div>
        <?php
      $buy_links = "";
        if($assigned)
        {
          if($isEnrolled > 0)
          {
           if($programs->id == "195")
            {
              $buy_links .= "href=".base_url()."lessons/lesson/195/886/5452";
            }
            else{
              $buy_links .= "href=".base_url().$urlCourse."/lectures/".$programs->id;
            }
          }
          else
          {
            if($programs->id == "195")
            {
              if($user_id){
                  $buy_links .= "href=".base_url()."programs/view/".$programs->id;
                } else{
                  $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
          $buy_links .= "direct_pay()' href='#registration'";
                }
            }
            else{
              $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
             if($user_id){
                   // $buy_links .= "show_payment_options()'";
                   $buy_links .= "showEnrolldiv()'";
                }
                else{
                  $buy_links .= "direct_pay()' href='#registration'";
                }
              }
          }
        }
        else if(intval($programs->fixedrate) > 0 || intval($programs->demoprice) > 0)
        { 
          if($isEnrolled > 0 && $getBuyCoursesUser->plan_id==0)
            {
              if($block_enrolled == 0)
              { 

               if($programs->id == "195")
                {
                  $buy_links .= "href=".base_url()."lessons/lesson/195/886/5452";
                }
                else{
                $buy_links .= "href='".base_url().$urlCourse."/lectures/".$programs->id."'";
                }
              }
              else
              {
                $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
                if($user_id){
                  /*if($user_id == 2290){
                    $buy_links .= "show_payment_options()'";
                  }else{*/
                  if($programs->is_live_class == 1)
                    $buy_links .= "show_payment_options()'";
                  else
                    $buy_links .= "getHash()'";
                  // }
                }
                else{
                  $buy_links .= "direct_pay()' href='#registration'";
                }
              }
            }
            else
            {
              $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
               if($user_id){
                /*if($user_id == 2290){
                    $buy_links .= "show_payment_options()'";
                }else{*/
                    // $buy_links .= "show_payment_options()'";
                  if($programs->is_live_class == 1)
                    $buy_links .= "show_payment_options()'";
                  else
                    $buy_links .= "getHash()'";
                // }
                }
                else{
                  $buy_links .= "direct_pay()' href='#registration'";
                }
            }
        }
        else
        {
          if($isEnrolled > 0)
          {
            if($block_enrolled == 0)
            { 

             if($programs->id == "195")
              {
                $buy_links .= "href=".base_url()."lessons/lesson/195/886/5452";
              }
              else{
                 $buy_links .= "href='".base_url().$urlCourse."/lectures/".$programs->id."'";
              }
            }
              else
              {
                $buy_links .= "onclick= 'showmsg()'";
              }
          }
          else
          {
            if($programs->course_type == '2')
            {
              $counts_students = $this->programs_model->getEnrolledUser($programs->id);
              $en_count = count($counts_students);
             if($webinars2->attendees_limit == '' || $webinars2->attendees_limit > $en_count )
             {
              if($programs->id == "195")
                {
                  if($user_id){
                  $buy_links .= "href=".base_url()."programs/view/".$programs->id;
                  } else{
                    $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
            $buy_links .= "direct_pay()' href='#registration'";
                  }
                }
                else{
               $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
               if($user_id){
                
                  $buy_links .= "showEnrolldiv()'";
                }
                 else{
                  $buy_links .= "direct_pay()' href='#registration'";
                }
              }
             }
             else {
               $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
               if($user_id){
                  $buy_links .= "showEnrollnotify()'";
                }
                else{
                  $buy_links .= "direct_pay()' href='#registration'";
                }
             }
            }
            else
            {       
              if($programs->id == "195")
              {
                if($user_id){
                  $buy_links .= "href=".base_url()."programs/view/".$programs->id;
                } else{
                  $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
          $buy_links .= "direct_pay()' href='#registration'";
                }
              }  
              else{    
               $buy_links .= "id='go'".' '."rel='leanModal'".' '."name='signup'".' '."onclick='";
               if($user_id){
                  $buy_links .= "showEnrolldiv()'";
                }
                else{
                  $buy_links .= "direct_pay()' href='#registration'";
                }
              }
            }
          }
        }
        if((!empty($exp_date) && $exp_date != '0000-00-00' && $exp_date >= date('Y-m-d')) || empty($exp_date) || $exp_date == '0000-00-00'){
        ?>
       	<a class=" btn btn-lg btn-primary btn-block buy_course_btn" type="button" <?php echo $buy_links;?>>
          <i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i ><?php echo $btn_msg;?></a>
        <?php }
        if($expires_in == '0'){
        	if($programs->is_live_class == 1)
	            $renew_links = "show_payment_options()";
	        else
	        	$renew_links = "getHash()";
        ?>
        <a class="btn btn-lg btn-primary btn-block buy_course_btn" type="button" onclick='<?php echo $renew_links;?>' style="margin-top: 10px !important;">
          <i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i >Renew Subscription</a>
        <?php }
        if($user_id)
          {
            $where = array('user_id' => $user_id, 'program_id' => $programs->id);
            $checkCard = $CI->Category_model->checkCard($where);
                if($isEnrolled <= 0)
                { echo "<div style='margin-top: 10px;' id='card_div'>";
                  if($checkCard){ ?>
                     <a class=" btn btn-lg btn-primary btn-block remove_card_btn" type="button" onclick="ajax_deletewishlist(<?php echo $programs->id ?>,<?php echo $checkCard ?>,'2')" ><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i >Remove Cart</a>
              <?php   }
                  else{ ?>
                    <a class=" btn btn-lg btn-primary btn-block add_card_btn" type="button" onclick="ajax_addwishlist(<?php echo $programs->id ?>,'2')" ><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i>Add to Cart</a>
                    
             <?php }
                  echo "</div>";
                }
          } ?>
    </div>
    <div id="promo_code" style="display: none">

                  <form class="navbar-form" role="search">
                    <div class="input-group btn-block">
                      <input type="hidden" name="course_id" id="course_id" value="<?php echo $programs->id; ?>" />
                      <input type="hidden" id="plan_id" name="plan_id" value="" />
                        <input type="hidden" value="" id="coupon_code" name="coupon_code">
                        <input type="hidden" id="valid_coupon" value="No"/>
                        <input type="text" class="form-control" placeholder="Enter coupon code" value="" id="promocode" name="promocode" onkeyup="return sync()">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button" value="Apply" onclick="promoApply()" id="btn_redeem">Apply
                            </button>
              <div id="promo_waitt" class="form-group text-center" style="display: none; float: center;">
                  <img src="<?php echo base_url();?>public/images/loading.gif" height="25px">
                  <span style="padding-left: 0px;">Please Wait</span>
              </div>
                        </div>
                    </div>
                    <div style="width: 100%;"><span id="promoMSg" ></span></div>
              </form>           
            </div>
            <?php 
            if($btn_msg != "Start learning now"){ ?>
            <center><a type="button" onclick="showhidecode()" id="hv_coupon" >Have a Coupon?</a></center>
            <?php } ?>
      <ul style="list-style-type: none;">
          <b>Includes:</b>
             <?php if ($programs->is_live_class != 1){ ?>
             <li style="padding-top: 8px;">
                   <i class="fa fa-mobile" style="font-size: 26px" aria-hidden="true"></i>
                <span class="fa_icon_sec">
                  <?php echo $programs->is_drip_course == '1' ? " Drip course with lifetime access " : " Lifetime access"; ?>                  
                </span>
            </li>
            <?php }if ($programs->is_live_class == 1){ ?>
            <li class="">
               <i class="fa fa-television" aria-hidden="true"></i>
                <span  class="fa_icon_sec" style="padding-left: 1px;">
                    Live doubt clearing sessions
                </span>
            </li>
            <?php } ?>
            <li class="">
               <i class="fa fa-file-video-o" aria-hidden="true"></i>
                <span  class="fa_icon_sec">
                    <?php echo round($alllecture); ?> hours of recorded videos.
                </span>
            </li>
            <li class="">
                <i class="fa fa-play-circle" aria-hidden="true"></i>
                <span class="fa_icon_sec">
                    <?php echo $totLect; ?> Lectures
                </span>
            </li>
             <?php if($totexams > 0){ ?>
            <li class="">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <span class="fa_icon_sec">
                    <?php echo $totexams; ?> Quizzes
                </span>
            </li>
          <?php } if($totmedia > 0){ ?>
            <li class="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span class="fa_icon_sec">
                    <?php echo $totmedia; ?> Downloadable resource
                </span>
            </li>
             <?php } ?>
            <?php if($programs->webstatus == 'active'){ ?>
             <li class="">
                   <i class="fa fa-mobile" aria-hidden="true"></i>
                <span class="fa_icon_sec">
                    Live Classes & Recording
                </span>
            </li>
          <?php } ?>
            <li class="">
                <i class="fa fa-certificate" aria-hidden="true"></i>
                <span class="fa_icon_sec">
                   <?php if($programs->certificate_term =='1') 
                          echo "No Certificate";
                          else if($programs->certificate_term =='2')
                            echo "Certificate of completion";
                            // echo "After successful completion of all lectures";
                          else if($programs->certificate_term =='3')
                            echo "Certificate on passing final exam";
                            // echo "After passing the final exam";
                          else if($programs->certificate_term =='4')
                            echo "Certificate on passing the exams with average score";
                            // echo "After passing the exams on an average";
                          else if($programs->certificate_term =='5')
                             echo "Certificate on complete the course with passing the final exam";
                            // echo "After finishing all the lectures and passing the final exam";
                          else if($programs->certificate_term =='6')
                            echo "Certificate on complete the course with passing the final exam on average score";
                            // echo "After finishing all the lectures and passing all the exams on an average ";
                   ?>  
                </span>
            </li>
          </ul>
            <!-- <div id="promo_code" style="display: none">

                  <form class="navbar-form" role="search">
                    <div class="input-group btn-block">
                      <input type="hidden" name="course_id" id="course_id" value="<?php echo $programs->id; ?>" />
                      <input type="hidden" id="plan_id" name="plan_id" value="" />
                        <input type="hidden" value="" id="coupon_code" name="coupon_code">
                        <input type="hidden" id="valid_coupon" value="No"/>
                        <input type="text" class="form-control" placeholder="Enter coupon code" value="" id="promocode" name="promocode" onkeyup="return sync()">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button" value="Apply" onclick="promoApply()" id="btn_redeem">Apply
                            </button>
                              <div id="promo_waitt" class="form-group text-center" style="display: none; float: center;">
                                  <img src="<?php echo base_url();?>public/images/loading.gif" height="25px">
                                  <span style="padding-left: 0px;">Please Wait</span>
                              </div>
                        </div>
                    </div>
                    <div style="width: 100%;"><span id="promoMSg" ></span></div>
              </form>           
            </div>
            <?php 
            if($btn_msg != "Start learning now"){ ?>
            <center><button style="text-align: center; font-size: 15px; width: 90%;margin-bottom: 10px;" onclick="showhidecode()" id="hv_coupon" class="btn btn-success">Have a Coupon?</button></center>
            <?php } ?> -->
            <hr>
            <p style="text-align: center;">Share us : 
            <?php 
            // $cat = $category->slug;
            $course = $programs->slug;
            if($sessionarray && !empty($sessionarray['referral_code']))
            { 
                $shareUrl = "https://myonlineshiksha.com/online-courses/".$course."?ref=".$sessionarray['referral_code']."";
                $email = 'mailto:?subject=MYOnlineShiksha&body=Check out this site: '. $shareUrl .'" title="Share by Email';
                $text = rawurlencode($shareUrl);
            }
            else
            {
                $shareUrl = "https://myonlineshiksha.com/online-courses/".$course;
                $email = 'mailto:?subject=MYOnlineShiksha&body=Check out this site: '. $shareUrl .'" title="Share by Email';
                $text = rawurlencode($shareUrl);
            }
            ?>
            <a class="link_page" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo $text; ?>">
            <img src="<?php echo base_url();?>public/uploads/logo/facebook.png" height="30" width="30" >
            </a>&nbsp;
            
            <a class="link_page" target="_blank" href="https://twitter.com/share?url=<?php echo $text; ?>">
            <img src="<?php echo base_url();?>public/uploads/logo/twitter.png" height="30" width="30" >
            </a>&nbsp;
            <a class="link_page hidden-md hidden-lg" target="_blank" href="https://api.whatsapp.com/send?&text=<?php echo $text; ?>">
            <img src="<?php echo base_url();?>public/uploads/logo/whatsapp.png" height="30" width="30" >
            </a>

            <a class="link_page hidden-xs hidden-sm" target="_blank" href="https://web.whatsapp.com/send?&text=<?php echo $text; ?>">
            <img src="<?php echo base_url();?>public/uploads/logo/whatsapp.png" height="30" width="30" >
            </a>&nbsp;

            <a class="link_page" target="_blank" href="https://www.linkedin.com/shareArticle?url=<?php echo $text; ?>">
            <img src="<?php echo base_url();?>public/uploads/logo/linkedin.png" height="30" width="30" >
            </a>&nbsp;

            <a class="link_page" target="_blank" href="<?php echo $email; ?>">
            <img src="<?php echo base_url();?>public/uploads/logo/email.png" height="30" width="30" >
            </a>

           </p>
            <!-- <br> -->
            <center>
            <?php if(!empty($programs->qr_image)){ ?>
              <img src="<?php echo base_url();?>public/uploads/programs/qr_code/<?php echo $programs->qr_image;?>" width="200px" height="200px" name="qr_image" id="qr_image"/>
            </center>
            <?php } ?>
              <div class="col-sm-12" id="guide_vdo" style="padding-top: 30px;border-top: 2px solid #cecdcd;margin-top: 15px;">
                <center><span>If you have any doubts about how to get and access this course, watch this video.</span></center>
                <iframe src="https://www.youtube.com/embed/JFYkfAXerjY" allow="accelerometer; encrypted-media; gyroscope;" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" style="width: 100%;margin: 15px 0 20px 0;height: 225px;border-radius: 5px;" class="" frameborder="0"></iframe>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<style type="text/css">
/*accordian*/
.accordion-demo-611 {
    padding: 0px;
} 
.accordion-demo-611 .panel-group .panel{
    border-radius: 0px;
    box-shadow: none;
    border:none;
}

.accordion-demo-611 .panel-title a:before, .accordion-demo-611 .panel-title .collapsed:hover:before {
    left: 30px;
    top: 19px;
    font-size:12px;
    color: #007791;
}
button.accordion1.active {
    border-bottom: 1px solid #e8e9eb!important;
}

.accordion-demo-611 .panel-heading{
    padding: 0;
}
.accordion-demo-611 .panel-title{
    position: relative;
}
.accordion-demo-611 .accordion1 {
  background: #f9f9f9;
    border: 1px solid #e8e9eb;
    font-size: 15px;
    cursor: pointer;
    color: #505763!important;
    padding-left: 8px;
    letter-spacing: 0.03em;
    width: 100%;
    text-align: left;
    transition: 0.4s;
    /*margin-top: 3px;*/
    padding: 15px 20px;
}
.accordion-demo-611 .accordion1:before {
    content: '\002B';
    color: #666;
    font-weight: bold;
    float: left;
    margin-right: 10px;
    line-height: 20px;
    font-size: 19px;
    padding-top: 1px;
}
.course_detail .accordion-demo-611 .panel {
    padding: 0 0px;
    margin-bottom: 3px;
    background-color: white;
    max-height: 0px;
    overflow: hidden;
    border:none;
    transition: max-height 0.2s ease-out;
}
.accordion-demo-611 .panel-title > a:hover,
.accordion-demo-611 .panel-title > a:focus{
    text-decoration: none;
    outline: none;
}
.accordion-demo-611 .panel-title a:before,
.accordion-demo-611 .panel-title .collapsed:hover:before{
    content: "\f068";
    font-family: 'FontAwesome';
    position: absolute;
    left:30px;
    top:18px;
}
.accordion-demo-611 .panel-title a.collapsed:before{
    content: "\f067";
}
.accordion-demo-611 .panel-title .collapsed,
.accordion-demo-611 .panel-body{
    color:#999999;
}
.accordion-demo-611 .col-sm-8 {
    padding: 0px;
}
 .accordion-demo-611 .active::before {
      content: "\2212";
  }
  .only_res_batch{
    display: none;
  }
@media (max-width: 880px){
  .batch_rightsec{
    display: none !important;
  }
  .only_res_batch{
      display: block !important;
      font-size: 15px;
      font-weight: normal;
      float: right;
      padding-right: 10px;
  }
  .accordion-demo-611 .accordion1 {
  background: #f9f9f9;
    border: 1px solid #e8e9eb;
    font-size: 15px;
    cursor: pointer;
    color: #505763!important;
    padding-left: 8px;
    letter-spacing: 0.03em;
    width: 100%;
    text-align: left;
    transition: 0.4s;
    padding: 10px 8px;
}
   .accordion-demo-611 {
    padding: 0px 0px 15px 0px;
    background: #fff;
    margin: 0px 15px;
    border: 1px solid #ddd;
    border-top: 0px;
  }
  .accordion1 span {
      display: none;
  }
  .accordion-demo-611 .accordion1:before {
      content: '\002B';
      color: #666;
      font-weight: bold;
      float: right;
      margin-right: 10px;
      line-height: 20px;
      font-size: 18px;
      padding-top: 0px;
  }
  .accordion-demo-611 .active::before {
      content: "\2212";
  }
  .accordion-demo-611 .active, .accordion1:hover {
      background-color: #eee;
  }
}
</style>
<?php if(!empty($batches)){ ?>
<div class="container accordian_content ">
  <div class="col-sm-8 detail_page_commoncss">
    <div class="accord_col">
      <div class="col-sm-6 left_sec">
        <h3 class="detail_page_curr_title">Batches <span class="only_res_batch"> ( <?php echo count($batches);?> Batch<?php if (count($batches)>1) {echo 'es';} ?> ) </span></h3>
      </div>
      <div class="right_sec batch_rightsec col-sm-6 ">
        <div class="col-xs-4">
          <div id="" style="text-align: center; cursor: pointer;"> Starts from</div>
        </div>
        <div class="col-xs-4">Timing</div>
        <div class="col-xs-4">Intake</div>
      </div>
    </div>
  </div>              
</div>
<section class="accordion-demo-611">
  <div class="container">
    <div class="row">
      <?php foreach ($batches as $batch) { ?>
      <div class="col-sm-8" style="">
        <div class="main-panel-body">
          <button class="accordion1"><span class="acc_lecture_title"><?php echo ucwords($batch->batch_name);?></span>
            <span class="" style="text-align: right; float: right;">
              <span style="padding-right: 25px"><?php echo date('M d, Y',strtotime($batch->batch_from));?></span>
              <span class="accor_sub_text"><?php echo date('h:i A',strtotime($batch->batch_start_time)).' - '.date('h:i A',strtotime($batch->batch_end_time)); ?></span>
              <span> <?php echo $batch->enroll_limit;?></span> 
            </span>
          </button>
          <div class="panel batch_panel" style="">
            <?php $events = $this->Crud_model->GetData('zoom_meeting_list','id,topic,duration','conf_type = "batch" and batch_id = '.$batch->id);
            if(!empty($events)){
                foreach ($events as $evt) {
            ?>
            <div class="col-sm-12 sub_lectures">
              <a href="javascript:void(0)" class="outeranchor">
                <span class="s_underline"><?php echo ucwords($evt->topic);?></span>
                <span class="hidden_time" style="text-align: right; float: right;"><?php echo $evt->duration;?> min.</span>
              </a>
            </div>
            <?php } } ?>
          </div>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>
</section>
<?php } ?>
<!-- leftcontent -->
<?php if($programs->learn_points){ ?>
            <div class="container">

            <div class="col-sm-8 leftsection detail_page_commoncss">
            <h2 class="detail_page_title">
              
              What you'll learn 
            </h2>

            <div class="col-sm-12 no-padding learn_points" style="position: relative;overflow: hidden;">
              <?php $pts = strlen($programs->learn_points); 
                    if($pts > 300){ ?> 
                     <ul class="l_points" style="height: 200px; overflow: hidden;">
                      <a class="showview" id="show">View More</a>
                      <?php } else { ?>
                      <ul class="l_points">
                      <?php }   ?>
            
              <?php 
              $points = explode('* ', trim($programs->learn_points, '* '));
              $i=0;
                foreach ($points as $pt) {
                  $i++;
                 ?>
                 <li class=""  style="width:50%; <?php echo ($i%2 == 0 ? 'float: right' : 'float: left'); ?>" >
                    <span class="icon_left"><i class="fa fa-check" aria-hidden="true"></i>
                           </span>
                    <span class="text_right <?php echo $i; ?>"  style="<?php echo ($i%2 == 0 ? 'float: right' : 'float: left'); ?>" ><?php echo $pt; ?></span>
                 </li>
                 <?php
                }
               ?>               
                 </ul>   
               </div>
             </div>
           </div>
<?php } 
if ($programs->description) { ?>
      <div class="container">
         <div class="col-sm-8 no-padding description1 detail_description_sec detail_page_commoncss">
            <h4 class="detail_page_title ">Description  </h4>
<p class="head2" style="max-height: 10px;">
  <div class="viewmore" id="viewmore" style="display: none">
        <?php echo $programs->description; ?>

<?php 

if ($programs->pre_req || $programs->pre_req_books || $programs->reqmts ) { ?>
      <div class="container">
            <h4 class="requirements__title ">Requirements </h4>
          <?php if ($programs->pre_req) { ?>
          <div class="requirements__content">
<?php
                echo $programs->pre_req;
                ?><br>
                           </div><?php } if ($programs->pre_req_books) { ?>
                <div class="requirements__content">
                  <h4>Prerequisites Books:</h4>
                  <?php echo nl2br($programs->pre_req_books); ?><br>
                </div>
                <?php } if ($programs->reqmts) { ?>
                <div class="requirements__content">
                  <h4>Misc Requirements:</h4>
                  <?php echo nl2br($programs->reqmts); ?><br>
                </div>
              <?php } ?>

            </div>

<?php } ?>
  </div>
    </p>
      <div id="viewdesc"></div>

      <a id="showview" class="showview" style="display: none">View More</a>
    </div>
  </div>

<?php } ?>
                    <div class="container accordian_content ">
                    <div class="col-sm-8 detail_page_commoncss">
                      <div class="accord_col">
                        <div class="col-sm-6 left_sec">
                        <h3 class="detail_page_curr_title">Curriculum For This Course </h3>
                      </div>
                      <div class="right_sec col-sm-6 ">
                        <div class="col-xs-4">
                   <div id="expandall11" style="text-align: center; cursor: pointer;"> Expand All </div>
                    </div>
                    <div class="col-xs-4">
                      <?php 
                      echo $totLect." Lectures"; ?>
                    </div>
                    <div class="col-xs-4">
                 <?php  echo round($alllecture)." Hrs";  ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
 <?php 
$allLessonIds = array();
$i=0; 
if($days){ ?>
<section class="accordion-demo-61">
      <div class="container">
          <div class="row">
              <div class="col-sm-8">
<?php
$block_id = 0;
foreach ($days as $day)
{ $block_id++;
  $mediaid = $CI->uri->segment(3);
  $db_mediaaa = $CI->program_model->getMedia_oflayout('mod_m',$day->id);
  $db_texttt = $CI->program_model->getMedia_oflayout('mod_t',$day->id);
  $sectionname = $CI->program_model->getSectionName($day->id); 

   $lessons = $CI->program_model->getLessonNew($day->id);
  $nolesson = count($lessons); 
?>
<div class="main-panel-body">
            <button class="accordion"><span class="acc_lecture_title"><?php echo $day->title; ?></span>
              <span class="" style="text-align: right; float: right;"><span class="accor_sub_text"><?php echo $nolesson; ?> Lectures </span>
                    <span> Duration </span> 
                    </span>
                    </button>
      <div class="panel">
          <?php 
  //print_r($lessons);
            $dayaccess = $day->access;
foreach ($lessons as $lesson)
            {
               if($lesson->layoutid != '22')
              {
           $texty = $lesson->lecture_duration;

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
            $texty = "00.00 Hrs";
          }
                $allLessonIds[] = $lesson->id;
                if($coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE)
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
   if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0))
{?>
   <div class="col-sm-12 sub_lectures">
    <?php
  // $diff_start = 1;
  if($diff_start >0)
  {  ?>
    <a href="<?php echo base_url().'lessons/lesson/'.$programs->id.'/'.$day->id.'/'.$lesson->id;?>" class='outeranchor' ><span class="s_underline"> <?php echo $lesson->name;?></span><span class="hidden_time" style="text-align: right; float: right;"><?php if($lesson->lecture_duration){echo ucfirst($lesson->lecture_duration);}else{
                  echo '00.00 Hrs';}?></span></a>
          <?php 
  }
  else
  {
    ?>
          <a href="<?php echo 'javascript:void(0)';?>" class='outeranchor' ><span class="s_underline"> <?php echo ucfirst($lesson->name);?></span><span class="hidden_time" style="text-align: right; float: right;"><?php if($lesson->lecture_duration){echo ucfirst($lesson->lecture_duration);}else{
                  echo '00.00 Hrs';}?></span></a>
          <?php 
  } ?>
   </div><?php
}
else
{ 
  ?> <div class="col-sm-12 sub_lectures">
          <a href='<?php echo ($not_show === TRUE) ? base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : ($lesson->is_demo == 1 ) ? base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>' class='outeranchor' ><span class="s_underline"><?php echo $lesson->name;?></span><span class="hidden_time" style="text-align: right; float: right;"><?php if($lesson->lecture_duration){echo ucfirst($lesson->lecture_duration);}else{
                  echo '00.00 Hrs';}?></span></a>
          </div>
          <?php 
} 
 } }?>

</div>
   </div>
<?php 
    }
  ?>
            </div>
          </div>
      </div>
  </section>
 <?php  } ?>
            <div class="container about_instructor ">
           <div class="col-sm-8 no-padding detail_about_sec detail_page_commoncss">
            <h4 class="detail_page_title ">About the Instructor </h4>
            <div class="col-sm-9 col-sm-push-3 col-md-8 col-md-push-4 detail_about_author" style="height: 240px;overflow: hidden;">
          <a href="<?php echo base_url('teacher-profile/'.$teacher_info->slug);?>">
            <p class="name_tittle"><?php echo ucfirst($teacher_info->first_name).' '.ucfirst($teacher_info->last_name); ?>
            </p>
          </a>
            <p class="designation"><?php 
            if($teacher_info->designation){ echo $teacher_info->designation;  }
             // $brk = ',';}
            else { $brk = '';
                 if($teacher_info->group_id == 4) echo $brk." Admin";
            else if($teacher_info->group_id == 3) echo $brk." Assistant";
            else if($teacher_info->group_id == 2) echo $brk." Trainer";
            else if($teacher_info->group_id == 1) echo $brk." Learner";
          }
             ?>
            </p>
            <?php if($teacher_info->prof_info!='0' && $teacher_info->prof_info!=''){ // echo $teacher_info->prof_info;   ?>
            <div class="prof_info"><?php echo ($teacher_info->prof_info!='0') ? $teacher_info->prof_info : ''; ?></div>
            <a id="showview" href="<?php echo base_url('teacher-profile/'.$teacher_info->slug);?>">View More</a>
          <?php } else{ ?>
              <p>Instructor has not added bio.</p>
             <?php } ?>
           </div>
           <div class="col-sm-3 col-sm-pull-9 col-md-4 col-md-pull-8 author_logo_rating">
           <div class="instructor_img">
            <?php $filepath = "";
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
             <img src="<?php echo base_url().$filepath; ?>" class="img-circle"></div>
 <?php $no_stud = $CI->customs_model->getEnrollstudents($teacher_info->id);
       $tot_courses = $CI->customs_model->getUserCoursecount($teacher_info->id);
       $rates = $CI->customs_model->getInstRating($teacher_info->id);
       $rates1 = $CI->customs_model->getInstRating1($teacher_info->id);
 ?>
             <p><span class="fa fa-star "></span>&nbsp;<b>
              <?php $str = str_split($rates/$tot_courses->courses, 3);
              echo number_format($rates,1);
              ?></b>  <span> Average Rating</span></p>
              <p><i class="fa fa-comment" style=""></i>&nbsp;   <b><?php echo $rates1; ?></b> Reviews</p>
               <p>    <i class="fa fa-user" style=""></i>&nbsp;  <b><?php echo $no_stud; ?></b> Students</p>
                <p>    <i class="fa fa-play-circle" style=""></i>&nbsp;<b><?php echo $tot_courses->courses; ?></b><?php if($tot_courses->courses==1){ echo " Course";}else{echo " Courses"; } ?></p>
          </div>
        </div>
      </div>
      <div class="container stud_feeback_main_sect ">
           <div class="col-sm-8 std_feedback stud123 detail_page_commoncss">
           <h3 class="detail_page_title">Student Feedback</h3>

            <div class="col-sm-12 stud_feedback_rating">
            <div class="col-sm-3 rating_num">
              <h1 class="rating1"><?php
              // $str1 = str_split($avgreview->avg_review, 3);
              //     echo $str1[0];
              echo number_format($rcount,1);
                  ?></h1>
           <?php
           echo renderStarRating($rcount);
 ?>
              <p class="avg_rating">Average Rating</p>
            </div>
            <div class="col-sm-9 progress_rating">
<?php $countUser = $CI->customs_model->countuser(); 
  $rate_arr = array();
  foreach ($reviews as $review) {
array_push($rate_arr, $review->review_rate);
  }
  $vals = array_count_values($rate_arr);
$counts_students = $this->programs_model->getEnrolledUser($programs->id);
        $en_count = count($counts_students);
$get_reviews = $this->customs_model->course_rating($programs->id);
$count_reviews = count($get_reviews);
$one = 0; $two = 0; $three = 0; $four = 0; $five = 0; $tot_review = 0;
foreach ($get_reviews as $key) {
  $tot_review = $tot_review + $key->review_rate;
  switch ($key->review_rate) {
              case 1:
                $one++;
                break;
              case 2:
                $two++;
                break;
              case 3:
                $three++;
                break;
              case 4:
                $four++;
                break;
              case 5:
                $five++;
                break;
              
            }
}
$one = $one>0 ? (100/$count_reviews) * $one : 0;
  $two = $two>0 ? (100/$count_reviews) * $two : 0;
  $three = $three>0 ? (100/$count_reviews) * $three : 0;
  $four = $four>0 ? (100/$count_reviews) * $four : 0;
  $five = $five>0 ? (100/$count_reviews) * $five : 0;

// updated rating new calculation on basis of demo_data table
if(empty($avgreview->avg_review) || $avgreview->avg_review == 0){
  if($rcount == 5)
    $five = 100;
  else if($rcount== 4)
    $four = 100;
  else{
    $five = rand(50,55);
    $four = intval(100) - intval($five);
  }
}

?>
          <div class="col-xs-12">
                <div class="col-xs-8" >                  
                  <div class="progress" style="height: 20px;">     
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $five; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
                </div>
                <div class="col-xs-4" >
                  <p >
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                    <span style="padding-left:15px;"><a><?php echo round($five); ?>%</a></span>
           </p>
                </div>
                </div>
            <div class="col-xs-12">
                <div class="col-xs-8" >
                  <div class="progress" style="height: 20px;">
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $four; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
                </div>
                <div class="col-xs-4" >
                <p >
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star-o checked  "></span>
                    <span style="padding-left:15px;"><a><?php echo round($four);?>%</a></span>
           </p>
                </div>
                </div>
            <div class="col-xs-12">
                <div class="col-xs-8" >
                  <div class="progress" style="height: 20px;">
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $three; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
                </div>
                <div class="col-xs-4" >
                <p >
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
                <span class="fa fa-star checked "></span>
                <span class="fa fa-star-o checked  "></span>
                <span class="fa fa-star-o checked  "></span>
                    <span style="padding-left:15px;"><a><?php echo round($three); ?>%</a></span>
           </p>
                </div>
                </div>
            <div class="col-xs-12">
                <div class="col-xs-8" >
                  <div class="progress" style="height: 20px;">
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $two; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
                </div>
                <div class="col-xs-4" >
                <p >
              <span class="fa fa-star checked "></span>
              <span class="fa fa-star checked "></span>
                <span class="fa fa-star-o checked"></span>
                <span class="fa fa-star-o checked"></span>
                <span class="fa fa-star-o checked"></span>
                    <span style="padding-left:15px;"><a><?php echo round($two); ?>%</a></span>
           </p>
                </div>
                </div>
            <div class="col-xs-12">
                <div class="col-xs-8" >
                 <div class="progress" style="height: 20px;">
            <div class="progress-bar grey_bg" role="progressbar" style="width: <?php echo $one; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
                </div>
                <div class="col-xs-4" >
                  <p >
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star-o checked"></span>
                    <span class="fa fa-star-o checked"></span>
                    <span class="fa fa-star-o checked"></span>
                    <span class="fa fa-star-o checked"></span>
                    <span style="padding-left:15px;"><a><?php echo round($one); ?>%</a></span>
           </p>
                </div>
                </div>
            </div>
            </div>
           </div>
           </div>
<?php $reviews = $CI->program_model->getListReview($programs->id,0);
$num_rev = $CI->program_model->countReviews($programs->id);
if($num_rev !=0){
?>
           <div class="container reviews_bottom_sect ">
           <div class="col-sm-8 detail_page_commoncss">
           <div class="col-sm-12 no-padding">
             <div class="col-sm-6 col-xs-12">
               <p class="review detail_page_title">Latest Reviews</p>
             </div>
           </div>
         </div>
       </div>
              <?php } ?>
        <div class="container " id="rev_list">
                   <input type="hidden" class="review_limit" name="review_limit" value="4">
                   <input type="hidden" class="pro_id" name="pro_id" value="<?php echo $programs->id ?>">
                   <input type="hidden" class="num_rev" name="num_rev" value="<?php echo $num_rev ?>">
<?php
foreach ($reviews as $rev){
?>
       <div class="col-sm-8 cust_review detail_page_commoncss">
          <div class="col-sm-12">
            <div class="col-sm-4">
             <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php if($rev->images!=''){ echo $rev->images;}else{echo 'default.jpg'; }?>" class="img-circle">
              <div class="review_time_sect">
                <p class="review_date">
 <?php
                   echo get_timeago(strtotime($rev->review_date));
?></p>
                <p class="review_name"><?php echo $rev->first_name.' '.$rev->last_name; ?></p>
              </div>
            </div>
            <div class="col-sm-8 no-padding revi2w-otherinfo">
              <div class="col-xs-12 no-padding">
                <div class="review_star">
                  <?php for ($i=1; $i <=5 ; $i++) { ?>
                  <span class="fa fa-star<?php echo $i<=$rev->review_rate ? '' : '-o' ?> checked"></span>
                  <?php } ?>
                </div>
                <div class="rev_content"><p class="review_title"><?php echo $rev->title; ?></p><p class="review_des"><?php echo $rev->description; ?></p>
                </div>
                <!-- <div class="rev_content2"><span class="review_help_sec" style="margin-right:4px;">Was this review helpful?</span><span class="btn btn-sm btn-default">yes</span>
                  <span class="btn btn-sm btn-default">No</span><span>Report</span>
                </div> -->
              </div>
            </div>
          </div>
        </div>
<?php } 
// new code for static reviews uploaded by admin
if(empty($reviews) && !empty($reviews1))
{
  foreach ($reviews1 as $rev){
?>
       <div class="col-sm-8 cust_review detail_page_commoncss">
          <div class="col-sm-12">
            <div class="col-sm-4">
             <img src="<?php echo base_url(); ?>public/images/review_users/<?php if($rev->customer_profile!=''){ echo $rev->customer_profile;}else{echo 'default.jpg'; }?>" class="img-circle">
              <div class="review_time_sect">
                <p class="review_date">
                <?php echo get_timeago(strtotime($rev->review_date));?></p>
                <p class="review_name"><?php echo ucwords($rev->customer_name);?></p>
              </div>
            </div>
            <div class="col-sm-8 no-padding revi2w-otherinfo">
              <div class="col-xs-12 no-padding">
                <div class="review_star">
                  <?php for ($i=1; $i <=5 ; $i++) { ?>
                  <span class="fa fa-star<?php echo $i<=$rev->review_rate ? '' : '-o'; ?> checked"></span>
                  <?php } ?>
                </div>
                <div class="rev_content"><p class="review_title"><b><?php echo ucfirst($rev->title); ?></b></p><p class="review_des"><?php echo $rev->description; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php }
}
// static reviews uploaded by admin
  /*  if($num_rev > 4){
?>


  <!-- row Review end-->



            <div class="col-sm-8 cust_review_btn " align="center">
              <div id='loader' style='display: none;'>
                <img src='<?php echo base_url()."public/images/loading.gif" ?>' width='32px' height='32px'>
              </div>
          <button class="btn btn-default" type="button" data-purpose="show-more-review-button" id="btn_rev">Show More Reviews</button></div>
        <?php } */?>
                  </div>
 <?php   /*     $courses = $CI->customs_model->getUserCourses1($teacher_info->id,0);
 // print_r($teachercourse);
       if($courses){
     ?>
               <div class="container course_detail_slider">
           <div class="col-sm-12 card_container">
           <h4 class="detail_page_title"><b>More Courses by <?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?></b></h4>
<section class="first_slider dynamic_slide ">
  <input type="hidden" name="techid" id="techid" value="<?php echo $teacher_info->id ?> ">
    <div id="myCarouselWrapper" class="fullwidth-slider-sect container-fluid">
      <div id="myCarousel1" class="carousel slide" data-interval="false">
        <div class="carousel-inner" role="listbox">
          <input type="hidden" class="startlimit" name="startlimit" value="0">
        </div>
        <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
        <a class="right carousel-control carousel-control_right" href="#myCarousel1" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

      </div>   
    </div>
       <div class="responsive-slider-sect">
         <div class="inner_responsive_slider">
    <?php foreach ($courses as $othercourse) {  
     $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
 $catid = $CI->category_model->getCatSlugbyId($othercourse->catid);
    ?>
       <div class="responsive-main-slider-sect col-sm-12">
              <a href="<?php echo base_url().'online-courses/'.$othercourse->slug; ?>/" id="slug_url">

          <div class="resposive_txt">

            <div class="cardhover">
              <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%" >
              <!-- <div class="overlay"></div> -->
            </div>
            <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
            <p class="jonas"><?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?></p>
            <?php 
       $reviews = $this->program_model->getAllReview($othercourse->id);
       // print_r($reviews);
       $rcount = 0;
     foreach ($reviews as $review) {

  $rcount = $rcount + $review->review_rate;     }
?> <p class="star">
 <?php  for ($i=1; $i <=5 ; $i++) { 
                    echo "<span class='fa fa-star";
                    if($i<= @$reviews[0]->review_rate) echo ' checked'; 
                    else echo '-o checked'; 
                    echo "'></span>";
                  } 
  ?>
 <span class="small_card"><?php if($rcount>0) echo "( ".$rcount." ratings )" ?> </span>
              </p>
                    <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.''.$othercourse->fixedrate; } else { echo 'FREE'; } ?></span>
            <?php if($othercourse->demoprice >0){ ?>
      <span class="del_price2"><?php echo $currency_symbol.''.$othercourse->demoprice; ?>
                </span>
        <?php } ?>
</p>
            
        </div></a>
       </div>
     <?php } ?>

      </div>
      <?php if(count($courses) >3){ ?>
      <div class="text-center col-sm-12"><button data-purpose="load-more-btn" type="button" class="load-more-btn btn btn-default btnappend1">See More<span class="udi-small udi udi-chevron-down"></span></button></div>
    <?php } ?>
    </div>
  </section>
           </div>
           </div>
<?php } */?>
<?php 
    $total_courses = $this->Crud_model->get_single('mlms_program',"author = ".$teacher_info->id,"count(id) as total_course");
    $courses = $CI->customs_model->getUserCourses1($teacher_info->id,0);
    if($courses){
     ?>
    <div class="container course_detail_slider">
      <div class="col-sm-12 card_container">
        <h4 class="detail_page_title">
          <b><?php echo intval($total_courses->total_course) > 4 ?  'More Courses by '.ucwords($teacher_info->first_name." ".$teacher_info->last_name) : 'Popular Courses'; ?></b></h4>
        <input type="hidden" id="techid" value="<?php echo intval($total_courses->total_course) > 4 ? $teacher_info->id : '';?>">
        <input type="hidden" id="startlimit1" value="0">
        <input type="hidden" id="totalc" value="0">
        <div id="load_data" class="newrow">
        </div>
      </div>
    </div>
        <div class="text-center col-sm-12 col-md-12">
          <button data-purpose="load-more-btn" type="button" class="load-more-btn btn btn-default btnappend">See More<span class="udi-small udi udi-chevron-down"></span></button>
        </div>
<?php } ?>
<div id="payment"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct"> 
    <form id="subs_option" >
      <a class="sub_modal_close" href="#" onclick="pay_close()"><span class="lnr lnr-cross"></span></a>
      <div class="pay_main_cont" style="height: 333px; overflow-y: auto;">
        <div class="tab-content"> 
          
      <?php         
      foreach($program_plans as $prog_plan)
      {
      ?>
      <div style="width:100%; padding-top: 10px;">
            <div class="tile-stats">
              <div class="tile-header">
                <input type="radio"  name="plan_radio" id="plan_radio" value="" <?php if($prog_plan->default_new == 1) echo 'checked'; ?>/>
                <h3 style="color: #fff;"><?php echo $prog_plan->name; ?></h3>
                </div>
        <div style="margin-top: 15px; float: left;">
                <h3 style="float:left; margin-right: 10px; margin-left: 45px;">Price :&nbsp;<i class="fa fa-usd"></i><?php echo $currency_symbol.$prog_plan->price; ?></h3>
                <p><?php echo $prog_plan->term.'/'.$prog_plan->period; ?></p>
        </div>
                
              <div style="margin-top: 10px; margin-bottom: 10px; margin-right: 10px; float: right;">
                <!-- <button type="button"  onclick="showodiv(<?php echo $prog_plan->price;  ?>)" id="subs_button" class="btn btn-success">Subscribe</button> -->
               <button type="button"  onclick="showodiv(<?php echo $prog_plan->plan_id;  ?>,<?php echo $prog_plan->price; ?>)" id="subs_button" class="btn btn-success">Subscribe</button>

                </div>
            </div>
      </div>
      <?php
      }
      ?> 
        </div>
      </div>
    </form>
    
    <!--Confirm Purchase-->
    <?php $attributes = array('class' => 'tform', 'id' => 'conf_purchase' , 'style' => 'display:none');
   // echo form_open_multipart(base_url().'programs/payment', $attributes); 
    echo form_open_multipart(base_url().'paymentprocess/payment_Process', $attributes);
    ?>
    <!--<form id="conf_purchase" style="display:none" >-->
    
    <!-- <h3 class="general-heading">Confirm Purchase</h3> -->
    <a class="pay_modal_close" href="#" onclick="pay_close()"><span class="lnr lnr-cross"></span></a>
    
    <div class="pay_main_cont">
      <div>
      
        <ul class="nav nav-tabs bordered">
          <!-- available classes "bordered", "right-aligned" -->
          <!--<li class="active"> <a href="#credit" data-toggle="tab"> <span class="visible-xs"><i class="entypo-home"></i></span> <span class="hidden-xs">Credit</span> </a> </li>-->
          <?php
            if($pay_setting['0']['paypal_status'] == 1)
            {
         ?>
         <!--  <li class="active"> <a href="#paypal" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Paypal</span> </a> </li> -->
         <li class="active"> <a href="#paypal" data-toggle="tab"> <span class="">Payment Option</span> </a> </li>
          <?php
              }
              if($pay_setting['0']['directpay_status'] == 1)
              {
          ?>
          <li> <a href="#direct" data-toggle="tab"> <span class="">Other Information</span> </a> </li>
          <?php
              }
          ?>
        </ul>
      </div>
      <div class="tab-content">        

        <?php
            if($pay_setting['0']['paypal_status'] == 1)
            {
         ?>
        <div class="tab-pane active" id="paypal" style="padding:5px 0px 0 0px; border:0; ">
      <!-- /*  <div class="payment_source">
          <input type="hidden" name="course_id" id="course_id" value="<?php echo $programs->id; ?>" />
          <input type="hidden" id="plan_id" name="plan_id" value="" />
          <input type="hidden" id="coupencode_paypal" name="coupencode" value="" />
          
          <div class="paytext"> Go To PayPal </div><div class="paybutton"><?php echo form_submit( 'submit', 'Pay now', "class='btn btn-primary '"); ?> </div>
           
          </div> */ -->
          <!-- <div style="color: #8392A3; font-size: 13px; margin-top:10px;"> You will be redirected to Paypal's payment page and then sent back once you complete your purchase. </div>
          <div style="color: #8392A3; font-size: 13px; margin-top:10px;"> By clicking the "Pay" button, you agree to these <a href="#" target="_blank"><b>Terms of Service</b></a>. </div>
          <div style="color: #8392A3; font-size: 13px; text-align:center; margin-top:10px;"> <a href="#"><i class="entypo-lock-open"></i>Secure Connection</a> </div> -->
        <!-- </div> -->

        <!-- payby_payumoney -->
         <!-- <div class="tab-pane active" id="paypal" style="padding:15px 10px 0 10px; border:0; "> -->
          <!-- <input type="hidden" name='price' id="price"    value="<?php echo $programs->fixedrate=="0.00" ? $default_plans['0']['price']  : $programs->fixedrate;?>"  style="width:100%; border: 1px solid #C7C7C7; height:40px;"  />  -->
          <!-- <input type="hidden" name='price' id="price"    value="<?php echo $programs->fixedrate;?>"  style="width:100%; border: 1px solid #C7C7C7; height:40px;"  /> -->
         <div class="payment_source">
          <input type="hidden" name="course_id" id="course_id" value="<?php echo $programs->id; ?>" />
          <input type="hidden" id="plan_id" name="plan_id" value="" />
          <input type="hidden" id="coupencode_payU" name="coupencode" value="" />
          <input type="hidden" id="valid_coupon" value="No"/>
          <div class="paytext"> Go To PayUmoney </div>

            <div class='pm-button paybutton' onclick="getHash();"><a class="btn btn-primary" href='#'>Pay now</a></div>
          </div>
          <div style="color: #262626; font-size: 13px; margin-top:10px;"> You will be redirected to payment gateway and then sent back once you complete your purchase. </div>
          <div style="color: #262626; font-size: 13px; margin-top:10px;"> By clicking the "Pay Now" button, you agree to these <a href="#" target="_blank"><b>Terms of Service</b></a>. </div>
          <div style="color: #262626; font-size: 13px; text-align:center; margin-top:10px;"> <a href="#"><i class="entypo-lock-open"></i>Secure Connection</a> </div>
        </div>
        <?php
          }
          if($pay_setting['0']['directpay_status'] == 1)
            {
        ?>
        <div class="tab-pane" id="direct" style="padding:15px 10px 0 10px; border:0; ">
          <div>
            <?php 
            $Otherpay = $this->settings_model->getAccountMode();
            foreach ( $Otherpay as $Otherpay2) {
            ?>
          <div style="line-height: 1.7em;"> <?php echo $Otherpay2['directinfo']; ?> </div>
          <div id="request_exist"></div>
          <?php  } ?>
          </div>
          <div> <?php echo form_submit( 'submit', 'Direct Payment',  "class='btn-primary_stb'"); ?></div>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <!--</form>--> 
  </div>
</div>
<?php $configarr = $this->settings_model->getItems();  ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   
<!-- <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="<?php echo base_url() ?>public/uploads/settings/img/logo/<?php echo $configarr['0']['favicon'] ?>"></script> -->
  
<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="<?php echo base_url() ?>public/uploads/settings/img/logo/<?php echo $configarr['0']['favicon'] ?>"></script>

<div id="payment_lean_overlay" style="display: none; opacity: 0.5;"> </div>

<script type="text/javascript">
    function teacher_details()
    {
      $("#myForm").submit();
    }
    function pay_close(){
       $("#payment").hide();     
         $("#payment_lean_overlay").hide();
         $("#lean_overlay").hide();    
    }
      function show_payment_options(){
    // document.getElementById("lean_overlay").style.display = 'none !important';
    $('body').find("#lean_overlay").remove();
    $('body').find("#lean_overlay").remove();
    $('body').find("#lean_overlay").remove();
    $('body').find("#lean_overlay").remove();
    $("#payment_modal").modal('show');
  }
</script> 
<script>
  function getHash()
{
  $("#razorPay").click();return false;
      var course_id = "<?php echo $programs->id; ?>";

      if(course_id)
      {
        var promocode = $("#promocode").val();
        var plan_id = $("#plan_id").val(); 
        var valid_coupon = $("#valid_coupon").val();
        $.ajax({
          url: '<?php echo base_url(); ?>paymentprocess/payUMoney_Process',
          type: 'post',          
          data:{"course_id":course_id,'plan_id':plan_id,'coupencode':promocode,'valid_coupon':valid_coupon},
          beforeSend: function(){
            $('.buy_course_btn').hide();
            $('#buy_loader').show();

          },
          success: function(data) {
            // alert(data);return false;
            console.log(data);
             $('.buy_course_btn').show();
            $('#buy_loader').hide();
            var responseData = JSON.parse(data);
            console.log('rrrrrr:');
            console.log(responseData.data);
            if(responseData.status = "200")
            { 
                 var rrr = responseData.data;
                pay_close();
                launchBOLT(rrr);
            }
            else
            {
              if(data == 'expired'){
                window.location.reload();
              }
            }
          }
        });
    }
    else
    {
      alert("sorry,Something wnet wrong");
    }
}
</script>

<script type="text/javascript">
function launchBOLT(responseData)
{
    console.log('launchBOLT:res:');

console.log(responseData);
  bolt.launch({
  key: responseData.key,
  txnid: responseData.txnid, 
  hash: responseData.hash,
  amount: responseData.amount,
  firstname: responseData.fname,
  email: responseData.email,
  phone: responseData.mobile,
  productinfo: responseData.pinfo,
  udf5: responseData.udf5,
  surl : responseData.surl,
  furl: responseData.surl,
  mode: 'dropout' 
},{ responseHandler: function(BOLT){
  // $(document).find('.brandlogo').remove();
  // console.log( BOLT.response.txnStatus );   
  if(BOLT.response.txnStatus != 'CANCEL')
  {
    alert(BOLT.response);
    console.log(BOLT.response);
    //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
    // var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
    // '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
    // '<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
    // '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
    // '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
    // '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
    // '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
    // '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
    // '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
    // '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
    // '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
    // '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
    // '</form>';
    // var form = jQuery(fr);
    // jQuery('body').append(form);                
    // form.submit();
  }
},
  catchException: function(BOLT){
    alert( BOLT.message );
  }
});
}
</script>
<script>
function showodiv(j,ps)
{
  
  var price = j;  

  document.getElementById("plan_id").value = price; //.toFixed(2); //returns 2489.82
  $("#pricerate1").html(ps);
  //document.getElementById("pricerate2").value = ps;
  document.getElementById("conf_purchase").style.display = 'block';
  document.getElementById("subs_option").style.display = 'none';
}
</script> 
<script>
function showprev()
{
  
  
  document.getElementById("conf_purchase").style.display = 'none';
  document.getElementById("subs_option").style.display = 'block';
}
</script> 
<script>
/*function showdiv()
{
  document.getElementById('payment').style.display = 'block';
}*/
 function showdiv(i){
       
    /* if(i == 1)
     {
               
      document.getElementById("payment").style.display = 'block';
      document.getElementById("subs_option").style.display == 'block';
      document.getElementById("conf_purchase").style.display == 'none';
     }
     if(i == 0)
     {
      document.getElementById("conf_purchase").style.display == 'block';
      document.getElementById("subs_option").style.display == 'none';
     } */
     
     if(i == 1)
     {
       if (document.getElementById("payment").style.display == 'block') {
           document.getElementById("payment").style.display = 'none';
       }
       else{
           document.getElementById("payment").style.display = 'block';
           document.getElementById("subs_option").style.display = 'block';
           document.getElementById("conf_purchase").style.display = 'none';

       }
       
       
       if (document.getElementById("payment_lean_overlay").style.display == 'block') {
           document.getElementById("payment_lean_overlay").style.display = 'none';
       }else{
           document.getElementById("payment_lean_overlay").style.display = 'block';
       } 
     }
     
     if(i == 0)
     {
       if (document.getElementById("payment").style.display == 'block') {
           document.getElementById("payment").style.display = 'none';
       }
       else{
           document.getElementById("payment").style.display = 'block';
           document.getElementById("subs_option").style.display = 'none';
           document.getElementById("conf_purchase").style.display = 'block';

       }
       
       
       if (document.getElementById("payment_lean_overlay").style.display == 'block') {
           document.getElementById("payment_lean_overlay").style.display = 'none';
       }else{
           document.getElementById("payment_lean_overlay").style.display = 'block';
       } 
     }
}
</script> 
<script>
function showfixdiv(){
     
    
       if (document.getElementById("payment").style.display == 'block') {
           document.getElementById("payment").style.display = 'none';
       }
       else{
           document.getElementById("payment").style.display = 'block';
           document.getElementById("subs_option").style.display = 'none';
           document.getElementById("conf_purchase").style.display = 'block';

       }
       
       
       if (document.getElementById("payment_lean_overlay").style.display == 'block') {
           document.getElementById("payment_lean_overlay").style.display = 'none';
       }else{
           document.getElementById("payment_lean_overlay").style.display = 'block';
       } 
}
</script> 
<script type="text/javascript">
function close_enroll(){
        $("#enroll").hide();    
        $("#enrollend").hide();   
        $("#enroll_lean_overlay").hide();
        $("#lean_overlay").hide();  
        
}
</script> 
<div id="enroll"  style="display: none; position: fixed; opacity: 1; z-index: 999999; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct">
    <?php $attributes = array('class' => 'tform', 'id' => 'enroll_form');
   echo form_open_multipart(base_url().'programs/enroll/'.$programs->id, $attributes); ?>
  <!--   <h3 class="general-heading">Enroll</h3> -->
    <a class="enroll_modal_close" href="#" onclick="close_enroll()"><span class="lnr lnr-cross"></span></a>
    <!-- pay_main_cont -->
    <div class="">
      <div class="tab-content enroll_title">
        <p>Do You Want to Enroll?</p>
        <input class="btn-primary_red enroll_btn" type="submit" name="" value="Enroll Now" />
      </div>
    </div>
    <?php echo form_close();  ?> </div>
</div>
<!--Enrollend Pop-up-->
<div id="enrollend"  style="display: none; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;">
  <div id="payment-ct">
   
    <h3 class="general-heading">Enroll</h3>
    <a class="enroll_modal_close" href="#" onclick="close_enroll()"><i class="entypo-cancel-squared"></i></a>
    <div class="pay_main_cont">
      <div class="tab-content">
        <p>Sorry! Enrolled Process has been Completed</p>  
      </div>
    </div>
    </div>
</div>
<style type="text/css">
  .fixed_price_details span#pricerate11.pricerate2 {
    color: #1eda85 !important;
    font-weight: 600 !important;
    font-size: 18px !important;
}
</style>
<div id="enroll_lean_overlay" style="display: none; opacity: 0.5;"> </div>
  <div class="buy_fixed">
    <div class="col-xs-3 fixed_price_details">
      <div class="price" id="price_block">
        <span id="pricerate21" class="pricerate2"></span>
        
        <span id="pricerate11" class="pricerate2"><?php echo $pricerate2; ?> </span>
      </div>
      <div class="price fixed_price_off">
        <span class="price2"> <span class="delprice" style="color: #EA939C;"><?php echo $price2; ?></span>
        </span>
      </div>
      <div class="price fixed_percent_off nextcutoff">
        <span class="price2"> 
        <span class="per_off"> <?php echo round((intval($programs->demoprice) > 0 ? $strr[0] : '100')); ?></span>% off</span>
      </div>
    </div>
    <div class="col-xs-9 fixed_price_button">
      <a class="btn btn-lg btn-primary btn-block buy_course_btn" type="button" <?php echo $buy_links; ?>><i class="entypo-book" style="color:#FFFFFF; margin-right:10px;"></i><?php /*if(intval($programs->fixedrate) > 0) {*/ echo $btn_msg;/*} else { echo "Enroll Now";} */ ?></a>
    </div>
  </div>
<script>
  function showmsg()
  {
    alert('your Enrollment is Block');
  }

  function autoEnroll()
  {
        // e.preventDefault();
        $(document).find("#enroll_form").submit();
        window.location.replace("<?php echo base_url() ?>lessons/lesson/195/886/5452");

  }
  function showEnrolldiv()
  {
    if (document.getElementById("enroll").style.display == 'block') {
               document.getElementById("enroll").style.display = 'none'
       }else{
               document.getElementById("enroll").style.display = 'block'
       }
     
     if (document.getElementById("enroll_lean_overlay").style.display == 'block') {
               document.getElementById("enroll_lean_overlay").style.display = 'none'
       }else{
               document.getElementById("enroll_lean_overlay").style.display = 'block'
       }
  }

   function showEnrollnotify()
  {
    if (document.getElementById("enrollend").style.display == 'block') {
               document.getElementById("enrollend").style.display = 'none'
       }else{
               document.getElementById("enrollend").style.display = 'block'
       }
     
     if (document.getElementById("enroll_lean_overlay").style.display == 'block') {
               document.getElementById("enroll_lean_overlay").style.display = 'none'
       }else{
               document.getElementById("enroll_lean_overlay").style.display = 'block'
       }
  
  }

</script>
<script>
$('#myCarousel').carousel({
  interval: 4000
});

$('.carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }

    next.children(':first-child').clone().appendTo($(this));
  }
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
   jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
var $ =jQuery.noConflict();


$(document).ready(function(){
    // var viewdesc = 
    var data_len = $("#viewmore").text().length;
      if(data_len > 300){
           var data = $("#viewmore").find("p:first").text();
           $("#desc_txt").html(data);
           $("#desc_txt").show();
 

          var str = $("#viewmore").find("p:first").html();
          str += "<br>";
            str += $("#viewmore").find("p:last").html();

           $("#viewdesc").html(str);
        $("#showview").show();
    }
    else{
            var data = $("#viewmore").text();
           $("#viewdesc").html(data);
          $("#showview").hide();
    }
});
   // $('.viewmore').show();

   
    $("#showview").click(function(){
       var data = $("#viewmore").html();
           $("#viewdesc").html(data);
           $(this).hide();
});

     $(document).ready(function () {
    $('.sub_modal_close').click(function() {
        $("#payment").hide();     
        $("#payment_lean_overlay").hide();      
        
     });
});

     $(document).ready(function(){

  $(document).ready(function() {
   $('.hidecompaire').hide();
});

   
    $("#compairing").click(function(){
        $(".hidecompaire").show();

           $(this).hide();
    });
});

$(document).ready(function(){

  $(document).ready(function() {
   $('.intruct_hide').hide();
});

   
    $("#instruct").click(function(){
        $(".intruct_hide").show();

           $(this).hide();
    });
});

$(document).ready(function(){

  $(document).ready(function() {
   $('.showtext').hide();
});

   
    $("#show").click(function(){
        // $(".showtext").show();
        $('.l_points').height('');
           $(this).hide();
    });
});

$(document).ready(function(){

    $("#btn_rev").click(function(){
    var start = $('.review_limit').val();
    var pro_id = $('.pro_id').val();
    var num_rev = $('.num_rev').val();
    // alert(start);return false;
         $.ajax({
          cache:false,
    url: "<?php echo base_url();?>programs/getReview",
            type: "POST",

        data: {start: start, pro_id: pro_id},
         beforeSend: function(){
          $(document).find('#btn_rev').hide();
           $("#loader").show();
         },
        success: function(data) { 
          $("#loader").hide();
          if(data){
            $(document).find('#rev_list').append(data);
            var new_count = parseInt(num_rev) - parseInt(start);
            $(document).find('.num_rev').val(new_count);
            if(new_count <= 4)
            {
               $(document).find('.cust_review_btn').hide();
            }
            else{
              $(document).find('.cust_review_btn').show();
                         $("#loader").hide();

              if(start == 4)
                 $(document).find('.review_limit').val('5');
              else  $(document).find('.review_limit').val(parseInt(start)+4);
            }
          }
        }
      });

          
    });
});


 $(document).ready(function () {
    $('.preview_modal_close').click(function() {
        $("#preview").hide();     
        $("#preview_lean_overlay").hide();      
        
     });
});
 $(document).ready(function () {
    
        $("#status").show();      
        $("#status_lean_overlay").show();     
        
     
});
$(document).ready(function () {
    $('.status_modal_close').click(function() {
        $("#status").hide();      
        $("#status_lean_overlay").hide();     
        
     });
});

$(document).ready(function(){

  $(document).ready(function() {
   $('.hidecompaire').hide();
});

   
    $("#show").click(function(){
        $(".hidecompaire").show();
         $(this).hide();
    });
});

</script>

<script>
  $(document).ready(function(){
    // carousel_right();
    carousel_right1();
  });
  
 /* $(document).on('click', '.carousel-control_right', function(){
    carousel_right();
  });

function carousel_right(){
    var tech_id = $('#techid').val();
    var start = $('.startlimit').val();
   var chk = $(this).is('.left');
    if(chk == true){
    if(start > 0){
     start = parseInt(start) -8;
   }

   }
  
    
     $.ajax({

    url: "<?php echo base_url();?>category/getAuthSlider",
            type: "POST",

        data: {start: start, techid: tech_id},
        success: function(data) { 
          if(data){
             $('.carousel-control').parent().parent().parent().find('.carousel-inner').find('.active').removeClass('active');

             $('.carousel-control').parent().parent().parent().find('.carousel-inner').find('.startlimit').remove();
          // ('.dynamic_slide')
          $('.carousel-control').parent().parent().parent().find('.carousel-inner').append(data);
        }
        },
      });
 };
*/

$(document).on('click', '.btnappend', function(){
    carousel_right1();
  });

function carousel_right1(){
    var tech_id = $('#techid').val();
    var start = $('#startlimit1').val();
    var course_id = $('#course_id').val();
    $.ajax({
    url: "<?php echo base_url();?>category/getcourses",
            type: "POST",
        data: {start: start, techid: tech_id, course_id: course_id},
        success: function(data) { 
          if(data){
            var obj = $.parseJSON(data);
            $("#load_data").append(obj.output);
            // $("#startlimit").removeAttr('id');
            start = parseInt(start)+parseInt(4);
            $("#startlimit1").val(start);
            $("#totalc").val(obj.totalc);
            // $(".cardhover").css('height','149px');
            // $(".cardhover").css('overflow','hidden');
            if(parseInt(start)>=parseInt(obj.totalc))
            {
              $(".btnappend").fadeOut();
            }
          }
        },
      });
 };

</script>

<script>
  $(document).on('click', '.btnappend1', function(){

     var tech_id = $('#techid').val();
     // alert(tech_id);
      $.ajax({

    url: "<?php echo base_url();?>category/getMore",
            type: "POST",

        data: {techid: tech_id},
        success: function(data) { 
          if(data){
            // console.log(data);
            $('.load-more-btn').parent().parent().find('.inner_responsive_slider').append(data);

            $('.load-more-btn').hide();
          }
        },

  });
});
</script>
<script>
function showhidecode()
{
    $('#promo_code').show();
    $('#hv_coupon').css('display','none');
}

  function promoApply()
  {
       var promocode = $("#promocode").val();
       var course_id = $("#course_id").val(); 
       var plan_id = $("#plan_id").val();         

       if(promocode)
       {
        $("#promo_waitt").css("display","block");
        $("#btn_redeem").css("display","none");
       $.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>programs/promoCodeApply",
            data    : {'promocode':promocode,'course_id':course_id,'plan_id':plan_id},
 
          success: function(data)
          {  
                   // alert(data);
                    console.log(data);
                    if(data === "already enrolled")
                    {
                      $("#promoMSg").html('You are Already enrolled for this course.');
                      $("#promoMSg").css("color","red");
                      setTimeout(function () {
                          $("#promoMSg").html("");
                       }, 3000);
                      $("#promo_waitt").css("display","none");
                      $("#btn_redeem").css("display","block");
                    }
                    else if(data.indexOf("lectures")!= -1)
                    {
                      var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>Congratulation! You are successfully Enrolled.</div>';
                      var note = $(document).find('#message1');
                      note.html(str);
                      note.show();
                      note.fadeIn().delay(2000).fadeOut();
                      // setCookies('nr',data);
                      window.location.href = "<?php echo base_url();?>thank_you/";
                    }
                    else if(data == "Unused")
                    {
                       // $("#go").attr("href","#signup").click();
                       $('#registration, #registerPopup').css({
                          "display": "block"
                      });
                       $("#dup_redeem").val(promocode);
                       $("#dup_redeem1").val(promocode);
                       // $("body").css("overflow","visible");
                       $("ul.nav.navbar-nav div#lean_overlay").show();
                       $("#promo_waitt").css("display","none");
                       $("#btn_redeem").css("display","block");
                       // $("div.res_overlay").css("opacity","0.4");
                    }
                    else if(data == "Redeemed")
                    {
                      $("#promoMSg").html('This Redeem code is already used.');
                      $("#promoMSg").css("color","red");
                      setTimeout(function () {
                          $("#promoMSg").html("");
                       }, 3000);
                      $("#promo_waitt").css("display","none");
                      $("#btn_redeem").css("display","block");
                    }
                    else if(data == "Failed")
                    {
                      $("#promoMSg").html('The coupon code entered is not valid for this course. Perhaps you used the wrong coupon code?');
                      $("#promoMSg").css("color","red");
                      setTimeout(function () {
                          $("#promoMSg").html("");
                       }, 3000);
                      $("#promo_waitt").css("display","none");
                      $("#btn_redeem").css("display","block");
                      // document.getElementById("go").click();
                     
                    }
                    else
                    {
                        var org = $('#pricerate1').text();
                         org_cost = org.split('.');
                       org_cost = parseInt(org_cost[0].replace(/[^0-9]/g,''));
                       console.log(org_cost);
                       $("#coupencode_paypal").val(promocode);
                       $("#coupencode_payU").val(promocode);
                       $("#pricerate1").addClass("strikediag");
                       $(".strikespan").html('<?php echo $currency_symbol;?>'+org_cost).addClass("strikediag");
                       $("#pricerate1").attr('style','font-size: 20px;');
                       $("#pricerate1").removeClass("pricerate2 current_price");
                       $("#pricerate1").addClass("pricerate1");  
                       $("#pricerate2").addClass("current_price");  

                       // mobile responsive
                       $("#pricerate11").addClass("strikediag");
                       $("#pricerate11").attr('style','font-size: 15px;');
                       $("#pricerate21").attr('style','font-size: 18px;');
                       $("#pricerate11").removeClass("pricerate2 current_price");
                       $("#pricerate11").addClass("pricerate1");  
                       $("#pricerate21").addClass("current_price"); 
                      // str_split((($programs->fixedrate/$programs->demoprice)*100), 5);
                      var delprice = $('.delprice').html();
                      if(delprice){
                        delpr_amt = delprice.split('.');
                        delpr = parseInt(delpr_amt[0].replace(/[^0-9]/g,''));
                        var cut_amt = parseInt(delpr) - parseInt(Math.round(data));
                        var dis = Math.round((parseInt(cut_amt)*100/parseInt(delpr)));

                      } else{ 
                        var cut_amt = parseInt(org_cost) - parseInt(Math.round(data));
                        var dis = Math.round((parseInt(cut_amt)*100/parseInt(org_cost)));
                      }
                       // var old_dis = $('.per_off').html();
                      if($('.per_off').length){
                         $('.per_off').html(dis);
                     } else {
                        $(document).find('#price_block').append('<span class="price2"><span class="per_off">'+dis+'</span>% off</span>');
                     }
                       $("#pricerate2").html('<?php echo $currency_symbol;?>'+Math.round(data));
                       $(".r_amt_span").html(' <?php echo $currency_symbol;?> '+Math.round(data));
                       $("#merchant_total").val(parseInt(Math.round(data))*100);
                       $("#merchant_amount").val(Math.round(data));
                       $("#pricerate21").html('<?php echo $currency_symbol;?> '+Math.round(data)+'<br>');

                       $("#promoapply").attr("disabled",true);
                       $("#promoMSg").css("color","green");
                       $("#promoMSg").html('Coupon code applied');
                      setTimeout(function(){ $("#promoMSg").html("");},2000);
                       $("#promo_waitt").css("display","none");
                       $("#btn_redeem").css("display","block");
                       // $("#btn_redeem").attr("disabled",true);
                       $("#btn_redeem").removeAttr("onclick");
                       $("#valid_coupon").val("Yes");

                      $("#btn_redeem").html('<i class="fa fa-times"></i>');
                      $("#btn_redeem").removeClass('btn-success');
                      $("#btn_redeem").addClass('btn-danger');
                      $("#btn_redeem").attr('onclick',"return cancelPromo()");
                      $("#btn_redeem").attr('id',"btn_redeem1");
                    }
               }
            });
       }
       else
       {
        $("#promoMSg").html("Please enter coupon code here");
        setTimeout(function () {
            $("#promoMSg").html("");
         }, 3000);
        $("#promoMSg").css("color","red");
       }

      }

  function cancelPromo()
  {
      $("#promocode").val('');
      $("#btn_redeem1").html('Apply');
      $("#btn_redeem1").removeClass('btn-danger');
      $("#btn_redeem1").addClass('btn-success');
      $("#btn_redeem1").removeAttr('onclick');
      $("#btn_redeem1").attr('onclick',"return promoApply()");
      $("#btn_redeem1").attr('id',"btn_redeem");
// offper
      var dis = $("#offper").val();
      $(document).find('.price2 .per_off').html(dis);

      $("#pricerate1").removeClass("strikediag");
      $("#pricerate1").removeAttr('style');
      $("#pricerate1").addClass("pricerate2 current_price");
      $("#pricerate1").removeClass("pricerate1");  
      $("#pricerate2").removeClass("current_price");
      $("#pricerate2").html('');

      $("#pricerate11").removeClass("strikediag");
      $("#pricerate11").removeAttr('style');
      $("#pricerate11").addClass("pricerate2 current_price");
      $("#pricerate11").removeClass("pricerate1");  
      $("#pricerate21").removeClass("current_price");
      $("#pricerate21").html('');

  }
</script>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}

var acc1 = document.getElementsByClassName("accordion1");
var j;

for (j = 0; j < acc1.length; j++) {
  acc1[j].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
<script>
  function ajax_addwishlist(pro_id, type)
  { 
        var  dataString = pro_id;       
      
        $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>programs/add_wishlist",
            data    : {'pro_id':dataString, 'type': type},
 
      success: function(data){
        if(type == 2){
          var text = '<a class=" btn btn-lg btn-primary btn-block remove_card_btn" type="button" onclick="ajax_deletewishlist('+pro_id+','+data+','+type+')" >Remove Cart</a>';

          $("#card_div").html(text);
          $num = parseInt($(document).find('#cart_info').text()) + 1;
          $(document).find('#cart_info').text($num);
        }
        // $("#wishlist").html(data); 
      } 
      }); 
  }
</script> 
<script>
  function ajax_deletewishlist(pro_id,wishlist_id,type)
  {   
        
      
        $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>programs/delete_wishlist",
      data: {'wishlist_id':wishlist_id,'pro_id':pro_id,'type':type},
      success: function(data){
      if(type == 2){
          var text = '<a class=" btn btn-lg btn-primary btn-block add_card_btn" type="button" onclick="ajax_addwishlist('+pro_id+','+type+')" >Add to Cart</a>';

          $("#card_div").html(text);
          $num = parseInt($(document).find('#cart_info').text()) - 1;
          if($num < 0) $num = 0;
          $(document).find('#cart_info').text($num);
        }
        // $("#wishlist").html(data); 
      }
      });
    }
</script> 
<script>
jQuery(document).ready(function(){
    jQuery("#expandall11").click(function(){
      // alert(1);
        for (i = 0; i < acc.length; i++) {
  // acc[i].addEventListener("click", function() {
    acc[i].classList.toggle("active");
    var panel = acc[i].nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  // });
}
        // jQuery(".panel").toggleClass("expand_height");
    });
     jQuery("button.accordion").click(function(){
     
        jQuery(".panel").removeClass("expand_height");
    });


     var width = jQuery(window).width();
     if (width < 768){

      var buy_fixed_bottom = jQuery(".buy_fixed").height();
      var buy_fixed_bottom_height = buy_fixed_bottom + parseInt(20);
      jQuery("body").css("padding-bottom", buy_fixed_bottom_height );

    }

});
</script>
<script type="text/javascript">
$(document).ready(function(){
    var a = $("#directpayer").html();
    if(a == "true")
    {
      if($("#pricerate1").html() == "Free")
      {
        showEnrolldiv();
      }
      else{
        /*
        var user_id = "<?php if($sessionarray) echo $sessionarray['id'];?>";
        if(user_id == 2290){
          show_payment_options();
        }else{*/
          getHash();
        // }
      }
    }
    var demo_cookie = $("#demo_cookie").html();
    // alert(demo_cookie);
    if(demo_cookie != '')
    {
      setCookie('referral_code',demo_cookie,7);
    }
});
function direct_pay(){
  var last_url = $("#slug_url").attr('href');
  $.ajax({
      type: "post",
      cache : false,
      url : "<?php echo base_url();?>programs/set_direct_pay",
      data : {
        directpay : "true",
        last_url : last_url
      },
      success : function(response)
      {
        console.log(response);
      }
  });
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";secure=true;path=/";
}


$(document).ready(function(){
  // modalbtn
  setTimeout(function(){$("#guideVideo").modal("show");},60000);
});
</script>
 <style type="text/css">
  @media  only screen and (min-width: 768px){
    #guideVideo .modal-dialog {
      width: 500px;
    }
    .support-video {
        margin: 20px auto;
        display: flex;
        width: 425px;
        height: 225px;
    }
  }
  @media (max-width: 960px){
    div#guide_vdo{
      display: none;
    }
    #guideVideo .modal-dialog {
      margin-top: 25%;
    }
  }
  @media (min-width: 961px){
    .play-button{
      height: 17%;
    }
  }
  @media (max-width: 767px){
    .support-video{
      width: 100%;
      height: 170px;
    }
    #guideVideo .modal-dialog {
      margin-top: 35%;
    }
  }
  #guideVideo button.close{
    position: unset !important;
    color: #7d7d7d;
  }
  #guideVideo .modal-dialog .modal-content{
    border-radius: 10px;
  }
  #guideVideo .modal-dialog .modal-content .modal-header {
      padding: 15px 15px 0 0;
      border-bottom: 0;
  }
  #guideVideo .modal-dialog .modal-content .modal-body h5.modal-title{
    padding: 0px 25px 15px 25px;
    text-align: center;
  }
  #guideVideo .modal-dialog .modal-content .modal-body{
    padding: 0 15px 10px 15px;
  }
  </style>
  <div class="modal fade" id="guideVideo" role="dialog" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5 class="modal-title">If you have any doubts about how to get and access this course, watch this video.</h5>
          <iframe class="support-video" src="https://www.youtube.com/embed/JFYkfAXerjY" allow="accelerometer; encrypted-media; gyroscope;" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div>


<style type="text/css">
  @media (min-width: 961px){
    .play-button{
      height: 17%;
    }
  }
  @media (max-width: 960px){
    #stripe div div.col-xs-12{
      margin-top: 2%;
    }
  }
  @media (max-width: 640px){
    .paytext_mb{
      text-align: left;
      width: 100%;
    }
  }
  #stripe div a.add_card_btn{
    width: 100%;
    margin-left: 0 !important;
    border-bottom: 0px !important;
  }
  .message_err{
    color: red;
    font-weight: bold;
  }
  .success_msg{
    color: green;
    font-weight: bold;
  }
/* MAIN */
/* =============================================== */
.rad-label {
  align-items: center;
  border-radius: 100px;
  cursor: pointer;
  transition: .3s;
}
.rad-label:hover, .rad-label:focus-within {
  background: hsla(0, 0%, 80%, .14);
}
.rad-input {
  position: absolute;
  left: 0;
  top: 0;
  width: 1px;
  height: 1px;
  opacity: 0;
  z-index: -1;
}
.rad-design {
  width: 20px;
  height: 20px;
  border-radius: 100px;
  background: linear-gradient(to right bottom, hsl(153.5, 95.6%, 91.2%), hsl(225, 92.9%, 49.8%));
  position: relative;
}
.rad-design::before {
  content: '';
  display: inline-block;
  width: inherit;
  height: inherit;
  border-radius: inherit;
  background: hsl(0, 0%, 90%);
  transform: scale(1.1);
  transition: .3s;
}
.rad-input:checked+.rad-design::before {
  transform: scale(0);
}
.rad-text {
  color: hsl(0, 0%, 60%);
  margin-left: 14px;
  letter-spacing: 3px;
  text-transform: uppercase;
  font-size: 18px;
  font-weight: 900;
  transition: .3s;
}
.rad-input:checked~.rad-text {
  color: hsl(0, 0%, 40%);
}
/* ABS */
/* ====================================================== */
.abs-site-link {
  position: fixed;
  bottom: 40px;
  left: 20px;
  color: hsla(0, 0%, 0%, .5);
  font-size: 16px;
}
</style>
  <div class="modal fade" id="payment_modal" role="dialog" style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog" style="top: 10% !important">
      <div class="modal-content">
        <div class="modal-header" style="text-align: center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="paytext">
            <span style="font-weight: 900;font-size: 20px;color: #777;">PRICE : </span>
            <span class="strikespan"></span>
            <span style="font-weight: 900;font-size: 20px;color: #777;" class="r_amt_span"><?php 
        if(intval($programs->fixedrate) > 0 && intval($programs->demoprice) > 0){
          echo $currency_symbol.''.number_format($programs->fixedrate);
        }else{echo "FREE";}
      ?></span>
          </div>
        </div>
        <div class="modal-body">
          <div class="row" style="border-bottom: 1px solid #e9e6e6">
            <span id="message11"></span>
            <div class="pay_main_cont">
              <div>
                <ul class="nav nav-tabs bordered">
                  <li class="active"> <a href="#stripe" data-toggle="tab"><span>Payment Options</span></a></li>
                </ul>
              </div>
              <div class="tab-content">
                <div class="tab-pane active" id="stripe" style="padding:10px 0; border:0; ">
                   <?php //$stripe = $this->Crud_model->get_single('mlms_live_credentials',"account = 'stripe'","secrete_key, publish_key, status, mode");
                    $razorpay = $this->Crud_model->get_single('mlms_live_credentials',"account = 'razorpay'","secrete_key, publish_key, status, mode");
                    $publish_key = $this->config->item('publish_key');
                    if(!empty($batches)){
                       /* if($programs->is_plans == 'subscription')
                          $clasns = 'col-sm-6';
                        else
                          $clasns = 'col-sm-12';*/
                  ?>
                  <div style="display: inline-block;width: 100%;">
                    <div class="col-xs-12 col-sm-12 form-group">
                      <h4>Batch <span style="padding-left: 5px;font-size: 13px">(select batch you want to enroll)</span></h4>
                      <select class="form-control" id="batch_id">
                        <option value="">-- select Batch --</option>
                        <?php foreach ($batches as $batch) { ?>
                        <option value="<?php echo $batch->id;?>" <?php if(!empty($subscribed_batch_id)){if($subscribed_batch_id == $batch->id){echo 'selected';}} ?>><?php echo ucwords($batch->batch_name).' &nbsp; ( '.date('h:i A',strtotime($batch->batch_start_time)).' - '.date('h:i A',strtotime($batch->batch_end_time)).' )'; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                    <?php if($programs->is_plans == 'subscription' && !empty($program_plans)){ ?>
                    <div class="col-xs-12 col-sm-12 form-group">
                      <table class="table table-hover" style="margin-bottom:0;">
                        <thead class="bg-green">
                          <tr>
                            <th class="downgrade-title light-blue-border"><input type="checkbox" disabled="disabled"></th>
                            <th class="downgrade-title light-blue-border">Plans</th>
                            <th class="downgrade-title light-blue-border">Validity</th>
                            <th class="downgrade-title light-blue-border">Price</th>
                          </tr>
                        </thead>
                        <tbody id="upgrade_body2">
                          <?php foreach ($program_plans as $plans){ ?>
                          <tr class="radient_tr">
                            <td class="table-first-row light-blue-border">
                              <label class="rad-label">
                                <input type="radio" class="rad-input" name="rad" id="plan_<?php echo $plans->id;?>" value="<?php echo $plans->id;?>" <?php if($subscription_plan_id == $plans->id)echo 'checked';?> data-price='<?php echo $plans->price;?>'>
                                <div class="rad-design"></div>
                              </label>
                            </td>
                            <td class="table-first-row light-blue-border"><?php echo ucwords($plans->name);?></td>
                            <td class="table-first-row light-blue-border"><?php echo $plans->term.' '.ucwords($plans->period);?></td>
                            <td class="table-first-row light-blue-border"><i class="fa fa-inr"></i> <?php echo $plans->price;?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <?php } ?>
                  </div>
                  <?php }else{ ?>
                    <input type="hidden" id="batch_id" value="">
                  <?php } ?>
                  <div style="display: inline-block;width: 100%;">
                    <?php /*if($stripe->status == 'active' && $stripe->mode == 'live'){
                          $publish_key = $stripe->publish_key;  //}
                      ?>
                    <input type="hidden" id="publish_key" value="<?php echo $publish_key;?>">
                    <div class="col-xs-12 col-sm-4">
                      <a type="button" class="btn btn-lg btn-primary add_card_btn" id="stripe_pay">Pay with Stripe</a>
                    </div>
                  <?php }*/ //if($razorpay->status == 'active' && $razorpay->mode == 'live'){ 
                  if(intval($programs->fixedrate) > 0 && intval($programs->demoprice) > 0){
                  ?>
                    <div class="col-xs-12 col-sm-4">
                      <a type="button" class="btn btn-lg btn-primary add_card_btn" id="razorPay">Pay with RazorPay</a>
                    </div>
                  <?php //}
                  }else{ ?>
                    <div class="col-xs-12 col-sm-4">
                      <a type="button" class="btn btn-lg btn-primary add_card_btn" id="free_trials" onclick="showEnrolldiv();" href="javascript:void(0);">Enroll Now</a>
                    </div>
                <?php } ?>
                  </div>

                  <div style="color: #262626;font-size: 13px;margin-top: 10px"> once you click on button, please wait while we load the payment Gateway and then sent back once you complete your purchase. </div>
                  <div style="color: #262626;font-size: 13px;margin-top: 10px"> By clicking the "Pay" button, you agree to these <a href="#" target="_blank"><b>Terms of Service</b></a>. </div>
                  <div style="color: #262626;font-size: 13px;text-align: center;margin-top: 10px;"> <a href="#"><i class="entypo-lock-open"></i>Secure Connection</a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $CI->load->view('new_template_design/footer');

if(!empty($user_id)){
    $user = $this->Crud_model->get_single('mlms_users',"id = ".$user_id,'email,mobile,first_name,last_name');
    $pname = $user->first_name.' '.$user->last_name;
    $u_email = $user->email;
    $u_mobile = $user->mobile;
    // $fixedrate = 1;
$description        = "Product Description";
$txnid              = date("ymdHis");     
$key_id             = $this->config->item('keyId');
$currency_code      = "INR";            
$total              = intval(1) * 100; // 100 = 1 indian rupees
$amount             = 1;
$merchant_order_id  = "TXN-".$txnid;
$card_holder_name   = ucwords(trim($pname));
$email              = $u_email;
$phone              = $u_mobile;
$name               = "MYOnlineShiksha";
$callback_url       = base_url().'paymentprocess/callback';
$surl               = base_url().'paymentprocess/razor_success';
$furl               = base_url().'paymentprocess/razor_failed';
// if($stripe->status == 'active' && $stripe->mode == 'live'){
?>

<!-- razorpay form starts here -->
<form name="razorpay-form" id="razorpay-form" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
  <input type="hidden" name="currency_code" id="currency_code" value="<?php echo $currency_code; ?>"/>
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

$('.rad-design').click(function () {
	$('.radient_tr').each(function() {
		$(this).css('background','none');
	});
	$(this).parent().parent().parent().css('background',"#dedede");           
});

var razorpay_pay_btn, instance;
$(document).on('click', '#razorPay', function (e) {
  var batch_id = $("#batch_id").val();
  var promocode = $("#promocode").val();
  var valid_coupon = $("#valid_coupon").val();
  // console.log(promocode+" "+valid_coupon);return false;
      var is_live_class = '<?php echo $programs->is_live_class;?>';
      if(is_live_class == 1 && batch_id == ''){
          $("#message11").html('Please select batch.').fadeIn("slow").removeAttr('class').addClass('message_err');
          setTimeout(function(){
            $("#message11").html("");
          },3000);
          $("#batch_id").focus();
          return false;
      }
      var plan_id = $('input[name="rad"]:checked').val();
      var data_price = $('input[name="rad"]:checked').attr('data-price');
      jQuery('form#razorpay-form').find('input#merchant_total').val(parseInt(data_price) * 100);
      jQuery('form#razorpay-form').find('input#merchant_amount').val(data_price);
      $('.r_amt_span').html("<i class='fa fa-inr'></i> "+data_price);

  	$(this).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span style="padding-left:10px;">Please wait...</span>');
  	var merchant_order_id = jQuery('form#razorpay-form').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-form').find('input#merchant_surl_id').val();
    var merchant_furl_id = jQuery('form#razorpay-form').find('input#merchant_furl_id').val();
    var card_holder_name_id = jQuery('form#razorpay-form').find('input#card_holder_name_id').val();
    var merchant_total = jQuery('form#razorpay-form').find('input#merchant_total').val();
    var merchant_amount = jQuery('form#razorpay-form').find('input#merchant_amount').val();
    var currency_code = jQuery('form#razorpay-form').find('input#currency_code').val();
    var user_id = '<?php echo $user_id;?>';
    var course_id = '<?php echo $programs->id;?>';
    var options = {
        key:            "<?php echo $key_id; ?>",
        amount:         merchant_total,
        name:           "<?php echo $name; ?>",
        description:    merchant_order_id,
        netbanking:     true,
        currency:       currency_code, // INR
        image:      '<?php echo base_url();?>public/uploads/settings/img/logo/4937_02-12-2019.png',
        prefill: {
            name:       card_holder_name_id,
            email:      "<?php echo $email; ?>",
            // contact:    "<?php echo $phone; ?>"
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
            /*document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
            document.getElementById('razorpay-form').submit();*/
            $.ajax({
                url:'<?php echo $callback_url;?>',
                type: 'post',
                cache : false,
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code: currency_code, user_id: user_id, course_id: course_id, batch_id: batch_id, promocode: promocode,valid_coupon: valid_coupon, plan_id : plan_id},
                dataType: 'json',
                success: function (res){
                    $('#razorPay').html('Pay with Razorpay');
                    if(res.msg){
                        $("#message11").html(res.msg).fadeIn("slow").removeAttr('class').addClass('message_err');
                    setTimeout(function(){
                  $("#message11").html('');
            },3000);
                        return false;
                    }else{
            $.ajax({
                  type: "post",
                  cache : false,
                  url : res.redirectURL,
                  data:"",
                  success : function(response){
                    if(response == 1){
                            $("#message11").html('Enrolled Successfully.').fadeIn("slow").removeAttr('class').addClass('success_msg');
                            setTimeout(function(){
                        $("#message11").html('');
                        window.location.href = "<?php echo base_url().$programs->slug.'/lectures/';?>"+course_id;
                  },2000);
                          }else{
                      $("#message11").html('Payment processing Failed. try again after some time.').fadeIn("slow").removeAttr('class').addClass('message_err');
                      setTimeout(function(){
                        $("#message11").html('');
                              // window.location.href = res.redirectURL;
                  },2500);
                    }
                  }
                });
                    }
                },
                failure : function(res)
                {
                  $("#message11").html('ERROR : '+res).fadeIn("slow").removeAttr('class').addClass('message_err');
                setTimeout(function(){
                $("#message11").html('');
          },2500);
                }
            });
        },
        "modal": {
            "ondismiss": function(){
                // location.reload();
                $('#razorPay').html('Pay with Razorpay');
            }
        }
    };
  instance = new Razorpay(options);
    $.ajax({
      type: "get",
      cache : false,
      url : "<?php echo base_url();?>paymentprocess/check_login",
      data:"",
      success : function(data){
        if(data == 1){
          instance.open();
        }else{
          $("#message11").html('Session expired. please login again.').fadeIn("slow").removeAttr('class').addClass('message_err');
        setTimeout(function(){
          location.reload();
        },2500);
        }
      }
    });
    e.preventDefault();
  });
    /*function razorpaySubmit(el) {
        if(typeof Razorpay == 'undefined') {
            setTimeout(razorpaySubmit, 200);
            if(!razorpay_pay_btn && el) {
                razorpay_pay_btn    = el;
                el.disabled         = true;
                el.value            = 'Please wait...';  
            }
        } else {
            if(!instance) {
                instance = new Razorpay(options);
                if(razorpay_pay_btn) {
                razorpay_pay_btn.disabled   = false;
                razorpay_pay_btn.value      = "Pay Now";
                }
            }
            instance.open();
        }
    }*/  
</script>
<?php } ?>
</body>
</html>