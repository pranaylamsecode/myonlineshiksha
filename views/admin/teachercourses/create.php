<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
?>

<div id="content-top">
<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<script type="text/javascript">
window.onload = function() {
showhidecoursetype();
certificatemessage();
}
function showhidecoursetype(){
	var selvalue = document.getElementById("course_type").selectedIndex;
	if(selvalue == '1')
	{
	document.getElementById("lessons_release_td").style.display="table-row";
	document.getElementById("lessons_show_td").style.display="table-row";
	}else
	{
	document.getElementById("lessons_release_td").style.display="none";
	document.getElementById("lessons_show_td").style.display="none";
	}
}
function certificatemessage(selvalue){
	var selvalue = document.getElementById("certificate_setts").selectedIndex;
	switch(selvalue){
	case 0 :
	document.getElementById("avg_certificate").style.display="none";
	document.getElementById("coursecertifiactemsg").style.display="none";
	break;
	case 1 :
	document.getElementById("avg_certificate").style.display="none";
	document.getElementById("coursecertifiactemsg").style.display="table-row";
	break;
	case 2 :
	document.getElementById("avg_certificate").style.display="none";
	document.getElementById("coursecertifiactemsg").style.display="table-row";
	break;
	case 3 :
	document.getElementById("avg_certificate").style.display="table-row";
	document.getElementById("coursecertifiactemsg").style.display="table-row";
	break;
	case 4 :
	document.getElementById("avg_certificate").style.display="none";
	document.getElementById("coursecertifiactemsg").style.display="table-row";
	break;
	case 5 :
	document.getElementById("avg_certificate").style.display="table-row";
	document.getElementById("coursecertifiactemsg").style.display="table-row";
	break;
	}

}
function showhidecourse(){
	var selvalue = document.getElementById("step_access_courses").selectedIndex;
   // alert(selvalue);
	if(selvalue == '0')
	{
	document.getElementById("free_courses").style.display="table-row";
	}else
	{
	document.getElementById("free_courses").style.display="none";
	}
}
</script>
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
			ftpfileoptions = '<img src="<?php echo base_url(); ?>public/uploads/programs/img/'+data.ftpfilearray+'" width="150">';
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
</script>
<h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>
<script type="text/javascript">
			$(function(){
				$('dl.tabs dt').click(function(){
					$(this)
						.siblings().removeClass('selected').end()
						.next('dd').andSelf().addClass('selected');
				});
			});

