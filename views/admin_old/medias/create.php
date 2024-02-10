<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<link rel="stylesheet" type="text/css" href="/public/css/category_css/category.css"> 
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
          
         
          
      /*$('body,html').animate({ scrollTop: 0 }, 200); */

            if(msg == 'success')

            {

                
                $("#ajax").css({"color": "red","padding-left": "300px"});
                $("#ajax").html('Already Exist');
                jQuery("#"+fldid).val('');



               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */

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

//jQuery(document).ready(function($) {

//$('#title').val()
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

   // alert(local_locald);

    if(local_locald == true){
     var local_vala = document.getElementById("source_local_d2").value;
    }
    // alert(local_locald);

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

                 /* $('#description').redactor({
                      focus: true,
                      imageUpload: window.location.origin+'/admin/medias/getImage',
                          
                    });*/
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



         //  document.getElementById("localfile_a1").style.display = 'none';



           document.getElementById("localfile_a2").style.display = 'none';



       //    document.getElementById("localfile_a3").style.display = 'none';



         }



         if(conval=='url')



         {



           document.getElementById("code_a").style.display = 'none';



           document.getElementById("url_a").style.display = 'block';



        //   document.getElementById("localfile_a1").style.display = 'none';



           document.getElementById("localfile_a2").style.display = 'none';



         //  document.getElementById("localfile_a3").style.display = 'none';



         }



         if(conval=='local')



         {



           document.getElementById("code_a").style.display = 'none';



           document.getElementById("url_a").style.display = 'none';



          // document.getElementById("localfile_a1").style.display = 'block';



           document.getElementById("localfile_a2").style.display = 'block';



          // document.getElementById("localfile_a3").style.display = 'block';



         }



    }







    function displayContainer(conval)



    {



         //alert(conval);



         if(conval=='code')



         {



            document.getElementById("code_v").style.display = 'block';



            document.getElementById("url_v").style.display = 'none';



            document.getElementById("url_v1").value = '';



            document.getElementById("localfile_v1").style.display = 'none';



         //   document.getElementById("localfile_v2").style.display = 'none';



      //      document.getElementById("localfile_v3").style.display = 'none';



         }



        if(conval=='url')



         {



            document.getElementById("code_v").style.display = 'none';



            document.getElementById("code_v1").value = '';



            document.getElementById("url_v").style.display = 'block';



            document.getElementById("localfile_v1").style.display = 'none';



          //  document.getElementById("localfile_v2").style.display = 'none';



          //  document.getElementById("localfile_v3").style.display = 'none';



         }



         if(conval=='local')



         {



            document.getElementById("code_v").style.display = 'none';



            document.getElementById("url_v").style.display = 'none';



            document.getElementById("localfile_v1").style.display = 'block';



           // document.getElementById("localfile_v2").style.display = 'block';



        //    document.getElementById("localfile_v3").style.display = 'block';



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



  //document.getElementById('source_local'+adding_ext).checked = '';



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



  //document.getElementById('source_local'+adding_ext).checked = '';



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

$attributes = array('class' => 'tform', 'id' => 'upload_file','name' => 'tform');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/medias/create', $attributes) : form_open_multipart(base_url().'admin/medias/edit/'.$id, $attributes);
?>
<!--top content area-->

<div id="toolbar-box"> 
  <div class="m top_main_content">
  <div id="toolbar" class="toolbar-list">
  <div class="clr"></div>
  </div>
<div class="col-sm-12 pagetitle icon-48-generic no-padding"><h2><?php echo ($updType == 'create') ? 'Create Media' : 'Edit Media'?></h2></div>
</div>
</div>


<div>
    <?php if ($updType == 'edit'):

    $mediatypeval = $media->type;
    else:
    $mediatypeval = null;
        endif;
     ?>
  <!-- <span class="clearFix">&nbsp;</span> -->
</div>



<div class="field_container">
<div class="row">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">    
    <div class="panel panel-primary primary-border" data-collapsed="0">
    
      <div class="panel-heading">
        <!-- <div class="panel-title">
          Media details
        </div> -->
        
        <!-- <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      
      <div class="panel-body form-body">
        
        <form role="form" class="form-horizontal form-groups-bordered">
          
                    <div class="form-group form-border" style="display: none;">
            
                        <label class='col-sm-12 control-label field-title' for="type">Type <span class="required">*</span>
                          <p>(Please select your Type)</p>
                        </label>
                      <div class="col-sm-12">
              
                        <select class="form-control form-height" size="1" name="type" id="type">

                            <option value="file">File</option>
                           <!--  <option value="video"<?php echo lcfirst($media->type) == 'video' ? 'selected' : '' ?>  >Video</option>
                            <option value="audio"<?php echo lcfirst($media->type) == 'audio' ? 'selected' : '' ?>  >Audio</option>
                            <option value="docs"<?php echo (lcfirst($media->type) == 'document' || lcfirst($media->type) == 'docs') ? 'selected' : '' ?>  >document</option>
                            <option value="image"<?php echo lcfirst($media->type) == 'image' ? 'selected' : '' ?>  >Image</option>
                            <option value="file"<?php echo lcfirst($media->type) == 'flash' ? 'selected' : '' ?>  >Flash</option> -->
                            

                          </select>

            <!-- tooltip area -->

                                  <!-- <span class="tooltipcontainer">

                                  <span type="text" id="type-target" class="tooltipicon" title="Click Here"></span>

                                  <span class="type-target  tooltargetdiv" style="display: none;" >

                                  <span class="closetooltip"></span>

                                 

                                  <?php echo lang('media_fld_type');?>

                                  

                                  </span>

                                  </span> -->

            <!-- tooltip area finish -->

                        <span class="error"><?php echo form_error('type'); ?></span>
                    </div>
          </div>
                    
                    
          <div class="form-group form-border" style="padding-top:0!important;">
            
                 <label class='col-sm-12 control-label field-title' for="name"><?php echo lang('web_name')?> <span class="required">*</span>
                    <p>(e.g. Innovation Management - Please give a short and clear title)</p>
                 </label>
                <div class="col-sm-12">
                  
                  <input id="name" type="text" class="form-control form-height" placeholder="Name" name="name" maxlength="256" onblur="return check_name('name');" value="<?php echo set_value('name', (isset($media->alt_title)) ? $media->alt_title : ''); ?>"  />
                  <small id="ajax"></small>

    <!-- tooltip area -->

                <!-- <span class="tooltipcontainer">

                <span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>

                <span class="name-target  tooltargetdiv" style="display: none;" >

                <span class="closetooltip"></span>

                

                <?php echo lang('media_fld_name');?>

                

                </span>

                </span> -->

    <!-- tooltip area finish -->

                <span class="error"><?php echo form_error('name'); ?></span>
                </div>
        </div>
                    
          
          <div class="form-group form-border top-padding">
            
            <label class='col-sm-12 control-label field-title' for='category_id'><?php echo lang('web_category')?> <span class="required">*</span>
              <p>(Select this option if you want to create a sub-category)</p>
            </label>
            <div class="col-sm-12">
              
                        <select name='category_id' id='category_id' class="form-control form-height">

                            <option value="">Select Category</option>

                              <?php foreach ($categories as $category): ?>

                                          <option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>

                              <?php endforeach ?>

                       </select>

<!-- tooltip area -->

           <!--  <span class="tooltipcontainer">

            <span type="text" id="category_id-target" class="tooltipicon" title="Click Here"></span>

            <span class="category_id-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

           

            <?php echo lang('media_fld_category');?>

            

            </span>

            </span> -->

<!-- tooltip area finish -->

                        <span class="error"><?php echo form_error('category_id'); ?></span>
          </div>
          <a href="<?php echo base_url(); ?>admin/mcategories/createcategory" id="cropcategory" class="newcat_pop btn btn-success btn-border-blue" style="margin-left: 20px;">Create New Category</a>
            
          </div>
                   
          <div class="form-group form-border chkbox_top_padding" style="display: none;">
            <div class="col-sm-12">
            <div class="grey-background">
              <div class="checkbox">
                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($media->publish)) && $media->publish == '1' ? "checked" : ''; ?> <?php echo $updType == 'create' ? 'checked':''; ?> />



              <!--<input id="published" type="checkbox" name="published" value='1' <?php echo preset_checkbox('published', '1', (isset($media->published)) ? $media->published : ''  )?> /> -->



            <label class='labelforminline dark_label' for='published'> <?php echo lang('web_is_active')?> </label>



<!-- tooltip area -->

           <!--  <span class="tooltipcontainer">

            <span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>

            <span class="published-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            
            <?php echo lang('media_fld_active');?>

           

            </span>

            </span> -->

<!-- tooltip area finish -->
              </div>
              
            </div>
            </div>
          </div>
                    
          
                    <div class="form-group chkbox_top_padding form-border">
            
            <label class='col-sm-12 control-label field-title' for="instructions">Sub Title / Instruction:<?php //echo lang('web_description')?> </label>
            <div class="col-sm-12">
              
                            <!--  <textarea id="instructions"  name="instructions"  />
               <?php //echo set_value('instructions', (isset($media->instructions)) ? $media->instructions : ''); ?> -->
               <!--</textarea>-->



                           <?php //$this->ckeditor->editor("instructions",($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''));?>
 
              <textarea class="form-control select-box-border" id="instructions" placeholder="TextSub Title / Instructionarea" name="instructions"/><?php echo trim(($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''));?></textarea>



<!-- tooltip area -->

           <!--  <span class="tooltipcontainer">

            <span type="text" id="instructions-target" class="tooltipicon" title="Click Here"></span>

            <span class="instructions-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            

            <?php echo lang('media_fld_instruction');?>

            

            </span>

            </span> -->

<!-- tooltip area finish -->
            </div>
          </div>
                    
          
          
            
   <?php
    
    $vmedia = (strtolower($mediatypeval)=='video')? '' : 'none'; ?>

    <div id="videoblock" style="display: block; margin: 20px 0 0 0;">

  
<div class="col-md-12">
    
    <div class="panel panel-primary">
    
      <div class="panel-heading">
        <div class="panel-title">
        Select File Source
        </div>
               <!--  <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
        
      </div>
            
      
      <div class="panel-body">
        
        <fieldset class="adminform form-horizontal form-groups-bordered">
     <div class="form-group">
                    
            <!-- <div id="code_v" style='display:none'>
            <label for="field-ta" class="col-sm-3 control-label">Enter Video Code :</label>
            
            <div class="col-sm-5">
              
                        <textarea onpaste="javascript:change_radio_code()" onkeypress="javascript:change_radio_code()" name="code_v" cols="25" style='resize:none' id='code_v1' class='form-control'>

            <?php echo ($this->input->post('code_v')) ? $this->input->post('code_v') : ((isset($media->code)) ? $media->code : ''); ?>

            </textarea>

            </div>
            </div> -->
          
                      <!-- <div id="url_v" style='display:none'>
            <label for="field-1" class="col-sm-3 control-label">Video URL :</label>
            
            <div class="col-sm-5">
            
                                <input class="form-control" type="text" onchange="javascript:hide_hidden_row();" name="url_v" value="<?php echo ($this->input->post('url_v')) ? $this->input->post('url_v') : ((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url()" id='url_v1'>
                <div style="float:left;">

                              <a href="https://www.youtube.com" target="_blank">
                             <img src="<?php echo base_url(); ?>public/classic/images/red/social-icons-youtube.png" width="32px" height="64px">
                            </a>
                            </div>

                        </div>
                   
            </div> -->
                    
          <div id="localfile_v1" style='display:block'>
            <label for="field-1" class="col-sm-3 control-label">Upload :</label>
            <div class="col-sm-5">

                <div id="videoUploader">

                  <div class="qq-uploader">
                      <div class="qq-upload-button" style="position: relative; direction: ltr;">
                          <input type="file" name="file_f" id="file_f" class="upload_btn">    
                        <?php  $videopath = (isset($media->local)) ? $media->local : ''; ?>
                          <input type="hidden" value="<?php echo ($this->input->post('videopath')) ? $this->input->post('videopath') : $videopath ?>" name="videopath" id="videopath">

                      </div>
                      (Allowed file types: rar, zip, doc, docx, ppt, pptx, pdf, txt, jpg, png, gif, bmp,swf, mp3, avi, mp4, mpeg) 
                  </div>


                </div>
                 <div id="video_media">
                   <script type="text/javascript">
                      jQuery('#video_media').load("<?php echo base_url();?>admin/medias/ajaxmediaview_new/"+ <?php echo $media->id; ?>+"/1");
                   </script>>

                 </div>

                 <font color="#FF0000"></font>
                 </fieldset>
        
      </div>
    
    </div>
  
  </div>


</div>

  <!--audio section starts here-->



    <?php 
    
   $amedia = (strtolower($mediatypeval)=='audio')? '' : 'none'; ?>



  <div id="audioblock" style="display:none;">



  <!--<div id="audioblock"  style="display:<?php echo ($mediatypeval=='audio')? '' : 'none';?>;">       -->





<div class="col-md-12">
    
    <div class="panel panel-primary" data-collapsed="0">
    
      <div class="panel-heading">
        <div class="panel-title">
          Select audio source
        </div>
        
       <!--  <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      
      <div class="panel-body">
        
        <!--<form role="form" class="">-->
        <fieldset class="adminform form-horizontal form-groups-bordered">
          <!-- <div class="form-group">
                    <label class="col-sm-3 control-label">Audio:<font color="#ff0000">*</font></label>
            <div class="col-sm-5">
              <div class="radio">
                <label>
                  <input type="radio" name="source_a" value="code" onchange='displayContainerAudio(this.value)' <?php echo ($this->input->post('source_a') == "code") ? "checked" : (isset($media->source) && $media->source == 'code') ? "checked" : ''; ?> id="source_code_a">Audio Code
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" onchange="javascript:displayContainerAudio(this.value);" name="source_a" value="url" <?php echo ($this->input->post('source_a') == 'url') ? "checked" : (isset($media->source) && $media->source == 'url') ? "checked" : '' ?> id="source_url_a">Audio URL
                </label>
              </div>
                            <div class="radio">
                <label>
                  
                                    <input type="radio" onchange='displayContainerAudio(this.value)' name="source_a" value="local" <?php echo ($this->input->post('source_a') == "local") ? "checked" : (isset($media->source) && $media->source == 'local') ? "checked" :'';?> id="source_local_a2">Upload new media 
                </label>
              </div>
            </div>
          </div> -->
                    
                    
                    
                    
                    <!-- <div class="form-group" >
            <label for="field-ta" class="col-sm-3 control-label"></label>
            
            <div class="col-sm-5">
              <textarea onpaste="javascript:change_radio_code()" onkeypress="javascript:change_radio_code()" name="code_a" id="code_a" cols="35" class="form-control" style="display: none;"><?php echo ($this->input->post('code_a')) ? $this->input->post('code_a') : ((isset($media->code)) ? $media->code : ''); ?></textarea>
            </div>
          </div>
                    
                    <div class="form-group" >
            <label for="field-1" class="col-sm-3 control-label"></label>
            
            <div class="col-sm-5">
              <input type="text" onchange="javascript:hide_hidden_row();" name="url_a" id="url_a" value="<?php echo ($this->input->post('url_a')) ? $this->input->post('url_a') : ((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url();" style="display: none;" class="form-control">

            </div>
          </div> -->
          
          
          
          <div class="form-group" id="localfile_a2" style="display:block;">
            <label for="field-1" class="col-sm-3 control-label">Upload:</label>
            <div class="col-sm-5">
                            <div id="audioUploader">
                              <div class="qq-uploader">
                                  <div class="qq-upload-drop-area" style="display: none;">
                                      <span>Drop files here to upload</span>
                                    </div>
                                        
                  <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
                                    Choose file
                                    <input type="file" class="form-control" name="file_a" id="file_a" accept="audio/*" >
                                    <small>(Only .mp3 files are allowed )</small>
                  <?php  $audiopath = (isset($media->local)) ? $media->local : ''; ?>

                <input type="hidden" value="<?php echo ($this->input->post('audiopath')) ? $this->input->post('audiopath') : $audiopath ?>" name="audiopath" id="audiopath">
                  
                  <div id="audio_media">
                   <script type="text/javascript">
                      jQuery('#audio_media').load("<?php echo base_url();?>admin/medias/ajaxmediaview_new/"+ <?php echo $media->id; ?>+"/1");
                   </script>

                 </div>

                                    </div>
                                    <ul class="qq-upload-list">
                                    </ul>
                </div>
              </div>
                           <!-- <font color="#FF0000"></font>
                            <div id="localfile_a2" style="display: none;">
                Choose a local audio<br>
                       <font size="1">(Upload via FTP to media/audiofolder)</font>
                            </div>
                            
                            <div id="localfile_a3" style="display:none;">
                            <label class="col-sm-3 control-label">Now selected : Select List</label> 
                      <div class="col-sm-5"> 
                          <select class="form-control" id="localfile_a" name="localfile_a" size="10" onchange="change_radio_local();" onclick="change_radio_local();">
                <option value="0">...</option>
                <?php foreach($ftpaudio as $audiofile):?>
                <option value="<?php echo $audiofile->filename;?>" <?php echo  ($this->input->post('localfile_a') == $audiofile->filename) ? "selected" : (isset($media->local) && $media->local == $audiofile->filename) ? "selected" : ''?>><?php echo $audiofile->filename;?></option>
                <?php endforeach;?>
              </select> 
                        </div> 
                            </div>-->
                            
            </div>
          </div>
                    
                
          
                    
                   <!-- <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Size</label>
            
            <div class="col-sm-3">
              
                            <input type="text" class="form-control" name="width_a" value="<?php echo ($this->input->post('width_a')) ? $this->input->post('width_a') :((isset($media->          width)) ? $media->width : ''); ?> " size="10">
              <span class="error" id="error"><?php echo form_error('width_a'); ?></span>
              <input type="hidden" name="height_a" value="20" size="10">
              px wide
            </div>
          </div>-->
                    
                    
        <!--</form>--></fieldset>
        
      </div>
    
    </div>
  
  </div>






    



  </div>



  <!--documents section starts here-->



   <!-- <div id="docsblock"  style="display:<?php echo ($mediatypeval=='docs')? '' : 'none';?>;">   -->



   <?php 
//echo"<pre>";
//print_r($media);
   
   $dmedia = ($mediatypeval=='docs' || $mediatypeval=='Document')? '' : 'none'; ?>



  <div id="docsblock" style="display:none;">



    


<div class="col-md-12">
    
    <div class="panel panel-primary" data-collapsed="0">
    
      <div class="panel-heading">
        <div class="panel-title">
          Select Document Source
        </div>
        
        <!-- <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      
      <div class="panel-body">
        
        <!--<form role="form" class="form-horizontal form-groups-bordered">-->
          <fieldset class="adminform form-horizontal form-groups-bordered">
          <!-- <div class="form-group">
                     <label class="col-sm-3 control-label">Document:<font color="#ff0000">*</font></label>
            <div class="col-sm-5">
              <div class="radio">
                <label>
                                    <input type="radio" onchange="javascript:displayContainerDoc(this.value);" name="source_d" value="url" <?php echo ($this->input->post('source_d') == 'url') ? "checked" : (isset($media->source) && $media->source == 'url') ? "checked" : ''; ?> id="source_url_d">Document URL
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" onchange="javascript:displayContainerDoc(this.value);" name="source_d" value="local" <?php echo ($this->input->post('source_d') == 'local') ? "checked" : (isset($media->source) && $media->source == 'local') ? "checked" : ''; ?> id="source_local_d2">Upload new media 
                </label>
              </div>
                           
            </div>
          </div> -->
                    
                    
                    
                    <!-- <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"></label>
            
            <div class="col-sm-5">
                            <input type="text" class="form-control" name="url_d" id="url_d" value="<?php echo ($this->input->post('url_d')) ? $this->input->post('url_d') : ((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url()" style="<?php echo (@$media->url) ? '' : 'display: none;' ?>">
            </div>
          </div> -->
          
          
          
          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label"></label>
            
            <div class="col-sm-5">
              
                            <div id="localfile_d1" style="display: block;">
              Upload:
              <div id="docUploader"><div class="qq-uploader"><div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>

              <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file

              <input type="file" name="file_d" id="file_d"  class="form-control" accept="application/pdf,.txt,.doc,.csv">
              <?php  $docpath = (isset($media->local)) ? $media->local : ''; ?>

                <input type="hidden" value="<?php echo ($this->input->post('docpath')) ? $this->input->post('docpath') : $docpath ?>" name="docpath" id="docpath">
              
              </div>

              <div id="doc_media">
                   <script type="text/javascript">
                      jQuery('#doc_media').load("<?php echo base_url();?>admin/medias/ajaxmediaview_new/"+ <?php echo $media->id; ?>+"/1");
                   </script>

                 </div>


              <ul class="qq-upload-list"></ul></div></div>

              <font color="#FF0000"></font>                 
                            </div>
                            
                           <!-- <div id="localfile_d2" style="display: none;">
              Choose a local document<br>

                    <font size="1">(Upload via FTP to media/documentsfolder)</font>

            <div id="localfile_d3" style="display: none;">
            <label class="col-sm-3 control-label">Now selected:</label>
            
            <div class="col-sm-5">
              

          <select class="form-control" onclick="change_radio_local();" onchange="change_radio_local();" size="10" name="localfile_d" id="localfile_d">



          <option value="root">../</option>



          <?php foreach($ftpdocuments as $docfile):?>



          <option value="<?php echo $docfile->filename;?>" <?php echo ($this->input->post('localfile_d') == $docfile->filename) ? "selected" : (isset($media->local)) ? "selected" : ''?>><?php echo $docfile->filename;?></option>



          <?php endforeach;?>



          </select>



                    </div>
                            
            </div>

                    </div>-->
            </div>
          </div>
          
                    <!--<div class="form-group">
                    
            <label class="col-sm-3 control-label">Display:</label>
            
            <div class="col-sm-5">
              

          
                    
                    
                    <script type="text/javascript">



                function wh(y){



                  if(y==1){



                    document.getElementById('whdoc').style.display='';



                  }



                  if (y==0) {



                    document.getElementById('whdoc').style.display='none';



                  }



                }



              </script>



                            <?php



                            //echo $media->width;



                             $wrapper = (isset($media->width) && $media->width != '0') ? "selected" : '';



                             $link = (isset($media->width) && $media->width == '0') ? "selected" : ''; ?>



                <select name="display_as" id="display_as" class="form-control">



                  <option onclick="javascript:wh(1)" value="wrapper" <?php echo ($this->input->post('display_as') == 'wrapper') ? "selected" : $wrapper; ?>>Wrapper</option>



                  <option onclick="javascript:wh(0)" value="link" <?php echo ($this->input->post('display_as') == 'link') ? "selected" : $link; ?>>Link</option>



                </select>


               
            </div>
          </div>-->
                    
                    <?php



               $size_div = ($this->input->post('display_as') && $this->input->post('display_as') == 'link') ? 'display:none' : ((isset($media->width) && $media->width == '0') ? 'display:none' : '');



                ?>

                    
                  <!--  <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Size</label>
            
                         <div>
                            <div  class="col-sm-2">
                             
                                <input class="form-control" type="text" name="width" value="<?php echo ($this->input->post('width')) ? $this->input->post('width') : ((isset($media->width)) ? $media->width : '600'); ?>" size="10">
                                <span class="error" id="error_56"><?php echo form_error('width'); ?></span>
                            </div>
                            <div class="col-sm-2">
              
                             
              <input class="form-control" type="text" name="height" value="<?php echo ($this->input->post('height')) ? $this->input->post('height') :  ((isset($media->height)) ? $media->height : '800'); ?>" size="10">
                                <span class="error" id="error_56"><?php echo form_error('height'); ?></span>
                            </div>
                            <div class="col-sm-2">
                                (Width X Height) &nbsp;
                            </div>

                        </div>
                        
          </div>-->
                    
                    </fieldset>
        <!--</form>-->
        
      </div>
    
    </div>
  
  </div>


</div>



  <!--url section starts here-->







  <!--<div id="urlblock"  style="display:<?php echo ($mediatypeval=='url')? '' : 'none';?>;"> -->



    <?php $umedia = ($mediatypeval=='url')? '' : 'none'; ?>



  <div id="urlblock" style="display:<?php echo ($this->input->post('type')== 'url') ? 'block' : $umedia ?>">



    








<div class="col-md-12">
    
    <div class="panel panel-primary" data-collapsed="0">
    
      <div class="panel-heading">
        <div class="panel-title">
          Enter Url
        </div>
        
       <!--  <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      
      <div class="panel-body">
        
        <!--<form role="form" class="form-horizontal form-groups-bordered">-->
  
          <fieldset class="adminform form-horizontal form-groups-bordered">
                    
                    <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">URL:</label>
            
            <div class="col-sm-5">
              
                             <?php //echo ($this->input->post('url')) ? $this->input->post('url') :  ((isset($media->url)) ? $media->url : 'http://'); ?>

                        <input class="form-control" type="text" name="url" value="<?php echo ($this->input->post('url')) ? $this->input->post('url') :  ((isset($media->url)) ? $media->url : 'http://'); ?>" size="80">
  
                         <span class="error" id="error_56"><?php echo form_error('url'); ?></span>
                              <font color="#FF0000">Enter full URL, example: http://ijoomla.com</font>
            </div>
          </div>
          
          
          
          
          
          <!-- <div class="form-group">
            <label class="col-sm-3 control-label">Display :</label>
            
            <div class="col-sm-5">
              
                            <select name="display_as2" class="form-control">



              <option value="wrapper" <?php echo ($this->input->post('display_as2') == 'wrapper') ? "selected" : (isset($media->width) && $media->width == 0) ? "selected" : '' ?> >Wrapper</option>



          <option value="link" <?php echo ($this->input->post('display_as2') == 'link') ? "selected" : (isset($media->width) && $media->width == 1) ? "selected" : '' ?>>Link</option>



        </select>
            </div>
          </div>-->
                    
                    
                    
                    </fieldset>
        <!--</form>-->
        
      </div>
    
    </div>
  
  </div>




    



  </div>



  <!--image section starts here-->



  <!--<div id="imageblock"  style="display:<?php echo ($mediatypeval=='image')? '' : '';?>;"> -->



    <?php 
    //echo $mediatypeval;
    //echo $imgmedia = (strtolower($mediatypeval)=='image')? '' : 'none'; ?>



  <div id="imageblock" style="display:none;">



    



    

<div class="col-md-12">
    
    <div class="panel panel-primary" data-collapsed="0" style="border:none;">
    
      <div class="panel-heading">
        <div class="panel-title" style="padding-left:0;">
          Select Image
        </div>
        
        <!-- <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      
      <div class="panel-body" style="padding: 0px;">
        
        <!--<form role="form" class="" enctype="multipart/form-data">-->
          <fieldset class="adminform form-horizontal form-groups-bordered">
                    <div class="form-group form-border">
            <label for="field-1" class="col-sm-12 field-title control-label">Image:<font color="#ff0000">*</font></label>
            
            <div class="col-sm-5">
              
                            <div id="imageUploader"><div class="qq-uploader"><div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>



         <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">



         <!--Choose file-->



                <input type="file" name="file_i" id="file_i" class="form-height form-control" style="display:block" accept="image/*">
        
        <?php  $imagepath = (isset($media->local)) ? $media->local : ''; ?>

                <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $imagepath ?>" name="imagename" id="imagename">



                <!-- <input id="image" type="file" name="image" />-->



                    <?php //print_r($ftpimage); ?>



                 </div>



                 <div id="localimage_i">



                   <?php $image_name = (isset($media->local)) ? $media->local : '';    ?>



                   <?php //if(isset($media->local)){   ?>



                    <?php if ($updType == 'edit'){ ?>

                    <div id="image_media">
                   <script type="text/javascript">
                      jQuery('#image_media').load("<?php echo base_url();?>admin/medias/ajaxmediaview_new/"+ <?php echo $media->id; ?>+"/1");
                   </script>

                 </div>

                   <!--<img src="<?php echo base_url();?>public/uploads/images/<?php if(isset($media->local)) echo $media->local; ?>" width="150" id="imgname">-->
           <!-- <img src="<?php echo base_url();?>public/uploads/images/<?php echo (isset($media->local)) ? $media->local : 'no_images.jpg' ?>" width="150" id="imgname"> -->
            <!-- <a href="<?php echo base_url(); ?>admin/medias/cropmediaimg" class="fancybox fancybox.iframe btn btn-success">Upload Image</a> -->
                   <?php }else{?>



                   <img src="<?php echo base_url();?>public/uploads/images/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg'?>" width="150" id="imgname">



                   <!-- <a href="<?php echo base_url(); ?>admin/medias/cropmediaimg" class="fancybox fancybox.iframe btn btn-success">Upload Image</a> -->



                   <?php } ?>  </div>



<input type="hidden" id="cropmedia" name="cropmedia" value="" >
             <input type="hidden" id="cropmediacopy" name="cropmediacopy" value="<?php echo (isset($media->local)) ? $media->local : 'no_images.jpg' ?>" >



                  <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $image_name ?>" name="imagename" id="imagename">



         <div id="messagestatus"></div>



         <ul class="qq-upload-list"></ul></div></div>












      <font color="#FF0000"></font>
            </div>
          </div>
          
                    
                    <!--<div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Image size:</label>
            
            <div class="col-sm-3">
              <div class="input-group">
                            <input type="text" value="<?php echo ($this->input->post('media_fullpx')) ? $this->input->post('media_fullpx') :  ((isset($media->media_fullpx)) ? $media->media_fullpx : ''); ?>" name="media_fullpx" id="media_fullpx" size="8" class="form-control">
                            <span class="input-group-addon">px</span>
                            <span class="error" id="error_56"><?php echo form_error('media_fullpx'); ?></span>
                            </div>
            </div>
                        
                        <div class="col-sm-3">
            
            <select id="media_prop" name="media_prop" class="form-control">

                            <option value="w"  <?php echo ($this->input->post('media_prop') == 'w') ? "selected" : (isset($media->width) && $media->width == 0) ? "selected" : '' ?>>Wide</option>
                            <option value="h"  <?php echo ($this->input->post('media_prop') == 'h') ? "selected" : (isset($media->height) && $media->height == 0) ? "selected" : '' ?>>High</option>
                        </select>
            </div>
                          <div style="display: inline;">
                        <input type="hidden" value="0" name="is_image" id="is_image">
                    </div>
          </div>-->
                    
                    <!--<div class="form-group"> 
                    <label for="field-1" class="col-sm-3 control-label">Current image:</label> 
                    <div class="col-sm-5"> 
                      <img border="0" src="../images/M_images/blank.png" alt="" style="margin:5px;" name="view_imagelist" id="view_imagelist23">
                  <input type="hidden" value="" name="image" id="image">
                    </div> 
                    </div>-->
          
        <!--</form>-->
                </fieldset>
        
      </div>
    
    </div>
  
  </div>

      



    



  </div>



  <!--text section starts here-->



  <!--<div id="textblock"  style="display:<?php echo ($mediatypeval=='text')? '' : 'none';?>;">-->



     <?php $textmedia = ($mediatypeval=='text')? '' : 'none'; ?>



  <div id="textblock" style="display:<?php echo ($this->input->post('type')== 'text') ? 'block' : $textmedia; ?>">



    


<div class="col-md-12">
    
    <div class="panel panel-primary" data-collapsed="0">
    
      <div class="panel-heading">
        <div class="panel-title">
          Enter text
        </div>
        
        <!-- <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      
      <div class="panel-body">
        <fieldset class="adminform form-horizontal form-groups-bordered">
        <!--<form role="form" class="form-horizontal form-groups-bordered">-->
  
          <table class="adminform">



      <tbody>



        <tr>



        <td width="33%">

              <label class='labelform' for="description"><?php echo lang('web_description')?> <span class="required">*</span></label>

          </td>



          <td>

                        <?php



                       // $code = ($this->input->post('description')) ? $this->input->post('description') : (isset($media->code)? $media->code : '');



                        //$this->ckeditor->editor("description",$code);

                        ?>

            <!--<textarea id="description" name="description"  /><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($media->description)) ? $media->description : ''); ?></textarea>-->
            <textarea id="description" name="description"  /><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($media->code)) ? $media->code : ''); ?></textarea>
                        <!--<textarea name="description" id="description" class="stinput" rows="6"></textarea>-->

                      <?php echo form_error('description'); ?>

          </td>

        </tr>

      </tbody>

      </table>
                                
                    
        <!--</form>-->
        </fieldset>
      </div>
    
    </div>
  
  </div>

  

  </div>

  <!--file section start here-->

   <!-- <div id="fileblock"  style="display:<?php echo ($mediatypeval=='file')? '' : 'none';?>;"> -->
    

    <?php 
    
    $filemedia = ($mediatypeval=='Flash')? '' : 'none'; ?>

  <div id="fileblock" style="display:none;">

    
       
        <div class="col-md-12">
    
    <div class="panel panel-primary" style="border:none;" data-collapsed="0">
    
      <div class="panel-heading">
        <div class="field-title">
          Select file source
        </div>
        
        <!-- <div class="panel-options">
          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div> -->
      </div>
      
      <div class="panel-body panel-gap">
        <fieldset class="adminform form-horizontal form-groups-bordered">
        <!--<form role="form" class="form-horizontal form-groups-bordered">-->
  
            <!--<div "zone_description">
                    only .zip files are accepted
                    </div>-->
                    
                    Select file source, only .zip files are accepted
          <!-- <div class="form-group">
                    <label class="col-sm-3 control-label">File:<font color="#ff0000">*</font></label>
            <div class="col-sm-5">
                        
              <div class="radio">
                <label>
                                    <input type="radio" onchange="javascript:displayContainerFile(this.value);" name="source_f" value="url" <?php echo ($this->input->post('source_f') == 'url') ? "checked" : ((isset($media->source) && $media->source == 'url') ? "checked" : ''); ?> id="source_url_f">File URL
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" onchange="javascript:displayContainerFile(this.value);" name="source_f" value="local" <?php echo ($this->input->post('source_f') == 'local') ? "checked" : (isset($media->source) && $media->source == 'local') ? "checked" : ''; ?> id="source_local_f2">Upload a new file 
                </label>
              </div>
            </div>
          </div> -->
                    
                   <!-- <div class="form-group"> 
                    <label for="field-1" class="col-sm-3 control-label"></label> 
                      <div class="col-sm-5">  
                            <input type="text" class="form-control" on="" onmouseout="doPreview();" onchange="javascript:hide_hidden_row();" name="url_f" id="url_f" value="<?php echo ($this->input->post('url_f')) ? $this->input->post('url_f') :((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url()" style="display: none;">
