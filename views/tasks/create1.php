<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/theme.css" type="text/css" media="screen" />
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>


<style>
.overlay-imf-pdf {
  position: absolute;
  z-index: 1;
  display: block;
  width: 100%;
  height: 100px;
  background: rgba(8, 8, 8, 0.03);
  cursor: pointer;
}

.abc{
 border: 3px solid #5b9dd9; 
 cursor: pointer;
}
i.fa.fa-check-square {
   position: absolute;   
   left: 91px;
   font-size: 20px;
   color: #5b9dd9;
}

/*form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }*/
#progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
/*#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }*/
#percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>

<style type="text/css">
.img-pop-active {
    -webkit-box-shadow: inset 0 0 0 3px #fff,inset 0 0 0 7px #0073aa;
    box-shadow: inset 0 0 0 3px #fff,inset 0 0 0 7px #0073aa;
} 
.fileinput .btn {
    vertical-align: middle;
}
.btn-file {
    overflow: hidden;
    position: relative;
    vertical-align: middle;
}

.fileinput-exists .fileinput-new, .fileinput-new .fileinput-exists {
    display: none;
}
.btn-file > input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    opacity: 0;
    filter: alpha(opacity=0);
    transform: translate(-300px, 0) scale(4);
    font-size: 23px;
    direction: ltr;
    cursor: pointer;
}
input[type="file"] {
    display: block;
}


.redactor-toolbar{
	top: 0 !important;
}
.modal .form-group .form-control {
    width: 100% !important;
}
.modal-header {
    min-height: 16.43px;
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
}
h4.modal-title {
    font-weight: 500;
}
#before_menu_txt_1, #before_menu_txt_2,  #before_menu_txt_3, #before_menu_txt_4, #before_menu_txt_5, 
#before_menu_txt_6, #before_menu_txt_7, #before_menu_txt_8, #before_menu_txt_9, #before_menu_txt_10, 
#before_menu_txt_11, #before_menu_txt_12, #before_menu_txt_13, #before_menu_txt_14, #before_menu_txt_15, 
#before_menu_txt_16, #before_menu_txt_17, #before_menu_txt_18, #before_menu_txt_19, #before_menu_txt_20,
#before_menu_med_1, #before_menu_med_2, #before_menu_med_3, #before_menu_med_4, #before_menu_med_5, 
#before_menu_med_6, #before_menu_med_7, #before_menu_med_8, #before_menu_med_9, #before_menu_med_10, 
#before_menu_med_11, #before_menu_med_12, #before_menu_med_13, #before_menu_med_14, #before_menu_med_15, 
#before_menu_med_16, #before_menu_med_17, #before_menu_med_18, #before_menu_med_19, #before_menu_med_20
{
  width: 50%;
  float: left;
}
.iframe_cont iframe 
{
width:380px !important;
height: 240px !important;
}
.iframe_cont object
{
width:380px !important;
height: 240px !important;
}
.iframe_cont img 
{
width:380px !important;
height: 240px !important;
}
.table-bordered th, .table-bordered td {

    border: 1px solid #dddddd;
    border-top: 1px solid #dddddd !important;
}
.btn-warning {
  color: #ffffff;
  background-color: #fad839;
  border-color: #fad839;
}
.btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .open .dropdown-toggle.btn-warning {
  color: #ffffff;
  background-color: #f9d011;
  border-color: #f0c706;
}
.btn:hover, .btn:focus{
	  background-position: 0;
}

#sticky.stick {
  position: fixed;
  top: 0;
  z-index: 10000;
  border-radius: 0 0 0 10px;
  right: 0;
  padding: 10px 20px 15px 20px;
  background: rgba(228, 228, 228, 0.86);
  margin-top: 0 !important;
}

div#upload_i {
  padding: 30px 20px 0 20px;
}

div#videoUploader {
  padding-left: 10px;
  padding-top: 10px;
}

.pop-btm-btn{
  width: 280px;
  margin: 0 auto;
  text-align: center;
}

.in-uvr small{
  color: #777777;
}

.in-uvr-txt{
padding-top: 20px;
}

.in-uvr-txt p{
    text-align: center;
    font-size: 12px;
}

div#advancedOptions {
  padding: 20px 30px;
}

.in-uvr input#url_v1 {
  margin: 0 0px !important;
  width: 100% !important;
}

.panel {
  margin-bottom: 17px;
  background-color: #fff;
  border-top: 1px solid #ddd;
  border-radius: 10px;
  border-left: 1px solid #ddd;
  border-right: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}

.panel-body {
  position: relative;
  padding: 40px 0px 20px 0px;
  max-height: initial !important;
  overflow: visible !important;
}

.nav-tabs {
  border-bottom: 1px solid #ddd;
}

.nav-tabs > li {
  margin-bottom: -1px;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
  color: #555555;
  background-color: #ffffff;
  border: 1px solid #ddd;
  border-bottom-color: transparent;
  cursor: default;
}

.nav-tabs, .nav-pills {
  padding-left: 20px;
}

.tab-content {
  overflow: hidden;
}

.tab-content > .active, .pill-content > .active {
  display: block;
  padding: 20px 20px 0;
}

.tab-pane {
  border-right: 1px solid #ddd;
  border-bottom: 0;
  border-left: 1px solid #ddd;
  margin-left: -1px;
  margin-right: -1px;
}

a#disOpt {
    padding-left: 30px;
    font-size: 12px;
}
a#disOpt span.dis1{

  text-decoration: underline;
}

a#disOpt span.dis2{
  color: #000;
  padding-left: 5px;
  text-decoration: none;
}

</style>
<script>
	$(document).ready(
		function()
		{
			//jQuery('#description').redactor();
			$('#lec_content').redactor({
			        focus: true,
			        imageUpload: window.location.origin+'/tasks/getImage',
			        'plugins': ['fontsize','fontcolor','fontfamily','video','imagelink'],
	                
			});

			$('.txt_content').redactor({
			        focus: true,
			        imageUpload: window.location.origin+'/tasks/getImage',
			        'plugins': ['fontsize','fontcolor','fontfamily','video','imagelink'],
	                
			});

		}
	);
</script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />

<!--<script src="<?php echo base_url(); ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<style type="text/css">
.fancybox-custom .fancybox-skin {
	box-shadow: 0 0 50px #222;
}
.error {
	color: red;
	font-size:13px;
}
label {
 width: auto; 
}
legend
{
padding-left: 15px;
font-size:15px;
}
div#before_menu_med_7 {
  float: left;
  width: 50%;
}
</style>

<!--/lightbox scripts and style-->

<script type="text/javascript">



 $(function(){



   $("#forward").click(function() {



   window.parent.location.href = "<?php echo base_url(); ?>days/<?php echo $pid?>";



    });



    	});

</script>
<script type="text/javascript">
  function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});

 function sticky_relocate1() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor1').offset().top;
    if (window_top > div_top) {
        $('#sidebar').addClass('stick');
    } else {
        $('#sidebar').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate1);
    sticky_relocate1();
});
</script>
<?php
$attributes = array('class' => 'tform', 'id' => 'frm_save_lecture');
echo ($updType == 'create') ? form_open(base_url().'tasks/save_lecture', $attributes) : form_open(base_url().'tasks/edit/'.$task->tid.'/'.$did.'/'.$pid, $attributes);
?>

<header>
<section class="breadcrumb">

