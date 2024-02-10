

<?php

if($contactpage[0]['settings'])
{
  $settingarr=json_decode($contactpage[0]['settings']);
  $address=$settingarr->address;
  $phone=$settingarr->phone;
  $email=$settingarr->email;
  $weburl=$settingarr->weburl;
  $mapcode=$settingarr->mapcode;
}
else
{
    $address="";
    $phone="";
    $email="";
    $weburl="";
    $mapcode="";
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/public/css/bootstrap.min.css" />
<div class="row">
    <div class="span6">
    <div class="leftcontent">
       <h1><?php echo $contactpage[0]['heading']?></h1>
       <?php echo $contactpage[0]['content']?>
<?php
$attributes = array('class' => 'tform', 'id' => '');
echo form_open('contact', $attributes);
?>
<!--<div class="leftcontent">
      <div class="row">
      <div class="span6">-->
      		<h1>Contact Form</h1>
      		<div class="control-group">
      			<label for="ISContactForm_name" class="control-label required">Name <span class="required">*</span></label>			<div class="controls">
      				<input type="text" id="ISContactForm_name" name="ISContactForm[name]">							</div>
      		</div>

      		<div class="control-group">
      			<label for="ISContactForm_email" class="control-label required">Email <span class="required">*</span></label>			<div class="controls">
      				<input type="text" id="ISContactForm_email" name="ISContactForm[email]">							</div>
      		</div>

      		<div class="control-group">
      			<label for="ISContactForm_subject" class="control-label required">Subject <span class="required">*</span></label>			<div class="controls">
      				<input type="text" id="ISContactForm_subject" name="ISContactForm[subject]" maxlength="128" size="60">							</div>
      		</div>

      		<div class="control-group">
      			<label for="ISContactForm_body" class="control-label required">Body <span class="required">*</span></label>
                  <div class="controls">
      				<textarea id="ISContactForm_body" name="ISContactForm[body]" cols="30" rows="6"></textarea>			</div>
      		    </div>

              <div class="form-action">
      		<div class="controls">
      			<button class="btn" type="submit">Send</button>
      		</div>
      	</div>
      </div>

      </div>
<?php echo form_close(); ?>
<!--    </div>
    </div>-->
    <div class="span4">
        <div class="rightsidebar">
        <?php echo $mapcode; ?>
        <p></p>
          <p><label><strong>Address</strong></label></p>
          <p><label><?php echo $address;?></label></p>
          <p><label><strong>Phone</strong></label></p>
          <p><label><?php echo $phone;?></label></p>
          <p><label><strong>Email</strong></label></p>
          <p><label><?php echo $email;?></label></p>
          <p><label><strong>Web</strong></label></p>
          <p><label><?php echo $weburl;?>t</label></p>
        </div>
    </div>

</div>
<!--<?php
$attributes = array('class' => 'tform', 'id' => '');
echo form_open('contact', $attributes);
?>
<div class="leftcontent">
      <div class="row">
      <div class="span6">
      		<h1>Contact Form</h1>
      		<div class="control-group">
      			<label for="ISContactForm_name" class="control-label required">Name <span class="required">*</span></label>			<div class="controls">
      				<input type="text" id="ISContactForm_name" name="ISContactForm[name]">							</div>
      		</div>

      		<div class="control-group">
      			<label for="ISContactForm_email" class="control-label required">Email <span class="required">*</span></label>			<div class="controls">
      				<input type="text" id="ISContactForm_email" name="ISContactForm[email]">							</div>
      		</div>

      		<div class="control-group">
      			<label for="ISContactForm_subject" class="control-label required">Subject <span class="required">*</span></label>			<div class="controls">
      				<input type="text" id="ISContactForm_subject" name="ISContactForm[subject]" maxlength="128" size="60">							</div>
      		</div>

      		<div class="control-group">
      			<label for="ISContactForm_body" class="control-label required">Body <span class="required">*</span></label>
                  <div class="controls">
      				<textarea id="ISContactForm_body" name="ISContactForm[body]" cols="30" rows="6"></textarea>			</div>
      		    </div>

              <div class="form-action">
      		<div class="controls">
      			<button class="btn" type="submit">Send</button>
      		</div>
      	</div>
      </div>

      </div>
</div>
<?php echo form_close(); ?>-->

<!--<div class="row">
		<div class="span6">
          <label><strong>Address</strong></label>
          <label><?php echo $address;?></label>
          <label><strong>Phone</strong></label>
          <label><?php echo $phone;?></label>
          <label><strong>Email</strong></label>
          <label><?php echo $email;?></label>
          <label><strong>Web</strong></label>
          <label><?php echo $weburl;?>t</label>
		</div>
</div>-->

<!--<div class="row">
		<div class="span6">
          <label><strong>Phone</strong></label>
          <label><?php echo $phone;?></label>
		</div>
</div>

<div class="row">
		<div class="span6">
        <label><strong>Email</strong></label>
        <label><?php echo $email;?></label>
		</div>
</div>

<div class="row">
		<div class="span6">
          <label><strong>Web</strong></label>
          <label><?php echo $weburl;?>t</label>
		</div>
</div>-->

