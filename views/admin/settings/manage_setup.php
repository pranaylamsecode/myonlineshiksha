<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>

<style type="text/css">
	li b{
		color: #000;
	}
	.ptxt
	{
		font-size: 15px;
	}
	.btxt
	{
	font-size: 15px;	
	}
	.panel-body li{
		margin-bottom: 10px;
	}
	.panel-heading .panel-options.pt-10{
		padding: 10px!important;
	}
	.pb-15{
		padding-bottom: 15px!important;
	}
	.pl-0{
		padding-left: 0!important;
	}
	.panel-primary>.panel-heading>.panel-options>a i.color {
 color: #95aac9;
}
.panel.panel-primary.card.mb-0{
margin-bottom: 0!important;
}
.panel-heading.help_common_class{
	padding-left: 26px!important;
	padding-right: 26px!important;
}
.panel-body.cardBody ol{
    padding-left: 18px!important;
}
</style>

<!-- <div id="toolbar-box">



	<div class="m">



		



		<div class="pagetitle icon-48-generic"><h2><?php //echo 'How to Manage the Set up of Your Academy';?></h2>
		<p> Fill the name and email id that you want to show as the sender for all mail send to users of your online academy. make sure that email id you've entered is a valid one.</p>
		</div>



	</div>



</div>
 -->






<div style="margin-bottom:10px;"><!--Here you can set the email information of emails that come out of the mlms system.--></div>



<div class="col-md-12">
		
		<div class="panel panel-primary card mb-0" data-collapsed="0">
		
			<div class="panel-heading help_common_class pb-15">
				<h2 class="panel-title">
				How to Set up the Academy 
				</h2>
				
				<div class="panel-options pt-10">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class=""><i class="entypo-cog color"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open color"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw color"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel color"></i></a>
				</div>
			</div>
			
			<div class="panel-body cardBody">				
		


				
					<ol type="1" class="ptxt">
						
						<li> Go to the <b>“Academy”</b> Tab in the left side Menu and select <a href="<?php echo base_url();?>admin/settings/"><b>“Settings”</b></a>in the bottom of the menu.</li>

						<li> In the <a href="<?php echo base_url();?>admin/settings/"><b>“General Setting”</b></a> tab, select the currency in which you wish to sell your courses and receive payments. Click the UPDATE button, once you are finished in this tab to save the changes.</li>


						<li>Now click the  <a href="<?php echo base_url();?>admin/settings/"><b>“Payment”</b></a> Tab and add Your PayPal email id, associated to the bank account in which you wish to receive the money. You may also add additional Text information about any alternative payment option for the Students. Click the UPDATE button, once you are finished in this tab to save the changes.</li>

						<li> Now move on to the <a href="<?php echo base_url();?>admin/settings/"><b>“Certificate”</b></a> Tab.</li>

						<li>In the <a href="<?php echo base_url();?>admin/settings/"><b>“Certificate”</b></a> edit the background image and colour, Font and text to be displayed
in the certificates generated for your Online Academy. You can also edit your certificate
in HTML. Click the UPDATE button, once you are finished in this tab to save the
changes.</li>

						<li>To let your visitors log-in/sign-up quickly with their Facebook or Google ids, Go to the
tab <a href="<?php echo base_url();?>admin/settings/"><b> “Social Logins” </b></a> and enter the Facebook App ID + Secret Key and Google Client ID
+ Client Secret Key. To know how to generate App ID + Secret Key, follow the links
given below. Click the UPDATE button, once you are finished in this tab to save the
changes.<br><br>
<b>How to generate AppID/Key of Facebook</b> ( take the data from this page and make an
FAQ article in our system and link it here)<a href="https://www.codeholic.in/how-to-create-afacebook-app-id-and-secret-key/"> https://www.codeholic.in/how-to-create-afacebook-app-id-and-secret-key/</a>
<br><br>
<b>How to generate AppID/Key of Google</b> ( take the data from this page and make an FAQ
article in our system and link it here) <a href="https://www.aspsnippets.com/Articles/GoogleDeveloper-Console-Generate-Client-ID-and-Client-Secret-for-use-with-GoogleAPIs.aspx">https://www.aspsnippets.com/Articles/GoogleDeveloper-Console-Generate-Client-ID-and-Client-Secret-for-use-with-GoogleAPIs.aspx
</a>

</li>

						<li>Your online academy has several automated emails that are to be sent to your students, like
Academy Welcome emails, Course welcome emails, etc. In the tab of <a href="<?php echo base_url();?>admin/settings/"><b>“Email settings”</b></a> , you
can change the sender name and the email signature. Click the UPDATE button, once you
are finished in this tab to save the changes.</li>

<li>To make your online academy addressed to your own URL, Go to the <a href="<?php echo base_url();?>admin/settings/"><b>“Custom
Domain”</b></a> and follow the steps to move your Online Academy from the subdomain of
createonlineacademy.com to your own.</li>
					</ol>

				

				</div>
		
		</div>
	
	</div>




    <!-- <input type="hidden" value="1" name="id"> -->



	<!-- <input type="hidden" value="5" name="tab"> -->



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