<div class="container">
  <div class="row">
    <div> <span style="float:left;">
      <h2> <?php echo ($updType == 'create') ? "Create Lecture" : "Edit Lecture";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?> </h2>
      </span> 

      	<div id="sticky-anchor"></div>
		<div id="sticky" style="float:right; margin-top: 10px;"> 
      		<a id="preview_btn" onclick="lecture_preview();" class="btn btn-info" title="Inform about this change made in lecture to all the enrolled students of this course." >Lecture Preview</a>
      		<?php 
				if($updType == 'edit')
				{
			?>
				<a id="inform_btn" class="btn btn-orange" title="Inform about this change made in lecture to all the enrolled students of this course." >Save and Inform</a>

			<?php
					
				} 
				?>	
      		<!-- <a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'") ); ?></a>  -->
      		<a><input type="button" id='submit' class='btn btn-success' value="Save" onclick="save_lecture();" ></a> 
      		<a href='<?php echo base_url(); ?>sections-manage/<?php echo($updType == 'edit') ?  $this->uri->segment(5) : $this->uri->segment(4); ?>/index' class='btn btn-danger' id="forward">Cancel</a> 
        </div> 

     </div>
  </div>
  <script>
  	jQuery(document).ready(
		function()
		{
			jQuery('#inform_txt').hide();
		});

  </script>
 
</div>
</section>
</header>
<div class="clr"></div>
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

			document.getElementById('txt_content_val').value = i;

			document.getElementById('OptlecCont').style.display = 'block';
			//alert(number);
			if(number=='11')
			{	//alert(number);
				document.getElementById('OptlecCont').style.display = 'none';
				document.getElementById('lec_content').style.display = 'none';
				document.getElementById('lecCont').style.display = 'none';
				
			}

			}



			else{



			document.getElementById('layout_img_'+i).style.border = '';



			document.getElementById('layout'+i).style.display = 'none';



			}



			document.getElementById('layout_db').value = number;



			}



			



		function deleteJumpButton(id,sno,lid)



		{

			var  jump_button_id = id;

			var jmp = 'jmp'+sno+'L'+lid;
			var jumpbutton = 'jumpbutton'+sno;
			var jumptitle = 'jumptitle'+sno+'L'+lid;
			var deljmp = 'deljmp'+sno+'L'+lid;
			var jumpanch = 'jump'+sno+'L'+lid;
			var changejumptext = "Add a Jump Button";

        	
			
	        $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>tasks/delete_jumpbutton",
	            data    : {'jump_button_id':jump_button_id},
	 			success: function(data){
	 				
                      
					document.getElementById(jumptitle).innerHTML = changejumptext;
					document.getElementById(jumpbutton).value = 0;
					document.getElementById(jmp).style.backgroundColor = "#FF99FF";
					document.getElementById(deljmp).style.display = 'none';
					document.getElementById(jumpanch).href = "<?php echo base_url(); ?>days/addjumplist/<?php echo $pid;?>/"+sno+"/"+"0";
				}
	 			});		

		}



     $(document).ready(function() {



         $("span.error").each(function() {



         var get_error = $(this).text();



         if (get_error.length > 1) {



                $(this).closest('dd').prev('dt').css('background-color', 'red');







           }



        });







     });



</script>
<style type="text/css">
	table {
  border-collapse: collapse !important;
}
</style>

<div class="clr"></div>

