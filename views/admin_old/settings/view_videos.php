<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/emailsetting', $attributes) : form_open_multipart(base_url().'admin/settings/emailsetting');



?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/videogallery/css/main.css"> 
    
<style type="text/css">
	.ptxt
	{
		font-size: 15px;
	}
	.btxt
	{
	font-size: 15px;	
	}
</style>


<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title" style="font-size: 16px;">
				How-To Video Tutorials
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">				
				
	<section class="clearfix">      

    <div class="row">

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/jj0hczy7zbg"><img class="videoThumb" src="https://i.ytimg.com/vi_webp/jj0hczy7zbg/mqdefault.webp"></a>
        </figure>
        <h2 class="videoTitle"><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/jj0hczy7zbg">How to Set Up the General and Payment Settings of Your Online Academy</a></h2>
      </article>

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/RWzXZMgV6iw"><img class="videoThumb" src="//i.ytimg.com/vi_webp/RWzXZMgV6iw/mqdefault.webp"></a>
        </figure>
        <h2 class="videoTitle"><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/RWzXZMgV6iw">How to Design Certificates in Your Online Academy</a></h2>
      </article>
      
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/KY5HWquuf9o"><img class="videoThumb" src="//i.ytimg.com/vi_webp/KY5HWquuf9o/mqdefault.webp"></a>
        </figure>
        <h2 class="videoTitle"><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/KY5HWquuf9o">How to Change the Roles of Users</a></h2>
      </article>

    </div>

    <div class="row">
      
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/kNRY2VsLebw"><img class="videoThumb" src="//i.ytimg.com/vi_webp/kNRY2VsLebw/mqdefault.webp"></a>
        </figure>
        <h2 class="videoTitle"><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/kNRY2VsLebw">How To Upload and Save Media</a></h2>
      </article>
      
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/uy9wQbICZ7o"><img class="videoThumb" src="//i.ytimg.com/vi_webp/uy9wQbICZ7o/mqdefault.webp"></a>
        </figure>
        <h2 class="videoTitle"><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/uy9wQbICZ7o">How to Create Questions in Your Online Academy</a></h2>
      </article>

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/6p_qsvdZkfM"><img class="videoThumb" src="//i.ytimg.com/vi_webp/6p_qsvdZkfM/mqdefault.webp"></a>
        </figure>
        <h2 class="videoTitle"><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/6p_qsvdZkfM">How to Create An Exam in Your Online Academy</a></h2>
      </article>

      </div>

      <div class="row">
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/JieRcwqaxGQ"><img class="videoThumb" src="//i.ytimg.com/vi_webp/JieRcwqaxGQ/mqdefault.webp"></a>
        </figure>
        <h2 class="videoTitle"><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/JieRcwqaxGQ">Creating a Course with Embedded Webinar</a></h2>
      </article>

      </div>
  

    </section>
				

			</div>
		
		</div>
	
	</div>




    <!-- <input type="hidden" value="1" name="id"> -->



	<!-- <input type="hidden" value="5" name="tab"> -->



<?php echo form_close(); ?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/videogallery/js/jquery.fancybox.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/videogallery/js/global.min.js"></script>