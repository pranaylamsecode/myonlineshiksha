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
				<b>How to Create A Blog</b>
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
					<ul type="1" class="ptxt">
						<li>Go to the <b>“Academy Content and Design”</b> tab in the left hand side menu and select <a href="<?php echo base_url();?>admin/blogs/index/"><b>“Blogs”</b></a></br></br></li>

						<li>Click on the green <a href="<?php echo base_url();?>admin/blogs/create_blog/"><b>“Create New”</b></a>on the upper right hand corner to create a newblog.</br></br></li>

						<li>Customise your blog with the desired content which can include text, images, videos andHTML.</br></br></li>
					</ul>

				</p>
				<p class="btxt">Once you are satisfied with all the updates save the settings and view the results in the front end of
your Online Academy. You can make any changes in the settings at any time by logging in to your admin panel.</p>
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