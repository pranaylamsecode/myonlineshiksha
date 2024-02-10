<?php
 
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
  $first = $start + 1;
 
?><script>

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

<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 12px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu" ></i>
	</a>
</div>

<div style="text-align:center; margin-bottom:5px;">
Here you can view all your Messages. If you click View, you get the details of your Message.
</div>


<div class="clr"></div>

<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('notification/',$attributes);
?>
<hr />

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">
    <div class="course_search" style="margin-bottom: 20px; float:left;">
	
      	<input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">

		<input type="submit" value="Search" name="submit_search" class="btn btn-info">

		<input type="submit" value="Reset" name="reset" class="btn btn-danger">
  
    </div>
	
	
  
	<!--<div class="course_search" style="float:right; margin-top: 0px;">
    <!--<label style="display: inline-block; padding:0px; width:auto;">
    Course category :

				<select name="catid" size="1" onchange="document.topform1.submit()" class="form-control">

    				<option value="">All</option>

    				<?php

    				 foreach ($categories as $category):

                     //$cat_name = ($this->input->post('catid') && $this->input->post('catid') == $category->id) ? 'selected="selected"' : '';

                     ?>

    				 <option value='<?php echo $category->id?>' <?php //echo $cat_name; ?>><?php echo $category->name?></option>

					<?php endforeach ?>

				</select>
    </label>
    	<label style="display: inline-block; padding:0px; width:auto;">
       		Status :
                <select name="status" onchange="document.topform1.submit()" class="form-control">

				<option value="">- select -</option>

                <option value='1' <?php if(@$status == '1') echo "selected"; ?>>Published</option>

				<option value='0' <?php if(@$status == '0') echo "selected"; ?>>Unpublished</option>

				</select>
		</label>
    </div>-->

</div>
<div class="clear"></div>
 <?php echo form_close(); ?>

<div class="table-scroll-resp">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<form action="<?php echo base_url();?>admin/users" method="post" accept-charset="utf-8" class="tform" name="topform1" enctype="multipart/form-data"></form>

    



	<thead>
   
		<tr role="row">
        	<th>
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<input type="checkbox" id="chk-1"><div class="checked"></div>
				</div>
			</th>
            
            <th>Sender</th>
            
                        
            <th>Subject</th>
            
            <th>Message</th>
			
            <th>Date</th>   
            
            
            <th>Options</th>
            
            
        </tr>
	</thead>

<?php

$attributes = array('class' => 'tform', 'name' => 'orderform');

echo form_open_multipart('admin/programs/',$attributes);

?>

<?php if ($message): ?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>

<?php 
   $iii = 0;
foreach ($message as $msg):
 
    $name = $this->settings_model->getName($msg->sender_id);
 ?>


		 
<tr class="odd camp<?php echo $i;?>">
			<!-- <td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $order->id?>">--><!--</td>-->
<!--<td><?php //echo $order->id;?></td>-->
			<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>
             <?php /* ?><td><a href="<?php echo base_url();?>admin/users/edit/<?php echo $order->userid?>"><?php echo $this->users_model->getUserName($order->userid);?></a></td>  <?php */ ?>
			<td class=" "><?php echo $name; ?></td>
			<td class=" "><?php echo $msg->subject; ?></td>
			<td class=" "><?php echo $msg->message; ?></td>
			<td class=" "><?php echo $msg->message_date; ?></td>
				
            <td class=" ">
            

			    <a class='btn btn-default' href='<?php echo base_url(); ?>notification/message/<?php echo $msg->message_id?>'>View</a>
			    <a class='btn btn-default' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>notification/delete_message/<?php echo $msg->message_id?>'>Delete</a>

		     </td>
  </tr>          
            
            
		
		<?php 
		
		  
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
</div>
</div>       
      
<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countorders; ?> entries</div>
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
</div>
</div>
<div style="clear:both;"></div>

<script>
			(function($) {
				$(document).ready(function() {
					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			}) (jQuery);
</script>


<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->

