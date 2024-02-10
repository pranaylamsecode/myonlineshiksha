<?php
$startTimeStamp = strtotime("2015-05-02");
$endTimeStamp = strtotime("2015-05-10");

$timeDiff = abs($endTimeStamp - $startTimeStamp);

$numberDays = $timeDiff/86400;  // 86400 seconds in one day

// and you might want to convert to integer
//echo $numberDays = intval($numberDays);


?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<style type="text/css">
.fancybox-custom .fancybox-skin {
    box-shadow: 0 0 50px #222;
}
.btn-success {
    background-color: #04A600;
    padding-left: 3px;
}
.btn-primary_rockon {
    white-space: nowrap;
    float: left;
    width: 80px;
    color: #fff;
    padding: 0px 10px 5px 4px;
    font-size: 12px;
 }
 .sidebar-menu.sb-left {
    display: none;
}
#left_menu_sidebar {
  display: none;
}
/*@media(max-width:768px){
.main-content .course_search {
  margin-bottom: 10px;
  float: right !important;
    }
}*/

</style>

    <script>
    jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

  var $j =jQuery.noConflict();
    function renewCourseClick(message, course_id, price, buy_id ,path)
    {
        //var m_value = confirm(message);
            var str ='<p style="padding-top: 22px; padding-left: 18px;padding-right: 12px;font-weight: 700;">'+message+'</p>';
            $j.confirm({
                title: '',
                content: str,
                confirmButton:'Yes',
                confirm: function(){
                        //window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
                        $j.colorbox({
                            //iframe:true,
                               width:"400px", 
                               height:"57%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true, 
                            href:"<?php echo base_url(); ?>myinfo/subscription_plan_popup/"+course_id+"/"+price
                            });

                         },
                cancel: function(){
                    //return true;
                     }
                });



        // if(m_value == true)
        // {
        //  //window.location.href = path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id;
        //  window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
        // }
        // //alert(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
        // return false;
    }


    function subscribeRenewCourse(message, course_id)
    {
        var str ='<p style="padding-top: 22px; padding-left: 18px;padding-right: 12px;font-weight: 700;">'+message+'</p>';

        $j.confirm({
                title: '',
                content: str,
                confirmButton:'Yes',
                confirm: function(){
                        //window.location.replace(path+"/myinfo/renew/"+course_id+"/"+price+"/"+buy_id);
                        $j.colorbox({
                               width:"500px", 
                               height:"77%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
                            href:"<?php echo base_url(); ?>myinfo/subscription_plan_popup/"+course_id
                        });

                         },
                cancel: function(){
                    //return true;
                     }
                });
    }
    </script>
    
    
    

<!--/lightbox scripts and style-->


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

<!--<h2>My courses</h2>
<hr />-->




<div class="content cources_main_content">

<div id="left_menu_sidebar" class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 5px; margin-right:20px;">
    <a href="#" class="sidebar-collapse-icon with-animation">
        <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
        <i class="entypo-menu"></i>
    </a>
</div>

<p class="right_course_txt" style="padding:0 10px;font-style: italic;">This is a list of all the courses that you have subscribed to, completed,or are pursuing at the moment. You can renew your subscription/re-purchase any of the courses you have already completed / that have expired. Click on the name of the course to go to the courses.</p>

        
<div class="" style="overflow:hidden;">
<div class="" id="reading">

<!-- <h3 class="cattitle" style="margin-left: 20px; float:left;">Courses</h3> -->
<?php
$attributes = array('class' => 'tform', 'name' => 'myquiz');
// echo form_open_multipart('myinfo/mycourses/',$attributes);
echo form_open_multipart(base_url().'my-courses/',$attributes);
?>
    <div class="course_search" style="float:right; margin-top: 20px;  margin-right: 0px;">
        <input type="text" value="" name="search_course" class="textbox" style="float:left; margin-right:10px; height:30px;" placeholder="Course Name">
        <button type="submit" name="Submit" value="Search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>
       <!--     <button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: -2px;padding-left: 4px;"><i class="entypo entypo-cw"></i> Reset</button> -->
    </div>
