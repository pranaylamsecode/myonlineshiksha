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
	.panel-heading.chat_app_top {
	padding: 15px 15px 10px 15px;
}
</style>
<div class="main-container">

<div id="toolbar-box">



	<div class="m">
		<div class="pagetitle icon-48-generic">
				<h2>Manage Support</h2>
		</div>


		<div id="toolbar" class="toolbar-list">
			<ul id="sticky" style="list-style: none; float: right;">
			<li id="toolbar-new" class="listbutton">

<?php
// $this->config->item()
// $this->session->set_userdata('db_name', ''); ?>
            <a href="<?php echo base_url(); ?>assets/chat_app/livechat/php/app.php?" target="_blank" id="Login_As_Operator"  class="btn btn-green">
        <i class="entypo entypo-popup"></i>
			<span class="icon-32-new">
			</span>
			Login as operator
			</a>
			</li>
			</ul>
		</div>
		<!-- <div class="pagetitle icon-48-generic"><h2><?php //echo 'How to Design Your Academy';?></h2>
		<p> Fill the name and email id that you want to show as the sender for all mail send to users of your online academy. make sure that email id you've entered is a valid one.</p>
		</div> -->
	</div>
</div> 






<!-- 
<div style="margin-bottom:10px;">Here you can set the email information of emails that come out of the mlms system.</div>
 -->


<div class="col-md-12">
		
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<!-- <div class="panel-heading chat_app_top">
				<div class="panel-title">
				
				</div>
				

				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div> -->
			
			<div class="panel-body">
	<object type="text/html" data="<?php echo base_url(); ?>assets/chat_app/livechat/php/app.php?admin" width="100%" height="500px">
    </object>			 
    <!-- <object type="text/html" data="<?php echo base_url(); ?>assets/chat_app/livechat/php/app.php?admin" width="970px" height="800px">
    </object> -->
    <!-- <iframe src="http://create-online-academy.com/assets/chat_app/livechat/php/app.php?admin" width="200" height="200"></iframe> -->
				
				</div>
		<input type="hidden" value="frm1" id="frmdemo">
		<input type="hidden" value="<?php echo $this->uri->segment(3); ?>" id="frmdemo2">
		</div>
	
	</div>




    <!-- <input type="hidden" value="1" name="id"> -->



	<!-- <input type="hidden" value="5" name="tab"> -->



<?php echo form_close(); ?>

</div>

	
	<script type="text/javascript">

            jQuery(document).ready(function(){
            	var match1 = jQuery('#frmdemo',parent.document).val();
            	if(match1 == 'frm2')
                    {
                    jQuery('#frmdemo',parent.document).val('frm1');
                    }
            });
</script>


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