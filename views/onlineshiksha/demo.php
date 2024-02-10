<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div style="margin-left: auto; margin-right: auto; padding-top: 20px; height: 350px; width: 250px; border: 1px solid; border-radius: 5px;">
	<center>
		<h3>MyOnlineShiksha.com</h3>
		<h4><?php echo $name; ?><hr></h4>
		<span>to join, scan this QR-code</span>
		<img src="<?php echo base_url()?>public/uploads/resellers_QR/<?php echo $img;?>" height="200px" width="200px">
	</center>
</div>
</body>
</html>