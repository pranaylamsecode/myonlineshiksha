<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style type="text/css">
.col-sm-9 {
  width: 63%;
}

</style>
<script type="text/javascript">
	jQuery(document).ready(
		function()
		{
			// jQuery('#description').redactor({
			//         focus: true,
			//         imageUpload: window.location.origin+'/admin/pagecreator/getImage',
	                
			// });
			jQuery('#message').redactor({
			        focus: true,
			        imageUpload: window.location.origin+'/admin/pagecreator/getImage',
	                
			});
			
		}
	);
</script>

<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
  //$this->session->flashdata('message');
?>
<div class="main-container">
<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/pagecreator/createPage', $attributes) : form_open_multipart(base_url().'admin/pagecreator/editPage/'.$id, $attributes);
?>

<div id="toolbar-box">
	<div class="m top_main_content">
		<div id="toolbar" class="toolbar-list">			
			<div class="clr"></div>
		</div>
		<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo ($updType == 'create') ? 'Create page' : 'Edit "'.$page[0]['heading'].'" Page'?></h2></div>
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
				<div class="panel-title" style="padding-left:0px;padding-top:0;">
					

     				<!-- <?php
     					if(@$id == 12)
     					{
     				?>
				<p>These are the default "Terms & Conditions" but you must review and edit the text according to your business needs.</p>
				<?php
					}
					else
					{
				?>

				<p>This is where you can manage the content of your page. Your custom created page will be shown under More Information in the menu</p>
               <?php
               		}
               ?> -->
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
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Title"; ?><span class="required">*</span></label>
						
						<div class="col-sm-12">
							
                            
                     <?php echo form_input('heading',($this->input->post('heading')) ? $this->input->post('heading'):(isset($page[0]['heading']) ? $page[0]['heading']:''),'class="form-control form-height"'); ?>
					<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="heading-target" class="tooltipicon"></span>

						<span class="heading-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('page_fld_title');?>

                       

						</span>

						</span>-->
					<!-- tooltip area finish -->
					
			
                    <span class="error"><?php echo form_error('heading'); ?></span>
						</div>
					</div>
                    
					<div class="form-group form-border" style="padding-top:0!important;">
						
						<label class='col-sm-12 field-title control-label' for="name"><?php echo "Description"; ?><span class="required">*</span></label>

					<div class="col-sm-12">
					
                    <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''));?>
                    <textarea name="description"  id="description" class="form-control" rows="6"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''); ?></textarea>
                    <input name="image" type="file" id="upload" class="hidden" onchange="">
                    <!-- tooltip area -->
						<!-- <span class="tooltipcontainer">

						<span type="text" id="desc-target" class="tooltipicon"></span>

						<span class="desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('page_fld_description');?>

						</span>

						</span> -->

					<!-- tooltip area finish -->
					
                     <span class="error"><?php echo form_error('description'); ?></span>
						</div>
					</div>
                    
					<!--<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label">Message
<!-- tooltip area -->

						<!--<span class="tooltipcontainer">

						<span type="text" id="mesg-target" class="tooltipicon"></span>

						<span class="mesg-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<!--<?php echo lang('page_fld_message');?>-->

                         <!--/tip containt-->

						<!--</span>

						</span>

<!-- tooltip area finish --><!--</label>
						
						<div class="col-sm-9">
                            <textarea  name="message" id="message" class="form-control" rows="6"><?php echo ($this->input->post('message')) ? $this->input->post('message') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''); ?></textarea>
						</div>
					</div>-->
                    
                    
					<div class="form-group form-border" style="padding-top:0!important;">						
						<label class='col-sm-12 control-label field-title' for="name">Show this page in the “More” menu in the frontend<span class="required">*</span></label>
						<div class="col-sm-12">	                      
						<select name="show_in_menu" id="show_in_menu" class="form-control form-height" >
							<option value="show" <?php echo ($this->input->post('show_in_menu') == 'show' ?  'selected="selected"' :( @$page[0]['show_in_menu'] == 'show' )? 'selected="selected"' : '');?> >Show</option>
							<option value="hide" <?php echo ($this->input->post('show_in_menu') == 'hide' ?  'selected="selected"' :( @$page[0]['show_in_menu'] == 'hide' )? 'selected="selected"' : '');?> >Hide</option>
						</select>
						<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="menu-target" class="tooltipicon"></span>

						<span class="menu-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('page_fld_showmenu');?>

                        
						</span>

						</span> -->

						<!-- tooltip area finish -->
						</div>
					</div>
                    
                <!--new code start -->
