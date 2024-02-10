<style type="text/css">
  
  .mediasize
  {
    width: 250px;
    height: auto;
  }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<script type="text/javascript">

function check_name(fldid){

  var name = jQuery("#"+fldid).val();  
  
  
    $.ajax({



        type: "post",

        url: "<?php echo base_url('medias/checkname'); ?>",
        <?php 
        if ($updType != 'edit')
        {
         ?>        
        url: "<?php echo base_url('medias/checkname'); ?>",
    <?php }
    else
      {
        ?>
         url: "<?php echo base_url() ?>medias/checknamedit/<?php echo $this->uri->segment(3); ?>",
        <?php
      }
        ?>

        data: {name:name},

        success: function(msg)
        {
          //alert(msg);
            if(msg == 'success')

            {

                
                $("#ajax").css({"color": "red","padding-left": "387px"});
                $("#ajax").html('Already Exist');
                jQuery("#"+fldid).val('');



               /* $("#submitbutton").html('<input type="button" name="button" id="button" value="<?php echo 'POST'; ?>" onclick="create_blog()" class="stbutton"/>'); */

            }

            else

            {
                $("#ajax").css({"color": "green","padding-left": "387px"});
                $("#ajax").html('Available');


            }

        }



    });

}


//jQuery(document).ready(function($) {

//$('#title').val()

