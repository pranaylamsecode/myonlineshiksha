<?php

$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
?>

<style type="text/css">
	#message {
    position: fixed; 
/*    color: green;
*/    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 99999;
}
.progress-title {
    cursor: pointer;
}
textarea.form-control {
  height: auto;
  border: 1px solid #ccc !important;
}
.progress-container .col-sm-3{
	width: 20%;
	padding-right: 1px;
}
.white-circle {
    cursor: pointer;
}
.crosslink{
			margin-left: 7px;
		    font-size: 14px;
		    /*color: #686c70;
*/		    margin-bottom: 3px;
		    font-weight: 600;
		    font-family: arial;
		}
.activecircle{
	background: rgb(172, 197, 144) !important;
}
.title-font{
	font-size: 19px;
    margin-top: -8px;
}

button.btn.no-btn.btn-danger {
 width: 46%;
 float: right;
 margin-top: 20px;
}
 button.btn.yes-btn.btn-success {
 width: 52%;
 float: left;
 margin-top: 20px;
}
.validateerror {
float: left;
text-align: center;
width: 40%;
/*margin-left: 235px;*/
margin-left: 281px;
margin-bottom: -40px;
color: red;
}
.help-block {
display: block;
width: 100% !important;
margin: 0 -119px auto !important;
}
.grey-background{
  display: -webkit-box;	
}
.validateerrorbox
{
border-color: red !important;
}
input#webcam_option {
  position: relative;
  top: 3px;
}
input#show_result {
  position: relative;
  top: 3px;
}
input#published {
  position: relative;
  top: 2px;
}
.course_content_link{
	margin-bottom: 20px;
}
.pmaintitle {
    display: inline-block;
    text-align: right;
    width: 100%;
    margin: 0px 0px 10px 0px;
}

.field_container .blue-border>li.active>a, .field_container .blue-border>li.active>a:hover, .field_container .blue-border>li.active>a:focus {
    background: #2c7be5 !important;
    border-top-left-radius: 0px !important;
}
.field_container .blue-border>li:first-child.active>a, .field_container .blue-border>li:first-child.active>a:hover, .field_container .blue-border>li:first-child.active>a:focus {
    border-top-left-radius: 10px !important;
}
.main-content .form-control[multiple="multiple"] {
    height: 100px !important;
}
.qq-upload-button {
    display: inline-block;
    width: 100%;
    margin: 0px 0px 0px 0px;
}
.select-main-box.form-border {
    margin: 0px 0px 20px 0px;
}

legend {
    padding: 0px;
    border: 0px;
    margin: 0px;
}
fieldset.adminform.form-horizontal.form-groups-bordered .btn {
    margin-bottom: 30px;
    margin-top: 0px;
}
.make_lectures_radio {
    margin-top: 0px;
    margin-bottom: 30px;
}
.pricing fieldset.adminform.form-horizontal.form-groups-bordered {
    margin-bottom: 15px;
}
.tab-btn {
    margin-top: 0px;
    margin-bottom: 30px;
}
 input[type="radio"] {
    margin-right: 7px !IMPORTANT;
    position: relative;
    top: 1px;
}
.tile_fld {
    background: transparent !IMPORTANT;
    padding: 0px !IMPORTANT;
    font-size: 20px !important;
    color: #12263f;
    font-weight: 500;
    margin-bottom: 20px !IMPORTANT;
}
.bottom-btn {
    padding-top: 0px !important;
}
.make_lectures_radio {
    margin-top: 0px;
    margin-bottom: 30px;
}
#sel_stu {
    margin-bottom: 0px;
}

.pricing .Sel_div .grey-background {
    margin: 0px 0px 15px 0px;
}
</style>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/courses_css/courses_form.css"> 
  
<!--   
<div id="content-top"> 
 
  <link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">
  

<h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>
 


  <span class="clearFix">&nbsp;</span> </div>  -->
  <div class="main-container">
 <?php
$attributes = array('class' => 'tform', 'id' => 'proform','onsubmit'=>'return formvalid()');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/programs/create', $attributes) : form_open_multipart(base_url().'admin/programs/edit_course/'.$id, $attributes);

$validation_errors = validation_errors();

$validationerrors = explode('.',$validation_errors);
?>
<div id="toolbar-box">
  <div class="m top_main_content">
    <?php 
	if($updType == 'create')
	{
        $pagetitle = 'Create New Course';
        echo"";
	}
	else
	{
		$pagetitle = 'Course Settings';
    }
	?>

	  <div class="col-sm-4 no-padding">
      <div class="pagetitle icon-48-generic"><h2><?php echo$pagetitle; ?></h2>
	      </div>
	  </div>
	  <div id="sticky" class="main-content-btn col-sm-8 no-padding" style="float:right;">
	   <?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' name='submit' style='display:none;' class='btn button'" : "id='submit' name='submit' class='btn button' ")); ?>

	    <?php if ($updType == 'create'): ?>
	    	<input type="submit" name="redirect" value="redirect" id="redirect" style="display:none;" class="btn btn-success btn-green">
	    	<button type="button" class='btn button' onclick="return formvalid()"> Update</button>
	    <?php if ($parent_id != "0"): ?>
	    	<!-- <button type="button" class='btn btn-success btn-blue' onclick="return formvalid()" id="savebtn"> Save & Back to list</button>
	    	<input type="submit" value="Save & Back to list" name="save2" class='btn btn-success btn-blue' id="save2" onclick="return formvalid()" style="display: none;"> -->
	    <a href='<?php echo base_url(); ?>admin/course-manager/' class='btn button'>Close </a>
	    <?php else: ?>
	    <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='btn button'></span>Close</a>
	    <?php endif ?>
	    <?php else: ?>
	    <?php if ($parent_id != "0"): ?>
	    	<!-- <input type="submit" value="Save & Back to list" name="edit2" class='btn btn-success btn-blue'> -->
	    <a href='<?php echo base_url(); ?>admin/course-manager' class='btn button'>Close</a>
	    <?php else: ?>
	    <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='btn button'>Close</a>
	    <?php endif ?>
	    <?php endif ?>
	  <div class="clr"></div>
	  <span id="message"></span>
	  </div>
  </div>
  <div id="sticky-anchor"></div>
</div>

<div class="field_container">
<div class="row">
<div class="col-md-6 field_content" style="width: 100%;">
	<div class="pmaintitle main_subtitle">
    	
    	<?php if ($updType == 'edit'){ ?>
    	<div class="course_content_link">
        <a class="link_page" style="float: right;" href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>">
          <span class="lnr lnr-pencil" style="font-size: 15px;"></span>
          <span class="crosslink">Course Content</span>
        </a>
        <a class="link_page" style="float: right;padding-right: 20px;" href="<?php echo base_url() ?><?php echo $program ->catid.'/category/'.$program ->id; ?>">
        <!-- <a class="link_page" style="float: right;padding-right: 20px;" href="<?php echo base_url(); ?>category/course_detail/<?php echo $program ->catid?>/<?php echo $program ->id?>"> -->
          <span class="lnr lnr-undo" style="font-size: 15px;"></span>
          <span class="crosslink">View Course</span>
        </a>
      </div>
    	<?php } ?>
  	</div>
  	
  <ul class="nav nav-tabs bordered grey-border blue-border">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active" style="border-left:none!important;"> <a href="#course_detail" data-toggle="tab" class="li-border" id="info_course"> <span class="visible-xs" ><i class="entypo-home"></i></span> <span class="hidden-xs">Basic</span> </a> </li>
    <!--<li> <a href="#description_tab" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Description</span> </a> </li>-->
    <!-- <li> <a href="#image" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Upload Image</span> </a> </li>
    <li> <a href="#exercise" data-toggle="tab"> <span class="visible-xs"><i class="entypo-mail"></i></span> <span class="hidden-xs">Exercise files</span> </a> </li> -->
    <li> <a href="#ps" data-toggle="tab" class="li-border" id="pr_sub"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Pricing</span> </a> </li>
   <!--  <li> <a href="#exe_f" data-toggle="tab" class="li-border" id="exe_file"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Downloads</span> </a> </li> -->
   <?php /*if($program->is_live_class == 1){ ?>
    <li id=""> <a href="#webinar" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Batches & Events</span> </a> </li>
  <?php }*/ ?>
    <li> <a href="#seo" data-toggle="tab" class="li-border" id="pub_course"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">SEO</span> </a> </li>
    <!-- <li> <a href="#mtags" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Meta Tags</span> </a> </li> -->
    <li> <a href="#requirements" data-toggle="tab" class="li-border" id="adv_set"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Advanced</span> </a> </li>
     <li> <a href="#publishing" data-toggle="tab" class="li-border" id="pub_course"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Publish</span> </a> </li>
	<?php  
		$this->load->config('features_config');
		$webinar = $this->config->item('webinar');				
		
			if($webinar['status']==TRUE)
			{
	?>
    <!-- <li> <a href="#webinar" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Webinar Service</span> </a> </li> -->
	<?php
			}
	?>
  </ul>
  <div class="tab-content tab-box">
    <div class="tab-pane active" id="course_detail">
      <fieldset class="adminform form-horizontal form-groups-bordered">
        <?php if($updType == 'create'){

					$legend = ' ';

					}else{

					$legend = ' ';

					}?>
        <div class="form-group form-border">
          <label class='col-sm-12 control-label field-title' for="name" style="margin-top: 0px;padding-top: 0px;">  Course Name <span class="required">*</span>
            <p>(e.g. Innovation Management - Please give a short and clear name)</p>
          </label>
          <div class="col-sm-12">
            <input id="name" type="text" class="form-control form-height" name="name" maxlength="256" value="<?php echo set_value('name', (isset($program->name)) ? $program->name : ''); ?>"  title="Enter Course Title" data-validation="required" data-validation-error-msg="Enter valid Question"/>
          </div>
        </div>
        
        <div class="form-group form-border">
          <label class='col-sm-12 control-label field-title' style="margin-top: 10px;padding-top: 0px;"> Slug 
            <span class="required"></span>
          </label>
          <div class="col-sm-12">
          <!-- data-validation="required" data-validation-error-msg="Enter valid Question" -->
            <input id="slug" type="text" class="form-control form-height" name="slug" maxlength="256" value="<?php echo set_value('slug', (isset($program->slug)) ? $program->slug : ''); ?>"  title="Enter Slug"  onkeyup="return checkdup(<?php echo $program->id;?>,this.value)" onkeypress="return valid_escape(event)" />
             <!-- <span id="slugval"><?php if(!empty($program->slug)){echo $program->slug;}?> </span> -->
             <span id="avail" style="padding-left: 50px"></span>
          </div>
        </div>
       
            <input class="form-control" id="alias" type="hidden" name="alias" maxlength="256" value="<?php echo set_value('alias', (isset($program->alias)) ? $program->alias : ''); ?>" title="Enter Course alias name which is used as variable for course" />
        
        <div class="form-group form-border">
          <label class="col-sm-12 control-label field-title" for="description">Course Description
          	
                    </label>
          <div class="col-sm-12">
            <textarea name="description" id="description" class="form-control form-height" rows="4"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea>
            <input name="image" type="file" id="upload" class="hidden" onchange="">
            
            </div>
        </div>

        <!-- //// preview-video -->
        <div class="form-group form-border">
         <div class="col-sm-6 no-padding" >						
            <label class="col-sm-12 control-label field-title" for="learn_pnt">What We Learn? 
            </label>			
        			<div class="col-sm-12">
        				<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>

                        <textarea id="todolist"  name="learn_point" class="form-control todolist" rows="6"><?php echo ($this->input->post('learn_points')) ? $this->input->post('learn_points') : ((isset($program->learn_points)) ? $program->learn_points : '* ');?></textarea>

                        <textarea id="todolist2"  name="learn_pnt" class="form-control todolist2" style="display: none;" rows="6"><?php echo ($this->input->post('learn_points')) ? $this->input->post('learn_points') : ((isset($program->learn_points)) ? $program->learn_points : '* ');?></textarea>
        				
        				<!-- tooltip area finish -->
                        <span id="descriptionerror" class="error" style="color: red"><?php echo form_error('description'); ?></span>
        			</div>
		        </div>
        		<!-- <textarea id="dummy" class=""></textarea> -->
                <!-- new code end here -->
                <!-- Image sectiom start here-->
            <div class="col-sm-6 no-padding"> 
						<label for="field-1" class="col-sm-12 control-label field-title">Add course preview link:</label> 

						<div class="col-sm-12">	

                        <?php
                        if(isset($program->preview))
						{
							$imgname = $program->preview;
                        }
						else
						{
							$imgname = '';
                        }
                         ?>
							
							<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
				       
							<input type="text" style="width: 100%" value="<?php echo ($this->input->post('preview')) ? $this->input->post('preview') : $imgname; ?>" name="preview" id="preview" class="form-height form-control">
						   </div>

						</div>
					</div>
