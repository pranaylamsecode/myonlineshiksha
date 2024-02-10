<!DOCTYPE html>
<?php
  $CI =& get_instance();
  $CI->load->helper('commonmethods');
  $CI->load->model('admin/settings_model'); 
  $getTheme = $CI->settings_model->getItems();
//print_r($getTheme); 
   $status = $getTheme[0]['status'];

  $blocked = $getTheme[0]['is_block'];

  if($status == '0')
  {
  	//exit('Website has been Blocked');
  	redirect('users/expired');
  }

  if($blocked == '1')
  {
  	//exit('Website has been Blocked');
  	redirect('users/blocked');
  }
  
  //$CI->config->load('installation_config'); 
  $themestylecss = $getTheme[0]['layouttheme'];
  $pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
  $CI->load->model('program_model'); 
  $getProgram = $CI->program_model->getProgram($pro_id);
  //new tag code start
  $getmeta = $CI->settings_model->getMetaTag($pro_id); 
  $resourcepages = $this->uri->segment(1); 
 	
  $link = base_url();
  $arr = explode('.',trim($link));
  $shortUrl=ltrim($arr[0], "http://");
  //echo $shortUrl; 
  if($resourcepages=='resourcepages')
  {

  $meta_title2 = (isset($getmeta->meta_title) && trim($getmeta->meta_title)!= '') ? trim($getmeta->meta_title) : "MLMS";
  $meta_keyword2 = (isset($getmeta->meta_keyword) && trim($getmeta->meta_keyword)!= '') ? trim($getmeta->meta_keyword) : "MLMS";
  $meta_description2 = (isset($getmeta->meta_desc) && trim($getmeta->meta_desc)!= '') ? trim($getmeta->meta_desc) : "MLMS Institute"; 

	}
	else
	{ //new tag code end
		$meta_title2 = (isset($getmeta->meta_title) && trim($getmeta->meta_title)!= '') ? trim($getmeta->meta_title) : "MLMS3";
  $meta_keyword2 = (isset($getmeta->meta_keyword) && trim($getmeta->meta_keyword)!= '') ? trim($getmeta->meta_keyword) : "MLMS4";
  $meta_description2 = (isset($getmeta->meta_desc) && trim($getmeta->meta_desc)!= '') ? trim($getmeta->meta_desc) : "MLMS Institute"; 

 
	 if($this->uri->segment(3)){
	 	$themestylecss = $getTheme[0]['layouttheme'];
	  $pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;
	  $CI->load->model('program_model'); 
	  $getProgram = $CI->program_model->getProgram($pro_id);
	  //new tag code start
	  $getmeta = $CI->settings_model->getMetaTag($pro_id); 
	  if($getProgram){
	   $cdesc= $getProgram->description;
	  $descshort = mb_substr($cdesc, 0, 250);		
	  $meta_title2 = (isset($getProgram->metatitle) && trim($getProgram->metatitle)!= '') ? trim($getProgram->metatitle) : "$getProgram->name";
	  $meta_keyword2 = (isset($getProgram->metakwd) && trim($getProgram->metakwd)!= '') ? trim($getProgram->metakwd) : "$descshort";
	  $meta_description2 = (isset($getProgram->metadesc) && trim($getProgram->metadesc)!= '') ? trim($getProgram->metadesc) : "$descshort";
	  $ogUrl= base_url().'course/'.$getProgram->name.'/'.$getProgram->id;
	  $ogImg= base_url().'public/uploads/programs/img/thumb_232_216/'.$getProgram->image; ?>

	  <title><?php echo $meta_title2;?></title>
  	<meta name="title" content="<?php echo $meta_title2; ?>" />
	<meta name="description" content="<?php echo $meta_description2; ?>" />
	<meta name="keywords" content="<?php echo $meta_keyword2; ?>"/>
	
	<meta property="og:title" content="<?php echo $meta_title2; ?>">
	<meta property="og:url" content="<?php echo $ogUrl;?>">
	<meta property="og:description" content="<?php echo $meta_description2; ?>">
	<meta property="og:image" content="<?php echo $ogImg; ?>">
	<meta property="og:type" content="<?php echo $getTheme[0]['institute_name'];?>:course">
	<meta property="og:site_name" content="<?php echo $getTheme[0]['institute_name'];?>">
	<meta property="og:locale" content="en_US">

	<meta name="twitter:title" content="<?php echo $meta_title2; ?>">
	<meta name="twitter:url" content="<?php echo $ogUrl;?>">
	<meta name="twitter:description" content="<?php echo $meta_description2; ?>">
	<meta name="twitter:image" content="<?php echo $ogImg; ?>">
	<meta name="twitter:site" content="@<?php echo $shortUrl; ?>">

	<meta itemprop="name" content="<?php echo $meta_title2; ?>">
	<meta itemprop="url" content="<?php echo $ogUrl;?>">
	<meta itemprop="description" content="<?php echo $meta_description2; ?>">
	<meta itemprop="image" content="<?php echo $ogImg; ?>">
	<?php } else{ ?>
		
<?php	}
	}
   //echo $resultd;
  }
  extract($getTheme[0]);
  $signup = json_decode($psgspage);
  $sigup_pos = $signup->courses_image_alignment;
  $signup_box_pos = ($sigup_pos == 0) ? "signup_box_left" : "signup_box_right";
  $sidebar = json_decode($psgpage);
  $sidebar_pos = $sidebar->course_image_alignment;
  $sidebarpos = ($sidebar_pos == 0) ? "sidebar_left" : "sidebar_right";
  // $sigup_pos = $signup->courses_image_alignment);
  // $menu_layout = $menulayout->ctgs_image_alignment;
  // $searchbox_val = $searchbox->ctg_image_alignment;
  
	//on dated 12-09-2014
	$CI =& get_instance();
	$CI->load->model('admin/settings_model');
	$getItemssetting = $CI->settings_model->getItems();
	$currenttemplate = $getItemssetting[0]['layout_template'];
	$settings = $CI->settings_model->getTemplateById($currenttemplate);
	$data11 = $settings[0]['options'];
	$data = json_decode($data11);
