<?php
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.mousewheel-3.0.6.pack.js"></script>



  <script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>



  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />



  <script type="text/javascript">



    $(document).ready(function() {



      /*



       *  Simple image gallery. Uses default settings



       */







      $('.fancybox').fancybox();







      /*



       *  Different effects



       */







      // Change title type, overlay closing speed



      $(".fancybox-effects-a").fancybox({



        helpers: {



          title : {



            type : 'outside'



          },



          overlay : {



            speedOut : 0



          }



        }



      });







      // Disable opening and closing animations, change title type



      $(".fancybox-effects-b").fancybox({



        openEffect  : 'none',



        closeEffect : 'none',







        helpers : {



          title : {



            type : 'over'



          }



        }



      });







      // Set custom style, close if clicked, change title type and overlay color



      $(".fancybox-effects-c").fancybox({



        wrapCSS    : 'fancybox-custom',



        closeClick : true,







        openEffect : 'none',







        helpers : {



          title : {



            type : 'inside'



          },



          overlay : {



            css : {



              'background' : 'rgba(238,238,238,0.85)'



            }



          }



        }



      });







      // Remove padding, set opening and closing animations, close if clicked and disable overlay



      $(".fancybox-effects-d").fancybox({



        padding: 0,







        openEffect : 'elastic',



        openSpeed  : 150,







        closeEffect : 'elastic',



        closeSpeed  : 150,







        closeClick : true,







        helpers : {



          overlay : null



        }



      });







      /*



       *  Button helper. Disable animations, hide close button, change title type and content



       */







      $('.fancybox-buttons').fancybox({



        openEffect  : 'none',



        closeEffect : 'none',







        prevEffect : 'none',



        nextEffect : 'none',







        closeBtn  : false,







        helpers : {



          title : {



            type : 'inside'



          },



          buttons : {}



        },







        afterLoad : function() {



          this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');



        }



      });











      /*



       *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked



       */







      $('.fancybox-thumbs').fancybox({



        prevEffect : 'none',



        nextEffect : 'none',







        closeBtn  : false,



        arrows    : false,



        nextClick : true,







        helpers : {



          thumbs : {



            width  : 50,



            height : 50



          }



        }



      });







      /*



       *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.



      */



      $('.fancybox-media')



        .attr('rel', 'media-gallery')



        .fancybox({



          openEffect : 'none',



          closeEffect : 'none',



          prevEffect : 'none',



          nextEffect : 'none',







          arrows : false,



          helpers : {



            media : {},



            buttons : {}



          }



        });







      /*



       *  Open manually



       */







      $("#fancybox-manual-a").click(function() {



        $.fancybox.open('1_b.jpg');



      });







      $("#fancybox-manual-b").click(function() {



        $.fancybox.open({



          href : 'iframe.html',



          type : 'iframe',



          padding : 5



        });



      });







      $("#fancybox-manual-c").click(function() {



        $.fancybox.open([



          {



            href : '1_b.jpg',



            title : 'My title'



          }, {



            href : '2_b.jpg',



            title : '2nd title'



          }, {



            href : '3_b.jpg'



          }



        ], {



          helpers : {



            thumbs : {



              width: 75,



              height: 50



            }



          }



        });



      });











    });



                                      



  </script>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
        <?php
        if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
        {
        ?>
			<ul style="float:right; list-style: none;">
			<li id="toolbar-new" class="listbutton">
            <a href="<?php echo base_url(); ?>admin/templates/addlayout/"  class="btn btn-success">
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
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Template Manager';?></h2></div>
	</div>
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
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Name</th>
            
           <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 125px;"></th>
            <!-- <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 125px;">Publish Status</th> -->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Options</th>
            
            </tr>
	</thead>
	<?php if ($templates): ?>
	
<tbody role="alert" aria-live="polite" aria-relevant="all">
		<?php $i=0;?>
		<?php foreach ($templates as $template): ?>
	<tr class="camp<?php echo $i;?>"> 	 
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php echo $template->id;?>"><div class="checked"></div></label>
				</div>
			</td>-->
           
			<td class=" ">
            <?php /* ?><a href="<?php echo base_url(); ?>admin/groups/edit/<?php echo $group ->id?>/"> <?php */ ?>
        	<?php echo $template->name;?>
      		<?php /* ?>  </a> <?php */ ?>
            </td>
             <td class=" "></td>
            <!--<td class=" "></td>-->
			<!-- <td> -->

      <?php /*if($template->status == "active"){*/?>
        <!-- <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/templates/unpublish/<?php echo $template->id; ?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a> -->
        <?php
        /*}else{*/ ?>
       <!--  <a title="Publish Item" href="<?php echo base_url(); ?>admin/templates/publish/<?php echo $template->id;?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a> -->
        <?php /*}*/ ?>

      <!-- </td> -->
			<td class=" ">
				
                
                <?php
if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
{
        if($template->type=='contact')
        {
          $link="editoptions/".$template->id;
        }
        else
        {
          $link="editoptions/".$template->id;
        }
?>

       <a class="btn btn-default btn-sm btn-icon icon-left" href="<?php echo base_url(); ?>admin/templates/<?php echo $link?>/"><i class="entypo-pencil"></i>edit</a>
      <?php /* ?> <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/groups/delete/<?php echo $template->id?>'><i class="entypo-cancel"></i>delete</a> <?php */ ?>
<?php
}
else
{
  echo "No Access";
}
?>
			</td>
		</tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php else: ?>

	<p class='text'><?php echo lang('web_no_elements');?></p>

<?php endif ?>

        
        <!---Pagination-->       
		 <?php if($this->pagination->create_links()) { ?>     
		<div class="row">
			<div class="col-xs-6 col-left">
				<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div>
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


