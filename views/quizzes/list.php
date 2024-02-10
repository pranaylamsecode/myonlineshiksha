<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />

<style type="text/css">
  .sidebar-menu.sb-left {
    display: none;
}
#left_menu_sidebar {
  display: none;
}
.sidebar-collapse.sb-toggle-left {
  display: none;
}
</style>
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
<div style="background-color: #F5F5F5">
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

<div><p class="right_course_txt">Here you can manage Exams Paper by selecting the question form Question Bank (available in the menu called "Manage Questions"). These Exam paper can thereby be inserted in the courses.</p></div>

<div id="sticky-anchor"></div>
<div id="sticky">

<?php
if(!empty($maccessarr['quizzes']))
{
  if(($maccessarr['quizzes']=='own'))
  {
	?>    
    <!-- <a href="<?php echo base_url(); ?>quizzes/create" onclick="Joomla.submitbutton('edit')" class="btn btn-success" style="float: right;"> -->
	<a href="<?php echo base_url(); ?>exams/create" class="btn btn-success" style="float: right;"> <i class="entypo entypo-login"></i>
	New
	</a>
	
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


<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">

  
    <div class="course_search" style="float:right;">
	
      	<input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Exam Title">

		<button type="submit" value="Search" name="submit_search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button> 

		<!-- <button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: 0px;padding-left: 4px;"><i class="entypo entypo-cw"></i>Reset</button>  -->
  
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
<?php echo form_close(); ?>

<div class="table-scroll-resp">
<table class="table table-bordered responsive inner_pages_table">
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
            <th>Questions</th>
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
<?php foreach ($quizzes as $quiz): ?>
<tr class="odd camp<?php echo $i;?>">
			<!--<td>
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
            <!--<td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $quiz->id?>">--><!--</td> --> 
            <!--<td><?php //echo $quiz->id;?></td> -->
			<td class="product_name"> 
			<?php if($quiz->is_final == '1'){  ?>
       		<?php /* ?> <a href="<?php echo base_url(); ?>admin/quizzes/editFinalQuiz/<?php echo $quiz ->id?>/"> <?php */ ?>
			<?php echo $quiz->name?>
        	<?php }else{?>

       		<?php /* ?> <a href="<?php echo base_url(); ?>admin/quizzes/edit/<?php echo $quiz ->id?>/"> <?php */ ?>
			<?php echo $quiz->name?>

       	 	<?php /* ?></a><?php */ ?>
         	<?php } ?>
         	</td>
			<!-- <td></td> -->
			<td><?php echo ($quiz->is_final == 0) ? 'Term Exam' : 'Final Exam';?></td>
            <?php  
           		$quiz_quesarr = $this->quizzes_model->get_count_ques($quiz->id);           
	        ?>	        
            <!-- <td class=" " align="center"><?php  echo ($quiz_quesarr) ? count(explode(',', $quiz_quesarr->quizzes_ids)) : '0' ?></td> -->
               <td class=" " align="center"><?php  echo (!empty($quiz_quesarr->quizzes_ids)) ? count(explode(',', $quiz_quesarr->quizzes_ids)) : '0' ?></td>
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
							//$data_right = $CI->lessons_model->getQuizRightAnswers($my_quiz);	
							$data_right = $CI->lessons_model->getQuizRightAnswersForPendings($my_quiz);						
							foreach($data_right as $correctans)
							{
								if($correctans->is_correct_answer == 1  || $correctans->is_correct_answer == 'True'  || $correctans->is_correct_answer == 'False'  || $correctans->ans_option == 'subjective' || $correctans->question_type == 'match_the_pair' || ($correctans->question_type == 'multiple_type' && $correctans->is_correct_answer == 0))
                     		    {
                        		 $totalMarksOutOf+= $correctans->points;
                     			}					
							}
						}
					}	
				}	                	
	            ?>
            <td class=" " align="center"><?php  echo ($quiz_quesarr) ? $totalMarksOutOf : '0' ?></td>
			<td align="center"><a href="<?php echo base_url(); ?>exams/student/<?php echo $quiz->id;?>/"><?php echo $this->quizzes_model->get_count_students2($quiz->id)?></a>
            </td>
            <!-- <td class=" "></td> -->
			
            <!-- <td align="center">
   <input type="text" name="order[<?php echo $quiz->id; ?>]" size="5" value="<?php echo $quiz->ordering ; ?>" class="text_area" style="text-align: center" />
        <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $quiz->id;?>" class="text_area" style="text-align: center" />
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
        <?php if($quiz->is_final == 0){?>
        <a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>quizzes/edit/<?php echo $quiz->id?>'><!-- <?php echo lang('web_edit')?> --><i class="entypo-pencil"></i>
        </a>
        <?php }else{ ?>
        <a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>quizzes/edit/<?php echo $quiz->id?>'><!-- <?php echo lang('web_edit')?> --><i class="entypo-pencil"></i>
        </a>
        <?php } ?>
<?php
}
if((@$maccessarr['quizzes']=='own'))
{
	?>
		<!-- <a class='btn btn-danger' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>quizzes/delete/<?php echo $quiz->id?>'><?php echo lang('web_delete')?></a> -->

		 <a class='btn btn-danger btn-del' title="Delete" onClick="return deleteconfirm(<?php echo $quiz->id?>)" ><!-- <?php echo lang('web_delete')?> --><i class="entypo entypo-trash"></i></a>
	<?php 
	$typeid = $this->quizzes_model->gettypeid2($quiz->id);
	$pid = $this->quizzes_model->getProgramByFinalquizId($quiz->id);
	if($typeid)
	{
	 ?>
	
	<input type="hidden" value="1" id="id_<?php echo $quiz->id?>">
	<?php
	}
	else if($pid)
	{		
	   	?>
	    <input type="hidden" value="1" id="id_<?php echo $quiz->id?>">
	 <?php
	   
	}
	else
	{
		?>
		<input type="hidden" value="0" id="id_<?php echo $quiz->id?>">
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
                                  if(isit == 1)
                                  {
                                          $j.alert({
                                           title: 'Sorry!',
                                   content: 'This exam may assign to courses.First, You should delete this exam from there.',
                                   confirm: function()
                                                   {
                                                           return true;
                                               //document.location.href = window.location.origin+'/admin/programs/';
                                                   }
                                               });
                                  }
                                  else
                                  {
    		$j.confirm({
    			title: 'Do you really want to delete this exam ?',
    			content: ' ',
    			confirm: function(){
        				window.location.href = "<?php echo base_url(); ?>quizzes/delete/"+id;
   						 },
    			cancel: function(){
        			
   					 }
				});
		}
	}
    </script>