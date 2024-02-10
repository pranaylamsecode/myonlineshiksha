<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js" defer ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js" defer ></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js" defer ></script>-->
<!--<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.lightbox_me.js" defer ></script>-->

<script type="text/javascript" src="<?php echo base_url();?>public/js/redactor123/assets/redactor.min.js" defer ></script>
<!--<script type="text/javascript" src="<?php echo base_url();?>public/js/redactor-js-master/redactor/redactor.min.js" defer ></script>-->

<!--<script type="text/javascript"> 
$('body').bind('copy paste',function(e) {
    e.preventDefault(); return false; 
});
//below javascript is used for Disabling right-click on HTML page
//document.oncontextmenu=new Function("return false");//Disabling right-click
//below javascript is used for Disabling text selection in web page
document.onselectstart=new Function ("return false"); //Disabling text selection in web page
if (window.sidebar){
document.onmousedown=new Function("return true"); 
document.onclick=new Function("return true") ; 
 
//Disable Cut into HTML form using Javascript 
document.oncut=new Function("return false"); 

//Disable Copy into HTML form using Javascript 
document.oncopy=new Function("return false"); 

//Disable Paste into HTML form using Javascript  
document.onpaste=new Function("return false"); 
}
</script>-->
<link rel="stylesheet" href="<?php echo base_url();?>public/js/redactor123/assets/redactor.css">
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/top_header.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/font-icons/entypo/css/entypo.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css" media="screen" />



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
//echo ($auth['groupid']);
$logoimage=$getItemssetting[0]['logoimage'];
$title = $getItemssetting[0]['univer_title'];
$tagline_font = $getItemssetting[0]['tagline_font'] ? $getItemssetting[0]['tagline_font'] :'';
$tagline_font_size = $getItemssetting[0]['tagline_font_size'] ? $getItemssetting[0]['tagline_font_size'] :'';
$tagline_font_color = $getItemssetting[0]['tagline_font_color'] ? $getItemssetting[0]['tagline_font_color'] :'';
extract($getItemssetting[0]);
$menulayout = json_decode($ctgspage);
$searchbox = json_decode($ctgpage);
$menu_layout = $menulayout->ctgs_image_alignment;
$searchbox_val = $searchbox->ctg_image_alignment;
$userDetail = $CI->settings_model->getAllUsersDetail($auth['id']);
$notification = $CI->settings_model->getNotification($auth['id']);
$viewed = 0;
foreach($notification as $notify)
{
	if($notify->viewed == 0)
	{
		$viewed++;
	}
}
$LM =& get_instance();
$LM->load->model('login_model');
$get_student_instr = $LM->login_model->get_student_instr();
?>
<?php
       $CI = & get_instance();
       $CI->load->model('admin/settings_model');
       $getExpireDays = $CI->settings_model->getExpireDays(1,'mlms_academydetails');
       if($getExpireDays)
       {
        //print_r($getExpireDays);
        
        $currentdate = date('Y-m-d');
        $date1 = new DateTime($currentdate);
        $date2 = new DateTime($getExpireDays->academy_expired);
        $interval = $date2->diff($date1);
        //echo $interval->days;
       }
 ?>
<?php 
	 if($auth){
	 	if($auth['groupid'] != 1){
	       if (($interval->days < -1)){
	        $this->load->helper('url');
	        redirect(base_url().'admin/users/expired_academy');
	       }
	   }
	 }
	
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/slidebars.min.css">-->
<!--<script src="<?php echo base_url(); ?>assets/js/slidebars.min.js" defer ></script>-->
<!-- Top Bar -->
<?php
//if($data->page_setting->topbarloginregister_showhide == 'left')
//{
	?>
	<style>
	#headtop1 {
		float: right;
	}
	#headtop2 {
		float:left;
	}
	</style>
	<?php
//}
?>
<style>
#msgspan h2 {
  margin: -15px 0 -15px 20px;
  font-size: 20px;
  text-align: left;
  font-weight: 600;
}

.tempo {
	position: relative;
	float:right;
	/*padding: 5px;*/
	padding: 3px;
	border-radius: 4px;
	/*width:36px;*/
	width:30px;
	/*height: 36px;*/
	height: 30px;
	font-size: 12px;
	font-weight: 700;
	line-height: 1.5;
	background: rgba(228, 226, 226, 0.54)!important;
	text-align:center;
}
.displayToggle .list-cat-up {
	width: 100%;
	margin-top: 10px;
	text-align:left;
	text-decoration:none;
}

#headtop2 .btn-icon
{
	padding: 6px;
	margin: 0;
	position: absolute;
	right: 0px;
	top: 0;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
    $('#userToggle').click(function(evt) {
        $(".displayToggle").toggle('fast');
		evt.stopPropagation();
    });

    <?php
        if($this->input->get('eml'))
        {
    	 	$first1 = $this->login_model->first_time_login_main($this->input->get('eml'));
    	 	if($first1->group_id == 4 && $first1->first_time_login == '0')
			{
			    ?>
			    $(document).ready(function(){		  
						$("#first_time").click();
				});	
				<?php
			}
		}
	?>    
});

