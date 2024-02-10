<body style="">
    <style>
        .row {
            margin-right: -10px;
            margin-left: -10px;
        }
    </style>

    <div class="container-fluid course_dark-bg dark-bg">

        <div class="container second_section1">
            <div class="col-sm-12">

                <h3 class="big_head">Courses</h3>

            </div>
        </div>
    </div>
    <div class="container courses_slider main-container">
        <?php

     $CI =& get_instance();
    $CI->load->model('category_model');
    $catlist = $CI->customs_model->getAllcategory();
    $CI->load->model('customs_model'); 

     $allcategory = $CI->customs_model->getAllcategory();

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
        $iii = 0;
         echo "<div class='all_courses'><div class='item active'>";
        foreach ($courses as $othercourse) { 
          $iii++;
          $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
          ?>

        <div class="item-item col-md-3 col-sm-4 col-xs-6  res_col no-padding1">
            <a href="<?php echo base_url() ?><?php echo $othercourse->catid.'/category/'.$othercourse->id; ?>">
                <div class="card">
                    <div class="cardhover">
                        <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%">
                        <div class="overlay">
                            <div class="text">
                                <img src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo $teacher_info->images; ?>" width="50px" height="50px" class="img-thumbnail">

                                <br>
                                <?php  $alllecture = $CI->customs_model->countalllecture($othercourse->id);
                                  echo "<p>".$alllecture->no_lect." Lectures </p>"; 
                                ?>

                            </div>
                        </div>
                    </div>
                    <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
                    <p class="jonas">
                        <?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?>
                    </p>

                    <?php 
                         $reviews = $this->program_model->getAllReview($othercourse->id);
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
                        <p class="rupees" align="right">
                            <span class="del_price"> 
                    <?php if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) >0 ){ echo $currency_symbol.''.$othercourse->demoprice; 
                           }
                           else if(intval($othercourse->fixedrate) <= 0 && intval($othercourse->demoprice) <= 0) { echo "Free"; } 
                           else{ echo $currency_symbol.''.$othercourse->fixedrate; } ?>

                                 <?php if(intval($othercourse->fixedrate) > 0 && intval($othercourse->demoprice) >0){ ?>
                          <span class="del_price2"><?php  if($assigned) { echo ''; } else { echo $currency_symbol.''.$othercourse->demoprice; }
                            ?>     
                          </span>
                            <?php } ?>
                        </p>

                </div>
            </a>
        </div>

        <?php
      } echo "</div></div>";

      if($this->pagination->create_links()) 
      { 
        $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
        $first = $start + 1;
        ?>
            <div class="pagination_course">
                <div class="dataTables_paginate all_courses_paginate paging_bootstrap">
                    <ul class="pagination pagination-sm">
                        <?php echo $this->pagination->create_links(); ?>
                    </ul>
                </div>
            </div>
            <?php } ?>

                <div class="popular popular1">
                    <div class="col-sm-12 no-padding">
                        <h2>Popular Categories</h2>
                    </div>
                    <div class="row">
                        <ul>
                        <?php 
                      foreach ($catlist as $Clist) { ?>

                                            <?php     $subcat = $CI->category_model->subcategory($Clist->id);
                      $catcourse = $CI->customs_model->getcategories($Clist->id); ?>
                            <li class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                <a class="course_name" href="<?php echo base_url() ?>category/course/<?php echo $Clist->slug; ?>">
                                    <div><?php echo $Clist->name; ?></div>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- galler section -->
                <div class="col-sm-12 col-sm-12 achieve_goals" id="first-gallery">
                    <h4>Achieve Your Goals </h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div id="">
                                <img src="<?php echo base_url(); ?>public/new_template/images/g11.jpg">
                            </div>
                            <div class="">
                                <p>Expand Your Programming Knowledge</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div id="">
                                <img src="<?php echo base_url(); ?>public/new_template/images/g12.jpg">
                            </div>
                            <div class="">
                                <p>Be Your Own Boss</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div id="">
                                <img src="<?php echo base_url(); ?>public/new_template/images/g13.jpg">
                            </div>
                            <div class="">
                                <p>Land an Exciting New Tech Job</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- gallery2 -->
                <div class="col-sm-12" id="second-gallery">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div id="">
                                <img src="<?php echo base_url(); ?>public/new_template/images/g21.jpg">
                            </div>
                            <div class="">
                                <p>Indulge Your Curiosity</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div id="">
                                <img src="<?php echo base_url(); ?>public/new_template/images/g22.jpg">
                            </div>
                            <div class="">
                                <p>Invest in Your Passion</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div id="">
                                <img src="<?php echo base_url(); ?>public/new_template/images/g23.jpg">
                            </div>
                            <div class="">
                                <p>Unlock Your Potential</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div id="">
                                <img src="<?php echo base_url(); ?>public/new_template/images/g24.jpg">
                            </div>
                            <div class="">
                                <p>Make Analytics Work for You</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- galler section -->
                <div class="discover_poplr_course col-sm-12">
                    <h4>Discover Our Popular Courses </h4>
                    <div class="row">
                        <div class="col-sm-4 col-sm-4">
                            <div id="blue-topic">
                                <div class="c_topic__name">Top Rated</div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sm-4">
                            <div id="purple-topic">
                                <div class="c_topic__name">Trending</div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sm-4">
                            <div id="cyan-topic">
                                <div class="c_topic__name">New and Noteworthy</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" id="instructor-business-section">
                    <div class="col-sm-6" id="instructor">
                        <h2>Become an Instructor</h2>
                        <p>Teach what you love. MyOnlineShiksha gives you
                            <br>the tools to create an online course.</p>
                        <div class="non-student-cta__link">
                            <a href="" class="btn btn-primary">Start teaching</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h2>Unlimited Learning</h2>
                        <p>Get unlimited access to 100+ of MyOnlineShiksha’s
                            <br>top courses for your team.</p>
                        <div class="non-student-cta__link">
                            <a href="" class="btn btn-primary">Join MyOnlineShiksha</a>
                        </div>
                    </div>
                </div>
              </div>
            <!-- container_middle -->
            <script>
                $(document).on('keyup', '#getlistitem', function() {
                    var input = $('#getlistitem').val();

                    $.ajax({

                        url: "<?php echo base_url();?>/category/getlist",
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
                });
            </script>
        </body>
        <style>
            body {
                background: #f7f8fa;
            }
        </style>

        <script>
            $(document).on('click', '.right', function() {
                var classnm = $(this).attr('class');
                // var tech_id = '';
                var ele = classnm.split(' ');
                var catid = $('.' + ele[2]).parent().parent().parent().find('.catid').val();
                var coursetype = $('.' + ele[2]).parent().parent().parent().find('.coursetype').val();

                var start = $('.' + ele[2]).parent().find('.carousel-inner').find('.startlimit').val();
                var chk = $('.' + ele[2]).is('.left');
                if (chk == true) {
                    if (start > 0) {
                        start = parseInt(start) - 8;
                    }
                }
                $.ajax({

                    url: "<?php echo base_url();?>/category/getAuthSlider",
                    type: "POST",

                    data: {
                        start: start,
                        catid: catid,
                        coursetype: coursetype
                    },
                    success: function(data) {   
                        if (data) {                
                            $('.' + ele[2]).parent().parent().parent().find('.carousel-inner').find('.active').removeClass('active');
                            $('.' + ele[2]).parent().parent().parent().find('.carousel-inner').find('.startlimit').remove();
                            // ('.dynamic_slide')
                            $('.' + ele[2]).parent().parent().parent().find('.carousel-inner').append(data);
                            var start1 = $('.' + ele[2]).parent().find('.carousel-inner').find('.startlimit').val();
                        }
                    },
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.pagination_course li:last-child:not(.active) a').html('<span class="lnr lnr-chevron-right"></span>');
                $('.pagination_course li:first-child:not(.active) a').html('<span class="lnr lnr-chevron-left"></span>');

            });
        </script>

        </html>