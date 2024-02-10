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

<script>
    function isChecked(isitchecked) {
        if (isitchecked == true) {
        document.orderform.boxchecked.value++;
        } else {
        document.orderform.boxchecked.value--;
        }
    }
    function listItemTask(id, task) {
        var f = document.orderform;
        var cb = f[id];
        $("#tr"+id).remove();

        if (cb) {
        for (var i = 0; true; i++) {
        var cbx = f['cb'+i];
        if (!cbx)
        break;
        cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        var checkval = $('#'+id+':checked').val();
        document.orderform.checkval.value = checkval;
        submitbutton(task);
        }
        return false;
    }
    function submitbutton(pressbutton) {
        var form = document.orderform;

        submitform ( pressbutton );
    }
    function submitform(pressbutton) {

        if (pressbutton) {
        document.orderform.task.value = pressbutton;
        }
        if (typeof document.orderform.onsubmit == "function") {
        document.orderform.onsubmit();
        }
        if (typeof document.orderform.fireEvent == "function") {
        document.orderform.fireEvent('submit');
        }
        document.orderform.submit();
    }
    function saveorder(n, task) {
        checkAll_button(n, task);
    }
    function checkAll_button(n, task) {
        if (!task) {
        task = 'saveorder';
        }
        document.orderform.submit();
    }
</script>
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
								
							 			window.location.assign("<?php echo base_url(); ?>admin/mcategories");
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
  background-color: #f1f1f1!important;
  color: #c42140;
  text-transform: uppercase!important;
  font-size: 19px!important;
  font-weight: bold!important;
  text-align: center!important;
  padding: 7px 30px 0 13px !important;
  border-bottom: 0px!important;
  height: 65px!important;
  font-family: inherit;
}
.btn-success {
  background-color: #04A600;
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
        <div id="toolbar" class="toolbar-list">
          <?php
          if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
          {
          ?>
          <div id="sticky-anchor"></div>
            <ul id="sticky" style="list-style: none; float: right;">
                <li id="toolbar-new" class="listbutton">
                    <a href="<?php echo base_url(); ?>admin/create/course-categories/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">
                    <i class="entypo entypo-popup"></i>
                    <span class="icon-32-new">
                    </span>
                    New
                    </a>
                </li>
            </ul>
          <?php
          }
          ?>
        <div class="clr"></div>
        </div>
        <div class="pagetitle icon-48-generic"><h2>Course Category Manager</h2></div>
    </div>
</div>

<div style="margin-bottom:5px;"></div>
<div><h2><?php //echo lang('web_category_list')?></h2></div>
<div class='clear'></div>
<span class="clearFix">&nbsp;</span>
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/pcategories/',$attributes);
?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<div class="row">
<!--<form action="<?=site_url('admin/quizzes/')?>" method="post">-->
    <div class="col-sm-12 col-right no-padding top-head-box">
      <!-- <div class="dataTables_filter" id="table-3_filter"> -->
      <!-- <div id="table-3_filter"> -->
      <div id="table-3_length">
        <input type="text" class="form-control form-height" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Course Category">
       <!--  <div id="table-3_length"> -->
          <button type="submit" value="Search" name="submit_search" class="search-btn"><div class='sprite search' title="Search"></div></button>
          <button type="submit" value="Reset" name="reset" class="search-btn"><i class="entypo entypo-cw" style="color: #888888;font-size: 25px;" title="Reset"></i></button>         
      <!-- </div> -->
      </div>    
    </div>
</div>
<br>
<div class="clear"></div>
<?php echo form_close(); ?>


<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
echo form_open_multipart(base_url().'admin/pcategories/',$attributes);
?>


<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
   		<tr role="row">
        	           
            <th class="sorting col-sm-4" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title"><?php echo lang('web_name')?></div></th>
            
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Sub Category</div></th>

			<!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Order<a class="saveorder" href="javascript: saveorder(<?php echo count($categories)-1; ?>, 'saveorder')">__</a></th>-->
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title">Published</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="text-align: center;"><div class="col-sm-12 no-padding table-title"><?php echo lang('web_options')?></div></th>
        </tr>
	</thead>

<?php if ($categories): ?>

<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0; 
      $iii = 0;
      
   foreach ($categories as $category): ?>
<tr class="odd" id='<?php echo $category->id?>'>
<!-- <td><?php //echo $category->id?></td>-->
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>-->
			
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $category->name; ?></td>
			
			<td class="field-title " style="text-transform: capitalize;color: #949494;">
            <a title="Move Up" onclick="return listItemTask('cb<?php echo $i; ?>','orderup')" href="javascript:void(0);" class="jgrid" id="cb<?php echo $i ?>">
                <span class="state uparrow"></span>
                </a>
                <a title="Move Down" onclick="return listItemTask('cb<?php echo $i; ?>','orderdown')" href="javascript:void(0);" class="jgrid">
                <span class="state downarrow"></span></a>
            </td>
			
			<!--<td class=" ">
            <input type="text" name="order[<?php echo $category->id; ?>]" size="5" value="<?php echo $category->ordering ; ?>" class="text_area" style="text-align: center" />
                <input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $category->id;?>" class="text_area" style="text-align: center" />
            </td>-->
			
            <td class="pub">
            <?php
                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
                {
                ?>
                    <?php if($category->published){?>
                    <a  title="Publish Item" href="<?php echo base_url(); ?>admin/pcategories/unpublish/<?php echo $category ->id?>/"><!-- <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"> --><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>
                    <?php }else{?>
                    <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/pcategories/publish/<?php echo $category ->id?>/"><!-- <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"> --><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>
                    <?php }?>
                <?php
                }
                else
                echo "No Access";
                ?>
            </td>
			
             <td class="editdelete">
                <?php
                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
                {
                ?>
                    <!-- <a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/pcategories/edit/<?php echo $category->id?>/'><i class="entypo-pencil"></i><?php echo lang('web_edit')?></a> -->
                    <!-- <a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/pcategories/edit/<?php echo $category->id?>/'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content">
        </div><?php echo lang('web_edit')?></a> -->
        <a class='col-sm-offset-3 col-sm-4 no-padding' href='<?php echo base_url(); ?>admin/edit/course-categories/<?php echo $category->id?>/'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>
                <?php
                }
                else
                     echo "Edit : No Access";
                ?>
          
                <?php
                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
                {
                	$is_delete = $CI->programs_model->isAllowToDelete($category->id);
                	$is_delete2 = $CI->programs_model->isAllowToDelete2($category->id);
                	if($is_delete > 0 && $is_delete2 > 0)
                	{
	                ?>
	                    <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/pcategories/delete/<?php echo $category->id?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
	                    <!-- <a class='col-sm-2 no-padding sprite_margin' onClick="return noallowdelete(<?php echo $category->id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div><?php echo lang('web_delete')?></a> -->
	                     <a class='col-sm-4' onClick="return noallowdelete(<?php echo $category->id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
                  <?php
	            	}else
	            	{
	            		?>
	                    <!-- <a class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/pcategories/delete/<?php echo $category->id?>'><i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
	                    <!-- <a class='col-sm-2 no-padding sprite_margin' onClick="return deleteconfirm(<?php echo $category->id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div><?php echo lang('web_delete')?></a> -->
	                	  <a class='col-sm-4' onClick="return deleteconfirm(<?php echo $category->id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
                    <?php
	            	}
                }
                else
                    echo "Delete : No Access";
                ?>
            </td>

			
		</tr>
        <?php
    $i++;
	$iii++;
    endforeach ?>
	
	<?php else: ?>



           <tr><td colspan="11">


		          <p class='text'><?=lang('web_no_elements');?></p>
		      </td>
              </tr>





             <?php endif ?>
	
	
	
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="checkval" value=""/>
        </tbody>

</table>
<?php echo form_close(); ?>

<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countpcat; ?> entries</div>
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
						"text"		: "Click here to create new Course Category.",
						"time" 		: 5000
					},
					{
						"name" 		: "table",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Here the list of all Course Category.",
						"position"	: "BL",
						"time" 		: 5000
					},
					{
						"name" 		: "editdelete",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "You can also Edit and Delete existing Course Category.",
						"position"	: "RT",
						"time" 		: 5000
					},
					{
						"name" 		: "pub",
						"bgcolor"	: "black",
						"color"		: "white",
						"text"		: "Single click can change the status of Course Category.",
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
					$tourcontrols += '<span class="button" id="activatetour" style="margin-left:36px;">Start the tour</span>';
						if(!autoplay){
							$tourcontrols += '<div class="nav"><span class="button" id="prevstep" style="display:none;">< Previous</span>';
							$tourcontrols += '<span class="button" id="nextstep" style="display:none;">Next ></span></div>';
						}
						$tourcontrols += '<a id="restarttour" style="display:none;">Restart the tour</span>';
						$tourcontrols += '<a id="endtour" style="display:none;">End the tour</a>';
						$tourcontrols += '<span class="close" id="canceltour" style="background-position: 5px 4px!important;"></span>';
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
    					 window.location.href = "<?php echo base_url(); ?>admin/pcategories/delete/"+id;
        
   							 },
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}

		function noallowdelete(oldId) 
	    {		
			var str ="<select id='categorycombo' class='form-control' style='margin-left: 133px;margin-top: 28px; margin-bottom: 17px; width: 50%;'>";
			<?php foreach ($categories as $category){?>
			 str+="<option value='<?php echo $category->id; ?>'><?php echo $category->name; ?></option>";
			 <?php }?>			 
			 str+="</select>";

		 	$.confirm({
    			title: 'Assign this Category Courses to another Category',
    			content: str,
    			confirm: function(){    					 
        						var newId = $("#categorycombo").val();        						
							     $.ajax({
										type: "POST",
										url: "<?php echo base_url(); ?>admin/pcategories/assigncategory",
										data: {oldId:oldId,newId:newId}, 
										success: function(data)
										{		
											if(data)
											{									
												$.confirm({
							    			title: 'Do you really want to delete ?',
							    			content: '',
							    			confirm: function(){
							    					window.location.href = "<?php echo base_url(); ?>admin/pcategories/delete/"+oldId;
							    					window.location.href = "<?php echo base_url(); ?>admin/pcategories";		
							    								},
								    			cancel: function(){ 							    					
								    					window.location.href = "<?php echo base_url(); ?>admin/pcategories";
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