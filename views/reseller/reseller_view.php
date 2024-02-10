<style>
    .excetional-content1{
        width: 100%;
        padding-bottom: 30px;
        text-align: center;
    }
    #message {
   position: fixed;
right: 0;
/*float: right;*/
clear: both;
margin: 0 auto;
font-size: 20px;
top: 50%;
z-index: 9999;
text-align: center;
left: 0;
width: 650px;
max-width: 100%;
transform: translateY(-50%);
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
@media (max-width: 880px){
    .banner-section-teaching .section-text p.subtext {
        margin: 15px 0px 0px 0px;
    }
}
</style>
<?php
    $msg = $this->session->userdata('reg_msg');
if(!empty($msg)){ ?>
    <span id="message">
    </span>
    <!-- <div id="lean_overlay" class="res_overlay" style="display: none; opacity: 0.4;"></div> -->
    <script type="text/javascript">
        var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close" onclick="return close_over()"><i class="fa fa-times" aria-hidden="true"></i></a><img src="<?php echo base_url();?>public/uploads/images/checked.png" style="width:80px; height:85px; padding-bottom:10px;"><br> Thanks for your Interest in selling our online course products.<br>We will contact you back in your email id within 72 Hours.</div>';
                var note = $(document).find('#message');
                note.html(str);
                note.show();
                note.fadeIn().delay(10000).fadeOut();
                // $("#lean_overlay").css('display','block');
                $("#lean_overlay").fadeIn().delay(5000).fadeOut();
                // window.location.href = "<?php echo base_url();?>partner/coupons";
        function close_over()
        {
        	$("#lean_overlay").css('display','none');
        }
    </script>
<?php }
$this->session->unset_userdata('reg_msg');
?>

