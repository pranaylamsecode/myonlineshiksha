<?php  
   /* echo '<pre>';
		print_r($language);
    echo '<pre>'; */
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('loggedin');
	$maccessarr=$this->session->userdata('maccessarr');
?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">

			<ul style="list-style: none; float: right;">

			<li id="toolbar-new" class="listbutton">

            <a href="<?php echo base_url(); ?>admin/languages/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-success">

			<span class="icon-32-new">

			</span>

			New

			</a>

			</li>

			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Language List';?></h2></div>
	</div>
</div>




<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php

$attributes = array('class' => 'tform', 'name' => 'topform1');



echo form_open_multipart(base_url().'admin/languages/',$attributes);

?>
<div class="row">
  <div class="col-xs-6 col-left">
    <div id="table-3_length" class="dataTables_length">
      <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control">

	  <input type="submit" value="Search" name="submit_search" class="btn btn-blue">

   	  <input type="submit" value="Reset" name="reset" class="btn btn-red">
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

    <?php echo form_close(); ?>


<div class='clear'></div>

	<thead>
		<tr role="row">
        	<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Name</th>
            
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 299px;">Staus</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Options</th>
            
        </tr>
	</thead>
	
<?php if ($language): ?>	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;?>


		<?php 
			$iii = 0;
		foreach ($language as $lang):	


		


		?> 
<tr class="odd camp<?php echo $i;?>">
			<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>
			<td class=" "><?php echo $lang->name;?></td>
           <td class=" ">
            <?php if($lang->active=='1')
			{
			?>
			<a title="Unpublish Item" href="<?php echo base_url();?>admin/languages/unPublishLang/<?php echo $lang->id; ?>">

			<img alt="Published" src="<?php echo base_url();?>public/images/admin/tick.png">

			</a>
			<?php
			}else
			{
			?>

			<a title="Publish Item" href="<?php echo base_url();?>admin/languages/publishLang/<?php echo $lang->id; ?>">

			<img alt="UnPublished" src="<?php echo base_url();?>public/images/admin/publish_x.png">

			</a>
			<?php
			}
			?>
            </td>
			
			
			<td class=" ">				
                
                <?php //echo $eachblog->title;?>

			<a class="btn btn-default btn-sm btn-icon icon-left" href="<?php echo base_url(); ?>admin/languages/edit/<?php echo $lang->id; ?>"><i class="entypo-pencil"></i>Edit</a>

			<a class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you sure to delete this blog?')" href="<?php echo base_url(); ?>admin/languages/delete/<?php echo $lang->id; ?>/"><i class="entypo-cancel"></i>Delete</a>

			</td>	
            
		<?php 
			$iii++;
		endforeach ?>


		<?php else: ?>


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