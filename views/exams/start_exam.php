
<link rel="stylesheet" href="<?php echo base_url() ?>public/css/lesson/lecture_preview.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<style>
	#message {
    position: absolute; 
    color: green;
    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 60px;
    z-index: 10000;
    display: none;
    background: white; 
     padding: 20px; 
     border: 1px solid #ccc; 
}
.not_ans::after {
	width: 0;
	height: 0;
	border-left: 17px solid transparent;
	border-right: 17px solid transparent;
	border-top: 8px solid #ED6060;
	content: "";
	position: absolute;
	top: 35px;
	left: 0;
}
.answered::after {
	width: 0;
	height: 0;
	border-left: 17px solid transparent;
	border-right: 17px solid transparent;
	border-bottom: 8px solid #29B999;
	content: "";
	position: absolute;
	top: -8px;
	left: 0;
}
.answered{
background: rgb(41, 185, 153) none repeat scroll 0% 0%;
border: 0px none;
border-radius: 0px;
color: rgb(255, 255, 255);
position: relative;
}
.not_ans{
background: rgb(237, 96, 96) none repeat scroll 0% 0%;
border: 0px none;
border-radius: 0px;
color: rgb(255, 255, 255);
position: relative;
}
</style>

      <span id="message"></span>

<?php  

// echo "<pre>";
// print_r($exam);
if($exam){ ?> 

<div class='panel panel-primary' data-collapsed='0'>
	<div class="panel-heading">
		<!-- <span id="countdown" class="timer"></span> -->

		
		<div class="panel-title" style="padding-bottom: 25px;">          
		 <p style="display: inline-block;float: left;
   width: 45%;margin-top: 0;margin-bottom: 0px; text-align:left;" class="quiz_title_sec"><span class="quiz_label">Quiz:</span> <span style="color:#fff" class="quiz_title"><?php echo $exam->exam_title; ?></span></p>

<input type="hidden" name="txtTotalSpent" id="txtTotalSpent" value="<?php echo $exam->duration_h.':'.$exam->duration_m; ?>">
<input type="hidden" id="dur_hr" value="<?php echo $exam->duration_h; ?>" >
<input  type="hidden" id="dur_min" value="<?php echo $exam->duration_m; ?>" >
<input type="hidden" name="txtTotalLeave" id="txtTotalLeave" value="">
			<?php if($exam->time_limit_b == 1){ ?>
		<div style="margin-bottom: 0px;display: inline-block;
   width: auto; text-align:right; float: right;" class="quiz_time_sec"><span class="quiz_time_label">Time Remaining :    
			

<!-- <span style=" color: black;font-weight:bold;" id="countdown" class="timer"></span> -->

<span style=" color: black;font-weight:bold;" id="countdown" class="timer"><?php echo $exam->duration_h.':'.$exam->duration_m; ?></span>
</span> </div>
<?php } ?>
			

	<div style="display:none" class="stu_att"><?php echo $attempt_no; ?></div>
	<div style="display:none" class="stu_id"><?php echo $userid; ?></div>
	<div style="display:none" class="exam_id"><?php echo $exam->exam_id; ?></div>
	<div style="display:none" class="prog_id"><?php echo $pro_id; ?></div>

		</div>  
	</div>	                                                                     
	</div>
  
<div class='Qpage'>
	<div><?php
		foreach ($pname as $pg_title) {
			if($pg_title->page_title){
			// echo "<button type='button' class='pgjump' id='".$exam->exam_id."_".$pg_title->page_id."' >".$pg_title->page_title."</button>";

			 // : ".$pg_title->section_title."</button>";
			}
		}
	?></div>

	<div class="panel-body form-horizontal form-groups-bordered">
	  <div id='my_middle_content_question'>
		<div id="showQue"><?php echo $Que; ?></div>
	  </div> 
	</div>
	</div>

	<div class="exam_bottom_sect">
	<button type="button" class="Qprev Qslide" id="<?php echo $exam->exam_id ?>_0_<?php echo $secid; ?>" style='float:left; display: none'> Prev </button>
<!-- 	<img src="" id="Qloader" style="display: block">
 -->	<!-- src="<?php echo base_url() ?>public/img/loader.gif" -->
	<!-- <div id="Qloader" style="display: block;text-align: center">
          <img src="https://create-online-academy.com/public/images/loading.gif" alt="Loading">
    </div> -->
	<button type="button" class="Qnext Qslide" id="<?php echo $exam->exam_id ?>_1_<?php echo $secid; ?>" style='float:right; display: block'>Next</button>
	</div>
	 <?php }   
