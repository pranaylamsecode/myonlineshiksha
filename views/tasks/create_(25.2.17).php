<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
<!-- ll <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
 <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> ll -->
<!-- jj<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> jj -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/theme.css" type="text/css" media="screen" />

<script src="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.css" rel="stylesheet" />

<style>
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
    top: -4px;
    left: -4%;
    color: black;
 }
/*css*/
.jconfirm .jconfirm-box div.title {
  background-color: #f1f1f1;
  color: #c42140;
  text-transform: uppercase!important;
  font-size: 21px!important;
  font-weight: bold!important;
  text-align: center!important;
  padding: 18px 30px 0 13px !important;
  border-bottom: 0px!important;
  height: 55px!important;
  font-family: inherit;
}
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  padding-left: 20px!important;
  padding-right: 20px!important;
  margin: 28px 0 10px 0!important;
  text-align: center!important;
  font-weight: bold!important;
}
h4.modal-title {
  background-color: #f1f1f1;
  color: #c42140;
  text-transform: uppercase!important;
  font-size: 21px!important;
  font-weight: bold!important;
  text-align: center!important;
  padding: 25px 30px 0 13px !important;
  border-bottom: 0px!important;
  border-radius: 6px 6px 0px 0px;
  height: 73px!important;
}
.close {
  position: relative!important;
  top: -2px!important;
  right: 2px!important;
  font-size: 30px!important;
}
.modal-header {
  min-height: 16.43px;
  padding: 15px;
  border-bottom: 1px solid #e5e5e5;
  text-align: center!important;
  font-weight: bold!important;
}
label {
  display: block;
  margin-bottom: 5px;
 /* width: 25%!important;*/
  float: left!important;
}
.modal .form-group .form-control {
  width: 80% !important;
  float: right!important;
  margin-bottom: 0px!important;
}
/*end of css*/
</style>

<style type="text/css">
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


.redactor-toolbar{
    top: 0 !important;
}
.modal .form-group .form-control {
    width: 100% !important;
}
.modal-header {
    min-height: 16.43px;
    padding: 0px;
    border-bottom: 1px solid #e5e5e5;
}
h4.modal-title {
    font-weight: 500;
    margin:0px !important;
}
#before_menu_txt_1, #before_menu_txt_2,  #before_menu_txt_3, #before_menu_txt_4, #before_menu_txt_5, 
#before_menu_txt_6, #before_menu_txt_7, #before_menu_txt_8, #before_menu_txt_9, #before_menu_txt_10, 
#before_menu_txt_11, #before_menu_txt_12, #before_menu_txt_13, #before_menu_txt_14, #before_menu_txt_15, 
#before_menu_txt_16, #before_menu_txt_17, #before_menu_txt_18, #before_menu_txt_19, #before_menu_txt_20,
#before_menu_med_1, #before_menu_med_2, #before_menu_med_3, #before_menu_med_4, #before_menu_med_5, 
#before_menu_med_6, #before_menu_med_7, #before_menu_med_8, #before_menu_med_9, #before_menu_med_10, 
#before_menu_med_11, #before_menu_med_12, #before_menu_med_13, #before_menu_med_14, #before_menu_med_15, 
#before_menu_med_16, #before_menu_med_17, #before_menu_med_18, #before_menu_med_19, #before_menu_med_20
{
  width: 50%;
  float: left;
}
.iframe_cont iframe 
{
width:380px !important;
height: 240px !important;
}
.iframe_cont object
{
width:380px !important;
height: 240px !important;
}
.iframe_cont img 
{
width:380px !important;
height: 240px !important;
}
.table-bordered th, .table-bordered td {

    border: 1px solid #dddddd;
    border-top: 1px solid #dddddd !important;
}
.btn-warning {
  color: #ffffff;
  background-color: #fad839;
  border-color: #fad839;
}
.btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .open .dropdown-toggle.btn-warning {
  color: #ffffff;
  background-color: #f9d011;
  border-color: #f0c706;
}
.btn:hover, .btn:focus{
      background-position: 0;
}

#sticky.stick {
  position: fixed;
  top: 0;
  z-index: 10000;
  border-radius: 0 0 0 10px;
  right: 0;
  padding: 10px 20px 15px 20px;
  background: rgba(228, 228, 228, 0.86);
  margin-top: 0 !important;
}

div#upload_i {
  padding: 30px 20px 0 20px;
}

div#videoUploader {
  padding-left: 10px;
  padding-top: 10px;
}

.pop-btm-btn{
  width: 280px;
  margin: 0 auto;
  text-align: center;
}

.in-uvr small{
  color: #777777;
}

.in-uvr-txt{
padding-top: 20px;
}

.in-uvr-txt p{
    text-align: center;
    font-size: 12px;
}

div#advancedOptions {
  padding: 20px 30px;
}

.in-uvr input#url_v1 {
  margin: 0 0px !important;
  width: 100% !important;
}

.panel {
  margin-bottom: 17px;
  background-color: #fff;
  border-top: 1px solid #ddd;
  border-radius: 10px;
  border-left: 1px solid #ddd;
  border-right: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}

.panel-body {
  position: relative;
  padding: 40px 0px 20px 0px;
  max-height: initial !important;
  overflow: visible !important;
}

.nav-tabs {
  border-bottom: 1px solid #ddd;
}

.nav-tabs > li {
  margin-bottom: -1px;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
  color: #555555;
  background-color: #ffffff;
  border: 1px solid #ddd;
  border-bottom-color: transparent;
  cursor: default;
}

.nav-tabs, .nav-pills {
  padding-left: 20px;
}

.tab-content {
  overflow: hidden;
}

.tab-content > .active, .pill-content > .active {
  display: block;
  padding: 20px 20px 0;
}

.tab-pane {
  border-right: 1px solid #ddd;
  border-bottom: 0;
  border-left: 1px solid #ddd;
  margin-left: -1px;
  margin-right: -1px;
}

a#disOpt {
    padding-left: 30px;
    font-size: 12px;
}
a#disOpt span.dis1{

  text-decoration: underline;
}

a#disOpt span.dis2{
  color: #000;
  padding-left: 5px;
  text-decoration: none;
}
.footer-right-side{
  display: block;
  margin-bottom: 5px;
  width: 55%!important;
  float: left!important;
}
.footer-right-side1{
  display: block;
  margin-bottom: 5px;
  width: 52%!important;
  float: left!important;
}
ul.lay-ul {
  padding: 0;
  margin: 0;
  list-style: none;
  height: 210px!important;
  overflow: auto;
}
/*---progress bar css---*/
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
@media(max-width:767px){
.image-label-width{
  width: 22%!important;
}
.video-label-width{
    width: 30%!important;
}
}
@media(max-width:640px){
.label-width{
  width:100%!important;
}
.image-label-width {
  width: 35%!important;
}
}
@media (max-width: 480px){
.image-label-width {
  width: 45%!important;
}
}
</style>
<script>
    $(document).ready(
        function()
        {
            
            $('#lec_content').redactor({
                    focus: true,
                    imageUpload: window.location.origin+'/tasks/getImage',
                    'plugins': ['fontsize','fontcolor','fontfamily','video','imagelink'],
                    
            });         

        }
    );
</script>



<!--/lightbox scripts and style-->

<script type="text/javascript">
 $(function(){
   $("#forward").click(function() {

   window.parent.location.href = "<?php echo base_url(); ?>days/<?php echo $pid?>";

    });

        });

</script>

<script type="text/javascript">
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

<?php
$attributes = array('class' => 'tform', 'id' => 'frm_save_lecture');
echo form_open(base_url().'tasks/save_lecture', $attributes);
?>

<header>
<section class="breadcrumb">

<div class="container">
  <div class="row">
    <div> <span style="float:left;">
      <h2> <?php echo ($updType == 'create') ? "Create Lecture" : "Edit Lecture";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?> </h2>
      </span> 

        <div id="sticky-anchor"></div>
        <div id="sticky" style="float:right; margin-top: 10px;"> 
            <a id="preview_btn" href='<?php echo base_url(); ?>sections-manage/<?php echo($updType == 'edit') ?  $this->uri->segment(5) : $this->uri->segment(4); ?>/index' class="btn btn-primary">Back to list</a>
            <a id="preview_btn" onclick="lecture_preview();" class="btn btn-info" title="Inform about this change made in lecture to all the enrolled students of this course." >Lecture Preview</a>
            <?php 
                if($updType == 'edit')
                {
            ?>
                <a id="inform_btn" class="btn btn-orange" title="Inform about this change made in lecture to all the enrolled students of this course." >Save and Inform</a>

            <?php
                    
                } 
                ?>  
            <!-- <a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'") ); ?></a>  -->
            <a><input type="button" id='lecture_save' name="lecture_save" class='btn btn-success' value="Save" onclick="save_lecture();" ></a> 
            <a href='<?php echo base_url(); ?>sections-manage/<?php echo($updType == 'edit') ?  $this->uri->segment(5) : $this->uri->segment(4); ?>/index' class='btn btn-danger' id="forward">Cancel</a> 
        </div> 

     </div>
  </div>
  <script>
    jQuery(document).ready(
        function()
        {
            jQuery('#inform_txt').hide();
        });

  </script>
 
