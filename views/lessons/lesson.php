<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/css/font-icons/entypo/css/entypo.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/courses_css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.css">  
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
  var video;
  var sptime = '0';
  function play_video(place,vid = null,video_hash = null)
  {
    var activity_id = $('#lec_act_id').val();
    // alert(activity_id);
    if(activity_id){
        $.ajax({
            
            cache: false,
            url: "<?php echo base_url()?>lessons/get_user_activity/"+activity_id,
            dataType: "json",

            success: function(msg)
            {
              var sp_time = msg[0]['spend_time'];
            //   console.log("msg['spend_time'] : "+sp_time);
            //   if(sp_time){
            //   var options = {
            //       url: 'https://player.vimeo.com/video/'+video+'#t='+sp_time,
            //       // id:<?php echo $c_id ?>,
            //         loop: true,
            //         seekTo: 2
            //     };
            //   var madeInNy = new Vimeo.Player('made-in-ny', options);
                // madeInNy.on("pause", onPause);

            // }
            }
          });
    }
    // else{
      sptime = '0';
      if(place == 1)
      {
        video = "<?php echo $lecture_video;?>";
        $("#overlay").show();
        $.ajax({
           type: 'GET',
           url: '<?php echo base_url();?>admin/tasks/getVimeoVid/'+video,
        }).done(function(data) {
          $('#overlay').delay(1500).hide(0); 
          video_hash = data;
          $(".made-in-ny").remove();
          $(".asset-container.scrollbar").html('<div data-vimeo-defer class="made-in-ny" id="made-in-ny'+video+'"><iframe src="https://player.vimeo.com/video/'+video+'" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div>');
          var options = {
              url: 'https://vimeo.com/'+video+'/'+video_hash,
              loop: true,
              seekTo: 2
          };
          var madeInNy = new Vimeo.Player('made-in-ny'+video, options);
          madeInNy.on("pause", onPause);
        });
      }
      else{
        video = vid;
        $(".made-in-ny").remove();
        $(".asset-container.scrollbar").html('<div data-vimeo-defer class="made-in-ny" id="made-in-ny'+video+'"><iframe src="https://player.vimeo.com/video/'+video+'" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div>');
        var options = {
                      url: 'https://vimeo.com/'+video+'/'+video_hash,
                        loop: true,
                        seekTo: 2
                    };
        var madeInNy = new Vimeo.Player('made-in-ny'+video, options);
        madeInNy.on("pause", onPause);
      }
    }
   // +'#t=2s'
   
  // }
  var onPause = function(data) {
    var prov = 'vimeo';
     sptime =  data['seconds'];
    var percent = data['percent'];
    var duration = data['duration'];
    var v_name = video;

      var id = $("#lec_act_id").val();
      var pro_id    = $("#proid").val();
      var stud_id   = "<?php echo $user_id ?>";
      var mod_id    = $("#modid").val();
      var lesson_id = $("#lessid").val();
        if(stud_id){
          $.ajax({
          
            cache: false,
            type: "POST",
            url: "<?php echo base_url()?>lessons/lec_statistic",
            data: {'id':id,'pro_id':pro_id,'stud_id':stud_id,'mod_id':mod_id,'lesson_id':lesson_id,'v_name':v_name,'sptime':sptime,'percent':percent, 'duration': duration, 'prov':prov}, 
            success: function(msg)
            {    
              console.log(msg);
            }     
          });
        }
   
    
};


</script>
<style type="text/css">
body {
    overflow-x: hidden;
}
   iframe{ 
    width: 100%!important; 
  }
  .img_load {
    position: absolute;
    left: 39%;
    top: 39%;
    z-index: 999;
    transform: translate(-50%, -50%);
}
@media (max-width:767px){
    .img_load {
        position: absolute;
        left: 50%;
        top: 107px;
        z-index: 999;
        transform: translate(-50%, 0%);
    }
}
.video-js{
width: 100%;
height: 400px;
max-height: 100%;
}
#course-taking-page .main{
  right: 0px !important;
}
.plyr__video-embed {
  padding-bottom: 44% !important;
}
.ud-extras{
  overflow: scroll;
}
.nameblock{
  width: 100% !important;
  margin-bottom: 2% !important;
  margin-top: 0% !important;
  color: #4985b8 !important;
}
.view.right_view_content .column.ui-sortable {
    padding-left: 40px;
    padding-right: 40px;
}
.nameicon
{
    border-style: solid;
    border-radius: 50%;
    padding: 1%;
    border-width: 1px;
    text-transform: uppercase;
    margin-right: 2%;
    color: #ffffff;
    background-color: #4985b8;
}
#course-taking-page.wrapper .sidebar, #main, #responsive-sidebar {
  transition: 0.5s;
}
span.stuAttachment {
  margin-top: 10px;
  margin-bottom: 10px;
}
div#style-1 {
  width: 100%;
}
button#btn-start {
  padding: 10px 22px;
}
.btn_remove {
  margin-left: 10px;
  margin-top: 0px!important;
}
.uploadbutton {
  margin-bottom: 10px!important;
}
#style-1 #instruct h2, #submission h2 {
  margin-top: 5px;
  font-family: inherit;
  font-weight: 500;
  line-height: 1.2;
  color: inherit;
  font-size: 24px;
}
.uploadbutton {
  margin-top: 18px;
}
#submission .stuAttachment{
  width:80%;
  display:block; 
  float:left;
  margin-top: 0px!important;
}
.assgn_submt {
  margin-top: 8px;
}
.progress1 {
  margin-top: 10px;
  width: 70%;
  max-width: 70%;
  float: left;
}
.Qans label {
  font-size: 18px;
  color: #555555;
}
#submission .textview {
  margin-top: 5px;
}
input.btn1 {
  width: auto!important;
  float: left;
  margin-right: 10px;
}
button#btn-start{
  margin-top:25px;
  margin-bottom: 10px;
}
.progress1 
{    /* display: none; */
    position: relative;
    width: 300px;
    border: 1px solid #1b4c64;
    border-radius: 20px;
    border-radius: 10px;
    height: 15px;
}
.progress-bar1 {
    background-color: #49afcd;
    border-radius: 20px!important;
    border: none!important;
    line-height: 1px!important;
    height: 13px;
}
.bar1 
{ 
  background-color: #B4F5B4!important; 
  width:0%!important; 
  height:20px!important; 
  border-radius: 3px!important; 
}
.percent-bar1 
{ 
  position:absolute!important; 
  display:inline-block!important; 
  top:7px!important; 
  left:48%!important; 
} 
.rightsidebar a:hover {
    color: #e71b1b !important;
}
.asset-container {
  background-color: white !important;
}

@media (min-width: 768px){
#course-taking-page.wrapper .main ul#timeline>li .asset-container {
    overflow: auto !important;
}
.asset-container p{
  overflow: auto !important;
  color: #555555 !important;
}
}
.course_nm{
  border-bottom: 1px solid #ccc;
    background: #EDEDED;
    padding: 10px 15px;
    font-weight: 700;
    font-size: 14px;
    color: rgb(44, 47, 55);
}
.bx-has-controls-auto
{
display: none;  
}

select[name='Alignment'] { 
    display: none;
}
.lyrow {
    height: auto !important;
}
.box, .lyrow {
    position: relative;
}
.row{
  margin-left:0px!important;
  margin-right:0px!important;
}

 .drag,  .configuration,  .remove,  .clone {
    display: none !important;
}

.preview {
    display: none;
}
 .box,  .row {
    padding-top: 0;
    background: none;
}
a.mock {
  display: none;
}
.sourcepreview .column, .sourcepreview .row, .sourcepreview .box {
    margin: 0px 0;
    padding: 0px;
    background: none;
    border: none;
    -webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.00);
    -moz-box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.00);
    box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.00);
}
.btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before, .btn-toolbar:after, .btn-toolbar:before, .clearfix:after, .clearfix:before, .container-fluid:after, .container-fluid:before, .container:after, .container:before, .dl-horizontal dd:after, .dl-horizontal dd:before, .form-horizontal .form-group:after, .form-horizontal .form-group:before, .modal-footer:after, .modal-footer:before, .nav:after, .nav:before, .navbar-collapse:after, .navbar-collapse:before, .navbar-header:after, .navbar-header:before, .navbar:after, .navbar:before, .pager:after, .pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before {
    display: table;
    content: " ";
}
 .column {
    padding-top: 20px;
    padding-bottom: 20px;
}
.preview {
    display: none;
}
.box .view {
    display: block;
}
.lyrow.ui-draggable .view .row .col-md-12 .box-element .view iframe.img-responsive{
  height: 480px;
}
.delspan {
  /*position: absolute;*/
  bottom: 0;
  left: 60px;
}

.btn-orange {
  color: #ffffff;
  background-color: #ff9600;
  border-color: #ff9600;
}
.btn-orange:hover, .btn-orange:focus, .btn-orange:active, .btn-orange.active, .open .dropdown-toggle.btn-orange {
  color: #ffffff;
  background-color: #d67e00;
  border-color: #c27200;
}

.w130 {
  line-height: 1.5;
}

#course-taking-page .main:before{
  content:'';
  width:5px;
  height:100%;
  position:fixed;
  left: 179px;
} 
/*my css*/
.ud-lectureangular>div {
  padding-left: 0px!important;
}
.asset-container>div {
  padding-left: 0px!important;
}
.chk_mrk img{
  background-color: #fff;
  padding-bottom: 4%;
  border-radius: 4px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  width: 21px;
  padding-top: 6%;
  padding-left: 4%;
}
div#mark_as_complete .btn-default {
  display: inline-block;
  margin-bottom: 0;
  font-weight: 400;
  text-align: center;
  vertical-align: middle;
  touch-action: manipulation;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  padding: 4px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  border-radius: 4px;
}
.chk_mrk{
  display:block;
  margin-right: 10px;
  float: left;
}
.chk_mrk_btn, div#mark_as_complete .btn-default{
      background-color: #54B551;
    color: #fff;
    padding-left: 14px!important;
    border-top-left-radius: 0px!important;
    border-radius: 4px!important;
}
.chk_mrk:hover img {
  color: #333;
  background-color: #e6e6e6!important;
  border-color: transparent!important;
}
.chk_mrk:hover .chk_mrk_btn {
  color: #333;
  background-color: #e6e6e6!important;
  border-color: transparent!important;
}
/*end*/
.custom-bdcrumb {
  font-size: 14px;
  position: absolute;
  left: 200px;
  right: auto;
  top: 14px;
  text-align: left;
}
.custom-bdcrumb{
  color: #84848C !important;
}

.custom-bdcrumb span{
  color: #84848C !important;
    font-weight: 700;
    padding-left: 5px;
}
.theme_color {
    position: absolute;
    top: 15px;
    left: 892px;
    z-index: 9;
}
.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 106px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
.dropbtn {
   background-color: #4CAF50;
    color: white;
    padding: 7px;
    font-size: 15px;
    border: none;
    cursor: pointer;
}
.dropdown-content a {
    color: black;
    padding: 3px 16px;
    text-decoration: none;
    display: block;
}
.dropdown-content a:hover {background-color: #f1f1f1}

.theme_color:hover .dropdown-content {
    display: block;
}
.theme_color:hover .dropbtn {
    background-color: #3e8e41;
}

#timeline .element-blue-bg {
  width: 100%;
}
.element-purple-bg, .element-blue-bg, .element-green-bg{
  width: 100%;
}
.lecture_prev_top {
    width: 85%;
    float: left;
}
.hamburger {
  padding-top: 8px;
}
@media (min-width: 1700px){
  #course-taking-page iframe {
    height: 40vh !important;
  }
}
@media (max-width: 1700px){
  #course-taking-page iframe {
    height: 70vh !important;
  }
}
@media (max-width: 767px){
.lecture_prev_top .back_to_course{
  width: auto !important;
  display: none !important;
}
#course-taking-page.lesson_page .lyrow .layout-main-table, #course-taking-page.lesson_page .lyrow div {
  width: 100%!important;
  height: auto!important;
}
#course-taking-page.lesson_page .lyrow div {
    width: 100%!important;
    padding: 0!important;
    margin: 0!important;
    height: auto!important;
    }
#course-taking-page .player .vp-controls .play{
  height: 3.3em !important;
}
.back_to_course_btn{
  margin-left: 8px !important;
}
#responsive-sidebar {
    padding-right: 8px;
}

.plyr {
    max-width: 100%!important;
    min-width: 50%!important;
    max-height: 100%!important;
  }
#responsive-sidebar {
    transition: 0.5s;
    display: none;
}
#course-taking-page.wrapper .main {
    width: 100%!important;
    left: 0!important;
    right: 0!important;
    position: unset;
}
#sidebar_down {
    margin-top: 250px;
}
#course-taking-page iframe {
    height: 100% !important;
}
#course-taking-page.wrapper .main ul#timeline>li .asset-container {
    bottom: auto;
    top: 0px;
    overflow: unset;
    height: 205px;
    position: unset;
    margin-top: 45px;
    padding: 10px 0px;
}
.sidebar_down .sidebar-container .tab-label-container .gray-nav li i{
  display: none;
}
.sidebar_down .sidebar-container .tab-label-container .gray-nav li label {
    color: #2c2f37;
    font-weight: 700;
    height: 40px;
    border-bottom: 0 none;
    font-size: 15px;
    line-height: 40px;
    text-align: center;
    box-shadow: none;
    padding-top: 0px;
}
#main .lecture_prev_top .back_to_course {
    width: auto !important;
    display: inline-block !important;
    color: #ddd !important;
}
#main .lecture_prev_top i{
    color: #ddd !important;
}
.sidebar_down .less_lect_list {
    display: flex;
    margin: 10px 0 0 -10px;
}
.sidebar_down .cattext1 {
    background: #fff;
    padding: 10px 15px;
    cursor: pointer;
}
.sidebar_down #coursesectionlecture{
  padding: 10px 0px 10px 0px;
}
li.show-progress {
    display: none;
}
}

#query_title {
    height: 40px !important;
    min-height: 40px !important;
    resize: none;
    margin-bottom: 10px;
    padding-top: 8px !important;
}
#btnStartexam {
    width: 100% !important;
    height: 35px;
}
#buy_loader {
    width: 100% !important;
    height: 35px;
}
</style>

<?php 
$remainAttempts=0;
function total_spentTime($ptime)
{
    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );
    foreach( $condition as $secs => $str )
    {
        $d = $ptime / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' Spent on lecture';
        }
    }
}

function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'Just Now';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}
  
$pro_id = $program_id;
$coursetype_details = $this->Tasks_model->getCourseTypeDetails ($pro_id);

if($coursetype_details[0]['course_type'] == 1)
{
  $seq = true;
}
else
{
  $seq = false;
}

    if($user_id > 0)
    {
      if(count($date_enrolled) > 0)
      {
        $not_show = true;
      }
      else
      {
        $not_show = false;
      }

      $date_enrolled = (count($date_enrolled) > 0) ? $date_enrolled->buydate : '';
      $date_enrolled = strtotime($date_enrolled);
    }
    if($lesson->is_demo==1)
    {
      $not_show = true;
    }

    if(isset($date_enrolled))
    {
      $start_relaese_date1 = $coursetype_details[0]["start_release"];
      $start_relaese_date = strtotime($start_relaese_date1);
      $start_date =  $date_enrolled;

      $datestring = "%Y-%m-%d";
      $time = time();
      $date_9 = mdate($datestring, $time);
      //$date9 = strtotime($date9);
      $date9 = $date_9;
      $date_9 = date("Y-m-d",strtotime($date9));

      $date9 = strtotime($date9);
      $interval = abs($date9 - $start_date);

      $dif_days = floor($interval/(60*60*24));
      $dif_week = floor($interval/(60*60*24*7));
      $dif_month = floor($interval/(60*60*24*30));

      if($coursetype_details[0]["course_type"] == 1)
      {
        if($coursetype_details[0]["lesson_release"] == 1)
        {
          $diff_start = $dif_days+1;
          $diff_date = $dif_days+1;
        }
        elseif($coursetype_details[0]["lesson_release"] == 2)
        {
          //$dif_days_enrolled = $dif_days_enrolled /7;
          $diff_start = $dif_week+1;
          $diff_date = $dif_week+1;
        }
        elseif($coursetype_details[0]["lesson_release"] == 3)
        {
          //$dif_days_enrolled = $dif_days_enrolled /30;
          $diff_start = $dif_month+1;
          $diff_date = $dif_month+1;
        }
      }
    }
    echo $date_enrolled;
    //echo $diff_start;
    $step_less = 0;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<!--<html lang="en-gb" dir="ltr" xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" slick-uniqueid="3">-->
<?php
$this->load->helper('media' );
$this->load->helper('quizcertificate');
$this->load->helper('access');

if(isset($lesson))
{
$heading = $lesson->name;
$lessonid = $lesson->id;
$layoutid = $lesson->layoutid;
//exit();
}elseif($isfinalview == true){
$heading = 'Final Quiz';
$layoutid = 'finalexam';
}/*
elseif($iscertificateview == true){
$heading = 'Certificate';
$layoutid = 'certificate';
}*/else{
$heading = null;
$layoutid = null;
}
//$access = isAccess('',$program_id,$moduleid,$lessonid,2,$dayaccess,$lessonAccess);
//isAccess($autherid,$pid,$did,$tid,$paccess,$daccess,$taccess);
    
?>

<head>
<title><?php echo $heading;?></title>
<?php $metatitle = (isset($lesson->metatitle) && trim($lesson->metatitle)!='') ? $lesson->metatitle : "title"; 
$metakwd = (isset($lesson->metakwd) && trim($lesson->metakwd)!='') ? $lesson->metakwd : "keyword"; 
$metadesc = (isset($lesson->metadesc) && trim($lesson->metadesc)!='') ? $lesson->metadesc : "desc"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />
<meta name="keywords" content="<?php echo $metakwd; ?>"/>
<meta name="description" content="<?php echo $metadesc; ?>" />
<meta name="generator" content="<?php echo $metatitle; ?>" />
<!-- ll<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-core.js" ></script>ll -->
<!-- ll<script type="text/javascript" src="<?php echo base_url();?>public/js/modal.js"></script>ll -->
<!-- ll<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-more.js"></script>ll -->
<!-- <script src="<?php echo base_url();?>public/js/programs.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>public/default/js/jquery-1.7.1.min.js"></script>
<!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/default/css/style.css" />-->
<link rel="stylesheet" href="<?php echo base_url() ?>public/default/css/lecture_dashboard.css">
<link rel="stylesheet" href="<?php echo base_url() ?>public/default/css/my_lecture_style.css">
    <?php //$tab_class = "tab-curriculum"; ?>

<style type="text/css">
  @media (max-width: 767px){
.panel-primary > .panel-heading {

    width: 100%;
}
}
  @media (min-width: 768px){
  /*  .Qpage {
    height: 60%;
    overflow-y: scroll;
}*/

 /*   
#sidebar{
  width: 0!important;
}
#main{
  right: 0!important;
  margin-right: 0!important;
}
#tab-curriculum2{
position: fixed!important;
bottom: 0!important;
right: 0!important;
top: 80%!important;
}*/
<?php// $tab_class = "tab-curriculum2"; ?>
}
</style>
<?php 
    $quizzid =  null;
    $isfinal = 0;
    //echo $db_mediatext[10]."<br>";
    //echo $db_media[13]."<br>";
    //echo $db_media[9];
        //print_r($db_media[9]->media_id);
        //print_r($db_mediatext[10]);
    if(isset($db_media[14]->media_id))
    {
      $quizzid = $db_media[14]->media_id;
    }
    elseif(isset($final_exam_id))
    {
      $quizzid = $final_exam_id;
    }
    if((isset($quizzid)) and ($quizzid != null))
    {
      $quizz = $this->quizzes_model->getItems($quizzid);
      
      $isfinal = (empty($quizz)) ? 0 : $quizz->is_final;
    }
    ?>
<script type="text/javascript" language="javascript">
  function openWinCertificatev(t1)
  {
            //   myWindow=window.open('<?php echo base_url() ?>lessons/viewcertificate/<?php echo $program_id; ?>');
                 myWindow=window.open('<?php echo base_url() ?>lessons/viewcertificate/'+t1+'','','width=800,height=600, resizable = 0');
      myWindow.focus();
  }
var bool = true;

  function elementInArray(element, array){
    exist = false;
    for(x=0; x < array.length; x++){
      if(array[x] && (element == array[x])){
        exist = true;
      }
    }
    return exist;
  }

  function get_quiz_result(){
    iJoomlaStopTimer();
    var quize_id = document.getElementById("quize_id").value;

    var number_of_questions = document.getElementById("question_number").value;
    var course_id =<?php echo $program_id;?>;
    saveInDbQuiz(quize_id, 0, number_of_questions,course_id);
       // var el = document.getElementById( 'webid1' );
       //  var e2 = document.getElementById( 'video' );
       // var e2 = document.getElementById( 'webid2' );
//el.parentNode.removeChild( el );
//e2.parentNode.removeChild( e2 );
        //$("#webid1").remove();
        //$("#webid2").remove();
        //alert('Hii');
       // document.getElementById('webid1').removeChild(webid1);
       // e1.removeChild(e2);

       stopTimer1();


  }

    function saveInDBase(saved_quiz_id, ansgivedbyuser, question_id,quize_id,time_quiz_taken,questions_ids_random){
    if(ansgivedbyuser == ''){
    ansgivedbyuser = '-';
    }
    var url ="<?php echo base_url();?>lessons/saveInDb/"+saved_quiz_id+"/"+ansgivedbyuser+"/"+question_id +"/"+quize_id +"/"+time_quiz_taken+"/"+questions_ids_random+"/";
    //var url ="index.php?option=com_guru&amp;controller=guruTasks&amp;task=saveInDb&amp;saved_quiz_id="+saved_quiz_id+"&amp;ans_gived="+ansgivedbyuser+"&amp;qstion_id="+question_id +"&amp;quiz_id="+quize_id +"&amp;time_quiz_taken="+time_quiz_taken+"&amp;questions_ids_list="+questions_ids_random+"&amp;no_html=1";
    var req = new Request.HTML({
      method: 'get',
      url: url,
      data: { //'do' : '1'
      },
      onSuccess: function(response){
      }
    }).send();
  }

  function saveInDbaseHowManyRightAns(quize_id,how_many_right_answers,number_of_questions, question_id1, saved_quiz_id){

      question_id1=question_id1.split(",").join("-");
      //saved_quiz_id=saved_quiz_id.split(",").join("-");
    var url ="<?php echo base_url();?>lessons/saveInDbaseHowMany/"+quize_id+"/"+how_many_right_answers+"/"+number_of_questions+"/"+question_id1+"/"+saved_quiz_id+"/";
    /* /index.php?option=com_guru&amp;controller=guruTasks&amp;task=saveInDbaseHowMany&amp;quiz_id="+quize_id+"&amp;howmanyans="+how_many_right_answers+"&amp;numbofquestions="+number_of_questions+"&amp;qstion_id="+question_id1 +"&amp;saved_quiz_id="+saved_quiz_id +"&amp;no_html=1;*/
    var req = new Request.HTML({
      method: 'get',
      url: url,
      data: { //'do' : '1'
      },
      onSuccess: function(response){
      }
    }).send();
  }

  function saveInDbQuiz(quize_id,how_many_right_answers,number_of_questions,course_id){
  //alert(how_many_right_answers);
    var url ="<?php echo base_url();?>lessons/saveInDbQuiz/"+quize_id+"/"+how_many_right_answers+"/"+number_of_questions+"/"+course_id+"/";
    //var url ="index.php?option=com_guru&amp;controller=guruTasks&amp;task=saveInDbQuiz&amp;quiz_id="+quize_id+"&amp;howmrans="+how_many_right_answers+"&amp;numbofquestions="+number_of_questions+"&amp;course_id="+course_id+"&amp;no_html=1";
    var savedQuizId = 0;
    var req = new Request({
      method: 'get',
      url: url,
      data: { //'do' : '1'
      },
      onSuccess: function(saved_quiz_id){
        //get_quiz_result_continued(saved_quiz_id);
        get_quiz_result_continued(saved_quiz_id);
      }
    }).send();
  }

</script>
<script  type="text/javascript">

    function getdetails(imgdata){
     var uid = '<?php echo $user_id;?>';
         var pid = '<?php echo $pro_id;?>';
         var rno='212';
     $.ajax({
     type: "POST",
     url: "<?php echo base_url()?>lessons/uploadwebshorts/",
     data: {imagedata:imgdata, id:rno,usrid:uid,prgid:pid}
     }).done(function( result ) {
     $("#photoimg").attr('src', result);
     });
     }
</script>
</head>
<body>
  <input type="hidden" id="visited_time" value="<?php echo time();?>">
<!----------------------------------------------------b-b's-layout-end----------------------------------------------------------------- -->
<!---------------------------------------------------Old-layout-start------------------------------------------------------------------- -->
<?php

$sequential = false;
//if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >=0 && $not_show === TRUE)
if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 0 && $coursetype_details[0]["lesson_release"] >=0 && $not_show === TRUE)
{
  $sequential = true;
}

//function checkdate($lessonid){
function lessondate($programnavarray,$lessid,$diff_start)
{
  (int) $daysval = count($programnavarray)/2;
  //$daysval;
  $newarray = array();
  for($ip=0;$ip<$daysval;$ip++){
    if(!empty($programnavarray['lessons'.$ip]))
    {
    $il=0;
    foreach($programnavarray['lessons'.$ip] as $less){
      //$newarray[] = $less;
      if((intval($less) == intval($lessid)) && ($diff_start > 0) ){
      return 'open';
      }
      $diff_start--;
      }
    }
  }
}

if($isfinalview == false){
 (int) $M_currkey  = array_search($moduleid, $programnavarray);
 (int) $M_prevkey = $M_currkey - 1;
 (int) $M_nextkey = $M_currkey + 1;
 (int) $M_lastkey = count($programnavarray)/2;
 (int) $M_lastkey = $M_lastkey - 1;
 (int) $L_currkey  = array_search($lesson->id, $programnavarray['lessons'.$M_currkey]);
 (int) $L_prevkey = $L_currkey - 1;
 (int) $L_nextkey = $L_currkey + 1;
 (int) $L_lastkey = array_search(end($programnavarray['lessons'.$M_currkey]), $programnavarray['lessons'.$M_currkey]);
$prevLval = ($L_prevkey >= 0) ? $programnavarray['lessons'.$M_currkey][$L_prevkey] : NULL;
$nextLval = ($L_nextkey <= $L_lastkey) ? $programnavarray['lessons'.$M_currkey][$L_nextkey] : NULL;

if($prevLval != NULL )
{
  if($sequential == true){
  $prevurl = (lessondate($programnavarray, $prevLval, $diff_start)=='open') ? Lurl($program_id, $moduleid, $prevLval) : NULL;
  }else{
  $prevurl = Lurl($program_id, $moduleid, $prevLval);
  }

}else{
$prevMval = ($M_currkey >= 0) ? $programnavarray[$M_currkey] : NULL;
$programnavarray['lessons'.$M_currkey][0];
$prevurl = Murl($program_id, $prevMval);
}

if($nextLval != NULL)
{
  if($sequential == true)
  {
    $nexturl = (lessondate($programnavarray, $nextLval, $diff_start)=='open') ? Lurl($program_id, $moduleid, $nextLval) : NULL;
  }else
  {
    $nexturl = Lurl($program_id, $moduleid, $nextLval);
  }
}
else
{
  $nextMval = ($M_nextkey <= $M_lastkey) ? $programnavarray[$M_nextkey] : NULL;
  if($sequential == true)
  {
    $nexturl = (lessondate($programnavarray, $L_nextMod, $diff_start)=='open') ? Murl($program_id, $nextMval) : NULL;
  }else
  {
    $nexturl = Murl($program_id, $nextMval);
  }
}

$modcount = count($programnavarray)/2;
$modcurr = array_search($moduleid, $programnavarray)+1;
$lescount = count($programnavarray['lessons'.$M_currkey]);
$lescurr = $L_currkey+1;

}else{
$nexturl = NULL;
$prevurl = NULL;
}
function Lurl($program_id,$moduleid,$lid){
return ($lid != NULL) ? base_url()."lessons/lesson/".$program_id."/".$moduleid."/".$lid."/" : NULL;
}
function Murl($program_id,$mid){
return ($mid != NULL) ? base_url()."lessons/module/".$program_id."/".$mid."/" : NULL;
}


