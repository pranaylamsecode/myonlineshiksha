	
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
			if($pretitle != $ques->page_title){
			 echo "<h3><b>".$ques->page_title."</b></h3>";
			}
						echo "<div>";
			echo "<p class='section_name'>".$ques->section_title."</p>";
		}
		else{
			echo "<div>";
		}
			$pretitle = $ques->page_title;

		$submitedQue = $this->exam_model->getsubmitedQue($ques->que_id,$att_no,$exam_id,$stud_id,$program_id);

		echo "<span class='Qnotify Qslide_opt' id='".$ques->exam_id."_".$i."_".$ques->section_id."' style='";
		if($submitedQue){
			if($submitedQue->stud_given_ans !='')
			{
				echo "background: #489D54;border: 3px solid #489D54;color:#fff;";
			}
			else
			{
				echo "background: #da4f49;border: 3px solid #da4f49;color:#fff;";
			}
		}
		else{
			echo "background: #fff;border: 3px solid #ddd;";
		}
		echo "'>";
				$key++;

		echo $key."</span></div>"; 
		$i++;
	}
	echo "<br>";

}
 ?>
 <br>
 <div class="instrctn_btn">
 	<div class="instrctn_btn_grp">
 		<div class="first_instrctn">
 			<div class="white_circle"><span></span>Not visited</div>
 			<div class="red_circle"><span></span>Not answered</div>
 		</div>
 		<div class="second_instrctn">
 			<div class="green_circle"><span></span>Answered</div>
 			<!-- <div class="purple_circle"><span></span>Marked</div> -->
 		</div>
 		<!-- <div class="third_instrctn">
 			<div class="blank_circle"><span></span>Unanswered Marked</div>
 		</div> -->
 	</div>
 	<div class="button_grp">
		<a class="exit_btn" id="Quit" href="#" >Exit</a>
		<button type="button" class="finalsub">Submit</button>
		<!-- <div id="ExamSection" style="display: none;">
 			<div id="Quesmarkopt"></div>
 			<a id="Quit" href="<?php echo base_url(); ?><?php echo $urlCourse;?>/lectures/<?php echo $pro_id; ?>" >Exit</a>
		</div> -->
	</div>
</div>
 <br>

 <style>
 div#coursesection {
    display: none;
}
div#tab-curriculum {
    background: rgb(241, 240, 240);
}
 </style>