<base href="<?php echo $this->config->item('base_url') ?>public/" />

   <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
   <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
   <link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />
   <link rel="stylesheet" href="css/colour_standard.css" type="text/css" media="screen" />


   <!-- <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />  -->
    <link rel="stylesheet" href="css/datetimepicker.css" type="text/css" media="screen" />


	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});


	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}

      .error{
      	color: red;
      	font-size:13px;
      }

	</style>
<!--/lightbox scripts and style-->
 <script type="text/javascript">
 $(function(){
   $("#forward").click(function() {
   window.parent.location.href = "<?php echo base_url(); ?>admin/days/<?php echo $pid?>";
    });
    	});
</script>

 <?php
$updType="create";
$pid="241";
?>
 <?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open(base_url().'admin/tasks/create', $attributes) : form_open(base_url().'admin/tasks/edit/', $attributes);
?>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul>
                <li id="toolbar-new" class="listbutton">
    			<?php echo form_submit( 'submit', ($updType == 'edit') ? "" : "", (($updType == 'create') ? "id='submit' class='save_btn'" : "id='submit' class='save_btn'") ); ?><br />
    			Save
    			</a>
    			</li>
    			<li id="toolbar-new" class="listbutton">
    			<a>Cancel</a>
    			</li>
			</ul>
			<div class="clr"></div>
		</div>
<div class="pagetitle"><h2>Page Manager</h2></div>
	</div>
</div>




<div>
<script type="text/javascript">
			$(function(){
				$('dl.tabs dt').click(function(){
					$(this)
						.siblings().removeClass('selected').end()
						.next('dd').andSelf().addClass('selected');
				});
			});
			function ChangeLayout(number){
			for(i=1; i<=12; i++)
			if(i==number){
			document.getElementById('layout_img_'+i).style.border = '3px solid #0000FF';
			document.getElementById('layout'+i).style.display = '';
			}
			else{
			document.getElementById('layout_img_'+i).style.border = '';
			document.getElementById('layout'+i).style.display = 'none';
			}
			document.getElementById('layout_db').value = number;
			}

		function deleteJumpButton(sno,lid)
		{
		var jmp = 'jmp'+sno+'L'+lid;
		var jumpbutton = 'jumpbutton'+sno;
		var jumptitle = 'jumptitle'+sno+'L'+lid;
		var deljmp = 'deljmp'+sno+'L'+lid;
		var jumpanch = 'jump'+sno+'L'+lid;
		/*alert(jmp);
		alert(jumpbutton);
		alert(jumptitle);
		alert(jumpanch);
		alert(deljmp);*/
		var changejumptext = "Add a Jump Button";
		document.getElementById(jumptitle).innerHTML = changejumptext;
		document.getElementById(jumpbutton).value = 0;
		document.getElementById(jmp).style.backgroundColor = "#FF99FF";
		document.getElementById(deljmp).style.display = 'none';
		document.getElementById(jumpanch).href = "<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/"+sno+"/"+"0";
		}

</script>
</div>

