<?php
    $this->load->helper('resource' );
    $allpages=getAllPages();
    $activepage=$this->uri->segment(1);
    $activeSPpage=$this->uri->segment(2);
?>
<!--<a href="javascript:void(0)" id="dropdowna">Main Menu</a>-->

<ul class="mainmenuul" style="text-align:left;">
<li><a href="<?php echo base_url(); ?>"><span>Home</span></a></li>
<li class="<?php echo (trim($activeSPpage) == 'aboutuspage') ? "active":""?>"><a href="<?php echo base_url(); ?>specialpages/aboutuspage"><span>About Us</span></a></li>
<li class="dropdown <?php echo (trim($activepage) == 'resourcepages') ? "active":""?>"><a href="#<?php //echo base_url().'specialpages/contactuspage'; ?>"><span>Resources</span></a>
<ul>
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
</li>

<li class="<?php echo (trim($activepage) == 'category' || trim($activepage) == 'programs') ? "active":""?>"><a href="<?php echo base_url(); ?>category"><span>Courses</span></a></li>
<?php
$auth=$this->session->userdata('logged_in');
if($auth)
{
?>
    <li class="dropdown <?php echo (trim($activepage) == 'myinfo') ? "active":""?>"><a href="<?php echo base_url(); ?>myinfo/mycourses"><span>My Account</span></a>
    <ul>
        <li><a href="<?php echo base_url(); ?>myinfo/mycourses"><span>My Courses</span></a></li>
        <li><a href="<?php echo base_url(); ?>myinfo/myquizandfexam"><span>My quizzes</span></a></li>
        <li><a href="<?php echo base_url(); ?>myinfo/mycertificates"><span>My Certificates</span></a></li>
    </ul>
    </li>
<?php
}
?>
<li class="<?php echo (trim($activeSPpage) == 'contactuspage') ? "active":""?>"><a href="<?php echo base_url(); ?>specialpages/contactuspage"><span>Contact Us</span></a></li>
<li><a href="<?php echo base_url(); ?>blogs/"><span>Blogs</span></a></li>
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
</script>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script type="text/javascript">
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