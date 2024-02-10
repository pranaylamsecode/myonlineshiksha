<section class="container courses">
           <div class="row-fluid ">

<?php  $CI =& get_instance();
$CI->load->model('Program_model');?>
<div id="main" role="main">
<div class="holder" id="mrp-container2">
<div id="system-message-container">
</div>
<?php if($category):
?>
<div class="title-div"><h2 class="cattitle"><?php echo $category->name; ?></h2></div>

<?php
  //print_r($programs);
  //exit;
?>
<?php if($programs):
?>
<div class="course_row">
    <ul class="course_cat">
        <?php foreach($programs as $program){
        $author = $this->Category_model->getAuthor($program->author);
        $author_img = (isset($author->images)) ? $author->images : '';
        $first_name = (isset($author->first_name)) ? $author->first_name : '';
        $last_name = (isset($author->last_name)) ? $author->last_name : '';
        $lessonsch = array();
        $lessonshasvalue = false;
        $days = $CI->Program_model->getlistDays($program->id);
        //print_r($program->id);
        //exit;

foreach ($days as $day){
  $lessonsch = $CI->Program_model->getLessons($day->id);
  if(empty($lessonsch))
  {
    continue;
  }else{
$lessonshasvalue = true;
break;
}}

if($lessonshasvalue){
         ?>
        <li>
            <div class="catimg">
                <?php if($program->image){?>
                <a href='<?php echo base_url(); ?>programs/programs/<?php echo $program->id; ?>'>
                <!--<img src="" width="200px" height="200px">  -->
                 <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $program->image;?>">
                </a>
                <?php //}else{ ?>
                 <!--<img src="<?php echo base_url(); ?>public/default/images/no_images.jpg">  -->
                <?php } ?>
            </div>
            <div class="cattext">
            
                <h4><a href='<?php echo base_url(); ?>programs/programs/<?php echo $program->id; ?>'style="font-weight: 500; font-size: 15px;"><?php echo $program->name; ?></a></h4>
                <hr style="margin: 0px 0 10px 0;"  />
                <div class="smltext">
                
                	<img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $author_img; ?>" width="30px" height="30px">
                
					<?php echo '<span>'; echo $name = $first_name.' '.$last_name; echo '</span>'; ?>
               
                </div>
                
                <hr style="margin: 0px 0 10px 0;"  />
<!------------------------starreview-Start-------------------------->                			
				<span class="reviews-col p0-10">
					<div style="float:left;">
						<i class="entypo-star"></i>
						<i class="entypo-star"></i>
						<i class="entypo-star"></i>
						<i class="entypo-star"></i>
						<i class="entypo-star-empty"></i>
						<span style="width: 100%"></span>
						<span class="review-count" style="width: 100%"></span>
					</div>
					<span class="reviews-number" style="float: right;">
						(1 Reviews)                 
					</span>
				</span>
<!------------------------starreview-End-------------------------->  



            </div>
        </li>
        <?php } 		}?>
     </ul>
 </div>
     <?php else: ?>
    <p class='text'>there is no record in the database</p>
    <?php endif ?>
<?php else: ?>
<p class='text'>there is no record in the database</p>
<?php endif ?>
</div>
</div>



</div>
</section>
