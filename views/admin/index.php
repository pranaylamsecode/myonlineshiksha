<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

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
    width: 20px;
    height: 20px;	
    border-width: 1px;
    border-style: solid;
    border-color: rgba(0,0,0,.2);
    margin: 3px 0px;
}
.foo span{
	margin-left: 30px;
}
.chartStats {
    display: flex;
    align-items: flex-start;
    flex-direction: column;
    justify-content: center;
}
/*//popup*/


.popup {
  display: none;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 10;
}
.popup-overlay {
   background: rgba(23, 23, 23, 0.85) none repeat scroll 0% 0%;
opacity: 1;
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.popup-content {
    position: absolute;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    background: #000;
    width: 85%;
    top: 0px;
    padding: 0px 100px;
    margin-top: 90px;
    margin-bottom: 60px;
    height: 70vh;
}

.close-popup {
    display: inline-block;
    position: absolute;
    top: 0px;
    right: 0px;
    font-size: 30px;
    color: #fff;
    background: #000;
    height: 42px;
    width: 50px;
    margin-top: -5px;
    padding-bottom: 0px;
    padding-left: 16px;
}
.over_hidden{
  overflow: hidden;
}
.popup-content video {
    width: 100%;
    height: 100%;
}

</style>
<div class="home-page main-container">
<div class="row">
	<div class="col-sm-12">
		<div class="dashboard-head card">
			<div class="cardBody">
			<!-- <h1><?php //echo date("F d,o"); ?></h1> -->
			<div class="dashboard_icon"><img src="<?php echo base_url(); ?>public/images/home.png" alt="" /></div>
			<div class="cardCol">
				<h6 class="icon-play2 play_button open-popup" data-id="popup_2" data-animation="scale">Start the tour<img src="<?php echo base_url(); ?>public/images/play.png" alt="" /></h6>
				<h3>Welcome back, <?php echo ucfirst($this->session->userdata['loggedin']['first_name']);?></h3>
			</div>
		</div>
			
		</div>
	</div>
</div>
<div id="popup_2" class="popup">          
    <div class="popup-overlay"></div>
    <a href="#" class="close-popup" data-id="popup_2" data-animation="scale">&times;</a>
    <div class="popup-content">
      	<video id="popupvideo" controls controlsList="nodownload" width="100%" height="100%" disablepictureinpicture>
          	<source src="https://www.createonlineacademy.com/public/uploads/videos/coademo.mp4" type="video/mp4">
      	</video>
    </div>
</div>
<?php
 if($u_data['groupid'] == 4){ ?>
<div class="row">
	<div class="col-sm-4 ">
		<div class="step1 card">
			
				<a href="<?php echo base_url('admin/course-manager');?>">
					<div class="cardBody">
						<div class="cardText">
							<h6 class="step">Step 1</h6>
							<h3 class="step_detail">Create your first course</h3>
						</div>
						<div class="cardIcon">
							<i class="fas fa-check-circle" style="<?php echo $total_courses > 0 ? 'color: #00bf6f' : '' ; ?>"></i>
						</div>
					</div>

				</a>
			</div>
		</div>
  	
  	<div class="col-sm-4 ">
  		<div class="step2 card">
  			
	  			<a href="<?php echo base_url('admin/home-page/design-options/45') ?>">
	  				<div class="cardBody">
			  			<div class="cardText">
				  			<h6 class="step">Step 2</h6>
							<h3 class="step_detail">Design your online academy</h3>
						</div>
						<div class="cardIcon">
			  				<i class="fas fa-check-circle" style="color: #00bf6f"></i>
			  			</div>
			  		</div>
	  			</a>

		</div>
  	</div>
  	<div class="col-sm-4 ">
  		<div class="step3 card">
  			<a href="<?php echo base_url('admin/course-manager'); ?>">
  				<div class="cardBody">
		  			<div class="cardText">
			  			<h6 class="step">Step 3</h6>
						<h3 class="step_detail">Publish your course and start selling</h3>
					</div>
					<div class="cardIcon">
		  				<i class="fas fa-check-circle" style="<?php echo (isset($payment_status) && $payment_status == '1') > 0 ? 'color: #00bf6f' : '' ?>"></i>
		  			</div>
		  		</div>
  			</a>
		</div>
  	</div>
</div>

<div class="row dash-stats">

	<div class="col-sm-12 no-padding">
<?php $CI = &get_instance();
 $CI->load->model('settings_model');
$currency = $CI->settings_model->getItems(); 
$currencysign = $CI->settings_model->getCurrenciesign($currency[0]['currency']);
if($currencysign)
{
	$currency_symbol = $currencysign->sign;
	if($currencysign->sign == '<i class="fa fa-inr"></i>')
	{
		$currency_symbol = "₹";
	}
}
else
{

$currency_symbol = " ";	

}
 ?>
		<div class="col-sm-3">
			<a href="<?php echo base_url();?>admin/orders/">
			<div class="card tile-stats  ">
				<div class="cardBody">
					<div class="cardCol">
						<h6>Revenue</h6>
						<?php $order_revenue = $totalSale ? $totalSale : '0'; ?>
						<h3 class="num" data-start="0" data-end="$<?php echo $order_revenue; ?>.00" data-postfix="" data-duration="1500" data-delay="600"><?php echo $currency_symbol.' '. number_format(round($order_revenue)); ?></h3>
						<p>In last 30 days.</p>
					</div>
				</div>
			</div>
			</a>		
		</div>

		 <div class="col-sm-3">	
			<a href="<?php echo base_url();?>admin/users/"><div class="card ">
				<div class="cardBody">
					<div class="cardCol">
						<h6>New Signups</h6>
						<h3 class="num" data-start="0" data-end="<?php echo $num_of_new_signup; ?>" data-postfix="" data-duration="500" data-delay="0">0</h3>
						
						<p>in last 30 days.</p>
					</div>
				</div>
			</div>
			</a>		
		</div>

		<div class="col-sm-3">	
			<a href="<?php echo base_url();?>admin/users/"><div class="card ">
				<div class="cardBody">
					<div class="cardCol">
						<h6>Total Users</h6>
						<h3 class="num" data-start="0" data-end="<?php echo $num_of_users; ?>" data-postfix="" data-duration="500" data-delay="0">0</h3>
						<p>So far in your academy.</p>
					</div>
				</div>
			</div>
			</a>		
		</div>

		<div class="col-sm-3">
			<a href="<?php echo base_url('admin/course-manager'); ?>">
			<div class="card tile-stats ">
				<div class="cardBody">
					<div class="cardCol">
						<h6>Active Courses</h6>
						<h3 class="num" data-start="0" data-end="<?php echo $total_courses;?>" data-postfix="" data-duration="500" data-delay="600">0
						</h3>
						<p>Active Courses.</p>
					</div>
				</div>
			</div>
			</a>	
		</div>
		

	</div>
</div>

<div class="row">

	<div class="col-sm-6 overview_sec">
			
				<div class="panel panel-default card">
					<div class="card-header panel-heading panel-head-bg">
						<h4 class="panel-title dark_label card-header-title">Overview <?php echo ' : (Currency: '.$get_currency[0]['currency'].')';?></h4>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class=" panel-body with-table"><table class="table table-bordered table-responsive table-para">
						<tbody>
							<tr>
								<td>Total Sales :</td>
								<td><?php echo $currency_symbol.' '. number_format(round($overall_Sale)); ?></td>
								
							</tr>
							<tr>
								<td>Total Sales tdis Year :</td>
								<td><?php echo $currency_symbol.' '.number_format(round($totalSales_in_year['0']['amount'])); ?></td>
								
							</tr>
							<tr>
								<td># Orders tdis year :</td>
								<td><?php echo $getTotalOrders; ?></td>
							</tr>
							
							<tr>
								<td>Numbers of Students :</td>
								<td><?php echo $getTotalStudents; ?></td>
							</tr>
							<tr>
								<td>Numbers of Courses :</td>
								<td><?php echo $getTotalCourses; ?></td>
							</tr>
						</tbody>
						
						
					</table></div>
				</div>				
	</div> 

	<div class="col-sm-6 user_stats_sec">
	<div class="col-sm-12 no-padding">
			<div class="panel panel-default user_stats_panel card">
					<div class="card-header panel-heading panel-head-bg">
						<h4 class="panel-title dark_label card-header-title">Users Stats</h4>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class="table-para cardBody" style="display: flex;">
						<div class="chartStats" style="width:45%; float: left">
							<div class="foo" style="background-color:#008D4C; "><span style="margin-top: 5px;">Admin</span></div>
							<div class="foo" style="background-color:#3366cc; "><span style="margin-top: 5px;">Assistant</span></div>
							<div class="foo" style="background-color:#F6BB42; "><span style="margin-top: 5px;">Trainer</span></div>
							<div class="foo" style="background-color:#DC4B36; "><span style="margin-top: 5px;">Learner</span></div>
						</div>
						<div class="chartBody" style="width: 26%;float: right;text-align: center;">
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

<div class="row">

 			<div class="col-sm-6 recent_signup_sec">
			
				<div class="panel panel-default card">
					<div class="card-header panel-heading panel-head-bg">
						<h4 class="panel-title dark_label card-header-title">Recent Student Signups</h4>
						<div class="view_all_btn">
								<a href="<?php echo base_url('admin/users') ?>">View all</a>
						</div>
						
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class=" panel-body with-table new-certificate-table scroll"><table class="table table-bordered table-responsive table-para">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Date</th>
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
            <div class="col-sm-6 recent_order_sec">
			
				<div class="panel panel-default card">
					<div class="card-header panel-heading panel-head-bg">
						<h4 class="panel-title dark_label card-header-title">Recent Orders</h4>
						<div class="view_all_btn">
								<a href="<?php echo base_url('admin/orders') ?>">View all</a>
						</div>
						<!-- <div class="panel-options">
							<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
							<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
						</div> -->
					</div>
					<div class=" panel-body with-table new-certificate-table scroll">
						<table class="table table-bordered table-responsive table-para">
						<thead>
							<tr>
								<th>#</th>
								<th>Course</th>
                                <th>Date</th>
								<th>Amount</th>
								
							</tr>
						</thead>
						
						<tbody>
                            <?php
							$sr_no = 1;
							foreach($getRecentOrders as $cert_report)
							{								
							?>                        
							<tr>
								<td><?php echo $sr_no;  ?></td>
								<td><?php echo ucfirst($cert_report->name); ?></td>
								<td><?php echo $cert_report->order_date; ?></td>
                                <td><?php echo$cert_report->amount; ?></td>								
                            </tr>
                            <?php
							$sr_no = $sr_no + 1;
							}
							?>
						</tbody>
						</table>
					</div>
				</div>
				
			</div>				            
 </div>
 <?php if(!empty($certificate)){ ?>
<div class="row certificate_sec">
	<div class="col-sm-12">
				
					<div class="panel panel-default card">
						<div class="card-header panel-heading panel-head-bg">
							<h4 class="panel-title dark_label card-header-title">New Certificates</h4>
							<div class="view_all_btn">
								<a href="<?php echo base_url('admin/course-report') ?>">View all</a>
							</div>
							<!-- <div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div> -->
						</div>
						<div class="y panel-body with-table new-certificate-table scroll">
							<table class="table table-bordered table-responsive table-para">
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
							</table>
						</div>
					</div>
					
	</div>
</div>
<?php } ?>
<div class="row selling_course_sec">
	<div style="" class="col-sm-12">
				
					<div class="panel panel-default card">
						<div class="card-header panel-heading panel-head-bg">
							<h4 class="panel-title dark_label card-header-title">Best Selling Courses By Orders</h4>
							<div class="view_all_btn">
									<a href="<?php echo base_url('admin/sales/report') ?>">View all</a>
							</div>
							<!-- <div class="panel-options">
								<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
								<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
								<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
								<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
							</div> -->
						</div>
						<div class=" panel-body with-table best_selling-table scroll"><table class="table table-bordered table-responsive table-para">
							<thead>
								<tr>
									<th>#</th>
									<th>Course Name</th>
	                                <th>Category</th>
	                                <th>No. Of Sales</th>
									<th>Total Sales</th>								
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
</div>

<div class="">
<div class="modal" id="renewalpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius:6px!important;">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">×</button>
          <!--<h4 class="modal-downgrade-title">Home Page Setting</h4>-->          	
          <p class="renew-head">Renew</p>
        </div>
        	<div class="modal-body">
        	        	<div class="col-sm-12">
        	        		<div style="padding-bottom: 3%;color:#555;font-family:'AvenirNextLTPro-Demi';" class="exp_text"> Academy Expiring in: 260 Days</div>
        	        	</div>
            <div class="col-sm-6 renew-txt">
              <span><label style="color:#555;font-family:'AvenirNextLTPro-Demi';">Current Plan: </label> Corporate  Plan</span>
            </div>
            <div class="col-sm-6 renew-txt" style="padding-left: 122px;">
              <span><label style="color:#555;font-family:'AvenirNextLTPro-Demi';">Price: </label> USD 3360 </span>
            </div>
            <div class="col-sm-12 clear paymnt-btn">            
              <a href="<?php echo base_url() ?>admin/client/newpayment" class="btn btn-blue">Make Payment</a>            
            </div>
        </div>
      </div>
      
    </div>
    
  </div>

  <!-- ============================================================================== -->


<?php } ?>
  <!--  -->

 
  <!-- Modal -->
  
<script>
	$(document).ready(function(){

	 $("#btnUpgrade").click(function()
	 {
	 	

		if($("#upgrade").is(":visible")==true)
		{
		    $("#upgrade").css('display','none');
		    $("#downgrade").css('display','none');
		}
		else
		{
			$("#upgrade").css('display','block');			
		    $("#downgrade").css('display','none');
		}
	});

	 $("#btndowngrade").click(function()
	 {
	 	

		if($("#downgrade").is(":visible")==true)
		{
		  $("#upgrade").css('display','none');
		  $("#downgrade").css('display','none');
		}
		else
		{
			$("#upgrade").css('display','none');
		    $("#downgrade").css('display','block');
		}
	});



	 });

	$(".updown").click(function()
	 {
	 	
	 	$.ajax({
			type: "GET",
			url: "<?php echo base_url() ?>admin/client/getplanfeatures",
			//data: {follow_id:follow_id,student_id:student_id}, 
			success: function(data)
			{
				
				$("#downgrade_body").html('');
			    $("#upgrade_body").html('');
				var objNew = jQuery.parseJSON(data);			
				var countArray = objNew.length;

				console.log(objNew);

				for(var i=0; i < countArray; i++)
				{
					console.log(objNew[i].basic_plan);

					 if(parseInt(objNew[i].fid) == 1)
					 {
				    	var str ='<tr><td class="table-first-row light-blue-border">'+objNew[i].basic_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].advance_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].premium_plan+'</td>';
				    	str+='</tr>';
				     }
				     else if(parseInt(objNew[i].fid) < 12)
				     {
				     	
				     	var str ='<tr><td class="light-blue-border">'+objNew[i].basic_plan+'</td>';
				        str+='<td class="light-blue-border">'+objNew[i].advance_plan+'</td>';
				        str+='<td class="light-blue-border">'+objNew[i].premium_plan+'</td>';
				    	str+='</tr>';


			         }
			         else //(parseInt(objNew[i].fid) == 12)
			         {
			         	var plan_id = $('#plan_id').val();
			         	console.log(plan_id);
			         	var str ='<tr><td class="btn-space light-blue-border"><a href="<?php echo base_url() ?>admin/client/renewpayment/1" class="bg-blue-btn">SELECT</a></td>';
			                str+='<td class="btn-space light-blue-border"><a href="<?php echo base_url() ?>admin/client/renewpayment/2" class="bg-blue-btn">SELECT</a></td>';
			                str+='<td class="btn-space light-blue-border"><a href="<?php echo base_url() ?>admin/client/renewpayment/3" class="bg-blue-btn">SELECT</a></td>';
			                str+='</tr>';
				     	
				     }

				    	$("#downgrade_body").append(str); 
			   			$("#upgrade_body").append(str); 
				}			

			   

			   //$("#downgrade_body").append(''); 
			   //$("#upgrade_body").append(''); 	
				
			}
		  });
	 });

 $(document).ready(function() 
 {
       	$.ajax({
			type: "GET",
			url: "<?php echo base_url() ?>admin/client/getplanfeatures",
			//data: {follow_id:follow_id,student_id:student_id}, 
			success: function(data)
			{
				
				$("#downgrade_body").html('');
			    $("#upgrade_body").html('');
				var objNew = jQuery.parseJSON(data);			
				var countArray = objNew.length;

				console.log(objNew);

				for(var i=0; i < countArray; i++)
				{
					console.log(objNew[i].basic_plan);

					 if(parseInt(objNew[i].fid) == 1)
					 {
				    	var str ='<tr><td class="table-first-row light-blue-border">'+objNew[i].basic_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].advance_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].premium_plan+'</td>';
				    	str+='</tr>';
				     }
				     else if(parseInt(objNew[i].fid) < 12)
				     {
				     	
				     	var str ='<tr><td class="light-blue-border">'+objNew[i].basic_plan+'</td>';
				        str+='<td class="light-blue-border">'+objNew[i].advance_plan+'</td>';
				        str+='<td class="light-blue-border">'+objNew[i].premium_plan+'</td>';
				    	str+='</tr>';


			         }
			         else //(parseInt(objNew[i].fid) == 12)
			         {
			         	var plan_id = $('#plan_id').val();
			         	console.log(plan_id);
			         	var str ='<tr><td class="btn-space light-blue-border">';
			         	if(plan_id<objNew[i].basic_plan){
			         		str+='<a href="<?php echo base_url() ?>admin/client/renewpayment/1" class="bg-blue-btn">SELECT</a>';
			         	}
			         	
			         	str+='</td>';
			            str+='<td class="btn-space light-blue-border">';
			            if(plan_id<objNew[i].advance_plan){
			            str+='<a href="<?php echo base_url() ?>admin/client/renewpayment/2" class="bg-blue-btn">SELECT</a>';
			            }
			            str+='</td>';
			            str+='<td class="btn-space light-blue-border">';
			             if(plan_id<objNew[i].premium_plan){
			            str+='<a href="<?php echo base_url() ?>admin/client/renewpayment/3" class="bg-blue-btn">SELECT</a>';
			        	}
			            str+='</td>';
			            str+='</tr>';
				     	
				     }

				    	$("#downgrade_body").append(str); 
			   			$("#upgrade_body").append(str); 
				}			

			   

			   //$("#downgrade_body").append(''); 
			   //$("#upgrade_body").append(''); 	
				
			}
		  });

  });
