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
<style>
  .section{
    text-align: left;
  }
  .terms_tab li {
  /*display: block;*/
  float: left;
  width: 100%;
  text-align: left;
}
.terms_tab .nav > li > a {
  padding: 10px 15px;
  margin: 0px !important;
  border-bottom: 1px solid #ddd !important;
  color: #444 !important;
}
.terms_tab .nav > li.active > a {
  border: 0px;
  background: #002157;
  color: #fff !important;
}
#headtop2 .btn-icon {
  padding: 5px;
  margin: 0;
  position: absolute;
  right: 0px;
  top: 0;
}
footer{
  position: relative !important;
}
.top {
  padding: 10px 0px;
}
.terms_tab ul.nav.nav-tabs {
  border: 1px solid #ddd !important;
}
.terms_tab {
  display: inline-block;
  width: 100%;
  padding-bottom: 50px;
  padding-top: 50px;
}
.terms_tab .tab-content .tab-pane.active {
  border: 0px !important;
}
.terms_tab .tab-content .tab-pane {
  border: 0px !important;
}
header{
  border-bottom: 1px solid #ddd;
}
.sub-sect{
  font-style: italic;
}
</style>
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
    <h1 class="press-tittle story-title"><?php echo $resourcepage[0]['heading']?></h1>
  </div>
</div>
<!-- <section class="extra"> -->
<div class="container">
  <div class="terms_tab">
        <div class="col-sm-3">
            <ul class="nav nav-tabs tabs-left">
              <?php $tab = $this->session->userdata('page_tab'); ?>
                <li class="terms <?php echo $tab == 'terms' ? 'active' : '' ?> "><a href="<?php echo base_url();?>terms-of-use" >Terms of Use</a>
                </li>
                <li class="privacy <?php echo $tab == 'privacy' ? 'active' : '' ?>" ><a href="<?php echo base_url();?>privacy-policy">Privacy Policy & Cookie Policy</a>
                </li>
                <li class="agreement <?php echo $tab == 'agreement' ? 'active' : '' ?>"><a href="<?php echo base_url();?>agreement">Knowledge Partner Agreement</a>
                </li>
                <li class="resellers-terms-of-use <?php echo $tab == 'resellers-terms-of-use' ? 'active' : '' ?>"><a href="<?php echo base_url();?>resellers-terms-of-use">Reseller Agreement</a>
                </li>
                <li class="resellers-terms-of-use <?php echo $tab == 'terms-for-remote-internships' ? 'active' : '' ?>"><a href="<?php echo base_url();?>terms-for-remote-internships/">Terms for Remote Internships</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-8">
            <div class="tab-content" style="text-align: justify !important;">
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
        </div>
<!-- </section> -->

<?php 
$CI = & get_instance();
$CI->load->view('new_template_design/footer'); ?>
