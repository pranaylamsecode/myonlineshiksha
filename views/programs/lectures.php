<?php 

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

}	

$CI = & get_instance();

$CI->load->model('program_model');



//$timezone = new DateTimeZone($configarr[0]['time_zone']);	

// date_default_timezone_set($configarr[0]['time_zone']);

// echo date_default_timezone_get();

		$date = new DateTime();



		//$date->setTimezone($timezone);		

		$currdate1 = $date->format( 'Y-m-d' );					

		$currtime1 = $date->format( 'h:i' );		

		$currdateandtime = $date->format( 'Y-m-d h:ia' );	

		$today_formatted = $date->format('Y-m-d H:i');  

// echo $today_formatted;



// $configarr = $this->settings_model->getItems();	

// $tz = $configarr[0]['time_zone'];

// $tz_obj = new DateTimeZone($tz);

// $today = new DateTime("now", $tz_obj);

// echo gmdate('Y-m-d', time());

?>

<link rel="stylesheet" type="text/css" href="/public/css/courses_css/dashboard.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style type="text/css">
	.previous_live_tab{
		display: none;
	}
	.btn_current_live_tab, .btn_previous_live_tab{
		cursor: pointer;
		padding: 5px 10px;
		background-color: #EBEBEB;
		color: #000;
		border-radius: 2px;
		font-weight: normal;
	}
	/*accordian*/
	.accordion1 .section_title {
    border: 0px;
    padding: 0px;
    margin-top: -1px;
}
.panel.batch_panel {
    max-height: 0px;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}
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

		.breadcrum_overlay {
			position: absolute;
			height: 100%;
			width: 100%;
			background: rgba(0,0,0,0.3); 
		}
		.write_review a {
			color: #fff;
			font-size: 15px;
			cursor: pointer;
			position: relative;
			z-index: 9;
		}
		.write_review a:hover {
			text-decoration: underline !important;
		}
		.write_review {
			display: inline-block;
			float: left;
			width: 100%;
			margin-top: 5px;
		}
		.lecture_description .revisit_btn {
			background: #2d3b92;
			color: #fff !important;
			padding: 8px 12px;
			border-radius: 50px;
			border: 0px !important;
			cursor: pointer;
		}
		.comment-content .view_notes_btn {
			background: #2d3b92 !important;
			font-size: 14px;
			padding: 8px 15px;
			border: 0px !important;
			color: #fff !important;
		}
		.comment-content .down_notes_btn {
			background: #059549;
			font-size: 14px;
			border: 0px !important;
			color: #fff !important;
			padding: 8px 15px;
		}
		.lecture_description .cattext1:hover, .lecture_description .cattext1:focus {
			background: #f9f9f9 !important;
		}
		.comment-content .down_notes_btn:hover, .comment-content .down_notes_btn:focus {
			background: #00a651;
		}
		.lecture_description .revisit_btn:hover, .comment-content .view_notes_btn:hover, .lecture_description .revisit_btn:focus, .comment-content .view_notes_btn:focus {
			background: #354290 !important;
		}
		hr{
			border-top: 1px solid #e9dede !important; 
		}
		.nav > li > a:hover, .nav > li > a:focus{
			background: none !important;
		}
		.section_title {
			background: #f9f9f9;
			padding: 15px;
			border: solid 1px #E8E9EB;
		}
		#txt_notes{
			height: 45px;
			width: 100%;
			padding: 10px;
			resize: none;
			border: 1px solid #ccc !important;
			color: #666 !important;
		}
		#coursesection #coursesectionlecture .course_cat1 {
			border: 1px solid #EAEAEA;
			border-top: 0px;
			border-bottom: 0px;
			padding-left: 0px;
		}
		#coursesection #coursesectionlecture .cattext1 {
			border: 0px;
			border-bottom: 1px solid #E8E9EB;
			background: #fff;
		}
		.section_label {
			font-size: 15px;
			margin-bottom: 10px;
		}
		.section_name {
			font-size: 18px;
			font-weight: 600;
		}
		#coursesection {
			color: #686F7A !important;
		}
		.ci-progress-container {
			margin-top: 4px;
		}
		#web:hover{
		  cursor: pointer;
		cursor: hand;
		margin-right: 10px !important;
		color: #016ac1;
		}
		.webinar a{
			padding-right: 10%;
		    padding-left: 2%;
		}
		.webinar span{
			padding-right: 12%;
		    padding-left: 4%;
		}
		.container.courses {
			padding-top: 25px;
		}
		.start{
			float: right;
		    margin-top: -20px;
		    color: rgb(255, 255, 255);
		    font-weight: 700;
		    background: rgb(84, 181, 81);
		    font-size: 12px;
		    display: none;
		}
		.lecture_reviews .nav-tabs > li.active {
			border: 0px;
			border-bottom: 2px solid #002157 !important;
		}
		.or {
			display: inline-block;
			text-align: center;
			margin-bottom: 20px;
			width: 100%;
		}
		.responsive_download.btn.btn-info {
			margin: 0 auto;
			display: block;
			padding: 12px 0px;
			font-size: 14px;
			background: #059549;
		}
		.responsive_download.btn.btn-info:hover {
			background: #1e8651;
		}
		.lecture_reviews .nav-tabs li a {
			border: 0px !important;
			color: #686F7A;
			font-size: 14px !important;
		}
		.lecture_reviews .nav-tabs li a span {
			border: 0px !important;
			color: #686F7A;
			font-size: 14px !important;
		}
		.btn-gold {
		  color: #846e20;
		  background-color: #fcd036;
		  border-color: #fcd036;
		}
		.btn-gold:hover, .btn-gold:focus, .btn-gold:active, .btn-gold.active, .open .dropdown-toggle.btn-gold {
		  color: #846e20 !important;
		  background-color: #fbc70e !important;
		  border-color: #f1bc04 !important;
		}
		.btn {
		  display: inline-block;
		  margin-bottom: 0;
		  font-weight: 400;
		  text-align: center;
		  vertical-align: middle;
		  cursor: pointer;
		  background-image: none;
		  border: 1px solid transparent;
		  white-space: nowrap;
		  padding: 6px 12px;
		  font-size: 12px;
		  line-height: 1.42857143;
		  border-radius: 3px;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  -o-user-select: none;
		  user-select: none;
		  text-shadow: 0 1px 1px rgba(255, 255, 255, 0) !important;
		}
		#coursesection .title {
			display: block !important;
			font-size: 18px;
			font-weight: 600;
			padding: 10px 15px;
			border-bottom: 1px solid #f0f0f0;
			background-color: #f0f0f0;
			width: 100%;
			color: #686F7A;
		}
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
		#discussion_lean_overlay{
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
		.comments-list1 .comment .comment-content .comment-head{
			padding-left:0px;
		}
		.entypo-cancel-squared{
			color:#CCC;
		}
		.entypo-cancel-squared:hover{
			color:#fff;
		}
		.cattext1 h4 {
			font-size: 14px;
			font-weight: 500;
			width: 5%;
			margin: 0;
			text-align: right;
		}
		.smltext1 .right-content {
			color: #686F7A !important;
			font-size: 16px !important;
			font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;
			line-height: 1.43em;
		}
		.smltext1 .right-content:hover {
			color: #686F7A !important;
		}
		.smltext1 {
		  float: left;
		  width: 95%;
		}
		.ci-progress-container {
			padding-right: 0px;
			margin-right: 0px;
		}
		i.entypo-doc-text {
			float: left !important;
			width: 6% !important;
			margin-top: 4px;
		}
		a.right-content {
		  float: left!important;
		  width: 75%!important;
		}
		.check-mark {
		  border-radius: 50%;
		  float: left;
		  height: 18px;
		  width: 18px;
		  color: #fff;
		  text-align: center;
		  color: #fff;
		  background: #059549;
		}
		.check-mark i {
			position: relative;
			top: 1px;
		}
		.breadcrumb {
			padding: 10px 15px !important;
			color: #fff;
			height: 200px;
			display: flex;
			align-items: center;
			position: relative;
			flex-direction: column;
			justify-content: center;
		}
		.breadcrumb .reviews-col {
			z-index: 999;
			width: 100%;
		}
		.breadcrumb .bd_overlay{
			position: absolute;
		    top: 0;
		    left: 0;
		    width: 100%;
		    height: 100%;
		 	display: block;
		    background: rgba(0, 0, 0, 0.5);
		}
		.breadcrumb h3 {
			color: #fff;
			text-align: left;
			padding: 0px !important;
			margin: 5px 0px 7px 0px !important;
			width: 100%;
		}
		.container.courses .outeranchor {
		    display: none;
		}
		.container.courses {
			width: 1170px !important;
			margin: 0 auto;
			background: #fff;
			padding: 50px 0px !important;
		}
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
		@media (max-width: 1200px){
			.container.courses {
			width: 100% !important;
			margin: 0 auto;
			background: #fff;
			padding: 40px 40px !important;
		}
		}
		@media (max-width: 991px){
			.container.courses {
			border-top: 1px solid #ddd;
		}
		}
		@media (max-width: 767px){
			.container.courses {
				width: 100%;
		}
		#queAns {
			padding-top: 10px;
		}
		.container.courses {
			padding: 30px 10px !important;
		}
		.breadcrumb {
			height: 150px;

		}
		}
		@media screen and (max-width:480px){
			#review, #discussion {
		  width: 96%;
		  padding-bottom: 2px;
		  top: 5px !important;
		  left: 0 !important;
		  right: 0 !important;
		  margin: 0 auto !important;
		  position: absolute !important;
		  display: none;
		  background: #FFF;
		  border-radius: 5px;
		  -moz-border-radius: 5px;
		  -webkit-border-radius: 5px;
		  box-shadow: 0px 0px 4px rgba(0,0,0,0.7);
		  -webkit-box-shadow: 0 0 4px rgba(0,0,0,0.7);
		  -moz-box-shadow: 0 0px 4px rgba(0,0,0,0.7);
		}
		}
	</style>
<?php 

$getItemssetting = $CI->settings_model->getItems();

// print_r($getItemssetting);

 ?>

 <style>

.breadcrumb {

    background-image: url('<?php echo base_url() ?>public/uploads/settings/img/logo/<?php echo $getItemssetting['0']['bannerimage'] ?>');

    background-size: cover;

    border-radius:0px!important;

    background-color: #10172A;

}

  #message1 {
    position: fixed; 
	right: 0;
    float: right;
    clear: both;
    margin-right: 0px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}
</style>

<?php



$hover_id = 1;



$coursetype_details = $this->program_model->getCourseTypeDetails($programs->id);





if($coursetype_details[0]['course_type'] == 1)

{

	$sequential = true;

}

else

{

	$sequential = false;

}



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
<span id="msg_redeem" style="display: none"><?php echo $redeem_msg; ?></span>
<span id="message1"></span>

