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
<?php

$attributes = array('class' => 'tform', 'id' => 'templateoptions', 'name' => 'templateoptions');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/templates/editoptions', $attributes) : form_open_multipart(base_url().'admin/templates/editoptions/'.$id, $attributes);

?>

<div id="toolbar-box">

	<div class="m">

		<div id="toolbar" class="toolbar-list">

			<ul style="float:right; list-style:none; width:19%;">

            <li id="toolbar-new" class="listbutton" style="float:left; margin-right:10px;"><a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'")); ?></a>

            </li>

			<li id="toolbar-new" class="listbutton">

            <a href='<?php echo base_url(); ?>admin/templates<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='bforward'><span class="btn btn-red">Cancel</span> </a>

			</li>

			</ul>

			<div class="clr"></div>

		</div>

		<div class="pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? 'Online academy Design Settings' : 'Online academy Design Settings'?></h2>
		<p> Here you can design the look and feel of your Online Academy</p>
		</div>

	</div>

</div>

<div>

    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>

</div>



	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">

			<div class="panel-title">
					<ul class="nav nav-tabs bordered" id="myTab"><!-- available classes "bordered", "right-aligned" --> 
					<?php  $vartab1 = $Active_tab == 'tab1' ? 'active':''; ?>
					<li id="tab1" class="<?php echo $vartab1; ?>"><a href="#logo_style" data-toggle="tab" onclick="tabActive('tab1');"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Logo and Theme Color</span></a></li> 
					<?php $vartab2 = $Active_tab == 'tab2' ? 'active':''; ?>					
					<li id="tab2" class="<?php echo $vartab2; ?>"> <a href="#homepagesettings" data-toggle="tab" onclick="tabActive('tab2');"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">HomePage Settings</span></a></li>
					<?php $vartab3 = $Active_tab == 'tab3' ? 'active':''; ?>
					<li class="<?php echo $vartab3; ?>"> <a href="#bannerslider" data-toggle="tab" onclick="tabActive('tab3');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Banner and Slider</span></a></li> 
						
					<li onclick="return confirm('Are you Sure want to switch the tab. Before switching the tab please save all changes.');"> <a href="<?php echo base_url();?>admin/widgets" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/widgets">Widgets</a></span></a></li>
					<li onclick="return confirm('Are you Sure want to switch the tab. Before switching the tab please save all changes.');"> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/testimonials">Testimonials</a></span></a></li>
					<li onclick="return confirm('Are you Sure want to switch the tab. Before switching the tab please save all changes.');"> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/sociallinks/createLink">Social Link</a></span></a></li>
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
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>


			
	<div class="panel-body">
		<div class="tab-content">
		<?php  $vartabpane = $Active_tab == 'tab1' ? 'active':''; ?>
			<div class="tab-pane <?php echo $vartabpane ?>" id="logo_style">
					<div><h4></h4></div>

					<!-- @@@@@@@start tagline @@@@@ -->
                    <br />
                    <br />
<div class="form-group">
						<label class="col-sm-3 control-label">Academy Name </label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
<div class="themegroup1">
	<input type="text" class="form-control" name="insti_title" id="insti_title" value="<?php echo ($this->input->post('insti_title')) ? $this->input->post('insti_title') : $settings[0]['institute_name']; ?>" style="width: 100%;">
