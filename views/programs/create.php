<?php
$u_data=$this->session->userdata('logged_in');
$maccessarr=$this->session->userdata('maccessarr');

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
</style>

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

window.onload = function() {

showhidecoursetype();

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

echo ($updType == 'create') ? form_open_multipart(base_url().'programs/create', $attributes) : form_open_multipart(base_url().'programs/edit/'.$id, $attributes);

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
					
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-success' style='display: none' name='submit'" : "id='submit' class='btn btn-success' name='submit'")); ?>
          
            <?php if ($updType == 'create'): ?>
            	<input type="submit" name="redirect" value="redirect" id="redirect" style="display:none;" class="btn btn-success btn-green">
            	<button type="button" class="btn btn-success" onclick="return formvalid()"> Save Changes</button>
            	    <?php if ($parent_id != "0"): ?>
            	    	<button type="button" class='btn btn-orange btn-blue' onclick="return formvalid()" id="savebtn"> Save & Back to list</button>
            	    	<input type="submit" value="Save And Continue" name="save2" class='btn btn-orange' style="display: none;">
            	    	<a href='<?php echo base_url(); ?>manage/courses' class='btn btn-danger'>Cancel</a>

            	    <?php else: ?>

            	    	 <a href='<?php echo base_url(); ?>programs/lists/<?php echo $page?>/' class='btn btn-danger'>Cancel</a>

            	    <?php endif ?>

			<?php else: ?>

             	    <?php if ($parent_id != "0"): ?>

             	    	<input type="submit" value="Save & Back to list" name="edit2" class='btn btn-orange'>
                		<a href='<?php echo base_url(); ?>manage/courses' class='btn btn-danger'>Cancel</a>


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
					<span class="hidden-xs">Exercise Files</span>
				</a>
			</li>
			<li id="pub_course">
				<a href="#publishing" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Publish Course</span>
				</a>
			</li>
           <li id="adv_settings" >
				<a href="#requirements" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Advanced Settings</span>
				</a>
			</li>
         	 <!-- <li>
				<a href="#mtags" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Meta Tags</span>
				</a>
			</li> -->

            <!-- <li>
				<a href="#publishing" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Publishing</span>
				</a>
			</li> -->
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
				<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
                <textarea  name="description" data-validation="required"  id="description" class="form-control" rows="6"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea>
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

		     <div class="form-group" >						
            <label class="col-sm-3 control-label" for="learn_pnt">What We Learn? </label>						
			<div class="col-sm-5" style="width: 40.5%">
				<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>

                <textarea id="todolist"  name="learn_pnt"                    data-validation="required"  class="form-control todolist" rows="6"><?php echo ($this->input->post('learn_points')) ? $this->input->post('learn_points') : ((isset($program->learn_points)) ? $program->learn_points : '');?></textarea>
               
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
						<label for="field-1" class="col-sm-3 control-label"><b>Upload Course Preview:</b></label> 

						<div class="col-sm-5">	

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
							<input type="hidden" value="<?php echo ($this->input->post('preview')) ? $this->input->post('preview') : $imgname; ?>" name="preview" id="preview"> 
						
							<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
				        <form enctype="multipart/form-data" id="upfile" method="post" action="<?php echo base_url(); ?>programs/upload_preview">	
                           <input type="file" name="preview" id="file_p" class="upload_btn" accept="video/mp4,video/x-m4v,video/*">
                        <input type="submit" id="submitbtn" style="display: none;">
                       <video width="320" height="240" style="display: <?php echo ($imgname ? 'block' : 'none'); ?>" controls>
  <source src="<?php echo base_url().'public/uploads/video/'.$imgname; ?>" type="video/mp4">
  <source src="<?php echo base_url().'public/uploads/video/'.$imgname; ?>" type="video/ogg">
</video>

						   </div>

						</div>
					</div>

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
								<?php foreach ($assistant_teachers as $teacher): 
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
			<div> 

		<div class="panel-heading"> 
			
			<div style="margin-top: 10px; margin-bottom: 10px;"> 
			<!-- <div class="seperator"></div> -->
		<legend class="tile_fld"> Exercise Files</legend>
			<!-- <a href = "<?php echo base_url(); ?>medias/addmedia/<?php //echo $program->id; ?>" class='<?php echo "fancybox fancybox.iframe";?> btn btn-success'>Select from existing files</a> -->
			<a  style="margin-left:15px;" href = "<?php echo base_url(); ?>medias/addmedia/<?php //echo $program->id; ?>" class='existingfiles btn btn-success'>Select from existing files</a>
				<a href = "<?php echo base_url(); ?>medias/createexercisefile/<?php //echo $program->id; ?>" class='<?php echo "newexercise";?> btn btn-success'>Add New exercise file </a>
				
			</div> 
		</div> 
		<div style="overflow: auto;margin-left:15px;margin-right:15px;">
			<table id="myTable" class="table table-bordered table-responsive"> 
				<thead> 
					<tr> 
						<!-- <th align="center">Sr.No.</th> -->

            					<th>Type</th>

            					<th>

									<strong>File/Media name</strong>

								</th>
								<th>Download</th>
            					<!-- <th>

									<strong>Published</strong>

								</th> -->

            					<!--<th>

                                	<div align="center">

                                        <div style="float:left;">

                                            <strong>Order</strong>

                                        </div>

                                    </div>

								</th>

            					<th>

									<strong>Guest Access</strong>

								</th>-->

            					<th>

									<strong>Remove</strong>

								</th>
 
					</tr> 
				</thead> 
				<tbody id="rowsmedia">

							<tr>

            					
          					</tr>

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

                               <td align="center">

                                    <?php echo $nums;//$media->id ?>

                                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>

                               <td>

                                     <?php echo $img_type ?>

                               </td>

                               <td>

                                    <?php echo $media->name ?>

                               </td>



                               <td>

                                   <?php if($media->published){?>

                                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>">

                                    <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">

                                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>



                                    <?php }else{?>

    								<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none">

                                    <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">

                                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

                            		<?php }?>

                             </td>

                            

                             <td>

                                     <select name="access[]">

                                     <option value="0" <?php if(isset($media->access) && $media->access == 0) echo "selected"; ?>>Students</option>

                                     <option value="1" <?php if(isset($media->access) && $media->access == 1) echo "selected"; ?>>Members</option>

                                     <option value="2" <?php if(isset($media->access) && $media->access == 2) echo "selected"; ?>>Guests</option>

                                     </select>

                             </td>

                             <td>

										<a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>

                              </td>

                            </tr>



                             <?php

                             }

                            }

                          }
                          	
       						//exit('yeee');

                          if($updType == 'edit'){
                          	$get_media_ids2 = explode(',',$program->programmedias);
                          if(isset($get_media_ids2) && $get_media_ids2!= ''){

                          $nums = 0;
                          		//$mediafile_id = rtrim($this->input->post('mediafiles'), ",");
                          
       						//print_r($get_media_ids2);
                          foreach($get_media_ids2 as $get_media_id){

                          $nums++;

                          $getMedia = $this->medias_model->getMediaExeFile_new($get_media_id);
                          
                          //print_r($getMedia);

						

                          foreach($getMedia as $media){   ?>

                       <?php   
	                       	$urlmedia = strtolower($media->alt_title);			
							$urlmedia = trim(str_replace(' ', '-', $urlmedia));
							$urlmedia = preg_replace('/[^A-Za-z0-9\-]/', '', $urlmedia); ?> 
							<!-- <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>"> -->
                          <tr id="tr<?php echo $media->id;?>">

                               <td style="display: none;">

                                    <?php echo $media->id ?>
                                   
                                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>


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
                                   <!--  <?php echo $img_type ?> -->

                               </td>

                               <td>

                                    <?php 
                                    //print_r($media);
                                    echo $media->alt_title;
                                     ?>

                               </td>
                               <td>

                                     <!-- <a href="<?php echo base_url(); ?>course-media/<?php echo $urlmedia ? $urlmedia :'media' ?>/<?php echo $media->type;?>/<?php echo $media ->id?>" class="preview"><div class="sprite 5preview" style="background-position: -120px 0; height: 14px;" title="Preview"></div></a> -->

                                     <a href="<?php echo base_url(); ?>public/uploads/files/<?php echo $media->media_title?>" class="" download><i class="entypo entypo-download" title="Download"></i></a>

                               </td>


                               <!-- <td>

                                    <?php if($media->publish){?>

                                      <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>">

                                      <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">

                                      <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>



                                     <?php }else{?>

        								<img alt="Published1" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none">

                                        <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">

                                        <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

                              		<?php }?>





                             </td> -->

                            <!--  <td>order</td> -->

                             <!-- <td>

                                   <select name="access[]">

                                   <option value="0" <?php if(isset($media->access) && $media->access == 0) echo "selected"; ?>>Students</option>

                                   <option value="1" <?php if(isset($media->access) && $media->access == 1) echo "selected"; ?>>Members</option>

                                   <option value="2" <?php if(isset($media->access) && $media->access == 2) echo "selected"; ?>>Guests</option>

                                   </select>

                            </td> -->

                            <td>

                                    <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>

                            </td>

                            </tr>



                               <?php }

                              }

                           }else{

						   $nums = 0;

                           foreach($medias as $media){

						   $nums++;

                           ?>

                            <!--<tr id="addmediatext">  -->

                            <tr id="tr<?php echo $media->id;?>" <?php echo $display_none; ?>>

                               <td>

                               <?php echo $media->id ?>

                               <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>

                               <td>

                               <?php echo $img_type ?>

                               </td>

                               <td>

                               <?php echo $media->name ?>

                               </td>



                               <td>

                               <?php if($media->published){?>

                                <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>">

                                <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">

                                <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

<!--</a>  -->

                                <?php }else{?>

								<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none">

                                <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">

                                <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

                        		<?php }?>





                             </td>

                              <!--  <td>order</td> -->

                               <!-- <td>

                               <select name="access[]">

                               <option value="0" <?php if(isset($media->access) && $media->access == 0) echo "selected"; ?>>Students</option>

                               <option value="1" <?php if(isset($media->access) && $media->access == 1) echo "selected"; ?>>Members</option>

                               <option value="2" <?php if(isset($media->access) && $media->access == 2) echo "selected"; ?>>Guests</option>

                               </select>

                               </td> -->

                              <td>

                                <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>
                              </td>
                            </tr> <?php } } }?>
						</tbody>
			</table>
			<input id="mediafiles" name="mediafiles" value="<?php echo ($this->input->post('mediafiles') ? $this->input->post('mediafiles') : '')?>" type="hidden">
		</div> 
			</div>
		</div>
		 <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-5" id="nexttab4"> 
              <a href="#publishing" class="btn btn-info" data-toggle="tab">
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

			<!-- ============================== -->
		<div class="panel-body form-horizontal form-groups-bordered"> 
			
			<div class="form-group" id="demofixedrate">
                <label for="field-1" class="col-sm-3 control-label">Set Price :</label>
                <div class="col-sm-5">
                  <input type='text' name='demofixedrate' class='form-control' id='demofixedrate' value="<?php echo (isset($program->demoprice)) ? $program->demoprice : '' ?>" onkeypress="return isNumberKey(event)">
                	<p> (e.g. 18.99 (Enter only numerics & this price will not be use))</p>
                </div>
                
            </div>

		</div>

