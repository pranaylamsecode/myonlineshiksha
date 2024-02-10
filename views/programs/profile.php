<?php
  $hover_id = 1;
  $CI =& get_instance();
$CI->load->model('Program_model');
?>
<style>
.stars {
	width: 130px;
	height: 26px;
	background: url(http://sandbox.bumbu.ru/ui/external/stars.png) 0 0 repeat-x;
	position: relative;
}
.stars .rating {
	height: 26px;
	background: url(http://sandbox.bumbu.ru/ui/external/stars.png) 0 -26px repeat-x;
}
.stars i {
	display: none;
	position: absolute;
	top: 0;
	left: 0;
	height: 26px;
	width: 130px;
	cursor: pointer;
}
.stars i + i {
	width: 104px;
}
.stars i + i + i {
	width: 78px;
}
.stars i + i + i + i {
	width: 52px;
}
.stars i + i + i + i + i {
	width: 26px;
}
</style>
<style>
body {
	font-family: 'Open Sans', sans-serif;
	color: #555555;
	font-weight: 400;
	font-size: 14px;
	line-height: 20px;
}
label {
	margin-bottom:0 !important;
	padding: 10px !important;
	width:20%;
}
.span2 .tech_img {
	margin-left:0%;
	border: 10px solid #fff;
}
@media (max-width: 1280px) {
.span2 .tech_img {
	border-radius:10px;
	margin-left:0% !important;
}
}
@media (max-width: 980px) {
label {
	margin-bottom:0 !important;
	padding: 10px !important;
	width:auto !important;
}
.span2 .tech_img {
	border-radius:10px;
	margin-left:0% !important;
}
}
.btn {
	display: inline-block;
	padding: 4px 12px;
	margin: 4px 0;
	font-size: 14px;
	line-height: 20px;
	color: #333333;
	text-align: center;
	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	vertical-align: middle;
	cursor: pointer;
	background-color: #000;
	background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
	background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
	background-repeat: repeat-x;
	border: 1px solid #cccccc;
	border-color: #e6e6e6 #e6e6e6 #bfbfbf;
	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	border-bottom-color: #b3b3b3;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.tform textarea {
	width: 400px;
	height: 100px;
	padding: 4px;
	font-size: 12px;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
}
textarea {
	-webkit-appearance: textarea;
	overflow: auto;
	-webkit-rtl-ordering: logical;
	-webkit-user-select: text;
	flex-direction: column;
	resize: auto;
	cursor: auto;
	white-space: pre-wrap;
	word-wrap: break-word;
	letter-spacing: normal;
	word-spacing: normal;
	text-transform: none;
	text-indent: 0px;
	text-shadow: none;
	text-align: start;
}
textarea {
	font-family: inherit;
}
textarea {
	background-color: #ffffff;
	border: 1px solid #c7c8b2;
}
hr {
	margin: 20px 0;
	border: 0;
	border-top: 1px solid #eeeeee;
	border-bottom: 1px solid #ffffff;
}


.p40-0 {
padding: 40px 0;
}

.fxw, .df {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
width: 100%;
}

.tech_img
{
/*border: 10px solid #fff;*/
margin-left: 20px;
}

.mt20 {
margin-top: 20px;
}

.tac {
text-align: center;
}

.flex, .fx {
-webkit-box-flex: 1;
-webkit-flex: 1;
-ms-flex: 1;
flex: 1;
min-width: 1px;
}

.ml40 {
margin-left: 40px;
}

.fs48 {
font-size: 48px;
}

.m0 {
margin: 0;
}

.fw3, .light {
font-weight: 300;
}


.fs22 {
font-size: 22px;
}

.mt5 {
margin-top: 5px;
}

.mt5 {
margin-top: 5px;
}

.fw5, .fwn {
font-weight: 400;
}

.ita {
font-style: italic;
}

.fs18 {
font-size: 18px;
}

.mt20 {
margin-top: 20px;
}

.fw7, .bold, .fwb {
font-weight: 700;
}

.pos-r {
position: relative;
}

.collapsable-text {
overflow: hidden;
}

.fs18 {
font-size: 18px;
}

.lh18 {
line-height: 1.8;
}

.ins-details {
text-align: center;
}

.mt40 {
margin-top: 40px;
}

.flex-align-center, .fxac {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
width: 100%;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
}

.fxw, .df {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
width: 100%;
}

.container .ins-details li:first-child {
border: 0;
padding-left: 0;
}

.container .ins-details li {
border-left: 1px solid #ccc;
padding: 10px 20px;
}

.color-cirtus {
color: #9c0;
}

.fs34 {
font-size: 34px;
}

.fw7, .bold, .fwb {
font-weight: 700;
}

.color-grey-chateau {
color: #979da1;
}

.color-grey-chateau {
color: #999fa3;
}

.fs14 {
font-size: 14px;
}

.mt15 {
margin-top: 15px;
}

.color-persian-red {
color: #d33737;
}

.fs34 {
font-size: 34px;
}

.fw7, .bold, .fwb {
font-weight: 700;
}

@media (max-width: 768px) {

.instructor-wrapper .fxw {
-webkit-flex-direction: column;
-ms-flex-direction: column;
flex-direction: column;
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
width: 100%;
-webkit-box-align: center;
-webkit-align-items: center;
-ms-flex-align: center;
align-items: center;
padding: 10px;
}
.instructor-wrapper .ml40 {
margin-left: 0;
}
.instructor-wrapper h1 {
line-height: 1;
}
.controller-user h3 {
font-size: 13px;
line-height: 1;
}

.instructor-wrapper .ins-details {
-webkit-flex-direction: row;
-ms-flex-direction: row;
flex-direction: row;
font-size: 13px;
line-height: 1;
margin-top: 5px!important;
}
.controller-user li {
position: relative;
}
.instructor-wrapper .fs34 {
font-size: 21px;
}
.instructor-wrapper .ins-details li {
border-left: 1px solid #ccc;
padding: 10px 20px;
}
}

@media (max-width: 640px) {
	.instructor-wrapper {
text-align: center;
}

}

@media (max-width: 480px) {
/*.instructor-wrapper {
text-align: left;
}*/
}

@media (max-width: 320px) {
/*.instructor-wrapper {
text-align: left;
}	*/
}

</style>

<div class="container instructor-wrapper" style="background-color: #F4F4F4; box-shadow: 0 2px 2px rgba(0,0,0,.05);">
<?php
   
$attributes = array('class' => 'tform', 'id' => $teacher_info->id, 'email' => $teacher_info->email);
echo form_open_multipart('programs/send_mail', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/
?>
  <div class="fxw p40-0">
  
      <div class="">
      
        <div>
        	<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo (isset($teacher_info->images)) ? $teacher_info->images : 'temp.jpg'; ?>" width="260" id="imgname" class="tech_img"> 
        </div>
        
        <div class="mt20 tac soc"></div>
        <div class="mt20 tac"></div>
        
      </div>
        
      <div class="fx ml40">  <?php 
      			// echo"<pre>";
      			// print_r($teacher_info);
      			// echo"</pre>";
      								?>
        
        <h1 class="fs48 fw3 m0"><?php echo $teacher_info->first_name.' '.$teacher_info->last_name; ?></h1>
           
        <h2 class="mt5 fs22 fwn ita"> Designation: <?php echo $teacher_info->designation; ?> </h2>
       
          	<input type="hidden" name="teacher_id" value="<?php echo $teacher_info->id; ?>" />
          	<input type="hidden" name="teacher_email" value="<?php echo $teacher_info->email; ?>" />
          	<input type="hidden" name="your_name" value='<?php echo $name; ?>' />
            
        <h3 class="mt20 fs18 bold">Professional Details:</h3>
      
        <div style="clear:both;"></div>
         
		<div class="pos-r">  
        	<div class="fs18 lh18 collapsable-text" data-collapsable-text-height="400">   
       			<p></p>
        		<p style="font-size: 18px; line-height: 1.8;">
          	    </p><?php echo nl2br($teacher_info->prof_info); ?>
        	</div>
        </div>
        <?php
        $totalcourse =0;
        $totalreviews =0;
        $total_rating = 0;
        $total_enrolled =0;
        $counts_students1 = $this->program_model->enrolledUsers($teacher_info->id);     
			
			$suum1 =0;     
       
         foreach($teachingcourses as $teach_course)
         {
         	$totalcourse++;
         	$reviews = $this->program_model->getAllReview($teach_course->id);
          	
          				 
			$suum = count($reviews);
			$suum1+= $suum;
			
					
         	$counts_students = $this->program_model->getEnrolledUser($teach_course->id);
         	$total_enrolled += count($counts_students);
         	//print_r($reviews);
         	//$avg_rating = 0;
				if(count($reviews) > 0)
				{
					$total_rating = NULL;
					foreach($reviews as $review) 
					{
						$total_rating += $review->review_rate;
					}
					//$avg_rating = $total_rating/count($reviews);
					//$rate_percent = ($avg_rating/$total_rating)*100;
				}
				
         }
        //echo $totalreviews;
        ?>
        <ul class="mt40 fxw fxac ins-details">
    		<li>
    			<div class="color-cirtus fs34 bold"><?php echo count($counts_students1); ?></div>
    			<div class="color-grey-chateau fs14 mt15"><i class="entypo-user"></i>Students</div>
            </li>

    		<li>
    			<div class="color-persian-red fs34 bold"><?php echo $totalcourse; ?></div>
    			<div class="color-grey-chateau fs14 mt15"><i class="entypo-book"></i>Courses</div>
			</li>

    		<li>
    			<div class="color-persian-red fs34 bold"><?php echo $suum1;  //$total_rating; ?></div>
    			<div class="color-grey-chateau fs14 mt15"><i class="entypo-quote"></i>Reviews</div>
			</li>
		</ul>
  
      </div>
  
  </div>
  <!--<hr />-->
  
  
  <ul class="nav nav-tabs bordered" style="padding-top: 2px; text-align: center">
      <li class="active" style="border-bottom: 5px solid #c42140; float: none; padding-bottom: 0; background-color: #fff;cursor: default; display: inline-block;"> 
      <a href="#teaching" data-toggle="tab" style="border-radius: 4px 4px 0 0; margin-right: 0; font-size: 22px;"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs" style="color: #c42140; border: none; font-weight: 700;">Teaching</span> </a> 
      </li>
  </ul>
  
  <div class="tab-content" style="overflow:hidden; background-color:#FAFAFA; box-shadow: 0 2px 2px rgba(0,0,0,.05);">
    <div class="tab-pane active" id="teaching">
      <div id="main" role="main" class="coursescat">
        <div class="holder" id="mrp-container2">
          <div id="system-message-container"></div>
          <hr style="margin-top:0" />
          <div class="course_row">
            <ul class="course_cat" style="padding: 20px;">
              <?php 
					$total_enrolled = NULL;
					
					
				 foreach($teachingcourses as $teach_course){  
	
					$counts_students = $this->programs_model->getEnrolledUser($teach_course->id);
		   
					$default_plans = $this->program_model->getDefaultPlans($teach_course->id);
		   
					$reviews = $this->program_model->getAllReview($teach_course->id);
					
					$author = $this->Category_model->getAuthor($teach_course->author);
        $author_img = (isset($author->images)) ? $author->images : '';
        $first_name = (isset($author->first_name)) ? $author->first_name : '';
        $last_name = (isset($author->last_name)) ? $author->last_name : '';
        $lessonsch = array();
        $lessonshasvalue = false;
        $days = $CI->Program_model->getlistDays($teach_course->id);

		
		

				 ?>
              <li id='<?php echo $hover_id;?>' onmouseover="show_wishheart(this.id)" onmouseout="hide_wishheart(this.id)" >
                <div id="wishheart<?php echo $hover_id;?>"  class="btn btn-default btn-sm ud-wishlist" style="margin: 10px; position: absolute; z-index: 1; display:none;"> <i class="entypo-heart" style="color:#D04D66;"></i>
                  <?php 
			      $wishlisted = NULL;
			   foreach ($wishlist as $wish_list) 
					  {
						if($wish_list->program_id == $teach_course->id)
						{
						      $wishlisted = 'yes';
							  $wishlist_id = $wish_list->wishlist_id;
						}
					  }
			   ?>
                  <?php
                  $sessionarray = $this->session->userdata('logged_in');

				if($sessionarray)
				{
					if($wishlisted)
					{
			   ?>
                  <span class="in-wishlist none" onclick="ajax_deletewishlist(<?php echo $teach_course->id ?>,<?php echo $wishlist_id ?>,<?php echo $hover_id ?>)">Wishlisted</span>
                  <?php
				    }
					else
					{
				?>
                  <span class="not-in-wishlist" onclick="ajax_addwishlist(<?php echo $teach_course->id ?>,<?php echo $hover_id ?>)">Wishlist</span>
                  <?php
				    }
				 }
				 else
				 {
				 ?>
                   <span class="not-in-wishlist" onclick="showmsg();">Wishlist</span>
				<?php
				 }
				?>
                </div>
                <div class="catimg">
                  <?php if($teach_course->image){?>
                  <a href='<?php echo base_url(); ?>programs/programs/<?php echo $teach_course->id; ?>'> 
                  <!--<img src="" width="200px" height="200px">  --> 
                  <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $teach_course->image;?>"> </a>
                  <?php //}else{ ?>
                  <!--<img src="<?php echo base_url(); ?>public/default/images/no_images.jpg">  -->
                  <?php } ?>
                </div>
                <div class="cattext">
                  <div class="smlhead"><h4><a href='<?php echo base_url(); ?>programs/programs/<?php echo $teach_course->id; ?>'style="font-weight: 500; font-size: 15px;"><?php echo character_limiter(strip_tags($teach_course->name),47); ?></a></h4></div>
                   <div class="smltext"> <?php echo character_limiter(strip_tags($teach_course->description),47); ?> </div>
                  <hr style="margin: 0px 0 10px 0;"  />
                  <div class="smltext"> <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $author_img; ?>" width="30px" height="30px"> <?php echo '<span>'; echo $name = $first_name.' '.$last_name; echo '</span>'; ?> </div>
                  <hr style="margin: 0px 0 10px 0;"  />
                  <div style="margin-bottom:10px;">
                    <?php 
						if($default_plans)
						{
					?>
                    <div style="display:inline-block;"> <span class="gray">Price:</span> <span style="color: #54b551; font-weight: 600 font-size: 14px;"><?php echo $default_plans[0]['price']; ?></span> </div>
                    <?php
					    }
						else
						{
						   
						   
					?>
                    <div style="display:inline-block;"> <span class="gray">Price:</span> <span style="color: #54b551; font-weight: 600 font-size: 14px;">
                      <?php if(intval($teach_course->fixedrate) > 0) { echo $teach_course->fixedrate; } else { echo 'FREE' ;} ?>
                      </span> </div>
                    <?php
						}
					?>
                    <div style="display:inline-block; float:right;"> <span class="gray">Students:</span> <span class="count"><i class="entypo-user"></i><?php echo count($counts_students);?></span> </div>
                  </div>
                  <div style="clear:both;"></div>
                  <hr style="margin: 0px 0 10px 0;" />
                  <span class="reviews-col p0-10">
				<?php
				$avg_rating = 0;
				if(count($reviews) > 0)
				{
					$total_rating = NULL;
					foreach($reviews as $review) 
					{
						$total_rating += $review->review_rate;
					}
					$avg_rating = $total_rating/count($reviews);
					//$rate_percent = ($avg_rating/$total_rating)*100;
				}
				?>
						
				<style>
					.rate-ex3-cnt{
						width:190px; height: 20px;/* display: block;*/
						
					}
					.rate-ex3-cnt .rate-btn{
						width: 20px; height:20px;
						float: left;
						background: url(<?php echo base_url();  ?>public/images/rating_img/rate-btn3.png) no-repeat;
						cursor: pointer;
					}
					 .rate-ex3-cnt  .rate-btn-active{
						background: url(<?php echo base_url(); ?>public/images/rating_img/rate-btn3-hover.png) no-repeat;
					}				
				</style>
				<?php
				$round1 = round($avg_rating);
				?>
				<div class="rating-good" style="float: left; width: 45%; margin-top: 1px; margin-bottom: 2px;">
					<div class="rate-ex3-cnt">
					<?php
					for($iii=1;$iii<=5;$iii++)
					{
						if($iii<=$round1)
						{
							?>
							<div id="1" class="rate-btn-1 rate-btn rate-btn-active"></div>
							<?php
						}
						else
						{
							?>
							<div id="1" class="rate-btn-1 rate-btn"></div>
							<?php
						}
					}
					?>					
					</div>
				</div>			
				
                <!--<div style="float:left;"> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star-empty"></i> <span style="width: 100%"></span> <span class="review-count" style="width: 100%"></span> </div>-->
                <span class="reviews-number" style="float: right;"> <?php if(count($reviews)>0) echo $total_rating.' '; else echo '0'.' '; ?>Rating</span> </span> 
                <!------------------------starreview-End--------------------------> 
                  
                </div>
              </li>
              <?php 
			$total_enrolled += count($counts_students); // Total enrolled Students
			
		    $hover_id++; 
			
			@$no_of_rating += $total_rating; // Number of ratings
			 // count($teachingcourses); Number of courses
			unset($total_rating);
			unset($wishlisted);
		  
		
		}
		
		
		?>
            </ul>
          </div>
        </div>
      </div>
      <?php 
echo form_close(); ?>
    </div>
  </div>
</div>
<script type="text/javascript">
function show_wishheart(idd)
{
       if(document.getElementById(idd).id  == idd)
       {
               document.getElementById('wishheart'+idd).style.display = "block";
               //document.getElementById('wishheart').style.visibility = 'visible';
       }
}

function hide_wishheart(idd)
{
       if(document.getElementById(idd).id  == idd)
       {
               document.getElementById('wishheart'+idd).style.display = "none";
       }
}
</script> 
<script>
  // $(function(){
    //   $("#search").click(function(){
	function ajax_addwishlist(pro_id,hover_id)
	{
	   
        var  dataString1 = pro_id;
        var  dataString2 = hover_id;
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/addwishlist",
            data    : {'pro_id':dataString1,'hover_id':dataString2},
 
           success: function(data){
              
			  $("#wishheart"+hover_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script> 
<script>
  // $(function(){
    //   $("#search").click(function(){
	function ajax_deletewishlist(pro_id,wishlist_id,hover_id)
	{
	   
        var  dataString1 = wishlist_id;
        var  dataString2 = hover_id;
        var  dataString3 = pro_id;
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/programs/deletewishlist",
            data    : {'wishlist_id':dataString1,'hover_id':dataString2,'pro_id':dataString3},
 
           success: function(data){
              
			  $("#wishheart"+hover_id).html(data); 
           }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script> 
<script>
	$(document).ready(function() {
		$("#students").text(<?php echo $total_enrolled;  ?>);
		//$("#courses").text(<?php echo count($teachingcourses); ?>);
		$("#reviews").text(<?php echo @$no_of_rating; ?>);
	
	});
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
function showmsg()
{
	$j.alert({
    		title: 'Please Login or Register',
    		content: ' ',
    		alert: function(){
        	

									
   				 },
    		cancel: function(){
        return true;
    }
}); 
//alert("please Login or Register");
}
</script>

