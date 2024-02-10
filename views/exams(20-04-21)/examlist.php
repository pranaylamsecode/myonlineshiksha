<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
<script>
function saveorder(n, task) 
{
  checkAll_button(n, task);
}
function checkAll_button(n, task) 
{
  if (!task) {
    task = 'saveorder';
  }
    document.orderform.submit();
}
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
  $u_data=$this->session->userdata('logged_in');
  $maccessarr=$this->session->userdata('maccessarr');
?>
<style>
label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
/*css*/
.jconfirm .jconfirm-box div.title {
  background-color: #f1f1f1!important;
  color: #333;
  text-transform: uppercase!important;
  font-size: 18px!important;
  line-height: 28px;
  font-weight: 400!important;
  text-align: center!important;
  padding: 4% 2% 2% 2% !important;
  border-bottom: 0px!important;
  height: 65px!important;
  font-family:'AvenirNextLTPro-Demi'!important;
  border-radius: 6px;
}
.jconfirm .jconfirm-box .buttons {
  padding: 3% 15px 4%!important;
  border-top: 1px dotted #999;
}
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  padding-left: 20px!important;
  padding-right: 20px!important;
  margin: 28px 0 28px 0!important;
  text-align: center!important;
  font-size: 16px;
  font-weight: 400!important;
  font-family: 'AvenirNextLTPro-Regular'!important;
}
/*.jconfirm .jconfirm-box div.content {
  padding: 0px;
  padding-left: 20px!important;
  padding-right: 20px!important;
  margin: 28px 0 10px 0!important;
  text-align: center!important;
  font-weight: bold!important;
}*/
@media(max-width:1095px){
.main-content .course_search {
  float: none!important;
  padding-bottom: 10px;
}
}
@media(max-width:768px){
.main-content .course_search {
  padding-left: 20px;
}
}
@media(max-width:600px){
.main-content .course_search {
  padding-left: 0px;
}
}
/*end of css*/
</style>

<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box;">
<?php
  $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?> 


<div class="main-content">
  <div class="row">

<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0; margin-right: 20px;">
  <a href="#" class="sidebar-collapse-icon with-animation">
    <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
    <i class="entypo-menu"></i>
  </a>
</div>

<div><p style="padding:0 10px;font-style: italic;">Here you can manage Exams Paper by selecting the question form Question Bank (available in the menu called "Manage Questions"). These Exam paper can thereby be inserted in the courses.</p></div>

<div id="sticky-anchor"></div>
<div id="sticky">

<?php
if(!empty($maccessarr['quizzes']))
{
  if(($maccessarr['quizzes']=='own'))
  {
  ?>    
   <!-- <a style="float: right; margin-right:10px; margin-top: 2px;">
      <?php // echo form_submit( 'submit', "Upload", "id='submit' class='btn btn-success'")); ?> -->
      <div style="display: none;">
  <form  enctype="multipart/form-data" id="upfile" method="post" action="<?php echo base_url(); ?>exams/excel_upload">
  <label>Upload Questions File here..<br>(only in .csv format)</label>            
    <input type='file' id="file_i" name="file_i" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
    <input type="submit" value="Upload" id="submitbtn" style="display: block;">
    <div id='mImg' style="display:none"><img style="max-width:225px;max-height:175px" src=""></div>
  </form>
</div>
  <a href="<?php echo base_url(); ?>exams/create" class="btn btn-success" style="float: right;"> <i class="entypo entypo-login"></i>
  New 
  </a> <!-- by jyoti -->

  <a href="<?php echo base_url(); ?>exams/copy" class="btn btn-orange" style="float: right; margin-right:10px;">
  <i class="entypo entypo-docs"></i> Copy
  </a>
  <?php
  }
}
?>
</div>
<div class="clr"></div>

<div>
    <?php if (isset($control)): ?>
      <a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>

<!--<form action="<?=site_url('admin/quizzes/')?>" method="post"> -->
<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
echo form_open_multipart(base_url().'manage-exams/',$attributes);
?>

<hr />


<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">

  
    <div class="course_search" style="float:left;">
  
        <input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Exam Title">

    <button type="submit" value="Search" name="submit_search" class="btn btn-info" style="margin-top: 0px;padding-left: 4px;"><i class="entypo entypo-search"></i>Search</button> 

    <button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: 0px;padding-left: 4px;"><i class="entypo entypo-cw"></i>Reset</button> 
  
    </div>

  
  
    <div class="course_search" style="float:right;">
    <label style="display: inline-block; margin-bottom:0px; padding:0px; width:auto;">
    Select type :

        <select name="type" size="1" onchange="document.topform11.submit()">
                <option value="">- select -</option>
        <option value="0">Term Exams</option>
        <option value="1">Final Exams</option>
         </select>
    </label>
      <label style="display: inline-block; margin-bottom:0px; padding:0px; width:auto;">
          Published status :
               <select name="status" onchange="document.topform11.submit()">
        <option value="">- select -</option>
                <option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>
        <option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>
        </select>
    </label>
    </div>
