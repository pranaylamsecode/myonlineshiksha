<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">

<div class="main-container">
	<style>
		#message {
    position: absolute; 
/*    color: green;
*/    right: 0;
	z-index: 9999;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    margin-top: 10px;
}

	</style>
<?php
// $attributes = array('class' => 'tform', 'id' => '');

//  echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings', $attributes) : form_open_multipart(base_url().'admin/settings');

?>
<?php $CI = & get_instance(); ?>
<div class="settings_page">
<div id="toolbar-box">

	<div class="m top_main_content">
<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo 'Settings';?></h2>
								<h6>Manage your academy settings.</h6>
		</div>
		<!-- <div id="toolbar" class="toolbar-list">

			<ul style="list-style:none; float:right;">

			<li id="toolbar-new" class="listbutton">

			</li>

			</ul>

			<div class="clr"></div>

		</div>
			<span id="message"></span> -->

		

	</div>

</div>

<div class="tab-content">

	<!--Main fieldset-->
<!-- 
<form id="adminForm" name="adminForm" method="post" action="index.php">     

	<fieldset class="adminform">

	</fieldset>
</form> -->

</div>
<div class="field_container">
<div class="card">
	<div class="field_content" style="width: 100%;">
		
		<div class="panel panel-primary primary-border" data-collapsed="0">
		
			<div class="panel-heading">

			<div class="panel-title" style="padding:0;width:100%;">
					<ul class="nav nav-tabs" id="myTab"><!-- available classes "bordered", "right-aligned" --> 
					<li id="tab1" style="border-left:none;"><a href="#general" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab1');"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">General</span></a></li> 

					<li id="tab2"> <a href="#homepagesettings" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab2');"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Payment</span></a></li>

					<li id="tab3"> <a href="#bannerslider" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab3');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Subscription plan</span></a></li> 

					<li id="tab4"> <a href="#certificate" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab4');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Certificate</span></a></li> 
					 
					<li id="tab5"> <a href="#social" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab5');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Social logins</span></a></li> 
					<li id="tab6"> <a href="#email_set" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab6');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Email Settings</span></a></li> 
					<li id="tab7"> <a href="#domain_pt" class="home-page-li-border" data-toggle="tab" onclick="tabActive('tab7');" ><span class="visible-xs"><i class="entypo-mail"></i></span><span class="hidden-xs">Custom Domain</span></a></li> 
					
				
					</ul>
			</div>

				<!-- <div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div> -->
			</div>
			
			<div class="panel-body main-table form-body tab-box">

		<div class="tab-content">
			<div style="display: none; text-align: center;" id="loader"><img src="<?php echo base_url(); ?>public/images/loading.gif "></div>
			<div class="tab-pane tab1_tab" id="general">
				
			<?php 
			echo $CI->load->view('admin/settings/gene');
			?>
			</div>

			<!-- </div> -->
			
           
		  <div class="tab-pane tab2_tab" id="homepagesettings">
         

		</div>

		<div class="tab-pane tab3_tab" id="bannerslider">
          
		</div>

		<div class="tab-pane tab4_tab" id="certificate">
          

		</div>

		<div class="tab-pane tab5_tab" id="social">
          
		</div>

		<div class="tab-pane tab6_tab" id="email_set">
          
		</div>
		<div class="tab-pane tab7_tab" id="domain_pt">
          
		</div>


	  </div>
</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
</div>
<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$id) ?>

<?php endif ?>

<?php // echo form_close(); ?>

<!-- tool tip script -->
  
 <script>
	jQuery(document).ready(function(){
		var tab = "<?php echo $this->session->userdata('Active_setting'); ?>";
		if(tab=='')
		{
			// $(document).find('.tab-pane').removeClass('active');
			$(document).find(".tab1_tab, li#tab1").addClass('active');
		}
		else{
			tabActive(tab);			
		}

		$(document).find('#'+tab+', .'+tab+'_tab').addClass('active');

		// var tab_con = $('#'+tab).find('a').attr('href');
		// $(tab_con).show();
	})
</script>

			<script>
			function tabActive(tabname)
			{	

				if(tabname != 'tab1'){

					chk = $(document).find("."+tabname+"_tab").html();
					if($.trim(chk) == ""){
					
				jQuery.ajax({
							type: "POST",
							url: "<?php echo base_url(); ?>admin/templates/tabActive",
							data: {tabname:tabname}, 
							beforeSend: function(){
						        $('#loader').show();
						        $(document).find(".tab-pane, li").removeClass('active');
						$(document).find("li#"+tabname+", ."+tabname+"_tab").addClass('active');

						    },
							success: function(data)
							{
								$('#loader').hide();
		
								$(document).find('.tab-pane, li').removeClass('active');
						$(document).find("li#"+tabname+", ."+tabname+"_tab").addClass('active');

							$(document).find("."+tabname+"_tab").html(data);
							},
							complete: function(){
								 $('#loader').hide();

							},
							error: function()
							{
								$('#loader').hide();

							}
		  				});
					}
					else{
						$(document).find('.tab-pane , li').removeClass('active');
						$(document).find("li#"+tabname+", ."+tabname+"_tab").addClass('active');
					}
				}
				else{

					$(document).find('.tab-pane, li').removeClass('active');
					$(document).find("li#"+tabname+", ."+tabname+"_tab").addClass('active');
				}
				
					
				
			}
			</script>



			
<script type="text/javascript">


jQuery(document).ready(function(){
	jQuery('.tooltipicon').mouseenter(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.tooltipicon').mouseleave(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','none');
	});
	});

	</script>

<!-- tool tip script finish -->