function closeLogin() 
{
	//$("#lean_overlay").fadeOut(200);
	$('#signup').css({"display":"none"})
}
function closeRegi() 
{
	//$("#lean_overlay").fadeOut(200);
	$('#registration').css({"display":"none"})
}
function closeForget() 
{
	//$("#lean_overlay").fadeOut(200);
	$('#forget').css({"display":"none"})
}
</script>
<script type="text/javascript">
	$(document).ready(function () {
    $('body').click(function() {
        $(".displayToggle").hide('fast');		
    });
});
</script>


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
<div class="top">
  <div class="container">
    <div>
      <div id="headtop1" class="top_bar_right">
        <div class="mainmenu" id="headd">
          <div class="main_menu menupos_right">
            <ul class="mainmenuul_top" style="display:block;">
              <?php

			if(@$get_student_instr->is_instructor == '1' || @$userDetail[0]['group_id'] == '2' || @$userDetail[0]['group_id'] == 5 || @$userDetail[0]['group_id'] == 4) // added by jayesh
			{
			?>
              <?php
			}
			else
			{
			?>
              <li><a style="color:white;" href="<?php echo base_url(); ?>users/instructor">Become an Instructor </a></li>
              <li style="color:white;">|</li>
              <?php
			}
				$auth = $this->session->userdata('logged_in');
				
                if($auth)
				{
				  
				}
				else
				{
					?>
				<script type="text/javascript">
					$(function() {
					$('a[rel*=leanModal]').leanModal({ closeButton: ".modal_close" });		
					});
				
					$(document).ready(function() {
					$("#trigger_id").leanModal();
					});					
				</script> 				
				<li><a style="color:white;" id="go" rel="leanModal" name="signup" href="#signup">Login</a></li>

				<a href="#showFirstTime" id="first_time" rel="leanModal" style="display: none;" name="FirstTime">First Time</a>

				<li style="color:white;">|</li>
				<li><a style="color:white;" id="go" rel="leanModal" name="registration" href="#registration">Register</a></li>
			  <?php
				}
				?>
				<?php
				
				if(@$get_student_instr->is_instructor == '1' || @$userDetail[0]['group_id'] == '2' || @$userDetail[0]['group_id'] == 5 || @$userDetail[0]['group_id'] == 4) //added by jayesh
				{
					if($userDetail[0]['group_id'] == 4)
					{
				?>
				<li class="after_login" onclick="viewsite();" ><a href="#" title='Manage Academy'><i class="entypo-vcard ent-vc"></i><span class="ent-vc1" style="color:white">Manage Academy</span></a>
				 |
				 <?php
				}
				 ?>
				<li class="dropdown after_login"><a href="#" title='Your Teaching Zone'><i class="entypo-sound ent-vc"></i><span class="ent-vc1" style="color:white">Your Teaching Zone</span><i class="entypo-down-open-mini"></i></a>
                <ul style="width: 196px;">
                  <li><a href="<?php echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
                  <li><a href="<?php echo base_url(); ?>manage-exams"><span>Manage Question Papers</span></a></li>
                  <li><a href="<?php echo base_url(); ?>questions/manage"><span>Manage Questions</span></a></li>
                  <li><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
                  <li><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
                  <li><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
                  <li><a href="<?php echo base_url(); ?>orders/percentageOrders"><span>Courses Sale</span></a></li>
                  <!-- <li><a href="<?php echo base_url(); ?>studreport/designstructure"><span>Design Structure</span></a></li> -->
				  <?php
						if(@$userDetail[0]['group_id'] == 5)
						{
				  ?>
                  <li><a href="<?php echo base_url(); ?>income/lists"><span>Your Income</span></a></li>
				  <?php
						}
				  ?>
                </ul>
				</li>
			    |
				<?php
				}
				if(@$get_student_instr->is_student == '1')
				{			   
				?>            
				<li class="dropdown after_login"><a href="#" title='Your Learning Zone'><i class="entypo-brush ent-vc"></i><span class="ent-vc1" style="color:white">Your Learning Zone</span><i class="entypo-down-open-mini"></i></a>
                <ul>
                  <li><a href="<?php echo base_url(); ?>my-courses"><span>Courses You Read</span></a></li>
                  <li><a href="<?php echo base_url(); ?>my-exams"><span>Exams Appeared</span></a></li>
                  <li><a href="<?php echo base_url(); ?>my-certificates"><span>Your Certificates</span></a></li>
				  <li><a href="<?php echo base_url(); ?>my-orders"><span>Your Orders</span></a></li>
                </ul>
				</li>
				<?php			   
			}
			if($auth)
			{
				if(@$get_student_instr->is_student == '1' || @$get_student_instr->is_instructor == '1')
				{
			?>
			 <li class="dropdown after_login"> <a href="#notification" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="entypo-bell" style="color:#FFFFFF; font-size: 18px;"></i> <span class="badge badge-info"><?php echo $viewed; ?></span></a> </li>
			  
              
			<?php
				
				}
			}		
			?>
			 
			 
            <?php
			if($auth)
			{
             	if($userDetail)
             	{		 		
				?>
				<li class="dropdown " id='userToggle'><a href="#">
				<!--<i class="entypo-down-dir" style="float:right;"></i>-->
				<span class="tempo">
				<img border="0" alt="" src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo ($userDetail[0]['images']) ? $userDetail[0]['images'] : 'default.jpg'  ?>" class="img-circle" ></span>
				</a> </li>
				<?php
				}
				else
				{
					$this->session->unset_userdata('logged_in');
					redirect('index/index');
				}				  
			}
			?>
            </ul>
            <?php
            if($auth)//if login
			{
            ?>
            <div class='displayToggle' style='display:none'>
              <ul style="text-align:right;">
                <li>
                  <div class="dropdown-menu" style="display:block;">
                    <div>
                      <div style="float:left; display:inline-block"><img width='90' height='90' border="0" class="img-circle" alt="" src="<?php echo base_url(); ?>public/uploads/users/img/thumbs/<?php echo (@$userDetail[0]['images']) ? @$userDetail[0]['images'] : 'default.jpg'  ?>"  > 
                        <!--sygcuaipsbvguisb--> 
                      </div>
                      <div style="float:right;display:inline-block"> <b style="color: black;"><?php echo $auth['first_name']; ?></b>
                        <ul class="list-cat-up">
                          <!--<li style="display: list-item; float: left;"> <a href="#" style="color: #91A1AF;"> <i class="entypo-attention"></i> <span class="badge badge-info">6</span></a> </li>-->
                          <!-- <li style="display: list-item; float: left;"> <a href="#" style="color: #91A1AF;"> <i class="entypo-user"></i> </a> </li>
                          <li style="display: list-item; float: left;"> <a href="#" style="color: #91A1AF;"> <i class="entypo-pencil"></i> </a> </li>
                          <li style="display: list-item; float: left;"> <a href="#" style="color: #91A1AF;"> <i class="entypo-tools"></i> </a> </li> -->
                        </ul>
                      </div>
                    </div>
                    <div class="clr"></div>
                    <hr style="margin:10px 0;" />
                    <ul>
                      <li><a  href="<?php echo base_url(); ?>my-account"><i class="entypo-home" style="margin-right: 10px;"></i><b>My Profile</b> </a> </li>
                      <br />
                      <hr style="margin:10px 0;" />
					  <li><a  href="<?php echo base_url(); ?>my-wishlists"><i class="entypo-heart" style="margin-right: 10px;"></i><b>My Wishlists</b> </a> </li>
					  <br />
                      <hr style="margin:10px 0;" />
                      <li><a  href="<?php echo base_url(); ?>users/logout"><i class="entypo-logout" style="margin-right: 10px;"></i><b>Log Out</b> </a> </li>
					  
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
            <?php
        	}
            ?>
          </div>
        </div>
      </div>     
	  
	 <?php
		if($data->page_setting->searchbox_showhide == 'true')
		{
	 ?>
      <form name="search_box"  action="<?php echo base_url();?>category/search" method="post">
        <p class="animated fadeInRight" id='headtop2'>
          <input type="text" id="searchtext" class="search_box" name="searchtext" value="<?php echo (isset($_GET['searchtext'])) ? $_GET['searchtext'] : ''; ?>" placeholder="Search For Courses"  style="margin:0;"/>
          <button type="submit" class="btn btn-lg btn-icon"><i class="entypo-search"></i></button>
        </p>
      </form>
	  <?php
		}
	  ?>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>
