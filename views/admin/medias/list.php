<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/tour/css/jquerytour.css" />
<link rel="stylesheet" type="text/css" href="public/css/courses_css/courses_form.css"> 
<script src="<?php echo base_url(); ?>public/tour/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/tour/js/ChunkFive_400.font.js" type="text/javascript"></script>
<?php
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
  $first = $start + 1;
  $u_data=$this->session->userdata('loggedin');
  $maccessarr=$this->session->userdata('maccessarr');
?>
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
.panel{
  background-color: transparent;
}
.main-table {
   padding: 0!important;
}
.panel-body {
   
    padding: 0!important;
}
.fancybox-custom .fancybox-skin {
    box-shadow: 0 0 50px #222;
}


	#main-nav > ul {
    	list-style-type: none;
    	padding: 0;
    	/*border: 1px solid #999;*/
    	position: absolute;
    	bottom: 10%;
    }
    
    #main-nav > ul  > li {
    	float: left;
    	background-color: #000;
    }
    
    .main-nav-sub {
    	list-style-type: none;
    	padding: 0;
    	margin: 0;
    }
    /*
    #main-nav > ul  > li+li {
    	border-left: 1px solid #999;
    }
    
    .main-nav-sub > li  {
    	border-bottom: 1px solid #999;
    	border-right: 1px solid #999;
    	border-left: 1px solid #999;
    	background-color: #000;
    }
    
    .main-nav-sub > li:first-child {
    	border-top: 1px solid #999;
    }*/
   .nav-tabs>li.active>a span {
    color: #fff !important;
}
/* .nav-tabs>li a span {
    color: #000!important;
    font-weight: 600;
}*/
    #main-nav > ul > li > a,
    .main-nav-sub > li > a {
    	text-decoration: none;
    	white-space: nowrap;
    	display: block;
    	color: #fff;
    	font-family: verdana, sans-serif;
    	font-size: .8em;
    	font-weight: bold;
    	padding: 10px 20px;
    }
    
    #main-nav > ul > li:hover > a {
    	color: #000;
    	background-color: #fff;
    }
    
  
    
    /* NOTE: THIS IS WHERE THE DROP-DOWN BECOMES A DROP-UP */
    .main-nav-sub {
    	position: absolute;
    	bottom: 100%;
    	z-index: -999;
    	opacity: 0;
    		filter: alpha(opacity=0); /* IE older versions */
    		zoom: 1;  /* IE older versions */
    		right: 0px;
    }
    
    #main-nav > ul > li:hover > .main-nav-sub {
    	z-index: 100;
    	opacity: 1;
    	    filter: alpha(opacity=100); /* IE older versions */
        	zoom: 1;  /* IE older versions */
    	
    	-webkit-transition: all .5s ease-in;
    	-moz-transition: all .5s ease-in;
    	-ms-transition: all .5s ease-in;
    	-o-transition: all .5s ease-in;
    	transition: all .5s ease-in;
    }
/*css*/
    .jconfirm .jconfirm-box div.title {
      background: transparent;
      font-size: 18px;
      font-weight: 600;
      font-family: inherit;
      padding: 10px 15px 10px;
      
      display: block;
      color: #c42140;
      text-transform: uppercase;
      font-size: 21px!important;
      font-weight: bold;
      text-align: center!important;
      padding: 17px 30px 0 13px !important;
      border-bottom: 0px!important;
      margin-top: 0px!important;
      background-color: #f1f1f1!important;
      height: 73px!important;
    }
    .jconfirm .jconfirm-box div.content {
      padding: 0px;
      
      font-size: 15px;
      margin: 4% 0px 2%;
      font-weight: bold!important;
    }
    button.btn.btn-success {
      background-color: #04A600!important;
    }
    .nav-tabs > li.active a {
    background-color: #2c7be5 !important;
    border-color: #2c7be5!important;
    color:#fff!important;
}
</style>
<?php
	 $CI = & get_instance();
	 $CI->load->model('admin/programs_model');
  ?>

<span id="message"></span>
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
     
    <div class="pagetitle icon-48-generic"><h2><?php echo 'Media Library';?></h2>
     <h6 class="pmaintitle main_subtitle">Manage your course media here. Add any type of media, including Video, Audio, PDF, Documents, Text which can be inserted into your lectures.</h6></div>
		<div id="toolbar" class="toolbar-list">
