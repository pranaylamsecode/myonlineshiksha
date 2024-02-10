<!-- Header -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.1.3/cropper.css">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.1.3/cropper.js"></script> -->
<script src="<?php echo base_url() ?>public/Cropper.js_files/cropper.js"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.slim.min.js"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- <script src="<?php echo base_url() ?>public/Cropper.js_files/google-analytics.js.download"></script> -->

  <script src="<?php echo base_url() ?>public/Cropper.js_files/main.js"></script>
<style>
  .btn {
  padding-left: .75rem;
  padding-right: .75rem;
}

label.btn {
  margin-bottom: 0;
}

.d-flex > .btn {
  flex: 1;
}

.carbonads {
  border-radius: .25rem;
  border: 1px solid #ccc;
  font-size: .875rem;
  overflow: hidden;
  padding: 1rem;
}

.carbon-wrap {
  overflow: hidden;
}

.carbon-img {
  clear: left;
  display: block;
  float: left;
}

.carbon-text,
.carbon-poweredby {
  display: block;
  margin-left: 140px;
}

.carbon-text,
.carbon-text:hover,
.carbon-text:focus {
  color: #fff;
  text-decoration: none;
}

.carbon-poweredby,
.carbon-poweredby:hover,
.carbon-poweredby:focus {
  color: #ddd;
  text-decoration: none;
}

@media (min-width: 768px) {
  .carbonads {
    float: right;
    margin-bottom: -1rem;
    margin-top: -1rem;
    max-width: 360px;
  }
}

.footer {
  font-size: .875rem;
}

.heart {
  color: #ddd;
  display: block;
  height: 2rem;
  line-height: 2rem;
  margin-bottom: 0;
  margin-top: 1rem;
  position: relative;
  text-align: center;
  width: 100%;
}

.heart:hover {
  color: #ff4136;
}

.heart::before {
  border-top: 1px solid #eee;
  content: " ";
  display: block;
  height: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 50%;
}

.heart::after {
  background-color: #fff;
  content: "♥";
  padding-left: .5rem;
  padding-right: .5rem;
  position: relative;
  z-index: 1;
}

.img-container,
.img-preview {
  background-color: #f7f7f7;
  text-align: center;
  width: 100%;
}

.img-container {
  margin-bottom: 1rem;
  max-height: 497px;
  min-height: 200px;
}

@media (min-width: 768px) {
  .img-container {
    min-height: 497px;
  }
}

.img-container > img {
  max-width: 100%;
}

.docs-preview {
  margin-right: -1rem;
}

.img-preview {
  float: left;
  margin-bottom: .5rem;
  margin-right: .5rem;
  overflow: hidden;
}

.img-preview > img {
  max-width: 100%;
}

.preview-lg {
  height: 12.5rem !important;
  width: 21.875rem !important;
}
.preview-lg img{
 width: 100% !important;
 height: 100%  !important;
}

.preview-md {
  height: 11.25rem !important;
  width: 20rem !important;
}
.preview-md img{
 width: 100% !important;
 height: 100% !important;
}

.preview-sm {
  height: 2.25rem;
  width: 4rem;
}

.preview-xs {
  height: 1.125rem;
  margin-right: 0;
  width: 2rem;
}

.docs-data > .input-group {
  margin-bottom: .5rem;
}

.docs-data > .input-group > label {
  justify-content: center;
  min-width: 5rem;
}

.docs-data > .input-group > span {
  justify-content: center;
  min-width: 3rem;
}

.docs-buttons > .btn,
.docs-buttons > .btn-group,
.docs-buttons > .form-control {
  margin-bottom: .5rem;
  margin-right: .25rem;
}

.docs-toggles > .btn,
.docs-toggles > .btn-group,
.docs-toggles > .dropdown {
  margin-bottom: .5rem;
}

.docs-tooltip {
  display: block;
  margin: -.5rem -.75rem;
  padding: .5rem .75rem;
}

.docs-tooltip > .icon {
  margin: 0 -.25rem;
  vertical-align: top;
}

.tooltip-inner {
  white-space: normal;
}

.btn-upload .tooltip-inner,
.btn-toggle .tooltip-inner {
  white-space: nowrap;
}

.btn-toggle {
  padding: .5rem;
}

.btn-toggle > .docs-tooltip {
  margin: -.5rem;
  padding: .5rem;
}

@media (max-width: 400px) {
  .btn-group-crop {
    margin-right: -1rem!important;
  }
  .btn-group-crop > .btn {
    padding-left: .5rem;
    padding-right: .5rem;
  }
  .btn-group-crop .docs-tooltip {
    margin-left: -.5rem;
    margin-right: -.5rem;
    padding-left: .5rem;
    padding-right: .5rem;
  }
}

.docs-options .dropdown-menu {
  width: 100%;
}

.docs-options .dropdown-menu > li {
  font-size: .875rem;
  padding-left: 1rem;
  padding-right: 1rem;
}

.docs-options .dropdown-menu > li:hover {
  background-color: #f7f7f7;
}