?>

<html lang="en-us" >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"> <meta name="twitter:card" content="summary"> <meta name="medium" content="mult"> <meta http-equiv="Content-Language" content="en-us">
<?php if($this->uri->segment(3)== ''){ 

  // For home page

	$meta_title2 = (isset($getTheme[0]['meta_title']) && trim($getTheme[0]['meta_title'])!= '') ? trim($getTheme[0]['meta_title']) : "MLMS3";
  	$meta_keyword2 = (isset($getTheme[0]['meta_keyword']) && trim($getTheme[0]['meta_keyword'])!= '') ? trim($getTheme[0]['meta_keyword']) : "MLMS4";
 	$meta_description2 = (isset($getTheme[0]['meta_desc']) && trim($getTheme[0]['meta_desc'])!= '') ? trim($getTheme[0]['meta_desc']) : "MLMS Institute";
 	$ogImg= base_url().'public/uploads/settings/img/logo/'.$getTheme[0]['bannerimage'];
?> 
	<title><?php echo $meta_title2;?></title>
	<meta name="title" content="<?php echo $meta_title2; ?>" />
	<meta name="description" content="<?php echo $meta_description2; ?>">
	<meta name="keywords" content="<?php echo $meta_keyword2; ?>">

	<meta property="og:title" content="<?php echo $meta_title2; ?>">
	<meta property="og:url" content="<?php echo base_url(); ?>">
	<meta property="og:description" content="<?php echo $meta_description2; ?>">
	<meta property="og:image" content="<?php echo $ogImg; ?>">
	<meta property="og:type" content="video_lecture">
	<meta property="og:site_name" content="<?php echo $shortUrl;?>">
	<meta property="og:locale" content="en_US">

	<meta name="twitter:title" content="<?php echo $meta_title2; ?>">
	<meta name="twitter:url" content="<?php echo base_url(); ?>">
	<meta name="twitter:description" content="<?php echo $meta_description2; ?>">
	<meta name="twitter:image" content="<?php echo $ogImg; ?>">
	<meta name="twitter:site" content="@<?php echo $shortUrl; ?>">

	<meta itemprop="name" content="<?php echo $meta_title2; ?>">
	<meta itemprop="url" content="<?php echo base_url(); ?>">
	<meta itemprop="description" content="<?php echo $meta_description2; ?>">
	<meta itemprop="image" content="<?php echo $ogImg; ?>">

	<?php }else{?>

	<title><?php echo $template['title'];?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv='expires' content='1200' />
	<meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />	
	<meta name="keywords" content="<?php echo $meta_keyword2; ?>"/>
	<meta name="description" content="<?php echo $meta_description2; ?>" />
	<meta name="title" content="<?php echo $meta_title2; ?>" />
	<meta name="generator" content="<?php echo $meta_title2; ?>" />


	<?php } ?>

    <?php
    if($tmpl != 'default')
    {
    	$bootstrap = $this->config->item('base_url').getOverridePath($tmpl,'css/bootstrap.css','publicfiles');
    	$bootstrapRes = $this->config->item('base_url').getOverridePath($tmpl,'css/bootstrap-responsive.css','publicfiles');
    	$fontsgoogleapis = $this->config->item('base_url').getOverridePath($tmpl,'css/fontsgoogleapis.css','publicfiles');
    	$animate = $this->config->item('base_url').getOverridePath($tmpl,'css/animate.css','publicfiles');
    	$maincss = $this->config->item('base_url').getOverridePath($tmpl,'css/template.css','publicfiles');    	
    	?>
	    <link rel="stylesheet" href="<?php echo base_url();?>public/css/csstextsec.css" media="screen" type="text/css"  />
	    <link rel="stylesheet" href="<?php echo $bootstrap;?>" media="screen"  />
	    <link rel="stylesheet" href="<?php echo $bootstrapRes;?>" media="screen"  />
	    <link rel="stylesheet" href="<?php echo $fontsgoogleapis;?>" media="screen"  />
	    <link rel="stylesheet" href="<?php echo $animate;?>" media="screen"  />	
		<link rel="stylesheet" href="<?php echo $maincss;?>" media="screen"  />		
		<?php
	}
		$styles = $this->config->item('base_url').getOverridePath($tmpl,'/css/'.$themestylecss,'publicfiles');
    	$css2 = $this->config->item('base_url').getOverridePath($tmpl,'css/reset.css','publicfiles');
    	$css3 = $this->config->item('base_url').getOverridePath($tmpl,'css/smoothness/jquery-ui-1.8.21.custom.css','publicfiles');
    	$css4 = $this->config->item('base_url').getOverridePath($tmpl,'css/bstyles.css','publicfiles');
    	$css5 = $this->config->item('base_url').getOverridePath($tmpl,'css/colour_standard.css','publicfiles');
    	$css6 = $this->config->item('base_url').getOverridePath($tmpl,'css/front_style.css','publicfiles');
		?>
		<link rel="stylesheet" href="<?php echo $styles;?>" type="text/css"  />
		<!--<link rel="stylesheet" href="<?php echo $css2;?>" media="screen" type="text/css"  />-->
		<link rel="stylesheet" href="<?php echo $css3;?>" media="screen" type="text/css"  />
		<!--<link rel="stylesheet" href="<?php echo $css4;?>" media="screen" type="text/css"  />-->	
		<link rel="stylesheet" href="<?php echo $css5;?>" media="screen" type="text/css"  />	
		<!--<link rel="stylesheet" href="<?php echo $css6;?>" media="screen" type="text/css"  />-->	
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/csstextsec.css" media="screen" type="text/css"  />
    	<link rel="icon" href="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $getTheme[0]['favicon']; ?>" type="image/gif">

    	<link rel="stylesheet" href="<?php echo base_url();?>public/classic/css/allCombinedCss.css" media="screen" type="text/css" />
		<?php 
			$js1 = $this->config->item('base_url').getOverridePath($tmpl,'js/jquery-1.7.1.min.js','publicfiles');
			$js2 = $this->config->item('base_url').getOverridePath($tmpl,'js/jquery-ui-1.8.21.custom.min.js','publicfiles');
			$js3 = $this->config->item('base_url').getOverridePath($tmpl,'js/jquery.min.js','publicfiles','publicfiles');
		?>
		<script src="<?php echo $js1;?>" type="text/javascript" ></script>
		<script src="<?php echo $js2;?>" type="text/javascript" defer ></script>    
		<script src="<?php echo $js3;?>" type="text/javascript" defer ></script>   
