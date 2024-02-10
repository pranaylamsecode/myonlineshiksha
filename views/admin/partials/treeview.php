<!--treemenu scripts and style-->
<?php
 $u_data=$this->session->userdata('loggedin');
 $maccessarr=$this->session->userdata('maccessarr');
 $modper=$u_data['modper'];
 /*if($u_data['groupid']!='4')
 {
   $modper=$user_data['modper'];
   foreach($modper as $eachper)
   {
     $mparr[]=$eachper['modules'];
     $maccessarr[]=$eachper['permission'];
   }
 }
 else
 {
     $mparr=array('users','courses','media','quizzes');
     $maccessarr=array('own','view_all','modify_all');
 } */
?>

	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("/public/css/neon-theme.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("/public/css/neon-core.css"); ?>" />
	
    
<!--<link rel="stylesheet" href="<?php echo base_url() ?>public/css/jquery.treeview.css" />-->
<script src="<?php echo base_url() ?>public/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>public/js/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
	
	// first example
	$("#browser").treeview();
	
	// second example
	$("#navigation").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});
	
	// third example
	$("#red").treeview({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "cookie",
		toggle: function() {
			window.console && console.log("%o was toggled", this);
		}
	});
	
	// fourth example
	$("#black, #gray").treeview({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "treeview-black"
	});


		var frameurl1 = parent.window.document.location.href;
		var segarray1 = frameurl1.split('/');
		var i = 0;
		segarray1.forEach(function (item1) {
		if(item1 == 'smartcoursemanager'){
			$('#coursewizardshooter').attr("href","javascript:void(0)");
			  }
			})
		
});
	</script>
<!-- -->
<!--/treemenu scripts and style-->

	<ul id="browser" class="filetree">

	  <span class="folder"><a href="<?php echo base_url(); ?>admin/" style="background-position: 0px 0px;">MLMS</a></span>
      <?php
if(($u_data['groupid']=='4') || (in_array('users',$this->session->userdata('mparr'))))
{
?>
		<li class="closed"><span class="folder">Users Management</span>
			<ul>
                 <?php
                    if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
                    {
                 ?>
                <li>
                    <span class="file">
                        <a href="<?php echo base_url(); ?>admin/groups/create/1" style="background-position:0px 0px;">Create Group</a>
                    </span>
				</li>
                <?php
                  }
                ?>

				<li>
                    <span class="file">
					    <a href="<?php echo base_url(); ?>admin/groups/" style="background-position: 0px 0px;"><?=lang('web_groups')?></a>
                    </span>
				</li>
 				<?php
                    if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
                    {
                 ?>
                <li>
                    <span class="file">
                        <a href="<?php echo base_url(); ?>admin/users/create/" style="background-position:0px 0px;">Create User</a>
                    </span>
				</li>
<?php
}
?>
				<li>
                    <span class="file">
					    <a href="<?php echo base_url(); ?>admin/users/" style="background-position: 0px 0px;">Users</a>
                    </span>
				</li>

                <?php
                  if($u_data['groupid']==='4')
                  {
                ?>
                <li>
                    <span class="file">
					    <a href="<?php echo base_url(); ?>admin/aclp/" style="background-position: 0px 0px;">Access Permissions</a>
                    </span>
				</li>
                <?php
                }
                ?>

			</ul>
		</li>
<?php } ?>
        <!--<li class="closed"><span class="folder">User</span>
			<ul>
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/users/" style="background-position: 0px 0px;">Users</a></span>
				</li>
				<li><span class="file"><a href="<?php echo base_url(); ?>admin/users/create/1" style="background-position:0px 0px;">Create User</a></span>
				</li>
			</ul>
		</li>-->
<?php
if($u_data['groupid']==='4')
{
 ?>
		<li class="closed"><span class="folder">Settings</span>
			<ul>
				<li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings/" style="background-position: 0px 0px;"><?php echo 'General'?></a>
					</span>
				</li>
				<li>				
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings/layouts" style="background-position:0px 0px;"><?php echo 'Layouts'?></a>
					</span>
				</li>
                <!--<li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings/styles" style="background-position:0px 0px;"><?php echo 'Style'?></a>
					</span>
				</li>-->
				<li>				
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings//progressbar" style="background-position:0px 0px;"><?php echo 'Progress Bar'?></a>
					</span>
				</li>
				<li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings/emailsetting" style="background-position: 0px 0px;"><?php echo 'Email'?></a>
					</span>
				</li>
				<li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings/promotionbox" style="background-position:0px 0px;"><?php echo 'Promotion box'?></a>
					</span>
				</li>
                <!--<li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/groups/create/1" style="background-position:0px 0px;"><?php echo 'Payment Plugins'?></a>
					</span>
				</li>-->
				<li>				
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings/quizcountdown" style="background-position:0px 0px;"><?php echo 'Quiz Countdown'?></a>
					</span>
				</li>
				<li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/certificates" style="background-position:0px 0px;"><?php echo 'Certificates'?></a>
					</span>
				</li>
                <li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/sociallinks/createLink" style="background-position:0px 0px;"><?php echo 'Social Links'?></a>
					</span>
				</li>
                <li>
					<span class="file">
						<a href="<?php echo base_url(); ?>admin/settings/sociallogins" style="background-position:0px 0px;"><?php echo 'Social Logins'?></a>
					</span>
				</li>
			</ul>
		</li>

<?php
}
?>

