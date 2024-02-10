<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/tour/css/jquerytour.css" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<script src="<?php echo base_url(); ?>public/tour/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/tour/js/ChunkFive_400.font.js" type="text/javascript"></script>

<?php
$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
$first = $start + 1;
$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
?>
<script type="text/javascript">
		//var $ =jQuery.noConflict();
        function demoContent()
       				 {  var $ =jQuery.noConflict(); 
       				 		
       				 		$.confirm({
    							title: ' Do you really want to delete demo content ? ',
    							content: 'This will not affect your created content.',
    							confirm: function(){

    								$.ajax({
									type: "POST",
									url: "<?php echo base_url(); ?>admin/programs/deleteDemo",
							//data: {follow_id:follow_id,student_id:student_id}, 
										success: function(data)
										{
								
							 			window.location.assign("<?php echo base_url(); ?>admin/medias");
										}
		 								 });
       								
   									 },
   							 cancel: function(){
       						 return true;
    									}
								});	    
         	           
				 }
        </script>
<style>
.jconfirm .jconfirm-box div.title {
  background: transparent;
  font-size: 18px;
  font-weight: 600;
  font-family: inherit;
  padding: 10px 15px 10px;
  text-align: center;
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
button.btn.btn-success {
  background-color: #04A600!important;
}
.jconfirm .jconfirm-box .buttons {
  padding: 20px 15px!important;
}
</style>
<?php
	 $CI = & get_instance();
	 $CI->load->model('admin/programs_model');
  	 $democourse = $CI->programs_model->getDemo_course();
  	 $democoursecategory = $CI->programs_model->getDemoCourse_category();
  	 $demomediacategory = $CI->programs_model->getDemomedia_categories();
  	 $demouser = $CI->programs_model->getDemo_user();
  	 $demomedia = $CI->programs_model->getDemo_media();
  	 if($democourse || $democoursecategory || $demomediacategory || $demouser || $demomedia)
  	 {
  ?>
  
  <div id="tourcontrols1" class="tourcontrols" style="right: 373px; width: 688px;height: 81px; position: fixed;">
  <p>We have enabled demo content in Your Online Academy. You can anytime delete demo content using this button.</p>
  <span class="button" id="deleteDemo" onclick="demoContent();" style="margin-left: 241px;margin-top: -9px;">Delete Demo Content</span>
  
  <span class="close" id="canceltour"></span>
  </div>
  <?php
   }
  ?>
<div class="main-container">
<div id="toolbar-box">



    <div class="m">



        <div class="toolbar-list" id="toolbar">



            <?php



            if(($u_data['groupid']=='4') || ($maccessarr['media']=='modify_all') || ($maccessarr['media']=='own'))



            {



            ?>

            <div id="sticky-anchor"></div>

                <ul id="sticky" style="list-style: none; float: right;">



                    <li class="listbutton" id="toolbar-new">



                          <a href="<?php echo base_url(); ?>admin/create/media-categories/<?php echo $this->uri->segment(3)?>" onclick="Joomla.submitbutton('edit')" class="btn btn-green">


                         <i class="entypo entypo-popup"></i>
                          <span class="icon-32-new"></span>New



                          </a>



                    </li>



                </ul>



            <?php



            }



            ?>



        <div class="clr"></div>



        </div>



    <div class="pagetitle icon-48-generic"><h2><?php echo ('Media Categories Manager')?><?php //echo lang('web_category_list')?></h2>
     <p class="pmaintitle main_subtitle">Here you can create categories under which you can create medias(text/file/videos/picture/PDF etc.) to be added in the lectures. This creates ease of access and creating the lectures.</p></div>



    </div>



</div>







<div class='clear'></div>
<?php



$attributes = array('class' => 'tform', 'name' => 'topform1');



echo form_open_multipart(base_url().'admin/mcategories/',$attributes);



?>


<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">
  <div class="col-sm-12 no-padding top-head-box">
    <!-- <div id="table-3_length" class="dataTables_length"> -->
    <div id="table-3_length">
		<span style="margin-right:1%;">
        	<input type="text" class="form-control form-height" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Media Categories">
		</span>
    <!-- </div> -->
	<!-- <div class="dataTables_filter" id="table-3_filter"> -->
	<!-- <div id="table-3_filter"> -->
    	<span style="margin-right:1%;">
    		<select name="status" size="1" class="form-control form-height" onchange="document.topform1.submit()">
				<option value="">Published status</option>
				<option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>
				<option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>
			</select>
    	</span>
    	<span>
    		<button type="submit" value="Search" name="submit_search" class="search-btn"><div class='sprite search' title="Search"></div></button>
			<button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>
    	</span>
    </div>
  </div>
</div>
<br>
<div class="clear"></div>


<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Categories Name<?php //echo lang('web_name')?></div></th>
            
            <th class="sorting col-sm-3" align="center" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Parent Categories</div></th>
              
            <th class="sorting col-sm-1" align="center" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Published</div></th>
             
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title"><?php echo lang('web_options')?></div></th>
            
        </tr>
	</thead>

<?php if ($categories): ?>


<tbody>
<?php 
   $iii = 0;
foreach ($categories as $category): ?>
<tr class="odd" id='<?php echo $category->id?>'>
			
            <!--<td valign='middle' align='center'><?php //echo $category->id?></td>-->
            
            <!--<td class="camp0">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
         	
			<td class="field-title" style="color: #949494;text-transform: capitalize;"> 
				<?php /* ?> <a href='<?php echo base_url(); ?>admin/mcategories/edit/<?php echo $category->id?>/'> <?php */ ?>
				<?php echo $category->name?>
				<?php /* ?></a> <?php */ ?>       	         	
            </td>

            <td class="field-title " style="text-transform: capitalize;color: #949494;"> 
				<?php /* ?> <a href='<?php echo base_url(); ?>admin/mcategories/edit/<?php echo $category->id?>/'> <?php */ ?>
				<?php
				$parentName = $this->mcategories_model->getparentname($category->parent_id); 
				if($parentName)
				{
				echo $parentName->name;
				}
				?>
				<?php /* ?></a> <?php */ ?>       	         	
            </td>
			
            <td class="pub">
			<?php

			if(($u_data['groupid']=='4') || ($maccessarr['media']=='modify_all') || ($maccessarr['media']=='own'))

			{
	
			?>

			<?php if($category->published){ ?>

			<!-- <a title='Unpublish Item' href="<?php echo base_url(); ?>admin/mcategories/unpublish/<?php echo $category ->id ?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a> -->
			<a title='Publish Item' href="<?php echo base_url(); ?>admin/mcategories/unpublish/<?php echo $category ->id ?>/"><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>

			<?php }else{?>

			<!-- <a title="Publish Item" href="<?php echo base_url(); ?>admin/mcategories/publish/<?php echo $category ->id?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a> -->
			<a title="Unpublish Item" href="<?php echo base_url(); ?>admin/mcategories/publish/<?php echo $category ->id?>/"><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>

			<?php }?>

			<?php
			}
			else
			{
			echo "No Access";
			}
			?>		
			</td>
			
            <td class="editdelete">
            
            <?php

			if(($u_data['groupid']=='4') || ($maccessarr['media']=='modify_all') || ($maccessarr['media']=='own'))

			{

			?>

			<!-- <a class='col-sm-offset-3 col-sm-4 no-padding' href='<?php echo base_url(); ?>admin/mcategories/edit/<?php echo $category->id?>/'><i class="entypo-pencil"></i><?php echo lang('web_edit')?></a> -->
			<a class='col-sm-offset-3 col-sm-4 no-padding' href='<?php echo base_url(); ?>admin/edit/media-categories/<?php echo $category->id?>/'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>
			<!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/mcategories/delete/<?php echo $category->id?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
			<?php 
				$mids = $this->mcategories_model->getMedia($category->id);
				if($mids)
				{				
			?>
			<a class='col-sm-4' onClick="return  noallowdelete(<?php echo $category->id?>);" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
			<?php }else{ ?>

			<a class='col-sm-4' onClick="return deleteconfirm(<?php echo $category->id?>);" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
			<?php }?>
			<?php
			}
			else
			{
			echo "No Access";
			}
			?>
			</td>
		</tr>
        <?php 
          $iii++;
		endforeach ?>		

        <?php else: ?>



           <tr><td colspan="4">


		          <p class='text'><?=lang('web_no_elements');?></p>
		      </td>
              </tr>





             <?php endif ?>		
    </tbody>

</table>


<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countmcat; ?> entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>
</div>
<?php } ?>