</head>
<?php flush(); ?>
<body class="<?php echo $template['title'];?>">
<?php
$sessionarray = $this->session->userdata('logged_in');
if((!empty($sessionarray)) && $getTheme[0]['visited']=='No' && $sessionarray['groupid']=='4')
{
?>
<div id="mlmspopdiv">
    <div class="popoverlay"></div>
    <div class="popdiv" style="min-height: 215px;">
        <div class="popcontent">
        <p class="poptitle"><font color="#6ec218">Greeting!,</font> <font color="#d9534f"><?php echo $sessionarray['email'];  ?></font></p>
        <p class="popwelcome">Welcome to your <font color="#2bc6d8">Institute!</font></p>
        <p>Let me help you, and complete your Institute in less than 5 minutes! </p>
        <p class="padleft"><font color="#2bc6d8">Please log in by click on "Admin Panel" button.</font></p>
        <div class="popbottom" style="margin:20px 190px;">
        <a href="<?php echo base_url();?>/admin" class="btngreen" >Admin Panel</a>       
        </div>
        </div>
    </div>
</div>
<?php
}
?>
<input type="hidden" id="baseurlfld" name="baseurlfld" value="<?php echo base_url();?>">

<!-- Header-->
<header>

<?php 

//$this->load->view(getOverridePath($tmpl,'header','indexviews'));
$this->load->view('template/classic/header');
?>
</header>
<!-- End Header-->

