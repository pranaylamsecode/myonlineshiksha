<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>

<style type="text/css">
	.ptxt{
		font-size: 14px;
	}
	.btxt{
font-size: 14px;	
}
.tab-pane h2.tab_heading{
	margin-bottom: 0!important;
}
.tab-pane .pagetitle{
	width:100%!important;
}
.settings_page .field_container .panel{
	margin-bottom: 0!important;
}
.tab-content>.tab-pane {
    margin-top: 20px;
}
</style>

<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2 class="tab_heading"><?php echo 'Custom domain';?></h2>
		
		</div>
		<!-- <div id="toolbar" class="toolbar-list">
		</div> -->
	</div>
</div>


<div class="custom_domain_panel">
		
		<div class="panel" data-collapsed="0">
		
			<div class="panel-body">
				<div class="para">
					<h3>Connecting a Domain</h3>
					<p>Once you've upgraded to a <span class="blue_highlight">Professional Plan or Corporate Plan</span>, you can connect your Academy site to your custom domain name. </p>
					<p>Note: In order for a academy to be published online, it needs to have an address. When you create your academy, it receives a "free domain" or URL. The format of the free URL is <span class="trans_highlight">youracademy.createonlineacademy.com</span>.</p>
				</div>
				<div class="para">
					<h3>To connect your domain via pointing</h3>
					<p>You can connect your domain while keeping it registered with its current domain host. To connect your domain via pointing, you need to update the A record of your domain name. You need to login to your existing domain registrar and check its DNS settings.</p>
				</div>
				<div class="comma_box">
					<div class="comma"><i class="fas fa-quote-left"></i></div>
					<div class="comma_box_text">
						<p>
							To connect your domain to CreateOnlineAcademy, setup your DNS records as follows: 
						</p>
						<p>
							For <span class="trans_highlight">yourdomain.com</span>, create an <span class="trans_highlight">A record</span> that points to: <span class="trans_highlight">67.55.118.209</span>
						</p>
						<p>
							For <span class="blue_highlight">www.yourdomain.com</span>, create a <span class="trans_highlight">A record</span> that points to: <span class="trans_highlight">67.55.118.209</span>
						</p>
					</div>
				</div>
				<div class="para">
					<p>
						A <span class="blue_highlight">domain name</span> is the unique, virtual address of a academy website, e.g. <span class="blue_highlight">www.youracademy.com</span>.
					</p>
					<p>
						You can replace the free URL by <span class="blue_highlight">connecting your own domain</span> name (e.g. <span class="blue_highlight">www.youracademy.com</span>) to your site at any time. Having your own domain improves your SEO, which helps you get better placement in search engine results.
					</p>
				</div>
				<h3>Example is shown below:</h3>
				<img src="<?php echo base_url();?>public/img/admin/point-domain-using-A-record.png" width="100%" height="440px" style="margin-top: 11px;" />
			</div>
		
		</div>
	
	</div>






<?php echo form_close(); ?>





<!-- tool tip script -->

<script type="text/javascript">

jQuery(document).ready(function(){

	jQuery('.tooltipicon').click(function(){

	var dispdiv = jQuery(this).attr('id');

	jQuery('.'+dispdiv).css('display','inline-block');

	});

	jQuery('.closetooltip').click(function(){

	jQuery(this).parent().css('display','none');

	});

	});

	</script>

<!-- tool tip script finish -->