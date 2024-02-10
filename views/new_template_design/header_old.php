<!DOCTYPE html>
<html amp lang="en-US" prefix="og: http://ogp.me/ns#" >
    <head>
<?php 
      $data = array(
              '@context' => 'http://schema.org/',
              '@type' => 'Organization',
              "url"=> "https://myonlineshiksha.com",
              'email' => 'info@myonlineshiksha.com',
              'catid' => ''
      );  
        $CI =& get_instance();
        $CI->load->helper('commonmethods');
        $CI->load->model('admin/settings_model'); 
        $getTheme = $CI->settings_model->getItems();

        $meta_title2 = (isset($getTheme[0]['meta_title']) && trim($getTheme[0]['meta_title'])!= '') ? trim($getTheme[0]['meta_title']) : "MLMS3";
          $meta_keyword2 = (isset($getTheme[0]['meta_keyword']) && trim($getTheme[0]['meta_keyword'])!= '') ? trim($getTheme[0]['meta_keyword']) : "MLMS4";
        $meta_description2 = (isset($getTheme[0]['meta_desc']) && trim($getTheme[0]['meta_desc'])!= '') ? trim($getTheme[0]['meta_desc']) : "MLMS Institute";
        $ogImg= base_url().'public/uploads/settings/img/logo/'.$getTheme[0]['bannerimage'];
       if($this->uri->segment(1) == "online-courses" && $this->uri->segment(2) != ""){ 
        // echo $this->uri->segment(1);
            $pro_id = $this->uri->segment(2);
            if(!is_numeric($pro_id))
            {
              $pro_id = $this->category_model->getCourseIdbySlug($pro_id);
            }
            $program = $this->program_model->getProgram_oginfo($pro_id);  
            // $review = $this->program_model->getAllReview($pro_id);  
            $review = $this->customs_model->getAvgReview($pro_id);  
            $teacher_info = $this->program_model->getTeacherInfo($program->author);

          $rem_html = strip_tags($program->metadesc);
          $rem_spaces = preg_replace("/\s+/", " ", $rem_html);
          $rem_white = preg_replace('/\s+/', ' ', $rem_spaces);
          $rem_special_chars = preg_replace("/&#?[a-z0-9]+;/i"," ",$rem_white);
                   
          $desc = str_replace('         ',' ',$rem_special_chars);
          $description = $desc;
          $program->description = strip_tags($program->description);
          // $review['@type'] = 'aggregateRating';
          // $program['aggregateRating'] = $review;
          $info = array(
            'ratingValue'=> $review->avg_review,
            'reviewCount'=> $review->no_reviews,
            '@type' => 'aggregateRating'
          );

          $creator = array(
            'author' => $teacher_info->first_name.' '.$teacher_info->last_name,
            'designation' => $teacher_info->designation,
            'profile' => strip_tags($teacher_info->prof_info),
            'image' => "https://myonlineshiksha.com/public/uploads/users/img/".$teacher_info->image
          );
          $data = array_merge((array)$program, array('creator' => $creator, 'aggregateRating'=> $info), $data);
        ?>
      <title><?php echo $program->metatitle; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="twitter:card" content="summary">
      <meta name="medium" content="mult">
      <meta http-equiv="Content-Language" content="en-us">
      <link rel="manifest" href="<?php echo base_url();?>public/manifest.webmanifest">
      <link rel="icon" href="<?php echo base_url() ?>public/images/myonlineshiksha-favicon.png" type="image/gif">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@myonlineshiksha.com" />

        <meta property="og:locale" content="en_US"/>
        <meta property="og:site_name" content="MyOnlineShiksha™"/>

        <meta property="og:title" content="<?php echo $program->metatitle ?>"/>
        <meta property="og:description" content="<?php echo $description ?>"/>
        <meta property="og:image" content="<?php echo $program->image ?>"/>
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="680" />
        <meta property="og:price" content="<?php echo $program->sell_price ?>"/>
        <meta property="og:QRCODE" content="<?php echo $program->qr_image ?>"/>

        <meta property="og:url" content="<?php echo base_url().'online-courses/'.$program->slug.'/' ?>"/>
        <meta name="title" content="<?php echo $program->metatitle ?>" />
        <meta name="description" content="<?php echo $description ?>">
      <?php }
      else if($this->uri->segment(1) == "teacher-profile" && $this->uri->segment(2) != ""){
          $id = $this->uri->segment(2);
          if(is_numeric($id))
          {
            $tslug = $this->Crud_model->get_single('mlms_users',"id = '".$id."'",'first_name,last_name,images');
          }else{
            $tslug = $this->Crud_model->get_single('mlms_users',"slug = '".strtolower($id)."'",'first_name,last_name,images');
          }
          $meta_title21 = trim($tslug->first_name)." ".trim($tslug->last_name);
      ?>
      <title><?php echo $meta_title2; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="twitter:card" content="summary">
      <meta name="medium" content="mult">
      <meta http-equiv="Content-Language" content="en-us">
      <link rel="manifest" href="<?php echo base_url();?>public/manifest.webmanifest">
      <link rel="icon" href="<?php echo base_url() ?>public/images/myonlineshiksha-favicon.png" type="image/gif">
          <meta property="og:title" content="<?php echo $meta_title21 ?>"/>
          <meta property="og:description" content="<?php echo $meta_description2 ?>"/>
          <?php if(!empty($tslug->images)){ ?>
            <meta property="og:image" content="<?php echo base_url('public/uploads/users/img/'.$tslug->images); ?>"/>
          <?php } ?>

          <meta name="title" content="<?php echo $meta_title2; ?>" />
          <meta name="description" content="<?php echo $meta_description2; ?>">
      <? }
      else { ?>
      <title><?php echo $meta_title2; ?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="twitter:card" content="summary">
      <meta name="medium" content="mult">
      <meta http-equiv="Content-Language" content="en-us">
      <link rel="manifest" href="<?php echo base_url();?>public/manifest.webmanifest">
      <link rel="icon" href="<?php echo base_url() ?>public/images/myonlineshiksha-favicon.png" type="image/gif">
        <meta property="og:title" content="<?php echo $meta_title2 ?>"/>
        <meta property="og:description" content="<?php echo $meta_description2 ?>"/>
        <meta property="og:image" content="https://myonlineshiksha.com/public/uploads/settings/img/logo/myonineshiksha-banner_opt.jpg"/>

        <meta name="title" content="<?php echo $meta_title2; ?>" />
      <meta name="description" content="<?php echo $meta_description2; ?>">
      <?php } 
        if($this->uri->segment(2) == "courses" && $this->uri->segment(3) != ""){
        $metacat = $this->Crud_model->get_single('mlms_category',"slug = '".$this->uri->segment(3)."'");
        if(!empty($metacat) && !empty($metacat->metatitle)){ ?>
<meta name="title" content="<?php echo $metacat->metatitle; ?>"/>
    <?php }if(!empty($metacat) && !empty($metacat->metadesc)){ ?>
<meta name="description" content="<?php echo $metacat->metadesc; ?>"/>
    <?php }if(!empty($metacat) && !empty($metacat->metakwd)){ ?>
<meta name="keywords" content="<?php echo $metacat->metakwd; ?>"/>
    <?php } } ?>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-147667948-1"></script>
<script>

 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'UA-147667948-1');
</script>
      <meta name="keywords" content="<?php echo $meta_keyword2; ?>">
<?php   
echo '<script type="application/ld+json">';
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
echo '</script>';
 ?>
 
  <script>

      // $(document).bind("contextmenu",function(e) {
//  e.preventDefault();
// });
//       $(document).on("keypress", 'body', function(e) {
//     var keyC = e.keyCode;
//     console.log("keyC"+keyC);
//     if (keyC == 123) {
//          return false;
//     }
//     if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
//      return false;
//   }
// });
  </script>

      <link rel="stylesheet" href="<?php echo base_url(); ?>public/new_template/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>public/new_template/css/new_template.css" type="text/css" media="screen" />
      <link rel="stylesheet" media="screen and (max-device-width: 1200px)" href="<?php echo base_url(); ?>public/new_template/css/responsive.css" type="text/css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/new_template/tooltipster-master/dist/css/tooltipster.bundle.min.css" />

      <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
      <!-- <script src="<?php echo base_url(); ?>public/new_template/chat_script.js"></script> -->
  

      <script type='text/javascript'>
       window.smartlook||(function(d) {
         var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
         var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
         c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
         })(document);
         smartlook('init', 'c22c5593b7b7fd758f17dcb75f6fa4c4bb3cc4a6');
      </script>
      <script type="text/javascript">
       (function(i,s,o,g,r,a,m,n){i.moengage_object=r;t={};q=function(f){return function(){(i.moengage_q=i.moengage_q||[]).push({f:f,a:arguments})}};f=['track_event','add_user_attribute','add_first_name','add_last_name','add_email','add_mobile','add_user_name','add_gender','add_birthday','destroy_session','add_unique_user_id','moe_events','call_web_push','track','location_type_attribute'],h={onsite:["getData","registerCallback"]};for(k in f){t[f[k]]=q(f[k])}for(k in h)for(l in h[k]){null==t[k]&&(t[k]={}),t[k][h[k][l]]=q(k+"."+h[k][l])}a=s.createElement(o);m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m);i.moe=i.moe||function(){n=arguments[0];return t};a.onload=function(){if(n){i[r]=moe(n)}}})(window,document,'script','https://cdn.moengage.com/webpush/moe_webSdk.min.latest.js','Moengage')

       Moengage = moe({
         app_id:"XTZULY57K9GEO45SKGRSGTX8",
         debug_logs: 0
       });
      </script>

      <!-- Global site tag (gtag.js) - Google Ads: 688914569 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-688914569"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-688914569');
  </script>
  <?php  if($this->uri->segment(1) == "thank_you"){ ?>
<!-- Event snippet for Course Purchase conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-979169772/iNiOCPrm4cwBEOzj89ID',
      'transaction_id': ''
  });