<!-- =================================== -->

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
            
<div class="tab-pane" id="publishing">
<dd class="" sno="6" id="dd_6">

	<div class="tab-content">

		<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 


			<div class="panel-body form-horizontal form-groups-bordered"> 

				<div class="form-group"> 

					<label class="col-sm-3 control-label">Activate<?php //echo lang('web_active')?></label>

					<div class="col-sm-5"> 
						<div class="checkbox"> 
							<label>  
							<?php echo $this->input->post('published'); ?>

<input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? 'checked="checked"' : (isset($program->published) && $program->published == '1') ? 'checked="checked"' : ''?> <?php echo $updType == 'create' ? 'checked="checked"' :''; ?> />

										   <!--<label class='labelforminline' for='published'> <?php echo lang('web_is_active')?> </label>-->

											<?php echo form_error('published'); ?>
							</label>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_publishing-active');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div> 
					</div> 
				</div>

				<!-- search engine meta tags start here-->

				<div class="form-group"> 
						<label for="field-1" class="col-sm-3 control-label">Title:</label> 
						
						<div class="col-sm-5"> 
							 <?php

                               $metatitle = (isset($program->metatitle)) ? $program->metatitle : '';

                               $metakwd = (isset($program->metakwd)) ? $program->metakwd : '';

                               $metadesc = (isset($program->metadesc)) ? $program->metadesc : '';



                               ?>

								<input type="text" value="<?php echo ($this->input->post('metatitle')) ? $this->input->post('metatitle') : $metatitle; ?>" maxlength="255" size="40" name="metatitle" class="form-control">



						<span class="tooltipcontainer">

						<span type="text" id="metatitle-target" class="tooltipicon" title="Click Here"></span>

						<span class="metatitle-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_meta-title');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish --> 
						</div> 
					</div> 
					


					
					<div class="form-group"> 
						<label for="field-ta" class="col-sm-3 control-label">Description:</label> 

						<div class="col-sm-5"> 
							<?php //$this->ckeditor->editor("metadesc",($this->input->post('metadesc')) ? $this->input->post('metadesc') : ((isset($program->metadesc)) ? $program->metadesc : ''));?>

								<textarea class="form-control" name="metadesc" cols="40"><?php echo $this->input->post('metadesc') ? $this->input->post('metadesc') : $metadesc; ?></textarea>

 <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="metadesc-target" class="tooltipicon" title="Click Here"></span>

						<span class="metadesc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_meta-description');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish --> 
						</div> 
					</div>
					<div class="form-group"> 
						<label for="field-ta" class="col-sm-3 control-label">Keywords:</label> 

						<div class="col-sm-5"> 
							<?php //$this->ckeditor->editor("metakwd",($this->input->post('metakwd')) ? $this->input->post('metakwd') : ((isset($program->metakwd)) ? $program->metakwd : ''));?>



							   <textarea class="form-control" name="metakwd" cols="40"><?php echo $this->input->post('metakwd') ? $this->input->post('metakwd') : $metakwd; ?></textarea>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="metakwd-target" class="tooltipicon"></span>

						<span class="metakwd-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_meta-keywords');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div> 
					</div>
				<!-- search engine meta tags end here-->

			</div>

		</div>

	<!--<fieldset class="adminform">

     

							<table class="adminform">

								<tbody><tr>

									<td width="15%">

											<label class='labelform'></label>

									</td>

									<td>

                                        

                                    </td>
									
									

								 </tr>
								 
								

								 <tr>

									<td>Start publishing Date</td>

									<td>

										<div class="controls input-append date form_datetime" data-link-field="dtp_input1">

                                        <?php $sdate = (isset($program->startpublish)) ? $program->startpublish : ''; ?>

