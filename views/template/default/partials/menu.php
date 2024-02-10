<?php
    $this->load->helper('resource' );
    $allpages = getAllPages();
    $allpages2 = getspecialPages();
    $activepage = $this->uri->segment(1);
    $activeSPpage = $this->uri->segment(2);   
?>
<!-- For Toggle Jquery -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.menu-trigger').click(function(){
      $('.mobile-menu').toggle();
    });
  });
</script>   
     
<div> 
<a href="#" class="menu-trigger">MENU<i class="entypo-menu" style="float:right; margin-right: 5px; font-size: 20px;"></i> </a> 
</div> 
<ul class="mobile-menu" style="display:none; text-align:left;"> 
<li><a href="<?php echo base_url(); ?>"><span>Home</span></a></li>
<li class="<?php echo (trim($activeSPpage) == 'aboutuspage') ? "active":""?>"><a href="<?php echo base_url(); ?>specialpages/aboutuspage"><span>About Us</span></a></li>

<!--<li class="dropdown1 <?php echo (trim($activepage) == 'resourcepages') ? "active":""?>"><a href="#<?php //echo base_url().'specialpages/contactuspage'; ?>">
<span>Resources</span></a>
<ul style="text-align:left;">
<?php
   if(count($allpages)>0)
   {
     foreach($allpages as $eachpage)
     {
        ?>
        <li><a href="<?php echo base_url(); ?>resourcepages/createPage/<?php echo $eachpage->page_id;?>"><span><?php echo $eachpage->heading;?></span></a></li>
        <?php
     }
   }
?>
</ul>
</li>-->


<li class="<?php echo (trim($activepage) == 'category' || trim($activepage) == 'programs') ? "active":""?>"><a href="<?php echo base_url(); ?>category"><span>Courses</span></a></li>
<?php
$auth=$this->session->userdata('logged_in');
if($auth)
{
?>
<?php /* ?> <li class="<?php echo (trim($activepage) == 'teacher') ? "active":""?>"><a href="<?php echo base_url(); ?>teacher/"><span>Teacher List</span></a></li> <?php */ ?>
    <!--<li class="dropdown <?php echo (trim($activepage) == 'myinfo') ? "active":""?>"><a href="<?php echo base_url(); ?>myinfo/mycourses"><span>My Account</span></a>
    <ul>

		<?php
		//echo 'yogesh';
		$group_id = $this->session->userdata['logged_in']['groupid'];
		if($group_id == 2)//for instructor only i.e. teachers
		{
		?>
		
		<?php
		}
		?>
    </ul>
    </li>-->
<?php
}
?>

<li class="<?php echo (trim($activeSPpage) == 'contactuspage') ? "active":""?>"><a href="<?php echo base_url(); ?>specialpages/contactuspage"><span>Contact Us</span></a></li>
<li><a href="<?php echo base_url(); ?>blogs/index"><span>Blogs</span></a></li>
<li class="dropdown1 <?php echo (trim($activepage) == 'resourcepages') ? "active":""?>"><a href="#<?php //echo base_url().'specialpages/contactuspage'; ?>"><span>More</span></a>

 <ul style="text-align:left;">
 <?php
   if(count($allpages)>0)
   {

     foreach($allpages as $eachpage)

     {
         //$manuname = str_replace('-',' ',$eachpage->heading);
         $manuname = strtolower($eachpage->heading);      
      $manuname = trim(str_replace(' ', '-', $manuname));
      $manuname = preg_replace('/[^A-Za-z0-9\-]/', '', $manuname);
 ?>

    <li><a href="<?php echo base_url(); ?>more-information/<?php echo $manuname ?>/<?php echo $eachpage->page_id;?>"><span><?php  echo $eachpage->heading;?></span></a></li>

 <?php

     }

   }

 ?>

 </ul>

</li>
</ul>

<div style="clear:both;"></div>
<!------------------------------------------------- -->

<ul class="mainmenuul">



