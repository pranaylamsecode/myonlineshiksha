<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>

<style type="text/css">
	.ptxt
	{
		font-size: 15px;
	}
	.btxt
	{
	font-size: 15px;	
	}
</style>

<div id="toolbar-box">



	<div class="m">



		<div id="toolbar" class="toolbar-list">



			



			<div class="clr"></div>



		</div>



		<div class="pagetitle icon-48-generic"><h2><?php //echo 'How to Manage the Set up of Your Academy';?></h2>
		<!--<p> Fill the name and email id that you want to show as the sender for all mail send to users of your online academy. make sure that email id you've entered is a valid one.</p>-->
		</div>



	</div>



</div>







<div style="margin-bottom:10px;"><!--Here you can set the email information of emails that come out of the mlms system.--></div>



<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="font-size: 16px;">
				How to Manage the Set up of Your Academy
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">				
				

				<p class="ptxt">
					<ol type="1" class="ptxt">
						<li> Go to the <b>“Academy Settings”</b> Tab in the left side Menu and select <a href="<?php echo base_url();?>admin/settings/"><b>“General Settings”</b></a></br></br></li>

						<li> Select the Currency in which you wish to sell your courses and receive payments</br></br></li>

						<li>After saving the desired currency and other settings move on to the <a href="<?php echo base_url();?>admin/certificates"><b>“Certificate Settings”</b></a> </br></br></li>

						<li>In the <b>“Certificate Settings”</b> edit the background image and colour, Font and text to be

displayed in the certificates generated for your Online Academy </br></br></li>

						<li>In the <a href="<?php echo base_url();?>admin/settings/sociallogins"><b>“Social Logins”</b></a> enter your Facebook App ID and Secret Key and Google Client ID and

Client Secret Key. In case you do not have either follow the Tool Tips and create the IDs and 

link them to your Online Academy to maximise the reach of your Online Academy</br></br></li>

						<li>Through the <a href="<?php echo base_url();?>admin/settings/account"><b>“Payment Settings”</b></a> select the mode of collection of payment. You can either

choose to enter your PayPal Account details or any alternate method of collection. Or you 

can opt for both</br></br></li>

						<li>Next in the <a href="<?php echo base_url();?>admin/settings/emailsetting"><b>“Send Email Settings”</b> </a> check whether the From Name, From Email ID and

Signature for all outgoing emails from your Online Academy are in order. Make any 

necessary changes (if required) and save</br></br></li>

<li>Go to the <a href="<?php echo base_url();?>admin/settings/domain_pointing"><b>“Point Your Domain”</b></a> and follow the steps to make URL of your Online Academy

from subdomain of <a href="http://www.createonlineacademy.com">createonlineacademy.com</a> to your own domain name.</li>
					</ol>

				</p>

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