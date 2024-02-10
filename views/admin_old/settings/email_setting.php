<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">

<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>



<div id="toolbar-box">



	<div class="m top_main_content">



		<div id="toolbar" class="toolbar-list">



			



			<div class="clr"></div>



		</div>



		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo 'Email Settings';?></h2>
		<p>Fill the name and email id that you want to show as the sender for all mail send to users of your online academy. make sure that email id you've entered is a valid one.</p>
		</div>



	</div>



</div>







<div style="margin-bottom:10px;">
	<p>Here you can set the email information of emails that come out of the system.</p>
</div>

<div class="field_container">	
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		<div class="panel primary-border panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title field-title" style="padding:0!important;">
					Email Settings
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body form-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">From Name :</label>
						
						<div class="col-sm-12">
						<?php
						// $urldomain = base_url();
						// $urldomain = str_replace('https://', '', $urldomain);
						// $urldomain = str_replace('/', '', $urldomain);
						// $urldomain = str_replace('www.', '', $urldomain);

						$urldomain = substr(base_url(), 8,-1); //jyoti
						?>	
                        <input type="text" class="form-control form-height" value="<?php echo $fromname; ?>" name="fromname" size="32" placeholder="From Name">
						
                        <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="fromname-target" class="tooltipicon"></span>

						<span class="fromname-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('email_fld_from-name');?>

                         

						</span>

						</span> -->

						<!-- tooltip area finish -->
						
                        </div>
					</div>
                   
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">From Email</label>
						
						<div class="col-sm-12">
							
                        <input type="text" class="form-control form-height" placeholder="From Email" value="<?php echo "noreply@".$urldomain; //$fromemail; ?>" name="fromemail" size="32" readonly>
						
                     <!-- tooltip area -->  
						<!-- <span class="tooltipcontainer">

						<span type="text" id="fromemail-target" class="tooltipicon"></span>

						<span class="fromemail-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('email_fld_from-email');?>

                         

						</span>

						</span>
 -->
						<!-- tooltip area finish -->
						</div>
					</div>
                   
                    	<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Your Signature</label>
						
						<div class="col-sm-12">
							
                        <!--<input type="text" class="form-control" placeholder="From Email" value="<?php echo $fromemail; ?>" name="fromemail" size="32">-->
						<textarea class="form-control form-height" name="signaturetxt" id="signaturetxt" placeholder="Enter Your Signature" rows="5"><?php echo $signature; ?></textarea>
                        <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="signature-target" class="tooltipicon"></span>

						<span class="signature-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo"Enter Your Signature";//lang('email_fld_from-email');?>

                       
						</span>

						</span>
 -->
						<!-- tooltip area finish -->
						</div>
						
					</div>
                    
					
					<div class="form-group form-border">
					<br />
                    
                    
						<div class="col-sm-12">
							<a>
								<?php echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>
                            </a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
  </div>
	</div>
</div>

    <input type="hidden" value="1" name="id">



	<input type="hidden" value="5" name="tab">



<?php echo form_close(); ?>





<!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){

//	jQuery('.tooltipicon').click(function(){

//	var dispdiv = jQuery(this).attr('id');

//	jQuery('.'+dispdiv).css('display','inline-block');

//	});

//	jQuery('.closetooltip').click(function(){

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

<!-- tool tip script finish -->
<!--<script type="text/javascript">
	jQuery(document).ready(
		function()
		{
			
			jQuery('#signaturetxt').redactor({
			        focus: true,
			        imageUpload: window.location.origin+'/admin/settings/getImage',
	                
			});			
			
		}
	);
</script>-->
<script type="text/javascript">
	// jQuery(document).ready(
	// 	function()
	// 	{
	// 		jQuery('#signaturetxt').redactor();
	// 		//jQuery('#message').redactor();
	// 		//jQuery('#meta_descript').redactor();
	// 	}
	// );
</script>
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#signaturetxt',
  height: 180,
 // min_width: 400,
  plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen"
 });
   });
  </script>