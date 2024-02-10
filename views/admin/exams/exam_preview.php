 
 <!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
 

<div class='panel panel-primary' data-collapsed='0'>
	<div class="panel-heading">
		<div class="panel-title">        
		<p class="exam_preview_top_heading">Exam Name : 
			<span style="color:#fff!important;"><?php echo $title; ?></span></p>
		<p class="exam_preview_top_txt">Exam time remaining:    
			<span style='color: black;font-weight:bold;' id="countdown1" class="timer"><?php echo $duration; ?></span>
			<input type="hidden" name="txtTotalSpent" id="txtTotalSpent" value="<?php echo $duration; ?>">
			<input type="hidden" name="txtTotalLeave" id="txtTotalLeave" value="">
<!-- 			<input type="" name="" id="filenm1" >
 --><!-- 			<div id="filenm" style="display: block"></div>
 --><!-- <span id="ms_timer" class="style colorDefinition size_lg">00:00</span>
<span style=" color: black;font-weight:bold;" id="countdown" class="timer"></span> -->

<span style=" color: black;font-weight:bold;" id="countdown" class="timer"> </span>
		</p>
	<!-- <div style="display:none" class="stu_att"><?php echo $attempt_no; ?></div>
	<div style="display:none" class="stu_id"><?php echo $userid; ?></div>
	<div style="display:none" class="exam_id"><?php echo $exam->exam_id; ?></div>
	<div style="display:none" class="prog_id"><?php echo $pro_id; ?></div> -->

		</div>  
	</div>	                                                                     
	</div>
  
<div class='Qpage'>
	<div class="panel-body form-horizontal form-groups-bordered">

	  <div id='my_middle_content_question'>
		<div id="showQue" class="col-sm-8">
			<div id="Qpage"><?php 
		// foreach (@$pname as $pg_title) {
		// 	echo "<button type='button' class='pgjump' id='".$exam->exam_id."_".$pg_title->page_id."' >".$pg_title->page_title."</button>";
		// }
	?></div>
		<?php  if(@$Que){ echo $Que; }?>
			<div class="loadingmsg" style="display: none">Loading data from JSON source...</div>
			<div id="exam_info"> 

                <div class="form-group"> 
                  
                  <div class="col-sm-12"> Minimum score to pass this exam : <span style="color:#42943F"><?php echo $avgscrore.'%'; ?></span>
                  </div> 
                </div>

                <div class="form-group"> 
                  
                  <div class="col-sm-12">
                  Questions: <span style="color:#42943F"><?php echo $totQ; ?></span>
                  </div>
                </div>

                <div class="form-group"> 
                  
                  <div class="col-sm-12">
                  This exam can be taken up to: <span style="color:#42943F">
                  	<?php echo ($attempt == 11) ? 'Unlimited times ' : $attempt.' times<font color="red"> ('.$attempt.' attempts remaining )</font> ' ?></span>                 </div>
                </div>
                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  You can always see your exam results on your My Courses page
                  </div>
                </div>

                <div class="form-group"> 
                  

                  <div class="col-sm-12">
                  </div>
                </div>

                <hr style="margin:0;">

                <div class="form-group"> 
                  
                  <div class="col-sm-5">
            
          <span class="quiz_description" style="  margin-top: 20px;"></span>

          </div></div>
          <div class="form-group"> 

          			<div class="col-sm-5">

                      <input type="button" class="btn btn-sm btn-success btn-update"  value="Start Exam" name="btnStartPreview" id="btnStartPreview">
                  
                  </div>
                </div>

              </div>
			</div>
			<div class="sidebar col-sm-4" id="sidebar" style="display: none;">
				<div class="instrctn_btn instrctn_btn123">
 					<div class="instrctn_btn_grp">
 						<div class="first_instrctn">
 							<div class="white_circle"><span></span>Not visited</div>
 							<div class="red_circle"><span></span>Not answered</div>
 						</div>
 						<div class="second_instrctn">
 							<div class="green_circle"><span></span>Answered</div>
 						</div>
 					</div>
 					<div class="button_grp">
						<a class="exit_btn" id="Quit" href="#">Exit</a>
						<button type="button" class="finalsub">Submit</button>
					</div>
				</div>
			</div>
	  	</div> 
	</div>
	<div class="exam_bottom_sect">
	
	</div>
