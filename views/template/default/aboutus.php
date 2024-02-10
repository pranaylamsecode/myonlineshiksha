<?php
  $CI =& get_instance();
  $CI->load->model('admin/pagecreator_model');
  $CI->load->helper('text');
  $getaboutus=$CI->pagecreator_model->getPageByType('about');
?>
<h1><?php echo $getaboutus[0]['heading'];?></h1>
<p><?php echo character_limiter($getaboutus[0]['content'],900); ?> </p>
<p align="right"><a href="specialpages/aboutuspage" class="readmore">Read More>></a></p>