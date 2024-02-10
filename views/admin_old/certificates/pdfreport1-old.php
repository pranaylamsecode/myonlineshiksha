<?php
//define('BGR_IMG', $imagename[0]["design_background"]);

$auth = $this->session->userdata('setarray');
print_r($temparray); exit("me33");
 
define('BGR_IMG', $auth['certibg']);
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

        $img_file = base_url().'public/uploads/settings/img/'.BGR_IMG;
        //$img_file = base_url().'public/uploads/settings/img/Cert-green-seal-color-back-no-seal.png';
        //$this->Image($img_file, 0, 0, 200, 175, '', '', '', false, 50, '', false, false, 0); // on date 19-09-2015
        //$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        $this->Image($img_file, 0, 0, 300, 210, '', '', '', false, 100, '', false, false, 0);
        // restore auto-page-break status
        //$img_file = base_url().'public/uploads/settings/img/'.BGR_IMG;

        //$this->Image($img_file, 0, 0, 200, 175, '', '', '', false, 50, '', false, false, 0);

        $this->SetAutoPageBreak($auto_page_break, $bMargin);

        // set the starting point for the page content

        $this->setPageMark();

    }

}
$obj_pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('certfont');
$obj_pdf->SetHeaderMargin(0);
$obj_pdf->SetFooterMargin(0);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetMargins(12, 0, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('certfont', 'B', 15);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage('L', 'A4');
ob_start();
?>  
<?php 
$CI =& get_instance();
$CI->load->model('admin/settings_model');
$configarr = $this->settings_model->getItems();
$institute_name = $configarr[0]['institute_name'];
$logoimg = $configarr[0]['logoimage'];

// exit('anisha');
?>
<?php $logoimg1 = '<img src="'.base_url().'public/uploads/settings/img/logo/'.$logoimg.'">'?>
<!--
<div style="background-repeat:no-repeat; background-image:url(<?php echo FCPATH ?>/public/uploads/settings/img/Cert-orange--color-back-no-seal.png);"> 
    <?php
    $auth = $this->session->userdata('certificatedata');
    $auth['descript']  = str_replace("[STUDENT_FIRST_NAME]", 'Johny', $auth['descript']);
    $auth['descript']  = str_replace("[STUDENT_LAST_NAME]", 'Walker', $auth['descript']);
     $auth['descript']  = str_replace("[COURSE_NAME]", 'Sociology', $auth['descript']);
      $auth['descript']  = str_replace("[ACADEMY]", 'Oxford University', $auth['descript']);
       $auth['descript']  = str_replace("[COMPLETION_DATE]", '2015-12-20', $auth['descript']);
     $auth['descript']  = str_replace("[SITENAME]", 'oxforduniversity.com', $auth['descript']);
       $auth['descript']  = str_replace("[AUTHOR_NAME]", 'Rossy Parera', $auth['descript']);
   
    ?>    
</div> -->
    <div style="background-repeat:no-repeat; background-image:url(<?php echo FCPATH ?>/public/uploads/settings/img/Cert-orange--color-back-no-seal.png);"> 

    <?php  
        $auth = $this->session->userdata('certificatedata');
    $auth['descript']  = str_replace("[STUDENT_FIRST_NAME]", 'Student First Name', $auth['descript']);
    $auth['descript']  = str_replace("[STUDENT_LAST_NAME]", 'Student Last Name', $auth['descript']);
     $auth['descript']  = str_replace("[COURSE_NAME]", 'Course Name', $auth['descript']);
      $auth['descript']  = str_replace("[ACADEMY]", $institute_name, $auth['descript']);
       $auth['descript']  = str_replace("[COMPLETION_DATE]", '2015-12-20', $auth['descript']);
     $auth['descript']  = str_replace("[SITENAME]", $institute_name.'.com', $auth['descript']);
       $auth['descript']  = str_replace("[AUTHOR_NAME]", 'Author Name', $auth['descript']);
   $auth['descript']  = str_replace("[LOGO_IMG]", $logoimg1, $auth['descript']);
    ?>    
</div>
<table style="padding-left:90px; color:<?php echo "#".$auth["design_text_color"]; ?>">
    <tr>
        <td>
        <?php echo nl2br($auth['descript']); ?>
        </td>
    </tr>
</table>

<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>
