<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<?php
  $CI =& get_instance();

  $CI->load->model('admin/settings_model'); 

  $getTheme = $CI->settings_model->getItems();

  //$CI->config->load('installation_config');

  

  //print_r($getTheme);

  

  $themestylecss = $getTheme[0]['layouttheme'];

  $pro_id = ( $this->uri->segment(3) )  ? $this->uri->segment(3) : NULL;

  $CI->load->model('program_model'); 

  $getProgram = $CI->program_model->getProgram($pro_id);


  $meta_title = (isset($getProgram->metatitle) && trim($getProgram->metatitle)!= '') ? trim($getProgram->metatitle) : "MLMS";

  $meta_keyword = (isset($getProgram->metakwd) && trim($getProgram->metakwd)!= '') ? trim($getProgram->metakwd) : "MLMS";

  $meta_description = (isset($getProgram->metadesc) && trim($getProgram->metadesc)!= '') ? trim($getProgram->metadesc) : "MLMS Institute"; 

  

  extract($getTheme[0]);

  $signup = json_decode($psgspage);

  $sigup_pos = $signup->courses_image_alignment;

  $signup_box_pos = ($sigup_pos == 0) ? "signup_box_left" : "signup_box_right";

  $sidebar = json_decode($psgpage);

  $sidebar_pos = $sidebar->course_image_alignment;

  $sidebarpos = ($sidebar_pos == 0) ? "sidebar_left" : "sidebar_right";

 //print_r($sidebar->course_image_alignment);

 // $sigup_pos = $signup->courses_image_alignment);

  // $menu_layout = $menulayout->ctgs_image_alignment;

 // $searchbox_val = $searchbox->ctg_image_alignment;

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

  	<title>
    <?php //echo $template['title'];

	echo $getTheme[0]['institute_name'];
    
	?>
    </title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<meta http-equiv='expires' content='1200' />

	<meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />	

	<meta name="keywords" content="<?php echo $meta_keyword; ?>"/>

	<meta name="description" content="<?php echo $meta_description; ?>" />

	<meta name="generator" content="<?php echo $meta_title; ?>" />

    <script src="<?php echo $this->config->item('base_url') ?>/public/<?php 
	if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/js/jquery-1.7.1.min.js')){
	echo $tmpl."/";}else{echo "default/";}?>js/jquery-1.7.1.min.js" type="text/javascript"></script>

    <script src="<?php echo $this->config->item('base_url') ?>/public/<?php 
	if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/js/jquery-ui-1.8.21.custom.min.js')){
	echo $tmpl."/";}else{echo "default/";}
	?>js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>

    <?php
    if($tmpl == 'corporate'){
    ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/<?php echo $tmpl; ?>/css/corporate.css" media="screen"  />
       <?php }?>

    <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php
	if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/css/'.$themestylecss)){
	echo $tmpl."/";}else{echo "default/";}
	?>css/<?php echo $themestylecss;?>" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/redactor/css/redactor.css" />


	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php
	if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/css/reset.css')){
	echo $tmpl."/";}else{echo "default/";}
	?>css/reset.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/css/smoothness/jquery-ui-1.8.21.custom.css')){
	echo $tmpl."/";}else{echo "default/";}
	?>css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php 
	 if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/css/bstyles.css')){
	echo $tmpl."/";}else{echo "default/";}
	?>css/bstyles.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php 
	if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/css/colour_standard.css')){
	echo $tmpl."/";}else{echo "default/";}
	?>css/colour_standard.css" type="text/css" media="screen" />

    <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>/public/<?php 
	if(file_exists('/home/createon/public_html/prshah8333/public/'.$tmpl.'/css/front_style.css')){
	echo $tmpl."/";}else{echo "default/";}
	?>css/front_style.css" type="text/css" media="screen" />

    <script src="<?php echo base_url(); ?>public/js/redactor/redactor.js"></script>

	<?php echo $template['metadata']; ?>


	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<meta name="description" content="description">
	<meta name="author" content="mustachethemes">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Fav and touch icons
	================================================== 
    <link rel="shortcut icon" href="img/favicon.ico">-->

	<!-- Custom styles
	================================================== -->
    <!--<link href="<?php echo base_url(); ?>public/default/css/color/red.css" rel="stylesheet" media="screen"> -->
	<!--[if IE 8 ]><link href="css/ie8.css" rel="stylesheet" media="screen"><![endif]-->

	<!-- Scripts Libs
	================================================== -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.min.js"></script> <!-- 1.9.1 -->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements
	================================================== -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body class="<?php echo $template['title'];?>">