if(($isfinalview == false) and (isset($finalexamid)) and ($nexturl == NULL)){

$nexturl = base_url()."lessons/finalexam/".$program_id."/".$finalexamid."/" ;
}

if(($isfinalview == true) and (isset($finalexamid)) and ($prevurl == NULL)){
(int) $M_lastkey = count($programnavarray)/2;
$M_lastkey = $M_lastkey - 1;
$prevLval= end($programnavarray['lessons'.$M_lastkey]);
$prevMval = $programnavarray[$M_lastkey];

  $prevurl = Lurl($program_id,$prevMval,$prevLval);

}
?>
<?php
  $this->load->model('admin/programs_model');
  $coursename=$this->programs_model->getCoursename5($pro_id); 

  $urlCourse = strtolower($coursename->name);     
  $urlCourse = trim(str_replace(' ', '-', $urlCourse));
  $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);
?>
<div id="course-taking-page" class="ud-dashboard wrapper lesson_page">
</a>
<div class="main" id="main" >
<div class="lecture_prev_top">
<a id="go-back" href="<?php echo base_url(); ?><?php echo $urlCourse;?>/lectures/<?php echo $pro_id; ?>" class="pos-r zi1 ml15 mt15 dif text-topaz back_to_course_btn fs12 bold ml0-md"> <i class="icon-chevron-sign-left fs16 mr5"></i> <span class="back_to_course">Back to Course</span></a>
 <input id='test_status' value='' hidden='hidden'>
  <!-- <span id="Course_Name" class="custom-bdcrumb"> -->
   <?php
   $days = $this->program_model->getlistDays($program_id);

          if($days)
          {
    foreach ($days as $day)
                {
                  //print_r($day);
                  if(($isfinalview == false))
                  {
                  if($moduleid == $day->id)
                  {
                      // echo "<b style='color:ededed; class='introduction_title'>".$day->title." :</b> ";
                      
                       $coursetype_name = $this->program_model->getprogName($program_id);
                        echo "<span class='course_title'>".$coursetype_name->name." :</span> ";
                      
                      //$lessons = $this->program_model->getLessons($day->id);
                      $lessons = $this->program_model->getLessonNew($day->id);
                      foreach ($lessons as $lessonn)
                      {
                        
                        if($lessonn->id == $lesson_id)
                        {
                          
                           echo "<span class='lesson_title'>".$lessonn->name."</span>";                
                            }     
                      }
                   }
               
                   }
                   
               }
           }
               ?>
   
   <!--  <div id="theme_color" class="theme_color">
    
      
        <b class="dropbtn">Theme Color</b>
        <div class="dropdown-content" style="left:0;">
              <a href="#" id="black_color">Black Color</a>
              <a href="#" id="white_color">White Color</a>
          </div>
          
  </div> -->
  <div class="bottom" id="bottom"><!--<a class="autoplay on" data-name="lectureAutoStart"> Auto Play <span class="autoplay-text-on">ON</span> <span class="autoplay-text-off none">OFF</span> </a>-->
        <?php     
        // echo $nexturl;
      if($nexturl != NULL)
      {
        $url = explode('/',$nexturl);
        $pro_id = $url[5];
        $mod_id = $url[6];
        $nextlesson_id = $url[7];
        // print_r($url);
        // $pro_id = $url[3];
        // $mod_id = $url[4];
        // $nextlesson_id = $url[3];
        if($nextlesson_id)
        { 
        ?>
        <div id='myNextLect'>
          <?php //echo $level;
        if($programs->is_drip_course == '1')
          { //echo "1";
           if($lesson->is_demo != '1'){ ?>      
            <span style="display:none" class="btn chk_mrk_btn" id="next-lecture" style="margin-right: 15px;left: 132px;cursor:pointer" onClick="nextslide('<?php echo $pro_id;?>','<?php echo $mod_id;?>','<?php echo $nextlesson_id;?>','<?php echo $lessonSrNo;?>','<?php echo $lesson->layoutid; ?>','<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>');"  >Next Lecture</span>
                <!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
              <?php }
              } else { // echo "2";
              if($lesson->is_demo != '1'){ ?>
            <span  class="btn chk_mrk_btn" id="next-lecture" style="margin-right: 15px;left: 132px;cursor:pointer" onClick="nextslide('<?php echo $pro_id;?>','<?php echo $mod_id;?>','<?php echo $nextlesson_id;?>','<?php echo $lessonSrNo;?>','<?php echo $lesson->layoutid; ?>','<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>');" >Next Lecture</span>
            <?php }
            else {
              ?>
              <span class="btn chk_mrk_btn" id="next-lecture" style="margin-right: 15px;left: 132px;cursor:pointer" onClick="nextslide('<?php echo $pro_id;?>','<?php echo $mod_id;?>','<?php echo $nextlesson_id;?>','<?php echo $lessonSrNo;?>','<?php echo $lesson->layoutid; ?>','<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>');"  >Next Lecture</span>
              <?php
            } } ?>
            </div>
            <?php 
              }
            else
             {
              ?>
              <div id='myNextLect'>
              </div>
              <?php
             }
      }
    ?>
     
        <?php
        $CI =& get_instance();
    $CI->load->model('lessons_model');
    $sessionarray = $this->session->userdata('logged_in');
    $user_id = $sessionarray['id'];
    $pid = $this->uri->segment(3);
        $lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $pid);
    
    if($layoutid != 'finalexam')
    {
      if(!empty($lesson_viewed2))
      {
        foreach($lesson_viewed2 as $compltData)
        {         
          $marks = '|'.$lesson_id.'|';
          if(strpos($compltData->mark_as_completed, $marks) !== false)
          {
            //$lessonData = str_replace($marks,'',$compltData->mark_as_completed);//if found then replace to blank
            ?>
            <div id='mark_as_complete' style="float: right;">
            <a class="chk_mrk" href="#" onclick ="markCompleted();"><input type="button" value="Mark as Incomplete" class="btn chk_mrk_btn">
            </a>
              <!-- <div style='background:#17aa1c' onclick ="markCompleted();" class="mark mini-tooltip">
                    <span class="tooltip-content"><b>Mark as Incomplete</b></span>
                  </div> -->
            </div>
                <?php
          }
          else
          {
            ?>
            <div id='mark_as_complete' style="float: right;">
            <a class="chk_mrk" href="#" onclick ="markCompleted();"><input type="button"  value="Mark as Completed" class="btn chk_mrk_btn"></a>
              <!-- <div onclick ="markCompleted();" class="mark mini-tooltip">
                    <span class="tooltip-content"><b>Mark as Completed</b></span>
                  </div> -->
              </div>
            <?php
          }
        }       
      }
      else
      {
        $lessonData = '|'.$lesson_id.'|';
        $this->lessons_model->updateViewLesson($lesson_id,$user_id,$pid,$module_id,$lessonData);  
        ?>
          <div id='mark_as_complete'>
            <?php if($lesson->is_demo != '1'){ ?>
          <a class="chk_mrk" href="#" onclick ="markCompleted();"><input type="button" value="Mark as Completed" class="btn chk_mrk_btn"></a>
        <?php } ?>
          <!-- <div onclick ="markCompleted();" class="mark mini-tooltip">
                <span class="tooltip-content"><b>Mark as Completed</b></span>
              </div> -->
              </div>
        <?php
      }
    }//mine
        ?>        

        </div>
  </div>
  

  <ul id="timeline" style="transform: translateY(-100%);">
    <li class="chapter"> <span class="percent chapter-number"> <span>Section</span> 1 </span>
      <div class="note"> </div>
      <div class="bottom"> <a href="" class="next-lecture continue">Continue</a> </div>
    </li>
    <li class="on" data-lectureid="2335868">
    <div class="prev-lecture" id="prev-lecture" style="display:block">
          <?php 
      if($prevurl != NULL)
      {
        $url = explode('/',$prevurl);
        $pro_id = $url[5];
        $mod_id = $url[6];
        $prelesson_id = $url[7];
        if($prelesson_id)
        {       
        ?>
        <!-- <a href="javascript:void(0)" onClick="nextslide('<?php echo $pro_id;?>','<?php echo $mod_id;?>','<?php echo $prelesson_id;?>','1');" ><i class="icon-chevron-up"></i></a> -->
        <span style="cursor:pointer" onClick="nextslide('<?php echo $pro_id;?>','<?php echo $mod_id;?>','<?php echo $prelesson_id;?>','<?php echo $lessonSrNo;?>','<?php echo $lesson->layoutid; ?>','<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>');">Previous Lecture</span>
        <?php 
          }
      }
      if($layoutid == 'finalexam')
        {
          $CIq =& get_instance();
              $quizid = $this->uri->segment(4);
              $quizz = $CIq->quizzes_model->getItems($quizid);
              
        ?>
                <a href="javascript:void(0)"><i class="icon-chevron-up"></i></a><span style="cursor:pointer" >Quiz : <?php echo $quizz->name;?> - <?php echo $pname;?></span>
        <?php
        }
      ?>
    </div>
    <span class="view-supplementary fs10-force-md mt0-force-md dn-force-xs dn-md none"> View resources </span>
    
    <?php $attributes = array('class' => 'tform', 'id' => 'proform');
      echo form_open_multipart(base_url().'programs/uploadAssign', $attributes); ?>

    <div id="overlay" class="img_load" style="display: none;"><img src="<?php echo base_url("public/images/loading.gif"); ?>" /></div>
    <div id="style-5" class="asset-container scrollbar" >

    
        <?php 
//        echo $layoutid;
    if($layoutid=='1')
    {  ?>
    <?php 
// <video controls id="player">
//       <!-- Video files -->
      
//       <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" >

//       <!-- Caption files -->
//       <track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
//           default>
//       <track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

//       <!-- Fallback for browsers that don't support the <video> element -->
//       <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
//   </video>
  
//   <div class="actions">
//     <button type="button" class="btn js-play">Play</button>
//     <button type="button" class="btn js-pause">Pause</button>
//     <button type="button" class="btn js-stop">Stop</button>
//     <button type="button" class="btn js-rewind">Rewind</button>
//     <button type="button" class="btn js-forward">Forward</button>
//   </div>
   
 ?>
            <?php
            if($lesson->lecture_type == "video")
            { 
              // print_r($lesson);
              ?>
              <div class="video-divs">
                <div data-vimeo-defer id="made-in-ny" class="made-in-ny"></div>
              </div>
              <script>
                play_video(1);
              </script>
              
            <?php 
            } else{
              echo $lessonsContent->lecture_content;  
              ?>
              <style type="text/css">
                .asset-container {
                  overflow: auto;
                }
              </style>
              <?php
            }
            ?>
             <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/qDxQwspFP44?&start=20&rel=0" frameborder="0" allow="accelerometer; encrypted-media; autoplay=none; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
 <?php    }
    else if($layoutid == '22')
     { 
     ?>

<script>
   nextslideweb("<?php echo $pro_id;?>","<?php echo $mod_id;?>","<?php echo $nextlesson_id;?>","<?php echo $lesson->is_webinar; ?>");

function nextslideweb(pro_id,mod_id,lesson_id,web_id)
{
  $("#proid").val(pro_id);
      $("#webid").val(web_id);
      $("#modid").val(mod_id);
      $("#lessid").val(lesson_id);
      var ufname = $("#u_fname").val();
          
      $.ajax({
      type: "POST",
      url: "<?php echo base_url()?>conwebinar/ajaxwebinar/",
      data: { 'progid':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id, 'webinarid':web_id, 'ufname': ufname},
      beforeSend : function( data ) {
        $("#overlay").show();
       $(".asset-container").html('');
     }
      }).success(function(data) 
      {   
        
        // var obj = JSON.parse(data);  
        // console.log(obj.wiziq_presenter_url);  
        if(data=='error')
        {
          alert('There was error while processing, try again!');
        }
        else
        {   
          console.log('run');
          var str = '<div class="iframe_div">';
          
        
        // str += '<iframe src="'+obj.wiziq_presenter_url+'" style="width:100%;height:700px" ></iframe>';

         // if($perfect_url)
         // {
          // str += '<iframe src="<?php echo $perfect_url; ?>" style="width:100%;height:700px" ></iframe>';
         // }

          str += '</div>';

            //var dt = '<div class="show-progress"><div class="progress-top" style="position: relative; height: 100%;"> <span class="percent completion-ratio">0%</span><div class="note"> <span>You have completed <b class="completion-ratio">0%</b> of this course</span> </div></div><div class="feedback-form" style="height: 0%;"> </div></div><';
          //$(".asset-container").html(dt);         
         
          var iauto =1;
          if(iauto==1)
          {
            //return data;
             $("#overlay").hide();
          $(".asset-container").html(data);
          iauto++;
            }
             my_nexturllist(pro_id,mod_id,lesson_id, srno);        
                  my_previousurllist(pro_id,mod_id,lesson_id, srno);  
                  getMarkCompleted(pro_id,mod_id,lesson_id);  
          $(".ud-lectureangular").html(data); 

          highlight(srno);
          lecctureTitle(pro_id,mod_id,lesson_id); 
///////////////
          // var slider = 
          $(document).find('.bxslider1').bxSlider();
          //alert('yes');
       //slider.reloadSlider(); 
       ////////////   

          $(document).find('.bx-prev, .bx-next, .bx-pager-link, .bx-start, .bx-stop').removeAttr("href");
        }
      }); 
      
      getLessionNotes(pro_id,mod_id,lesson_id);
      getlessionDiscussion(pro_id,mod_id,lesson_id);
      setViewLesson(pro_id,mod_id,lesson_id); 
      backgroundColor();
}
</script>
     <!--  <div class="iframe_div">

      </div> -->

    <?php
    }
    else if($layoutid == '2')
    {
      echo "<input type='hidden' id='testfile' name='testfile' value=''>";
      $assign_id = $lesson->is_assignment;
      
      $getassign_check = $this->program_model->getAssignSub($assign_id,$user_id);
    $assign_checksub = $this->program_model->checkAssignSub($assign_id,$user_id);
      $assign_check = count($assign_checksub);
        $assign_info = $this->program_model->getAssignment($assign_id);
        $assign_contents = $this->program_model->getAssignContent($assign_id);
        $assignment =array();
      
       
    if($assign_check<='0')
      { // echo json_encode($assign_info);
        $assignment = array('status' => '','info' => $assign_info, 'content' =>$assign_contents);
      // echo json_encode($assignment);
    }
    else{
      // $getassign_check = $this->program_model->AssignSubContents($assign_id,$user_id);
      // print_r($getassign_check);
      $assignment = array('status' => 'submitted',
        'info' => $assign_info, 
        'content' =>$assign_contents, 
        'stud_content' => $getassign_check, 
        'date' => $getassign_check[0]['created_date']
        );
       //echo json_encode($assignment);

    }
        //-------------
    
    if($assignment['status'])
    { ?>
            <br><br><div class='panel panel-primary' style='height:auto' data-collapsed='0'>
            <div class='panel-heading'><div class='panel-title' style='padding-bottom: 0px;'>
          <p style='margin-top: 0;  '></p><center><h2 class='assgn_head' style='color:#fff;text-align:center'>Assignment : <?php echo $assignment['info']->assign_title; ?></h2></center>
          <?php if($assignment['date']){  ?>
<!--             <input name='assign_idd' value='"+web_id+"'  style='display:none'>
 -->        <p class='assgn_txt' style='margin-bottom: 0px; color:#fff!important;text-align:center;'>Assignment Submitted On: <span style='color:#fff'><?php echo $assignment['date']; ?></span></p>
          <?php } ?>
          </div></div>
          <div class='panel-body form-horizontal form-groups-bordered'>
          <div class='submitted'><h3>How did you do?</h3><p>Compare the instructor's example to your own</p></div>
        <?php if($assignment['content'])
        {  ?> 
        <div id='status_page'>
        <div class='InstructorView'>
        <?php  echo "<h4 style='color:#4985b8;'><i><b>".$assignment['info']->assign_title."</b></i></h4>";
         if($assignment['info']->assign_description){ ?>
            <div id='ass_desc' style='margin-left:5%;' ><br><?php echo $assignment['info']->assign_description; ?>
            </div>
        <?php } ?>
          </div>
                 <h3 class='green_txt'>Assignment Submitted</h3><button class='btn-info' onclick='open_work()' type='button' >View</button>
          </div>
          
          <div class='InstructorView' id='instrutorsubmitview' style='display:none'  ><h3 class="instrt_ex_head">Instructor Examples</h3>
            <h3 class='nameblock'><span class='nameicon'><?php echo implode('', array_map(function($v) { return $v[0]; }, explode(' ', $instuctor)));  //echo substr($uname,0,1); ?></span><?php  echo $instuctor; ?></h3><br>
        <?php $i = 1; 
          foreach ($assignment['content'] as $key1 => $value1)
          {
            echo "<div class='instruct_ex'><p>".$i.". ".$value1['que_text']."<br></p></div>";
            if($value1['que_attachment'])
            {
               $filename = $value1['que_attachment'];
               $arr = end(explode('.',  $filename));
                     //$arr =  $filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     $fileExtension = array('jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp');
                      
                      echo "<div id='srcview_".$i."'>";
                      
                       if (in_array($arr, $fileExtension) >= '1')
                      {
                          echo "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='".base_url()."public/images/".$filename."'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() public/images/'+r_file);
                      }
                     
                      else{
                         $videoExtension = array('webms','webm', 'mp4', 'ogv', 'mid');

                      if(in_array($arr, $videoExtension) >= '1')
                      {  
                          echo "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='".base_url()."public/images/".$filename."' type='video/mp4'></video></a><br>";
                      }
                      else{
                        $ext = $filename.split('.');
                      if($ext[1]){
                              echo "<br><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >".$filename."</a>";
                          }
                        }
                      }
                      echo "</div>";
            }
            if($value1['ans_text'])
            {
              echo "<div class='ans_grp'><p class='ans_head'>Answer : </p><br>".$value1['ans_text']."</div><br>";
            }
            if($value1['ans_attachment'])
            {
               $filename = $value1['ans_attachment'];
               $arr = end(explode('.',  $filename));
                     //var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     $fileExtension = array('jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp');
                      
                       echo "<div id='srcview_".$i."'>";
                      
                       if (in_array($arr, $fileExtension) >= '1')
                      {
                          echo "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='".base_url()."public/images/".$filename."'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() public/images/'+r_file);
                      }
                     
                      else{
                         $videoExtension = array('webms','webm', 'mp4', 'ogv', 'mid');

                      if(in_array($arr, $videoExtension) >= '1')
                      {  
                          echo "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='".base_url()."public/images/".$filename."' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                        $ext = $filename.split('.');
                      if($ext[1]){
                              echo "<br><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >".$filename."</a>";
                          }
                        }
                      }
                      echo "</div>";
            }
            $i++;
          
          } //foreach
          echo "</div>";
      }
      if($assignment['stud_content'])
      { 
        echo "<div class='InstructorView' id='yoursubmitview' style='display:none'><h3 class='your_sub'>Your Submission11</h3><h3 class='nameblock' ><span class='nameicon'>";
        //$strr = implode('', array_map1(function($v) { return $v[0]; }, explode(' ', $uname)));
        // echo $strr;
        foreach(explode(' ', $uname) as $uname1) $acronym .= mb_substr($uname1, 0, 1, 'utf-8');
        echo $acronym;

        echo "</span>".$uname."</h3><br>";

        $i = 1;
        foreach ($assignment['stud_content'] as $key1 => $value1)
        {
          echo "<div class='instruct_ex'><p>".$i.". ".$value1['que_text']."<br></p></div>";
            if($value1['que_attachment'])
            {
               $filename = $value1['que_attachment'];
               $arr = end(explode('.',  $filename));
                     //var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     $fileExtension = array('jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp');
                      
                       echo "<div id='srcview_".$i."'>";
                      
                       if (in_Array($arr, $fileExtension) >= '1')
                      {
                          echo "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='".base_url()."public/images/".$filename."'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() public/images/'+r_file);
                      }
                     
                      else{
                         $videoExtension = array('webms','webm', 'mp4', 'ogv', 'mid');

                      if(in_Array($arr, $videoExtension) >= '1')
                      {  
                          echo "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='".base_url()."public/images/".$filename."' type='video/mp4'></video></a><br>";
                      }
                      else{
                        $ext = $filename.split('.');
                      if($ext[1]){
                          echo "<br><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >".$filename."</a>";
                          }
                     }
                      }
                      echo "</div>";
            }
            if($value1['stud_ans'])
            {
              echo "<div><b>Answer : </b><br>".$value1['stud_ans']."</div><br>";
            }
            if($value1['ans_attach_for_stud'])
            {
               $filename = $value1['ans_attach_for_stud'];
               $arr = end(explode('.',  $filename));
                     //var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     $fileExtension = array('jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp');
                      
                       echo "<div id='srcview_".$i."'>";
                      
                       if (in_Array($arr, $fileExtension) >= '1')
                      {
                          echo "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='".base_url()."public/images/".$filename."'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() public/images/'+r_file);
                      }
                     
                      else{
                         $videoExtension = array('webms','webm', 'mp4', 'ogv', 'mid');

                      if(in_Array($arr, $videoExtension) >= '1')
                      {  
                          echo "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='".base_url()."public/images/".$filename."' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                        $ext = $filename.split('.');
                      if($ext[1]){
                          echo "<br><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >".$filename."</a>";
                          }
                        }
                      }
                      echo "</div>";
            }
            $i++;
        } //foreach
        echo "</div>";

      } 
      echo "</div></div>";

      //----------

      } //end if status
      else {
        echo "<br><br><div class='panel panel-primary' style='height:auto' data-collapsed='0'><div class='panel-heading'><div class='panel-title' style='padding-bottom: 0px;'>";
        echo "<p style='margin-top: 0;'></p><center><h2 class='assgn_head' style='color:#fff;text-align:center'>Assignment : ".$assignment['info']->assign_title."</h2></center>";
        // print_r($assignment['info']);
        echo "<input name='assign_idd' value='".$assign_id."'  style='display:none'>";
        if($assignment['info']->estimated_time){
        echo "<p class='assgn_txt' style='margin-bottom: 0px; text-align:center;'><span style='color:#fff'>".$assignment['info']->estimated_time." to complete</span>";
        }
        echo "</div></div>";
        echo "<div class='panel-body form-horizontal form-groups-bordered'>";
        if($assignment['info']->assign_description){
        echo "<div id='ass_desc' >".$assignment['info']->assign_description."</div>";
        }
        echo "<div id='wrapper' style='display:none'><center><div class='assgnmt_progress'><div class='progress_circle'><span class='bartext'>Instruction</span><br><span class='baricon'>1</span><span id='bar1' class='progress_bar'></span></div>";
        echo "<div class='progress_circle'><span class='bartext'>submission</span><br><span class='baricon'>2</span><span id='bar2' class='progress_bar'></span></div>";
        echo "<div class='progress_circle'><span class='bartext'>Instructor Example</span><br><span class='baricon'>3</span></div><br></div></center><hr></div>";

        echo "<div id='style-1' style='display:none' ><div id='instruct'><h2>Assignment Instructions</h2><div id='instructions'>".$assignment['info']->assign_instruction."</div>";
        if($assignment['info']->instruction_videos)
        {
        echo "<div class='requirements__title'>Instuction Video</div><div id='video11' ><center><video width='420' height='280' controls><source id='r_video' src='".base_url()."public/images/".$assignment['info']->instruction_videos."' type='video/mp4'></video></center><br></div>";  
        }
        if($assignment['info']->resources_files)
        {   
          $arr = end(explode('.',  $assignment['info']->resources_files));
          //var arr =  $assignment['info']->resources_files.substring($assignment['info']->resources_files.lastIndexOf('.') + 1).toLowerCase();
            $fileExtension = array('jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp');
            if (in_Array($arr, $fileExtension) >= '1')
              {
                echo "<div class='requirements__title'>Resource Media</div><center><img id='r_file' max-width='420' max-height='280' src='".base_url()."public/images/".$assignment['info']->resources_files."'></center><br>";
              }
              else{
                $res_name = substr($assignment['info']->resources_files, 10);
                echo "<br><b>Resource Files</b><br><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$assignment['info']->resources_files."' onclick='return false' id='".$assignment['info']->resources_files."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >".$res_name."</a>";
              }  
        }

      
        if($assignment['content'])
        {
          echo "<div id='Ques'><h4>Questions for this Assignment<br></h4></div>";
          $i = 1;
          foreach ($assignment['content'] as $key1 => $value1) 
          {
            echo "<div class='Qcon' id='Qcon_".$i."'>".$value1['que_text']."</div></br>";
            //echo "<li class='Qcon' id='Qcon_".$i."'>".$i.") ".$value1['que_text']."</li>";
            $i++;
            if($value1['que_attachment'])
            {
               $filename = $value1['que_attachment'];
               $arr = end(explode('.',  $filename));
                     //$arr =  $filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     $fileExtension = array('jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp');
                      
                      echo "<div id='srcview_".$i."'>";
                      
                       if (in_array($arr, $fileExtension) >= '1')
                      {
                          echo "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='".base_url()."public/images/".$filename."'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() public/images/'+r_file);
                      }
                     
                      else{
                         $videoExtension = array('webms','webm', 'mp4', 'ogv', 'mid');

                      if(in_array($arr, $videoExtension) >= '1')
                      {  
                          echo "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='".base_url()."public/images/".$filename."' type='video/mp4'></video></a><br>";
                      }
                      else{
                        $ext = $filename.split('.');
                      if($ext[1]){
                              echo "<br><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >".$filename."</a>";
                          }
                        }
                      }
                      echo "</div>";
            }
          }
        }


        echo "</div>";  // end Instruct
        
        echo "<div id='submission'><div class='assgnmt_grp_btn'></div><h2>Assignment Submission</h2>Save or Submit your work | <span id='status_ass' style='display:none' class='assgnmt_submit'> Assignment Submitted</span>";
        echo "<input type='submit' id='upQattach' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>";
        
        if($assignment['content'])
        { 
          echo "<div id='Ques'><h4>Questions for this Assignment<br></h4></div>";
          $i = 1;
          foreach ($assignment['content'] as $key1 => $value1) 
          {
            echo "<div class='Qset' id='Qset_".$i."'><p>".$i.". ".$value1['que_text']."</p><br></div>";
            if($value1['que_attachment'])
            {
               $filename = $value1['que_attachment'];
               $arr = end(explode('.',  $filename));
                     //$arr =  $filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     $fileExtension = array('jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp');
                      
                      echo "<div id='srcview_".$i."'>";
                      
                       if (in_array($arr, $fileExtension) >= '1')
                      {
                          echo "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='".base_url()."public/images/".$filename."'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() public/images/'+r_file);
                      }
                     
                      else{
                         $videoExtension = array('webms','webm', 'mp4', 'ogv', 'mid');

                      if(in_array($arr, $videoExtension) >= '1')
                      {  
                          echo "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='".base_url()."public/images/".$filename."' type='video/mp4'></video></a><br>";
                      }
                      else{
                        $ext = $filename.split('.');
                      if($ext[1]){
                              echo "<br><a style='width:250px; word-wrap:break-word;' href='".base_url()."lessons/filedownload/".$filename."' onclick='return false' id='".$filename."' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >".$filename."</a>";
                          }
                        }
                      }
                      echo "</div>";
            }
                  echo "<input name='Q_id[]' id='Q_id_".$i."' style='display:none' value='".$value1['q_id']."'>";
            echo "<div class='Qans'><label>Answer : </label> <div class='Qans' id='Qans_".$i."' style='display:none' ></div></div>";
            
            echo "<div class='textview' id='textview_".$i."' ><textarea class='col-sm-5 Ansview'  name='ansview[]' id='ansview_".$i."' style=' width: 40.5%;' placeholder='Enter Your Answer' ></textarea></div>";
                  echo "<div class='stufiles' id='stufiles_".$i."' style='display:none' >";
                  echo "<input name='Ans_att[]' id='Ans_att_".$i."' style='display:none' value=''> </div>";
                  echo "<div id='stuansfiles_".$i."'></div><span class='stuAttachment' id='stuAttachment_".$i."'><label for='stufilestyle_".$i."' class='btn btn-info uploadbutton ' >Add Attachment</label>";      
                  echo "<input type='file' name='stu_Att' onchange='stuAnsfile(this)'  class='stu_Att' data-icon='true' id='stufilestyle_".$i."'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span>";

                  echo "<div class='subview' id='subview_".$i."' style='diaplay:none' ></div>";
            echo "<div id='progress_stuattach_".$i."' class=' progress1 progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_stuattach_".$i."' class='progress-bar1' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div class='percent-bar1' id='percent_stuattach_".$i."'></div></div></div>";

            echo "";
            // alert(  value1.assign_id );
            $i++;
          }

        }
      
        

        echo "<button type='button' class='subconfirm assgn_submt btn btn-success' onclick='submit_confirm()' style='float:right' >Submit</button>";

        echo "</div>";  // end submission
         
        
        echo "<div id='instructor_ex'><div><h3>How did you do?</h3><br><br></div><p>Compare the instructor's example to your own</p><div id='alertsubmit'><div class='alert alert-info'><strong >Still you are not submitted your assignment!</strong></div></div>";
        echo "<div class='compare_assign'></div>";

        echo "</div></div>";

        echo "<input class='btn btn-info btn2' id='pre2'  style='display:none' type='button' value='Previous' onclick=show_prev('submission','bar2')>";
              echo "<input  class='btn btn-info btn1'  id='pre1'  style='display:none' type='button' value='Previous' onclick=show_prev('instruct','bar1')>";
              echo "<input class='btn btn-info btn2'  id='next2'  style='display:none' type='button' value='Next' onclick=show_next('submission','instructor_ex','bar2')>";
              echo "<input class='btn btn-info btn2' id='next1' style='display:none' type='button'  value='Next' onclick=show_next('instruct','submission','bar1')>";
            
        echo "<button type='button' id='btn-start' onclick='start_assign()'>Start assignment</button>";
        // echo "<button type='button' style='display:none' id='btn-end' onclick='end_assign()'>Finish</button>";
        
        echo "</div></div>"; //panel-body

      
        

      } //end status
    }

    elseif($layoutid=='12')
    {

      ?>
      <script>
        $(document).ready(function(){
          $(document).find("#sidebar_down").hide();
        document.getElementById("style-5").style.height = "94%";
        document.getElementById("responsive-sidebar").style.position = "fixed";
      });
      </script>
          <div class="ud-lectureangular" id="style-5">
           <!--  <div id="overlay">
          <img src="<?php //echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
        </div> -->

        <div class="texteditor_layoout">
          <?php
              //echo $lec_content;
          ?>
        </div>
        <?php
         $CIq =& get_instance();
                  $CIq->load->model('exam_model');
                  $quizz = $CIq->exam_model->getItems($lessonsContent->is_exam);

         if($quizz->exam_id){ ?>
              <div id="media_15" >
                <div class='my_main'>
                <div id='my_middle_content'>
                <?php                                           
                  //ajaxquizztotask($db_media[14]->media_id,15,'',$pro_id);
                  //ajaxQuestionsDisplay($db_media[14]->media_id,15,'',$pro_id);//my new function on date 13-05-2015                      
                 

                  $settings = $CIq->exam_model->getQues($lessonsContent->is_exam);
                  // print_r($settings);
                  //$quizz = $CIq->quizzes_model->getItems($db_media[14]->media_id);
                   // print_r($quizz);

                  // $CIless =& get_instance();//on dated 15-05-2015
                  // $settings = $CIless->lessons_model->getQuestionIds($lessonsContent->is_exam);
                 //$settings = $CIless->lessons_model->getQuestionIds($db_media[14]->media_id);   
          if($settings)
          {              
              $quiz_quesarr = $CIq->exam_model->get_count_ques($lessonsContent->is_exam);
              $totalquestions = $quiz_quesarr->Qcount;
          }
                  ?>

             <?php // print_r($quizz);
                  $attempt_limit = $this->exam_model->getStudAttempt($user_id,$quizz->exam_id,$pro_id);

              if($quizz->attempt_limit == '11')
              {
                $time_quiz_taken = 'Unlimited';
                $remaining = '';
                $remainAttempts = 1;//always set to 1 when unlimited attempts
              }
              else
              {
                $time_quiz_taken = $quizz->attempt_limit;  
                 //$remaining_attempts = $this->lessons_model->getAttempts($quizz->exam_id, $pro_id);

 // echo $attempt_no[0]->att_no;
                 $remainAttempts = ($time_quiz_taken - $attempt_limit[0]->att_no);
         // echo $remainAttempts;
                if($remainAttempts > 0)
                {
                  $remaining = '<font color=red> ('. $remainAttempts.' attempts remaining )</font>';
                }else{
                  $remaining = '<font color=red> ( Your quiz attempts completed )</font>';
                }
              }
              ?>
                  <div class="quiz_timer">

                    <div class="panel panel-primary" data-collapsed="0"> 

              <div class="panel-heading">
                <div class="panel-title" style="padding-bottom: 25px;">  
                  <p style="display: inline-block;float: left;
    width: 45%;margin-top: 0;margin-bottom: 0px; text-align:left;" class="quiz_title_sec"><span class="quiz_label">Quiz:</span> <span style="color:#fff" class="quiz_title"><?php echo $quizz->exam_title;?></span></p>

              
                
                 <?php
                 // print_r($quizz);
                if($quizz->time_limit_b == '1')
                {
                  ?> <div style="margin-bottom: 0px;display: inline-block;
    width: auto; text-align:right; float: right;" class="quiz_time_sec"><span class="quiz_time_label">Quiz time limit:</span> <span style="color:#fff;" class="quiz_time"><?php 
    if($quizz->duration_h > 0 && $quizz->duration_m >0) 
          echo $quizz->duration_h ." : ". $quizz->duration_m."  hours";
    else if($quizz->duration_h > 0) 
          echo $quizz->duration_h ." hours";
    else if($quizz->duration_m > 0)
          echo $quizz->duration_m+" minutes";
         ?></span> </div><?php
                }
                ?> 
                </div>  
              </div>


              <div class="panel-body col-sm-12 form-horizontal form-groups-bordered quiz_panel" > 
                <div class="col-sm-12">
                <?php if($quizz->description){ ?>
                <div class="form-group">
                  <!-- <label>Note:</label> -->
                    <span class="quiz_description" style="  margin-top: 20px;"><?php echo $quizz->description;?></span>
                </div>
              <?php }
                if($quizz->instructions){
                ?>
                <div class="form-group">
                   <label>Instructions:</label><br>
                  <span class="quiz_description" style=" display: block; margin-left: 40px"><?php echo $quizz->instructions;?></span>
                </div>
               <?php } 
                  if($quizz->exam_type != 3){
               ?>
                <div class="form-group quiz_basis" > 
                  
                  <?php if($quizz->passing_score > 0){ ?>
                    <!-- Minimum score to pass this quiz -->
                   <div> Minimum score of passing : <span style="color:#42943F"><?php echo @$quizz->passing_score;?>%</span></div>
                    <?php }?>
                  
                  <div>Questions: <span style="color:#42943F"><?php echo $totalquestions;?></span></div>
                  
                  <div>Total Marks: <span style="color:#42943F"><?php echo $quizz->total_marks;?></span></div>
                  
                </div>    
                </div>    
          
                  
                  <div class="col-sm-12">
                <div class="form-group"> 
                  <?php if($quizz->retake == '1'){ ?>This quiz can be taken up to: <span style="color:#42943F"><?php echo $time_quiz_taken;?></span> times<?php echo $remaining; }?>
                  </div>
                </div>
<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
                //echo $remainingExamTimes;
                ?>
                  <div class="col-sm-12">
                <div class="form-group"> 
                  

                  You can give quiz <?php echo $remainingExamTimes;?> more times
                  </div>
                </div>
<?php }?>
                  

                  <div class="col-sm-12">
                <div class="form-group"> 
                  You can always see your quiz results on your My Courses page
                  </div>
                </div>

            <?php } ?>

              

                <hr style="margin:0;" />



              </div>
              <div class="panel-footer">
               
                <?php
                if($remainAttempts > 0)
                {
                  $att = $attempt_limit[0]->att_no + 1;
                  ?>
                  <!-- <div class="form-group"> 
                    <input type="checkbox" name="" id="chk_agree" /> I agreed with all given instructions.
                  </div> -->
                  <button class="btn btn-sm btn-success btn-update" id="buy_loader" style="display: none;">
                      <img src="https://myonlineshiksha.com/public/images/loader_white.gif" width="28px" height="28px"> Wait
                    </button>
                  <button type='button' class="btn btn-sm btn-success btn-update" onClick="start_exam('<?php echo $att ?>','<?php echo $quizz->exam_title;?>',<?php echo $lesson->is_exam;//$db_media[14]->media_id;?>,<?php echo $pro_id;?>,'<?php echo $layoutid;?>','1','0');" value='Start Quiz' name='btnStartexam' id='btnStartexam'>Start Quiz</button>
                        <?php
                      }
                //ajaxquizztotask($db_media[14]->media_id,15)?>
              </div>
            </div>



            

               </div>          

              </div>
              </div>
        </div>
<?php } ?>


        <!-- <table cellspacing="0" cellpadding="0" align="center" width="100%">
                  <tbody><tr>
                    <td>
                      <?php if(isset($jump_but1)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="" >
                      <?php }?>
                    </td>
                    <td>
                      <?php if(isset($jump_but2)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
                      <?php }?>
                    </td>
                    <td>
                      <?php if(isset($jump_but3)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
                      <?php }?>
                    </td>
                    <td>
                      <?php if(isset($jump_but4)){?>
                      <input type="button" onClick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
                      <?php }?>
                    </td>
                  </tr>
                </tbody></table> -->

          </div>
          <?php 