<section class="container courses">

  <div class="row-fluid ">

    <div id="system-message-container"></div>

    <div class="coursedetailpage"> 

      <!-------------Left-Section-Start---------------------- -->

      <div class="lecture_description">

        <div class="cont_mid">

          <div class="coursebannerinner">

            <div class="leftcontent">

      			<div class="breadcrumb" style="padding-bottom: 20px;">
      			<div class="breadcrum_overlay"></div>
               

                      <h3><?php echo $programs->name;?></h3>

                   <!--  </div> -->

                    <!-- @@@@@@@@@@@@@@@@@@@@ -->



                    	<!-- <div class="star_rating_lec"> -->



<!------------------------starreview-Start--------------------------> 

                <span class="reviews-col p0-10">

				<?php

				$avg_rating = 0;

				if(count($reviewsnew) > 0)

				{

					$total_rating = NULL;

					foreach($reviewsnew as $review) 

					{

						$total_rating += $review->review_rate;

						

					}

					if(count($reviews) > 0)

					{

					$avg_rating = $total_rating/count($reviews);

				    }

					//$rate_percent = ($avg_rating/$total_rating)*100;

				}

				?>

						



				<?php

				$round1 = round($avg_rating);

				?>

				<a href="<?php echo base_url(); ?>programs/programs/<?php echo $programs->id ?>#reviews">

				<div class="rating-good" style="float: left; width: 45%; margin-top: 1px; margin-bottom: 2px;">

					<div class="rate-ex3-cnt">

					<?php

					for($iii=1;$iii<=5;$iii++)

					{

						if($iii<=$round1)

						{

							?>

							<div id="<?php echo $iii;?>" class="rate-btn-1 rate-btn rate-btn-active"></div>

							<?php

						}

						else

						{

							?>

							<div id="<?php echo $iii;?>" class="rate-btn-1 rate-btn"></div>

							<?php

						}

					}

					?>					

					</div>

				</div>			

				</a></span>

				<?php if(count($reviews) <= 0){ ?>

              <div class="write_review"> <a id="go_reviews" rel="leanModal" onclick="showReviewdiv()"><?php  echo 'Write Review'; ?></a> </div> 

          <?php } ?>

                

	 </div> 

                    <!-- @@@@@@@@@@@@@@@@@@@@ -->

                  </div>



                </div>

				

			

      <!-- if -->

      			 <?php



    	if(($programs->webstatus=="active") && $programs->course_type == '2')

	  {	

    ?>

      <div  style="padding-left: 0; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.15);">

        <div class="tabs-vertical-env">

          <?php

          	

	if($this->program_model->checkEnrolled($user_id,$course_id))

    {

		?>



		<div style="padding:0 20px; background-color: #fff;">

			<!-- <h3 style="margin: 0 auto;text-align: center;padding-top: 15px;">Webinar</h3> -->



		</div>

		<div class="panel-body with-table">

         <table class="table  table-responsive collaptable"> 

          <tbody id="webinarbody">

          	<?php $ii = 1;	





          	$currentgmt = strtotime ( '+1 minute' , strtotime ( $today_formatted ) ) ;

			$currentgmt = date ( 'Y-m-d H:i' , $currentgmt );

          	

          	//print_r($webinars); exit("web");

          	foreach($webinars as $webinar)

			{	if($ii == 1)

					{ ?>

					<div class="divbutton">

          	<tr><td><b>Startup Date<b></td>

          		<td><span><?php $date = new DateTime($webinar->fromdate); echo $date->format('d M y') ?></span></td>

			</tr>

			<tr><td><b>Timing<b></td>

          		<td><span><?php echo $webinar->fromtime.' GMT'; ?></span></td>

			</tr>

			<tr><td colspan="2"><div class="webdiv">

			<?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);

				echo form_open(base_url().'conwebinar/',$attributes); ?>

				

				<input type="hidden" value="<?php echo $userfname; ?>" name="ufname">

				<input type="hidden" value="<?php echo $usermail; ?>" name="uemail">

				<input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">

				<input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">

				<?php 

					$web_schedule = $webinar->fromdate.' '.$webinar->fromtime;



					$newtimestamp1 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute');

					$web_time1 = date('Y-m-d H:i:s', $newtimestamp1);



					$webinar->web_duration = ($webinar->web_duration + '59');					

					$newtimestamp2 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute'); 

					 $web_time2 = date('Y-m-d H:i:s', $newtimestamp2);



					  if($web_schedule >= $currentgmt)

					 { ?>

						<a id="start<?php echo $ii ?>" data-toggle="tooltip" title="Class Start On <?php echo $web_schedule; ?>" style="float: right;">Please Wait! Class will be started soon...</a>

					<?php }



					 else if($web_time1 >= $currentgmt && $web_time2 >= $currentgmt)

					 {	?>

					 	<input style="float:right"   type="submit" class="btn btn-success " value="Start" name="submit">



					<?php }

					else if($currentgmt >= $web_time2)

					{	?>

						<!-- <a target="_blank"  href="<?php echo $webinar->wiziq_recording_url; ?> ">View Recording</a> -->

						<input type="hidden" value="<?php echo $webinar->wiziq_recording_url; ?>" name="webrecording">



						<button display="none" class="btn btn-warning" style="float:right;margin-top:-10px;" id="start<?php echo $ii ?>"  type="submit"  value="Start" name="submit"> View Recording</button>

						<a  style="float:left;margin-top:1%; ">Class is expired!</a>

					<?php } else {	?>

					

					<a> Your live class is over!<br> Please Wait a moment, Recording is in progress...</a>



					<?php }



				?>

				</div></td></tr></div>

			<?php echo form_close();

					}

					else

					{

						?>	

							<tr><td><b>Startup Date<b></td>

          		<td><span><?php $date = new DateTime($webinar->fromdate); echo $date->format('d M y') ?></span></td>

			</tr>

			<tr><td><b>Timing<b></td>

          		<td><span><?php echo $webinar->fromtime.' GMT'; ?></span></td>

			</tr>

				<tr  data-id="<?php echo $ii ?>" data-parent="<?php echo $ii == 2 ? '': 2; ?>"><td colspan="2">

				<?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);

				echo form_open(base_url().'conwebinar/'.$webinar->proid,$attributes); ?>

				

				<input type="hidden" value="<?php echo $userfname; ?>" name="ufname">

				<input type="hidden" value="<?php echo $usermail; ?>" name="uemail">

				<input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">

				<input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">

<!-- 				<input style="float:right"   type="submit" class="btn btn-success " value="Start" name="submit">

 -->

 				<?php 

					$web_schedule = $webinar->fromdate.' '.$webinar->fromtime;



					$newtimestamp1 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute');

					$web_time1 = date('Y-m-d H:i:s', $newtimestamp1);



					$webinar->web_duration = ($webinar->web_duration + '59');					

					$newtimestamp2 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute'); 

					 $web_time2 = date('Y-m-d H:i:s', $newtimestamp2);



					  if($web_schedule >= $currentgmt)

					 { ?>

						<a id="start<?php echo $ii ?>" data-toggle="tooltip"  title="Class Start On <?php echo $web_schedule; ?>" style="float: right;margin-right: -10%;">Class Yet To Start!</a>

					<?php }



					 else if($web_time1 >= $currentgmt && $web_time2 >= $currentgmt)

					 {	?>

					 	<input style="float:right"   type="submit" class="btn btn-success " value="Start" name="submit">



					<?php }

					else if($currentgmt >= $web_time2)

					{	?>

						<!-- <a target="_blank"  href="<?php echo $webinar->wiziq_recording_url; ?> ">View Recording</a> -->

						<input type="hidden" value="<?php echo $webinar->wiziq_recording_url; ?>" name="webrecording">



						<button display="none" class="btn btn-warning" style="float:right;margin-top:-10px;" id="start<?php echo $ii ?>"  type="submit"  value="Start" name="submit"> View Recording</button>

						<a  style="float:left;margin-top:1%; ">Class is expired!</a>

					<?php } else {

					

					echo "<a> Your live class is over!<br> Please Wait a moment, Recording is in progress...</a>";



					 }



				?>

				</td></tr>

						<?php echo form_close();

					}  

				$ii++; 

			}

		  ?>

          </tbody>

		</table>



		</div>



		<?php

		    }

          ?>

        </div>

      </div></div></div></div>

    <?php

    	} else if(($programs->webstatus=="active") && ($programs->course_type != '2'))

	  {	?>

	  <!-- webinar sec -->

	  	<div  style="padding-left: 0; background: #eee; box-shadow: 0 1px 4px rgba(0,0,0,.15);">

        <div class="tabs-vertical-env">

          <?php

          	

	if($this->program_model->checkEnrolled($user_id,$course_id))

    {

		if($webinars){



	?>



		

		<div class="panel-body with-table">

			

			<div class="webinar"><a class="col-sm-4"><b>Name</b></a>

			<a class="col-sm-2"><b>Startup Date</b></a>

			<a class="col-sm-2"><b>Timing</b></a></div>

			<hr>

        	<?php  $ii = 1; //	print_r($webinars); exit("web");

        	// $currentgmt1 = gmdate('Y-m-d H:i');

        	$currentgmt = strtotime ( '+1 minute' , strtotime ( $today_formatted ) ) ;

			$currentgmt = date ( 'Y-m-d H:i' , $currentgmt );

         	 foreach($webinars as $webinar)

			{	if($ii == 1)

					{ ?><div class="webinar" id="<?php echo $ii ?>" onmouseover="sideshow(this.id)" onmouseout="sidehide(this.id)" >

					<div id="web"><a  class="col-sm-4"><?php echo $webinar->title; ?></a>

					<span class="col-sm-2" ><?php $date = new DateTime($webinar->fromdate); echo $date->format('d M y'); ?></span>

					<span class="col-sm-2"><?php echo $webinar->fromtime.' GMT'; ?></span>

					<span><?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);

				echo form_open(base_url().'conwebinar/',$attributes); ?>

				

				<input type="hidden" value="<?php echo $userfname; ?>" name="ufname">

				<input type="hidden" value="<?php echo $usermail; ?>" name="uemail">

				<input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">

				<input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">

				

				<?php 

					$web_schedule = $webinar->fromdate.' '.$webinar->fromtime;



					$newtimestamp1 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute');

					$web_time1 = date('Y-m-d H:i:s', $newtimestamp1);



					$webinar->web_duration = ($webinar->web_duration + '59');					

					$newtimestamp2 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute'); 

					 $web_time2 = date('Y-m-d H:i:s', $newtimestamp2);

					 if($web_schedule >= $currentgmt)

					 { ?>

						<a id="start<?php echo $ii ?>" data-toggle="tooltip"  title="Class Start On <?php echo $web_schedule; ?>" style="float: right;margin-right: -10%;">Please wait! class will be started soon...</a>

					<?php }



					 else if($web_time1 >= $currentgmt && $web_time2 >= $currentgmt)

					 {	?>

					 	<button display="none" class="btn btn-success start" style="float:right;margin-top:-10px;color: #fff; font-weight: 700; background: #54b551; font-size: 12px;" id="start<?php echo $ii ?>"  type="submit" class="start" value="Start" name="submit"> Start </button>



					<?php }

					else if($currentgmt >= $web_time2)

						

					{	?>

						<!-- <a target="_blank" style="margin-right: -10%;float:right" href="<?php echo $webinar->wiziq_recording_url; ?> ">View Recording</a> -->

						<input type="hidden" value="<?php echo $webinar->wiziq_recording_url; ?>" name="webrecording">



						<button display="none" class="btn btn-warning" style="float:right;margin-top:-10px;" id="start<?php echo $ii ?>"  type="submit"  value="Start" name="submit"> View Recording</button>

<!-- 						<button display="none" class="btn btn-warning start" style="cursor:not-allowed;float:right;margin-top:-10px; color: #fff; " id="start<?php echo $ii ?>"   class="start" value="Expired" name="Expired" disabled> Expired </button>

 -->					<?php } else { ?>

					

<!-- 					<a style="float: left;padding: 2%;margin-bottom: 4%;" class="col-sm-offset-2 col-sm-8"> Your live class is over!<br> Please Wait a moment, Recording is in progress...</a>

 -->

 						<a id="start<?php echo $ii ?>" data-toggle="tooltip"  title="Your live class is over!<br> Please Wait a moment, Recording is in progress..." style="float: right;margin-right: -10%;"> Class is over!<br> Please Wait a moment, Recording is in progress...</a>

					 <?php }



				?>

			</span></div></div><?php echo form_close();

					}



					else

					{ ?><hr><div class="webinar" id="<?php echo $ii ?>" onmouseover="sideshow(this.id)" onmouseout="sidehide(this.id)" >

					<div id="web"><a  class="col-sm-4"><?php echo $webinar->title; ?></a>

					<span   class="col-sm-2"><?php $date = new DateTime($webinar->fromdate); echo $date->format('d M y') ?></span>

					<span  class="col-sm-2"><?php echo $webinar->fromtime.' GMT'; ?></span>

					<span><?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);

				echo form_open(base_url().'conwebinar/',$attributes); ?>

				

				<input type="hidden" value="<?php echo $userfname; ?>" name="ufname">

				<input type="hidden" value="<?php echo $usermail; ?>" name="uemail">

				<input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">

				<input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">

					

				<?php 

					$web_schedule = $webinar->fromdate.' '.$webinar->fromtime;



					$newtimestamp1 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute');

					$web_time1 = date('Y-m-d H:i:s', $newtimestamp1);



					$webinar->web_duration = ($webinar->web_duration + '59');					

					$newtimestamp2 = strtotime($web_schedule.' + '.$webinar->web_duration.' minute'); 

					 $web_time2 = date('Y-m-d H:i:s', $newtimestamp2);



					 if($web_schedule > $currentgmt)

					 {	?>

					<a id="start<?php echo $ii ?>" data-toggle="tooltip"  title="Class Start On <?php echo $web_schedule; ?>" style="float: right;margin-right: -10%;">Class Yet To Start!</a>

					<?php }



					 else if($web_time1 >= $currentgmt && $web_time2 >= $currentgmt)

					 {	?>



					 	<button display="none" class="btn btn-success start" style="float:right;margin-top:-10px;color: #fff; font-weight: 700; background: #54b551; font-size: 12px;" id="start<?php echo $ii ?>"  type="submit" class="start" value="Start" name="submit"> Start </button>

 						

					<?php }

					else if($currentgmt >= $web_time2)

					{	?>

						<!-- <a id="start<?php echo $ii ?>" target="_blank" style="margin-right: -10%;float:right" href="<?php echo $webinar->wiziq_recording_url; ?> ">View Recording</a> -->

						<input type="hidden" value="<?php echo $webinar->wiziq_recording_url; ?>" name="webrecording">



						<button display="none" class="btn btn-warning" style="float:right;margin-top:-10px;" id="start<?php echo $ii ?>"  type="submit"  value="Start" name="submit"> View Recording</button>

						<!-- <a display="none" style="margin-right: -10%;float:right"  id="start<?php echo $ii ?>"  type="submit" value="Start" name="submit"> View Recording **</a> -->

<!-- 						<button display="none" class="btn btn-warning start" style="cursor:not-allowed;margin-top:-10px; color: #fff; " id="start<?php echo $ii ?>"   class="start" value="Expired" name="Expired" disabled> Expired </button>

 -->					<?php } else {	?>

					

					<a id="start<?php echo $ii ?>" data-toggle="tooltip" title="Your live class is over!<br> Please Wait a moment, Recording is in progress..." style="float: right;margin-right: -10%;"> Class is over!</a>



					<?php }



				?>

			</span></div></div>

			<?php echo form_close();

					}

					$ii++; 

			}

		  ?>

        



		</div>

		<?php } ?>

