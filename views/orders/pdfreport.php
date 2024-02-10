<?php defined('BASEPATH') OR exit('No direct script access allowed');
tcpdf();
class MYPDF extends TCPDF {
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
$obj_pdf->SetFont('helvetica', '', 9,'',true);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
?>
<?php
    $sessionarray = $this->session->userdata('logged_in');
    $user_id = $sessionarray['id'];
    $order_id  = $this->uri->segment(3) ;
    $orders = $this->orders_model->viewOrder($user_id,$order_id);
    $course = $this->orders_model->getProgramName($orders->courses);
    $signs = $this->settings_model->getCurrenciesign($orders->currency);
?>

<table>
    <tr>
        <td style="font-size: 12px;font-weight: bold; border-bottom: 1px solid thin">Receipt - <?php echo date('M. d, Y', strtotime($orders->order_date));?><br></td>
    </tr><br>
    <tr>
        <td style="width: 70%;border-bottom: 1px solid thin;">
            <span style="font-size: 13px;font-weight: bold">MyOnlineShiksha</span><br>
            <span style="font-size: 11px;">5th floor, Sadoday Complex,<br>
    Near Darodkar Chowk, Central Avenue Road,<br>
    Darodkar Chowk, Nagpur,<br>
    Maharashtra 440002.<br>
    <a href="">myonlineshiksha.com</a><br>
            </span>
        </td>
        <td style="border-bottom: 1px solid thin; font-size: 12px;">
            <span><b>Date :</b>  <?php echo date('M. d, Y', strtotime($orders->order_date));?></span><br>
            <span><b>Order ID: </b><?php echo $orders->id;?></span>
        </td>
    </tr><br>
    <tr>
        <td style="font-size: 12px; border-bottom: 1px solid thin;width: 100%">
            <span><b>Sold to: </b><span><?php echo $orders->first_name.' '.$orders->last_name; ?></span></span><br>
        </td>
    </tr><br>
    <tr>
        <td style="font-size: 11px; width: 100%">
            <table width="100%" style="padding-top: 10px">
                <tr>
                    <td style="font-size: 10px; border-bottom: 1px solid thin; font-weight: bold;width: 36%">Course Name<br></td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin; font-weight: bold; width: 16%">Order Date<br></td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin; font-weight: bold; width: 16%">Coupon Code<br></td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin; font-weight: bold; width: 16%">Price<br></td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin; font-weight: bold; width: 16%">Amount<br></td>
                </tr>
                <tr>
                    <td style="font-size: 10px; border-bottom: 1px solid thin;width: 36%;height: 200px; font-family: Hindi Sans">
                        <?php echo $course->name;?>
                    <br>
                    </td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin;width: 16%">
                        <?php echo date('M. d, Y', strtotime($orders->order_date));?>
                    <br>
                    </td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin;width: 16%">
                        <?php if(!empty($orders->promocodeid)){
                        $promos = $this->orders_model->get_promos($orders->promocodeid);
                        echo $promos->code;
                        }else{ echo "N/A";}
                        ?> 
                    <br>
                    </td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin;width: 16%">
                        <span style="font-family: DejaVu Sans;"><?php echo $signs->sign;?> </span>
                        <?php echo number_format($course->fixedrate,2);?>
                    <br>
                    </td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin;width: 16%">
                    <span style="font-family: DejaVu Sans;"><?php echo $signs->sign;?> </span>
                        <?php echo number_format($course->fixedrate,2);?>
                    <br>
                    </td>
                </tr>
            </table>
            <table width="100%" style="padding-top: 10px;">
                <tr>
                    <td style="font-size: 10px; width: 68%"></td>
                    <td style="font-size: 10px; width: 16%">
                        <b>Total</b>
                    </td>
                    <td style="font-size: 10px;width: 16%">
                        <span style="font-family: DejaVu Sans;"><?php echo $signs->sign;?> </span>
                        <?php echo number_format($course->fixedrate,2);?><br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10px; width: 68%"></td>
                    <td style="font-size: 10px; width: 16%">
                        <b>Discount</b>
                    </td>
                    <td style="font-size: 10px;width: 16%">
                        <span style="font-family: DejaVu Sans;">
                            <?php if(!empty($orders->promocodeid)){
                            $promos = $this->orders_model->get_promos($orders->promocodeid);
                            echo $signs->sign." ".$promos->discount;
                            }else{ echo "0";} ?>
                        </span>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10px; border-bottom: 1px solid thin; width: 68%"></td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin; width: 16%">
                        <b>Total Amount</b>
                    </td>
                    <td style="font-size: 10px; border-bottom: 1px solid thin;width: 16%">
                        <span style="font-family: DejaVu Sans;"><?php echo $signs->sign;?> </span>
                        <?php echo number_format($orders->amount,2);?><br>
                    </td>
                </tr>
            </table>
        </td>
    </tr><br>
    

</table>


<?php
    $newFile  = FCPATH.'public/uploads/orderpdf/pdf_no_'.$orders->id.'.pdf';
    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
//$obj_pdf->Output($newFile, 'F');
?>