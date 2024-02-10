<!DOCTYPE html>
<html>
<head>
	<title>Reseller QR-code</title>
</head>
<body>
<div style="margin-left: auto; margin-right: auto; padding-top: 20px; height: 465px; width: 330px; border: 1px solid; border-radius: 5px;">
	<center>
		<h3>MyOnlineShiksha.com</h3>
		<h4><?php echo ucfirst($name); ?><hr></h4>
		<span>to join, scan this QR-code</span>
		<img src="<?php echo base_url()?>public/uploads/resellers_QR/<?php echo $img;?>" height="328px" width="328px">
	</center>
</div>


<script type="text/javascript">
	window.print();
</script>
</body>
</html>