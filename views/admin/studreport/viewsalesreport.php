<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
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


<div class="main-container">

	<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic">
			<h2>Co-Teacher Sales</h2>
			<h6 class="pmaintitle main_subtitle">Report displaying the sales report of the courses created by Co-Teachers.</h6>
		</div>
	</div>
	
</div>

 <div class="no-padding top-head-box">
  
    <!-- <div class="dataTables_length" id="table-3_filter"> -->
    <div id="table-3_length">  
    	<span >  
			<select placeholder="Course" name="catid" id='catid' size="1" class="form-height form-control">
    			<option value="">Course</option>
    			<?php
    			foreach ($program as $prog):
                //$cat_name = ($this->input->post('catid') && $this->input->post('catid') == $category->id) ? 'selected="selected"' : '';
                ?>

    			<option value='<?php echo $prog->id?>'><?php echo $prog->name;?></option>
				<?php endforeach ?>
			</select>
    	</span>
       	<span >	
                <select placeholder="Select Period" name="period" class="form-height form-control">
					<option value="">Select Period</option>
					<option value='today' >Today</option>
					<option value='week' >1 Week</option>
					<option value='month' >1 Month</option>
					<option value='year' >1 Year</option>
					<option value='all' >All</option>
				</select>
		</span>
    <!-- </div> -->
    <!-- <div id="table-3_length" class="dataTables_filter">	 -->
    <!-- <div id="table-3_length">	 -->
      	<!--input type="text" value="<?php echo set_value('first_name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" class="form-control">-->
      <span>
		<button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier" ></span></button>

		
      </span>
    </div>
  </div>

<div class="card">
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php
	$attributes = array('class' => 'tform', 'name' => 'topform1');
	echo form_open_multipart(base_url().'admin/studreport/sales/',$attributes);
?>



    

<?php echo form_close(); ?>


	<thead>
		<tr role="row">        	
            <!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Teacher Name</div></th>
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">User Name</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Course</div></th>
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Price</th>-->
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Subscription</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Date of Purchase</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Amount</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Sale Percentage Amount</div></th>
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

	  	 $getAuther = $this->users_model->getAuther($order->courses);

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
			<td class="field-title "><?php echo $getAuther->first_name." ".$getAuther->last_name; ?></td>
			<td class="field-title "><?php echo $this->users_model->getUserName($order->userid);?></td>
			<td class="field-title "><?php echo $this->users_model->getProgramName(@$coursearr[0]);?></td>
			<!--<td class=" "><?php echo @$coursearr[1];?></td>-->
            <td class="field-title "><?php echo $this->users_model->getPlanName(@$coursearr[2]);?></td>
			<td class="field-title "><?php echo $order->order_date.' GMT';?></td>
			<td class="field-title "><?php echo $order->amount;?></td>
			<?php
			   $actual_price = $order->amount;
			   $get_percentage ="";
			   if($getAuther)
			   {
			   if($getAuther->coursepercent)
	            {
	                $tt = 100 - $getAuther->coursepercent;
	              $fraction_value = $tt/100;
	              $get_percentage = $actual_price * $fraction_value;
	            }
	            else
	            {
	               $get_percentage = "";
	            }
	          }
			?>
			<td class="field-title "><?php echo $get_percentage;?></td>
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
<div class="row pagination">
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
</div><!-- card -->
</div>
</div>


