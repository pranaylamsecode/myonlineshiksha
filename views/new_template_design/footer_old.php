<style>
  .fixed_w_btn {
    position: fixed;
    bottom: 90px;
    right: 15px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #34af23;
    text-align: center;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .fixed_w_btn i {
    color: #fff;
    font-size: 47px;
    background: transparent;
  }
  .eapp-whatsapp-chat-root-layout-component .Window__Component-sc-17wvysh-0.dodbP {
    bottom: 75px;
}
</style>

<footer class="container-fluid no-padding" style="border-bottom:9px solid #141d49;">
  <div class="col-sm-12  no-padding footer_main">
    <div class="col-sm-4 footer_list">
      <ul>
        <li class="footer_links"><a href="<?php echo base_url() ?>become-a-teacher">Teach with Us</a> </li>
        <li class="footer_links"><a href="<?php echo base_url() ?>become-a-reseller">Become a Reseller</a> </li>
        <?php $auth = $this->session->userdata('logged_in');
        if(!$auth){ ?>
        <li class="footer_links"><a href="#registration" rel="leanModal" class="open_overlay">Start Learning</a> </li>
      <?php } ?>
      </ul>
    </div>
    <div class="col-sm-4 footer_list">
      <ul>
        <li><a href="<?php echo base_url() ?>about">About Us </a></li>
        <li><a href="<?php echo base_url() ?>contact_us">Contact Us</a> </li>
        <li><a href="<?php echo base_url() ?>blog">Blog</a></li>
      </ul>
    </div>
    <div class="col-sm-4 footer_list ">
      <ul>
        <li><a href="<?php echo base_url() ?>terms-of-use">Terms of Use</a></li>
        <li><a href="<?php echo base_url() ?>privacy-policy">Privacy Policy</a> </li>
      </ul>
    </div>
    <?php 
$tablet_browser = 0;
$mobile_browser = 0;
 
if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
}
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
}
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
} 
?>
<a target="_blank" data-toggle="tooltip" title="Whatsapp Chat" class="fixed_w_btn" 
<?php if ($tablet_browser > 0 || $mobile_browser > 0) {
   // do something for tablet devices
    echo ' href="https://api.whatsapp.com/send?phone=919960912357&text=Dear%20MyOnlineShiksha%2C%0ARequest%20to%20connect."';
}
else {
   // do something for everything else
   echo ' href="https://web.whatsapp.com/send?phone=919960912357&text=Dear%20MyOnlineShiksha%2C%0ARequest%20to%20connect."';
}
?> >
    <i class="fa fa-whatsapp"></i> </a>
  <section class="">
    <div class="">
      <div class="col-sm-12  no-padding bottom_text">
        <div class="col-sm-12 footer_text1">
          <div style="float:left;">
            <a href="https://myonlineshiksha.com/">
            <img alt="Udemy" class="udemy-logo" src="<?php echo base_url(); ?>public/images/MyOnlineShiksha-logo.svg" width="110"></a>
            
          </div>
          <div>
            <p class="copy_right_text"> © MyOnlineShiksha™. All Rights Reserved.   Powered by <a href="https://www.createonlineacademy.com" rel="nofollow" style="color:while">CreateOnlineAcademy™</a></p>
          </div>
        </div>
      </div>
     </div>
    </section>
  </div>
</footer>

  <script type="text/javascript" src="<?php echo base_url() ?>public/new_template/js/jquery.leanModal.min.js"></script>
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 -->  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>public/js/fastclick/lib/fastclick.js"></script>  -->
  <script type="text/javascript" src="<?php echo base_url(); ?>public/new_template/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