<?php echo form_close(); ?>
<div class="row">
    <div class="col-md-12 no-padding">
        <div class="table-scroll-resp inner_pages_table">
        <table class="table table-bordered responsive">
            <thead>
                <tr>
                    <th class="courses_center">Courses Details</th>
                    <th class="courses_center">Expiry Date</th>
                    <th class="courses_center">Progress</th>
                    <th class="courses_center">Last Visit</th>
                    <th class="courses_center">Exams Results</th>
                    <!-- <th class="courses_center hidden-lg hidden-md visible-sm visible-xs ">Action</th> -->
                </tr>
            </thead>
            <tbody>
             <?php  
                //echo"<pre>";              
                //print_r($courses);
                    $i=1;        
                 foreach($courses as $course){

                      // date('Y-m-d',strtotime($course->expired_date));
                               $bool_expired = false;
                                $expire = "Expires";
                                $no_renew = false;
                                //print_r($course);
                                if($course->expired_date == "0000-00-00 00:00:00")
                                {
                                    $date = '<span class="guru_active">Unlimited Plan</span>';
                                    $no_renew = true;
                                }
                                else
                                {

                                    $datetime2 = new DateTime($course->expired_date);
                                    $interval = date_create('now')->diff($datetime2);
                                    // $interval->format('%R%a days');
                                    $replacedays  = str_replace('days','',$interval->format('%R%a days'));
                                    $replaceplus  = str_replace('+','',$replacedays);
                                    $replacefinal  = str_replace('-','',$replaceplus);
                                    

                                    $bool_expired = false;
                                    
                                    
                                    //if(strtotime($int_current_date) < strtotime($course->expired_date))
                                    if(0 < trim($replacedays))
                                    {
                                        $bool_expired = true;
                                        $expire = "Expires";
                                        $date_int = strtotime($course->expired_date);
                                        

                                        
                                        $date = '<span class="expired"> in '.$replacefinal.'Days</span>';

                                    }
                                    else if(0 > trim($replacedays))
                                    {
                                        $bool_expired = false;
                                        $expire = "Expired";
                                        $date_int = strtotime($course->expired_date);
                                        
                                        
                                        //$date = '<span class="active">'.$difference.'</span>';
                                        $date = '<span class="active"> before '.$replacefinal.'Days </span>';
                                        //---------------------------
                                    }
                                    else if(0 == trim($replacedays))
                                    {
                                        $bool_expired = true;
                                        $expire = "Expires";

                                        $date = '<span class="active"> Today </span>';

                                    }
                                }

                        $nr_orders = $this->Myinfo_model->countCourseOrders($course->course_id,$user_id);
                    $urlCourse = $course->slug;
      //                    $urlCourse = strtolower($course->course_name);          
                        // $urlCourse = trim(str_replace(' ', '-', $urlCourse));
                        // $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
                 ?>
                <tr>
                     <!-- <td class="product_name"><a href="<?php echo base_url();?>programs/lectures/<?php echo $course->course_id ?>"><?php echo $course->course_name; ?></a> -->
                     <?php
                     $block_enrolled1 = $this->program_model->checkblockenroll($course->course_id, $user_id);
                     $block_enrolled =count($block_enrolled1); 
                     if($block_enrolled > 0)
                     {
                        ?>
                        <td class="product_name"><a href="#" onclick="showmsg();"><?php echo $course->course_name; ?></a>
                        <?php
                     }
                     else
                     {
                     ?>
                     <td class="product_name"><a href="<?php echo base_url();?><?php echo $urlCourse ?>/lectures/<?php echo $course->course_id ?>"><?php echo $course->course_name; ?></a>
                           <?php
                           } 
                           ?>
                           <br/><strong><?php echo $expire; ?>:</strong> <?php echo $date; ?>
                           <?php if ($nr_orders->countorder > 0) {?>
                           <br /><a href="#"><?php echo "VIEW ORDERS"." (".$nr_orders->countorder.")"; ?></a>
                           <?php } else {}?> 
                      </td>
                      <td><center><?php echo $course->expired_date != "0000-00-00 00:00:00" ? date('d-m-Y', strtotime($course->expired_date)).' GMT ' : "-"; ?></center></td>

 

                    <td class="">
                        <?php
                            $completedprogress = $this->Myinfo_model->courseCompleted($user_id,$course->course_id);

                            if(isset($completedprogress->completed) && $completedprogress->completed == '1' ){
                               $completed_progress = "true";
                            }else{
                                $completed_progress = "false";
                            }

                           // $date_completed = $this->Myinfo_model->dateCourseCompleted($user_id,$course->course_id);
                           if(isset($completedprogress->date_completed) && $completedprogress->date_completed!= '0000-00-00' )
                           {
                                $date_completed = $completedprogress->date_completed;
                            }
                            else{
                                $date_completed= "";
                            }

                            $style_color = "";

                            if($completed_progress == "true"){
                                $lesson_module_progress = "completed";
                                $style_color = 'style="color:#669900"';
                                //echo $lesson_module_progress;
                            }
                            else{
                              //print_r($course->course_id);
                                $lesson_module_progress = $this->Myinfo_model->getLastViewedLessandMod($user_id,$course->course_id);
                                //print_r($lesson_module_progress);
                                }
                            if(isset($lesson_module_progress)){
                                echo $lesson_module_progress;
                            }else{
                                echo "";
                            }

                         ?>
                    </td>
                    <td class="">
                        <?php
                            $date_last_visit = $this->Myinfo_model->courseCompleted($user_id,$course->course_id);
                            if(isset($date_last_visit->date_last_visit) && $date_last_visit->date_last_visit !="0000-00-00" && $date_last_visit->date_last_visit !=NULL ){
                            $date_last_visit = date('d-m-Y', strtotime($date_last_visit->date_last_visit));
                            $date_last_visit = $date_last_visit.' GMT';
                            }
                            else{
                            $date_last_visit = "";
                            }
                            $count_quizz_taken = $this->Myinfo_model->countQuizzTakenF($user_id,$course->course_id);
                            //print_r($count_quizz_taken);
                        ?>

                    <?php echo $date_last_visit; ?></td>
                    <td style="padding-left:3px" class="">
                    <?php
                    if($count_quizz_taken->countquizz !=0){    ?>

                        <a class='<?php echo "viewexamresult";?>' href="<?php echo base_url();?>myinfo/listquizstud/<?php echo $course->course_id ?>">View Exams Results<?php echo "(".$count_quizz_taken->countquizz.")" ?></a>
                    <?php
                     }
                     else{
                        echo "no Exam";
                     }?>


                    </td>
                    <td class="details_myc hidden-lg hidden-md hidden-sm hidden-xs " >
                   
                    <center><button  onclick="$('#data<?php echo $i; ?>').toggle();" type="button" id="more" class="btn-sm grey_sm_btn"><i class="glyphicon glyphicon-plus"></i></button></center>
                   
                        
                    <?php
                        $datetime2 = new DateTime($course->expired_date);
                        $interval = date_create('now')->diff($datetime2);
                        // $interval->format('%R%a days');
                        $replacedays  = str_replace('days','',$interval->format('%R%a days'));
                        $replaceplus  = str_replace('+','',$replacedays);
                        $replacefinal  = str_replace('-','',$replaceplus);

                        
                       if($bool_expired == 0)
                         { // not expired
                            $date_int = strtotime($course->expired_date);
                            $int_current_date = strtotime(date('Y-m-d h:i:s'));
                            $expired_date = strtotime($course->expired_date);
                            
                            //$comfirm_text = "You still have 0 Days available for this course, would you like to add time to your subscription? Click Yes to add time to your plan, click Cancel to go to the course page.";
                           $comfirm_text = "Your subscription for this course will be expire before ".intval($replacefinal)." days, would you like to renew your subscription? Click Yes to renew your subscription, click Cancel to go to the course page.";
                            if(0 == $replacefinal)
                            {
                                $comfirm_text = "Your subscription for this course will be expire today, would you like to renew your subscription? Click Yes to renew your subscription, click Cancel to go to the course page.";
                               
                            }

                            if(!$no_renew){ 

                                    if($course->fixedrate == 0.00)
                                            { 
                                              
                                                $this->load->model('Myinfo_model');
                                                $pricearray = $this->Myinfo_model->getPlanPrice($course->plan_id,$course->course_id);
                                                if($pricearray)
                                                 $price = $pricearray->price;
                                               ?>
                                                 <button type="button" class="btn-primary_rockon" onclick="javascript:subscribeRenewCourse(&quot;<?php echo $comfirm_text; ?>&quot;, <?php echo $course->course_id; ?>);" value="Renew ">
                                             <i class="entypo entypo-back-in-time"></i>RENEW</button>
                                              <?php
                                            }
                                            else
                                            {
                                                $price = $course->fixedrate;
                                                ?>
                                                <button type="button" class="btn-primary_rockon" onclick="javascript:renewCourseClick(&quot;<?php echo $comfirm_text; ?>&quot;, <?php echo $course->course_id; ?> ,<?php echo $price; ?> ,<?php echo $course->id; ?>,&quot;<?php echo base_url(); ?>&quot;);" value="Renew"><i class="entypo entypo-back-in-time"></i>RENEW</button>
                                             <?php
                                            }
                                
                                    ?>
                                            <center>
                          <!-- <input type="button" class="btn-primary_rockon" onclick="javascript:renewCourseClick(&quot;<?php echo $comfirm_text; ?>&quot;, <?php echo $course->course_id; ?> ,<?php echo $price; ?> ,<?php echo $course->id; ?>,&quot;<?php echo base_url(); ?>&quot;);" value="Renew2"> -->

</center>
                                    <?php
                                            }
                                         }
                                        else{// expired
                                            if(!$no_renew){     
                                            


                                            $startTimeStamp = strtotime(date('Y-m-d'));
                                            $endTimeStamp = strtotime($course->expired_date);
                                            $endTimeStamp2 = strtotime('-30 day',$endTimeStamp);
                                            if($endTimeStamp2 <= $startTimeStamp)
                                            {
                                                //new code for mail start
                                                    $auth = $this->session->userdata('logged_in');
                                                                        
                                                    $this->load->model('admin/settings_model');
                                                    $btnrenew = base_url().'/my-courses';       
                                                    $urldomain = base_url();
                                                    $urldomain = str_replace('http://', '', $urldomain);
                                                    $urldomain = str_replace('/', '', $urldomain);
                                                    $urldomain = str_replace('www.', '', $urldomain);


                                                    $configarr = $this->settings_model->getItems();
                                                    $this->template->set("configarr", $configarr);
                                                    //$subject = "Your subscription for '".$course->course_name."' is about to expire";

                                                    $subject = "Renew your course subscription";
                                                    $toemail = "veerit1511@gmail.com";//$auth['email'];
                                                    $content = '';
                                                    //$content .= '<h6 style="padding: 5px 0; font-size: 30px; font-weight: normal; margin: 0 0 10px 0;">'.$configarr[0]['institute_name'].'</h6>';
                                                    $content .= '<p style="font-size: 17px; font-weight: bold; text-transform: uppercase">Renew your course subscription </p>';
                                                    $content .= '<p>Dear '.trim(ucfirst($auth['first_name'])).',<br /><br />';
                                                    $content .= "Your subscription for course'".$course->course_name."' is going to Expire on ".date("d-M-Y", strtotime($course->expired_date)).", Please renew your course subscription.<br /><br />";                         
                                                    //$content .='<a href ='.$btnrenew.'>Renew Now</a>.<br />';

                                                    $content .= '<div style="background-color: rgb(255, 216, 139); border-radius: 3px; width: 100%; height: 43px; color: white; text-align: center;"> <a href="'.$btnrenew.'" style="text-align: center; margin: 0px auto; color: rgb(255, 255, 255); text-decoration: none; display: block; border: 0px none; font-size: 16px; font-family: &quot;Avant Garde&quot;,Avantgarde,&quot;Century Gothic&quot;,CenturyGothic,AppleGothic,sans-serif; overflow: hidden; line-height: 45px; text-transform: uppercase; letter-spacing: 1px;">Renew Now</a></div><br /><br /> ';


                                                    $content .=' If you need help or have any questions, please contact us.<br />';
                                                    
                                                    $data['content'] = $content;
                                                    $fromemail= 'noreply@'.$urldomain;    //$configarr[0]['fromemail'];// admin mail    
                                                    $config['charset'] = 'utf-8';
                                                    $config['mailtype'] = 'html';
                                                    $config['wordwrap'] = TRUE;
                                                    $message = $this->load->view('email_formates/common_email_formate.php',$data,true);
                                                    $this->email->initialize($config);
                                                    $this->email->from($fromemail, $configarr[0]['fromname']);// admin mail);
                                                    $this->email->subject($subject);
                                                    $this->email->to($toemail);
                                                    $this->email->message($message);
                                                    $this->email->send();
                                                //new code for mail end
                                            }

                                            $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                             
                                            $numberDays = ($timeDiff/86400);  // 86400 seconds in one day
                                            
                                            
                                            $confirm_text = "You still have ".intval($replacefinal)." Days available for this course, would you like to add time to your subscription? Click Yes to add time to your plan, click Cancel to go to the course page.";
                                            //echo $replacefinal;
                                            if(0 == $replacefinal)
                                            {
                                               $confirm_text = "Your subscription for this course will be expire today, would you like to renew your subscription? Click Yes to renew your subscription, click Cancel to go to the course page.";
                                               
                                            }


                                            if($course->fixedrate == 0.00)
                                            { 
                                              
                                                 $this->load->model('Myinfo_model');
                                                 $pricearray = $this->Myinfo_model->getPlanPrice($course->plan_id,$course->course_id);
                                                if($pricearray)
                                                {
                                                 $price = $pricearray->price;
                                                }
                                                else
                                                {
                                                $price ="0";
                                                }

                                            }
                                            else
                                            {
                                                $price = $course->fixedrate;
                                            }
                                                
                                    ?>       <?php
                                                if($block_enrolled == 0)
                                                {
                                                    
                                                ?>
                                                <?php
                                                if($course->fixedrate == 0.00 && $course->chb_free_courses==1)
                                                    { 
                                                ?>
                                                  <!-- <input type="button" onclick="javascript:renewCourseClick(&quot;<?php echo $confirm_text; ?>&quot;, <?php echo $course->course_id; ?> , <?php echo $price; ?> , <?php echo $course->id; ?> ,&quot;<?php echo base_url(); ?>&quot;);" name= "RENEW" class="btn btn-success" value="RENEW3"> -->
                                                <!-- <a class="btn btn-success viewsubscibe" href="<?php echo base_url(); ?>myinfo/subscription_plan_popup/<?php echo $course->course_id; ?>">RENEW</a> -->
                                                <a class="btn btn-success centered_btn" onclick="subscribeRenewCourse(&quot;<?php echo $confirm_text; ?>&quot;,<?php echo $course->course_id; ?>)" ><i class="entypo entypo-back-in-time"></i>RENEW</a>
                                                <?php
                                                    }
                                                    else if($course->chb_free_courses!=1)
                                                    {
                                                ?>
                                                 <button type="button" onclick="javascript:renewCourseClick(&quot;<?php echo $confirm_text; ?>&quot;, <?php echo $course->course_id; ?> , <?php echo $price; ?> , <?php echo $course->id; ?> ,&quot;<?php echo base_url(); ?>&quot;);" name= "RENEW" class="btn btn-success" value="RENEW"><i class="entypo entypo-back-in-time"></i>RENEW</button>
                                                 <?php }else{ 
                                                    ?>
                                                    <!-- <input type="button" onclick="javascript:renewCourseClick(&quot;<?php echo $confirm_text; ?>&quot;, <?php echo $course->course_id; ?> , <?php echo $price; ?> , <?php echo $course->id; ?> ,&quot;<?php echo base_url(); ?>&quot;);" name= "RENEW" class="btn btn-success" value="RENEW 77"> -->
                                                    <?php

                                                    }?>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <button type="button" onclick="showmsg();" name= "RENEW" class="btn btn-success" value="RENEW4"><i class="entypo entypo-back-in-time"></i>RENEW</button>
                                                <?php
                                                }
                                                ?>
                                    <?php
                                            }
                                            //new code start

                                            // new code end
                                        }
                                    ?>




                    </td>
                </tr>
                 <tr class="data" id="data<?php echo $i; ?>">
                    <td  colspan="3">
                      <div class="tb_row">
                      <div class="col-sm-2 no-padding progress_left_txt">
                        <b>Progress : </b>
                      </div>
                      <div class="col-sm-10 progress_right_txt">

                        <?php
                            $completedprogress = $this->Myinfo_model->courseCompleted($user_id,$course->course_id);

                            if(isset($completedprogress->completed) && $completedprogress->completed == '1' ){
                               $completed_progress = "true";
                            }else{
                                $completed_progress = "false";
                            }

                           // $date_completed = $this->Myinfo_model->dateCourseCompleted($user_id,$course->course_id);
                           if(isset($completedprogress->date_completed) && $completedprogress->date_completed!= '0000-00-00' )
                           {
                                $date_completed = $completedprogress->date_completed;
                            }
                            else{
                                $date_completed= "";
                            }

                            $style_color = "";

                            if($completed_progress == "true"){
                                $lesson_module_progress = "completed";
                                $style_color = 'style="color:#669900"';
                                //echo $lesson_module_progress;
                            }
                            else{
                              //print_r($course->course_id);
                                $lesson_module_progress = $this->Myinfo_model->getLastViewedLessandMod($user_id,$course->course_id);
                                //print_r($lesson_module_progress);
                                }
                            if(isset($lesson_module_progress)){
                                echo $lesson_module_progress;
                            }else{
                                echo "";
                            }

                         ?>
                      </div>
                      </div>
                      <div class="tb_row">
                      <div class="col-sm-2 no-padding progress_left_txt">
                        <b>Last Visit : </b>
                      </div>
                      <div class="col-sm-10 progress_right_txt">
                        <?php
                            $date_last_visit = $this->Myinfo_model->courseCompleted($user_id,$course->course_id);
                            if(isset($date_last_visit->date_last_visit) && $date_last_visit->date_last_visit !="0000-00-00" && $date_last_visit->date_last_visit !=NULL ){
                            $date_last_visit = date('d-m-Y', strtotime($date_last_visit->date_last_visit));
                            $date_last_visit = $date_last_visit.' GMT';
                            }
                            else{
                            $date_last_visit = "";
                            }
                            $count_quizz_taken = $this->Myinfo_model->countQuizzTakenF($user_id,$course->course_id);
                            //print_r($count_quizz_taken);
                        ?>

                        <?php echo $date_last_visit; ?>
                      </div>
                      </div>
                      <div class="tb_row">
                      <div class="col-sm-2 no-padding progress_left_text">
                        <b>Exams Results : </b>
                      </div>
                      <div class="col-sm-10 progress_right_txt">
                            <?php
                    if($count_quizz_taken->countquizz !=0){?>
                        <a class='<?php echo "viewexamresult";?>' href="<?php echo base_url();?>myinfo/listquizstud/<?php echo $course->course_id ?>">View Exams Results<?php echo "(".$count_quizz_taken->countquizz.")" ?></a>
                    <?php
                     }
                     else{
                        echo "no Exam";
                     }?>

                      </div>
                      </div>
                    </td>
                  </tr>
                 <?php $i++; } ?>
                <?php if(!$courses) { ?>
            <tr>

    <td colspan="6">
No courses you read yet. <a href="<?php echo base_url(); ?>courses">Read a one now !</a>
<!-- <?=lang('web_no_elements');?> -->

</td>

</tr>
        <?php } ?>
            </tbody>
        </table>
        </div>
        
    <!--<div class="tabs-area">  -->

    <!--</div>   -->
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
    <!--<div id="mrp-container3" class="box">  bvn </div>
    <div class="box">  vbnvnn </div>
    <div id="mrp-container5" class="box">    bnvnv
    </div>--> </div>
    </div>
    </div>
