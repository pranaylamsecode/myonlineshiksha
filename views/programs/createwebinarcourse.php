<?php
$u_data=$this->session->userdata('logged_in');
$maccessarr=$this->session->userdata('maccessarr');

// $timezone = new DateTimeZone($configarr[0]['time_zone']);	
		
		$date = new DateTime();		
		// $date->setTimezone($timezone);		
		$currdate1 = $date->format( 'Y-m-d' );					
		$currtime1 = $date->format( 'h:i' );		
		$currdateandtime = $date->format( 'Y-m-d h:ia' );	
?>
<style type="text/css">
.validateerror {
   float: left;
   text-align: center;
   width: 40%;
   margin-left: 235px;
   color: red;
}
.help-block {
   display: block;
   width: 100% !important;
   margin: 0 -165px auto !important;
}
.crosslink{
			margin-left: 7px;
		    font-size: 14px;
		    color: #555;
		    margin-bottom: 3px;
		    font-weight: 600;
		    font-family: arial;
		}
		a .crosslink:hover {
    color: #818da2;
}
/*
.validateerror
{
	float: left;
   width: 50%;
   margin-left: 331px;
   color: red;
}*/
.validateerrorbox
{
	border-color: red !important;
}

.p1 {
  padding-left: 15px;
  width: 100%;
  margin-top:0px;
}
dd {
  margin: 0px !important;
}
div#desc_tr{
  width:100%;
}
.seperator {
  border-bottom: 1px dotted #686c70;
  padding: 0px 0 0 0;
  margin-left: 15px;
  margin-right: 15px;
}
.form-group {
  margin-bottom: 15px;
  display: -webkit-box;
}
.tile_fld {
  background: #EDEEF0;
  padding: 0px 10px 0px 10px;
  border-radius: 5px;
  margin-top: 22px;
  margin-left: 15px;
  margin-bottom: 1%;
  text-align: left!important;
  font-size: 17px;
  color: #000;
  width: auto;
}
.alert-dismissable{
	text-align: center !important;
	width: 50% !important;
    margin-left: 15%;
    opacity: 1;
    transition:opacity 1000ms;
}
.waa{
	opacity: 0;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
    $('#alert1').fadeIn('slow').delay(3000).fadeOut('slow');
//    setTimeout(function(){
//     document.getElementById('alert1').className = 'waa';
// }, 3000);
});
</script>
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
<script type="text/javascript">


function showhidecourse(){

	//var selvalue = document.getElementById("step_access_courses").selectedIndex;
	var selvalue = $('input[name=step_access_courses]:checked').val();
   //alert(selvalue);

	if(selvalue == '0')

	{

	document.getElementById("free_courses").style.display="block";
	document.getElementById("priceDiv").style.display="block";   
	document.getElementById("price_subs").style.display="block";
	$("price_subs").find(".panel-heading").find(".panel-title").css('display','block');
	}else

	{

	document.getElementById("free_courses").style.display="none";
	document.getElementById("priceDiv").style.display="none";
	document.getElementById("price_subs").style.display="none";
	$("price_subs").find(".panel-heading").find(".panel-title").css('display','none');
	}

}

