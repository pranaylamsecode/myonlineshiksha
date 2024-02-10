<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/courses_css/courses_form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/category_css/category.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.js"></script>
<script>
  jQuery(document).ready(
  function()
  {
     jQuery('#description').redactor(); 

     jQuery('.redactor-editor').css({'overflow':'scroll','max-height':'100px'});
  });

  function check_name(fldid){
  var name = jQuery("#"+fldid).val();  
    $.ajax({
        type: "post",
        <?php 
        if ($updType != 'edit')
        {
         ?>        
        url: "<?php echo base_url('admin/medias/checkname'); ?>",
    <?php }
    else
      {
        ?>
         url: "<?php echo base_url() ?>admin/medias/checknamedit/<?php echo $this->uri->segment(4); ?>",
        <?php
      }
        ?>
        data: {name:name},
        success: function(msg)
        {
            if(msg == 'success')
            { 
                $("#ajax").css({"color": "red","padding-left": "300px"});
                $("#ajax").html('Already Exist');
                jQuery("#"+fldid).val('');
            }
            else
            {
                $("#ajax").css({"color": "green","padding-left": "300px"});
                $("#ajax").html('Available');
            }
        }
    });
}
</script>
<script type="text/javascript">
var $ = jQuery;
$(function() {
   $('#file_i,#file_v,#file_a,#file_d,#file_f').on('change',function(e) {
   var ftpfileoptions;
   var ftpfilearray;
   switch($('select#type').val()){
     case 'image': var fldtype='i';
    break;
     case 'video': var fldtype='v';
    break;
     case 'audio': var fldtype='a';
    break;
     case 'docs': var fldtype='d';
    break;
     case 'file': var fldtype='f';
    break;
   }
   e.preventDefault();
      return false;
   });
});

//});
</script>


<script type="text/javascript">
window.onload = function() {
  var local_upload = document.getElementById("source_local_v2").checked;

    if(local_upload == true){
     var local_val = document.getElementById("source_local_v2").value;
    }

    var local_url = document.getElementById("source_url_v").checked;
    if(local_url == true){
     // alert('yes');
     var local_val = document.getElementById("source_url_v").value;
     document.getElementById("url_v").style.display = 'block';
    }

    //var local_code = document.getElementById("source_code_v").checked;
    var local_code = false;
    if(local_code == true){

     var local_val = document.getElementById("source_code_v").value;

    }

    displayContainer(local_val);

    var local_code = document.getElementById("source_code_a").checked;

    if(local_code == true){

     var local_vala = document.getElementById("source_code_a").value;

    }

    var local_urla = document.getElementById("source_url_a").checked;

    if(local_urla == true){

     var local_vala = document.getElementById("source_url_a").value;

    }

    var local_locala = document.getElementById("source_local_a2").checked;

    if(local_locala == true){

     var local_vala = document.getElementById("source_local_a2").value;

    }
    displayContainerAudio(local_vala);
    var local_coded = document.getElementById("source_url_d").checked;
    if(local_coded == true){

     var local_vala = document.getElementById("source_url_d").value;

    }
    var local_locald = document.getElementById("source_local_d2").checked;
    if(local_locald == true){
     var local_vala = document.getElementById("source_local_d2").value;
    }
    displayContainerDoc(local_vala);

    var local_urlf = document.getElementById("source_url_f").checked;
    if(local_urlf == true){
     var local_vala = document.getElementById("source_url_f").value;
    }
    var local_localf = document.getElementById("source_local_f2").checked;
    if(local_localf == true){
     var local_vala = document.getElementById("source_local_f2").value;
    }
    displayContainerFile(local_vala);
}
</script>
<script type="text/javascript">
var type='';
  function alldisable(type)
            {
             document.getElementById("videoblock").style.display = 'none';
             document.getElementById("audioblock").style.display = 'none';
             document.getElementById("imageblock").style.display = 'none';
              document.getElementById("urlblock").style.display = 'none';
              document.getElementById("docsblock").style.display = 'none';
              document.getElementById("fileblock").style.display = 'none';
              document.getElementById("textblock").style.display = 'none';

            }

            function changeType(type)
          {

            alldisable(type);

               if(type == 'text')
                {

                } 

            document.getElementById(type+"block").style.display = 'block';

          }

function displayContainerFile(conval)
                {
         
             if(conval=='url')
                {
                document.getElementById("url_f").style.display = 'block';
                document.getElementById("localfile_f1").style.display = 'none';
                }

             if(conval=='local')
             {

              document.getElementById("url_f").style.display = 'none'
              document.getElementById("localfile_f1").style.display = 'block';
            }
    }

