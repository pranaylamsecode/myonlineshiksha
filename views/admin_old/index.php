<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php   
       $learner = 0;
	   $trainer = 0;
	   $assistant = 0;
	   $admin = 0;
       
		foreach($all_user_data as $g_id)
		{
		   if($g_id->group_id == 1)
		   {
		      $learner = $learner + 1;
		   }
		   if($g_id->group_id == 2)
		   {
		      $trainer = $trainer + 1;
		   }
		   if($g_id->group_id == 3)
		   {
		      $assistant = $assistant + 1;
		   }
		   if($g_id->group_id == 4)
		   {
		      $admin = $admin + 1;
		   }
		}		


   ?>
<script type="text/javascript">
jQuery(document).ready(function($) 
{
	$('.pie').sparkline('html', {
		type: 'pie',
		borderWidth: 0, 
		sliceColors: ['black', 'white','black']
	});
   


	$(".chart").sparkline([<?=$assistant?>,<?=$learner?>,<?=$trainer?>,<?=$admin?>], {
		type: 'pie',
		barColor: 'purple',
		height: '110px',
		barWidth: 10,
		barSpacing: 2});	
});
</script>
<?php

  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
?>
<style type="text/css">
.foo {   
    margin-left:10%!important;
    width: 20px;
    height: 20px;
    margin: 5px;
    border-width: 1px;
    border-style: solid;
    border-color: rgba(0,0,0,.2);
}
</style>

<div class="row">
	<div class="col-sm-12">
		<div class="well dashboard-head">
			<h1><?php echo date("F d,o"); ?></h1>
			<h3>Welcome to the site <strong><?php echo ucfirst($this->session->userdata['loggedin']['first_name']);?></strong></h3>
		</div>
	</div>
</div>


<div class="row">

<div class="col-sm-12 no-padding">
	 
<div class="col-sm-6 no-padding">
	<div class="col-sm-6">	
		<a href="<?php echo base_url();?>admin/users/"><div class="tile-stats tile-red dashboard-head dashboard-font-style-white">
			<div class="icon"><i class="entypo-users"></i></div>
			<div style="font-family: 'AvenirNextLTPro-Regular';" class="num" data-start="0" data-end="<?php echo $num_of_users; ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
			
			<h3>Total Users</h3>
			<p>So far in your academy.</p>
		</div></a>		
	</div>
	
	<div class="col-sm-6">	
		<div class="tile-stats tile-green dashboard-head dashboard-font-style-white">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div style="font-family: 'AvenirNextLTPro-Regular';" class="num" data-start="0" data-end="<?php echo $total_courses;?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
			
			<h3>Active Courses</h3>
			<p>Active Courses.</p>
		</div>		
	</div>

</div>	
<div class="col-sm-6">
	<div class="col-sm-12 no-padding">
			<div class="panel panel-default">
					<div class="panel-heading panel-head-bg">
						<div class="panel-title dark_label">Users Stats</div>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class="table-para" style="display: flex;">
						<div style="width:45%; float: left;margin-top: 3%;">
							<div class="foo" style="background-color:#008D4C; "><span style="margin-top: 5px;  margin-left: 50px;">Admin</span></div>
							<div class="foo" style="background-color:#3366cc; "><span style="margin-top: 5px;  margin-left: 50px;">Assistant</span></div>
							<div class="foo" style="background-color:#F6BB42; "><span style="margin-top: 5px;  margin-left: 50px;">Trainer</span></div>
							<div class="foo" style="background-color:#DC4B36; "><span style="margin-top: 5px;  margin-left: 50px;">Learner</span></div>
						</div>
						<div class="panel-body" style="width: 26%;float: right;text-align: center;">
							<center><span class="chart"><canvas width="110" height="110" style="display: inline-block; vertical-align: top; width: 110px; height: 110px;"></canvas></span></center>
						</div>	
				   </div>
				</div>
			</div>
  </div>
    <!-- This is for General Stats -->
     
	
	<!--<div class="col-sm-3">	
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-mail"></i></div>
			<div class="num" data-start="0" data-end="23" data-postfix="" data-duration="1500" data-delay="1200">0</div>
			
			<h3>New Messages</h3>
			<p>messages per day.</p>
		</div>		
	</div>
	
	<div class="col-sm-3">	
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-rss"></i></div>
			<div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">0</div>
			
			<h3>Subscribers</h3>
			<p>on our site right now.</p>
		</div>		
	</div> -->
</div>

</div>

<div class="row" style="margin:0px;">

	<div class="col-sm-12 no-padding">
			
				<div class="panel panel-default">
					<div class="panel-heading panel-head-bg">
						<div class="panel-title dark_label">Overview <?php echo ' : (Currency: '.$get_currency[0]['currency'].')';?></div>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class="panel-body with-table"><table class="table table-bordered table-responsive table-para">
						<tbody>
							<tr>
								<th>1</th>
								<th>Total Sales :</th>
								<th><?php echo number_format($totalSale['0']['amount'],2); ?></th>
								
							</tr>
							<tr>
								<th>2</th>
								<th>Total Sales this Year :</th>
								<th><?php echo number_format($totalSales_in_year['0']['amount'],2); ?></th>
								
							</tr>
							<tr>
								<th>3</th>
								<th>Total Orders :</th>
								<th><?php echo $getTotalOrders; ?></th>
							</tr>
							
							<tr>
								<th>4</th>
								<th>Numbers of Students :</th>
								<th><?php echo $getTotalStudents; ?></th>
							</tr>
							<tr>
								<th>5</th>
								<th>Numbers of Courses :</th>
								<th><?php echo $getTotalCourses; ?></th>
							</tr>
						</tbody>
						
						
					</table></div>
				</div>				
			</div> 


