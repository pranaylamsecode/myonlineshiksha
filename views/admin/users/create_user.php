<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script type="text/javascript">
	jQuery(document).ready(function() {
	   jQuery('#add_button').click(function() {
	     jQuery('#desig_field,#details_field').toggle();
	   });
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function() {
	   jQuery('#group_id').on('change',function() {
		 var indexid = jQuery("#group_id").val();
		 if(indexid == 2)
		 {
	      jQuery('#payment_field').css("display","block"); 
		  jQuery('#payment_mode').on('change',function() {
	      var pay_val = jQuery("#payment_mode").val();
		  if(pay_val == "salary" || pay_val == "percent")
		  {
		  jQuery('#payment_type').css("display","block");
		  }
		  else {
		     jQuery('#payment_type').css("display","none");
		  }
		  } );
		 }
		 else{
		   
		   jQuery('#payment_field').css("display","none");
		 }
	   
	   });
	});
</script>
<script type="text/javascript">
jQuery(document).ready(
function()
{}
);
</script>
<script type="text/javascript">
window.onload = function() {
showhidefields();
}
function showhidefields(){
	var selvalue = document.getElementById("group_id").selectedIndex;
    if(selvalue == '1')
	{    
		$('#full_bio').redactor();
		document.getElementById("twitter_td").style.display="table-row";
		document.getElementById("facebook_td").style.display="table-row";
		document.getElementById("blogurl_td").style.display="table-row";
		document.getElementById("websiteurl_td").style.display="table-row";
		document.getElementById("bio_td").style.display="table-row";
	    document.getElementById("email_td").style.display="table-row";
		document.getElementById("title_td").style.display="table-row";
		document.getElementById("stdemail_td").style.display="none";
	}
	else
	{
    document.getElementById("twitter_td").style.display="none";
	document.getElementById("facebook_td").style.display="none";
	document.getElementById("blogurl_td").style.display="none";
	document.getElementById("websiteurl_td").style.display="none";
	document.getElementById("bio_td").style.display="none";
    document.getElementById("email_td").style.display="none";
	document.getElementById("title_td").style.display="none";
    document.getElementById("stdemail_td").style.display="table-row";
	}
}
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
 $(function() {    $( document ).tooltip();  });
</script>
<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => '','autocomplete'=>"off");
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/users/create', $attributes) : form_open_multipart(base_url().'admin/users/edit/'.$id, $attributes);
?>

<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2><?php echo (($updType == 'edit')?'Edit User':'Add User');?></h2></div>
		
	</div>