</div>
</section>
</header>
<div class="clr"></div>
<script type="text/javascript">

            $(function(){

                $('dl.tabs dt').click(function(){

                    $(this).siblings().removeClass('selected').end().next('dd').andSelf().addClass('selected');

                });

            });

     $(document).ready(function() {

         $("span.error").each(function() {

         var get_error = $(this).text();
         if (get_error.length > 1) {
                $(this).closest('dd').prev('dt').css('background-color', 'red');


           }

        });

     });
</script>
<style type="text/css">
    table {
  border-collapse: collapse !important;
}
</style>

<div class="clr"></div>

<div class="page-container">
    <div class="main-content">  
        <div class="row">
            <div class="col-sm-12" style="width:100%;">
                <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body form-horizontal form-groups-bordered" style="padding: 20px 0 0 0;">
                    <div class="form-group" id="inform_txt" style="display: none;"> 
                        <label for="field-1" class="col-sm-3 control-label"></label>                        
                        <div class="col-sm-5">  
                            <textarea class="form-control"  style="background-color: cornsilk;" name="inform_msg" id="inform_msg" placeholder="Enter information about modification and Click on Save button."  class="form-control"></textarea>
                            
                        </div> 
                    </div>

                    <ul class="nav nav-tabs bordered" style="padding: 0 0 0 20px;">
                        <!-- available classes "bordered", "right-aligned" -->
                        <li class="active"> 
                            <a href="#lecture" data-toggle="tab"> 
                            <span class="visible-xs"><i class="entypo-home"></i></span> <span class="hidden-xs">Lecture Detail</span> 
                            </a> 
                        </li>
                       
                        
                        <li> 
                            <a href="#meta" data-toggle="tab"> 
                            <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Meta Tags</span> 
                            </a> 
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                <div class="tab-pane active" id="lecture" style="border:0;">
                    <div class="panel-heading">
                        <div class="panel-title" style="padding-bottom: 0px;">  
                            <h4 style="margin-top: 10px; margin-left:20px; color: #09c; font-size: 14px; font-weight: bold; text-transform: uppercase;">New Lecture</h4>
                        </div> 
                    </div>
                    <hr style="margin-bottom:0px; margin-top: 0;">

                <div class="panel-body form-horizontal form-groups-bordered"> 

                <div class="form-group"> 
                    <label class="col-sm-3 control-label"><?php echo 'Lecture Name:'//echo lang('web_name')?> <span class="required">*</span></label> 

                    <div class="col-sm-5"> 
                    <input class="form-control" id="name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>"  />
                          
                          <!-- tooltip area --> 
                          
                          <span class="tooltipcontainer"> <span type="text" id="name-target" class="tooltipicon"></span> <span class="name-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                          
                          <!--tip containt--> 
                          
                          <?php echo lang('lecture_fld_name');?> 
                          
                          <!--/tip containt--> 
                          
                          </span> </span> 
                          
                          <!-- tooltip area finish --> 
                          
                          <span class="error"><?php echo form_error('name'); ?> </span>
                    </div> 
                </div>

        

        <div class="form-group"> 
            <label class="col-sm-3 control-label">Level:<span class="required">*</span></label> 

            <div class="col-sm-5"> 
                <select id="difficultylevel" name="difficultylevel" class="form-control" size="1">
                        <option value="">Select Level</option>
                        <option value="easy" <?php echo preset_select('difficultylevel', 'easy', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Easy</option>
                        <option value="medium" <?php echo preset_select('difficultylevel', 'medium', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Medium</option>
                        <option value="hard" <?php echo preset_select('difficultylevel', 'hard', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Hard</option>
                      </select>
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="difficultylevel-target" class="tooltipicon"></span> <span class="difficultylevel-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_difficultylevel');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish --> 
                      
                      <span class="error"><?php echo form_error('difficultylevel'); ?> </span>
            </div> 
        </div>

        <div class="form-group"> 
            <label class="col-sm-3 control-label"><?=lang('web_active')?></label> 

            <div class="col-sm-5">
            <div class="checkbox"> 
                <label> <input id="published" type="checkbox" name="published" value='1' <?=preset_checkbox('published', '1', (isset($task->published)) ? $task->published : ''  )?> <?php echo ($this->input->post('published')) ? "checked":(isset($task->published) ? "checked":'') ?> <?php echo $updType == 'create' ? 'checked': ''; ?> /></label>
                      <!--<label class='labelforminline' for='active'>
                        <?=lang('web_is_active')?>
                      </label>-->
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="published-target" class="tooltipicon"></span> <span class="published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_published');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish --> 
                      
                      <?php echo form_error('published'); ?>
            </div> 
            </div>
        </div>

        </div>
    
<!-- third  strat-->
<div class="mostparent" style="margin-bottom:40px"> 
  <div class="row">
                <div class="col-sm-2">
                  <div id="sticky-anchor1"></div>
                  <div class="sidebar-nav" id="sidebar">
                   <ul class="nav nav-list "> 
                    <li class="nav-header">Layouts</li>

                    <li class="rows" id="estRows"> 

                        <div class="lyrow ui-draggable">
                            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
                            <a class="drag btn btn-default btn-xs">
                                <i class="sprite onecol"></i>
                                <i class="entypo-window"></i>
                            </a> 
                            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
                            
                            <div class="preview">
                                <span></span>
                            </div> 
                            <div class="view" style="display:none">
                                <div class="row clearfix">
                                    <div class="col-md-12 column dragelement">                                      


                                    </div> 
                                </div> 
                            </div> 
                        </div> 

                        <div class="lyrow ui-draggable">
                            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
                            <a class="drag btn btn-default btn-xs">
                            <i class="sprite twocol"></i>
                            <i class="entypo-window"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
                            
                            <div class="preview">
                                <span></span>
                            </div>

                            <div class="view" style="display:none"> 
                            <div class="row clearfix"> 
                            <div class="col-md-6 column dragelement"></div>
                            <div class="col-md-6 column dragelement"></div> 
                            </div> 
                            </div> 
                        </div>

            <div class="lyrow ui-draggable">
              <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
              <a class="drag btn btn-default btn-xs"><i class="sprite leftcol"></i></a> 
              <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
              
              <div class="preview">
                <span></span>
              </div> 
              <div class="view" style="display:none"> 
                <div class="row clearfix"> 
                  <div class="col-md-4 column dragelement"></div>
                  <div class="col-md-8 column dragelement"></div> 
                </div> 
              </div> 
            </div>       

                        <div class="lyrow ui-draggable"> 
                            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a>
                            <a class="drag btn btn-default btn-xs">
                            <i class="sprite rightcol"></i>
                            <i class="entypo-window"></i>
                            </a> 
                            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
                            
                            <div class="preview"><span></span></div> 
                            
                            <div class="view" style="display:none"> 
                                <div class="row clearfix"> 
                                    <div class="col-md-8 column dragelement"></div> 
                                
                                    <div class="col-md-4 column dragelement"></div> 
                                </div> 
                            </div> 
                        </div> 
                        
                        
                        <div class="lyrow ui-draggable"> 
                        <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
                        <a class="drag btn btn-default btn-xs">
                            <i class="sprite threecol"></i>
                            <i class="entypo-window"></i>
                        </a> 
                        <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
                        <div class="preview"><span></span></div> 
                            <div class="view" style="display:none"> 
                                <div class="row clearfix"> 
                                    <div class="col-md-4 column dragelement"></div> 
                                    <div class="col-md-4 column dragelement"></div> 
                                    <div class="col-md-4 column dragelement"></div> 
                                </div> 
                            </div> 
                        </div>
                        
                        <div class="lyrow ui-draggable"> 
                        <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
                        <a class="drag btn btn-default btn-xs">
                            <i class="sprite fourcol"></i>
                            <i class="entypo-window"></i>
                        </a> 
                        <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
                        <div class="preview"><span></span></div> 
                            <div class="view" style="display:none"> 
                                <div class="row clearfix"> 
                                    <div class="col-md-3 column dragelement"></div> 
                                    <div class="col-md-3 column dragelement"></div> 
                                    <div class="col-md-3 column dragelement"></div> 
                                    <div class="col-md-3 column dragelement"></div> 
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
                    
                        <div class="box box-element ui-draggable" data-type="paragraph">
                          <div class="preview"> 
                               <i class="sprite text"></i> 
                              <div class="element-desc">Paragraph</div> 
                           </div>
                          <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
                            <i class="entypo-cancel"></i>
                          </a> 
                          <a class="drag btn btn-default btn-xs">
                            <i class="entypo-window"></i>
                          </a>
                          <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
                           <span class="configuration"> 
                            <!--  <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#myModal" onclick="openMymodal();"> -->
                             <a class="btn btn-xs btn-warning settings" data-toggle="modal" onclick="openMymodal(this.id);">
                             <i class="fa fa-gear"></i>
                             </a> 
                           </span> 

                           <select class="form-control" name="Alignment" onchange="setAlign(this)">                          
                               <option value="Left">Left</option>
                               <option value="Center">Center</option> 
                               <option value="Right">Right</option> 
                           </select>


                          <!--  <div class="preview"> 
                               <i class="sprite text"></i> 
                              <div class="element-desc">Paragraph</div> 
                           </div> -->

                           <div class="view"> 
                             <a class="btn mock" style="display:none !important" data-toggle="modal" href="#" onclick="openMymodal(this.id);">Click Here To Add / Edit Text</a>
                                <!-- <p style="display:none">Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>  -->
                           </div> 
                        </div> 

                        <div class="box box-element ui-draggable" data-type="image"> 
                        
                            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
                             
                            <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
                            
                            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
                            <span class="configuration">
                            <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalImage(this.id);">
                            <i class="fa fa-gear"></i></a> 
                            </span>

                             <select class="form-control" name="Alignment" onchange="setAlign(this)">                 
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
               </select>
                            
                            <div class="preview"> 
                            <i class="sprite image"></i> 
                            <div class="element-desc">Image</div>  
                            </div> 
                            
                            <div class="view">
                            <a class="btn mock" style="display:none !important" data-toggle="modal" href="#" onclick="openmyModalImage(this.id);">Click Here To Add / Edit Images</a>
                            </div> 
                        </div>

              <div class="box box-element ui-draggable" data-type="Videos">

              <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
                <i class="entypo-cancel"></i>
              </a> 

              <a class="drag btn btn-default btn-xs">
                <i class="entypo-window"></i>
              </a>
              <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
              <span class="configuration"> 
                <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);">
                  <i class="fa fa-gear"></i>
                </a>
              </span>              
              <div class="preview"> 
              <i class="sprite video"></i> 
                <div class="element-desc">Videos</div> 
              </div> 
              
              <div class="view"> 
                <a class="btn mock" style="display:none !important" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);">Click Here To Add / edit Videos</a>
              </div> 

            </div> 


            <div class="box box-element ui-draggable" data-type="map"> 
            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
            <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a>
            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
            <span class="configuration"> 
              <a class="btn btn-xs btn-warning settings" href="#" data-toggle="modal"  onclick="openmyModalaudio(this.id);" ><i class="fa fa-gear"></i></a> 
            </span>

            <select class="form-control" name="Alignment" onchange="setAlign(this)">                 
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
              </select>


            <div class="preview"> <i class="sprite audio"></i> 
            <div class="element-desc">Audio</div> 
            </div> 
            <div class="view"> 
            <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalaudio(this.id);">Click Here To Add / Edit Audio</a>
            </div> 
            </div>


            <div class="box box-element ui-draggable" data-type="Gallery">
            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
            <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
            <span class="configuration"> 
                <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalGallery(this.id);"><i class="fa fa-gear"></i></a> 
            </span> 
            
            <div class="preview">
            <i class="sprite gallery"></i> 
            <div class="element-desc">Gallery</div> </div> 
            <div class="view"> 
            <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalGallery(this.id);">Click Here To Add / Edit Gallery</a>
            </div> 
            </div> 



                        <div class="box box-element ui-draggable" data-type="code"> 

                            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
                            <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
                            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
                            <span class="configuration"> 
                                <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalpdf(this.id);"><i class="fa fa-gear"></i></a> 
                            </span> 
                            
                            <div class="preview">
                                <i class="sprite documents"></i> 
                                <div class="element-desc">Pdf</div> 
                            </div> 

                            <div class="view"> 
                                <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalpdf(this.id);">Click Here To Add / Edit Document</a>
                            </div> 
                        
                        </div>

            <div class="box box-element ui-draggable" data-type="code"> 

              <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
              <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
              <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
              <span class="configuration"> 
                <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalCode(this.id);"><i class="fa fa-gear"></i></a> 
              </span> 

               <select class="form-control" name="Alignment" onchange="setAlign(this)">                
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
                  </select>
              
              <div class="preview">
                <i class="sprite code"></i> 
                <div class="element-desc">Code</div> 
              </div> 

              <div class="view">
              <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalCode(this.id);">Click Here To Add / Edit Code</a>
              </div> 
            
            </div>


             <div class="box box-element ui-draggable" data-type="button">
              <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
                <i class="entypo-cancel"></i>
              </a>

              <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
             <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
              <span class="configuration"> 
                <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalflash(this.id);"><i class="fa fa-gear"></i></a> 
              </span>

              <div class="preview"> 
                <i class="sprite flash"></i> 
                <div class="element-desc">Flash</div>
              </div> 

              <div class="view"> 
               <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalflash(this.id);">Click Here To Add / Edit Flash</a>
              </div> 
              </div> 

                        

                        <div class="box box-element ui-draggable" data-type="button">
                            <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
                                <i class="entypo-cancel"></i>
                            </a>

                            <a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
                            <a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="innerclonele(this.id);"><i class="entypo-docs"></i></a> 
                            <span class="configuration"> 
                                <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalbutton(this.id);"><i class="fa fa-gear"></i></a> 
                            </span>

               <select class="form-control" name="Alignment" onchange="setAlign(this)">                
                 <option value="Left">Left</option>
                 <option value="Center">Center</option> 
                 <option value="Right">Right</option> 
                </select>

                            <div class="preview"> 
                                <i class="sprite jump"></i> 
                                <div class="element-desc">Button</div>
                            </div> 

                            <div class="view"> 
                                <a class="btn mock" style="display:none !important" href="#" data-toggle="modal" onclick="openmyModalbutton(this.id);">Click Here To Add / Edit Button</a>
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
                          <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
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
                               <i class="sprite RightArrow52x sprite TextAlignLeft2x"></i> 
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
                          <a href="javascript:void(0)" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
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
                               <i class="sprite RightArrow52x sprite TextAlignLeft2x"></i> 
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
          <div id="cart2">   
             <div class="htmlpage ui-sortable dragdroplayout" style="min-height: 625px;">

                

             </div> 
        </div>
        </div>
  </div>
</div>

<!-- third  end-->

<!-- models start -->
<!-- Modal -->
  

  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<!-- models end -->
        </div>
        

          

        <div class="tab-pane" id="publishing" style="height: 320px;">
          
            <fieldset class="adminform">
              <legend>Publishing</legend>
              <table class="adminform">
                <tbody>
                  <tr>
                    <td valign="top" style="padding-left: 70px;"><label class='labelform'>
                        <?=lang('web_active')?>
                      </label></td>
                    <td width="50%" style="padding-left: 20px;"><input id="published" type="checkbox" name="published" value='1' <?=preset_checkbox('published', '1', (isset($task->published)) ? $task->published : ''  )?> <?php echo ($this->input->post('published')) ? "checked":(isset($task->published) ? "checked":'') ?> <?php echo $updType == 'create' ? 'checked': ''; ?> />
                      <!--<label class='labelforminline' for='active'>
                        <?=lang('web_is_active')?>
                      </label>-->
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="published-target" class="tooltipicon"></span> <span class="published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_published');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish --> 
                      
                      <?php echo form_error('published'); ?></td>
                  </tr>
                 
                </tbody>
              </table>
            </fieldset>
       
        </div>
        
        <div class="tab-pane" id="meta">
            <div class="panel panel-primary" data-collapsed="0" style="border:0;"> 

                <div class="panel-body form-horizontal form-groups-bordered"> 

                    <div class="form-group"> 
                        <label class="col-sm-3 control-label"><?php echo 'Title:'//echo lang('web_name')?></label> 

                        <div class="col-sm-5"> 

                        <input class="form-control" id="title" type="text" name="title" maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : ((isset($task->metatitle)) ? $task->metatitle : ''); ?>"  />
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="meta_title-target" class="tooltipicon"></span> <span class="meta_title-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_meta-title');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish -->

                        </div> 
                    </div>

                    <div class="form-group"> 
                        <label class="col-sm-3 control-label"><?php echo 'Keywords:'//echo lang('web_name')?></label> 

                        <div class="col-sm-5"> 
                        <?php //$this->ckeditor->editor("key_description",($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''));?>
                        <textarea class="form-control" id="key_description"  name="key_description"><?php echo ($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''); ?></textarea>
                        
                        <!-- tooltip area --> 
                        
                        <span class="tooltipcontainer"> <span type="text" id="meta_desc-target" class="tooltipicon"></span> <span class="meta_desc-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                        
                        <!--tip containt--> 
                        
                         <?php echo lang('lecture_fld_meta-keyword');?> 
                        
                        <!--/tip containt--> 
                        
                        </span> </span> 
                        
                        <!-- tooltip area finish --> 

                        </div> 
                    </div>

                    <div class="form-group"> 
                        <label class="col-sm-3 control-label"><?php echo 'Description:'//echo lang('web_name')?></label> 

                        <div class="col-sm-5">

                         <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''));?>
                        <textarea  class="form-control" id="description"  name="description"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''); ?></textarea>
                        
                        <!-- tooltip area --> 
                        
                        <span class="tooltipcontainer"> <span type="text" id="meta_keyword-target" class="tooltipicon"></span> <span class="meta_keyword-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                        
                        <!--tip containt--> 
                         <?php echo lang('lecture_fld_meta-desc');?> 
                      
                        
                        <!--/tip containt--> 
                        
                        </span> </span> 
                        
                        <!-- tooltip area finish --> 

                        </div> 
                    </div>


                </div>

            </div>


          
         
        </div>        
      </div>

                </div>

            </div>

        </div>

    </div>

