<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
<?php



// $attributes = array('class' => 'tform', 'id' => 'social_form');



// echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/sociallogins', $attributes) : form_open_multipart(base_url().'admin/settings/sociallogins');



?>



<div id="toolbar-box">



	<div class="m top_main_content">

<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0"><h2 class="tab_heading"><?php echo 'Social Logins';?></h2>
<h6>
	Configure social logins here. This will allow users to login/sign-up using their Facebook or Google ID in your academy.
</h6>
</div>

		<!-- <div id="toolbar" class="toolbar-list">


		</div> -->

	</div>

</div>



	<!-- <div>
		<p class="mb_20">
		</p>
	</div> -->

<form class = 'tform' id = 'social_form' >


    <?php //$this->ckeditor->editor("content_selling",$content_selling);?>
<div class="field_container">	
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel primary-border panel-primary" data-collapsed="0">
		
			<div class="panel-body form-body">
				<div class="form-group form-border" style="line-height: 40px;">
                <?php
	                 $CI = & get_instance();
	                 $CI->load->model('admin/settings_model');
	                 $socialstatus = $this->settings_model->getSocialStatus(1,'mlms_socialstatus'); 
	                 // print_r($socialstatus);
              	?>   
                    <label class="col-sm-2 control-label field-title" for="Paragraph" id="label">Social Login:</label>
                  
                  <div class="col-md-9"> 
                  	<div class="onoffswitch">
					    <input type="checkbox" name="social_data" class="onoffswitch-checkbox" id="social_data" value="1" <?php echo ($socialstatus->social_login && $socialstatus->social_login == '1') ? "checked" : ''?> >
					    <label class="onoffswitch-label" for="myonoffswitch">
					        <span class="onoffswitch-inner"></span>
					        <span class="onoffswitch-switch"></span>
					    </label>
					</div>
                  </div>
                </div>
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Facebook App Id :</label>
						
						<div class="col-sm-12">
							
               <input type="text" class="form-control form-height"  value="<?php echo $sociallogins->facebook->appid; ?>" name="fbappid" size="100">
                          

						</div>
					</div>
                   
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Facebook Secret key :</label>
						
						<div class="col-sm-12">
							
                            <input type="text" class="form-control form-height" value="<?php echo $sociallogins->facebook->appsecretkey; ?>" name="fbsecreatekey" size="100">

				
						</div>
					</div>
                    
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Google Client Id :</label>
						
						<div class="col-sm-12">
							
               <input type="text" class="form-control form-height" value="<?php echo $sociallogins->googleplus->clientid; ?>" name="googleappid" size="100">
                          

						</div>
					</div>
                    
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Google Client Secret key :</label>
						
						<div class="col-sm-12">
							
                            <input type="text" class="form-control form-height"  value="<?php echo $sociallogins->googleplus->clientsecreatekey; ?>" name="googlesecreatekey" size="100">

				
						</div>
					</div>
                    
					<div class="form-group form-border" style="padding-top:2.5%!important;">
						<div class="col-sm-12">
							
                            
			<a>

                   
 <button type="button" id="social_submit" class='btn btn-default btn-green'>Update</button>
			


			</a>
						</div>
					</div>
					<input type="hidden" value="1" name="id" />
				</form>
				
			</div>
		
		</div>
	</div>
	</div>
	</div>
    
</div>
</form>


	<?php echo form_error('description'); ?> 


<?php echo form_close(); ?>



<script>

	 $(document).on('click', '#social_submit', function(){
		$.ajax({
		type: 'POST',
		data: $("#social_form").serialize(),
		url: "<?php echo base_url(); ?>admin/settings/social_post",
		beforeSend: function(){
			window.scrollTo(0,0);
		},
		success: function(msg){
			var alt_msg = $(document).find('#message');
			 if(msg)
            {
               var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Successfully updated. </div>';         
            }
            else{
              var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-warning" aria-hidden="true"></strong> Fail to updated, Please try again! </div>';
            } 

            alt_msg.html(str);
            alt_msg.show();
            alt_msg.fadeIn().delay(3000).fadeOut();
            // $('#lecture_save').prop('disabled', false);

        
			
		}
	});
	});

</script>


<!-- tool tip script -->

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

<!-- tool tip script finish -->
<script>
	jQuery(document).ready(function(){
		jQuery(".onoffswitch").on('click', function() {
		
		var jQuerybox = jQuery('#social_data');
		if (jQuerybox.is(":checked")) 
		{

			jQuery('#social_data').prop("checked", false);
		} 
			else 
			{
				jQuerybox.prop("checked", true);
			}
		});
	});
</script>