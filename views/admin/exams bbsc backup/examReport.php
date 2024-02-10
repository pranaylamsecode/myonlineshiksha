<?php print_r($optmark); ?>
<style>
	.rep_msg{
		text-align: center;
	}
	.btn{
		margin-bottom: 60px!important;
		margin-top: 30px;
	}
	
</style>
<div class="final_submit_txt">
	<!-- <h3>Thank you for attending the assessment.</h3> -->
	<h3 style="text-align: center;"><?php echo $msg; ?></h3>
	<div class="innner_final_submit_txt">
		
		<h2><span><?php echo $obt_marks ? $obt_marks : '0'; ?></span></h2>
		
		<p>Score Out Of <span> <?php echo $examinfo->total_marks; ?></span></p>

		
			<!-- <?php $pr = floatval($obt_marks*100)/$examinfo->total_marks; ?>
			<div class="correction_sect">
				<div class="correct"><p class="result_green">0</p><p>Correct</p></div>
				<div class="incorrect"><p class="result_red">0</p><p>InCorrect</p></div>
				<div class="skipped"><p class="result_silver">20</p><p>Skipped</p></div>
			</div>
			<h3><span><?php echo round($pr).'%'; ?></span></h3>
			<h3><span><?php if($examinfo->passing_score < $pr) echo "PASS"; else echo "fail"; ?></span></h3> -->
	</div>
	<?php
	if($obt_marks == '41'){
        ?>

            <div class="rep_msg"><h3>Congratulation!.. You are eligible for the next course,<br> click to proceed next course</h3>
            	<a type="button" class="btn btn-info" href="<?php echo base_url(); ?>course/advance-course/30">Go To Advance Course >> </a></div>
          <?php }
          else if($obt_marks < '41' && $obt_marks >= '30' ){
        ?>
        <div class="rep_msg"><h3>Congratulation!.. You are eligible for the next course,<br> click to proceed next course</h3>            	<a type="button" class="btn btn-info" href="<?php echo base_url(); ?>course/regular-course/31">Go To Regular Course>> </a></div>
          <?php }
          else{
        ?>
        <div class="rep_msg"><h3> You are eligible for the next course,<br> click to proceed next course</h3>
			<a type="button" class="btn btn-info" href="<?php echo base_url(); ?>course/basic-course/32">Go To Basic Course >> </a></div>
<!--             <li><a href="<?php echo base_url(); ?>course/basic-course/32">COURSES</a></li>
 -->          <?php } 

            ?>
</div>
<?php if($user_id == '1'){

	echo "<div class='ad_msg' style='display:none'>Only admin can see the second attempt</div>";
} ?>
<script>
window.onload = function() {
	$('.ad_msg').show();
	document.getElementById("style-5").style.height = "94%";
       document.getElementById("responsive-sidebar").style.position = "fixed";

};
</script>