</div>

<textarea style="display:none" class="form-control" id="content_lecture"  name="content_lecture"></textarea>

<div style="clear:both;"></div>
<!-- <button onclick="loadfuction12()">ok</button>
<input type="button" onclick="loadfuction12()" value="oookkk">
 <div style="width:500px" id="loaddiv">
 </div> -->

<?php echo form_hidden('pid',$pid) ?> <?php echo form_hidden('did',$did) ?>
<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$task->id) ?>
<?php endif ?>
<?php echo form_close(); ?> 


<!-- ---------------------------------------------Paragraph-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Paragraph</h4>
        </div>
        <div class="modal-body">
          <div > 
            <div class="col-md-12"> 
                <div class="form-group">
                 <input type="hidden" name="txtparagraph" id="txtparagraph" value="">
                 <input type="hidden" name="tempval" id="tempval" value="">
                 <!--  <label for="Paragraph" id="label">Enter Your Text:</label> -->
                  <textarea class="form-control paragraphclass" rows="5" id="paragraph"></textarea>
                </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="setText()">Apply changes</button>
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Paragraph-POP-UP-End----------------------------------------------- -->



<!-- ---------------------------------------------Image-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Image</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 
    

            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="image_file"> 
                        <a href="#upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li id="image_library"> 
                        <a href="#medlib" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    <li id="image_url"> 
                        <a href="#medins" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Insert URL</span> 
                        </a> 
                    </li>
                </ul> 

                <div class="tab-content">
                    <div class="tab-pane active" id="upfil"> 
                     <form id="myForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-md-3 col-sm-12 control-label label-width">Image Upload</label> 

                            <div class="col-md-9 col-sm-12"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    
                                    <input type="hidden"> 
                                    
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput"> 
                                    <img src="http://placehold.it/200x150" alt="..." id="imgname" class="img-responsive profile-image"> 
                                    <img id="blah" src="#" width="125px" height="130px" alt="your image" class="img-responsive profile-image">
                                    </div> 
                                    
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div> 

                                    <div> 
                                    <!-- <form id="myForm" action="<?php echo base_url(); ?>tasks/upload_image" method="post" enctype="multipart/form-data"> -->
                                        <span class="btn btn-white btn-file"> 
                                        <span class="fileinput-new">Select image</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" accept="image/*" id="file_i" name="file_i" data-filename-placement="inside"> </span> 
                                        <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a> 
                                        <input type="button" id="remove_id" value="Remove" class="btn btn-red" />
                                        <span id="profineDiv"></span>
                                    </div>                                  
                                     
                                     <div id="progress" class="progressBar">
                                            <div id="bar"><div id="percent"></div ></div>
                                            
                                    </div>
                                    <br/>
                                     
                                    <div id="message"></div>

                                    <!-- new code end here -->
                                </div> 

                            </div> 

                        </div>
                        
                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="img_div_id" name="img_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Image" class="form-control">
                                <input type="submit" id="submit" class="btn btn-success" value="Upload Image"/>
                            </div>

                        </div>
                        </form>
                    </div> 

                    <div class="tab-pane" id="medlib"> 
                        <div class="col-sm-12" id="row_list" style="height: 175px;overflow: auto;">
                        <!-- empty Div row for prepend column start-->
                        <div class="row" id="images_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                        
                        <!-- ll<?php
                        $imagecount =0; 
                        $counter = 0;
                        if($loadImage)
                        {
                        foreach($loadImage as $key => $imagedata) 
                        { 
                            if($counter == 0)
                            {   
                        ?>
                        <div class="row" style="padding: 0 0 10px 0;">
                        <?php } ?>
                        
                            
                            <div class="col-sm-3">                              
                                <img src="<?php echo base_url();?>public/uploads/images/<?php echo $imagedata->media_title;?>" alt="<?php echo $imagedata->media_title;?>_<?php echo $imagedata->id;?>"> 
                            </div>
                                    
                            <?php
                            $counter =1;
                            if(($key+1) %4 == 0)
                            {
                                
                            ?>                              
                            </div>
                      <?php 
                      $counter = 0;             
                            }
                        $imagecount++;
                        } 
                    }
                    else
                    {
                        echo"Image Not Available";
                    } 
                        ?>
                                                                
                            <?php 
                        if($imagecount % 4 != 0) 
                        {
                        ?>
                            </div>
                        <?php
                         }
                        ?>ll -->
                        </div>

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">
                        <form id="save_image_data" name="save_image_data" action="<?php echo base_url(); ?>tasks/update_media_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5"> 
                                    <input type="hidden" name="image_id" id="image_id" class="form-control">
                                    <input type="hidden" name="title_media" id="title_media" class="form-control">
                                    <input type="text" name="alt_title_image" id="alt_title_image" class="form-control">
                                </div>
                            </div>

                            <div class="form-group" style="padding-top: 10px;">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="submit" id="save_image" class="btn btn-success" value="Save" onclick=""/>
                                </div>

                            </div>  
                            </form>
                        </div>

                    </div> 

                    <div class="tab-pane" id="medins"> 

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <div class="form-group">
                            <label class="col-md-6 col-sm-4 control-label image-label-width">Insert Image URL</label> 
                                <div class="col-md-6 col-sm-8"> 
                                    <input type="text" id="txt_image_url" name="txt_image_url" class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label label-width"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" id="submit" class="btn btn-success" value="Save" onclick="addImageUrl()"/>
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
<!-- ---------------------------------------------Image-POP-UP-End----------------------------------------------- -->



<!-- ---------------------------------------------Button-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalbutton" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Button</h4>
        </div>
        <div class="modal-body">
          
          <!-- new code -->       
                <div>                       
                        <div class="col-md-12"> 
                            <div class="form-group">
                              
                                <label class="col-sm-3 control-label">Title of Button</label>               
                                 <div class="col-sm-9">
                                    <input type="hidden" name="btn_div_id" id="btn_div_id" value="">    
                                   <input type="hidden" name="courseg" id="courseg" value="<?php echo $this->uri->segment(4); ?>">              
                                    <input type="text" name="title_button" id="title_button" class="form-control">
                                </div>
                             </div>

                             <div class="form-group">
                             <label class="col-sm-3 control-label">Description</label>  
                             <div class="col-sm-9">
                                <textarea id="msgforbtn" name="msgforbtn" style="width: 100%;"></textarea>
                                </div>
                             </div>

                             <div class="form-group" style="padding-left: 123px;">              
                                            
                                <div class="checkbox">                              
                                  <label style="width: 100% !important;"><input type="checkbox" onclick="this.checked=true; loadCourses(this.id)" id="self_course" name="group2[]" value="">Self Course</label>
                                </div>
                                <div class="checkbox">
                                  <label style="width: 100% !important;"><input type="checkbox" onclick="this.checked=true; loadCourses(this.id)" id="other_courses" name="group2[]" value="">Other Courses</label>
                                </div>
                            
                                    
                            </div>

                             <div class="form-group">
                                    <ul class="lay-ul" id="ULloadcurse">                                        
                                    </ul>
                            </div>

                        </div>                      
                    
            </div>

          <!-- new code end -->


               
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>

<!-- ---------------------------------------------Button-POP-UP-End----------------------------------------------- -->


<!-- ---------------------------------------------Video-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalyoutube" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Videos</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 
        

            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="video_file"> 
                        <a href="#video-upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li id="video_library"> 
                        <a href="#video-medlib" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    <li id="video_url"> 
                        <a href="#videoins" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Insert Videos URL</span> 
                        </a> 
                    </li>
                    <li id="video_url"> 
                        <a href="#videoiframe" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Insert Videos code</span> 
                        </a> 
                    </li>
                    
                </ul> 

                <div class="tab-content">
                    <div class="tab-pane active" id="video-upfil"> 
                    <form id="videoForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label">Upload File</label> 

                            <div class="col-sm-5"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" accept="video/*" name="file_i" id="file_v"> 
                                    </span>

                                    <div id="progress_video" class="progressBar">
                                            <div id="bar_video"><div id="percent_video"></div ></div>
                                            
                                    </div> 

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                            </div>

                        </div>
                    
                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="video_div_id" name="video_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Video" class="form-control">
                                <input type="submit" id="submitvideo" class="btn btn-success" value="Save"/>
                            </div>

                        </div>
                     </form>
                    </div> 
                    <div class="tab-pane" id="video-medlib"> 
                        <div class="col-sm-12" id="video_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="video_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                        
                        <!-- ll<?php
                        $videocount =0; 
                        $counter = 0;
                        if($loadVideo)
                        {
                        foreach ($loadVideo as $key => $videodata) 
                        { 
                            if($counter == 0)
                            {   
                        ?>
                        <div class="row" style="padding: 0 0 10px 0;">
                        <?php } ?>
                        
                            
                            <div class="col-sm-3">                              
                            <img src="" width="125" height="100" alt="<?php echo $videodata->media_title;?>#_#<?php echo $videodata->id;?>">                            
                                
                            </div>
                                    
                            <?php
                            $counter =1;
                            if(($key+1) %4 == 0)
                            {
                                
                            ?>                              
                            </div>
                      <?php 
                      $counter = 0;             
                            }
                            $videocount++;
                        }
                    }
                    else
                    {
                        echo"Videos Not Available";
                    }  
                        ?>
                        
                        <?php 
                        if($videocount % 4 != 0) 
                        {
                        ?>
                            </div>
                        <?php
                         }
                        ?>ll -->
                                                    
                            
                        </div>

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">
                        <form id="save_video_data" name="save_video_data" action="<?php echo base_url(); ?>tasks/update_video_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5">          

                                    <input type="hidden" name="video_id" id="video_id" class="form-control">
                                    <input type="hidden" name="title_video" id="title_video" class="form-control">
                                    <input type="text" name="alt_title_video" id="alt_title_video" class="form-control">

                                </div>
                            </div>                      


                            <div class="form-group" style="padding-top:10px">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="submit"  class="btn btn-success" value="Save" />
                                </div>

                            </div>  
                            </form>
                        </div>


                    </div> 

                    <div class="tab-pane" id="videoins"> 

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <div class="form-group">
                            <label class="col-sm-4 col-md-4 control-label image-label-width">Insert Videos URL</label> 
                                <div class="col-sm-8 col-md-8"> 
                                    <input type="text" class="form-control" id="txt_video_url">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" id="videourl" class="btn btn-success" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
                                </div>

                            </div>  

                        </div>


                    </div> 

                    <div class="tab-pane" id="videoiframe"> 

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <div class="form-group">
                            <label class="col-md-4 col-sm-4 control-label video-label-width">Insert Videos code</label> 
                                <div class="col-md-8 col-sm-8"> 
                                    <!-- <input type="text" class="form-control" id="txt_video_embed"> -->
                                    <textarea class="form-control" id="txt_video_embed" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="form-group" style="padding-top:8px;">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" id="videoembed" class="btn btn-success" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
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
<!-- ---------------------------------------------Video-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------PDF-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalpdf" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PDF</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 


            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="pdf_file"> 
                        <a href="#pdf-upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li id="pdf_library"> 
                        <a href="#pdf-medlib" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    <li> 
                        <a href="#pdfins" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Insert PDF URL</span> 
                        </a> 
                    </li>
                </ul> 

                <div class="tab-content">
                    <div class="tab-pane active" id="pdf-upfil"> 
                    <form id="pdfForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label">Upload File</label> 

                            <div class="col-sm-5"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" accept="Documents/*" name="file_i" id="file_d"> 
                                    </span> 

                                    <div id="progress_pdf" class="progressBar">
                                            <div id="bar_pdf"><div id="percent_pdf"></div ></div>
                                            
                                    </div>

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                            </div>

                        </div>

                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="pdf_div_id" name="pdf_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Document" class="form-control">
                                <input type="submit" id="submitPDF" class="btn btn-success" value="Upload"/>
                            </div>

                        </div>
                    </form>
                    </div> 

                    <div class="tab-pane" id="pdf-medlib"> 
                        <div class="col-sm-12" id="pdf_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="pdf_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                        
                        <!-- ll<?php 
                        $divcount =0;
                        $counter = 0;
                        if($loadPdf)
                        {
                        foreach ($loadPdf as $key => $pdfdata) 
                        { 
                            if($counter == 0)
                            {   
                        ?>
                        <div class="row" style="padding: 0 0 10px 0;">
                        <?php } ?>
                        
                            
                            <div class="col-sm-3">                          
                            <div class="overlay-imf-pdf" alt="<?php echo $pdfdata->media_title;?>#_#<?php echo $pdfdata->id;?>"></div>                          
                            <img src="" width="125" height="100" alt="<?php echo $videodata->media_title;?>#_#<?php echo $videodata->id;?>">
                            </div>
                                    
                            <?php
                            $counter =1;
                            if(($key+1) %4 == 0)
                            {
                                
                            ?>                              
                            </div>
                      <?php 
                      $counter = 0;             
                            }
                            $divcount++;
                        }
                    }
                    else
                    {
                        echo"Documents Not Available";
                    }  

                        ?>
                        <?php 
                        if($divcount % 4 != 0) 
                        {
                        ?>
                            </div>
                        <?php
                         }
                        ?>ll -->
                        


                            
                        </div>

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <form id="save_pdf_data" name="save_pdf_data" action="<?php echo base_url(); ?>tasks/update_pdf_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5">          

                                    <input type="hidden" name="pdf_id" id="pdf_id" class="form-control">
                                    <input type="hidden" name="title_pdf" id="title_pdf" class="form-control">
                                    <input type="text" name="alt_title_pdf" id="alt_title_pdf" class="form-control">

                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="submit" class="btn btn-success" value="Save"/>
                                </div>

                            </div>  
                        </form>
                        </div>


                    </div> 

                    <div class="tab-pane" id="pdfins"> 

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <div class="form-group">
                            <label class="col-sm-3 control-label">Insert Image URL</label> 
                                <div class="col-sm-5"> 
                                    <input type="text" id="txt_pdf_url" class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" class="btn btn-success" value="Save" onclick="addPdfUrl()"/>
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
  
<!-- ---------------------------------------------PDF-POP-UP-End----------------------------------------------- -->
<!-- ---------------------------------------------Code-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalCode" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Code</h4>
        </div>
        <div class="modal-body">
          <div > 
            <div class="col-md-12"> 
                <div class="form-group">
                 <input type="hidden" name="txtcode" id="txtcode" value="">
                 <input type="hidden" name="tempvalforcode" id="tempvalforcode" value="">
                  <label for="Paragraph" id="label">Enter Your Code:</label>
                  <textarea class="form-control paragraphclass" rows="5" id="codearea"></textarea>
                </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="setCode()">Apply changes</button>
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Code-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------Save-Template-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="savetemplate" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <h4 class="modal-title">Save Template</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-content">
        <div class="modal-header">
         
          
          <p>You can save the Lecture Layout for later use here.</p>
        </div>
        <div class="modal-body">
          <div > 
            <div class="col-md-12"> 
                <div class="form-group">
                 <input type="hidden" name="txtcode" id="txtcode" value="">
                 <input type="hidden" name="tempvalforcode" id="tempvalforcode" value="">
                  <label for="Paragraph" id="label">Layout Name :</label>
                  <input type="text" id="txt_templates_name" class="form-control">
                </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
         <input type="button" class="btn btn-success" value="Save Template" onclick="saveTemplates()">
         <!-- <input type="button" class="btn btn-default" value="Close Window"> -->
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Save-Template-End----------------------------------------------- -->


<!-- ---------------------------------------------Save-Template-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="loadtemplate" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Load Template</h4>
        </div>
        <div class="modal-body">
          <div > 
            <div class="col-md-12"> 
                
            <ul class="lay-ul">
                <?php 
                if($templatelist)
                {
                foreach ($templatelist as $templatedetails) 
                {
                ?>

                <li class="lay-li" id="li_<?php echo $templatedetails->id; ?>">

                    <b><?php echo $templatedetails->template_title; ?></b>

                    <span class="layout_buttons">
                        <a href="javascript:void(0)" class="btn btn-default" onclick="loadTemplates(<?php echo $templatedetails->id; ?>);">Load</a>
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteTemplates(<?php echo $templatedetails->id; ?>);">Delete</a>
                    </span>

                </li>

                <?php
                }
             }
                else
                {
                    echo"No Templates Available";
                }
                 ?>
                

                <!-- <li class="lay-li">

                    <b>Second Template</b>

                    <span class="layout_buttons">
                        <a href="#" class="btn btn-default">Load</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </span>

                </li>

                <li class="lay-li">

                    <b>Third Template</b>

                    <span class="layout_buttons">
                        <a href="#" class="btn btn-default">Load</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </span>

                </li>

                <li class="lay-li">

                    <b>Forth Template</b>

                    <span class="layout_buttons">
                        <a href="#" class="btn btn-default">Load</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </span>

                </li>

                <li class="lay-li">

                    <b>Fifth Template</b>

                    <span class="layout_buttons">
                        <a href="#" class="btn btn-default">Load</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </span>

                </li> -->

            </ul>

            </div>
          </div>
          
        </div>
        <div class="modal-footer">
        <input type="checkbox" value="1" id="overridechk" onclick="this.checked=true;" name="group1[]" style="float: left;" checked><label class="footer-right-side">Overwrite the content in the Container.</label>
        <br><br>
        <input type="checkbox" value="1" id="appendchk" onclick="this.checked=true;" name="group1[]" style="float: left;"><label class="footer-right-side1">Append below the container content.</label>

         <!-- <input type="button" class="btn btn-success" value="Load"> -->
         <!-- <input type="button" class="btn btn-default" value="Close Window"> -->
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Save-Template-End----------------------------------------------- -->
<!-- ---------------------------------------------audio POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalaudio" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">audios</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 
        

            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="audio_file"> 
                        <a href="#audio-upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li id="audio_library"> 
                        <a href="#audio-medlib" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    
                    
                </ul> 

                <div class="tab-content">
                    <div class="tab-pane active" id="audio-upfil"> 
                    <form id="audioForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label">Upload File</label> 

                            <div class="col-sm-5"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" accept="audio/*" name="file_i" id="file_a"> 
                                    </span>

                                    <div id="progress_audio" class="progressBar">
                                            <div id="bar_audio"><div id="percent_audio"></div ></div>
                                            
                                    </div> 

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                            </div>

                        </div>
                    
                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="audio_div_id" name="audio_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Audio" class="form-control">
                                <input type="submit" id="submitaudio" class="btn btn-success" value="Save"/>
                            </div>

                        </div>
                     </form>
                    </div> 
                    <div class="tab-pane" id="audio-medlib"> 
                        <div class="col-sm-12" id="audio_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="audio_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                        
                        <!-- ll<?php
                        $audiocount =0; 
                        $counter = 0;
                        if($loadAudio)
                        {
                        foreach ($loadAudio as $key => $audiodata) 
                        { 
                            if($counter == 0)
                            {   
                        ?>
                        <div class="row" style="padding: 0 0 10px 0;">
                        <?php } ?>
                        
                            
                            <div class="col-sm-3">                          
                            <img src="" width="125" height="100" alt="<?php echo $audiodata->media_title;?>#_#<?php echo $audiodata->id;?>">                            
                                
                            </div>
                                    
                            <?php
                            $counter =1;
                            if(($key+1) %4 == 0)
                            {
                                
                            ?>                              
                            </div>
                      <?php 
                      $counter = 0;             
                            }
                            $audiocount++;
                        }
                    }
                    else
                    {
                        echo"Audios Not Available";
                    }  
                        ?>
                        
                        <?php 
                        if($audiocount % 4 != 0) 
                        {
                        ?>
                            </div>
                        <?php
                         }
                        ?>ll -->
                                                    
                            
                        </div>

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">
                        <form id="save_audio_data" name="save_audio_data" action="<?php echo base_url(); ?>tasks/update_audio_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5">          

                                    <input type="hidden" name="audio_id" id="audio_id" class="form-control">
                                    <input type="hidden" name="title_audio" id="title_audio" class="form-control">
                                    <input type="text" name="alt_title_audio" id="alt_title_audio" class="form-control">

                                </div>
                            </div>                      


                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="submit"  class="btn btn-success" value="Save" />
                                </div>

                            </div>  
                            </form>
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
<!-- ---------------------------------------------Audio-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------flash-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalflash" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">flash</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 


            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="flash_file"> 
                        <a href="#flash-upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li id="flash_library"> 
                        <a href="#flash-medlib" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    <li> 
                        <a href="#flashins" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Insert flash URL</span> 
                        </a> 
                    </li>
                </ul> 

                <div class="tab-content">
                    <div class="tab-pane active" id="flash-upfil"> 
                    <form id="flashForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label">Upload File</label> 

                            <div class="col-sm-5"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" name="file_i" id="file_f"> 
                                    </span> 

                                    <div id="progress_flash" class="progressBar">
                                            <div id="bar_flash"><div id="percent_flash"></div ></div>
                                            
                                    </div>

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                            </div>

                        </div>

                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="flash_div_id" name="flash_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Flash" class="form-control">
                                <input type="submit" id="submitflash" class="btn btn-success" value="Upload"/>
                            </div>

                        </div>
                    </form>
                    </div> 

                    <div class="tab-pane" id="flash-medlib"> 
                        <div class="col-sm-12" id="flash_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="flash_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                        
                       <!-- ll <?php 
                        $divcount =0;
                        $counter = 0;
                        if($loadflash)
                        {
                        foreach ($loadflash as $key => $flashdata) 
                        { 
                            if($counter == 0)
                            {   
                        ?>
                        <div class="row" style="padding: 0 0 10px 0;">
                        <?php } ?>
                        
                            
                            <div class="col-sm-3">                           
                            <div class="overlay-imf-pdf" alt="<?php echo $flashdata->media_title;?>#_#<?php echo $flashdata->id;?>"></div>                           
                             
                            <img src="" width="125" height="100">
                            </div>
                                    
                            <?php
                            $counter =1;
                            if(($key+1) %4 == 0)
                            {
                                
                            ?>                              
                            </div>
                      <?php 
                      $counter = 0;             
                            }
                            $divcount++;
                        }
                    }
                    else
                    {
                        echo"Documents Not Available";
                    }  

                        ?>
                        <?php 
                        if($divcount % 4 != 0) 
                        {
                        ?>
                            </div>
                        <?php
                         }
                        ?>ll -->
                        


                            
                        </div>

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <form id="save_flash_data" name="save_flash_data" action="<?php echo base_url(); ?>tasks/update_flash_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5">          

                                    <input type="hidden" name="flash_id" id="flash_id" class="form-control">
                                    <input type="hidden" name="title_flash" id="title_flash" class="form-control">
                                    <input type="text" name="alt_title_flash" id="alt_title_flash" class="form-control">

                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="submit" class="btn btn-success" value="Save"/>
                                </div>

                            </div>  
                        </form>
                        </div>


                    </div> 

                    <div class="tab-pane" id="flashins"> 

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <div class="form-group">
                            <label class="col-sm-3 control-label">Insert Image URL</label> 
                                <div class="col-sm-5"> 
                                    <input type="text" id="txt_flash_url" class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" class="btn btn-success" value="Save" onclick="addflashUrl()"/>
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
  
<!-- ---------------------------------------------flash-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------gallery POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalgallery" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">gallery</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 
        

            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="gallery_file"> 
                        <a href="#gallery-upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li> 
                        <a href="#gallery-medlib" id="gallery_library" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    
                    
                </ul> 

                <div class="tab-content">
                    <div class="tab-pane active" id="gallery-upfil"> 
                    <form id="galleryForm" action="<?php echo base_url(); ?>tasks/multi_upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label">Upload File</label> 

                            <div class="col-sm-5"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" accept="images/*" name="file_i[]" id="file_ii" multiple=""> 
                                    </span>

                                    <div id="progress_gallery" class="progressBar">
                                            <div id="bar_gallery"><div id="percent_gallery"></div ></div>
                                            
                                    </div> 

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                            </div>

                        </div>
                    
                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="gallery_div_id" name="gallery_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Image" class="form-control">
                                <input type="submit" id="submitgallery" class="btn btn-success" value="Upload"/>
                            </div>

                        </div>
                     </form>
                    </div> 
                    <div class="tab-pane" id="gallery-medlib"> 
                        <div class="col-sm-12" id="gallery_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="gallery_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                                                
                            
                        </div>

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">
                        <form id="save_gallery_data" name="save_gallery_data" action="<?php echo base_url(); ?>tasks/update_gallery_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5">          

                                    <input type="hidden" name="gallery_id" id="gallery_id" class="form-control">
                                    <input type="hidden" name="title_gallery" id="title_gallery" class="form-control">
                                    <input type="text" name="alt_title_gallery" id="alt_title_gallery" class="form-control">

                                </div>
                            </div>                      

                            <div class="form-group">
                                <!-- <label class="col-sm-1 control-label"><input type="checkbox" value="1" id="gridchk" onclick="this.checked=true;" name="gallerychk[]" ></label> 

                                <div class="col-sm-5"> 
                                Gird 
                                </div> -->

                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label"><input type="checkbox" value="1" id="sliderchk" onclick="this.checked=true;" name="gallerychk[]" checked></label> 

                                <div class="col-sm-5"> 
                               Slider
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" onclick="makeGallery();" class="btn btn-success" value="Add Gallery" />
                                </div>

                            </div>  
                            </form>
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
<!-- ---------------------------------------------gallery-POP-UP-End----------------------------------------------- -->
<script type="text/javascript">

    jQuery('#inform_btn').click(function() {

        jQuery('#inform_txt').toggle();
    });



 jQuery('#OptlecCont').on('click', function() {

  jQuery('#lecCont').toggle();
 });

</script>


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

<!-- tool tip script finish -->


<!-- new code here -->
<!-- jj<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">jj -->
 <!-- jj <script src="//code.jquery.com/jquery-1.10.2.js"></script>jj -->
  <!-- jj<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>jj -->

<!-- ll<script src="<?php echo base_url(); ?>/public/js/jquery-ui/external/jquery/jquery.js" type="text/javascript"></script>  ll -->
  <script src="<?php echo base_url(); ?>/public/js/jquery-ui/jquery-ui.js"></script>
  <link href="<?php echo base_url(); ?>/public/js/jquery-ui/jquery-ui.css" rel="stylesheet">


  <style>
  ul { /*list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px;*/ }
 li { /*margin: 5px; padding: 5px; width: 150px;*/ }
  </style>