function displayContainerDoc(conval)
    {
         if(conval=='url')
         {
          document.getElementById("url_d").style.display = 'block';
          document.getElementById("localfile_d1").style.display = 'none';
          document.getElementById("localfile_d2").style.display = 'none';
          document.getElementById("localfile_d3").style.display = 'none';
          }

         if(conval=='local')
          {
            document.getElementById("url_d").style.display = 'none'
           document.getElementById("localfile_d1").style.display = 'block';
           document.getElementById("localfile_d2").style.display = 'block';
           document.getElementById("localfile_d3").style.display = 'block';
         }



    }

    function displayContainerAudio(conval)
    {
         if(conval=='code')
         {
           document.getElementById("code_a").style.display = 'block';
           document.getElementById("url_a").style.display = 'none';
           document.getElementById("localfile_a2").style.display = 'none';
         }
         if(conval=='url')
         {
           document.getElementById("code_a").style.display = 'none';
           document.getElementById("url_a").style.display = 'block';
           document.getElementById("localfile_a2").style.display = 'none';
         }
         if(conval=='local')
         {
           document.getElementById("code_a").style.display = 'none';
           document.getElementById("url_a").style.display = 'none';
           document.getElementById("localfile_a2").style.display = 'block';
         }
    }
    function displayContainer(conval)
    {
         if(conval=='code')
         {
            document.getElementById("code_v").style.display = 'block';
            document.getElementById("url_v").style.display = 'none';
            document.getElementById("url_v1").value = '';
            document.getElementById("localfile_v1").style.display = 'none';
            }
        if(conval=='url')
         {
            document.getElementById("code_v").style.display = 'none';
            document.getElementById("code_v1").value = '';
            document.getElementById("url_v").style.display = 'block';
            document.getElementById("localfile_v1").style.display = 'none';
         }
         if(conval=='local')
         {
            document.getElementById("code_v").style.display = 'none';
            document.getElementById("url_v").style.display = 'none';
            document.getElementById("localfile_v1").style.display = 'block';
         }
    }
</script>
<script type="text/javascript">
function change_radio_code() {
  if(document.tform.type.value == 'video')
    adding_ext = '_v';
  if(document.tform.type.value == 'audio')
    adding_ext = '_a';
  if(document.tform.type.value == 'docs')
    adding_ext = '_d';
  if(document.tform.type.value != 'docs')

   document.getElementById('source_code'+adding_ext).checked = 'checked';
  document.getElementById('source_url'+adding_ext).checked = '';
  document.getElementById('source_local'+adding_ext+'2').checked = '';
}

function change_radio_url() {
  if(document.tform.type.value == 'video')
    adding_ext = '_v';
  if(document.tform.type.value == 'audio')
    adding_ext = '_a';
  if(document.tform.type.value == 'docs')
    adding_ext = '_d';
  if(document.tform.type.value == 'file'){
    document.getElementById('filePreview').innerHTML="<a href='"+document.getElementById('url_f').value+"'>Download</a>";
    adding_ext = '_f';
  }
  if(document.tform.type.value != 'docs' && document.tform.type.value != 'file')
      document.getElementById('source_code'+adding_ext).checked = '';
  document.getElementById('source_url'+adding_ext).checked = 'checked';
  document.getElementById('source_local'+adding_ext+'2').checked = '';
}

function change_radio_local() {
  if(document.tform.type.value == 'video')
    adding_ext = '_v';
  if(document.tform.type.value == 'audio')
    adding_ext = '_a';
  if(document.tform.type.value == 'docs')
    adding_ext = '_d';
  if(document.tform.type.value == 'file'){
    adding_ext = '_f';
    document.getElementById('filePreviewList').href=document.getElementById('filesFolder').innerHTML+"/"+document.getElementById('localfile_f').value;
    document.getElementById('filePreviewList').style.visibility="visible";
  }
  if(document.tform.type.value != 'docs' && document.tform.type.value != 'file')
      document.getElementById('source_code'+adding_ext).checked = '';
  document.getElementById('source_url'+adding_ext).checked = '';
  document.getElementById('source_local'+adding_ext+'2').checked = 'checked';
}

</script>
<div class="main-container">
<?php

$attributes = array('class' => 'tform', 'id' => 'upload_file','name' => 'tform', 'autocomplete'=>"off");
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/medias/create', $attributes) : form_open_multipart(base_url().'admin/medias/edit/'.$id, $attributes);
?>

<!-- </div> -->
<div class="field_container">

        
        <!-- <form role="form" class="form-horizontal form-groups-bordered"> -->
          
            <div class="form-group form-border" style="display: none;">
    
                <label class='col-sm-12 control-label field-title' for="type">Type <span class="required">*</span>
