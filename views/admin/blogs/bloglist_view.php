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
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Blog';?></h2>
			 <h6 class="pmaintitle main_subtitle"> Create interactive blog posts to boost your online visibility and build relationships with your target audience.</h6>
		</div>
		<div id="toolbar" class="toolbar-list">
			<div id="sticky-anchor"></div>
			<ul id="sticky" style="list-style: none; float: right;">

			<li id="toolbar-new" class="listbutton">

            <a href="<?php echo base_url(); ?>admin/blogs/create_blog" onclick="Joomla.submitbutton('edit')" class="btn">

			<span class="icon-32-new">
				</span>
            <i class="entypo entypo-popup"></i>
			

			Add Post

			</a>

			</li>

			</ul>
			<div class="clr"></div>
		</div>
		
	</div>
</div>


<div>
    <?php if (isset($control)): ?>

    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>

    <?php endif ?>
   
</div>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<div class="top-head-box">

    <!-- <div class="dataTables_filter" id="table-3_filter"> -->
 	<div id="table-3_length">
  	<span >
      <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-height form-control" placeholder="Blogs Title">
    </span>
<!-- </div> -->
	<span>
    <!-- <div id="table-3_length" class="dataTables_length"> -->
    <!-- <div id="table-3_length"> -->   
	    <button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier" ></span></button>
    </span>
	</div>
</div>

<div class="card">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/users/',$attributes);
?>




<?php echo form_close(); ?>


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
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Post</div></th>
            <!-- <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">DATE</div></th> -->
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Modified date</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Author</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Status</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Options</div></th>
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
			<td class="field-title"><a href="<?php echo base_url(); ?>admin/blogs/blogDetailview/<?php echo $eachblog->id; ?>"><?php echo $eachblog->title;?></a></td>
			<!-- <td class="field-title" style="color: #666;text-transform: capitalize;"><?php echo date("d F Y g:i a",$eachblog->ts);?></td> -->
			<td class="field-title"><?php echo $eachblog->updateon;?></td>

			<td class="field-title"><?php echo $this->blogs_model->getNameById($eachblog->written_by);?></td>
            <td class=" ">
            <?php if($eachblog->status=='1')
			{
			?>
			<a title="Unpublish" href="<?php echo base_url();?>admin/blogs/unPublishBlog/<?php echo $eachblog->id; ?>">

			<div class='sprite 9999published' style="background-position: -340px 0;"></div>

			</a>
			<?php
			}else
			{
			?>

			<a title="Publish" href="<?php echo base_url();?>admin/blogs/publishBlog/<?php echo $eachblog->id; ?>">

			<div class='sprite 999publish' style=" background-position: -308px 0;"></div>

			</a>
			<?php
			}
			?>
            </td>
			<td class="editdelete">				
                
                <?php //echo $eachblog->title;?>

			<a class='no-padding' href="<?php echo base_url(); ?>admin/edit/blog/<?php echo $eachblog->id; ?>"><div class='sprite 2edit' style="background-position: -32px 0;" title="Edit post"></div></a>

			<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you sure to delete this blog?')" href="<?php echo base_url(); ?>admin/blogs/deleteBlog/<?php echo $eachblog->id; ?>/"><i class="entypo-cancel"></i>Delete</a> -->
			<a class="" onclick="return deleteconfirm('<?php echo $eachblog->id; ?>')"><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>

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
<div class="row pagination">
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
</div><!-- card -->
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