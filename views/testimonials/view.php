<section class="container courses">
<div class="row-fluid ">
<div class="col-sm-12">
<div class="testimonial">
<ul class="testimonials">
<?php 
if($testimonials)
{	
  	?>
  	 <h5><?php echo $testimonials->name; ?></h5>
  	<img src="<?php echo base_url(); ?>public/uploads/testimonials/img/<?php echo $testimonials->image; ?>" alt="testimonial image 1"> 
  	<h5><?php echo $testimonials->description; ?></h5>
  	</li>
  	<?php
}
else
{ 
  	?>
  	<p class='text'>there is no record in the database</p>
  	<?php
}
?>
</ul>
</div>
</div>
</div>
</section>