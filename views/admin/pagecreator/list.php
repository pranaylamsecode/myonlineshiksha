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
		{ ?>
		<div id="sticky-anchor"></div>
		<ul id="sticky" style="list-style:none; float:right;">
		<li id="toolbar-new" class="listbutton">
		<a href="<?php echo base_url(); ?>admin/create/custom-page/"  class="btn btn-green">
		<span class="icon-32-new"></span><i class="entypo entypo-popup"></i>	Add Page	</a>
		</li></ul><?php 
	} ?>
	<div class="clr"></div>
	</div>
	<div class="pagetitle icon-48-generic"><h2>Pages</h2>
        <p class="pmaintitle main_subtitle" style="margin-bottom: 0px;"> Create pages of your academy. </p>
        </div>
<!--  -->	</div></div>
	<div class='clear'></div>
    
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<?php

$attributes = array('class' => 'tform', 'name' => 'topform1');



echo form_open_multipart(base_url().'admin/pagecreator/',$attributes);

?>
<div class="row">
<div class="col-sm-12 top-head-box">

    <!-- <div class="dataTables_filter" id="table-3_filter"> -->
<div id="table-3_filter">
      <span style="margin-right:1%;">
    	<input type="text" class="form-height form-control" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Page Title">	
    </span>    
<!-- </div> -->

	<span>
    <!-- <div id="table-3_length" class="dataTables_length"> -->
   <!--  <div id="table-3_length">  	 -->
		<button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier" style="color: #666666;font-size: 23px;"></span></button>     
    </span>
</div>
</div>
</div>
<br>
<?php echo form_close(); ?>

<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
   
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"><div class="checked"></div></label>
				</div>
			</th>-->
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Page Title</div></th>
            
           <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Modified date</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Status</div></th>
            
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
            
         </tr>
          </thead>
 <tbody role="alert" aria-live="polite" aria-relevant="all">        
    <?php if ($allpages):

	    
	?>
    <?php $i=0;?>
	<?php 
	   $iii = 0;
	    
	foreach ($allpages as $eachpage): 		
	  
	?>
	
	   
        <tr class="odd" id="camp<?php echo $i;?>">
			
            <!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper">
                 <input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $eachpage->page_id;?>">									                    
				 <div class="checked"></div>
                    </label>
				</div>
			</td>-->
			<td class="field-title" style="color: #666;text-transform: capitalize;">
			<?php /* ?><a href="<?php echo base_url(); ?>admin/groups/edit/<?php echo $group ->id?>/"> <?php */ ?>
			<?php echo $eachpage->heading;?>      
			<?php /* ?>  </a> <?php */ ?>
            </td>
			<td class="" align="center">
			
			<?php echo $eachpage->createdon;?>      
			</td>
			<td class=" " align="center">
            <?php if($eachpage->status == "active"){?>
		         
                 <a title="Publish" href="<?php echo base_url(); ?>admin/pagecreator/unpublish/<?php echo $eachpage->page_id; ?>/"><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>        
		         <?php        }else{ ?>        
		        
                 <a title="Unpublish" href="<?php echo base_url(); ?>admin/pagecreator/publish/<?php echo $eachpage->page_id;?>/"><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>        
		         <?php } ?>      
            </td>
			
			<td class=" " align="center">
				
                
                <?php 
		        if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
		        {
		            if($eachpage->type=='contact')        {
		                   //$link="editContactPage/".$eachpage->page_id;
		                   $link="editContactPage/".$eachpage->page_id;        
		     	}        
		     	else
		     	{
		            //$link="editPage/".$eachpage->page_id;
		            $link="editPage/".$eachpage->page_id;
		        }
		        //print_r($eachpage->type);
		        ?>       
		        <a class='col-sm-offset-2 col-sm-4 no-padding' href="<?php echo base_url(); ?>admin/pagecreator/<?php echo $link?>/"><div class='sprite 2edit' style="background-position: -32px 0;" title="Edit page"></div></a>      
		        	<?php
					if($eachpage->type!='contact' && $eachpage->type!='about' && $eachpage->heading !='Terms of Use' )
					{

					?>	     
		        	<!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/pagecreator/delete/<?php echo $eachpage->page_id?>'><i class="entypo-cancel"></i>delete</a> -->
		        	<a class='col-sm-4' onClick="return deleteconfirm('<?php echo $eachpage->page_id?>')" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
		        	<?php
		        	}
		        	?>
		        <?php }else{  echo "No Access";}?>     
                
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
               title: 'Do you really want to delete Page ?',
               content: ' ',
               confirm: function(){ 
                                window.location.href = "<?php echo base_url(); ?>admin/pagecreator/delete/"+id;

                                   },
               cancel: function(){        
                               return true;
                                       }
                             });
	}

</script>