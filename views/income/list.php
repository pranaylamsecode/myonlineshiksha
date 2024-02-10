
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

   
	$u_data=$this->session->userdata('logged_in');
  
	$maccessarr=$this->session->userdata('maccessarr');
	/*echo '<pre>';
	print_r($maccessarr);
	echo '</pre>';*/
?>


<style>
label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
</style>


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

<div class="txt-pyara">
Here you can view the list of all enrolled users of your courses. When you click on the number of enrolled user, you get the details of  enrolled user and your total income.
</div>





<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<div class="clr"></div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
echo form_open_multipart('income/lists/',$attributes);
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
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">

	<thead>
   
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Course Tree (#modules)</th>
            
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Category</th>
			
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">No. of Students Purchased this Course</th>
			<?php
				$this->load->config('features_config');
				$webinar = $this->config->item('webinar');				
				
				if($webinar['status']==TRUE)
				{
			?>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Price</th>
				<?php } ?>
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Re-order<a class="saveorder" href="javascript: saveorder(<?php echo count($programs)-1; ?>, 'saveorder')">__</a></th>-->

            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Term</th>-->
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Options</th>-->
            
        </tr>
	</thead>

<?php

$attributes = array('class' => 'tform', 'name' => 'orderform');

echo form_open_multipart('admin/programs/',$attributes);

?>

<?php if ($programs): ?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>

<?php foreach ($programs as $program): 
     $counts_students = $this->program_model->getUnWithdrawList($user_id,$program->id);
	 
?>



		 
<tr class="odd camp<?php echo $i;?>">
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<input type="checkbox" id="chk-1"><div class="checked"></div>
				</div>
			</td>-->
			
			<td class="">
				<?php
				
				 

				if(($u_data['groupid']=='2') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
				{
				?>

		  		
					<?php echo $program->name?>
        		

				<?php
				}
				else
				{
         		echo $program->name;
				}
				?>			
			</td>
			
			<td class=" "><?php echo $program->catname?></td>
			
			<td class=" "><a href="<?php echo base_url(); ?>income/myBuyers/<?php echo $program ->id?>"><?php echo count($counts_students);?></a></td>
			
            <?php
			$default_plans =  $this->program_model->getDefaultPlans($program->id);
				if(intval($program->fixedrate) == 0 && ($default_plans['0']['default_new']) == 1)
				{
			?>
            
			 <td class=" "><?php echo '$'.$default_plans['0']['price']; ?></td>
			<?php
				}
				else
				{
			?>
			<td class=" "><?php echo ($program->fixedrate == 0.00) ?  'Free' : '$'.$program->fixedrate; ?></td>
            <?php
				}
			?>
			<!--<td class=" ">
            
            <input type="text" name="order[<?php echo $program->id; ?>]" size="5" value="<?php echo $program->ordering ; ?>" class="text_area" style="text-align: center;" />

         	<input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $program->id;?>" class="text_area" style="text-align: center" />
            
            </td>-->
			
			<!--<td class=" ">
            <?php

if(($u_data['groupid']=='2') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

{

?>

		<?php if($program->published){?>

    		<a title="Unpublish Item" href="<?php echo base_url(); ?>programs/unpublish/<?php echo $program ->id?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>

    	<?php }else{?>

    		<a title="Publish Item" href="#" onclick="addtopublish(<?php echo $program ->id ?>);"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>

        </td>-->

		<?php }?>

<?php

}

else

echo "No Access";

?>

            
            <!--<td class=" ">
            <?php

if(($u_data['groupid']=='2') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

{

?>

			<a class='btn btn-default' href='<?php echo base_url(); ?>programs/edit/<?php echo $program ->id?>'>edit</a>

			

<?php

}

if(($u_data['groupid']=='2') ||  ($maccessarr['courses']=='own'))

{

?>
<a class="btn btn-danger" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>programs/trash/<?php echo $program->id?>'><?php echo lang('web_delete')?></a>
<?php
}


else

echo "No Access";

?>

            </td>-->
            
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

 

<div style="clear:both;"></div>

<script>
			(function(jQuery) {
				jQuery(document).ready(function() {
					var mySlidebars = new jQuery.slidebars();
					
					jQuery('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					jQuery('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			}) (jQuery);
</script>
<script>
function addtopublish(id)
{
/*alert(id);
$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>index.php/programs/addToPublish",
		data: {id:id}, 
		success: function(data)
		{				
			$("#divpublish").html(data);
			//getEditable();
		}
	});*/
}
</script>


<!-- tool tip script --><script type="text/javascript">jQuery(document).ready(function(){	jQuery('.tooltipicon').click(function(){	var dispdiv = jQuery(this).attr('id');	jQuery('.'+dispdiv).css('display','inline-block');	});	jQuery('.closetooltip').click(function(){	jQuery(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->