</script>
<script type="text/javascript">
			   $(document).ready(function(){
					$(".removeele").live('click',function(){
					var id = $(this).attr("id");
					id = id.substr(6);
					 $("#tr"+id).remove();
					});
				});
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
$(document).ready(function() {
	$(".unpublish, .publish").click(function() {
	 // alert("test");
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

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
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

			/*
			 *  Open manually
			 */

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


/*$(document).ready(function() {

 $("span.error").each(function( index ) {
 var ddidentifire = $(this).closest('dd').attr('sno');
 var error_text = $('dd["sno"="'+ddidentifire+'"] span#error_'+ddidentifire+index+'').text();
 //alert(error_text);
 if(error_text!=''){
 $('#dt_'+ddidentifire+'').css('background-color', 'red');

 }else{

 }
// break;
});
});*/


	</script>


    <span class="clearFix">&nbsp;</span>
</div>

<?php
 //echo $parent_id;exit;
$attributes = array('class' => 'tform', 'id' => 'proform');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/programs/create', $attributes) : form_open_multipart(base_url().'admin/programs/edit/'.$id, $attributes);
$validation_errors = validation_errors();
$validationerrors = explode('.',$validation_errors);
//print_r($ptest);
?>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul>
			<li id="toolbar-new" class="listbutton">
			<a>
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "" : "", (($updType == 'create') ? "id='submit' class='save_btn'" : "id='submit' class='save_btn'")); ?><br/>
            Save
			</a>
			</li>
            <li id="toolbar-new" class="listbutton">
            <?php if ($updType == 'create'): ?>

            	    <?php if ($parent_id != "0"): ?>
            	    	<a href='<?php echo base_url(); ?>admin/programs/' class='bforward'><span class="icon-32-cancel"> </span>
            Cancel </a>
            	    <?php else: ?>
            	    	 <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='bforward'><span class="icon-32-cancel"> </span>
            Cancel </a>
            	    <?php endif ?>

                <?php else: ?>

             	    <?php if ($parent_id != "0"): ?>
                		<a href='<?php echo base_url(); ?>admin/programs/' class='bforward'><span class="icon-32-cancel"> </span>
            Cancel </a>
            	    <?php else: ?>
            	    	 <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='bforward'><span class="icon-32-cancel"> </span>
            Cancel </a>
            	    <?php endif ?>

            <?php endif ?>
            </li>
			</ul>
			<div class="clr"></div>
		</div>
        <?php if($updType == 'create'){
                $pagetitle = 'New Course';
            }else{
                $pagetitle = 'Edit Course';
            }?>
		<!--<div class="pagetitle icon-48-generic"><h2><?php echo $pagetitle;?></h2></div>        -->
		<div class="pagetitle"><h2><?php echo $pagetitle;?></h2></div>
	</div>
</div>
<dl class="tabs">
<dt class="selected">General</dt>
<dd class="selected" sno="1">
	<div class="tab-content">
        <fieldset class="adminform">
            <?php if($updType == 'create'){
                $legend = 'New Course';
            }else{
                $legend = 'Edit Course';
            }?>
		<legend><?php echo $legend; ?></legend>
        <table class="adminform">
            <tbody>
            <tr>
                <td width="15%">

					<p>
						<label class='labelform' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
					</p>
				</td>
                <td>
					<p>
						<input id="name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($program->name)) ? $program->name : ''); ?>"  />
                         <span class="error"><?php echo form_error('name'); ?></span>
					</p>

                </td>
            </tr>
            <tr>
                <td width="15%">
					<p>
						<label class='labelform' for="name"><?php echo 'Alias'; //lang('web_name')?></label>
					</p>
				</td>
                <td>
					<p>
						<input id="alias" type="text" name="alias" maxlength="256" value="<?php echo set_value('alias', (isset($program->alias)) ? $program->alias : ''); ?>"  />
					</p>
                </td>
            </tr>
            <tr>
                <td width="15%">
					<p>
						<label class='labelform' for='category_id'><?php echo lang('web_category')?> <span class="required">*</span></label>
					</p>
				</td>
                <td>
					<p>
						<select name='category_id' id='category_id'>
					   <!--	<option value='-1'><?php echo '(0) Top';?></option>   -->
					 	<option value=''>select</option>
					<?php
					foreach ($categories as $category): ?>
						<option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($program->catid)) ? $program->catid : $parent_id  ) ?>><?php echo $category->name?></option>
					<?php endforeach ?>
						</select>
                        <span class="error"><?php echo form_error('category_id'); ?></span>
					</p>
                </td>
            </tr>
            <tr>
                <td width="15%">Teacher:<font color="#ff0000">*</font></td>
                <td>
					<select name='teacher_id' id='teacher_id'>
						<option value=''><?php echo '- select -';?></option>
					<?php foreach ($teachers as $teacher): ?>
						<option value='<?php echo $teacher->userid?>' <?php echo  preset_select('teacher_id', $teacher->userid, (isset($program->author)) ? $program->author : ''  ) ?>><?php echo $teacher->fullname?></option>
					<?php endforeach ?>
						</select>
                        <span class="error"><?php echo form_error('teacher_id'); ?></span>
                </td>
            </tr>
            <tr>
                <td width="15%">Level:</td>
                <td>
                    <select name="level" id="level">
<option value="0" <?php echo ($this->input->post('level') == '0') ? "selected=selected" : (isset($program->level) && $program->level == '0') ? "selected=selected" : ''?>>Beginners</option>
<option value="1" <?php echo ($this->input->post('level') == '1') ? "selected=selected" : (isset($program->level) && $program->level == '1') ? "selected=selected" : ''?>>Intermediate</option>
<option value="2" <?php echo ($this->input->post('level') == '2') ? "selected=selected" : (isset($program->level) && $program->level == '2') ? "selected=selected" : ''?>>Advanced</option>

					</select>

                </td>
            </tr>
            <tr>
                <td width="15%">Skip modules pages:</td>

                <td>
                <?php
                $skip_module = (isset($program->skip_module)) ? $program->skip_module : ''; ?>
                <?php
                $skipmod = ($this->input->post('skip_module')) ? $this->input->post('skip_module') : '';
                $skipmodule1 =  ($skipmod == '1') ? 'checked="checked"': '';
                $skipmodule2 =  ($skipmod == '0') ? 'checked="checked"': '';
                ?>

                    <div style="float:left;"><input value="1" <?php echo ($skip_module == '1') ? 'checked="checked"' : $skipmodule1 ?> name="skip_module" type="radio">&nbsp;Yes&nbsp;</div>
                    <div style="float:left;"><input value="0" <?php echo ($skip_module == '0') ? 'checked="checked"' : $skipmodule2 ?> name="skip_module" type="radio">&nbsp;No</div>

				</td>
            </tr>
             <tr>
                <td width="15%">
               		Course type:</td>
                <td>
                  <?php
                  $pcourse_type1 = ($this->input->post('course_type') == 0) ? 'selected="selected"' : '';
                  $pcourse_type2 = ($this->input->post('course_type') == 1) ? 'selected="selected"' : '';
                 ?>
                 <select onchange="javascript:showhidecoursetype(this.selectedIndex)" name="course_type" id="course_type">

                 	<option value="0" <?php echo ($this->input->post('course_type') == '0') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 0 ? 'selected="selected"' : $pcourse_type1) ?>>
                    Non-Sequential
                    </option>
					<option value="1" <?php echo ($this->input->post('course_type') == '1') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 1 ? 'selected="selected"' : $pcourse_type2) ?>>
                    Sequential</option>
				</select>

                </td>
            </tr>
             <tr style="display:none;" id="lessons_release_td">
                <td width="15%">
               		Lesson release:</td>
                <td>
                   <select onchange="javascript:alertfunction()" name="lesson_release" id="lesson_release">
					<option value="0" <?php echo ($this->input->post('lesson_release') == '0') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '0' ? 'selected="selected"' : '' ?>>All at once</option>
					<option value="1" <?php echo ($this->input->post('lesson_release') == '1') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '1' ? 'selected="selected"' : '' ?>>One lesson per day</option>
                    <option value="2" <?php echo ($this->input->post('lesson_release') == '2') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '2' ? 'selected="selected"' : ''?>>One lesson per week</option>
					<option value="3" <?php echo ($this->input->post('lesson_release') == '3') ? "selected=selected" : (isset($program->lesson_release)) && $program->lesson_release == '3' ? 'selected="selected"' :'' ?>>One lesson per month</option>
				</select>

                </td>
            </tr>
            <tr style="display:none;" id="lessons_show_td">
                <td width="15%">
               		Lessons that are't released should show as:</td>
                <td>
                    <select name="lessons_show" id="lessons_show">
                        <option value="1" <?php echo ($this->input->post('lessons_show') == '1') ? "selected=selected" : (isset($program->lessons_show)) && $program->lessons_show == '1' ? "selected=selected" : ''?>>Grayed out text</option>
                        <option value="2" <?php echo ($this->input->post('lessons_show') == '2') ? "selected=selected" : (isset($program->lessons_show)) && $program->lessons_show == '2' ? "selected=selected" : ''?>>Should not show</option>
					</select>

                </td>
            </tr>
             <tr>
                <td width="15%">
               		Final exam:</td>
                <td>

                    <select name="final_quizzes" id="final_quizzes">
                        <option value="0">no final exam</option>
						<?php foreach($finalexamlist as $finalexam){ ?>
                             <option value="<?php echo $finalexam->id;?>" <?php echo ($this->input->post('final_quizzes') == $finalexam->id) ? "selected=selected" : (isset($program->id_final_exam)) && $program->id_final_exam == $finalexam->id ? "selected=selected" : '' ?>><?php echo $finalexam->name;?></option>

						<?php }?>
					</select>

                </td>
            </tr>
            <tr>
            <td>Certificate Term </td>
        		<td width="25px;">
                   <select onchange="javascript:certificatemessage(this.selectedIndex)" name="certificate_setts" id="certificate_setts">
					<option value="1" <?php echo ($this->input->post('certificate_setts') == '1') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '1' ) ? "selected=selected" : '' ?> >No Certificate</option>
					<option value="2" <?php echo ($this->input->post('certificate_setts') == '2') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '2' ) ? "selected=selected" : '' ?> >Complete all the lessons</option>
                    <option value="3" <?php echo ($this->input->post('certificate_setts') == '3') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '3' ) ? "selected=selected" : '' ?> >Pass the final exam</option>
					<option value="4" <?php echo ($this->input->post('certificate_setts') == '4') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '4' ) ? "selected=selected" : '' ?> >Pass the quizzes in avg </option>
                    <option value="5" <?php echo ($this->input->post('certificate_setts') == '5') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '5' ) ? "selected=selected" : '' ?> >Finish all lessons and pass final exam</option>
                    <option value="6" <?php echo ($this->input->post('certificate_setts') == '6') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '6' ) ? "selected=selected" : '' ?> >Finish all lessons and pass quizzes in avg </option>
				</select>
                </td>
                <!--<td style="display:none;" id="avg_certificate">
                 	<input value="70" id="avg_cert" name="avg_cert" size="5px;" type="text"> &nbsp;%
                </td>-->
        </tr>
        <tr style=" display:none;" id="coursecertifiactemsg">
                <td>Certificate course message</td>
                <td><textarea maxlength="7000" rows="4" cols="50" name="coursemessage" id="coursemessage"><?php echo set_value('certificate_course_msg', (isset($program->certificate_course_msg)) ? $program->certificate_course_msg : ''); ?></textarea>
                </td>
        </tr>
        <tr>
                <td>Webcam Option</td>
                <td>

                 <input id="webcam_option" name="webcam_option" type="checkbox" <?php echo ($this->input->post('webcam_option')) ? "checked" : isset($program->webcam_option) && $program->webcam_option == '1' ? "checked" : '';?>>

                </td>
        </tr>
        </tbody></table>
	</fieldset>
	</div>
