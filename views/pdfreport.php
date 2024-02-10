<?php
  tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();


    // we can have any view part here like HTML, PHP etc
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
 //$background_color= "background-color:"."#".$imagename[0]["design_background_color"];
$url_copy_id = $opt;
$option_selected = $op;

$coursemsg = (isset($cetificate_msg->certificate_course_msg)) ? $cetificate_msg->certificate_course_msg : '';
//$coursename = (isset($cetificate_msg->name)) ? $cetificate_msg->name : '';
$siteurl = base_url();
$fname = $username['first_name'];
$lname = $username['last_name'];
$imagename[0]["templates1"]  = str_replace("[SITENAME]", 'MLMS', $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_FIRST_NAME]", $fname, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_LAST_NAME]", $lname, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[SITEURL]", $siteurl, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[CERTIFICATE_ID]", $certificateid, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COMPLETION_DATE]", $date_completed, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_NAME]", $coursename, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[AUTHOR_NAME]", $author_name, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_MSG]", $coursemsg, $imagename[0]["templates1"]);

$imagename[0]["templates2"]  = str_replace("[SITENAME]", 'MLMS' , $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[STUDENT_FIRST_NAME]", $fname, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[STUDENT_LAST_NAME]", $lname, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[SITEURL]", $siteurl, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[CERTIFICATE_ID]", $certificateid, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[COMPLETION_DATE]",$date_completed, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[COURSE_NAME]", $coursename, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[AUTHOR_NAME]", $author_name, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[CERT_URL]", 'certificate_url', $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[COURSE_MSG]", $coursemsg, $imagename[0]["templates2"]);
?>
<?php
//if(isset($url_copy_id) && $url_copy_id!=0){
if($option_selected == 4){
?>
<div>
<table>
    <tr>
        <td>
        <?php echo $imagename[0]["templates2"];?><br/>
        </td>
    </tr>
</table>
</div>
<div style="width:800px; font-family:<?php echo $imagename[0]["font_certificate"]; ?>; height:600px; <?php //echo $background_color;?>; background-size:715px 600px; background-repeat:no-repeat; background-image:url(<?php echo base_url()."public/uploads/settings/img/".$image_theme; ?>);">


<table>
	<tr>
		<td  style="padding-top:200px; padding-left:150px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
        <?php echo $imagename[0]["templates1"]; ?>
   </td>
	</tr>
 </table>


</div>
  <?php }

if($option_selected == 1){
?>
<div style="width:800px; font-family:<?php echo $imagename[0]["font_certificate"]; ?>; height:600px; <?php //echo $background_color;?>; background-size:715px 600px; background-repeat:no-repeat; background-image:url(<?php echo base_url()."public/uploads/settings/img/".$image_theme; ?>);">

<!-- <form name="savePdf" method="post" action="index.php?option=com_guru&view=guruOrders&task=savepdfcertificate">   -->
<form name="savePdf" method="post" action="<?php echo base_url() ?>/myinfo/pdf">
<table>
<tr><td style="color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
<input type="submit" onclick="savePdf.submit();"  class="guru_buynow" name="submit" value="save certificate as pdf" /></td></tr>
</table>
</form>
<table>
	<tr>
		<td  style="padding-top:125px; padding-left:200px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
        <?php echo $imagename[0]["templates1"]; ?>
   </td>
	</tr>
 </table>
</div>
<?php }
if($option_selected == 2){
?>
<table>
	<tr>

    	<td style="width:295px; height:300px; background-size:300px 300px; background-position:center; <?php //echo $background_color;?>; background-repeat:no-repeat; background-image:url(<?php echo base_url()."public/uploads/settings/img/".$image_theme; ?>); text-align:center;">
        	<span style="font-size:18px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">Certificate Of Completion</span>
		</td>
        <td style="vertical-align:top; padding-left:15px;">
        	<table>
            	<tr>
                	<td style="font-size:18px;">
						<?php echo $fname." ".$lname; ?>
                    </td>
                </tr>
                <tr>
                	<td style="font-size:18px; float:left"> coursename
						<?php //echo $coursename; ?>
					</td>
                </tr>
                <tr>
                    <td style="float:left;">
                    	<p>Share your achievement! Provide the email addresses of teachers, instructors, friends, colleagues.</p>
					</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br/><br/>
<!--<form id="emailcertificate" name="emailcertificate" method="post" action=""> -->
<?php
$attributes = array('class' => 'tform', 'id' => 'emailcertificate', 'name' => 'emailcertificate');
echo form_open('myinfo/certificate_sendmail/', $attributes);
?>
<table>
	  <tr>
		<td>Email to:( add addresses separated by commas)  </td>
	</tr>
    <tr>
    	<td><input size="68px;" type="text" name="emails" id="emails" value=""></td>
	</tr>
    <tr>
		<td>Personal Message: </td>
	</tr>
    <tr>
    	<td><textarea id="personalmessage" name="personalmessage" cols="50" rows="4" maxlength="7000"></textarea>
	</td>
    </tr>
</table>
<?php echo form_close(); ?>

<div id="certificateemailsbutton">
		<span>
			<input type="button" onclick="emailcertificate.submit();" id="send" name="send" value="Send" />
		</span>
		<a href="#" onclick="javascript:iJoomlaCertClose();"><span>Cancel</span></a>
	</div>

<?php }?>

<?php if($option_selected == 3){
?>
<table>

    <tr style="padding-top:50px;">
  Copy the URL below and use it to refer people to your certificate.
    <br/><br/>
    </tr>
	<tr>
    	<b>Certificate of Completion URL</b><br/>
    </tr>
	<tr>
    	<td>
        <input size="90px;" type="text" value="<?php echo base_url().'myinfo/printcertificate/4/'.$coursename.'/'.$author_name.'/'.$certificateid.'/'.$date_completed.'/'.$cid; ?>/opt/">

</td>
    </tr>
 </table>
<?php
}
    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>