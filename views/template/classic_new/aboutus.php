<?php  $CI =& get_instance();
$CI->load->model('admin/pagecreator_model');
$CI->load->helper('text');  
$getaboutus=$CI->pagecreator_model->getPageByType('about');?>
<h3 class="animated delay1 fadeInDown">
<?php echo $getaboutus[0]['heading'];
	$content = preg_replace("/<img[^>]+\>/i",'', $getaboutus[0]['content']);
	//$content = strip_tags($getaboutus[0]['content'], '<p>');  
	$content = strip_tags($content, '<p>'); 
?>
</h3>
<div class="animated delay1 fadeInUp"><?php echo substr($content,0,400).'...';?><a href="<?php echo base_url(); ?>specialpages/aboutuspage">Read More</a></div>
<!--<p align="right" class="animated delay7 fadeInUp"><a href="specialpages/aboutuspage" class="readmore">Read More>></a></p>-->