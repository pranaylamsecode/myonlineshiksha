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
		
		<div class="panel panel-primary" data-collapsed="0" >
		
			<div class="panel-heading">
				<div class="panel-title" style="font-size: 16px;">
				Help To Manage Academy
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
        <a class="fancybox fancybox.iframe" href="<?php echo base_url(); ?>admin/settings/manage_setup_new"><img class="videoThumb" src="https://secure-b.vimeocdn.com/ts/178/010/178010767_295.jpg"></a>
        </figure>
        <h2 class="videoTitle">How to Manage the Set up of Your Academy</h2>
      </article>

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="<?php echo base_url(); ?>admin/settings/manage_design_new"><img class="videoThumb" src="https://secure-b.vimeocdn.com/ts/178/010/178010767_295.jpg"></a>
        </figure>
        <h2 class="videoTitle">How to Design Your Academy</h2>
      </article>
      
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="<?php echo base_url(); ?>admin/settings/create_blogs_new"><img class="videoThumb" src="http://i1.ytimg.com/vi/paG__3FBLzI/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">How to Create A Blog</h2>
      </article>
      </div>
            <div class="row">
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="<?php echo base_url(); ?>admin/settings/create_page_new"><img class="videoThumb" src="http://i1.ytimg.com/vi/OF9fneQ50Us/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">How to Create A Page</h2>
      </article>
      </div>
      
      <!-- <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="//www.youtube.com/embed/1swsXJuclGM"><img class="videoThumb" src="http://i1.ytimg.com/vi/1swsXJuclGM/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">Bodrum</h2>
      </article>

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="//www.youtube.com/embed/WQ3Gf9PLUO8"><img class="videoThumb" src="http://i1.ytimg.com/vi/WQ3Gf9PLUO8/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">Mesopotamia</h2>
      </article>

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="//player.vimeo.com/video/7533229"><img class="videoThumb" src="https://secure-b.vimeocdn.com/ts/326/392/32639200_295.jpg"></a>
        </figure>
        <h2 class="videoTitle">Symhpony in Red</h2>
      </article>

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="//www.youtube.com/embed/bYy1yKqspYs"><img class="videoThumb" src="http://i1.ytimg.com/vi/bYy1yKqspYs/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">Paganini Jazz</h2>
      </article>
      
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="//www.youtube.com/embed/02bxAzWn0JM"><img class="videoThumb" src="http://i1.ytimg.com/vi/02bxAzWn0JM/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">Piano Concerto No.3</h2>
      </article>
      
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="//www.youtube.com/embed/uj158c_4e0M"><img class="videoThumb" src="http://i1.ytimg.com/vi/uj158c_4e0M/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">Rhapsody in Blue</h2>
      </article>

      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="//www.youtube.com/embed/kIxech_-msA"><img class="videoThumb" src="http://i1.ytimg.com/vi/kIxech_-msA/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">Concerto G-Dur</h2>
      </article>
      
      <article class="video">
        <figure>
        <a class="fancybox fancybox.iframe" href="http://www.create-online-academy.com/admin/settings/help_to_manage_academy"><img class="videoThumb" src="http://i1.ytimg.com/vi/_ZSefvtdYiY/mqdefault.jpg"></a>
        </figure>
        <h2 class="videoTitle">Paganini Variations</h2>
      </article> -->

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