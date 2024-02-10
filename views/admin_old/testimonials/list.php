<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
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
<!-- @@@@@@@@@@@@@@@ new tab start here by sachin @@@@@@@ -->
<div class="pagetitle icon-48-generic"><h2>Online academy Design Setting</h2>
        <p> Here you can design the look and feel of your Online Academy</p>
        </div>
<div class="panel-heading">
                <div class="panel-title" style="padding:0;width:100%;">
                    <!-- <ul class="nav nav-tabs bordered"> --><!-- available classes "bordered", "right-aligned" --> 
                    <!-- <li ><a href="#logo_style" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">Logo and Theme Color</a></span></a></li> 
                    <li> <a href="#homepagesettings" data-toggle="tab"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">HomePage Settings</a></span></a></li>
                    <li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">Banner and Slider</a></span></a></li>
                    
                    <li > <a href="<?php echo base_url();?>admin/widgets/index">Widgets</a></li>
                    <li class="active"> <a href="<?php echo base_url();?>admin/testimonials">Testimonials</a></li>
                    <li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/sociallinks/createLink">Social Link</a></span></a></li> -->
                    <!--<li> <a href="#bannerslider" data-toggle="tab"><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs"><a href="<?php echo base_url();?>admin/pagecreator">Pages</a></span></a></li>
                    <li> <a href="#fillintheblanks" data-toggle="tab"><span class="visible-xs"><i class="entypo-cog"></i></span><span class="hidden-xs">Fill In The Blanks</span></a></li>-->
                    <!-- </ul> -->

                    <ul class="nav nav-tabs bordered grey-border blue-border"><!-- available classes "bordered", "right-aligned" --> 
                    <li style="border-left:none;"><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">Logo and Theme Color</a></li> 
                    <li><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">HomePage Settings</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/templates/editoptions/45">Banner and Slider</a></li>
                    
                    <li > <a href="<?php echo base_url();?>admin/widgets/index">Widgets</a></li>
                    <li class="active"> <a href="<?php echo base_url();?>admin/testimonials">Testimonials</a></li>
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

          <?php

          if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

          {

          ?>
<div id="sticky-anchor"></div>
            <ul id="sticky" style="float:right;  margin-top: 1%; list-style:none;">

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

        </div>


        <div class="pagetitle icon-48-generic"><h4><?php echo 'Testimonial Block Manager';?></h4></div>
        <p class="pquestionsub">The Testimonial Block will appear in the footer of your Online Academy's home page and will scroll on its own in that 
        block. You can Create, Edit, Delete, Publish and Unpublished them from here.</p> 
    </div>

</div>

<div><h2><?php //echo lang('web_category_list')?></h2></div>
<div>
    <span class="clearFix">&nbsp;</span>
</div>
<div class='clear'></div>






<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title"><?php echo lang('web_name')?></div></th>
            
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Published</div></th>
            
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title"><?php echo lang('web_options')?></div></th>
            
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

                    <a class="col-sm-offset-3 col-sm-4" href='<?php echo base_url(); ?>admin/testimonials/edit/<?php echo $testimonial->id?>/'><div class="sprite 2edit" style="background-position: -32px 0;" title="Course Content"></div></a>

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