</dd>

<dt class="">Description</dt>
<dd class="" sno="2">
	<div class="tab-content"><fieldset class="adminform">
        <?php if($updType == 'create'){
            $legend = 'New Course';
        }else{
            $legend = 'Edit Course';
        }?>
<legend><?php echo $legend; ?></legend>
		<table class="adminform">
             <tbody><tr>
                <td>
                	<p>
						<label class='labelform' for="description"><?php echo lang('web_description')?></label>
					</p>
                </td>
                <td>
                    <table>
                        <tbody><tr>
                            <td>
                                <p>
		 		                	<?php $this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
								</p>
                                <span class="error"><?php echo form_error('description'); ?></span>
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>
	</fieldset>
</div>
</dd>
<dt class="">image</dt>
<dd class="" sno="3">
	<div class="tab-content"><fieldset class="adminform">
        <?php if($updType == 'create'){
                $legend = 'New Course';
            }else{
                $legend = 'Edit Course';
        }?>
        <legend><?php echo $legend; ?></legend>
			<table class="adminform">
			<tbody>
             <tr>
				<td align="left">
					<p>
						<label for="image" class="labelform">Add a image</label>
                        <?php //echo ($this->input->post('imagename')) ? $this->input->post('imagename') : (isset($program->image)) ? $program->image : ''; ?>
                        <?php
                        if(isset($program->image)){
                          $imgname = $program->image;
                        }else{
                          $imgname = '';
                        }

                         ?>

						<input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imgname; ?>" name="imagename" id="imagename">
					</p>
				</td>
				<td>
		              <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
				        Choose file
                      <input type="file" name="file_i" id="file_i" class="upload_btn">
                           <div id="localimage_i">
                               <?php if ($updType == 'edit'){ ?>
                                    <img src="<?php echo base_url();?>public/uploads/programs/img/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ?>" width="150" id="imgname">
                               <?php }else{  ?>
                                     <img src="<?php echo base_url();?>public/uploads/programs/img/<?php if($this->input->post('imagename')) echo $this->input->post('imagename'); ?>" width="150" id="imgname">
                               <?php } ?>
                           </div>
                      </div>
                      <span class="error"><?php echo form_error('file_i'); ?></span>
				</td>
			 </tr>
		</tbody>
    </table>
  </fieldset>
