<section class="container courses">
<div class="row-fluid ">
<?php 
    $CI =& get_instance();  
    $CI->load->helper('text');
?>

<div class="testimonial">
  <?php 
  if(isset($userid))
  {
      ?>
      <div style='float: right;padding: 10px;'>
        <span><a href="<?php echo base_url().'testimonials/create/';?>" class='btn-primary_rockon'>Create</a></span>
      </div>
      <?php 
  }
  ?>

  <?php 
  if($testimonials)
  {
		  foreach($testimonials as $testimonial)
      {
  			  $singleviewmode = (isset($userid) && $testimonial->createdby == $userid )?'edit':'view';			  
            ?>
            <div class="tml" style='padding:10px'>
                <div>
                        <img src="<?php echo base_url(); ?>public/uploads/testimonials/img/thumb_56_56/<?php echo $testimonial->image; ?>" alt="" />
                        <h6><?php echo $testimonial->name; ?></h6>
                        <?php echo date('M d Y',strtotime($testimonial->created_date)); ?>
                        <?php //echo character_limiter($testimonial->description,130); ?>
                        <?php echo $testimonial->description; ?>
                </div>

                <?php /* ?><div class="viewmore"><a href="<?php echo base_url(); ?>testimonials/<?php echo $singleviewmode;?>/<?php echo $testimonial->id;?>">View More>></a></div>	<?php */ ?>

  			      <?php 
              if($singleviewmode == 'edit')
              {
                ?>
  			        <div><span><a href="<?php echo base_url().'testimonials/'.$singleviewmode.'/'.$testimonial->id;?>">Edit</a>||</span><span><a href="<?php echo base_url().'testimonials/delete/'.$testimonial->id;?>">delete</a></span></div>
                <?php 
              }
              ?>
          </div>
          <hr />
          <?php 
     }



echo $this->pagination->create_links();

			  }else{     ?>
			  <div class="tml">
                    <p class='text'>there is no record in the database</p>
			</div>
              <?php } ?>
</div>
</div>
</section>