</script>
<? } ?>

  <!-- Global site tag (gtag.js) - Google Ads: 979169772 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-979169772"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-979169772');
</script>
    </head>
    
    <!-- course page header -->
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
    

    $CI->load->model('login_model');
    // $get_student_instr = $CI->login_model->get_student_instr();
    $CI->load->model('customs_model'); 
    $CI->load->model('category_model'); 
    $cart_num = 0;
    $auth = $this->session->userdata('logged_in');
    if($auth){
      $userDetail = $CI->settings_model->getAllUsersDetail($auth['id']);
      $where = array('user_id'=> $auth['id'], 'type'=>"2");
      $cart_num = $CI->category_model->countCard($where);
      $filepath = "";
      $files = $_SERVER['DOCUMENT_ROOT']."/public/uploads/users/img/".@$userDetail[0]['images'];
      if (file_exists($files)) {
        $filepath = "public/uploads/users/img/";
      }
      else{
        $filepath = "public/uploads/users/img/thumbs/";
      }
    }


      // $catlist = $CI->customs_model->getAllcategory();
      $catlist = $CI->customs_model->getAllcategory11(0);
      $courselist = $CI->customs_model->getAllcourse();
    ?>
    <body>
      <style type="text/css">
        .btn-tel{
          background-color: #DC3F3F;
          font-size: 18px;
          margin-left: 10px;
          padding: 6px 12px !important;
          line-height: 1.43 !important;
          color: white;
        }
        .btn-tel:hover{
          color:white;
        }
        .subcatmenu{
          float: right;
        }
        .subcatmenu i.fa{
          padding-right: 0 !important;
        }
      </style>
      <div class="discount_bar highlight_discount" >
       <div class="container">
          <a class="dicount_text" href="<?php echo base_url(); ?>category/courses">Crack JEE/NEET 2020 with Online Course - 50% Discount </a>
          <a href="tel:+917303520052" class="dicount_text"><button class="btn btn-tel"> Call us on 7303520052</button></a>
       </div>
    </div>
    <nav class="navbar navbar-default topnavbar">
      <div class="container-fluid first_nav">
        <div class="left_header">
          <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/images/MyOnlineShiksha-logo.svg" alt="MyOnlineShiksha"></a>
          </div>
          <ul class="nav navbar-nav">
            <li class="dropdown menu_hover"><a class="course_tab" href="<?php echo base_url().'category/courses';?>" class="dropdown-toggle"><span class="glyphicon glyphicon-th"></span>&nbsp;Courses</a>
            <!-- <li class="dropdown menu_hover"><a class="course_tab" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th"></span>&nbsp;Courses</a> -->
              <ul class="dropdown-menu" id="style-1">
                <?php 
                  foreach ($catlist as $Clist) { 
                  $subcat = $CI->customs_model->getAllcategory11($Clist->id);
                  $catcourse = $CI->customs_model->getcategories($Clist->id);
                  if($subcat || @$catcourse) { ?>
                  <li class="submenu"><a class="submenu_icon" href="<?php echo base_url();?>category/courses/<?php echo $Clist->slug;?>"><?php echo $Clist->name;?></a><span class="submenu_icon1"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <ul class='first_sub_menus'>
                      <?php
                  if($subcat){
                  foreach ($subcat as $subcat) { 
                    $subcat1 = $CI->customs_model->getAllcategory11($subcat->id);
                    $subcourse = $CI->customs_model->getcategories($subcat->id);
                    if($subcat1 || $subcourse)
                    {
                    ?>
                  
                  <li class="submenu1"><a class="submenu_icon" href="<?php echo base_url();?>category/courses/<?php echo $subcat->slug; ?>"><?php echo $subcat->name; ?><span class="subcatmenu"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                  <ul class='second_sub_menus'>
                  <?php
                  if($subcat1)
                  {
                    foreach ($subcat1 as $subcat1) { 
                      $subcourse1 = $CI->Crud_model->GetData("mlms_program","id,name,slug","catid = ".$subcat1->id." and published = 1 and trash = 0");
                      if($subcourse1)
                      { 
                      ?>
                    <li class="submenu2"><a class="submenu_icon" href="<?php echo base_url().'category/courses/'.$subcat1->slug; ?>"><?php echo $subcat1->name; ?> <span class="subcatmenu"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                  <ul class='third_sub_menus'>
                  <?php foreach ($subcourse1 as $subcourse1) { ?>
                    <li class="submenu3"><a href="<?php echo base_url().'online-courses/'.$subcourse1->slug; ?>"><?php echo $subcourse1->name; ?></a></li>
                    <?php } ?>
                  </ul>
                    </li>
                  <? } } 
                  }
                  else if($subcourse){ 
                  foreach ($subcourse as $subcourse) { ?>
                    <li class="submenu2"><a href="<?php echo base_url().'online-courses/'.$subcourse->slug; ?>"><?php echo $subcourse->name; ?></a></li>
                    <?php } }?>
                </ul></li>
                <?php }
                  } 
                  }
                  else if(@$catcourse) {
                  foreach ($catcourse as $subcat) { ?>
                  <li class="submenu"><a href="<?php echo base_url().'online-courses/'.$subcat->slug;?>"><?php echo $subcat->name;?></a><span class="submenu_icon1"><i class="fa fa-angle-right" aria-hidden="true"></i></span></li>
                  <?php } 
                  }?>
              </ul></li>
                <?php }
                } ?>
              </ul>
            </li>
          </ul>
          <div class="col-sm-4 header_search">
            <p id="headtop2">
                <form name="search_box" autocomplete="off" action="<?php echo base_url('category/courses'); ?>" method="post">
                    <input id="getlistitem1" name="searchtext" autocomplete="false" class="movies" placeholder="Search a course for you" style="color:black;" value="<?php if(!empty($searchCourse)){echo $searchCourse;} ?>">
                    <button class="btn btn-lg btn-icon" type="submit"><i class="lnr lnr-magnifier"></i></button>
                </form>
            </p>
            <ul id="getitemlist1" style="display: none"></ul>
          </div>
        </div>
        <div class=" text-right">
          <?php
            if($auth){ ?>
            <ul class="nav navbar-nav navbar222">
            <?php
            if(@$userDetail[0]['is_instructor'] == '1' || @$userDetail[0]['group_id'] == '2' || @$userDetail[0]['group_id'] == 5 || @$userDetail[0]['group_id'] == 4 || @$userDetail[0]['group_id'] == 3)
            {
            if($userDetail[0]['group_id'] == 4)
            {
            ?>
              <li onclick="viewsite();" class="menu_hover"><a class="manage_academy" href="/admin" title='Manage Academy'><i class="entypo-vcard ent-vc"></i><span class="ent-vc1" >Manage</span></a>
              </li>
            <?php
            }
            if($userDetail[0]['group_id'] == 2 || @$userDetail[0]['is_instructor'] == '1')
            {
            ?>
              <li class="dropdown your_teaching_zone"><a href="#" title='Your Teaching Zone'><i class="entypo-sound ent-vc" ></i><span class="ent-vc1">Manage</span><i class="entypo-down-open-mini" style="position: relative; top: 3px;"></i></a>

                <ul style="<?php if(@$userDetail[0]['group_id'] != 5){echo "width:210px; left: -100px;";}else{echo "width: 196px";} ?>">
                  <li><a href="<?php echo base_url(); ?>partner/your-sales"><span>Sales</span></a></li>
                  <li><a href="<?php echo base_url(); ?>partner/settlements"><span>Your Settlements</span></a></li>
                  <li><a href="<?php echo base_url(); ?>partner/coupons"><span>Coupons</span></a></li>
                </ul>
              </li>
            <?php
            }
            if(@$userDetail[0]['group_id'] == 5)
            {
            ?>
            <li class="dropdown your_teaching_zone"><a href="#" title='Your Selling Zone'><i class="entypo-sound ent-vc" ></i><span class="ent-vc1">Manage</span><i class="entypo-down-open-mini" style="position: relative; top: 3px;"></i></a>
              <ul style="<?php if(@$userDetail[0]['group_id'] == 5){echo "width:210px; left: -100px;";}else{echo "width: 196px";} ?>">
                <li><a href="<?php echo base_url(); ?>partner/your-sales"><span>Sales</span></a></li>
                <li><a href="<?php echo base_url(); ?>partner/settlements"><span>Your Settlements</span></a></li>
                <li><a href="<?php echo base_url(); ?>partner/coupons"><span>Coupons</span></a></li>
                <li><a href="<?php echo base_url(); ?>partner/settings"><span>Settings</span></a></li>
              </ul>
            </li>
            <?php
            }
            }
            if(@$userDetail[0]['is_student'] == '1' || $userDetail[0]['group_id'] == 1)
            {        
            ?>
              <li class="dropdown menu_hover"><a href="#" title='Your Learning Zone'><i class="entypo-brush ent-vc"></i><span class="ent-vc1" >Learn</span><i class="entypo-down-open-mini"  style="position: relative;top: 2px;left: -2px;"></i></a>
                  <ul>
                      <li><a href="<?php echo base_url(); ?>my-courses"><span>My Courses</span></a></li>
                      <li><a href="<?php echo base_url(); ?>my-exams"><span>Exams</span></a></li>
                      <li><a href="<?php echo base_url(); ?>my-certificates"><span>Certificates</span></a></li>
                      <li><a href="<?php echo base_url(); ?>my-orders"><span>My Orders</span></a></li>
                  </ul>
              </li>
              <?php        
                }
                if(@$userDetail[0]['is_student'] == '1' || @$userDetail[0]['is_instructor'] == '1')
                {
                ?>
                <li class="dropdown mos_not">
                    <a href="<?php echo base_url('my-carts') ?>#cart" ><i class="lnr lnr-cart"></i> <span id="cart_info" class="badge badge-info"><?php echo $cart_num; ?></span></a>
                </li>
                <?php
                  }
                        
                  ?>
                    <li class="dropdown userToggle">
                      <a href="#">
                        <span class="tempo">
                        <img border="0" alt="" src="<?php echo base_url().$filepath;?><?php echo ($userDetail[0]['images']) ? $userDetail[0]['images'] : 'default.jpg'  ?>" class="img-circle" ></span>
                      </a>
                      <div class='displaymenuToggle'>
                        <ul style="text-align:right;">
                          <li>
                            <div class="dropdown-menu profile_dropdown_menu" style="display:block;">
                              <div class="profile_admt">
                                <div class="profile_admt_img"><img width='90' height='90' border="0" class="img-circle" alt="" src="<?php echo base_url().$filepath; ?><?php echo (@$userDetail[0]['images']) ? @$userDetail[0]['images'] : 'default.jpg' ?>">
                                </div>
                                <div class="profile_admt_name"> <span class="admt_txt"><?php echo ucfirst($auth['first_name']); ?></span>
                                    <ul class="list-cat-up">
                                    </ul>
                                </div>
                              </div>
                              <div class="clr"></div>
                              <ul class="admin_anchor_txt">
                                <li><a href="<?php echo base_url(); ?>my-account"><i class="lnr lnr-user" style="margin-right: 10px;"></i><span>My Profile</span> </a> </li>

                                <li><a href="<?php echo base_url(); ?>my-wishlists"><i class="lnr lnr-heart" style="margin-right: 10px;"></i><span>My Wishlists</span> </a> </li>

                                <li><a href="<?php echo base_url(); ?>users/logout"><i class="lnr lnr-power-switch" style="margin-right:10px;"></i><span>Log Out</span> </a> </li>
                              </ul>
                            </div>
                          </li>
                      </ul>
                  </div>
                 
                  </li>
                  <?php
                  }
                  /*else
                  {
                  $this->session->unset_userdata('logged_in');
                  redirect('welcome/myStaticPage');
                  }*/ 
                  ?>
                </ul>
              </ul>
              <?php
            if(!$auth)
            {?>
          <ul class='nav navbar-nav'>
            <li><a id="go" class="blck_effect hov_grey" href="<?php echo base_url() ?>become-a-teacher">Teach with Us </a></li>
            <li class=""><a id="go" rel="leanModal" name="signup" href="#signup" class="btn btn-default btnlogin">Log In</a>
            </li>
            <li class=""><a id="go" rel="leanModal" name="registration" href="#registration" class="btn btn-default btn-signup">Register</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
     

  <script>
 jQuery(document).ready(function() {

    if (jQuery(window).width() < 991) {
      var discount_bar_fixed_res = jQuery('#section-sidenavbar-responsive').offset().top; 

      jQuery(window).scroll(function() {                  // assign scroll event listener

          var discount_barcurrentScroll = jQuery(window).scrollTop(); // get current position

          if (discount_barcurrentScroll > discount_bar_fixed_res) {
          
              jQuery('#section-sidenavbar-responsive').css({                      // scroll to that element or below it
                  position: 'fixed',
                  top: '0px',
                  'margin-top': '0px'
              });
               jQuery('#section-sidenavbar-responsive .toggle_searchbar').css({                      // scroll to that element or below it
                  display: 'block'
              });
            
          } else {                                   // apply position: static
              jQuery('#section-sidenavbar-responsive').css({                      // if you scroll above it
                  position: 'unset',
                  top: '0',
                  'margin-top': '0px'
              });
              jQuery('#section-sidenavbar-responsive .toggle_searchbar').css({                      // scroll to that element or below it
                  display: 'none'
              });
          };
        });
    }

    if (jQuery(window).width() > 991) {
      var discount_bar_height = jQuery('.discount_bar').outerHeight();
      
      jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 100){
          jQuery('.discount_bar').addClass("fix_discount");
          jQuery('.topnavbar').addClass("fix_header");
          jQuery('.fix_header').css("top",discount_bar_height+"px");
        }
        else{
        jQuery('.discount_bar').removeClass("fix_discount");
        jQuery('.topnavbar').removeClass("fix_header");
        jQuery('.topnavbar').css("top","0px");
        }
      });
    }
  });

