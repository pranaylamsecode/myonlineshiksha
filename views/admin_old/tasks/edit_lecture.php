<base href="<?php echo $this->config->item('base_url') ?>/public/" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 

<script type="text/javascript">
  BASE_URL = "<?php echo base_url();?>"
</script>
<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/plupload/application.js"></script>
 <link rel="stylesheet" href="<?php echo base_url() ?>public/js/plyr-io/plyr.css?v=2"> 

    <!-- Preload -->
    <link rel="preload" as="font"  type="font/woff2" href="<?php echo base_url() ?>public/js/plyr-io/gordita-medium.woff2">
    <link rel="preload" as="font"  type="font/woff2" href="<?php echo base_url() ?>public/js/plyr-io/gordita-bold.woff2">
   <script async src="<?php echo base_url() ?>public/js/plyr-io/plyr.js"></script>
   
 --><script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
<!-- <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script>  -->
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/theme_admin.css" type="text/css" media="screen" />

<style>
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

<div class="main-container">
<?php



  $attributes = array('class' => 'tform', 'id' => 'frm_edit_lecture');

echo form_open(base_url().'admin/tasks/save_lecture', $attributes);


//echo ($updType == 'create') ? form_open(base_url().'admin/tasks/create', $attributes) : form_open(base_url().'admin/tasks/edit/'.$task->tid.'/'.$did.'/'.$pid, $attributes);



?>



<style>

</style>



<div id="toolbar-box">



  <div class="m top_main_content">



    <div id="toolbar" class="toolbar-list">


      <div id="sticky-anchor"></div>
      <ul id="sticky" class="main-content-btn" style="list-style: none; float: right;">

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

        <!-- <a id="preview_btn" onclick="lecture_preview();" class="btn btn-success btn-blue" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Lecture Preview</a> -->
        <a id="preview_btn" onclick="openmyModalpreview(this.id);" class="btn btn-success btn-blue" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Lecture Preview</a>
        </li>



                <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



          <!-- <a>



          <?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'  ") ); ?>



          </a> -->

      <a><input type="button" id='lecture_save' name="lecture_save" class='btn btn-success btn-green' value="Save" onclick="edit_lecture();" ></a> 

          </li>



          <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



          <a href='<?php echo base_url(); ?>admin/section-management/<?php echo $pid?>' class='btn btn-danger btn-dark-grey' id="forward"><span class="icon-32-cancel"> </span>Close</a>



          </li>



      </ul>



      <div class="clr"></div>



    </div>



<div class="pagetitle"><h2><?php echo ($updType == 'create') ? "Create Lecture" : "Edit Lecture";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2></div>



  </div>


  <div id="inform_txt">
    <textarea style="width: 29%; height: 81px; margin-left: 731px;" name="inform_msg" id="inform_msg"  placeholder="Enter information about modification and Click on Save button."   class="form-control"></textarea>
    <a class="btn btn-orange" title="Inform about this change made in lecture to all the enrolled students of this course." style="margin-left: 850px;" onclick="saveAndInform();">Save and Inform</a>
  </div>



</div>



<div>
<br />


</div>