?>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>public/js/exam/studexam.js"></script>
<script src="<?php echo base_url(); ?>public/js/form-master/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script> -->


<script>
	$(document).ready(function (){
		 if($('body').hasClass('quizreport')){}
		      	else
		      	$('body').addClass('quizreport');
		      $('body').removeClass('quizattempt');
		  	  
		  	});
	$(document).on('click', ".Qslide", function() 
	{
		var Qtot = $('.Qtot').text();
var $tmp = $(this).hasClass("Qnext");
var $tmp2 = $(this).hasClass("Qprev");
var attempt = $('.stu_att').text();
var stud_id = $('.stu_id').text();
var pro_id = $('.prog_id').text();
var Qtype = $('#Q_type').val();
// alert(Qtype);
	if(Qtype == 'matching'){
$('#given_ans').val('matching'); }
if(Qtype == 'subjective'){
	var subans = $('#subtxt').val();
	$('#given_ans').val(subans);

 //    var subjective = tinymce.get('subtxt').getContent();
 //    alert(subjective);
	// if(subjective){
		    // $('#subtxt2').text(subjective);
	// }
}
		var ele_info = $(this).attr('id');
		var ele_id = ele_info.split('_');
		var ele = parseInt(ele_id[1]) + 1;
		var ele2 = parseInt(ele_id[1]) - 1;

		var postdata = $('#examsubmit11').serializeArray();
// postdata.push({examid:ele_id[0],srno:ele_id[1]});
postdata.push({name: 'examid', value: ele_id[0]});
postdata.push({name: 'srno', value: ele_id[1]});
postdata.push({name: 'att_no', value: attempt});
postdata.push({name: 'stud_id', value: stud_id});
postdata.push({name: 'pro_id', value: pro_id});


// console.log(postdata['3']);
		$.ajax({
		    type:"post",

		    data: postdata,
		  // data:{examid:ele_id[0],srno:ele_id[1]},
		url:"<?php echo base_url();?>lessons/nextQue",
		    dataType: "json",
		    beforeSend:function()
		    {
		    	// $('button.Qslide').attr("disabled", "disabled");
		    	// $('#Qloader').css('display','block');
		    },
		success:function(data)
		    {
    // var res = $.parseJSON(data);

		     if(data)
		      {
		      $("#showQue").html(data[0]);  
		  	}

// alert(ele_id[1]);
// alert(ele2);
		      // $(this).attr('id',ele_id[0]+'_'+ele);
		      $('.Qnext').prop("id",ele_id[0]+'_'+ele+'_'+data[1]);
		      $('.Qprev').prop("id",ele_id[0]+'_'+ele2+'_'+data[1]);
		    // $("#"+ele_id[0]+'_'+ele+'_'+data[1]).parent().clone().appendTo("body");
		      //pass data on success 
		      if(data[2]=='green')
		      {		      	
		       $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css({"background": "#29B999","border-radius": "0px","color":"#fff","position":"relative"});	
		       	if($('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).hasClass("not_ans"))
		       		$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).removeClass('not_ans')

		       	if(!$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).hasClass("answered"))
		       	$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).addClass("answered");	  		  				  		
		       // $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css('color','#ffffff');
		   	  }
		   	  else if(data[2]=='red')
		      {		      	
		       $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css({"background": "#ED6060","border-radius": "0px","color":"#fff","position":"relative"});
		        if($('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).hasClass("answered"))
		       		$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).removeClass('answered')
		       	
		       	if(!$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).hasClass("not_ans"))
		        	$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).addClass("not_ans");
		       // $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css('color','#000');
		   	  }

		       $('.Qnext').show();
				$('.Qprev').show();
				$('button.Qslide').removeAttr("disabled", "disabled");
				$('#Qloader').css('display','none');
		    },
		    error: function(data)
    		{   			
    			// console.log(data.responseText);
    			if(data.responseText =='green')
    			{
    				$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css({"background": "#489D54","border": "3px solid #489D54","color":"#fff"});		
    			}
    			else if(data.responseText =='red')
    			{
    				$('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css({"background": "#da4f49","border": "3px solid #da4f49","color":"#fff"});		
    			}

		  		if(ele_id[1]== Qtot)
		  		{
		  			swal({
					  title: "Submit Quiz?",
					  text: "Confirm to submit the quiz!",
					  icon: "",
					  buttons: {
					    cancel: "Cancel",
					    Submit: true,
					  },
					  dangerMode: true,
					})
					.then((value) => {
					  switch (value) {
					 
					    case "Submit":
					     report(ele_id[0],attempt,stud_id,pro_id);
					      swal("Quiz submitted successfully!", {
      						icon: "success"});
					      break;
					 
					    default:
					      return false;
					  }
					});
		  		/*if (confirm('Are you sure, Do you want to final submit the quiz?')) {
				      report(ele_id[0],attempt,stud_id,pro_id);
				    }*/
				}
		  		$('button.Qslide').removeAttr("disabled", "disabled");
		    	$('#Qloader').css('display','none');

    		}

		  }); 


	});

	$(document).on('click', ".Qslide_opt", function() 
	{
		var Qtot = $('.Qtot').text();
var $tmp = $(this).hasClass("Qnext");
var $tmp2 = $(this).hasClass("Qprev");
var attempt = $('.stu_att').text();
var stud_id = $('.stu_id').text(); 
var pro_id = $('.prog_id').text();
var Qtype = $('#Q_type').val();
// alert(Qtype);
	if(Qtype == 'matching'){
$('#given_ans').val('matching'); }
// if(Qtype == 'subjective'){
//     var subjective = tinymce.get('subtxt').getContent();
//     alert(subjective);
// 	if(subjective){
// 		    $('#subtxt2').text(subjective);
// 	}
// }
		var ele_info = $(this).attr('id');
		var ele_id = ele_info.split('_');
		var postdata = $('#examsubmit11').serializeArray();
// postdata.push({examid:ele_id[0],srno:ele_id[1]});
postdata.push({name: 'examid', value: ele_id[0]});
postdata.push({name: 'srno', value: ele_id[1]});
postdata.push({name: 'att_no', value: attempt});
postdata.push({name: 'stud_id', value: stud_id});
postdata.push({name: 'pro_id', value: pro_id});


// console.log(postdata['3']);
		$.ajax({
		    type:"post",

		    data: postdata,
		  // data:{examid:ele_id[0],srno:ele_id[1]},
		url:"<?php echo base_url();?>lessons/nextQue",
		    dataType: "json",
		    beforeSend:function()
		    {
		    	// $('button.Qslide').attr("disabled", "disabled");
		    	// $('#Qloader').css('display','block');
		    },
		success:function(data)
		    {
		    	
    // var res = $.parseJSON(data);
    // if(data[3]){ console.log(data);  }

		     if(data)
		      {
		      $("#showQue").html(data[0]);  
		  	}
 
		    var ele = parseInt(ele_id[1]) + 1;
		    var ele2 = parseInt(ele_id[1]) - 1;
// alert(ele_id[1]);
// alert(ele2);
		      // $(this).attr('id',ele_id[0]+'_'+ele);
		      $('.Qnext').prop("id",ele_id[0]+'_'+ele+'_'+data[1]);
		      $('.Qprev').prop("id",ele_id[0]+'_'+ele2+'_'+data[1]);

		      //pass data on success

		       $('.Qnext').show();
				$('.Qprev').show();
				$('button.Qslide').removeAttr("disabled", "disabled");
				// $('#Qloader').css('display','none');

		    },
		    error: function()
    		{   			
    			// var ele2 = parseInt(ele_id[1]) - 1;
		  	  // $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css('background-color','green');
		     //   $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css('color','#ffffff');

    		 //  $('.Qnext').show();
		  	  // $('.Qprev').hide();
		  	 //  if($tmp == true){
		  		// 	$('.Qnext').hide();
		  		// 	$('.Qprev').show();
		  		// }
		  		// else{
		  		// 	$('.Qnext').show();
		  		// 	$('.Qprev').hide();
		  		// }
		  		if(ele_id[1]== Qtot)
		  		{
		  			swal({
					  title: "Submit Quiz?",
					  text: "Confirm to submit the quiz!",
					  icon: "",
					  buttons: {
					    cancel: "Cancel",
					    Submit: true,
					  },
					  dangerMode: true,
					})
					.then((value) => {
					  switch (value) {
					 
					    case "Submit":
					     report(ele_id[0],attempt,stud_id,pro_id);
					      swal("Quiz submitted successfully!", {
      						icon: "success"});
					      break;
					 
					    default:
					      return false;
					  }
					});
		  		/*if (confirm('Are you sure, Do you want to final submit the quiz?')) {
				      report(ele_id[0],attempt,stud_id,pro_id);
				    }*/
				}
		  		$('button.Qslide').removeAttr("disabled", "disabled");
		    	$('#Qloader').css('display','none');

    		}

		  }); 


	});

	$(document).on('click', "#Quit", function() 
	{
			var attempt = $('.stu_att').text();
		var stud_id = $('.stu_id').text();
		var exam_id = $('.exam_id').text();
		var pro_id = $('.prog_id').text();
		if(!attempt){
			attempt = '1';
		}


		if (confirm('Are you sure, you want to quit this quiz ?')) {
		
			deleteAtt(exam_id,attempt,stud_id,pro_id);
		// window.location.replace('<?php echo base_url() ?>lessons/lesson/26/2/235');

		}
	});
	function deleteAtt(examid,attempt,stud_id,pro_id){
		 $.ajax({

            url:"<?php echo base_url();?>lessons/deleteAttempt",
            type: "POST",
       		data: {examid:examid,attempt:attempt,stud_id:stud_id,pro_id:pro_id},

            success: function (data) {

		      	window.location.replace('<?php echo base_url() ?>lessons/lesson/26/2/235');
		      
		  }
		});

	}

	$(document).on('click', ".finalsub", function() 
	{
		var attempt = $('.stu_att').text();
		var stud_id = $('.stu_id').text();
		var exam_id = $('.exam_id').text();
		var pro_id = $('.prog_id').text();
		if(!attempt){
			attempt = '1';
		}
					console.log(exam_id+attempt+stud_id+pro_id);

		if (confirm('Are you sure, Do you want to submit the quiz?')) {
				      report(exam_id,attempt,stud_id,pro_id);
				    }
	});


	function report(examid,attempt,stud_id,pro_id){
		  $.ajax({

            url:"<?php echo base_url();?>lessons/examreport",
            type: "POST",
       		data: {examid:examid,attempt:attempt,stud_id:stud_id,pro_id:pro_id},

            success: function (data) {
              if(data)
		      {
		      
		      	 var str = '<div class=" fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-warning" aria-hidden="true"></strong>Your quiz has been submited successfully.</div>';
            

		            $('#message').html(str);
		           $('#message').show();
		            $('#message').fadeIn().delay(3000).fadeOut();

		      	// alert('Your quiz has been submited successfully..');
				markCompleted();
		      	// $('#sidebar').hide(); 
		      	// $('#icon2').hide();
		      	// $('#closebtn').hide();
		      	// closeNav();
		      $(".Qpage").html(data);  
		      // $(document).find('.panel-title').hide();
		      $(document).find('.asset-container').attr("width","100%!important");
		      // $(document).find('.sidebar-container').hide();
		      // $(document).find('#sidebar_down').hide();
		      // $('#go-back').show();
		      if($('body').hasClass('quizreport')){}
		      	else
		      	$('body').addClass('quizreport');
		      $('body').removeClass('quizattempt');
		  	  }

            }
        });
	}

	$(document).on('click', ".pgjump", function() 
	{
		var ele_info = $(this).attr('id');
		var ele_id = ele_info.split('_');
		
		var attempt = $('.stu_att').text();
		var stud_id = $('.stu_id').text();
		var exam_id = $('.exam_id').text();
		var pro_id = $('.prog_id').text();

		$.ajax({
		    type:"post",
		 // data:{examid:ele_id[0],srno:ele_id[1]},
		url:"<?php echo base_url();?>lessons/jumpsec/"+ele_id[0]+"/"+ele_id[1]+"/"+stud_id+"/"+pro_id+"/"+attempt,
    dataType: "json",
		success:function(data)
		    {
		      // console.log(data);
		      $('#ExamSection').find('#Quesmarkopt').html(data[0]);

		    }
		  }); 
	});

