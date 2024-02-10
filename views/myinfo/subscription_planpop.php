<?php
    $CI = & get_instance();
     $CI->load->model('settings_model');
      $currency = $this->settings_model->getItems();
      $currencysign = $this->settings_model->getCurrenciesign($currency[0]['currency']);
     
    //if($currency[0]['currency'] == 'USD')
    if($currencysign)
    {
      $currency_symbol = $currencysign->sign;
    }
    else
    {

    $currency_symbol = " "; 
    
    }


      
      $pay_setting = $this->settings_model->getAccountMode();
      $pro_id = $this->uri->segment(3);

       $CI2 = & get_instance();
     $CI2->load->model('Program_model');
     // $program_plans = $CI2->Program_model->getProgramPlans($pro_id); 
     $program_plans = $CI2->Program_model->getProgramRenewalPlans($pro_id);  
          // echo"<pre>";
        //   print_r($program_plans);
     if(empty($program_plans))
     {
        $program_plans = $CI2->Program_model->getProgramPlans($pro_id);
     }


    $default_plans = $CI2->Program_model->getDefaultPlans($pro_id);
   

    $auth = $this->session->userdata('logged_in');
    $user_id = $auth['id'];
       $buycourse= $this->Myinfo_model->getCourses($user_id,$pro_id,'');
       
         if($buycourse->fixedrate == 0.00)
         {
           $display="none";
           $displaysubs_option="block";
         }
         else
         {
           $display="block";
           $displaysubs_option="none";
         } 
?>
<style type="text/css">
  .general-heading{
    margin: 0;
    margin-bottom: 10px;
  }
</style>
<div id="payment">
  <div id="payment-ct"> 
    
    <!--Subscription options-->
    <form id="subs_option" style="display:<?php echo $displaysubs_option ?>">
      <h3 class="general-heading">Subscription Options</h3>
      <!-- <a class="sub_modal_close" href="#"><i class="entypo-cancel-squared"></i></a> -->
      <div class="pay_main_cont" style="height: auto; overflow-y: auto;">
        <div class="tab-content"> 
          
			    
    <?php

			foreach($program_plans as $prog_plan)
			{
			?>
			<div style="width:100%; padding-top: 10px;">
            <div class="tile-stats">
             	<div class="tile-header">
              	<input type="radio"  name="plan_radio" id="plan_radio" value="" <?php if($prog_plan->default_new == 1) echo 'checked'; ?>/>
              	<h3 style="color: #fff;"><?php echo $prog_plan->name; ?></h3>
              	</div>
				<div style="margin-top: 15px; float: left;">
              	<h3 style="float:left; margin-right: 10px; margin-left: 45px;">Price :&nbsp;<i class="fa fa-usd"></i><?php echo $currency_symbol.$prog_plan->price; ?></h3>
              	<p><?php echo $prog_plan->term.'/'.$prog_plan->period; ?></p>
				</div>
              	
          		<div style="margin-top: 10px; margin-bottom: 10px; margin-right: 10px; float: right;">
              	<button type="button"  onclick="showodiv(<?php echo $prog_plan->plan_id;  ?>)" id="subs_button" class="btn btn-success">Subscribe</button>
                </div>
            </div>
			</div>
			<?php
			}
			?>          
			
        </div>
      </div>
    </form>
    
    <!--Confirm Purchase-->
    <?php $attributes = array('class' => 'tform', 'id' => 'conf_purchase' , 'style' => 'display:'.$display);
    //echo form_open_multipart(base_url().'myinfo/renew/', $attributes); 
    echo form_open_multipart(base_url().'paymentprocess/renew_payment_process/'.$pro_id, $attributes); ?>
    <!--<form id="conf_purchase" style="display:none" >-->
    
    <h3 class="general-heading">Confirm Purchase</h3>
    <!-- <a class="pay_modal_close" href="#"><i class="entypo-cancel-squared"></i></a> -->
    <div class="pay_main_cont">
      <div>
      
        <ul class="nav nav-tabs bordered">
         <?php
      			if($pay_setting['0']['paypal_status'] == 1)
      			{
      	 ?>
          <li class="active"> <a href="#paypal" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Paypal</span> </a> </li>
          <?php
          		}
          		if($pay_setting['0']['directpay_status'] == 1)
          		{
          ?>
          <li> <a href="#direct" data-toggle="tab"> <span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Other Information</span> </a> </li>
          <?php
          		}
          ?>
        </ul>
      </div>
      <div class="tab-content">
       

        <?php
      			if($pay_setting['0']['paypal_status'] == 1)
      			{

              $buycourse= $this->Myinfo_model->getCourses($user_id,$pro_id,'');
              
      	 ?>
        <div class="tab-pane active" id="paypal" style="padding:15px 10px 0 10px; border:0; ">
        	<input type="hidden" name='plan_id' id="plan_id" value="<?php echo $buycourse->price; ?>"  style="width:100%; border: 1px solid #C7C7C7; height:40px;"  /> 
        	
        	
        	<input type="hidden" name="course_id" id="course_id" value="<?php echo $pro_id; ?>" />
          <input type="hidden" name="coursebuy_id"  id="coursebuy_id" value="<?php echo $buycourse->id; ?>" />
          <div> <?php //echo form_submit( 'submit', 'Go To Paypal', "class='btn btn-info'"); ?> 
            <!-- <input type="button" name="" class="btn btn-info" id="" onclick="renewCourseClick2();" value="Go To Paypal" />  -->
           <input type="submit" name="" class="btn btn-info" id=""  value="Go To Paypal" /> 
          </div>
          <div style="color: #8392A3; font-size: 13px; margin-top:10px;"> You will be redirected to Paypal's payment page and then sent back once you complete your purchase. </div>
          <div style="color: #8392A3; font-size: 13px; margin-top:10px;"> By clicking the "Pay" button, you agree to these <a href="#" target="_blank"><b>Terms of Service</b></a>. </div>
          <div style="color: #8392A3; font-size: 13px; text-align:center; margin-top:10px;"> <a href="#"><i class="entypo-lock-open"></i>Secure Connection</a> </div>
        </div>
        <?php
        	}
        	if($pay_setting['0']['directpay_status'] == 1)
          	{
        ?>
        <div class="tab-pane" id="direct" style="padding:15px 10px 0 10px; border:0; ">
          <div>
            <!-- <input type="text" name='cardholder' placeholder="Name on card"   value="" style="width:100%; border: 1px solid #C7C7C7; height:40px;"/> -->
          	<?php 

          	$Otherpay = $this->settings_model->getAccountMode();

          	foreach ( $Otherpay as $Otherpay2) {
          		 
          	
          	
          	?>
          <!-- <textarea id ="directpay" name="directpay" rows="5" placeholder="Other Information" value="" style="width:100%; border: 1px solid #C7C7C7;"><?php echo $Otherpay2['directinfo']; ?></textarea> -->
          <div> <?php echo nl2br($Otherpay2['directinfo']); ?> </div>
          <div id="request_exist"></div>
          <?php  } ?>
          </div>
          <div> <?php echo form_submit( 'submit', 'Direct Payment',  "class='btn-primary_red'"); ?></div>
        </div>
        <?php
        	}
        ?>
      </div>
    </div>
    <?php echo form_close(); ?> 
    <!--</form>--> 
  </div>