<div class="page-container">
	<div class="main-content">	
		<div class="row">
			<div class="col-sm-12" style="width:100%;">
				<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-body form-horizontal form-groups-bordered" style="padding: 20px 0 0 0;">
					<div class="form-group" id="inform_txt" style="display: none;"> 
						<label for="field-1" class="col-sm-3 control-label"></label> 						
						<div class="col-sm-5">  
							<textarea class="form-control"  style="background-color: cornsilk;" name="inform_msg" id="inform_msg" placeholder="Enter information about modification and Click on Save button."  class="form-control"></textarea>
						</div> 
					</div>

					<ul class="nav nav-tabs bordered" style="padding: 0 0 0 20px;">
				        <!-- available classes "bordered", "right-aligned" -->
				        <li class="active"> 
				        	<a href="#lecture" data-toggle="tab"> 
				            <span class="visible-xs"><i class="entypo-home"></i></span> <span class="hidden-xs">Lecture Detail</span> 
				            </a> 
				        </li>
				       
				        
				        <li> 
				        	<a href="#meta" data-toggle="tab"> 
				        	<span class="visible-xs"><i class="entypo-user"></i></span> <span class="hidden-xs">Meta Tags</span> 
				        	</a> 
				        </li>
				    </ul>
				</div>

				<div class="tab-content">
		        <div class="tab-pane active" id="lecture" style="border:0;">
			        <div class="panel-heading">
						<div class="panel-title" style="padding-bottom: 0px;">	
							<h4 style="margin-top: 10px; margin-left:20px">New Lecture</h4>
						</div> 
					</div>
					<hr style="margin-bottom:0px; margin-top: 0;">

				<div class="panel-body form-horizontal form-groups-bordered"> 

				<div class="form-group"> 
					<label class="col-sm-3 control-label"><?php echo 'Lecture Name:'//echo lang('web_name')?> <span class="required">*</span></label> 

					<div class="col-sm-5"> 
					<input class="form-control" id="name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>"  />
	                      
	                      <!-- tooltip area --> 
	                      
	                      <span class="tooltipcontainer"> <span type="text" id="name-target" class="tooltipicon"></span> <span class="name-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
	                      
	                      <!--tip containt--> 
	                      
	                      <?php echo lang('lecture_fld_name');?> 
	                      
	                      <!--/tip containt--> 
	                      
	                      </span> </span> 
	                      
	                      <!-- tooltip area finish --> 
	                      
	                      <span class="error"><?php echo form_error('name'); ?> </span>
					</div> 
				</div>

		

		<div class="form-group"> 
			<label class="col-sm-3 control-label">Level:<span class="required">*</span></label> 

			<div class="col-sm-5"> 
				<select id="difficultylevel" name="difficultylevel" class="form-control" size="1">
                        <option value="">Select Level</option>
                        <option value="easy" <?php echo preset_select('difficultylevel', 'easy', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Easy</option>
                        <option value="medium" <?php echo preset_select('difficultylevel', 'medium', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Medium</option>
                        <option value="hard" <?php echo preset_select('difficultylevel', 'hard', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Hard</option>
                      </select>
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="difficultylevel-target" class="tooltipicon"></span> <span class="difficultylevel-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_difficultylevel');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish --> 
                      
                      <span class="error"><?php echo form_error('difficultylevel'); ?> </span>
			</div> 
		</div>

		<div class="form-group"> 
			<label class="col-sm-3 control-label"><?=lang('web_active')?></label> 

			<div class="col-sm-5">
			<div class="checkbox"> 
				<label> <input id="published" type="checkbox" name="published" value='1' <?=preset_checkbox('published', '1', (isset($task->published)) ? $task->published : ''  )?> <?php echo ($this->input->post('published')) ? "checked":(isset($task->published) ? "checked":'') ?> <?php echo $updType == 'create' ? 'checked': ''; ?> /></label>
                      <!--<label class='labelforminline' for='active'>
                        <?=lang('web_is_active')?>
                      </label>-->
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="published-target" class="tooltipicon"></span> <span class="published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_published');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish --> 
                      
                      <?php echo form_error('published'); ?>
			</div> 
			</div>
		</div>

		</div>
    
<!-- third  strat-->
<div class="" style="margin-bottom:40px"> 
  <div class="row">
			    <div class="col-sm-3" style="width: 25%;">
			      <div id="sticky-anchor1"></div>
			      <div class="sidebar-nav" id="sidebar">
			       <ul class="nav nav-list "> 
			       	<li class="nav-header"> <i class="fa fa fa-th"></i>&nbsp; Grid System </li>

			        <li class="rows" id="estRows"> 

			        	<div class="lyrow ui-draggable">
				         	<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
			         		<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
			         		<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
			         		
			         		<div class="preview">
			         			<input type="text" value="12" class="form-control">
			         		</div> 
					        <div class="view">
						        <div class="row clearfix">
						        	<div class="col-md-12 column">					        			


						        	</div> 
						        </div> 
					        </div> 
			           	</div> 

			           	<div class="lyrow ui-draggable">
			           		<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
			            	<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a>
			             	<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
			             	
			             	<div class="preview">
			             		<input type="text" value="6 6" class="form-control">
			             	</div>

			             	<div class="view"> 
			             	<div class="row clearfix"> 
			             	<div class="col-md-6 column"></div>
			              	<div class="col-md-6 column"></div> 
			              	</div> 
			              	</div> 
			            </div>

						<div class="lyrow ui-draggable"> 
							<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a>
							<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
							<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
							
							<div class="preview"><input type="text" value="8 4" class="form-control"></div> 
							
							<div class="view"> 
								<div class="row clearfix"> 
									<div class="col-md-8 column"></div> 
								
									<div class="col-md-4 column"></div> 
								</div> 
							</div> 
						</div> 

						<div class="lyrow ui-draggable">
							<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
							<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
							<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
							
							<div class="preview">
								<input type="text" value="4 8" class="form-control">
							</div> 
							<div class="view"> 
								<div class="row clearfix"> 
									<div class="col-md-4 column"></div>
									<div class="col-md-8 column"></div> 
								</div> 
							</div> 
						</div> 

						<div class="lyrow ui-draggable"> 
						<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
						<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
						<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
							<div class="preview"><input type="text" value="3 9" class="form-control"></div> 
							<div class="view"> 
								<div class="row clearfix"> 
								<div class="col-md-3 column"></div> 
								<div class="col-md-9 column"></div> 

								</div> 
							</div> 
						</div>
						
						<div class="lyrow ui-draggable"> 
						<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
						<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
						<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
						<div class="preview"><input type="text" value="9 3" class="form-control"></div> 
							<div class="view"> 
								<div class="row clearfix"> 
								<div class="col-md-9 column"></div> 
								<div class="col-md-3 column"></div> 
								</div> 
							</div> 
						</div>
						
						<div class="lyrow ui-draggable"> 
						<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
						<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
						<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
						<div class="preview"><input type="text" value="4 4 4" class="form-control"></div> 
							<div class="view"> 
								<div class="row clearfix"> 
									<div class="col-md-4 column"></div> 
									<div class="col-md-4 column"></div> 
									<div class="col-md-4 column"></div> 
								</div> 
							</div> 
						</div>
						
						<div class="lyrow ui-draggable"> 
						<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
						<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
						<a href="javascript:void(0)" class="btn btn-info btn-xs clone" onclick="clonele(this.id);"><i class="entypo-docs"></i></a> 
						<div class="preview"><input type="text" value="3 3 3 3" class="form-control"></div> 
							<div class="view"> 
								<div class="row clearfix"> 
									<div class="col-md-3 column"></div> 
									<div class="col-md-3 column"></div> 
									<div class="col-md-3 column"></div> 
									<div class="col-md-3 column"></div> 
								</div> 
							</div> 
						</div>


					</li> 
				</ul> 
				<br>

				<ul class="nav nav-list"> 
					<li class="nav-header"><i class="fa fa-html5"></i>&nbsp;  Html Elements </li> 

					<li class="boxes" id="elmBase"> 
					
						<div class="box box-element ui-draggable" data-type="paragraph">
						  <a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);">
						  	<i class="entypo-cancel"></i>
						  </a> 
						  <a class="drag btn btn-default btn-xs">
						  	<i class="entypo-window"></i>
						  </a>

						   <span class="configuration"> 
						    <!--  <a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#myModal" onclick="openMymodal();"> -->
						     <a class="btn btn-xs btn-warning settings" data-toggle="modal" onclick="openMymodal(this.id);">
						     <i class="fa fa-gear"></i>
						     </a> 
						   </span> 

						   <div class="preview"> 
							   <i class="fa fa-font fa-2x"></i> 
							   <div class="element-desc">Paragraph</div> 
						   </div>

						   <div class="view"> 
						   		<p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> 
						   </div> 
						</div> 

						<div class="box box-element ui-draggable" data-type="image"> 
					   		<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
					   		<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
					   		
					   		<span class="configuration">
					    	<a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalImage(this.id);">
					    	<i class="fa fa-gear"></i></a> 
					    	</span> 
					    
					    	<div class="preview"> 
					    	<i class="fa fa-picture-o fa-2x"></i> 
					    	<div class="element-desc">Image</div> 
					    	</div> 
					    	
					    	<div class="view">
					     	<img src="http://placehold.it/350x150" class="img-responsive" title="default title">
					     	</div> 
					    </div>

					    <div class="box box-element ui-draggable" data-type="button">
							<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a>
							<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
							<span class="configuration"> 
								<a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalbutton();"><i class="fa fa-gear"></i></a> 
							</span>

							<div class="preview"> 
								<i class="fa  fa-hand-pointer-o fa-2x"></i> 
								<div class="element-desc">Button</div>
							</div> 

							<div class="view"> 
								<a class="btn btn-default" href="#">Click Me !</a> 
							</div> 
					    </div> 

						<div class="box box-element ui-draggable" data-type="youtube">
							<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
							<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a>
							<span class="configuration"> 
								<a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalyoutube(this.id);"><i class="fa fa-gear"></i></a>
							</span>
							<div class="preview"> <i class="fa  fa fa-youtube-play  fa-2x"></i> 
								<div class="element-desc">Videos</div> 
							</div> 
							<div class="view"> 
								<iframe class="img-responsive" src="https://www.youtube.com/embed/WIJaD623dy0" frameborder="0" allowfullscreen="" data-url="" width="100%"></iframe> 
							</div> 
						</div> 

						<!-- Vimeo --> 
						<!-- <div class="box box-element ui-draggable" data-type="youtube">
						<a href="#close" class="remove btn btn-danger btn-xs"><i class="entypo-cancel"></i></a> 
						<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
						
						<span class="configuration"> 
							<a class="btn btn-xs btn-warning settings" href="#"><i class="fa fa-gear"></i></a> 
						</span> 
						
						<div class="preview">
						<i class="fa  fa-vimeo-square fa-2x"></i> 
						<div class="element-desc">Vimeo</div> </div> 
						<div class="view"> 
						<iframe class="img-responsive" src="https://player.vimeo.com/video/137463767?byline=0&amp;portrait=0" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" width="100%"></iframe> 
						</div> 
						</div>  -->

						<!--<div class="box box-element ui-draggable" data-type="map"> 
						<a href="#close" class="remove btn btn-danger btn-xs"><i class="entypo-cancel"></i></a> 
						<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a>

						<span class="configuration"> 
							<a class="btn btn-xs btn-warning settings" href="#"><i class="fa fa-gear"></i></a> 
						</span>

						<div class="preview"> <i class="fa  fa-map-o fa-2x"></i> 
						<div class="element-desc">Map</div> 
						</div> 
						<div class="view"> 
						<iframe class="img-responsive" src="http://maps.google.com/maps?q=12.927923,77.627108&amp;z=15&amp;output=embed" frameborder="0" allowfullscreen="" data-url="" width="100%"></iframe> 
						</div> 
						</div>-->

						<div class="box box-element ui-draggable" data-type="code"> 

							<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
							<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
							
							<span class="configuration"> 
								<a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalpdf(this.id);"><i class="fa fa-gear"></i></a> 
							</span> 
							
							<div class="preview">
								<i class="fa fa-file-pdf-o fa-2x"></i> 
								<div class="element-desc">Pdf</div> 
							</div> 

							<div class="view"> 
								<img src="http://placehold.it/350x150" class="img-responsive" title="default title">
							</div> 
						
						</div>

						<div class="box box-element ui-draggable" data-type="code"> 

							<a href="#close" class="remove btn btn-danger btn-xs" onclick="removeele(this.id);"><i class="entypo-cancel"></i></a> 
							<a class="drag btn btn-default btn-xs"><i class="entypo-window"></i></a> 
							
							<span class="configuration"> 
								<a class="btn btn-xs btn-warning settings" data-toggle="modal" href="#" onclick="openmyModalCode(this.id);"><i class="fa fa-gear"></i></a> 
							</span> 
							
							<div class="preview">
								<i class="fa">&lt; &gt;</i> 
								<div class="element-desc">Code</div> 
							</div> 

							<div class="view">i'm html code, change me</div> 
						
						</div>

					

	             	</li> 
	            </ul>
			</div>
    	</div>

	    <div class="col-sm-9" style="width: 75%;">
	      <div id="cart2">   
	         <div class="htmlpage ui-sortable" style="min-height: 480px;">

	         	

	         </div> 
		</div>
	    </div>
  </div>
</div>

<!-- third  end-->

<!-- models start -->
<!-- Modal -->
  

  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<!-- models end -->
        </div>
        

          

        <div class="tab-pane" id="publishing" style="height: 320px;">
          
            <fieldset class="adminform">
              <legend>Publishing</legend>
              <table class="adminform">
                <tbody>
                  <tr>
                    <td valign="top" style="padding-left: 70px;"><label class='labelform'>
                        <?=lang('web_active')?>
                      </label></td>
                    <td width="50%" style="padding-left: 20px;"><input id="published" type="checkbox" name="published" value='1' <?=preset_checkbox('published', '1', (isset($task->published)) ? $task->published : ''  )?> <?php echo ($this->input->post('published')) ? "checked":(isset($task->published) ? "checked":'') ?> <?php echo $updType == 'create' ? 'checked': ''; ?> />
                      <!--<label class='labelforminline' for='active'>
                        <?=lang('web_is_active')?>
                      </label>-->
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="published-target" class="tooltipicon"></span> <span class="published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_published');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish --> 
                      
                      <?php echo form_error('published'); ?></td>
                  </tr>
                 
                </tbody>
              </table>
            </fieldset>
       
        </div>
        
        <div class="tab-pane" id="meta">
         	<div class="panel panel-primary" data-collapsed="0" style="border:0;"> 

				<div class="panel-body form-horizontal form-groups-bordered"> 

					<div class="form-group"> 
						<label class="col-sm-3 control-label"><?php echo 'Title:'//echo lang('web_name')?></label> 

						<div class="col-sm-5"> 

						<input class="form-control" id="title" type="text" name="title" maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : ((isset($task->metatitle)) ? $task->metatitle : ''); ?>"  />
                      
                      <!-- tooltip area --> 
                      
                      <span class="tooltipcontainer"> <span type="text" id="meta_title-target" class="tooltipicon"></span> <span class="meta_title-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                      
                      <!--tip containt--> 
                      
                      <?php echo lang('lecture_fld_meta-title');?> 
                      
                      <!--/tip containt--> 
                      
                      </span> </span> 
                      
                      <!-- tooltip area finish -->

						</div> 
					</div>

					<div class="form-group"> 
						<label class="col-sm-3 control-label"><?php echo 'Keywords:'//echo lang('web_name')?></label> 

						<div class="col-sm-5"> 
						<?php //$this->ckeditor->editor("key_description",($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''));?>
                        <textarea class="form-control" id="key_description"  name="key_description"><?php echo ($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''); ?></textarea>
                        
                        <!-- tooltip area --> 
                        
                        <span class="tooltipcontainer"> <span type="text" id="meta_desc-target" class="tooltipicon"></span> <span class="meta_desc-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                        
                        <!--tip containt--> 
                        
                         <?php echo lang('lecture_fld_meta-keyword');?> 
                        
                        <!--/tip containt--> 
                        
                        </span> </span> 
                        
                        <!-- tooltip area finish --> 

						</div> 
					</div>

					<div class="form-group"> 
						<label class="col-sm-3 control-label"><?php echo 'Description:'//echo lang('web_name')?></label> 

						<div class="col-sm-5">

						 <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''));?>
                        <textarea  class="form-control" id="description"  name="description"><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''); ?></textarea>
                        
                        <!-- tooltip area --> 
                        
                        <span class="tooltipcontainer"> <span type="text" id="meta_keyword-target" class="tooltipicon"></span> <span class="meta_keyword-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
                        
                        <!--tip containt--> 
                         <?php echo lang('lecture_fld_meta-desc');?> 
                      
                        
                        <!--/tip containt--> 
                        
                        </span> </span> 
                        
                        <!-- tooltip area finish --> 

						</div> 
					</div>


				</div>

			</div>


          
         
        </div>        
      </div>

				</div>

			</div>

		</div>

	</div>