<!-- End Top Bar --> 
<!-- Nav-->

<nav>
  <div class="container">
    <div class="row-fluid"> 
      <!-- Logo-->
      <div class="span3" id='span33' >  <a href="<?php echo base_url(); ?>" class="logo">
      <img border="0" alt="" src="<?php echo base_url(); ?>public/uploads/settings/img/logo/<?php echo $logoimage;?>" width="209px" height="80px"></a> </div>
      <!-- End Logo--> 
      <!-- Intro Text-->
      <div class="span9">
        <h1 class="animated delay2 fadeInDown" id='headd' style="font-family :<?php echo $tagline_font; ?>;font-size : <?php echo $tagline_font_size; ?>px;color: <?php echo $tagline_font_color; ?>;"> <?php echo $title; ?></h1>
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
					if($data->page_setting->searchbox_showhide == 'true')
					{
						$attributes = array('class' => 'tform', 'name' => 'topform1');
            			echo form_open_multipart('index/search_result',$attributes);
            			$sess_search_course = $this->session->userdata('sess_search_course');
						?>
          <!---<div class="searchform <?php echo $searchboxval;?>" id='headd'>
							<input type="text" id="searchtext" class="search_box" name="searchtext" value="<?php echo (isset($sess_search_course['searchterm'])) ? $sess_search_course['searchterm'] : ''; ?>" placeholder="Search" />
							<input type="submit" value="Search" name="searchkeyword" id="searchkeyword" class="btn button animated bounceIn" />
						</div>-->
          <?php		
						echo form_close();						
					}
					?>
        </div>
      </div>
    </div>
  </div>
