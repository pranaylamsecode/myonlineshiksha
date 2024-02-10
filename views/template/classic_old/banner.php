<?php
    /*$CI =& get_instance();
  	$CI->load->model('admin/settings_model');
  	$getItemssetting = $CI->settings_model->getItems();  
  	extract($getItemssetting[0]);
  	$banner_data = json_decode($authorspage); */

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

	//echo $data->position_of_pages->middle_content_above_footer;
	/*$data_exp = explode(',' , $data->position_of_pages->middle_content_above_footer);
	$count = count($data_exp);

	for($j=0; $j<$countpage; $j++)
	{
	    for ($ii=0; $ii<$count; $ii++)
	    {
	        if($callpages[$j]['page_id'] == $data_exp[$ii])
	        {
	        ?>
	        <div class="span4">
	            <h3><?php echo $callpages[$j]['heading']; ?></h3>
	            <p ><?php echo $callpages[$j]['content'];;?></p>    
	        </div> 
	        <?php
	        }        
	    }   
	}*/

?>