

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<link rel="stylesheet" href="<?php echo base_url(); ?>public/tooltipster.bundle.min.css">

<?php   

    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
    $first = $start + 1;

    $CI = & get_instance();
         $CI->load->model('program_model');
?>


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
    z-index: 99999;
}
.jconfirm .jconfirm-box div.title {
  background: transparent;
  font-size: 18px;
  font-weight: 600;
  font-family: inherit;
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
  margin: 28px 0 15px 0!important;
  text-align: center!important;
  font-weight: bold!important;
  color: #555555!important;
  font-size: 14px!important;
}
button.btn.btn-success {
  background-color: #04A600!important;
}
thead {
  display: none;
}
.tr_grey_clr {
  display: none;
}
.pub {
  display: none;
}
td:first-child {
  width: 17%;
}
.course_picture img {
  width: auto;
  height: auto;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}
#table-2 td.editdelete.no-padding{
      border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
.course_picture .course-title{
  display: none;
}
.editdelete::before {
  content: '';
  width: 1px;
  height: 77%;
  position: absolute;
  background:#edf2f9;
  top: 20px;
  left: 0px;
}
table#table-2 {
    background-color: transparent!important;
    box-shadow: none!important;
}
table#table-2.dataTables_wrapper .dataTable {
 box-shadow: none!important
}
table#table-2.dataTables_wrapper .dataTable{
  background-color: transparent!important;
}
#table-2 {
  border: 0px !important;
  border-collapse:separate; 
  border-spacing: 0 35px;
}
#table-2_wrapper{
  padding-bottom: 10px;
}
#table-2 tr i{
  color: #95aac9!important;
}
#table-2 tr {
    box-shadow: 0 0.75rem 1.5rem rgb(18 38 63 / 3%) !important;
    border: 1px solid #edf2f9 !important;
    background: #fff;
}
#table-2 td{
  border: 0px !important
}
.page-container {
  padding-left: 260px;
}
.icon-play2.play_button.open-popup:hover {
  color: #39aae1;
}

.user-info {
  padding-left: 5px;
}

.pmaintitle.main_subtitle {
  padding-left: 20px;
   padding-right: 20px;
}
/*tbody {
  background: #fff;
}*/


.row{
  margin: 0px !important;
}
#table-2 .div_row_padding {
  padding: 0px !important;
}
#table-2 td{
  padding:0px !important;
}

#table-2 .field-title {
  margin-bottom: 35px;
}
#table-2 .field-title p {

    color: #95aac9!important;
}
.course-title_sec .course-title {
    margin-bottom: 10px !important;
}
.draft{
  width: 80%;
  float: left;
  text-align: left;
}
.course_picture {
  margin-left: -3px;
}
.course_setting{
  display: none;
}
#table-2 .course_description_sec {
  padding: 15px 0px 15px 15px;
}
.course_setting {
  position: absolute;
  right: 32px;
  background: #fff;
  border: 1px solid #adb9cb;
  text-align: left;
  margin-top: 20px;
  padding: 10px 0px 0px 0px;
  z-index: 1;
  border-radius: 3px;
  bottom: 140%;
}
#table-2 tr:first-child .course_setting {
  bottom: unset;
  top: 100%;
}
#table-2 tr:first-child .course_setting ul:before{
  top: -25px;
  transform: rotate(0deg);
}
#table-2 tr:first-child .course_setting ul:after {
  top: -20px;
   transform: rotate(0deg);
}
.course_setting ul li a i {
  margin-right: 8px;
  font-size: 16px;
}
.blue_anchors a {
  display: inline-block !important;
  margin-right: 8px;
}
.blue_anchors a:last-child {
  margin-left: 8px;
}
.course_setting ul{
  padding:0px;
}
.course_setting ul li{
  list-style: none;
}
.draft p {
  font-size: 16px !important;
  margin-bottom: 5px;
}
.draft p:first-child {
  font-style: italic;
  font-weight: 500;
  color: #000!important;
}
p.modified{
  font-size: 15px !important;
}
.line {
  color: #666666 !important;
  font-size: 16px;
}
.blue_anchors a {
  color: #095291 !important;
  font-weight: 400;
}
.open_setting {
  font-size: 18px;
  padding: 10px;
  color: #455774;
  cursor: pointer;
}
.add_border{
  border: 1px solid #1f6b93;
  border-radius: 3px;
}
.editdelete{
  position: relative;
  width: 26% !important
}
.editdelete ul:before, .editdelete ul:after {
  content: '';
  display: block;
  position: absolute;
  bottom: 100%;
  width: 0;
  height: 0;
}