</div>
<!-- /////end pview video -->
        <!-- new code end here -->
        <!-- image upload section start here -->
          <div class="form-group form-border">
          <label for="image" class="col-sm-12 control-label field-title">Course image
          
          </label>
          <div class="col-sm-12">
          <?php if($updType == 'create'){

              $legend = ' ';

            }else{

              $legend = ' ';

          }?>
            <legend><?php echo $legend; ?></legend>
            <?php
            if(isset($program->image))
            {
              $imgname = $program->image;
                        }
            else
            {
              $imgname = '';
                        }
                         ?>
                    <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imgname; ?>" name="imagename" id="imagename"></td>
                  
          <div class="qq-upload-button" style="position: relative; direction: ltr;">
                      <div id="localimage_i" class="center-img">
                        <div class="col-sm-6 no-padding">
                        <?php if ($updType == 'edit'){ ?>
                          <div class="img-grey-border edit_course_image">
                            <a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ? $program->image : 'no_images_course.png'?>/<?php echo $this->uri->segment(4);?>/courseedit" class="upimg_pop"><img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ? $program->image : 'no_images_course.png'?>" width="150" name="imagename" id="imagname"/>
                            <img id="blah" src="#" alt="your image" width="150" /></a>
                          </div>
                          <div class="edit_course_image_btn">
                            <a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ? $program->image : 'no_images_course.png'?>/<?php echo $this->uri->segment(4);?>/courseedit" class="upimg_pop btn ">Upload Image</a>
                          </div>
                          <input type="hidden" name="cropimage" id="cropimage" value="<?php echo $program->image ? trim($program->image) : 'no_images_course.png' ?>" >
                        <?php }else{  ?>
                        
                          <div class="img-grey-border edit_course_image">
                            <a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ? $program->image : 'no_images_course.png'?>" class="upimg_pop"><img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images_course.png' ?>" width="150" name="imagename" id="imagname"/>
                            <img id="blah" src="#" alt="your image" width="150" /></a>
                          </div>
                          <div class="edit_course_image_btn">
                            <a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ? $program->image : 'no_images_course.png'?>/<?php echo $this->uri->segment(4);?>" class="upimg_pop btn ">Upload Image</a>
                          </div>
                          <input type="hidden" name="cropimage" id="cropimage" value="no_images_course.png" >
                        <?php } ?>
                      </div>
                    </div>

                      <div class="col-sm-6 no-padding">
                        <div class="">
                          <img src="<?php echo base_url();?>public/uploads/programs/qr_code/<?php echo ($this->input->post('qr_image')) ? $this->input->post('qr_image') : $program->qr_image ? $program->qr_image : 'no_image.gif'?>" width="150px" height="150px" name="qr_image" id="qr_image"/>
                        </div>
                        <div class="edit_course_image_btn">
                        <?php if(!empty($program->qr_image)){ ?>
                          <label for="image" class="col-sm-12 field-title">QR-code</label>
                        <?php } else { ?>
                          <a type="button" id="qrbtn" onclick="return generateQR(<?php echo $program->id.",'".$program->slug."'";?>)" class="btn ">Generate QR-code</a>
                          <label for="image" class="col-sm-12 field-title" style="display: none" id="qrlabel">QR-code</label>
                        <?php } ?>
                        </div>
                      </div>
                    </div>
                    <br />
                    <input type="file" name="file_i" id="file_i" class="upload_btn" style="display: none;" >
                    <input type='button' id='remove_id' value='remove' style="display: none" class="btn btn-danger"/>
                   
          
        <!-- image upload section end here -->
        <div class="col-sm-12 select-main-box form-border">
	        <div class="form-group form-border select-form">
	        	
		          <label class='col-sm-12 control-label field-title' for='category_id'><?php echo lang('web_category')?> <span class="required">*</span>

		          </label>
		          <div class="col-sm-12" style="padding-right:0;">
		            <select class='form-control form-height' name='category_id' id='category_id' title="Select Course Category,category under which course comes"data-validation="required" data-validation-error-msg="Enter valid Question">
		              <option value=''>Select</option>
		              <?php				
									foreach ($categories as $category): ?>
		              
		              <!--<option value='<?php echo $category->catnew?>' <?php echo  preset_select('category_id', $category->catnew, (isset($program->catid)) ? $program->catid : $parent_id  ) ?>><?php echo $category->name?></option>-->
		              <option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($program->catid)) ? $program->catid : ''  ) ?>><?php echo $category->name?></option>
		              <?php endforeach ?>
		            </select>
		             
		            
		            
		          </div>
		          <a href="<?php echo base_url(); ?>admin/pcategories/createcategory" id="cropcategory" class="newsect_pop btn  " style="margin-left: 20px;float: left;">Create New Category</a>
	        </div>
	        
	        <div class="form-group select-form form-border" style="margin-left:15px;">
	          
		          <label class="col-sm-12 control-label field-title">Choose your teacher<span class="required">*</span>
		
		          </label>
		          	<div class="col-sm-12" style="padding-right:0;">
			          	<select name='teacher_id' id='teacher_id' title="Select Trainer for current course" class="form-control form-height" onchange="disableAssistant();" data-validation="required" data-validation-error-msg="Enter valid Question">
			              	<option value=''><?php echo '- select -';?></option>
							
						<!-- 	<option value="<?php echo $u_data['id']?>" <?php echo ($this->input->post('teacher_id') == $u_data['id']) ? "selected=selected" : (isset($u_data['id'])) && @$program->author == $u_data['id'] ? "selected=selected" : 'selected=selected' ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option> -->
						

							<?php foreach ($teachers as $teacher): ?>
							<!--<option value='<?php echo $teacher->userid?>' <?php echo (@$program->author == $teacher->userid) ? 'selected' : ''  ?>><?php echo $teacher->fullname?></option>-->
							<option value="<?php echo $teacher->userid;?>" <?php echo ($this->input->post('teacher_id') == $teacher->userid) ? "selected=selected" : (isset($teacher->userid)) && @$program->author == $teacher->userid ? "selected=selected" : '' ?>><?php echo $teacher->fullname;?></option>
							<?php endforeach ?>
			            </select>
		            
		            <!-- tooltip area --> 
		            
		            	
		            
		            
		         </div>
	           </div>
       	    
       	</div>
        <!-- new field add for assistant teacher -->
        <div class="row">
                    <div class="form-border col-sm-6">
						<label class="control-label field-title">Assistant Teachers
						
						</label>
						
						<div class="">
							
                   <?php							 
						// if($u_data['groupid'] == 4) 
						// {
                  	 if(isset($program->introtext)){

               		 $assistantid = explode('|',$program->introtext);

                		 }
							?>					
	                        <select class="form-control select-box-border" name='assistant_id[]' id='assistant_id' title="Select Trainer for current course" multiple="multiple">
								<option value=''><?php echo '- select -';?></option>
								
								<!-- <option value="<?php echo $u_data['id']?>" <?php echo isset($program->introtext) && in_array($u_data['id'],$assistantid)? "selected" :""; ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option> -->
								<?php foreach ($teachers as $teacher): ?>
								
								<option value="<?php echo $teacher->userid;?>"<?php echo isset($program->introtext) && in_array($teacher->userid,$assistantid) ? "selected":""; ?>><?php echo $teacher->fullname;?></option>
								<?php endforeach ?>
							</select>
							

						


						</div>
					</div>
                    <!-- new field for assistant teacher end here -->

        <div class="form-border col-sm-6">
          <label class="control-label field-title">Level
          	
            <!-- -->
          </label>
          <div class="">
            <select name="level" id="level" title="Select Course Level" class="form-control form-height">
            <?php if($updType == 'edit') { ?>
              <option value="0" <?php echo ($this->input->post('level') == '0') ? "selected=selected" : (isset($program->level) && $program->level == '0') ? "selected=selected" : ''?>>Beginners</option>
              <option value="1" <?php echo ($this->input->post('level') == '1') ? "selected=selected" : (isset($program->level) && $program->level == '1') ? "selected=selected" : ''?>>Intermediate</option>
              <option value="2" <?php echo ($this->input->post('level') == '2') ? "selected=selected" : (isset($program->level) && $program->level == '2') ? "selected=selected" : ''?>>Advanced</option>
              <?php } 
              else { ?>
	               <option value="0">Beginners</option>
	              <option value="1" selected>Intermediate</option>
	              <option value="2">Advanced</option>
              <?php } ?>
            </select>
          </div>
        </div>
       </div>

       <!-- testing for multiple categories uploading -->
       <div class="row">
          <div class="form-border col-sm-6">
            <label class="control-label field-title">Select Categories <b>(if multiple)</b></label>
            <div class="">
              <select class="form-control select-box-border" name='multicat[]' id='multicat' title="Select Trainer for current course" multiple="multiple">
                <option value='' disabled=""><?php echo '- select -';?></option>
                <?php foreach ($categories as $category){ ?>
                <option value="<?php echo $category->id;?>" <?php if(!empty($program->multicat) && in_array($category->id,explode(',',$program->multicat))){ echo "selected=''"; } ?> >
                  <?php echo $category->name; ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-border col-sm-6">
            <label class="control-label field-title">Select Course Type </label>
            <div class="">
              <select name="is_live_class" id="is_live_class" class="form-control form-height">
                <option value="0" <?php if($program->is_live_class == 0){echo 'selected';}?>>Regular Class</option>
                <option value="1" <?php if($program->is_live_class == 1){echo 'selected';}?>>Live Class</option>
              </select>
            </div>
          </div>
        </div>
       <!-- testing for multiple categories uploading -->
        
        

        <?php if($updType == 'create'){

            $legend = ' ';

			}else{

            $legend = ' ';

			}?>
       
        <br/>
        <div class="form-group form-border" style="border-bottom:none!important"> 
						
						<!-- <div class="col-sm-5" id="nexttab1"> 
						<button type="button" class="btn btn-success btn-green tab-btn"> Update</button>
					</div>  -->
        <div style="clear:both;"></div>       
      </fieldset>
    </div>
    <!-- //course_detail -->
     <div class="tab-pane" id="ps">
      <dd class="" sno="5">
        <div class="tab-content pricing">
          <fieldset class="adminform form-horizontal form-groups-bordered" >
           <p class="psubtitle field-subtitle">Set the course pricing options that will be displayed in the course landing page.</p>
            <div class="form-group form-border">

			  
			  
             <!-- comment by me  <label class="col-sm-3 control-label"></label> -->
			   
              <div class="col-sm-12 Sel_div" >
			    <div class="grey-background">
                      <?php if($updType == 'create'){?>
                 <input style="margin-top:1%;" type="radio" id="chb_free_courses1" name="chb_free_courses" value="0">  <label for="chb_free_courses1">Free</label>
               <!--  &nbsp;
  				<input style="margin-top:1%;" type="radio" id="chb_free_courses2" name="chb_free_courses" value="1" checked> One time payment </span>
  				&nbsp;
  				<input style="margin-top:1%;" type="radio" id="chb_free_courses2" name="chb_free_courses" value="1" checked> Subscription </span> -->
  				<?php } 
  				else{  ?>
<!--   				<span class="radio_btn dark_label">
 -->
	  				<input type="radio" id="chb_free_courses1" name="chb_free_courses" value="0" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '0' && $program->step_access_courses == '1' ? "checked" : '';?>> <label for="chb_free_courses1">Free</label>

  				<?php } ?>
  			<!-- </span> -->
                </div>
              </div><br />
                
              <div class="col-sm-12" style="display:<?php echo ($this->input->post('chb_free_courses')) ? "block" : isset($program->chb_free_courses) && $program->chb_free_courses == '0' ? "block" : 'none';?>;" id="Stud_free">
              <div class="lightgray_box">
                <!-- <select class="form-control form-height" id="step_access_courses" name="step_access_courses" onchange="javascript:showhidecourse(this.value);">
                  <option value="0" <?php echo ($this->input->post('step_access_courses') == '0') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "selected" : ''; ?>>Students</option>
                  <option value="1" <?php echo ($this->input->post('step_access_courses') == '1') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "selected" : ''; ?>>All Students</option>
                </select> -->
                <p>You want to make this course FREE to all students or to students for particular course(s).
				</p>
				<div style="padding-bottom: 3%;">
				<!-- <span class="col-sm-6">

				 <input type="radio" id="step_access_courses1" name="step_access_courses" value="1" onclick="javascript:showhidecourse(this.value);" <?php echo ($this->input->post('step_access_courses') == '1') ?  "checked" : (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "checked" : ''; ?>> Free to All Students 
				 </span>
				 <span class="col-sm-6">
                <input type="radio" id="step_access_courses0" name="step_access_courses" value="0" onclick="javascript:showhidecourse(this.value);" <?php echo ($this->input->post('step_access_courses') == '0') ?  "checked" : (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "checked" : ''; ?>> Free to Students of Selected Course(s)  				
               </span> -->
               <?php if($updType == 'create'){ ?>
               <span class="col-sm-6 dark_label" >

				 <input type="radio" id="step_access_courses1" name="step_access_courses" value="1" onclick="javascript:showhidecourse(this.value);" checked >  <label for="step_access_courses1">Free to All Students </label>
				 </span>
				 <span class="col-sm-6 dark_label" >
                <input type="radio" id="step_access_courses0" name="step_access_courses" value="0" onclick="javascript:showhidecourse(this.value);" > <label for="step_access_courses0">Free to Students of Selected Course(s)</label>  				
               </span>
               <?php } else { ?>
               <span class="col-sm-6 dark_label">

				 <input type="radio" id="step_access_courses1" name="step_access_courses" value="1" onclick="javascript:showhidecourse(this.value);" <?php echo (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "checked" : ''; ?>> <label for="step_access_courses1">Free to All Students</label> 
				 </span>
				 <span class="col-sm-6 dark_label">
                <input type="radio" id="step_access_courses0" name="step_access_courses" value="0" onclick="javascript:showhidecourse(this.value);" <?php echo (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "checked" : ''; ?>> <label for="step_access_courses0">Free to Students of Selected Course(s)</label>  				
               </span>
              <?php } ?>
               </div>
              </div>
            </div>
            </div>
            <?php

          if($updType == 'edit'){

          $show_div = (!isset($program->step_access_courses) || isset($program->step_access_courses) && $program->step_access_courses == '1') ? "none" : "block";

          }else{

           $show_div = ($this->input->post('step_access_courses') == '1') ? "none" : "block";

         // $show_div ="block";

          }

         //if(!isset($program->step_access_courses) || isset($program->step_access_courses) && $program->step_access_courses == '1'){

          if(isset($courses)){ ?>
              <div id="free_courses" style="display: <?php echo $updType == 'edit' && $program->step_access_courses == '0' ? 'block' : $updType == 'create' ? 'none' : 'none' ; ?>" class="col-sm-12 ">
              <div class="form-group form-border">
              <div class="lightgray_box" style="padding-left: 0;">
                <label class="col-sm-12"><!-- Of -->
                Select multiple courses (using control / command key)
                <!-- <span class="tooltipcontainer que-icon"> <span type="text" id="selected_course-target" class="tooltipicon" title="Click Here"></span> <span class="selected_course-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                  
                  
                  
                  <?php echo lang('course_fld_course-free-student');?> </span> </span>  -->
                </label>
                <div class="col-sm-12"> 
                  
                  <!--<select name="selected_course[]" id="selected_course[]" multiple="multiple">-->
                  <select name="selected_course[]" id="selected_course" multiple="multiple" class="form-control select-box-border">
                    <!-- <option value="-1" <?php if($this->input->post('step_access_courses') == '-1' || isset($program->chb_free_courses) && $program->selected_course == '-1') echo "selected";?>>Any Course</option> -->
                    <?php

               foreach($courses as $course){

                if(isset($program->selected_course)){

                $coursesid = explode('|',$program->selected_course);

                 }

                if(!isset($program->id) || ($course['id'] != $program->id)){ ?>
                    <option value="<?php echo $course['id']; ?>" <?php if(isset($program->chb_free_courses) && $program->selected_course == $course['id'] || isset($program->selected_course) &&in_array($course['id'],$coursesid)) echo "selected"?>> <?php echo $course['name'];   ?> </option>
                    <?php }

                }

               ?>
                  </select>
                  
                  <!-- tooltip area --> 
                  </div>
                  </div>
              </div>
              <span class="error"><?php echo form_error('selected_course'); ?></span>
              <?php }

        ?>
            </div>
          </fieldset>
          

		  <div class="col-sm-12" style="padding:0; display:block;" id="priceDiv" >
			<div class="col-sm-12" style="padding:0;" id="sel_stu">
			   <div class="grey-background">
			    <div class="col-sm-12 no-padding">
			   <span class="col-sm-3 no-padding" id="reg_rad">
				<input style="margin-top: 1%;" class="radio-btn reg_rad plan" type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan" 
				<?php echo $updType == 'create' ? 'checked' : (@$program->fixedrate > 0.00 || $program->step_access_courses == '0') ? 'checked' : '' ?> value="fixed"/>
				<!-- Fixed Price    -->
				 <label class="dark_label" for="plan"> One-time payment</label></span>
				<span class="col-sm-9 no-padding">
				<p class="" ><!-- This option allow students to make a one time payment for the course. -->   (Charge your students a one time fee to access your course for a lifetime.)</p></span></div>
			  </div>
			</div>
			<fieldset class="adminform" id="one-time" style="<?php if(@$program->fixedrate > 0.00 || isset($countplans)) { echo 'display:block'; } else { echo 'display:none'; } ?>">
           
           <?php 
           if($pay_setting['0']['paypal_status'] == '0' && $pay_setting['0']['directpay_status'] == '0'){ ?>
           	<div class="payment_block">
           		<p>To set a one-time payment, connect Stripe or PayPal</p>
           	<a class="stripe " target="_blank" href="<?php echo base_url('admin/settings/#bannerslider'); ?>">Connect Stripe</a>
           	<a class="paypal" target="_blank" href="<?php echo base_url('admin/settings/#bannerslider'); ?>">Connect PayPal</a>
           </div>
       <?php } ?>

           <div class="row" style="width: 100%">
			<div class="form-border col-sm-6">
                <label for="field-1" style="padding:0;" class=" control-label field-title">Original price :</label>
                <div  style="padding:0;">
                  <input type="text" name="demofixedrate" class="form-control form-height" id="demofixedrate" value="<?php echo (isset($program->demoprice)) ? $program->demoprice : '' ?>" onkeypress="return isNumberKey(event)">
                </div>
            </div>
			<div class="form-border col-sm-6" id="fixed_rate" style="<?php if(@$program->fixedrate > 0.00) { echo 'display:block'; } else{ echo 'display:none'; }  ?>">
                <label for="field-1" style="padding:0;" class="control-label field-title"><!-- For Fixed Rate -->Sale price : </label>
                
                <div style="padding:0;">
                  <input type='text' name='fixedrate' class='form-control form-height' id='fixedrate' value="<?php echo (isset($program->fixedrate)) ? $program->fixedrate : '0.00' ?>" onkeypress="return isNumberKey(event)">
                </div>
                
            </div>
            </div>

             
        </fieldset>
			
			<div class="col-sm-12" style="padding:0;"> 
			 <div class="grey-background"> 
			<div class="col-sm-12 no-padding">
			 <span class="col-sm-3 no-padding">
			  <input style="margin-top: 1%;" class="radio-btn sub_rad plan" type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan2" <?php if(@$countplans) echo 'checked';  ?> value="subscription" /><label  for="plan2" class="dark_label">Subscription </label></span>
			  <span class="col-sm-9 no-padding">
			  <p class="" > (Charge students recurring fees for accessing the course for a particular time.)</p></span></div>
		  	 </div>
		  	</div>
		  	
		  </div>

		<fieldset class="adminform" id="price_subs" style="<?php if(@$program->fixedrate > 0.00 || isset($countplans)) { echo 'display:block'; } else { echo 'display:none'; } ?>">
			
                
            <table class="adminform table table-bordered" >
              <tbody>
                <tr id="subscriptions_headtr" style="display:none;">
                  <td style="font-size:1.2em;font-weight:bold;padding:0.5em;"><div><span class="field-title">Subscriptions plans</span><br/> <span style="float:left;font-weight: 400;font-family: arial;color:#686c70;font-size:11px;">(You can create and edit new Subcription plan as per your need in the <a href ="<?php echo base_url(); ?>admin/orders">Orders and payments.)</a></span></div>
                    
                    <!-- tooltip area --> 
                    
                    <span class="tooltipcontainer renewal-tooltipcontainer"> <span type="text" id="subscriptions-target" class="tooltipicon" title="Click Here"></span> <span class="subscriptions-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                    
                    <!--tip containt--> 
                    
                    <?php echo lang('course_fld_subscriptions-plans');?> </span> </span>
                    <div style="float:left;"> </div></td>
                </tr>
              
         
              <tr id="subscriptions_tr" style="<?php if(@$countplans) { echo 'display:table-row'; } else { echo 'display:none'; } ?>">
                <td><table id="subscriptions" class='table table-bordered' >
                    <tbody>
                      <tr style="background:#999">
                        <th style="padding:0.5em;" width="1%">Default</th>
                        <th style="padding:0.5em;" width="1%"><input onclick='checkPlans("subscriptions");' value="" name="splains" id="splains" type="checkbox" disabled="disabled" ></th>
                        <th style="padding:0.5em;">Name</th>
                        <th style="padding:0.5em;">Terms</th>
                        <th style="padding:0.5em;">Price</th>
                      </tr>
                      <tr>
                        <td colspan="5"><span class="error"><?php echo form_error('subscription_default'); ?></span> <span class="error"><?php echo form_error('subscriptions'); ?></span></td>
                      </tr>
                      <?php 
					       /* echo '<pre>';
							print_r($plans); 
							echo '</pre>'; */
					?>
                      <?php if ($plans):

                         ?>
                      <?php $i=0;?>
                      <?php foreach ($plans as $plan):

                        ?>
                      <tr>
                        <td style="padding:0.5em;"><?php //($this->input->post('subscription_default') ? "checked" : isset($plan->default) && $plan->default == '1') ? "checked" : ''; ?>
                          <input value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('subscription_default') == $plan->plid) ? "checked" : isset($plan->default) && $plan->default == '1' ? "checked" : '';?> name="subscription_default" id="subscription_default" type="radio"></td>
                        <td style="padding:0.5em;"><input name="subscriptions[]" id="subscriptions<?php echo $plan->plid; ?>" class="plain" type="checkbox" value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('subscriptions') && in_array($plan->plid,$this->input->post('subscriptions')) == '1') ? "checked" : (isset($plan->plan_id)) ? "checked" : ''?>></td>
                        <td style="padding:0.5em;"><?php echo $plan->name ?></td>
                        <td style="padding:0.5em;"><?php echo $plan->term.' '.$plan->period ?></td>
                        <td style="padding:0.5em;"><?php

                             $price = $this->input->post('subscription_price');

                             $plan_price = (isset($plan->price)) ? $plan->price : '';

                             $plinid=$plan->plid;

                           ?>
                          <input name="subscription_price[<?php echo $plan->plid ?>]" type="text" value="<?php echo ($price) ? $price[$plan->plid] : $plan_price ?>" onkeypress="return isNumberKey(event)" id="sub_price">
                          <span class="error"><?php echo form_error("subscription_price[$plinid]"); ?></span></td>
                      </tr>
                      <?php endforeach ?>
                      <?php else: ?>
                    <p class='text'>
                      <?=lang('web_no_elements');?>
                    </p>
                    <?php endif ?>
                  </table></td>
              </tr>
              <tr id="renewals_headtr" style="<?php if(@$countplans) { echo 'display:table-row'; } else { echo 'display:none'; } ?>">
                <td style="font-size:1.2em;font-weight:bold;padding:0.5em;"><div class="field-title" style="float:left;"> Renewal plans&nbsp; </div>
                  
                  <!-- tooltip area --> 
                  
                  <span class="tooltipcontainer renewal-tooltipcontainer"> <span type="text" id="renewal-target" class="tooltipicon" title="Click Here"></span> <span class="renewal-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                  
                  <!--tip containt--> 
                  
                  <?php echo lang('course_fld_renewal-plans');?> </span> </span></td>
              </tr>
              <tr id="renewals_tr" style="<?php if(@$countplans) { echo 'display:table-row'; } else { echo 'display:none'; } ?>">
                <td><table id="renewals" >
                    <tbody>
                      <tr style="background:#999">
                        <th style="padding:0.5em;" width="1%">Default</th>
                        <th style="padding:0.5em;" width="1%"><input onclick='checkPlans("renewals");' value="" name="splains" id="splains" type="checkbox" disabled="disabled"></th>
                        <th style="padding:0.5em;">Name</th>
                        <th style="padding:0.5em;">Terms</th>
                        <th style="padding:0.5em;">Price</th>
                      </tr>
                      <?php 
					  /*echo '<pre>';
					  print_r($renewalplans);
					  echo '</pre>';*/
					  ?>
                      <?php if ($renewalplans):

                         ?>
                      <?php $i=0;?>
                      <?php foreach ($renewalplans as $plan):



                        ?>
                      <tr>
                        <td style="padding:0.5em;"><input value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('renewal_default') == $plan->plid) ? "checked" : isset($plan->default) && $plan->default == '1' ? "checked" : '';?> name="renewal_default" type="radio">
                          
                          <!--<input value="<?php //echo $plan->plid ?>"   -->
                          
                          <?php //if(isset($plan->default) && $plan->default == '1') echo "checked"; ?>
                          
                          <!--name="renewal_default" type="radio"> --></td>
                        <td style="padding:0.5em;"><input name="renewals[]" class="plain" type="checkbox" value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('renewals') && in_array($plan->plid,$this->input->post('renewals')) == '1') ? "checked" : (isset($plan->plan_id)) ? "checked" : ''?>>
                          
                          <!--<input name="renewals[]" class="plain" type="checkbox" value="<?php //echo $plan->plid ?>" <?php //if(isset($plan->plan_id)) echo "checked"; ?> >   --></td>
                        <td style="padding:0.5em;"><?php echo $plan->name ?></td>
                        <td style="padding:0.5em;"><?php echo $plan->term.' '.$plan->period ?></td>
                        <td style="padding:0.5em;"><?php

                             $price = $this->input->post('renewalprice');

                             $renewalprice = (isset($plan->price)) ? $plan->price : '';

                            ?>
                          <input name="renewalprice[<?php echo $plan->plid ?>]" type="text" value="<?php echo ($price) ? $price[$plan->plid] : $renewalprice ?>" onkeypress="return isNumberKey(event)"></td>
                      </tr>
                      <?php endforeach ?>
                      <?php else: ?>
                    <p class='text'>
                      <?=lang('web_no_elements');?>
                    </p>
                    <?php endif ?>
                  </table></td>
              </tr>
                </tbody>
              
            </table>

          </fieldset>
          		<div class="form-group form-border"> 
						
					<div class="col-sm-5" id="nexttab4" style="padding-left:0;">
						<button type="button" class="btn btn-success btn-green tab-btn" > Update</button>
	 				 </div>

				</div>
        </div>
      </dd>
      <div style="clear:both;"></div>
    </div>

    <!-- //ps -->

     <!--  <div class="tab-pane" id="exe_f">
      <dd class="" sno="06" id="dd_06">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
          <legend class="field-title tile_fld legend-gap"> Downloads</legend>   
             <label class="control-label field-title">These files can be downloaded by the students from the course.</label>
         
          </p>       
             <a href = "<?php echo base_url(); ?>admin/medias/addmedia/<?php //echo $program->id; ?>" class='btn btn-info exifiles_pop btn-border-blue' id="exifiles">Select from library</a> 
            <a href = "<?php echo base_url(); ?>admin/medias/createexercisefile/<?php //echo $program->id; ?>" class='btn btn-success newexe_pop btn-border-green' id="newexefile">Upload</a> 
            <div style="clear:both"></div>
          
            <table class="table table-bordered datatable dataTable table-gap" id="myTable">
              <thead>
                <tr>
                  <th align="center">Type</th>
                  <th align="center"><strong>File/Media name</strong></th>
                 
                  <th align="center"><strong>Download</strong></th>
                  <th align="center"><strong>Remove</strong></th>
                </tr>
              </thead>
              <tbody id="rowsmedia">
                <?php

                           $img_type = '<img src="'.base_url().'public/images/admin/doc.gif" alt="doc type">';

                           $display_none = '';
                            
                           if($updType == 'create' && isset($get_media_ids) && $get_media_ids!= ''){

                           $nums = 0;

                           foreach($get_media_ids as $get_media_id){

                           $nums++;

                           $getMedia = $this->medias_model->getMediaExeFile($get_media_id);

                           foreach($getMedia as $media){

                           ?>
                <tr id="tr<?php echo $media->id;?>" <?php echo $display_none; ?>>
                  <td align="center"><?php echo $media->id ?>
                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>"></td>
                  <td><?php echo $img_type ?></td>
                  <td><?php echo $media->name ?></td>
                  <td><?php if($media->published){?>
                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">
                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
                  
                    
                    <?php }else{?>
                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">
                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
                    <?php }?></td>
         
          <td><a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a></td>
                </tr>
                <?php
                }

        }

        }else if($updType == 'create' && $get_media_ids == ''){ 
          ?>
          <tr> <td colspan="6" class="dark_label" id="exeid">No downlodable file yet!</td></tr>
        <?php }

                if($updType == 'edit')
        {
          $get_media_ids2 = explode(',',$program->programmedias);
                if(isset($get_media_ids2) && $get_media_ids2!= ''){

                $nums = 0;

                foreach($get_media_ids2 as $get_media_id){

                $nums++;

                $getMedia = $this->medias_model->getMediaExeFile_new($get_media_id);
                
                foreach($getMedia as $media)
        {

        ?>
                <tr id="tr<?php echo $media->id;?>" >
                  <td style="display: none;"><?php echo $nums; //$media->id ?>
                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>"></td>
                  <td>
                      <?php  
                      $filename = $media->media_title;
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //echo $ext;
            if($ext == 'gif'||$ext == 'GIF'){
            echo $ftype = '<img src="'.base_url().'public/css/image/gif-icon.png" alt="File type">';
            } 
            elseif($ext == 'rar'||$ext == 'RAR'){
            echo $ftype = '<img src="'.base_url().'public/css/image/rar-icon.png" alt="File type">';
            }
            elseif($ext == 'zip'||$ext == 'ZIP'){
            echo $ftype = '<img src="'.base_url().'public/css/image/zip-icon.png" alt="File type">';
            }
            elseif($ext == 'rar'||$ext == 'RAR'){
            echo $ftype = '<img src="'.base_url().'public/css/image/rar-icon.png" alt="File type">';
            }
            elseif($ext == 'doc'||$ext == 'DOC'){
            echo $ftype = '<img src="'.base_url().'public/css/image/doc-icon.png" alt="File type">';
            }
            elseif($ext == 'docx'||$ext == 'DOCX'){
            echo $ftype = '<img src="'.base_url().'public/css/image/docx-icon.png" alt="File type">';
            }
            elseif($ext == 'docx'||$ext == 'DOCX'){
            echo $ftype = '<img src="'.base_url().'public/css/image/docx-icon.png" alt="File type">';
            }
            elseif($ext == 'jpg'||$ext == 'JPG'){
            echo $ftype = '<img src="'.base_url().'public/css/image/jpg-icon.png" alt="File type">';
            }
            elseif($ext == 'png'||$ext == 'PNG'){
            echo $ftype = '<img src="'.base_url().'public/css/image/png-icon.png" alt="File type">';
            }
            elseif($ext == 'bmp'||$ext == 'BMP'){
            echo $ftype = '<img src="'.base_url().'public/css/image/bmp-icon.png" alt="File type">';
            }
            elseif($ext == 'ppt'||$ext == 'PPT'){
            echo $ftype = '<img src="'.base_url().'public/css/image/ppt-icon.png" alt="File type">';
            }
            elseif($ext == 'pptx'||$ext == 'PPTX'){
            echo $ftype = '<img src="'.base_url().'public/css/image/pptx-icon.png" alt="File type">';
            }
            elseif($ext == 'pdf'||$ext == 'PDF'){
            echo $ftype = '<img src="'.base_url().'public/css/image/pdf-icon.png" alt="File type">';
            }
            elseif($ext == 'txt'||$ext == 'TXT'){
            echo $ftype = '<img src="'.base_url().'public/css/image/txt-icon.png" alt="File type">';
            }
            ?>
                  </td>
                  <td><?php echo $media->alt_title ?></td>
                  <td> <a href="<?php echo base_url(); ?>public/uploads/files/<?php echo $media->media_title?>" class="" download><i class="entypo entypo-download" title="Download"></i></a>
        </td>
                  
          <td><a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a></td>
                </tr>
                <?php 
        }
        if(!$getMedia){ ?>
                  <tr> <td colspan="6" class="dark_label" id="exeid">No downlodable file yet!</td></tr>
                <?php  }
                }
               
                }
        else
        {
          $nums = 0;
          
                    foreach($medias as $media)
          {
            $nums++;
                        ?>
          
          <tr id="tr<?php echo $media->id;?>" <?php echo $display_none; ?>>
            <td><?php echo $media->id ?>
            <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>"></td>
            <td><?php echo $img_type ?></td>
            <td><?php echo $media->name ?></td>
            <td><?php if($media->published){?>
            <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">
            <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
            
            
            <?php }else{?>
            <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">
            <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
            <?php }?></td>
           
            <td>
            <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>
            </td>
          </tr>
          <?php 
          } 
          if(!$medias){ ?>
                  <tr><td colspan="6" class="dark_label" id="exeid">No downlodable file yet!</td></tr>
                <?php }
        }
        }?>
              
              <input id="mediafiles" name="mediafiles" value="<?php echo ($this->input->post('mediafiles') ? $this->input->post('mediafiles') : '')?>" type="hidden">
              
              </tbody>
            </table>

            <?php if($updType == 'create'){

                $legend = ' ';

            }else{

                $legend = 'Edit Course';

            }?>

            <div class="form-group form-border"> 
            
          <div class="col-sm-5" id="nexttab6" >
            <button type="button" class="btn btn-success btn-green tab-btn" > Update</button>
            </div>
          </div>

          </fieldset>
        </div>
      </dd>
    </div> -->
    <!-- //exe_f -->

    <div class="tab-pane" id="seo">
      <dd class="" sno="6" id="dd_6">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            
            <legend class="field-title tile_fld legend-gap" style="border:none;margin-bottom:0px;">SEO Settings</legend>
            <div class="form-group form-border">
              <label for="field-1" class="col-sm-12 control-label field-title">SEO title
              	<p>(Enter the course title as it will be shown in internet browsers.
Below Text box instruction: Maximum 60 characters.)</p>
              </label>
              <div class="col-sm-12">
                <?php

$metatitle = (isset($program->metatitle)) ? $program->metatitle : '';

$metakwd = (isset($program->metakwd)) ? $program->metakwd : '';

$metadesc = (isset($program->metadesc)) ? $program->metadesc : '';



?>
                <input type="text" value="<?php echo ($this->input->post('metatitle')) ? $this->input->post('metatitle') : $metatitle; ?>" maxlength="255" size="40" name="metatitle" class="form-control form-height" id="m_title">
               
                 
            </div>
          </div>

          <div class="form-group form-border">
              <label for="field-ta" class="col-sm-12 control-label field-title">SEO description
              <p> (Enter the course description that will appear underneath the SEO title.
Below Text box instruction: Maximum 320 characters.)</p>
              </label>
              <div class="col-sm-12">
               
                <textarea class="form-control select-box-border" name="metadesc" cols="40" id="m_desc"><?php echo $this->input->post('metadesc') ? $this->input->post('metadesc') : $metadesc;?> </textarea>
                
                
               </div>
                 
            </div>
          
            <div class="form-group form-border">
              <label for="field-ta" class="col-sm-12 control-label field-title">Course keywords (optional)
              	<p> (To improve your site’s visibility in searches, enter keywords separated by commas.)</p>
              </label>
              <div class="col-sm-12">
                
                <textarea class="form-control select-box-border" name="metakwd" cols="40" id="m_kwd"><?php echo $this->input->post('metakwd') ? $this->input->post('metakwd') : $metakwd;?></textarea>
               
              </div>
               
            </div>
            
            <!--search engine meta tags end here -->

          </fieldset>
          <div class="form-group form-border"> 
						
					<div class="col-sm-5 bottom-btn" id="nexttab5"> 
						<button type="button" class="btn btn-success btn-green tab-btn"> Update</button>
					</div> 
        </div>
      </dd>
      <div style="clear:both;"></div>
    </div>
    <!-- //seo -->

<div class="tab-pane" id="requirements">
      <dd class="" sno="8" id="dd_8">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered" style="margin-top:2%;">
            <legend class="field-title tile_fld legend-gap" style="margin-bottom:0px;"> Course advanced settings<!-- <?php echo $legend; ?> --></legend>
            		<div class="make_lectures_radio">
       
     			  <div class="grey-background">
              			<div class="col-sm-4">
		                <input id="course_type_1" class="course_type" type="radio" name="course_type" value='1' 
		                <?php echo $updType == 'create' ? '' : (isset($program->course_type) && $program->course_type == '1' && $program->is_drip_course!='1') ? 'checked' : ''; ?>		            
		                 />
		                <label for="course_type_1" class='control-label dark_label'>Make lectures sequential <?php //echo lang('web_active')?></label>
		                <p>Lectures can be accessed in a sequence</p>
		               </div>
		               <div class="col-sm-4">
		                <input id="course_type_0" class="course_type" type="radio" name="course_type" value='0' <?php echo $updType == 'create' ? 'checked' : (isset($program->course_type) && $program->course_type == '0' && $program->is_drip_course!='1') ? 'checked' : ''; ?>	 />
		                 <label  for="course_type_0" class='control-label dark_label'>Make lectures random<?php //echo lang('web_active')?></label>
		                 		                <p>Lectures can be accessed randomly</p>

		                 </div>
		                 <div class="col-sm-4">
		                 	<input type="radio"   style="margin-top:1%;" name="dripstatus"  id="dripstatusactive" value="1" onclick="javascript:getDrip(this.value)"
								<?php echo (@$program->is_drip_course == '1') ? "checked" : "" ?> />
								<label for="course_type_1" class='control-label dark_label'>Make drip course <?php //echo lang('web_active')?></label>
								 <p>Lectures will be released on specified date/days</p>
		                 </div>
		                
            	  </div>
            	   <div class="form-group form-border" id="drip_opt" style = "<?php echo (isset($program->is_drip_course) && $program->is_drip_course == '1') ? 'display:block' : 'display:none' ?>" > 
                    <label class="col-sm-12 control-label field-title" requierd>Drip By :</label> 

                    <div class="col-sm-12"> 
                    <select id="lecture_type" name="release_type" class="form-control form-height"  onchange="javascript:driptype(this.selectedIndex)">
                <option value="" <?php echo (@$program->release_type == '') ? "selected" : "" ?> >Select Type</option>
                <option value="1"  <?php echo (@$program->release_type == '1') ? "selected" : "" ?> >Drip by date</option>
                <option value="2"  <?php echo (@$program->release_type == '2') ? "selected" : "" ?>>Drip by days</option>
               <!--  <option value="exam">Exam</option> -->
                </select>
                   
                   
                </div>
          </div>
           </div>
       
        
    
        <div style="clear:both;"></div>
        <div class="form-group form-border">
          <label class="col-sm-12 control-label field-title">Final Quiz:
          	<p>The selected quiz needs to be completed to finish the course.</p>
          </label>
          <div class="col-sm-12">
            <!-- onchange="<?php if($facility == 'foolproof') { echo 'webcamVisiable()'; } ?>" -->
            <select name="final_quizzes" id="final_quizzes" class="form-control form-height" >

              <option value="0">no final quiz</option>
              <?php 
               foreach($finalexamlist as $finalexam){ ?>
              <option value="<?php echo $finalexam->exam_id;?>" <?php echo ($this->input->post('final_quizzes') == $finalexam->exam_id) ? "selected=selected" : (isset($program->id_final_exam)) && $program->id_final_exam == $finalexam->exam_id ? "selected=selected" : '' ?>><?php echo $finalexam->exam_title;?></option>
              <?php }?>
            </select>
           
          </div>
        
        </div>


        <div style="clear:both;"></div>


        <?php
        if(empty($program->id_final_exam))
        {
        	$display = 'display:none';
        }else
        {
        	$display = 'display:block';
        }
        ?>
        <!-- <div class="form-group form-border" id = "webcamDiv" style="<?php echo $display;?>" >
          <label for="field-ta" class="col-sm-12 control-label field-title" style="padding-top:0;">Webcam & Screenshots Option :
  
                <input id="webcam_option" name="webcam_option" type="checkbox" onclick='hideShowWebcamTime();' <?php echo ($this->input->post('webcam_option')) ? "checked" : isset($program->webcam_option) && $program->webcam_option == '1' ? "checked" : '';?>  >
              
              <p> (This Functionality will take screenshots and webcam shots of the examinees during an exam to ensure full proof evalution)</p>
          </label>
          
        </div>

        

        <?php
        if(empty($program->webcam_option))
        {
        	$display1 = 'display:none';
        }else
        {
        	$display1 = 'display:block';
        }
        ?>
        <div class="form-group form-border" id = "timewebcam" style="<?php echo $display1;?>" >
          <label class="col-sm-12 control-label field-title" >Time Difference For Webcam and Screen Shot
          <p style="">(How frequently you want to take the WebCam Shots and Screenshots)</p>
          </label>
          <div class="col-sm-12">
            <select name="CbShot" id="CbShot" class="form-control form-height">
            <option value='10Sec' <?php echo ((@$program->time_for_webcam == '10Sec') ? 'selected' : '');?> >10 Seconds</option>
            <option value='20Sec' <?php echo ((@$program->time_for_webcam == '20Sec') ? 'selected' : '');?> >20 Seconds</option>
      
            <option value='30Sec' <?php echo ((@$program->time_for_webcam == '30Sec') ? 'selected' : '');?> >30 Seconds</option>
            <option value='1min' <?php echo ((@$program->time_for_webcam == '1min') ? 'selected' : '');?>>1 Minutes</option>
            <option value='5min' <?php echo ((@$program->time_for_webcam == '5min') ? 'selected' : '');?>>5 Minutes</option>
            <option value='10min' <?php echo ((@$program->time_for_webcam == '10min') ? 'selected' : '');?>>10 Minutes</option>
            </select>
          </div>
          
        </div> -->
        <!-- <div style="clear:both;"></div>

        <div class="form-group form-border" id = "showresultDiv" style="<?php echo $display;?>" >
          <label for="field-ta" class="col-sm-12 control-label field-title" style="padding-top:0px;">Moderate Exam :
          	<input id="show_result" name="show_result" type="checkbox" <?php echo ($this->input->post('show_result')) ? "checked" : isset($program->show_result) && $program->show_result == '1' ? "checked" : '';?>  >
                
             
                <p> (This Functionality will Show or Pending Exam)</p>
              
          </label>
          
        </div> -->

        <div class="form-group form-border">
          <label class="col-sm-12 control-label field-title" style="padding-top:0px;">Course Certificate :</label>
          <div class="col-sm-12">
            <select class="form-control form-height" onchange="javascript:certificatemessage(this.selectedIndex)" name="certificate_setts" id="certificate_setts">
              <option value="1" <?php echo ($this->input->post('certificate_setts') == '1') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '1' ) ? "selected=selected" : '' ?> >No Certificate</option>
              <option value="2" <?php echo ($this->input->post('certificate_setts') == '2') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '2' ) ? "selected=selected" : '' ?> >After successful completion of all lectures</option>
              <option value="3" <?php echo ($this->input->post('certificate_setts') == '3') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '3' ) ? "selected=selected" : '' ?> >After passing the final quiz</option>
              <option value="4" <?php echo ($this->input->post('certificate_setts') == '4') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '4' ) ? "selected=selected" : '' ?> >After passing the quizzes on an average </option>
              <option value="5" <?php echo ($this->input->post('certificate_setts') == '5') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '5' ) ? "selected=selected" : '' ?> >After finishing all the lectures and passing the final quiz</option>
              <option value="6" <?php echo ($this->input->post('certificate_setts') == '6') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '6' ) ? "selected=selected" : '' ?> >After finishing all the lectures and passing all the quizzes on an average </option>
            </select>
        
          </div>
        </div>
        <div style="clear:both;"></div>
      <!--   <div class="form-group form-border" style="<?php echo $program->certificate_course_msg ? 'block' : 'none' ; ?>display:none;" id="coursecertifiactemsg">
          <label class="col-sm-12 control-label field-title" >Certificate course message</label>
          <div class="col-sm-12">
            <textarea maxlength="7000" name="coursemessage" id="coursemessage" class="form-control select-box-border"><?php echo set_value('certificate_course_msg', (isset($program->certificate_course_msg)) ? $program->certificate_course_msg : '');?></textarea>
          </div>
        </div> -->
        <!-- // drip -->
       <!--  <?php if($updType=='create' || @$program->is_drip_course == '1'){
        	
         ?>
         <div style="clear:both;"></div>
          <legend class="field-title tile_fld legend-gap"> Drip course Settings</legend>
            <div class="form-group form-border dark_label">
            
              <label class="col-sm-12 control-label field-title">Drip course Status :
         	 	<p>(A fancy way of saying "Scheduled Lesson Delivery". Schedule the timely release of your course contents with email reminder. )</p>
         	  </label>
         	  <div class="col-sm-12">
         	   <div class="grey-background">
         	   	<input type="radio"   style="margin-top:1%;" name="dripstatus"  id="dripstatusactive" value="1" onclick="javascript:getDrip(this.value)"
								<?php echo (@$program->is_drip_course == '1') ? "checked" : "" ?> />
                                &nbsp;Active&nbsp;&nbsp;

                <input  type="radio" style="margin-top:1%;" name="dripstatus" id="dripstatusinactive" onclick="javascript:getDrip(this.value)"  value="0"
							<?php echo (@$program->is_drip_course == '' || $updType=='create') ? "checked" : "" ?> />
                			&nbsp;Inactive
                </div>
                </div>
                

            </div>

              
      <?php } ?> -->
              <div class="form-group form-border"> 
						
					<div class="" id="nexttab7" >
						<button type="button" class="btn btn-success btn-green tab-btn"> Update</button>
	  </div>
					</div> 
			</fieldset>

        </div>
      </dd>
    </div>
    <!-- //requirement -->
     <div class="tab-pane" id="publishing">
      <dd class="" sno="6" id="dd_6">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
                <div class="form-group form-border" style="padding-top:0!important;">
            	  

            	<div class="col-sm-12">
            		
						<div class="col-sm-12" style="padding:0;" id="sel_stu">

						   <div class="grey-background">
						   	<?php // echo $program->published; if($program->published == '0' || $updType == 'create'){ 
                  // if($updType == 'edit' && $program->published == 0 ){
						   		?>
						   		<div id="publish_block"  style="display: <?php echo ($updType == 'edit' && $program->published == '0') ? 'block' :'none'; ?>" >
                    <!-- style="display: <?php echo $program->published == '0' ? 'block' : $updType == 'create' ? 'none' : 'none'; ?>" -->
                  <div class="col-sm-9"><h4>This course is not published yet </h4>

                <p>(Your course is in draft state. Students cannot purchase or enrol in this course. For students that are already enrolled, this course will not appear in their dashboard.)</p>
                  </div>
                  <div class="col-sm-3"><button type="button" style="float: right" id="publish" class='btn-info btn-publish'>Publish</button></div>
                  </div>
                    <?php

                // } else if($program->published == 1 || $updType == 'create'){ ?>
                  <div id="unpublish_block" style="display: <?php echo $program->published == 1 ? 'block' : $updType == 'create' ? 'block' : 'none'; ?>">
                    <!-- style="display: <?php echo $program->published == 1 ? 'block' : $updType == 'create' ? 'block' : 'none'; ?>" -->
                  <div class="col-sm-8">
                  <h4>This course is published</h4>
                  <p>(Now that the course is published, students will be able to purchase or enrol in this course. For students that are enrolled, this course will appear in their dashboard.)</p>
                  </div>
                  <div class="col-sm-4">
                  <button type="button" style="float: right" id="unpublish" class='btn-info btn-publish'>Unpublish</button>
                    </div></div>
                  <?php
                // }
                ?>
						   	<input style="margin-top: 1%;" id="published" name="published" class="radio-btn" type="hidden" value="<?php echo isset($program->published) ? $program->published : $updType=='create' ? '1' : '0';?>" />

						  
						  </div>
						</div>
						

           
            </div>
        </div>
			<div class=""> 
						
					<div class="col-sm-5 bottom-btn" id="nexttab5"> 
						<button type="button" class="btn btn-success btn-green tab-btn"> Update</button>
					</div> 
        </div>
                  </fieldset>

    </div>
          
      </dd>