</div>
</dd>

<dt class="">Exercise files</dt>
<dd class="" sno="4">
	<div class="tab-content"><fieldset class="adminform">
        <?php if($updType == 'create'){
                $legend = 'New Course';
            }else{
                $legend = 'Edit Course';
            }?>
<legend><?php echo $legend; ?></legend>
		<table class="adminform">
			<tbody>

            <tr>
				<td> <a href = "<?php echo base_url(); ?>admin/medias/addmedia/<?php //echo $program->id; ?>" class="fancybox fancybox.iframe">Add Exercise file </a>
                <div>

                  </div>
                    <div style="float:left;">
                        &nbsp;
                    </div>
                    <div style="float:left;">

                    </div>
                 </td>
			</tr>
            <tr>
				<td>
					<table bgcolor="#cccccc" border="0" cellpadding="5" cellspacing="1" width="100%">
         				 <tbody id="rowsmedia">
							<tr>
            					<td style="text-align:center; width:5%;">#</td>
            					<td style="text-align:center; width:5%;">Type</td>
            					<td style="text-align:center;" width="30%">
									<strong>File/Media name</strong>
								</td>
            					<td style="text-align:center;" width="9%">
									<strong>Published</strong>
								</td>
            					<td style="text-align:center;" width="23%">
                                	<div align="center">
                                        <div style="float:left;">
                                            <strong>Order</strong>
                                        </div>
                                        <div style="float:left;">
                                        <a href="javascript: saveorder( 0, 'saveorderfile' )">
                                            <img alt="SAVE ORDER" src="components//images/filesave.png" border="0" height="16" width="16">
                                        </a>
                                        </div>
                                    </div>
								</td>
            					<td style="text-align:center;" width="12%">
									<strong>Guest Access</strong>
								</td>
            					<td style="text-align:center;" width="14%">
									<strong>Remove</strong>
								</td>
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
                             <td>order</td>
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
                          if(isset($get_media_ids) && $get_media_ids!= ''){
                          $nums = 0;
                          foreach($get_media_ids as $get_media_id){
                          $nums++;
                          $getMedia = $this->medias_model->getMediaExeFile($get_media_id);
                          foreach($getMedia as $media){   ?>
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
                             <td>order</td>
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
                               <td>order</td>
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
                            </tr> <?php } } }?>
						</tbody>
					</table>
                    <input id="mediafiles" name="mediafiles" value="<?php echo ($this->input->post('mediafiles') ? $this->input->post('mediafiles') : '')?>" type="hidden">
				</td>
			</tr>
		</tbody></table>
	</fieldset></div>
