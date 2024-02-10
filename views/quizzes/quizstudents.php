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

<?php
$u_data=$this->session->userdata('logged_in');
$maccessarr=$this->session->userdata('maccessarr');
$quiz = $this->uri->segment(3);
$quizname = ucfirst($this->quizzes_model->getQuizName($quiz));

$userid = $this->session->userdata['logged_in']['id'];
//$last_visit = $this->quizzes_model->getViewedLesson($course,$userid);
$i = 0;
?>

<header>
       <section class="breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-sm-12">
         <h2>Students given " <?php echo $quizname;?> " Exam</h2>
       </div>
     </div>
   </div>
 </section>
</header>

<div class="page-container">
<div class="sidebar-menu sb-left">
	<ul id="main-menu" class="" style="min-height:895px;">
        
      </ul>
</div>

<div>

    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>

    <span class="clearFix">&nbsp;</span>

</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('programs/',$attributes);
?>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row">
<div class="col-xs-6 col-left">
</div>
<div class="col-xs-6 col-right">    
</div>
</div>
<div class="clear"></div>
<?php echo form_close(); ?>

<div class="main-content" style="min-height: 820px;">
	<div class="row">
    	<p style="padding:0 10px;">Here you can see list of students which is envolved in the particular Exam. </p>
	    <div class="sidebar-collapse sb-toggle-left" style="float:none; margin-top:5px; margin-left:20px; margin-bottom:10px;">
		<a href="#" class="sidebar-collapse-icon with-animation">
			<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
			<i class="entypo-menu"></i>
		</a>
		</div>
		
		<div class="panel-body with-table">


<table class="table table-bordered table-responsive" id="table-2" aria-describedby="table-2_info">
<form action="<?php echo base_url();?>admin/users" method="post" accept-charset="utf-8" class="tform" name="topform1" enctype="multipart/form-data"></form>
	<thead>   
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Full Name</th>
            
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">User Name</th>
			  
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Quiz On</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Score</th>
            
        </tr>
	</thead>

<?php
$this->load->model('quizzes_model');
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart('programs/',$attributes);
?>

<?php if ($students): 
/*echo '<pre>';
print_r($enroll);
echo '</pre>';*/
?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php 
foreach ($students as $enrolled): 
$enrollstu = $this->quizzes_model->getUserInfo($enrolled['user_id']);
//select first_name,title from mlms_users,mlms_groups where mlms_users.group_id = mlms_groups.id
if(isset($enrollstu->id) !='')
{
?>		 
<tr class="odd camp<?php echo $i;?>">
<!--<td class=" sorting_1">
<div class="checkbox checkbox-replace neon-cb-replacement">
	<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
</div>
</td>-->					<?php 
						$urlName = strtolower($this->quizzes_model->getUserName($enrolled['user_id']));			
						$urlName = trim(str_replace(' ', '-', $urlName));
						$urlName = preg_replace('/[^A-Za-z0-9\-]/', '', $urlName);
						?>
	<td class=" "><a href='<?php echo base_url(); ?><?php echo $urlName; ?>/result/<?php echo $enrolled['user_id']; ?>/<?php echo $enrolled['quiz_id']; ?>/'><?php echo $this->quizzes_model->getUserName($enrolled['user_id']);?></a></td>		
<!-- <td class=" "><a href='<?php echo base_url(); ?>programs/viewresult/<?php echo $enrolled['user_id']; ?>/<?php echo $enrolled['quiz_id']; ?>/'><?php echo $this->quizzes_model->getUserName($enrolled['user_id']);?></a></td> -->
<td class=" "><?php echo $this->quizzes_model->getUserNameEmail($enrolled['user_id']);?></td>
<td class=" "><?php echo $enrolled['date_taken_quiz'];?></td>
<td class=" "><?php echo $enrolled['score_quiz'];?></td>

<?php

if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
{

}

else

echo "No Access";

?>
</td>            
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
    

</div></div></div></div></div>
      
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