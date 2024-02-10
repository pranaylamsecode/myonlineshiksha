<link href="<?php echo base_url(); ?>public/css/my_frontend.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/classic/css/bootstrap.css" media="screen" />
<style>
input[type="radio"], input[type="checkbox"] {
	margin: 0px 10px 0 0 !important;
	margin-top: 1px \9;
	line-height: normal;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	margin: 0 10px;
	font-size:12px !important;	
}
td, th {
	padding: 10px !important;
}
.btn-success {
  margin-left: 3%;
}
.form-group {
  width:100%!important;
  display:inline-block !important;
}
.tform textarea{
  float:left!important;
  width: 74%!important;
  margin-left: 0px!important;
  margin-right: 0px!important;
}
input#published {
  position: relative;
  top: 3px;
}
input[type="text"]{
  height:40px!important;
}
td, th {
	padding: 10px !important;
}
select {
  height: 40px!important;
}
table {
	border-collapse: inherit;
	border:none !important;
}
.page-container .main-content{
  height: 507px !important;
}
label.col-sm-3 {
  font-size: 12px!important;
  width: 26%!important;
  float: left!important;
  padding-top: 2%;
  padding-left: 0;
  color: #000;
  font-weight: bold;
}
.col-sm-5 {
  padding-right: 0px;
  padding-left:0px;
}
.form-control {
  float: left!important;
  width: 74%!important;
  margin-left:0px!important;
  margin-right:0px!important;
}
legend {
    color: #c42140;
    text-transform: uppercase;
    font-size: 21px !important;
    text-align: center;
    font-weight: bold;
    border-bottom: none;
    padding: 17px 30px 0 30px !important;
}
</style>
<!--<base href="<?php echo $this->config->item('base_url') ?>/public/" />-->
<script src="<?php echo base_url(); ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>



<?php

//print_r($category);

$attributes = array('class' => 'tform', 'id' => 'categoryform');

echo form_open_multipart(base_url().'/programs/savecategory', $attributes);

?>

<div class="page-container">
<div style="background-color:#f1f1f1; height:73px;">
      <legend style="color:#c42140; text-transform:uppercase; font-size:16px; font-weight:bold; padding: 10px 30px 0 30px;">Create Category </legend>
		<?php //echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?>
	</div>
  <div class="main-content">
    <!-- <div style="background-color:#f1f1f1; height:50px;">
      <legend style="color:#c42140; text-transform:uppercase; font-size:16px; font-weight:bold; padding: 10px 30px 0 30px;">Create Category </legend>
		<?php //echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?>
	</div> -->

		<div class="panel panel-primary">
		

			
			<div class="panel-body" style="overflow: hidden;">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group">
						
						<label class="col-sm-3" for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						<div class="col-sm-5" style="padding-left:0px;">
							
                            <input id="name" class="form-control"  placeholder="Name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($category->name)) ? $category->name : ''); ?>"  />
                            <input class="form-control"  type="hidden" name="nameimg" id="nameimg" value="" />

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>
						<span class="name-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_category-name');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
<span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>
				 <div class="form-group">
						
						<label class='col-sm-3' for="description"><?php echo "Description*";?></label>
						<div class="col-sm-5" style="padding-left:0px;">							
                            <textarea name="description" id="description" rows="6" placeholder="Description"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($category->description) && $category->description!='') ? $category->description : ''); ?></textarea>

      <?php //$this->ckeditor->editor("description",(isset($category->description)) ? $category->description : '');?>

	<?php //echo form_error('description'); ?>
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="description-target" class="tooltipicon" title="Click Here"></span>
						<span class="description-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_category-description');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
                             
                    <div class="form-group">
						
						<label class='col-sm-3' for='category_id'>Parent Category</label>
						<div class="col-sm-5"  style="padding-left:0px;">
							<?php $categories1 = $this->programs_model->getcategories(); ?>
                            <select name='category_id' id='category_id' class="form-control">
                            	<option value=''>select</option>
                            	<?php foreach ($categories1 as $category1): ?>
		<option value="<?php echo $category1->id;?>"><?php echo $category1->name;?></option>

			<?php endforeach ?>
			</select>
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="category_id-target" class="tooltipicon" title="Click Here"></span>
						<span class="category_id-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_parent_category');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
    <span class="error"><?php echo form_error('category_id'); ?></span>
						</div>
					</div>
				
					 <div class="form-group" style="margin-bottom:0px!important;">
						
						
						<div class="col-sm-5">
							
							 <?php //echo ($this->post->input('imagename')) ? $this->post->input('imagename') : ((isset($category->image)) ? $category->image : '')

              $image_name = (isset($category->image)) ? $category->image : '';
