<?php
 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<link href="<?php echo base_url(); ?>public/css/my_frontend.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/classic/css/bootstrap.css" media="screen" />
<style>
#progress {
  top: 14px;
  width: 75%;
  margin-left: 50px;
  height: 19px;
  display: none;
}
#percent_gallery, #percent_video, #percent_audio, #percent_pdf, #percent_flash {
  left: 0%;
}
#percent{
  left:50%;
}
.renew-top-close-btn{
  margin-top:2%!important;
}
</style>
<style>
input[type="radio"], input[type="checkbox"] {
	margin: 0px 10px 0 0 !important;
	margin-top: 1px \9;
	line-height: normal;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	margin: 0 10px !important;
}
td, th {
	padding: 10px !important;
}
/*css*/
.top-content {
  background-color: #f1f1f1!important;
  height: 73px!important;
}
legend {
  display: block;
  width: 100%;
  margin-bottom: 20px;
  font-size: 21px;
  line-height: 40px;
  color: #333333;
  color: #c42140!important;
  text-transform: uppercase;
  font-size: 21px;
  text-align: center;
  font-weight: bold;
  padding: 10px 30px 0 30px!important;
  border: 0;
  border-bottom: none!important;
}
label.col-sm-3.control-label {
  width: 25%!important;
  float: left!important;
}
.control-label{
  padding: 5px 0 5px 5px;
}
input#published_chk {
  margin-top: 1.2%!important;
}
input[type="text"]{
  width:100%!important;
  height: 40px!important;
}
.col-sm-5 {
  width: 75%!important;
  float: left!important;
}
select {
  width: 100%!important;
  height: 40px!important;
}
.radio, .checkbox {
  min-height: 20px;
  padding-left: 12px!important;
}
.checkbox{
  padding-top: 2%;	
}
.btn {
  background-image: none!important;
  color: #ffffff!important;
  background-color: #51a351!important;
  }
  .panel-body {
  position: relative;
  padding: 15px 15px 15px 15px!important;
}
.form-group {
  display: -webkit-box!important;
}
.progress-bar-striped {
  background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
  background-size: 40px 40px;
}
.progress-bar-striped.active {
  -webkit-animation: progress-bar-stripes 2s linear infinite;
}
.progress {
  border-radius: 10px!important;
  margin-bottom: 5px;
  margin-top: 10px;
}
.progress-bar{
  background-color:orange;	
}
/*end of css*/
.validateerror {
float: left;
text-align: center;
width: 40%;
/*margin-left: 235px;*/
margin-left: 281px;
margin-bottom: -40px;
color: red;
}
.help-block {
display: block;
width: 100% !important;
margin: 0 -165px auto !important;
}

.validateerrorbox
{
border-color: red !important;
}
</style>

<?php

$attributes = array('class' => 'tform', 'id' => 'upload_file','name' => 'tform');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/medias/createexercisefile1', $attributes) : form_open_multipart(base_url().'admin/medias/createexercisefile'.$id, $attributes);

?>

<!--top content area-->

