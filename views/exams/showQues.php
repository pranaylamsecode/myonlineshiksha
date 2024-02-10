<style type="text/css">
/*.opt_point{
	    border: #e7e7e7 solid 3px;
    border-radius: 50%;
    float: left;
    height: 25px;
    width: 25px;
    text-align: center;
    line-height: 22px;
    font-size: 15px;
}*/
.Qpage h3 {
	margin-bottom: 20px;
}
#errorOpt{
	display: none;
	color: red;
	 -webkit-transition: width 2s; /* Safari */
    transition: width 2s;
}
.Que_title{
	font-size: 20px;
}
.que_block{
	margin:0 20px;
}

/*********/
label:hover {
    background: #d3dee8;
}
label {display: block; padding: 10px; position: relative; padding-left: 50px;}
label input {display: none;}
label span {border: 1px solid #ccc; width: 30px; height: 30px; position: absolute; overflow: hidden; line-height: 1.3; text-align: center; border-radius: 100%; font-size: 15pt; left: 0; top: 50%; margin-top: -14.5px;}
input:checked + span {background: #4985B8; border-color: #ccf;}
label input[type=checkbox]{
	visibility: hidden;
	margin-top: -33px;
}


</style>
<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 280px; }
  #sortable li { padding-left: 1.5em; font-size: 1.4em; height: 46px; }
  #sortable li span { margin-left: -1.3em; }
  </style>

   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="<?php echo base_url() ?>public/css/lesson/lecture_preview.css"> -->
<!-- <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  </style> -->


<?php
function shuffle_assoc($array)
{
    // Initialize
        $shuffled_array = array();


    // Get array's keys and shuffle them.
        $shuffled_keys = array_keys($array);
        shuffle($shuffled_keys);


    // Create same array, but in shuffled order.
        foreach ( $shuffled_keys AS $shuffled_key ) {

            $shuffled_array[  $shuffled_key  ] = $array[  $shuffled_key  ];

        } // foreach


    // Return
        return $shuffled_array;
}
 

$attributes = array('class' => 'Qform', 'id' => 'examsubmit11');
echo  form_open_multipart(base_url().'exams/nextQue', $attributes);
?>
<div  style="display:none" class="Qtot"><?php echo $Qtot; ?></div>
<input type="text" name="stud_ans" value="" id="stud_ans" style="display:none">

<input type='text' name='Q_id' value='<?php echo $Ques->que_id; ?>' id='Q_id'  style="display:none">
<input type='text' name='Q_type' value='<?php echo $Ques->que_type; ?>' id='Q_type' style="display:none">

<?php
$CI = & get_instance(); //used to load model inside view page
$CI->load->model('exam_model');

$submitedQue = $CI->exam_model->getsubmitedQue($Ques->que_id,$att_no,$exam_id,$stud_id,$program_id);
// print_r($submitedQue);
?>
<!-- value="<?php echo ((@$submitedQue->stud_given_ans !='') ? @$submitedQue->stud_given_ans : ''); ?>" -->
<input type='text' name='given_ans' value="<?php echo ((@$submitedQue->stud_given_ans !='') ? $submitedQue->stud_given_ans : '')?>"  id='given_ans' style="display: none;">
<?php
// print_r(@$submitedQue);
// echo "<h3>Q.".$Qno." |  Question ".$Qno." of ".$Qtot."</h3>";
if($Ques->que_type == "mcq")
	$qtype = "Multiple Choice Question ";
else if($Ques->que_type == "regular")
	$qtype = "Single Choice Question ";
else if($Ques->que_type == "subjective")
	$qtype = "Survey Question";
else
	$qtype = "";
/*else if($Ques->que_type == "subjective")
	$qtype = "write Answer";*/


echo "<h3>Question ".$Qno."<span style='float:right'>".$qtype."</span></h3>";

echo "<div class='que_block'><span class='Que_title'>".$Ques->que_title."</span>";

	echo "<div id='errorOpt'></div>";
	if($Ques->que_type == "mediaq")
	{
		echo "<img src='".base_url()."public/uploads/questions/".$Ques->que_attachment."' style='height:40%; width:auto' >";
	}


if($Ques->que_type == "mediaq" || $Ques->que_type == "mcq" || $Ques->que_type == "regular")
{
		$array = json_decode($Ques->options);

	$arr2 = array();
	$alphabet = range('A', 'Z');


	foreach ($array as $arr) {
	foreach ($arr as $key => $value) 
	{	
		// echo $value."<hr><br>";
		$a = array($key => $value);
$arr2 = $arr2 + $a;

	}
	
	}
	 // print_r($arr2);
                // <div class="quiz" id="quiz" data-toggle="buttons"> 
                // <label class="element-animation1 btn btn-lg btn-danger btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="1"> Computer Style Sheets</label>
                //  </div>

	// $new_a = shuffle_assoc($arr2);
	// var_export($new_a);
	$i =0;
			if($Ques->que_type == 'mcq')
			{ 
				if(@$submitedQue->stud_given_ans){
					$ansarray = explode('_', rtrim(@$submitedQue->stud_given_ans,'_'));
				}
				else{
					$ansarray = array();
				}


				// foreach ($new_a as $key => $value) {
				foreach ($arr2 as $key => $value) {
					?>
					<!-- <?php //echo (in_array($key,$ansarray) ? 'checked' : ''); ?>  -->
				 <label><input type="<?php echo ($Ques->que_type == 'mcq' ? 'checkbox' : 'radio'); ?>" name="opt" class="chkOpt Qnotify" id='<?php echo $Ques->que_type; ?>_<?php echo $key; ?>' value="<?php echo $key; ?>" >
				 	<span><?php echo $alphabet[$i] ?></span><?php echo htmlentities($value); ?></label><br>
	<?php	$i++;	} 
			}
			else {
				
	foreach ($arr2 as $key => $value) {
		//echo $key." ---- ".$value."<br>"; 
//echo $submitedQue->stud_given_ans; 
		?>
<!-- regular -->

		
		 <label><input type="radio" name="opt" class="chkOpt" id='<?php echo $Ques->que_type; ?>_<?php echo $key; ?>' value="<?php echo $key; ?>" <?php if(@$submitedQue){ echo (($submitedQue->stud_given_ans == $key) ? 'checked="checked"' : ''); } ?> >
		 	
		 	<span><?php echo $alphabet[$i] ?></span>
	<?php echo htmlentities($value);

	 ?></label><br>
		
<?php $i++;	}
	}




	// foreach ($array as $arr) {
	
	// foreach ($arr as $key => $value) 
	// {	?>
		<!-- <input type="checkbox" name="gender" class="chkOpt" value="<?php echo $key; ?>"><?php echo $value; ?></input><hr> -->
<!-- 		echo "<span class='opt_point'>".$key."</span> ".$value."<hr>"; -->
 <?php
	// }

	// }
}
else if($Ques->que_type == "subjective")
{	?>
	<div class="col-sm-12 no-padding">							
  		<!-- <textarea id="subtxt" name="subans1" class="form-control txteditor" rows="6" value="<?php echo (($submitedQue->stud_given_ans) ? $submitedQue->stud_given_ans : ''); ?>">
  		</textarea> -->
  		<span><b>Answer: (write answer here)</b></span>
  		<textarea id="subtxt" class="form-control" rows="12" name="subans" tabindex="-1" autofocus="autofocus"><?php echo @$submitedQue->stud_given_ans ? @$submitedQue->stud_given_ans : '' ?></textarea>
	</div>
<?php
}
else if($Ques->que_type == "truefalse")
{	?>


	<div class="col-sm-12 no-padding">							
  		<input type='radio' class='tf_Opt' name="rbTrueFalse" id='txtTrue' value='1' 
  		<?php// echo ((@$submitedQue->stud_given_ans == '1') ? 'checked' : ''); ?> >  True
  		<input type='radio' class='tf_Opt' name="rbTrueFalse" id='txtFalse' value='0' <?php// echo ((@$submitedQue->stud_given_ans == '0') ? 'checked' : ''); ?> >  False
  		
	</div >
<?php
}
else if($Ques->que_type == "matching")
{
	echo "<div class='col-sm-5'><p class='pair_heading'>Prompts</p>";
	$array = json_decode($Ques->options);
	foreach ($array as $arr) {
	
	foreach ($arr as $key => $value) 
	{
		echo "<p class='prompt_para' >".$value."</p>"; 
	}

	}
	echo "</div><div class='col-sm-5'><p class='pair_heading'>Answers</p>";

	$array2 = json_decode($Ques->que_option);

$arr2 = array();

	foreach ($array2 as $arr) {
	foreach ($arr as $key => $value) 
	{	
		// echo $value."<hr><br>";
		$a = array($key => $value);
$arr2 = $arr2 + $a;

	}
	
	}

	?>
</div>
	<script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );

   $( "#sortable" ).sortable({
  change: function( event, ui ) {
	$('#Qmove').val('1');
  }
});
  </script>
  <!-- value="<?php echo ((@$submitedQue->stud_given_ans !='') ? '1' : ''); ?>" -->
<input type="hidden" id="Qmove" name="Qmove" value="">
 <ul id="sortable">
<?php  // print_r($arr2);

	if(@$submitedQue->stud_given_ans)
	{
		$arr3 = explode('_', rtrim(@$submitedQue->stud_given_ans,'_'));

	foreach ($arr3 as $key => $value) { ?>
	<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
		<input type="hidden" name="Mopt[]" value="<?php echo $value; ?>" ><?php echo $arr2[$value]; ?></li>
	<?php
		// echo $key." ---- ".$value."<hr><br>";
		} 
	}

	else{
	// $new_a = shuffle_assoc($arr2);
	foreach ($arr2 as $key => $value) { ?>
	<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
		<input type="hidden" name="Mopt[]" value="<?php echo $key; ?>" ><?php echo $value; ?></li>
		<?php
		// echo $key." ---- ".$value."<hr><br>";
		} 
	}
	// print_r($new_a); ?>
 
<!-- 	// var_export($new_a);
 -->	</ul>
	
	<!-- <ul id="sortable">
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
</ul>
  -->
<?php
	echo "</div>"; 
// print_r($arr2);

} ?>
<textarea class="form-control txteditor" rows="6" style="display: none ">
  		</textarea>
	
	<input type='hidden' value='<?php echo $ans; ?>' id='Qans'>
<!-- 	<button type="submit" id='subexam'></button>
 -->
<script>
	 	var Q_type = $('input#Q_type').val();
// if(Q_type == 'subjective')
// {
// 	if (tinymce.editors.length > 0) {
//     tinymce.execCommand('mceFocus', true, subtxt);       
//     tinymce.execCommand('mceRemoveEditor',true, subtxt);        
//     tinymce.execCommand('mceAddEditor',true, subtxt);
// }
// }

// $(document).ready(function(){
// 	 tinymce.init({ 

// plugins: [
// "eqneditor advlist autolink lists link image charmap print preview anchor",
// "searchreplace visualblocks code fullscreen",
// "insertdatetime media table contextmenu paste" ],
// toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
// selector : " .txteditor",
// });

// 	} );



</script>


