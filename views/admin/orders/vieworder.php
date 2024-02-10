<?php
 
 

  
?>
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

			ftpfileoptions = '<img src="<?php echo base_url() ?>public/uploads/users/img/thumbs/'+data.ftpfilearray+'">';

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




<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">

			<ul style="list-style: none; float: right;">

			<li id="toolbar-new" class="listbutton">

            <a href="javascript:void(0)" onclick="sendOrderMail(<?php echo $this->uri->segment(4); ?>);"><img align="viewed" src="http://www.create-online-academy.com/public/default/images/email.png" title="Email this certificate"></a>

            <a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(4); ?>);"><img align="viewed" src="<?php echo base_url() ?>public/default/images/download.png" title="Download your Order Invoice as PDF"></a>

			</li>

			

			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'View Order';?></h2></div>
	</div>
</div>
<div class='clear'></div>

<div class="row">
	<div class="col-md-12">
		<!--<p class="pquestionsub">In case of automatic order generation has not happen due to any reason and you need to generated payment receipt
					manually, you can do so from this option. On completion mail will go to the users' email id with confirmation of the
					payment for the course.</p>-->	
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo (($updType == 'edit')?'View Order':'Create New Order');?>

				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
                       

                    <div class="form-group">
						<label class="col-sm-3 control-label">Order ID</label>
						
						<div class="col-sm-5">
							
                           
                            <label><?php echo $order->id;?></label>
				
						</div>
					</div>
                    
                    <br/>
                    <br/>
                    
                    <div class="clear"></div>

                    <div class="form-group">
						<label class="col-sm-3 control-label">Transaction ID</label>
						
						<div class="col-sm-5">
							
                           
                            <label><?php echo $order->transactionid;?></label>
				
						</div>
					</div>
                    
                    <br/>
                    <br/>
                    
                    <div class="clear"></div>
                
					<div class="form-group">
						<label class="col-sm-3 control-label">User Name</label>
						
						<div class="col-sm-5">
							
                           
                            <label><?php echo $this->users_model->getUserName($order->userid);?></label>
				
						</div>
					</div>
                    
                    <br/>
                    <br/>
                    
                    <div class="clear"></div>
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Course</label>
						
						<div class="col-sm-5">
							
                           <?php
                           			$coursearr=explode('-',$order->courses);
		
		                           $plan_id = $this->users_model->getPlanId(@$coursearr[0]);
                           ?>
                            <label><?php echo $this->users_model->getProgramName(@$coursearr[0]);?></label>
						</div>
					</div>
					
                    
                    <br/>
                    <br/>
					
					<div class="clear"></div>
                    
                  
					
					<div class="clear"></div>
                    
                    <div class="form-group">
						<label for="Price" class="col-sm-3 control-label">Price</label>
						
						<div class="col-sm-5">
							<label><?php echo $this->users_model->getPrice(@$coursearr[0]); ?></label>
                            
						</div>
					</div>
					
                    
                    <br/>
                    <br/>
					
					 <div class="clear"></div>

					 <div class="form-group">
						<label for="Price" class="col-sm-3 control-label">Currency</label>
						
						<div class="col-sm-5">
							<label><?php echo $order->currency;?>
							 <?php  $signs= $this->settings_model->getCurrenciesign($order->currency); ?>
				              <?php echo $signs ? '('.$signs->sign.')' : '';?></label>
                            
						</div>
					</div>
					
                    
                    <br/>
                    <br/>
					
					 <div class="clear"></div>
                    
					<div class="form-group">
						<label class="col-sm-3 control-label">Order Date</label>
						
						<div class="col-sm-5">                           
                            <label><?php echo $order->order_date; ?></label>
						</div>
					</div>
					
                    <br/>
                    <br/>
					
                    <div class="clear"></div>
                    
					<div class="form-group">
						<label class="col-sm-3 control-label">Status</label>
						
						<div class="col-sm-5">                           
                            <label><?php echo $order->status; ?></label>
						</div>
					</div>
					
                    <br/>
                    <br/>
                    
                    <div class="clear"></div>
                    
                    <div class="form-group">
						<label for="pending_reason" class="col-sm-3 control-label">Pending Reason</label>
						
						<div class="col-sm-5">
                            
                           <label><?php echo $order->pending_reason;?></label>

						</div>
					</div>                   
                    
                    
                    <br/>
                    <br/>
                    
                    <div class="clear"></div>
                    
                    <div class="form-group">
						<label for="Processor" class="col-sm-3 control-label">Payment Gateway </label>
						
						<div class="col-sm-5">
							
                             <label><?php echo $order->processor;?></label>
                            
						</div>
					</div>
					
					<br/>
                    <br/>
					<div class="clear"></div>
                    
					<!--<div class="form-group">
						
                        <div class="col-sm-offset-3 col-sm-5">
						   
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'")); ?>
            
            <a href='<?php echo base_url() ?>admin/orders/' class='btn btn-red'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>-->
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>

 <link rel="stylesheet" href="<?php echo base_url() ?>js/redactor/css/redactor.css" />

<script src="<?php echo base_url() ?>js/redactor/redactor.js"></script>

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


<script type="text/javascript">
	function openWinCertificate4(id)

    {

        myWindow=window.open('<?php echo base_url(); ?>admin/orders/pdf/'+id,'','width=800,height=600, resizable = 0');

    myWindow.focus();

    }
    function sendOrderMail(id)

    {

        myWindow=window.open('<?php echo base_url(); ?>admin/orders/sendOrderMail/'+id,'','width=800,height=600, resizable = 0');

    myWindow.focus();

    }
	</script>