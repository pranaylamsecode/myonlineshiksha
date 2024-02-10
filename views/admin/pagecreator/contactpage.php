<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php



  $u_data=$this->session->userdata('loggedin');



  $maccessarr=$this->session->userdata('maccessarr');



  //$this->session->flashdata('message');



?>








<div class="main-container">


<?php



$attributes = array('class' => 'tform', 'id' => '');



echo form_open_multipart(base_url().'admin/pagecreator/editContactPage', $attributes);



?>

<style type="text/css">
	
	.tooltipcontainer {
  position: absolute;
  top: 2px;
  right: -10px;
}
</style>


<div id="toolbar-box">
	<div class="m top_main_content">
		<div id="toolbar" class="toolbar-list">
			<div class="clr"></div>
		</div>
		<div class="col-sm-12 pagetitle icon-48-generic"><h2><?php echo 'Edit "'.$page[0]['heading'].'" Page';?></h2></div>
	</div>
</div>

<div>
	<h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>
</div>



<?php



if($page[0]['settings'])



{



  $settingarr=json_decode($page[0]['settings']);



  $address=$settingarr->address;



  $phone=$settingarr->phone;



  $email=$settingarr->email;



  $weburl=$settingarr->weburl;



  $mapcode=$settingarr->mapcode;



}



else



{



    $address="";



    $phone="";



    $email="";



    $weburl="";



    $mapcode="";



}



?>

<div class="field_container">
<div class="row tab-content">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
	<div class="panel panel-primary primary-border" data-collapsed="0">
		<div class="panel-heading">
				<!--<div class="panel-title">
					Edit Contact Page
				</div>-->
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body form-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group form-border">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Title"; ?><span class="required">*</span></label>
						
						<div class="col-sm-12">
							
                            
                            <?php echo form_input('heading',$page[0]['heading'],'class="form-control form-height"'); ?>



                      <?php echo form_hidden('pageid',$page[0]['page_id']); ?>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="contheading-target" class="tooltipicon" title="Click Here"></span>

						<span class="contheading-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('page_fld_title');?>

                        

						</span>

						</span> -->

<!-- tooltip area finish -->

                     <span class="error"><?php echo form_error('heading'); ?></span>
						</div>
					</div>
                    
					<div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "Description"; ?><span class="required"></span></label>
						
						<div class="col-sm-12">
							
                            <!-- tooltip area -->

<!--						<span class="tooltipcontainer">

						<span type="text" id="desc-target" class="tooltipicon" title="Click Here"></span>

						<span class="desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>-->

						<!--tip containt-->

						<?php //echo lang('page_fld_description','class="form-control"');?>

                         <!--/tip containt-->

<!--						</span>

						</span>-->

<!-- tooltip area finish -->

<?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''));?>



                     <textarea name="description" id="description" class="form-control select-box-border" rows="6" ><?php echo ($this->input->post('description')) ? $this->input->post('description') : ($this->input->post('description')) ? $this->input->post('description') : ((isset($page[0]['content'])) ? $page[0]['content'] : ''); ?></textarea>
                     <input name="image" type="file" id="upload" class="hidden" onchange="">


                     <span class="error"><?php echo form_error('description'); ?></span>

						</div>
					</div>
                    
					<div class="form-group form-border">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Address"; ?><span class="required"></span></label>
						
						<div class="col-sm-12">
							
                            
                            <?php echo form_textarea('address',$address,'class="form-control form-height"'); ?>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="address-target" class="tooltipicon" title="Click Here"></span>

						<span class="address-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('contactpage_fld_address');?>

						</span>

						</span>
 -->
<!-- tooltip area finish -->

                     <span class="error"><?php echo form_error('address'); ?></span>
						</div>
					</div>
                   
					<div class="form-group form-border">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Phone"; ?><span class="required"></span></label>
						
						<div class="col-sm-12">
							
                            <?php echo form_input('phone',$phone,'class="form-control form-height"'); ?>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="phone-target" class="tooltipicon" title="Click Here"></span>

						<span class="phone-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('contactpage_fld_phone');?>

						</span>

						</span> -->

<!-- tooltip area finish -->

                     <span class="error"><?php echo form_error('phone'); ?></span>
						</div>
					</div>
                   
					<div class="form-group form-border">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "Email"; ?><span class="required">*</span>
                        <p>All Enquiries from the Contact Us Forms will come to this email id</p>
                        </label>
						
						<div class="col-sm-12">
							
                            <?php echo form_input('email',$email,'class="form-control form-height"'); ?>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="email-target" class="tooltipicon" title="Click Here"></span>

						<span class="email-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('contactpage_fld_email');?>

						</span>

						</span> -->


<!-- tooltip area finish -->

                     <span class="error"><?php echo form_error('email'); ?></span>
						</div>

						
						
					
					</div>
                    
					<div class="form-group form-border">
						
                        <label class='col-sm-12 control-label field-title' for="name"><?php echo "WebSite"; ?><span class="required"></span></label>
						
						<div class="col-sm-12">
							
                            <?php echo form_input('weburl',$weburl,'class="form-control form-height"'); ?>

<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="web-target" class="tooltipicon" title="Click Here"></span>

						<span class="web-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('contactpage_fld_web');?>

						</span>

						</span> -->

<!-- tooltip area finish -->

                     <span class="error"><?php echo form_error('weburl'); ?></span>
						</div>
					</div>
                   
					
					<div class="form-group form-border">
						
                        <label class='col-sm-12 field-title control-label' for="name"><?php echo "Google Map Code"; ?><span class="required"></span></label>
						
						<div class="col-sm-12">
							
                             <?php echo form_textarea('mapcode',$mapcode,'class="form-control select-box-border"'); ?>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="map_code-target" class="tooltipicon" title="Click Here"></span>

						<span class="map_code-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('contactpage_fld_map-code');?>

						</span>

						</span> -->

<!-- tooltip area finish -->

                     <span class="error"><?php echo form_error('mapcode'); ?></span>
						</div>


						<div class="col-sm-12">
						<p>In case you want to have your student visit your physical academy this map will help them navigate and locate you.To add Code:
						<ol>
						<li>Open Google Maps.</li>
						<li>Make sure the map or street view image you'd like to embed show up on the map.</li>
						<li>In the Top left corner, Click the main menu.</li>
						<li>Click "share or Embed Map".</li>
						<li>At the top of the box that appears, choose the "Embed Map" Tab.</li>
						<li>Choose the size you want, then copy the HTML and Paste the code here in the box.</li>

						</ol>
						</p>
						</div>
					</div>
                    
					
					<div class="form-group form-border">
						<div class="col-sm-12">
							
                           
							<a><?php echo form_submit( 'submit','Save Changes ',"id='submit' class='btn btn-default btn-green'"); ?></a>						
							<a href='<?php echo base_url(); ?>admin/other-pages-design-setting' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel </a>

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



   	$('#description').redactor();



 }



 );



 </script>



	</fieldset>



</div>



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