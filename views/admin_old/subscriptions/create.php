<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php

  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
  //$this->session->flashdata('message');
?>
<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/subscriptions/createPage', $attributes) : form_open_multipart(base_url().'admin/subscriptions/editPage/'.$id, $attributes);
?>

<div id="toolbar-box">
	<div class="m top_main_content">
		<div id="toolbar" class="toolbar-list">
			
			
			<div class="clr"></div>
		</div>

		<div class="col-sm-12 pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? 'Create Subscription' : 'Edit Subscription'?></h2></div>
	</div>
</div>

<div>
    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>
</div>
<div class="field_container">
 <div class="row tab-content">

	<!--Main fieldset-->
    
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php if($updType != 'edit'){ ?>
      	Create Subscription
     <?php }else{ ?>
        Edit Subscription
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
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "User Name"; ?><span class="required">*</span></label>
						
						<div class="col-sm-12">
							
                            
                     <?php echo form_input('name',($this->input->post('name')) ? $this->input->post('name'):(isset($page[0]['name']) ? $page[0]['name']:''),'class="form-control form-height"'); ?>
					<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="name-target" class="tooltipicon"></span>
						<span class="name-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('subs_fld_name');?>
                         
						</span>
						</span> -->
					<!-- tooltip area finish -->
					
                     <span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>
                    
                    <div class="form-group">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Email"; ?><span class="required">*</span></label>
						
						<div class="col-sm-12">
							
                            
                     <?php echo form_input('email',($this->input->post('email')) ? $this->input->post('email'):(isset($page[0]['email']) ? $page[0]['email']:''),'class="form-control form-height"'); ?>
					<!-- tooltip area -->
						<!-- <span class="tooltipcontainer">
						<span type="text" id="email-target" class="tooltipicon"></span>
						<span class="email-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						
						<?php echo lang('subs_fld_email');?>
                         
						</span>
						</span> -->
					<!-- tooltip area finish -->
					
                     <span class="error"><?php echo form_error('email'); ?></span>
						</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-5">
							
                            <a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?></a>
				
				<a href='<?php echo base_url(); ?>admin/newsletter-subscriptions<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>
						</div>
					</div>
				</form>
				
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
	//get_uploaded_area();
   	$('#message').redactor();
   	$('#description').redactor();
 }
 );
</script>
</div>

<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$id) ?>
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