<input  type="text" maxlength="19" size="25" id="fromdate"  value="<?php echo ($this->input->post('startpublish')) ? $this->input->post('startpublish') : $sdate; ?>"  name="startpublish" readonly>




						<span class="tooltipcontainer">

						<span type="text" id="startpublish-target" class="tooltipicon" title="Click Here"></span>

						<span class="startpublish-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('course_fld_start-publishing-date');?>

					

						</span>

						</span>



										<input type="hidden" id="dtp_input1" value="" />

										</div>

                                  </td>

								</tr>

								<tr>

									<td>End publishing Date</td>

									<td>

										<div class="controls input-append date form_datetime" data-link-field="dtp_input1">



                                        <?php $edate = (isset($program->endpublish)) ? $program->endpublish : ''; ?>

										<input type="text" maxlength="19" size="25" id="todate"  value="<?php echo ($this->input->post('endpublish')) ? $this->input->post('endpublish') : $edate; ?>" id="endpublish" name="endpublish" readonly>

									

						<span class="tooltipcontainer">

						<span type="text" id="endpublish-target" class="tooltipicon" title="Click Here"></span>

						<span class="endpublish-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('course_fld_end-publishing-date');?>

						

						</span>

						</span>



										<input type="hidden" id="dtp_input1" value="" />

										</div>

                                  </td>

								</tr>

							</tbody>
                            </table>

					</fieldset>-->


					<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab5"> 
							<a href="#requirements" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 

</div>
</dd>
<div style="clear:both;"></div>
</div>
            
            
<div class="tab-pane" id="mtags">
<dd class="" sno="7" id="dd_7" style="margin:0;">
	<div class="tab-content">


	<div> 
		<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 
			
			<div class="panel-body form-horizontal form-groups-bordered"> 

					  


			</div> 

			<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab6"> 
							<a href="#requirements" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 
		</div> 
	</div> 



