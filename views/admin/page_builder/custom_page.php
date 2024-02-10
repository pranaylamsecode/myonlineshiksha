<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css"> 
<link rel="stylesheet" href="<?php echo base_url();?>public/css/template_load.css">
<script type="text/javascript">
  BASE_URL = "<?php echo base_url();?>";
</script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/theme_admin.css" type="text/css" media="screen" />

<style>
.nav-tabs.bordered + .tab-content{
  padding: 10px 20px 20px 20px !important;
}
.features_btn p{
  display: inline-block;
}
.nav-tabs{
  margin-top: 10px;
}
#myModalLectpreview .htmlpage .box .view{
  padding: 0px !important;
}
#myModalLectpreview .box{
  margin: 0px !important;
}
.fullwidth-row{
  padding-bottom: 80px !important;
}
#video_section #video_frame {
    width: 650px;
    max-width: 90%;
    margin: 0 auto;
}
#video_section
{
    position: absolute;
    top: 410px;
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
    /*opacity: 0.5 !important;*/
    /*cursor: pointer;*/
}
.element-view-content:hover .mock {
    color: white;
}
.element-view-content:hover:before{
  /*content: 'Click Here to Add / Edit';*/
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
.page-container.sidebar-collapsed .sidebar-menu .logo-env {
  display: block;
  padding: 20px 15px !important;
}
.page-container.sidebar-collapsed .sidebar-menu{
  width: 60px !important;
}
.page-container .sidebar-menu{
  width: 60px !important;
}
body .page-container .sidebar-menu #main-menu li a .list_text {
  display: none !important;
}
.page-container .sidebar-menu .logo-env > div.logo {
  width: 0px !important;
  overflow: hidden;
}
body .page-container .sidebar-menu #main-menu li.has-sub > a::before {
  display: none;
}
.page-container {
  padding-left: 60px;
}

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

#video_frame button.close.remove_video.renew-top-close-btn {
    margin: -15px 0px 0px 0px !important;
    color: #eee !important;
    opacity: 1 !important;
}
</style>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url()?>public/js/page_creator/lecturedragndrop_admin.js"></script>
<script type="text/javascript">
  $(document).ready(function() 
  {
  $('div.sidebar-collapse').remove();
  $('.page-container').addClass('sidebar-collapsed');
  
    });
</script>
<div class="main-container">
  <div id="video_section">

  <?php if($task->lecture_type == 'video'){ 
  $VID =$task->lecture_video; ?>

    <style>
      .lect_tab_content{
        margin-bottom: 650px;
      }
    </style>
<!-- <div data-vimeo-defer data-vimeo-width="500" id="handstick"></div> -->

<script src="https://player.vimeo.com/api/player.js"></script>
<script>
  $(document).on('click','.remove_video',function(){
          // $('#made-in-ny').html('');
          $('#video_frame').hide();
          $('#Lec_videoId').val('');
          $('#myModalyoutube1').show();
        });
</script>
<div id="video_frame" style="display: <?php echo $VID ? 'block' : 'none'; ?> ">
  <button type="button" class="close remove_video renew-top-close-btn" style="margin-right: 5%;">&times;</button>
  <div data-vimeo-defer id="made-in-ny">

    </div>
</div>
    

<?php if($VID){ ?>
      <script>
      var options = {
                  // url: 'https://vimeo.com/370453841/c3586b857e',
                  url: 'https://player.vimeo.com/video/'+<?php echo $VID ?>,
                  // id:<?php echo $c_id ?>,
                    width: 649,
                    loop: true
                };
                   // url: 'https://vimeo.com/370453841/c3586b857e',

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
                
      </script>
      <?php   } ?>
<div class="edit_lecture_popup" id="myModalyoutube1" style="display: <?php echo $VID ? 'none' : 'block'; ?> ">
    
    
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
          <form id="vimeoForm" action="https://myonlineshiksha.com/admin/tasks/upload_vimeo" method="post" enctype="multipart/form-data">

            <div class="form-group form_inner_div" > 
              <label class="col-sm-12 txt_cntr_algn field-title control-label" style="color: #38425d">Title(required)</label> 
                <div class="col-sm-12 txt_cntr_algn no-padding">
                 <input class="form-control" type="text" name="vimeo_title">
               </div>
           </div>          

            <div class="form-group"> 
              
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
                 <i class="fas fa-info-circle"></i><p>When your upload is complete, we'll convert your file. After that your video will be ready! You can select ready videos from <a href="#vimeo-medlib" class="medlib_tab" data-toggle="tab">Media Library.</p></a>
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
                
               <!--  <input type="submit" id="submitvimeo" class="btn btn-blue" value="Save"/> -->
              </div>

            </div>
           </form>
          </div>
          <div class="tab-pane" id="vimeo-medlib" style="width:100%;"> 
            <div class="col-sm-12" id="vimeo_row_list" style="height: 175px;overflow: auto;">
               <button class="btn" onclick="vimeoLoadData(1)" data-cf-modified-31b28e6355e2c7e66dd80faa-=""><i class="fa fa-refresh" style="padding-right: 2px" ></i> Refresh </button>
               
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
                  <input type="button" id="selectVimeo" class="btn btn-blue" value="Choose a file" />
                  <i class="fas fa-cloud-upload-alt"></i>
                </div>

              </div>  
              </form>
            </div>
          </div> 

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

<?php } ?>
</div>
<?php
if($button == 'create')
  $cpage_id = '';