</div>
	 

<script>
	
$('#btnStartPreview').on('click', function(){
		$('#exam_info').html('');
		
		 // $("#exam_info").html('<img style="position: absolute;top: 39%;left: 42%;" src="http://www.create-online-academy.com/public/images/loading.gif " />');
		$(document).find('.loadingmsg').show();
		
			setTimeout(function() { startexecute(); }, 1000);
			
});
function startexecute(){

	var newfnm='';
	// $(document).find('.loadingmsg').show();
		 $('#exam_info').html(''); 
			$('#Qpage').html('');
			$(document).find('#sidebar').show();
			var Q=0;
			var Sec=0;
			var seclen = parseInt($('.title_sec').length) - 1;
			var pgs = $('.title_page').length;
			var i=1;
			var counter = 0;
			fnm = $(document).find('.panel-title').find('#filenm1').val();
			for (var i=1; i<= parseInt(pgs); i++) {

				// do{

				var pgtitle = $('#pageTitle_'+i).val();
				$div = "<div class='side_mainhead'>";
				$('#sidebar').append($div);
				if(pgtitle){
					$('#Qpage').append($('<button></button>')
					.text(pgtitle)
					.attr({'type':'button','class':'pgjump'})
					);
					
					$('#sidebar').append($('<h3></h3>')
					.text(pgtitle));
					}
					var fname='';
					var secs = $('#page_'+i).find('.title_sec').length;
					for (var j=1; j<= parseInt(secs); j++) {
						Sec++;
						var sectitle = $('#page_'+i).find('#secTitle_'+Sec).val();

						if(sectitle){
						$('#sidebar').append($('<p></p>')
						.text(sectitle));
						}
						// var ques = $('.Quetitle').length;
						var ques = $('#page_'+i).find('#section_'+Sec).find('.Quetitle').length;
						// alert(ques);
						if($('#exam_category').val() == '2'){
							// alert('manual');
						for (var k=1; k<= parseInt(ques); k++) {
							Q++;
							var Quetitle = $('#page_'+i).find('#section_'+Sec).find('#showQue_'+Q).text();
							// alert(Quetitle);
							if(Quetitle.trim() !=="Add a new question here") {
								// alert(Q);
								$('#sidebar').append($('<span></span>')
							.text(k)
							.attr({'class':'Qslide_opt','onclick':'getQuestion('+Q+')','id':'Qnote_'+Q,'style':{'background':'#fff','border':'3px solid #ddd'}}));
							}
			
						}
						if(k>=ques)
						{
							$('#exam_info').html('');
							getQuestion('1');
						}

						}
						else if($('#exam_category').val() == '1')
						{
							
							// alert('auto');
							var sectitle = $('#page_'+i).find('#secTitle_'+Sec).val();
							if(sectitle){
							var cat = $('#page_'+i).find('#section_'+Sec).find('#Quecat_'+Sec).val();
							var subcat = $('#page_'+i).find('#section_'+Sec).find('#Quesubcat_'+Sec).val();
							var Questype = $('#page_'+i).find('#section_'+Sec).find('#Questype_'+Sec).val();
							var Qno = $('#page_'+i).find('#section_'+Sec).find('#NumQues_'+Sec).val();
							//  console.log('=/======');

							// console.log(newfnm);
							// console.log('=/======');
							
							if(!Qno){ Qno=''; }
							if(!cat){ cat=''; }
							if(!subcat){ subcat=''; }
							if(!Questype){ Questype=''; }
							// if(!fnm){ fnm=''; }
							$.ajax({
								 type: 'POST',
							        // dataType: "json",
							        data: {Qno:Qno,cat:cat,subcat:subcat,Qtype:Questype},
							        url: base_url+'admin/exams/getfilterQues/'+j+'/'+seclen+'/'+newfnm,
							        async: false,
							        beforeSend : function(data){ jQuery("#exam_info").html('<img style="position: absolute;top: 39%;left: 42%;" src="<?php echo base_url() ?>public/images/loading.gif" />'); }, 

							        success: function(filenm){
							        	$(document).find('#getautoque_'+Sec).html('');
							        	if(filenm){
							        	if(counter == 0){
							        		newfnm = filenm;
							        		// $('#exam_info').html('Loading data from JSON source...');
							        		// console.log('newfnm');
							        	}
							        	counter++;
							        	$('.loadingmsg').fadeOut("slow");
							        	 // console.log(j);
							        	 // console.log(secs);
							        	if((secs-1) == j){
							        		// getjsondata(0,0,1,filenm);
							        		$('#exam_info').html('');
							        		getjsondata(0,0,1,filenm);
							        	}
							     
									
										}
							        },
							        error: function(data)
						    		{
						    			// console.log('898');
										console.log(data.responseText);
						   
						    		}

							    });
							}
						}			
					}
					
					
					$div = "</div>";	
					$('#sidebar').append($div);		
				i++;
			}
			// var fnm = $(document).find('.panel-title').find('#filenm').html();
			// do{

			// }
			// while(fnm!=''){
			// 	alert('while');
			// 	alert(fnm);
			// 	console.log('counter'+counter);
			// 	showquiz(fnm);
			// }
			

	}


	// function showquiz(filenm){

		
	// // $('#btnStartPreview').on('click', function(){
	// 	// var fnm = $(document).find('.panel-title').find('#filenm').html();
	// 	// alert('showquiz');
	// 	 				console.log(filenm);

	// 	// var sec_len = parseInt($(document).find('.title_sec').length) - 2;
	// 		if(filenm && ($('#exam_category').val() == 'auto'))
	// 		{
	// 			$('#exam_info').html('');
	// 			getjsondata(0,0,1,filenm);
	// 		}

	// 	else if($('#exam_category').val() == 'manual')
	// 	{
	// 		$('#exam_info').html('');
	// 		getQuestion('1');
	// 	}

	// // });
	// }

	function getjsondata(index,subindex,Qno,filenm){
	// 	var displayResources = $('#showQue');
   // alert(index);
   // alert(subindex);
 // displayResources.text('Loading data from JSON source...');
 console.log(filenm);
		 $.ajax({
		 type: "GET",
		 dataType: "json",
		 url: '<?php echo base_url() ?>/public/JSON/'+filenm,
		      // data: JSON.stringify(d),
		 success: function(result)
		{
			// console.log('success111');
			
			$('#autoQlist').remove();
			var Qlength='0';
			var arr_len = result.length;
			
			
			// $.each(result, function( key1, value1 ) {
			// 	Qlength =result[key1].length + parseInt(Qlength);
			// 	// $.each(result1, function( key, value ) {
			// 	// });

			// });
			// console.log(result);
				value = result[index][subindex];
				if(!value){
					value = result[subindex];
					Qlength =result.length;	
					var subarr_len = result.length;	
					

					if(subindex==(subarr_len-1)){
						$('.exam_bottom_sect').find('.nextbtn').hide();
					}
					
					if(subindex==0){
						// alert(subindex);
						$('.exam_bottom_sect').find('.prevbtn').hide();
					}
					else
						$('.exam_bottom_sect').find('.prevbtn').show();
				}
				else{
					var subarr_len = result[index].length;
					$.each(result, function( key1, value1 ) {
					Qlength =result[key1].length + parseInt(Qlength);
					// $.each(result1, function( key, value ) {
					// });

					});
					if(subindex==0 && index==0)
						$('.exam_bottom_sect').find('.prevbtn').hide();
					else
						$('.exam_bottom_sect').find('.prevbtn').show();

					 if(index >= arr_len) 
					 $('.exam_bottom_sect').find('.nextbtn').hide();
				else $('.exam_bottom_sect').find('.nextbtn').show();
				}
			
				if(value){
					var title = stripHtml(value.que_title);
					// var Qno= subindex+1;
				$(document).find('#showQue').find('#autosetQ').remove();
			$('#showQue').append($('<div></div>').attr({'id':'autosetQ'}));
			$('#autosetQ').append($('<h3></h3>').text('Q. '+Qno+' | '+title));
			var Qtype = value.que_type;
			if(Qtype == 'regular'){
				var opts = stripHtml(value.options);
				opts1 = JSON.parse(opts);
				// console.log(opts1);
				
				 $.each(opts1, function( key, value ) {
				   $.each(value, function( key1, value1 ) {
				 // console.log(key1);
				 var str = "<input type='radio' name='txtRegOpt_' class='ans_Opt' value='"+key1+"' />"+"<span>" + value1+"</span><hr>";
						$('#autosetQ').append(str);
				  }); 
				}); 
				
			}
			else if(Qtype == 'truefalse'){
				var str = "<input type='radio' name='rbTrueFalse_'"+key1+"' class='TFOpt' value='"+key1+"' /><span>True</span><input type='radio' name='rbTrueFalse_'"+key1+"' class='ans_Opt' value='"+key1+"' /><span>False</span><br>";
						$('#autosetQ').append(str);
			}
			else if(Qtype == 'subjective'){
				var str = "<textarea rows='4' cols='50'></textarea>";
						$('#autosetQ').append(str);
			}
			else if(Qtype == 'mediaq'){
				var img = value.que_attachment;
				if(img){
					var str = "<img src='<?php echo base_url() ?>public/uploads/questions/"+img+"' /><br><br>";
						$('#autosetQ').append(str);
				}
				var opts = stripHtml(value.options);
				opts1 = JSON.parse(opts);
				 $.each(opts1, function( key, value ) {
				   $.each(value, function( key1, value1 ) {
				 var str = "<input type='radio' name='txtMediaOpt' class='media_Opt' value='"+key1+"' />"+"<span>"+value1+"</span><hr>";
						$('#autosetQ').append(str);
				  }); 
				}); 	
			}
			else if(Qtype == 'mcq'){ 
				var opts = stripHtml(value.options);
				opts1 = JSON.parse(opts);
				$.each(opts1, function( key, value ) {
				   $.each(value, function( key1, value1 ) {
				 var str = "<input type='checkbox' name='txtMultiOpt_' class='mul_Opt' value='"+key1+"' />"+"<span>"+value1+"</span><hr>";
						$('#autosetQ').append(str);
				  }); 
				}); 	
				
			}
			else if(Qtype == 'matching'){
								//sortable_ele();

				var opts = stripHtml(value.options);
				opts1 = JSON.parse(opts);

				var str = "<div class='col-sm-6' id='prompt'><p class='pair_heading'>Prompts</p></div><div class='col-sm-6' id='answer'><p class='pair_heading'>Answers</p></div>";
				$('#autosetQ').append(str);

				$.each(opts1, function( key, value ) {
				   $.each(value, function( key1, value1 ) {
				 var str = "<p class='prompt_para'>"+value1+"</p>";
					$('#autosetQ').find('#prompt').append(str);
				  }); 
				}); 	
				
				var str2 = "<ul id='sortable'>";
				var subopts = stripHtml(value.que_option);
				subopts1 = JSON.parse(opts);
				$.each(subopts1, function( key, value ) {
				   $.each(value, function( key1, value1 ) {
				 	str2 += "<li class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span> <input type='hidden' name='Mopt[]' value='"+key1+"' >"+value1+"</li>";
				  }); 
				}); 
				str2+= "</ul>";
				$('#autosetQ').find('#answer').append(str2);

			}
			
		}
        		

			if(subindex<(subarr_len-1))
			{
				var Qprev = subindex;
				subindex = subindex + 1;
			}
			else{
				
				if(index<=(arr_len-1))
				{

					index = index + 1;
					var Qprev = subindex;
					subindex = 0;
				
				}

			}
				console.log(index);
				console.log(arr_len);
				
			Qnoprev = Qno - 1;
			if(Qnoprev==0) Qnoprev = 1;
			Qno = Qno + 1;
			
			 // if(Qno < Qlength)	
			 if(index < arr_len)		
			{
				if(!$('.exam_bottom_sect').find('button').is(':visible'))
				{	
					$('.exam_bottom_sect').append($('<button></button>')
						.text('prev')					
						.attr({'id':'prev_'+Qprev,'class':'prevbtn',
							'onclick':'getjsondata('+index+','+(Qprev-1)+','+Qnoprev+',"'+filenm+'")', 'style':'display:none'}));	


					$('.exam_bottom_sect').append($('<button></button>')
						.text('next')
						.attr({'id':'next_'+Qno,'class':'nextbtn',
							'onclick':'getjsondata('+index+','+subindex+','+Qno+',"'+filenm+'")'}));			
				}
				else{ 
					$('.exam_bottom_sect').find('.nextbtn').attr({'id':'next_'+Qno,'onclick':'getjsondata('+index+','+subindex+','+Qno+',"'+filenm+'")'});
					if(subindex==0 && index >0){
					$('.exam_bottom_sect').find('.prevbtn').attr({'id':'prev_'+Qprev,'onclick':'getjsondata('+(index-1)+','+(Qprev-1)+','+Qnoprev+',"'+filenm+'")'});
					}else{
						$('.exam_bottom_sect').find('.prevbtn').attr({'id':'prev_'+Qprev,'onclick':'getjsondata('+index+','+(Qprev-1)+','+Qnoprev+',"'+filenm+'")'});
					}

				}
				// if(index <=0) 
				// 	 $('.exam_bottom_sect').find('.prevbtn').hide();
				// else $('.exam_bottom_sect').find('.prevbtn').show();
				
			}
			
			
			// console.log(result1);
						return true;

		},
        complete: function(xhr,status){
        	// console.log(xhr.responseText);
        	// $.each(xhr.responseText, function( key, value ) {
        	// 	console.log(value);
        	// });
			console.log('complete');

        	// $.each(xhr.responseText[0], function(i, item) {
         // console.log(xhr.responseText[0][0]);
    // });

        },
		 error: function(data) 
    		{   		
    			console.log('error');
    			// console.log(data);
			}
		});
	}
	function stripHtml(html){
    var temporalDivElement = document.createElement("div");
    // Set the HTML content with the providen
    temporalDivElement.innerHTML = html;
    // Retrieve the text property of the element (cross-browser support)
    return temporalDivElement.textContent || temporalDivElement.innerText || "";
}


