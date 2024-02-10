<!--<h1><?=lang('web_welcome')?></h1><br>

<?=lang('web_home_lang')?>:         -->

<?= //$this->config->item('language') ?>
<!--<div id="welcomenav">
  <div id="welcome">
    <div class="icon_rss">
    <img border="0" alt="" src="<?php echo base_url(); ?>public/default/images/icon_rss.png">
    </div>
    <div class="wel_title">
        Welcome to <span>mLMS</span> the e-learning website!
    </div>
    <div class="pricing">
        <a href="index.html"><span>See Pricing</span></a>

    </div>
  </div>
</div>-->
<div id="middlenav">
<?php echo $template['body']; ?>
  <div id="middle">

    <h1 class="page_title">Popular Courses</h1>
    <div id="courses">

        <div class="left">

        <a href="detail_view.html"><img src="<?php echo base_url(); ?>public/default/images/demo_courses.jpg" border="0" alt="" /></a>

 </div>
        <div class="right"><a href="detail_view.html"><img src="<?php echo base_url(); ?>public/default/images/demo_courses.jpg" border="0" alt="" /></a> </div>
        <div class="left"><a href="detail_view.html"><img src="<?php echo base_url(); ?>public/default/images/demo_courses.jpg" border="0" alt="" /></a> </div>
        <div class="right"><a href="detail_view.html"><img src="<?php echo base_url(); ?>public/default/images/demo_courses.jpg" border="0" alt="" /></a> </div>
    </div>
  </div>
</div>
<div style="clear: both"></div>
<div id="testimonialnav">
  <div id="testimonial" align="center">
<?php /* ?>  <img src="<?php echo base_url(); ?>public/default/images/testimonials.jpg" border="0" alt=""  /> <?php */ ?>
  </div>
</div>