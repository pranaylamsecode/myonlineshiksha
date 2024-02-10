<script src="<?php echo base_url(); ?>public/js/word_effect.js">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/new_template/css/mos_home.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php
$CI = & get_instance();
//$CI->load->view('new_template_design/header'); 
?>

    <?php
$CI =& get_instance();
$CI->load->model('admin/settings_model');
$CI->load->model('customs_model');
$CI->load->model('Category_model');
$CI->load->model('category_model');

$CI->load->model('program_model');

$getItemssetting = $CI->settings_model->getItems();
$callpages = $CI->settings_model->getAllPages();
$countpage = count($callpages);
$currenttemplate = $getItemssetting[0]['layout_template'];
$settings = $CI->settings_model->getTemplateById($currenttemplate);
$data11 = $settings[0]['options'];
$data = json_decode($data11);
$allsociallinks=$CI->settings_model->getSocialLinks();
$auth = $this->session->userdata('logged_in');
//echo ($auth['groupid']);
$logoimage=$getItemssetting[0]['logoimage'];
$title = $getItemssetting[0]['univer_title'];
$tagline_font = $getItemssetting[0]['tagline_font'] ? $getItemssetting[0]['tagline_font'] :'';
$tagline_font_size = $getItemssetting[0]['tagline_font_size'] ? $getItemssetting[0]['tagline_font_size'] :'';
$tagline_font_color = $getItemssetting[0]['tagline_font_color'] ? $getItemssetting[0]['tagline_font_color'] :'';
extract($getItemssetting[0]);
$menulayout = json_decode($ctgspage);
$searchbox = json_decode($ctgpage);
$menu_layout = $menulayout->ctgs_image_alignment;
$searchbox_val = $searchbox->ctg_image_alignment;
$userDetail = $CI->settings_model->getAllUsersDetail($auth['id']);
$notification = $CI->settings_model->getNotification($auth['id']);
$viewed = 0;
foreach($notification as $notify)
{
    if($notify->viewed == 0)
    {
        $viewed++;
    }
}
$LM =& get_instance();
$LM->load->model('login_model');
$get_student_instr = $LM->login_model->get_student_instr();
?>
        <?php
       $CI = & get_instance();
       $CI->load->model('admin/settings_model');
       $CI->load->model('program_model');

       $getExpireDays = $CI->settings_model->getExpireDays(1,'mlms_academydetails');
       if($getExpireDays)
       {
        //print_r($getExpireDays);

        $currentdate = date('Y-m-d');
        $date1 = new DateTime($currentdate);
        $date2 = new DateTime($getExpireDays->academy_expired);
        $interval = $date2->diff($date1);
        //echo $interval->days;
       }
 ?>
            <?php 
     if($auth){
        if($auth['groupid'] != 1){
           if (($interval->days < -1)){
            $this->load->helper('url');
            redirect(base_url().'admin/users/expired_academy');
           }
       }
     }

?>

  <main>
   <!--  <div class="discount_bar highlight_discount">
        <div class="container">
           <span class="dicount_text">Upto <b>80% opening discount</b> on all courses!</span>
        </div>
    </div> -->
    <!-- header and banner section -->
    <section class="top topban">
      <style type="text/css"> 
      .rio_variants_container > p {
    text-align: center;
    margin: 20px 0px 25px 0px;
    display: block;
}
      .rio_variants {
    padding: 50px 0px;
}
.learnMoreSection:not(.showMore) .panel-collapse {
    height: auto;
    overflow: unset;
}
.showMore .panel-collapse {
    height: 0px;
    overflow: hidden;
    transition: 0.3s all ease;
}
.learnMoreSection .panel-heading h4 {
    color: #ea5252;
    font-size: 15px;
    font-weight: 500;
}
.learnMoreSection .panel-heading h4 i {
    position: relative;
    top: 1px;
    font-size: 17px;
    left: 3px;
}
.learnMoreSection .panel-heading h4:hover {
    text-decoration: underline;
}
.learnMoreSection .panel-heading {
    padding: 0px;
    border: 0px;
    cursor: pointer;
}
.learnMoreSection {
    margin: 0px 0px 10px 0px;
}