</script>

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

		$.ajax({

		url: '<?php echo base_url(); ?>admin/medias/'+funname+'/'+split1,

			 success: function(msg){

			 if(split0=="publish"){

             ftpfileoptions = '<img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" id="unpublish-'+split1+'" class="unpublish" onclick="publishbutton(\'unpublish-'+split1+'\');">';

		     // $('#tdpublish'+split1).html(ftpfileoptions);

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

<script type="text/javascript">

$(document).ready(function() {

	$(".unpublish, .publish").click(function() {

	  //alert("test");

		var thisid = $(this).attr('id');

		var splitarray = thisid.split('-');

		var split0=splitarray[0];
		//alert(split0);
		var funname = '';

			if(split0=="publish"){

			funname = "unpublish";
			

			}

			else{

			funname = "publish";
			// alert(funname)

			}

		var split1=splitarray[1];

		$.ajax({

		url: '<?php echo base_url(); ?>admin/medias/'+funname+'/'+split1,

			success: function(msg){
				//alert(msg);
				if(split0=="publish"){

			  $('#unpublish-'+split1).show();

			  $('#publish-'+split1).hide();

			  }else{

			  $('#unpublish-'+split1).hide();

			  $('#publish-'+split1).show();

			  }

			}

		});

	});

}); 
</script>

<header>
		 <section class="breadcrumb">
			<div class="container">

			     <span class="page-title">
			       <?php echo (($updType == 'edit')?'Edit Course':'Create New Course');?>
			     </span>

			     <div class="bread-view">
			           <a href="http://create-online-academy.com/"><i class="entypo-home"></i></a>
			           <span class="ng-hide">/ </span>
			           <a href="#"><?php echo (($updType == 'edit')?'Edit Course':'Create New Course');?></a>
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

echo ($updType == 'create') ? form_open_multipart(base_url().'programs/createweb', $attributes) : form_open_multipart(base_url().'programs/editwebinar/'.$id, $attributes);

$validation_errors = validation_errors();

$validationerrors = explode('.',$validation_errors);
?>


<!--<div id="toolbar-box">
	<div class="m" style="float:left;">
    <?php 
	if($updType == 'create')
	{
        $pagetitle = 'New Course';
	}
	else
	{
		$pagetitle = 'Edit Course';
    }
	?>
	<div class="pagetitle"><h2><?php echo $pagetitle;?></h2></div>
	</div>
    
    
</div>-->



<div id="sticky-anchor"></div>
<div id="sticky" style="float:right;">
					
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-success' style='display: none' name='submit'" : "id='submit' style='display: none' class='btn btn-success' name='submit'")); ?>
          
            <?php if ($updType == 'create'): ?>
            	<input type="button" name="redirect" value="redirect" id="redirect" style="display:none;" class="btn btn-success btn-green">
            	<img id='loading' style='display:none' src="http://loadinggif.com/images/image-selection/3.gif">
            	<input type="button"  value="Save Changes " name="submit" class="btn sub_ass btn-success" onclick="save_webinar('1')"> 
<!--             	<input type="submit" value="Save Changes" name="submit" class="btn btn-success"  onclick="return formvalid()"> 
 -->
            	    <?php if ($parent_id != "0"): ?>
<!--             	    	<input type="submit"  value="Save & Back to list" name="save2" class='btn btn-orange btn-blue' onclick="return formvalid()" id="savebtn">
 -->            <img id='loading' style='display:none' src="http://loadinggif.com/images/image-selection/3.gif">
 					<input type="button"  value="Save & Back to list" name="save2" class='btn btn-orange sub_ass' onclick="save_webinar('2')" id="savebtn">
            	    	<input type="button" value="Save And Continue" name="save2" class='btn btn-orange' style="display: none;">
            	    	<a href='<?php echo base_url(); ?>manage/courses' class='btn btn-danger'>Cancel</a>

            	    <?php else: ?>

            	    	 <a href='<?php echo base_url(); ?>programs/lists/<?php echo $page?>/' class='btn btn-danger'>Cancel</a>

            	    <?php endif ?>

			<?php else: ?>

             	    <?php if ($parent_id != "0"): 
             	    $parent_idd = $this->uri->segment(4);	?>
             	    <img id='loading' style='display:none' src="http://loadinggif.com/images/image-selection/3.gif">
             	    	<input type="button" value="Save Changes" name="submit" class="btn sub_ass btn-success" onclick="save_webinar('1','<?php echo $parent_idd;  ?>')"> 
             	    	<input type="button" value="Save & Back to list" name="edit2" class='btn btn-orange sub_ass' onclick="save_webinar('2','<?php echo $parent_idd;  ?>')">
<!--              	    	
<input type="submit" value="Save & Back to list" name="edit2" class='btn btn-orange'>
 -->                		<a href='<?php echo base_url(); ?>manage/courses' class='btn btn-danger'>Cancel</a>


            	    <?php else: ?>

            	    	 <a href='<?php echo base_url(); ?>programs/<?php echo $page?>/' class='btn btn-danger'>Cancel</a>

            	    <?php endif ?>
					
            <?php endif ?>

        
			<div class="clr"></div>	
			
</div>



<div class="row">
<div class="col-sm-12" style="width:100%;">
<?php if ($updType == 'edit'){ ?>
  <div style="padding-top: 10px;"><a class="link_page" style="float: right;" href="<?php echo base_url(); ?>days/index/<?php echo $program ->id?>">
  <div class="sprite 2edit tab_icon" style="float:left;background-position: -32px 0;" title="Course Content">
             </div>

  <!-- <div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div> --></a></div>
  <?php } ?>
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li id="course_detail_tab" class="active">
				<a href="#course_detail" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">Course Info</span>
				</a>
			</li>

            <!-- <li>
				<a href="#image" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Upload Image</span>
				</a>
			</li>
			<li>
				<a href="#exercise" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-mail"></i></span>
					<span class="hidden-xs">Exercise files</span>
				</a>
			</li> -->
			<li id="course_price_tab">
				<a href="#ps" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Pricing / Subscription</span>
				</a>
			</li>
			
			<li id="exe_file">
				<a href="#exe_f" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Webinar Schedule</span>
				</a>
			</li>
			
          
			<?php
				$this->load->config('features_config');
				$webinar = $this->config->item('webinar');				
				
				if($webinar['status']==TRUE)
				{
			?>
            <!-- <li>
				<a href="#webinar" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Webinar Service</span>
				</a>
			</li> -->
			<?php
				}
				
			?>
		</ul>
                
		<div class="tab-content">
        	<div class="tab-pane active" id="course_detail">

<div> 
		<div class="panel panel-primary" data-collapsed="0" style="margin-bottom:0; border: 0;"> 

				
				<div  class="panel-body form-horizontal form-groups-bordered">
                    <?php if($updType == 'create'){

					$legend = 'New Course';
 
					}else{

					$legend = 'Edit Course'; 

					}?>
					
				<div class="form-group">
						
                        <label class='col-sm-3 control-label' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						
						<div class="col-sm-5">							
                            
                        <input class="form-control" id="name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($program->name)) ? $program->name : ''); ?>"  title="Enter Course Name"  data-validation="required" />	

						<span class="tooltipcontainer">

						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>

						<span class="name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"> </span>

							<?php echo lang('course_fld_name');?>						

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
			<div class="col-sm-5" style="width: 40.5%">
				<?php
				//$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
                                <textarea style="display:none" name="description" data-validation="required"  id="description1" class="form-control" rows="6">	</textarea>
                <textarea  name="description1" data-validation="required"  id="description" class="form-control" rows="6"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea>
                <input name="image" type="file" id="upload" class="hidden" onchange="">
				<!-- tooltip area -->
				<span class="tooltipcontainer">
				<span type="text" id="description-target" class="tooltipicon" title="Click Here"></span>
				<span class="description-target  tooltargetdiv" style="display: none;" >
				<span class="closetooltip"></span>
				<!--tip containt-->
				<?php echo lang('course_fld_description');?>
				<!--/tip containt-->
				</span>
				</span>
				<!-- tooltip area finish -->
                <span id="descriptionerror" class="error" style="color: red"><br/><?php echo form_error('description'); ?></span>
			</div>
		</div>
		<!-- <textarea id="dummy" class=""></textarea> -->
        <!-- new code end here -->
        <!-- Image sectiom start here-->
        <div class="form-group"> 
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
					</div>
        <!-- Image section end here -->
        <div class="form-group">
			<label class='col-sm-3 control-label' for='category_id'><?php echo lang('web_category')?><span class="required">*</span></label>
			<div class="col-sm-5">                            
            <select class="form-control" name='category_id' id='category_id' title="Select Course Category,category under which course comes" data-validation="required">
		    <!--	<option value='-1'><?php echo '(0) Top';?></option>   -->
		 	<option value=''>select</option>
			<?php
			foreach ($categories as $category): ?>
			<!--<option value='<?php echo $category->id?>' <?php echo (@$program->catid == $category->id) ? 'selected=selected' : ''  ?>><?php echo $category->name?></option>-->
			<option value="<?php echo $category->id;?>" <?php echo ($this->input->post('category_id') == $category->id) ? "selected=selected" : (isset($category->id)) && @$program->catid == $category->id ? "selected=selected" : '' ?>><?php echo $category->name;?></option>

			<?php endforeach ?>

			</select>

			<span class="tooltipcontainer">

			<span type="text" id="category-target" class="tooltipicon" title="Click Here"></span>

			<span class="category-target  tooltargetdiv" style="display: none;" >

			<span class="closetooltip"></span>

			<!--tip containt-->

			<?php echo lang('course_fld_category');?>

			<!--/tip containt-->

			</span>

			</span>

<!-- tooltip area finish -->

            <span id="category_id_error" class="error" style="color: red"><?php echo form_error('category_id'); ?></span>

            <a href="<?php echo base_url(); ?>programs/createcategory" id="cropcategory" class="iframe btn btn-success" style="margin-top: 5px;">Create New Category</a>
			<!-- <a href="<?php echo base_url(); ?>programs/createcategory" id="cropcategory" class="fancybox fancybox.iframe btn btn-success" style="margin-top: 5px;">Create New Category</a> -->
			</div>
			
		</div>
                   
					
                    <div class="form-group">
						<label class="col-sm-3 control-label">Teacher<span class="required">*</span></label>
						
						<div class="col-sm-5">
						<?php							 
						if($u_data['groupid'] == 4) 
						{
							?>					
	                        <select class="form-control" name='teacher_id' id='teacher_id' title="Select Trainer for current course" onchange="disableAssistant();" data-validation="required">
								<option value=''><?php echo '- select -';?></option>
								<!--<option value='<?php echo $u_data['id']?>' <?php echo (@$program->author == $u_data['id']) ? 'selected' : ''  ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>-->
								<option value="<?php echo $u_data['id']?>" <?php echo ($this->input->post('teacher_id') == $u_data['id']) ? "selected=selected" : (isset($u_data['id'])) && @$program->author == $u_data['id'] ? "selected=selected" : '' ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>
								<?php foreach ($teachers as $teacher): ?>
								<!--<option value='<?php echo $teacher->userid?>' <?php echo (@$program->author == $teacher->userid) ? 'selected' : ''  ?>><?php echo $teacher->fullname?></option>-->
								<option value="<?php echo $teacher->userid;?>" <?php echo ($this->input->post('teacher_id') == $teacher->userid) ? "selected=selected" : (isset($teacher->userid)) && @$program->author == $teacher->userid ? "selected=selected" : '' ?>><?php echo $teacher->fullname;?></option>
								<?php endforeach ?>
							</select>
							<?php 
					    }
					    else
					    {
							
							?>

							<select class="form-control" name='teacher_id' id='teacher_id' title="Select Trainer for current course" onchange="disableAssistant();" data-validation="required">
								<!-- <option value='<?php echo $u_data['id']?>' selected ><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>						 -->
								<option value="<?php echo isset($program->author) ? $program->author : $u_data['id'];?>"><?php echo isset($program->author) ? $this->programs_model->getUserName($program->author) : $u_data['first_name'].' '.$u_data['last_name'];?></option>
								
							</select>
							<?php
	 			        }
						?>
						<span class="tooltipcontainer">

						<span type="text" id="teacher-target" class="tooltipicon" title="Click Here"></span>

						<span class="teacher-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('course_fld_teacher');?>

						</span>

						</span>

                        <span id="teacher_id_error" class="error" style="color: red"><?php echo form_error('teacher_id'); ?></span>
						</div>
						<!-- <a href="<?php echo base_url(); ?>programs/createcategory" id="cropcategory" class="fancybox fancybox.iframe btn btn-success" style="margin-left: 20px;">Add Assistant Teachers</a> -->
					</div>
                    <!-- new field add for assistant teacher -->

                    <?php							 
						// if($u_data['groupid'] == 4) 
						// {
                  	 if(isset($program->introtext)){
                  	 	//echo $program->introtext;
               		  $assistantid = explode('|',$program->introtext);

                		 }
							?>
                    <div class="form-group" style="display:<?php  echo  (isset($program->introtext) && in_array($u_data['id'],$assistantid))?'none':'block'; ?>">
						<label class="col-sm-3 control-label">Assistant Teachers:</label>
						
						<div class="col-sm-5">
							
                   					
	                        <select class="form-control" name='assistant_id[]' id='assistant_id' title="Select Trainer for current course" multiple="multiple">
								<option value=''><?php echo '- select -';?></option>
								
								<!-- <option value="<?php echo $u_data['id']?>" <?php echo isset($program->introtext) && in_array($u_data['id'],$assistantid)? "selected" :""; ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option> -->
								<?php foreach ($teachers as $teacher): 
									if($u_data['id']!=$teacher->userid || in_array($u_data['id'],$assistantid)){
								?>
								 
								<option value="<?php echo $teacher->userid;?>"<?php echo isset($program->introtext) && in_array($teacher->userid,$assistantid) ? "selected":""; ?>><?php echo $teacher->fullname;?></option>
								<?php }  endforeach ?>
							</select>
							<?php 
					    //}					    
							?>

						<span class="tooltipcontainer">

						<span type="text" id="asst-teacher-target" class="tooltipicon" title="Click Here"></span>

						<span class="asst-teacher-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>					

						<?php echo 'Select Assistant Teachers'; //echo lang('course_fld_level');?>					

						</span>

						</span>


						</div>
					</div>
                    <!-- new field for assistant teacher end here -->
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Level:</label>
						
						<div class="col-sm-5">
							
                    <select name="level" id="level" title="Select Course Level" class="form-control">

							<option value="0" <?php echo ($this->input->post('level') == '0') ? "selected=selected" : (isset($program->level) && $program->level == '0') ? "selected=selected" : ''?>>Beginners</option>

							<option value="1" <?php echo ($this->input->post('level') == '1') ? "selected=selected" : (isset($program->level) && $program->level == '1') ? "selected=selected" : ''?>>Intermediate</option>

							<option value="2" <?php echo ($this->input->post('level') == '2') ? "selected=selected" : (isset($program->level) && $program->level == '2') ? "selected=selected" : ''?>>Advanced</option>
					</select>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="level-target" class="tooltipicon" title="Click Here"></span>

						<span class="level-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_level');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>
                   
                    
                    <!-- <div class="form-group">
                    <label class="col-sm-3 control-label">Skip Section pages ? :</label>
					<div class="col-sm-offset-3 col-sm-5" style="margin-left:0;">
							
                <?php

                $skip_module = (isset($program->skip_module)) ? $program->skip_module : '';

                $skipmod = ($this->input->post('skip_module')) ? $this->input->post('skip_module') : '';

                $skipmodule1 =  ($skipmod == '1') ? 'checked="checked"': '';

                $skipmodule2 =  ($skipmod == '0') ? 'checked="checked"': '';

                ?>                

                    <div class="radio" title="Hide Section Page(Section Summary) of Lecture">
                    <input value="1" <?php echo ($skip_module == '1') ? 'checked="checked"' : $skipmodule1 ?> name="skip_module" type="radio">
                    &nbsp;Yes&nbsp;
                    </div>

                    <div class="radio" title="Show Section Page(Section Summary) of Lecture">
                    <input value="0" <?php echo ($skip_module == '0') ? 'checked="checked"' : $skipmodule2 ?> name="skip_module" type="radio">
                    &nbsp;No
                    </div>



						<span class="tooltipcontainer">

						<span type="text" id="skip_module-target" class="tooltipicon" title="Click Here"></span>

						<span class="skip_module-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('course_fld_skip-section-pages');?>

						

						</span>

						</span>


						</div>
					</div> -->
                   
                    
                    
                   
                 
                    <!--<div style="clear:both;"></div>
					
                    <div class="form-group" style="display:none;" id="lessons_release_td">
						<label class="col-sm-3 control-label">Lesson release :</label>
						
						<div class="col-sm-5">
							
                        <select class="form-control" onchange="javascript:alertfunction()" name="lesson_release" id="lesson_release">

						<option value="0" <?php echo ($this->input->post('lesson_release') == '0') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '0' ? 'selected="selected"' : '' ?>>All at once</option>

						<option value="1" <?php echo ($this->input->post('lesson_release') == '1') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '1' ? 'selected="selected"' : '' ?>>One lesson per day</option>

						<option value="2" <?php echo ($this->input->post('lesson_release') == '2') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '2' ? 'selected="selected"' : ''?>>One lesson per week</option>

						<option value="3" <?php echo ($this->input->post('lesson_release') == '3') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '3' ? 'selected="selected"' :'' ?>>One lesson per month</option>

						</select>
						</div>
					</div>
                    <br />
                 
                    <div style="clear:both;"></div>
                    
                    <div class="form-group" style="display:none;" id="lessons_show_td">
						<label class="col-sm-3 control-label">Lessons that are't released should show as :</label>
						
						<div class="col-sm-5">
							
                        <select class="form-control" name="lessons_show" id="lessons_show">

                        <option value="1" <?php echo ($this->input->post('lessons_show') == '1') ? "selected=selected" : (isset($program->lessons_show)) && $program->lessons_show == '1' ? "selected=selected" : ''?>>Grayed out text</option>

                        <option value="2" <?php echo ($this->input->post('lessons_show') == '2') ? "selected=selected" : (isset($program->lessons_show)) && $program->lessons_show == '2' ? "selected=selected" : ''?>>Should not show</option>

						</select>
						</div>
					</div>-->
                 
                
                    
                    
                
                  
                    
                    
                
                     
<!-- new code end here -->

        <!-- <div class="form-group">						
            <label class="col-sm-3 control-label" for="description"><?php echo lang('web_description')?><span class="required">*</span></label>						
			<div class="col-sm-5">
				<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
                <textarea  name="description" id="description" class="form-control" rows="6"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea>
				
				<span class="tooltipcontainer">
				<span type="text" id="description-target" class="tooltipicon" title="Click Here"></span>
				<span class="description-target  tooltargetdiv" style="display: none;" >
				<span class="closetooltip"></span>
				
				<?php echo lang('course_fld_description');?>
				
				</span>
				</span>
				
                <span class="error" style="color: red"><br/><?php echo form_error('description'); ?></span>
			</div>
		</div>  -->   

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

            
            
<div class="tab-pane" id="image">
					
<dd class="" sno="3">

					<div class="tab-content">

				
		
				<div class="panel panel-primary" data-collapsed="0" style="margin-bottom:0; border: 0;"> 

				
				<div  class="panel-body form-horizontal form-groups-bordered">
					<!-- <div class="form-group"> 
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

					<!-- <div class="form-group"> 
						
						<div class="col-sm-offset-3 col-sm-5" id="nexttab2"> 
							<a href="#exercise" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
						 
					</div> -->  
				</div>


                      
				</div>
				 

</div>
</dd>
</div>
            
            
<div class="tab-pane" id="exercise">					
<dd class="" sno="4">
	<div class="tab-content">



	

		<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab3"> 
							<a href="#ps" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div>  
	</div>

</dd>
</div>			  
<!-- exercise tab -->
<div class="tab-pane" id="exe_f">					
<dd sno="05">


	<div class="tab-content">

		<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 

		<div class="panel-heading"> 
			
			<div style="margin-top: 10px; margin-bottom: 10px;"> 
			<!-- <div class="seperator"></div> -->
		<legend class="tile_fld">Webinar for Logistics Assem</legend>
			
		 </div> <?php // $gmtime = gmdate("h:i");
		// 	 $gmdate = gmdate("Y-m-d"); ?>
		<div style="overflow: auto;margin-left:15px;margin-right:15px;">

			 <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Starts On'?> <span class="required">*</span></label> 
       <?php if($updType == 'edit' ){ ?><input type="hidden" name="webid" value="<?php echo $webinars->id; ?>"> 
       <input type="hidden" name="class_id" value="<?php echo $webinars->wiziq_class_id; ?>"> <?php } ?>              

      <div class="col-sm-5"> 
      <div class="col-md-3" style="float:left; padding: 0;"> 
                       <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php echo set_value('fromdate', (isset($webinars->fromdate)) ? $webinars->fromdate :  $currdate1); ?>"  />  
                       <!-- <?php echo date("m-d-Y"); ?> -->
                       <!-- <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php echo date("m-d-Y"); ?>"  /> -->  
                     </div> 
                    
                    <div class="col-sm-2" style="float:left;"> 
                    	<input name="fromtime11" id="fromtime11" type="hidden"> 
        <input type="time" name="fromtime" id="fromtime" value="<?php if($updType=='create'){echo $currtime1;} else{ echo set_value('fromtime', (isset($webinars->fromtime)) ? $webinars->fromtime : ''); }?>">
                        
<span>GMT</span>

</div>
<!-- tooltip area -->

            <span class="tooltipcontainer">

            <span type="text" id="fromdate-target" class="tooltipicon"></span>

            <span class="fromdate-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            <!--tip containt-->

            <?php echo lang('webinar_fld_fromdate');?>

                         <!--/tip containt-->

            </span>

            </span>

<!-- tooltip area finish -->

          
                    <span class="error"><?php echo form_error('fromdate'); ?></span><span class="error"><?php echo form_error('fromtime'); ?></span> 

      </div> 
    </div>
    <!--  -->
     <div class="form-group"> 
      <label class="col-sm-3 control-label">
        Duration<span class="required">*</span>
      </label>
      <div class="col-sm-5">

        <div class="col-md-3" style="float:left; padding: 0;"> 
        <input type="number" placeholder="Ex.30" value="<?php if($updType=='create'){echo '30';} else{ echo set_value('web_duration', (isset($webinars->web_duration)) ? $webinars->web_duration : ''); }?>" id="web_duration" name="web_duration"> (Enter duration between 30 to 300 minutes.)
        </div>
        </div>
    </div>
<!--  -->
	 <div class="form-group"> 
	      <label class="col-sm-3 control-label">
	        Attendees Limit
	      </label>
	      <div class="col-sm-5">

	        <div class="col-md-3" style="float:left; padding: 0;"> 
	        <input type="number" placeholder="No limit" value="<?php if($updType=='create'){echo '';} else{ echo set_value('attendees_limit', (isset($webinars->attendees_limit)) ? $webinars->attendees_limit : ''); }?>" id="attendees_limit" name="attendees_limit"> 
	        </div>
	        </div>
	    </div>
		</div> 
			</div>
		
	</div>
</div>

</dd>
 
                    
<div style="clear:both;"></div>                
</div>
<!-- exercise tab end -->
            
<div class="tab-pane" id="ps">					
<dd sno="5">


	<div class="tab-content">

		<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 
			<div class="panel-heading"> 
				<div class="panel-title" style="  float: none;
  text-align: center;"><p> <!-- Through this option you can choose to make the course free for all students/free for some students and Paid for other /paid for all. -->You can set fixed price, subscription plans or set it free.</p></div> 
			</div> 
			
			<div class="panel-body form-horizontal form-groups-bordered"> 

			<div class="form-group"> 
				
				<!-- 	<label style="margin-top:5px;" for="field-1"> 

         <input  style="margin-top:-2px; margin-right:5px;" id="chb_free_courses" name="chb_free_courses" type="checkbox" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : '';?> ><span>This course is free for students</span></label>  -->

				<div class="col-sm-offset-3 col-sm-5" > 
				<div class="col-sm-12 Sel_div" >
				<div class="grey-background">
					Is this course FREE for Students ?
                <span class="radio_btn dark_label">
               <?php if($updType == 'create'){?>
                 <input type="radio" id="chb_free_courses1" name="chb_free_courses" value="0"> Yes
                &nbsp;
  				<input type="radio" id="chb_free_courses2" name="chb_free_courses" value="1" checked> No </span>
  				<?php } 
  				else{ ?>
  				<span class="radio_btn dark_label">

	  				<input type="radio" id="chb_free_courses1" name="chb_free_courses" value="0" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '0' ? "checked" : '';?>> Yes
	               &nbsp;
	  				<input type="radio" id="chb_free_courses2" name="chb_free_courses" value="1"<?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : '';?> > No </span>

  				<?php } ?>
  				</div>
  			</div>
  				<div class="col-sm-12" id="Stud_free" style="display: none;">
  				<p>You want to make this course FREE to all students or to students for particular course(s).
				</p>
					<!-- <select class="form-control" id="step_access_courses" name="step_access_courses" onchange="javascript:showhidecourse(this.value);">

				      <option value="0" <?php echo ($this->input->post('step_access_courses') == '0') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "selected" : ''; ?>>Students</option>

				     <option value="1" <?php echo ($this->input->post('step_access_courses') == '1') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "selected" : ''; ?>>All Students</option>

				 	</select> -->
				 	<?php if($updType == 'create'){ ?>
               <span class="col-sm-6 dark_label" >

				 <input type="radio" id="step_access_courses1" name="step_access_courses" value="1" onclick="javascript:showhidecourse(this.value);" checked > Free to All Students 
				 </span>
				 <span class="col-sm-6 dark_label" >
                <input type="radio" id="step_access_courses0" name="step_access_courses" value="0" onclick="javascript:showhidecourse(this.value);" > Free to Students of Selected Course(s)  				
               </span>
               <?php } else { ?>
               <span class="col-sm-6 dark_label">

				 <input type="radio" id="step_access_courses1" name="step_access_courses" value="1" onclick="javascript:showhidecourse(this.value);" <?php echo (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "checked" : ''; ?>> Free to All Students 
				 </span>
				 <span class="col-sm-6 dark_label">
                <input type="radio" id="step_access_courses0" name="step_access_courses" value="0" onclick="javascript:showhidecourse(this.value);" <?php echo (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "checked" : ''; ?>> Free to Students of Selected Course(s)  				
               </span>
              <?php } ?>
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

           <!-- <div style="display: <?php echo $show_div; ?>;" id="free_courses" class="form-group"> --> 
           <div style="display: none;" id="free_courses" class="col-sm-12 form-group">
				<div for="field-1" class="col-sm-3 control-label"><p>You want to make this course FREE to all students or to students for particular course(s).</p></div> 
				
				<div class="col-sm-5"> 

					<!--<select name="selected_course[]" id="selected_course[]" multiple="multiple">-->
			<select class="form-control" name="selected_course[]" id="selected_course" multiple="multiple" >

              <!-- <option value="-1" <?php if($this->input->post('step_access_courses') == '-1' || isset($program->chb_free_courses) && $program->selected_course == '-1') echo "selected";?>>Any Course</option> -->

              <?php

               foreach($courses as $course){

                if(isset($program->selected_course)){

                $coursesid = explode('|',$program->selected_course);

                 }

                if(!isset($program->id) || ($course['id'] != $program->id)){ ?>

                 <option value="<?php echo $course['id']; ?>" <?php if(isset($program->chb_free_courses) && $program->selected_course == $course['id'] || isset($program->selected_course) &&in_array($course['id'],$coursesid)) echo "selected"?>>

                   <?php echo $course['name'];   ?>

                 </option>

                 <?php }

                }

               ?>

            </select>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="selected_course-target" class="tooltipicon" title="Click Here"></span>

						<span class="selected_course-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_course-free-student');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
				</div> 
			</div>
			  <span id="selected_course_error" class="error"><?php echo form_error('selected_course'); ?></span>

        <?php }

        ?>

			




			<div id="priceDiv" class="form-group" style="display:<?php echo (isset($program->step_access_courses) && $program->step_access_courses == '1') ? 'none':'block'; ?>"> 
				<label for="field-1" class="col-sm-3 control-label">Pricing Mode for this course :</label> 
				
				<div class="col-sm-5"> 
					<div class="radio"> 
						<label><input type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan" <?php if(@$program->fixedrate > 0.00) echo 'checked';else if($updType == 'create')echo 'checked'; ?> value="fixed"/>Regular Based</label> 
						<p>(Students will make one time payment for the course)</p>
					</div> 
					<div class="radio"> 
						<label><input type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan" <?php if(@$countplans) echo 'checked';  ?> value="subscription" />Subscription Based</label>
						<p>(Students will subscribe to subscription plan by paying the respective Subscription plan price)</p> 
					</div> 
					<?php
				if($u_data['groupid'] == 5)
				{
			  ?>
			  <!--<label>(Share between Trainer and Institute will be 85% and 15% respectively.)</label>-->
			  <?php
			    }
			  ?>
				</div>  
			</div>
			</div> 



<fieldset class="adminform" id="price_subs" style="<?php if(@$program->fixedrate > 0.00 || isset($countplans)) { echo 'display:block'; } else { echo 'display:none'; } ?>">
			<div class="panel-heading">
				<div id="Subscriptionspaneltitle" class="panel-title" style="padding-bottom: 0px;float: none;text-align: center;<?php echo (isset($program->step_access_courses) && $program->step_access_courses == '1') ? 'display:none;':'display:block;'; ?>">	
					<h3 style="margin-top: 0; margin-bottom:0;">Pricing / Subscriptions</h3>
				</div>
				
			</div>
			<hr style="margin-bottom: 0; margin-top: 5px;">

			<div class="panel-body form-horizontal form-groups-bordered"> 
			
			<div class="form-group" id="fixed_rate" style="<?php if(@$program->fixedrate > 0.00) { echo 'display:block'; } else { echo 'display:none'; } ?>">
                <label for="field-1" class="col-sm-3 control-label">For Fixed Rate :</label>
                <div class="col-sm-5">
                  <input type='text' name='fixedrate' class='form-control' id='fixedrate' value="<?php echo (isset($program->fixedrate)) ? $program->fixedrate : '' ?>" onkeypress="return isNumberKey(event)">
                	<p> (Amount to be set for the course fees.Enter only numerics and the fees will be display in the currency you have set.)</p>
                </div>
                
            </div>

			</div>


			<div class="panel-body with-table">
				
				 <table class="table table-bordered table-responsive">

          	<tbody>
			 
            <tr id="subscriptions_headtr" style="display:none;">

                <td style="font-size:1.2em;font-weight:bold;padding:0.5em;">

                	<div style="float:left;">

						Subscriptions plans&nbsp;

                    </div>

                    <div style="float:left;">

                    </div>

				</td>

            </tr>
			
			

            <tr id="subscriptions_tr" style="<?php if(@$countplans) { echo 'display:table-row'; } else { echo 'display:none'; } ?>">

                <td>
                    <table id="subscriptions" class='table table-bordered'><tbody>

                       <tr style="background:#F5F5F6">

							<th style="padding:0.5em;" width="1%">Default</th>

                            <th style="padding:0.5em;" width="1%"><input onclick='checkPlans("subscriptions");' value="" name="splains" id="splains" type="checkbox"></th>

                            <th style="padding:0.5em;">Name</th>

                            <th style="padding:0.5em;">Terms</th>

                            <th style="padding:0.5em;">Price</th>



                        </tr>

                       <tr>

                            <td colspan="5">

                                    <span id="subscription_default_error" class="error"><?php echo form_error('subscription_default'); ?></span>

                                    <span id="subscriptions_error" class="error"><?php echo form_error('subscriptions'); ?></span>

                            </td>

                        </tr>

                        <?php if ($plans):

                         ?>

                        <?php $i=0;?>

                        <?php foreach ($plans as $plan):

                        ?>

                        <tr>

                           <td style="padding:0.5em;">

                            <?php //($this->input->post('subscription_default') ? "checked" : isset($plan->default) && $plan->default == '1') ? "checked" : ''; ?>

                            <input value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('subscription_default') == $plan->plid) ? "checked" : isset($plan->default) && $plan->default == '1' ? "checked" : '';?> name="subscription_default" id="subscription_default" type="radio">



                            </td>

                           <td style="padding:0.5em;">



                           <input name="subscriptions[]" id="subscriptions<?php echo $plan->plid; ?>" class="plain" type="checkbox" value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('subscriptions') && in_array($plan->plid,$this->input->post('subscriptions')) == '1') ? "checked" : (isset($plan->plan_id)) ? "checked" : ''?>>



                           </td>

                           <td style="padding:0.5em;"><?php echo $plan->name ?></td>

                           <td style="padding:0.5em;"><?php echo $plan->term.' '.$plan->period ?></td><td style="padding:0.5em;">

                           <?php

                             $price = $this->input->post('subscription_price');

                             $plan_price = (isset($plan->price)) ? $plan->price : '';

                             $plinid=$plan->plid;

                           ?>

                            <input name="subscription_price[<?php echo $plan->plid ?>]" type="text" value="<?php echo ($price) ? $price[$plan->plid] : $plan_price ?>" onkeypress="return isNumberKey(event)">

                            <span id="subscription_price_error" class="error"><?php echo form_error("subscription_price[$plinid]"); ?></span>

                            </td>

                        </tr>

                      	<?php endforeach ?>

                        <?php else: ?>

	                    <p class='text'><?=lang('web_no_elements');?></p>

                        <?php endif ?>

            		</table>
            	</td>

            </tr>

            <tr id="renewals_headtr" style="<?php if(@$countplans) { echo 'display:table-row'; } else { echo 'display:none'; } ?>">

                <td style="font-size:1.2em;font-weight:bold;padding:0.5em;">

                	<div style="float:left;">

						Renewal plans&nbsp;

                    </div>
                </td>

            </tr>
             
            <tr id="renewals_tr" style="<?php if(@$countplans) { echo 'display:table-row'; } else { echo 'display:none'; } ?>">

                <td>

                    <table id="renewals" class="table table-bordered"><tbody>

                        <tr style="background:#F5F5F6">

							<th style="padding:0.5em;" width="1%">Default</th>

                            <th style="padding:0.5em;" width="1%"><input onclick='checkPlans("renewals");' value="" name="splains" id="splains" type="checkbox"></th>

                            <th style="padding:0.5em;">Name</th>

                            <th style="padding:0.5em;">Terms</th>

                            <th style="padding:0.5em;">Price</th>

                        </tr>

                        <?php //print_r($program); ?>

                        <?php if ($renewalplans):

                         ?>

                        <?php $i=0;?>

                        <?php foreach ($renewalplans as $plan):



                        ?>

                        <tr>

                            <td style="padding:0.5em;">



                            <input value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('renewal_default') == $plan->plid) ? "checked" : isset($plan->default) && $plan->default == '1' ? "checked" : '';?> name="renewal_default" type="radio">



                           <!--<input value="<?php //echo $plan->plid ?>"   -->

                           <?php //if(isset($plan->default) && $plan->default == '1') echo "checked"; ?>

<!--name="renewal_default" type="radio"> -->



                            </td>

                            <td style="padding:0.5em;">

                           <input name="renewals[]" class="plain" type="checkbox" value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('renewals') && in_array($plan->plid,$this->input->post('renewals')) == '1') ? "checked" : (isset($plan->plan_id)) ? "checked" : ''?>>



<!--<input name="renewals[]" class="plain" type="checkbox" value="<?php //echo $plan->plid ?>" <?php //if(isset($plan->plan_id)) echo "checked"; ?> >   -->



                            </td>

                            <td style="padding:0.5em;"><?php echo $plan->name ?></td>

                            <td style="padding:0.5em;"><?php echo $plan->term.' '.$plan->period ?></td>

                            <td style="padding:0.5em;">



                             <?php

                             $price = $this->input->post('renewalprice');

                             $renewalprice = (isset($plan->price)) ? $plan->price : '';

                            ?>

                            <input name="renewalprice[<?php echo $plan->plid ?>]" type="text" value="<?php echo ($price) ? $price[$plan->plid] : $renewalprice ?>">



                            </td>

                        </tr>

                        <?php endforeach ?>

                        <?php else: ?>

	                    <p class='text'><?=lang('web_no_elements');?></p>

                        <?php endif ?>

            		</table>
            	
                </td>

            </tr>
        	</tbody>
        
        </table>


			</div>
</fieldset>
			<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab4"> 
							<a href="#exe_f" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 
</div>
</div>

</dd>
 
                    
<div style="clear:both;"></div>                
</div>

            


<input type="hidden" name="med_type" id="med_type" value="" >
<input type="hidden" name="med_name" id="med_name" value="" >
<input type="hidden" name="med_file" id="med_file" value="" >
<input type="hidden" name="med_active" id="med_active" value="" >
<input type="hidden" name="med_inst" id="med_inst" value="" >
<input type="hidden" name="med_cat" id="med_cat" value="" >



<!--<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />

<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>-->



<script type="text/javascript">
  function getWebDesc(i) 
  {
     if(i == "active")
	 {
	    document.getElementById('desc_tr').style.display = "inline-block";
	 }
	 else{
	 
	    document.getElementById('desc_tr').style.display = "none"; 
	 }
  }

</script>

<script>

 $(document).ready(

 function()

 {

   	//$('#reqmts').redactor();

 }

 );

 </script>
</div>
</dd>
</div>
<?php
	$this->load->config('features_config');
	$webinar = $this->config->item('webinar');				
			
	if($webinar['status']==TRUE)
	{
?>            
<div class="tab-pane" id="webinar">
<dd class="" sno="9" id="dd_9" style="margin:0;">

	<div class="tab-content">


	<div> 
		<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 
			

			<!-- <div class="panel-heading"> 
				<p style="padding: 10px 20px;">This is the live class mode for taking live classes, if you wish to include live class in your course please select "Active". You can schedule and edit live classes / webinars for each lectures from <a href="<?php echo base_url(); ?>programs/lists/">Course you Teach</a></p>
			</div>  -->

			<div class="panel-body form-horizontal form-groups-bordered"> 

				



			</div>
		</div>
	</div>






						

</div>

</dd>

<div style="clear:both;"></div>
</div>
<?php 
	}
?>
</div>
<?php if ($updType == 'edit'){ ?>
  <div style="padding-top: 10px;"><a class="link_page" style="float: right;" href="<?php echo base_url(); ?>days/index/<?php echo $program ->id?>">
  <div class="sprite 2edit tab_icon" style="float:left;background-position: -32px 0;" title="Course Content">
             </div>
  <!-- <div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div> --><span class="crosslink">Go to Course Content</span></a></div>
  <?php } ?>
</div>        

</div>

</div>        

</div>

<div style="clear:both"></div>

<input type="hidden" name="setname" id="setname" value="">
<input type="hidden" name="setdescription" id="setdescription" value="">
<input type="hidden" name="setcategory" id="setcategory" value="">
<input type="hidden" name="setactivate" id="setactivate" value="">
<input type="hidden" name="setsrc" id="setsrc" value="">
<input type="hidden" name="setimg" id="setimg" value="">

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime1').datetimepicker({

        weekStart: 1,

        todayBtn:  1,

		autoclose: 1,

		todayHighlight: 1,

		startView: 2,

		forceParse: 0,

        showMeridian: 1

    });
