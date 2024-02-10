<!-- <base href="<?php echo $this->config->item('base_url') ?>public/" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css"> 

<script type="text/javascript">
  BASE_URL = "<?php echo base_url();?>";
</script>
<?php //echo base_url(); ?>
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.css">  -->


<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/theme_admin.css" type="text/css" media="screen" />

<style>
/*#sidemenu.sidebar-menu.sidebar-menu
{
  width: 60px!important;
}*/
#video_section #video_frame {
    width: 650px;
    max-width: 90%;
    margin: 0 auto;
}
#video_section
{
    position: absolute;
    /*top: 410px;*/
    top: 35%;
    /*bottom: 2%;*/
    left: 0px;
    z-index: 99;
    right: 0px
}
.default_image {
    width: 56px;
    margin: 0 auto 10px auto;
}
#rowsmedia img{
  width: auto!important;
}
#message {
    position: fixed; 
/*    color: green;
*/    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 10000;
}
.video-js{
  width: 100%;
  height: 325px;
}
#style-2::-webkit-scrollbar-track
{
    border-radius: 0px;
    background-color: transparent;
}
#style-2::-webkit-scrollbar
{
    width: 0px;
    background-color: transparent;
}
#style-2::-webkit-scrollbar-thumb
{
    border-radius: 0px;
    background-color:transparent;
}
.scrollbar2 {
  overflow-y: scroll;
  overflow-x: hidden;
}
.element-view-content:hover {
    opacity: 0.5 !important;
    cursor: pointer;
    /*padding: 135px 15px 60px 15px!important;*/
}
.element-view-content:hover .mock {
    color: white;
}
.element-view-content:hover:before{
  content: 'Click Here to Add / Edit';
    color: black;
    font-weight: 500;
    font-size: 23px;
    position: absolute;
    top: 45%;
    left: 36%;


}
  img
  {
    width: 100%;
  }
.highlight {height: 12em; line-height: 12em;border: 1px dashed rgba(21, 20, 20, 0.52);}
.highlight2 {height: 3.4em; line-height: 3.4em;border: 1px dashed rgba(21, 20, 20, 0.52);}

ul.lay-ul2 {
  padding: 0;
  margin: 0;
  list-style: none;
  height: auto;
  /*overflow: auto;*/
  }
.not-active {
 pointer-events: none;
 cursor: default;
}
.overlay-imf-pdf {
  position: absolute;
  z-index: 1;
  display: block;
  width: 100%;
  height: 100px;
  background: rgba(8, 8, 8, 0.03);
  cursor: pointer;
}

.abc{
 border: 3px solid #5b9dd9; 
 cursor: pointer;
}
i.fa.fa-check-square {
   position: absolute;   
   left: 91px;
   font-size: 20px;
   color: #5b9dd9;
}

/*form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }*/
.progressBar {
    width: 200px;
    height: 18px;
    background-color: orange;
    display: none;
}

.progressBar #bar, #bar_gallery, #bar_video, #bar_audio, #bar_pdf, #bar_flash {
     height: 100%;
    color: #fff;
    width: 0;
    text-align: right;
    line-height: 22px;
    border-radius: 19px;
    background-color: orange;
    background: url('http://www.cssdeck.com/uploads/media/items/7/7uo1osj.gif') repeat-x;
    opacity: 0.7;
}

#progress {     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 21px;
}
#progress_gallery{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_video{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_audio{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_pdf{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_pdf{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_flash{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
/*#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }*/
#percent, #percent_gallery, #percent_video, #percent_audio, #percent_pdf, #percent_flash { 
  position: relative;
    display: inline-block;
    top: -14px;
    left: 0%;
    color: black;
 }
.img-pop-active {
    -webkit-box-shadow: inset 0 0 0 3px #fff,inset 0 0 0 7px #0073aa;
    box-shadow: inset 0 0 0 3px #fff,inset 0 0 0 7px #0073aa;
} 
.fileinput .btn {
    vertical-align: middle;
}
.btn-file {
    overflow: hidden;
    position: relative;
    vertical-align: middle;
}

.fileinput-exists .fileinput-new, .fileinput-new .fileinput-exists {
    display: none;
}
.btn-file > input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    opacity: 0;
    filter: alpha(opacity=0);
    transform: translate(-300px, 0) scale(4);
    font-size: 23px;
    direction: ltr;
    cursor: pointer;
}
input[type="file"] {
    display: block;
}
.dragdroplayout {
  background: none!important;
}
/*css*/
.jconfirm .jconfirm-box div.title {
  background: transparent;
  font-size: 18px;
  font-weight: 600;
  font-family: 'AvenirNextLTPro-Demi'!important;
  padding: 10px 15px 10px;
  text-align: center;
  display: block;
  color: #c42140;
  text-transform: uppercase;
  font-size: 21px!important;
  font-weight: bold;
  text-align: center!important;
  padding: 17px 30px 0 13px !important;
  border-bottom: 0px!important;
  margin-top: 0px!important;
  background-color: #f1f1f1!important;
  height: 73px!important;
}
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  text-align: center;
  font-size: 15px;
  margin: 4% 0px 2%;
  font-weight: bold!important;
}
button.btn.btn-success {
  background-color: #04A600!important;
}
.stick #inform_btn {
  display: none;
}

/*.page-container {
  padding-left: 60px;
}
*/
/*.element-view-content img{
  width: auto !important;
}*/
/*end of css*/
</style>

<script>   
   jQuery(document).ready(
    function()
    {
      //jQuery('#description').redactor();
      jQuery('#lec_content').redactor({
              focus: true,
              imageUpload: window.location.origin+'/admin/tasks/getImage',
              'plugins': ['fontsize','fontcolor','fontfamily','video','imagelink'],
                  
      });
      jQuery('.txt_content').redactor({
              focus: true,
              imageUpload: window.location.origin+'/admin/tasks/getImage',
              'plugins': ['fontsize','fontcolor','fontfamily','video','imagelink'],
                  
      });

    }
  );
</script>


  <style type="text/css">

body {
  overflow-x: hidden;
}

.btnFloat
{
  display: inline-block;
  float: left;
    margin: 10px 4px 2px 0;
}
    .fancybox-custom .fancybox-skin {

      box-shadow: 0 0 50px #222;

    }


      .error{



        color: red;



        font-size:13px;



      }
      .ptext
      {
  display: block;
  float: right;
  width: 31.5%;
  margin-top: -5px;
  padding: 10px;
      }
.redactor_box {
  min-height: 500px;
}

@media(max-width:480px){
.page-body .page-container {
  padding-left: 0;
  top: 0;
  bottom: 0;
  position: fixed;
  overflow-y: scroll;
}
.page-body .page-container .main-content{
  max-width: 1000px;
  min-width: 1000px;  
}
#cart2 {
  width: 75%;
  float: right;
}
.sidebar-nav{
   float: left; 
}
#column_1 {
  width: 100%;
}
.page-container .sidebar-menu .sidebar-user-info .user-link img{
   max-width: 80px; 
}
.col-md-12 .element-view-content {
  width: 93.5%!important;
}
.col-md-3 .element-view-content {
  width: 93%!important;
}
.col-md-6 .element-view-content {
  width: 93%!important;
}
.col-md-4 .element-view-content {
  width: 93%!important;
}
.col-md-8 .element-view-content {
  width: 93%!important;
}
}
  </style>

 <script type="text/javascript">
 jQuery(function(){
   jQuery("#forward").click(function() {
   window.parent.location.href = "<?php echo base_url(); ?>admin/days/<?php echo $pid?>";

    });

      });

</script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://myonlineshiksha.com/public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />

<script src="https://myonlineshiksha.com/public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="e9f1fb63bc5c9d25a17369c8-text/javascript"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script src="<?php echo base_url()?>public/js/lectureseditor/lecturedragndrop_admin.js"></script>
<div class="main-container">
<div id="video_section" style="display: <?php echo $task->lecture_type == 'video' ? 'block' : 'none'; ?>">

  <?php
$VID = '';
  if($task->lecture_type == 'video'){
  $VID =$task->lecture_video; ?>
    <style>
      .lect_tab_content{
        margin-bottom: 650px;
      }
    </style>
  <?php } ?>
<!-- <div data-vimeo-defer data-vimeo-width="500" id="handstick"></div> -->

<script src="https://player.vimeo.com/api/player.js"></script>
<script>
  $(document).on('click','.remove_video',function(){
          // $('#made-in-ny').html('');
            var iframe = $('iframe').get(0);
    var player = new Vimeo.Player(iframe);
    player.pause();
          $('#video_frame').hide();
          $('#Lec_videoId').val('');
          $('#myModalyoutube1').show();
        });
</script>
<div id="video_frame" style="display: <?php echo $VID ? 'block' : 'none'; ?> ">
  <button type="button" class="close remove_video renew-top-close-btn" style="margin-right: 5%;">&times;</button>
  <div data-vimeo-defer id="made-in-ny">

     <!--  <img id="vid_loader" src="<?php echo base_url() ?>public/images/loading.gif" style="width: 20px; position: absolute;"> -->
    </div>
</div>
    

