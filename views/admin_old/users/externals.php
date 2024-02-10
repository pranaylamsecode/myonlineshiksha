<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<?php  
  /* echo '<pre>';
	print_r($users);
   echo '</pre>';*/
   
 
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('loggedin');
	$maccessarr=$this->session->userdata('maccessarr');
?>

<div class="main-container">

<div id="toolbar-box">
	<div class="m">
		<!--<div id="toolbar" class="toolbar-list">
			<?php
			if(($u_data['groupid']=='4') || ($maccessarr['users']=='own') )
			{
			?>
				<ul style="list-style:none; float: right; width: 25%;">
					<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
						<a href="<?php echo base_url(); ?>admin/users/trashusers/" onclick="Joomla.submitbutton('edit')" class="btn btn-orange">
							<span class="icon-32-new"></span>Trash
						</a>
					</li>
				
					<li id="toolbar-new" class="listbutton">

						<a href="<?php echo base_url(); ?>admin/users/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-success">

							<span class="icon-32-new"></span>New

						</a>

					</li>
				</ul>
			<?php 
			} 
			?>
			<div class="clr"></div>
		</div>-->
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Instructor External Manager';?></h2></div>
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
echo form_open_multipart(base_url().'admin/users/external',$attributes);
?>
<div class="row">
	<div class="col-sm-12 no-padding top-head-box">
    <!-- <div id="table-3_length" class="dataTables_length"> -->
   	<div id="table-3_length">	
      		<input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-height form-control" placeholder="External Manager">
      	
	  		<button type="submit" value="Search" name="submit_search" class="search-btn"><div class='sprite search' title="Search"></div></button>

   	  		<button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>
    	
    </div>
	</div>
  
	<!--<div class="col-xs-6 col-right">
    <div class="dataTables_filter" id="table-3_filter">
		<label> User Group :
            <select name="search_group" onchange="document.topform1.submit()" class="form-control">
				<option value="">- select -</option>
				<option value='1' <?php //if($status == '1') echo "selected"; ?>>Learner</option>
				<option value='2' <?php //if($status == '1') echo "selected"; ?>>Trainer</option>
				<option value='3' <?php //if($status == '0') echo "selected"; ?>>Assistant</option>
				<option value='4' <?php //if($status == '1') echo "selected"; ?>>Admin</option> 				
			</select>
		</label>     
    </div>
	</div>-->
</div>
<br>
    <?php echo form_close(); ?>


<div class='clear'></div>

	<thead>
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">First Name</div></th>
            
                        
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Email</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Group</div></th>

            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Options</div></th>
			
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Account Status</div></th>
		
            
        </tr>
	</thead>
	
<?php if ($users): ?>	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;?>


		<?php 
			$iii = 0;
		foreach ($users as $user):	


		$user_group_id=$user->group_id;


		$user_group_name=$this->users_model->getGroupById($user_group_id);


		?> 
<tr class="odd camp<?php echo $i;?>">
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $user->first_name;?></td>
            <td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $user->email;?></td>
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo (isset($user_group_name[0]->title) && !empty($user_group_name[0]->title)) ? $user_group_name[0]->title : '';?></td>
			
			<td class=" " align="center">
				
				
				
                <?php


	if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all') || ($maccessarr['users']=='own'))


	{


	?>


			<a  href='<?php echo base_url(); ?>admin/edit/external-profile/<?php echo $user ->id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>


			


	<?php


	}
	
	
	else


	echo "No Access";


	?>
                
			</td>
			
			<td class="field-title" style="color: #949494;text-transform: capitalize;text-align:center!important;">
				<input type="radio" onclick="approved(<?php  echo $user ->id;  ?>)" name="acc_status<?php  echo $user ->id;  ?>"  value="Approved" <?php echo ($user->active == 1) ?  'checked': ''; ?> />Approve &nbsp
				<input type="radio" onclick="disapproved(<?php  echo $user ->id;  ?>)"  name="acc_status<?php  echo $user ->id;  ?>"  value="Disapproved" <?php echo ($user->active == '0') ? 'checked' : '';  ?> />Disapprove
			</td>
            
		<?php 
			$iii++;
		endforeach ?>


		<?php else: ?>

</tr>
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
<script>

 function approved( user_id , email)
 {  //alert(user_id);
   
   
    jQuery.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/users/approved' ); ?>/" + user_id,

        success: function(msg)
        {
			alert("Account Approved Successfully");
        }

    });
       
 }
 
 function disapproved( user_id )
 {  //alert(user_id);
   
   
    jQuery.ajax({

        type: "GET",
        url: "<?php echo base_url('admin/users/disapproved' ); ?>/" + user_id,
        success: function(msg)
        {
			alert("Account Disapproved Successfully");
			
        }

    });
       
 }

 </script>