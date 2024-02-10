<?php
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

			if($coursetype_details[0]["course_type"] == 1){
				if($coursetype_details[0]["lesson_release"] == 1){
					$diff_start = $dif_days+1;
					$diff_date = $dif_days+1;

				}
				elseif($coursetype_details[0]["lesson_release"] == 2){
					//$dif_days_enrolled = $dif_days_enrolled /7;
					$diff_start = $dif_week+1;
					$diff_date = $dif_week+1;
				}
				elseif($coursetype_details[0]["lesson_release"] == 3){
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
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-core.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/modal.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-more.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/default/js/jquery-1.7.1.min.js"></script>
<!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/default/css/style.css" />-->
<link rel="stylesheet" href="<?php echo base_url();?>public/default/css/lecture_dashboard.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/default/css/my_lecture_style.css">
<?php	
		$quizzid =  null;
		$isfinal = 0;
		//echo $db_mediatext[10]."<br>";
		//echo $db_media[13]."<br>";
		//echo $db_media[9];
        //print_r($db_media[9]->media_id);
        //print_r($db_mediatext[10]);
		 if(isset($db_media[14]->media_id)){
		 $quizzid = $db_media[14]->media_id;
		 }elseif(isset($final_exam_id)){
		 $quizzid = $final_exam_id;
		 }
		if((isset($quizzid)) and ($quizzid != null)){
		$quizz = $this->quizzes_model->getItems($quizzid);
		$isfinal = (empty($quizz)) ? 0 : $quizz->is_final;
		}?>
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

    function get_quiz_result_continued(saved_quiz_id){
	//alert(saved_quiz_id);
		var quize_id = document.getElementById("quize_id").value;
		var how_many_right_answers = 0;

		var is_final = <?php echo $isfinal;?>;

		var course_certificate_term = <?php echo $programdetail[0]['certificate_term']; ?>;
		var number_of_questions = document.getElementById("question_number").value;
		var quize_name = document.getElementById("quize_name").value;
		var quize_max_score = document.getElementById("quiz_max_score").value;
		var time_quiz_taken = document.getElementById("time_quiz_taken_user").value;
		var questions_ids_random = document.getElementById("list_questions_id").value;
		var quiz_result_header = '<span class="quiz_title">Quiz Results:</span>';
		var quiz_result_content = '';
		var question_id1 = "0";
		for(i=1; i <= number_of_questions; i++){
			var the_answer = document.getElementById("question_answergived"+i).value;//selected answer
			var the_answer_array = new Array();
			the_answer_array = the_answer.split("|||");//selected answers

			var the_right_answer = document.getElementById("question_answerright"+i).value;//the correct answer
			var the_right_array = new Array();
			the_right_answer_array = the_right_answer.split("|||");//selected answers

			var ansgivedbyuser = document.getElementById("question_answergivedbyuser"+i).value;
			ansgivedbyuser = ansgivedbyuser.split("||").join("-");
			//alert(ansgivedbyuser);

			var the_question = document.getElementById("the_question"+i).value;//question name

			var all_answers = document.getElementById("all_answers"+i).value;//all question answers
			var all_answers_array = new Array();
			all_answers_array = all_answers.split("|||");//selected answers
			//parse all responses answers in all correct answers and if it is ok, parse all correct answers and make comparation with responses answers(maybe someone doesn't response to one response option)
			var correct_answer = true;
			var answer_count = 0;
			var right_answer_count = 0;

			for(t=0; t < the_answer_array.length; t++){
				if(the_answer_array[t] != ""){
					if(!elementInArray(the_answer_array[t], the_right_answer_array)){
						gasit = false;
						break;
					}
					else{
						gasit = true;
						answer_count++;
					}
				}
			}

			quiz_result_content += '<ul class="result_list">';
			if(the_right_answer_array.length == answer_count){
				how_many_right_answers = how_many_right_answers +1;
				quiz_result_content += '<li class="right">'+i+'. '+the_question+'</li>';
			}
			else{
				quiz_result_content += '<li class="wrong">'+i+'. '+the_question+'</li>';
			}

			for(j=0; j < all_answers_array.length; j++){
				//--------------------------------------------
				inArray = false;
				for(k=0; k < the_right_answer_array .length; k++){
				if(all_answers_array[j] == the_right_answer_array [k]){
				inArray = true;
				}
				}
				//--------------------------------------------

				if(inArray){
				quiz_result_content += '<li class="correct">'+all_answers_array[j]+'</li>';
				}
				else{
				quiz_result_content += '<li class="incorrect">'+all_answers_array[j]+'</li>';
				}
			}
			quiz_result_content += '</ul>';

			var question_id = i;
			question_id1 = question_id1 +","+i ;
			saveInDBase(saved_quiz_id, ansgivedbyuser, question_id, quize_id, time_quiz_taken,questions_ids_random);
		}

	    if(time_quiz_taken >=0){
				if(parseInt((how_many_right_answers/number_of_questions)*100) >= parseInt(quize_max_score)){
						var score = parseInt((how_many_right_answers/number_of_questions)*100)+'%';
						if(is_final == 1&& course_certificate_term == 3){
							quiz_result_header += '<div style="border: 1px solid #FFCC00; background-color:#8AC007; padding:10px;">';

							quiz_result_header += '<span style="font-size:16px;color:CC0000">Congratulations for passing the final exam! You are now eligible for a certificate for this course.Go to <a href=\'index.php?option=com_guru&amp;view=guruorders&amp;layout=mycertificates\'>My Certificates</a> to view, share and download your certificate.</span><br/>';
							 quiz_result_header +=' </div>';
						}
						quiz_result_header += '<span class="quiz_score">Your Score: '+score+'<span style="color:#292522;">(Passed!)</span>'+'</span>';
						quiz_result_header +='<div class ="guru-quiz-timer">';
						quiz_result_header +='<span>Quiz Passed!. Your score:'+ '<span style="color:#42943F;">'+parseInt((how_many_right_answers/number_of_questions)*100)+'%'+'</span>'+','+" "+'Minimum score to pass is:'+" "+'<span style="color:#42943F;">'+parseInt(quize_max_score)+'%'+'</span></span>';
						quiz_result_header +='<br/>'+'<span style="color:#fff">Congratulations!</span>';
						quiz_result_header +='<br/></br>'+'<span style="color:#fff">Please Check Your My Certificates Section After Clicking On Home</span>';
						quiz_result_header +='</div>';
                         //alert(quiz_result_header);
			  }
			  else{
						var score = parseInt((how_many_right_answers/number_of_questions)*100)+'%';
                        //alert(score);
						quiz_result_header += '<span class="quiz_score">Your Score: '+score+'<span style="color:#292522;">(Failed)</span>'+'</span>';
						quiz_result_header +='<div class ="guru-quiz-timer">';
						quiz_result_header +='<span>Quiz Failed. Your score:'+ '<span style="color:#42943F;">'+parseInt((how_many_right_answers/number_of_questions)*100)+'%'+'</span>'+','+" "+'Minimum score to pass is:'+" "+'<span style="color:#42943F;">'+parseInt(quize_max_score)+'%'+'</span></span>';

                         //alert(time_quiz_taken);
                         //var time_quiz_taken_user= document.getElementById("time_quiz_taken_user").value;
                         //alert(time_quiz_taken_user);
						if(time_quiz_taken < 11){
							quiz_result_header +='<br/>'+'<span>You have'+'<span style="color:#42943F;">'+" "+(time_quiz_taken-1)+" "+'</span>'+'more times to take this quiz'+'</span>';
						}
						if(time_quiz_taken >=1){
							quiz_result_header +='<br/></br>'+'<span>Would you like to take it again now?</span>';
							quiz_result_header +='<br/><br/>'+'<input type="button" class="guru-yes-no-quiz-button"  onClick="window.location.reload()" name="yesbutton" value="Yes"/>'+'&nbsp; &nbsp;';
							var nextbut = document.getElementById("nextbut");
							quiz_result_header += '<input type="button"  class="guru-yes-no-quiz-button"  onClick="nextbut.click();" name="nobutton" value="Later"/>';

                        // quiz_result_header += '<a onclick="window.location.reload();">link</a>';



						}
						quiz_result_header += '</div>';

			}
		}
		//quize_result = quiz_result_header + quiz_result_content;
		quize_result = quiz_result_header;
       //  alert(quize_result);
		document.getElementById("media_15").innerHTML = quize_result;
		saveInDbaseHowManyRightAns(quize_id,how_many_right_answers,number_of_questions,question_id1, saved_quiz_id);
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

<div id="course-taking-page" class="ud-dashboard wrapper">
<div class="main"> <a id="go-back" href="<?php echo base_url(); ?>programs/lectures/<?php echo $pro_id; ?>" class="pos-r zi1 ml15 mt15 dif text-topaz fs12 bold ml0-md"> <i class="icon-chevron-sign-left fs16 mr5"></i> <span class="fs10-md w130 ellipsis-2lines">Back to Course</span> </a>
  <ul id="timeline" style="transform: translateY(-100%);">
    <li class="chapter"> <span class="percent chapter-number"> <span>Section</span> 1 </span>
      <div class="note"> </div>
      <div class="bottom"> <a href="" class="next-lecture continue">Continue</a> </div>
    </li>
    <li class="on" data-lectureid="2335868">
		<div class="prev-lecture" id="prev-lecture">
	        <?php 
			if($prevurl != NULL)
			{
				$url = explode('/',$prevurl);
				$pro_id = $url[5];
				$mod_id = $url[6];
				$prelesson_id = $url[7];				
				?>
				<a href="javascript:void(0)"><i class="icon-chevron-up"></i></a><span style="cursor:pointer" onclick="nextslide(<?php echo $pro_id;?>,<?php echo $mod_id;?>,<?php echo $prelesson_id;?>)">Previous Lecture</span>
				<?php 
			}
			?>
		</div>
		<span class="view-supplementary fs10-force-md mt0-force-md dn-force-xs dn-md none"> View resources </span>
		<div class="asset-container">
		
        <?php 
		if($layoutid=='1')
		{
			?>
			<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
			<div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
			<div id="media_1"> 
            <script type="text/javascript">
						jQuery('#media_1').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[0]->media_id;?>/1");
					</script> 
			</div>
			<div id="text_1" class="content11"> 
            <script type="text/javascript">
					jQuery('#text_1').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[0]->media_id;?>/1");
					</script> 
          </div>
        </div>
        <?php
		}
		elseif($layoutid=='2')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
			<div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		  <div id="media_2">
            <?php //ajaxmediaview($db_mediatext[1]->media_id,2);?>
            <script type="text/javascript">
							jQuery('#media_2').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[1]->media_id;?>/2");
					</script> 
          </div>
          <div id="text_2" class="content11">
            <?php //ajaxmediaview($db_mediatext[0]->media_id,1);?>
            <script type="text/javascript">
					jQuery('#text_2').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[0]->media_id;?>/1");
					</script> 
          </div>
          <div id="media_3">
            <div style="text-align:center"><i></i></div>
            <?php //ajaxmediaview($db_media[1]->media_id,1); ?>
            <script type="text/javascript">
						jQuery('#media_3').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[2]->media_id;?>/1");
					</script> 
          </div>
        </div>
        <?php 
		}
		elseif($layoutid=='3') 
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
          <div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		  <div id="media_3">
            <div style="text-align:center"><i></i></div>
            <?php //ajaxmediaview($db_media[1]->media_id,1); ?>
            <script type="text/javascript">
					jQuery('#media_3').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[0]->media_id;?>/1");
					</script> 
          </div>
          <div id="text_3" class="content11">
            <?php //ajaxmediaview($db_mediatext[2]->media_id,3); ?>
            <script type="text/javascript">
						jQuery('#text_3').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[2]->media_id;?>/3");
					</script> 
          </div>
        </div>
        <?php 
		}
		elseif($layoutid=='4')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
          <div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		  <div id="media_5">
            <?php //ajaxmediaview($db_media[4]->media_id,5); ?>
            <script type="text/javascript">
						jQuery('#media_5').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[4]->media_id;?>/5");
					</script> 
          </div>
          <div id="media_6">
            <?php //ajaxmediaview($db_media[5]->media_id,6); ?>
            <script type="text/javascript">
						jQuery('#media_6').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[5]->media_id;?>/6");
					</script> 
          </div>
          <div id="text_4" class="content11">
            <?php //ajaxmediaview($db_mediatext[3]->media_id,4); ?>
            <script type="text/javascript">
					jQuery('#text_4').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[3]->media_id;?>/4");
					</script> 
          </div>
        </div>
        <?php 
		}
		elseif($layoutid=='5')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
			<div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		 <div id="text_5" class="content11">
            <?php //ajaxmediaview($db_mediatext[4]->media_id,5); ?>
            <script type="text/javascript">
					jQuery('#text_5').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[4]->media_id;?>/5");
					</script> 
          </div>
        </div>
        <?php 
		} 
		elseif($layoutid=='6')
		{
			?>
			<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
				<div id="overlay">
					<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />					
				</div>
				
				<div id="media_7">
				<?php //ajaxmediaview($db_media[6]->media_id,7); ?>
					<script type="text/javascript">
						jQuery('#media_7').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[6]->media_id;?>/7");
					</script> 
				</div>
			</div>
			<?php 
		}
		elseif($layoutid=='7')
		{ 
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
          <div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		  <div id="text_6" class="content11">
            <?php //ajaxmediaview($db_mediatext[5]->media_id,6); ?>
            <script type="text/javascript">
					jQuery('#text_6').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[5]->media_id;?>/6");
					</script> 
          </div>
          <div id="media_8">
            <?php //ajaxmediaview($db_media[7]->media_id,1); ?>
            <script type="text/javascript">
				    jQuery('#media_8').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[7]->media_id;?>/1");
				    </script> 
          </div>
        </div>
        <?php 
		} 
		elseif($layoutid=='8')
		{ 
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
			<div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		  <div id="text_7" class="content11">
            <?php //ajaxmediaview($db_mediatext[6]->media_id,7); ?>
            <script type="text/javascript">
					jQuery('#text_7').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[6]->media_id;?>/7");
					</script> 
          </div>
          <div id="media_8">
            <?php //ajaxmediaview($db_media[7]->media_id,8); ?>
            <script type="text/javascript">
				    jQuery('#media_8').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[7]->media_id;?>/8");
				    </script> 
          </div>
          <div id="media_9">
            <?php //echo $db_media[9]->media_id; exit('fgh'); //ajaxmediaview($db_media[8]->media_id,9); ?>
            <script type="text/javascript">
				    jQuery('#media_9').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[9]->media_id;?>/9");
				    </script> 
          </div>
        </div>
        <?php 
		} 
		elseif($layoutid=='9')
		{ 
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
          
		  <div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		  <div id="text_8" class="content11">
            <?php //ajaxmediaview($db_mediatext[7]->media_id,8); ?>
            <script type="text/javascript">
					jQuery('#text_8').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[7]->media_id;?>/8");
					</script> 
          </div>
          <div id="media_11">
            <?php //ajaxmediaview($db_media[10]->media_id,11); ?>
            <script type="text/javascript">
				    jQuery('#media_11').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[10]->media_id;?>/11");
					</script> 
          </div>
        </div>
        <?php 
		}
		elseif($layoutid=='10')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
			<div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
		 
		 <div id="text_9" class="content11">
            <?php //ajaxmediaview($db_mediatext[8]->media_id,9); ?>
            <script type="text/javascript">
					jQuery('#text_9').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[8]->media_id;?>/9");
					</script> 
          </div>
          <div id="media_12">
            <?php //ajaxmediaview($db_media[11]->media_id,12);                                              ?>
            <script type="text/javascript">
					jQuery('#media_12').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[11]->media_id;?>/12");
					</script> 
          </div>
          <div id="media_13">
            <?php //ajaxmediaview($db_media[11]->media_id,12);                                              ?>
            <script type="text/javascript">
					jQuery('#media_13').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[12]->media_id;?>/13");
					</script> 
          </div>
        </div>
        <?php 
		} 
		elseif($layoutid=='11')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
			<div id="overlay">
				<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
					
			</div>
          <div id="text_10" class="content11">
            <?php //ajaxmediaview($db_media[9]->media_id,10); ?>
            <script type="text/javascript">
					jQuery('#text_10').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[9]->media_id;?>/10");
					</script>
            <?php
                    //ajaxmediaview($db_mediatext[9]->media_id,10); ?>
          </div>
          <div id="media_14">
            <div style="text-align:center"><i></i></div>
            <script type="text/javascript">
					jQuery('#media_14').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_media[13]->media_id;?>/14");
					</script>
            <?php //ajaxmediaview($db_media[13]->media_id,14)?>
          </div>
          <div id="text_11" class="content11"> 
            <script type="text/javascript">
					jQuery('#text_11').load("<?php echo base_url();?>lessons/ajaxmediaview/<?php echo $db_mediatext[10]->media_id;?>/11");
					</script>
            <?php //ajaxmediaview($db_mediatext[10]->media_id,11)?>
          </div>
        </div>
        <?php 
		} 
		elseif($layoutid=='12')
		{
			?>
       		<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
		      	<div id="overlay">
					<img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />
				</div>
	          	<div id="media_15">
	          		<div class='my_main'>
	          		<div id='my_middle_content'>
	           		<?php                                           
	                //ajaxquizztotask($db_media[14]->media_id,15,'',$pro_id);
	                //ajaxQuestionsDisplay($db_media[14]->media_id,15,'',$pro_id);//my new function on date 13-05-2015	                    
	                $CIq =& get_instance();
	                $quizz = $CIq->quizzes_model->getItems($db_media[14]->media_id);

	                $CIless =& get_instance();//on dated 15-05-2015
	                $settings = $CIless->lessons_model->getQuestionIds($db_media[14]->media_id);		
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
						<table>
						<tbody>
						<tr>
							<td colspan="2">Quiz Name :- <span style="color:#42943F"><?php echo $quizz->name;?></span>
							</td>
						</tr>
						<tr>
							<td>
								<?php if($quizz->show_limit_time == '0'){?>Quiz time limit: <span style="color:#42943F"><?php echo $quizz->limit_time;?></span> minutes
								<?php }?>	
							</td>
							<td style="padding-left:25px;">
								<?php if($quizz->pbl_max_score == '0'){?>Minimum score to pass this quiz: <span style="color:#42943F"><?php echo $quizz->max_score;?>%</span>
				         		<?php }?>
				        	</td>
						</tr>
						<tr>
							<td>Questions: <span style="color:#42943F"><?php echo $totalquestions;?></span></td>
							<td style="padding-left:25px;"><?php if($quizz->show_nb_quiz_taken == '0'){?>This quiz can be taken up to: <span style="color:#42943F"><?php echo $quizz->time_quiz_taken;?></span> times<?php }?></td>
						</tr>
						</tbody>
						</table>
						
						<table>
						<tbody>
						<?php if(($quizz->time_quiz_taken > 1) && isset($remainingExamTimes)){
				        //echo $remainingExamTimes;
				        ?>
						<tr>
							<td style="padding-top:15px;">You can give exam <?php echo $remainingExamTimes;?> more times</td>
						</tr>
							<?php }?>
						<tr>
							<td style="padding-top:15px;">You can always see your quiz results on your My Courses page</td>
						</tr>
						</tbody>
						</table>
					</div>					
					<hr/>
    				
					<span class="quiz_description"><?php echo $quizz->description;?></span>
					<br><br>
					<input type='button' class="btn btn-sm btn-success btn-update" onclick="start_exam('<?php echo $quizz->name;?>',<?php echo $db_media[14]->media_id;?>,<?php echo $pro_id;?>,'1');" value='Start Exam' name='btnStartexam' id='btnStartexam'>
	           		<?php //ajaxquizztotask($db_media[14]->media_id,15)?>
	          	</div>
	          	</div>
				</div>
        	</div>
        	<?php 
		} 
		elseif($layoutid=='finalexam')
		{
			?>
        <div class="ud-lectureangular" style="color:#fff;overflow: auto;"> <!--<img src="http://216.185.43.221/prshah8333/public/uploads/programs/img/big_courseimg.jpg">-->
          <div id="finalexam">
            <?php ajaxquizztotask($finalexamid,16,$programdetail[0],$pro_id) ;?>
            <?php
				$enablewebcam = true;
				if($enablewebcam && $webcamoption==1 )
				{
					?>
            <div id='webid2'> 
              <script type="text/javascript">
						var streaming = false,
							video        = document.querySelector('#video'),
							canvas       = document.querySelector('#canvas'),
							photo        = document.querySelector('#photo'),
							startbutton  = document.querySelector('#startbutton'),
							width = 320,
							height = 0;

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
							if (navigator.mozGetUserMedia) {
							video.mozSrcObject = stream;
							} else {
							var vendorURL = window.URL || window.webkitURL;
							video.src = vendorURL.createObjectURL(stream);
							}
							video.play();
						},
						function(err) 
						{
							console.log("An error occured! " + err);
						}
						);

						video.addEventListener('canplay', function(ev){
						if (!streaming) 
						{
							height = video.videoHeight / (video.videoWidth/width);
							video.setAttribute('width', width);
							video.setAttribute('height', height);
							//canvas.setAttribute('width', width);
							//canvas.setAttribute('height', height);
							streaming = true;
						}
						}, false);

						function takepicture() 
						{
							//canvas.width = width;
							//canvas.height = height;
							canvas.getContext('2d').drawImage(video, 0, 0,294,240);
							var data = canvas.toDataURL('image/png');
							if(data != '')
							{
								photo.setAttribute('src', data);
								getdetails(data);
							}
						}

						startbutton.addEventListener('click', function(ev)
						{
							takepicture();
							ev.preventDefault();
						}, false);
					var abc=setInterval(autoclick,10000);
					function autoclick()
					{
						startbutton.click();
					}

					function stopTimer()
					{
						window.clearInterval(abc);
					}
					function stopTimer1()
					{
						window.clearInterval(abc);
					}
					</script> 
            </div>
            <?php 
				}
				?>
          </div>
        </div>
        <?php
		}
		elseif($layoutid=='certificate')
		{
		}
		?>
      	</div>
      	<div class="bottom" id="bottom"><a class="autoplay on" data-name="lectureAutoStart"> Auto Play <span class="autoplay-text-on">ON</span> <span class="autoplay-text-off none">OFF</span> </a>
        <?php			
			if($nexturl != NULL)
			{
				$url = explode('/',$nexturl);
				$pro_id = $url[5];
				$mod_id = $url[6];
				$nextlesson_id = $url[7];				
				?>
				<div id='myNextLect'>
        		<span class="next-lecture" id="next-lecture" style="left: 132px;cursor:pointer" onclick="nextslide(<?php echo $pro_id;?>,<?php echo $mod_id;?>,<?php echo $nextlesson_id;?>,1)" >NEXT LECTURE</span>
        		</div>
        		<?php 
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
					 		<div style='background:#17aa1c' onclick ="markCompleted();" class="mark mini-tooltip">
					         	<span class="tooltip-content"><b>Mark as Uncompleted</b></span>
					        </div>
						</div>
				        <?php
				 	}
				 	else
				 	{
						?>
						<div id='mark_as_complete'>
							<div onclick ="markCompleted();" class="mark mini-tooltip">
					         	<span class="tooltip-content"><b>Mark as Completed</b></span>
					        </div>
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
					<div onclick ="markCompleted();" class="mark mini-tooltip">
			         	<span class="tooltip-content"><b>Mark as Completed</b></span>
			        </div>
			        </div>
				<?php
			}
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
<div class="sidebar"> <a class="close-btn" href=""><!--<i class="icon-chevron-right">--></i></a>
  <div class="sidebar-container">
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
foreach ($days as $day)
{ 
?>
    <div id="coursesection">
    <div class="title"><?php echo "Section ".++$i." : ".$day->title; ?></div>
    <div id="coursesectionlecture">
    <?php
		$lessons = $this->program_model->getLessons($day->id);
		$total_lesson += count($lessons);
		$dayaccess = $day->access;
    ?>
    <ul class="course_cat1">
    <?php
	$j=0;	
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
    <li id='<?php echo $hover_id;?>'>
    <div class="catimg" style="display:none;"><img src="<?php echo base_url(); ?>public/default/images/vidimg.jpg" alt="" /></div>
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
			<a href="<?php echo 'javascript:void(0)';?>" class='' ><?php echo "Lecture ". ++$j ;?> :</a>
            </div>
            <div class="lllt_txt">
            <a href="javascript:void(0)"><!--Title : -->
			<?php echo  substr($lesson->name,0,25); ?></a> 
			<br>
            <!--Available: -->
            <?php //echo $level; ?>
            <!--<div id="sidebar" style="float:right;"> <a href="#" style="padding: 1px 10px; margin:0; color: #fff; font-weight: 700; background: #54b551; font-size: 12px;">Start lecture</a> </div>--> 
            </div>
            </div>
            <?php 
		}
    }
    else
    {		
		?>
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
		        <?php echo "Lecture ". ++$j ;?> :
	        </div>
	          
	        <div class="lllt_txt">
				<a onclick="nextslide(<?php echo $program_id ?>,<?php echo $day->id ?>,<?php echo $lesson->id ?>,<?php echo $lessonSrNo;?>)" class='<?php echo (($not_show == false) && ($user_id > 0))?"fancybox fancybox.iframe":'';?>' > <?php echo  substr($lesson->name,0,25);?></a> 
	  	    	<!-- <a href="#" class="btn btn-success" style="float:right; padding: 1px 10px; margin:0; display:none;">Start lecture</a>--> 
	        </div>

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
//print_r($myLessonArray);
$this->session->set_userdata("myLessonArray",$myLessonArray);
?>

    </div>
      <div id="extras" class="ud-extras" data-isinstructor="" data-instructorpreviewmode="">
        <section class="desc">
          <h3>Lecture Description</h3>
          <article>Welcome to the Class! What we will be learning.</article>
        </section>
        <p>There are no available downloads for this course.</p>

        
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
            <input type="hidden" id="lquiryid" name="lquiryid" value="<?php echo $qid;?>" />
            <input type="hidden" id="lqprogid" name="lqprogid" value="<?php echo $pro_id;?>" />
            <input type="hidden" id="lqmodid" name="lqmodid" value="<?php echo $moduleid;?>" />
            <input type="hidden" id="lqlessid" name="lqlessid" value="<?php echo $lessonid;?>" />
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
			<!--<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44">-->
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
			?>
        </ul>
      </div>
    </div>
    
    <style>
#notes-mask 
{
top: 54px;
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
        <textarea id="txt_notes"  placeholder="Write here to take notes..."></textarea>
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
			<li onmouseover ="showdel(<?php echo $result1->nid ?>);" onmouseout ="hidedel(<?php echo $result1->nid ?>);" ><p id="pDiv" ><?php echo"=>"; ?>&nbsp <span id ="span<?php echo $result1->nid ?>" onclick ="showarea(<?php echo $result1->nid ?>);"><?php echo $result1->notes ?></span><textarea id ="area<?php echo $result1->nid?>" onblur="showspan(<?php echo $result1->nid ?>);" style="width: 202px; display :none" onkeydown ="updateNote(<?php echo $result1->nid ?>);" ><?php echo $result1->notes ?></textarea> &nbsp <span id ="delspan<?php echo $result1->nid ?>" onclick ="delNotes(<?php echo $result1->nid ?>);" ></span></p> </li>
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
<script>
function showdel(ii)
{
$('#delspan'+ii).html('x');
}
function hidedel(ii)
{
$('#delspan'+ii).html('');
}
function delNotes(nid)
{	
//alert("yes");
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
            url: "<?php echo base_url(); ?>index.php/programs/like",
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
			url: "<?php echo base_url(); ?>index.php/programs/unlike",
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
			url: "<?php echo base_url(); ?>index.php/programs/saveanswer",
            data    : {'query_id':query_id,'pid':pid,'answer':answer},
 
			success: function(data){
		       
			  if(data=='error'){
				alert('Teir was error while processing, try again!');
				}
				else
				{				  
				/*listresult = $.parseJSON(data);				
				$.each(listresult, function(queryk, querydata)
				{				  
				querylist += '<li'+querydata.ans_id+'>';
				querylist += '<div class="comment">';				
				querylist += '<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>';				
				querylist += '<div class="comment-content">';
				querylist += '<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> - Commented On '+querydata.dateandtime+' </div>';
				querylist += '<div class="comment-text">'+querydata.answer+'</div>';
				querylist += '</div>';
				querylist += '</div>';
				querylist += '</li>';
				});*/
					
					if(querylist == ''){
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
			url:"<?php echo base_url() ?>programs/countComment",
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

<!--<script>
/************<start askquery code */
	function postDisscussion(){
	  
	    
		var querytitle_val = $('#query_title').val();
	   	var querycont_val = $('#query_text').val();
	  

		if( querytitle_val =='' || querycont_val =='' ){
		return false;
		}
		var qpid_val = $('#lqprogid').val();
		
		
		var listresult = '';
		var querylist = '';
		$.ajax({
		type: "POST",
		url: "<?php echo base_url() ?>programs/SaveAndGetQueryList/",
		data: { 'query_title': querytitle_val, 'query_text': querycont_val, 'qpid': qpid_val }
		}).success(function( data ) {
				if(data=='error'){
		alert('Teir was error while processing, try again!');
		}else{
		listresult = $.parseJSON(data);
		$.each(listresult, function(queryk, querydata){
		
		querylist += '<li>';
        querylist += '<div class="comment">';
        querylist += '<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>';
        querylist += '<div class="comment-content">';
        querylist += '<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> posted a discussion <b><?php echo $lessonName;?></b>  ';
        querylist += '<div class="comment-info">- Commented On '+querydata.dateandtime+'</div>';
        querylist += '</div>';
		querylist += '<div class="comment-head">'+querydata.query_title+'</div>';
        querylist += '<div class="comment-text">'+querydata.query_text+'</div>';
        querylist += '<a href="javascript:void(0);" class="liked" id="like'+querydata.query_id+'"  style="margin: 0 45px;"> <i class="entypo-heart"></i>';
        querylist += '</a>';
		querylist += '</li>';
			});
			
			if(querylist == ''){
			querylist = 'No questions have been asked so far';
			}
		 $("#discussion").hide();
		$("#comments-list1").html(querylist);
		}


		});
	}
</script>-->

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
/* ** askquery editor display none end>************ */
/* ***********<start askquery code */
/*	$("#querysubmit").live('click',function(){
		var querytitle_val = $('#query_title').val();
	   	var querycont_val = $('#query_text').val();
		//var querycont_val = $('textarea[name="query_text"]').val();
	   	//var querycont_val = $(this).find('textarea[name="query_text"]').text();
		// alert(querycont_val);

        //var querycont_val = $('textarea[name="query_text"]', this).val();
       	//var querycont_val = document.getElementByName('query_text').value;

		if( querytitle_val =='' || querycont_val =='' )
		{
			return false;
		}
		var qpid_val = $('#lqprogid').val();
		var qmid_val = $('#lqmodid').val();
		var qlid_val = $('#lqlessid').val();
		var listresult = '';
		var querylist = '';
		$.ajax({
		type: "POST",
		url: "<?php echo base_url() ?>lessons/SaveAndGetQueryList/",
		data: { query_title: querytitle_val, query_text: querycont_val, qpid: qpid_val, qmid:qmid_val, qlid: qlid_val  }
		}).success(function( data ) {
		if(data=='error'){
		alert('Teir was error while processing, try again!');
		}else{
		listresult = $.parseJSON(data);
		$.each(listresult, function(queryk, querydata){
		
		//querylist += '<li class="queries_li" data-questionid="'+querydata.id+'">';
        //querylist += '<a href="#">';
        //querylist += '<span class="title">'+querydata.title+'</span>';
        //querylist += '<span class="details">';
        //querylist += '<span class="count"><b>'+querydata.num_answers+'</b> Answer(s)</span>';
        //querylist += '<span class="count" title="This question is asked in Lecture 14">Lecture 14 </span>';
        //querylist += '<span class="more">';
		//querylist += querydata.created;
        //querylist += '<span class="user-title ellipsis">'+querydata.user.title+'</span> <span>asked this <b>'+querydata.created_relative+'</b> ago</span>';
        //querylist += '</span>';
        //querylist += '</span>';
        //querylist += '</a>';
		//querylist += '</li>';
		
		querylist += '<li>';
        querylist += '<div class="comment">';
        querylist += '<div class="comment-thumb"> <a href="#"> <img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo $userData->images?>" alt="" class="img-circle" width="44"> </a> </div>';
        querylist += '<div class="comment-content">';
        querylist += '<div class="comment-author" style="font-size: 13px;"> <a href="#"><?php echo $userData->first_name.' '.$userData->last_name;?></a> posted a discussion <b><?php echo $lessonName;?></b>  ';
        querylist += '<div class="comment-info">- Commented On '+querydata.dateandtime+'</div>';
        querylist += '</div>';
		querylist += '<div class="comment-head">'+querydata.query_title+'</div>';
        querylist += '<div class="comment-text">'+querydata.query_text+'</div>';
        querylist += '<a href="javascript:void(0);" class="liked" id="like'+querydata.query_id+'"  style="margin: 0 45px;"> <i class="entypo-heart"></i>';
        querylist += '</a>';
		querylist += '</li>';
			});
			
			if(querylist == ''){
			querylist = 'No questions have been asked so far';
			}
		$("#questions-list").html(querylist);
		}
		});
	});*/
/* ** askquery code end>************ */

/* ***********<start get Query List code */
		var qpid_val = "<?php echo $pro_id;?>";
		var qmid_val = "<?php echo $moduleid;?>";
		var qlid_val = "<?php echo $lessonid;?>";
		var qid_val = "<?php echo $qid;?>";
		var url = "<?php echo base_url() ?>lessons/GetQueryList/"+qpid_val+"/"+qmid_val+"/"+qlid_val+"/"+qid_val;

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
		url: "<?php echo base_url() ?>lessons/query_responseheader/"+query_id+"/delete",
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
	    url: "<?php echo base_url() ?>lessons/saveanswer/",
	    data: {anstext: ans_text, queryid: query_id, qpid: qpid_val, qmid:qmid_val, qlid: qlid_val}
		}).success(function( data ) {
		if(data=='error'){
		alert('Teir was error while processing, try again!');
		}else{
        document.getElementById("ansid").value = data;
        var ansurl = "<?php echo base_url() ?>lessons/GetAnswer/"+qval+"/"+data+"/list";

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
			//alert(data);
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
$('#delspan'+ii).html('');
}

function showspan(ii)
{
$("#span"+ii).toggle();
$("#area"+ii).toggle();
$('#delspan'+ii).html('x');
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
	function nextslide(pro_id,mod_id,lesson_id,srno)
	{	
		$("#proid").val(pro_id);
		$("#modid").val(mod_id);
		$("#lessid").val(lesson_id);
				
		$.ajax({
		type: "POST",
		url: "<?php echo base_url() ?>lessons/ajaxlesson/",
		data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id},
		//beforeSend : function( data ) { $(".ud-lectureangular").html('<div id="overlay"><img src="<?php echo base_url('public/images/loading.gif'); ?>" /></div>');}
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
				$(".ud-lectureangular").html(data);				    
			}
		});	
		
		getLessionNotes(pro_id,mod_id,lesson_id);
		getlessionDiscussion(pro_id,mod_id,lesson_id);
		setViewLesson(pro_id,mod_id,lesson_id);		
	}

	function my_nexturllist(pro_id,mod_id,lesson_id, srno)
	{
		$.ajax({
		type: "POST",
		url: "<?php echo base_url() ?>lessons/my_getnexturl/",
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
		url: "<?php echo base_url() ?>lessons/my_getpreurl/",
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
		url: "<?php echo base_url() ?>lessons/getnexturl/",
		data: { 'pro_id':pro_id, 'mod_id':mod_id, 'lesson_id':lesson_id}
		}).success(function(data) 
		{		
		     alert(data);
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
		url: "<?php echo base_url() ?>lessons/getpreurl/",
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
			{
				$("#mark_as_complete").html(response);
				if(response[0] == 1)
				{
				$("#maskDiv"+les).html("<span class='ci-progress-maskgreencheck'></span>");
				}
				else
				{
				$("#maskDiv"+les).html("<span class='ci-progress-mask green'></span>");	
				}
				//alert(response[0]);

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

function start_exam(qname, media_id, proid, indexy)//start new exam first time
{
	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>lessons/startexam",
		data:{media_id:media_id,proid:proid,indexy:indexy,qname:qname},
		success:function(data)
		{
			//alert(data);
			$("#my_middle_content").html(data);			
		}
	});	
}

function nextQuestion(qname,media_id, proid, indexy, qtype)//next after first question, created for timer setting
{
	var saveAns = $('#txtMulti').val();

	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>lessons/startexam",
		data:{media_id:media_id,proid:proid,indexy:indexy,qname:qname},
		success:function(data)
		{
			//alert(data);
			$("#my_middle_content_question").html(data);		
			savequestionAns(media_id, proid, saveAns, qtype);	
		}

	});	
}

function savequestionAns(media_id, proid, saveAns, qtype)
{
	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>lessons/savequestionAns",
		data:{media_id:media_id, proid:proid, saveAns:saveAns, qtype:qtype},
		success:function(data)
		{			
			//alert(data);
			//$("#my_middle_content_question").html(data);		
			//savequestionAns(media_id, proid, saveAns);	
		}
	});	
}

function endquiz(qname, media_id, proid, indexy, qtype)//last question button click, end quiz
{
	var saveAns = $('#txtMulti').val();
	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>lessons/endquiz",
		data:{media_id:media_id,proid:proid,indexy:indexy,qname:qname},
		success:function(data)
		{
			//alert(data);
			$("#my_middle_content").html(data);		
			savequestionAns(media_id, proid, saveAns, qtype);	
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
		var value2 = value1+',';
		var res = oldval.concat(value2);
		document.getElementById('txtMulti').value = res;
	}    
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
</script>

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
   var seconds = 60;
}else{
     //seconds = cook;
     //console.log(cook);
     //var seconds = <?php echo $quizz->limit_time;?>*60;
     var seconds = 60;
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
	