</script>

<?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>
<input type="hidden" name="media_number" value="<?php //echo $n; ?>" id="media_number"/>
<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$program->id) ?>
<?php endif ?>
<?php echo form_close(); ?>
<style>
.hide{    
    display:none;
}
</style>
<!--<form id="form1" runat="server">
    <input type='button' id='remove' value='remove' class='hide'/>
    <input type='file' id="imgInp" /><br>
    <img id="blah" src="#" alt="your image" width='150'/>
</form>-->
<!-- kk<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>kk -->
<!--<script>
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
</script>-->

<script type="text/javascript">
function getPlan(i) 
{
    if(i == "fixed")
	{
	    document.getElementById('fixed_rate').style.display = 'block';
	    document.getElementById('price_subs').style.display = 'block';
	    document.getElementById('subscriptions_tr').style.display = 'none';
	    document.getElementById('subscriptions_headtr').style.display = 'none';
	    document.getElementById('renewals_tr').style.display = 'none';
	    document.getElementById('renewals_headtr').style.display = 'none';
	    document.getElementById('Subscriptionspaneltitle').style.display = 'block';
	    
	}
	else if(i == "subscription")
	{
	 
	    document.getElementById('fixed_rate').style.display = 'none';
	    document.getElementById('price_subs').style.display = 'block';
	    document.getElementById('subscriptions_tr').style.display = 'table-row';
	    document.getElementById('subscriptions_headtr').style.display = 'table-row';
	    document.getElementById('renewals_tr').style.display = 'table-row'; 
	    document.getElementById('renewals_headtr').style.display = 'table-row';
	    document.getElementById('Subscriptionspaneltitle').style.display = 'block';
	}
}
</script>
<script>
// $(document).ready(function() 
// 	{
// 		val i = $("div.radio").find("#plan").val();
// 		//val i = document.getElementById('plan').value;
// 		alert(i);
// 	if(i == "fixed")
// 	{
// 	    document.getElementById('fixed_rate').style.display = 'block';
// 	    document.getElementById('price_subs').style.display = 'block';
// 	    document.getElementById('subscriptions_tr').style.display = 'none';
// 	    document.getElementById('subscriptions_headtr').style.display = 'none';
// 	    document.getElementById('renewals_tr').style.display = 'none';
// 	    document.getElementById('renewals_headtr').style.display = 'none';
// 	}
// 	else if(i == "subscription")
// 	{
	 