<div id="filePreview"></div>
            </div> 
          </div> -->
                    
                    <div class="form-group"> 
                      <label for="field-1" class="col-sm-12 control-label field-title"></label> 
                        <div class="col-sm-12"> 

                            <div id="localfile_f1" style="display: block;">
              Upload:
              <div id="fileUploader"><div class="qq-uploader"><div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>

              <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file

              <input type="file" name="file_f1" id="file_f1" class="form-control form-height" >
              <?php  $archpath = (isset($media->local)) ? $media->local : ''; ?>

                <input type="hidden" value="<?php echo ($this->input->post('archpath')) ? $this->input->post('archpath') : $archpath ?>" name="archpath" id="archpath">
              <div id="flash_media">
                   <script type="text/javascript">
                      jQuery('#flash_media').load("<?php echo base_url();?>admin/medias/ajaxmediaview_new/"+ <?php echo $media->id; ?>+"/1");
                   </script>>

                 </div>

              </div><ul class="qq-upload-list"></ul></div></div>

                <font color="#FF0000"></font>
              </div>
                            
                            
                           <!-- <div id="localfile_f2" style="display: none;">



                      Choose from existing uploaded files<br>



                                        </div>



                  


                                        <div id="localfile_f3" style="display: none;">



                      Now selected:                     <br>



                      <select id="localfile_f" name="localfile_f" size="10" onchange="change_radio_local();" onclick="change_radio_local();">



                      <option value="0">...</option>



                      <?php foreach($ftpfiles as $filefile):?>







                      <option value="<?php echo $filefile->filename;?>" <?php echo  ($this->input->post('localfile_f') == $filefile->filename) ? "selected" : (isset($media->local)) ? "selected" : '' ?> ><?php echo $filefile->filename;?></option>



                      <?php endforeach;?>



                      </select>



                                        </div>-->
                                        <!--<div id="filesFolder">http://mlms.puneitlab.com/media/files</div>
                    <a id="filePreviewList" style="visibility:hidden" href="#" class="a_mlms">Download</a>                               -->

                        </div> 
                    </div>
                    
        <!--</form>-->
                </fieldset>
        
      </div>
    
    </div>
  
  </div>

  

  </div>
                    
          
          
          <div class="form-group form-border" style="padding-top: 2.5%!important;">
            <div class="col-sm-5">
              
                       
      <a>

      <?php echo form_submit( 'submit', ($updType == 'edit') ? "Save Changes" : "Save Changes", (($updType == 'create') ? "id='submit' class='btn btn-default btn-green'" : "id='submit' class='btn btn-default btn-green'")); ?>

      </a>



      <a href='<?php echo base_url(); ?>admin/medias<?php //echo $parent_id?>/<?php //echo $page?>' class='btn btn-red btn-dark-grey'><span class="icon-32-cancel"> </span>Cancel</a>

            </div>
          </div>
        </form>
        
      </div>
    
    </div>
  
  </div>

  <!--Main fieldset-->

    <!--End Main fieldset-->