</dd>

<dt class="">Pricing/Plans</dt>
<dd class="" sno="5">
	<div class="tab-content">
    <fieldset class="adminform">

		<div style=" float:left; padding:0.2em">
        <?php
         //($this->input->post('chb_free_courses')? $this->input->post('chb_free_courses') : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : ''); ?>

        <input id="chb_free_courses" name="chb_free_courses" type="checkbox" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : '';?>>
        This course is free for students
            <select id="step_access_courses" name="step_access_courses" onchange="javascript:showhidecourse(this.value);">
              <option value="0" <?php echo ($this->input->post('step_access_courses') == '0') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '0') ? "selected" : ''; ?>>Students</option>
             <option value="1" <?php echo ($this->input->post('step_access_courses') == '1') ?  "selected" : (isset($program->step_access_courses) && $program->step_access_courses == '1') ? "selected" : ''; ?>>All Students</option>
         	</select>
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
		 <div style="display: <?php echo $show_div; ?>;" id="free_courses">
			<span style="float: left; padding:5px 10px 0 10px;">
				Of</span>
            <select name="selected_course[]" id="selected_course[]" multiple="multiple">
              <option value="-1" <?php if($this->input->post('step_access_courses') == '-1' || isset($program->chb_free_courses) && $program->selected_course == '-1') echo "selected";?>>Any Course</option>
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
		</div>
        <span class="error"><?php echo form_error('selected_course'); ?></span>
        <?php }
        ?>
	</fieldset>
<fieldset class="adminform">
        <legend>Pricing / Subscriptions</legend>
          <table>
            <tbody><tr>
                <td style="font-size:1.2em;font-weight:bold;padding:0.5em;">
                	<div style="float:left;">
						Subscriptions plans&nbsp;
                    </div>
                    <div style="float:left;">
                    </div>
				</td>
            </tr>
            <tr>
                <td>
                    <table id="subscriptions"><tbody>
                       <tr style="background:#999">
							<th style="padding:0.5em;" width="1%">Default</th>
                            <th style="padding:0.5em;" width="1%"><input onclick='checkPlans("subscriptions");' value="" name="splains" id="splains" type="checkbox"></th>
                            <th style="padding:0.5em;">Name</th>
                            <th style="padding:0.5em;">Terms</th>
                            <th style="padding:0.5em;">Price</th>

                        </tr>
                        <tr>
                        <td colspan="5">
                        <span class="error"><?php echo form_error('subscription_default'); ?></span>
                         <span class="error"><?php echo form_error('subscriptions'); ?></span>