//                 $chk = $this->exam_model->getreport($user_id, $quizz->exam_id);

//     if(@$chk){
//      // examreport($quizz->exam_id,$user_id,$attempt_limit[0]->att_no,$pro_id);

//       $examid = $quizz->exam_id; 
//       $stud_id =$user_id;  
//       $attempt = $attempt_limit[0]->att_no;
//       $pro_id = $pro_id;

//     $obt_marks = $this->exam_model->getmarks($examid,$stud_id,$pro_id,$attempt);
//      $exam_detail = $this->exam_model->getexamdetail($examid);
//       // print_r($exam_detail);
//        $str = str_split($obt_marks->obt_marks,3);
//       $data['examinfo'] = $exam_detail;
//     $data['obt_marks'] = $str[0];
//     $data['user_id'] = $stud_id;
//     $data['msg'] = "Your Score Report.";
// $pr = floatval($str[0]*100)/$exam_detail->total_marks;
//     $Percentage = round($pr).'%';
//     $countsub = $this->exam_model->chkSubjectiveQues($examid);
//     if($countsub > 0){
//       $status = "Panding";
//       $data['show_result'] = '0';
//     }
//     else{
//       if($exam_detail->passing_score <= $Percentage)
//       {
//         $status = $exam_detail->pass_feedback; //"Pass";
//       } 
//       else{
//         $status = $exam_detail->fail_feedback; //"Fail";
//       }
//       $data['show_result'] = '1';
//   }  
//     $post = array('stud_id' => $stud_id,
//     'exam_id' => $examid,
//     'pro_id' => $pro_id,
//     'attempt_no' => $attempt,
//     'obtain_marks' => $str[0],
//     'tot_marks' => $exam_detail->total_marks,
//     'percentage' => $Percentage,
//     'status' => $status,
//     'attempt_date' => date('Y-m-d h:i:sa'),
//   );
    
//     $data['status'] = $status;
//     $data['pr'] = $pr;
//     $data['attempt'] = $attempt;
//     $data['stud_id'] = $stud_id;
//     $data['program_id'] = $pro_id;


//     // if($attempt==1)
    
//     echo  $this->load->view('exams/examReport',$data , TRUE);

//   // print_r($chk); 
//     }
    } 
    elseif($layoutid=='finalexam')//myfinal exam section
    { 
      ?>
      <script type="text/javascript">
      $(document).ready(function(){
      $('#course-taking-page').bind('contextmenu', function(e) {
    return false;
}); });
      </script>
      <div id="media_15">
                <div class='my_main'>
                <div id='my_middle_content'>
                <?php                                           
                  //ajaxquizztotask($db_media[14]->media_id,15,'',$pro_id);
                  //ajaxQuestionsDisplay($db_media[14]->media_id,15,'',$pro_id);//my new function on date 13-05-2015                      
                  $CIq =& get_instance();
                  $CIq->load->model('exam_model');
                  $quizz = $CIq->exam_model->getItems($final_exam_id);

                  $settings = $CIq->exam_model->getQues($final_exam_id);
                  // print_r($settings);
                  //$quizz = $CIq->quizzes_model->getItems($db_media[14]->media_id);
                   // print_r($quizz);

                  // $CIless =& get_instance();//on dated 15-05-2015
                  // $settings = $CIless->lessons_model->getQuestionIds($lessonsContent->is_exam);
                 //$settings = $CIless->lessons_model->getQuestionIds($db_media[14]->media_id);   
          if($settings)
          {              
              $quiz_quesarr = $CIq->exam_model->get_count_ques($final_exam_id);
              $totalquestions = $quiz_quesarr->Qcount;
          }
                  ?>
                  <div class="quiz_timer">

                    <div class="panel panel-primary" data-collapsed="0"> 

              <div class="panel-heading">
                <div class="panel-title" style="padding-bottom: 0px;">  
                  <p style="margin-top: 0;margin-bottom: 0px; text-align:left; float: left;">Quiz: <span style="color:#fff"><?php echo $quizz->exam_title;?></span></p>

              
                
                 <?php
                if($quizz->show_limit_time == '0')
                {
                  ?> <p style="margin-bottom: 0px; text-align:right;">Quiz time limit: <span style="color:#fff;"><?php echo $quizz->duration_m;?></span> minutes </p>
                <?php 
                }
                ?> 
                </div>  
              </div>


              <div class="panel-body col-sm-12 form-horizontal form-groups-bordered"> 
                <div class="form-group">
                  <label>Note:</label>
                    <span class="quiz_description" style="  margin-top: 20px;"><?php echo $quizz->description;?></span>
                </div>
                <div class="form-group">
                   <label>Instructions:</label>
                  <span class="quiz_description" style="  margin-top: 20px;"><?php echo $quizz->instructions;?></span>
                </div>
                <div class="form-group"> 
                  
                  <div class="col-sm-5"> <?php if($quizz->pbl_max_score == '0'){?>Minimum score to pass this quiz : <span style="color:#42943F"><?php echo $quizz->passing_marks;?>%</span>
                    <?php }?>
                  </div> 
                </div>

                
                  <?php // print_r($quizz);
              if($quizz->attempt_limit == '11')
              {
                $time_quiz_taken = 'Unlimited';
                $remaining = '';
                $remainAttempts = 1;//always set to 1 when unlimited attempts
              }
              else
              {
                $time_quiz_taken = $quizz->attempt_limit;  

                 //$remaining_attempts = $this->lessons_model->getAttempts($quizz->exam_id, $pro_id);
                $attempt_limit = $this->exam_model->getStudAttempt($user_id,$quizz->exam_id,$pro_id);
 // echo $attempt_no[0]->att_no;
                 $remainAttempts = ($time_quiz_taken - $attempt_limit[0]->att_no);
         // echo $remainAttempts;
                if($remainAttempts > 0)
                {
                  $remaining = '<font color=red> ('. $remainAttempts.' attempts remaining )</font>';
                }else{
                  $remaining = '<font color=red> ( Your quiz attempts completed )</font>';
                }
              }
              ?>                

                <div class="form-group"> 
                  
                  <div class="col-sm-5">
                  Questions: <span style="color:#42943F"><?php echo $totalquestions;?></span>
                  </div>
                </div>

                <div class="form-group"> 
                  
                  <div class="col-sm-12">
                  <?php if($quizz->retake == '1'){?>This quiz can be taken up to: <span style="color:#42943F"><?php echo $time_quiz_taken;?></span> times<?php echo $remaining; }?>
                  </div>
                </div>
<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
                //echo $remainingExamTimes;
                ?>
                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  You can give quiz <?php echo $remainingExamTimes;?> more times
                  </div>
                </div>
<?php }?>
                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  You can always see your quiz results on your My Courses page
                  </div>
                </div>

                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  </div>
                </div>

                <hr style="margin:0;" />

                <div class="form-group"> 
                  

                  <div class="col-sm-5">

                              
            
        
          </div></div>
          <div class="form-group" > 

          <div class="col-sm-5" >

          <?php
          if($remainAttempts > 0)
          {
            $att = $attempt_limit[0]->att_no + 1;
            ?>
            <input type='button' class="btn btn-sm btn-success btn-update" onClick="start_exam('<?php echo $att ?>','<?php echo $quizz->exam_title;?>',<?php echo $final_exam_id;//$db_media[14]->media_id;?>,<?php echo $pro_id;?>,'<?php echo $layoutid;?>','1','0');" value='Start Quiz' name='btnStartexam' id='btnStartexam'>
                  <?php
                }
                //ajaxquizztotask($db_media[14]->media_id,15)?>

                  </div>
                </div>





              </div>

            </div>



            

          </div>          

            
      

      <div id="finalexam">
            <?php //ajaxquizztotask($finalexamid,16,$programdetail[0],$pro_id) ;?>
            <?php
        $enablewebcam = true; 
        if($enablewebcam && $webcamoption==1)
        {
          ?>
              <div id='webid2'> 
                <script>              
            (function() {
              // The width and height of the captured photo. We will set the
              // width to the value defined here, but the height will be
              // calculated based on the aspect ratio of the input stream.

              var width = 320;    // We will scale the photo width to this
              var height = 0;     // This will be computed based on the input stream

              // |streaming| indicates whether or not we're currently streaming
              // video from the camera. Obviously, we start at false.

              var streaming = false;

              // The various HTML elements we need to configure or control. These
              // will be set by the startup() function.

              var video = null;
              var canvas = null;
              var photo = null;
              var startbutton = null;

              function startup() {
                video = document.getElementById('video');
              sourceid = document.getElementById('sourceid');
                
                canvas = document.getElementById('canvas');
                photo = document.getElementById('photo');
                startbutton = document.getElementById('startbutton');

                navigator.getMedia = ( navigator.getUserMedia ||
                                       navigator.webkitGetUserMedia ||
                                       navigator.mozGetUserMedia ||
                                       navigator.msGetUserMedia);

                navigator.getMedia(
                  {
                    video: true,
                    audio: false
                  },
                  function(stream) 
                  {
                    if (navigator.mozGetUserMedia)//for firefox
                    {
                      //video.mozSrcObject = stream;//commented by yo on dated 09-07-2015 because src tag not working in the firefox 
                      video.src = URL.createObjectURL(stream);
                    } 
                    else 
                    {
                      var vendorURL = window.URL || window.webkitURL;
                  
                      video.src = vendorURL.createObjectURL(stream);
                    }
                    video.play();
                  },
                  function(err) {
                    console.log("An error occured! " + err);
                  }
                );

                video.addEventListener('canplay', function(ev){
                  if (!streaming) {
                    height = video.videoHeight / (video.videoWidth/width);
                  
                    // Firefox currently has a bug where the height can't be read from
                    // the video, so we will make assumptions if this happens.
                  
                    if (isNaN(height)) 
                    {
                        height = width / (4/3);
                    }
                  
                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                  }
                }, false);

                startbutton.addEventListener('click', function(ev){
                  takepicture();
                  ev.preventDefault();
                }, false);
                
                clearphoto();
              }

              // Fill the photo with an indication that none has been
              // captured.

              function clearphoto() {
                var context = canvas.getContext('2d');
                context.fillStyle = "#AAA";
                context.fillRect(0, 0, canvas.width, canvas.height);

                var data = canvas.toDataURL('image/png');
                photo.setAttribute('src', data);
              }
              
              // Capture a photo by fetching the current contents of the video
              // and drawing it into a canvas, then converting that to a PNG
              // format data URL. By drawing it on an offscreen canvas and then
              // drawing that to the screen, we can change its size and/or apply
              // other changes before drawing it.

              function takepicture() 
              {
                //for web cam shots
                  var context = canvas.getContext('2d');
                  if (width && height) 
                  {
                      canvas.width = width;
                      canvas.height = height;
                      context.drawImage(video, 0, 0, width, height);
                      var data = canvas.toDataURL('image/png');

                       $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>lessons/uploadwebcamshots",
                            data: {postData:data}, 
                            success: function(data)
                            {
                                
                            }
                          });        

                      photo.setAttribute('src', data);

                      //for screen shots 
                  //e.preventDefault();
                            html2canvas($('body'), {
                                onrendered: function(canvas){
                                    var imgString = canvas.toDataURL();

                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>lessons/uploadScreenShots",
                                        data: {postDataScreen:imgString}, 
                                        success: function(data)
                                        {
                                        }
                                    });                                  
                                }
                            });       
                  } 
                  else 
                  {
                    clearphoto();
                  }                           
                }
                // Set up our event listener to run the startup process
                // once loading is complete.
                window.addEventListener('load', startup, false);
            })(); 
            </script>
               </div>
              <?php 
        }
        ?>
            </div></div>        
      <?php     
    }
    elseif($layoutid=='certificate')
    {
    }
    ?>
        </div>

        <!--Jump Buttons-->
        <input type="hidden" name="" id="rez_type" value="<?php echo $programs->release_type ?>">

        
    </li>
    <li class="show-progress">
    <div class="progress-top" style="position: relative; height: 100%;"> <span class="percent completion-ratio">0%</span>
        <div class="note"> <span>You have completed <b class="completion-ratio">0%</b> of this course</span> </div>
    </div>
      <div class="feedback-form" style="height: 0%;"> </div>
    </li>
  </ul>
</div>
<!-- --------------------------------------------------Main-cont-panel-end---------------------------------------------------------------- --> 

<!-- --------------------------------------------------Sidebar-code---------------------------------------------------------------- -->
<?php
$displayDiv = (($layoutid == 'finalexam') ? 'pointer-events: none;' : '');
?>
<div id="responsive-sidebar" class="open_sidebar" onclick="openNav()">
    <span id="icon2"  ><span class="lnr lnr-arrow-left"></span><span>Course Content </span></span>
   <!--  <span id="closebtn" style="display: none;" class="closebtn toggle_btn" onclick="closeNav()">&times;</span> -->
  </div>
