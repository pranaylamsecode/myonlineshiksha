  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<?php
 /* echo '<pre>';
	print_r($db_media);
  echo '</pre>'; 

  echo '<pre>';
	print_r($db_text);
  echo '</pre>'; */

 // echo '<pre>';
 // print_r($sectionname);
 // echo $sectionname->description;
?>
<style>
#codediv iframe
{
 width: 540 !important;
 height: 270 !important;
}

label
{
margin-bottom:0 !important;
padding: 10px !important;
width:20%;
}
.span2 .tech_img
{
border-radius:10px;
margin-left:0%;
}
@media (max-width: 1280px) 
{
.span2 .tech_img
{
border-radius:10px;
margin-left:0% !important;
}		
}
@media (max-width: 980px) 
{
label
{
margin-bottom:0 !important;
padding: 10px !important;
width:auto !important;
}
.span2 .tech_img
{
border-radius:10px;
margin-left:0% !important;
}	
}
.pop-header-txt h1{
  background: #f1f1f1;
  font-size: 20px;
  padding: 15px 35px 15px 15px;
  border-bottom: 1px solid #BEBEBE;
  box-shadow: 0 1px #EDEDE7;
  margin: 0;
  line-height: 1.2;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

/*#media_1
{  
  max-width: 100%;
  width: 50%;
  float: left;
  padding: 20px 0 0 0;
}

#txt_1
{
  max-width: 100%;
  width: 44%;
  float: right;
  padding: 10px 20px;
} */
#txt_1 div p
{
margin: 0;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 14px;
  line-height: 1.8;
  color: #333333;
}
.fancybox-skin {
  position: relative;
  background: #f9f9f9;
  color: #444;
  text-shadow: none;
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0;
  padding: 0;
  max-width: 800px !important;
  width: 100% !important;
  height: 380px !important;
    overflow-x: hidden;
  overflow-y: scroll;
}

.fancybox-wrap.fancybox-desktop.fancybox-type-iframe.fancybox-opened {
  width: 100% !important;
  height: auto;
  max-width: 800px !important;
  position: absolute;
  top: 20px;
  left: 290px;
  opacity: 1;
  overflow: visible;
}


body
{
  margin: 0 !important;
}



#txt_1 {
  padding: 15px 10px;
}

.main-content {
  margin-top: 55px;
}

#media_1 {
  width: 475px;
  max-height: 345px;
  text-align: center;
  display: inline;
  margin: 0 auto;
  background-color: #000;
}

#movieframe1 img
{
  max-width: 100% !important;
  width: 100%;
  height: 345px;
}

.pop-header-txt {
  position: fixed;
  width: 100%;
  z-index: 1;
}

#txt_1 .pop_read_mnr {
  position: fixed;
  top: 35px;
  z-index: 2;
  right: 10px;
  font-size: 12px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}


</style>


<div class="page-container">

<div class="pop-header-txt">
	
	<h1><?php echo $sectionname->title; ?></h1>


</div>

<div style="background-color: #F5F5F5; display:-webkit-box;">
<!--<div class="sidebar-menu sb-left">-->
<!-- Your left Slidebar content. -->
<!-- Classes Examples -->
	<!--<ul id="main-menu" class="">
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myaccount">My account</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycourses">My courses</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myorder">My Orders</a></li> 
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myquizandfexam">My Quizzes/Final Exams</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycertificates">My Certificates</a></li>
	</ul>
</div>-->

<div class="main-content">
	<div class="row">
    <div class="holder" id="mrp-container2">
<div id="system-message-container"> 
</div>



<?php
//    echo"<pre>";
//    print_r($db_media);
//   echo $db_media->media_id;
// exit('yes'); 

  if($db_media)
  {  
     if($db_media->id != 0)
    {
?>
<div id="media_1" >

		
      <?php
      //$this->load->helper('media' );
       //ajaxmediaview($db_media->id,1);
       ?>

<script> $('#media_1').load("<?php echo base_url();?>medias/ajaxmediaview_Preview/"+<?php echo $db_media->id; ?>+"/1");</script>

</div>
<?php
    }
  }
	if($db_text)
	{
    if($db_text[0]->media_id != 0)
    {
?>
<div id="txt_1">
<?php

if($db_media)
  {
    if($db_media[0]->media_id != 0)
    {
    ?>
<a href="#txt_1" class="pop_read_mnr">Read More</a>  
  
     <?php
   }
   }
   		$media = $this->medias_model->getItems($db_text[0]->media_id);

   ?>	
		 <?php
      $this->load->helper('media' );
       ajaxmediaview($db_text[0]->media_id,1);
       ?>
		

</div>
<?php
    }
	}
  if($sectionname->description)
  {
?>
  <div id="txt_1">

    
     <?php
        echo $sectionname->description;
     ?>
    

</div>
<?php
    }

?>
    </div>
</div>

</div>
</div>
</div>





 
 

