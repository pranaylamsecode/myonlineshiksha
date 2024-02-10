<div class="signupbox">
              <a href="<?php echo $fbloginUrl?>" class="fb-connect-button">Sign up with Facebook</a>
               <?php $attributes = array('class' => 'tform', 'id' => 'signup', 'name' => 'signup');
                echo form_open('/users/registration', $attributes);?>
                    <div class="signupform">
                        <div class="or">OR</div>
                        <h2 class="side-lined">
                            <span>Sign up with your email :</span>
                        </h2>
                        <div class="fields">
                            <div class="form-item fullName">
                                <input type="text" placeholder="Full Name" class="text-input" name="first_name" id="first_name" autocomplete="off"> <span class="error-text"></span>
                            </div>
                            <div class="form-item email">
                                <input type="text" placeholder="E-mail" rel="isEmailValid" class="text-input" name="email" id="email" autocomplete="off"> <span class="error-text"> </span>
                            </div>
                            <div class="form-item password">
                                <input type="password" placeholder="Password" class="text-input" name="password" id="password" autocomplete="off"> <span class="error-text"> </span>
                            </div>
                            <div class="form-bottom">
                              <!--<a href="#" class="signup-btn btn btn-success">sign up </a> -->
                              	<?php echo form_submit( 'submit', 'sign up', "class='beditform signup-btn btn btn-success'"); ?>
                                     <span>Already have an account? <a class="goto-login-btn" href="<?php echo base_url()?>users/login">login</a></span>
                            </div>
                            <div class="form-errors none"></div>
                        </div>
                    </div>
              <?php echo form_close(); ?>
                <div class="agree">
                By signing up, you agree to our <a target="blank" href="#">Terms of Use and Privacy Policy</a>
                </div>
            </div>