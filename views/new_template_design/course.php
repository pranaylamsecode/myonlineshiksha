<?php // print_r($program); 
$CI = & get_instance();
// $CI->load->model('customs_model');
$CI->load->view('new_template_design/header'); ?>

    <body style="background: #fff none repeat scroll 0% 0%;">
        <?php if(@$Pcategory){ ?>
            <!-- responsive menu -->
            <nav class="navbar course_navbar navbar2">
                <div class="container">
                    <div class="navbar-header">
                        <ul class="nav navbar-nav second_nav">
                            <li class=""><a href="#"><strong> <?php  echo $Pcategory->name; ?></strong></a></li>
                            <?php  
                               foreach ($subcategory as $key => $subcat) { ?>
                                <li class=""><a href="<?php echo base_url() ?>category/course/<?php echo $subcat->slug; ?>/<?php echo $Pcategory->id;  ?>"><?php  echo $subcat->name; ?></a></li>
                                <?php } ?>
                        </ul>
                    </div>
                    <div class="three_dots">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </div>
                  </div>
                </nav>
                <div class="container-fluid course_dark-bg dark-bg">
                    <div class="container second_section1">
                        <div class="col-sm-12">
                            <h3 class="big_head"><?php echo $Pcategory->name; ?></h3>
                        </div>
                    </div>
                </div>
                <div class="container course_container123 course_container">
                    <?php
                   $courses = $this->customs_model->toprateCourse1($Pcategory->id,0);
                       if($courses){ ?>
                    <section class="first_slider">
                        <input type="hidden" class="catid" name="cat_id" value="<?php echo $Pcategory->id; ?> ">
                        <input type="hidden" class="coursetype" name="coursetype" value="top">
                        <div id="myCarouselWrapper" class="container-fluid fullwidth-slider-sect">
                            <div id="myCarousel1" class="carousel slide" data-interval="false">
                                <h4>Top Courses in "<?php echo $Pcategory->name; ?>"</h4>
                                <div class="carousel-inner" role="listbox">
                                    <?php 
                                      $rows = count($courses);
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
                                      echo "<div class='item active'>";
                                      foreach ($courses as $othercourse) { 
                                        $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
                                              $catid = $this->category_model->getCatSlugbyId($othercourse->catid);

                                        ?>
                                        <div class="item-item col-md-3 col-sm-4 col-xs-6  res_col ">
                                            <a href="<?php echo base_url() ?><?php echo $catid.'/category/'.$othercourse->slug; ?>">
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
                                                        <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'FREE'; } ?></span>
                                                            <?php if($othercourse->demoprice >0){ ?>
                                                                <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                                                                </span>
                                                                <?php } ?>
                                                        </p>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                        } echo "</div>";
                                    if($rows > 4){
                                    ?>
                                </div>
                                <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control Cslider1" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="responsive-slider-sect">
                            <h4>Top Courses in "<?php echo $Pcategory->name; ?>"</h4>
                            <div class="inner_responsive_slider">
                                <?php foreach ($courses as $othercourse) {     
                                $catid = $this->category_model->getCatSlugbyId($othercourse->catid);
                                ?>
                                    <div class="responsive-main-slider-sect col-sm-12">
                                        <a href="<?php echo base_url() ?><?php echo $catid.'/category/'.$othercourse->slug; ?>">
                                            <div class="resposive_txt">
                                                <div class="cardhover">
                                                    <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%">
                                                    <div class="overlay"></div>
                                                </div>
                                                <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
                                                <?php 
                                                  $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author); 
                                                 ?>
                                                    <p class="jonas">
                                                        <?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?>
                                                    </p>
                                                    <?php 
                                                       $reviews = $CI->program_model->getAllReview($othercourse->id);
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
                                                        <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'FREE'; } ?></span>
                                                            <?php if($othercourse->demoprice >0){ ?>
                                                                <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                                                                </span>
                                                                <?php } ?>
                                                        </p>
                                            </div>
                                        </a>
                                    </div>
                                    <?php } ?>
                                        <?php  $count_course = $this->customs_model->toprateCourse($Pcategory->id); ?>
                                    </div>
                                    <?php if(count($count_course) >4){ ?>
                                        <div class="text-center col-sm-12">
                                            <button data-purpose="load-more-btn" type="button" id="load-more-btn1" class="load-more-btn btn btn-default">See More<span class="udi-small udi udi-chevron-down"></span></button>
                                        </div>
                                        <?php } ?>
                                </div>
                              </section>
                              <?php
                            }
                            if($cate){ ?>
                          <section class="second_slider">
                              <input type="hidden" class="catid" name="cat_id" value="<?php echo $Pcategory->id; ?> ">
                              <input type="hidden" class="coursetype" name="coursetype" value="new">
                              <div id="myCarouselWrapper" class="fullwidth-slider-sect container-fluid">
                                  <div id="myCarousel2" class="carousel slide" data-interval="false">
                                      <h4>New And Noteworthy in "<?php echo $Pcategory->name; ?>"</h4>
                                      <div class="carousel-inner" role="listbox">
                                          <?php $courses2 = $CI->customs_model->getcategories1($Pcategory->id, 0); 
                                          if($courses2){
                                              $rows = count($courses2);
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
                                              echo "<div class='item active'>";
                                              foreach ($courses2 as $othercourse) { 
                                                $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
                                                      $catid = $this->category_model->getCatSlugbyId($othercourse->catid);
                                                ?>
                                              <div class="item-item col-md-3 col-sm-3 col-xs-6 res_col ">
                                                  <a href="<?php echo base_url() ?><?php echo $catid.'/category/'.$othercourse->slug; ?>">
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
                                                              <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'FREE'; } ?></span>
                                                                  <?php if($othercourse->demoprice >0){ ?>
                                                                      <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                                                                      </span>
                                                                      <?php } ?>
                                                              </p>
                                                      </div>
                                                  </a>
                                              </div>
                                              <?php
                                                } echo "</div>";
                                            if($rows > 4){
                                            ?>
                                      </div>
                                      <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
                                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                          <span class="sr-only">Previous</span>
                                      </a>
                                      <a class="right carousel-control Cslider2" href="#myCarousel2" role="button" data-slide="next">
                                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                          <span class="sr-only">Next</span>
                                      </a>
                                      <?php } ?>
                                  </div>
                              </div>
                              <div class="responsive-slider-sect">
                                  <h4>New And Noteworthy in "<?php echo $Pcategory->name; ?>"</h4>
                                  <div class="inner_responsive_slider">
                                      <?php foreach ($courses2 as $othercourse) {   
                                        $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author);
                                        $catid = $this->category_model->getCatSlugbyId($othercourse->catid);  ?>
                                          <div class="responsive-main-slider-sect col-sm-12">
                                              <a href="<?php echo base_url() ?><?php echo $catid.'/category/'.$othercourse->slug; ?>">
                                                  <div class="resposive_txt">
                                                      <div class="cardhover">
                                                          <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/<?php echo $othercourse->image ? $othercourse->image : 'no_images_course.png'; ?>" width="100%">
                                                          <div class="overlay"></div>
                                                      </div>
                                                      <h5 class="card_heading2"><?php echo $othercourse->name; ?></h5>
                                                      <?php 
                                                        $teacher_info = $CI->program_model->getTeacherInfo($othercourse->author); // } ?>
                                                          <p class="jonas">
                                                              <?php echo ucfirst($teacher_info->first_name)." ".ucfirst($teacher_info->last_name); ?>
                                                          </p>
                                                          <?php 
                                                             $reviews = $CI->program_model->getAllReview($othercourse->id);
                                                             $rcount = 0;
                                                             foreach ($reviews as $review) {
                                                              $rcount = $rcount + $review->review_rate;     
                                                            }
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
                                                              <p class="rupees" align="right"><span class="del_price"><?php if($othercourse->fixedrate > 0){ echo $currency_symbol.' '.$othercourse->fixedrate; } else { echo 'FREE'; } ?></span>
                                                                  <?php if($othercourse->demoprice >0){ ?>
                                                                      <span class="del_price2"><?php echo $currency_symbol.' '.$othercourse->demoprice; ?>
                                                                      </span>
                                                                      <?php } ?>
                                                              </p>
                                                  </div>
                                              </a>
                                          </div>
                                          <?php } ?>
                                              <?php  $count_course = $this->customs_model->getcategories($Pcategory->id); 
                                              ?>
                                  </div>
                                  <?php if(count($count_course) >4){ ?>
                                      <div class="text-center col-sm-12">
                                          <button data-purpose="load-more-btn" type="button" id="load-more-btn2" class="load-more-btn btn btn-default">See More<span class="udi-small udi udi-chevron-down"></span></button>
                                      </div>
                                      <?php } ?>
                              </div>
                          </section>
                          <?php } 
                          } ?>
                        </div>
                      </div>
                      <!-- hovermodal -->
                      <?php if(empty($subcategory) && empty($courses) && empty($courses2)) 
                      {
                        echo '<div style="padding-top: 0px;
                          padding-bottom: 15px;
                          font-size: 21px;
                          text-align: center;
                          color: red;
                          font-weight: 100;">No more Course found in search...</div> ';
                      }
                     }
                    else { ?>
                                    <div style="padding-top: 0px;
                        padding-bottom: 15px;
                        font-size: 21px;
                        text-align: center;
                        color: red;
                        font-weight: 100;">Search not found!!! </div>
                                    <?php } ?>
              </body>
              <?php $CI->load->view('new_template_design/footer');  ?>
              <script>
                  $(document).on('click', '.Cslider1', function() {
                      var catid = $(this).parent().parent().parent().find('.catid').val();
                      var coursetype = $(this).parent().parent().parent().find('.coursetype').val();
                      var start = $(this).parent().find('.carousel-inner').find('.startlimit').val();
                      var chk = $(this).is('.left');
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
                                  $('.Cslider1').parent().parent().parent().find('.carousel-inner').find('.active').removeClass('active');
                                  $('.Cslider1').parent().parent().parent().find('.carousel-inner').find('.startlimit').remove();
                                  $('.Cslider1').parent().parent().parent().find('.carousel-inner').append(data);
                                  var start1 = $('.Cslider1').parent().parent().parent().find('.carousel-inner').find('.startlimit').val();
                              }
                              console.log(data);
                          },
                      });
                  });
                  $(document).on('click', '.Cslider2', function() {
                      var catid = $(this).parent().parent().parent().find('.catid').val();
                      var coursetype = $(this).parent().parent().parent().find('.coursetype').val();
                      var start = $(this).parent().find('.carousel-inner').find('.startlimit').val();
                      var chk = $(this).is('.left');
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
                                  $('.Cslider2').parent().parent().parent().find('.carousel-inner').find('.active').removeClass('active');
                                  $('.Cslider2').parent().parent().parent().find('.carousel-inner').find('.startlimit').remove();
                                  $('.Cslider2').parent().parent().parent().find('.carousel-inner').append(data);
                                  var start1 = $('.Cslider2').parent().parent().parent().find('.carousel-inner').find('.startlimit').val();
                              }
                          },
                      });
                  });
              </script>
              <script>
                  $(document).on('click', '.load-more-btn', function() {
                      var btn_id = $(this).attr('id');
                      var catid = $('#' + btn_id).parent().parent().parent().find('.catid').val();
                      var coursetype = $('#' + btn_id).parent().parent().parent().find('.coursetype').val();
                      $.ajax({
                          url: "<?php echo base_url();?>category/getMore",
                          type: "POST",
                          data: {
                              catid: catid,
                              coursetype: coursetype
                          },
                          success: function(data) {
                              if (data) {
                                  $('#' + btn_id).parent().parent().find('.inner_responsive_slider').append(data);
                                  $('#' + btn_id).hide();
                              }
                          },
                      });
                  });
              </script>
            </html>