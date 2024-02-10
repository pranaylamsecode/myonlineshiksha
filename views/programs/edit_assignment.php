<?php
$u_data=$this->session->userdata('logged_in');
$maccessarr=$this->session->userdata('maccessarr');

?>
<link rel="stylesheet" type="text/css" href="/public/css/assignment/assignment.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
<script type="text/javascript">
	jQuery(document).ready(
		function()
		{
  			 	 var txt = $('#cname').text();
  			 	 var txt1 = $('#descriptionerror').html();
			   	 var txt2 = $('#category_id_error').html();
			     var txt3 = $('#teacher_id_error').html();
			     
			     	var txt4 = $('#subscription_price_error').html();
			      	var txt5 = $('#subscription_default_error').html();
			       	var txt6 = $('#subscriptions_error').html();
			       	var txt7 = $('#selected_course_error').html();	

			 if(txt.trim() != "" || txt2.trim() != "" || txt3.trim() != "" ) // txt1.trim() != ""  || txt2.trim() != "" || txt3.trim() != ""
			 {
			  //alert(txt1);
				$('#course_detail_tab').find('a').css('background-color','red');
				$('#course_detail_tab').css('color','black');
			  			  
			 }  
			 if(txt4 != "" || txt5 != "" || txt6 != "" || txt7 != "")
			 {
			  //alert(txt);
				$('#course_price_tab').find('a').css('background-color','red');
				$('#course_price_tab').css('color','black');			  			  
			 }  

		});

		
</script>
<style type="text/css">
@media (max-width:767px){
	.assign-mainsec{
		display: inline-block;
		width:100%;
	}
	
}
</style>

<script type="text/javascript">
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

<!--<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">-->

<link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/sprite_frontend.css"> 


<h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>

<script type="text/javascript">

   jQuery(document).ready(function(){

					jQuery('.removeele').click(function(){
			   
					var id = jQuery(this).attr('id');

					id = id.substr(6);

					 jQuery('#tr'+id).remove();

					});

				});  

</script>
<script type="text/javascript">
function removeRow(id) 
{
	jQuery(document).ready(function(){
    
	// alert(clickedId);
    
	// 	var id = jQuery(this).attr("id");
	    //alert(id);
		id = id.substr(6);
	    
		jQuery("#tr"+id).remove();
    
	});
    


}
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



<header>
		 <section class="breadcrumb">
			<div class="container">

			     <span class="page-title">
			       <?php echo (($updType == 'edit')?'Edit Assignment':'Create New Assignment');?>
			     </span>

			     <div class="bread-view">
			           <a href="http://create-online-academy.com/"><i class="entypo-home"></i></a>
			           <span class="ng-hide">/ </span>
			           <a href="#"><?php echo (($updType == 'edit')?'Edit Assignment':'Create New Assignment');?></a>
			       </div>

			</div>
			</section>
</header>


<div class="page-container">
<?php
	$this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?>

<div class="main-content">
	<div class="row">
    
    <div class="sidebar-collapse sb-toggle-left" style="float:left; margin-top:5px; margin-left:20px; margin-bottom:10px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>
<div>
<!--<a> If this is the first course you have creating then you need to create course categories through the "Course Category Manager" And teachers through the "Users and Permissions Manager"</a>-->
</div>

<?php
$attributes = array('class' => 'tform', 'id' => 'proform','onsubmit'=>'return formvalid()');

// echo ($updType == 'create') ? form_open_multipart(base_url().'programs/assignment', $attributes) : form_open_multipart(base_url().'programs/edit_assignment/'.$id, $attributes);
echo ($updType == 'create') ? form_open_multipart(base_url().'programs/assignment', $attributes) : form_open_multipart(base_url().'programs/uploadAssign/'.$id, $attributes);

$validation_errors = validation_errors();

$validationerrors = explode('.',$validation_errors);
?>

<div id="sticky-anchor"></div>
<div id="sticky" style="float:right;">
					
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-success' style='display: none' name='submit'" : "id='submit'  style='display: none' class='btn btn-success' name='submit' ")); ?>
          <?php $sec_id = $this->uri->segment(3);
            $pro_id = $this->uri->segment(4);	
            $course_name = $this->programs_model->getCoursename2($pro_id); ?>

            <?php if ($updType == 'create'): ?>
           
            	<input type="submit" name="redirect" value="redirect" id="redirect" style="display:none;" class="btn btn-success btn-green">
            	<button type="button" class="btn btn-success" onclick="save_assignment('<?php echo $sec_id;  ?>','<?php echo $pro_id;  ?>','<?php echo $course_name->name; ?>','<?php echo $updType; ?>')"> Submit </button>
            	<a href='<?php echo base_url(); ?>programs/lists/<?php echo $page?>/' class='btn btn-danger'>Cancel</a>


			<?php else: ?>
			    <button type="button" class="btn btn-info" id="myBtn" >Preview Assignment</button>
             <img id='loading' style='display:none' src="http://loadinggif.com/images/image-selection/3.gif">
				<button type="button"  id='subtn' class="btn btn-success" onclick="save_assignment('<?php echo $sec_id;  ?>','<?php echo $pro_id;  ?>','<?php echo $course_name->name; ?>','<?php echo $updType; ?>')"> Submit </button>
                <a href='<?php echo base_url(); ?>manage/courses' class='btn btn-danger'>Cancel</a>
					
            <?php endif ?>

        
			<div class="clr"></div>		
</div>

<div class="row assign-mainsec" >
<div class="col-sm-12" style="width:100%;">
<?php if ($updType == 'edit'){ ?>

  <div style="padding-top: 10px;"><a class="link_page top_link_page" style="float: right;" href="<?php echo base_url(); ?>days/index/<?php echo $program->assign_id; ?>" >
  <div class="sprite 2edit tab_icon" style="float:left;background-position: -32px 0;" title="Course Content">
             </div>

  <!-- <div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div> --></a></div>
  <?php } ?>
		<ul class="nav nav-tabs bordered assignmt_main_contnt" ><!-- available classes "bordered", "right-aligned" -->
			<li id="course_detail_tab" class="active">
				<a href="#course_detail" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">Basic Info</span>
				</a>
			</li>

			<li id="course_price_tab">
				<a href="#ps" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Instructions</span>
				</a>
			</li>
			
			<li id="exe_file">
				<a href="#exe_f" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Questions</span>
				</a>
			</li>
 
		</ul>
                
		<div class="tab-content">
        	<div class="tab-pane active" id="course_detail">

<div> 
		<div class="panel panel-primary" data-collapsed="0" style="margin-bottom:0; border: 0;"> 

				
				<div  class="panel-body form-horizontal form-groups-bordered">
                    <?php if($updType == 'create'){

					$legend = 'New Assignment';
 
					}else{

					$legend = 'Edit Assignment'; 

					}?>
					
				<div class="form-group">
						
                        <label class='col-sm-3 control-label' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						
						<div class="col-sm-5">							
                            
                        <input class="form-control" id="name" type="text" name="assign_title" maxlength="256" value="<?php echo set_value('assign_title', (isset($program->assign_title)) ? $program->assign_title : ''); ?>"  title="Enter Assignment Name"  data-validation="required" />	

						<span class="tooltipcontainer">

						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>

						<span class="name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"> </span>

							<?php echo "Enter Assignment title";?>						

						</span>

						</span>

                        <span id="cname" class="error" style="color: red"><?php echo form_error('name'); ?></span>
                            
						</div>
				</div>
                   
                    
                    <!--<div class="form-group">
						<label class='col-sm-3 control-label' for="name"><?php echo 'Alias'; //lang('web_name')?></label>                        
						<div class="col-sm-5">							 
                        <input class="form-control" id="alias" type="text" name="alias" maxlength="256" value="<?php echo set_value('alias', (isset($program->alias)) ? $program->alias : ''); ?>" title="Enter Course alias name which is used as variable for course" />
						<span class="tooltipcontainer">
						<span type="text" id="alias-target" class="tooltipicon" title="Click Here"></span>
						<span class="alias-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<?php echo lang('course_fld_alias');?>
						</span>
						</span>
						</div>
					</div>
                    <br />
                    <div style="clear:both;"></div>-->

                    <!-- new code start here -->
            <div class="form-group" >						
            <label class="col-sm-3 control-label" for="description"><?php echo lang('web_description')?><span class="required">*</span></label>						
			<div class="col-sm-7">
				<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
              	<textarea style="display:none" name="assign_description" data-validation="required"  id="assign_description" class="form-control" rows="6">	</textarea>
                <textarea  name="assign_description1" data-validation="required"  id="description" class="form-control texteditorfield" rows="6"><?php echo ($this->input->post('assign_description')) ? $this->input->post('assign_description') : ((isset($program->assign_description)) ? $program->assign_description : '');?></textarea>
                <input name="image" type="file" id="upload" class="hidden" onchange="">
				<!-- tooltip area -->
				<span class="tooltipcontainer">
				<span type="text" id="description-target" class="tooltipicon" title="Click Here"></span>
				<span class="description-target  tooltargetdiv" style="display: none;" >
				<span class="closetooltip"></span>
				<!--tip containt-->
				<?php echo "Enter Description"; ?>
				<!--/tip containt-->
				</span>
				</span>
				<!-- tooltip area finish -->
                <span id="descriptionerror" class="error" style="color: red"><br/><?php echo form_error('description'); ?></span>
			</div>
		</div>
		<div class="form-group">
				
                <label class='col-sm-3 control-label' for="time"><?php echo "Estimated Duration"; ?></label>
				
				<div class="col-sm-7">							
                    
                <input class="form-control" id="time"  placeholder="Enter duration" name="estimated_time" maxlength="256" value="<?php echo set_value('estimated_time', (isset($program->estimated_time)) ? $program->estimated_time : ''); ?>"  title="Enter Estimated Time"  data-validation="required" />	

				<span class="tooltipcontainer">

				<span type="text" id="time-target" class="tooltipicon" title="Click Here"></span>

				<span class="time-target  tooltargetdiv" style="display: none;" >

				<span class="closetooltip"> </span>

					<?php echo "Enter Estimate duration";?>						

				</span>

				</span>

                <span id="cname" class="error" style="color: red"><?php echo form_error('name'); ?></span>
                    
				</div>
		</div>
		<!-- <textarea id="dummy" class=""></textarea> -->
        <!-- new code end here -->
        <!-- Image sectiom start here-->
       <!--  <div class="form-group"> 
						<label for="field-1" class="col-sm-3 control-label"><b>Upload Image :</b></label> 

						<div class="col-sm-5">	

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
							<input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imgname; ?>" name="imagename" id="imagename"> 
						
							<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
				        
                            <div id="localimage_i">
                                <?php if ($updType == 'edit'){ ?>
                                    <img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ?>" width="150" id="imagname" name="imagename">
                                    <div><a href="<?php echo base_url(); ?>programs/cropcourseimg/<?php echo $this->uri->segment(3);?>/courseedit" class="uploadimage btn btn-success">Upload Image</a></div>
									
                               <?php }else{  ?>
                                     <img title="Click Here" src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg' ?>" width="150" id="imagname" name="imagename">
                                     <div><a href="<?php echo base_url(); ?>programs/cropcourseimg/coursecreate" class="uploadimage btn btn-success">Upload Image</a></div>
									 
									 <input type="hidden" name="cropimage" id="cropimage" value="no_images.jpg" >
                               <?php } ?>
                           </div>
                           <br />
                           <input type="file" name="file_i" id="file_i" class="upload_btn" style="display: none;">
						   </div>

						</div>
					</div> -->
        <!-- Image section end here -->
                    
                   

		<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab1"> 
							<a href="#ps" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div>     

        <div style="clear:both;"></div>  
        </div>
      	</div>   
 	</div>
