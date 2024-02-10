<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/css/font-icons/entypo/css/entypo.css" media="screen">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>



<style type="text/css">
.bx-has-controls-auto
{
display: none;	
}
video{
	width: 100%;
}
.bx-viewport{height: auto !important;}
select[name='Alignment'] { 
    display: none;
}
.asset-container p{
	color: #fff !important;
}
.lyrow {
    margin-bottom: 10px;
    height: auto !important;
}
.box, .lyrow {
    position: relative;
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
    padding-top: 19px;
    padding-bottom: 19px;
}
.preview {
    display: none;
}
.box .view {
    display: block;
    padding-top: 30px;
}



.lyrow.ui-draggable .view .row .col-md-12 .box-element .view iframe.img-responsive{
	height: 480px;
}







.delspan {
  position: absolute;
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
	background:url("<?php echo base_url(); ?>/public/default/images/timeline-bar.png");
}	

.custom-bdcrumb {
  font-size: 14px;
  position: absolute;
  left: 200px;
  right: auto;
  top: 14px;
  text-align: left;
}
/*.custom-bdcrumb{
  font-size: 20px;
  position: absolute;
  left: 100px;
  right: 0;
  top: 10px;
  text-align: center;
}*/

.custom-bdcrumb{
	color: #84848C !important;
}

.custom-bdcrumb span{
	color: #84848C !important;
	  font-weight: 700;
	  padding-left: 5px;
}



</style>


<?php
$remainAttempts=0;
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
$heading = 'Final Exam';
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
<meta http-equiv='expires' content='1200' />
<meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />
<meta name="keywords" content="<?php echo $metakwd; ?>"/>
<meta name="description" content="<?php echo $metadesc; ?>" />
<meta name="generator" content="<?php echo $metatitle; ?>" />
<!-- ll<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-core.js" ></script>ll -->
<!-- ll<script type="text/javascript" src="<?php echo base_url();?>public/js/modal.js"></script>ll -->
<!-- ll<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-more.js"></script>ll -->
<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/default/js/jquery-1.7.1.min.js"></script>
<!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/default/css/style.css" />-->
<link rel="stylesheet" href="<?php echo base_url();?>/public/default/css/lecture_dashboard.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/default/css/my_lecture_style.css">
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
            //   myWindow=window.open('<?php echo base_url(); ?>/lessons/viewcertificate/<?php echo $program_id; ?>');
                 myWindow=window.open('<?php echo base_url(); ?>/lessons/viewcertificate/'+t1+'','','width=800,height=600, resizable = 0');
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
<!----------------------------------------------------b-b's-layout-end----------------------------------------------------------------- -->
<!---------------------------------------------------Old-layout-start------------------------------------------------------------------- -->
<?php

$sequential = false;
if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE)
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
<div id="course-taking-page" class="ud-dashboard wrapper">
<div class="main"> <a id="go-back" href="<?php echo base_url(); ?><?php echo $urlCourse;?>/lectures/<?php echo $pro_id; ?>" class="pos-r zi1 ml15 mt15 dif text-topaz fs12 bold ml0-md"> <i class="icon-chevron-sign-left fs16 mr5"></i> <span class="fs10-md w130 ellipsis-2lines">Back to Course</span> </a>
  <span id="Course_Name" class="custom-bdcrumb">
   <?php
   		
   $days = $this->program_model->getlistDays($program_id);

   				if($days)
   				{
		foreach ($days as $day)
                {
                	//echo"<pre>";
                	//print_r($day);
                	if(($isfinalview == false))
                	{
                	if($moduleid == $day->id)
                	{
                   		echo "<b>".$day->title." :</b> ";
                   		

                    	//$lessons = $this->program_model->getLessons($day->id);
                  		$lessons = $this->program_model->getLessonNew($day->id);
                    	foreach ($lessons as $lessonn)
                    	{
                    		
                    		if($lessonn->id == $lesson_id)
                    		{
                         	 echo "<span>".$lessonn->name."</span>";                
                            }     
                   		}
                   }
               
                   }
                   
               }
           }
               ?>
    </span>
    <div style="float: right;padding: 9px 15px 0 0;">
