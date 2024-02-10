<?php
  // print_r($this->load->model('admin/Users_model')); 
  $start = ( $this->uri->segment(4))  ? $this->uri->segment(4) : 0;
  $first = $start + 1;
?>

<!--<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Sales Report';?></h2></div>
	</div>
</div>
<div class='clear'></div>-->



<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php
	$attributes = array('class' => 'tform', 'name' => 'topform1');
	echo form_open_multipart('admin/studreport/sales/',$attributes);
?>

<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2>Sales Report</h2></div>
	</div>
	Here you can view the sales figures of online academy course wise or period wise.
</div>
<div class='clear'></div>
<div class="row">
  <div class="col-xs-4 col-left">
    <div id="table-3_length" class="dataTables_length">	
      	<!--input type="text" value="<?php echo set_value('first_name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control">-->

		<input type="submit" value="Search" name="submit_search" class="btn btn-blue">

		<input type="submit" value="Reset" name="reset" class="btn btn-red">
    </div>
  </div>
  
  <div class="col-xs-8 col-right">
    <div class="dataTables_filter" id="table-3_filter">
        <label style="margin-left:10px;">
		Course :
			<select name="catid" id='catid' size="1" class="form-control">
    			<option value="">All</option>
    			<?php
    			foreach ($program as $prog):
                //$cat_name = ($this->input->post('catid') && $this->input->post('catid') == $category->id) ? 'selected="selected"' : '';
                ?>

    			<option value='<?php echo $prog->id?>'><?php echo $prog->name;?></option>
				<?php endforeach ?>
			</select>
    </label>
    	<label>
       		Period :
                <select name="period" class="form-control">
					<option value="">- select -</option>
					<option value='today' >Today</option>
					<option value='week' >1 Week</option>
					<option value='month' >1 Month</option>
					<option value='year' >1 Year</option>
					<option value='all' >All</option>
				</select>
		</label>
    </div>
  </div>
</div>

    

<?php echo form_close(); ?>
<div class='clear'></div>

	<thead>
		<tr role="row">        	
            <!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">User Name</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Course</th>
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Price</th>-->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Subscription</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Date of Purchase</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Amount</th>
            
         </tr>	
    </thead>
	
<?php if ($orders):
/*echo '<pre>';
print_r($orders);
echo '</pre>';*/
?>

	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;?>


	<?php 
	       $iii = 0;
	    
	  foreach ($orders as $order){


        $coursearr=explode('-',$order->courses);

    ?>
<tr class="camp<?php echo $i;?>">
<!-- <td><input type="checkbox" title="Checkbox for row <?php //echo $i;?>" onclick="Joomla.isChecked(this.checked);" value="2" name="cid[]" id="cb<?php //echo $order->id?>">--><!--</td>-->
<!--<td><?php //echo $order->id;?></td>-->
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
             <?php /* ?><td><a href="<?php echo base_url();?>admin/users/edit/<?php echo $order->userid?>"><?php echo $this->users_model->getUserName($order->userid);?></a></td>  <?php */ ?>
			<td class=" "><?php echo $this->users_model->getUserName($order->userid);?></td>
			<td class=" "><?php echo $this->users_model->getProgramName(@$coursearr[0]);?></td>
			<!--<td class=" "><?php echo @$coursearr[1];?></td>-->
            <td class=" "><?php echo $this->users_model->getPlanName(@$coursearr[2]);?></td>
			<td class=" "><?php echo $order->order_date;?></td>
			<td class=" "><?php echo $order->amount;?></td>
			<!--<td class=" ">
            <?php


		if($order->status == 'Pending')


		{


		?>


		<a href="<?php echo base_url(); ?>admin/orders/paid/<?php echo $order->id;?>/" style="text-decoration:none" ><?php echo $order->status; ?></a>


		<?php


		}


		else


		{


		?>


		<a href="<?php echo base_url(); ?>admin/orders/pending/<?php echo $order->id;?>/" style="text-decoration:none" ><?php echo $order->status; ?></a>


		<?php


		}


		?>
            </td>
			<td class=" "><?php echo $order->pending_reason;?></td>
			<td class=" ">
				<?php echo $order->processor;?>
			</td>-->

            <?php /* ?>	<td><a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/orders/delete/<?php echo $order->id?>'><?php echo lang('web_delete')?></a>  </td> <?php */ ?>
		</tr>
        <?php
		  $iii++;
		} ?>
		
		    <?php else: ?>



           <tr><td colspan="11">


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
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countorders; ?> entries</div>
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