</div>
</dd>
</div>

            
<div class="tab-pane" id="requirements">
<dd class="" sno="8" id="dd_8">
	<div class="tab-content">
	<!-- course type section start here -->
	<legend class="tile_fld"> Course Advanced Settings</legend>
	<div class="form-group">
						<label class="col-sm-3 control-label">Course type :</label>
						
						<div class="col-sm-5">
							
                        <?php

						$pcourse_type1 = ($this->input->post('course_type') == 0) ? 'selected="selected"' : '';

						$pcourse_type2 = ($this->input->post('course_type') == 1) ? 'selected="selected"' : '';

						?>

						<select class="form-control"  name="course_type" id="course_type">

						<option value="0" <?php echo ($this->input->post('course_type') == '0') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 0 ? 'selected="selected"' : $pcourse_type1) ?>>

						Non-Sequential

						</option>

						<option value="1" <?php echo ($this->input->post('course_type') == '1') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 1 ? 'selected="selected"' : $pcourse_type2) ?>>

						Sequential</option>

						</select>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="course_type-target" class="tooltipicon"></span>

						<span class="course_type-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_course-type');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
						<div class="col-sm-4">
							<p class="p1">Select whether the course lectures will be available to the students in a pre-defined sequence only or can access in non-sequential manner</p>
						</div>
					</div>

	<!-- course type section end here -->
	<!--exam section start here -->
	<div class="form-group">
						<label class="col-sm-3 control-label">Final Exam :</label>
						
						<div class="col-sm-5">
							
                        <select name="final_quizzes" id="final_quizzes" class="form-control" onchange="<?php if($facility == 'foolproof') { echo 'showhidewebinar()'; } ?>" >

                        <option value="0">no final exam</option>

						<?php foreach($finalexamlist as $finalexam){ ?>

                        <option value="<?php echo $finalexam->id;?>" <?php echo ($this->input->post('final_quizzes') == $finalexam->id) ? "selected=selected" : (isset($program->id_final_exam)) && $program->id_final_exam == $finalexam->id ? "selected=selected" : '' ?>><?php echo $finalexam->name;?></option>

						<?php }?>

						</select>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="final_quizzes-target" class="tooltipicon" title="Click Here"></span>
						<span class="final_quizzes-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_final-exam');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->

						</div>
						<div class="col-sm-4">
							<p class="p1">if you want to include the final exam you will need to create exam through<a href ="<?php echo base_url();?>quizzes/">"your Question Papers."</a>)</p>
						</div>
					</div>

					<?php
        		if(empty($program->id_final_exam))
        			{
        				$display = 'display:none';
       				 }else
        				{
        				$display = 'display:block';
        				}
        			?>
                    <div class="form-group" style="<?php echo $display; ?>" id="webcamDiv">
                    <label for="field-ta" class="col-sm-3 control-label">Webcam & Screenshots Option :</label>
						<div class="col-sm-offset-3 col-sm-5" style="margin-left:0;">
							<div class="checkbox">
								<label>									
                                    <input id="webcam_option" name="webcam_option" onclick='hideShowWebcamTime();' type="checkbox" <?php echo ($this->input->post('webcam_option')) ? "checked" : isset($program->webcam_option) && $program->webcam_option == '1' ? "checked" : '';?>>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="webcam_option-target" class="tooltipicon" title="Click Here"></span>
						<span class="webcam_option-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_webcam-option');?>
						<!--/tip containt-->
						</span>
						</span>

<!-- tooltip area finish -->
						</label>
						</div>							
						</div>

						<div class="col-sm-4">
							<p class="p1">(This Functionality will take screenshots and webcam shots of the examinees during an exam to ensure full proof evalution)</p>
						</div>
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
        <div class="form-group" id = "timewebcam" style="<?php echo $display1;?>" >
          <label class="col-sm-3 control-label" >Time Difference For Webcam and Screen Shot</label>
          <div class="col-sm-5">
            <select name="CbShot" id="CbShot" class="form-control">
            <option value='10Sec' <?php echo ((@$program->time_for_webcam == '10Sec') ? 'selected' : '');?> >10 Seconds</option>
            <option value='20Sec' <?php echo ((@$program->time_for_webcam == '20Sec') ? 'selected' : '');?> >20 Seconds</option>
            <option value='30Sec' <?php echo ((@$program->time_for_webcam == '30Sec') ? 'selected' : '');?> >30 Seconds</option>
            <option value='1min' <?php echo ((@$program->time_for_webcam == '1min') ? 'selected' : '');?>>1 Minutes</option>
            <option value='5min' <?php echo ((@$program->time_for_webcam == '5min') ? 'selected' : '');?>>5 Minutes</option>
            <option value='10min' <?php echo ((@$program->time_for_webcam == '10min') ? 'selected' : '');?>>10 Minutes</option>
            </select>
          </div>
          <p class="p1"> How frequently you want to take the WebCam Shots and Screenshots</p>
        </div>
<!-- new code start -->

        <div class="form-group" style="<?php echo $display; ?>" id="show_resultDiv">
                    <label for="field-ta" class="col-sm-3 control-label"> Moderate Exam :</label>
						<div class="col-sm-offset-3 col-sm-5" style="margin-left:0;">
							<div class="checkbox">
								<label>									
                                    <input id="show_result" name="show_result"  type="checkbox" <?php echo ($this->input->post('show_result')) ? "checked" : isset($program->show_result) && $program->show_result == '1' ? "checked" : '';?>>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="showresult_option-target" class="tooltipicon" title="Click Here"></span>
						<span class="showresult_option-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo"Show Final Exam Result";?>
						<!--/tip containt-->
						</span>
						</span>

<!-- tooltip area finish -->
						</label>
						</div>							
						</div>

						<div class="col-sm-4">
							<p class="p1">(This Functionality will Show or Pending Final Exam Result)</p>
						</div>
					</div>
	<!--exam section end here -->
	<!--certifition section start here -->
	<div class="form-group">
						<label class="col-sm-3 control-label" >Certificate Term :</label>
						<div class="col-sm-5">
						<select class="form-control" onchange="javascript:certificatemessage(this.selectedIndex)" name="certificate_setts" id="certificate_setts">
						<option value="1" <?php echo ($this->input->post('certificate_setts') == '1') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '1' ) ? "selected=selected" : '' ?> >No Certificate</option>
						<option value="2" <?php echo ($this->input->post('certificate_setts') == '2') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '2' ) ? "selected=selected" : '' ?> >After successful completion of all lectures</option>
						<option value="3" <?php echo ($this->input->post('certificate_setts') == '3') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '3' ) ? "selected=selected" : '' ?> >After passing the final exam</option>
						<option value="4" <?php echo ($this->input->post('certificate_setts') == '4') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '4' ) ? "selected=selected" : '' ?> >After passing the exams on an average </option>
						<option value="5" <?php echo ($this->input->post('certificate_setts') == '5') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '5' ) ? "selected=selected" : '' ?> >After finishing all the lectures and passing the final exam</option>
						<option value="6" <?php echo ($this->input->post('certificate_setts') == '6') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '6' ) ? "selected=selected" : '' ?> >After finishing all the lectures and passing all the exams on an average </option>
						</select>
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="certificate_setts-target" class="tooltipicon" title="Click Here"></span>
						<span class="certificate_setts-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_certificate-term');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
						<div class="col-sm-4"> 
							<p class="p1">This is the live class mode for taking live classes, if you wish to include live class in your course please select "Active". You can schedule and edit live classes / webinars for each lectures from <a href="<?php echo base_url(); ?>programs/lists/">Course you Teach</a></p>
						</div> 
					</div>

                    
                    <div class="form-group" style="display:none;" id="coursecertifiactemsg">
						<label for="field-ta" class="col-sm-3 control-label">Certificate course message</label>						
						<div class="col-sm-5">							
                            <textarea maxlength="7000" rows="4" cols="50" name="coursemessage" id="coursemessage" class="form-control"><?php echo set_value('certificate_course_msg', (isset($program->certificate_course_msg)) ? $program->certificate_course_msg : ''); ?></textarea>
						</div>
					</div>
	<!--certifition section end here -->
