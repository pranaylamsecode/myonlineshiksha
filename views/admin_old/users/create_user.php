<?php
/*$date = date('d');
$month = date('m');
$year = date('Y');
$random_no = rand(1000,5000);
echo $generate = $random_no.'_'.$year.'-'.$month.'-'.$date; */

  


?>


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

<!--<script type="text/javascript">

$(function() {

	$('#file_i').live('change',function(e) {

	 var ftpfilearray;

	 e.preventDefault();

		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>admin/users/upload_image/',

		secureuri :false,

		fileElementId :'file_i',

		dataType : 'json',

		data : {

		'type' : $('select#type').val()

		},

		success : function (data, status)

		{

		//alert(data);

			if(data.status != 'error')

			{

			$('#msgstatus_i').html('<p>Reloading files...</p>');

			$('#file_i').val('');

			$('#msgstatus_i').html('');

			ftpfileoptions = '<img src="<?php echo base_url(); ?>/public/uploads/users/img/thumbs/'+data.ftpfilearray+'">';

		  //	alert(ftpfileoptions);

			$('#localimage_i').html(ftpfileoptions);

			ftpfilearray = data.ftpfilearray;

           // alert(ftpfilearray);

			document.getElementById("imagename").value = ftpfilearray;

			}

		}

		});

	 return false;

	});

});



</script>-->

<!--<script type="text/javascript">
function showhidedetails(){

	var selvalue = document.getElementById("add_button").value;

   //alert(selvalue);

	if(selvalue == 'add')

	{

	document.getElementById("desig_field").style.display="block";
	document.getElementById("details_field").style.display="block";

	}else

	{

	document.getElementById("desig_field").style.display="none";
	document.getElementById("details_field").style.display="none";

	}

}

</script>-->

<script type="text/javascript">
jQuery(document).ready(
function()
{
//jQuery('#prof_detail').redactor();
//jQuery('#message').redactor();
}
);
</script>

<script type="text/javascript">

window.onload = function() {

showhidefields();

}



