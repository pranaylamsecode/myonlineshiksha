<?php
  define('BGR_IMG', $imagename[0]["design_background"]);
  tcpdf();
  class MYPDF extends TCPDF {
  //Page header
    public function Header() 
    {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();

        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;

        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        // set bacground image
        $img_file = base_url().'public/uploads/certificates/'.BGR_IMG;
        //$this->Image($img_file, 0, 0, 200, 175, '', '', '', false, 50, '', false, false, 0);//on date 19-09-2015 by yd
        $this->Image($img_file, 0, 0, 300, 210, '', '', '', false, 100, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
    
        // set the starting point for the page content
        $this->setPageMark();
    }
}

ob_start();
$obj_pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Course Completion Certificate";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('certfont');

// $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetHeaderMargin(0);

// $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetFooterMargin(0);

///$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetMargins(12, 0, PDF_MARGIN_RIGHT);

$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// $obj_pdf->SetFont('certfont', 'B', 15);
$obj_pdf->SetFont($imagename[0]['font_certificate'], 'B', 15);
$obj_pdf->setFontSubsetting(true);
$obj_pdf->AddPage('L', 'A4');

// we can have any view part here like HTML, PHP etc
//$obj_pdf->setJPEGQuality(75);
//$image_theme = $imagename[0]["design_background"];
$CI =& get_instance();
$CI->load->model('admin/settings_model');
$configarr = $this->settings_model->getItems();
$institute_name = $configarr[0]['institute_name'];
$logoimg = $configarr[0]['logoimage'];
 // $logoimg1 = '<img src="'.base_url().'public/uploads/certificates/'.$logoimg.'">';
 $logoimg1 = '<img src="'.base_url().'public/uploads/settings/img/logo/'.$logoimg.'">';
// echo $logoimg1;exit;
$fname = $username['first_name'];
$lname = $username['last_name'];
$coursename=str_replace('%20',' ',$coursename);
$siteurl = base_url();
$coursemsg = (isset($cetificate_msg->certificate_course_msg)) ? $cetificate_msg->certificate_course_msg : 'ABC';
/*$imagename[0]["templates1"]  = str_replace("[SITENAME]", $_SERVER['SERVER_NAME'], $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[ACADEMY]", $institute_name, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_FIRST_NAME]", ucfirst($fname), $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_LAST_NAME]", ucfirst($lname), $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[SITEURL]", $siteurl, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[CERTIFICATE_ID]", $certificateid, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COMPLETION_DATE]", $date_completed, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_NAME]", ucfirst($coursename), $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[AUTHOR_NAME]", ucfirst($author_name), $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_MSG]", $coursemsg, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[LOGO_IMG]", $logoimg1, $imagename[0]["templates1"]);*/

// print_r($imagename);

$imagename[0]["templates1"]  = str_replace("[SITENAME]", $_SERVER['SERVER_NAME'], $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_NAME]", ucfirst($coursename), $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[ACADEMY]", $institute_name, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COMPLETION_DATE]", $date_completed, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_FIRST_NAME]", ucfirst($fname), $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[STUDENT_LAST_NAME]", ucfirst($lname), $imagename[0]["templates1"]);

$imagename[0]["templates2"]  = str_replace("[STUDENT_FIRST_NAME]", ucfirst($fname), $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[STUDENT_LAST_NAME]", ucfirst($lname), $imagename[0]["templates2"]);
$imagename[0]["templates1"]  = str_replace("[SITEURL]", $siteurl, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[CERTIFICATE_ID]", $certificateid, $imagename[0]["templates1"]);
$imagename[0]["templates2"]  = str_replace("[COMPLETION_DATE]", $date_completed, $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[ACADEMY_SIGNATURE]", 'ACADEMY_SIGNATURE', $imagename[0]["templates2"]);
$imagename[0]["templates2"]  = str_replace("[COURSE_NAME]", ucfirst($coursename), $imagename[0]["templates2"]);
$imagename[0]["templates1"]  = str_replace("[AUTHOR_NAME]", ucfirst($author_name), $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[COURSE_MSG]", $coursemsg, $imagename[0]["templates1"]);
$imagename[0]["templates1"]  = str_replace("[LOGO_IMG]", $logoimg1, $imagename[0]["templates1"]);
$imagename[0]["templates3"]  = str_replace("[STUDENT_FIRST_NAME]", ucfirst($fname), $imagename[0]["templates3"]);
$imagename[0]["templates3"]  = str_replace("[COMPLETION_DATE]", $date_completed, $imagename[0]["templates3"]);
$imagename[0]["templates3"]  = str_replace("[SITENAME]", $_SERVER['SERVER_NAME'], $imagename[0]["templates3"]);
$imagename[0]["templates3"]  = str_replace("[ACADEMY_SIGNATURE]", 'ACADEMY_SIGNATURE', $imagename[0]["templates3"]);
$imagename[0]["templates3"]  = str_replace("[COURSE_NAME]", ucfirst($coursename), $imagename[0]["templates3"]);

// print_r($imagename);
// echo $imagename[0]["templates1"];
?>

<table style="padding-left:90px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">
    <tr>
        <td>
        <?php echo $imagename[0]["templates1"]; ?>
        </td>
    </tr>
</table>

</div>

<?php
$content = ob_get_contents();
// print_r($content);exit;
ob_get_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>