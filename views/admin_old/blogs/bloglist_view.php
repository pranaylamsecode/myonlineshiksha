<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style>
.jconfirm .jconfirm-box div.title {
  background: transparent;
  font-size: 18px;
  font-weight: 600;
  font-family: inherit;
  padding: 10px 15px 10px;
  text-align: center;
  display: block;
  color: #c42140;
  text-transform: uppercase;
  font-size: 21px!important;
  font-weight: bold;
  text-align: center!important;
  padding: 22px 30px 0 13px !important;
  border-bottom: 0px!important;
  margin-top: 0px!important;
  background-color: #f1f1f1!important;
  height: 73px!important;
}
button.btn.btn-success {
  background-color: #04A600!important;
}
.jconfirm .jconfirm-box .buttons {
  padding: 20px 15px!important;
}
</style>
<?php
    $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
	$first = $start + 1;
	$u_data=$this->session->userdata('loggedin');
    $maccessarr=$this->session->userdata('maccessarr');
?>
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<div id="sticky-anchor"></div>
			<ul id="sticky" style="list-style: none; float: right;">

			<li id="toolbar-new" class="listbutton">

            <!-- <a href="<?php echo base_url(); ?>admin/create/blog/" onclick="Joomla.submitbutton('edit')" class="btn btn-green"> -->
            <a href="<?php echo base_url(); ?>admin/blogs/create_blog/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">

			<span class="icon-32-new">
            <i class="entypo entypo-popup"></i>
			</span>

			New

			</a>

			</li>

			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Blogs Manager';?></h2>
			 <p class="pmaintitle main_subtitle"> Create Interactive Blogs on Your Academy, Courses and Future Updates to keep your user engaged.</p>
		</div>
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
echo form_open_multipart(base_url().'admin/users/',$attributes);
?>
<div class="row">
<div class="col-sm-12 no-padding top-head-box">

    <!-- <div class="dataTables_filter" id="table-3_filter"> -->
  <div id="table-3_filter">
  	<span style="margin-right:1%;">
      <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-height form-control" placeholder="Blogs Title">
    </span>
<!-- </div> -->
	<span>
    <!-- <div id="table-3_length" class="dataTables_length"> -->
    <!-- <div id="table-3_length"> -->   
	    <button type="submit" value="Search" name="submit_search" class="search-btn"><div class='sprite search' title="Search"></div></button>
   	    <button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>
    </span>
</div>
</div>
</div>
<br>
<?php echo form_close(); ?>
<div class='clear'></div>

<!--
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
-->
<?php
/*
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart('admin/blogs/',$attributes);*/
?>

	<thead>
		<tr role="row">
			<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">POST</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">DATE</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">UPDATE DATE</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">WRITTEN BY</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">STATUS</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">OPTIONS</div></th>
        </tr>
    </thead>

	<?php
	if($blogs)
	{ 
	?>
	<tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php
	$i=0;
	$iii = 0;
	foreach($blogs as $eachblog)
    {
	?>		
	<tr class="odd camp<?php echo $i;?>">
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"><div class="checked"></div></label>
				</div>
			</td>-->
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><a href="<?php echo base_url(); ?>admin/blogs/blogDetailview/<?php echo $eachblog->id; ?>"><?php echo $eachblog->title;?></a></td>
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo date("d F Y g:i a",$eachblog->ts);?></td>
			<td class="field-title" style="color: #949494;text-transform: capitalize;text-align:center;"><?php echo $eachblog->updateon;?></td>

			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $this->blogs_model->getNameById($eachblog->written_by);?></td>
            <td class=" ">
            <?php if($eachblog->status=='1')
			{
			?>
			<a title="Publish Item" href="<?php echo base_url();?>admin/blogs/unPublishBlog/<?php echo $eachblog->id; ?>">

			<div class='sprite 9999published center' style="background-position: -340px 0;"></div>

			</a>
			<?php
			}else
			{
			?>

			<a title="Unpublish Item" href="<?php echo base_url();?>admin/blogs/publishBlog/<?php echo $eachblog->id; ?>">

			<div class='sprite 999publish center' style=" background-position: -308px 0;"></div>

			</a>
			<?php
			}
			?>
            </td>
			<td class=" ">				
                
                <?php //echo $eachblog->title;?>

			<a class='col-sm-offset-2 col-sm-4 no-padding' href="<?php echo base_url(); ?>admin/edit/blog/<?php echo $eachblog->id; ?>"><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>

			<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you sure to delete this blog?')" href="<?php echo base_url(); ?>admin/blogs/deleteBlog/<?php echo $eachblog->id; ?>/"><i class="entypo-cancel"></i>Delete</a> -->
			<a class="col-sm-4" onclick="return deleteconfirm('<?php echo $eachblog->id; ?>')"><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>

			</td>		
        <?php
		$i++;			
		$iii++;
		}
	}
	else
	{
		?>	
		<tr><td colspan="6">
		<p class='text'><?=lang('web_no_elements');?></p>
		</td>
		</tr>
		<?php
	}
	?>
</tbody>
</table>

<!---Pagination-->       
<?php if($this->pagination->create_links()) 
{
?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countblogs; ?> entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>
</tr>
<?php 
}

/*
echo '<pre>';
print_r($this->pagination->create_links());
echo '</pre>';
*/

?>
</div>

<script>
var $ =jQuery.noConflict();
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>   
<script type="text/javascript"> 
var $ =jQuery.noConflict(); 
	function deleteconfirm(id)
	{

		 $.confirm({
               title: 'Do you really want to delete blog ?',
               content: ' ',
               confirm: function(){ 
                                window.location.href = "<?php echo base_url(); ?>admin/blogs/deleteBlog/"+id;

                                   },
               cancel: function(){        
                               return true;
                                       }
                             });
	}

</script>