$(function() {



   $('#file_i,#file_v,#file_a,#file_d,#file_f').on('change',function(e) {

   var ftpfileoptions;

   var ftpfilearray;

   switch($('select#type').val()){



	case 'image': var fldtype='i';
		$('.file_error_i').html('');
		var fileExtension = ['jpg', 'jpeg', 'png', 'gif', 'tif','bmp','svg'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            // alert("Invalid selected file");
            $('.file_error_i').css('color','red');
            $('.file_error_i').html('Invalid selected file');
            $('#file_i').val('');
        	return false;
        }
		break;

    case 'video': var fldtype='v';
        $('.file_error_v').html('');
    	var fileExtension = ['mp4', 'avi', 'mov', 'webm', 'mkv','mov','wmv','m4v','mpeg','3gp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            // alert("Invalid selected file");
            $('.file_error_v').css('color','red');
            $('.file_error_v').html('Invalid selected file');
            $('#file_v').val('')
        	return false;
        }
		break;
	
	case 'audio': var fldtype='a';
        $('.file_error_i').html('');
		var fileExtension = ['mp3', 'wav', 'aiff'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            // alert("Invalid selected file");
            $('.file_error_a').css('color','red');
            $('.file_error_a').html('Invalid selected file');
            $('#file_a').val('')
        	return false;
        }
  		break;
    
    case 'docs': 
    	var fldtype='d';
    	$('.file_error_a').html('');
    	var fileExtension = ['pdf', 'txt', 'doc', 'docx', 'csv'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            // alert("Invalid selected file");
            $('.file_error_d').css('color','red');
            $('.file_error_d').html('Invalid selected file');
            $('#file_d').val('')
        	return false;
        }
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

<script>
 jQuery(document).ready(function()
 {
   	jQuery('#description').redactor();
    jQuery('.redactor-editor').css({'overflow':'scroll','max-height':'100px'});
 }
 );
</script>

<!-- tool tip script -->
<script type="text/javascript">

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
<script type="text/javascript">
window.onload = function() {
var local_upload = document.getElementById("source_local_v2").checked;
    if(local_upload == true)
    {
      var local_val = document.getElementById("source_local_v2").value;
    }
    var local_url = document.getElementById("source_url_v").checked;
    if(local_url == true)
    {
      
        var local_val = document.getElementById("source_url_v").value;
        document.getElementById("url_v").style.display = 'block';
    }

    var local_code = document.getElementById("source_code_v").checked;

    if(local_code == true)
    {
      var local_val = document.getElementById("source_code_v").value;
    }
    displayContainer(local_val);
    var local_code = document.getElementById("source_code_a").checked;
    if(local_code == true)
    {
        var local_vala = document.getElementById("source_code_a").value;
    }
    var local_urla = document.getElementById("source_url_a").checked;
    if(local_urla == true)
    {
      var local_vala = document.getElementById("source_url_a").value;
    }
    var local_locala = document.getElementById("source_local_a2").checked;
    if(local_locala == true)
    {
      var local_vala = document.getElementById("source_local_a2").value;
    }
    displayContainerAudio(local_vala);
    var local_coded = document.getElementById("source_url_d").checked;
    if(local_coded == true)
    {
      var local_vala = document.getElementById("source_url_d").value;
    }

    var local_locald = document.getElementById("source_local_d2").checked;
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

        if(type == 'text')



        {

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


         }



         if(conval=='local')



         {



           document.getElementById("url_d").style.display = 'none'



           document.getElementById("localfile_d1").style.display = 'block';



         //  document.getElementById("localfile_d2").style.display = 'block';



           document.getElementById("localfile_d3").style.display = 'block';



         }



    }







    function displayContainerAudio(conval)



    {



         if(conval=='code')



         {



           document.getElementById("code_a").style.display = 'block';

           document.getElementById("txtp").style.display = 'block';

           document.getElementById("url_a").style.display = 'none';



           document.getElementById("localfile_a1").style.display = 'none';



         //  document.getElementById("localfile_a2").style.display = 'none';



        //   document.getElementById("localfile_a3").style.display = 'none';



         }



         if(conval=='url')



         {



           document.getElementById("code_a").style.display = 'none';

document.getElementById("txtp").style.display = 'none';

           document.getElementById("url_a").style.display = 'block';



           document.getElementById("localfile_a1").style.display = 'none';



      //     document.getElementById("localfile_a2").style.display = 'none';



       //    document.getElementById("localfile_a3").style.display = 'none';



         }



         if(conval=='local')



         {



           document.getElementById("code_a").style.display = 'none';

           document.getElementById("txtp").style.display = 'none';

           document.getElementById("url_a").style.display = 'none';



           document.getElementById("localfile_a1").style.display = 'block';



       //    document.getElementById("localfile_a2").style.display = 'block';



       //    document.getElementById("localfile_a3").style.display = 'block';



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



         //   document.getElementById("localfile_v3").style.display = 'none';



         }



        if(conval=='url')



         {



            document.getElementById("code_v").style.display = 'none';



            document.getElementById("code_v1").value = '';



            document.getElementById("url_v").style.display = 'block';



            document.getElementById("localfile_v1").style.display = 'none';



         //   document.getElementById("localfile_v2").style.display = 'none';



         //   document.getElementById("localfile_v3").style.display = 'none';



         }



         if(conval=='local')



         {



            document.getElementById("code_v").style.display = 'none';



            document.getElementById("url_v").style.display = 'none';



            document.getElementById("localfile_v1").style.display = 'block';



           // document.getElementById("localfile_v2").style.display = 'block';



          //  document.getElementById("localfile_v3").style.display = 'block';



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
echo ($updType == 'create') ? form_open_multipart(base_url().'medias/create', $attributes) : form_open_multipart(base_url().'medias/edit/'.$id, $attributes);
?>

<style type="text/css">
  .tooltipcontainer {
  display: inline-block;
  font-size: 11px;
  vertical-align: top;
  visibility: visible;
  z-index: 100;
  position: absolute;
  top: 0 !important;
  right: 0px !important;
  left: auto;
}

</style>

<!--top content area-->

<section class="breadcrumb">
<div class="container">

      <span class="page-title">
        <?php echo ($updType == 'create') ? "Create Media" : "Edit Media"; ?>
      </span>

      <div class="bread-view">
      <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
      <span class="ng-hide">/ </span>
      <a href="#"><?php echo ($updType == 'create') ? "Create Media" : "Edit Media"; ?></a>
  </div>

</div>
</section>


</header>

<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box;">
    <div class="sidebar-menu sb-left"> 
      <!-- Your left Slidebar content. --> 
      <!-- Classes Examples -->
     <ul id="main-menu">
        <li class="root-level"><a href="<?php echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>Manage Question Papers</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>questions/manage"><span>Manage Questions</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
      </ul>
    </div>
      <div class="main-content">
      <div class="row">
        <div class="sidebar-collapse sb-toggle-left" style="  margin-left: 15px; margin-bottom: 10px; float: left;"> 
          <a href="#" class="sidebar-collapse-icon with-animation"> 
          <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
          <i class="entypo-menu"></i> </a> 
        </div>

<div>
    <?php if ($updType == 'edit'):
		$mediatypeval = lcfirst($media->type);
		else:
		$mediatypeval = null;
		endif;
	?>
    <span class="clearFix">&nbsp;</span>
</div>





<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">

    <div class="panel-heading">
      <div class="panel-title" style="padding-bottom: 0px;">  
        <h3 style="margin-top: 0;"><?php echo ($updType == 'create') ? "Create Media" : "Edit Media"; ?></h3>
      </div>
      <div  class="panel-options">
        
      </div>  
    </div>
		
			
			
			<div class="panel-body form-horizontal form-groups-bordered">
				

					
                    <div class="form-group" style="display: none;published">
						
                        <label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0;" for="type">Type: <span class="required">*</span></label>
						
						<div class="col-sm-5">
							
<select class="form-control" size="1" name="type" id="type" data-validation="required">

						     <option value="file" selected="selected"> File </option>
               <!--  <option value="video"<?php echo lcfirst($media->type) == 'video' ? 'selected' : '' ?>  >Video</option>
                <option value="audio"<?php echo lcfirst($media->type) == 'audio' ? 'selected' : '' ?>  >Audio</option>
                <option value="docs"<?php echo lcfirst($media->type) == 'document' ? 'selected' : '' ?>  >document</option>
                <option value="image"<?php echo lcfirst($media->type) == 'image' ? 'selected' : '' ?>  >Image</option>
                <option value="file"<?php echo lcfirst($media->type) == 'flash' ? 'selected' : '' ?>  >Flash</option> -->
				    

						</select>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="type-target" class="tooltipicon" title="Click Here"></span>

						<span class="type-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_type');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                        <span class="error"><?php echo form_error('type'); ?></span>
						</div>
					</div>
                 

                    
					<div class="form-group">
						            <!-- <?php print_r($media);  ?> -->
                        <label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0;" for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						
						<div class="col-sm-5">
							
                            <input id="name" type="text" class="form-control"  name="name" maxlength="256" onblur="return check_name('name');" value="<?php echo set_value('name', (isset($media->alt_title)) ? $media->alt_title : ''); ?>"  data-validation="required" />
                            <small id="ajax"></small>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="name-target" class="tooltipicon" title="Click Here"></span>

						<span class="name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_name');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                        <span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>
                    
					
					<div class="form-group">
						
						<label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0;" for='category_id'><?php echo lang('web_category')?> <span class="required">*</span></label>
						<div class="col-sm-5">
							
                            <select name='category_id' id='category_id' class="form-control">



                            <option value="">Select Category</option>



							<?php foreach ($categories as $category): ?>



                        	<option value='<?php echo $category->id?>' <?php echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>



							<?php endforeach ?>



							</select>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="category_id-target" class="tooltipicon" title="Click Here"></span>

						<span class="category_id-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_category');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                        <span class="error"><?php echo form_error('category_id'); ?></span>



						</div>
            <a href="<?php echo base_url();?>medias/createmediacategorypop" id="cropcategory" class="newcategory btn btn-success" style="margin-left: 20px;">Create New Category</a>
					</div>

                    
					<div class="form-group" style="display: none;">
                    <label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0;" for='category_id'>Active</label>
						<div class="col-sm-5">
                        
							<div class="checkbox">
								
                                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') && $this->input->post('published') == 1) ? 'checked == checked' : ((isset($category->published) && $category->published ==1) ? 'checked == checked' : ''); ?>/>
                                
                                <label for='active' style="display: inline-block;
margin-bottom: 0;
padding: 0;
width: auto;"> <?=lang('web_is_active')?> </label>

 

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon" title="Click Here"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_category-active');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
							</div>
							
						</div>
					</div>
                   
                   
					
                    <div class="form-group">    
						
						<label class='col-sm-3 control-label' style="margin-bottom: 0; padding: 0;" for="instructions">Sub Heading:<?php //echo lang('web_description')?> </label>
						<div class="col-sm-5">
							
          <textarea class="form-control" id="instructions" placeholder="Sub Heading" name="instructions"><?php echo ($this->input->post('instructions')) ? $this->input->post('instructions') : ((isset($media->instructions)) ? $media->instructions : ''); ?></textarea>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="instructions-target" class="tooltipicon" title="Click Here"></span>

						<span class="instructions-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('media_fld_instruction');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>
        
   <?php $vmedia = (strtolower($mediatypeval)=='video')? '' : 'none'; ?>

	<div id="videoblock" style="display:block; margin: 20px 0 0 205px;">
        <fieldset class="adminform">
       <!--  <label>Select File Source:</label> -->
    <table class="adminform">
          <tbody>
            <tr>
              <td>
        <table width="100%" cellspacing="0" cellpadding="5" border="0">
          <tbody>
              <tr>
                  <td valign="top" colspan="3">
                      <div id="localfile_v1" style='display:block'>
                          <table width="100%">
                              <tbody>
                                  <tr valign="top" id="uploadblock">
                                      <td width="15%"> <label>Select File Source:</label></td>
                                      <td>
                                    <div id="videoUploader">
                                    <div class="qq-uploader">
 
                                          <div class="qq-upload-button" style="position: relative; direction: ltr;">
      <!--Choose file-->
                                            <input type="file" name="file_f" id="file_f" class="upload_btn">
                                            <div class="file_error_v"></div>
                                          </div>                                      (Allowed file types: rar, zip, doc, docx, ppt, pptx, pdf, txt, jpg, png, gif, bmp,swf, mp3, avi, mp4, mpeg)    
                                         <div id="video_media" class="mediasize" style="display:<?php echo ($this->input->post('type')== 'video') ? 'block' : $vmedia ?>;">
                                         <?php if($media){ ?>
                                         <iframe src="<?php echo base_url();?>public/uploads/videos/<?php echo $media->media_title; ?>" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
                                         <?php
                                         

                                          }
                                          echo $upload_error;
                                           ?>
                                         </div>
                                    </div>
                                  </div>
                                  </td>
                                  </tr>
                                <tr>
                                <td width="9%"></td>
                                <td width="91%" style="font-weight: bolder;">Maximum File Size 100 MB  </td>
                                </tr>

                                </tbody>

                                </table>

                                </div>
                                </td>

                                </tr>

                                 </tbody>

                        </table></td></tr>
                        </tbody>
                        </table>
                        </fieldset>

        </div>

	<!--audio section starts here-->
<?php $amedia = ($mediatypeval=='audio')? '' : 'none'; ?>
<div id="audioblock" style="display:none;">
<fieldset class="adminform">
<legend>Select audio source:</legend>
<table class="adminform">
<tbody>
<tr>
<td>
<table width="80%" cellspacing="0" cellpadding="0" border="0">
<tbody>
    <tr>
<td>
<table width="100%" cellspacing="0" cellpadding="5" border="0">
  <tbody>
<tr>
<td>
</td>
<td colspan="2">
<div id="localfile_a1" style="display: block;">
<table>
<tbody>
<tr valign="top" id="uploadblock">
<td width="9%">Upload:</td>
<td width="91%">
<div id="audioUploader">
<div class="qq-uploader"><div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file
<input type="file" name="file_a" id="file_a" class="upload_btn"><div class="file_error_a"></div></div><ul class="qq-upload-list" accept="audio/*"></ul></div></div>
<div id="audio_media" class="mediasize" style="display:<?php echo ($this->input->post('type')== 'audio') ? 'block' : $amedia ?>">

   <?php if($media){ ?>
   <iframe src="<?php echo base_url();?>public/uploads/audio/<?php echo $media->media_title; ?>" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
   <?php
    
    } 
echo $upload_error;
    ?>
 </div>
 </td>
</tr>
<tr>
<td width="9%"></td>
<td width="91%" style="font-weight: bolder;">Maximum File Size 8 MB </td>
</tr>
</tbody>
</table>       
</div>
</td>
</tr>
</tbody></table>
</td>
</tr></tbody></table>
</td>
</tr>
</tbody>
</table>
</fieldset>
</div>



	<!--documents section starts here-->



   <!--	<div id="docsblock"  style="display:<?php echo ($mediatypeval=='docs')? '' : 'none';?>;">   -->



   <?php 


    $dmedia = (strtolower($mediatypeval)=='docs'|| strtolower($mediatypeval)=='document')? '' : 'none'; ?>



	<div id="docsblock" style="display:none;">
<fieldset class="adminform">
<legend>Select document:</legend>
<table class="adminform">
<tbody>
<tr>
<td>
<table width="80%" cellspacing="0" cellpadding="0" border="0">
<tbody>
 <tr>
<td width="20%">
</td>

<td>

<table width="100%" cellspacing="0" cellpadding="5" border="0">
<tbody>
 <tr>
<td colspan="3">
<div id="localfile_d1" style="display: block;">
<table>
<tbody><tr valign="top" id="uploadblock">
<td width="9%">Upload:</td>
<td width="91%">
<div id="docUploader">
<div class="qq-uploader">

<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file
<input type="file" name="file_d" id="file_d" class="upload_btn" accept="application/pdf,.txt,.doc,.csv"><div class="file_error_d"></div></div><ul class="qq-upload-list"></ul></div></div>
</td>
</tr>
<tr valign="top">
<td width="9%"></td>
<td width="91%" style="font-weight: bolder;">Maximum File Size 8 MB  </td>
<td>
<div id="docs_media" class="mediasize" style="display:<?php echo ($this->input->post('type')== 'docs') ? 'block' : $dmedia ?>">

   <?php if($media){ ?>   
   <iframe src="http://docs.google.com/viewer?url=<?php echo base_url();?>public/uploads/documents/<?php echo $media->media_title; ?>&embedded=true" width="100%" height="594" frameborder="0" disableprint="true" style="background:white">myDocument</iframe> 
   <?php
 
    } 
    echo $upload_error;
    ?>
 </div>
 </td>
</tr>
</tbody>
</table>
</div>
</td>
 </tr>
 </tbody></table>
</td>
</tr></tbody></table>
</td>
</tr>
</tbody>
</table>
</fieldset>
</div>

    <?php $umedia = ($mediatypeval=='url')? '' : 'none'; ?>

    <div id="urlblock" style="display:<?php echo ($this->input->post('type')== 'url') ? 'block' : $umedia ?>">
<fieldset class="adminform">
<legend>Enter Url:</legend>
<table class="adminform">
<tbody>
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
<td width="15%">URL:</td>
<td>
<div>
<div style="float:left;">
<?php //echo ($this->input->post('url')) ? $this->input->post('url') :  ((isset($media->url)) ? $media->url : 'http://'); ?>
<input type="text" name="url" value="<?php echo ($this->input->post('url')) ? $this->input->post('url') :  ((isset($media->url)) ? $media->url : 'http://'); ?>" size="80">
<span class="error" id="error_56"><?php echo form_error('url'); ?></span>
</div>
<div>
<font color="#FF0000">Enter full URL, example: http://ijoomla.com</font>
 </div>
</div>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody>
</table>
</fieldset>
</div>
<?php $imgmedia = (strtolower($mediatypeval)=='image')? '' : 'none'; ?>
<div id="imageblock" style="display:none;">
<fieldset class="adminform">
<legend>Select image:</legend>

<table class="adminform">
<tbody>
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td width="20%">Image:<font color="#ff0000">*</font></td>
<td width="80%">
<div id="imageUploader"><div class="qq-uploader"><div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
 <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">

                <input type="file" name="file_i" id="image" class="upload_btn"accept="image/*">
                <div class="file_error_i"></div>

                 </div>

                 <div id="localimage_i">



                   <?php $image_name = (isset($media->image)) ? $media->image : '';    ?>



                    <?php if ($updType == 'edit'){ ?>
                   

                   <img src="<?php echo base_url();?>public/uploads/images/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $media->media_title;?>" width="150" id="imgname">
                                 <!--<div><a href="<?php echo base_url(); ?>admin/medias/cropmediaimgsec" class="fancybox fancybox.iframe btn btn-success" id="atag">Upload Image</a></div>-->
                                <input type="hidden" id="cropimagemedia" name="cropimagemedia" value="">
                                <img id="blah" src="#" width="auto" height="130px" alt="your image" class="img-responsive profile-image">


              <?php }else{?>
<img src="<?php echo base_url();?>public/uploads/images/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : 'no_images.jpg'?>" width="150" id="imgname">
                                 <!--<div><a href="<?php echo base_url(); ?>admin/medias/cropmediaimgsec" class="fancybox fancybox.iframe btn btn-success" id="atag">Upload Image</a></div>-->
                                <input type="hidden" id="cropimagemedia" name="cropimagemedia" value="">
                                <img id="blah" src="#" width="auto" height="130px" alt="your image" class="img-responsive profile-image">

                   <?php } ?>  </div>




                 <input type="hidden" id="cropmedia" name="cropmedia" value="" >
             <input type="hidden" id="cropmediacopy" name="cropmediacopy" value="<?php echo (isset($media->local)) ? $media->local : 'no_images.jpg' ?>" >



                  <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $image_name ?>" name="imagename" id="imagename">



				 <div id="messagestatus"></div>



				 <ul class="qq-upload-list"></ul></div></div>

			</td>

		</tr>

		<tr>



			<td width="15%"></td>



			<td width="91%" style="font-weight: bolder;">Maximum File Size 8 MB  </td>



		</tr>

					</tbody></table>



					</td>



				</tr>



			</tbody>



			</table>



		</fieldset>
</div>

     <?php $textmedia = ($mediatypeval=='text')? '' : 'none'; ?>



	<div id="textblock" style="display:<?php echo ($this->input->post('type')== 'text') ? 'block' : $textmedia; ?>">



		<fieldset class="adminform">



		<legend>Enter text:</legend>



			<table class="adminform">



			<tbody>



				<tr>



				<td width="15%">

							<label class='labelform' for="description"><?php echo lang('web_description')?> <span class="required">*</span></label>

					</td>



					<td>

                        <?php



                       // $code = ($this->input->post('description')) ? $this->input->post('description') : (isset($media->code)? $media->code : '');



                        //$this->ckeditor->editor("description",$code);



                        ?>



						



						<textarea id="description" name="description"  /><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($media->code)) ? $media->code : ''); ?></textarea> 



						



                        <!--<textarea name="description" id="description" class="stinput" rows="6"></textarea>-->



	                    <?php echo form_error('description'); ?>

					</td>



				</tr>



			</tbody>



			</table>



		</fieldset>



	</div>

    <?php 
   
    $filemedia = ($mediatypeval=='flash')? '' : 'none'; ?>



	<!-- <div id="fileblock" style="display:<?php echo ($this->input->post('type')== 'flash') ? 'block' : $filemedia ?>"> -->
  <div id="fileblock" style="display:none;">



		<fieldset class="adminform">



		<legend>Select flash source:</legend>

			<table class="adminform">

			<tbody>

				<tr>

<td>
<table width="80%" cellspacing="0" cellpadding="0" border="0">



						<tbody>

            <tr>						



							<td>



								



			 					<table width="100%" cellspacing="0" cellpadding="5" border="0">



		     						<tbody>


		  							<tr>
                      	<td colspan="3">

                  <div id="localfile_f1" style="display: block;">  											
                    <table>
											<tbody>
                      <tr valign="top" id="uploadblock">
												<td width="9%">Upload:</td>
												<td width="91%">
													<div id="fileUploader"><div class="qq-uploader"><div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
													<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">Choose file
													<input type="file" name="file_f1" id="file_f1" class="upload_btn" accept=".fla,.as,.xml,.swf">
													<div class="file_error_f"></div>
													</div><ul class="qq-upload-list"></ul></div></div>
												</td>
										</tr>

										<tr>
											<td width="9%"></td>
											<td width="91%" style="font-weight: bolder;">Maximum File Size 8 MB	</td>
                      <td width="91%" style="font-weight: bolder;">
                        <div id="flash_media" class="mediasize" style="display:<?php echo ($this->input->post('type')== 'flash') ? 'block' : $filemedia ?>">

                         <?php if($media){ ?>
                         <iframe src="<?php echo base_url();?>public/uploads/videos/<?php echo $media->media_title; ?>" width="100%" height="100%" frameborder="0" disableprint="true" style ="background:white">myDocument</iframe>
                         <?php } echo $upload_error; ?>
                       </div>
                      </td>
										</tr>
									</tbody>
                  </table>
                  </div>
								</td>
			 						</tr>
		   				 		</tbody>
						 	</table>
						</td>
					</tr></tbody></table>
					</td>
				</tr>
			</tbody>
			</table>
		</fieldset>
	</div>

					<div class="form-group">

						<div class="col-sm-offset-3 col-sm-5">
							
                            

			<a>



			<?php echo form_submit( 'submit', ($updType == 'edit') ? 'Edit' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'") ); ?>
			</a>

			<a style="margin-top:0px;" href='<?php echo base_url(); ?>course-media/manage' class='btn btn-danger'>Cancel</a>
			</div>
			</div>
			</div>
			</form>
  		</div>
		</div>
	</div>
  </div>
  </div>
  </div>
  <div style="clear:both;"></div>
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









<script>
   //   (function($) {
     var $ =jQuery.noConflict();
        $(document).ready(function() {
          var mySlidebars = new $.slidebars();
          
          $('.toggle-left').on('click', function() {
            mySlidebars.toggle('left');
          });
          
          $('.toggle-right').on('click', function() {
            mySlidebars.toggle('right');
          });
        });
   //   }) (jQuery);
</script>

<!-- tool tip script -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
$('#blah').hide();
$('#remove_id').hide();  
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image").change(function(){
        if( $('#image').val()!=""){
            
            $('#remove_id').show();
            $('#blah').show('slow');
            $('#imgname').hide('slow');
      }
        else{ $('#remove_id').hide();$('#blah').hide('slow');}
        readURL(this);
    });

  
    $('#remove_id').click(function(){
          $('#image').val('');
          $(this).hide();
          $('#blah').hide('slow');
      $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
});
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){
                               //Examples of how to assign the Colorbox event to elements
                               
                         //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});                        
                       $j(".newcategory").colorbox({
                               iframe:true,
                               width:"500px", 
                               height:"500px",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
                                                                                                 
                                               })
                       

                   });

                        </script>
<script>
  $(document).ready(function()
  {
    $("#submit").click(function(){
      var med_type = $("#type").val()
      if(med_type)
      {

      }
    }
  });
</script>

