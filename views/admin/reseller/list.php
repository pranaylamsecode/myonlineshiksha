<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/tour/css/jquerytour.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css"> 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome/css/font-awesome.min.css">
<?php  
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('loggedin');
	$maccessarr=$this->session->userdata('maccessarr');
?>
<style>
#message {
    position: fixed; 
	right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}
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
	 $CI = & get_instance();
	 $CI->load->model('admin/programs_model');
  	 $democourse = $CI->programs_model->getDemo_course();
  	 $democoursecategory = $CI->programs_model->getDemoCourse_category();
  	 $demomediacategory = $CI->programs_model->getDemomedia_categories();
  	 $demouser = $CI->programs_model->getDemo_user();
  	 $demomedia = $CI->programs_model->getDemo_media();
  	 if($democourse || $democoursecategory || $demomediacategory || $demouser || $demomedia)
  	 {
   }
  ?>

<span id="message"></span>
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<?php
			if(($u_data['groupid']=='4') || ($maccessarr['users']=='own') )
			{
			?>
			<div id="sticky-anchor"></div>
			<ul id="sticky" style="list-style:none; float: right;  display: flex;">
				<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
					<a href="<?php echo base_url(); ?>admin/resellers/trashresellers/" onclick="Joomla.submitbutton('edit')" class="btn btn-dark-grey">
						<span class="icon-32-new"></span><i class="entypo entypo-trash"></i>Trash
					</a>
				</li>
				<li id="toolbar-new" class="listbutton">
					<a href="<?php echo base_url(); ?>admin/resellers/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">
						<span class="icon-32-new"></span><i class="entypo entypo-popup"></i>Add Resellers
					</a>
				</li>
			</ul>
			<?php 
			} 
			?>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Manage Resellers';?></h2></div>
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
echo form_open_multipart(base_url().'admin/resellers/',$attributes);
?>
<div class="row">
  	<div class="col-sm-12 top-head-box" style="float: right;padding-top: 10px;">
		<div id="table-3_length">
			<span style="margin-right:1%;">
	      		<input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-height form-control" placeholder="Search user">
			</span>
			<span>
				<button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier" style="color: #666666;font-size: 23px;"></span></button> 
    		</span>
    	</div>
	</div>
</div>
<br>
    <?php echo form_close(); ?>
<div class='clear'></div>
	<thead>
		<tr role="row">
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Name</div></th>
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Email</div></th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Contact No.</div></th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Referral Code</div></th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Role</div></th>

            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Status</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
        </tr>
	</thead>
<?php if ($resellers): ?>	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;
	$iii = 0;
		foreach ($resellers as $user):	
		$user_group_id=$user->group_id;
		$user_group_name=$this->referrals_model->getGroupById($user_group_id);
