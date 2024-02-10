<section class="breadcrumb">
  <div class="container">
    <div class="row">
      <div class="hed_ban_stk"> <a style="float:left; margin-left:10px;" href="<?php echo base_url();?>programs/lectures/<?php echo $this->uri->segment(3);?>" class="btn">Back To Course</a>
        <h2 style="float: none; margin: 10px auto;">
          <?php
echo $programname;
?>
        </h2>
      </div>
    </div>
  </div>
</section>
<section class="container courses">
  <div class="row-fluided">
    <div id="system-message-container"></div>
    <div class="coursedetailpage"> 
      
      <!-------------Left-Section-Start---------------------- -->
      <div class="span7">
        <div class="cont_mid">
        <div class="coursebannerinner">
        <div class="stu-tak">
        <div class="sect_head">
            <h4 style="float:left;"> STUDENTS TAKING THIS COURSE </h4>
            <input type='search_student' name='search_student' id='search_student' placeholder='Search By Name' class="search_box_stud">
        </div>
        <?php
$CI = & get_instance();
$CI->load->model('program_model');
?>
        <div class="clr"></div>
        <hr style="margin: 10px 0;"/>
        <ul class="users-container">
        <?php
		if($students)
		{
			foreach($students as $stud)
			{			
				$user = $this->program_model->getStudentsInfo($stud['userid']);
			
				if (!empty($user)) 
				{
					$user_image = $user->images ? $user->images : 'temp.jpg';
					?>
					<li class="student-list"> <a href=""> <span class="bordered-thumb"><img border="0" alt="" src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $user_image;?>"></span> </a>
						<h4 style="float:left;"><?php echo ucfirst($user->first_name).' '.$user->last_name; ?></h4>
						<span class="btn-wrapper" style="float:right;"> <a href="#" class="btn btn-info">Follow</a> <a href="#" class="btn">Message</a> </span> </li>
					<?php
				}
			}
		}
		?>
              </ul>
              <div class="more"> <a class="btn" href="javascript:void(0)">Load More</a> <span class="ajax-loader-tiny" style="display: none;"></span> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