<!--       <div style="clear:both;"></div>
 -->    </div>
  <?php /*if($program->is_live_class == 1){
      $batches = $this->Crud_model->GetData('mlms_batches','',"is_delete = 'no' and course_id = ".$program->id);
    ?>
    <div class="tab-pane" id="webinar">
      <dd class="" sno="9" id="dd_9">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <div class="form-group form-border">
              <label class='col-sm-12 control-label field-title' for="name" style="margin-top: 0px;padding-top: 0px;">
                <p>Your batch details are shown below and you can manage them here.
                  <a class="btn btn-default btn-dark-grey pull-right" href="<?php echo base_url().'admin/programs/create_batch/'.$program->id;?>">
                    <span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Create new Batch
                  </a>
                </p>
              </label>
            </div>
            <div id="batchdiv">
            <?php if (!empty($batches)){ ?>
              <style type="text/css">
               .fallupcls .lnr-cross{
                    font-size: 14px;
                    font-weight: bold;
                    cursor: pointer;
                    position: absolute;
                    right: 5px;
                    top: 11px;
               }
               .fallup_deleted{
                background: #de5151 !important;
                color: #fff;
                font-weight: bold;
               }
                .field-title .btn-warning{
            background-color: #fbaf24 !important;
            border-color: #fbaf24 !important;
            border-radius: 20px !important;
            font-weight: bold;
            width: 100%;
        }.new_course_select_sec{
  height: auto !important;
}
.new_course_select_sec h4{
  line-height: 1.63;
}
.new_course_select_sec h4 a{
  color: #2d3b92;
  border-bottom: 1px solid;
  font-size: 17px;
}
.new_course_popup{
    width: 35%;
  }
@media (max-width: 767px){
  .new_course_popup{
    width: 90%;
  }
}
@media (max-width: 991px){
  .new_course_popup{
    width: 80%;
  }
}
              </style>
            <ul class="nav tabs-vertical">
              <?php $ij = 1;
              foreach ($batches as $batch) {
              ?>
              <li class="<?php if($ij==1){ ?> active <?php } ?>" id="vtab<?php echo $batch->id; ?>" onclick="return jump_tab('<?php echo $batch->id;?>');">
                <a class="fallupcls" href="#vtab_<?php echo $batch->id; ?>">
                  <i class="entypo-dot"></i><?php echo ucwords($batch->batch_name); ?>
                  <span class="lnr lnr-cross" onclick="delete_batch(<?php echo $batch->id;?>);"></span>
                </a>
              </li>
              <?php $ij++; } ?>
              <input type="hidden" id="batch_count" value="<?php echo count($batches);?>">
            </ul>
            <div class="tab-content vtab_div">
              <?php $i = 1;
              foreach ($batches as $batch) {
                
                $events = $this->Crud_model->GetData('zoom_meeting_list','','is_delete = "no" and conf_type = "batch" and batch_id = '.$batch->id);
              ?>
              <div class="tab-pane <?php if($i==1){ ?> active <?php } ?>" id="vtab_<?php echo $batch->id;?>">
              
                <a href="<?php echo base_url().'admin/programs/update_batch/'.$batch->id.'/'.$program->id;?>"><span class="icon-32-new"></span><i class="lnr lnr-pencil" style="font-weight: bold;"></i>
                <span style="font-size: 18px;padding-left: 5px;text-decoration: underline;"><?php echo ucwords($batch->batch_name); ?> : [ <?php echo date('h:i A',strtotime($batch->batch_start_time)).' - '.date('h:i A',strtotime($batch->batch_end_time)); ?> ]</span></a><br>
                <span style="font-size: 13px;padding-left: 20px;"><?php if($batch->batch_from != '0000-00-00'){ echo 'starts from : '.date('Y-m-d',strtotime($batch->batch_from));} ?></span>

                <a href="<?php echo base_url().'conference-create/'.$batch->id;?>" class="btn btn-default btn-dark-grey pull-right"><span class="icon-32-new"></span><i class="entypo entypo-plus"></i> Create Event </a>
                <table class="table table-bordered responsive">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Event Title</th>
                      <th>Event Date & Time</th>
                      <th>No. of Students</th>
                      <!-- <th>Assigned Teacher</th> -->
                      <th>Options</th>
                      <th>Start Event</th>
                    </tr>
                  </thead>
                  <tbody id="event_body" style="text-align: center;">
                  <?php if(!empty($events)){ $j=1;
                    foreach ($events as $evt) {
                      $end_time = date('Y-m-d H:i:s',strtotime($evt->start_time . " +".$evt->duration." minutes"));
                      $start_time = date('Y-m-d H:i:s',strtotime($evt->start_time . " -1 minutes"));

                      $datetime1 = new DateTime(date('Y-m-d H:i:s'));
                      $datetime2 = new DateTime($evt->start_time);
                      $inter = $datetime1->diff($datetime2);
                      $interval = $inter->format('%h')." Hours ".$inter->format('%i')." Minutes to start";
                      $hour_int = $inter->format('%h');
                  ?>
                    <tr class="odd" id="event_id_<?php echo $evt->id;?>">
                      <td class="field-title" style="color: #666;"><?php echo $j++; ?></td>
                      <td class="field-title" style="color: #666;"><?php echo $evt->topic; ?></td>
                      <td class="field-title">
                        <?php echo date('Y-m-d h:i A',strtotime($evt->start_time));
                        if(date('Y-m-d',strtotime($evt->start_time)) ==  date('Y-m-d')){ 
                          if(date('Y-m-d H:i:s') < $start_time){
                            echo "<br>( ".$interval." )";
                          }
                        }else if(date('Y-m-d',strtotime($evt->start_time)) > date('Y-m-d')){
                          if(intval($hour_int) <= 24){
                            echo "<br>( ".$interval." )";
                          }
                        }
                        ?>
                      </td>
                      <td><?php echo $batch->enroll_limit; ?></td>
                      <td class="editdelete">
                        <a class="col-sm-offset-2 col-sm-4 no-padding" href="<?php echo base_url().'conference-edit/'.$evt->id.'/batch/';?>"><div class="sprite 2edit" style="background-position: -32px 0;" title="Course Content"></div></a>
                        <a class="col-sm-4" href="#" onclick="delete_event(<?php echo $evt->id ?>);"><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
                      </td>
                      <td class="field-title">
                        <?php if(date('Y-m-d',strtotime($evt->start_time)) ==  date('Y-m-d')){ 
                        if(date('Y-m-d H:i:s') >= $start_time && date('Y-m-d H:i:s') <= $end_time){ ?>
                        <a class="btn btn-warning btn-md" onclick="return check_zoom('https://zoom.us/wc/<?php echo $evt->meeting_id; ?>/start');">Start</a>
                       <?php } else if(date('Y-m-d H:i:s') < $start_time){?>
                        <a class="btn btn-warning btn-md" href="#">Wait</a>
                       <?php } else if(date('Y-m-d H:i:s') > $end_time){ ?>
                        <a class="btn btn-warning btn-md" href="#" id="wait" type="button">Finished</a>
                       <?php }
                      }else if(date('Y-m-d',strtotime($evt->start_time)) > date('Y-m-d')){ ?>
                      <a class="btn btn-warning btn-md" href="#" type="button">Upcoming</a>
                      <?php } else if(date('Y-m-d',strtotime($evt->start_time)) < date('Y-m-d')){ ?>
                      <a class="btn btn-warning btn-md" type="button" href="#" id="wait">Finished</a>
                      <?php } ?>

                        
                        <!-- <a class="btn btn-warning btn-md" onclick="return check_zoom('<?php echo base_url();?>live-meeting/<?php echo $evt->meeting_id;?>/0');">Start</a></td> -->
                    </tr>
                    <?php } ?>
                    <input type="hidden" id="total_events" value="<?php echo intval($j) - 1; ?>">
                    <?php }else{ ?>
                    <tr class="odd">
                      <td colspan="6">
                        No Events available. <a href="<?php echo base_url().'conference-create/'.$batch->id;?>">Create one now</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <?php
              $i++;} ?>
            </div>
            <?php }else{ ?>
            <p> No batches available. <a href="<?php echo base_url().'admin/programs/create_batch/'.$program->id;?>">Create one now</a></p>
            <?php } ?>
          </div>
          </fieldset>
        </div>
      </dd>
    </div>
  
    <?php }*/ ?>