<!--remove comment form here -->
               <div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "SEO title"; ?>
                        <p>Enter the course title as it will be shown in internet browsers.</p>
                        </label>
						
						<div class="col-sm-12">
							
                            
                     <?php //echo form_input('metaTitle',($this->input->post('metaTitle')) ? $this->input->post('metaTitle'):(isset($page[0]['meta_title']) ? $page[0]['meta_title']:''),'class="form-control form-height"', 'placeholder="Maximum 60 characters."'); ?>
                     <input type="text" name="metaTitle" class="form-control form-height" placeholder="Maximum 60 characters." value="<?php echo ($this->input->post('metaTitle')) ? $this->input->post('metaTitle'):(isset($page[0]['meta_title']) ? $page[0]['meta_title']:''); ?>" >

						<!-- <span class="tooltipcontainer">

						<span type="text" id="metatitle-target" class="tooltipicon"></span>

						<span class="metatitle-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('page_fld_metatitle');?>

                       

						</span>

						</span> -->


					
			
                    <span class="error"><?php echo form_error('metaTitle'); ?></span>
						</div>
						
					</div>
					
				<div class="form-group form-border" style="padding-top:0!important;">
						<label for="field-ta" class="col-sm-12 field-title control-label">SEO description
							<p>Enter the course description that will appear underneath the SEO title.</p>
						</label>
						
						<div class="col-sm-12">
                            <textarea placeholder="Maximum 320 characters." name="meta_descript" id="meta_descript" class="form-control select-box-border" rows="4"><?php echo ($this->input->post('meta_descript')) ? $this->input->post('meta_descript') : ((isset($page[0]['meta_desc'])) ? $page[0]['meta_desc'] : ''); ?></textarea>
                            

						<!-- <span class="tooltipcontainer">

						<span type="text" id="mdesc-target" class="tooltipicon"></span>

						<span class="mdesc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('page_fld_desc');?>

                        

						</span>

						</span> -->


						</div>

						
                     
					</div>
					
					<div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "SEO keyword"; ?><span class="required"></span>
                        	<p>To improve your site’s visibility in searches, enter keywords separated by commas.</p>
                        </label>
						
						<div class="col-sm-12">
							
                            
                     <?php echo form_input('metaKword',($this->input->post('metaKword')) ? $this->input->post('metaKword'):(isset($page[0]['meta_keyword']) ? $page[0]['meta_keyword']:''),'class="form-control form-height"'); ?>

						<!-- <span class="tooltipcontainer">

						<span type="text" id="keyword-target" class="tooltipicon"></span>

						<span class="keyword-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>


						<?php echo lang('page_fld_keyword');?>


						</span>

						</span> -->


					
                    <span class="error"><?php echo form_error('metaKeyword'); ?></span>
						</div>

						
            
					</div>
					
                <!--new code end -->

					<div class="form-group">
						<div class="col-sm-5">    
                        <a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Update", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?></a>
						<a href='<?php echo base_url(); ?>admin/pagecreator<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>
						</div>
					</div>
				</form>				
			</div>		
		</div>	
	</div>
	</div>
	</div>
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
<script src='<?php echo base_url(); ?>public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  		selector: '#description',
 		 height: 180,
 		// min_width: 400,
 		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste" ],
		toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
		image_title: true,
		automatic_uploads: true,
		images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
		file_picker_types: 'image',
		 image_advtab: true, 
		file_picker_callback: function(callback, value, meta) {
		      if (meta.filetype == 'image') {
		        $('#upload').trigger('click');
		        $('#upload').on('change', function() {
		          var file = this.files[0];
		          var reader = new FileReader();
		          reader.onload = function(e) {
		            callback(e.target.result, {
		              alt: ''
		            });
		          };
		          reader.readAsDataURL(file);
		        });
		      }
		    },

 		});
    });
  </script>