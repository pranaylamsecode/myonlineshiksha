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
  
    $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
	$first = $start + 1;
	
?>
<?php

  $u_data=$this->session->userdata('loggedin');

  $maccessarr=$this->session->userdata('maccessarr');

?>



<div id="toolbar-box">

	<div class="m">

		<div id="toolbar" class="toolbar-list">

		<div class="clr"></div>

		</div>

		<div class="pagetitle icon-48-generic"><h2>Trash Records</h2></div>

	</div>

</div>

<p style="margin-bottom:5px;">
Here you can manage all your courses, which are already delete and send into trash i.e. deactivate. 
If you want to activate it , click on activate button.
</p>

<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/programs/',$attributes);
?>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<div class="clear"></div>
<?php echo form_close(); ?>


<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
        	<!-- <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th> -->
            
            <th class="sorting table-title" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Course Tree (#modules)</th>
            
                        
            <th class="sorting table-title" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Category</th>
            
            <th class="sorting table-title" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Webinars</th>
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Re-order<a class="saveorder" href="javascript: saveorder(<?php echo count($programs)-1; ?>, 'saveorder')">__</a></th>-->

            <th class="sorting table-title" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;text-align: center;">Published</th>
            
            <th class="sorting table-title" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Options</th>
            
        </tr>
	</thead>

<?php

$attributes = array('class' => 'tform', 'name' => 'orderform');

echo form_open_multipart(base_url().'admin/programs/',$attributes);
$iii = 0;
?>

<?php if ($programs): ?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>


<?php

foreach ($programs as $program): ?>

<tr class="odd camp<?php echo $i;?>">
<!-- <td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td> -->
			<td class="">
				<?php

				if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
				{
				?>

		  		<a href="<?php echo base_url(); ?>admin/days/<?php echo $program ->id?>" class="a_mlms field-title">
					<?php echo $program->name?>
        		</a>

				<?php
				}
				else
				{
         		echo $program->name;
				}
				?>			
			</td>
			
			<td class="field-title" style="color: #949494;"><?php echo $program->catname?></td>
            
            <td class=" "><a href="<?php echo base_url().'admin/webinars/listings/'.$program ->id?>">Panel</a></td>
            
		
			<td class=" ">
            <?php

if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

{

?>

		<?php if($program->published){?>

    		<a title="Unpublish Item" href="<?php echo base_url(); ?>admin/programs/unpublish/<?php echo $program ->id?>"><!-- <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"> -->
    		<div class="sprite 9999published center" style="background-position: -340px 0;">
    		</div>
    		</a>

    	<?php }else{?>

    		<a title="Publish Item" href="<?php echo base_url(); ?>admin/programs/publish/<?php echo $program ->id?>"><!-- <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"> -->
    		<div class="sprite 999publish center" style=" background-position: -308px 0;"></div></a>

        </td>

		<?php }?>

<?php

}

else

echo "No Access";

?>

            
            <td class=" ">
            <?php

if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

{

?>

			<a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/programs/repost/<?php echo $program ->id?>'><i class="entypo-pencil"></i>Re-Post</a>

<?php

}

else

echo "No Access";

?>

            </td>
            
            
            
		
		<?php 
		$iii++;
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
       
      
<!-- <div class="row">
 <div class="col-xs-6 col-left">
 	<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to  8 of 60 entries</div>
 </div>
 
 <div class="col-xs-6 col-right">
 <div class="dataTables_paginate paging_bootstrap">
<?php echo $this->pagination->create_links();  ?>
  </div>
  
  </div>
</div> -->

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

<?php } ?>
<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->