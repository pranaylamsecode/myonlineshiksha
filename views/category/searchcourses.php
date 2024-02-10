<?php
$hover_id = 1;
?>
<script type="text/javascript">
$(window).resize(function() 
{
  if($(window).width() < 980)
  {
    $('.screenres').removeClass("row-fluid");  
  }
  else
  {
    $('.screenres').addClass("row-fluid");
  }
});
</script>
<style type="text/css">
  .morecontent span {
    display: none;
}
.morelink {
    display: block;
}
</style>
<style>
.stars{
    width: 130px;
    height: 26px;
    background: url(http://sandbox.bumbu.ru/ui/external/stars.png) 0 0 repeat-x;
    position: relative;
}

.stars .rating{
    height: 26px;
    background: url(http://sandbox.bumbu.ru/ui/external/stars.png) 0 -26px repeat-x;
}

.stars i{
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    height: 26px;
    width: 130px;
    cursor: pointer;
}



.stars i + i{width: 104px;}
.stars i + i + i{width: 78px;}
.stars i + i + i + i{width: 52px;}
.stars i + i + i + i + i{width: 26px;}

</style>

<section class="container courses">
  <!-- <div class="row-fluid "> -->
    <?php  $CI =& get_instance();
$CI->load->model('Program_model');?>
<div><p style="font-size: 22px;font-weight: bold;color: rgb(196, 33, 64);">Search Results for “<?php echo $this->input->post('searchtext'); ?>”</p></div>
    <div id="main" role="main">
      <div class="holder" id="mrp-container2">
        <div id="system-message-container"> </div>
        <?php if($category):
?>
        <div class="title-div">
          <h2 class="cattitle" style="margin-left:30px;">Courses</h2>
          <p style="font-size: 18px;font-weight: 600;color: rgb(196, 33, 64);padding-left: 16px;">We found following courses for “<?php echo $this->input->post('searchtext'); ?>” :</p>
        </div>
       <?php $divstart1 = 0; ?>
        <?php if($programs):
?>     
        <div class="course_row">
          <ul class="course_cat">
            <?php foreach($programs as $key => $program)
		{
			?>
			<?php
	if($divstart1 == 0)
  {    
    ?>
    <div class='screenres row-fluid' >
    <?php   
  }
  ?>
			<?php
		   $counts_students = $this->programs_model->getEnrolledUser($program->id);
		   
		   $default_plans = $this->program_model->getDefaultPlans($program->id);
		   
		   $reviews = $this->program_model->getAllReview($program->id);
		   
		   
		   
        $author = $this->Category_model->getAuthor($program->author);
        $author_img = (isset($author->images)) ? $author->images : '';
        $first_name = (isset($author->first_name)) ? $author->first_name : '';
        $last_name = (isset($author->last_name)) ? $author->last_name : '';
        $lessonsch = array();
        $lessonshasvalue = false;
        $days = $CI->Program_model->getlistDays($program->id);


		foreach ($days as $day)
		{
			$lessonsch = $CI->Program_model->getLessons($day->id);
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

if($lessonshasvalue)
{
   
    ?>
        <li id='<?php echo $hover_id;?>' onmouseover="show_wishheart(this.id)" onmouseout="hide_wishheart(this.id)">
            <div id="wishheart<?php echo $hover_id;?>"  class="btn btn-default btn-sm ud-wishlist" style="margin: 10px; position: absolute; z-index: 1; display:none;"> <i class="entypo-heart" style="color:#D04D66;"></i> 
               	<?php 
			    $wishlisted = NULL;
			    foreach ($wishlist as $wish_list) 
					  {
						if($wish_list->program_id == $program->id)
						{
						      $wishlisted = 'yes';
							  $wishlist_id = $wish_list->wishlist_id;
						}
					  }
			   ?>
			   <?php
			       $sessionarray = $this->session->userdata('logged_in');
				$user_id = $sessionarray['id'];
				if($sessionarray)
				{
					if($wishlisted)
					{
			   ?>
				<span class="in-wishlist none" onclick="ajax_deletewishlist(<?php echo $program->id ?>,<?php echo $wishlist_id ?>,<?php echo $hover_id ?>)">Wishlisted</span>
				<?php
				    }
					else
					{
				?>
			
                <span class="not-in-wishlist" onclick="ajax_addwishlist(<?php echo $program->id ?>,<?php echo $hover_id ?>)">Wishlist</span>
			    <?php
				    }
					}
					else
				{
				?>
				<span class="not-in-wishlist" onclick="showmsg();">Wishlist</span>
				<?php
				}
				$coursename = strtolower($program->name);			
				$coursename = trim(str_replace(' ', '-', $coursename));
				$coursename = preg_replace('/[^A-Za-z0-9\-]/', '', $coursename);
				?>
			 </div>
              <div class="catimg">
                <?php if($program->image){?>
                <!-- <a href='<?php echo base_url(); ?>programs/programs/<?php echo $program->id; ?>'>  -->
                <a href='<?php echo base_url(); ?>course/<?php echo $coursename; ?>/<?php echo $program->id; ?>'> 
                    <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $program->image;?>"></a>
                <?php } ?>
              </div>
              <div class="cattext">
                <!-- <h4><a href='<?php echo base_url(); ?>programs/programs/<?php echo $program->id; ?>'style="font-weight: 500; font-size: 15px;"><?php echo $program->name; ?></a></h4> -->
				<h4><a href='<?php echo base_url(); ?>course/<?php echo $coursename; ?>/<?php echo $program->id; ?>'style="font-weight: 500; font-size: 15px;"><?php echo $program->name; ?></a></h4>
				<div class="smltext"> <?php echo character_limiter(strip_tags($program->description),90); ?> </div>
				<div class="cattext_bottom">
				
                <hr style="margin: 0px 0 10px 0;"  />
                <div class="smltext"> <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $author_img; ?>" width="30px" height="30px"> <?php echo '<span>'; echo $name = $first_name.' '.$last_name; echo '</span>'; ?> </div>
                <hr style="margin: 0px 0 10px 0;"  />
                <div style="margin-bottom:10px;">
					<?php 
						if($default_plans)
						{
					?>
					<div style="display:inline-block;"> <span class="gray"></span><i class="fa fa-usd"></i> <span style="color: #54b551; font-weight: 600 font-size: 14px;"><b><?php echo $currency_symbol.$default_plans[0]['price']; ?></b></span> </div>
					<?php
					    }
						else
						{
						   
						   
					?>
						<div style="display:inline-block;"> <span class="gray"></span> <i class="fa fa-usd"></i><span style="color: #54b551; font-weight: 600 font-size: 14px;"><?php if(intval($program->fixedrate) > 0) { echo $currency_symbol.$program->fixedrate; } else { echo 'FREE' ;} ?></span> </div>
					<?php
						}
					?>
                  <div style="display:inline-block; float:right;"> <span class="gray">Students:</span> <span class="count"><i class="entypo-user"></i><?php echo count($counts_students);?></span> </div>
                </div>
                <div style="clear:both;"></div>
                <hr style="margin: 0px 0 10px 0;" />
                <!------------------------starreview-Start--------------------------> 
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
                <span class="reviews-number" style="float: right;"> <?php if(count($reviews)>0) echo $total_rating.' '; else echo '0'.' '; ?>Review</span> </span> 
                <!------------------------starreview-End--------------------------> 
                
              </div>
            </li> 
            <?php 
			
		    $hover_id++; 
			unset($total_rating);
			unset($wishlisted);
		  
		}
		$divstart1 = 1;
		?>
		<?php
  if(($key+1) % 4 == 0)
  {

    ?>
    </div>
    <?php
    $divstart1 = 0;
  }
  ?>


		<?php
}
?>
          </ul>
		  </div>
        </div>
        
        <?php else: ?>
        <p class='text'>There are no courses in this category.</p>
        <?php endif ?>
        <?php else: ?>
        <p class='text'>There are no courses in this category.</p>
        <?php endif ?>
      </div>
    </div>
  <!-- </div> -->
</section>
<!-- @@@@@@@@@@@@@@@@@@ new code for category is start here @@@@@@@@@@@@@@@@ -->
<?php
$hover_id1 = 1;

 $CI =& get_instance();
$CI->load->model('Program_model');
?>

<section class="container courses">
  <div class="row-fluid ">
    <div id="main" role="main" class="coursescat">
      <div class="holder" id="mrp-container2">
        <div id="system-message-container"></div>
        <?php 
        
        if ($programCategory): ?>
        <div class="title-div">
          <h2 class="cattitle" style="margin-left:30px;">Courses categories</h2>
          <p style="font-size: 18px;font-weight: 600;color: rgb(196, 33, 64);padding-left: 16px;">We found following courses for “<?php echo $this->input->post('searchtext'); ?>” :</p>
        </div>
        <div class="course_row">
          <ul class="course_cat">
          <?php
          foreach($programCategory as $key => $category)
          {
              ?>
              
              <li id='<?php echo $hover_id1;?>'>
              <div id="wishheart<?php echo $hover_id1;?>" class="btn btn-default btn-sm ud-wishlist" style="margin: 10px; position: absolute; z-index: 1; display:none;"> <!--<i class="entypo-heart" style="color:#D04D66;"></i>--> 
              
              <?php 
              $sessionarray = $this->session->userdata('logged_in');
              $user_id = $sessionarray['id'];
          
        if($sessionarray)
        {
        ?>
               
        <?php
        }
        else
        {
        ?>
        
        <?php
        }

        $coursename = strtolower($category->name);      
      $coursename = trim(str_replace(' ', '-', $coursename));
      $coursename = preg_replace('/[^A-Za-z0-9\-]/', '', $coursename);
        ?>
        </div>
              <div class="catimg"> 
                
                <?php if($category->image){?>
                <a href='<?php echo base_url(); ?>courses/<?php echo $coursename; ?>/<?php echo $category->id; ?>'> <img src="<?php echo base_url(); ?>/public/uploads/pcategories/img/thumb_232_216/<?php echo ($category->image) ? $category->image : 'no-photo.jpg'; ?>" class="image"> </a>
                <?php } ?>
              </div>
              <div class="cattext" style="height:180px;">
                <div class="smlhead"><h4> <a href='<?php echo base_url(); ?>courses/<?php echo $coursename; ?>/<?php echo $category->id; ?>' style="font-weight: 500; font-size: 15px;"><?php echo character_limiter(strip_tags($category->name),60); ?></a> </h4></div>
                <hr style="margin: 0px 0 10px 0;"  />
                <div class="smltext"> <?php echo character_limiter(strip_tags($category->description),60); ?> </div>
               
                <hr style="margin: 0px 0 10px 0;" />
                <!------------------------starreview-Start--------------------------> 
                <span class="reviews-col p0-10">
                <div style="float:left;"> <!--<i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star-empty"></i>--> <span style="width: 100%"></span> <span class="review-count" style="width: 100%"></span> </div>
                <?php
                      $i = 0;
                     $pro_id =  $CI->Program_model->getCourseId11($category->id);
                     foreach($pro_id as $pid)
                    {
                        
                        $lessonshasvalue = false;
                                
                        
                        $days = $CI->Program_model->getlistDays($pid->id);


                            foreach ($days as $day)
                            {
                              //$lessonsch = $this->Program_model->getLessons($day->id);
                              $lessonsch = $CI->Program_model->getLessonNew($day->id);
                              if(empty($lessonsch))
                              {
                                continue;
                              }
                              else
                              {
                                $lessonshasvalue = true;
                                 $i = $i+1;
                                break;
                              }
                            }

                    }

                   
                   
                    
                ?>
                <span class="reviews-number" style="float: right;"> Course(s): <?php echo $i;  ?> </span></span> 
                <!------------------------starreview-End--------------------------> 
                
              </div>
            </li>
            <?php $hover_id1++; } ?>
          </ul>
        </div>
        <?php else: ?>
        <p class='text'><?php //echo "There are no courses in this category." //lang('web_no_elements');?></p>
        <?php endif ?>
    
      </div>
    </div>
  </div>
</section>
<!-- @@@@@@@@@@@@@@@@@@ new code for category is end here @@@@@@@@@@@@@@@@@@@@@ -->
<div style="clear:both;"></div>
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
           url: "<?php echo base_url(); ?>category/add_wishlist",
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
           url: "<?php echo base_url(); ?>category/delete_wishlist",
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
function showmsg()
{
alert("please Login or Register");
}
</script>

	