<script>

$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();   

});

</script>

		<?php

		    }

          ?>

        </div>

      </div>



	  		<!-- Lectures -->

	  		 <div class="coursebannerinner">

            <div class="leftcontent">

				



				<?php

					$lecture_ids =array();

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

							{	if($lesson->id)

								{

								array_push($lecture_ids,$lesson->id);

							    }

								$lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$user_id,$programs->id);

								

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



				?></div>

            <p>You completed <?php echo $my_viewed_lesson_total;?> out of <?php echo $my_lesson_total;?> published items</p>

            

            <div>

                <div class="progress">

					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $bar_percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bar_percentage;?>%"> <span class="sr-only"><?php echo $bar_percentage;?>% Complete (success)</span> </div>

                </div>



            </div>



           <?php

           		if($programs->id_final_exam)

           		{

           			$quizinfo = $this->Myinfo_model->getQuizScore12($user_id,$programs->id,$programs->id_final_exam);

           			if($quizinfo)

           			{

           				?>

           				<p style="color: #016ac1;">Result of Last attempt of Final Quiz : <?php echo $quizinfo[0]->result; ?></p>

						<?php

					}

					else

					{

						?>

			  			<p>You have not given the Final Quiz yet.</p>

						<?php

					}

				}

$allLessonIds = array();

$chapter = 1;

$total_lesson = 0; 

