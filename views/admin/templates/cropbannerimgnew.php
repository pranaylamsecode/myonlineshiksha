<base href="<?php echo $this->config->item('base_url') ?>public/" />
<script src="<?php echo base_url() ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>public/js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script> 

<div class="col-md-12">

<div id="content-top">
    <span class="clearFix">&nbsp;</span>
</div>

<div class='clear'></div>


<div class="col-bcl-6 col-left">
<div id="table-3_length" class="dataTables_length">
  
</div>
</div>

<div class="col-bcr-6 col-right">
<div class="dataTables_filter" id="table-3_filter">

</div>
</div>
<div class="clr"></div>

<div class="containerpg"><div class="pagination">
              

        </div>
        </div>    
    
</div>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A basic demo of Cropper.">
  <meta name="keywords" content="HTML, CSS, JS, JavaScript, jQuery plugin, image cropping, front-end, frontend, web development">
  <meta name="author" content="Fengyuan Chen">
  <title>Cropper</title>
  <link href="<?php echo base_url(); ?>public/cropper/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>public/cropper/dist/cropper.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>public/cropper/demo/css/main.css" rel="stylesheet">

  
</head>
<body>
  

  <!-- Content -->
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <!-- <h3 class="page-header">Demo:</h3> -->
        <div class="img-container">
         
          <img src="<?php echo base_url(); ?>public/uploads/settings/img/logo/1619_10-13-2018.png" id="viewimageorg" alt="Picture">
        </div>
      </div>
      <div class="col-md-3">
        <!-- <h3 class="page-header">Preview:</h3> -->
        <div class="docs-preview clearfix" style="display:none">
          <div class="img-preview preview-lg"></div>
          <div class="img-preview preview-md"></div>
          <div class="img-preview preview-sm"></div>
          <div class="img-preview preview-xs"></div>
        </div>

  
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 docs-buttons">
        <!-- <h3 class="page-header">Toolbar:</h3> -->
        <div class="btn-group">
          
          <button class="btn btn-primary" data-method="zoom" data-option="0.1" type="button" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="Zoom In">
              <span class="icon icon-zoom-in"></span>
            </span>
          </button>
          <button class="btn btn-primary" data-method="zoom" data-option="-0.1" type="button" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="Zoom Out">
              <span class="icon icon-zoom-out"></span>
            </span>
          </button>
       
        </div>

        <div class="btn-group">
         
          <button class="btn btn-primary" data-method="reset" type="button" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" title="Reset">
              <!-- <span class="icon icon-refresh"> --></span>Reset
            </span>
          </button>
          &nbsp
          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
            <input class="sr-only" id="inputImage" name="file" type="file" accept="image/*">
            <span class="docs-tooltip" data-toggle="tooltip" title="Upload Image">
              <!-- <span class="icon icon-upload"></span> -->Upload Image
            </span>
          </label>
         
        </div>

        <div class="btn-group btn-group-crop">
          <button class="btn btn-primary" data-method="getCroppedCanvas" type="button">
            <span class="docs-tooltip" data-toggle="tooltip" title="Crop And Save Image">
              Crop And Save
            </span>
          </button>
          
        </div>

        <!-- Show the cropped image in modal -->
        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4><a onclick="getcan()">click</a><img src="" width="50" height="50" id="imga">
              </div>
              <div class="modal-body"></div>
              
            </div>
          </div>
        </div><!-- /.modal -->

      
      </div><!-- /.docs-buttons -->

      <div class="col-md-3 docs-toggles">
       
          <div id="demodiv" style="display:none">hdhh</div>
         
      </div><!-- /.docs-toggles -->
    </div>
  </div>
   
  <!-- Alert -->
  <div class="docs-alert"><span class="warning message"></span></div>

  <!-- Scripts -->
  <script src="<?php echo base_url(); ?>public/cropper/assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>public/cropper/assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>public/cropper/dist/cropper.js"></script>
  <script src="<?php echo base_url(); ?>public/cropper/demo/js/main.js"></script>


  <script>
  $(document).ready(function(){
     var canvas = document.getElementsByTagName("canvas");  
  
  });
  </script>



  <script>
  function getcan() 
  {
     var canvas = document.getElementsByTagName("canvas");  
   var ima = canvas[0].toDataURL();  
   //alert(ima);
   $('#imga').attr("src",ima);
  }
  </script>
</body>
</html>



<script>
function addcrop(img)//for add to favorites
    {
      var img_name = $('#bannername',parent.document).val();
      alert(img_name);
    $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/templates/uploadScreenShots/<?php echo $this->uri->segment(4);?>",
            data: {img:img,img_name:img_name}, 
            beforeSend : function(data){ jQuery("body").html('<img style="position: absolute;top: 39%;left: 42%;" src="<?php echo base_url(); ?>public/images/loading.gif" />'); }, 
            success: function(data)
            {
                
                $("#cboxClose",parent.document).click();
                $("#demoinput",parent.document).val(data);
                $("#imgnamebanner",parent.document).attr('src', img);

            }
          }); 
    }
</script>

