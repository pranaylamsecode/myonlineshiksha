<?php 
$CI =& get_instance();
$CI->load->model('admin/settings_model');
$getItemssetting = $CI->settings_model->getItems();
$currenttemplate = $getItemssetting[0]['layout_template'];
$settings = $CI->settings_model->getTemplateById($currenttemplate);
$data11 = $settings[0]['options'];
$data = json_decode($data11);
?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/slider/modernizr.custom.28468.js"></script>
<link href='<?php echo base_url(); ?>public/css/slider/style.css' rel='stylesheet' type='text/css'>
<link href='<?php echo base_url(); ?>public/css/slider/style2.css' rel='stylesheet' type='text/css'>

<style>
.da-slide h2{
color: #<?php echo $data->sliderTitle_color2;?>;  /*<?php echo $data->slider->slider_heading_color;?>*/
}
.da-slide p{
color: #<?php echo $data->slider->slider_desc_color;?>;
}

.da-slider{background: transparent url(<?php echo base_url(); ?><?php echo $data->slider->bg_image4;?>) repeat 0% 0%;}

.da-dots span {
background: #<?php echo $data->slider->slider_color;?>;
}
</style>
<div id="da-slider" class="da-slider" style="border-top: 8px solid #<?php echo $data->slider->slider_color;?>;border-bottom: 8px solid #<?php echo $data->slider->slider_color;?>;">
	<div class="da-slide">
		<h2><?php echo $data->slider->slide_heading1;?></h2>
		<p><?php echo $data->slider->slide_containt1;?></p>
		<div class="da-img"><img src="<?php echo base_url(); ?><?php echo $data->slider->slide_image1;?>" alt="image01" /></div>
	</div>
	
	<div class="da-slide">
		<h2><?php echo $data->slider->slide_heading2;?></h2>
		<p><?php echo $data->slider->slide_containt2;?></p>
		<div class="da-img"><img src="<?php echo base_url(); ?><?php echo $data->slider->slide_image2;?>" alt="image01" /></div>
	</div>
	
	<div class="da-slide">
		<h2><?php echo $data->slider->slide_heading3;?></h2>
		<p><?php echo $data->slider->slide_containt3;?></p>
		<div class="da-img"><img src="<?php echo base_url(); ?><?php echo $data->slider->slide_image3;?>" alt="image01" /></div>
	</div>
	
	<div class="da-slide">
		<h2><?php echo $data->slider->slide_heading4;?></h2>
		<p><?php echo $data->slider->slide_containt4;?></p>
		<div class="da-img"><img src="<?php echo base_url(); ?><?php echo $data->slider->slide_image4;?>" alt="image01" /></div>
	</div>
	
	<div class="da-arrows">
		<span class="da-arrows-prev" style="background:#<?php echo $data->slider->slider_color;?>"></span>
		<span class="da-arrows-next" style="background:#<?php echo $data->slider->slider_color;?>"></span>
	</div>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/slider/jquery.cslider.js"></script>

<script type="text/javascript">
	$(function() {	
		$('#da-slider').cslider({ 
	    current     : 0,    
	    // index of current slide	     
	    bgincrement : 50,   
	    // increment the background position 
	    // (parallax effect) when sliding	     
	    autoplay    : <?php echo $data->slider->slider_aoutoplay;?>,
	    // slideshow on / off	     
	    interval    : <?php echo $data->slider->slide_interval;?>  
	    // time between transitions
	}); 		
	});
</script>	