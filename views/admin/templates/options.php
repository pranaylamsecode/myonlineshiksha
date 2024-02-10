
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/easywizard/easyWizard.css">
<!--easywizard-->
<style type="text/css">
#templateoptions .up_logo {
    width: auto;
    max-width: 330px;
    height: auto;
}
.up_favicon_sec .error{
	padding: 0px !Important;
}
#templateoptions img#imgnamelogo, #templateoptions img#imgnameficon {
    width: auto;
    max-width: 100%;
}

 #templateoptions .up_favicon{
	width: auto;
	max-width: 50px;
	height: auto;
}
.slider-heading-top-margin {
	margin-top: 0px !important;
}
label[for="slider_desc_color"]{
	margin-top: 42px;
}
.save-btn{
background-color: #f0f0f1;
    border: none;
}
.save-btn:hover{
background-color: #dbdbdd !important;
    border: none;
}
.jconfirm-box .title {
  font-family: 'AvenirNextLTPro-Regular'!important;
  font-weight: 400!important;
  color: #5a5a5a!important;
  text-transform: uppercase;
  font-size: 21px!important;
  text-align: center!important;
  padding: 20px 30px 0 13px !important;
  margin-top: 0px!important;
  border-bottom: 1px dotted #999;
  height: 64px!important;
  border-radius: 8px 8px 0px 0;
  margin-bottom: 2%;
}
.jconfirm .jconfirm-box div.content {
  font-size: 15px;
  font-family: 'AvenirNextLTPro-Regular';
  font-weight: 400;
  text-align: center;
  color: #5a5a5a;
  padding: 3% 4% 4%!important;
}
button.btn.btn-success {
  background-color: #04A600!important;
}
.jconfirm.white .jconfirm-box .buttons {
  float: none;
  margin: 0 auto;
  text-align: center;
  padding: 4%!important;
  border-top: 1px dotted #999;
}




@media (max-width: 1200px){
	.label.field-title.slider-heading-left-margin {
	width: 15%;
}
}
</style>
<?php
 
  $u_data=$this->session->userdata('loggedin');

  $maccessarr=$this->session->userdata('maccessarr');

  $this->session->flashdata('message');
  $Active_tab ='tab1';
  
?>

<div class="main-container">

<?php 
 function tabActive($tabname=NULL)
{
	$tabname =$tabname ? $tabname : 'tab1';
	$this->session->set_userdata('Active_tab',$tabname);
}
  $CI = & get_instance(); 


$attributes = array('class' => 'tform', 'id' => 'templateoptions', 'name' => 'templateoptions');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/templates/editoptions', $attributes) : form_open_multipart(base_url().'admin/templates/editoptions/'.$id, $attributes);

?>

