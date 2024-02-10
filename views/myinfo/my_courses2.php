<?php
$startTimeStamp = strtotime("2015-05-02");
$endTimeStamp = strtotime("2015-05-10");

$timeDiff = abs($endTimeStamp - $startTimeStamp);

$numberDays = $timeDiff/86400;  // 86400 seconds in one day

// and you might want to convert to integer
//echo $numberDays = intval($numberDays);


?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style type="text/css">
.my_course_section .table-scroll-resp.inner_pages_table {
    display: flex;
    flex-wrap: wrap;
}
.fancybox-custom .fancybox-skin {
	box-shadow: 0 0 50px #222;
}
.inner_pages_table {
    margin-top: 40px;
    display: inline-block;
    width: 100%;
}
.cardhover:hover img {
    opacity: 0.6;
}
.play-button {
    height: 100%;
}
.cardhover:hover .play-button{
    transition: 0.3s;
}
.cardhover:hover .play-button{
  display: block;
}
.cardhover {
  height: auto;
  display: block;
  position: relative;
  background: #29303b;
  overflow: hidden;
}
h5.card_heading2 a {
    color: #29303b;
    font-size: 15px;
}
h5.card_heading2 a:hover{
    color: #2d3b92;
}
.cardhover img {
    min-height: 100px;
}
.card {
    padding-bottom: 15px;
    margin-bottom: 15px;
}
.progress.jonas {
  font-size: 13px;
  color: #555 !important;
  background: transparent;
  margin-bottom: 0px;
  box-shadow: none;
  padding-top: 3px;
}
.play-button{
  display: none;
}
.info_container {
    width: 1080px;
    max-width: 100%;
}
p.jonas {
    font-size: 14px;
    color: #29303b;
}
.btn-success {
    background-color: #04A600;
    padding-left: 3px;
}
.my_course_section {
    display: flex;
    width: 100%;
    margin: 0px -7px;
}
.btn-primary_rockon {
    white-space: nowrap;
    float: left;
    width: 80px;
    color: #fff;
    padding: 0px 10px 5px 4px;
    font-size: 12px;
 }
 .sidebar-menu.sb-left {
    display: none;
}
#left_menu_sidebar {
  display: none;
}
@media(max-width:991px){
.item-item.res_col {
    width: 33.33%;
}
.my_course_section {
    margin: 0px 0px;
}
p.jonas {
   margin-bottom: 10px !important;
}
}
@media(max-width:600px){
.item-item.res_col {
    width: 50%;
}
}
@media(max-width:480px){
.item-item.res_col {
    width: 300px !important;
    margin: 0 auto 20px auto;
    float: unset;
}
}

</style>

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
    function renewCourseClick(message, course_id, price, buy_id ,path)
    {
    	//var m_value = confirm(message);
    		var str ='<p style="padding-top: 22px; padding-left: 18px;padding-right: 12px;font-weight: 700;">'+message+'</p>';
    		$j.confirm({
    			title: '',
    			content: str,
    			confirmButton:'Yes',
    			confirm: function(){
        				//window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
   						$j.colorbox({
   							//iframe:true,
                               width:"400px", 
                               height:"57%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true, 
   							href:"<?php echo base_url(); ?>myinfo/subscription_plan_popup/"+course_id+"/"+price
   						    });

   						 },
    			cancel: function(){
        			//return true;
   					 }
				});



		// if(m_value == true)
		// {
		// 	//window.location.href = path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id;
		// 	window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
		// }
		// //alert(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
		// return false;
	}


	function subscribeRenewCourse(message, course_id)
    {
    	var str ='<p style="padding-top: 22px; padding-left: 18px;padding-right: 12px;font-weight: 700;">'+message+'</p>';

    	$j.confirm({
    			title: '',
    			content: str,
    			confirmButton:'Yes',
    			confirm: function(){
        				//window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
   						$j.colorbox({
   							   width:"500px", 
                               height:"77%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
   							href:"<?php echo base_url(); ?>myinfo/subscription_plan_popup/"+course_id
   						});

   						 },
    			cancel: function(){
        			//return true;
   					 }
				});
	}
    </script>
	
	
	

