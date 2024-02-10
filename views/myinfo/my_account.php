<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>public/js/redactor123/assets/redactor.css">
<style>
.myprof-wrapper .panel-primary > .panel-heading {
	color: #fff;
	background-color: #2d3b92;
	border-color: #2d3b92;
}
.pro-img img {
	border-radius: 50%;
	border: 1px solid #ddd;
	width: 100px;
	height: 100px;
	object-fit: cover;
	margin-bottom: 20px;
	display: block;
}
.myprof-wrapper .main-content {
	width: 70%;
	margin: 0 auto;
	text-align: center;
	border: 1px solid #ccc;
	padding: 30px;
}
.myprof-wrapper input {
	background: #fff !important;
	box-shadow: none;
	border: 1px solid #bbb !important;
}
.redactor-box {
	margin-bottom: 0px;
}
.myprof-wrapper input.btn-primary_rockon.profile_submit_btn:hover {
	background: #3e4a90 !important;
}
.btn-primary_rockon.profile_submit_btn {
	background: #2d3b92 !important;
	border: 0px !important;
	color: #fff;
	padding: 8px 30px;
	font-size: 16px;
}
label.control-label {
	padding-top: 7px;
	text-align: left;
	margin-bottom: 15px !important;
	font-size: 15px;
	font-weight: normal;
	margin-top: 20px;
}
.pro-img a.btn {
	display: block;
	float: left;
}
.panel.panel-primary {
	border: 0px;
}
label
{
	margin-bottom:0 !important;
}
.myprof-wrapper{
	  background-color: #FFFFFF;
	  width: 100%;
	    padding: 40px 0;
}
.pro-img{
	  display: block;
  text-align: center;
}
.main-content .content{
	position: unset!important;
}
@media only screen and (min-width: 1280px){
.content {
    position: unset !important;
}
}
@media (max-width: 767px){
	.myprof-wrapper .main-content {
	width: 100%;
	padding: 30px 0px;
}
	label.control-label {
	padding-top: 7px;
	text-align: left;
	margin-bottom: 15px !important;
	font-size: 15px;
	font-weight: normal;
	margin-top: 20px;
	display: inline-block;
	width: 100%;
}
.redactor-editor {
	min-width: 200px;
	max-width: 100% !important;
}
}
</style>
<div class="myprof-wrapper">
<div class="container">
<div class="main-content" >
	<div class="row">
    <div class="holder" id="mrp-container2">
