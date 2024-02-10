<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php



$attributes = array('class' => 'tform', 'id' => '');



echo form_open_multipart(base_url().'admin/settings/support_team', $attributes);



?>

<style type="text/css">
	.ptxt
	{
		font-size: 15px;
	}
	.btxt
	{
	font-size: 15px;	
	}
</style>
<div class="main-container">
<div class="col-md-12">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title no-padding">
					<h2>Contact Support Team</h2>
					<p>If you can't find a solution to your problems in our knowledgebase and video tutorials, you can contact support team directly by selecting the appropriate department below.</p>
				</div>
				
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
		<div class="field_container">
			<div class="row">
				<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
			<div class="panel-body tab-box" style="border-top: 3px solid #ebebeb!important;">
				
					<fieldset role="form" class="adminform form-horizontal form-groups-bordered">

					 <div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">Your Current Contact Email ID <span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
                            
                            <input id="email" type="text" name="email"  class="form-control form-height" placeholder="Enter Your email" maxlength="256" value="<?php  echo set_value('email');?>"  />
                            
                            <!-- tooltip area -->

						     
						<span style="color: red;"><?php echo form_error('email'); ?></span>
						</div>
					</div>                 
                    
                    <div class="clear"></div>

                    <div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">Choose Department<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
                            
                       <select name="mailto" id="mailto" class="form-control form-height">                        
                           <option value="Support">- Support</option>                            
                           <option value="Billing">- Billing</option>                            
                           <option value="Technical">- Technical</option>                            
                           <option value="Sales">- Sales</option>                                                     
                       </select>

                            <!-- <input id="to" type="text" name="to"  class="form-control" placeholder="Enter help for" maxlength="256" value="<?php  echo set_value('to');?>"  /> -->
                            
                            <!-- tooltip area -->

						   
						<span style="color: red;"><?php echo form_error('mailto'); ?></span>
						</div>
					</div>                 
                    
                    <div class="clear"></div>

                    <div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">Subject<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
                            
                            <input id="subject" type="text" name="subject"  class="form-control form-height" placeholder="Enter Subject" maxlength="256" value="<?php  echo set_value('subject');?>"  />
                         
							<span style="color: red;"><?php echo form_error('subject'); ?></span>
						</div>
					</div>                 
                    
                    <div class="clear"></div>

                    <div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">Message<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
                            
                            <textarea id="message" type="text" name="message"  class="form-height form-control" placeholder="Enter Message" maxlength="256" value="" rows="5" /><?php  echo set_value('message');?></textarea>
                            
                                
						<span style="color: red;"><?php echo form_error('message'); ?></span>
						</div>
					</div>                 
                    
                    <div class="clear"></div>

                    <div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">Attachments<span style="color:#FF0000;" class="error"></span></label>
						
						<div class="col-sm-12">                            
						    <div class="grey-background">    
								<input type="file" id="file_i" name="file_i" data-filename-placement="inside"> 
							</div>
						<br>
						<p>* Allowed File Extensions: <br>
.jpg, .gif, .jpeg, .jpg, .png, .bmp, .pdf, .eml, .rar, .zip, .doc, .docx, .xls, .xlxs, .txt, .wav</p>          
                        						
						</div>
					</div> 
                    <div class="form-group form-border">
						
                        <div class="col-sm-12">
						   
			<?php echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>
            
            <!-- <a href='<?php echo base_url(); ?>/admin/users/' class='btn btn-red'><span class="icon-32-cancel"> </span>Cancel</a> -->
						</div>
					</div>
				</fieldset>
		   </div>
		
		</div>
	</div>
	</div>
	</div>
	</div>
</div>



    <!-- <input type="hidden" value="1" name="id"> -->



	<!-- <input type="hidden" value="5" name="tab"> -->



<?php echo form_close(); ?>





<!-- tool tip script -->

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

<script>
var $ =jQuery.noConflict();
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