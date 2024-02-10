<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style type="text/css">
	.lnr{
		font-size: 16px;
		font-weight: 700;
	}
	.table-responsive tbody tr td button.btn{
		padding: 5px 10px !important;
	}
	#message{
		font-size: 14px !important;
	}
</style>
<div class="main-container">
<?php $CI = & get_instance(); ?>
<div class="settings_page">
	<div id="toolbar-box">
		<div class="m top_main_content">
			<div id="toolbar" class="toolbar-list">
				<ul style="list-style:none; float:right;">
					<li id="toolbar-new" class="listbutton">
					</li>
				</ul>
				<div class="clr"></div>
			</div>
			<span id="message"></span>
			<div class="col-sm-12 pagetitle icon-48-generic" style="padding:0;"><h2><?php echo $heading; ?></h2>
			</div>
		</div>
	</div>
	<div class="tab-content">
		<fieldset class="adminform">
		</fieldset>
	</div>
	<div class="field_container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
				<div class="panel panel-primary primary-border" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title mb_20" style="padding:0;width:100%;">
						</div>
						<div class="panel-heading">
							<div class="panel-title" style="padding:0;width:100%;">
								<ul class="nav nav-tabs bordered grey-border blue-border" id="myTab">
									<li id="tab1">
										<a href="#info" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">Basic Info</span></a>
									</li>
									<li id="tab3">
										<a href="#questions" class="home-page-li-border" data-toggle="tab" ><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Questions</span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="panel-body main-table form-body">
						<div class="tab-content">
							<div style="display: none; text-align: center;" id="loader"><img src="<?php echo base_url(); ?>public/images/loading.gif "></div>
							<div class="tab-pane tab1_tab" id="info">
								<?php 
								echo $CI->load->view('admin/days/info');
								?>
							</div>
							<div class="tab-pane tab3_tab" id="questions">
				  				<?php 
								echo $CI->load->view('admin/days/assignment');
								?>
							</div>
					  	</div>
					</div>
			  	</div>
			</div>
		</div>
	</div>
</div>
</div>
<script src='<?php echo base_url(); ?>public/js/tinymce/tinymce.min.js'></script>
<script type="text/javascript" src="<?php echo base_url('public/js/custom_js/assignment.js'); ?>"></script>
<script>
jQuery(document).ready(function(){
		$(document).find(".tab1_tab, li#tab1").addClass('active');
});
</script>

  <script>
    jQuery(document).ready(function(){
      tinymce.init({
  		selector: '.description',
 		height: 120,
 		// min_width: 400,
 		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen" ],
		toolbar: "eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
		image_title: true,
		automatic_uploads: true,
		images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
		file_picker_types: 'image',
		image_advtab: true,
		file_picker_callback: function(callback, value, meta) {
		      if (meta.filetype == 'image') {
		        $('#upload').trigger('click');
		        $('#upload').on('change', function() {
		          var file = this.files[0];
		          var reader = new FileReader();
		          reader.onload = function(e) {
		            callback(e.target.result, {
		              alt: ''
		            });
		          };
		          reader.readAsDataURL(file);
		        });
		      }
		    },
 		});
    });
</script>