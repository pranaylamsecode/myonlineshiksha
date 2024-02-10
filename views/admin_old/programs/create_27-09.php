<?php

$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
?>

<style type="text/css">

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
margin: 0 -165px auto !important;
}

.validateerrorbox
{
border-color: red !important;
}

	/*.p1
	{
		padding-left: 60px;
		margin-top: -33px;
	}
	.p2
	{
	text-align: -webkit-center; 
	 padding-right: 4px;
	}
	.p3
	{
		text-align: -webkit-center;
	    margin-right: 221px;
	    padding-left: 88px;
	    margin-top: -18px;
	}
	.psubtitle
	{
		padding-left: 21px;
	}
	.p4
	{

	}*/
</style>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
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

</script>
  
  
<div id="content-top"> 
  <!--<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
  <link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">
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

	var selvalue = document.getElementById("step_access_courses").selectedIndex;

	if(selvalue == '0')

	{

	document.getElementById("free_courses").style.display="table-row";
	document.getElementById("priceDiv").style.display="block";   
	document.getElementById("price_subs").style.display="block";
	}else

	{

	document.getElementById("free_courses").style.display="none";
	document.getElementById("priceDiv").style.display="none";
	document.getElementById("price_subs").style.display="none";
	}

}

</script> 



  <!--
<script type="text/javascript">

$(function() {

	$('#file_i').live('change',function(e) {

	 var ftpfilearray;

	 e.preventDefault();

		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>admin/programs/upload_image/',

		secureuri :false,

		fileElementId :'file_i',

		dataType : 'json',

		data : {

		'type' : $('select#type').val()

		},

		success : function (data, status)

		{

			if(data.status != 'error')

			{

			$('#msgstatus_i').html('<p>Reloading files...</p>');

			$('#file_i').val('');

			$('#msgstatus_i').html('');

			ftpfileoptions = '<img src="<?php echo base_url(); ?>/public/uploads/programs/img/'+data.ftpfilearray+'" width="150">';

			$('#localimage_i').html(ftpfileoptions);

			ftpfilearray = data.ftpfilearray;

			document.getElementById("imagename").value = ftpfilearray;

			//alert(document.getElementById("imagename").value);

			}

		}

		});

	 return false;

	});

});

</script>--> 

<h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>
  <!--
<script type="text/javascript">

			$(function(){

				$('dl.tabs dt').click(function(){

                    var tab_name = $(this).text();

                    //alert(text23);

                    if(tab_name == 'Description'){

                      $('#description').redactor();

                    }

                    if(tab_name == 'Requirements'){

                        $('#pre_req').redactor();

                        $('#pre_req_books').redactor();

                        $('#reqmts').redactor();

                    }

                    if(tab_name == 'Webinar Service'){

                      $('#webnardescription').redactor();

                    }

					var tab313 = $(this)

						.siblings().removeClass('selected').end()

						.next('dd').andSelf().addClass('selected');

                        //$('#pre_req_books').redactor();

                        //$('#reqmts').redactor();

				});

			});

</script>--> 
  