<?php if($VID){ ?>
      <script>
      /*var options = {
        url: 'https://player.vimeo.com/video/'+<?php // echo $VID ?>,
          width: 649,
          loop: true
      };
      var madeInNy = new Vimeo.Player('made-in-ny', options);
      madeInNy.getDuration().then(function(s) {
          if(s)
          {
            var h = Math.floor(s/3600); //Get whole hours
              s -= h*3600;
              var m = Math.floor(s/60); //Get remaining minutes
              s -= m*60;
              var lec_dur = h+":"+(m < 10 ? '0'+m : m)+":"+(s < 10 ? '0'+s : s);
              $('#lecture_duration').val(lec_dur+' mins');
          }
      }).catch(function(error) {
         console.log(error);
      });*/
      var hash ="";
      $(document).ready(function(){
        $.ajax({
           type: 'GET',
           url: '<?php echo base_url();?>admin/tasks/getVimeoVid/'+<?php echo $VID ?>,
        }).done(function(data) {
            console.log( data);
            var options = {
                  url: 'https://vimeo.com/'+<?php echo $VID ?>+'/'+data,
                  width: 649,
                  loop: true
            };
            var madeInNy = new Vimeo.Player('made-in-ny', options);
            madeInNy.getDuration().then(function(s) {
                if(s)
                {
                    var h = Math.floor(s/3600); //Get whole hours
                    s -= h*3600;
                    var m = Math.floor(s/60); //Get remaining minutes
                    s -= m*60;
                    var lec_dur = h+":"+(m < 10 ? '0'+m : m)+":"+(s < 10 ? '0'+s : s);
                    $('#lecture_duration').val(lec_dur+' mins');
                    console.log(lec_dur);
                }
            }).catch(function(error) {
                console.log(error);
            });
        });
      })
      </script>
      <?php   } ?>
<div class="edit_lecture_popup" id="myModalyoutube1" >
  <!-- style="display: <?php // echo $VID ? 'none' : 'block'; ?> " -->
    
    
    <div class="modal-dialog" >
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <!-- <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title renew-head">Upload your videos</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    

      <div> 
        <ul class="nav nav-tabs bordered blue-border">
          <li class="active" id="vimeo_file" > 
            <a href="#vimeo-upfil" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-home"></i></span> 
            <span class="hidden-xs">Upload File</span> 
            </a> 
          </li>
          <li class="" id="vimeo_library" > 
            <a href="#vimeo-medlib" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-home"></i></span> 
            <span class="hidden-xs">Media Library</span> 
            </a> 
          </li>

          <!-- ================ -->
          <!-- <li id="video_file" style="border-left:none!important;"> 
            <a href="#video-upfil" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-home"></i></span> 
            <span class="hidden-xs">Upload File</span> 
            </a> 
          </li> --> 
          <!-- <li id="video_library"> 
            <a href="#video-medlib" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Media Library</span> 
            </a> 
          </li> -->
          <li id="video_url"> 
            <a href="#videoins" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Video URL</span> 
            </a> 
          </li>
          <li id="video_url"> 
            <a href="#videoiframe" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Embed Code</span> 
            </a> 
          </li>
          
        </ul> 

        <div class="tab-content tab-box" style="display: -webkit-box;">

          <!-- ======================================== -->
            <div class="tab-pane active" id="vimeo-upfil" style="width:100%;"> 
              
            <div class="default_image">
                <img src="https://myonlineshiksha.com/public/images/dafault_img.jpg">
            </div>
          <form id="vimeoForm" action="https://myonlineshiksha.com/admin/tasks/upload_vimeo" method="post" 
          enctype="multipart/form-data">
      <!--   <?php $attributes = array('id' => 'vimeoForm22');

// echo form_open_multipart('https://myonlineshiksha.com/admin/tasks/upload_test', $attributes);
 ?>
 <input type="file" name="img">
 <input type="text" name="name">
 <input type="submit" id="submitvimeo11" class="btn btn-blue" value="Save"/>
<?php echo form_close(); ?>  --> 
          <div class="form-group form_inner_div" > 
              <label class="col-sm-12 txt_cntr_algn field-title control-label" style="color: #38425d">Title(required)</label> 
                <div class="col-sm-12 txt_cntr_algn no-padding">
                 <input class="form-control" type="text" name="vimeo_title">
               </div>
           </div>          

            <div class="form-group"> 
            <!--   <label class="col-sm-12 txt_cntr_algn field-title control-label">Upload File</label> 
 -->
              
              <div class="col-sm-12 txt_cntr_algn no-padding"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <input type="hidden" value="" name="..."> 

                  <span id="vimeouploadFile" class="btn btn-info btn-file btn-border-blue"> 
                    <span class="fileinput-new"><i class="fas fa-cloud-upload-alt"></i>Choose a file</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="video/*" name="file_i" id="file_v"> 
                  </span>

                  

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div> 

                <div id="progress_video" class="txt_cntr_algn progressBar center_progress" style="display: none;">
                <div class="progress_bar_outer">
                          <div id="bar_video" class="progress_bar_process" style="width: 0%"></div>
                          </div>
                          <div id="percent_video" class="progress_bar_per">Uploading 0% done</div >
                  </div> 
                <div class="progress_note">
                 <i class="fas fa-info-circle"></i><p>When your upload is complete, we'll convert your file. After that your video will be ready! You can select ready videos from <a href="#vimeo-medlib" class="medlib_tab" data-toggle="tab">Media Library.</a></p>
                </div>
                <div class="success_note" style="display: none;">
                  Upload complete! <a href="#vimeo-medlib" class="medlib_tab"data-toggle="tab">Go to video.</a>
                </div>
              </div>

            </div>
          
            <div class="form-group form_inner_div">
            <label class="control-label"></label> 

              <div class="col-sm-12 txt_cntr_algn no-padding"> 
                  <!-- <input type="hidden" value="" id="video_div_id" name="video_div_id"> -->
                  <input type="hidden" name="vimeo_section_id" id="vimeo_section_id" value="4233" class="form-control">                  
                  <input type="hidden" name="vimeo_course_id" id="vimeo_course_id" value="665" class="form-control">
                  <input type="hidden" name="vimeo_media_type" id="vimeo_media_type" value="Video" class="form-control">
                
                <!-- <input type="submit" id="submitvimeo" class="btn btn-blue" value="Save"/> -->
              </div>

            </div>
           </form>
          </div>


          <!-- ======================================== -->


          <div class="tab-pane" id="vimeo-medlib" style="width:100%;"> 
            <div class="col-sm-12" id="vimeo_row_list" style="height: 175px;overflow: auto;">
               <button class="btn" onclick="vimeoLoadData(1)" data-cf-modified-31b28e6355e2c7e66dd80faa-=""><i class="fa fa-refresh" style="padding-right: 2px" ></i> Refresh </button>
               

             <!--  <button onclick="vimeoLoadData(1,'file')">search</button> -->
            <div class="row" id="vimeo_list" style="padding: 0 0 10px 0;">
             
            </div>
            
            </div>

            <div class="col-sm-12" style="display:block;padding-top: 20px;padding-left:0px;padding-right:0px;">
            <form id="" name="" action="" method="post" enctype="multipart/form-data">
              <div class="form-group form-border">
              <!-- <label class="col-sm-12 no-padding field-title control-label">Title</label>  -->
                <div class="col-sm-12 no-padding">      
                <input type="hidden" value="" id="video_div_id" name="video_div_id">

                  <input type="hidden" name="vimeo_id" id="vimeo_id" class="form-height form-control">
                  <input type="hidden" name="title_vimeo" id="title_vimeo" class="form-height form-control">
                  <!-- <input type="text" name="alt_title_vimeo" id="alt_title_vimeo" class="form-height form-control"> -->

                </div>
              </div>            


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding select_new_btn"> 
                  <input type="button" id="selectVimeo" class="btn btn-blue" value="Select" />
                  <i class="fas fa-cloud-upload-alt"></i>
                </div>

              </div>  
              </form>
            </div>


          </div> 


          <!-- ======================================== -->

<!--
          <div class="tab-pane" id="video-upfil" style="width:100%;"> 
          <form id="videoForm" action="https://myonlineshiksha.com/admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group"> 
              <label class="col-sm-12 txt_cntr_algn field-title control-label">Upload File</label> 

              <div class="col-sm-12 txt_cntr_algn"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <input type="hidden" value="" name="..."> 

                  <span id="uploadFile" class="btn btn-info btn-file btn-border-blue"> 
                    <span class="fileinput-new" onclick="return true;">Select file</span> 
                    <span class="fileinput-exists">Change</span> 
                  </span>

                  

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div> 
                <div id="progress_video" class="txt_cntr_algn progressBar center_progress">
                          <div id="bar_video"></div>
                          <div id="percent_video">0%</div >
                  </div> 
              </div>

            </div>
          
            <div class="form-group">
            <label class="control-label"></label> 

              <div class="col-sm-12 txt_cntr_algn"> 
                  <input type="hidden" value="" id="video_div_id" name="video_div_id">
                  <input type="hidden" name="section_id" id="section_id" value="4233" class="form-control">                  
                  <input type="hidden" name="course_id" id="course_id" value="665" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Video" class="form-control">
                <input type="button" id="submitvideo" class="btn btn-blue" value="Save"/>
              </div>

            </div>
           </form>
          </div>  -->
      <!--     <div class="tab-pane" id="video-medlib" style="width:100%;"> 
            <div class="col-sm-12" id="video_row_list" style="height: 175px;overflow: auto;">

            <div class="row" id="video_list" style="padding: 0 0 10px 0;">
            </div>
               
              
            </div>

            <div class="col-sm-12" style="display:block;padding-top: 20px;padding-left:0px;padding-right:0px;">
            <form id="save_video_data" name="save_video_data" action="https://myonlineshiksha.com/admin/tasks/update_video_data" method="post" enctype="multipart/form-data">
              <div class="form-group form-border">
              <label class="col-sm-12 no-padding field-title control-label">Title</label> 
                <div class="col-sm-12 no-padding">      

                  <input type="hidden" name="video_id" id="video_id" class="form-height form-control">
                  <input type="hidden" name="title_video" id="title_video" class="form-height form-control">
                  <input type="text" name="alt_title_video" id="alt_title_video" class="form-height form-control">

                </div>
              </div>            


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="submit"  class="btn btn-blue" value="Save" />
                </div>

              </div>  
              </form>
            </div>


          </div>  -->

          <div class="tab-pane" id="videoins" style="width:100%;"> 

            <div class="col-sm-12" style="display:block;padding: 0px;">

              <div class="form-group form-border form_inner_div">
              <label class="col-sm-12 no-padding filed-title control-label">Video URL(Required)</label> 
                <div class="col-sm-12 no-padding"> 
                  <input type="text" class="form-control form-height" id="txt_video_url">
                  <span class="url_note">Youtube, Vimeo video url</span>
                </div>
              </div>


              <div class="form-group form-border ">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding select_new_btn"> 
                  <input type="button" id="videourl" class="btn btn-blue" value="Insert video" onclick="addVideoUrlNEmbed(this.id)" data-cf-modified-31b28e6355e2c7e66dd80faa-="" />
                  <i class="fas fa-cloud-upload-alt"></i>
                </div>

              </div>  

            </div>


          </div> 

          <div class="tab-pane" id="videoiframe" style="width:100%;"> 

            <div class="col-sm-12" style="display:block;padding:0px;">

              <div class="form-group form-border embed_code form_inner_div">
              <label class="col-sm-12 field-title no-padding control-label">Embed code(required)</label> 
                <div class="col-sm-12 no-padding"> 
                  <!-- <input type="text" class="form-control" id="txt_video_embed"> -->
                  <textarea class="form-control select-box-border" id="txt_video_embed" rows="3"></textarea>
                   <span class="url_note">Youtube, Vimeo video url</span>
                </div>
              </div>


              <div class="form-group form-border ">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding select_new_btn"> 
                  <input type="button" id="videoembed" class="btn btn-blue" value="Embed Video" onclick="addVideoUrlNEmbed(this.id)" data-cf-modified-31b28e6355e2c7e66dd80faa-="" />
                  <i class="fas fa-cloud-upload-alt"></i>
                </div>

              </div>  

            </div>


          </div>

        </div> 

      </div>

    </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
  <script>
  $(document).ready(function(){
       videoLoadData(); vimeoLoadData(1);
  });</script>