</div>

<textarea style="display:none" class="form-control" id="content_lecture"  name="content_lecture"></textarea>

<div style="clear:both;"></div>


<?php echo form_hidden('pid',$pid) ?> <?php echo form_hidden('did',$did) ?>
<?php if ($updType == 'edit'): ?>
<?php echo form_hidden('id',$task->tid) ?>
<?php endif ?>
<?php echo form_close(); ?> 


<!-- ---------------------------------------------Paragraph-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Paragraph</h4>
        </div>
        <div class="modal-body">
          <div > 
          	<div class="col-md-12"> 
          		<div class="form-group">
          		 <input type="hidden" name="txtparagraph" id="txtparagraph" value="">
          		 <input type="hidden" name="tempval" id="tempval" value="">
				  <label for="Paragraph" id="label">Enter Your Text:</label>
				 <!--  <textarea class="form-control paragraphclass" rows="5" id="paragraph"></textarea> -->
				</div>
          	</div>
          </div>
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="setText()">Apply changes</button>
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Paragraph-POP-UP-End----------------------------------------------- -->



<!-- ---------------------------------------------Image-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Image</h4>
        </div>
		<div class="panel-body" style="padding-top: 20px;"> 
    

			<div> 
				<ul class="nav nav-tabs bordered">
					<li class="active" id="image_file"> 
						<a href="#upfil" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-home"></i></span> 
						<span class="hidden-xs">Upload File</span> 
						</a> 
					</li> 
					<li id="image_library"> 
						<a href="#medlib" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-user"></i></span> 
						<span class="hidden-xs">Media Library</span> 
						</a> 
					</li>
					<li id="image_url"> 
						<a href="#medins" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-user"></i></span> 
						<span class="hidden-xs">Insert URL</span> 
						</a> 
					</li>
				</ul> 

				<div class="tab-content">
					<div class="tab-pane active" id="upfil"> 
					 <form id="myForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Image Upload</label> 

							<div class="col-sm-5"> 
								<div class="fileinput fileinput-new" data-provides="fileinput">
									
									<input type="hidden"> 
									
									<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput"> 
									<img src="http://placehold.it/200x150" alt="..." id="imgname" class="img-responsive profile-image"> 
									<img id="blah" src="#" width="125px" height="130px" alt="your image" class="img-responsive profile-image">
									</div> 
									
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div> 

									<div> 
									<!-- <form id="myForm" action="<?php echo base_url(); ?>tasks/upload_image" method="post" enctype="multipart/form-data"> -->
										<span class="btn btn-white btn-file"> 
										<span class="fileinput-new">Select image</span> 
										<span class="fileinput-exists">Change</span> 
										<input type="file" accept="image/*" id="file_i" name="file_i" data-filename-placement="inside"> </span> 
										<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a> 
										<input type="button" id="remove_id" value="Remove" class="btn btn-red" />
										<span id="profineDiv"></span>
									</div> 									
									 
									 <div id="progress">
									        <div id="bar"></div>
									        <div id="percent">0%</div >
									</div>
									<br/>
									 
									<div id="message"></div>

									<!-- new code end here -->
								</div> 

							</div> 

						</div>
						
						<div class="form-group" style="padding-top:20px;">
						<label class="col-sm-3 control-label"></label> 

							<div class="col-sm-5"> 
									<input type="hidden" value="" id="img_div_id" name="img_div_id">
								    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">
									<input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
									<input type="hidden" name="media_type" id="media_type" value="Image" class="form-control">
								<input type="submit" id="submit" class="btn btn-success" value="Upload Image"/>
							</div>

						</div>
						</form>
					</div> 

					<div class="tab-pane" id="medlib"> 
						<div class="col-sm-12" id="row_list" style="height: 175px;overflow: auto;">
						<!-- empty Div row for prepend column start-->
						<div class="row" id="images_list" style="padding: 0 0 10px 0;">
						</div>
						<!-- empty Div row for prepend column end-->
						
						<?php
						$imagecount =0; 
						$counter = 0;
						if($loadImage)
						{
						foreach($loadImage as $key => $imagedata) 
						{ 
							if($counter == 0)
							{	
						?>
						<div class="row" style="padding: 0 0 10px 0;">
						<?php } ?>
						
							
							<div class="col-sm-3">								
								<img src="<?php echo base_url();?>public/uploads/images/<?php echo $imagedata->media_title;?>" alt="<?php echo $imagedata->media_title;?>_<?php echo $imagedata->id;?>"> 
							</div>
									
							<?php
							$counter =1;
							if(($key+1) %4 == 0)
							{
								
							?>								
							</div>
					  <?php	
					  $counter = 0;				
							}
						$imagecount++;
						} 
					}
					else
					{
						echo"Image Not Available";
					} 
						?>
						<!-- </div>	 -->											
							<?php 
						if($imagecount % 4 != 0) 
						{
						?>
							</div>
						<?php
					     }
						?>
						</div>

						<div class="col-sm-12" style="display:block;padding-top: 20px;">
						<form id="save_image_data" name="save_image_data" action="<?php echo base_url(); ?>tasks/update_media_data" method="post" enctype="multipart/form-data">
							<div class="form-group">
							<label class="col-sm-3 control-label">Title</label> 
								<div class="col-sm-5"> 
									<input type="hidden" name="image_id" id="image_id" class="form-control">
									<input type="hidden" name="title_media" id="title_media" class="form-control">
									<input type="text" name="alt_title_image" id="alt_title_image" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label> 

								<div class="col-sm-5"> 
									<input type="submit" id="save_image" class="btn btn-success" value="Save" onclick=""/>
								</div>

							</div>	
							</form>
						</div>

					</div> 

					<div class="tab-pane" id="medins"> 

						<div class="col-sm-12" style="display:block;padding-top: 20px;">

							<div class="form-group">
							<label class="col-sm-3 control-label">Insert Image URL</label> 
								<div class="col-sm-5"> 
									<input type="text" id="txt_image_url" name="txt_image_url" class="form-control">
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-3 control-label"></label> 

								<div class="col-sm-5"> 
									<input type="button" id="submit" class="btn btn-success" value="Save" onclick="addImageUrl()"/>
								</div>

							</div>	

						</div>


					</div> 

				</div> 

			</div>

		</div>
		
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Image-POP-UP-End----------------------------------------------- -->