<script type="text/javascript">

	jQuery(document).ready(function(){
    
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




<script type="text/javascript">
/*
$(document).ready(function() {

	$(".unpublish, .publish").click(function() {

	  alert("test");

		var thisid = $(this).attr('id');

		var splitarray = thisid.split('-');

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
  <span class="clearFix">&nbsp;</span> </div>  
<?php
$attributes = array('class' => 'tform', 'id' => 'proform','onsubmit'=>'return formvalid()');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/programs/create', $attributes) : form_open_multipart(base_url().'admin/programs/edit/'.$id, $attributes);

$validation_errors = validation_errors();

$validationerrors = explode('.',$validation_errors);
?>
<div id="toolbar-box">
  <div class="m" style="float:left;">
    <?php 
	if($updType == 'create')
	{
        $pagetitle = 'Create New Course';
        echo"";
	}
	else
	{
		$pagetitle = 'Edit Course';
    }
	?>
    <div class="pagetitle">
      <h2><?php echo $pagetitle;?></h2>
      
    </div>
    <div class="pmaintitle">
    <p >If this is the first course you are creating then you need to create course categories through the <a href='<?php echo base_url();?>admin/pcategories/'>"Course Category Manager" </a> And teachers through the <a href='<?php echo base_url();?>admin/aclp/'>"Users and Permissions Manager"</a>  </p>
  </div>
  </div>
  <div id="sticky-anchor"></div>
  <div id="sticky" style="float:right;"> <?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?>
    <?php if ($updType == 'create'): ?>
    <?php if ($parent_id != "0"): ?>
    	<input type="submit" value="Save And Continue" name="save2" class='btn btn-success'>
    <a href='<?php echo base_url(); ?>admin/programs/' class='btn btn-default'>Cancel </a>
    <?php else: ?>
    <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='btn btn-default'></span>Cancel</a>
    <?php endif ?>
    <?php else: ?>
    <?php if ($parent_id != "0"): ?>
    	<input type="submit" value="Edit And Exit" name="edit2" class='btn btn-success'>
    <a href='<?php echo base_url(); ?>admin/programs/' class='btn btn-default'>Cancel</a>
    <?php else: ?>
    <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='btn btn-default'>Cancel</a>
    <?php endif ?>
    <?php endif ?>
    <div class="clr"></div>
  </div>
</div>
<div class="row">
<div class="col-md-6" style="width: 100%;">
  <ul class="nav nav-tabs bordered">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active"> <a href="#course_detail" data-toggle="tab"> <span class="visible-xs"><i class="entypo-home"></i></span> <span class="hidden-xs">Course Detail</span> </a> </li>
    <!--<li> <a href="#description_tab" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Description</span> </a> </li>-->
    <li> <a href="#image" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Upload Image</span> </a> </li>
    <li> <a href="#exercise" data-toggle="tab"> <span class="visible-xs"><i class="entypo-mail"></i></span> <span class="hidden-xs">Exercise files</span> </a> </li>
    <li> <a href="#ps" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Pricing / Subscriptions</span> </a> </li>
    <li> <a href="#publishing" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Publishing</span> </a> </li>
    <li> <a href="#mtags" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Meta Tags</span> </a> </li>
    <li> <a href="#requirements" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Requirements</span> </a> </li>
	<?php  
		$this->load->config('features_config');
		$webinar = $this->config->item('webinar');				
		
			if($webinar['status']==TRUE)
			{
	?>
    <li> <a href="#webinar" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Webinar Service</span> </a> </li>
	<?php
			}
	?>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="course_detail">
      <fieldset class="adminform form-horizontal form-groups-bordered">
        <?php if($updType == 'create'){

					$legend = ' ';

					}else{

					$legend = ' ';

					}?>
        <div class="form-group">
          <label class='col-sm-3 control-label' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
          <div class="col-sm-5">
            <input id="name" type="text" class="form-control" name="name" maxlength="256" value="<?php echo set_value('name', (isset($program->name)) ? $program->name : ''); ?>"  title="Enter Course Name" data-validation="required" data-validation-error-msg="Enter valid Question" />
            <span class="tooltipcontainer"> <span type="text" id="name-target" class="tooltipicon" title="Click Here"></span> <span class="name-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"> </span> <?php echo lang('course_fld_name');?> </span> </span> <span class="error"><?php echo form_error('name'); ?></span> </div>
        </div>
        <!--<div class="form-group">-->
          <!--<label class='col-sm-3 control-label' for="name"><?php //echo 'Alias'; //lang('web_name')?></label>
          <div class="col-sm-5">-->
            <input class="form-control" id="alias" type="hidden" name="alias" maxlength="256" value="<?php echo set_value('alias', (isset($program->alias)) ? $program->alias : ''); ?>" title="Enter Course alias name which is used as variable for course" />
           <!-- <span class="tooltipcontainer"> <span type="text" id="alias-target" class="tooltipicon" title="Click Here"></span> <span class="alias-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> -->
            
            <!--tip containt-> 
            
            <?php echo lang('course_fld_alias');?> </span> </span> </div>-->
        <!--</div>-->
        <!-- new code staart here -->
        <div class="form-group"  >
          <label class="col-sm-3 control-label" for="description"><?php echo lang('web_description')?></label>
          <div class="col-sm-5">
            <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
            <textarea name="description" id="description" class="form-control" rows="4"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea>
            
            <!-- tooltip area --> 
            
            <span class="tooltipcontainer"> <span type="text" id="description-target" class="tooltipicon" title="Click Here"></span> <span class="description-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            <!--tip containt--> 
            
            <?php echo lang('course_fld_description');?> </span> </span> <span class="error"><?php echo form_error('description'); ?></span> </div>
        </div>
        <!-- new code end here -->
        <div class="form-group">
          <label class='col-sm-3 control-label' for='category_id'><?php echo lang('web_category')?> <span class="required">*</span></label>
          <div class="col-sm-5">
            <select class='form-control' name='category_id' id='category_id' title="Select Course Category,category under which course comes"data-validation="required" data-validation-error-msg="Enter valid Question">
              <option value=''>Select</option>
              <?php				
							foreach ($categories as $category): ?>
              
              <!--<option value='<?php echo $category->catnew?>' <?php echo  preset_select('category_id', $category->catnew, (isset($program->catid)) ? $program->catid : $parent_id  ) ?>><?php echo $category->name?></option>-->
              <option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($program->catid)) ? $program->catid : ''  ) ?>><?php echo $category->name?></option>
              <?php endforeach ?>
            </select>
            <span class="tooltipcontainer"> <span type="text" id="category-target" class="tooltipicon" title="Click Here"></span> <span class="category-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            <!--tip containt--> 
            
            <?php echo lang('course_fld_category');?> </span> </span> <span class="error"><?php echo form_error('category_id'); ?></span> </div>
       <a href="<?php echo base_url(); ?>admin/pcategories/createcategory" id="cropcategory" class="newsect_pop btn btn-success" style="margin-left: 20px;">Create New Category</a>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label">Teacher<span class="required">*</span></label>
          <div class="col-sm-5">

            <select name='teacher_id' id='teacher_id' title="Select Trainer for current course" class="form-control" onchange="disableAssistant();" data-validation="required" data-validation-error-msg="Enter valid Question">
              	<option value=''><?php echo '- select -';?></option>
				<!--<option value='<?php echo $u_data['id']?>' <?php echo (@$program->author == $u_data['id']) ? 'selected' : ''  ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>-->
				<option value="<?php echo $u_data['id']?>" <?php echo ($this->input->post('teacher_id') == $u_data['id']) ? "selected=selected" : (isset($u_data['id'])) && @$program->author == $u_data['id'] ? "selected=selected" : '' ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>
				<?php foreach ($teachers as $teacher): ?>
				<!--<option value='<?php echo $teacher->userid?>' <?php echo (@$program->author == $teacher->userid) ? 'selected' : ''  ?>><?php echo $teacher->fullname?></option>-->
				<option value="<?php echo $teacher->userid;?>" <?php echo ($this->input->post('teacher_id') == $teacher->userid) ? "selected=selected" : (isset($teacher->userid)) && @$program->author == $teacher->userid ? "selected=selected" : '' ?>><?php echo $teacher->fullname;?></option>
				<?php endforeach ?>
            </select>
            
            <!-- tooltip area --> 
            
            <span class="tooltipcontainer"> <span type="text" id="teacher-target" class="tooltipicon" title="Click Here"></span> <span class="teacher-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            <!--tip containt--> 
            
            <?php echo lang('course_fld_teacher');?> </span> </span> <span class="error"><?php echo form_error('teacher_id'); ?></span> </div>
        </div>
        <!-- new field add for assistant teacher -->
                    <div class="form-group">
						<label class="col-sm-3 control-label">Assistant Teachers:</label>
						
						<div class="col-sm-5">
							
                   <?php							 
						// if($u_data['groupid'] == 4) 
						// {
                  	 if(isset($program->introtext)){

               		 $assistantid = explode('|',$program->introtext);

                		 }
							?>					
	                        <select class="form-control" name='assistant_id[]' id='assistant_id' title="Select Trainer for current course" multiple="multiple">
								<option value=''><?php echo '- select -';?></option>
								
								<option value="<?php echo $u_data['id']?>" <?php echo isset($program->introtext) && in_array($u_data['id'],$assistantid)? "selected" :""; ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>
								<?php foreach ($teachers as $teacher): ?>
								
								<option value="<?php echo $teacher->userid;?>"<?php echo isset($program->introtext) && in_array($teacher->userid,$assistantid) ? "selected":""; ?>><?php echo $teacher->fullname;?></option>
								<?php endforeach ?>
							</select>
							

						<span class="tooltipcontainer">

						<span type="text" id="level-target" class="tooltipicon" title="Click Here"></span>

						<span class="level-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>					

						<?php echo lang('course_fld_level');?>					

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
            
            <span class="tooltipcontainer"> <span type="text" id="level-target" class="tooltipicon" title="Click Here"></span> <span class="level-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            <!--tip containt--> 
            
            <?php echo lang('course_fld_level');?> </span> </span> </div>
        </div>
        <!-- <div class="form-group">
          <label class="col-sm-3 control-label">Skip Section pages :</label>
          <div class="col-sm-offset-3 col-sm-5" style="margin-left:0;">
            <?php

                $skip_module = (isset($program->skip_module)) ? $program->skip_module : '';

                $skipmod = ($this->input->post('skip_module')) ? $this->input->post('skip_module') : '';

                $skipmodule1 =  ($skipmod == '1') ? 'checked="checked"': '';

                $skipmodule2 =  ($skipmod == '0') ? 'checked="checked"': '';

                ?>
            <div class="radio" title="Hide Section Page(Section Summary) of Lecture">
              <input value="1" <?php echo ($skip_module == '1') ? 'checked="checked"' : $skipmodule1 ?> name="skip_module" type="radio">
              &nbsp;Yes&nbsp; </div>
            <div class="radio" title="Show Section Page(Section Summary) of Lecture">
              <input value="0" <?php echo ($skip_module == '0') ? 'checked="checked"' : $skipmodule2 ?> name="skip_module" type="radio">
              &nbsp;No </div><p class ="p1" style="">Clicking Yes would enable your student to skip the sections</p>
            
            
            
            <span class="tooltipcontainer"> <span type="text" id="skip_module-target" class="tooltipicon" title="Click Here"></span> <span class="skip_module-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            
            
            <?php echo lang('course_fld_skip-section-pages');?> </span> </span> </div>
        
        </div> -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Course Type :</label>
          <div class="col-sm-5">
            <?php

						$pcourse_type1 = ($this->input->post('course_type') == 0) ? 'selected="selected"' : '';

						$pcourse_type2 = ($this->input->post('course_type') == 1) ? 'selected="selected"' : '';

						?>
            <select class="form-control"  name="course_type" id="course_type">
              <option value="0" <?php echo ($this->input->post('course_type') == '0') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 0 ? 'selected="selected"' : $pcourse_type1) ?>> Non-Sequential </option>
              <option value="1" <?php echo ($this->input->post('course_type') == '1') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 1 ? 'selected="selected"' : $pcourse_type2) ?>> Sequential</option>
            </select>
            
            <!-- tooltip area --> 
            
            <span class="tooltipcontainer"> <span type="text" id="course_type-target" class="tooltipicon"></span> <span class="course_type-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            <!--tip containt--> 
            
            <?php echo lang('course_fld_course-type');?> </span> </span> </div>
       <p  class = "p2">Select whether the course lectures will be available to the students in a pre-defined sequence only or can access in non-sequential manner</p>
        </div>
        <!--<div class="form-group" style="display:none;" id="lessons_release_td">
          <label class="col-sm-3 control-label">Lecture release :</label>
          <div class="col-sm-5">
            <select class="form-control" onchange="javascript:alertfunction()" name="lesson_release" id="lesson_release">
              <option value="0" <?php echo ($this->input->post('lesson_release') == '0') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '0' ? 'selected="selected"' : '' ?>>All at once</option>
              <option value="1" <?php echo ($this->input->post('lesson_release') == '1') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '1' ? 'selected="selected"' : '' ?>>One lesson per day</option>
              <option value="2" <?php echo ($this->input->post('lesson_release') == '2') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '2' ? 'selected="selected"' : ''?>>One lesson per week</option>
              <option value="3" <?php echo ($this->input->post('lesson_release') == '3') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '3' ? 'selected="selected"' :'' ?>>One lesson per month</option>
            </select>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="form-group" style="display:none;" id="lessons_show_td">
          <label class="col-sm-3 control-label">Lecture that are't released should show as :</label>
          <div class="col-sm-5">
            <select class="form-control" name="lessons_show" id="lessons_show">
              <option value="1" <?php echo ($this->input->post('lessons_show') == '1') ? "selected=selected" : (isset($program->lessons_show)) && $program->lessons_show == '1' ? "selected=selected" : ''?>>Grayed out text</option>
              <option value="2" <?php echo ($this->input->post('lessons_show') == '2') ? "selected=selected" : (isset($program->lessons_show)) && $program->lessons_show == '2' ? "selected=selected" : ''?>>Should not show</option>
            </select>
          </div>
        </div>-->
        <div style="clear:both;"></div>
        <div class="form-group">
          <label class="col-sm-3 control-label">Final Exam :</label>
          <div class="col-sm-5">
            <select name="final_quizzes" id="final_quizzes" class="form-control" onchange="<?php if($facility == 'foolproof') { echo 'webcamVisiable()'; } ?>">
              <option value="0">no final exam</option>
              <?php foreach($finalexamlist as $finalexam){ ?>
              <option value="<?php echo $finalexam->id;?>" <?php echo ($this->input->post('final_quizzes') == $finalexam->id) ? "selected=selected" : (isset($program->id_final_exam)) && $program->id_final_exam == $finalexam->id ? "selected=selected" : '' ?>><?php echo $finalexam->name;?></option>
              <?php }?>
            </select>
            
            <!-- tooltip area --> 
            <span class="tooltipcontainer"> <span type="text" id="final_quizzes-target" class="tooltipicon" title="Click Here"></span> <span class="final_quizzes-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            <!--tip containt--> 
            <?php echo lang('course_fld_final-exam');?> </span> </span> </div>
        <p class="p2">if you want to include the final exam you will need to create exam through <a href="<?php echo base_url();?>admin/quizzes/">"Exam Manager"</a></p>
        </div>
        <div style="clear:both;"></div>
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
            <span class="tooltipcontainer"> <span type="text" id="certificate_setts-target" class="tooltipicon" title="Click Here"></span> <span class="certificate_setts-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            <!--tip containt--> 
            <?php echo lang('course_fld_certificate-term');?> </span> </span> 
            
            <!--
							<td style="display:none;" id="avg_certificate">
								<input value="70" id="avg_cert" name="avg_cert" size="5px;" type="text"> &nbsp;%
							</td>
							<tr style=" display:none;" id="coursecertifiactemsg">

									<td>Certificate course message</td>

									<td><textarea maxlength="7000" rows="4" cols="50" name="coursemessage" id="coursemessage"><?php echo set_value('certificate_course_msg', (isset($program->certificate_course_msg)) ? $program->certificate_course_msg : ''); ?></textarea>

									</td>

							</tr>--> 
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="form-group" style="display:none;" id="coursecertifiactemsg">
          <label class="col-sm-3 control-label" >Certificate course message</label>
          <div class="col-sm-5">
            <textarea maxlength="7000" name="coursemessage" id="coursemessage" class="form-control"><?php echo set_value('certificate_course_msg', (isset($program->certificate_course_msg)) ? $program->certificate_course_msg : '');?></textarea>
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
        <div class="form-group" id = "webcamDiv" style="<?php echo $display;?>" >
          <label for="field-ta" class="col-sm-3 control-label">Webcam & Screenshots Option :</label>
          <div class="col-sm-offset-3 col-sm-5" style="margin-left:0;">
            <div class="checkbox">
              <label>
                <input id="webcam_option" name="webcam_option" type="checkbox" onclick='hideShowWebcamTime();' <?php echo ($this->input->post('webcam_option')) ? "checked" : isset($program->webcam_option) && $program->webcam_option == '1' ? "checked" : '';?>  >
                
                <!-- tooltip area --> 
                <span class="tooltipcontainer"> <span type="text" id="webcam_option-target" class="tooltipicon" title="Click Here"></span> <span class="webcam_option-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                <!--tip containt--> 
                <?php echo lang('course_fld_webcam-option');?> </span> </span> </label>
            </div>
          </div>
          <p style="text-align: -webkit-right;"> (This Functionality will take screenshots and webcam shots of the examinees during an exam to ensure full proof evalution)</p>
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
          <p style=""> How frequently you want to take the WebCam Shots and Screenshots</p>
        </div>
        <div style="clear:both;"></div>

        <div class="form-group" id = "showresultDiv" style="<?php echo $display;?>" >
          <label for="field-ta" class="col-sm-3 control-label">Moderate Exam :</label>
          <div class="col-sm-offset-3 col-sm-5" style="margin-left:0;">
            <div class="checkbox">
              <label>
                <input id="show_result" name="show_result" type="checkbox" <?php echo ($this->input->post('show_result')) ? "checked" : isset($program->show_result) && $program->show_result == '1' ? "checked" : '';?>  >
                
                <!-- tooltip area --> 
                <span class="tooltipcontainer"> <span type="text" id="show_result-target" class="tooltipicon" title="Click Here"></span> <span class="show_result-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                <!--tip containt--> 
                <?php echo lang('course_fld_webcam-option');?> </span> </span> </label>
            </div>
          </div>
          <p style="text-align: -webkit-right;"> (This Functionality will Show or Pending Exam)</p>
        </div>

        <?php if($updType == 'create'){

            $legend = ' ';

			}else{

            $legend = ' ';

			}?>
        <!-- <div class="form-group"  >
          <label class="col-sm-3 control-label" for="description"><?php echo lang('web_description')?></label>
          <div class="col-sm-5">
            <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
            <textarea  name="description" id="description" class="form-control" rows="4"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea>
            
           
            
            <span class="tooltipcontainer"> <span type="text" id="description-target" class="tooltipicon" title="Click Here"></span> <span class="description-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            
            
            <?php echo lang('course_fld_description');?> </span> </span> <span class="error"><?php echo form_error('description'); ?></span> </div>
        </div> -->
        <br />
        <br />
        <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab1"> 
							<a href="#image" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 
        <div style="clear:both;"></div>       
      </fieldset>
    </div>
    <!--<div class="tab-pane" id="description_tab" >
      <fieldset class="adminform form-horizontal form-groups-bordered">
        
      </fieldset>
    </div>-->
	
	
    <div class="tab-pane" id="image">
      <dd class="" sno="3">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <?php if($updType == 'create'){

							$legend = ' ';

						}else{

							$legend = ' ';

					}?>
            <legend><?php echo $legend; ?></legend>
            <table class="table table-bordered datatable dataTable">
              <tbody>
                <tr>
                  <td align="left" width="15%"><label for="image" class="labelform">Upload Image</label>
                    <?php //echo ($this->input->post('imagename')) ? $this->input->post('imagename') : (isset($program->image)) ? $program->image : ''; ?>
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
                  <td><div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
                      <div id="localimage_i">
                        <?php if ($updType == 'edit'){ ?>
                        <img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ?>" width="150" name="imagename" id="imagname">

                        <div><a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo $this->uri->segment(4);?>/courseedit" class="upimg_pop btn btn-success">Upload Image</a></div>

						<img id="blah" src="#" alt="your image" width="150" />
                        <?php }else{  ?>
                        <img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg' ?>" width="150" name="imagename" id="imagname">
                        <div><a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo $this->uri->segment(4);?>/coursecreate" class="upimg_pop btn btn-success">Upload Image</a></div>
						<img id="blah" src="#" alt="your image" width="150" />
						<input type="hidden" name="cropimage" id="cropimage" value="no_images.jpg" >
                        <?php } ?>
                      </div>
                      <br />
                      <input type="file" name="file_i" id="file_i" class="upload_btn" style="display: none;" >			
					  <input type='button' id='remove_id' value='remove' class="btn btn-danger"/>
                      <span class="tooltipcontainer"> 
                  		<span type="text" id="imgname-target" class="tooltipicon" title="Click Here"></span> 
                  		<span class="imgname-target  tooltargetdiv" style="display: none;" > 
                  			<span class="closetooltip"></span> <?php echo lang('course_fld_add-image');?> 
                  		</span> 
                  	</span> 
                    </div>
                    
                    </td>
                  <td style="vertical-align: top;">
                  	
                  	<span class="error"><?php echo form_error('file_i'); ?></span>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab2"> 
							<a href="#exercise" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 
          </fieldset>

        </div>

      </dd>
    </div>
	
	
	
    <div class="tab-pane" id="exercise">
      <dd class="" sno="4">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <?php if($updType == 'create'){

                $legend = ' ';

            }else{

                $legend = ' ';

            }?>
            <legend><?php echo $legend; ?></legend>
            <a href = "<?php echo base_url(); ?>admin/medias/addmedia/<?php //echo $program->id; ?>" class='btn btn-info exifiles_pop'>Select from existing files</a> 
            <a href = "<?php echo base_url(); ?>admin/medias/createexercisefile/<?php //echo $program->id; ?>" class='btn btn-success newexe_pop'>Add new exercise file </a> 
            <div style="clear:both">
            <!-- tooltip area --> 
            
           <!-- <span class="tooltipcontainer"> 
            	<span type="text" id="exercise_files-target" class="tooltipicon" title="Click Here">
            		
            	</span> 
            	<span class="exercise_files-target  tooltargetdiv" style="display: none;" > 
            	<span class="closetooltip">		
            	</span>            
           
            
            <?php echo lang('course_fld_add-exercise-file');?> </span> 
            </span>-->
            
            <br />
            <table class="table table-bordered datatable dataTable" id="myTable">
              <thead>
                <tr>
                  <th align="center">#</th>
                  <th align="center">Type</th>
                  <th align="center"><strong>File/Media name</strong></th>
                  <th align="center"><strong>Published</strong></th>
                  <!-- <th align="center"> 
                  	<div align="center">
                      <div style="float:left;"> <strong>Order2</strong> </div>
                      <div style="float:left;"> 
                        
                        
                        
                      </div>
                    </div>
                  </th> -->
                  <!-- <th align="center"><strong>Guest Access</strong></th> -->
                  <th align="center"><strong>Remove</strong></th>
                  <th></th>
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
                    
                    <!--</a>  -->
                    
                    <?php }else{?>
                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">
                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
                    <?php }?></td>
					<!-- <td>order3</td> -->
					<!-- <td>
						<select name="access[]">
						  <option value="0" <?php if(isset($media->access) && $media->access == 0) echo "selected"; ?>>Students</option>
						  <option value="1" <?php if(isset($media->access) && $media->access == 1) echo "selected"; ?>>Members</option>
						  <option value="2" <?php if(isset($media->access) && $media->access == 2) echo "selected"; ?>>Guests</option>
						</select>
					</td> -->
					<td><a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a></td>
                </tr>
                <?php
                }
				}
				}

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
                  <td><?php echo $media->id ?>
                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>"></td>
                  <td><?php echo $img_type ?></td>
                  <td><?php echo $media->alt_title ?></td>
                  <td><?php if($media->publish){?>
                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">
                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
                    
                    <!--</a>  -->
                    
                    <?php }else{?>
                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">
                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
                    <?php }?></td>
					<!-- <td>order</td> -->
					<!-- <td>
						<select name="access[]">
						  <option value="0" <?php if(isset($media->access) && $media->access == 0) echo "selected"; ?>>Students</option>
						  <option value="1" <?php if(isset($media->access) && $media->access == 1) echo "selected"; ?>>Members</option>
						  <option value="2" <?php if(isset($media->access) && $media->access == 2) echo "selected"; ?>>Guests</option>
						</select>
					</td> -->
					<td><a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a></td>
                </tr>
                <?php 
				}
                }
                }
				else
				{
					$nums = 0;
                    foreach($medias as $media)
					{
						$nums++;
                        ?>
					<!--<tr id="addmediatext">  -->
					
					<tr id="tr<?php echo $media->id;?>" <?php echo $display_none; ?>>
						<td><?php echo $media->id ?>
						<input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>"></td>
						<td><?php echo $img_type ?></td>
						<td><?php echo $media->name ?></td>
						<td><?php if($media->published){?>
						<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">
						<input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
						
						<!--</a>  -->
						
						<?php }else{?>
						<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none"> <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">
						<input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>
						<?php }?></td>
						<!-- <td>order</td> -->
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
					<?php 
					} 
				}
				}?>
              
              <input id="mediafiles" name="mediafiles" value="<?php echo ($this->input->post('mediafiles') ? $this->input->post('mediafiles') : '')?>" type="hidden">
              </tbody>
            </table>
            <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab3"> 
							<a href="#ps" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div>  
          </fieldset>
        </div>
      </dd>
    </div>
    <div class="tab-pane" id="ps">
      <dd class="" sno="5">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered" >
           <p class="psubtitle"> Through this option you can choose to make the course free for all students/free for some students and Paid for other /paid for all.</p>
            <!--@@@@@@@@@@@@@ new code start here @@@@@@@@@@@@@-->
            <!--<div class="form-group" >
            	<input class="col-sm-1" id="chb_free_courses" name="chb_free_courses" type="checkbox" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : '';?>>
            	<p class="col-sm-2">This course is free for students</p> 
            	<select class="col-sm-3" id="step_access_courses" name="step_access_courses" onchange="javascript:showhidecourse(this.value);">
                  <option value="0" <?php echo ($this->input->post('step_access_courses') == '0') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "selected" : ''; ?>>Students</option>
                  <option value="1" <?php echo ($this->input->post('step_access_courses') == '1') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "selected" : ''; ?>>All Students</option>
                </select>
                <label >Of</label>



            </div>-->
            <!-- @@@@@@@@@ new code end here @@@@@@@@@@  -->
            <div class="form-group">

			  
			  
              <label class="col-sm-3 control-label"></label>
			   
              <div class="col-sm-5">
			    
                <?php
        //($this->input->post('chb_free_courses')? $this->input->post('chb_free_courses') : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : ''); ?>
                <input id="chb_free_courses" name="chb_free_courses" type="checkbox" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : '';?>>
                This course is free for students <br />
                <br>
                <select class="form-control" id="step_access_courses" name="step_access_courses" onchange="javascript:showhidecourse(this.value);">
                  <option value="0" <?php echo ($this->input->post('step_access_courses') == '0') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "selected" : ''; ?>>Students</option>
                  <option value="1" <?php echo ($this->input->post('step_access_courses') == '1') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "selected" : ''; ?>>All Students</option>
                </select>
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
            <div class="form-group">
              <div id="free_courses">
                <label class="col-sm-3 control-label">Of</label>
                <div class="col-sm-5"> 
                  
                  <!--<select name="selected_course[]" id="selected_course[]" multiple="multiple">-->
                  <select name="selected_course" id="selected_course" multiple="multiple" class="form-control">
                    <option value="-1" <?php if($this->input->post('step_access_courses') == '-1' || isset($program->chb_free_courses) && $program->selected_course == '-1') echo "selected";?>>Any Course</option>
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
                  
                  <span class="tooltipcontainer"> <span type="text" id="selected_course-target" class="tooltipicon" title="Click Here"></span> <span class="selected_course-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                  
                  <!--tip containt--> 
                  
                  <?php echo lang('course_fld_course-free-student');?> </span> </span> </div>
              </div>
              <span class="error"><?php echo form_error('selected_course'); ?></span>
              <?php }

        ?>
            </div>
          </fieldset>
          <hr/>
		  <div style="margin-left: 200px;" id="priceDiv" >
				<label style="margin-left: -183px;   padding-top: 45px;">Payment Mode for the Students :</label>
				<input type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan" <?php if(@$program->fixedrate > 0.00) echo 'checked';  ?> value="fixed"/>Fixed Price   <p class="p3">This option allow students to make a one time payment for the course. </p><br>
			  <input type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan" <?php if(@$countplans) echo 'checked';  ?> value="subscription" />Subscription    <p class="p3">This option will allow students to access the course for pre-defined time period, suitable for courses that may get updated with new lectures and live classes regularly.</p>
		  </div>
		  <hr/>
          <fieldset class="adminform" id="price_subs" style="<?php if(@$program->fixedrate > 0.00 || isset($countplans)) { echo 'display:block'; } else { echo 'display:none'; } ?>">
            <legend>Pricing / Subscriptions</legend>
			
			<div class="form-group" id="fixed_rate" style="<?php if(@$program->fixedrate > 0.00) { echo 'display:block'; } else{ echo 'display:none'; }  ?>">
                <label for="field-1" class="col-sm-3 control-label"><b>For Fixed Rate :</b></label>
                <div class="col-sm-5">
                  <input type='text' name='fixedrate' class='form-control' id='fixedrate' value="<?php echo (isset($program->fixedrate)) ? $program->fixedrate : '' ?>" onkeypress="return isNumberKey(event)">
                </div>
                <p> Amount to be set for the course fees.Enter only numerics and the fees will be display in the currency you have set.</p>
              </div>
            <table class="adminform table table-bordered" >
              <tbody>
                <tr id="subscriptions_headtr" style="display:none;">
                  <td style="font-size:1.2em;font-weight:bold;padding:0.5em;"><div style="float:left;"> Subscriptions plans&nbsp; You can create and edit new Subcription plan as per your need in the <a href ="<?php echo base_url(); ?>admin/orders">Orders and payments</a> </div>
                    
                    <!-- tooltip area --> 
                    
                    <span class="tooltipcontainer"> <span type="text" id="subscriptions-target" class="tooltipicon" title="Click Here"></span> <span class="subscriptions-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                    
                    <!--tip containt--> 
                    
                    <?php echo lang('course_fld_subscriptions-plans');?> </span> </span>
                    <div style="float:left;"> </div></td>
                </tr>
              
              <br/>
              <br/>
              <br/>
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
                          <input name="subscription_price[<?php echo $plan->plid ?>]" type="text" value="<?php echo ($price) ? $price[$plan->plid] : $plan_price ?>" onkeypress="return isNumberKey(event)">
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
                <td style="font-size:1.2em;font-weight:bold;padding:0.5em;"><div style="float:left;"> Renewal plans&nbsp; </div>
                  
                  <!-- tooltip area --> 
                  
                  <span class="tooltipcontainer"> <span type="text" id="renewal-target" class="tooltipicon" title="Click Here"></span> <span class="renewal-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                  
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
          		<div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab4"> 
							<a href="#publishing" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div>
        </div>
      </dd>
      <div style="clear:both;"></div>
    </div>

    <div class="tab-pane" id="publishing">
      <dd class="" sno="6" id="dd_6">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <?php if($updType == 'create'){

        $legend = ' ';

     }else{

            $legend = ' ';

     }?>
            <legend><?php echo $legend; ?></legend>
            <div class="form-group">
              <label class='col-sm-3 control-label'>Activate<?php //echo lang('web_active')?></label>
              <div class="col-sm-5"> <?php echo $this->input->post('published'); ?>
                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? 'checked="checked"' : (isset($program->published) && $program->published == '1') ? 'checked="checked"' : ''?> <?php echo $updType == 'create' ? 'checked="checked"' :''; ?>/>
                <label class='labelforminline' for='published'> <?php //echo lang('web_is_active')?> </label>
                <?php echo form_error('published'); ?> 
                
                <!-- tooltip area --> 
                
                <span class="tooltipcontainer"> <span type="text" id="published-target" class="tooltipicon" title="Click Here"></span> <span class="published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                <!--tip containt--> 
                
                <?php echo lang('course_fld_publishing-active');?> </span> </span> </div>
            </div>
			
			
          <!-- <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Start publishing Dates:</label>
              <div class="col-sm-5">
                <?php $sdate = (isset($program->startpublish)) ? $program->startpublish : ''; ?>
                <input class="form-control" type="text" maxlength="19" id="fromdate"  value="<?php echo ($this->input->post('startpublish')) ? $this->input->post('startpublish') : $sdate; ?>"  name="startpublish" <?php if(@$program->startpublish) echo 'readonly';  ?>>
                <span class="add-on"><i class="icon-remove"></i></span> <span class="add-on"><i class="icon-th"></i></span> 
                
               
                
                <span class="tooltipcontainer"> <span type="text" id="startpublish-target" class="tooltipicon" title="Click Here"></span> <span class="startpublish-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
              
                
                <?php echo lang('course_fld_start-publishing-date');?> </span> </span>
                <input type="hidden" id="dtp_input1" value="" />
              </div>
            </div>
            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">End publishing Date :</label>
              <div class="col-sm-5">
                <?php $edate = (isset($program->endpublish)) ? $program->endpublish : ''; ?>
                <input type="text" maxlength="19" size="25" id="todate"  value="<?php echo ($this->input->post('endpublish')) ? $this->input->post('endpublish') : $edate; ?>" id="endpublish" class='form-control' name="endpublish"  <?php if(@$program->endpublish) echo 'readonly';  ?>>
                
            
                
                <span class="tooltipcontainer"> <span type="text" id="endpublish-target" class="tooltipicon" title="Click Here"></span> <span class="endpublish-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
         
                
                <?php echo lang('course_fld_end-publishing-date');?> </span> </span>
                <input type="hidden" id="dtp_input1" value="" />
              </div>
			  
            </div>-->
          </fieldset>
          <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab5"> 
							<a href="#mtags" class="btn btn-info" data-toggle="tab">
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
      <dd class="" sno="7" id="dd_7">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <?php if($updType == 'create'){

                $legend = ' ';

            }else{

                $legend = ' ';

            }?>
            <legend><?php echo $legend; ?></legend>
            <div class="form-group">
              <label for="field-1" class="col-sm-3 control-label">Title:</label>
              <div class="col-sm-5">
                <?php

$metatitle = (isset($program->metatitle)) ? $program->metatitle : '';

$metakwd = (isset($program->metakwd)) ? $program->metakwd : '';

$metadesc = (isset($program->metadesc)) ? $program->metadesc : '';



?>
                <input type="text" value="<?php echo ($this->input->post('metatitle')) ? $this->input->post('metatitle') : $metatitle; ?>" maxlength="255" size="40" name="metatitle" class="form-control">
                <span class="tooltipcontainer"> <span type="text" id="metatitle-target" class="tooltipicon" title="Click Here"></span> <span class="metatitle-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                <!--tip containt--> 
                
                <?php echo lang('course_fld_meta-title');?> </span> </span> </div>
                 <p class="ptext"> (The Information that you provide in meta tag is used by search engine to index a page so that someone search for the kind of information the page contains able to find it.)</p>
            </div>
            <div class="form-group">
              <label for="field-ta" class="col-sm-3 control-label">Keywords:</label>
              <div class="col-sm-5">
                <?php //$this->ckeditor->editor("metakwd",($this->input->post('metakwd')) ? $this->input->post('metakwd') : ((isset($program->metakwd)) ? $program->metakwd : ''));?>
                <textarea class="form-control" name="metakwd" cols="40"><?php echo $this->input->post('metakwd') ? $this->input->post('metakwd') : $metakwd;?></textarea>
                <!-- tooltip area --> 
                <span class="tooltipcontainer"> <span type="text" id="metakwd-target" class="tooltipicon"></span> <span class="metakwd-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> <?php echo lang('course_fld_meta-keywords');?> </span> </span> </div>
               <p class="ptext"> (This Title showup in the Search Engine Result Page
Those are the Keywords that you expect people to search in a search engine to land in your lecture page.)</p>
            </div>
            <div class="form-group">
              <label for="field-ta" class="col-sm-3 control-label">Description:</label>
              <div class="col-sm-5">
                <?php //$this->ckeditor->editor("metadesc",($this->input->post('metadesc')) ? $this->input->post('metadesc') : ((isset($program->metadesc)) ? $program->metadesc : ''));?>
                <textarea class="form-control" name="metadesc" cols="40"><?php echo $this->input->post('metadesc') ? $this->input->post('metadesc') : $metadesc;?> </textarea>
                
                <!-- tooltip area --> 
                
                <span class="tooltipcontainer"> <span type="text" id="metadesc-target" class="tooltipicon" title="Click Here"></span> <span class="metadesc-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                <!--tip containt--> 
                
                <?php echo lang('course_fld_meta-description');?> </span> </span> </div>
                 <p class="ptext"> (The purpose of the meta description tag is to provide a brief and concise summary of your lectures content in the search engine result page.)</p>
            </div>

            <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab6"> 
							<a href="#requirements" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 
          </fieldset>

        </div>
      </dd>
    </div>
    <div class="tab-pane" id="requirements">
      <dd class="" sno="8" id="dd_8">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <?php if($updType == 'create'){

                $legend = ' ';

            }else{

                $legend = 'Edit Course';

            }?>
            <legend><?php echo $legend; ?></legend>
            <div class="form-group">
            <p class="psubtitle">In case you feel that this is an advanced course and requires completion of other basic course for better understanding to students then click on the button to add the pre-requisite course. Once you save this, then only those student who have completed those course will be able to apply.</p>
              <label for="field-1" class="col-sm-3 control-label"><b>Prerequisites Course(s):</b></label>
              <div class="col-sm-5"> <a href = "<?php echo base_url(); ?>admin/programs/addcourse/" class="addcourse_pop btn btn-info">Add Course </a>
              <!-- tooltip area --> 
              
              <span class="tooltipcontainer"> <span type="text" id="prerequisites_Course-target" class="tooltipicon" title="Click Here"></span> <span class="prerequisites_Course-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              <!--tip containt--> 
              
              <?php echo lang('course_fld_prerequisites-Course');?> </span> </span> 
               </div>
              </div>
            <?php

                $table_display = "table";

                ?>
            <br />
					<table id="table_courses_id" class="table table-bordered responsive">

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

                             foreach($rerequisites as $rerequisite){

                           ?>

                           <tr id="tr<?php echo $rerequisite->id;?>" <?php echo $display_none; ?>>

                               <td><?php echo $rerequisite->id ?></td>

                               <td><?php echo $rerequisite->name ?></td>

                               <input type="hidden" name="req_id[]" id="req_id" value="<?php echo $rerequisite->id ?>">

                              <td>

                                <a href="javascript:void(0);" class="removeele" id="remove<?php echo $rerequisite->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png" alt="delete"/></a>

                              </td>

                            </tr>

                            <?php }

                            }  }
                            ?>
						</tbody>
                        <input id="preqfiles" name="preqfiles" value="<?php echo ($this->input->post('preqfiles') ? $this->input->post('preqfiles') : '')?>" type="hidden">

                    </table>
            <div class="form-group">
				<label for="field-ta" class="col-sm-3 control-label">Other Prerequisites:</label>
				<div class="col-sm-5">
                <textarea name="pre_req" id="pre_req" class="form-control" ><?php echo $this->input->post('pre_req') ? $this->input->post('pre_req') :((isset($program->pre_req)) ? $program->pre_req : '');?></textarea>
                <!-- tooltip area --> 
              
				<span class="tooltipcontainer"> <span type="text" id="pre_req-target" class="tooltipicon" title="Click Here"></span> <span class="pre_req-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
				<!--tip containt--> 
              
				<?php echo lang('course_fld_other-prerequisites');?> </span> </span> 
				</div>
				</div>
            <div class="form-group">
				<label for="field-ta" class="col-sm-3 control-label">Prerequisites Books:</label>
				<div class="col-sm-5">
                <textarea class="form-control" style="" id="pre_req_books" name="pre_req_books" aria-hidden="true"><?php echo $this->input->post('pre_req_books') ? $this->input->post('pre_req_books') :((isset($program->pre_req_books)) ? $program->pre_req_books : ''); ?></textarea>
                <!-- tooltip area --> 
              
				<span class="tooltipcontainer"> <span type="text" id="pre_req_books-target" class="tooltipicon" title="Click Here"></span> <span class="pre_req_books-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
				<!--tip containt--> 
              
				<?php echo lang('course_fld_prerequisites-books');?> </span> </span>
				</div>
				 </div>
            <div class="form-group">
              <label for="field-ta" class="col-sm-3 control-label">Misc Requirements:</label>
              <div class="col-sm-5"> 
                <!--<input type="hidden" id="preqfiles" name="preqfiles" value="">   -->
                <textarea name="reqmts" id="reqmts" class="form-control"><?php echo $this->input->post('reqmts') ? $this->input->post('reqmts') :((isset($program->reqmts)) ? $program->reqmts : ''); ?></textarea>
                <!-- tooltip area --> 
              <span class="tooltipcontainer"> <span type="text" id="reqmts-target" class="tooltipicon" title="Click Here"></span> <span class="reqmts-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              <!--tip containt--> 
              <?php echo lang('course_fld_misc-requirements');?> </span> </span>
              </div>
               </div>

              <div class="form-group"> 
						<div class="col-sm-offset-3 col-sm-5" id="nexttab7"> 
							<a href="#webinar" class="btn btn-info" data-toggle="tab">
								<span class="visible-xs"><i class="entypo-user"></i></span>
								<span class="hidden-xs">Next Tab</span>
							</a>
						</div> 
					</div> 
			</fieldset>


			
			<!--<script>
				jQuery(document).ready(
				function()
				{
					jQuery('#description').redactor();
					jQuery('#pre_req').redactor();
					jQuery('#pre_req_books').redactor();
					jQuery('#reqmts').redactor();
				}
				);
			</script> -->

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
      <dd class="" sno="9" id="dd_9">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            <?php if($updType == 'create'){

                $legend = 'Webinar Service';

            }else{

                $legend = 'Edit Course';

            }?>
            <legend><?php echo $legend; ?></legend>
            <div class="form-group">
            <p class="psubtitle">This is the live class mode for taking live classes, if you wish to include live class in your course please select "Active". You can schedule and edit live classes / webinars for each lectures from  <a href="<?php echo base_url();?>admin/programs/">course manager</a></p>
              <label class="col-sm-3 control-label">Webinar Status :</label>
              <div class="col-sm-5">
                <input type="radio" onclick="javascript:getWebDesc(this.value)" name="webstatus" id="webstatusactive" value="active" <?php

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



                                }

                               }

                                ?> />
                &nbsp;Active&nbsp;&nbsp;
                <input type="radio" onclick="javascript:getWebDesc(this.value)" name="webstatus" id="webstatusinactive" value="inactive" <?php

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

                                }



                             }

                                ?> />
                &nbsp;Inactive 
                
                <!-- tooltip area --> 
                
                <span class="tooltipcontainer"> <span type="text" id="webstatus-target" class="tooltipicon" title="Click Here"></span> <span class="webstatus-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                <!--tip containt--> 
                <?php echo lang('course_fld_webinar-status');?> </span> </span> </div>
            </div>
            <div class="form-group" id="desc_tr" style="<?php echo ((@$program->webstatus)=='active') ? "display:block" : "display:none" ?>">
              <label for="field-ta" class="col-sm-3 control-label">Description:</label>
              <div class="col-sm-5">
                <?php //$this->ckeditor->editor("webnardescription",($this->input->post('webnardescription')) ? $this->input->post('webnardescription') : ((isset($program->webnardescription)) ? $program->webnardescription : ''));?>
                <textarea rows="6"  class="form-control" id="webnardescription" name="webnardescription"><?php echo ($this->input->post('webnardescription')) ? $this->input->post('webnardescription') : ((isset($program->webnardescription)) ? $program->webnardescription : '');?></textarea>
              
              </div>
              <!-- tooltip area --> 
              <p class="p4">Here you can put a brief description of the agenda of the live classes.</p>
              <span class="tooltipcontainer"> <span type="text" id="webnardescription-target" class="tooltipicon" title="Click Here"></span> <span class="webnardescription-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              <!--tip containt--> 
              
              <?php echo lang('course_fld_webinar-servic-description');?> </span> </span> </div>
          </fieldset>
        </div>
      </dd>
    </div>
	<?php
		}
	?>
  </div>
</div>

<input type="hidden" name="setname" id="setname" value="">
<input type="hidden" name="setdescription" id="setdescription" value="">
<input type="hidden" name="setcategory" id="setcategory" value="">
<input type="hidden" name="setactivate" id="setactivate" value="">
<input type="hidden" name="setsrc" id="setsrc" value="">
<input type="hidden" name="setimg" id="setimg" value="">

<div style="clear:both;"></div>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script> 


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
  	
     if(i == "fixed")
	 {
	 	
	    document.getElementById('fixed_rate').style.display = 'block';
	    document.getElementById('price_subs').style.display = 'block';
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
	    document.getElementById('price_subs').style.display = 'block';
	    document.getElementById('subscriptions_tr').style.display = 'table-row';
	    document.getElementById('subscriptions_headtr').style.display = 'table-row';
	    document.getElementById('renewals_tr').style.display = 'table-row'; 
	    document.getElementById('renewals_headtr').style.display = 'table-row'; 
	    //$("#chb_free_courses").attr("disabled", true);
	 }
	

  }
  		
</script>
<script type="text/javascript">
	$(function() 
	    {	
	    	var vv1 = $("#step_access_courses").val();
	    	if(vv1 == 1)
	    	{
	    		document.getElementById('free_courses').style.display = 'none';
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

	    	

	    	var vv = $("#plan").val();
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

    /*$( "#todate" ).datepicker({

		dateFormat: "yy-mm-dd",
	
		defaultDate: "+1w",
	
		changeMonth: true,
	
		numberOfMonths: 1,
	
		showOn: "button",
	
		buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",
	
		buttonImageOnly: true,
	
		onClose: function( selectedDate ) 
		{
	
			$( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
	
		}

    });*/

	});