<!-- new code end here -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>


<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="<?php echo base_url()?>public/js/lectureseditor/lectureeditor.js"></script>
<script>
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
var $j =jQuery.noConflict();
function lecture_preview()
{       
          var lectureContent = $('.htmlpage').html();

      $j.session.set('preview1', JSON.stringify({contentLecture: lectureContent})); 
        
      var obj = JSON.parse($j.session.get('preview1'))              
            
     window.open('<?php echo base_url(); ?>tasks/lecture_preview/', '_blank');       

}


  


// new code start here

$j(function() {
    
    $j(".htmlpage").sortable({
      revert: true,
      forcePlaceholderSize: true,
       placeholder: "highlight",
       scroll: true,
       scrollSensitivity: 40,
       //scrollSpeed: 40, 
               
    });
    $j(".lyrow").draggable({
      connectToSortable: ".htmlpage",     
      revert: "invalid",
      revertDuration: 70,
      refreshPositions: true,
      cursor: "move",
      handle: ".drag",
      cursorAt: { top: 15, left: 15 },      
      stop: function( event, ui ) {

         $j("#cart2 .column").sortable({    
                revert: true,                
                scroll: true,
                zIndex: 9999,
                scrollSensitivity: 40,
                 scrollSpeed: 40, 
                 stop: function( event, ui ) { console.log('innersort1');},
             });     
            
               $(".htmlpage .view").css("display",'block'); 
            if($('.htmlpage').is('.dragdroplayout'))
            {   

                $('.htmlpage').removeClass('dragdroplayout');
                
            }   

         $j(".htmlpage >.lyrow").removeAttr("style");
            
          var auto_inc_id = 1; 
                $('.htmlpage .lyrow ').each(function(){ 
                    $(this).attr('id', 'lyrow_'+auto_inc_id);                   
                    auto_inc_id++;              
                }); 

            var idforremove = 1; 
                $('.htmlpage .lyrow .remove').each(function(){ 
                    $(this).attr('id', 'remove_'+idforremove);                 
                    idforremove++;              
                }); 

            var idfordrag = 1; 
                $('.htmlpage .lyrow .drag').each(function(){ 
                    $(this).attr('id', 'drag_'+idfordrag);                 
                    idfordrag++;                
                });

            var idforclone = 1; 
            $('.htmlpage .lyrow .clone').each(function(){ 
                $(this).attr('id', 'clone_'+idforclone);                
                idforclone++;               
            });

      },      
      opacity: 0.0,
      helper:'clone',
      
    });
   
    $j( "#cart2 ol" ).disableSelection();
  });