</script>

<style type="text/css">
   #message {
    position: fixed; 
  right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}
</style>
<div id="message"></div>
    <!-- course page responsive header -->
    <!-- responsive sidebarmenu -->
    <div id="section-sidenavbar-responsive">
        <div id="mySidenav" class="sidenav">
          <!--   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
          <?php if($auth){
          if($userDetail)
              {       
          ?>
          <li class="profile">
            <a href="#" onclick="openNav3()">
                <!--<i class="entypo-down-dir" style="float:right;"></i>-->
                <div class="profile_admt">
                    <div style="float:left; display:inline-block" class="profile_admt_img"><img width='90' height='90' border="0" class="img-circle" alt="" src="<?php echo base_url().$filepath; ?><?php echo (@$userDetail[0]['images']) ? @$userDetail[0]['images'] : 'default.jpg'  ?>">
                    </div>
                    <div style="float:right;display:inline-block" class="profile_admt_name"> <span class="admt_txt"><?php echo $auth['first_name']; ?></span>
                        <p style="font-size: 13px;margin-top: 7px;color: #333;">Welcome back<i class="fa fa-angle-right"></i></p>
                    </div>
                    
                </div>
            </a>
          </li>
          <?php }
          if(@$userDetail[0]['is_instructor'] == '1' || @$userDetail[0]['group_id'] == '2' || @$userDetail[0]['group_id'] == 5 || @$userDetail[0]['group_id'] == 4 || @$userDetail[0]['group_id'] == 3) //added by jayesh
          {
          if($userDetail[0]['group_id'] == 4)
          {
          ?>
                          <li class="manage_menu" style="display: inline-block;
          width: 100%;">
                              <a class="manage_academy" href="/admin" title='Manage Academy'>Manage</a>
                          </li>

                          <?php
          }
          if($userDetail[0]['group_id'] == 2 || @$userDetail[0]['is_instructor'] == '1')
          {
          ?>
          <li class="your_teaching_zone"><a href="#" onclick="openNav4()" title='Your Teaching Zone'>Manage<span style="float: right;margin-right: 0px;margin-top: -5px;width: 5px;"><i class="fa fa-angle-right"></i></span></a>
                <ul style="display: none;">
                    <!-- <li><a href="<?php echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
                    <li><a href="<?php echo base_url(); ?>manage-exams"><span>Manage Question Papers</span></a></li>
                    <li><a href="<?php echo base_url(); ?>questions/manage"><span>Manage Questions</span></a></li>
                    <li><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
                    <li><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
                    <li><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
                    <li><a href="<?php echo base_url(); ?>orders/percentageOrders"><span>Courses Sale</span></a></li> -->
                    
                    <li><a href="<?php echo base_url(); ?>partner/your-sales"><span>Sales</span></a></li>
                    <li><a href="<?php echo base_url(); ?>partner/settlements"><span>Your Settlements</span></a></li>
                    <li><a href="<?php echo base_url(); ?>partner/coupons"><span>Coupons</span></a></li>
                    <li><a href="<?php echo base_url(); ?>partner/settings"><span>Settings</span></a></li>
                </ul>
            </li>
            <?php
            }
            if(@$userDetail[0]['group_id'] == 5)
            {
            ?>
            <li class="your_teaching_zone"><a href="#" onclick="openNav4()" title='Your Teaching Zone'>Manage<span style="float: right;margin-right: 0px;margin-top: -5px;width: 5px;"><i class="fa fa-angle-right"></i></span></a>
                <ul style="display: none;">
                  <li><a href="<?php echo base_url(); ?>partner/your-sales"><span>Sales</span></a></li>
                  <li><a href="<?php echo base_url(); ?>partner/settlements"><span>Your Settlements</span></a></li>
                  <li><a href="<?php echo base_url(); ?>partner/coupons"><span>Coupons</span></a></li>
                  <li><a href="<?php echo base_url(); ?>partner/settings"><span>Settings</span></a></li>
                </ul>
            </li>
            <?php
            }
            }
            if(@$userDetail[0]['is_student'] == '1' || $userDetail[0]['group_id'] == 1)
            {        
            ?>
            <li class="dropdown parent_list"><a href="#" title='Your Learning Zone' onclick="openNav5()">Learn</a>
              <ul>
                <?php 
                if(@$userDetail[0]['is_student'] == '1' || $userDetail[0]['group_id'] == 1)
                {        
                ?>

                  <li><a href="<?php echo base_url(); ?>my-courses"><span>My Courses</span></a></li>
                  <li><a href="<?php echo base_url(); ?>my-exams"><span>Exams</span></a></li>
                  <li><a href="<?php echo base_url(); ?>my-certificates"><span>Certificates</span></a></li>
                  <li><a href="<?php echo base_url(); ?>my-orders"><span>My Orders</span></a></li>
                  <!-- <li><a href="<?php echo base_url(); ?>my-redeem-code"><span>Redeem Code</span></a></li> -->

                  <?php        
                }
                ?>
              </ul>
            </li>
            <?php        
            }
            }else{ ?>
          <!-- <a href="#">Help</a> -->
          <li class="login_signup">
              <a id="go" rel="leanModal" name="registration" href="#registration" class="btn btn-default btn-signup add_overlay">Register</a>
              <a id="go" rel="leanModal" name="signup" href="#signup" class="btn btn-default btnlogin add_overlay">Log In</a>
              <span class="lnr lnr-cross close_sidemenu"></span>
          </li>
          <?php } ?>
              <li class="category"><a href="#" onclick="openNav2()">Categories <span  style="float: right;"><i class="fa fa-angle-right"></i> </span></a> </li>
              <li><a href="<?php echo base_url() ?>category/courses">All Courses</a> </li>
              <li><a href="<?php echo base_url() ?>blog">Blog</a> </li>
              <li><a href="<?php echo base_url() ?>about">About Us</a> </li>
              <!-- <li><a href="<?php echo base_url() ?>become-a-teacher">Teach with Us</a> </li> -->
              <li><a href="<?php echo base_url() ?>become-a-reseller">Become a Reseller</a> </li>
                      <?php if($auth){ ?>
                          <li><a href="<?php echo base_url(); ?>users/logout"><span>Log Out</span> </a> </li>
                          <?php } ?>
        </div>
        <div class="side-navabar">
          <div class="res-bars col-sm-4">
              <span class="res_bars_toggle" style="cursor:pointer;" onclick="openNav()"><span class="lnr lnr-menu"></span></span>
              <span style="cursor:pointer;" id="search_icon1" class="lnr lnr-magnifier search-icon dropbtn"></span>
          </div>
          <span class="res-logo col-sm-4">
          <a class="" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/images/MyOnlineShiksha-logo.svg"></a>
          </span>
          <span class="reslog col-sm-4">
          <?php if($auth){ ?>
          		<div class="responsive_cart"> <a href="<?php echo base_url('my-carts') ?>#cart" ><i class="lnr lnr-cart"></i> <span id="cart_info" class="badge badge-info"><?php echo $cart_num; ?></span></a></div>
              <div style="float:left; display:inline-block" class="profile_admt_img"><a href="<?php echo base_url(); ?>my-account"><img width='90' height='90' border="0" class="img-circle" alt="" src="<?php echo base_url().$filepath; ?><?php echo (@$userDetail[0]['images']) ? @$userDetail[0]['images'] : 'default.jpg'  ?>"> </a></div>

                          <?php }else { ?>
             <a id="go" rel="leanModal" name="signup" href="#registration" class="btn btn-default btnsignup add_overlay">Log In</a>
             <?php } ?>
             
          </span>
          <div class="col-sm-4 toggle_searchbar test">
          <form name="search_box" action="<?php echo base_url();?>category/courses" method="post">
            <p id='headtop2'>

                <input type="text" id="searchtext" class="form-control search_box" onkeyup="filterFunction()" onclick="mySearch()" name="searchtext" autocomplete="off" placeholder="Search a course for you" style="margin:0;color:#000" />
                <button type="submit" class="btn btn-lg btn-icon"><i class="lnr lnr-magnifier"></i></button>

                <!-- value="<?php echo (isset($_GET['searchtext'])) ? $_GET['searchtext'] : ''; ?>" -->
                <div id="myDropdown" class="dropdown-content">
                  <?php $catlist = $CI->customs_model->getAllcategory();
                   foreach ($catlist as $Clist) { ?>
                  <a class="fa fa-file-o" href="<?php echo base_url() ?>category/courses/<?php echo $Clist->slug; ?>"><?php echo $Clist->name; ?></a>
                  <?php    }
                  $courselist = $CI->customs_model->getAllcourse();
                  foreach ($courselist as $Plist) { ?>
                  <a class="fa fa-book" href="<?php echo base_url()."online-courses/".$Plist->slug; ?>"><?php echo $Plist->name; ?></a>
                  <?php    } ?>
              </div>
            </p>
          </form>
        </div>
        </div>
        