<?php
if(($u_data['groupid']=='4')  || ($maccessarr['media']=='own'))
{
?>
  <div id="sticky-anchor"></div>
	<ul id="sticky" style="list-style: none; float: right;">
		<li id="toolbar-new" class="listbutton">
      <a href="<?= base_url();?>admin/medias/create/" onclick="Joomla.submitbutton('edit')" class="btn ">
        <i class="entypo entypo-popup"></i>
         <span class="icon-32-new">
      </span>
  			Add New
  			</a>
        <a href="<?php echo base_url(); ?>admin/media-categories/" class="btn">
          <i class="entypo entypo-popup"></i>
        <span class="icon-32-new">
      </span>
        Media Category
      </a>
		</li>
	</ul>
<?php } ?>
		
		</div>
   </div>
</div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/medias',$attributes);
?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="top-head-box">
    <div id="table-3_length">
    <span >
   		 <input class="form-control form-height" type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" placeholder="Title" name="search_text">
    </span>
    <span >
       	<select  name="catid" size="1" class="form-control form-height" onchange="document.topform1.submit()">
      <option value="">Category</option>
      <?php
      foreach ($categories as $category): ?>
      <option value='<?php echo $category->id?>'><?php echo $category->name;?></option>
     <?php endforeach ?>
     </select>
    </span>
    <span >
    <select onchange="document.topform1.submit()" size="1" name="type" id="type" class="form-height form-control">
      <option value="">Media Type</option>
            <?php foreach($mediatype as $type){ ?>
            <option value="<?php echo $type->name;?>"><?php echo $type->title;?></option>
            <?php } ?>
    </select>
      </span>
      <span>
          <button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier" ></span></button>
      </span>
    </div>
  </div>
<?php echo form_close(); ?>

<div class="card">
<div class="panel panel-primary primary-border" data-collapsed="0">
  <div class="panel-heading">
    <div class="panel-title" style="padding:0;width:100%;">
      <ul class="nav nav-tabs" id="myTab">
      <li id="tab1" class="active"><a href="#general" class="home-page-li-border" data-toggle="tab"><span class="visible-xs"><i class="entypo-home"></i></span><span class="hidden-xs">General</span></a></li> 

      <li id="tab2"> <a href="#homepagesettings" class="home-page-li-border" data-toggle="tab" onclick="getallvdos();"><span class="visible-xs"><i class="entypo-user"></i></span><span class="hidden-xs">Lecture Videos</span></a></li>
      </ul>
    </div>
  </div>
  <div class="panel-body main-table form-body" style="padding: 0!important;">
    <div class="tab-content">
      <div class="tab-pane tab1_tab active" id="general">
        <!-- <div class="panel-body main-table form-body"> -->

<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
<thead>
    <tr role="row">
        <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Title</div></th>
        
        <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Media Type</div></th>
        
       <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Category</div></th>

       
       <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Published</div></th>
        
        <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Options</div></th>
        
     </tr>
</thead>
<?php
if ($medias): ?>	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;
      $iii = 0; foreach ($medias as $media): ?>

<tr class="camp<?php echo $i;?>">
			<td class="field-title">
				<?php echo $media->alt_title?>
            </td>
            <td class="field-title">
	   		<?php 
	   			 $filename = $media->media_title;
   				 $ext = pathinfo($filename, PATHINFO_EXTENSION);
   				$file_name = strtolower($ext);
   				$file_img = array
   							(
   							'jpg' => 'jpg-icon.png',
   							'jpeg'=> 'jpeg-icon.png',
   							'png' => 'png-icon.png',
   							'bmp' => 'bmp-icon.png',
   							'gif' => 'gif-icon.png',
   							'mp4' => 'mp4-icon.png',
   							'avi' => 'avi-icon.png',
   							'mpeg'=> 'mpeg-icon.png',
   							'mp3' => 'mp3-icon.png',
   							'swf' => 'swf-icon.png',
   							'rar' => 'rar-icon.png',
   							'zip' => 'zip-icon.png',
   							'doc' => 'doc-icon.png',
   							'docx' => 'docx-icon.png',
   							'ppt' => 'ppt-icon.png',
   							'pptx' => 'pptx-icon.png',
   							'txt' => 'txt-icon.png',
   							'pdf' => 'pdf-icon.png'
   							);
   				
   							if (array_key_exists($file_name,$file_img))
							  {
							  echo '<img src="'.base_url().'public/css/image/'.$file_img[$file_name].'" alt="File type">';
							  }
	   			 ?>
			</td>
			<td class="field-title">
        <?php
         echo $media->catname;
        ?>
      </td> 
      <td class="pub">
        <?php
        if(($u_data['groupid']=='4') || ($maccessarr['media']=='modify_all') || ($maccessarr['media']=='own'))
        {
        ?>
		<?php if($media->publish){?>	
    <a title="Click to unpublish media" type="button" onclick="return change_Status(<?= $media->id.",".$media->publish;?>)"><div class="sprite 9999published" style="background-position: -340px 0;"></div></a>
    <?php }else{?>
    <a title="Click to publish media" type="button" onclick="return change_Status(<?= $media->id.",".$media->publish;?>)"><div class="sprite 999publish" style=" background-position: -308px 0;"></div></a>
		<?php }?>
<?php
}
else
echo "No Access";
?>
    </td>
			<td class="editdelete">
            <?php