?> 
	<tr class="odd camp<?php echo $i;?>">
		<td class="field-title" style="color: #666;text-transform: capitalize;"><?php echo $user->first_name.' '.$user->last_name;?></td>
        <td class="field-title" style="color: #666;"><?php echo $user->email;?></td>
        <td class="field-title" style="color: #666;"><center><?php echo '-';?></center></td>
        <td class="field-title" style="color: #666;"><?php echo $user->referral_code;?></td>
		<td class="field-title" style="color: #666;text-transform: capitalize;"><?php echo (isset($user_group_name[0]->title) && !empty($user_group_name[0]->title)) ? $user_group_name[0]->title : '';?></td>
		<td>
		<?php if($user->active){ ?>
			<a title='Inactive referral' onclick="return change_status(<?php echo $user->id.",".$user->active;?>)" type="button"><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>
			<?php }else{?>
			<a title="Active referral" onclick="return change_status(<?php echo $user->id.",".$user->active;?>)" type="button"><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>
			<?php }?>
		</td>
		<td class=" ">
        <?php
	if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all') || ($maccessarr['users']=='own'))
	{
	?>
			<a class='col-sm-4' href='<?php echo base_url(); ?>admin/resellers/edit/<?php echo $user->id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Edit User"></div></a>
	<?php
	}
	if(($u_data['groupid']=='4')  || ($maccessarr['users']=='own'))
	{
		if($user->group_id == '4')		
		{
	?>
        <a class="col-sm-4" onClick="return deleteconfirm(<?php echo $user->id?>,'<?php echo $this->uri->segment(3)?>')" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
		<?php 
    	if($user->emailsent !=1 || $user->active !=1)
     		{ 
     	?>
     	<a class="col-sm-4" id="resendEmail_<?php echo $user->id?>" onClick="resendEmail(<?php echo $user->id?>)" ><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Resend activation email"></i></a>
	<?php
			}
		}
		else
		{
     ?>
     	<a class="col-sm-4" onClick="return deleteconfirm2(<?php echo $user->id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
     	<?php 
	    	if($user->emailsent !=1 || $user->active !=1)
	     	{ 
     	?>
     	<a class="col-sm-4" id="resendEmail_<?php echo $user->id?>" onClick="resendEmail(<?php echo $user->id?>)" ><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Resend activation email"></i></a>
     <?php
     		}
		}

    }
	else
	echo "No Access";
	?>
		</td>
	</tr>
	<?php 
		$iii++;
	endforeach ?>
	<?php else: ?>
	<tr>
		<td colspan="5">
			<p class='text'>No users available yet!</p>
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
var $ =jQuery.noConflict();
function deleteconfirm(id1,id2) 
{
	$.confirm({
		title: 'Do you really want to delete user ?',
		content: ' ',
		confirm: function(){ 
				 window.location.href = "<?php echo base_url(); ?>admin/resellers/trash/"+id1+"/"+id2;
		},
		cancel: function(){        
				return true;
					}
			  });
}
</script>

<script>
var $ =jQuery.noConflict();
function deleteconfirm2(id) 
{ 
	$.confirm({
		title: 'Do you really want to delete Referral ?',
		content: ' ',
		confirm: function(){ 
				$.ajax({
	 				type:"POST",
	 				cache: false,
	 				url:"<?php echo base_url(); ?>admin/resellers/delete",
	 				data:{
	 					id:id
	 				},
	 				success:function(returndata)
	 				{
	 					$(".dataTable").load(location.href + " #table-2");
	 					var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+returndata+'</div>';
						var note = $(document).find('#message');
						note.html(str);
						note.show();
						note.fadeIn().delay(3000).fadeOut();
	 				}
	 			});
		},	
		cancel: function(){        
			return true;
		}
  	});
}

function change_status(id,status)
{
	$.ajax({
			type:"POST",
			cache: false,
			url:"<?php echo base_url(); ?>admin/resellers/changeStatus",
			data:{
				id:id,
				status:status
			},
			success:function(returndata)
			{
				$(".dataTable").load(location.href + " #table-2");
				var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+returndata+'</div>';
			var note = $(document).find('#message');
			note.html(str);
			note.show();
			note.fadeIn().delay(3000).fadeOut();
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

function resendEmail(id)
{
	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>resellers/emailsent",
			beforeSend : function(data)
			{ 
			  $("#resendEmail_"+id).html('<i class="fa fa-spinner fa-pulse"></i>Loading...');
		    }, 
			data: {id:id}, 
			success: function(data)
			{
				console.log(data);
					if(data=="success")
					{
						$.alert({
                           title: 'success !',
                  		   content: '<p style="font-size: large;font-weight: bold;text-align: center;padding-top: 12px;">Email sent successfully</p>',
                          confirm: function()
                                   {	
                                   		$("#resendEmail_"+id).attr('onclick','');
                                       $("#resendEmail_"+id).html('Sent');    
                                           return true;
                               
                                   }
                               });
					}
					else{
						$.alert({
                           title: 'Sorry!',
                  		   content: '<p style="font-size: large;font-weight: bold;text-align: center;padding-top: 12px;">Email send is fail</p>',
                          confirm: function()
                                   {	
                                   		$("#resendEmail_"+id).attr('onclick','');
                                       $("#resendEmail_"+id).html('<a class="col-sm-4" id="resendEmail_'+id+'" onclick="resendEmail('+id+'")"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Try again"></i></a>');    
                                           return true;
                               
                                   }
                               });
					}
			}
		  }); 
}
</script>