<!--/lightbox scripts and style-->


<div class="page-container myinfo_page">
  <div class="main-content">
      <div class="info_page_breadcrumb">
        <div class="info_container">
          <h3>My Courses</h3>
          <p>This is a list of all the courses that you have subscribed to, completed,or are pursuing at the moment. You can renew your subscription/re-purchase any of the courses you have already completed / that have expired. Click on the name of the course to go to the courses.
          </p>
        </div>
      </div>
      <div class="content cources_main_content">
        <div class="info_container">	
          <?php
          $attributes = array('class' => 'tform', 'name' => 'myquiz');
          echo form_open_multipart(base_url().'my-courses/',$attributes);
          ?>
        		<div class="course_search" style="margin-top: 20px;  margin-right: 0px;">
        			<input type="text" value="" name="search_course" class="textbox" style="float:left; margin-right:10px; height:30px;" placeholder="Course Name">
        			<button type="submit" name="Submit" value="Search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>
        		</div>
            <?php echo form_close(); ?>
        		<div class="my_course_section">
        			<div class="col-md-12 col-xs-12 no-padding">
                	<div class="table-scroll-resp inner_pages_table">
          					<?php
                    $this->load->model('admin/users_model');
                      $i=1;        
                   	foreach($courses as $course)
                   	{
                    $catid = $this->category_model->getCatSlugbyId($course->cateid);
                    $get_teacher = $this->users_model->getUserName($course->author);
                     	$bool_expired = false;
                      $expire = "Expires";
                      $no_renew = false;
                      if($course->expired_date == "0000-00-00 00:00:00")
                      {
                          $date = '<span class="guru_active">Unlimited Plan</span>';
                          $no_renew = true;
                      }
                      else
                      {
                          $datetime2 = new DateTime($course->expired_date);
                          $interval = date_create('now')->diff($datetime2);
                          $replacedays  = str_replace('days','',$interval->format('%R%a days'));
                          $replaceplus  = str_replace('+','',$replacedays);
                          $replacefinal  = str_replace('-','',$replaceplus);
                          $bool_expired = false;
                          if(0 < trim($replacedays))
                          {
                              $bool_expired = true;
                              $expire = "Expires";
                              $date_int = strtotime($course->expired_date);
                              $date = '<span class="expired"> in '.$replacefinal.'Days</span>';
                          }
                          else if(0 > trim($replacedays))
                          {
                              $bool_expired = false;
                              $expire = "Expired";
                              $date_int = strtotime($course->expired_date);
                              $date = '<span class="active"> before '.$replacefinal.'Days </span>';
                          }
                          else if(0 == trim($replacedays))
                          {
                              $bool_expired = true;
                              $expire = "Expires";
                              $date = '<span class="active"> Today </span>';
                          }
                      } 
                      $nr_orders = $this->Myinfo_model->countCourseOrders($course->course_id,$user_id);
                      $urlCourse = $course->slug;

                      ?>
          					<div class="item-item col-md-3 col-sm-3 col-xs-6 res_col ">
                          <!-- <a href="<?php //echo base_url().$catid.'/category/'.$course->slug; ?>"> -->
            					    <a href="<?php echo base_url().'online-courses/'.$course->slug; ?>">
            					        <div class="card">
          					            <div class="cardhover">
          					                <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $course->course_image ? $course->course_image : 'no_images_course.png'; ?>" width="100%">
                                    <div class="play-button">
                                    </div>
          					                <div class="overlay">
          					                    <div class="text">
          					                        <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $course->course_image;?>" class="img-thumbnail" width="50px" height="50px">
          					                        <br>
          					                        <p> Lectures </p>
          					                    </div>
          					                </div>
          					            </div>
                                <?php
                                $block_enrolled1 = $this->program_model->checkblockenroll($course->course_id, $user_id);
                                $block_enrolled =count($block_enrolled1); 
                                if($block_enrolled > 0)
                                { ?>
                                  <h5 class="card_heading2"><a href="#" onclick="showmsg();"><?php echo $course->course_name; ?></a></h5>
                                <?php } else { ?>
                               <h5 class="card_heading2">
                               <a href="<?php echo base_url();?><?php echo $urlCourse ?>/lectures/<?php echo $course->course_id ?>"><?php echo $course->course_name; ?></a>
                               </h5>
                                <?php } ?>
          					            <p class="jonas">
          					                <?php echo $get_teacher; ?>
          					            </p>
                                <?php $lecture_ids =array();
                                $complated_lecture_ids = array();
                                $my_lesson_total = 0;
                                $my_viewed_lesson_total = 0;
                                $bar_percentage = 0;
                                $programs = $this->program_model->getProgram($course->course_id);
                                $days = $this->program_model->getlistDays($course->course_id);
                                if($days)
                                {
                                  foreach ($days as $day)
                                  {
                                    $lessons = $this->program_model->getLessonNew($day->id);
                                    $my_lesson_total += count($lessons);

                                    foreach ($lessons as $lesson)
                                    { if($lesson->id)
                                      {
                                      array_push($lecture_ids,$lesson->id);
                                        }
                                      $lesson_viewed = $this->program_model->getCompletedLesson2($lesson->id,$user_id,$course->course_id);
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
          					            <center>
          					                <div class="progress" style="height: 5px !important; margin-bottom: 3px !important;width: 90% !important">
          					                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $bar_percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $bar_percentage;?>%"> <span class="sr-only"><?php echo $bar_percentage;?>% Complete (success)</span> </div>
          					                </div>
          					            </center>
          					            <p class="progress jonas"><?php echo $bar_percentage;?>% Completed</p>
          					          </div>
            					    </a>
          					</div>
                    <?php } ?>
          				</div>
          			</div>
          	  </div>
        	    <div id="rich-text3">
        		    <div class="weblet-inner">
        		    </div>
        	    </div>
        	    <div id="rich-text4">
        		    <div class="weblet-inner">
        		    </div>
        	    </div>
              </div>
              <div class="holder2">
          	    <div class="bottom-boxes">
          		    <div class="frame">
          		    <!--<div id="mrp-container3" class="box">  bvn </div>
          		    <div class="box">  vbnvnn </div>
          		    <div id="mrp-container5" class="box">    bnvnv
          		    </div>--> 
          		    </div>
          	    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	<script>
	function showmsg()
	{
		alert('Your Enrollment has Block ');
	}
	</script>


   <script>
   var $ =jQuery.noConflict();
			// (function($) {
				$(document).ready(function() {
					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			// }) (jQuery);
	</script>

<?php
function dateDiff($time1, $time2, $precision = 4) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 > $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
 break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
 // Add s if value is not 1
 if ($value != 1) {
   $interval .= "s";
 }
 // Add value and interval to times array
 $times[] = $value . " " . $interval;
 $count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  } 
?>


<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<style type="text/css">
  .data{
   margin:4%; 
   display: none;
  }
 
 

</style>

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){
                   	
                   	$('#more').click( function(){
    $(this).find('i').toggleClass('	glyphicon glyphicon-plus').toggleClass('glyphicon glyphicon-minus');
});

                               //Examples of how to assign the Colorbox event to elements
                               
                         //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});                        
                       $j(".viewexamresult").colorbox({
                               iframe:true,
                               width:"700px", 
                               height:"100%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
                               //initialWidth:"100",
                               nitialHeight:"50"
                                                                                                 
                                               })

                       $j(".viewsubscibe").colorbox({
                               iframe:true,
                               width:"500px", 
                               height:"500px",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
                               //initialWidth:"100",
                               nitialHeight:"50"
                                                                                                 
                                               })
                       

                   });

                        </script>