</div>
    


<div class="clr"></div>


</div>


    
    </div>
</div>
    
</div>

</div>

</div>



<div class="clr"></div>
    <script>
    function showmsg()
    {
        alert('Your Enrollment has Block ');
    }
    </script>


   <script>
   var $ =jQuery.noConflict();
            // (function($) {
                $(document).ready(function() {
                    var mySlidebars = new $.slidebars();
                    
                    $('.toggle-left').on('click', function() {
                        mySlidebars.toggle('left');
                    });
                    
                    $('.toggle-right').on('click', function() {
                        mySlidebars.toggle('right');
                    });
                });
            // }) (jQuery);
    </script>

<?php
function dateDiff($time1, $time2, $precision = 4) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 > $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
 break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
 // Add s if value is not 1
 if ($value != 1) {
   $interval .= "s";
 }
 // Add value and interval to times array
 $times[] = $value . " " . $interval;
 $count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  } 
?>


<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<style type="text/css">
  .data{
   margin:4%; 
   display: none;
  }
 
 

</style>

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){
                    
                    $('#more').click( function(){
    $(this).find('i').toggleClass(' glyphicon glyphicon-plus').toggleClass('glyphicon glyphicon-minus');
});

                               //Examples of how to assign the Colorbox event to elements
                               
                         //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});                        
                       $j(".viewexamresult").colorbox({
                               iframe:true,
                               width:"700px", 
                               height:"100%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
                               //initialWidth:"100",
                               nitialHeight:"50"
                                                                                                 
                                               })

                       $j(".viewsubscibe").colorbox({
                               iframe:true,
                               width:"500px", 
                               height:"500px",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
                               //initialWidth:"100",
                               nitialHeight:"50"
                                                                                                 
                                               })
                       

                   });

                        </script>