<!-- excercise file section start here -->
<!--webinar section start here -->

			<?php
				$this->load->config('features_config');
				$webinar = $this->config->item('webinar');				
				
				if($webinar['status']==TRUE)
				{
			?>
			<div class="seperator"></div>
			<legend class="tile_fld"> Webinar Settings</legend>
<div class="form-group"> 
					<label for="field-1" class="col-sm-3 control-label">Webinar Status :</label> 
					<div class="col-sm-5"> 
						<div class="radio"> 
							<label> <input type="radio" onclick="javascript:getWebDesc(this.value)" name="webstatus" id="webstatusactive" value="active" <?php

                               if($this->input->post('webstatus')=='active')

                               {

                                echo 'checked';

                               }

                               else

                               {

                                if(isset($program->webstatus))

                                {

                                  if(($program->webstatus)=='active')

                                  {

                                      echo 'checked';

                                  }
                                  else{ echo ''; }



                                }
                                else{ echo ''; }

                               }

                                ?> />&nbsp;Active&nbsp;&nbsp;</label> 
						</div> 
						<div class="radio"> 
							<label> <input type="radio" onclick="javascript:getWebDesc(this.value)" name="webstatus" id="webstatusinactive" value="inactive" <?php

                               if($this->input->post('webstatus')=='inactive')

                               {

                                echo 'checked';

                               }

                               else

                               {

                                if(isset($program->webstatus))

                                {

                                  if(($program->webstatus)=='inactive')

                                  {

                                      echo 'checked';

                                  }
                                  echo 'checked';

                                }
                                echo 'checked';



                             }

                                ?> />&nbsp;Inactive

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="webstatus-target" class="tooltipicon" title="Click Here"></span>

						<span class="webstatus-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->
						<?php echo lang('course_fld_webinar-status');?>
						</span>
						</span>

<!-- tooltip area finish --></label> 
						</div> 
					</div> 
				</div>
<?php } ?>
				<div class="form-group" id="desc_tr" style="<?php echo ((@$program->webstatus)=='active') ? "display:inline-block" : "display:none" ?>"> 
						<label for="field-ta" class="col-sm-3 control-label">Description:</label> 

						<div class="col-sm-5"> 

							 <?php //$this->ckeditor->editor("webnardescription",($this->input->post('webnardescription')) ? $this->input->post('webnardescription') : ((isset($program->webnardescription)) ? $program->webnardescription : ''));?>

							   <textarea class="form-control" rows="6" class="webnardescription" id="webnardescription" name="webnardescription"><?php echo ($this->input->post('webnardescription')) ? $this->input->post('webnardescription') : ((isset($program->webnardescription)) ? $program->webnardescription : '');?></textarea>
						
							   <!-- tooltip area -->

						<span class="tooltipcontainer" >

						<span type="text" id="webnardescription-target" class="tooltipicon" title="Click Here"></span>

						<span class="webnardescription-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_webinar-servic-description');?>

						<!--/tip containt-->

						</span>
						
						</span>
						
<!-- tooltip area finish -->
						</div>
						<div class="col-sm-4">
							<p class="p1">Here you can put a brief description of the agenda of the live classes.</p>
						</div> 
					</div>

<!--webinar section end here -->


<!-- Drip Course -->
	<div class="seperator"></div>
			<legend class="tile_fld"> Drip Course Settings</legend>
<div class="form-group"> 
					<label for="field-1" class="col-sm-3 control-label">Drip Course Status :</label> 
					<div class="col-sm-5"> 
						
						<div class="radio"> 
							<label> <input type="radio" name="dripstatus"  id="dripstatusactive" value="1" onclick="javascript:getDrip(this.value)"
								<?php echo (@$program->is_drip_course == '1') ? "checked" : "" ?> />&nbsp;Active&nbsp;&nbsp;</label> 
						</div> 
						<div class="radio"> 
							<label> <input type="radio"  name="dripstatus" id="dripstatusinactive" onclick="javascript:getDrip(this.value)"  value="0"
							<?php echo (@$program->is_drip_course == '') ? "checked" : "" ?> />&nbsp;Inactive

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="dripstatus-target" class="tooltipicon" title="Click Here"></span>

						<span class="dripstatus-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->
						<?php echo "Is Drip Course Active"; ?>
						</span>
						</span>