<!-- The JavaScript -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/tour/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
			$(function() {
				/*
				the json config obj.
				name: the class given to the element where you want the tooltip to appear
				bgcolor: the background color of the tooltip
				color: the color of the tooltip text
				text: the text inside the tooltip
				time: if automatic tour, then this is the time in ms for this step
				position: the position of the tip. Possible values are
					TL	top left
					TR  top right
					BL  bottom left
					BR  bottom right
					LT  left top
					LB  left bottom
					RT  right top
					RB  right bottom
					T   top
					R   right
					B   bottom
					L   left
				 */
				var config = [
					{
						"name" 		: "btn-success",
						"bgcolor"	: "black",
						"color"		: "white",
						"position"	: "TR",
						"text"		: "Click here to create new Media Categories.",
						"time" 		: 5000
					},
					{
						"name" 		: "table",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Here the list of all Media Categories.",
						"position"	: "BL",
						"time" 		: 5000
					},
					{
						"name" 		: "editdelete",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "You can also Edit and Delete existing Media Categories.",
						"position"	: "RT",
						"time" 		: 5000
					},
					{
						"name" 		: "pub",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Single click can change the status of Media Categories.",
						"position"	: "RT1",
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
					
				//show the tour controls
				showControls();
				
				/*
				we can restart or stop the tour,
				and also navigate through the steps
				 */
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
					$tourcontrols += '<span class="button" id="activatetour" style="margin-left:35px;">Start the tour</span>';
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

        

        <script>
var 	$ =jQuery.noConflict();

		function deleteconfirm(id) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete ?',
    			content: ' ',
    			confirm: function(){ 
    					 window.location.href = "<?php echo base_url(); ?>admin/mcategories/delete/"+id;
        
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
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
</script>

<script type="text/javascript">
	
	function noallowdelete(oldId) 
	    {		
			var str ="<select id='categorycombo' class='form-control' style='margin-left: 133px;margin-top: 36px; margin-bottom: 24px; width: 50%;'>";
			<?php foreach ($categories as $category){?>
			 str+="<option value='<?php echo $category->id; ?>'><?php echo $category->name; ?></option>";
			 <?php }?>			 
			 str+="</select>";

		 	$.confirm({
    			title: 'Assign this Category Courses to anather Category',
    			content: str,
    			confirm: function(){    					 
        						var newId = $("#categorycombo").val();        						
							     $.ajax({
										type: "POST",
										url: "<?php echo base_url(); ?>admin/mcategories/assigncategory",
										data: {oldId:oldId,newId:newId}, 
										success: function(data)
										{	
											if(data)
											{										
											$.confirm({
						    			title: 'Do you really want to delete ?',
						    			content: ' ',
						    			confirm: function(){
						    					window.location.href = "<?php echo base_url(); ?>admin/mcategories/delete/"+oldId;
						    					window.location.href = "<?php echo base_url(); ?>admin/mcategories";		
						    								},
							    			cancel: function(){ 							    					
							    					window.location.href = "<?php echo base_url(); ?>admin/mcategories";
							    						}
												  }); 
										   }
										   else
										   {
										   	alert("Category delete Failed");
										   }
											
										}
									  });

   							 },
    			cancel: function(){        
    					return true;
    						}
					  });

		}
</script>