</div> 

            

            
            
		  
<!-- exercise tab -->
<div class="tab-pane" id="ps">					
<dd sno="05">


	<div class="tab-content">

		<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 
			<div class="panel-heading"> 
				
			<div> 

<div class="panel-body form-horizontal form-groups-bordered">			
			<div style="margin-top: 10px; margin-bottom: 10px;"> 
				
				 <div class="form-group" >						
            <label class="col-sm-3 control-label" for="description"><?php echo "Assignment Instructions :"?><span class="required">*</span></label>						
			<div class="col-sm-7">
				<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
                <textarea style="display:none" name="assign_instruction" data-validation="required"  id="assign_instruction" class="form-control" rows="6">	</textarea>
                <textarea  name="assign_instruction1" data-validation="required"  id="instruction" class="form-control texteditorfield" rows="6"><?php echo ($this->input->post('assign_instruction')) ? $this->input->post('assign_instruction') : ((isset($program->assign_instruction)) ? $program->assign_instruction : '');?></textarea>
                <input name="image" type="file" id="upload" class="hidden" onchange="">
				<!-- tooltip area -->
				<span class="tooltipcontainer">
				<span type="text" id="inst-target" class="tooltipicon" title="Click Here"></span>
				<span class="inst-target  tooltargetdiv" style="display: none;" >
				<span class="closetooltip"></span>
				<!--tip containt-->
				<?php echo "Enter Instructions"; ?>
				<!--/tip containt-->
				</span>
				</span>
				<!-- tooltip area finish -->
                <span id="descriptionerror" class="error" style="color: red"><br/><?php echo form_error('description'); ?></span>
			</div>
		</div> 

			<!-- <div class="seperator"></div> -->
		
			<!-- <a href = "<?php echo base_url(); ?>medias/addmedia/<?php //echo $program->id; ?>" class='<?php echo "fancybox fancybox.iframe";?> btn btn-success'>Select from existing files</a> -->
			<!-- <a  style="margin-left:15px;" href = "<?php echo base_url(); ?>medias/addmedia/<?php //echo $program->id; ?>" class='existingfiles btn btn-success'>Select from existing files</a>
			<a href = "<?php echo base_url(); ?>medias/createexercisefile/<?php //echo $program->id; ?>" class='<?php echo "newexercise";?> btn btn-success'>Add New exercise file </a> -->
			
			<div id="video" style="display: <?php if($program->instruction_videos !=''){ ?> none <?php } else { ?> block <?php } ?>">
			<div class="form-group">
				
                <label class='col-sm-4 control-label' for="time"><h3><?php echo "Have Any Instruction Video?"; ?></h3></label>
			
			<!-- <div class="form-group">	
				<div class="col-sm-8">							
                    
			<a  style="margin-left:15px;" href = "<?php echo base_url(); ?>medias/addmedia2/2/<?php //echo $program->id; ?>" class='existingfiles upload1'>Add From Library</a>
			<a  href = "<?php echo base_url(); ?>medias/createexercisefile_new/2/<?php //echo $program->id; ?>" class='<?php echo "newexercise";?> upload1 '>Upload Video</a>
				<span class="tooltipcontainer">

				<span type="text" id="time-target" class="tooltipicon" title="Click Here"></span>

				<span class="time-target  tooltargetdiv" style="display: none;" >

				<span class="closetooltip"> </span>

					<?php echo "Enter Estimate duration";?>						

				</span>

				</span>

                <span id="cname" class="error" style="color: red"><?php echo form_error('name'); ?></span>
                    
				</div>
		</div> -->

		<div class="col-sm-6">

        <input type="file" name="video" onchange="getfile()"  accept="audio/*,video/*" class="filevideo" data-icon="true" id="filestyle-0"  style="position: absolute; clip: rect(0px 0px 0px 0px);">
        <div class="bootstrap-filestyle input-group">
        	<input type="text" name="Instvideo" id="getname" class="form-control " value=""> 
        	
        	<label for="filestyle-0" class="btn btn-info uploadbutton " >
        		<span class="buttonText">Choose file</span>
        	</label></div>
    	</div>
		</div>
		</div>
		<div class="linkedfile">
		<?php if($updType == 'edit')
		      {
		      //	print_r($program);
			// $m_id = $program->instruction_videos;
			// if($m_id) 
			// { ?>	

			<input type="hidden"  name="Instvideo_prev" id="getname1" class="form-control" value="<?php echo $program->instruction_videos; ?>"> 
			<?php if($program->instruction_videos) 
			{  ?>
			<div id='file_2' class='f2'>
				<h4><b>Instruction Video </b></h4><br>
				<b class='col-sm-4 rowlist'>File Name</b>
				<b class='col-sm-3 rowlist'>Type</b>
				<b class='col-sm-3 rowlist'>Satus</b><hr>
			
			<?php 
			$this->load->model('admin/programs_model');
			 // $media = $this->programs_model->getmd($m_id); ?>
			<span class='col-sm-3 rowlist' id='fname_2'><?php echo $program->instruction_videos; ?></span>
 			<span class='col-sm-3 rowlist'>video</span>
<!-- 			<span class='col-sm-3 rowlist'>Uploaded</span>
            <input type="hidden" value="<?php echo $m_id; ?>_video" name="media_id[]"/>
 -->            
 			<span class='col-sm-3 rowlist' ><div id='message2'>Uploaded</div>
			<div id='progress_video2' class='progress ' style='display:none'><div id='bar_video2' class='progress-bar bg-info progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_video2'></div></div></div></span>
			<input type='submit' id='uploadsubmit2' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>
			<span class='col-sm-1 '>
<!-- 			<button style='margin-left:2%' type='button' class='btn btn-danger' onclick='removeelemnt(this)' id='remove_"+idu+"_video' name='change'>Remove</button>
 -->			<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger' id='close_2_2' onclick='removefile(this)' >X</button>
			</span>
            <!-- <span class='col-sm-4' style='float:right'>
            <a type='button' href ='<?php echo base_url(); ?>medias/addmedia2/2/' 
             onclick='removeelemnt(this)' id='change_<?php echo $m_id; ?>_video' class='btn btn-info existingfiles cboxElement'  name='change'>Change</a>	

        	<button style='margin-left:2%' type='button' class='btn btn-danger' 
            onclick='removeelemnt(this)' id='remove_<?php echo $m_id; ?>_video' name='change'>Remove</button></span> -->
        </div>

          <!-- media_title str += "<span style='width:20%; float:left;'>"+name+"</span>";
           str += "<span style='width:20%; float:left;'>"+title+"</span>";
           str += "<span style='width:20%; float:left;'>"+img_type+"</span>";
           str += "<span style='width:20%; float:left;'>Uploaded</span>"
            str += '<input type="hidden" value="'+idu+'_'+img_type+'" name="media_id[]"/>';
            str += "<span class='col-sm-4' style='float:right'>";
           
            str += "<a type='button' href ='<?php echo base_url(); ?>medias/addmedia2/2/' 
             onclick='removeelemnt(this)' id='change_"+idu+"_video' class='btn btn-info existingfiles cboxElement'  name='change'>Change</a>";
          
            str += "<button style='margin-left:2%' type='button' class='btn btn-danger' 
            onclick='removeelemnt(this)' id='remove_"+idu+"_video' name='change'>Remove</button></span></div><br>"; -->
		<?php }
			// }
	
	
		// $m_idfile = $program->resources_files;
		// 	if($m_idfile) 
		// 	{  ?>
		<input type="hidden"  name="InstResource_prev" id="getnameResource1" class="form-control" value="<?php echo $program->resources_files; ?>"> 
			<?php if($program->resources_files) 
			{  ?>
			<div id='file_1' class='f1'>
				<h4><b>Instruction Resource File </b></h4><br>
<!-- 				<b style='width:20%; float:left;'>Media File</b>
 -->				<b class='col-sm-6 rowlist'>File Name</b>
				<b class='col-sm-3 rowlist'>Type</b>
				<b class='col-sm-3 rowlist'>Satus</b><hr>
			
			<?php 
			$this->load->model('admin/programs_model');
			 //$media = $this->programs_model->getmd($m_idfile);
			?>
<!-- 			<span style='width:20%; float:left;'><?php echo $media->alt_title; ?> </span>
 			<span class='col-sm-6 rowlist'><?php echo $media->media_title; ?> </span>
-->			<span class='col-sm-6 rowlist' id='fname_1'><?php echo $program->resources_files; ?> </span>
			<span class='col-sm-3 rowlist'>File</span>
			<span class='col-sm-3 rowlist'>Uploaded
<!--             <input type="hidden" value="<?php echo $m_idfile; ?>_file" name="media_id[]"/>
 -->            <div id='message'></div>
			<div id='progress_video' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_video' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_video'></div></div></div></span>
			<input type='submit' id='uploadsubmit' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>
         	<span class='col-sm-1' >
			<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger' id='close_1_1' onclick='removefile(this)' >X</button>
          	</span>
           <!--  <span class='col-sm-4' style='float:right'>
            <a type='button' href ='<?php echo base_url(); ?>medias/addmedia2/1/' 
             onclick='removeelemnt(this)' id='change_<?php echo $m_idfile; ?>_file' class='btn btn-info existingfiles cboxElement'  name='change'>Change</a>	

        	<button style='margin-left:2%' type='button' class='btn btn-danger' 
            onclick='removeelemnt(this)' id='remove_<?php echo $m_idfile; ?>_file' name='change'>Remove</button></span>
        --> 
    		</div>

		<?php 
			}
		} ?>	
		
		</div>

           <div id="resources" style="display: <?php if($program->resources_files !=''){ ?> none <?php } else { ?> block <?php } ?>">
           <div class="form-group">
				
                <label class='col-sm-4 control-label' for="time"><h3><?php echo "Have Any Resource File?"; ?></h3></label>
			
			<!-- <div class="form-group">	
				<div class="col-sm-8">							
                    
