<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style>
	body .table > tbody > tr > td, body #table-2 > tbody > tr > td {
     background: transparent!important; 
}
.table tbody tr td.d-flex{
	display: flex;
}
.table tbody tr td.d-flex a{
	margin: 0 5px;
}
</style>
<?php
   $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
   $first = $start + 1;
   $u_data=$this->session->userdata('loggedin');
   $maccessarr=$this->session->userdata('maccessarr');
?>


<!--@@@@@@@@@@@@@@@@ new tab end here @@@@@@@ -->
<div class="panel-body main-table form-body" >
	<div class="" id="toolbar-box">
		<div class="m">
				<div class="pagetitle icon-48-generic">
					<h2 class="tab_haeding">Manage Blocks</h2>
						<h6>Here you can manage and create new display blocks, which are displayed on the
				Home Page of your Online Academy. Through these blocks, you can share the
				highlights of your Academy in the form of text, images, videos, links and HTML.</h6>
				</div>


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
					<!-- <div class="clr"></div> -->
				</div>	
			</div>

		<div>
	</div>
   <!--  <span class="clearFix">&nbsp;</span> -->
</div>

<!-- <div class='clear'></div> -->


<table class="table table-bordered table-striped datatable" id="table-2">
	<thead>
		<tr>
			<!--<th>
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
			<!-- <th class="col-sm-4"><div class="col-sm-12 no-padding table-title" style="text-transform:none"> Title of the Block</div></th> -->
			<th class="col-sm-4"> Title of the Block</th>
			<!--<th>Alias</th>-->
			<th class="col-sm-4">Location</th>
            <th class="col-sm-2">Publish</th>
            <th class="col-sm-2">Edit</th>
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
			<td class="field-title"><?php echo $eachpage->title;?></td>
			<!--<td><?php echo $eachpage->alias;?></td>-->
			<td class="field-title"><?php if($eachpage->area == 'footer') { echo 'Bottom'; } else { echo ucfirst($eachpage->area); } ?></td>
            <td>
            	<?php if($eachpage->status == "1")
		{
		?>
        <a title="Publish" href="<?php echo base_url(); ?>admin/widgets/unpublish/<?php echo $eachpage->id; ?>/"><div class='sprite 9999published ' style="background-position: -340px 0;"></div></a>
        <?php
        }else{ ?>
        <a title="Unpublish" href="<?php echo base_url(); ?>admin/widgets/publish/<?php echo $eachpage->id;?>/"><div class='sprite 999publish ' style=" background-position: -308px 0;"></div></a>
        <?php } ?>
            </td>
			<td class="d-flex">
				
				
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
       <a class="" href="<?php echo base_url(); ?>admin/widgets/<?php echo $link?>/"><div class="sprite 2edit" style="background-position: -32px 0;" title="Edit block"></div></a>
       <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/widgets/delete/<?php echo $eachpage->id?>'><i class="entypo-cancel"></i>delete</a> -->
       <a class='' onClick="return deleteconfirm_widgets(<?php echo $eachpage->id?>);"><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
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
</div>
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

		function deleteconfirm_widgets(id) 
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