else
  $cpage_id = $getpage->page_id;

$attributes = array('class' => 'tform', 'id' => 'frm_edit_lecture');
echo form_open(base_url().'admin/pagecreator/build_page/'.$cpage_id, $attributes);
$CI = &get_instance();
$CI->load->model('medias_model');
?>
<div id="toolbar-box">
  <div class="m top_main_content">
    <div id="toolbar" class="toolbar-list">
      <div id="sticky-anchor"></div>
      <ul id="sticky" class="main-content-btn" style="list-style: none; float: right;">
        <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
          <a id="preview_btn" onclick="prev_template();" class="btn btn-success btn-blue" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Preview</a>
        </li>
        <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
          <a><input type="button" id='lecture_save' name="lecture_save" class='btn btn-success btn-green' value="Save" onclick="edit_lecture();" ></a> 
        </li>
        <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
          <a href='<?php echo base_url(); ?>admin/section-management/<?php echo $pid?>' class='btn btn-danger btn-dark-grey' id="forward"><span class="icon-32-cancel"> </span>Close</a>
        </li>
      </ul>
      <div class="clr"></div>
    </div>
    <div class="pagetitle"><h2>Create a Page</h2></div>
      <span id="message"></span>
  </div>
</div>
<div class="row">
<div class="" style="width: 100%;">
  <ul class="nav nav-tabs bordered grey-border blue-border">
  </ul>
  <div class="tab-content tab-box">
    <div class="tab-pane active" id="Lecture">
      <dd class="" sno="1">
        