// 	    document.getElementById('fixed_rate').style.display = 'none';
// 	    document.getElementById('price_subs').style.display = 'block';
// 	    document.getElementById('subscriptions_tr').style.display = 'table-row';
// 	    document.getElementById('subscriptions_headtr').style.display = 'table-row';
// 	    document.getElementById('renewals_tr').style.display = 'table-row'; 
// 	    document.getElementById('renewals_headtr').style.display = 'table-row'; 
// 	}
// });
</script>

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

<script>


function hideShowWebcamTime()
{   
	if(document.getElementById('webcam_option').checked ==true)
	{
		$("#timewebcam").css("display","block");
	}
	else
	{
		$("#timewebcam").css("display","none");
	}
}

$(document).ready(function() 
{
   $("span.error").each(function() {

   var parent = $(this).closest('dd').attr('sno');

   var get_error = $(this).text();

    if(get_error != ''){

          $(this).closest('dd').prev('dt').css('background-color', 'red');
     }
});
});

for(var i=1;i<=7;i++)
{
		$('#nexttab'+i).click(function() {			
			var active = $('ul li.active').removeClass('active');
		    active.next().addClass('active');
		    $("html, body").animate({ scrollTop: 0 }, 600);		  
		});
}
</script>
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

// var $j =jQuery.noConflict();
//   function formvalid()
//   {  	
  	
