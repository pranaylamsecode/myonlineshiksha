<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php
	/*echo '<pre>';
		print_r($pay_setting);
	echo '<pre>';*/
?>
<style type="text/css">
	
	.ptext
	{
		  margin-left: 273px;
		    margin-top: -23px;
	}
	.ptext2
	{
		"margin-top: 12px; 
		margin-left: 257px;
	}
</style>
<div class="main-container">
<div id="toolbar-box">

	<div class="m top_main_content">

		<div id="toolbar" class="toolbar-list">

			<ul style="list-style:none; float:right;">

			<li id="toolbar-new" class="listbutton">

			</li>

			</ul>

			<div class="clr"></div>

		</div>

		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo 'Payment Settings';?></h2><p>Manage Your Payment Account to Receive Payments in Your Online Academy.</p></div>

	</div>

</div>

<div class="tab-content">

	<!--Main fieldset-->

<!--<form id="adminForm" name="adminForm" method="post" action="index.php">     -->

	<fieldset class="adminform">

	</fieldset>
</form>

</div>
<?php

				$attributes = array('class' => 'tform', 'id' => '');

				echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/account', $attributes) : form_open_multipart(base_url().'admin/settings/account'.$id, $attributes);

				?>
				<!-- start Code start here -->
			<div class="field_container form-body main-table">	
				<div class="row seperator" style="padding:0;">
					<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
						<div class="panel primary-border panel-primary" data-collapsed="0">
		
							<div class="panel-heading">
								<div class="panel-title tile_fld field-title">
									Payment&nbsp;Setting
								</div>
							</div>
							<div class="panel-body no-left-padding">

									<fieldset role="form" class="adminform form-horizontal form-groups-bordered">					
										<div class="col-sm-12 form-border form-group" style="padding:0;margin:0;">
										<div class="grey-background" style="display: -webkit-box;">
										<input class="dark_label" id="paypalckb" type="checkbox" <?php if(@$pay_setting['0']['paypal_status'] == 1) echo 'checked' ?> name="paypalckb" value="0" onclick="showhidePaypal();">Paypal <br>

										<input class="dark_label" id="otherckb" type="checkbox" <?php if(@$pay_setting['0']['directpay_status'] == 1) echo 'checked' ?> name="otherckb" value="0" onclick="showhideOther();">  Other Payment Information
										</div>
										</div>
									</fieldset>
							</div>

						</div>
					</div>
				</div>
				<!-- end code -->