<button id="theme_color" style="border-radius: 5px;border: 1px solid black;">Theme Color</button></div>
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
				<a href="javascript:void(0)" onclick="nextslide('<?php echo $pro_id;?>','<?php echo $mod_id;?>','<?php echo $prelesson_id;?>','1');" ><i class="icon-chevron-up"></i></a><span style="cursor:pointer" onclick="nextslide('<?php echo $pro_id;?>','<?php echo $mod_id;?>','<?php echo $prelesson_id;?>','1')">Previous Lecture</span>
				<?php 
			    }
			}
			if($layoutid == 'finalexam')
		    {
		    	$CIq =& get_instance();
	            $quizid = $this->uri->segment(4);
	            $quizz = $CIq->quizzes_model->getItems($quizid);
				?>
              	<a href="javascript:void(0)"><i class="icon-chevron-up"></i></a><span style="cursor:pointer" >Exam : <?php echo $quizz->name;?> - <?php echo $pname;?></span>
				<?php
		    }
			?>
		</div>
		<span class="view-supplementary fs10-force-md mt0-force-md dn-force-xs dn-md none"> View resources </span>
		<div class="asset-container scrollbar" id="style-5">
		
		
        <?php 
        //echo layoutid
		if($layoutid=='1')
		{
			echo $lessonsContent->lecture_content;	
		}		
		elseif($layoutid=='12')
		{

			?>
			<script type="text/javascript">
			$(document).ready(function(){
			$('#course-taking-page').bind('contextmenu', function(e) {
    		return false;
			}); });
			</script>
       		<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
		      	<div id="overlay">
					<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
				</div>

				<div class="texteditor_layoout">
					<?php
							//echo $lec_content;
					?>
				</div>
	          	<div id="media_15">
	          		<div class='my_main'>
	          		<div id='my_middle_content'>
	           		<?php                                           
	                //ajaxquizztotask($db_media[14]->media_id,15,'',$pro_id);
	                //ajaxQuestionsDisplay($db_media[14]->media_id,15,'',$pro_id);//my new function on date 13-05-2015	                    
	                $CIq =& get_instance();
	                $quizz = $CIq->quizzes_model->getItems($lessonsContent->is_exam);
	                //$quizz = $CIq->quizzes_model->getItems($db_media[14]->media_id);
	                //print_r($quizz);

	                $CIless =& get_instance();//on dated 15-05-2015
	                $settings = $CIless->lessons_model->getQuestionIds($lessonsContent->is_exam);
	               //$settings = $CIless->lessons_model->getQuestionIds($db_media[14]->media_id);		
					if($settings)
					{
						foreach($settings as $sett_ques)
						{			
							$expl_quest = explode(',',$sett_ques->quizzes_ids);
							$totalquestions = count($expl_quest);
						}
					}
	                ?>
	                <div class="quiz_timer">


	                	<div class="panel panel-primary" data-collapsed="0"> 

							<div class="panel-heading">
								<div class="panel-title" style="padding-bottom: 0px;">	
									<p style="margin-top: 0; text-align:left; float: left;">Exam Name : <span style="color:#fff"><?php echo $quizz->name;?></span></p>
									
							
								
									<p style="margin-bottom: 0px; text-align:right;"><?php
								if($quizz->show_limit_time == '0')
								{
									?>Exam time limit: <span style="color:#fff"><?php echo $quizz->limit_time;?></span> minutes
								<?php 
								}
								?>	</p>
								</div>  
							</div>


							<div class="panel-body form-horizontal form-groups-bordered"> 

								<div class="form-group"> 
									
									<div class="col-sm-5"> <?php if($quizz->pbl_max_score == '0'){?>Minimum score to pass this exam :- <span style="color:#42943F"><?php echo $quizz->max_score;?>%</span>
				         		<?php }?>
									</div> 
								</div>

								
									<?php
							if($quizz->time_quiz_taken == '11')
							{
								$time_quiz_taken = 'Unlimited';
								$remaining = '';
								$remainAttempts = 1;//always set to 1 when unlimited attempts
							}
							else
							{
								$time_quiz_taken = $quizz->time_quiz_taken;								
								$remaining_attempts = $this->lessons_model->getAttempts($quizz->id, $pro_id);
								$remainAttempts = ($time_quiz_taken - count($remaining_attempts));
								if($remainAttempts > 0)
								{
									$remaining = '<font color=red> ('. $remainAttempts.' attempts remaining )</font>';
								}else{
									$remaining = '<font color=red> ( Your exam attempts completed )</font>';
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
									<?php if($quizz->show_nb_quiz_taken == '0'){?>This exam can be taken up to: <span style="color:#42943F"><?php echo $time_quiz_taken;?></span> times<?php echo $remaining; }?>
									</div>
								</div>
<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
				        //echo $remainingExamTimes;
				        ?>
								<div class="form-group"> 
									

									<div class="col-sm-12">
									You can give exam <?php echo $remainingExamTimes;?> more times
									</div>
								</div>
<?php }?>
								<div class="form-group"> 
									

									<div class="col-sm-12">
									You can always see your exam results on your My Courses page
									</div>
								</div>

								<div class="form-group"> 
									

									<div class="col-sm-12">
									</div>
								</div>

								<hr style="margin:0;" />

								<div class="form-group"> 
									

									<div class="col-sm-5">

															
    				
					<span class="quiz_description" style="  margin-top: 20px;"><?php echo $quizz->description;?></span>

					</div></div>
					<div class="form-group" > 

					<div class="col-sm-5" >

					<?php
					if($remainAttempts > 0)
					{
						?>
						<input type='button' class="btn btn-sm btn-success btn-update" onclick="start_exam('<?php echo $quizz->name;?>',<?php echo $lesson->is_exam;//$db_media[14]->media_id;?>,<?php echo $pro_id;?>,'<?php echo $layoutid;?>','1','0');" value='Start Exam' name='btnStartexam' id='btnStartexam'>
		           		<?php
	           		}
	           		//ajaxquizztotask($db_media[14]->media_id,15)?>

									</div>
								</div>





							</div>

						</div>



						

					</div>					

	          	</div>
	          	</div>
				</div>



				<table cellspacing="0" cellpadding="0" align="center" width="100%">
									<tbody><tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr>
								</tbody></table>

        	</div>
        	<?php 
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
			<div id="media_15" class=''>
	          		<div class='my_main'>
	          		<div id='my_middle_content'>
	           		<?php                                           	                                    
	                $CIq =& get_instance();
	                $quizid = $this->uri->segment(4);
	                $quizz = $CIq->quizzes_model->getItems($quizid);

	                $CIless =& get_instance();//on dated 15-05-2015
	                $settings = $CIless->lessons_model->getQuestionIds($quizid);		
					if($settings)
					{
						foreach($settings as $sett_ques)
						{			
							$expl_quest = explode(',',$sett_ques->quizzes_ids);
							$totalquestions = count($expl_quest);
						}
					}
	                ?>
	                <div class="quiz_timer">


	               		<div class="panel panel-primary" data-collapsed="0"> 

							<div class="panel-heading">
								<div class="panel-title" style="padding-bottom: 0px;">	
									<p style="margin-top: 0; text-align:left; float: left;">Exam Name : <span style="color:#fff"><?php echo $quizz->name;?></span></p>
									
									<p style="margin-bottom: 0px; text-align:right;">

									<?php
									if($quizz->show_limit_time == '0')
									{
										?>Exam time limit: <span style="color:#fff"><?php echo $quizz->limit_time;?></span> minutes
									<?php 
									}
									?>	
									</p>

								</div>  
							</div>


							<div class="panel-body form-horizontal form-groups-bordered"> 

								<div class="form-group"> 
									
									<div class="col-sm-12">
										<?php if($quizz->pbl_max_score == '0'){?>Minimum score to pass this exam :- <span style="color:#42943F"><?php echo $quizz->max_score;?>%</span>
				         		<?php }?>
									</div>

								</div>

							<?php
							if($quizz->time_quiz_taken == '11')
							{
								$time_quiz_taken = 'Unlimited';
								$remaining = '';
								$remainAttempts = 1;//always set to 1 when unlimited attempts
							}
							else
							{
								$time_quiz_taken = $quizz->time_quiz_taken;								
								$remaining_attempts = $this->lessons_model->getAttempts($quizz->id, $pro_id);
								$remainAttempts = ($time_quiz_taken - count($remaining_attempts));
								if($remainAttempts > 0)
								{
									$remaining = '<font color=red> ('. $remainAttempts.' attempts remaining )</font>';
								}else{
									$remaining = '<font color=red> ( Your exam attempts completed )</font>';
								}
							}
							?>
								<div class="form-group"> 
									
									<div class="col-sm-12">	

										
										Questions : <span style="color:#42943F"><?php echo $totalquestions;?></span>

									</div>

								</div>


								<div class="form-group"> 
									
									<div class="col-sm-12">
										<?php if($quizz->show_nb_quiz_taken == '0'){?>This exam can be taken up to: <span style="color:#42943F"><?php echo $time_quiz_taken;?></span> times<?php echo $remaining; }?>
									</div>

								</div>

								<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes))
						{
					        //echo $remainingExamTimes;
					        ?>
								<div class="form-group"> 
									
									<div class="col-sm-12">
									<p style="padding-top:15px;">You can give exam <?php echo $remainingExamTimes;?> more times</p>
									</div>
								</div>
								<?php 
						}
						?>							

								<div class="form-group"> 
									
									<div class="col-sm-12">
									<p style="padding-top:15px;">You can always see your exam results on your My Courses page</p>
									</div>
								</div>

					<hr/>
					<div class="form-group"> 
						<div class="col-sm-12">
    					<span class="quiz_description"><?php echo $quizz->description;?></span> 
					<br>
					
					<?php
					if($remainAttempts > 0)
					{
						$getresult = $CIless->lessons_model->getStatusPass($quizz->id, $pro_id);
						$showresult = $this->lessons_model->getFinalExamResult($pro_id);
						$getresultPending = $CIless->lessons_model->getStatusPending($quizz->id, $pro_id);						
						  $getresultPending2 = $getresultPending ? $getresultPending->result :"xyz";
						  // echo"<pre>";
						  // print_r($getresultPending2)."<br/>";
						  // echo $showresult->show_result."<br/>";
						  // echo $showresult->id_final_exam."<br/>";
						  // echo $quizz->id."<br/>";
						if($showresult->show_result == 1 && $showresult->id_final_exam == $quizz->id && $getresultPending2 =='Pending')
						{
							echo '<font color=red>You have already Pending this exam Result...</font>';
						}
						else
						{	
							if(@$getresult->result)//when pass
							{
								echo '<font color=red>You have already passed this exam ...</font>';
							}else{
								if($showresult->show_result == 0 && $getresultPending2 =='Pending')
								{
								echo '<font color=red>You have already Pending this exam Result...</font>';
								}
								else
								{		
							?>
							<input type='button' class="btn btn-sm btn-success btn-update" onclick="start_exam('<?php echo $quizz->name;?>',<?php echo $quizid;?>,<?php echo $pro_id;?>,'<?php echo $layoutid;?>','1', <?php echo $webcamoption;?>);" value='Start Exam' name='btnStartexam' id='btnStartexam'>
			           		<?php
			           			}
			           		}
		           	 	}
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


      	<div class="bottom" id="bottom"><!--<a class="autoplay on" data-name="lectureAutoStart"> Auto Play <span class="autoplay-text-on">ON</span> <span class="autoplay-text-off none">OFF</span> </a>-->
        <?php			
			if($nexturl != NULL)
			{
				$url = explode('/',$nexturl);
				$pro_id = $url[5];
				$mod_id = $url[6];
				$nextlesson_id = $url[7];
				if($nextlesson_id)
				{				
				?>
				<div id='myNextLect'>
        		<span class="next-lecture" id="next-lecture" style="left: 132px;cursor:pointer" onclick='nextslide("<?php echo $pro_id;?>","<?php echo $mod_id;?>","<?php echo $nextlesson_id;?>","1")' >NEXT LECTURE</span>
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
		<!-- <a href="javascript:void(0)" class="mark mini-tooltip"> <span class="tooltip-content"> <b>Mark as Completed</b><b>Mark as Uncompleted</b> </span> </a> </div> -->
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
				 		<div id='mark_as_complete'>
				 		<input type="button" onclick ="markCompleted();" value="Mark as Incomplete" class="btn btn-default" style="float: right;margin-right: 10px;">
					 		<!-- <div style='background:#17aa1c' onclick ="markCompleted();" class="mark mini-tooltip">
					         	<span class="tooltip-content"><b>Mark as Incomplete</b></span>
					        </div> -->
						</div>
				        <?php
				 	}
				 	else
				 	{
						?>
						<div id='mark_as_complete'>
						<input type="button" onclick ="markCompleted();" value="Mark as Completed" class="btn btn-default" style="float: right;margin-right: 10px;">
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
					<input type="button" onclick ="markCompleted();"  value="Mark as Completed" class="btn btn-default" style="float: right;margin-right: 10px;">
					<!-- <div onclick ="markCompleted();" class="mark mini-tooltip">
			         	<span class="tooltip-content"><b>Mark as Completed</b></span>
			        </div> -->
			        </div>
				<?php
			}
		}//mine
       	?>        

        </div>
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

<div class="sidebar"> <a class="close-btn" href=""><!--<i class="icon-chevron-right">--></i></a>
  <div class="sidebar-container" style="<?php echo $displayDiv;?>">
    <div class="tab-label-container">
      <ul class="gray-nav">
		<li class="c" href="#tab-curriculum" id="list">
          <label for="tab3"><i class="icon-list"></i></label>
        </li>
        <li class="e" href="#extras" id="download">
          <label for="tab1"><i class="icon-download-alt"></i></label>
        </li>
        <li class="d ng-scope" href="#lecture-discussions" id="discussion">
          <label for="tab2" ><i class="icon-comments"></i></label>
        </li>        
        <li class="n" href="#notes" id="note">
          <label for="tab4"><i class="icon-file-text-alt"></i></label>
        </li>
      </ul>
    </div>
    <div class="tab-divs">
	  <div id="tab-curriculum" data-courseid="409734">
      <?php
$hover_id = 1;
$coursetype_details = $this->program_model->getCourseTypeDetails($program_id);
		 
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

	foreach ($days as $day)
	{
	?>
    <div id="coursesection">
		    <div class="title"><?php echo "Section ".++$i." : ".$day->title; ?></div>
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
					$diff_start = 1;	//hardcoded by yogesh , remove this and solve above issue for $diffstart variable
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
		    <li id='<?php echo $hover_id;?>' style="background-color :<?php echo $this->uri->segment(5) == $lesson->id ? '#A7C7E2' :'';?>">
		    <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>
		    <!-- <div class="cattext1" style="display: inline-block; width: 100%;" onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)"> -->
		    <div class="cattext1" style="display: inline-block; width: 100%;">
		    <?php  
			$lesson_viewed = $this->program_model->getViewLesson($lesson->id,$user_id);
			if(($user_id >0) && ($coursetype_details[0]["course_type"] != 0) && ($coursetype_details[0]["lessons_show"] == 1) && ($coursetype_details[0]["lesson_release"] >0) && $not_show === TRUE)
			{		
		        if($diff_start >0)
		        {						
					?>
		            <div class="less_lect_list">                
						<div class="lll_title">
							<a href="<?php echo base_url()."/lessons/lesson/".$program_id."/".$day->id."/".$lesson->id;?>" class='<?php //echo "fancybox fancybox.iframe";?>' >
							<?php echo "Lecture ". ++$j ;?> :
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
				        		echo "Exam ". ++$k ;
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
			        		if($lesson_viewed)
			        		{
			        ?>
			          
			        <div class="lllt_txt">
						<a onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
			  	    	
			        </div>
			        	<?php
			        		}
			        		else
			        		{
			        			 $prev_lesson_id = $lesson->id - 1;
			    				 $lesson_Prev_viewed = $this->program_model->getPreviousViewLesson($prev_lesson_id,$user_id);
			    				 if($lesson_Prev_viewed)
			    				 {
			        	?>
			        		<div class="lllt_txt">
								<a onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
					  	    	<!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
					        </div>
					      <?php
					      		}
					      		else
					      		{

					      ?>
					      	<div class="lllt_txt">
								<a onclick="nextslide(javascript:void(0))" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
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
						<a onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo $lesson->name;?></a> 
			  	    	<!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
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
		    } // end of foreach lessions 	
			?>



		    </ul>
		    </div>
	</div>    
    <?php
}//end of foreach days
}//end of if mine

//for final exam link o dated 19-05-2015
$getPro = $this->lessons_model->getProgramFinalExam($program_id);
if(isset($getPro->id_final_exam) && ($getPro->id_final_exam > 0)) //&& ($getPro->webcam_option == 1)
{
	?>
	<div id="coursesection">
	<!--<div class="title" onclick="nextslide(244,85,246,11)">Final Exam</div>-->
	<div class="title"><strong><a href="<?php echo base_url().'lessons/finalexamnew/'.$program_id.'/'.$getPro->id_final_exam.'/'.'';?>">Final Exam</a></strong></div>
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
        <section class="desc">
          <h3>Excersize Files</h3>        
        </section>
          <!--Webinar Start-->
      <?php
	//echo $this->Program_model->checkEnrolled($user_id,$pro_id);

	if(($this->Program_model->checkEnrolled($user_id,$program_id)) && !empty($exercise))	
	{
		?>
		
		<div class="rightsidebar" style="padding-left: 20px;">
        <?php 
		foreach($exercise as $exfileinfo)
		{			
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
			echo '<a target="_blank" style="color:#0C0C0C; text-align:left; padding:10px; display: block;" href="'.base_url()."public/uploads/$pathurl/".$exfileinfo->local.'"><i class="entypo-attach"></i>|'.$exfileinfo->name.'</a>';
		}
		?>
      </div>
   
      <?php 
	}
	else
	{
  ?>
  	   <p>There are no available downloads for this course.</p>

  
  <?php
	}
 ?>

 		 <hr/>

  	    <section class="desc">
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
			<div style="display:inline-block; width:100%; padding:0;"> <span style="float:left"><?php echo $webinar->title;?></span>
			<input type="submit" class="btn btn-orange" style="float:right;" value="Go" name="submit">
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
    ?>
      <!--Webinar End-->
     

        
        <!--<a onclick="loadPdf();">test pdf</a>
        <div id="pdfDiv" >sasa</div>-->
      </div>
      <div id="lecture-discussions" class="activity-container activities-container" >
        <form class="single-line-form" method="post" action="" name="create-question-form" id="create-question-form">
          <input type="hidden" value="1" name="isSubmitted">
          <span class="holder" id="show-desc"></span>
          <div class="form-item-title">
            <textarea placeholder="Start a new discussion" maxlength="240" name="query_title" data-page-name="enable-default-text" class="ud-form ud-question-input  ui-autocomplete-input" id="query_title" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
          </div>
          <!--<textarea placeholder="Type your full question about this lesson" maxlength="240" name="query_text" data-page-name="enable-default-text" class="ud-form ud-question-input  ui-autocomplete-input" id="query_text" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
				array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
				-->
          
          <div class="form-item-details w3c-default" style="display:none;">
            <textarea placeholder="Type Description" maxlength="240" name="query_text" data-page-name="enable-default-text" class="ud-form ud-question-input  ui-autocomplete-input" id="query_text" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
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
				     $lessonName = NULL;
					if($quizComment['lesson_id'])
					{
						$lessonName = $this->program_model->getLessonName($quizComment['lesson_id']);
					}
				?>
            <li>
            <div class="comment">
            <div class="comment-thumb"><a href="#">
			   <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44">
			</a></div>
            <div class="comment-content">
              <div class="comment-author" style="font-size: 13px; margin-bottom:10px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> posted a discussion <b><?php echo $lessonName;?></b>
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
                <span onclick="unlike(<?php echo $like_id; ?>,<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['user_id']; ?>,<?php echo $quizComment['pro_id']; ?>)">Liked(<?php echo $total_likes; ?>) </span>
                <?php
								}
								else
								{
									?>
                <span onclick="like(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['user_id']; ?>,<?php echo $quizComment['pro_id']; ?>)">Like(<?php echo $total_likes; ?>) </span>
                <?php
								}
								$countcomment = $this->program_model->getLessonAnswer2($quizComment['query_id']);
							foreach($countcomment as $countcom )
									{
									$ii = $countcom;

							?>
                </a> <a href="javascript:void(0);" id="comment<?php echo $quizComment['query_id']; ?>" onclick="show_div(<?php echo $quizComment['query_id']; ?>)" > <i class="entypo-comment"></i>Comment <span id="comment_count<?php echo $quizComment['query_id']; ?>">(<span id="countComment<?php echo $quizComment['query_id']; ?>"><?php echo $ii; ?></span>)</span> </a>
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
                      <div class="comment-thumb"><a href="#">
					  <!--<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44">-->
					  </a></div>
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
                      <input class="btn btn-success" type="button" onclick="add_comment(<?php echo $quizComment['query_id']; ?>,<?php echo $quizComment['pro_id']; ?>)" name="replyBtn<?php echo $quizComment['query_id']; ?>" id="replyBtn<?php echo $quizComment['query_id']; ?>" value="Reply"  />
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
</style>

    <div id="notes" class="ud-notetaking" data-courseid="409734">
      <form action="#" id="my_form" method="post" name="my_form">
        
        <textarea id="txt_notes"  placeholder="Write here to take notes..." style="height: 90px;"></textarea>

        <input type="button" class="btn btn-info"  value="Add Notes" onclick="addnotes();" style="position: absolute; top: 94px; z-index: 5; margin-left: 5px;" >
      </form>
      <div style="clear:both;">
        <div id="notes-mask">
		
          <ul id="notes-list" >
		  <?php
		$data =array( 'pid' => $this->uri->segment(3),
			'module_id' => $this->uri->segment(4),
			'lesson_id' => $this->uri->segment(5)			 
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
				<textarea id ="area<?php echo $result1->nid?>" onblur="showspan(<?php echo $result1->nid ?>);" style="width: 290px;margin: 0 0px 5px -5px;height: 100px; display :none" onkeydown ="updateNote(<?php echo $result1->nid ?>);" ><?php echo $result1->notes ?></textarea> 
				&nbsp;
				<button class="btn btn-danger delspan" id ="delspan<?php echo $result1->nid ?>" style='display:none' onclick ="delNotes(<?php echo $result1->nid ?>);" ><i class="entypo-trash"></i></button>
				</p> 
				<button class="btn btn-success" type="button"  value="Save" id ="btn<?php echo $result1->nid?>" onclick ="updateNote1(<?php echo $result1->nid ?>);" style="display :none"><i class="entypo-floppy"></i></button>
				
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
	
	<input id="proid" type="hidden" value="<?php echo $this->uri->segment(3);?>">
	<input id="modid" type="hidden" value="<?php echo $this->uri->segment(4);?>">
	<input id="lessid" type="hidden" value="<?php echo $this->uri->segment(5);?>">
  </div>
  <!-- --------------------------------------------------Sidebar-code-end----------------------------------------------------------------- --> 
</div>
</body>
</html>

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
			url:"<?php echo base_url(); ?>/programs/countComment",
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
		$('#tab-curriculum').css('display','none');
		$('#notes').css('display','none');
	});
</script>
<script>
$('#download').click(function() 
{
	$('#extras').css('display','block');
	$('#lecture-discussions').css('display','none');
	$('#tab-curriculum').css('display','none');
	$('#notes').css('display','none');
});
</script>
<script>
$('#list').click(function() {
	$('#tab-curriculum').css('display','block');
	$('#lecture-discussions').css('display','none');
	$('#notes').css('display','none');
	$('#extras').css('display','none');
});
</script>
<script>
$('#note').click(function() {
	$('#notes').css('display','block');
	$('#lecture-discussions').css('display','none');
	$('#tab-curriculum').css('display','none');
	$('#extras').css('display','none');
});
</script>
<script>
$('document').ready(function() {
	$('#notes').css('display','none');
	$('#lecture-discussions').css('display','none');
	$('#tab-curriculum').css('display','block');
	$('#extras').css('display','none');
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
		var url = "<?php echo base_url()?>/lessons/GetQueryList/"+qpid_val+"/"+qmid_val+"/"+qlid_val+"/"+qid_val;

		$.getJSON( url,function(listresult){
		var querylist = '';
		$.each(listresult, function(queryk, querydata){
		querylist += '<li class="queries_li" data-questionid="'+querydata.id+'">';
        querylist += '<a href="#">';
        querylist += '<span class="title">'+querydata.title+'</span>';
        querylist += '<span class="details">';
        querylist += '<span class="count"><b>'+querydata.num_answers+'</b> Answer(s)</span>';
        querylist += '<span class="count" title="This question is asked in Lecture 14">Lecture 14 </span>';
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
	//{"__class":"question","id":"1","title":null,"body":null,"courseId":null,"lectureId":null,"user":"userinfo_array","created":null,"isCreatedByInstructor":null,"createdRelative":null,"isRequesterTheOwner":null}

		//var classname = result.__class;
		//var quseryid = result.id;
		var header="";
		var completequery = "";
		var completeansres = "";
		var url = "<?php echo base_url()?>/lessons/query_responseheader/"+dataquestionid+"/list";

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

		var ansurl = "<?php echo base_url()?>/lessons/answer_responses/"+dataquestionid;
		$.getJSON( ansurl,function(ansresult){
		$.each(ansresult.data, function(ansk, ansval){
		completeansres += '<li data-answerid="'+ansval.id+'"  class="vote ">';
		completeansres+= '<div class="vote">';
		completeansres+= '<span title="There are 0 votes">0</span>';
		completeansres+= '</div>';
		/*completeansres += '<div class="vote">';
		completeansres += '<div class="btns none">';
		completeansres += '<a data-answerid="'+ansval.id+'" href="#" class="up"></a>';
		completeansres += '<a data-answerid="'+ansval.id+'" href="#" class="down"></a>';
		completeansres += '</div>';
		completeansres += '<span title="There are 0 votes">0</span>';
		completeansres += '</div>';*/
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
		url: "<?php echo base_url()?>/lessons/query_responseheader/"+query_id+"/delete",
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

/* ***********<start save query ans code */
/*	$("#addansfrm").live('click',function(){
		var ans_text = $('textarea#ans_text').val();
        // alert(ans_text);
		var query_id = $('#query-response-container h2.ud-inplaceeditor').attr("data-objectid");
        // alert(query_id12);
	   	//if( ans_text =='' || query_id =='' ){
		//return false;
        //	}
        document.getElementById("lqid").value = query_id;
		var qval = $('#lqid').val();
        //alert(qval);
		var qpid_val = $('#laprogid').val();
		var qmid_val = $('#lamodid').val();
		var qlid_val = $('#lalessid').val();
		$.ajax({
		type: "POST",
	    url: "<?php echo base_url()?>/lessons/saveanswer/",
	    data: {anstext: ans_text, queryid: query_id, qpid: qpid_val, qmid:qmid_val, qlid: qlid_val}
		}).success(function( data ) {
		if(data=='error'){
		alert('Teir was error while processing, try again!');
		}else{
        document.getElementById("ansid").value = data;
        var ansurl = "<?php echo base_url()?>/lessons/GetAnswer/"+qval+"/"+data+"/list";

        $.getJSON( ansurl,function(ansresult){
	    $.each(ansresult.data, function(ansk, ansval){

            var litoappend = "";
        	litoappend += '<li data-answerid="'+ansval.id+'" id="'+ansval.id+'" class="vote">';
            litoappend+= '<div class="vote">';
            litoappend+= '<span title="There are 0 votes">0</span>';
            litoappend+= '</div>';
        	litoappend += '<div class="top">';
        	litoappend += '<span style="background-image: url('+ansval.user.images.img_50x50+')" class="thumb"></span>';
        	litoappend += '<a href="https://www.udemy.com/u/amitpatil2/" class="user">'+ansval.user.title+'</a>';
              //alert(litoappend);
        	//if(ansval.isRequesterTheOwner == true){
        	litoappend += '<a href="javascript:void(0)" class="delete-answer-btn js-delete-answer" id="delete-answer-btn_'+ansval.id+'">';
        	//litoappend += '<i class="icon-trash"></i>';
            //litoappend += 'Delete';
        	litoappend += '</a>';
        	//}

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
 	});
});*/

function answerlist(query_id)
{
    var ansurl = "<?php echo base_url()?>/lessons/GetAnswer/"+query_id;
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
	function nextslide(pro_id,mod_id,lesson_id,srno)
	{	
		//alert(lesson_id);
		if(lesson_id == '')//added on 14-09-2015 by yo
		{
			$(".ud-lectureangular").html('No Lecture found');			
		}else
		{
			$("#proid").val(pro_id);
			$("#modid").val(mod_id);
			$("#lessid").val(lesson_id);
					
			$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>/lessons/ajaxlesson/",
			data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id},
			beforeSend : function( data ) { $(".asset-container").html('<div id="overlay"><img src="<?php echo base_url("public/images/loading.gif"); ?>" /></div>');}
			}).success(function(data) 
			{		
				//alert(data);		
				if(data=='error')
				{
					alert('There was error while processing, try again!');
				}
				else
				{        
				    //var dt = '<div class="show-progress"><div class="progress-top" style="position: relative; height: 100%;"> <span class="percent completion-ratio">0%</span><div class="note"> <span>You have completed <b class="completion-ratio">0%</b> of this course</span> </div></div><div class="feedback-form" style="height: 0%;"> </div></div><';
					//$(".asset-container").html(dt);					
					my_nexturllist(pro_id,mod_id,lesson_id, srno);				
	                my_previousurllist(pro_id,mod_id,lesson_id, srno);	
	                getMarkCompleted(pro_id,mod_id,lesson_id);	
					//$(".ud-lectureangular").html(data); asset-container
					var iauto =1;
					if(iauto==1)
					{
					$(".asset-container").html(data);
					iauto++;
				    }

					highlight(srno);
					lecctureTitle(pro_id,mod_id,lesson_id);	
///////////////
					var slider = $('.bxslider1').bxSlider({                 
                  auto: true,
                  //autoControls: true
                });
					//alert('yes');
			 //slider.reloadSlider();	
			 ////////////		    
				}
			});	
			
			getLessionNotes(pro_id,mod_id,lesson_id);
			getlessionDiscussion(pro_id,mod_id,lesson_id);
			setViewLesson(pro_id,mod_id,lesson_id);	


		}
	}

	function my_nexturllist(pro_id,mod_id,lesson_id, srno)
	{
		$.ajax({
		type: "POST",
		url: "<?php echo base_url()?>/lessons/my_getnexturl/",
		data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id, 'srno':srno}
		}).success(function(data) 
		{		
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
		url: "<?php echo base_url()?>/lessons/my_getpreurl/",
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
		url: "<?php echo base_url()?>/lessons/getnexturl/",
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
		url: "<?php echo base_url()?>/lessons/getpreurl/",
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
			{	//alert(response);
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

<script>
	function loadPdf()
	{
		alert('yes');
		//$("#pdfDiv").load("http://www.create-online-academy.com/public/uploads/documents/After creating instructor.doc");
		//$("#pdfDiv").html("<object data='http://www.create-online-academy.com/public/uploads/documents/phocapdf-demo.pdf' type='application/pdf' width='100%'' height='200px'>alt : <a href='http://www.create-online-academy.com/public/uploads/documents/phocapdf-demo.pdf'>page2.pdf</a></object>");
		
		$("#pdfDiv").html("<object data='http://www.create-online-academy.com/public/uploads/documents/After creating instructor.doc' type='application/vnd.oasis.opendocument.text' width='100%'' height='200px'></object>");
		//$("#pdfDiv").html("<iframe src='http://www.create-online-academy.com/public/uploads/documents/123d.txt'>myDocument</iframe>");

	}
</script>
<script>
function setViewLesson(pro_id,mod_id,lesson_id)
{
	//alert(pro_id);
$.ajax({
		type:"post",
		url:"<?php echo base_url();?>lessons/setViewLesson",
		data:{pro_id:pro_id,mod_id:mod_id,lesson_id:lesson_id},
		success:function(data)
		{
			//alert(data);
			if(data == "success")
			{
			$("#maskDiv"+lesson_id).html("<span class='ci-progress-mask green'></span>");
			}
		}
	});	
}

function start_exam(qname, media_id, proid, layoutid, indexy, webcamoption)//start new exam first time
{ 
	//alert(layoutid);alert(webcamoption);alert(qname);
	if(webcamoption == '1')
	{
		if(document.getElementById('video').getAttribute('src') == null)
		{
			alert('Webcam is mandatory');
			return false;
		}
	}

	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>lessons/startexam",
		data:{media_id:media_id,proid:proid,layoutid:layoutid,indexy:indexy,qname:qname},
		success:function(data)
		{
			$("#my_middle_content").html(data);			
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
		    time_spent = parseInt(mytime) + parseInt(1);
		    doSomething("Switched Window", time_spent);
		    //_this.d = new Date();
		  }
		}), 1000);		

		// Calculates Time Spent on page upon leaving/closing page
		window.onunload = function() {
		  var mytime = $('#txtTotalLeave').val();
		  time_spent = parseInt(mytime) + parseInt(1);
		  doSomething("Left Page", time_spent);
		};

		// Calculates Time Spent on page upon unfocusing tab
		// http://davidwalsh.name/page-visibility
		document.addEventListener(visibilityChange, (function(e) {
		  if (document[state] === 'visible') 
		  {
		  } else if (document[hidden]) {
		    var mytime = $('#txtTotalLeave').val();
		    time_spent = parseInt(mytime) + parseInt(1);
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
	var str = document.getElementById('txtMulti').value;
	var str2 =  value1+'^'+question_id+',';
	document.getElementById('txtMulti').value = str2;
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
	   var seconds = <?php echo $quizz->limit_time;?>*60;
	}else{
	     //seconds = cook;
	     //console.log(cook);
	     var seconds = <?php echo $quizz->limit_time;?>*60;
	     //var seconds = 60;
	}

	function secondPassed() 
	{
		if(document.getElementById('countdown'))
	    {
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


$('body').bind('copy paste',function(e) {
    e.preventDefault(); return false; 
});
//below javascript is used for Disabling right-click on HTML page

//document.oncontextmenu=new Function("return false");//Disabling right-click
 
 
//below javascript is used for Disabling text selection in web page
document.onselectstart=new Function ("return false"); //Disabling text selection in web page
if (window.sidebar){
document.onmousedown=new Function("return true"); 
document.onclick=new Function("return true") ; 
 
 
//Disable Cut into HTML form using Javascript 
document.oncut=new Function("return false"); 
 
 
//Disable Copy into HTML form using Javascript 
document.oncopy=new Function("return false"); 
 
 
//Disable Paste into HTML form using Javascript  
document.onpaste=new Function("return false"); 
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
			url: "<?php echo base_url()?>/lessons/lecctureTitle",
			data: {'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id}, 
			success: function(data)
			{
					$("#Course_Name").html("<p>"+data+"</p>");
				//alert(data);
			}
		  });
}
</script>

<!--
<div>
      		<table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody><tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr>
								</tbody></table>
      	<div>
-->
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
					confirmButton: 'Take Exam',
	    			cancelButton: 'Go Back to Courses',
	    			title: 'Congratulations! You Have Completed your lecture!<br>',
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
	    						title: 'Congratulations! You Have Completed your lecture!<br>',
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
       var pid=	data.pid;
       var sid=	data.sid;
       var courseid=data.courseid;
       var btntxt=data.btntxt;
       var btntxt2 = btntxt.replace(/_/g, " ");

		$.alert({
			    confirmButton: 'Ok',							   	    						
			    title: btntxt2,
				content: ' ',    						 
			    confirm: function(){
			        window.location.href = "<?php echo base_url(); ?>lessons/lesson/"+pid+"/"+sid+"/"+courseid;
			    }
			});	
		
	}
</script>

<script src="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.css" rel="stylesheet" />

<script type="text/javascript">
//   jQuery.browser = {};
// (function () {
//     jQuery.browser.msie = false;
//     jQuery.browser.version = 0;
//     if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
//         jQuery.browser.msie = true;
//         jQuery.browser.version = RegExp.$1;
//     }
// })();
// var $j =jQuery.noConflict();
 $(document).ready(function()
               {
               //	alert('yes1');
                 $('.bxslider1').bxSlider({                 
                  auto: true,
                  //autoControls: true
                });
                 
               });
</script>
<script type="text/javascript">
	$("#theme_color").click(function(){
		alert('yes');
	})
</script>