</td>
                        </tr>
                         <?php //print_r($plans); ?>
                        <?php if ($plans):
                         ?>
                        <?php $i=0;?>
                        <?php foreach ($plans as $plan):

                        ?>
                        <tr>
                            <td style="padding:0.5em;">
                            <?php //($this->input->post('subscription_default') ? "checked" : isset($plan->default) && $plan->default == '1') ? "checked" : ''; ?>
                            <input value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('subscription_default') == $plan->plid) ? "checked" : isset($plan->default) && $plan->default == '1' ? "checked" : '';?> name="subscription_default" type="radio">

                            </td>
                           <td style="padding:0.5em;">

                           <input name="subscriptions[]" id="subscriptions<?php echo $plan->plid; ?>" class="plain" type="checkbox" value="<?php echo $plan->plid ?>" <?php echo ($this->input->post('subscriptions') && in_array($plan->plid,$this->input->post('subscriptions')) == '1') ? "checked" : (isset($plan->plan_id)) ? "checked" : ''?>>

                           </td>
                           <td style="padding:0.5em;"><?php echo $plan->name ?></td>
                           <td style="padding:0.5em;"><?php echo $plan->term.' '.$plan->period ?></td><td style="padding:0.5em;">
                           <?php
                             $price = $this->input->post('subscription_price');
                             $plan_price = (isset($plan->price)) ? $plan->price : '';
                           ?>
                            <input name="subscription_price[<?php echo $plan->plid ?>]" type="text" value="<?php echo ($price) ? $price[$plan->plid] : $plan_price ?>">
                            </td>
                        </tr>
                      	<?php endforeach ?>
                        <?php else: ?>
	                    <p class='text'><?=lang('web_no_elements');?></p>

                        <?php endif ?>
            </tbody></table>
            </td>
            </tr>
            <tr>
                <td style="font-size:1.2em;font-weight:bold;padding:0.5em;">
                	<div style="float:left;">
						Renewal plans&nbsp;
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <table id="renewals"><tbody>
                        <tr style="background:#999">
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
            </tbody></table>
            </td>
            </tr>
           <!-- <tr>
                <td style="font-size:1.2em;font-weight:bold;padding:0.5em;">
                	<div style="float:left;">
						System Emails&nbsp;
                    </div>

               </td>
            </tr>-->
            <!--<tr>
                <td>
                    <table id="emails"><tbody><tr style="background:#999">
                            <th style="padding:0.5em;" width="1%"><input onclick='checkPlans("emails")' value="" name="semails" id="semails" type="checkbox"></th>
                            <th style="padding:0.5em;">Name</th>
                            <th style="padding:0.5em;">Terms</th>
                        </tr><tr><td style="padding:0.5em;"><input onclick="javascript:guruCheckboxEmail(value)" value="5" name="reminders[]" class="plain" type="checkbox"></td><td style="padding:0.5em;">On purchase email</td><td style="padding:0.5em;">On purchase</td></tr>
<tr><td style="padding:0.5em;"><input onclick="javascript:guruCheckboxEmail(value)" value="4" name="reminders[]" class="plain" type="checkbox"></td><td style="padding:0.5em;">3 days after expiration</td><td style="padding:0.5em;">Three days after expiration</td></tr>
<tr><td style="padding:0.5em;"><input onclick="javascript:guruCheckboxEmail(value)" value="2" name="reminders[]" class="plain" type="checkbox"></td><td style="padding:0.5em;">Your subscription will expire in 1 day</td><td style="padding:0.5em;">One day before expiration</td></tr>
<tr><td style="padding:0.5em;"><input onclick="javascript:guruCheckboxEmail(value)" value="1" name="reminders[]" class="plain" type="checkbox"></td><td style="padding:0.5em;">Your subscription has expired</td><td style="padding:0.5em;">On expiration</td></tr>
<tr><td style="padding:0.5em;"><input onclick="javascript:guruCheckboxEmail(value)" value="6" name="reminders[]" class="plain" type="checkbox"></td><td style="padding:0.5em;">New Lesson</td><td style="padding:0.5em;">New lesson</td></tr>
</tbody></table>

                </td>
            </tr>-->
        </tbody></table>
	</fieldset>