<?php // } ?>
</div>
<?php



  $attributes = array('class' => 'tform', 'id' => 'frm_edit_lecture');

echo form_open(base_url().'admin/tasks/save_lecture', $attributes);


//echo ($updType == 'create') ? form_open(base_url().'admin/tasks/create', $attributes) : form_open(base_url().'admin/tasks/edit/'.$task->tid.'/'.$did.'/'.$pid, $attributes);



?>



<style>

</style>


<?php $CI = &get_instance();
$CI->load->model('medias_model') ?>

<div id="toolbar-box">
  <div class="m">
    <div class="pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? "Create Lecture" : "Lecture editor";?></h2></div>
    <div id="toolbar" class="toolbar-list">
     
      <div id="sticky-anchor"></div>
        <ul id="sticky" style="list-style:none; float: right;  display: flex;">
          
        
          <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">


      <?php 
        if($updType == 'edit')
        { 
      ?>
        <!-- <a  class="btn btn-orange" id="inform_btn" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Save and Inform</a>
 -->
      <?php
          
        } 
        ?>  

   <!--      <a id="preview_btn" onclick="lecture_preview();" class="btn btn-success btn-blue" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Lecture Preview</a> -->
        <a id="preview_btn" onclick="openmyModalpreview(this.id);" class="btn" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Preview</a>
        </li>



                <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



          <!-- <a>



          <?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn'" : "id='submit' class='btn'  ") ); ?>



          </a> -->

      <a><input type="button" id='lecture_save' name="lecture_save" class='btn' value="Update" onclick="edit_lecture();" ></a> 

          </li>



          <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



          <a href='<?php echo base_url(); ?>admin/section-management/<?php echo $pid?>' class='btn' id="forward"><span class="icon-32-cancel"> </span>Close</a>



          </li>

    
    </div>
    
  </div>
</div>


<input type="hidden" id="Lec_videoId" name="Lec_videoId" value="<?php echo $task->lecture_video ? $task->lecture_video : '' ?>">


<div class="row">
<div class="col-md-6" style="width: 100%;">
  <ul class="nav nav-tabs bordered grey-border blue-border">
    <!-- available classes "bordered", "right-aligned" -->
 <!--    <li class="active"> 
    <a href="#Lecture" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-home"></i></span> 
    <span class="hidden-xs">Lecture Detail</span> 
    </a> 
    </li> -->
    <!-- <li> 
    <a href="#Meta" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-user"></i></span> 
    <span class="hidden-xs">Publish Lecture</span> 
    </a>  
    </li> -->
    <!-- <li> 
    <a href="#Meta" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-user"></i></span> 
    <span class="hidden-xs">Meta Tags</span> 
    </a> 
    </li> -->
  </ul>
  <div class="tab-content tab-box">
   
   <?php //print_r($task); ?>
    <div class="tab-pane active" id="Lecture">
      <dd class="" sno="1">
        <div class="tab-content lect_tab_content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
                        <legend style="border:none;"></legend>
            
      
            <div class="col-sm-12 form-group">
            <div class="col-sm-6 no-padding">
              <label class='col-sm-12 no-left-padding control-label field-title' for="Lesson"><?php echo 'Lecture title:'//echo lang('web_name')?> <span class="required">*</span></label>
              <div class="col-sm-12 no-left-padding">

        <input id="name" class="form-control form-height" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>"  />

<!-- tooltip area -->
            <!-- <span class="tooltipcontainer">

            <span type="text" id="name-target" class="tooltipicon"></span>

            <span class="name-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            

            <?php echo lang('lecture_fld_name');?>

            

            </span>

            </span> -->

