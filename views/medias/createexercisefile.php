<link href="<?php echo base_url(); ?>public/css/my_frontend.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/classic/css/bootstrap.css" media="screen" />

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

input[type="radio"], input[type="checkbox"] {
	margin: 0px 10px 0 0 !important;
	margin-top: 1px \9;
	line-height: normal;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
	margin: 0 10px !important;
	font-size:12px !important;
}
.col-sm-3 {
	padding-right:5px;
}
label {
	display: inline-block !important;
}
textarea {
	/*width:100% !important; */
	width:200px !important; 
}
.form-control {
	width:100%!important;
	font-size:12px;
  margin:0px!important;
}
input[type="text"]{
  margin:0px!important;
  height:40px!important;
}
a.btn.btn-success.exe_cat {
  margin-top: 5%;
}
select{
  height:40px!important;
}
.form-group {
	padding:0 0 30px 0 !important;
}
td, th {
	padding: 10px !important;
}
table {
	border-collapse: inherit;
	border:none !important;
}
div#colorbox {
  position: fixed!important;
  top: 106px!important;
}
/*css*/
.control-label {
  display: inline-block;
  margin-bottom: 0;
  padding: 5px 5px 5px 0px;
  width: 30%!important;
  float: left;
}
legend {
  font-size: 21px!important;
  text-align: center!important;
  padding: 17px 30px 0 13px !important;
  border-bottom: 0px!important;
  }
