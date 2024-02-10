<!--easywizard-->
<!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//code.jquery.com/jquery-2.1.4.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/js/easywizard/easyWizard.css">
    <link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">

<!--easywizard-->
<style type="text/css">
.save-btn{
background-color: #f0f0f1;
    border: none;
}
.save-btn:hover{
background-color: #dbdbdd !important;
    border: none;
}
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  text-align: left;
  font-size: 15px;
  padding-left: 35px!important;
  padding-right: 20px!important;
  margin: 0% 0px 2%;
  font-weight: bold!important;
}
button.btn.btn-success {
  background-color: #acc590;
  border: #acc590!important;
  padding: 6px 22px;
  font-family: 'AvenirNextLTPro-Demi'!important;
  font-size: 13px!important;
}
button.btn.btn-danger {
  color: #fff!important;
  font-size: 13px!important;
  background-color: #3F3F3F!important;
  border-color: #3F3F3F!important;
  padding: 6px 22px!important;
  font-family: 'AvenirNextLTPro-Demi';
}
.jconfirm .jconfirm-box .buttons {
  padding: 15px 15px!important;
}
/*.stick{
	width:27%!important;
}*/
.closeIcon {
  display: block!important;
}
span.glyphicon.glyphicon-remove {
  font-size: 20px;
  font-weight: normal;
  top: 9px;
}
.content {
  font-size: 14px!important;
  color: #686c70;
  margin-bottom: 3px;
  padding-top: 5%!important;
  font-family: arial!important;
}
</style>
<?php
 
  $u_data=$this->session->userdata('loggedin');

  $maccessarr=$this->session->userdata('maccessarr');

  //$this->session->flashdata('message');
  //$Active_tab ='tab1';
  $Active_tab =$this->session->userdata('Active_tab');
  if($Active_tab)
  {
  	$Active_tab =$this->session->userdata('Active_tab');
  }
  else
  {
  	$Active_tab = "tab1";
  }
?>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jscolor/jscolor.js"></script>

<div class="main-container">
<?php

$attributes = array('class' => 'tform', 'id' => 'templateoptions', 'name' => 'templateoptions');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/templates/editoptions', $attributes) : form_open_multipart(base_url().'admin/templates/editoptions/'.$id, $attributes);

?>