<div class="sidebar" id="sidebar" > <!--<i class="icon-chevron-right">-->
  <div class="sidebar-container" style="<?php echo $displayDiv;?>">
    <div class="tab-divs">
    <div id="tab-curriculum"  data-courseid="409734">
      <?php
    $hover_id = 1;
    $coursetype_details = $this->program_model->getCourseTypeDetails($program_id);
    //print_r($coursetype_details);    
    if($user_id > 0)
    {
      $date_enrolled = $this->program_model->datebuynow($program_id, $user_id);

      if(count($date_enrolled) > 0)
      {
        $not_show = true;
      }
      else
      {
        $not_show = false;
      }
      /*if(!$hasaccess)
      {
        $not_show = FALSE;
      }*/
      $date_enrolled = (count($date_enrolled) > 0) ? $date_enrolled->buydate : '';
      $date_enrolled = strtotime($date_enrolled);
    }

    if(isset($date_enrolled))
    {
      $start_relaese_date1 = (isset($coursetype_details[0]["start_release"])) ? $coursetype_details[0]["start_release"] : '';
      $start_relaese_date = strtotime($start_relaese_date1);
      $start_date =  $date_enrolled;
    }

    $allLessonIds = array();
    $i=0;
    $total_lesson = 0;

    $lessonSrNo=0;
    $myLessonArray= array();

    if($layoutid != 'finalexam')//if mine
    {   
      /////////////////////////////////@@@@@@@@@@@@@@@

              $lecture_ids =array();
              $complated_lecture_ids = array();

              // $my_lesson_total = 0;
              // $my_viewed_lesson_total = 0;
              // $bar_percentage = 0;
              if($days)
              {
                foreach ($days as $day)
                {             
                  $lessonsss = $this->program_model->getLessonNew($day->id);
                  //$my_lesson_total += count($lessons);              
                  
                  foreach ($lessonsss as $lessonsss)
                  { if($lessonsss->id)
                    {
                    array_push($lecture_ids,$lessonsss->id);
                      }
                    $lesson_viewedsss = $this->program_model->getCompletedLesson2($lessonsss->id,$user_id,$program_id);
                    
                    if(!empty($lesson_viewedsss))
                    {  
                      array_push($complated_lecture_ids,$lessonsss->id);
                      $my_viewed_lesson_total++;
                    }               
                  }
                }

                
              }
              
      /////////////////@@@@@@@@@@@@@@@@@@@ ?>
      <div class="course_heading"><h3>Course content<span class="close_sidebar"  onclick="closeNav()" ><span class="lnr lnr-cross"></span></span></h3></div>
      <div class="course_nm">Course Name : <?php 
      $coursetype_name = $this->program_model->getprogName($program_id);
      echo $coursetype_name->name; 
      ?>
       </div>
      <?php       
      foreach ($days as $day)
      {
      ?>
        <div id="coursesection">
          <div class="title"><?php echo "Chapter ".++$i." : ".$day->title; ?></div>
          <div id="coursesectionlecture">
        <?php
          $lessons = $this->program_model->getLessonNew($day->id);
        //$lessons = $this->program_model->getLessons($day->id);
        $total_lesson += count($lessons);
        $dayaccess = $day->access;
        ?>
        <ul class="course_cat1">
        <?php
      $j=0; 
      $k=0;
      // echo"<pre>";
      // print_r($lessons);
      // echo"</pre>";
      // exit('yes');
      foreach ($lessons as $lesson)
        {
        if($user_id && $not_show === TRUE){    
          $allLessonIds[] = $lesson->id;    
            if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE)
            {
                if($coursetype_details[0]["course_type"] == 1)
                {
            if($coursetype_details[0]["lesson_release"] == 1)
                    {
                        $date_to_display = strtotime ( '+'.$step_less++.' day' , $start_date) ;
                    }
                    elseif($coursetype_details[0]["lesson_release"] == 2)
                    {
                        $date_to_display = strtotime ( '+'.$step_less++.' week' , $start_date) ;
                    }
                    elseif($coursetype_details[0]["lesson_release"] == 3)
                    {
                        $date_to_display = strtotime ( '+'.$step_less++.' month' , $start_date) ;
                    }
                }
            }
      
        $lessonAccess = $lesson->step_access;
        //$access = isAccess($programs->id,$day->id,$lesson->id);
        $con1 = "stud_id = '".$user_id."' and course_id = '".$program_id."' and lecture_id = '".$lesson->id."'";
        $gettotal_spent = $this->Crud_model->get_single('mlms_lecture_statistics',$con1,'total_time_spent');
        $spent_time = '';
        if($gettotal_spent->total_time_spent > 0)
          $spent_time = '( '.total_spentTime($gettotal_spent->total_time_spent).' )';

        //commmented by yogesh on dated 06-12-2014
        //if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
        if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0))
        {
          $diff_start = 1;  //hardcoded by yogesh , remove this and solve above issue for $diffstart variable
          if($diff_start >0)
          { 
            ?>
                  <a href="<?php echo base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>"  class='outeranchor' ><span class="s_underline"><?php echo $lesson->name;?></span></a>
                  <?php 
          }
          else
          {
            ?>
                  <a href="<?php echo 'javascript:void(0)';?>" class='outeranchor' ><span class="s_underline"><?php echo $lesson->name;?></span></a>
                  <?php 
          }
        }
        else
        {
          ?>
                <a href="<?php echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='outeranchor'><span class="s_underline">
                <?php //echo $lesson->name;?>
                </span></a>
                <?php 
        }
      ?>
      <?php // if($lesson->release_type =='1' &&) ?>
        <li id='<?php echo $hover_id;?>' style="background-color :<?php echo $this->uri->segment(5) == $lesson->id ? '#A7C7E2' :'';?>">
        <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>
        <!-- <div class="cattext1" style="display: inline-block; width: 100%;" onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)"> -->
        <div class="cattext1" style="display: inline-block; width: 100%;">
        <?php  
      $lesson_viewed = $this->program_model->getViewLesson($lesson->id,$user_id,$program_id);

      if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
      {   
            if($diff_start >0)
            {   

          ?>
                <div class="less_lect_list">                
            <div class="lll_title">
              <a href="<?php echo base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo "Lecture". ++$j ;?> :
              </a>
            </div>
            
            <div class="lllt_txt">
              <a href="<?php echo base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo substr($lesson->name,0,25); ?></a><br>
              <!--<div id="sidebar" style="float:right;"> <a href="#" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start lecture</a> </div>--> 
            </div>             
                </div>
                <?php 
        }
            else
            {             
          ?>
                <div class="less_lect_list">
                <div class="lll_title">
          <a href="<?php echo 'javascript:void(0)';?>" class='' ><?php echo "Lecture". ++$j ;?> :</a>
                </div>
                <div class="lllt_txt">
                <a href="javascript:void(0)"><!--Title : -->
          <?php echo substr($lesson->name,0,25); ?></a> 
          <br>
               
                </div>
                </div>
                <?php 
        }
        }
        else
        {   
        ?>
        <div class="lll_title_main">
                <?php 
                if($lesson->layoutid == '12')
                  {
                    echo "Quiz ". ++$k ;
                  }
                else if($lesson->layoutid == '22')
                  {
                    echo "Webinar ". ++$k ;
                  }
                 else if($lesson->layoutid == '2')
                  {
                    echo "Assignment ". ++$j;
                  }
                else if($lesson->is_demo == '1')
                  {
                    echo "Demo ";
                  }
                  else
                  {
                    echo "Lecture ". ++$j ;
                  }

                ?> :                
              </div>
            <!-- <div class="less_lect_list" onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)"> -->
            <div class="less_lect_list">
              

              <div class="lll_title">
                <div class="ci-progress-container" id="maskDiv<?php echo $lesson->id; ?>" >
                <?php

            //$lesson_viewed2 = $this->lessons_model->getViewLesson2($lesson->id,$user_id);
            
            $lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $program_id);


            if(!empty($lesson_viewed2))
            {
              foreach($lesson_viewed2 as $compltData)
              {         
                $marks = '|'.$lesson->id.'|';
                if( strpos($compltData->mark_as_completed, $marks) !== false )
                {
                  ?>
                  <span class="ci-progress-maskgreencheck"></span>  
                      <?php   
                }
                else
                {
                  if($lesson_viewed)
                  {
                    ?>
                    <span class="ci-progress-mask green"></span>
                        <?php     
                  }
                }
              }
            }
            else
            {
              
            }
            ?>
                </div>
                

              </div>

              <?php
               
                if($seq)
                {

                   end($complated_lecture_ids);      
               $lec_key1 = key($complated_lecture_ids);
                 $lec_key = array_search($lesson->id,$complated_lecture_ids);
                 $lec_key2= $lec_key1+1;

                  //////
                  //$complated_lecture_ids;
              //$lecture_ids;
              //$my_viewed_lesson_total;

                  // if($lesson_viewed)
                  // {
            if(current($lecture_ids)==$lesson->id)
              {

              ?>
                
              <div class="lllt_txt lesson_<?php echo $lessonSrNo;?>">
                
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
                
              </div>
                <?php
                  }
                  else
                  {
                //     $prev_lesson_id = $lesson->id - 1;
                   // $lesson_Prev_viewed = $this->program_model->getPreviousViewLesson($prev_lesson_id,$user_id);
                   // if($lesson_Prev_viewed)
                    if($lec_key || $lecture_ids[$lec_key2] ==$lesson->id)
                  {
                    if($my_viewed_lesson_total>=1)
                     {
                     
                   
                ?>
                  <div class="lllt_txt lesson_<?php echo $lessonSrNo;?>">
                                    
                <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
                    <!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
                  </div>
                <?php
                      }
                      else
                      {
                        ?>
                        <div class="lllt_txt lesson_<?php echo $lessonSrNo;?>">

                    <a onClick="<?php echo $coursetype_details[0]["course_type"] == '1' ? 'stopNext()' : 'javascript:void(0)'; ?>" class='4 <?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php  echo $lesson->name;?></a> 
                    
                      </div>
                        <?php
                      }
                    }
                    else
                    {

                ?>
                  <div class="lllt_txt">
                                    
                <a onClick="<?php echo $coursetype_details[0]["course_type"] == '1' ? 'stopNext()' : 'javascript:void(0)'; ?>" class='2 <?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a>  
                    <!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
                  </div>

              <?php
                    }
                  }
                 }
                else
                { 
              ?>
                  <div class="lllt_txt">
                <?php //echo $level;
            
        if($programs->release_type == '')
          { ?>      
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>,<?php echo $lesson->layoutid; ?>,<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?>
              <br>
              <?php echo $spent_time;?>
            </a> 
                <!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
              <?php } 
          else if($programs->release_type == '1' && $lesson->release_date <= date('Y-m-d', time()))
          {  ?>
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>,<?php echo $lesson->layoutid; ?>,<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
              <?php } else if($programs->release_type == '2')
          {
            $buy_date1 = str_replace('-', '/', $enrolldata->buy_date);
            $lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));
            if($lect_date <= date('Y-m-d', time()))
            {
          ?>
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>,<?php echo $lesson->layoutid; ?>,<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
              <?php }
            else{ ?>
            <div >
            <?php  if($lesson->layoutid == '12')  { ?>
            <a onClick="slidemessage('<?php echo $lect_date; ?>','<?php echo $lesson->layoutid; ?>')" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>quiz Start On</a> <a style='color:red'>".$lect_date." </a> </center>";?></a> 
            <?php }else { ?>
            <a onClick="slidemessage('<?php echo $lect_date; ?>','<?php echo $lesson->layoutid; ?>')"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>Lecture Start From </a><a style='color:red'>".$lect_date." </a> </center>";?></a> 
          <?php } }
          }
          else{  if($lesson->layoutid == '12')  {   ?>
            <a onClick="slidemessage('<?php echo $lesson->release_date; ?>','<?php echo $lesson->layoutid; ?>')"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>quiz Start On </a><a style='color:red'>".$lesson->release_date." </a> </center>";?></a> 
            <?php } else { ?>
            <a onClick="slidemessage('<?php echo $lesson->release_date; ?>','<?php echo $lesson->layoutid; ?>')"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>Lecture Start From </a><a style='color:red'>".$lesson->release_date." </a> </center>";?></a> 
        <?php } } ?>
              </div>
                 <?php
                }
              ?>

            </div>
            <?php 
        $hover_id++;
      }
      $lessonSrNo++;

        if(!$lesson_viewed)
      {
            $display = "none";
      }
        else
      {
            $display = "inherit";
        }
        if($lesson->difficultylevel == 'easy')
      {
            $image_name = 'level_icon.png';
      }
        if($lesson->difficultylevel == 'medium')
      {
            $image_name = 'level_intmed_icon.png';
      }
        if($lesson->difficultylevel == 'hard')
      {
        $image_name = 'level_advance_icon.png';
        }
        @$diff_start--;
        ?>
            </div>              
            </li>
            <?php
          }
            else if($lesson->is_demo == '1')
      { ?>

        <div class="less_lect_list">                
            <div class="lll_title">
             <a href="<?php echo base_url()."lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo "Demo ". ++$j ;?> :
              </a>
            </div>
            
            <div class="lllt_txt">
              <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo substr($lesson->name,0,25); ?></a><br>
              <!--<div id="sidebar" style="float:right;"> <a href="#" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start lecture</a> </div>--> 
            </div>             
                </div>
  <?php }

        } // end of foreach lessions 

      ?>



        </ul>
        </div>
  </div>    
    <?php
}//end of foreach days
?>
<div id="ExamSection" style="display: none;">
  <div id="Quesmarkopt"></div>
  <!-- <a id="Quit" href="<?php echo base_url(); ?><?php echo $urlCourse;?>/lectures/<?php echo $pro_id; ?>" >Exit</a> -->
</div>
<?php
}//end of if mine

//for final exam link o dated 19-05-2015
$getPro = $this->lessons_model->getProgramFinalExam($program_id);
if(isset($getPro->id_final_exam) && ($getPro->id_final_exam > 0)) //&& ($getPro->webcam_option == 1)
{
  ?>
  <div id="coursesection">
  <!--<div class="title" onclick="nextslide(244,85,246,11)">Final Exam</div>-->
  <div class="title"><strong><a href="<?php echo base_url().'lessons/finalexamnew/'.$program_id.'/'.$getPro->id_final_exam.'/'.'';?>">Final Quiz</a></strong></div>
  </div>
        <div id='webcamera'>
                  <div class="camera">
                <video id="video">Video stream not available.</video>
                <button id="startbutton" hidden>Take photo</button> 
            </div>
            <canvas id="canvas" hidden></canvas>
            <div class="output" hidden>
              <img id="photo" alt="The screen capture will appear in this box."> 
            </div>
        </div>
  <?php
}
$this->session->set_userdata("myLessonArray",$myLessonArray);
?>

<!-- <li id="22222"> -->
    
 <!-- </li> -->

    </div>
  
  <input id="u_fname" type="hidden" value="<?php echo $sessionarray['first_name']; ?>">
    <input id="u_email" type="hidden" value="<?php echo $sessionarray['email'];?>">
  <input id="proid" type="hidden" value="<?php echo $this->uri->segment(3);?>">
  <input id="modid" type="hidden" value="<?php echo $this->uri->segment(4);?>">
  <input id="lessid" type="hidden" value="<?php echo $this->uri->segment(5);?>">

  <input id="lec_act_id" type="hidden" value="<?php echo @$lec_act_id;?>">

  </div>
  </div>
  </div>
<div id="sidebar_down" class="sidebar_down" > <!--<i class="icon-chevron-right">-->
  <div class="sidebar-container" style="<?php echo $displayDiv;?>">
    <div class="tab-label-container">
      <ul class="gray-nav">
      <li class="c active" href="#tab-curriculum" id="list">
          <label for="tab3"><span>Course Content</span><i class="entypo entypo-sweden"></i><!-- <i class="icon-list"></i> --></label>
        </li>
        <li class="e active" href="#extras" id="download1">
          <label for="tab1"><span>Downloads</span><i class="icon-download-alt"></i></label>
        </li>
        <li class="d ng-scope" href="#lecture-discussions" id="discussion">
          <label for="tab2" ><span>Q&A</span><i class="icon-comments"></i></label>
        </li>        
        <li class="n" href="#notes" id="note">
          <label for="tab4"><span>Notes</span><i class="icon-file-text-alt"></i></label>
        </li>
      </ul>
       <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="tab-divs">
    <div id="tab-curriculum" data-courseid="409734">
      <?php
    $hover_id = 1;
    $coursetype_details = $this->program_model->getCourseTypeDetails($program_id);
    //print_r($coursetype_details);    
    if($user_id > 0)
    {
      $date_enrolled = $this->program_model->datebuynow($program_id, $user_id);

      if(count($date_enrolled) > 0)
      {
        $not_show = true;
      }
      else
      {
        $not_show = false;
      }
      /*if(!$hasaccess)
      {
        $not_show = FALSE;
      }*/
      $date_enrolled = (count($date_enrolled) > 0) ? $date_enrolled->buydate : '';
      $date_enrolled = strtotime($date_enrolled);
    }

    if(isset($date_enrolled))
    {
      $start_relaese_date1 = (isset($coursetype_details[0]["start_release"])) ? $coursetype_details[0]["start_release"] : '';
      $start_relaese_date = strtotime($start_relaese_date1);
      $start_date =  $date_enrolled;
    }

    $allLessonIds = array();
    $i=0;
    $total_lesson = 0;

    $lessonSrNo=0;
    $myLessonArray= array();

    if($layoutid != 'finalexam')//if mine
    {   
      /////////////////////////////////@@@@@@@@@@@@@@@

              $lecture_ids =array();
              $complated_lecture_ids = array();

              // $my_lesson_total = 0;
              // $my_viewed_lesson_total = 0;
              // $bar_percentage = 0;
              if($days)
              {
                foreach ($days as $day)
                {             
                  $lessonsss = $this->program_model->getLessonNew($day->id);
                  //$my_lesson_total += count($lessons);              
                  
                  foreach ($lessonsss as $lessonsss)
                  { if($lessonsss->id)
                    {
                    array_push($lecture_ids,$lessonsss->id);
                      }
                    $lesson_viewedsss = $this->program_model->getCompletedLesson2($lessonsss->id,$user_id,$program_id);
                    
                    if(!empty($lesson_viewedsss))
                    {  
                      array_push($complated_lecture_ids,$lessonsss->id);
                      $my_viewed_lesson_total++;
                    }               
                  }
                }

                
              }
              
      /////////////////@@@@@@@@@@@@@@@@@@@ ?>
      <div class="course_nm">Course Name : <?php 
      $coursetype_name = $this->program_model->getprogName($program_id);
      echo $coursetype_name->name; 
      ?>
       </div>
      <?php       
      foreach ($days as $day)
      {
      ?>
        <div id="coursesection">
          <div class="title"><?php echo "Chapter ".++$i." : ".$day->title; ?></div>
          <div id="coursesectionlecture">
        <?php
          $lessons = $this->program_model->getLessonNew($day->id);
        //$lessons = $this->program_model->getLessons($day->id);
        $total_lesson += count($lessons);
        $dayaccess = $day->access;
        ?>
        <ul class="course_cat1">
        <?php
      $j=0; 
      $k=0;
      // echo"<pre>";
      // print_r($lessons);
      // echo"</pre>";
      // exit('yes');
      foreach ($lessons as $lesson)
        {
        if($user_id && $not_show === TRUE){    
          $allLessonIds[] = $lesson->id;    
            if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE)
            {
                if($coursetype_details[0]["course_type"] == 1)
                {
            if($coursetype_details[0]["lesson_release"] == 1)
                    {
                        $date_to_display = strtotime ( '+'.$step_less++.' day' , $start_date) ;
                    }
                    elseif($coursetype_details[0]["lesson_release"] == 2)
                    {
                        $date_to_display = strtotime ( '+'.$step_less++.' week' , $start_date) ;
                    }
                    elseif($coursetype_details[0]["lesson_release"] == 3)
                    {
                        $date_to_display = strtotime ( '+'.$step_less++.' month' , $start_date) ;
                    }
                }
            }
      
        $lessonAccess = $lesson->step_access;
        //$access = isAccess($programs->id,$day->id,$lesson->id);

        //commmented by yogesh on dated 06-12-2014
        //if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
        if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0))
        {
          $diff_start = 1;  //hardcoded by yogesh , remove this and solve above issue for $diffstart variable
          if($diff_start >0)
          { 
            ?>
                  <a href="<?php echo base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>"  class='outeranchor' ><span class="s_underline"><?php echo $lesson->name;?></span></a>
                  <?php 
          }
          else
          {
            ?>
                  <a href="<?php echo 'javascript:void(0)';?>" class='outeranchor' ><span class="s_underline"><?php echo $lesson->name;?></span></a>
                  <?php 
          }
        }
        else
        {
          ?>
                <a href="<?php echo ($not_show === TRUE) ? base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id : 'javascript:void(0)' ;?>" class='outeranchor'><span class="s_underline">
                <?php //echo $lesson->name;?>
                </span></a>
                <?php 
        }
      ?>
      <?php // if($lesson->release_type =='1' &&) ?>
        <li id='<?php echo $hover_id;?>' style="background-color :<?php echo $this->uri->segment(5) == $lesson->id ? '#A7C7E2' :'';?>">
        <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>
        <!-- <div class="cattext1" style="display: inline-block; width: 100%;" onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)"> -->
        <div class="cattext1" style="display: inline-block; width: 100%;">
        <?php  
      $lesson_viewed = $this->program_model->getViewLesson($lesson->id,$user_id,$program_id);

      if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
      {   
            if($diff_start >0)
            {   

          ?>
                <div class="less_lect_list">                
            <div class="lll_title">
              <a href="<?php echo base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo "Lecture". ++$j ;?> :
              </a>
            </div>
            
            <div class="lllt_txt">
              <a href="<?php echo base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo substr($lesson->name,0,25); ?></a><br>
              <!--<div id="sidebar" style="float:right;"> <a href="#" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start lecture</a> </div>--> 
            </div>             
                </div>
                <?php 
        }
            else
            {             
          ?>
                <div class="less_lect_list">
                <div class="lll_title">
          <a href="<?php echo 'javascript:void(0)';?>" class='' ><?php echo "Lecture". ++$j ;?> :</a>
                </div>
                <div class="lllt_txt">
                <a href="javascript:void(0)"><!--Title : -->
          <?php echo substr($lesson->name,0,25); ?></a> 
          <br>
               
                </div>
                </div>
                <?php 
        }
        }
        else
        {   
        ?>
        <div class="lll_title_main">
                <?php 
                if($lesson->layoutid == '12')
                  {
                    echo "Quiz ". ++$k ;
                  }
                else if($lesson->layoutid == '22')
                  {
                    echo "Webinar ". ++$k ;
                  }
                 else if($lesson->layoutid == '2')
                  {
                    echo "Assignment ". ++$j;
                  }
                else if($lesson->is_demo == '1')
                  {
                    echo "Demo ";
                  }
                  else
                  {
                    echo "Lecture ". ++$j ;
                  }

                ?> :                
              </div>
            <!-- <div class="less_lect_list" onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)"> -->
            <div class="less_lect_list">
              

              <div class="lll_title">
                <div class="ci-progress-container" id="maskDiv<?php echo $lesson->id; ?>" >
                <?php

            //$lesson_viewed2 = $this->lessons_model->getViewLesson2($lesson->id,$user_id);
            
            $lesson_viewed2 = $this->lessons_model->getViewLesson2($user_id, $program_id);


            if(!empty($lesson_viewed2))
            {
              foreach($lesson_viewed2 as $compltData)
              {         
                $marks = '|'.$lesson->id.'|';
                if( strpos($compltData->mark_as_completed, $marks) !== false )
                {
                  ?>
                  <span class="ci-progress-maskgreencheck"></span>  
                      <?php   
                }
                else
                {
                  if($lesson_viewed)
                  {
                    ?>
                    <span class="ci-progress-mask green"></span>
                        <?php     
                  }
                }
              }
            }
            else
            {
              
            }
            ?>
                </div>
                

              </div>

              <?php
               
                if($seq)
                {

                   end($complated_lecture_ids);      
               $lec_key1 = key($complated_lecture_ids);
                 $lec_key = array_search($lesson->id,$complated_lecture_ids);
                 $lec_key2= $lec_key1+1;

                  //////
                  //$complated_lecture_ids;
              //$lecture_ids;
              //$my_viewed_lesson_total;

                  // if($lesson_viewed)
                  // {
            if(current($lecture_ids)==$lesson->id)
              {

              ?>
                
              <div class="lllt_txt lesson_<?php echo $lessonSrNo;?>">
                
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
                
              </div>
                <?php
                  }
                  else
                  {
                //     $prev_lesson_id = $lesson->id - 1;
                   // $lesson_Prev_viewed = $this->program_model->getPreviousViewLesson($prev_lesson_id,$user_id);
                   // if($lesson_Prev_viewed)
                    if($lec_key || $lecture_ids[$lec_key2] ==$lesson->id)
                  {
                    if($my_viewed_lesson_total>=1)
                     {
                     
                   
                ?>
                  <div class="lllt_txt lesson_<?php echo $lessonSrNo;?>">
                                    
                <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
                    <!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
                  </div>
                <?php
                      }
                      else
                      {
                        ?>
                        <div class="lllt_txt lesson_<?php echo $lessonSrNo;?>">

                    <a onClick="<?php echo $coursetype_details[0]["course_type"] == '1' ? 'stopNext()' : 'javascript:void(0)'; ?>" class='4 <?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php  echo $lesson->name;?></a> 
                    
                      </div>
                        <?php
                      }
                    }
                    else
                    {

                ?>
                  <div class="lllt_txt">
                                    
                <a onClick="<?php echo $coursetype_details[0]["course_type"] == '1' ? 'stopNext()' : 'javascript:void(0)'; ?>" class='2 <?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a>  
                    <!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
                  </div>

              <?php
                    }
                  }
                 }
                else
                { 
              ?>
                  <div class="lllt_txt">
                <?php //echo $level;
            
        if($programs->release_type == '')
          { ?>      
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>,<?php echo $lesson->layoutid; ?>,<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
                <!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
              <?php } 
          else if($programs->release_type == '1' && $lesson->release_date <= date('Y-m-d', time()))
          {  ?>
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>,<?php echo $lesson->layoutid; ?>,<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
              <?php } else if($programs->release_type == '2')
          {
            $buy_date1 = str_replace('-', '/', $enrolldata->buy_date);
            $lect_date = date('Y-m-d',strtotime($buy_date1 . "+".$lesson->release_date." days"));
            if($lect_date <= date('Y-m-d', time()))
            {
          ?>
            <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>,<?php echo $lesson->layoutid; ?>,<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
              <?php }
            else{ ?>
            <div >
            <?php  if($lesson->layoutid == '12')  { ?>
            <a onClick="slidemessage('<?php echo $lect_date; ?>','<?php echo $lesson->layoutid; ?>')" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>quiz Start On</a> <a style='color:red'>".$lect_date." </a> </center>";?></a> 
            <?php }else { ?>
            <a onClick="slidemessage('<?php echo $lect_date; ?>','<?php echo $lesson->layoutid; ?>')"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>Lecture Start From </a><a style='color:red'>".$lect_date." </a> </center>";?></a> 
          <?php } }
          }
          else{  if($lesson->layoutid == '12')  {   ?>
            <a onClick="slidemessage('<?php echo $lesson->release_date; ?>','<?php echo $lesson->layoutid; ?>')"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>quiz Start On </a><a style='color:red'>".$lesson->release_date." </a> </center>";?></a> 
            <?php } else { ?>
            <a onClick="slidemessage('<?php echo $lesson->release_date; ?>','<?php echo $lesson->layoutid; ?>')"  class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name."<br><center><a style='color:green'>Lecture Start From </a><a style='color:red'>".$lesson->release_date." </a> </center>";?></a> 
        <?php } } ?>
              </div>
                 <?php
                }
              ?>

            </div>
            <?php 
        $hover_id++;
      }
      $lessonSrNo++;

        if(!$lesson_viewed)
      {
            $display = "none";
      }
        else
      {
            $display = "inherit";
        }
        if($lesson->difficultylevel == 'easy')
      {
            $image_name = 'level_icon.png';
      }
        if($lesson->difficultylevel == 'medium')
      {
            $image_name = 'level_intmed_icon.png';
      }
        if($lesson->difficultylevel == 'hard')
      {
        $image_name = 'level_advance_icon.png';
        }
        @$diff_start--;
        ?>
            </div>              
            </li>
            <?php
          }
            else if($lesson->is_demo == '1')
      { ?>

        <div class="less_lect_list">                
            <div class="lll_title">
             <a href="<?php echo base_url()."lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo "Demo ". ++$j ;?> :
              </a>
            </div>
            
            <div class="lllt_txt">
              <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php //echo "fancybox fancybox.iframe";?>' >
              <?php echo substr($lesson->name,0,25); ?></a><br>
              <!--<div id="sidebar" style="float:right;"> <a href="#" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start lecture</a> </div>--> 
            </div>             
                </div>
  <?php }

        } // end of foreach lessions 

      ?>



        </ul>
        </div>
  </div>    
    <?php
}//end of foreach days
?>
<div id="ExamSection" style="display: none;">
  <div id="Quesmarkopt"></div>
  <!-- <a id="Quit" href="<?php echo base_url(); ?><?php echo $urlCourse;?>/lectures/<?php echo $pro_id; ?>" >Exit</a> -->
</div>
<?php
}//end of if mine

//for final exam link o dated 19-05-2015
$getPro = $this->lessons_model->getProgramFinalExam($program_id);
if(isset($getPro->id_final_exam) && ($getPro->id_final_exam > 0)) //&& ($getPro->webcam_option == 1)
{
  ?>
  <div id="coursesection">
  <!--<div class="title" onclick="nextslide(244,85,246,11)">Final Exam</div>-->
  <div class="title"><strong><a href="<?php echo base_url().'lessons/finalexamnew/'.$program_id.'/'.$getPro->id_final_exam.'/'.'';?>">Final Quiz</a></strong></div>
  </div>
        <div id='webcamera'>
                  <div class="camera">
                <video id="video">Video stream not available.</video>
                <button id="startbutton" hidden>Take photo</button> 
            </div>
            <canvas id="canvas" hidden></canvas>
            <div class="output" hidden>
              <img id="photo" alt="The screen capture will appear in this box."> 
            </div>
        </div>
  <?php
}
$this->session->set_userdata("myLessonArray",$myLessonArray);
?>

