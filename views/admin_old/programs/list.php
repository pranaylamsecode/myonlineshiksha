<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/tour/css/jquerytour.css" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<script src="<?php echo base_url(); ?>public/tour/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/tour/js/ChunkFive_400.font.js" type="text/javascript"></script>


<?php   

  
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
  $first = $start + 1;
?>

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
<script type="text/javascript">
    //var $ =jQuery.noConflict();
        function demoContent()
               {  var $ =jQuery.noConflict(); 
                  
                  $.confirm({
                  title: ' Do you really want to delete demo content ? ',
                  content: 'This will not affect your created content.',
                  confirm: function(){

                    $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>admin/programs/deleteDemo",
              //data: {follow_id:follow_id,student_id:student_id}, 
                    success: function(data)
                    {
                
                    window.location.assign("<?php echo base_url(); ?>admin/programs");
                    }
                     });
                      
                     },
                 cancel: function(){
                   return true;
                      }
                });     
                     
         }
        </script>
<style>
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
</style>

<?php

  $u_data=$this->session->userdata('loggedin');

  $maccessarr=$this->session->userdata('maccessarr');
  
 
?>

<?php
     $democourse = $this->programs_model->getDemo_course();
     $democoursecategory = $this->programs_model->getDemoCourse_category();
     $demomediacategory = $this->programs_model->getDemomedia_categories();
     $demouser = $this->programs_model->getDemo_user();
     $demomedia = $this->programs_model->getDemo_media();
     if($democourse || $democoursecategory || $demomediacategory || $demouser || $demomedia)
     {
  ?>
  
  <div id="tourcontrols1" class="tourcontrols" style="right: 365px; width: 689px; height: 84px; position: fixed;">
  <p>We have enabled demo content in Your Online Academy. You can anytime delete demo content using this button.</p>
  <span class="button" id="deleteDemo" onclick="demoContent();" style="margin-left: 248px;margin-top: -13px;">Delete Demo Content</span>
  
  <span class="close" id="canceltour"></span>
  </div>
  <?php
   }
  ?>
<div class="main-container">
<div id="toolbar-box">

  <div class="m">

    <div id="toolbar" class="toolbar-list">

<?php

if(($u_data['groupid']=='4') || ($maccessarr['courses']=='own'))

{

?>
      <div id="sticky-anchor"></div>
      <ul id="sticky" style="list-style: none; float: right;">
        <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
        <a href="<?php echo base_url(); ?>admin/course/trashdata" onclick="Joomla.submitbutton('edit')"  class="btn btn-default btn-dark-grey">
        <i class="entypo entypo-trash"></i>
        <span class="icon-32-new">
        </span>
        Trash
        </a>
        </li>

        <?php
          
          if($course_limit > $countprogConfig)
          {
        ?>

      
        <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
        <a href="<?php echo base_url(); ?>admin/create/course" onclick="Joomla.submitbutton('edit')"  class="btn btn-success btn-green">
        <i class="entypo entypo-popup"></i>
        <span class="icon-32-new">
        </span>
        New</a>
        </li>

        <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
        <a href="<?php echo base_url(); ?>admin/programs/createweb" onclick="Joomla.submitbutton('edit')"  class="btn btn-success btn-blue">
        <i class="entypo entypo-popup"></i>
        <span class="icon-32-new">
        </span>
        New Webinar</a>
        </li>

       <!--  
        <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
        <a href="<?php echo base_url(); ?>admin/programs/copy" class="btn btn-success btn-blue" style="padding: 6px 9px 6px!important;">
        <i class="entypo entypo-docs"></i>
        <span class="icon-32-new">
        </span>
        Copy</a>
        </li> -->
        <?php
          }
        ?>
      </ul>

<?php
}
?>
<div class="clr"></div>
</div>
<div class="pagetitle icon-48-generic"><h2><?php echo 'Course Manager';?></h2></div>
<!-- ////////////////////// -->
<!-- <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openProgressbarpop('#homeLogoImage');" id="settings_3">
                <i class="fa fa-gear"></i></a> -->