<script type="text/javascript">
  function jump_tab(id){
    $(".tabs-vertical").find('.active').removeClass('active');
    $("#vtab"+id).addClass(' active ');
    $(".vtab_div").find('.active').removeClass('active');
    $("#vtab_"+id).addClass(' active ');
  }
  
  function delete_event(id) 
  {
      var total_events = $("#total_events").val();       
      $.confirm({
          title: 'Do you really want to delete this event?',
          content: ' ',
          confirm: function(){ 
            $.ajax({
                type : 'post',
                cache : false,
                url :"<?php echo base_url();?>conference-delete/",
                data : {id : id},
                success : function(response){
                  $("#event_id_"+id).remove();
                  total_events = parseInt(total_events) - 1;
                  $("#total_events").val(total_events);
                  if(total_events == 0){
                    var newurl = "<?php echo base_url('conference-create/').$batch->id;?>";
                    $("#event_body").html('<tr class="odd"><td colspan="6">No Events available. <a href="'+newurl+'">Create one now</a></td></tr>');
                  }
                }
            });
          },
          cancel: function(){        
              return true;
                }
            });
    }

  function delete_batch(id) 
  {

      var batch_count = $("#batch_count").val();       
      $.confirm({
          title: 'Do you really want to delete this Batch?',
          content: ' ',
          confirm: function(){ 
            $.ajax({
                type : 'post',
                cache : false,
                url :"<?php echo base_url();?>admin/programs/delete_batch/",
                data : {id : id},
                success : function(response){
                  if(response == 'denied'){
                    $("#webinar fieldset label").append('<p class="err_batch" style="color:red;">Warning - Unable to delete Batch as it contains some events.</p>');
                    setTimeout(function(){
                      $(".err_batch").remove();
                    },5000);

                  }else{
                    batch_count = parseInt(batch_count) - 1;
                    $("#batch_count").val(batch_count);
                    $("#vtab"+id+" .fallupcls").html('Deleted').addClass('fallup_deleted');
                    setTimeout(function(){
                      $("#vtab"+id).remove();
                      $('.nav.tabs-vertical li:first-child').addClass('active').click();
                    },1000);
                    if(batch_count == 0){
                      var newurl = "<?php echo base_url().'admin/programs/create_batch/'.$program->id;?>";
                      $("#batchdiv").html(' <p> No batches available. <a href="'+newurl+'">Create one now</a></p>');
                    }
                  }
                }
            });
          },
          cancel: function(){        
              return true;
                }
            });
    }