.editdelete ul::before {
  border: 12px solid transparent;
  border-bottom-color: #adb9cb;
  right: 5px;
   transform: rotate(180deg);
  bottom: -24px;
}
.edit-menu .lnr {
    margin-right: 8px;
    font-weight: bold;
    margin-top: 10px;
    position: relative;
    top: 1px;
    color: #95aac9;
}
.editdelete ul::after {
  right: 7px;
  border: 10px solid transparent;
  border-bottom-color: #fff;
  transform: rotate(180deg);
  bottom: -20px;
}
.hide_old_sec{
  display: none;
}
.course_setting ul li a {
    padding: 10px 20px;
    display: block;
    color: #000;
    font-size: 14px;
}
.course_setting ul li {
  border-bottom: 1px solid #ddd;
}
.course_setting ul li:last-child {
  border-bottom: 0px;
}


footer.main{
  position: absolute;
  bottom: 0px;
  width: 100%;
  padding-top: 40px;
}

.dataTables_paginate.paging_bootstrap{
 background: #f3f4f7;
 border: 0px;
}
#table-2_info.dataTables_info{
   background: #f3f4f7;
   border: 0px;
}
#table-2 .course_author p{
    color: #000;
    font-weight: 500;
}
.course_type {
    float: right;
    margin-right: 20px;
    color: #000;
    font-weight: 500;
}
td.editdelete a {
    display: none;
    
}
</style>

<?php

  $u_data=$this->session->userdata('loggedin');

  $maccessarr=$this->session->userdata('maccessarr');
  
 
?>



<div class="main-container" id="course_page_container">
<div id="toolbar-box" class="pageHeader">

  <div class="m">
    <div class="pagetitle icon-48-generic"><h2><?php echo 'Courses';?></h2></div>
    <div id="toolbar" class="toolbar-list">

<?php
if(($u_data['groupid']=='4') || ($maccessarr['courses']=='own'))

{

?>
      <div id="sticky-anchor"></div>
      <ul id="sticky" style="list-style: none; float: right;">
    

        <?php
          
          if($course_limit > $countprogConfig)
          {
        ?>

        <li id="toolbar-new" class="listbutton" style="float: left;">
        <a href="javascript:void(0)" class="create_course button create_course_popup">
        <i class="fas fa-plus"></i>
        <span class="icon-32-new">
        </span>
        New Course</a>
        </li>

     
        <?php
          }
        ?>
      </ul>

<?php
}
?>
<style>
  /*.tooltip_templates { display: none; } */
</style>

</div>


<script>
  $('.tooltip').tooltipster({
    contentCloning: true
});
</script>

</div>
</div>
<div class="">

<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
echo form_open_multipart(base_url().'admin/programs/',$attributes);
?>
<div class=" top-head-box">
 <!--  <span class="col-sm-3"></span> -->
 <div id="message"></div>

   <div  id="table-3_length" >
    <span>
        <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control" placeholder="Search by course title">
    </span>
    <span class="select_course_category">
   
   
        <select name="catid" size="1" class="form-control" >
            <option value="">Select course category</option>
            <?php
            foreach ($categories as $category){

                    ?>

            <option value='<?php echo $category->id?>'><?php echo $category->name;?></option>

          <?php } ?>

        </select>
   
  </span>
  

 <span >
  
                <select name="status" class="form-control" >

        <option value="">Select status</option>

                <option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>

        <option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>

        </select>
    
  </span>
  <span>
    <button type="submit" value="Search" name="submit_search" class="search-btn button" ><span class="lnr lnr-magnifier"></span></button>
    <!-- <button type="submit" value="Reset" name="reset" class="search-btn" style=""><span class="lnr lnr-redo" style="color: #666666;font-size: 25px;"></span></button> -->
  </span>
</div>
</div>
<div id="table-2_wrapper" class="courseManagerTable dataTables_wrapper form-inline" role="grid">

<div class="clear"></div>
 <?php echo form_close(); ?>