<?php
$attributes = array('class' => 'tform', 'id' => 'user_profile', 'name' => 'user_profile','onclick' => 'return validateForm()');
echo form_open_multipart(base_url().'myinfo/myaccount', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/
?>
<div class="content">
	<div class="table-scroll-resp">
			<div class="main-div">
				<h3 style="margin-top: 0;">Public profile </h3>
				<p>Add information about yourself</p>
					
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">First name<span style="color:#FF0000">*</span> :</label> 
								<div class="col-sm-12"> 
									<input type="text" class="form-control" name="firstname" id="firstname" size="30" value="<?php echo set_value('firstname', (isset($user->first_name)) ? $user->first_name : ''); ?>">
					                   <span style ="color:red"><?php echo form_error('firstname'); ?></span> 
								</div> 
							</div>
							

							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Last name<span style="color:#FF0000">*</span> :</label> 			
								<div class="col-sm-12"> 
									<input  class="form-control" type="text" name="lastname" id="lastname" size="30" value="<?php echo set_value('lastname', (isset($user->last_name)) ? $user->last_name : ''); ?> ">
					                   <span style ="color:red"><?php echo form_error('lastname'); ?></span> 
								</div> 
							</div>
							<div class="form-group pro-img">
								<label for="field-1" class="col-sm-12 control-label">Profile Image<span style="color:#FF0000">*</span> :</label> 
								<div class="col-sm-12"> 
							   	<img src='<?php $filepath = "";
    $files = $_SERVER['DOCUMENT_ROOT']."/public/uploads/users/img/".$user->images;
    if (file_exists($files)) {
      echo base_url()."public/uploads/users/img/";
    }
    else{
      echo base_url()."public/uploads/users/img/thumbs/";
    }
    echo ($user->images) ? $user->images : 'default.jpg'; ?>' width="150" id="imgname">

								<input type="file" name="file_i" id="file_i" class="upload_btn" style="display: none;">
								<a  href="<?php echo base_url(); ?>myinfo/cropUserImg/<?php echo $user_id;?>/imageedit" class="fancybox fancybox.iframe btn btn-success">Upload Image</a>
								<?php  $imagepath = (isset($user->images)) ? $user->images : 'default.jpg'; ?>

				                <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">
				                </div>
							</div>
				
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">About Me :</label> 
								<div class="col-sm-12"> 
									<textarea name="about_me" class="form-control" id='about_me'  ><?php echo set_value('about_me', (empty($user->full_bio)) ? '' : $user->full_bio); ?></textarea>
								</div> 
							</div>
							<?php
									if($user->group_id == '2' || $user->group_id == '5')
									 {
								?>

							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Designation/Post :</label> 
								
								<div class="col-sm-12"> 
									<input type="text" class="form-control" name="designation" id="designation" size="30" value="<?php echo set_value('designation', (isset($user->designation)) ? $user->designation : ''); ?>" >
								</div> 
							</div>

							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Professional Details</label> 
								
								<div class="col-sm-12"> 
									<textarea name="prof_detail" class="form-control" id='prof_detail'  ><?php echo set_value('prof_detail', (empty($user->prof_info)) ? '' : $user->prof_info); ?></textarea>
								</div> 
							</div>
							

						</div>
					<?php } 

								?>
					</div>
					<div style="clear:both"></div>
					 <?php
								if($user->group_id == 5)
								{
							?>	


					<div class="panel panel-primary" data-collapsed="0"> 
						<div class="panel-heading">
							<div class="panel-title" style="padding-bottom: 0px;">	
								<h3 style="margin-top: 0;">Bank Account information</h3>

							</div>
							<div  class="panel-options">
							
							</div>  
						</div>

						<div class="panel-body form-horizontal form-groups-bordered"> 
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Bank Name:<span style="color:#FF0000">*</span> :</label> 
								
								<div class="col-sm-5"> 
									
					                   <input class="form-control" type="text" name="bank_name" id="bank_name" size="30" value="<?php echo set_value('bank_name', (isset($bank_info->bank_name)) ? $bank_info->bank_name : ''); ?>">
							
											<span class="tooltipcontainer">
											<span type="text" id="bank_name" class="tooltipicon" title="Click Here"></span>
											<span class="bank_name  tooltargetdiv" style="display: none;" >
											<span class="closetooltip"></span>				
											<?php echo lang('bank_name');?>				
											</span>
											</span>
					                   <span style ="color:red"><?php echo form_error('bank_name'); ?></span>
								</div> 
							</div>
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Branch Location:<span style="color:#FF0000">*</span> :</label> 
								
								<div class="col-sm-5"> 
									<input class="form-control" type="text" name="bank_location" id="bank_location" size="30" value="<?php echo set_value('bank_location', (isset($bank_info->branch_location)) ? $bank_info->branch_location : ''); ?>">
									<!-- tooltip area -->
											<span class="tooltipcontainer">
											<span type="text" id="branch_location" class="tooltipicon" title="Click Here"></span>
											<span class="branch_location  tooltargetdiv" style="display: none;" >
											<span class="closetooltip"></span>
										
											<?php echo lang('branch_location');?>
										
											</span>
											</span>
					                <span style ="color:red"><?php echo form_error('bank_location'); ?></span>
					                   
								</div> 
							</div>

							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Account Number:<span style="color:#FF0000">*</span> :</label> 
								
								<div class="col-sm-5"> 
									<input class="form-control" type="text" size="30" id="acc_number" name="acc_number" value="<?php echo set_value('acc_number', (isset($bank_info->acc_number)) ? $bank_info->acc_number : ''); ?>">
									
											<span class="tooltipcontainer">
											<span type="text" id="acc_number" class="tooltipicon" title="Click Here"></span>
											<span class="acc_number  tooltargetdiv" style="display: none;" >
											<span class="closetooltip"></span>
											
											<?php echo lang('acc_number');?>
											
											</span>
											</span>

					                <span style ="color:red"><?php echo form_error('acc_number'); ?></span>
					                   
								</div> 
							</div>

							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Branch Code:<span style="color:#FF0000">*</span></label> 
								
								<div class="col-sm-5"> 
									<input class="form-control" type="text" size="30" id="branch_code" name="branch_code" value="<?php echo set_value('branch_code', (isset($bank_info->branch_code)) ? $bank_info->branch_code : ''); ?>">
								
											<span class="tooltipcontainer">
											<span type="text" id="branch_code" class="tooltipicon" title="Click Here"></span>
											<span class="branch_code  tooltargetdiv" style="display: none;" >
											<span class="closetooltip"></span>
										
											<?php echo lang('branch_code');?>
											
											</span>
											</span>

					                <span style ="color:red"><?php echo form_error('branch_code'); ?></span>
					                   
								</div> 
							</div>


							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">IFSC Code:<span style="color:#FF0000">*</span></label> 
								
								<div class="col-sm-5"> 
									<input class="form-control" type="text" size="30" id="ifcs_code" name="ifcs_code" value="<?php echo set_value('ifcs_code', (isset($bank_info->ifsc_code)) ? $bank_info->ifsc_code : ''); ?>">
									
											<span class="tooltipcontainer">
											<span type="text" id="ifsc_code" class="tooltipicon" title="Click Here"></span>
											<span class="ifsc_code  tooltargetdiv" style="display: none;" >
											<span class="closetooltip"></span>
											
											<?php echo lang('ifsc_code');?>
											
											</span>
											</span>

					                <span style ="color:red"><?php echo form_error('ifcs_code'); ?></span>
					                   
								</div> 
							</div>


						</div>

						<?php
								}
						?>

					</div>
					<div style="clear:both"></div>
							

					
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Username<span style="color:#FF0000">*</span> :</label> 
								
								<div class="col-sm-12">  
									<input class="form-control" type="text" name="uname" id="uname" size="30" value="<?php echo set_value('uname', (isset($user->username)) ? $user->username : ''); ?>">
					            	<span style ="color:red"><?php echo form_error('uname'); ?></span>
								</div> 
							</div>
						

					
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Email<span style="color:#FF0000">*</span> :</label> 
								
								<div class="col-sm-12">  
									<input class="form-control" type="text" name="email_id" id="email_id" size="30" value="<?php echo set_value('email_id', (isset($user->email)) ? $user->email : ''); ?>" readonly>
					                <span style ="color:red"><?php echo form_error('email_id'); ?></span>                  
								</div> 
							</div>
						</div>

					
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Password :</label> 
								
								<div class="col-sm-12">  
									<input class="form-control" type="password" size="30" id="cpassword" name="cpassword" value="<?php echo set_value('cpassword'); ?>">
					                <span style ="color:red"><?php echo form_error('cpassword'); ?></span>                  
								</div> 
							</div>
				

						
							<div class="form-group"> 
								<label for="field-1" class="col-sm-12 control-label">Verify Password: :</label> 
								
								<div class="col-sm-12">  
									<input class="form-control" type="password" size="30" id="cpassword_confirm" name="cpassword_confirm" value="<?php echo set_value('cpassword_confirm'); ?>">
					                <span style ="color:red"><?php echo form_error('cpassword_confirm'); ?></span>                  
								</div> 
							</div>
					

						

						<div class="form-group"> 
							<div class="col-sm-12" style="  padding-top: 15px;"> 

								<input type="submit" name ="submit" class="btn-primary_rockon profile_submit_btn" value="Save">
							</div> 
						</div>
					</div>
			</div>
	</div>
</div>

<?php echo form_close(); ?>
    </div>
</div>

</div>



<div id="main" role="main">

	<div id="rich-text1">
		<div class="weblet-inner">
			<div class="steps-holder">

			</div>
		</div>
	</div>
    
	<div id="rich-text2">
		<div class="weblet-inner">
	
		</div>
	</div>

	<div id="rich-text3">
		<div class="weblet-inner">
		
		</div>
	</div>

	<div id="rich-text4">
		<div class="weblet-inner">

		</div>
	</div>

<div class="holder2">
	<div class="bottom-boxes">
		<div class="frame"></div>
	</div>
</div>
</div>

</div>
</div>
<div class="clr"></div>


 
 <style>
.hide{
    
    display:none;
}
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

<script type="text/javascript" src="<?php echo base_url() ?>public/js/redactor123/assets/redactor.min.js" defer ></script>

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
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#about_me, #prof_detail').redactor();
	});
</script>

<script>
$('#blah').hide();
$('#remove').hide();  
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
            
            $('#remove').show();
            $('#blah').show('slow');
            $('#imgname').hide('slow');
      }
        else{ $('#remove').hide();$('#blah').hide('slow');}
        readURL(this);
    });

  
    $('#remove').click(function(){
          $('#file_i').val('');
          $(this).hide();
          $('#blah').hide('slow');
		  $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
});
</script>

<script type="text/javascript">

jQuery(document).ready(function(){

	jQuery('.tooltipicon').click(function(){

	var dispdiv = $(this).attr('id');

	jQuery('.'+dispdiv).css('display','inline-block');

	});

	jQuery('.closetooltip').click(function(){

	jQuery(this).parent().css('display','none');

	});

	});

	</script>
