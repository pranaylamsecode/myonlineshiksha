<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
</head>
	<style type="text/css">
	@media print {
	    table, tr, th, td{
	    	-webkit-print-color-adjust: exact; 
	    }
	    div
	    {
			page-break-after: always;
		}
	}
	p{
		margin: 10px;
	}
	</style>
	<body>
		<table cellpadding="0px" cellspacing="0px" align="center" width="800px" style="border:1px solid #000;font-family: sans-serif;">
			<tr>
				<td style="border-bottom:1.5px solid #000;padding-top: 5px !important;padding-bottom: 0px !important;text-align: center;">
					<span style="text-transform: capitalize;padding-left: 150px;">Brijlal Biyani Science College</span>
					<span style="float: right;padding-right: 10px;">Date: <?php echo date('d-m-Y',strtotime($exam_details->release_date));?></span>
					<p style="font-size: 20px;padding-left: 80px;"><?php echo ucwords($exam_details->exam_title);?> &nbsp;<span style="font-size: 15px;">(<?php echo ucwords($exam_details->course_name);?>)</span>
						<span style="font-size: 15px;float: right;">Marks: <?php echo $exam_details->total_marks;?></span></p>
					<p><?php echo ucwords($exam_details->parentCat.' - ('.$exam_details->subcat.')');?></p>
				</td>
			</tr>
			<?php
			$i = 1;
			foreach ($exam_Ques as $key){ ?>
			<tr>
				<td style="padding-top: 5px !important;padding-bottom: 0px !important;" id="que_td">
				<?php echo $key->que_title;?>
				<u style="padding-left: 4%;">Options (<?php echo $key->que_type;?>):</u>
				<?php $options = json_decode($key->options);
		          	$no = 1;
		          foreach ($options as $key) {
		            foreach ($key as $key1) { ?>
		              <p style="padding-left: 10%"><?php echo $no.') &nbsp;&nbsp; '.$key1; ?></p>
		           <?php $no++;}
		          }
				?>

				</td>
			</tr>
			<?php $i++;} ?>
		</table>
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#que_td p:first-child').prepend('Q. ');
		window.print();
	});
</script>