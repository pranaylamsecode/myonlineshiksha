<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css"> 

<script type="text/javascript">
  BASE_URL = "<?php echo base_url();?>";
</script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.css"> 


<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/theme_admin.css" type="text/css" media="screen" />

<style>

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

#examinfo {
  display: inline-block;
  width: 100%;
  padding: 0px 0px 10px 0px;
}
#examinfo span {
  padding: 0px;
  color: #454545;
  font-size: 15px;
  text-transform: capitalize;
  margin-top: 20px
}
#examinfo span a{
  background: #00adef;
  color: #fff;
  font-size: 14px;
  border: 0px;
  margin-left: 10px;
  padding: 7px 15px;
  margin-right: 0px;
}
#examinfo span:last-child {
  float: right;
  text-align: right;
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

/*.element-view-content img{
  width: auto !important;
}*/
/*end of css*/
</style>



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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() 
  {
  //$('.sidebar-collapse').find('a').click();
  
  $('div.sidebar-collapse').remove();
  $('.page-container').addClass('sidebar-collapsed');
  
    });
</script>

 <script type="text/javascript">
 jQuery(function(){
   jQuery("#forward").click(function() {
   window.parent.location.href = "<?php echo base_url(); ?>admin/days/<?php echo $pid?>";

    });

      });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url()?>public/js/lectureseditor/lecturedragndrop_admin.js"></script>

<div class="main-container">
<?php

if($updType == 'edit')
{
  $attributes = array('class' => 'tform', 'id' => 'frm_save_quiz');
}
else
{
  $attributes = array('class' => 'tform', 'id' => 'frm_save_quiz');
}



echo ($updType == 'create') ? form_open(base_url().'admin/tasks/create', $attributes) : form_open(base_url().'admin/tasks/edit/'.$task->id.'/'.$did.'/'.$pid, $attributes);



?>



<style>

</style>


<?php $CI = &get_instance();
$CI->load->model('medias_model');
$CI->load->model('admin/exam_model');
 ?>
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

  
        </li>



                <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



          <!-- <a>



          <?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'  ") ); ?>



          </a> -->

      <a><input type="button" id='lecture_save' name="lecture_save" class='btn btn-success btn-green' value="Update" onclick="editExam()" ></a> 

          </li>



          <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



          <a href='<?php echo base_url(); ?>admin/section-management/<?php echo $pid?>' class='btn btn-danger btn-dark-grey' id="forward"><span class="icon-32-cancel"> </span>Close</a>



          </li>



      </ul>


      <div class="clr"></div>



    </div>



<div class="pagetitle"><h2><?php echo ($updType == 'create') ? "Create Quiz" : "Edit Quiz";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2></div>

      <span id="message"></span>


  </div>


</div>



<div>
<br />


</div>