</nav>
<header>
  <?php
								if(isset($aboutpage[0]['heading']))
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">
									     
									          <div class="page-title">
									            <?php
																		echo $aboutpage[0]['heading'];
																		?>
									          </div>

									        <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">About Us</a>
											</div>
									       
									    </div>
									  </section>
									  <?php
								}
								else if(isset($contactpage[0]['heading']))
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo $contactpage[0]['heading'];
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Contact Us</a>
											</div>

									    </div>
									  </section>
									  <?php
								}									
								else if($this->uri->segment(1)=='testimonials') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <a href = '<?php echo base_url().'testimonials/alltestimonials'?>'>Testimonials</a>   
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Testimonials</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if($this->uri->segment(2)=='registration')
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "Don't have an account? Join Today!";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Registration</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if(isset($resourcepage[0]['heading']))
								{
									?>
								    <section class="breadcrumb">
								    <div class="container">
								        <div class="page-title">
								            <?php
											echo $resourcepage[0]['heading'];
											?>
								        </div>

								        <div class="bread-view">
										    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
										    <span class="ng-hide">/ </span>
										    <a href="#"><?php echo $resourcepage[0]['heading'];?></a>
										</div>
								    </div>
								    </section>
								   <?php
								}
								else if($this->uri->segment(1)=='courses' && $this->uri->segment(2)=='')
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">List Of Course Category</div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">List Of Course Category</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if($this->uri->segment(1)=='courses' || $this->uri->segment(2)=='view') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">List Of Course</div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="<?php echo base_url();?>courses">List Of Course Category</a>
											    <span class="ng-hide">/ </span>
											    <a href="#">List Of Course</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if($this->uri->segment(2)=='instructor') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "Become an Instructor";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Become an Instructor</a>
											</div>

									    </div>
									  </section>
									  <?php
								}		
								else if($this->uri->segment(1)=='my-courses') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "My Courses";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Courses</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if($this->uri->segment(1)=='my-exams') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "My Exams";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Exams</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if($this->uri->segment(1)=='my-certificates') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "My Certificates";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Certificates</a>
											</div>

									    </div>
									  </section>
									  <?php
								}		
								else if($this->uri->segment(1)=='my-account') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "My Account";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Account</a>
											</div>

									    </div>
									  </section>
									  <?php
								}			
								else if($this->uri->segment(2)=='login') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "Login Now";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Login</a>
											</div>

									    </div>
									  </section>
									  <?php
								}			
								else if($this->uri->segment(1)=='manage' && $this->uri->segment(2)=='courses') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "Manage The Course You Teach";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Manage The Course</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if($this->uri->segment(1)=='manage-exams') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "Manage Exam Papers";
																		?>
									          </div>
									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Manage Exam Papers</a>
											</div>

									    </div>
									  </section>
									  <?php
								}
								else if($this->uri->segment(1)=='course-media-category' && $this->uri->segment(2)=='manage') 
								{
									?>
								  <section class="breadcrumb">
								    <div class="container">

								          <div class="page-title">
								            <?php
																	echo "Media Category Manager";
																	?>
								          </div>

								          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Media Category Manager</a>
											</div>

								    </div>
								  </section>
  								<?php
								}
								else if($this->uri->segment(1)=='course-media' && $this->uri->segment(2)=='manage') 
								{
									?>
							  <section class="breadcrumb">
							    <div class="container">

							          <div class="page-title">
							            <?php
																echo "Media Library";
																?>
							          </div>

							          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Development</a>
											</div>

							    </div>
							  </section>

  								<?php
								}
								else if($this->uri->segment(1)=='my-orders-invoice') 
								{
									?>
							  <section class="breadcrumb">
							    <div class="container">

							          <div class="page-title">
							            <?php
																echo "Order Invoice";
																?>
							          </div>

							          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Development</a>
											</div>

							    </div>
							  </section>

							  <?php
								}
								else if($this->uri->segment(1)=='my-orders') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">

									          <div class="page-title">
									            <?php
																		echo "Your Course Orders List";
																		?>
									          </div>
									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ng-hide">/ </span>
											    <a href="#">Development</a>
											</div>

									    </div>
									  </section>
									  <?php
								}								
								else if($this->uri->segment(2)=='enrolled') 
								{
									?>
									  <section class="breadcrumb">
									    <div class="container">
	
									          <div class="page-title">
									            <?php
																		echo "Enrolled Students List";
																		?>
									          </div>

									          <div class="bread-view">
											    <a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
											    <span class="ngslash">/ </span>
											    <a href="#">Development</a>
											</div>

									    </div>
									  </section>
									  <?php
								}								
								else
								{
								}
								?>
				<?php
				if($data->page_setting->banner_showhide == 'true')//banner condition
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

				if($data->page_setting->slider_showhide == 'true')//slider condition
				{
					if($this->uri->segment(1)=='index' || $this->uri->segment(1)=='')
				        {
					if($this->uri->segment(1) != 'programs')
				    {
						$this->load->view(getOverridePath($tmpl,'slider2','indexviews'));
					}
					}
				}
				?>