</div>

<div class="clear"></div>
<hr />
<?php echo form_close(); ?>

<div class="table-scroll-resp">
<table class="table table-bordered responsive">
<form action="<?php echo base_url();?>/admin/users" method="post" accept-charset="utf-8" class="tform" name="topform1" enctype="multipart/form-data"></form>
  <thead>   
    <tr>
          <!--<th>
        <div class="checkbox checkbox-replace neon-cb-replacement">
          <input type="checkbox" id="chk-1"><div class="checked"></div>
        </div>
      </th>-->
            
            <th style="width: 320px;">Exam</th>     
            <th>Type</th>            
            <th>Exam Content</th>
            <th>Exam Total Marks</th>            
            <th>Students</th>
            <th>Published</th>            
            <th>Options</th>            
        </tr>
  </thead>
<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'quizzes/',$attributes);
//echo form_open_multipart('manage-exams/',$attributes);
?>
<?php if ($quizzes): /*echo '<pre>';print_r($quizzes);echo '</pre>';*/?>


<tbody>
<?php $i=0;?>
<?php foreach ($quizzes as $quiz):  ?>

<tr class="odd camp<?php echo $i;?>">
      <!--<td>
        <div class="checkbox checkbox-replace neon-cb-replacement">
          <label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
        </div>
      </td>-->
            <!--<td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $quiz->exam_id?>">--><!--</td> --> 
            <!--<td><?php //echo $quiz->exam_id;?></td> -->
      <td> 
      <?php if($quiz->exam_type == '1'){  ?>
          <?php /* ?> <a href="<?php echo base_url(); ?>admin/quizzes/editFinalQuiz/<?php echo $quiz ->id?>/"> <?php */ ?>
      <?php echo $quiz->exam_title?>
          <?php }else{?>

          <?php /* ?> <a href="<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz ->id?>/"> <?php */ ?>
      <?php echo $quiz->exam_title?>

          <?php /* ?></a><?php */ ?>
          <?php } ?>
          </td>
      <!-- <td></td> -->
      <td><?php echo ($quiz->exam_type == 0) ? 'Term Exam' : 'Final Exam';?></td>
            <?php  
              // $qu = $this->exam_model->get_count_get($quiz->exam_id); 
              // print_r($qu); 

              $quiz_pagearr = $this->exam_model->get_count_page($quiz->exam_id);
              $quiz_secarr = $this->exam_model->get_count_sec($quiz->exam_id); 
              $quiz_quesarr = $this->exam_model->get_count_ques($quiz->exam_id); 
              // echo $quiz->exam_id; 
              // print_r($quiz_quesarr); exit('row');         
          ?>          
            <!-- <td class=" " align="center"><?php  echo ($quiz_quesarr) ? count(explode(',', $quiz_quesarr->quizzes_ids)) : '0' ?></td> -->
               <td class=" " align="center">

                <a>Page : </a><?php  echo (!empty($quiz_pagearr)) ? $quiz_pagearr : '0' ?><br>

                <a>Section : </a><?php  echo (!empty($quiz_secarr)) ?  $quiz_secarr : '0' ?><br>

               <a>Question : </a><?php  echo (!empty($quiz_quesarr->Qcount)) ?  $quiz_quesarr->Qcount : '0' ?>
                  
                </td>
               
            <td class=" " align="center"><?php  echo ($quiz->total_marks) ? $quiz->total_marks : '0' ?></td>
      <td align="center"><a href="<?php echo base_url(); ?>exams/student/<?php echo $quiz->exam_id;?>/"><?php echo $this->quizzes_model->get_count_students2($quiz->exam_id)?></a>
            </td>
            <!-- <td class=" "></td> -->
      
            <!-- <td align="center">
   <input type="text" name="order[<?php echo $quiz->exam_id; ?>]" size="5" value="<?php echo $quiz->ordering ; ?>" class="text_area" style="text-align: center" />
        <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $quiz->exam_id;?>" class="text_area" style="text-align: center" />
          </td> -->
            
            <td align="center">
      <?php
      if(!empty($maccessarr['quizzes']))
      {
if((@$maccessarr['quizzes']=='modify_all') || (@$maccessarr['quizzes']=='own'))
{
  ?>
  <?php if($quiz->published){?>
  <div style="margin: 0 auto;text-align: center;"><a title="Unpublish Item" href="<?php echo base_url(); ?>quizzes/unpublish/<?php echo $quiz ->id?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a></div>
  <?php }else{?>
  <div style="margin: 0 auto;text-align: center;">
  <a style="margin: 0 auto;text-align: center;" title="Publish Item" href="<?php echo base_url(); ?>quizzes/publish/<?php echo $quiz ->id?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a></div>
  <?php }?>
  <?php
}
}
else
echo "No Access";
?></td>
      <td>
            <div class="button-sect">
            <?php
            if(!empty($maccessarr['quizzes']))
      {
if((@$maccessarr['quizzes']=='modify_all') || (@$maccessarr['quizzes']=='own'))
{
?>
        <?php if($quiz->exam_type == 0){?>
        <a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>exams/edit_exam/<?php echo $quiz->exam_id?>'><!-- <?php echo lang('web_edit')?> --><i class="entypo-pencil"></i>
        </a>
        <?php }else{ ?>
        <a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>exams/edit_exam/<?php echo $quiz->exam_id?>'><!-- <?php echo lang('web_edit')?> --><i class="entypo-pencil"></i>
        </a>
        <?php } ?>
<?php
}
if((@$maccessarr['quizzes']=='own'))
{
  ?>
    <!-- <a class='btn btn-danger' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>quizzes/delete/<?php echo $quiz->exam_id?>'><?php echo lang('web_delete')?></a> -->

     <a class='btn btn-danger btn-del' title="Delete" onClick="return deleteconfirm(<?php echo $quiz->exam_id?>)" ><!-- <?php echo lang('web_delete')?> --><i class="entypo entypo-trash"></i></a>
  <?php 
  $typeid = $this->quizzes_model->gettypeid2($quiz->exam_id);
  $pid = $this->quizzes_model->getProgramByFinalquizId($quiz->exam_id);
  if($typeid)
  {
   ?>
  
  <input type="hidden" value="1" id="id_<?php echo $quiz->exam_id?>">
  <?php
  }
  else if($pid)
  {   
      ?>
      <input type="hidden" value="1" id="id_<?php echo $quiz->exam_id?>">
   <?php
     
  }
  else
  {
    ?>
    <input type="hidden" value="0" id="id_<?php echo $quiz->exam_id?>">
    <?php
  } 
  ?>
  <?php
}
}
else
echo "No Access";
?>
</div>
</td>
</tr>
<?php endforeach ?>
<?php else: ?>