<table class="table table-bordered datatable dataTable" id="table-2" aria-describedby="table-2_info">
  <thead>
      <tr role="row">
          <!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
        <div class="checkbox checkbox-replace neon-cb-replacement">
          <label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
        </div>
      </th>-->
            
            <th class="sorting col-sm-5" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"> <div class="col-sm-12 no-padding table-title">Course</div> </th>
            
           

            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Category</div></th>
      
  

            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Status</div></th>
            
            <th class="sorting col-sm-2 no-padding" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
            
        </tr>
  </thead>

<?php
$this->load->model('admin/programs_model');
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'admin/programs/',$attributes);
?>
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php if ($programs){
?>
 

  

<?php $i=0;?>

<?php 
$iii = 0;
$k = 0;
foreach ($programs as $program){
// $counts_students = $this->programs_model->getEnrolledUser($program->id);
  $counts_students = $this->programs_model->getEnrolledUsernew($program->id);
$webicount = $this->programs_model->getwebinarcount($program ->id);
//$sectcount = $this->programs_model->getsectioncount($program ->id);
$sectcount = $this->programs_model->getlistDays($program ->id);

$reviews = $this->programs_model->getReviews($program ->id);

$ii = 0;
foreach ($sectcount as $key) 
{
  $lessonscount = $this->programs_model->getLessons($key->id);
  $ii+= count($lessonscount);
}
?>


     
<tr class="odd camp<?php echo $i;?>" id="tr_<?php echo $program ->id?>">
<div class="tr_border">

      
    <td class="tr_border"> 
      <div class="col-sm-12 div_row_padding course_picture">
        <!--new content -->
        <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $program->image ? $program->image : 'no_images_course.png' ?> ">
        <?php

        if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
        {
        ?>

          <a href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>' class="a_mlms field-title course-title">
          <?php echo ucfirst($program->name);?>
            </a>

        <?php
        }
        else
        {
            echo ucfirst($program->name);
        }
        ?>
        </div>
    </td>
 
    

        <td class="course_description">
          <div class="course_description_sec">
            <div class="col-sm-12 no-padding course-title_sec" style="color: #949494;">
              <?php if($u_data['groupid']=='4'){ ?>
              <a href='<?php echo base_url().'admin/section-management/'.$program->id;?>' class="a_mlms field-title course-title" target="_blank">
                <?php echo ucfirst($program->name);?>
              </a>
              <?php }else{ ?>
              <a href='<?php echo base_url().$program->slug.'/lectures/'.$program->id;?>' class="a_mlms field-title course-title" target="_blank">
                <?php echo ucfirst($program->name);?>
              </a>
              <?php } ?>
              <a href="<?php echo base_url().'online-courses/'.$program->slug;?>" target="_blank" style="float: right;padding: 6px 15px 0 5px;cursor: pointer;"><i class="fa fa-eye"></i></a>

            </div>
            <div class="col-sm-12 no-padding field-title cat_name" >
              <p><?php echo ucfirst($program->catname)?></p>
            </div>
            <div class="col-sm-12 no-padding course_author">
             <p> <?php $userinfo=$this->programs_model->getUserInfo($program->author);
              echo $userinfo->first_name.' '.$userinfo->last_name; ?> </p>
             <?php  echo $program->course_type == 2 ? '<p class="course_type"><i class="fas fa-clipboard-list"></i> Quiz</p>' :
            '<p class="course_type"><i class="far fa-play-circle"></i> Lecture</p>';
              ?>
            </div>
          </div>
        </td>
     
    
            <?php
              
          $days = $CI->program_model->getlistDays($program ->id);

          $lessons = $CI->program_model->getLessons(@$days[0]->id);

      ?>

    
  <div class="col-sm-12">
      <?php

      if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

      {

      ?>      <td class="pub no-padding">


          <?php if($program->published){?>

              <a title="Publish Item" href="<?php echo base_url(); ?>admin/programs/unpublish/<?php echo $program ->id?>"><!-- <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"> --><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>
              
            <?php }else{?>

              <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/programs/publish/<?php echo $program ->id?>"><!-- <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"> --><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>

        
    <?php }?>
</td>
   
<?php

}

else

echo "No Access";
$k++;
?>
</div>
          
            <td class="editdelete no-padding">
            <div class="col-sm-12 no-padding center" style="text-align: center;padding-left:20px !important;padding-right:20px !important;">
              <!-- New Content -->
                  <div class="draft">
                  <p><?php echo $program->published == '1' ? 'Published' : 'Draft' ?></p>
                  <p class="modified">Modified on: <?php echo $program->modify_date; ?>

                   <!-- Jan 23, 2019  -->
                  </div>
                  <?php if($u_data['groupid']=='4' || $u_data['groupid']=='2'){ ?>
                  <div class="edit-menu">
                    <i class="fas fa-ellipsis-h open_setting showmenu" id="showmenu_<?php echo $k;?>" ></i>
                    <div id="menu_<?php echo $k;?>" class="course_setting">
                      <ul>
                        <?php if($u_data['groupid']=='4'){ ?>
                        <li><a href="<?php echo base_url('admin/section-management/'.$program->id); ?>"><span class="lnr lnr-pencil"></span>Edit content</a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url('admin/programs/discussions/'.$program->id)?>"><span class="lnr lnr-bubble"></span>Discussions</a></li>
                        <li><a href="<?php echo base_url('admin/programs/reviews/'.$program->id)?>"><span class="lnr lnr-magnifier"></span></i>Reviews</a></li>
                        <?php if($u_data['groupid']=='4'){ ?>
                        <li><a href="<?php echo base_url('admin/edit/courses/'.$program->id); ?>"><span class="lnr lnr-cog"></span>Settings</a></li>
                        <?php if($program->is_live_class == 1){ ?>
                        <li><a href="<?php echo base_url('admin/programs/get_batches/'.$program->id); ?>"><span class="lnr lnr-camera"></span>Live Classes</a></li>
                        
                        <?php } if($ii != 0){ ?>
                        <li>
                          
                          <a href="<?php echo base_url(); ?>admin/course/preview/<?php echo $program->id ?>/<?php echo @$days[0]->id ?>/<?php echo @$lessons[0]->id; ?>" target="_blank" id="pre_link" ><span class="lnr lnr-eye"></span>Preview course</a></li>
                        <?php } ?>

                        <li><a onclick="copyCourse('<?php echo $program->id ?>')" ><span class="lnr lnr-book"></span>Copy course</a></li>
                        
                        <!-- <li class="blue_anchors"><a>Collapse</a><span class="line">|</span><a>Expand</a></li> -->
                        <li><a onclick="deleteconfirm(<?php echo $program->id ?>)"><span class="lnr lnr-trash"></span>Delete course</a></li>
                      <?php } ?>

                        <!-- <li><a onclick="deleteconfirm(<?php //echo $program->id ?>)"><i class="fas fa-trash-alt"></i>Delete Courses</a></li> -->
                      </ul>
                    </div>
                  </div>
                  <?php } ?>
              <!--  <a href="" onclick="viewsite2(<?php echo $program->id ?>,<?php echo @$days[0]->id ?>,<?php echo @$lessons[0]->id; ?>)" class="col-sm-2 no-padding sprite_margin" target="_blank" id="pre_link" > -->
                
               <?php if($ii == 0){ ?>
               <a href="javascript:void()" class="col-sm-2 no-padding sprite_margin hide_old_sec" target="_blank" id="pre_link" >
               <i class="entypo entypo-block" title="No Preview"></i>
               <?php } 
               else { ?>
               <a href="<?php echo base_url(); ?>admin/course/preview/<?php echo $program->id ?>/<?php echo @$days[0]->id ?>/<?php echo @$lessons[0]->id; ?>" class="col-sm-2 no-padding sprite_margin hide_old_sec" target="_blank" id="pre_link" >
                <div class='sprite 5preview' style="background-position: -120px 0; height: 14px;" title="Preview"></div>
              </a>
           
            <?php
           }
if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

{

?>

      <!-- <a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/programs/edit/<?php echo $program ->id?>'><i class="entypo-pencil"></i>edit</a> -->
      
      <a href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>" class='col-sm-2 no-padding sprite_margin hide_old_sec'>
        <div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content">
        </div>
      </a>

      

<?php

}
?>
<a  class='col-sm-2 no-padding sprite_margin hide_old_sec' href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'>
<div class='sprite 7settings' style="background-position: -184px 0" title="Course Settings"></div></a>
<a class="col-sm-2 no-padding sprite_margin hide_old_sec copy_link" id="link_id<?php echo $program ->id?>">
<div class='sprite 3copy' style="background-position: -64px 0; width: 18px;" title="Copy"></div>
</a>

<div class="modal fade copydiv" id="copy_popup<?php echo $program ->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="post" action="<?php echo base_url();?>admin/programs/copy/"  class="tform" id="copy_form<?php echo $program ->id?>">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="text-transform: inherit !important;">Copy a Course</h4>
      </div>
      <div class="modal-body">
        <!-- <?php
      $attributes = array('class' => 'tform', 'id' => 'copy_form<?php echo $program ->id?>');
      echo form_open_multipart(base_url().'admin/programs/copy', $attributes);
      ?> -->
            
              <div class="form-group col-sm-12">
              
              <label class='col-sm-5 control-label'>Make a copy of this course</label>
              <?php
              $comboCourse = $this->programs_model->getCourseCombo();
              ?>
          
              <div class="col-sm-7">
              <input type="text" value="<?php echo ucfirst($program->name) ?> - Copy" name="Coursename_<?php echo $program->id ?>" id="Coursename_<?php echo $program->id ?>" style="height: 31px;padding: 14px 10px;width: 100% !important">
              <input type="hidden" value="<?php echo $program->id ?>" name="CbCourse_<?php echo $program->id ?>" id="CbCourse_<?php echo $program->id ?>">
                            
              <?php echo form_error('CbCourse'); ?>
            
                
            </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button name='btnSubmit_<?php echo $program->id ?>' id='btnSubmit_<?php echo $program->id ?>' onclick="copyCourse('<?php echo $program->id ?>')" type="button" class="btn btn-primary">Copy</button> 
   <a href="" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span class="icon-32-cancel"> </span>Cancel</a>
      </div>
    </div>
  </div>
  </form>
</div>



<?php
if(($u_data['groupid']=='4') || ($maccessarr['courses']=='own'))

{
?>
<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/programs/trash/<?php echo $program->id?>'>
      <i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onClick="deleteconfirm(<?php echo $program->id?>)">
      <i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
      <a class="icon-left col-sm-2 no-padding hide_old_sec" onClick="deleteconfirm(<?php echo $program->id?>)">
      <div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div>
      <!-- <i class="entypo-cancel"></i><?php echo lang('web_delete')?> --></a>
      <?php 
       $users_id = $this->programs_model->getBuyUsers($program->id);
        $users_id2 = $this->programs_model->getBuyUsers2($program->id);
       
       ?>
      <input type="hidden" value="<?php echo $users_id ? '1' : '0'; ?>" id="id_<?php echo $program->id?>">
      <input type="hidden" value="<?php echo $users_id2 ? '1' : '0'; ?>" id="id2_<?php echo $program->id?>">

<?php

}

else

echo "No Access";

?>
        </div>
            </td>
    <tr class="tr_grey_clr"> 
     <div class="col-sm-12 no-padding">
      <td class="" style="padding-top: 0 !important;">
        <div class="col-sm-12 no-padding">
          <span class="grey_tabs">
            <a href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>">
              <span class="sprite 2edit tab_icon" style="background-position: -32px 0;" title="Course Content">
             </span> COURSE CONTENT (<?php echo $ii;?>)
           </a>
          </span>  
          <span class="grey_tabs">
            <a  class='' href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'><span class="sprite tab_icon" style="background-position: -184px 0" title="Course Settings"></span>COURSE SETTINGS</a>
           </span> 
        </div>
      </td>
      <td class="enrol">
        <div class="col-sm-12 no-padding">
        <span class="grey_tabs">
          <a href="<?php echo base_url(); ?>admin/enrolled-students/list/<?php echo $program ->id?>"><?php echo 'STUDENTS ENROLLED <span class="count_clr">('.count($counts_students).')</span>';?>
          </a>
        </span>
        </div> 
      </td>
      <td class="enrol">
        <div class="col-sm-12 no-padding center">
        <span class="grey_tabs">
          <a href="<?php echo base_url(); ?>admin/course/reviews/<?php echo $program ->id?>"><?php echo 'REVIEWS <span class="count_clr">('.count($reviews).')</span>'; ?>
          </a>
        </span>
        </div>  
      </td>
      <td class="enrol">
        <div class="col-sm-12 no-padding center">
         <span class="grey_tabs">
          <a href="<?php  if($program->webstatus == 'active') { echo base_url().'admin/webinars/listings/'.$program ->id; } else { '#'; } ?>">
                <?php
                  if($program->webstatus == 'active')
                  {
                    echo 'Webinar ('.$webicount->count1.')';
                  }
                  else
                  {
                    echo 'Inactive';
                  }
                ?>
           </a>
           </span>
           </div>
      </td>
      </div>
      </div>
      </div>
    </tr>
            
            
            
    
    <?php 
           $iii++;
    } ?>

<?php } else{ ?>
<!-- 
<tr>

    <td colspan="8"> -->
      <h3 id="no_course" style="padding: 20px">No course yet!</h3>
<!-- <?=lang('web_no_elements');?>
 -->
<!-- </td> -->


<?php } ?>

</tbody>

 <?php echo form_close(); ?>

</table>
       
      
  <!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
  <div class="col-xs-6 col-left">
    <div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countprog; ?> entries</div>
  </div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
    <?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>

    </div>
</div>
</div>
<?php } ?>