</header>

<!-- End Slider -->

<!-- POP UP Login Form -->

<form role="form" class ="tform" action="#" name="studentForm" id="studentForm" method="post">

<div id="signup">
<span id="msgspan"></span>
	<div id="signup-ct">
    <div id="signup-header">
		<h2>Do you have an account?</h2>
		<a class="modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
	</div>
	
	<?php
	    $this->load->config('oauth2', TRUE);
	     $CI = & get_instance();
	     $CI->load->model('admin/settings_model');
	     $socialstatus = $this->settings_model->getSocialStatus(1,'mlms_socialstatus');
	     if($socialstatus->social_login == 1)
	     {
		if($this->config->item('facebook_id', 'oauth2') || $this->config->item('google_id', 'oauth2'))
		{
		?>
		<div class="left_panel_log_popup">
		<h5>Login with social accounts</h5>
		<?php
			$socialloginarray = json_decode($sociallogin);//variable sociallogin is come from database field json array onb date 08-09-2015
			if((empty($socialloginarray->facebook->appid)) && (empty($socialloginarray->facebook->appsecretkey)))//if fb details is blank
			{
			 	$fbUrl = '#';	
			}else
			{
			 	$fbUrl = base_url().'hauth/login/Facebook';
			}
			if((empty($socialloginarray->googleplus->clientid)) && (empty($socialloginarray->googleplus->clientsecreatekey)))//if googleplus details is blank
			{
			 	$gpUrl = '#';	
			}else
			{
			 	$gpUrl = base_url().'auth_oa2/session/google/';
			}

		// fetch social variables (facebook,google id,secreatekey)	
		if((!empty($socialloginarray->facebook->appid)) && (!empty($socialloginarray->facebook->appsecretkey)))			
			{			
				?>
				<div class="social_btn_space">
				<!-- <a href="<?php echo $fbUrl; ?>" class="btn btn-fb-social"><i class="entypo-facebook social-icon"></i> -->
				<a  class="btn btn-fb-social facebook"><i class="entypo-facebook social-icon"></i>
				<span>Login with Facebook</span></a>
				</div>
				<?php
			}

			if((!empty($socialloginarray->googleplus->clientid)) && (!empty($socialloginarray->googleplus->clientsecreatekey)))
			{
				?>
				<div class="social_btn_space">
				<!-- <a href="<?php echo $gpUrl;?>" class="btn btn-google-social"><i class="entypo-gplus social-icon"></i> -->
				<a class="btn btn-google-social google"><i class="entypo-gplus social-icon"></i>
				<span>Login with Google+</span></a>
				</div> 
				<?php
			}
		?>
		</div>
		<?php
		}
	}
	?>

	<!--
	<a style="color:white;" href="http://veerit123.createonlineacademy.com/users/registration">Register</a>
	<a style="color:white;" id="go" rel="leanModal" name="signup" href="#signup">Login</a>
	-->
	<?php if ($socialstatus->social_login == 0) { ?>
		<style>
			#signup .right_panel_log_popup 
			{
				    padding: 20px 20px 10px;
				    width: 65%;
				    margin: 0 auto;
				    border-left: 0px solid #d3d3d3 !important;
				    float: none !important;
			}
			#signup .right_panel_log_popup h5{
				text-align: center;
			}
		</style>
	<?php } ?>
	<div class="right_panel_log_popup"> 
		<h5>Login with your email</h5>	
		<div id="messageStudent"></div>
		<div class="txt-fld">
			<input id="email1" type="text" size="15" onkeypress="Javascript: if (event.keyCode==13) loginUser();" name="email" autocomplete="off" value="" placeholder="E-mail" />
		</div>
		<div class="txt-fld">
			<input id="password1" type="password" onkeypress="Javascript: if (event.keyCode==13) loginUser();" name="password" autocomplete="off" value="" size="38" placeholder="Password"/>
		</div>
		<div class="btn-fld">
		<button type="button" onclick="loginUser();" id ="studentLogin" class="btn-primary_stb" style="width:100%">Log In</button>
		</div>		
		
		<div class="txt-fld"><p>or
		<a id="go" onclick="closeLogin();" rel="leanModal" name="forget" href="#forget"> Forgot Password</a></p>
		</div>
	</div>	

	<div style="clear:both;"></div>
	
    <div class="bottom_panel_log_popup">
		<p>Don't have an account? <a onclick="closeLogin();" id="go" class="registration" rel="leanModal" name="registration" href="#registration">Signup</a></p> 
    </div>	    
  </div>
