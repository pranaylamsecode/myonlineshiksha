<section class="container courses">
           <div class="row-fluid ">


<?php
if($contactpage[0]['settings'])
{
  $settingarr=json_decode($contactpage[0]['settings']);
  $address=$settingarr->address;
  $phone=$settingarr->phone;
  $email=$settingarr->email;
  $weburl=$settingarr->weburl;
  $mapcode=$settingarr->mapcode;
}else{
  $address="";
  $phone="";
  $email="";
  $weburl="";
  $mapcode="";
}
?>

<style type="text/css">
input#searchtext {
  display: inline-block;
  height: 30px !important;
  padding: 4px 12px !important;
}

.breadcrumb
{
	display: none;
}

.contactmap
{
	/*background: #f48022;*/ 
	height: 350px; 
	  margin-bottom: 5% !important; 
	padding: 0;

}

.contactmap .information
{

line-height: 150%; 
color: #fff; 
padding: 5px 0 0 30px;
}

.contactmap .information span
{
	font-weight: bold;
}	

.contactmap .main_cont_title
{
margin: 13px 0 20px 30px;
  color: #fff;
  padding-bottom: 5px;
  font-size: 1.8em;
  font-weight: bold;

}

.actual_loct_map
{
background-color: #fff; 
height: 100%; 
display: block; 
overflow: hidden;
  margin: 0; 
  padding: 0; 
  float:right;
}

	.btm-hed-cont {
  color: #626263;
  background: #f7f5f2;
  border: 1px solid #bbb;
  box-shadow: 0 1px rgba(0,0,0,0);
  padding: 14px 24px;
  font-size: 13px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 0.2em;
  border-radius: 5px;
  display: inline-block;
  line-height: 20px;
  text-align: center;
  position: relative;
  z-index: 2;
}

.botm_cont
{
position: relative;
  text-align: center;
  display: block;
    margin-bottom: 2% !important;
}

.botm_cont hr {
  height: 3px;
  width: 100%;
  display: block;
  position: absolute;
  background-color: #bbb;
  top: 12%;
  left: 0;
  z-index: 1;
}

.contact_fom_body
{
background: #fff;
padding: 2%;
display: block;
}

.contact_fom_body .leftcontent {
position: relative;
  margin: 0px auto;
  width: 420px;
  min-height: 200px;
  z-index: 100;
  padding: 30px;
  border: 1px solid rgba(56, 56, 56, 0.33);
  /* background: #D1D1D1; */
  /*background: -moz-repeating-linear-gradient(-45deg, #EFC1CB, #EFC1CB 30px, #F2F2F2 30px, #F2F2F2 40px, #C2E8F5 40px, #C2E8F5 70px, #F2F2F2 70px, #F2F2F2 80px);*/
  /* background: -webkit-repeating-linear-gradient(-45deg, #EFC1CB, #EFC1CB 30px, #F2F2F2 30px, #F2F2F2 40px, #C2E8F5 40px, #C2E8F5 70px, #F2F2F2 70px, #F2F2F2 80px); */
  /*background: -o-repeating-linear-gradient(-45deg, #EFC1CB, #EFC1CB 30px, #F2F2F2 30px, #F2F2F2 40px, #C2E8F5 40px, #C2E8F5 70px, #F2F2F2 70px, #F2F2F2 80px);*/
  /* background: repeating-linear-gradient(-45deg, #EFC1CB, #EFC1CB 30px, #F2F2F2 30px, #F2F2F2 40px, #C2E8F5 40px, #C2E8F5 70px, #F2F2F2 70px, #F2F2F2 80px); */
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
  /* -webkit-box-shadow: 0px 1px 6px #3F3F3F; */
  /*-moz-box-shadow: 0px 1px 6px #3F3F3F;*/
  /* box-shadow: 0px 1px 6px #3F3F3F; */
}

.contact_fom_body .leftcontent h3{
  margin-top: -5px !important;
  margin-bottom: 20px !important;
}

.contact_fom_body .leftcontent:after {
  background: #F9F9F9;
  margin: 10px;
  position: absolute;
  content: " ";
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  z-index: -1;
  border: 1px #E5E5E5 solid;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
}

select, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
  display: inline-block;
  height: 40px !important;
  padding: 4px 12px !important;
  }

.contact_fom_body .leftcontent .btn-primary_red {
  width: 100%;
}


@media screen and (max-width: 1200px)
{
.row-fluid .span8 {
    float: right;
}
}

@media screen and (max-width: 1024px)
{
  
}

@media screen and (max-width: 980px)
{
.contactmap
{
float: none !important;
  height: 100%;
  margin-bottom: 5% !important;
  padding: 0;

}

.span4.first_com {
  float: none;
  padding: 20px;
}

.span8.actual_loct_map
{
float: none;
padding: 0px;
margin-top: 40px;
margin-left: 0 !important;
width: 100% !important;
}

}

@media screen and (max-width: 768px)
{
  .first_com
{
    padding: 30px 20px 50px 20px;
}

.contactmap {

  margin-bottom: 5% !important;

}
}

@media screen and (max-width: 640px)
{
  
}

@media screen and (max-width: 480px)
{

.contactmap {

  margin-bottom: 5% !important;
}  

.contact_fom_body .leftcontent
{
  width: 90% !important;
  margin: 0 auto !important;

}

  .first_com
{
    padding: 30px 20px 30px 20px;
}

}
  

@media screen and (max-width: 320px)
{
  
}

</style>

<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/css/bootstrap.min.css" />-->
<!--
<div class="row" style="padding:0;">

