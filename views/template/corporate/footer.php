<?php



  $CI =& get_instance();



  $CI->load->model('admin/settings_model');

  $CI->load->model('admin/Pagecreator_model');

  $CI->load->helper('text');

  

  $getaboutus1 = $CI->Pagecreator_model->getPageByType('about');

  $contactpage1 = $CI->Pagecreator_model->getPageByType('contact');

  $contactsettings = json_decode($contactpage1[0]['settings']);

  

  //print_r();

  $allsociallinks = $CI->settings_model->getSocialLinks();



  ?>
    	<div class="container">

        	<div class="row-fluid">
            	<div class="span6">
                	<h6>&copy; The Create Online Academy, All Rights Reserved<span class="payment"><img src="<?php echo base_url();?>public/default/images/flogo.png" border="0" alt=""  /></h6>
                </div>

                <div class="span6">
                	<ul class="social">
                    	<li title="Linkedin" class="tooltip_hover"><a href="#" class="linkedin socialicon"></a></li>
                        <li title="Youtube" class="tooltip_hover"><a href="http://<?php echo $allsociallinks[4]->siteurl;?>" class="youtube socialicon"></a></li>
                        <li title="Facebook" class="tooltip_hover"><a href="http://<?php echo $allsociallinks[0]->siteurl;?>" class="facebook socialicon"></a></li>
                        <li title="Twitter" class="tooltip_hover"><a href="http://<?php echo $allsociallinks[1]->siteurl;?>" class="twitter socialicon"></a></li>
                    </ul>
                </div>


            </div>

        </div>


<div id="footer_wrap" style="display: none">



  <div id="footer">



    <div class="menu col1">



    <img src="<?php echo base_url(); ?>public/default/images/footerlogo.png" alt="" class="flogo" />



    <b><?php echo $getaboutus1[0]['heading'];?></b>



    <p><?php echo character_limiter($getaboutus1[0]['content'],250); ?></p>



    </div>



    <div class="menu col2">



    <ul>

    <li><a href="<?php echo base_url();?>">Home</a></li>

    <li><a href="<?php echo base_url();?>specialpages/aboutuspage">About Us</a></li>

    <li><a href="<?php echo base_url();?>specialpages/contactuspage">Contact</a></li>

    <li><a href="<?php echo base_url();?>testimonials/alltestimonials">Testimonials</a></li>

<!--    <li><a href="#">Advertising</a></li>

    <li><a href="#">Partners</a></li>

    <li><a href="#">Sitemap</a></li>-->

    </ul>



    </div>



    <div class="menu col3">



<!--    <ul>



    <li><a href="<?php echo base_url();?>">Home</a></li>



    <li><a href="#">Study Centers</a></li>



    <li><a href="#">Products &amp; Services</a></li>



    <li><a href="#">Resourses</a></li>



    <li><a href="#">Blog &amp; Forums</a></li>



    </ul>-->



    </div>



    <div class="menu col4">



      <div class="socialicon">



                      <a target="_blank" href="http://<?php echo $allsociallinks[0]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-facebook.png"></a>



                      <a target="_blank" href="http://<?php echo $allsociallinks[1]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-twitter.png"></a>



                      <a target="_blank" href="http://<?php echo $allsociallinks[2]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-google-plus.png"></a>



                      <a target="_blank" href="http://<?php echo $allsociallinks[3]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-rss.png"></a>



                      <a target="_blank" href="http://<?php echo $allsociallinks[4]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-you-tube.png"></a>



                   <?php /* ?>   <a target="_blank" href="javascript:void(0"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-weibo.png"></a>



                      <a target="_blank" href="javascript:void(0)"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-ren-ren.png"></a>      <?php */ ?>



       </div>







    <p></p>



    <p>



<?php echo $contactsettings->weburl?><br />

<?php echo $contactsettings->address;?><br/>

<!--mlms.com<br />



224 First Street<br />



Nagpur Beach, Abbay Street<br />-->



&copy; The Create Online Academy



    </p>



    </div>



  </div>



</div>



<div id="footer_wrapbot">



  <div id="footer">



<!--    <div class="copyright">&copy; The Create Online Academy, All Rights Reserved<span class="payment"><img src="<?php echo base_url();?>public/default/images/flogo.png" border="0" alt=""  /> </span></div>-->



  </div>



</div>