</div>

						<span class="tooltipcontainer">
						<span type="text" id="insti_title-target" class="tooltipicon"></span>
						<span class="insti_title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo"You Institute Name Here"; //lang('layout_fld_themes');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
						<div class="col-sm-4">
						<p style="text-align: center;" class="pdesign">Put your Online Academy's Name here which will be visible in the tab of your website.</p>
						</div>
						<br />
                    <br />

                    <div style="clear:both;"></div>
                    
					</div>


                    <!-- @@@@@@@@@@@22 new code end here @@@@@@@@@@@@ -->


                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Logo :</label>
						
						<div class="col-sm-5">
                                  <input type="file" name="file_i" id="file_i" class="form-control">

                                  <input type="hidden" class="form-control" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" name="imagename" id="imagename">

                     

					<div id="localimage_i">

						<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" width="150" id="imgname">

                    </div>

                    <span class="error"><?php echo form_error('file_i'); ?></span><span class="help-inline">Logo (164px X 44px)</span>



                            
                            
						</div>
						<p class="pdesign">Please make sure that the name of the file for the logo does not contain any spaces or special characters.</p>
					</div>
                    <br />
                    <br />

                    <div style="clear:both;"></div>                    
                    <!-- @@@@@@@@@@@ new code is start here @@@@@@@@@@@ -->

                    	<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Favicon :</label>
						
						<div class="col-sm-5">
                                  <input type="file" name="file_f" id="file_f" class="form-control">

                                  <input type="hidden" class="form-control" value="<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" name="favname" id="favname">

                     

					<div id="localimage_i">

						<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" width="25" id="imgname">

                    </div>

                    <span class="error"><?php echo form_error('file_f'); ?></span><span class="help-inline"></span>



                            
                            
						</div>

						<div class="col-sm-4">
							<p style="text-align: center;" class="pdesign"><a href="https://en.wikipedia.org/wiki/Favicon" target="_blank">What is Favicon?</a></p>
						</div>

					</div>


                    <!-- @@@@@@@start tagline @@@@@ -->
                    <br />
                    <br />
<div class="form-group">
						<label class="col-sm-3 control-label">TagLine </label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
<div class="themegroup1">
	<input type="text" class="form-control" name="menu_title" id="menu_title" value="<?php echo ($this->input->post('menu_title')) ? $this->input->post('menu_title') : $settings[0]['univer_title']; ?>" style="width: 100%;">
