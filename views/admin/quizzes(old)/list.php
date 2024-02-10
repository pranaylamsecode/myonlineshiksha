<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<?php
	$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
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
        <a href="<?php echo base_url(); ?>admin/create/exam-paper" onclick="Joomla.submitbutton('edit')" class="btn btn-success btn-green">
       <i class="fas fa-plus" style="font-size: 11px;margin-right: 2px;position: relative;top: -1px"></i>
    	<span class="icon-32-new">
    	</span>
    	New Exam
    	</a>
    	
    	<a href="<?php echo base_url(); ?>admin/copy/exam-paper" onclick="Joomla.submitbutton('edit')" class="btn">
      <i class="entypo entypo-docs"></i>
    	<span class="icon-32-new">
    	</span>
    	Copy
    	</a>

       <a href="<?php echo base_url(); ?>admin/questions/"  class="btn btn-success btn-green">
        <i class="entypo entypo-popup"></i>
      <span class="icon-32-new">
      </span>
      Question Bank
      </a>

    	</li>
	</ul>
<?php
}
?>
	<div class="clr"></div>
	</div>
	<div class="pagetitle icon-48-generic"><h2><?php echo 'Exam Manager';?></h2></div>
	</div>
</div>
<div class="pexampaper"><p class="pmaintitle main_subtitle">Create and manage exams to be inserted into your course.</p></div>
<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/quizzes/',$attributes);
?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">
<div class="col-sm-12 top-head-box">

    <!-- <div id="table-3_length" class="dataTables_length"> -->
    <div id="table-3_length">
	    <span style="margin-right:1%;">
      	<input type="text" class="form-control form-height" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Exam Title">
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
        <option value="0">Term Exams</option>
        <option value="1">Final Exams</option>
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

      <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Exam</div></th>
                         
      <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Category</th>-->

      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Type</div></th>
      
      <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Questions</div></th>

      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Exam Total Marks</div></th>
      
       <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Students</div></th>
       
       <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Export</th>
       
      <th>Re-order<a href="javascript: saveorder(4, 'saveorder')" class="saveorder"></a></th>  
      
      <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Re-order<a class="saveorder" href="javascript: saveorder(<?php echo count($quizzes)-1; ?>, 'saveorder')">__</a></th> -->

      <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Published</div></th>
      
      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
      
  </tr>
</thead>
<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'admin/quizzes/',$attributes);
?>
<?php if ($quizzes): /*echo '<pre>';print_r($quizzes);echo '</pre>';*/?>


<tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">
<?php
$i=0;
$iii = 0;
foreach ($quizzes as $quiz): ?>
			<!--<td class="camp<?php echo $i;?>">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
            <!--<td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $quiz->id?>">--><!--</td> --> 
            <!--<td><?php //echo $quiz->id;?></td> -->
			<td class="field-title" style="text-transform: capitalize;color: #949494;"> 
			
			<?php echo $quiz->exam_title?>
        	
         	</td>
			<!--<td class=" "></td>-->
			<td class="field-title" style="text-transform: capitalize;color: #949494;"><?php echo ($quiz->is_final == 0) ? 'Term Exam' : 'Final Exam';?></td>
	    <?php  
          $CI = & get_instance();
          $CI->load->model('admin/questions_model');
          $quiz_quesarr = $this->quizzes_model->get_count_ques($quiz->id); 

          if(!empty($quiz_quesarr))
          {
            $quescore1 =0;    
            $cnt = explode(',', $quiz_quesarr->quizzes_ids);

            $totalMarksOutOf =0;
            $totalMarksObtained =0;
            $CI = & get_instance();
            $CI->load->model('lessons_model');
  					$quizzes_ids = $CI->lessons_model->getQuestionIds($quiz->id);
            
    					foreach($quizzes_ids as $ids)
      				{
    						//$idd = explode(',', $ids->quizzes_ids);
    						$cnt = explode(',', $ids->quizzes_ids);
    						foreach($cnt as $key=>$my_quiz)
    						{
    							$data_right = $CI->lessons_model->getQuizRightAnswersForPendings($my_quiz);	    													
    							foreach($data_right as $correctans)
    							{
    								if($correctans->is_correct_answer == 1  || $correctans->is_correct_answer == 'True'  || $correctans->is_correct_answer == 'False'  || $correctans->ans_option == 'subjective' || $correctans->question_type == 'match_the_pair' || ($correctans->question_type == 'multiple_type' && $correctans->is_correct_answer == 0))
               		  {
                  	    $totalMarksOutOf+= $correctans->points;
               			}    											
    							}
    						}
    						//echo $totalMarksOutOf;
    					}
          }
	                	
          ?>
          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php  echo (!empty($quiz_quesarr->quizzes_ids)) ? count(explode(',', $quiz_quesarr->quizzes_ids)) : '0' ?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php  echo ($quiz_quesarr) ? $totalMarksOutOf : '0' ?></td>
          <td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;"><a href="<?php echo base_url(); ?>admin/quizzes/quizstudents/<?php echo $quiz->id;?>/"><?php echo $this->quizzes_model->get_count_students2($quiz->id)?></a>
          </td>

            <!--<td class=" "></td>			
            <td class=" " align="center">
            <input type="text" name="order[<?php echo $quiz->id; ?>]" size="5" value="<?php echo $quiz->ordering ; ?>" class="text_area" style="text-align: center" />
            <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $quiz->id;?>" class="text_area" style="text-align: center" />
        	</td>-->
            
            <td  align="center">
			<?php