<!-- New Course Popup -->
    <div class="popup_overlay"></div>

<div class="new_course_popup">
  <div class="new_course_popup_header">
      <span class="popup_heading">Choose a course template</span>
      <span class="lnr lnr-cross cross_icon"></span>
  </div>

    <div class="new_course_select_sec">

  <?php 
      $CI->load->model('admin/programs_model');

      $templates = $CI->programs_model->get_template();
      // print_r($templates);
      foreach ($templates as $temp) {
        ?>
        <div class="new_course_box">
          <span class="lnr lnr-file-add"></span>
          <h3 class="course_temp_title" id="course_<?php echo $temp->id ?>"><?php echo $temp->name ?></h3>
          <div class="course_temp_desc">
            <?php 
          //$string = substr($temp->description,0, strpos($temp->description, "</p>")+4);
          //echo $string ?>
            <?php echo $temp->temp_desc ?>
          </div>
          <a href="#" class="temp_select" id="<?php echo $temp->id ?>" >CHOOSE</a>
        </div>
    <?php
      }
   ?>
    
  </div>
</div>
</div>
 </div>


<!-- <input type="text" value="<?php ?>" id="confirmdel" > -->
<!--Copy popup-->

<!--Copy popup End -->

<!-- tool tip script --><script type="text/javascript">jQuery(document).ready(function(){ jQuery('.tooltipicon').click(function(){  var dispdiv = jQuery(this).attr('id');  jQuery('.'+dispdiv).css('display','inline-block');  }); jQuery('.closetooltip').click(function(){ jQuery(this).parent().css('display','none');  }); }); </script><!-- tool tip script finish -->

