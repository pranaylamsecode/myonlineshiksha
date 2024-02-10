<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php
 

/*$date = date('d');
$month = date('m');
$year = date('Y');
$random_no = rand(1000,5000);
echo $generate = $random_no.'_'.$year.'-'.$month.'-'.$date; */
?>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<script>
				// jQuery(document).ready(
				// function()
				// {
				// 	jQuery('#description').redactor();
					
				// }
				// );
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

echo ($updType == 'create') ? form_open_multipart(base_url().'/admin/users/view_request', $attributes) : form_open_multipart(base_url().'/admin/users/view_request/'.$id, $attributes);

?>




<h2><?php echo (($updType == 'edit')?'External User Profile':'Create User');?></h2>

<div class="field_container">
<div class="row">
	<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="padding-left: 0;">
					<?php echo (($updType == 'edit')?'Profile':'Create User');?>
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body tab-box" style="border-top: 3px solid #ebebeb!important;">
				
				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">
                    
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 control-label field-title">First Name</label>
						
						<div class="col-sm-12">
                            
                            <input id="first_name" type="text" name="first_name"  class="form-height form-control" placeholder="Enter Your First Name" maxlength="256" value="<?php echo set_value('first_name', (isset($user->first_name)) ? $user->first_name : ''); ?>"  />
                            
                            <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="firstname-target" class="tooltipicon"></span>

						<span class="firstname-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_first-name');?>

                        

						</span>

						</span> -->

<!-- tooltip area finish -->



      <?php echo form_error('first_name'); ?>

						</div>
					</div>
                 
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="Last Name" class="col-sm-12 control-label field-title">Last Name</label>
						
						<div class="col-sm-12">
							
                             <input id="last_name" class="form-height form-control" placeholder="Enter Your Last Name" type="text" name="last_name" maxlength="256" value="<?php echo set_value('last_name', (isset($user->last_name)) ? $user->last_name : ''); ?>"  />


<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="last_name-target" class="tooltipicon"></span>

						<span class="last_name-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo lang('user_fld_last-name');?>

                         

						</span>

						</span> -->

                        <?php echo form_error('last_name'); ?>