<div id="toolbar-box">

	<div class="m">
		<div class="pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? 'Customise the academy' : 'Customise the academy'?></h2>
			<h6 class="pmaintitle main_subtitle">
		Design the look and feel of your online academy.
	</h6>
		<!-- <p> Here you can design the look and feel of your Online Academy</p> -->
		<button type="button" style="display: none;"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Wizard
        </button>
		</div>

		<div id="toolbar" class="toolbar-list">
			<div id="sticky-anchor"></div>
			<ul id="sticky" class="main-content-btn" style="float:right; list-style:none;display: flex;">
			<!-- <li id="toolbar-new" class="listbutton" style="float:left; margin-right:10px;"><a class='btn btn-blue' style="padding: 5px 7px 5px 4px;"><?php //echo "<i class='entypo entypo-install'></i>".form_submit( 'btnsubmit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='btnsubmit' class='save-btn'" : "id='btnsubmit' class='save-btn'")); ?></a> -->
            <li id="toolbar-new" class="listbutton" style="float:left; margin-right:10px;"><a class='btn btn-green'><?php echo "".form_submit( 'btnsubmit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='btnsubmit' class='no-background'" : "id='btnsubmit' class='no-background'")); ?></a>
            </li>

			<li id="toolbar-new" class="listbutton">

            <a href='<?php echo base_url(); ?>admin<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='bforward btn top_grey_btn'>Cancel</a>

			</li>

			</ul>

			

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
<div class="card">
<div class="field_content" style="width: 100%;">
	

		
		<div class="panel panel-primary primary-border" data-collapsed="0">
			<div class="panel-heading">


			<div class="panel-title" style="padding:0;width:100%;">
					<ul class="nav nav-tabs" id="myTab"><!-- available classes "bordered", "right-aligned" --> 

					<li id="tab1" style="border-left:none;" class="active"><a href="#logo_style" class="home-page-li-border " data-toggle="tab" onclick="tabActive('tab1');"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Basic</span></a></li> 

					<li id="tab2" > <a href="#homepagesettings" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab2');"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Homepage</span></a></li>

					<li id="tab3" > <a href="#bannerslider" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab3');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Banner</span></a></li> 
					<li id="tab4"> <a href="#blocks" class="home-page-li-border" onclick="tabActive('tab4');" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Blocks</span></a></li>

					<li id="tab5" > <a href="#testinomial" class="home-page-li-border" onclick="tabActive('tab5');"  data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Testimonials</span></a></li>

					<li id="tab6"> <a href="#sociallink" class="home-page-li-border" onclick="tabActive('tab6');" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Social Icons</span></a></li>
					
					</ul>
				</div>


				
			</div>

			
	<div class="panel-body tab-box">
		<div class="tab-content">
			<div class="tab-pane tab1 active" id="logo_style">
					<div><h4></h4></div>

					<!-- @@@@@@@start tagline @@@@@ -->
                    
<div class="form-group form-border" style="padding-top:0px !important;margin-top: -5px">
						<label class="col-sm-12 control-label field-title" style="padding-top:0;margin-top: 0px">Your academy name 
						
						</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
						<div class="themegroup1">
    
	<input type="text" class="form-control form-height tour_1" name="insti_title" id="insti_title" value="<?php echo ($this->input->post('insti_title')) ? $this->input->post('insti_title') : $settings[0]['institute_name']; ?>" style="width: 100%;">
	
</div>

					
						</div>
						
						

                    <div style="clear:both;"></div>
                    
					</div>


                    <!-- @@@@@@@@@@@22 new code end here @@@@@@@@@@@@ -->

                    <div class="up_logo_sec">
	                    <div class="form-group form-border">
							<label for="field-1" class="col-sm-12 field-title control-label">Your logo
								<p>The name of the logo file should not contain any spaces or special characters.</p>
							</label>
							
							<div class="col-sm-12">
	                                  <!-- <input type="file" name="file_i" id="file_i" class="form-control"> -->

	                             <input type="hidden" class="form-control form-height" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" name="imagename" id="imagename">
								<div id="localimage_i">

								<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" width="150" id="imgname"> -->
									<div class="col-sm-12 img-grey-border up_logo">
										<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" width="150" id="imgnamelogo">
										 <span class="error"><?php echo form_error('file_i'); ?></span><span class="help-inline">Logo (330px X 80px)</span>
				                    </div>

				                    <div class="up_logo_btn">
				                   		<a href="<?php echo base_url(); ?>admin/templates/croplogo/logo" class="addlogo_pop btn btn-success img-align ">Add Logo</a>
				                    </div>
	                    
	                    		</div>
							</div>
						</div>
                    </div>
                    <div style="clear:both;"></div>                    
                    <!-- @@@@@@@@@@@ new code is start here @@@@@@@@@@@ -->
                    <div class="up_favicon_sec">
                    	<div class="form-group form-border">
							<label for="field-1" class="col-sm-12 field-title control-label">Favicon
								<p><a href="https://en.wikipedia.org/wiki/Favicon" target="_blank">What is Favicon?</a></p>
							</label>
							
							<div class="col-sm-12">

	                            <input type="hidden" class="form-control form-height" value="<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" name="favname" id="favname">

								<div id="localimage_i">
									<div class="col-sm-12 img-grey-border up_favicon">
												<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" width="25" id="imgnameficon">
										<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('favname')) ? $this->input->post('favname') : $settings[0]['favicon']; ?>" width="25" id="imgname"> -->
												<span class="error"><?php echo form_error('file_f'); ?></span><span class="help-inline"></span> 
									</div>
									<div class="up_favicon_btn">	
										<a href="<?php echo base_url(); ?>admin/templates/croplogo/icon" class="addfev_pop btn btn-success favicon-btn-img ">Add Favicon</a>
				                    </div>
			                    </div>
							</div>
						</div>
					</div>

                    <!-- @@@@@@@start tagline @@@@@ -->
                    
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Your tagline
							<p>Your tagline will be visible in the header of your academy.</p>
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
                   
					<?php echo lang('layout_fld_template');?>
					<legend style="padding-top: 10px">Settings</legend>
					   <!-- new start here -->
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Font</label>
						
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
						<label class="col-sm-12 field-title control-label">Size</label>
						
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
						<label class="col-sm-12 field-title control-label">Color</label>
						
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
                    
                    <div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Theme Color:</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
						<div class="themegroup1">
							<select name="layouttheme" id="layouttheme" class="form-control form-height" disabled>
								<?php foreach ($themes as $key => $value) {
								?>
								<option value="<?php echo $value;?>" <?php echo ( $settings[0]['layouttheme'] == $value )? 'selected="selected"' : ''?>><?php echo substr($value, 0, -4);?></option>
								<?php	
								}?>
							</select>
						</div>

						</div>
					</div>
                    
                 
			</div>

			
           <div class="tab-pane tab2" id="homepagesettings">
           
			<!--Main fieldset-->
		<?php 
			// echo '<pre>';
			// print_r($templatefields);
			
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
					      // echo $field['name'].'<br>';
					?>
					<tr <?php if ($field['type'] == 'hidden') { ?>style="display:none;"<?php }?>>
					
					<td width="30%">
						<p>
							<label class='col-sm-12 field-title labelform' for="<?php echo $field['name']; ?>">
								<?php //echo $field['label']; 
								switch ($field['name']) {
								case 'aboutusinfotext_showhide':
										echo 'About info block';
									break;
								case 'heading_searchbar':
										echo 'Menu';
									break;
								case 'searchbox_showhide':
										echo 'Search box';
									break;								
								case 'course_heading':
										echo 'Title of the course block';
									break;
								
								case 'course_showhide':
										// echo<legend>Course</legend>";
										echo 'Courses block';
									break;
								case 'news_letter':
										echo 'Newsletter block';
									break;
								case 'news_letter_content':
										echo ' Sub-title of the Newsletter Block';
									break;
								case 'news_letter_heading':
										echo 'Title of the Newsletter Block';
									break;
								case 'copyright':
										echo 'Copyright';
									break;
								
								default:
									echo $field['label'];
									break;
							}
								?>
							<?php if ($field['rule']=='required') {
							?>
							<span class="required">*</span>
							<?php
							}?></label>
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
											'class'=> "form-control form-height"
											);
							  echo form_input($inputattrib); ?>
							  <?php if (isset($field['tooltip'])) { ?>
							
							
						
							<?php } ?>

							</div>
							

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
							 
							 <?php
							 }
							 ?>
								<?php if (isset($field['tooltip'])) { ?>
							
								
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

						// echo $field['option'][0]['text'];

							?>
							<div class="col-sm-12">

								
							 <!-- 	<div class="onoffswitch">
								    <input type="checkbox" 
								    name="<?php echo trim($fieldset).'['.$field['name'].']';?>"
								     class="onoffswitch-checkbox" id="<?php echo $field['name'];?>"
								     value="<?php echo $option['value'];?>" 
								     <?php echo ((isset($fldpostdata[$field['name']]) && $option['value'] == $fldpostdata[$field['name']]) || (!isset($fldpostdata[$field['name']]) && isset($fldtemplateOptions[$field['name']]) && $option['value'] == $fldtemplateOptions[$field['name']])) ? "checked" : ''?> >
								    <label class="onoffswitch-label" for="<?php echo $field['name'];?>">
								    	<?php //foreach($field['option'] as $option){ ?>
								        <span class="onoffswitch-inner <?php echo $field['option'][0]['text'];?>">
								        	<?php //foreach($field['option'] as $option){ ?>
								        	 <span class="onoffswitch-active"><span class="onoffswitch3-switch"><?php echo $option['text'];?></span>
								        	 <span class="onoffswitch-inactive"><span class="onoffswitch3-switch"><?php echo $option['text'];?></span>
            							<?php //} ?>
								        </span>
								        <span class="onoffswitch-switch"></span>
								    </label>
								</div>
  -->
 							 <select name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class='form-control form-height'>

								<?php foreach($field['option'] as $option){ ?>

									 <option value="<?php echo $option['value'];?>" 
									 	<?php echo ((isset($fldpostdata[$field['name']]) && $option['value'] == $fldpostdata[$field['name']]) || (!isset($fldpostdata[$field['name']]) && isset($fldtemplateOptions[$field['name']]) && $option['value'] == $fldtemplateOptions[$field['name']])) ? 'selected="selected"' : '';?>>

									 	<?php echo $option['text'];?>
									 		
									 	</option>

								<?php }?>

							</select>

							<?php if (isset($field['tooltip'])) { ?>
						
								
						
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
				<label>Footer widget and Testimonial <br/>Backgroung :</label>
						
							<select name="fwt_backgrd_wo" id="fwt_backgrd_wo" class="form_control">
								
								<option <?php  if($templateOptions['fwt_backgrd_wo'] == 'true') { echo 'selected' ;} ?> value="true">With Background</option>
								<option <?php  if($templateOptions['fwt_backgrd_wo'] == 'false') { echo 'selected' ;} ?> value="false">Without Background</option>
							</select>
						
		</div>
		<!-- ////// -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
 $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>

<!-- /////// -->
		<!-- @@@@@@@@@@@ new code is start here @@@@@@@@@@@ -->
<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Number of
courses to display in courses block</label>
						
						<div class="col-sm-12">
							
                            <!--theme group for template 1-->
<div class="themegroup1">
	<input type="text" class="form-control form-height" name="total_course" id="total_course" value="<?php echo ($this->input->post('total_course')) ? $this->input->post('total_course') : $settings[0]['course_total']; ?>">

	<a onclick="this.href='<?php echo base_url()?>admin/templates/courselist/'+document.getElementById('total_course').value" class=" selcourse_pop btn btn-primary cboxElement">
			<i class="entypo-plus"></i>Select Courses</a>
</div>

						
						</div>
						
                    

                    <div style="clear:both;"></div>
                    
					</div>

					<div class="form-group form-border">
					<div class="main-table" style="padding-top:0px!important;padding-bottom: 0px!important;">
						<table class="table table-bordered responsive" id="coursestoaddlist">
							<thead>
								<tr role="row">      	
						            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="ID">ID</th>
						            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">Course Name</th>
						            <th class="sorting" role="columnheader" tabindex="2" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Remove">Remove</th>
						           
						            
								</tr>
							</thead>

							<tbody id="sortable"> 
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

										<tr style="cursor: all-scroll;" class="ui-state-default" id="qli<?php echo $qzid; //$queid;?>">			
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

					<div class="form-group" >
						<legend style="padding-top: 10px">Testimonial</legend>

						<div class="col-sm-12 " id="testimonial">
                  	<div class="onoffswitch">
					    <input type="checkbox" name="testimonial_enable" class="onoffswitch-checkbox" id="testimonial_enable" value="<?php echo (@$templateOptions['testimonial_enable']) ?>" <?php echo (@$templateOptions['testimonial_enable'] == 'true') ? "checked" : ''?> >
					    <label class="onoffswitch-label" for="testimonial_enable">
					        <span class="onoffswitch-inner"></span>
					        <span class="onoffswitch-switch"></span>
					    </label>
					</div>



					<!-- <select style="" name="testimonial_enable" id="testimonial_enable" class="form-control form-height">
													
													<option <?php  if(@$templateOptions['testimonial_enable'] == 'true') { echo 'selected' ;} ?> value="true">Show</option>
													<option <?php  if(@$templateOptions['testimonial_enable'] == 'false') { echo 'selected' ;} ?> value="false">Hide</option>
												</select> -->
												</div>
												</div>
									<div style="" class="form-group form-border" >
						<label  class="col-sm-12 field-title labelform">Title :</label>
						<div class="col-sm-12">
						<input   name="testimonial_name" id="testimonial_name" class="form-control form-height" value="<?php echo @$templateOptions['testimonial_name'] ? @$templateOptions['testimonial_name'] :'' ?>" style=""></div>
												</div>

							<!--@@@@@@@@@@@@@@@new start here -->
							<legend style="padding-top: 10px">Block’s Title setting</legend>
								<div  style="" class="form-group form-border">
						<label class="col-sm-12 field-title labelform">Title font:</label>
						<div class="col-sm-12">
						<select style="" name="widget_heading_font" id="widget_heading_font" class="form-control form-height">
													
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
							<div class="form-group form-border" style="">
						<label  class="col-sm-12 field-title labelform">Size</label>
						<div class="col-sm-12">
						<input name="widget_heading_size" id="widget_heading_size" class="form-control form-height" value="<?php echo @$templateOptions['widget_heading_size'] ? @$templateOptions['widget_heading_size'] :'' ?>" style="" />
						</div></div>

							<div style="" class="form-group form-border" >
								<label  class="col-sm-12 field-title labelform">Color</label>
								<div class="col-sm-12">
								<input name="widget_heading_color" id="widget_heading_color" class="form-control form-height color {required:false,hash:true}" value="<?php echo @$templateOptions['widget_heading_color'] ? @$templateOptions['widget_heading_color'] :'' ?>" style="" />												
							</div>
							</div>

							
						
						<!--<p style="text-align: center;"> (Put Total number of course show in home page of your website.)</p>-->
							<legend style="padding-top: 10px">SEO settings</legend>

						<div style="" class="form-group form-border" >

								<label for="field-1" class="col-sm-12 control-label field-title">SEO title
				              	<p>Enter the course title as it will be shown in internet browsers.</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo @$templateOptions['meta_title'] ? @$templateOptions['meta_title'] :'' ?>"  name="meta_title" class="form-control form-height" id="m_title" placeholder="Maximum 60 characters.">											
							</div>
							</div>

							<div style="" class="form-group form-border" >
								<label for="field-1" class="col-sm-12 control-label field-title">SEO description
				              <p>Enter the course description that will appear underneath the SEO title.</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo @$templateOptions['meta_desc'] ? @$templateOptions['meta_desc'] :'' ?>"  name="meta_desc" class="form-control form-height" id="m_desc" placeholder="Maximum 320 characters.">											
							</div>
							</div>

							<div style="" class="form-group form-border" >
								<label for="field-1" class="col-sm-12 control-label field-title">Course keywords (optional)
				              <p>To improve your site’s visibility in searches, enter keywords separated by commas.</p>
				              </label>
				              <div class="col-sm-12">
				              <input type="text" value="<?php echo @$templateOptions['meta_keyword'] ? @$templateOptions['meta_keyword'] :'' ?>" name="meta_keyword" class="form-control form-height" id="m_kwd" style="margin-bottom:0;">											
							</div>
							</div>
						<br />
                    <br />

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
		<div class="tab-pane tab4" id="blocks">
				<?php  $CI->load->model('admin/widgets_model');
				$allpages=$CI->widgets_model->getPages();
				$data = array('allpages'=>$allpages,
					'countpagess'=> $CI->widgets_model->getcountPages(),
			);
    
   				$CI->load->view('admin/widgets/list',$data); ?>
			</div>
			<div class="tab-pane tab5" id="testinomial">
				<?php 
				$CI->load->model('admin/testimonials_model');

				$path=base_url() . "admin/testimonials/index/";
		       $baseurl = base_url() . "admin/testimonials/index/";
		       $CI->load->library('pagination');
		       $config['total_rows'] = $CI->testimonials_model->getcount();
		       $config["base_url"] = $baseurl;
		       $config['per_page'] = 10;
		       $config['enable_query_strings'] = true;
		       $config['uri_segment'] = 4;
		       $start = 0;
		       $CI->pagination->initialize($config);
       	            $data = array('testimonials'=> $CI->testimonials_model->getItems($parent_id,$config['per_page'],$start),
       	            	'counttesti' => $CI->testimonials_model->getcount(),
       	        );

	            $CI->load->view('admin/testimonials/list',$data);
             ?>
			</div>
			<div class="tab-pane tab6" id="sociallink">
				<?php 

			       $allsociallinks=$CI->settings_model->getSocialLinks();
			       $socialstatus = $CI->settings_model->getSocialStatus(1,'mlms_socialstatus');
				$data = array('action'=> "createlink",
					'allsociallinks'=> $allsociallinks,
					'socialstatus' => $socialstatus,
			);

			$CI->load->view('admin/sociallinks/create', $data);
  ?>
			</div>

		<div class="tab-pane tab3" id="bannerslider">
            <h6>You can either choose a static banner or a dynamic slider of multiple images appearing below the header in your home page. If you choose the banner option then the signup box will appear by default on the right hand side of the image. In case you do not want to show the signup box then choose the slider option and put 1 to 5 images.</h6>
            <div class="form-group form-border" style="padding-top:2%!important;margin:0;">
              <div class="col-sm-12">
			    <div class="grey-background" style="display: -webkit-box;">
					<label class="col-sm-2 no-padding control-label dark_label">Choose Option :</label>
				  <div class="col-sm-10 no-padding" style="">
					<input style="margin-right:2%;" type="radio" onclick="ban_slider('banner')" name="banner_slider" id="banner" value="banner" checked="true" />Banner
					<input style="margin-left: 20px;margin-right:2%;" type="radio" name="banner_slider" onclick="ban_slider('slider')" id="slider" value="Slider" />Slider 	
				  </div>
				</div>
			  </div>
			</div>
			

			
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
						<a href="<?php echo base_url(); ?>admin/templates/cropimage/banner" class="banimg_pop btn btn-success img-align ">Add Banner Image</a>
						<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['bannerimage']; ?>" width="150" id="imgname"> -->
						<!-- <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['bannerimage']; ?>" width="150" id="imgname"> -->
					  </div>
					  <br>
						<span class="error"><?php echo form_error('file_b'); ?></span><span class="help-inline">Banner (1140px X 360px)</span>

                    </td>
                    
				</tr>
				<!-- @@@@@@@@@@@ new code start here @@@@@@@@@@@@@-->
				<tr></tr>
				<tr>
					<td class="col-sm-4 field-title">Banner Title :</td>
					<td class="col-sm-8">
					 <input type="text" class="form-control form-height" value="<?php echo ($this->input->post('bannername')) ? $this->input->post('bannername') : $settings[0]['banneTitle']; ?>" name="banneTitle" id="banneTitle" style="width: 100%;  margin-top: 4%;">
				</td>
				</tr>
				<br/><br/>
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
					<tr style="position: relative;">
					<?php if ($field['type'] == 'hidden') { ?>style="display:none;"<?php }?>
					
					<td width="30%">
						<p>
							<label class='col-sm-12 field-title labelform' for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?>
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
							      	<div class="col-sm-12 slider-heading-top-margin" style="position: unset;">
							      	<label  class="field-title slider-heading-left-margin labelform" style="position: absolute;left: 15px;top: unset;" id="sliderTitle_colorlabel<?php echo $i ?>" >Slider Heading<br> color</label>
							
						<input   name="sliderTitle_color<?php echo $i ?>" id="sliderTitle_color<?php echo $i ?>" class="form-control color form-height" value="<?php echo @$templateOptions['sliderTitle_color2'] ? @$templateOptions['sliderTitle_color2'] :'' ?>" style="width: 100%; margin-top: -15px; padding-top: 7px; color: rgb(0, 0, 0); background-image: none; background-color: rgb(51, 235, 255);">
							      	</div></br></br>
							      	<?php
							      }
							      	?>
							<div class="col-sm-12">
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
							<div class="col-sm-12" style="float: left;padding-left:0px;">
							<div style="float:left;">
							 <?php
							 $fvalue = isset($fldpostdata[$field['name']]) ? $fldpostdata[$field['name']] : isset($fldtemplateOptions[$field['name']]) ? $fldtemplateOptions[$field['name']] : '';
							 ?>
							 <input type="hidden" name="<?php echo  $field['name'];?>"  id="<?php echo $field['name']; ?>"></div>
							 <?php 
							 if (isset($fldpostdata[$field['name']]) || isset($fldtemplateOptions[$field['name']])) {
							 ?>
							 <div class="col-sm-12">
							 <div class="col-sm-6 img-grey-border" style="margin-right:3%;">
							 <img id="<?php echo $field['name'].'1'; ?>" src="<?php echo base_url().$fvalue;?>" style=" width:auto; max-height: 139px; " />
							 </div>
							 </div>
							 <div class="col-sm-5">
							 <?php 
							 if($field['name'] == 'bg_image4')
							  {
							  	?>
							  	
							 <a href="<?php echo base_url(); ?>admin/templates/cropSliderBg/<?php echo $field['name']; ?>" class="fancybox fancybox.iframe btn btn-success img-align  " style="margin-top: 20px;position: unset;margin-bottom: 30px;">Add Slider Backgound Image</a>
							 <?php 
							 	}
							 	else
							 	{
							 ?>
							 <a href="<?php echo base_url(); ?>admin/templates/cropSlider/<?php echo $field['name']; ?>" class="fancybox fancybox.iframe btn btn-success img-align  " style="margin-top: 20px;position: unset;margin-bottom: 10px;">Add Slider Image</a>
							 
							 <?php }?>
							 </div>
							 <input type="hidden" name="<?php echo $field['name']; ?>" id="<?php echo $field['name'].'11'; ?>" value="<?php echo $fvalue; ?>" />
						
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
							<div class="col-sm-12">
							<textarea name="<?php echo trim($fieldset).'['.$field['name'].']';?>" id="<?php echo $field['name'];?>" class="stinput form-control" rows="6">
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
							<div class="col-sm-12" style="margin-top: 24px;">
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
  <input type="hidden"  name="switchtab" id="switchtab" value="">
	<?php echo form_hidden('id',$id) ?>

<?php endif ?>



<?php echo form_close(); ?>
</div> 
</div>
</div>

<?php 
//  function tabActive($tabname=NULL)
// {
// 	$tabname =$tabname ? $tabname :'tab1';
// 	$this->session->set_userdata('Active_tab',$tabname);
// }
 ?>
 <script>
	jQuery(document).ready(function(){
		 // var tab = "<?php echo $this->session->userdata('Active_tab'); ?>";
		 // if(tab=='') tab = "tab1";
		 //  tabActive(tab);
		 // var tab_con = $('#'+tab).find('a').attr('href');
		 // $(tab_con).show();

		var tab = "<?php echo $this->session->userdata('Active_tab'); ?>";
		if(tab=='')
		{
			// $('.tab1, li#tab1').click()
			// $(document).find('.tab-pane').removeClass('active');
			$(document).find(".tab1, li#tab1").addClass('active');
		}
		else{
			tabActive(tab);			
		}
	})

</script>
<!--easywizard-->

<script type="text/javascript" src="<?php echo base_url();?>public/js/jscolor/jscolor.js"></script>

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
			// function tabActive(tabname)
			// {	
			// 	var tab_con = $('#'+tabname).find('a').attr('href');
			// 					$(tab_con).show();
			// 		jQuery.ajax({
			// 				type: "POST",
			// 				url: "<?php echo base_url(); ?>admin/templates/tabActive",
			// 				data: {tabname:tabname}, 
			// 				success: function(data)
			// 				{
								
			// 					$('.nav-tabs a[href="#' + tabname + '"]').tab('show');
			// 					alert(data);
			// 				$("#followDiv").html(data);
			// 				}
		 //  				});
			// }
			</script>

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




     <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.mousewheel-3.0.6.pack.js"></script>

	<script type="text/javascript" src="<?php echo base_url() ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

    <script src="<?php echo base_url()?>public/js/jquery.tablednd.js"></script>
	

 
    <link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

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
    			title: 'Widget',
    			
    			content: 'Are You sure want to switch the tab.Before switching the tab please save all changes.',
    			confirm: function(){ 

    				         document.getElementById('templateoptions').submit();
    						window.location.href = "<?php echo base_url();?>admin/widgets/index";
        						
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
    			title: 'Testimonial',
    			
    			content: 'Are You sure want to switch the tab.Before switching the tab please save all changes.',
    			confirm: function(){ 

    				      document.getElementById('templateoptions').submit();
    					window.location.href = "<?php echo base_url();?>admin/testimonials";
        						
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
    			title: 'Social Link',
    			
    			content: 'Are You sure want to switch the tab.Before switching the tab please save all changes.',
    			confirm: function(){ 

    				      document.getElementById('templateoptions').submit();
    					  window.location.href = "<?php echo base_url();?>admin/sociallinks/createLink";
        						
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

	jQuery(document).ready(function(){
		jQuery(".onoffswitch").on('click', function() {
			var id = $(this).find('input').attr('id');
		var jQuerybox = jQuery('#'+id);
		if (jQuerybox.is(":checked")) 
		{
			jQuerybox.attr('value','false');
			jQuerybox.prop("checked", false);
		} 
			else 
			{
				jQuerybox.attr('value','true');
				jQuerybox.prop("checked", true);
			}
		});
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
		
// 	$j(document).ready( function( event ) {
//   event.stopPropagation();
//   // Do something
// });


</script>