//   	var name = $j('#name').val();
//   	//var description = $j('#description').val();
//   	var category_id = $j('#category_id').val();
//   	var teacher_id = $j('#teacher_id').val();
//   	//var step_access_courses = $j('#step_access_courses').val();
//   	var step_access_courses = $j('input[name=step_access_courses]:checked').val();
//   	 var description =tinymce.get('description').getContent();
//   	//alert(step_access_courses);
//   	var chb_free_courses = $j('input[name=chb_free_courses]:checked').val();
//   	if(name.trim() =="")
//   	{
  		
//   		validatepop('Course Name Required','Please Enter Name of Course!');		
// 	    return false;
//   	}
//   	else if(description.trim() =="")
//   	{

//   		validatepop('Course Description Required','Please Enter  Description of Course!');  		
//   	    return false;
//   	}
//   	else if(category_id.trim() =="")
//   	{
//   		validatepop('Course Category Required','Please Select Category of Course!');
//   		return false;

//   	}
//   	else if(teacher_id.trim() =="")
//   	{
//   		validatepop('Course Teacher Required','Please Select Teacher for Course!');
//   		return false;
//   	}
//   	else
//   	 {   
//   			if(step_access_courses == 0 || chb_free_courses ==1)
//   			{  
//   				var plan = $('input[name=plan]:checked').val();
//   					//alert(plan)
//   				if( typeof plan !="undefined")
//   				{
// 	  				if(plan=="fixed")
// 	  				 {
// 	  				 	 var fixedrate = $("#fixedrate").val();

