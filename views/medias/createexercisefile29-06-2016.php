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
}
label {
	display: inline-block !important;
}
textarea {
	width:500px !important; 
}
td, th {
	padding: 10px !important;
}

</style>
<!--<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>-->
<script src="<?php echo base_url(); ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>

<!--<script type="text/javascript">
//$(document).ready(function($) {
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
   $.ajaxFileUpload({
         url         :'<?php echo base_url(); ?>/medias/upload_file_'+fldtype+'/',
         secureuri      :false,
         fileElementId  :'file_'+fldtype,
         dataType    : 'json',
         data        : {
            'type'           : $('select#type').val()
         },
         success  : function (data, status)
         {
            if(data.status != 'error')
            {
               $('#msgstatus_'+fldtype).html('<p>Reloading files...</p>');
               $('#file_'+fldtype).val('');
			   $('#msgstatus_'+fldtype).html('');
              // $('#msgstatus_'+fldtype).html('');

                    if(fldtype == 'i')   {
                        ftpfileoptions =   '<img src="<?php echo base_url();?>public/uploads/images/'+data.ftpfilearray+'" width="150">';
                        $('#localimage_'+fldtype).html(ftpfileoptions);
                        ftpfilearray = data.ftpfilearray;
                        document.getElementById("imagename").value = ftpfilearray;
                    }else{
                        ftpfileoptions = '<option value="0">...</option>';
    				    $.each(data.ftpfilearray, function(i,item) {
    					//alert(item.filename);
    					ftpfileoptions += '<option value="'+item.filename+'">'+item.filename+'</option>';
    					});
                        $('#localfile_'+fldtype).html(ftpfileoptions);
				}  //});
			}
		 }
      });
      return false;
   });
});
//});
</script>-->