<!-- <div id="enroll"  style="display: block; position: fixed; opacity: 1; z-index: 11000; left: 50%; margin-left: -202px; top: 100px;"> -->
  <!-- <div id="enroll" >
  <div id="payment-ct"> -->
    <?php 
    if($buycourse->chb_free_courses!=1)
    {
    $attributes = array('class' => 'tform', 'id' => '');
   echo form_open_multipart(base_url().'programs/enroll/'.$pro_id, $attributes); ?>
    <!-- <h3 class="general-heading">Enroll</h3>
    <a class="enroll_modal_close" href="#"><i class="entypo-cancel-squared"></i></a> -->
    <div class="pay_main_cont">
      <div class="tab-content">
        <p>Do You Want to Enroll?</p>
        <input class="btn-primary_red" type="submit" name="" value="Enroll Now" />
      </div>
    </div>
    <?php 
  }
     echo form_close();  ?> 
    <!-- </div>
</div> -->

</div>
<script>
function showodiv(j)
{
  
  var plan_id = j;  

  document.getElementById("plan_id").value = plan_id; //returns 2489.82
  
  document.getElementById("conf_purchase").style.display = 'block';
  document.getElementById("subs_option").style.display = 'none';
}

function renewCourseClick2()
    {
      var message ="";
      var course_id = document.getElementById("course_id").value;
      var price = document.getElementById("price").value;
      var buy_id = document.getElementById("coursebuy_id").value;
      var path = "<?php echo base_url(); ?>";

      //alert(course_id+"+"+price+"+"+buy_id);

      var x = confirm("Are you sure you want to renew?");
    if (x == true)
    {     
      window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
    }
    else
      return false;


    //    $j.confirm({
    //      title: '',
    //      content: message,
    //      confirm: function(){
    //            window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
    //           },
    //      cancel: function(){
            
    //         }
        // });
  }
</script>