<!-- The JavaScript -->
<script>

function saveorder(n, task) {

  //alert(n);



  checkAll_button(n, task);

}

function checkAll_button(n, task) {



  if (!task) {

    task = 'saveorder';

  }

    document.orderform.submit();

}

</script>


<script src="<?php echo base_url(); ?>public/tooltipster.bundle.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script>
var $ =jQuery.noConflict();

  function deleteconfirm(id) 
  {

    // alert(id);
       var isit = $("#id_"+id).val();
       var isit2 = $("#id2_"+id).val();
        if(isit == 1 && isit2 == 1 )
          {
            $.alert({
            title: 'Sorry!',
            content: 'Users are Enrolled to this Course. You cannot delete it.!',
            confirm: function()
                {
                  return true;
                  //document.location.href = window.location.origin+'/admin/programs/';
                }
            });
          }
          else
          {   
      $.confirm({
          title: 'Do you really want to delete this Course ?',
          content: ' ',
          confirm: function(){ 
               // window.location.href = "<?php echo base_url(); ?>admin/programs/trash/"+id;
               $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>admin/programs/trash/"+id,
                  success: function(res){
                      $(document).find('#tr_'+id).remove();
                      if(!res){
                         var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-warning" aria-hidden="true"></strong>Fail to delete course, Please try again! </div>';
                      }else{
                       var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> '+res+' </div>';
                      }
                        var msg = $(document).find('#message');

                      msg.html(str).show().fadeIn().delay(3000).fadeOut();
                  }
               })
        
                 },
          cancel: function(){        
              return true;
                }
            });
      }
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
  function viewsite2(program,day,lessons)
  {    

    jQuery.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>admin/programs/view_frontsite",
              //data: {program:program,day:day,lessons:lessons}, 
              success: function(data)
              {
                
                window.location = '<?php echo base_url(); ?>admin/programs/coursepreview/'+program+'/'+day+'/'+lessons; 

              }
              });
     
  }