function showhidefields(){

	var selvalue = document.getElementById("group_id").selectedIndex;

    //alert(selvalue);

    if(selvalue == '1')

	{
      
	   
	    // document.getElementById("payment_field").style.display="block";
	  
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



<script>

/*function checkvalid(){

	if (document.checkuser.email.value=='') {

			alert("You must have at least one answer for your question");

			return true;

	   }

      //return true;

}*/

</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>

 $(function() {    $( document ).tooltip();  });

</script>

<div class="main-container">

<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/users/create', $attributes) : form_open_multipart(base_url().'admin/users/edit/'.$id, $attributes);

?>



<div class="col-sm-12" style="padding:0;">
	<h2><?php echo (($updType == 'edit')?'Edit User':'Create User');?></h2>
</div>

<div class="field_container">
<div class="row">
	<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo (($updType == 'edit')?'Edit User':'Create User');?>
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body form-body">
				
				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">
                    
					<div class="form-group form-border" style="margin:0;">
						<label for="first Name" class="col-sm-12 control-label field-title">First Name<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
                            
                            <input id="first_name" type="text" name="first_name"  class="form-control form-height" placeholder="Enter Your First Name" maxlength="256" value="<?php echo set_value('first_name', (isset($user->first_name)) ? $user->first_name : ''); ?>"  />
                            
                            <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="firstname-target" class="tooltipicon"></span>

						<span class="firstname-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_first-name');?>

                        

						</span>

						</span> -->

<!-- tooltip area finish -->



      <?php echo form_error('first_name'); ?><b>&nbsp;</b>

						</div>
					</div>
                 
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="margin:0;padding:0!important;">
						<label for="Last Name" class="col-sm-12 field-title control-label">Last Name<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
							
                             <input id="last_name" class="form-control form-height" placeholder="Enter Your Last Name" type="text" name="last_name" maxlength="256" value="<?php echo set_value('last_name', (isset($user->last_name)) ? $user->last_name : ''); ?>"  />


					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="last_name-target" class="tooltipicon"></span>

						<span class="last_name-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_last-name');?>

                        

						</span>

						</span>
 -->
                        <?php echo form_error('last_name'); ?>

					<!-- tooltip area finish -->
                            
						</div>
					</div>
                    
                   

					
                    <div class="clear"></div>
                    
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-12 field-title control-label">Category<span style="color:#FF0000;" class="error">*</span></label>
						
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
							<!-- <input type="button" class="btn btn-default" name="add_button" id="add_button"  value="Add" /> -->
						</div>
					   
					   <?php }   ?>





					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="group_id-target" class="tooltipicon"></span>

						<span class="group_id-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

				

						<?php echo lang('user_fld_group');?>

                     

						</span>

						</span> -->

                        <?php echo form_error('group_id'); ?>


						</div>
					</div>
					
					<div class="clear"></div>
					
					<!--<div class="form-group" id="payment_field" style="display:none">
						<label for="Payment Method" class="col-sm-3 control-label">Payment Method</label>
						
						<div class="col-sm-5">
							
                             <select onchange="javascript:showhidefields(this.selectedIndex)" name='payment_mode' id='payment_mode' class="form-control">
															
								<option value="">Select</option>
								<option value="salary">Salary</option>
								<option value="percent">Percent Wise</option>
							</select>
							
							<input  class="form-control"  style="display:none" type="text" name="payment_type" id="payment_type" value="" />




						<span class="tooltipcontainer">

						<span type="text" id="salary-target" class="tooltipicon"></span>

						<span class="salary-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

					

						<?php echo lang('user_payment_method');?>

                      

						</span>

						</span>

                        <?php echo form_error('last_name'); ?>


                            
						</div>
					</div>-->
					
					
					<?php if(@$user->group_id == 2 || @$user->group_id == 4) { ?>
					<div class="form-group form-border" style="margin:0;" id="desig_field" <?php   //if(@$user->designation) echo 'style="display:block"'; else  echo 'style="display:none"'; ?>>
					  <div  >
						<label for="design" class="col-sm-12 field-title control-label">Designation/Post</label>
						
						<div class="col-sm-12">
                            
                            <input id="design" type="text" name="design"  class="form-control form-height" placeholder="Enter Your Designation/Post" maxlength="256" value="<?php  echo set_value('design', (isset($user->designation)) ? $user->designation : ''); ?>"  />
                            
                            <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="post-target" class="tooltipicon"></span>

						<span class="post-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('user_designation');?>

                         
						</span>

						</span> -->

<!-- tooltip area finish -->



      

						</div>
						</div>
					</div>
                 
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="margin:0;" id="details_field" <?php   //if(@$user->prof_info) echo 'style="display:block"'; else  echo 'style="display:none"'; ?>>
					  <div  >
						<label for="prof_detail" class="col-sm-12 field-title control-label">Professional Details</label>
						
						<div class="col-sm-12">
							
                             <textarea  name="prof_detail" cols="25"  id='prof_detail' class='form-control'><?php  echo set_value('prof_detail', (isset($user->prof_info)) ? $user->prof_info : '');  ?></textarea>
                             <input name="image" type="file" id="upload" class="hidden" onchange="">

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="prof_details-target" class="tooltipicon"></span>

						<span class="prof_details-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo lang('user_prof_details');?>

                         

						</span>

						</span> -->

                        <?php echo form_error('last_name'); ?>

					<!-- tooltip area finish -->
                            
						</div>
						</div>
					</div>
                    
                   <?php } ?>
					
 
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="margin:0;">
						<label for="Email" class="col-sm-12 field-title control-label">Email<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
                            
                            <input id="email" class="form-control form-height" placeholder="Enter Your Email Address" type="text" name="email" maxlength="256" value="<?php echo set_value('email', (isset($user->email)) ? $user->email : ''); ?>"  />


					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="email-target" class="tooltipicon"></span>

						<span class="email-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_email');?>

                        

						</span>

						</span> -->

                         <?php echo form_error('email'); ?>

					<!-- tooltip area finish -->

						</div>
					</div>
                    
                   
                    <div class="clear"></div>
					
                    <div class="form-group form-border" style="margin:0;">
						<label for="field-3" class="col-sm-12 field-title control-label">Password<span style="color:#FF0000;" class="error"><?php echo (($updType == 'edit')?'':'*');?></span></label>
						
						<div class="col-sm-12">

                         <input id="password" class="form-control form-height" placeholder="Enter Password" type="password" name="password" maxlength="256" autocomplete="off" value="<?php echo set_value('password'); ?>"  />

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="password-target" class="tooltipicon"></span>

						<span class="password-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('user_fld_password');?>

                        
						</span>

						</span> -->

                        <?php echo form_error('password'); ?>

				<!-- tooltip area finish -->

						</div>
					</div>
                   
                  
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="margin:0;">
						<label for="field-3" class="col-sm-12 field-title control-label">Confirm Password<span style="color:#FF0000;" class="error"><?php echo (($updType == 'edit')?'':'*');?></span></label>
						
						<div class="col-sm-12">
							
                         <input id="password_confirm" class="form-control form-height" placeholder="Enter Password Again" type="password" name="password_confirm" autocomplete="off" maxlength="256" value="<?php echo set_value('password_confirm'); ?>"  />

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="password_confirm-target" class="tooltipicon"></span>

						<span class="password_confirm-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_confirm-password');?>

                        
						</span>

						</span> -->

                        <?php echo form_error('password_confirm'); ?>

					<!-- tooltip area finish -->

						</div>
					</div>
                   
					<div class="clear"></div>
                   <div class="form-group form-border" id="sale_div" style="display: none;">
						<label class="col-sm-12 field-title control-label">Sale Percentage</label>
						<div class="col-sm-12">
						<input type="text" id="sale_per" name="sale_per" class="form-control form-height" placeholder="Sale Percentage" value="<?php echo set_value('coursepercent', (isset($user->coursepercent)) ? $user->coursepercent : ''); ?>" ></input>
						
			
						</div>
					</div>

                  
					<div class="clear"></div>
                    
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-12 field-title control-label">Upload Image
							<p>(Please upload Course Image)</p>
						</label>
						
						<div class="col-sm-12">
							
					<div id="localimage_i" class="user_img">
					  <div class="col-sm-8" style="padding:0;">
                        <?php if (isset($user->images)){ ?>
                      <div class="col-sm-5 img-grey-border">
                        <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $user->images?>" id="imgname" width="75">
						<img id="blah" src="#" alt="your image" width="75"/>
					  </div>
					  <div class="col-sm-6">
						<a href="<?php echo base_url(); ?>admin/users/cropuserimg/<?php echo $this->uri->segment(4);?>/useredit" class="upimg_pop btn btn-success btn-border-blue img-align">Upload Image</a>
                      </div>  
                       	<?php }else{    ?>
                      <div class="col-sm-5 img-grey-border">
                        <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'default.jpg'  ?>" width="75" id="imgname">
						<img id="blah" src="#" alt="your image" width="75"/>
					  </div>
					  <div class="col-sm-6">
						<a href="<?php echo base_url(); ?>admin/users/cropuserimg/usercreate" class="fancybox fancybox.iframe btn btn-success btn-border-blue img-align">Upload Image</a>
					  </div>
						<input type="text" name="userimg" id="userimg" hidden readonly>
                        <?php } ?>

                       </div> 

                        </div>

                         <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">

                         <br />

                         <input type="file" name="file_i" id="file_i" class="form-control" style="display:none" >
						 <br />
						 <input type="button" id="remove_id" value="remove" class="btn btn-red" />

                        </div>

                         <?php  $imagepath = (isset($user->images)) ? $user->images : ''; ?>

                          <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">

                            <!--<tr>

					<td > Upload image</td>

					<td style="width: 30%;">

                    <div id="localimage_i">

                        <?php if (isset($user->images)){ ?>

                        <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $user->images?>" id="imgname">

                        <?php }else{    ?>

                        <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : ''  ?>" id="imgname">

                        <?php } ?>



                        </div>

                         <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">

                         Choose file

                         <input type="file" name="file_i" id="file_i" class="upload_btn" value="">



                        </div>

                         <?php  $imagepath = (isset($user->images)) ? $user->images : ''; ?>

                          <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">





                    </td>

				 </tr>-->
						</div>
					</div>
					
                   
                    <div class="clear"></div>
                    

					<div class="form-group form-border" style="margin:0; padding-top:2.5%!important;">
                    
						<div class="col-sm-12">
                          <div class="grey-background">
							<div class="checkbox">
								<label>
									<input id="active" type="checkbox" name="active" value='1' <?php echo ($this->input->post('active') == '1') ? "checked" : (isset($user->active) && $user->active == '1') ? "checked" : ''?> <?php echo $updType == 'create' ? 'checked':''; ?> /> Activate
									 



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="active-target" class="tooltipicon"></span>

						<span class="active-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_active');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->
								</label>
							</div>
							
							
						</div>
					</div>
					
					</div>
					<div class="clear"></div>
                    
					<div class="form-group form-border" style="margin:0;padding-top:2%!important;">
						
                        <div class="col-sm-5">
						   
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>
            
            <a href='<?php echo base_url(); ?>/admin/users/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</fieldset>
				
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>

 <link rel="stylesheet" href="<?php echo base_url(); ?>/js/redactor/css/redactor.css" />

<script src="<?php echo base_url(); ?>/js/redactor/redactor.js"></script>

<script>

 // $(document).ready(

 // function()

 // {

 //    $('#prof_detail').redactor();

 // }

 // );

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
<!--<form id="form1" runat="server">
    <input type='button' id='remove' value='remove' class='hide'/>
    <input type='file' id="imgInp" /><br>
    <img id="blah" src="#" alt="your image" width='150'/>
</form>-->

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


<!-- tool tip script -->

<script type="text/javascript">

//$(document).ready(function(){
//
//	$('.tooltipicon').click(function(){
//
//	var dispdiv = $(this).attr('id');
//
//	$('.'+dispdiv).css('display','inline-block');
//
//	});
//
//	$('.closetooltip').click(function(){
//
//	$(this).parent().css('display','none');
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

</script>
<!-- tool tip script finish -->
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>
<script>
	$(document).ready(function(){
		var abc = $.session.get('somekey');
        //alert(abc);
        $("#imgname",parent.document).attr('src', abc);
	});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
		//Examples of how to assign the Colorbox event to elements

		//$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});	
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
       if(selvalue == 2 || selvalue == 5)
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
jQuery(document).ready(function() {
	
     var selvalue = jQuery("#group_id").val();
       if(selvalue == 2 || selvalue == 5)
       {
       	   jQuery("#sale_div").css("display", "block");

       }
       else
       {
          jQuery("#sale_div").css("display", "none");
          jQuery("#sale_per").val('');
       }
});

</script>	
	<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#prof_detail',
  height: 180,
 // min_width: 400,
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
  </script>