<div class="tab-content lect_tab_content">
  <fieldset class="adminform form-horizontal form-groups-bordered">
    <div class="col-sm-12 form-group">
      <div class="col-sm-5 no-padding">
        <label class="col-sm-12 no-left-padding control-label field-title" for="Lesson">Page title: * <span class="error" id='err_title'> </span> </label>
        <div class="col-sm-12 no-left-padding">
          <input id="page_title" class="form-control form-height" type="text" name="page_title" maxlength="256" value="<?php if(!empty($getpage) && !empty($getpage->heading)){echo $getpage->heading;} ?>">
        </div>
      </div>
      <div class="col-sm-7 no-padding">
        <label class="col-sm-12 no-left-padding control-label field-title" for="Lesson">Slug / URL :</label>
        <div class="col-sm-11 no-left-padding">
          <input id="page_slug" class="form-control form-height" type="text" name="page_slug" maxlength="256" value="<?php if(!empty($getpage) && !empty($getpage->slug)){echo $getpage->slug;} ?>" onkeyup="return add_redirect_link(this.value,'<?php echo $cpage_id;?>')">
        </div>
        
        <label class="showredrcturl1" style="color: #7a70ea;text-transform: lowercase;"><?php echo base_url();?>pages/<span class="showredrcturl" style="font-weight: bold;color: #1a0dab"><?php if(!empty($getpage) && !empty($getpage->slug)){echo $getpage->slug;}?></span><?php echo '/'.$cpage_id;?>
        <span class="div_redrcturl" style="padding-left: 10px;<?php if(empty($cpage_id)){echo "display: none;"; } ?>">
          <a title="go to page" target="_blank" class="link_redirect" href="<?php echo base_url();?>pages/<?php if(!empty($getpage) && !empty($getpage->slug)){echo $getpage->slug;} echo '/'.$cpage_id;?>"> <img src="<?php echo base_url();?>public/images/external-link.png" style="width: 19px;"></a>
        </span>
        </label>
      </div>
      
      <input type="hidden" id="show_in_menu" name="show_in_menu" value="hide">
      <!-- <div class="col-sm-5 no-padding">
        <label class="col-sm-12 control-label field-title" style="padding-left:0;" for="Lesson">Show this page in the “More” menu in the frontend</label>
        <div class="col-sm-12 no-left-padding">
          <select id="show_in_menu" name="show_in_menu" class="form-control form-height">
            <option value="show" <?php if(!empty($getpage) && $getpage->show_in_menu == 'show'){echo 'selected';} ?> >Show</option>
            <option value="hide" <?php if(!empty($getpage) && $getpage->show_in_menu == 'hide'){echo 'selected';} ?> >Hide</option>
          </select>
        </div>
      </div> -->
      <div class="form-group form-border" style="margin:0;padding-top: 0;padding-right: 15px">
        <div class="col-sm-12 no-padding">
          <div class="grey-background" style="display: -webkit-box;">
            <input type="hidden" name="published_id" id="published_id" value="<?php if(!empty($getpage)){echo $getpage->status;}?>">
            <!-- <input type="hidden" name="is_homepage" id="is_homepage" value="<?php if(!empty($getpage)){echo $getpage->set_as_homepage;}?>"> -->
            <input type="hidden" name="page_id" id="page_id" value="<?php echo $cpage_id;?>">
            <textarea style="display:none" class="form-control" id="page_content" name="page_content"></textarea>
            
            <label class="col-sm-11 col-md-1 no-padding control-label dark_label" style="padding-top: 2px;padding-left: 3%;">
              <div style="width:3%;" class="col-sm-1 no-padding">                
                <input id="published" type="checkbox" name="published" value="" <?php if(!empty($getpage) && $getpage->status == 'active'){echo 'checked';}?>>
              </div>
              <span style="padding-left: 25%;">Publish</span>
            </label>
            <!-- <label style="padding-top: 2px;padding-left: 3%;" class="col-md-6 col-md-offset-1 no-padding control-label dark_label">
              <div style="width:3%;" class="col-sm-1 no-padding">                
                <input id="set_as_homepage" type="checkbox" name="set_as_homepage" value="" <?php if(!empty($getpage) && $getpage->set_as_homepage == 'yes'){echo 'checked';}?>>
              </div>
              <span style="padding-left: 2%;">Set as Home Page</span>
            </label> -->
          </div>
        </div>
      </div>
    </div>
  </fieldset>
  <!-- additional information -->
  <?php
  if($getpage->page_id == 1){
    if($getpage->settings)
    {
      $settingarr=json_decode($getpage->settings);
      $address=$settingarr->address;
      $phone=$settingarr->phone;
      $email=$settingarr->email;
      $weburl=$settingarr->weburl;
      $mapcode=$settingarr->mapcode;
    }else{
      $address="";
      $phone="";
      $email="";
      $weburl="";
      $mapcode="";
    }
  ?>
  <div class="field_container" style="padding-right: 45px;">

    <div class="row tab-content">
      <div class="col-md-6 col-md-6 col-sm-6 col-xs-6" style="width: 100%;">
        <div class="panel panel-primary primary-border panel-collapse" data-collapsed="0">
          <div class="panel-heading">
            <div class="panel-options">
              <span style="left: 20px;position: absolute;top: 10px;font-size: 17px;">Additional Settings</span>
              <a href="#" data-rel="collapse"><i class="entypo-down-open" style="font-size: 20px;"></i></a>
            </div>
          </div>
          <div class="panel-body form-body" style="display: none;">
            <div class="form-group form-border">
              <label class="col-sm-12 control-label field-title" for="name">Address<span class="required"></span></label>
              <div class="col-sm-12">
                <textarea name="address" id="getaddress" cols="40" rows="10" class="form-control form-height">
                  <?php echo $address;?>
                </textarea>
              </div>
            </div>
            <div class="form-group form-border">
              <label class="col-sm-12 control-label field-title" for="name">Phone<span class="required"></span></label>
              <div class="col-sm-12">
                <input type="text" name="phone" id="getphone" value="<?php echo $phone;?>" class="form-control form-height">
              </div>
            </div> 
            <div class="form-group form-border">
              <label class="col-sm-12 control-label field-title" for="name">Email
                <p>All Enquiries from the Contact Us Forms will come to this email id</p>
              </label>
              <div class="col-sm-12">
                <input type="text" name="email" id="getemail" value="<?php echo $email;?>" class="form-control form-height">
              </div>
            </div>
            <div class="form-group form-border">
              <label class="col-sm-12 control-label field-title" for="name">WebSite<span class="required"></span></label>
              <div class="col-sm-12">
                <input type="text" name="weburl" id="getweburl" value="<?php echo $weburl;?>" class="form-control form-height">
              </div>
            </div>
            <div class="form-group form-border">
              <label class="col-sm-12 field-title control-label" for="name">Google Map Code<span class="required"></span></label>
              <div class="col-sm-12">
                <textarea name="mapcode" id="getmapcode" cols="40" rows="10" class="form-control select-box-border">
                  <?php echo $mapcode;?>
                </textarea>
              </div>
              <div class="col-sm-12">
                <p>In case you want to have your student visit your physical academy this map will help them navigate and locate you.To add Code:
                </p>
                <ol>
                  <li>Open Google Maps.</li>
                  <li>Make sure the map or street view image you'd like to embed show up on the map.</li>
                  <li>In the Top left corner, Click the main menu.</li>
                  <li>Click "share or Embed Map".</li>
                  <li>At the top of the box that appears, choose the "Embed Map" Tab.</li>
                  <li>Choose the size you want, then copy the HTML and Paste the code here in the box.</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
<?php } ?>
</div>