<a  style="margin-left:15px;" href = "<?php echo base_url(); ?>medias/addmedia2/1/<?php //echo $program->id; ?>" class='existingfiles upload1'>Select From Library</a>
			<a  href = "<?php echo base_url(); ?>medias/createexercisefile_new/1/<?php //echo $program->id; ?>" class='<?php echo "newexercise";?> upload1'>Select File</a>
				<span class="tooltipcontainer">

				<span type="text" id="time-target" class="tooltipicon" title="Click Here"></span>

				<span class="time-target  tooltargetdiv" style="display: none;" >

				<span class="closetooltip"> </span>

					<?php echo "Enter Estimate duration";?>						

				</span>

				</span>

                <span id="cname" class="error" style="color: red"><?php echo form_error('name'); ?></span>
                    
				</div>
		</div> -->
		<div class="col-sm-6">
        <input type="file"  name="src_file" onchange="getfileResource()"  accept="image/*,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/plain,text/html,text/*,.pdf" class="fileResource"  id="filestyle-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
        <div class="bootstrap-filestyle input-group">
        	<input type="text" name="InstResource" id="getnameResource" class="form-control " value=""> 
        	
        	<label for="filestyle-1" class="btn btn-info uploadbutton " >
        		<span class="buttonText">Choose file</span>
        	</label>
        </div>
    </div>
    		</div>
        </div>
			</div> 
		</div> 
<div style="clear:both;"></div>  

<div style="clear:both;"></div>
		<div style="overflow: auto;margin-left:15px;margin-right:15px;margin-top:0%;">
			
			<input id="mediafiles" name="mediafiles" value="<?php echo ($this->input->post('mediafiles') ? $this->input->post('mediafiles') : '')?>" type="hidden">
		</div> 
				

			</div>
		</div>
		<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab4"> 
							<a href="#exe_f" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 
		
	</div>


</dd>
 
                    
<div style="clear:both;"></div>                
</div>
<!-- exercise tab end -->
            