<!-- <li id="22222"> -->
    
 <!-- </li> -->

    </div>
      <div id="extras" class="ud-extras" data-isinstructor="" data-instructorpreviewmode="">
       <!--  <section class="desc">
          <h3>Downloadable Files</h3>        
        </section>
      <?php
  //echo $this->Program_model->checkEnrolled($user_id,$pro_id);
      $program = $this->Program_model->getProgram($pro_id);
      //print_r($program);
      $exercise = $program->programmedias;
  if(($this->Program_model->checkEnrolled($user_id,$program_id)) && !empty($exercise))  
  {
    ?>
    
    <div class="rightsidebar" style="">
        <?php 
         $get_media_ids2 = explode(',',$program->programmedias);

    foreach($get_media_ids2 as $get_media_id)
    { 
      $exfileinfo = $this->Program_model->getExercise($get_media_id);   
      if($exfileinfo->type=='file')
      {
        $pathurl = 'files';
      } 
      if($exfileinfo->type=='image')
      {
        $pathurl = 'images';
      }       
      if($exfileinfo->type=='video')
      {
        $pathurl = 'videos';
      } 
      if($exfileinfo->type=='docs')
      {
        $pathurl = 'documents';
      }
      
     
      // echo '<a target="_blank" style="color:#0C0C0C; text-align:left; padding-bottom:10px; display: block;" href="'.base_url()."public/uploads/$pathurl/".$exfileinfo->media_title.'"> <i class="entypo entypo-play"></i>'.ucfirst($exfileinfo->alt_title).' <span style="font-size:12px; color: #353639;">('.$pathurl.')</span>'.'<i class="entypo entypo-download" style="color:#696969;"></i></a>';
    }
    ?>
      </div>
   
      <?php 
  }
  else
  {
    //print_r($exercise);
  ?>
       <p>There are no available downloads for this course.</p>

  
  <?php
  }
 ?>

     <hr/> -->
     <section class="desc">
          <h3>Lecture Files</h3>        
        </section>

        <?php
        $lessons = $this->program_model->getLectExercise($program_id);
          $exercise_count = 0;
        foreach ($lessons as $lesson_data) {
          
          $exercise = $lesson_data->lecturemedias;
    // echo $exercise;
        if(($this->Program_model->checkEnrolled($user_id,$program_id)) && !empty($exercise))  
        {   $exercise_count++;
          ?>
          
          <div class="rightsidebar" style="">
              <?php 
               $get_media_ids2 = explode(',',$exercise);
               if($get_media_ids2 )
               {
                echo "<a><h4>".$lesson_data->name."</h4></a>";
               }
          foreach($get_media_ids2 as $get_media_id)
          { 
            $exfileinfo = $this->Program_model->getExercise($get_media_id);   
            if($exfileinfo->type=='file')
            {
              $pathurl = 'files';
            } 
            if($exfileinfo->type=='image')
            {
              $pathurl = 'images';
            }       
            if($exfileinfo->type=='video')
            {
              $pathurl = 'videos';
            } 
            if($exfileinfo->type=='docs')
            {
              $pathurl = 'documents';
            }
            
            //echo '<a target="_blank" style="text-align:center;" class="btn btn-white" href="'.base_url().'public/uploads/files/'.$exfileinfo->local.'"><i class="entypo-attach" style="margin-right:15px;"></i>|'.$exfileinfo->name.'</a><br />';echo '<a target="_blank" style="text-align:center;" class="btn btn-white" href="'.base_url().'public/uploads/files/'.$exfileinfo->local.'"><i class="entypo-attach" style="margin-right:15px;"></i>|'.$exfileinfo->name.'</a><br />';
            echo '<a target="_blank" style="color:#0C0C0C; text-align:left; padding-bottom:10px; display: block;" href="'.base_url()."public/uploads/$pathurl/".$exfileinfo->media_title.'"> <i class="entypo entypo-play"></i>'.ucfirst($exfileinfo->alt_title).' <span style="font-size:12px; color: #353639;">('.$pathurl.')</span>'.'<i class="entypo entypo-download" style="color:#696969;"></i></a>';
          }
          ?>
            </div>
         
            <?php 
        }
        // else
        // {
        //   //print_r($exercise);
        // ?>
<!--         //      <p>There are no available downloads.</p>
 -->
        
       <?php
        // }
      }
      if($exercise_count == 0)
      {
        echo "<p>No lecture file available for download.</p>";
      }
       ?>



     <hr/>

       <!--  <section class="desc">
          <h3>Webinar</h3>        
        </section>

 <?php  
  if(($programdetail[0]['webstatus']=="active") && !empty($webinars))
  {
  if($this->Program_model->checkEnrolled($user_id,$program_id))
    {
    ?>
    
    <div class="rightsidebar-1">
        <?php   
    foreach($webinars as $webinar)
    {
      ?>
      <?php $attributes = array('class' => 'tform', 'id' => 'webinarpost'.$webinar->proid, 'name' => 'webinarpost'.$webinar->proid);
      echo form_open('conwebinar/',$attributes); ?>
      <input type="hidden" value="<?php echo $userfname; ?>" name="ufname">
      <input type="hidden" value="<?php echo $usermail; ?>" name="uemail">
      <input type="hidden" value="<?php echo $webinar->proid; ?>" name="progid">
      <input type="hidden" value="<?php echo $webinar->id; ?>" name="webinarid">
      <div style="display:inline-block; width:100%; padding:0;">
          <a onClick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>,<?php echo $lesson->layoutid; ?>,<?php if($lesson->layoutid == '22'){ echo $lesson->is_webinar; } else if($lesson->layoutid == '2'){ echo $lesson->is_assignment; } ?>)" style="float:left"><?php echo "<br><i class='entypo entypo-play'>".$webinar->title."</i>";?></a>
     <?php echo form_close();?> </div>
      <?php 
    }
    ?>
    </div>
    <?php
    }
    }
    else
    {
   ?>
    <p>There is no webinar for this course.</p>
   <?php
    }
    ?> -->
     
      </div>
      <div id="lecture-discussions" class="activity-container activities-container" >
        <form class="single-line-form" method="post" action="" name="create-question-form" id="create-question-form">
          <input type="hidden" value="1" name="isSubmitted">
          <span class="holder" id="show-desc"></span>
          <div class="form-item-title">
            <textarea placeholder="Start a new discussion" maxlength="240" name="query_title" data-page-name="enable-default-text" class="ud-form ud-question-input  ui-autocomplete-input" id="query_title" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
          </div>

          
          <div class="form-item-details w3c-default" style="display:none;">
            <textarea placeholder="Type Description" name="query_text" data-page-name="enable-default-text" class="ud-form ud-question-input  ui-autocomplete-input" id="query_text" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
            <input type="button" id="querysubmit" onclick ="insertDiscussion();"; class="btn btn-sm btn-success btn-update"  name="querysubmit" value="ASK">
            <?php
            /*
            $this->ckeditor->config['toolbar'] = array(
            array( '-', '-', 'Bold', 'Italic', 'Underline', '-','-','-','-','-','-','-','-','-','-','NumberedList','BulletedList' ));
            $this->ckeditor->config['language'] = 'en';
            //$this->ckeditor->config['width'] = '350px';
            $this->ckeditor->config['height'] = '100px';
            $this->ckeditor->editor("query_text",'');<?php   */?>
          </div>
          <div id="querysubmit_wrapper" class="buttons_div"  style="display:none;"> <a href="" target="_blank" class="btn-link float-right" data-uv-show="instant_answers"></a>
            <input type="hidden" id="lquiryid" name="lquiryid" value="<?php echo @$qid;?>" >
            <input type="hidden" id="lqprogid" name="lqprogid" value="<?php echo @$pro_id;?>" >
            <input type="hidden" id="lqmodid" name="lqmodid" value="<?php echo @$moduleid;?>" >
            <input type="hidden" id="lqlessid" name="lqlessid" value="<?php echo @$lessonid;?>" >

            <!--<input type="button" id="querysubmit"  name="querysubmit" value="Ask">--> 
            <!--<a href="#" class="query_cancel">Cancel</a>   --> 
          </div>
        </form>
        <ul class="comments-list1" id = "queAns">
          <?php
      $CI = & get_instance();
      $CI->load->model('program_model');
      //$pid1 = $this->uri->segment(3);
      //$module_id1 = $this->uri->segment(4);
      //$lesson_id1 = $this->uri->segment(5);
       //$quizcomment2 = $this->program_model->getlessionDiscussion_model($pid1,$module_id1,$lesson_id1);
      if(!empty($quizcomment))
      {
      foreach ($quizcomment as $quizComment)
      {        
        $userData = $this->program_model->getStudentsInfo($quizComment['user_id']);
        if(!empty($userData))
        {
          $my_image = $userData->images;
          if(!empty($my_image))
          {    
            $filepath = "";
            $files = $_SERVER['DOCUMENT_ROOT']."/public/uploads/users/img/".$my_image;
            if (file_exists($files)) {
              $my_image = "public/uploads/users/img/".$my_image;
            }
            else{
              $my_image = "public/uploads/users/img/thumbs/".$my_image;
            }
          }
          else{
            $my_image = "public/uploads/users/img/default.jpg";
          }

             $lessonName = NULL;
          if($quizComment['lesson_id'])
          {
            $lessonName = $this->program_model->getLessonName_new($quizComment['lesson_id']);
      
            //print_r($lessonName);
          }
        ?>
            <li>
            <div class="comment">
            <div class="comment-thumb"><a href="#">
         <img src="<?php echo base_url().$my_image;?>" alt="" class="img-circle" width="44">
      </a></div>
            <div class="comment-content">
              <div class="comment-author" style="font-size: 13px; margin-bottom:10px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> posted a discussion <b><?php echo ucfirst($lessonName);?></b>
                <div class="comment-info">- Commented On <?php  $timeago=get_timeago(strtotime($quizComment['dateandtime']));echo $timeago;?></div>
              </div>
              <div class="comment-head"><?php echo $quizComment['query_title']?></div>
              <div class="comment-text"><?php echo $quizComment['query_text']?></div>
              <a href="javascript:void(0);" class="liked" id="like<?php echo $quizComment['query_id']; ?>"  style="  margin: 10px 30px 0 0;"> <i class="entypo-heart"></i>
              <?php                   
          $total_likes = $this->Category_model->getAllLike($quizComment['query_id']);
          $likes = $this->Category_model->getLikes($quizComment['query_id'],$user_id);
          $liked = NULL;
          foreach($likes as $like)
          {
            if($user_id == $like->user_id && $quizComment['query_id'] == $like->query_id)
            {
               $liked = 'yes';
               $like_id = $like->like_id;
            }
          }
          if($liked)
          {
            ?>
                <span onClick="unlike(<?php echo $like_id; ?>,<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['user_id']; ?>,<?php echo $quizComment['pro_id']; ?>)">Liked(<?php echo $total_likes; ?>) </span>
                <?php
                }
                else
                {
                  ?>
                <span onClick="like(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['user_id']; ?>,<?php echo $quizComment['pro_id']; ?>)">Like(<?php echo $total_likes; ?>) </span>
                <?php
                }
                $countcomment = $this->program_model->getLessonAnswer2($quizComment['query_id']);
                echo "</a>";
              foreach($countcomment as $countcom )
                  {
                  $ii = $countcom;

              ?>
                 <a href="javascript:void(0);" id="comment<?php echo $quizComment['query_id']; ?>" onClick="show_div(<?php echo $quizComment['query_id']; ?>)" > <i class="entypo-comment"></i>Comment <span id="comment_count<?php echo $quizComment['query_id']; ?>">(<span id="countComment<?php echo $quizComment['query_id']; ?>"><?php echo $ii; ?></span>)</span> </a>
                <?php } ?>
          <div id="comment_div<?php echo $quizComment['query_id']; ?>" style="display:none">
                <ul id="question_list<?php echo $quizComment['query_id']; ?>">
                  <?php
            $lessonAns = $this->program_model->getLessonAnswer($quizComment['query_id']);           
            foreach($lessonAns as $answer)
            {
              $userData = $this->program_model->getStudentsInfo($answer['user_id']);
              ?>
                  <li id="li<?php echo $answer['ans_id'];?>">
                    <div class="comment">
                      <div class="comment-thumb"><a href="#"></a></div>
                      <div class="comment-content">
                        <div class="comment-author" style="font-size: 13px; margin-bottom:10px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> - Commented On <?php  $timeago=get_timeago(strtotime($answer['dateandtime']));echo $timeago;?></div>
                        <!--<div class="comment-head"><?php echo $quizComment['query_title']?></div>-->
                        <div class="comment-text"><?php echo $answer['answer']?></div>
                      </div>
                    </div>
                  </li>
                  <?php
                  }                
                  ?>
                </ul>
                <ul>
                  <li>
                    <div>
                      <textarea name="comment_box<?php echo $quizComment['query_id']; ?>" placeholder="Write Reply" id="comment_box<?php echo $quizComment['query_id']; ?>" style="margin:5px 0;"></textarea>
                      <input class="btn btn-success" type="button" onClick="add_comment(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['pro_id']; ?>)" name="replyBtn<?php echo $quizComment['query_id']; ?>" id="replyBtn<?php echo $quizComment['query_id']; ?>" value="Reply"  />
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            </li>
            <?php
        unset($liked);
        }
      }
    }
    ?>
        </ul>
      </div>
    
<style>
#notes-mask 
{
top: 100px;
overflow-y: auto;
bottom: 30px;
position: absolute;
width: 100%;
}

#notes-mask ul 
{
background: url(<?php echo base_url(); ?>public/images/notes-bg.png);
background-color:#fff;
min-height: 100%;
}
#my_form{
	display: none;
}
.lnr-file-add{
	font-weight: bold !important;
}
.no_notes{
	margin-top: 30px;
	text-align: center;
	display: none;
}
</style>

    <div id="notes" class="ud-notetaking" data-courseid="409734">
      <button class="btn btn-primary pull-right" id="newnotebtn">Create new Note &nbsp;<i class="lnr lnr-file-add"> </i></button>
      <form action="#" id="my_form" method="post" name="my_form">
        
        <textarea id="txt_notes"  placeholder="Write here to take notes..." style="height: 90px;"></textarea>

        <input type="button" class="btn btn-info" value="Add Notes" onClick="addnotes();" style="position: absolute; top: 94px; z-index: 5; margin-left: 5px;" >
      </form>
      <script type="text/javascript">
      	$('#newnotebtn').click(function(){
      		$("#my_form").toggle();
		});
      </script>
      <div class="no_notes">
      	<div class="col-md-6 col-md-offset-3">
      		<h2>No notes created yet!</h2>
      		<span>
      			Add notes while watching lectures to save important poits of a course for later. Notes you've saved will show up here.
      		</span>
      	</div>	
      </div>
      <div style="clear:both;">
        <div id="notes-mask">
    
          <ul id="notes-list" >
      <?php
    $data =array( 'pid' => $this->uri->segment(3),
      'module_id' => $this->uri->segment(4),
      'lesson_id' => $this->uri->segment(5),
      'userid' => $sessionarray['id']
       );
     $result = $this->lessons_model->getNotes_model($data);
      {
      if($result)
      {
      $ii = 1;
      foreach($result as $result1)
      {
      ?>
      <!--<li onmouseover ="showdel(<?php echo $result1->nid ?>);" onmouseout ="hidedel(<?php echo $result1->nid ?>);" >-->
      <li>
        <p id="pDiv" ><?php echo"<i class='entypo-feather'></i>"; ?>&nbsp;
        <span id ="span<?php echo $result1->nid ?>" onclick ="showarea(<?php echo $result1->nid ?>);"><?php echo $result1->notes ?></span>
        <textarea id ="area<?php echo $result1->nid?>" onBlur="showspan(<?php echo $result1->nid ?>);" style="width: 290px;margin: 0 0px 5px -5px;height: 100px; display :none" onkeydown ="updateNote(<?php echo $result1->nid ?>);" ><?php echo $result1->notes ?></textarea> 
        &nbsp;
        </p> 
        <div>
        <button class="btn btn-success" type="button"  value="Save" id ="btn<?php echo $result1->nid?>" onclick ="updateNote1(<?php echo $result1->nid ?>);" style="display :none; margin-right: 5px;"><i class="entypo-floppy"></i></button>
        <button class="btn btn-danger delspan" id ="delspan<?php echo $result1->nid ?>" style='display:none' onclick ="delNotes(<?php echo $result1->nid ?>);" ><i class="entypo-trash"></i></button>
        </div>
      </li>
      <?php
      $ii++;
      }
      }
      }
      ?>
      
          </ul>
          
        </div>
      </div>
    </div>
  
  <input id="u_fname" type="hidden" value="<?php echo $sessionarray['first_name']; ?>">
    <input id="u_email" type="hidden" value="<?php echo $sessionarray['email'];?>">
  <input id="proid" type="hidden" value="<?php echo $this->uri->segment(3);?>">
  <input id="modid" type="hidden" value="<?php echo $this->uri->segment(4);?>">
  <input id="lessid" type="hidden" value="<?php echo $this->uri->segment(5);?>">

  <input id="lec_act_id" type="hidden" value="<?php echo @$lec_act_id;?>">

  
  </div>
  <!--Sidebar-code-end --> 
</div>
</body>
</html>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>

   <script async src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.js"></script>

<?php
$proiddd = $this->uri->segment(3);
$this->load->model('Tasks_model');
      $timeWeb = $this->Tasks_model->getTimeForWebCam($proiddd);
      //if($timeWeb[0]['webcam_option'] == 1)
      if($timeWeb[0]['webcam_option'] == 1 && $this->session->userdata('attempt_code'))     
      {     
          if($timeWeb[0]['time_for_webcam'] == '10Sec') {$timeTakenByWeb = '10000';}
          if($timeWeb[0]['time_for_webcam'] == '20Sec') {$timeTakenByWeb = '20000';}  
        if($timeWeb[0]['time_for_webcam'] == '30Sec') {$timeTakenByWeb = '30000';}
        if($timeWeb[0]['time_for_webcam'] == '1min') {$timeTakenByWeb = '60000';}
        if($timeWeb[0]['time_for_webcam'] == '5min') {$timeTakenByWeb = '300000';}
        if($timeWeb[0]['time_for_webcam'] == '10min') {$timeTakenByWeb = '600000';}
          
        echo "<script>
            var timeweb = $timeTakenByWeb;
            timeweb = parseInt(timeweb);
            var clicktrigger = setInterval( function(){ 
              $(function(){
                $('#startbutton').trigger('click');
              });
            }
            , timeweb );        
          </script>";       
      }   
?>


<script type="text/javascript">
 //  document.onkeydown = function(e) {
 //    if(e.keyCode == 123) {
 //     return false;
 //    }
 //    if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
 //     return false;
 //    }
 //    if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
 //     return false;
 //    }
 //    if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
 //     return false;
 //    }

 //    if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
 //     return false;
 //    }      
 // }
 
  //   $("body").on("contextmenu",function(e){
  //      return false;
  //   }); 
  //   $(document).bind("contextmenu",function(e) {
  //  e.preventDefault();
  // });

function showdel(ii)
{
  $('#delspan'+ii).html('<i class="entypo-trash"></i>');
}
function hidedel(ii)
{
  $('#delspan'+ii).html('');
}
function delNotes(nid)
{ 
    var pro = $("#proid").val();
      var mod = $("#modid").val();
    var les = $("#lessid").val();
    var x = confirm("Are you sure you want to delete?");
    if (x == true)
    {       
  $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/deleteNotes",
      data: {nid:nid}, 
      success: function(data)
      { 
        //$("#span"+nid).css('display','block');
        //$("#area"+nid).css('display','none');
        getLessionNotes(pro,mod,les);
      }
      });
    }
    else
    {
    return false;
    }
}
</script>
<script>
function show_div(id) 
{
    $('#comment_div'+id).toggle();
  //$('#comment_box'+id).redactor();  
}
</script>
<script>
  //$(function(){
    //$("#search").click(function(){
  function like(query_id,questioner_id,pro_id)
  {    
        var  query_id = query_id;
        var  questioner_id = questioner_id;
        var  pro_id = pro_id;
      $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>programs/like",
            data    : {'query_id':query_id,'questioner_id':questioner_id,'pro_id':pro_id}, 
            success: function(data){
            $("#like"+query_id).html(data); 
            } 
            }); 
        // return false;  //stop the actual form post !important! 
  }//);
  //});
</script>
<script type="text/javascript">
  function unlike(like_id,query_id,questioner_id,pro_id)
  {    
        var  like_id = like_id;
        var  query_id = query_id;
        var  questioner_id = questioner_id;
        var  pro_id = pro_id;
      $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>programs/unlike",
            data    : {'like_id':like_id,'query_id':query_id,'questioner_id':questioner_id,'pro_id':pro_id},
 
      success: function(data){             
        $("#like"+query_id).html(data); 
      }
      });
         // return false;  //stop the actual form post !important!
    }//);
  // });
</script>
<script>
  function add_comment(query_id,pid)
  {
        var answer = $('#comment_box'+query_id).val();
      var listresult = '';
    var querylist = '';
      $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>programs/saveanswer",
            data    : {'query_id':query_id,'pid':pid,'answer':answer},
 
      success: function(data){
           
      if(data=='error')
      {
        alert('Teir was error while processing, try again!');
      }
      else
      {         
        if(querylist == '')
        {
          querylist = 'No questions have been asked so far';
        }
        //$('#question_list'+querydata.query_id).html(querylist);
        $('#question_list'+query_id).html(data);
        countComment(query_id);
      }
        } 
      });
         // return false;  //stop the actual form post !important!
    }//);
  //});
</script>
<script>
  function countComment(qid)
  {
    $.ajax({
      type:"post",
      url:"<?php echo base_url(); ?>programs/countComment",
      data:{'qid':qid},
      success:function(data)
      {
        //alert(data);
        //$("#countComment").html(data);
        $("#countComment"+qid).text(data);
      }

    });
  }

</script>
<script>
  $('#discussion').click(function() {
    $('#lecture-discussions').css('display','block');
    $('#extras').css('display','none');
    $('#sidebar_down #tab-curriculum').css('display','none');
    $('#notes').css('display','none');
  });
</script>
<script>
$('#download1').click(function() 
{
  $('#extras').css('display','block');
  $('#lecture-discussions').css('display','none');
  $('#sidebar_down #tab-curriculum').css('display','none');
  $('#notes').css('display','none');
});
</script>
<script>
$('#list').click(function() {
  $('#sidebar_down #tab-curriculum').css('display','block');
  $('#lecture-discussions').css('display','none');
  $('#notes').css('display','none');
  $('#extras').css('display','none');
});
</script>
<script>
$('#note').click(function() {
  $('#notes').css('display','block');
  $('#lecture-discussions').css('display','none');
  $('#sidebar_down #tab-curriculum').css('display','none');
  $('#extras').css('display','none');
});
</script>
<script>
$(document).ready(function() {
  $('#notes').css('display','none');
  $('#lecture-discussions').css('display','none');
  // $('#tab-curriculum').css('display','block');
  var width = jQuery(document).width();
   if ( width < 767) {
     jQuery('#sidebar_down #tab-curriculum').css('display','block');
      jQuery('#extras').css('display','none');
       jQuery('#download1').removeClass("active");
      
   }else{
      jQuery('#extras').css('display','block');
   }

  $(".sidebar-container .tab-label-container .gray-nav li").click(function(){
  $(this).addClass('active').siblings().removeClass('active');
  });
});
 $(window).scroll(function() {
  var width = jQuery(document).width();
   if ( width > 767) {
    //After scrolling 100px from the top...
    if ( $(window).scrollTop() >= 50 ) {
        $('#course-taking-page.wrapper .sidebar').css('padding-top', '0px');

    //Otherwise remove inline styles and thereby revert to original stying
    } else {
        $('#course-taking-page.wrapper .sidebar').css('padding-top', '50px');
    }
  };
});
 $(".open_sidebar").click(function(){
    jQuery('#responsive-sidebar').css({"right": "-170px", "display":"none"});
    jQuery('.asset-container').css('width','75%');
    jQuery('.sidebar_down').css('width','75%');
});

$(".close_sidebar").click(function(){
  jQuery('.asset-container').css('width','100%');
  jQuery('.sidebar_down').css('width','100%');
  jQuery('#responsive-sidebar').css({"right": "-129px", "display":"block"});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#sidebar_on .closebutton").live('click',function(){
    $('#sidebar-container').addClass("sidebar_off");
    $('#sidebar_on').addClass("sidebaroff");
    //$(".sidebar-container").css('display','none');  
    $('#sidebar_on #clsbutton').removeClass('closebutton');
    $('#sidebar_on #clsbutton').addClass('openbutton');
    });
    $(".sidebaroff .openbutton").live('click',function(){
    $('#sidebar-container').removeClass("sidebar_off");
    $('#sidebar_on').removeClass("sidebaroff");
    //$("#sidebar-container").css('display','block');
    $('#sidebar_on #clsbutton').removeClass('openbutton');
    $('#sidebar_on #clsbutton').addClass('closebutton');  
    });
/* ***********<start back to query slide */
  $("a.backto").live('click',function(){
  $('#questions-wrapper').removeClass('detail-view');
    $("ul#answers-list").html('');
    $("ul#answers-list").val('');
    //window.location.reload();
  });
/* ** back to query slide end>************ */
/* ***********<start askquery editor display */
  $("#query_title").live('focus',function(){
    $(".form-item-details").css('display','block');
    $("#querysubmit_wrapper").css('display','block');
    $(".answer-box").css('display','none');
  });
/* ** askquery editor display end>************ */
/* ***********<start askquery editor display none */
  $(".query_cancel").live('click',function(){
    $(".form-item-details").css('display','none');
    $("#querysubmit_wrapper").css('display','none');
  });

/* ***********<start get Query List code */
    var qpid_val = "<?php echo $pro_id;?>";
    var qmid_val = "<?php echo @$moduleid;?>";
    var qlid_val = "<?php echo @$lessonid;?>";
    var qid_val = "<?php echo @$qid;?>";
    var url = "<?php echo base_url()?>lessons/GetQueryList/"+qpid_val+"/"+qmid_val+"/"+qlid_val+"/"+qid_val;

    $.getJSON( url,function(listresult){
    var querylist = '';
    $.each(listresult, function(queryk, querydata){
    querylist += '<li class="queries_li" data-questionid="'+querydata.id+'">';
        querylist += '<a href="#">';
        querylist += '<span class="title">'+querydata.title+'</span>';
        querylist += '<span class="details">';
        querylist += '<span class="count"><b>'+querydata.num_answers+'</b> Answer(s)</span>';
        querylist += '<span class="count" title="This question is asked in Lecture ">Lecture </span>';
        querylist += '<span class="more">';
    querylist += querydata.created;
        querylist += '<span class="user-title ellipsis">'+querydata.user.title+'</span> <span>asked this <b>'+querydata.created_relative+'</b> ago</span>';
        querylist += '</span>';
        querylist += '</span>';
        querylist += '</a>';
    querylist += '</li>';
      });

      if(querylist == '')
    {
      querylist = 'No questions have been asked so far';
      }
    $("#questions-list").html(querylist);
    });

/* ** Query List code end>************ */


/* ***********<start ans slide and load query header and ans response code */
  //function answerlist(){
    $(".queries_li").live('click',function(){
  var dataquestionid = $(this).attr('data-questionid');
  
    var header="";
    var completequery = "";
    var completeansres = "";
    var url = "<?php echo base_url() ?>lessons/query_responseheader/"+dataquestionid+"/list";

    $.getJSON( url,function(result){
    //$.each(result, function(k, v) {
    //myTable += "<tr><td>"+k+"</td><td>"+v+"</td></tr>";
    //});
    header += '<a href="#back" class="backto back-btn2">Back</a>';
    header += '<h4 class="ellipsis">';
    header += '<b class="ellipsis">'+result.user.title+'</b> <i>asks...</i>';
    header += '</h4>';
    $(".header").html(header);

    completequery += '<div><article>';
    //completequery += '<div><article>';

        completequery += '<h2 data-ondelete="$.ud.ud_questionanswer.prototype.submitRemoveQuestion" data-onupdate="$.ud.ud_questionanswer.prototype.submitQuestionUpdate" data-objectid="'+dataquestionid+'" data-objectname="question" class="ud-inplaceeditor">'+result.title;
    if(result.isRequesterTheOwner == true){
    completequery += '<div class="inplaceeditor-delete none">×</div>';
    }
    completequery += '</h2>';

        completequery += '<div class="w3c-default">'+result.body+'</div>';

        completequery += '</article></div>';


        $("#query-response-container").html(completequery);
    });
    answerlist(dataquestionid);
    $('#responses').attr('data-answerid',dataquestionid);

    var ansurl = "<?php echo base_url() ?>lessons/answer_responses/"+dataquestionid;
    $.getJSON( ansurl,function(ansresult){
    $.each(ansresult.data, function(ansk, ansval){
    completeansres += '<li data-answerid="'+ansval.id+'"  class="vote ">';
    completeansres+= '<div class="vote">';
    completeansres+= '<span title="There are 0 votes">0</span>';
    completeansres+= '</div>';
  
    completeansres += '<div class="top">';
    completeansres += '<span style="background-image: url('+ansval.user.images.img_50x50+')" class="thumb"></span>';
    completeansres += '<a href="<?php echo base_url();  ?>" class="user">'+ansval.user.title+'</a>';
    if(ansval.isRequesterTheOwner == true){
    completeansres += '<a href="javascript:void(0)" class="delete-answer-btn js-delete-answer">';
    completeansres += '<i class="icon-trash"></i>';
    completeansres += '</a>';
    }
    completeansres += '<time><b>replied</b>'+ansval.createdRelative+'</time>';
    completeansres += '</div>';
    //completeansres += '<div class="ans_query_id" id="ans_query_id">'+dataquestionid+'</div>';
    completeansres += '<article class="answer-content">'+ansval.body+'</article>';
    completeansres += '</li>';
  });
  if(completeansres == "")
  {
    completeansres +='<li class="no-answers">No answers have been posted so far</li>';
  }
  $("ul#answers-list").html(completeansres);
  });
  $(".answer-box").css('display','block');
  $('#questions-wrapper').addClass('detail-view');
  });

