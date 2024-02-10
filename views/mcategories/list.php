<?php

$u_data=$this->session->userdata('logged_in');

$maccessarr=$this->session->userdata('maccessarr');

?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />

<style type="text/css">
  .sidebar-menu.sb-left {
    display: none;
}
#left_menu_sidebar {
  display: none;
}
.sidebar-collapse.sb-toggle-left {
  display: none;
}
</style>
<script>
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
<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
<style>
label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
/*css*/
.jconfirm .jconfirm-box div.title {
  background-color: #f1f1f1!important;
  color: #333;
  text-transform: uppercase!important;
  font-size: 19px!important;
  line-height: 28px;
  font-weight: 400!important;
  font-family: 'AvenirNextLTPro-Regular'!important;
  text-align: center!important;
  padding: 4% 2% 2% 2% !important;
  border-bottom: 0px!important;
  height: 90px!important;
  font-family: inherit;
  border-radius: 6px;
}
.jconfirm .jconfirm-box .buttons {
  padding: 3% 15px 4%!important;
  border-top: 1px dotted #999;
}
select#categorycombo {
  margin-left: 92px!important;
  margin-top: 27px!important;
  margin-bottom: 27px!important;
  height: 40px;
  width: 65%!important;
  border: 3px solid #ddd!important;
}
/*.jconfirm .jconfirm-box .buttons {
  padding: 10px 15px;
  padding-top: 5px!important;
}*/
button.btn.btn-danger {
  background-color: #cc2424!important;
}

@media (max-width: 991px){
.main-content .course_search {
	width: auto;
	float: right !important;
	right: -5px;
	left: auto;
}
}
@media (max-width: 768px){
.main-content .course_search {
	width: 100%;
	float: none !important;
	right: 0px;
	position: unset;
	margin-bottom: 10px !important;
}
.txt-pyara{
  padding: 0px;
}
.course_search{
  padding: 0px !important;
  margin: 0px !important;
}
}
/*end of css*/
</style>

<div class="page-container">
	<div style="background-color: #F5F5F5">
		<div class="sidebar-menu sb-left">
<!-- Your left Slidebar content. -->
<!-- Classes Examples -->
		<ul id="main-menu">
			<li class="root-level"><a href="<?php echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
	        <li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>Manage Question Papers</span></a></li>
	        <li class="root-level"><a href="<?php echo base_url(); ?>questions/manage"><span>Manage Questions</span></a></li>
	        <li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
	        <li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
	        <li class="root-level"><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
		</ul>
	</div>




<div class="main-content">
	<div class="row">
     
			<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 12px;">
				<a href="#" class="sidebar-collapse-icon with-animation">
					<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
				
			</div>

<p class="pmcategory right_course_txt" style="font-style: italic;">Media files like video,images,PDF,flash files,etc which might be required for your various course,can be categories in this page. You may allot category for different type of media file for sake better searchability while designing a course. </p>

		<div id="sticky-anchor"></div>
					<div id="sticky">
					<?php
					if((@$maccessarr['media']=='modify_all') || (@$maccessarr['media']=='own'))
					{
					?>
						  <a href="<?php echo base_url(); ?>course-media-category/create/<?php echo $this->uri->segment(3)?>" class="btn btn-success" style="float: right;"><i class="entypo entypo-login"></i>
						  New
						  </a>
					<?php
					}
					?>
					</div>

				<div class="clr"></div>

<?php
	$attributes = array('class' => 'tform', 'name' => 'topform11');
	echo form_open_multipart(base_url().'course-media-category/manage/',$attributes);