<div class="page-container">
  
    <div class="top-content">
      <legend><?php echo ($updType == 'create') ? 'Create Media' : 'Edit Media'?></legend>
    </div>
    <?php if ($updType == 'edit'):
		$mediatypeval = $media->type;
		else:
		$mediatypeval = null;
		endif;
	?>
  <div class="main-content">
    <div class="panel panel-primary">
      <div class="panel-body">
        <form role="form">
          <div class="form-group" style="display: none !important;" >
            <label class='col-sm-3 control-label' style="margin-bottom:0;" for="type">Type: <span class="required">*</span></label>
            <div class="col-sm-5">
              <select  name="type" id="type" data-validation="required" data-validation-error-msg="Enter valid Question">
                <option value="file" selected="selected"> File </option>
               <!--  <?php foreach($mediatype as $type){?>
                <?php if($type->name == 'docs' || $type->name == 'file') { ?>
                <option value="<?php echo $type->name;?>" <?php echo  preset_select('type', $type->name, (isset($media->type)) ? $media->type : ''  ) ?> > <?php echo $type->title;?> </option>
                <?php } } ?> -->
                <!-- <option value="file" selected >File</option> -->
              </select>
              
              <!-- tooltip area --> 
              
              <span class="tooltipcontainer"> <span type="text" id="type-target" class="tooltipicon" title="Click Here"></span> <span class="type-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              <!--tip containt--> 
              
              <?php echo lang('media_fld_type');?> 
              
              <!--/tip containt--> 
              
              </span> </span> 
              
              <!-- tooltip area finish --> 
              
              <span class="error" style="color: red;"><?php echo form_error('type'); ?></span> </div>
          </div>
          
          <div class="form-group">
            <label class='col-sm-3 control-label' style="margin-bottom:0;" for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
            <div class="col-sm-5">
              <input id="name" type="text" placeholder="Name" name="name" maxlength="256" value="<?php echo set_value('name', (isset($media->name)) ? $media->name : ''); ?>" data-validation="required" data-validation-error-msg="Enter valid Question" />
              
              <!-- tooltip area --> 
              
              <span class="tooltipcontainer"> <span type="text" id="name-target" class="tooltipicon" title="Click Here"></span> <span class="name-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              <!--tip containt--> 
              
              <?php echo lang('media_fld_name');?> 
              
              <!--/tip containt--> 
              
              </span> </span> 
              
              <!-- tooltip area finish --> 
              
              <span class="error" style="color: red;"><br/><?php echo form_error('name'); ?></span> </div>
          </div>
          
          <div class="form-group">
            <label class='col-sm-3 control-label' style="margin-bottom:0;" for='category_id'><?php echo lang('web_category')?> <span class="required">*</span></label>
            <div class="col-sm-5">
              <select name='category_id' id='category_id' data-validation="required" data-validation-error-msg="Enter valid Question">
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                <option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>
                <?php endforeach ?>
              </select>
              
              <span class="tooltipcontainer"> <span type="text" id="category_id-target" class="tooltipicon" title="Click Here"></span> <span class="category_id-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              <?php echo lang('media_fld_category');?> 
              
              </span> </span> 
              
              <!-- tooltip area finish --> 
              
              <span class="error" style="color: red;"><?php echo form_error('category_id'); ?></span> </div>
          </div>
          
          <div class="form-group" style="display: none !important;">
            <label class='col-sm-3 control-label' style="margin-bottom:0;" for='category_id'>Active</label>
            <div class="col-sm-5">
              <div class="checkbox">
                <input id="published_chk" type="checkbox" name="published" value='1' checked <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($media->published)) && $media->published == '1' ? "checked" : ''; ?> />
                
                <!--<input id="published" type="checkbox" name="published" value='1' <?php echo preset_checkbox('published', '1', (isset($media->published)) ? $media->published : ''  )?> /> -->
                
                <label style="margin-bottom:0; padding:0; width:100%;" for='published'> <?php echo lang('web_is_active')?> </label>
                
                <!-- tooltip area --> 
                
                <span class="tooltipcontainer"> <span type="text" id="published-target" class="tooltipicon" title="Click Here"></span> <span class="published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                
                <!--tip containt--> 
                
                <?php echo lang('media_fld_active');?> 
                
                <!--/tip containt--> 
                
                </span> </span> 
                
                <!-- tooltip area finish --> 
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label class='col-sm-3 control-label' style="margin-bottom:0;" for="instructions">Sub Title / Instruction:
              <?php //echo lang('web_description')?>
            </label>
            <div class="col-sm-5"> 
             
                  <textarea id="instructions" placeholder="TextSub Title / Instructionarea" name="instructions"><?php echo ($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''); ?></textarea>
                  
              
              <!-- tooltip area --> 
              
              <span class="tooltipcontainer"> <span type="text" id="instructions-target" class="tooltipicon" title="Click Here"></span> <span class="instructions-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
              
              <!--tip containt--> 
              
              <?php echo lang('media_fld_instruction');?> 
              
              <!--/tip containt--> 
              
              </span> </span> 
              
              <!-- tooltip area finish --> 
            </div>
          </div>       
          
          
          <?php $filemedia = ($mediatypeval=='file')? '' : 'none'; ?>
          <div id="fileblock" style="display:block">
            <fieldset class="adminform">
            <div class="form-group" style="margin-bottom:0px">
                <label class="col-sm-3 control-label" for='file_f'>Select file source:</label>
                  <div class="col-sm-5 select-control" style="margin: 0 10px 15px!important;">
                    <input type="file" name="file_f" id="file_f" class="upload_btn" style="padding-top:3px;">(Allowed file types: rar, zip, doc, docx, ppt, pptx, pdf, txt, jpg, png, gif, bmp)
                    <div id="no-file" style="display: none;color: red">No file chosen</div>
                  	
                  </div>
              </div>
              <!-- <div id="progress" class="progress" style="margin-bottom:3%;">
                          <div id="bar"></div>
                          <div id="percent">0%</div>
                  </div> -->
            <div id="progress" class="progress">
              <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                <div id="percent">0%</div>
              </div>              
            </div>

            </fieldset>
          </div>
          <div style="display: none;text-align: center;padding-bottom: 15px;color: orange;" id="uploading_text">Uploading please wait...</div>
          <div>
            <div class="col-sm-offset-3 col-sm-5" style="width:100%!important;display:block;text-align:center;"> <a> <?php echo form_submit( 'submit', ($updType == 'edit') ? "Edit" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'")); ?> </a> </div>
          </div>
        </form>
      </div>
    </div>
    <div class="clr"></div>
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />
    <script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script> 
    
    <?php //echo form_hidden('page',set_value('page', $page)) ?>
    <?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>
    <?php if ($updType == 'edit'): ?>
    <?php echo form_hidden('id',$media->id) ?>
    <?php endif ?>
    <?php echo form_close(); ?> </div>
</div>

<!-- tool tip script finish -->

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script>
var $j =jQuery.noConflict();
$j.validate({
errorElementClass:"validateerrorbox",
errorMessageClass:"validateerror",
borderColorOnError:"red",
//errorMessagePosition:"top",
modules : 'logic',
}); 

</script>
<script>

jQuery(".exe_cat").click(function()
{
    //var type = jQuery("#type").val();
    var name = jQuery("#name").val();
    var file_f = jQuery("#file_f").val();
    var file_d = jQuery("#file_d").val();
    var publshd = jQuery('input[name=published]:checked').val();
    var instr = jQuery("#instructions").val();
    jQuery("#med_type",parent.document).val(type);
    jQuery("#med_name",parent.document).val(name);
    jQuery("#med_inst",parent.document).val(instr);
    jQuery("#med_active",parent.document).val(publshd);
    jQuery("#med_file_f",parent.document).val(file_f);
    jQuery("#med_file_d",parent.document).val(file_d);

});
</script>

<script type="text/javascript">
jQuery(document).ready(function()
{

    var type = jQuery("#med_type",parent.document).val();
    var name = jQuery("#med_name",parent.document).val();
    var description = jQuery("#med_inst",parent.document).val();
    var active = jQuery("#med_active",parent.document).val();  
    var file_f = jQuery("#med_file_f",parent.document).val();
    var file_d = jQuery("#med_file_d",parent.document).val();
    //jQuery("#type").val(type);
    jQuery("#name").val(name);

    if(active == 1) 
    {
      jQuery("#published_chk").prop('checked', true); 
    }
    else
    {
      jQuery("#published_chk").prop('checked', false); 
    }

    jQuery("#instructions").val(description);
    jQuery("#file_f").val(file_f);
    jQuery("#file_d").val(file_d);

});
</script>
<script>
jQuery('#submit').click(function () {
  var name = jQuery("#name").val();
  var cat = jQuery("#category_id").val();
  var file = jQuery("#file_f").val();
  //alert(file);
  if(!file){
    jQuery('#no-file').css('display','block');
    return false;
  }
  else{
     jQuery('#no-file').css('display','none');
  }
  if(name && cat && file){
    //jQuery('#uploading_text').css('display','block');
  }
  var filee = document.getElementById('file_f').files[0];
   //var ext = filee.type;
   var ext = jQuery('#file_f').val().split('.').pop().toLowerCase();
  
    if(jQuery.inArray(ext, ['rar', 'zip', 'doc', 'docx', 'ppt', 'pptx', 'pdf', 'txt', 'jpg', 'png', 'gif', 'bmp']) == -1) 
    {
     alert('invalid extension!');
     return false;
    }

    if(filee && filee.size < 104857600) { // 100 MB (this size is in bytes)
       
        return true;       
    } else {        
       alert('Invalid file size uploaded');
       return false;
    }

    
    
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
  var base_url = window.location.origin; 
  var ftype ="";
  var optionsvideo = { 
    beforeSend: function() 
    {
        jQuery(":submit").attr("disabled", true);
        jQuery("#progress").show();
        //clear everything
        jQuery("#bar").width('0%');
        //$("#message").html("");
        jQuery("#percent").html("0%");
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
         jQuery("#bar").width(percentComplete+'%');
         jQuery("#percent").html(percentComplete+'%');
        
 
    },
    success: function(response) 
    {         
        console.log('11'+response);
        var objvideo = JSON.parse(response); 
        console.log(objvideo);
        if(objvideo.error)
        {
          // jQuery("#bar").width('0%');
          // jQuery("#percent").html('0%');
          jQuery('#file_f').val('');
          jQuery("#progress").hide();
          jQuery("#uploading_text").hide();
          alert(objvideo.error);
        }
        else
        {
          jQuery('#file_f').val('');
          jQuery("#progress").hide();
          console.log(objvideo.rowid.inserted_id);
          var str ='<tr id="tr'+objvideo.rowid.inserted_id+'">';
             str+= '<td style="display:none;">'+objvideo.rowid.inserted_id+'<input type="hidden" name="media_id[]" id="media_id" value="'+objvideo.rowid.inserted_id+'"></td>';
             
            if( objvideo.ext == 'gif'||  objvideo.ext == 'GIF')
            {
                ftype = '<img src="'+base_url+'/public/css/image/gif-icon.png" alt="File type">';
            } 
            else if( objvideo.ext == 'rar'||  objvideo.ext == 'RAR')
            {
                ftype = '<img src="'+base_url+'/public/css/image/rar-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'zip'||  objvideo.ext == 'ZIP')
            {
                ftype = '<img src="'+base_url+'/public/css/image/zip-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'rar'||  objvideo.ext == 'RAR')
            {
                ftype = '<img src="'+base_url+'/public/css/image/rar-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'doc'|| objvideo.ext == 'DOC')
            {
                ftype = '<img src="'+base_url+'/public/css/image/doc-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'docx'|| objvideo.ext == 'DOCX'){
              ftype = '<img src="'+base_url+'/public/css/image/docx-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'docx'|| objvideo.ext == 'DOCX'){
              ftype = '<img src="'+base_url+'/public/css/image/docx-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'jpg'|| objvideo.ext == 'JPG'){
              ftype = '<img src="'+base_url+'/public/css/image/jpg-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'png'|| objvideo.ext == 'PNG'){
              ftype = '<img src="'+base_url+'/public/css/image/png-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'bmp'|| objvideo.ext == 'BMP'){
              ftype = '<img src="'+base_url+'/public/css/image/bmp-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'ppt'|| objvideo.ext == 'PPT'){
              ftype = '<img src="'+base_url+'/public/css/image/ppt-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'pptx'|| objvideo.ext == 'PPTX'){
              ftype = '<img src="'+base_url+'/public/css/image/pptx-icon.png" alt="File type">';
            }
            else if( objvideo.ext == 'pdf'|| objvideo.ext == 'PDF'){
            ftype = '<img src="'+base_url+'/public/css/image/pdf-icon.png" alt="File type">';
          }
          else if( objvideo.ext == 'txt'|| objvideo.ext == 'TXT'){
            ftype = '<img src="'+base_url+'/public/css/image/txt-icon.png" alt="File type">';
          }

             
             str+= '<td>'+ftype+'</td>';
             str+= '<td>'+objvideo.rowid.alt_title+'</td>'; 
             str+= '<td><a href="'+base_url+'/public/uploads/files/'+objvideo.name+'" class="" download ><i title="Download" class="entypo entypo-download"></i></a></td>';          
             str+= '<td><a href="javascript:void(0);" class="removeele" id="remove'+objvideo.rowid.inserted_id+'">';
             str+= '<img src="'+base_url+'/public/img/admin/cross-16.png">';
             str+= '</a></td></tr>';

             jQuery("#rowsmedia",parent.document).append(str);
             jQuery("#cboxClose",parent.document).click();
             
        }
        
    },
    complete: function(response) 
    {       
      
    },
    error: function()
    {  
        alert('error occured');  
    }
 
}; 
 
jQuery("#upload_file").ajaxForm(optionsvideo);

</script>