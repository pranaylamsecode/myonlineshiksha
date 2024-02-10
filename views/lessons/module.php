<?php

$pro_id = $program_id;
//print_r($viewedLesson);
$isComplete = (($viewedLesson[0]['completed'] > 0) && (!empty($viewedLesson))) ? $viewedLesson[0]['completed'] : 0;
	
//global $programnavarray;
$coursetype_details = $this->Tasks_model->getCourseTypeDetails ($pro_id);
		if($user_id > 0){ 
			$date_enrolled = $this->Tasks_model->datebuynow($pro_id, $user_id);
			if(count($date_enrolled) > 0){
			$not_show = true;
			}
			else{
				$not_show = false;
			}
			
			$date_enrolled = (count($date_enrolled) > 0) ? $date_enrolled->buydate : '';
			$date_enrolled = strtotime($date_enrolled);	
		}
		
		if(isset($date_enrolled)){
			
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
<html lang="en-gb" dir="ltr" xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" slick-uniqueid="3">
<div id="all">
		<div id="main">
			
<div id="system-message-container">
</div>
			
<head>
<title><?php echo $module->title;?></title>
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-core.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/modal.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-more.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/default/js/jquery-1.7.1.min.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/default/css/style.css" />
<style type="text/css">
body{
min-width:0px !important;
}
.rt-container {
width: auto; !important;
}
</style>
</head>
<body id="lessionbody">
<?php  

//print_r($coursetype_details);
//echo $coursetype_details[0]["course_type"];
//echo $coursetype_details[0]["lessons_show"];
//echo $coursetype_details[0]["lesson_release"];
//echo $not_show;
$sequential = false;
	if($user_id >0 && $coursetype_details[0]["course_type"] != 0 && $coursetype_details[0]["lessons_show"] == 1 && $coursetype_details[0]["lesson_release"] >0 && $not_show === TRUE){
	$sequential = true;
	}


function lessondate($programnavarray,$lessid,$diff_start){
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
(int) $M_currkey  = array_search($moduleid, $programnavarray);
(int) $M_prevkey = $M_currkey - 1;
(int) $M_nextkey = $M_currkey + 1;
(int) $M_lastkey = count($programnavarray)/2;
(int) $M_lastkey = $M_lastkey - 1;
$nextLval = $programnavarray['lessons'.$M_currkey][0];
if($M_prevkey >= 0){
(int) $prevlastLkey = count($programnavarray['lessons'.$M_prevkey]);
(int) $prevlastLkey = $prevlastLkey - 1;
$prevLval = $programnavarray['lessons'.$M_prevkey][$prevlastLkey];
}else{
$prevLval = NULL;
}
if($prevLval != NULL )
{
if($sequential == true){
$prevurl = (lessondate($programnavarray, $prevLval, $diff_start)=='open') ? Lurl($program_id, $programnavarray[$M_prevkey], $prevLval) : NULL;
}else{
$prevurl = Lurl($program_id, $programnavarray[$M_prevkey], $prevLval);
}
}else{
$prevMval = ($M_prevkey >= 0) ? $programnavarray[$M_prevkey] : NULL;
$prevurl = Murl($program_id, $prevMval);
}

if($nextLval != NULL ){
	if($sequential == true){
	$nexturl = (lessondate($programnavarray, $nextLval, $diff_start)=='open') ? Lurl($program_id, $moduleid, $nextLval) : NULL;
	}else{
	$nexturl = Lurl($program_id, $moduleid, $nextLval);
	}
}else{
$nextMval = ($M_nextkey <= $M_lastkey) ? $programnavarray[$M_nextkey] : NULL;
$nexturl = Murl($program_id, $nextMval);
}

function Lurl($program_id,$moduleid,$lid){
return ($lid != NULL) ? base_url()."lessons/lesson/".$program_id."/".$moduleid."/".$lid."/" : NULL;
}
function Murl($program_id,$mid){
return ($mid != NULL) ? base_url()."lessons/module/".$program_id."/".$mid."/" : NULL;
}

$modcount = count($programnavarray)/2;
$modcurr = array_search($moduleid, $programnavarray)+1;
//$lescount = count($programnavarray['lessons'.$M_currkey]);
//$lescurr = $L_currkey+1;
//$layoutid = $lesson->layoutid;
$this->load->helper('media');
		//$mediacontain1 = ajaxmediaview($db_media[1]->media_id,1);
		//$textcontain1 = ajaxmediaview($db_mediatext[1]->media_id,1);?>


		
	<table width="100%">
		<tbody><tr>
			<td>
	
	<table width="100%">
		<tbody><tr>
			<td align="left">
					<a href="<?php echo base_url();?>programs/programs/<?php echo $program_id;?>"onclick="javascript:parent.jQuery.fancybox.close();"> 
					<img title="Course Home Page" alt="Course Home Page" src="<?php echo base_url();?>public/default/images/home.png" style="border:none;">
				</a>
			</td>
			<td align="right">
				<?php if($prevurl != NULL){?>
				<a href="<?php echo $prevurl;?>">
					<img title="Previous Lesson" alt="Previous Lesson" src="<?php echo base_url();?>public/default/images/back.png" style="border:none;">
				</a>
				<?php }?>
				<a onclick="window.location.reload();">
					<img title="Refresh Page" alt="Refresh Page" src="<?php echo base_url();?>public/default/images/repeat.png" style="border:none;">
				</a>
				<?php if($nexturl != NULL){?>
				<a href="<?php echo $nexturl;?>">
					<img title="Next Lesson" alt="Next Lesson" src="<?php echo base_url();?>public/default/images/next.png" style="border:none;" id="nextbut">
				</a>
				<?php }?>
			</td>
		</tr>
						<tr>
					<td></td>
					<td align="right">
				<span style="font-style:italic;">Module <?php echo $modcurr; ?>/<?php echo $modcount;?></span>
						<br>
						<?php 
						//echo '<pre>';
						//print_r($programnavarray);
						//echo '</pre>';
						(int)$countmod = (count($programnavarray)/2)-1;
						$total = 0;
						$poz = 1;
						$poz_clone = 0;
						$line_width = 5;
						$proarray = array();
						
						for($index = 0;$index <= $countmod;$index++){
						$total += count($programnavarray['lessons'.$index]);
							foreach($programnavarray['lessons'.$index] as $val){
							if($programnavarray[$index] == $moduleid){
							$poz = $poz_clone;
							break;
							}
							$poz_clone++;
							}
						}
						?>
						<div id="blank" style="width:<?php echo $settings["0"]["st_width"]; ?>px; height:<?php echo $settings["0"]["st_height"]; ?>px; background-color:<?php echo $settings["0"]["st_notdonecolor"]; ?>;">
							<div id="completed" style="float:left; height:<?php echo $settings["0"]["st_height"]; ?>px; width:<?php echo (($settings["0"]["st_width"]*$poz)/$total)-$line_width; ?>px; background-color:<?php echo $settings["0"]["st_donecolor"]; ?>;">
								&nbsp;
							</div>
							<div id="separator" style="float:left; width:<?php echo $line_width; ?>px; height:<?php echo $settings["0"]["st_height"]; ?>px; background-color:<?php echo $settings["0"]["st_txtcolor"]; ?>;">
							</div>
						</div>
						</td>
				</tr>
			
	</tbody></table>
	
		</td>
	</tr>
	<tr>
		<td>

	
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
	
				<table style="margin:auto;">
				<tbody><tr>
					<td align="center" style="padding-top:10%">
						<span class="large_module_position">Module <?php echo $modcurr; ?>:</span>
					</td>
				</tr>
				<tr>
					<td align="center" style="padding-top:10%">
						<span class="large_module_name"><?php echo $module->title;?></span>
					</td>
				</tr>
			</tbody></table>

			<table cellspacing="0" cellpadding="0" style="width:100%;">
						<tbody><tr style="display:block;" id="layout6">
				<td>
					<table>
						<tbody>
						<tr style="display:block;" id="layout1">
				<td>
				<?php if(isset($db_media[0]->media_id)||isset($db_mediatext[0]->media_id)){?>
				
					<table>
						<tbody>
							<tr>
								<td valign="top">
									<table>
										<tbody><tr>
											<td>
											<div id="media_1">
											<?php if(isset($db_media[0]->media_id))
											{
											ajaxmediaview($db_media[0]->media_id,1);
											}?>
											</div>	
											</td>
										</tr>
									</tbody></table>
								</td>
								<td valign="top">
									<table>
										<tbody><tr>
											<td>
											<div id="text_1">
											<?php 
											if(isset($db_mediatext[0]->media_id))
											{
											ajaxmediaview($db_mediatext[0]->media_id,1);
											}?>
											</div>										
											</td>
										</tr>
									</tbody></table>
								</td>					
							</tr>
						</tbody>
					</table>	
<?php }?>					
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
	</body>
</html>