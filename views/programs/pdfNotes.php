<?php defined('BASEPATH') OR exit('No direct script access allowed');
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

        
        //$img_file = base_url().'public/uploads/settings/img/Cert-Blue-seal-color-back.png';

        //$this->Image($img_file, 0, 0, 200, 175, '', '', '', false, 50, '', false, false, 0);

        // restore auto-page-break status

        $this->SetAutoPageBreak($auto_page_break, $bMargin);

        // set the starting point for the page content

        $this->setPageMark();

    }

}


$obj_pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Notes";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
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
?>
<style>
.notes2{
  color:red;
}

</style>
<h1 class="notes2" id="notes1"> Notes</h1>


<?php
$CI = & get_instance();
    $CI->load->model('program_model');
    //$sessionarray = $this->session->userdata('logged_in');
        //$user_id = $sessionarray['id'];
        $order_id  = $this->uri->segment(3);
        $sessionarray = $this->session->userdata('logged_in');
        $userid = $sessionarray['id'];

                $programs = $this->program_model->getProgram($order_id);
                  echo"<h1><b>".$programs->name."</b></h1>";
                $days = $this->program_model->getlistDays($order_id);

                foreach ($days as $day)
                {
                   echo"<h3>".$day->title."</h3>";
                   
                    $lessons = $this->program_model->getLessons($day->id);
                    echo"<ol type ='A'>";
                    foreach ($lessons as $lesson)
                    {
                        
                      echo"<li><b>".$lesson->name."</b>";                      

                      $lectures = $CI->program_model->getNotesSection_model($order_id,$lesson->id,$userid);
                          echo"<ol>";
                          foreach ($lectures as $key)
                          {
                           
                           echo"<li>";
                          echo $key->notes; 
                          echo"</li>";
                             
                           }
                           echo"</ol>";
                       echo"</li>";
                           
                   }
                   echo"</ol>";
                   
                   
               }

          
?>


<?php

    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>