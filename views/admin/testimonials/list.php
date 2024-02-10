<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php
$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
$first = $start + 1;
$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
?>
<div class="main-container">

<!--@@@@@@@@@@@@@@@@ new tab end here @@@@@@@ -->

          <?php

          if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

          {

          ?>


        <div class="panel-body main-table form-body">
            <div id="sticky-anchor"></div>
            <ul id="sticky" style="float:right;  margin-top: 25px; list-style:none;margin-right: 20px;">

                <li id="toolbar-new" class="listbutton">

                    <a href="<?php echo base_url(); ?>admin/testimonials/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-success btn-green">

                    <span class="icon-32-new">

                    </span>

                    New

                    </a>

                </li>

            </ul>

          <?php

          }

          ?>

        <div class="clr"></div>
            <div class="pagetitle icon-48-generic mb_20">
                <h2 class="tab_heading"><?php echo 'Testimonial Block Manager';?></h2>
                <h6>The Testimonial Block will appear in the footer of your Online Academy's home page and will scroll on its own in that 
                block. You can Create, Edit, Delete, Publish and Unpublished them from here.</h6> 
            </div>
        <div><h2><?php //echo lang('web_category_list')?></h2></div>
        <span class="clearFix">&nbsp;</span>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title"><?php echo lang('web_name')?></div></th>
            
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Published</div></th>
            
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Edit</div></th>
            
        </tr>
        
	</thead>
<?php if ($testimonials): ?>	
 <?php $i=0; ?>	
<tbody role="alert" aria-live="polite" aria-relevant="all">
   <?php 
      $iii = 0;
   foreach ($testimonials as $testimonial): ?>
<tr class="odd camp<?php echo $i;?>" id='<?php echo $testimonial->id?>'>
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $testimonial->name; ?></td>
			
			<td class=" " align="center">
            <?php

                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

                {

                ?>

                    <?php if($testimonial->published){?>

                    <a title="Publish Item" href="<?php echo base_url(); ?>admin/testimonials/unpublish/<?php echo $testimonial->id?>/"><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>

                    <?php }else{?>

                    <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/testimonials/publish/<?php echo $testimonial->id?>/"><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>

                    <?php }?>

                <?php

                }

                else

                echo "No Access";

                ?>
            </td>
			
            <td class=" " align="center">
				
                <?php

                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

                {

                ?>

                    <a class="col-sm-offset-3 col-sm-4" href='<?php echo base_url(); ?>admin/testimonials/edit/<?php echo $testimonial->id?>/'><div class="sprite 2edit" style="background-position: -32px 0;" title="Edit content"></div></a>

                <?php

                }

                else

                     echo "Edit : No Access";

                ?>
                
				
				
                <?php

                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

                {

                ?>

                    <!--  <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/testimonials/delete/<?php echo $testimonial->id?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
                     <a class='col-sm-4' onClick="return deleteconfirm(<?php echo $testimonial->id?>);" ><div class="sprite 4delete" style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>

                <?php

                }

                else

                    echo "Delete : No Access";

                ?>

			</td>
		</tr>
    <?php

    $i++;
    $iii++;
    endforeach ?>

    <input type="hidden" name="boxchecked" value="0" />

    <input type="hidden" name="task" value="" />

    <input type="hidden" name="checkval" value=""/>

    </tbody>

</table>
</div>
</div>

<?php echo form_close(); ?>






   


<?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $counttesti; ?> entries</div>
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
</div>





<?php else: ?>

<p class='text'><?php echo lang('web_no_elements');?></p>

<?php endif ?>



<script>
var     $ =jQuery.noConflict();

        function deleteconfirm(id) 
          {
              
            $.confirm({
                title: 'Do you really want to delete testimonial ?',
                content: ' ',
                confirm: function(){ 
                         window.location.href = "<?php echo base_url(); ?>admin/testimonials/delete/"+id;
        
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