<?php

  $CI =& get_instance();  
  $CI->load->model('admin/testimonials_model');  
  $CI->load->helper('text');  
  $gettestimonials=$CI->testimonials_model->getTestimonials();
  
if($resourcepage[0]['settings'])
{
  $settingarr=json_decode($resourcepage[0]['settings']);

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

?>
<!--
<div class="leftcontent">
    <h1><?php echo $resourcepage[0]['heading']?></h1>
    <?php echo $resourcepage[0]['content']?>
</div>
-->
<section class="extra">
        <div class="container">
            <div class="row-fluid">   
                    <div class="span8">
                   
                        <!--<h1><?php echo $resourcepage[0]['heading']?></h1>-->
                            <?php echo $resourcepage[0]['content']?>
                    </div>

                    <div class="span4" style="display: none;">
                    <h3>Graduates Testimonials</h3>
                    <!--<div class="carousel">-->
                    <div class="carousel" style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; height: 300px;">
                    <ul class="testimonials" style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1; height: 1500px; top: -800px;">
                    <?php $this->load->view(getOverridePath($tmpl,'testimonial','indexviews'));?>       
                    </ul>
                    </div>
                    <a href="#" class="navi-right next"></a>
                    <a href="#" class="navi-left prev"></a>
                    </div>
            </div>
          </div>
</section>

<!--<div class="contentright">
    <div class="rightsidebar">
            <div class="testimonial">    <h1><a href = '<?php echo base_url().'testimonials/alltestimonials'?>'>Testimonials</a></h1>    <?php foreach($gettestimonials as $gettestimonial){ ?>        <div class="tml">              <div style="padding-bottom: 20px;">                      <img src="<?php echo base_url(); ?>public/uploads/testimonials/img/thumb_56_56/<?php echo $gettestimonial->image; ?>" alt="" />                      <h6><?php echo $gettestimonial->name; ?></h6>                      <span class="tmdate"><?php echo date('M d Y',strtotime($gettestimonial->created_date)); ?></span>                      <?php echo character_limiter($gettestimonial->description,130); ?>              </div>        </div>        <div class="viewmore"><a href="<?php echo base_url(); ?>testimonials/view/<?php echo $gettestimonial->id;?>">View More>></a></div>    <?php } ?></div>
    </div>
</div>-->