foreach ($days as $day)
{ 

?>
    <div id="coursesection">

	    <div class="section_title">

		    <div class="section_label"><?php echo "Chapter : ".$chapter++ ?></div>

		    <div class="section_name"> <?php echo $day->title;?></div>

		</div>

    <div id="coursesectionlecture">

    <?php      

		// $lessons = $this->program_model->getLessons($day->id);

    $lessons = $this->program_model->getLessonNew($day->id);

		$total_lesson += count($lessons);

		$dayaccess = $day->access;

    ?>

    <ul class="course_cat1">

    <?php

		$j=0;	

		$k=0;

		$i=0;	

		$l=0;		

			foreach ($lessons as $lesson)

            {			  

			    $allLessonIds[] = $lesson->id;

				

                if($user_id >0 && $programs->is_drip_course == 1 && $coursetype_details[0]["lessons_show"] == 1 && $not_show === TRUE)

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

			

			//$lessonAccess = $lesson->step_access;



			//get entypo for video,text etc

			// if($lesson->mediatype == 'text')

			// {	

			// 	$entypo = 'entypo-book';

			// 	$texty = 'Text';

			// }

			// else if($lesson->mediatype == 'video')

			// {

			// 	$entypo = 'entypo-video';

			// 	$texty = 'Video';

			// }

			// else if($lesson->mediatype == 'docs')

			// {

			// 	$entypo = 'entypo-doc-text';

			// 	$texty = 'Doc';

			// }	

			// else

			// {

			// 	$entypo = 'entypo-doc-text';

			// 	$texty = 'Doc';

			// }	

			$entypo = 'entypo-doc-text';

				$texty = 'Doc';	

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

<!-- onmouseover="show_sidebar(this.id)" onmouseout="hide_sidebar(this.id)" -->

    <li id='<?php echo $hover_id;?>'>

    <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>

    <div class="cattext1" style="display: inline-block; width: 100%;">

    <?php  

	$lesson_viewed = $this->program_model->getViewLesson($lesson->id,$user_id,$programs->id);

	if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)

	{

        if($diff_start >0)

        { 						

			?>

			<h4 style="float: right;"><!-- <a href="<?php //echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' ><?php //echo "Lecture ". ++$j ;?></a> --></h4>

			<div class="smltext" style="margin-top:12px;" onmouseover="show_sidebar()" onmouseout="hide_sidebar()"> <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>'>

			<i class="<?php echo $entypo;?>" style=" margin-right: 10px;"></i><?php echo $lesson->name;?></a><br>

			  <!--Available: -->

			  <?php //echo $level; 



			  ?>



			  <div id="sidebar" style="float:right;"> <a href="#" class="revisit_btn">View lecture</a> </div>

			</div>

			<?php 

		}

        else

        { 						

			?>

			<h4 style="float: right;"><a href="<?php echo 'javascript:void(0)';?>" class='' ><?php echo "Lecture". ++$j ;?></a></h4>

			<div class="smltext" style="margin-top:12px;" > 

			<a href="javascript:void(0)"><!--Title : --><i class="<?php echo $entypo;?>" style=" margin-right: 10px;"></i><?php echo $lesson->name; ?></a> <br>

				<!--Available: -->

				<?php //echo $level; ?>

				<div id="sidebar" style="float:right;"> <a href="#" class="revisit_btn">View lecture</a> </div>

			</div>

			<?php 

		}

    }

    else

    {			

	//echo '111';

		?>

        <h4 style="float: right;">

            <div class="ci-progress-container">

            <?php

				$lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $this->uri->segment(3));





						if(!empty($lesson_viewed2))

						{

							foreach($lesson_viewed2 as $compltData)

							{					

								$marks = '|'.$lesson->id.'|';

							 	if( strpos($compltData->mark_as_completed, $marks) !== false )

							 	{

							 		?>

									<!-- <span class="ci-progress-maskgreencheck"></span> -->

									<div class="check-mark">

										<i class="fa fa-check" aria-hidden="true"></i>

				         			</div>

				         			<?php		

							 	}

							 	else

							 	{

							 		if($lesson_viewed)

									{

										?>

										<span class="ci-progress-mask green"></span>

							         	<?php			

									}

							 	}

							}

						}

						else

						{

							

						}

						?>

			</div>

            <?php 

            		

            	// if($lesson->layoutid == '12')

            	// {

            	// 	echo "Exam ". ++$k ;

            	// }

            	// else if($lesson->layoutid == '2')

            	// {

            	// 	echo "Assignment ". ++$i ;

            	// }

            	// else if($lesson->layoutid == '22')

            	// {

            	// 	echo "Webinar ". ++$l ;

            	// }

            	// else

            	// {

            	// 	echo "Lecture ". ++$j ;

            	// }



           ?><!--<a href="<?php //echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='<?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><?php //echo "Lecture ". ++$j ;?></a>--></h4>

			<div class="smltext1"> 

			    <?php

			    	if($sequential)

			    	{	

			    		   $lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$user_id,$programs->id);

			    		  

			    		   end($complated_lecture_ids);      

						   $lec_key1 = key($complated_lecture_ids);

			    		   $lec_key = array_search($lesson->id,$complated_lecture_ids);

			    		   $lec_key2= $lec_key1+1;

			    		  

			    		if(current($lecture_ids)==$lesson->id)

			    		{

			    ?>



			    	<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

			    	<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

					<?php echo $lesson->name; ?></a> 

				

			    <?php

			    		}

			    		else

			    		{	

			    			//echo $lec_key1.'='.$lecture_ids[$lec_key2]; 

			    			if($lec_key || $lecture_ids[$lec_key2] ==$lesson->id)

			    			{

			    				if($my_viewed_lesson_total>=1)

			    				 {

			    ?>

			   		<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

			    	<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" >

					<?php echo $lesson->name; ?></a> 

				



			    <?php      

			    				}

			    				else

			    				{

			    					?>

			    					<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

						    	<a class="right-content" href="javascript:void(0)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" >

								<?php echo $lesson->name; ?></a>

			    					<?php

			    				}



			    			}

			    			else 

			    			{ 

			    				 

			    ?>

						    	<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

						    	<a class="right-content" href="javascript:void(0)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" >

								<?php echo $lesson->name; ?></a> 

				

			    <? 

			    			 //}

                           }



			    		}

			    	}

			    	else {



			    		$urlCourse1 = strtolower($programs->name);			

						$urlCourse1 = trim(str_replace(' ', '-', $urlCourse1));

						$urlCourse1 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse1);

			    ?>

			    	<!-- <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > -->

			    	<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

			    	<a class="right-content" href="<?php echo base_url().$urlCourse1."/dashboard/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" >



				<?php echo $lesson->name; ?></a> 

				

			    <?php

			    	}

			    ?>

				<!--Available: -->	

				<?php

				

				if($sequential)

				{	

					$lesson_viewed3 = $this->program_model->getViewLesson($lesson->id,$user_id,$programs->id);



					if($j == 1)

			    		{

			    			if($lesson_viewed3)

					        {

					        	if($lesson->layoutid == '12')

				  				{  

			    ?>

			    			<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Retake Quiz</a> </div>



			    <?php

			    				}

			    				else

			    				{

			    			?>

			    			<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

			    			<?php	

			    				}

			    			}

			    			else

			    			{

			    				if($lesson->layoutid == '12')

				  				{  

			    ?>

			    				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Take Quiz</a> </div>



			    <?php

			    				}

			    				else

			    				{

			    					?>

			    			  <div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

			    					<?php

			    				}

			    			}

			    		}

					else

					{

					if($lesson_viewed3)

					{



						if($lesson->layoutid == '12')

				  		{ 

				?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Retake Quiz</a> </div>

                   <?php

                   		}

                   		else

                   		{

                   	?>

                   		<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

                   	<?php

                   		}

                   	}

                   	else

                   	{

                   		$prev_lesson_id = $lesson->id - 1;

			    	   $lesson_Prev_viewed = $this->program_model->getPreviousViewLesson($prev_lesson_id,$user_id);

			    			 

                   		if($lesson_Prev_viewed)

                   		{



                   		 if($lesson->layoutid == '12')

				  		  {	

			    		 

			        ?>	

                   		<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Take Quiz</a> </div>		

                   	<?php

                   		  }

                   		  else

                   		  {

                   		  	?>

                   		<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>		

                   		  	<?php

                   		  }

                   		}

                   		else

                   		{

                   		 if($lesson->layoutid == '12')

				  		  {	

                   	?>

                   		<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="javascript:void(0)" class="revisit_btn">Take Quiz</a> </div>		

               <?php

               			  }

               			  else

               			  {

               			  	?>

               			<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="javascript:void(0)" class="revisit_btn">View Lecture</a> </div>			

               			  	<?php

               			  }

               			}

               		}

               	  }

                }

                else

				{

				if($lesson_viewed)

				{



				 ?>

				 <?php



				if($lesson->layoutid == '12')

				  {      

				 ?>

				 <div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Retake Quiz</a> </div>

				 <?php

				  }

				  else if($lesson->layoutid == '22')

				  {      

				 ?>

				 <div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Revisit Webinar</a> </div>

				 <?php

				  }

				  else if($lesson->layoutid == '2')



				  {      

				 ?>

				 <div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Revisit Assignment</a> </div>

				 <?php

				  }

				  else

				  {

				 ?>

 				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

				

				<?php

				}

				}

				else

				{

				?>

				<?php

				if($lesson->layoutid == '12')

				  { 

				?>

<!-- 				<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Exam</a> </div>

 -->				

 				<!-- ---- -->

 				<?php 

						if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

					{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Quiz</a> </div>

				<?php	}

					else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

					{ 

				?>

				<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Quiz</a> </div>

				<?php }

						// && $lesson->release_date <= gmdate('Y-m-d', time())

				else if($programs->release_type == '2')

					{

						$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

						$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

						if($lect_date <= $currdate1)

						{

					?>

				<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Quiz</a> </div>

					<?php }

						else{	?>

							<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:-6px;"><?php echo "Quiz Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

					<?php	}

					}

					else{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:-6px;"><?php echo "Quiz Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>

				<?php	}



					 ?>

 				<!-- ---- -->

 				<?php

				}

				else

				{	

				?>

				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

				<?php

			    }

				}

			}

				?>

				

				<!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">View lecture</a>--> 

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



<?php

/*

echo '<pre>';

print_r($programs);

echo '</pre>';*/



if(isset($programs->id_final_exam) && ($programs->id_final_exam > 0))