/* ** askquery code end>************ */



/* ***********<start delete query */
  $(".inplaceeditor-delete").live('click',function(){
  var query_id = $(this).parent().attr("data-objectid");
  var liselectortodelete = 'ul#questions-list li[data-questionid="'+query_id+'"]';
  $(liselectortodelete).remove();
      $(".header").html(" ");
      $("#query-response-container").html(" ");
      //$("#responses").html(" ");
      $('ul#answers-list').remove();
      $('#questions-wrapper').removeClass('detail-view');

  $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>lessons/query_responseheader/"+query_id+"/delete",
    data: { queryid: query_id }
    }).success(function( data ) {
    if(data=='error'){
    alert('Their was error while processing, try again!');
    }else
    {
      if(data == true)
      {
        $('ul#questions-list li[value="Hot Fuzz"]').remove();
        $(".header").html(" ");
        $("#query-response-container").html(" ");
        $("ul#answers-list").html(" ");
        /*$('ul#answers-list').remove();*/
        alert( "Query successfully deleted." );
      }
    }
    });
  });
/* ** back to query slide end>************  */



function answerlist(query_id)
{
    var ansurl = "<?php echo base_url() ?>lessons/GetAnswer/"+query_id;
    $.getJSON( ansurl,function(ansresult){
  $.each(ansresult.data, function(ansk, ansval){
    var litoappend = "";
  litoappend += '<li data-answerid="'+ansval.id+'" id="'+ansval.id+'" class="vote">';
    litoappend += '<div class="vote">';
    litoappend += '<span title="There are 0 votes">0</span>';
    litoappend += '</div>';
  litoappend += '<div class="top">';
  litoappend += '<span style="background-image: url('+ansval.user.images.img_50x50+')" class="thumb"></span>';
  litoappend += '<a href="<?php echo base_url(); ?>" class="user">'+ansval.user.title+'</a>';
  if(ansval.isOwner == true)
  {
    litoappend += '<a href="javascript:void(0)" class="delete-answer-btn js-delete-answer" id="delete-answer-btn_'+ansval.id+'">';
    litoappend += '</a>';
    }

    litoappend += '<time><b>replied</b>'+' '+ansval.createdRelative+'</time>';
    litoappend += '</div>';
  litoappend += '<article class="answer-content">'+ansval.body+'</article>';
  litoappend += '</li>';

  $("ul#answers-list").append(litoappend);
  $('textarea#ans_text').val('');
    document.getElementById("lqid").value = '';
  var qval = $('#lqid').val();
  });
});
}


$(".delete-answer-btn").live('click',function()
{
  var ans_id = $(this).parent().parent().attr("data-answerid");
  var query_id = $('#query-response-container h2.ud-inplaceeditor').attr("data-objectid");
    var answerlistdelete = 'ul#answers-list li[data-answerid="'+ans_id+'"]';
    $(answerlistdelete).remove();
    $('li[data-answerid="'+ans_id+'"]').remove();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>lessons/answer_responses/"+query_id+"/delete/"+ans_id,
            data: { ansid: ans_id }
            }).success(function( data ) {
                if(data=='error')
        {
                    alert('Teir was error while processing, try again!');
                }
        else
        {
                    if(data == true)
          {
                        $('li[data-answerid="'+ans_id+'"]').remove();
                        alert( "Query successfully deleted." );
                    }
                }
            });
});
});
</script>
<script>
  $(document).ready(function() 
  {
    $('#txt_notes').keydown(function() 
    {
      var pro = $("#proid").val();
      var mod = $("#modid").val();
      var les = $("#lessid").val();
      //alert(les);
    var message = $('#txt_notes').val();
    if (event.keyCode == 13)
    {
    if (message == "")
    {
    alert("Enter Some Text In Textarea");
    } 
    else 
    {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/saveNotes",
      data: {pro:pro,mod:mod,les:les,message:message}, 
      success: function(data)
      {
      //$('#notes-list').append("<li><p>"+ message+"</p></li>");
      
      //$('#notes-list').append("<li onmouseover ='showdel($result1->nid)' onmouseout ='hidedel($result1->nid )' ><p> => &nbsp <span id='span$result1->nid' onclick ='showarea($result1->nid);'>"+ message+"</span><textarea id ='area$result1->nid' onblur='showspan($result1->nid );' style='width: 202px; display :none' onkeydown ='updateNote($result1->nid );' >"+ message +"</textarea> &nbsp <span id ='delspan$result1->nid' onclick ='delNotes($result1->nid);' ></span> </p></li>");
      
        getLessionNotes(pro,mod,les);
      }
      });   
    
    }
    $("#txt_notes").val('');
    return false;
    }
    });
  });
  
</script>
<script>
  function addnotes()
  {
    var pro = $("#proid").val();
    var mod = $("#modid").val();
    var les = $("#lessid").val();
    
    var message = $('#txt_notes').val();
    
    if (message == "")
    {
      alert("Enter Some Text In Textarea");
    } 
    else 
    {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/saveNotes",
      data: {pro:pro,mod:mod,les:les,message:message}, 
      success: function(data)
      {
      //alert(data);
      //$('#notes-list').append("<li><p>"+ message+"</p></li>");
      
      //$('#notes-list').append("<li onmouseover ='showdel($result1->nid)' onmouseout ='hidedel($result1->nid )' ><p> => &nbsp <span id='span$result1->nid' onclick ='showarea($result1->nid);'>"+ message+"</span><textarea id ='area$result1->nid' onblur='showspan($result1->nid );' style='width: 202px; display :none' onkeydown ='updateNote($result1->nid );' >"+ message +"</textarea> &nbsp <span id ='delspan$result1->nid' onclick ='delNotes($result1->nid);' ></span> </p></li>");
      
        getLessionNotes(pro,mod,les);
      }
      });   
    
    }
    $("#txt_notes").val('');
    //return false;   
  }
</script>
<script>
function getLessionNotes(pro_id,mod_id,lesson_id)
{
//alert("yes");
$.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/getNotes",
      data: {pro_id:pro_id,mod_id:mod_id,lesson_id:lesson_id}, 
      success: function(data)
      {
      //alert(data);      
      $('#notes-list').html(data);
        if(data == '')
        	$(".no_notes").css('display','block');
        else
        	$(".no_notes").css('display','none');
      }
      });
}
</script>
<script>
function showarea(ii)
{
$("#span"+ii).toggle();
$("#area"+ii).toggle();
$("#area"+ii).focus();
$('#delspan'+ii).toggle();
$("#btn"+ii).toggle();
}

function showspan(ii)
{
// $("#span"+ii).toggle();
// $("#area"+ii).toggle();
// $('#delspan'+ii).html('x');
}
</script>
<script>
function updateNote(nid)
{
      var pro = $("#proid").val();
      var mod = $("#modid").val();
      var les = $("#lessid").val();
      //alert(les);
    var message = $("#area"+nid).val();
    if (event.keyCode == 13)
    {
    if (message == "")
    {
    alert("Enter Some Text In Textarea");
    } 
    else 
    {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/upadteNotes",
      data: {pro:pro,mod:mod,les:les,message:message,nid:nid}, 
      success: function(data)
      {
      //alert(data);
      //$('#notes-list').append("<li><p>"+ message+"</p></li>");
      $("#span"+nid).css('display','block');
      $("#area"+nid).css('display','none');
        getLessionNotes(pro,mod,les);
      }
      });   
    
    }   
    return false;
    }
  }
</script>

<script>
function updateNote1(nid)
{
      var pro = $("#proid").val();
      var mod = $("#modid").val();
      var les = $("#lessid").val();
      
    var message = $("#area"+nid).val();
    
    if (message == "")
    {
    alert("Enter Some Text In Textarea");
    } 
    else 
    {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/upadteNotes",
      data: {pro:pro,mod:mod,les:les,message:message,nid:nid}, 
      success: function(data)
      {
      //alert(data);
      //$('#notes-list').append("<li><p>"+ message+"</p></li>");
      $("#span"+nid).css('display','block');
      $("#area"+nid).css('display','none');
      $("#btn"+nid).css('display','none');
        getLessionNotes(pro,mod,les);
      }
      });   
    
    }   
    return false;
    
  }
</script>

<script>

  function start_assign()
  {   
    $('#test_status').val('assignment');
    $('#ass_desc').css('display','none');
    $('#btn-end').css('display','none');
    $('#ass_desc').css('display','none');
    $('#next1').css('display','block');
    $('#pre2').css('display','none');
    $('#btn-start').css('display','none');
    $('#start_ass').css('display','none');
    $('#wrapper').css('display','block');
    $('#style-1').css('display','inline-block');
  }
  
  function end_assign()
  { 
    $('#next1').css('display','none');
      $('#pre1').css('display','none');
      $('#pre2').css('display','none');
      $('#next2').css('display','none');
  }

function show_next(id,nextid,bar)
{  
  if(bar == 'bar1')
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','block');
       $('#next2').css('display','block');
     //var visible =  $('.asset-container').find('#submission').find('.Ansview').is(':visible');
     var isVisible = $('.asset-container').find('#submission').find('.textview').find('div').is('.mce-tinymce');
  if (isVisible==false) {
        tinymce.init({
        selector : ".Ansview",
      plugins: [
      "eqneditor advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen",
      "insertdatetime media table contextmenu paste" ],
      toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
        image_title: true,
        automatic_uploads: true,
        images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
        file_picker_types: 'image',
         image_advtab: true, 
        file_picker_callback: function(callback, value, meta) {
              if (meta.filetype == 'image') {
                $('#upload').trigger('click');
                $('#upload').on('change', function() {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    callback(e.target.result, {
                      alt: ''
                    });
                  };
                  reader.readAsDataURL(file);
                });
              }
            },

    });
        // $('.Ansview').redactor({
         //        focus: true,
         //        imageUpload: window.location.origin+'/tasks/getImage', 
         //        fileUpload: window.location.origin+'/admin/widgets/getImage',                
          //  });
        };

  }

  else
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','none');
       $('#next2').css('display','none');
        $('#pre2').css('display','block');
  }
  $('.modal-backdrop.fade.in').remove();
  var ele=document.getElementById(id).getElementsByTagName("input");
  var error=0;
 // alert(ele.length);
  for(var i=0;i<ele.length;i++)
  {
    if(ele[i].type=="text" && ele[i].value=="")
    {
      error++;
    }
  }
  
  // if(error==0)
  // {
    document.getElementById("instruct").style.display="none";
    document.getElementById("submission").style.display="none";
    document.getElementById("instructor_ex").style.display="none";
    $("#"+nextid).fadeIn();
    document.getElementById(bar).style.backgroundColor="#2f96b4";
  // }
  // else
  // { 
  //    $('#pre1').css('display','block');
   // $('#pre2').css('display','none');
  //  $('#next2').css('display','block');
  //   alert("Fill All The details");
  // }
  $('html, body').animate({scrollTop : 0},800);
    return false;
}

function show_prev(previd,bar)
{

  if(bar == 'bar1')
  {
     $('#next1').css('display','block');
      $('#pre1').css('display','none');
       $('#next2').css('display','none');
  }
  else
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','block');
       $('#next2').css('display','block');
        $('#pre2').css('display','none');
  }
  $('.modal-backdrop.fade.in').remove();
  document.getElementById("instruct").style.display="none";
  document.getElementById("submission").style.display="none";
  document.getElementById("instructor_ex").style.display="none";
  $("#"+previd).fadeIn();
  document.getElementById(bar).style.backgroundColor="#D8D8D8";
}

function submit_confirm()
    {
      $('#btn-end').css('display','block');
      var strcontent1 ='<center><h4 style="padding:5%;">You will not able to edit after you submit.</h4></center>';
      
      $j.confirm({
         title: "Are you sure?",
      content: strcontent1,
        confirmButton: 'submit',
     confirm: function()
                 {  
                  var count =0;
      
              $("#submission").find('.Qset').each(function(){
                count++;
              });
             for (var i = 1; i <= count; i++) {
              var textvalue =tinymce.get('ansview_'+i).getContent();
              //$('#Qans_'+i).text(textvalue);
              $('#Qans_'+i).html($(textvalue).text());
              $('#ansview_'+i).val($(textvalue).text());
             };
               
                  $.ajax({
                //var post_vars = $('#proform').serializeArray();
               //+sid+"/"+pid
                type: "POST",
                url: " <?php echo base_url()?>programs/studentassign_submit/",
                // data: post_vars, 
                // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
                   data: $("#proform").serialize(),
               //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
                success: function(msg)
                { 
                  console.log(msg);
                  $('#status_ass').show();
                  $('.uploadbutton').hide();
                  $('.btn_remove').hide();
                  $('.Qans').show();
                  $('.textview').hide();
                  $('.subconfirm').hide(); 

      $('#instructor_ex').find('#alertsubmit').css('display','none');
      var count =0;
      
      $("#instruct").find('.Qcon').each(function(){
        count++;
      });
    
        var str2 = "<div class='InstructorView' id='instrutorsubmitview' ><h4 class='instrt_ex_head'>Instructor Examples</h4><br><h3 class='nameblock'><span class='nameicon'><?php echo implode('', array_map(function($v) { return $v[0]; }, explode(' ', $instuctor)));?></span><?php  echo $instuctor;?></h3><br>";
        var str = "<div class='InstructorView' id='yoursubmitview' ><h3 class='your_sub'>Your Submission22</h3><h3 class='nameblock'><span class='nameicon'><?php echo implode('', array_map(function($v) { return $v[0]; }, explode(' ', $uname)));?></span><?php echo $uname;?></h3><br>";

        var obj = JSON.parse(msg); 
        console.log(obj);
        $.each( obj, function(key, value ) {
        if(key == 'instuctor')
        { 
          var i = 1;
          $.each( value, function(key1, value1 ) 
          {
            str2 += "<div class='instruct_ex'><p>"+i+". "+value1.que_text+"<br></p> </div>";
            if(value1.que_attachment)
            {
               var filename = value1.que_attachment;
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str2 += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str2 += "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br></div>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str2 += "<div class='requirements__title'>/div><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                          var ext = filename.split('.');
                      if(ext[1]){
                              str2 += "<br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a></div>";
                          }
                        }
                      }
            }

            if(value1.ans_text)
            {
              str2 += "<div><b>Answer : </b><br>"+value1.ans_text+"</div><br>";
            }
            if(value1.ans_attachment)
            {
               var filename = value1.ans_attachment;
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str2 += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str2 += "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br></div>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str2 += "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                        var ext = filename.split('.');
                      if(ext[1]){
                              str2 += "<br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a></div>";
                          }
                        }
                      }
            }

            //str += "<li class='Qcon' id='Qcon_"+i+"'>"+i+") "+value1.que_text+"</li>";
            // alert(  value1.assign_id );
            i++;
          });

        }
      

      
        });

      for (var i = 1; i <= count; i++) 
       {
     
          var Qtext = $('#Qset_'+i).text();
            str += "<b>"+Qtext+"<br></b> ";
             var content = $('#Qans_'+i).text();
            if(content)
            {               
              str += "<div class='subcontent' ><b>Answer </b><br>"+content+"</div><br>";

              var attvisible = $('#submission').find('#stufile_'+i).is(':visible');
                  if(attvisible == true)
                  {
                    var filename = $('#submission').find('#stufile_'+i).find('img').attr('id');
            //var arr = filename.split('.').pop();
            // alert(arr);
            // console.log(filename);
                   var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                   var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                   // console.log()
                     str += "<div id='srcview_"+i+"'>";
                    
                     if ($.inArray(arr, fileExtension) >= '1')
                    {
                        str += "<br><center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br></div>";    //     
                    //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                    }
                    
                    else{
                      var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                    if($.inArray(arr, videoExtension) >= '1')
                    {  
                        str += "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a></center><br>";
                    }
                    else{
                      var ext = filename.split('.');
                if(ext[1]){
                        str += "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a></div>";
                      }
                      }
                    }
                   }
            }
      };


          $("#instructor_ex").append(str2);

      $("#instructor_ex").append(str);
                  // alert(msg);
                  // console.log(msg);
                }

              });

                 },
     cancel: function()
            {
              return true;
            }
             });
    }

function submit_ans()
{
  $.ajax({
          //var post_vars = $('#proform').serializeArray();
         
          type: "POST",
          url: " <?php echo base_url()?>programs/StudentAssign_submit/"+sid+"/"+pid,
          // data: post_vars, 
          // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
             data: $("#proform").serialize(),
         //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
          success: function(msg)
          { 

          }
          });
}


</script>

<script>
function filedownload(link)
 {
//   var name = $(fname).attr('id');
  // alert(link.href);
  // alert(link.id);
  location.href = link.href;
  // $.ajax({
  //    type: "POST",
  //    url: "<?php echo base_url()?>lessons/filedownload/"+name,
  //    //data: { 'fname' : name},
  //    //beforeSend : function( data ) { $(".asset-container").html('<div id="overlay"><img src="<?php echo base_url("public/images/loading.gif"); ?>" /></div>');}
  //    }).success(function(data) 
  //    {

  //    alert(data);
  //    console.log(data);
  //  });

}

function webinar_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id)
    {
      $("#proid").val(pro_id);
      $("#webid").val(web_id);
      $("#modid").val(mod_id);
      $("#lessid").val(lesson_id);
      var ufname = $("#u_fname").val();
          
      $.ajax({
      type: "POST",
      url: "<?php echo base_url()?>conwebinar/ajaxwebinar/",
      data: { 'progid':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id, 'webinarid':web_id, 'ufname': ufname},
      beforeSend : function( data ) {
         $("#overlay").show();
       $(".asset-container").html('');}
      }).success(function(data) 
      {   
        // alert(data);
        // console.log(data);

        // var obj = JSON.parse(data);  
        // console.log(obj.wiziq_presenter_url);  
        if(data=='error')
        {
          alert('There was error while processing, try again!');
        }
        else
        {   
          var str = '<div class="iframe_div">';
          
        
        // str += '<iframe src="'+obj.wiziq_presenter_url+'" style="width:100%;height:700px" ></iframe>';

         // if($perfect_url)
         // {
          // str += '<iframe src="<?php echo $perfect_url; ?>" style="width:100%;height:700px" ></iframe>';
         // }

          str += '</div>';

            //var dt = '<div class="show-progress"><div class="progress-top" style="position: relative; height: 100%;"> <span class="percent completion-ratio">0%</span><div class="note"> <span>You have completed <b class="completion-ratio">0%</b> of this course</span> </div></div><div class="feedback-form" style="height: 0%;"> </div></div><';
          //$(".asset-container").html(dt);         
          my_nexturllist(pro_id,mod_id,lesson_id, srno);        
                  my_previousurllist(pro_id,mod_id,lesson_id, srno);  
                  getMarkCompleted(pro_id,mod_id,lesson_id);  
          //$(".ud-lectureangular").html(data); asset-container
          var iauto =1;
          if(iauto==1)
          {
             $("#overlay").hide();
          $(".asset-container").html(data);
          iauto++;
            }

          highlight(srno);
          lecctureTitle(pro_id,mod_id,lesson_id); 
///////////////
          // var slider =
           $(document).find('.bxslider1').bxSlider();
          //alert('yes');
       //slider.reloadSlider(); 
       ////////////   
       $(document).find('.bx-prev, .bx-next, .bx-pager-link, .bx-start, .bx-stop').removeAttr("href");

        }
      }); 
      
      getLessionNotes(pro_id,mod_id,lesson_id);
      getlessionDiscussion(pro_id,mod_id,lesson_id);
      setViewLesson(pro_id,mod_id,lesson_id); 
      backgroundColor();
    }

    function assignment_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id)
    {      
      $("#proid").val(pro_id);
      $("#modid").val(mod_id);
      $("#lessid").val(lesson_id);
      $("#assid").val(web_id);
          //alert(web_id);
          
      $.ajax({
      type: "POST",
      url: "<?php echo base_url()?>lessons/ajaxAssignment/",
      data: { 'progid':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id, 'assign_id':web_id},
      beforeSend : function( data ) { 
         $("#overlay").show();
         $(".asset-container").html('');}
      }).success(function(data) 
      { 

         //console.log(data);
        var obj = JSON.parse(data); 
        // alert(obj.status);
        // alert(obj.date);
         var str = "<input type='hidden' id='testfile' name='testfile' value=''>";
        if(obj.status)
        {
          //alert('yes');
           str += "<br><br><div class='panel panel-primary' style='height:auto' data-collapsed='0'>";
            str += "<div class='panel-heading'><div class='panel-title' style='padding-bottom: 0px;'>";
          str += "<p style='margin-top: 0; text-align:left;'></p><center><h2 class='assgn_head' style='color:#fff;text-align:center'>Assignment : "+obj.info.assign_title+"</h2></center>";
          if(obj.date){
            // <input name='assign_idd' value='"+web_id+"'  style='display:none'>
          str += " <p style='margin-bottom: 0px;color:#fff!important; text-align:center;'>Assignment Submitted On: <span style='color:#fff'>"+obj.date+"</span></p>";
          }
          str += "</div></div>";
          str += "<div class='panel-body form-horizontal form-groups-bordered'>";
          str += "<div class='submitted'><h3>How did you do?</h3><p>Compare the instructor's example to your own</p></div>"
          //-------------
      
        $.each( obj, function(key, value ) {
        if(key == 'content')
        { 
          str +="<div id='status_page'>";
          str += "<div class='InstructorView'>";
          str += "<h4 style='color:#4985b8;'><i><b>"+obj.info.assign_title+"</b></i></h4>";
          if(obj.info.assign_description){
            str += "<div id='ass_desc' style='margin-left: 5%;'>"+obj.info.assign_description+"</div></div>";
          }
        str += "<h3 class='green_txt'>Assignment Submitted</h3><button class='btn-info' onclick='open_work()' type='button' >View</button></div>";

          str += "<div class='InstructorView' id='instrutorsubmitview' style='display:none'  ><h4 class='instrt_ex_head'>Instructor Examples</h4><br><h3 class='nameblock' ><span class='nameicon'><?php echo implode('', array_map(function($v) { return $v[0]; }, explode(' ', $instuctor)));  ?></span><?php  echo $instuctor; ?></h3><br>";

          var i = 1;
          $.each( value, function(key1, value1 ) 
          {
            str += "<div class='instruct_ex'><p>"+i+". "+value1.que_text+"<br></p></div>";
            if(value1.que_attachment)
            {
               var filename = value1.que_attachment;
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str += "<center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a><br>";
                      }
                      else{
                        var ext = filename.split('.');
                      if(ext[1]){
                              str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a>";
                          }
                        }
                      }
                      str += "</div>";
            }

            if(value1.ans_text)
            {
              str += "<div><b>Answer : </b><br>"+value1.ans_text+"</div><br>";
            }
            if(value1.ans_attachment)
            {
               var filename = value1.ans_attachment;
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str += "<center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                        var ext = filename.split('.');
                      if(ext[1]){
                              str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a>";
                          }
                        }
                      }
                      str += "</div>";
            }

            //str += "<li class='Qcon' id='Qcon_"+i+"'>"+i+") "+value1.que_text+"</li>";
            // alert(  value1.assign_id );
            i++;
          });
          str += "</div>";
        }

      
        // });
        

//-------------

      if(key == 'stud_content')
        { 
          str += "<div class='InstructorView' id='yoursubmitview'  style='display:none' ><h3 class='your_sub'>Your Submission33</h3><h3 style='color: #4985b8;'><span class='nameicon'><?php echo implode('', array_map(function($v) { return $v[0]; }, explode(' ', $uname)));?></span><?php  echo $uname;?></h3><br>";

          var i = 1;
          $.each( value, function(key1, value1 ) 
          {
            str += "<div class='instruct_ex'><p>"+i+". "+value1.que_text+"<br></p></div>";
            if(value1.que_attachment)
            {
               var filename = value1.que_attachment;
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str += "<center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a><br>";
                      }
                      else{
                        var ext = filename.split('.');
                      if(ext[1]){
                          str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a>";
                          }
                        }
                      }
                      str += "</div>";
            }

            if(value1.stud_ans)
            {
              str += "<div><b>Answer : </b><br>"+value1.stud_ans+"</div><br>";
            }
            if(value1.ans_attach_for_stud)
            {
               var filename = value1.ans_attach_for_stud;
               if(filename){
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str += "<br><center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str += "<br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                        var ext = filename.split('.');
                      if(ext[1]){
                          str += "<br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a>";
                          }
                        }
                      }
                      str += "</div>";
                    }
            }

            //str += "<li class='Qcon' id='Qcon_"+i+"'>"+i+") "+value1.que_text+"</li>";
            // alert(  value1.assign_id );
            i++;
          });
          str += "</div>";
        }
        
      });
      str += "</div></div>";

     //----------
      my_nexturllist(pro_id,mod_id,lesson_id, srno);        
                  my_previousurllist(pro_id,mod_id,lesson_id, srno);  
                  getMarkCompleted(pro_id,mod_id,lesson_id);  
          //$(".ud-lectureangular").html(data); asset-container
          var iauto =1;
          if(iauto==1)
          {
             $("#overlay").hide();
          $(".asset-container").html(str);
          iauto++;
            }

          highlight(srno);
          lecctureTitle(pro_id,mod_id,lesson_id); 