<li><a href="<?php echo base_url(); ?>"><span>Home</span></a></li>
<?php
if(count($allpages2)>0)
   {

     foreach($allpages2 as $eachpage2)
     {
      if($eachpage2->type =='about' && $eachpage2->status =='active')
      {
      ?>
<li class="<?php echo (trim($activeSPpage) == 'aboutuspage') ? "active":""?>"><a href="<?php echo base_url(); ?>specialpages/aboutuspage"><span>About Us</span></a></li>
    <?php 
      }
     }
  }
 ?>


<li class="<?php echo (trim($activepage) == 'category' || trim($activepage) == 'programs') ? "active":""?>"><a href="<?php echo base_url(); ?>courses"><span>Courses</span></a></li>

<!--<li><a href="categories.html"><span>Courses &amp; Programs</span></a></li>   -->

<!--<li><a href="<?php //echo base_url(); ?>users/registration"><span>Registrations</span></a></li>  -->

<?php

$auth=$this->session->userdata('logged_in');

if($auth)

{

?>

<?php /* ?> <li class="<?php echo (trim($activepage) == 'teacher') ? "active":""?>"><a href="<?php echo base_url(); ?>teacher/"><span>Teacher List</span></a></li> <?php */ ?>







    <!--<li class="dropdown <?php echo (trim($activepage) == 'myinfo') ? "active":""?>"><a href="<?php echo base_url(); ?>myinfo/mycourses"><span>My Account</span></a>
    <ul>

		<?php
		//echo 'yogesh';
		$group_id = $this->session->userdata['logged_in']['groupid'];
		if($group_id == 2)//for instructor only i.e. teachers
		{
		?>
		
		<?php
		}
		?>
    </ul>
    </li>-->
<?php
}
?>
<?php
if(count($allpages2)>0)
   {

     foreach($allpages2 as $eachpage2)
     {
      if($eachpage2->type =='contact' && $eachpage2->status =='active')
      {
      ?>
<li class="<?php echo (trim($activeSPpage) == 'contactuspage') ? "active":""?>"><a href="<?php echo base_url(); ?>contact-us"><span>Contact Us</span></a></li>
  <?php 
      }
     }
  }
 ?>
<li><a href="<?php echo base_url(); ?>blogs/index"><span>Blogs</span></a></li>
<li class="dropdown <?php echo (trim($activepage) == 'resourcepages') ? "active":""?>"><a href="#<?php //echo base_url().'specialpages/contactuspage'; ?>"><span>More</span></a>

 <ul>
 <?php
   if(count($allpages)>0)
   {

     foreach($allpages as $eachpage)

     {
         //$manuname = str_replace('-',' ',$eachpage->heading);
         $manuname = strtolower($eachpage->heading);      
      $manuname = trim(str_replace(' ', '-', $manuname));
      $manuname = preg_replace('/[^A-Za-z0-9\-]/', '', $manuname);
      if($eachpage->status =='active')
      {
 ?>

    <li><a href="<?php echo base_url(); ?>more-information/<?php echo $manuname ?>/<?php echo $eachpage->page_id;?>"><span><?php  echo $eachpage->heading;?></span></a></li>

 <?php
      }
     }

   }

 ?>

 </ul>

</li>



</ul>

<?php /* ?>







<li><a href="<?php echo base_url(); ?>myinfo/myaccount"><span>My Account</span></a></li>



<li><a href="<?php echo base_url(); ?>myinfo/mycourses"><span>My Courses</span></a></li>



<li><a href="<?php echo base_url(); ?>myinfo/myquizandfexam"><span>My quizzes</span></a></li>



<li><a href="<?php echo base_url(); ?>myinfo/mycertificates"><span>My Certificates</span></a></li>
<?php */ ?>

<script>
$('li').click(function(){
  $(this).addClass('active');
});


$(document).ready(function(){
	$("#dropdowna").toggle(function(){
		//$(".mainmenuul").animate({},500);
		$(".mainmenuul").addClass('expand');
	},function(){
		//$(".mainmenuul").animate({},500);
		$(".mainmenuul").removeClass('expand');
	});
});
</script>