<div class="row seperator" id="paypalpanal" style="display:none;padding-top: 15px;" >
	<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel primary-border panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div>
				<p style="text-align:left;">Don't have a PayPal Account? Click on the link and create one now !<a href="https://www.paypal.com" target="_blank"> click here </a></p>
				</div>
				<div class="panel-title field-title tile_fld">
					Paypal&nbsp;Setting
					
				</div>
				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			<?php
				foreach($pay_setting as $pay_setting)
				{
			?>
			<div class="panel-body form-body main-table" style="margin-top: 2%;">
				
				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">PayPal Business Email<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">                            
                            <input id="bsnsemail" type="text" name="paypal_bsns_email"  class="form-control form-height" placeholder="" maxlength="256" value="<?php echo @$pay_setting['paypal_bsns_email']; ?>"  />
						</div>
					</div>
					<!-- <div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">PayPal Username<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">                            
                            <input id="api_username" type="text" name="api_username"  class="form-control form-height" placeholder="Enter API Username" maxlength="256" value="<?php echo @$pay_setting['api_username']; ?>"  />  
						</div>
					</div>
					
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">PayPal Password<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">                            
                            <input id="api_password" type="password" name="api_password"  class="form-control form-height" placeholder="Enter API password" maxlength="256" value="<?php echo @$pay_setting['api_password'];  ?>"  />                              
						</div>
					</div>
					
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">PayPal Signature<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-12">                            
                            <input id="api_signature" type="text" name="api_signature"  class="form-control form-height" placeholder="Enter API Signature" maxlength="256" value="<?php echo @$pay_setting['api_signature'];  ?>"  />                                                  
						</div>
					</div>					
					
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 field-title control-label">Name<span style="color:#FF0000;" class="error">*</span>
						 	<p>Has to be the same as in your Paypal Account</p>
						</label>
						<div class="col-sm-12">                            
                            <input id="name" type="text" name="name"  class="form-control form-height" placeholder="Enter Name" maxlength="256" value="<?php echo @$pay_setting['name']; ?>"  />
                           
						</div>
						
					</div> -->					
					
					
					<div class="form-group form-border" style="padding-top: 3%!important;">
                    
						<div class="col-sm-12">
                        <div class="grey-background" style="display: -webkit-box;">
							<div class="checkbox">
								<label>
									
                                    
                                    <input class="dark_label" id="isLive" type="checkbox" name="isLive" value='1' <?php if(@$pay_setting['status'] == 1) echo 'checked'; ?> />Activate the PayPal Gateway
								 	<p>(You won't be receiving any payment through PayPal till you activate.)</p>



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="active-target" class="tooltipicon"></span>

						<span class="active-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('payment_fld_active');?>

                        

						</span>

						</span>
 -->
					<!-- tooltip area finish -->
								</label>
							</div>
							
							
						</div>
						</div>
					</div>
                    

					
				</fieldset>
				
			</div>
		  <?php } ?>
		</div>
	
	</div>
</div>
					<!-- new code@@@@@@@@@@@@@@@@@@ -->
                    	<div class="form-group form-border">

                    	<!-- new code start here -->

                <div class="row" id="otherpanal" style="display:none">
					<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
						<div class="panel primary-border panel-primary" data-collapsed="0">
		
							<div class="panel-heading">
								<div>
									<p>Here you can put the alternative options of receiving payment from the Academy Users</p>
								</div>
								<div class="panel-title field-title tile_fld">							
									Other Payment Information
								</div>

								<!-- <div class="panel-options">
									<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
									<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
									<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
									<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
								</div> -->
							</div>
							<div class="panel-body form-body main-table" style="margin-top: 2%;">
				
									<fieldset role="form" class="adminform form-horizontal form-groups-bordered">					
										<div class="form-group form-border">
										<!-- <textarea></textarea> -->
											<label for="first Name" class="col-sm-12 field-title control-label">Other Payment Information<!-- <span style="color:#FF0000;" class="error">*</span> --></label>
										<div class="col-sm-12">
										<!-- <select name="selected_course" id="selected_course" multiple="multiple" class="form-control">
                    		<option value="-1">card Information</option>
                                        <option value="1">Cards Numbers </option>
                                        <option value="2"> Cards CSV </option>
                                        <option value="3"> Cards Expire Date</option>
                                        <option value="4"> Name of Cards</option>
                                        
                                        
                                      </select> -->
                                      <textarea id="othertxt" name="othertxt" style="height:150px" class="form-control select-box-border"><?php echo @$pay_setting['directinfo']; ?></textarea>
                                      	</div>
										</div>
									</fieldset>
							</div>

						</div>
					</div>
				</div>
                                    <!-- new code end here -->
                    	</div>

                    <!-- new code end @@@@@@@@@@@@@@@@ -->

						<!-- new code start here -->
                   <div class="row " id="btnDiv" style="display:none">
	<div class="col-md-12">                 
				<fieldset>
                <div class="form-group form-border">
						<div class="col-sm-12" style="padding:0;">
							
                            
                            <?php echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>
						</div>
					</div>
					</fieldset>
					</div>
					</div>
                  </div>
                  </div> 

                     <!-- new code end here -->
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
<script type="text/javascript">
	function showhidePaypal()
	{
		var selvalue = document.getElementById("paypalckb").checked;
		var selvalue2 = document.getElementById("otherckb").checked;
		if(selvalue == true)
		{
			document.getElementById("paypalpanal").style.display="block";						
			
		}
		else
		{
			document.getElementById("paypalpanal").style.display="none";
						
		}
		if(selvalue == true || selvalue2 == true )
		{
			document.getElementById("btnDiv").style.display="block";
		}
		else
		{
		document.getElementById("btnDiv").style.display="none";	
		}		
		
	}
	function showhideOther()
	{
		

		var selvalue = document.getElementById("otherckb").checked;
		var selvalue2 = document.getElementById("paypalckb").checked;
		if(selvalue == true)
		{
			document.getElementById("otherpanal").style.display="block";
			document.getElementById("btnDiv").style.display="block";
		}
		else
		{
			document.getElementById("otherpanal").style.display="none";
			document.getElementById("btnDiv").style.display="none";
		}

		if(selvalue == true || selvalue2 == true )
		{
			document.getElementById("btnDiv").style.display="block";
		}
		else
		{
		document.getElementById("btnDiv").style.display="none";	
		}
	}
	jQuery(document).ready(function(){
		var selvalue = document.getElementById("otherckb").checked;
		var selvalue2 = document.getElementById("paypalckb").checked;

		if(selvalue == true || selvalue2 == true )
		{
			document.getElementById("btnDiv").style.display="block";
		}
		else
		{
		document.getElementById("btnDiv").style.display="none";	
		}
	});
</script>

<script>
 jQuery('#paypalckb').click(function(){

     if(jQuery('#paypalckb').prop('checked')){
          jQuery('#paypalckb').val('1');
     }else{
          jQuery('#paypalckb').val('0');
     }
});	
 jQuery('#otherckb').click(function(){
     if(jQuery('#otherckb').prop('checked')){
          jQuery('#otherckb').val('1');
     }else{
          jQuery('#otherckb').val('0');
     }
});	

 jQuery(document).ready(function(){
     if(jQuery('#paypalckb').prop('checked')){
          document.getElementById("paypalpanal").style.display="block";
          jQuery('#paypalckb').val('1');
     }
     if(jQuery('#otherckb').prop('checked')){
          document.getElementById("otherpanal").style.display="block";
           jQuery('#otherckb').val('1');
     }
     
});	
</script>