</script>
<script>
jQuery( document ).ready(function() {
jQuery('.copy_link').click(function(){

var link_id = jQuery(this).attr('id');  
    jQuery(this).siblings('.copydiv').modal('show');
    jQuery('.modal-backdrop.fade.in').css('display', 'none');
});

//jQuery('.copyCourse').click(function(){
  //jQuery(document).on('click', '.copyCourse', function() {

});

function copyCourse(link_id1)
{    
     var coursename = $("#Coursename_"+link_id1).val();
     var cbcourse = $("#CbCourse_"+link_id1).val(); 
    

$.ajax({
          type: "POST",
          url: "<?php echo base_url();?>admin/programs/copyCourse",
          data: {coursename:coursename,cbcourse:cbcourse}, 
          success: function(data)
          {
              window.location.reload(true);
            
          }
      }); 
}


 
  </script>

<script type="text/javascript">
   

    $(document).ready(function () {
      $(document).on('click', ".showmenu", function () {
          var next = $(this).next(".course_setting");
          next.slideToggle();
          $(".course_setting").not(next).slideUp();
            $('.showmenu').not(this).each(function(){
                   $(this).removeClass("add_border");
            });
            $(this).toggleClass("add_border");
      });
    });
     


    $(document).mouseup(function(e) {
      var container = $(".course_setting");
       var showmenu = $(".showmenu");
      // if the target of the click isn't the container nor a descendant of the container
      if (!showmenu.is(e.target) && !container.is(e.target) ) {
          container.slideUp();
          showmenu.removeClass("add_border");
      }
    });
 