.rio_variants .rio_variants_container>h3 {
    font-size: 30px;
    color: #181818;
    font-weight: bold;
    text-align: left;
    text-align: center;
        padding-bottom: 1px;
}
.rio_variants .rio_variants_wrapper {
    justify-content: center;
    width: 100%;
    margin: 0 auto;
    text-align: center;
    padding: 30px 0;
    /* max-width: 1200px; */
    display: flex;
    align-items: baseline;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod {
    display: inline-block;
    width: calc(33% - 20px);
    margin: 0 10px;
    text-align: left;
    padding: 25px 40px 0px 40px;
    border: 1px solid #ec2661;
    border-radius: 40px;
    padding-bottom: 85px;
    min-height:  610px;
    position: relative;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod h3 {
    font-size: 28px;
    color: #181818;
    font-weight: bold;
    text-align: left;
    /* margin-bottom: 10px !important; */
    padding-bottom: 10px;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod span {
    font-size: 20px;
    color: #181818;
    font-weight: bold;
    text-align: left;
    line-height: 32px;
    line-height: 1.5em;
    margin-bottom: 7px;
    display: block;
    margin-top: 15px;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod .rio_variants_list {
    margin-bottom: 20px;
    text-align: left;
    font-weight: 600;
    list-style-type: none;
    position: relative;
    font-size: 16px;
    min-height: unset;
    padding-left: 5px;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod .rio_variants_list li::before {
    content: '';
    background-size: contain;
    position: absolute;
    padding: 0;
    left: 1px;
    top: 8px;
    width: 5px;
    height: 5px;
    background: #000;
    border-radius: 50%;
}

.rio_variants .rio_variants_wrapper .rio_variants_prod .rio_variants_list li {
    padding-left: 16px;
    position: relative;
    font-weight: 400;
    font-size: 15px;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod .rio_variant_btn {
    position: absolute;
    bottom: 10px;
    width: 90%;
    left: 0px;
    margin: 0px auto 30px auto !important;
    right: 0px;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod .rio_variant_btn {
    display: block;
    width: calc(100% - 75px);
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    color: #ffffff;
    padding: 10px;
    letter-spacing: 1px;
    margin: 20px 0 10px;
    text-align: center;
    border-radius: 45px;
    background: #ea5252;
    /* transition-delay: 2s; */
    background-size: 200% auto;
    transition: 0.3s all ease;
    border: 1px solid transparent;
}

.rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller a.rio_variant_btn {
    background: #fff;
    color: #ea5252;
}

.rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller {
    background: #ea5252;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller h3, .rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller p, .rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller li, .rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller span {
    color: #fff;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller li::before {
    background: #fff !important;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller .panel-heading h4 {
    color: #fff;
}

.rio_variants .rio_variants_wrapper .rio_variants_prod.bestSeller a.rio_variant_btn:hover {
    background: transparent !important;
    border: 1px solid #fff;
    color: #fff;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod .rio_variant_btn:hover {
    background: #d54349;
}
.rio_variants {
    padding: 0px 0px 30px 0px;
    border-bottom: 1px solid #ccc;
}
        .topban{
          background-color: #000;
          position: relative;
        }
        .ytbg{
          bottom: 0;
          right: 0;
          position: absolute;
          opacity: 1;
          width: 750px;
          height: 425px;
          background-size: cover;
          
        }
        .discount_bar,nav.navbar.navbar-default.topnavbar{
          z-index: 99999;
        }
        .home_banner_section .banner_text, .home_banner_section .bannar_search {
    width: 425px !important;
    max-width: 100% !important;
}
@media (max-width: 1260px){
  iframe.ytbg {
    width: 50% !important;
}
.home_banner_section .banner_text, .home_banner_section .bannar_search {
    width: 50% !important;
    max-width: 100% !important;
    padding-right: 50px !important;
}
}
@media (min-width: 768px) and (max-width:991px){
  .top .text h1 {
    font-size: 42px;
}
}
        @media screen and (max-width: 767px){
          .ytbg {
            z-index: -1;
            width: 100% !important;
            height: 100% !important;
          }
 iframe.ytbg {
    width: 100% !important;
}
      
      .home_banner_section .banner_text, .home_banner_section .bannar_search {
    width: 100% !important;
    max-width: 100% !important;
    padding-right: 0px !important;
} 
.rio_variants .rio_variants_wrapper .rio_variants_prod {
    width: 400px;
    margin: 0px auto 20px auto;
    max-width: 100%;
    padding: 25px 20px 85px 20px;
    min-height: unset;
}
.rio_variants_container > p {
    margin: 20px 0px 10px 0px;
    font-size: 15px;
}
.rio_variants .rio_variants_container>h3 {
    font-size: 24px;
}
.rio_variants .rio_variants_wrapper {
    display: flex;
    flex-direction: column;
} 
.rio_variants .rio_variants_wrapper .rio_variants_prod h3 {
    font-size: 24px;
    margin-top: 5px;
}
.rio_variants {
    padding: 25px 0px 0px 0px;
}
.rio_variants_prod p, .rio_variants_prod li {
    font-size: 15px;
}
.rio_variants .rio_variants_wrapper .rio_variants_prod span {
    font-size: 18px;
}  
.rio_variants .rio_variants_wrapper .rio_variants_prod .rio_variant_btn {
    display: block;
    width: calc(100% - 40px);
}

.learnMoreSection .panel-heading h4 {
    font-size: 15px;
}
        }
        @media screen and (min-width: 768px){
          .ytbg{
            background-image: url('https://myonlineshiksha.com/public/images/experimental-learning-myonlineshiksha.jpg');
          }
      

        }
        @media screen and (max-width: 991px){
          .ytbg{
            border: 0px;
            z-index: -1;
            width: 100% !important;
            height: 100% !important;
          }
        }
        .home_banner_section{
          padding: 21px 0 35px 0;
        }
        .top .text p{
            font-size: 22px;
        }
      </style>
      <iframe class="ytbg" allow="autoplay;mute" src="https://player.vimeo.com/video/531297729?&autoplay=1&loop=1&muted=1&controls=0" frameborder="0"></iframe>
        <div class=" cfix home_banner_section">
            <!-- top header -->
            <div class="container">
                <div class="container main_online_content">
                    <div class="col-sm-12">
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <!-- End Top Bar -->
            <!-- banner content -->
            <div class="container">
                <div class="banner_text text animated fadeInLeft">
                    <section class="cd-intro">
                        <h1 class="cd-headline loading-bar">
                          <span>Online Courses</span><br>
                          <span class="cd-words-wrapper">
                            <b class="is-visible">In हिंदी</b>
                            <b>In मराठी</b>
                            <b>In English</b>
                          </span>
                        </h1>
                    </section>
                    <!--  <h1>Online Courses In Hindi</h1> -->

                    <p>भारतीय भाषाओं में Online Courses पढें और पढ़ाएं</p>
                </div>
                <div class="bannar_search search-content animated fadeInLeft">

                    <?php
                      if($data->page_setting->searchbox_showhide == 'true')
                              {
                           ?>
                        <div class="animated fadeInRight" id='headtop2'>
                            <form name="search_box" action="<?php echo base_url('/category/courses'); ?>" method="post">

                                <input id="getlistitem" class="search_box" name="searchtext" value="" placeholder="Search a course for you" style="color:black;">
                                <button class="btn btn-lg btn-icon" type="submit"><i class="lnr lnr-magnifier"></i></button>
                                <!-- <p id="errorSch" style="display: none;color: red">Enter some text to search..</p> -->
                            </form>
                        </div>
                        <ul id="getitemlist" class="dropdown-content" style="display: none"></ul>

                        <?php
                        }
                      ?>

                </div>
            </div>
        </div>
        <!-- end -->
        </div>
    </section>
    <!-- / -->

    <section id="gradient-section">
        <div class=" container no-padding">
            <div class="col-sm-12 no-padding">
                <div class="col-sm-4 col-sm-4 col-xs-12 no-padding how-udemy-works_sec">
                    <div class="how-udemy-works__text">
                        <ul class="udemy-list">
                            <li class="udemy-left-text book"><span><i class="fa fa-book"></i></span></li>
                            <li class="udemy-right-text">
                                <b>Courses in Indian Languages</b>
                                <div class="how-udemy-works__sub-title">
                                    Learn courses developed by Gurus in variety of Indian languages.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-4 col-xs-12 no-padding how-udemy-works_sec">
                    <div class="how-udemy-works__text">
                        <ul class="udemy-list">
                            <li class="udemy-left-text mobile mobile1"><span><i class="fa fa-mobile"></i></span></li>
                            <li class="udemy-right-text">
                                <b>Learn from your Mobile</b>
                                <div class="how-udemy-works__sub-title">
                                    Get knowledge in all new way from your mobile anytime and anywhere
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-4 col-xs-12 no-padding how-udemy-works_sec">
                    <div class="how-udemy-works__text">
                        <ul class="udemy-list">
                            <li class="udemy-left-text"><span><i class="fa fa-history"></i></span></li>
                            <li class="udemy-right-text">
                                <b>Interactive Education</b>
                                <div class="how-udemy-works__sub-title">
                                    Realtime discussion, Webinars and engaging 2-way communication.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style type="text/css">
section.liveCourses {
    padding: 80px 0px 20px 0px;
}
.liveCourseRating {
    font-size: 13px;
    color: #fff;
    text-align: center;
    margin: 0px 0px 6px 0px;
}
.liveCourseRating i {
    font-size: 12px;
    margin-right: 2px;
    position: relative;
}
.liveCourseImage img {
    height: 185px;
    width: 100%;
    object-fit: cover;
}

  .liveCourseImage {
    position: relative;
}
.liveCourseAuthor {
    display: flex;
    align-items: center;
}
.liveCourseDetails .liveTitle:hover {
    color: #eee !important;
}
.liveCourseDetails .liveTitle {
    color: #fff!important;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 0.3px;
    line-height: 1.4em;
    margin: 0px;
    text-align: left;
    margin-bottom: 15px !Important;
    transition: 0.3s all ease;
    max-height: 45px;
    overflow: hidden;
    display: inline-block;
    min-height: 45px;
    border: 0px !important;
}
.liveCourseDetails {
    position: relative;
    background-color: #232c3b;
    padding: 20px 20px 20px 20px;
    box-shadow: 0 0 10px 0 rgb(0 0 0 / 10%);
    border-radius: 0px 0px 8px 8px;
}
.liveCourseAuthorImage img {
    width: 50px !important;
    border-radius: 50px !important;
    height: 50px;
    object-fit: cover;
    margin-right: 7px;
}
.liveCourses button {
    position: absolute;
    top: calc(50% - 40px);
    background: #fff !important;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    padding: 0px !important;
    justify-content: center;
    box-shadow: 0 0 40px rgb(58 55 55 / 50%);
}
.liveCourses button:hover {
    background: #ea5252 !important;
    color: #fff !important;
}
.liveCourses button.owl-prev{
   left: -21px;
}
.liveCourses button.owl-next{
   right: -21px;
}
.liveCourseAuthorDetails h6 {
    color: #fff;
    margin: 0px;
}
.liveCourseAuthorDetails h5 {
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    margin: 7px 0px 0px 0px;
}


.liveCourses button i {
    font-size: 26px;
    padding: 0px !important;
}
.liveCourseDetails a.regButton {
    width: auto;
    background: #fff;
    box-shadow: unset;
    border-radius: 8px;
    padding: 12px;
    color: #232c3b!important;
    display: block;
    font-weight: 600;
    font-size: 14px;
    margin: 23px 0px 0px -0px;
    border: 1px solid #fff !important;
    transition: 0.3s all ease;
    text-align: center;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.liveCourseDetails a.regButton:hover {
    background: #232c3b;
    color: #fff !important;
}
.liveCourseImage img {
    position: relative;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
.courseHeader h3 {
    margin: 0px;
    font-weight: 700;
    color: #2e3a59;
    line-height: 1.3em;
}
.courseHeader {
    padding: 0px 0px 20px 0px;
    display: flex;
    width: 100%;
    align-items: flex-end;
}
.courseHeader h3 {
    margin: 0px;
}
.courseHeader a {
    margin-left: auto;
}
.liveCourseTime {
    margin-left: auto;
}
.liveCourseTime h5 i {
    font-size: 12px;
    position: relative;
    top: -1px;
    left: -2px;
}
.liveCourseTime h5 {
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    margin: 4px 0px 3px 0px !important;
}

.courseHeader a:hover {
    color: #ea5252;
}
.courseHeader a {
    color: #2e3a59;
    font-weight: 600;
    font-size: 14px;
    transition: 0.3s all ease;
}
@media (max-width: 767px){
  .liveCourses button {
    top: calc(50% - 36px);
    width: 36px;
    height: 36px;
}
.liveCourses button i {
    font-size: 24px;
    padding: 0px !important;
}
.courseBody {
    padding: 0px 15px;
}
.courseBody {
    padding: 0px 15px;
    width: 350px;
    margin: 0 auto;
    max-width: 100%;
}
.liveCourseTime {
    margin-left: 0px;
    width: 100%;
}
.liveCourseTime h5 {
    margin: 19px 0px 0px 0px !important;
}
.liveCourseTime h5 i {
    font-size: 12px;
    position: relative;
    top: -1px;
    left: 0px;
    margin-right: 3px;
}
.liveCourses button.owl-prev {
    left: -16px;
}
.liveCourses button.owl-next {
    right: -16px;
}
.liveCourseAuthorDetails {
    width: calc(100% - 60px);
}
.liveCourseAuthor {
    display: flex;
    align-items: center;
    flex-direction: row;
    flex-wrap: wrap;
}
.liveCourseDetails h3 {
    max-height: unset;
    overflow: unset;
}
section.liveCourses {
    padding: 50px 0px 20px 0px;
}
.liveCourseRating {
    margin: 19px 0px 0px 0px;
        text-align: left;
}


}
</style>
    <section class="liveCourses">
      <div class="container">
        <div class="innerSection">
          <div class="courseHeader">
            <h3>Live Courses</h3>
            <a href="https://myonlineshiksha.com/live-courses/">View all</a>
          </div>
          <div class="courseBody">
            <div class="owl-carousel owl-theme">
                <div class="item">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/3567_04-18-2019.png">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/ch1-number-system-free-class-9th-mathematics-course-cbse-ncert-online-classescopy">Mathematics of Class 9th CBSE/NCERT Online Classes</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/3431_04-18-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Swati Mishra</h5>
                      </div>
                      <div class="liveCourseTime">
                         <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/ch1-number-system-free-class-9th-mathematics-course-cbse-ncert-online-classescopy" class="regButton">Register For Free</a>
                  </div>
                </div>
                <div class="item">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/2751_09-28-2019.jpg">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/class-10th-mathematics-cbse-ncert-online-classes">Mathematics of Class 10th CBSE/NCERT Online Classes</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/3431_04-18-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Swati Mishra</h5>
                      </div>
                      <div class="liveCourseTime">
                          <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/class-10th-mathematics-cbse-ncert-online-classes" class="regButton">Register For Free</a>
                  </div>
                </div>
                 <div class="item">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/1389_08-13-2019.png">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/basics-of-cloud-computing">Basics of Cloud Computing</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/2752_06-22-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Pranita Tiwari</h5>
                      </div>
                      <div class="liveCourseTime">
                          <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/basics-of-cloud-computing" class="regButton">Register For Free</a>
                  </div>
                </div>
                <div class="item">
                  <div class="liveCourseImage">
                    <img src="https://myonlineshiksha.com/public/uploads/programs/img/thumb_232_216/2230_02-17-2021.jpg">
                  </div>
                  <div class="liveCourseDetails">
                    <div class="liveCourseTitle">
                      <a class="liveTitle" href="https://myonlineshiksha.com/online-courses/web-design-and-office-automation">Web Design and Office Automation</a>
                    </div>
                    <div class="liveCourseAuthor">
                      <div class="liveCourseAuthorImage">
                        <img src="https://myonlineshiksha.com/public/uploads/users/img/2752_06-22-2019.png">
                      </div>
                      <div class="liveCourseAuthorDetails">
                        <h6>Taught by</h6>
                        <h5>Pranita Tiwari</h5>
                      </div>
                      <div class="liveCourseTime">
                        <div class="liveCourseRating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star checked"></i>
                          </div>
                          <h5><i class="fa fa-calendar-o" aria-hidden="true"></i> 4:00 PM, Mon 6 Sep</h5>
                        </div> 
                    </div>
                    <a href="https://myonlineshiksha.com/online-courses/web-design-and-office-automation" class="regButton">Register For Free</a>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>


<?php 
  $freecourses = $this->Pagecreator_model->getcourse("p.id in(291,295,307,310,314,316,317,318) and p.published = 1 and p.trash = 0",8,1);
    if($freecourses){ ?>
<section class="courses">
  <div class="wrap">
    <div class="all_coursess">
      <div class="home-item col-md-12 col-sm-12 col-xs-12">
      <h2>Featured Courses</h2>
      <div id="">
        <?php 
        $output = '';
        $currency_symbol = '<i class="fa fa-inr"></i>';
        foreach ($freecourses as $othercourse)
        { 
      if($othercourse->image){
        $image = $othercourse->image;
      }
      else{
        $image = "no_images_course.png";
      }
      $output .= '
      <div class="item-item col-md-3 col-sm-4">
        <a href="'.base_url().'online-courses/'.$othercourse->slug.'">
          <div class="card card1">
            <div class="cardhover">
                <img src="'.base_url().'public/uploads/programs/img/thumb_232_216/'.$image.'" width="100%">';
               $output .= ' </div>
            <h5 class="card_heading2">'.$othercourse->name.'</h5>
            <p class="jonas">'.ucwords($othercourse->first_name.' '.$othercourse->last_name).'</p>';
              $reviews = $this->Pagecreator_model->getAvgReview($othercourse->id);
              $rcount = floatval($reviews->avg_rate);
              if($rcount == 0)
              {
                $getextras = $this->Crud_model->get_single('demo_data',"course_id = ".$othercourse->id,"ratings");
                $rcount = floatval($getextras->ratings);
              }
              $output .= '<p class="star">';
              for ($i=1; $i <=5 ; $i++) { 
                $output .= '<i class="fa  fa-star';
                  if(floatval($i) <= floatval($rcount))
                    $output .= ' checked">';
                  else if(floatval($i) > floatval($rcount) && floatval($i) <= ceil(floatval($rcount))) 
                    $output .= '-half-full checked">';
                  else if(floatval($i) > floatval($rcount))
                    $output .= '-o checked">';
                  $output .= '</i>';
              } 
              $output .= '<span class="small_card">';
              if($rcount>0) 
                $output .= ' ( '.number_format($rcount,1).' ratings )';
              $output .= '</span>
            </p>
            <p class="rupees" align="right">
              <span class="del_price"> ';
              if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) >0 ){ 
                $output .= $currency_symbol.' '.$othercourse->demoprice.' '; 
              }
              else if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) <= 0) { $output .= 'Free ';}
              else{ $output .= $currency_symbol.' '.$othercourse->fixedrate.' '; 
              }
              if(intval($othercourse->fixedrate) > 0 && intval($othercourse->demoprice) >0){
                $output .= '<span class="del_price2">';
                $output .= $currency_symbol.' '.$othercourse->demoprice;
                $output .= '</span>';
              }
              $output .= '</span>
            </p>
          </div>
        </a>
      </div>';
    } 
    echo $output;
    ?>
      </div> 
    </div>
    </div>
  </div>
</section>
     <?php } ?>

<section class="rio_variants" id="pricing">
<div class="rio_variants_container wow slideInUp container" data-wow-offset="100" data-wow-delay="0.10s" data-wow-duration="0.85s" style="visibility: visible; animation-duration: 0.85s; animation-delay: 0.1s;">
<h3>Industry Readiness Program with TCS iON Remote Internship</h3>
<p>Get yourself prepared for the industry with specialized courses and guaranteed remote internship</p>
<div class="rio_variants_wrapper">
<div class="rio_variants_prod">
    <h3>Beginner</h3>
    <p>Boost your career with online course to prepare for a Job Interview with the 10 days remote internship and get certified by TCS iON.</p>
    <span>Courses</span>
    <ul class="rio_variants_list marbtm60">
        <li>Interview Techniques</li>
    </ul>
    <span>Remote Internship</span>
                        <ul class="rio_variants_list marbtm60">
                            <li> 45 Hours Internships </li>
                            <li>15 Hours in Industry Projects</li>
                            <li>Duration 10 Days</li>
                        </ul>
   
    <div class="learnMoreSection showMore">
                <div class="panel-heading">
                   <h4>
                          Learn more <i class="fa fa-angle-right" aria-hidden="true"></i>

                      
                    </h4>

                </div>
                <div class="panel-collapse" >
                    
                        <span>Mentorship</span>
                        <ul class="rio_variants_list marbtm60">
                            <li>Learning References</li>
                            <li>Daily Activity</li>
                            <li>Project Reporting</li>
                            <li>Digital Discussion Room</li>
                            <li>Tests and Viva</li>
                            <li>Access to Industry Mentor</li>
                        </ul>
                        <span>Recommedations</span>
                        <ul class="rio_variants_list marbtm60">
                            <li>Credit Points 1</li>
                            <li>Credits Aligned with AICTE and UGC</li>
                            <li>Internships on Trending Topics</li>
                        </ul>
                </div>
        </div>
   
    
<a class="rio_variant_btn" href="<?php echo base_url(); ?>tcsion-remote-internship-program-irp-beginner">Get Started</a>
</div>
<div class="rio_variants_prod bestSeller">
<h3>Intermediate</h3>
<p>Invest in your future with this specialized program having professionally curated courses, remote internship, indutry mentors leading to certification by TCS iON.</p>
 <span>Courses</span>
    <ul class="rio_variants_list marbtm60">
        <li>Public Speaking</li>
        <li>Interview Techniques</li>
    </ul>
     <span>Remote Internship</span>
    <ul class="rio_variants_list marbtm60">
        <li>125 Hours Internships</li>
        <li>50 Hours in Industry Projects</li>
        <li>Duration 30 Days</li>
    </ul>

    <div class="learnMoreSection showMore">
                <div class="panel-heading">
                   <h4>
                          Learn more <i class="fa fa-angle-right" aria-hidden="true"></i>

                      
                    </h4>

                </div>
                <div class="panel-collapse" >
                   
    <span>Mentorship</span>
    <ul class="rio_variants_list marbtm60">
        <li>Learning References</li>
        <li>Daily Activity</li>
        <li>Project Reporting</li>
        <li>Digital Discussion Room</li>
        <li>Tests and Viva</li>
        <li>Access to Industry Mentor</li>
        <li>Webinars by Industry Mentors</li>
    </ul>
    <span>Recommedations</span>
    <ul class="rio_variants_list marbtm60">
        <li>Credit Points 3</li>
        <li>Credits Aligned with AICTE and UGC</li>
        <li>Internships on Trending Topics</li>
    </ul>
                </div>
        </div>
   
<a class="rio_variant_btn" href="<?php echo base_url(); ?>tcsion-remote-internship-program-irp-intermediate" >Get Started</a>
</div>
<div class="rio_variants_prod">
<h3>Advanced</h3>
<p>This is an career accelerator program that makes you Industry Ready which guarantees results. It will have 90 hours of industry project and certification by TCS iON.</p>
<span>Courses</span>
    <ul class="rio_variants_list marbtm60">
        <li>Industry Readiness</li>
        <li>Public Speaking</li>
        <li>Interview Techniques</li>
        <li>Personality Development</li>
    </ul>
     <span>Remote Internship</span>
                        <ul class="rio_variants_list marbtm60">
                            <li>210 Hours Internships</li>
                            <li>90 Hours in Industry Projects</li>
                            <li>Duration 45 Days</li>
                        </ul>
<div class="learnMoreSection showMore">
                <div class="panel-heading">
                   <h4>
                          Learn more <i class="fa fa-angle-right" aria-hidden="true"></i>

                      
                    </h4>

                </div>
                <div class="panel-collapse" >
                       
                        <span>Mentorship</span>
                        <ul class="rio_variants_list marbtm60">
                            <li>Learning References</li>
                            <li>Daily Activity</li>
                            <li>Project Reporting</li>
                            <li>Digital Discussion Room</li>
                            <li>Tests and Viva</li>
                            <li>Access to Industry Mentor</li>
                            <li>Webinars by Industry Mentors</li>
                        </ul>
                        <span>Recommedations</span>
                        <ul class="rio_variants_list marbtm60">
                            <li>Credit Points 5</li>
                            <li>Credits Aligned with AICTE and UGC</li>
                            <li>Internships on Trending Topics</li>
                        </ul>
    
                </div>
        </div>

<a  class="rio_variant_btn" href="<?php echo base_url(); ?>tcsion-remote-internship-program-irp-advanced">Get Started</a>
</div>
</div>
</div>
</section>

  <?php  $freecourses = $this->Pagecreator_model->getcourse("(p.fixedrate <= 0) and p.published = 1 and p.trash = 0",8);
    if($freecourses){ ?>
<section class="courses">
  <div class="wrap">
    <div class="all_coursess">
      <div class="home-item col-md-12 col-sm-12 col-xs-12">
      <h2>Free Online Courses</h2>
      <div id="">
        <?php 
        $output = '';
        $currency_symbol = '<i class="fa fa-inr"></i>';
        foreach ($freecourses as $othercourse)
        { 
      if($othercourse->image){
        $image = $othercourse->image;
      }
      else{
        $image = "no_images_course.png";
      }
      $output .= '
      <div class="item-item col-md-3 col-sm-4">
        <a href="'.base_url().'online-courses/'.$othercourse->slug.'">
          <div class="card card1">
            <div class="cardhover">
                <img src="'.base_url().'public/uploads/programs/img/thumb_232_216/'.$image.'" width="100%">';
               $output .= ' </div>
            <h5 class="card_heading2">'.$othercourse->name.'</h5>
            <p class="jonas">'.ucwords($othercourse->first_name.' '.$othercourse->last_name).'</p>';
              $reviews = $this->Pagecreator_model->getAvgReview($othercourse->id);
              $rcount = floatval($reviews->avg_rate);
              $output .= '<p class="star">';
              for ($i=1; $i <=5 ; $i++) { 
                $output .= '<i class="fa  fa-star';
                  if(floatval($i) <= floatval($rcount))
                    $output .= ' checked">';
                  else if(floatval($i) > floatval($rcount) && floatval($i) <= ceil(floatval($rcount))) 
                    $output .= '-half-full checked">';
                  else if(floatval($i) > floatval($rcount))
                    $output .= '-o checked">';
                  $output .= '</i>';
              } 
              $output .= '<span class="small_card">';
              if($rcount>0) 
                $output .= ' ( '.number_format($rcount,1).' ratings )';
              $output .= '</span>
            </p>
            <p class="rupees" align="right">
              <span class="del_price"> ';
              if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) >0 ){ 
                $output .= $currency_symbol.' '.$othercourse->demoprice.' '; 
              }
              else if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) <= 0) { $output .= 'Free ';}
              else{ $output .= $currency_symbol.' '.$othercourse->fixedrate.' '; 
              }
              if(intval($othercourse->fixedrate) > 0 && intval($othercourse->demoprice) >0){
                $output .= '<span class="del_price2">';
                $output .= $currency_symbol.' '.$othercourse->demoprice;
                $output .= '</span>';
              }
              $output .= '</span>
            </p>
          </div>
        </a>
      </div>';
    } 
    echo $output;
    ?>
      </div> 
    </div>
    </div>
  </div>
</section>
     <?php } ?>
    <style type="text/css">
  .all_coursess{
    display: inline-block;
    padding: 30px 0px 10px 0px;
    width: 100%;
  }
  .all_coursess .item-item{
    margin-top: 20px;
  }
  .home-item,.home-item h3{
    padding-bottom: 20px;
  }
  .home-item h3, .home-item .btn-div{
    padding-bottom: 20px;
    text-align: center;
  }
  .card1{
    border-radius: 8px;
  }
  .home-item button{
    padding: 7px 25px 7px 25px;
    display: inline-block;
    border: 1px solid #E5503F;
    text-align: center;
    font-weight: 700;
    color: #E5503F;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 3px solid gray;
    margin: 10px 10px 10px 0px;
  }
  .home-item button.btn-h:hover,.home-item button.btn-h.actives{
    color: #fff;
    background-color: #E5503F;
  }
  .cardhover{
    height: 148px;
    overflow: hidden;
  }
  .courses .wrap{
    padding-bottom: 40px;
  }
  .noshowdata{
    display: none;
  }
  .see_all12{
    border-radius: 20px !important;
    padding: 10px 50px !important;
    margin: 15px 0 0 0;
    border: none;
    font-weight: 700;
    color: #fff;
    line-height: 1;
    background-color: #d9534f;
    font-size: 15px;
  }
  .see_all12:hover{
    color: #d9534f !important;
    background: #fff !important;
    border: 1px solid #d9534f !important;
  }
</style>
<section class="courses" style="padding-top: 0px !important;">
  <div class="wrap">
    <div class="all_coursess" style="padding-top: 0px;">
      <div class="home-item col-md-12 col-sm-12 col-xs-12">
      <h3>Select your desired online course</h3>
      <div class="btn-div">
        <button type="button" id="btn1" onclick="return setsection(1);" class="btn-h actives">Class 9th & 10th</button>
        <button type="button" id="btn2" onclick="return setsection(2);" class="btn-h ">Class 11th</button>
        <button type="button" id="btn3" onclick="return setsection(3);" class="btn-h ">Class 12th</button>
        <button type="button" id="btn4" onclick="return setsection(4);" class="btn-h ">IIT JEE</button>
        <button type="button" id="btn5" onclick="return setsection(5);" class="btn-h ">NEET / AIIMS</button>
        <button type="button" id="btn6" onclick="return setsection(6);" class="btn-h ">Professionals</button>
        <button type="button" id="btn7" onclick="return setsection(7);" class="btn-h ">IT Courses</button>
      </div>
      <div class="col-md-12 text-center">
        <label id="label1">Class 9th & 10th</label>
      </div>
      <div id="newsection">
        <?php echo $courses1; ?>
      </div>
        <div class="col-md-12 col-sm-12 text-center">
          <a id="label1_url" href="https://myonlineshiksha.com/category/courses/9th-class-cbse" class="see_all12 btn">View all</a>
        </div>
    </div>
    </div>
  </div>
</section>
<div class="section1 noshowdata"><?php echo $courses1; ?> <input type="hidden" id="lburl_1" value="<?php echo base_url('category/courses/9th-class-cbse'); ?>"></div>
<div class="section2 noshowdata"><?php echo $courses2; ?> <input type="hidden" id="lburl_2" value="<?php echo base_url('category/courses/11th-class-cbse'); ?>"></div>
<div class="section3 noshowdata"><?php echo $courses3; ?> <input type="hidden" id="lburl_3" value="<?php echo base_url('category/courses/class-12th'); ?>"></div>
<div class="section4 noshowdata"><?php echo $courses4; ?> <input type="hidden" id="lburl_4" value="<?php echo base_url('category/courses/jee-mains'); ?>"></div>
<div class="section5 noshowdata"><?php echo $courses5; ?> <input type="hidden" id="lburl_5" value="<?php echo base_url('category/courses/neet'); ?>"></div>
<div class="section6 noshowdata"><?php echo $courses6; ?> <input type="hidden" id="lburl_6" value="<?php echo base_url('category/courses/professional-courses'); ?>"></div>
<div class="section7 noshowdata"><?php echo $courses7; ?> <input type="hidden" id="lburl_7" value="<?php echo base_url('category/courses/it-software'); ?>"></div>
<script type="text/javascript">
  function setsection(id)
  {
    var sectiondata = $(".section"+id).html();
    if(sectiondata == ''){
      /*$.ajax({
        type :"post",
        cache: false,
        url : "<?php echo base_url()?>welcome/section_data/",
        data:{id:id},
        success:function(data){
          $(".section"+id).html(data);
          $("#newsection").html(data);
        }
      });*/
    }
    $('button').removeClass('actives');
    $("#btn"+id).addClass('actives');
    $("#label1").html($("#btn"+id).html());
    $("#newsection").html($(".section"+id).html());
    $("#label1_url").attr('href',$("#lburl_"+id).val());
  }
  $(document).ready(function(){
    var i = 1;
     /* $.ajax({
        type :"post",
        cache: false,
        url : "<?php echo base_url()?>welcome/section_data/",
        data:{id:i},
        success:function(data){
          $(".section"+i).html(data);
          $("#newsection").html(data);
        }
      });*/
  });
</script>

    <!-- courses -->
    <?php       
    $courses = $CI->customs_model->toprateCourse1(0,'');
    /*$ids = substr($course_ids, 1, -1);
    echo $ids;
    $courses = $CI->customs_model->frontCourses($ids,0);*/
    if($courses){
    ?>
    <section class="courses">
        <div class="wrap">
            <div class="course_container popular_course">

                <h2>Popular Courses</h2>
                
                <section class="first_slider ">
                    <div id="myCarouselWrapper" class="fullwidth-slider-sect container-fluid no-padding">
                        <div id="myCarousel" class="carousel slide" data-interval="false">
                            <div class="carousel-inner" role="listbox">
                                <input type="hidden" class="startlimit" name="startlimit" value="0">
                                <?php    $rows = count($courses);
                                if($rows < 4){}
                                else{ $rows = 4 + $rows; }

                                echo "<input type='hidden' class='startlimit' name='startlimit' value='".$rows."'>";

                                $currency = $CI->settings_model->getItems();
                                $currencysign = $CI->settings_model->getCurrenciesign($currency[0]['currency']);
                                if($currencysign)
                                {
                                  $currency_symbol = $currencysign->sign;
                                }
                                else
                                {
                                $currency_symbol = " "; 
                                }
                                $c=1;
                                foreach ($courses as $othercourse) {

                                  if($c==1){ echo "<div class='item active'>"; }
                                  else if($c > 1 && $c%5 == 0 && $c <= count($courses))
                                  {

                                     echo "</div><div class='item'>";
                                  }
                                  $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
                                        $catid = $CI->category_model->getCatSlugbyId($othercourse->catid);
                                  ?>

                                    <div class="item-item col-md-3 col-sm-4 col-xs-6 res_col">
                                    <!-- <input type="hidden" value="<?php echo $othercourse->id; ?>"> -->
                                        <!-- <a href="<?php //echo base_url().$catid.'/category/'.$othercourse->slug;?>"> -->
                                        <a href="<?php echo base_url().'online-courses/'.$othercourse->slug;?>">
                                            <div class="card">
                                                <div class="cardhover">
                                                    <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%">
                                                    <!-- <div class="overlay">
                                                        <div class="text">
                                                            <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $teacher_info->images; ?>" width="50px" height="50px" class="img-thumbnail">
                                                            <br>
                                                            <?php  $alllecture = $CI->customs_model->countalllecture($othercourse->id);
                                                                //echo "<p>".$alllecture->no_lect." Lectures </p>"; 
                                                                 ?>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
                                                <p class="jonas">
                                                    <?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?>
                                                </p>

                                                <?php 
                                                     $reviews = $CI->program_model->getAllReview($othercourse->id);
                                                     // print_r($reviews);
                                                     $rcount = 0;
                                                     $rtotal = 0;
                                                     $sr = 0;
                                                         foreach ($reviews as $review) {

                                                      $rtotal = $rtotal + $review->review_rate;
                                                      $sr = $sr + 1;}
                                                      $rcount = floatval($rtotal) / floatval($sr);
                                                      $rcount = floatval($rcount);
                                                    ?>
                                                    <p class="star">
                                                        <?php  for ($i=1; $i <=5 ; $i++) { 
                                                            $output = '';
                                                $output .= '<i class="fa';
                                                if(floatval($i) <= floatval($rcount))
                                                    $output .= ' fa-star checked">';
                                                else if(floatval($i) > floatval($rcount) && floatval($i) <= ceil(floatval($rcount))) 
                                                    $output .= ' fa-star-half-full checked">';
                                                else if(floatval($i) > floatval($rcount))
                                                    $output .= ' fa-star-o checked">';
                                                $output .= '</i>';
                                                echo $output;
                                                          } 
                                                          ?>
                                                            <span class="small_card"><?php if($rcount>0) echo "( ".$rcount." ratings )" ?> </span>
                                                    </p>
                                                    <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'Free'; } ?></span>
                                                        <?php if($othercourse->demoprice >0){ ?>
                                                            <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                                                              </span>
                                                            <?php } ?>
                                                    </p>

                                            </div>

                                        </a>
                                    </div>

                                    <?php
                                      $c++;
                                          } 
                                           echo "</div>"; ?>

                                                                    </div>
                                                                    <?php 
                                            if($rows > 4){

                                      ?>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <?php } ?>
                        </div>
                    </div>
                    <!-- resposive section -->
                    <div class="responsive-slider-sect home_course_slider">
                        <div class="inner_responsive_slider">
                            <?php foreach ($courses as $othercourse) {  
                                if($othercourse->ordering>4){
                                $catid = $CI->category_model->getCatSlugbyId($othercourse->catid); ?>
                                <div class="responsive-main-slider-sect">
                                    <div class="resposive_txt">
                                        <!-- <a href="<?php // echo base_url().$catid.'/category/'.$othercourse->slug;?>"> -->
                                        <a href="<?php echo base_url().'online-courses/'.$othercourse->slug;?>">

                                            <div class="cardhover">
                                                <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%">
                                                <div class="overlay"></div>
                                            </div>
                                            <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
                                            <?php //if(!$teacher_info){
                                              $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
                                                 ?>
                                                <p class="jonas11">
                                                    <?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?>
                                                </p>
                                                <?php 
                                                         $reviews = $CI->program_model->getAllReview($othercourse->id);
                                                         // print_r($reviews);
                                                         $rcount = 0;
                                                       foreach ($reviews as $review) {

                                                    $rcount = $rcount + $review->review_rate;     }
                                                  ?>
                                                    <p class="star">
                                                        <?php  for ($i=1; $i <=5 ; $i++) { 
                                                              echo "<span class='fa fa-star ";
                                                              if($i<= @$reviews[0]->review_rate) echo 'checked'; 
                                                              echo "'></span>";
                                                            } 
                                                             ?>
                                                            <span class="small_card"><?php if($rcount>0) echo "( ".$rcount." ratings )" ?> </span>
                                                    </p>
                                                    <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'Free'; } ?></span>
                                                        <?php if($othercourse->demoprice >0){ ?>
                                                            <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                                                            </span>
                                                            <?php } ?>
                                                    </p>
                                                  </a>
                                              </div>
                                          </div>
                                          <?php } }
                                          foreach ($courses as $othercourse) {  
                                if($othercourse->ordering<5){
                                $catid = $CI->category_model->getCatSlugbyId($othercourse->catid); ?>
                                <div class="responsive-main-slider-sect">
                                    <div class="resposive_txt">
                                        <!-- <a href="<?php // echo base_url().$catid.'/category/'.$othercourse->slug;?>"> -->
                                        <a href="<?php echo base_url().'online-courses/'.$othercourse->slug;?>">

                                            <div class="cardhover">
                                                <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%">
                                                <div class="overlay"></div>
                                            </div>
                                            <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
                                            <?php //if(!$teacher_info){
                                              $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
                                                 ?>
                                                <p class="jonas11">
                                                    <?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?>
                                                </p>
                                                <?php 
                                                         $reviews = $CI->program_model->getAllReview($othercourse->id);
                                                         // print_r($reviews);
                                                         $rcount = 0;
                                                       foreach ($reviews as $review) {

                                                    $rcount = $rcount + $review->review_rate;     }
                                                  ?>
                                                    <p class="star">
                                                        <?php  for ($i=1; $i <=5 ; $i++) { 
                                                              echo "<span class='fa fa-star ";
                                                              if($i<= @$reviews[0]->review_rate) echo 'checked'; 
                                                              echo "'></span>";
                                                            } 
                                                             ?>
                                                            <span class="small_card"><?php if($rcount>0) echo "( ".$rcount." ratings )" ?> </span>
                                                    </p>
                                                    <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'Free'; } ?></span>
                                                        <?php if($othercourse->demoprice >0){ ?>
                                                            <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                                                            </span>
                                                            <?php } ?>
                                                    </p>
                                                  </a>
                                              </div>
                                          </div>
                                          <?php } }
                                          ?>

                                  </div>
                        <?php if(count($courses) >3){ ?>
                            <div class="text-center col-sm-12 front_load_more_btn"><a data-purpose="load-more-btn" type="button" class="load-more-btn btn btn-default" href="<?php echo base_url() ?>category/courses">View More<span class="udi-small udi udi-chevron-down"></span></a></div>
                            <?php } ?>
                    </div>
                </section>
                <a href="<?php echo base_url() ?>category/courses" class="see_all">View all <i class="fa fa-angle-right" aria-hidden="true"></i> </a>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>public/css/onlineshiksha/js/jquery-3.1.1.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>public/css/onlineshiksha/js/wow.min.js"></script>
    <script>
        wow = new WOW({
            animateClass: 'animated',
            offset: 100,
            callback: function(box) {
                // console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
            }
        });
        wow.init();
    </script>
  </main>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<?php echo $CI->load->view('new_template_design/footer'); ?>
