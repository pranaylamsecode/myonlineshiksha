<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'create') ? form_open(base_url().'admin/promocodes/create', $attributes) : form_open(base_url().'admin/promocodes/edit/'.$id, $attributes);



?>



<div id="toolbar-box">

	<div class="m top_main_content">

		<div id="toolbar" class="toolbar-list">

			<div class="clr"></div>

		</div>

		<div class="col-sm-12 pagetitle generic" style="padding:0;">

        <h2><?php echo ($updType == 'create') ? 'Add promo code' : 'Edit Promo Code';?></h2>

        </div>

	</div>

</div>



<!--<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">-->



<link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">

<div class="field_container">
 <div class="row content">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
            
				<div class="panel-title">
                <?php if($updType == 'create'){?>
					Add promo code
                    <?php }else{ ?>

         			Edit promo code

        			<?php } ?>
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
						<label for="field-1" class="col-sm-12 control-label field-title">Title<font color="#FF0000">*</font></label>
						
						<div class="col-sm-12">
							
                             <input id="title" class="form-control form-height" type="text" name="title" maxlength="256" value="<?php echo set_value('title', (isset($promocodes->title)) ? $promocodes->title : ''); ?>" placeholder="Title"  />



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="title-target" class="tooltipicon" title="Click Here"></span>

						<span class="title-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_title');?>

                         

						</span>

						</span> -->