<!--       <div id="lean_overlay" class="res_overlay" style="display: none; opacity: 0.4;"></div>
 -->   
  </div>
    <!-- category submenu  -->
    <style>
      .subitem:hover .subcat {
          display: block!important;
      }
      
      .subcat:hover .subcourse {
          display: block!important;
      }
    </style>

    <div id="section-sidenavbar-responsive">
      <div id="mySidenav2" class="sidenav">
          <li style="background: #f5f5f5;"><a href="#" onclick="openNav()"><span style="float: left;"><i class="fa fa-angle-left"></i> </span>&nbsp;&nbsp; &nbsp;Back </a><span class="lnr lnr-cross close_sidemenu"></span></li>
          <?php  foreach ($catlist as $Clist) {  ?>
          <div class="subitem">
            <li class="cat"><a href="<?php echo base_url() ?>category/courses/<?php echo $Clist->slug; ?>"><?php echo $Clist->name; ?></a><span onclick="openNav6()" class="menus_arrow"><i class="fa fa-angle-right"></i> </span>
            <?php     $subcat = $CI->category_model->subcategory($Clist->id);
              $catcourse = $CI->customs_model->getcategories($Clist->id);

              if($subcat || @$catcourse) { ?>
                <ul class="subcat" style="margin-left: 0px;display: none">
                                      <?php

              if($subcat){  
              foreach ($subcat as $subcat) { ?>
              <!-- <li><a href="<?php //echo base_url() ?><?php //echo $Clist->slug; ?>/category/<?php //echo $subcat->slug; ?>"></i> -->
              <li><a href="<?php echo base_url().'online-courses/'.$subcat->slug; ?>"></i> &nbsp;<?php echo $subcat->name; ?></a></li>
              <?php
              $subcourse = $CI->customs_model->getcategories($subcat->id);

              if($subcourse){ ?>
              <div class="subcourse" style="margin-left: 0px;display: none">
                                            <?php
              foreach ($subcourse as $subcourse) { /*?>
                <li><a href="<?php echo base_url() ?><?php echo $Clist->slug; ?>/category/<?php echo $subcourse->slug; ?>"><?php echo $subcourse->name; ?></a></li><?php */ ?>
                <li><a href="<?php echo base_url().'online-courses/'.$subcourse->slug; ?>"><?php echo $subcourse->name; ?></a></li>
                <?php
              }
              ?>
            </div>
            <?php
            }
            ?>
            <?php
            } 

            }
            if(@$catcourse) {
            foreach ($catcourse as $subcat) { /* ?>
              <li><a href="<?php echo base_url() ?><?php echo $Clist->slug; ?>/category/<?php echo $subcat->slug; ?>"><?php echo $subcat->name; ?></a><?php */ ?>
              <li><a href="<?php echo base_url().'online-courses/'.$subcat->slug; ?>"><?php echo $subcat->name; ?></a>
                  <?php
            } 
            }
            ?>
            </ul>

            </li>
              
            <?php
            } echo "</div>"; 
            } ?>
          </div>
      </div>
    </div>
    <div id="section-sidenavbar-responsive" style="height: 0px;">
        <div id="mySidenav6" class="sidenav">
          <ul>
              <li style="background: #f5f5f5;"><a href="#" onclick="openNav2()"><span style="float: left;"><i class="fa fa-angle-left"></i> </span>&nbsp;&nbsp; &nbsp;Back </a><span class="lnr lnr-cross close_sidemenu"></span></li>
          </ul>
        </div>
    </div>
    <div id="section-sidenavbar-responsive" style="height: 0px;">
      <div id="mySidenav3" class="sidenav">
        <li style="background: #f5f5f5;"><a href="#" onclick="closeNav3()"><span style="float: left;margin-right: 5px;"><i class="fa fa-angle-left"></i> </span> Profile</a><span class="lnr lnr-cross close_sidemenu"></span></li>
        <?php if($auth){
        if($userDetail)
          {       
        ?>
            <li class="dropdown userToggle" style="display: none">
                <a href="#">
                    <!--<i class="entypo-down-dir" style="float:right;"></i>-->
                    <div class="profile_admt">
                        <div style="float:left; display:inline-block" class="profile_admt_img"><img width='90' height='90' border="0" class="img-circle" alt="" src="<?php echo base_url().$filepath; ?><?php echo (@$userDetail[0]['images']) ? @$userDetail[0]['images'] : 'default.jpg'  ?>">
                        </div>
                        <div style="float:right;display:inline-block" class="profile_admt_name"> <span class="admt_txt"><?php echo $auth['first_name']; ?></span>
                        </div>
                    </div>
                </a>
            </li>

            <li><a href="<?php echo base_url(); ?>my-account">My Profile</a> </li>

            <li><a href="<?php echo base_url(); ?>my-wishlists">My Wishlists</a> </li>

            <li><a href="<?php echo base_url(); ?>users/logout">Log Out</a> </li>
            <?php }
        }?>
        </div>
    </div>


    <div id="section-sidenavbar-responsive" style="height: 0px;">
      <div id="mySidenav4" class="sidenav">
        <li style="background: #f5f5f5;"><a href="#" onclick="closeNav4()"><span style="float: left;"><i class="fa fa-angle-left"></i> </span>&nbsp;&nbsp; &nbsp;Back </a><span class="lnr lnr-cross close_sidemenu"></span></li>
        <?php 
        if(@$userDetail[0]['is_instructor'] == '1' || @$userDetail[0]['group_id'] == '2' || @$userDetail[0]['group_id'] == 5 || @$userDetail[0]['group_id'] == 4 || @$userDetail[0]['group_id'] == 3) //added by jayesh
        {

        if($userDetail[0]['group_id'] == 2 || @$userDetail[0]['is_instructor'] == '1')
        {
        ?>
        <ul>
          <!-- <li><a href="<?php  echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
          <li><a href="<?php echo base_url(); ?>manage-exams"><span>Manage Question Papers</span></a></li>
          <li><a href="<?php echo base_url(); ?>questions/manage"><span>Manage Questions</span></a></li>
          <li><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
          <li><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
          <li><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
          <li><a href="<?php echo base_url(); ?>orders/percentageOrders"><span>Courses Sale</span></a></li> -->
          
          <li><a href="<?php echo base_url(); ?>partner/your-sales"><span>Sales</span></a></li>
          <li><a href="<?php echo base_url(); ?>partner/settlements"><span>Your Settlements</span></a></li>
          <li><a href="<?php echo base_url(); ?>partner/coupons"><span>Coupons</span></a></li>
          <li><a href="<?php echo base_url(); ?>partner/settings"><span>Settings</span></a></li>
        </ul>
        <?php
        }
          if(@$userDetail[0]['group_id'] == 5)
          {
          ?>
          <ul>
            <li><a href="<?php echo base_url(); ?>partner/your-sales"><span>Sales</span></a></li>
            <li><a href="<?php echo base_url(); ?>partner/settlements"><span>Your Settlements</span></a></li>
            <li><a href="<?php echo base_url(); ?>partner/coupons"><span>Coupons</span></a></li>
            <li><a href="<?php echo base_url(); ?>partner/settings"><span>Settings</span></a></li>
          </ul>
          <?php
          }
        } ?>
      </div>
    </div>
      <!-- category submenu  -->
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.left = "0px";
            document.getElementById("mySidenav2").style.left = "-280px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.left = "-280px";
        }
        function openNav2() {
            document.getElementById("mySidenav2").style.left = "0px";
            document.getElementById("mySidenav6").style.left = "-280px";
        }

        function closeNav2() {
            document.getElementById("mySidenav2").style.left = "-280px";
        }
        function openNav6() {
            document.getElementById("mySidenav6").style.left = "0px";
        }

        function closeNav6() {
            document.getElementById("mySidenav6").style.left = "-280px";
        }
        function openNav3() {
            document.getElementById("mySidenav3").style.left = "0px";
        }

        function closeNav3() {
            document.getElementById("mySidenav3").style.left = "-280px";
        }
        function openNav4() {
            document.getElementById("mySidenav4").style.left = "0px";
        }

        function closeNav4() {
            document.getElementById("mySidenav4").style.left = "-280px";
        }
        function openNav5() {
            document.getElementById("mySidenav5").style.left = "0px";
        }

        function closeNav5() {
            document.getElementById("mySidenav5").style.left = "-280px";
        }
    </script>
    <!-- end top header -->
    <?php
      $this->load->config('oauth2', TRUE);

       $CI->load->model('admin/settings_model');
       $socialstatus = $this->settings_model->getSocialStatus(1,'mlms_socialstatus');
       if(@$socialstatus->social_login == 1 || @$socialstatus->social_status == 1)
       {
    if($this->config->item('facebook_id', 'oauth2') || $this->config->item('google_id', 'oauth2'))
    {
    ?>
                                                <?php
      $socialloginarray = json_decode($sociallogin);//variable sociallogin is come from database field json array onb date 08-09-2015
       // print_r($socialloginarray);

      if((empty($socialloginarray->facebook->appid)) && (empty($socialloginarray->facebook->appsecretkey)))//if fb details is blank
      {
        $fbUrl = '#'; 
      }else
      {
        $fbUrl = base_url().'hauth/login/Facebook';
      }
      if((empty($socialloginarray->googleplus->clientid)) && (empty($socialloginarray->googleplus->clientsecreatekey)))//if googleplus details is blank
      {
        $gpUrl = ''; 
      }else
      {
        $gpUrl = base_url().'auth_oa2/session/google/';
      }
    }
  }
  ?>
    <!-- POP UP Login Form -->
    <form role="form" class="tform" action="#" name="studentForm" id="studentForm" method="post">
      <div id="signup">
        <span id="msgspan"></span>
        <div id="signup-ct">
          <div class="top_panel">
             <img src="<?php echo base_url();?>public/images/MyOnlineShiksha-logo.svg" alt="MyOnlineShiksha" style="width: 70%;">
             <a class="modal_close close_popup" href="#"><span class="lnr lnr-cross"></span></a>
             <h4 style="margin-top: 10px;"> Welcome back, please login to your account.</h4>
             <a href="#<?php echo $fbUrl ?>" data-purpose="facebook-link" class="fxac social-buttons--social-btn--1JTo2 facebook-btn facebook" style="max-width: 42%;border-radius: 5px;margin-left: auto;margin-right: auto;"><i aria-hidden="true" class="fa fa-facebook-square" style="margin-right: 15px !important"></i>Facebook</a>
             <h6 class="background">or</h6>
          </div>
          <div class="main_panel_log_popup">
            <div id="messageStudent"></div>                                      
            
            <div class="txt-fld mail">
              <label>Mobile no. / Email <span class="error_message" style="visibility: hidden" id="log_err_mail"></span></label>
                <input id="email1" placeholder="enter Mobile no. / Email" type="text" size="15" onkeypress="Javascript: if (event.keyCode==13) loginUser();" name="email" autocomplete="off" value=""/>
            </div>
            <div class="txt-fld password">
                <label>Password <span class="error_message" style="visibility: hidden" id="log_err_pass"></span></label>
                <input id="password1" placeholder="enter Password" type="password" onkeypress="Javascript: if (event.keyCode==13) loginUser();" name="password" autocomplete="off" value="" size="38"/>
            </div>
            <div class="forgot_pass pull-right">
              <p><a id="go" onclick="closeLogin();" rel="leanModal" name="forget" href="#forget"> Forgot Password?</a></p>
            </div>
            <div class="btn-fld" style="margin-top: 15px;">
                <input type="hidden" name="dup_redeem" id="dup_redeem" value="">
                <button type="button" onclick="loginUser();" id="studentLogin" class="btn-success_stb pull-right">
                  <div id="please_wait" class="form-group" style="display: none; float: center;">
                    <img src="<?php echo base_url();?>public/images/loader_white.gif" height="30px">
                    Wait
                  </div>
                  Log in
                </button>
                <!-- <a type="button" id="go" onclick="closeLogin()" class="btn-success_stb stb-login" rel="leanModal" name="signup" href="#registration" style="color: #716f7a;background-color: #fff;border: 1px solid #1EDA85;"> Register</a> -->
            </div>
          </div>
          <div class="bottom_panel">
             <span class="login_footer">Don't have an account? 
              <a onclick="closeLogin();" id="go" class="sign_up_text" rel="leanModal" name="signup" href="#registration">Register</a>
             </span>
          </div>
        </div>
      </div>
    </form>
    <!---Registration PopUp-->
    <form role="form" class="tform" action="" name="registerPopup" id="registerPopup" method="post" onsubmit="return validation()">
      <div id="registration">
        <div id="signup-ct">
          <div class="top_panel">
             <!-- <img src="<?php echo base_url();?>public/images/MyOnlineShiksha-logo.svg" alt="MyOnlineShiksha" style="width: 70%;"> -->
             <a class="modal_close close_popup" href="#"><span class="lnr lnr-cross"></span></a>
             <h4 style="margin-top: 15px;"> Create your account</h4>
             <h5>Your account is your portal to all things </h5>
             <a href="#<?php echo $fbUrl ?>" data-purpose="facebook-link" class="fxac social-buttons--social-btn--1JTo2 facebook-btn facebook" style="max-width: 40%;border-radius: 5px;margin-left: auto;margin-right: auto;"><i aria-hidden="true" class="fa fa-facebook-square" style="margin-right: 15px !important"></i>Facebook</a>
             <h6 class="background">or</h6>
          </div>
          </div>         
          <div class="main_panel_log_popup">
            <div id="messageRegistration"></div>

            <div class="txt-fld name" style="margin-top: 5px;">
              <label>Name <span class="error_message" style="visibility: hidden; color: red;" id="err_fname">&nbsp;</span>
              </label>
              <input id="first_namePopup" placeholder="enter Name" type="text" name="first_namePopup" maxlength="256" value="<?php echo set_value('first_name',(isset($first_name)) ? $first_name : '');?>" autocomplete="off" />
            </div>
            <div class="txt-fld mail">
              <label>Mobile No. <span class="error_message" style="visibility: hidden" id="err_email"> </span></label>
              <input id="emailPopup" placeholder="enter Mobile no" type="text" name="emailPopup" maxlength="12" value="<?php echo set_value('email', (isset($email)) ? $email : ''); ?>"  autocomplete="off" onkeypress="return only_number(event);" />
              <!-- onkeyup="return checkdup(this.value)" -->
            </div>

            <div class="txt-fld password">
              <label>Password <span class="error_message" style="visibility: hidden" id="err_pass"></span></label>
              <label class="pass_label" style="display: none"></label>
              <input id="passwordPopup" placeholder="enter Password" type="password" name="passwordPopup" maxlength="256" autocomplete="off" />
            </div>
            <div class="fm-btn" style="margin-top: 15px;">
              <input type="hidden" name="dup_redeem1" id="dup_redeem1" value="">
              <!-- <a type="button" id="go" onclick="closeRegi()" class="btn-success_stb stb-login" rel="leanModal" name="signup" href="#signup" style="color: #716f7a;background-color: #fff;border: 1px solid #1EDA85;"> Login</a> -->
              <button type="button" id="btn_register" class="btn-success_stb pull-right" onclick="return validation()">
                <div id="please_waitR" class="form-group" style="display: none; float: center; ">
                  <img src="<?php echo base_url(); ?>public/images/loader_white.gif" height="30px">
                  Wait
                </div>
                Register
              </button>
            </div>
            <p>By signing up, you agree to our <a href="<?php echo base_url(); ?>terms-of-use">Terms of Use</a> and <a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a>.</p>
          </div>
          <div class="bottom_panel">
             <span class="login_footer">Already have an account? 
             <a onclick="closeRegi();" id="go" class="sign_up_text" rel="leanModal" name="signup" href="#signup">Log In </a>
             </span>
          </div>
      </div>
    </form>
    <!--End Registration Form-->
    <!--Forgot Passowrd -->
    <form role="form" class="tform" action="#" name="forgetForm" id="forgetForm" method="post">
        <div id="forget">
            <span id="msgForget"></span>
            <div id="forget-ct">
              <div class="top_panel">
                <img src="<?php echo base_url();?>public/images/MyOnlineShiksha-logo.svg" alt="MyOnlineShiksha" style="width: 70%;">
                 <a class="modal_close close_popup" href="#"><span class="lnr lnr-cross"></span></a>
                 <h4 style="margin-top: 10px;"> Reset Your Password</h4>
                 <p style="font-weight: normal;">Please provide the Email ID you used when you signed up for your Myonlineshiksha account.<br>We will send you a <b>Link</b> to reset your password.</p>
              </div>     
              <div class="main_panel_log_popup">
                  <div class="txt-fld">
                      <div id="messageForget"></div>
                  </div>
                  <div class="txt-fld">
                    <span class="error_message" style="visibility: hidden" id="for_err_email"></span>
                    <input id="emailForget" placeholder="Enter your email" type="text" size="15" name="emailForget" autocomplete="off" value="" style="padding: 0px;" />
                  </div>
                  <div class="btn-fld" style="text-align: center;">
                    <!-- <a type="button" id="go" onclick="closeForget()" class="btn-success_stb stb-login" rel="leanModal" name="signup" href="#signup" style="color: #716f7a;background-color: #fff;border: 1px solid #1EDA85;"> Login</a> -->
                    <button type="button" id="resetPassword" class="btn-success_stb pull-right" onclick="forgetPassword();">
                      <div id="please_waitR" class="form-group" style="display: none; float: center; ">
                        <img src="<?php echo base_url(); ?>public/images/loader_white.gif" height="30px">
                        Wait
                      </div>
                      Reset Password
                    </button>
                      <a onclick="closeForget();" id="go" class="signup" rel="leanModal" name="signup" href="#signup"> Log in</a>
                  </div>
              </div>
            </div>
        </div>
    </form>
    <!-- Forgot Password End-->
    <script>
      
      jQuery(document).ready(function() {
       
        $("a").on("click tap touchstart", function(){
           var signin = jQuery(this).attr("href");
        if (signin == "#signup") {
          $("#studentForm, #signup").css("display","block");
          $("body").addClass("body_overflow_imp");
        }
      });
        $("a").on("click tap touchstart", function(){
        var signup = jQuery(this).attr("href");
        if (signup == "#registration") {
          $("#registerPopup, #registration").css("display","block");
          $("body").addClass("body_overflow_imp");
          $("#studentForm").css("display","none");
        }
      });
        $("a").on("click tap touchstart", function(){
        var forgot = jQuery(this).attr("href");
        if (forgot == "#forget") {
          $("#forgetForm").css("display","block");
          $("body").addClass("body_overflow_imp");
        }
      });
        // $(".btn-signup, .res_logo .btnsignup.add_overlay").on("click tap touchstart", function(){
        //    // $("#registerPopup").css("display","block");
        //    // $("#registerPopup").addClass("body_overflow");
        //  });
         // $(".btnlogin").on("click tap touchstart", function(){
         //   $("#studentForm").css("display","block");
         //   $("body").css("overflow","hidden");
         // });

         
         // $(".forgot_pass a").on("click tap touchstart", function(){
         //   $("#forgetForm").css("display","block");
         //    $("body").css("overflow","hidden");
         // });
         
        if (!passwordPopup==""){
             $(".pass_label").css("display","block");
        }
        $("#passwordPopup").on("click tap touchstart", function(){
          $(".pass_label").css("display","block");
          $("#registration #passwordPopup").addClass("add_pad_top");
        });
       
        $("#passwordPopup").on('input', function(){
            var passwordPopup = $("#passwordPopup").val().trim();
            if (passwordPopup==""){
              $(document).mouseup(function(e) 
              {
                  var container = $("#passwordPopup");
                    if (!container.is(e.target) && container.has(e.target).length === 0) 
                    {
                         $(".pass_label").css("display","none");
                         $("#registration #passwordPopup").removeClass("add_pad_top");
                    }
              });
               $(".pass_label").css("display","none");
               $("#registration #passwordPopup").removeClass("add_pad_top");
            }
            else if(!passwordPopup==""){
              $(document).mouseup(function(e) 
              {
                  var container = $("#passwordPopup");
                    if (!container.is(e.target) && container.has(e.target).length === 0) 
                    {
                         $(".pass_label").css("display","block");
                    }
              });
             $(".pass_label").css("display","block");
            }
        });
      });
      

      function setCookies(cname, cvalue) {
          var d = new Date();
          d.setTime(d.getTime() + 60000);
          var expires = "expires="+ d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";secure=true;path=/";
      }

      function only_number(event) {
         var x = event.which || event.keyCode;
         console.log(x);
         if ((x >= 48) && (x <= 57) || x == 8 | x == 9 || x == 13) {
            return;
         } else {
            event.preventDefault();
         }
      }

      $('input[name="emailPopup"]').keyup(function(e){
        if (/\D/g.test(this.value))
        {
          // Filter non-digits from input value.
          this.value = this.value.replace(/\D/g, '');
        }
      });
      function validation()
      {
        // $("#registerPopup, #lean_overlay").css("display","none");
        var first_namePopup = $("#first_namePopup").val().trim();
        
        var emailPopup = $("#emailPopup").val().trim();
        
        var passwordPopup = $("#passwordPopup").val().trim();
        var dup_redeem1 = $("#dup_redeem1").val().trim();

        if (first_namePopup=="")
        {
          $("#err_fname").css("visibility","visible");
          $("#err_fname").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter name").css('color','red');
          setTimeout(function(){$("#err_fname").html("");},2000);
          setTimeout(function(){$("#err_fname").css("visibility","hidden");},2000);
           
          $("#first_namePopup").focus();
          return false;
        }
        
        if (emailPopup=="")
        {
          $("#err_email").css("visibility","visible");
          $("#err_email").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter Mobile no.").css('color','red');
          setTimeout(function(){$("#err_email").html("");},2000);
           setTimeout(function(){$("#err_email").css("visibility","hidden");},2000);
          $("#emailPopup").focus();
          return false;
        }
        if (passwordPopup=="")
        {
          $("#err_pass").css("visibility","visible");
         
          
          $("#err_pass").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter password").css('color','red');
          setTimeout(function(){$("#err_pass").html("&nbsp;");},2000);
           setTimeout(function(){$("#err_pass").css("visibility","hidden");},2000);
          $("#passwordPopup").focus();
          return false;
        }
        else if(passwordPopup.length<6)
        {
           $("#err_pass").css("visibility","visible");
          $("#err_pass").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Password atleast 6 characters").css('color','red');
          setTimeout(function(){$("#err_pass").html("&nbsp;");},2000);
           setTimeout(function(){$("#err_pass").css("visibility","hidden");},2000);
          $("#passwordPopup").focus();
          return false;
        } 
        
        var err_email =$("#err_email").html();
        var err_confirm =$("#err_confirm").html();
        if (err_email=="already exists")
        {
          $("#emailPopup").focus();
          $("#emailPopup").css('border-color','red');
          return false;
        }
        if (err_confirm=="password not matched")
        {
          $("#password_confirmPopup").focus();
          return false;
        }
          $("#please_waitR").css("display","block");
          $("#btn_register").attr('disabled',true);
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url();?>users/registrationPopup",
                    cache:false,
                    data: {
                      firstname : first_namePopup,
                      
                      email : emailPopup,
                      password : passwordPopup,
                      dup_redeem1 : dup_redeem1
                      // password_confirm : password_confirmPopup
                    },
                    success: function(response) {
                        if (response == 'success')
                        {

                            $('#registration').css({
                                "display": "none"
                            });

                            $('#lean_overlay').css({
                                                    "display": "none"
                                                });
                            var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>Your account has been created successfully.</div>';
                            // var note = $(document).find('#message');
                            $('#message').html(str);
                            $('#message').show();
                            $('#message').fadeIn().delay(3000).fadeOut();
                            window.location.href = "<?php echo base_url();?>category/courses";
                        }
                        else if (response == 'Failed')
                        {
                          $("#err_email").html('Email already exists');
                          $("#err_email").css('visibility','visible');
                          // $('#err_email').fadeIn().delay(2000).fadeOut();
                          $("#please_waitR").css("display","none");
                          $("#btn_register").attr('disabled',false);
                        }else if (response == 'Failed1')
                        {
                          $("#err_email").html('Mobile No. already exists');
                          $("#err_email").css('visibility','visible');
                          $('#err_email').fadeIn().delay(2000).fadeOut();
                          $("#please_waitR").css("display","none");
                          $("#btn_register").attr('disabled',false);
                        }
                        else{
                          $('#registration').css({
                                "display": "none"
                          });

                          $('#lean_overlay').css({
                                              "display": "none"
                          });
                          var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>Your account has been created successfully.</div>';
                            // var note = $(document).find('#message');
                          $('#message').html(str);
                          $('#message').show();
                          $('#message').fadeIn().delay(3000).fadeOut();
                          // window.location.href = response;
                          setCookies('nr',response);
                          window.location.href = '<?php echo base_url();?>thank_you/';
                        }
                      }
                    });
      }

      function checkdup(email)
      {
        $.ajax({
              type:"post",
              cache:false,
              url:"<?php echo base_url();?>users/check_dup",
              data:{
                email:email
              },
              success:function(returndata)
              {
                if(returndata==0)
                {
                  $("#err_email").html("already exists").css('color','red');
                  $("#emailPopup").css("border-color",'red');
                  $("#err_email").css('visibility','visible');
                  return false;
                }
                else
                {
                  $("#err_email").html("available").css('color','green');
                  $("#emailPopup").css("border-color",'');
                }
              }
        });
      }

      /*function chk_same(cpass)
      {
        var passwordPopup = $("#passwordPopup").val().trim();
        if (passwordPopup!=cpass)
        {
          $("#err_confirm").html("password not matched").css('color','red');
          // setTimeout(function(){$("#err_confirm").html("&nbsp;");},2000);
          $("#password_confirmPopup").focus();
          return false;
        }
        else
        {
          $("#err_confirm").html("password matched").css('color','green');
          // setTimeout(function(){$("#err_confirm").html("&nbsp;");},2000);
          $("#password_confirmPopup").focus();
          return true;
        }
      }*/

        function loginUser() {
            var email = $("#email1").val();
            var password = $("#password1").val();
            var dup_redeem = $("#dup_redeem").val();
            if (email=="")
            {
                $("#log_err_mail").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter username or email").css('color','red');
              setTimeout(function(){$("#log_err_mail").html("&nbsp;");},2000);
               $("#log_err_mail").css("visibility","visible");
            
            setTimeout(function(){$("#log_err_mail").css("visibility","hidden");},2000);
              $("#email1").focus();
              return false;
            }
            if (password=="")
            {
               $("#log_err_pass").css("visibility","visible");
               $("#log_err_pass").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter password").css('color','red');
              setTimeout(function(){$("#messageStudent").html("&nbsp;");},2000);
              setTimeout(function(){$("#log_err_pass").css("visibility","hidden");},2000);
              $("#password1").focus();
              return false;
            }

            $("#please_wait").css("display","block");
            $("#studentLogin").attr('disabled',true);
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/loginPopup",
                data: {
                    email: email,
                    password: password,
                    dup_redeem : dup_redeem
                },
                success: function(response) {
                    //alert(response);
                    if (response == 'success') {
                        $('.close_popup').click();
                        $("#studentLogin").attr('disabled',false);
                        window.location.replace(window.location.origin + '/index/index');
                    } else if (response == 'success123') {
                        $('.close_popup').click();
                        window.location.replace(window.location.href);
                    } else if (response) {
                        $('.close_popup').click();
                        // window.location.replace(response);
                        if(response.indexOf("lectures")!= -1){
                          setCookies('nr',response);
                          window.location.href = '<?php echo base_url();?>thank_you/';
                          return false;
                        }
                        $("#newurl").val(response);
                        $("#newr").submit();
                    } else {
                      $("#studentLogin").attr('disabled',false);
                        $("#messageStudent").html('<p class="invalid_error">Please check your email and password.</p>');
                        // setTimeout(function(){$("#messageStudent").html("&nbsp;");},2000);
                        $("#password1").focus();
                        $("#please_wait").css("display","none");
                    }
                }
            });
        }
        function forgetPassword() {
            var emailForget = $("#emailForget").val();
            if (emailForget=="")
              {
                $("#for_err_email").css("visibility","visible");
                $("#for_err_email").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter email").css('color','red');
                setTimeout(function(){$("#for_err_email").html("&nbsp;");},2000);
                 setTimeout(function(){$("#for_err_email").css("visibility","hidden");},2000);
                $("#emailPopup").focus();
                return false;
              }
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/forgetPasswordPopup",
                data: {
                    emailForget: emailForget
                },
                success: function(response) {
                    if (response == 'success') {
                        $("#forget-ct").slideUp('slow', function() {
                            $("#msgForget").html('<p style="color:green; text-align:center;"><h2>Reset password link has been sent to your email.</h2></p>');
                        });
                        setTimeout(
                            function() {
                                //do something special
                                window.location.replace(window.location.origin);
                            }, 3000);
                    } else {
                        $("#emailForget").val('');
                        $("#messageForget").html('<p class="invalid_error">Email Id is not available in the records.</p>');
                    }
                }

            });
        }
        function viewsite() {
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/view_frontsite",
                //data: {menuname:menuname,path:path}, 
                success: function(data) {
                    window.location = '<?php echo base_url(); ?>admin';

                }
            });
        }
    </script>
    <script>
        function markread() {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>notification/getUnreadNotific",
                success: function(data) {

                    $("#notification ul>li strong").css('color', '#939496');
                    $("#notification ul>li strong").css('font', 'inherit');
                    $(".badge-info").html('0');
                    $("#newnotify").html('0');
                }
            });

        }
    </script>
    <script>
        function closeLogin() {
            $('#signup, #studentForm').css({
                "display": "none"
            });
             // $("body").css("overflow","visible");
             $("body").removeClass("body_overflow2");
        }


        function closeRegi() {
          $('#registration, #registerPopup').css({
                "display": "none"
            });
           // $("body").css("overflow","visible");
           $("body").removeClass("body_overflow2");
        }

        function closeForget() {
          $('#forget, #forgetForm').css({
                "display": "none"
            });
           // $("body").css("overflow","visible");
           $("body").removeClass("body_overflow2");
        }
    </script>
    <script type="text/javascript">
        $('ul li.dropdown').hover(function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery("#search_icon1").click(function() {
                jQuery(".toggle_searchbar").toggle();

            });
            jQuery('body').click(function(evt) {
                if (!jQuery(evt.target).is('#search_icon1') && !jQuery(evt.target).is('.toggle_searchbar input')) {
                    jQuery(".toggle_searchbar").hide();
                };
            });

        });
    </script>
    <script>
        // For Registration
        $(function() {
            var action = '';
            var form_data = '';
            $('#submitPopup').click(function() {
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
                    success: function(response) {
                        //alert(response);
                        if (response == 'success') {
                            $("#signup-ct").slideUp('slow', function() {
                                $("#registration").html('<p style="color:green; text-align:center;"><h2>Please Check your Email.</h2></p>');
                            });

                            setTimeout(
                                function() {
                                    var base_url = window.location.origin;
                                    window.location.replace(base_url);
                                }, 5000);
                        } else if (response == 'Password and confirm password is not equal...') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Password and confirm password is not equal...</b></p></div>');
                        } else if (response == 'Please fill proper data...') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Please fill proper data...</b></p></div>');
                        } else if (response == 'Email Already Exist.') {
                            $("#passwordPopup").val('');
                            $("#password_confirmPopup").val('');
                            $("#messageRegistration").html('<div class=txt-fld><p style="color:red; text-align:center; margin-bottom:10px;"><b>Email Already Exist.</b></p></div>');
                        } else if (response == 'Password atleast 6 digits') {
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

    <!-- 
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> 

Taken from the sample code above, here's some of the code that's run during page load to check a person's login status:
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});Copy Code
The response object that's provided to your callback contains a number of fields:
{
    status: 'connected',
    authResponse: {
        accessToken: '...',
        expiresIn:'...',
        signedRequest:'...',
        userID:'...'
    }
}

<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>Copy Code
This is the callback. It calls FB.getLoginStatus() to get the most recent login state. (statusChangeCallback() is a function that's part of the example that processes the response.)
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
    -->
    <!-- **

    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '970405716795828',
      xfbml      : true,
      version    : 'v7.0'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
** 
old scret key d27327d4b761aa6550d4122300520d1d-->
    <script type="text/javascript">
       
        window.fbAsyncInit = function() {
            //Initiallize the facebook using the facebook javascript sdk
            FB.init({
                appId: "<?php echo $socialloginarray->facebook->appid; ?>", //'<?php echo $this->config->item('appID'); ?>', // App ID 
                cookie: true, // enable cookies to allow the server to access the session
                status: true, // check login status
                xfbml: true, // parse XFBML
                oauth: true //enable Oauth 
            });
            FB.CustomerChat.hideDialog();
        };
        //Read the baseurl from the config.php file
        (function(d) {
            var js, id = 'facebook-jssdk',
                ref = d.getElementsByTagName('script')[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement('script');
            js.id = id;
            js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            ref.parentNode.insertBefore(js, ref);
        }(document));

        //Onclick for fb login
        $('.facebook').click(function(e) {
           FB.init({
                appId: "<?php echo $socialloginarray->facebook->appid; ?>", //'<?php echo $this->config->item('appID'); ?>', // App ID 
                cookie: true, // enable cookies to allow the server to access the session
                status: true, // check login status
                xfbml: true, // parse XFBML
                oauth: true, //enable Oauth 
                version: 'v2.12'

            });
            FB.login(function(response) {
              console.log(response);
                if (response.authResponse) {
                    parent.location = '<?php echo base_url(); ?>fbci/fblogin'; //redirect uri after closing the facebook popup
                }
            }, {
                scope: 'public_profile,email'
                 }); //permissions for facebook
        });

        // public_profile,email,publish_actions,user_birthday,user_location,user_work_history,user_hometown,user_photos,offline_access

        $('.google').click(function(e) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>google_authentication/login",
                //data: {follow_id:follow_id,student_id:student_id}, 
                success: function(data) {
                    if (data == "already") {
                        alert('already');
                    } else {
                        parent.location = data;
                    }

                },
                complete(xhr, status) {

                },
                error(xhr, status, error) {

                }
            });
        });
    </script>
    <script>
        $(document).on('keyup', '#getlistitem1', function() {
            var input = $('#getlistitem1').val();

            $.ajax({

                url: "<?php echo base_url();?>category/getlist",
                type: "POST",
                data: {
                    input: input
                },
                success: function(data) {
                    if (data) {
                        $('#getitemlist1').show();
                        $('#getitemlist1').html(data);
                    } else {
                        $('#getitemlist1').hide();
                        $('#getitemlist1').html();
                    }
                },
                error: function(xhr, desc, err) {
                    console.log(xhr);
                },
            });
        });
    </script>
    <script>
       $("#mySidenav2").on('click',"li.cat", function(){ 
             var courses = $(this).children("ul");
          $("#mySidenav6 ul").append(courses);
        });
        $(".sidenav").on('click',".close_sidemenu", function(){ 
             $(".sidenav").css("left","-280px");
              $('.res_overlay').css("display", "none");
        });
        $(".res-bars .res_bars_toggle, .profile_admt i.fa-angle-right, #mySidenav3 li:first-child a").on('click', function(){ 
            $('.res_overlay').css("display", "block");
            $('body').addClass("body_overflow");
  
        });
        $(document).mouseup(function(e) 
          {
              var container = $(".sidenav");
              var container2 = $(".lnr-menu");
              var container3 = $(".btnsignup");
              // if the target of the click isn't the container nor a descendant of the container
              if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0 && !container3.is(e.target) && container3.has(e.target).length === 0) 
              {
                  container.css("left","-280px");
                   $('.res_overlay').css("display", "none");
                   $('body').removeClass("body_overflow");
                   

              }
          });
      if($(window).width() > 992 ){
        $(document).mouseup(function(e) 
          {
              var container = $("#signup, #forget, #registration");
              var container2 = $(".btnlogin, .btn-signup");
              // if the target of the click isn't the container nor a descendant of the container
              if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0) 
              {
                  // container.hide();
                  $('body').removeClass("body_overflow_imp");
                  $("#registerPopup, #forgetForm, #studentForm").css("display", "none");
                   $('#lean_overlay').css("display", "none");
                   

              }
          });
      }
        $(document).mouseup(function(e) 
          {
              var container = $(".header_search");
              if (!container.is(e.target) && container.has(e.target).length === 0) 
              {
                  $("ul#getitemlist1").hide();
              }
          });
        $(document).mouseup(function(e) 
          {
              var container = $(".bannar_search");
              if (!container.is(e.target) && container.has(e.target).length === 0) 
              {
                  $("ul#getitemlist").hide();
              }
          });
       
    </script>
        <!-- <div id='fb-root'></div> -->
  <script>(function(d, s, id) {
    /*var js, fjs = d.getElementsByTagName(s)[0];
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
    // FB.CustomerChat.show(shouldShowDialog: false);
    // FB.CustomerChat.hide();
    
    fjs.parentNode.insertBefore(js, fjs);
     
  }(document, 'script', 'facebook-jssdk'));*/
    // $(document).ready(function(){ FB.CustomerChat.hideDialog();});

</script>

 <!--  <div class='fb-customerchat'
    attribution="wordpress"
    page_id='1720416957975054'
  >
</div> -->