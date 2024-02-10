<?php
$hover_id = 1;
?>
<style>
.smltext {
    padding-bottom: 10px;
        word-break: break-word;
}
@media(max-width:767px){
.catimg a img {
    width: 100%;
    height: 100%;
}
}
</style>
<section class="container courses">
  <div class="row-fluid ">
    <div id="main" role="main" class="coursescat">
      <div class="holder" id="mrp-container2">
        <div id="system-message-container"></div>
        
        <?php 
        
        if ($categories): ?>
        <div class="title-div"> 
          <!--<h1 class="cattitle">Courses Categories</h1>--> 
        </div>
        <div class="course_row">
          <ul class="course_cat">
          <?php
				  foreach($categories as $key => $category)
          {
              ?>
              <!--<li id='<?php echo $hover_id;?>' onmouseover="show_wishheart(this.id)" onmouseout="hide_wishheart(this.id)">-->
    			    <li id='<?php echo $hover_id;?>'>
              <div id="wishheart<?php echo $hover_id;?>" class="btn btn-default btn-sm ud-wishlist" style="margin: 10px; position: absolute; z-index: 1; display:none;"> <!--<i class="entypo-heart" style="color:#D04D66;"></i>--> 
              <!--<span class="in-wishlist none">Wishlisted</span>--> 
    				  <?php 
    				  $sessionarray = $this->session->userdata('logged_in');
    				  $user_id = $sessionarray['id'];
          
				if($sessionarray)
				{
				?>
                <!--<span class="not-in-wishlist">Wishlist</span>--> 
				<?php
				}
				else
				{
				?>
				<!--<span onclick ="showmsg();" class="not-in-wishlist">Wishlist</span>--> 
				<?php
				}

        $coursename = strtolower($category->name);      
      $coursename = trim(str_replace(' ', '-', $coursename));
      $coursename = preg_replace('/[^A-Za-z0-9\-]/', '', $coursename);
				?>
				</div>
              <div class="catimg"> 
                <!--<i class="entypo-heart-empty" style="color: #D04D66; float: right; position: absolute; padding: 10px; margin-left: 210px; "></i>-->
                <?php if($category->image){?>
                <a href='<?php echo base_url(); ?>courses/<?php echo $coursename; ?>/<?php echo $category->id; ?>'> <img src="<?php echo base_url(); ?>/public/uploads/pcategories/img/thumb_232_216/<?php echo ($category->image) ? $category->image : 'no-photo.jpg'; ?>" class="image"> </a>
                <?php } ?>
              </div>
              <div class="cattext" style="height:180px;">
                <div class="smlhead"><h4> <a href='<?php echo base_url(); ?>courses/<?php echo $coursename; ?>/<?php echo $category->id; ?>' style="font-weight: 500; font-size: 15px;"><?php echo character_limiter(strip_tags($category->name),60); ?></a> </h4></div>
                <hr style="margin: 0px 0 10px 0;"  />
                <div class="smltext"> <?php echo character_limiter(strip_tags($category->description),60); ?> </div>
                <!--<hr style="margin: 0px 0 10px 0;" />
                <div style="margin-bottom:10px;">
                  <div style="display:inline-block;"> <span class="gray">Price:</span> <span style="color: #54b551; font-weight: 600; font-size: 14px;"> $99 </span> </div>
                  <div style="display:inline-block; float:right;"> <span class="gray">Students:</span> <span class="count"><i class="entypo-user"></i>5.7K</span> </div>
                </div>
                <div style="clear:both;"></div>-->
                <hr style="margin: 0px 0 10px 0;" />
                <!------------------------starreview-Start--------------------------> 
                <span class="reviews-col p0-10">
                <div style="float:left;"> <!--<i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star"></i> <i class="entypo-star-empty"></i>--> <span style="width: 100%"></span> <span class="review-count" style="width: 100%"></span> </div>
                <?php
                      $i = 0;
                     $pro_id =  $this->Program_model->getCourseId11($category->id);
                     foreach($pro_id as $pid)
                    {
                        
                        $lessonshasvalue = false;
                                
                        
                        $days = $this->Program_model->getlistDays($pid->id);


                            foreach ($days as $day)
                            {
                              //$lessonsch = $this->Program_model->getLessons($day->id);
                              $lessonsch = $this->Program_model->getLessonNew($day->id);
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
            <?php $hover_id++; } ?>
          </ul>
        </div>
        <?php else: ?>
        <p class='text'><?php echo lang('web_no_elements');?></p>
        <?php endif ?>
		
      </div>
    </div>
  </div>
</section>
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
function showmsg()
{
alert("please Login or Register");
}
</script>
