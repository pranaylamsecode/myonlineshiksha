<?php
$CI =& get_instance();
$CI->load->model('admin/settings_model');
$getItemssetting = $CI->settings_model->getItems();

$callpages = $CI->settings_model->getAllPages();
$countpage = count($callpages);

$currenttemplate = $getItemssetting[0]['layout_template'];
$settings = $CI->settings_model->getTemplateById($currenttemplate);
$data11 = $settings[0]['options'];
$data = json_decode($data11);

$allsociallinks=$CI->settings_model->getSocialLinks();
$auth = $this->session->userdata('logged_in');
$logoimage=$getItemssetting[0]['logoimage'];
extract($getItemssetting[0]);
$menulayout = json_decode($ctgspage);
$searchbox = json_decode($ctgpage);
$menu_layout = $menulayout->ctgs_image_alignment;
$searchbox_val = $searchbox->ctg_image_alignment;
?>

<!-- Top Bar -->
<?php
if($data->page_setting->topbarloginregister_showhide == 'left')
{
	?>
	<style>
		#headtop1
		{
			float: right;
		}
		
		#headtop2
		{
			float:left;
		}
	</style>
	<?php
}
?>
<div class="top">
    <div class="container">
        <div class="row-fluid">
            <ul class="login" id='headtop1'>
                <?php
                $auth = $this->session->userdata('logged_in');
                if($auth){  ?>
                <li><a style="color:white;" href="<?php echo base_url(); ?>users/logout"><b>logout :</b> </a>  </li>
                <li><?php echo $auth['email']; ?> </li>
                <?php }else{?>
                <li>
                  <a style="color:white;" href="<?php echo base_url(); ?>users/login">Login </a>
                </li>
                <li style="color:white;">|</li>
                <li><a style="color:white;" href="<?php echo base_url(); ?>users/registration">Register</a></li>
                <?php } ?>
            </ul>

        	<p class="animated fadeInRight" id='headtop2'> +44 (0) 123 456 789  <span>hello@university.com</span></p>
        </div>
    </div>
</div>
<!-- End Top Bar -->
<!-- Nav-->
<?php
if($data->page_setting->heading_searchbar == 'left')
{
	?>
	<style>
		#span33
		{
			float: right;
			text-align: right;
		}
		
		#headd
		{
			float:left;
		}
	</style>
	<?php
}
?>

<nav>
	<div class="container">
    	<div class="row-fluid">
            <!-- Logo-->
            <div class="span3" id='span33'>
            	<a href="<?php echo base_url(); ?>" class="logo"><img border="0" alt="" src="<?php echo base_url(); ?>public/uploads/settings/img/<?php echo $logoimage;?>" ></a>
            </div>
            <!-- End Logo-->
            <!-- Intro Text-->
            <div class="span9">
            	<h1 class="animated delay2 fadeInDown" id='headd'>Be part of Our University </h1>
            </div>
            <!-- End Intro Text-->
            <div id="mainmenudiv" class="span9">
            <?php
            $layout_pos = ($menu_layout == 0) ? "menupos_left" : "menupos_right";
            $searchboxval = ($searchbox_val == 0) ? "searchbox_enable" : "searchbox_disable";
            	//$searchbox_val
            ?>
				<div class="mainmenu" id='headd'>
            		<div class="main_menu <?php echo $layout_pos;?>" >
					<?php $this->load->view(getOverridePath($tmpl,'partials/menu','indexviews'));?>      
            		</div>
            		<?php
            			$attributes = array('class' => 'tform', 'name' => 'topform1');
            			echo form_open_multipart('index/search_result',$attributes);
            			$sess_search_course = $this->session->userdata('sess_search_course');
            		?>
				
					<?php
					if($data->page_setting->searchbox_showhide == 'true')
					{
						?>						
						<div class="searchform <?php echo $searchboxval;?>" id='headd'>
							<input type="text" id="searchtext" name="searchtext" value="<?php echo (isset($sess_search_course['searchterm'])) ? $sess_search_course['searchterm'] : ''; ?>" placeholder="Search" />
							<input type="submit" value="search" name="searchkeyword" id="searchkeyword" class="btn button animated bounceIn" />
						</div>
						<?php					
					}
					?>
                </div>
            	  <?php echo form_close(); ?>
            </div>
    	</div>
	</div>
</nav>

<!-- End Nav-->

<!-- Slider -->
<header>
<?php

if($data->page_setting->banner_showhide == 'true')
{
	if($data->page_setting->banner_setting == 'homepage')//banner only on home page
	{
	    if($this->uri->segment(1)=='index' || $this->uri->segment(1)=='')
        {
            if($this->uri->segment(1) != 'programs')
            {
		      $this->load->view(getOverridePath($tmpl,'slider1','indexviews'));
            }
        }
	}
	else //banner for all page
	{
        if($this->uri->segment(1) != 'programs')
        {
		    $this->load->view(getOverridePath($tmpl,'slider1','indexviews'));
        }
	}
}

//echo $this->uri->segment(1);

if($data->page_setting->slider_showhide == 'true')
{
	$this->load->view(getOverridePath($tmpl,'slider2','indexviews'));
}
?>
</header>

<!-- End Slider -->


<div id="header_wrap" style="display: none;">
    <div id="header">
        <div class="logoimg">
        </div>  <!--style="width:164px;height:44px"-->

        <div class="logoright">
        <?php /* ?>  <div class="language">

            <span>Study In:</span>

            <a href="#"><img alt="Study USA" src="<?php echo base_url(); ?>public/default/images/icon-study-usa.png"></a>

            <a href="#"><img alt="Study UK" src="<?php echo base_url(); ?>public/default/images/icon-study-uk.png"></a>

            <a href="#"><img class="" alt="Study Australia" src="<?php echo base_url(); ?>public/default/images/icon-study-australia.png"></a>

        </div> <?php */ ?>

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