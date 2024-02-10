<div class="title-div"><h1 class="cattitle">Popular Courses</h1></div>
<div id="courses">
<?php foreach($programs as $program){?>
<div class="left">
<div class="course-item-grid">

<a class="mask" href="<?php echo base_url(); ?>programs/programs/<?php echo $program->pid;?>">
<span class="course-thumb">
<img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $program->image;?>" width="240px">
</span>

<span class="main-info">
<h3><span class="cell m"><?php echo $program->name;  ?><!--Microsoft Excel 2010 Course Beginners/ Intermediate Training--></span></h3>
<!--<h4>
<span class="thumb"></span>
<span class="ellipsis"></span>
<span class="job-title"></span>
</h4>-->
</span>
<span class="main-info-content">
<?php echo character_limiter(strip_tags($program->description),90); ?>
</span>

<span class="bottom">
<span class="subscribers"><b>0</b> students</span>
<span class="rating">
<span class="rating-small-stars">
<span style="width:88.572%"></span>
</span>
<!--<span class="review-count">(343)</span>   -->
</span>
<span class="price"><span>$<?php echo $program->price;  ?> </span></span>
</span>
</a>
</div>
</div>
<?php } ?>
</div>
<div style="clear: both"></div>
<!--<div id="testimonialnav">
  <div id="testimonial" align="center">
  <img src="<?php echo base_url(); ?>public/default/images/testimonials.jpg" border="0" alt=""  />
  </div>
</div>-->