// 	  				 	   if(fixedrate.trim() =="")
// 						  	{	
// 						  		validatepop('Fixed Rate Required','Please enter Fixed Rate for Course!');
						  		
// 						  	return false;
// 						  	}
// 	  				 }

// 	  			   if(plan=="subscription")
// 	  			   {	  			   		

// 	  			   		var subscription_default = $('input[name=subscription_default]:radio:checked').val();	  			   		
// 	  			   		var subscriptions  = new Array();
// 						$("input[name='subscriptions[]']:checked").each(function() {
// 						    subscriptions.push($(this).val());
// 						});
									

// 	  			   		if(typeof subscription_default=="undefined")
// 	  			   		{
// 	  			   			validatepop('Subscription Default Required','Please select Subscription Default for Course!');	
// 	  			   			return false;
// 	  			   		}	  			   		
// 	  			   		else if(subscriptions=="")
// 	  			   		{	
// 	  			   			validatepop('Subscription  Required','Please select Subscription for Course!');	
// 	  			   			return false;
// 	  			   		}
// 	  			   		else
// 	  			   		{
// 	  			   			var findele = $.inArray(subscription_default,subscriptions);
	  			   				
// 	  			   				if(findele == -1)
// 	  			   				{
// 	  			   					validatepop('Valid Subscription Default Required','Please select Valid Subscription Default for Course!');	
// 	  			   					return false;
// 	  			   				}
// 	  			   			var subscription_price = [];
							

// 								var countArray = subscriptions.length;
								
// 								for(var i=0; i < countArray; i++)
// 								{
									

// 									$('input[name="subscription_price['+subscriptions[i]+']"]').each(function() {
// 							    		 var ttval = $(this).val();
// 							    		 if(ttval)
// 							    		 {
// 							    		 subscription_price.push(ttval);
// 							    		 }
// 							        });
// 								}
							
// 							   if(subscriptions.length != subscription_price.length)
// 							   {
// 							   	 validatepop('Subscription Price Required','Please enter Subscription Price for Course!');	
// 	  			   			     return false;
// 							   }
							
// 							 //return true;
// 	  			   		}

// 	  			   		//for Renewal plan start
// 	  			   		var renewal_default = $('input[name=renewal_default]:radio:checked').val();	  			   		
// 	  			   		var renewals  = new Array();
// 						$("input[name='renewals[]']:checked").each(function() {
// 						    renewals.push($(this).val());
// 						});
									
						
// 	  			   		if(typeof renewal_default=="undefined")
// 	  			   		{
// 	  			   			validatepop('Renewals Default Required','Please select Renewals Default for Course!');	
// 	  			   			return false;
// 	  			   		}	  			   		
// 	  			   		else if(renewals=="")
// 	  			   		{	
// 	  			   			validatepop('Renewals  Required','Please select Renewals for Course!');	
// 	  			   			return false;
// 	  			   		}
// 	  			   		else
// 	  			   		{
// 	  			   			var findele1 = $.inArray(renewal_default,renewals);
	  			   				
// 	  			   				if(findele1 == -1)
// 	  			   				{
// 	  			   					validatepop('Valid Renewals Default Required','Please select Valid Renewals Default for Course!');	
// 	  			   					return false;
// 	  			   				}
// 	  			   			var renewalprice = [];
							

// 								var countArray = renewals.length;
								
// 								for(var i=0; i < countArray; i++)
// 								{
									

// 									$('input[name="renewalprice['+renewals[i]+']"]').each(function() {
// 							    		 var ttval = $(this).val();
// 							    		 if(ttval)
// 							    		 {
// 							    		 renewalprice.push(ttval);
// 							    		 }
// 							        });
// 								}
							
// 							   if(renewals.length != renewalprice.length)
// 							   {
// 							   	 validatepop('Renewals Price Required','Please enter Renewals Price for Course!');	
// 	  			   			     return false;
// 							   }
							
// 							 //return true;
// 	  			   		}
// 	  			   		//for Renewwal plan end

	  			   		
// 	  			   }

//   				}
//   				else
//   				{
//   					validatepop('Choose payment type Required','Please Choose payment type for Course!');
//   					return false;
//   				}
//   			}
//   			else
//   			{
//   				return true;
//   			}
//   	return true;
  		
//   	}
  	
//   }