</script>

<script>
  $( "#tooltipClick" )
  .tooltip({
    content: $( "#tooltipClick" ).attr( "title" ),
    items: 'span'
    })
  .off( "mouseover" )
  .on( "click", function(){
      $( this ).tooltip( "open" );
      return false;
    })
  .attr( "title", "" ).css({ cursor: "pointer" });

</script>

<script>
  $(document).on('click','.temp_select', function(){
    var id = $(this).attr('id');
    var name = $('#course_'+id).text();
   $.confirm({
          title: false,
          content: '' +
          '<div class="formName" style="padding: 20px;">' +
          '<h3>Enter your coures name</h3>' +
          '<input type="text" value = "'+name+'" placeholder="Course name" class="name form-control" required />' +
          '</div>' ,
          confirm: function(){ 
                var name = $(document).find('.formName').find('.name').val();
               if(!name){
                    $.alert('provide a valid name');
                    return false;
                }
                else{

                      $.ajax({
                        cache: false,
                          type: "POST",
                        data: {'id': id, 'coursename': name },
                        url: "<?php echo base_url('admin/programs/copy_template'); ?>",
                        beforeSend: function(){
                              $('.new_course_popup, .popup_overlay').hide();
                        },
                        success: function(response){
                           if(response){
                              $(document).find('tbody').prepend(response);
                              $(document).find('#no_course').remove();
                            // $(document).find('#course_page_container').html(response);
                           
                                    
                          }
        
                       },
                        complete: function(){
                          var msg = $(document).find('#message');
                           var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> New course is created successfully. </div>';
                          

                          msg.html(str).show().fadeIn().delay(3000).fadeOut();

                        }
                     });
                    }
                  },
          cancel: function(){        
              return true;
                }
            });
    });
</script>
<script>

  $(document).ready(function() {
    $(document).on('click','.create_course_popup', function() {
            $('.popup_overlay').show();
                        $('.new_course_popup').show();    

    });
    $(document).on('click','.cross_icon', function() {
            $('.new_course_popup').hide();
            $('.popup_overlay').hide();
    });
});
  
</script>
