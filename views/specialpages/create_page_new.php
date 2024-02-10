<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/videogallery/css/front-main.css"> 
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


<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0" style="height: 540px; overflow: auto;">
		
			<div class="panel-heading">
				<div class="panel-title" style="font-size: 16px;">
				<b>How to Create A Page</b>
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				<p class="btxt"><b>Academy Content and Design > Other Pages</b></p>			
				<p class="btxt"> In this Menu you can edit the different pages that will be visible in your Online Academy. Default 

pages that come pre-loaded in your administrative panel include <b>“Contact Us”</b>, <b>“About Us”</b> and 

<b>“Terms of Use”</b>. You can edit the contents of these pages with the details of your Online Academy.</p>
				<p class="ptxt">To create a New Customised Page follow the steps given below. These new pages will be showed 

under the <b>“More”</b> Tab in the website.</p>
				<p class="ptxt">
					<ol type="1" class="ptxt">
						<li>Go to the <b>“Academy Content and Design”</b> tab in the left hand side menu and select <a href="<?php echo base_url();?>admin/pagecreator/"><b>“Other

Pages”</b></a> </br></br></li>

						<li> Click on the green <a href="<?php echo base_url();?>admin/pagecreator/createPage/"><b>“New”</b></a> button on the upper right hand corner to create a new page or

click on the <b>“Edit”</b> button beside the default pages to edit the default pages.</br></br></li>

						<li>When you click on the <a href="<?php echo base_url();?>admin/pagecreator/createPage/"><b>“New”</b></a> button you will be directed to the <b>“Create Page”</b> section. Here

you can customise your page with the desired content. You can include text, images, video 

and HTML as the content of the customised pages.</br></br></li>

						<li>You can choose to publish the customised page by selecting <b>“SHOW”</b> in the <b>“Show in the

Drop down Menu of the More”</b> Tab. You can also keep pages hidden in case you want to 

update the information or maybe have discontinued some services for the time being.</br></br></li>

						<li>Fill out the Meta Title, Meta Description and Meta Keywords to increase the search engine

optimisation</br></br></li>

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