<div class="" style="margin-bottom:40px"> 
  <div class="row">
          <div class="col-sm-2">
            <div id="sticky-anchor1"></div>
            <div class="sidebar-nav" id="sidebar">
        <div style="clear: both; display:block"></div>

        <ul class="nav nav-list"> 
          <li class="nav-header">Templates</li> 
          <?php if(!empty($templatelist)){
            $i = 1; 
            foreach ($templatelist as $key) {
          ?>
          <li class="boxes" id="elmBase">
            <div class="element-main-table">
              <div class="box box-element ui-draggable" data-type="code" style="display:flex;">
                <div class="element-green-bg" id="">
                  <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeelement(this.id);">
                    <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
                  </a>
                  <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a>
                  <span class="element-warning-btn element-warning-btn configuration"> 
                    <a class="btn btn-xs settings" data-toggle="modal" onclick="openMymodalSettings(this.id);">
                       <span id="templte_id" style="display: none"><?php echo $key->id; ?></span>
                    <div class="sprite 7settings" style="background-position: -184px 0" title="Edit Module Settings"></div>
                    </a> 
                  </span>
                  <div class="preview"> 
                    <i class="sprite_old text"></i> 
                    <div class="element-desc"><?php echo ucwords($key->template_title); ?></div> 
                  </div>
                  <div class="element-view-content view">
                    <?php echo $key->template_containt;?>
                  </div> 
                </div> 
              </div>
            </div>
          </li>
          <?php $i++; } } ?>
          <li class="boxes" id="elmBase"> 
          
            <div class="box box-element ui-draggable" style="margin: 10px 10px 0 0;display: inline-block;width: 55px;height: 35px;">
              <a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeelement(this.id);">
                <i class="entypo-cancel"></i>
              </a> 
              <a class="drag btn btn-default btn-xs">
                <i class="entypo-window"></i>
              </a>

               <span class="configuration">
                 <a class="btn btn-xs btn-warning settings" data-toggle="modal" onclick="openMymodal(this.id);">
                 <i class="fa fa-gear"></i>
                 </a> 
               </span> 
               <div class="view"> 
                  
               </div> 
            </div> 


            <div class="box box-element ui-draggable" style="margin: 10px 10px 0 0;display: inline-block;width: 55px;height: 35px;">
              <a href="javascript:void(0);" class="remove btn btn-danger btn-xs" onclick="removeelement(this.id);">
                <i class="entypo-cancel"></i>
              </a> 
              <a class="drag btn btn-default btn-xs">
                <i class="entypo-window"></i>
              </a>

               <span class="configuration"> 
                 <a class="btn btn-xs btn-warning settings" data-toggle="modal" onclick="openMymodal(this.id);">
                 <i class="fa fa-gear"></i>
                 </a> 
               </span>
               <div class="view"> 
               </div> 
            </div> 
          </li>
        </ul>
      </div>
      </div>

      <div class="col-sm-9">
        <div id="cart2">   
           <div class="htmlpage ui-sortable dragdroplayout"  style="min-height: 625px;">            
           <?php 
           if(trim($getpage->content) !== ''){
               echo $getpage->content; 
             }
             else{ ?>
                 <div class="lyrow ui-draggable" id="lyrow_1" style="display: block;">
                <div class="layout-main-table">
                    <div class="layout-orange-bg">
                  <a href="javascript:void(0);" class="close-layout-btn remove btn btn-xs" onclick="removeelement(this.id);" id="remove_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
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
                      <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeelement(this.id);" id="removeinner_1">
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
                        <!-- <a class="btn mock" style="" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);" id="a_1">Click Here To Add / edit Videos</a> -->
                      </div> 
                      </div>
                    </div>

                   <?php } else if($task->lecture_type== 'PDF / Doc'){ ?>  
                   
                    <div class="box box-element ui-draggable" data-type="code" style="display: flex;" id="box_1"> 
                      <div class="element-green-bg pdf_view">
                      <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeelement(this.id);" id="removeinner_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
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
                        <!-- <a class="btn mock" style="" href="#" data-toggle="modal" onclick="openmyModalpdf(this.id);" id="a_1">Click Here To Add / Edit Document</a> -->
                      </div> 
                      </div>
                  </div>

                   <?php } else if($task->lecture_type== 'Audio'){ ?> 

                  <div class="box box-element ui-draggable" data-type="map" style="display: flex;" id="box_1">
                    <div class="element-green-bg"> 
                    <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeelement(this.id);" id="removeinner_1"><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a> 
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
                    <!-- <a class="btn mock" style="" href="#" data-toggle="modal" onclick="openmyModalaudio(this.id);" id="a_1">Click Here To Add / Edit Audio</a> -->
                    </div> 
                    </div>
                  </div> 
                   <?php } else if($task->lecture_type== 'Text'){ ?> 

                      <div class="box box-element ui-draggable" data-type="paragraph" style="display: flex;" id="box_1">
                      <div class="element-green-bg" id="">
                        <a href="javascript:void(0);" class="element-close-btn remove btn btn-xs" onclick="removeelement(this.id);" id="removeinner_1">
                          <div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
                        </a> 
                        <a class="element-drag-btn drag btn btn-default btn-xs" id="drag_2">
                          <i class="entypo-window"></i>
                        </a>
                         <a href="javascript:void(0)" class="element-copy-btn btn btn-xs clone" onclick="innerclonele(this.id);" id="innerclone_1"><div class="sprite 3copy" style="background-position: -64px 0; width: 18px;" title="Copy"></div></a> 
                         <span class="element-warning-btn element-warning-btn configuration"> 
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
             <?php } ?>
           </div> 
    </div>