</div>
<div class="field_container">
<div class="row">
				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">
					<div class="form-group form-border" style="margin:0;">
						<label for="first Name" class="col-sm-12 control-label field-title">First Name<span style="color:#FF0000;" class="error">* </span><span id="err_fname"></span></label>
						<div class="col-sm-12">
                            <input id="first_name" type="text" name="first_name" class="form-control form-height" placeholder="Enter first name" maxlength="256" value="<?php echo set_value('first_name', (isset($user->first_name)) ? $user->first_name : ''); ?>"  />
      						<?php echo form_error('first_name'); ?>
						</div>
					</div>
                    <div class="clear"></div>
                    <div class="form-group form-border" style="margin:0;padding:0!important;">
						<label for="Last Name" class="col-sm-12 field-title control-label">Last Name<span id="err_lname"></span></label>
						<div class="col-sm-12">
                             <input id="last_name" class="form-control form-height" placeholder="Enter last name" type="text" name="last_name" maxlength="256" value="<?php echo set_value('last_name', (isset($user->last_name)) ? $user->last_name : ''); ?>"  />
                        <?php echo form_error('last_name'); ?>
						</div>
					</div>
                    <div class="clear"></div>
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-12 field-title control-label">User role<span style="color:#FF0000;" class="error">*</span></label>
						<div class="col-sm-12">
                            <select onchange="javascript:showhidefields(this.selectedIndex)"  name='group_id' id='group_id' class="form-control form-height">
                        <?php
                    	   	$combocategories = $this->users_model->get_formatted_combo();
                    		foreach($combocategories as $combocat):
                         ?>
                           <option value='<?php echo $combocat->id?>' <?php //echo ($combocat->id==$groups->id)?'disabled':'';?> <?php echo ($this->input->post('group_id') == $combocat->id) ? "selected=selected" : (isset($groups) && in_array($combocat->id,$groups)) ? "selected=selected" : '' ?>><?php echo $combocat->title?></option>
                            <?php endforeach ?>
                       </select>
					   <input type="hidden" name="old_grp_Id" id="old_grp_Id" value="<?php echo @$user->group_id; ?>" />
					   <input type="hidden" name="new_grp_Id" id="new_grp_Id" value="" />
					   <?php if(@$user->group_id == 2 || @$user->group_id == 4) { ?>
					   <div class="">
						</div>
					   <?php } ?>
                        <?php echo form_error('group_id'); ?>
						</div>
					</div>
					<div class="clear"></div>
					<?php if(@$user->group_id == 2 || @$user->group_id == 4) { ?>
					<div class="form-group form-border" style="margin:0;" id="desig_field">
					  <div  >
						<label for="design" class="col-sm-12 field-title control-label">Designation/Post</label>
						<div class="col-sm-12">
                            <input id="design" type="text" name="design"  class="form-control form-height" placeholder="Enter Your Designation/Post" maxlength="256" value="<?php  echo set_value('design', (isset($user->designation)) ? $user->designation : ''); ?>"/>
						</div>
						</div>
					</div>
                    <div class="clear"></div>
                    <div class="form-group form-border" style="margin:0;" id="details_field">
					  <div>
						<label for="prof_detail" class="col-sm-12 field-title control-label">Professional Details</label>
						<div class="col-sm-12">
                             <textarea  name="prof_detail" cols="25"  id='prof_detail' class='form-control'><?php  echo set_value('prof_detail', (isset($user->prof_info)) ? $user->prof_info : '');  ?></textarea>
                             <input name="image" type="file" id="upload" class="hidden" onchange="">
                        <?php echo form_error('last_name'); ?>
						</div>
						</div>
					</div>
                   <?php } ?>
                    <div class="clear"></div>
                    <div class="form-group form-border" style="margin:0;">
						<label for="Email" class="col-sm-12 field-title control-label">Email<span style="color:#FF0000;" class="error">* </span><span id="err_email"></span></label>
						<div class="col-sm-12">
                            <input id="email" class="form-control form-height" placeholder="Enter email id" type="text" name="email" maxlength="256" value="<?php echo set_value('email', (isset($user->email)) ? $user->email : ''); ?>" autocomplete="off" />
                         <?php echo form_error('email'); ?>
						</div>
					</div>
                    <div class="clear"></div>
                    <div class="form-group form-border" style="margin:0;">
						<label for="mobile" class="col-sm-12 field-title control-label">Mobile <span style="color:#FF0000;" class="error">* </span><span id="err_mobile"></span></label>
						<div class="col-sm-12">
                            <input id="mobile" class="form-control form-height" placeholder="Enter Mobile No." type="text" name="mobile" maxlength="12" value="<?php echo set_value('mobile', (isset($user->mobile)) ? $user->mobile : ''); ?>" autocomplete="off" onkeypress="return only_number(event)" />
                         <?php echo form_error('mobile'); ?>
						</div>
					</div>
                    <div class="clear"></div>
                    <div class="form-group form-border" style="margin:0;">
						<label for="field-3" class="col-sm-12 field-title control-label">Password<span style="color:#FF0000;" class="error"><?php echo (($updType == 'edit')?'':'*');?> </span><span id="err_password"></span></label>
						<div class="col-sm-12">
							<input style="display:none" type="password" name="fakepasswordremembered"/>
                         <input id="password" class="form-control form-height" placeholder="Enter Password" type="password" name="password" maxlength="256" autocomplete="new-password" value="<?php echo set_value('password'); ?>"  />
                        <?php echo form_error('password'); ?>
						</div>
					</div>
                    <div class="clear"></div>
                    <div class="form-group form-border" style="margin:0;">
						<label for="field-3" class="col-sm-12 field-title control-label">Confirm Password<span style="color:#FF0000;" class="error"><?php echo (($updType == 'edit')?'':'*');?> </span><span id="err_confirm"></span></label>
						<div class="col-sm-12">
                         <input id="password_confirm" class="form-control form-height" placeholder="Enter Password Again" type="password" name="password_confirm" autocomplete="off" maxlength="256" value="<?php echo set_value('password_confirm'); ?>"  />
                        <?php echo form_error('password_confirm'); ?>
						</div>
					</div>
					<div class="clear"></div>
               		<div class="form-group form-border" id="sale_div" style="margin:0;<?php if($user->group_id==2){ ?> display: block;<?php }else{ ?>display:none;<?php } ?>">
						<label class="col-sm-12 field-title control-label">Sale Percentage</label>
						<div class="col-sm-12">
						<input type="text" id="sale_per" name="sale_per" class="form-control form-height" placeholder="Sale Percentage" value="<?php echo set_value('coursepercent', (isset($user->coursepercent)) ? $user->coursepercent : ''); ?>" />
						</div>
					</div>
					<div class="clear"></div>
					<?php if($user->group_id==2){ ?>
               		<div class="form-group form-border" id="resell_div" style="margin:0;">
						<label class="col-sm-12 field-title control-label">Referred Sale Percentage</label>
						<div class="col-sm-12">
						<input type="text" id="comm_per" name="comm_per" class="form-control form-height" placeholder="Referrals Percentage" value="<?php if(!empty($assess->assessment)){echo $assess->assessment;} ?>">
						</div>
					</div>
					<?php } ?>
					<div class="clear"></div>
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-12 field-title control-label">Upload image
						</label>
						<div class="col-sm-12">
					<div id="localimage_i" class="user_img">
					  <div class="col-sm-8" style="padding:0;">
                        <?php if (isset($user->images)){ ?>
                      <div class="img-grey-border edit_upload_image">
                        <img src="<?php echo base_url();?>public/uploads/users/img/<?php echo $user->images ? $user->images : 'default.jpg' ?>" id="imgname" width="75">
						<img id="blah" src="#" alt="your image" width="75" style="display: none;" />
					  </div>
					  <div class="edit_upload_image_btn">
						<a href="<?php echo base_url(); ?>admin/users/cropuserimg/<?php echo $this->uri->segment(4);?>/useredit" class="upimg_pop btn btn-success btn-border-blue ">Upload image</a>
                      </div>  
                       	<?php }else{    ?>
                      <div class="img-grey-border edit_upload_image">
                        <img src="<?php echo base_url()?>public/uploads/users/img/default.jpg" width="75" id="imgname">
						<img id="blah" src="#" alt="your image" width="75" style="display: none;" />
					  </div>
					  <div class="edit_upload_image_btn">
						<a href="<?php echo base_url(); ?>admin/users/cropuserimg/usercreate" class="upimg_pop btn btn-success btn-border-blue ">Upload image</a>
					  </div>
						<input type="text" name="userimg" id="userimg" hidden readonly>
                        <?php } ?>
                       </div> 
                    </div>
                         <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
                         <br />
                         <input type="file" name="file_i" id="file_i" class="form-control" style="display:none" >
						 <br />
                        </div>
                         <?php  $imagepath = (isset($user->images)) ? $user->images : ''; ?>
                          <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">
						</div>
					</div>
                    <div class="clear"></div>
					<div class="form-group form-border" style="margin:0; padding-top:2.5%!important;">
						<div class="col-sm-12">
                          <div class="grey-background">
							<div class="checkbox">
								<label>
									<input id="active" type="checkbox" name="active" value='1' <?php echo ($this->input->post('active') == '1') ? "checked" : (isset($user->active) && $user->active == '1') ? "checked" : ''?> <?php echo $updType == 'create' ? 'checked':''; ?> /> Publish
								</label>
							</div>
						</div>
					</div>
					</div>
					<div class="clear"></div>
					<div class="form-group form-border" style="margin:0;">
                        <div class="col-sm-5">
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green' type='button' onclick='return validation()'" : "id='submit' class='btn btn-default btn-green' type='button' onclick='return validation()'")); ?>
            <a href='<?php echo base_url() ?>admin/users/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</fieldset>
			
	  </div>
	</div>
