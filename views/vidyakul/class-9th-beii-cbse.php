<?php $currency = "INR";
$auth = $this->session->userdata('logged_in');
$user_id = $auth['id']; ?>    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">

    <section class="newBanner">
        <div class="newBannerImage"> <img src="https://invictusacademy.createonlineacademy.com//public/uploads/images/bannerBg.png"> </div>
        <section class="newBannerStyle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-xs-12 newBannerContant">
                        <h1>Class 9th ,सी.बी.एस.ई - CBSE</h1>
                        <div class="subfeatures">
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Doubt sessions - Clear your concepts with our intense doubt sessions</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Revision tests every week (Each subject) - Practice makes a man perfect</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Handwritten notes by Educators</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Menti session / PD classes / Motiovational sessions</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Downloadable PDF files of study material to boost your preparation</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Assignments + Concept revision to sharpen your skills</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>NEET preparation on weekends - Because we care for your future</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Recorded video lessons</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>In-depth analysis of important topics and unlimited practice sessions</span></p>
                            <p><i class="fa fa-check" aria-hidden="true"></i> <span>Test series based on previous year’s papers</span></p>
                        </div>
                        
                        <p class="vide0Card-share-icons share-icici new-share-icon-modular">Share <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://www.niit.com/india/graduates/information-technology/pg-program-full-stack-product-engineering" rel="nofollow"><i class="fa fa-facebook"></i></a> <a target="_blank" href="https://twitter.com/intent/tweet?url=https://www.niit.com/india/graduates/information-technology/pg-program-full-stack-product-engineering" rel="nofollow"><i class="fa fa-twitter"></i></a> <a target="_blank" href="https://www.linkedin.com/cws/share?url=https://www.niit.com/india/graduates/information-technology/pg-program-full-stack-product-engineering&amp;token=&amp;isFramed=true" rel="nofollow"><i class="fa fa-linkedin"></i></a> </p>
                    </div>
                    <div class="col-sm-4 col-xs-12 rightDetailBox">
                        <div class="content">
                            <div class="innercontent">
                                <div class="innersect">
                                    <div class=""> <img src="https://invictusacademy.createonlineacademy.com/public/uploads/programs/img/thumb_232_216/1399_07-31-2021.png
