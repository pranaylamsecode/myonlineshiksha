<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style>
label {
display: inline-block;
margin-bottom: 5px;
padding: 15px 0px 15px 15px;
width: 42%;
}
.btn-primary_red {
/* float: left; */
color: #fff;
padding: 5px 10px 5px 10px;
font-size: 14px;
font-family: 'Open Sans', sans-serif;
font-weight: 600;
line-height: 31px;
margin: 10px auto;
display: block;
height: 40px;
border: 0;
border-radius: 4px;
text-align: center;
text-transform: uppercase;
text-shadow: none;
}

.titleholder {
background: #dddddd) url('../images/v3/noise.png');
border-radius: 4px 4px 0px 0px;
padding: 5px;
border-bottom: 1px solid #CCC;
color: #353535;
text-shadow: 0 1px 0 #fff;
text-align: center;
}

@media screen and (max-width: 768px)
{
.admintable
{
	padding:20px;
}

}

@media screen and (max-width: 480px)
{
label {
width: 100%;
}
.btn-primary_red {
 float:left;
 margin:0;
}
}
</style>


<section class='container courses'>



<!-- <div class="titleholder"><h5>Do you have an account on our site?</h5></div>-->

<!--Div for First Section -->



    <?php
    $attributes = array('class' => 'tform', 'id' => 'frmInstructor');
    echo form_open('/users/inst_desc_save', $attributes);
    ?>
    <div class="titleholder">
      <h5>HELP US HELP YOU!</h5>
    </div>
    
    
    <div class="row-fluid">
<div class="span12">

      
        <div class="admintable">
          <div class="logtitle">Planning Your Course</div>
          <div>
            <label>What language do you want to teach in ?:</label>
            <select id="language" name="language">
              <option value=''>--Select Language--</option>
              <option value='English'>English</option>
              <option value='Spanish'>Spanish</option>
              <option value='French'>French</option>
              <option value='German'>German</option>
              <option value='Chinese'>Chinese</option>
              <option value='Japanese'>Japanese</option>
            </select>
            <span class="error"><?php echo form_error('language'); ?></span> </div>
          <div>
            <label>What category best describes your course topic ?:</label>
            <select id="category" name="category">
              <option value=''>--Select Category--</option>
              <?php
							$query = $this->db->query("select id,name from mlms_category");
							foreach ($query->result() as $row)
							{
							?>
              <option value='<?php echo $row->id?>'><?php echo $row->name?></option>
              <?php
							}	
							?>
            </select>
            <span class="error"><?php echo form_error('category'); ?></span> </div>
          <div>
            <label>Which of the following best describes your goal of teaching on MLMS?:</label>
            <select id="primary_goal" name="primary_goal">
              <option value=''>--Select Goal--</option>
              <option value='Technology Awareness'>Technology Awareness</option>
              
            </select>
            <span class="error"><?php echo form_error('primary_goal'); ?></span> </div>
          <div class="logtitle">Producing Your Course</div>
          <div>
            <label>Which of the following best describes your ideal course creation experience?:</label>
            <select id="ideal_course" name="ideal_course">
              <option value=''>--Select Ideal Course--</option>
              <option value='Poor'>Poor</option>
              <option value='Average'>Average</option>
              <option value='Good'>Good</option>
            </select>
            <span class="error"><?php echo form_error('ideal_course'); ?></span> </div>
          <div class="logtitle">Promoting Your Course</div>
          <div>
            <label>Tell us a little bit about your following, and we'll send you tailored marketing resources when you're ready to promote your course?:</label>
            <select id="promote_course" name="promote_course">
			   <option value=''>--Select Promoter--</option>
              <option value='Online Promotion'>Online Promotion</option>
              <option value='Online Ad'>Online Ad</option>
              <option value='Online Marketing'>Online Marketing</option>
            </select>
            <span class="error"><?php echo form_error('promote_course'); ?></span> </div>
          <div>
            <label>Do you have subscriber on YouTube?:</label>
            <select id="subscriber" name="subscriber">
              <option value=''>--Select Subscriber--</option>
              <option value='You tube'>You tube</option>
              <option value='YouTube'>YouTube</option>
            </select>
            <span class="error"><?php echo form_error('subscriber'); ?></span> </div>
          <div> <?php echo form_submit( 'submit', 'Tailor my experience', "class='btn-primary_red'"); ?> </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
    


</section>