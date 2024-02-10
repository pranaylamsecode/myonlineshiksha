<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/videogallery/css/main.css"> 
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
				<b>How to Design Your Academy</b>
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				<p class="btxt"><b>Academy Content and Design > Home Page</b></p>			
				<p class="btxt"> From this Menu you can design and edit the look and feel of your Online Academy. Upload the logo, 

testimonials and highlights of your academy. Connect your Online Academy with its other existing 

social media networking accounts for greater visibility to generate potential students and recruiting 

the best teachers for your academy.</p>

				<p class="ptxt">
					<ol type="1" class="ptxt">
						<li> Go to the <b>“Academy Content and Design”</b> tab in the left hand side menu and select <a href="<?php echo base_url();?>admin/templates/editoptions/45"><b>“Home Page”</b></a></b></br></br></li>

						<li> In the <b>“Logo and Theme Color”</b> Tab fill in the Name, Logo, Favicon for your Online Academy.

Follow the special instructions mentioned beside the fields.</br></br></li>

						<li>Next go to <b>“Home Page Settings”</b> Tab and edit the Display Settings of the Home Page of your

Online Academy</br></br></li>

						<li>In the <b>“Banner and Slider”</b> Tab You can either choose a static banner or a dynamic slider of

multiple images appearing below the header in your home page. If you choose the banner 

option then the signup box will appear by default on the right hand side of the image. In 

case you do not want to show the signup box then choose the slider option and put 1 to 4 

images.</br></br></li>

						<li>In the <a href="<?php echo base_url(); ?>admin/widgets"><b>“Widgets”</b></a> create and manage the widgets (display blocks) which will be visible in

the Home Page of your Online Academy. Through the widgets you can share the highlights of 

your Academy in the form of text, images, videos, links and HTML.</br></br></li>

						<li>In the <a href="<?php echo base_url(); ?>admin/testimonials"><b>“Testimonials Block Manager”</b></a> you can create, edit and delete the student

testimonials for your Online Academy. Publish and Unpublish the testimonials at any time 

from this tab in the <b>“Academy Content and Design”</b> Menu.</br></br></li>

						<li>Connect the social network pages of your Online Academy through the <a href="<?php echo base_url(); ?>admin/sociallinks/createLink"><b>“Social Links”</b></a> tab</br></br></li>


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