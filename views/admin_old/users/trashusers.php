<?php

  $u_data=$this->session->userdata('loggedin');


  $maccessarr=$this->session->userdata('maccessarr');


?>


<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul style="list-style:none; float: right;">
					<li id="toolbar-new" class="listbutton">
						<a href="<?php echo base_url(); ?>admin/users/" class="btn btn-blue">
							<span class="icon-32-new"></span>Back
						</a>
					</li>
				</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Users Manager';?></h2></div>
	</div>
</div>


<div>

    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>
    <span class="clearFix">&nbsp;</span>

</div>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">

<div class='clear'></div>

	<thead>
		<tr role="row">
        	<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">First Name</th>
            
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 299px;">Email</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Group</th>

            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Options</th>
            
        </tr>
	</thead>
	
<?php if ($users): ?>	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;?>


		<?php foreach ($users as $user):	


		$user_group_id=$user->group_id;


		$user_group_name=$this->users_model->getGroupById($user_group_id);


		?> 
<tr class="odd camp<?php echo $i;?>">
			<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>
			<td class=" "><?php echo $user->first_name;?></td>
            <td class=" "><?php echo $user->email;?></td>
			<td class=" "><?php echo (isset($user_group_name[0]->title) && !empty($user_group_name[0]->title)) ? $user_group_name[0]->title : '';?></td>
			
			<td class=" ">
				
				
				
                <?php


	if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))

	{

	?>
			<a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/users/repostuser/<?php echo $user ->id?>'><i class="entypo-pencil"></i>Re-Post</a>
	<?php

	}


	else


	echo "No Access";


	?>
                
			</td>
            
		<?php endforeach ?>


		<?php else: ?>


		<tr><td colspan="5">


		<p class='text'><?=lang('web_no_elements');?></p>


		</td>
        </tr>


	<?php endif ?>    
   </tbody>
</table>
       
      
<div class="row">
 <div class="col-xs-6 col-left">
 	<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div>
 </div>
 
 <div class="col-xs-6 col-right">
 <div class="dataTables_paginate paging_bootstrap">
 <?php echo $this->pagination->create_links();  ?>
  </div>
  </div>
  
  </div>
</div>