<!-- /public/uploads/images/checked.png -->
<div class="reseller_page">
    <div class="container-fluid banner-section-teaching" style="background-image: url('https://myonlineshiksha.com/public/uploads/images/become-a-reseller-myonlineshiksha.jpg') !important;">
        <nav class="navbar visible-lg visible-md visible-sm" id="banner_menu">
            <div class="container">
                <ul class="nav navbar-nav upper-menu">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li><a href="<?php echo base_url();?>about">About Us</a></li>
                    <li><a href="<?php echo base_url();?>category/courses">Course</a></li>
                    <li><a href="<?php echo base_url();?>blog">Blog</a></li>
                    <!-- <li class="active"><a href="<?php echo base_url();?>become-a-partner">Partner</a></li> -->
                </ul>
            </div>
        </nav>
        <div class="container second_section" id="home">
            <div class="col-md-8 col-sm-7 section-text">
                <h2 class="teaching-title">Become a Reseller of Online Courses</h2>
                <p class="subtext">Do you own a coaching class, Stationary/Book Shop or any other Enterprise, which interacts with the Students? If yes, you can showcase and sell our online courses and earn a commission of up to 20%.</p>
            </div>
            <div class="col-md-4 col-sm-5 col-xs-12 rightbox rightbox1">
                <div class="content">
                    <div class="innercontent" <?php if($this->session->userdata('logged_in')){ echo 'style="display:none"';}?>>
                        <div class="innersect">
                            <section class="container courses">
                                <div class="row-fluid ">
                                    <div class="fullcontent">
                                        
                                        <div class="login-box-container" id="div_login" style="display:none">
                                            <!-- <div class="titleholder"> -->
                                                <center><span id="invalid_err"></span></center>
                                            <!-- </div> -->
                                            <form action="<?php echo base_url();?>reseller/loginPopup/" method="post">
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
                                                        <input id="login_button" type="button" onclick="return set_login()" class="beditform" value="Login">
                                                        <input type="submit" style="display: none" id="submit_btn">
                                                        <div id="login_wait" class="form-group" style="display: none; text-align: center; padding-top: 3px;">
                                                            <img src="<?php echo base_url();?>/public/images/loading.gif" style="height: 30px !important; width: 30px !important">
                                                            <span id="msg_div">Please Wait</span>
                                                        </div>
                                                        <div class="login_sect">
                                                            <span style="margin-bottom:6px;display: block;">or</span>
                                                            <a href="#" type="button" onclick="return show_div('div_registration','div_login')" style="font-size: 17px;">Join Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                       
                                        <div id="div_registration">
                                        <div class="titleholder">
                                            <center><h5>Join our reseller program</h5></center>
                                        </div>
                                        <div class="login-box-container">
                                            <form action="<?php echo base_url();?>reseller/registration/" method="post">
                                            <div id="login-form-wrapper-cont" class="cell">
                                                <div class="admintable">
                                                    <div>
                                                        <input id="first_name" type="text" name="first_name" value="<?php echo $first_name; ?>" placeholder="First Name">
                                                        <span class="error" id="name_err"></span>
                                                    </div>
                                                    <div>
                                                        <input id="last_name" type="text" name="last_name" value="<?php echo $last_name;?>" placeholder="Last Name">
                                                        <span class="error" id="err_lname"></span>
                                                    </div>
                                                    <div>
                                                        <input id="contact_no" type="text" name="contact_no" value="<?php echo $contact_no;?>" placeholder="Contact No." onkeypress="return only_number(event)" autocomplete="off" maxlength="12">
                                                        <span class="error" id="contact_err"></span>
                                                    </div>
                                                    <div>
                                                        <input id="email" type="text" name="email" value="<?php echo $email;?>" placeholder="Email">
                                                        <span class="error" id="email_err"></span>
                                                    </div>
                                                    <div>
                                                        <input id="password" type="password" name="password" autocomplete="off" value="" placeholder="Password">
                                                        <span class="error" id="pass_err"></span>
                                                    </div>
                                                    <div class="agree_to_terms_sec">
                                                        <label style="font-weight: normal"><input type="checkbox" name="terms_of_use" id="terms_of_use" checked=""><span> I agree to MyOnlineShiksha Reseller's <a href="<?php echo base_url();?>resellers-terms-of-use">Terms of Use</a><!--   and <a href="<?php echo base_url() ?>privacy-policy">privacy policy</a>  --></span></label>
                                                    </div>
                                                    <div class="sub_btn">
                                                        <input type="button" id="btn_submit" class="beditform" value="Join Now" onclick="return check_error()">
                                                        <input type="submit" id="register_btn" style="display: none">
                                                        <div id="please_waittt" class="form-group" style="display: none; text-align: center; padding-top: 3px;">
                                                            <img src="<?php echo base_url();?>/public/images/loading.gif" style="height: 30px !important; width: 30px !important">
                                                            <span id="msg_div">Please Wait</span>
                                                        </div>
                                                        <div class="login_sect">
                                                            <span style="margin-bottom:6px;display: block;">or</span>
                                                            <a href="#" type="button" onclick="return show_div('div_login','div_registration')" style="font-size: 17px;">Login</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container discover">
        <div class="col-sm-12 teaching-content-section">
            <h1 id="teaching-content-title">Increase Your Income</h1>
            <div class="col-sm-4 teching-content">
                <h5><i class="fa fa-bank fa-2x"></i></h5>
                <h3>Promote Courses</h3>
                <p>Promote and Sell hundreds of our popular courses among students, online or offline.</p>
            </div>
            <div class="col-sm-4 teching-content">
                <h5><i class="fa fa-caret-square-o-right fa-2x"></i></h5>
                <h3>Sell Courses</h3>
                <p>Take payment digitally or in cash from the students for the courses.</p>
            </div>
            <div class="col-sm-4 teching-content">
                <h5><i class="fa fa-thumbs-up fa-2x"></i></h5>
                <h3>Earn Money</h3>
                <p>Earn upto 15% commission on every sale of online courses.</p>
            </div>
        </div>
    </div>
    <section class="" style="background-color: #4E4E4E; color: white">
        <div class="container">
            <h1 id="teaching-content-title2">How to Make Money</h1>
            <div class="col-md-12 excetional-content1">
                <h4>1.</h4>
                <h3>Choose from hundreds of courses!</h3>
                <p>As a MyOnlineShiksha Reseller Partner, you have access to hundreds of courses related to competitive exams, schools and colleges taught in Indian languages.</p>
            </div>
            <div class="col-md-12 excetional-content1">
                <h4>2.</h4>
                <h3>Use your MyOnlineShiksha reseller URL!</h3>
                <p>You will receive a Unique Reseller URL and QR Code to sell our courses and track your earnings. You may sell our courses both online or offline.</p>
            </div>
            <div class="col-md-12 excetional-content1">
                <h4>3.</h4>
                <h3>Promote on your Shop, website or social media</h3>
                <p>Share our courses by adding your tracking URL on your website or social media pages or just print and display your unique QR code in your shop premise.</p>
            </div>
            <div class="col-md-12 excetional-content1">
                <h4>4.</h4>
                <h3>Earn money for purchases!</h3>
                <p>The more you promote, the more money you will earn! Earn money for valid purchases through your affiliate tracking links and banners.</p>
            </div>
        </div>
    </section>
    
    <section class="last-portion teaching_lst_portion">
        <div class="col-sm-12">
            <h1 style="text-align:center;">Become a Reseller</h1>
            <h3>Join the India's largest online learning marketplace.</h3>
            <div align="center">
                <!-- <a href="#"> -->
                    <button onclick="return go_top();" data-purpose="bai-cta-footer" type="button" class="cta sticky-hide btn btn-primary">Become a Reseller</button>
                <!-- </a> -->
            </div>
        </div>
    </section>
