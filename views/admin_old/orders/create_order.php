<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script type="text/javascript">

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

    $('#full_bio').redactor();

	document.getElementById("twitter_td").style.display="table-row";

	document.getElementById("facebook_td").style.display="table-row";

	document.getElementById("blogurl_td").style.display="table-row";

	document.getElementById("websiteurl_td").style.display="table-row";

	document.getElementById("bio_td").style.display="table-row";

    document.getElementById("email_td").style.display="table-row";

	document.getElementById("title_td").style.display="table-row";

	document.getElementById("stdemail_td").style.display="none";



	}else

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



<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/orders/create', $attributes) : form_open_multipart(base_url().'admin/orders/edit/'.$id, $attributes);

?>


<div class="main-container">
<div class="col-sm-12" style="padding:0;"><h2><?php echo (($updType == 'edit')?'Edit Order':'Create Order');?></h2></div>
<div class="field_container">
<div class="row">
	<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
	  <div class="main_subtitle">
		<p>In case of automatic order generation has not happen due to any reason and you need to generated payment receipt
			manually, you can do so from this option. On completion mail will go to the users' email id with confirmation of the
			payment for the course.</p>	
	  </div>
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo (($updType == 'edit')?'Edit Exist Order':'Create New Order');?>

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
						<label class="col-sm-12 control-label field-title">User Name<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">		                           
                            <select onchange="javascript:showhidefields(this.selectedIndex)" name='user_id' id='user_id' onclick="" class="form-control form-height" <?php if(@$order) echo 'disabled'; ?> >
                                <option value="">Select</option>  									           
                                <?php								   
								foreach($username as $usernm)
								{
									?>
									<option value="<?php echo $usernm->id;?>" <?php echo ($this->input->post('user_id') == $usernm->id) ? "selected=selected" : (isset($order->userid)) && @$order->userid == $usernm->id ? "selected=selected" : '' ?>><?php echo $usernm->first_name.' '.$usernm->last_name;?></option>
									<?php 
								}
								?>
	                        </select>
	                        <span class="error"><?php echo form_error('user_id'); ?></span>
	                    <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">
						<span type="text" id="uname-target" class="tooltipicon"></span>
						<span class="uname-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('order_fld_umane');?>
                         
						</span>
						</span>  -->            

<!-- tooltip area finish -->
						</div>
					</div>                    
                                       
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label class="col-sm-12 control-label field-title">Course<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">                     
                            <select onchange="javascript:showhidefields(this.selectedIndex)" name='course_id' id='course_id' class="form-control form-height" <?php if(@$order) echo 'disabled'; ?>>
                                <option value=" ">Select</option>  									           
                                <?php
								foreach($courses as $course)
								{
									?>
									<!--<option value="<?php echo $course->id; ?>" <?php echo ( @$order->courses == $course->id  )? 'selected="selected"' : '' ?> ><?php echo $course->name;?></option>-->
									<option value="<?php echo $course->id;?>" <?php echo ($this->input->post('course_id') == $course->id) ? "selected=selected" : (isset($order->courses)) && @$order->courses == $course->id ? "selected=selected" : '' ?>><?php echo $course->name;?></option>
									<?php 
								}
								?>
							</select>
							<span class='error'><?php echo form_error('course_id'); ?></span>

                            <!--<input type="hidden" name="user_id" value="<?php echo @$order->userid; ?>" />
                            <input type="hidden" name="course_id" value="<?php echo @$order->courses; ?>" />-->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="course-target" class="tooltipicon"></span>

						<span class="course-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_course');?>

                         

						</span>

						</span> -->

<!-- tooltip area finish -->
						</div>
					</div>					
                    
                    
					
					<div class="clear"></div>
                    
                   <!-- <div class="form-group">
						<label for="Plan" class="col-sm-3 control-label">Plan</label>
						
						<div class="col-sm-5">
							
                             <input id="plan" class="form-control" placeholder="Enter Plan" type="text" name="plan" maxlength="256" value="<?php echo set_value('plan', (isset($order->last_name)) ? $order->last_name : ''); ?>"  />


<!-- tooltip area -->

						

<!-- tooltip area finish -->
                            
					<!--	</div>
					</div>
					
                    
                    <br/>
                    <br/>-->
					
					<div class="clear"></div>
                    
                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label for="Price" class="col-sm-12 control-label field-title">Price</label>
						
						<div class="col-sm-12">
							<?php
								$price = $this->users_model->getPrice(@$order->courses);								
							?>
                        <input id="price" class="form-control form-height" placeholder="Enter Price" type="text" name="price" maxlength="256" value="<?php echo ($this->input->post('price')) ? $this->input->post('price') : ((isset($price)) ? $price : '');?>"  <?php if(@$order) echo 'readonly'; ?> />
						<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="price-target" class="tooltipicon"></span>

						<span class="price-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_price');?>

                         

						</span>

						</span> -->

                        <?php echo form_error('last_name'); ?>