<div class="tab-pane" id="exe_f">					
<dd sno="5">


	<div class="tab-content">

		<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 
			<div class="panel-heading"> 
				<div class="panel-title que_para" style="  float: none;
  text-align: center;"><p>HERE TO ADD ASSIGNMENT QUESTIONS !</p></div> 
			</div> 
			
			<div class="panel-body form-horizontal form-groups-bordered">
				<div class="QuesList">
				<?php if($contents) 
				{	$no = 1; 
					foreach ($contents as $task) 
					{	 ?>
						<div id='Q_<?php echo $no; ?>'  class='Qlist'>
              <label class='form-group col-sm-3 control-label'>Question <?php echo $no; ?> : </label>
            <div class='Qcontent' id='Qcontent_<?php echo $no; ?>' ><?php echo $task->que_text; ?></div>
			   <div class='questiondiv' id='questiondiv_<?php echo $no; ?>' >
						<textarea class='col-sm-5 Quetext'  name='question[]' id='Quetext_<?php echo $no; ?>' style='display:none; width: 40.5%;'><?php echo $task->que_text; ?></textarea></div>
					<input value="<?php echo $task->q_id; ?>" name="qid[]" type="hidden"  >
            <div id='Quefiles_<?php echo $no; ?>'>
            <?php if($task->que_attachment)
            {
             $arr = end(explode('.',  $task->que_attachment));
            	$ext = explode('.', $task->que_attachment);
            	if(isset($ext[1])){
            ?>
            
             <div class='Qfile' id='Qfile_<?php echo $no; ?>' >            
             <div id='attname_<?php echo $no; ?>' style='display:none'><?php echo $task->que_attachment; ?></div>
<!--              <input name='Q_att[]' id='Q_att_<?php echo $no; ?>' style='display:none' value='<?php echo $task->que_attachment; ?>'>
 -->            <button style='float:right; margin-top: -5px; display:none' id='Qremove_<?php echo $no; ?>' type='button' class='btn btn-danger' onclick='remove_Que_file(this)'  >X</button>  
                <?php $fileExtension = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
                      $videoExtension = array('webm', 'mp4', 'ogv', 'mid');

                if(in_array($arr, $fileExtension) >= '1'){  ?>
                <br><img style='width:320px;' src='<?php echo base_url(); ?>public/images/<?php echo $task->que_attachment; ?>' >
                <?php } 

                else if(in_array($arr, $videoExtension) >= '1'){  ?>
                <br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/<?php echo $task->que_attachment; ?>' type='video/mp4'></video></center>

<!--                 <img style='width:250px;' src='<?php echo base_url(); ?>public/images/<?php echo $task->que_attachment; ?>' >
 -->                <?php } 

                else{ ?>
                  <a style='width:250px; word-wrap:break-word;' ><?php echo $task->que_attachment; ?></a>
               <?php } ?>
               </div>
           <br>
            <?php 
        	}	}  
           
           else{  ?>
<!--              <input name='Q_att[]' id='Q_att_<?php echo $no; ?>' style='display:none' value=''>
 -->          <?php } 
              ?>
               </div>

						<div class='ansdiv' id='ansdiv_<?php echo $no; ?>' style='display: <?php if($task->ans_text){ echo "block"; } else { echo "none"; } ?>' >
              <label class='form-group col-sm-3 control-label'>Your Answer : </label>
							<div class='Qanswer' id='Qanswer_<?php echo $no; ?>' style='display: <?php if($task->ans_text){ echo "block"; } else { echo "none"; } ?>' > <?php echo $task->ans_text; ?> </div>
						<textarea class='col-sm-5 Anstext'  name='answer[]' id='Anstext_<?php echo $no; ?>' style='display:none; width: 40.5%;'> <?php echo $task->ans_text; ?> </textarea>
             <div id='ansfiles_<?php echo $no; ?>' >
             <?php if($task->ans_attachment) { 
             $ext = explode('.', $task->ans_attachment);
            	if(isset($ext[1])) {	 ?>
             <button style='float:right; margin-top: 5%;display:none' id='remove_<?php echo $no; ?>' type='button' class='btn btn-danger' onclick='remove_admin_file(this)'  >X</button>
                <div class='Afile' id='Afile_<?php echo $no; ?>'  ><span style='width:250px; word-wrap:break-word;'></span>
                  <div id='admin_ans_att_<?php echo $no; ?>' style='display:none' ><?php echo $task->ans_attachment; ?></div>
<!--                   <input name='ans_att[]' id='ans_att_"+ele_id[1]+"' style='display:none' value='"+name+"'>";
-->
              <?php  
                    $arr = end(explode('.',  $task->ans_attachment));
                  $fileExtension = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
                  $videoExtension = array('webm', 'mp4', 'ogv', 'mid');

                  if (in_array($arr, $fileExtension) >= '1')
                  { ?>
                    <br><img style='width:320px;' src='<?php echo base_url(); ?>public/images/<?php echo $task->ans_attachment; ?>' >
                 <?php }

                 else if(in_array($arr, $videoExtension) >= '1'){  ?>
                <br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/<?php echo $task->ans_attachment; ?>' type='video/mp4'></video></center>
                <?php  } else{ ?>
                    <a style='width:250px; word-wrap:break-word;'><?php echo $task->ans_attachment; ?></a>
               <?php   }  ?>
             
<!--               // str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger' onclick='remove_file(this)' >X</button><br>
 -->           </span></div>

            <?php }    }	?>
            

              <span class='attachment_ans' id='attachment_ans_<?php echo $no; ?>' style='display:none' ><label for='filestyle_<?php echo $no; ?>' class='btn btn-info uploadbutton ' >Add Attachment</label>     
              <input type='file' name='Ans_f' onchange='Ansfile(this)'  class='Ansfile' data-icon='true' id='filestyle_<?php echo $no; ?>'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span>
              <div id='progress_Ansattach_<?php echo $no; ?>' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Ansattach_<?php echo $no; ?>' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Ansattach_<?php echo $no; ?>'></div></div></div></span>
              <div id='ans_att_<?php echo $no; ?>' ><input name='ans_att[]' style='display:none' value=''></div>
         
         
            </div>
            </div>
						
         	
						<div class="btn_grp">
						<button type='button' class='btn btn-info ans' id='Qans_<?php echo $no; ?>_<?php echo $task->q_id; ?>' style='margin-right:1%'  onclick='Addans(this)' ><i class='fa fa-clock-o'>Your Answer</i></button>
						<button type='button' class='btn btn-info Asubmit' id='Asubmit_<?php echo $no; ?>_<?php echo $task->q_id; ?>' style='margin-right:1%; display:none;' onclick='Addans(this)'><i class='fa fa-clock-o'>Save Answer</i></button>
						 
						 <span class='attachment_Que' id='attachment_Que_<?php echo $no; ?>' style='display:none' ><label for='Qfilestyle_<?php echo $no; ?>' class='btn btn-info uploadbutton ' >Add Attachment</label>     
			              <input type='file' name='Que_file' onchange='Que_file_att(this)' class='Que_file' data-icon='true' id='Qfilestyle_<?php echo $no; ?>'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span>
			              <div id='progress_Queattach_<?php echo $no; ?>' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Queattach_<?php echo $no; ?>' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Queattach_<?php echo $no; ?>'></div></div></div></span>
			              <div id='Que_att_<?php echo $no; ?>' ><input name='Que_att[]' style='display:none' value='Qatt'></div>
         
						<button type='button' class='btn btn-success edit' id='Qedit_<?php echo $no; ?>_<?php echo $task->q_id; ?>' style='margin-right:1%' onclick='editQue(this)' ><i class='fa fa-clock-o'>Edit Question</i></button>
						<button type='button' class='btn btn-success submit' id='Qsubmit_<?php echo $no; ?>_<?php echo $task->q_id; ?>' style='margin-right:1%; display:none;' onclick='editQue(this)'><i class='fa fa-clock-o'>Submit Question</i></button>
						<button type='button' class='btn btn-danger delete' id='Qdelete_<?php echo $no; ?>_<?php echo $task->q_id; ?>' style='margin-right:1%' onclick='deleteQue(this)' ><i class='fa fa-clock-o'>Delete</i></button></div></div><hr>
				<?php	$no++;
					}
				} ?>

				</div>

			<div class="form-group" >						
            <label class="col-sm-3 control-label" for="description"><?php echo "Enter Question :"?></label>						
			<div class="col-sm-7">
				<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>

                <textarea  name="assign_qestions" data-validation="required"  id="ques" class="form-control texteditorfield" rows="6"></textarea>
                <input name="image" type="file" id="upload" class="hidden" onchange="">
				<!-- tooltip area -->
				<span class="tooltipcontainer">
				<span type="text" id="inst-target" class="tooltipicon" title="Click Here"></span>
				<span class="inst-target  tooltargetdiv" style="display: none;" >
				<span class="closetooltip"></span>
				<!--tip containt-->
				<?php echo "Enter Instructions"; ?>
				<!--/tip containt-->
				</span>
				</span>
				<!-- tooltip area finish -->
                <span id="descriptionerror" class="error" style="color: red"><br/><?php echo form_error('description'); ?></span>
			 <div class='quefiles'></div>
			 <center><img id='loadque' style='display:none; width:30px;' src="http://loadinggif.com/images/image-selection/3.gif">
      </center>
         <div style='float:right' class="bottom_assgnmt_btn">
          <span class='attachment' >
            <label for="filestyle-2" class="btn btn-info uploadbutton " >
              <span > Add Attachment</span>
            </label>
              <input type="file" name="Que_f" onchange="Quefile()"   class="Quefile" data-icon="true" id="filestyle-2"  style="position: absolute; clip: rect(0px 0px 0px 0px);">
         </span>
          <input type='submit' id='upQattach' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>
              <div id='progress_Qattach' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Qattach' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Qattach'></div></div></div>

          <button type="button" id='btnQ' class="btn btn-success" onclick="QueAdd()"> Submit </button>
        </div>
<!-- 				<button type="button" class="btn btn-warning" onclick="QueAdd()"> Add </button>
 --><!--             	<button type="button" class="btn btn-danger" onclick="QueClear()"> Reset </button>
 -->			</div>
			</div>
			
			            	
		</div> 

			
	</div> 
			
</div>

</dd>
 
                    
<div style="clear:both;"></div>                
</div>


</div>
<?php if ($updType == 'edit'){ ?>
  <div style="padding-top: 10px;"><a class="link_page" style="float: right;" href="<?php echo base_url(); ?>days/index/<?php echo $program->assign_id?>">
  <div class="sprite 2edit tab_icon" style="float:left;background-position: -32px 0;" title="Course Content">
             </div>
  <!-- <div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div> --><span class="crosslink">Go to Course Content</span></a></div>
  <?php } ?>
</div>        

</div>
<!-- Modal -->

  <div class="modal fade in preview" id="myModal" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-head">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h3>Assignment : <span id="title"> </span> </h3>
        </div>
        <div id="start_ass" style="display:inline-block; padding:0%; overflow-y:auto">
          <br>
            <a id="timegiven" ></a>
            <!-- <h4 id="assign_desc"></h4>
            <br> -->
        </div>
        <div id="wrapper" style="display:none"> 
            <div class="modal-header assgnmt_progress">
              <div class="progress_circle">
                <span class='bartext'>Instruction</span><br>
                <span class='baricon'>1</span>
                <span id="bar1" class='progress_bar'></span>
              </div>
              <div class="progress_circle">
                <span class='bartext'>submission</span><br>
                <span class='baricon'>2</span>
              <span id="bar2" class='progress_bar'></span>
              </div>
              <div class="progress_circle">
                <span class='bartext'>Instructor Example</span><br>
                <span class='baricon'>3</span>
              </div>
              <br>
          </div>
          <div class="modal-body assgnmt_body" id="style-1">
        
          <div id="instruct">
            <h3>Assignment Instructions</h3>
            <a id="timegiven" ></a>
           <!--  <input class="btn btn-info" type="button"  value="Next" onclick="show_next('instruct','submission','bar1');">
             --><br>
          </div>

          <div id="submission">
            <div class="assgnmt_grp_btn">
              <h3>Assignment Submission</h3>
              <div class="fixed_btn">
                <!-- <input class="btn btn-info btn1" type="button" value="Previous" onclick="show_prev('instruct','bar1');">
                <input class="btn btn-info btn2" type="button" value="Next" onclick="show_next('submission','instructor_ex','bar2');">
              --> </div>
            </div>
              <p>Submit you work | <span id='status_ass' style='display:none' class='btn-info'> Assignment Submitted</span></p>
          </div>
          
          <div id="instructor_ex">
            <div class="assgnmt_grp_btn">
              <h3>How did you do?</h3>
              <div class="fixed_btn">
               <!--  <input class="btn btn-info btn1" type="button" value="Previous" onclick="show_prev('submission','bar2');">
                <input class="btn btn-success" type="Submit" value="Submit"> -->
              </div>
             </div>
              <p>Compare the instructor's example to your own</p>
                <div id='alertsubmit'><div class="alert alert-info">
                <strong >You haven't submitted your assignment yet!</strong>
                </div></div>
              
            
        </div>
       <!--  </form> -->
      </div>
       </div>
          <div class="modal-footer">
          	<input class="btn btn-info btn2" id="pre2"  style="display:none" type="button" value="Previous" onclick="show_prev('submission','bar2');">
            
            <input  class="btn btn-info btn1"  id="pre1"  style="display:none" type="button" value="Previous" onclick="show_prev('instruct','bar1');">
            <input class="btn btn-info btn2"  id="next2"  style="display:none" type="button" value="Next" onclick="show_next('submission','instructor_ex','bar2');">
           
            <input class="btn btn-info btn2" id="next1" style="display:none" type="button"  value="Next" onclick="show_next('instruct','submission','bar1');">
            
            <button  type="button" id='btn-start' onclick="start_assign()">Start assignment</button>
<!--            <button type="button" class="btn btn-default close" style="float:left">Close</button>
 -->          </div>
       
      </div>
    </div>
  </div>

</div>        

</div>


