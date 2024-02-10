<?php 
$CI = & get_instance();
$CI->load->view('new_template_design/header'); ?>
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
<div class="container-fluid banner-section_story">
  <nav class="navbar" id="banner_menu">
    <ul class="nav navbar-nav upper-menu">
      <li class="active"><a href="<?php echo base_url() ?>">Home</a></li>
      <li ><a href="<?php echo base_url() ?>about">About Us</a></li>
      <li><a href="<?php echo base_url() ?>category/courses">Course</a></li>
      <li><a href="<?php echo base_url() ?>blog">Blog</a></li>
      <!-- <li><a href="<?php echo base_url() ?>career">Career</a></li> -->
      <!-- <li><a href="<?php echo base_url() ?>category/press">Press</a></li> -->
      <li><a href="<?php echo base_url() ?>become-a-teacher">Teaching</a></li>
    </ul>
  </nav> 

  <div class="section-text press-head">
    <h1 class="press-tittle story-title">Terms Of Use</h1>
  </div>
</div>
<section class="extra">
        <div class="container privacy_container">
            <div class="row-fluid">   
                    <div class="col-sm-12 terms_of_use">
                        <!--<h1><?php echo $resourcepage[0]['heading']?></h1>-->
                            <?php echo $resourcepage[0]['content']?>
                    </div>

                    <div class="col-sm-4" style="display: none;">
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
<?php 
$CI = & get_instance();
$CI->load->view('new_template_design/footer'); ?>

<style type="text/css">
</style>