</div>
 <link rel="stylesheet" href="<?php echo base_url() ?>js/redactor/css/redactor.css" />
<script src="<?php echo base_url() ?>js/redactor/redactor.js"></script>
<script>
 </script>
<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$user->id); ?>
<?php endif ?>
<?php echo form_close(); ?>
<style>
.hide{  
    display:none;
}
</style>
<script>
function only_number(event) {
   var x = event.which || event.keyCode;
   console.log(x);
   if ((x >= 48) && (x <= 57) || x == 8 | x == 9 || x == 13) {
      return;
   } else {
      event.preventDefault();
   }
}

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
            $('#imgname').hide('slow');
      }
        else{ $('#remove_id').hide();$('#blah').hide('slow');}
        readURL(this);
    });
    $('#remove_id').click(function(){
          $('#file_i').val('');
          $(this).hide();
          $('#blah').hide('slow');
		  $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
});
</script>
<script>
	$('#group_id').on('change', function() {
		var t_id =  $('#group_id').val();
		if(t_id == '2')
		{
			$('#new_grp_Id').val(t_id);
		}
		else
		{ 
            $('#new_grp_Id').val('0');
		}
		showsalePer();
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
	
<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('.fancybox').fancybox();
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
			jQuery(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',
				helpers : {
					title : {
						type : 'over'
					}
				}
			});
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
</script>
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>
<script>
	$(document).ready(function(){
		var abc = $.session.get('somekey');
        $("#imgname",parent.document).attr('src', abc);
	});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
		$j(".upimg_pop").colorbox({
		iframe:true,
		width:"500px", 
		height:"60%",
		fadeOut:500,
		fixed:true,
		reposition:true,	
		})
	   });
