<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>

<style type="text/css">
	li b{
		color: #454545;
	}
	.FAQ{
		width: 100%;
		margin: 25px 0px;
	}
	.ptxt
	{
		font-size: 15px;
	}
	.btxt
	{
	font-size: 15px;	
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
.panel-body.cardBody ul{
    padding-left: 18px!important;
}
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
				 How to Create a Blog
				</h2>
				
				<div class="panel-options pt-10">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class=""><i class="entypo-cog color"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open color"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw color"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel color"></i></a>
				</div>
			</div>
			
			<div class="panel-body cardBody">
				<!-- <p class="btxt help_breadcrum"><b>Academy Content and Design > Blogs</b></p>			 -->
				<ul class="">
					<li>
					<p class="btxt">Importance of having informative and unique blogs, cannot
					be overemphasised and they would be listed in the Blog page
					of the online academy. See the below self-explanatory video
					to know the steps to create a new blog. </p>
					</li>
					<li>
					<p class="btxt">You can have Text, Image, Video and Html content in your
					blog.</p>
					</li>
					<li>
					<p class="btxt">Do not forget to put a suitable title, description and
					keywords in the <b>“Create Blog”</b> page for Search Engine
					Optimisation.</p>
					</li>
					<video class="FAQ" controls  disablePictureInPicture controlsList="nodownload">
  <source src="<?php echo base_url('public/images/help/video 3.mp4') ?>" type="video/mp4">
</video>
</ul>


<br>
				
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