<?php
 
 
  //echo '<pre>';
 // print_r($review);
  
  
?>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

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

			ftpfileoptions = '<img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/'+data.ftpfilearray+'">';

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

<div class="main-container">

<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/programs/editreview/', $attributes) : form_open_multipart(base_url().'admin/programs/editreview/'.$id.'/'.$pid, $attributes);

?>




<h2><?php echo (($updType == 'edit')?'Edit Review':'Create Order');?></h2>

<div class="field_container">
<div class="row">
	<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		<p class="main_subtitle">In case of automatic order generation has not happen due to any reason and you need to generated payment receipt
					manually, you can do so from this option. On completion mail will go to the users' email id with confirmation of the
					payment for the course.</p>	
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="padding-left:0;">
					<?php echo (($updType == 'edit')?'Edit Review':'Create New Order');?>

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
						<label class="col-sm-3 control-label field-title">User Name</label>
						<div class="col-sm-5 field-title">
							<?php

                                  $username = $this->programs_model->getUserName($review[0]->user_id);
				             ?>
                            <label><?php echo ucfirst($username)?></label>
                            
						</div>
						
					</div>
                   
                    <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label class="col-sm-3 field-title control-label">Rate</label>
						<div class="col-sm-5 field-title">
							
                             <label><?php echo $review[0]->review_rate;?></label>
                            
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
                    
                    <div class="form-group form-border">
						<label for="Price" class="col-sm-12 field-title control-label">Title<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">
							
							<input type="text" name="review_title" class="form-height form-control" id="review_title" value="<?php echo $review[0]->title;?>" />
							
                            
                            
						</div>
					</div>
					
                    <div class="clear"></div>
                    
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Description<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">  

							<textarea name="review_desc" id="review_desc" class="form-height form-control"><?php echo $review[0]->description;?> </textarea>                         
                            
					</div>

					</div>
					
                    <div class="clear"></div>
                    
                    <div class="form-group form-border">
						<label for="pending_reason" class="col-sm-3 field-title control-label">Review Date</label>
						
						<div class="col-sm-5 field-title">
                           <label><?php echo $review[0]->review_date;?></label> 
                           
					</div>

					</div>
                    
					<div class="clear"></div>
                    
					<div class="form-group form-border">
						
                        <div class="col-sm-12">
						   
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save changes", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>
            
            <a href='<?php echo base_url(); ?>admin/programs/reviews/<?php echo $pid; ?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>
</div>
</div>
 <link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />

<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>

<script>

 $(document).ready(

 function()

 {

   	$('#review_desc').redactor();

 }

 );

 </script>



<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$id); ?>

<?php endif ?>

<?php echo form_close(); ?>



<!-- tool tip script -->

<script type="text/javascript">

$(document).ready(function(){

	$('.tooltipicon').click(function(){

	var dispdiv = $(this).attr('id');

	$('.'+dispdiv).css('display','inline-block');

	});

	$('.closetooltip').click(function(){

	$(this).parent().css('display','none');

	});

	});

	</script>

<!-- tool tip script finish -->