</div> 


  </div>
</div>
      </dd>
    </div>
  </div>
  </div>
</div>
<div style="clear:both;"></div>

<?php echo form_close(); ?>



<div id="content_demo" style="display: none"></div>

<form id="prev_form" style="display: none;" target="_blank" method="post" action="<?php echo base_url();?>category/preview_template/">
  <textarea style="display: none" id="prev_data" name="prev_data"></textarea>
  <input type="hidden" name="pageid" id="pageid" value="">
  <?php if($getpage->page_id == 1){ ?>
  <textarea name="address" id="sendaddress" cols="40" rows="10" class="form-control form-height">
    <?php echo $address;?>
  </textarea>
  <input type="text" name="phone" id="sendphone" value="<?php echo $phone;?>" class="form-control form-height">
  <input type="text" name="email" id="sendemail" value="<?php echo $email;?>" class="form-control form-height">
  <input type="text" name="weburl" id="sendweburl" value="<?php echo $weburl;?>" class="form-control form-height">
  <textarea name="mapcode" id="sendmapcode" cols="40" rows="10" class="form-control select-box-border">
    <?php echo $mapcode;?>
  </textarea>
  <?php } ?>

</form>
<script>
function prev_template(){
  var divdata = $('.htmlpage').html();  
  $("#prev_data").val(divdata); 
  $("#pageid").val($("#page_id").val());
  if($("#page_id").val() == 1){
    $("#sendaddress").val($("#getaddress").val());
    $("#sendphone").val($("#getphone").val());
    $("#sendemail").val($("#getemail").val());
    $("#sendweburl").val($("#getweburl").val());
    $("#sendmapcode").val($("#getmapcode").val());
  }
  $("#prev_form").submit();
}

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link href="<?php echo base_url() ?>public/js/jquery-ui/jquery-ui.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>
<script src="<?php echo base_url() ?>public/js/form-master/jquery.form.js"></script>
<script src="<?php echo base_url();?>public/js/page_creator/lectureeditor_admin.js"></script>
<script src="<?php echo base_url();?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script>
  function removeelement(id)
 {
     var str = id;
    var str_array = str.split('_');
    
    if(str_array[0] =="remove")
    {      

        $.confirm({
            title: 'Do you really want to Remove ?',
            content: ' ',
            confirm: function(){ 
                        $('#'+id).parent().parent().parent().remove();
       
                             },
            cancel: function(){        
                         return true;
                              }
                             });


    }

    if(str_array[0] =="removeinner")
    {   
        
        $.confirm({
            title: 'Do you really want to Remove ?',
            content: ' ',
            confirm: function(){ 
                        $('#'+id).parent().parent().remove();
       
                             },
            cancel: function(){        
                         return true;
                              }
                             });
    }
 }