{

?>

    <div class="leftcontent"> 

        <div class="title"><?php echo "Final Quiz ";

        echo $programs->certificate_course_msg ? "(".$programs->certificate_course_msg.")" : ""; ?></div>

        <div class="submtwo">

          <?php				 

			$finalexaminfo = $this->program_model->getQuiz($programs->id_final_exam);

		    $takenwhere = array(

			'user_id'      => $user_id,

        

			'quiz_id'      => $programs->id_final_exam

        

			);

        

			$quiztakeninfo = $this->program_model->getQuizTaken($takenwhere);

        

			if($user_id >0 && $programs->is_drip_course == 1 && $coursetype_details[0]["lessons_show"] == 1 && $not_show === TRUE){

        

			if($coursetype_details[0]["course_type"] == 1)

			{

				if($coursetype_details[0]["lesson_release"] == 1)

				{

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

        

        $viewedLessonIds = explode('||',trim(@$ViewedLessons[0]['lesson_id'],'|'));

        

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

        

        if(($user_id >0) && $not_show === TRUE)

		{        

			?>

            <a href="<?php echo ($finalexamactiveflag) ? base_url().'lessons/finalexamnew/'.$programs->id.'/'.$programs->id_final_exam.'/'.$lesson->id : 'javascript:void(0);'?>"> <span class="btn btn-danger"> Final Quiz:<?php echo $finalexaminfo->name;?></span></a>

            <?php 

		}

		else

		{

			?>

            <?php

		}

		?>

            <div class="view" id="viewed-2">

              <?php count($quiztakeninfo);?>

              <!--<img style="display:<?php echo (count($quiztakeninfo) > 0) ? '':'none';?>" align="viewed" src="">--> </div>

            <div class="level"> <img src=""> </div>

            <hr style="margin-bottom:0;" />

          </div>

        </div>

    </div>

    <?php

}

?>

<!-- final exam view End -->

	



<!--     <div><input style="margin-right: 10px;" type="button" value="View Notes" class="btn btn-orange view_notes_btn" onclick="window.open('<?php echo base_url();?>programs/pdf/<?php echo $this->uri->segment(3);?>'); return false;"> <a class="btn btn-success down_notes_btn" href="<?php echo base_url(); ?>programs/pdf/<?php echo $this->uri->segment(3); ?>" download>Download Notes</a></div> -->



    <?php

    ?>

    </div>



    </div></div></div>

    <!-- end Lect -->



	<?php  }	else {

    ?> 

    <!-- enf if -->

 

          <div class="coursebannerinner">

            <div class="leftcontent">

				



				<?php

					$lecture_ids =array();

					$complated_lecture_ids = array();



					$my_lesson_total = 0;

					$my_viewed_lesson_total = 0;
					$bar_percentage = 0;
					if($days)
					{
						foreach ($days as $day)
						{
							$lessons = $this->program_model->getLessonNew($day->id);
							$my_lesson_total += count($lessons);
							foreach ($lessons as $lesson)
							{	if($lesson->id)
								{
								array_push($lecture_ids,$lesson->id);
							    }
								$lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$user_id,$programs->id);
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
				?></div>

            <p>You completed <?php echo $my_viewed_lesson_total;?> out of <?php echo $my_lesson_total;?> published items</p>

            

            <div>

                <div class="progress">

					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $bar_percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bar_percentage;?>%"> <span class="sr-only"><?php echo $bar_percentage;?>% Complete (success)</span> </div>

                </div>



            </div>



           <?php

           		if($programs->id_final_exam)

           		{

           			$quizinfo = $this->Myinfo_model->getQuizScore12($user_id,$programs->id,$programs->id_final_exam);

           			if($quizinfo)

           			{

           				?>

           				<p style="color: #016ac1;">Result of Last attempt of Final Quiz : <?php echo $quizinfo[0]->result; ?></p>

						<?php

					}

					else

					{

						?>

			  			<p>You have not given the Final Quiz yet.</p>

						<?php

					}

				}

$allLessonIds = array();

$chapter=1;

$total_lesson = 0;

if($programs->is_live_class == 1 && !empty($batch_id)){

	$batch = $this->Crud_model->get_single('mlms_batches',"id = ".$batch_id." and status = 'active' and is_delete = 'no'");
	if(!empty($batch)){
		$events = $this->Crud_model->GetData('zoom_meeting_list','',"batch_id = ".$batch_id." and status != 'finished'");
		$prev_events = $this->Crud_model->GetData('zoom_meeting_list','',"batch_id = ".$batch_id." and status = 'finished'");
		// $events = $this->Crud_model->GetData('zoom_meeting_list','',"batch_id = ".$batch_id." and status != 'finished'");
	?>
	<label class="btn_current_live_tab">Live Lectures</label>
	<?php
	if(!empty($prev_events)){ ?>
	<label class="pull-right btn_previous_live_tab">Previous Lectures</label>
	<?php } ?>
	
<div id="coursesection" class="accordion-demo-611">

	<div class="main-panel-body">

    	<button class="accordion1">
		    <div class="section_title">
		        <div class="section_name">Batch - <?php echo ucwords($batch->batch_name);?></div>
		    </div>
		</button>

		<div class="panel batch_panel" style="">

	    <div id="coursesectionlecture" class="current_live_tab">
	        <ul class="course_cat1">
	        <?php foreach ($events as $event) {
	        	$date = date('Y-m-d H:i:s');
				$start_time = date("Y-m-d H:i:s",strtotime($event->start_time));
            	/*$start_time = date("Y-m-d H:i:s", strtotime($start_time . "-60 minutes"));

				$waittime = '';
				if ($date < $start_time) {
					$seconds = strtotime($start_time) - strtotime($date);
					$waittime = $seconds / 86400;
				}
				echo $waittime;*/
	        ?>
	            <li id="1">
	                <div class="cattext1" style="display: inline-block; width: 100%;">
	                    <h4 style="float: right;">
	                        <div class="ci-progress-container"></div>
	                    </h4>
	                    <div class="smltext1">
	                        <i class="entypo-doc-text" style="margin-right:10px"></i>
	                        <a class="right-content" href="#" style="float:left; margin-top: 12px;font-weight: bold;"> 
	                        <?php echo ucwords($event->topic); ?>
	                        <br><span style="font-weight: normal;font-size: 14px;">Lecture starts on : <?php echo date('d-M-Y h:i A',strtotime($event->start_time)); ?></span>
	                    	</a>
	                    	<?php if ($date >= $start_time) { ?>
	                        <div id="sidebar1" style="float:right; margin:0px;"> <a href="<?php echo base_url().'live-meeting/0/'.urlencode($event->join_url); ?>" class="revisit_btn" style="background: #1e8651"> Join </a> </div>
	                    	<?php }else{ ?>
	                        <div id="sidebar1" style="float:right; margin:0px;"> <a href="#" class="revisit_btn" style="background: #1e8651"> Yet not started </a> </div>
	                    	<?php } ?>
	                    </div>
	                </div>
	            </li>
	    		<?php } ?>
	        </ul>
	    </div>			
	<?php if(!empty($prev_events)){ ?>
		<div id="coursesectionlecture" class="previous_live_tab">
	        <ul class="course_cat1">
	        	<?php foreach ($prev_events as $event1) { ?>
	            <li id="1">
	                <div class="cattext1" style="display: inline-block; width: 100%;">
	                    <h4 style="float: right;">
	                        <div class="ci-progress-container">
	                        	<div class="check-mark">
									<i class="fa fa-check" aria-hidden="true"></i>
			         			</div>
	                        </div>
	                    </h4>
	                    <div class="smltext1">
	                        <i class="entypo-doc-text" style="margin-right:10px"></i>
	                        <a class="right-content" href="#" style="float:left; margin-top: 12px;font-weight: bold;"> 
	                        <?php echo ucwords($event1->topic); ?>
	                        <br><span style="font-weight: normal;font-size: 14px;">Lecture Date : <?php echo date('d-M-Y h:i A',strtotime($event1->start_time)); ?></span>
	                    	</a>
	                        <div id="sidebar1" style="float:right; margin:0px;"> <a href="#" class="revisit_btn" style="background: #1e8651"> Lecture Ended</a> </div>
	                    </div>
	                </div>
	            </li>
	    		<?php } ?>
	        </ul>
	    </div>
	<?php } ?>
	</div>
</div>	
</div>

<script type="text/javascript">
$(document).ready(function(){
	$(".btn_current_live_tab").click(function(){
		$(".current_live_tab").fadeIn(500);
		$(".previous_live_tab").fadeOut(500);
	});
	$(".btn_previous_live_tab").click(function(){
		$(".current_live_tab").fadeOut(500);
		$(".previous_live_tab").fadeIn(500);
	});
});
</script>

<?php } } 
if(!empty($days)){ echo '<label>Self Learning Contents</label>';} 
foreach ($days as $day)

{ 

?>

	<div id="coursesection" class="accordion-demo-611">

    	 <div class="main-panel-body">

	    	 <button class="accordion1">

		    <div class="section_label"><?php echo "Chapter : ".$chapter++ ?></div>

		    <div class="section_name"> <?php echo $day->title;?></div>

			</button>

			<div class="panel batch_panel" style="">

			    <div id="coursesectionlecture">

    <?php      

		// $lessons = $this->program_model->getLessons($day->id);

    $lessons = $this->program_model->getLessonNew($day->id);

		$total_lesson += count($lessons);

		$dayaccess = $day->access;

    ?>

    <ul class="course_cat1">

    <?php

    $i=0;	

		$l=0;

		$j=0;	

		$k=0;		//print_r($lessons); exit("hhh111");

			foreach ($lessons as $lesson)

            {			  

			    $allLessonIds[] = $lesson->id;

				

                if($user_id >0 && $programs->is_drip_course == 1 && 

                	$coursetype_details[0]["lessons_show"] == 1 && 

                	 $not_show === TRUE)

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

			

			//$lessonAccess = $lesson->step_access;



			//get entypo for video,text etc

			// if($lesson->mediatype == 'text')

			// {	

			// 	$entypo = 'entypo-book';

			// 	$texty = 'Text';

			// }

			// else if($lesson->mediatype == 'video')

			// {

			// 	$entypo = 'entypo-video';

			// 	$texty = 'Video';

			// }

			// else if($lesson->mediatype == 'docs')

			// {

			// 	$entypo = 'entypo-doc-text';

			// 	$texty = 'Doc';

			// }	

			// else

			// {

			// 	$entypo = 'entypo-doc-text';

			// 	$texty = 'Doc';

			// }	

			$entypo = 'entypo-doc-text';

				$texty = 'Doc';	

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

                    <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='outeranchor '><span class="s_underline"> <?php echo $lesson->name;?></span></a>

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

<!-- onmouseover="show_sidebar(this.id)" onmouseout="hide_sidebar(this.id)" -->

    <li id='<?php echo $hover_id;?>' >

    <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>

    <div class="cattext1" style="display: inline-block; width: 100%;">

    <?php  

	$lesson_viewed = $this->program_model->getViewLesson($lesson->id,$user_id,$programs->id);

	if(($user_id >0) && ($programs->is_drip_course == 1) && ($coursetype_details[0]["lessons_show"] == 1) && $not_show === TRUE)

	{

        if($diff_start >0)

        { 						

			?>

			<h4 style="float: right;"><!-- <a href="<?php //echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' ><?php //echo "Lecture ". ++$j ;?></a> --></h4>

			<div class="smltext" style="margin-top:12px;" onmouseover="show_sidebar()" onmouseout="hide_sidebar()"> <a href="<?php echo base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>'>

			<i class="<?php echo $entypo;?>" style=" margin-right: 10px;"></i><?php echo $lesson->name;?></a><br>

			  <!--Available: -->



			  <?php //echo $level;



			  	if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == '') )

					{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

				<?php	}

					else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

					{ 

				?>

				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

				<?php }

						// && $lesson->release_date <= gmdate('Y-m-d', time())

				else if($programs->release_type == '2')

					{

						$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

						$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

						if($lect_date <= $currdate1)

						{

					?>

					<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

					<?php }

						else{	?>

							<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

					<?php	}

					}

					else{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>
				<?php } ?>
			</div>
			<?php
		}
        else
        {
			?>
			<h4 style="float: right;"><!-- <a href="<?php //echo 'javascript:void(0)';?>" class='' ><?php //echo "Lecture ". ++$j ;?></a> --></h4>
			<div class="smltext" style="margin-top:12px;" > 
			<a href="javascript:void(0)"><!--Title : --><i class="<?php echo $entypo;?>" style=" margin-right: 10px;"></i><?php echo $lesson->name; ?></a> <br>
				<!--Available: -->
				<?php //echo $level;
				if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))
				{ ?>
					<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>
				<?php }
				else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)
				{
				?>
				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>
				<?php }
				else if($programs->release_type == '2')
				{
					$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

					$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

					if($lect_date <= $currdate1)

					{

				?>

					<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

					<?php }

						else{	?>

							<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

					<?php	}

					}

					else{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>

				<?php	}	?>

			</div>

			<?php 

		}

    }

    else

    {			

	//echo '111';

		?>

        <h4 style="float: right;">

            <div class="ci-progress-container">

            <?php

				$lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $this->uri->segment(3));





						if(!empty($lesson_viewed2))

						{

							foreach($lesson_viewed2 as $compltData)

							{					

								$marks = '|'.$lesson->id.'|';

							 	if( strpos($compltData->mark_as_completed, $marks) !== false )

							 	{

							 		?>

									<!-- <span class="ci-progress-maskgreencheck"></span> -->

									<div class="check-mark">

										<i class="fa fa-check" aria-hidden="true"></i>

				         			</div>

				         			<?php		

							 	}

							 	else

							 	{

							 		if($lesson_viewed)

									{

										?>

										<span class="ci-progress-mask green"></span>

							         	<?php			

									}

							 	}

							}

						}

						else

						{

							

						}

						?>

			</div>



            <?php

     //        	if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

					// {

				 //        echo "<a href='".base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id."' >";

				 //        if($lesson->layoutid == '12') echo "Exam ". ++$k; 

				 //        else if($lesson->layoutid == '22') echo "Webinar ". ++$l; 

				 //        else if($lesson->layoutid == '2') echo "Assignment ".++$i;

				 //        else echo "Lecture ". ++$j;



				 //        echo "</a>";

   		//  			}

	 			// else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

					// { 

					// echo "<a href='".base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id."' >";

				 //        if($lesson->layoutid == '12') echo "Exam ". ++$k; 

				 //        else if($lesson->layoutid == '22') echo "Webinar ". ++$l; 

				 //        else if($lesson->layoutid == '2') echo "Assignment ".++$i;

				 //        else echo "Lecture ". ++$j;



				 //        echo "</a>";

   		//  			}

   		//  			else if($programs->release_type == '2')

					// {

					// 	$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

					// 	$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

					// 	if($lect_date <= $currdate1)

					// 	{

					

					// 	echo "<a href='".base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id."' >";

				 //        if($lesson->layoutid == '12') echo "Exam ". ++$k; 

				 //        else if($lesson->layoutid == '22') echo "Webinar ". ++$l; 

				 //        else if($lesson->layoutid == '2') echo "Assignment ".++$i;

				 //        else echo "Lecture ". ++$j;



				 //        echo "</a>";				

				 //        }

					// 	else{	

					// 	echo "<a>";

					// 	if($lesson->layoutid == '12') echo "Exam ". ++$k; 

				 //        else if($lesson->layoutid == '22') echo "Webinar ". ++$l; 

				 //        else if($lesson->layoutid == '2') echo "Assignment ".++$i;

				 //        else echo "Lecture ". ++$j;



				 //        echo "</a>";					

				 //        }

					// }

					// else{	

					// 	echo "<a>";

					// 	if($lesson->layoutid == '12') echo "Exam ". ++$k; 

				 //        else if($lesson->layoutid == '22') echo "Webinar ". ++$l; 

				 //        else if($lesson->layoutid == '2') echo "Assignment ".++$i;

				 //        else echo "Lecture ". ++$j;



				 //        echo "</a>";			

				 //        }	





            	// if($lesson->layoutid == '12')

            	// {

            	// 	echo "<a href='".base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id."' >Exam ". ++$k."</a>";

            	// }

            	// else if($lesson->layoutid == '22')

            	// {

            	// 	echo "<a href='".base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id."' >Webinar ". ++$l."</a>";

            	// }

            	// else if($lesson->layoutid == '2')

            	// {

            	// 	echo "<a href='".base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id."' >Assignment ".++$i."</a>";

            	// }

            	// else

            	// {

            	// 	echo "<a href='".base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id."' >Lecture ". ++$j."</a>";

            	// }



           ?><!--<a href="<?php //echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='<?php //echo ($not_show === TRUE) ? "fancybox fancybox.iframe" : '';?>' ><?php //echo "Lecture ". ++$j ;?></a>--></h4>

			<div class="smltext1"> 

			    <?php

			    	if($sequential)

			    	{	

			    		   $lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$user_id,$programs->id);

			    		  

			    		   end($complated_lecture_ids);      

						   $lec_key1 = key($complated_lecture_ids);

			    		   $lec_key = array_search($lesson->id,$complated_lecture_ids);

			    		   $lec_key2= $lec_key1+1;

			    		  

			    		if(current($lecture_ids)==$lesson->id)

			    		{

			    ?>



			    	<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

			    	<?php if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

									{	?>

			    		<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php	}

									else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

									{ 

								?>

			    	<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php }

										// && $lesson->release_date <= gmdate('Y-m-d', time())

								else if($programs->release_type == '2')

									{

										$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

										$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

										if($lect_date <= $currdate1)

										{

									?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

									<?php }

										else{	?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 									<?php	}

									}

									else{	?>

								<?php	} ?>

					<?php echo $lesson->name; ?></a> 

				

			    <?php

			    		}

			    		else

			    		{	

			    			//echo $lec_key1.'='.$lecture_ids[$lec_key2]; 

			    			if($lec_key || $lecture_ids[$lec_key2] ==$lesson->id)

			    			{

			    				if($my_viewed_lesson_total>=1)

			    				 {

			    ?>

			   		<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

					<?php if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

									{	?>

			    		<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php	}

									else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

									{ 

								?>

			    	<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php }

										// && $lesson->release_date <= gmdate('Y-m-d', time())

								else if($programs->release_type == '2')

									{

										$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

										$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

										if($lect_date <= $currdate1)

										{

									?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

									<?php }

										else{	?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 									<?php	}

									}

									else{	?>

								<?php	} ?>					<?php echo $lesson->name; ?></a> 

				



			    <?php      

			    				}

			    				else

			    				{

			    					?>

			    					<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

						<?php if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

									{	?>

			    		<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php	}

									else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

									{ 

								?>

			    	<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php }

										// && $lesson->release_date <= gmdate('Y-m-d', time())

								else if($programs->release_type == '2')

									{

										$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

										$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

										if($lect_date <= $currdate1)

										{

									?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

									<?php }

										else{	?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 									<?php	}

									}

									else{	?>

								<?php	} ?>								<?php echo $lesson->name; ?></a>

			    					<?php

			    				}



			    			}

			    			else 

			    			{ 

			    				 

			    ?>

						    	<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

						<?php if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

									{	?>

			    		<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php	}

									else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

									{ 

								?>

			    	<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php }

										// && $lesson->release_date <= gmdate('Y-m-d', time())

								else if($programs->release_type == '2')

									{

										$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

										$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

										if($lect_date <= $currdate1)

										{

									?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

									<?php }

										else{	?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 									<?php	}

									}

									else{	?>

								<?php	} ?>								<?php echo $lesson->name; ?></a> 

				

			    <? 

			    			 //}

                           }



			    		}

			    	}

			    	else {



			    		$urlCourse1 = strtolower($programs->name);			

						$urlCourse1 = trim(str_replace(' ', '-', $urlCourse1));

						$urlCourse1 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse1);

			    ?>

			    	<!-- <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > -->

			    	<i class="<?php echo $entypo;?>" style="margin-right:10px"></i>

						<?php if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

									{	?>

			    		<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php	}

									else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

									{ 

								?>

			    	<a class="right-content" href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

								<?php }

										// && $lesson->release_date <= gmdate('Y-m-d', time())

								else if($programs->release_type == '2')

									{

										$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

										$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

										if($lect_date <= $currdate1)

										{

									?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 

									<?php }

										else{	?>

			    	<a class="right-content"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' style="float:left; margin-top: 12px;" > 									<?php	}

									}

									else{	?>

								<?php	} ?>

				<?php echo $lesson->name; ?></a> 

				

			    <?php

			    	}

			    ?>

				<!--Available: -->	

				<?php

				

				if($sequential)

				{	

					$lesson_viewed3 = $this->program_model->getViewLesson($lesson->id,$user_id,$programs->id);



					if($j == 1)

			    		{

			    			if($lesson_viewed3)

					        {

					        	if($lesson->layoutid == '12')

				  				{  

			   			 ?>

			    			<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:3px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Retake Quiz</a> </div>



			    <?php

			    				}

			    				else

			    				{

			    			?>

			    			<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:3px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

			    			<?php	

			    				}

			    			}

			    			else

			    			{

			    				if($lesson->layoutid == '12')

				  				{  

			    ?>

			    				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Take Quiz</a> </div>



			    <?php

			    				}

			    				else

			    				{	if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

									{	?>

										<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

								<?php	}

									else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

									{ 

								?>

								<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

								<?php }

										// && $lesson->release_date <= gmdate('Y-m-d', time())

								else if($programs->release_type == '2')

									{

										$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

										$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

										if($lect_date <= $currdate1)

										{

									?>

									<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

									<?php }

										else{	?>

											<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

									<?php	}

									}

									else{	?>

										<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>

								<?php	}

			    				}

			    			}

			    		}

					else

					{

					if($lesson_viewed3)

					{



						if($lesson->layoutid == '12')

				  		{ 

				?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:3px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Retake Quiz</a> </div>

                   <?php

                   		}

                   		else

                   		{

                   	?>

                   		<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:3px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

                   	<?php

                   		}

                   	}

                   	else

                   	{

                   		$prev_lesson_id = $lesson->id - 1;

			    	   $lesson_Prev_viewed = $this->program_model->getPreviousViewLesson($prev_lesson_id,$user_id);

			    			 

                   		if($lesson_Prev_viewed)

                   		{



                   		 if($lesson->layoutid == '12')

				  		  {	

			    		 

			        ?>	

                   		<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Take Quiz</a> </div>		

                   	<?php

                   		  }

                   		  else

                   		  {	if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

								{	?>

									<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

							<?php	}

								else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

								{ 

							?>

							<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

							<?php }

									// && $lesson->release_date <= gmdate('Y-m-d', time())

							else if($programs->release_type == '2')

								{

									$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

									$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

									if($lect_date <= $currdate1)

									{

								?>

								<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

								<?php }

									else{	?>

										<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

								<?php	}

								}

								else{	?>

									<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>

							<?php	}

                   		  }

                   		}

                   		else

                   		{

                   		 if($lesson->layoutid == '12')

				  		  {	

                   	?>

                   		<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="javascript:void(0)" class="revisit_btn">Take Quiz</a> </div>		

               <?php

               			  }

               			  else

               			  {	if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

								{	?>

									<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

							<?php	}

								else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

								{ 

							?>

							<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

							<?php }

									// && $lesson->release_date <= gmdate('Y-m-d', time())

							else if($programs->release_type == '2')

								{

									$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

									$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

									if($lect_date <= $currdate1)

									{

								?>

								<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

								<?php }

									else{	?>

										<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

								<?php	}

								}

								else{	?>

									<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>

							<?php	}

               			  }

               			}

               		}

               	  }

                }

                else

				{

				if($lesson_viewed)

				{



				 ?>

				 <?php



				if($lesson->layoutid == '12')

				  {      

				 ?>

				 <div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Retake Quiz</a> </div>

				 <?php

				  }

				  else

				  {

				 ?>

 				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin-top:3px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

				

				<?php

				}

				}

				else

				{

				?>

				<?php

				if($lesson->layoutid == '12')

				  { 

				?>

<!-- 				<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Exam</a> </div>

 -->					<!-- ---- -->

					<?php 

						if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

					{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Quiz</a> </div>

				<?php	}

					else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

					{ 

				?>

				<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Quiz</a> </div>

				<?php }

						// && $lesson->release_date <= gmdate('Y-m-d', time())

				else if($programs->release_type == '2')

					{

						$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

						$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

						if($lect_date <= $currdate1)

						{

					?>

				<div id="sidebar<?php echo $hover_id;?>" style="float:right;margin-top:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">Start Quiz</a> </div>

					<?php }

						else{	?>

							<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Quiz Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

					<?php	}

					}

					else{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Quiz Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>

				<?php	}



					 ?>

					 <!-- ----- -->

				<?php

				}

				else

				{	if(isset($programs->is_drip_course) && $programs->is_drip_course == '0' && ($programs->release_type == '0' || $programs->release_type == ''))

					{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

				<?php	}

					else if($programs->release_type == '1' && $lesson->release_date <= $currdate1)

					{ 

				?>

				<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

				<?php }

						// && $lesson->release_date <= gmdate('Y-m-d', time())

				else if($programs->release_type == '2')

					{

						$buy_date1 = str_replace('-', '/', $enrolldata->buydate);

						$lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));

						if($lect_date <= $currdate1)

						{

					?>

					<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"> <a href="<?php echo base_url()."lessons/lesson/".$programs->id."/".$day->id."/".$lesson->id;?>" class="revisit_btn">View Lecture</a> </div>

					<?php }

						else{	?>

							<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lect_date."</a>" ?> </div>

					<?php	}

					}

					else{	?>

						<div id="sidebar<?php echo $hover_id;?>" style="float:right; margin:0px;"><?php echo "Lecture Start On:<a style='color:#f30473'> ".$lesson->release_date."</a>" ?> </div>

				<?php	}



			    }	



				}

			}

				?>

				

				<!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">View lecture</a>--> 

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



    </li>

    <?php

    } // end of foreach lessions
    
    $course_id = $programs->id;
    $section_id = $day->id;
    $assignment = $this->Crud_model->GetData('mlms_assignment',"","trash = 0 and course_id = ".$course_id." and section_id = ".$section_id);
    foreach ($assignment as $key) {
    	$cond = "user_id = ".$user_id." and assign_id = ".$key->assign_id;
		$is_submitted = $this->Crud_model->get_single('mlms_assignment_submitted',$cond,"attempts");
    ?>
<!-- assignment block -->
		<li id="assign_id">
    		<div class="cattext1" style="display: inline-block; width: 100%;">
				<?php if(!empty($is_submitted)){ ?>
				<h4 style="float: right;">
            		<div class="ci-progress-container">
						<div class="check-mark">
							<i class="fa fa-check" aria-hidden="true"></i>
	         			</div>		
					</div>
				</h4>
				<?php }else{ ?>
				<h4 style="float: right;">
		            <div class="ci-progress-container"></div>
				</h4>
				<?php } ?>
				<div class="smltext1"> 
			    	<i class="entypo-doc-text" style="margin-right:10px"></i>	
			    	<a class="right-content" href="<?php echo base_url().'assignment/'.$course_id.'/'.$section_id.'/'.$key->assign_id;?>" style="float:left; margin-top: 12px;"><?php echo ucwords($key->assign_title);?></a>
					<div id="sidebar7" style="float:right; margin:0px;">
						<a href="<?php echo base_url().'assignment/'.$course_id.'/'.$section_id.'/'.$key->assign_id;?>" class="revisit_btn">Assignment</a>
					</div>
				</div>
	      	</div>
	    </li>
    <?php }

	?>





    </ul>

    </div>

    </div>
