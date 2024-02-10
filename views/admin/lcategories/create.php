<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style>
.img-grey-border img {
  max-width: 100%!important;
  width: 100% !important;
}
#message123 {
    position: fixed; 
    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}
</style>
<span id="message123"></span>
<div class="main-container">
<?php
// $attributes = array('class' => 'tform', 'id' => 'proform', 'autocomplete'=>"off", 'onsubmit' =>"return validation()");
?>
<div id="toolbar-box">
	<div class="m top_main_content">
		<div id="toolbar" class="toolbar-list">
		</div>
		<div class="col-sm-12 pagetitle icon-48-generic no-padding"><h2><?php echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2></div>
	</div>
</div>
<div class="field_container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12" style="">
	<div class="panel panel-primary primary-border" data-collapsed="0">
		<div class="panel-heading">
			<div class="main_subtitle">
				<p class="pmcat">Here you can create the categories for course of your online acedemy. If you want to create new categories then don't select any parent category. If you want to create sub-category then select any of the existing category as a parent category.</p>
			</div>
		</div>
		<div class="panel-body main-table form-body">
<!-- $attributes = array('class' => 'tform', 'id' => 'proform', 'autocomplete'=>"off", 'onsubmit' =>"return validation()"); -->
			<form class="form-horizontal form-groups-bordered" autocomplete="off" enctype="multipart/form-data" action="">
				<div class="form-group form-border">
					<label class="col-sm-12 control-label field-title" for="name"> Course Title  <span class="required">* </span><span id="err_name"></span>
					</label>
					<div class="col-sm-12">
                        <input id="name" class="form-control form-height" placeholder="Name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($category->name)) ? $category->name : ''); ?>"/>
						<span class="error"><?php echo form_error('name'); ?></span>
					</div>
				</div>
				<?php if($updType != 'create'){ ?>
				<div class="form-group form-border">
					<label class="col-sm-12 control-label field-title" for="name"> Slug  <span class="required">* </span><span id="err_slug"></span>
					</label>
					<div class="col-sm-12">
                        <input id="slug" class="form-control form-height" placeholder="Name" type="text" name="slug" maxlength="256" value="<?php echo set_value('slug', (isset($category->slug)) ? $category->slug : ''); ?>" onkeyup="return checkdup(<?php echo $category->id;?>,this.value)" onkeypress="return valid_escape(event)"/>
                        <span id="slugval"><?php if(!empty($category->slug)){echo $category->slug;}?> </span>
         				<span id="avail" style="padding-left: 50px"></span>
					</div>
				</div>
				<?php } ?>
				<div class="form-group form-border top-padding">
					<label class='col-sm-12 control-label field-title' for="description"> Description </label>
					<div class="col-sm-12">							
                        <textarea name="description" id="description" class="form-control select-box-border" rows="6" placeholder="Description"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($category->description) && $category->description!='') ? $category->description : ''); ?></textarea>
					</div>
				</div>       
                <div class="form-group form-border">
					<label class='col-sm-12 control-label field-title pcat_top_padding' for='category_id'>Parent Category
					</label>
					<div class="col-sm-12">
                        <select name='category_id' id='category_id' class="form-control form-height">
							<option value=''>- select</option>
							<?php $combocategories = $this->pcategories_model->get_formatted_combo();
							foreach ($combocategories as $combocat): ?>
					            <option value="<?php echo $combocat->id;?>" <?php echo ($this->input->post('category_id') == $combocat->id) ? "selected=selected" : (isset($category->parent_id)) && $category->parent_id == $combocat->id  ? "selected=selected" : $parent_id ?>><?php echo $combocat->name;?></option>
							<?php endforeach ?>
						</select>
    					<span class="error"><?php echo form_error('category_id'); ?></span>
					</div>
				</div>
                <div class="form-group form-border top-padding">
				    <label class='col-sm-12 control-label field-title' for="image"><?=lang( ($updType == 'edit')  ? "web_image_edit" : "web_image_create" )?>
				    </label>
				    <div class="col-sm-12">
				        <div id="localimage_i">
				            <div class="col-sm-8 no-padding">
				                <div class="img-grey-border edit_course_cat_img">
				                	<img src="<?php if ($updType == 'edit'){if(!empty($category->image)){echo base_url().'public/uploads/pcategories/img/'.$category->image; }else{echo base_url().'public/uploads/pcategories/img/no_images.jpg';} }else{echo base_url().'public/uploads/pcategories/img/no_images.jpg';}  ?>" width="150" id="preview_image">
				                	<?php if($updType == 'edit'){ ?><input type="hidden" id="old_image" value="<?php echo $category->image;?>"><?php } ?>
				                </div>
				                <div class="edit_course_cat_btn">
				                   <input style="display: none" type="file" name="imgname" id="imgname" accept="image/*">
				                   <button type="button" class="upimg_pop btn btn-success btn-border-blue" onclick="$('#imgname').click()">Upload Image</button>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>

				<div class="form-group form-border chkbox_top_padding">
					<label class="col-sm-12 control-label field-title" for="metatitle"> SEO Title 
						<p>(Enter the Category title as it will be shown in internet browsers. Below Text box instruction: Maximum 60 characters.)</p>
					</label>
					<div class="col-sm-12">
                        <input id="metatitle" class="form-control form-height" placeholder="SEO Title" type="text" name="metatitle" maxlength="256" value="<?php echo set_value('metatitle', (isset($category->metatitle)) ? $category->metatitle : ''); ?>"  />
					</div>
				</div>

				<div class="form-group form-border chkbox_top_padding">
					<label class="col-sm-12 control-label field-title" for="metadesc"> SEO Description 
						<p>(Enter the Category description that will appear underneath the SEO title. Below Text box instruction: Maximum 320 characters.)</p>
					</label>
					<div class="col-sm-12">
                        <textarea name="metadesc" id="metadesc" class="form-control select-box-border" rows="3" placeholder="SEO Description"><?php echo ($this->input->post('metadesc')) ? $this->input->post('metadesc') : ((isset($category->metadesc) && $category->metadesc!='') ? $category->metadesc : ''); ?></textarea>
					</div>
				</div>

				<div class="form-group form-border chkbox_top_padding">
					<label class="col-sm-12 control-label field-title" for="metakwd"> Category keywords (optional) 
						<p>(To improve your site’s visibility in searches, enter keywords separated by commas.)</p>
					</label>
					<div class="col-sm-12">
                        <textarea name="metakwd" id="metakwd" class="form-control select-box-border" rows="3" placeholder="Category keywords"><?php echo ($this->input->post('metakwd')) ? $this->input->post('metakwd') : ((isset($category->metakwd) && $category->metakwd!='') ? $category->metakwd : ''); ?></textarea>
					</div>
				</div>
				<div class="form-group form-border chkbox_top_padding">
					<div class="col-sm-12">
                    	<div class="grey-background">
							<div class="checkbox">
	                            <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($category->published)) && $category->published == '1' ? "checked" : $updType == 'create' ? 'checked': ''; ?> />
								<label class='labelforminline dark_label' for='active'> Publish </label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group form-border chkbox_top_padding">
					<div class="col-sm-5">
                        <button type="button" class='btn btn-success btn-lg' id="btncheck" onclick='<?php if($updType != 'edit'){ ?>return validation()<?php }else{ ?>return validation_update()<?php } ?>'>
                        	<?php if($updType == 'edit'){echo 'Update';}else{ echo ucfirst($updType);} ?></button>
                        <a href='<?php echo base_url(); ?>admin/course-categories/' class='btn btn-red btn-lg'>
                        <span class="icon-32-cancel"> </span>Cancel </a>
					</div>
				</div>
				<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id; ?>">
				<input type="hidden" id="action" value="<?php echo $action;?>">
				<input type="hidden" id="newid" value="">
				<?php if ($updType == 'edit'){ ?>
				<input type="hidden" name="id" id="id" value="<?php echo $category->id; ?>">
				<?php } ?>
			</form>
		</div>
	</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
