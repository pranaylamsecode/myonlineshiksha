<?php

  $CI =& get_instance();
  $CI->load->model('admin/testimonials_model');
  $CI->load->helper('text');
  $gettestimonials=$CI->testimonials_model->getTestimonials();

  
foreach($gettestimonials as $gettestimonial)
{ 
	?>
	<li style="overflow: hidden; float: none; width: 361px; height: 100px;">
		<a href="<?php echo base_url(); ?>testimonials/view/<?php echo $gettestimonial->id;?>">
		<img width='80' height='80' src="<?php echo base_url(); ?>public/uploads/testimonials/img/thumb_56_56/<?php echo $gettestimonial->image; ?>" alt="testimonial image 1" />
		</a>

		<h5><?php echo character_limiter($gettestimonial->description,130); ?></h5>
	</li>
	 <?php
}
?>