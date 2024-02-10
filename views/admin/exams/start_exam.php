<script src="<?php echo base_url(); ?>public/js/exam/studexam.js"></script>
<script src="<?php echo base_url(); ?>public/js/form-master/jquery.form.js"></script>

<link rel="stylesheet" href="<?php echo base_url() ?>public/css/lesson/lecture_preview.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php  

// echo "<pre>";
// print_r($exam);

if($exam){ ?> 

<div class='panel panel-primary' data-collapsed='0'>
	<div class="panel-heading">
		<!-- <span id="countdown" class="timer"></span> -->

		<div class="panel-title" style="padding-bottom: 0px;">        
		<p style="margin-top: 0; text-align:left; float: left;">Assement : 
			<span style="color:#fff"><?php echo $exam->exam_title; ?></span></p>
		<p style="margin-bottom: 0px; text-align:right;">Time Remaining :    
			</span>
			<input type="hidden" name="txtTotalSpent" id="txtTotalSpent" value="<?php echo $exam->duration_h.':'.$exam->duration_m; ?>">
			<input type="hidden" name="txtTotalLeave" id="txtTotalLeave" value="">
<!-- <span style=" color: black;font-weight:bold;" id="countdown" class="timer"></span> -->
<input type="hidden" id="dur_hr" value="<?php echo $exam->duration_h; ?>" >
<input  type="hidden" id="dur_min" value="<?php echo $exam->duration_m; ?>" >
<span style=" color: black;font-weight:bold;" id="countdown" class="timer"><?php echo $exam->duration_h.':'.$exam->duration_m; ?></span>
		</p>
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
			echo "<button type='button' class='pgjump' id='".$exam->exam_id."_".$pg_title->page_id."' >".$pg_title->page_title."</button>";
			}
		}
	?></div>

	<div class="panel-body form-horizontal form-groups-bordered">
	  <div id='my_middle_content_question'>
		<div id="showQue"><?php echo $Que; ?></div>
	  </div> 
	</div>
	<div class="exam_bottom_sect">
	<button type="button" class="Qprev Qslide" id="<?php echo $exam->exam_id ?>_0_<?php echo $secid; ?>" style='float:left; display: none'> Prev </button>
<!-- 	<img src="" id="Qloader" style="display: block">
 -->	<!-- src="<?php echo base_url() ?>public/img/loader.gif" -->
	<!-- <div id="Qloader" style="display: block;text-align: center">
          <img src="https://create-online-academy.com/public/images/loading.gif" alt="Loading">
    </div> -->
	<button type="button" class="Qnext Qslide" id="<?php echo $exam->exam_id ?>_1_<?php echo $secid; ?>" style='float:right; display: block'>Save & Next</button>
	</div>
</div>
	 <?php }   
?>

<script>
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
		      //pass data on success 
		      if(data[2]=='green')
		      {		      	
		       $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css({"background": "#489D54","border": "3px solid #489D54","color":"#fff"});		  				  		
		       // $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css('color','#ffffff');
		   	  }
		   	  else if(data[2]=='red')
		      {		      	
		       $('#sidebar').find('#'+ele_id[0]+'_'+ele2+'_'+ele_id[2]).css({"background": "#da4f49","border": "3px solid #da4f49","color":"#fff"});		  				  		
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
		  		if (confirm('Are you sure, Do you want to final sumbit the exam?')) {
				      report(ele_id[0],attempt,stud_id,pro_id);
				    }
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
		  		if (confirm('Are you sure, Do you want to final sumbit the exam?')) {
				      report(ele_id[0],attempt,stud_id,pro_id);
				    }
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
		if (confirm('Are you sure, you want to quit this assessment ?')) {
		
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

		if (confirm('Are you sure, Do you want to submit the exam?')) {
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
		      	alert('Your exam is submited successfully..');
		      	$('#sidebar').hide(); 
		      	$('#icon2').hide();
		      	$('#closebtn').hide();
		      	closeNav();
		      $(".Qpage").html(data);  
		      $(document).find('.panel-title').hide();
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