</div>
</div>
</form>

<!-------Registration PopUp-------------------------------------------------------------------------->
<form role="form" class ="tform"  action="<?php echo base_url();?>users/registrationPopup/" name="registerPopup" id="registerPopup" method="post">
<div id="registration">
<div id="signup-ct">
<div id="signup-header" style="padding: 1px 18px 5px 18px;">
	<h2>Sign up and start learning!</h2>
	<a class="modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
</div>

<div class="resister_up_block">
<div class="box-footer">
	<h4>Sign Up With Social Accounts</h4>	
	<ul class="social-networks">
		<?php

		 $socialloginarray = json_decode($sociallogin);//variable sociallogin is come from database field json array onb date 08-09-2015
		 if((empty($socialloginarray->facebook->appid)) && (empty($socialloginarray->facebook->appsecretkey)))//if fb details is blank
		 {
		 	$fbUrl = '#';	
		 }else
		 {
		 	$fbUrl = base_url().'hauth/login/Facebook';
		 }
		 if((empty($socialloginarray->googleplus->clientid)) && (empty($socialloginarray->googleplus->clientsecreatekey)))//if googleplus details is blank
		 {
		 	$gpUrl = '#';	
		 }else
		 {
		 	$gpUrl = base_url().'auth_oa2/session/google/';
		 }
		?>

		<li>
		<?php
		if((!empty($socialloginarray->googleplus->clientid)) && (!empty($socialloginarray->googleplus->clientsecreatekey)))		
		 {
		?>
			<div class="social_btn_space">
			<!-- <a href="<?php echo $gpUrl;?>" class="btn btn-google-social"><i class="entypo-gplus social-icon"></i> -->
			<a class="btn btn-google-social google"><i class="entypo-gplus social-icon"></i>
			<span>Login with Google+</span></a>
			</div>
		<?php } ?>
		</li>
		<li>
		<?php 
		if((!empty($socialloginarray->facebook->appid)) && (!empty($socialloginarray->facebook->appsecretkey)))
		{
		?>
			<div class="social_btn_space">
			<!-- <a href="<?php echo $fbUrl;?>" class="btn btn-fb-social"><i class="entypo-facebook social-icon"></i> -->
			<a  class="btn btn-fb-social facebook"><i class="entypo-facebook social-icon"></i>
			<span>Login with Facebook</span></a>
			</div>
  <?php } ?>
		</li>
	</ul>	
	<div style='clear:both '></div>
	<div class='ordiv'>
	<p>OR</p>
	</div>
</div>

<div id="messageRegistration"></div>
<div class="txt-fld" style="margin-top: 5px;">
	<input id="first_namePopup" type="text" name="first_namePopup" maxlength="256" value="<?php echo set_value('first_name', (isset($first_name)) ? $first_name : ''); ?>" placeholder="First Name" />
</div>

<div class="txt-fld">
	<input id="last_namePopup" type="text" name="last_namePopup" maxlength="256" value="<?php echo set_value('last_name', (isset($last_name)) ? $last_name : ''); ?>" placeholder="Last Name" />
</div>

<div class="txt-fld">
	<input id="emailPopup" type="text" name="emailPopup" maxlength="256" value="<?php echo set_value('email', (isset($email)) ? $email : ''); ?>" placeholder="Email" />
</div>

<div class="txt-fld">
	<input id="passwordPopup" type="password" name="passwordPopup" maxlength="256" autocomplete="off" placeholder="Password" />
</div>

<div class="txt-fld">
	<input id="password_confirmPopup" type="password" name="password_confirmPopup" autocomplete="off" maxlength="256" placeholder="Confirm Password" />
</div>

<div class="fm-btn">
	<?php //echo form_submit( 'submitPopup', 'Submit', "class='btn-primary_stb'"); ?>
	<input type='submit' id='submitPopup' name='submitPopup' value='Submit' class='btn-primary_stb'>
</div>

<div class="txt-fld" style='text-align: center; border-top: 1px solid #d3d3d3; box-shadow: 0 1px #fff inset; clear: both;'>
<p>Already have an account? <a onclick="closeRegi();" id="go" class="signup" rel="leanModal" name="signup" href="#signup">Login</a></p></div>
</div>
</div>
</div>
</form>
<!--End Registration Form-->

<!--Forgot Passowrd -->
<form role="form" class ="tform"  action="#" name="forgetForm" id="forgetForm" method="post">
<div id="forget">
<span id="msgForget"></span>
<div id="forget-ct">
    <div id="forget-header">
		<h2>Forgot Passowrd</h2>
		<a class="modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
	</div>
	
	<div class="right_panel_log_popup"> 
		<div class="txt-fld">
    <div id="messageForget"></div>
    </div>

		<div class="txt-fld">
			<input id="emailForget" type="text" size="15" name="emailForget" autocomplete="off" value="" placeholder="E-mail" style="padding: 0px;" />
		</div>
		
		<div class="btn-fld" style="margin: 0 auto;width: 300px;">
		<button type="button" onclick="forgetPassword();" id ="resetPassword" class="btn-primary_stb" style="width:50%">Reset Password</button>
		<p style="padding: 10px;">Or
		<a onclick="closeForget();" id="go" class="signup" rel="leanModal" name="signup" href="#signup">Login</a></p>
		</div>	
	</div>	
	<div style="clear:both;"></div>