<script type="text/javascript">
var $j =jQuery.noConflict();
 
  function start_assign()
  { 
    $('#next1').css('display','block');
    $('#pre2').css('display','none');
    $('#btn-start').css('display','none');
    $('#start_ass').css('display','none');
    $('#wrapper').css('display','block');
  }

   // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {

    $('#next1').css('display','none');
    $('#pre1').css('display','none');
    $('#pre2').css('display','none');
    $('#next2').css('display','none');

      $('#instructor_ex').find('#alertsubmit').css('display','block');
        $('#status_ass').css('display','none');
         $('#instrutorsubmitview').hide();
         $('#yoursubmitview').hide();


        modal.style.display = "block";
        var name = $j('#name').val();

      $j('#title').text(name);
		var v_exist = $('.linkedfile').find('div').is('.f2');
		var f_exist = $('.linkedfile').find('div').is('.f1');

      var description =tinymce.get('description').getContent();
      if(description)
      {
        var str = "<div id='descview'>"+description+"<br></div>";
        var isVisible = $('#start_ass').find('div').is('#descview');
         if(isVisible == false)
         {
           $("#start_ass").append(str); 
         }
         else
         {
          $('#start_ass').find('#descview').remove();
          $("#start_ass").append(str);
         }
      }
      else
      {
        $('#start_ass').find('#descview').remove();
      }
      //$('#assign_desc').html($(description).text());

       var time = $j('#time').val();
       if(time){
        $j('#timegiven').text(time+' to complete');
       }
       // instruct content
       var instruction =tinymce.get('instruction').getContent();
       if(instruction)
       {
        var str = "<div id='instview'><br>"+instruction+"</div>";
         var isVisible = $('#instruct').find('div').is('#instview');
         if(isVisible == false)
         {
           $("#instruct").append(str); 
         }
         else
         {
          $('#instruct').find('#instview').remove();
          $("#instruct").append(str);
         }
      }
      else
      {
        $('#instruct').find('#instview').remove();
      }

       // instruct video
       var video = $j('.filevideo').val();
       if(video){
        var video =  video.substring(12);

        var str = "<div id='video11' ><center><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+video+"' type='video/mp4'></video></center><br></div>";
        var isVisible = $('#instruct').find('source').is('#r_video');
         if(isVisible == false)
         {
          $("#instruct").append(str); 
         }
         else{
          $('#instruct').find('#video11').remove();
           $("#instruct").append(str);
         }
        //$j('#r_video').attr('src','<?php echo base_url() ?>public/images/'+video);
       }
          // var texist = $('.linkedfile').find('div').is('#file_2')
          // console.log(texist);

       else if(v_exist == true)
       {
       	var video_1 = $j('#fname_2').text();
       //	 var video_1 =  video_1.substring(12);

        var str = "<div id='video11' ><center><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+video_1+"' type='video/mp4'></video></center><br></div>";
        var isVisible = $('#instruct').find('source').is('#r_video');
         if(isVisible == false)
         {
          $("#instruct").append(str); 
         }
         else{
          $('#instruct').find('#video11').remove();
           $("#instruct").append(str);
         }
       }
       else
       {
        $('#instruct').find('#video11').remove();
       }

       

      
      //instruct resource
       var r_file = $j('.fileResource').val();
       if(r_file)
       {
        // var r_file =  r_file.substring(12);
        // var arr = r_file.split('.');
      //console.log(arr);
      	 var arr =  r_file.substring(r_file.lastIndexOf('.') + 1).toLowerCase();
    
         var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
         var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

          var str = "<div id='srcview'>";
         if ($.inArray(arr.toLowerCase(), fileExtension) >= '1')
         {
            str += "<b>Resource Media</b><br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+r_file+"'></center><br>";         
        //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
        }
        else if($.inArray(arr, videoExtension) >= '1')
        {  
            str += "<b>Resource Media</b><br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+r_file+"' type='video/mp4'></video></center><br>";
        } 
        else{
            str += "<b>Resource Files</b><br><a>"+r_file+"</a>";
        }
          str += "</div>";

          var isVisible = $('#instruct').find('div').is('#srcview');
         if(isVisible == false)
         {
           $("#instruct").append(str); 
         }
         else
         {
          $('#instruct').find('#srcview').remove();
          $("#instruct").append(str);
         }
      }
       else if(f_exist == true)
       {
       	var r_file = $j('#fname_1').text();
       //	 var video_1 =  video_1.substring(12);

        var arr =  r_file.substring(r_file.lastIndexOf('.') + 1).toLowerCase();
    
         var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
         var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

          var str = "<div id='srcview'>";
         if ($.inArray(arr.toLowerCase(), fileExtension) >= '1')
         {
            str += "<b>Resource Media</b><br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+r_file+"'></center><br>";         
        //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
        }
        else if($.inArray(arr, videoExtension) >= '1')
        {  
            str += "<b>Resource Media</b><br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+r_file+"' type='video/mp4'></video></center><br>";
        } 
        else{
            str += "<b>Resource Files</b><br><a>"+r_file+"</a>";
        }
          str += "</div>";

          var isVisible = $('#instruct').find('div').is('#srcview');
         if(isVisible == false)
         {
           $("#instruct").append(str); 
         }
         else
         {
          $('#instruct').find('#srcview').remove();
          $("#instruct").append(str);
         }
       }
      else
      {
        $('#instruct').find('#srcview').remove();
      }

      //ques
      var count =0;
      
      $(".QuesList").find('.Qlist').each(function(){
        count++;
      });
      var str = "<div id='Queview'><b>Questions for this Assignment</b><br>";
      for (var i = 1; i <= count; i++) {
        var Qtext = $j('#Qcontent_'+i).text();
            str += "<b> "+i+".</b> "+Qtext+"<br>";
      };
        str += "<br><br></div>";
      if(count > 0)
      {
         var isVisible = $('#instruct').find('div').is('#Queview');
         if(isVisible == false)
         {
           $("#instruct").append(str); 
         }
         else
         {
          $('#instruct').find('#Queview').remove();
          $("#instruct").append(str);
         }
      }
      else
      {
        $('#instruct').find('#Queview').remove();
      }


      //submission
      var str = "<div id='submitview'><b>Questions for this Assignment</b><br><br>";
      for (var i = 1; i <= count; i++) 
      {
        var Qtext = $j('#Qcontent_'+i).text();
            str += "<b> "+i+".</b> "+Qtext+"<br>";
            str += "<div class='textview' id='textview_"+i+"' >";
            str += "<textarea class='col-sm-5 Ansview'  name='ansview[]' id='ansview_"+i+"' style=' width: 40.5%;' placeholder='Add your submission' ></textarea>";
            str += "</div>";

            str += "<div id='ansfiles_stu_"+i+"' class='col-sm-offset-2' ></div>";
            str += "<span class='attachment_ans_stu' id='attachment_ans_stu_"+i+"'><label for='filestyleStu_"+i+"' class='btn btn-info uploadbutton ' >Add Attachment</label>";      
            str += "<input type='file' name='Ans_stu' onchange='Ansfile_stu(this,event)'  class='Ansfile_stu' data-icon='true' id='filestyleStu_"+i+"'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span>";
            str += "<img id='output_"+i+"'/>";
            str += "<div id='progress_Stuattach_"+i+"' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Stuattach_"+i+"' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Stuattach_"+i+"'></div></div></div>";
            
          
            str += "<div class='subview' id='subview_"+i+"' style='diaplay:none' ></div>";
      };
        str += "<button type='button' class='subconfirm1 btn btn-success'onclick='submit_confirm()' style='float:right' >Submit</button></div>";
      if(count > 0)
      {
         var isVisible = $('#submission').find('div').is('#submitview');
         if(isVisible == false)
         {
           $("#submission").append(str); 
         }
         else
         {
          $('#submission').find('#submitview').remove();
          $("#submission").append(str);
         }

         
        $('.Ansview').redactor({
              focus: true,
               fileUpload: '/file-upload.php',
              imageUpload: window.location.origin+'/tasks/getImage',                 
      });
    
      
    }
      else
      {
        $('#submission').find('#submitview').remove();
      } 



    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        $('#start_ass').css('display','block');
    $('#wrapper').css('display','none');
    $('#btn-start').css('display','block');
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

     function submit_confirm()
    {
      var strcontent1 ='<center><h4 style="padding:5%;">You will no longer be able to edit after you submit.</h4></center>';
      
      $j.confirm({
         title: "Are you sure?",
      content: strcontent1,
        confirmButton: 'submit',
     confirm: function()
                 {  
                  submit_ans();
                 },
     cancel: function()
            {
              return true;
            }
             });
    }

    function submit_ans()
    {
      $('.attachment_ans_stu').hide();
      $('.removeStu').hide();
    	$('#instructor_ex').find('#alertsubmit').css('display','none');

    	  var count =0;
    	   $(".QuesList").find('.Qlist').each(function(){
	        count++;
	      });
    	    var str2 = "<div class='InstructorView' id='instrutorsubmitview' ><br><b>Instructor Examples</b><h4><?php echo $u_name; ?></h4><br>";
        var str = "<div class='InstructorView' id='yoursubmitview' ><br><b>Your Submission</b><br><br>";

      for (var i = 1; i <= count; i++) 
      {

      //$('.Ansview').css('display','none');
        var content = $("#submitview").find("#textview_"+i).find(".redactor-editor").text();
        var Instructcontent= $('#Q_'+i).find('#ansdiv_'+i).find('#Qanswer_'+i).html();
        $('#submitview').find('#subview_'+i).text(content);

        var Qtext = $j('#Qcontent_'+i).text();
            str2 += "<b> "+i+".</b> "+Qtext+"<br>";
            str += "<b> "+i+".</b> "+Qtext+"<br>";

             var attvisible = $(".QuesList").find('#Q_'+i).find('#Qatt_'+i).is(':visible');
            if(attvisible == true)
            { 
              var filename = $(".QuesList").find('.Qlist').find('#Qatt_'+i).find('#attname_'+i).text();
             var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
             var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
              var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];
 
              console.log(filename);
               str2 += "<div id='srcview_"+i+"'>";
               str += "<div id='srcview_stu_"+i+"'>";

               if ($.inArray(arr, fileExtension) >= '1')
              {
                  str2 += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";
                  str += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
              //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
              }
              else if($.inArray(arr, videoExtension) >= '1')
		      {  
		         str2 += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
		         str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
		      } 
              else{
                  str2 += "<br><a>"+filename+"</a></div>";
                  str += "<br><a>"+filename+"</a></div>";
              }
            }


           

             if(Instructcontent)
            {               
              str2 += "<div>"+Instructcontent+"</div><br>";
              var attvisible = $(".QuesList").find('.Qlist').find('#Afile_'+i).is(':visible');
                  if(attvisible == true)
                  {
                    var filename = $(".QuesList").find('.Qlist').find('#Afile_'+i).find('#admin_ans_att_'+i).text();
                   var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                   var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                     var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];
			  
                     str2 += "<div id='srcview_"+i+"'>";
                    
                    if ($.inArray(arr, fileExtension) >= '1')
                    {
                        str2 += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
                    //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                    }
                    else if($.inArray(arr, videoExtension) >= '1')
			      {  
			         str2 += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
			      }
                    else{
                        str2 += "<br><a>"+filename+"</a></div>";
                    }
                  }
            }
             if(content)
            {               
              str += "<div class='subcontent' >"+content+"</div><br>";

              var attvisible = $("#submitview").find('#ansfiles_stu_'+i).find('#Stufile_'+i).is(':visible');
                  if(attvisible == true)
                  {
                    //alert(attvisible);
                    var filename = $("#submitview").find('#ansfiles_stu_'+i).find('#Stufile_'+i).find('#Stu_ans_att_'+i).text();
                   var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                   var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                     var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];
 
                     str += "<div id='stusrc_"+i+"'>";
                    
                    if ($.inArray(arr, fileExtension) >= '1')
                    {
                        str += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
                    //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                    }
                    else if($.inArray(arr, videoExtension) >= '1')
					{  
						str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
					}
                    else{
                        str += "<br><a>"+filename+"</a></div>";
                    }
                  }
            }
      };
      $('#submitview').find('.textview').css('display','none');
      $('#submitview').find('.subview').css('display','block');
      $('#status_ass').css('display','block');


      if(count > 0)
      {
        var isVisible2 = $('#instructor_ex').find('div').is('#instrutorsubmitview');
         if(isVisible2 == false)
         {
           $("#instructor_ex").append(str2); 
         }
         else
         {
          $('#instructor_ex').find('#instrutorsubmitview').remove();
          $("#instructor_ex").append(str2);
         } 

         var isVisible = $('#instructor_ex').find('div').is('#yoursubmitview');

         if(isVisible == false)
         {
            $("#instructor_ex").append(str); 
         }
         else
         {
          $('#instructor_ex').find('#yoursubmitview').remove();
          $("#instructor_ex").append(str);
         }    
      }
      else
      {
        $('#instructor_ex').find('#yoursubmitview').remove();
        $('#instructor_ex').find('#instrutorsubmitview').remove();
      } 
    }
    