<script type="text/javascript">
window.onload = function() {



 	var local_upload = document.getElementById("source_local_v2").checked;



    if(local_upload == true){



     var local_val = document.getElementById("source_local_v2").value;



    }



    var local_url = document.getElementById("source_url_v").checked;



    if(local_url == true){



     var local_val = document.getElementById("source_url_v").value;



    }



    var local_code = document.getElementById("source_code_v").checked;



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
	function alldisable(type){

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



        //alert(type);



        if(type == 'text')



        {



         // $('#description').redactor(); // Comment on 3/jan/15 by jayesh



        }



		document.getElementById(type+"block").style.display = 'block';



	}



     function displayContainerFile(conval)



    {



         //alert(conval);



         if(conval=='url')



         {



           document.getElementById("url_f").style.display = 'block';



           document.getElementById("localfile_f1").style.display = 'none';



           document.getElementById("localfile_f2").style.display = 'none';



           document.getElementById("localfile_f3").style.display = 'none';



         }



         if(conval=='local')



         {



           document.getElementById("url_f").style.display = 'none'



           document.getElementById("localfile_f1").style.display = 'block';



           document.getElementById("localfile_f2").style.display = 'block';



           document.getElementById("localfile_f3").style.display = 'block';



         }



    }



    function displayContainerDoc(conval)



    {



         if(conval=='url')



         {



           document.getElementById("url_d").style.display = 'block';



           document.getElementById("localfile_d1").style.display = 'none';



          // document.getElementById("localfile_d2").style.display = 'none';



           document.getElementById("localfile_d3").style.display = 'none';



         }



         if(conval=='local')



         {



           document.getElementById("url_d").style.display = 'none'



           document.getElementById("localfile_d1").style.display = 'block';



          // document.getElementById("localfile_d2").style.display = 'block';



           document.getElementById("localfile_d3").style.display = 'block';



         }



    }







    function displayContainerAudio(conval)



    {



         if(conval=='code')



         {



           document.getElementById("code_a").style.display = 'block';



           document.getElementById("url_a").style.display = 'none';



           document.getElementById("localfile_a1").style.display = 'none';



           document.getElementById("localfile_a2").style.display = 'none';



           document.getElementById("localfile_a3").style.display = 'none';



         }



         if(conval=='url')



         {



           document.getElementById("code_a").style.display = 'none';



           document.getElementById("url_a").style.display = 'block';



           document.getElementById("localfile_a1").style.display = 'none';



           document.getElementById("localfile_a2").style.display = 'none';



           document.getElementById("localfile_a3").style.display = 'none';



         }



         if(conval=='local')



         {



           document.getElementById("code_a").style.display = 'none';



           document.getElementById("url_a").style.display = 'none';



           document.getElementById("localfile_a1").style.display = 'block';



           document.getElementById("localfile_a2").style.display = 'block';



           document.getElementById("localfile_a3").style.display = 'block';



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



            document.getElementById("localfile_v2").style.display = 'none';



            document.getElementById("localfile_v3").style.display = 'none';



         }



        if(conval=='url')



         {



            document.getElementById("code_v").style.display = 'none';



            document.getElementById("code_v1").value = '';



            document.getElementById("url_v").style.display = 'block';



            document.getElementById("localfile_v1").style.display = 'none';



            document.getElementById("localfile_v2").style.display = 'none';



            document.getElementById("localfile_v3").style.display = 'none';



         }



         if(conval=='local')



         {



            document.getElementById("code_v").style.display = 'none';



            document.getElementById("url_v").style.display = 'none';



            document.getElementById("localfile_v1").style.display = 'block';



            document.getElementById("localfile_v2").style.display = 'block';



            document.getElementById("localfile_v3").style.display = 'block';



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
<?php

$attributes = array('class' => 'tform', 'id' => 'upload_file','name' => 'tform');

echo ($updType == 'create') ? form_open_multipart(base_url().'medias/createexercisefile', $attributes) : form_open_multipart(base_url().'medias/createexercisefile'.$id, $attributes);

?>

<!--top content area-->

<div class="page-container">
  <div class="main-content">
    <div>
      <legend><?php echo ($updType == 'create') ? 'Create Media' : 'Edit Media'?></legend>
    </div>
    <?php if ($updType == 'edit'):
		$mediatypeval = $media->type;
		else:
		$mediatypeval = null;
		endif;
	?>
    <div class="panel panel-primary">
      <div class="panel-body" style="overflow-x: hidden;">
        <form role="form" class="form-inline">
          <div class="form-group">
            <label for="type">Type: <span class="required">*</span></label>
              <select onchange="changeType(this.value)" name="type" id="type">
                <option value="">- select -</option>
                <?php foreach($mediatype as $type){?>
                <?php if($type->name == 'docs' || $type->name == 'file') { ?>
                <option value="<?php echo $type->name;?>" <?php echo  preset_select('type', $type->name, (isset($media->type)) ? $media->type : ''  ) ?> > <?php echo $type->title;?> </option>
                <?php } } ?>
              </select>
              <span class="error" style="color:red; float:right; margin:-1% 0 0 50%"><?php echo form_error('type'); ?></span> 
          </div>
          <div class="form-group">
            <label for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
              <input id="name" type="text" placeholder="Name" name="name" maxlength="256" value="<?php echo set_value('name', (isset($media->name)) ? $media->name : ''); ?>"  />
              <span class="error" style="color: red;"><?php echo form_error('name'); ?></span>
          </div>
          <div class="form-group">
            <label for='category_id'><?php echo lang('web_category')?> <span class="required">*</span></label>
              <select name='category_id' id='category_id'>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                <option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>
                <?php endforeach ?>
              </select>
              <span class="error" style="color: red; margin:14% 0 0 54%"><?php echo form_error('category_id'); ?></span>
          </div>         
          <div class="form-group">
            <label for='category_id'>Active</label>
                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($media->published)) && $media->published == '1' ? "checked" : ''; ?> />
                <!--<input id="published" type="checkbox" name="published" value='1' <?php echo preset_checkbox('published', '1', (isset($media->published)) ? $media->published : ''  )?> /> -->
                
                <label style="margin-bottom:0; padding:0;" for='published'> <?php echo lang('web_is_active')?> </label>
          </div>
          <div class="form-group">
            <label for="instructions">Sub Title / Instruction:
              <?php //echo lang('web_description')?>
            </label>
              <?php //$this->ckeditor->editor("instructions",($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''));?>
              <textarea id="instructions" placeholder="TextSub Title / Instructionarea" name="instructions"  ><?php echo ($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''); ?></textarea>               
          </div>         
          <br />
          <!--Main fieldset--> 
          
          <!--End Main fieldset--> 
          
          <!--video section starts here--> 
          
          <!--<div id="videoblock" style="display:<?php //echo ($mediatypeval=='video')? '' : 'none';?>;"> -->
          
          <?php $vmedia = ($mediatypeval=='video')? '' : 'none'; ?>
          <div id="videoblock" style="display:<?php echo ($this->input->post('type')== 'video') ? 'block' : $vmedia ?>; margin: 20px 0 0 0;">
            <fieldset class="adminform">
              <legend>Select Video Source:</legend>
              <table width="100%" cellspacing="0" cellpadding="5" border="0">
                <tbody>
                  <tr id="code_of_file">
                    <td width="20px" align="center"><input type="radio" name="source_v" value="code" onchange='displayContainer(this.value)' <?php echo ($this->input->post('source_v') == "code") ? "checked" : (isset($media->source) && $media->source == 'code') ? "checked" :'';?> id="source_code_v"></td>
                    <td> Video Code </td>
                    <td><div id="code_v" style='display:none'>
                        <div style="float:left;">
                          <textarea onpaste="javascript:change_radio_code()" onkeypress="javascript:change_radio_code()" name="code_v" cols="25" style='resize:none' id='code_v1'>



                                    <?php echo ($this->input->post('code_v')) ? $this->input->post('code_v') : ((isset($media->code)) ? $media->code : ''); ?>



                                    </textarea>
                        </div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><input type="radio" onchange='displayContainer(this.value)' onchange="javascript:hide_hidden_row1();" name="source_v" value="url" <?php echo ($this->input->post('source_v') == 'url') ? "checked" : ((isset($media->source) && $media->source == 'url') ? "checked" : ''); ?> id="source_url_v">
                      
                      <!--<input type="radio" onchange="javascript:hide_hidden_row();" name="source_v" value="url" <?php if(isset($media->source) && $media->source == 'url') echo "checked"; ?> id="source_url_v">--></td>
                    <td> Video URL </td>
                    <td><div id="url_v" style='display:none'>
                        <div style="float:left;">
                          <input type="text" onchange="javascript:hide_hidden_row();" name="url_v" value="<?php echo ($this->input->post('url_v')) ? $this->input->post('url_v') : ((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url()" id='url_v1'>
                          
                          <!--<input type="text" onchange="javascript:hide_hidden_row();" name="url_v" value="<?php echo set_value('url_v', (isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url()"> --> 
                          
                        </div>
                        <div style="float:left;"> <a target="_blank" href="#" style="valign:middle;text-decoration:none">&nbsp;&nbsp;&nbsp;&nbsp;View supported sites</a>&nbsp; </div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><input type="radio" onchange='displayContainer(this.value)' onchange="javascript:hide_hidden_row1();" name="source_v" id="source_local_v2" value="local" <?php echo ($this->input->post('source_v') == "local") ? "checked" : (isset($media->source) && $media->source == 'local') ? "checked" : ''; ?>></td>
                    <td colspan="2"><div>
                        <div style="display: inline;"> Upload new media &nbsp; </div>
                      </div></td>
                  </tr>
                  <tr>
                    <td valign="top" colspan="3"><div id="localfile_v1" style='display:none'>
                        <table width="100%">
                          <tbody>
                            <tr valign="top" id="uploadblock">
                              <td width="15%">Upload:</td>
                              <td><div id="videoUploader">
                                  <div class="qq-uploader">
                                    <div class="qq-upload-drop-area" style="display: none;"> <span>Drop files here to upload</span> </div>
                                    <div class="qq-upload-button" style="position: relative; direction: ltr;"> 
                                      
                                      <!--Choose file-->
                                      <input type="file" name="file_v" id="file_v" class="upload_btn">
                                    </div>
                                    
                                    <!--	<div id='msgstatus_v'></div>  -->
                                    
                                    <ul class="qq-upload-list">
                                    </ul>
                                  </div>
                                </div></td>
                            </tr>
                            <tr>
                              <td width="9%"></td>
                              <td width="91%"><font color="#FF0000"><?php if(@$upload_error) { echo @$upload_error; } ?></font></td>
                            </tr>
                          </tbody>
                        </table>
                      </div></td>
                  </tr>
                 <!-- <tr bgcolor="#eeeeee" >
                    <td></td>
                    <td><div id="localfile_v2" style='display:none'> Choose a local video<br>
                        <font size="1"> (Upload via FTP to public/uploads/videos folder) </font> </div></td>
                    <td><div id="localfile_v3" style='display:none'> Now selected:
                        <?php //foreach($ftpvideos as $videofile){

                            //  echo $videofile->filename;

                            //  echo $this->input->post('localfile_v');

                            // echo in_array($this->input->post('localfile_v'),$videofile);

                              //echo $media->local;

                              //echo $this->input->post('localfile_v').'====='.$videofile->filename;

                             // if($this->input->post('localfile_v') == $videofile->filename){

                               //echo "selectedbcvbcvb";

                              //}else{

                             // }

                   // }


                   //echo "<pre>";

                   //print_r($ftpvideos);

                   //echo "</pre>";

                    ?>
                        <select id="localfile_v" name="localfile_v" size="10" onchange="change_radio_local();" onclick="change_radio_local();">
                          <option value="0">...</option>
                          <?php foreach($ftpvideos as $videofile):?>
                          <option value="<?php echo $videofile->filename;?>" <?php echo ($this->input->post('localfile_v') == $videofile->filename) ? "selected" : (isset($media->local) && $media->local == $videofile->filename) ? "selected" : ''; ?>> <?php echo $videofile->filename;?> </option>
                          <?php endforeach;?>
                        </select>
                      </div></td>
                  </tr>-->
                  
                </tbody>
              </table>
            </fieldset>
          </div>
          
          <!--audio section starts here-->
          
          <?php $amedia = ($mediatypeval=='audio')? '' : 'none'; ?>
          <div id="audioblock" style="display:<?php echo ($this->input->post('type')== 'audio') ? 'block' : $amedia ?>"> 
            <!--<div id="audioblock"  style="display:<?php echo ($mediatypeval=='audio')? '' : 'none';?>;">       -->
            <fieldset class="adminform">
              <legend>Select audio source:</legend>
              <table class="adminform">
                <tbody>
                  <tr>
                    <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            
                            <td> Select audio source:<br>
                              <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                <tbody>
                                  <tr id="code_of_file">
                                    <td width="20px" align="center"><input type="radio" name="source_a" value="code" onchange='displayContainerAudio(this.value)' <?php echo ($this->input->post('source_a') == "code") ? "checked" : (isset($media->source) && $media->source == 'code') ? "checked" : ''; ?> id="source_code_a"></td>
                                    <td>Audio Code</td>
                                    <td><textarea onpaste="javascript:change_radio_code()" onkeypress="javascript:change_radio_code()" name="code_a" id="code_a" cols="35" style="display: none;"><?php echo ($this->input->post('code_a')) ? $this->input->post('code_a') : ((isset($media->code)) ? $media->code : ''); ?>



</textarea></td>
                                  </tr>
                                  <tr>
                                    <td><input type="radio" onchange="javascript:displayContainerAudio(this.value);" name="source_a" value="url" <?php echo ($this->input->post('source_a') == 'url') ? "checked" : (isset($media->source) && $media->source == 'url') ? "checked" : '' ?> id="source_url_a"></td>
                                    <td> Audio URL </td>
                                    <td><input type="text" onchange="javascript:hide_hidden_row();" name="url_a" id="url_a" value="<?php echo ($this->input->post('url_a')) ? $this->input->post('url_a') : ((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url();" style="display: none;"></td>
                                  </tr>
                                  <tr>
                                    <td><input type="radio" onchange='displayContainerAudio(this.value)' name="source_a" value="local" <?php echo ($this->input->post('source_a') == "local") ? "checked" : (isset($media->source) && $media->source == 'local') ? "checked" :'';?> id="source_local_a2"></td>
                                    <td colspan="2"><div>
                                        <div style="display: inline;"> Upload new media </div>
                                      </div></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td colspan="2"><div id="localfile_a1" style="display: none;">
                                        <table>
                                          <tbody>
                                            <tr valign="top" id="uploadblock">
                                              <td width="9%">Upload:</td>
                                              <td width="91%"><div id="audioUploader">
                                                  <div class="qq-uploader">
                                                    <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                                                    <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file
                                                      <input type="file" name="file_a" id="file_a" class="upload_btn">
                                                    </div>
                                                    <ul class="qq-upload-list">
                                                    </ul>
                                                  </div>
                                                </div></td>
                                            </tr>
                                            <tr>
                                              <td width="9%"></td>
                                              <td width="91%"><font color="#FF0000"><?php if(@$upload_error) { echo @$upload_error; } ?></font></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div></td>
                                  </tr>
                                  <!--<tr>
                                    <td></td>
                                    <td><div id="localfile_a2" style="display: none;"> Choose a local audio<br>
                                        <font size="1">(Upload via FTP to media/audiofolder)</font> </div></td>
                                    <td><div id="localfile_a3" style="display: none;"> Now selected:
                                        <select id="localfile_a" name="localfile_a" size="10" onchange="change_radio_local();" onclick="change_radio_local();">
                                          <option value="0">...</option>
                                          <?php foreach($ftpaudio as $audiofile):?>
                                          <option value="<?php echo $audiofile->filename;?>" <?php echo  ($this->input->post('localfile_a') == $audiofile->filename) ? "selected" : (isset($media->local) && $media->local == $audiofile->filename) ? "selected" : ''?>><?php echo $audiofile->filename;?></option>
                                          <?php endforeach;?>
                                        </select>
                                      </div></td>
                                  </tr>-->
                                  <tr valign="top" bgcolor="#eeeeee" id="player_size">
                                    <td></td>
                                    <td colspan="2"><table width="100%" cellspacing="0" cellpadding="5" border="0">
                                        <tbody>
                                          <tr>
                                            <td width="15%"> Size </td>
                                            <td><input type="text" name="width_a" value="<?php echo ($this->input->post('width_a')) ? $this->input->post('width_a') :((isset($media->width)) ? $media->width : ''); ?> " size="10">
                                              <span class="error" id="error"><?php echo form_error('width_a'); ?></span>
                                              <input type="hidden" name="height_a" value="20" size="10">
                                              px wide </td>
                                          </tr>
                                        </tbody>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table>
            </fieldset>
          </div>
          
          <!--documents section starts here--> 
          
          <!--	<div id="docsblock"  style="display:<?php echo ($mediatypeval=='docs')? '' : 'none';?>;">   -->
          
          <?php $dmedia = ($mediatypeval=='docs')? '' : 'none'; ?>
          <div id="docsblock" style="display:<?php echo ($this->input->post('type')== 'docs') ? 'block' : $dmedia ?>">
            <fieldset class="adminform">
              <legend>Select document:</legend>
              <table class="adminform">
                <tbody>
                  <tr>
                    <td><table cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <td> Select document source:<br>
                              <table width="100%" cellspacing="0" cellpadding="5" border="0">
                                <tbody>
                                  <!-- <tr>
                                    <td width="20px"><input type="radio" onchange="javascript:displayContainerDoc(this.value);" name="source_d" value="url" <?php echo ($this->input->post('source_d') == 'url') ? "checked" : (isset($media->source) && $media->source == 'url') ? "checked" : ''; ?> id="source_url_d"></td>
                                    <td width="28%"> Document URL </td>
                                    <td width="67%"><input type="text" name="url_d" id="url_d" value="<?php echo ($this->input->post('url_d')) ? $this->input->post('url_d') : ((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url()"></td>
                                  </tr> -->
                                 <!--  <tr>
                                    <td><input type="radio" onchange="javascript:displayContainerDoc(this.value);" name="source_d" value="local" <?php echo ($this->input->post('source_d') == 'local') ? "checked" : (isset($media->source) && $media->source == 'local') ? "checked" : ''; ?> id="source_local_d2"></td>
                                    <td colspan="2"> Upload new media</td>
                                  </tr>  -->
                                  <tr>
                                    <td colspan="3"><div id="localfile_d1" style="display: block;">
                                        <table>
                                          <tbody>
                                            <tr valign="top" id="uploadblock">
                                              <td width="9%">Upload:</td>
                                              <td width="91%"><div id="docUploader">
                                                  <div class="qq-uploader">
                                                    <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                                                    <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file
                                                      <input type="file" name="file_d" id="file_d" class="upload_btn">
                                                    </div>
                                                    <ul class="qq-upload-list">
                                                    </ul>
                                                  </div>
                                                </div></td>
                                            </tr>
                                            <tr valign="top">
                                              <td width="9%"></td>
                                              <td width="91%"><font color="#FF0000"><?php if(@$upload_error) { echo @$upload_error; } ?></font></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div></td>
                                  </tr>
                                  <!--<tr valign="top" bgcolor="#eeeeee">
                                    <td></td>
                                    <td><div id="localfile_d2" style="display: none;"> Choose a local document<br>
                                        <font size="1">(Upload via FTP to media/documentsfolder)</font> </div></td>
                                    <td><div id="localfile_d3" style="display: none;"> Now selected:<br>
                                        <select onclick="change_radio_local();" onchange="change_radio_local();" size="10" name="localfile_d" id="localfile_d">
                                          <option value="root">../</option>
                                          <?php foreach($ftpdocuments as $docfile):?>
                                          <option value="<?php echo $docfile->filename;?>" <?php echo ($this->input->post('localfile_d') == $docfile->filename) ? "selected" : (isset($media->local)) ? "selected" : ''?>><?php echo $docfile->filename;?></option>
                                          <?php endforeach;?>
                                        </select>
                                      </div></td>
                                  </tr>-->
                                  <!--<tr id="player_size">
                                    <td colspan="3"><table>
                                        <tbody>
                                          <tr>
                                            <td width="10%"> Display </td>
                                            <td><script type="text/javascript">



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
                                              <select name="display_as" id="display_as">
                                                <option onclick="javascript:wh(1)" value="wrapper" <?php echo ($this->input->post('display_as') == 'wrapper') ? "selected" : $wrapper; ?>>Wrapper</option>
                                                <option onclick="javascript:wh(0)" value="link" <?php echo ($this->input->post('display_as') == 'link') ? "selected" : $link; ?>>Link</option>
                                              </select></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <?php



               $size_div = ($this->input->post('display_as') && $this->input->post('display_as') == 'link') ? 'display:none' : ((isset($media->width) && $media->width == '0') ? 'display:none' : '');



                ?>
                                      <table width="100%" cellspacing="0" cellpadding="5" border="0" id="whdoc" style="<?php echo $size_div; ?>">
                                        <tbody>
                                          <tr>
                                            <td width="15%"> Size </td>
                                            <td><div>
                                                <div style="display: inline;"> 
                                                  
                                               
                                                  
                                                  <input type="text" name="width" value="<?php echo ($this->input->post('width')) ? $this->input->post('width') : ((isset($media->width)) ? $media->width : '600'); ?>" size="10">
                                                  <span class="error" id="error_56"><?php echo form_error('width'); ?></span> </div>
                                                <div style="display: inline;"> X &nbsp; </div>
                                                <div style="display: inline;"> 
                                                  
                                               
                                                  
                                                  <input type="text" name="height" value="<?php echo ($this->input->post('height')) ? $this->input->post('height') :  ((isset($media->height)) ? $media->height : '800'); ?>" size="10">
                                                  <span class="error" id="error_56"><?php echo form_error('height'); ?></span> </div>
                                                <div style="display: inline;"> (Width X Height) &nbsp; </div>
                                              </div></td>
                                          </tr>
                                        </tbody>
                                      </table></td>
                                  </tr>-->
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table>
            </fieldset>
          </div>
          
          <!--url section starts here--> 
          
          <!--<div id="urlblock"  style="display:<?php echo ($mediatypeval=='url')? '' : 'none';?>;"> -->
          
          <?php $umedia = ($mediatypeval=='url')? '' : 'none'; ?>
          <div id="urlblock" style="display:<?php echo ($this->input->post('type')== 'url') ? 'block' : $umedia ?>">
            <fieldset class="adminform">
              <legend>Enter Url:</legend>
              <table class="adminform">
                <tbody>
                  <tr>
                    <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <td width="15%">URL:</td>
                            <td><div>
                                <div style="float:left;">
                                  <?php //echo ($this->input->post('url')) ? $this->input->post('url') :  ((isset($media->url)) ? $media->url : 'http://'); ?>
                                  <input type="text" name="url" value="<?php echo ($this->input->post('url')) ? $this->input->post('url') :  ((isset($media->url)) ? $media->url : 'http://'); ?>" size="80">
                                  <span class="error" id="error_56"><?php echo form_error('url'); ?></span> </div>
                                <div> <font color="#FF0000">Enter full URL, example: http://ijoomla.com</font> </div>
                              </div></td>
                          </tr>
                          <tr>
                            <td width="10%"> Display </td>
                            <td><select name="display_as2">
                                <option value="wrapper" <?php echo ($this->input->post('display_as2') == 'wrapper') ? "selected" : (isset($media->width) && $media->width == 0) ? "selected" : '' ?> >Wrapper</option>
                                <option value="link" <?php echo ($this->input->post('display_as2') == 'link') ? "selected" : (isset($media->width) && $media->width == 1) ? "selected" : '' ?>>Link</option>
                              </select></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table>
            </fieldset>
          </div>
          
          <!--image section starts here--> 
          
          <!--<div id="imageblock"  style="display:<?php echo ($mediatypeval=='image')? '' : 'none';?>;"> -->
          
          <?php $imgmedia = ($mediatypeval=='image')? '' : 'none'; ?>
          <div id="imageblock" style="display:<?php echo ($this->input->post('type')== 'image') ? 'block' : $imgmedia ?>">
            <fieldset class="adminform">
              <legend>Select image:</legend>
              <table class="adminform">
                <tbody>
                  <tr>
                    <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            <td width="20%">Image:<font color="#ff0000">*</font></td>
                            <td width="80%"><div id="imageUploader">
                                <div class="qq-uploader">
                                  <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                                  <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;"> 
                                    
                                    <!--Choose file-->
                                    
                                    <input type="file" name="file_i" id="file_i" class="upload_btn">
                                    
                                    <!-- <input id="image" type="file" name="image" />-->
                                    
                                    <?php //print_r($ftpimage); ?>
                                  </div>
                                  <div id="localimage_i">
                                    <?php $image_name = (isset($media->image)) ? $media->image : '';    ?>
                                    <?php //if(isset($media->local)){   ?>
                                    <?php if ($updType == 'edit'){ ?>
                                    <img src="<?php echo base_url();?>public/uploads/images/<?php if(isset($media->local)) echo $media->local; ?>" width="150" id="imgname"/>
                                    <?php }else{?>
                                    <img src="<?php echo base_url();?>public/uploads/images/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg'?>" width="150" id="imgname">
                                    <?php } ?>
                                  </div>
                                  <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $image_name ?>" name="imagename" id="imagename">
                                  <div id="messagestatus"></div>
                                  <ul class="qq-upload-list">
                                  </ul>
                                </div>
                              </div></td>
                          </tr>
                          <tr>
                            <td width="15%"></td>
                            <td><font color="#FF0000"><?php if(@$upload_error) { echo @$upload_error; } ?></font></td>
                          </tr>
                          <tr>
                            <td> Image size: </td>
                            <td><div>
                                <div style="display: inline;">
                                  <input type="text" value="<?php echo ($this->input->post('media_fullpx')) ? $this->input->post('media_fullpx') :  ((isset($media->media_fullpx)) ? $media->media_fullpx : ''); ?>" name="media_fullpx" id="media_fullpx" size="8">
                                  <span class="error" id="error_56"><?php echo form_error('media_fullpx'); ?></span> </div>
                                <div style="display: inline;"> px &nbsp; </div>
                                <div style="display: inline;">
                                  <select id="media_prop" name="media_prop">
                                    <option value="w"  <?php echo ($this->input->post('media_prop') == 'w') ? "selected" : (isset($media->width) && $media->width == 0) ? "selected" : '' ?>>Wide</option>
                                    <option value="h"  <?php echo ($this->input->post('media_prop') == 'h') ? "selected" : (isset($media->height) && $media->height == 0) ? "selected" : '' ?>>High</option>
                                  </select>
                                </div>
                                <div style="display: inline;">
                                  <input type="hidden" value="0" name="is_image" id="is_image">
                                </div>
                              </div></td>
                          </tr>
                          <tr>
                            <td> Current image: </td>
                            <td><img border="0" src="../images/M_images/blank.png" alt="" style="margin:5px;" name="view_imagelist" id="view_imagelist23">
                              <input type="hidden" value="" name="image" id="image"></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </tbody>
              </table>
            </fieldset>
          </div>
          
          <!--text section starts here--> 
          
          <!--<div id="textblock"  style="display:<?php echo ($mediatypeval=='text')? '' : 'none';?>;">-->
          
          <?php $textmedia = ($mediatypeval=='text')? '' : 'none'; ?>
          <div id="textblock" style="display:<?php echo ($this->input->post('type')== 'text') ? 'block' : $textmedia; ?>">
            <fieldset class="adminform">
              <legend>Enter text:</legend>
              <table class="adminform">
                <tbody>
                  <tr>
                    <td width="15%"><label class='labelform' for="description"><?php echo lang('web_description')?> <span class="required">*</span></label></td>
                    <td><?php



                       // $code = ($this->input->post('description')) ? $this->input->post('description') : (isset($media->code)? $media->code : '');



                        //$this->ckeditor->editor("description",$code);



                        ?>
                      <textarea id="description" name="description" class="stinput" rows="6" >
                  <?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($media->description)) ? $media->description : ''); ?>
                  </textarea>
                      
                      <!--<textarea name="description" id="description" class="stinput" rows="6"></textarea>--> 
                      
                      <?php echo form_error('description'); ?></td>
                  </tr>
                </tbody>
              </table>
            </fieldset>
          </div>
          
          <!--file section start here--> 
          
          <!--	<div id="fileblock"  style="display:<?php echo ($mediatypeval=='file')? '' : 'none';?>;"> -->
          
          <?php $filemedia = ($mediatypeval=='file')? '' : 'none'; ?>
          <div id="fileblock" style="display:<?php echo ($this->input->post('type')== 'file') ? 'block' : $filemedia ?>">
            <fieldset class="adminform">
              <legend style="margin-bottom: 10px;">Select file source:</legend>
              <div class="zone_description">(Only pdf, docx, jpg files are accepted)</div>

                    <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                          <tr>
                            
                            <td> Select file source, only pdf, docx, jpg are accepted<br>
                              <table width="100%" cellspacing="5" cellpadding="20" border="0">
                                <tbody>
                                  <!-- <tr>
                                    <td><input type="radio" onchange="javascript:displayContainerFile(this.value);" name="source_f" value="url" <?php echo ($this->input->post('source_f') == 'url') ? "checked" : ((isset($media->source) && $media->source == 'url') ? "checked" : ''); ?> id="source_url_f"></td>
                                    <td> File URL </td>
                                    <td><input type="text" on="" onmouseout="doPreview();" onchange="javascript:hide_hidden_row();" name="url_f" id="url_f" value="<?php echo ($this->input->post('url_f')) ? $this->input->post('url_f') :((isset($media->url)) ? $media->url : ''); ?>" size="40" onpaste="javascript:change_radio_url()" onkeypress="javascript:change_radio_url()" style="display: none;">
                                      <div id="filePreview"></div></td>
                                  </tr>
                                  <tr>
                                    <td><input type="radio" onchange="javascript:displayContainerFile(this.value);" name="source_f" value="local" <?php echo ($this->input->post('source_f') == 'local') ? "checked" : (isset($media->source) && $media->source == 'local') ? "checked" : ''; ?> id="source_local_f2"></td>
                                    <td colspan="2"> Upload a new file </td>
                                  </tr> -->
                                  <tr>
                                    <td colspan="3"><div id="localfile_f1" style="display: block;">
                                        <table>
                                          <tbody>
                                            <tr valign="top" id="uploadblock">
                                              <td>Upload:</td>
                                              <td><div id="fileUploader">
                                                  <div class="qq-uploader">
                                                    <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                                                    <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file
                                                      <input type="file" name="file_f" id="file_f" class="upload_btn">
                                                    </div>
                                                    <ul class="qq-upload-list">
                                                    </ul>
                                                  </div>
                                                </div></td>
                                            </tr>
                                            <tr>
                                              <td></td>
                                              <td><font color="#FF0000"><?php if(@$upload_error) { echo @$upload_error; } ?></font></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div></td>
                                  </tr>
                                 <!-- <tr>
                                    <td></td>
                                    <td><div id="localfile_f2" style="display: none;"> Choose a local file<br>
                                        <font size="1"> (Upload via FTP to media/filesfolder) </font> </div></td>
                                    <td><div id="localfile_f3" style="display: none;"> Now selected: <br>
                                        <select id="localfile_f" name="localfile_f" size="10" onchange="change_radio_local();" onclick="change_radio_local();">
                                          <option value="0">...</option>
                                          <?php foreach($ftpfiles as $filefile):?>
                                          <option value="<?php echo $filefile->filename;?>" <?php echo  ($this->input->post('localfile_f') == $filefile->filename) ? "selected" : (isset($media->local)) ? "selected" : '' ?> ><?php echo $filefile->filename;?></option>
                                          <?php endforeach;?>
                                        </select>
                                      </div></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td><div id="filesFolder">http://mlms.puneitlab.com/media/files</div>
                                      
                                      </td>
                                  </tr>-->
                                </tbody>
                              </table></td>
                          </tr>
                        </tbody>
                      </table>
            </fieldset>
          </div>
          <div>
            <div class="col-sm-offset-3 col-sm-5" style="margin-left:25%; margin-top:20px;"> <a> <?php echo form_submit( 'submit', ($updType == 'edit') ? "Edit" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?> </a> </div>
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