</div>
</dd>
<script>
  $(function() {
    $( "#fromdate" ).datepicker({
      dateFormat: "yy-mm-dd",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#todate" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#todate" ).datepicker({
      dateFormat: "yy-mm-dd",
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
<dt class="" srno="6" id="dt_6">Publishing</dt>
<dd class="" sno="6" id="dd_6">
	<div class="tab-content">
	<fieldset class="adminform">
     <?php if($updType == 'create'){
        $legend = 'New Course';
     }else{
            $legend = 'Edit Course';
     }?>
<legend><?php echo $legend; ?></legend>
							<table class="adminform">
								<tbody><tr>
									<td width="15%">
										<p>
											<label class='labelform'><?php echo lang('web_active')?></label>
										</p>
									</td>
									<td width="50%">
										<p>
                                        <?php echo $this->input->post('published'); ?>
<input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? 'checked="checked"' : (isset($program->published) && $program->published == '1') ? 'checked="checked"' : ''?> />
										   <label class='labelforminline' for='published'> <?php echo lang('web_is_active')?> </label>
											<?php echo form_error('published'); ?>
										</p>
									</td>
								 </tr>
								 <tr>
									<td valign="top" align="right">Start publishing Date</td>
									<td>
										<div class="controls input-append date form_datetime" data-link-field="dtp_input1">
                                        <?php $sdate = (isset($program->startpublish)) ? $program->startpublish : ''; ?>
<input  type="text" maxlength="19" size="25" id="fromdate"  value="<?php echo ($this->input->post('startpublish')) ? $this->input->post('startpublish') : $sdate; ?>"  name="startpublish" readonly>
                                      <!--  <span class="add-on"><i class="icon-remove"></i></span>
										<span class="add-on"><i class="icon-th"></i></span>   -->
										</div>
										<input type="hidden" id="dtp_input1" value="" /><br/>
									</td>
								</tr>
								<tr>
									<td valign="top" align="right">End publishing Date</td>
									<td>
										<div class="controls input-append date form_datetime" data-link-field="dtp_input1">

                                        <?php $edate = (isset($program->endpublish)) ? $program->endpublish : ''; ?>
										<input type="text" maxlength="19" size="25" id="todate"  value="<?php echo ($this->input->post('endpublish')) ? $this->input->post('endpublish') : $edate; ?>" id="endpublish" name="endpublish" readonly>
									<!--	<span class="add-on"><i class="icon-remove"></i></span>
										<span class="add-on"><i class="icon-th"></i></span>    -->
										</div>
										<input type="hidden" id="dtp_input1" value="" /><br/>
									</td>
								</tr>
							</tbody></table>
					</fieldset>
</div>
</dd>
<dt class="" srno="7" id="dt_7">Meta Tags</dt>
<dd class="" sno="7" id="dd_7">
	<div class="tab-content">
	<fieldset class="adminform">
        <?php if($updType == 'create'){
                $legend = 'New Course';
            }else{
                $legend = 'Edit Course';
            }?>
<legend><?php echo $legend; ?></legend>
					<table class="adminform">
						<tbody><tr>
							<td width="15%">Title:</td>
							<td>
                               <?php
                               $metatitle = (isset($program->metatitle)) ? $program->metatitle : '';
                               $metakwd = (isset($program->metakwd)) ? $program->metakwd : '';
                               $metadesc = (isset($program->metadesc)) ? $program->metadesc : '';

                               ?>
								<input type="text" value="<?php echo ($this->input->post('metatitle')) ? $this->input->post('metatitle') : $metatitle; ?>" maxlength="255" size="40" name="metatitle" class="inputbox">

							</td>
						</tr>
						<tr>
							<td>Keywords:</td>
							<td>
                                <?php $this->ckeditor->editor("metakwd",($this->input->post('metakwd')) ? $this->input->post('metakwd') : ((isset($program->metakwd)) ? $program->metakwd : ''));?>

								<!--<textarea class="inputbox" name="metakwd" cols="40">     -->
                                <?php //echo $this->input->post('metakwd') ? $this->input->post('metakwd') : $metakwd; ?>
                            <!--    </textarea> -->

								<br>
							</td>
						</tr>
						<tr>
							<td>
								Description:
							</td>
							<td>
                                 <?php $this->ckeditor->editor("metadesc",($this->input->post('metadesc')) ? $this->input->post('metadesc') : ((isset($program->metadesc)) ? $program->metadesc : ''));?>
								<!--<textarea class="inputbox" name="metadesc" cols="40">--><?php //echo $this->input->post('metadesc') ? $this->input->post('metadesc') : $metadesc; ?> <!--</textarea>    -->

								<br>
							</td>
						</tr>
					</tbody></table>
	</fieldset>
</div>
</dd>
<dt class="" srno="8" id="dt_8">Requirements</dt>
<dd class="" sno="8" id="dd_8">
	<div class="tab-content">
	<fieldset class="adminform">
        <?php if($updType == 'create'){
                $legend = 'New Course';
            }else{
                $legend = 'Edit Course';
            }?>
<legend><?php echo $legend; ?></legend>
        <table class="adminform">
            <tbody><tr>
                <td width="15%" valign="middle">
                    Prerequisites Course(s):
                </td>
                <td>
                    <div style="float:left;">
                          <a href = "<?php echo base_url(); ?>admin/programs/addcourse/" class="fancybox fancybox.iframe">Add Course </a>
                    </div>
                    <div style="float:left;">
                    </div>
                <br><br>
                <?php
                $table_display = "table";
                ?>
                 <table id="table_courses_id" cellspacing="1" cellpadding="5" border="0" bgcolor="#cccccc" width="100%" style="display:<?php echo $table_display; ?>;">
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
                            if(isset($get_req_ids) && $get_req_ids!= ''){
                               foreach($get_req_ids as $get_req_id){
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
                </td>
            </tr>
            <tr>
                <td width="15%">Other Prerequisites:</td>
                <td>
                    <?php $this->ckeditor->editor("pre_req",($this->input->post('pre_req')) ? $this->input->post('pre_req') : ((isset($program->pre_req)) ? $program->pre_req : ''));?>

                   <!-- <textarea class="mce_editable" style="" rows="10" cols="40" id="pre_req" name="pre_req" aria-hidden="true">--><?php //echo $this->input->post('pre_req') ? $this->input->post('pre_req') :((isset($program->pre_req)) ? $program->pre_req : ''); ?><!--</textarea>   -->
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td>Prerequisites Books:</td>
                <td>
                    <?php $this->ckeditor->editor("pre_req_books",($this->input->post('pre_req_books')) ? $this->input->post('pre_req_books') : ((isset($program->pre_req_books)) ? $program->pre_req_books : ''));?>
                   <!--<textarea class="mce_editable" style="" rows="10" cols="50" id="pre_req_books" name="pre_req_books" aria-hidden="true">--><?php //echo $this->input->post('pre_req_books') ? $this->input->post('pre_req_books') :((isset($program->pre_req_books)) ? $program->pre_req_books : ''); ?><!--</textarea>-->
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td>Misc Requirements:</td>
                <td>
                    <?php $this->ckeditor->editor("reqmts",($this->input->post('reqmts')) ? $this->input->post('reqmts') : ((isset($program->reqmts)) ? $program->reqmts : ''));?>
                    <!--<textarea class="mce_editable" style="" rows="10" cols="50" id="reqmts" name="reqmts" aria-hidden="true">--><?php //echo $this->input->post('reqmts') ? $this->input->post('reqmts') :((isset($program->reqmts)) ? $program->reqmts : ''); ?><!--</textarea>   -->
					<!--<input type="hidden" id="preqfiles" name="preqfiles" value="">   -->
                </td>
                <td>

                </td>
            </tr>
        </tbody></table>
	</fieldset>
					</div>
				</dd>
<!-- webinar service -->

<dt class="" srno="9" id="dt_9">Webinar Service</dt>
<dd class="" sno="9" id="dd_9">
	<div class="tab-content">
	<fieldset class="adminform">
        <?php if($updType == 'create'){
                $legend = 'New Course';
            }else{
                $legend = 'Edit Course';
            }?>
<legend><?php echo $legend; ?></legend>
					<table class="adminform">
						<tbody><tr>
							<td width="20%">Webinar Status :</td>
							<td>
                               <input type="radio" name="webstatus" id="webstatusactive" value="active" <?php
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
                                ?> />&nbsp;Active&nbsp;&nbsp;
                               <input type="radio" name="webstatus" id="webstatusinactive" value="inactive" <?php
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
                                ?> />&nbsp;Inactive
							</td>
						</tr>

						<tr>
							<td>
								Description:
							</td>
							<td>
                                 <?php $this->ckeditor->editor("webnardescription",($this->input->post('webnardescription')) ? $this->input->post('webnardescription') : ((isset($program->webnardescription)) ? $program->webnardescription : ''));?>
								<!--<textarea class="inputbox" name="metadesc" cols="40">--><?php //echo $this->input->post('metadesc') ? $this->input->post('metadesc') : $metadesc; ?> <!--</textarea>    -->

								<br>
							</td>
						</tr>
					</tbody></table>
	</fieldset>
</div>
</dd>

<!-- webinar service end -->

			</dl>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
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
<?php //echo form_hidden('page',set_value('page', $page)) ?>
<?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>
<input type="hidden" name="media_number" value="<?php //echo $n; ?>" id="media_number"/>

<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$program->id) ?>
<?php endif ?>

<?php echo form_close(); ?>