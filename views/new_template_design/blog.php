<?php 
$CI = & get_instance();
$CI->load->view('new_template_design/header'); ?>

    <body style="">
        <div class="container-fluid banner-section_story">
            <nav class="navbar visible-lg visible-md" id="banner_menu">
                <ul class="nav navbar-nav upper-menu">
                    <li><a href="<?php echo base_url() ?>">Home</a></li>
                    <li><a href="<?php echo base_url() ?>about">About Us</a></li>
                    <li><a href="<?php echo base_url() ?>category/courses">Course</a></li>
                    <li class="active"><a href="<?php echo base_url() ?>blog">Blog</a></li>
                    <li><a href="<?php echo base_url() ?>become-a-teacher">Teaching</a></li>
                </ul>
            </nav>

            <div class="section-text press-head">
                <h1 class="press-tittle story-title">Insights, ideas and stories</h1>
            </div>
        </div>
        <div class="container main-container blog_container">
            <div class="two-section col-sm-12 section-story">

                <?php
                  $CI->load->model('admin/settings_model'); 
                  $attributes = array('class' => 'tform', 'id' => 'user_profile', 'name' => 'user_profile');
                  echo form_open('myinfo/myaccount', $attributes);
                  ?>
                                      <div class="col-sm-9 ">
                                          <?php 
                  if(!empty($blogs))
                  {
                  foreach($blogs as $eachblog)
                  {
                  ?>
                            <div class="col-sm-12 blog_left_content_sect">
                                <div class="full-text-section">
                                    <div class="post-date meta-info"> <i class="entypo-calendar"></i>
                                        <?php echo "Posted ".date('d F Y',strtotime($eachblog->date)); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-3">
                                        <span class=""> <img src="<?php echo base_url(); ?>public/new_template/images/story1.jpg" class="img-responsive"></span>
                                    </div>
                                    <div class="col-md-10 col-sm-9 col-xs-9 story-text">
                                        <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $eachblog->id; ?>"><h3 class="story__title"><?php  echo $eachblog->title;?></h3></a>
                                        <p>
                                            <?php

                                               $blogdataarr=json_decode($eachblog->post);

                                               $blogdataarr->description;

                                               $little_excerpt = substr($blogdataarr->description,0,350);

                                                       echo"<br/>";

                                                       echo $little_excerpt ;

                                              ?>
                                                <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $eachblog->id; ?>">
                    Read More..</a></p>
                                        <div class="post_tags">
                                            <a href="#" rel="tag">development</a>
                                            <a href="#" rel="tag">stories</a>
                                            <a href="#" rel="tag">technology</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                               }
                            }
                            else
                            {
                            ?>
                                <div style="padding-top: 20px;font-size: -webkit-xxx-large;">No Blogs</div>
                                <?php
                                }
                                ?>
                    </div>
                    <div class="col-sm-3 inner_right_sect">
                        <div class="col-sm-12 inner_recent_sect">
                            <div class="col-sm-12 bp">
                                <div class="sidebar">
                                    <h3> <i class="entypo-list"></i> Blog List </h3>
                                    <div class="sidebar-content">
                                        <ul>
                                            <?php
                                                  if(!empty($blogs))
                                                    {
                                                    foreach($blogs as $eachblog)
                                                    {                     
                                               ?>
                                                <li> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $eachblog->id; ?>"><?php  echo $eachblog->title;?></a> </li>
                                                <?php                      
                                                      }
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <li> No Blogs </li>
                                                      <?php
                                                      }
                                                    ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar">
                                    <h3> <i class="entypo-chat"></i> Recent Comments </h3>
                                    <div class="sidebar-content">
                                        <ul class="discussion-list">
                                            <?php
                                            if($blogs)
                                            {
                                             if($recentComments)
                                             {
                                              foreach($recentComments as $comments)
                                              {
                                                $dataComment = json_decode($comments['comment_data']);      
                                                $getImageMy = $CI->settings_model->getUserImage($comments['comment_by']);
                                                $my_image = $getImageMy[0]->images;       
                                                ?>
                                                <li> <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $comments['blog_id']; ?>" class="thumb"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $my_image;?>" alt="" class="img-circle" width="30"> </a>
                                                    <div class="details">
                                                        <a href="<?php echo base_url(); ?>blogs/blogDetailview/<?php echo $comments['blog_id']; ?>">
                                                            <?php echo $comments['first_name'];?>
                                                        </a>
                                                        <p>
                                                            <?php echo $dataComment->cdesc;?>
                                                        </p>
                                                    </div>
                                                </li>
                                                <?php
                                                  }
                                                }
                                                else
                                                {
                                                ?>

                                                    <li>
                                                        <div>No Recent Comments.</div>
                                                    </li>

                                                    <?php
                                                      }
                                                    }
                                                    else
                                                    {

                                                      ?>
                                                        <li>
                                                            <div>No Blogs.</div>
                                                        </li>
                                                        <?php
                                                        }
                                                          ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <ul class="p_blog__categories">
                                <li class="cat-item-all"><a href="">All</a></li>
                                <li class="cat-item cat-item-223"><a href="">Students</a></li>
                                <li class="cat-item cat-item-222"><a href="">Instructors</a></li>
                                <li class="cat-item cat-item-244"><a href="">Ideas &amp; Opinions</a></li>
                                <li class="cat-item cat-item-353"><a href="">MyOnlineShiksha News</a></li>
                                <li class="cat-item cat-item-221"><a href="">MyOnlineShiksha for Business</a></li>
                                <li class="cat-item cat-item-227"><a href="">Social Innovation</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 main_pagination_sect">
                        <div class="col-sm-12">
                            <nav class="navigation pagination" role="navigation">
                                <h2 class="screen-reader-text">Posts navigation</h2>
                                <div class="nav-links">
                                    <a class="prev page-numbers" href=""><i class="fa fa-chevron-left"></i></a>
                                    <span aria-current="page" class="page-numbers current">1</span>
                                    <a class="page-numbers" href="">2</a>
                                    <a class="page-numbers" href="">3</a>
                                    <a class="page-numbers" href="">4</a>
                                    <a class="next page-numbers" href=""><i class="fa fa-chevron-right"></i></a>
                                </div>
                            </nav>
                        </div>
                    </div> -->
            </div>
            <?php echo form_close();?>
                <script>
                    function post_comment_win(ele) {
                        var id1 = ele.title;
                        $(ele).css('display', 'none');
                        $('#pc_' + id1).css('display', 'block');
                    }

                    function close_post_comment(id) {
                        $('#pc_' + id).css('display', 'none');
                        $('#comment_btn_' + id).css('display', 'block');
                    }

                    function post_comment(id, cby) {
                        var commentcontent = $('#comment_' + id).val();
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('blogs/post_comment_process'); ?>",
                            data: {
                                comment: commentcontent,
                                bid: id,
                                cby: cby
                            },
                            success: function(msg) {
                                if (msg.substring(1, 7) != 'script') {
                                    $("#ajax").html(msg);
                                } else {
                                    $("#ajax").html(msg);
                                }
                            }
                        });
                    }
                </script>
                <?php
                  function format_interval(DateInterval $interval) 
                  {
                      $result = "";
                      if ($interval->y) { $result .= $interval->format("%y years "); }
                      if ($interval->m) { $result .= $interval->format("%m months "); }
                      if ($interval->d) { $result .= $interval->format("%d days "); }
                      if ($interval->h) { $result .= $interval->format("%h hours "); }
                      if ($interval->i) { $result .= $interval->format("%i minutes "); }
                      if ($interval->s) { $result .= $interval->format("%s seconds "); }
                      return $result;
                  }
                  ?>
        </div>
        <section></section>
        <?php 
        $CI = & get_instance();
        $CI->load->view('new_template_design/footer'); ?>
            
    </body>

    </html>