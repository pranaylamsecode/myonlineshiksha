<body style="">
<?php 
$CI = & get_instance();
$CI->load->view('new_template_design/header'); ?>
<style>
  .contactmap {
    position: inherit;
  }
</style>

<div class="container-fluid banner-section contact-banner-section">
  <nav class="navbar" id="banner_menu">
    <ul class="nav navbar-nav upper-menu">
      <li class="active"><a href="<?php echo base_url() ?>">Home</a></li>
      <li ><a href="<?php echo base_url() ?>about">About Us</a></li>
      <li><a href="<?php echo base_url() ?>category/courses">Course</a></li>
      <li><a href="<?php echo base_url() ?>blog">Blog</a></li>
      <!-- <li><a href="<?php echo base_url() ?>career">Career</a></li> -->
      <!-- <li><a href="<?php echo base_url() ?>category/press">Press</a></li> -->
      <li><a href="<?php echo base_url() ?>become-a-teacher">Teaching</a></li>
    </ul>
  </nav> 
  <div class="section-text">
     <h1 class="image-title">Contact Us</h1><br>
    <p class="img-para">Join the Collaborative Indian Community of Online teachers and students.</p> 
  </div>
</div>

<section class="container contact_form">
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
<div style="padding:0;">
  <div class="col-sm-12 contactmap top">
    <div class="col-sm-4 first_com">
      <h2 class="main_cont_title">Contact Us</h2>
      <p class="information" style="word-break: break-word;">
        <span><i class="entypo-location"></i> ADDRESS : </span>
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
				<ul class="social-networks" style="padding: 5px 0 0 10px;">
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
    <div class="col-sm-8 actual_loct_map">
      <?php  echo $mapcode; ?>


<!-- <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?q=nagpur+sadar&ie=UTF8&hq=&hnear=Sadar,+Nagpur,+Maharashtra&ll=21.163263,79.074391&spn=0.021891,0.038581&t=m&z=14&iwloc=lyrftr:m,133363351128004174,21.165643,79.064183&output=embed"></iframe>-->
    </div>
  </div>
</div>
<div style="clear:both;"></div>
  <div style="padding:0;">
    <div class="botm_cont span12">
      <hr>
		  <div class="btm-hed-cont">GET IN TOUCH</div>
		</div>
  </div>
  <div style="padding:0;">
    <div class="span12">
       <div class="contact_fom_body">
       <!--<h1><?php echo $contactpage[0]['heading']?></h1>-->
      <?php echo $contactpage[0]['content']?>
      <?php
        // $attributes = array('class' => 'tform', 'id' => 'contact');
        // echo form_open(base_url().'specialpages/contactuspage', $attributes);
        echo form_open(base_url().'specialpages/contactuspage');
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
          <h5 style="color: coral;text-align: center;padding: 30px;font-size:16px"><?php $msg = $this->session->flashdata('message'); echo $msg['text']; ?></h5>
      	<h3><?php echo $contactpage[0]['heading']?></h3>
        <form class="contact-form" role="form" method="post" action="" enctype="application/x-www-form-urlencoded" onsubmit="return check_error()">
					<div class="form-group">						
            <i class="fa fa-user-o"></i><input type="text" placeholder="Name" style="width:100%;" id="ISContactForm_name" name="name" value="<?php echo $err ? set_value('name'):''; //echo ($this->input->post('name') ? $this->input->post('name') : '') ?>">
            <span class="error" id="err_name"><?php echo form_error('name'); ?></span>
					</div>
					<div class="form-group">						
            <i class="fa fa-envelope-o"></i><input type="text"  placeholder="E-mail" style="width:100%;" id="ISContactForm_email" name="email" value="<?php echo $err ? set_value('email'):''; //echo ($this->input->post('email') ? $this->input->post('email') : '') ?>">
						<span class="error" id="email_error"><?php echo form_error('email'); ?></span>
					</div>
					<div class="form-group">						
            <i class="fa fa-tasks"></i><input type="text" placeholder="Subject" style="width:100%;" id="ISContactForm_subject" name="subject" maxlength="128" size="60" value="<?php echo $err ? set_value('subject'):'';  //echo ($this->input->post('subject') ? $this->input->post('subject') : '') ?>">
						<span class="error" id="err_subject"><?php echo form_error('subject'); ?></span> 
					</div>	
          <div class="form-group">						
            <i class="fa fa-comment-o"></i><textarea id="ISContactForm_body" placeholder="Message" style="width:100%;" name="body" cols="30" rows="10"><?php echo $err ? set_value('body'):''; //echo ($this->input->post('body') ? $this->input->post('body') : '') ?></textarea>
						<span class="error" id="err_message"><?php echo form_error('body'); ?></span> 
					</div>
					<div class="g-recaptcha" data-sitekey="6LcS-B0eAAAAANHzCH8BBwEkfKJATh50dXTUBPqi"></div>
					<div class="form-group text-center">
            <button class="btn-primary_red" type="submit" onclick="return check_error()" name="send" id="send" value="send">SEND NOW</button>         
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
<?php 
echo $this->load->view('new_template_design/footer'); 
?> 

<script type="text/javascript">
  function check_error()
  {
    var name = $("#ISContactForm_name").val().trim();
    var email = $("#ISContactForm_email").val().trim();
    var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    var subject = $("#ISContactForm_subject").val().trim();
    var body = $("#ISContactForm_body").val().trim();
    
    if(name=="")
    {
        $("#err_name").fadeIn().html("Please enter name").css('color','red');
        setTimeout(function(){$("#err_name").html("");},3000);
        $("#ISContactForm_name").focus();
        return false;
    }
    if(email =="")
    {
        $("#email_error").fadeIn().html("Please enter email").css('color','red');
        setTimeout(function(){$("#email_error").html("");},3000);
        $("#ISContactForm_email").focus();
        return false;
    }
    else if(!email_pattern.test(email))
    {
       $("#email_error").fadeIn().html("Please enter valid email").css('color','red');
        setTimeout(function(){$("#email_error").html("");},3000);
        $("#ISContactForm_email").focus();
        return false;
    }

    if(subject =="")
    {
        $("#err_subject").fadeIn().html("Please enter Subject").css('color','red');
        setTimeout(function(){$("#err_subject").html("");},3000);
        $("#ISContactForm_subject").focus();
        return false;
    }  
    
    if(body =="")
    {
        $("#err_message").fadeIn().html("Please type Message").css('color','red');
        setTimeout(function(){$("#err_message").html("");},3000);
        $("#ISContactForm_body").focus();
        return false;
    }
  }
</script>
</body>
</html>