<!-- //////////////////////// -->
</div>
</div>
<div class="">
<div style="margin-bottom:5px;">
<!-- <p class="pmaintitle">Here you can manage all your courses. When you click on the course name, you get the course Table of Content. If you click Edit, you get the rest of the settings of this course.<br/>
The Online Course is divided into sections and Webinars / Live Online Classes. Each Section have "Lectures" and "Exams". At the very end of the course you can put a Final Exam / Evaluation and award the Certification on successful completion.</p> -->
<p class="pmaintitle main_subtitle">When you click on the COURSE CONTENT, you get the Table of Content. If you click COURSE SETTINGS, you get the rest of the settings of the course.</p>
</div>

<div>
    <?php if (isset($control)): ?>
      <a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
echo form_open_multipart(base_url().'admin/programs/',$attributes);
?>
<div class="col-sm-12 no-padding top-head-box">
 <!--  <span class="col-sm-3"></span> -->
   <span  id="table-3_length" style="margin-right: 1%;">
    
     <label>
        <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control form-height" placeholder="search by course title">

    <!-- <button type="submit" value="Search" name="submit_search" class="btn btn-blue" style="padding: 5px 5px 5px!important;"><i class="entypo entypo-search"></i> Search</button>

    <button type="submit" value="Reset" name="reset" class="btn btn-red btn-del" style="padding: 6px 7px 6px 2px;"><i class="entypo entypo-cw"></i> Reset</button> -->
    </label>
  </span>
  <span style="margin-right: 1%;">
    <label>
   <!--  Course category : -->

        <!-- <select name="catid" size="1" onchange="document.topform11.submit()" class="form-control"> -->
        <select name="catid" size="1" class="form-control form-height" style="color: #ACACAC">
            <option value="">select course category</option>
            <?php
            foreach ($categories as $category):

                    //$cat_name = ($this->input->post('catid') && $this->input->post('catid') == $category->id) ? 'selected="selected"' : '';

                    ?>

            <option value='<?php echo $category->id?>'><?php echo $category->name;?></option>

          <?php endforeach ?>

        </select>
    </label>
  </span>
  

 <span style="margin-right: 1%;">
    <label>
          <!-- Status : -->
                <!-- <select name="status" onchange="document.topform11.submit()" class="form-control"> -->
                <select name="status" class="form-control form-height" style="margin-right: 39px;color: #ACACAC">

        <option value=""> select status</option>

                <option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>

        <option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>

        </select>
    </label>
  </span>
  <span>
    <button type="submit" value="Search" name="submit_search" class="search-btn" ><div class='sprite search' title="Search"></div></button>
    <button type="submit" value="Reset" name="reset" class="search-btn" style=""><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>
  </span>
</div>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<!-- <div class="row col-sm-12">
    <div class="col-xs-4 col-left">
    
  </div>
  
<div class="col-xs-10 col-right">
<div id="table-3_length" class="dataTables_length">
  
        <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control" placeholder="search by course title">

    <button type="submit" value="Search" name="submit_search" class="btn btn-blue" style="padding: 5px 5px 5px!important;"><i class="entypo entypo-search"></i> Search</button>

    <button type="submit" value="Reset" name="reset" class="btn btn-red btn-del" style="padding: 6px 7px 6px 2px;"><i class="entypo entypo-cw"></i> Reset</button>
    </div>
    <div class="dataTables_filter" id="table-3_filter">
    <label style="margin-left:10px;">
   

        
        <select name="catid" size="1" class="form-control">
            <option value="">select course category</option>
            <?php
            foreach ($categories as $category):

                   

                    ?>

            <option value='<?php echo $category->id?>'><?php echo $category->name;?></option>

          <?php endforeach ?>

        </select>
    </label>
      <label>
          
                
                <select name="status" class="form-control">

        <option value=""> select status</option>

                <option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>

        <option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>

        </select>
    </label>
    </div>
    
  </div>
