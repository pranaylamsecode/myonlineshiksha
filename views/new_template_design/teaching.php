<style>

    .expand-left-sec img {
    border-radius: 50%;
    width: 116px;
    height: 116px;
}
.banner-section-teaching {
    height: 500px;
}
.agree_to_terms_sec input[type="checkbox"] {
    position: relative;
    box-sizing: content-box;
    width: 20px;
    padding: 0px !important;
    height: 20px;
    margin: 0px 5px 0px 0px;
}
.agree_to_terms_sec input[type="checkbox"]:hover{
  opacity: 1;
}
.agree_to_terms_sec span {
    position: relative;
    top: -3px;
}
.agree_to_terms_sec {
    margin: 5px 0px;
}
.agree_to_terms_sec label {
    display: flex;
    align-items: inherit;
}
.login_sect a {
    color: #ea5252;
}
.login_sect a:hover {
    color: #dc2727;
}
#banner_menu .container {
    padding: 0px !important;
}
.upper-menu {
    padding-left: 0px;
}
@media (max-width: 991px) and (min-width: 881px){
.banner-section-teaching .rightbox1 .innercontent {
    margin-top: 70px;
}
}
@media (max-width: 880px){
    .banner-section-teaching .second_section .rightbox.rightbox1 {
    padding-top: 30px !important;
}
p.help-para.help-para123 {
    padding-bottom: 24px;
}
}
@media (max-width: 767px){
    .help-section {
        height: auto;
        padding: 0px 0px 50px 0px;
    }
}
</style>

    <div class="container-fluid banner-section-teaching">
        <nav class="navbar visible-lg visible-md" id="banner_menu">
            <div class="container">
                <ul class="nav navbar-nav upper-menu">
                    <li><a href="<?php echo base_url() ?>">Home</a></li>
                    <li><a href="<?php echo base_url() ?>about">About Us</a></li>
                    <li><a href="<?php echo base_url() ?>category/courses">Course</a></li>
                    <li><a href="<?php echo base_url() ?>blog">Blog</a></li>
                    <li class="active"><a href="<?php echo base_url() ?>become-a-teacher">Teaching</a></li>
                </ul>
            </div>
        </nav>
        <div class="container second_section">
            <div class="col-sm-8 section-text">
                <h1 class="teaching-title">Become our knowledge partner</h1>
                <p class="subtext">Reach millions of students around the India and earn
                    <br>money while teaching on MyOnlineShiksha.</p>
            </div>
            <div class="col-sm-4 col-xs-12 rightbox rightbox1">
                <div class="content">
                    <div class="innercontent">
                        <div class="innersect">
                            <section class="container courses">
                                <div class="row-fluid ">
                                    <div class="fullcontent">
                                        <div class="login-box-container" id="div_login" style="display:none">
                                            <div class="titleholder">
                                                <center><h5>Sign in to MyOnlineShiksha</h5></center>
                                            </div>
                                                        <center><span id="invalid_err"></span></center>
                                                        <!-- <form action="<?php echo base_url();?>reseller/loginPopup/" method="post"> -->
                                                        <div id="login-form-wrapper-cont" class="cell">
                                                            <div class="admintable">
                                                                <div class="form-group">
                                                                    <input id="login_email" type="text" name="login_email" placeholder="Email">
                                                                    <span class="error" id="email_login_err"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input id="login_password" type="password" name="login_password" autocomplete="off" placeholder="Password">
                                                                    <span class="error" id="pass_err_login"></span>
                                                                </div>
                                                                <div class="sub_btn form-group">
                                                                    <input type="button" id="login_button" onclick="return set_login()" class="beditform" value="Login">
                                                                    <div id="login_wait" class="form-group" style="display: none; text-align: center; padding-top: 3px;">
                                                                        <img src="<?php echo base_url();?>/public/images/loading.gif" style="height: 30px !important; width: 30px !important">
                                                                        <span id="msg_div">Please Wait</span>
                                                                    </div>
                                                                    <!-- <input type="submit" style="display: none" id="submit_btn"> -->
                                                                    <div class="login_sect">
                                                                        <span style="margin-bottom:6px;display: block;">or</span>
                                                                        <a href="#" type="button" onclick="return show_div('div_registration','div_login')" style="font-size: 17px;">Become a Teacher</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- </form> -->
                                                    </div>
                                        <?php
                                                  $attributes = array('class' => 'tform', 'id' => 'register','onsubmit'=>'check_error()');
                                                  echo form_open(base_url().'users/instructor', $attributes);
                                                  if(isset($fbuserdata)){

                                                  $fbfirst_name = $fbuserdata['first_name'];

                                                  $fblast_name = $fbuserdata['last_name'];

                                                  $fbemail = $fbuserdata['email'];

                                                  $fbid = $fbuserdata['id'];

                                                  }

                                                  $first_name = (isset($fbfirst_name))?$fbfirst_name:null;

                                                  $first_name = (isset($user->first_name))?$user->first_name:$first_name;

                                                  $last_name = (isset($fblast_name))?$fblast_name:null;

                                                  $last_name = (isset($user->last_name))?$user->last_name:$last_name;

                                                  $email = (isset($fbemail))?$fbemail:null;

                                                  $email = (isset($user->email))?$user->email:$email;
                                                  ?>

                                                                                          <?php
                                                if($this->session->userdata('logged_in'))
                                                {
                                                ?>
                                                <div class="login-box-container">
                                                    <div id="login-form-wrapper" class="cell">
                                                        <div class="admintable">
                                                            <div>
                                                                <input id="teach" type="text" name="teach" maxlength="60" value="<?php echo set_value('teach', (isset($teach)) ? $teach : ''); ?>" placeholder="What do you want to teach?" />
                                                                <span class="error"><?php echo form_error('teach'); ?></span>
                                                            </div>

                                                            <div>
                                                                <?php echo form_submit( 'submit', 'Sign Up', "class='beditform'"); ?>
                                                                    <span style="margin-bottom:6px;display: block;;text-align: center;">or</span> <a href="<?php echo base_url(); ?>/users/login/" style="font-size: 17px;text-align: center;display: block;">Login</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                  }
                                                  else
                                                  {
                                                  ?>
                                                    <div id="div_registration">
                                                    <div class="titleholder">
                                                        <h5>Join India’s marketplace of online teaching. Start now.</h5></div>
                                                    <div class="login-box-container">
                                                        <div id="login-form-wrapper-cont" class="cell">
                                                            <div class="admintable">
                                                                <div>
                                                                    <input id="first_name" type="text" name="first_name" maxlength="256" value="<?php echo set_value('first_name', (isset($first_name)) ? $first_name : ''); ?>" placeholder="First Name"/>
                                                                    <span class="error" id="err_name"><?php echo form_error('first_name'); ?></span>
                                                                </div>
                                                                <div>
                                                                    <input id="last_name" type="text" name="last_name" maxlength="256" value="<?php echo set_value('last_name', (isset($last_name)) ? $last_name : ''); ?>" placeholder="Last Name"/>
                                                                    <span class="error" id="err_lname"><?php echo form_error('last_name'); ?></span>
                                                                </div>
                                                                <div>
                                                                    <input id="contact_no" type="text" name="contact_no" maxlength="12" value="<?php echo set_value('contact_no', (isset($contact_no)) ? $contact_no : ''); ?>" placeholder="Contact No." onkeypress="return only_number(event)"/>
                                                                    <span class="error" id="err_contact"></span>
                                                                </div>
                                                                <div>
                                                                    <input id="email" type="text" name="email" maxlength="256" value="<?php echo set_value('email', (isset($email)) ? $email : ''); ?>" placeholder="Email"/>
                                                                    <span class="error" id="email_err"><?php echo form_error('email'); ?></span>
                                                                </div>
                                                                <div>
                                                                    <input id="password" type="password" name="password" maxlength="256" autocomplete="off" value="<?php echo set_value('password'); ?>" placeholder="Password"/>
                                                                    <span class="error" id="err_password"><?php echo form_error('password'); ?></span>
                                                                </div>
                                                                <div>
                                                                    <input id="password_confirm" type="password" name="password_confirm" autocomplete="off" maxlength="256" value="<?php echo set_value('password_confirm'); ?>" placeholder="Confirm Password" onkeyup="return check_equal(this.value)"/>
                                                                    <span class="error" id="err_cpass"><?php echo form_error('password_confirm'); ?></span>
                                                                </div>
                                                                <div>
                                                                    <input id="teach" type="text" name="teach" maxlength="60" value="<?php echo set_value('teach', (isset($teach)) ? $teach : ''); ?>" placeholder="What do you want to teach?"/>
                                                                    <span class="error" id="err_teach"><?php echo form_error('teach'); ?></span>
                                                                </div>
                                                                <div class="agree_to_terms_sec">
                                                                    <input type="checkbox" name="terms_of_use" checked=""><span>I agree to MyOnlineShiksha Knowledge Partner's
                                                                    <a href="<?php echo base_url() ?>agreement">Terms of Use</a></span>
                                                                    </div>
                                                                    <div class="sub_btn">
                                                                    <div id="please_waittt" class="form-group" style="display: none; text-align: center; padding-top: 3px;">
                                                                      <img src="<?php echo base_url();?>/public/images/loading.gif" style="height: 30px !important; width: 30px !important">
                                                                      <span id="msg_div">Please Wait</span>
                                                                    </div>
                                                                   
                                                                        <input type="button" id="btn_submit" class="btn-primary_stb beditform" onclick='return check_error()' value="Become a Teacher">
                                                                        <div class="login_sect">
                                                                            <span style="margin-bottom:6px;display: block;">or</span>
                                                                            <a href="#" type="button" style="font-size: 17px;" onclick="return show_div('div_login','div_registration')">Login</a>
                                                                            <!-- <?php //echo base_url(); ?>/users/login/ -->
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <?php
  }
  ?>
                                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container help-para456">
        <div class="col-sm-8 no-padding">
            <p class="help-para help-para123">If you can make simple video lectures on the usual subjects for schools, competitive exams and colleges of India then this platform is for you. You can simply post your lectures in the form of online courses and earn a good share from each sale of the courses.</p>
        </div>
    </div>
    <div class="container discover">
        <div class="col-sm-12 teaching-content-section">
            <h1 id="teaching-content-title">Discover your potential</h1>
            <div class="col-sm-4 teching-content">
                <h5><i class="fa fa-bank fa-2x"></i></h5>
                <h3>Teach and Earn</h3>
                <p>Students will be able to find and buy your courses once they are live on MyOnlineShiksha. You'll earn money every time a student buy your online course.</p>
            </div>
            <div class="col-sm-4 teching-content">
                <h5><i class="fa fa-caret-square-o-right fa-2x"></i></h5>
                <h3>Teach Naturally</h3>
                <p>Help common Indian students by teaching them in our native languages so that they can easily understand various academic subjects.</p>
            </div>
            <div class="col-sm-4 teching-content">
                <h5><i class="fa fa-thumbs-up fa-2x"></i></h5>
                <h3>Get support</h3>
                <p>Our Instructional design experts and our online teaching resources will guide you through all the process of course creation.</p>
            </div>
        </div>
    </div>
    <section class="excetional-section">
        <div class="container">
            <h1 id="teaching-content-title2">Exceptional potential for teaching in India</h1>
            <div class="col-sm-12 excetional-content">
                <div class="col-sm-4 col-sm-4 col-xs-12">
                    <h3>315m</h3>
                    <p>Students
                        <br>in India</p>
                </div>
                <div class="col-sm-4 col-sm-4 col-xs-12">
                    <h3>22</h3>
                    <p>major languages
                        <br> in India</p>
                </div>
                <div class="col-sm-4 col-sm-4 col-xs-12">
                    <h3>460m</h3>
                    <p>internet users
                        <br> in India</p>
                </div>
            </div>
        </div>
    </section>
    <section id="slider-section-full">
        <section id="slider-section">
            <div class="container">
                <h1 id="teaching-content-title3">How it works</h1>
                <div class="col-sm-12 how-it-work">
                    <div class="col-sm-2 col-sm-2">
                        <div class="hoverable-fa active" id="slide1" data-target="#myCarousel" data-slide-to="0" class=""><img src="<?php echo base_url(); ?>public/images/TEACH YOUR SUB.png" width="100%"></div>
                        <h5><span class="step-circle">1</span>&nbsp;Teach your subject</h5>
                    </div>
                    <div class="col-sm-2 col-sm-2">
                        <div class="line"></div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2 col-sm-2" id="slide2" data-target="#myCarousel" data-slide-to="1">
                        <div class="hoverable-fa"> <img src="<?php echo base_url(); ?>public/images/CREATE COURSE.png" width="100%"></div>
                        <h5><span class="step-circle">2</span>&nbsp;Create Course in Natural Language</h5>
                    </div>
                    <div class="col-sm-2 no-padding col-sm-2">
                        <div class="line"></div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2 col-sm-2" id="slide3" data-target="#myCarousel" data-slide-to="2">
                        <div class="hoverable-fa"> <img src="<?php echo base_url(); ?>public/images/Vector Smart Object.png" width="100%"></div>
                        <h5><span class="step-circle">3</span>&nbsp;Start earning</h5>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-sm-12 slide3">
                            <div class="col-sm-6 col-sm-6">
                                <h4>Expand the reach of your class</h4>
                                <p class="sub_slide3_txt">Choose your course topic.</p>
                                <p>Teach what you are master of. You can create a series of video lectures of 10-20 minutes with some test questions in between to create a course.</p>
                                <p class="sub_slide3_txt">Teach how you desire.</p>
                                <p>Your course could be a long complete course of whole subject like Physics for CBSE Class 12th, History for UPSC(mains) or It could be a chapter of a particular Subject like Electromagnetism for CBSE Class 12th, Indian independence movement for UPSC(mains). You being the teacher are an expert of knowing the need of the students and we respect that.</p>
                            </div>
                            <div class="col-sm-6 col-sm-6">
                                <img src="<?php echo base_url(); ?>public/images/1.png" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-12 slide3">
                            <div class="col-sm-6 col-sm-6">
                                <h4>Create courses in your style & language</h4>
                                <p>Make your lecture’s videos in Hindi, any other Indian Language or with a mix of English. Teach in the language, you have always taught in conventional classes.</p>
                                <p>You may choose either to record your lectures, teaching on Board the conventional way or You may record them on your laptop with a screen recorder software (Oh Yes , we can guide you on that too).</p>
                            </div>
                            <div class="col-sm-6 col-sm-6">
                                <img src="<?php echo base_url(); ?>public/images/2.png" width="100%">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-12 slide3">
                            <div class="col-sm-6 col-sm-6">
                                <h4>Share your knowledge and start earning</h4>
                                <p>After we review the Audio-Video quality of your lectures, we will publish your course. Your courses and their statistics like Your Published Courses, Students enrolled in the courses, Total Money earned by the your courses, Your total earnings, Your student interaction with you and how they are receiving your course, etc.</p>
                                <p>Now you do not need to teach the same thing to students, each day over and over.</p>
                            </div>
                            <div class="col-sm-6">
                                <img src="<?php echo base_url(); ?>public/images/3.png" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="accordion-demo-11 ">
        <div class="container">
            <h1 id="teaching-content-title3">How it works</h1>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <span class="step-circle">1</span>Choose your topic
                </a>
                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <p class="slide3_sub_head">Share your knowledge</p>
                                    <p>Teach what you know, or teach what you love. You can create a course on almost anything.Millions of students are waiting, eager to learn and we’re here to help you make it happen</p>
                                    <p>We have multiple formats you can use to create your course. Teach in the style that makes sense for your topic and personality</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <span class="step-circle">2</span>   Create Course
                </a>
                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <!-- <h4>Create Course</h4> -->
                                    <p class="slide3_sub_head">Share your knowledge</p>
                                    <p>Teach what you know, or teach what you love. You can create a course on almost anything.Millions of students are waiting, eager to learn and we’re here to help you make it happen</p>
                                    <p>We have multiple formats you can use to create your course. Teach in the style that makes sense for your topic and personality</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <span class="step-circle">3</span> Teach what you love
                  </a>
                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p class="slide3_sub_head">Teach what you know, or teach what you love</p>
                                    <p>You can create a course on almost anything. Millions of students are waiting, eager to learn and we’re here to help you make it happen</p>
                                    <p>We have multiple formats you can use to create your course. Teach in the style that makes sense for your topic and personality</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="teaching-expand" style="display:none;">
        <div class="container">
            <div class="col-sm-12">
                <h1 id="teaching-content-title3">Expand your reach</h1>
                <p id="teaching-expand-para">We've changed lives by connecting instructors with students around the India.</p>
                <div class="col-sm-4 col-sm-8">
                    <div class="expan-box">
                        <div class="yellow-color"></div>
                        <div class="expand-box-content">
                            <p class="expand-box-para">MyOnlineShiksha has given me the opportunity to reach a global audience for my classes that wouldn’t have been possible otherwise.</p>
                            <ul class="expand-listing">
                                <li><span class="expand-left-sec"><img src="<?php echo base_url(); ?>public/new_template/images/ex1.jpg"></span></li>
                                <li><span class="expand-right-sec"><h6><b>Sana Quzi</b></h6><p><small>Watercolorist</small></p><p><small>1,124 students</small></p><p><small>87 countries</small></p></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-8">
                    <div class="expan-box2">
                        <div class="yellow-purple"></div>
                        <div class="expand-box-content">
                            <p class="expand-box-para">MyOnlineShiksha has given me the opportunity to reach a global audience for my classes that wouldn’t have been possible otherwise.</p>
                            <ul class="expand-listing">
                                <li><span class="expand-left-sec"><img src="<?php echo base_url(); ?>public/new_template/images/ex2.jpg"></span></li>
                                <li><span class="expand-right-sec"><h6><b>Rituraj Chauhan</b></h6><p><small>Developer and Bootcamp </small></p><p><small>Instructor</small></p><p><small>120,045 students</small></p><p><small>197 countries</small></p></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-8">
                    <div class="expan-box">
                        <div class="yellow-cyan"></div>
                        <div class="expand-box-content">
                            <p class="expand-box-para">MyOnlineShiksha has given me the opportunity to reach a global audience for my classes that wouldn’t have been possible otherwise.</p>
                            <ul class="expand-listing">
                                <li><span class="expand-left-sec"><img src="<?php echo base_url(); ?>public/new_template/images/ex3.jpg"></span></li>
                                <li><span class="expand-right-sec"><h6><b>Tanmay Yadao</b></h6><p><small>Engineering Architect</small></p><p><small>84,088 students</small></p><p><small>187 countries</small></p></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="responsive-box123">
        <div class="container responsive-box">
            <h1 id="teaching-content-title3">Expand your reach</h1>
            <p id="teaching-expand-para">We've changed lives by connecting instructors with students around the world.</p>
            <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel1" data-slide-to="1"></li>
                    <li data-target="#myCarousel1" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-sm-4 col-sm-12 no-padding">
                            <div class="expan-box">
                                <div class="yellow-color"></div>
                                <div class="expand-box-content">
                                    <p class="expand-box-para">MyOnlineShiksha has given me the opportunity to reach a global audience for my classes that wouldn’t have been possible otherwise.</p>
                                    <ul class="expand-listing">
                                        <li><span class="expand-left-sec"><img src="<?php echo base_url(); ?>public/new_template/images/jyoti.jpg"></span></li>
                                        <li><span class="expand-right-sec"><h6><b>Jyoti Sorte</b></h6><p><small>Software Professional</small></p></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-4 col-sm-12 no-padding">
                            <div class="expan-box2">
                                <div class="yellow-purple"></div>
                                <div class="expand-box-content">
                                    <p class="expand-box-para">MyOnlineShiksha has given me the opportunity to reach a global audience for my classes that wouldn’t have been possible otherwise.</p>
                                    <ul class="expand-listing">
                                        <li><span class="expand-left-sec"><img src="<?php echo base_url(); ?>public/new_template/images/img2.jpg"></span></li>
                                        <li><span class="expand-right-sec"><h6><b>Nilesh Barde</b></h6><p><small>Developer and Bootcamp </small></p><p><small>Instructor</small></p><p><small>689 students</small></p></p></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-4 col-sm-12 no-padding">
                            <div class="expan-box">
                                <div class="yellow-cyan"></div>
                                <div class="expand-box-content">
                                    <p class="expand-box-para">MyOnlineShiksha has given me the opportunity to reach a global audience for my classes that wouldn’t have been possible otherwise.</p>
                                    <ul class="expand-listing">
                                        <li><span class="expand-left-sec"><img src="<?php echo base_url(); ?>public/new_template/images/rajdeep.jpg"></span></li>
                                        <li><span class="expand-right-sec"><h6><b>Rajdeep Tayde</b></h6><p><small>Engineering Architect</small></p></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="help-section">
        <h1 id="teaching-content-title2" style="padding-top:48px;">We're here to help</h1>
        <div class="col-sm-12">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <p class="help-para">Our Instructional design experts will guide you through all the process of course creation. Our whatsapp groups with our chief Instructional designer as admin will guide you on sundry matters as well as daily tips on the Art of Instructional design.</p>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </section>
    <section class="last-portion teaching_lst_portion">
        <div class="col-sm-12">
            <h1 style="text-align:center;">Become a online teacher today</h1>
            <h3>Join the India's largest online learning marketplace.</h3>
            <div align="center">
                <a href="https://myonlineshiksha.com/category/teaching">
                    <button data-purpose="bai-cta-footer" type="button" class="cta sticky-hide btn btn-primary">Become a Teacher</button>
                </a>
            </div>
        </div>
    </section>
    <script>    
    function show_div(div,div1)
    {
        $("#"+div).css('display',"block");
        $("#"+div1).css('display',"none");
    }

    $("#slide1").hover(function() {
        var goto = Number($(this).attr('data-slide-to'));
        $("#myCarousel").carousel(goto);
    });

    $("#slide2").hover(function() {
        var goto = Number($(this).attr('data-slide-to'));
        $("#myCarousel").carousel(goto);
    });
    $("#slide3").hover(function() {
        var goto = Number($(this).attr('data-slide-to'));
        $("#myCarousel").carousel(goto);
    });
        // $('#mycarousel').carousel({
        //     interval: false
        // });
    function only_number(event) {
        var x = event.which || event.keyCode;
        console.log(x);
        if ((x >= 48) && (x <= 57) || x == 8 | x == 9 || x == 13) {
            return;
        } else {
            event.preventDefault();
        }
    }

    function check_error()
    {
        var first_name = $("#first_name").val().trim();
        var last_name = $("#last_name").val().trim();
        var contact_no = $("#contact_no").val().trim();
        var email = $("#email").val().trim();
        var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
        var password = $("#password").val().trim();
        var password_confirm = $("#password_confirm").val().trim();
        var teach = $("#teach").val().trim();
        var err_cpass = $("#err_cpass").html();
        
        if(first_name =='')
        {
            $("#err_name").fadeIn().html("Please enter First Name").css('color','red');
            $("#first_name").css("border-color","red");
            setTimeout(function(){$("#err_name").html("");$("#first_name").css("borderColor","#00A654")},3000);
            $("#first_name").focus();
            return false;
        }
        if(last_name =='')
        {
            $("#err_lname").fadeIn().html("Please enter Last Name").css('color','red');
            $("#last_name").css("border-color","red");
            setTimeout(function(){$("#err_lname").html("");$("#last_name").css("borderColor","#00A654")},3000);
            $("#last_name").focus();
            return false;
        }
        if(contact_no =='')
        {
            $("#err_contact").fadeIn().html("Please enter Contact No.").css('color','red');
            $("#contact_no").css("border-color","red");
            setTimeout(function(){$("#err_contact").html("");$("#contact_no").css("borderColor","#00A654")},3000);
            $("#contact_no").focus();
            return false;
        }
        if(contact_no.length<10)
        {
            $("#err_contact").fadeIn().html("Invalid Contact No.").css('color','red');
            $("#contact_no").css("border-color","red");
            setTimeout(function(){$("#err_contact").html("");$("#contact_no").css("borderColor","#00A654")},3000);
            $("#contact_no").focus();
            return false;
        }
        if(email =='')
        {
            $("#email_err").fadeIn().html("Please enter Email").css('color','red');
            $("#email").css("border-color","red");
            setTimeout(function(){$("#email_err").html("");$("#email").css("borderColor","#00A654")},3000);
            $("#email").focus();
            return false;
        }
        else if(!email_pattern.test(email))
        {
            $("#email_err").fadeIn().html("Invalid Email").css('color','red');
            $("#email").css("border-color","red");
            setTimeout(function(){$("#email_err").html("");$("#email").css("borderColor","#00A654")},3000);
            $("#email").focus();
            return false;
        }
        if(password =='')
        {
            $("#err_password").fadeIn().html("Please enter Password").css('color','red');
            $("#password").css("border-color","red");
            setTimeout(function(){$("#err_password").html("");$("#password").css("borderColor","#00A654")},3000);
            $("#password").focus();
            return false;
        }
        if(password_confirm =='')
        {
            $("#err_cpass").fadeIn().html("Please confirm password").css('color','red');
            $("#password_confirm").css("border-color","red");
            setTimeout(function(){$("#err_cpass").html("");$("#password_confirm").css("borderColor","#00A654")},3000);
            $("#password_confirm").focus();
            return false;
        }
        if(teach =='')
        {
            $("#err_teach").fadeIn().html("Please enter choice").css('color','red');
            $("#teach").css("border-color","red");
            setTimeout(function(){$("#err_teach").html("");$("#teach").css("borderColor","#00A654")},3000);
            $("#teach").focus();
            return false;
        }
        if(err_cpass =='Password not matched!')
        {
            $("#password_confirm").css("border-color","red");
            setTimeout(function(){$("#password_confirm").css("borderColor","#00A654")},3000);
            $("#password_confirm").focus();
            return false;
        }

        $("#please_waittt").css('display',"block");
        $("#btn_submit").css('display',"none");
        $.ajax({
                type: 'POST',
                cache: false,
                url: "<?php echo base_url();?>users/check_dup",
                data:{
                    email:email,
                    contact_no:contact_no,
                },
                success: function(data)
                {
                    if(data==1)
                    {
                        $("#please_waittt").css('display',"none");
                        $("#btn_submit").css('display',"block");
                        $("#email_err").fadeIn().html("Email already exists").css('color','red');
                        $("#email").css("border-color","red");
                        setTimeout(function(){$("#email_err").html("");$("#email").css("borderColor","#00A654")},3000);
                        $("#email").focus();
                        return false;
                    }
                    else if(data==2)
                    {
                        $("#please_waittt").css('display',"none");
                        $("#btn_submit").css('display',"block");
                        $("#err_contact").fadeIn().html("Mobile already exists").css('color','red');
                        $("#contact_no").css("border-color","red");
                        setTimeout(function(){$("#err_contact").html("");$("#contact_no").css("borderColor","#00A654")},3000);
                        $("#contact_no").focus();
                        return false;
                    }
                    else{
                        $("#msg_div").html("Please Wait we are redirecting you!");
                        $("#register").submit();
                    }
                }
        });
    }

    function check_equal(val)
    {
        var password = $("#password").val().trim();
        if(val !== password)
        {
            $("#err_cpass").html("Password not matched!").css('color','red');
            $("#password_confirm").css("border-color","red");
            $("#password_confirm").focus();
            return false;
        }
        else{
            $("#err_cpass").html("Password matched!").css('color','green');
            $("#password_confirm").css("border-color","green");
            $("#password_confirm").focus();
            return false;
        }
    }

    function set_login() {
        var email = $("#login_email").val();
        var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
        var password = $("#login_password").val();
        if (email=="")
        {
            $("#email_login_err").fadeIn().html("Please enter Email").css('color','red');
            $("#login_email").css("border-color","red");
            setTimeout(function(){$("#email_login_err").html("");$("#login_email").css("borderColor","#00A654")},3000);
            $("#login_email").focus();
            return false;
        }
        else if(!email_pattern.test(email))
        {
            $("#email_login_err").fadeIn().html("Invalid Email").css('color','red');
            $("#login_email").css("border-color","red");
            setTimeout(function(){$("#email_login_err").html("");$("#login_email").css("borderColor","#00A654")},3000);
            $("#login_email").focus();
            return false;
        }
        if (password=="")
        {
            $("#pass_err_login").fadeIn().html("Please enter Password").css('color','red');
            $("#login_password").css("border-color","red");
            setTimeout(function(){$("#pass_err_login").html("");$("#login_password").css("borderColor","#00A654")},3000);
            $("#login_password").focus();
            return false;
        }



        $("#login_wait").css('display',"block");
        $("#login_button").css('display',"none");
        // $("#studentLogin").attr('disabled',true);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>users/loginPopup",
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                //alert(response);
                if (response) {
                    window.location.replace(window.location.origin);
                } 
                else {
                    $("#login_wait").css('display',"none");
                    $("#login_button").css('display',"block");
                    $("#invalid_err").fadeIn().html("Invalid username and/or password").css('color','red');
                    setTimeout(function(){$("#invalid_err").html("");},3000);
                    $("#login_email").focus();
                    return false;
                }
            }
        });
    }
    </script>