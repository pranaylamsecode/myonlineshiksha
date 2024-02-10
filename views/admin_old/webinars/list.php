<?php

 

$u_data=$this->session->userdata('loggedin');



$maccessarr=$this->session->userdata('maccessarr');



?>







<script>



    function isChecked(isitchecked) {



        if (isitchecked == true) {



        document.orderform.boxchecked.value++;



        } else {



        document.orderform.boxchecked.value--;



        }



    }



    function listItemTask(id, task) {



        var f = document.orderform;



        var cb = f[id];



        $("#tr"+id).remove();







        if (cb) {



        for (var i = 0; true; i++) {



        var cbx = f['cb'+i];



        if (!cbx)



        break;



        cbx.checked = false;



        } // for



        cb.checked = true;



        f.boxchecked.value = 1;



        var checkval = $('#'+id+':checked').val();



        document.orderform.checkval.value = checkval;



        submitbutton(task);



        }



        return false;



    }



    function submitbutton(pressbutton) {



        var form = document.orderform;







        submitform ( pressbutton );



    }



    function submitform(pressbutton) {







        if (pressbutton) {



        document.orderform.task.value = pressbutton;



        }



        if (typeof document.orderform.onsubmit == "function") {



        document.orderform.onsubmit();



        }



        if (typeof document.orderform.fireEvent == "function") {



        document.orderform.fireEvent('submit');



        }



        document.orderform.submit();



    }



    function saveorder(n, task) {



        checkAll_button(n, task);



    }



    function checkAll_button(n, task) {



        if (!task) {



        task = 'saveorder';



        }



        document.orderform.submit();



    }



</script>




<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">


<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
		<?php



          if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))



          {



          ?>

			<ul style="list-style: none; float: right;">

			<li id="toolbar-new" class="listbutton">
            <a href="<?php echo base_url(); ?>admin/webinars/create/<?php echo $proid?>" onclick="Joomla.submitbutton('edit')" class="btn btn-success"><span class="icon-32-new">
</span>New</a>

            <a href="<?php echo base_url(); ?>admin/programs" class="btn btn-default"><span class="icon-32-back"> </span>Back</a>

			

			</li>

			</ul>
             <?php



          }



          ?>

			<div class="clr"></div>
		</div>
		
        <div class="pagetitle icon-48-generic"><h2><?php echo 'Course Webinars';?></h2></div>
	</div>
</div>
<div class='clear'></div>
<div><h2><?php //echo lang('web_category_list')?></h2></div>
<div class='clear'></div>



<?php



$attributes = array('class' => 'tform', 'name' => 'topform1');



echo form_open_multipart(base_url().'admin/webinars/listings',$attributes);



?>



<!--<form action="<?=site_url('admin/quizzes/')?>" method="post">-->
<div class="row">
  <div class="col-xs-6 col-left">
    <div id="table-3_length" class="dataTables_length">
	
    	<input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control">

		<input type="submit" value="Search" name="submit_search" class="btn btn-blue">

 		<input type="submit" value="Reset" name="reset"  class="btn btn-red">

    </div>
  </div>
  
  <div class="col-xs-6 col-right">
    <div class="dataTables_filter" id="table-3_filter">
      
    </div>
  </div>
</div>
<?php echo form_close(); ?>

<div class='clear'></div>



<?php



$attributes = array('class' => 'tform', 'name' => 'orderform');



echo form_open_multipart(base_url().'admin/webinars/',$attributes);



?>



<?php if ($webinars): ?>
    





    <thead>



        <!--<th>ID</th>-->



        <th><?php echo lang('web_name')?></th>



        <!--<th>Sub Categories</th>



        <th>Order<a class="saveorder" href="javascript: saveorder(<?php echo count($webinars)-1; ?>, 'saveorder')">__</a></th>-->



        <th align="center">Published</th>



        <th colspan='2'><?php echo lang('web_options')?></th>



    </thead>







    <tbody>



    <?php $i=0; foreach ($webinars as $webinar): ?>



        <tr id='<?php echo $webinar->id?>'>



            <!--<td><?php //echo $webinar->id?></td>-->



            <td width='400'>



                <?php echo $webinar->title; ?>



            </td>



        



            <td width='150' align="center">



                <?php



                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))



                {



                ?>



                    <?php if($webinar->status=='active'){?>



                    <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/webinars/unpublish/<?php echo $webinar ->id?>/<?php echo $proid?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>



                    <?php }else{?>



                    <a title="Publish Item" href="<?php echo base_url(); ?>admin/webinars/publish/<?php echo $webinar ->id?>/<?php echo $proid?>"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>



                    <?php }?>



                <?php



                }



                else



                echo "No Access";



                ?>



            </td>



            <td width="60">



                <?php



                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))



                {



                ?>



                    <a class="btn btn-default btn-sm btn-icon icon-left" href='<?php echo base_url(); ?>admin/webinars/edit/<?php echo $webinar->id?>/<?php echo $proid?>'><i class="entypo-pencil"></i><?php echo lang('web_edit')?></a>



                <?php



                }



                else



                     echo "Edit : No Access";



                ?>



            </td>



            <td width="60">



                <?php



                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))



                {



                ?>



                     <a class="btn btn-danger btn-sm btn-icon icon-left" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/webinars/delete/<?php echo $webinar->id?>/<?php echo $proid?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a>



                <?php



                }



                else



                    echo "Delete : No Access";



                ?>



            </td>







        </tr>







    <?php



    $i++;



    endforeach ?>



    <input type="hidden" name="boxchecked" value="0" />



    <input type="hidden" name="task" value="" />



    <input type="hidden" name="checkval" value=""/>



    </tbody>



</table>



<?php echo form_close(); ?>



<div class="containerpg">



    <div class="pagination">



         <?php echo $this->pagination->create_links();  ?>



    </div>



</div>



<?php else: ?>



<p class='text'><?php echo lang('web_no_elements');?></p>



<?php endif ?>