</div> -->
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
            
             <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 100px;">Sections</th>--> 

            <!--  <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 100px;"> Category</th> -->

            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Category</div></th>
      
      <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Live Online Classes</th> -->

      <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Enrolled Students</th> -->

      <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Reviews</th> -->
            <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Previews</th> -->
            
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Re-order<a class="saveorder" href="javascript: saveorder(<?php echo count(@$programs)-1; ?>, 'saveorder')">__</a></th>-->

            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Status</div></th>
            
            <th class="sorting col-sm-2 no-padding" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
            
        </tr>
  </thead>

<?php
$this->load->model('admin/programs_model');
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'admin/programs/',$attributes);
?>

<?php if ($programs): 
?>
  
  
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>

<?php 
$iii = 0;

foreach ($programs as $program): 
// $counts_students = $this->programs_model->getEnrolledUser($program->id);
  $counts_students = $this->programs_model->getEnrolledUsernew($program->id);
$webicount = $this->programs_model->getwebinarcount($program ->id);
//$sectcount = $this->programs_model->getsectioncount($program ->id);
$sectcount = $this->programs_model->getlistDays($program ->id);

$reviews = $this->programs_model->getReviews($program ->id);

$ii = 0;
foreach ($sectcount as $key) 
{
  // $lessonscount = $this->programs_model->getLessons($key->id);
      $lessonscount = $this->program_model->getLessonNew($key->id);

  $ii+= count($lessonscount);
}
?>


     
<tr class="odd camp<?php echo $i;?>">
<div class="tr_border">
<!--<td class=" sorting_1">
        <div class="checkbox checkbox-replace neon-cb-replacement">
          <label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
        </div>
      </td>-->
      
    <td class="tr_border"> 
      <div class="col-sm-12 div_row_padding" >
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
 
      <!--<td class="webnr"><a href="<?php echo base_url(); ?>admin/days/<?php echo $program ->id?>"><?php echo $sectcount->sectioncount;?></a></td>-->

      <!-- <td class=""><a href="<?php echo base_url(); ?>admin/days/<?php echo $program ->id?>"> Edit Lectures (<?php echo $ii;?>)</a></td> -->

      
        <td>
        <div class="col-sm-12 no-padding field-title" style="color: #949494;">
          <?php echo ucfirst($program->catname)?>
        </div>
        </td>
     
      <!-- Live online classes section-->

      <!-- <td class="webnr"><a href="<?php  if($program->webstatus == 'active') { echo base_url().'admin/webinars/listings/'.$program ->id; } else { '#'; } ?>">
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
       

      </a></td> -->
    <!-- Live online classes section End-->

      <!-- <td class="enrol"><a href="<?php echo base_url(); ?>admin/programs/enrolled/<?php echo $program ->id?>"><?php echo 'Enrolled ('.count($counts_students).')';?></a></td> -->



      <!-- <td class="enrol"><a href="<?php echo base_url(); ?>admin/programs/reviews/<?php echo $program ->id?>"><?php echo 'Reviews ('.count($reviews).')'; ?></a></td> -->
            <!-- <td class="enrol"><a href="<?php if($ii == 0) { echo '#';} else { echo base_url()."programs/coursepreview/".$program->id."/".$days[0]->id."/".$lessons[0]->id; } ?>"><?php if($ii == 0) { echo 'No Lectures'; } else { echo 'Course Preview'; } ?></a></td> -->
            <?php
                $CI = & get_instance();
         $CI->load->model('program_model');
          $days = $CI->program_model->getlistDays($program ->id);

          $lessons = $CI->program_model->getLessons(@$days[0]->id);

      ?>

            <!-- <td class="enrol"><a onclick="viewsite2(<?php echo $program->id ?>,<?php echo @$days[0]->id ?>,<?php echo @$lessons[0]->id; ?>)">Course Preview</a></td> -->
            <!-- <td>Course Preview</td> -->
            <!--removed the re-order functionality -->
      <!--<td class=" ">
            
            <input type="text" name="order[<?php echo $program->id; ?>]" size="5" value="<?php echo $program->ordering ; ?>" class="text_area" style="text-align: center" />

         <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $program->id;?>" class="text_area" style="text-align: center" />
            
            </td>-->
  <div class="col-sm-12">
      <td class="pub no-padding">
      <?php

      if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

      {

      ?>

          <?php if($program->published){?>

              <a title="Publish Item" href="<?php echo base_url(); ?>admin/programs/unpublish/<?php echo $program ->id?>"><!-- <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"> --><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>
              
            <?php }else{?>

              <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/programs/publish/<?php echo $program ->id?>"><!-- <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"> --><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>

        </td>
   </div>
    <?php }?>

<?php

}