<!-- tooltip area finish -->

                        <span class="error"><?php echo form_error('title'); ?></span>
						</div>
					</div>
                    
					
					<div class="form-group form-border" style="padding-top: 0!important;">
						<label for="field-1" class="col-sm-12 control-label field-title">Code<font color="#FF0000">*</font>
							<p>(Alpha-numeric characters only.)</p>
						</label>
						
						<div class="col-sm-12">
							<input type="text" class="form-control form-height" placeholder="Code" name="code" value="<?php echo set_value('code', (isset($promocodes->code)) ? $promocodes->code : ''); ?>">
								<span class="error"><?php echo form_error('code'); ?></span>
						</div>
					</div>
                   
					
					<div class="form-group form-border" style="padding-top: 0!important;">
						<label for="field-1" class="col-sm-12 control-label field-title">Usage limit
							<p>(Leave empty if you don't wish to limit)</p>
						</label>
						
						<div class="col-sm-12">
							<input type="text" value="<?php echo set_value('codelimit', (isset($promocodes->codelimit)) ? $promocodes->codelimit : ''); ?>" name="codelimit"  class="form-control form-height" placeholder="Usage limit">    
								<span class="error"><?php echo form_error('codelimit'); ?></span>
						</div>
					</div>
                    
					<div class="form-group form-border" style="padding-top:0%!important;">
						<label for="field-1" class="col-sm-12 control-label field-title">Discount amount<font color="#FF0000">*</font></label>
						
						<div class="col-sm-6">
							<input type="text" class="form-control form-height"  placeholder="Discount amount" value="<?php echo set_value('discount', (isset($promocodes->discount)) ? $promocodes->discount : ''); ?>" name="discount" size="10">
							<span class="error"><?php echo form_error('discount'); ?></span>
						</div>
						<div class="col-sm-6">
			    			<div class="grey-background">
								<input type="radio" checked="" value="0" <?php echo ($this->input->post('typediscount') == '0') ? 'checked="checked"' : (isset($promocodes->typediscount) && $promocodes->typediscount == '0') ? 'checked="checked"' : ''; ?> name="typediscount">
									<span>$</span>
								<input style="margin-left: 4%;" type="radio" value="1" <?php echo ($this->input->post('typediscount') == '1') ? 'checked="checked"' : (isset($promocodes->typediscount) && $promocodes->typediscount == '1') ? 'checked="checked"' : ''; ?> name="typediscount">
									<span>%</span>
							</div>
						</div>
                            
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="discount-target" class="tooltipicon" title="Click Here"></span>

						<span class="discount-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_discount-amount');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->

                    </div>
					
					<div class="form-group form-border" style="padding-top:0%!important;">
						<label for="field-1" class="col-sm-12 control-label field-title">Start publishing</label>
						
						<div class="col-sm-12">
						
                            <div class="controls input-append date form_datetime" data-link-field="dtp_input1">
								<?php

								$pdate = (isset($promocodes->codestart)) ? $promocodes->codestart : '';
								?>



						<input  type="text" class="form-control form-height" placeholder="Start publishing" maxlength="19" size="25" id="codestart"  value="<?php echo ($this->input->post('codestart')) ? $this->input->post('codestart') : $pdate; ?>"  name="codestart" <?php if($updType == 'edit') { echo 'readonly'; } ?> >

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="codestart-target" class="tooltipicon" title="Click Here"></span>

						<span class="codestart-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_start-publishing-date');?>

                        

						</span>

						</span> -->

<!-- tooltip area finish -->



						</div>
						</div>
					</div>
                    
					
					<div class="form-group form-border">
						<label for="field-1" class="col-sm-12 control-label field-title">End publishing</label>
						
						<div class="col-sm-12">
							
                            <div class="controls input-append date form_datetime" data-link-field="dtp_input1">

							<?php

								$edate = (isset($promocodes->codeend)) ? $promocodes->codeend : '';
							?>



  						<input type="text" class="form-control form-height" placeholder="End publishing" maxlength="19" size="25" id="endpublish"  value="<?php echo ($this->input->post('codeend')) ? $this->input->post('codeend') : $edate; ?>"  name="codeend"  <?php if($updType == 'edit') { echo 'readonly'; } ?> >

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="codeend-target" class="tooltipicon" title="Click Here"></span>

						<span class="codeend-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_end-publishing-date');?>

                         

						</span>

						</span> -->

<!-- tooltip area finish -->

  						</div>
						</div>
					</div>
                    
					
					<div class="form-group form-border" style="padding-top:2%!important;">
					  <div class="col-sm-12 Sel_div" >
			    		<div class="grey-background">
							<label class="col-sm-4 control-label field-title" style="padding:0!important;">Only for existing students</label>
							  
								<div style="display:inline;">
									<input type="radio" checked="" value="0" <?php echo ($this->input->post('forexisting')) ? 'checked="checked"' : (isset($promocodes->forexisting) && $promocodes->forexisting == '0') ? 'checked="checked"' : '' ?> name="forexisting">
									<span>No</span>
								</div>
								<div style="display:inline;padding-left:2%;">
									<input type="radio" value="1" <?php echo ($this->input->post('forexisting')) ? 'checked="checked"' : (isset($promocodes->forexisting) && $promocodes->forexisting == '1') ? 'checked="checked"' : '' ?> name="forexisting">
									<span>Yes</span>
								</div>
							  

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="forexisting_stud-target" class="tooltipicon" title="Click Here"></span>

						<span class="forexisting_stud-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_for-existing-students');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->
							</div>
						</div>
                    </div>
					
					<div class="form-group form-border" style="padding-top:2%!important;">
					  <div class="col-sm-12 Sel_div" >
			    		<div class="grey-background">
							<label class="col-sm-4 control-label field-title" style="padding:0!important;">Publishing</label>
								<div style="display:inline;">
									<input type="radio" checked="" value="0" <?php echo ($this->input->post('published')) ? 'checked="checked"' : (isset($promocodes->published) && $promocodes->published == '0') ? 'checked="checked"' : ''?> name="published">
									<span>No</span>
								</div>
								<div style="display:inline;padding-left:2%;">
									<input type="radio" value="1" <?php echo ($this->input->post('published')) ? 'checked="checked"' : (isset($promocodes->published) &&$promocodes->published == '1') ? 'checked="checked"' : '' ?> name="published">
									<span>Yes</span>
								</div>

					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('promoCode_fld_publishining');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->

						</div>
					  </div>
                        
					</div>
                    
					<?php if(isset($promocodes->codelimit)) {?>
					<div class="form-group form-border has-success" style="padding-top:2%!important;">
					 <div class="col-sm-12 Sel_div" >
			    	  <div class="grey-background">
						<label class="col-sm-4 control-label field-title"><strong>Status:</strong></label>
						
						<div>
							--
						</div>
					</div>
                    </div>
                    </div>
					<div class="form-group form-border" style="padding-top:2%!important;">
					 <div class="col-sm-12 Sel_div" >
			    	  <div class="grey-background">
						<label class="col-sm-4 control-label field-title">Total used</label>
						
						<div>
							<?php echo $promocodes->codeused; ?> <input style="visibility: hidden; width: 2px;">
						</div>


					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="total_used-target" class="tooltipicon" title="Click Here"></span>

						<span class="total_used-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('promoCode_fld_total-used');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->

					</div>
					</div>
					</div>
                    
					<div class="form-group form-border" style="padding-top:2%!important;">
					  <div class="col-sm-12 Sel_div" >
			    	  <div class="grey-background">
						<label class="col-sm-4 control-label feild-title">Usage left</label>
						
						<div>
							<?php echo $promocodes->codelimit - $promocodes->codeused; ?><input style="visibility: hidden; width: 2px;">
						</div>
                    <!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="usage_left-target" class="tooltipicon" title="Click Here"></span>

						<span class="usage_left-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_usage-left');?>

                         

						</span>

						</span> -->

<!-- tooltip area finish -->
						
					</div>
                    </div>
                    </div>
					<?php }



  			    else{?>
					
                    
                    <div class="form-group form-border" style="padding-top:2%!important;">
                      <div class="col-sm-12 Sel_div" >
			    	  <div class="grey-background">
							<label class="col-sm-4 control-label field-title">Usage left</label>
							<div>-<input style="visibility: hidden; width: 2px;"> </div>
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="usage_left-target" class="tooltipicon" title="Click Here"></span>

						<span class="usage_left-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_usage-left');?>

                         

						</span>

						</span>-->
					<!-- tooltip area finish -->
					</div>
					</div>
					</div>

              			<?php }?>

					<div class="form-group form-border" style="padding-top:2%!important;">
						<div class="col-sm-12 Sel_div" >
			    	      <div class="grey-background">
							<label class="col-sm-4 control-label field-title">Time left</label>
								<div>-<input style="visibility: hidden; width: 2px;"></div>



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="time_left-target" class="tooltipicon" title="Click Here"></span>

						<span class="time_left-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('promoCode_fld_time-left');?>

                         

						</span>

						</span> -->

					<!-- tooltip area finish -->
						
					</div>
                    </div>
                    </div>

					
					
						<div class="col-sm-5" style="padding-top: 2.5%!important;">
						
			<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'") ); ?>





            <a href='<?php echo base_url(); ?>/admin/promocodes/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>

						</div>
					
				</form>
				
			</div>
		
		</div>
	  </div>
	</div>

  </div>
</div>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#codestart" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#endpublish" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
  </script>




<?php if ($updType == 'edit'): ?>



<?php //echo form_hidden('promoid',set_value('promoid', $promoid)) ?>



	<?php echo form_hidden('id',$promocodes->id) ?>



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