$j(function() {
    $j(".htmlpage .lyrow .column").sortable({   
      revert: true,
      zIndex: 9999,
      scroll: true,
      scrollSensitivity: 40,     
    });
    $j(".box").draggable({
      connectToSortable: ".htmlpage .lyrow .column",      
      revert: "invalid",      
       refreshPositions: true,
      cursor: "move",
      cursorAt: { top: 5, left: 5 },
      revertDuration: 70,
      
      stop: function( event, ui ) {
        $(".htmlpage .lyrow .column .view .mock").attr("style",'');
          $(".htmlpage .lyrow .column .view p").css("display",'block'); 
           
        againLoad();
        
        if($('.htmlpage .lyrow .column').is('.dragelement'))
            {
                $('.htmlpage .lyrow .column').removeClass('dragelement');
                
            }

        var idforremove = 1; 
                $('.htmlpage .lyrow .column .remove').each(function(){ 
                    $(this).attr('id', 'removeinner_'+idforremove);                     
                    idforremove++;              
                }); 

            var idfordrag = 1; 
                $('.htmlpage .lyrow .drag').each(function(){ 
                    $(this).attr('id', 'drag_'+idfordrag);                  
                    idfordrag++;                
                });

                var idforsetting = 1; 
                $('.htmlpage .lyrow .settings').each(function(){ 
                    $(this).attr('id', 'settings_'+idforsetting);                  
                    idforsetting++;                 
                });

                var idforclone = 1; 
            $('.htmlpage .lyrow .column .clone').each(function(){ 
                $(this).attr('id', 'innerclone_'+idforclone); 

                $(this).parent().attr('id', 'box_'+idforclone);
                
                idforclone++;               
            });

                var idforcolumn = 1; 
                $('.htmlpage .lyrow .column').each(function(){ 
                    $(this).attr('id', 'column_'+idforcolumn);                 
                    idforcolumn++;              
                });

                var idforview = 1; 
                $('.htmlpage .lyrow .column .view').each(function(){ 
                    $(this).attr('id', 'view_'+idforview);
                    if($('#view_'+idforview).children().is("a")==true)
                    {
                        $('.htmlpage .lyrow .column .view a').attr('id', 'a_'+idforview);
                    }                  
                    idforview++;                
                });

                // var idforbox = 1; 
                // $('.htmlpage .lyrow .column .box').each(function(){ 
                //     $(this).attr('id', 'box_'+idforbox);
                //     alert(idforbox);                
                //     idforbox++;              
                // });

                
                $('.htmlpage .lyrow .column .view a').each(function(){ 

                    var str = $(this).parent().attr('id');
                    
                    if(typeof str !="undefined")
                    {
                        
                         var str_array = str.split('_');
                    
                       $(this).attr('id', 'a_'+str_array[1]);  
                    }
                                    
                           
                }); 


        
      },      
      helper:'clone'
    });
    $j( "ul, li" ).disableSelection();
  });