<script type="text/javascript">
    jQuery.browser = {};
    (function() {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
$('.carousel').carousel({ interval: false });
    var $ = jQuery.noConflict();
</script>

<style>
    .dropup {
        position: relative;
    }
    
    @media only screen and (max-width: 959px)
    {
        .see_all{
            display: none;
        }
    }
    
    .dropup .btn {
        padding: 11px 35px;
        border-radius: 0px;
        color: #333;
        background-color: #fff;
        border: 1px solid #0B0909!important;
    }
    
    footer.container-fluid.no-padding {
        padding-top: 0px;
        padding-bottom: 0px;
    }
    
    a#go {
        font-size: 14px;
        color: #777;
    }
    
    #gradient-section {
        padding: 10px 0px 20px;
    }
    
    ul.dropdown-menu:before {
        border-color: transparent transparent #e8e9eb;
        top: -10px;
    }
    
    .courses {
        background: #fff !important;
    }
    
    .btn.large {
        font-size: 18px;
        line-height: 1.2em;
        min-width: 36px;
        padding: 10px 25px 8px;
        text-transform: capitalize;
    }
    
    .btn.primary {
        background: #8FBC8F;
        border: 2px solid #8FBC8F;
        color: #fff;
    }
    
    .btn {
        display: inline-block;
        border: none;
        border-bottom: 1px solid;
        text-align: center;
        -webkit-font-smoothing: antialiased;
        -webkit-appearance: none;
        outline: none;
        font-weight: 700;
        text-decoration: none;
        color: #fff;
        padding: 0 25px;
        line-height: 1;
        white-space: nowrap;
        border-radius: 3px;
        width: auto;
        height: auto;
        font-family: 'Proxima Nova', 'Arial', sans-serif;
    }
    .udemy-left-text {
        margin-top: 0px;
    }
    .reviews {
        padding: 25px 0px 0px;
        min-height: auto!important;
        display: inline-block;
    }
