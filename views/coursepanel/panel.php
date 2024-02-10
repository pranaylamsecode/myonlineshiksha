<div id="all">
		<div id="main">
			
<div id="system-message-container">
</div>
			

<style type="text/css">
	body{
		min-width:0px !important;
	}
	.rt-container {
		width: auto; !important;
	}
</style>

<script type="text/javascript" language="javascript">
	function openWinCertificatev(t1)
	{
			myWindow=window.open('http://localhost/Joomla_2.5.8/index.php?option=com_guru&amp;view=guruTasks&amp;task=viewcertificate&amp;tmpl=component&amp;certificate=1&amp;pdf=1&amp;dw=2&amp;ci='+t1+'','','width=800,height=600, resizable = 0');
			myWindow.focus();
	}	
var bool = true;
	
	function elementInArray(element, array){
		exist = false;
		for(x=0; x&lt;array.length; x++){
			if(array[x] &amp;&amp; (element == array[x])){
				exist = true;
			}
		}
		return exist;
	}
	
	function get_quiz_result(){
		iJoomlaStopTimer();
		var quize_id = document.getElementById("quize_id").value;
		var number_of_questions = document.getElementById("question_number").value;
		var course_id =1;
		saveInDbQuiz(quize_id, 0, number_of_questions,course_id);
	}
	
	function get_quiz_result_continued(saved_quiz_id){
		var quize_id = document.getElementById("quize_id").value;
		var how_many_right_answers = 0;
		var is_final = 0;
		var course_certificate_term = 6;
		var number_of_questions = document.getElementById("question_number").value;
		var quize_name = document.getElementById("quize_name").value;
		var quize_max_score = document.getElementById("quiz_max_score").value;
		var time_quiz_taken = document.getElementById("time_quiz_taken_user").value;
		var questions_ids_random = document.getElementById("list_questions_id").value;
		var quiz_result_header = '&lt;span class="guru_quiz_title"&gt;Quiz Results:&lt;/span&gt;';
		var quiz_result_content = '';
		var question_id1 = "0";
		for(i=1; i&lt;=number_of_questions; i++){		
			var the_answer = document.getElementById("question_answergived"+i).value;//selected answer	
			var the_answer_array = new Array();
			the_answer_array = the_answer.split("|||");//selected answers
				
			var the_right_answer = document.getElementById("question_answerright"+i).value;//the correct answer
			var the_right_array = new Array();
			the_right_answer_array = the_right_answer.split("|||");//selected answers
			
			var ansgivedbyuser = document.getElementById("question_answergivedbyuser"+i).value;	
			var the_question = document.getElementById("the_question"+i).value;//question name
			
			var all_answers = document.getElementById("all_answers"+i).value;//all question answers
			var all_answers_array = new Array();
			all_answers_array = all_answers.split("|||");//selected answers
			//parse all responses answers in all correct answers and if it is ok, parse all correct answers and make comparation with responses answers(maybe someone doesn't response to one response option)
			var correct_answer = true;
			var answer_count = 0;
			var right_answer_count = 0;
			
			for(t=0; t&lt;the_answer_array.length; t++){
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
					
			quiz_result_content += '&lt;ul class="guru_result_list"&gt;';
			if(the_right_answer_array.length == answer_count){
				how_many_right_answers = how_many_right_answers +1;				
				quiz_result_content += '&lt;li class="right"&gt;'+i+'. '+the_question+'&lt;/li&gt;';								
			}
			else{	
				quiz_result_content += '&lt;li class="wrong"&gt;'+i+'. '+the_question+'&lt;/li&gt;';				
			}
			
			for(j=0; j&lt;all_answers_array.length; j++){
				//--------------------------------------------
				inArray = false;
				for(k=0; k&lt;the_right_answer_array .length; k++){
				if(all_answers_array[j] == the_right_answer_array [k]){
				inArray = true;
				}
				}
				//-------------------------------------------- 
				
				if(inArray){
				quiz_result_content += '&lt;li class="correct"&gt;'+all_answers_array[j]+'&lt;/li&gt;'; 
				}
				else{
				quiz_result_content += '&lt;li class="incorrect"&gt;'+all_answers_array[j]+'&lt;/li&gt;'; 
				}
			}
			quiz_result_content += '&lt;/ul&gt;';	
			
			var question_id = i;
			question_id1 = question_id1 +","+i ;
			saveInDBase(saved_quiz_id, ansgivedbyuser, question_id, quize_id, time_quiz_taken,questions_ids_random);		
		}
	    if(time_quiz_taken &gt;=0){
		
				if(parseInt((how_many_right_answers/number_of_questions)*100) &gt;= parseInt(quize_max_score)){
						var score = parseInt((how_many_right_answers/number_of_questions)*100)+'%';
						if(is_final == 1 &amp;&amp; course_certificate_term == 3){
							quiz_result_header += '&lt;div style="border: 1px solid #FFCC00; background-color:#F7F7F7; padding:10px;"&gt;';
							
							quiz_result_header += '&lt;span style="font-size:16px;"&gt;Congratulations for passing the final exam! You are now eligible for a certificate for this course.Go to &lt;a href=\'index.php?option=com_guru&amp;view=guruorders&amp;layout=mycertificates\'&gt;My Certificates&lt;/a&gt; to view, share and download your certificate.&lt;/span&gt;&lt;br/&gt;';
							 quiz_result_header +=' &lt;/div&gt;';
						}
						quiz_result_header += '&lt;span class="guru_quiz_score"&gt;Your Score: '+score+'&lt;span style="color:#292522;"&gt;(Passed!)&lt;/span&gt;'+'&lt;/span&gt;';
						quiz_result_header +='&lt;div class ="guru-quiz-timer"&gt;';
						quiz_result_header +='&lt;span&gt;Quiz Passed!. Your score:'+ '&lt;span style="color:#669900;"&gt;'+parseInt((how_many_right_answers/number_of_questions)*100)+'%'+'&lt;/span&gt;'+','+" "+'Minimum score to pass is:'+" "+'&lt;span style="color:#669900;"&gt;'+parseInt(quize_max_score)+'%'+'&lt;/span&gt;&lt;/span&gt;';
						quiz_result_header +='&lt;br/&gt;'+'&lt;span&gt;Congratulations!&lt;/span&gt;';
						quiz_result_header +='&lt;br/&gt;&lt;/br&gt;'+'&lt;span&gt;Please continue this course by clicking the next button on top&lt;/span&gt;';
						quiz_result_header +='&lt;/div&gt;';
			  }
			  else{
						var score = parseInt((how_many_right_answers/number_of_questions)*100)+'%';
						quiz_result_header += '&lt;span class="guru_quiz_score"&gt;Your Score: '+score+'&lt;span style="color:#292522;"&gt;(Failed)&lt;/span&gt;'+'&lt;/span&gt;';
						quiz_result_header +='&lt;div class ="guru-quiz-timer"&gt;';
						quiz_result_header +='&lt;span&gt;Quiz Failed. Your score:'+ '&lt;span style="color:#669900;"&gt;'+parseInt((how_many_right_answers/number_of_questions)*100)+'%'+'&lt;/span&gt;'+','+" "+'Minimum score to pass is:'+" "+'&lt;span style="color:#669900;"&gt;'+parseInt(quize_max_score)+'%'+'&lt;/span&gt;&lt;/span&gt;';
						if(time_quiz_taken &lt;11){
							quiz_result_header +='&lt;br/&gt;'+'&lt;span&gt;You have'+'&lt;span style="color:#669900;"&gt;'+" "+(time_quiz_taken-1)+" "+'&lt;/span&gt;'+'more times to take this quiz'+'&lt;/span&gt;';
						}
						if(time_quiz_taken &gt;1){
							quiz_result_header +='&lt;br/&gt;&lt;/br&gt;'+'&lt;span&gt;Would you like to take it again now?&lt;/span&gt;';
								quiz_result_header +='&lt;br/&gt;&lt;br/&gt;'+'&lt;input type="button" class="guru-yes-no-quiz-button"  onClick="window.location.reload()" name="yesbutton" value="Yes"/&gt;'+'&amp;nbsp;&amp;nbsp;';
							var nextbut = document.getElementById("nextbut");
							quiz_result_header += '&lt;input type="button"  class="guru-yes-no-quiz-button"  onClick="nextbut.click();" name="nobutton" value="Later"/&gt;';
						}
						quiz_result_header += '&lt;/div&gt;';
						
			}
		}
		quize_result = quiz_result_header + quiz_result_content;
		document.getElementById("media_15").innerHTML = quize_result;
		saveInDbaseHowManyRightAns(quize_id,how_many_right_answers,number_of_questions,question_id1, saved_quiz_id);
	}
	
	function saveInDBase(saved_quiz_id, ansgivedbyuser, question_id,quize_id,time_quiz_taken,questions_ids_random){
		var url ="index.php?option=com_guru&amp;controller=guruTasks&amp;task=saveInDb&amp;saved_quiz_id="+saved_quiz_id+"&amp;ans_gived="+ansgivedbyuser+"&amp;qstion_id="+question_id +"&amp;quiz_id="+quize_id +"&amp;time_quiz_taken="+time_quiz_taken+"&amp;questions_ids_list="+questions_ids_random+"&amp;no_html=1";
		var req = new Request.HTML({
			method: 'get',
			url: url,
			data: { 'do' : '1' },
			onSuccess: function(response){
			}
		}).send();
	}
	
	function saveInDbaseHowManyRightAns(quize_id,how_many_right_answers,number_of_questions, question_id1, saved_quiz_id){
		var url ="index.php?option=com_guru&amp;controller=guruTasks&amp;task=saveInDbaseHowMany&amp;quiz_id="+quize_id+"&amp;howmanyans="+how_many_right_answers+"&amp;numbofquestions="+number_of_questions+"&amp;qstion_id="+question_id1 +"&amp;saved_quiz_id="+saved_quiz_id +"&amp;no_html=1";
		
		var req = new Request.HTML({
			method: 'get',
			url: url,
			data: { 'do' : '1' },
			onSuccess: function(response){
			}
		}).send();
	}
	
	function saveInDbQuiz(quize_id,how_many_right_answers,number_of_questions,course_id){
		var url ="index.php?option=com_guru&amp;controller=guruTasks&amp;task=saveInDbQuiz&amp;quiz_id="+quize_id+"&amp;howmrans="+how_many_right_answers+"&amp;numbofquestions="+number_of_questions+"&amp;course_id="+course_id+"&amp;no_html=1";
		var savedQuizId = 0;
		var req = new Request({
			method: 'get',
			url: url,
			data: { 'do' : '1' },
			onSuccess: function(saved_quiz_id){
				get_quiz_result_continued(saved_quiz_id);
			}
		}).send();
	}
		      
</script>




		
	<table width="100%">
		<tbody><tr>
			<td>
	
	<table width="100%">
		<tbody><tr>
			<td align="left">
				<a href="/Joomla_2.5.8/index.php?option=com_guru&amp;view=guruPrograms&amp;task=view&amp;cid=1&amp;Itemid=0" onclick="javascript:closeBox();">
					<img title="Course Home Page" alt="Course Home Page" src="http://localhost/Joomla_2.5.8/components/com_guru/images/home.png" style="border:none;">
				</a>
			</td>
						<td align="right">
							
								
				<a onclick="window.location.reload();">
					<img title="Refresh Page" alt="Refresh Page" src="http://localhost/Joomla_2.5.8/components/com_guru/images/repeat.png" style="border:none;">
				</a>
				
											<a href="/Joomla_2.5.8/index.php?option=com_guru&amp;view=guruTasks&amp;catid=1&amp;task=view&amp;module=1&amp;cid=1&amp;tmpl=component&amp;Itemid=103">
								<img title="Next Lesson" alt="Next Lesson" src="http://localhost/Joomla_2.5.8/components/com_guru/images/next.png" style="border:none;" id="nextbut">
							</a>
								</td>
		</tr>
							<tr>
					<td></td>
					<td align="right">
						<span style="font-style:italic;">Module 1/4</span>
						<br>
					     <div style="width:200px; height:10px; background-color:#990000;" id="blank">
							<div style="float:left; height:10px; width:45px; background-color:#339900;" id="completed">
								&nbsp;
							</div>
							<div style="float:left; width:5px; height:10px; background-color:#FFCC00;" id="separator">
						</div>
					</div></td>
				</tr>
			
	</tbody></table>
	
		</td>
	</tr>
	<tr>
		<td>
	
	<table>
		<tbody><tr>
			<td class="contentheading">
							</td>
		</tr>
	</tbody></table>
	
		</td>
	</tr>
	<tr>
		<td>
	
	<span class="contentheading">Module 1: Getting started</span>
			<table cellspacing="0" cellpadding="0" style="width:100%;">
						<tbody><tr style="display:block;" id="layout6">
				<td>
					<table>
						<tbody><tr>
							<td valign="top">
								<table>
									<tbody><tr>
										<td>
											<div id="media_7">
												<div style="text-align:center"><i>error_reporting</i></div><p>2vxcvxvxcvcvcvxvcxvxc 2vxcvxvxcvcvcvxvcxvxc 2vxcvxvxcvcvcvxvcxvxc 2vxcvxvxcvcvcvxvcxvxc 2vxcvxvxcvcvcvxvcxvxc 2vxcvxvxcvcvcvxvcxvxc 2vxcvxvxcvcvcvxvcxvxc 2vxcvxvxcvcvcvxvcxvxc </p>											</div>
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
				
						</tbody></table>
			
			</td>
		</tr>
	</tbody></table>		

<script type="text/javascript" language="javascript">
	window.onload = iJoomlaTimer(0, 0 , 0,0,0 );
</script>

		</div>
	</div>