<div id="toolbar-box">

	<div class="m top_main_content">

		<div id="toolbar" class="toolbar-list">
			<div id="sticky-anchor"></div>
			<ul id="sticky" class="main-content-btn" style="float:right; list-style:none;display: flex;">

            <!-- <li id="toolbar-new" class="listbutton" style="float:left; margin-right:10px;"><a class='btn btn-blue' style="padding: 5px 7px 5px 4px;"><?php echo "<i class='entypo entypo-install'></i>".form_submit( 'btnsubmit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='btnsubmit' class='save-btn'" : "id='btnsubmit' class='save-btn'")); ?></a> -->
            <li id="toolbar-new" class="listbutton" style="float:left; margin-right:10px;"><a class='btn btn-green' style="padding: 5px 7px 5px 4px;"><?php echo "<i class='entypo entypo-install'></i>".form_submit( 'btnsubmit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='btnsubmit' class='no-background'" : "id='btnsubmit' class='no-background'")); ?></a>
            <input style="display:none;" type="submit" id="widget" name="widget" value="widget">
            <input style="display:none;" type="submit" id="testinomial" name="testinomial" value="testinomial">
            <input style="display:none;" type="submit" id="sociallink" name="sociallink" value="sociallink">
            </li>

			<li id="toolbar-new" class="listbutton">

            <a href='<?php echo base_url(); ?>admin/templates<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='bforward'><span class="btn btn-red btn-dark-grey" style="padding: 9px 22px 8px!important;"><i class="entypo-cancel"></i>Cancel</span> </a>

			</li>

			</ul>

			<div class="clr"></div>

		</div>

		<div class="col-sm-6 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo ($updType == 'create') ? 'Online academy Design Settings' : 'Online academy Design Settings'?></h2>
		
		<button type="button" style="display: none;"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Wizard
        </button>
		</div>

<!-- ////////////////////// -->
<!-- <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openHomeLogoImage();" id="settings_3">
					    	<i class="fa fa-gear"></i></a> -->
<!-- //////////////////////// -->

	</div>

</div>

<div>

    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>

</div>

<div class="field_container">
<div class="row">

	<div class="col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
	<div class="pmaintitle main_subtitle">
		<p> Here you can design the look and feel of your Online Academy</p>
	</div>
		<div class="panel panel-primary primary-border" data-collapsed="0">
			<div class="panel-heading">

			<div class="panel-title" style="padding:0;width:100%;">
					<ul class="nav nav-tabs bordered grey-border blue-border" id="myTab"><!-- available classes "bordered", "right-aligned" --> 
					<?php  $vartab1 = $Active_tab == 'tab1' ? 'active':''; ?>
					<li id="tab1" style="border-left:none;" class="<?php echo $vartab1; ?>"><a href="#logo_style" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab1');"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Logo and Theme Color</span></a></li> 
					<?php $vartab2 = $Active_tab == 'tab2' ? 'active':''; ?>					
					<li id="tab2" class="<?php echo $vartab2; ?>"> <a href="#homepagesettings" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab2');"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">HomePage Settings</span></a></li>
					<?php $vartab3 = $Active_tab == 'tab3' ? 'active':''; ?>
					<li class="<?php echo $vartab3; ?>"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab3');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Banner and Slider</span></a></li> 
						
					<!-- <li onclick="return switchconfirm1(), getSwitchTab('widget');"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="#">Widgets</a></span></a></li>
					<li onclick="return switchconfirm2(),getSwitchTab('testinomial');"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="#">Testimonials</a></span></a></li>
					<li onclick="return switchconfirm3(), getSwitchTab('sociallink');;"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="#">Social Link</a></span></a></li> -->
					<li onclick="return switchconfirm1(), getSwitchTab('widget');"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Widgets</span></a></li>
					<li onclick="return switchconfirm2(),getSwitchTab('testinomial');"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Testimonials</span></a></li>
					<li onclick="return switchconfirm3(), getSwitchTab('sociallink');;"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Social Link</span></a></li>
					<!--<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/pagecreator">Pages</a></span></a></li>
					<li> <a href="#fillintheblanks" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Fill In The Blanks</span></a></li>-->
					</ul>
				</div>


				<!--<div class="panel-title">
					<ul class="nav nav-tabs bordered"> 
					<li class="active"><a href="#logo_style" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Logo and Theme Color</span></a></li> 
					<li > <a href="#homepagesettings" data-toggle="tab" ><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">HomePage Settings</span></a></li>
					<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Banner and Slider</span></a></li> 
					
					<li> <a href="<?php echo base_url();?>admin/widgets" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/widgets">Widgets</a></span></a></li>
					<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/testimonials">Testimonials</a></span></a></li>
					<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/sociallinks/createLink">Social Link</a></span></a></li>
					<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/pagecreator">Pages</a></span></a></li>
					
					</ul>
				</div>-->
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>


			
	<div class="panel-body tab-box" style="padding-left:0;padding-right:0;">
		<div class="tab-content">
		<?php  $vartabpane = $Active_tab == 'tab1' ? 'active':''; ?>
			<div class="tab-pane <?php echo $vartabpane ?>" id="logo_style">
					<div><h4></h4></div>

					<!-- @@@@@@@start tagline @@@@@ -->
                    
<div class="form-group form-border" style="padding-top:0;">
						<label class="col-sm-12 control-label field-title">Academy Name 
						<p>(Put your Online Academy's Name here which will be visible in the tab of your website.)</p>
						</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
						<div class="themegroup1">
    
	<input type="text" class="form-control form-height tour_1" name="insti_title" id="insti_title" value="<?php echo ($this->input->post('insti_title')) ? $this->input->post('insti_title') : $settings[0]['institute_name']; ?>" style="width: 100%;">
	
</div>

						<!-- <span class="tooltipcontainer">
						<span type="text" id="insti_title-target" class="tooltipicon"></span>
						<span class="insti_title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo"You Institute Name Here"; //lang('layout_fld_themes');?>
                         
						</span>
						</span> -->
<!-- tooltip area finish -->
						</div>
						
						

                    <div style="clear:both;"></div>
                    
					</div>


                    <!-- @@@@@@@@@@@22 new code end here @@@@@@@@@@@@ -->


                    <div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Logo
							<p>(Please make sure that the name of the file for the logo does not contain any spaces or special characters.)</p>
						</label>
						
						<div class="col-sm-8">
                                  <!-- <input type="file" name="file_i" id="file_i" class="form-control"> -->

                                  <input type="hidden" class="form-control form-height" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" name="imagename" id="imagename">

                     

					<div id="localimage_i">

						<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" width="150" id="imgname"> -->
					<div class="col-sm-6 img-grey-border">
						<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" width="150" id="imgnamelogo">
                    </div>
                    <div class="col-sm-6">
                   		<a href="<?php echo base_url(); ?>admin/templates/croplogo/logo" class="addlogo_pop btn btn-success img-align btn-border-blue">Add Logo</a>
                    </div>
                    </div>

                    <span class="error"><?php echo form_error('file_i'); ?></span><span class="help-inline">Logo (164px X 44px)</span>



                            
                            
						</div>
						
					</div>
                    
                    <div style="clear:both;"></div>                    
                    <!-- @@@@@@@@@@@ new code is start here @@@@@@@@@@@ -->

                    	<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Favicon
							<p><a href="https://en.wikipedia.org/wiki/Favicon" target="_blank">What is Favicon?</a></p>
						</label>
						
						<div class="col-sm-8">
                                  <!-- <input type="file" name="file_f" id="file_f" class="form-control"> -->

                                  <input type="hidden" class="form-control form-height" value="<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" name="favname" id="favname">

                     

					<div id="localimage_i">
					<div class="col-sm-6 img-grey-border">
								<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" width="25" id="imgnameficon">
						<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" width="25" id="imgname"> -->
					</div>
					<div class="col-sm-6">	
						<a href="<?php echo base_url(); ?>admin/templates/croplogo/icon" class="addfev_pop btn btn-success favicon-btn-img btn-border-blue">Add Favicon</a>
                    </div>
                    </div>

                    <span class="error"><?php echo form_error('file_f'); ?></span><span class="help-inline"></span>



                            
                            
						</div>

						

					</div>


                    <!-- @@@@@@@start tagline @@@@@ -->
                    
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">TagLine
							<p>(Put your Online Academy's tagline here which will be visible in the header of your website.)</p>
						 </label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
					<div class="themegroup1">
						<input type="text" class="form-control form-height" name="menu_title" id="menu_title" value="<?php echo ($this->input->post('menu_title')) ? $this->input->post('menu_title') : $settings[0]['univer_title']; ?>" style="width: 100%;">
					</div>

						<!-- <span class="tooltipcontainer">
						<span type="text" id="layouttheme3-target" class="tooltipicon"></span>
						<span class="layouttheme3-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo"You TagLine Here"; //lang('layout_fld_themes');?>
                         
						</span>
						</span> -->
<!-- tooltip area finish -->
						</div>
						

                    <div style="clear:both;"></div>
                    
					</div>


                    <!-- @@@@@@@@@@@22 new code end here @@@@@@@@@@@@ -->
                    
                    <div>
                    	<h4></h4>
                    </div>
                     <!--<div>
                    	<h5><a href="<?php echo base_url().'admin/settings/addlayout';?>" style="color: #2BB8AC;
text-decoration: underline;" class="fancybox fancybox.iframe">Add New Layout</a></h5>
                    </div>
                    <div class="form-group" style="margin-top:20px;">
						<label class="col-sm-3 control-label">Template Name :</label>
						
						<div class="col-sm-5">
							
                            <?php $allLayouts = json_decode($alllayouts);
					
					$templates = array();
					$themes = array();
					foreach ($allLayouts as $key => $values) {
						$templates[] = $key;
						if ($settings[0]['layout_template'] == $key) {
							foreach ($values as $ckey => $cvalue) {
							$themes[] = $cvalue->name;
							}
						}
					}
					?>
					<select name="layouttemplate" id="layouttemplate" class="form-control">
					<?PHP foreach ($templates as $key => $value) {
					?>
					<option value="<?php echo $value;?>" <?php echo ( $settings[0]['layout_template'] == $value )? 'selected="selected"' : ''?>><?php echo $value;?></option>
					<?php
					}?>
					</select>-->
					<!--tooltip area -->
				<!--<span class="tooltipcontainer">
					<span type="text" id="layouttemplate-target" class="tooltipicon"></span>
					<span class="layouttemplate-target  tooltargetdiv" style="display: none;" >
					<span class="closetooltip"></span>-->
					<!--tip containt-->
					<?php echo lang('layout_fld_template');?>
					<!--/tip containt-->
					<!--</span>
					</span>	-->
					<!-- tooltip area finish -->
						<!--</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>-->
                    
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Theme Color :</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
						<div class="themegroup1">
							<select name="layouttheme" id="layouttheme" class="form-control form-height">
								<?php foreach ($themes as $key => $value) {
								?>
								<option value="<?php echo $value;?>" <?php echo ( $settings[0]['layouttheme'] == $value )? 'selected="selected"' : ''?>><?php echo substr($value, 0, -4);?></option>
								<?php	
								}?>
							</select>
						</div>
<!--theme group for template 2-->
<!-- <div class="themegroup2" <?php //echo ( $settings[0]['layout_template'] == 'default' )? 'style="display:none;"' : ''?>>
<select name="layouttheme2" id="layouttheme2">
<option value="red.css" <?php //echo ( $settings[0]['layouttheme'] == 'red.css' )? 'selected="selected"' : ''?>>Style Red </option>
<option value="blue.css" <?php //echo ( $settings[0]['layouttheme'] == 'blue.css' )? 'selected="selected"' : ''?>>Style Blue</option>
<option value="green.css" <?php// echo ( $settings[0]['layouttheme'] == 'green.css' )? 'selected="selected"' : ''?>>Style Green</option>
<option value="orange.css" <?php //echo ( $settings[0]['layouttheme'] == 'orange.css' )? 'selected="selected"' : ''?>>Style Orange</option>
</select></div> -->
					<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="layouttheme2-target" class="tooltipicon"></span>
						<span class="layouttheme2-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('layout_fld_themes');?>
                         
						</span>
						</span> -->
					<!-- tooltip area finish -->
						</div>
					</div>
                    
                    <!-- new start here -->
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Tagline Font</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
			<div class="themegroup1">
			<select name="tagline_font" id="tagline_font" class="form-control form-height">
				<option style="font-family : Arial" value=" " <?php echo ( $settings[0]['tagline_font'] == '0' )? 'selected="selected"' : ''?>>Select Font</option>

					  <option style="font-family : Arial" value="Arial" <?php echo ( $settings[0]['tagline_font'] == 'Arial' )? 'selected="selected"' : ''?>>Arial</option>
                      
                      <option style="font-family : Courier" value="Courier" <?php echo ( $settings[0]['tagline_font'] == 'Courier' )? 'selected="selected"' : ''?>>Courier</option>

                      <option style="font-family : Tahoma" value="Tahoma" <?php echo ( $settings[0]['tagline_font'] == 'Tahoma' )? 'selected="selected"' : ''?>>Tahoma</option>
                      <option style="font-family : 'Times New Roman'" value="Times New Roman" <?php echo ( $settings[0]['tagline_font'] == 'Times New Roman' )? 'selected="selected"' : ''?>>Times New Roman</option>

                      <option style="font-family : Verdana" value="Verdana" <?php echo ( $settings[0]['tagline_font'] == 'Verdana' )? 'selected="selected"' : ''?>>Verdana</option>
                      <option style="font-family : Georgia" value="Georgia" <?php echo ( $settings[0]['tagline_font'] == 'Georgia' )? 'selected="selected"' : ''?>>Georgia</option>
                      <option style="font-family : Palatino Linotype" value="Palatino Linotype" <?php echo ( $settings[0]['tagline_font'] == 'Palatino Linotype' )? 'selected="selected"' : ''?>>Palatino Linotype</option>

                      <option style="font-family : Arial Black" value="Arial Black" <?php echo ($settings[0]['tagline_font'] == 'Arial Black' )? 'selected="selected"' : ''?>>Arial Black</option>

                      <option style="font-family : Comic Sans MS" value="Comic Sans MS" <?php echo ( $settings[0]['tagline_font'] == 'Comic Sans MS' )? 'selected="selected"' : ''?>>Comic Sans MS</option>

                      <option style="font-family : Lucida Console" value="Lucida Console" <?php echo ( $settings[0]['tagline_font'] == 'Lucida Console' )? 'selected="selected"' : ''?>>Lucida Console</option>
			</select>
			</div>

						<!-- <span class="tooltipcontainer">
						<span type="text" id="layouttheme3-target" class="tooltipicon"></span>
						<span class="layouttheme3-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('layout_fld_themes');?>
                         
						</span>
						</span> -->
					<!-- tooltip area finish -->
						</div>
					</div>
					
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Tagline Font Size</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
			<div class="themegroup1">
			<input   name="tagline_font_size" id="tagline_font_size" class="form-control form-height" value="<?php echo ($this->input->post('tagline_font_size')) ? $this->input->post('tagline_font_size') : $settings[0]['tagline_font_size']; ?>" >
			</div>

						<!-- <span class="tooltipcontainer">
						<span type="text" id="layouttheme4-target" class="tooltipicon"></span>
						<span class="layouttheme4-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('layout_fld_themes');?>
                         
						</span>
						</span> -->
				<!-- tooltip area finish -->
						</div>
					</div>

					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Tagline Font color</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
			<div class="themegroup1">
			<input   name="tagline_font_color" id="tagline_font_color" class="form-control form-height color {required :false,hash:true}" value="<?php echo ($this->input->post('tagline_font_color')) ? $this->input->post('tagline_font_color') : $settings[0]['tagline_font_color']; ?>" >
			</div>

						<!-- <span class="tooltipcontainer">
						<span type="text" id="layouttheme5-target" class="tooltipicon"></span>
						<span class="layouttheme5-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('layout_fld_themes');?>
                         
						</span>
						</span> -->
					<!-- tooltip area finish -->
						</div>
					</div>
                    <!-- new code end here -->
                    <div style="clear:both;"></div>
			</div>
			<?php  $vartabpane2 = $Active_tab == 'tab2' ? 'active':''; ?>
           <div class="tab-pane <?php echo $vartabpane2; ?>" id="homepagesettings">
           <p class="col-sm-12">Here you can edit the Display Setting of the home of your Online Academy</p>
			<!--Main fieldset-->
		<?php 
			//echo '<pre>';
			//print_r($templatefields);
			
		$templateOptions = (array)$templateOptions;
		      
		foreach ($templatefields as $fieldset => $fields) {	

				
		?>



		<fieldset class="adminform">
			<!--<legend><?php echo 'Design Settings';?></legend>-->
			
			<table class="adminform homepage-table">
			
			<tbody>
				<?php
				  
					
				foreach ($fields as $key => $field) {		    
					     
					     if($field['name'] == 'aboutusinfotext_showhide' ||  
					     	//$field['name'] == 'topbarloginregister_showhide' ||
					     	$field['name'] == 'heading_searchbar' ||
					     	$field['name'] == 'searchbox_showhide' ||
					     	$field['name'] == 'course_heading' ||
					     	$field['name'] == 'course_showhide' ||
					     	$field['name'] == 'news_letter' ||
					     	$field['name'] == 'news_letter_content' ||
					     	$field['name'] == 'news_letter_heading' ||
					     	$field['name'] == 'copyright' 
					     	//$field['name'] == 'middle_content' ||
					     	//$field['name'] == 'middle_content_above_footer' ||
					     	//$field['name'] == 'footer_content'
					     	 ) {
					      
					?>
					<tr <?php if ($field['type'] == 'hidden') { ?>style="display:none;"<?php }?>>
					
					<td width="30%">
						<p>
							<label style="margin-bottom: 12px;" class='col-sm-12 field-title labelform' for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?>
							<?php if ($field['rule']=='required') {
							?>
							<span class="required">*</span></label>
							<?php
							}?>
						</p>
					</td>

					<td>
					
					<?php
					$fldpostdata = $postdata[trim($fieldset)];
					if (isset($templateOptions[trim($fieldset)])) 
					{
						$fldtemplateOptions = (array)$templateOptions[trim($fieldset)];
					}


					$class = '';

					switch ($field['type']) {
						case 'text':
							?>
							<div class="col-sm-12">
							 <?php
							 if (isset($field['color']) && $field['color'] == 'true') {
								$class = ' color';
								$class.=" form-control form-height";
							 }
							 
							 $fvalue = isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : '';
							 if (isset($field['placeholder'])) {
								$placeholder = $field['placeholder'];
							 }
							 $inputattrib  = array(
											'name'=> trim($fieldset).'['.$field['name'].']',
											'id'=>$field['name'],
											'placeholder'=>$placeholder,
											'value'=>$fvalue,
											'class'=> "form-control form-height"
											);
							  echo form_input($inputattrib); ?>
							  <?php if (isset($field['tooltip'])) { ?>
							
								<!--<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								
								<?php echo $field['tooltip'];?>
								
								</span>
								</span>-->
						
							<?php } ?>

							</div>
							

							 <span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>

							<?php
							break;
						
						case 'file':
							?>
							<div class="col-sm-6">
							<div style="float:left;">
							 <?php
							 $fvalue = isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : '';
							 ?>
							 <input type="file" name="<?php echo  $field['name'];?>"  id="<?php echo $field['name']; ?>"></div>
							 <?php 
							 if (isset($fldpostdata[$field['name']]) || isset($fldtemplateOptions[$field['name']])) {
							 ?>
							 <div style="float: left;margin-left: 20px;">
							 <img src="<?php echo base_url().$fvalue;?>" style=" max-width: 100px; max-height: 100px; " />
							 <br /><br /><br/>
							 <?php
							 }
							 ?>
								<?php if (isset($field['tooltip'])) { ?>
							
								<!--<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
							
								<?php echo $field['tooltip'];?>
							
								</span>
								</span>-->
							<!-- tooltip area finish -->
							<?php } ?>
							</div>
							</div>
							 <span class="error"><?php echo form_error($field['name']); ?></span>

							<?php
							break;
						
						case 'textarea':
							if (isset($field['editor']) && $field['editor'] == "true") {
								$fieldeditor[]  = $field['name'];
							}
							?>
							<div class="col-sm-9">
							<textarea name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class="stinput form-control" rows="6">
							<?php echo isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : ''; ?>
							</textarea><br /><br /><br/>
							<?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>
							</div>					
							<span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>
							<?php
							break;
						
						case 'hidden':

							$fieldattrib = array('name' => trim($fieldset).'['.$field['name'].']' , 'value' => $field['value']);
							?>
							<p>

							 <?php echo form_hidden(trim($fieldset).'['.$field['name'].']',$field['value']); ?>
							 </p>
							<?php
							break;
						
						case 'select':
							?>
							<div class="col-sm-12">
							 <select name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class='form-control form-height'>

								<?php foreach($field['option'] as $option){ ?>

									 <option value="<?php echo $option['value'];?>" <?php echo ((isset($fldpostdata[$field['name']]) && $option['value'] == $fldpostdata[$field['name']]) || (!isset($fldpostdata[$field['name']]) && isset($fldtemplateOptions[$field['name']]) && $option['value'] == $fldtemplateOptions[$field['name']])) ? 'selected="selected"' : '';?>><?php echo $option['text'];?></option>

								<?php }?>

							</select>
							<?php if (isset($field['tooltip'])) { ?>
						
								<!--<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								
								<?php echo $field['tooltip'];?>
								
								</span>
								</span>-->
						
							<?php } ?>
							</div>
							
							<span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>
							<?php
							break;
					}
					?>

					</td>
					</tr>

					<?php
					}
				}
				
				?>

			</tbody>
			</table>
		</fieldset>
		<?php	
		  
		}
        
		?>
		<div style="display:none" >
				<label>Footer widget and Testimonial <br/>Backgroung Hide/show:</label>
						
							<select name="fwt_backgrd_hideshow"  id="fwt_backgrd_hideshow" class="form_control">

								<option <?php  if($templateOptions['fwt_backgrd_hideshow'] == 'true') { echo 'selected' ;} ?> value="true">Show</option>
								<option <?php  if($templateOptions['fwt_backgrd_hideshow'] == 'false') { echo 'selected' ;} ?>  value="false">Hide</option>
							</select>
						
		</div>
		<div id="fwtBackgrd" style="display:none" >
				<label>Footer widget and Testimonial <br/>Background :</label>
						
							<select name="fwt_backgrd_wo" id="fwt_backgrd_wo" class="form_control">
								
								<option <?php  if($templateOptions['fwt_backgrd_wo'] == 'true') { echo 'selected' ;} ?> value="true">With Background</option>
								<option <?php  if($templateOptions['fwt_backgrd_wo'] == 'false') { echo 'selected' ;} ?> value="false">Without Background</option>
							</select>
						
		</div>

		<!-- @@@@@@@@@@@ new code is start here @@@@@@@@@@@ -->
<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Display Total number of Courses </label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
<div class="themegroup1">
	<input type="text" class="form-control form-height" name="total_course" id="total_course" value="<?php echo ($this->input->post('total_course')) ? $this->input->post('total_course') : $settings[0]['course_total']; ?>" >

	
</div>
<a onclick="this.href='<?php echo base_url()?>admin/templates/courselist/'+document.getElementById('total_course').value" style="margin-top: 2%;" class="btn-border-blue selcourse_pop btn btn-primary">
			<i class="entypo-plus"></i>Select Courses</a>
						<!--<span class="tooltipcontainer">
						<span type="text" id="layouttheme4-target" class="tooltipicon"></span>
						<span class="layouttheme4-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php //echo"enter course total number Here"; //lang('layout_fld_themes');?>
                         <!--/tip containt-->
						<!--</span>
						</span>-->
<!-- tooltip area finish -->
						</div>
						<!--<p style="text-align: center;"> (Put Total number of course show in home page of your website.)</p>-->
						
                    <div style="clear:both;"></div>
                    
					</div>

					<div class="form-group form-border">
					  <div class="main-table" style="padding-bottom:0px;">
						<table class="table table-bordered responsive" id="coursestoaddlist">
							<thead>
								<tr role="row">      	
						            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="ID">ID</th>
						            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">Course Name</th>
						            <th class="sorting" role="columnheader" tabindex="2" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Remove">Remove</th>
						            <!--<th>Re-order<a href="javascript: saveorder(4, 'saveorder')" class="saveorder"></a></th> -->
						            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Edit</th>            
						            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Published</th>-->
						            
								</tr>
							</thead>

							<tbody> 
								<?php 
								$i = 0;
								$ii =0;
								?>
								<?php 
								//foreach ($questions as $question):

                               // print_r($templateOptions['qidck']);

								@$queid = $templateOptions['qidck'];


							
								/*if(!empty($queid))
								{
									$questionArray = explode(',',$questions->quizzes_ids);
								}*/

								if(isset($queid) && $queid != '')
								{
									foreach($queid as $key => $qzid)
									{
										if(isset($qzid) && $qzid!='' )
										{
											$gotQuestion = $this->programs_model->getProgramById($qzid);
											if($gotQuestion)
											{
										?>

										<tr id="qli<?php echo $qzid; //$queid;?>">			
											<td class=" ">									            
												<?php echo $gotQuestion->id?></a>
											</td>
											
								            <td class=" ">
									           
												<?php echo $gotQuestion->name?>
											</td>
								            
								        	<td class=" ">
								        	
								        	<span class="removespan"><a href="javascript:void(0);" onclick="deleteRow(this)" class="removeele" id="remove'+$(this).val()+'">Remove</a></span>
								        	</td>

								        	
								        	<td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="<?php echo $gotQuestion->id?>"></td>
											
									      								
								       		         
										</tr>

										<?php
										}
									else
									{  
										if($ii == 0)
										{
										?>
										<tr>
										<td>
										
										 No Courses Available in Academy.
										 
										 </td>
										 </tr>
										<?php
										}
									}

									}
									$ii++;
								}

								}
										?>
										<?php //endforeach		
										?>
									</tbody>
						</table>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-12 field-title labelform">Testimonial :</label>
						<div class="col-sm-12 ">
						<select name="testimonial_enable" id="testimonial_enable" class="form-control form-height">
													
													<option <?php  if(@$templateOptions['testimonial_enable'] == 'true') { echo 'selected' ;} ?> value="true">Show</option>
													<option <?php  if(@$templateOptions['testimonial_enable'] == 'false') { echo 'selected' ;} ?> value="false">Hide</option>
												</select>
												</div>
												</div>

												<div class="form-group form-border" >
						<label  class="col-sm-12 field-title labelform">Testimonial Title :</label>
						<div class="col-sm-12 ">
						<input   name="testimonial_name" id="testimonial_name" class="form-control form-height" value="<?php echo @$templateOptions['testimonial_name'] ? @$templateOptions['testimonial_name'] :'' ?>" >
							</div>					
												</div>

							<!--@@@@@@@@@@@@@@@new start here -->

								<div class="form-group form-border">
						<label class="col-sm-12 field-title labelform">Widget Heading Font :</label>
						<div class="col-sm-12 ">
						<select name="widget_heading_font" id="widget_heading_font" class="form-control form-height">
													
													<!-- <option <?php  if(@$templateOptions['widget_heading_font'] == 'true') { echo 'selected' ;} ?> value="true">Show</option>
													<option <?php  if(@$templateOptions['widget_heading_font'] == 'false') { echo 'selected' ;} ?> value="false">Hide</option> -->
						 <option style="font-family : Arial" value="" <?php echo ( @$templateOptions['widget_heading_font'] == '0' )? 'selected="selected"' : ''?>>Select Font</option>

					  <option style="font-family : Arial" value="Arial" <?php echo ( @$templateOptions['widget_heading_font'] == 'Arial' )? 'selected="selected"' : ''?>>Arial</option>
                      
                      <option style="font-family : Courier" value="Courier" <?php echo ( @$templateOptions['widget_heading_font'] == 'Courier' )? 'selected="selected"' : ''?>>Courier</option>

                      <option style="font-family : Tahoma" value="Tahoma" <?php echo ( @$templateOptions['widget_heading_font'] == 'Tahoma' )? 'selected="selected"' : ''?>>Tahoma</option>
                      <option style="font-family : 'Times New Roman'" value="Times New Roman" <?php echo ( @$templateOptions['widget_heading_font'] == 'Times New Roman' )? 'selected="selected"' : ''?>>Times New Roman</option>

                      <option style="font-family : Verdana" value="Verdana" <?php echo ( @$templateOptions['widget_heading_font'] == 'Verdana' )? 'selected="selected"' : ''?>>Verdana</option>
                      <option style="font-family : Georgia" value="Georgia" <?php echo ( @$templateOptions['widget_heading_font'] == 'Georgia' )? 'selected="selected"' : ''?>>Georgia</option>
                      <option style="font-family : Palatino Linotype" value="Palatino Linotype" <?php echo ( @$templateOptions['widget_heading_font'] == 'Palatino Linotype' )? 'selected="selected"' : ''?>>Palatino Linotype</option>

                      <option style="font-family : Arial Black" value="Arial Black" <?php echo (@$templateOptions['widget_heading_font'] == 'Arial Black' )? 'selected="selected"' : ''?>>Arial Black</option>

                      <option style="font-family : Comic Sans MS" value="Comic Sans MS" <?php echo ( @$templateOptions['widget_heading_font'] == 'Comic Sans MS' )? 'selected="selected"' : ''?>>Comic Sans MS</option>

                      <option style="font-family : Lucida Console" value="Lucida Console" <?php echo ( @$templateOptions['widget_heading_font'] == 'Lucida Console' )? 'selected="selected"' : ''?>>Lucida Console</option>
												</select>
												</div>
												</div>
							<div class="form-group form-border">
						<label  class="col-sm-12 field-title labelform">Widget Heading Size</label>
						<div class="col-sm-12">
							<input name="widget_heading_size" id="widget_heading_size" class="form-control form-height" value="<?php echo @$templateOptions['widget_heading_size'] ? @$templateOptions['widget_heading_size'] :'' ?>" />
						</div>
						</div>

							<div class="form-group form-border" >
								<label  class="col-sm-12 field-title labelform">Widget Heading Color</label>
								<div class="col-sm-12">
									<input name="widget_heading_color" id="widget_heading_color" class="form-height form-control color {required:false,hash:true}" value="<?php echo @$templateOptions['widget_heading_color'] ? @$templateOptions['widget_heading_color'] :'' ?>" />												
								</div>
							</div>

							
						
						<!--<p style="text-align: center;"> (Put Total number of course show in home page of your website.)</p>-->
						
                    <div style="clear:both;"></div>
                    
				


                    <!-- @@@@@@@@@@@22 new code end here @@@@@@@@@@@@ -->

		<!--<script>
		 jQuery(document).ready(
		 function()
			 {
				<?php 
				foreach ($fieldeditor as $value) {
					echo "jQuery('#".$value."').redactor();";
					}
				?>
			 }
		 );
		</script>-->

		</div>
		<?php  $vartabpane3 = $Active_tab == 'tab3' ? 'active':''; ?>
		<div class="tab-pane <?php echo $vartabpane3; ?>" id="bannerslider">
            <p class="col-sm-12">You can either choose a static banner or a dynamic slider of multiple images appearing below the header in your home page. If you choose the banner option then the signup box will appear by default on the right hand side of the image. In case you do not want to show the signup box then choose the slider option and put 1 to 5 images.</p>
			
			<div class="form-group form-border" style="padding-top:2%!important;margin:0;">
              <div class="col-sm-12">
			    <div class="grey-background" style="display: -webkit-box;">
					<label class="col-sm-4 control-label dark_label">Choose Option :</label>
				  <div class="col-sm-8" style="">
					<input style="margin-right:2%;" type="radio" onclick="ban_slider('banner')" name="banner_slider" id="banner" value="banner" checked="true" />Banner
					<input style="margin-left: 20px;margin-right:2%;" type="radio" name="banner_slider" onclick="ban_slider('slider')" id="slider" value="Slider" />Slider 	
				  </div>
				</div>
			  </div>
			</div>

			<br/>


			
				<!--Banner fieldset-->
		<?php 

			
			
		$templateOptions = (array)$templateOptions;
		      
		foreach ($templatefields as $fieldset => $fields) {	

				
		?>
		
		 <fieldset class="adminform" id="banner_field" style="display:none"> 		
			<!--<legend><?php echo 'Design Settings';?></legend>-->

			<table class="adminform homepage-table">
			<?php
			$bs =1;
			foreach ($fields as $key => $field1) {
				  	if($field1['name'] == 'banner_showhide')
				  	{
				  	foreach($field1['option'] as $option1){
				  	?>
				  	
				  	<input type="hidden" id="bvalue<?php echo $bs; ?>" name="bvalue<?php echo $bs; ?>" value="<?php echo ((isset($fldpostdata[$field1['name']]) && $option1['value'] == $fldpostdata[$field1['name']]) || (!isset($fldpostdata[$field1['name']]) && isset($fldtemplateOptions[$field1['name']]) && $option1['value'] == $fldtemplateOptions[$field1['name']])) ? 'banner' : ''; ?>">
				 <?php
				  $bs++;
				  }
				}
				  }
			?>
			<tbody>
				<?php
				//   foreach ($fields as $key => $field1) {
				//   	if($field1['name'] == 'banner_showhide')
				//   	{
				//   	foreach($field1['option'] as $option1){
				  	
				//   	echo ((isset($fldpostdata[$field1['name']]) && $option1['value'] == $fldpostdata[$field1['name']]) || (!isset($fldpostdata[$field1['name']]) && isset($fldtemplateOptions[$field1['name']]) && $option1['value'] == $fldtemplateOptions[$field1['name']])) ? 'selected="selected"' : '';
				//   }
				// }
				//   }
					
				foreach ($fields as $key => $field) {	
						
					     
					     if(
					     	$field['name'] == 'banner_showhide' ||
					     	$field['name'] == 'banner_setting' 
					     	
					     	 ) {
					      
					?>
					<tr <?php if ($field['type'] == 'hidden') { ?>style="display:none;"<?php }?>>
					
					<td width="30%">
						<p>
							<label style="margin-bottom: 12px;" class='col-sm-12 field-title labelform' for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?>
							<?php if ($field['rule']=='required') {
							?>
							<span class="required">*</span></label>
							<?php
							}?>
						</p>
					</td>
					<td>
					
					<?php
					$fldpostdata = $postdata[trim($fieldset)];
					if (isset($templateOptions[trim($fieldset)])) 
					{
						$fldtemplateOptions = (array)$templateOptions[trim($fieldset)];
					}


					$class = '';

					switch ($field['type']) {
						case 'text':
							?>
							<div class="col-sm-12">
							 <?php
							 if (isset($field['color']) && $field['color'] == 'true') {
								$class = ' color';
								$class.=" form-control form-height";
							 }
							 
							 $fvalue = isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : '';
							 if (isset($field['placeholder'])) {
								$placeholder = $field['placeholder'];
							 }
							 $inputattrib  = array(
											'name'=> trim($fieldset).'['.$field['name'].']',
											'id'=>$field['name'],
											'placeholder'=>$placeholder,
											'value'=>$fvalue,
											'class'=> "form-control form-height"
											);
							  echo form_input($inputattrib); ?>
							  <?php if (isset($field['tooltip'])) { ?>
							
								<!--<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
							
								<?php echo $field['tooltip'];?>
						
								</span>
								</span>-->
							
							<?php } ?>

							</div>
							
							 <span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>

							<?php
							break;
						
						case 'file':
							?>
							<div class="col-sm-6">
							<div style="float:left;">
							 <?php
							 $fvalue = isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : '';
							 ?>
							 <input type="file" name="<?php echo  $field['name'];?>"  id="<?php echo $field['name']; ?>"></div>
							 <?php 
							 if (isset($fldpostdata[$field['name']]) || isset($fldtemplateOptions[$field['name']])) {
							 ?>
							 <div style="float: left;margin-left: 20px;">
							 <img src="<?php echo base_url().$fvalue;?>" style=" max-width: 100px; max-height: 100px; " />
							 <br /><br /><br/>
							 <?php
							 }
							 ?>
								<?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>
							</div>
							</div>
							 <span class="error"><?php echo form_error($field['name']); ?></span>

							<?php
							break;
						
						case 'textarea':
							if (isset($field['editor']) && $field['editor'] == "true") {
								$fieldeditor[]  = $field['name'];
							}
							?>
							<div class="col-sm-9">
							<textarea name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class="stinput form-control" rows="6">
							<?php echo isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : ''; ?>
							</textarea><br /><br /><br/>
							<?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>
							</div>					
							<span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>
							<?php
							break;
						
						case 'hidden':

							$fieldattrib = array('name' => trim($fieldset).'['.$field['name'].']' , 'value' => $field['value']);
							?>
							<p>

							 <?php echo form_hidden(trim($fieldset).'['.$field['name'].']',$field['value']); ?>
							 </p>
							<?php
							break;
						
						case 'select':
							?>
							<div class="col-sm-12">
							 <select name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class='form-control form-height'>

								<?php foreach($field['option'] as $option){ ?>

									 <option value="<?php echo $option['value'];?>" <?php echo ((isset($fldpostdata[$field['name']]) && $option['value'] == $fldpostdata[$field['name']]) || (!isset($fldpostdata[$field['name']]) && isset($fldtemplateOptions[$field['name']]) && $option['value'] == $fldtemplateOptions[$field['name']])) ? 'selected="selected"' : '';?>><?php echo $option['text'];?></option>

								<?php }?>

							</select>
							<?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>
							</div>
							
							<span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>
							<?php
							break;
					}
					?>

					</td>

					</tr>
					<?php
					}
				}
				
				?>
                
                <form method="post">
				<tr>
					<td class="col-sm-4 field-title">Upload Banner :</td>
					<!-- <input type="file" name="file_b" id="file_b" class="form-control"> -->
					 <input type="hidden" class="form-control" value="<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['bannerimage']; ?>" name="bannername" id="bannername">
					<td class="col-sm-8" id="localimage_i">
					  <div class="col-sm-6 img-grey-border">
					  	<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['bannerimage']; ?>" width="150" id="imgnamebanner">
					  </div>
					  <div class="col-sm-6">
						<a href="<?php echo base_url(); ?>admin/templates/cropimage/banner" class="banimg_pop btn btn-success img-align btn-border-blue">Add Banner Image</a>
						<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['bannerimage']; ?>" width="150" id="imgname"> -->
						<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['bannerimage']; ?>" width="150" id="imgname"> -->
					  </div>
					  <br>
						<span class="error"><?php echo form_error('file_b'); ?></span><span class="help-inline">Banner (1140px X 360px)</span>

                    </td>
                    
				</tr>
				<br/><br/>
				<!-- @@@@@@@@@@@ new code start here @@@@@@@@@@@@@-->
				<!-- <tr></tr>
				 -->
				<tr>
					<td class="col-sm-4 field-title">Banner Title :</td>
					<td class="col-sm-8">
					 <input type="text" class="form-control form-height" value="<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['banneTitle']; ?>" name="banneTitle" id="banneTitle" style="width: 100%;  margin-top: 4%;">
				</td>
				</tr>
				<!-- @@@@@@@@@@@ new code End here @@@@@@@@@@@@@-->

				</form>
			</tbody>
			</table>
		</fieldset>
		<?php	
		  
		}

		?>

				<!--Slider fieldset-->
		<?php 

			
			
		$templateOptions = (array)$templateOptions;
		//echo"<pre>";
		//print_r($templatefields);
		//echo"</pre>";
		$i = 1; 
		$sli =1;      
		foreach ($templatefields as $fieldset => $fields) {	

				
		?>
		<?php
		foreach ($fields as $key => $field1) {
				  	if($field1['name'] == 'slider_showhide')
				  	{
				  		
				  	foreach($field1['option'] as $option1){	
				  	
				  	?>
				  	<input type="hidden" id="svalue<?php echo $sli ?>" name="svalue<?php echo $sli ?>" value="<?php echo $fldtemplateOptions[$field1['name']]; ?>"	>
				  	<?php
				  	$sli++;		  		
				  	//echo ((isset($fldpostdata[$field['name']]) && $option1['value'] == $fldpostdata[$field1['name']]) || (!isset($fldpostdata[$field1['name']]) && isset($fldtemplateOptions[$field1['name']]) && $option1['value'] == $fldtemplateOptions[$field1['name']])) ? 'slider' : ''; 
				  	 //echo ((isset($fldpostdata[$field['name']]) && $option['value'] == $fldpostdata[$field['name']]) || (!isset($fldpostdata[$field['name']]) && isset($fldtemplateOptions[$field['name']]) && $option['value'] == $fldtemplateOptions[$field['name']])) ? 'selected="selected"' : '';
				  	}
				  }
				}

		?>

       
       	<fieldset class="adminform" id="slider_field<?php echo $i; ?>" style="display:none">
			<!--<legend><?php echo 'Design Settings';?></legend>-->

			<table class="adminform homepage-table">
			
			<tbody>
				<?php
				  
					
				foreach ($fields as $key => $field) {	
					
					      
					     if($field['name'] == 'slider_showhide' ||  
					     	$field['name'] == 'slide_heading1' ||
					     	$field['name'] == 'slide_heading2' ||
					     	$field['name'] == 'slide_heading3' ||
					     	$field['name'] == 'slide_heading4' ||
					     	$field['name'] == 'slide_containt1' ||
					     	$field['name'] == 'slide_containt2' ||
					     	$field['name'] == 'slide_containt3' ||
					     	$field['name'] == 'slide_containt4' ||
					     	$field['name'] == 'slide_image1' ||
					     	$field['name'] == 'slide_image2' ||
					     	$field['name'] == 'slide_image3' ||
					     	$field['name'] == 'slide_image4' ||
					     	$field['name'] == 'slider_aoutoplay' ||
					     	$field['name'] == 'slide_interval' ||
					     	$field['name'] == 'bg_image4' ||
					     	$field['name'] == 'slider_heading_color' ||
					     	$field['name'] == 'slider_desc_color' ||
					     	$field['name'] == 'slider_color'
					     	 ) {
					      
					?>
					<tr <?php if ($field['type'] == 'hidden') { ?>style="display:none;"<?php }?>>
					
					<td width="30%">
						<p>
							<label style="margin-bottom: 33px;" class='col-sm-12 field-title labelform' for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?>
							<?php if ($field['rule']=='required') {
							?>
							<span class="required">*</span></label>
							<?php
							}?>
						</p>
					</td>
					<td>
					
					<?php
					$fldpostdata = $postdata[trim($fieldset)];
					if (isset($templateOptions[trim($fieldset)])) 
					{
						$fldtemplateOptions = (array)$templateOptions[trim($fieldset)];
					}


					$class = '';

					if($field['name'] == 'slide_heading1')
					{
			?>
				<div style="padding-left:3%;">First Slide</div>

			<?php
					}
					if($field['name'] == 'slide_heading2')
					{
			?>
				<div style="padding-left:3%;">Second Slide</div>

			<?php
					}

			        if($field['name'] == 'slide_heading3')
					{
			?>
				<div style="padding-left:3%;">Third Slide</div>

			<?php
					}
					if($field['name'] == 'slide_heading4')
					{
			?>
				<div style="padding-left:3%;">Fourth Slide</div>

			<?php
					}

					switch ($field['type']) {
						case 'text':
							?>
							<?php
							  if($field['name'] == 'slider_desc_color')
							      {
							      	?>
							      	<div class="col-sm-12 slider-heading-top-margin">
							      	<label  class="field-title slider-heading-left-margin labelform"  id="sliderTitle_colorlabel<?php echo $i ?>" >Slider Heading color :</label>
							
						<input   name="sliderTitle_color<?php echo $i ?>" id="sliderTitle_color<?php echo $i ?>" class="form_control color form-height" value="<?php echo @$templateOptions['sliderTitle_color2'] ? @$templateOptions['sliderTitle_color2'] :'' ?>" style="width: 100%;margin-top: -47px; padding-top: 7px;">
							      	</div></br>
							      	<?php
							      }
							      	?>
							<div class="col-sm-12">
							 <?php
							 if (isset($field['color']) && $field['color'] == 'true') {
								$class = ' color';
								$class.=" form-control form-height";
							 }
							 
							 $fvalue = isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : '';
							 if (isset($field['placeholder'])) {
								$placeholder = $field['placeholder'];
							 }
							 $inputattrib  = array(
											'name'=> trim($fieldset).'['.$field['name'].']',
											'id'=>$field['name'],
											'placeholder'=>$placeholder,
											'value'=>$fvalue,
											'class'=> "form-control form-height"
											);

							 if($field['name'] == 'slider_desc_color')
							      {

							      	$inputattrib['onkeyup'] = "if (this.value.length == 6) {relateColor('pick_zdonecolor', this.value); changeBcolor();}";
							      	$inputattrib['onchange'] = "if (this.value.length == 6) {relateColor('pick_zdonecolor', this.value);}";

					?>
							<!-- <a style="border-radius: 4px 4px 4px 4px;



    float: left; height: 30px; margin-right: 10px; width: 110px; background-color:#ACE0F6" id="pick_zdonecolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_zdonecolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a> -->

					<?php
								}
							  echo form_input($inputattrib); 

							      if($field['name'] == 'slider_desc_color')
							      {
							?>

                                     <script language="javascript">
                                     	relateColor('pick_xdonecolor', getObj(<?php echo $field['name']; ?>).value);
                                     </script>
                             <?php
							      }

							  ?>
							  <?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>

							</div>
							

							 <span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>

							<?php
							break;
						
						case 'file':
							?>
							<div class="col-sm-12" style="display: -webkit-box;">
							<div style="float:left;">
							 <?php
							 $fvalue = isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : '';
							 ?>
							 <input type="hidden" name="<?php echo  $field['name'];?>"  id="<?php echo $field['name']; ?>"></div>
							 <?php 
							 if (isset($fldpostdata[$field['name']]) || isset($fldtemplateOptions[$field['name']])) {
							 ?>
							 <div class="col-sm-12" style="float: left;padding-left:0px;">
							 <div class="col-sm-6 img-grey-border" style="margin-right:3%;">
							 <img id="<?php echo $field['name'].'1'; ?>" src="<?php echo base_url().$fvalue;?>" style=" max-width: 100px; max-height: 100px; " />
							 </div>
							 <?php 
							 if($field['name'] == 'bg_image4')
							  {
							  	?>
							  	<div class="col-sm-5">
							 <a href="<?php echo base_url(); ?>admin/templates/cropSliderBg/<?php echo $field['name']; ?>" class="fancybox fancybox.iframe btn btn-success img-align btn-border-blue ">Add Slider Backgound Image</a>
							 </div>
							 <?php 
							 	}
							 	else
							 	{
							 ?>
							 <div class="col-sm-5">
							 <a href="<?php echo base_url(); ?>admin/templates/cropSlider/<?php echo $field['name']; ?>" class="fancybox fancybox.iframe btn btn-success img-align btn-border-blue ">Add Slider Image</a>
							 </div>
							 <?php }?>
							 	  
							 <input type="hidden" name="<?php echo $field['name']; ?>" id="<?php echo $field['name'].'11'; ?>" value="<?php echo $fvalue; ?>" />
						
							<br /><br /><br /><br/>
							 <?php
							 }
							 ?>
								<?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>
							</div>
							</div>
							 <span class="error"><?php echo form_error($field['name']); ?></span>

							<?php
							break;
						
						case 'textarea':
							if (isset($field['editor']) && $field['editor'] == "true") {
								$fieldeditor[]  = $field['name'];
							}
							?>
							<div class="col-sm-12">
							<textarea name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class="stinput form-control form-height" rows="6">
							<?php echo isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : ''; ?>
							</textarea>
							<?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>
							</div>					
							<span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>
							<?php
							break;
						
						case 'hidden':

							$fieldattrib = array('name' => trim($fieldset).'['.$field['name'].']' , 'value' => $field['value']);
							?>
							<p>

							 <?php echo form_hidden(trim($fieldset).'['.$field['name'].']',$field['value']); ?>
							 </p>
							<?php
							break;
						
						case 'select':
							?>
							<div class="col-sm-12">
							 <select name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class='form-control form-height'>

								<?php foreach($field['option'] as $option){ ?>

									 <option value="<?php echo $option['value'];?>" <?php echo ((isset($fldpostdata[$field['name']]) && $option['value'] == $fldpostdata[$field['name']]) || (!isset($fldpostdata[$field['name']]) && isset($fldtemplateOptions[$field['name']]) && $option['value'] == $fldtemplateOptions[$field['name']])) ? 'selected="selected"' : '';?>><?php echo $option['text'];?></option>

								<?php }?>

							</select>
							<?php if (isset($field['tooltip'])) { ?>
							<!-- tooltip area -->
								<span class="tooltipcontainer">
								<span type="text" id="<?php echo $field['name'];?>-target" class="tooltipicon" title="Click Here"></span>
								<span class="<?php echo $field['name'];?>-target  tooltargetdiv" style="display: none;" >
								<span class="closetooltip"></span>
								<!--tip containt-->
								<?php echo $field['tooltip'];?>
								 <!--/tip containt-->
								</span>
								</span>
							<!-- tooltip area finish -->
							<?php } ?>
							</div>
							
							
							<span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>
							<?php
							break;
					}
					?>

					</td>
					</tr>
					<?php
					}
				}
				
				?>
				<!-- <tr>
				<td>
				<label  class="labelform" id="sliderTitle_colorlabel<?php echo $i ?>" >Slider Heading color :</label>
						<input   name="sliderTitle_color<?php echo $i ?>" id="sliderTitle_color<?php echo $i ?>" class="form_control color" value="<?php echo @$templateOptions['sliderTitle_color2'] ? @$templateOptions['sliderTitle_color2'] :'' ?>" style="width: 180%;margin-left: 170px;margin-top: -26px;">
				</td>
				</tr>-->
			</tbody>
			</table>
		</fieldset>
		<?php	
		  $i++;
		}

		?>
		</div>
	  </div>
</div>
</div>
<!-- <img src="" id="imgdemo" width="200" height="200">
<input type="text" class="form-control" name="demoinput" id="demoinput" value=""> -->
</div>
</div>
</div>
</div>


<?php if ($updType == 'edit'): ?>
  <input type="hidden"  name="switchtab" id="switchtab" value="">
	<?php echo form_hidden('id',$id) ?>

<?php endif ?>



<?php echo form_close(); ?>

<!--easywizard-->
 <!-- <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:block">
    <form id="frmWizard" method="post" enctype="multipart/form-data">
        <div id="modal-dialog" class="modal-dialog" role="document" >
            <div id="modal-content" class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Easy Wizard</h4>
                </div>
                <div class="modal-body wizard-content" id="bodywiz">
                   <div class="wizard-step">
                     
                    <div class="form-group">
						<label class="col-sm-3 control-label">Academy Name </label>
						
						<div class="col-sm-5">
							
                           
<div class="themegroup1">
    
	<input type="text" class="form-control tour_1" name="instititle" id="instititle" value="<?php echo ($this->input->post('insti_title')) ? $this->input->post('insti_title') : $settings[0]['institute_name']; ?>" style="width: 100%;">
	
</div>

						<span class="tooltipcontainer">
						<span type="text" id="insti_title-target" class="tooltipicon"></span>
						<span class="insti_title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
					
						<?php echo"You Institute Name Here"; //lang('layout_fld_themes');?>
                    
						</span>
						</span>

						</div>
						<div class="col-sm-4">
						<p style="text-align: center;" class="pdesign">Put your Online Academy's Name here which will be visible in the tab of your website.</p>
						</div>
						<br />
                    <br />

                    <div style="clear:both;"></div>
                    
					</div>
				
                
                   <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Logo :</label>
						
						<div class="col-sm-5">
                               

                                  <input type="hidden" class="form-control" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" name="imagename" id="imagename">

                     

					<div id="localimage_i">

					
<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" width="150" id="imgname2logo">
                   <a href="<?php echo base_url(); ?>admin/templates/croplogo/logo" class="fancybox fancybox.iframe btn btn-success">Add Logo</a>
                    </div>

                    <span class="error"><?php echo form_error('file_i'); ?></span><span class="help-inline">Logo (164px X 44px)</span>



                            
                            
						</div>
						<p class="pdesign">Please make sure that the name of the file for the logo does not contain any spaces or special characters.</p>
					</div>
                    <br />
                     <br />
                      <br />

                    <div class="form-group">
						<label class="col-sm-3 control-label">Theme Color :</label>
						
						<div class="col-sm-5">
							
                          
<div class="themegroup1">
	<select name="ltheme" id="ltheme" class="form-control">
		<?php foreach ($themes as $key => $value) {
		?>
		<option value="<?php echo $value;?>" <?php echo ( $settings[0]['layouttheme'] == $value )? 'selected="selected"' : ''?>><?php echo substr($value, 0, -4);?></option>
		<?php	
		}?>
	</select>
</div>

						<span class="tooltipcontainer">
						<span type="text" id="layouttheme2-target" class="tooltipicon"></span>
						<span class="layouttheme2-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
					
						<?php echo lang('layout_fld_themes');?>
                        
						</span>
						</span>

						</div>
					</div>
                    <br />
                    </div>	

                   <div class="wizard-step">
                     		
                     		<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">From Name :</label>
						
						<div class="col-sm-5">
							
                        <input type="text" class="form-control" value="<?php echo $fromname; ?>" name="frmname" id="frmname" size="32" placeholder="From Name">
						
                     

						<span class="tooltipcontainer">

						<span type="text" id="fromname-target" class="tooltipicon"></span>

						<span class="fromname-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('email_fld_from-name');?>

                     

						</span>

						</span>

						
						
                        </div>
					</div>
                    <br />
                    <br />
                    <br />
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">From Email</label>
						
						<div class="col-sm-5">
							
                        <input type="text" class="form-control" placeholder="From Email" value="<?php echo $fromemail; ?>" name="fromemail" size="32" readonly>
						
                      

						<span class="tooltipcontainer">

						<span type="text" id="fromemail-target" class="tooltipicon"></span>

						<span class="fromemail-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('email_fld_from-email');?>

                      

						</span>

						</span>

						
						</div>
					</div>
                    <br />
                    <br />
                    <br />

                    	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Your Signature</label>
						
						<div class="col-sm-5">
							
                       
						<textarea class="form-control" name="signtxt" id="signtxt" placeholder="Enter Your Signature" rows="5"><?php echo $signature; ?></textarea>
                        

						<span class="tooltipcontainer">

						<span type="text" id="signature-target" class="tooltipicon"></span>

						<span class="signature-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo"Enter Your Signature";//lang('email_fld_from-email');?>

                        

						</span>

						</span>

						
						</div>
						<br />
                  
					</div>
                    
					
					<div class="form-group">
					<br />  
                  
                    </div>	
                </div>
                <div class="modal-footer wizard-buttons">
                   <input type="button" value="Save" class="btn btn-info" />
                </div> 
            </div>
        </div>
    </div>
    </form>
  </div> -->
<style type="text/css">
	/*#lean_overlay
	{
		  position: fixed;		 
		  top: 0px;
		  left: 0px;
		  height: 100%;
		  width: 100%;
		  background: #000;
	}*/
</style>
  

 <!--  <div id="lean_overlay" style="display: block; opacity: 0.5;"></div> -->

<!--easywizard-->


<!-- tool tip script -->
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#slider_desc_color').addClass("color");
	jQuery('#slider_color').addClass("color");
	});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#sliderTitle_color1').css('display','none');
	jQuery('#sliderTitle_colorlabel1').css('display','none');
	});