var $j =jQuery.noConflict();
  function formvalid()
  {  	
  	var name = $j('#name').val();
  	var description =tinymce.get('description').getContent();
  	//var description = $j('#description').val();
  	var category_id = $j('#category_id').val();
  	var teacher_id = $j('#teacher_id').val();
  	var step_access_courses = $j('input[name=step_access_courses]:checked').val();
  	//var plan = $j('input[name=plan]:checked').val();
  	
  	var chb_free_courses = $j('input[name=chb_free_courses]:checked').val();
    //alert(chb_free_courses);

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
  	// else if(plan)
  	// {
  	// 	var fixedrate = $j('#fixedrate').val();
  	// 	if(plan == 'fixed' && fixedrate == ''){
  	// 		validatepop('Fixed Rate Required','Please enter Fixed Rate for Course!');

  	// 	}
  	// 	else{
  	// 		return true;
  	// 	}
  	// 	if(plan == 'subscription' && fixedrate == ''){
  	// 		validatepop('subscription Rate Required','Please enter Fixed Rate for Course!');
  	// 	}
  		
  		
  	// }
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
						  		
							  	<?php if( $updType == 'create' )
							  	{ ?>
							  		
				  			// 	  $j.confirm({
									//     title: '<div class="title-font">Great you have setup new course successfully!</div>',
									//     content: '   ',

									//     confirmButton: 'START ADDING LECTURES',
						   //  			cancelButton: 'NO, DO THIS LATER',
						   //  			confirmButtonClass: 'yes-btn btn-success',
						   //  			cancelButtonClass: 'no-btn btn-danger',
						   //  			backgroundDismiss: false,
						   //  			 onOpen: function(){
									// 	   // this.$confirmButton.after('');
									// 	   // this.$title.css('height', '80px');
									// 	   this.$cancelButton.after('<p style="float:left;width: 49%;">(Course can have course content as lectures or exams)</p><p style="float:right;width: 43%;">(Bring me back to Course list)</p>');
									// 	},
						   //  			confirm: function()
						   //  			{
									//         //alert('confirmed');
									//          $j("#submit").click(); 
									         
									//          $j(".jconfirm-box-container").css("display", "none");
									//          return true;
									//     },
									//     cancel:function()
									//     {
									//         //alert('canceled');
									//          $j("#redirect").click();
									          
									//         $j(".jconfirm-box-container").css("display", "none");
									//          return true;
									//     }

									// });
	  				 
	  						<?php } 
				  				else 
				  				{ ?>
				  				
				  					
				  					 $j("#submit").click();
				  					
				  				 <?php } ?>

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
							<?php if( $updType == 'create' ){ ?>
			  		// 		  $j.confirm({
							//     title: '<div class="title-font">Great you have setup new course successfully!</div>',
							//     content: ' ',

							//     confirmButton: 'Yes',
				   //  			cancelButton: 'NO',
				   //  			confirmButtonClass: 'yes-btn btn-success',
				   //  			cancelButtonClass: 'no-btn btn-danger',
				   //  			backgroundDismiss: false,
				   //  			 onOpen: function(){
							// 			   // this.$confirmButton.after('');
							// 			   // this.$title.css('height', '80px');
							// 			   this.$cancelButton.after('<p style="float:left;width: 49%;">(Course can have course content as lectures or exams)</p><p style="float:right;width: 43%;">(Bring me back to Course list)</p>');
							// 			},
				   //  			confirm: function(){
							//         //alert('confirmed');
							//          $j("#submit").click(); 
							         
							//          $j(".jconfirm-box-container").css("display", "none");
							//          return true;
							//     },
							//     cancel:function(){
							//         //alert('canceled');
							//          $j("#redirect").click();
							          
							//         $j(".jconfirm-box-container").css("display", "none");
							//          return true;
							//     }

							// });
  				 
			  			<?php	} 
			  				else 
			  				{ ?>
			  					
			  						 $j("#submit").click();
			  					
			  			<?php	} ?>
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
  				<?php if( $updType == 'create' ){ ?>
  			// 	  $j.confirm({
			  //   title: '<div class="title-font">Great you have setup new course successfully!</div>',
			  //   content: '  ',

			  //   confirmButton: 'Yes',
    	// 		cancelButton: 'NO',
    	// 		confirmButtonClass: 'yes-btn btn-success',
    	// 		cancelButtonClass: 'no-btn btn-danger',
    	// 		backgroundDismiss: false,
    	// 		onOpen: function(){
					// 					   // this.$confirmButton.after('');
					// 					   this.$cancelButton.after('<p style="float:left;width: 49%;">(Course can have course content as lectures or exams)</p><p style="float:right;width: 43%;">(Bring me back to Course list)</p>');
					// 					},
	    // 			confirm: function(){
				 //        //alert('confirmed');
				 //         $j("#submit").click(); 
				         
				 //         $j(".jconfirm-box-container").css("display", "none");
				 //         return true;
				 //    },
				 //    cancel:function(){
				 //        //alert('canceled');
				 //         $j("#redirect").click();
				          
				 //        $j(".jconfirm-box-container").css("display", "none");
				 //         return true;
				 //    }

					// });
  				 
  			<?php	} 
  				else 
  				{ ?>
  					
  						 $j("#submit").click();
  					
  			<?php	} ?>
  				//$('#myModal').modal('show');
  				//$('.modal-backdrop.in').css('display', 'none');
  				return true;

  				
  			}
  	return true;
  		
  	}
  	
  }

  function validatepop(strtitle,strcontent)
  {	  
  	  //var strtitle ='Name Required';	
  	  var strcontent1 ='<p style="text-align: center;font-weight: 700;font-size: 15px;">'+strcontent+'</p>';
  	//   var validmsg='<div class="validateerror alert alert-danger">';
  	//       validmsg+='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
 		//   validmsg+='<strong>Warning!</strong>'+strcontent+' </div>';
  	//   	if($j("div").is('.alert-danger') == true)
  	//   	{	 alert('fdf');
  	//   		validmsg1 ='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
 		//   validmsg1+='<strong>Warning!</strong>'+strcontent;
  	  	
  	//   	  $j(".alert-danger").html(validmsg1);
 		// }
 		// else
 		// {    alert('fdfsss');
 		// 	//$j("#sticky-anchor").before(validmsg);
 		// 	  $j("#proform").prepend(validmsg);
 		// }
  	$j.alert({
           title: strtitle,
   		  content: strcontent1,
   		 confirm: function()
                   {                        
              
                   }
               });
  }

function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
		return false;

    return true;
}
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
   var options = $('#assistant_id option');
  	var values = $.map(options ,function(option) {
    return option.value;
});
  var isoption	= $.inArray( tecval, values );
  		if(isoption == -1)
  		{
  			$("#assistant_id option").removeAttr("disabled");
  		}

  	    $("#assistant_id option[value='"+tecval+"']")
    .attr("disabled", "disabled")
   .siblings().removeAttr("disabled");
   $("#assistant_id option[value='"+tecval+"']").prop("selected",false);   
     
     

  }
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
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
   	selector : "#description",
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
              	// width = e.element.width;
               //  height = e.element.height;
                callback(e.target.result, {
                  alt: '',style: 'width:500px; height:500px;'
                });
                 
               // tinyMCE.DOM.setAttribs(e.element, 
               //      {'style': 'width:' + width + 'px; height:' + height + 'px;'});
              };
              reader.readAsDataURL(file);
            });
          }
        },


});

 //    jQuery(document).ready(function() 
 //    {
 //      tinymce.init({
 //  selector: '#description',
 //  height: 180,
 // // min_width: 400,
 //  theme: 'modern',
 //  plugins: [
 //    'advlist autolink lists print preview hr anchor pagebreak',
 //    'searchreplace wordcount visualblocks visualchars code fullscreen',
 //    'insertdatetime nonbreaking save table contextmenu directionality',
 //    'paste textcolor colorpicker textpattern'
 //  ],
 //  menubar: 'file edit insert view format table',
 //  toolbar1: 'undo redo | bold italic | alignleft aligncenter | alignright alignjustify | bullist numlist | outdent indent | forecolor backcolor fontselect fontsizeselect | print preview fullscreen',
 //  //toolbar2: 'print preview | forecolor backcolor',
 //  //toolbar2:'fontselect fontsizeselect | styleselect',
 //  image_advtab: true,
 //  paste_as_text: true,  
 //  // templates: [
 //  //   { title: 'Test template 1', content: 'Test 1' },
 //  //   { title: 'Test template 2', content: 'Test 2' }
 //  // ],
 //  content_css: [
 //    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
 //    '//www.tinymce.com/css/codepen.min.css'
 //  ]
 // });
 //   });
  </script>