<!-- tooltip area finish -->

        <span class="error"><?php echo form_error('name'); ?> </span>
                                
              </div>
            </div>            
           
            <div class="col-sm-3 no-padding">
              <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" >
                Type 
              </label>
              <div class="col-sm-12 no-left-padding">
                <select id="lecture_type" name="lecture_type" class="form-control form-height"  size="1" >
                <option value="video" <?php echo preset_select('lecture_type', 'Video', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?> >Video</option>

                <option value="PDF / Doc" <?php echo preset_select('lecture_type', 'PDF / Doc', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>PDF / Doc</option>

                <option value="Audio" <?php echo preset_select('lecture_type', 'Audio', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Audio</option>

                <option value="Text" <?php echo preset_select('lecture_type', 'Text', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Text</option>

              
               <!--  <option value="exam" <?php echo preset_select('lecture_type', 'exam', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Exam</option> -->
                </select>
              </div>
           </div>
           <div class="col-sm-3 no-padding">
             <label class='col-sm-12 control-label field-title' style="padding-left:0;" for="Lesson">
             Duration
             </label>
             <div class="col-sm-12 no-left-padding">

                <input id="lecture_duration" class="form-control form-height" type="text" name="lecture_duration" placeholder="ex.1:00 Hrs" value="<?php echo set_value('lecture_duration', (isset($task->lecture_duration)) ? $task->lecture_duration : ''); ?>" />
              </div>
           </div>

             <div class="form-group form-border" style="margin:0;padding-top: 0;">
            <div class="col-sm-12 no-padding">
          <div class="grey-background" style="display: -webkit-box;">
             <!--  <label class="col-sm-3 control-label"> </label> -->
             
                <div class="col-sm-1 no-padding" style="width:3%;">                
               <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? 'checked="checked"' : (isset($task->published) && $task->published == '1') ? 'checked="checked"' : ''?> <?php echo $updType == 'create' ? 'checked="checked"':''; ?>/>
              </div>
               <label class='col-sm-11 col-md-1 no-padding control-label dark_label' style="padding-top: 2px;" for='active'>Publish <?//=lang('web_is_active')?> </label>
               <div class="col-sm-1 col-md-1 no-padding" style="width:3%;">                
               <input id="is_demo" type="checkbox" name="is_demo" value='1' <?php echo ($this->input->post('is_demo') == '1') ? 'checked="checked"' : (isset($task->is_demo) && $task->is_demo == '1') ? 'checked="checked"' : ''?>/>
              </div>
               <label class='col-sm-11 col-md-9 no-padding control-label dark_label' style="padding-top: 2px;" for='active'>Set it as a Preview lecture  (Preview lecture can be viewed without enrolling the course) <?//=lang('web_is_active')?> </label>


                <?php echo form_error('published'); ?>
               
               </div>
               </div>
            </div>

           <!--  <div class="col-sm-6 no-padding">
              <label class="col-sm-11  control-label field-title">Level:<span class="required">*</span></label>
              <div class="col-sm-11">
               <select id="difficultylevel" name="difficultylevel" class="form-control form-height"  size="1" >



                                    <option value="">Select Level</option>



                                    <option value="easy" <?php echo preset_select('difficultylevel', 'easy', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Easy</option>



                                    <option value="medium" <?php echo preset_select('difficultylevel', 'medium', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Medium</option>



                                    <option value="hard" <?php echo preset_select('difficultylevel', 'hard', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Hard</option>



                  </select>




                                    <span class="error"><?php echo form_error('difficultylevel'); ?> </span>
              </div>
        
            </div> -->
            
           
</div>
    <?php  if($dripstatus->is_drip_course == '1'){ 
                  ?> 
                   <input id="release_type" name="release_type" value="<?php echo $dripstatus->release_type; ?>" type="hidden">
                 <?php
                  if($dripstatus->release_type == '1'){  ?>
                 
                <div class="col-sm-12  "  id="drip_date"> 
                    <label class="col-sm-12 control-label field-title no-padding"><?php echo 'Lecture Release Date:'//echo lang('web_name')?> <span class="required">*</span></label> 

                    <div class="col-sm-6 no-padding"> 
                    <input class="form-control form-height" id="r_date" type="date" name="release_date" maxlength="256" value="<?php echo set_value('release_date', (isset($task->release_date)) ? $task->release_date : '0'); ?>"  />
                          
                          <!-- tooltip area --> 
                          
                        <!--   <span class="tooltipcontainer"> 
                            <span type="text" id="date-target" class="tooltipicon"></span> <span class="date-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                          
                          tip containt--> 
                          
                          <?php //echo "Lecture Start On Date";?> 
                          
                          <!--/tip containt--> 
                          
                          <!-- </span> </span>  -->
                          
                          <!-- tooltip area finish --> 
                          
                          <span class="error"><?php echo form_error('r_date'); ?> </span>
                    </div> 
                </div>
                <?php } else if($dripstatus->release_type == '2' ) { ?>

                <div class="col-sm-12"  id="drip_days" > 
                    <label class="col-sm-12 control-label field-title no-padding"><?php echo 'Lecture Release Day:'//echo lang('web_name')?> <span class="required">*</span></label> 

                    <div class="col-sm-6 no-padding"> 
                      <!-- <?php echo set_value('release_date', (isset($task->release_date)) ? $task->release_date : ''); ?> -->
                    <input class="form-control form-height" id="r_date" type="number" name="release_day" maxlength="256" value="<?php echo isset($task->release_date) && $task->release_date !='' ? $task->release_date : '0'; ?>"
                    />
                          
                      
                          
                          <span class="error"><?php echo form_error('r_date'); ?> </span>
                    </div> 
                </div>



                <?php }  } ?>
          </fieldset>
          
        </div>
        
        <hr />
        <!-- new code start form here -->

        <!-- third  strat-->


<div class="" style="margin-bottom:40px"> 
  <div class="row" >
    <?php // if($task->lecture_type != 'video'){ ?>
          <div class="col-sm-2 lect_cont" style="display: <?php echo $task->lecture_type != 'video' ? 'block' :'none'  ?>">
            <div id="sticky-anchor1"></div>
            <div class="sidebar-nav" id="sidebar">
             <ul class="nav nav-list "> 
              <li class="nav-header">Layouts</li>

              <li class="rows" id="estRows"> 
                 <!-- first layout -->
                <div class="lyrow ui-draggable">
                <div class="layout-main-table">
                    <div class="layout-orange-bg">
                  <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
                  <a class="drag-layout-btn drag btn btn-default btn-xs">
                    <i class="sprite_old onecol"></i>
                    <i class="entypo-window"></i>
                  </a> 
                  <a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                  
                  <div class="preview">
                    <span></span>
                  </div> 
                  <div class="view right_view_content" style="display:none;">
                    <div class="row clearfix right-main-content" style="margin:0px;">
                      <div class="col-md-12 column dragelement" style="float:right;">                       


                      </div> 
                    </div> 
                  </div> 
                  </div>
                  </div>
                  </div> 

                    <!-- second layout -->
                  <div class="lyrow ui-draggable">
                  <div class="layout-main-table">
                  <div class="layout-green-bg layout-orange-bg">
                    <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
                    <a class="drag-layout-btn drag btn btn-default btn-xs">
                    <i class="sprite_old twocol"></i>
                    <i class="entypo-window"></i>
                    </a>
                    <a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                    
                    <div class="preview">
                      <span></span>
                    </div>

                    <div class="view right_view_content" style="display:none;"> 
                    <div class="row clearfix right-main-content" style="margin:0px;"> 
                    <div class="col-md-6 column dragelement"></div>
                      <div class="col-md-6 column dragelement"></div> 
                      </div> 
                      </div> 
                  </div>
                  </div>
                  </div>

                  <!-- third layout -->
                  <div class="lyrow ui-draggable">
                  <div class="layout-main-table">
                  <div class="layout-orange-bg">
                    <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
                    <a class="drag-layout-btn drag btn btn-default btn-xs"><i class="sprite_old leftcol"></i><i class="entypo-window"></i></a> 
                    <a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                    
                    <div class="preview">
                      <span></span>
                    </div> 
                    <div class="view right_view_content" style="display:none;"> 
                      <div class="row clearfix right-main-content" style="margin:0px;"> 
                        <div class="col-md-4 column dragelement"></div>
                        <div class="col-md-8 column dragelement"></div> 
                      </div> 
                    </div> 
                  </div>       
                  </div>
                  </div>

                  <!-- forth layout -->
                  <div class="lyrow ui-draggable"> 
                  <div class="layout-main-table">
                  <div class="layout-orange-bg">
                    <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a>
                    <a class="drag-layout-btn drag btn btn-default btn-xs">
                    <i class="sprite_old rightcol"></i>
                    <i class="entypo-window"></i>
                    </a> 
                    <a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                    
                    <div class="preview"><span></span></div> 
                    
                    <div class="view right_view_content" style="display:none;"> 
                      <div class="row clearfix right-main-content" style="margin:0px;"> 
                        <div class="col-md-8 column dragelement"></div> 
                      
                        <div class="col-md-4 column dragelement"></div> 
                      </div> 
                    </div> 
                  </div> 
                  </div>
                  </div>
            

            <!-- <div class="lyrow ui-draggable"> 
            <a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
            <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
              <div class="preview"><input type="text" value="3 9" class="form-control"></div> 
              <div class="view"> 
                <div class="row clearfix"> 
                <div class="col-md-3 column"></div> 
                <div class="col-md-9 column"></div> 

                </div> 
              </div> 
            </div> -->
            
            <!-- <div class="lyrow ui-draggable"> 
            <a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
            <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
            <div class="preview"><input type="text" value="9 3" class="form-control"></div> 
              <div class="view"> 
                <div class="row clearfix"> 
                <div class="col-md-9 column"></div> 
                <div class="col-md-3 column"></div> 
                </div> 
              </div> 
            </div> -->
            
            <!-- fifth layout -->
            <div class="lyrow ui-draggable"> 
            <div class="layout-main-table">
            <div class="layout-green-bg layout-orange-bg">
            <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
            <a class="drag-layout-btn drag btn btn-default btn-xs">
              <i class="sprite_old threecol"></i>
              <i class="entypo-window"></i>
            </a> 
            <a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
            <div class="preview"><span></span></div> 
              <div class="view right_view_content" style="display:none;"> 
                <div class="row clearfix right-main-content" style="margin:0px;"> 
                  <div class="col-md-4 column dragelement"></div> 
                  <div class="col-md-4 column dragelement"></div> 
                  <div class="col-md-4 column dragelement"></div> 
                </div> 
              </div> 
            </div>
            </div>
            </div>
            
            <!-- sixth layout -->
            <div class="lyrow ui-draggable"> 
            <div class="layout-main-table">
            <div class="layout-orange-bg">
            <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
            <a class="drag-layout-btn drag btn btn-default btn-xs">
              <i class="sprite_old fourcol"></i>
              <i class="entypo-window"></i>
            </a> 
            <a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
            <div class="preview"><span></span></div> 
              <div class="view right_view_content" style="display:none;"> 
                <div class="row clearfix right-main-content" style="margin:0px;"> 
                  <div class="col-md-3 column dragelement"></div> 
                  <div class="col-md-3 column dragelement"></div> 
                  <div class="col-md-3 column dragelement"></div> 
                  <div class="col-md-3 column dragelement"></div> 
                </div> 
              </div> 
            </div>
            </div>
            </div>

          </li> 
        </ul> 
        <br>
        <div style="clear: both; height: 15px; display:block"></div>

        <ul class="nav nav-list"> 
          <li class="nav-header">Elements </li> 

          <li class="boxes" id="elmBase"> 

          <!-- paragraph -->
          <div class="element-main-table">
            <div class="box box-element ui-draggable" data-type="paragraph" style="display:flex;">
            <div class="element-green-bg" id="">
              <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);">
                <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
              </a> 
              <a class="element-drag-btn drag btn btn-default btn-xs">
                <i class="entypo-window"></i>
              </a>
               <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
               <span class="element-warning-btn element-warning-btn configuration"> 
                <!--  <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#myModal" onclick="openMymodal();"> -->
                 <a class="btn btn-xs settings" data-toggle="modal" onclick="openMymodal(this.id);">
                 <div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div>
                 </a> 
               </span> 

               <select class="form-control" name="Alignment" onchange="setAlign(this)">                
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
                  </select>

               <div class="preview"> 
                 <i class="sprite_old text"></i> 
                <div class="element-desc">Paragraph</div> 
               </div>

               <div class="element-view-content view" onclick="openMymodal(this.id);"> 
                  <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>  -->
                  <a class="btn mock" style="display:none !important" data-toggle="modal" href="#" onclick="openMymodal(this.id);">Click Here To Add / Edit Text</a>
               </div> 
            </div> 
            </div>
            </div>

            <!-- image -->
            <div class="element-main-table">
            <div class="box box-element ui-draggable" data-type="image" style="display:flex;"> 
            <div class="element-green-bg">
                <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
                <a class="element-drag-btn drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
                 <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                <span class="element-warning-btn element-warning-btn configuration">
                <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalImage(this.id);">
                <div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
                </span> 
                
                <select class="form-control" name="Alignment" onchange="setAlign(this)">                 
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
                  </select>


                <div class="preview"> 
                <i class="sprite_old image"></i> 
                <div class="element-desc">Image</div>  
                </div> 
                
                <div class="element-view-content view" onclick="openmyModalImage(this.id);">
                <a class="btn mock" style="display:none !important" data-toggle="modal" href="#" onclick="openmyModalImage(this.id);">Click Here To Add / Edit Images</a>
                </div> 
              </div>
              </div>
              </div>
              <!-- videos -->
<!--    

              <div class="element-main-table">
              <div class="box box-element ui-draggable" data-type="Videos" style="display:flex;">
              <div class="element-green-bg">
              <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);">
                <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
              </a> 

              <a class="element-drag-btn drag btn btn-default btn-xs">
                <i class="entypo-window"></i>
              </a>
               <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
              <span class="element-warning-btn element-warning-btn configuration"> 
                <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);">
                  <div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div>
                </a>
              </span>

              <div class="preview"> 
              <i class="sprite_old video"></i> 
                <div class="element-desc">Videos</div> 
              </div> 

              <div class="element-view-content view" onclick="openmyModalyoutube(this.id);"> 
                <a class="btn mock" style="display:none !important" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);">Click Here To Add / edit Videos</a>
              </div> 
              </div>
            </div>
            </div> 
-->
            <!-- Audio -->
            <div class="element-main-table">
            <div class="box box-element ui-draggable" data-type="map" style="display:flex;">
            <div class="element-green-bg"> 
            <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
            <a class="element-drag-btn drag btn btn-default btn-xs"><i class="entypo-window"></i></a>
             <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
            <span class="element-warning-btn element-warning-btn configuration"> 
              <a class="btn btn-xs settings" href="#" data-toggle="modal"  onclick="openmyModalaudio(this.id);" ><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
            </span>

            <select class="form-control" name="Alignment" onchange="setAlign(this)">                 
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
      </select>

            <div class="preview"> <i class="sprite_old audio"></i> 
            <div class="element-desc">Audio</div> 
            </div> 
            <div class="element-view-content view" onclick="openmyModalaudio(this.id);"> 
            <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalaudio(this.id);">Click Here To Add / Edit Audio</a>
            </div> 
            </div>
            </div>
            </div>

            <!-- Gallery -->
            <div class="element-main-table">
            <div class="box box-element ui-draggable" data-type="Gallery" style="display:flex;">
            <div class="element-green-bg">
            <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
      <a class="element-drag-btn drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
       <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
      <span class="element-warning-btn element-warning-btn configuration"> 
        <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalGallery(this.id);"><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
      </span> 
            
            <div class="preview">
            <i class="sprite_old gallery"></i> 
            <div class="element-desc">Gallery</div> </div> 
            <div class="element-view-content view" onclick="openmyModalGallery(this.id);"> 
            <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalGallery(this.id);">Click Here To Add / Edit Gallery</a>
            </div> 
            </div> 
            </div>
            </div>

            <!-- pdf -->
            <div class="element-main-table">
              <div class="box box-element ui-draggable" data-type="code" style="display:flex;"> 
              <div class="element-green-bg pdf_view">
              <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
              <a class="element-drag-btn drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
               <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
              <span class="element-warning-btn element-warning-btn configuration"> 
                <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalpdf(this.id);"><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
              </span> 
              
              <div class="preview">
                <i class="sprite_old documents"></i> 
                <div class="element-desc">Pdf</div> 
              </div> 

              <div class="element-view-content view" onclick="openmyModalpdf(this.id);"> 
                <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalpdf(this.id);">Click Here To Add / Edit Document</a>
              </div> 
              </div>
            </div>
            </div>

            <!-- code -->
            <div class="element-main-table">
            <div class="box box-element ui-draggable" data-type="code" style="display:flex;"> 
            <div class="element-green-bg">
              <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
              <a class="element-drag-btn drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
               <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
              <span class="element-warning-btn element-warning-btn configuration"> 
                <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalCode(this.id);"><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
              </span> 
              
              <select class="form-control" name="Alignment" onchange="setAlign(this)">                 
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
        </select>

              <div class="preview">
                <i class="sprite_old code"></i> 
                <div class="element-desc">Code</div> 
              </div> 

              <div class="element-view-content view" onclick="openmyModalCode(this.id);">
              <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalCode(this.id);">Click Here To Add / Edit Code</a>
              </div> 
            </div>
            </div>
            </div>

            <!-- flash -->
            <div class="element-main-table">
             <div class="box box-element ui-draggable" data-type="button" style="display:flex;">
             <div class="element-green-bg">
              <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);">
                <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
              </a>
               <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
              <a class="element-drag-btn drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
              <span class="element-warning-btn element-warning-btn configuration"> 
                <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalflash(this.id);"><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
              </span>

              <div class="preview"> 
                <i class="sprite_old flash"></i> 
                <div class="element-desc">Flash</div>
              </div> 

              <div class="element-view-content view" onclick="openmyModalflash(this.id);"> 
               <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalflash(this.id);">Click Here To Add / Edit Flash</a>
              </div> 
              </div> 
              </div>
              </div>

            
              <!-- button-->
              <div class="element-main-table">
              <div class="box box-element ui-draggable" data-type="button" style="display:flex;">
              <div class="element-green-bg">
              <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);">
                <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
              </a>

              <a class="element-drag-btn drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
               <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
              <span class="element-warning-btn element-warning-btn configuration"> 
                <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalbutton(this.id);"><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
              </span>

              <select class="form-control" name="Alignment" onchange="setAlign(this)">                 
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
                  </select>

              <div class="preview"> 
                <i class="sprite_old jump"></i> 
                <div class="element-desc">Button</div>
              </div> 

              <div class="element-view-content view" onclick="openmyModalbutton(this.id);"> 
                <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalbutton(this.id);">Click Here To Add / Edit Button</a>
              </div> 
              </div> 
              </div>
              </div>

                </li> 
              </ul>


              <br>
        <div style="clear: both; display:block"></div>

        <ul class="nav nav-list"> 
          <li class="nav-header">Templates</li> 

          <li class="boxes" id="elmBase" style="height: 50px;"> 
          
            <div class="box box-element ui-draggable" style="margin: 10px 10px 0 0;display: inline-block;width: 55px;">
              <a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
                <i class="entypo-cancel"></i>
              </a> 
              <a class="drag btn btn-default btn-xs">
                <i class="entypo-window"></i>
              </a>

               <span class="configuration"> 
                <!--  <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#myModal" onclick="openMymodal();"> -->
                 <a class="btn btn-xs btn-warning settings" data-toggle="modal" onclick="openMymodal(this.id);">
                 <i class="fa fa-gear"></i>
                 </a> 
               </span> 

               <!-- <div class="preview"> 
                 <i class="sprite_old RightArrow52x sprite_old TextAlignLeft2x"></i> 
                <div class="element-desc">Save Template</div> 
               </div> -->
                <input type="button" id="submit" class="btn btn-success" value="Save" data-toggle="modal" onclick="openmymodelsavetemplate(this.id);">
               
                <!-- <button  data-toggle="modal" onclick="openmymodelsavetemplate(this.id);" type="button" class="btn btn-green btn-icon">
                Save Template
                <i class="entypo-check"></i> 
              </button> -->

               <div class="view"> 
                  
               </div> 
            </div> 


            <div class="box box-element ui-draggable" style="margin: 10px 10px 0 0;display: inline-block;width: 55px;">
              <a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
                <i class="entypo-cancel"></i>
              </a> 
              <a class="drag btn btn-default btn-xs">
                <i class="entypo-window"></i>
              </a>

               <span class="configuration"> 
                <!--  <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#myModal" onclick="openMymodal();"> -->
                 <a class="btn btn-xs btn-warning settings" data-toggle="modal" onclick="openMymodal(this.id);">
                 <i class="fa fa-gear"></i>
                 </a> 
               </span> 

               <!-- <div class="preview"> 
                 <i class="sprite_old RightArrow52x sprite_old TextAlignLeft2x"></i> 
                <div class="element-desc">Load Template</div> 
               </div> -->
                <input type="button" id="submit" class="btn btn-info" value="Load" data-toggle="modal" onclick="openmymodelloadtemplate(this.id);">
               
               <!-- <button  data-toggle="modal" onclick="openmymodelloadtemplate(this.id);" type="button" class="btn btn-blue btn-icon">
                Load Template
                <i class="entypo-down"></i> 
              </button> -->

               <div class="view"> 
                  
               </div> 
            </div> 
          </li>
        </ul>

      </div>
      </div>

      <div class="col-sm-9">
        <div id="cart2" class="lect_cont" style="display: <?php echo $task->lecture_type != 'video' ? 'block' :'none'  ?>">   
           <div class="htmlpage ui-sortable dragdroplayout"  style="min-height: 625px;">            
           <?php 
           if(trim($task->lecture_content) !== ''){
               echo $task->lecture_content; 
             }
             else{  ?>
                 <div class="lyrow ui-draggable" id="lyrow_1" style="display: block;">
                <div class="layout-main-table">
                    <div class="layout-orange-bg">
                  <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeele(this.id);" id="remove_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
                  <a class="drag-layout-btn drag btn btn-default btn-xs" id="drag_1">
                    <i class="sprite_old onecol"></i>
                    <i class="entypo-window"></i>
                  </a> 
                  <a href="javascript:void(0)" class="info-layout-btn btn btn-xs clone" onclick="clonele(this.id);" id="clone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                  
                  <div class="preview">
                    <span></span>
                  </div> 
                  <div class="view right_view_content" style="display: block;">
                    <div class="row clearfix right-main-content" style="margin:0px;">
                      <div class="col-md-12 column ui-sortable" style="float:right;" id="column_1">
                        <?php
                if($task->lecture_type== 'video')
                { ?>
                   <div class="box box-element ui-draggable" data-type="Videos" style="display: flex;" id="box_1">
                      <div class="element-green-bg">
                      <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);" id="removeinner_1">
                        <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
                      </a> 

                      <a class="element-drag-btn drag btn btn-default btn-xs" id="drag_2">
                        <i class="entypo-window"></i>
                      </a>
                       <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                      <span class="element-warning-btn element-warning-btn configuration"> 
                        <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);" id="settings_1">
                          <div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div>
                        </a>
                      </span>

                      <div class="preview"> 
                      <i class="sprite_old video"></i> 
                        <div class="element-desc">Videos</div> 
                      </div> 

                      <div class="element-view-content view" onclick="openmyModalyoutube(this.id);" id="view_1"> 
                        <a class="btn mock" style="" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);" id="a_1">Click Here To Add / edit Videos</a>
                      </div> 
                      </div>
                    </div>

                   <?php } else if($task->lecture_type== 'PDF / Doc'){ ?>  
                   
                    <div class="box box-element ui-draggable" data-type="code" style="display: flex;" id="box_1"> 
                      <div class="element-green-bg pdf_view">
                      <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);" id="removeinner_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
                      <a class="element-drag-btn drag btn btn-default btn-xs" id="drag_2"><i class="entypo-window"></i></a> 
                       <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                      <span class="element-warning-btn element-warning-btn configuration"> 
                        <a class="btn btn-xs settings" data-toggle="modal" href="#" onclick="openmyModalpdf(this.id);" id="settings_1"><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
                      </span> 
                      
                      <div class="preview">
                        <i class="sprite_old documents"></i> 
                        <div class="element-desc">Pdf</div> 
                      </div> 

                      <div class="element-view-content view" onclick="openmyModalpdf(this.id);" id="view_1"> 
                        <a class="btn mock" style="" href="#" data-toggle="modal" onclick="openmyModalpdf(this.id);" id="a_1">Click Here To Add / Edit Document</a>
                      </div> 
                      </div>
                  </div>

                   <?php } else if($task->lecture_type== 'Audio'){ ?> 

                  <div class="box box-element ui-draggable" data-type="map" style="display: flex;" id="box_1">
                    <div class="element-green-bg"> 
                    <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);" id="removeinner_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
                    <a class="element-drag-btn drag btn btn-default btn-xs" id="drag_2"><i class="entypo-window"></i></a>
                     <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                    <span class="element-warning-btn element-warning-btn configuration"> 
                      <a class="btn btn-xs settings" href="#" data-toggle="modal" onclick="openmyModalaudio(this.id);" id="settings_1"><div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div></a> 
                    </span>

                    <select class="form-control" name="Alignment" onchange="setAlign(this)">                 
                         <option value="Left">Left</option>
                         <option value="Center">Center</option> 
                         <option value="Right">Right</option> 
              </select>

                    <div class="preview"> <i class="sprite_old audio"></i> 
                    <div class="element-desc">Audio</div> 
                    </div> 
                    <div class="element-view-content view" onclick="openmyModalaudio(this.id);" id="view_1"> 
                    <a class="btn mock" style="" href="#" data-toggle="modal" onclick="openmyModalaudio(this.id);" id="a_1">Click Here To Add / Edit Audio</a>
                    </div> 
                    </div>
                  </div> 
                   <?php } else if($task->lecture_type== 'Text'){ ?> 

                      <div class="box box-element ui-draggable" data-type="paragraph" style="display: flex;" id="box_1">
                      <div class="element-green-bg" id="">
                        <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeele(this.id);" id="removeinner_1">
                          <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
                        </a> 
                        <a class="element-drag-btn drag btn btn-default btn-xs" id="drag_2">
                          <i class="entypo-window"></i>
                        </a>
                         <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                         <span class="element-warning-btn element-warning-btn configuration"> 
                          <!--  <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#myModal" onclick="openMymodal();"> -->
                           <a class="btn btn-xs settings" data-toggle="modal" onclick="openMymodal(this.id);" id="settings_1">
                           <div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div>
                           </a> 
                         </span> 

                         <select class="form-control" name="Alignment" onchange="setAlign(this)">                
                           <option value="Left">Left</option>
                           <option value="Center">Center</option> 
                           <option value="Right">Right</option> 
                            </select>

                         <div class="preview"> 
                           <i class="sprite_old text"></i> 
                          <div class="element-desc">Paragraph</div> 
                         </div>

                         <div class="element-view-content view" onclick="openMymodal(this.id);" id="view_1"> 
                           
                            <a class="btn mock" style="" data-toggle="modal" href="#" onclick="openMymodal(this.id);" id="a_1">Click Here To Add / Edit Text</a>
                         </div> 
                      </div> 
                      </div>

                   <?php } ?>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>


             <?php  } ?>
           </div> 
    </div>