/*
    jQuery(function() {
    jQuery( "#fromdate" ).datepicker({

		dateFormat: "yy-mm-dd",
	
		defaultDate: "+1w",
	
		changeMonth: true,
	
		numberOfMonths: 1,
	
		showOn: "button",
	
		buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",
	
		buttonImageOnly: true,
	
		onClose: function( selectedDate ) {

        jQuery( "#todate" ).datepicker( "option", "minDate", selectedDate );

		}

    });

    jQuery( "#todate" ).datepicker({

		dateFormat: "yy-mm-dd",
	
		defaultDate: "+1w",
	
		changeMonth: true,
	
		numberOfMonths: 1,
	
		showOn: "button",
	
		buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",
	
		buttonImageOnly: true,
	
		onClose: function( selectedDate ) {

        jQuery( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );

		}
    });
	//});
	*/
	</script> 
	
<!--<script type="text/javascript">

    $('.form_datetime1').datetimepicker({

        weekStart: 1,

        todayBtn:  1,

		autoclose: 1,

		todayHighlight: 1,

		startView: 2,

		forceParse: 0,

        showMeridian: 1

    });

</script>-->

<?php //echo form_hidden('page',set_value('page', $page)) ?>
<?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>
<input type="hidden" name="media_number" value="<?php //echo $n; ?>" id="media_number"/>
<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$program->id) ?>
<?php endif ?>
<?php echo form_close(); ?> 



