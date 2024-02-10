<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">

<?php
   $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
   $first = $start + 1;
   $u_data=$this->session->userdata('loggedin');
   $maccessarr=$this->session->userdata('maccessarr');
?>
<div class="main-container">
<div id="toolbar-box">
<!-- @@@@@@@@@@@@@@@ new tab start here by sachin @@@@@@@ -->
<div class="pagetitle icon-48-generic"><h2>Online Academy Design Setting</h2>
		<p> Here you can design the look and feel of your Online Academy</p>
		</div>
<div class="panel-heading">
				<div class="panel-title" style="padding:0;width:100%;">
					<!-- <ul class="nav nav-tabs bordered grey-border blue-border"> --><!-- available classes "bordered", "right-aligned" --> 
					<!-- <li ><a href="#logo_style" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45" onclick="tabActive('tab1');">Logo and Theme Color</a></span></a></li> 
					<li> <a href="#homepagesettings" data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45" onclick="tabActive('tab2');">HomePage Settings</a></span></a></li>
					<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45" onclick="tabActive('tab3');">Banner and Slider</a></span></a></li> 
					
					<li class="active"> <a class="home-page-li-border" href="<?php echo base_url();?>admin/widgets/index">Widgets</a></li>
					<li> <a class="home-page-li-border" href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/testimonials">Testimonials</a></span></a></li>
					<li> <a class="home-page-li-border" href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/sociallinks/createLink">Social Link</a></span></a></li> -->
					<!--<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/pagecreator">Pages</a></span></a></li>
					<li> <a href="#fillintheblanks" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Fill In The Blanks</span></a></li>-->
					<!-- </ul>
 -->
					<ul class="nav nav-tabs bordered grey-border blue-border"><!-- available classes "bordered", "right-aligned" --> 
					<li style="border-left:none;"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45" onclick="tabActive('tab1');">Logo and Theme Color</a></li> 
					<li><a href="<?php echo base_url(); ?>admin/templates/editoptions/45" onclick="tabActive('tab2');">HomePage Settings</a></li>
					<li><a href="<?php echo base_url(); ?>admin/templates/editoptions/45" onclick="tabActive('tab3');">Banner and Slider</a></li> 
					
					<li class="active"> <a class="home-page-li-border" href="<?php echo base_url();?>admin/widgets/index">Widgets</a></li>
					<li><a href="<?php echo base_url();?>admin/testimonials">Testimonials</a></li>
					<li><a href="<?php echo base_url();?>admin/sociallinks/createLink">Social Link</a></li>
					<!--<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/pagecreator">Pages</a></span></a></li>
					<li> <a href="#fillintheblanks" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Fill In The Blanks</span></a></li>-->
					</ul>
				</div>
				
				<!--<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>-->
			</div>
<!--@@@@@@@@@@@@@@@@ new tab end here @@@@@@@ -->

	<div class="m">
		<div id="toolbar" class="toolbar-list">
        <?php
        if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
        {
        ?>
        <div id="sticky-anchor"></div>
			<ul id="sticky" style="list-style:none; float:right;padding-top:1%;">
				<li id="toolbar-new" class="listbutton">
					<a href="<?php echo base_url(); ?>admin/widgets/createPage/"  class="btn btn-success btn-green">
					<span class="icon-32-new"></span>New</a>
				</li>
			</ul>
        <?php
        }
        ?>
			<div class="clr"></div>
		</div>

		<div class="pagetitle icon-48-generic"><h4>Manage Widgets</h4></div>
	</div>
	<p class="pquestionsub">Widgets are the display blocks in your home page where you can share the highlights of your Online Academy in the form
	of texts, images, videos, links and HTML. You can arrange the position of the widgets as you desire.</p>
</div>

<div>
    <span class="clearFix">&nbsp;</span>
</div>

<div class='clear'></div>


<table class="table table-bordered table-striped datatable" id="table-2">
	<thead>
		<tr>
			<!--<th>
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
			<th class="col-sm-4"><div class="col-sm-12 no-padding table-title">Title</div></th>
			<!--<th>Alias</th>-->
			<th class="col-sm-4"><div class="col-sm-12 no-padding table-title">Area</div></th>
            <th class="col-sm-2"><div class="col-sm-12 no-padding table-title" style="text-align: center;">Status</div></th>
            <th class="col-sm-2"><div class="col-sm-12 no-padding table-title" style="text-align: center;">Options</div></th>
		</tr>
	</thead>
<?php if ($allpages): ?>	
	<tbody>
	<?php $i=0;?>
<?php 
   $iii = 0;
foreach ($allpages as $eachpage): ?>
		<tr class="camp<?php echo $i;?>">
			<!--<td>
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $eachpage->id;?>"><div class="checked"></div></label>
				</div>
			</td>-->
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $eachpage->title;?></td>
			<!--<td><?php echo $eachpage->alias;?></td>-->
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php if($eachpage->area == 'footer') { echo 'Bottom'; } else { echo ucfirst($eachpage->area); } ?></td>
            <td>
            	<?php if($eachpage->status == "1")
		{
		?>
        <a title="Publish Item" href="<?php echo base_url(); ?>admin/widgets/unpublish/<?php echo $eachpage->id; ?>/"><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>
        <?php
        }else{ ?>
        <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/widgets/publish/<?php echo $eachpage->id;?>/"><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>
        <?php } ?>
            </td>
			<td>
				
				
				<?php


if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
{
        /*if($eachpage->type=='contact')
        {
          $link="editContactPage/".$eachpage->id;
        }
        else
        {
          $link="editPage/".$eachpage->id;
        }*/
		$link="editPage/".$eachpage->id;
?>
       <a class="col-sm-offset-3 col-sm-4" href="<?php echo base_url(); ?>admin/widgets/<?php echo $link?>/"><div class="sprite 2edit" style="background-position: -32px 0;" title="Course Content"></div></a>
       <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/widgets/delete/<?php echo $eachpage->id?>'><i class="entypo-cancel"></i>delete</a> -->
       <a class='col-sm-4' onClick="return deleteconfirm(<?php echo $eachpage->id?>);"><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
<?php
}
else
{
  echo "No Access";
}
?>
			</td>
		</tr>
		<?php 
		  $iii++;
		endforeach ?>
		
		
	</tbody>
</table>
<?php else: ?>
	<p class='text'><?=lang('web_no_elements');?></p>
<?php endif ?>
<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countpagess; ?> entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
   </div>
</div>
<?php } ?>

<script>
			function tabActive(tabname)
			{	
				

				jQuery.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>admin/templates/tabActive",
							data: {tabname:tabname}, 
							success: function(data)
							{
								//alert(data);
							//$("#followDiv").html(data);
							}
		  				});
			}
			</script>


<script>
var 	$ =jQuery.noConflict();

		function deleteconfirm(id) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete widget?',
    			content: ' ',
    			confirm: function(){ 
    					 window.location.href = "<?php echo base_url(); ?>admin/widgets/delete/"+id;
        
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}
</script>

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