</div>

						<span class="tooltipcontainer">
						<span type="text" id="layouttheme3-target" class="tooltipicon"></span>
						<span class="layouttheme3-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo"You TagLine Here"; //lang('layout_fld_themes');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
						<div class="col-sm-4">
						<p style="text-align: center;" class="pdesign">Put your Online Academy's tagline here which will be visible in the header of your website.</p>
						</div>
						<br />
                    <br />

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
					</select>
					<!-- tooltip area -->
				<!--<span class="tooltipcontainer">
					<span type="text" id="layouttemplate-target" class="tooltipicon"></span>
					<span class="layouttemplate-target  tooltargetdiv" style="display: none;" >
					<span class="closetooltip"></span>
					<!--tip containt-->
					<?php echo lang('layout_fld_template');?>
					<!--/tip containt-->
					<!--</span>
					</span>	
					<!-- tooltip area finish -->
						<!--</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>-->
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Theme Color :</label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
<div class="themegroup1">
	<select name="layouttheme" id="layouttheme" class="form-control">
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
						<span class="tooltipcontainer">
						<span type="text" id="layouttheme2-target" class="tooltipicon"></span>
						<span class="layouttheme2-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_themes');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                    <br />
                    <!-- new start here -->
                    <div class="form-group">
						<label class="col-sm-3 control-label">Tagline Font :</label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
			<div class="themegroup1">
			<select name="tagline_font" id="tagline_font" class="form-control">
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

						<span class="tooltipcontainer">
						<span type="text" id="layouttheme3-target" class="tooltipicon"></span>
						<span class="layouttheme3-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_themes');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
					<br />
                    <br />
                    <br />
                    <div class="form-group">
						<label class="col-sm-3 control-label">Tagline Font Size :</label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
			<div class="themegroup1">
			<input   name="tagline_font_size" id="tagline_font_size" class="form-control" value="<?php echo ($this->input->post('tagline_font_size')) ? $this->input->post('tagline_font_size') : $settings[0]['tagline_font_size']; ?>" >
			</div>

						<span class="tooltipcontainer">
						<span type="text" id="layouttheme4-target" class="tooltipicon"></span>
						<span class="layouttheme4-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_themes');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>

					<br />
                    <br />
                    <br />
					<div class="form-group">
						<label class="col-sm-3 control-label">Tagline Font color :</label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
			<div class="themegroup1">
			<input   name="tagline_font_color" id="tagline_font_color" class="form-control color {required :false,hash:true}" value="<?php echo ($this->input->post('tagline_font_color')) ? $this->input->post('tagline_font_color') : $settings[0]['tagline_font_color']; ?>" >
			</div>

						<span class="tooltipcontainer">
						<span type="text" id="layouttheme5-target" class="tooltipicon"></span>
						<span class="layouttheme5-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_themes');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
                    <!-- new code end here -->
                    <div style="clear:both;"></div>
			</div>
			<?php  $vartabpane2 = $Active_tab == 'tab2' ? 'active':''; ?>
           <div class="tab-pane <?php echo $vartabpane2; ?>" id="homepagesettings">
           <p class="pdesign">Here you can edit the Display Setting of the home of your Online Academy</p>
			<!--Main fieldset-->
		<?php 
			//echo '<pre>';
			//print_r($templatefields);
			
		$templateOptions = (array)$templateOptions;
		      
		foreach ($templatefields as $fieldset => $fields) {	

				
		?>



		<fieldset class="adminform">
			<!--<legend><?php echo 'Design Settings';?></legend>-->
			
			<table class="adminform">
			
			<tbody>
				<?php
				  
					
				foreach ($fields as $key => $field) {		    
					     
					     if($field['name'] == 'aboutusinfotext_showhide' ||  
					     	$field['name'] == 'topbarloginregister_showhide' ||
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
					
					<td width="15%">
						<p>
							<label class='labelform' for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?>
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
							<div class="col-sm-5">
							 <?php
							 if (isset($field['color']) && $field['color'] == 'true') {
								$class = ' color';
								$class.=" form-control";
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
											'class'=> "form-control"
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
							<br /><br /><br /><br />

							 <span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>

							<?php
							break;
						
						case 'file':
							?>
							<div class="col-sm-5">
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
							 <br /><br /><br /><br />
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
							</textarea><br /><br /><br /><br />
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
							<div class="col-sm-5">
							 <select name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class='form-control'>

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
							<br />
							<br />
							<br />
							<br />
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
				<label>Footer widget and Testimonial <br/>Backgroung :</label>
						
							<select name="fwt_backgrd_wo" id="fwt_backgrd_wo" class="form_control">
								
								<option <?php  if($templateOptions['fwt_backgrd_wo'] == 'true') { echo 'selected' ;} ?> value="true">With Background</option>
								<option <?php  if($templateOptions['fwt_backgrd_wo'] == 'false') { echo 'selected' ;} ?> value="false">Without Background</option>
							</select>
						
		</div>

		<!-- @@@@@@@@@@@ new code is start here @@@@@@@@@@@ -->
<div class="form-group">
						<label class="col-sm-2 control-label">Display Total number of Courses </label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
<div class="themegroup1">
	<input type="text" class="form-control" name="total_course" id="total_course" value="<?php echo ($this->input->post('total_course')) ? $this->input->post('total_course') : $settings[0]['course_total']; ?>" style="width: 85%;margin-left: -19px;">

	<a onclick="this.href='<?php echo base_url()?>admin/templates/courselist/'+document.getElementById('total_course').value" class="fancybox fancybox.iframe btn btn-primary">
			<i class="entypo-plus"></i>Select Courses</a>
</div>

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
						<br />
                    <br />

                    <div style="clear:both;"></div>
                    
					</div>

					<div class="form-group">
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
								<?php $i = 0;?>
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

										?>

										<tr id="row<?php echo $queid;?>">			
											<td class=" ">									            
												<?php echo $gotQuestion->id?></a>
											</td>
											
								            <td class=" ">
									            <!--<a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe">-->
												<?php echo $gotQuestion->name?>
											</td>
								            
								        	<td class=" ">
								        	<!--<div class='removeque' removeid="<?php echo $queid;?>" id="remove<?php $queid;?>">remove</div>-->
								        	<span class="removespan"><a href="javascript:void(0);" onclick="deleteRow(this)" class="removeele" id="remove'+$(this).val()+'">Remove</a></span>
								        	</td>

								        	<!--<td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="'+$(this).val()+'"></td>-->
								        	<td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="<?php echo $gotQuestion->id?>"></td>
											
									        <!--<td class=" ">            
									            <a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?><?php //echo ($category_id != "") ? $category_id : "0" ?>/<?php //echo $page?>" class ="fancybox fancybox.iframe btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>           
									        </td>-->
											
								       		<!--<td class=" ">
												<?php if($question->published){?>
												<a title="Unpublish Item" href="<?php echo base_url(); ?>/admin/quizzes/activation/deactivate/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php echo $updType; ?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>
												<?php }else{?>
												<a title="Publish Item" href="<?php echo base_url(); ?>/admin/quizzes/activation/activate/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php echo $updType; ?>"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>
												 <?php }?>
											</td>-->            
										</tr>

										<?php
									}}}
										?>
										<?php //endforeach		
										?>
									</tbody>
						</table>
						
					</div>

					<div  style="  margin-top: 21px;" class="form-group>
						<label class="labelform">Testimonial :</label>
						<select style="  margin-left: 85px; width: 16%;" name="testimonial_enable" id="testimonial_enable" class="form_control">
													
													<option <?php  if(@$templateOptions['testimonial_enable'] == 'true') { echo 'selected' ;} ?> value="true">Show</option>
													<option <?php  if(@$templateOptions['testimonial_enable'] == 'false') { echo 'selected' ;} ?> value="false">Hide</option>
												</select>
												</div>

												<div style="  margin-top: 21px;" class="form-group>
						<label  class="labelform">Testimonial Title :</label>
						<input   name="testimonial_name" id="testimonial_name" class="form_control" value="<?php echo @$templateOptions['testimonial_name'] ? @$templateOptions['testimonial_name'] :'' ?>" style="width: 33%;margin-left: 60px;">
												</div>

							<!-- @@@@@@@@@@@@@@@new start here -->

								<div  style="  margin-top: 21px;" class="form-group">
						<label class="labelform">Widget Heading Font :</label>
						<select style="  margin-left: 35px; width: 33%;padding-top: 7px; background-color: rgb(250, 250, 250);" name="widget_heading_font" id="widget_heading_font" class="form_control">
													
													<!-- <option <?php  if(@$templateOptions['widget_heading_font'] == 'true') { echo 'selected' ;} ?> value="true">Show</option>
													<option <?php  if(@$templateOptions['widget_heading_font'] == 'false') { echo 'selected' ;} ?> value="false">Hide</option> -->
						 <option style="font-family : Arial" value=" " <?php echo ( @$templateOptions['widget_heading_font'] == '0' )? 'selected="selected"' : ''?>>Select Font</option>

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
							<div style="  margin-top: 21px;" class="form-group">
						<label  class="labelform">Widget Heading Size</label>
						<input   name="widget_heading_size" id="widget_heading_size" class="form_control" value="<?php echo @$templateOptions['widget_heading_size'] ? @$templateOptions['widget_heading_size'] :'' ?>" style="width: 33%;margin-left: 43px;">
							(In Pixel)						
													</div>

							<div style="  margin-top: 21px;" class="form-group">
						<label  class="labelform">Widget Heading Color</label>
						<input   name="widget_heading_color" id="widget_heading_color" class="form_control color {required:false,hash:true}" value="<?php echo @$templateOptions['widget_heading_color'] ? @$templateOptions['widget_heading_color'] :'' ?>" style="width: 33%;margin-left: 37px;">
												
													</div>
							<!-- @@@@@@@@@@@@@@@new end here -->
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
						
						<!--<p style="text-align: center;"> (Put Total number of course show in home page of your website.)</p>-->
						<br />
                    <br />

                    <div style="clear:both;"></div>
                    
				


                    <!-- @@@@@@@@@@@22 new code end here @@@@@@@@@@@@ -->

		<script>
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
		</script>

		</div>
		<?php  $vartabpane3 = $Active_tab == 'tab3' ? 'active':''; ?>
		<div class="tab-pane <?php echo $vartabpane3; ?>" id="bannerslider">
            <p class="pdesign">You can either choose a static banner or a dynamic slider of multiple images appearing below the header in your home page. If you choose the banner option then the signup box will appear by default on the right hand side of the image. In case you do not want to show the signup box then choose the slider option and put 1 to 5 images.</p>
			<div style="margin-left: 160px;"><label>Choose Option :</label>
				<input  style="margin-left: 80px;" type="radio" onclick="ban_slider('banner')" name="banner_slider" id="banner" value="banner" checked="true" />Banner </br>
				 <input style="margin-left: 170px;" type="radio" name="banner_slider" onclick="ban_slider('slider')" id="slider" value="Slider" />Slider 	
			</div>

			

			
				<!--Banner fieldset-->
		<?php 

			
			
		$templateOptions = (array)$templateOptions;
		      
		foreach ($templatefields as $fieldset => $fields) {	

				
		?>
		
		 <fieldset class="adminform" id="banner_field" style="display:none"> 		
			<!--<legend><?php echo 'Design Settings';?></legend>-->

			<table class="adminform">
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
					
					<td width="15%">
						<p>
							<label class='labelform' for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?>
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
							<div class="col-sm-5">
							 <?php
							 if (isset($field['color']) && $field['color'] == 'true') {
								$class = ' color';
								$class.=" form-control";
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
											'class'=> "form-control"
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
							<br /><br /><br /><br />

							 <span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>

							<?php
							break;
						
						case 'file':
							?>
							<div class="col-sm-5">
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
							 <br /><br /><br /><br />
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
							</textarea><br /><br /><br /><br />
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
							<div class="col-sm-5">
							 <select name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class='form-control'>

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
							<br />
							<br />
							<br />
							<br />
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
					<td>Upload Banner :</td>
					<td><input type="file" name="file_b" id="file_b" class="form-control"></td>
					 <input type="hidden" class="form-control" value="<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['bannerimage']; ?>" name="bannername" id="bannername">
				</tr>
				<tr>
				    <td></td>
					<td id="localimage_i">

						<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['bannerimage']; ?>" width="150" id="imgname"> -->
						<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['bannerimage']; ?>" width="150" id="imgname">
						<span class="error"><?php echo form_error('file_b'); ?></span><span class="help-inline">Banner (1140px X 360px)</span>

                    </td>

                    



				</tr>
				<!-- @@@@@@@@@@@ new code start here @@@@@@@@@@@@@-->
				<tr></tr>
				<tr>
					<td>Banner Title :</td>
					<td>
					 <input type="text" class="form-control" value="<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['banneTitle']; ?>" name="banneTitle" id="banneTitle" style="width: 100%;">
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

			<table class="adminform">
			
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
					
					<td width="15%">
						<p>
							<label class='labelform' for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?>
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
				<div>First Slide</div>

			<?php
					}
					if($field['name'] == 'slide_heading2')
					{
			?>
				<div>Second Slide</div>

			<?php
					}

			        if($field['name'] == 'slide_heading3')
					{
			?>
				<div>Third Slide</div>

			<?php
					}
					if($field['name'] == 'slide_heading4')
					{
			?>
				<div>Fourth Slide</div>

			<?php
					}

					switch ($field['type']) {
						case 'text':
							?>
							<?php
							  if($field['name'] == 'slider_desc_color')
							      {
							      	?>
							      	<div >
							      	<label  class="labelform" style="margin-left: -144px;" id="sliderTitle_colorlabel<?php echo $i ?>" >Slider Heading color :</label>
							
						<input   name="sliderTitle_color<?php echo $i ?>" id="sliderTitle_color<?php echo $i ?>" class="form_control color" value="<?php echo @$templateOptions['sliderTitle_color2'] ? @$templateOptions['sliderTitle_color2'] :'' ?>" style="width: 38%;margin-left: 45px;;margin-top: -47px; padding-top: 7px;">
							      	</div></br></br>
							      	<?php
							      }
							      	?>
							<div class="col-sm-5">
							 <?php
							 if (isset($field['color']) && $field['color'] == 'true') {
								$class = ' color';
								$class.=" form-control";
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
											'class'=> "form-control"
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

                                     <script language="javascript">relateColor('pick_xdonecolor', getObj(<?php echo $field['name']; ?>).value);</script>
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
							<br /><br /><br /><br />

							 <span class="error"><?php echo form_error(trim($fieldset).'['.$field['name'].']'); ?></span>

							<?php
							break;
						
						case 'file':
							?>
							<div class="col-sm-5">
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
							 <br /><br /><br /><br />
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
							</textarea><br /><br /><br /><br />
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
							<div class="col-sm-10">
							 <select name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class='form-control'>

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
							<br />
							<br />
							<br />
							<br />
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
				</tr> -->
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
</div>

<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$id) ?>

<?php endif ?>



<?php echo form_close(); ?>


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


			<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

    <script src="<?php echo base_url()?>public/js/jquery.tablednd.js"></script>
	
	<!--<script>
		jQuery(document).ready(function() {
		  
		    jQuery('#description').redactor();
		 
		});
	
	</script>-->

    <!--<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">-->

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