else

echo "No Access";

?>

            
            <td class="editdelete no-padding">
            <div class="col-sm-12 no-padding center" style="text-align: center;padding-left:5%!important;">
              <!--  <a href="" onclick="viewsite2(<?php echo $program->id ?>,<?php echo @$days[0]->id ?>,<?php echo @$lessons[0]->id; ?>)" class="col-sm-2 no-padding sprite_margin" target="_blank" id="pre_link" > -->
                
               <?php if($ii == 0){ ?>
               <a href="javascript:void()" class="col-sm-2 no-padding sprite_margin" target="_blank" id="pre_link" >
               <i class="entypo entypo-block" title="No Preview"></i>
               <?php } 
               else { ?>
               <a href="<?php echo base_url(); ?>admin/course/preview/<?php echo $program->id ?>/<?php echo @$days[0]->id ?>/<?php echo @$lessons[0]->id; ?>" class="col-sm-2 no-padding sprite_margin" target="_blank" id="pre_link" >
                <div class='sprite 5preview' style="background-position: -120px 0; height: 14px;" title="Preview"></div>
              </a>
           
            <?php
           }
if($program->course_type == '2' && $program->webstatus == 'active') {
?>
<a  class='col-sm-2 no-padding sprite_margin' href='<?php echo base_url(); ?>admin/programs/editwebinar/<?php echo $program ->id?>'>
<div class='sprite 7settings' style="background-position: -184px 0" title="Course Settings22"></div></a>
<?php } 
else
{
if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

{

?>

      <!-- <a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/programs/edit/<?php echo $program ->id?>'><i class="entypo-pencil"></i>edit</a> -->
      
      <a href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>" class='col-sm-2 no-padding sprite_margin'>
        <div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content">
        </div>
      </a>

      

<?php
}
?><a  class='col-sm-2 no-padding sprite_margin' href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'>
<div class='sprite 7settings' style="background-position: -184px 0" title="Course Settings11"></div></a>
<?php
} ?>
<a class="col-sm-2 no-padding sprite_margin copy_link" id="link_id<?php echo $program ->id?>">
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
        <!-- <input type='button' name='btnSubmit_<?php echo $program->id ?>' id='btnSubmit_<?php echo $program->id ?>' value='Copy Course' onclick="copyCourse('<?php echo $program->id ?>')" class='btn btn-primary copyCourse'> -->
              <!-- <a href="<?php echo base_url();?>admin/course-manager/" class="btn btn-default"> --><a href="" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span class="icon-32-cancel"> </span>Cancel</a>
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
      <a class="icon-left col-sm-2 no-padding" onClick="deleteconfirm(<?php echo $program->id?>)">
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
            <?php if($program->webstatus == 'active' && $program->course_type == '2') {
              // echo "<center>_</center>"; 
            } else { ?>
            <a href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>">
              <span class="sprite 2edit tab_icon" style="background-position: -32px 0;" title="Course Content">
             </span> COURSE CONTENT (<?php echo $ii;?>)
           </a>
           <?php } ?>
          </span>  
          <span class="grey_tabs">
            <a  class='' href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'><span class="sprite tab_icon" style="background-position: -184px 0" title="Course Settings33"></span>COURSE SETTINGS</a>
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
        <?php $urlCourse = strtolower($program->name);      
        $urlCourse = trim(str_replace(' ', '-', $urlCourse));
        $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse); ?>
        <div class="col-sm-12 no-padding center">
         <span class="grey_tabs">
          <?php
                  if($program->webstatus == 'active' && $program->course_type != '2') { ?>
                    <!-- <a href="<?php echo base_url() ?>admin/webinars/listings/<?php echo $program ->id; ?>"> -->
              <?php 
                echo 'Webinars ('.$webicount->count1.')';
                // </a>';
              }
              else if($program->webstatus == 'active' && $program->course_type == '2') { ?>
<!--                    <a href="<?php echo base_url() ?><?php echo $urlCourse; ?>/webinars/<?php echo $program ->id; ?>">
 -->              <?php 
                // echo '<center>_</center>';
              }
              else
              { ?> <a href="#">
               <?php
                echo 'Inactive Webinars'.'</a>';
              }
                ?>
          <!-- <a href="<?php  if($program->webstatus == 'active'  && $program->course_type != '2') { echo base_url().'admin/webinars/listings/'.$program ->id; } else { '#'; } ?>">
                <?php
                  if($program->webstatus == 'active')
                  {
                    //echo 'active';
                   //  echo 'Webinar ('.$webicount->count1.')';
                  }
                  else
                  {
                   // echo 'Inactive';
                  }
                ?>
           </a> -->
           </span>
           </div>
      </td>
      </div>
      </div>
      </div>
    </tr>
            
            
            
    
    <?php 
           $iii++;
    endforeach ?>

