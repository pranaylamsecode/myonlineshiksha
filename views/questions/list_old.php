<?php  
   /*echo '<pre>';
	print_r($questions);
   echo '</pre>';*/
   
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('logged_in');
	$maccessarr=$this->session->userdata('maccessarr');
	print_r($maccessarr);
?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<?php
			if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='own') )
			{
			?>
				<ul style="list-style:none; float: right;">
					<li id="toolbar-new" class="listbutton">
						<a href="<?php echo base_url(); ?>questions/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-success">
							<span class="icon-32-new"></span>New
						</a>
					</li>
				</ul>
			<?php 
			} 
			?>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Questions Manager';?></h2></div>
	</div>
</div>

<div>
    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('questions/',$attributes);
?>
<div class="row">
	<div class="col-xs-6 col-left">
    <div id="table-3_length" class="dataTables_length">
      <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control">

	  <input type="submit" value="Search" name="submit_search" class="btn btn-blue">

   	  <input type="submit" value="Reset" name="reset" class="btn btn-red">
    </div>
	</div>
  
	<div class="col-xs-6 col-right">
    <div class="dataTables_filter" id="table-3_filter">
		<label> Question Group :
            <select name="search_group" onchange="document.topform1.submit()" class="form-control">
				<option value="">- select -</option>
				<option value='regular' <?php //if($status == '1') echo "selected"; ?>>Regular</option> 				
				<option value='match_the_pair' <?php //if($status == '1') echo "selected"; ?>>Match The Pair</option>
				<option value='true_false' <?php //if($status == '1') echo "selected"; ?>>True / False</option> 
				<!--<option value='fill_in_the_blanks' <?php //if($status == '1') echo "selected"; ?>>Fill In The Blanks</option>-->
				<option value='multiple_type' <?php //if($status == '0') echo "selected"; ?>>Multiple Type</option>								
				<option value='media_type' <?php //if($status == '1') echo "selected"; ?>>Media Type</option> 				
			</select>
		</label>     
    </div>
	</div>
</div>

    <?php echo form_close(); ?>


<div class='clear'></div>
	<thead>
		<tr role="row">
	        <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending">Question Tag</th>
    	    <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending">Question Type</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">Question</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Options</th>
        </tr>
	</thead>
	
	<?php
	$iii = 0;
	if ($questions): ?>	
	<tbody role="alert" aria-live="polite" aria-relevant="all">
	<?php $i=0;?>

	<?php 
		foreach ($questions as $quest):	
		//$user_group_id=$quest->group_id;
		//$user_group_name=$this->users_model->getGroupById($user_group_id);
	?> 
	<tr class="odd camp<?php echo $i;?>">
		<td class=" "><?php echo $quest->question_tag;?></td>
        <td class=" "><?php echo $quest->question_type;?></td>
        <td class=" "><?php echo $quest->question;?></td>
		
		<td class=" ">
            <?php
			if(($u_data['groupid']=='4') || ($maccessarr['quizzes']=='modify_all') || ($maccessarr['quizzes']=='own'))
			{
				?>
				<a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>questions/edit/<?php echo $quest ->question_id?>'><i class="entypo-pencil"></i>Edit</a>
				<?php
			}
	
			if(($u_data['groupid']=='4')  || ($maccessarr['quizzes']=='own'))
			{
				?>
				<a class="btn btn-danger btn-sm btn-icon icon-left" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>questions/delete/<?php echo $quest->question_id?>/<?php echo $this->uri->segment(3)?>'><i class="entypo-cancel"></i>Delete</a>
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