//new code end here
//new code for third strat

function againLoad()
{
    $j(".htmlpage .lyrow .column").sortable({   
          revert: true,
          //revert: "invalid",
          zIndex: 9999,
          scroll: true,
          scrollSensitivity: 40, 
          scrollSpeed: 40, 
          placeholder: "highlight2",                
         start: function( event, ui ) 
         {
           
           console.log($(ui.item[0].children[6]).attr('id'));
           
            var elementId = $(ui.item[0].children[6]).attr('id');
                parentelemrnt = $("#"+elementId).parent();
                parentelemrnt.addClass('dragboxhide');

                $("#"+elementId+" :first").addClass('sizeforview');
                $("#"+elementId).addClass('sizeforview');

                parentelemrnt.find(".remove").addClass('draghide');
                parentelemrnt.find(".drag").addClass('draghide');
                parentelemrnt.find(".clone").addClass('draghide');
                parentelemrnt.find(".configuration").addClass('draghide');
                parentelemrnt.find(".settings").addClass('draghide');
                parentelemrnt.find("select").addClass('draghide');
                parentelemrnt.find(".view").addClass('draghide');                
                

                parentelemrnt.find(".preview").addClass('dragshow');
         },
          stop: function( event, ui )
         {

            console.log($(ui.item[0].children[6]).attr('id'));
           
            var elementId = $(ui.item[0].children[6]).attr('id');
                parentelemrnt = $("#"+elementId).parent();
                parentelemrnt.removeClass('dragboxhide');

                $("#"+elementId+" :first").removeClass('sizeforview');
                 $("#"+elementId).removeClass('sizeforview');

                parentelemrnt.find(".remove").removeClass('draghide');
                parentelemrnt.find(".drag").removeClass('draghide');
                parentelemrnt.find(".clone").removeClass('draghide');
                parentelemrnt.find(".configuration").removeClass('draghide');
                parentelemrnt.find(".settings").removeClass('draghide');
                parentelemrnt.find("select").removeClass('draghide');
                parentelemrnt.find(".view").removeClass('draghide');
                 
                 //$("#"+elementId).css('height','');
                parentelemrnt.find(".preview").removeClass('dragshow');
         },
        });
        $j(".view .box-element").draggable({
          connectToSortable: ".htmlpage .lyrow .column",      
          revert: "invalid",
          //handle: ".drag",    
          //handle: ".preview",      
          scroll: true,

          stop: function( event, ui ) {

            $j(".box-element").css("position","");
            $j(".box-element").css("width","");
            $j(".box-element").css("height","");

            if($('.htmlpage .lyrow .column').is('.dragelement'))
            {
                $('.htmlpage .lyrow .column').removeClass('dragelement');
                
            }
            autoAssignID();
            againLoad();
            
          },      
          //helper:'clone'
        });
}

