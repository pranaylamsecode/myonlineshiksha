<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">



<!-- ---------------------------------------------Paragraph-POP-UP-Start----------------------------------------------- -->
<script src="<?php echo base_url(); ?>public/js/form-master/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/progressbar/openrenewal.js"></script>
<style>
a{
  text-decoration: none!important;
}
</style>
<script>
$(document).ready(function(){
	$(".close").click(function(){
		//alert('yes');
		//$('.myModal').css('display','none !important');
		$(".modal").hide();
		 $(".modal-backdrop").hide();
	});
});
</script>
<div class="main-container">
    
      <!-- Modal content-->
     <!--  <div class="" style="border-radius:6px!important;">
        <div class="renew-top-head"> -->
          <!--<h4 class="modal-downgrade-title">Home Page Setting</h4>-->          	
         <!--  <p class="renew-head">Renew</p>
        </div>
    	<div class="">
    	<?php
    	$getExpireDays = $this->settings_model->getExpireDays(1,'mlms_academydetails');
        $currentdate = date('Y-m-d');
        $date1 = new DateTime($currentdate);
        $date2 = new DateTime($getExpireDays->academy_expired);
        $interval = $date2->diff($date1);
    	?>
    	<div class="col-sm-12">
    	<?php
  		 if($currentdate <= $getExpireDays->academy_expired)
   			{
  		?>
    		<div  class="exp_text"> Academy Expiring in: <?php echo $interval->days == 0 ? 'today' :$interval->days." Days"; ?></div>
    	<?php }else{ ?>
    	<div  class="exp_text"> Academy had expired before: <?php echo $interval->days; ?> days ago </div>
    	<?php }?>
    	</div>
        <div class="col-sm-6 renew-txt">
          <span><label >Current Plan: </label> <?php echo $getExpireDays->academy_plan; ?>  Plan</span>
        </div>
        <div class="col-sm-6 renew-txt" style="padding-left: 122px;">
          <span><label >Price: </label> USD <?php echo $getExpireDays->academy_price; ?> </span>
        </div>
        <div class="col-sm-12 clear paymnt-btn">            
          <a href="<?php echo base_url(); ?>admin/client/newpayment" class="btn btn-blue">Make Payment</a>            
        </div>
        </div>
      </div> -->
 
  <!-- ============================================================================== -->


  <div class=" account-content" id="accountoption" role="dialog" style="display:block">
    
        <div class="renew-top-head" style="text-align: center;margin-bottom: 30px;">
          <!--<h4 class="modal-downgrade-title">Home Page Setting</h4>-->           
          <h2 class="">Account Details</h2>
        </div>
     			<div class=" renew-top-des" style="text-align: center;">
          	<?php
      		 if($currentdate <= $getExpireDays->academy_expired)
       			{
      		?>
        		<p> Academy Expiring in: <?php echo $interval->days == 0 ? 'today' :$interval->days." Days"; ?></p>
        	<?php }else{ ?>
        	    <p> Academy had expired before: <?php echo $interval->days; ?> days ago </p>
        	<?php } ?>
        	</div>
            <div class="renew-txt" style="text-align: center;">
              <p><label >Current Plan: </label> <?php echo $getExpireDays->academy_plan; ?>  Plan
              <input type="hidden" value = "<?php echo $getExpireDays->academy_plan_id; ?>" id= "plan_id">
              </p>
            </div>
             <div class="renew-txt" style="text-align: center;">
          <p><label >Price: </label> $<?php echo $getExpireDays->academy_price; ?> USD </p>
        </div>
           
            <div class=" paymnt-btn" style="text-align: center;width:100%;margin-bottom: 20px;">
            	<!-- <button type="button" class="btn btn-green updown" style="font-family: 'AvenirNextLTPro-Demi'!important;font-size: 13px!important;" >Upgrade</button> -->
            	<a href="<?php echo base_url(); ?>admin/client/newpayment" class="btn renew_btn">Renew Now</a>
            </div>
              <!-- <a href="#" class="btn btn-green">Upgrade</a> -->
           
              <!-- <a href="#" class="btn btn-orange" data-target="#downgrade" data-toggle="collapse" style="padding: 8px 22px 8px!important;font-family: 'AvenirNextLTPro-Demi'!important;font-size: 13px!important;">Downgrade</a> -->
               <!-- <button  class="btn btn-orange" data-target="#downgrade" data-toggle="collapse">Downgrade</button> -->
              	<!-- <button type="button" id="btndowngrade" class="btn btn-orange updown" style="padding: 8px 22px 8px!important;font-family: 'AvenirNextLTPro-Demi'!important;font-size: 13px!important;" >Downgrade</button> -->
             		<!-- downgrade toggle -->
             		<!-- <div id="downgrade" class="collapse scrollbar">
		              <table class="table table-hover" style="margin-bottom:0;">
		              <thead class="bg-blue">
			              <tr>
			                <th colspan="3" class="downgrade-title light-blue-border">DOWNGRADE</th>
			                
			              </tr>
			            </thead>
			            <thead class="bg-blue">
			              <tr>
			                <th class="downgrade-title light-blue-border">Basic Plan</th>
			                <th class="downgrade-title light-blue-border">Advanced Plan</th>
			                <th class="downgrade-title light-blue-border">Premium Plan</th>
			              </tr>
			            </thead>
			            <tbody id="downgrade_body"> -->
			              <!-- <tr>
			                <td class="table-first-row light-blue-border">USD 50/ 3 months</td>
			                <td class="table-first-row light-blue-border">USD 350/ year</td>
			                <td class="table-first-row light-blue-border">USD 800 / year</td>
			              </tr>
			             
			              <tr>
			                <td class="light-blue-border">Unlimited Students</td>
			                <td class="light-blue-border">Unlimited Students</td>
			                <td class="light-blue-border">Unlimited Students</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">Unlimited Teachers</td>
			                <td class="light-blue-border">Unlimited Teachers</td>
			                <td class="light-blue-border">Unlimited Teachers</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">Dedicated Payment Gateway</td>
			                <td class="light-blue-border">Dedicated Payment Gateway</td>
			                <td class="light-blue-border">Dedicated Payment Gateway</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">No Commission on Sales</td>
			                <td class="light-blue-border">No Commission on Sales</td>
			                <td class="light-blue-border">No Commission on Sales</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">DIY Customisable Website of your Online Academy with Unlimited Pages</td>
			                <td class="light-blue-border">DIY Customisable Website of your Online Academy with Unlimited Pages</td>
			                <td class="light-blue-border">DIY Customisable Website of your Online Academy with Unlimited Pages</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">Create up to 3 Online Courses</td>
			                <td class="light-blue-border">Create up to 20 Online Courses</td>
			                <td class="light-blue-border">Unlimited Number of Courses can be created and published</td>
			              </tr>
			              
			              <tr>
			                <td class="light-blue-border">Regular Online Examination Facilities</td>
			                <td class="light-blue-border">Regular Online Examination Facilities</td>
			                <td class="light-blue-border">Foolproof Online Examination Facilities</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">Host up to 20 Webinars embedded in the courses</td>
			                <td class="light-blue-border">Host up to 100 Webinars embedded in the courses</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">Facility to Point the Online Academy Website to your own Domain Name (URL)</td>
			              </tr>
			               <tr>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">Customised Help and Support for Online Academy Set up and design</td>
			              </tr>
			               <tr>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="btn">Select</a> </td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="btn">Select</a> </td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="btn">Select</a> </td>
			              
			              </tr> -->
			            <!-- </tbody>
		              </table>
		    		</div>  -->
		    		 <!-- end -->
		    		 <!-- upgrade toggle -->
		    		 <h6 style="text-align: center; color: #95aac9 !important; margin-bottom:15px;">UPGRADE MY ACADEMY</h6>
		    		 <div class="card">
		    		 <div id="downgrade" >
		              <table class="table table-hover" style="margin-bottom:0;">
		              <!-- <thead class="account_table_head">
			              <tr>
			                <th colspan="3" class="downgrade-title light-blue-border">UPGRADE MY ACADEMY</th>
			                
			              </tr>
			            </thead> -->
			            <thead class="account_table_head">
			              <tr>
			                <th class="downgrade-title light-blue-border">Basic</th>
			                <th class="downgrade-title light-blue-border">Professional</th>
			                <th class="downgrade-title light-blue-border">Corporate</th>
			              </tr>
			            </thead>
			            <tbody id="upgrade_body">
			            <tr>
			                <td class="table-first-row light-blue-border"> $108 USD/month
