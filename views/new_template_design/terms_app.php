
<style>
  #section-sidenavbar-responsive{
    display: none!important;
  }
   .footer_main{
    display: none!important;
  }
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

.banner-section_story {
    background: linear-gradient(rgba(17, 16, 16, 0.6), rgba(0, 0, 0, 0.36)), url(https://myonlineshiksha.com/public/new_template/images/mosbg1.jpg);
    background-size: cover;
    height: 296px;
}
</style>
<link rel="stylesheet" href="https://myonlineshiksha.com/public/new_template/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">

<!--
<div class="leftcontent">
    <h1><?php echo $resourcepage[0]['heading']?></h1>
    <?php echo $resourcepage[0]['content']?>
</div>
-->
<?php 
$CI = & get_instance();
// $CI->load->view('new_template_design/header'); 

    $CI->load->model('api_model');
 $resourcepage=$CI->api_model->getPageById("13");
      $response['content'] = $resourcepage[0]["content"]; ?>
<div class="container-fluid banner-section_story">
  

  <div class="section-text press-head">
    <h1 class="press-tittle story-title"><?php echo $resourcepage[0]['heading']?></h1>
  </div>
</div>
<!-- <section class="extra"> -->
<div class="container">
  <div class="terms_tab">
        <div class="col-sm-3">
            <ul class="nav nav-tabs tabs-left">
              <?php $tab = "terms"; ?>
                <li class="terms <?php echo $tab == 'terms' ? 'active' : '' ?> "><a href="<?php base_url() ?>terms-of-use" >Terms of Use</a>
                </li>
                <li class="privacy <?php echo $tab == 'privacy' ? 'active' : '' ?>" ><a href="<?php base_url() ?>privacy-policy">Privacy Policy & Cookie Policy</a>
                </li>
                <li class="agreement <?php echo $tab == 'agreement' ? 'active' : '' ?>"><a href="<?php base_url() ?>agreement">Knowledge Partner Agreement</a>
                </li>
                <li class="resellers-terms-of-use <?php echo $tab == 'resellers-terms-of-use' ? 'active' : '' ?>"><a href="<?php base_url() ?>resellers-terms-of-use">Reseller Agreement</a>
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