<!-- tooltip area finish -->
                            
						</div>
					</div>				
                    
                    		
					
                    <div class="clear"></div>
                    
					<div class="form-group form-border">
						<label class="col-sm-12 control-label field-title">Status<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">                           
                            <select onchange="javascript:showhidefields(this.selectedIndex)" name='status_id' id='status_id' class="form-control form-height">
                                <option value=" ">Select</option>  
								<option value="Completed" <?php echo ($this->input->post('status_id') == 'Completed') ? "selected=selected" : (isset($order->status)) && @$order->status == 'Completed' ? "selected=selected" : '' ?> >Completed</option>
					            <option value="Pending" <?php echo ($this->input->post('status_id') == 'Pending') ? "selected=selected" : (isset($order->status)) && @$order->status == 'Pending' ? "selected=selected" : '' ?> >Pending</option>
					            <option value="Failure" <?php echo ($this->input->post('status_id') == 'Failure') ? "selected=selected" : (isset($order->status)) && @$order->status == 'Failure' ? "selected=selected" : '' ?> >Failure</option>                    
			                </select>
			                <span class='error'><?php echo form_error('status_id'); ?></span>
			            <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="status-target" class="tooltipicon"></span>

						<span class="status-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_status');?>

                       

						</span>

						</span> -->
						<!-- tooltip area finish -->
						</div>
					</div>
					 
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label for="pending_reason" class="col-sm-12 control-label field-title">Pending Reason</label>
						
						<div class="col-sm-12">                          
	                        <input id="pending_reason" class="form-control form-height" placeholder="Enter Pending Reason" type="text" name="pending_reason" maxlength="256" value="<?php echo ($this->input->post('pending_reason')) ? $this->input->post('pending_reason') : ((isset($order->pending_reason)) ? $order->pending_reason : '');?>"  <?php if(@$order) echo 'readonly'; ?> />
							<!-- tooltip area -->
							<!-- <span class="tooltipcontainer">
							<span type="text" id="pending-target" class="tooltipicon"></span>
							<span class="pending-target  tooltargetdiv" style="display: none;" >
							<span class="closetooltip"></span>
							
							<?php echo lang('order_fld_pending');?>
	                         
							</span>
							</span> -->
							<!-- tooltip area finish -->
						</div>
					</div>
                    
                    
                    <div class="clear"></div>
					
                    <div class="form-group form-border">
						<label for="Amount" class="col-sm-12 control-label field-title">Amount</label>
						
						<div class="col-sm-12">
                            
                        <input id="amount" type="text" name="amount"  class="form-control form-height" placeholder="Enter Amont" maxlength="256" value="<?php echo ($this->input->post('amount')) ? $this->input->post('amount') : ((isset($order->amount_paid)) ? $order->amount_paid : '');?>"  <?php if(@$order) echo 'readonly'; ?>/>
                        
                        <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="amount-target" class="tooltipicon"></span>

						<span class="amount-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_amount');?>

                         

						</span>

						</span> -->

						<!-- tooltip area finish -->

						</div>
					</div>
                    
                    
                    
                    <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="Processor" class="col-sm-12 field-title control-label">Processor <span style="color:#FF0000;" class="error">*</span>
						<p>(Name of the channel through which you have received the payment.)</p>
						</label>
						
						<div class="col-sm-12">
							
                        <input id="processor" class="form-control form-height" placeholder="Enter Processor" type="text" name="processor" maxlength="256" value="<?php echo set_value('processor', (isset($order->processor)) ? $order->processor : ''); ?>"  <?php if(@$order) echo 'readonly'; ?> />
						<span class='error'><?php echo form_error('processor'); ?></span>
						<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="processor-target" class="tooltipicon"></span>

						<span class="processor-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo lang('order_fld_processor');?>

                         

						</span>

						</span>    -->                    

						<!-- tooltip area finish -->
                            
						</div>
					</div>
					
					
                    <!-- new code start here @@@@@@@@@@@@@@@@@@@@@@-->

                    <div class="form-group form-border" style="padding-top: 0!important;">
						<label for="Processor" class="col-sm-12 control-label field-title">Note <span style="color:#FF0000;" class="error"></span></label>
						
						<div class="col-sm-12">
							
                            <textarea id="note" name="note" class="form-control select-box-border" placeholder="Enter Note"><?php echo ($this->input->post('note')) ? $this->input->post('note') : ((isset($order->note)) ? $order->note : '');?></textarea>


<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="note-target" class="tooltipicon"></span>

						<span class="note-target  tooltargetdiv" style="display: none;">

						<span class="closetooltip"></span>

						

						<?php echo "Enter Notes";?>

                         

						</span>

						</span> -->

                        <?php echo form_error('last_name'); ?>

<!-- tooltip area finish -->
                            
						</div>
					</div>
					
                    <!-- new code end here @@@@@@@@@@@@@@@@@@@@ -->
					<div class="clear"></div>
                    
					<div class="form-group form-border" style="padding-top: 2.5%!important;">
						
                        <div class="col-sm-5">
						   
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>
            
            <a href='<?php echo base_url(); ?>/admin/orders/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</form>
				
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

	<?php echo form_hidden('id',$order->id); ?>

<?php endif ?>

<?php echo form_close(); ?>



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