$(document).ready(function()
{
	$('.bottom').hide();
})
</script>
<?php if($exam->time_limit_b == 1){ ?>
<script>
	var dur_hr = $('#dur_hr').val();
	var dur_min = $('#dur_min').val();
	// console.log(dur_min);
var countdownTimer = setInterval('timer()', 1000);
var min = 0;
if(dur_hr){
	min = dur_hr * 60;
}
dur_min = parseInt(dur_min) + parseInt(min);
// console.log(dur_min);
// alert(dur_min);
var upgradeTime = dur_min * 60;
var seconds = upgradeTime;
function timer() {
    var days        = Math.floor(seconds/24/60/60);
    var hoursLeft   = Math.floor((seconds) - (days*86400));
    var hours       = Math.floor(hoursLeft/3600);
    var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
    var minutes     = Math.floor(minutesLeft/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    // days + ":" +
    document.getElementById('countdown').innerHTML =  hours + ":" + minutes + ":" + remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        // $(document).find('.finalsub').click();
        document.getElementById('countdown').innerHTML = "Completed";
        var attempt = $('.stu_att').text();
		var stud_id = $('.stu_id').text();
		var exam_id = $('.exam_id').text();
		var pro_id = $('.prog_id').text();
			report(exam_id,attempt,stud_id,pro_id);
			die();
    } else {
        seconds--;
    }
}
</script>
<?php } ?>