document.getElementById("imgname").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        document.getElementById("preview_image").src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
};
function validation()
{
	var name = $("#name").val().trim();
	var btncheck = $("#btncheck").html();
	var description = $("#description").val().trim();
	var category_id = $("#category_id").val().trim();
	var imgname = $("#imgname")[0].files[0];
	var metatitle = $("#metatitle").val().trim();
	var metadesc = $("#metadesc").val().trim();
	var metakwd = $("#metakwd").val().trim();
	var published = $("#published").is(':checked');
	var action = $("#action").val().trim();
	var newid = $("#newid").val().trim();
	var new_formdata= new FormData();
	new_formdata.append('name',name);
	new_formdata.append('description',description);
	new_formdata.append('category_id',category_id);
	new_formdata.append('imgname',imgname);
	new_formdata.append('metatitle',metatitle);
	new_formdata.append('metadesc',metadesc);
	new_formdata.append('metakwd',metakwd);
	new_formdata.append('published',published);
	new_formdata.append('newid',newid);
	// alert(btncheck);return false;
	if (name=="") {
		$("#err_name").fadeIn().html("Please enter Course Category name").css('color','red');
		setTimeout(function(){$("#err_name").html("&nbsp;");},2000);
		$("#name").focus();
		return false;
	}
	
	$("#btncheck").removeAttr('onclick');
	$("#btncheck").removeClass('btn-lg');
	$("#btncheck").addClass('btn-md');
	$("#btncheck").html('<div id="please_wait" style="font-size:16px !important;margin-bottom:0px !important"> <img src="<?php echo base_url();?>/public/images/loader_white.gif" style="margin-right:3px" height="28px"> Please Wait</div>');
	// return false;
    $.ajax({
		type:"post",
		cache:false,
		contentType:false,
		processData:false,
		url: "<?php echo base_url();?>admin/pcategories/"+action+"/",
		data:new_formdata,
	    success:function(returndata)
	    {
	    	if(returndata != 0 && returndata != 'Category Updated'){
		       	$("#btncheck").attr('onclick','return validation();');
				$("#btncheck").removeClass('btn-md');
				$("#btncheck").addClass('btn-lg');
				$("#btncheck").html(btncheck);
				$("#message123").html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"> </i> </a> <strong class="fa fa-check" aria-hidden="true"> Category created successfully. </strong></div>').fadeIn().delay(3000).fadeOut();
				$("#newid").val(returndata);
			}else if(returndata != 0 && returndata == 'Category Updated'){
		       	$("#btncheck").attr('onclick','return validation();');
				$("#btncheck").removeClass('btn-md');
				$("#btncheck").addClass('btn-lg');
				$("#btncheck").html(btncheck);
				$("#message123").html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"> </i> </a> <strong class="fa fa-check" aria-hidden="true"> Category updated successfully. </strong></div>').fadeIn().delay(3000).fadeOut();
				// $("#newid").val(returndata);
			} 
			else{
				$("#btncheck").attr('onclick','return validation();');
				$("#btncheck").removeClass('btn-md');
				$("#btncheck").addClass('btn-lg');
				$("#btncheck").html(btncheck);
				$("#message123").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"> </i> </a> <strong class="fa fa-exclamation-triangle" aria-hidden="true"> Image upload error occurs! try Again!</strong></div>').fadeIn().delay(3000).fadeOut();
			}
	    }
    });
}
function validation_update()
{
	var name = $("#name").val().trim();
	var slug = $("#slug").val().trim();
	var btncheck = $("#btncheck").html();
	var description = $("#description").val().trim();
	var category_id = $("#category_id").val().trim();
	var old_image = $("#old_image").val().trim();
	var imgname = $("#imgname")[0].files[0];
	var metatitle = $("#metatitle").val().trim();
	var metadesc = $("#metadesc").val().trim();
	var metakwd = $("#metakwd").val().trim();
	var published = $("#published").is(':checked');
	var action = $("#action").val().trim();
	var id = $("#id").val().trim();
	var new_formdata= new FormData();
	new_formdata.append('name',name);
	new_formdata.append('slug',slug);
	new_formdata.append('description',description);
	new_formdata.append('category_id',category_id);
	new_formdata.append('old_image',old_image);
	new_formdata.append('imgname',imgname);
	new_formdata.append('metatitle',metatitle);
	new_formdata.append('metadesc',metadesc);
	new_formdata.append('metakwd',metakwd);
	new_formdata.append('published',published);
	new_formdata.append('id',id);
	// alert(btncheck);return false;
	if (name=="") {
		$("#err_name").fadeIn().html("Please enter Course Category name").css('color','red');
		setTimeout(function(){$("#err_name").html("&nbsp;");},2000);
		$("#name").focus();
		return false;
	}
	
	$("#btncheck").removeAttr('onclick');
	$("#btncheck").removeClass('btn-lg');
	$("#btncheck").addClass('btn-md');
	$("#btncheck").html('<div id="please_wait" style="font-size:16px !important;margin-bottom:0px !important"> <img src="<?php echo base_url();?>/public/images/loader_white.gif" style="margin-right:3px" height="28px"> Please Wait</div>');
	// return false;
    $.ajax({
		type:"post",
		cache:false,
		contentType:false,
		processData:false,
		url: "<?php echo base_url();?>admin/pcategories/"+action+"/",
		data:new_formdata,
	    success:function(returndata)
	    {
	    	// console.log(returndata);return false;
	    	if(returndata != 0 && returndata == 'Category Updated'){
		       	$("#btncheck").attr('onclick','return validation_update();');
				$("#btncheck").removeClass('btn-md');
				$("#btncheck").addClass('btn-lg');
				$("#btncheck").html(btncheck);
				$("#message123").html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"> </i> </a> <strong class="fa fa-check" aria-hidden="true"> Category updated successfully. </strong></div>').fadeIn().delay(3000).fadeOut();
			} 
			else{
				$("#btncheck").attr('onclick','return validation_update();');
				$("#btncheck").removeClass('btn-md');
				$("#btncheck").addClass('btn-lg');
				$("#btncheck").html(btncheck);
				$("#message123").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true"> </i> </a> <strong class="fa fa-exclamation-triangle" aria-hidden="true"> Image upload error occurs! try Again!</strong></div>').fadeIn().delay(3000).fadeOut();
			}
	    }
    });
}
</script>
<script>

function valid_escape()
{
    var x = event.which || event.keyCode;
    console.log(x);
    if((x >= 48 ) && (x <= 57 ) || x == 8 || x==45 || x==46 || x==95 || (x >= 65 ) && (x <= 90 ) || (x >= 97 ) && (x <= 122 ))
    {   
        return;
    }else{
      event.preventDefault();
    }
}
</script>