function lecture_preview()
{   
      var lectureContent = $('.htmlpage').html();
      $.session.set('preview1', JSON.stringify({contentLecture: lectureContent})); 
      var obj = JSON.parse($.session.get('preview1'))             
     window.open('<?php echo base_url(); ?>admin/tasks/lecture_preview/', '_blank');         
}
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
  jQuery('#codearea').redactor({
    pasteCallback: function(html) {
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
/*$("#preview_btn").click(function(){
   $("#sticky").css("display","none");
});*/
</script>
<?php if($task->lecture_video != "video"){ ?>
  
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
<script type="text/javascript" src="<?php echo base_url();?>public/js/jscolor/jscolor.js"></script>
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
    selector : "#paragraph",
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
    jQuery('.removeelement').click(function(){
    var id = jQuery(this).attr('id');
    id = id.substr(6);
     jQuery('#tr'+id).remove();
    });
  });  
</script>
<?php } ?>
<script type="text/javascript">
function edit_lecture()
{
  var page_title = $("#page_title").val().trim();
  if(page_title == ''){
    $("#err_title").html('Please enter page title.');
    setTimeout(function(){
      $("#err_title").html('');
      $("#page_title").focus();
    },2000);
    return false;
  }

  var divdata = $('.htmlpage').html();  
  $("#page_content").val(divdata);  
  var published = $("#published").val();
  $("#published_id").val('inactive');
  if ($('#published').is(":checked"))
  {
    $("#published_id").val('active');
  }

  /*var set_as_homepage = $("#set_as_homepage").val();
  $("#is_homepage").val('no');
  if ($('#set_as_homepage').is(":checked"))
  {
    $("#is_homepage").val('yes');
  }*/
    jQuery.ajax({
        cache: false,
        type: "POST",
        url: " <?php echo base_url()?>admin/pagecreator/build_page/",
        data: jQuery("#frm_edit_lecture").serialize(),
        beforeSend: function(){
            $('#lecture_save').val('Please wait..');
        },
        success: function(msg)
        {
          console.log(msg);
          if(msg != 'update')
          {
              $("#page_id").val(msg);
              var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Page created successfully. </div>';
          }
          else{
            var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>  Page updated successfully. </div>';
          } 
          $('#message').html(str);
          $('#message').show();
          $('#message').fadeIn().delay(3000).fadeOut();
          $('#lecture_save').prop('disabled', false);
          $('#lecture_save').val('Update');
        }
    });
}
$(document).ready(function(){
    $("p").each(function(){ 
        if($(this).html().trim() == '')
          $(this).remove();
    });
  });
function add_redirect_link(val,id){
  // $(".cropped_url").html('<?php echo base_url();?>pages/'+val+'/'+id);
  $(".link_redirect").attr('href','<?php echo base_url();?>pages/'+val+'/'+id);
  $(".showredrcturl").html(val);
}
</script>
