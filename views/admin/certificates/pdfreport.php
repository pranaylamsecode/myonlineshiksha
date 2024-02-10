<?php

  define('BGR_IMG', $imagename[0]["design_background"]);

  tcpdf();



  class MYPDF extends TCPDF {

    //Page header
      

    public function Header() {

        // get the current page break margin

               
 
        $bMargin = $this->getBreakMargin();

        // get current auto-page-break mode

        $auto_page_break = $this->AutoPageBreak;

        // disable auto-page-break

        $this->SetAutoPageBreak(false, 0);



        // set bacground image
       
    
        //$img_file = K_PATH_IMAGES.'Cert-Blue-seal-color-back.png';
        $img_file = base_url().'public/uploads/settings/img/'.BGR_IMG;

        $this->Image($img_file, 0, 0, 200, 175, '', '', '', false, 50, '', false, false, 0);

        // restore auto-page-break status

        $this->SetAutoPageBreak($auto_page_break, $bMargin);

        // set the starting point for the page content

        $this->setPageMark();

    }

  
}






$obj_pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$obj_pdf->SetCreator(PDF_CREATOR);



$title = "Course Completion Certificate";

$obj_pdf->SetTitle($title);

$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);

$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$obj_pdf->SetDefaultMonospacedFont('helvetica');

//$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$obj_pdf->SetHeaderMargin(0);

//$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$obj_pdf->SetFooterMargin(0);

///$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

$obj_pdf->SetMargins(12, 0, PDF_MARGIN_RIGHT);

$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$obj_pdf->SetFont('times', 'B', 15);

$obj_pdf->setFontSubsetting(false);

$obj_pdf->AddPage();

ob_start();



// we can have any view part here like HTML, PHP etc

//$obj_pdf->setJPEGQuality(75);

//$image_theme = $imagename[0]["design_background"];

//echo $image_theme = base_url()."public/uploads/settings/img/".$image_theme;

   $CI =& get_instance();
    $CI->load->model('admin/settings_model');
    $configarr = $this->settings_model->getItems();
    $institute_name = $configarr[0]['institute_name'];
$logoimg = $configarr[0]['logoimage'];?>
<?php $logoimg1 = '<img src="'.base_url().'public/uploads/settings/img/logo/'.$logoimg.'">'?>




<?php
//$fname = $username[0]['first_name'];

//$lname = $username[0]['last_name'];

//$coursename=str_replace('%20',' ',$coursename);

$siteurl = base_url();

$coursemsg = (isset($cetificate_msg->certificate_course_msg)) ? $cetificate_msg->certificate_course_msg : 'ABC';

$imagename[0]["templates1"]  = str_replace("[SITENAME]", 'SITENAME', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[INSTITUTE]", 'INSTITUTE', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[STUDENT_FIRST_NAME]", 'STUDENT', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[STUDENT_LAST_NAME]", 'STUDEE', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[SITEURL]", 'SITEURL', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[CERTIFICATE_ID]", 'CERTIE_ID', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[COMPLETION_DATE]", 'COMPLETITE', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[COURSE_NAME]", 'COURSE_NAME', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[AUTHOR_NAME]", 'AUTHOR_NAME', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[COURSE_MSG]", 'COURSE_MSG', $imagename[0]["templates1"]);

$imagename[0]["templates1"]  = str_replace("[LOGO_IMG]", $logoimg1, $imagename[0]["templates1"]);

?>





<table>

    <tr>

        <td  style="padding-top:0; padding-left:200px; color:<?php echo "#".$imagename[0]["design_text_color"]; ?>">

        <?php echo $imagename[0]["templates1"]; ?>

   </td>

    </tr>

</table>

</div>

<?php





$content = ob_get_contents();


ob_end_clean();

$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('output.pdf', 'I');

?>