<!-- <?php// } ?> -->
     <!--    <div style="clear: both; display:block"></div> -->
    
  <div style="overflow: auto;margin-left:15px;margin-top:15px;">

     <legend class="tile_fld"> Downloadable files</legend>
        <a  style="margin-left:15px;" href = "<?php echo base_url(); ?>medias/addmedia/<?php //echo $program->id; ?>" class='existingfiles btn btn-success'>Select from existing files</a>
        <a href = "<?php echo base_url(); ?>medias/createexercisefile/<?php //echo $program->id; ?>" class='<?php echo "newexercise";?> btn btn-success'>Add new downloadable file </a>
  </div>
   <div style="overflow: auto;margin-left:15px;margin-right:15px;">
      <table id="myTable" class="table table-bordered table-responsive"> 
        <thead> 
          <tr> 

                      <th>Type</th>

                      <th>

                  <strong>File/Media name</strong>

                </th>
                <th>Download</th>
                    
                      <th>

                  <strong>Remove</strong>

                </th>
 
          </tr> 
        </thead> 
        <tbody id="rowsmedia">


                            <?php
      
                           $img_type = '<img src="'.base_url().'public/images/admin/doc.gif" alt="doc type">';

                           $display_none = '';

                           if($updType == 'create' && isset($get_media_ids) && $get_media_ids!= ''){
                           $nums = 0;

                           foreach($get_media_ids as $get_media_id){

                           $nums++;

                           $getMedia = $CI->medias_model->getMediaExeFile($get_media_id);

                           foreach($getMedia as $media){
               
            

                           ?>

                           <tr id="tr<?php echo $media->id;?>" <?php echo $display_none; ?>>

                               <td align="center">

                                    <?php echo $nums;//$media->id ?>

                                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>

                               <td>

                                     <?php echo $img_type ?>

                               </td>

                               <td>

                                    <?php echo $media->name ?>

                               </td>



                               <td>

                                   <?php if($media->published){?>

                                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>">

                                    <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">

                                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>



                                    <?php }else{?>

                    <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none">

                                    <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">

                                    <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

                                <?php }?>

                             </td>

                            

                             <td>

                                     <select name="access[]">

                                     <option value="0" <?php if(isset($media->access) && $media->access == 0) echo "selected"; ?>>Students</option>

                                     <option value="1" <?php if(isset($media->access) && $media->access == 1) echo "selected"; ?>>Members</option>

                                     <option value="2" <?php if(isset($media->access) && $media->access == 2) echo "selected"; ?>>Guests</option>

                                     </select>

                             </td>

                             <td>

                    <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>

                              </td>

                            </tr>



                             <?php

                             }

                            }

                          } 

                           if($updType == 'edit' && isset($task->lecturemedias)){

                            $get_media_ids2 = explode(',',$task->lecturemedias);
                          
                          if(isset($get_media_ids2) && $get_media_ids2!= ''){

                          $nums = 0;
                              //$mediafile_id = rtrim($this->input->post('mediafiles'), ",");
                          
                  // print_r($get_media_ids2);
                          foreach($get_media_ids2 as $get_media_id){

                          $nums++;

                          $getMedia = $CI->medias_model->getMediaExeFile_new($get_media_id);
                          
                          //print_r($getMedia);

            

                          foreach($getMedia as $media){   ?>

                       <?php   
                          $urlmedia = strtolower($media->alt_title);      
              $urlmedia = trim(str_replace(' ', '-', $urlmedia));
              $urlmedia = preg_replace('/[^A-Za-z0-9\-]/', '', $urlmedia); ?> 
              
                          <tr id="tr<?php echo $media->id;?>">

                               <td style="display: none;">

                                    <?php echo $media->id ?>
                                   
                                    <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>


                               <td>
                        <?php  
                      $filename = $media->media_title;
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //echo $ext;
            if($ext == 'gif'||$ext == 'GIF'){
            echo $ftype = '<img src="'.base_url().'public/css/image/gif-icon.png" alt="File type">';
            } 
            elseif($ext == 'rar'||$ext == 'RAR'){
            echo $ftype = '<img src="'.base_url().'public/css/image/rar-icon.png" alt="File type">';
            }
            elseif($ext == 'zip'||$ext == 'ZIP'){
            echo $ftype = '<img src="'.base_url().'public/css/image/zip-icon.png" alt="File type">';
            }
            elseif($ext == 'rar'||$ext == 'RAR'){
            echo $ftype = '<img src="'.base_url().'public/css/image/rar-icon.png" alt="File type">';
            }
            elseif($ext == 'doc'||$ext == 'DOC'){
            echo $ftype = '<img src="'.base_url().'public/css/image/doc-icon.png" alt="File type">';
            }
            elseif($ext == 'docx'||$ext == 'DOCX'){
            echo $ftype = '<img src="'.base_url().'public/css/image/docx-icon.png" alt="File type">';
            }
            elseif($ext == 'docx'||$ext == 'DOCX'){
            echo $ftype = '<img src="'.base_url().'public/css/image/docx-icon.png" alt="File type">';
            }
            elseif($ext == 'jpg'||$ext == 'JPG'){
            echo $ftype = '<img src="'.base_url().'public/css/image/jpg-icon.png" alt="File type">';
            }
            elseif($ext == 'png'||$ext == 'PNG'){
            echo $ftype = '<img src="'.base_url().'public/css/image/png-icon.png" alt="File type">';
            }
            elseif($ext == 'bmp'||$ext == 'BMP'){
            echo $ftype = '<img src="'.base_url().'public/css/image/bmp-icon.png" alt="File type">';
            }
            elseif($ext == 'ppt'||$ext == 'PPT'){
            echo $ftype = '<img src="'.base_url().'public/css/image/ppt-icon.png" alt="File type">';
            }
            elseif($ext == 'pptx'||$ext == 'PPTX'){
            echo $ftype = '<img src="'.base_url().'public/css/image/pptx-icon.png" alt="File type">';
            }
            elseif($ext == 'pdf'||$ext == 'PDF'){
            echo $ftype = '<img src="'.base_url().'public/css/image/pdf-icon.png" alt="File type">';
            }
            elseif($ext == 'txt'||$ext == 'TXT'){
            echo $ftype = '<img src="'.base_url().'public/css/image/txt-icon.png" alt="File type">';
            }
            ?>

                               </td>

                               <td>

                                    <?php 
                                    //print_r($media);
                                    echo $media->alt_title;
                                     ?>

                               </td>
                               <td>


                                     <a href="<?php echo base_url(); ?>public/uploads/files/<?php echo $media->media_title?>" class="" download><i class="entypo entypo-download" title="Download"></i></a>

                               </td>


                            <td>

                                    <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>

                            </td>

                            </tr>



                               <?php }

                              }

                           }else{

               $nums = 0;

                           foreach($medias as $media){

               $nums++;

                           ?>


                            <tr id="tr<?php echo $media->id;?>" <?php echo $display_none; ?>>

                               <td>

                               <?php echo $media->id ?>

                               <input type="hidden" name="media_id[]" id="media_id" value="<?php echo $media->id ?>">

                               </td>

                               <td>

                               <?php echo $img_type ?>

                               </td>

                               <td>

                               <?php echo $media->name ?>

                               </td>



                               <td>

                               <?php if($media->published){?>

                                <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>">

                                <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>" style="display:none">

                                <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>


                                <?php }else{?>

                <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png" class = "publish" id="publish-<?php echo $media->id ?>" style="display:none">

                                <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png" class = "unpublish" id="unpublish-<?php echo $media->id ?>">

                                <input type="hidden" name="hid" id="hid<?php echo $nums;?>" value="<?php echo $media->id ?>"/>

                            <?php }?>





                             </td>


                              <td>

                                <a href="javascript:void(0);" class="removeele" id="remove<?php echo $media->id;?>"><img src="<?php echo base_url(); ?>public/img/admin/cross-16.png"></a>
                              </td>
                            </tr> <?php } } }?>

        </tbody>
      </table>
      <input id="mediafiles" name="mediafiles" value="<?php echo ($this->input->post('mediafiles') ? $this->input->post('mediafiles') : '')?>" type="hidden">
    </div> 