<?php

$sessionarray = $this->session->userdata('logged_in');

//print_r($sessionarray);

//print_r($this->config->item('steps'));

//print_r($this->config->item('stepsstatus'));

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



<?php //print_r($this->config); ?>

	<!-- Header-->
    <header>

    <?php 
	if(file_exists('/home/createon/public_html/prshah8333/application/views/template/'.$tmpl.'/header.php')){
	$this->load->view('template/'.$tmpl.'/header');}
	else{
	$this->load->view('template/default/header');
	}?>

    </header>
    <!-- End Header-->

<?php if(isset($home)){?>
<!--Content Info-->
	<section class="container info">
    	<div class="row-fluid">

            <div class="span4">
                <?php //$this->load->view('template/'.$tmpl.'/banner');?>
                <?php 
				if(file_exists('/home/createon/public_html/prshah8333/application/views/template/'.$tmpl.'/aboutus.php')){
				$this->load->view('template/'.$tmpl.'/aboutus');}
				else{
				$this->load->view('template/default/aboutus');
				}?>
            </div>
            <div class="span4">
            	<div class="top-item">
                    <h3 class="iconset iconbestcity animated delay6 fadeInDown">Best City in the World</h3>
                    <p class="animated delay7 fadeInUp">Manhattan University is ranked number orem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus faucibus porttitor laniquam enim ligula.</p>
                    <p class="animated delay7 fadeInUp">Amalesuada at aliquet a, molestie eget eros. Donec felis nisl, scelerisque nec porttitor. </p>
                </div>

                <div class="bottom-item">
                    <h3 class="iconset iconworldwide animated delay6 fadeInDown">Worldwide Gratudates</h3>
                    <p class="animated delay7 fadeInUp">We are in the top asellus faucibus porttitor lacinia. Aliquam enim ligula, malesuada at aliquet a, molestie eget eros.  </p>
                    <p class="animated delay7 fadeInUp">Donec felis nisl, scelerisque nec porttitor sed, scelerisque sed tortor. Quisque quis nisl neque, nec lobortis tortor.   </p>
                </div>

            </div>



            <div class="span4">
            	<div class="top-item">
                    <h3 class="iconset iconcommunity animated delay8 fadeInDown">Student Community</h3>
                    <p class="animated delay9 fadeInUp">Manhattan University offers a safe and nice welcoming to  um dolor sit amet, and consectetur adipiscing.</p>
                    <p class="animated delay9 fadeInUp">Aliquam enim ligula, malesuada at aliquet a, molestie eget erosonec felis nisl. </p>
                </div>
                <div class="bottom-item">
                    <h3 class="iconset iconfacilities animated delay8 fadeInDown">The finest facilities</h3>
                    <p class="animated delay9 fadeInUp">Set on 328 hectares of sit amet, consectetur adipiscing elit. </p>
                    <p class="animated delay9 fadeInUp">Phasellus faucibus porttitor laciniliquam enim ligula malesuada at aliquet molestie. </p>
                </div>
            </div>


        </div>
    </section>
	<!--End Content Info-->
    <!--courses-->
	<section class="container courses">
		<h2 class="animated delay3 fadeInDown">Take the world's best courses online</h2>

    	<div class="row-fluid ">

            <?php echo $template['body']; ?>

        </div>
    </section>
	<!--End Courses-->

    <!-- Extra Info-->
    <section class="extra">
        <div class="container">

            <div class="row-fluid">

                <div class="span4">
                    <?php 
					if(file_exists('/home/createon/public_html/prshah8333/application/views/template/'.$tmpl.'/banner.php')){
					$this->load->view('template/'.$tmpl.'/banner');
					}else{
					$this->load->view('template/default/banner');
					}?>
                </div>

                <div class="span4">
                    <h3>Graduates Testimonials</h3>
                    <div class="carousel">
                        <?php 
						if(file_exists('/home/createon/public_html/prshah8333/application/views/template/'.$tmpl.'/testimonial.php')){
							  $this->load->view('template/'.$tmpl.'/testimonial.php');
							  }else{
							  $this->load->view('template/default/testimonial');
							  }
						?>
                    </div>
                    <a href="#" class="navi-right next"></a>
                    <a href="#" class="navi-left prev"></a>


                </div>

                <div class="span4">
                    <h3>Scholarships</h3>
                    <img class="scholarships" src="<?php echo base_url(); ?>public/default/images/shcolarship.jpg" alt="#" />
                    <p>Entesque congue, nibh in hend go to rerit dignissim, dolor urna tincidunt felis, bibendum euismod. </p>
                    <p>Proin vulputate orci non mi aliquet aliquam. Aliquam tincidunt arcu eu sem tempus and  facilisis bibendum tellus vtate... <a href="#">Read more</a> </p>

                </div>
            </div>

        </div>
    </section>
    <!-- End Extra Info-->





    <!--Newsletter-->
    <section class="newsletter">
    	<div class="container">
        	<div class="row-fluid">
            	<h2>Newsletter Suscription</h2>
                <h3>Suscribe to University newsletter list  and ibh in hendrerit and dignisdolor urna. All fields with an * are required.</h3>
            	<div id="loadingNews" style="display: none" class='alert'>
	  				<a class='close' data-dismiss='alert'>�</a>
	  				Loading
				</div>
            	<div id="responseNews"></div>

            	<form id="newsletter" method="post" action="#">
                   <input type="text"  placeholder=" * Name" name="Name" />
                   <input type="email"  placeholder=" * Email" name="Email" />
                   <input type="submit" class="button" value="Send Email">
                </form>
            </div>

        </div>
    </section>
    <!--End Newsletter-->

<div id="bannerdiv" style="display: none">

    <div id="bannerinn">

    <div id="bannercont">

        <div class="rightpanel <?php echo $signup_box_pos;?>">

            <h2>Login With Facebook</h2>

            <?php 
			if(file_exists('/home/createon/public_html/prshah8333/application/views/template/'.$tmpl.'/signup.php')){
			  $this->load->view('template/'.$tmpl.'/signup');
			}else
			{
				$this->load->view('template/default/signup');
				}?>

        </div>

    </div>

    </div>

</div>

<?php } ?>

