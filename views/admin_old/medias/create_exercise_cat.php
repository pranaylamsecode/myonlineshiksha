<link href="<?php echo base_url(); ?>public/css/my_frontend.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/classic/css/bootstrap.css" media="screen" />
<style>
input[type="radio"], input[type="checkbox"] {
	margin: 0px 10px 0 0 !important;
	margin-top: 1px \9;
	line-height: normal;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	margin: 0 10px !important;
	font-size:12px !important;	
}
td, th {
	padding: 10px !important;
}

.col-sm-3 {
	padding-right:5px;
}
.col-sm-5 {
	display:inline-block !important;
}
label {
	display: inline-block !important;
	width:133px !important;
}
textarea {
	/*width:100% !important; */
	width:195px !important; 
}
.form-control {
	width:195px !important;
	font-size:12px;
}
.form-group {
	/*padding:0 0 30px 0 !important;*/
	display:inline-block !important;
}
td, th {
	padding: 10px !important;
}
table {
	border-collapse: inherit;
	border:none !important;
}
.page-container .main-content{
	  height: 507px !important;
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

echo form_open_multipart(base_url().'/medias/saveexecategory', $attributes);

?>

<div class="page-container" id="exercise_cat">
<div style="background-color:#f1f1f1; height:73px;">
      <legend style="color:#c42140; text-transform:uppercase; font-size:16px; font-weight:bold; padding: 10px 30px 0 30px;">Create Category </legend>
	</div>
  <div class="main-content">
    

		<div class="panel panel-primary">
		

			
			<div class="panel-body" style="overflow: hidden;">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					<div class="form-group">
						
						<label class="col-sm-3" for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						<div class="col-sm-5" style="padding-left:0px;">
							
                            <input id="name" class="form-control" placeholder="Name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($category->name)) ? $category->name : ''); ?>"  />
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
					<div class="form-group" style="width: 100%;">
						<div class="col-sm-offset-3 col-sm-5" style="margin: 0 auto;text-align: center;width: 100%;">
							
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

   // var description1 = $("#description").val(); 
	var name1 = $("#name").val();
	// alert(name1);
	$("#med_cat",parent.document).val(name1);
	//return false;
	if(name1){
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url('medias/saveexecategory'); ?>",
        data: jQuery("#categoryform").serialize(),
       beforeSend : function(data){ jQuery("body").html('<img style="position: absolute;top: 39%;left: 42%;" src="<?php echo base_url(); ?>public/images/loading.gif" />'); }, 
        success: function(msg)
        {    
          // alert(msg); 
    //        $("#category_id",parent.document).append('<option value='+msg+' selected>- '+name1+'</option>');
	           	            
				// $("#med_cat",parent.document).val('');
					
				// $("med_cat select",parent.document).val('');
           window.location.href ='<?php echo base_url(); ?>medias/createexercisefile/';
         }

   	 });
   }
    //setvalues();
}

</script>

<script>

//   function setvalues(){
    
//     var name = $("#name").val();
//     alert(name);
//      $("#med_cat").append("<option value='"+name+"' selected='selected'>"+name+"</option>");
//     $("#med_cat",parent.document).val(name);
//     $("med_cat select",parent.document).val(name);
    

// }
</script>

<script type="text/javascript">
$(document).ready(function()
{

  var catname = $("#med_cat",parent.document).val();
  
  $("#category_id",parent.document).append('<option value='+catname+' selected>- '+catname+'</option>');
  $("#category_id").val(catname);
  $("#category_id select").val(catname);

});
</script>