.docs-options .dropdown-menu > li > label {
  display: block;
}

.docs-cropped .modal-body {
  text-align: center;
}

.docs-cropped .modal-body > img,
.docs-cropped .modal-body > canvas {
  max-width: 100%;
}

</style>

  

  <!-- Content -->
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <!-- <h3>Demo:</h3> -->
        <div class="img-container">
          <img src="<?php echo base_url();?>public/uploads/programs/img/thumb_232_216/<?php echo $img ?>" alt="Picture">
        </div>
      </div>
      <div class="col-md-3">
        <!-- <h3>Preview:</h3> -->
        <div class="docs-preview clearfix">
          <div class="img-preview preview-lg"></div>
          <div class="img-preview preview-md"></div>
        </div>

    
      </div>
    </div>
    <div class="row" id="actions">
      <div class="col-md-9 docs-buttons">
        <!-- <h3>Toolbar:</h3> -->
       

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
              <span class="fa fa-search-plus"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
              <span class="fa fa-search-minus"></span>
            </span>
          </button>
        </div>

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
              <span class="fa fa-arrow-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
              <span class="fa fa-arrow-right"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
              <span class="fa fa-arrow-up"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
              <span class="fa fa-arrow-down"></span>
            </span>
          </button>
        </div>

       

       

       

        <div class="btn-group">
         
          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
            <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
              <span class="fa fa-upload"></span>
            </span>
          </label>
          
        </div>

        <div class="btn-group btn-group-crop">         
          <!-- data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }" -->
          <button type="button" class="btn btn-success" data-method="getCroppedCanvas" >
            <span class="docs-tooltip" data-toggle="tooltip" title="Upload">Crop and Save
            </span>
          </button>
        </div>

        <!-- Show the cropped image in modal -->
        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
              </div>
            </div>
          </div>
        </div><!-- /.modal -->

       
      </div><!-- /.docs-buttons -->

      <div class="col-md-3 docs-toggles">
       
      </div><!-- /.docs-toggles -->
    </div>
  </div>



  <script>
    window.onload = function() {

  'use strict';

  var Cropper = window.Cropper;
  var URL = window.URL || window.webkitURL;
  var container = document.querySelector('.img-container');
  var image = container.getElementsByTagName('img').item(0);
  var download = document.getElementById('download');
  var actions = document.getElementById('actions');
  var dataX = document.getElementById('dataX');
  var dataY = document.getElementById('dataY');
  var dataHeight = document.getElementById('dataHeight');
  var dataWidth = document.getElementById('dataWidth');
  var dataRotate = document.getElementById('dataRotate');
  var dataScaleX = document.getElementById('dataScaleX');
  var dataScaleY = document.getElementById('dataScaleY');
  var options = {
    aspectRatio: 321 / 180,
    preview: '.img-preview',
    ready: function(e) {
      console.log(e.type);
    },
    cropstart: function(e) {
      console.log(e.type, e.detail.action);
    },
    cropmove: function(e) {
      console.log(e.type, e.detail.action);
    },
    cropend: function(e) {
      console.log(e.type, e.detail.action);
    },
    crop: function(e) {
      var data = e.detail;

      console.log(e.type);
      dataX.value = Math.round(data.x);
      dataY.value = Math.round(data.y);
      dataHeight.value = Math.round(data.height);
      dataWidth.value = Math.round(data.width);
      dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
      dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
      dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
    },
    zoom: function(e) {
      console.log(e.type, e.detail.ratio);
    }
  };
  var cropper = new Cropper(image, options);
  var originalImageURL = image.src;
  var uploadedImageType = 'image/jpeg';
  var uploadedImageURL;

  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Buttons
  if (!document.createElement('canvas').getContext) {
    $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
  }

  if (typeof document.createElement('cropper').style.transition === 'undefined') {
    $('button[data-method="rotate"]').prop('disabled', true);
    $('button[data-method="scale"]').prop('disabled', true);
  }

  // Download
  if (typeof download.download === 'undefined') {
    download.className += ' disabled';
  }

  // Options
  actions.querySelector('.docs-toggles').onchange = function(event) {
    var e = event || window.event;
    var target = e.target || e.srcElement;
    var cropBoxData;
    var canvasData;
    var isCheckbox;
    var isRadio;

    if (!cropper) {
      return;
    }

    if (target.tagName.toLowerCase() === 'label') {
      target = target.querySelector('input');
    }

    isCheckbox = target.type === 'checkbox';
    isRadio = target.type === 'radio';

    if (isCheckbox || isRadio) {
      if (isCheckbox) {
        options[target.name] = target.checked;
        cropBoxData = cropper.getCropBoxData();
        canvasData = cropper.getCanvasData();

        options.ready = function() {
          // console.log('ready');
          cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
        };
      } else {
        options[target.name] = target.value;
        options.ready = function() {
          // console.log('ready');
        };
      }

      // Restart
      cropper.destroy();
      cropper = new Cropper(image, options);
    }
  };

  // Methods
  actions.querySelector('.docs-buttons').onclick = function(event) {
    var e = event || window.event;
    var target = e.target || e.srcElement;
    var cropped;
    var result;
    var input;
    var data;
    // console.log(target);
    if (!cropper) {
      return;
    }

    while (target !== this) {
      if (target.getAttribute('data-method')) {
        break;
      }

      target = target.parentNode;
    }

    if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
      return;
    }

    data = {
      method: target.getAttribute('data-method'),
      target: "<?php echo base_url('public') ?>",
      // option: target.getAttribute('data-option') || undefined,
      option: '{ "width": 350, "height": 200 }' || undefined,
      secondOption: '{ "width": 303, "height": 180 }'  || undefined
    };
// console.log(data);
    cropped = cropper.cropped;

    if (data.method) {
      // if (typeof data.target !== 'undefined') {
      //   // input = document.querySelector(data.target);

      //   // if (!target.hasAttribute('data-option') && data.target && input) {
      //     try {
      //       data.option = JSON.parse(input.value);
      //     } catch (e) {
      //       console.log(e.message);
      //     }
      //   // }
      // }
      // console.log(data.option);

      switch (data.method) {
        case 'rotate':
          if (cropped) {
            cropper.clear();
          }

          break;

        case 'getCroppedCanvas':
          try {
            data.option = JSON.parse(data.option);
            data.secondOption = JSON.parse(data.secondOption);
            // console.log(data.option);
            // console.log(data.secondOption);

          } catch (e) {
            console.log(e.message);
            console.log('catch');

          }

          if (uploadedImageType === 'image/jpeg') {
            if (!data.option) {
              data.option = {};
            }

            data.option.fillColor = '#fff';
          }

          break;
      }

      result = cropper[data.method](data.option, data.secondOption);
      // result2 = cropper[data.method](data.secondOption, data.option);

// console.log(result);
      switch (data.method) {
        case 'rotate':
          if (cropped) {
            cropper.crop();
          }

          break;

        case 'scaleX':
        case 'scaleY':
          target.setAttribute('data-option', -data.option);
          break;

        case 'getCroppedCanvas':
          if (result) {
            // console.log(result)
            var dataURL = result.toDataURL(uploadedImageType);
            // console.log(dataURL);
            addcrop(dataURL);
            // if (!download.disabled) {
            //   download.href = result.toDataURL(uploadedImageType);
            // }
          }

          break;

        case 'destroy':
          cropper = null;

          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
            uploadedImageURL = '';
            image.src = originalImageURL;
          }

          break;
      }

      if (typeof result === 'object' && result !== cropper && input) {
        try {
          input.value = JSON.stringify(result);
        } catch (e) {
          console.log(e.message);
        }
      }
    }
  };

  function addcrop(img)//for add to favorites
    {
      var croptype ="<?php echo $this->uri->segment(6);?>";
      var course_id ="<?php echo $course_id;?>";
      var img_name = $('#imagename',parent.document).val();
    $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/programs/uploadcourseimg/"+course_id+"/<?php echo $this->uri->segment(6);?>",

            data: {img:img,img_name:img_name}, 
            beforeSend : function(data){ jQuery("body").html('<img style="position: absolute;top: 39%;left: 42%;" src="<?php echo base_url(); ?>public/images/loading.gif" />'); }, 
            success: function(data)
            {
              console.log(data);
                // alert('success');
               // parent.jQuery.fancybox.close();
                 $("#cboxClose",parent.document).click();
               // if(croptype == 'courseedit' || croptype == 'coursecreate')
               // {
                // $('#imagename',parent.document).val(img_name);
                $("#imagname",parent.document).attr('src', img);
                $("#cropimage",parent.document).val(data);
                // $("#imagename",parent.document).val(data);
               //}
            }
          }); 
    }

  document.body.onkeydown = function(event) {
    var e = event || window.event;

    if (!cropper || this.scrollTop > 300) {
      return;
    }

    switch (e.keyCode) {
      case 37:
        e.preventDefault();
        cropper.move(-1, 0);
        break;

      case 38:
        e.preventDefault();
        cropper.move(0, -1);
        break;

      case 39:
        e.preventDefault();
        cropper.move(1, 0);
        break;

      case 40:
        e.preventDefault();
        cropper.move(0, 1);
        break;
    }
  };

  // Import image
  var inputImage = document.getElementById('inputImage');

  if (URL) {
    inputImage.onchange = function() {
      var files = this.files;
      var file;

      if (cropper && files && files.length) {
        file = files[0];
        // console.log('filesss');
        // console.log(file);

        if (/^image\/\w+/.test(file.type)) {
          uploadedImageType = file.type;

          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
          }

          image.src = uploadedImageURL = URL.createObjectURL(file);
          cropper.destroy();
          cropper = new Cropper(image, options);
          inputImage.value = null;
        } else {
          window.alert('Please choose an image file.');
        }
      }
    };
  } else {
    inputImage.disabled = true;
    inputImage.parentNode.className += ' disabled';
  }
};

  </script>