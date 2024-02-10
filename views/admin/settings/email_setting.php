<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script src='<?php echo base_url(); ?>public/js/tinymce/tinymce.min.js'></script>
<style>
	
.mce-tinymce.mce-container.mce-panel .mce-ico {
    font-family: 'tinymce',Arial;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    font-size: 16px!important;
    line-height: 16px;
    speak: none;
    vertical-align: text-top;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    display: inline-block;
    background: transparent center center;
    background-size: cover;
    width: 16px;
    height: 16px;
    color: #333;
}
.tab-content>.tab-pane {
    margin-top: 20px;
}
</style>
<div class="main-container">
<?php
						$urldomain = base_url();
						$urldomain = explode(':', $urldomain);
						$urldomain = str_replace('//', '', $urldomain[1]);
						$urldomain = rtrim($urldomain,'/');
						// $urldomain = str_replace('/', '', $urldomain);
						// $urldomain = str_replace('www.', '', $urldomain);
						?>	
<?php



$attributes = array('class' => 'tform', 'id' => 'email_form');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>



<div id="toolbar-box">



	<div class="top_main_content">
		<div class="col-sm-12 pagetitle icon-48-generic mb_20" style="padding:0;"><h2 class="tab_heading"><?php echo 'Email Settings';?></h2>
		<h6>Your online academy has several automated emails that are to be sent to your students, like Academy Welcome emails, Course welcome emails, etc. Here you can change the sender name and the email signature</h6>
		</div>

	
		<!-- <div id="toolbar" class="toolbar-list">
		</div> -->	
	</div>
</div>







<!-- <div style="margin-bottom:10px;">
	<p>Here you can set the email information of emails that come out of the system.</p>
</div> -->

<div class="field_container">	
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		<div class="panel primary-border panel-primary" data-collapsed="0">

			
			<div class="panel-body form-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">From Name :</label>
						
						<div class="col-sm-12">
						
                        <input type="text" class="form-control form-height" id="fromname" value="<?php echo $fromname; ?>" name="fromname" size="32" placeholder="From Name">
						
                        
						
                        </div>
					</div>
                   
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">From Email</label>
						
						<div class="col-sm-12">
							
                        <input type="text" class="form-control form-height" placeholder="From Email" value="<?php echo $fromemail ? $fromemail : "noreply@".$urldomain; //$fromemail; ?>" id="fromemail" name="fromemail" size="32" readonly>
						
                   
						</div>
					</div>
                   
                    	<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 field-title control-label">Your Signature</label>
						
						<div class="col-sm-12">
							
                        <!--<input type="text" class="form-control" placeholder="From Email" value="<?php echo $fromemail; ?>" name="fromemail" size="32">-->
						<textarea class="form-control form-height" name="signaturetxt" id="signaturetxt" placeholder="Enter Your Signature" rows="5"><?php echo $signature; ?></textarea>
                       
						</div>
						
					</div>
                    
					
					<div class="form-group form-border">
					<br />
                    
                    
						<div class="col-sm-12">
							<a>
								 <button type="button" id="email_submit" class='btn btn-default btn-green'>Update</button>
								<?php //echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>
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

<script>

	 $(document).on('click', '#email_submit', function(){
	 	var fromname = $('#fromname').val();
	 	var fromemail = $('#fromemail').val();
	 	var urldomain = "<?php echo $urldomain; ?>";
	 	if(fromemail == '')
	 	{
	 		fromemail = "noreply@"+urldomain;
	 	}
	 	
	 	var signature = tinymce.get('signaturetxt').getContent();

		$.ajax({
		type: 'POST',
		data: {'fromname':fromname, 'fromemail': fromemail, 'signaturetxt': signature},
		url: "<?php echo base_url(); ?>admin/settings/email_post",
		beforeSend: function(){
			window.scrollTo(0,0);
		},
		success: function(msg){
			// console.log(msg);
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