<div class="span12 contactmap top"> 

    <div class="span4 first_com">
    <h2 class="main_cont_title">Contact Us</h2>

    
    <p class="information">
    <span><i class="entypo-location"></i> ADDRESS: </span>
    <?php echo $address;?>
    </p>


    <p class="information">
    <span><i class="entypo-phone"></i> TELEPHONE: </span> <?php echo $phone;?>
    </p>


    <p class="information">
    <span><i class="entypo-newspaper"></i> E-MAIL: </span> <?php echo $email;?>
    </p>

    <p class="information">
    <span><i class="entypo-link"></i> WEB-URL: </span> <?php echo $weburl;?>
					
					<ul class="social-networks" style="padding: 0px 0 0 30px;">
						<li>
							<a href="#">
								<i style="color:#fff;" class="entypo-gplus"></i>
							</a>
						</li>
						
						<li>
							<a href="#">
								<i style="color:#fff;" class="entypo-facebook"></i>
							</a>
						</li>
					</ul>


    </p>


    </div>





   
</div> 


</div> -->


<div style="clear:both;"></div>

<div class="row" style="padding:0;">
<div class="botm_cont span12">
<hr>
			<div class="btm-hed-cont">Help & Support</div>
		
		</div>
</div>





<div class="row" style="padding:0;">
    <div class="span12">
       <div class="contact_fom_body">
       <!--<h1><?php echo $contactpage[0]['heading']?></h1>-->
       <?php //echo $contactpage[0]['content']
            echo "<h3>How can we help you?</h3><p style='padding-bottom: 2%;'>Have an issue you need to resolved? Our Staff is ready to help you to get answers of your query, whether you're have to create or discover something remarkable.</p>"; 
       ?>
<?php
  // $attributes = array('class' => 'tform', 'id' => 'contact');
  // echo form_open(base_url().'specialpages/contactuspage', $attributes);
echo form_open(base_url().'orders/support');
?>
  <?php 

   //if( echo form_error('email'); 

  ?>
      <?php 
      $err = 0;
      if(form_error('name') || form_error('email') || form_error('subject') || form_error('body'))
      {
        $err =1;
      }


       ?>
      	<div class="leftcontent">
      		<h3><?php //echo  $contactpage[0]['heading']
                      echo "Your Support Inquiry"; ?></h3>
            
            <form class="contact-form" role="form" method="post" action="" enctype="application/x-www-form-urlencoded">
					
					<div class="form-group">						
                        <input type="text" placeholder="Name" style="width:100%;" id="ISContactForm_name" name="name" value="<?php echo $err ? set_value('name'):''; //echo ($this->input->post('name') ? $this->input->post('name') : '') ?>" required >
                    	<span class="error"><?php echo form_error('name'); ?></span>
					</div>
					
					<div class="form-group">						
                        <input type="email"  placeholder="E-mail" style="width:100%;" id="ISContactForm_email" name="email" value="<?php echo $err ? set_value('email'):''; //echo ($this->input->post('email') ? $this->input->post('email') : '') ?>" required>
						<span class="error"><?php echo form_error('email'); ?></span>
					</div>
					
                    <div class="form-group">						
                        <input type="text" placeholder="Subject" style="width:100%;" id="ISContactForm_subject" name="subject" maxlength="128" size="60" value="<?php echo $err ? set_value('subject'):'';  //echo ($this->input->post('subject') ? $this->input->post('subject') : '') ?>" required>
						<span class="error"><?php echo form_error('subject'); ?></span> 
					</div>	

					<!-- <div class="form-group">
						<select id="mailto" name="mailto" style="width:100%;">
							<option value=''>--Select Department To Mail--</option>
							<option value='Enquiry'>Enquiry</option>              
							<option value='Support'>Support</option>              
							<option value='Billing'>Billing</option>              
							<option value='Technical'>Technical</option>   
							<option value='Sales'>Sales</option>							
						</select>			
						<span class="error"><?php echo form_error('subject'); ?></span> 
					</div> -->
                    
					<div class="form-group">						
                        <textarea id="ISContactForm_body" placeholder="Massege" style="width:100%;" name="body" cols="30" rows="11" required><?php echo $err ? set_value('body'):''; //echo ($this->input->post('body') ? $this->input->post('body') : '') ?></textarea>
						<span class="error"><?php echo form_error('body'); ?></span> 
					</div>
					
					<div class="form-group text-right">
                        <button class="btn-primary_red" type="submit" name="send" id="send" value="send">SEND</button>                        
					</div>
					
					<!-- j<?php
					if($this->session->userdata('contactmail'))
					{
					?>
					<div style='color: #4F8A10;background-color: #DFF2BF;padding:10px 20px;'>
						<?php
							echo $this->session->userdata('contactmail');
							$this->session->unset_userdata('contactmail');
						?>
					</div>
					<?php
					}
					?>j -->
				</form>
            
            
              <div class="form-action"><div class="controls"></div></div>
      	</div>
      </div>
      </div>
<?php echo form_close(); ?>


</div>

</div>
</section>


 <script>
// // For Student Login
// $(function() {
//     var action = '';
//     var form_data = '';
//     $('#send').click(function () {
//          action = $("#contact").attr("action");
     
//          // form_data = {
//          // email: $("#txtStudentEmail").val(),
//          // password: $("#txtStudentPassword").val(),
//          // is_ajax: '1'};  
     
//         $.ajax({
//             type: 'POST',
//             url: action,
//             data: $("#contact").serialize(), 
//             success: function(response) 
//             {
//               alert(response);  
//             }
//          }); 
//         return false;      
//     });  
// });
 </script>