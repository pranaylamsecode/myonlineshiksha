<?php
 	//changes on 17-09-2014
  	$CI =& get_instance();
	$CI->load->model('admin/settings_model');
	$getItemssetting = $CI->settings_model->getItems();

	$callpages = $CI->settings_model->getAllPages();
	$countpage = count($callpages);

	$currenttemplate = $getItemssetting[0]['layout_template'];
	$settings = $CI->settings_model->getTemplateById($currenttemplate);
	$data11 = $settings[0]['options'];
	$data = json_decode($data11);
?>