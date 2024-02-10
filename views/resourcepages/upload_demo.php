<!-- <form method="post" action="<?php echo base_url();?>demo/upload" enctype="multipart/form-data">
	<input type="file" name="table_file"> 
	<button type="submit" class="btn btn-success">Restore</button>
</form> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/css/font-icons/entypo/css/entypo.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/courses_css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.4.8/plyr.css">  
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<!-- <script src="<?php echo base_url();?>js/player.js-master/src/player.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">

</style>
<script>

// $(document).ready(function(){
	var options = {
			url: 'https://vimeo.com/<?php echo $video_id.'/'.$video_hash;?>',
            // url: 'https://player.vimeo.com/video/'+video,
			loop: true,
			seekTo: 2
	};
    console.log(options);
    var madeInNy = new Vimeo.Player('made-in-ny', options);
    // madeInNy.on("pause", onPause);
// });
function view_video(){
	var video_id = $("#video_id").val();
	// $("made-in-ny"+video_id).css('display','block');
	$(".btn-info").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
	$.ajax({
		type : "post",
		cache : false,
		url: "<?php echo base_url();?>demo/upload/",
		data : {video_id : video_id},
		success : function(video_hash){
			$(".made-in-ny").remove();
			$(".video-divs").html('<div data-vimeo-defer class="made-in-ny" id="made-in-ny'+video_id+'"></div>');
			$(".btn-info").html('View Next');
			$(".err_id_1").html('https://vimeo.com/'+video_id+'/'+video_hash);
			var options = {
				url: 'https://vimeo.com/'+video_id+'/'+video_hash,
	            // url: 'https://player.vimeo.com/video/'+video,
				loop: true,
				seekTo: 2
			};
		    console.log(options);
		    var madeInNy = new Vimeo.Player('made-in-ny'+video_id, options);
		    // madeInNy.on("pause", onPause);
		}
	});
}
function err_view_video(){
	var video_id = $("#video_id_1").val();
	// $("made-in-ny"+video_id).css('display','block');
	// $(".btn-info").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
	var options = {
				// url: 'https://vimeo.com/'+video_id+'/'+video_hash,
	            url: 'https://player.vimeo.com/video/'+video_id,
				loop: true,
				seekTo: 2
			};
		    $(".err_id_2").html('https://player.vimeo.com/video/'+video_id);
		    var madeInNy = new Vimeo.Player('made-in-my', options);
}
</script>
<div class="container" style="padding-top: 20px;height: 400px;">
	<div class="col-sm-6">
		<label>Option 1: loading video using video ID with Hash</label>
		<input type="text" id="video_id" value="348615922">
		<button class="btn btn-info" onclick="return view_video()">Load Video</button>
		<h4 class="err_id_1"></h4>
		<div class="video-divs">
			<div data-vimeo-defer id="made-in-ny"></div>
		</div>
	</div>
	<div class="col-sm-6">
		<label>Option 2: loading video using video ID without Hash</label>
		<input type="text" id="video_id_1" value="348615922">
		<button class="btn btn-default" onclick="return err_view_video()">Load Video</button>
		<div class="video-divs_1">
			<div data-vimeo-defer id="made-in-my"></div>
			<h4 class="err_id_2"></h4>
		</div>
	</div>
</div>