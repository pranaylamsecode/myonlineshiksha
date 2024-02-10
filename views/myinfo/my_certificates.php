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
</style>
</style>
<div class="page-container">

<div style="background-color: #F5F5F5;">
<div class="sidebar-menu sb-left">
<!-- Your left Slidebar content. -->
<!-- Classes Examples -->
	<ul id="main-menu">
    <li class="root-level"><a href="<?php echo base_url(); ?>my-account">My Account</a></li>
    <li class="root-level"><a href="<?php echo base_url(); ?>my-courses">My Courses</a></li>
    <li class="root-level"><a href="<?php echo base_url(); ?>my-orders">My Orders</a></li> 
    <li class="root-level"><a href="<?php echo base_url(); ?>my-exams">My Exams</a></li>
    <li class="root-level"><a href="<?php echo base_url(); ?>my-certificates">My Certificates</a></li>
  </ul>
</div>

<div class="main-content">
	<div class="row">

    <div class="holder" id="mrp-container2">
<div id="system-message-container"></div>



<div class="content cources_main_content">

<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0px; margin-right: 20px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<p class="right_course_txt" style="padding: 0 10px;font-style: italic;"> Here you can view the status of the certifications of the courses taken by you.</p>



<?php
$attributes = array('class' => 'tform', 'name' => 'myquiz');
// echo form_open_multipart('myinfo/mycertificates/',$attributes);
echo form_open_multipart(base_url().'my-certificates/',$attributes);
?>

<div class="clr"></div>

<div class="course_search certificate_search" style="float:right; margin-top: 20px;  margin-right: 0px;">
    <input type="text" placeholder="Certificate Title" value="" name="search_certificates" class="textbox" style="float:left; margin-right:10px; height:30px;">
    <button type="submit" name="Submit" value="Search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>
</div>
<?php echo form_close(); ?>

<div class="clr"></div>
<div class="table-scroll-resp exam-main-table inner_pages_table">
<table class="table table-bordered responsive">
<thead>
    <tr>
        <th style="width: 338px;">Courses Name</th>
        <th style="width: 294px;">Criteria of Certificate</th>
        <th style="width: 95px;" class="">Lectures completed?</th>
        <th style="width: 133px;" class="">Average Marks in Terms Exams</th>
        <th style="width: 126px;" class="">Final Exam Marks</th>
        <th style="width: 120px;">Certificate</th>
        <!-- <th style="width: 145px;" class="hidden-lg hidden-md visible-sm visible-xs ">View More</th> -->
    </tr>
</thead>

