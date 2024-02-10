<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/new_template/css/courses.css');?>">
<span id="demo_cookie" style="display: none;"><?php echo $demo_cookie; ?></span>
<div class="container-fluid course_dark-bg dark-bg">
    <div class="container second_section1">
        <div class="col-sm-12">
            <h3 class="big_head">Courses</h3>
        </div>
    </div>
</div>
<style type="text/css">
    
  .home-items a{
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
  .home-items a.btn-hs:hover,.home-items a.btn-hs.actives{
    color: #fff;
    background-color: #E5503F;
  }
  .all_coursesss{
    display: inline-block;
    padding-top: 30px;
    width: 100%;
  }
  .home-items .btn-divs{
    padding-bottom: 20px;
    text-align: center;
  }
</style>
<div class="all_coursesss">
    <div class="home-items col-md-12 col-sm-12 col-xs-12">
        <div class="btn-divs">
            <?php $uri3 = $this->uri->segment(3);?>
            <a type="button" class="btn-hs <?php if($uri3 == '9th-Class-CBSE') { echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/9th-Class-CBSE">Class 9th</a>
            <a type="button" class="btn-hs <?php if($uri3 == '10th-Class-CBSE') { echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/10th-Class-CBSE">Class 10th</a>
            <a type="button" class="btn-hs <?php if($uri3 == '11th-Class-CBSE') { echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/11th-Class-CBSE">Class 11th</a>
            <a type="button" class="btn-hs <?php if($uri3 == 'class-12th') { echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/class-12th">Class 12th</a>
            <a type="button" class="btn-hs <?php if($uri3 == 'jee-mains') { echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/jee-mains">IIT JEE</a>
            <a type="button" class="btn-hs <?php if($uri3 == 'neet') { echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/neet">NEET / AIIMS</a>
            <a type="button" class="btn-hs <?php if($uri3 == 'professional-courses') { echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/professional-courses">Professionals</a>
            <a type="button" class="btn-hs <?php if($uri3 == 'it-software'){ echo 'actives';} ?>" href="<?php echo base_url();?>category/courses/it-software">IT Courses</a>
        </div>
    </div>
</div>
<div class="container courses_slider main-container">
    <div class="row sort_course">
	  	<div class="col-md-3 col-sm-4 col-xs-6 form-group">
	    	<label>Sort by Teacher</label>
	    	<select class="form-control" id="teacher_id" onchange="return sort_teacher(this.value);">
	      		<option value="">Select Teacher</option>
				<?php if(!empty($teacher)){
				foreach ($teacher as $key) { ?>
				<option value="<?= $key->id; ?>"><?= $key->first_name." ".$key->last_name; ?></option>
	     		<?php } } ?>
	    	</select>
	  	</div>
	</div>
    <div class="all_courses">
        <div class="row" id="search_msg">
        <?php
        if($searchCourse){
        if (!empty($searchCourse) && $total_rows !=0) { ?>
            <div class="item-item col-md-12 res_col no-padding1" style="line-height:3">
                <span style="font-size:16px;"><b><?php echo $total_rows; ?></b> Results Found for "<b><?php echo $searchCourse; ?></b>" searches....</span>
            </div>       
        <?php } else{ ?>
        <div class="item-item col-md-7 col-xs-12 res_col no-padding1 no_data">
                <p style="font-size:24px;"> Sorry, we couldn't find any results for "<b><?php echo $searchCourse; ?></b>"</p><br>
            
            <div class="item-item col-md-12 col-xs-12 col-sm-12 res_col no-padding1">
                <span id="no_data">Try adjusting your search. Here are some ideas:</span>
                <ul class="no-result-page">
                    <li><span>Make sure all words are spelled correctly.</span></li>
                    <li><span>Try different search terms.</span></li>
                    <li><span>Try more general search terms.</span></li>
                </ul>
            </div>
            </div>
            <div class="item-item col-md-5 col-xs-12 col-sm-12 res_col no-padding1 datahide">
                <img src="<?php echo base_url();?>public/uploads/logo/search-icon.png" width="50%">
            </div>
        <?php } }
        ?>
        </div>
        <div class="item active">        
            <div id="load_data"></div>
            </div>
            </div>
            <div id="load_data_message"></div>
                <div class="popular popular1">
                    <div class="col-sm-12 no-padding">
                        <h2>Popular Categories</h2>
                    </div>
                    <div class="row">
                        <ul>
                        <?php 
                        $catlist = $this->customs_model->getAllcategory();
                        foreach ($catlist as $Clist) { ?>
                            <li class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                                <a class="course_name" href="<?php echo base_url() ?>category/courses/<?php echo $Clist->slug; ?>">
                                    <div><?php echo $Clist->name; ?></div>
                                </a>
                            </li>
                        <?php } ?>
                        <input type="hidden" name="popular_Cat" id="popular_Cat" value="<?php if ($popular_Cat){ echo $popular_Cat;} ?>">
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12" id="instructor-business-section">
                    <div class="col-sm-6" id="instructor">
                        <h2>Become an Teacher</h2>
                        <p>Teach what you love. MyOnlineShiksha gives you
                            <br>the tools to create an online course.</p>
                        <div class="non-student-cta__link">
                            <a href="<?= base_url();?>become-a-teacher" class="btn btn-primary">Start teaching</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h2>Unlimited Learning</h2>
                        <p>Get unlimited access to 100+ of MyOnlineShiksha’s
                            <br>top courses for your team.</p>
                        <div class="non-student-cta__link">
                            <a rel="leanModal" href="#registration" class="btn btn-primary">Join MyOnlineShiksha</a>
                        </div>
                    </div>
                </div>
              </div>
            <!-- container_middle -->
<?php $this->load->view('new_template_design/footer'); ?>
<script type="text/javascript" src="<?php echo base_url();?>public/new_template/js/courses.js"></script>
</body>
</html>