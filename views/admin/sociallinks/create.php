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

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/sociallinks/createLink', $attributes) : form_open_multipart(base_url().'admin/pagecreator/editPage/'.$id, $attributes);

?>
<div id="toolbar-box">
	<div class="m top_main_content">
	<!-- @@@@@@@@@@@@@@@ new tab start here by sachin @@@@@@@ -->

 <div class="field_container" style="padding-top: 1.5%;">
 <div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">


<!--@@@@@@@@@@@@@@@@ new tab end here @@@@@@@ -->
		
	

<div>
    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>
</div>

<div class="row tab-content">

<div class="col-sm-12">	
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			
			
			<div class="panel-body form-body main-table">
			 
              	<div class="pagetitle icon-48-generic mb_20" ><h2 class="tab_heading">Your Social Media Links:</h2>
			<h6>(Connect your social network pages with your Online Academy. These will be visible in the bottom right corner in the footer of your Home Page.)</h6>
		</div>
				<div class="form-group form-border" style="line-height: 40px;">
                   
                    <label class="col-sm-2 control-label field-title" for="Paragraph" id="label">Social Icon:</label>
                  
                  <div class="col-md-10"> 
                  	<div class="onoffswitch">
					    <input type="checkbox" name="social_icons" class="onoffswitch-checkbox" id="social_icons" value="1" <?php echo ($socialstatus->social_icon && $socialstatus->social_icon == '1') ? "checked" : ''?> >
					    <label class="onoffswitch-label" for="social_icons">
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
                            	<input name="furl" value="<?php echo $this->input->post('furl') ? $this->input->post('furl') : $allsociallinks[0]->siteurl; ?>" type="text" class="form-control form-height">
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
									<input name="turl" value="<?php echo $this->input->post('turl') ? $this->input->post('turl') : $allsociallinks[1]->siteurl; ?>" type="text" class="form-control form-height">
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
							 	<input name="gplusurl" value="<?php echo $this->input->post('gplusurl') ? $this->input->post('gplusurl') : $allsociallinks[2]->siteurl; ?>" type="text" class="form-control form-height">
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
								<input name="yturl" value="<?php echo $this->input->post('yturl') ? $this->input->post('yturl') : $allsociallinks[3]->siteurl; ?>" type="text" class="form-control form-height">
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
							
                            <a><?php echo form_submit('submit', ($updType == 'edit') ? "Edit" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn'" : "id='submit' class='btn'")); ?></a>


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
</div>


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