<script type="text/javascript">
 jQuery(document).ready(function(){

    jQuery('#chb_free_courses1').click(function(){
    	jQuery("#Stud_free").show();
    	jQuery("#free_courses").show();
    	// jQuery(".Sel_div .grey-background").css("border-radius", "5px 5px 0px 0px")
    	if($('#step_access_courses1[value=1]').is(':checked')) {
    	
    	$("#free_courses").hide();
    	showhidecourse();

	}

    });

    jQuery('#chb_free_courses2').click(function(){
    	
    	$("#Stud_free").hide();
    	$("#free_courses").hide();
    	$("#priceDiv").show();
    	$("#price_subs").show();
    	jQuery(".Sel_div .grey-background").css("border-radius", "5px")
    

    });


});	
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
			    		document.getElementById('Stud_free').style.display = 'block';
			    		document.getElementById('priceDiv').style.display = 'none';
					    document.getElementById('fixed_rate').style.display = 'none';
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
			 				
			 				document.getElementById('Stud_free').style.display = 'block';
						    document.getElementById('fixed_rate').style.display = 'block';
						    document.getElementById('price_subs').style.display = 'block';
						    document.getElementById('subscriptions_tr').style.display = 'none';
						    document.getElementById('subscriptions_headtr').style.display = 'none';
						    document.getElementById('renewals_tr').style.display = 'none';
						    document.getElementById('renewals_headtr').style.display = 'none';
						
				         }
						 else if(vv == "subscription")
						 {
						 	document.getElementById('free_courses').style.display = 'block';
					         
					         document.getElementById('Stud_free').style.display = 'block';

						    document.getElementById('fixed_rate').style.display = 'none';
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
						    document.getElementById('price_subs').style.display = 'block';
						    document.getElementById('subscriptions_tr').style.display = 'none';
						    document.getElementById('subscriptions_headtr').style.display = 'none';
						    document.getElementById('renewals_tr').style.display = 'none';
						    document.getElementById('renewals_headtr').style.display = 'none';
						
					       }
						 else if(i == "subscription")
						 {
					         
						    document.getElementById('fixed_rate').style.display = 'none';
						    document.getElementById('price_subs').style.display = 'block';
						    document.getElementById('subscriptions_tr').style.display = 'table-row';
						    document.getElementById('subscriptions_headtr').style.display = 'table-row';
						    document.getElementById('renewals_tr').style.display = 'table-row'; 
						    document.getElementById('renewals_headtr').style.display = 'table-row'; 
						  
						 }
			}

	    });
</script>
 <!-- <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/public/js/tinymce/plugins/tinymce_equation_editor/mathquill.min.js"></script>
  <script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
<script>

  tinymce.PluginManager.load('equationeditor', '<?php echo base_url(); ?>/public/js/tinymce/plugins/tinymce_equation_editor/plugin.min.js');

tinymce.init({
  selector: '#dummy',
  plugins: 'equationeditor',
  content_css: '<?php echo base_url(); ?>/public/js/tinymce/plugins/tinymce_equation_editor/mathquill.css',
  toolbar: [
    'undo redo | bold italic | alignleft aligncenter | alignright alignjustify | bullist numlist | outdent indent | forecolor backcolor fontselect fontsizeselect | print preview fullscreen | equationeditor'
  ],
});
  </script> -->

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />    
  
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script>
// jQuery.browser = {};
// (function () {
//    jQuery.browser.msie = false;
//    jQuery.browser.version = 0;
//    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
//        jQuery.browser.msie = true;
//        jQuery.browser.version = RegExp.$1;
//    }
// })();

//  var $j =jQuery.noConflict();
//  $j(document).ready(function(){
//   $j("#fromdate").datepicker({ dateFormat: 'yy-mm-dd' }).val();
//      $j( "#todate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
//      $j( "#untilldate" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
//  });

</script>
<script type="text/javascript">
function print() {
  t = document.getElementById('fromtime').value
  h = t.substr(0,2);
  ms = t.substr(2)
  document.getElementById('fromtime11').value = ((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');
  console.log((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');
}
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
<script type="text/javascript">
  function sub_val(){
	var dur = jQuery("#web_duration").val();
	var date1 = jQuery("#fromdate").val(); 
	var time = jQuery("#fromtime").val();
	var dattime = date1+" "+time;
	var dateObj= new Date() ;
	var month = ('0' + (dateObj.getMonth() + 1)).slice(-2);
	var date = ('0' + dateObj.getDate()).slice(-2);
	var year = dateObj.getFullYear();
	var shortDate = year + '-' + month + '-' + date;
	// alert(shortDate+" "+date1);
	// if(date1 >= shortDate){
	// 	alert('yes');
	// }else{
	// 	alert('Select proper date');
	// 	return false;
	// }
	
    if(dur>=30 && dur<=300){

    }
    else{
      alert("Please enter duration between 30 to 300 minutes.");
      return false;
    }
  }
</script>
 <script type="text/javascript">
function save_webinar(idd,parent_idd)
{	
	t = document.getElementById('fromtime').value;
  h = t.substr(0,2);
  ms = t.substr(2);
  document.getElementById('fromtime11').value = ((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');
  console.log((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');

	var parent_idd = parent_idd;
	var type_submit = idd;
	//alert(parent_idd);
	var name = $("#name").val();
	var description =tinymce.get('description').getContent();
	document.getElementById('description1').value = description;
	var category_id = $("#category_id").val();
	var teacher_id = $("#teacher_id").val();
	var step_access_courses = $('input[name=step_access_courses]:checked').val();

  	var chb_free_courses = $('input[name=chb_free_courses]:checked').val();
  	var fromdate = $("#fromdate").val();
  	var fromtime = $("#fromtime").val();
  	var web_duration = $("#web_duration").val();
  	// var desc = tinymce.get('description1').getContent();
  	// alert(desc);
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
  	else if(fromdate.trim() =="")
  	{
  		validatepop('Webinar Start Date Required','Please choose Date For Webinar!');
  		return false;
  	}
  	else if(fromtime.trim() =="")
  	{
  		validatepop('Webinar Start Time Required','Please choose Startup Time For Webinar!');
  		return false;
  	}
  	else if(web_duration.trim() =="")
  	{
  		validatepop('Webinar Duration Required','Please Enter Duration For Webinar!');
  		return false;
  	}
  	else if(web_duration.trim() < 30)
    { 
      validatepop('Given Duration is too short!',' Required Minimum 30 Minutes of duration!');   
      return false;
    }

  	else if(step_access_courses == 0 || chb_free_courses ==1)
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
						  	else 
							{
								var updType ="<?php echo $updType; ?>";
								if(updType == 'create' )
								{
									post_webinar(type_submit);
								}
								else {
									edit_webinar(type_submit,parent_idd);
								}
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
							
							  var updType ="<?php echo $updType; ?>";
								if(updType == 'create' )
								{
									post_webinar(type_submit);
								}
								else {
									edit_webinar(type_submit,parent_idd);
								}
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
		var updType ="<?php echo $updType; ?>";
		if(updType == 'create' )
		{
			$('#loading').show();
			$('.sub_ass').addClass('disabled');
			post_webinar(type_submit);
		}
		else {
			$('#loading').show();
			$('.sub_ass').addClass('disabled');
			edit_webinar(type_submit,parent_idd);
		}
	}
}

function post_webinar(idd)
{

	 $.ajax({
	       
	        type: "POST",
	        url: " <?php echo base_url()?>programs/createweb2", //<?php echo base_url('tasks/save_lecture/')?>",
	        data: $("#proform").serialize(),
	       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
	        success: function(msg)
	        {    console.log(msg);
	        	//alert(msg);
	        	$('#loading').hide();
				$('.sub_ass').removeClass('disabled');
	            if(msg == "success")
	            {
	                $j.alert({
	                	// type: 'error',
	                	
	                 title: "Success",
	               content: '<center><b><h4 style="padding:2%;">Webinar Created Successfully! </h4></b></center>',
	                confirm: function()
	                          {
	                          	if(idd=='2'){
	                           		window.location ="<?php echo base_url();?>manage/courses";
	                       		}
	                       		else{
	                       			window.location ="<?php echo base_url();?>programs/createweb/";
	                       		}
	               
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
	                          // window.location ="<?php echo base_url();?>sections-manage/"+seg4+"/index";
	                            $('.error').remove();
	                          return true;
	               
	                           }
	                       });

	            }
	            
	        }
	    });
}


function edit_webinar(idd,parent_idd)
{
	//alert(parent_idd);
	// var id = <?php echo $this->uri->segment(3); ?>
	 alert(id);
	 $.ajax({
	       
	        type: "POST",
	        url: " <?php echo base_url()?>programs/editwebinar2/"+parent_idd, //<?php echo base_url('tasks/save_lecture/')?>",
	        data: $("#proform").serialize(),
	       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
	        success: function(msg)
	        {    console.log(msg);
	        	//alert(msg);
	        	$('#loading').hide();
				$('.sub_ass').removeClass('disabled');
	            if(msg == "success")
	            {
	                $j.alert({
	                	// type: 'error',
	                	
	                 title: "Success",
	               content: '<center><b><h4 style="padding:2%;">Webinar Updated Successfully! </h4></b></center>',
	                confirm: function()
	                          {
	                          	if(idd=='2'){
	                           		window.location ="<?php echo base_url();?>manage/courses";
	                       		}
	                       		else{
	                       			window.location ="<?php echo base_url();?>programs/editwebinar/"+parent_idd;
	                       		}
	               
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
	                          // window.location ="<?php echo base_url();?>sections-manage/"+seg4+"/index";
	                            $('.error').remove();
	                          return true;
	               
	                           }
	                       });

	            }
	            
	        }
	    });
}
 </script>