<!--                           <p>(Please select your Type)</p>
-->                        </label>
              <div class="col-sm-12">
      
                <select class="form-control form-height" size="1" name="type" id="type">

                    <option value="file">File</option>
                  

                  </select>

  
                <span class="error"><?php echo form_error('type'); ?></span>
            </div>
          </div>
                    
                    
          <div class="form-group form-border" style="padding-top:0!important;">
            
                 <label class='col-sm-12 control-label field-title' for="name">Title<span class="required">* </span><span id="err_title"></span>
                    <!-- <p>(e.g. Innovation Management - Please give a short and clear title)</p> -->
                 </label>
                <div class="col-sm-12">
                  
                  <input id="name" type="text" class="form-control form-height" placeholder="Name" name="name" maxlength="256" onblur="return check_name('name');" value="<?php echo set_value('name', (isset($media->alt_title)) ? $media->alt_title : ''); ?>"  />
                  <small id="ajax"></small>
                <span class="error"><?php echo form_error('name'); ?></span>
                </div>
        </div>
          <div class="form-group form-border top-padding">
            
            <label class='col-sm-12 control-label field-title' for='category_id'><?php echo lang('web_category')?> <span class="required">* </span><span id="err_category"></span>
             
            </label>
            <div class="col-sm-12">
              
                        <select name='category_id' id='category_id' class="form-control form-height">

                            <option value="">Select Category</option>

                              <?php foreach ($categories as $category): ?>

                                          <option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>

                              <?php endforeach ?>

                       </select>



                        <span class="error"><?php echo form_error('category_id'); ?></span>
          </div>
          <a href="<?php echo base_url(); ?>admin/mcategories/createcategory" id="cropcategory" class="newcat_pop btn btn-success btn-border-blue" style="margin-left: 20px;">Create New Category</a>
            
          </div>
                   
          <div class="form-group form-border chkbox_top_padding" style="display: none;">
            <div class="col-sm-12">
            <div class="grey-background">
              <div class="checkbox">
                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($media->publish)) && $media->publish == '1' ? "checked" : ''; ?> <?php echo $updType == 'create' ? 'checked':''; ?> />
                    <label class='labelforminline dark_label' for='published'> Publish </label>
              </div>
            </div>
            </div>
          </div>
   <?php
    
    $vmedia = (strtolower($mediatypeval)=='video')? '' : 'none'; ?>

    <div id="videoblock" style="display: block; margin: 20px 0 0 0;">

  
<div class="col-md-12">
    
  
        <label>
        Select File Source <span id="err_upload"></span>
        </label>
     
  
        <fieldset class="adminform form-horizontal form-groups-bordered">
     <div class="form-group">

          <div id="localfile_v1" style='display:block'>
              <div class="col-sm-12">
                <div id="videoUploader">

                  <div class="qq-uploader">
                      <div class="qq-upload-button" style="position: relative; direction: ltr;">
                          <input type="file" name="file_f" id="file_f" class="upload_btn">    
                        <?php  $videopath = (isset($media->local)) ? $media->local : ''; ?>
                          <input type="hidden" value="<?php echo ($this->input->post('videopath')) ? $this->input->post('videopath') : $videopath ?>" name="videopath" id="videopath">

                      </div>
                      (Allowed file types: rar, zip, doc, docx, ppt, pptx, pdf, txt, jpg, png, gif, bmp,swf, mp3) 
                  </div>


                </div>
              </div>
                 <div id="video_media">
                 </div>
                 <font color="#FF0000"></font>
                 </fieldset>
        
    

</div>
    <?php 
    
   $amedia = (strtolower($mediatypeval)=='audio')? '' : 'none'; ?>



  <div id="audioblock" style="display:none;"></div>
   <?php 
   $dmedia = ($mediatypeval=='docs' || $mediatypeval=='Document')? '' : 'none'; ?>
  <div id="docsblock" style="display:none;"></div>
    <?php $umedia = ($mediatypeval=='url')? '' : 'none'; ?>
  <div id="urlblock" style="display:<?php echo ($this->input->post('type')== 'url') ? 'block' : $umedia ?>"></div>
<div id="imageblock" style="display:none;"></div>
     <?php $textmedia = ($mediatypeval=='text')? '' : 'none'; ?>
  <div id="textblock" style="display:<?php echo ($this->input->post('type')== 'text') ? 'block' : $textmedia; ?>">
