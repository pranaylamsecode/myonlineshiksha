<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<script>
function saveorder(n, task) {
	checkAll_button(n, task);
}

function checkAll_button(n, task) {
	if (!task) {
		task = 'saveorder';
	}
    document.orderform.submit();
}
</script>

<?php
$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
$course = $this->uri->segment(4);
$coursename = $this->programs_model->getCoursename($course);
$name_c = $coursename[0]['name'];
$userid = $this->session->userdata['loggedin']['id'];
$last_visit = $this->programs_model->getViewedLesson($course,$userid);
$i = 0;
?>
<div class="main-container">
<div id="toolbar-box">
<div class="m">
<div id="toolbar" class="toolbar-list">

<?php
if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
{
?>
<ul style="list-style:none; float: right;">
<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
				<a href="<?php echo base_url(); ?>admin/course-manager" class="btn btn-blue">
				<span class="icon-32-new">
				</span>
				Back</a>
				</li>
</ul>

<?php
}
?>
<div class="clr"></div>
</div>

		<div class="pagetitle icon-48-generic"><h2>Students enrolled in " <?php echo $name_c;?> " Course</h2></div>

	</div>

</div>

<p class="pmaintitle main_subtitle">
Here you can manage all your courses. When you click on the course name, you get the course Table of Content. If you click Edit, you get the rest of the settings of this course.
</p>

<div>

    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>

    <span class="clearFix">&nbsp;</span>

</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/course-manager/',$attributes);
?>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row">
<div class="col-xs-6 col-left">
</div>
<div class="col-xs-6 col-right">    
</div>
</div>
<div class="clear"></div>
<?php echo form_close(); ?>


<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
   
		<tr role="row">
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Full Name</div></th>
                  
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">User Name</div></th>
			
			<!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Email</th>-->
			<th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Progress</div></th>
			<th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Last Visit</div></th>
			<th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Enrolled On</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Enrollment</div></th>
			<th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Report</div></th>
			<th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Quiz</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Remove Enrollment</div></th>
        </tr>
	</thead>

<?php
$this->load->model('admin/programs_model');
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'admin/course-manager/',$attributes);
?>

<?php if ($enroll): 
?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>

<?php 
foreach ($enroll as $enrolled): 
$enrollstu = $this->programs_model->getUserInfo($enrolled['userid']);
//select first_name,title from mlms_users,mlms_groups where mlms_users.group_id = mlms_groups.id
if(isset($enrollstu->id) !='')
{
//code for showing progress of students
$completedprogress = $this->programs_model->courseCompleted($enrolled['userid'],$enrolled['course_id']);

$getview = $this->programs_model->getViewLesson($enrolled['course_id'],$enrolled['userid']);
$getpro = $getview[0]['module_id'];
if($getpro)
{
	$getarray = explode('|',$getpro);
	$module_id = @$getarray[1];
	$course_id = $enrolled['course_id'];	
	$getModule = $this->programs_model->getModuleName($module_id);
	$getCourse = $this->programs_model->getProgramName($course_id);
	$string = '<b>Module :</b>' . $getModule .'<b>, Section :</b>' .$getCourse.' Completed';
}
else
{
	$string = '';
}

@$last_visit = $completedprogress->date_last_visit;
?>		 
<tr class="odd camp<?php echo $i;?>">
<!--<td class=" sorting_1">
<div class="checkbox checkbox-replace neon-cb-replacement">
	<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
</div>
</td>-->
			
<td class="field-title" style="text-transform: capitalize;color: #949494;"><?php echo $this->programs_model->getUserName($enrolled['userid']);?></td>
<td class="field-title" style="text-transform: capitalize;color: #949494;"><?php echo $this->programs_model->getUserNameEmail($enrolled['userid']);?></td>
<td class="field-title" style="text-transform: capitalize;color: #949494;"><?php echo $string;?></td>
<td class="field-title" style="text-transform: capitalize;color: #949494;"><?php echo $last_visit;?></td>
<td class="field-title" style="text-transform: capitalize;color: #949494;"><?php echo $enrolled['buy_date']?></td>
<!--<td class=" "><?php //echo $last_visit[$i]->date_last_visit?></td>-->
<td class="field-title" style="text-transform: capitalize;color: #949494;text-align:center!important;">
<?php
$i++;

if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
{
?>
			<!--<a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/programs/edit/<?php echo $program ->id?>'><i class="entypo-pencil"></i>edit</a>-->
			<?php
			if($enrolled['status']==2)
			{
			?>
			<a  title="Disallow" onClick="return confirm('<?php echo 'Are you want to allow the student ?'?>')" href='<?php echo base_url(); ?>admin/programs/getenrollstudent/<?php echo $enrollstu->id?>/<?php echo $enrolled['course_id']; ?>'>
			<div class="sprite 999publish center" style=" background-position: -308px 0;"></div></a>
			<?php
			}
			else
			{
			?>
			<a  title="Allow" onClick="return confirm('<?php echo 'Are you want to disallow the student ? '?>')" href='<?php echo base_url(); ?>admin/programs/trashEnrollstudent/<?php echo $enrollstu->id?>/<?php echo $enrolled['course_id']; ?>'>
			<div class="sprite 9999published center" style="background-position: -340px 0;"></div>
			</a>
			<?php
			}
			?>
			<td class=" " align="center"><a title="View" href='<?php echo base_url(); ?>admin/programs/viewuserreport/<?php echo $enrolled['userid']; ?>/<?php echo $enrolled['course_id']; ?>/'><div class="sprite 5preview" style="background-position: -120px 0; height: 14px;"></div></a></td>
			<?php
				$countquiz = $this->programs_model->getCountQuiz($enrolled['userid'],$enrolled['course_id']);
				if($countquiz > 0)
				{
				?>
				<td class=" "><a class="btn btn-blue" href='<?php echo base_url(); ?>admin/programs/viewuserquiz/<?php echo $enrolled['userid']; ?>/<?php echo $enrolled['course_id']; ?>/'>View (<?php echo $countquiz;?>)</a></td>
				<?php
				}
				else
				{
				?>
				<td></td>
				<?php
				}
				?>

<?php

}

else

echo "No Access";

?>

        </td>            
		<td><a title="Delete" class="col-sm-offset-4 col-sm-6" onClick="return confirm('<?php echo 'Are you want to Permantly Remove Enrollment of the student ? '?>')" href='<?php echo base_url(); ?>admin/programs/removeEnrollstudent/<?php echo $enrollstu->id?>/<?php echo $enrolled['course_id']; ?>/<?php echo $enrolled['id']; ?>'>
			<div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a></td>
		<?php
		}
		endforeach ?>

<?php else: ?>
</tr>
<tr>

    <td colspan="9">

<?=lang('web_no_elements');?>

</td>

</tr>

<?php endif ?>

</tbody>

 <?php echo form_close(); ?>

</tbody>
</table>
       
      
<div class="row">
 <div class="col-xs-6 col-left">
 	<div class="dataTables_info" id="table-2_info"><!-- Showing 1 to 8 of 60 entries --></div>
 </div>
 
 <div class="col-xs-6 col-right">
 <div class="dataTables_paginate paging_bootstrap">
<?php echo $this->pagination->create_links();  ?>
  </div>
  
  </div>
</div>
</div>
<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->