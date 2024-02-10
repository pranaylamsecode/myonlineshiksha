<style>
  .fixed_w_btn {
    position: fixed;
    bottom: 20px;
    right: 15px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #00a504;
    text-align: center;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .fixed_w_btn i {
    color: #fff;
    font-size: 35px !important;
    background: transparent;
  }
  .eapp-whatsapp-chat-root-layout-component .Window__Component-sc-17wvysh-0.dodbP {
    bottom: 75px;
}
.fixed_w_btn img{
	width: 100%;
}

footer.container-fluid {
    margin: 0px !important;
    padding: 25px 0px 0px 0px;
}
footer section {
    padding: 20px 0px 0px 0px !important;
    display: inline-block;
    width: 100%;
}
@media (max-width: 767px){
  .quick_links{
    padding: 0;
  }
  footer.container-fluid {
    margin: 0px !important;
    padding: 30px 0px 0px 0px;
}
  footer section {
    padding: 0px 0px 0px 0px !important;
}
  .quick_links .footer_list{
    margin-top: 15px;
  }
}
.quick_links .footer_list ul li:first-child{
  font-weight: bold;font-size: 13px;
}
</style>

<footer class="container-fluid ">
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
        <li><a href="<?php echo base_url() ?>learn">Learn</a></li>
        <li><a href="<?php echo base_url() ?>about">About Us </a></li>
        <li><a href="<?php echo base_url() ?>contact-us">Contact Us</a> </li>
        <li><a href="https://blog.myonlineshiksha.com">Blog</a></li>
      </ul>
    </div>
    <div class="col-sm-4 footer_list ">
      <ul>
        <li><a href="<?php echo base_url() ?>terms-of-use">Terms of Use</a></li>
        <li><a href="<?php echo base_url() ?>privacy-policy">Privacy Policy</a> </li>
      </ul>
    </div>

    <!-- important quick links direct to courses -->
    <div class="col-sm-12 quick_links">
      <div class="col-sm-4 footer_list">
        <ul style="padding-left: 5px;">
          <li><a href="<?php echo base_url();?>category/courses/9th-class-cbse">Class 9 CBSE Online Courses</a></li>
          <li><a href="<?php echo base_url();?>online-courses/mathematics-of-class-9th-cbse-ncert-online-classes">CBSE class 9 Maths Online Courses </a></li>
          <li><a href="<?php echo base_url();?>online-courses/physics-of-class-9th-cbsencert">CBSE class 9 Science Online Courses </a> </li>
        </ul>
      </div>
      <div class="col-sm-4 footer_list">
        <ul>
          <li><a href="<?php echo base_url();?>category/courses/10th-class-cbse">Class 10 CBSE Online Courses </a></li>
          <li><a href="<?php echo base_url();?>online-courses/class-10th-mathematics-cbse-ncert-online-classes">CBSE Class 10 Maths Online Courses </a> </li>
          <li><a href="<?php echo base_url();?>online-courses/class-10th-physics-cbse-ncert-online-classes">CBSE Class 10 Science Online Courses </a></li>
        </ul>
      </div>
      <div class="col-sm-4 footer_list">
        <ul>
          <li><a href="<?php echo base_url();?>category/courses/11th-class-cbse">Class 11 CBSE Online Courses </a></li>
          <li><a href="<?php echo base_url();?>online-courses/class-11th-mathematics-cbse-ncert-online-classes">CBSE Class 11 Maths Online Courses </a> </li>
          <li><a href="<?php echo base_url();?>online-courses/class-11th-physics-cbse-ncert-online-classes">CBSE Class 11 Physics Online Courses </a></li>
        </ul>
      </div>
    </div>
    <div class="col-sm-12 quick_links">
      <div class="col-sm-4 footer_list">
        <ul style="padding-left: 5px;">
          <li><a href="<?php echo base_url();?>category/courses/class-12th">Class 12 CBSE Online Courses  </a></li>
          <li><a href="<?php echo base_url();?>online-courses/class-12th-mathematics-cbse-ncert-online-classes">CBSE Class 12 Maths Online Courses </a></li>
          <li><a href="<?php echo base_url();?>online-courses/class-12th-physics-cbse-ncert-online-classes">CBSE Class 12 Physics Online Courses </a> </li>
          <li><a href="<?php echo base_url();?>online-courses/class-12th-chemistry-cbse-ncert">CBSE Class 12 Chemistry Online Courses </a> </li>
        </ul>
      </div>
      <div class="col-sm-4 footer_list">
        <ul>
          <li style="color: #bbb;"> Entrance Exams </li>
          <li><a href="<?php echo base_url();?>category/courses/jee-mains">JEE Online Course </a> </li>
          <li><a href="<?php echo base_url();?>category/courses/neet">NEET Online Course </a></li>
        </ul>
      </div>
    </div>
    <!-- important quick links direct to courses -->
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
    <!-- <a href="tel:+917303520052" class="fixed_w_btn"> <img src="<?php echo base_url();?>public/uploads/logo/support2.gif"></a> -->
    <!-- <a href="tel:+917303520052" class="fixed_w_btn"> <i class="fa fa-phone"></i> </a> -->
  <section class="">
    <div class="">
      <div class="col-sm-12  no-padding bottom_text">
        <div class="col-sm-12 footer_text1">
          <div style="float:left;">
            <a href="https://myonlineshiksha.com/">
            <img alt="Udemy" class="udemy-logo" src="<?php echo base_url(); ?>public/images/MyOnlineShiksha-logo.svg" width="110"></a>
            
          </div>
          <div>
            <p class="copy_right_text"> © MyOnlineShiksha™ by VeerIT Solutions. All Rights Reserved.   Powered by <a href="https://www.createonlineacademy.com" rel="nofollow" style="color:white">CreateOnlineAcademy™</a></p>
          </div>
        </div>
      </div>
     </div>
    </section>
  </div>
</footer>
<form style="visibility: hidden;" id="newr" method="post" action="<?php echo base_url('users/newr'); ?>">
  <input type="hidden" name="newurl" id="newurl">
</form>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<script type="text/javascript" src="<?php echo base_url() ?>public/new_template/js/jquery.leanModal.min.js"></script>
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 -->  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>public/js/fastclick/lib/fastclick.js"></script>  -->
  <script type="text/javascript" src="<?php echo base_url(); ?>public/new_template/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/new_template/js/common.js"></script> -->
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

  $(document).ready(function() {
    $('.tooltip').tooltipster();
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
<!-- script async>
(function(s,u,m,o,j,v){
  j=u.createElement(m);
  v=u.getElementsByTagName(m)[0];
  j.async=1;
  j.src=o;
  j.dataset.sumoSiteId='928b64ac204f9ecdedb7d267c9363ae2224f4884d16b1315038bdb904a13c1ae';
  v.parentNode.insertBefore(j,v)
})
(window,document,'script','//load.sumo.com/');
</script -->

<!-- <script type="text/javascript" src="https://myonlineshiksha.com/firebase-messaging-sw.js"></script> -->
<!--script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js"></script>
<script type="text/javascript"> 
var subscribersSiteId = '84440be7-1538-4374-adcd-362fd5c84f8c';
</script-->
<!--script src="https://my.hellobar.com/c9a914160b59ee0a58dc6ea8904b978802440fab.js" type="text/javascript" charset="utf-8" async="async"></script-->