</div>
</div>
</form>
<!-- Forgot Password End-->


<!--First time for admin -->

<form role="form" class ="tform"  action="#" name="FirstTimeForm" id="FirstTimeForm" method="post">
<div id="showFirstTime">
<span id="msgForget"></span>
<div id="showFirstTime-ct">
    <div id="showFirstTime-header">
		<h2>Welcome to your new Academy!</h2>
		<a class="modal_close" href="#"><i class="entypo-cancel-squared"></i></a>
	</div>
	
	<div class="right_panel_log_popup"> 
		<div class="txt-fld">
    <div id="messageForget"></div>
    </div>

		<div class="txt-fld">
			<p>Hurray! welcome to your new online academy! We've included some sample content for you to play as a student would. You can also access the admin panel from the menu (Manage academy).</p>
			<p><b>Note:</b> Your account details has been sent to your registerd email.</p>
		</div>

		<ul class="social-networks" style="margin-left: 201px;">
		<li>
			<div class="social_btn_space">
			<a href="<?php echo base_url(); ?>users/mainLoginAdmin/?eml=<?php echo ((@$_GET['eml']) ? @$_GET['eml'] :'');?>" target="_blank" class="btn btn-primary">
			<span>Admin Console</span></a>
			</div>
		</li>
		
		<li>
			<div class="social_btn_space" style="padding-left: 10px;">
			<a href="<?php echo base_url(); ?>users/mainLogin/?eml=<?php echo ((@$_GET['eml']) ? @$_GET['eml'] :'');?>" target="_blank" class="btn btn-success">
			<span>Student Site</span></a>
			</div>
		</li>
	</ul>
	</div>	
	<div style="clear:both;"></div>
</div>
</div>
</form>

<!-- First time for Admin-->
<div id="lean_overlay" style="display: none; opacity: 0.5;"></div>

<div id="notification">
	<ul class="dropdown-menu">  
		<li class="top"> 
			<p class="small" style="margin: 0; padding-bottom: 5px;"> 
            <a href="#" onclick="markread()" class="pull-right">Mark all Read</a>You have <strong id="newnotify" style="font-weight: normal;">
			<?php echo $viewed; ?></strong> new notifications.</p>
        </li> 
		<li> 
			<ul class="dropdown-menu-list scroller" tabindex="5001" style="overflow: hidden; outline: none;"> 
				<?php

					foreach($notification as $notify)
					{					
						if($notify->activity_date != date('Y-m-d'))
						{
						$datetime1 = date_create($notify->activity_date);
						$datetime2 = date_create(date('Y-m-d'));
						$interval = date_diff($datetime1, $datetime2);
						$notify_date = $interval->format('%a days ago');
						}
						else
                        {
							$notify_date = 'Today';
                        }				   
					?>
					<li class="unread notification-success"> <a href="<?php echo base_url().'notification/activity/'.$notify->activity_id; ?>">  <?php  if($notify->viewed == 0) { echo "   <span class='line'><strong id='strong1'>".$notify->activity."</strong></span>"; } else { echo $notify->activity; } ?> <span class="line small" style="font-size: 85%;"> <?php echo ' '.$notify_date;  ?>  </span>  </a> </li> 
					<?php

					}

                ?>				
			</ul>
		</li> 
		<li class="external"> 
			<a href="<?php echo base_url().'notification/lists/'; ?>" style="margin: 0; padding: 0;">View all notifications</a></li>
		</li>
	</ul>
</div>


<script>
// For Registration
$(function() {
    var action = '';
    var form_data = '';
    $('#submitPopup').click(function () {	
        action = $("#registerPopup").attr("action");		   
        form_data = {
			firstname: $("#first_namePopup").val(),
			lastname: $("#last_namePopup").val(),
			email: $("#emailPopup").val(),
			password: $("#passwordPopup").val(),
			password_confirm: $("#password_confirmPopup").val(),
        };  
        $.ajax({
            type: 'POST',
            url: action,
            data: form_data, 
            success: function(response) 
			{
				//alert(response);
                if(response == 'success') 
				{
					$("#signup-ct").slideUp('slow', function() {
                  $("#registration").html('<p style="color:green; text-align:center;"><h2>Please Check your Email.</h2></p>');
					});
					
					setTimeout(
					function() 
					{
						 var base_url = window.location.origin;
						window.location.replace(base_url);
					}, 5000);

					/*setTimeout(
					function() 
					{
						//do something special					
             var base_url = window.location.origin;
						window.location.replace(base_url);
					}, 500);	*/														
                }
				else if(response == 'Password and confirm password is not equal...')
				{ 
					$("#passwordPopup").val('');
					$("#password_confirmPopup").val('');
                    $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Password and confirm password is not equal...</b></p></div>');
                }
				else if(response == 'Please fill proper data...')
				{
					$("#passwordPopup").val('');
					$("#password_confirmPopup").val('');
                    $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Please fill proper data...</b></p></div>');
				}
				else if(response == 'Email Already Exist.')
				{
					$("#passwordPopup").val('');
					$("#password_confirmPopup").val('');
                    $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Email Already Exist.</b></p></div>');
				}
				else if(response == 'Password atleast 6 digits')
				{
					$("#passwordPopup").val('');
					$("#password_confirmPopup").val('');
                    $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Password atleast 6 digits</b></p></div>');
				}
            }
         }); 
        return false;      
    });  
});
</script>

