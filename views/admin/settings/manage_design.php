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
	.FAQ{
		width: 100%;
		/*margin: 25px 0px;*/
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
	/*ol {
  counter-reset: list;
}
ol > li {
  list-style: none;
}
ol > li:before {
/*  content: counter(list, lower-alpha) ") ";
  counter-increment: list;
}*/
</style>

<!-- <div id="toolbar-box">



	<div class="m">



		<div id="toolbar" class="toolbar-list">



			



			<div class="clr"></div>



		</div>



		<div class="pagetitle icon-48-generic"><h2><?php //echo 'How to Design Your Academy';?></h2>
		<p> Fill the name and email id that you want to show as the sender for all mail send to users of your online academy. make sure that email id you've entered is a valid one.</p>
		</div>



	</div>



</div> -->







<div style="margin-bottom:10px;"><!--Here you can set the email information of emails that come out of the mlms system.--></div>



<div class="col-md-12">
		
		<div class="panel panel-primary card mb-0" data-collapsed="0">
		
			<div class="panel-heading help_common_class pb-15">
				<h2 class="panel-title">
				How to Design Your Academy 
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
					<li>
					<p class="btxt help_breadcrum">Go to the <a href="<?php echo base_url('admin/home-page/design-options/45') ?>"><b>“Academy”</b></a> Tab in the left side Menu and select <b>“Customize”</b>.</p>
					</li>
					<li>			
						<p class="btxt"> From this Page you can customize the look and feel of your Online Academy. Upload the logo,
						testimonials and highlights of your academy. Connect your Online Academy with your existing
						social media accounts for greater visibility to generate potential students and recruiting the best
						teachers for your academy.</p>
					</li>
				
					
						<li>From the tab <b>“Basic”</b>, you can edit your Academy’s Name, Logo, <a href="https://sitechecker.pro/what-is-favicon" >Favicon image,</a> Your academy’s Tag line ( Tagline’s
font,size and colour can also be changed from here)
<img class="FAQ" src="<?php echo base_url('public/images/help/Customize-Basic-Tab.jpg') ?>">
</li>


						<li>In the <b>“HomePage”</b> Tab, you can set following
							<img class="FAQ" src="<?php echo base_url('public/images/help/Edit-Homepage.jpg') ?>">

							<ol type="a" style='padding-top:15px; content: counter(list, lower-alpha) ") "'>
								<li>
									<b> About Info Block:-</b> In the front page,as you can see that there is a Block (just below the
banner) called <b>About “Your” Academy,</b> which actually is a snippet of the <b>About us</b>
page.This block can be set to be shown or hidden. <a href="<?php echo base_url('admin/create/blog') ?>"><b><a href="<?php echo base_url('admin/academy/block') ?>" target="_blank"> What is block? </a></b></a>
<!-- ( Give the link to another FAQ article made down below)  -->
								</li>
								<li> <b>Menu:-</b> The menu shown in the online academy can be set for Right side display or for Left Side.</li>
								<li> <b>Search box:-</b> If you want to hide the course search box from your online academy, select the Hide.</li>
								<li> <b>Courses block:-</b> Select whether you want to show or hide the block showing courses offered, from the Home Page of your online academy. </li>
								<li> <b>Title of the Courses Block:-</b> Input the text which will be displayed above the <b>Courses block.</b></li>
								<li> <b>Newsletter block:-</b> In the bottom of the home page, <a>Request box to subscribe the Academy’s newsletter, </a>is displayed. You can select to hide this block, as well.</li>
								<li><b>Title and Subtitle of the Newsletter Block:-</b> You can amend the texts of the <b>Email id request box for Newsletter.</b></li>
								<li><b>Copyright:-</b> Hide or show the <b>©2019 Academy Name. All rights reserved</b> from the footer of your online academy.</li>
								<li><b>No. of courses to display in Courses block:-</b> Select the numerical value of the no. of courses to be displayed in the Courses Block. <a>You can also select the courses to be displayed</a></li>
								<li><b>Testimonial:-</b> You can show or hide testimonial block from here and Edit the name of Testimonial Block.</li>
								<li><b>Block’s Title setting:-</b> To change the look and feel of the Text of the Title of the Blocks on HomePage.</li>
								<li><b>SEO settings:- This is one of the most important settings for bringing the relevant traffic organically to your online academy. You need to diligently put Title, Description and Keywords for an effective Search Engine optimisation.</b></li><br>

								
							
						</li>

						<li>Next go to <b>“Banner”</b> Tab. Here you can either choose a static banner or a dynamic slider of multiple images appearing below the header in your home page. If you choose the banner option then the signup box will appear by default on the right hand side of the image. In case you do not want to show the signup box then choose the slider option and put 1 to 5 images.
<img class="FAQ" src="<?php echo base_url('public/images/help/Banner.jpg') ?>">
						</li>

						<li>. In the <b>“Blocks”</b>, you can create new and manage the display blocks, which are visible in
the Home Page of your Online Academy. Through these blocks, you can share the
highlights of your Academy in the form of text, images, videos, links and HTML.
<img class="FAQ" src="<?php echo base_url('public/images/help/Manage-blocks.jpg') ?>">
</li>

						<li>In the <b>“Testimonials”</b> tab you can Publish/unpublish, edit,delete and create a new
student testimonial for your Online Academy. The Testimonial Block will appear in the
footer of your Online Academy's home page and will scroll on its own in that block.
<img class="FAQ" src="<?php echo base_url('public/images/help/Testimonials.jpg') ?>">
</li>

<li>Through the tab “Social Icons”, you should connect your pages of social networks to the
Online Academy ( you cannot link your profile pages, though). These will be visible in the
bottom right corner in the footer of your Home Page.</li>

						

					</ol>

				<br>
				<p class="btxt" style="font-size: 21px" >Once you are satisfied with all the updates save them by clicking the
UPDATE button in the Top right side of your screen and view the
results in the front end of your Online Academy.</p>
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