<tbody>
      <?php
      $i = 1;
      $courseidslist = $this->Myinfo_model->getCourseidsList($user_id);
      foreach($courses as $course){ //print_r($course);
      $course_id=$course->course_id;

      //final Quiz Score
      $scores_avg_quizzes =   $this->Myinfo_model->getAvgScoresQ($user_id,$course_id);
      $avg_quizzes_cert =   $this->Myinfo_model->getAvgpercert();
      //$avg_quizzes_cert = $getAvgpercert->avg_cert;
      //final Quiz
      //result Score
      $getquizcourses = $this->Myinfo_model->getQuizCourses($course_id);

      $nb_ofscores = (isset($getquizcourses->hasquiz)) ? $getquizcourses->hasquiz : '';

      $id_final_exam = (isset($getquizcourses->id_final_exam)) ? $getquizcourses->id_final_exam : '';

      $get_max_score = $this->Myinfo_model->getMaxScore($id_final_exam);

      //$max_score = $get_max_score->max_score;

      $getmaxscore = (isset($get_max_score->max_score)) ? $get_max_score->max_score : '';

      $get_QuizScore =   $this->Myinfo_model->getQuizScore($user_id,$course_id,$id_final_exam);

      $res = '';

      foreach($get_QuizScore as $getQuizScore)
      {
        $score_quiz = (isset($getQuizScore->score_quiz)) ? $getQuizScore->score_quiz : '';
        $first= explode("|", $score_quiz);
        @$res = intval(($first[0]/$first[1])*100);
      }

      $certterm = $course->certerm;
      $urlCourse = $course->slug;     
      // $urlCourse = strtolower($course->course_name);     
      // $urlCourse = trim(str_replace(' ', '-', $urlCourse));
      // $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
      ?>

      <tr>
        <!-- <td><a href="<?php echo base_url();?>programs/programs/<?php echo $course->course_id ?>"><?php echo $course->course_name;?></a></td> -->
        <td class="product_name"><a href="<?php echo base_url();?><?php echo $urlCourse ?>/lectures/<?php echo $course->course_id ?>"><?php echo $course->course_name;?></a></td>
        <td>
            <?php
            if($certterm == 1)
            {
                $details = 'No Certificate';
            }
            elseif($certterm == 2)
            {
                $details = 'Complete all the lessons';
            }
            elseif($certterm == 3)
            {
                $details = 'Pass the final exam';
            }
            elseif($certterm == 4)
            {
                $details = 'Pass the Exams In Average';
            }
            elseif($certterm == 5)
            {
                $details = 'Finish all lessons and pass final exam';
            }
            elseif($certterm == 6)
            {
                $details = 'Finish all lessons and pass Exams In Average';
            }
            echo $details; 
            ?>
           
      </td>
      <td class="">
            <?php
             $coursecompleted = $this->Myinfo_model->courseCompleted111($user_id,$course_id);
            if($coursecompleted==false){ echo $coursecompleted;}
            //if(isset($completedprogress->completed) && $completedprogress->completed == '1' ){
            if(isset($coursecompleted) && $coursecompleted == true){
            echo '<span  style="color:#04A600;">Yes</span>';
            }
            else{
            echo '<span  style="color:#cc2424;">No</span>';
            }
            ?>
      </td>
      <td class="">
          <?php
          if($nb_ofscores == 0 && $scores_avg_quizzes == ""){
          echo "No Exams";
          }
          elseif($nb_ofscores != 0 && $scores_avg_quizzes == ""){
          echo "Not Taken";
          }
          elseif($nb_ofscores != 0 && isset($scores_avg_quizzes))
          {          
            $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;
            if($scores_avg_quizzes >= intval($getmax_score)){

            echo $scores_avg_quizzes.'% '.'<span  style="color:#04A600;">Pass</span>';
            }
            else{
            echo $scores_avg_quizzes.'% '.'<span  style="color:#cc2424;">Failed</span>';
            }
          }
          ?>
      </td>

      <td class="">
          <?php
          //if(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && $res !="" ){

          if(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && isset($res) && $res!='')
          {
            if($res >= $getmaxscore)
            {
                echo $res.'% '.'<span  style="color:#04A600;">Passed</span>';
            }
            elseif($res < $getmaxscore)
            {
                echo $res.'% '.'<span  style="color:#FF0000;">Failed</span>';
            }
          }
          /*elseif(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && $getquizcourses->id_final_exam !=""){
          }*/
          elseif(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam == 0 || isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam =="")
          {
            echo "No Final Exam";
          }
          elseif(empty($getquizcourses) || isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && $res==''){
          echo "Not Taken";
          //echo $scores_avg_quizzes;
          }
          ?>
      </td>

          <?php

          //--------------hascertificate calculation-------------------

          if($certterm == 1){

            $hascertficate = "false";



          }

          if($certterm == 2){

          if(isset($coursecompleted) && $coursecompleted == '1'){

          $hascertficate = "true";

          }

          else{

          $hascertficate = "false";

          }

         // echo $hascertficate;

          }

          elseif($certterm == 3){



          //if( $res >= intval($getmaxscore->max_score)){



          if(isset($res) && $res!='' && isset($getmaxscore) && $getmaxscore!='' && $res >= $getmaxscore){

          $hascertficate = "true";

          }

          else{

          $hascertficate = "false";

          }

          //echo $hascertficate;

          }

          elseif($certterm == 4){

          if($scores_avg_quizzes >= intval($avg_quizzes_cert)){

          $hascertficate = "true";

          }

          else{

          $hascertficate = "false";

          }

          }

          elseif($certterm == 5){



          if(isset($coursecompleted) && $coursecompleted=='1' && isset($getmaxscore) && $res >= intval($getmaxscore)){

            $hascertficate = "true";

          }

          else{

            $hascertficate = "false";

          }

          }

          elseif($certterm == 6){

            //echo $scores_avg_quizzes;

           // echo $avg_quizzes_cert;

           // echo $coursecompleted->completed;

          if(isset($coursecompleted) && $coursecompleted =='1' && isset($scores_avg_quizzes) && ($scores_avg_quizzes >= intval($avg_quizzes_cert))){

          $hascertficate = "true";

          }

          else{

          $hascertficate = "false";

          }

          }

          //-----------------------------------------------------------

          // echo $hascertficate;

       

          if(isset($hascertficate) && $hascertficate == "false" ){

          if($certterm == 0){

          $span = "No certificate is provided for this course" ;

          }

          elseif($certterm == 1){

          $span = "No certificate is provided for this course" ;

          }

          elseif($certterm == 2){

          $span = "You must take all the lessons in the course to be eligible" ;

          }

          elseif($certterm == 3){

          if($res == ""){

          $span =  "You must pass the final exam with a score of" .$getmaxscore."%,you didn't take the final exam yet";

          }
          elseif(isset($getmaxscore->max_score) && $res < intval($getmaxscore->max_score)){

          $span =  "You must pass the final exam with a score of ".$getmaxscore->max_score."%,your score is"." ".$res."%";

          }

          else{

         // $span ="You must pass the final exam with a score of".$getmaxscore->max_score."%,"."you didn't take the final exam yet";

          }

          }

          elseif($certterm == 4){



          // echo $certterm;

          if(isset($scores_avg_quizzes) && ($scores_avg_quizzes < intval($avg_quizzes_cert))){

          $span = "You must pass the exams in avg score of ".$avg_quizzes_cert."%,your score was".$scores_avg_quizzes."%";

          }

          elseif($scores_avg_quizzes == null){

          $span = "You must pass the exams in avg score of ".$avg_quizzes_cert."%,you haven't finished all quizzes yet";

          }



          }

          elseif($certterm == 5){
           
         
          if($coursecompleted=="true" && isset($getmaxscore) && $res < intval($getmaxscore)){

          $span =  "You must finish all lessons and pass the final exam with a score of".$getmaxscore."%You finished all lessons, but your final exam score is only".$res."%";



          }

          elseif($coursecompleted=="false" && isset($getmaxscore) && $getmaxscore < intval($res)){

          $span = "You must finish all lessons and pass the final exam with a score of"." ".$getmaxscore."%"."You didn't finish all lessons yet";





          }

          elseif($coursecompleted=="false" && isset($getmaxscore) && $res < intval($getmaxscore->max_score)){

          $span = "You must finish all lessons and pass the final exam with a score of"." ".$getmaxscore."%"."You didn't finish all lessons, and your final exam score is only"." ".$res."%";



          }

          elseif($coursecompleted=="false" && $res == ""){

          $span = "You must finish all lessons and pass the final exam with a score of"." ".$getmaxscore."%"."You didn't finish all lessons and you dind't take the final exam"." ".$res."%";



          }



          }

          elseif($certterm == 6){

          if($coursecompleted=="true" && isset($scores_avg_quizzes) && ($scores_avg_quizzes < intval($avg_quizzes_cert))){

          $span = "You must finish all lessons and pass exams in avg of"." ".$avg_quizzes_cert."%"."You finished all lessons, but your avg score is only"." ".$scores_avg_quizzes."%";

          }

          elseif($coursecompleted=="false" && isset($scores_avg_quizzes) && ($avg_quizzes_cert < intval($scores_avg_quizzes))){

          $span = "You must finish all lessons and pass Exams in avg of"." ".$avg_quizzes_cert."%"."You didn't finish all lessons yet";



          }

          elseif($coursecompleted=="false" && $scores_avg_quizzes == ""){

          $span ="You must finish all lessons and pass the final exam with a score of"." ".$avg_quizzes_cert."%"."You didn't finish all lessons and you didn't take any quizz yet";

          }

          else{

          $span = "You must finish all lessons and pass exams in avg of"." ".$avg_quizzes_cert."%"."You didn't finish all lessons, and your avg score is only"." ".$scores_avg_quizzes."%";

          }

          }



          ?>

    <td>

          <?php



          $span = (isset($span)) ? $span : '';

          ?>

          <span style="color:#FF6600">Not Applicable</span>

          <span title="<?php echo $span; ?>" style="color:#0099FF; font-size:12px;"><?php //echo "why";?>



          </span>



    </td>

          <?php

           //  echo $hascertficate;

          }

          elseif((isset($hascertficate)) && $hascertficate == "true" && isset($courseidslist)){

          ?>

    <td>

          <?php

         // print_r($hascertficate);

          $certificate = $this->Myinfo_model->getCertificateData($user_id,$course_id);  // certificate_text
 
       
          $certificateid =(isset($certificate[0]->certificate_term) ? $certificate[0]->certificate_term : '1');

          $date_completed =(isset($certificate[0]->date_completed) ? $certificate[0]->date_completed : '2013-04-20');



          $author_id =$course->author;

          $certificate_text = $this->Myinfo_model->getUser($author_id);

          $author_name= (isset($certificate_text->first_name) ? $certificate_text->first_name : '');



          $cid='156';



          $certiapprovestatus = $this->Myinfo_model->checkCertificateStatus($user_id,$course_id);



           //$certiapprovestatus=0;

          ?>





          <?php
            $urlCourse = strtolower($course->course_name);     
            $urlCourse = trim(str_replace(' ', '-', $urlCourse));
            $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

            $urlname = strtolower($author_name);     
            $urlname = trim(str_replace(' ', '-', $urlname));
            $urlname = preg_replace('/[^A-Za-z0-9\-]/', '', $urlname);
            if($certiapprovestatus)

            {
            

          ?>

          <!--<a href="javascript:void(0)" onclick="openWinCertificate1('<?php echo $urlCourse; ?>','<?php echo $urlname ?>','<?php echo $certificateid ?>','<?php echo $date_completed ?>','<?php echo $cid;?>')">



          <img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View your certificate">



          </a>-->



          <a href="<?php echo base_url(); ?>myinfo/pdf/1/<?php echo $urlCourse; ?>/<?php echo $urlname ?>/<?php echo $certificateid ?>/<?php echo $date_completed ?>/<?php echo $cid;?>" target="_blank">

          <img align="viewed" src="<?php echo base_url();?>public/default/images/download.png" title="Download your certificate as PDF">



          </a>



          <?php

            }

            else

            {

         ?>

             <!--<a href="javascript:void(0)" onclick="alert('Certificate Not Approved Yet')">



          <img align="viewed" src="<?php echo base_url();?>public/default/images/viewed.png" title="View your certificate">



          </a>-->



          <a href="javascript:void(0)" onclick="alert('Certificate Not Approved Yet')">

          <img align="viewed" src="<?php echo base_url();?>public/images/admin/pdf-file-symbol.png" title="Download your certificate as PDF" style="width: 18px;">



          </a>

         <?php

            }

          ?>



          <a href="#" onclick="openWinCertificate3('<?php echo $urlCourse; ?>','<?php echo $urlname ?>','<?php echo $certificateid ?>','<?php echo $date_completed ?>','<?php echo $cid;?>')">

          <img align="viewed" src="<?php echo base_url();?>public/images/admin/file.png" title="Share this certificate with a link" style="width: 18px;">



          </a>

          <a href="#" onclick="openWinCertificate2('<?php echo $urlCourse; ?>','<?php echo $urlname ?>','<?php echo $certificateid ?>','<?php echo $date_completed ?>','<?php echo $cid;?>')">

          <img align="viewed" src="<?php echo base_url();?>public/images/admin/email.png" title="Email this certificate" style="width: 18px;">



          </a>

    </td>

        <?php  } ?>
        <td class="hidden-lg hidden-md hidden-sm hidden-xs " ><center>
                    <button onclick="$('#data<?php echo $i; ?>').toggle();" type="button" id="more" class="btn-sm grey_sm_btn"><i class="glyphicon glyphicon-plus"></i></button></center>
                   
        </td>

</tr>
<tr class="data" id="data<?php echo $i; ?>" >
            <td  colspan="4">
                      <div class="tb_row">
                       <div class="col-sm-3 no-padding progress_left_txt"><b>Lectures completed? : </b>
                       </div>
                       <div class="col-sm-9 progress_right_txt">
                         <?php
                           $coursecompleted = $this->Myinfo_model->courseCompleted111($user_id,$course_id);
                          //if(isset($completedprogress->completed) && $completedprogress->completed == '1' ){
                          if(isset($coursecompleted) && $coursecompleted == true){
                          echo '<span  style="color:#04A600;">Yes</span>';
                          }
                          else{
                          echo '<span  style="color:#cc2424;">No</span>';
                          }
                        ?>
                       </div>
                      </div>
                      <div class="tb_row">
                       <div class="col-sm-3 no-padding progress_left_txt"><b>Average Marks in Terms Exams: </b>
                       </div> 
                      <div class="col-sm-9 progress_right_txt">
                         <?php
                            if($nb_ofscores == 0 && $scores_avg_quizzes == ""){
                            echo "No Exams";
                            }
                            elseif($nb_ofscores != 0 && $scores_avg_quizzes == ""){
                            echo "Not Taken";
                            }
                            elseif($nb_ofscores != 0 && isset($scores_avg_quizzes))
                            {          
                              $getmax_score = ($getmaxscore >= 40) ? $getmaxscore : 40;
                              if($scores_avg_quizzes >= intval($getmax_score)){

                              echo $scores_avg_quizzes.'% '.'<span  style="color:#04A600;">Pass</span>';
                              }
                              else{
                              echo $scores_avg_quizzes.'% '.'<span  style="color:#cc2424;">Failed</span>';
                              }
                            }
                          ?>
                      </div>
                      
                      </div>
                      <div class="tb_row">
                        <div class="col-sm-3 no-padding progress_left_txt"><b>Final Exam Marks : </b></div>
                      <div class="col-sm-9 progress_right_txt">
                        <?php
                          //if(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && $res !="" ){

                          if(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && isset($res) && $res!='')
                          {
                            if($res >= $getmaxscore)
                            {
                                echo $res.'% '.'<span  style="color:#04A600;">Passed</span>';
                            }
                            elseif($res < $getmaxscore)
                            {
                                echo $res.'% '.'<span  style="color:#FF0000;">Failed</span>';
                            }
                          }
                          /*elseif(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && $getquizcourses->id_final_exam !=""){
                          }*/
                          elseif(isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam == 0 || isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam =="")
                          {
                            echo "No Final Exam";
                          }
                          elseif(empty($getquizcourses) || isset($getquizcourses->id_final_exam) && $getquizcourses->id_final_exam !=0 && $res==''){
                          echo "Not Taken";
                          //echo $scores_avg_quizzes;
                          }
                        ?>
                      </div>
                      </div>
              </td>
                  </tr>

<?php $i++;  } ?>
<?php if(!$courses){ ?>
<tr><td colspan="6">No certificates yet.</td></tr>
 <?php } ?>