if(($u_data['groupid']=='4') || ($maccessarr['media']=='modify_all') || ($maccessarr['media']=='own'))
{
?>
       <a class='pre_pop' href="<?php echo base_url(); ?>admin/medias/preview/<?php echo $media->type;?>/<?php echo $media ->id?>"><div class='sprite 5preview' style="background-position: -120px 0; height: 14px;" title="Preview"></div></a>
        <a class='' href='<?php echo base_url(); ?>admin/medias/edit/<?php echo $media->id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Edit media"></div></a>
<?php
}
if(($u_data['groupid']=='4') || ($maccessarr['media']=='own'))
{
?>
   <a class='' onClick="return deleteconfirm(<?php echo $media->id?>);" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
   <?php $mediarel_id = $this->medias_model->getmediarelProgram($media->id); ?>
   <input type="hidden" value="<?php echo $mediarel_id ? '1':'0'; ?>" id="id_<?php echo $media->id?>">
<?php
}
else
echo "No Access";
?>
			</td>
		</tr>
        <?php $iii++; endforeach ?>
<?php else: ?>
           <tr><td colspan="7">
		          <p class='text'>No media created yet.</p>
		      </td>
              </tr>
             <?php endif ?>
 </tbody>
</table>
<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row pagination">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countusers; ?> entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>
<?php } ?>
</div><!-- card -->
 <div class="tab-pane tab2_tab" id="homepagesettings">
        <div style=" display: block;" id="loader"><img src="https://digitalaicademy.com/public/images/loading.gif "></div>
        <input type="hidden" id="data_present" value="0">
        <div id="prev_data" style="display: none">
          <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
            <thead>
              <tr role="row">
                <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" aria-label="" ><div class="col-sm-12 no-padding table-title">#</div></th>
                <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Preview Image</div></th>
               <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Title</div></th>
               <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Assign to</div></th>
                <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" aria-label="Actions: activate to sort column ascending" style=""><div class="col-sm-12 no-padding table-title">Options</div></th>
              </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all" id="vdo_append">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
     
    </div>
  </div>
</div>

