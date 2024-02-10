<?php
  $sessionarray = $this->session->userdata('logged_in');
   $user_id = $sessionarray['id'];
?>
<div class="slider">
  <div class="container">

      <div class="row-fluid">
      <div class="<?php if(!$user_id) { echo "banner_img_die"; }  ?>">
      <?php
$CI =& get_instance();
$CI->load->model('admin/settings_model');
$getItemssetting = $CI->settings_model->getItems();
$bannerTitle = $getItemssetting[0]['banneTitle'];

foreach($getItemssetting as $sata){
?>
    <img width='1140' height='360' class="slider container" src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $sata['bannerimage'];?>">
<?php
}


?>
         <?php
            if(!$user_id)
            {
         ?>
      
          <div class="span5 offset7">
            
           
        <!-- start new form  -->
        <div class="form">
      
                  <h2 class="animated delay3 bounceIn"><?php echo $bannerTitle; ?></h2>
                    <div  id="loading" style="display: none" class='alert'>
<a class='close' data-dismiss='alert'>×</a>
Loading
</div>

<div id="response"></div>
                    <!--<form id="contact" method="post" action="demo">-->
          <?php 
          $attributes = array('class' => 'tform', 'id' => 'register');
          echo form_open(base_url().'/users/registration', $attributes);
          ?>
                      <div class="row-fluid">
                        <div class="span6">
                            <input type="text" required placeholder="First Name" name="first_name" id="first_name" value="<?php echo set_value('first_name', (isset($first_name)) ? $first_name : ''); ?>" />
                <span class="error"><?php echo form_error('first_name'); ?></span>
                          </div>
                          <div class="span6">
                              <input id="last_name" type="text" name="last_name" required placeholder="Last Name" value="<?php echo set_value('last_name', (isset($last_name)) ? $last_name : ''); ?>" />
                           <span class="error"><?php echo form_error('last_name'); ?></span>
               </div>
                        </div>

                         <div class="row-fluid">

<div class="span12">
                            <input type="email" required placeholder=" * Email" id="email"  name="email" value="<?php echo set_value('email', (isset($email)) ? $email : ''); ?>" />
                          <span class="error"><?php echo form_error('email'); ?></span>
              </div>

                        <div class="row-fluid">
                          

                          <div class="span6">
                              <input id="password" type="password" name="password" required placeholder="Password" value="<?php echo set_value('password'); ?>" />
                <span class="error"><?php echo form_error('password'); ?></span>
                            </div>

                              <div class="span6">
                          <input id="password_confirm" type="password" name="password_confirm" required placeholder="Confirm Password" value="<?php echo set_value('password_confirm'); ?>"  />
                          <span class="error"><?php echo form_error('password_confirm'); ?></span>
              </div>

                        </div>                 

                          
                          
                        </div>

                        <div class="row4">
                          <input type="submit" class="btn button animated bounceIn" value="Click Here For Sign Up" name ="submit2">
                        </div>
                   <!-- </form>-->
           <?php echo form_close(); ?>

                    <div class="clear"></div>
                  
                </div>

               
        
        <!-- End new form  -->
            </div>
            <?php
              }
            ?>
            </div>
        </div>
    </div>
</div>