///////////////
          // var slider = 
          $(document).find('.bxslider1').bxSlider();
          //-------------
          $(document).find('.bx-prev, .bx-next, .bx-pager-link, .bx-start, .bx-stop').removeAttr("href");
        }
        else
        {
          //alert('no');

                   str += "<br><br><div class='panel panel-primary' style='height:auto' data-collapsed='0'><div class='panel-heading'><div class='panel-title' style='padding-bottom: 0px;'>";
        str += "<p style='margin-top: 0;'></p><center><h2 class='assgn_head' style='color:#fff;text-align:center'>Assignment : "+obj.info.assign_title+"</h2></center>";
        str += "<input name='assign_idd' value='"+web_id+"'  style='display:none'>";
        //alert(web_id);
        if(obj.info.estimated_time){
          
        str += "<p class='assgn_txt' style='margin-bottom: 0px; text-align:center;'><span style='color:#fff'>"+obj.info.estimated_time+" to complete</span></p>";
        }
        str += "</div></div>";
        
        str += "<div class='panel-body form-horizontal form-groups-bordered'>";
        if(obj.info.assign_description){
        str += "<div id='ass_desc' >"+obj.info.assign_description+"</div>";
        }
        str += " <div id='wrapper' style='display:none'><center><div class='assgnmt_progress'><div class='progress_circle'><span class='bartext'>Instruction</span><br><span class='baricon'>1</span><span id='bar1' class='progress_bar'></span></div>";
        str += "<div class='progress_circle'><span class='bartext'>submission</span><br><span class='baricon'>2</span><span id='bar2' class='progress_bar'></span></div>";
        str += "<div class='progress_circle'><span class='bartext'>Instructor Example</span><br><span class='baricon'>3</span></div><br></div></center><hr></div>";

        str += "<div id='style-1' style='display:none' ><div id='instruct'><h2 >Assignment Instructions</h2><div id='instructions'>"+obj.info.assign_instruction+"</div>";
        if(obj.info.instruction_videos)
        {
        str += "<div class='requirements__title'>Instuction Video</div><div id='video11' ><center><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+obj.info.instruction_videos+"' type='video/mp4'></video></center><br></div>";  
        }
        if(obj.info.resources_files)
        {   
          var arr =  obj.info.resources_files.substring(obj.info.resources_files.lastIndexOf('.') + 1).toLowerCase();
            var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
            if ($.inArray(arr.toLowerCase(), fileExtension) >= '1')
              {
                str += "<div class='requirements__title'>Resource Media</div><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+obj.info.resources_files+"'></center><br>";
              }
              else{
                var res_name = obj.info.resources_files.substr(10);
                str += "<br><b>Resource Files</b><br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+obj.info.resources_files+"' onclick='return false' id='"+obj.info.resources_files+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+obj.info.resources_files+"</a>"
              }  
        }

        // var obj = {
        //   "flammable": "inflammable",
        //   "duh": "no duh"
        // };
        //$.each(ansresult.data, function(ansk, ansval){
        $.each( obj, function(key, value ) {
        if(key == 'content')
        { str += "<div id='Ques'><h4>Questions for this Assignment<br></h4></div>";
          var i = 1;
          $.each( value, function(key1, value1 ) {

            str += "<li class='Qcon' id='Qcon_"+i+"'><p>"+i+") "+value1.que_text+"</p></li><br>";
            // alert(  value1.assign_id );
            if(value1.que_attachment)
            {
               var filename = value1.que_attachment;
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str += "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str += "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                          var ext = filename.split('.');
                      if(ext[1]){
                              str += "<br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a>";
                          }
                        }
                      }
                    str += "</div>";
            }
            i++;
          });

        }
      
        });

        
        str += "</div>";  // end Instruct
        
        str += "<div id='submission'><div class='assgnmt_grp_btn'></div><h2>Assignment Submission</h2>Save or Submit your work | <span id='status_ass' style='display:none' class='assgnmt_submit'> Assignment Submitted</span>";
        str += "<input type='submit' id='upQattach' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>";
        $.each( obj, function(key, value ) {
        if(key == 'content')
        { str += "<div id='Ques'><h4>Questions for this Assignment<br></h4></div>";
          var i = 1;
          $.each( value, function(key1, value1 ) {

            str += "<div class='Qset' id='Qset_"+i+"'><p>"+i+". "+value1.que_text+"</p><br></div>";
              if(value1.que_attachment)
            {
               var filename = value1.que_attachment;
                     var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
                      
                       str += "<div id='srcview_"+i+"'>";
                      
                       if ($.inArray(arr, fileExtension) >= '1')
                      {
                          str += "<div class='requirements__title'></div><center><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></a></center><br>";         
                      //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                      }
                     
                      else{
                         var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

                      if($.inArray(arr, videoExtension) >= '1')
                      {  
                          str += "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></a></center><br>";
                      }
                      else{
                          var ext = filename.split('.');
                      if(ext[1]){
                              str += "<br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+filename+"' onclick='return false' id='"+filename+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+filename+"</a>";
                          }
                        }
                      }
                      str += "</div>";
            }
                  str += "<input name='Q_id[]' id='Q_id_"+i+"' style='display:none' value='"+value1.q_id+"'>";
            str += "<div class='Qans'><label>Answer : </label> <div class='Qans' id='Qans_"+i+"' style='display:none' ></div></div>";
            
            str += "<div class='textview' id='textview_"+i+"' ><textarea class='col-sm-5 Ansview'  name='ansview[]' id='ansview_"+i+"' style=' width: 40.5%;' placeholder='Enter Your Answer' ></textarea></div>";
                  str += "<div class='stufiles' id='stufiles_"+i+"' style='display:none' >";
                  str += "<input name='Ans_att[]' id='Ans_att_"+i+"' style='display:none' value=''> </div>";
                  str += "<div id='stuansfiles_"+i+"'></div><span class='stuAttachment' id='stuAttachment_"+i+"'><label for='stufilestyle_"+i+"' class='btn btn-info uploadbutton ' >Add Attachment</label>";      
                  str += "<input type='file' name='stu_Att' onchange='stuAnsfile(this)'  class='stu_Att' data-icon='true' id='stufilestyle_"+i+"'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span>";

                  str += "<div class='subview' id='subview_"+i+"' style='diaplay:none' ></div>";
            str += "<div id='progress_stuattach_"+i+"' class=' progress1 progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_stuattach_"+i+"' class='progress-bar1' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div class='percent-bar1' id='percent_stuattach_"+i+"'></div></div></div>";

            str += "";
            // alert(  value1.assign_id );
            i++;
          });

        }
      
        });

                str += "<button type='button' class='subconfirm assgn_submt btn btn-success' onclick='submit_confirm()' style='float:right' >Submit</button></div>";

        str += "</div>";  // end submission
         
        
        str += "<div id='instructor_ex'><div><h3>How did you do?</h3><br><br></div><p>Compare the instructor's example to your own</p><div id='alertsubmit'><div class='alert alert-info'><strong >Still you are not submitted your assignment!</strong></div></div>";
        str += "<div class='compare_assign'></div>"

        str += "</div>";

        str += "<input class='btn btn-info btn2' id='pre2'  style='display:none' type='button' value='Previous' onclick=show_prev('submission','bar2')>";
              str += "<input  class='btn btn-info btn1'  id='pre1'  style='display:none' type='button' value='Previous' onclick=show_prev('instruct','bar1')>";
              str += "<input class='btn btn-info btn2'  id='next2'  style='display:none' type='button' value='Next' onclick=show_next('submission','instructor_ex','bar2')>";
              str += "<input class='btn btn-info btn2' id='next1' style='display:none' type='button'  value='Next' onclick=show_next('instruct','submission','bar1')>";
            
        str += "<button type='button' id='btn-start' onclick='start_assign()'>Start assignment</button></div>";
        str += "<button type='button' style='display:none' id='' onclick='end_assign()'>Finish</button></div>";
        //id = btn-end
        str += "<div>"; //panel-body

        //<h3><span id='title'>"+obj.assign_title+"</span> </h3>";
        my_nexturllist(pro_id,mod_id,lesson_id, srno);        
                  my_previousurllist(pro_id,mod_id,lesson_id, srno);  
                  getMarkCompleted(pro_id,mod_id,lesson_id);  
          //$(".ud-lectureangular").html(data); asset-container
          var iauto =1;
          if(iauto==1)
          {
             $("#overlay").hide();
          $(".asset-container").html(str);
          iauto++;
            }

          highlight(srno);
          lecctureTitle(pro_id,mod_id,lesson_id); 
///////////////
          // var slider =
          $(document).find('.bxslider1').bxSlider();

           $(document).find('.bx-prev, .bx-next, .bx-pager-link, .bx-start, .bx-stop').removeAttr("href");
                 }


      }); 
      
      getLessionNotes(pro_id,mod_id,lesson_id);
      getlessionDiscussion(pro_id,mod_id,lesson_id);
      setViewLesson(pro_id,mod_id,lesson_id); 
      backgroundColor();
    
    }
      function stopNext()
  {   
    //alert('Please complete previous lectures first!');


 jQuery.alert({
          confirmButton: 'Ok',
           title: 'Go in serialize way!',  
content: '<center>Please complete previous lectures first!</center>',                
         
        });
 
}


    function lecture_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id)
    {
      $("#proid").val(pro_id);
      $("#modid").val(mod_id);
      $("#lessid").val(lesson_id);
          
      $.ajax({
      type: "POST",
      url: "<?php echo base_url()?>lessons/ajaxlesson/",
      data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id },
      dataType: 'json',
      beforeSend : function( data ) { 
         $("#overlay").show();
         $(".asset-container").html('');},
      success :function(data) 
      {   
        // alert('success');
        // if(data=='error')
        // {
        //   alert('There was error while processing, try again!');
        // }
        // else
        // {                
 
            //var dt = '<div class="show-progress"><div class="progress-top" style="position: relative; height: 100%;"> <span class="percent completion-ratio">0%</span><div class="note"> <span>You have completed <b class="completion-ratio">0%</b> of this course</span> </div></div><div class="feedback-form" style="height: 0%;"> </div></div><';
          //$(".asset-container").html(dt);   
                  my_nexturllist(pro_id,mod_id,lesson_id, srno);        
                  my_previousurllist(pro_id,mod_id,lesson_id, srno);  
                  getMarkCompleted(pro_id,mod_id,lesson_id);  
          //$(".ud-lectureangular").html(data); asset-container
          var iauto =1;
          //alert(data);
          if(iauto==1)
          {
            var content = jQuery.parseJSON(data);
                     console.log(data);    

             $(".asset-container").html(data['content']);
            if(data['video'])
            {
              play_video(2,data['video'],data['video']);
              $('#overlay').delay(1500).hide(0); 
            } 
            else {
             $("#overlay").hide();
            // set_video();
            }
            if(data['exam'] == "1")
            {
              if($("body").hasClass("quizattempt")){}
              else
                $("body").addClass("quizattempt_load");
                $("body").addClass("quizattempt"); 
                $("#extras").hide()
                $("#sidebar_down").css({position:'absolute'});
                  $(".tab-label-container").hide();

            }
            else{
                if($("body").hasClass("quizattempt"))
                $("body").removeClass("quizattempt"); 
                $("#extras").show()
                $("#sidebar_down").css({position:'relative'});
                  $(".tab-label-container").show();
            }

          $(document).find('.bxslider1').bxSlider();
          $(document).find('.bx-prev, .bx-next, .bx-pager-link, .bx-start, .bx-stop').removeAttr("href");   
          // convert_ply();
                    set_lec_act(pro_id,mod_id,lesson_id);      

          iauto++;
            }
           
       //       $(".asset-container").find(".video-js").each(function () {
       //      var videoId = $(this).attr('id');  

       //      videojs(document.getElementById(videoId));      
       // });

          highlight(srno);
          lecctureTitle(pro_id,mod_id,lesson_id); 
///////////////
          // var slider = 
          
       //slider.reloadSlider(); 
       ////////////    
       

        // }
      }, error:function(error){
        var json = $.parseJSON(error);
        console.log(error.responseText);
       // alert('error');
      }
    }); 

      
      getLessionNotes(pro_id,mod_id,lesson_id);
      getlessionDiscussion(pro_id,mod_id,lesson_id);
      setViewLesson(pro_id,mod_id,lesson_id); 
      backgroundColor();

    }

  function nextslide(pro_id,mod_id,lesson_id,srno,layoutid,web_id)
  { 
  //    alert('555');
  // console.log('hii');
    //alert(lesson_id);
    var st_txt = $('#test_status').val();

    if(lesson_id == '')//added on 14-09-2015 by yo
    {
      $(".ud-lectureangular").html('No Lecture found');     
    }
    else if(st_txt != '')
    {
         jQuery.confirm({
             title: 'Are you sure!',
             content: '<center><h4 style="color:#016ac1;padding:2%;font-weight:bold;">Do you really want to jump on next page..?</h4></b></center>',
               confirmButton: 'Yes',
               cancelButton: 'No',
             confirm: function(){
             
               if(layoutid == '22'){
                 webinar_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id);
               }
               else if(layoutid == '2'){
                 assignment_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id);
               }
               else{
                 lecture_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id);
               }
               $('#test_status').val('');
             },
             cancel: function(){
             
                return true;
             }
      
         });
         
    }
    else
    {
       if(layoutid == '22'){
           webinar_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id);
         }
         else if(layoutid == '2'){
           assignment_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id);
         }
         else{

           lecture_page(pro_id,mod_id,lesson_id,srno,layoutid,web_id);
         }
    }
   
   
  }

  function open_work()
  {
    $('#status_page').hide();
    $('#instrutorsubmitview').show();
    $('#yoursubmitview').show();
  }

  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>  -->
<!--     <script src="https://malsup.github.com/jquery.form.js"></script> 
 --> 
     <script src="<?php echo base_url(); ?>public/js/form-master/jquery.form.js"></script>
   <script src="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.css" rel="stylesheet" />

<script type="text/javascript">
  jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
var $ =jQuery.noConflict();
$(document).find(".bxslider1").each(function () {
                   // count++;
                 
                  $(this).bxSlider();

                });
 $(document).ready(function()
               {
              //  var pro_id = $("#proid").val();
              // var mod_id = $("#modid").val();
              // var lesson_id = $("#lessid").val();
              // my_nexturllist(pro_id,mod_id,lesson_id, "2");

               // alert('yes1');
               setTimeout(function() {

               // $(document).ready(function(){

                               // });                 
                 $(document).find('.bx-prev, .bx-next, .bx-pager-link, .bx-start, .bx-stop').removeAttr("href");

                 }, 2000);
               });
 

function stuAnsfile(stuid)
{
  var name = $(stuid).attr('id');
  var ele_id = name.split('_');

  var name1 = $('#stufilestyle_'+ele_id[1]).val();
  name = name1.replace('C:\\fakepath\\', '');
   if(name)
    { 
        $('#testfile').val('stu_Att');
       $('#stuAttachment_'+ele_id[1]).css('display','none');  
$('#progress_stuattach_'+ele_id[1]).css('display','block');
     // up_attchQue(name);
     var optionsQattach = { 

    beforeSend: function() 
    { 
        $(".loader").show();
       // clear everything
        $("#bar_stuattach_"+ele_id[1]).width('0%');
        // $("#message").html("");
        $("#percent_stuattach_"+ele_id[1]).html("0%");
         $('#progress_stuattach_'+ele_id[1]+ele_id[1]).css('display','block');
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
    
       $(".loader").show();
        $("#bar_stuattach_"+ele_id[1]).width(percentComplete+'%');
        $("#percent_stuattach_"+ele_id[1]).html(percentComplete+'%');
    },
    success: function(response) 
    { 
       $(".loader").hide();
       console.log(response);
         $('#progress_stuattach_'+ele_id[1]).hide();
 //         $(".linkedfile").find("#message").show();
 // $(".linkedfile").find("#message").html("Uploaded");
      if(response)
      {
        var str = "<div style='padding:0.5% 0%' id='stufile_"+ele_id[1]+"' class='stufile'>";   
    var arr =  response.substring(response.lastIndexOf('.') + 1).toLowerCase();
    console.log(arr);
     var fileExtension = ['jpegs','jpeg', 'jpg', 'png', 'gif', 'bmp'];
      var videoExtension = ['webms','webm', 'mp4', 'ogv', 'mid'];

      if ($.inArray(arr, fileExtension) >= '1')
      {

        str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+response+"' onclick='return false' id='"+response+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img style='width:250px;' id='"+response+"' src='<?php echo base_url(); ?>public/images/"+response+"' ></a>";
      }
      else{
          if($.inArray(arr, videoExtension) >= '1')
      {  
      str += "<div class='requirements__title'></div><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+response+"' onclick='return false' id='"+response+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+response+"' type='video/mp4'></video></a></center>";
      }

        else{
          //id='"+name+"' href='<?php echo base_url(); ?>lessons/filedownload/"+name+"'
          var ext = response.split('.');
          if(ext[1]){
          str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+response+"' onclick='return false' id='"+response+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+name+"</a>";
          }
        }
      }
      str += "<button style='float:none; margin-top: -5px;' type='button' class='btn btn-danger btn_remove' id='remove_"+ele_id[1]+"' onclick='remove_file(this)' >X</button><br></div>";
      $('#stufiles_'+ele_id[1]).append(str);
      //$('.attachment').hide();

      $('#stufiles_'+ele_id[1]).show();
      $('#stufiles_'+ele_id[1]).find('input').val(response);
      }
        
    },
    complete: function(response) 
    {      
     //alert(response); 
      
    $('#stufilestyle_'+ele_id[1]).val('');
       return true;
        //alert('video');
    },
    error: function()
    {  
       $('#stuAttachment_'+ele_id[1]).show();

       $(".loader").hide();

         $("#progress_Stuattach_"+ele_id[1]).hide();
          alert('fail to upload, plz try again');
          // $('#file_v').val('');
          // $("#progress_video").hide();
         
    }

}; 
$j("#proform").ajaxForm(optionsQattach);
    
     $("#submission").find('#upQattach').click(); 
       
    }
 
  // alert(name);
}

function remove_file(id)
{
 var name = $(id).attr('id');
  var ele_id = name.split('_');
  $("#stufiles_"+ele_id[1]).find('.stufile').remove();
  $('#stuAttachment_'+ele_id[1]).css('display','block');

}

  function web_start(url)
  {
    // alert(url);
     var arr_url = url.split(":");
      if(arr_url[0] == "http")
      {
             url = url.replace("http","https");
      }
    //  alert(url);
    $('#test_status').val('webinar');
    var str = '<div class="iframe_div">';   
            
      str += '<iframe src="'+url+'" style="width:100%;height:700px" ></iframe>';

      str += '</div>';
       $("#overlay").hide();
          $(".asset-container").html(str);
          
      //$(".asset-container").html(data);
  }

  function set_lec_act(pro_id,mod_id,lesson_id, srno)
  {
    var u_id = "<?php echo $user_id; ?>";
    $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>lessons/LecActivity/",
    data: {'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id, 'user_id':u_id},
     success: function(msg)
    {  
      if(msg){
        $('#lec_act_id').val(msg);
        resume_video(msg);
      }
    }
    }); 
  }

  function my_nexturllist(pro_id,mod_id,lesson_id, srno)
  {
    var rez_type = $(document).find('#rez_type').val();
    $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>lessons/my_getnexturl/"+rez_type,
    data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id, 'srno':srno}
    }).success(function(data) 
    {   //console.log(data);
      if(data=='error')
      {
        alert('There was error while processing, try again!');
      }
      else
      {          
        $("#myNextLect").html(data);              
      }
    }); 
  }

  function my_previousurllist(pro_id,mod_id,lesson_id, srno)
  {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>lessons/my_getpreurl/",
    data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id, 'srno':srno}
    }).success(function(data) 
    {      
      //alert(data);
      if(data=='error')
      {
        alert('There was error while processing, try again!');
      }
      else
      {                    
          $("#prev-lecture").html(data);            
      }
    }); 
  }
  
  function nexturllist(pro_id,mod_id,lesson_id)
  {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>lessons/getnexturl/",
    data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id}
    }).success(function(data) 
    {   
        
       if(data=='error')
      {
        alert('There was error while processing, try again!');
      }
      else
      {                    
          $("#bottom").html(data);              
      }
    }); 
  }
  
  function previousurllist(pro_id,mod_id,lesson_id)
  {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>lessons/getpreurl/",
    data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id}
    }).success(function( data ) 
    {      
      if(data=='error')
      {
        alert('There was error while processing, try again!');
      }
      else
      {                    
          $("#prev-lecture").html(data);            
      }
    }); 
  }
  
  $(window).load(function(){
      $(".tab-label-container").show();
      $("#overlay").hide();
  });
</script>
<script>
function markCompleted()
{
    var pro = $("#proid").val();
    var mod = $("#modid").val();
    var les = $("#lessid").val();
    //alert(pro);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/getmarkcompleted",
      data: {pro:pro,mod:mod,les:les}, 
      success: function(response)
      { //alert(response);
        $("#mark_as_complete").html(response);
        if(response[0] == 1)
        {
        $("#maskDiv"+les).html("<span class='ci-progress-maskgreencheck'></span>");       
        setViewLesson(pro,mod,les);
        }
        else
        {
        $("#maskDiv"+les).html("<span class='ci-progress-mask green'></span>"); 
        }
        //alert(response[0]);
        countmarkCompleted();
        getnextlecture(pro, mod, les);
      }
      });   
}

function getnextlecture(pro, mod, les)
{
    var pro = pro;
    var mod = mod;
    var les = les;

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/getnextlecture",
      data: {pro:pro,mod:mod,les:les}, 
      success: function(response)
      {     
        var objNew = jQuery.parseJSON(response);
        console.log(objNew.lect_data.id);
        console.log(objNew.lect_data.section_id);
        console.log(objNew.lect_data.p_id);
        console.log(objNew.keyid);
        var keyadd = parseInt(objNew.keyid) + 1;

        var str= '<a onclick="nextslide('+objNew.lect_data.p_id+','+objNew.lect_data.section_id+','+objNew.lect_data.id+','+objNew.keyid+')" class="">'+objNew.lect_data.name+'</a>';       
        //$("lesson_"+response1).html(str);
        $("#"+keyadd).find(".lllt_txt").html(str);
        

      }
      });   
}





function getMarkCompleted(pro, mod, les)
{
    var pro = pro;
    var mod = mod;
    var les = les;

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/displayMarkAsCompleted",
      data: {pro:pro,mod:mod,les:les}, 
      success: function(response)
      {     
        $("#mark_as_complete").html(response);        
      }
      });   
}
</script>
<script>
function getlessionDiscussion(pro, mod, les)
{   
    var pro = pro;
    var mod = mod;
    var les = les;

  $.ajax({
        type:"post",
        url:"<?php echo base_url();?>programs/getlessionDiscussion",
        data: {pro:pro,mod:mod,les:les},
        success:function(data)
          {
            //alert(data);
            $("#queAns").html(data);
            //$("#query_title").val("");
            //$("#query_text").val("");
          }

      });
}
</script>
<script>
function insertDiscussion()
{

    var pro = $("#proid").val();
    var mod = $("#modid").val();
    var les = $("#lessid").val();
    var query_title = $("#query_title").val();
    var query_text = $("#query_text").val();
    
  $.ajax({
    type:"post",
    url:"<?php echo base_url();?>programs/insertDiscussion",
    data:{pro:pro,mod:mod,les:les,query_title:query_title,query_text:query_text},
    success:function(data)
    {
      
      getlessionDiscussion(pro, mod, les);
      $("#query_title").val(" ");
      $("#query_text").val(" ");
    }

  });
}
</script>

<script type="text/javascript">
  var $ =jQuery.noConflict();
  function slidemessage(r_date,layoutid)
  {
    if(layoutid == '12')
    {
    $.alert({
          confirmButton: 'Ok',                                  
          title: ' ',
        content: '<center><b><h3 style="color:red">This quiz not available!<br> It`s Start On Date : '+r_date+'</h3></b></center>',                
          confirm: function(){
              // window.location.href = "<?php echo base_url(); ?>lessons/lesson/"+pid+"/"+sid+"/"+courseid;
          }
      });
    } 
    else
    {
    $.alert({
          confirmButton: 'Ok',                                  
          title: ' ',
        content: '<center><b><h3 style="color:red">This Lecture not available!<br> It`s Release on Date : '+r_date+'</h3></b></center>',                 
          confirm: function(){
              // window.location.href = "<?php echo base_url(); ?> ?>lessons/lesson/"+pid+"/"+sid+"/"+courseid;
          }
      });
    } 
  }
</script>

<script>
  function loadPdf()
  {
    alert('yes');
    //$("#pdfDiv").load("http://www.create-online-academy.com/public/uploads/documents/After creating instructor.doc");
    //$("#pdfDiv").html("<object data='http://www.create-online-academy.com/public/uploads/documents/phocapdf-demo.pdf' type='application/pdf' width='100%'' height='200px'>alt : <a href='http://www.create-online-academy.com/public/uploads/documents/phocapdf-demo.pdf'>page2.pdf</a></object>");
    
    $("#pdfDiv").html("<object data='<?php echo base_url(); ?>public/uploads/documents/After creating instructor.doc' type='application/vnd.oasis.opendocument.text' width='100%'' height='200px'></object>");
    //$("#pdfDiv").html("<iframe src='http://www.create-online-academy.com/public/uploads/documents/123d.txt'>myDocument</iframe>");

  }
</script>
<script>
function setViewLesson(pro_id,mod_id,lesson_id)
{
  //alert(pro_id);
  var visited_time = $("#visited_time").val();
  console.log(visited_time);
$.ajax({
    type:"post",
    url:"<?php echo base_url();?>lessons/setViewLesson",
    data:{pro_id:pro_id,mod_id:mod_id,lesson_id:lesson_id,visited_time: visited_time},
    success:function(data)
    {
      var obj = $.parseJSON(data);
      $("#visited_time").val(obj.current_time);
      if(obj.msg == "success")
      {
        $("#maskDiv"+lesson_id).html("<span class='ci-progress-mask green'></span>");
      }
    }
  }); 
}

function start_exam(att_no, qname, exam_id, proid, layoutid, indexy, webcamoption)//start new exam first time
{ 
  // alert(qname);
  //alert(layoutid);alert(webcamoption);alert(qname);
  $('#test_status').val('exam');
  if(webcamoption == '1')
  {
    if(document.getElementById('video').getAttribute('src') == null)
    {
      alert('Webcam is mandatory');
      return false;
    }
  }

  $("#buy_loader").css('display','block');
  $("#btnStartexam").css('display','none');
   $.ajax({
    type:"post",
    // url:"<?php echo base_url();?>lessons/startexam",
    url:"<?php echo base_url();?>lessons/startEx",
    data:{exam_id:exam_id,proid:proid,layoutid:layoutid,indexy:indexy,qname:qname,att_no:att_no},
    dataType: "json",
    success:function(data)
    {
      if($("body").hasClass("quizattempt")){}
      else
        $("body").addClass("quizattempt"); 

        // console.log(data);
      $("#my_middle_content").html(data[0]);  
      $("#coursesection").hide();   
      $("#ExamSection").show();
$("#extras").hide()
$("#sidebar_down").css({position:'absolute'});
      $(".tab-label-container").hide();
      $('#ExamSection').find('#Quesmarkopt').html(data[1]);
      // $('#icon2').click();
       closeNav2();
      // $(document).find(".close_sidebar").click();
                  $("#responsive-sidebar").hide();
                  $(".close_sidebar").hide();
                  $('#txtTotalLeave').style.float="left";

    }
  }); 

  var ddd = 0;
  intTotalspent = setInterval( function(){ 
    //var school_id = document.getElementById('txtSegment').value;
    //Do something after 1 second       
      ddd = parseInt(ddd) + parseInt(1);
      $('#txtTotalSpent').val(ddd);
      }
      , 1000 );

  var hidden, state, visibilityChange,
    _this = this;

    if (document.hidden != null) {
      hidden = "hidden";
      visibilityChange = "visibilitychange";
      state = "visibilityState";
    } else if (document.mozHidden != null) {
      hidden = "mozHidden";
      visibilityChange = "mozvisibilitychange";
      state = "mozVisibilityState";
    } else if (document.msHidden != null) {
      hidden = "msHidden";
      visibilityChange = "msvisibilitychange";
      state = "msVisibilityState";
    } else if (document.webkitHidden != null) {
      hidden = "webkitHidden";
      visibilityChange = "webkitvisibilitychange";
      state = "webkitVisibilityState";
    }

    // Calculates Time Spent on page upon switching windows
    setInterval((function() {
      if (document.hasFocus() === false) 
      {
        var mytime = $('#txtTotalLeave').val();
        time_spent = parseInt(mytime) - parseInt(1);
        doSomething("Switched Window", time_spent);
        //_this.d = new Date();
      }
    }), 1000);    

    // Calculates Time Spent on page upon leaving/closing page
    window.onunload = function() {
      var mytime = $('#txtTotalLeave').val();
      time_spent = parseInt(mytime) - parseInt(1);
      doSomething("Left Page", time_spent);
    };

    // Calculates Time Spent on page upon unfocusing tab
    // http://davidwalsh.name/page-visibility
    document.addEventListener(visibilityChange, (function(e) {
      if (document[state] === 'visible') 
      {
      } else if (document[hidden]) {
        var mytime = $('#txtTotalLeave').val();
        time_spent = parseInt(mytime) - parseInt(1);
        doSomething("Changed Tab", time_spent);
      }
    }), false);

    // Function that does something
    var doSomething = function(message, time_spent) {
      if (time_spent >= 1) {
        $('#txtTotalLeave').val(time_spent);       
      }
    }   
}

