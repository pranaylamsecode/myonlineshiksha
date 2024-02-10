<?php
	$CI =& get_instance();
	$CI->load->model('admin/settings_model');
	$CI->load->model('admin/Pagecreator_model');
	$CI->load->helper('text');
	$getaboutus1 = $CI->Pagecreator_model->getPageByType('about');
	$contactpage1 = $CI->Pagecreator_model->getPageByType('contact');
	$contactsettings = json_decode($contactpage1[0]['settings']);
	$allsociallinks = $CI->settings_model->getSocialLinks();
	$auth = $this->session->userdata('logged_in');

	$configarr = $this->settings_model->getItems();
	$institute_name = $configarr[0]['institute_name'];
  ?>
    	<div class="container">
        	<div class="row-fluid">
            	<div class="span6">
                	<span class="payment">
                    <img width='217' height='29' src="<?php echo base_url();?>public/default/images/flogo.png" border="0" alt=""  />
					<h6>&copy;<?php echo $institute_name;?>,&nbsp All Rights Reserved &nbsp Powered by <a href="http://createonlineacademy.com" style="color:while">The Create Online Academy</a>
                    </h6>
                </div>

                <div class="span6">
                	<ul class="social">
                    	<?php
                        if($allsociallinks[0]->siteurl != '')
                        {
                        ?>
                        <li title="Facebook" class="tooltip_hover"><a target="_blank" href="http://<?php echo $allsociallinks[0]->siteurl;?>" class="facebook socialicon"></a></li>
                        <?php
                        }
                        ?>
                        <?php
                        if($allsociallinks[1]->siteurl != '')
                        {
                          ?>
                          <li title="Twitter" class="tooltip_hover"><a target="_blank" href="http://<?php echo $allsociallinks[1]->siteurl;?>" class="twitter socialicon"></a></li>
                          <?php
                        }
                        ?>
                        <?php
                        if($allsociallinks[3]->siteurl != '')
                        {
                        ?>
                        <li title="Linkedin" class="tooltip_hover"><a target="_blank" href="http://<?php echo $allsociallinks[2]->siteurl;?>" class="linkedin socialicon"></a></li>
                         <?php
                        }
                        ?>
                        <?php
                        if($allsociallinks[2]->siteurl != '')
                        {
                        ?>
                        <li title="Youtube" class="tooltip_hover"><a target="_blank" href="http://<?php echo $allsociallinks[3]->siteurl;?>" class="youtube socialicon"></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

<div id="footer_wrap" style="display: none">
  <div id="footer">
    <div class="menu col1">
    <img width="38" height="59" src="<?php echo base_url(); ?>public/default/images/footerlogo.png" alt="" class="flogo" />
    <b><?php echo $getaboutus1[0]['heading'];?></b>
    <p><?php echo character_limiter($getaboutus1[0]['content'],250); ?></p>
    </div>

    <div class="menu col2">
    <ul>
    <li><a href="<?php echo base_url();?>">Home</a></li>
    <li><a href="<?php echo base_url();?>specialpages/aboutuspage">About Us</a></li>
    <li><a href="<?php echo base_url();?>specialpages/contactuspage">Contact</a></li>
    <li><a href="<?php echo base_url();?>testimonials/alltestimonials">Testimonials</a></li>
  </ul>
</div>

<div class="menu col3"></div>
    <div class="menu col4">
      <div class="socialicon">
        <a target="_blank" href="http://<?php echo $allsociallinks[0]->siteurl;?>"><div class='sprite icon-facebook'></div></a>
        <a target="_blank" href="http://<?php echo $allsociallinks[1]->siteurl;?>"><div class='sprite icon-twitter'></div></a>
        <a target="_blank" href="http://<?php echo $allsociallinks[2]->siteurl;?>"><div class='sprite icon-google-plus'></div></a>
        <a target="_blank" href="http://<?php echo $allsociallinks[3]->siteurl;?>"><div class='sprite icon-rss'></div></a>
        <a target="_blank" href="http://<?php echo $allsociallinks[4]->siteurl;?>"><div class='sprite icon-you-tube'></div></a>
      </div>
  <p></p>
  <p>
    <?php echo $contactsettings->weburl?><br />
    <?php echo $contactsettings->address;?><br/>
    &copy; The Create Online Academy
  </p>
</div>
</div>
</div>
<div id="footer_wrapbot">
  <div id="footer"></div>
</div>