</style>

<script>
    $(document).on('change', "#getfind", function() {
        var val = $(this).val();
        console.log(val);
        alert(val);
    });

    function mySearch11() {
        document.getElementById("myDropdown11").classList.toggle("show");
    }

    function filterFunction11() {
        // document.getElementById("myDropdown").classList.toggle("show");

        var input, filter, ul, li, a, i;
        input = document.getElementById("searchtext11");
        filter = input.value.toUpperCase();
        // alert(filter);
        div = document.getElementById("myDropdown11");
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

<script>
    $(document).on('keyup', '#getlistitem', function() {
        var input = $('#getlistitem').val();
        if (input) {

            $.ajax({

                url: "<?php echo base_url();?>category/getlist",
                type: "POST",
                data: {
                    input: input
                },
                success: function(data) {
                    if (data) {
                        $('#getitemlist').show();
                        $('#getitemlist').html(data);
                    } else {
                        $('#getitemlist').hide();
                        $('#getitemlist').html();
                    }
                },
                error: function(xhr, desc, err) {
                    console.log(xhr);
                },
            });
        } else {
            $('#getitemlist').hide();
            $('#getitemlist').html();
            $('#errorSch').show();
            $("#errorSch").delay(2000).fadeOut("slow");

        }

    });
</script>
<script>
 // var discount_bar_fixed = $('.discount_bar').offset().top;       // get initial position of the element

 //    $(window).scroll(function() {                  // assign scroll event listener

 //        var discount_barcurrentScroll = $(window).scrollTop(); // get current position

 //        if (discount_barcurrentScroll > discount_bar_fixed) {           // apply position: fixed if you
 //            $('.discount_bar').css({                      // scroll to that element or below it
 //                position: 'fixed',
 //                top: '67px',
 //                'margin-top': '-12px'
 //            });
 //        } else {                                   // apply position: static
 //            $('.discount_bar').css({                      // if you scroll above it
 //                position: 'unset',
 //                top: '0',
 //                'margin-top': '0px'


 //            });
 //        };
 //      });
    $(document).ready(function() {

        $('.carousel-control').click();

    });

    $(document).on('click', '.carousel-control', function() {
        var start = $('.startlimit').val();
        var chk = $(this).is('.left');
        if (chk == true) {
            if (start > 0) {
                start = parseInt(start) - 8;
            }
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $(document).on('click', '.load-more-btn', function() {
        $.ajax({

            url: "<?php echo base_url();?>category/getMore",
            type: "POST",

            data: {
                techid: tech_id
            },
            success: function(data) {
                if (data) {
                    // console.log(data);
                    $('.load-more-btn').parent().parent().find('.inner_responsive_slider').append(data);

                    $('.load-more-btn').hide();
                }
            },
        });
    });

    jQuery(document).ready(function() {
       $('.liveCourses .owl-carousel').owlCarousel({
          loop:true,
          margin:15,
          nav:true,
          dots:false,
            navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:3
              },
              1000:{
                  items:3
              }
          }
      });

       $(".panel-heading").click(function () {
           $(this).parent().toggleClass("showMore");
           $(this).hide();
       })
    });

   
</script>




<style type="text/css">
    .fixed_price_button button {
    margin: 0px !important;
    float: right;
    width: 100% !important;
    letter-spacing: unset !important;
    max-width: 100% !important;
    text-align: center;
    padding: 15px 30px !important;
    background-color: #4285F4 !important;
    }
   /* .fixed_price_button button{
      display: none;
    }*/
    .fixed_price_details span#pricerate1 {
        color: #333 !important;
        font-weight: 600 !important;
        font-size: 18px !important;
    }
    .buy_fixed div #price_block {
        text-align: left;
    }
    .fixed_price_button {
        padding: 0px 0px 0px 5px;
    }
    .fixed_price_details .price {
        text-align: left;
    }
    .fixed_price_details {
        padding: 0px !important;
    }

    .buy_fixed {
        align-items: center;
        background-color: #fff;
        box-shadow: 0 -2px 4px rgba(0,0,0,.08), 0 -4px 12px rgba(0,0,0,.08);
        display: flex;
        /* display: none; */
        flex-direction: row;
        overflow-y: hidden;
        padding: 10px 15px;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 1000;
    }
    .price.fixed_price_off span {
        font-size: 15px;
        color: #777;
    }
    .price.fixed_price_off span i{
        font-size: 13px;
        color: #777;
        font-weight: normal;
    }
    .price.fixed_percent_off span {
        color: #222;
        font-weight: normal;
        font-size: 15px !important;
    }
    @media only screen and (min-width: 768px)
    {
      .buy_fixed{
          display: none;
      }
    }
    </style>