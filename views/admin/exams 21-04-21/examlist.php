<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<?php
  $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
  $first = $start + 1; 
?>
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

         <div style="display: none;">
  <form  enctype="multipart/form-data" id="upfile" method="post" action="<?php echo base_url(); ?>admin/exams/excel_upload">
  <label>Upload Questions File here..<br>(only in .csv format)</label>            
    <input type='file' id="file_i" name="file_i" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
    <input type="submit" value="Upload" id="submitbtn" style="display: block;">
	</form>
</div>
<style>
/*a:hover {
    color: #f32148!important;
    text-decoration: underline!important;
}*/
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
.dataTables_paginate.paging_bootstrap{
 background: #f3f4f7;
 border: 0px;
}
#table-2_info.dataTables_info{
   background: #f3f4f7;
   border: 0px;
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
</style>
<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
?>
<div class="main-container">
<div id="toolbar-box">
<div class="m">
<div id="toolbar" class="toolbar-list">
<?php
if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='own'))
{
?>
<div id="sticky-anchor"></div>
  <ul id="sticky" style="list-style: none; float: right;">
      <li id="toolbar-new" class="listbutton">
        <a href="<?php echo base_url(); ?>admin/exams/create" onclick="Joomla.submitbutton('edit')" class="btn btn-success btn-green">
       <i class="fas fa-plus" style="font-size: 11px;margin-right: 2px;position: relative;top: -1px"></i>
      <span class="icon-32-new">
      </span>
      New Quiz
      </a>
      
     <!--  <a href="<?php echo base_url(); ?>admin/copy/exam-paper" onclick="Joomla.submitbutton('edit')" class="btn">
      <i class="entypo entypo-docs"></i>
      <span class="icon-32-new">
      </span>
      Copy
      </a>
 -->
      <!--  <a href="<?php echo base_url(); ?>admin/questions/"  class="btn btn-success btn-green">
        <i class="entypo entypo-popup"></i>
      <span class="icon-32-new">
      </span>
      Question Bank
      </a> -->

      </li>
  </ul>
<?php
}
?>
   <div class="clr"></div>
	  <span id="message"></span>
  </div>
  <div class="pagetitle icon-48-generic"><h2><?php echo 'Quiz Manager';?></h2></div>
  </div>
</div>
<div class="pexampaper"><p class="pmaintitle main_subtitle">Create and manage quiz to be inserted into your course.</p></div>

<div>
    <?php if (isset($control)): ?>
      <a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/exams/examlist/',$attributes);
?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">
<div class="col-sm-12 top-head-box">

    <!-- <div id="table-3_length" class="dataTables_length"> -->
    <div id="table-3_length">
      <span style="margin-right:1%;">
        <input type="text" class="form-control form-height" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Quiz Title">
      </span>
      <span style="margin-right:1%;">
        <select name="status" onchange="document.topform1.submit()" class="form-control form-height">
          <option value="">Published status</option>
                  <option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>
          <option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>
        </select>
      </span>
  <!-- </div> -->
  
  <!-- <div class="dataTables_filter" id="table-3_filter"> -->
    <!-- <div id="table-3_filter"> -->
      <span style="margin-right:1%;">
        <select name="type" size="1" class="form-control form-height" onchange="document.topform1.submit()">
                <option value="">Select</option>
        <option value="0">Term Quiz</option>
        <option value="1">Final Quiz</option>
         </select>
      </span>
      <span>
        <button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier" style="color: #666666;font-size: 23px;"></span></button>     
      </span>
    </div>
    
  </div>
</div>

<br>
<div class="clear"></div>

<?php echo form_close(); ?>

<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<thead>
  <tr role="row">

      <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Quiz</div></th>
                         
      <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Category</th>-->

      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Type</div></th>
      
      <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Quiz Content</div></th>

      <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Total Marks</div></th>
      
       <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Assigned to Course</div></th>
 

     <!--  <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Published</div></th> -->
      
      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
      
  </tr>
</thead>
<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'admin/quizzes/',$attributes);

?>
<?php if ($quizzes): /*echo '<pre>';print_r($quizzes);echo '</pre>';*/?>


