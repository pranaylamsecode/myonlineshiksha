<div id="main" role="main">
  <div class="holder" id="mrp-container2">
      <div id="system-message-container"></div>
         <?php if ($teachers): ?>
          <div class="title">Teachers</div>
            <div class="course_row">
              <ul class="course_cat">
                <?php foreach($teachers as $teacher){
                ?>
                  <li>
                      <div class="catimg">
                          <?php if($teacher->images){?>
                            <a href='<?php echo base_url(); ?>/category/view/<?php echo $teacher->user_id; ?>'>
                                <img src="<?php echo base_url(); ?>/public/uploads/users/img/<?php echo $teacher->images; ?>">
                            </a>
                          <?php } ?>
                      </div>
                      <div class="cattext">
                          <h2>
                                <a href='<?php echo base_url(); ?>teacher/view/<?php echo $teacher->user_id; ?>'><?php echo $teacher->first_name; ?></a>
                          </h2>
                          <div class="smltext">
                                <?php echo character_limiter($teacher->full_bio, 150); ?><p align="right"><a href="<?php echo base_url(); ?>teacher/view/<?php echo $teacher->user_id; ?>">Read more</a></p>
                          </div>
                      </div>
                  </li>
                 <?php } ?>
              </ul>
         </div>
    <?php else: ?>
        <p class='text'><?php echo lang('web_no_elements');?></p>
  <?php endif ?>
  </div>
</div>