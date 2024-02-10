<?php foreach($programs as $program){?>
<div class="span4">
	<div class="item">
    	<div class="ch-item ch-img-1 thumb" style="background-image: url('<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $program->image;?>'); background-repeat: no-repeat;">

<div class="ch-info">
<p style=""><a href="#">Read more </a></p>
</div>
</div>
		<h4><?php echo $program->name;  ?></h4>
<p><?php echo character_limiter(strip_tags($program->description),90); ?></p>
<p><span class="price">$<?php echo $program->price;  ?> </span></p>
<a href="<?php echo base_url(); ?>programs/programs/<?php echo $program->pid;?>" class="btn">Read More</a>
	</div>
</div>
<?php } ?>