<?php
if($u_data['groupid']==='4')
{
?>
		<li class="closed"><span class="folder">Managers</span>
			<ul>
			 <?php /* ?>	<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/users/" style="background-position: 0px 0px;"><?=lang('web_users')?></a></span>
				</li>
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/users/create/" style="background-position: 0px 0px;">Create User</a></span>
				</li>      <?php */ ?>
                <li><span class="file">
					<a href="<?php echo base_url(); ?>admin/orders/" style="background-position: 0px 0px;">Orders</a></span>
				</li>
                <li><span class="file">
					<a href="<?php echo base_url(); ?>admin/promocodes/" style="background-position: 0px 0px;">Promocodes</a></span>
				</li>
                <li><span class="file">
					<a href="<?php echo base_url(); ?>admin/testimonials/" style="background-position: 0px 0px;">Testimonials</a></span>
				</li>				
                <li><span class="file">					
                <a href="<?php echo base_url(); ?>admin/userreport/" style="background-position: 0px 0px;">Users Report</a></span>				
                </li>
              <?php /* ?>  <li><span class="file">
					<a href="<?php echo base_url(); ?>admin/usercertireport/" style="background-position: 0px 0px;">Notification</a></span>
				</li> <?php */ ?>

                <li><span class="file">
					<a href="<?php echo base_url(); ?>admin/studreport/" style="background-position: 0px 0px;">Report</a></span>
				</li> 

               <li><span class="file">
					<a href="<?php echo base_url(); ?>admin/pagecreator/" style="background-position: 0px 0px;">Page Manager</a></span>
				</li>
				
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/widgets/" style="background-position: 0px 0px;">Widgets</a></span>
				</li>
				
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/templates/" style="background-position: 0px 0px;">Templates</a></span>
				</li>

				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/subscriptions/" style="background-position: 0px 0px;">Subscriptions</a></span>
				</li>
			</ul>
		</li>
<?php } ?>

<?php
if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))) || (in_array('media',$this->session->userdata('mparr'))) || (in_array('quizzes',$this->session->userdata('mparr'))) )
{
?>
		<li class="closed"><span class="folder">Training</span>
			<ul>
               <?php
                   if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))))
                   {
               ?>
				<li class="closed"><span class="folder">
                    <a href="<?php echo base_url(); ?>admin/programs/" style="background-position: 0px 0px;"><?php echo 'Courses'; //echo lang('web_products')?></a>
                    </span>
					<ul>
						<li>
                            <span class="file">
                                <a href="<?php echo base_url(); ?>admin/pcategories/" style="background-position: 0px 0px;"><?php echo 'Course Categories'; //echo lang('web_products')?></a>
                            </span>
                        </li>
                        <?php /* ?><li>
                            <span class="file">
                                <a href="<?php echo base_url(); ?>admin/programs/" style="background-position: 0px 0px;"><?php echo 'Courses'; //echo lang('web_products')?></a>
                            </span>
                        </li> <?php */ ?>

					</ul>
				</li>

                <?php  } ?>

                <?php
                if(($u_data['groupid']==='4')|| (in_array('media',$this->session->userdata('mparr'))))
                {
                ?>
				<li class="closed"><span class="folder"><?php echo 'Media Library'; //echo lang('web_products')?></span>
					<ul id="folder21">
						<li><span class="file"><a href="<?php echo base_url(); ?>admin/mcategories/" style="background-position: 0px 0px;"><?php echo 'Media Categories'; //echo lang('web_products')?></a></span></li>
                        <li><span class="file"><a href="<?php echo base_url(); ?>admin/medias/" style="background-position: 0px 0px;"><?php echo 'Media'; //echo lang('web_products')?></a></span></li>
					</ul>
				</li>
               <?php  } ?>
               <?php
               if(($u_data['groupid']==='4')||(in_array('quizzes',$this->session->userdata('mparr'))))
               {
                ?>
				<li><span class="file"><a href="<?php echo base_url(); ?>admin/quizzes/" style="background-position: 0px 0px;"><?php echo 'Quizzes'; //echo lang('web_products')?></a></span>
                </li>
                <?php  } ?>
			</ul>
		</li>

<?php } ?>



<?php
if(($u_data['groupid']==='4') || (in_array('courses',$this->session->userdata('mparr'))))
{
?>
		<li class="closed"><span class="folder">Subscriptions</span>
			<ul>
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/subplans/" style="background-position: 0px 0px;"><?php echo 'Sub Plans'; //echo lang('web_products')?></a></span>
				</li>
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/subplans/create/" style="background-position: 0px 0px;"><?php echo 'Create Sub Plans'; //echo lang('web_products')?></a></span>
				</li>
			</ul>
		</li>
<?php } ?>


<?php
if($u_data['groupid']==='2')
{
?>
		<li class="closed"><span class="folder">My Courses</span>
			<ul>
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/teachercourses/" style="background-position: 0px 0px;"><?php echo 'Courses'; ?></a></span>
				</li>

			</ul>
		</li>
<?php } ?>

<!--- V ----->
		<li class="closed"><span class="folder">Blogs Manager</span>
			<ul>
				<li><span class="file">
					<a href="<?php echo base_url(); ?>admin/blogs/" style="background-position: 0px 0px;"><?php echo 'Blog List'; ?></a></span>
				</li>

			</ul>
		</li>
		<!--- V End ----->
<!--- V ----->
		<li class="closed"><span class="folder">Smart Course Manager Wizard</span>

			<ul>
				<li>
                <span class="file">
				    <a id="coursewizardshooter" href="<?php echo base_url(); ?>admin/smartcoursemanager/" style="background-position: 0px 0px;">
					<?php echo 'Smart Course Manager Wizard'; ?></a>            </span>
				</li>

			</ul>
		</li>
		<!--- V End ----->
	</ul>
	