</div> 


  </div>
</div>

<!-- third  end-->

        <!-- new code end here -->
      </dd>
    </div>



    
    
  </div>
  </div>
</div>
<div style="clear:both;"></div>
<textarea style="display:none" class="form-control" id="content_lecture"  name="content_lecture"></textarea>

<?php echo form_close(); ?>



<div id="content_demo" style="display: none"></div>











<!-- tool tip script -->

<script type="text/javascript">


jQuery(document).ready(function(){

  jQuery('.tooltipicon').click(function(){

  var dispdiv = jQuery(this).attr('id');

  jQuery('.'+dispdiv).css('display','inline-block');

  });

  jQuery('.closetooltip').click(function(){

  jQuery(this).parent().css('display','none');

  });

  });

</script>
<!-- tool tip script finish -->

<script>
   
   jQuery(document).ready(
    function()
    {
      jQuery('#inform_txt').hide();
    });

  jQuery('#inform_btn').click(function() {

    jQuery('#inform_txt').toggle();
  });
  
</script>
<script type="text/javascript">
function removeRow(id) 
{
  jQuery(document).ready(function(){
    
  // alert(clickedId);
    
  //  var id = jQuery(this).attr("id");
      //alert(id);
    id = id.substr(6);
      
    jQuery("#tr"+id).remove();
    
  });
    


}
</script>
<script type="text/javascript">
function deleteRow(i) {
       //alert(i);
       document.getElementById('myTable').deleteRow(i);
}
</script>

