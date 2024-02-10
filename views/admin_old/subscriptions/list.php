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
  padding: 8px 30px 0 13px !important;
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
   $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
?>
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
        <?php
                    if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
                    {
        ?>
        	<div id="sticky-anchor"></div>
			<ul id="sticky" style="list-style: none; float: right;">
				<li id="toolbar-new" class="listbutton">
					<a href="<?php echo base_url(); ?>admin/create/newsletter-subscription/"  class="btn btn-green">
          <i class="entypo entypo-popup"></i>
					<span class="icon-32-new"></span>New</a>
					<a href="<?php echo base_url(); ?>admin/subscriptions/excelSheet/"  class="btn btn-blue">
					<span class="icon-32-new"></span>
          <i class="entypo entypo-download"></i>
          Download Email List</a>
				</li>
			</ul>
        <?php
        }
        ?>
			<div class="clr"></div>
		</div>

		<div class="pagetitle icon-48-generic"><h2>Manage Newsletter Subscribers</h2></div>
	</div>
	<p class="pmaintitle main_subtitle">Here you can view all the people who have subscribed to your Online Academy's newsletter. You can download or export 
	the entire list to be used for any mailing service. You can also add or delete subscribers manually from here in 
	case required.</p>
</div>

<div>
    <span class="clearFix">&nbsp;</span>
</div>

<div class='clear'></div>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Name</div></th>
            
            <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Email</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Date Time</div></th>
            
            
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Options</div></th>
            
		</tr>
	
    </thead>
<?php if ($allpages): ?>	
	
<tbody>
<?php $i=0;?>
<?php 
     $iii = 0;
foreach ($allpages as $eachpage): ?>
	<tr class="camp<?php echo $i;?>"> 
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $eachpage->id;?>"><div class="checked"></div></label>
				</div>
			</td>-->
			<td class="field-title " style="text-transform: capitalize;color: #949494;"><?php echo $eachpage->name;?></td>
			
			<td class="field-title " style="text-transform: capitalize;color: #949494;"><?php echo $eachpage->email;?></td>
            
            <td class="field-title " style="text-transform: capitalize;color: #949494;"><?php echo $eachpage->date_time.' GMT';?></td>
            
			<td class=" ">
				
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
       <a class="col-sm-offset-2 col-sm-4" href="<?php echo base_url(); ?>admin/subscriptions/<?php echo $link?>/"><div class="sprite 2edit" style="background-position: -32px 0;" title="Course Content"></div></a>
       <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/subscriptions/delete/<?php echo $eachpage->id?>'><i class="entypo-cancel"></i>delete</a> -->
       <a class='col-sm-4' onClick="return deleteconfirm(<?php echo $eachpage->id?>);" ><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
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
		<?php else: ?>



           <tr><td colspan="4">


		          <p class='text'><?=lang('web_no_elements');?></p>
		      </td>
              </tr>

             <?php endif ?>
	</tbody>
</table>

      
		<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countpages; ?> entries</div>
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
var $ =jQuery.noConflict();

		function deleteconfirm(id) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete Newsletter ?',
    			content: ' ',
    			confirm: function(){ 
    					 window.location.href = "<?php echo base_url(); ?>admin/subscriptions/delete/"+id;
        
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