//new code for third end

//======================  load templates strat here ==================================
 function loadTemplates(id)
{
    
    var chk1 = document.getElementById("overridechk").checked;
    var chk2 = document.getElementById("appendchk").checked;

    $.ajax({
            cache: false,
            type: "POST",
            url: base_url+"/tasks/getTemplates",
            data: {id:id}, 
            success: function(data)
            {            
                //alert(data);
                if(chk1 == true)
                {
                 $(".htmlpage").html(data);
                 $("#loadtemplate").modal('hide');

                 if($('.htmlpage').is('.dragdroplayout'))
                    {
                        $('.htmlpage').removeClass('dragdroplayout');
                        
                    }
                }
                else if(chk2 == true)
                {
                   $(".htmlpage").append(data);
                   $("#loadtemplate").modal('hide');
                   autoGenarateId();
                }

                $j("#cart2 .column").sortable({     
                revert: true,
                zIndex: 9999,
                scroll: true,
                scrollSensitivity: 400,
                //scrollSpeed: 40,
               stop: function( event, ui ) { console.log('inneragainsort1');},
             }); 
                
            }
          });
}

//======================  load templates strat here ==================================


function removeele(id)
 {
     var str = id;
    var str_array = str.split('_');
    
    if(str_array[0] =="remove")
    {      

        $j.confirm({
            title: 'Do you really want to Remove ?',
            content: ' ',
            confirm: function(){ 
                        $('#'+id).parent().remove();
       
                             },
            cancel: function(){        
                         return true;
                              }
                             });


    }

    if(str_array[0] =="removeinner")
    {   
        
        $j.confirm({
            title: 'Do you really want to Remove ?',
            content: ' ',
            confirm: function(){ 
                        $('#'+id).parent().remove();
       
                             },
            cancel: function(){        
                         return true;
                              }
                             });
    }
 }