<tr>
    <td colspan="10">
<!-- <?=lang('web_no_elements');?> -->
No exam paper created yet. <a href="<?php echo base_url(); ?>exams/create">Create a one now !</a>
</td>

</tr>
<?php endif ?>
</tbody>
<?php echo form_close(); ?>
</table>
</div>
</div>
<div class="containerpg">
<div class="pagination">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>
</div>    
</div> 
</div>
</div> 
<div class="clr"></div>
<script>
  $("#file_i").change(function(){
        if( $('#file_i').val()!=""){
            
            $('#remove_id').show();
            $('#blah').show('slow');
            $('#imgname').hide('slow');
      }
        else{ $('#remove_id').hide();$('#blah').hide('slow');}
        readURL(this);
    });
  
    $('#remove_id').click(function(){
          $('#file_i').val('');
          $(this).hide();
          $('#blah').hide('slow');
      $('#imgname').show('slow');
 $('#blah').attr('src','http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/No_pub.svg/150px-No_pub.svg.png');
});
</script>

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
    function deleteconfirm(id)
    { 

          var isit = $j("#id_"+id).val();
                                  // if(isit == 1)
                                  // {
                                  //         $j.alert({
                                  //          title: 'Sorry!',
                                  //  content: 'This exam may assign to courses.First, You should delete this exam from there.',
                                  //  confirm: function()
                                  //                  {
                                  //                          return true;
                                  //              //document.location.href = window.location.origin+'/admin/programs/';
                                  //                  }
                                  //              });
                                  // }
                                  // else
                                  // {
        $j.confirm({
          title: 'Do you really want to delete this exam ?',
          content: ' ',
          confirm: function(){
                window.location.href = "<?php echo base_url(); ?>exams/examdelete/"+id;
               },
          cancel: function(){
              
             }
        });
    // }
  }
    </script>