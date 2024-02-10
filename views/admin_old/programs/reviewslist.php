<?php
 //	echo '<pre>';
//	print_r($reviews);
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/tour/css/jquerytour.css" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<script src="<?php echo base_url(); ?>public/tour/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/tour/js/ChunkFive_400.font.js" type="text/javascript"></script>

<?php
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	
  $first = $start + 1;
  $u_data=$this->session->userdata('loggedin');


  $maccessarr=$this->session->userdata('maccessarr');


?>


<!--lightbox scripts and style


	<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>-->


	
	<script type="text/javascript">
		//var $ =jQuery.noConflict();
        function demoContent()
       				 {  var $ =jQuery.noConflict();       	           
         	           	var x = confirm("Are you sure you want to delete?");
					if (x == true)
						{
         	           	$.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>admin/programs/deleteDemo",
							//data: {follow_id:follow_id,student_id:student_id}, 
							success: function(data)
							{
								
							 window.location.assign("<?php echo base_url(); ?>admin/programs");
							}
		 					 });
         	           }
         	           else{
				return false;
					}
         	           
				 }
        </script>

	<style type="text/css">


		.fancybox-custom .fancybox-skin {


			box-shadow: 0 0 50px #222;


		}


	</style>

<div class="main-container">

<div id="toolbar-box">


	<div class="m">


		<div id="toolbar" class="toolbar-list">







			<div class="clr"></div>


		</div>


		<div class="pagetitle icon-48-generic"><h2><?php echo 'Reviews of '.$this->programs_model->getProgramName($pro_id);?></h2></div>


	</div>


</div>

<p class="pmaintitle main_subtitle">
	Here you can manage your course media library. You can add any type of media, including text, video, audio, files, documents, PDF, etc. Which can be added to the course and lecture.
</p>

<?php


$attributes = array('class' => 'tform', 'name' => 'topform1');


echo form_open_multipart(base_url().'admin/medias',$attributes);


?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">

  <div class="col-xs-12 no-padding top-head-box">
    <div id="table-3_length" class="dataTables_length">
    <span style="margin-right:1%;">
		  <input class="form-height form-control" type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">
    </span>
    <span>
    <button type="submit" value="Search" name="submit_search" class="search-btn" ><div class='sprite search' title="Search"></div></button>
    <button type="submit" value="Reset" name="reset" class="search-btn" style=""><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>
  </span>
    </div>
  </div>
  
  
</div>
<br>
<?php echo form_close(); ?>
<div class="clear"></div>





<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">

<thead>
	
    <tr role="row">
        
        <!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
			<div class="checkbox checkbox-replace neon-cb-replacement">
				<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
			</div>
		</th>-->
        
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Name</div></th>
        
        <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Rate</div></th>
        
       <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Title</div></th>
       
       <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Description</div></th>
       
       <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Date</div></th>
        
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center;"><div class="col-sm-12 no-padding table-title">Options</div></th>
        
     </tr>

</thead>
<?php if ($reviews): ?>	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;


 //echo "<pre>";


 //print_r($medias);


 //echo "</pre>";


?>

<?php $iii = 0; foreach ($reviews as $review): ?>
<?php
       $username = $this->programs_model->getUserName($review->user_id);
       if($username)
       {

         ?>
<tr class="camp<?php echo $i;?>">
			
            <!--<td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $media->id?>">--> <!--</td> -->   
            
			<!--<td><?php //echo $media->id;?></td>-->

			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
			<td class="field-title" style="color: #949494;text-transform: capitalize;">
				
				<?php echo ucfirst($username);?>
        		<?php /* ?></a> <?php */ ?>
            </td>
            <td class="field-title" style="color: #949494;text-transform: capitalize;text-align:center!important;">
	   		<?php /* ?>
	   			<a href="<?php echo base_url(); ?>admin/medias/edit/<?php echo $media ->id?>" class="a_mlms">  <?php */ ?>
					<?php echo $review->review_rate?>
	       			<?php /* ?>
				</a> 
			<?php */ ?>
			</td>

			<td class="field-title" style="color: #949494;text-transform: capitalize;">
            <?php echo $review->title?>
            </td>
            
            <td class="preview field-title" style="color: #949494;text-transform: capitalize;">
              <?php echo $review->description?>
            </td>
            
            <td class="field-title" style="color: #949494;text-transform: capitalize;text-align:center!important;">
              <?php echo $review->review_date?>
            </td>
            
           
			
			<td class="editdelete" align="center">
            
            <?php


if(($u_data['groupid']=='4') || ($maccessarr['media']=='modify_all') || ($maccessarr['media']=='own'))


{


?>


        <!-- <a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/programs/editreview/<?php echo $review->review_id?>/<?php echo $pro_id;  ?>'><i class="entypo-pencil"></i><?php echo lang('web_edit')?></a> -->

        <a class='col-sm-6' href='<?php echo base_url(); ?>admin/programs/editreview/<?php echo $review->review_id?>/<?php echo $pro_id;  ?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>
        


<?php


}

if(($u_data['groupid']=='4') || ($maccessarr['media']=='own'))


{
?>
  <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/programs/deletereview/<?php echo $review->review_id?>/<?php echo $pro_id; ?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
  <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return deleteconfirm('<?php echo $review->review_id?>','<?php echo $pro_id; ?>')" ><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
  <a class='col-sm-6' onClick="return deleteconfirm('<?php echo $review->review_id?>','<?php echo $pro_id; ?>')" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
<?php

}

else


echo "No Access";


?>

            
				
			</td>

		</tr>
        <?php } $iii++; endforeach ?>

  





<?php else: ?>



           <tr><td colspan="7">


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

  
   <script type="text/javascript">

jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

  var $j =jQuery.noConflict();
  function deleteconfirm(id,pid)
       {         
         $j.confirm({
        title: 'Do you really want to delete Review ?',
        content: ' ',
        confirm: function(){
            window.location.href = "<?php echo base_url(); ?>admin/programs/deletereview/"+id+"/"+pid;
           },
        cancel: function(){
                      return true;
                     }
              });  
                       
       }
</script>