<div class="row">
<div class="col-md-6" style="width: 100%;">
  <ul class="nav nav-tabs bordered grey-border blue-border">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active"> 
    <a href="#Lecture" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-home"></i></span> 
    <span class="hidden-xs">Lecture Detail</span> 
    </a> 
    </li>
    <li> 
    <a href="#Meta" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-user"></i></span> 
    <span class="hidden-xs">Publish Lecture</span> 
    </a>  
    </li>
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
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
                        <legend style="border:none;"></legend>
            
      
            <div class="col-sm-12 form-group">
            <div class="col-sm-6 no-padding">
              <label class='col-sm-12 no-left-padding control-label field-title' for="Lesson"><?php echo 'Lecture Name:'//echo lang('web_name')?> <span class="required">*</span></label>
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
                Lecture Type 
              </label>
              <div class="col-sm-12 no-left-padding">
                <select id="lecture_type" name="lecture_type" class="form-control form-height"  size="1" >
                <option value="video_article" <?php echo preset_select('lecture_type', 'video_article', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Video and Article</option>

                <option value="article" <?php echo preset_select('lecture_type', 'article', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Article</option>

                <option value="video" <?php echo preset_select('lecture_type', 'video', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Video</option>

                <option value="pdf" <?php echo preset_select('lecture_type', 'pdf', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Pdf</option>

                <option value="demo" <?php echo preset_select('lecture_type', 'demo', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Demo-Lecture</option>

               <!--  <option value="exam" <?php echo preset_select('lecture_type', 'exam', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Exam</option> -->
                </select>
              </div>
           </div>
           <div class="col-sm-3 no-padding">
             <label class='col-sm-12 control-label field-title' style="padding-left:0;" for="Lesson">
             Lecture Duration
             </label>
             <div class="col-sm-12 no-left-padding">

                <input id="lecture_duration" class="form-control form-height" type="text" name="lecture_duration" placeholder="ex.1:00 Hrs" value="<?php echo set_value('lecture_duration', (isset($task->lecture_duration)) ? $task->lecture_duration : ''); ?>" />
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

          </fieldset>
          
        </div>
        
        <hr />
        <!-- new code start form here -->

        <!-- third  strat-->
<div class="" style="margin-bottom:40px"> 
  <div class="row">
          <div class="col-sm-2">
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
        <div id="cart2">   
           <div class="htmlpage ui-sortable dragdroplayout"  style="min-height: 625px;">            
           <?php echo $task->lecture_content; ?>
           </div> 
    </div>
      </div>
  </div>
</div>

<!-- third  end-->

        <!-- new code end here -->
      </dd>
      <div style="clear:both;"></div>
    </div>



    
    
    <div class="tab-pane" id="Meta">
      <dd class="" sno="3">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
                        <legend style="border:none;"><p style="margin-top: -19px;margin-right: 82px;">The Information that you provide in meta tag is used by search engine to index a page so that someone search for the kind of information the page contains able to find it.</p></legend>
             
            <div class="form-group form-border" style="margin:0;padding-top: 0;">
             <div class="col-sm-12 no-padding">
              <!-- <label class="col-sm-12 no-padding"> </label> -->
              <div class="grey-background" style="display: -webkit-box;">
                 
                 <div class="col-sm-1 no-padding" style="width:3%;">               
               <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? 'checked="checked"' : (isset($task->published) && $task->published == '1') ? 'checked="checked"' : ''?> <?php echo $updType == 'create' ? 'checked="checked"':''; ?>/>
              </div>
               <label class='col-sm-11 no-padding control-label dark_label' for='active'>Activate <?//=lang('web_is_active')?> </label>



<!-- tooltip area -->

            <!-- <span class="tooltipcontainer">

            <span type="text" id="published-target" class="tooltipicon"></span>

            <span class="published-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            

            <?php echo lang('lecture_fld_published');?>

                       

            </span>

            </span>
 -->
<!-- tooltip area finish -->

                <?php echo form_error('published'); ?>
               </div>
            </div>
            </div>

            <div class="form-group form-border">
            
              <label class='col-sm-12 control-label field-title'>Keywords :
                <p>(Put relevant keyword to make your lecture searchable in your Online Academy)</p>
              </label>
              
              <div class="col-sm-12">
                  <input type="text" value="" maxlength="255" size="40" name="metatitle" class="form-control form-height">
                <!-- <span class="tooltipcontainer"> <span type="text" id="metatitle-target" class="tooltipicon" title="Click Here"></span> <span class="metatitle-target  tooltargetdiv" style="display: none;"> <span class="closetooltip"></span>  -->
                
                <!--tip containt--> 
                <!-- 
                Seconds </span> </span> </div>
                &nbsp &nbsp&nbsp <span class="ptext"></span> -->
            </div>
            </div>

            <div class="form-group form-border">

              <label class='col-sm-12 control-label field-title' for="Title"><?php echo 'Title:'//echo lang('web_name')?>
                <p>(This Title showup in the Search Engine Result Page)</p>
              </label>
              
              
              <div class="col-sm-12">
                <input id="title" type="text" name="title" class='form-control form-height' maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : ((isset($task->metatitle)) ? $task->metatitle : ''); ?>"  />



<!-- tooltip area -->

            <!-- <span class="tooltipcontainer">

            <span type="text" id="meta_title-target" class="tooltipicon"></span>

            <span class="meta_title-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>


            <?php echo lang('lecture_fld_meta-title');?>

                        

            </span>

            </span> -->

<!-- tooltip area finish -->

            </div>
           <!--  &nbsp &nbsp <p class="ptext"> </p> -->
            </div>
            
            <div class="form-group form-border">

              <label class='col-sm-12 control-label field-title' for="key_description"><?php echo 'Keywords:'//echo lang('web_name')?>
                <p>(Those are the Keywords that you expect people to search in a search engine to land in your lecture page.)</p>
              </label>
              
              <div class="col-sm-12">
              
                                    <?php //$this->ckeditor->editor("key_description",($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''));?>


                                  <textarea id="key_description" class="form-control select-box-border"  name="key_description"  /><?php echo ($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''); ?></textarea>


<!-- tooltip area -->

            <!-- <span class="tooltipcontainer">

            <span type="text" id="meta_desc-target" class="tooltipicon"></span>

            <span class="meta_desc-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            

            <?php echo lang('lecture_fld_meta-desc');?>

                         

            </span>

            </span>
 -->
<!-- tooltip area finish -->

                                
              <!-- </div> 
              &nbsp &nbsp <p class="ptext"> </p>   -->
       </div>
             
             </div>

             <div class="form-group form-border">

              <label class='col-sm-12 control-label field-title' for="description"><?php echo 'Description:'//echo lang('web_name')?>
                <p>(The purpose of the meta description tag is to provide a brief and concise summary of your lectures content in the search engine result page.)</p>
              </label>
              
              <div class="col-sm-12">
           <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''));?>



                                        <textarea id="description"  class='form-control select-box-border' name="description"  /><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''); ?></textarea>





<!-- tooltip area -->

            <!-- <span class="tooltipcontainer">

            <span type="text" id="meta_keyword-target" class="tooltipicon"></span>

            <span class="meta_keyword-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            

            <?php echo lang('lecture_fld_meta-keyword');?>

            

            </span>

            </span> -->

<!-- tooltip area finish -->

                                
              </div> 
              <!--  &nbsp &nbsp <p class="ptext"></p>   -->
       </div>
             
          </fieldset>
          </div>
        </div>
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

<link rel="stylesheet" href="<?php echo base_url(); ?>/public/colorbox-master/example1/colorbox.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

 <link href="<?php echo base_url();?>public/assets/css/video-js.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>public/assets/css/video-js.js"></script>
    <script src="<?php echo base_url(); ?>/public/colorbox-master/jquery.colorbox.js"></script>
    <script>
      $(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements
        
        //$(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});        
        
      });
    </script>

    <script>
function lecture_preview2()
{   
       var txt_content_val = $("#txt_content_val").val();         
       var lec_content = $("#lec_content").val();
       var lec_content1 = $("#lec_content1").val();

       alert(lec_content);

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
    //    $.ajax({
      // type: "POST",
      // url: "<?php echo base_url(); ?>admin/tasks/set_lecture_preview",
      // data: {first_media:first_media,second_media:second_media,txt_content:txt_content,txt_content_val:txt_content_val,lec_content:lec_content,lec_content1:lec_content1}, 
      // success: function(data)
      // {
      
      //  alert(data);
        
      //  window.open('<?php echo base_url(); ?>admin/tasks/lecture_preview', '_blank');
      // }
     //  }); 
       

}
</script>


<!-- new code end here -->
<script src="<?php echo base_url(); ?>/public/js/jquery-ui/external/jquery/jquery.js" type="text/javascript"></script>  
  <script src="<?php echo base_url(); ?>/public/js/jquery-ui/jquery-ui.js"></script>
  <link href="<?php echo base_url(); ?>/public/js/jquery-ui/jquery-ui.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>


<!-- ll<script src="http://malsup.github.com/jquery.form.js"></script>ll -->
 <script src="<?php echo base_url(); ?>/public/js/form-master/jquery.form.js"></script>
<script src="<?php echo base_url()?>public/js/lectureseditor/lecturedragndrop_admin.js"></script>
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



<script>
// function edit_lecture()
// {
//  var seg3 ="<?php echo $this->uri->segment(3) ?>";
//  var seg4 ="<?php echo $this->uri->segment(4) ?>";
//  var seg5 ="<?php echo $this->uri->segment(5) ?>";
//  var contenthtml = $(".htmlpage").html();
//  $("#content_lecture").val(contenthtml);

//     jQuery.ajax({

//         type: "POST",
//         url: " <?php echo base_url()?>tasks/edit_lecture/"+seg3+"/"+seg4+"/"+seg5,
//         data: jQuery("#frm_edit_lecture").serialize(),
//        //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
//         success: function(msg)
//         {    
//             if(msg)
//             {
//              alert('lecture Save');
//             } 
            
//         }
//     });
// }
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


<script type="text/javascript">
  $(document).ready(function() 
  {
  //$('.sidebar-collapse').find('a').click();
  
  $('div.sidebar-collapse').remove();
  $('.page-container').addClass('sidebar-collapsed');
  
    });
</script>

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

// $(document).ready(function() {
//     var s = $("#sidebar");
//     var pos = s.offset().top;  

//     $(window).scroll(function() {
//         var windowpos = $(window).scrollTop() ;

//         if(windowpos + $(window).height() == $(document).height()){
//             s.removeClass('stick');
//         }else if(windowpos >= pos){
//             s.addClass('stick');
//         }else{
//             s.removeClass('stick');
//         }
//     });
// });   
</script>

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
  var l_id ="<?php echo $this->uri->segment(4) ?>";
  var s_id ="<?php echo $this->uri->segment(5) ?>";
  var p_id ="<?php echo $this->uri->segment(6) ?>";

  // var contenthtml = $(".htmlpage").html();
  // $("#content_lecture").val(contenthtml);
  var divdata = $('.htmlpage').html();                   
  var divdata1 = $('#content_demo').html(divdata);

  // var len = $(document).find('.htmlpage').find('.video-js').length;
  //                          len++; 
   var len = $('#content_demo').find('.plyr--video').length;
   var i = 0;
  

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
       

    var contenthtml2 = $("#content_demo").html();  
  $("#content_lecture").val(contenthtml2);

    var nm = $("#name").val();            
       var difflevel = "medium";//$("#difficultylevel").val();
       if(nm.trim()!= "" && difflevel !="")
       {
    jQuery.ajax({
      cache: false,
        type: "POST",
        url: " <?php echo base_url()?>admin/tasks/edit_lecture/"+l_id+"/"+s_id+"/"+p_id,//<?php echo base_url('tasks/save_lecture/')?>",
        data: jQuery("#frm_edit_lecture").serialize(),
       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
        success: function(msg)
        {    
            if(msg)
            {
              $.alert({
             title: 'successful',
               content: 'Lecture successful Edit',
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
    $.alert({
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


  
//  $(document).on('click', '.video-js' function(){
//  vidPlay();
// });
//     $(document).on('click', '.vjs-tech' function(){
//  vidPlay();
// });
//   function vidPlay(){
//     $(document).find(".video-js").each(function (videoIndex) {
//     var videoId = $(this).attr('id');

//     videojs(videoId).ready(function(){
//         this.on("play", function(e) {
//             //pause other video
//             $(".video-js").each(function (index) {
//                 if (videoIndex !== index) {
//                     this.player.pause();
//                 }
//             });
//         });

//     });
// });
//   }

// $('#myModalLectpreview').find('.close').click( function(){ 

//  });

 

$("#preview_btn").click(function(){
   $("#sticky").css("display","none");
});


jQuery(document).ready(function() {
    // jQuery(document).find(".plyr__video-embed").each(function () {
// 
  jQuery(document).find(".playerio").each(function () {
    var vid = jQuery(this).attr('id');
    const player = new Plyr('#'+vid);
  });
   jQuery(document).find(".plyr__video-embed").each(function () {
    var vid = jQuery(this).attr('id');
    const player = new Plyr('#'+vid);
  });
  jQuery(document).find('.plyr').addClass('edit-vjs');
});


function checkContainer () {
       const players = [];

 jQuery('#preview_container').find(".vplyr").each(function (videoIndex) { 
 //     j++;

   var str = jQuery(this).attr('id');
   console.log(str);
   // var chkele = jQuery.inArray( str, players );
   // if(chkele==true){

   // }else{
     // str = new Plyr('#'+str);
       str = Plyr.setup('#'+str);
     players.push(str);
   // }
 });
  

}

jQuery(document).ready(function(){
  // jQuery(document).find('.vjs-play-control.vjs-control.vjs-button').css('display','none');
    jQuery(document).find('.video-js').addClass('edit-vjs');
});
</script>

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


  <script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>

 //    jQuery(document).ready(function() 
 //    {
 //      tinymce.init({
 //  selector: '#paragraph',
 //  height: 180,
 // // min_width: 400,
 //  menu: {    
 //    edit: {title: 'Edit', items: 'undo redo | cut copy pastetext | selectall'},    
 //    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
   
 //  },
 //  theme: 'modern',
 //  plugins: [
 //    'advlist autolink lists print preview hr anchor pagebreak',
 //    'searchreplace wordcount visualblocks visualchars code fullscreen',
 //    'insertdatetime nonbreaking save table contextmenu directionality',
 //    'paste textcolor colorpicker textpattern link image imagetools'
 //  ],
 //  //menubar: 'file edit insert view format table',
 //  menubar: 'edit table font',
 //  toolbar1: 'undo redo | bold italic underline | alignleft aligncenter | alignright alignjustify | bullist numlist | outdent indent | forecolor backcolor | fontselect fontsizeselect | styleselect | link image | preview fullscreen',
 //  //toolbar2: 'print preview | forecolor backcolor',
 //  //toolbar2:'fontselect fontsizeselect | styleselect',
 //  image_advtab: true,
 //  paste_as_text: true,  
 //  // templates: [
 //  //   { title: 'Test template 1', content: 'Test 1' },
 //  //   { title: 'Test template 2', content: 'Test 2' }
 //  // ],
 //  content_css: [
 //    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
 //    '//www.tinymce.com/css/codepen.min.css'
 //  ]
 // });
 //   });
  </script>
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