</script>

    <!-- //publishing -->

    <!--<div class="tab-pane" id="description_tab" >
      <fieldset class="adminform form-horizontal form-groups-bordered">
        
      </fieldset>
    </div>-->
		
	
    
    </div>
    </div>
	<?php  
		$this->load->config('features_config');
		$webinar = $this->config->item('webinar');				
		
			if($webinar['status']==TRUE)
			{
	?>
    <div class="tab-pane" id="webinar">
      <dd class="" sno="9" id="dd_9">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">

          </fieldset>
        </div>
      </dd>
    </div>
	<?php
		}
	?>
  </div>
  <!-- <?php if ($updType == 'edit'){ ?>
  <div ><a class="link_page" style="float: right;" href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>">
   <span class="lnr lnr-pencil" style="font-size: 15px;"></span>
  <div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div><span class="crosslink">Course Content</span></a></div>
  <?php } ?> -->
</div>
<input type="hidden" name="med_type" id="med_type" value="" >
<input type="hidden" name="med_name" id="med_name" value="" >
<input type="hidden" name="med_file" id="med_file_f" value="" >
<input type="hidden" name="med_file" id="med_file_d" value="" >
<input type="hidden" name="med_active" id="med_active" value="" >
<input type="hidden" name="med_inst" id="med_inst" value="" >
<input type="hidden" name="med_cat" id="med_cat" value="" >