</script>
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
			function ban_slider(val) 
			{

				if(val == 'banner')
				{
					jQuery('#banner_field').css('display','block');
					jQuery('#slider_field1').css('display','none');
					jQuery('#slider_field2').css('display','none');
				}
				if(val == 'slider')
				{
					jQuery('#slider_field1').css('display','block');
					jQuery('#slider_field2').css('display','block');
					jQuery('#banner_field').css('display','none');
				}
			}
			</script>

			<script>
			jQuery('#banner_showhide').on('change',function() {

				var bann_slider_val = jQuery(this).val();



				if(bann_slider_val == 'true')
				{
				
					jQuery('#slider_showhide').val('false');
				}
				if(bann_slider_val == 'false')
				{
					
					jQuery('#slider_showhide').val('true');
				}

			});

			jQuery('#slider_showhide').on('change',function() {

				var bann_slider_val = jQuery(this).val();



				if(bann_slider_val == 'true')
				{
				
					jQuery('#banner_showhide').val('false');
				}
				if(bann_slider_val == 'false')
				{
					
					jQuery('#banner_showhide').val('true');
				}

			});

			/*jQuery('#fwt_backgrd_hideshow').on('change',function() {

				var fwt_backgrd_hideshow_val = jQuery(this).val();



				if(fwt_backgrd_hideshow_val == 'true')
				{
				
					jQuery('#fwtBackgrd').show();
				}
				if(fwt_backgrd_hideshow_val == 'false')
				{
					
					jQuery('#fwtBackgrd').hide();
				}

			});*/

			</script>

			<script>
			function tabActive(tabname)
			{	
				

				jQuery.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>admin/templates/tabActive",
							data: {tabname:tabname}, 
							success: function(data)
							{
								//alert(data);
							//$("#followDiv").html(data);
							}
		  				});
			}
			</script>

			<script type="text/javascript">
				jQuery(document).ready(function(){
					 var b = jQuery("#bvalue1").val();
					 var s = jQuery("#svalue1").val();
					
				if(b == 'banner')
				{
					jQuery('#banner_field').css('display','block');
					jQuery('#slider_field1').css('display','none');
					jQuery('#slider_field2').css('display','none');					
					jQuery("#banner").prop("checked", true)
				}
				if(s == 'true')
				{
					jQuery('#slider_field1').css('display','block');
					jQuery('#slider_field2').css('display','block');
					jQuery('#banner_field').css('display','none');
					jQuery("#slider").prop("checked", true);
				}

				});
			</script>


	
	<style type="text/css">



		.fancybox-custom .fancybox-skin {



			box-shadow: 0 0 50px #222;



		}



	</style>

	<script type="text/javascript">
