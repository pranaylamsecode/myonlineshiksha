<?php
 $hover_id = 1;
 
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
  <style type="text/css">
  .content {
  position: unset !important;
}
.breadcrumb {
    padding: 20px 15px 10px;
    background: #2d3b92;
    border-radius: 0px;
}
section.container.courses {
    width: 100%;
    padding-bottom: 0px !important;
    background: #fff;
    width: 1170px;
    margin: 0 auto;
    padding: 20px 0px 40px 0px !important;
}
.text {
  position: unset;
  color: #262626;
  margin: 0px;
  transform: unset;
  font-size: 16px;
  text-transform: capitalize;
}
@media (max-width: 1200px){
  .container.courses {
  width: 100% !important;
  margin: 0 auto;
  background: #fff;
  padding: 40px 40px !important;
}
}

@media (max-width: 767px){
  .container.courses {
  padding: 30px 20px !important;
  width: 100%;
}

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

  <section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>
            My Wishlists
          </h2>
        </div>
      </div>
    </div>
  </section>

<section class="container courses">
  <div class="row-fluid ">
    <?php  $CI =& get_instance();
$CI->load->model('Program_model');?>
    <div id="main" role="main">
      <div class="holder" id="mrp-container2">
        <div id="system-message-container"> </div>
       
		<div class="title-div">
          <!--<h2 class="cattitle" style="margin-left:30px;"></h2>-->
        </div>
        
       
        <?php if($programs):
?>
        <div class="course_row">
          <ul class="course_cat">
            <?php foreach($programs as $program)
		{
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
            <li  id='<?php echo $hover_id;?>' onmouseover="show_wishheart(this.id)" onmouseout="hide_wishheart(this.id)">
              <div id="wishheart<?php echo $hover_id;?>"  class="btn btn-default btn-sm ud-wishlist" style="margin: 10px; position: absolute; z-index: 1; display:none;"> <i class="entypo-heart" style="color:#D04D66;"></i> 
               <?php 
			      $wishlisted = NULL;
			   foreach ($programs as $wish_list) 
					  {
						if($wish_list->program_id == $program->id)
						{
						      $wishlisted = 'yes';
							  $wishlist_id = $wish_list->wishlist_id;
						}
					  }
			   ?>
			   <?php
					if($wishlisted)
					{
			   ?>
				<span class="in-wishlist none" onclick="ajax_deletewishlist(<?php echo $program->id ?>,<?php echo $wishlist_id ?>,<?php echo $hover_id ?>)">Remove from Wishlist</span>
				<?php
				    }
					
				?>
			 </div>
              <div class="catimg">
                <?php if($program->image){?>
                <a href='<?php echo base_url(); ?>programs/programs/<?php echo $program->id; ?>'> 
                <!--<img src="" width="200px" height="200px">  --> 
                <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $program->image;?>"> </a>
                <?php //}else{ ?>
                <!--<img src="<?php echo base_url(); ?>public/default/images/no_images.jpg">  -->
                <?php } ?>
              </div>
              <div class="cattext">
                <h4><a href='<?php echo base_url(); ?>programs/programs/<?php echo $program->id; ?>'style="font-weight: 500; font-size: 15px;"><?php echo $program->name; ?></a></h4>
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
						<div style="display:inline-block;"> <span class="gray">Price:</span> <span style="color: #54b551; font-weight: 600 font-size: 14px;"><?php if(intval($program->fixedrate) > 0) { echo $program->fixedrate; } else { echo 'FREE' ;} ?></span> </div>
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
        $avg_rating =NULL;
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
		}

		?>
          </ul>
        </div>
        <?php else: ?>
        <p class='text'>there is no record in the database</p>
        <?php endif ?>
        
      </div>
    </div>
  </div>
</section>
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
	function ajax_deletewishlist(pro_id,wishlist_id,hover_id)
	{
	   
        var  dataString1 = wishlist_id;
        var  dataString2 = hover_id;
        var  dataString3 = pro_id;
			
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>myinfo/delete_wishlist",
            data    : {'wishlist_id':dataString1,'hover_id':dataString2,'pro_id':dataString3},
 
           success: function(){ 
             
			window.parent.location.href = "<?php echo base_url(); ?>myinfo/mywishlists";
		
		   }
 
         });
 
        // return false;  //stop the actual form post !important!
 
      }//);
  // });
</script>

	