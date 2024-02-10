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
<div class="">
<div class="modal" id="renewalpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius:6px!important;">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <!--<h4 class="modal-downgrade-title">Home Page Setting</h4>-->          	
          <p class="renew-head">Renew</p>
        </div>
        	<div class="modal-body">
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
        		<div style="padding-bottom: 3%;color:#555;font-family:'AvenirNextLTPro-Demi';" class="exp_text"> Academy Expiring in: <?php echo $interval->days == 0 ? 'today' :$interval->days." Days"; ?></div>
        	<?php }else{ ?>
        	<div style="padding-bottom: 3%;color:#555;font-family:'AvenirNextLTPro-Demi';" class="exp_text"> Academy had expired before: <?php echo $interval->days; ?> days ago </div>
        	<?php }?>
        	</div>
            <div class="col-sm-6 renew-txt">
              <span><label style="color:#555;font-family:'AvenirNextLTPro-Demi';">Current Plan: </label> <?php echo $getExpireDays->academy_plan; ?>  Plan</span>
            </div>
            <div class="col-sm-6 renew-txt" style="padding-left: 122px;">
              <span><label style="color:#555;font-family:'AvenirNextLTPro-Demi';">Price: </label> USD <?php echo $getExpireDays->academy_price; ?> </span>
            </div>
            <div class="col-sm-12 clear paymnt-btn">            
              <a href="<?php echo base_url(); ?>admin/client/newpayment" class="btn btn-blue">Make Payment</a>            
            </div>
        </div>
      </div>
      
    </div>
    
  </div>

  <!-- ============================================================================== -->


  <div class="modal account-content" id="accountoption" role="dialog" style="display:none">
    <div class="modal-dialog">
    
    
      <div class="modal-content" style="border-radius:6px!important;">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <!--<h4 class="modal-downgrade-title">Home Page Setting</h4>-->           
          <p class="renew-head">Account Details</p>
        </div>
          <div class="modal-body">
          <div class="col-sm-12">
          	<div class="col-sm-12">
          	<?php
      		 if($currentdate <= $getExpireDays->academy_expired)
       			{
      		?>
        		<div style="padding-bottom: 3%;color:#555;font-family:'AvenirNextLTPro-Demi';" class="exp_text"> Academy Expiring in: <?php echo $interval->days == 0 ? 'today' :$interval->days." Days"; ?></div>
        	<?php }else{ ?>
        	   <div style="padding-bottom: 3%;color:#555;font-family:'AvenirNextLTPro-Demi';" class="exp_text"> Academy had expired before: <?php echo $interval->days; ?> days ago </div>
        	<?php } ?>
        	</div>
            <div class="col-sm-12 renew-txt">
              <span><label style="color:#555;font-family:'AvenirNextLTPro-Demi';">Current Plan: </label> <?php echo $getExpireDays->academy_plan; ?>  Plan
              <input type="hidden" value = "<?php echo $getExpireDays->academy_plan_id; ?>" id= "plan_id">
              </span>
               <span style="float: right"><label style="color:#555;font-family:'AvenirNextLTPro-Demi';">Price: </label> USD <?php echo $getExpireDays->academy_price; ?>  
            </div>
            </div>
            <div class="col-sm-12 paymnt-btn">
            	<!-- <button type="button" class="btn btn-green updown" style="font-family: 'AvenirNextLTPro-Demi'!important;font-size: 13px!important;" >Upgrade</button> -->
            	<a href="<?php echo base_url(); ?>admin/client/newpayment" class="btn btn-blue">Renew Now</a>
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
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="bg-blue-btn">SELECT</a> </td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="bg-blue-btn">SELECT</a> </td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="bg-blue-btn">SELECT</a> </td>
			              
			              </tr> -->
			            <!-- </tbody>
		              </table>
		    		</div>  -->
		    		 <!-- end -->
		    		 <!-- upgrade toggle -->
		    		 <div id="downgrade" class="scrollbar">
		              <table class="table table-hover" style="margin-bottom:0;">
		              <thead class="bg-green">
			              <tr>
			                <th colspan="3" class="downgrade-title light-blue-border">UPGRADE MY ACADEMY</th>
			                
			              </tr>
			            </thead>
			            <thead class="bg-green">
			              <tr>
			                <th class="downgrade-title light-blue-border">Basic Plan</th>
			                <th class="downgrade-title light-blue-border">Professional Plan</th>
			                <th class="downgrade-title light-blue-border">Corporate Plan</th>
			              </tr>
			            </thead>
			            <tbody id="upgrade_body">
			            <tr>
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

			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="bg-green-btn">SELECT</a></td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="bg-green-btn">SELECT</a></td>
			                <td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="bg-green-btn">SELECT</a></td>
			              
			              </tr> 
			            </tbody>
		              </table>
		    		 </div>
		    		<!-- end -->
		          </div>
            </div>
           </div>
    
          </div>
      </div>

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
					// console.log(objNew[i].basic_plan);

					 if(parseInt(objNew[i].fid) == 1)
					 {
				    	var str ='<tr><td class="table-first-row light-blue-border">'+objNew[i].basic_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].advance_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].premium_plan+'</td>';
				    	str+='</tr>';
				     }
				     else if(parseInt(objNew[i].fid) < 27)
				     {
				     	
				     	var str ='<tr>';
				     	if(objNew[i].basic_plan !== null)
				     	str+='<td class="light-blue-border">'+objNew[i].basic_plan+'</td>';
				     	else
				     	str+='<td class="light-blue-border">_</td>';

						if(objNew[i].advance_plan !== null)
				        str+='<td class="light-blue-border">'+objNew[i].advance_plan+'</td>';
				     	else
				     	str+='<td class="light-blue-border">_</td>';

				     	if(objNew[i].premium_plan !== null)
				        str+='<td class="light-blue-border">'+objNew[i].premium_plan+'</td>';
				     	else
				     	str+='<td class="light-blue-border">_</td>';

				    	str+='</tr>';


			         }
			         else //(parseInt(objNew[i].fid) == 12)
			         {
			         	var plan_id = $('#plan_id').val();
			         	// console.log(plan_id);
			         	var str ='<tr><td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="bg-blue-btn">SELECT</a></td>';
			                str+='<td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="bg-blue-btn">SELECT</a></td>';
			                str+='<td class="btn-space light-blue-border"><a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="bg-blue-btn">SELECT</a></td>';
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
					// console.log(objNew[i].basic_plan);

					 if(parseInt(objNew[i].fid) == 1)
					 {
				    	var str ='<tr><td class="table-first-row light-blue-border">'+objNew[i].basic_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].advance_plan+'</td>';
				        str+='<td class="table-first-row light-blue-border">'+objNew[i].premium_plan+'</td>';
				    	str+='</tr>';
				     }
				     else if(parseInt(objNew[i].fid) < 27)
				     {
				     	
				     	var str ='<tr>';
				     	if(objNew[i].basic_plan !== null)
				     	str+='<td class="light-blue-border">'+objNew[i].basic_plan+'</td>';
				     	else
				     	str+='<td class="light-blue-border">_</td>';

						if(objNew[i].advance_plan !== null)
				        str+='<td class="light-blue-border">'+objNew[i].advance_plan+'</td>';
				     	else
				     	str+='<td class="light-blue-border">_</td>';

				     	if(objNew[i].premium_plan !== null)
				        str+='<td class="light-blue-border">'+objNew[i].premium_plan+'</td>';
				     	else
				     	str+='<td class="light-blue-border">_</td>';

				    	str+='</tr>';



			         }
			         else //(parseInt(objNew[i].fid) == 12)
			         {
			         	var plan_id = $('#plan_id').val();
			         	// console.log(objNew[i].basic_plan+" : objNew[i]");
			         	var str ='<tr><td class="btn-space light-blue-border">';
			         	// if(plan_id==objNew[i].basic_plan){
			         		str+='<a href="<?php echo base_url(); ?>admin/client/renewpayment/1" class="bg-blue-btn">SELECT</a>';
			         	// }
			         	
			         	str+='</td>';
			            str+='<td class="btn-space light-blue-border">';
			            // if(plan_id==objNew[i].advance_plan){
			            str+='<a href="<?php echo base_url(); ?>admin/client/renewpayment/2" class="bg-blue-btn">SELECT</a>';
			            // }
			            str+='</td>';
			            str+='<td class="btn-space light-blue-border">';
			             // if(plan_id==objNew[i].premium_plan){
			            str+='<a href="<?php echo base_url(); ?>admin/client/renewpayment/3" class="bg-blue-btn">SELECT</a>';
			        	// }
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
  

  <!-- ======================================================================== -->
  