<script>
var $ =jQuery.noConflict();
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
  



</script>
<script>
// jQuery(document).ready(
//    function()
//    {
//      jQuery('#inform_txt').hide();
//    });

//  jQuery('#inform_btn').click(function() {

//    jQuery('#inform_txt').toggle();
//  });

//  jQuery('#OptlecCont').on('click', function() {

//   jQuery('#lecCont').toggle();
//  }); 
</script>

<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/plupload/application.js"></script>


    <script>
function lecture_preview2()
{   
       var txt_content_val = $("#txt_content_val").val();         
       var lec_content = $("#lec_content").val();
       var lec_content1 = $("#lec_content1").val();


       var first_media = $("#layout"+txt_content_val).find(".parent_layout"+txt_content_val).html();
       var txt_content = $("#txt_content"+txt_content_val).val();
        
       if(first_media)
       {       
       
       }
       else
       {
         first_media = "";
       }

       var second_media = $("#layout"+txt_content_val).find(".parent_layout"+txt_content_val+"_1").html();
       if(second_media)
       {         
       
     }
     else
     {
        second_media ="";
     }  
       

       if(txt_content)
       {       
      
       }
       else
       {
        txt_content ="";  
       }
       if(lec_content)
       {       
       
       }
       else
       {
        lec_content ="";  
       }

       window.open('<?php echo base_url(); ?>admin/tasks/lecture_preview/'+txt_content_val, '_blank');
    

}
</script>


<!-- new code end here -->
<!-- <script src="<?php echo base_url() ?>public/js/jquery-ui/external/jquery/jquery.js" type="text/javascript"></script>  --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

  <!-- <script src="<?php echo base_url() ?>public/js/jquery-ui/jquery-ui.js"></script> -->
  <link href="<?php echo base_url() ?>public/js/jquery-ui/jquery-ui.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>


<!-- <script src="https://malsup.github.io/jquery.form.js"></script> -->

 <script src="<?php echo base_url() ?>public/js/form-master/jquery.form.js"></script>
<script src="<?php echo base_url()?>public/js/lectureseditor/lectureeditor_admin.js"></script>

<script>

function lecture_preview()
{   
      var lectureContent = $('.htmlpage').html();

      $.session.set('preview1', JSON.stringify({contentLecture: lectureContent})); 
        
      var obj = JSON.parse($.session.get('preview1'))             
      
     window.open('<?php echo base_url(); ?>admin/tasks/lecture_preview/', '_blank');         

}
</script>



<script type="text/javascript">
       

jQuery(document).ready(function()
               {
         jQuery('#myModal').css('display','none');
        jQuery('#myModalImage').css('display','none');
        jQuery('#myModalpdf').css('display','none');
        jQuery('#myModalyoutube').css('display','none');
        jQuery('#myModalbutton').css('display','none'); 
        jQuery('#myModalCode').css('display','none'); 
        jQuery('#loadtemplate').css('display','none');
    jQuery('#savetemplate').css('display','none'); 
    jQuery('#myModalaudio').css('display','none');
    jQuery('#myModalflash').css('display','none'); 
    jQuery('#myModalgallery').css('display','none');
    jQuery('#myModalLectpreview').css('display','none');      
       });



</script>

<?php if($task->lecture_type != 'video'){ ?>

<script type="text/javascript">

 function sticky_relocate1() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor1').offset().top;
    if (window_top > div_top) {
        $('#sidebar').addClass('stick');
    } else {
        $('#sidebar').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate1);
    sticky_relocate1();
});

</script>
<?php } ?>
<script type="text/javascript">


  jQuery(document).ready(function() 
  {

    //jQuery('#codearea').redactor();
  jQuery('#codearea').redactor({
    pasteCallback: function(html) {
        //  html = html.replace("<font>", ""); // Fix Word to IE
        //  html = html.replace("</font>", ""); // Fix Word to IE
        //  return html;
        // alert('yes');
    },
});
  jQuery('#myModalCode').find(".re-html").trigger( "click" );
  jQuery('#myModalCode').find(".re-html").remove();
});
</script>
 <style>
    .edit-vjs{
      pointer-events: none;
    }
  </style>