</div>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<!-- The JavaScript -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/tour/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
                
               // showMenu();

            	function showMenu(){
					/*
					we can restart or stop the tour,
					and also navigate through the steps
					 */
					var $tourcontrols  = '<div id="tourcontrols" style="position: fixed; bottom: 0px; right: 8px;  right: -300px;  width: 135px; color: #fff;  text-shadow: 0px 0px 1px #fff;  font-size: 16px;  padding: 10px;  -moz-border-radius: 5px;  -webkit-border-radius: 5px;  border-radius: 5px;  font-weight: bold;  z-index: 9999;">';
						//$tourcontrols += '<span class="button" id="activatetour" style="margin-left:34px;">Start the tour</span>';						
						$tourcontrols += '<nav id="main-nav">';
						$tourcontrols += '<ul><li><img width="75px"  src="<?php echo base_url(); ?>public/uploads/images/info.png" /></a>';
						$tourcontrols += '<ul class="main-nav-sub">';
                        $tourcontrols += '<li id="tourStart"><a href="#">Start Tour of this Page</a></li>';
                        $tourcontrols += '<li><a href="#">Academy Design Wizard</a></li>';
                        $tourcontrols += '<li><a href="#">Create Course Wizard</a></li>';
                        $tourcontrols += '<li><a href="#">Exam Wizard</a></li>';
                       
                        $tourcontrols += '</ul></li></ul></nav>';

						//$tourcontrols += '</span>';
					$tourcontrols += '</div>';
					
					$('body').prepend($tourcontrols);
						$('#tourcontrols').animate({'right':'6px'}, 500);
				}
            });

            $('#tourStart').on('click', function() {
            	alert('dfg');
            	showControls();
            });

			$(function() {
				var config = [
					{
						"name" 		: "btn-success",
						"bgcolor"	: "black",
						"color"		: "white",
						"position"	: "TR",
						"text"		: "Click here to create new Media.",
						"time" 		: 5000
					},
					{
						"name" 		: "table",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Here the list of all Media.",
						"position"	: "BL",
						"time" 		: 5000
					},
					{
						"name" 		: "editdelete",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "You can also Edit and Delete existing Media.",
						"position"	: "RT",
						"time" 		: 5000
					},
					{
						"name" 		: "pub",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Single click can change the status of Media.",
						"position"	: "T",
						"time" 		: 5000
					},
					{
						"name" 		: "preview",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Click here to watch preview of Media.",
						"position"	: "BL1",
						"time" 		: 5000
					}

				],
				//define if steps should change automatically
				autoplay	= false,
				//timeout for the step
				showtime,
				//current step of the tour
				step		= 0,
				//total number of steps
				total_steps	= config.length;
			
				$('#activatetour').on('click',startTour);
				$('#canceltour').on('click',endTour);
				$('#endtour').on('click',endTour);
				$('#restarttour').on('click',restartTour);
				$('#nextstep').on('click',nextStep);
				$('#prevstep').on('click',prevStep);
				
				function startTour(){
					$('#activatetour').remove();
					$('#endtour,#restarttour').show();
					if(!autoplay && total_steps > 1)
						$('#nextstep').show();
					showOverlay();
					nextStep();
				}
				
				function nextStep(){
					if(!autoplay){
						if(step > 0)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps-1)
							$('#nextstep').hide();
						else
							$('#nextstep').show();	
					}	
					if(step >= total_steps){
						//if last step then end tour
						endTour();
						return false;
					}
					++step;
					showTooltip();
				}
				
				function prevStep(){
					if(!autoplay){
						if(step > 2)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps)
							$('#nextstep').show();
					}		
					if(step <= 1)
						return false;
					--step;
					showTooltip();
				}
				
				function endTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					removeTooltip();
					hideControls();
					hideOverlay();
				}
				
				function restartTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					nextStep();
				}
				
				function showTooltip(){
					//remove current tooltip
					removeTooltip();
					
					var step_config		= config[step-1];
					var $elem			= $('.' + step_config.name);
					
					if(autoplay)
						showtime	= setTimeout(nextStep,step_config.time);
					
					var bgcolor 		= step_config.bgcolor;
					var color	 		= step_config.color;
					
					var $tooltip		= $('<div>',{
						id			: 'tour_tooltip',
						class 	: 'tooltipt',
						html		: '<p>'+step_config.text+'</p><span class="tooltip_arrow"></span>'
					}).css({
						'display'			: 'none',
						'background-color'	: bgcolor,
						'color'				: color
					});
					
					//position the tooltip correctly:
					
					//the css properties the tooltip should have
					var properties		= {};
					
					var tip_position 	= step_config.position;
					
					//append the tooltip but hide it
						$('body').prepend($tooltip);
					
					//get some info of the element
					var e_w				= $elem.outerWidth();
					var e_h				= $elem.outerHeight();
					var e_l				= $elem.offset().left;
					var e_t				= $elem.offset().top;
					
					
					switch(tip_position){
						case 'TL'	:
							properties = {
								'left'	: e_l,
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');
							break;
						case 'TR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
							break;
						case 'BL'	:
							properties = {
								'left'	: e_l + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
							break;
						case 'BL1'	:
							properties = {
								'left'	: e_l + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
							break;
						case 'BR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');
							break;
						case 'LT'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');
							break;
						case 'LB'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');
							break;
						case 'RT'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
							break;
						case 'RT1'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
							break;
						case 'RB'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');
							break;
						case 'T'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');
							break;
						case 'R'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');
							break;
						case 'B'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');
							break;
						case 'L'	:
							properties = {
								'left'	: e_l + e_w  + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');
							break;
					}
					
					
					/*
					if the element is not in the viewport
					we scroll to it before displaying the tooltip
					 */
					var w_t	= $(window).scrollTop();
					var w_b = $(window).scrollTop() + $(window).height();
					//get the boundaries of the element + tooltip
					var b_t = parseFloat(properties.top,10);
					
					if(e_t < b_t)
						b_t = e_t;
					
					var b_b = parseFloat(properties.top,10) + $tooltip.height();
					if((e_t + e_h) > b_b)
						b_b = e_t + e_h;
						
					
					if((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)){
						$('html, body').stop()
						.animate({scrollTop: b_t}, 500, 'easeInOutExpo', function(){
							//need to reset the timeout because of the animation delay
							if(autoplay){
								clearTimeout(showtime);
								showtime = setTimeout(nextStep,step_config.time);
							}
							//show the new tooltip
							$tooltip.css(properties).show();
						});
					}
					else
					//show the new tooltip
						$tooltip.css(properties).show();
				}
				
				function removeTooltip(){
					$('#tour_tooltip').remove();
				}
				
				function showControls(){
					/*
					we can restart or stop the tour,
					and also navigate through the steps
					 */
					var $tourcontrols  = '<div id="tourcontrols" class="tourcontrols">';
					//$tourcontrols += '<p>First time here?</p>';
					$tourcontrols += '<span class="button" id="activatetour" style="margin-left:34px;">Start the tour</span>';
						if(!autoplay){
							$tourcontrols += '<div class="nav"><span class="button" id="prevstep" style="display:none;">< Previous</span>';
							$tourcontrols += '<span class="button" id="nextstep" style="display:none;">Next ></span></div>';
						}
						$tourcontrols += '<a id="restarttour" style="display:none;">Restart the tour</span>';
						$tourcontrols += '<a id="endtour" style="display:none;">End the tour</a>';
						$tourcontrols += '<span class="close" id="canceltour"></span>';
					$tourcontrols += '</div>';
					
					$('body').prepend($tourcontrols);
						$('#tourcontrols').animate({'right':'100px'}, 500);
				}

				
				
				function hideControls(){
					$('#tourcontrols').remove();
				}
				
				function showOverlay(){
					var $overlay	= '<div id="tour_overlay" class="overlay"></div>';
					$('body').prepend($overlay);
				}
				
				function hideOverlay(){
					$('#tour_overlay').remove();
				}
				
			});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script>
var $ =jQuery.noConflict();
function change_Status(id,status)
{
  var base_url = $("#base_url").val();
  // alert(base_url);return false;
    $.ajax({
          type:'POST',
          cache:false,
          url:base_url+"admin/medias/changeStatus",
          data:{
            id:id,status:status
          },
          success:function(returndata)
          {
              $(".dataTable").load(location.href+" #table-2");
              // $("#statusModal").modal('show');
              var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+returndata+'</div>';
              var note = $(document).find('#message');
              note.html(str);
              note.show();
              note.fadeIn().delay(3000).fadeOut();
              // alert(returndata);return false; 
          } 
    });
}
	function deleteconfirm(id) 
	{
		   var isit = $("#id_"+id).val();
		   		if(isit == 1)
		   		{
		   			$.alert({
   				 	title: 'Sorry!',
    				content: 'Users are Enrolled to this Course. You cannot delete it.!',
    				confirm: function()
    						{
    							return true;
        					//document.location.href = window.location.origin+'/admin/programs/';
    						}
						});
		   		}
		   		else
		   		{   
			$.confirm({
    			title: 'Do you really want to delete ?',
    			content: ' ',
    			confirm: function(){ 
    					 //window.location.href = "<?php echo base_url(); ?>admin/medias/delete/"+id;
                $.ajax({
                      type:"POST",
                      cache: false,
                      url:"<?php echo base_url(); ?>admin/medias/delete",
                      data:{
                        id:id
                      },
                      success:function(returndata)
                      {
                        $(".dataTable").load(location.href + " #table-2");
                        var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+returndata+'</div>';
                        var note = $(document).find('#message');
                        note.html(str);
                        note.show();
                        note.fadeIn().delay(3000).fadeOut();
                      }
                });

   			  },
    			cancel: function(){        
    					return true;
    						}
					  });
			}
		}
</script>
<script>
var $ =jQuery.noConflict();
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

function getallvdos(){
  var data_present = $("#data_present").val().trim();
  if(data_present == 0){
    $.ajax({
          type: "post",
          cache : false,
          url : "<?php echo base_url();?>admin/medias/getallvideos",
          data : {},
          success : function(response){
            $("#data_present").val('1');
            $("#loader").css('display','none');
            $("#prev_data").css('display','block');
            $("#vdo_append").html(response);
          }
    });
  }
}
</script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
        var $j = jQuery.noConflict();
        $j(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements

        //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"}); 
        $j(".pre_pop").colorbox({
        iframe:true,
        width:"500px", 
        height:"58%",
        fadeOut:500,
        fixed:true,
        reposition:true,  
        })
         });
    </script>