<!-- ---------------------------------------------Button-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalbutton" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Button</h4>
        </div>
        <div class="modal-body">
          <div> 
          	<div class="col-md-12"> 
          		<div class="form-group">
				  <label for="Paragraph"></label>
				  
				</div>
          	</div>
          </div>     
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges1">Apply changes</button>
        </div>
      </div>
      
    </div>
    
  </div>

<!-- ---------------------------------------------Button-POP-UP-End----------------------------------------------- -->


<!-- ---------------------------------------------Video-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalyoutube" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Videos</h4>
        </div>
		<div class="panel-body" style="padding-top: 20px;"> 
		

			<div> 
				<ul class="nav nav-tabs bordered">
					<li class="active" id="video_file"> 
						<a href="#video-upfil" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-home"></i></span> 
						<span class="hidden-xs">Upload File</span> 
						</a> 
					</li> 
					<li id="video_library"> 
						<a href="#video-medlib" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-user"></i></span> 
						<span class="hidden-xs">Media Library</span> 
						</a> 
					</li>
					<li id="video_url"> 
						<a href="#videoins" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-user"></i></span> 
						<span class="hidden-xs">Insert Videos URL</span> 
						</a> 
					</li>
					<li id="video_url"> 
						<a href="#videoiframe" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-user"></i></span> 
						<span class="hidden-xs">Insert Videos code</span> 
						</a> 
					</li>
					
				</ul> 

				<div class="tab-content">
					<div class="tab-pane active" id="video-upfil"> 
					<form id="videoForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Upload File</label> 

							<div class="col-sm-5"> 
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<input type="hidden" value="" name="..."> 

									<span class="btn btn-info btn-file"> 
										<span class="fileinput-new">Select file</span> 
										<span class="fileinput-exists">Change</span> 
										<input type="file" name="file_i" id="file_i"> 
									</span>

									<div id="progress_video">
									        <div id="bar_video"></div>
									        <div id="percent_video">0%</div >
									</div> 

									<span class="fileinput-filename"></span> 
									<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
								</div> 
							</div>

						</div>
					
						<div class="form-group" style="padding-top:20px;">
						<label class="col-sm-3 control-label"></label> 

							<div class="col-sm-5"> 
									<input type="hidden" value="" id="video_div_id" name="video_div_id">
									<input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">									
									<input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
									<input type="hidden" name="media_type" id="media_type" value="Video" class="form-control">
								<input type="submit" id="submitvideo" class="btn btn-success" value="Save"/>
							</div>

						</div>
					 </form>
					</div> 
					<div class="tab-pane" id="video-medlib"> 
						<div class="col-sm-12" id="video_row_list" style="height: 175px;overflow: auto;">

							<!-- empty Div row for prepend column start-->
						<div class="row" id="video_list" style="padding: 0 0 10px 0;">
						</div>
						<!-- empty Div row for prepend column end-->
						
						<?php
						$videocount =0; 
						$counter = 0;
						if($loadVideo)
						{
						foreach ($loadVideo as $key => $videodata) 
						{ 
							if($counter == 0)
							{	
						?>
						<div class="row" style="padding: 0 0 10px 0;">
						<?php } ?>
						
							
							<div class="col-sm-3">	
							<video width="125" height="100" controls="" alt="<?php echo $videodata->media_title;?>#_#<?php echo $videodata->id;?>">
 						 		<source src="<?php echo base_url(); ?>public/uploads/videos/<?php echo $videodata->media_title;?>" type="video/mp4">
  								<source src="movie.ogg" type="video/ogg">  
							</video>							
								
							</div>
									
							<?php
							$counter =1;
							if(($key+1) %4 == 0)
							{
								
							?>								
							</div>
					  <?php	
					  $counter = 0;				
							}
							$videocount++;
						}
					}
					else
					{
						echo"Videos Not Available";
					}  
						?>
						<!-- </div> -->
						<?php 
						if($videocount % 4 != 0) 
						{
						?>
							</div>
						<?php
					     }
						?>
													
							
						</div>

						<div class="col-sm-12" style="display:block;padding-top: 20px;">
						<form id="save_video_data" name="save_video_data" action="<?php echo base_url(); ?>tasks/update_video_data" method="post" enctype="multipart/form-data">
							<div class="form-group">
							<label class="col-sm-3 control-label">Title</label> 
								<div class="col-sm-5">			

									<input type="hidden" name="video_id" id="video_id" class="form-control">
									<input type="hidden" name="title_video" id="title_video" class="form-control">
									<input type="text" name="alt_title_video" id="alt_title_video" class="form-control">

								</div>
							</div>						


							<div class="form-group">
								<label class="col-sm-3 control-label"></label> 

								<div class="col-sm-5"> 
									<input type="submit"  class="btn btn-success" value="Save" />
								</div>

							</div>	
							</form>
						</div>


					</div> 

					<div class="tab-pane" id="videoins"> 

						<div class="col-sm-12" style="display:block;padding-top: 20px;">

							<div class="form-group">
							<label class="col-sm-3 control-label">Insert Videos URL</label> 
								<div class="col-sm-5"> 
									<input type="text" class="form-control" id="txt_video_url">
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-3 control-label"></label> 

								<div class="col-sm-5"> 
									<input type="button" id="videourl" class="btn btn-success" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
								</div>

							</div>	

						</div>


					</div> 

					<div class="tab-pane" id="videoiframe"> 

						<div class="col-sm-12" style="display:block;padding-top: 20px;">

							<div class="form-group">
							<label class="col-sm-3 control-label">Insert Videos code</label> 
								<div class="col-sm-5"> 
									<!-- <input type="text" class="form-control" id="txt_video_embed"> -->
									<textarea class="form-control" id="txt_video_embed" rows="3"></textarea>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-3 control-label"></label> 

								<div class="col-sm-5"> 
									<input type="button" id="videoembed" class="btn btn-success" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
								</div>

							</div>	

						</div>


					</div>

				</div> 

			</div>

		</div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Video-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------PDF-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalpdf" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PDF</h4>
        </div>
		<div class="panel-body" style="padding-top: 20px;"> 


			<div> 
				<ul class="nav nav-tabs bordered">
					<li class="active" id="pdf_file"> 
						<a href="#pdf-upfil" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-home"></i></span> 
						<span class="hidden-xs">Upload File</span> 
						</a> 
					</li> 
					<li id="pdf_library"> 
						<a href="#pdf-medlib" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-user"></i></span> 
						<span class="hidden-xs">Media Library</span> 
						</a> 
					</li>
					<li> 
						<a href="#pdfins" data-toggle="tab"> 
						<span class="visible-xs"><i class="entypo-user"></i></span> 
						<span class="hidden-xs">Insert PDF URL</span> 
						</a> 
					</li>
				</ul> 

				<div class="tab-content">
					<div class="tab-pane active" id="pdf-upfil"> 
					<form id="pdfForm" action="<?php echo base_url(); ?>tasks/upload_media" method="post" enctype="multipart/form-data">
						<div class="form-group"> 
							<label class="col-sm-3 control-label">Upload File</label> 

							<div class="col-sm-5"> 
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<input type="hidden" value="" name="..."> 

									<span class="btn btn-info btn-file"> 
										<span class="fileinput-new">Select file</span> 
										<span class="fileinput-exists">Change</span> 
										<input type="file" name="file_i" id="file_i"> 
									</span> 

									<div id="progress_pdf">
									        <div id="bar_pdf"></div>
									        <div id="percent_pdf">0%</div >
									</div>

									<span class="fileinput-filename"></span> 
									<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
								</div> 
							</div>

						</div>

						<div class="form-group" style="padding-top:20px;">
						<label class="col-sm-3 control-label"></label> 

							<div class="col-sm-5"> 
									<input type="hidden" value="" id="pdf_div_id" name="pdf_div_id">
									<input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">									
									<input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
									<input type="hidden" name="media_type" id="media_type" value="Document" class="form-control">
								<input type="submit" id="submitPDF" class="btn btn-success" value="Upload"/>
							</div>

						</div>
					</form>
					</div> 

					<div class="tab-pane" id="pdf-medlib"> 
						<div class="col-sm-12" id="pdf_row_list" style="height: 175px;overflow: auto;">

							<!-- empty Div row for prepend column start-->
						<div class="row" id="pdf_list" style="padding: 0 0 10px 0;">
						</div>
						<!-- empty Div row for prepend column end-->
						
						<?php 
						$divcount =0;
						$counter = 0;
						if($loadPdf)
						{
						foreach ($loadPdf as $key => $pdfdata) 
						{ 
							if($counter == 0)
							{	
						?>
						<div class="row" style="padding: 0 0 10px 0;">
						<?php } ?>
						
							
							<div class="col-sm-3">	
							<!-- <video width="125" height="100" controls="" alt="<?php echo $videodata->media_title;?>#_#<?php echo $videodata->id;?>">
 						 		<source src="<?php echo base_url(); ?>public/uploads/videos/<?php echo $videodata->media_title;?>" type="video/mp4">
  								<source src="movie.ogg" type="video/ogg">  
							</video> -->
							<div class="overlay-imf-pdf" alt="<?php echo $pdfdata->media_title;?>#_#<?php echo $pdfdata->id;?>"></div>
							<iframe src="http://docs.google.com/viewer?url=<?php echo base_url(); ?>public/uploads/documents/<?php echo $pdfdata->media_title;?>&amp;embedded=true" width="125" height="100" frameborder="0" disableprint="true" alt="<?php echo $pdfdata->media_title;?>#_#<?php echo $pdfdata->id;?>" style="background:white">myDocument</iframe>							
								
							</div>
									
							<?php
							$counter =1;
							if(($key+1) %4 == 0)
							{
								
							?>								
							</div>
					  <?php	
					  $counter = 0;				
							}
							$divcount++;
						}
					}
					else
					{
						echo"Documents Not Available";
					}  

						?>
						<?php 
						if($divcount % 4 != 0) 
						{
						?>
							</div>
						<?php
					     }
						?>
						


							
						</div>

						<div class="col-sm-12" style="display:block;padding-top: 20px;">

							<form id="save_pdf_data" name="save_pdf_data" action="<?php echo base_url(); ?>tasks/update_pdf_data" method="post" enctype="multipart/form-data">
							<div class="form-group">
							<label class="col-sm-3 control-label">Title</label> 
								<div class="col-sm-5">			

									<input type="hidden" name="pdf_id" id="pdf_id" class="form-control">
									<input type="hidden" name="title_pdf" id="title_pdf" class="form-control">
									<input type="text" name="alt_title_pdf" id="alt_title_pdf" class="form-control">

								</div>
							</div>
							

							<div class="form-group">
								<label class="col-sm-3 control-label"></label> 

								<div class="col-sm-5"> 
									<input type="submit" class="btn btn-success" value="Save"/>
								</div>

							</div>	
						</form>
						</div>


					</div> 

					<div class="tab-pane" id="pdfins"> 

						<div class="col-sm-12" style="display:block;padding-top: 20px;">

							<div class="form-group">
							<label class="col-sm-3 control-label">Insert Image URL</label> 
								<div class="col-sm-5"> 
									<input type="text" id="txt_pdf_url" class="form-control">
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-3 control-label"></label> 

								<div class="col-sm-5"> 
									<input type="button" class="btn btn-success" value="Save" onclick="addPdfUrl()"/>
								</div>

							</div>	

						</div>


					</div>

				</div> 

			</div>

		</div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- ---------------------------------------------PDF-POP-UP-End----------------------------------------------- -->
