<?php
//print_r($cetificate_msg->certificate_course_msg]);
if($imagename[0]["design_background"] !=""){
      $image_theme = $imagename[0]["design_background"];

/*   $image_theme = explode("/", $imagename[0]["design_background"]);

   print_r($image_theme);
	if(trim($image_theme[4]) =='thumbs'){
		$image_theme = $image_theme[5];
	}
	else{
		$image_theme = $image_theme[4];
	}   */
	}
else{
   echo	$background_color= "background-color:"."#".$imagename[0]["design_background_color"];
}
$author_id =$cetificate_msg->author;
$certificate_text = $this->Myinfo_model->getUser($author_id);
$author_name= (isset($certificate_text->first_name) ? $certificate_text->first_name : '');

$coursemsg = $cetificate_msg->certificate_course_msg;
$coursename = $cetificate_msg->name;
$siteurl = base_url();
$fname = $username['first_name'];
$lname = $username['last_name'];
$imagename[0]["templates1"]  = str_replace("[SITENAME]", 'MLMS', $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_FIRST_NAME]", $fname, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_LAST_NAME]", $lname, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[SITEURL]", $siteurl, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[CERTIFICATE_ID]", '1', $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COMPLETION_DATE]", 'completiondate', $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_NAME]", $coursename, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[AUTHOR_NAME]", $author_name, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_MSG]", $coursemsg, $imagename[0]["templates1"]);
?>

<div style="width:800px; font-family:<?php echo $imagename[0]["font_certificate"]; ?>; height:600px; <?php //echo $background_color;?>; background-size:715px 600px; background-repeat:no-repeat; background-image:url(<?php echo base_url()."public/uploads/settings/img/".$image_theme; ?>);">

<!--<div style="width:800px; font-family:Arial; height:600px; ; background-size:715px 600px; background-repeat:no-repeat; background-image:url(http://192.168.1.13/Joomla_2.5.8/images/stories/guru/certificates/Cert-blue-color-back-no-seal.png);">    -->
<form method="post" name="savePdf">
<br><br><table>

<tbody><tr><td style="padding-left:30px;"><b>(You can download your certificate at any time by visiting 'My Courses' page.)</b></td></tr>
<tr><td style="padding-left:30px; color:#333333"><input type="submit" value="Save as PDF" name="submit" class="guru_buynow" onclick="savePdf.submit();"></td></tr>
</tbody></table>
<input type="hidden" value="com_guru" name="option">
<input type="hidden" value="guruTasks" name="controller">
<input type="hidden" value="savecertificatepdf" name="task">
<input type="hidden" value="333333" name="color">
<input type="hidden" value="Cert-blue-color-back-no-seal.png" name="image">
<input type="hidden" value="Arial" name="font">
<input type="hidden" value="" name="bgcolor">
<input type="hidden" value="1" name="ci">
<input type="hidden" value="100" name="id">

</form>
<table>
	<tbody><tr>
       <td  style="padding-top:125px; padding-left:150px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
        <?php echo $imagename[0]["templates1"]; ?>
   </td>
	</tr>
 </tbody></table>
</div>