billed annually</td>
			                <td class="table-first-row light-blue-border"> $148 USD/month
billed annually</td>
			                <td class="table-first-row light-blue-border"> $280 USD/month
			              </tr>
			               <tr>
			                <td class="light-blue-border">3 Courses</td>
			                <td class="light-blue-border">Unlimited Courses</td>
			                <td class="light-blue-border">Unlimited Courses</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">Unlimited Students</td>
			                <td class="light-blue-border">Unlimited Students</td>
			                <td class="light-blue-border">Unlimited Students</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">Unlimited Teachers</td>
			                <td class="light-blue-border">Unlimited Teachers</td>
			                <td class="light-blue-border">Unlimited Teachers</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">Dedicated Payment Gateway</td>
			                <td class="light-blue-border">Dedicated Payment Gateway</td>
			                <td class="light-blue-border">Dedicated Payment Gateway</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">No Commission on Sales</td>
			                <td class="light-blue-border">No Commission on Sales</td>
			                <td class="light-blue-border">No Commission on Sales</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">DIY Customisable Website of your Online Academy with Unlimited Pages</td>
			                <td class="light-blue-border">DIY Customisable Website of your Online Academy with Unlimited Pages</td>
			                <td class="light-blue-border">DIY Customisable Website of your Online Academy with Unlimited Pages</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">Create up to 3 Online Courses</td>
			                <td class="light-blue-border">Create up to 20 Online Courses</td>
			                <td class="light-blue-border">Unlimited Number of Courses can be created and published</td>
			              </tr>
			              
			              <tr>
			                <td class="light-blue-border">Regular Online Examination Facilities</td>
			                <td class="light-blue-border">Regular Online Examination Facilities</td>
			                <td class="light-blue-border">Foolproof Online Examination Facilities</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">Host up to 20 Webinars embedded in the courses</td>
			                <td class="light-blue-border">Host up to 100 Webinars embedded in the courses</td>
			              </tr>
			              <tr>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">Facility to Point the Online Academy Website to your own Domain Name (URL)</td>
			              </tr>
			               <tr>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">-</td>
			                <td class="light-blue-border">Customised Help and Support for Online Academy Set up and design</td>
			              </tr>
			               <tr>

			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="btn">Select</a></td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="btn">Select</a></td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="btn">Select</a></td>
			              
			              </tr> 
			            </tbody>
		              </table>
		    		 </div>
		    		 </div>
		    		<!-- end -->
		         
          </div>

  
     	<!-- <div class="renew_page_heading">
     		<h2>Your Account</h2>
     	</div>
     	<div class="account_details_row">
     		<div class="account_details_sec1">
     			<p><span class="account_details_title">Plan:</span> <?php echo $getExpireDays->academy_plan; ?>  Plan
              		<input type="hidden" value = "<?php echo $getExpireDays->academy_plan_id; ?>" id= "plan_id">
       			</p>
       			<p>
       				<span class="account_details_title">Biling Cycle:</span> Monthly <span class="ver_line">|</span> <b>Update</b>
       			</p>
       			<p>
       				<span class="account_details_title">Status:</span> <span class="active_circle"></span><span class="deactive_circle" style="display: none;"></span>Active<span style=" color: red;margin-left: 10px" >( expiring in  <?php echo $interval->days == 0 ? 'today' :$interval->days." days "; ?>)</span>
       			</p>
     		</div>
     		<div class="account_details_sec2">
     			<p><span class="account_details_title">Registration date:</span> Sept 19, 2018
       			</p>
       			<p>
       				<span class="account_details_title">Renews on:</span> Mar 19, 2019
       			</p>
       			<p>
       				<span class="account_details_title">Last Payment:</span> Feb 18, 2019
       			</p>
     		</div>
     		<div class="account_details_sec3">
     				<a href="<?php echo base_url(); ?>admin/client/newpayment" class="btn renew_btn">Renew</a>
     		</div>
     	</div>
     	<div class="plans_section">
     		<div class="plans_section_heading">
     			<h1>
     				Upgrade Your Academy with a Premium Plan 
     			</h1>
     			<h4>
     				14 Day Money Back Guarantee on All CreateOnlineAcademy Subscription Plans
     			</h4>
     		</div>
     		<div class="account_pricing_sec">
     			<ul class="nav nav-tabs">
					<li class="active">
		        		<a  href="#1" data-toggle="tab">Pay annually (save 20%)</a>
					</li>
					<li>
						<a href="#2" data-toggle="tab">Pay monthly</a>
					</li>
				</ul>

				<div class="tab-content ">
					<div class="tab-pane active pay_anually" id="1">
			            <div class="col-sm-4">
			            	<div class="basic">
			            		<div class="basic_image">
			            			<img src="/public/images/New Project(22).png">
			            		</div>
			            	</div>
			            </div>
			            <div class="col-sm-4">
			            	<div class="professional">
			            	</div>
			            </div>
			            <div class="col-sm-4">
			            	<div class="corporate">
			            	</div>
			            </div>
					</div>
					<div class="tab-pane pay_monthly" id="2">
			            <div class="col-sm-4">
			            	<div class="basic">
			            	</div>
			            </div>
			            <div class="col-sm-4">
			            	<div class="professional">
			            	</div>
			            </div>
			            <div class="col-sm-4">
			            	<div class="corporate">
			            	</div>
			            </div>
					</div>
				</div>
			</div>
     	</div> -->
    
  <!--  -->

 
  <!-- Modal -->
  