<div class="col-md-12">
    
  
        <div class="panel-title">
          Enter text
        </div>
      
    
      
     
        <fieldset class="adminform form-horizontal form-groups-bordered">
          <table class="adminform">
      <tbody>
        <tr>
        <td width="33%">
              <label class='labelform' for="description"><?php echo lang('web_description')?> <span class="required">*</span></label>
          </td>
          <td>
            <textarea id="description" name="description"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($media->code)) ? $media->code : ''); ?></textarea>
                      <?php echo form_error('description'); ?>
          </td>
        </tr>
      </tbody>
      </table>
        </fieldset>
    
  </div>
  </div>
    <?php 
    
    $filemedia = ($mediatypeval=='Flash')? '' : 'none'; ?>

    <div id="file_media" class="col-sm-12" style="margin-top:20px">
        <?php if(isset($media->media_title)){ 

          $exploded = explode('.',$media->media_title);
                        $img = array('jpg','jpeg','gif','png');
                        $video = array('mp4','mov','ogg','avi','flv','wmv','mpeg');
                        if(in_array(end($exploded), $img))
                        {
                       ?>
                        <img width='341' height='auto' src="<?php echo base_url() ?>public/uploads/files/<?php echo $media->media_title ?>">
                    <?php  }
                      else if(in_array(end($exploded), $video)){ ?>
                       <video  controls class="playerio plyr--video vplyr" id="playerio_1" preload="metadata">
                        <source src="<?php echo base_url();?>public/uploads/videos/<?php echo $media->media_title; ?>#t=05,00" type="video/mp4">
                      </video>
                  <?php    }
                    else echo 'Media source:'.$media->media_title;
                   } ?>
    </div>
  <div id="fileblock" style="display:none;">
        <div class="col-md-12">
   
     
        <div class="field-title">
          Select file source
        </div>
   
      
        <fieldset class="adminform form-horizontal form-groups-bordered">
                </fieldset>
                        </div> 
                    </div>
    
 
          <div class="form-group form-border" style="padding-top: 2.5%!important;">
            <div class="col-sm-5">
      <a>
      <?php echo form_submit( 'submit', ($updType == 'edit') ? "Update" : "Create", "id='submit' class='btn btn-default btn-green' onclick='return validation()'"); ?>
      </a>
      <a href='<?php echo base_url(); ?>admin/medias/' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>
            </div>
          </div>
        <!-- </form> -->
        
      </div>
  
<?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>
<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$media->id) ?>
<?php endif ?>
<?php echo form_close(); ?>
</div>
<script type="text/javascript">
	$("#file_f").change(function () {
   var val = $(this).val();
   switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
      case 'jpg': case 'png': case 'gif': case 'bmp': case 'jpeg': case 'rar': case 'zip': case 'doc':
      case 'docx': case 'ppt': case 'pptx': case 'pdf': case 'txt': case 'swf': case 'mp3':
         break;

      default:
         $(this).val('');
         $("#err_upload").fadeIn().html("This file type is not allowed").css('color','red');
         setTimeout(function () {
            $("#err_upload").html("");
         }, 3000);
         break;
   }
});
function validation()
{
    var name = $("#name").val().trim();
    var category_id = $("#category_id").val();
    var file_f = $("#file_f").val();
    var submit = $("#submit").val();

    if(name=="")
    {
          $("#err_title").fadeIn().html(" Please enter Title").css('color','red');
          setTimeout(function(){$("#err_title").html("");},3000);
          $("#name").focus();
          return false;
    }
    if(category_id=="")
    {
          $("#err_category").fadeIn().html(" Please select Category").css('color','red');
          setTimeout(function(){$("#err_category").html("");},3000);
          $("#category_id").focus();
          return false;
    }
    if(submit == "Create"){
        if(file_f=="")
        {
              $("#err_upload").fadeIn().html(" Please upload file").css('color','red');
              setTimeout(function(){$("#err_upload").html("");},3000);
              $("#file_f").focus();
              return false;
        }
    }
}

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
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />
<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function(){
    $j(".newcat_pop").colorbox({
    iframe:true,
    width:"500px", 
    height:"70%",
    fadeOut:500,
    fixed:true,
    reposition:true,  
    })
     });
</script>
<script>
jQuery(document).ready(function(){
    $j('#upload_file').submit(function()
    {   
          var name = $j('#name').val();
          var cat = $j('#category_id').val();
          var file = $j('#file_f').val();
          if(name && cat  && file)
          {
           $j("input[type='submit']", this)
          .val("Please Wait...")
          .attr('disabled', 'disabled');
          return true;
          }

        });
});

jQuery(document).on('ready', function(){
  const options = {
    settings: [''],
    volume: 0.5,
};
    
    str = new Plyr('#playerio_1', options);

  });

  
</script>