<!-- ---------------------------------------------Code-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalCode" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Code</h4>
        </div>
        <div class="modal-body">
          <div > 
          	<div class="col-md-12"> 
          		<div class="form-group">
          		 <input type="hidden" name="txtcode" id="txtcode" value="">
          		 <input type="hidden" name="tempvalforcode" id="tempvalforcode" value="">
				  <label for="Paragraph" id="label">Enter Your Code:</label>
				  <textarea class="form-control paragraphclass" rows="5" id="codearea"></textarea>
				</div>
          	</div>
          </div>
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="setCode()">Apply changes</button>
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Code-POP-UP-End----------------------------------------------- -->

<script type="text/javascript">

	jQuery('#inform_btn').click(function() {

		jQuery('#inform_txt').toggle();
	});



 jQuery('#OptlecCont').on('click', function() {

  jQuery('#lecCont').toggle();
 });

</script>


<!-- tool tip script --> 

<script type="text/javascript">



$(document).ready(function(){

	$('.tooltipicon').click(function(){

	var dispdiv = $(this).attr('id');

	$('.'+dispdiv).css('display','inline-block');

	});

	$('.closetooltip').click(function(){

	$(this).parent().css('display','none');

	});

	});

	</script> 

<!-- tool tip script finish -->

<script>
function lecture_preview_old()
{		
	   	 var txt_content_val = $("#txt_content_val").val();		   	  
	   	 var lec_content = $("#lec_content").val();

	   	 var lec_content1 = $("#lec_content1").val();

	     

	     var first_media = $("#layout"+txt_content_val).find(".parent_layout"+txt_content_val).html();
	     var txt_content = $("#txt_content"+txt_content_val).val();
	     
	     if(first_media)
	     {	     
	    // alert(first_media);
	     }
	     else
	     {
	     	 first_media = "";
	     }

	     var second_media = $("#layout"+txt_content_val).find(".parent_layout"+txt_content_val+"_1").html();
	     if(second_media)
	     {		     
		 	 
	 	 }
	 	 else
	 	 {
	 	    second_media ="";
	 	 }	
	     

	     if(txt_content)
	     {	     
	     //alert(txt_content);
	     }
	     else
	     {
	      txt_content ="";	
	     }
	     if(lec_content)
	     {	     
	     //alert(txt_content);
	     }
	     else
	     {
	      lec_content ="";	
	     }

	     $.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>tasks/set_lecture_preview",
			data: {first_media:first_media,second_media:second_media,txt_content:txt_content,txt_content_val:txt_content_val,lec_content:lec_content,lec_content1:lec_content1}, 
			success: function(data)
			{
			
				//alert(data);
				//document.location.href ='<?php echo base_url(); ?>tasks/lecture_preview';
				//window.open(<?php echo base_url(); ?>/tasks/lecture_preview','_blank');
				window.open('<?php echo base_url(); ?>tasks/lecture_preview', '_blank');
			}
		  }); 
	     

}
</script>
<!-- new code here -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <style>
  ul { /*list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px;*/ }
 li { /*margin: 5px; padding: 5px; width: 150px; */}
  </style>