<script>
function loginUser()
{
var email = $("#email1").val();
var password =$("#password1").val();
$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>users/loginPopup",
			data: {email:email,password:password}, 
			success: function(response)
			{
        //alert(response);
			    if(response == 'success') 
				{
					$("#signup-ct").slideUp('slow', function() {
                  $("#msgspan").html('<p style="color:green; text-align:center;"><h2>Log In Successful.</h2></p>');
					});
					
					setTimeout(
					function() 
					{
						//do something special
						// window.location.replace(window.location.origin+"/index.php/category");
						//window.location.replace(window.location.origin+"/courses");
						window.location.replace(window.location.origin);
					}, 2500);
                } 
                else if(response == 'success123') 
				{
					$("#signup-ct").slideUp('slow', function() {
                  $("#msgspan").html('<p style="color:green; text-align:center;"><h2>Log In Successful.</h2></p>');
					});
					
					setTimeout(
					function() 
					{
						//do something special
						// window.location.replace(window.location.origin+"/index.php/category");
						//window.location.replace(window.location.origin+"/courses");
						window.location.replace(window.location.href);
					}, 2500);
                } 
				else
				{ 
					$("#messageStudent").html('<p style="color:red; text-align:center;"><b>Invalid username and/or password.</b></p>');
                }
				
			}
		  });
 }

function forgetPassword()
{  
var emailForget = $("#emailForget").val();

$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>users/forgetPasswordPopup",			
			data: {emailForget:emailForget},			 
			success: function(response)
			{				
        
			  if(response == 'success') 
				{
					$("#forget-ct").slideUp('slow', function() 
                    {
              $("#msgForget").html('<p style="color:green; text-align:center;"><h2>Reset password link has been sent to your email.</h2></p>');
					});
					
					setTimeout(
					function() 
					{
						//do something special
						window.location.replace(window.location.origin);
					}, 3000);					
        }
        else
        { 
					
          $("#emailForget").val('');
					$("#messageForget").html('<p style="color:red; text-align:center;"><b>Email Id is not available in the records.</b></p>');
        }				
			}
		  });
 }

function viewsite()
{
    jQuery.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>users/view_frontsite",
              //data: {menuname:menuname,path:path}, 
              success: function(data)
              {
              // var win = window.open('<?php echo base_url(); ?>admin', '_blank');
              // if(win)
              // {    
              //   win.focus();
              // }
              window.location = '<?php echo base_url(); ?>admin';

              }
    });
}
</script>
<script>
	function markread()
	{
		 $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>notification/getUnreadNotific",              
              success: function(data)
              {
              	
              $("#notification ul>li strong").css('color','#939496');
		  	  $("#notification ul>li strong").css('font','inherit');
		  	  $(".badge-info").html('0');		  	  
		  	  $("#newnotify").html('0');
              }
    });
		  
		 
	}
</script>

 <script type="text/javascript">
  window.fbAsyncInit = function() {
	  //Initiallize the facebook using the facebook javascript sdk
     FB.init({ 
       appId: "<?php echo $socialloginarray->facebook->appid; ?>",   //'<?php echo $this->config->item('appID'); ?>', // App ID 
	   cookie:true, // enable cookies to allow the server to access the session
       status:true, // check login status
	   xfbml:true, // parse XFBML
	   oauth : true //enable Oauth 
     });
   };
   //Read the baseurl from the config.php file
   (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
	//Onclick for fb login
 $('.facebook').click(function(e) {
    FB.login(function(response) {
	  if(response.authResponse) {
		  parent.location ='<?php echo base_url(); ?>fbci/fblogin'; //redirect uri after closing the facebook popup
	  }
 },{scope: 'email,publish_actions,user_birthday,user_location,user_work_history,user_hometown,user_photos'}); //permissions for facebook
});

 $('.google').click(function(e)
{
 $.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>google_authentication/login",
			//data: {follow_id:follow_id,student_id:student_id}, 
			success: function(data)
			{
				if(data =="already")
				{
					alert('already');
				}
				else
				{
				  parent.location = data;
				}
				
			},
			complete(xhr,status){
			
			},
			error(xhr,status,error)
			{

			}
		  });
}); 
   </script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
