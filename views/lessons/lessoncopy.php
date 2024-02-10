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
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-core.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/modal.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-more.js"></script>
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
			<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
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
											<?p