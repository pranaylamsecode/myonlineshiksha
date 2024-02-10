<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
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
  margin: 18px 0 8px 0!important;
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
   /*echo '<pre>';
	print_r($questions);
   echo '</pre>';*/
   
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('loggedin');
	$maccessarr=$this->session->userdata('maccessarr');
?>
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<?php
			if(($u_data['groupid']=='4') || ($maccessarr['users']=='own') )
			{
			?>	<div id="sticky-anchor"></div>
				<ul id="sticky" style="list-style:none; float: right;">
					<li id="toolbar-new" class="listbutton">
						<a href="<?php echo base_url(); ?>admin/questions/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">
						<i class="entypo entypo-popup"></i>
							<span class="icon-32-new"></span>New
						</a>
					</li>
				</ul>
			<?php 
			} 
			?>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Exam Questions Manager';?></h2></div>
	</div>
</div>

<div>
    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/questions/',$attributes);
?>
<div class="row">
  <div class="col-sm-12 top-head-box no-padding">
	
    <!-- <div id="table-3_length" class="dataTables_length"> -->
    <div id="table-3_length">
    	<span style="margin-right:1%;">
      		<input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-height form-control" placeholder="Exam Questions">
      	</span>	
	<!-- </div> -->
	
  
	
    <!-- <div class="dataTables_filter" id="table-3_filter"> -->
   <!--  <div id="table-3_filter"> -->
    	<span style="margin-right:1%;">
	        <select name="search_group" onchange="document.topform1.submit()" class="form-height form-control">
				<option value="">Question Group</option>
				<option value='regular' <?php //if($status == '1') echo "selected"; ?>>Regular</option> 				
				<option value='match_the_pair' <?php //if($status == '1') echo "selected"; ?>>Match The Pair</option>
				<option value='true_false' <?php //if($status == '1') echo "selected"; ?>>True / False</option> 
					<!--<option value='fill_in_the_blanks' <?php //if($status == '1') echo "selected"; ?>>Fill In The Blanks</option>-->
				<option value='multiple_type' <?php //if($status == '0') echo "selected"; ?>>Multiple Type</option>								
				<option value='media_type' <?php //if($status == '1') echo "selected"; ?>>Media Type</option> 				
			</select>
		</span>
		<span>
			<button type="submit" value="Search" name="submit_search" class="search-btn"><div class='sprite search' title="Search"></div></button>
			<button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>    
    	</span>
	</div>
	</div>
</div>
<br>
    <?php echo form_close(); ?>


<div class='clear'></div>
	<thead>
		<tr role="row">
	        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Question Tag</div></th>
    	    <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Question Type</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Question Marks</div></th>
            <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Question</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
        </tr>
	</thead>
	
	<?php
	$iii = 0;
	if ($questions): ?>	
	<tbody role="alert" aria-live="polite" aria-relevant="all">
	<?php $i=0;?>

	<?php 			
		foreach ($questions as $quest):
		$quescore = $this->questions_model->getAnsOptions2($quest->question_id);			
	     			
	 	
	$totalMarksOutOf =0;
	$totalMarksObtained =0;
	$CI = & get_instance();
	$CI->load->model('lessons_model');
	$quizzes_ids = $CI->lessons_model->getQuestionIds($quest->question_id);

	$data_right = $CI->lessons_model->getQuizMarks($quest->question_id);	
				
foreach($data_right as $rights)
{
	//for right answer							
	if($rights->question_type == 'match_the_pair')
	{								
		$totalMarksOutOf+= $rights->points;								
	}
	else if($rights->question_type == 'true_false')
	{							
		// if($rights->is_correct_answer == 'True')
		// {
		 	$totalMarksOutOf = $rights->points;
		// }
	}
	else if($rights->question_type == 'multiple_type')
	{								
		$totalMarksOutOf+= $rights->points;								
	}
	else if($rights->question_type == 'subjective')
	{								
		$totalMarksOutOf+= $rights->points;								
	}
	else 
	{
		$totalMarksOutOf = $rights->points;
	}

				
}

//echo $totalMarksOutOf;               	
?>


	<tr class="odd camp<?php echo $i;?>">
		<td class="field-title" style="text-transform: capitalize;color: #949494;"><?php echo $quest->question_tag;?></td>
        <td class="field-title " style="text-transform: capitalize;color: #949494;"><?php echo $quescore ? $quest->question_type :'';?></td>
        <td class="field-title " style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $totalMarksOutOf;?></td>
        <td class="field-title " style="text-transform: capitalize;color: #949494;"><?php echo $quest->question;?></td>
		
		<td class=" ">
            <?php
			if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all') || ($maccessarr['users']=='own'))
			{
				?>        <!-- disabled -->
				<a class='col-sm-offset-3 col-sm-4 no-padding'  href='<?php echo base_url(); ?>admin/questions/edit/<?php echo $quest ->question_id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>
				<?php
			}
	
			if(($u_data['groupid']=='4')  || ($maccessarr['users']=='own'))
			{
				?>
				<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/questions/delete/<?php echo $quest->question_id?>/<?php echo $this->uri->segment(3)?>'><i class="entypo-cancel"></i>Delete</a> -->
				<a class='col-sm-4' onClick="return deleteconfirm(<?php echo $quest->question_id?>,'<?php echo $this->uri->segment(3)?>');" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
				<?php
				$quizzez_ids = $this->questions_model->getQuizzesids();

       			 $msg = 0;

        		foreach($quizzez_ids as $quiz_id)
        		{
            		$quizid = explode(',', $quiz_id->quizzes_ids);

            		if(in_array( $quest->question_id, $quizid))
            		{
                		$msg = 'yes';
            		}
       			 }
        ?>
        <input type="hidden" value=" <?php echo $msg; ?>" id="id_<?php echo $quest->question_id ?>">
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
		<tr><td colspan="5">


		<p class='text'><?=lang('web_no_elements');?></p>
		</td>
        </tr>
	<?php endif ?>    
   </tbody>
</table>
 
<!--Pagination--> 
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countusers; ?> entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>
<?php } ?>
</div>
</div>

<script type="text/javascript">
var $ =jQuery.noConflict();
function deleteconfirm(id1,id2) 
       {
                  var isit = $("#id_"+id1).val();
                                  if(isit.trim() == "yes")
                                  {
                                          $.alert({
                                           title: 'Sorry!',
                                   content: 'You cannot delete this question. This question must be assigned to any of the course(s).',
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
                           title: 'Do you really want to delete ?',
                           content: ' ',
                           confirm: function(){ 
                                            window.location.href = "<?php echo base_url(); ?>admin/questions/delete/"+id1+"/"+id2;
       
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