function deleteRow(){
    if (!document.getElementsByTagName || !document.createTextNode) return;
    var rows = document.getElementById('coursestoaddlist').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (i = 0; i < rows.length; i++) {
        rows[i].onclick = function() {
            //alert(this.rowIndex);
			if(this.rowIndex != 0)
			document.getElementById('coursestoaddlist').deleteRow(this.rowIndex);
        }
    }
}


</script>




     <script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

    <script src="<?php echo base_url()?>public/js/jquery.tablednd.js"></script>
	

 
    <link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

	<script type="text/javascript">

        var $ = jQuery;  
		$(document).ready(function() {
			/*

			 *  Simple image gallery. Uses default settings

			 */

			$('.fancybox').fancybox();







			/*



			 *  Different effects



			 */







			// Change title type, overlay closing speed



			$(".fancybox-effects-a").fancybox({



				helpers: {



					title : {



						type : 'outside'



					},



					overlay : {



						speedOut : 0



					}



				}



			});







			// Disable opening and closing animations, change title type



			$(".fancybox-effects-b").fancybox({



				openEffect  : 'none',



				closeEffect	: 'none',







				helpers : {



					title : {



						type : 'over'



					}



				}



			});







			// Set custom style, close if clicked, change title type and overlay color



			$(".fancybox-effects-c").fancybox({



				wrapCSS    : 'fancybox-custom',



				closeClick : true,







				openEffect : 'none',







				helpers : {



					title : {



						type : 'inside'



					},



					overlay : {



						css : {



							'background' : 'rgba(238,238,238,0.85)'



						}



					}



				}



			});







			// Remove padding, set opening and closing animations, close if clicked and disable overlay



			$(".fancybox-effects-d").fancybox({



				padding: 0,







				openEffect : 'elastic',



				openSpeed  : 150,







				closeEffect : 'elastic',



				closeSpeed  : 150,







				closeClick : true,







				helpers : {



					overlay : null



				}



			});







			/*



			 *  Button helper. Disable animations, hide close button, change title type and content



			 */







			$('.fancybox-buttons').fancybox({



				openEffect  : 'none',



				closeEffect : 'none',







				prevEffect : 'none',



				nextEffect : 'none',







				closeBtn  : false,







				helpers : {



					title : {



						type : 'inside'



					},



					buttons	: {}



				},







				afterLoad : function() {



					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');



				}



			});



			/*



			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked



			 */







			$('.fancybox-thumbs').fancybox({



				prevEffect : 'none',



				nextEffect : 'none',







				closeBtn  : false,



				arrows    : false,



				nextClick : true,







				helpers : {



					thumbs : {



						width  : 50,



						height : 50



					}



				}



			});

			$('.fancybox-media')

				.attr('rel', 'media-gallery')

				.fancybox({

					openEffect : 'none',



					closeEffect : 'none',



					prevEffect : 'none',



					nextEffect : 'none',







					arrows : false,



					helpers : {



						media : {},



						buttons : {}



					}



				});

			$("#fancybox-manual-a").click(function() {



				$.fancybox.open('1_b.jpg');



			});







			$("#fancybox-manual-b").click(function() {



				$.fancybox.open({



					href : 'iframe.html',



					type : 'iframe',



					padding : 5



				});



			});







			$("#fancybox-manual-c").click(function() {



				$.fancybox.open([



					{



						href : '1_b.jpg',



						title : 'My title'



					}, {



						href : '2_b.jpg',



						title : '2nd title'



					}, {



						href : '3_b.jpg'



					}



				], {



					helpers : {



						thumbs : {



							width: 75,



							height: 50



						}



					}



				});



			});











		});







     $(document).ready(function() {



         $("span.error").each(function() {



         var parent = $(this).closest('dd').attr('sno');



         var get_error = $(this).text();



          if(get_error != ''){



                $(this).closest('dd').prev('dt').css('background-color', 'red');



           }







        });







     });



	</script>