</tbody>

</table>
</div>
</div>

	</div>
</div>


</div>

<div id="main" role="main">


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

</div>

<div class="holder2">

<div class="bottom-boxes">

<div class="frame">

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
 



    function openWinCertificate1(t1,t2,t3,t4,t5)
    {
        myWindow=window.open('<?php echo base_url(); ?>/myinfo/printcertificate/1/'+t1+'/'+t2+'/'+t3+'/'+t4+'/'+t5+'','','width=800,height=600, resizable = 0');
		    myWindow.focus();
    }
    function openWinCertificate2(t1,t2,t3,t4,t5)
    {
        myWindow=window.open('<?php echo base_url(); ?>/myinfo/certificate_sendmail/2/'+t1+'/'+t2+'/'+t3+'/'+t4+'/'+t5+'','','width=800,height=600, resizable = 0');
        myWindow.focus();
    }
    function openWinCertificate3(t1,t2,t3,t4,t5)
    {
		    myWindow=window.open('<?php echo base_url(); ?>/myinfo/printcertificate/3/'+t1+'/'+t2+'/'+t3+'/'+t4+'/'+t5+'','','width=800,height=600, resizable = 0');		myWindow.focus();
    }
</script>
<script>
			//(function($) {

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
		//	}) (jQuery);
	</script>