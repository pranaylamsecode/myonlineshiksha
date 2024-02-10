<style>
.Qnotify {
	cursor: pointer;
	font-weight: bold;
	height: 35px;
	width: 35px;
	display: flex;
	align-content: center;
	align-items: center;
	justify-content: center;
	font-size: 16px !important;
	border: 0px !important;
	margin-bottom: 13px;
	color: #fff;
}
#Quesmarkopt h3 {
	border-top: 0px;
	padding-top: 0px;
}
#Quesmarkopt {
   margin: 0px -10px;
   width: auto;
   height: calc(100% - 380px);
   overflow-y: auto;
}
.ident_text {
	width: 100%;
	position: relative;
	top: 3px;
	font-size: 14px;
}
.instrctn_btn {
	position: absolute;
	bottom: 20px;
	width: 100%;
	left: 0px;
}
.button_grp {
	padding: 0px 10px;
}
.first_instrctn div, .second_instrctn div, .third_instrctn div {
	float: left;
	margin-left: 0px;
	margin-right: 0px !important;
	width: 50%;
	padding: 0px 5px;
}
#tab-curriculum {
	overflow-x: hidden;
}
div#ExamSection {
	padding: 0px 10px;
}
.not_visited{
	background: #D2D2D2;
	border: 0px;
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
.button_grp .exit_btn, .button_grp button.finalsub{
	background: #fff;
	padding: 7px 40px;
	border-radius: 2px;
	font-weight: 200;
	color: #333 !important;
	letter-spacing: 0.03em;
	width: 100% !important;
	display: block;
	text-align: center;
	border: 1px solid #ccc;
	margin-top: 5px;
}
.instrctn_btn .Qnotify {
	font-weight: bold;
	height: 25px;
	width: 25px;
}
.instrctn_btn .not_ans::after{
	width: 0;
	height: 0;
	border-left: 13px solid transparent;
	border-right: 13px solid transparent;
	top: 25px;
	left: 0;
}
.instrctn_btn .answered::after {
	border-left: 13px solid transparent;
	border-right: 13px solid transparent;

}
@media (max-width: 767px){
	.panel-primary > .panel-heading {
	height: auto;
	display: inline-block;
}
#my_middle_content .panel-heading .panel-title p {
	color: #fff !important;
	float: left !important;
	margin-top: 10px;
}
}
</style>
<?php 
// print_r($Qdata);
// print_r($allQue);
 $Qset = json_decode($Qdata);
  // echo "<pre>";

  // print_r($Qset);
// $i = 0;
// foreach ($conts as $data) {
// $i++;
// 	echo "<h2><b>".$data->section_title."<b></h2>";
// 		echo "<span class='opt_point' >".$i."</span>"; 
// }

// print_r($Qset);

$i=0;
$pretitle = '';
foreach ($Qset as $k=> $arr) {
	
	foreach ($arr as $key => $ques) {
		if($key == 0)
		{
			/*if($pretitle != @$ques->page_title){
			 echo "<h3><b>".@$ques->page_title."</b></h3>";
			}*/
						echo "<div>";
			echo "<p class='section_name'>".@$ques->section_title."</p>";
		}
		else{
			echo "<div>";
		}
			$pretitle = $ques->page_title;

		// $submitedQue = $this->exam_model->getsubmitedQue($ques->que_id,$att_no,$exam_id,$stud_id,$program_id);

		echo "<span class='Qnotify Qslide_opt' id='".$ques->exam_id."_".$i."_".$ques->section_id."' style='";
		// if($submitedQue){
		// 	if($submitedQue->stud_given_ans !='')
		// 	{
		// 		echo "background: #489D54;border: 3px solid #489D54;color:#fff;";
		// 	}
		// 	else
		// 	{
		// 		echo "background: #da4f49;border: 3px solid #da4f49;color:#fff;";
		// 	}
		// }
		// else{
			echo "background: #D2D2D2;border: 0px";
		// }
		echo "'>";
				$key++;

		echo $key."</span></div>"; 
		$i++;
	}
	echo "<br>";

}
 ?>
 <br>
<!--  <div class="instrctn_btn">
 	<div class="instrctn_btn_grp">
 		<div class="first_instrctn">
 			<div class=" white_circle "><p class="Qnotify not_visited"></p><p class="ident_text">Not visited</p></div>
 			<div class=" red_circle "><p class="Qnotify not_ans"></p><p class="ident_text">Not answered</p></div>
 		</div>
 		<div class="second_instrctn">
 			<div class=" green_circle "><p class="Qnotify answered"></p><p class="ident_text">Answered</p></div>
 		</div>
 	
 	</div>
 	<div class="button_grp">
		<a class="exit_btn" id="Quit" href="#" >Exit</a>
		<button type="button" class="finalsub">Submit</button>
	</div>
</div>
 <br> -->

 <style>
 div#coursesection {
    display: none;
}
div#tab-curriculum {
    background: rgb(241, 240, 240);
}
 </style>