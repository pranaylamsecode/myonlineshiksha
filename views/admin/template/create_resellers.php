<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
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
			<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2>Resellers Details</h2>
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
							<p>Manage your Resellers Detail</p>
						</div>
						<div class="panel-heading">
							<div class="panel-title" style="padding:0;width:100%;">
								<ul class="nav nav-tabs bordered grey-border blue-border" id="myTab">
									<li id="tab1">
										<a href="#general" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Resellers Info</span></a>
									</li> 
									<?php if($updType == "Update"){ ?>
									<li id="tab2">
										<a href="#homepagesettings" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Resellers Assessment</span></a>
									</li>
									<li id="tab3">
										<a href="#orders" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Resellers Orders</span></a>
									</li>
									<li id="tab4">
										<a href="#payouts" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Reseller Payouts</span></a>
									</li>
								<?php } ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel-body main-table form-body">
						<div class="tab-content">
							<div style="display: none; text-align: center;" id="loader"><img src="<?php echo base_url(); ?>public/images/loading.gif "></div>
							<div class="tab-pane tab1_tab" id="general">
								<?php 
								echo $CI->load->view('admin/resellers/info');
								?>
							</div>
			  				<?php if($updType == "Update"){ ?>
			  				<div class="tab-pane tab2_tab" id="homepagesettings">
				  				<?php 
								echo $CI->load->view('admin/resellers/assessment');
								?>
							</div>
							<div class="tab-pane tab3_tab" id="orders">
				  				<?php 
								echo $CI->load->view('admin/resellers/resellers_orders');
								?>
							</div>
							<div class="tab-pane tab4_tab" id="payouts">
				  				<?php 
								echo $CI->load->view('admin/resellers/resellers_payout');
								?>
							</div>
						<?php } ?>
					  	</div>
					</div>
			  	</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('public/js/custom_js/admin_resellers.js'); ?>"></script>
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

function getresult(pageno) {
	if(pageno==0)
	{
		pageno =1;
	}
	var uid = $("#reseller_id").val().trim();
		var url = "<?php echo base_url()?>admin/resellers/edit/"+uid;
		$.ajax({
			url : url,
			type : "post",
			cache : false,
			data :  {pageno : pageno},
			// beforeSend: function(){$("#overlay").show();},
			success: function(data){
					var obj = $.parseJSON(data);
                    $('#ajax_content').html(obj.pagedata);
					$('#ajax_links').html(obj.paging);
					$("#table-2_info").html("Showing "+obj.first+" to "+obj.start+" of "+obj.total_data+" entries");
			},
			error: function() 
			{} 	        
	   });
	}

function getpayout(pay_page) {
	if(pay_page==0)
	{
		pay_page =1;
	}
	var uid = $("#reseller_id").val().trim();
		var url = "<?php echo base_url()?>admin/resellers/edit/"+uid;
		$.ajax({
			url : url,
			type : "post",
			cache : false,
			data :  {pay_page : pay_page},
			// beforeSend: function(){$("#overlay").show();},
			success: function(data){
					var obj = $.parseJSON(data);
                    $('#payout_content').html(obj.payoutdata);
					$('#ajax_payout').html(obj.paying);
					$("#table-3_info").html("Showing "+obj.firstp+" to "+obj.startp+" of "+obj.total_payout+" entries");
			},
			error: function() 
			{} 	        
	   });
	}
</script>