<script>
var 	$ =jQuery.noConflict();

		function switchconfirm1() 
	      {
		      
		    

			$.confirm({
    			title: ' ',
    			
    			content: 'Are You sure want to switch the tab.Before switching the tab please save all changes.',
    			confirmButton:'OK',
    			confirm: function(){ 

    				         //document.getElementById('templateoptions').submit();
    				         $("#widget").click();
    					// window.location.href = "<?php echo base_url();?>admin/widgets/index";
        						
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}
</script>
<script>
var 	$ =jQuery.noConflict();

		function switchconfirm2() 
	      {
		      
			$.confirm({
    			title: ' ',
    			
    			content: 'Are You sure want to switch the tab.Before switching the tab please save all changes.',
    			confirm: function(){ 

    						$("#testinomial").click();
    				      //document.getElementById('templateoptions').submit();
    					// window.location.href = "<?php echo base_url();?>admin/testimonials";
        						
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}
</script>
<script>
var 	$ =jQuery.noConflict();

		function switchconfirm3() 
	      {
		      
			$.confirm({
    			title: ' ',
    			
    			content: 'Are You sure want to switch the tab.Before switching the tab please save all changes.',
    			confirm: function(){ 

    					 $("#sociallink").click();
    				      //document.getElementById('templateoptions').submit();
    					// window.location.href = "<?php echo base_url();?>admin/sociallinks/createLink";
        						
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}
</script>

<script>
var $ =jQuery.noConflict();
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});

 function getSwitchTab(tab)
 {
 	$('#switchtab').val(tab);

 }
</script>

 <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
 <?php
   for($i=1;$i<=4;$i++)
   {
 ?>
	<script>
	var $ =jQuery.noConflict();
	$('document').ready(function() {
		$('#slide_containt<?php echo $i ?>').redactor({
			'plugins': ['fontcolor']
		});
		 
	});
	
	</script>
<?php
	}
?>
  
  <script>
  	$('document').ready(function() {  		
  		

		$('#signtxt').redactor({
			'plugins': ['fontcolor']
		});
		 
	});

	$('.close').on('click', function() {
		$('#myModal').css('display','none');
		$('#lean_overlay').css('display','none');
	});
  </script>

 <script src="<?php echo base_url() ?>public/js/easywizard/easyWizard.js"></script> 
    <script>
        $(document).on("ready", function(){
            $("#myModal").wizard({
                onfinish:function(){

              var acadname = $("#instititle").val();
              var themecolor = $("#ltheme").val();
              var fromname = $("#frmname").val();
              var signature = $("#signtxt").val();

        form_data = {
			 acadname,
			 themecolor,
			 fromname,		
			 signature,
        };

      
    

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/templates/saveData',
            data: form_data, 
            success: function(response) 
			{
                 if(response == 'success') 
				{
				  $("#bodywiz").slideUp('slow', function() {
                  $("#myModalLabel").html('<p style="color:green; text-align:center;"><h2>Data Saved Successfully.</h2></p>');
					});
					
					setTimeout(
					function() 
					{
						 var base_url = '<?php echo base_url(); ?>admin/templates/editoptions/45/';
						window.location.replace(base_url);
					}, 2000);

					/*setTimeout(
					function() 
					{
						//do something special					
             var base_url = window.location.origin;
						window.location.replace(base_url);
					}, 500);	*/														
                }
			} 

		});
  
       }

          
        });

           });
    </script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements

		//$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});	
		$j(".addlogo_pop").colorbox({
		iframe:true,
		width:"500px", 
		height:"50%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})

		$j(".addfev_pop").colorbox({
		iframe:true,
		width:"500px", 
		height:"50%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
        
        $j(".selcourse_pop").colorbox({
		iframe:true,
		width:"500px", 
		height:"85%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})

		$j(".banimg_pop").colorbox({
		iframe:true,
		width:"500px", 
		height:"60%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
	   });
		</script>