<!-- tooltip area finish --></label> 
						</div> 
					</div> 
				</div>	

				<div class="form-group" id="drip_opt" style = "<?php if(@$program->is_drip_course == '1') { echo "display:inline-block"; } else { echo "display:none"; } ?>" > 
                    <label class="col-sm-3 control-label" requierd>Drip By :</label> 

                    <div class="col-sm-offset-2 col-sm-5 "> 
                    <select data-toggle="tooltip" data-placement="bottom" title="Schedule Lesson Delivery" id="lecture_type" name="release_type" class="form-control"  size="1" onchange="javascript:driptype(this.selectedIndex)">
                <option value="" <?php echo (@$program->release_type == '') ? "selected" : "" ?> >Select Type</option>
                <option value="1"  <?php echo (@$program->release_type == '1') ? "selected" : "" ?> >Drip by date</option>
                <option value="2"  <?php echo (@$program->release_type == '2') ? "selected" : "" ?>>Drip by days</option>
               <!--  <option value="exam">Exam</option> -->
                </select>
                   
                     <!--  <span class="tooltipcontainer" style="right: -200%;"> 
                            <span type="text" id="date-target1" class="tooltipicon"></span> 
                            <span class="date-target1  tooltargetdiv" style="display: none;" > 
                              <span class="closetooltip"></span>  -->
                          
                          <!--tip containt -->
                          
                          <?php //echo "Schedule Lesson Delivery ";?> 
                          
                          <!--/tip containt--> 
                          
                        <!--   </span> </span>   -->
                </div>
          </div>


<!-- Drip Course end -->

<!-- <div style="  overflow: hidden;">  -->
<!-- <div> 

		<div class="panel-heading"> 
			
			<div style="margin-top: 10px; margin-bottom: 10px;"> 
			<div class="seperator"></div>
		<legend class="tile_fld"> Exercise Files</legend>
			
			<a  style="margin-left:15px;" href = "<?php echo base_url(); ?>medias/addmedia/" class='existingfiles btn btn-success'>Select from existing files</a>
				<a href = "<?php echo base_url(); ?>medias/createexercisefile/" class='<?php echo "newexercise";?> btn btn-success'>Add New exercise file </a>
				
			</div> 
		</div> 
		<div style="overflow: auto;margin-left:15px;margin-right:15px;">
			<table id="myTable" class="table table-bordered table-responsive"> 
				<thead> 
					<tr> 
						<th align="center">#</th>

            					<th>Type</th>

            					<th>

									<strong>File/Media name</strong>

								</th>

            					

            					<th>

									<strong>Remove</strong>

								</th>
 
					</tr> 
				</thead> 
				<tbody id="rowsmedia">

							<tr>

            					
          					</tr>

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

                               <td align="center">

                                    <?php echo $media->id ?>

                                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>

                               <td>

                                     <?php echo $img_type ?>

                               </td>

                               <td>

                                    <?php echo $media->name ?>

                               </td>



                               <td>

                                   <?php if($media->published){?>

                                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>">

                                    <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">

                                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>



                                    <?php }else{?>

    								<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none">

                                    <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">

                                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

                            		<?php }?>

                             </td>

                            

                             <td>

                                     <select name="access[]">

                                     <option value="0" <?php if(isset($media->access) && $media->access == 0) echo "selected"; ?>>Students</option>

                                     <option value="1" <?php if(isset($media->access) && $media->access == 1) echo "selected"; ?>>Members</option>

                                     <option value="2" <?php if(isset($media->access) && $media->access == 2) echo "selected"; ?>>Guests</option>

                                     </select>

                             </td>

                             <td>

										<a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>

                              </td>

                            </tr>



                             <?php

                             }

                            }

                          }
                          	
       					

                          if($updType == 'edit'){
                          	$get_media_ids2 = explode(',',$program->programmedias);
                          if(isset($get_media_ids2) && $get_media_ids2!= ''){

                          $nums = 0;
                          		
                          foreach($get_media_ids2 as $get_media_id){

                          $nums++;

                          $getMedia = $this->medias_model->getMediaExeFile_new($get_media_id);
                          

                          foreach($getMedia as $media){   ?>

                          <tr id="tr<?php echo $media->id;?>">

                               <td>

                                    <?php echo $media->id ?>

                                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>

                               <td>
                        <?php  
	                  	$filename = $media->media_title;
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						
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

                               <td>

                                    <?php echo $media->alt_title ?>

                               </td>
                            

                            <td>

                                    <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>

                            </td>

                            </tr>



                               <?php }

                              }

                           }else{

						   $nums = 0;

                           foreach($medias as $media){

						   $nums++;

                           ?>

                           
                            <tr id="tr<?php echo $media->id;?>" <?php echo $display_none; ?>>

                               <td>

                               <?php echo $media->id ?>

                               <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>

                               <td>

                               <?php echo $img_type ?>

                               </td>

                               <td>

                               <?php echo $media->name ?>

                               </td>



                               <td>

                               <?php if($media->published){?>

                                <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>">

                                <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">

                                <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>


                                <?php }else{?>

								<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none">

                                <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">

                                <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

                        		<?php }?>





                             </td>

                            

                              <td>

                                <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>
                              </td>
                            </tr> <?php } } }?>
						</tbody>
			</table>
			<input id="mediafiles" name="mediafiles" value="<?php echo ($this->input->post('mediafiles') ? $this->input->post('mediafiles') : '')?>" type="hidden">
		</div>  -->
<!-- excercise file section end here -->
<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 

<div class="panel-heading"> 
<div class="seperator" style="padding-top:6px;"></div>
<legend class="tile_fld"> Course Requirement / Pre-requisites</legend>
	<div class="panel-title" style="padding-bottom: 5px;padding-top:0px;">
		<p style="margin-bottom: 0px;margin-top:0px;">In case you feel that this is an advanced course and requires completion of other basic course for better understanding to students then click on the button to add the pre-requisite course. Once you save this, then only those student who have completed those course will be able to apply.</p>
	</div> 
</div>