</script>
        
      

  </div>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/progressbar/openrenewal.js"></script>

<script>
	var $ =jQuery.noConflict();
(function($) {
  $.fn.openPopup = function( settings ) {
    var elem = $(this);
    // Establish our default settings
    var settings = $.extend({
      anim: 'fade'
    }, settings);
    elem.show();
    elem.find('.popup-content').addClass(settings.anim+'In');
  }
  
  $.fn.closePopup = function( settings ) {
    var elem = $(this);
    // Establish our default settings
    var settings = $.extend({
      anim: 'fade'
    }, settings);
    elem.find('.popup-content').removeClass(settings.anim+'In').addClass(settings.anim+'Out');
    
    setTimeout(function(){
        elem.hide();
        elem.find('.popup-content').removeClass(settings.anim+'Out')
      }, 500);
  }
    
}(jQuery));

	jQuery('.open-popup').click(function(){
  $(document).find('.popup-content iframe').attr('src', 'https://www.createonlineacademy.com/public/uploads/videos/coademo.mp4' );
  $('#'+$(this).data('id')).openPopup({
    anim: (!$(this).attr('data-animation') || $(this).data('animation') == null) ? 'fade' : $(this).data('animation')
  });
  $("html").addClass("over_hidden");
  $("body").addClass("over_hidden");
   $('.popup-content video').attr('autoplay', '' );
    $('#popupvideo').get(0).play();
   $('#popupvideo').play();
 $('.popup-content iframe video').attr('autoplay', 0 );
});
jQuery('.close-popup').click(function(){
  $('#'+$(this).data('id')).closePopup({
    anim: (!$(this).attr('data-animation') || $(this).data('animation') == null) ? 'fade' : $(this).data('animation')
  });
  $('#popupvideo').get(0).pause();
  $("html").removeClass("over_hidden");
  $("body").removeClass("over_hidden");
  
   // $('.popup-content iframe').attr('src', '' );
     // $('#popupvideo').pause();

});
</script>

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
                            content: ' Your subscription is expired. Please Click on "OKAY" button to proceed.',
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


 