<!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){
//
//	jQuery('.tooltipicon').click(function(){
//
//	var dispdiv = jQuery(this).attr('id');
//
//	jQuery('.'+dispdiv).css('display','inline-block');
//
//	});
//
//	jQuery('.closetooltip').click(function(){
//
//	jQuery(this).parent().css('display','none');
//
//	});
//
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
$(document).ready(function(){
webcamVisiable();
});
function webcamVisiable()
{   
	var selectname = $( "#final_quizzes option:selected" ).val();
	if(selectname !=0)
	{
		$("#webcamDiv").css("display","block");
		$("#showresultDiv").css("display","block");

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
	else
	{
		$("#webcamDiv").css("display","none");
		$("#showresultDiv").css("display","none");
		document.getElementById("timewebcam").style.display="none";

		$("#certificate_setts option[value='3']")
    		.attr("disabled", "disabled");
    		 $("#certificate_setts option[value='5']")
    		.attr("disabled", "disabled");
   				
   		 $("#certificate_setts option[value='3']").prop("selected",false); 
   		 $("#certificate_setts option[value='5']").prop("selected",false);
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
</script>
<script>

	for(var i=1;i<=7;i++)
{
		$('#nexttab'+i).click(function() {
			
			 var active = $('ul li.active').removeClass('active');
		   active.next().addClass('active');

		    $("html, body").animate({ scrollTop: 0 }, 600);
		  
		});
}
	/*$("#chb_free_courses").on('click', function()
	 {
	 	$("#priceDiv").toggle();
	 });*/
</script>

<script>
	/*$("#plan").on('click', function()
	 {
	 	var box = $("#plan").val();
	 	alert(box);
	 	if(box == fixed)
	 	{
	 		$("#plan").prop("checked",false);
	 	}
	 	else
	 	{
	 		$("#plan").prop("checked",true);
	 	}
	 	//$("#chb_free_courses").attr("readonly","true");
	 });*/

	/*$("input[type='radio']").click(function()
{
  var previousValue = $(this).attr('previousValue');
  var name = $(this).attr('name');

  if (previousValue == 'checked')
  {
    $(this).removeAttr('checked');
    $(this).attr('previousValue', false);
  }
  else
  {
    $("input[name="+name+"]:radio").attr('previousValue', false);
    $(this).attr('previousValue', 'checked');
  }
});*/
</script>

<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 

<script type="text/javascript">
	jQuery(document).ready(
		function()
		{
			//jQuery('#description').redactor();
			jQuery('#description').redactor({
			        focus: true,
			        //imageUpload: window.location.origin+'/admin/widgets/getImage',
			        'plugins': ['fontsize','fontcolor','fontfamily'],  //'video','imagelink'
			      	                
			});

		}
	);
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
  	var description = $j('#description').val();
  	var category_id = $j('#category_id').val();
  	var teacher_id = $j('#teacher_id').val();
  	var step_access_courses = $j('#step_access_courses').val();

  	if(name.trim() =="")
  	{
  		
  		validatepop('Course Name Required','Please Enter Name of Course!');		
	    return false;
  	}
  	else if(description.trim() =="")
  	{

  		validatepop('Course Description Required','Please Enter  Description of Course!');  		
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
  	 	
  			if(step_access_courses == 0)
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
							
							 //return true;
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
  				return true;
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