<?php

  $CI =& get_instance();

  $CI->load->model('admin/pagecreator_model');

  $CI->load->helper('text');

  $getaboutus=$CI->pagecreator_model->getPageByType('about');

?>

<h3 class="animated delay6 fadeInDown"><?php echo $getaboutus[0]['heading'];?></h3>

<p class="animated delay7 fadeInUp"><?php echo character_limiter($getaboutus[0]['content'],900); ?> </p>

<p align="right" class="animated delay7 fadeInUp"><a href="specialpages/aboutuspage" class="readmore">Read More>></a></p>