?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

			<div class="row">

						    <div class="course_search" style="float:right;">
							
						        <input type="text" class="textbox" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" style="float:left; margin-right:10px; height:30px;" placeholder="Media Category">
								
						        <button type="submit" value="Search" name="submit_search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>

								<!-- <button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: -2px;padding-left: 4px;"><i class="entypo entypo-cw"></i> Reset</button> -->

						    </div>

						    <div class="course_search" style="float:right;">
						    <label style="display: inline-block; margin-bottom:0px; padding:0px; width:auto;">
						   		Published status :
								<select name="status" size="1" onchange="document.topform11.submit()">
									<option value="">All</option>
									<option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>
									<option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>
								</select>
							</label>
						    </div>   

			</div>


		<div class="clear"></div>

					<div class="table-scroll-resp">
					<table class="table table-bordered responsive inner_pages_table">
						<thead>
							<tr >
					        	<!--<th>
									<div class="checkbox checkbox-replace neon-cb-replacement">
										<input type="checkbox" id="chk-1"><div class="checked"></div>
									</div>
								</th>-->
					            
					            <th><?php echo lang('web_name')?></th>
					            
					              
					            <th>Published</th>
					            
					            <th><?php echo lang('web_options')?></th>
					            
					        </tr>
						</thead>

					<?php   
					if ($categories): ?>
					<tbody>
					<?php foreach ($categories as $category): ?>
					<tr id='<?php echo $category->id?>'>
								
					            <!--<td valign='middle' align='center'><?php //echo $category->id?></td>-->
					            
					            <!--<td>
									<div class="checkbox checkbox-replace neon-cb-replacement">
										<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
									</div>
								</td>-->
					         	
								<td class="product_name"> 
									<?php /* ?> <a href='<?php echo base_url(); ?>mcategories/edit/<?php echo $category->id?>/'> <?php */ ?>
									<?php echo $category->name?>
									<?php /* ?></a> <?php */ ?>       	         	
					            </td>
								
					            <td>
								<?php
								if((@$maccessarr['media']=='modify_all') || (@$maccessarr['media']=='own'))
								{
								?>
								<?php if($category->published){ ?>

								<a title='Unpublish Item' href="<?php echo base_url(); ?>mcategories/unpublish/<?php echo $category ->id ?>/"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>

								<?php }else{?>

								<a title="Publish Item" href="<?php echo base_url(); ?>mcategories/publish/<?php echo $category ->id?>/"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>

								<?php }?>

								<?php
								}
								else
								{
								echo "No Access";
								}
								?>		
								</td>
								
					            <td>
					            <div class="button-sect">
					            <?php
								if((@$maccessarr['media']=='modify_all') || (@$maccessarr['media']=='own'))
								{
									$urlcourse = strtolower($category->name);			
									$urlcourse = trim(str_replace(' ', '-', $urlcourse));
									$urlcourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlcourse);
									?>
									<a class='btn btn-default btn-edi' title="Edit" href='<?php echo base_url(); ?>course-media-category/<?php echo $urlcourse; ?>/<?php echo $category->id?>'><i class="entypo-pencil"></i><!-- <?php echo lang('web_edit')?> --></a>

									<?php
								}
								else
								{
									echo "No Access";
								}

								if((@$maccessarr['media']=='own'))
								{
								?>
								 <!-- <a class='btn btn-danger' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>mcategories/delete/<?php echo $category->id?>'><?php echo lang('web_delete')?></a>  -->
								 <?php 
									$mids = $this->mcategories_model->getMedia($category->id);
									if($mids)
									{				
								?>

								 <a class='btn btn-danger btn-del' title='Delete' onClick="return noallowdelete(<?php echo $category->id?>);" ><i class="entypo entypo-trash"></i><!-- <?php echo lang('web_delete')?> --></a>
								<?php 
									}
									else
									{
									?>
									<a title="Delete" class='btn btn-danger btn-del' onClick="return deleteconfirm(<?php echo $category->id?>);" ><i class="entypo entypo-trash"></i><!-- <?php echo lang('web_delete')?> --></a>
									<?php
									}

								 ?>

								<?php
								}
								?>
								</div>
					</td>
					</tr>
					<?php endforeach ?>	
					<?php else: ?>

					<tr>

					    <td colspan="4">

					<!-- <?=lang('web_no_elements');?> -->
					No media category created yet. <a href="<?php echo base_url(); ?>course-media-category/create">Create a one now !</a>
					</td>

					</tr>

					<?php endif ?>		
					</tbody>
					</table>
					</div>
							<div class="containerpg">

							<div class="pagination">
							             <?php echo $this->pagination->create_links();  ?>
							</div>

							</div>

</div>    

</div> 


</div>
</div>
<div style="clear:both;"></div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>


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
	function deleteconfirm(id) 
	{   
		
		$j.confirm({
    			title: 'Do you really want to delete categories ? ',
   				 content: ' ',
    			confirm: function(){
        			window.location.href = "<?php echo base_url(); ?>mcategories/delete/"+id;
    			},
    			cancel: function(){
       			 return true;
    			}
				});
	}
		
</script>


	<script>
			
				var $ =jQuery.noConflict();
				$(document).ready(function() {
					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			
	</script> 
 
<script type="text/javascript">
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
	function noallowdelete(oldId) 
	    {		
			var str ="<select id='categorycombo' class='form-control' style='margin-left: 133px;margin-top: 36px; margin-bottom: 24px; width: 50%;'>";
			<?php foreach ($categories as $category){?>
			 str+="<option value='<?php echo $category->id; ?>'><?php echo $category->name; ?></option>";
			 <?php }?>			 
			 str+="</select>";

		 	$j.confirm({
    			title: 'Assign this Category Courses to anather Category',
    			content: str,
    			confirm: function(){    					 
        						var newId = $j("#categorycombo").val();        						
							     $j.ajax({
										type: "POST",
										url: "<?php echo base_url(); ?>mcategories/assigncategory",
										data: {oldId:oldId,newId:newId}, 
										success: function(data)
										{	
											if(data)
											{										
											$j.confirm({
						    			title: 'Do you really want to delete ?',
						    			content: ' ',
						    			confirm: function(){
						    					//window.location.href = "<?php echo base_url(); ?>mcategories/delete/"+oldId;
						    					window.location.href = "<?php echo base_url(); ?>mcategories";		
						    								},
							    			cancel: function(){ 							    					
							    					window.location.href = "<?php echo base_url(); ?>mcategories";
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
