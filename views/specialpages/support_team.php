<?php



$attributes = array('class' => 'tform', 'id' => '');



echo form_open_multipart(base_url().'specialpages/support_team', $attributes);



?>


<header>
	<section class="breadcrumb">
		<div class="container">
		<span class="page-title">Contact Support</span>
		<div class="bread-view">
			<a href="http://create-online-academy.com/"><i class="entypo-home"></i></a>
			<span class="ng-hide">/ </span>
			<a href="<?php echo base_url(); ?>specialpages/support_team">Contact Support</a>
		</div>
		</div>
	</section>
</header>

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

<section class="container courses">
           <div class="row-fluid ">
<div class="col-md-12" style="margin-top: 20px;">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="font-size: 16px;">
				<b>Contact Support Team</b>
				</div>
				
				<div class="panel-options">
					
				</div>
			</div>
			
			<div class="panel-body">
				
					<fieldset role="form" class="adminform form-horizontal form-groups-bordered">

					<div class="form-group">
						
					<p style="text-align: left; margin-bottom: 0; margin:0 30px;">If you can't find a solution to your problems in our knowledgebase and video tutorials, you can contact support team directly by selecting the appropriate department below.</p>

                    </div>
					 <div class="form-group">
						<label for="first Name" class="col-sm-3 control-label">Your Current Contact Email ID <span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-5">
                            
                            <input id="email" type="text" name="email"  class="form-control" placeholder="Enter Your email" maxlength="256" value="<?php  echo set_value('email');?>"  />
                            
                            <!-- tooltip area -->

						     
						<span style="color: red;"><?php echo form_error('email'); ?></span>
						</div>
					</div>                 
                    
                    <div class="clear"></div>

                    <div class="form-group">
						<label for="first Name" class="col-sm-3 control-label">Choose Department<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-5">
                            
                       <select name="mailto" id="mailto" class="form-control">                        
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

                    <div class="form-group">
						<label for="first Name" class="col-sm-3 control-label">Subject<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-5">
                            
                            <input id="subject" type="text" name="subject"  class="form-control" placeholder="Enter Subject" maxlength="256" value="<?php  echo set_value('subject');?>"  />
                            
                           

						      
			<span style="color: red;"><?php echo form_error('subject'); ?></span>
						</div>
					</div>                 
                    
                    <div class="clear"></div>

                    <div class="form-group">
						<label for="first Name" class="col-sm-3 control-label">Message<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-5">
                            
                            <textarea id="message" type="text" name="message"  class="form-control" placeholder="Enter Message" maxlength="256" value="" rows="5" /><?php  echo set_value('message');?></textarea>
                            
                                
						<span style="color: red;"><?php echo form_error('message'); ?></span>
						</div>
					</div>                 
                    
                    <div class="clear"></div>

                    <div class="form-group">
						<label for="first Name" class="col-sm-3 control-label">Attachments<span style="color:#FF0000;" class="error"></span></label>
						
						<div class="col-sm-5">                            
						        
						<input type="file" id="file_i" name="file_i" data-filename-placement="inside"> 
						<br>
						<p>* Allowed File Extensions: <br>
.jpg, .gif, .jpeg, .jpg, .png, .bmp, .pdf, .eml, .rar, .zip, .doc, .docx, .xls, .xlxs, .txt, .wav</p>          
                        						
						</div>
					</div> 
                    <div class="form-group">
						
                        <div class="col-sm-offset-3 col-sm-5">
						   
			<?php echo form_submit( 'submit', "Submit","id='submit' class='btn btn-success'"); ?>
            
            <!-- <a href='<?php echo base_url(); ?>/admin/users/' class='btn btn-red'><span class="icon-32-cancel"> </span>Cancel</a> -->
						</div>
					</div>
				</fieldset>
		   </div>
		
		</div>
	
	</div>


</div>

</section>

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