
<?php
// exit('jyoti');
 if($this->input->get('msg') == 1012)
 {
  echo 'Given time slot is already scheduled. Schedule webinar at another time slot.'; 
 }
 if($this->input->get('msg') == 1022)
 {
  echo 'Given Datetime is invalid.'; 
 }
 if($this->input->get('msg') == 1004)
 {
  echo 'Start Date and Time parameter cannot precede Current Datetime.'; 
 }
?><?php

$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
?>
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
<style type="text/css">
.progress-title {
    cursor: pointer;
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
  <link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
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

	var selvalue = $('input[name=step_access_courses]:checked').val();
	// alert(selvalue);
	if(selvalue == '0')

	{

	document.getElementById("free_courses").style.display="block";
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
  <div class="main-container">
 <?php
$attributes = array('class' => 'tform', 'id' => 'proform','onsubmit'=>'return formvalid()');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/programs/createweb', $attributes) : form_open_multipart(base_url().'admin/programs/editwebinar/'.$id, $attributes);

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
		$pagetitle = 'Edit Course';
    }
	?>
	  <div class="col-sm-4 no-padding">
	      <h2><?php echo $pagetitle;?></h2>
	  </div>
	  <div id="sticky" class="main-content-btn" style="float:right;"> <?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' name='submit' style='display:none;' class='btn btn-success btn-green'" : "id='submit' name='submit' class='btn btn-success btn-green' ")); ?>
	    <?php if ($updType == 'create'): ?>
	    <!-- 	<input type="submit" name="submit" value="Save Changes" id="redirect"  class="btn btn-success btn-green"> -->
	    <img id='loading' style='display:none' src="http://loadinggif.com/images/image-selection/3.gif">
            	<input type="button"  value="Save Changes " name="submit" class="btn sub_ass btn-success" onclick="save_webinar('1')"> 
<!-- 	    	<button type="button" class='btn btn-success btn-green' onclick="return formvalid()"> Save Changes</button>
 -->	    <?php if ($parent_id != "0"): ?>
<!-- 	    	<button type="button" class='btn btn-success btn-blue' onclick="return formvalid()" id="savebtn"> Save & Back to list</button>
 -->	    	<input type="submit" value="Save & Back to list" name="save2" class='btn btn-success btn-blue' id="save2">
	    <a href='<?php echo base_url(); ?>admin/course-manager/' class='btn btn-default btn-dark-grey'>Cancel </a>
	    <?php else: ?>
	    <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='btn btn-default btn-dark-grey'></span>Cancel</a>
	    <?php endif ?>
	    <?php else: ?>
	    <?php if ($parent_id != "0"): 
	     $parent_idd = $this->uri->segment(3);	?>
             	    <img id='loading' style='display:none' src="http://loadinggif.com/images/image-selection/3.gif">
             	    	<input type="button" value="Save Changes" name="submit" class="btn sub_ass btn-success" onclick="save_webinar('1','<?php echo $parent_idd;  ?>')"> 
             	    	<input type="button" value="Save & Back to list" name="edit2" class='btn btn-orange sub_ass' onclick="save_webinar('2','<?php echo $parent_idd;  ?>')">?>
	    	<!-- <input type="submit" value="Save & Back to list" name="edit2" class='btn btn-success btn-blue'> -->
	    <a href='<?php echo base_url(); ?>admin/course-manager' class='btn btn-default btn-dark-grey'>Cancel</a>
	    <?php else: ?>
	    <a href='<?php echo base_url(); ?>admin/programs/<?php echo $page?>/' class='btn btn-default btn-dark-grey'>Cancel</a>
	    <?php endif ?>
	    <?php endif ?>
	  <div class="clr"></div>
	  </div>
  </div>
  <div id="sticky-anchor"></div>
</div>

<div class="field_container">
<div class="row">
<div class="col-md-6 field_content" style="width: 100%;">
	<div class="pmaintitle main_subtitle">
    	<p >If this is the first course you are creating then you need to create course categories through the <a href='<?php echo base_url();?>admin/pcategories/'>"Course Category Manager" </a> And teachers through the <a href='<?php echo base_url();?>admin/aclp/'>"Users and Permissions Manager"</a>  </p>
    	<?php if ($updType == 'edit'){ ?>
    	<a class="link_page" style="float: right;" href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>">
    	<div class="sprite 2edit tab_icon" style="margin: -12px 6px 20px 0px;float:right;background-position: -32px 0;" title="Course Content">
             </div>
    	<!-- <div class="sprite 7settings" style="margin: -6px 6px 13px 0px;float:right;background-position: -184px 0" title="Course Content"></div> --></a>
    	<?php } ?>
  	</div>
  	<div class="col-sm-12 progress-container">
  		<!-- <div class="col-sm-3" title="Add course info">
  			<div class="col-sm-2 white-circle activecircle" id="one" ><span>1</span></div>
  			<div id="courseInfo" class="col-sm-10 progress-title" style="padding-right:0"><span >ADD COURSE INFO</span></div>
  		</div> -->
  		<div class="col-sm-3" style="padding-left:7px" title="Add course info" >
  			<div class="col-sm-2 white-circle activecircle" id="one" ><span>1</span></div>
  			<div class="col-sm-10 progress-title" id="courseInfo" style="padding-right:0"><span >ADD COURSE INFO</span></div>
  		</div>
  		<div class="col-sm-3" style="padding-left:0" title="Set pricing and subscriptions" >
  			<div class="col-sm-2 white-circle" id="two" ><span>2</span></div>
  			<div class="col-sm-10 progress-title" id="priSub" style="padding-right:0"><span >SET PRICING AND SUBSCRIPTIONS</span></div>
  		</div>
  		<div class="col-sm-3" style="padding-left:0" title="Add exercise files" >
  			<div class="col-sm-2 white-circle" id="three" ><span>3</span></div>
  			<div class="col-sm-10 progress-title" id="exeF" style="padding-right:0"><span >EXERCISE FILES</span></div>
  		</div>
  		
  	</div>
  <ul class="nav nav-tabs bordered grey-border blue-border">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active" style="border-left:none!important;"> <a href="#course_detail" data-toggle="tab" class="li-border" id="info_course"> <span class="visible-xs" ><i class="entypo-home"></i></span> <span class="hidden-xs">COURSE INFO</span> </a> </li>
    <!--<li> <a href="#description_tab" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Description</span> </a> </li>-->
    <!-- <li> <a href="#image" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Upload Image</span> </a> </li>
    <li> <a href="#exercise" data-toggle="tab"> <span class="visible-xs"><i class="entypo-mail"></i></span> <span class="hidden-xs">Exercise files</span> </a> </li> -->
    <li> <a href="#ps" data-toggle="tab" class="li-border" id="pr_sub"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Pricing / Subscription</span> </a> </li>
    <li> <a href="#exe_f" data-toggle="tab" class="li-border" id="exe_file"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Webinar Schedule</span> </a> </li>

    <!-- li> <a href="#publishing" data-toggle="tab" class="li-border" id="pub_course"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Publish Course</span> </a> </li> -->
    <!-- <li> <a href="#mtags" data-toggle="tab"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Meta Tags</span> </a> </li> -->
   
    <!-- <li> <a href="#requirements" data-toggle="tab" class="li-border" id="adv_set"> <span class="visible-xs"><i class="entypo-cog"></i></span> <span class="hidden-xs">Advanced Settings</span> </a> </li> -->
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
          <label class='col-sm-12 control-label field-title' for="name"><?php //echo lang('web_name')?>Course Title <span class="required">*</span>
          	<p>(e.g. Innovation Management - Please give a short and clear title)</p>
          	<!-- <span class="tooltipcontainer que-icon"> <span type="text" id="name-target" class="tooltipicon" title="Click Here"></span> <span class="name-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"> </span> <?php echo lang('course_fld_name');?> </span> </span> <span class="error"><?php echo form_error('name'); ?></span> -->
          </label>
          <div class="col-sm-12">
            <input id="name" type="text" class="form-control form-height" name="name" maxlength="256" value="<?php echo set_value('name', (isset($program->name)) ? $program->name : ''); ?>"  title="Enter Course Title" data-validation="required" data-validation-error-msg="Enter valid Question" />
             
          </div>
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
        <div class="form-group form-border">
          <label class="col-sm-12 control-label field-title" for="description"><?php echo lang('web_description')?>
          	<p>(Please give a description of your course)</p>
          	<!-- tooltip area --> 
            
            <!-- <span class="tooltipcontainer que-icon"> <span type="text" id="description-target" class="tooltipicon" title="Click Here"></span> <span class="description-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            
            
            <?php echo lang('course_fld_description');?> </span> </span> <span class="error"><?php echo form_error('description'); ?></span> -->
          </label>
          <div class="col-sm-12">
            <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
            <textarea style="display:none" name="description" data-validation="required"  id="description1" class="form-control" rows="6">	</textarea>
                <textarea  name="description1" data-validation="required"  id="description" class="form-control form-height" rows="4"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea>

           <!--  <textarea name="description" id="description" class="form-control form-height" rows="4"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : '');?></textarea> -->
            <input name="image" type="file" id="upload" class="hidden" onchange="">
            
            </div>
        </div>
        <!-- new code end here -->
        <!-- image upload section start here -->
        <div class="form-group form-border">
          <label for="image" class="col-sm-12 control-label field-title">Upload Image
          	<p>(Please upload Course Image)</p>
          	<!-- <span class="tooltipcontainer que-icon"> 
                <span type="text" id="imgname-target" class="tooltipicon" title="Click Here"></span> 
                <span class="imgname-target  tooltargetdiv" style="display: none;" > 
                <span class="closetooltip"></span> <?php echo lang('course_fld_add-image');?> 
                </span> 
            </span> --> 
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
                      	<div class="col-sm-8" style="padding:0;">
                        <?php if ($updType == 'edit'){ ?>
                        	<div class="col-sm-6 img-grey-border">
	                        	<a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo $this->uri->segment(4);?>/courseedit" class="upimg_pop"><img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $program->image ?>" width="150" name="imagename" id="imagname"/>
	                        	<img id="blah" src="#" alt="your image" width="150" /></a>
	                        </div>
                        	<div class="col-sm-6">
                        		<a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo $this->uri->segment(4);?>/courseedit" class="upimg_pop btn btn-success btn-border-blue img-align">Upload Image</a>
                        	</div>
						
                        <?php }else{  ?>
                        
                        	<div class="col-sm-6 img-grey-border">
                        		<a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo $this->uri->segment(4);?>/coursecreate" class="upimg_pop"><img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg' ?>" width="150" name="imagename" id="imagname"/>
                        		<img id="blah" src="#" alt="your image" width="150" /></a>
                        	</div>
                        	<div class="col-sm-6">
                        		<a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/<?php echo $this->uri->segment(4);?>/coursecreate" class="upimg_pop btn btn-success btn-border-blue img-align">Upload Image</a>
							</div>
						  </div>
						<input type="hidden" name="cropimage" id="cropimage" value="no_images.jpg" >
                        <?php } ?>
                        </div>
                      </div>
                      <br />
                      

                      <input type="file" name="file_i" id="file_i" class="upload_btn" style="display: none;" >			
					  <input type='button' id='remove_id' value='remove' class="btn btn-danger"/>
                      
                   
          
        <!-- image upload section end here -->
        <div class="col-sm-12 select-main-box form-border">
	        <div class="form-group form-border select-form">
	        	
		          <label class='col-sm-12 control-label field-title' for='category_id'><?php echo lang('web_category')?> <span class="required">*</span>
		          	<p>(Please select Course Category)</p>
		          	<!-- <span class="tooltipcontainer que-icon"> <span type="text" id="category-target" class="tooltipicon" title="Click Here"></span> <span class="category-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span>
		          	
		            
		            <?php echo lang('course_fld_category');?> </span> </span> <span class="error"><?php echo form_error('category_id'); ?></span>  -->
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
		          <a href="<?php echo base_url(); ?>admin/pcategories/createcategory" id="cropcategory" class="newsect_pop btn btn-success btn-border-blue btn-style" style="margin-left: 20px;">Create New Category</a>
	        </div>
	        
	        <div class="form-group select-form form-border" style="margin-left:15px;">
	          
		          <label class="col-sm-12 control-label field-title">Teacher<span class="required">*</span>
		          	<p>(Please select Course Teacher)</p>
		          	<!-- <span class="tooltipcontainer que-icon"> <span type="text" id="teacher-target" class="tooltipicon" title="Click Here"></span> <span class="teacher-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
		          	 
		            
		            <?php echo lang('course_fld_teacher');?> </span> </span> <span class="error"><?php echo form_error('teacher_id'); ?></span>  -->
		          </label>
		          	<div class="col-sm-12" style="padding-right:0;">
			          	<select name='teacher_id' id='teacher_id' title="Select Trainer for current course" class="form-control form-height" onchange="disableAssistant();" data-validation="required" data-validation-error-msg="Enter valid Question">
			              	<option value=''><?php echo '- select -';?></option>
							<!--<option value='<?php echo $u_data['id']?>' <?php echo (@$program->author == $u_data['id']) ? 'selected' : ''  ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>-->
							<option value="<?php echo $u_data['id']?>" <?php echo ($this->input->post('teacher_id') == $u_data['id']) ? "selected=selected" : (isset($u_data['id'])) && @$program->author == $u_data['id'] ? "selected=selected" : '' ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>
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
                    <div class="form-group form-border">
						<label class="col-sm-12 control-label field-title">Assistant Teachers:
							<p>(Please select Assistant Teacher if any)</p>
							<!-- <span class="tooltipcontainer que-icon">

						<span type="text" id="level-target1" class="tooltipicon" title="Click Here"></span>

						<span class="level-target1  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>					

						<?php echo lang('course_fld_level');?>					

						</span>

						</span> -->
						</label>
						
						<div class="col-sm-6">
							
                   <?php							 
						// if($u_data['groupid'] == 4) 
						// {
                  	 if(isset($program->introtext)){

               		 $assistantid = explode('|',$program->introtext);

                		 }
							?>					
	                        <select class="form-control select-box-border" name='assistant_id[]' id='assistant_id' title="Select Trainer for current course" multiple="multiple">
								<option value=''><?php echo '- select -';?></option>
								
								<option value="<?php echo $u_data['id']?>" <?php echo isset($program->introtext) && in_array($u_data['id'],$assistantid)? "selected" :""; ?>><?php echo $u_data['first_name'].' '.$u_data['last_name'] ?></option>
								<?php foreach ($teachers as $teacher): ?>
								
								<option value="<?php echo $teacher->userid;?>"<?php echo isset($program->introtext) && in_array($teacher->userid,$assistantid) ? "selected":""; ?>><?php echo $teacher->fullname;?></option>
								<?php endforeach ?>
							</select>
							

						


						</div>
					</div>
                    <!-- new field for assistant teacher end here -->

        <div class="form-group form-border">
          <label class="col-sm-12 control-label field-title">Level:
          	 <p>(Please select Course Level)</p>
          	 <!-- tooltip area --> 
          	<!-- <span class="tooltipcontainer que-icon"> <span type="text" id="level-target" class="tooltipicon" title="Click Here"></span> <span class="level-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
          	
            
            <?php echo lang('course_fld_level');?> </span> </span> --> 
          </label>
          <div class="col-sm-12">
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
        <br/>
        <div class="form-group form-border" style="border-bottom:none!important"> 
						
						<div class="col-sm-5" id="nexttab1"> 
						<button type="button" class="btn btn-success btn-green tab-btn" onclick="return formvalid()"> Save Changes</button>
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
        <div class="tab-content ">         

        </div>

      </dd>
    </div>
	
	
	
    <div class="tab-pane" id="exercise">
      <dd class="" sno="4">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            
            <div class="form-group form-border"> 
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
   <div class="tab-pane" id="exercise">
      <dd class="" sno="4">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
            
            <div class="form-group form-border"> 
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
           <p class="psubtitle field-subtitle"> <!-- Through this option you can choose to make the course free for all students/free for some students and Paid for other /paid for all. -->You can set fixed price, subscription plans or set it free.</p>
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
            <div class="form-group form-border">

			  
			  
             <!-- comment by me  <label class="col-sm-3 control-label"></label> -->
			   
              <div class="col-sm-12 Sel_div" >
			    <div class="grey-background">
                <?php
        //($this->input->post('chb_free_courses')? $this->input->post('chb_free_courses') : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : ''); ?>
                <!-- <input id="chb_free_courses" name="chb_free_courses" type="checkbox" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : '';?>> -->
               <!--  This course is free for students -->
                Is this course FREE for Students ?
                <span class="radio_btn dark_label">
               <?php if($updType == 'create'){?>
                 <input style="margin-top:1%;" type="radio" id="chb_free_courses1" name="chb_free_courses" value="0"> Yes
                &nbsp;
  				<input style="margin-top:1%;" type="radio" id="chb_free_courses2" name="chb_free_courses" value="1" checked> No </span>
  				<?php } 
  				else{ ?>
  				<span class="radio_btn dark_label">

	  				<input type="radio" id="chb_free_courses1" name="chb_free_courses" value="0" <?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '0' ? "checked" : '';?>> Yes
	               &nbsp;
	  				<input type="radio" id="chb_free_courses2" name="chb_free_courses" value="1"<?php echo ($this->input->post('chb_free_courses')) ? "checked" : isset($program->chb_free_courses) && $program->chb_free_courses == '1' ? "checked" : '';?> > No </span>

  				<?php } ?>
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
            <div class="form-group form-border">
              <div id="free_courses" style="display: none;" class="col-sm-12 ">
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
          

		  <div class="col-sm-12" style="padding:0" id="priceDiv" >
			<label class="field-title"> Pricing Mode for this course :</label>
			<div class="col-sm-12" style="padding:0;" id="sel_stu">
			   <div class="grey-background">
			    <div class="col-sm-12 no-padding">
			   <span class="col-sm-3 no-padding" id="reg_rad">
				<input style="margin-top: 1%;" class="radio-btn reg_rad" type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan" <?php if(@$program->fixedrate > 0.00 || $updType == 'create') echo 'checked';else if($updType == 'create')echo 'checked'; ?> value="fixed"/><!-- Fixed Price    --><label class="dark_label" >Regular Based</label></span>
				<span class="col-sm-9 no-padding">
				<p class="" style="padding-top:1%;"><!-- This option allow students to make a one time payment for the course. -->   (Students will make one time payment for the course)</p></span></div>
			  </div>
			</div>
			<br>
			<div class="col-sm-12" style="padding:0;"> 
			 <div class="grey-background"> 
			<div class="col-sm-12 no-padding">
			 <span class="col-sm-3 no-padding">
			  <input style="margin-top: 1%;" class="radio-btn sub_rad" type="radio" onclick="javascript:getPlan(this.value)" name="plan" id="plan" <?php if(@$countplans) echo 'checked';  ?> value="subscription" /><label class="dark_label">Subscription Based  </label></span>
			  <span class="col-sm-9 no-padding">
			  <p class="" style="padding-top:1%;"><!-- This option will allow students to access the course for pre-defined time period, suitable for courses that may get updated with new lectures and live classes regularly. --> (Students will subscribe to subscription plan by paying the respective Subscription plan price)</p></span></div>
		  	 </div>
		  	</div>
		  	<div class="col-sm-12 no-padding"><p style="padding-top:1%;">Note: Students subscribed to the course will get updated with new lectures added and live classes regularly.</p></div>
		  </div>

		  <div class="form-group form-border">
                <label for="field-1" style="padding:0;" class="col-sm-12 control-label field-title">Set Price :</label>
                <p style="font-family: arial;color: #686c70;">e.g. 18.99 (Enter only numerics &amp; this price will not be use)
				</p>
                <div class="col-sm-12" style="padding:0;">
                  <input type="text" name="demofixedrate" class="form-control form-height" id="demofixedrate" value="<?php echo (isset($program->demoprice)) ? $program->demoprice : '' ?>" onkeypress="return isNumberKey(event)">
                </div>
                
            </div>
		  
          <fieldset class="adminform" id="price_subs" style="<?php if(@$program->fixedrate > 0.00 || isset($countplans)) { echo 'display:block'; } else { echo 'display:none'; } ?>">
            <legend class="field-title pricing-gap">Pricing / Subscriptions</legend>
			
			<div class="form-group form-border" id="fixed_rate" style="<?php if(@$program->fixedrate > 0.00) { echo 'display:block'; } else{ echo 'display:none'; }  ?>">
                <label for="field-1" style="padding:0;" class="col-sm-12 control-label field-title"><!-- For Fixed Rate -->Set Regular Fixed Price :</label>
                <p style="font-family: arial;color: #686c70;"><!-- (Amount to be set for the course fees.Enter only numerics and the fees will be display in the currency you have set.) -->e.g. 18.99 (Enter only numerics & the price will be displayed with the academy currency you have set)
				</p>
                <div class="col-sm-12" style="padding:0;">
                  <input type='text' name='fixedrate' class='form-control form-height' id='fixedrate' value="<?php echo (isset($program->fixedrate)) ? $program->fixedrate : '' ?>" onkeypress="return isNumberKey(event)">
                </div>
                
            </div>
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
						<button type="button" class="btn btn-success btn-green tab-btn" onclick="return formvalid()"> Save Changes</button>
	 				 </div>

				</div>
        </div>
      </dd>
      <div style="clear:both;"></div>
    </div>

    <div class="tab-pane" id="exe_f">
      <dd class="" sno="06" id="dd_06">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
          <legend class="field-title tile_fld legend-gap"> Webinar for Logistics Assem </legend>   
         
                <?php //print_r($webinar);