<div class="panel-body with-table">

	<table class="table table-bordered table-responsive">
	<tbody>
		<tr>

                <td width="15%" valign="top">

                    Prerequisites Course(s):

                </td>

                <td>

                    <div style="float:left;">

                          <a href = "<?php echo base_url(); ?>medias/addcourse/" class='<?php echo "addcourse";?> btn btn-info'>Add Course </a>
                          <!-- 

						<span class="tooltipcontainer">

						<span type="text" id="prerequisites_Course-target" class="tooltipicon" title="Click Here"></span>

						<span class="prerequisites_Course-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>



						<?php echo lang('course_fld_prerequisites-Course');?>


						</span>

						</span>-->

                    </div>


                    <div style="float:left;">

                    </div>

                <br><br>

                <?php

                $table_display = "table";

                ?>

                 <table id="table_courses_id"  class="table table-bordered responsive">

                        <tbody id="rowspreq">

                            <?php //if(isset($media_files)) {?>

                            <tr>

                                <td width="8%"><strong>ID</strong></td>

                                <td width="56%"><strong>Name</strong></td>

                                <td width="12%"><strong>Remove</strong></td>

                            </tr>



                             <?php //} ?>

                           <?php

                           if($updType == 'create' && isset($get_req_ids) && $get_req_ids!= ''){

                           foreach($get_req_ids as $get_req_id){

                           $getRequisites = $this->medias_model->getRequProduct($get_req_id);

                           foreach($getRequisites as $rerequisite){

                           ?>

                           <tr id="tr<?php echo $rerequisite->id;?>" <?php echo $display_none; ?>>

                               <td><?php echo $rerequisite->id ?></td>

                               <td><?php echo $rerequisite->name ?></td>

                               <input type="hidden" name="req_id[]" id="req_id" value="<?php echo $rerequisite->id ?>">

                              <td>

                                <a href="javascript:void(0);" class="removeele" id="remove<?php echo $rerequisite->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>

                              </td>

                            </tr> <?php } } }?>

                            <?php

                           if($updType == 'edit'){
                           	$get_req_ids1 = explode(',',$program->prerequisitesfiles);
                           	
                            if(isset($get_req_ids1) && $get_req_ids1!= ''){

                               foreach($get_req_ids1 as $get_req_id){

                               $getRequProduct = $this->medias_model->getRequProduct($get_req_id);

                               foreach($getRequProduct as $getProduct){

                               ?>

                            <tr id="tr<?php echo $getProduct->id;?>" <?php echo $display_none; ?>>

                               <td><?php echo $getProduct->id ?></td>

                               <td><?php echo $getProduct->name ?></td>

                               <input type="hidden" name="req_id[]" id="req_id" value="<?php echo $getProduct->id ?>">

                              <td>

                                <a href="javascript:void(0);" class="removeele" id="remove<?php echo $getProduct->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>

                              </td>

                            </tr>



                             <?php }

                             } }else{

                             //foreach($rerequisites as $rerequisite){

                           ?>

                          <!--  <tr id="tr<?php echo $rerequisite->id;?>" <?php echo $display_none; ?>>

                               <td><?php echo $rerequisite->id ?></td>

                               <td><?php echo $rerequisite->name ?></td>

                               <input type="hidden" name="req_id[]" id="req_id" value="<?php echo $rerequisite->id ?>">

                              <td>

                                <a href="javascript:void(0);" class="removeele" id="remove<?php echo $rerequisite->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>

                              </td>

                            </tr>  -->

                            <?php //}

                            }  }



                            ?>

                       </tbody>



                             <input id="preqfiles" name="preqfiles" value="<?php echo ($this->input->post('preqfiles') ? $this->input->post('preqfiles') : '')?>" type="hidden">





                    </table>



                </td>



            </tr>
	</tbody>

	</table> 	 

</div> 


<div class="panel-body form-horizontal form-groups-bordered"> 
<div class="form-group"> 
	<label for="field-1" class="col-sm-3 control-label">Other Prerequisites / Basic Requirements :</label> 
	
	<div class="col-sm-5"> 
		<?php //$this->ckeditor->editor("pre_req",($this->input->post('pre_req')) ? $this->input->post('pre_req') : ((isset($program->pre_req)) ? $program->pre_req : ''));?>
		<textarea name="pre_req" id="pre_req" class="form-control editor1" ><?php echo $this->input->post('pre_req') ? $this->input->post('pre_req') :((isset($program->pre_req)) ? $program->pre_req : ''); ?></textarea>
	<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="pre_req-target" class="tooltipicon" title="Click Here"></span>

						<span class="pre_req-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_other-prerequisites');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
	</div> 
</div>

<div class="form-group"> 
	<label for="field-1" class="col-sm-3 control-label">Prerequisites Books:</label> 
	
	<div class="col-sm-5"> 
	<?php //$this->ckeditor->editor("pre_req_books",($this->input->post('pre_req_books')) ? $this->input->post('pre_req_books') : ((isset($program->pre_req_books)) ? $program->pre_req_books : ''));?>

                   <textarea class="form-control" style="" id="pre_req_books" name="pre_req_books" aria-hidden="true"><?php echo $this->input->post('pre_req_books') ? $this->input->post('pre_req_books') :((isset($program->pre_req_books)) ? $program->pre_req_books : ''); ?></textarea>
		<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="pre_req_books-target" class="tooltipicon" title="Click Here"></span>

						<span class="pre_req_books-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_prerequisites-books');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
	</div> 
</div>

<div class="form-group"> 
	<label for="field-1" class="col-sm-3 control-label">Misc Requirements:</label> 
	
	<div class="col-sm-5"> 
	 <?php //$this->ckeditor->editor("reqmts",($this->input->post('reqmts')) ? $this->input->post('reqmts') : ((isset($program->reqmts)) ? $program->reqmts : ''));?>

                    <!--<textarea class="stinput" id="reqmts" style="" rows="6" name="reqmts">   -->

                    <?php //echo $this->input->post('reqmts') ? $this->input->post('reqmts') :((isset($program->reqmts)) ? $program->reqmts : ''); ?>

<!--</textarea>-->

					<!--<input type="hidden" id="preqfiles" name="preqfiles" value="">   -->



                    <textarea name="reqmts" id="reqmts" class="form-control"><?php echo $this->input->post('reqmts') ? $this->input->post('reqmts') :((isset($program->reqmts)) ? $program->reqmts : ''); ?></textarea>
		<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reqmts-target" class="tooltipicon" title="Click Here"></span>

						<span class="reqmts-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('course_fld_misc-requirements');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
	</div> 
