<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery1.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/js/visualize.jQuery.js"></script>

<link href="<?php echo base_url(); ?>public/css/basic1.css" rel="stylesheet" media="screen">

<link href="<?php echo base_url(); ?>public/css/visualize.css" rel="stylesheet" media="screen">

<!--<link href="<?php echo base_url(); ?>public/css/visualize-dark.css" rel="stylesheet" media="screen">-->

<div id="toolbar-box">

	<div class="m">

		<div id="toolbar" class="toolbar-list">

			<div class="clr"></div>

		</div>

		<div class="pagetitle icon-48-generic"><h2>Courses Report</h2></div>

	</div>

</div>

<!--code commented by sachin -->

<!--<div>
<table class="table table-bordered">
<caption style="font-weight: bold;">Course Report</caption>
			<thead>
				<tr>

			<td></td>



            <?php



                foreach($courses as $eachcourse){

            ?>

			<th scope="col" style="font-weight: bold;"><?php echo $eachcourse->name; ?></th>

			<?php

                    }

            ?>

		</tr>
			</thead>
			
			<tbody>
				<tr>
					<td style="font-weight: bold;">Enrolled User</td>
					 <?php

                 $this->load->model('admin/Userreport_model');

                foreach($courses as $eachcourse){

                $estud=$this->Userreport_model->getEnrolledUser($eachcourse->id);

            ?>

			<td><?php echo count($estud); ?></td>

            <?php

                    }

            ?>
				</tr>
				
				
			</tbody>
		</table>

</div>-->



<div id="mychart"></div>



<script>

   $('#t1').visualize();

</script>


<div>
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
			<thead>
				<tr>
					<th style="font-weight: bold;">Sr.No.</th>
					<th style="font-weight: bold;">Course</th>
					<th style="font-weight: bold;">Enrolled Student</th>
				</tr>
			</thead>
			
			<?php $j =0; ?>
			<tbody role="alert" aria-live="polite" aria-relevant="all">
            <?php

                $this->load->model('admin/Userreport_model');

                $i=1;

                foreach($courses as $eachcourse){

                $estud=$this->Userreport_model->getEnrolledUser($eachcourse->id);

            ?>
				<tr class="odd camp<?php echo $j;?>">
					<td><?php echo $i;?></td><td scope="col"><?php echo $eachcourse->name; ?></td><td scope="col"><?php echo count($estud); ?></td>
					<?php

            $i++;

            }

            ?>
				</tr>
				
				
			</tbody>
		</table>
		
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