<div id="search-busy">

    <div id="search-inner"></div>

</div>

<!--<?php if(isset($home)){?>

<div id="slidernav">

  <div id="slider">

  <a href="<?php //echo base_url(); ?>"><img border="0" alt="" src="<?php //echo base_url(); ?>public/<?php //echo $tmpl?>/images/slider1.png"></a>

  </div>

</div>

<?php } ?>-->

<!--<div id="welcomenav">

  <div id="welcome">

    <div class="icon_rss">

    <img border="0" alt="" src="<?php //echo base_url(); ?>public/<?php //echo $tmpl?>/images/icon_rss.png">

    </div>

    <div class="wel_title">

        Welcome to <span>mLMS</span> the e-learning website!

    </div>

    <div class="pricing">

        <a href="index.html"><span>See Pricing</span></a>



    </div>

  </div>

</div>-->
<?php if(!isset($home)){?>

    <!--courses-->
	<section class="container courses">

    	<div class="row-fluid ">

            <?php //echo $template['body']; ?>

        </div>
    </section>
	<!--End Courses-->

<?php } ?>

<div id="middlenav" style="display: ">

  <div id="middle">

    <div id="courses">

<?php if(isset($home)){?>

        <div class="leftcontent">

        <?php //$this->load->view('template/'.$tmpl.'/aboutus');?>

        </div>

        <div class="contentright <?php echo $sidebarpos;?>">

        <div class="rightsidebar">



        </div>

        </div>

<?php } ?>

		<?php 
		if(file_exists('/home/createon/public_html/prshah8333/application/views/template/'.$tmpl.'/partials/_flashdata.php')){
		$this->load->view('/template/'.$tmpl.'/partials/_flashdata');
		}else{
		$this->load->view('/template/default/partials/_flashdata');
		}?>



    </div>

  </div>

</div>

    <!--Footer-->
    <footer>

 <?php 
 if(file_exists('/home/createon/public_html/prshah8333/application/views/template/'.$tmpl.'/footer.php')){
 $this->load->view('template/'.$tmpl.'/footer');
 }else{
 $this->load->view('template/default/footer');
 }
 ?>

    </footer>
    <!--End Footer-->
	<!-- ======================= JQuery libs =========================== -->
        <!-- Bootstrap.js-->
        <script src="<?php echo base_url(); ?>public/default/js/bootstrap.js"></script>

    	<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.fitvids.min.js"></script>
    	<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.placeholder.min.js"></script>

		<!-- carrousell -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jquery.mousewheel.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/jcarousellite_1.0.1.pack.js"></script>

		<!-- custom -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/default/js/scripts.js"></script>

	<!-- ======================= End JQuery libs =========================== -->






<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

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

</script>



<script>



 

 $(document).ready(

 function()

 {

	

     $('#wdesc').redactor();

	 $('#adesc').redactor();

 }

 );
</script>

</body>
</html>