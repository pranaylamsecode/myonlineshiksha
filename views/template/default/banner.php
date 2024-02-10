<?php
  $CI =& get_instance();
  $CI->load->model('admin/settings_model');
  $getItemssetting = $CI->settings_model->getItems();  
  extract($getItemssetting[0]);
  $banner_data = json_decode($authorspage); 
?>

<h1><?php echo $banner_data->banner_title; ?></h1>
<p><img src="<?php echo base_url(); ?>public/uploads/settings/img/<?php echo $banner_data->banner_image; ?>" alt="" /><br /> 
<?php echo $banner_data->banner_desc; ?>
<?php //echo $banner_data->banner_image; ?>
      <!--  <h3>Gain the same qualification as an on-campus student</h3>
        <p><img src="<?php echo base_url(); ?>public/default/images/demoabtimg.png" alt="" /><b>Lorem ipsum dolor sit amet conse ctetur adipisicing elit</b><br /> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit<br /> sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.--></p>