if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
{
?>
		<?php if($quiz->published){?>
		<!-- <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/quizzes/unpublish/<?php echo $quiz ->id?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a> -->
    <a title="Click to unpublish exam" href="<?php echo base_url(); ?>admin/quizzes/unpublish/<?php echo $quiz ->id?>/"><div class="sprite 9999published center" style="background-position: -340px 0;"></div></a>
		<?php }else{?>
		<!-- <a title="Publish Item" href="<?php echo base_url(); ?>admin/quizzes/publish/<?php echo $quiz ->id?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a> -->
    <a title="Click to publish exam" href="<?php echo base_url(); ?>admin/quizzes/publish/<?php echo $quiz ->id?>/"><div class="sprite 999publish center" style=" background-position: -308px 0;"></div></a>
		<?php }?>
<?php
}
else
echo "No Access";
?></td>
			<td class=" ">
            
            <?php
if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
{
?>
        <?php if($quiz->is_final == 0){?>  <!-- disabled -->
        <!-- <a class='btn btn-default btn-sm btn-icon icon-left'  href='<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz->id?>'><i class="entypo-pencil"></i><?php echo lang('web_edit')?>
        </a> -->
        <a class='col-sm-offset-3 col-sm-4 no-padding'  href='<?php echo base_url(); ?>admin/edit/exam-paper/<?php echo $quiz->id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div>
        </a>
        <?php }else{ ?>
        <!-- <a class='btn btn-default btn-sm btn-icon icon-left'  href='<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz->id?>'><i class="entypo-pencil"></i><?php echo lang('web_edit')?>
        </a> -->
        <a class='col-sm-offset-3 col-sm-4 no-padding'  href='<?php echo base_url(); ?>admin/edit/exam-paper/<?php echo $quiz->id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div>
        </a>
        <?php } ?>

       
<?php
}

if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='own'))
{
?>
    <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/quizzes/delete/<?php echo $quiz->id?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
    <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return deleteconfirm(<?php echo $quiz->id?>);" ><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a>  -->
    <a class='col-sm-4' onClick="return deleteconfirm(<?php echo $quiz->id?>);" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a> 
    <?php 
        $typeid = $this->quizzes_model->getTypeIdNew($quiz->id);

        $pid = $this->quizzes_model->getProgramByFinalquizId($quiz->id);

        if(count($typeid) > 0)
        {
          ?>
          <input type="hidden" value="1" id="id_<?php echo $quiz->id?>">
          <?php
        }else if($pid)
        {
          ?>
           <input type="hidden" value="1" id="id_<?php echo $quiz->id?>">
          <?php
        }else
        {
          ?>
          <input type="hidden" value="0" id="id_<?php echo $quiz->id?>">
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
		endforeach ?>
		
		  <?php else: ?>



           <tr><td colspan="11">


		          <p class='text'>No exam created yet. <a style="color: #2196f3" href="<?php echo base_url('admin/create/exam-paper'); ?>">Add a new exam</a></p>
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
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countquiz; ?> entries</div>
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


<script type="text/javascript">
var $ =jQuery.noConflict();
function deleteconfirm(id) 
{
  var isit = $("#id_"+id).val();
                                  if(isit == 1)
                                  {
                                          $.alert({
                                           title: 'Sorry!',
                                   content: 'User are ramains to take this Exam. You cannot delete this Exam.',
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
         title: 'Do you really want to delete Exam ?',
         content: ' ',
         confirm: function(){ 
                          window.location.href = "<?php echo base_url(); ?>admin/quizzes/delete/"+id;
                      },

          cancel: function()
          {        
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