<!-- new code end here -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>


<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="<?php echo base_url()?>public/js/lectureeditor.js"></script>
<script>
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
var $j =jQuery.noConflict();
function lecture_preview()
{		
	   	 var txt_content_val = $j("#txt_content_val").val();		   	  
	   	 var lec_content = $j("#lec_content").val();
	   	 var lec_content1 = $j("#lec_content1").val();	     

	     var first_media = $j("#layout"+txt_content_val).find(".parent_layout"+txt_content_val).html();
	     var txt_content = $j("#txt_content"+txt_content_val).val();	     

	     var second_media = $j("#layout"+txt_content_val).find(".parent_layout"+txt_content_val+"_1").html();
	   
	     //$j.session.set('preview1', JSON.stringify({layoutno:txt_content_val})); 
	      $j.session.set('preview1', JSON.stringify({media1: first_media,media2: second_media,txt_area:txt_content,txt_data:lec_content,txt_data1:lec_content1,layoutno:txt_content_val})); 
	        
	      var obj = JSON.parse($j.session.get('preview1'))	          	
				
	     window.open('<?php echo base_url(); ?>tasks/lecture_preview/'+txt_content_val, '_blank');	     

}


  


// new code start here

$j(function() {
    $j(".htmlpage").sortable({
      revert: true
    });
    $j(".lyrow").draggable({
      connectToSortable: ".htmlpage",     
      revert: "invalid",
      stop: function( event, ui ) {

      	 $j("#cart2 .column").sortable({   	
      	 		revert: true,
      	 		zIndex: 9999
    		 }); 			
    			
      	 $j(".htmlpage >.lyrow").removeAttr("style");
      		
		  var auto_inc_id = 1; 
				$('.htmlpage .lyrow ').each(function(){ 
				    $(this).attr('id', 'lyrow_'+auto_inc_id); 				    
				    auto_inc_id++; 				
				});	

			var idforremove = 1; 
				$('.htmlpage .lyrow .remove').each(function(){ 
				    $(this).attr('id', 'remove_'+idforremove);				   
				    idforremove++; 				
				});	

			var idfordrag = 1; 
				$('.htmlpage .lyrow .drag').each(function(){ 
				    $(this).attr('id', 'drag_'+idfordrag); 				   
				    idfordrag++; 				
				});

			var idforclone = 1; 
			$('.htmlpage .lyrow .clone').each(function(){ 
			    $(this).attr('id', 'clone_'+idforclone); 			    
			    idforclone++; 				
			});

      },      
      opacity: 0.7,
      helper:'clone',
      //handle: "a .drag",
    });
   
    $j( "#cart2 ol" ).disableSelection();
  });