function getQuestion(Qno)
	{
		 // alert(Qno);
		var Quetitle = $('#showQue_'+Qno).text();
		var Qlength = $('.Quetitle').length;
		if(Quetitle && (Quetitle.trim() !=="Add a new question here")) {
			$('#showQue').html('');
			$('#showQue').append($('<h3></h3>').text('Q. '+Qno+' | '+Quetitle));
			var Qtype = $('#qtype_'+Qno).val();
			if(Qtype == 'regular'){
				var opts = $('#Que_'+Qno).find('.ans_Opt').length;
				for (var i = 0; i < parseInt(opts); i++) {
					var opt_text = $('#Que_'+Qno).find('#txtRegOpt_'+i+'_'+Qno).val();
					if(opt_text)
					{
						var str = "<input type='radio' name='txtRegOpt_' class='ans_Opt' value='"+i+"' />"+"<span>" + opt_text+"</span><hr>";
						$('#showQue').append(str);
					}
				}
			}
			else if(Qtype == 'truefalse'){
				var str = "<input type='radio' name='rbTrueFalse_'"+i+"' class='TFOpt' value='"+i+"' /><span>True</span><input type='radio' name='rbTrueFalse_'"+i+"' class='ans_Opt' value='"+i+"' /><span>False</span><br>";
						$('#showQue').append(str);
			}
			else if(Qtype == 'subjective'){
				var str = "<textarea rows='4' cols='50'></textarea>";
						$('#showQue').append(str);
			}
			else if(Qtype == 'mediaq'){
				var img = $('#Que_'+Qno).find('#MediaImg_'+Qno).val();
				if(img){
					var str = "<img src='<?php echo base_url() ?>public/uploads/questions/"+img+"' /><br><br>";
						$('#showQue').append(str);
				}
				var opts = $('#Que_'+Qno).find('.media_Opt').length;
				for (var i = 0; i < parseInt(opts); i++) {
					var opt_text = $('#Que_'+Qno).find('#txtMediaOpt_'+i+'_'+Qno).val();
					if(opt_text)
					{
						var str = "<input type='radio' name='txtMediaOpt' class='media_Opt' value='"+i+"' /><span>"+opt_text+"</span><hr>";
						$('#showQue').append(str);
					}
				}
			}
			else if(Qtype == 'mcq'){ 
				var opts = $('#Que_'+Qno).find('.mul_Opt').length;
				for (var i = 0; i < parseInt(opts); i++) {
					var opt_text = $('#Que_'+Qno).find('#txtMultiOpt_'+i+'_'+Qno).val();
					if(opt_text)
					{
				var str = "<input type='checkbox' name='txtMultiOpt_' class='mul_Opt' value='"+i+"' />"+"<span>"+opt_text+"</span><hr>";
						$('#showQue').append(str);
					}
				}
			}
			else if(Qtype == 'matching'){
								//sortable_ele();

				var opts = $('#Que_'+Qno).find('.match_Opt').length;
				var str = "<div class='col-sm-6' id='prompt'><p class='pair_heading'>Prompts</p></div><div class='col-sm-6' id='answer'><p class='pair_heading'>Answers</p></div>";
				$('#showQue').append(str);
				var str2 = "<ul id='sortable'>";

				for (var i = 0; i < parseInt(opts); i++) {

					var opt_text = $('#Que_'+Qno).find('#txtMatchque_'+i+'_'+Qno).val();
					var opt_text2 = $('#Que_'+Qno).find('#txtMatchpair_'+i+'_'+Qno).val();
					if(opt_text)
					{
						var str = "<p class='prompt_para'>"+ opt_text+"</p>";
						$('#showQue').find('#prompt').append(str);
					}
					if(opt_text2)
					{
						str2 += "<li class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span> <input type='hidden' name='Mopt[]' value='"+i+"' >"+opt_text2+"</li>";
					}
				}
				str2+= "</ul>";
				$('#showQue').find('#answer').append(str2);

			}

			Qnext = parseInt(Qno)+1;
			Qprev = parseInt(Qno)-1;


			
			  
			 // var Qlength = 1;
				// var totQ = $('.Ques').length;
				// // alert('totQ: '+totQ);
				// for (var i = 1; i <= totQ; i++) {
				// 	var Quetitle = $('#showQue_'+i).text();
				// 	if(Quetitle.trim() ==="Add a new question here") { 
				// 		Qlength = Qlength;
				// 	}else{ Qlength = Qlength + 1; }
				// }
			 if(Qno>Qlength)
			 	$('.exam_bottom_sect').find('.nextbtn').hide();
			 else
			 	$('.exam_bottom_sect').find('.nextbtn').show();
			 if(Qno==1)
			 	$('.exam_bottom_sect').find('.prevbtn').hide();
			 else
			 	$('.exam_bottom_sect').find('.prevbtn').show();

			 
// $('.exam_bottom_sect').find('.nextbtn').show();
			if(Qno < Qlength)
			{
			// alert('btnif11');	
				if(!$('.exam_bottom_sect').find('button').is(':visible'))
				{	

					$('.exam_bottom_sect').append($('<button></button>')
						.text('prev')					
						.attr({'id':'prev_'+Qprev,'class':'prevbtn',
							'onclick':'getQuestion('+Qprev+')','style':'display:none'}));	

					$('.exam_bottom_sect').append($('<button></button>')
						.text('next')
						.attr({'id':'next_'+Qnext,'class':'nextbtn',
							'onclick':'getQuestion('+Qnext+')'}));			
				}
				else{ 
					
					
					$('.exam_bottom_sect').find('.nextbtn').attr({'id':'next_'+Qnext,'onclick':'getQuestion('+Qnext+')'});
					$('.exam_bottom_sect').find('.prevbtn').attr({'id':'prev_'+Qprev,'onclick':'getQuestion('+Qprev+')'});
				
				}
				// if(Qprev <=0) 
				// 	 $('.exam_bottom_sect').find('.prevbtn').hide();
				// else $('.exam_bottom_sect').find('.prevbtn').show();

				// if(Qnext > Qlength) 
				// 	 $('.exam_bottom_sect').find('.nextbtn').hide();
				// else $('.exam_bottom_sect').find('.nextbtn').show();
			}
			var Quetitle2 = $('#showQue_'+Qnext).text();
		if(Quetitle2 =="Add a new question here"){
			// $('.exam_bottom_sect').find('.nextbtn').hide();
		}
		// else{	$('.exam_bottom_sect').find('.nextbtn').hide();}
	  }

					else{
						Qno++;
						if(Qno>=Qlength)
							$('.exam_bottom_sect').find('.nextbtn').hide();
						else						 
							getQuestion(Qno);

					}
	}

	function sortable_ele()
	{
				    $( "#sortable" ).sortable();
				    $( "#sortable" ).disableSelection();
				// return true;
				//    $( "#sortable" ).sortable({
				//   change: function( event, ui ) {
				// 	$('#Qmove').val('1');
				//   }
				// });

	}

</script>