<script>
  $(document).on('click', '#go', function() {
        closeNav();
    });
    var $ = jQuery.noConflict();
    $(function() {
        $('a[rel*=leanModal]').leanModal({
            closeButton: ".modal_close"
        });
    });

    $(document).ready(function() {
        $("#signup").leanModal();
    });
    $(document).ready(function() {
        $("#signup").leanModal({
            top: 200,
            overlay: 0.4,
            closeButton: ".modal_close"
        });
    });
    $(function() {
        $('#banner_menu li').on('click', function() {
            $(this).parent().find('li.active').removeClass('active');
            $(this).addClass('active');
        });
    });
    $(function() {
        $('.add_overlay').on('click', function() {
            $('.res_overlay').css("display", "block");

        });

    });
    $(function() {
        $('.close_popup').on('click', function() {
            $('.res_overlay').css("display", "none");
            $("#studentForm").css("display","none");
             $("#registerPopup").css("display","none");
            $("#forgetForm").css("display","none");

            $("body").removeClass("body_overflow_imp");
        });
    });

      jQuery(document).ready(function() {     
        $("a").on("click tap touchstart", function(){
           var signin = jQuery(this).attr("href");
        if (signin == "#signup") {
          $("#studentForm, #signup").css("display","block");
          $("body").addClass("body_overflow_imp");
        }
      });
        $("a").on("click tap touchstart", function(){
        var signup = jQuery(this).attr("href");
        if (signup == "#registration") {
          $("#registerPopup, #registration").css("display","block");
          $("body").addClass("body_overflow_imp");
          $("#studentForm").css("display","none");
        }
      });
        $("a").on("click tap touchstart", function(){
        var forgot = jQuery(this).attr("href");
        if (forgot == "#forget") {
          $("#forgetForm").css("display","block");
          $("body").addClass("body_overflow_imp");
        }
      });
         
        if (!passwordPopup==""){
             $(".pass_label").css("display","block");
        }
        $("#passwordPopup").on("click tap touchstart", function(){
          $(".pass_label").css("display","block");
          $("#registration #passwordPopup").addClass("add_pad_top");
        });
       
        $("#passwordPopup").on('input', function(){
            var passwordPopup = $("#passwordPopup").val().trim();
            if (passwordPopup==""){
              $(document).mouseup(function(e) 
              {
                  var container = $("#passwordPopup");
                    if (!container.is(e.target) && container.has(e.target).length === 0) 
                    {
                         $(".pass_label").css("display","none");
                         $("#registration #passwordPopup").removeClass("add_pad_top");
                    }
              });
               $(".pass_label").css("display","none");
               $("#registration #passwordPopup").removeClass("add_pad_top");
            }
            else if(!passwordPopup==""){
              $(document).mouseup(function(e) 
              {
                  var container = $("#passwordPopup");
                    if (!container.is(e.target) && container.has(e.target).length === 0) 
                    {
                         $(".pass_label").css("display","block");
                    }
              });
             $(".pass_label").css("display","block");
            }
        });
      });
      
      function validation()
      {
        var first_namePopup = $("#first_namePopup").val().trim();
        var emailPopup = $("#emailPopup").val().trim();
        var passwordPopup = $("#passwordPopup").val().trim();
        var dup_redeem1 = $("#dup_redeem1").val().trim();
        if (first_namePopup=="")
        {
          $("#err_fname").css("visibility","visible");
          $("#err_fname").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter first name").css('color','red');
          setTimeout(function(){$("#err_fname").html("&nbsp;");},2000);
          setTimeout(function(){$("#err_fname").css("visibility","hidden");},2000);
           
          $("#first_namePopup").focus();
          return false;
        }
        
        if (emailPopup=="")
        {
          $("#err_email").css("visibility","visible");
          $("#err_email").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter email").css('color','red');
          setTimeout(function(){$("#err_email").html("&nbsp;");},2000);
           setTimeout(function(){$("#err_email").css("visibility","hidden");},2000);
          $("#emailPopup").focus();
          return false;
        }
        if (passwordPopup=="")
        {
          $("#err_pass").css("visibility","visible");
          $("#err_pass").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter password").css('color','red');
          setTimeout(function(){$("#err_pass").html("&nbsp;");},2000);
           setTimeout(function(){$("#err_pass").css("visibility","hidden");},2000);
          $("#passwordPopup").focus();
          return false;
        }
        else if(passwordPopup.length<6)
        {
          $("#err_pass").css("visibility","visible");
          $("#err_pass").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Password atleast 6 characters").css('color','red');
          setTimeout(function(){$("#err_pass").html("&nbsp;");},2000);
           setTimeout(function(){$("#err_pass").css("visibility","hidden");},2000);
          $("#passwordPopup").focus();
          return false;
        } 
        
        var err_email =$("#err_email").html();
        var err_confirm =$("#err_confirm").html();
        if (err_email=="already exists")
        {
          $("#emailPopup").focus();
          $("#emailPopup").css('border-color','red');
          return false;
        }
        if (err_confirm=="password not matched")
        {
          $("#password_confirmPopup").focus();
          return false;
        }
          $("#please_waitR").css("display","block");
          $("#btn_register").attr('disabled',true);
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url();?>users/registrationPopup",
                    cache:false,
                    data: {
                      firstname : first_namePopup,
                      
                      email : emailPopup,
                      password : passwordPopup,
                      dup_redeem1 : dup_redeem1
                      // password_confirm : password_confirmPopup
                    },
                    success: function(response) {
                        if (response == 'success')
                        {

                            $('#registration').css({
                                "display": "none"
                            });

                            $('#lean_overlay').css({
                                                    "display": "none"
                                                });
                            var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>Your account has been created successfully.</div>';
                            // var note = $(document).find('#message');
                            $('#message').html(str);
                            $('#message').show();
                            $('#message').fadeIn().delay(3000).fadeOut();
                            window.location.href = "<?php echo base_url();?>category/courses";
                        }
                        else if (response == 'Failed')
                        {
                          $("#err_email").html('Email already exists');
                          $("#err_email").css('visibility','visible');
                          // $('#err_email').fadeIn().delay(2000).fadeOut();
                          $("#please_waitR").css("display","none");
                          $("#btn_register").attr('disabled',false);
                        }
                        else{
                          $('#registration').css({
                                "display": "none"
                          });

                          $('#lean_overlay').css({
                                              "display": "none"
                          });
                          var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>Your account has been created successfully.</div>';
                            // var note = $(document).find('#message');
                          $('#message').html(str);
                          $('#message').show();
                          $('#message').fadeIn().delay(3000).fadeOut();
                          window.location.href = response;
                        }
                      }
                    });
      }

      function checkdup(email)
      {
        $.ajax({
              type:"post",
              cache:false,
              url:"<?php echo base_url();?>users/check_dup",
              data:{
                email:email
              },
              success:function(returndata)
              {
                if(returndata==0)
                {
                  $("#err_email").html("already exists").css('color','red');
                  $("#emailPopup").css("border-color",'red');
                  $("#err_email").css('visibility','visible');
                  return false;
                }
                else
                {
                  $("#err_email").html("available").css('color','green');
                  $("#emailPopup").css("border-color",'');
                }
              }
        });
      }
    </script>
    <script>
        function loginUser() {
            var email = $("#email1").val();
            var password = $("#password1").val();
            var dup_redeem = $("#dup_redeem").val();
            if (email=="")
            {
                $("#log_err_mail").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter username or email").css('color','red');
              setTimeout(function(){$("#log_err_mail").html("&nbsp;");},2000);
               $("#log_err_mail").css("visibility","visible");
            
            setTimeout(function(){$("#log_err_mail").css("visibility","hidden");},2000);
              $("#email1").focus();
              return false;
            }
            if (password=="")
            {
               $("#log_err_pass").css("visibility","visible");
               $("#log_err_pass").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter password").css('color','red');
              setTimeout(function(){$("#messageStudent").html("&nbsp;");},2000);
              setTimeout(function(){$("#log_err_pass").css("visibility","hidden");},2000);
              $("#password1").focus();
              return false;
            }

            $("#please_wait").css("display","block");
            $("#studentLogin").attr('disabled',true);
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/loginPopup",
                data: {
                    email: email,
                    password: password,
                    dup_redeem : dup_redeem
                },
                success: function(response) {
                    //alert(response);
                    if (response == 'success') {
                        $('.close_popup').click();
                        $("#studentLogin").attr('disabled',false);
                        window.location.replace(window.location.origin + '/index/index');
                    } else if (response == 'success123') {
                        $('.close_popup').click();
                        window.location.replace(window.location.href);
                    } else if (response) {
                        $('.close_popup').click();
                        window.location.replace(response);
                    } else {
                      $("#studentLogin").attr('disabled',false);
                        $("#messageStudent").html('<p class="invalid_error">Please check your email and password.</p>');
                        // setTimeout(function(){$("#messageStudent").html("&nbsp;");},2000);
                        $("#password1").focus();
                        $("#please_wait").css("display","none");
                    }
                }
            });
        }
        function forgetPassword() {
            var emailForget = $("#emailForget").val();
            if (emailForget=="")
              {
                $("#for_err_email").css("visibility","visible");
                $("#for_err_email").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter email").css('color','red');
                setTimeout(function(){$("#for_err_email").html("&nbsp;");},2000);
                 setTimeout(function(){$("#for_err_email").css("visibility","hidden");},2000);
                $("#emailPopup").focus();
                return false;
              }
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/forgetPasswordPopup",
                data: {
                    emailForget: emailForget
                },
                success: function(response) {
                    if (response == 'success') {
                        $("#forget-ct").slideUp('slow', function() {
                            $("#msgForget").html('<p style="color:green; text-align:center;"><h2>Reset password link has been sent to your email.</h2></p>');
                        });
                        setTimeout(
                            function() {
                                //do something special
                                window.location.replace(window.location.origin);
                            }, 3000);
                    } else {
                        $("#emailForget").val('');
                        $("#messageForget").html('<p class="invalid_error">Email Id is not available in the records.</p>');
                    }
                }

            });
        }
        function viewsite() {
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/view_frontsite",
                //data: {menuname:menuname,path:path}, 
                success: function(data) {
                    window.location = '<?php echo base_url(); ?>admin';

                }
            });
        }
    </script>
    <script>
        function markread() {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>notification/getUnreadNotific",
                success: function(data) {

                    $("#notification ul>li strong").css('color', '#939496');
                    $("#notification ul>li strong").css('font', 'inherit');
                    $(".badge-info").html('0');
                    $("#newnotify").html('0');
                }
            });

        }
    </script>
    <script>
        function closeLogin() {
            $('#signup, #studentForm').css({
                "display": "none"
            });
             // $("body").css("overflow","visible");
             $("body").removeClass("body_overflow2");
        }


        function closeRegi() {
          $('#registration, #registerPopup').css({
                "display": "none"
            });
           // $("body").css("overflow","visible");
           $("body").removeClass("body_overflow2");
        }

        function closeForget() {
          $('#forget, #forgetForm').css({
                "display": "none"
            });
           // $("body").css("overflow","visible");
           $("body").removeClass("body_overflow2");
        }
    </script>
    <script type="text/javascript">
        $('ul li.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery("#search_icon1").click(function() {
                jQuery(".toggle_searchbar").toggle();

            });
            jQuery('body').click(function(evt) {
                if (!jQuery(evt.target).is('#search_icon1') && !jQuery(evt.target).is('.toggle_searchbar input')) {
                    jQuery(".toggle_searchbar").hide();
                };
            });

        });
        $(document).on('keyup', '#getlistitem1', function() {
            var input = $('#getlistitem1').val();

            $.ajax({

                url: "<?php echo base_url();?>category/getlist",
                type: "POST",
                data: {
                    input: input
                },
                success: function(data) {
                    if (data) {
                        $('#getitemlist1').show();
                        $('#getitemlist1').html(data);
                    } else {
                        $('#getitemlist1').hide();
                        $('#getitemlist1').html();
                    }
                },
                error: function(xhr, desc, err) {
                    console.log(xhr);
                },
            });
        });

        $("#mySidenav2").on('click',"li.cat", function(){ 
             var courses = $(this).children("ul");
          $("#mySidenav6 ul").append(courses);
        });
        $(".sidenav").on('click',".close_sidemenu", function(){ 
             $(".sidenav").css("left","-280px");
              $('.res_overlay').css("display", "none");
        });
        $(".res-bars .res_bars_toggle, .profile_admt i.fa-angle-right, #mySidenav3 li:first-child a").on('click', function(){ 
            $('.res_overlay').css("display", "block");
            $('body').addClass("body_overflow");
  
        });
        $(document).mouseup(function(e) 
          {
              var container = $(".sidenav");
              var container2 = $(".lnr-menu");
              var container3 = $(".btnsignup");
              // if the target of the click isn't the container nor a descendant of the container
              if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0 && !container3.is(e.target) && container3.has(e.target).length === 0) 
              {
                  container.css("left","-280px");
                   $('.res_overlay').css("display", "none");
                   $('body').removeClass("body_overflow");
                   

              }
          });
      if($(window).width() > 992 ){
        $(document).mouseup(function(e) 
          {
              var container = $("#signup, #forget, #registration");
              var container2 = $(".btnlogin, .btn-signup");
              // if the target of the click isn't the container nor a descendant of the container
              if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0) 
              {
                  // container.hide();
                  $('body').removeClass("body_overflow_imp");
                  $("#registerPopup, #forgetForm, #studentForm").css("display", "none");
                   $('#lean_overlay').css("display", "none");
                   

              }
          });
      }
        $(document).mouseup(function(e) 
          {
              var container = $(".header_search");
              if (!container.is(e.target) && container.has(e.target).length === 0) 
              {
                  $("ul#getitemlist1").hide();
              }
          });
        $(document).mouseup(function(e) 
          {
              var container = $(".bannar_search");
              if (!container.is(e.target) && container.has(e.target).length === 0) 
              {
                  $("ul#getitemlist").hide();
              }
          });
       
    </script>
    <script>
        // For Registration
        $(function() {
            var action = '';
            var form_data = '';
            $('#submitPopup').click(function() {
                action = $("#registerPopup").attr("action");
                form_data = {
                    firstname: $("#first_namePopup").val(),
                    lastname: $("#last_namePopup").val(),
                    email: $("#emailPopup").val(),
                    password: $("#passwordPopup").val(),
                    password_confirm: $("#password_confirmPopup").val(),
                };
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: form_data,
                    success: function(response) {
                        //alert(response);
                        if (response == 'success') {
                            $("#signup-ct").slideUp('slow', function() {
                                $("#registration").html('<p style="color:green; text-align:center;"><h2>Please Check your Email.</h2></p>');
                            });

                            setTimeout(
                                function() {
                                    var base_url = window.location.origin;
                                    window.location.replace(base_url);
                                }, 5000);
                        } else if (response == 'Password and confirm password is not equal...') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Password and confirm password is not equal...</b></p></div>');
                        } else if (response == 'Please fill proper data...') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Please fill proper data...</b></p></div>');
                        } else if (response == 'Email Already Exist.') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Email Already Exist.</b></p></div>');
                        } else if (response == 'Password atleast 6 digits') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Password atleast 6 digits</b></p></div>');
                        }
                    }
                });
                return false;
            });
        });
    </script>
 <script>
  $(document).ready(function() {
    $('.tooltip').tooltipster();
  });

 jQuery(document).ready(function() {
    if (jQuery(window).width() < 768) {
      var discount_bar_fixed_res = 65; 
      jQuery(window).scroll(function() {                  // assign scroll event listener
          var discount_barcurrentScroll = jQuery(window).scrollTop(); // get current position
          if (discount_barcurrentScroll > discount_bar_fixed_res) {
              jQuery('#section-sidenavbar-responsive').css({                      // scroll to that element or below it
                  position: 'fixed',
                  top: '0px',
                  'margin-top': '64px'
              });
               jQuery('#section-sidenavbar-responsive .toggle_searchbar').css({                      // scroll to that element or below it
                  display: 'block'
              });
          } else {                                   // apply position: static
              jQuery('#section-sidenavbar-responsive').css({                      // if you scroll above it
                  position: 'unset',
                  top: '0',
                  'margin-top': '0px'
              });
              jQuery('#section-sidenavbar-responsive .toggle_searchbar').css({                      // scroll to that element or below it
                  display: 'none'
              });
          };
        });
    }if (jQuery(window).width() < 991 && jQuery(window).width() > 767) {
      var discount_bar_fixed_res = 40; 
      jQuery(window).scroll(function() {                  // assign scroll event listener
          var discount_barcurrentScroll = jQuery(window).scrollTop(); // get current position
          if (discount_barcurrentScroll > discount_bar_fixed_res) {
              jQuery('#section-sidenavbar-responsive').css({                      // scroll to that element or below it
                  position: 'fixed',
                  top: '0px',
                  'margin-top': '0px'
              });
               jQuery('#section-sidenavbar-responsive .toggle_searchbar').css({                      // scroll to that element or below it
                  display: 'block'
              });
          } else {                                   // apply position: static
              jQuery('#section-sidenavbar-responsive').css({                      // if you scroll above it
                  position: 'unset',
                  top: '0',
                  'margin-top': '0px'
              });
              jQuery('#section-sidenavbar-responsive .toggle_searchbar').css({                      // scroll to that element or below it
                  display: 'none'
              });
          };
        });
    }
    if (jQuery(window).width() > 991) {
      var discount_bar_height = jQuery('.discount_bar').outerHeight();
      
      jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 100){
          jQuery('.discount_bar').addClass("fix_discount");
          jQuery('.topnavbar').addClass("fix_header");
          jQuery('.fix_header').css("top",'42px');
        }
        else{
        jQuery('.discount_bar').removeClass("fix_discount");
        jQuery('.topnavbar').removeClass("fix_header");
        jQuery('.topnavbar').css("top","0px");
        }
      });
    }
  });

