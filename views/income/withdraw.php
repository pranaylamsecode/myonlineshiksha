<?php
	//echo '<pre>';
	//print_r($unwithdraw_list);
	 
		
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

<!--<div id="toolbar-box">
<div class="m">
<div id="toolbar" class="toolbar-list">


<ul style="list-style:none; float: right;">
</ul>


<div class="clr"></div>
</div>

	<div class="pagetitle icon-48-generic"><h2>Students enrolled in " <?php echo $name_c;?> " Course</h2></div>

	</div>

</div>-->

<div style="text-align:center; margin-bottom:5px;">
<h3>Students enrolled in " <?php echo $name_c;?> " Course</h3>
</div>

<div>

    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>

    <span class="clearFix">&nbsp;</span>

</div>

<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box;">
<div class="sidebar-menu sb-left">
<!-- Your left Slidebar content. -->
<!-- Classes Examples -->
	<ul id="main-menu">
		<li class="root-level"><a href="<?php echo base_url(); ?>programs/lists/"><span>My Courses</span></a></li>  
		<li class="root-level"><a href="<?php echo base_url(); ?>quizzes/"><span>My Quizzes</span></a></li>   
		<li class="root-level"><a href="<?php echo base_url(); ?>mcategories/"><span>Media Category</span></a></li>  
		<li class="root-level"><a href="<?php echo base_url(); ?>medias/"><span>Media Library</span></a></li>
	</ul>
</div>


<div class="main-content">
<div class="row">

<div class="sidebar-collapse sb-toggle-left">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu" ></i>
	</a>
</div>

<!--<div class="txt-pyara">
Here you can manage all your courses. When you click on the course name, you get the course Table of Content. If you click Edit, you get the rest of the settings of this course.
</div>-->







<div class="clr"></div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
echo form_open_multipart('programs/lists/',$attributes);
?>
<hr />

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">
    <div class="course_search" style="float:left;">
	
      	<input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" />

		<input type="submit" value="Search" name="submit_search" class="btn btn-info" />

		<input type="submit" value="Reset" name="reset" class="btn btn-danger" />
  
    </div>
	
	
  
	

</div>

<div class="clear"></div>
 <?php echo form_close(); ?>

<div class="table-scroll-resp">

<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info" style="width: 50%;float:left">

	<thead>
   
		<tr role="row">
           
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Name</th>
            
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Date of Purchased</th>
			
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Options</th>-->
			
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Amount</th>
			
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Re-order<a class="saveorder" href="javascript: saveorder(<?php echo count($programs)-1; ?>, 'saveorder')">__</a></th>-->

            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Term</th>-->
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Options</th>-->
            
        </tr>
	</thead>

<?php

$attributes = array('class' => 'tform', 'name' => 'orderform');

echo form_open_multipart('admin/programs/',$attributes);

?>

<?php 
	$total_amt = 0;
		$id_arr[] = 0;
if ($unwithdraw_list): ?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;
		
?>

<?php foreach ($unwithdraw_list as $list): 
     $name = $this->settings_model->getName($list->userid);
?>



		 
<tr class="odd camp<?php echo $i;?>">
			
			
			<td class=" "><?php echo $name;?></td>
			
			<td class=" "><?php echo $list->order_date;?></td>
			
			
           
		  
			
	
            
           <!-- <td class=" ">
            <?php

if(($u_data['groupid']=='2') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

{
	

?>

			<a class='btn btn-default' href='<?php echo base_url(); ?>income/withdraw/<?php echo $list ->id?>/<?php echo $list ->courses?>'>Withdraw</a>

			

<?php
	
}
?>


            </td>-->
			
			<td><?php  echo ($list->withdraw_status == 0) ? '$'.$list->amount_paid : 0; 
						$amt  = ($list->withdraw_status == 0) ? $list->amount_paid : 0
			?></td>
			
			<?php
			    
				$total_amt += $amt;  
				
				$id_arr[] = $list->id;
			?>
			
			
            
            </tr>
            
		    
		<?php endforeach ?>
		
	
<?php else: ?>



<tr>

    <td colspan="8">

<?php echo lang('web_no_elements');?>

</td>

</tr>



<?php endif ?>

</tbody>

 <?php echo form_close(); ?>


</table>

<?php
	if($id_arr)
	{	
		$this->session->set_userdata('id_arr',$id_arr);
	}
?>
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info" style="width: 50%;">
 <form name="" method="post" action="<?php echo base_url(); ?>/income/withdraw/<?php echo $course; ?>">
	<tr>
		<td>Total</td>
		<td><?php echo '$'.$total_amt; ?></td>
	</tr>
	
	<tr>
		<td></td>
		<td colspan="2"><input type="submit" class="btn btn-success" name="Withdraw" id="Withdraw" value="Withdraw" /></td>
	</tr>
 </form>
</table>

<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info" style="width: 50%;">
	<tr>
		<td>Last Withdraw Request Date</td>
		<td>Amount</td>
		<td>Status</td>
	</tr>
	<?php
		if($request_list)
		{
			foreach($request_list as $rlist)
			{
	?>
	<tr>
		<td><?php echo $rlist->date_of_request; ?></td>
		<td><?php echo '$'.$rlist->total_amt; ?></td>
		<td><?php 
					if($rlist->withdraw_status == 1)
					{
						echo 'Completed';
					}
					else if($rlist->withdraw_status == 2)
					{
						echo 'Pending';
					}
					else if($rlist->withdraw_status == 3)
					{
						echo 'In Process';
					}
					else if($rlist->withdraw_status == 4)
					{
						echo 'Cancelled';
					}
     		?></td>
	</tr>
	<?php
			}
		}
		else
		{
	?>
	<tr>
	 <td colspan="3">

<?php echo lang('web_no_elements');?>

</td></tr>
	<?php
		}
	?>
	

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



<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->