<dl class="tabs">
	<dt class="selected">Page Info</dt>
		<dd class="selected" sno='1'>
			<div class="tab-content">
				<fieldset class="adminform">
				<legend>New Page</legend>
					<table class="adminform">
						<tbody>
							<tr>
								<td width="15%">
									<label class='labelform' for="Lesson"><?php echo "Title";?> <span class="required">*</span></label>
								</td>
								<td>
									<input id="name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>"  />
                                    <span class="error"><?php echo form_error('name'); ?> </span>								</td>
							</tr>



						</tbody>
					</table>
			</fieldset>



		<fieldset class="adminform" style="padding: 5px;">
		<legend>Layout</legend>
	<table class="adminform" style="width:800px;">
		<tbody><tr>
			<td>
				Select Layout&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/images/admin/layouts/media_back.gif" alt="media">
				media storage&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/images/admin/layouts/text_back.gif" alt="text">
				text only			</td>
		</tr>
		<tr>
			<td>
				<table style="width:550px; ">
					<tbody><tr>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(6);" id="layout_img_6" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='6') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?><?php echo set_value('layout_db', (isset($task->layoutid)) ? '' : 'border:3px; border-style:solid; border-color:#0000FF;'); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-6.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(5);" id="layout_img_5" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='5') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-5.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(12);" id="layout_img_12" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='12') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-12.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(1);" id="layout_img_1" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='1') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-1.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(7);" id="layout_img_7" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='7') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-7.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(2);" id="layout_img_2" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='2') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-2.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(8);" id="layout_img_8" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='8') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-8.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(3);" id="layout_img_3" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='3') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-3.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(9);" id="layout_img_9" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='9') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-9.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(4);" id="layout_img_4" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='4') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-4.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(10);" id="layout_img_10" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='10') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-10.gif" alt="">
						</td>
						<td style="width:50px;">
							<img onclick="javascript:ChangeLayout(11);" id="layout_img_11" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='11') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-11.gif" alt="">
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
		<input name="text_is_quiz" type="hidden" value="0">
	<tr id="layout1" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='1') ? '' : 'display:none'); ?>">
			<?php
			$layout_text1_flag = (isset($db_mediatext[0]->media_id)) ? true : false;
			$layout_media1_flag = (isset($db_media[0]->media_id)) ? true : false;
			?>
			<td>
				<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
					<tbody><tr>
						<td>
							<table align="center" style="width:200px; border:1px solid #eeeeee;">
								<tbody><tr bgcolor="#FFFFCC">
									<td style="text-align:center" id="menu_med_1">
                                    <?php
                                     //echo $updType;
                                    // echo $db_mediatext[0]->media_id;
                                     if($updType == 'edit' && $db_media[0]->media_id != '0'){ ?>
										<div id="before_menu_med_1" style="display:none">
											<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe">Select media</a>

										</div>
                                        <?php }else{ ?>
                                        <div id="before_menu_med_1">
											<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe">Select media</a>

										</div>

                                        <?php } ?>
                                        <?php if($updType == 'edit' && $db_media[0]->media_id != '0'){ ?>
										<div id="after_menu_med_1">
											<table>
												<tbody><tr>
													<td width="33%" style="text-align:center">
														<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe">Replace media</a>
													</td>

											</tr>
										</tbody></table>
									  </div>
                                      <?php }else{ ?>
                                     <div id="after_menu_med_1" style="display:none">
											<table>
												<tbody><tr>
													<td width="33%" style="text-align:center">
														<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe">Replace media</a>
													</td>

											</tr>
										</tbody></table>
									</div>

                                    <?php }?>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                   <?php if($updType == 'edit' && $db_mediatext[0]->media_id != '0'){ ?>
									<div id="before_menu_txt_1" style="display:none">
										<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe">Select text</a>

									</div>
                                    <?php }else{?>
                                    <div id="before_menu_txt_1">
										<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe">Select text</a>

									</div>

                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[0]->media_id != '0'){ ?>
									<div id="after_menu_txt_1">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_1" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>

                                    <?php }?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
									<div id="media_1">
									<?php if($layout_media1_flag && $db_media[0]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[0]->media_id;?>/1");
										</script>
										<?php }else{?>
										<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
									<div id="text_1">
									<?php
										if($layout_text1_flag && $db_mediatext[0]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[0]->media_id;?>/1");
										</script>
										<?php }else{?>
										<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
										<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L1" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L1"> <?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button" ;?> </span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L1" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L1" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L1"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L1" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L1" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L1"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L1" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L1" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L1"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L1" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr id="layout2" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='2') ? '' : 'display:none'); ?>">
	<?php
	$layout_media2_flag = (isset($db_media[1]->media_id)) ? true : false;
	$layout_media3_flag = (isset($db_media[2]->media_id)) ? true : false;
	$layout_text2_flag = (isset($db_mediatext[1]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_2">
                                    <?php if($updType == 'edit' && $db_media[1]->media_id != '0'){ ?>
									<div id="before_menu_med_2" style="display:none">
                                     <a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe">Select media</a>
									</div>
                                    <?php }else{ ?>
                                     <div id="before_menu_med_2">
                                     <a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe">Select media</a>
									</div>

                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[1]->media_id != '0'){ ?>
									<div id="after_menu_med_2">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_2" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                <?php if($updType == 'edit' && $db_mediatext[1]->media_id != '0'){ ?>
									<div id="before_menu_txt_2" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe">Select text</a>
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_2">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe">Select text</a>
									</div>

                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[1]->media_id != '0'){ ?>
									<div id="after_menu_txt_2">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/2' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_2" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/2' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>


                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_2">
										<?php if($layout_media2_flag && $db_media[1]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_2').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[1]->media_id;?>/2");
										</script>
										<?php }else{?>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td valign="top" rowspan="3">
						<table>
							<tbody><tr>
								<td>
								<div id="text_2">
								<?php 	if($layout_text2_flag && $db_mediatext[1]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_2').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[1]->media_id;?>/2");
										</script>
										<?php }else{?>
								 <img height="530px" width="440px" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
											<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td valign="top">
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_3">
                                 <?php if($updType == 'edit' && $db_media[2]->media_id != '0'){ ?>
									<div id="before_menu_med_3" style="display:none;">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_3">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>

                                    <?php }?>
                                    <?php if($updType == 'edit' && $db_media[2]->media_id != '0'){ ?>
									<div id="after_menu_med_3">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_3" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>


                                    <?php }?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_3">
								<?php 	if($layout_media3_flag && $db_media[2]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_3').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[2]->media_id;?>/3");
										</script>
										<?php }else{?>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L2" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L2"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L2" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L2" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L2"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L2" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L2" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L2"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L2" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L2" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L2"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L2" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>

		</td>
	</tr>
	<tr id="layout3" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='3') ? '' : 'display:none'); ?>">
	<?php
   // print_r($db_media[3]->media_id);
   // print_r($db_mediatext[2]->media_id);  exit;
	$layout_media4_flag = (isset($db_media[3]->media_id)) ? true : false;
	$layout_text3_flag = (isset($db_mediatext[2]->media_id)) ? true : false;
	?>	<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_4">
                                <?php if($updType == 'edit' && $db_media[3]->media_id != '0'){ ?>
									<div id="before_menu_med_4" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{  ?>
                                    <div id="before_menu_med_4">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>

                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[3]->media_id != '0'){ ?>
									<div id="after_menu_med_4">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_4" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>


                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_4">
									<?php if($layout_media4_flag && $db_media[3]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_4').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[3]->media_id;?>/4");
										</script>
										<?php }else{?>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
									<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                    <?php if($updType == 'edit' && $db_mediatext[2]->media_id != '0'){ ?>
									<div id="before_menu_txt_3" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;  </div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_3">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;  </div>
                                    <?php }?>
                                    <?php if($updType == 'edit' && $db_mediatext[2]->media_id != '0'){ ?>
									<div id="after_menu_txt_3">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_3" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="text_3">
								<?php if($layout_text3_flag && $db_mediatext[2]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_3').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[2]->media_id;?>/3");
										</script>
										<?php }else{?>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
											<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L3" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L3"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L3" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L3" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L3"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L3" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L3" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L3"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L3" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L3" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L3"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L3" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr id="layout4" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='4') ? '' : 'display:none'); ?>">
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_5">
                                  <?php if($updType == 'edit' && $db_media[4]->media_id  != '0'){ ?>
									<div id="before_menu_med_5" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_5">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[4]->media_id  != '0'){ ?>
									<div id="after_menu_med_5">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    	<div id="after_menu_med_5" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_6">
                                   <?php if($updType == 'edit' && $db_media[5]->media_id  != '0'){ ?>
                                   	<div id="before_menu_med_6" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_6">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[5]->media_id  != '0'){ ?>
									<div id="after_menu_med_6">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_6" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>


                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
									<div id="media_5">
										<?php
										$layout_media5_flag = (isset($db_media[4]->media_id)) ? true : false;
										if($layout_media5_flag && $db_media[4]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_5').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[4]->media_id;?>/5");
										</script>
										<?php }else{?>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
											<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
									<div id="media_6">
									<?php
										$layout_media6_flag = (isset($db_media[5]->media_id)) ? true : false;
										if($layout_media6_flag && $db_media[5]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_6').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[5]->media_id;?>/6");
										</script>
										<?php }else{?>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                  <?php if($updType == 'edit' && $db_mediatext[3]->media_id  != '0'){ ?>
									<div id="before_menu_txt_4" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_4">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>

                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[3]->media_id  != '0'){ ?>
									<div id="after_menu_txt_4">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{   ?>
                                    <div id="after_menu_txt_4" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>

                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">
						<table>
							<tbody><tr>
								<td>
								<div id="text_4">
								<?php
										$layout_text4_flag = (isset($db_mediatext[3]->media_id)) ? true : false;
										if($layout_text4_flag && $db_mediatext[3]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_4').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[3]->media_id;?>/4");
										</script>
										<?php }else{?>
									<img height="240" width="775" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
											<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                     <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L4" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L4"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L4" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L4" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L4"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L4" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L4" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L4"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L4" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L4" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L4"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L4" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr id="layout5" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='5') ? '' : 'display:none'); ?>">
	<?php
	$layout_text5_flag = (isset($db_mediatext[4]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                <?php if($updType == 'edit' && $db_mediatext[4]->media_id != '0'){ ?>
									<div id="before_menu_txt_5" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                   <?php }else{ ?>
                                     <div id="before_menu_txt_5">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>

                                   <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[4]->media_id != '0'){ ?>
									<div id="after_menu_txt_5">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_5" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>

                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="text_5">
										<?php if($layout_text5_flag && $db_mediatext[4]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_5').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[4]->media_id;?>/5");
										</script>
										<?php }else{?>
									<img height="359" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L5" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L5"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L5" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L5" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L5"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L5" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L5" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L5"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>                                 </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L5" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L5" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L5"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L5" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr id="layout6" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='6') ? '' : 'display:none'); ?><?php echo set_value('layout_db', (isset($task->layoutid)) ? '' : 'display:block'); ?>">
	<?php
   $layout_media7_flag = (isset($db_media[6]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_7">
                                <?php if($updType == 'edit' && $db_media[6]->media_id != '0'){ ?>
									<div id="before_menu_med_7" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_7">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[6]->media_id != '0'){ ?>
									<div id="after_menu_med_7">
										<table>
							   	<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_7" style="display:none">
										<table>
							   	<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
									<div id="media_7">
										<?php
                                       // echo $layout_media7_flag;
                                         if($layout_media7_flag && $db_media[6]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_7').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[6]->media_id;?>/7");
										</script>
										<?php }else{?>
										<img height="359" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
						<table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L6" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L6"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L6" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L6" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L6"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L6" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L6" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L6"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L6" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L6" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L6"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L6" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr id="layout7" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='7') ? '' : 'display:none'); ?>">
	<?php
	$layout_text6_flag = (isset($db_mediatext[5]->media_id)) ? true : false;
	$layout_media8_flag = (isset($db_media[7]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                    <?php if($updType == 'edit' && $db_mediatext[5]->media_id != '0'){ ?>
									<div id="before_menu_txt_6" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_6">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[5]->media_id != '0'){ ?>
									<div id="after_menu_txt_6">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_6" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>

                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_8">
                                    <?php if($updType == 'edit' && $db_media[7]->media_id != '0'){ ?>
									<div id="before_menu_med_8" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe">Select media</a>

									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_8">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe">Select media</a>

									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[7]->media_id != '0'){ ?>
									<div id="after_menu_med_8">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_8" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>


                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="text_6">
								<?php if($layout_text6_flag && $db_mediatext[5]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_6').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[5]->media_id;?>/6");
										</script>
										<?php }else{?>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
									<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_8">
										<?php if($layout_media8_flag && $db_media[7]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_8').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[7]->media_id;?>/8");
										</script>
										<?php }else{?>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
									<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L7" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L7"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L7" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L7" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L7"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L7" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L7" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L7"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L7" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L7" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L7"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L7" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr id="layout8" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='8') ? '' : 'display:none'); ?>">
	<?php
	$layout_text7_flag = (isset($db_mediatext[7]->media_id)) ? true : false;
	$layout_media9_flag = (isset($db_media[8]->media_id)) ? true : false;
	$layout_media10_flag = (isset($db_media[9]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>
									<div id="before_menu_txt_7" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{?>
                                     <div id="before_menu_txt_7">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>

                                    <?php } ?>
                                     <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>
									<div id="after_menu_txt_7">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{    ?>
                                     <div id="after_menu_txt_7" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                     <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_9">
                                <?php if($updType == 'edit' && $db_media[8]->media_id != '0'){ ?>
									<div id="before_menu_med_9" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_9">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[8]->media_id != '0'){ ?>
									<div id="after_menu_med_9">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                     <div id="after_menu_med_9" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>

                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top" rowspan="3">
						<table>
							<tbody><tr>
								<td>
								<div id="text_7">
								<?php if($layout_text7_flag && $db_mediatext[7]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_7').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[7]->media_id;?>/7");
										</script>
										<?php }else{?>
									<img height="530px" width="440px" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>

					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_9">
								<?php if($layout_media9_flag && $db_media[8]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_9').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[8]->media_id;?>/9");
										</script>
										<?php }else{?>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>

				</tr>

				<tr>
					<td valign="top">
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_10">
                                 <?php if($updType == 'edit' && $db_media[9]->media_id != '0'){ ?>
									<div id="before_menu_med_10" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>
                                    <?php }else{  ?>
                                     <div id="before_menu_med_10">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;

									</div>

                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[9]->media_id != '0'){ ?>
									<div id="after_menu_med_10">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_10" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>


                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_10">
										<?php if($layout_media10_flag && $db_media[9]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_10').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[9]->media_id;?>/10");
										</script>
										<?php }else{?>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L8" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L8"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L8" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L8" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L8"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L8" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L8" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L8"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L8" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L8" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L8"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L8" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>

		</td>
	</tr>
	<tr id="layout9" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='9') ? '' : 'display:none'); ?>">
	<?php
	$layout_text8_flag = (isset($db_mediatext[7]->media_id)) ? true : false;
	$layout_media11_flag = (isset($db_media[10]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>
									<div id="before_menu_txt_8" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_8">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>
									<div id="after_menu_txt_8">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_8" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe">Replace text</a>
												</td>

											</tr>
										</tbody></table>
									</div>

                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="text_8">
								<?php if($layout_text8_flag && $db_mediatext[7]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_8').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[7]->media_id;?>/8");
										</script>
										<?php }else{?>
								<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_11">
                                <?php if($updType == 'edit' && $db_media[10]->media_id != '0'){ ?>
									<div id="before_menu_med_11" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_11">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>

                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[10]->media_id != '0'){ ?>
									<div id="after_menu_med_11">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    	<div id="after_menu_med_11" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_11">
								<?php if($layout_media11_flag && $db_media[10]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_11').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[10]->media_id;?>/11");
										</script>
										<?php }else{?>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                       <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L9" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L9"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L9" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L9" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L9"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L9" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L9" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L9"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L69 tyle="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L9" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L9"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L9" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	<tr id="layout10" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='10') ? '' : 'display:none'); ?>">
	<?php
	$layout_text9_flag = (isset($db_mediatext[8]->media_id)) ? true : false;
	$layout_media12_flag = (isset($db_media[11]->media_id)) ? true : false;
	$layout_media13_flag = (isset($db_media[12]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td valign="top" colspan="2">
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                 <?php if($updType == 'edit' && $db_mediatext[8]->media_id != '0'){ ?>
									<div id="before_menu_txt_9" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/9' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_9">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/9' class="fancybox fancybox.iframe">Select text</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[8]->media_id != '0'){ ?>
									<div id="after_menu_txt_9">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a  href="index.php?option=com_guru&amp;controller=guruTasks&amp;task=addtext&amp;tmpl=component&amp;cid[]=&amp;txt=9" class="modal2">Replace text</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_9" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a  href="index.php?option=com_guru&amp;controller=guruTasks&amp;task=addtext&amp;tmpl=component&amp;cid[]=&amp;txt=9" class="modal2">Replace text</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">
						<table>
							<tbody><tr>
								<td>
								<div id="text_9">
									<?php if($layout_text9_flag && $db_mediatext[8]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_9').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[8]->media_id;?>/9");
										</script>
										<?php }else{?>
									<img height="240" width="775" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_12">
                                <?php if($updType == 'edit' && $db_media[11]->media_id != '0'){ ?>
									<div id="before_menu_med_12" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe">Select media</a>
									</div>
                                    <?php }else{  ?>
                                    <div id="before_menu_med_12">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe">Select media</a>
									</div>
                                    <?php }?>

                                    <?php if($updType == 'edit' && $db_media[11]->media_id != '0'){ ?>
									<div id="after_menu_med_12">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{  ?>
                                    <div id="after_menu_med_12" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }?>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_13">
                                    <?php if($updType == 'edit' && $db_media[12]->media_id != '0'){ ?>
									<div id="before_menu_med_13" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_13">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe">Select media</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									</div>

                                    <?php } ?>
                                     <?php if($updType == 'edit' && $db_media[12]->media_id != '0'){ ?>
									<div id="after_menu_med_13">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_13" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe">Replace media</a>
												</td>

											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
									<div id="media_12">
									<?php if($layout_media12_flag && $db_media[11]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_12').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[11]->media_id;?>/12");
										</script>
										<?php }else{?>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
									<div id="media_13">
										<?php if($layout_media13_flag && $db_media[12]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_13').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[12]->media_id;?>/13");
										</script>
										<?php }else{?>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L10" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L10"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L10" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L10" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L10"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L10" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L10" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L10"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L10" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L10" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L10"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L10" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>

			</tbody></table>
		</td>
	</tr>
	<tr id="layout11" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='11') ? '' : 'display:none'); ?>">
	<?php
	$layout_text10_flag = (isset($db_mediatext[9]->media_id)) ? true : false;
	$layout_media14_flag = (isset($db_media[13]->media_id)) ? true : false;
	$layout_text11_flag = (isset($db_mediatext[10]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                    <?php if($updType == 'edit' && $db_mediatext[9]->media_id != '0'){ ?>
									<div id="before_menu_txt_10" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe">Select text</a>

									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_10">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe">Select text</a>

									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[9]->media_id != '0'){ ?>
									<div id="after_menu_txt_10">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe">Replace text</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_10" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe">Replace text</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="text_10">
										<?php if($layout_text10_flag && $db_mediatext[9]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_10').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[9]->media_id;?>/10");
										</script>
										<?php }else{?>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center" id="menu_med_14">
                                    <?php if($updType == 'edit' && $db_media[13]->media_id != '0'){ ?>
									<div id="before_menu_med_14" style="display:none;">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe">Select media</a>

									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_med_14">
                                    <a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe">Select media</a>
                                     </div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_media[13]->media_id != '0'){ ?>

                                    <div id="after_menu_med_14">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_med_14" style="display:none;">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe">Replace media</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="media_14">
										<?php if($layout_media14_flag && $db_media[13]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#media_14').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[13]->media_id;?>/14");
										</script>
										<?php }else{?>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center">
                                    <?php if($updType == 'edit' && $db_mediatext[10]->media_id != '0'){ ?>
									<div id="before_menu_txt_11" style="display:none">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe">Select text</a>
									</div>
                                    <?php }else{ ?>
                                    <div id="before_menu_txt_11">
									<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe">Select text</a>
									</div>
                                    <?php } ?>
                                    <?php if($updType == 'edit' && $db_mediatext[10]->media_id != '0'){ ?>
									<div id="after_menu_txt_11">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe">Replace text</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php }else{ ?>
                                    <div id="after_menu_txt_11" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe">Replace text</a>
												</td>
											</tr>
										</tbody></table>
									</div>
                                    <?php } ?>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table>
							<tbody><tr>
								<td>
								<div id="text_11">
								<?php if($layout_text11_flag && $db_mediatext[10]->media_id != '0'){ ?>
										<script type="text/javascript">
										jQuery('#text_11').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[10]->media_id;?>/11");
										</script>
										<?php }else{?>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">
										<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L11" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L11"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L11 style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L11" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L11"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L11 style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L11" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L11"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L11" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L11" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L11"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L11" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>

			</tbody></table>
		</td>
	</tr>
	<tr id="layout12" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='12') ? '' : 'display:none'); ?>">
	<?php
	$layout_media15_flag = (isset($db_media[14]->media_id)) ? true : false;
	?>
		<td>
			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee; width:100%">
				<tbody><tr>
					<td>
						<table align="center" style="width:200px; border:1px solid #eeeeee;">
							<tbody><tr bgcolor="#FFFFCC">
								<td style="text-align:center;" id="menu_med_15">
									<div id="before_menu_med_15">
									<a href='<?php echo base_url() ?>admin/quizzes/quizesaddtotask/15' class="fancybox fancybox.iframe">Select quiz</a>
                                        <!--<script type="text/javascript">
											document.write('&nbsp;&nbsp;&nbsp;&nbsp;<a class="modal2" rel="{handler: \'iframe\', size: {x: (document.adminForm.page_width.value-20), y: (document.adminForm.page_height.value-20)}}" href="index.php?option=com_guru&controller=guruQuiz&task=editsboxx&cid[]=0&tmpl=component">New Quiz</a>');
										</script>
										<a href='<?php echo base_url() ?>admin/quizzes/quizesaddtotask/15' class="fancybox fancybox.iframe">New Quiz</a>-->
									</div>
									<div id="after_menu_med_15" style="display:none">
										<table>
											<tbody><tr>
												<td width="33%" style="text-align:center">
													<a href='<?php echo base_url() ?>admin/quizzes/quizesaddtotask/15' class="fancybox fancybox.iframe">Replace quiz</a>
												</td>
                                               <!--	<td width="33%" style="text-align:center">
													<script type="text/javascript">
														document.write('<a id="a_edit_media_15" class="modal2" rel="{handler: \'iframe\', size: {x: (document.adminForm.page_width.value-20), y: (document.adminForm.page_height.value-20)}}" href="index.php?option=com_guru&controller=guruQuiz&tmpl=component&task=editsboxx&cid[]=0&scr=&type=quiz">Edit Quiz</a>');
													</script><a id="a_edit_media_15" class="modal2"  href="index.php?option=com_guru&amp;controller=guruQuiz&amp;tmpl=component&amp;task=editsboxx&amp;cid[]=0&amp;scr=&amp;type=quiz">Edit Quiz</a>
												</td>
												<td width="33%" style="text-align: center">
													<script type="text/javascript">
														document.write('<a class="modal2" rel="{handler: \'iframe\', size: {x: (document.adminForm.page_width.value-20), y: (document.adminForm.page_height.value-20)}}" href="index.php?option=com_guru&controller=guruQuiz&task=editsboxx&cid[]=0&tmpl=component">New Quiz</a>');
													</script><a class="modal2"  href="index.php?option=com_guru&amp;controller=guruQuiz&amp;task=editsboxx&amp;cid[]=0&amp;tmpl=component">New Quiz</a>
												</td>-->
											</tr>
										</tbody></table>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table width="100%">
							<tbody><tr>
								<td>
									<div id="media_15">
									<?php if($layout_media15_flag){ ?>
										<script type="text/javascript">
										jQuery('#media_15').load("<?php echo base_url();?>admin/quizzes/ajaxquizztotask/<?php echo $db_media[14]->media_id;?>/15");
										</script>
										<?php }else{?>
										<img height="359" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">
										<?php }?>
									</div>
								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr colspan="2">
					<td colspan="2">
						<div style="margin-left: 28%;">
                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">
							<tbody><tr>
								<td>
                                    <div id="jmp1L12" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump1L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle1L12"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but1)){?>
									<div id="deljmp1L12" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(1,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td><div id="jmp2L12" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump2L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle2L12"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but2)){?>
									<div id="deljmp2L12" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(2,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>

								</div>
								</td>
							</tr>
							<tr>
								<td>
                                <div id="jmp3L12" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump3L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle3L12"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but3)){?>
									<div id="deljmp3L12" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(3,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
								<td>
                                <div id="jmp4L12" style="color: #FFF; background: #FF99FF; padding: 10px 0px; font-weight:bold; text-align:center;">
                                  <a id="jump4L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe">
                                      <span id="jumptitle4L12"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>
                                  </a>
								<?php if(isset($jump_but4)){?>
									<div id="deljmp4L12" style="float:right; margin-top:0px;">
									<a style="color:#fff;" onclick="javascript:deleteJumpButton(4,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>
									</div>
								<?php }?>
								</div>
								</td>
							</tr>
						</tbody></table>
						</div>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
	</tbody></table>
	</fieldset>

			</div>

		</dd>

</dl>
<input id="oldTitle" type="hidden" value="bbbnnn" name="oldTitle">
<input id="layout_db" type="hidden" value="<?php echo set_value('layout_db', (isset($task->layoutid)) ? $task->layoutid : '6'); ?>" name="layout_db">
<input id="db_media_1" type="hidden" value="<?php echo set_value('db_media_1', (isset($db_media[0]->media_id)) ? $db_media[0]->media_id : '0'); ?>" name="db_media_1">
<input id="db_media_2" type="hidden" value="<?php echo set_value('db_media_2', (isset($db_media[1]->media_id)) ? $db_media[1]->media_id : '0'); ?>" name="db_media_2">
<input id="db_media_3" type="hidden" value="<?php echo set_value('db_media_3', (isset($db_media[2]->media_id)) ? $db_media[2]->media_id : '0'); ?>" name="db_media_3">
<input id="db_media_4" type="hidden" value="<?php echo set_value('db_media_4', (isset($db_media[3]->media_id)) ? $db_media[3]->media_id : '0'); ?>" name="db_media_4">
<input id="db_media_5" type="hidden" value="<?php echo set_value('db_media_5', (isset($db_media[4]->media_id)) ? $db_media[4]->media_id : '0'); ?>" name="db_media_5">
<input id="db_media_6" type="hidden" value="<?php echo set_value('db_media_6', (isset($db_media[5]->media_id)) ? $db_media[5]->media_id : '0'); ?>" name="db_media_6">
<input id="db_media_7" type="hidden" value="<?php echo set_value('db_media_7', (isset($db_media[6]->media_id)) ? $db_media[6]->media_id : '0'); ?>" name="db_media_7">
<input id="db_media_8" type="hidden" value="<?php echo set_value('db_media_8', (isset($db_media[7]->media_id)) ? $db_media[7]->media_id : '0'); ?>" name="db_media_8">
<input id="db_media_9" type="hidden" value="<?php echo set_value('db_media_9', (isset($db_media[8]->media_id)) ? $db_media[8]->media_id : '0'); ?>" name="db_media_9">
<input id="db_media_10" type="hidden" value="<?php echo set_value('db_media_10', (isset($db_media[9]->media_id)) ? $db_media[9]->media_id : '0'); ?>" name="db_media_10">
<input id="db_media_11" type="hidden" value="<?php echo set_value('db_media_11', (isset($db_media[10]->media_id)) ? $db_media[10]->media_id : '0'); ?>" name="db_media_11">
<input id="db_media_12" type="hidden" value="<?php echo set_value('db_media_12', (isset($db_media[11]->media_id)) ? $db_media[11]->media_id : '0'); ?>" name="db_media_12">
<input id="db_media_13" type="hidden" value="<?php echo set_value('db_media_13', (isset($db_media[12]->media_id)) ? $db_media[12]->media_id : '0'); ?>" name="db_media_13">
<input id="db_media_14" type="hidden" value="<?php echo set_value('db_media_14', (isset($db_media[13]->media_id)) ? $db_media[13]->media_id : '0'); ?>" name="db_media_14">
<input id="db_media_15" type="hidden" value="<?php echo set_value('db_media_15', (isset($db_media[14]->media_id)) ? $db_media[14]->media_id : '0'); ?>" name="db_media_15">
<input id="db_text_1" type="hidden" value="<?php echo set_value('db_text_1', (isset($db_mediatext[0]->media_id)) ? $db_mediatext[0]->media_id : '0'); ?>" name="db_text_1">
<input id="db_text_2" type="hidden" value="<?php echo set_value('db_text_2', (isset($db_mediatext[1]->media_id)) ? $db_mediatext[1]->media_id : '0'); ?>" name="db_text_2">
<input id="db_text_3" type="hidden" value="<?php echo set_value('db_text_3', (isset($db_mediatext[2]->media_id)) ? $db_mediatext[2]->media_id : '0'); ?>" name="db_text_3">
<input id="db_text_4" type="hidden" value="<?php echo set_value('db_text_4', (isset($db_mediatext[3]->media_id)) ? $db_mediatext[3]->media_id : '0'); ?>" name="db_text_4">
<input id="db_text_5" type="hidden" value="<?php echo set_value('db_text_5', (isset($db_mediatext[4]->media_id)) ? $db_mediatext[4]->media_id : '0'); ?>" name="db_text_5">
<input id="db_text_6" type="hidden" value="<?php echo set_value('db_text_6', (isset($db_mediatext[5]->media_id)) ? $db_mediatext[5]->media_id : '0'); ?>" name="db_text_6">
<input id="db_text_7" type="hidden" value="<?php echo set_value('db_text_7', (isset($db_mediatext[6]->media_id)) ? $db_mediatext[6]->media_id : '0'); ?>" name="db_text_7">
<input id="db_text_8" type="hidden" value="<?php echo set_value('db_text_8', (isset($db_mediatext[7]->media_id)) ? $db_mediatext[7]->media_id : '0'); ?>" name="db_text_8">
<input id="db_text_9" type="hidden" value="<?php echo set_value('db_text_9', (isset($db_mediatext[8]->media_id)) ? $db_mediatext[8]->media_id : '0'); ?>" name="db_text_9">
<input id="db_text_10" type="hidden" value="<?php echo set_value('db_text_10', (isset($db_mediatext[9]->media_id)) ? $db_mediatext[9]->media_id : '0'); ?>" name="db_text_10">
<input id="db_text_11" type="hidden" value="<?php echo set_value('db_text_11', (isset($db_mediatext[10]->media_id)) ? $db_mediatext[10]->media_id : '0'); ?>" name="db_text_11">
<input type="hidden" name="jumpbutton1" id="jumpbutton1" value="<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>">
<input type="hidden" name="jumpbutton2" id="jumpbutton2" value="<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>">
<input type="hidden" name="jumpbutton3" id="jumpbutton3" value="<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>">
<input type="hidden" name="jumpbutton4" id="jumpbutton4" value="<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>">
<input id="temp_lays" type="hidden" value="0" name="temp_lays">
<input id="day" type="hidden" value="2" name="day">
<input id="db_media_99" type="hidden" value="0" name="db_media_99">
<input type="hidden" value="" name="my_menu_id">
	<?php echo form_hidden('pid',$pid) ?>
	<?php //echo form_hidden('did',$did) ?>

<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$task->tid) ?>
<?php endif ?>

<?php echo form_close(); ?>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
</script>