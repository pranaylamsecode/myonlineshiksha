<!--<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.leanModal.min.js" defer ></script>-->

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
					<h6>&copy;<?php echo $institute_name;?>,&nbsp All Rights Reserved &nbsp Powered by <a href="https://www.createonlineacademy.com" rel="nofollow" style="color:while">The Create Online Academy</a>
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
      
<div id="footer_wrapbot">
  <div id="footer"></div>
  
  <input type="hidden" value="<?php echo $auth ? ucfirst($auth['first_name']).' '.ucfirst($auth['last_name']):''; ?>" id="customer-chat-contact-name2">
  <input type="hidden" value="<?php echo $auth ? $auth['email'] :''; ?>" id="customer-chat-contact-mail2">
</div>

<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/chat_app/livechat/php/app.php?widget-init.js"></script>
<!-- ClickDesk Live Chat Service for websites -->


<!-- End of ClickDesk -->

<script>
  var $ =jQuery.noConflict();
  jQuery(document).ready(function() {
    var mySlidebars = new jQuery.slidebars();
    
    jQuery('.toggle-left').on('click', function() {
      mySlidebars.toggle('left');
      //jQuery('.container').css({"margin-left":"0"});

    });
    
    jQuery('.toggle-right').on('click', function() {
      mySlidebars.toggle('right');
    });
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>

