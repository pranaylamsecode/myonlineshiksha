<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
        <div class="pagetitle icon-48-generic"><h2><?php echo 'Access Permissions';?></h2>
            <h6>Manage user's access permissions.</h6></div>
		<div id="toolbar" class="toolbar-list">
			
		</div>
		
	</div>
</div>

<div class="card">
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
    
<table class="table table-bordered datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
			<!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 20px;"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>-->
			<th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">ID</div></th>
			<th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Name</div></th>
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Permission</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Access</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Options</div></th>
		</tr>
	</thead>


<?php if ($groups):


 $this->load->model('admin/accessgroups_model');


?>


<tbody>


<?php $i=0;?>


<?php foreach ($groups as $group): ?>


	<thead><tr class="camp<?php echo $i;?>">

		<!--<td><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $group->id?>"></td>-->

	    <td class="field-title"><?php echo $group->id;?></td>

	    <td class="field-title"><a href="<?php echo base_url(); ?>admin/aclp/create/<?php echo $group->id?>/"><?php echo $group->title?></a></td>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

        <td><a class="col-sm-4" href="<?php echo base_url(); ?>admin/create/user-permissions/<?php echo $group ->id?>"><div class='sprite 1addnew' style="background-position: 0 0;" title="Add New"></div></a>

        <?php /* ?>  <a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/groups/delete/<?php echo $group->id?>'>delete</a><?php */ ?></td>

	</tr></thead>

    <?php

        $grpmodobj=$this->accessgroups_model->getGroupModule($group->id);

        if($grpmodobj):

        foreach ($grpmodobj as $groupmod): ?>

		<tr class="camp<?php echo $i;?>">

		

	    <td></td>

	    <!-- <td><?php echo ucfirst($groupmod->modules)?></td> -->
        <td><?php echo ucfirst($groupmod->modules) =='Quizzes' ? 'Exams' : ucfirst($groupmod->modules) ?></td>
        <!-- <td><?php echo ucfirst($groupmod->permission)?></td> -->
        <td>
        <?php
         if(ucfirst($groupmod->permission) == "Own")
         {
            echo"Create/Edit/Delete";
         }
         else if(ucfirst($groupmod->permission) == "View_all")
         {
            echo"View Only";
         }
         else if(ucfirst($groupmod->permission) == "Modify_all")
         {
            echo"View /Edit Only";
         }
         else
         {
            echo ucfirst($groupmod->permission);
         }
         ?>
        </td>

        <td>

        <?php if($groupmod->access){?>

        <a title="Publish" href="<?php echo base_url(); ?>admin/aclp/unpublish/<?php echo $groupmod ->id; ?>/"><div class='sprite 9999published' style="background-position: -340px 0;"></div></a>

        <?php

        }else{ ?>

        <a title="Unpublish" href="<?php echo base_url(); ?>admin/aclp/publish/<?php echo $groupmod ->id;?>/"><div class='sprite 999publish' style=" background-position: -308px 0;"></div></a>

        <?php } ?>

        </td>

        <td>

        <a class="" href="<?php echo base_url(); ?>admin/edit/user-permissions/<?php echo $groupmod ->id; ?>"><div class='sprite 2edit' style="background-position: -32px 0;" title="Edit"></div></a>

        </td>

		</tr>


    <?php endforeach ?>


    <?php endif ?>


<?php endforeach ?>
</tbody>
</table>
<?php else: ?>
<p class='text'><?=lang('web_no_elements');?></p>
<?php endif ?>
</div>
<!---Pagination--->
 <?php  if($this->pagination->create_links()) { ?>
<div class="row pagination">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div>
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
</div><!-- card -->
<!---<div class="row"><div class="col-xs-6 col-left">
<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div></div>
<div class="col-xs-6 col-right"><div class="dataTables_paginate paging_bootstrap">
<ul class="pagination pagination-sm">
<li class="prev disabled"><a href="#"><i class="entypo-left-open"></i></a></li><li class="active"><a href="#">1</a></li><li>
<a href="#">2</a></li><li><a href="#">3</a></li><li>
<a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#"><i class="entypo-right-open"></i></a></li></ul>
</div></div></div>--->
</div>