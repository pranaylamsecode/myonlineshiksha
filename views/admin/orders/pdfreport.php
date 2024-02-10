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
$title = "Order Invoice";
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
<?php
    $sessionarray = $this->session->userdata('loggedin');
        $user_id = $sessionarray['id'];
        $order_id  = $this->uri->segment(4) ;
         $orders = $this->users_model->getIndividualOrder($order_id);
?>
<div class="panel-heading" >
<div class="panel-title" style="border-bottom: 1px solid #ebebeb; float:none;margin-left: 36px;">
<h3>Order Invoice</h3>
<!--<p style="margin-left: 1120px;margin-top: -20px;"><a href="javascript:void(0)" onclick="openWinCertificate4();">PDF</a>--></p>
</div>

<div class="panel-body"> 
    <fieldset class="adminform" style="margin-left: 36px;">
        <div class="admintable form-horizontal form-groups-bordered">

        <div style="border-bottom: 1px solid #ebebeb;">
                <label>Order ID :</label>
                <label><?php echo $orders->id;?></label>
           </div>
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>User Name :</label>
                <label><?php echo $orders->first_name.' '.$orders->last_name; ?></label>
                  
            </div>

            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Course Name :</label>
                <label><?php echo $this->orders_model->getProgramName($orders->courses);?></label>
            </div>
            
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Order Date :</label>
                <label><?php echo $orders->order_date;?></label>
            </div>
            
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Order Status :</label>
                <label><?php echo $orders->status;?></label>
            </div>
            
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Total Amount :</label>
                <label><?php echo $orders->amount;?></label> 
            </div>
            
            
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Amount paid :</label>
                <label><?php echo $orders->amount_paid;?></label>
            </div>
            
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Currency :</label>
                <label><?php echo $orders->currency;?></label>
                   <?php  $signs= $this->settings_model->getCurrenciesign($orders->currency); ?>
                    <label style="margin-left: -192px;"><?php echo $signs ? '('.$signs->sign.')' : '';?></label>              
            </div>
            
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Promocodes :</label>
                <label><?php ?></label>
            </div>
            
            <div style="border-bottom: 1px solid #ebebeb;">
                <label>Payment Getway :</label>
                <label><?php echo $orders->processor;?></label>
            </div>
            <div>
                <label>Transaction ID :</label>
                <label><?php echo $orders->transactionid;?></label>
            </div>

            
        </div>
    </fieldset>
    
</div>  
</div>
<?php

    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>