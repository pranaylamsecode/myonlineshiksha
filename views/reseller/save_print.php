<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<style type="text/css">
	@media print {

	  	#printdiv {
			margin: 0;
			font-size: 28px !important;
			margin-bottom: 20px !important;
			font-weight: bold !important;
			width: 20% !important;
			text-align: center !important;
	  	}
	}
	/*.col-md-1{
		padding-right: 50px;
		padding-bottom: 20px;
		width: 20% !important;
		font-size: 20px !important;
		font-weight: bold;
	}*/
</style>
<script type="text/javascript">
	window.print();
</script>
<div style="width: 800px">
    <div class="row">
		<?php
		 if(!empty($coupon_data)){
			foreach ($coupon_data as $key) { ?>
			<div id="printdiv">
				<?php echo $key->coupon_code; ?>
			</div>
			<?php }
		}
		?>
	</div>
</div>