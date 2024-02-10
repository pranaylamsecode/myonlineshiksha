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



		<div class="pagetitle icon-48-generic"><h2><?php //echo 'How to Design Your Academy';?></h2>
		<!--<p> Fill the name and email id that you want to show as the sender for all mail send to users of your online academy. make sure that email id you've entered is a valid one.</p>-->
		</div>



	</div>



</div>







<div style="margin-bottom:10px;"><!--Here you can set the email information of emails that come out of the mlms system.--></div>



<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="font-size: 16px;">
				How to Create A Blog
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				<p class="btxt"><b>Academy Content and Design > Blogs</b></p>			
				<p class="btxt">In this Menu you can create informative blogs in relevance to your Online Academy. You can also 

edit existing blogs. Blogs can also be used to interact with the students of your Online Academy 

regarding any announcements, courses and future updates.</p>
				<p class="ptxt">To create a New Blog follow the steps given below.</p>
				<p class="ptxt">
					<ol type="1" class="ptxt">
						<li>Go to the <b>“Academy Content and Design”</b> tab in the left hand side menu and select <a href="<?php echo base_url();?>admin/blogs/index/"><b>“Blogs”</b></a></br></br></li>

						<li>Click on the green <a href="<?php echo base_url();?>admin/blogs/create_blog/"><b>“Create New”</b></a>on the upper right hand corner to create a new

blog.</br></br></li>

						<li>Customise your blog with the desired content which can include text, images, videos and

HTML.</br></br></li>

						

						</ol>

				</p>
				<p class="btxt">Once you are satisfied with all the updates save the settings and view the results in the front end of

your Online Academy. You can make any changes in the settings at any time by logging in to your 

admin panel.</p>
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