</div>
</div>
</div>

<?php //echo form_hidden('page',set_value('page', $page)) ?>

<?php echo form_hidden('parent_id',set_value('parent_id', $parent_id)) ?>

<?php if ($updType == 'edit'): ?>

<?php echo form_hidden('id',$media->id) ?>

<?php endif ?>

<?php echo form_close(); ?>

<div>



<!--<form method="post" action="" id="file_i_form">



      <label for="title">Title</label>



      <input type="text" name="title" id="title" value="" />



 <div id="messagestatus">







 </div>



      <label for="userfile">File</label>



      <input type="file" name="file_img" id="file_img" size="20" />







      <input type="submit" name="submit" id="submit" />



   </form>



</div>-->



<!-- tool tip script -->

<script type="text/javascript">

//$(document).ready(function(){
//
//  $('.tooltipicon').click(function(){
//
//  var dispdiv = $(this).attr('id');
//
//  $('.'+dispdiv).css('display','inline-block');
//
//  });
//
//  $('.closetooltip').click(function(){
//
//  $(this).parent().css('display','none');
//
//  });
//
//  });
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
    //Examples of how to assign the Colorbox event to elements

    //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"}); 
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
  $('#upload_file').submit(function()
{
  var name = $('#name').val();
  var cat = $('#category_id').val();
  var file = $('#file_f').val();
  if(name && cat  && file)
  {
   $("input[type='submit']", this)
  .val("Please Wait...")
  .attr('disabled', 'disabled');
  return true;
  }

});
// $("#submit").click(function(){
//    var name = $('#name').val();
//    var cat = $('#category_id').val();
//    var file = $('#file_f').val();
//    if(name && cat &&alert('yes');
//    $("#submit").attr("disabled", true);
//    }
// });
});

</script>