<?php if(isset($home)){?>
<!--Content Info-->
	<section class="container info">
    <?php
    	if($data->page_setting->aboutusinfotext_showhide == 'true')//for about us page
		{
			?>
			<div class="row-fluid">
				<div class="span12 custom-b">
					<?php //$this->load->view('template/'.$tmpl.'/banner');?>
				<?php $this->load->view(getOverridePath($tmpl,'aboutus','indexviews'));?>
				</div>
			</div>
			<?php
		}
		$this->load->view(getOverridePath($tmpl,'widget','indexviews'));
	?>
    </section>
	<!--End Content Info-->
    <!--courses-->
	<?php
	if($data->page_setting->course_showhide == 'true')
	{
		$configarr = $this->settings_model->getItems();
		$totalcourse =$configarr[0]['course_total'];
		$program5= $this->Category_model->getFeaturedProgram($totalcourse);
		if($program5)
		{
	?>
	<section class="container courses">
		<h2 class="animated delay3 fadeInDown"><?php echo $data->page_setting->course_heading?></h2>
    	 <div class="row-fluid "> 
            <?php echo $template['body']; ?>
       </div>  
    </section>
    <?php
	}
	}	
    ?>
	<!--End Courses-->
    <!-- Extra Info-->
    <?php

	if($data->fwt_backgrd_hideshow == 'true')
	{
		if($data->fwt_backgrd_wo == 'false')//background without
		{
	?>
    <section class="extra">
        <div class="container">
            <div class="row-fluid">                
				<?php $this->load->view(getOverridePath($tmpl,'banner','indexviews'));
                   
                   $CI =& get_instance();
				  $CI->load->model('admin/settings_model');
				  $getTestimonial = $CI->settings_model->getTestimonial();

			      $numOfTestinomial = count($getTestimonial);

				  if($getTestimonial)
                  {

                  	
					if($data->testimonial_enable == 'true')
					{

				?>					
                <div class="span4">

                    <!-- <h3>Testimonials</h3> -->
                    <h3 style="font-family :<?php echo $data->widget_heading_font; ?>;font-size : <?php echo $data->widget_heading_size; ?>px;color: <?php echo $data->widget_heading_color; ?>;"><?php echo $data->testimonial_name ?></h3>
                    <!--<div class="carousel">-->
					<div class="<?php if($numOfTestinomial > 2) { echo 'carousel'; } ?>" style="visibility: visible; overflow: hidden; position: relative; z-index: 2; left: 0px; height: 300px;">
	                <ul class="testimonials" style="margin: 0px; padding: 0px; position: relative; list-style-type: none; z-index: 1; height: 1500px; <?php if($numOfTestinomial > 2) { echo 'top: -800px'; } ?>"> <!-- top: -800px; -->
						<?php $this->load->view(getOverridePath($tmpl,'testimonial','indexviews'));?>     	
                    </ul>
					</div>
		            <a href="#" class="navi-right next"></a>
                    <a href="#" class="navi-left prev"></a>
                </div> 

                <?php
                	}
                }
				//with background, widgets footer panel on dated 16-05-2015
				$this->db->select('title,description');
				$this->db->where('area', 'footer');
				$this->db->where('status', '1');

				if($data->testimonial_enable == 'true')
				{
					$query = $this->db->get('mlms_widgets',2);
			    }
			    else
			    {
			    	$query = $this->db->get('mlms_widgets');
			    }
				$result = $query->result_object();
				
				foreach($result as $row)
				{		
				?>
					<div class="span4">
					<div class="top-item" style="text-align: left;">
						<h3 class="iconset iconcommunity" style="font-family :<?php echo $data->widget_heading_font; ?>;font-size : <?php echo $data->widget_heading_size; ?>px;color: <?php echo $data->widget_heading_color; ?>;"><?php echo $row->title;?></h3>
						<p><?php //echo $row->description;
							echo str_replace("<img","<img width='341' ",$row->description);
						?></p>
					</div>
					</div>
				<?php
				}
				?>             
            </div>
        </div>
    </section>
    <?php
		}
	}
    ?>
    <!-- End Extra Info-->
    <!--Newsletter-->
    <section class="newsletter">
    	<div class="container">
    	<?php
    	if($data->fwt_backgrd_hideshow == 'true')
		{
			if($data->fwt_backgrd_wo == 'true')//background without
			{
		?>
    		<section class="container info">
				<div class="row-fluid">
    			<?php
    			//changes on 17-09-2014
			  	$CI =& get_instance();
				$CI->load->model('admin/settings_model');
				$getItemssetting = $CI->settings_model->getItems();

				$callpages = $CI->settings_model->getAllPages();
				$countpage = count($callpages);

				$currenttemplate = $getItemssetting[0]['layout_template'];
				$settings = $CI->settings_model->getTemplateById($currenttemplate);
				$data11 = $settings[0]['options'];
				$data = json_decode($data11);

				/*$data_exp = explode(',' , $data->position_of_pages->footer_content);
				$count = count($data_exp);

				for($j=0; $j<$countpage; $j++)
				{
				    for ($ii=0; $ii<$count; $ii++)
				    {
				        if($callpages[$j]['page_id'] == $data_exp[$ii])
				        {
				        ?>
				        <div class="span4" style="text-align: left;">
				            <h2><?php echo $callpages[$j]['heading']; ?></h2>
				            <p ><?php echo $callpages[$j]['content'];;?></p>    
				        </div> 
				        <?php
				        }        
				    }   
				}*/
				?>		
				<?php 
				$this->load->view(getOverridePath($tmpl,'banner','indexviews'));?>					
                <div class="span4">
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

				<?php
				//with background, widgets footer panel on dated 16-05-2015
				$this->db->select('title,description');
				$this->db->where('area', 'footer');
				$this->db->where('status', '1');
				$query = $this->db->get('mlms_widgets');
				$result = $query->result_object();
				foreach($result as $key=>$row)
				{		
					if($key < 2)
					{
					?>
					<div class="span4">
					<div class="top-item" style="text-align: left;">
						<h3 class="iconset iconcommunity"><?php echo $row->title;?></h3>
						<p><?php echo $row->description;?></p>
					</div>
					</div>
					<?php
					}
				}
				?>
				</div>
			</section>
		<?php
		}
	}
	?>
			
			<?php
			if($data->page_setting->news_letter=='true')
			{
			?>
        	<div class="row-fluid">
            	<h2><?php echo $data->page_setting->news_letter_heading;?></h2>
                <h3><?php echo $data->page_setting->news_letter_content;?></h3>
            	<div id="responseNews"></div>

            	<!--<form id="newsletter" method="post" action="<?php echo base_url(); ?>index/subsription">-->
            	<?php
            			$attributes = array('class' => 'tform', 'name' => 'topform1');
            			echo form_open_multipart(base_url().'index/subscription',$attributes);            			
            	?>
            		<!--<span class="error">
            			<?php
            			$error_email = $this->session->userdata('error_email');
						if(isset($error_email))
						{
							echo '<b>'.$error_email.'</b><br>';
							$this->session->unset_userdata('error_email');
						}
						
            			?>
            		</span>-->

                    <input type="text"  placeholder=" * Name" name="Name" required />
                   <input type="email"  placeholder=" * Email" name="Email"  required/>
                   <input type="submit" class="button" value="Subscribe">
                </form>
            </div>
			<?
			}
			?>
        </div>
    </section>
    <!--End Newsletter-->

<div id="bannerdiv" style="display: none">
    <div id="bannerinn">
    <div id="bannercont">
        <div class="rightpanel <?php echo $signup_box_pos;?>">
            <h2>Login With Facebook</h2>
			<?php $this->load->view(getOverridePath($tmpl,'signup','indexviews'));?>
        </div>
    </div>
    </div>
</div>

<?php } ?>
<div id="search-busy">
    <div id="search-inner"></div>
