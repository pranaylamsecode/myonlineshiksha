<base href="<?php echo $this->config->item('base_url') ?>/public/" />

   <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
   <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/colour_standard.css" type="text/css" media="screen" />

	<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/datetimepicker.css" type="text/css" media="screen" />
<!--lightbox scripts and style
	<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>-->

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

/*$(document).ready(function() {
   $("span.error").each(function() {
   var parent = $(this).closest('dd').attr('sno');
   var get_error = $(this).text();
    if(get_error!= ''){
          $(this).closest('dd').prev('dt').css('background-color', 'red');
     }

  });

});*/

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
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'admin/groups/create', $attributes) : form_open_multipart(base_url().'admin/groups/edit/'.$id, $attributes);
?>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul>
            <li id="toolbar-new" class="listbutton"><a><?php echo form_submit( 'submit', ($updType == 'edit') ? "" : "", (($updType == 'create') ? "id='submit' class='save_btn'" : "id='submit' class='save_btn'")); ?> <br />Save</a>
            </li>
			<li id="toolbar-new" class="listbutton">
            <a href='<?php echo base_url(); ?>admin/groups<?php //echo $quiz->category_id?>/<?php //echo $page?>' class='bforward'><span class="icon-32-cancel"> </span>Cancel </a>
			</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2></div>
	</div>
</div>
<div>
    <h2><?php //echo ($updType == 'create') ? 'Add Groups' : 'Edit Groups'?></h2>
   <?php if($updType != 'edit'){
		$id = '';
		}?>
</div>

<div class="tab-content">
	<!--Main fieldset-->
	<fieldset class="adminform">
     <?php if($updType != 'edit'){ ?>
      	<legend>Add Group</legend>
     <?php }else{ ?>
        <legend>Edit Group</legend>
     <?php } ?>
		<table class="adminform">
		<tbody>
			<tr>
				<td width="15%">
					<p>
						<label class='labelform' for="name"><?php echo lang('web_name')?><span class="required">*</span></label>
					</p>
				</td>
				<td>
					<p>

                     <select name='pid' id='pid'>
                         <option value=''>- select</option>
                		<?php
                		$combocategories = $this->groups_model->get_formatted_combo();
                		foreach ($combocategories as $combocat): ?>
 <option value='<?php echo $combocat->id?>' <?php //echo ($combocat->id==$groups->id)?'disabled':'';?> <?php echo preset_select('pid', $combocat->id, (isset($groups->parent_id)) ? $groups->parent_id : $id  ) ?>><?php echo $combocat->title?></option>
                		<?php endforeach ?>
                	</select>
					</p>
                     <span class="error"><?php echo form_error('pid'); ?></span>
				</td>
			</tr>
            	<tr>
				<td width="15%">
					<p>
						<label class='labelform' for="description">Title<span class="required">*</span></label>
					</p>
				</td>
				<td>
                  <p>
                    <input id='title' type='text' name='title' maxlength='60' value="<?php echo set_value('title', (isset($groups->title)) ? $groups->title : ''); ?>"   />

                 </p>
                    <span class="error"><?php echo form_error('title'); ?></span>
                </td>
			</tr>
             <!-- <div style="float:left; width:330px">
     <input name="from-date" type="text" id="from-datepicker" />
  </div>

  <div style="float:left; width:330px">
     <input name="to-date" type="text" id="to-datepicker" />
  </div>-->

		</tbody>
		</table>
	</fieldset>
</div>
<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$groups->id) ?>
<?php endif ?>

<?php echo form_close(); ?>