<script >
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
			url: "<?php echo base_url(); ?>admin/client/getplanfeatures",
			//data: {follow_id:follow_id,student_id:student_id}, 
			success: function(data)
			{
				
				$("#downgrade_body").html('');
			    $("#upgrade_body").html('');
				var objNew = jQuery.parseJSON(data);			
				var countArray = objNew.length;

				// console.log(objNew);

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
			         // else //(parseInt(objNew[i].fid) == 12)
			         // {
			         	var plan_id = $('#plan_id').val();
			         	// console.log(plan_id);
			         	var str ='<tr><td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="btn">Select</a></td>';
			                str+='<td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="btn">Select</a></td>';
			                str+='<td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="btn">Select</a></td>';
			                str+='</tr>';
				     	
				     // }

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
			url: "<?php echo base_url(); ?>admin/client/getplanfeatures",
			//data: {follow_id:follow_id,student_id:student_id}, 
			success: function(data)
			{
				
				$("#downgrade_body").html('');
			    $("#upgrade_body").html('');
				var objNew = jQuery.parseJSON(data);			
				var countArray = objNew.length;

				// console.log(objNew);

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
			         // else //(parseInt(objNew[i].fid) == 12)
			         // {
			         	var plan_id = $('#plan_id').val();
			         	// console.log(plan_id);
			         	var str ='<tr><td class="btn-space light-blue-border">';
			         	if(plan_id<objNew[i].basic_plan){
			         		str+='<a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="btn">Select</a>';
			         	}
			         	
			         	str+='</td>';
			            str+='<td class="btn-space light-blue-border">';
			            if(plan_id<objNew[i].advance_plan){
			            str+='<a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="btn">Select</a>';
			            }
			            str+='</td>';
			            str+='<td class="btn-space light-blue-border">';
			             if(plan_id<objNew[i].premium_plan){
			            str+='<a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="btn">Select</a>';
			        	}
			            str+='</td>';
			            str+='</tr>';
				     	
				     // }

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
  

  <!-- ======================================================================== -->
  