<input type="hidden" name="setname" id="setname" value="">
<input type="hidden" name="setdescription" id="setdescription" value="">
<input type="hidden" name="setcategory" id="setcategory" value="">
<input type="hidden" name="setactivate" id="setactivate" value="">
<input type="hidden" name="setsrc" id="setsrc" value="">
<input type="hidden" name="setimg" id="setimg" value="">

<div style="clear:both;"></div>

<div id="myModal2" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
   
</div>


<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
		return false;

    return true;
}

  $(function() {
    $( "#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#todate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
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
</script>
  
  <script type="text/javascript">
  function getWebDesc(i) 
  {
     if(i == "active")
	 {
	    document.getElementById('desc_tr').style.display = "block";
	 }
	 else{
	 
	    document.getElementById('desc_tr').style.display = "none"; 
	 }
  }

</script>

  
  <script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script> 


  <script type="text/javascript">
window.onload = function() { 

//showhidecoursetype();

certificatemessage();

}

function showhidecoursetype(){

	var selvalue = document.getElementById("course_type").selectedIndex;
	if(selvalue == '1')

	{

	document.getElementById("lessons_release_td").style.display="block";

	document.getElementById("lessons_show_td").style.display="block";

	}else

	{

	document.getElementById("lessons_release_td").style.display="none";

	document.getElementById("lessons_show_td").style.display="none";

	}

}

function certificatemessage(selvalue)
{
	var selvalue = document.getElementById("certificate_setts").selectedIndex;

	if(selvalue == 0)
	{
		document.getElementById("coursecertifiactemsg").style.display="none";
	}
	else
	{
		document.getElementById("coursecertifiactemsg").style.display="block";
	}
}


function showhidecourse(){

	var selvalue = $('input[name=step_access_courses]:checked').val();
	// alert(selvalue);
	if(selvalue == '0')
	{

	document.getElementById("free_courses").style.display="block";
	$('.reg_rad').prop('checked', true);
    $('#chb_free_courses1').prop('checked', false);
    document.getElementById('fixed_rate').style.display = 'block';
	document.getElementById('one-time').style.display = 'block';

	document.getElementById("priceDiv").style.display="block";   
	document.getElementById("price_subs").style.display="none";
	}else

	{

	$('#chb_free_courses1').prop('checked', true);
    $('.plan').prop('checked', false);

	document.getElementById("free_courses").style.display="none";
	// document.getElementById("priceDiv").style.display="none";
	document.getElementById("price_subs").style.display="none";
	document.getElementById("one-time").style.display="none";
	}

	


}

</script> 

<script type="text/javascript">

	jQuery(document).ready(function(){
    var webmsg = "<?php echo $this->session->userdata('webmsg'); ?>";
    if(webmsg != ''){
      $(".nav-tabs li.active").removeClass('active');
      $(".field_content").find('.tab-pane').removeClass('active');
      $("#vtab_div div").find('.active').removeClass('active');
      $(".nav-tabs li:nth-child(3)").addClass("active");
      $("#webinar").addClass("active");
      console.log('<?php $this->session->unset_userdata('webmsg'); ?>');
      
      $("#vtab_"+webmsg).addClass('active');
      $(".tabs-vertical").find('.active').removeClass('active');
      $("#vtab"+webmsg).addClass(' active ');
    }
    
	jQuery(".removeele").on('click',function(){
    
	var id = jQuery(this).attr("id");
    
	id = id.substr(6);
    
	jQuery("#tr"+id).remove();
    
	});
    
	});
    
</script> 



<script type="text/javascript">
function deleteRow(i) {
       //alert(i);
       document.getElementById('myTable').deleteRow(i);
}
</script>

<script type="text/javascript">
function deleteRow1(i) {
       //alert(i);
       document.getElementById('table_courses_id').deleteRow(i);
}
</script>
<script>
function publishbutton(id){

		var splitarray = id.split('-');

		var split0=splitarray[0];

		var funname = '';

			if(split0=="publish"){

			funname = "unpublish";

			}

			else{

			funname = "publish";

			}

		var split1=splitarray[1];
		var $ = jQuery;
		$.ajax({

		url: '<?php echo base_url(); ?>admin/medias/'+funname+'/'+split1,

			 success: function(msg){

			 if(split0=="publish"){

             ftpfileoptions = '<img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" id="unpublish-'+split1+'" class="unpublish" onclick="publishbutton(\'unpublish-'+split1+'\');">';

		     $('#tdpublish'+split1).html(ftpfileoptions);

			 $('#publish-'+split1).hide();

			 }else{

             ftpfileoptions = '<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" id="publish-'+split1+'" class = "publish" onclick="publishbutton(\'publish-'+split1+'\');">';

		     $('#tdpublish'+split1).html(ftpfileoptions);

			 $('#unpublish-'+split1).hide();

			 }

		   }

		});

}
</script> 


<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">

		jQuery(document).ready(function() {

			/*

			 *  Simple image gallery. Uses default settings

			 */



			jQuery('.fancybox').fancybox();



			/*

			 *  Different effects

			 */



			// Change title type, overlay closing speed

			jQuery(".fancybox-effects-a").fancybox({

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

			jQuery(".fancybox-effects-b").fancybox({

				openEffect  : 'none',

				closeEffect	: 'none',



				helpers : {

					title : {

						type : 'over'

					}

				}

			});



			// Set custom style, close if clicked, change title type and overlay color

			jQuery(".fancybox-effects-c").fancybox({

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

			jQuery(".fancybox-effects-d").fancybox({

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



			jQuery('.fancybox-buttons').fancybox({

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

			jQuery('.fancybox-thumbs').fancybox({

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



			/*

			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.

			*/

			jQuery('.fancybox-media')

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



			/*

			 *  Open manually

			 */



			jQuery("#fancybox-manual-a").click(function() {

				jQuery.fancybox.open('1_b.jpg');

			});



			jQuery("#fancybox-manual-b").click(function() {

				jQuery.fancybox.open({

					href : 'iframe.html',

					type : 'iframe',

					padding : 5

				});

			});



			jQuery("#fancybox-manual-c").click(function() {

				jQuery.fancybox.open([

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





jQuery(document).ready(function() {

   jQuery("span.error").each(function() {

   var parent = jQuery(this).closest('dd').attr('sno');

   var get_error = jQuery(this).text();

    if(get_error != ''){

          jQuery(this).closest('dd').prev('dt').css('background-color', 'red');

     }



  });
});
</script> 
<!-- add bottom  -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script> 


<script>
$('#blah').hide();
$('#remove_id').hide();  
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#file_i").change(function(){
        if( $('#file_i').val()!=""){
            
            $('#remove_id').show();
            $('#blah').show('slow');
            $('#imagname').hide('slow');
      }
        else{ $('#remove_id').hide();$('#blah').hide('slow');}
        readURL(this);
    });

  
    $('#remove_id').click(function(){
          $('#file_i').val('');
          $(this).hide();
          $('#blah').hide('slow');
		  $('#imagname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
});
</script>

<script type="text/javascript">
  function getPlan(i) 
  {
  	$('#chb_free_courses1').prop('checked', false);
	$('#step_access_courses1').prop('checked', false);
	$('#step_access_courses0').prop('checked', false);
	$('#free_courses').hide();
		$('#Stud_free').hide();

     if(i == "fixed")
	 {

	    document.getElementById('fixed_rate').style.display = 'block';
	    document.getElementById('one-time').style.display = 'block';
	    document.getElementById('price_subs').style.display = 'none';
	    document.getElementById('subscriptions_tr').style.display = 'none';
	    document.getElementById('subscriptions_headtr').style.display = 'none';
	    document.getElementById('renewals_tr').style.display = 'none';
	    document.getElementById('renewals_headtr').style.display = 'none';
	    //$("#chb_free_courses").attr("disabled", true);
	    //$("#fixed_rate").toggle();
	    //$("#price_subs").toggle();
	   // $("#chb_free_courses").toggle();  
	    

			
	 }
	 else if(i == "subscription")
	 {
	 		
	    document.getElementById('fixed_rate').style.display = 'none';
        document.getElementById('one-time').style.display = 'none';
	    document.getElementById('price_subs').style.display = 'block';
	    document.getElementById('subscriptions_tr').style.display = 'table-row';
	    document.getElementById('subscriptions_headtr').style.display = 'table-row';
	    document.getElementById('renewals_tr').style.display = 'table-row'; 
	    document.getElementById('renewals_headtr').style.display = 'table-row'; 
	    //$("#chb_free_courses").attr("disabled", true);
	 }
	

  }

 function getDrip(i) 
  {
  	  	
     if(i == "1")
	 {
	 	$(document).find(".course_type").prop("checked",false); 
	    document.getElementById('drip_opt').style.display = "block";
	 }
	 else{
	 
	    document.getElementById('drip_opt').style.display = "none"; 
	   
	 }
  }
$(document).find('.course_type').on('click', function(){
	 document.getElementById('drip_opt').style.display = "none"; 
	 $(document).find("#dripstatusactive").prop("checked",false); 
	});

function driptype(setvalue)
{
	// var selvalue = document.getElementById("certificate_setts").selectedIndex;

	if(setvalue == 1)
	{
		document.getElementById("drip_date").style.display="block";
		document.getElementById("drip_days").style.display="none";
	}
	else if(setvalue == 2)
	{
		document.getElementById("drip_date").style.display="none";
		document.getElementById("drip_days").style.display="block";
	}
	else
	{
		document.getElementById("drip_date").style.display="none";
		document.getElementById("drip_days").style.display="none";
	}
}

  		
</script>
<script type="text/javascript">
	$(function() 
	    {	
	    	var vv1 =  $("input[name='chb_free_courses']:checked").val();
	    	//var vv1 =  $("input[name='step_access_courses']:checked").val(); //$("#step_access_courses").val();
	    	
	    	if(vv1 == 0)
	    	{
	    		var vv2 =  $("input[name='step_access_courses']:checked").val();
	    		
			    	if(vv2 == 1)
			    	{	    		 	

			    		document.getElementById('free_courses').style.display = 'none';
			    		// document.getElementById('priceDiv').style.display = 'none';
					    document.getElementById('fixed_rate').style.display = 'none';
			    		document.getElementById('one-time').style.display = 'none';
					    document.getElementById('price_subs').style.display = 'none';
					    document.getElementById('subscriptions_tr').style.display = 'none';
					    document.getElementById('subscriptions_headtr').style.display = 'none';
					    document.getElementById('renewals_tr').style.display = 'none';
					    document.getElementById('renewals_headtr').style.display = 'none';
			    		
					}
					else
					{

				  		 var vv =  $("input[name='plan']:checked").val();
				    	
			    	     if(vv == "fixed")
				 	     {
				 	     	document.getElementById('free_courses').style.display = 'block';
						    document.getElementById('fixed_rate').style.display = 'block';
			 				document.getElementById('one-time').style.display = 'block';
						    document.getElementById('price_subs').style.display = 'none';
						    document.getElementById('subscriptions_tr').style.display = 'none';
						    document.getElementById('subscriptions_headtr').style.display = 'none';
						    document.getElementById('renewals_tr').style.display = 'none';
						    document.getElementById('renewals_headtr').style.display = 'none';
						
				         }
						 else if(vv == "subscription")
						 {
						 	document.getElementById('free_courses').style.display = 'block';
						    document.getElementById('fixed_rate').style.display = 'none';
					         document.getElementById('one-time').style.display = 'none';
						    document.getElementById('price_subs').style.display = 'block';
						    document.getElementById('subscriptions_tr').style.display = 'table-row';
						    document.getElementById('subscriptions_headtr').style.display = 'table-row';
						    document.getElementById('renewals_tr').style.display = 'table-row'; 
						    document.getElementById('renewals_headtr').style.display = 'table-row'; 
						  
						 }
					}


	    	}
	    	else
	    	{

				    	

				    	//var vv = $("#plan").val();
				    	var vv =  $("input[name='plan']:checked").val();
				    	
				    	   if(vv == "fixed")
					 	   {
						    document.getElementById('fixed_rate').style.display = 'block';
				 			document.getElementById('one-time').style.display = 'block';
						    document.getElementById('price_subs').style.display = 'none';
						    document.getElementById('subscriptions_tr').style.display = 'none';
						    document.getElementById('subscriptions_headtr').style.display = 'none';
						    document.getElementById('renewals_tr').style.display = 'none';
						    document.getElementById('renewals_headtr').style.display = 'none';
						
					       }
						 else if(i == "subscription")
						 {
						    document.getElementById('fixed_rate').style.display = 'none';
					         document.getElementById('one-time').style.display = 'none';
						    document.getElementById('price_subs').style.display = 'block';
						    document.getElementById('subscriptions_tr').style.display = 'table-row';
						    document.getElementById('subscriptions_headtr').style.display = 'table-row';
						    document.getElementById('renewals_tr').style.display = 'table-row'; 
						    document.getElementById('renewals_headtr').style.display = 'table-row'; 
						  
						 }
			}

	    });
</script>

<script>
$(function() {
    $( "#fromdate" ).datepicker({

		dateFormat: "yy-mm-dd",
	
		defaultDate: "+1w",
	
		changeMonth: true,
	
		numberOfMonths: 1,
	
		showOn: "button",
	
		buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",
	
		buttonImageOnly: true,
	
		onClose: function( selectedDate ) 
		{

			$( "#todate" ).datepicker( "option", "minDate", selectedDate );

		}
		
    });

   

	});

	</script> 
	<input type="hidden" name="upd" value="<?php echo $updType; ?>" id="upd"/>


<?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>
<input type="hidden" name="media_number" value="<?php //echo $n; ?>" id="media_number"/>
<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$program->id) ?>
<?php endif ?>
<?php echo form_close(); ?> 



<!-- tool tip script -->

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
// $(document).ready(function(){
// webcamVisiable();
// });
// function webcamVisiable()
// {   
// 	var selectname = $( "#final_quizzes option:selected" ).val();
// 	if(selectname !=0)
// 	{
// 		$("#webcamDiv").css("display","block");
// 		$("#showresultDiv").css("display","block");

// 		var tt = $('#webcam_option').is(":checked");
// 		  if(tt==true)
// 		  {
// 		  	document.getElementById("timewebcam").style.display="block";
// 		  }

// 		  $("#certificate_setts option[value='3']")
//     		.removeAttr("disabled");
//     		 $("#certificate_setts option[value='5']")
//     		.removeAttr("disabled");

// 	}
// 	else
// 	{
// 		$("#webcamDiv").css("display","none");
// 		$("#showresultDiv").css("display","none");
// 		document.getElementById("timewebcam").style.display="none";

// 		$("#certificate_setts option[value='3']")
//     		.attr("disabled", "disabled");
//     		 $("#certificate_setts option[value='5']")
//     		.attr("disabled", "disabled");
   				
//    		 $("#certificate_setts option[value='3']").prop("selected",false); 
//    		 $("#certificate_setts option[value='5']").prop("selected",false);
// 	}
// }

// function hideShowWebcamTime()
// {   
// 	if(document.getElementById('webcam_option').checked ==true)
// 	{
// 		$("#timewebcam").css("display","block");
// 	}
// 	else
// 	{
// 		$("#timewebcam").css("display","none");
// 	}
// }
</script>
<script>
var updType = $('#upd').val();
for(var i=1;i<=7;i++)
{
		$('#nexttab'+i).click(function() {
			 if(updType == 'edit'){
		    var valid = formvalid();
			    if(valid == true){
			    	 $("#submit").click();
			    }
			} else{
			 var active = $('ul li.active').removeClass('active');
		   active.next().addClass('active');
		   var active_tab = $('div.tab-pane.active').removeClass('active');
		   active_tab.next().addClass('active');
		    $("html, body").animate({ scrollTop: 0 }, 600);
		}
		   
		  
		});
}
	/*$("#chb_free_courses").on('click', function()
	 {
	 	$("#priceDiv").toggle();
	 });*/
</script>



<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 

<script>
	
 jQuery(".todolist").focus(function() {
    if(document.getElementById('todolist').value === ''){
        document.getElementById('todolist').value +='* ';
	}
});


function insertAtCaret(areaId, text) {
  var txtarea = document.getElementById(areaId);
  if (!txtarea) {
    return;
  }

 	var txtval = document.getElementById('todolist').value;
 	var ele = txtval.split('*');
 	// console.log(ele);
 	// console.log(ele[ele.length - 2]);
 	var len = ele.length;
 	if(len > 2 && ele[len - 2].trim() == '')
 	{
 		return false;
 	}
 	else{


  var scrollPos = txtarea.scrollTop;
  var strPos = 0;
  var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
    "ff" : (document.selection ? "ie" : false));
  if (br == "ie") {
    txtarea.focus();
    var range = document.selection.createRange();
    range.moveStart('character', -txtarea.value.length);
    strPos = range.text.length;
  } else if (br == "ff") {
    strPos = txtarea.selectionStart;
  }

  var front = (txtarea.value).substring(0, strPos);
  var back = (txtarea.value).substring(strPos, txtarea.value.length);
  txtarea.value = front + text + back;
  strPos = strPos + text.length;
  if (br == "ie") {
    txtarea.focus();
    var ieRange = document.selection.createRange();
    ieRange.moveStart('character', -txtarea.value.length);
    ieRange.moveStart('character', strPos);
    ieRange.moveEnd('character', 0);
    ieRange.select();
  } else if (br == "ff") {
    txtarea.selectionStart = strPos;
    txtarea.selectionEnd = strPos;
    txtarea.focus();
  }

  txtarea.scrollTop = scrollPos;
	}
}

 jQuery(".todolist").keyup(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){

    	insertAtCaret('todolist', '* ')
        //document.getElementById('todolist').value +='* ';
        // $('.todolist').append('* ');
	}
 	var txtval = document.getElementById('todolist').value;

	if(txtval.substr(txtval.length - 1) == '\n'){
		document.getElementById('todolist').value = txtval.substring(0,txtval.length - 1);
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() 
	{
		disableAssistant();
	});

  function disableAssistant()
  {
  	var tecval =$("#teacher_id").val();  	     

  	var assval =$("#assistant_id").val(); 

  	    $("#assistant_id option[value='"+tecval+"']")
    .attr("disabled", "disabled")
   .siblings().removeAttr("disabled");
   $("#assistant_id option[value='"+tecval+"']").prop("selected",false);   
    
  }
</script>


<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){
                               //Examples of how to assign the Colorbox event to elements
                               
                         //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});                        
                       $j(".newsect_pop").colorbox({
                               iframe:true,
                               width:"500px", 
                               height:"640px",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,

                                               })


                       $j(".upimg_pop").colorbox({
                               iframe:true,
                               width:"500px", 
                               height:"60%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,                                                                  
                                               })

                       $j(".exifiles_pop").colorbox({
                               iframe:true,
                               width:"700px", 
                               height:"100%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,                                                                  
                                               })

                       $j(".newexe_pop").colorbox({
                               iframe:true,
                               width:"530px", 
                               height:"600px",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,                                                                  
                                               })
                        $j(".addcourse_pop").colorbox({
                               iframe:true,
                               width:"43%", 
                               height:"90%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,                                                                  
                                               })

                        });


                        
                       
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
var $j = jQuery.noConflict();
$j.validate({
errorElementClass:"validateerrorbox",
errorMessageClass:"validateerror",
borderColorOnError:"red",
//errorMessagePosition:"top",
modules : 'logic',
}); 
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
var $j =jQuery.noConflict();
  function formvalid()
  {  	
  	var name = $j('#name').val();
    // alert(name);
  	var description =tinymce.get('description').getContent();
  	//var description = $j('#description').val();
  	var category_id = $j('#category_id').val();
  	var teacher_id = $j('#teacher_id').val();
  	var step_access_courses = $j('input[name=step_access_courses]:checked').val();
  	//var plan = $j('input[name=plan]:checked').val();
  	
  	var chb_free_courses = $j('input[name=chb_free_courses]:checked').val();

    // e.preventDefault();
            
  	if(name.trim() =="")
  	{
  		
  		validatepop('Course Name Required','Please Enter Name of Course!');		
	    return false;
  	}
  	else if(description.trim() =="")
  	{

  		validatepop('Course Description Required','Please Enter Description of Course!');  		
  	    return false;
  	}
  	else if(category_id.trim() =="")
  	{
  		validatepop('Course Category Required','Please Select Category of Course!');
  		return false;

  	}
  	else if(teacher_id.trim() =="")
  	{
  		validatepop('Course Teacher Required','Please Select Teacher for Course!');
  		return false;
  	}
  	
  	else
  	 {   
  	 	
  			if(step_access_courses == 0 || chb_free_courses ==1)
  			{  
  				var plan = $('input[name=plan]:checked').val();
  					
  				if( typeof plan !="undefined")
  				{
	  				if(plan=="fixed")
	  				{	

	  				 	 var fixedrate = $("#fixedrate").val();
	  				 	   if(fixedrate.trim() =="")
						  	{	
						  		validatepop('Fixed Rate Required','Please enter Fixed Rate for Course!');
						  		
						  	return false;
						  	}
						  	else if(fixedrate !="")
						  	{	
				  				$("#submit").click();
						  	}
	  				}

	  			   if(plan=="subscription")
	  			   {	  			   		

	  			   		var subscription_default = $('input[name=subscription_default]:radio:checked').val();	  			   		
	  			   		var subscriptions  = new Array();
						$("input[name='subscriptions[]']:checked").each(function() {
						    subscriptions.push($(this).val());
						});
									

	  			   		if(typeof subscription_default=="undefined")
	  			   		{
	  			   			validatepop('Subscription Default Required','Please select Subscription Default for Course!');	
	  			   			return false;
	  			   		}	  			   		
	  			   		else if(subscriptions=="")
	  			   		{	
	  			   			validatepop('Subscription  Required','Please select Subscription for Course!');	
	  			   			return false;
	  			   		}
	  			   		else
	  			   		{
	  			   			var findele = $.inArray(subscription_default,subscriptions);
	  			   				
	  			   				if(findele == -1)
	  			   				{
	  			   					validatepop('Valid Subscription Default Required','Please select Valid Subscription Default for Course!');

	  			   					return false;
	  			   				}
	  			   			var subscription_price = [];
							

								var countArray = subscriptions.length;
								
								for(var i=0; i < countArray; i++)
								{
									

									$('input[name="subscription_price['+subscriptions[i]+']"]').each(function() {
							    		 var ttval = $(this).val();
							    		 if(ttval)
							    		 {
							    		 subscription_price.push(ttval);
							    		 }
							        });
								}
							
							   if(subscriptions.length != subscription_price.length)
							   {
							   	 validatepop('Subscription Price Required','Please enter Subscription Price for Course!');	
	  			   			     return false;
							   }
							
							 //return true;
	  			   		}

	  			   		//for Renewal plan start
	  			   		var renewal_default = $('input[name=renewal_default]:radio:checked').val();	  			   		
	  			   		var renewals  = new Array();
						$("input[name='renewals[]']:checked").each(function() {
						    renewals.push($(this).val());
						});
									
						
	  			   		if(typeof renewal_default=="undefined")
	  			   		{
	  			   			validatepop('Renewals Default Required','Please select Renewals Default for Course!');	
	  			   			return false;
	  			   		}	  			   		
	  			   		else if(renewals=="")
	  			   		{	
	  			   			validatepop('Renewals  Required','Please select Renewals for Course!');	
	  			   			return false;
	  			   		}
	  			   		else
	  			   		{
	  			   			var findele1 = $.inArray(renewal_default,renewals);
	  			   				
	  			   				if(findele1 == -1)
	  			   				{
	  			   					validatepop('Valid Renewals Default Required','Please select Valid Renewals Default for Course!');	
	  			   					return false;
	  			   				}
	  			   			var renewalprice = [];
							

								var countArray = renewals.length;
								
								for(var i=0; i < countArray; i++)
								{
									

									$('input[name="renewalprice['+renewals[i]+']"]').each(function() {
							    		 var ttval = $(this).val();
							    		 if(ttval)
							    		 {
							    		 renewalprice.push(ttval);
							    		 }
							        });
								}
							
							   if(renewals.length != renewalprice.length)
							   {
							   	 validatepop('Renewals Price Required','Please enter Renewals Price for Course!');	
	  			   			     return false;
							   }
							
  				 
			  			
			  			$("#submit").click();
							 // return true;
	  			   		}
	  			   		//for Renewwal plan end

	  			   		
	  			   }

  				}
  				else
  				{
  					validatepop('Choose payment type Required','Please Choose payment type for Course!');
  					return false;


  				}
  			}
  			else
  			{
  				
				$("#submit").click();
  				
  			}
  			 
  	return true;
  		
  	}
  	
  }

  function validatepop(strtitle,strcontent)
  {	  
  	  
  	  var strcontent1 ='<p style="text-align: center;font-weight: 700;font-size: 15px;">'+strcontent+'</p>';
  	
  	$j.alert({
           title: strtitle,
   		  content: strcontent1,
   		 confirm: function()
                   {                        
              
                   }
               });
  }



</script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/[version.number]/[distribution]/translations/[lang].js"></script> -->

  <script src='<?php echo base_url(); ?>public/js/tinymce/tinymce.min.js'></script>
<!--   <script src='<?php echo base_url(); ?>public/js/tinymce/themes/modern/tinymce.min.js'></script>
 -->
  <!--  <script src='<?php echo base_url(); ?>public/js/tinymce/langs/ar.js'></script>
  <script src='<?php echo base_url(); ?>public/js/tinymce/langs/es.js'></script> -->
 <script>

 tinymce.init({ 
 	selector : "#description",
	plugins: [
	"eqneditor advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen ",
	"insertdatetime media table contextmenu paste" ],
	toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
  // language_url : 'langs/ar.js',
    // content_css: "vendor/tinymce/angular-ui-tinymce/skins/lightgray/content.min.css",
    // language: translate.proposedLanguage(),
    image_title: true,
    automatic_uploads: true,
    images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
    file_picker_types: 'image',
     image_advtab: true, 
    file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('#upload').trigger('click');
            $('#upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },

});
//  jQuery(document).on('translateChangeSuccess', function () {
//     if(tinymce!=null){
//         vm.tinymceOptions.language=$translate.proposedLanguage();
//         tinymce.editorManager.editors = [];
//         tinymce.editorManager.createEditor("ui-tinymce-1",vm.tinymceOptions);
//         tinymce.init(vm.tinymceOptions);
//     }
// });
 </script>
 <script type="text/javascript">
 jQuery(document).ready(function(){


jQuery('.plan').click(function(){
	$('#chb_free_courses1').prop('checked', false);
	$('#step_access_courses1').prop('checked', false);
	$('#step_access_courses0').prop('checked', false);

	$('#free_courses').hide();

	$('#Stud_free').hide();

	});

    jQuery('#chb_free_courses1').click(function(){
    	jQuery("#Stud_free").show();
    	    	$("#priceDiv").show();
    	    	$('.sub_rad').prop('checked', false);
    	    	$('.reg_rad').prop('checked', false);
    	jQuery("#free_courses").hide();
    		$('#step_access_courses1').prop('checked', true);

    	jQuery(".Sel_div .grey-background").css("border-radius", "5px 5px 0px 0px")
    	if($('#step_access_courses1[value=1]').is(':checked')) {
    	$("#free_courses").hide();
    	showhidecourse();
    	jQuery("#Stud_free .lightgray_box").css("border-bottom", "1px solid #eee");
    	jQuery("#Stud_free .lightgray_box").css("border-radius", "0px 0px 5px 5px");

	}

    });

    jQuery('#chb_free_courses2').click(function(){
    	$("#Stud_free").hide();
    	$("#free_courses").hide();
    	$("#priceDiv").show();
    	$("#price_subs").show();
    	jQuery(".Sel_div .grey-background").css("border-radius", "5px")
    	// if($('.sub_rad[value=subscription]').is(':checked')) {
    	// alert('yes');	
    	// }

    });


});	
 </script>
  <script>
jQuery(document).ready(function () {
    if(jQuery('.sub_rad[value=subscription]').is(':checked')) {
	$('#free_courses').hide();
	$('#Stud_free').hide();
    	document.getElementById('fixed_rate').style.display = 'none';
    	document.getElementById('one-time').style.display = 'none';
	    document.getElementById('price_subs').style.display = 'block';
	    document.getElementById('subscriptions_tr').style.display = 'table-row';
	    document.getElementById('subscriptions_headtr').style.display = 'table-row';
	    document.getElementById('renewals_tr').style.display = 'table-row'; 
	    document.getElementById('renewals_headtr').style.display = 'table-row'; 
	    	
    }
});
 </script>
 <script>
	jQuery('#precourse').click(function(){
		var rowCount = $('#table_courses_id >tbody >tr').length;
		//alert(rowCount);
		if(rowCount == 2){
			$('#reqid').remove();

		}
	});
	jQuery('#exifiles').click(function(){
		var rowCount = $('#myTable >tbody >tr').length;
		//alert(rowCount);
		if(rowCount == 1){
			$('#exeid').remove();

		}
	});
	jQuery('#newexefile').click(function(){
		var rowCount = $('#myTable >tbody >tr').length;
		//alert(rowCount);
		if(rowCount == 1){
			$('#exeid').remove();

		}
	});

	
</script>
<script type="text/javascript">


	jQuery(document).on('click', '.btn-publish', function(){
		var id = $(this).attr('id');
		if(id == 'publish'){ var msg = " "; }
		else {
			var msg = '<center><h4 style="color:#016ac1;padding:2%;font-weight:bold;">No one will be able to access this course when it will be unpublished.</h4></b></center>';
		}

		jQuery.confirm({
             title: 'Are you sure you want to '+id+' this course?',
             content: msg,
               confirmButton: 'Yes',
               cancelButton: 'No',
             confirm: function(){
             	if(id == 'publish'){

             		$(document).find('#published').val('1');
             		$('#publish_block').hide();
             		$('#unpublish_block').show();
             		console.log('Published');

             	}
             	else{
             		$(document).find('#published').val('0');
             		$('#publish_block').show();
             		$('#unpublish_block').hide();
             		console.log('Unpublished');

             	}

              
             },
             cancel: function(){
             
                return true;
             }
      
         });

	});


</script>
<script>

jQuery(function () {
	var updType = "<?php echo $updType ?>";
	
	

        $('form').on('submit', function (e) {
           e.preventDefault();
          var todo = $('#todolist').val().trim();
            var ele = todo.split('*');
            var todo_arr='';
            if(ele.length >1){
              $.each(ele, function(k, v){
                if(v.trim() !=''){
                  todo_arr = todo_arr +'* '+v;
                // todo_arr.push('* '+v);
                    }
                });
               
            }
            $('#todolist2').val(todo_arr);

        	if(updType =='edit'){
		var url = '<?php echo base_url() ?>admin/programs/edit_course/<?php echo $id;?>';
          var slug = $("#slug").val().trim();
          
          $.ajax({
            type: 'post',
            url: url,
            data: $('#proform').serialize(),
            before: function(){
               
            },
            success: function (response) {
	            if(response!="fail")
	            {
                var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Successfully updated the course.</div>';
			             var note = $(document).find('#message');
			            note.html(str);
			            note.show();
			            note.fadeIn().delay(3000).fadeOut();
            	}
              else
              {
                var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Slug already exists!</div>';
                  var note = $(document).find('#message');
                  note.html(str);
                  note.show();
                  note.fadeIn().delay(3000).fadeOut();
                  $("#slug").focus();
              }
            }
          });

          } else{
    	window.location.href = "<?php echo base_url(); ?>admin/programs/create/";
    }

        });
    

      });
    
function checkdup(id,slug)
{
  $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo base_url();?>admin/programs/check_dup",
        data:{
          id:id,
          slug:slug
        },
        success:function(returndata)
        {
          if(returndata==0)
          {
            $("#avail").html("already exists").css('color','red').fadeIn().delay(3000).fadeOut();;
            return false;
          }
          else
          {
            $("#avail").html("available").css('color','green').fadeIn().delay(3000).fadeOut();
          }
        }
  });
}

function valid_escape()
{
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 || x==45 || x==46 || x==95 || (x >= 65 ) && (x <= 90 ) || (x >= 97 ) && (x <= 122 ))
    {   
        return;
    }else{
      event.preventDefault();
    }
}

function generateQR(id,catid)
{
  $.ajax({
        type:"post",
        cache:false,
        url:"<?php echo base_url();?>admin/programs/generate_QR",
        data:{
          id:id,
          catid:catid
        },
        success:function(returndata)
        {
            $("#qr_image").attr('src','<?php echo base_url();?>public/uploads/programs/qr_code/'+returndata);
            $("#qrlabel").css('display','block');
            $("#qrbtn").css('display','none');
        }
  });
}
</script>


<div class="popup_overlay" style="display: none;"></div>
<div class="new_course_popup" style="display: none;">
    <div class="new_course_popup_header">
        <span class="popup_heading" style="color: #fad839;font-weight: bold;">Note</span>
        <span class="lnr lnr-cross cross_icon" onclick="return close_popup();"></span>
    </div>
    <div class="new_course_select_sec">
        <h4>
          Please <a href="https://zoom.us/signin" target="_blank">login to your Zoom Account</a> to host this meeting. If already logged in, click on next button.
        </h4>
        <a class="btn btn-info pull-right next-link" href="" target="_blank"> Next </a>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    setTimeout(function(){$("#message").html("");},5000);
  });
  function check_zoom(url){
    // alert('Are you logged in to Zoom. if not please login into zoom first and then click next!');
      $('.popup_overlay').show();
      $('.new_course_popup').show();
      $(".next-link").attr('href',url);
  }
  function close_popup(){
      $('.new_course_popup').hide();
      $('.popup_overlay').hide();
  }
</script>