<!-- tooltip area finish -->
                            
						</div>
					</div>
                    
					
					
                    <div class="clear"></div>
                    
					<div class="form-group form-border">
						<label class="col-sm-12 control-label field-title">Group</label>
						
						<div class="col-sm-12">
							
                           
                             <input id="group_id" class="form-height form-control"  type="text" name="group_id" maxlength="256" value="External"  />
					   
					 
					 
					   <?php if(@$user->group_id == 2 || @$user->group_id == 4) { ?>
					   <div class="">
							<input type="button" class="btn btn-default" name="add_button" id="add_button"  value="Add" />
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

<!-- tooltip area finish -->
						</div>
					</div>
					
							
 
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="Email" class="col-sm-12 control-label field-title">Email</label>
						
						<div class="col-sm-12">
                            
                            <input id="email" class="form-height form-control" placeholder="Enter Your Email Address" type="text" name="email" maxlength="256" value="<?php echo set_value('email', (isset($user->email)) ? $user->email : ''); ?>"  />


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
					
                    <div class="form-group form-border">
						<label for="field-3" class="col-sm-12 control-label field-title">Course</label>
						
						<div class="col-sm-12">

                         <input id="course" class="form-control form-height"  type="text" name="course" maxlength="256" autocomplete="off" value="<?php echo @$userinfo->want_to_teach; ?>"  />

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="course-target" class="tooltipicon"></span>

						<span class="course-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('external_selected_course');?>

                         
						</span>

						</span> -->

                        

<!-- tooltip area finish -->

						</div>
					</div>
                   
                  
                    <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="field-3" class="col-sm-12 control-label field-title">Primary Goal</label>
						
						<div class="col-sm-12">
							
                         <input id="goal" class="form-height form-control"  type="text" name="goal" autocomplete="off" maxlength="256" value="<?php echo @$userinfo->primary_goal; ?>"  />

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="primary_goal-target" class="tooltipicon"></span>

						<span class="primary_goal-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

					     <?php echo lang('external_primary_goal');?>

                        

						</span>

						</span> -->

                        

<!-- tooltip area finish -->

						</div>
					</div>
					
					<div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="field-3" class="col-sm-12 control-label field-title">Experiance</label>
						
						<div class="col-sm-12">
							
                         <input id="experiance" class="form-height form-control"  type="text" name="experiance" autocomplete="off" maxlength="256" value="<?php echo @$userinfo->idl_crs_crtn_exp; ?>"  />

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="experiance-target" class="tooltipicon"></span>

						<span class="experiance-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

					    <?php echo lang('external_experiance');?>

                        

						</span>

						</span> -->

                      

<!-- tooltip area finish -->

						</div>
					</div>
                   
				   
				   <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="field-3" class="col-sm-12 control-label field-title">Promotion on</label>
						
						<div class="col-sm-12">
							
                         <input id="promotion" class="form-height form-control"  type="text" name="promotion" autocomplete="off" maxlength="256" value="<?php echo @$userinfo->exst_eml_sbsbr_lt; ?>"  />

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="promotion-target" class="tooltipicon"></span>

						<span class="promotion-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

					     <?php echo lang('external_promotion');?>

                       

						</span>

						</span> -->

                       

<!-- tooltip area finish -->

						</div>
					</div>
					
					 <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="field-3" class="col-sm-12 control-label field-title">Subscriber </label>
						
						<div class="col-sm-12">
							
                         <input id="subscriber" class="form-height form-control"  type="text" name="subscriber" autocomplete="off" maxlength="256" value="<?php echo @$userinfo->sbsb_on_youtube; ?>"  />

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="subscriber-target" class="tooltipicon"></span>

						<span class="subscriber-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

					<?php echo lang('external_subscriber');?>

                        

						</span>

						</span> -->

                     

<!-- tooltip area finish -->

						</div>
					</div>
                  
					<div class="clear"></div>
                    
					<div class="clear"></div>
                    
                    <div class="title-padding form-group form-border">
                      <div class="grey-background" style="display: -webkit-box;">
						<label for="field-3" class="col-sm-3 field-title control-label">Account Status </label>
						
						<div class="col-sm-5">
							
                         
						 <input type="radio"  name="acc_status"  value="Approved" <?php echo ($user->active == 1) ?  'checked': ''; ?> />&nbsp Approve  &nbsp &nbsp
				         <input type="radio"  name="acc_status"  value="Disapproved" <?php echo ($user->active == '0') ? 'checked' : '';  ?> />&nbsp Disapprove
			

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="acc_status-target" class="tooltipicon"></span>

						<span class="acc_status-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('external_accStatus');?>

                         

						</span>

						</span> -->

                      

<!-- tooltip area finish -->

						</div>
					</div>
					</div>
					<div class="clear"></div>
					
					<div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="field-3" class="col-sm-12 field-title control-label">Reason of Approval/Disapproval </label>
						
						<div class="col-sm-12">
							
							 <textarea  name="description" id="description" class="form-height form-control" rows="6"><?php echo @$userinfo->reason; ?></textarea>
<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="reason-target" class="tooltipicon"></span>

						<span class="reason-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

					<?php echo lang('external_reason');?>

                     

						</span>

						</span> -->

                      

<!-- tooltip area finish -->

						</div>
					</div>
					
					<div class="clear"></div>
                    
					<div class="form-group">
						
                        <div class="form-border col-sm-5">
						   
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

 $(document).ready(

 function()

 {

   //	$('#full_bio').redactor();

 }

 );

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





<!-- tool tip script -->

<script type="text/javascript">

//$(document).ready(function(){

//	$('.tooltipicon').click(function(){

//	var dispdiv = $(this).attr('id');

//	$('.'+dispdiv).css('display','inline-block');

//	});

//	$('.closetooltip').click(function(){

//	$(this).parent().css('display','none');

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
	
	

<!-- tool tip script finish -->
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#description',
  height: 180,
 // min_width: 400,
  theme: 'modern',
 plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen"
 });
   });
  </script>