</div>

<script>
   /* var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    else if(!email_pattern.test(login_email))
    {
        $("#email_login_err").fadeIn().html("Invalid Email").css('color','red');
        $("#login_email").css("border-color","red");
        setTimeout(function(){$("#email_login_err").html("");$("#login_email").css("borderColor","#00A654")},3000);
        $("#login_email").focus();
        return false;
    }*/
function set_login()
{
    var login_email = $("#login_email").val().trim();
    var login_password = $("#login_password").val().trim();
    if(login_email=="")
    {
        $("#email_login_err").fadeIn().html("Please enter Email").css('color','red');
        $("#login_email").css("border-color","red");
        setTimeout(function(){$("#email_login_err").html("");$("#login_email").css("borderColor","#00A654")},3000);
        $("#login_email").focus();
        return false;
    }
    
    if(login_password=="")
    {
        $("#pass_err_login").fadeIn().html("Please enter Password").css('color','red');
        $("#login_password").css("border-color","red");
        setTimeout(function(){$("#pass_err_login").html("");$("#login_password").css("borderColor","#00A654")},3000);
        $("#login_password").focus();
        return false;
    }

    $("#login_wait").css('display',"block");
    $("#login_button").css('display',"none");
    $.ajax({
            type : 'post',
            cache : false,
            url : "<?php echo base_url();?>reseller/validate1/",
            data : {
                email : login_email,
                password : login_password
            },
            success : function(response)
            {
                // alert(response);return false;
                if (response!=1)
                {
                    $("#login_wait").css('display',"none");
                    $("#login_button").css('display',"block");
                    $("#invalid_err").fadeIn().html("Invalid User and Password.").css('color','red');
                    $("#login_email").css("border-color","red");
                    setTimeout(function(){$("#invalid_err").html("");$("#login_email").css("borderColor","#00A654")},3000);
                    $("#login_email").focus();
                    return false;
                }
                else{
                    $("#submit_btn").click();
                }
            }
    });
}



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
    $('#mycarousel').carousel({
        interval: false
    });

    function go_top()
    {
        $("html,body").stop().animate( { scrollTop: 0 }, 1234, "swing" );
        $("#first_name").focus();
    }

    function check_error()
    {
        var first_name = $("#first_name").val().trim();
        var last_name = $("#last_name").val().trim();
        var contact_no = $("#contact_no").val().trim();
        var email = $("#email").val().trim();
        var password = $("#password").val().trim();
        
        if(first_name=="")
        {
            $("#name_err").fadeIn().html("Please enter First Name").css('color','red');
            $("#first_name").css("border-color","red");
            setTimeout(function(){$("#name_err").html("");$("#first_name").css("borderColor","#00A654")},3000);
            $("#first_name").focus();
            return false;
        }
        if(last_name=="")
        {
            $("#err_lname").fadeIn().html("Please enter Last Name").css('color','red');
            $("#last_name").css("border-color","red");
            setTimeout(function(){$("#err_lname").html("");$("#last_name").css("borderColor","#00A654")},3000);
            $("#last_name").focus();
            return false;
        }
        if(contact_no =="")
        {
            $("#contact_err").fadeIn().html("Please enter Mobile No.").css('color','red');
            $("#contact_no").css("border-color","red");
            setTimeout(function(){$("#contact_err").html("");$("#contact_no").css("borderColor","#00A654")},3000);
            $("#contact_no").focus();
            return false;
        }
        else if(contact_no.length < 10)
        {
            $("#contact_err").fadeIn().html("Invalid Mobile No.").css('color','red');
            $("#contact_no").css("border-color","red");
            setTimeout(function(){$("#contact_err").html("");$("#contact_no").css("borderColor","#00A654")},3000);
            $("#contact_no").focus();
            return false;
        }
        /*if(email =="")
        {
            $("#email_err").fadeIn().html("Please enter Email").css('color','red');
            $("#email").css("border-color","red");
            setTimeout(function(){$("#email_err").html("");$("#email").css("borderColor","#00A654")},3000);
            $("#email").focus();
            return false;
        }*/
        if(password =="")
        {
            $("#pass_err").fadeIn().html("Please enter Password").css('color','red');
            $("#password").css("border-color","red");
            setTimeout(function(){$("#pass_err").html("");$("#password").css("borderColor","#00A654")},3000);
            $("#password").focus();
            return false;
        }
        if(email == '')
        {
            email = 1;
        }
        $("#please_waittt").css('display',"block");
        $("#btn_submit").css('display',"none");
        $.ajax({
                type:'post',
                cache: false,
                url:"<?php echo base_url();?>reseller/email_exists/",
                data: {
                    email : email,
                    mobile : contact_no
                },
                success: function(response)
                {
                    if(response==1)
                    {
                        $("#please_waittt").css('display',"none");
                        $("#btn_submit").css('display',"block");
                        $("#email_err").fadeIn().html("Email already exists").css('color','red');
                        $("#email").css("border-color","red");
                        setTimeout(function(){$("#email_err").html("");$("#email").css("borderColor","#00A654")},3000);
                        $("#email").focus();
                        return false;
                    }
                    else if(response==2)
                    {
                        $("#please_waittt").css('display',"none");
                        $("#btn_submit").css('display',"block");
                        $("#contact_err").fadeIn().html("Mobile already exists").css('color','red');
                        $("#contact_no").css("border-color","red");
                        setTimeout(function(){$("#contact_err").html("");$("#contact_no").css("borderColor","#00A654")},3000);
                        $("#contact_no").focus();
                        return false;
                    }
                    else{
                        $("#msg_div").html("Please Wait we are redirecting you!");
                        $("#register_btn").click();
                    }
                }
        });
    }

function only_number(event) {
    var x = event.which || event.keyCode;
    console.log(x);
    if ((x >= 48) && (x <= 57) || x == 8 | x == 9 || x == 13) {
        return;
    } else {
        event.preventDefault();
    }
}
</script>