</div>

		<!-- <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab7"> 
							<a href="#webinar" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div>  -->

</div>

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

   function getDrip(i) 
  {
  	  	
     if(i == "1")
	 {
	    document.getElementById('drip_opt').style.display = "inline-block";
	 }
	 else{
	 
	    document.getElementById('drip_opt').style.display = "none"; 
	   
	 }
  }


function driptype(setvalue)
{
	var selvalue = document.getElementById("certificate_setts").selectedIndex;

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
$(document).ready(function(){
showhidewebinar();
});
function showhidewebinar()
{
  	var selvalue = document.getElementById("final_quizzes").selectedIndex;
  	
	if(selvalue == 0)
	{
		document.getElementById("webcamDiv").style.display="none";
		document.getElementById("show_resultDiv").style.display="none";		
		document.getElementById("timewebcam").style.display="none";
		

    		$("#certificate_setts option[value='3']")
    		.attr("disabled", "disabled");
    		 $("#certificate_setts option[value='5']")
    		.attr("disabled", "disabled");
   				
   		 $("#certificate_setts option[value='3']").prop("selected",false); 
   		 $("#certificate_setts option[value='5']").prop("selected",false);
		
	}
	else
	{
		document.getElementById("webcamDiv").style.display="block";
		document.getElementById("show_resultDiv").style.display="block";

		  var tt = $('#webcam_option').is(":checked");
		  if(tt==true)
		  {
		  	document.getElementById("timewebcam").style.display="block";
		  }

		  $("#certificate_setts option[value='3']")
    		.removeAttr("disabled");
    		 $("#certificate_setts option[value='5']")
    		.removeAttr("disabled");
	}
  }

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
  	var learn_pnt = $j('#todolist').val();
  	// alert(learn_pnt);
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
							  		
				  				  $j.confirm
				  				  ({
									    title: '<div class="title-font">Great you have setup new course successfully!</div>',
									    content: '   ',

									    confirmButton: 'START ADDING LECTURES',
						    			cancelButton: 'NO, DO THIS LATER',
						    			confirmButtonClass: 'yes-btn btn-success',
						    			cancelButtonClass: 'no-btn btn-danger',
						    			backgroundDismiss: false,
						    			 onOpen: function(){
										   // this.$confirmButton.after('');
										   // this.$title.css('height', '80px');
										   this.$cancelButton.after('<p style="float:left;width: 49%;">(Course can have course content as lectures or exams)</p><p style="float:right;width: 43%;">(Bring me back to Course list)</p>');
										},
						    			confirm: function()
						    			{
									        //alert('confirmed');
									         $j("#submit").click(); 
									         
									         $j(".jconfirm-box-container").css("display", "none");
									         return true;
									    },
									    cancel:function()
									    {
									        //alert('canceled');
									         $j("#redirect").click();
									          
									        $j(".jconfirm-box-container").css("display", "none");
									         return true;
									    }

									});
	  				 
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
			  				  $j.confirm({
							    title: '<div class="title-font">Great you have setup new course successfully!</div>',
							    content: ' ',

							    confirmButton: 'Yes',
				    			cancelButton: 'NO',
				    			confirmButtonClass: 'yes-btn btn-success',
				    			cancelButtonClass: 'no-btn btn-danger',
				    			backgroundDismiss: false,
				    			 onOpen: function(){
										   // this.$confirmButton.after('');
										   // this.$title.css('height', '80px');
										   this.$cancelButton.after('<p style="float:left;width: 49%;">(Course can have course content as lectures or exams)</p><p style="float:right;width: 43%;">(Bring me back to Course list)</p>');
										},
				    			confirm: function(){
							        //alert('confirmed');
							         $j("#submit").click(); 
							         
							         $j(".jconfirm-box-container").css("display", "none");
							         return true;
							    },
							    cancel:function(){
							        //alert('canceled');
							         $j("#redirect").click();
							          
							        $j(".jconfirm-box-container").css("display", "none");
							         return true;
							    }

							});
  				 
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
  				  $j.confirm({
			    title: '<div class="title-font">Great you have setup new course successfully!</div>',
			    content: '  ',

			    confirmButton: 'Yes',
    			cancelButton: 'NO',
    			confirmButtonClass: 'yes-btn btn-success',
    			cancelButtonClass: 'no-btn btn-danger',
    			backgroundDismiss: false,
    			onOpen: function(){
										   // this.$confirmButton.after('');
										   this.$cancelButton.after('<p style="float:left;width: 49%;">(Course can have course content as lectures or exams)</p><p style="float:right;width: 43%;">(Bring me back to Course list)</p>');
										},
	    			confirm: function(){
				        //alert('confirmed');
				         $j("#submit").click(); 
				         
				         $j(".jconfirm-box-container").css("display", "none");
				         return true;
				    },
				    cancel:function(){
				        //alert('canceled');
				         $j("#redirect").click();
				          
				        $j(".jconfirm-box-container").css("display", "none");
				         return true;
				    }

					});
  				 
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
   	selector : "#description, .editor1",
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

 $(".todolist").focus(function() {
    if(document.getElementById('todolist').value === ''){
        document.getElementById('todolist').value +='* ';
	}
});
$(".todolist").keyup(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        document.getElementById('todolist').value +='* ';
	}
	var txtval = document.getElementById('todolist').value;
	if(txtval.substr(txtval.length - 1) == '\n'){
		document.getElementById('todolist').value = txtval.substring(0,txtval.length - 1);
	}
});



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
    
    $("#file_p").change(function(){

        if( $('#file_p').val()!=""){
            // $('#submitbtn').click();
            $('#remove_id').show();
            $('#blah').show('slow');
            $('#imgname').hide('slow');
      }
        else{ $('#remove_id').hide();$('#blah').hide('slow');}
        readURL(this);
    });
  
    $('#remove_id').click(function(){
          $('#file_p').val('');
          $(this).hide();
          $('#blah').hide('slow');
		  $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
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



