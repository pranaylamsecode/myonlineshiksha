<?php $CI =& get_instance();
	$CI->load->model('admin/settings_model');
$configarr = $this->settings_model->getItems();
	$institute_name = $configarr[0]['institute_name'];
 ?>
<div id="footer">
<!-- </ol> -->
<br />
<div class="pull-right"></div>© <?php echo date("Y").' '.$institute_name.', Powered by '; ?><a href="http://createonlineacademy.com/" target="_blank">CreateOnlineAcademy.com<sup>TM</sup></a><!--<strong>All tests completed in <?php //echo $this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end');?> seconds</strong>-->
<!--<center><strong>Copyright &copy; 2013 MLMS <?php //echo $this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end');?></strong></center>-->
<br />