</div>

<?php if(!isset($home)){?>
	 <?php echo $template['body']; ?>
<?php } ?>

<div id="middlenav" style="display: ">
  <div id="middle">
    <div id="courses">
<?php if(isset($home)){?>
        <div class="leftcontent">
        </div>
        <div class="contentright <?php echo $sidebarpos;?>">
        <div class="rightsidebar">
        </div>
        </div>
<?php } ?>
 <?php $this->load->view(getOverridePath($tmpl,'partials/_flashdata','indexviews'));?>
	</div>
  </div>
</div>

<!--Footer-->
<?php
if($data->page_setting->copyright=='true')
{
	?>
	<footer id='colophon'>
	<?php $this->load->view(getOverridePath($tmpl,'footer','indexviews'));?>
	</footer>
	<?php
}
?>

<!--End Footer-->
<!-- ======================= JQuery libs =========================== -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/bootstrap.js" defer ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.fitvids.min.js" defer ></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.placeholder.min.js" defer ></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.easing.1.3.js" defer ></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.mousewheel.min.js" defer ></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jcarousellite_1.0.1.pack.js" defer ></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/scripts.js" defer ></script>-->
<script type="text/javascript" src="<?php echo base_url()?>public/js/ajaxfileupload.js" defer ></script>

<script type="text/javascript" src="<?php echo base_url(); ?>/public/classic/js/allCombinedJs.js" defer ></script>
<!--
<script type="text/javascript">
$(function() {

	$('#logoimage').live('change',function(e) {

	 var ftpfilename;	

	 filenameerror = '';

		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>category/upload_image/',

		secureuri :false,

		fileElementId :'logoimage',

		dataType : 'json',

		success : function(data,status)

		{

              $('#ajax11').html(data.msg);

		   if(data.status == 'success')

		   {

			ftpfilpreview = '<img src="<?php echo base_url(); ?>public/uploads/settings/img/'+data.filename+'" width="164px" height="44px">';

			$('#previewimage').html(ftpfilpreview);

			ftpfilename = data.filename;

			document.getElementById("logoimagename").value = ftpfilename;

			$('#logouplaoderror').html('');

			}else{

			ftpfilename = data.filename;

			document.getElementById("logoimagename").value = ftpfilename;

			if(ftpfilename==''){

			filenameerror = '';

			}

			$('#logouplaoderror').html('<span class="error">'+data.msg+'</span>');

			}

		}

		});

	});	

	$('#wimage').live('change',function(e) {

	 var ftpfilename;



		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>category/upload_welcome_image/',

		secureuri :false,

		fileElementId :'wimage',

		dataType : 'json',

		success : function(data,status)

		{

              $('#ajax11').html(data.msg);

		    if(data.status == 'success')

		   {

			ftpfilpreview = '<img src="<?php echo base_url(); ?>public/uploads/settings/img/'+data.filename+'" width="164px" height="44px">';

			$('#previewwelcomeimage').html(ftpfilpreview); 

			ftpfilename = data.filename;

			document.getElementById("wimagename").value = ftpfilename;

			$('#wimageerror').html('');
			}else{
			ftpfilename = data.filename;
			document.getElementById("wimagename").value = ftpfilename;
			if(ftpfilename==''){
			filenameerror = '';
			}
			$('#wimageerror').html('<span class="error">'+data.msg+'</span>');

			}
			}
		});
	});	
});
</script>-->

<script type="text/javascript">
//set a footer at bottom , for small content
$(document).ready(function() {
 var bodyHeight = $("body").height();
 var vwptHeight = $(window).height();
 if (vwptHeight > bodyHeight) {
   $("footer#colophon").css("position","absolute").css("bottom",0);
   $("footer#colophon").css("position","absolute").css("left",0);
   $("footer#colophon").css("position","absolute").css("right",0);
 }
});
</script>
</body>
</html>