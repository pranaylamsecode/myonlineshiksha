<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/subplans/create', $attributes) : form_open_multipart(base_url().'admin/subplans/edit/'.$id, $attributes);
?>
<div id="toolbar-box">
	<div class="m top_main_content">
		<div id="toolbar" class="toolbar-list">
			<div class="clr"></div>
		</div>
		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo ($updType == 'create') ? 'Add subscription plan' : 'Edit subscription plan'?></h2></div>
	</div>
</div>

<div>
    <?php 
    if($updType != 'edit')
    {
		$id = '';
	}
	?>
</div>

<div class="tab-content">
<div class="field_container">	
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel primary-border panel-primary" data-collapsed="0">		
			<div class="panel-heading">
				<!-- <div class="panel-title" style="padding:0;font-size:11px;color: #686c70;font-family: arial">
                <?php 
                if($updType == 'create')
                {
                	?>
                    Add subscription plan
					<?php
				}
				else
				{
					?>
      				Edit subscription plan
    				<?php
    			}
    			?>
				</div>
				 -->
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
						
							<label class='col-sm-12 field-title control-label' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						<div class="col-sm-12">
							
                            <input id="name" class="form-control form-height" placeholder="Name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($subplans->name)) ? $subplans->name : ''); ?>"  />







					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>

						<span class="name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('plan_fld_name');?>

                        

						</span>
						</span> -->
                        <span class="error">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_error('name'); ?></span>

<!-- tooltip area finish -->
						</div>
					</div>
					
					<div class="form-group form-border">						
						<label class='col-sm-12 field-title control-label' for="type">Term: <span class="required">*</span></label>
						<div class="col-sm-12">							
                            <select size="1" name="term" id="term" class="form-control form-height">
								<!-- <option value="">- select -</option>
								<option value="1" <?php echo ($this->input->post('term') == '1' ?  'selected="selected"' :( (isset($subplans->term)) == '1') ? 'selected="selected"' : '');?> >1</option>
	                            <option value="2" <?php echo ($this->input->post('term') == '2' ?  'selected="selected"' :( (isset($subplans->term)) == '2') ? 'selected="selected"' : '');?> >2</option>
	                            <option value="3" <?php echo ($this->input->post('term') == '3' ?  'selected="selected"' :( (isset($subplans->term)) == '3') ? 'selected="selected"' : '');?> >3</option>
	                            <option value="4" <?php echo ($this->input->post('term') == '4' ?  'selected="selected"' :( (isset($subplans->term)) == '4') ? 'selected="selected"' : '');?> >4</option>
	                            <option value="5" <?php echo ($this->input->post('term') == '5' ?  'selected="selected"' :( (isset($subplans->term)) == '5') ? 'selected="selected"' : '');?> >5</option>
	                            <option value="6" <?php echo ($this->input->post('term') == '6' ?  'selected="selected"' :( (isset($subplans->term)) == '6') ? 'selected="selected"' : '');?> >6</option>
	                            <option value="7" <?php echo ($this->input->post('term') == '7' ?  'selected="selected"' :( (isset($subplans->term)) == '7') ? 'selected="selected"' : '');?> >7</option>
	                            <option value="8" <?php echo ($this->input->post('term') == '8' ?  'selected="selected"' :( (isset($subplans->term)) == '8') ? 'selected="selected"' : '');?> >8</option>
	                            <option value="9" <?php echo ($this->input->post('term') == '9' ?  'selected="selected"' :( (isset($subplans->term)) == '9') ? 'selected="selected"' : '');?> >9</option>
	                            <option value="10" <?php echo ($this->input->post('term') == '10' ?  'selected="selected"' :( (isset($subplans->term)) == '10') ? 'selected="selected"' : '');?> >10</option> -->
							
							<option value="">- select -</option>
								<option value="1" <?php echo $subplans->term == '1' ? 'selected="selected"' : '';?> >1</option>
	                            <option value="2" <?php echo $subplans->term == '2' ? 'selected="selected"' : '';?> >2</option>
	                            <option value="3" <?php echo $subplans->term == '3' ? 'selected="selected"' : '';?> >3</option>
	                            <option value="4" <?php echo $subplans->term == '4' ? 'selected="selected"' : '';?> >4</option>
	                            <option value="5" <?php echo $subplans->term == '5' ? 'selected="selected"' : '';?> >5</option>
	                            <option value="6" <?php echo $subplans->term == '6' ? 'selected="selected"' : '';?> >6</option>
	                            <option value="7" <?php echo $subplans->term == '7' ? 'selected="selected"' : '';?> >7</option>
	                            <option value="8" <?php echo $subplans->term == '8' ? 'selected="selected"' : '';?> >8</option>
	                            <option value="9" <?php echo $subplans->term == '9' ? 'selected="selected"' : '';?> >9</option>
	                            <option value="10" <?php echo $subplans->term == '10' ? 'selected="selected"' : '';?> >10</option>


							</select>
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="term-target" class="tooltipicon"></span>

						<span class="term-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('plan_fld_term');?>

                        
						</span>
						</span> -->
						<span class="error">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_error('term'); ?></span>

					<!-- tooltip area finish -->
						</div>
					</div>
                    
					<!--Period-->
					<div class="form-group form-border">
						
						<label class='col-sm-12 field-title control-label' for="type">Period: <span class="required">*</span></label>
						<div class="col-sm-12">
							
                            <select size="1" name="period" id="period" class="form-control form-height">
								<option value="">- select -</option>								
								<option value="Month(s)" <?php echo $subplans->period == 'Month(s)' ? 'selected="selected"' : '';?> >Month(s)</option>
	                            <option value="Year(s)" <?php echo $subplans->period == 'Year(s)' ? 'selected="selected"' : '';?> >Year(s)</option>
                            </select>
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="period-target" class="tooltipicon"></span>

						<span class="period-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('plan_fld_period');?>
                        
						</span>
						</span> -->

                        <span class="error">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo form_error('period'); ?></span>

				<!-- tooltip area finish -->
						</div>
					</div>
                    
					<div class="form-group" style="padding-top:1.5%!important;">
						<div class="col-sm-12">
						  <div class="grey-background" style="display: -webkit-box;">
							<div class="checkbox">
								<input id="published" type="checkbox" name="published" value='1' <?php echo preset_checkbox('published', '1', (isset($subplans->published)) ? $subplans->published : ''  )?> /><label class='labelforminline' for='published'> Publish </label>



					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('plan_fld_active');?>

                        
						</span>

						</span> -->

					<!-- tooltip area finish -->
							</div>
							
							</div>
						</div>
					</div>
                   
					<div class="form-group form-border">
						<div class="col-sm-12">
							
                          
			<a>



		    <?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>



			</a>






			<a href='<?php echo base_url(); ?>admin/subplans/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>


						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>

</div>
</div>
</div>
</div>







<?php if ($updType == 'edit'): ?>



	<?php echo form_hidden('id',$subplans->id) ?>



<?php endif ?>







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