</script>
<script>
function showsalePer()
{
       var selvalue = $("#group_id").val();
       if(selvalue == 2)
       {
       	   $("#sale_div").css("display", "block");
       }
       else
       {
          $("#sale_div").css("display", "none");
          $("#sale_per").val('');
       }
 }
</script>
<script>
/*jQuery(document).ready(function() {
     var selvalue = jQuery("#group_id").val();
       if(selvalue == 2)
       {
       	   jQuery("#sale_div").css("display", "block");
       	   jQuery("#resell_div").css("display", "block");
       }
       else
       {
          jQuery("#sale_div").css("display", "none");
          jQuery("#sale_per").val('');
          jQuery("#resell_div").css("display", "none");
          jQuery("#comm_per").val('');
       }
});*/
</script>	
	<script src='<?php echo base_url() ?>public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#prof_detail',
  height: 180,
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
   });

function validation()
{
	var first_name = $("#first_name").val().trim();
	var last_name = $("#last_name").val().trim();
	var email = $("#email").val().trim();
	var mobile = $("#mobile").val().trim();
	var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
	if(first_name=="")
	{
		$("#err_fname").fadeIn().html("Please enter first name").css('color','red');
        setTimeout(function(){$("#err_fname").html("");},3000);
        $("#first_name").focus();
        return false;
    }

    /*if(last_name=="")
	{
		$("#err_lname").fadeIn().html("Please enter last name").css('color','red');
        setTimeout(function(){$("#err_lname").html("");},3000);
        $("#last_name").focus();
        return false;
    }*/

    /*if(email=="")
	{
		$("#err_email").fadeIn().html("Please enter email id").css('color','red');
        setTimeout(function(){$("#err_email").html("");},3000);
        $("#email").focus();
        return false;
    }*/
	if(email!=""){
	    if(!email_pattern.test(email))
	    {
			$("#err_email").fadeIn().html("Invalid Email id").css('color','red');
	        setTimeout(function(){$("#err_email").html("");},3000);
	        $("#email").focus();
	        return false;
	    }
	}
	if(mobile=="")
	{
		$("#err_mobile").fadeIn().html("Please enter Mobile No.").css('color','red');
        setTimeout(function(){$("#err_mobile").html("");},3000);
        $("#mobile").focus();
        return false;
    }
    /*
	var password = $("#password").val().trim();
	var password_confirm = $("#password_confirm").val().trim();
    if(password=="")
	{
		$("#err_password").fadeIn().html("Please enter password").css('color','red');
        setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
        $("#password").focus();
        return false;
    }
    if(password.length<6)
	{
		$("#err_password").fadeIn().html("The Password field must be at least 6 characters in length.").css('color','red');
        setTimeout(function(){$("#err_password").html("&nbsp;");},3000);
        $("#password").focus();
        return false;
    }

    if(password_confirm=="")
	{
		$("#err_confirm").fadeIn().html("Please confirm your password").css('color','red');
        setTimeout(function(){$("#err_confirm").html("&nbsp;");},3000);
        $("#password_confirm").focus();
        return false;
    }
    if(password_confirm.length<6)
	{
		$("#err_confirm").fadeIn().html("The Password field must be at least 6 characters in length.").css('color','red');
        setTimeout(function(){$("#err_confirm").html("&nbsp;");},3000);
        $("#password_confirm").focus();
        return false;
    }*/


}
  </script>