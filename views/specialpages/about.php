<section class="container courses">
           <div class="row-fluid ">
            <?php
if($aboutpage[0]['settings'])
{
  $settingarr=json_decode($aboutpage[0]['settings']);
  $address=$settingarr->address;
  $phone=$settingarr->phone;
  $email=$settingarr->email;
  $weburl=$settingarr->weburl;
  $mapcode=$settingarr->mapcode;
}
else
{
    $address="";
    $phone="";
    $email="";
    $weburl="";
    $mapcode="";
}
//print_r($testimonials);
// $exec = exec('boxcutter -f image.png');
/*header("Content-type: image/png");
$im = imagegrabscreen();    
imagepng($im);
imagedestroy($im); 
exit(0);*/
?>
<!--<button id='ggg'>god</button>-->
<script type="text/javascript">
/*
    $("#ggg").on('click', function() {
    var docElement, request;

    docElement = document.documentElement;
    request = docElement.requestFullScreen || docElement.webkitRequestFullScreen || docElement.mozRequestFullScreen || docElement.msRequestFullScreen;

    if(typeof request!="undefined" && request){
        request.call(docElement);
    }
});


if (document.addEventListener)
{
    document.addEventListener('webkitfullscreenchange', exitHandler, false);
    document.addEventListener('mozfullscreenchange', exitHandler, false);
    document.addEventListener('fullscreenchange', exitHandler, false);
    document.addEventListener('MSFullscreenChange', exitHandler, false);
}

function exitHandler()
{
    //if (document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement !== null)
   $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange', fn);

}*/
</script>



<div class="col-sm-12">
<div class="span8" style="float:left;">
    <p><?php echo $aboutpage[0]['content']?></p>
</div>
<?php

$CI =& get_instance();
  $CI->load->model('admin/settings_model');
  $getItemssetting = $CI->settings_model->getItems();
  $currenttemplate = $getItemssetting[0]['layout_template'];
  $settings = $CI->settings_model->getTemplateById($currenttemplate);
  $data11 = $settings[0]['options'];
  $data = json_decode($data11);
// echo"<pre>";
// print_r($data);

$CI =& get_instance();
          $CI->load->model('admin/settings_model');
          $getTestimonial = $CI->settings_model->getTestimonial();

          $numOfTestinomial = count($getTestimonial);


          if($getTestimonial)
                  {
                    
           if($data->testimonial_enable == 'true')
           {

?>
<div class="span4 extra" style="background-color: transparent;">
  <h3><?php echo $data->testimonial_name ?></h3>
  <!--<div class="carousel">-->
  <div class="<?php if($numOfTestinomial > 2) { echo 'carousel'; } ?>" style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; height: 300px;">
  <ul class="testimonials" style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1; height: 1500px; <?php if($numOfTestinomial > 2) { echo 'top: -800px'; } ?>">
  <?php $this->load->view(getOverridePath($tmpl,'testimonial','indexviews'));?>       
  </ul>
  </div>
  <a href="#" class="navi-right next"></a>
  <a href="#" class="navi-left prev"></a>
</div>
<?php
}
}
?>
</div>

<!--
<div class="span4">
    <div class="rightsidebar extra">
                <h1>Testimonials</h1>
        <div class="carousel">
            <ul class="testimonials">
                <?php foreach($testimonials as $testimonial){ ?>
                    <li class="tml">
                          <div>
                                  <a href="<?php echo base_url(); ?>testimonials/view/<?php echo $testimonial->id;?>">
                                    <img src="<?php echo base_url(); ?>public/uploads/testimonials/img/thumb_56_56/<?php echo $testimonial->image; ?>" alt="" />
                                  </a>
                                  <?php //echo $testimonial->name; ?>
                                  
                                  <h5><?php echo character_limiter($testimonial->description,130); ?></h5>
                                  
                          </div>
                    </li>

                <?php } ?>
            </ul>
        </div>
    </div>
</div>-->
<!--<span class="tmdate"><?php echo date('M d Y',strtotime($testimonial->created_date)); ?></span>-->
<!--<div class="viewmore">View More>></div>-->
</div>
</section>
