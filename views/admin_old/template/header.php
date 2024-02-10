<?php
//echo $user = $this->user;
?>
<div id="header">
	<div id="btop">
		<h1><!--<a href="#"> --><?php //echo $this->config->item('site_title');?></a><a href="<?php echo base_url(); ?>/admin/"><img border="0" alt="" src="<?php echo base_url(); ?>public/img/admin/logo.png"></a></h1>
		<p id="userbox"><strong>
        <?php //$user->first_name; ?>
        <?php //$user->last_name; ?></strong>

        <a href="<?php echo base_url(); ?>admin/users/logout"><?=lang('web_logout')?></a> <br>
		<span class="clearFix">&nbsp;</span>
	</div>

	<ul id="bmenu">
		<?php //$this->load->view('admin/partials/_menu');?>
	</ul>


	<span class="clearFix">&nbsp;</span>

</div>