<div class="row">
<div class="col-md-6" style="width: 100%;">
  <ul class="nav nav-tabs bordered grey-border blue-border">
  
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
              <label class='col-sm-12 no-left-padding control-label field-title' for="Lesson"><?php echo 'Quiz title:'//echo lang('web_name')?> <span class="required">*</span></label>
              <div class="col-sm-12 no-left-padding">

        <input id="name" class="form-control form-height" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>"  />


        <span class="error err_name"><?php echo form_error('name'); ?> </span>
                                
              </div>
            </div>            
           
            <!-- <div class="col-sm-3 no-padding">
              <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" >
                Level 
              </label>
              <div class="col-sm-12 no-left-padding">
                <select id="difficultylevel" name="difficultylevel" class="form-control form-height"  size="1" >



                                    <option value="">Select Level</option>



                                    <option value="easy" <?php echo preset_select('difficultylevel', 'easy', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Easy</option>



                                    <option value="medium" <?php echo preset_select('difficultylevel', 'medium', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Medium</option>



                                    <option value="hard" <?php echo preset_select('difficultylevel', 'hard', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Hard</option>



                  </select>

              </div>
              <span class="error err_difficultylevel"><?php echo form_error('difficultylevel'); ?> </span>
           </div> -->
           <div class="col-sm-3 no-padding">
             <label class='col-sm-12 control-label field-title' style="padding-left:0;" for="Lesson">
             Duration
             </label>
             <div class="col-sm-12 no-left-padding">

                <input id="lecture_duration" class="form-control form-height" type="text" name="lecture_duration" placeholder="ex.1:00 Hrs" value="<?php echo set_value('lecture_duration', (isset($task->lecture_duration)) ? $task->lecture_duration : ''); ?>" />
              <span class="error err_duration"><?php echo form_error('difficultylevel'); ?> </span>

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
               
             

                <?php echo form_error('published'); ?>
               
               </div>
               </div>
            </div> 
           
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
<center>
  <?php 
  $session = $session = $this->session->userdata('loggedin');
  $sel_examid = $this->session->userdata('sel_quiz');
  // echo $sel_examid;
  // $session['sel_quiz'] = "";

$layout_media15_flag = (isset($task->is_exam)) ? true : false;
  $courseNo = $this->uri->segment(4);         
  $sectionNo = $this->uri->segment(5);  
  $ex_no = $this->uri->segment(6);
   ?>
   <a href='<?php echo base_url(); ?>admin/quizzes/quizesaddtotask/15' class="addexam btn btn-border-green"><?php
   if($sel_examid && $updType=='create'){ 
  echo "Replace Quiz"; }
  else if(@$task->is_exam && $updType=='edit'){ 
  echo "Replace Quiz"; }
  else{ echo "Select Quiz from existing"; } ?>
  </a>

 <a class='btn btn-danger btn-border-green' href="<?php echo base_url() ?>admin/exams/create/<?php echo $courseNo;?>/<?php echo $sectionNo;?>/<?php echo $ex_no;?>" 
   onclick="createExamToLecture(<?php echo $courseNo;?>,<?php echo $sectionNo;?>)">Create New Quiz</a>

</center>

<?php if($updType=='create')
    {
      if($sel_examid){
      // $title =  $this->uri->segment(5);
       $selectedEx = $CI->exam_model->getexamdetail($sel_examid);
      // print_r($selectedEx);  
      } ?>
      <div id="examinfo"><span href="javascript(0)" class="col-sm-5"><?php echo @$selectedEx->exam_title ?></span>
        <!-- <span class="col-sm-5"><a href="">view</a>&nbsp | &nbsp<a href="<?php echo base_url() ?>exams/edit_exam/<?php echo @$sel_examid ?>">edit</a></span> --></div>
      
      <input id="db_media_15" type="hidden" value="<?php echo $sel_examid ? $sel_examid : '' ?>" name="Exid">
      <?php
    }
    else if($updType == 'edit')
    { ?>
      <div id="examinfo">
      <?php if($task->is_exam){ 
        $selectedEx = $CI->exam_model->getexamdetail($task->is_exam);
       ?>
      
        
          <span href="javascript(0)" class="col-sm-8"><?php echo @$selectedEx->exam_title ?></span><span class="col-sm-4"><a href="<?php echo base_url() ?>admin/exams/edit_exam/<?php echo @$task->is_exam ?>" class="btn view_btn">view</a><a href="<?php echo base_url() ?>admin/exams/edit_exam/<?php echo @$task->is_exam ?>" class="btn edit_btn">edit</a></span>
      <?php } ?>
      </div>
  

<?php } ?>
<input id="layout_db" type="hidden" value="<?php echo set_value('layout_db', (isset($task->layoutid)) ? $task->layoutid : '12'); ?>" name="layout_db">
      
<input id="db_media_1" type="hidden" value="<?php echo set_value('db_media_1', (isset($db_media[0]->media_id)) ? $db_media[0]->media_id : '0'); ?>" name="db_media_1">



<input id="db_media_2" type="hidden" value="<?php echo set_value('db_media_2', (isset($db_media[1]->media_id)) ? $db_media[1]->media_id : '0'); ?>" name="db_media_2">



<input id="db_media_3" type="hidden" value="<?php echo set_value('db_media_3', (isset($db_media[2]->media_id)) ? $db_media[2]->media_id : '0'); ?>" name="db_media_3">



<input id="db_media_4" type="hidden" value="<?php echo set_value('db_media_4', (isset($db_media[3]->media_id)) ? $db_media[3]->media_id : '0'); ?>" name="db_media_4">



<input id="db_media_5" type="hidden" value="<?php echo set_value('db_media_5', (isset($db_media[4]->media_id)) ? $db_media[4]->media_id : '0'); ?>" name="db_media_5">



<input id="db_media_6" type="hidden" value="<?php echo set_value('db_media_6', (isset($db_media[5]->media_id)) ? $db_media[5]->media_id : '0'); ?>" name="db_media_6">



<input id="db_media_7" type="hidden" value="<?php echo set_value('db_media_7', (isset($db_media[6]->media_id)) ? $db_media[6]->media_id : '0'); ?>" name="db_media_7">



<input id="db_media_8" type="hidden" value="<?php echo set_value('db_media_8', (isset($db_media[7]->media_id)) ? $db_media[7]->media_id : '0'); ?>" name="db_media_8">



<input id="db_media_9" type="hidden" value="<?php echo set_value('db_media_9', (isset($db_media[8]->media_id)) ? $db_media[8]->media_id : '0'); ?>" name="db_media_9">



<input id="db_media_10" type="hidden" value="<?php echo set_value('db_media_10', (isset($db_media[9]->media_id)) ? $db_media[9]->media_id : '0'); ?>" name="db_media_10">



<input id="db_media_11" type="hidden" value="<?php echo set_value('db_media_11', (isset($db_media[10]->media_id)) ? $db_media[10]->media_id : '0'); ?>" name="db_media_11">



<input id="db_media_12" type="hidden" value="<?php echo set_value('db_media_12', (isset($db_media[11]->media_id)) ? $db_media[11]->media_id : '0'); ?>" name="db_media_12">



<input id="db_media_13" type="hidden" value="<?php echo set_value('db_media_13', (isset($db_media[12]->media_id)) ? $db_media[12]->media_id : '0'); ?>" name="db_media_13">



<input id="db_media_14" type="hidden" value="<?php echo set_value('db_media_14', (isset($db_media[13]->media_id)) ? $db_media[13]->media_id : '0'); ?>" name="db_media_14">



<!-- <input id="db_media_15" type="hidden" value="<?php echo set_value('db_media_15', (isset($db_media[14]->media_id)) ? $db_media[14]->media_id : '0'); ?>" name="db_media_15"> -->

<input id="db_media_15" type="hidden" value="<?php echo (isset($eid)) ? $eid : ''; ?>" name="db_media_15">

<input id="db_text_1" type="hidden" value="<?php echo set_value('db_text_1', (isset($db_mediatext[0]->media_id)) ? $db_mediatext[0]->media_id : '0'); ?>" name="db_text_1">



<input id="db_text_2" type="hidden" value="<?php echo set_value('db_text_2', (isset($db_mediatext[1]->media_id)) ? $db_mediatext[1]->media_id : '0'); ?>" name="db_text_2">



<input id="db_text_3" type="hidden" value="<?php echo set_value('db_text_3', (isset($db_mediatext[2]->media_id)) ? $db_mediatext[2]->media_id : '0'); ?>" name="db_text_3">



<input id="db_text_4" type="hidden" value="<?php echo set_value('db_text_4', (isset($db_mediatext[3]->media_id)) ? $db_mediatext[3]->media_id : '0'); ?>" name="db_text_4">



<input id="db_text_5" type="hidden" value="<?php echo set_value('db_text_5', (isset($db_mediatext[4]->media_id)) ? $db_mediatext[4]->media_id : '0'); ?>" name="db_text_5">



<input id="db_text_6" type="hidden" value="<?php echo set_value('db_text_6', (isset($db_mediatext[5]->media_id)) ? $db_mediatext[5]->media_id : '0'); ?>" name="db_text_6">



<input id="db_text_7" type="hidden" value="<?php echo set_value('db_text_7', (isset($db_mediatext[6]->media_id)) ? $db_mediatext[6]->media_id : '0'); ?>" name="db_text_7">



<input id="db_text_8" type="hidden" value="<?php echo set_value('db_text_8', (isset($db_mediatext[7]->media_id)) ? $db_mediatext[7]->media_id : '0'); ?>" name="db_text_8">



<input id="db_text_9" type="hidden" value="<?php echo set_value('db_text_9', (isset($db_mediatext[8]->media_id)) ? $db_mediatext[8]->media_id : '0'); ?>" name="db_text_9">



<input id="db_text_10" type="hidden" value="<?php echo set_value('db_text_10', (isset($db_mediatext[9]->media_id)) ? $db_mediatext[9]->media_id : '0'); ?>" name="db_text_10">



<input id="db_text_11" type="hidden" value="<?php echo set_value('db_text_11', (isset($db_mediatext[10]->media_id)) ? $db_mediatext[10]->media_id : '0'); ?>" name="db_text_11">



<input type="hidden" name="jumpbutton1" id="jumpbutton1" value="<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>">



<input type="hidden" name="jumpbutton2" id="jumpbutton2" value="<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>">



<input type="hidden" name="jumpbutton3" id="jumpbutton3" value="<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>">



<input type="hidden" name="jumpbutton4" id="jumpbutton4" value="<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>">



<input id="temp_lays" type="hidden" value="0" name="temp_lays">



<input id="day" type="hidden" value="2" name="day">



<input id="db_media_99" type="hidden" value="0" name="db_media_99">
        <hr/>
       
      </dd>
    </div>


    
  </div>
  </div>
</div>


<?php echo form_close(); ?>

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


<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
       var $j = jQuery.noConflict();
      $j(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements
        
        //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});     
      $j(".addexam").colorbox({
        iframe:true,
        width:"600px", 
        height:"650px",
        fadeOut:500,
        fixed:true,
        reposition:true,                  
            })
        });
      </script>
<!-- ll<script src="http://malsup.github.com/jquery.form.js"></script>ll -->
 <script src="<?php echo base_url() ?>public/js/form-master/jquery.form.js"></script>


<script>
   function addExamToLecture(section_id,pid)
   {
    window.location="<?php echo base_url(); ?>admin/quizzes/create/addExamToCourse/"+section_id+"/"+pid;
    exm_data();
   } 

   function editExamToLecture(lecture_id,section_id,pid)
   {
    window.location="<?php echo base_url(); ?>admin/quizzes/create/editExamToCourse/"+lecture_id+"/"+section_id+"/"+pid;
    exm_data();
   }
</script>


<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>
<script>
function exm_data()
  { 
     var txtname = $j('#name').val();
     var diflevl = $j('#difficultylevel').val();
     var lectDur = $j('#lecture_duration').val();
     var textarea = $j(".redactor-editor").html();
     //alert(textarea);
    if ($j("#published").is(":checked") == true){
      var published = '1';
    } 
    else{
      var published = '0';
    }


     $j.session.set('exm_data', JSON.stringify({txtname: txtname,diflevl:diflevl,published:published,textarea:textarea,lectDur:lectDur})); 
        
     var obj = JSON.parse($j.session.get('exm_data'))              
     console.log(obj); 
     //window.open('<?php echo base_url(); ?>tasks/lecture_preview/', '_blank');            
  }
</script>


<script>
  function editExam()
              { 
                
                var name = $("#name").val();
                var level = $("#difficultylevel").val();
                var lecture_duration = $("#lecture_duration").val();                
                var chek = document.getElementById("published").checked;
                if(chek ==true)
                {
                  var published = 1;
                }
                else
                {
                  var published = 0;
                }
                //var lec_content = $("#lec_content").val();
                var lec_content = $j(".redactor-editor").html();
                var examid = $("#db_media_15").val();
                var lecture_id ="<?php echo $this->uri->segment(4);?>";
                var section_id ="<?php echo $this->uri->segment(5);?>";
                var p_id ="<?php echo $this->uri->segment(6);?>";
                
                if(name == '' || level == '' || lecture_duration == '')
                {
                 
                     if(name == '')
                    {
                                    // $('#title').append('<span class="error">Please enter title</span> ');
                        $('.err_name').text('Please enter name!');
                        $('.err_name').show();
                        $('.err_name').fadeIn().delay(1000).fadeOut();
                        
                        // return false;
                    }
                    if(level == '')
                    {
                                    // $('#title').append('<span class="error">Please enter title</span> ');
                        $('.err_difficultylevel').text('Please select level!');
                        $('.err_difficultylevel').show();
                        $('.err_difficultylevel').fadeIn().delay(1000).fadeOut();
                        
                        // return false;
                    }
                    if(lecture_duration == '')
                    {
                                    // $('#title').append('<span class="error">Please enter title</span> ');
                        $('.err_duration').text('Please mention exam duration!');
                        $('.err_duration').css('display', 'block!important').show();
                        $('.err_duration').fadeIn().delay(1000).fadeOut();
                        
                        // return false;
                    }

                    return false;
                }
                else
                {


                $.ajax({
            type: "POST",
            //dataType: 'json',
            url: "<?php echo base_url();?>admin/tasks/edit_exam",
            data: {name:name,level:level,published:published,lec_content:lec_content,examid:examid,section_id:section_id,p_id:p_id,lecture_id:lecture_id,lecture_duration:lecture_duration}, 
            success: function(data)
            {
                  if(data)
                      {
                         var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Quiz saved successfully. </div>';


                      }
                      else{
                        var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-warning" aria-hidden="true"></strong>  Lecture could not saved, please try again! </div>';
                      } 

                      $('#message').html(str);
                     $('#message').show();
                      $('#message').fadeIn().delay(3000).fadeOut();
                    }
                      }); 
                }
                
              }
</script>