" width="100%">
                                        </div>
                                </div>
                             
                                <div class="bundles-thumb right-block-plan">
                                    <p class="live_class_title">Select your study plan</p>
                                    <div class="plansblock">
                                        <div class="plan changeplan active" id="changeplan20" data-id="20"> <span class="radio checked"><i class="fa fa-check" aria-hidden="true"></i></span>
                                            <div class="flex space-between full-width">
                                                <div class="plan-detail flex columnwise justify-center">
                                                    <h4 class="ellipsis" title="Target 2022 Exams">Target 2022 Exams</h4>
                                                    <h5>Till 2022 Examinations</h5> </div>
                                                <div class="price-detail">
                                                    <h4 class="priceamount" data-price="₹1499">
                                                        ₹1499
                                                        </h4>
                                                    <p>Total (Incl. of all taxes)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- <a class="start_learning_btn_page buy_course_btn" type="button" id="go" rel="leanModal" name="signup" onclick="direct_pay()" href="#registration">
          Get Subscription @ ₹1499</a> --> 
                                    <span id="paymsg"></span>
                                    <a class="start_learning_btn_page buy_course_btn" type="button" 
                                    <?php if(!empty($auth)){
                                        if(empty($getorder)){
                                        ?>
                                        href="javascript:void(0)" id="Payrazor"
                                    <?php } }else{ ?>
                                    id="go" rel="leanModal" name="signup" href="#registration"
                                    <?php } ?>
                                    > <?php if(empty($getorder)){ echo 'Get Subscription @ ₹1499';}else{ echo 'Already Subscribed';} ?></a>
                                </div>
                                <div id="promo_code" style="display: none">
                                    <form class="navbar-form" role="search">
                                        <div class="input-group btn-block">
                                            <input type="hidden" name="course_id" id="course_id" value="3">
                                            <input type="hidden" id="plan_id" name="plan_id" value="">
                                            <input type="hidden" value="" id="coupon_code" name="coupon_code">
                                            <input type="hidden" id="valid_coupon" value="No">
                                            <input type="text" class="form-control" placeholder="Enter coupon code" value="" id="promocode" name="promocode" onkeyup="return sync()">
                                            <div class="input-group-btn">
                                                <button class="btn btn-success" type="button" value="Apply" onclick="promoApply()" id="btn_redeem">Apply </button>
                                            </div>
                                        </div>
                                        <div style="width: 100%;"><span id="promoMSg"></span></div>
                                    </form>
                                </div>
                                <center><a type="button" onclick="showhidecode()" id="hv_coupon">Have a Coupon?</a></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="newUsps mobile-hide newUspsStackRoute">
        <div class="container">
            <div class="row">
                <div class="colUsps">
                    <div class="forrUspbox-1">
                        <div class="col-md-3">
                            <h5>100+ classes of all subjects</h5> </div>
                        <div class="col-md-3">
                            <h5>2,000+ study material</h5> </div>
                        <div class="col-md-3">
                            <h5>150+ sample papers</h5> </div>
                        <div class="col-md-3">
                            <h5>Personal group and mentoring</h5> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="homepage-top-part">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="leftpart">
                        <h2 class="bharatheading">
                  Join Class 9th <span>Online</span> Tuition
               </h2>
                        <div class="features-top">
                            <div class="featureblock"> <img src="https://d2n7zouke881gi.cloudfront.net/uploads/subscription/liveclassicon.png" alt="">
                                <div>
                                    <h5>Live Interactive Classes</h5>
                                    <p>Learn with expert faculties in live classroom and also get your doubts cleared instantly. </p>
                                </div>
                            </div>
                            <div class="featureblock"> <img src="https://d2n7zouke881gi.cloudfront.net/uploads/subscription/testicon.png" alt="">
                                <div>
                                    <h5>Test Series &amp; Notes</h5>
                                    <p>Improve your scores by practicing with handpicked questions and get detailed reports of your performance. </p>
                                </div>
                            </div>
                            <div class="featureblock"> <img src="https://d2n7zouke881gi.cloudfront.net/uploads/subscription/courseicon.png" alt="">
                                <div>
                                    <h5>Structured Courses</h5>
                                    <p>Get access to all our structured courses according to exam syllabus to help you best prepare for it. </p>
                                </div>
                            </div>
                            <div class="featureblock"> <img src="https://d2n7zouke881gi.cloudfront.net/uploads/subscription/accessicon.png" alt="">
                                <div>
                                    <h5>Unlimited access</h5>
                                    <p>One subscription gets you access to all our courses to watch from the comfort of any of your devices. </p>
                                </div>
                            </div>
                            <div class="subscription">
                                <div class="flex space-between align-center">
                                    <div>
                                        <h5>Class 9th
                              subscription starts from
                           </h5>
                                        <h4>₹ 599/month</h4> </div>
                                    <div> <a href="https://vidyakul.com/class-9th/subscription-plans" class="start_learning_btn_page subscriptionbtnCTA" data-source="Explore Page Top">
                           Get Subscription
                           </a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4"> <img src="https://d2n7zouke881gi.cloudfront.net/uploads/subscription/masternewphone-min.png" alt="" class="webimagetop"> </div>
            </div>
        </div>
    </div>
    <div class="courses-block bundles-section-main whitebackground topeducatorsblock topeducatorsblockcontent">
        <div class="container">
            <div class="bundles-section1">
                <div class="row">
                    <div class="flex space-between align-center full-width mb-30">
                        <p class="live_class_title">Top Educators</p> <a href="https://vidyakul.com/class-9th/top-educators" class="see-all-btn see_all_CTA" data-source="Explore Page Top Educators">See All</a> </div>
                    <div class="topeducators">
                        <a href="/vidyakul-educator/nishu-taliyan-220736" class="educator teacher_profileCTA" data-source="Explore Page" data-teacher="Nishu Taliyan"> <img data-src="https://dkuddpry619qg.cloudfront.net/user/220736/5459.jpg" alt="Nishu Taliyan" class="lazy entered loaded" data-ll-status="loaded" src="https://dkuddpry619qg.cloudfront.net/user/220736/5459.jpg">
                            <p class="name ellipsis" title="Nishu Taliyan">Nishu Taliyan</p>
                            <p class="marks">Biology</p>
                        </a>
                        <a href="/vidyakul-educator/b-k-singh-author" class="educator teacher_profileCTA" data-source="Explore Page" data-teacher="B K Singh Author"> <img data-src="https://dkuddpry619qg.cloudfront.net/user/80658/40449.jpg" alt="B K Singh Author" class="lazy entered loaded" data-ll-status="loaded" src="https://dkuddpry619qg.cloudfront.net/user/80658/40449.jpg">
                            <p class="name ellipsis" title="B K Singh Author">B K Singh Author</p>
                            <p class="marks">Maths</p>
                        </a>
                        <a href="/vidyakul-educator/mitali-grover-220833" class="educator teacher_profileCTA" data-source="Explore Page" data-teacher="Mitali Grover"> <img data-src="https://dkuddpry619qg.cloudfront.net/user/220833/7587.jpg" alt="Mitali Grover" class="lazy entered loaded" data-ll-status="loaded" src="https://dkuddpry619qg.cloudfront.net/user/220833/7587.jpg">
                            <p class="name ellipsis" title="Mitali Grover">Mitali Grover</p>
                            <p class="marks">Science</p>
                        </a>
                        <a href="/vidyakul-educator/varsha-malik-232623" class="educator teacher_profileCTA" data-source="Explore Page" data-teacher="Rahul Sir"> <img data-src="https://vidyakul-courses.s3.ap-south-1.amazonaws.com/singleliveclass/new-single-liveclass/54266/15047.jpg" alt="Rahul Sir" class="lazy entered loaded" data-ll-status="loaded" src="https://vidyakul-courses.s3.ap-south-1.amazonaws.com/singleliveclass/new-single-liveclass/54266/15047.jpg">
                            <p class="name ellipsis" title="Rahul Sir">Rahul Sir</p>
                            <p class="marks">Social Studies</p>
                        </a>
                        <a href="/vidyakul-educator/parul-verma-264488" class="educator teacher_profileCTA" data-source="Explore Page" data-teacher="Parul Verma"> <img data-src="https://dkuddpry619qg.cloudfront.net/user/264488/20964.png" alt="Parul Verma" class="lazy entered loaded" data-ll-status="loaded" src="https://dkuddpry619qg.cloudfront.net/user/264488/20964.png">
                            <p class="name ellipsis" title="Parul Verma">Parul Verma</p>
                            <p class="marks">English</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="courses-block bundles-section-main greybackground masterbatchesblockcontent">
        <div class="mastercoursescontainer">
            <div class="bundles-section1">
                <div class="row">
                    <h3 class="heading-section">Master Batches</h3>
                    <p class="subheading-section">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <div class="mastercourses">
                        <div class="slider">
                            <a href="https://vidyakul.com/live-course-profile/class-9th-masterclasses-2021-22" class="slider__item">
                                <div class="lockblock"> <i class="fa fa-lock" aria-hidden="true"></i> </div> <img src="https://vidyakul-courses.s3.ap-south-1.amazonaws.com/fulllivecourse/new-full-livecourse/85800.jpg" alt="MixCourse"> 
                            </a>
                            <a href="https://vidyakul.com/live-course-profile/class-9th-masterclasses-2021-22" class="slider__item">
                                <div class="lockblock"> <i class="fa fa-lock" aria-hidden="true"></i> </div> <img src="https://vidyakul-courses.s3.ap-south-1.amazonaws.com/fulllivecourse/new-full-livecourse/85800.jpg" alt="MixCourse"> 
                            </a>
                            <a href="https://vidyakul.com/live-course-profile/class-9th-masterclasses-2021-22" class="slider__item">
                                <div class="lockblock"> <i class="fa fa-lock" aria-hidden="true"></i> </div> <img src="https://vidyakul-courses.s3.ap-south-1.amazonaws.com/fulllivecourse/new-full-livecourse/85800.jpg" alt="MixCourse"> 
                            </a>
                            <a href="https://vidyakul.com/live-course-profile/class-9th-masterclasses-2021-22" class="slider__item">
                                <div class="lockblock"> <i class="fa fa-lock" aria-hidden="true"></i> </div> <img src="https://vidyakul-courses.s3.ap-south-1.amazonaws.com/fulllivecourse/new-full-livecourse/85800.jpg" alt="MixCourse"> 
                            </a>

                           
                        </div>
                    </div>
                    <div class="flex justify-center full-width mt-20"> <a href="https://vidyakul.com/class-9th/subscription-plans" class="start_learning_btn_page subscriptionbtnCTA" data-source="Explore Page Master classes">
                         Get Subscription
                        </a> </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>

    <script type="text/javascript">
    function showhidecode()
    {
        $('#promo_code').show();
        $('#hv_coupon').css('display','none');
    }
    jQuery(document).ready(function() {
        jQuery('.mastercourses .slider').slick({
            dots: true,
            infinite: true,
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: 3,
            autoplay: false,
        });

        var plansblock = jQuery('.plansblock');
            var right_block_plan = jQuery('.right-block-plan');
            var start_learning_btn_page = jQuery('.right-block-plan .start_learning_btn_page');
            plansblock.on('click', '.changeplan', function () {
                var $this = jQuery(this);
                plansblock.find('.changeplan.active').removeClass("active");
                $this.addClass("active");
                plansblock.find('.radio.checked').html("");
                plansblock.find('.radio.checked').removeClass('checked').addClass('unchecked');
                if ($this.find('.unchecked').length == 1) {
                    $this.find('.unchecked').replaceWith('<span class="radio checked"><i class="fa fa-check" aria-hidden="true"></i></span>');

                    start_learning_btn_page.html("Get Subscription @ " + $this.find('.priceamount').data('price'))
                }

                setCookie("selected_subscription_plan", plansblock.find('.changeplan.active').data('id'), 1);

                right_block_plan.find('.message a').click();
            });
    });
    </script>
</body>

</html>