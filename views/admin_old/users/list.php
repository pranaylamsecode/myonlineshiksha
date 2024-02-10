<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/tour/css/jquerytour.css" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome/css/font-awesome.min.css">
<?php  
   /*echo '<pre>';
	print_r($users);
   echo '</pre>';*/
   
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;	
	$u_data=$this->session->userdata('loggedin');
	$maccessarr=$this->session->userdata('maccessarr');
?>
<script type="text/javascript">
		//var $ =jQuery.noConflict();
		var btn = document.getElementById("canceltour");
		btn.onclick = function() {
			
			$('#tourcontrols1').hide();
		}
        function demoContent()
       				 {  var $ =jQuery.noConflict(); 
       				 		
       				 		$.confirm({
    							title: ' Do you really want to delete demo content ? ',
    							content: 'This will not affect your created content.',
    							confirm: function(){

    								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>admin/programs/deleteDemo",
							//data: {follow_id:follow_id,student_id:student_id}, 
										success: function(data)
										{
								
							 			window.location.assign("<?php echo base_url(); ?>admin/users");
										}
		 								 });
       								
   									 },
   							 cancel: function(){
       						 return true;
    									}
								});	    
         	           
				 }
        </script>
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
	 $CI = & get_instance();
	 $CI->load->model('admin/programs_model');
  	 $democourse = $CI->programs_model->getDemo_course();
  	 $democoursecategory = $CI->programs_model->getDemoCourse_category();
  	 $demomediacategory = $CI->programs_model->getDemomedia_categories();
  	 $demouser = $CI->programs_model->getDemo_user();
  	 $demomedia = $CI->programs_model->getDemo_media();
  	 if($democourse || $democoursecategory || $demomediacategory || $demouser || $demomedia)
  	 {
  ?>
  
  <div id="tourcontrols1" class="tourcontrols" style="right: 600px; width: 439px;height: 81px; position: fixed;">
  <p>We have enabled demo content in Your Online Academy. You can anytime delete demo content using this button.</p>
  <span class="button" id="deleteDemo" onclick="demoContent();" style="margin-left:103px;margin-top: -18px;">Delete Demo Content</span>
  
  <span class="close" id="canceltour">&times</span>
  </div>
  <?php
   }
  ?>
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
						<a href="<?php echo base_url(); ?>admin/users/trashusers/" onclick="Joomla.submitbutton('edit')" class="btn btn-dark-grey">
							<span class="icon-32-new"></span><i class="entypo entypo-trash"></i>Trash
						</a>
					</li>
				
					<li id="toolbar-new" class="listbutton">

						<a href="<?php echo base_url(); ?>admin/users/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">

							<span class="icon-32-new"></span><i class="entypo entypo-popup"></i>New

						</a>

					</li>
				</ul>
			<?php 
			} 
			?>
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

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/users/',$attributes);
?>
<div class="row">
  <div class="col-sm-12 no-padding top-head-box">
	
	    <!-- <div id="table-3_length" class="dataTables_length"> -->
	<div id="table-3_length">
		<span style="margin-right:1%;">
	      <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-height form-control" placeholder="Users List">
		</span>
	<!-- </div> -->
  
	<!-- <div class="dataTables_filter" id="table-3_filter"> -->
   <!--  <div id="table-3_filter"> -->
    	<span style="margin-right:1%;">
            <select name="search_group" onchange="document.topform1.submit()" class="form-height form-control">
				<option value="">Select User Category</option>
				<option value='1' <?php //if($status == '1') echo "selected"; ?>>Learner</option>
				<option value='2' <?php //if($status == '1') echo "selected"; ?>>Trainer</option>
				<option value='3' <?php //if($status == '0') echo "selected"; ?>>Assistant</option>
				<option value='4' <?php //if($status == '1') echo "selected"; ?>>Admin</option> 				
			</select>
		</span>
		<span>
			<button type="submit" value="Search" name="submit_search" class="search-btn"><div class='sprite search' title="Search"></div></button>
			<button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>     
    	</span>
    </div>
	</div>
</div>

<br>
    <?php echo form_close(); ?>


<div class='clear'></div>

	<thead>
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">First Name</div></th>
            
                        
            <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Email</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Category</div></th>

            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
		
            
        </tr>
	</thead>
	
<?php if ($users): ?>	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;?>


		<?php 
			$iii = 0;
		foreach ($users as $user):	

		if($user->id != 5)	
		{

		 $user_group_id=$user->group_id;
		


		$user_group_name=$this->users_model->getGroupById($user_group_id);

		?> 
<tr class="odd camp<?php echo $i;?>">			
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $user->first_name;?></td>
            <td class="field-title" style="color: #949494;"><?php echo $user->email;?></td>
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo (isset($user_group_name[0]->title) && !empty($user_group_name[0]->title)) ? $user_group_name[0]->title : '';?></td>
			<td class=" ">
			<?php 
			 if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all') || ($maccessarr['users']=='own'))
				{
				?>
				<a class='col-sm-4' href='<?php echo base_url(); ?>admin/users/edit/<?php echo $user ->id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>
				<?php
				}
				if(($u_data['groupid']=='4')  || ($maccessarr['users']=='own'))
				{
				if($user->group_id == '4')		
				{
			
					 
				}
				elseif($user->group_id == '2')
				{
			?>
        	<a class="col-sm-4" onClick="return deleteconfirm(<?php echo $user->id?>,'<?php echo $this->uri->segment(3)?>')" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
			<?php 
	    	 if($user->emailsent !=1)
	     		{ 
	     	?>
     			<a class="col-sm-4" id="resendEmail_<?php echo $user->id?>" onClick="resendEmail(<?php echo $user->id?>)" ><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></a>
			<?php
				}
			}
			else
			{
	     ?>
	     <a class="col-sm-4" onClick="return deleteconfirm2(<?php echo $user->id?>,'<?php echo $this->uri->segment(3)?>')" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
	     	<?php 
	    	 if($user->emailsent !=1)
	     		{ 
	     	?>
	     	<a class="col-sm-4" id="resendEmail_<?php echo $user->id?>" onClick="resendEmail(<?php echo $user->id?>)" ><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></a>
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
	 }
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
</div>
<script>
var 	$ =jQuery.noConflict();

		function deleteconfirm(id1,id2) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete user ?',
    			content: ' ',
    			confirm: function(){ 
    					 window.location.href = "<?php echo base_url(); ?>admin/users/trash/"+id1+"/"+id2;
        
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}
</script>

<script>
var 	$ =jQuery.noConflict();

		function deleteconfirm2(id1,id2) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete user ?',
    			content: ' ',
    			confirm: function(){ 
    					 window.location.href = "<?php echo base_url(); ?>admin/users/trash1/"+id1+"/"+id2;
        
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


function resendEmail(id)
{
	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>users/emailsent",
			beforeSend : function(data)
			{ 
			  $("#resendEmail_"+id).html('<i class="fa fa-spinner fa-pulse"></i>Loading...');
		    }, 
			data: {id:id}, 
			success: function(data)
			{
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
			}
		  }); 
}
</script>