</script>
 

<SCRIPT TYPE="text/javascript">
function show_next(id,nextid,bar)
{
	 if(bar == 'bar1')
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','block');
       $('#next2').css('display','block');
  }
  else
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','none');
       $('#next2').css('display','none');
        $('#pre2').css('display','block');
  }

  $('.modal-backdrop.fade.in').remove();
  var ele=document.getElementById(id).getElementsByTagName("input");
  var error=0;
  for(var i=0;i<ele.length;i++)
  {
    if(ele[i].type=="text" && ele[i].value=="")
  {
    error++;
  }
  }
  
  if(error==0)
  {
    document.getElementById("instruct").style.display="none";
    document.getElementById("submission").style.display="none";
    document.getElementById("instructor_ex").style.display="none";
    $("#"+nextid).fadeIn();
    document.getElementById(bar).style.backgroundColor="#2f96b4";
  }
  else
  { 
    alert("Fill All The details");
  }
}

function show_prev(previd,bar)
{
	 if(bar == 'bar1')
  {
     $('#next1').css('display','block');
      $('#pre1').css('display','none');
       $('#next2').css('display','none');
  }
  else
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','block');
       $('#next2').css('display','block');
        $('#pre2').css('display','none');
  }

  $('.modal-backdrop.fade.in').remove();
  document.getElementById("instruct").style.display="none";
  document.getElementById("submission").style.display="none";
  document.getElementById("instructor_ex").style.display="none";
  $("#"+previd).fadeIn();
  document.getElementById(bar).style.backgroundColor="#D8D8D8";
}</SCRIPT>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<!--<script>
	$(function() {
		$( "#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	    $( "#todate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	});
</script>-->

<!-- start tool tip script -->
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script type="text/javascript">
//jQuery(document).ready(function(){
//	jQuery('.tooltipicon').click(function(){
//		
//	var dispdiv = jQuery(this).attr('id');
//	jQuery('.'+dispdiv).css('display','inline-block');
//	});
//	jQuery('.closetooltip').click(function(){
//	jQuery(this).parent().css('display','none');
//	});
//	});

//jQuery(document).ready(function(){
//	jQuery('.tooltipicon').mouseenter(function(){
//		
//	var dispdiv = jQuery(this).attr('id');
//	jQuery('.'+dispdiv).css('display','inline-block');
//	});
//	jQuery('.closetooltip').mouseleave(function(){
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
<!-- end tool tip script -->

<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 

<script type="text/javascript">
	// jQuery(document).ready(
	// 	function()
	// 	{
	// 		//jQuery('#description').redactor();
	// 		jQuery('#description').redactor({
	// 		        focus: true,
	// 		        //imageUpload: window.location.origin+'/admin/widgets/getImage',
	// 		        'plugins': ['fontsize','fontcolor','fontfamily'],  //'video','imagelink'
			      	                
	// 		});

	// 	}
	// );
</script>




<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="showcreateform()">
  Launch demo modal
</button> -->

<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
		<script>
		   var $j = jQuery.noConflict();
			$j(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				
			  //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});			
			$j(".iframe").colorbox({
				iframe:true,
				width:"500px", 
				height:"650px",
				fadeOut:500,
				fixed:true,
				reposition:true,								  
						})

			$j(".existingfiles").colorbox({
				iframe:true,
				width:"700px", 
				height:"100%",
				fadeOut:500,
				//fixed:true,
				reposition:true,								  
						})   
				
			$j(".newexercise").colorbox({
				iframe:true,
				width:"500px", 
				height:"80%",
				fadeOut:500,
				fixed:true,
				reposition:true,								  
						}) 	

			$j(".uploadimage").colorbox({
				iframe:true,
				width:"500px", 
				height:"350px",
				fadeOut:500,
				//fixed:true,
				reposition:true,								  
						})  

			$j(".addcourse").colorbox({
				iframe:true,
				width:"600px", 
				height:"85%",
				fadeOut:500,
				//fixed:true,
				reposition:true,								  
						}) 

			});   
		</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.23/jquery.form-validator.min.js"></script>
<script>
$j(document).ready(function(){
$j.validate({
	errorElementClass:"validateerrorbox",
	errorMessageClass:"validateerror",
	borderColorOnError:"red",
	errorMessagePosition:"top",
	 modules : 'logic',
});  //$('#my-textarea').restrictLength( $('#max-length-element') );

});  
</script>   
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>
   tinymce.init({
   	selector : ".texteditorfield",
	plugins: [
	"eqneditor advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen",
	"insertdatetime media table contextmenu paste" ],
	toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
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

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <!-- <script src="http://malsup.github.com/jquery.form.js"></script> jjjuj -->
    <script src="<?php echo base_url() ?>public/js/form-master/jquery.form.js"></script> 

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script type="text/javascript">
function QueAdd()
{

	var Que =tinymce.get('ques').getContent();
  var name = $('.Quefile').val();
    
 if(name){
      name = name.replace('C:\\fakepath\\', '');
    }
 if(Que.trim() =="")
      {
        validatepop('Assignment Question Required','Please Enter Question!');   
        return false;
      }
  else if(Que)
  {
		$.ajax({
  				//var post_vars = $('#proform').serializeArray();
				       
				        type: "POST",
				        url: " <?php echo base_url()?>programs/insert_assignQue/<?php echo $this->uri->segment(5); ?>",
				        // data: post_vars, 
				        // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
				           data: { ques: Que, que_attachment: name },
				       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
				         beforeSend: function()
			              {
			                $('#loadque').show();
			                $("#btnQ").attr("disabled", true);
			              }, 
			              success: function(msg)
			              {   // console.log(msg);
			              	
			             $('#loadque').hide();
			            $('#btnQ').removeAttr("disabled");

				        	 tinymce.get('ques').setContent(''); 
                  var qf = $('.Quefile').val('');
                   
                   $(".quefiles").find('.Qfile').remove();
                    $('.attachment').css('display','block');

				        	console.log(msg);
				        	var count =0;
    	
  					    	$(".QuesList").find('.Qlist').each(function(){
  					    		count++;
  					    	});
  						
  							var no = count+1 ;  	
  							var str = "<div id='Q_"+no+"'  class='Qlist'><label class='form-group col-sm-3 control-label'>Question "+no+": </label><div class='Qcontent' id='Qcontent_"+no+"' >"+Que+"</div>";
							
                str += "<div class='questiondiv' id='questiondiv_"+no+"' >";
								str += "<textarea class='col-sm-5 Quetext'  name='question_new[]' id='Quetext_"+no+"' style='display:none; width: 40.5%;'>"+Que+"</textarea></div>";
								if(name)
                {
                  str += "<div class='Q_attach col-sm-offset-2' id='Qatt_"+no+"' >";
                 // var att = $('.Quefile').val();
                 //     att = att.substr(12);
                 //     str += "<div id='attname_"+no+"' style='display:none'>"+att+"</div>";
                     // str += "<input name='Q_att[]' id='Q_att_"+no+"' style='display:none' value='"+att+"'>";
                     var arr =  name.substring(name.lastIndexOf('.') + 1).toLowerCase();

                     var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

                      if ($.inArray(arr, fileExtension) >= '1')
                      {
                      str += "<br><img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+name+"' >";
                    }
                    else if($.inArray(arr, videoExtension) >= '1')
					{  
						str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+name+"' type='video/mp4'></video></center><br>";
					}
                    else{
                      str += "<a style='width:250px; word-wrap:break-word;' >"+name+"</a>";
                    }
                
                  str += "</div><br>";
                }
                str += "<div class='ansdiv' id='ansdiv_"+no+"' style='display:none' ><label class='form-group col-sm-3 control-label'>Your Answer : </label><div class='Qanswer' id='Qanswer_"+no+"' style='display:none' > </div>";
                str += "<textarea class='col-sm-5 Anstext'  name='answer_new[]' id='Anstext_"+no+"' style='display:none; width: 40.5%;'> </textarea>";
                          
                str += "<div id='ansfiles_"+no+"' class='col-sm-offset-2' ></div>";
                str += "<span class='attachment_ans' id='attachment_ans_"+no+"'><label for='filestyle_"+no+"' class='btn btn-info uploadbutton ' >Add Attachment</label>";      
                str += "<input type='file' name='Ans_f' onchange='Ansfile(this)'  class='Ansfile' data-icon='true' id='filestyle_"+no+"'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span></div>"
                str +="<div id='progress_Ansattach_"+no+"' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Ansattach_"+no+"' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Ansattach_"+no+"'></div></div></div>";
                str +="<div class='btn_grp'>";
                str += "<button type='button' class='btn btn-info ans' id='Qans_"+no+"_"+msg+"' style='margin-right:1%'  onclick='Addans(this)' ><i class='fa fa-clock-o'>Your Answer</i></button>";
				
				str += "<button type='button' class='btn btn-info Asubmit' id='Asubmit_"+no+"_"+msg+"' style='margin-right:1%; display:none;' onclick='Addans(this)'><i class='fa fa-clock-o'>Save Answer</i></button>";
				str += "<button type='button' class='btn btn-success edit' id='Qedit_"+no+"_"+msg+"' style='margin-right:1%' onclick='editQue(this)' ><i class='fa fa-clock-o'>Edit Question</i></button>";
				str += "<button type='button' class='btn btn-success submit' id='Qsubmit_"+no+"_"+msg+"' style='margin-right:1%; display:none;' onclick='editQue(this)'><i class='fa fa-clock-o'>Submit Question</i></button>";
				str += "<button type='button' class='btn btn-danger delete' id='Qdelete_"+no+"_"+msg+"' style='margin-right:1%' onclick='deleteQue(this)' ><i class='fa fa-clock-o'>Delete</i></button></div></div></div><hr>";
			$(".QuesList").append(str); 
							
				        	
				        }
				    });

		
		

	}
}

function Addans(ele)
{

	var name = $(ele).attr('id');
	var ele_id = name.split('_');
	
	var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('div').is('.mce-tinymce');
	//alert(isVisible);
	if(isVisible == false)
			{
				tinymce.init({
		   	selector : ".Anstext",
			plugins: [
			"eqneditor advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste" ],
			toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
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
       
    // alert('1');
	if($('#Afile_'+ele_id[1]).is(':visible'))
     {
        $('#attachment_ans_'+ele_id[1]).css('display','none');

         if($('#remove_'+ele_id[1]).is(':visible'))
        {
            $('#remove_'+ele_id[1]).css('display','none');
        }
        else
        {
            $('#remove_'+ele_id[1]).css('display','block');
        }

      }
      else{
         $('#attachment_ans_'+ele_id[1]).css('display','block');

      }

      

		$('#Qanswer_'+ele_id[1]).css('display','none');
		$('#Qans_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
		$('#Qedit_'+ele_id[1]+'_'+ele_id[2]).css('display','none');

		$('#Asubmit_'+ele_id[1]+'_'+ele_id[2]).css('display','block');
		 $('#ansdiv_'+ele_id[1]).css('display','block');

		$(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
		$(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('visibility','visible');


	}
	else
	{
		// alert('2');

		var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').is(':visible');
		if(isVisible == true)
		{
			  $('#ansfiles_'+ele_id[1]).find('#remove_'+ele_id[1]).css('display','block');
			//$('#Qanswer_'+ele_id[1]).css('display','block');
			$(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('display','none');
			 $('#Qedit_'+ele_id[1]+'_'+ele_id[2]).css('display','block');
	   		$('#Asubmit_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
	   		// $('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]).html("Edit answer");
			 $('#Qans_'+ele_id[1]+'_'+ele_id[2]).css('display','block');

        $('#attachment_ans_'+ele_id[1]).css('display','none');
	    		var Quetext =tinymce.get('Anstext_'+ele_id[1]).getContent();
	    		if(Quetext)
	    		{
	    			$('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]+'_'+ele_id[2]).html("Edit answer");
	    			$('#Qanswer_'+ele_id[1]).css('display','block');
	    			$('#ansdiv_'+ele_id[1]).css('display','block');
	    			$('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html(Quetext);
	    			$('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Anstext_'+ele_id[1]).text(Quetext);
	    		  var name =  $('#admin_ans_att_'+ele_id[1]).text();
	    				$.ajax({
  				//var post_vars = $('#proform').serializeArray();
				       
				        type: "POST",
				        url: " <?php echo base_url()?>programs/update_assignAns/<?php echo $this->uri->segment(5); ?>/"+ele_id[2],
				        // data: post_vars, 
				        // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
				           data: { ans: Quetext, ans_attachment: name  },
				       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
				        success: function(msg)
				        {  
				        	console.log(msg);
				        	
				        }
				    });
	    		}
	    		else{
	    			$('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]+'_'+ele_id[2]).html("Your answer");
	    			$('#Qanswer_'+ele_id[1]).css('display','none');
	    			$('#ansdiv_'+ele_id[1]).css('display','none');
	    			//tinymce.get('Anstext_'+ele_id[1]).setContent('');
	    			// $('#Q_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html(Quetext);
	    		}

	       if($('#Afile_'+ele_id[1]).is(':visible'))
     	  {
		      if($('#remove_'+ele_id[1]).is(':visible'))
	          {
	              $('#remove_'+ele_id[1]).css('display','none');
	          }
	          else
	          {
	              $('#remove_'+ele_id[1]).css('display','block');
	          }
	      }
	      else{
	      	 $('#remove_'+ele_id[1]).css('display','none');
	      }
	    		
		}
		else{
			// alert('3');

			 //$(this).find('#Qcontent_'+ele_id[1]).html(Quetext);

			//$('#Qanswer_'+ele_id[1]).css('display','none');
       // if($('#remove_'+ele_id[1]).is(':visible'))
       //  {
       //      $('#remove_'+ele_id[1]).css('display','none');
       //  }
       //  else
       //  {
       //      $('#remove_'+ele_id[1]).css('display','block');
       //  }

     if($('#Afile_'+ele_id[1]).is(':visible'))
     {
        $('#attachment_ans_'+ele_id[1]).css('display','none');
         $('#remove_'+ele_id[1]).css('display','block');
      }
      else{
      	 $('#remove_'+ele_id[1]).css('display','none');
         $('#attachment_ans_'+ele_id[1]).css('display','block');
      }

			$(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
			$('#Qedit_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
	   		$('#Asubmit_'+ele_id[1]+'_'+ele_id[2]).css('display','block');
	   		$('#Qans_'+ele_id[1]+'_'+ele_id[2]).css('display','none');

	   		 var Answertext= $('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html();
	   		 if(Answertext)
	    		{
	    			//$('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]).html("Edit answer");
	    			$('#Qanswer_'+ele_id[1]).css('display','none');
	    			$('#ansdiv_'+ele_id[1]).css('display','block');
	    			tinymce.get('Anstext_'+ele_id[1]).setContent(Answertext);
	    			// $('#Q_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html(Quetext);
	    			$('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Anstext_'+ele_id[1]).text(Answertext);
        	}
	    		else{
	    			$('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]+'_'+ele_id[2]).html("Your answer");
	    			//tinymce.get('Anstext_'+ele_id[1]).setContent(Answertext);
	    			$('#Qanswer_'+ele_id[1]).css('display','block');
	    			$('#ansdiv_'+ele_id[1]).css('display','none');
	    		}
	   		 //	alert(Questiontext);

		}
	}
}
function editQue(ele)
{
	// alert($(ele).attr('id'));
	var name = $(ele).attr('id');
	var ele_id = name.split('_');
	 $('#Qcontent_'+ele_id[1]).css('display','none');
	  $('#Qedit_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
	  $('#ans_'+ele_id[1]).css('display','none');
	   $('#Qsubmit_'+ele_id[1]+'_'+ele_id[2]).css('display','block');

	var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('div').is('.mce-tinymce');

			if(isVisible == false)
			{
				tinymce.init({
		   	selector : ".Quetext",
			plugins: [
			"eqneditor advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste" ],
			toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
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
		$('#Qans_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
		$(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
		$(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('visibility','visible');
		//alert('#attachment_Que_'+ele_id[1]);
	if($('#Qfile_'+ele_id[1]).is(':visible'))
     {

        $('#attachment_Que_'+ele_id[1]).css('display','none');

         if($('#Qremove_'+ele_id[1]).is(':visible'))
        {
            $('#Qremove_'+ele_id[1]).css('display','none');
        }
        else
        {
            $('#Qremove_'+ele_id[1]).css('display','block');
        }

      }
      else{
         $('#attachment_Que_'+ele_id[1]).css('display','block');

      }


	}
	else
	{	 
		var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').is(':visible');
		if(isVisible == true)
		{
			
			
			$('#Qcontent_'+ele_id[1]).css('display','block');
			$(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('display','none');
			 $('#Qedit_'+ele_id[1]+'_'+ele_id[2]).css('display','block');
	   		$('#Qsubmit_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
	   		$('#Qans_'+ele_id[1]+'_'+ele_id[2]).css('display','block');

	    		var Quetext =tinymce.get('Quetext_'+ele_id[1]).getContent();
	    		if(Quetext){
					 $('#Q_'+ele_id[1]).find('#Qcontent_'+ele_id[1]).html(Quetext);
					$('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('#Quetext_'+ele_id[1]).text(Quetext);
					 var name =  $('#admin_Que_att_'+ele_id[1]).text();
							$.ajax({
  				//var post_vars = $('#proform').serializeArray();
				       
				        type: "POST",
				        url: " <?php echo base_url()?>programs/update_assignQue/<?php echo $this->uri->segment(5); ?>/"+ele_id[2],
				        // data: post_vars, 
				        // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
				           data: { que: Quetext, que_attachment: name  },
				       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
				        success: function(msg)
				        {  
				        	console.log(msg);
				        	
				        }
				    });
					}
				else{
					validatepop('Question Required ','Question can`t be Blank!' );
					return false;
				}

				$('#attachment_Que_'+ele_id[1]).css('display','none');
			if($('#Qfile_'+ele_id[1]).is(':visible'))
     	  	{
		      if($('#Qremove_'+ele_id[1]).is(':visible'))
	          {
	              $('#Qremove_'+ele_id[1]).css('display','none');
	          }
	          else
	          {
	              $('#Qremove_'+ele_id[1]).css('display','block');
	          }
	      	}
	      else{
	      	 $('#Qremove_'+ele_id[1]).css('display','none');
	      }

		}
		else{
			
			if($('#Qfile_'+ele_id[1]).is(':visible'))
		     {
		        $('#attachment_Que_'+ele_id[1]).css('display','none');
		         $('#Qremove_'+ele_id[1]).css('display','block');
		      }
		      else{
		      	 $('#Qremove_'+ele_id[1]).css('display','none');
		         $('#attachment_Que_'+ele_id[1]).css('display','block');
		      }
					 //$(this).find('#Qcontent_'+ele_id[1]).html(Quetext);

			$('#Qcontent_'+ele_id[1]).css('display','none');
			$('#Qans_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
			$(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
			$('#Qedit_'+ele_id[1]+'_'+ele_id[2]).css('display','none');
	   		$('#Qsubmit_'+ele_id[1]+'_'+ele_id[2]).css('display','block');
	   		 var Questiontext= $('#Q_'+ele_id[1]).find('#Qcontent_'+ele_id[1]).html();
	   		 //	alert(Questiontext);
	   		 if(Questiontext){
		  			 tinymce.get('Quetext_'+ele_id[1]).setContent(Questiontext);
		  			 $('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('#Quetext_'+ele_id[1]).text(Questiontext);
	   		 }
	   		 else{
	   		 	validatepop('Question Required ','Question can`t be Blank!' );
					return false;
	   		 }

		}


	}

}	</script>

 
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
	
	function save_assignment(sid,pid,cname,updType)
	{
		//alert(updType);
		var name = $j('#name').val();
		var description =tinymce.get('description').getContent();
		$('#assign_description').text(description);
		var instruction =tinymce.get('instruction').getContent();
		$('#assign_instruction').text(instruction);
		//var Quetext =tinymce.get('Quetext_1').getContent();
		var Quetions = document.getElementById("Quetext_1");
		// alert(Quetions);
		// var Answer = document.getElementById("Anstext_1").value;
		// alert(Answer);
		
		if(name.trim() =="")
  		{
	  		validatepop('Assignment Name Required','Please Enter Name of Assignment!');		
		    return false;
  		}
  		else if(description.trim() =="")
	  	{
	  		validatepop('Assignment Description Required','Please Enter Description of Assignment!');  		
	  	    return false;
	  	}
	  	else if(instruction.trim() =="")
	  	{
	  		validatepop('Assignment Instruction Required','Please Enter Instruction for Assignment!');  		
	  	    return false;
	  	}
	  	if(!Quetions)
  		{
	  		validatepop('Assignment can not be Blank','Please Fill Assignment Contents!' );		
		    return false;
  		}
  		else
  		{
			 // var post_vars = $('#my-form').serializeArray();
			 // $.ajax({ url: '//site.com/script.php', 
			 // 	method: 'POST', 
			 // 	data: post_vars, 
			 // 	complete: function() 
			 // 	{ 
			 // 		$.ajax({ url: '//site.com/script2.php',
			 // 		 method: 'POST', 
			 // 		 data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }) 
			 // 		}); 
			 // 	} 
			 // });
			if(updType == 'edit')
			{
				//alert(updType);
				$.ajax({
  				//var post_vars = $('#proform').serializeArray();
	       
	        type: "POST",
	        url: " <?php echo base_url()?>programs/assignment_update/"+sid+"/"+pid+"/<?php echo $this->uri->segment(5); ?>",
	        // data: post_vars, 
	        // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
	           data: $("#proform").serialize(),
	       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
	        beforeSend: function()
          {
            $('#loading').show();
            $("#subtn").attr("disabled", true);
          }, 
          success: function(msg)
          {   // console.log(msg);
             $('#loading').hide();
            $('#subtn').removeAttr("disabled");
	        	//alert(msg);
	            if(msg == "success")
	            {
	                $j.alert({
	                	// type: 'error',
	                	
	                 title: "Success",
	               content: '<center><b><h4 style="padding:2%;font-weight:bold;">Assignment Successfully Updated! </h4></b></center>',
	                confirm: function()
	                          {
	                          	
	                       			window.location ="<?php echo base_url();?>sections-manage/"+pid+"/"+cname;
	               	               
	                           }
	                       });

	            } 

	           else
	            {
	                $j.alert({
	                	// type: 'error',
	                	
	                 title: "Error",
	               content: '<center><b><h4 style="padding:2%;">'+msg+' </h4></b></center>',
	                confirm: function()
	                          {
	                       			// window.location ="<?php echo base_url();?>sections-manage/"+pid+"/"+cname;
	                            $('.error').remove();
	                          return true;
	               
	                           }
	                       });

	            }
	            
	        }
	    });
			}

			else {
		
  			$.ajax({
  				//var post_vars = $('#proform').serializeArray();
	       
	        type: "POST",
	        url: " <?php echo base_url()?>programs/assignment_submit/"+sid+"/"+pid,
	        // data: post_vars, 
	        // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
	           data: $("#proform").serialize(),
	       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
	        success: function(msg)
	        {    console.log(msg);
	        	//alert(msg);
	            if(msg == "success")
	            {
	               //  $j.alert({
	               //  	// type: 'error',
	                	
	               //   title: "Success",
	               // content: '<center><b><h4 style="padding:2%;">Assignment Successfully Created! </h4></b></center>',
	               //  confirm: function()
	               //            {
	                          	
	               //         			window.location ="<?php echo base_url();?>sections-manage/"+pid+"/"+cname;
	               	               
	               //             }
	               //         });

	                var strcontent1 ='<center><h4 style="padding:2%;font-weight:bold;">Assignment Successfully Created! </h4></center>';
  
  	$j.alert({
           title: "Success",
   		  content: strcontent1,
   		 confirm: function()
                   {                        
              			window.location ="<?php echo base_url();?>sections-manage/"+pid+"/"+cname;
                   }
               });

	            } 

	           else
	            {
	                $j.alert({
	                	// type: 'error',
	                	
	                 title: "Error",
	               content: '<center><b><h4 style="padding:2%;">'+msg+' </h4></b></center>',
	                confirm: function()
	                          {
	                       			// window.location ="<?php echo base_url();?>sections-manage/"+pid+"/"+cname;
	                            $('.error').remove();
	                          return true;
	               
	                           }
	                       });

	            }
	            
	        }
	    });
  		}
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

 
function deleteQue(ele)
{
	var name = $(ele).attr('id');
	var ele_id = name.split('_');

	var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).is(':visible');
	if(isVisible == true)
	{
			$j.confirm({
                      title: 'Are you sure to delete?',
                       content: ' ',
                