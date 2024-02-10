<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;
?>
<div class="main-container">
<div id="toolbar-box">



	<div class="m">



		<div id="toolbar" class="toolbar-list">



			<ul style="float:right; list-style:none;">



			<li id="toolbar-new" class="listbutton">



            <a href="<?php echo base_url(); ?>admin/promocodes/create" onclick="Joomla.submitbutton('edit')" class="btn btn-green">

            <i class="entypo entypo-popup"></i>

            <span class="icon-32-new">



            </span>



            New



            </a>



			</li>



			</ul>



			<div class="clr"></div>



		</div>



		<div class="pagetitle icon-48-generic"><h2><?php echo 'Promocodes Manager';?></h2></div>



	</div>



</div>

<div style="margin-bottom:10px;"><p class="pmaintitle main_subtitle">Promo codes are a great way to increase your sales. You can create them right here. To create a new promo code, click New on top.</p></div>




<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<?php



$attributes = array('class' => 'tform', 'name' => 'topform1');



echo form_open_multipart(base_url().'admin/promocodes/',$attributes);



?>
<div class="row">
<div class="col-sm-12 no-padding top-head-box">
  
    <!-- <div id="table-3_length" class="dataTables_length"> -->
    <div id="table-3_length">
      <span style="margin-right:1%;">
      	<input type="text" name="search_promos" value="" class="form-height form-control"placeholder="Promocodes">
      </span>
    <!-- </div> -->
    <!-- <div class="dataTables_filter" id="table-3_filter"> -->
    <!-- <div id="table-3_filter"> -->
      
          <span style="margin-right:1%;">      
              <select name="promos_publ_status" onchange="document.topform1.submit()" class="form-height form-control">

              <option value="">Select Published status</option>

              <option value="1">Published</option>

              <option value="0">Unpublished</option>

            </select>
          </span>
          <span>
            <button type="submit" name="submit_src" value="Search" class="search-btn"><div class='sprite search' title="Search"></div></button>
            <button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>    
          </span>
    </div>
  
</div>
</div>
<br>
<?php echo form_close(); ?>

<div class='clear'></div>

<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
	<tr role="row"><th class="sorting_disabled col-sm-1" role="columnheader" rowspan="1" colspan="1" aria-label="" style="text-align:center">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Title</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Code</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Date</div></th>
            
             <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Status</div></th>
             
              <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Time used</div></th>
              
               <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Usage left</div></th>
               
                <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Published</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align:center"><div class="col-sm-12 no-padding table-title">Options</div></th>
            
        </tr>
            
	</thead>
<?php if ($promocodes):
//print_r($orders);
?>
<?php $i=0;?>
<tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php
           $iii = 0;
        foreach($promocodes as $promocode)
		{

            $active = 1;



            $sit=NULL;



    	    $time_now = date('Y-m-d H:i:s', time());



            $promocode->codestart;



            $promocode->codeend;



            if($time_now<$promocode->codestart){



        		  $active = 0; $sit=1;



        	}elseif(($promocode->codeend!='0000-00-00 00:00:00')&&($time_now>$promocode->codeend)){                      $active = 0; $sit=2;



        	}elseif(isset($promocode->codelimit)&&($promocode->codelimit!=0)&&($promocode->codeused>=$promocode->codelimit)){



        		  $active = 0; $sit=3;



    	    }



        ?>
		
	
	


<tr class="odd camp<?php echo $i;?>">
			<td class=" sorting_1" align="center">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>
			<td class="field-title" style="text-transform: capitalize;text-align:center!important;">
            <a href="<?php echo base_url(); ?>admin/promocodes/edit/<?php echo $promocode->id;?> "class="a_mlms"><?php echo $promocode->title;  ?></a>
            </td>
			
            <td class="field-title " style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $promocode->code;  ?></td>
			<td class="field-title " style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $promocode->codestart;  ?></td>
            <td class="field-title " style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php	if($active==0)



                echo "Inactive";



				else



                echo "Active";;



			   ?></td>
            <td class="field-title " style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $promocode->codeused;  ?></td>
            <td class="field-title " style="text-transform: capitalize;color: #949494;text-align:center!important;"><?php echo $promocode->codelimit - $promocode->codeused  ?></td>
            <td class=" ">
			<?php if($promocode->published){?>



                  <!-- <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/promocodes/unpublish/<?php echo $promocode ->id?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a> -->

                  <a title="Publish Item" href="<?php echo base_url(); ?>admin/promocodes/unpublish/<?php echo $promocode ->id?>"><div class="sprite 9999published center" style="background-position: -340px 0;"></div></a>

                  <?php }else{?>


                  <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/promocodes/publish/<?php echo $promocode ->id?>"><div class="sprite 999publish center" style=" background-position: -308px 0;"></div></a>
                  <!-- <a title="Publish Item" href="<?php echo base_url(); ?>admin/promocodes/publish/<?php echo $promocode ->id?>"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a> -->
                  <?php }?>
                  </td>
			<td class=" ">
				
                 <a class='col-sm-6 no-padding' href="<?php echo base_url(); ?>admin/promocodes/edit/<?php echo $promocode->id?>" >
                 <div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>



                  <a class='col-sm-6' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/promocodes/delete/<?php echo $promocode->id?>'><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
			</td>
		</tr>
         <?php 
		   $iii++;
		 }  ?>    

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
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countpromo; ?> entries</div>
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

















