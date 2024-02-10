<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style type="text/css">
.img-logo{
	position: fixed;
	background-color: rgba(255,255,255,0);
	height: 50px;
	z-index: 99999;
	top: 10px;
	left: 250px;
	margin: auto;
	width: 200px;
}
.img-logo img {
   width: auto;
   height: 100%;
}
.noanchor{
	display: none;
}

@media (max-width: 767px){
	.img-logo{
		position: fixed;
		background-color: rgb(255, 255, 255);
		height: 50px;
		z-index: 99999;
		top: 12px;
		left: 163px;
		margin: auto;
		width: 200px;
	}
	.img-logo img {
	   width: auto;
	   height: 100%;
	}
	iframe{
		display: none;
	}
	.noanchor{
		display: block;
	}
}s
</style>
<div class="iframe-container" style="/*overflow: hidden; padding-top: 56.25%; */position: unset;">
		<div class="img-logo">
			<img src="<?php echo base_url(); ?>public/uploads/settings/img/logo/<?php echo $logo;?>" class="img-responsive">
		</div>
    	<iframe allow="microphone; camera" style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;" src="<?php if($join_url == '0'){ echo 'https://zoom.us/wc/'.$start_url.'/start';}else{echo $join_url;} ?>" frameborder="0" onload=""></iframe>
    	<a id='meet_url' href="<?php if($join_url == '0'){ echo 'https://zoom.us/wc/'.$start_url.'/start';}else{echo $join_url;} ?>" class="noanchor"><?php if($join_url == '0'){ echo 'https://zoom.us/wc/'.$start_url.'/start';}else{echo $join_url;} ?></a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var vw  = $(document).width();
		if(vw <= 360){
			window.location.href = $("#meet_url").attr('href');
		}
	});
</script>