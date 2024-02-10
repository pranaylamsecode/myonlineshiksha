<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');

if($action == "listlinks")
{
?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
	        
	        <ul>
	            <li id="toolbar-new" class="listbutton">
	            <a href="<?php echo base_url(); ?>admin/sociallinks/createLink"  class="toolbar">
				<span class="icon-32-new">
				</span>
				New</a>
				</li>
	        </ul>
			<div class="clr"></div>
		</div>

		<div class="pagetitle icon-48-generic"><h2>Social Links Manager</h2></div>
	</div>
</div>


<?php
}
?>
<?php
if($action == "createlink")
{
   $updType="create";
   foreach($allsociallinks as $eachlink)
   {

   }

$attributes = array('class' => 'tform', 'id' => '','onsubmit'=>'return checkvalidation()');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/sociallinks/createLink', $attributes) : form_open_multipart(base_url().'admin/pagecreator/editPage/'.$id, $attributes);

?>
<div id="toolbar-box">
	<div class="m top_main_content">
	<!-- @@@@@@@@@@@@@@@ new tab start here by sachin @@@@@@@ -->
<div class="pagetitle icon-48-generic"><h2>Online academy Design Setting</h2>
        <p> Here you can design the look and feel of your Online Academy</p>
</div>
 <div class="field_container" style="padding-top: 1.5%;">
 <div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">

<div class="panel-heading">
                <div class="panel-title" style="padding:0;width:100%;">
                    <!-- <ul class="nav nav-tabs bordered grey-border blue-border"> --><!-- available classes "bordered", "right-aligned" 
                    <!-- <li ><a href="#logo_style" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">Logo and Theme Color</a></span></a></li> 
					<li> <a href="#homepagesettings" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">HomePage Settings</a></span></a></li>
					<li> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">Banner and Slider</a></span></a></li> 
                    
                    <li > <a class="home-page-li-border" href="<?php echo base_url();?>admin/widgets/index">Widgets</a></li>
                    <li > <a class="home-page-li-border" href="<?php echo base_url();?>admin/testimonials">Testimonials</a></li>
                    <li class="active"><a class="home-page-li-border" href="<?php echo base_url();?>admin/sociallinks/createLink">Social Link</a></li> -->
                     <!--<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/pagecreator">Pages</a></span></a></li>
                   <li> <a href="#fillintheblanks" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Fill In The Blanks</span></a></li>-->
                    <!-- </ul>  -->

                    <ul class="nav nav-tabs bordered grey-border blue-border"><!-- available classes "bordered", "right-aligned" --> 
                    <li style="border-left:none;"><a class="home-page-li-border" href="<?php echo base_url(); ?>admin/templates/editoptions/45">Logo and Theme Color</a></li> 
					<li><a class="home-page-li-border" href="<?php echo base_url(); ?>admin/templates/editoptions/45">HomePage Settings</a></li>
					<li><a class="home-page-li-border" href="<?php echo base_url(); ?>admin/templates/editoptions/45">Banner and Slider</a></li> 
                    
                    <li > <a class="home-page-li-border" href="<?php echo base_url();?>admin/widgets/index">Widgets</a></li>
                    <li > <a class="home-page-li-border" href="<?php echo base_url();?>admin/testimonials">Testimonials</a></li>
                    <li class="active"><a class="home-page-li-border" href="<?php echo base_url();?>admin/sociallinks/createLink">Social Link</a></li>
                     <!--<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/pagecreator">Pages</a></span></a></li>
                   <li> <a href="#fillintheblanks" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Fill In The Blanks</span></a></li>-->
                    </ul>
                </div>
                
                <!--<div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>-->
            </div>
<!--@@@@@@@@@@@@@@@@ new tab end here @@@@@@@ -->
		<div class="pagetitle icon-48-generic" style="padding-top:1.5%;"><h4>Your Social Media Links:</h4>
			<p>(Connect your social network pages with your Online Academy. These will be visible in the bottom right corner in the footer of your Home Page.)</p>
		</div>
	

<div>
    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>
</div>

<div class="row tab-content">

<div class="col-sm-12">	
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="padding:0;width:100%;">
					<?php if($updType != 'edit'){ ?>

					Create Link
                    
     				<?php }else{ ?>

			        Edit Link
     				<?php } ?>
				
                </div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body form-body">
			 <?php
	                 $CI = & get_instance();
	                 $CI->load->model('admin/settings_model');
	                 $socialstatus = $this->settings_model->getSocialStatus(1,'mlms_socialstatus'); 
	                 //print_r($socialstatus);
              	?>
				<div class="form-group form-border" style="line-height: 40px;">
                   
                    <label class="col-sm-2 control-label field-title" for="Paragraph" id="label">Social Icon:</label>
                  
                  <div class="col-md-10"> 
                  	<div class="onoffswitch">
					    <input type="checkbox" name="social_icons" class="onoffswitch-checkbox" id="social_icons" value="1" <?php echo ($socialstatus->social_icon && $socialstatus->social_icon == '1') ? "checked" : ''?> >
					    <label class="onoffswitch-label" for="myonoffswitch">
					        <span class="onoffswitch-inner"></span>
					        <span class="onoffswitch-switch"></span>
					    </label>
					</div>
                  </div>
                </div>
				<form role="form" class="form-horizontal form-groups-bordered">
					
					<div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "Facebook"; ?>
                        <!--<span class="required">*</span>-->
                        </label>
						
						<div class="col-sm-12">
							<!-- <div class="col-sm-1 no-padding" style="text-align:right;padding-top:2%!important;">
                            https://
                            </div> -->
                            <!-- <div class="col-sm-11 no-padding">
                            <?php 
                             $ddd =array("form-height,form-control");
                             echo form_input('furl',($this->input->post('furl')) ? $this->input->post('furl') : $allsociallinks[0]->siteurl,'class ='.$ddd); ?>
                            	</div> -->
                            <div class="col-sm-12 no-padding">
                            	<input name="furl" id="furl" value="<?php echo $this->input->post('furl') ? $this->input->post('furl') : $allsociallinks[0]->siteurl; ?>" type="text" class="form-control form-height">
                            </div>
<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="facebook-target" class="tooltipicon" title="Click Here"></span>

						<span class="facebook-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('socialLink_fld_facebook');?>

                        

						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
					</div>
                    
					<div class="form-group form-border">
						
						 <label class='col-sm-12 field-title control-label' for="name"><?php echo "Twitter"; ?></label>
						<div class="col-sm-12">
							<!-- <div class="col-sm-1 no-padding" style="text-align:right;padding-top:2%!important;">
							https://
								</div> -->
								<div class="col-sm-12 no-padding">
									<input name="turl" id="turl" value="<?php echo $this->input->post('turl') ? $this->input->post('turl') : $allsociallinks[1]->siteurl; ?>" type="text" class="form-control form-height">
								</div>
<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="twitter-target" class="tooltipicon" title="Click Here"></span>

						<span class="twitter-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('socialLink_fld_twitter');?>

                         

						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
					</div>
                    
                    <div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "Linkedin"; ?></label>
						
						<div class="col-sm-12">
						<!-- <div class="col-sm-1 no-padding" style="text-align:right;padding-top:2%!important;">
							 https://
							 </div> -->
							 <div class="col-sm-12 no-padding">
							 	<input name="gplusurl" id="gplusurl" value="<?php echo $this->input->post('gplusurl') ? $this->input->post('gplusurl') : $allsociallinks[2]->siteurl; ?>" type="text" class="form-control form-height">
							 </div>
<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="google-plus-target" class="tooltipicon" title="Click Here"></span>

						<span class="google-plus-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('socialLink_fld_google-plus');?>

                         

						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
					</div>
                   
                    <!-- <div class="form-group">
						
                        <label class='col-sm-3 control-label' for="name"><?php echo "RSS Feed"; ?></label>
						
						<div class="col-sm-5">
							 https://&nbsp;<?php echo form_input('rssfeedurl',($this->input->post('rssfeedurl')) ? $this->input->post('rssfeedurl') : $allsociallinks[2]->siteurl); ?>


						<span class="tooltipcontainer">

						<span type="text" id="rss-feed-target" class="tooltipicon" title="Click Here"></span>

						<span class="rss-feed-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('socialLink_fld_rss-feed');?>

                         

						</span>

						</span>



						</div>
					</div> -->
                    <!-- <br />
                    <br /> -->
                    
                    <div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "You Tube"; ?></label>
						
						<div class="col-sm-12">
							<!-- <div class="col-sm-1 no-padding" style="text-align:right;padding-top:2%!important;">
							https://
							</div> -->
							<div class="col-sm-12 no-padding">
								<input name="yturl" id="yturl" value="<?php echo $this->input->post('yturl') ? $this->input->post('yturl') : $allsociallinks[3]->siteurl; ?>" type="text" class="form-control form-height">
							</div>
<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="you-tube-target" class="tooltipicon" title="Click Here"></span>

						<span class="you-tube-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('socialLink_fld_you-tube');?>

                         

						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
					</div>
                   
					
					<div class="form-group form-border chkbox_top_padding">
						<div class="col-sm-12">
							
                            <a><?php echo form_submit('submit', ($updType == 'edit') ? "Edit" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?></a>


            <a href='<?php echo base_url(); ?>admin/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>
</div>
</div>
</div>

</div>
</div>
<?php if ($updType == 'edit'): ?>



	<?php echo form_hidden('id',$id) ?>



<?php endif ?>







<?php echo form_close(); ?>







 <?php



    }







 ?>



 <!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){

//	jQuery('.tooltipicon').click(function(){

//	var dispdiv = jQuery(this).attr('id');

//	jQuery('.'+dispdiv).css('display','inline-block');

//	});

//	jQuery('.closetooltip').click(function(){

//	jQuery(this).parent().css('display','none');

//	});

//	});

jQuery(document).ready(function(){
	jQuery('.tooltipicon').mouseenter(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.tooltipicon').mouseleave(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','none');
	});
	});

	</script>

<!-- tool tip script finish -->

<script>
	jQuery(document).ready(function(){
		jQuery(".onoffswitch").on('click', function() {
		
		var jQuerybox = jQuery('#social_icons');
		if (jQuerybox.is(":checked")) 
		{

			jQuery('#social_icons').prop("checked", false);
		} 
			else 
			{
				jQuerybox.prop("checked", true);
			}
		});
	});
</script>

<script type="text/javascript">
	
	function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

function checkvalidation()
{
 var furl = $("#furl").val();
 var turl = $("#turl").val();
 var gplusurl = $("#gplusurl").val();
 var yturl = $("#yturl").val();	

 if(furl)
 {
	if(isUrlValid(furl) == false)
	{
		alert('Enter valid facebook url');
		return false;
	}
 }

 if(turl)
 {
 	if(isUrlValid(turl) == false)
	{
		alert('Enter valid Twitter url');
		return false;
	}
 }

 if(gplusurl)
 {
 	if(isUrlValid(gplusurl) == false)
	{
		alert('Enter valid Linkedin url');
		return false;
	}
 }

 if(yturl)
 {
 	if(isUrlValid(yturl) == false)
	{
		alert('Enter valid youtube url');
		return false;
	}
 }

 return true;

}
</script>