<?php else: ?>

<tr>

    <td colspan="8">

<?=lang('web_no_elements');?>

</td>


<?php endif ?>

</tbody>

 <?php echo form_close(); ?>

</tbody>
</table>
       
      
  <!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
  <div class="col-xs-6 col-left">
    <div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+@$iii; ?> of <?php echo $countprog; ?> entries</div>
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

</div>
 </div>
<!-- <input type="text" value="<?php ?>" id="confirmdel" > -->
<!--Copy popup-->

<!--Copy popup End -->

<!-- tool tip script --><script type="text/javascript">jQuery(document).ready(function(){ jQuery('.tooltipicon').click(function(){  var dispdiv = jQuery(this).attr('id');  jQuery('.'+dispdiv).css('display','inline-block');  }); jQuery('.closetooltip').click(function(){ jQuery(this).parent().css('display','none');  }); }); </script><!-- tool tip script finish -->

<!-- The JavaScript -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/tour/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
      $(function() {
        /*
        the json config obj.
        name: the class given to the element where you want the tooltip to appear
        bgcolor: the background color of the tooltip
        color: the color of the tooltip text
        text: the text inside the tooltip
        time: if automatic tour, then this is the time in ms for this step
        position: the position of the tip. Possible values are
          TL  top left
          TR  top right
          BL  bottom left
          BR  bottom right
          LT  left top
          LB  left bottom
          RT  right top
          RB  right bottom
          T   top
          R   right
          B   bottom
          L   left
         */
        var config = [
          {
            "name"    : "btn-success",
            "bgcolor" : "black",
            "color"   : "white",
            "position"  : "TR",
            "text"    : "Click here to create new Course.",
            "time"    : 5000
          },
          {
            "name"    : "btn-blue",
            "bgcolor" : "black",
            "color"   : "white",
            "position"  : "TR1",
            "text"    : "Click here to copy existing Course.",
            "time"    : 5000
          },
          {
            "name"    : "table",
            "bgcolor" : "black",
            "color"   : "white",
            "text"    : "Here the list of all Course.",
            "position"  : "BL",
            "time"    : 5000
          },
          {
            "name"    : "editdelete",
            "bgcolor" : "black",
            "color"   : "white",
            "text"    : "You can also Edit and Delete existing Course.",
            "position"  : "RT",
            "time"    : 5000
          },
          {
            "name"    : "pub",
            "bgcolor" : "black",
            "color"   : "white",
            "text"    : "Single click can change the status of Course.",
            "position"  : "RT1",
            "time"    : 5000
          },
          {
            "name"    : "enrol",
            "bgcolor" : "black",
            "color"   : "white",
            "text"    : "Click here to view details of enrolled students in Course.",
            "position"  : "RT2",
            "time"    : 5000
          },
          {
            "name"    : "webnr",
            "bgcolor" : "black",
            "color"   : "white",
            "text"    : "Click here to add webinar to the Course.",
            "position"  : "RT3",
            "time"    : 5000
          }

        ],
        //define if steps should change automatically
        autoplay  = false,
        //timeout for the step
        showtime,
        //current step of the tour
        step    = 0,
        //total number of steps
        total_steps = config.length;
          
        //show the tour controls
        showControls();
        
        /*
        we can restart or stop the tour,
        and also navigate through the steps
         */
        $('#activatetour').on('click',startTour);
        $('#canceltour').on('click',endTour);
        $('#endtour').on('click',endTour);
        $('#restarttour').on('click',restartTour);
        $('#nextstep').on('click',nextStep);
        $('#prevstep').on('click',prevStep);
        
        function startTour(){
          $('#activatetour').remove();
          $('#endtour,#restarttour').show();
          if(!autoplay && total_steps > 1)
            $('#nextstep').show();
          showOverlay();
          nextStep();
        }
        
        function nextStep(){
          if(!autoplay){
            if(step > 0)
              $('#prevstep').show();
            else
              $('#prevstep').hide();
            if(step == total_steps-1)
              $('#nextstep').hide();
            else
              $('#nextstep').show();  
          } 
          if(step >= total_steps){
            //if last step then end tour
            endTour();
            return false;
          }
          ++step;
          showTooltip();
        }
        
        function prevStep(){
          if(!autoplay){
            if(step > 2)
              $('#prevstep').show();
            else
              $('#prevstep').hide();
            if(step == total_steps)
              $('#nextstep').show();
          }   
          if(step <= 1)
            return false;
          --step;
          showTooltip();
        }
        
        function endTour(){
          step = 0;
          if(autoplay) clearTimeout(showtime);
          removeTooltip();
          hideControls();
          hideOverlay();
        }
        
        function restartTour(){
          step = 0;
          if(autoplay) clearTimeout(showtime);
          nextStep();
        }
        
        function showTooltip(){
          //remove current tooltip
          removeTooltip();
          
          var step_config   = config[step-1];
          var $elem     = $('.' + step_config.name);
          
          if(autoplay)
            showtime  = setTimeout(nextStep,step_config.time);
          
          var bgcolor     = step_config.bgcolor;
          var color     = step_config.color;
          
          var $tooltip    = $('<div>',{
            id      : 'tour_tooltip',
            class   : 'tooltipt',
            html    : '<p>'+step_config.text+'</p><span class="tooltip_arrow"></span>'
          }).css({
            'display'     : 'none',
            'background-color'  : bgcolor,
            'color'       : color
          });
          
          //position the tooltip correctly:
          
          //the css properties the tooltip should have
          var properties    = {};
          
          var tip_position  = step_config.position;
          
          //append the tooltip but hide it
          $('body').prepend($tooltip);
          
          //get some info of the element
          var e_w       = $elem.outerWidth();
          var e_h       = $elem.outerHeight();
          var e_l       = $elem.offset().left;
          var e_t       = $elem.offset().top;
          
          
          switch(tip_position){
            case 'TL' :
              properties = {
                'left'  : e_l,
                'top' : e_t + e_h + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');
              break;
            case 'TR' :
              properties = {
                'left'  : e_l + e_w - $tooltip.width() + 'px',
                'top' : e_t + e_h + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
              break;
            case 'TR1'  :
              properties = {
                'left'  : e_l + e_w - $tooltip.width() + 'px',
                'top' : e_t + e_h + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
              break;
            case 'BL' :
              properties = {
                'left'  : e_l + 'px',
                'top' : e_t - $tooltip.height() + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
              break;
            case 'BR' :
              properties = {
                'left'  : e_l + e_w - $tooltip.width() + 'px',
                'top' : e_t - $tooltip.height() + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');
              break;
            case 'LT' :
              properties = {
                'left'  : e_l + e_w + 'px',
                'top' : e_t + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');
              break;
            case 'LB' :
              properties = {
                'left'  : e_l + e_w + 'px',
                'top' : e_t + e_h - $tooltip.height() + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');
              break;
            case 'RT' :
              properties = {
                'left'  : e_l - $tooltip.width() + 'px',
                'top' : e_t + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
              break;
            case 'RT1'  :
              properties = {
                'left'  : e_l - $tooltip.width() + 'px',
                'top' : e_t + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
              break;
            case 'RT2'  :
              properties = {
                'left'  : e_l - $tooltip.width() + 'px',
                'top' : e_t + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
              break;
            case 'RT3'  :
              properties = {
                'left'  : e_l - $tooltip.width() + 'px',
                'top' : e_t + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
              break;
            case 'RB' :
              properties = {
                'left'  : e_l - $tooltip.width() + 'px',
                'top' : e_t + e_h - $tooltip.height() + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');
              break;
            case 'T'  :
              properties = {
                'left'  : e_l + e_w/2 - $tooltip.width()/2 + 'px',
                'top' : e_t + e_h + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');
              break;
            case 'R'  :
              properties = {
                'left'  : e_l - $tooltip.width() + 'px',
                'top' : e_t + e_h/2 - $tooltip.height()/2 + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');
              break;
            case 'B'  :
              properties = {
                'left'  : e_l + e_w/2 - $tooltip.width()/2 + 'px',
                'top' : e_t - $tooltip.height() + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');
              break;
            case 'L'  :
              properties = {
                'left'  : e_l + e_w  + 'px',
                'top' : e_t + e_h/2 - $tooltip.height()/2 + 'px'
              };
              $tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');
              break;
          }
          
          
          /*
          if the element is not in the viewport
          we scroll to it before displaying the tooltip
           */
          var w_t = $(window).scrollTop();
          var w_b = $(window).scrollTop() + $(window).height();
          //get the boundaries of the element + tooltip
          var b_t = parseFloat(properties.top,10);
          
          if(e_t < b_t)
            b_t = e_t;
          
          var b_b = parseFloat(properties.top,10) + $tooltip.height();
          if((e_t + e_h) > b_b)
            b_b = e_t + e_h;
            
          
          if((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)){
            $('html, body').stop()
            .animate({scrollTop: b_t}, 500, 'easeInOutExpo', function(){
              //need to reset the timeout because of the animation delay
              if(autoplay){
                clearTimeout(showtime);
                showtime = setTimeout(nextStep,step_config.time);
              }
              //show the new tooltip
              $tooltip.css(properties).show();
            });
          }
          else
          //show the new tooltip
            $tooltip.css(properties).show();
        }
        
        function removeTooltip(){
          $('#tour_tooltip').remove();
        }
        
        function showControls(){
          /*
          we can restart or stop the tour,
          and also navigate through the steps
           */
          var $tourcontrols  = '<div id="tourcontrols" class="tourcontrols">';
          //$tourcontrols += '<p>First time here?</p>';
          $tourcontrols += '<span class="button" id="activatetour" style="margin-left:30px;">Start the tour</span>';
            if(!autoplay){
              $tourcontrols += '<div class="nav"><span class="button" id="prevstep" style="display:none;">< Previous</span>';
              $tourcontrols += '<span class="button" id="nextstep" style="display:none;">Next ></span></div>';
            }
            $tourcontrols += '<a id="restarttour" style="display:none;">Restart the tour</span>';
            $tourcontrols += '<a id="endtour" style="display:none;">End the tour</a>';
            $tourcontrols += '<span class="close" id="canceltour" style="background-position: 5px 4px!important;"></span>';
          $tourcontrols += '</div>';
          
          $('body').prepend($tourcontrols);
          $('#tourcontrols').animate({'right':'295px'}, 500);
          
        }
        
        function hideControls(){
          $('#tourcontrols').remove();
        }
        
        function showOverlay(){
          var $overlay  = '<div id="tour_overlay" class="overlay"></div>';
          $('body').prepend($overlay);
        }
        
        function hideOverlay(){
          $('#tour_overlay').remove();
        }
        
      });
        </script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />

<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script>
var $ =jQuery.noConflict();

  function deleteconfirm(id) 
  {
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
          title: 'Do you really want to delete Course ?',
          content: ' ',
          confirm: function(){ 
               window.location.href = "<?php echo base_url(); ?>admin/programs/trash/"+id;
        
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
//   jQuery('a#pre_link').click(function() {
//  alert('hii');
//   $(this).attr('target', '_blank');
// }); 
</script>