?>
                      <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $image_name ?>" name="imagename" id="imagename">

                   
                   <div id="localimage_i">

                      

                      <img src="<?php echo base_url();?>public/uploads/pcategories/img/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg'?>" width="150" id="imgname">
                      <input type="hidden" id="cropimage" name="cropimage" value="" >
                      <a href="<?php echo base_url(); ?>programs/cropcategoryimg/"  class="fancybox fancybox.iframe btn btn-success" onclick="setvalues()">Upload Image</a>
                      

                   </div>

	<?php //echo form_error('image'); ?>

	<?php  echo ( isset($upload_error)) ?  $upload_error  : ""; ?>
 <div class="qq-upload-button" style=" margin: 20px 0 0 0px;">
                <!--Choose file position: relative; overflow: hidden; direction: ltr; -->

                <input type="file" name="file_i" id="file_i" style="display: none;">
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="image-target" class="tooltipicon" title="Click Here"></span>
						<span class="image-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_category_image');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
  </div>
					</div>
                    </div>
					
					<div class="form-group">
                    
						<div class="col-sm-5">
                        
							<div class="checkbox" style="padding-left:6px!important;">
                           
								
                                <input id="published" type="checkbox" name="published" value='1' checked/>

<label style="font-size:12px;" class='labelforminline' for='active'> <?=lang('web_is_active')?> </label>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>
						<span class="published-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('course_fld_category-active');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
	<?php //echo form_error('published'); ?>
							</div>
							
						</div>
					</div>
				<br />
					<div class="form-group" style="width: 100%;">
						<div class="col-sm-12" style="margin: 0 auto;text-align: center;width: 100%;">
							
                            <a>
			<?php //echo form_submit( 'submit', 'Save',  "id='submit' class='btn btn-default'"); ?>
         					</a>
                          <input type="button" name="save" id="save" value="Save" onclick="create_category();" class="btn btn-info">  
                           <!--  <a href='<?php echo base_url(); ?>admin/pcategories/<?php echo $parent_id?>' class='btn btn-red'>
                            <span class="icon-32-cancel"> </span>Cancel </a> -->
                            <div id="empty_msg" style="color:red;"></div>
						</div>
					</div>
					
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>

<?php echo form_close(); ?>


<script type="text/javascript">
function create_category()
{	

    var description1 = $("#description").val(); 
	var name1 = $("#name").val();

	if(name1 == "" || description1 == ""){
	$("#empty_msg").text("Name and Description are mandatory fields.");
	 return false;
	} else {

    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url('programs/savecategory'); ?>",
        data: jQuery("#categoryform").serialize(),
       beforeSend : function(data){ jQuery("body").html('<img style="position: absolute;top: 39%;left: 42%;" src="<?php echo base_url(); ?>public/images/loading.gif" />'); }, 
        success: function(msg)
        {    
            //alert(msg); 

           $("#category_id",parent.document).append('<option value='+msg+' selected>-'+name1+'</option>');
           
            $("#setname",parent.document).val('');
			$("#setdescription",parent.document).val('');
			$("#setcategory",parent.document).val('');
			
			$("#setactivate",parent.document).val('');			
			$("#setsrc",parent.document).val('');
			$("#setimg",parent.document).val('');
			
			$("setcategory select",parent.document).val('');

           //parent.jQuery.fancybox.close();
            $("#cboxClose",parent.document).click();
            $j.colorbox.close();

        }

    });
  }
 }

</script>

<script type="text/javascript">
$(document).ready(function()
{

	var name = $("#setname",parent.document).val();
	var description = $("#setdescription",parent.document).val();
	var category_id = $("#setcategory",parent.document).val();	
	var setsrc = $("#setsrc",parent.document).val();
	var setimg = $("#setimg",parent.document).val();

	$("#name").val(name);
	$("#description").val(description);
	$("#category_id").val(category_id);
	if(setsrc)
	{
	$("#imgname").attr('src', setsrc);
    }
	$("#nameimg").val(setimg);

	$("#category_id select").val(category_id);


});
	
	function setvalues()
	{	
		var name1 = $("#name").val();
		var description1 = $("#description").val();
		var category_id1 = $("#category_id").val();
		

		$("#setname",parent.document).val(name1);
		$("#setdescription",parent.document).val(description1);
		$("#setcategory",parent.document).val(category_id1);

		$("#setcategory select",parent.document).val(category_id1);
		
		
	}
</script>