<?php
  $CI =& get_instance();
  $CI->load->model('admin/testimonials_model');
  $CI->load->helper('text');
  $gettestimonials=$CI->testimonials_model->getTestimonials();
?>
<div class="testimonial">
    <h1><a href = '<?php echo base_url().'testimonials/alltestimonials'?>'>Testimonials</a></h1>
    <?php foreach($gettestimonials as $gettestimonial){ ?>
        <div class="tml">
              <div style="padding-bottom: 20px;">
                      <img src="<?php echo base_url(); ?>public/uploads/testimonials/img/thumb_56_56/<?php echo $gettestimonial->image; ?>" alt="" />
                      <h6><?php echo $gettestimonial->name; ?></h6>
                      <span class="tmdate"><?php echo date('M d Y',strtotime($gettestimonial->created_date)); ?></span>
                      <?php echo character_limiter($gettestimonial->description,130); ?>
              </div>
        </div>
        <div class="viewmore"><a href="<?php echo base_url(); ?>testimonials/view/<?php echo $gettestimonial->id;?>">View More>></a></div>
    <?php } ?>
</div>