$j(function() {
    $j(".htmlpage .lyrow .column").sortable({   
      revert: true,
      zIndex: 9999
    });
    $j(".box").draggable({
      connectToSortable: ".htmlpage .lyrow .column",      
      revert: "invalid",
      stop: function( event, ui ) {

      	var idforremove = 1; 
				$('.htmlpage .lyrow .column .remove').each(function(){ 
				    $(this).attr('id', 'removeinner_'+idforremove); 				    
				    idforremove++; 				
				});	

			var idfordrag = 1; 
				$('.htmlpage .lyrow .drag').each(function(){ 
				    $(this).attr('id', 'drag_'+idfordrag); 				    
				    idfordrag++; 				
				});

				var idforsetting = 1; 
				$('.htmlpage .lyrow .settings').each(function(){ 
				    $(this).attr('id', 'settings_'+idforsetting); 				   
				    idforsetting++; 				
				});

				var idforcolumn = 1; 
				$('.htmlpage .lyrow .column').each(function(){ 
				    $(this).attr('id', 'column_'+idforcolumn);				   
				    idforcolumn++; 				
				});

				var idforview = 1; 
				$('.htmlpage .lyrow .column .view').each(function(){ 
				    $(this).attr('id', 'view_'+idforview);				   
				    idforview++; 				
				});

				var idforbox = 1; 
				$('.htmlpage .lyrow .column .box').each(function(){ 
				    $(this).attr('id', 'box_'+idforbox);				   
				    idforbox++; 				
				});


      	
      },      
      helper:'clone'
    });
    $j( "ul, li" ).disableSelection();
  });
//new code end here

//new code for Image Upload start


    

//new code for Image Upload End

//new code for Save Image Details Start



</script>
<script>
function save_lecture()
{
	var seg3 ="<?php echo $this->uri->segment(3) ?>";
	var seg4 ="<?php echo $this->uri->segment(4) ?>";

	var contenthtml = $(".htmlpage").html();
	$("#content_lecture").val(contenthtml);

    jQuery.ajax({

        type: "POST",
        url: " <?php echo base_url()?>tasks/save_lecture/"+seg3+"/"+seg4,//<?php echo base_url('tasks/save_lecture/')?>",
        data: jQuery("#frm_save_lecture").serialize(),
       //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
        success: function(msg)
        {    
            alert(msg); 
            
        }
    });
}
</script>

<script type="text/javascript">
       

jQuery(document).ready(function()
               {
        jQuery('#myModal').css('display','none');
        jQuery('#myModalImage').css('display','none');
        jQuery('#myModalpdf').css('display','none');
        jQuery('#myModalyoutube').css('display','none');
        jQuery('#myModalbutton').css('display','none'); 
        jQuery('#myModalCode').css('display','none');       
		   });

// paragraph code start here

 function openMymodal(id)
 {	    
 			var value =id.split('_');

 		jQuery("#txtparagraph").val(value[1]); 		
 		var txtpara = value[1];
 		var paragh = jQuery(".column #view_"+txtpara).html(); 		

 		jQuery("#paragraph").remove();
 		jQuery(".redactor-box").remove();

 		jQuery("#label").append("<textarea class='form-control paragraphclass' rows='5' id='paragraph'></textarea>");
 		
 		jQuery("textarea#paragraph").val(paragh); 		
 		 var tempvalue = jQuery("#tempval").val(); 		 
 		
	  jQuery('#paragraph').redactor();            
	 		 
    

 	  jQuery('#myModal').modal("show");
 	  jQuery('#myModalImage').css('display','none');
 	  jQuery('#myModalpdf').css('display','none');
 	  jQuery('#myModalyoutube').css('display','none');
 	  jQuery('#myModalbutton').css('display','none');
 	  jQuery('#myModalCode').css('display','none');

 	  
 }

 function setText()
	{		

 		var txtpara = jQuery("#txtparagraph").val();
 		var txt = jQuery("textarea#paragraph").val(); 		
 		jQuery(".column #view_"+txtpara).html(txt);	
 		jQuery('#myModal').modal("hide");
 		
	}

// paragraph code end here

  function openmyModalImage(id)
 { 	
 	    var value =id.split('_');
 		jQuery("#img_div_id").val(value[1]); 	
 	 
 	  jQuery('#myModalImage').modal("show");
 	  jQuery('#myModal').css('display','none');
 	  jQuery('#myModalpdf').css('display','none');
 	  jQuery('#myModalyoutube').css('display','none');
 	  jQuery('#myModalbutton').css('display','none');
 	  jQuery('#myModalCode').css('display','none');
 }
  function openmyModalpdf(id)
 { 	
 		var value =id.split('_');
 		jQuery("#pdf_div_id").val(value[1]);

 	  jQuery('#myModalpdf').modal("show");
 	  jQuery('#myModal').css('display','none'); 
 	  jQuery('#myModalImage').css('display','none'); 	 
 	  jQuery('#myModalyoutube').css('display','none');
 	  jQuery('#myModalbutton').css('display','none');
 	  jQuery('#myModalCode').css('display','none');
 }
  function openmyModalyoutube(id)
 { 	
 	 var value =id.split('_');
 		jQuery("#video_div_id").val(value[1]); 

 	  jQuery('#myModalyoutube').modal("show");
 	  jQuery('#myModal').css('display','none');
 	  jQuery('#myModalImage').css('display','none');
 	  jQuery('#myModalpdf').css('display','none'); 	 
 	  jQuery('#myModalbutton').css('display','none');
 	  jQuery('#myModalCode').css('display','none');
 }
  function openmyModalbutton()
 { 	
 	  jQuery('#myModalbutton').modal("show");
 	  jQuery('#myModal').css('display','none');
 	  jQuery('#myModalImage').css('display','none');
 	  jQuery('#myModalpdf').css('display','none');
 	  jQuery('#myModalyoutube').css('display','none');
 	  jQuery('#myModalCode').css('display','none');
 	  
 	  
 }

</script>

<script>
 function removeele(id)
 {
 	var str = id;
 	var str_array = str.split('_');
 	
 	if(str_array[0] =="remove")
 	{ 
 		
 		var x = confirm("Are you sure you want to Remove?");
		if (x == true)
		{	
			$('#'+id).parent().remove();
 			//jQuery('#lyrow_'+str_array[1]).remove();

 	    }
 	}

 	if(str_array[0] =="removeinner")
 	{	
 		
 		var x = confirm("Are you sure you want to Remove?");
		if (x == true)
		{	
			$('#'+id).parent().remove();
 			//jQuery('#box_'+str_array[1]).remove();

 	    }
 	}
 }
</script>

<script type="text/javascript">
function openmyModalCode(id)
 {	    
 			var value =id.split('_');

 		jQuery("#txtcode").val(value[1]); 		
 		var txtpara = value[1];
 		var paragh = jQuery(".column #view_"+txtpara).html(); 		

 		//jQuery("#paragraph").remove();
 		//jQuery(".redactor-box").remove();

 		//jQuery("#label").append("<textarea class='form-control paragraphclass' rows='5' id='paragraph'></textarea>");
 		
 		jQuery("textarea#codearea").val(paragh); 		
 		 var tempvalue = jQuery("#tempvalforcode").val(); 		 
 		
	  //jQuery('#paragraph').redactor();            
	 		 
    
	  jQuery('#myModalCode').modal("show");
 	  jQuery('#myModal').css('display','none');
 	  jQuery('#myModalImage').css('display','none');
 	  jQuery('#myModalpdf').css('display','none');
 	  jQuery('#myModalyoutube').css('display','none');
 	  jQuery('#myModalbutton').css('display','none');

 	  
 }

 function setCode()
	{		

 		var txtpara = jQuery("#txtcode").val();
 		var txt = jQuery("textarea#codearea").val(); 		
 		jQuery(".column #view_"+txtpara).html(txt);	
 		jQuery('#myModalCode').modal("hide");
 		
	}
</script>