</div>
</div>
    <?php

}

?>



<?php

/*

echo '<pre>';

print_r($programs);

echo '</pre>';*/



if(isset($programs->id_final_exam) && ($programs->id_final_exam > 0))

{

?>

    <div class="leftcontent"> 

        <div class="title"><?php echo "Final Quiz ";

        echo $programs->certificate_course_msg ? "(".$programs->certificate_course_msg.")" : ""; ?></div>

        <div class="submtwo">

          <?php				 

			$finalexaminfo = $this->program_model->getQuiz($programs->id_final_exam);

		    $takenwhere = array(

			'user_id'      => $user_id,

        

			'quiz_id'      => $programs->id_final_exam

        

			);

        

			$quiztakeninfo = $this->program_model->getQuizTaken($takenwhere);

        

			if($user_id >0 && $programs->is_drip_course == 1 && $coursetype_details[0]["lessons_show"] == 1 && $not_show === TRUE){

        

			if($coursetype_details[0]["course_type"] == 1)

			{

				if($coursetype_details[0]["lesson_release"] == 1)

				{

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

        

        $viewedLessonIds = explode('||',trim(@$ViewedLessons[0]['lesson_id'],'|'));

        

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

        

        if(($user_id >0) && $not_show === TRUE)

		{        

			?>

            <a href="<?php echo ($finalexamactiveflag) ? base_url().'lessons/finalexamnew/'.$programs->id.'/'.$programs->id_final_exam.'/'.$lesson->id : 'javascript:void(0);'?>"> <span class="btn btn-danger"> Final Quiz:<?php echo $finalexaminfo->name;?></span></a>

            <?php 

		}

		else

		{

			?>

            <?php

		}

		?>

            <div class="view" id="viewed-2">

              <?php count($quiztakeninfo);?>

              <!--<img style="display:<?php echo (count($quiztakeninfo) > 0) ? '':'none';?>" align="viewed" src="">--> </div>

            <div class="level"> <img src=""> </div>

            <hr style="margin-bottom:0;" />

          </div>

        </div>

    </div>

    <?php

}

?>

<!-- final exam view End -->

	



   <!--  <div><input style="margin-right: 10px;" type="button" value="View Notes" class="btn btn-orange view_notes_btn" onclick="window.open('<?php echo base_url();?>programs/pdf/<?php echo $this->uri->segment(3);?>'); return false;"> <a class="btn btn-success down_notes_btn" href="<?php echo base_url(); ?>programs/pdf/<?php echo $this->uri->segment(3); ?>" download>Download Notes</a></div> -->



    <?php

    ?>

    </div>



    </div></div></div>

    <?php } ?>

    <!-------------Left-Section-Ends---------------------- --> 

      

      <!-------------Right-Section-Start---------------------- -->

   

      

      <div class="lecture_reviews" style="padding-left: 0; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.15);">

        <div class="tabs-vertical-env">

          <ul class="nav nav-tabs bordered">
          	<li class="active"> <a href="#v-diss" data-toggle="tab"><span class=""><i class="lnr lnr-bubble"></i>Discussions</span> </a> </li>

            <!--<li> <a href="#v-anno" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs"><i class="entypo-megaphone"></i>Announcements</span> </a> </li>-->

            <?php

            $iii =0;

            $aaa =0;

            foreach ($students as $key) 

            {

            	// echo"<pre>";

            	// print_r($key);

            	$user = $this->program_model->getStudentsInfo($key['userid']);

            	//echo $user->id."<br/>";

            	// echo"<pre>";

            	// print_r($user);

            	if($user)

            	{

			    if(@$user->id != @$user_id)

				{	

					

					$iii++;	

				}

			  }

				

				

            }

            

            ?>

            <li> <a href="#v-user" data-toggle="tab"><i class="fa fa-files-o" aria-hidden="true"></i>Exercise Files</span> </a> </li>  <!--href="<?php echo base_url();?>programs/students/<?php echo $programs->id?>"-->

			<li> <a href="#v-note" data-toggle="tab"> <i class="lnr lnr-pencil"></i>Notes</span> </a> </li> 



          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="v-diss">

				<div class="commentblock"> <br />

                <div class="diss_search_box">

                  <!--<input type="text" id="searchtext" class="search_box" name="searchtext" value="" placeholder="Search For Discussions" style="margin:0;">-->

                  <textarea id="txt_notes" placeholder="Search For Discussions" ></textarea>

                  <span class="or">or </span><a rel="leanModal" onclick="showDiscussdiv()" name="signup" href="#signup" style="margin-top: -10px;" class="responsive_download btn btn-info">Add Discussion</a> </div>

           		

                <ul class="comments-list1" id = "queAns">

					<?php					

					

					foreach ($quizcomment as $quizComment)

					{

						/*echo '<pre>';

						print_r($quizcomment);

						echo '</pre>';*/

						$userData = $this->program_model->getStudentsInfo($quizComment['user_id']);

						if(!empty($userData))
						{
							$my_image = $userData->images;
							if(!empty($my_image))
							{    
								$filepath = "";
								$files = $_SERVER['DOCUMENT_ROOT']."/public/uploads/users/img/".$my_image;
								if (file_exists($files)) {
								$my_image = "public/uploads/users/img/".$my_image;
								}
								else{
									$my_image = "public/uploads/users/img/thumbs/".$my_image;
								}
							}
							else{
								$my_image = "public/uploads/users/img/default.jpg";
							}

						    $lessonName = NULL;

							if($quizComment['lesson_id'])

							{

								$lessonName = $this->program_model->getLessonName_new($quizComment['lesson_id']);

								//print_r($lessonName);

							}

						?>

						<li>

							<div class="comment">

								<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url().$my_image;?>" alt="" class="img-circle" width="44"> </a> </div>

								<div class="comment-content">

								<div class="comment-author" style="font-size: 13px;"> <a href="#">

								<span class="comment_user_name">

									<?php echo @$userData->first_name.' '.@$userData->last_name;?>

								</span>

								</a>

								<div class="comment-info"><?php  $timeago=get_timeago(strtotime($quizComment['dateandtime']));echo $timeago;?>

								</div>

								</div>

								<div class="comment-head"><?php echo $quizComment['query_title']?></div>

								<div class="comment-text"><?php echo $quizComment['query_text']?></div>

								<a href="javascript:void(0);" class="liked like_dis" id="like<?php echo $quizComment['query_id']; ?>"  style="margin: 0 45px;margin-left:0px;"> <i class="entypo-heart"></i>

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

									?>

									<a href="javascript:void(0);" id="comment<?php echo $quizComment['query_id']; ?>" class="comment_dis" onclick="show_div(<?php echo $quizComment['query_id']; ?>)"> <i class="entypo-comment"></i>Comments <span id="comment_count<?php echo $quizComment['query_id']; ?>">(<span id="countComment<?php echo $quizComment['query_id']; ?>" ><?php echo $countcomment->count1; ?></span>)</span></a> 

									

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

														<!--<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>-->

														<div class="comment-content">

															<div class="comment-author" style="font-size: 13px;"><a href="#">

															<span class="comment_user_name">

															<?php echo @$userData->first_name.' '.@$userData->last_name;?></a>

															</span>

															<div class="comment-info">

															<?php $timeago=get_timeago(strtotime($answer['dateandtime']));echo $timeago;?>

															</div>

																	</div>

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

													<div class="valid" style="color:red"></div>

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

					<!-- count code start-->

					<?php

					 $this->load->helper('url');

					$seg = $this->uri->segment(3);

					$totaldescuss = $this->program_model->getCountAllLessonQuery($seg);

					if(!empty($totaldescuss))

					{

					   if($totaldescuss->count1 > 10)

					   {

					?>

					<li> <a class="btn" onclick="showAllDiscuss();" >Load More</a></li>

					<?php

					}

					}

					?>

					<!-- count code end-->

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

        

       

        <div class="clr"></div>

        <?php

        $program_id = $this->uri->segment('3');

        $lessons = $this->program_model->getLectExercise($program_id);

          $exercise_count = 0;

        foreach ($lessons as $lesson_data) {

          

          $exercise = $lesson_data->lecturemedias;

    // echo $exercise;

        if(($CI->program_model->checkEnrolled($user_id,$program_id)) && !empty($exercise))  

        {   $exercise_count++;

          ?>

          <div class="rightsidebar" style="">

              <?php 

               $get_media_ids2 = explode(',',$exercise);

               if($get_media_ids2 )

               {

                echo "<a><h4>".$lesson_data->name."</h4></a>";

               }

          foreach($get_media_ids2 as $get_media_id)

          { 

            $exfileinfo = $CI->program_model->getExercise($get_media_id);   

            if($exfileinfo->type=='file')

            {

              $pathurl = 'files';

            } 

            if($exfileinfo->type=='image')

            {

              $pathurl = 'images';

            }       

            if($exfileinfo->type=='video')

            {

              $pathurl = 'videos';

            } 

            if($exfileinfo->type=='docs')

            {

              $pathurl = 'documents';

            }

           

            echo '<a target="_blank" style="color:#0C0C0C; text-align:left; padding-bottom:10px; display: block;" href="'.base_url()."public/uploads/$pathurl/".$exfileinfo->media_title.'"> <i class="entypo entypo-play"></i>'.ucfirst($exfileinfo->alt_title).' <span style="font-size:12px; color: #353639;">('.$pathurl.')</span>'.'<i class="entypo entypo-download" style="color:#696969;"></i></a>';

          }

          ?>

      </div>

            <?php 

        }

    }

     if($exercise_count == 0)

      {

        echo "<p>No lecture file available for access.</p>";

      } ?>



            </div>

          </div>

        </div>

		</div> 



		<div class="tab-pane" id="v-note"> 

              <ul class="comments-list1">

                <li>

                  <div class="comment">               

                    <div class="comment-content">

                    	<a style="margin-right: 10px;" class="view_notes_btn" onclick="window.open('<?php echo base_url();?>programs/pdf/<?php echo $this->uri->segment(3);?>'); return false;">View Notes</a> 

                    	<a class="down_notes_btn" href="<?php echo base_url(); ?>programs/pdf/<?php echo $this->uri->segment(3); ?>" download>Download</a>

						<!-- There are no more announcements to show at this time. -->

                    </div>

                  </div>

                </li>

              </ul>

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

// function show_sidebar(idd)

// {

// 	if(document.getElementById(idd).id  == idd)

// 	{

// 		document.getElementById('sidebar'+idd).style.display = "block";

// 		//document.getElementById('sidebar').style.visibility = 'visible';

// 	}

// }



// function hide_sidebar(idd)

// {

// 	if(document.getElementById(idd).id  == idd)

// 	{

// 		document.getElementById('sidebar'+idd).style.display = "none";

// 	}

// }



function sideshow(id)

{

	document.getElementById('start'+id).style.display = "block";

	document.getElementById('tool'+id).style.display = "block";

}

function sidehide(id)

{

	document.getElementById('start'+id).style.display = "none";

	document.getElementById('tool'+id).style.display = "none";

}

function toolshow(id)

{

	document.getElementById('tool'+id).style.display = "block";

}

function toolhide(id)

{

	document.getElementById('tool'+id).style.display = "none";

}

</script>

<script type="text/javascript">

// 	$(document).ready(function () {



// 	//	document.getElementsByClassName('start').style.visibility='hidden';

// 		var appBanners = document.getElementsByClassName('start'), i;



// for (i = 0; i < start.length; i += 1) {

//     start[i].style.display = 'none';

// }

// 	});

</script>

<script type="text/javascript">

	$(document).ready(function () {

    $('.review_modal_close').click(function() {

        $("#review").hide();			

        $("#review_lean_overlay").hide();			

    });

});

</script>



<script type="text/javascript">

	$(document).ready(function () {

    $('.discuss_modal_close').click(function() {

        $("#discussion").hide();			

        $("#discussion_lean_overlay").hide();			

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

			

			$("#btnReview").on('click',function(){

				var rate = $('#rate').val();

				var title = $('#review_title').val();

				var desc = $('#review_desc').val();

				var pro_id = <?php echo $programs->id;  ?>;

				var dataRate = rate; //

				

                		

			

			    // $("#review").hide();			

                // $("#review_lean_overlay").hide(); 

                $.ajax({

                    type : "POST",

                    url : "<?php echo base_url(); ?>programs/add_reviews",

                    data    : {'review_point':dataRate,'pro_id':pro_id,'title':title,'desc':desc},

                    success:function(data){ 



                    		//$("#pay_main_cont1").html('<p>Thank you for your reviewing this course.</p>'); 

                    		$("#pay_main_cont1").slideUp('slow', function() {

                     			$("#review").append('<p style="color:green; padding-left: 22px;"><h4>Thank you for your reviewing this course.</h4></p>');

								});

                    		setTimeout(

						function() 

						{

							$("#review").hide();			

                			 $("#review_lean_overlay").hide();

							

						}, 2500);	

                    	

						$('#go_reviews').html('<i class="entypo-pencil"></i>'+data); 

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

				

                		

			

			    // $("#review").hide();			

                 //$("#review_lean_overlay").hide(); 

                $.ajax({

                    type : "POST",

                    url : "<?php echo base_url(); ?>programs/update_reviews",

                    data    : {'review_point':dataRate,'pro_id':pro_id,'title':title,'desc':desc,'review_id':review_id},

                    success:function(){



                    		$("#pay_main_cont1").slideUp('slow', function() {

                     			$("#review").append('<p style="color:green; padding-left: 22px;"><h4>Thank you for your reviewing this course.</h4></p>');

								});

                    		setTimeout(

						function() 

						{

							$("#review").hide();			

                			 $("#review_lean_overlay").hide();

							

						}, 2500);

                     }

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

      <a class="review_modal_close" href="#"><span class="lnr lnr-cross"></span></a>

      

      

      <div id="pay_main_cont1" class="pay_main_cont">        

        

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

			<input type="button" name="btnReview" id="btnReview" value="Submit" class="btn-primary_red" style="margin:0"/>

		</div>        

      </div>	

  </div>



</div>  

<div id="review_lean_overlay" style="display: none; opacity: 0.5;"> </div> 



<!--Discussion Pop-up-->

<div id="discussion"  style="display: none;">

  <div id="payment-ct">

    

      <h3 class="general-heading">Add Discussion</h3>

      <a class="discuss_modal_close" href="#"><i class="entypo-cancel-squared"></i></a>

      

      

      <div class="pay_main_cont">        

        

        <div class="tab-content">

          <div><textarea name="query_title" id="query_title" placeholder="Type your discussion title here and any details below" style="width:360px;height:40px"></textarea> </div>

		   <input type="hidden" name="lqprogid" id="lqprogid" value="<?php echo $course_id; ?>" />

		  <div style = "overflow-x: scroll;max-height: 200px;"><textarea name="query_text" id="query_text" placeholder="Discuss the course and topics related it its fields. No promotions please."></textarea></div>

  		      

	       <div><input class="btn btn-success" type="button" onclick="postDisscussion()" name="querysubmit" id="querysubmit" value="POST" /> </div>		  

        </div>        

      </div>



  </div>

</div> 

<div id="discussion_lean_overlay" style="display: none; opacity: 0.5;"> </div>



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

           url: "<?php echo base_url(); ?>programs/follow",

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

           url: "<?php echo base_url(); ?>programs/following",

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

    

    //$('#comment_box'+id).redactor();

	

}

</script>



<script>

function add_comment(query_id,pid)

	{

	   

	   //alert("yes");

        var answer = $('#comment_box'+query_id).val();

        alert(answer);

		 if(answer !=''){

        var listresult = '';

		var querylist = '';

			

         $.ajax({

           type: "POST",

           url: "<?php echo base_url(); ?>programs/saveanswer",

            data    : {'query_id':query_id,'pid':pid,'answer':answer},

 

           success: function(data){

		       

			  if(data=='error'){

				alert("Teir was error while processing, try again!");

				}else{

		

					if(querylist == ''){

					querylist = 'No questions have been asked so far';

					}

				//$('#question_list'+querydata.query_id).html(querylist);

				$('#question_list'+query_id).html(data);

				countComment(query_id);

				$(document).find('#comment_box'+query_id).val('');

				}

		    }

 

         });

     }else{

 		$(document).find('.valid').html('Enter your comment!').fadeIn('slow');

 		$(document).find('.valid').fadeOut('10000');

        return false;  //stop the actual form post !important!

    }

 

      }//);

  // });

</script>


<script>

	function countComment(qid)

	{

		$.ajax({

			type:"post",

			url:"<?php echo base_url(); ?>programs/countComment",

			data:{'qid':qid},

			success:function(data)

			{

				//alert(data);

				//$("#countComment").html(data);

				$("#countComment"+qid).text(data);

			}



		});

	}



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

           url: "<?php echo base_url(); ?>programs/like",

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

           url: "<?php echo base_url(); ?>programs/unlike",

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

	   

	   if (document.getElementById("discussion_lean_overlay").style.display == 'block') {

               document.getElementById("discussion_lean_overlay").style.display = 'none';

       }else{

               document.getElementById("discussion_lean_overlay").style.display = 'block';

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

		url: "<?php echo base_url()?>programs/SaveAndGetQueryList",

		data: { 'query_title': querytitle_val, 'query_text': querycont_val, 'qpid': qpid_val }

		}).success(function( data ) {

				if(data=='error'){

		alert('Teir was error while processing, try again!');

		}else{

	

			getDiscussion(qpid_val);

		 $("#discussion").hide();

		 $("#discussion_lean_overlay").hide();



		//$("#comments-list1").html(querylist);

		}





		});

	}

</script>

<script>

	$(document).ready(function() 

	{

		$('#txt_notes').keydown(function() 

		{

			

		var searchitem = $('#txt_notes').val();

		var course_id =<?php echo $this->uri->segment(3) ?>;

		if (event.keyCode == 13)

		{		

		

			$.ajax({

			type: "POST",

			url: "<?php echo base_url(); ?>programs/searchDiscuss",

			data: {searchitem:searchitem,course_id:course_id}, 

			success: function(response)

			{	

					

				$("#queAns").html(response);				

			}

		  		});	

		

		

		$("#txt_notes").val('');

		return false;

		}

		});

	});

	

</script>

<script>

function getDiscussion(course_id)

{    

	$.ajax({

				type:"post",

				url:"<?php echo base_url();?>programs/getDiscussion",

				data:{course_id:course_id},

				success:function(data)

					{

						$("#queAns").html(data);

						$("#query_title").val("");

						$("#query_text").val("");

					}



			});

}

</script>

<script>



	$(document).ready(function()

	{

		$("#search_student").keydown(function()

		{

			var searchitem = $('#search_student').val();

			var course_id =<?php echo $this->uri->segment(3) ?>;

			if (event.keyCode == 13)

			{				

				$.ajax({

						type:"post",

						url:"<?php echo base_url();?>programs/getSearchStudent",

						data:{searchitem:searchitem,course_id:course_id},

						success:function(data)

						{

							//alert(data);

							$("#searchstudent").html(data);

						}

					  });

		$('#search_student').val("");

		return false;

			}

		});



	});



</script>

<script>

	function showAllDiscuss()

	{

	var course_id =<?php echo $this->uri->segment(3) ?>;

	$.ajax({

				type:"post",

				url:"<?php echo base_url();?>programs/getAllDiscussion",

				data:{course_id:course_id},

				success:function(data)

					{

						//alert(data);

						$("#queAns").html(data);

						

					}



			});

		

	}

</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="<?php echo base_url() ?>public/Creating-Collapsible-Table-Rows/jquery.aCollapTable.js"></script>

<script>

  function	getmorewebinar(user_id,course_id)

  {  //morewebi

  	$.ajax({

				type:"post",

				url:"<?php echo base_url();?>programs/getmorewebinar",

				data:{user_id:user_id,course_id:course_id},

				success:function(data)

					{

						//alert(data);

						$("#webinarbody").html(data);

						$("#but").hide();

						

					}



			});

  }



</script>

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

var $j =jQuery.noConflict();

$j(document).ready(function(){

$j('.collaptable').aCollapTable({



	startCollapsed: true,



	addColumn: false,

	

});

});



//act-button-expand-all

$j(document).ready(function(){

$j('.act-button-expand-all').click(function()

        {	

        	//alert('yes');

            $(this).hide();

        });

});

$(document).ready(function() {
	var msg = $("#msg_redeem").html();	
	if(msg != '' && msg=='Congratulations')
	{
		var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"> Congratulations! You have successfully enrolled.</strong></div>';
		var note = $(document).find('#message1');
		note.html(str);
		note.show();
		note.fadeIn().delay(5000).fadeOut();
	}
	else if(msg != '' && msg=='Already')
	{
		var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"> Sorry! You already enrolled to this Course.</strong></div>';
		var note = $(document).find('#message1');
		note.html(str);
		note.show();
		note.fadeIn().delay(5000).fadeOut();
	}
  	
});
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

jQuery(document).ready(function(){
    jQuery("#expandall11").click(function(){
      for (i = 0; i < acc.length; i++) {
        acc[i].classList.toggle("active");
        var panel = acc[i].nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        }
      }
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