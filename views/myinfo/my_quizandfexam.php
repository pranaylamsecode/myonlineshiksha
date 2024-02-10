<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style type="text/css">
  .sidebar-menu.sb-left {
    display: none;
}
#left_menu_sidebar {
  display: none;
}
.sidebar-collapse.sb-toggle-left {
  display: none;
}
.course_search .btn {
    position: absolute;
    top: 0px;
}
.course_search.exam-search-box {
    margin-left: 0px;
    margin-top: 10px;
    float: left;
}
.content.cources_main_content {
    padding: 30px 0px !important;
}
.table_heading {
    display: inline-block;
    width: 100%;
    border-bottom: 1px solid #f2f3f5;
    padding: 10px 0px;
}
.table-row:last-child{
  border:0px !important;
}
.table-row {
    border-bottom: 1px solid #f2f3f5;
    display: inline-block;
    width: 100%;
    padding: 10px 0px !important;
}
.table_heading div {
    padding: 0px 5px 0px 0px;
}
.table-row div {
    padding: 0px 5px 0px 0px;
}
.course_search.exam-search-box select, .course_search.exam-search-box form {
    display: inline-block;
}
.mobile_head {
    display: none;
}
@media(max-width: 767px){
  .mobile_head {
    display: inline-block;
    font-weight: bold;
    font-size: 15px;
}
  .table_heading {
      display: none;
  }
  .course_search .btn {
    position: unset;
    top: 0px;
}
.table-row div {
    padding: 0px 5px 10px 0px;
}
.main-content .course_search.exam-search-box select {
    width: 46%;
    margin-bottom: 15px !important;
    float: left;
    margin-right: 10px !important;
}
}
</style>
<style>
@media (max-width: 900px){
.main-content .course_search {
  margin-bottom: 10px;
  display: block;
  float:none!important;
  }
}
</style>
<div class="page-container myinfo_page">
  <div class="main-content">
    <div class="info_page_breadcrumb">
      <div class="info_container">
        <h3>My Exams</h3>
        <p>Here you can check all your exam result.You can also check the number of attempts available for any particular exam.
        </p>
      </div>
    </div>
    <div class="content cources_main_content">
      <div class="info_container">  
        <div class="course_search exam-search-box">
          <select onchange="document.myquiz.submit();" id="selectcourses" name="selectcourses">
            <option value="0">Select Course</option>
              <?php
              foreach($getid as $get_id){
              $cname = $this->Myinfo_model->getCourses($user_id,$get_id->pid);
              $course_name = (isset($cname->course_name) ? $cname->course_name : '');
              $course_id = (isset($cname->course_id) ? $cname->course_id : '');
              ?>
            <option value="<?php echo $course_id; ?>"><?php echo $course_name; ?></option>
            <?php } ?>
          </select>
          <select onchange="document.myquiz.submit();" id="selecttype" name="selecttype">
            <option value="">Select Type</option>
            <option value="quiz_0">term Exam</option>
            <option value="1">Final Exam</option>
          </select>
          <?php
          $attributes = array('class' => 'tform', 'name' => 'myquiz');
          echo form_open_multipart(base_url().'my-exams/',$attributes);
          ?>
          <input type="text" value="" class="examtxtbox" placeholder="Exams Appeared" name="search_quiz" >
          <button type="submit" name="Submit" value="Submit" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>
        </div>  
          <?php echo form_close(); ?>
        <div class="table-scroll-resp exam-main-table inner_pages_table">
          <div class="table_heading">
            <div class="col-sm-2">Exam</div>
            <div class="col-sm-3">Course</div>
            <div class="col-sm-2">Type</div>
            <div class="col-sm-1">Date</div>
            <div class="col-sm-1">Attempts</div>
            <div class="col-sm-1">Passing(%)</div>
            <div class="col-sm-1">Marks(%)</div>
            <div class="col-sm-1">Result</div>
          </div>
          <?php
          $resultdirect =0;  
          $i=1; 
          foreach($my_quizzes as $my_quiz)
          {
            if($my_quiz->is_final == 1)
            {
              $type = "Final Exam";
            }
            else
            {
              $type = "Term Exam";
            }
            $date_taken =  date('d-m-Y', strtotime($my_quiz->date_taken_quiz));
            $t = $this->Myinfo_model->getExamAttemptNew($my_quiz->user_id,$my_quiz->quiz_id,$my_quiz->pid);            
            $resultdirect = $this->Myinfo_model->getExamdetailsNew($my_quiz->user_id,$my_quiz->quiz_id,$my_quiz->pid);
            $first= explode("|", @$my_quiz->score_quiz);
            @$res = intval(($first[0]/$first[1])*100);
            $result_maxs = $my_quiz->max_score;
            if($res >= $result_maxs || $resultdirect->result == 'Pass' )
            {
              $passfail = '<span  style="color:#04A600;"><i class="entypo entypo-thumbs-up"></i>Passed</span>';
            }
            else if($resultdirect->result == 'Pending')
            {
              $passfail = '<span  style="color:#cc2424;"><i class="entypo entypo-clock"></i>Pending</span>';
            }
            else
            {
              $passfail = '<span  style="color:#cc2424;"><i class="entypo entypo-thumbs-down"></i>Failed</span>';
            }
            $urlCourse = strtolower($my_quiz->pname);     
            $urlCourse = trim(str_replace(' ', '-', $urlCourse));
            $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
          ?>
          <div class="col-sm-2">Exam</div>
            <div class="col-sm-3">Course</div>
            <div class="col-sm-2">Type</div>
            <div class="col-sm-1">Date</div>
            <div class="col-sm-1">Attempts</div>
            <div class="col-sm-1">Passing(%)</div>
            <div class="col-sm-1">Marks(%)</div>
            <div class="col-sm-1">Result</div>
          <div class="table-row">
            <div class="product_name col-sm-2"><span class="mobile_head">Exam:&nbsp;</span></div><?php echo $my_quiz->name;?></div>
            <div class="product_name col-sm-3">
              <span class="mobile_head">Course:&nbsp;</span><a href="<?php echo base_url()?><?php echo $urlCourse ?>/lectures/<?php echo $my_quiz->pid; ?>"><?php echo $my_quiz->pname;?></a>
            </div>
            <div class="col-sm-2"><span class="mobile_head">Type:&nbsp;</span><?php echo $type; ?></div>
            <div class="col-sm-1 hidden-sm hidden-xs visible-lg visible-md"><span class="mobile_head">Date:&nbsp;</span><?php echo $date_taken;?></div>
            <div class="col-sm-1">
              <span class="mobile_head">Attempts:&nbsp;</span><?php echo $t." out of ".$my_quiz->time_quiz_taken; ?>
            </div>
            <div class="col-sm-1">
              <span class="mobile_head">Passing:&nbsp;</span><?php echo $my_quiz->max_score."%"; ?>
            </div>
            <div class="col-sm-1">
              <span class="mobile_head">Marks:&nbsp;</span><?php echo $resultdirect->result == 'Pending' ? 'Pending' : $res."% ";?>
            </div>
            <div class="col-sm-1">
              <span class="mobile_head">Result:&nbsp;</span><?php echo $resultdirect->result == 'Pending' ? '<span  style="color:#cc2424;"><i class="entypo entypo-clock"></i>Pending</span>' : $passfail;?>
            </div>
          </div>
          <?php  $i++;  } ?>
          <?php if(!$my_quizzes){ ?>
          <div class="table-row" style="padding-top: 10px;">
            <div class="product_name col-xs-12 col-sm-2"><span class="mobile_head">Exam:&nbsp;</span>Unit Test</div>
            <div class="product_name col-xs-12 col-sm-3"><span class="mobile_head">Course:&nbsp;</span>Learn english हिंदी में </div>
            <div class="col-xs-12 col-sm-2"><span class="mobile_head">Type:&nbsp;</span>Term Exam</div>
            <div class="col-xs-6 col-sm-1"><span class="mobile_head">Date:&nbsp;</span><?php echo date('d-m-Y');?></div>
            <div class="col-xs-6 col-sm-1"><span class="mobile_head">Attempts:&nbsp;</span>1</div>
            <div class="col-xs-6 col-sm-1"><span class="mobile_head">Passing:&nbsp;</span>40</div>
            <div class="col-xs-6 col-sm-1"><span class="mobile_head">Marks:&nbsp;</span>68</div>
            <div class="col-xs-12 col-sm-1"><span class="mobile_head">Result:&nbsp;</span>Pass</div>
            <!-- <span style="padding-left: 20px">No exams appeared yet.</span> -->
          </div>
          <?php } ?>
        </div>
        <div id="rich-text1">
          <div class="weblet-inner">
            <div class="steps-holder">
            </div>
          </div>
        </div>
        <div id="rich-text2">
          <div class="weblet-inner">
          </div>
        </div>
        <div id="rich-text3">
          <div class="weblet-inner">
          </div>
        </div>
        <div id="rich-text4">
          <div class="weblet-inner">
          </div>
        </div>
        <div class="holder2">
          <div class="bottom-boxes">
            <div class="frame">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .data{
   margin:4%; 
   display: none;
  }
</style>
	<script>
  var $ =jQuery.noConflict();
  $(document).ready(function(){
    $('#more').click( function(){
    $(this).find('i').toggleClass(' glyphicon glyphicon-plus').toggleClass('glyphicon glyphicon-minus');
});
					var mySlidebars = new $.slidebars();
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
	</script>