$gmtime = date("h:i");
$gmdate = date("Y-m-d"); ?>
              
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
            <!-- // -->

            <div class="form-group form-border"> 
            	 
      <label class="col-sm-2 control-label field-title"><?php echo 'Starts On'?> <span class="required">*</span></label> 

      <div class="col-sm-9"> 
      	
      <div class="col-sm-4" style="float:left; padding: 0;"> 
                       <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php if($updType=='create'){echo $gmdate;} else{  echo set_value('fromdate', (isset($webinars->fromdate)) ? $webinars->fromdate : ''); } ?>"  />  
                       <!-- <?php echo date("m-d-Y"); ?> -->
                       <!-- <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php echo date("m-d-Y"); ?>"  /> -->  
                     </div> 
                    
                    <div class="col-sm-4" style="float:left; padding: 1%;"> 
                    	<input name="fromtime11" id="fromtime11" type="hidden"> 
        <input type="time" name="fromtime" id="fromtime" value="<?php if($updType=='create'){echo $gmtime;} 
        else{ echo set_value('fromtime', (isset($webinars->fromtime)) ? $webinars->fromtime : ''); }?>">
       <?php if($updType == 'edit' ){ ?><input type="hidden" name="webid" value="<?php echo $webinars->id; ?>">  <?php } ?>              
