<div class="title">Teacher Info</div><?php if(isset($teacher_info) && !empty($teacher_info) && isset($teacher_course) && !empty($teacher_course)){ ?>      <div class="contenta">          <div class="teacher_info">                <div class="teacher_img">                   <?php if($teacher_info->images){?>                      <img hspace="6" align="left" alt="author image" src="<?php echo base_url(); ?>/public/uploads/users/img/thumbs/<?php echo $teacher_info->images; ?>">                          <?php }else{ ?>                          <img src="<?php echo base_url(); ?>public/default/images/no_images.jpg" width="120px" height="120px">                          <?php } ?>                </div>                <div style="float:none;">                    <?php echo $teacher_info->full_bio; ?>                </div>                <h1><?php echo $teacher_info->first_name.' '.$teacher_info->last_name; ?></h1>          </div>          <div class="teacher_links">              <?php if(isset($teacher_info->email) && $teacher_info->email!='') {?>                <span class="teacher_email">                    <a href="mailto:<?php echo $teacher_info->email; ?>">Site</a>                </span>              <?php } ?>              <?php if(isset($teacher_info->website) && $teacher_info->website!='') {?>                <span class="teacher_site">                    <a target="_blank" href="<?php echo $teacher_info->website; ?>">                Website</a>                </span>              <?php } ?>              <?php if(isset($teacher_info->blog) && $teacher_info->blog!='') {?>                <span class="teacher_blog">                    <a target="_blank" href="<?php echo $teacher_info->blog; ?>">                Blog</a>                </span>              <?php } ?>              <?php if(isset($teacher_info->twitter) && $teacher_info->twitter!='') {?>                <span class="teacher_twitter">                    <a target="_blank" href="<?php echo $teacher_info->twitter; ?>">                Twitter</a>                </span>              <?php } ?>              <?php if(isset($teacher_info->facebook) && $teacher_info->facebook!='') {?>                <span class="teacher_facebook">                    <a target="_blank" href="<?php echo $teacher_info->facebook; ?>">                Facebook </a>                </span>              <?php } ?>          </div>          </div>          <div class="contenta">              <div class="teacher_info">              <h3>Courses by this teacher</h3>                  <table class="ultitle">                      <tr>                          <th>Name</th>                          <th>Level</th>                          <th>Release Date</th>                      </tr>                          <?php if ($teacher_course){?>                          <?php                          foreach($teacher_course as $teachercourse){                          ?>                      <tr>                          <td>                               <a href="<?php echo base_url()?>programs/programs/<?php echo $teachercourse->id;?>">                               <?php echo $teachercourse->name; ?>                          </a>                          </td>                          <td>                               <?php                                if($teachercourse->level == 0){                                $imagename = 'level_icon.png';                                }                                if($teachercourse->level == 1){                                $imagename = 'level_intmed_icon.png';                                }                                if($teachercourse->level == 2){                                $imagename = 'level_advance_icon.png';                                }                                ?>                                <img src="<?php echo base_url() ?>public/default/images/<?php echo $imagename; ?>"></td>                           <td>                                <?php echo date('d-m-Y',strtotime($teachercourse->startpublish)); ?>                           </td>                     </tr>                         <?php } ?>                     <?php }else{ ?>                    <tr>                          <td colspan="3">                                <p class='text'>there is no record in the database</p>                          </td>                   </tr>                  <?php } ?>                  </table>              </div>          </div>          <?php }else{            echo "there is no record in the database";          } ?>