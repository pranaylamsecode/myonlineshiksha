<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
<style>
#message {
    position: absolute; 
	right: 0;
	z-index: 9999;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    margin-top: 10px;
}
</style>
<?php $CI = & get_instance(); ?>
<div class="settings_page">
	<div id="toolbar-box">
		<div class="m top_main_content">
			<div id="toolbar" class="toolbar-list">
				<ul style="list-style:none; float:right;">
					<li id="toolbar-new" class="listbutton">
					</li>
				</ul>
				<div class="clr"></div>
			</div>
			<span id="message"></span>
			<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2>Resellers Detail</h2>
			</div>
		</div>
	</div>
	<div class="tab-content">
		<fieldset class="adminform">
		</fieldset>
	</div>
	<div class="field_container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
				<div class="panel panel-primary primary-border" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title mb_20" style="padding:0;width:100%;">
							<p>Manage your Partner Details</p>
						</div>
						<div class="panel-heading">
							<div class="panel-title" style="padding:0;width:100%;">
								<ul class="nav nav-tabs bordered grey-border blue-border" id="myTab">
									<li id="tab1" style="border-left:none;"><a href="#general" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Partner Info</span></a></li> 

									<li id="tab2"> <a href="#homepagesettings" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Partner Assessment</span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel-body main-table form-body">
						<div class="tab-content">
							<div style="display: none; text-align: center;" id="loader"><img src="<?php echo base_url(); ?>public/images/loading.gif "></div>
							<div class="tab-pane tab1_tab" id="general">
								<?php 
								echo $CI->load->view('admin/referrals/info');
								?>
							</div>
			  				<div class="tab-pane tab2_tab" id="homepagesettings">
				  				<?php 
								echo $CI->load->view('admin/referrals/assessment');
								?>
							</div>
					  	</div>
					</div>
			  	</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	jQuery(document).ready(function(){
		var tab = "<?php echo $this->session->userdata('Active_setting'); ?>";
		if(tab=='')
		{
			$(document).find(".tab1_tab, li#tab1").addClass('active');
		}
		else{
			tabActive(tab);			
		}
	});
	
</script>