<span>GMT</span>

</div>


          
                    <span class="error"><?php echo form_error('fromdate'); ?></span><span class="error">
                    <?php echo form_error('fromtime'); ?></span> 

      </div> 
    </div>
     <div class="form-group form-border"> 
      <label class="col-sm-2 control-label field-title">
        Duration<span class="required">*</span>
      </label>
      <div class="col-sm-9">

        <div class="col-sm-9" style="float:left; padding: 1%;"> 
        <input type="text" placeholder="Ex.30" value="<?php if($updType=='create'){echo '30';} else{ echo set_value('web_duration', (isset($webinars->web_duration)) ? $webinars->web_duration : ''); }?>" id="web_duration" name="web_duration"> (Enter duration between 30 to 300 minutes.)
        </div>
        </div>
    </div>
    <div class="form-group  form-border"> 
	      <label class="col-sm-2 control-label field-title">
	        Attendees Limit
	      </label>
	      <div class="col-sm-9">

	        <div class="col-md-9" style="float:left; padding: 1%;"> 
	        <input type="number" placeholder="No limit" value="<?php if($updType=='create'){echo '';} else{ echo set_value('attendees_limit', (isset($webinars->attendees_limit)) ? $webinars->attendees_limit : ''); }?>" id="attendees_limit" name="attendees_limit"> 
	        </div>
	        </div>
	    </div>
    <!-- // -->

            <?php if($updType == 'create'){

                $legend = ' ';

            }else{

                $legend = 'Edit Course';

            }?>

            <div class="form-group form-border"> 
						
					<div class="col-sm-5" id="nexttab06" style="padding-top:2%;">
						<button type="button" class="btn btn-success btn-green tab-btn" onclick="return formvalid()"> Save Changes</button>
	  </div>
					</div>
          </fieldset>
        </div>
      </dd>
    </div>

  
    <div class="tab-pane" id="requirements">
      <dd class="" sno="8" id="dd_8">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered" style="margin-top:2%;">
            <!-- Course type section start here -->
            <legend class="field-title tile_fld legend-gap" style="margin-bottom:0px;"> Course Advanced Settings<!-- <?php echo $legend; ?> --></legend>
            		<div class="form-group form-border">
          <label class="col-sm-12 control-label field-title">Course type to Certificate term :
          	<p>(Select whether the course lectures will be available to the students in a pre-defined sequence only or can access in non-sequential manner.)</p>
          </label>
          <div class="col-sm-12">
            <?php

						$pcourse_type1 = ($this->input->post('course_type') == 0) ? 'selected="selected"' : '';

						$pcourse_type2 = ($this->input->post('course_type') == 1) ? 'selected="selected"' : '';

						?>
            <select class="form-control form-height"  name="course_type" id="course_type">
              <option value="0" <?php echo ($this->input->post('course_type') == '0') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 0 ? 'selected="selected"' : $pcourse_type1) ?>> Non-Sequential </option>
              <option value="1" <?php echo ($this->input->post('course_type') == '1') ? "selected=selected" : (isset($program->course_type) && $program->course_type == 1 ? 'selected="selected"' : $pcourse_type2) ?>> Sequential</option>
            </select>
            
            <!-- tooltip area --> 
            
           <!--  <span class="tooltipcontainer"> <span type="text" id="course_type-target" class="tooltipicon"></span> <span class="course_type-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
             
            
            <?php echo lang('course_fld_course-type');?> </span> </span> --> 
           </div>
       
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
        <div class="form-group form-border">
          <label class="col-sm-12 control-label field-title">Final Exam :
          	<p>(if you want to include the final exam you will need to create exam through <a href="<?php echo base_url();?>admin/quizzes/">"Exam Manager")</a></p>
          </label>
          <div class="col-sm-12">
            <select name="final_quizzes" id="final_quizzes" class="form-control form-height" onchange="<?php if($facility == 'foolproof') { echo 'webcamVisiable()'; } ?>">
              <option value="0">no final exam</option>
              <?php foreach($finalexamlist as $finalexam){ ?>
              <option value="<?php echo $finalexam->id;?>" <?php echo ($this->input->post('final_quizzes') == $finalexam->id) ? "selected=selected" : (isset($program->id_final_exam)) && $program->id_final_exam == $finalexam->id ? "selected=selected" : '' ?>><?php echo $finalexam->name;?></option>
              <?php }?>
            </select>
            
            <!-- tooltip area --> 
            <!-- <span class="tooltipcontainer"> <span type="text" id="final_quizzes-target" class="tooltipicon" title="Click Here"></span> <span class="final_quizzes-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            <?php echo lang('course_fld_final-exam');?> </span> </span>  -->
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
        <div class="form-group form-border" id = "webcamDiv" style="<?php echo $display;?>" >
          <label for="field-ta" class="col-sm-12 control-label field-title" style="padding-top:0;">Webcam & Screenshots Option :
  
                <input id="webcam_option" name="webcam_option" type="checkbox" onclick='hideShowWebcamTime();' <?php echo ($this->input->post('webcam_option')) ? "checked" : isset($program->webcam_option) && $program->webcam_option == '1' ? "checked" : '';?>  >
                
                <!-- tooltip area --> 
               <!--  <span class="tooltipcontainer"> <span type="text" id="webcam_option-target" class="tooltipicon" title="Click Here"></span> <span class="webcam_option-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                <?php echo lang('course_fld_webcam-option');?> </span> </span>  -->
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
          
        </div>
        <div style="clear:both;"></div>

        <div class="form-group form-border" id = "showresultDiv" style="<?php echo $display;?>" >
          <label for="field-ta" class="col-sm-12 control-label field-title" style="padding-top:0px;">Moderate Exam :
          	<input id="show_result" name="show_result" type="checkbox" <?php echo ($this->input->post('show_result')) ? "checked" : isset($program->show_result) && $program->show_result == '1' ? "checked" : '';?>  >
                
                <!-- tooltip area --> 
                <!-- <span class="tooltipcontainer"> <span type="text" id="show_result-target" class="tooltipicon" title="Click Here"></span> <span class="show_result-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                <?php echo lang('course_fld_webcam-option');?> </span> </span> --> 
                <p> (This Functionality will Show or Pending Exam)</p>
              
          </label>
          
        </div>

        <div class="form-group form-border">
          <label class="col-sm-12 control-label field-title" style="padding-top:0px;">Certificate Term :</label>
          <div class="col-sm-12">
            <select class="form-control form-height" onchange="javascript:certificatemessage(this.selectedIndex)" name="certificate_setts" id="certificate_setts">
              <option value="1" <?php echo ($this->input->post('certificate_setts') == '1') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '1' ) ? "selected=selected" : '' ?> >No Certificate</option>
              <option value="2" <?php echo ($this->input->post('certificate_setts') == '2') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '2' ) ? "selected=selected" : '' ?> >After successful completion of all lectures</option>
              <option value="3" <?php echo ($this->input->post('certificate_setts') == '3') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '3' ) ? "selected=selected" : '' ?> >After passing the final exam</option>
              <option value="4" <?php echo ($this->input->post('certificate_setts') == '4') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '4' ) ? "selected=selected" : '' ?> >After passing the exams on an average </option>
              <option value="5" <?php echo ($this->input->post('certificate_setts') == '5') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '5' ) ? "selected=selected" : '' ?> >After finishing all the lectures and passing the final exam</option>
              <option value="6" <?php echo ($this->input->post('certificate_setts') == '6') ? "selected=selected" : (isset($program->certificate_term) && $program->certificate_term == '6' ) ? "selected=selected" : '' ?> >After finishing all the lectures and passing all the exams on an average </option>
            </select>
            <!-- tooltip area --> 
            <!-- <span class="tooltipcontainer"> <span type="text" id="certificate_setts-target" class="tooltipicon" title="Click Here"></span> <span class="certificate_setts-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            
            <?php echo lang('course_fld_certificate-term');?> </span> </span>  -->
            
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
        <div class="form-group form-border" style="display:none;" id="coursecertifiactemsg">
          <label class="col-sm-12 control-label field-title" >Certificate course message</label>
          <div class="col-sm-12">
            <textarea maxlength="7000" name="coursemessage" id="coursemessage" class="form-control select-box-border"><?php echo set_value('certificate_course_msg', (isset($program->certificate_course_msg)) ? $program->certificate_course_msg : '');?></textarea>
          </div>
        </div>
        <div style="clear:both;"></div>

            <!-- course type section end here -->
            <!-- webinar section start here -->
            <?php  
				$this->load->config('features_config');
				$webinar = $this->config->item('webinar');				
				
				if($webinar['status']==TRUE)
				{
					
			?>
            <?php if($updType == 'create'){

                $legend = 'Webinar Service';

            }else{

                $legend = 'Edit Course';

            }?>
          <!--   <legend class="field-title"><?php echo $legend; ?></legend> -->
          <div class="seperator"></div>
          <legend class="field-title tile_fld legend-gap"> Webinar Settings</legend>
            <div class="form-group form-border dark_label">
            
              <label class="col-sm-12 control-label field-title">Webinar Status :
         	 	<p>(This is the live class mode for taking live classes, if you wish to include live class in your course please select "Active". You can schedule and edit live classes / webinars for each lectures from  <a href="<?php echo base_url();?>admin/programs/">course manager.)</a></p>
         	  </label>
         	  <div class="col-sm-12">
         	   <div class="grey-background">
                <input style="margin-top:1%;" type="radio" onclick="javascript:getWebDesc(this.value)" name="webstatus" id="webstatusactive" value="active" <?php

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
                <input style="margin-top:1%;" type="radio" onclick="javascript:getWebDesc(this.value)" name="webstatus" id="webstatusinactive" value="inactive" <?php

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
                                else if($updType == 'create'){
                                	echo 'checked';
                                }


                             }

                                ?> />
                &nbsp;Inactive
                
                </div>
                </div>
                <!-- <span class="tooltipcontainer"> <span type="text" id="webstatus-target" class="tooltipicon" title="Click Here"></span> <span class="webstatus-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                
                <?php echo lang('course_fld_webinar-status');?> </span> </span> --> 

            </div>
            <div class="form-group form-border" id="desc_tr" style="<?php echo ((@$program->webstatus)=='active') ? "display:block" : "display:none" ?>">
              <label for="field-ta" class="col-sm-12 control-label field-title">Description:
              	<p class="p4">(Here you can put a brief description of the agenda of the live classes.)</p>
              </label>
              <div class="col-sm-12">
                
                <textarea rows="6"  class="form-control select-box-border" id="webnardescription" name="webnardescription"><?php echo ($this->input->post('webnardescription')) ? $this->input->post('webnardescription') : ((isset($program->webnardescription)) ? $program->webnardescription : '');?></textarea>
              
              </div>
              <!-- tooltip area --> 
              
              <!-- <span class="tooltipcontainer"> <span type="text" id="webnardescription-target" class="tooltipicon" title="Click Here"></span> <span class="webnardescription-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              
              
              <?php echo lang('course_fld_webinar-servic-description');?> </span> </span>  -->
              </div>
              <?php } ?>
            <!-- webinar section end here -->
            <?php if($updType == 'create'){

                $legend = ' ';

            }else{

                $legend = ' ';

            }?>
            <div class="seperator"></div>
           <!--  <legend><?php echo $legend; ?></legend> -->
            <!-- <legend class="field-title tile_fld legend-gap"> Exercise Files</legend>   
             <label class="control-label field-title">select from existing files to before edit course</label>
         
          </p>       
             <a href = "<?php echo base_url(); ?>admin/medias/addmedia/" class='btn btn-info exifiles_pop btn-border-blue' id="exifiles">Select from existing files</a> 
            <a href = "<?php echo base_url(); ?>admin/medias/createexercisefile/" class='btn btn-success newexe_pop btn-border-green' id="newexefile">Add new exercise file </a> 
            <div style="clear:both">
            <br />
            <table class="table table-bordered datatable dataTable table-gap" id="myTable">
              <thead>
                <tr>
                  <th align="center">#</th>
                  <th align="center">Type</th>
                  <th align="center"><strong>File/Media name</strong></th>
                 
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
					<tr> <td colspan="6" class="dark_label" id="exeid">No Exercise Files yet !</td></tr>
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
                  <td><?php echo $media->id ?>
                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>"></td>
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
                  <td><?php echo $media->alt_title ?></td>
                 
					<td><a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a></td>
                </tr>
                <?php 
				}
				if(!$getMedia){ ?>
                	<tr> <td colspan="6" class="dark_label" id="exeid">No Exercise Files yet !</td></tr>
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
                	<tr><td colspan="6" class="dark_label" id="exeid">No Exercise Files yet !</td></tr>
                <?php	}
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
            <div class="seperator"></div> -->
            <!-- <legend><?php echo $legend; ?></legend> -->
            <legend class="field-title tile_fld legend-gap"> Course Requirement / Pre-requisites</legend>
            <div class="form-group form-border" style="padding-top:0!important">
            
              <label for="field-1" class="col-sm-12 control-label field-title">Prerequisites Course(s):
              	<p>(In case you feel that this is an advanced course and requires completion of other basic course for better understanding to students then click on the button to add the pre-requisite course. Once you save this, then only those student who have completed those course will be able to apply.)</p>
              </label>
              <div class="col-sm-12">
              <a href = "<?php echo base_url(); ?>admin/programs/addcourse/" class="addcourse_pop btn btn-info btn-border-blue" id="precourse">Add Pre-requisites Course </a>
              <!-- tooltip area --> 
              
              <!-- <span class="tooltipcontainer"> <span type="text" id="prerequisites_Course-target" class="tooltipicon" title="Click Here"></span> <span class="prerequisites_Course-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              
              
              <?php echo lang('course_fld_prerequisites-Course');?> </span> </span>  -->
               </div>
              </div>
            <?php

                $table_display = "table";

                ?>
            
					<table id="table_courses_id" class="table table-bordered responsive table-top-gap table-gap">

                        <tbody id="rowspreq">

                            <?php //if(isset($media_files)) {?>

                            <tr>
                            
                                <td width="8%" style="background: #F5F5F6;"><strong>ID</strong></td>

                                <td width="56%" style="background: #F5F5F6;"><strong>Name</strong></td>

                                <td width="12%" style="background: #F5F5F6;"><strong>Remove</strong></td>
                              
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

                            </tr> <?php
                             }
                           } 
                         }
                         else if($updType == 'create' &&  $get_req_ids == '')
                         { ?>
                     		<tr><td colspan="5" class="dark_label" id="reqid">No Pre-requisites Course yet !</td></tr>
                            <?php }

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
                             if(!$getRequProduct){ ?>
                             	<tr><td colspan="5" class="dark_label" id="reqid">No Pre-requisites Course yet !</td></tr>
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
                             if(!$rerequisites){ ?>
                             	<tr><td colspan="5" class="dark_label" id="reqid">No Pre-requisites Course yet !</td></tr>
                             <?php }
                            }  }
                            ?>
						</tbody>
                        <input id="preqfiles" name="preqfiles" value="<?php echo ($this->input->post('preqfiles') ? $this->input->post('preqfiles') : '')?>" type="hidden">

                    </table>
            <div class="form-group form-border">
				<label for="field-ta" class="col-sm-12 control-label field-title ">Other Prerequisites:</label>
				<div class="col-sm-12">
                <textarea name="pre_req" id="pre_req" class="form-control select-box-border" ><?php echo $this->input->post('pre_req') ? $this->input->post('pre_req') :((isset($program->pre_req)) ? $program->pre_req : '');?></textarea>
                <!-- tooltip area --> 
              
				<!-- <span class="tooltipcontainer"> <span type="text" id="pre_req-target" class="tooltipicon" title="Click Here"></span> <span class="pre_req-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
				
              
				<?php echo lang('course_fld_other-prerequisites');?> </span> </span> --> 
				</div>
				</div>
            <div class="form-group form-border">
				<label for="field-ta" class="col-sm-12 control-label field-title">Prerequisites Books:</label>
				<div class="col-sm-12">
                <textarea class="form-control select-box-border" style="" id="pre_req_books" name="pre_req_books" aria-hidden="true"><?php echo $this->input->post('pre_req_books') ? $this->input->post('pre_req_books') :((isset($program->pre_req_books)) ? $program->pre_req_books : ''); ?></textarea>
                <!-- tooltip area --> 
              
				<!-- <span class="tooltipcontainer"> <span type="text" id="pre_req_books-target" class="tooltipicon" title="Click Here"></span> <span class="pre_req_books-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
				
              
				<?php echo lang('course_fld_prerequisites-books');?> </span> </span> -->
				</div>
				 </div>
            <div class="form-group form-border">
              <label for="field-ta" class="col-sm-12 control-label field-title">Misc Requirements:</label>
              <div class="col-sm-12"> 
                <!--<input type="hidden" id="preqfiles" name="preqfiles" value="">   -->
                <textarea name="reqmts" id="reqmts" class="form-control select-box-border"><?php echo $this->input->post('reqmts') ? $this->input->post('reqmts') :((isset($program->reqmts)) ? $program->reqmts : ''); ?></textarea>
                <!-- tooltip area --> 
              <!-- <span class="tooltipcontainer"> <span type="text" id="reqmts-target" class="tooltipicon" title="Click Here"></span> <span class="reqmts-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              <?php echo lang('course_fld_misc-requirements');?> </span> </span> -->
              </div>
               </div>

              <div class="form-group form-border"> 
						
					<div class="col-sm-5" id="nexttab7" style="padding-top:2%;">
						<button type="button" class="btn btn-success btn-green tab-btn" onclick="return formvalid()"> Save Changes</button>
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
  <?php if ($updType == 'edit'){ ?>
  <div ><a class="link_page" style="float: right;" href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>">
  <div class="sprite 2edit tab_icon" style="background-position: -32px 0;" title="Course Content">
             </div>
  <!-- <div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div> --><span class="crosslink">Go to Course Content</span></a></div>
  <?php } ?>
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
	    	var vv1 =  $("input[name='chb_free_courses']:checked").val();
	    	//var vv1 =  $("input[name='step_access_courses']:checked").val(); //$("#step_access_courses").val();
	    	
	    	if(vv1 == 0)
	    	{
	    		var vv2 =  $("input[name='step_access_courses']:checked").val();
	    		
			    	if(vv2 == 1)
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

				  		 var vv =  $("input[name='plan']:checked").val();
				    	
			    	     if(vv == "fixed")
				 	     {
				 	     	document.getElementById('free_courses').style.display = 'block';
			 	
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
    	document.getElementById('fixed_rate').style.display = 'none';
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

	jQuery(document).ready(function()
	{
  		jQuery('.li-border').click(function()
  		{
  			var activecircle = jQuery(this).attr('id'); 
     	   $(".activecircle").removeClass("activecircle");
     	   if(activecircle == "info_course")
     	   {     	   	
     	   	$('#one').addClass('activecircle');   	
     	   }
     	   else if(activecircle == "pr_sub")
     	   {    	   		
	     	$('#two').addClass('activecircle');
     	   }
     	   else if(activecircle == "exe_file")
     	   {     	   		
	     	$('#three').addClass('activecircle');
     	   }
     	   

     	});
	});
</script>
<script type="text/javascript">
jQuery('#courseInfo,#one').click(function(){
    jQuery("#info_course").click();
});

jQuery('#priSub,#two').click(function(){
    jQuery("#pr_sub").click();
});

jQuery('#exeF,#three').click(function(){
    jQuery("#exe_file").click();
});


</script>

<!-- js -->
<script type="text/javascript">
function save_webinar2(idd,parent_idd)
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
  alert(description);
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
	                           		window.location ="<?php echo base_url();?>admin/course-manager";
	                       		}
	                       		else{
	                       			window.location ="<?php echo base_url();?>admin/course-manager";
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
	                           		window.location ="<?php echo base_url();?>admin/course-manager";
	                       		}
	                       		else{
	                       			window.location ="<?php echo base_url();?>admin/course-manager";
	                       			// +parent_idd;
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

<!--  -->