</script>

<script>
$(document).ready(function () {
    $('body').click(function() {
        $(".displayToggle").hide('fast');   
    });
    $(".open_overlay").click(function(){
      $("#lean_overlay").css("display","block");
    });
});

  $(document).ready(function () {
    $('#userToggle').click(function(evt) {
        $(".displayToggle").toggle('fast');
    evt.stopPropagation();
    });

    <?php
        if($this->input->get('eml'))
        {
        $first1 = $this->login_model->first_time_login_main($this->input->get('eml'));
        if($first1->group_id == 4 && $first1->first_time_login == '0')
      {
          ?>
          $(document).ready(function(){     
            $("#first_time").click();
        }); 
        <?php
      }
    }
  ?>    
});

  function mySearch() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {

    var input, filter, ul, li, a, i;
    input = document.getElementById("searchtext");
    filter = input.value.toUpperCase();
    // alert(filter);
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}
</script>
<script async>
(function(s,u,m,o,j,v){
  j=u.createElement(m);
  v=u.getElementsByTagName(m)[0];
  j.async=1;
  j.src=o;
  j.dataset.sumoSiteId='928b64ac204f9ecdedb7d267c9363ae2224f4884d16b1315038bdb904a13c1ae';
  v.parentNode.insertBefore(j,v)
})
(window,document,'script','//load.sumo.com/');
</script>

<!-- <script type="text/javascript" src="https://myonlineshiksha.com/firebase-messaging-sw.js"></script> -->
<script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js"></script>
<script type="text/javascript"> 
var subscribersSiteId = '84440be7-1538-4374-adcd-362fd5c84f8c';
</script>
<script src="https://my.hellobar.com/c9a914160b59ee0a58dc6ea8904b978802440fab.js" type="text/javascript" charset="utf-8" async="async"></script>
</body>
</html>