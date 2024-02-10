<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div class="panel-heading" >
<div class="panel-title" style="border-bottom: 1px solid #ebebeb; float:none;">
Order Invoice
<!--<p style="margin-left: 1094px;margin-top: -20px;"> <a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="http://www.create-online-academy.com/public/default/images/email.png" title="Email this certificate"></a></p>-->
<p style="margin-left: 1120px;margin-top: -35px;"><a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="<?php echo base_url(); ?>/public/default/images/download.png" title="Download your Order Invoice as PDF"></a></p>
</div>

<div class="panel-body"> 
	<fieldset class="adminform">
		<div class="admintable form-horizontal form-groups-bordered">
<?php
$sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
        $order_id  = $this->uri->segment(3) ; 
        $orders = $this->orders_model->viewOrder($user_id,$order_id); 
?>
		<div style="border-bottom: 1px solid #ebebeb;">
				<label>Order ID :</label>
				<label><?php echo $orders->id;?></label>
				<input type="hidden" value="<?php echo $orders->id;?>" id="orderid">
           </div>
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>User Name :</label>
				<label><?php echo $orders->first_name.' '.$orders->last_name; ?></label>
                 <input type="hidden" value="<?php echo $orders->first_name.' '.$orders->last_name; ?>" id="username"> 
			</div>

			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Course Name :</label>
				<label><?php echo $this->orders_model->getProgramName($orders->courses);?></label>
				<input type="hidden" value="<?php echo $this->orders_model->getProgramName($orders->courses);?>" id="coursename">
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
				    <label style="margin-left: -192px;">(<?php echo $signs ? $signs->sign : '';?>)</label>				
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Promocodes :</label>
				<label><?php if(!empty($orders->promocodeid)){
                        $promos = $this->orders_model->get_promos($orders->promocodeid);
                        echo $promos->code;
                        }else{ echo "N/A";} ?></label>
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

<div class="panel-heading" >
<div class="panel-title" style="border-bottom: 1px solid #ebebeb; float:none;">
Send Mail
<!--<p style="margin-left: 1094px;margin-top: -20px;"> <a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="http://www.create-online-academy.com/public/default/images/email.png" title="Email this certificate"></a></p>-->
<p style="margin-left: 1120px;margin-top: -35px;"><a href="javascript:void(0)" onclick="openWinCertificate4(<?php echo $this->uri->segment(3); ?>);"><img align="viewed" src="<?php echo base_url(); ?>/public/default/images/download.png" title="Download your Order Invoice as PDF"></a></p>
</div>
<fieldset>
<div class="admintable form-horizontal form-groups-bordered">
<form  action="#" method="post">
			<div style="border-bottom: 1px solid #ebebeb;">

				<label>Email to:</label>
				<input type="text" name ="sendto" id ="sendto" class="form-control" />
            </div>
			
			<div style="border-bottom: 1px solid #ebebeb;">
				<label>Personal Message: :</label>
				<textarea name="msgbody" id="msgbody"></textarea>
            </div>
            <div>
				
				<input type="button" value="send" name="send" onclick="sendOrderMail(<?php echo $orders->id;?>);" >
            	<label id="sendmsg"></label>
            </div>
            </form>
            </div>
            </fieldset>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  -->
<script>
	function sendOrderMail(id)
	{
		var sendto = document.getElementById("sendto").value;

		var msgbody = document.getElementById("msgbody").value;
		var orderno = document.getElementById("orderid").value;
		var username = document.getElementById("username").value; 
		var coursename = document.getElementById("coursename").value;  
		//alert(orderno);
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>orders/orderMail/"+id,			
			data: {sendto:sendto,msgbody:msgbody,orderno:orderno,coursename:coursename,username:username}, 
			success: function(response)
			{	
				//alert(response);	
				$("#sendmsg").html('<p style="color:green">Mail Send successfully</p>');				
			}
		  		});
	}
</script>

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
    $sessionarray = $this->session->userdata('logged_in');
        $user_id = $sessionarray['id'];
        $order_id  = $this->uri->segment(3) ;
         $orders = $this->orders_model->viewOrder($user_id,$order_id);
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
                    <label style="margin-left: -192px;">(<?php echo $signs ? $signs->sign : '';?>)</label>              
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
    $newFile  = FCPATH.'public/uploads/orderpdf/pdf_no_'.$orders->id.'.pdf';
    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
//$obj_pdf->Output('output.pdf', 'I');
$obj_pdf->Output($newFile, 'F');
?>