<script>
function edit_lecture()
{
  var docid  = $('#title_pdf').val();
  // alert(docid);
  var l_id ="<?php echo $this->uri->segment(4) ?>";
  var s_id ="<?php echo $this->uri->segment(5) ?>";
  var p_id ="<?php echo $this->uri->segment(6) ?>";

  // var contenthtml = $(".htmlpage").html();
  // $("#content_lecture").val(contenthtml);
  var lec_type = $('#lecture_type').val();
  if(lec_type == 'video'){
      $("#content_lecture").val('');
  } else {
  var divdata = $('.htmlpage').html();  
  $("#content_lecture").val(divdata);
  }                 
  /* 
  var divdata1 = $('#content_demo').html(divdata);

  // var len = $(document).find('.htmlpage').find('.video-js').length;
  //                          len++; 
   var len = $('#content_demo').find('.plyr--video').length;
   var i = 0;
  
   if(len>0){
        $('#content_demo').find(".plyr--video").each(function (videoIndex) {
        i++;

                       var chk_html = jQuery(this).hasClass('plyr--html5');
        var chk_youtube = jQuery(this).hasClass('plyr--youtube');
        var chk_vimeo = jQuery(this).hasClass('plyr--vimeo');

        if(chk_html==true){

        var src = $('#content_demo').find(this).find('div.plyr__video-wrapper').find('.playerio').find('source').attr('src');

        var videopath ='<video controls class="playerio plyr--video vplyr" id="playerio_'+i+'" controls="" preload="metadata" controlsList="nodownload" >';
        var new_src = src.split('#');
            videopath+='<source src="'+new_src[0]+'#t=05,00" type="video/mp4">';
            videopath+='<track kind="captions" label="English" srclang="en" src="'+src+'" default>';
            videopath+='<track kind="captions" label="Français" srclang="fr" src="'+src+'"></video>';
            
            jQuery('#content_demo').find(this).parent().append(videopath);
                      jQuery('#content_demo').find(this).remove();
        }
        else if(chk_youtube==true || chk_vimeo==true){
            var src = jQuery('#content_demo').find(this).find('div.plyr__video-wrapper').find('iframe').attr('src');
        
var videopath ='<div class="plyr__video-embed vplyr" id="playerio_'+i+'">';
 videopath +='<iframe src="'+src+'" allow="encrypted-media" frameborder="0" allowfullscreen></iframe></div>';

          jQuery('#content_demo').find(this).parent().append(videopath);
                      jQuery('#content_demo').find(this).remove();
          }
          else{

        var src = $('#content_demo').find('.playerio').find('source').attr('src');

        var videopath ='<video controls class="playerio plyr--video vplyr" id="playerio_'+i+'" controls="" preload="metadata" controlsList="nodownload" >';
        var new_src = src.split('#');
            videopath+='<source src="'+new_src[0]+'#t=05,00" type="video/mp4">';
            videopath+='<track kind="captions" label="English" srclang="en" src="'+src+'" default>';
            videopath+='<track kind="captions" label="Français" srclang="fr" src="'+src+'"></video>';
            
            jQuery('#content_demo').find(this).parent().append(videopath);
                      jQuery('#content_demo').find(this).remove();
        
          }

          
    }); 

       }

    var contenthtml2 = $("#content_demo").html();  
  $("#content_lecture").val(contenthtml2);
  setTimeout(function() {
    convert_plyr_edit();
    }, 2000);

  */
 
   

      var release_type = $('#release_type').val();          
      if(release_type)
      {
        var r_date = $('#r_date').val();
        if(r_date.trim() == "")
        {
          drip_active = false;
        }
        else
        {
          drip_active = true;
        }
      }
      else{
        drip_active = true;
      }
    var nm = $("#name").val();   
       var difflevel = "medium";//$("#difficultylevel").val();

       if(nm.trim()!= "" && difflevel !="" && drip_active == true)
       {
    jQuery.ajax({
      cache: false,
        type: "POST",
        url: " <?php echo base_url()?>admin/tasks/edit_lecture/"+l_id+"/"+s_id+"/"+p_id,
        data: jQuery("#frm_edit_lecture").serialize(),
       
       beforeSend: function(){
           // window.scrollTo(0,0);
            $('#lecture_save').val('Please wait..');
           $('#lecture_save').prop('disabled', true);
           
       },
        success: function(msg)
        { 
          // console.log(msg); return false;
            if(msg)
            {
               var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Successfully saved the lecture. </div>';


            }
            else{
              var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-warning" aria-hidden="true"></strong> Lecture could not saved, please try again! </div>';
            } 

            $('#message').html(str);
           $('#message').show();
            $('#message').fadeIn().delay(3000).fadeOut();
            $('#lecture_save').prop('disabled', false);
            $('#lecture_save').val('Update');


        }
    });
  }
  else
  {
    $('.error').remove();
    $.alert({
             title: 'Warning',
               content: 'Field Must Required',
                confirm: function()
                          {

                            if(nm.trim() =="")
                            {
                              $("#name").after('<span class="error">Lecture title Required</span>');
                  //$("#difficultylevel").val();
                            }

                            if(difflevel =="")
                            {
                              $("#difficultylevel").after('<span class="error">Level Required</span>');
                            }
                            if(drip_active == false)
                            {
                               $("#r_date").after('<span class="error">Lecture release is required</span>');
                            }

              
                          return true;
               
                           }
                       });
  }

}

function saveAndInform()
{
  var infomsg = $("#inform_msg").val();
  if(infomsg.trim() != "")
  {
   edit_lecture();
    }
    else
    {
      $.alert({
             title: 'Required',
               content: 'Field Must Required',
                confirm: function()
                          {             
                          return true;               
                           }
                       });
    }
}



// function convert_plyr_edit(){
//   $(document).find('#content_lecture').find(".vplyr").each(function () {
//          // count++;
//          var str = $(this).attr('id');
       
//          str = new Plyr('#'+str);
//          // players.push(str);

//     });
// }
 

$("#preview_btn").click(function(){
   $("#sticky").css("display","none");
});


// jQuery(document).ready(function() {
//     // jQuery(document).find(".plyr__video-embed").each(function () {
// // 
//   jQuery(document).find(".playerio").each(function () {
//     var vid = jQuery(this).attr('id');
//      player = new Plyr('#'+vid);
//   });
//    jQuery(document).find(".plyr__video-embed").each(function () {
//     var vid = jQuery(this).attr('id');
//      player = new Plyr('#'+vid);
//   });
//   jQuery(document).find('.plyr').addClass('edit-vjs');
// });


// function checkContainer () {
//        var players = [];

//  jQuery('#preview_container').find(".vplyr").each(function (videoIndex) { 
//  //     j++;

//    var str = jQuery(this).attr('id');
//    // console.log(str);
//    // var chkele = jQuery.inArray( str, players );
//    // if(chkele==true){

//    // }else{
//      // str = new Plyr('#'+str);
//        str = Plyr.setup('#'+str);
//      players.push(str);
//    // }
//  });
  

// }

// jQuery(document).ready(function(){
//   // jQuery(document).find('.vjs-play-control.vjs-control.vjs-button').css('display','none');
//     jQuery(document).find('.video-js').addClass('edit-vjs');
// });
</script>
<?php // if($task->lecture_video != "video"){ ?>
  
<link rel="stylesheet" href="<?php echo base_url() ?>public/colorbox-master/example1/colorbox.css" />

    <script src="<?php echo base_url() ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
       var $j = jQuery.noConflict();
      $j(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements
        
        //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});     
      $j(".iframe").colorbox({
        iframe:true,
        width:"500px", 
        height:"650px",
        fadeOut:500,
        fixed:true,
        reposition:true,                  
            })

      $j(".existingfiles").colorbox({
        iframe:true,
        width:"700px", 
        height:"100%",
        fadeOut:500,
        //fixed:true,
        reposition:true,                  
            })   
        
      $j(".newexercise").colorbox({
        iframe:true,
        width:"500px", 
        height:"80%",
        fadeOut:500,
        fixed:true,
        reposition:true,                  
            })  

      $j(".uploadimage").colorbox({
        iframe:true,
        width:"500px", 
        height:"350px",
        fadeOut:500,
        //fixed:true,
        reposition:true,                  
            })  

      $j(".addcourse").colorbox({
        iframe:true,
        width:"600px", 
        height:"85%",
        fadeOut:500,
        //fixed:true,
        reposition:true,                  
            }) 

      });   
    </script>
    
 <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
<!-- <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script>  -->
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script>
<script src="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.css" rel="stylesheet" />

<script type="text/javascript">

function makeslider(imgscrarray,imgid,contentid)
  {
       var imgval =imgscrarray.toString().split(',');
      var arraycount = imgval.length;

      var str='<input class="getid" type="hidden" id="slider_'+contentid+'">';
          str+='<ul class="bxslider1">';
        var divcount=0;
               for(var i=0; i < arraycount; i++)
                 {  
                    var divclass ='';
                    if(divcount == 0)
                   {
                      divclass ='active'; 
                   }
                 //str+='<div class="item '+divclass+'"><img src="'+imgval[i]+'" id="'+imgid[i]+'"></div>'; 
                 str+='<li><img src="'+imgval[i]+'" id="'+imgid[i]+'"></li>';
                    
                    divcount++;
                 } 
                 str+='</ul>';
    
       var gallery_div_id = $('#gallery_div_id').val();
            $('#view_'+gallery_div_id).html(str);
            $('.bxslider1').bxSlider({                  
            auto: true,
            autoControls: true
          });
            $('#myModalgallery').modal("hide");
   
 
  }


  </script>


  <script src='<?php echo base_url() ?>public/js/tinymce/tinymce.min.js'></script>

   <script>
   tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
selector : "#paragraph"
});
</script> 
   <script>$(document).ready(function(){
                  $(".lyrow").draggable(); })</script>
<script>
    $(document).ready(function(){
      var height = window.innerHeight;
      var logo_bottom_height = height - 498;
         $("#sidemenu .fix_logo_btm").css("height", logo_bottom_height );
    });

    //for responsive sidebar collapsed
    $(document).ready(function(){
      if ($(window).width() < 767){
          $("#sidebar-collapse").click(function(){
            $(".sidebar-menu").toggleClass("responsive_sidebar");
            $(".main-content").toggleClass("responsive_main_content");  
          });
      }
    });
</script>

<script type="text/javascript">

   jQuery(document).ready(function(){

          jQuery('.removeele').click(function(){
         
          var id = jQuery(this).attr('id');

          id = id.substr(6);

           jQuery('#tr'+id).remove();

          });

        });  

</script>

<?php // } ?>

<script>
  $("#lecture_type").change(function () {
        var type = this.value.toLowerCase();
        if(type =="video")
        {
          $('#video_section').show();
          $('.lect_tab_content').css('margin-bottom','650px');
          $('.lect_cont').hide();
        }
        else{
          $('#video_section').hide();
          $('.lect_tab_content').css('margin-bottom','0');
          $('.lect_cont').show();
        }
      });
</script>
