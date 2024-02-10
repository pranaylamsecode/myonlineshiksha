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

  <?php function auto_copyright($year = 'auto'){ ?>
   <?php if(intval($year) == 'auto'){ $year = date('Y'); } ?>
   <?php if(intval($year) == date('Y')){ echo intval($year); } ?>
   <?php if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); } ?>
   <?php if(intval($year) > date('Y')){ echo date('Y'); } ?>
<?php } ?>
    	<div class="container">
        	<div class="row-fluid">
            	<div class="span6">
                	<span class="payment">
                    <img width='217' height='29' src="<?php echo base_url();?>public/default/images/flogo.png" border="0" alt=""  />
					<h6>&copy;<?php auto_copyright();?><?php echo $institute_name;?>,&nbsp All Rights Reserved.​<br><!-- <a style="font-size:11px;color:white !important;" rel="dofollow"​​ href="https://www.createonlineacademy.com​​" target="_blank">​Online Academy</a><span style=​"​​color:#​fff;">​ by </span> <a style="font-size:11px;color:white !important;" rel="dofollow" href="https://www.createonlineacademy.com​​" target="_blank">​CreateOnlineAcademy</a> -->
                    </h6>

                    <!-- <p class="footer-copy-right" style="color: white;">© 2017 <a style="color: #fff!important;" href="https://createonlineacademy.com/"><?php echo $institute_name;?></a><span style="color:#fff;">. All Rights Reserved.</span> <br><a style="font-size:11px;color:#999;" rel="dofollow" href="https://veerit.com" target="_blank">VeerIT</a><span style="color:#999;">:</span> <a style="font-size:11px;color:#999;" rel="dofollow" href="https://veerit.com" target="_blank">Website Design and Development</a> <span style="color:#999;">and</span> <a style="font-size:11px;color:#999;" rel="dofollow" href="http://hosting.veerit.com" target="_blank">Website Hosting</a></p> -->
                </div>
              <?php
                 $CI = & get_instance();
                 $CI->load->model('admin/settings_model');
                 $socialstatus = $this->settings_model->getSocialStatus(1,'mlms_socialstatus'); 
              ?>
                <div class="span6">
                <?php if($socialstatus->social_icon == 1)
                 { ?>
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
                    <?php } ?>
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
<?php 
$auth = $this->session->userdata('logged_in');
// echo"<pre>";
// print_r($auth);
// echo"</pre>";
if($auth)
{

	if($auth['groupid']== 2 || $auth['groupid']== 4)
	{
?>
<div class="get_help_fix">
   <span class="ghf-img">
    	<img src="<?php echo base_url();?>public/css/image/help-icon.png" alt="gethelp">
  </span>

  <ul class="ghf-menu">
	    <li><a href="<?php echo base_url();?>specialpages/video_list">How-To Video Tutorials</a></li>
	    <li><a href="<?php echo base_url();?>specialpages/help_to_manage_academy">Help To Manage Academy</a></li>
	    <li><a href="<?php echo base_url();?>specialpages/support_team">Contact Support</a></li>    
  </ul>
</div>
<?php
 	}
 	else if($auth['groupid']== 1)
 	{
 		?>
 		<div class="get_help_fix">
   <span class="ghf-img">
    	<img src="<?php echo base_url();?>public/default/images/help-icon.png" alt="gethelp">
  </span>

  <ul class="ghf-menu">    
      
      <li><a href="<?php echo base_url();?>specialpages/video_list_stu">Video Tutorials</a></li>
      <li><a href="<?php echo base_url();?>specialpages/support_team">Contact Support</a></li>    
  

  </ul>
</div>
 		<?php
 	}
 }
  ?>

<style type="text/css">
#lean_overlay_hp
{
position: fixed;
z-index: 10000;
top: 0px;
left: 0px;
height: 100%;
width: 100%;
background: #000;
}
.get_help_fix {
    position: fixed;
    left: 25px;
    bottom: 0;
    z-index: 10001;
}

.get_help_fix .ghf-img{
display: block;
cursor: pointer;
}


.get_help_fix .ghf-img img{
width: 80%;
}

ul.ghf-menu {
    position: fixed;
    left: 60px;
    bottom: 15px;
    list-style: none;
    border-radius: 6px;
    display: none;
        width: 200px;
}

ul.ghf-menu::after {
    content: '';
    position: absolute;
    bottom: 7px;
    right: 100%;
    margin-top: -8px;
    width: 0;
    height: 0;
    border-right: 8px solid #244F98;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
}

ul.ghf-menu li {
  min-width: 140px;
    width: auto;
    color: #fff;
    background: #3A66B0;
    height: 30px;
    line-height: 28px;
    text-align: center;
    visibility: visible;
  border-bottom: 1px solid rgba(238, 238, 238, 0.45);
    cursor: pointer;
    border-radius: 6px;
}

ul.ghf-menu li:hover {

    background: #244F98;
    color: #fff;
}

ul.ghf-menu li> a{
   color: #fff !important;
}

ul.ghf-menu li:hover a{
   color: #fff !important;
}



</style>
 

<div id="lean_overlay_hp" style="display: none; opacity: 0;"></div> 

<script type="text/javascript">
var $ =jQuery.noConflict();

  $(document).ready(function () {
   $('.ghf-img').click(function(evt) {
       $(".ghf-menu").slideToggle('slow');
               evt.stopPropagation();
               $('#lean_overlay_hp').show();
   });
   $('#lean_overlay_hp').click(function(evt) {
       $(".ghf-menu").hide('slow');
               evt.stopPropagation();
               $('#lean_overlay_hp').hide();
   });
});
</script>



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

