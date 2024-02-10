<?php
 /* echo '<pre>';
	print_r($category);
 echo '</pre>'; */
 $search_text = $_GET['searchtext'];
?>
<section class="container courses">
           <div class="row-fluid ">


<div id="main" role="main" class="coursescat">
    <div class="holder" id="mrp-container2">
    <div id="system-message-container"></div>
    <?php if ($categories): ?>
    <div class="title-div">
	<h1 class="cattitle">Search results for "<?php echo $search_text;  ?>"</h1>
	</div>
        <div class="course_row">
            <ul class="course_cat">
                <?php
				 foreach($categories as $key => $category){    ?>
                    <li>
                        <div class="catimg">
                            
                                <a href='<?php echo base_url(); ?>programs/programs/<?php echo $category->id; ?>'>
<img width="251px" height="141px" src="<?php echo base_url(); ?>/public/uploads/programs/img/<?php echo ($category->image) ? $category->image : 'no-photo.jpg'; ?>" class="image">
                                </a>
                           
							   
                        </div>
                        <div class="cattext">
                            <h4>
                                 <a href='<?php echo base_url(); ?>programs/programs/<?php echo $category->id; ?>' style="font-weight: 500; font-size: 15px;"><?php echo $category->name; ?></a>
                            </h4>
                            <hr style="margin: 0px 0 10px 0;"  />
                            <div class="smltext">
                                 <?php echo character_limiter(strip_tags($category->description),80); ?>                                            
                            </div>
                            <hr style="margin: 0px 0 10px 0;" />
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
                  <?php } ?>
            </ul>
         </div>
     <?php else: ?>
     <p class='text'><?php echo lang('web_no_elements');?></p>
     <?php endif ?>
     </div>
</div>

</div>
</section>