<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php
$i=0;
$iii = 0;
foreach ($quizzes as $quiz){ ?>
	<tr id="tr_<?php echo $quiz->exam_id ?>" class="odd" >
      <!--<td class="camp<?php echo $i;?>">
        <div class="checkbox checkbox-replace neon-cb-replacement">
          <label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
        </div>
      </td>-->
            <!--<td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $quiz->id?>">--><!--</td> --> 
            <!--<td><?php //echo $quiz->id;?></td> -->
      <td class="field-title" style="text-transform: capitalize;color: #949494;"> 
      
      <?php echo $quiz->exam_title; ?>
          
          </td>
      <!--<td class=" "></td>-->
     <td><?php 
        switch ($quiz->exam_type) {
          case 1:
            echo 'Try and Learn';
            break;

          case 2:
            echo 'Regular Quiz';
            break;

          case 3:
            echo 'Survey - Feedback';
            break;
          
          default:
            echo "";
            break;
        }
     ?></td>

          <?php  
          $CI = & get_instance();
              // $qu = $this->exam_model->get_count_get($quiz->exam_id); 
              // print_r($qu); 

              // $quiz_pagearr = $CI->exam_model->get_count_page($quiz->exam_id);
              $quiz_secarr = $CI->exam_model->get_count_sec($quiz->exam_id); 
              $quiz_quesarr = $CI->exam_model->get_count_ques($quiz->exam_id); 
              // echo $quiz->exam_id; 
              // print_r($quiz_quesarr); exit('row');         
          ?>  

          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">
            <!-- <a>Page : </a><?php  echo (!empty($quiz_pagearr)) ? $quiz_pagearr : '0' ?><br> -->

                <a>Section : </a><?php  echo (!empty($quiz_secarr)) ?  $quiz_secarr : '0' ?><br>

               <a>Question : </a><?php  echo (!empty($quiz_quesarr->Qcount)) ?  $quiz_quesarr->Qcount : '0' ?>
             </td>


          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php  echo ($quiz->total_marks) ? $quiz->total_marks : '0' ?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494;">
            <!-- <a href="<?php echo base_url(); ?>admin/exams/student/<?php echo $quiz->exam_id;?>/"><?php //echo $this->quizzes_model->get_count_students2($quiz->exam_id)?></a> -->

            <?php $assign = $CI->exam_model->getAssignCourse($quiz->exam_id); 
            // print_r($assign);
            if($assign)
                  echo "<b>Course: </b>".$assign->course."<br><b>Lecture: </b>".$assign->lecture;
                else echo "<center>_</center>";
            ?>
          </td>

            <!--<td class=" "></td>     
            <td class=" " align="center">
            <input type="text" name="order[<?php echo $quiz->id; ?>]" size="5" value="<?php echo $quiz->ordering ; ?>" class="text_area" style="text-align: center" />
            <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $quiz->id;?>" class="text_area" style="text-align: center" />
          </td>-->
            
<!--             <td  align="center">
      <?php
//if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
{
?>
    <?php if($quiz->published){?>
   
    <a title="Unpublish Item" href="<?php echo base_url(); ?>quizzes/unpublish/<?php echo $quiz ->id?>/"><div class="sprite 9999published center" style="background-position: -340px 0;"></div></a>
    <?php }else{?>
  
    <a style="margin: 0 auto;text-align: center;" title="Publish Item" href="<?php echo base_url(); ?>quizzes/publish/<?php echo $quiz ->id?>/"><div class="sprite 999publish center" style=" background-position: -308px 0;"></div></a>
    <?php }?>
<?php
}
//else
//echo "No Access";
?></td> -->
      <td class=" ">
            
            <?php
if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
{
?>
        <?php if($quiz->is_final == 0){?>  <!-- disabled -->
        <!-- <a class='btn btn-default btn-sm btn-icon icon-left'  href='<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz->id?>'><i class="entypo-pencil"></i><?php echo lang('web_edit')?>
        </a> -->
        <a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>admin/exams/edit_exam/<?php echo $quiz->exam_id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div>
        </a>
        <?php }else{ ?>
        <!-- <a class='btn btn-default btn-sm btn-icon icon-left'  href='<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz->id?>'><i class="entypo-pencil"></i><?php echo lang('web_edit')?>
        </a> -->
        <a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>admin/exams/edit_exam/<?php echo $quiz->exam_id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div>
        </a>
        <?php } ?>

       
<?php
}

if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='own'))
{
?>
    <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/quizzes/delete/<?php echo $quiz->id?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
    <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return deleteconfirm(<?php echo $quiz->id?>);" ><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a>  -->
       <a class='btn btn-del' title="Delete" onClick="return deleteconfirm(<?php echo $quiz->exam_id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a> 
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
else
echo "No Access";
?>
            
      </td>
    </tr>
        <?php 
         $iii++;
   }?>
    
      <?php else: ?>



           <tr><td colspan="11">


              <p class='text'>No Quiz created yet. <a href="<?php echo base_url(); ?>admin/exams/create">Add a new quiz</a></p>
          </td>
              </tr>





             <?php endif ?>
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
                                
        $j.confirm({
          title: 'Do you really want to delete the quiz?',
          content: ' ',
          confirm: function(){
          	 $.post("<?php echo base_url(); ?>admin/exams/examdelete/"+id, function(response){ 
          	 	// alert("delete"+response);
                        	if(response == "success"){
                 //        		 $.alert({
					            //     title: 'The chapter has been deleted.',
					            //     content: ' ',
					            // });
                        		 // $(document).find('#message').html('');
                        		  var note = $(document).find('#message');
			            note.html('<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>The Quiz has been deleted.</div>');
			            note.show();
			            note.fadeIn().delay(3000).fadeOut();
                        		
								  $(document).find('#tr_'+id).remove();
                        		 						
                        	}
                        	else{
                        		 $.alert({
					                title: 'Quiz not deleted',
					                content: response,
					            });
                        	}
						      
						});


                // window.location.href = "<?php echo base_url(); ?>admin/exams/examdelete/"+id;
               },
          cancel: function(){
              
             }
        });
    // }
  }
    </script>