</div>

<div class="row">

 <div class="col-sm-6">
			
				<div class="panel panel-default">
					<div class="panel-heading panel-head-bg">
						<div class="panel-title dark_label">Recent Users</div>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class="panel-body with-table new-certificate-table scroll"><table class="table table-bordered table-responsive table-para">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Created At</th>
							</tr>
						</thead>
						
						<tbody>
                        <?php							 
						    $i = 1;
						    foreach($groups as $users)
							{							
						 	?>
							<tr>
								<td><?php echo $i; //$users->id; ?></td>
								<td><a href="<?php echo base_url();?>admin/users/edit/<?php echo $users->id; ?>"><?php echo ucfirst($users->first_name).' '.ucfirst($users->last_name);?></a></td>
								<td><?php echo $users->email?></td>
                                <td><?php echo $users->created_at.' GMT'?></td>								
                            </tr>
                            <?php 
                            $i++;
                            } ?>   		
						</tbody>
					</table></div>
				</div>
				
			</div>
            
             <div class="col-sm-6">
			
				<div class="panel panel-default">
					<div class="panel-heading panel-head-bg">
						<div class="panel-title dark_label">New Certificates</div>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class="panel-body with-table new-certificate-table scroll"><table class="table table-bordered table-responsive table-para">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
                                <th>View Certificate</th>
								<th>Issued On</th>
								
							</tr>
						</thead>
						
						<tbody>
                            <?php
							$sr_no = 1;
							foreach($certificate as $cert_report)
							{								
							?>                        
							<tr>
								<td><?php echo $sr_no;  ?></td>
								<td><?php echo ucfirst($cert_report->first_name).' '.ucfirst($cert_report->last_name); ?></td>
								<td><a href="<?php echo base_url();?>admin/studreport/viewquizcomplusers/<?php echo $cert_report->prog_id; ?>"><?php  echo $cert_report->name; ?></a></td>
                                <td><?php  $org_date = $cert_report->issued_on;
								            echo $new_date = date("d-m-Y", strtotime($org_date)); ?></td>								
                            </tr>
                            <?php
							$sr_no = $sr_no + 1;
							}
							?>
						</tbody>
					</table></div>
				</div>
				
			</div>
			
			            
 </div>
<div class="row">
<div style="width: 100%;" class="col-sm-6">
			
				<div class="panel panel-default">
					<div class="panel-heading panel-head-bg">
						<div class="panel-title dark_label">Best Selling Courses By Orders</div>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class="panel-body with-table best_selling-table scroll"><table class="table table-bordered table-responsive table-para">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
                                <th>Category Name</th>
                                <th>Rate</th>
								<th>Created By</th>								
							</tr>
						</thead>
						
						<tbody>
                            <?php  
							    foreach($selling_courses as $sell_course)
								{	

									//getTotalBuyCourses($sell_course->catid);					
							?>
                        
							<tr>
								<td><?php echo $sell_course->catid; ?></td>
								<td><a href="<?php echo base_url();?>admin/programs/edit/<?php echo $sell_course->id; ?>"><?php  echo $sell_course->name; ?></a></td>
                                <td><?php  echo $sell_course->catname; ?></td>
                                <td><?php  echo $sell_course->fixedrate; ?></td>
								 <td><?php  echo $sell_course->first_name.' '.$sell_course->last_name; ?></td>
                             </tr>
                             <?php
							      
								}
							 ?>
		
						</tbody>
					</table></div>
				</div>
				
			</div>
</div>


<?php
	$expiring['days']="";
	if($expiring['days'])
	{
		if($expiring['days'] > 0)
		{
?>
	

    <script>
var $j =jQuery.noConflict();
jQuery(document).ready(function() {
 showControls(<?php echo $expiring['days'] ?>);
})


function showControls(days) 
       {
                   
                       $j.confirm({
                       	   
                       	    confirmButtonClass: 'btn btn-info',
                       	    confirmButton: 'Renew or Upgrade',
                            cancelButtonClass: 'btn btn-danger',
                            title: 'Attention!',
                            content: days+' days remaining to expire your academy.Please Renew or Upgrade.',
                            confirm: function(){ 
                                            window.location.href = "https://www.createonlineacademy.com";
       
                                                           },
                            cancel: function(){
										   
										    }
                           
                                         });
                       //}
               }

</script>
	
<?php
      }
      else
      {
 ?>
 <script type="text/javascript">

	jQuery(document).ready(function()
    {
       //deleteconfirm(<?php echo $expiring['days'] ?>);
    });

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
function deleteconfirm(days) 
       {
                   
                       $j.alert({
                       	    theme: 'supervan',
                       	    confirmButtonClass: 'btn btn-info',
                            cancelButtonClass: 'btn btn-danger',
                            title: 'Subscription is Expired',
                            content: ' Your subscription is expired. Please Click on "OKEY" button to proceed.',
                            confirm: function(){ 
                                            window.location.href = "https://www.createonlineacademy.com";
       
                                                           },
                           
                                         });
                       //}
               }
    </script>

 <?php

      }
	}
?>



 