function nextQuestion(qname,media_id, proid, layoutid, indexy, qtype)//next after first question, created for timer setting
{
  if(qtype == 'match_the_pair')
  {
    var concatAboveThree='';
    var totalTime = $('#txtTotalSpent').val();
    var timeOutOfWindow = $('#txtTotalLeave').val();
    for(var ii=1;ii<=5;ii++)
    {
      if (document.getElementById('txtQuestion'+ii))
      {
        var txtQuestion = document.getElementById('txtQuestion'+ii).value;  
        var txtOption = document.getElementById('txtOption'+ii).value;
        var txtAnswer = document.getElementById('btnMatchPair'+ii).value;

        concatAboveThree+= txtQuestion+'^'+txtOption+'^'+txtAnswer+'~';//concat all three values and make a long string of all QA
      }
    }
    var saveAns = concatAboveThree;
    var question_id = document.getElementById('txtQuestionId').value; 
  }
  else if(qtype == 'multiple_type')
  {
    var checked1 = ''; 
    var totalTime = $('#txtTotalSpent').val();
    var timeOutOfWindow = $('#txtTotalLeave').val();
    //var saveAns = $('#txtMulti').val();
    for(var ii=1;ii<=5;ii++)
    {
      if(document.getElementById('txtOption'+ii))
      {
        var optionid = document.getElementById('txtOption'+ii).value;
        if(document.getElementById('btnMultiple'+ii).checked)
        {
          checked1+= '1^'+optionid+',';
        }else
        {
          checked1+= '0^'+optionid+',';
        }
      }
    }
    
    var saveAns = checked1;
    var question_id = document.getElementById('txtQuestionId').value;
  }
  else
  {
    var totalTime = $('#txtTotalSpent').val();
    var timeOutOfWindow = $('#txtTotalLeave').val();
    var saveAns = $('#txtMulti').val();
    //alert(saveAns);
    var question_id = '';
  }

  $.ajax({
    type:"post",
    url:"<?php echo base_url();?>lessons/startexam",
    data:{media_id:media_id,proid:proid,layoutid:layoutid,indexy:indexy,qname:qname},
    success:function(data)
    {
      $("#my_middle_content_question").html(data);    
      savequestionAns(media_id, proid, saveAns, qtype, question_id, totalTime, timeOutOfWindow);  

      //$('#txtTotalSpent').val('0');
      //$('#txtTotalLeave').val('0');
    }

  }); 
}

function savequestionAns(media_id, proid, saveAns, qtype, question_id, totalTime, timeOutOfWindow)
{
  $.ajax({
    type:"post",
    url:"<?php echo base_url();?>lessons/savequestionAns",
    data:{media_id:media_id, proid:proid, saveAns:saveAns, qtype:qtype, question_id:question_id, totalTime:totalTime, timeOutOfWindow:timeOutOfWindow},
    success:function(data)
    {     
      //alert(data);
      //$("#my_middle_content_question").html(data);    
    }
  }); 
}

function endquiz(qname, media_id, proid, layoutid,indexy, qtype)//last question button click, end quiz
{
  if(qtype == 'match_the_pair')
  {
    var concatAboveThree='';
    var totalTime = $('#txtTotalSpent').val();
    var timeOutOfWindow = $('#txtTotalLeave').val();
    for(var ii=1;ii<=5;ii++)
    {
      if (document.getElementById('txtQuestion'+ii))
      {
        var txtQuestion = document.getElementById('txtQuestion'+ii).value;  
        var txtOption = document.getElementById('txtOption'+ii).value;
        var txtAnswer = document.getElementById('btnMatchPair'+ii).value;

        concatAboveThree+= txtQuestion+'^'+txtOption+'^'+txtAnswer+'~';//concat all three values and make a long string of all QA
      }
    }
    var saveAns = concatAboveThree;
    //alert(saveAns);
    //console.log(saveAns);
    var question_id = document.getElementById('txtQuestionId').value; 
  }
  else if(qtype == 'multiple_type')
  {
    var checked1 = ''; 
    //var saveAns = $('#txtMulti').val();
    var totalTime = $('#txtTotalSpent').val();
    var timeOutOfWindow = $('#txtTotalLeave').val();
    for(var ii=1;ii<=5;ii++)
    {
      if(document.getElementById('txtOption'+ii))
      {
        var optionid = document.getElementById('txtOption'+ii).value;
        if(document.getElementById('btnMultiple'+ii).checked)
        {
          checked1+= '1^'+optionid+',';
        }else
        {
          checked1+= '0^'+optionid+',';
        }
      }
    }
    
    var saveAns = checked1;
    var question_id = document.getElementById('txtQuestionId').value;
  }
  else
  {
    var totalTime = $('#txtTotalSpent').val();
    var timeOutOfWindow = $('#txtTotalLeave').val();
    var saveAns = $('#txtMulti').val();
    var question_id = '';
  }

  $.ajax({
    type:"post",
    url:"<?php echo base_url();?>lessons/endquiz",
    data:{media_id:media_id,proid:proid,layoutid:layoutid,indexy:indexy,qname:qname},
    success:function(data)
    {
              
      //$("#my_middle_content").html(data);   
      savequestionAnsEndExam(media_id, proid, saveAns, qtype, qname, question_id, totalTime, timeOutOfWindow);

      viewlessonUpdate(media_id, proid);    
            
        //saveLessonViewed($user_id,$lesson_id = NULL,$day_id = NULL,$program_id,$currdate);  
    }
  }); 
}

function viewlessonUpdate(media_id, proid)
{ 
  $.ajax({
    type:"post",
    url:"<?php echo base_url();?>lessons/viewlessonUpdate",
    data:{media_id:media_id, proid:proid},
    success:function(data)
    {     
      //alert(data);
      //$("#my_middle_content").html(data);   
    }
  }); 
}

function savequestionAnsEndExam(media_id, proid, saveAns, qtype, qname, question_id, totalTime, timeOutOfWindow)
{
  var end_exam_name = qname;
  $.ajax({
    type:"post",
    url:"<?php echo base_url();?>lessons/savequestionAns",
    data:{media_id:media_id, proid:proid, saveAns:saveAns, qtype:qtype, end_exam:end_exam_name,question_id:question_id,totalTime:totalTime,timeOutOfWindow:timeOutOfWindow},
    success:function(data)
    {     
      
      $("#my_middle_content").html(data);   
    }
  }); 
}

function quizTimeOut()
{
  $.ajax({
    type:"post",
    url:"<?php echo base_url();?>lessons/quiztimeout",
    data:{},
    success:function(data)
    {
      $("#my_middle_content").html(data); 
    }
  }); 
}

function updateMulti(value1)
{
  var str = document.getElementById('txtMulti').value;
  var str2 = value1+',';
  if(str.indexOf(str2) >= 0) 
  {
    var str1 = document.getElementById("txtMulti").value; 
      var res = str1.replace(str2, "");
      document.getElementById("txtMulti").value = res;
  }else
  {
    var oldval = document.getElementById('txtMulti').value;

    //var value2 = value1+',';
    //var res = oldval.concat(value2);
    var value2 = value1;
    var res = value2;
    document.getElementById('txtMulti').value = res;
  }  
}
function updateMultisec(question_id)
{
//var str = document.getElementById('txtMulti').value;
var str = document.getElementById('txtMulti').value;
  if(str.trim())
  {
  
  }
  else
  {
  var str2 =  ''+'^'+question_id+',';
  document.getElementById('txtMulti').value = str2;
  }
}

function updateMultipleType(value1)
{
  var concatCheck = '';
  for(var ii=1;ii<=5;ii++)
  {
    if(document.getElementById('btnMultiple'+ii))
    {
      if(document.getElementById('btnMultiple'+ii).checked)
      {
        var checkVal = document.getElementById('btnMultiple'+ii).value;
        concatCheck = concatCheck+checkVal+','; 
      } 
    }   
  }
  document.getElementById('txtMulti').value = concatCheck;
}

function updateTF(value1)
{
  document.getElementById('txtMulti').value = value1;    
}

function updateMatches(value1, question_id)
{
  //document.getElementById('txtMulti').value = value1+'^'+question_id+','; 
  var str = document.getElementById('txtMulti').value;
  var str2 =  value1+'^'+question_id+',';
  if(str.indexOf(str2) >= 0) 
  {
    var str1 = document.getElementById("txtMulti").value; 
      var res = str1.replace(str2, "");
      document.getElementById("txtMulti").value = res;
  }else
  {
    var oldval = document.getElementById('txtMulti').value;
    var value2 = value1+'^'+question_id+',';
    var res = oldval.concat(value2);
    document.getElementById('txtMulti').value = res;
  }    
}

function updateSubjective(value1, question_id)
{ 
  var abcd = tinyMCE.get('txtSubjective').getContent()
  //alert(abcd);
  document.getElementById("txtMulti").value = abcd;
  var str = document.getElementById('txtMulti').value;
  //alert(str);
  //var str2 =  value1+'^'+question_id+',';
  var str2 =  str+'^'+question_id+',';
  document.getElementById('txtMulti').value = str2;
  //alert(str2);
  /*if(str.indexOf(str2) >= 0) 
  {
    var str1 = document.getElementById("txtMulti").value; 
      var res = str1.replace(str2, "");
      document.getElementById("txtMulti").value = res;
  }else
  {
    var oldval = document.getElementById('txtMulti').value;
    var value2 = value1+'^'+question_id+',';
    var res = oldval.concat(value2);
    document.getElementById('txtMulti').value = res;
  }    */
}
function updateSubjectivesec(question_id)
{ 
  var str = document.getElementById('txtMulti').value;
  if(str.trim())
  {
    
  }
  else
  {
  var str2 =  ''+'^'+question_id+',';
  document.getElementById('txtMulti').value = str2;
  }
}
</script>

<?php
if(isset($quizz->limit_time))
{
?>
  <script>
  function setCookie(cname,cvalue,exdays)
  {
    var d = new Date();
    d.setTime(d.getTime()+(exdays*24*60*60*1000));
    var expires = "expires="+d.toGMTString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
  }
  function getCookie(cname)
  {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) 
      {
      var c = ca[i].trim();
      if (c.indexOf(name)==0) return c.substring(name.length,c.length);
      }
    return "";
  }

  //check existing cookie
  cook=getCookie("my_cookie");

  if(cook==""){
     //cookie not found, so set seconds=60
     //var seconds = 60;
     var seconds = <?php echo $quizz->duration_m;?>*60;
     // alert(seconds);
  }else{
       //seconds = cook;
       //console.log(cook);
       var seconds = <?php echo $quizz->duration_m;?>*60;
            // alert(seconds);

       //var seconds = 60;
  }

  function secondPassed() 
  {
    if(document.getElementById('countdown'))
      {
        // var limt = "<?php echo $quizz->limit_time;?>";
        // alert(limt);
        var minutes = Math.round((seconds - 30)/60);
        var remainingSeconds = seconds % 60;
        if (remainingSeconds < 10) {
            remainingSeconds = "0" + remainingSeconds; 
        }
        //store seconds to cookie
        setCookie("my_cookie",seconds,5); //here 5 is expiry days
        
        document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds; 
        
        if (seconds == 0) 
        {
            clearInterval(countdownTimer);
            document.getElementById('countdown').innerHTML = "Time Out";
            quizTimeOut();
        } else {    
            seconds--;
        }
    }
  }

  var countdownTimer = setInterval(secondPassed, 1000);
  </script>
<?php
}
?>

<script type="text/javascript"> 


// $('body').bind('copy paste',function(e) {
//     e.preventDefault(); return false; 
// });
//below javascript is used for Disabling right-click on HTML page

//document.oncontextmenu=new Function("return false");//Disabling right-click
 
 
//below javascript is used for Disabling text selection in web page
document.onselectstart=new Function ("return false"); //Disabling text selection in web page
if (window.sidebar){
//document.onmousedown=new Function("return true"); 
//document.onclick=new Function("return true") ; 
 
 
//Disable Cut into HTML form using Javascript 
//document.oncut=new Function("return false"); 
 
 
//Disable Copy into HTML form using Javascript 
//document.oncopy=new Function("return false"); 
 
 
//Disable Paste into HTML form using Javascript  
//document.onpaste=new Function("return false"); 
}





 
</script>
<script type="text/javascript">
  function highlight(id)
  {
    //alert(id);
       var idd =id + 1;
        //$("li#"+idd).addClass("active1"); 
        //$('li').css("background-color",""); #coursesectionlecture .course_cat1 li
        $('#coursesectionlecture .course_cat1 li').css("background-color","");
      $("li#"+idd).css("background-color","#A7C7E2");
  }
</script>

<script type="text/javascript">
function lecctureTitle(pro_id,mod_id,lesson_id)
{
  
      $.ajax({
      type: "POST",
      url: "<?php echo base_url()?>lessons/lecctureTitle",
      data: {'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id}, 
      success: function(data)
      {
          $("#Course_Name").html("<p>"+data+"</p>");
        //alert(data);
      }
      });
}
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />

<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script>
  
  function countmarkCompleted()
    {
    var pro = $("#proid").val();
    var mod = $("#modid").val();
    var les = $("#lessid").val();
    //alert(pro);
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>lessons/countmarkcomplate",
      data: {pro:pro,mod:mod,les:les}, 
      success: function(response)
      { 
        //alert(response);
        var items = JSON.parse(response);

        
        //alert(items['id_final_exam']);
        if(items['id_final_exam'] !="" && items['id_final_exam'] !="0" && items['status'])
        {
          $.confirm({
          confirmButton: 'Take Quiz',
            cancelButton: 'Go Back to Courses',
            title: 'Congratulations! You have completed the Quiz!<br>',
            content: ' ',
            backgroundDismiss: false,
            confirm: function(){
              
              window.location.href = "<?php echo base_url(); ?>lessons/finalexamnew/"+pro+"/"+items['id_final_exam'];
             },
            cancel: function(){
               
                 window.location.href = "<?php echo base_url(); ?>red-hot/lectures/"+pro;
              }
          }); 
        }
        else
        {
            $.alert({
                  confirmButton: 'Go Back to Courses',                                  
                  title: 'Congratulations! You have completed the lecture!<br>',
                   content: ' ',                 
                  confirm: function(){
                      window.location.href = "<?php echo base_url(); ?>red-hot/lectures/"+pro;
                  }
              }); 
              
          } 

      }
      });   
}
</script>
<script type="text/javascript">
  function showMsg(data)
  {     
       var pid= data.pid;
       var sid= data.sid;
       var courseid=data.courseid;
       var btntxt=data.btntxt;
       var btntxt2 = btntxt.replace(/_/g, " ");
    $.confirm({
             title: 'Are you sure!',
             content: '<center><h4 style="color:#016ac1;padding:2%;font-weight:bold;">Do you want to leave the page?</h4></b></center>',
               confirmButton: 'leave',
               cancelButton: 'stay',
             confirm: function(){
    // $.alert({

    //       confirmButton: 'Ok',                                  
    //       title: btntxt2,
    //     content: 'Do you want to leave the page?',                
          // confirm: function(){
              window.location.href = "<?php echo base_url(); ?>lessons/lesson/"+pid+"/"+sid+"/"+courseid;
          }
      }); 
    
  }
</script>




<script type="text/javascript">
function backgroundColor(){
  //$("#course-taking-page").css("color", "white");
  var bgcol = $('.asset-container').css('backgroundColor');
     // alert(bgcol);
       if (bgcol == 'rgb(255, 255, 255)')
       {
      
         $('#course-taking-page').css("color", "black");
         $('.title').css("color", "#2C2F37");
        
       }
       else if (bgcol == 'rgb(0, 0, 0)')
       {
     
         $('#course-taking-page').css("color", "white");
         $('.title').css("color", "#2C2F37");
      
       }
       else{
      //alert('no its black');
      //$('#course-taking-page').css("color", "white");
       }
}

</script>

<script type="text/javascript">

  $("#white_color").click(function(){
    $(".asset-container").css("background", "white");
        $('.asset-container p').css({"color":"black"});
         $('.panel-heading p').css("color", "white");
       
  })

  $("#black_color").click(function(){
    $(".asset-container").css("background", "black");
     $('.asset-container p').css({"color":"white"});
      $('.panel-heading p').css("color", "white");
     
  })

</script>
<script>
// window.onload = function ()
// {
//  $('.asset-container p').css({"color":"white"});
// }
</script>
<script>
// $(document).ready(function(){
//     $("#mark_as_complete").click(function(){
//         alert("The paragraph was clicked.");
//     });
// });  
</script>
<script>
$(document).ready(function(){
var auto_inc_id = 1;
$('.bx-viewport').each(function(){
  $(this).attr('id', 'sldrhght_'+auto_inc_id);
  auto_inc_id++;     
});

});
</script>
<script>
function openNav() {
    document.getElementById("sidebar").style.width = "25%";
    document.getElementById("main").style.marginRight = "25%";
    // document.getElementById("closebtn").style.Right = "10px";
}

function closeNav() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("main").style.Right= "0";
    document.getElementById("main").style.marginRight = "0px";
}

function closeNav2() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("main").style.Right= "0";
    document.getElementById("main").style.marginRight = "0px";
    document.getElementById("tab-curriculum").style.position = "fixed";
    document.getElementById("tab-curriculum").style.bottom = "0px";
    document.getElementById("tab-curriculum").style.Right = "0px";
    document.getElementById("tab-curriculum").style.top = "80%";
    document.getElementById("tab-curriculum").style.left = "0";
}

</script>
<script>
$(window).bind('resize', function () 
{
  var width = $(window).width()
  //alert(width);
  if (width >= 1260 ) 
  {   
    $(".col-md-12 iframe").css('height','555px');
    $(".col-md-4 iframe").css('height','180px');
    $(".col-md-6 iframe").css('height','245px');
    $(".col-md-3 iframe").css('height','120px');
    $(".col-md-8 iframe").css('height','345px');
  }
  if (width <= 1259 && width >= 1128) 
  { 
    $(".col-md-12 iframe").css('height','480px');
    $(".col-md-4 iframe").css('height','145px');
    $(".col-md-6 iframe").css('height','210px');
    $(".col-md-3 iframe").css('height','105px');
    $(".col-md-8 iframe").css('height','290px');
  }
  if (width <= 1127 && width >= 1024) 
  {
    $(".col-md-12 iframe").css('height','400px');
    $(".col-md-4 iframe").css('height','122px');
    $(".col-md-6 iframe").css('height','180px');
    $(".col-md-3 iframe").css('height','90px');
    $(".col-md-8 iframe").css('height','250px');
  }
  if (width <= 1023 && width >= 928) 
  {
    $(".col-md-12 iframe").css('height','345px');

  }
  if (width <= 927 && width >= 851) 
  {
    $(".col-md-12 iframe").css('height','295px');
  }
  if (width <= 991 && width >= 850) 
  {
    $(".col-md-4 iframe").css('height','335px');
    $(".col-md-6 iframe").css('height','300px');
    $(".col-md-3 iframe").css('height','280px');
    $(".col-md-8 iframe").css('height','280px');
  }
  if (width <= 840 && width >= 768) 
  {
    $(".col-md-12 iframe").css('height','270px');
  }
  if (width <= 480 && width >= 380) 
  {
    $(".col-md-12 iframe").css('height','265px');
  }
  if (width <= 849 && width >= 768) 
  {
    $(".col-md-4 iframe").css('height','270px');
    $(".col-md-6 iframe").css('height','240px');
    $(".col-md-8 iframe").css('height','240px');
  }
  if (width <= 767 && width >= 640) 
  {
    $(".col-md-4 iframe").css('height','390px');
    $(".col-md-6 iframe").css('height','340px');
    $(".col-md-3 iframe").css('height','345px');
    $(".col-md-8 iframe").css('height','345px');
  }
  if (width <= 639 && width >= 550) 
  {
    $(".col-md-4 iframe").css('height','325px');
    $(".col-md-6 iframe").css('height','290px');
    $(".col-md-3 iframe").css('height','295px');
    $(".col-md-8 iframe").css('height','295px');
  }
  if (width <= 549 && width >= 480) 
  {
    $(".col-md-4 iframe").css('height','270px');
    $(".col-md-6 iframe").css('height','250px');
    $(".col-md-3 iframe").css('height','255px');
    $(".col-md-8 iframe").css('height','255px');
  }
  if (width <= 479 && width >= 380) 
  {
    $(".col-md-4 iframe").css('height','214px');
    $(".col-md-6 iframe").css('height','190px');
    $(".col-md-3 iframe").css('height','200px');
    $(".col-md-8 iframe").css('height','200px');
  }
  if (width <= 380 && width >= 320) 
  {
    $(".col-md-4 iframe").css('height','190px');
    $(".col-md-6 iframe").css('height','160px');
    $(".col-md-3 iframe").css('height','170px');
    $(".col-md-8 iframe").css('height','170px');
  }
  if (width <= 768) 
  {
    $("#icon2").css('display','block');
    $( "#responsive-sidebar" ).click(function()
    {
      $("#sidebar").css('display','block');
      $(".toggle_btn").toggle();
    });

    openNav();
    closeNav();

  }
  

}).trigger('resize');

</script>
<script src='<?php echo base_url() ?>public/js/tinymce/tinymce.min.js'></script>
   
<script type = "text/javascript">
jQuery(document).ready(function(){
  
 
  jQuery('.btn2').click(function(){
    jQuery('html, body').animate({scrollTop : 0},800);
    return false;
  });
  
});
</script>
<script>
 $(document).ready( function() {
$( "#responsive-sidebar" ).click(function()
    {
      $("#sidebar").css('display','block');
      $(".toggle_btn").toggle();
    });
  });
</script>
<script type="text/javascript"> 
      // $(document).ready( function() {
      //   $('#sidebar').delay(1000).toggle('slide');
      //   $('#main').css({"right":"0px", "transition":"transition: all 3s ease"});

      // });
</script>
<script>



//   setInterval(function() {
  
//     console.clear(); 
 
// }, 3000);

  function openmyModalyoutube(){

  }
  "use strict";
  const seek_arr = [];
  function resume_video(id){
    // console.log(id+'sss')
    $.ajax({
        
        cache: false,
        url: "<?php echo base_url()?>lessons/get_user_activity/"+id,
        dataType: "json",

        success: function(msg)
        {    
           // console.log(msg);
          var v_pro = $.parseJSON(msg[0]['video_progress']);
           // console.log(v_pro);

           var prov = $.parseJSON(msg[0]['provider']);
          // console.log(prov);
              if(v_pro !== null){
          for (var i = 0; i < v_pro.length; i++) {
              // console.log(prov[i]);
              // // if(prov[i] == 'youtube')
              // // {
              //   console.log(v_pro[i]);

                var ele = v_pro[i].split('|'); 

                var src = ele[0];
// typeof ele[2] !== '100' &&
                // if(ele[2] != 0 && ele[2] != 100){
                var sp_time = ele[1].split('-');
                // console.log(sp_time);
                var sec=0;
                var sec_ele = sp_time[0].split(':');
                if(sec_ele[0]>0){
                  for (var j = 1; j<=sec_ele[0]; j++) {
                      sec=parseInt(sec)+60;

                    }
                  sec=parseInt(sec)+parseInt(sec_ele[1]);
                }else{
                  sec=sec_ele[1];
                }

                seek_arr.push(sec);

                // }


            // }

          }
          }
         // console.log(seek_arr);
         convert_ply(seek_arr);
        }     
      });
}

window.onload = function(){
  // convert_ply();
  var stud_id   = "<?php echo $user_id ?>";
  if(stud_id){
    var id = $('#lec_act_id').val();
    resume_video(id);
  }
  else{
    convert_ply('00');
  }
}

function convert_ply(sp_time){
  var players = [];
    // var count=0;
   $(document).find(".vplyr").each(function () {
     // count++;
     var str = $(this).attr('id');
   
     str = new Plyr('#'+str);

     players.push(str);


});

var i=0;
// console.log(sp_time);
players.forEach(function(player) {
        var ts= parseInt(sp_time[i]);


player.on('ready', () => {
        console.log('plr1 ready');
    player.forward(ts);

   
    // player.play();
  });

// console.log(sp_time[i]);
 i++;
    player.on('play', function() {
    players.forEach(function(pl) {
      if (pl !== player) {
        pl.pause();
        // $(this).find('.ytp-collapse').click(); 
        console.log('play');   

      }
    })
  })


   player.on('pause', function() {
    var sp_arr = [];
    var prcent_arr = [];
    var provider_arr = [];
    var vid_arr = [];
       $(document).find(".plyr").each(function () {

     // var pid = player.elements.original.id;
     

      var chk_html = jQuery(this).hasClass('plyr--html5');
        var chk_youtube = jQuery(this).hasClass('plyr--youtube');
        var chk_vimeo = jQuery(this).hasClass('plyr--vimeo');
   

     // var prov = player.provider;
     if(chk_html==true)
     {
      var prov = 'html5';
      var pid = $(this).find('.playerio').attr('id');

        var sptime = $(document).find('#'+pid).parent().parent().find('.plyr__controls').find('.plyr__progress').find('input').attr('aria-valuetext');

        var percent = $(document).find('#'+pid).parent().parent().find('.plyr__controls').find('.plyr__progress').find('input').attr('style');

        var v_name = $(document).find('#'+pid).find('source').attr("src").split('/').pop().split('#');

     }
     else if(chk_youtube==true){
      var prov = 'youtube';
      var pid = $(this).attr('id');
          var sptime = $(document).find('#'+pid).find('.plyr__controls').find('.plyr__progress').find('input').attr('aria-valuetext');

    var percent = $(document).find('#'+pid).find('.plyr__controls').find('.plyr__progress').find('input').attr('style');

    var v_name = $(document).find('#'+pid).find('iframe').attr("src").split('/').pop().split('?');
     }
     else if(chk_vimeo==true){
            var prov = 'vimeo';
      var pid = $(this).attr('id');
          var sptime = $(document).find('#'+pid).find('.plyr__controls').find('.plyr__progress').find('input').attr('aria-valuetext');

      var percent = $(document).find('#'+pid).find('.plyr__controls').find('.plyr__progress').find('input').attr('style');

      var v_name = $(document).find('#'+pid).find('iframe').attr("src").split('/').pop().split('?');
       }

          provider_arr.push(prov);
          if(sptime)
          sp_arr.push(sptime);
          else{ 
            sptime = '00:00 of 00:00';
          sp_arr.push(sptime);
            }
          prcent_arr.push(percent); 
          vid_arr.push(v_name[0]);
     });

      var id = $("#lec_act_id").val();
      var pro_id    = $("#proid").val();
      var stud_id   = "<?php echo $user_id ?>";
      var mod_id    = $("#modid").val();
      var lesson_id = $("#lessid").val();
        if(stud_id){
        $.ajax({
        
        cache: false,
        type: "POST",
        url: "<?php echo base_url()?>lessons/lec_statistic",
        data: {'id':id,'pro_id':pro_id,'stud_id':stud_id,'mod_id':mod_id,'lesson_id':lesson_id,'v_name':vid_arr,'sptime':sp_arr,'percent':prcent_arr,'prov':provider_arr}, 
        success: function(msg)
        {    
          console.log(msg);
        }     
      });
      }

  });

});
   
}

$(document).find('.bxslider1').bxSlider();
$(document).find('.bx-prev, .bx-next, .bx-pager-link, .bx-start, .bx-stop').removeAttr("href");
</script>
<script>
   var txt = $(document).width();
  var width = txt - 149 ;
  var li_width = width + "px";
$(".bx-wrapper li").css("width", li_width) ;
$(".bxslider1").css("transform", "translate3d(-"+li_width+", 0px, 0px)") ;//

jQuery("#sidebar_down i").click(function(){
    jQuery("body").toggleClass("sidebarOpen");
});


jQuery(".close_sidebar").click(function(){
    jQuery("body").addClass("sidebarisclosed").removeClass("sidebarisopen");
    jQuery("body").removeClass("quizattempt_load");
});

jQuery(".open_sidebar").click(function(){
    jQuery("body").addClass("sidebarisopen").removeClass("sidebarisclosed");
});
</script> 
<style>
   .ytp-pause-overlay{
    display: none!important;
    pointer-events: none!important;
position: absolute!important;
  }
  .ytplayer {
pointer-events: none!important;
position: absolute!important;
}
</style>
