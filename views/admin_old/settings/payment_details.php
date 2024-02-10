<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>

<style type="text/css">
	.ptxt
	{
		font-size: 14px;
	}
	.btxt
	{
	font-size: 14px;	
	}
</style>

<div id="toolbar-box">



	<div class="m">



		<div id="toolbar" class="toolbar-list">



			



			<div class="clr"></div>



		</div>



		<div class="pagetitle icon-48-generic"><h2><?php echo 'Point your domain';?></h2>
		<!--<p> Fill the name and email id that you want to show as the sender for all mail send to users of your online academy. make sure that email id you've entered is a valid one.</p>-->
		</div>



	</div>



</div>







<div style="margin-bottom:10px;"><!--Here you can set the email information of emails that come out of the mlms system.--></div>



<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="font-size: 16px;">
				On creation your Online Academy will be a subdomain of createonlineacademy.com and would be looking like “youracademy.createonlineacademy.com”.
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				
				<b><p class="btxt">We understand that for enhanced personalisation you require your own domain name. From this page you can point your Online Academy to your own domain name.</p></b>

                <b><p class="btxt">Simply follow the below flow chart:-</p></b>

				<p class="ptxt">1. Do you have your own domain name booked? <b>Yes / No</b></p>

				<p class="ptxt">2. If No, then you need to book a domain name from a <b>Domain Name Registrar</b> – <a href="http://hosting.veerit.com" target="_blank">Book a Domain</a></p>
				
				<p class="ptxt">3. If Yes and you have booked a domain name, then follow the below procedure</p>

				<p class="ptxt">
					<ul>
						<li> Login to your <b>Domain Name Registrar’s</b> website and find the <b>DNS Settings</b> Menu for the domain name you want to add the <b>A-Record</b>. <a href="https://support.dnsimple.com/articles/a-record/" target="_blank">What is A-Record?</a></li>

						<li> In this <b>A-Record</b>, under Host field select the Domain Name which you want to give to your Online Academy</li>

						<li> Adjacent to this Domain Name you will find a field for putting numbers which are actually IP Address for pointing to our server</li>

						<li> Put this IP Address: 216.185.43.221 in that column and save the settings (<span style="color: red;font-weight: bold;font-style: italic;">We highly recommend you to consult the support team of your Domain Name Registrar to change the IP Address in the A-Record</span>)</li>

						<li> Now login to <a href="http://www.createonlineacademy.com" target="_blank">www.createonlineacademy.com</a> <b>main account</b> with the details provided at the time of registration (The details are in your registered mailbox)</li>

						<li> Go to “<b>EDIT ACADEMY PROFILE</b>”</li>

						<li> Enter the domain name in the "Academy Domain Name" field and save the settings.</li>
					</ul>

				</p>

				<p class="ptxt">We are giving you a sample view of A-Record. However, remember each Domain Name Registrar may have a different set up. </p>
					<br>
				<b class="btxt">Example is shown below:</b>
				<img src="<?php echo base_url();?>public/img/admin/point-domain-using-A-record.png" width="870px" height="440px" style="margin-top: 11px;" />
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