function saveTemplates()
    {  
    var txt_templates_name =$("#txt_templates_name").val();
    var txt_templates_containt =$(".htmlpage").html();
    if(txt_templates_name.trim()!="" && txt_templates_containt.trim()!="")
    {
    $.ajax({
            cache: false,
            type: "POST",
            url: base_url+"/tasks/saveTemplate",
            data: {txt_templates_name:txt_templates_name,txt_templates_containt:txt_templates_containt}, 
            success: function(data)
            {
            
                
                $("#txt_templates_name").val('');
                $("#savetemplate").modal('hide');

                $j.alert({
                 title: 'successful',
               content: '<p style="text-align: center;font-weight: 800;font-size: 20px;">Template Saved Successfully</p>',
                confirm: function()
                          {
                          return true;
               
                           }
                       });
            }
          });
     }
     else
     {
        //alert('Please Enter valid Field');

                $j.alert({
                 title: 'Sorry!',
               content: 'Please Enter valid Field.',
                confirm: function()
                          {
                          return true;
               
                           }
                       });


     } 
 }



function save_lecture()
{
    var seg3 ="<?php echo $this->uri->segment(3) ?>";
    var seg4 ="<?php echo $this->uri->segment(4) ?>";

    var contenthtml = $(".htmlpage").html();
    $("#content_lecture").val(contenthtml);
    var nm = $("#name").val();              
       var difflevel = $("#difficultylevel").val();
       if(nm.trim()!= "" && difflevel !="")
       {

    jQuery.ajax({
        cache: false,
        type: "POST",
        url: " <?php echo base_url()?>tasks/save_lecture/"+seg3+"/"+seg4,//<?php echo base_url('tasks/save_lecture/')?>",
        data: jQuery("#frm_save_lecture").serialize(),
       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
        success: function(msg)
        {    
            if(msg)
            {
                $j.alert({
                  title: 'Lecture Saved Successfully',
               content: '  ',
                confirm: function()
                          {
                            $('.error').remove();
                          return true;
               
                           }
                       });

                var editbtn ='<input type="button" id="lecture_save" name="lecture_save" class="btn btn-success" value="Edit" onclick="edit_lecture('+msg+');" >';
                $('#lecture_save').replaceWith(editbtn);
            } 
            
        }
    });
    }
  else
  {
    $('.error').remove();
    $j.alert({
                 title: 'Required',
               content: 'Field Must Required',
                confirm: function()
                          {

                            if(nm.trim() =="")
                            {
                                $("#name").after('<span class="error">Lecture Name Required</span>');
                                //$("#difficultylevel").val();
                            }

                            if(difflevel =="")
                            {
                                $("#difficultylevel").after('<span class="error">Level Required</span>');
                            }

                            
                          return true;
               
                           }
                       });

  }

}

function edit_lecture(l_id)
{
    var s_id ="<?php echo $this->uri->segment(3) ?>";
    var p_id ="<?php echo $this->uri->segment(4) ?>";

    var contenthtml = $(".htmlpage").html();
    $("#content_lecture").val(contenthtml);

        var nm = $("#name").val();              
       var difflevel = $("#difficultylevel").val();
       if(nm.trim()!= "" && difflevel !="")
       {
    jQuery.ajax({
        cache: false,
        type: "POST",
        url: " <?php echo base_url()?>tasks/edit_lecture/"+l_id+"/"+s_id+"/"+p_id,//<?php echo base_url('tasks/save_lecture/')?>",
        data: jQuery("#frm_save_lecture").serialize(),
       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
        success: function(msg)
        {    
            if(msg)
            {
                $j.alert({
                 title: 'Lecture Edited Successfully',
               content: '  ',
                confirm: function()
                          {
                            $('.error').remove();
                          return true;
               
                           }
                       });

            } 
            
        }
    });
  }
  else
  {
    $('.error').remove();
    $j.alert({
                 title: 'Required',
               content: 'Field Must Required',
                confirm: function()
                          {

                            if(nm.trim() =="")
                            {
                                $("#name").after('<span class="error">Lecture Name Required</span>');
                                //$("#difficultylevel").val();
                            }

                            if(difflevel =="")
                            {
                                $("#difficultylevel").after('<span class="error">Level Required</span>');
                            }

                            
                          return true;
               
                           }
                       });
  }

}

function deleteTemplates(id)
     {
        $j.confirm({
            title: 'Do you really want to Remove ?',
            content: ' ',
            confirm: function(){                         

                        $.ajax({
                            cache: false,
                            type: "POST",
                            url: base_url+"/tasks/deleteTemplates",
                            data: {id:id}, 
                            success: function(data)
                            {            
                             
                             $('#li_'+id).remove();   
                                
                            }
                          });

       
                             },
            cancel: function(){        
                         return true;
                              }
                             });
     }


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
            $j('.bxslider1').bxSlider({                   
                      auto: true,
                      autoControls: true
                    });
            $('#myModalgallery').modal("hide");

   
 //     str+='<li><img src="http://create-online-academy.com/public/uploads/images/1465479926-4996-2016-06-09.jpg" id="4"></li>';
 //   str+='<li><img src="http://create-online-academy.com/public/uploads/images/1465479926-1963-2016-06-09.jpg" id="5"></li>';
 //   str+='<li><img src="http://create-online-academy.com/public/uploads/images/1465479926-1327-2016-06-09.gif" id="6"></li>';
 //   str+='<li><img src="http://create-online-academy.com/public/uploads/images/1465479926-1148-2016-06-09.jpg" id="7"></li>';
 //   str+='<li><img src="http://create-online-academy.com/public/uploads/images/1465551960-3604-2016-06-10.jpg" id="15"></li>';
 // str+='</ul>';

 //    $("#loaddiv").html(str);    
 //    $j('.bxslider1').bxSlider();
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
           });

</script>

<script type="text/javascript">


    jQuery(document).ready(function() 
    {

        //jQuery('#codearea').redactor();
    jQuery('#codearea').redactor({
   // pasteCallback: function(html) {
        //  html = html.replace("<font>", ""); // Fix Word to IE
        //  html = html.replace("</font>", ""); // Fix Word to IE
        //  return html;
        // alert('yes');
    //},
});
    jQuery('#myModalCode').find(".re-html").trigger( "click" );
    jQuery('#myModalCode').find(".re-html").remove();

    // jQuery('#paragraph').redactor({
    //             pasteCallback: function(html) {
    //               console.log(html);
    //           } 
    //         });
});
</script>

<script type="text/javascript">

 function sticky_relocate1() {
    var window_top = jQuery(window).scrollTop();
    var div_top = jQuery('#sticky-anchor1').offset().top;
    if (window_top > div_top) {
        jQuery('#sidebar').addClass('stick');
    } else {
        jQuery('#sidebar').removeClass('stick');
    }
}

jQuery(function () {
    jQuery(window).scroll(sticky_relocate1);
    sticky_relocate1();
});


// jQuery(document).ready(function() {
//     var s = jQuery("#sidebar");
//     var pos = s.offset().top;  

//     jQuery(window).scroll(function() {
//         var windowpos = jQuery(window).scrollTop() ;

//         if(windowpos + jQuery(window).height() == jQuery(document).height()){
//             s.removeClass('stick');
//         }else if(windowpos >= pos){
//             s.addClass('stick');
//         }else{
//             s.removeClass('stick');
//         }
//     });
// });   
</script>

<!-- jj<script src='//cdn.tinymce.com/4/tinymce.min.js'></script> -->
<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#paragraph',
  height: 180,
 // min_width: 400,
  menu: {    
    edit: {title: 'Edit', items: 'undo redo | cut copy pastetext | selectall'},    
    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
   
  },
  theme: 'modern',
  plugins: [
    'advlist autolink lists print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime nonbreaking save table contextmenu directionality',
    'paste textcolor colorpicker textpattern link image imagetools'
  ],
  //menubar: 'file edit insert view format table',
  menubar: 'edit table font',
  toolbar1: 'undo redo | bold italic underline | alignleft aligncenter | alignright alignjustify | bullist numlist | outdent indent | forecolor backcolor | fontselect fontsizeselect | styleselect | link image | preview fullscreen',
  //toolbar2: 'print preview | forecolor backcolor',
  //toolbar2:'fontselect fontsizeselect | styleselect',
  image_advtab: true,
  paste_as_text: true,  
  // templates: [
  //   { title: 'Test template 1', content: 'Test 1' },
  //   { title: 'Test template 2', content: 'Test 2' }
  // ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
   });
  </script>
