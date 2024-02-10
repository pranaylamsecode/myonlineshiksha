<?php

if($imagename[0]["design_background"] !="")
{
    $image_theme = $imagename[0]["design_background"];
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

$fname = $username[0]['first_name'];
$lname = $username[0]['last_name'];

$CI =& get_instance();
$CI->load->model('admin/settings_model');
$configarr = $this->settings_model->getItems();
$institute_name = $configarr[0]['institute_name'];



$imagename[0]["templates1"]  = str_replace("[SITENAME]",$_SERVER['SERVER_NAME'], $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[INSTITUTE]", $institute_name, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_FIRST_NAME]", $fname, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_LAST_NAME]", $lname, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[SITEURL]", $siteurl, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[CERTIFICATE_ID]", $certificateid, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COMPLETION_DATE]", $date_completed, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_NAME]", $coursename, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[AUTHOR_NAME]", $author_name, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_MSG]", $coursemsg, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[ACADEMY_SIGNATURE]", $configarr[0]['signature'], $imagename[0]["templates1"]);

$imagename[0]["templates2"]  = str_replace("[SITENAME]", $_SERVER['SERVER_NAME'] , $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[STUDENT_FIRST_NAME]", $fname, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[STUDENT_LAST_NAME]", $lname, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[SITEURL]", $siteurl, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[CERTIFICATE_ID]", $certificateid, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[COMPLETION_DATE]",$date_completed, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[COURSE_NAME]", $coursename, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[AUTHOR_NAME]", $author_name, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[CERT_URL]", 'certificate_url', $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[COURSE_MSG]", $coursemsg, $imagename[0]["templates2"]);
$imagename[0]["templates1"]  = str_replace("[ACADEMY_SIGNATURE]", $configarr[0]['signature'], $imagename[0]["templates2"]);
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
		<td  style="padding-top: 169px;  padding-left: 127px; width: 470px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
        <?php echo $imagename[0]["templates1"]; ?>
   </td>
	</tr>
 </table>


</div>
<?php 
}

if($option_selected == 1)
{
?>
<div style="width:900px; font-family:<?php echo $imagename[0]["font_certificate"]; ?>; height:600px; <?php //echo $background_color;?>; background-repeat:no-repeat; background-image:url(<?php echo base_url()."public/uploads/settings/img/".$image_theme; ?>);">
<!--<form name="savePdf" method="post" action="index.php?option=com_guru&view=guruOrders&task=savepdfcertificate">-->
<form name="savePdf" method="post" action="<?php echo base_url() ?>admin/studreport/pdf/<?php echo $date_completed;  ?>/<?php echo $coursename; ?>/<?php echo $author_name; ?>/<?php echo $certificateid; ?>/<?php echo $cid; ?>/<?php echo $uid; ?>">
<table style="width: 90%;">
<tr><td style="color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
<input type="submit" onclick="savePdf.submit();"  class="guru_buynow" name="submit" value="save certificate as pdf" /></td></tr>
</table>
</form>
<table  style="width: 80%;">
	<tr>
		<td  style="padding-left: 88px; padding-top: 122px;padding-left: 108px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
        <?php echo $imagename[0]["templates1"]; ?>
   </td>
	</tr>
</table>
</div>
<?php 
}

if($option_selected == 2)
{
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

<?php 
}
?>

<?php
if($option_selected == 3)
{
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
?>