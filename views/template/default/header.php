<?php
  $CI =& get_instance();
  $CI->load->model('admin/settings_model');
  $allsociallinks=$CI->settings_model->getSocialLinks();
  $getItemssetting = $CI->settings_model->getItems();
  $auth = $this->session->userdata('logged_in');
  $logoimage=$getItemssetting[0]['logoimage'];
  
  extract($getItemssetting[0]);
  $menulayout = json_decode($ctgspage);
  //print_r($menulayout);
  $searchbox = json_decode($ctgpage);
  $menu_layout = $menulayout->ctgs_image_alignment;
  $searchbox_val = $searchbox->ctg_image_alignment;
  
  //echo '<pre>';	
		//print_r(json_decode($ctgpage));
		//print_r(json_decode($ctgspage));
		//print_r(json_decode($psgspage));
		//print_r(json_decode($psgpage));
	//echo '</pre>';
//ctgs_image_alignment
?>

<div id="header_wrap">
    <div id="header">
       <div class="logoimg"><a href="<?php echo base_url(); ?>" class="logo"><img border="0" alt="" src="<?php echo base_url(); ?>public/uploads/settings/img/<?php echo $logoimage;?>" ></a>
        </div>  <!--style="width:164px;height:44px"-->
        <div class="logoright">
      <?php /* ?>  <div class="language">
            <span>Study In:</span>
            <a href="#"><img alt="Study USA" src="<?php echo base_url(); ?>public/default/images/icon-study-usa.png"></a>
            <a href="#"><img alt="Study UK" src="<?php echo base_url(); ?>public/default/images/icon-study-uk.png"></a>
            <a href="#"><img class="" alt="Study Australia" src="<?php echo base_url(); ?>public/default/images/icon-study-australia.png"></a>
        </div> <?php */ ?>
        <ul class="login">
                   <?php
                  $auth = $this->session->userdata('logged_in');
                  if($auth){  ?>
                  <li><a href="<?php echo base_url(); ?>users/logout"><b>logout :</b> </a>  </li>
                  <li><?php echo $auth['email']; ?> </li>
                  <?php }else{?>
                  <li>
                    <a class='<?php echo "fancybox fancybox.iframe";?>' href="<?php echo base_url(); ?>users/login">Login </a>
                  </li>
                  <li>|</li>
                  <li><a href="<?php echo base_url(); ?>users/registration">Register</a></li>
                  <?php } ?>

        </ul>
        <div class="socialicon">
                    <a target="_blank" href="http://<?php echo $allsociallinks[0]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-facebook.png"></a>
                    <a target="_blank" href="http://<?php echo $allsociallinks[1]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-twitter.png"></a>
                    <a target="_blank" href="http://<?php echo $allsociallinks[2]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-google-plus.png"></a>
                    <a target="_blank" href="http://<?php echo $allsociallinks[3]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-rss.png"></a>
                    <a target="_blank" href="http://<?php echo $allsociallinks[4]->siteurl;?>"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-you-tube.png"></a>
                  <?php /* ?>  <a target="_blank" href="javascript:void(0"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-weibo.png"></a>
                    <a target="_blank" href="javascript:void(0)"><img alt="" src="<?php echo base_url(); ?>public/default/images/social_icons/icon-ren-ren.png"></a>     <?php */ ?>
        </div>
        </div>
  </div>
  </div>
  <div id="mainmenudiv">
  <?php
  $layout_pos = ($menu_layout == 0) ? "menupos_left" : "menupos_right";
  $searchboxval = ($searchbox_val == 0) ? "searchbox_enable" : "searchbox_disable";
		//$searchbox_val
  ?>
        <div class="mainmenu">
				<div class="main_menu <?php echo $layout_pos;?>">
                <?php $this->load->view('template/'.$tmpl.'/partials/menu');?>
				</div>
				<?php
					$attributes = array('class' => 'tform', 'name' => 'topform1');
					echo form_open_multipart('index/search_result',$attributes);
					$sess_search_course = $this->session->userdata('sess_search_course');
				//print_r($sess_course);
				?>
				<div class="searchform <?php echo $searchboxval;?>">
					<input type="text" id="searchtext" name="searchtext" value="<?php echo (isset($sess_search_course['searchterm'])) ? $sess_search_course['searchterm'] : ''; ?>" placeholder="Search" />
					<input type="submit" value="search" name="searchkeyword" id="searchkeyword" />
				</div>
          </div>
		  <?php echo form_close(); ?>
  </div>
