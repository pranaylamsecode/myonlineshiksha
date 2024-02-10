<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/sociallogins', $attributes) : form_open_multipart(base_url().'admin/settings/sociallogins');



?>



<div id="toolbar-box">



	<div class="m top_main_content">



		<div id="toolbar" class="toolbar-list">






			<div class="clr"></div>



		</div>



		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0"><h2><?php echo 'Social Logins';?></h2></div>



	</div>



</div>



	<div>
		<p>Here you can change social login settings So that the users can login/sign-up using their Facebook or Google ID in your Online Academy.
		</p>
	</div>



    <?php //$this->ckeditor->editor("content_selling",$content_selling);?>
<div class="field_container">	
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel primary-border panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title field-title" style="padding-left: 0;">
					Social login Settings
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body form-body">
				<div class="form-group form-border" style="line-height: 40px;">
                <?php
	                 $CI = & get_instance();
	                 $CI->load->model('admin/settings_model');
	                 $socialstatus = $this->settings_model->getSocialStatus(1,'mlms_socialstatus'); 
	                 // print_r($socialstatus);
              	?>   
                    <label class="col-sm-2 control-label field-title" for="Paragraph" id="label">Social Login:</label>
                  
                  <div class="col-md-9"> 
                  	<div class="onoffswitch">
					    <input type="checkbox" name="social_data" class="onoffswitch-checkbox" id="social_data" value="1" <?php echo ($socialstatus->social_login && $socialstatus->social_login == '1') ? "checked" : ''?> >
					    <label class="onoffswitch-label" for="myonoffswitch">
					        <span class="onoffswitch-inner"></span>
					        <span class="onoffswitch-switch"></span>
					    </label>
					</div>
                  </div>
                </div>
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Facebook App Id :</label>
						
						<div class="col-sm-12">
							
               <input type="text" class="form-control form-height"  value="<?php echo $sociallogins->facebook->appid; ?>" name="fbappid" size="100">
                            <!-- tooltip area -->
<!-- 
						 <span class="tooltipcontainer">

						<span type="text" id="appId-target" class="tooltipicon"></span>

						<span class="appId-target  tooltargetdiv" style="display: none;width: 322px;right: -332px;" >

						<span class="closetooltip"></span> 

						

						<?php //echo lang('socialLink_fld_appId');?>
						<b>How to Create Facebook App ID:</b></br>
						1. Login to your Facebook account.</br>
						2. Go to https://developers.facebook.com</br>
						3. Go to MY APPS and register as a developer (you may have to re-enter your password and Facebook will take care of rest)</br>
						4. Click the icon of website and click the Button called “Skip and Create App ID” in the top right corner.</br>
						5. Put the fields in the Pop-up for filling Display name and category and click Create App ID</br>
						6. Facebook will then show you some security window to as certain that you are human, complete that and your Facebook app id and App secret Key is displayed which you need to copy and put here.

                         
						</span>

						</span> -->

<!-- tooltip area finish -->

						</div>
					</div>
                   
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Facebook Secret key :</label>
						
						<div class="col-sm-12">
							
                            <input type="text" class="form-control form-height" value="<?php echo $sociallogins->facebook->appsecretkey; ?>" name="fbsecreatekey" size="100">

					<!-- tooltip area -->

						 <!-- <span class="tooltipcontainer">

						<span type="text" id="secreate-key-target" class="tooltipicon"></span>

						<span class="secreate-key-target  tooltargetdiv" style="display: none;width: 322px;right: -332px;" >

						<span class="closetooltip"></span>

						
						<?php //echo lang('socialLink_fld_secreate-key');?>
							<b>How to Create Facebook App ID:</b></br>
						1. Login to your Facebook account.</br>
						2. Go to https://developers.facebook.com</br>
						3. Go to MY APPS and register as a developer (you may have to re-enter your password and Facebook will take care of rest)</br>
						4. Click the icon of website and click the Button called “Skip and Create App ID” in the top right corner.</br>
						5. Put the fields in the Pop-up for filling Display name and category and click Create App ID</br>
						6. Facebook will then show you some security window to as certain that you are human, complete that and your Facebook app id and App secret Key is displayed which you need to copy and put here.
                        
						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
					</div>
                    
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Google Client Id :</label>
						
						<div class="col-sm-12">
							
               <input type="text" class="form-control form-height" value="<?php echo $sociallogins->googleplus->clientid; ?>" name="googleappid" size="100">
                            <!-- tooltip area -->

						 <!-- <span class="tooltipcontainer">

						<span type="text" id="ggappId-target" class="tooltipicon"></span>

						<span class="ggappId-target  tooltargetdiv" style="display: none;width: 322px;right: -332px;" >
						
						<?php //echo lang('socialLink_gld_clientId');?>
						<b>How to create a Google Client Id</b></br>
						1. Login to your Google account.</br>
						2. Click the link https://code.google.com/apis/console</br>
						3. If you have never created a project, then click “Create Project”.</br>
						4. Give your project a suitable name (like name of your online academy) and click “Create”</br>
						5. Click the link called “APIs & auth”</br>
						6. Then click “credentials”, and a new page will open.</br>
						7. Below the Heading “OAuth”, you can see a blue button called  “Create new client id”,click this button</br>
						8. In the opened pop-up select “Web Application” under Application type.</br>
						9. In the field of “Authorized JavaScript origins” put the URL of your online academy.</br>
						10. Click blue button called ” Create Client ID”</br>
						11. The google client ID and Client secret will then be showing on the page, which you should copy and put in the social login page.

						</span>

						</span>
 -->
<!-- tooltip area finish -->

						</div>
					</div>
                    
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Google Client Secret key :</label>
						
						<div class="col-sm-12">
							
                            <input type="text" class="form-control form-height"  value="<?php echo $sociallogins->googleplus->clientsecreatekey; ?>" name="googlesecreatekey" size="100">

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="ggsecreate-key-target" class="tooltipicon"></span>

						<span class="ggsecreate-key-target  tooltargetdiv" style="display: none;width: 322px;right: -332px;" >

						<span class="closetooltip"></span>
 
						

						<?php //echo lang('socialLink_gld_clientsecreate-key');?>

							<b>How to create a Google Client Id</b></br>
						1. Login to your Google account.</br>
						2. Click the link https://code.google.com/apis/console</br>
						3. If you have never created a project, then click “Create Project”.</br>
						4. Give your project a suitable name (like name of your online academy) and click “Create”</br>
						5. Click the link called “APIs & auth”</br>
						6. Then click “credentials”, and a new page will open.</br>
						7. Below the Heading “OAuth”, you can see a blue button called  “Create new client id”,click this button</br>
						8. In the opened pop-up select “Web Application” under Application type.</br>
						9. In the field of “Authorized JavaScript origins” put the URL of your online academy.</br>
						10. Click blue button called ” Create Client ID”</br>
						11. The google client ID and Client secret will then be showing on the page, which you should copy and put in the social login page.
                         
						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
					</div>
                    
					<div class="form-group form-border" style="padding-top:2.5%!important;">
						<div class="col-sm-12">
							
                            
			<a>

                   

			<?php echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>



			</a>
						</div>
					</div>
					<input type="hidden" value="1" name="id" />
				</form>
				
			</div>
		
		</div>
	</div>
	</div>
	</div>
    
</div>



	<?php echo form_error('description'); ?> 



    







<?php echo form_close(); ?>









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
		
		var jQuerybox = jQuery('#social_data');
		if (jQuerybox.is(":checked")) 
		{

			jQuery('#social_data').prop("checked", false);
		} 
			else 
			{
				jQuerybox.prop("checked", true);
			}
		});
	});
</script>