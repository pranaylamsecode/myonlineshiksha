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
<style>
label {
 margin-bottom: 0px !important; 
 padding: 0px !important; 
}
</style>

<?php
$u_data=$this->session->userdata('logged_in');
$maccessarr=$this->session->userdata('maccessarr');
$course = $this->uri->segment(3);
$coursename = $this->program_model->getCoursename($course);
$name_c = $coursename[0]['name'];
$userid = $this->session->userdata['logged_in']['id'];
$last_visit = $this->programs_model->getViewedLesson($course,$userid);
$i = 0;
?>

<header>
       <section class="breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-sm-12">
         <h2>
           Students enrolled in " <?php echo $name_c;?> " Course
         </h2>
       </div>
     </div>
   </div>
 </section>
</header>


<div class="page-container">
<!-- <div class="sidebar-menu sb-left">
	<ul id="main-menu" class="" style="min-height:895px;">
        
      </ul>
     
</div> -->

<div>

    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>

    <span class="clearFix">&nbsp;</span>

</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'programs/',$attributes);
?>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row">
<div class="col-xs-6 col-left">
</div>
<div class="col-xs-6 col-right">    
</div>
</div>
<?php
		$this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
		?>
<div class="clear"></div>
<?php echo form_close(); ?>
 
<div class="main-content" style="min-height: 820px;">
	<div class="row">
    
	    <div class="sidebar-collapse sb-toggle-left" style="float:none; margin-top:5px; margin-left:20px; margin-bottom:10px;">
		<a href="#" class="sidebar-collapse-icon with-animation">
			<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
			<i class="entypo-menu"></i>
		</a>
		</div>
		
		<div class="panel-body with-table">

<table class="table table-bordered table-responsive" id="table-2" aria-describedby="table-2_info">
	<thead>
   
		<tr role="row">
          
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Full Name</th>
            
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">User Name</th>
			
			<!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Email</th>-->
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Progress</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Last Visit</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Enrolled On</th>
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Enrolled Students(Disable For Reason: 15-11-2014)</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Report</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Quiz</th>-->
            
        </tr>
	</thead>

<?php
$this->load->model('program_model');
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'programs/',$attributes);
?>

<?php if ($enroll): 
?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>

<?php 
error_reporting(0);
foreach ($enroll as $enrolled): 
$enrollstu = $this->program_model->getUserInfo($enrolled['userid']);
//select first_name,title from mlms_users,mlms_groups where mlms_users.group_id = mlms_groups.id
if(isset($enrollstu->id) !='')
{
//code for showing progress of students
$completedprogress = $this->program_model->courseCompleted($enrolled['userid'],$enrolled['course_id']);

$getview = $this->program_model->getViewUserLesson($enrolled['course_id'],$enrolled['userid']);
$getpro = $getview[0]['module_id'];
if($getpro)
{
	$getarray = explode('|',$getpro);
	$module_id = @$getarray[1];
	$course_id = $enrolled['course_id'];
	if(!empty($module_id))
	{	
	$getModule = $this->program_model->getModuleName($module_id);
	}
	else
	{
	$getModule= ' ';	
	}
	$getCourse = $this->program_model->getProgramName($course_id);
	$string = '<b>Module :</b>' . $getModule .'<b>, Section :</b>' .$getCourse.' Completed';
}
else
{
	$string = '';
}

/*if(isset($completedprogress->completed) && $completedprogress->completed == '1' )
{
   $progress = "Completed";
}
else
{
	$progress = "Not Completed";
}*/
	
@$last_visit = $completedprogress->date_last_visit;
?>		 
<tr class="odd camp<?php echo $i;?>">
<!-- <td class=" sorting_1">
<div class="checkbox checkbox-replace neon-cb-replacement">
	<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
</div>
</td> -->
			
<td class=" "><?php echo $this->program_model->getUserName($enrolled['userid']);?></td>
<td class=" "><?php echo $this->program_model->getUserNameEmail($enrolled['userid']);?></td>
<td class=" "><?php echo $string;?></td>
<td class=" "><?php echo $last_visit;?></td>
<td class=" "><?php echo $enrolled['buy_date']?></td>
<!--<td class=" "><?php //echo $last_visit[$i]->date_last_visit?></td>-->
           
	</tr>	
		<?php
		}
		endforeach ?>

<?php else: ?>

<tr>

    <td colspan="6">

<?=lang('web_no_elements');?>

</td>

</tr>

<?php endif ?>

</tbody>

 <?php echo form_close(); ?>

</tbody>
</table>
       
      
<!--<div class="row">
 <div class="col-xs-6 col-left">
 	<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div>
 </div>
 
 <div class="col-xs-6 col-right">
 <div class="dataTables_paginate paging_bootstrap">
<?php echo $this->pagination->create_links();  ?>
  </div>
  
  </div>
</div>-->



<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->


		</div> 

	</div>

</div>
</div>
</div>