.form-group {
  padding: 0px!important;
  display: -webkit-box!important;
}
.select-control {
  float: right;
  padding-left:0px;
  padding-right:0px;
  width: 70%!important;
}
.panel-body {
  position: relative;
  padding: 15px 15px 8px 15px!important;
}
.panel {
  margin-bottom: 0px!important;
  background-color: #fff;
  border: 1px solid #ebebeb;
  border-radius: 3px;
  margin-top: 0%!important; 
}
input[type="checkbox"] {
  margin: 0px 0px 0 3px !important;
  line-height: normal;
  width: 100%!important;
  height: 13px!important;
  position: relative;
  top: 4px;
}
.tform textarea {
  height: 80px!important;
}
.document {
  padding:5px 10px 0px 0px!important;
  font-size: 15px;
}
input[type="file"] {
  height: 30px;
  line-height: 30px;
}
.form-group {
  margin-bottom: 13px!important;
}
.page-container .main-content {
  padding-bottom: 0px!important;
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
<!--<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>

<?php

$attributes = array('class' => 'tform', 'id' => 'upload_file','name' => 'tform');

echo ($updType == 'create') ? form_open_multipart(base_url().'medias/createexercisefile1', $attributes) : form_open_multipart(base_url().'medias/createexercisefile'.$id, $attributes);

?>

<!--top content area-->

<div class="page-container">
  
    <div style="background-color:#f1f1f1; height:73px;">
      <legend style="color:#c42140; text-transform:uppercase; font-size:16px; font-weight:bold; padding: 10px 30px 0 30px;"><?php echo ($updType == 'create') ? 'Create Media' : 'Edit Media'?></legend>
    </div>
    <?php if ($updType == 'edit'):
		$mediatypeval = $media->type;
		else:
		$mediatypeval = null;
		endif;
	?>
  <div class="main-content">
    <div class="panel panel-primary">
      <div class="panel-body" style="overflow-x: hidden;">
        <form role="form" class="form-horizontal form-groups-bordered">
          <div class="form-group" style="display: none !important;">
            <label class="col-sm-3 control-label" for="type">Type: <span class="required">*</span></label>
            	<div class="col-sm-5 select-control">
              <!-- <select class="form-control" onchange="changeType(this.value)" name="type" id="type" data-validation="required" data-validation-error-msg="Enter valid Question"> -->
                <select  name="type" id="type" data-validation="required" data-validation-error-msg="Enter valid Question">
                <option value="file" selected="selected"> File </option>
                <!-- <?php foreach($mediatype as $type){?>
                <?php if($type->name == 'docs' || $type->name == 'file') { ?>
                <option value="<?php echo $type->name;?>" <?php echo  preset_select('type', $type->name, (isset($media->type)) ? $media->type : ''  ) ?> > <?php echo $type->title;?> </option>
                <?php } } ?> -->
              </select>
              <span class="error" style="color:red; float:right; margin:-1% 0 0 50%"><?php echo form_error('type'); ?></span> 
          </div>
          </div>                   
          <div class="form-group">
            <label class="col-sm-3 control-label" for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
            <div class="col-sm-5 select-control">
              <input class="form-control" id="name" type="text" placeholder="Name" name="name" maxlength="256" value="<?php echo set_value('name', (isset($media->name)) ? $media->name : ''); ?>" data-validation="required" data-validation-error-msg="Enter valid Question" />
              <span class="error" style="color: red;"><?php echo form_error('name'); ?></span>
          </div>
          </div>          
          <div class="form-group">
            <label class="col-sm-3 control-label" for='category_id'><?php echo lang('web_category')?> <span class="required">*</span></label>
            <div class="col-sm-5 select-control">
              <select  class="form-control" name='category_id' id='category_id' data-validation="required" data-validation-error-msg="Enter valid Question">
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                <option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>
                <?php endforeach ?>
              </select>
              <span class="error" style="color: red; margin:14% 0 0 54%"><?php echo form_error('category_id'); ?></span>
              <!-- <a href="<?php echo base_url();?>medias/create_exe_cat" class="btn btn-success exe_cat">Create New Category </a> -->
              <!-- <input type="hidden" name="med_cat" id="med_cat" value="" > -->
              </div>
              
          </div>               
          
          <div class="form-group">
            <label class="col-sm-3 control-label" for="instructions">Sub Title / <br />Instruction:
              <?php //echo lang('web_description')?>
            </label>
              <?php //$this->ckeditor->editor("instructions",($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''));?>
              <div class="col-sm-5 select-control">
              <textarea class="form-control" id="instructions" placeholder="TextSub Title / Instructionarea" name="instructions"  ><?php echo ($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''); ?></textarea>               
          </div>
          </div>        
          
          
          <?php $filemedia = ($mediatypeval=='file')? '' : 'none'; ?>
          <div id="fileblock" style="display:block;">
            <fieldset class="adminform">
              <div class="form-group">
                <label class="col-sm-3 control-label" for='file_f'>Select file source:</label>
                  <div class="col-sm-5 select-control">
                    <input type="file" name="file_f" id="file_f" class="upload_btn">
                    (Allowed file types: jpeg, doc, docx, ppt, pptx, pdf, txt, jpg, png, gif, bmp)
                    <div id="no-file" style="display: none;color: red">No file chosen</div>
                  </div>
              </div>
                <div id="progress" class="progress">
                    <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                      <div id="percent">0%</div>
                    </div>              
                </div>
            </fieldset>
          </div>
          <div style="display: none;text-align: center;padding-bottom: 15px;color: orange;" id="uploading_text">Uploading please wait...</div>
          <div>
          <div>
            <div class="col-sm-offset-3 col-sm-5" style="text-align:center;"> <a> <?php echo form_submit( 'submit', ($updType == 'edit') ? "Edit" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?> </a> </div>
          </div>
        </form>
      </div>
    </div>
    <div class="clr"></div>
    <?php //echo form_hidden('page',set_value('page', $page)) ?>
    <?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>
    <?php if ($updType == 'edit'): ?>
    <?php echo form_hidden('id',$media->id) ?>
    <?php endif ?>
    <?php echo form_close(); ?> </div>
</div>

<!-- tool tip script --> 

<script type="text/javascript">

$(document).ready(function(){


var new_cat = $("#med_cat",parent.document).val();

if(new_cat){
  // alert(new_cat);
  $("#category_id option:contains(- "+new_cat+")").attr('selected', true);
  $("#med_cat",parent.document).val('');
}
 

$('.tooltipicon').click(function(){

var dispdiv = $(this).attr('id');

$('.'+dispdiv).css('display','inline-block');

});

$('.closetooltip').click(function(){

$(this).parent().css('display','none');

});

});

</script> 

<!-- tool tip script finish -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script>
$.validate({
errorElementClass:"validateerrorbox",
errorMessageClass:"validateerror",
borderColorOnError:"red",
//errorMessagePosition:"top",
modules : 'logic',
}); 

</script>
<script>

  $(".exe_cat").click(function(){
   // var type = $("#type").val();
    //alert(type);
    var name = $("#name").val();
    //alert(name);
    var file = $("#file_f").val();
    //alert(file);
    var publshd = $("#published").val();
    //alert(publshd);
    var instr = $("#instructions").val();
   // alert(instr);

    $("#med_type",parent.document).val(type);
    $("#med_name",parent.document).val(name);
    $("#med_inst",parent.document).val(instr);

    $("#med_active",parent.document).val(publshd);
    $("#med_file",parent.document).val(file);

});
</script>

<script type="text/javascript">
$(document).ready(function()
{
  var type = $("#med_type",parent.document).val();
  var name = $("#med_name",parent.document).val();
  var description = $("#med_inst",parent.document).val();
  var active = $("#med_active",parent.document).val();  
  var file = $("#med_file",parent.document).val();
  
  //$("#type").val(type);
  $("#name").val(name);
  $("#published").val(active);
  $("#instructions").val(description);
  // if(setsrc)
  // {
  // $("#imgname").attr('src', setsrc);
  //   }
  $("#file_f").val(file);

 // $("#category_id select").val(category_id);


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
   
    if(jQuery.inArray(ext, ['jpeg', 'doc', 'docx', 'ppt', 'pptx', 'pdf', 'txt', 'jpg', 'png', 'gif', 'bmp']) == -1) 
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
    {  var i = 0;       
        console.log(response);
        var objvideo = JSON.parse(response); 
        console.log(objvideo);
        i++;
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
             // str+= '<input type="hidden" name="media_id[]" id="media_id" value="'+objvideo.rowid.inserted_id+'"></td>';
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
             // str+= '<td><a href="'+base_url+'/course-media/'+objvideo.rowid.alt_title+'/'+objvideo.rowid.type+'/'+objvideo.rowid.inserted_id+'" class="preview1"><div class="sprite 5preview" style="background-position: -120px 0; height: 14px;" title="Preview"></div></a></td>'; 
             str+= '<td><a href="'+base_url+'/public/uploads/files/'+objvideo.name+'" class="" download ><i title="Download" class="entypo entypo-download"></i></a></td>';        
             str+= '<td><a href="javascript:void(0);" class="removeele" onclick="removeRow(this.id)" id="remove'+objvideo.rowid.inserted_id+'">';
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
        //alert('error occured');  
    }
 
}; 
 
jQuery("#upload_file").ajaxForm(optionsvideo);

</script>
