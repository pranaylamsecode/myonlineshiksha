<?php

$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
$first = $start + 1;
$u_data=$this->session->userdata('logged_in'); 
$maccessarr=$this->session->userdata('maccessarr');
?>
<script>
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
<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
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
<style>
label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
/*CSS*/
/*css*/
.jconfirm .jconfirm-box div.title {
  background-color: #f1f1f1!important;
  color: #5a5a5a;
  text-transform: uppercase!important;
  font-size: 18px!important;
  line-height: 28px;
  font-weight: 400!important;
  text-align: center!important;
  padding: 4% 2% 2% 2% !important;
  border-bottom: 0px!important;
  height: 65px!important;
  font-family:'AvenirNextLTPro-Demi'!important;
  border-radius: 6px;
}
.jconfirm .jconfirm-box .buttons {
  padding: 3% 15px 4%!important;
  border-top: 1px dotted #999;
}
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  padding-left: 20px!important;
  padding-right: 20px!important;
  margin: 28px 0 28px 0!important;
  text-align: center!important;
  font-size: 16px;
  font-weight: 400!important;
  font-family: 'AvenirNextLTPro-Regular'!important;
}
/*.jconfirm .jconfirm-box div.title {
  background-color: #f1f1f1;
  color: #c42140;
  text-transform: uppercase!important;
  font-size: 21px!important;
  font-weight: bold!important;
  text-align: center!important;
  padding: 18px 30px 0 13px !important;
  border-bottom: 0px!important;
  height: 55px!important;
  font-family: inherit;
}*/
.content {
  padding-left: 20px!important;
  padding-right: 20px!important;
}
.para-style {
  margin: 28px 0 15px 0!important;
  text-align: center!important;
  /*font-weight: bold!important;*/
}
@media(max-width:1120px){
.button-sect a {
  padding: 5px 6px;
	}
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
  margin-bottom: 5px !important;
}
.txt-pyara{
  padding: 0px;
}
.course_search{
  padding: 0px !important;
  margin: 0px !important;
}
}
}
@media(max-width:450px){
.page-title {
  text-transform: uppercase;
  font-size: 20px;
	}
}
@media (max-width: 400px){
.page-title {
  text-transform: uppercase;
  font-size: 18px;
}
}
/*end of css*/
</style>

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
</script>

<div class="page-container">
<div style="background-color: #F5F5F5">
<?php
	$this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?>

<div class="main-content">
<div class="row">
<div class="sidebar-collapse sb-toggle-left">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu" ></i>
	</a>
</div>

<div class="txt-pyara">
<p class="col-md-11 right_course_txt" style="font-style: italic;">Here you can manage all your courses. By click on the course name, you will see the courses Table of Content which can be edited and new sections/lecture can be created. When you click edit, you edit the setting of the course.</div>

<div id="sticky-anchor"></div>
<div id="" class="more_options">
<?php
if(($maccessarr['courses']=='own') || ($maccessarr['courses']=='modify_all'))
{
	
	if($course_limit > $countprogConfig)
	{
	?>
    
    <!-- <a href="<?php echo base_url(); ?>programs/create" onclick="Joomla.submitbutton('edit')"  class="btn btn-success" style="float: right;"> -->
			<!-- <a href="<?php echo base_url(); ?>admin/course-manager" class="btn btn-danger" style="float: right;"> <i class="entypo entypo-login"></i> New Webinar</a>
	<a href="<?php echo base_url(); ?>admin/course-manager" class="btn btn-success" style="float: right; margin-right:5px;"> <i class="entypo entypo-login"></i> New</a>
	
	<a href="<?php echo base_url(); ?>admin/course-manager" class="btn btn-orange" style="float: right; margin-right:5px;">
	<i class="entypo entypo-docs"></i>
	Copy
	</a> -->
	<?php
    }
	?>

	<a href="<?php echo base_url(); ?>course/statistics/<?php echo $u_data['id'];?>" class="btn btn-info" style="float: right; margin-right:5px;"><img src="<?php echo base_url(); ?>public/css/image/coverage-level (1).png" alt="coverage-level" style="width: 12px;padding: 0;margin-top: -2px;">
	Statistics
	</a>
	<?php
}
?>

</div>

<div>
    <?php  if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<div class="clr"></div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');
// echo form_open_multipart('programs/lists/',$attributes);
echo form_open_multipart(base_url().'manage/courses/',$attributes);
?>


<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<div class="row">
    <div class="course_search" style="float:right;">
      	<input type="text" class="textbox" style="float:left; margin-right:10px; height:30px;" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Course Title" />
		<button type="submit" value="Search" name="submit_search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>
		<!-- <button type="submit" value="Reset" name="reset" class="btn btn-danger btn-del" style="margin-top: -2px;padding-left: 4px;"><i class="entypo entypo-cw"></i> Reset</button> -->
	</div>
	
	<div class="course_search" style="float:right; margin-top: 0px;">
    <label style="display: inline-block; padding:0px; width:auto;">
    Course category :

				<select name="catid" size="1" onchange="document.topform11.submit()">

    				<option value="">All</option>

    				<?php

    				 foreach ($categories as $category):

                     //$cat_name = ($this->input->post('catid') && $this->input->post('catid') == $category->id) ? 'selected="selected"' : '';

                     ?>

    				 <option value='<?php echo $category->id?>' <?php //echo $cat_name; ?>><?php echo $category->name?></option>

					<?php endforeach ?>

				</select>
    </label>
    	<label style="display: inline-block; padding:0px; width:auto;">
       		Status :
                <select name="status" onchange="document.topform11.submit()">

				<option value="">- select -</option>

                <option value='1' <?php if($status == '1') echo "selected"; ?>>Published</option>

				<option value='0' <?php if($status == '0') echo "selected"; ?>>Unpublished</option>

				</select>
		</label>
    </div>

</div>

<div class="clear"></div>
 <?php echo form_close(); ?>

<div class="table-scroll-resp">
<table class="table table-bordered table-striped datatable dataTable inner_pages_table" id="table-2" aria-describedby="table-2_info">

	<thead>
   
		<tr role="row">
        	<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>-->
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 264px;">Course Title</th>
            
             <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 115px;">Manage Lectures</th>
                        
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 200px;">Category</th>
			
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 84px;">Enrolled Students</th>
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 88px;">Reviews</th>
<!-- 
			<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Previews</th> -->
			<?php
				$this->load->config('features_config');
				$webinar = $this->config->item('webinar');				
				
				if($webinar['status']==TRUE)
				{
			?>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 88px;">Live Online Classes</th>
				<?php } ?>
            
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Re-order<a class="saveorder" href="javascript: saveorder(<?php echo count($programs)-1; ?>, 'saveorder')">__</a></th>-->

            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 83px;">Published</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 147px;">Options</th>
            
        </tr>
	</thead>

<?php

$attributes = array('class' => 'tform', 'name' => 'orderform');

echo form_open_multipart(base_url().'programs/',$attributes);

?>

<?php if ($programs): 
 ?>
	
	
<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;
      $iii = 0;
?>

<?php
foreach ($programs as $program): 
 //$counts_students = $this->program_model->getEnrolledUser($program->id);
	$counts_students = $this->program_model->getEnrolledUsernew($program->id);
$webicount = $this->programs_model->getwebinarcount($program ->id);
//$sectcount = $this->programs_model->getsectioncount($program ->id);
$sectcount = $this->programs_model->getlistDays($program ->id);
$reviews = $this->programs_model->getReviews($program ->id);
//$lessonscount = $this->programs_model->getLessons($sectcount->id);
$ii = 0;
foreach ($sectcount as $key) 
{
  	//$lessonscount = $this->programs_model->getLessons($key->id);
  	$lessonscount = $this->program_model->getLessonNew($key->id);
  	// echo"<pre>";
  	// print_r($lessonscount);
  	// exit();
  	//echo count($lessonscount);
    // echo count($lessonscount);
    $ii+= count($lessonscount);
}
?>
		 
<tr class="odd camp<?php echo $i;?>">
			<!--<td class=" sorting_1">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<input type="checkbox" id="chk-1"><div class="checked"></div>
				</div>
			</td>-->
			
			<td class="product_name">
				<?php		
				$urlCourse = strtolower($program->name);			
				$urlCourse = trim(str_replace(' ', '-', $urlCourse));
				$urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

				if(($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
				{
					$coursename = strtolower($program->name);      
				    $coursename = trim(str_replace(' ', '-', $coursename));
				    $coursename = preg_replace('/[^A-Za-z0-9\-]/', '', $coursename);
					?>
			  		<!-- <a href="<?php echo base_url(); ?>days/index/<?php echo $program ->id?>" class="a_mlms"> -->
			  		<!-- <a href="<?php echo base_url(); ?>sections-manage/<?php echo $program ->id?>/<?php echo $urlCourse; ?>" class="a_mlms"> -->

			  		<!-- <a class='class="a_mlms"' title="Edit Course" href='<?php echo base_url(); ?>edit/<?php echo $coursename ?>/<?php echo $program ->id?>'> -->
			  		
			  		<?php 
			  		if($program->webstatus == 'active' && $program->course_type == '2') { ?>
			  		<a class='a_mlms'  href='<?php echo base_url(); ?>edit-webinar/<?php echo $coursename ?>/<?php echo $program ->id?>'>
						<?php echo $program->name?>
	        		</a> <?php } else { ?>
			  		<a class='a_mlms'  href='<?php echo base_url(); ?>category/course_detail/<?php echo $program->slug ?>/<?php echo $program->catid ?>'>
						<?php echo $program->name?>
	        		</a>
					<?php
					}
				}
				else
				{
         			echo $program->name;
				}
				
				?>			
			</td>

			<!-- <td class="webnr"><a href="<?php echo base_url(); ?>/days/index/<?php echo $program ->id?>">Lectures (<?php echo $ii;?>)</a></td> -->
			<!-- <td class="webnr"><a href="<?php echo base_url(); ?>section-management/<?php echo $program ->id?>/<?php echo $urlCourse; ?>">Lectures (<?php echo $ii;?>)</a></td> -->
			<?php if($program->webstatus == 'active' && $program->course_type == '2') {?>
			<td class="webnr"><center>_</center></td>
			<?php } else { ?>
        <!-- href="<?php echo base_url(); ?>sections-manage/<?php echo $program ->id?>/<?php echo $urlCourse; ?>" -->
			<td class="webnr"><a>Lectures (<?php echo $ii;?>)</a></td>
			<?php } ?>
			<td class=" "><?php echo $program->catname?></td>
						
			<td class=" "><a href="<?php echo base_url(); ?><?php echo $urlCourse; ?>/enrolled-students-list/<?php echo $program ->id?>">Enrolled (<?php echo count($counts_students);?>)</a></td>
			<!-- <td class="enrol"><a href="<?php echo base_url(); ?>programs/reviews/<?php echo $program ->id?>"><?php echo count($reviews); ?></a></td> -->
			<td class="enrol">Reviews (<?php echo count($reviews); ?>)</td>

			<?php
				  $days = $this->program_model->getlistDays($program ->id);

				  $lessons = $this->program_model->getLessons($days[0]->id);

			?>

			<!-- <td class="enrol"><a href="<?php if($ii == 0) { echo '#';} else { echo base_url()."programs/coursepreview/".$program->id."/".$days[0]->id."/".$lessons[0]->id; } ?>"><?php if($ii == 0) { echo 'No Lectures'; } else { echo 'Course Preview'; } ?></a></td> -->

			<?php
				$this->load->config('features_config');
				$webinar = $this->config->item('webinar');					
				if($webinar['status']==TRUE)
				{
			?>
            
            <td class="webnr">
<!--             	
 -->                <?php
                	if($program->webstatus == 'active' && $program->course_type != '2') { ?>
                		<!-- <a href="<?php echo base_url() ?><?php echo $urlCourse; ?>/webinars/<?php echo $program ->id; ?>"> -->
            	<?php 
            		echo 'Webinars ('.$webicount->count1.')';
            		// </a>';
            	}
            	else if($program->webstatus == 'active' && $program->course_type == '2') { ?>
<!--                 		<a href="<?php echo base_url() ?><?php echo $urlCourse; ?>/webinars/<?php echo $program ->id; ?>">
 -->            	<?php 
            		// echo '<center>_</center>';
            	}
            	else
            	{	?> <a href="#">
            	 <?php
            		echo 'Inactive Webinars'.'</a>';
            	}
                ?>
                
            <!-- </a> -->
        	</td>
				<?php }  ?>
            
			<!--<td class=" ">
            
            <input type="text" name="order[<?php echo $program->id; ?>]" size="5" value="<?php echo $program->ordering ; ?>" class="text_area" style="text-align: center;" />

         	<input type="hidden" id="cb[]" name="cid[]" size="5" value="<?php echo $program->id;?>" class="text_area" style="text-align: center" />
            
            </td>-->
			
			<td class=" ">
<?php
if(($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
{
	if($program->published)
	{
		?>
   		<div style="margin: 0 auto;text-align: center;" id ="publishDiv<?php echo $program->id ?>" ><a title="Unpublish Item" onclick="removetopublish(<?php echo $program->id ?>);"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a></div>
    	<?php 
    }    	
    else
    {
		?>
		<div style="margin: 0 auto;text-align: center;" id ="publishDiv<?php echo $program->id ?>" ><a title="Publish Item"  onclick="addtopublish(<?php echo $program->id ?>);"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a></div>
		</td>
		<?php 
	}
}
else

echo "No Access";
?>

            
<td class=" ">
<div class="button-sect">
<a class="btn btn-pre" href="<?php if($ii == 0) { echo '#';} else { echo base_url()."programs/coursepreview/".$program->id."/".$days[0]->id."/".$lessons[0]->id; } ?>"><?php if($ii == 0) { echo '<i class="entypo entypo-block" title="No Preview"></i>'; } else { echo '<i class="entypo entypo-eye" title="Preview"></i>'; } ?></a>
<?php

if(($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
{
    $coursename = strtolower($program->name);      
    $coursename = trim(str_replace(' ', '-', $coursename));
    $coursename = preg_replace('/[^A-Za-z0-9\-]/', '', $coursename);
	?>

	<!-- <a class='btn btn-default' href='<?php echo base_url(); ?>programs/edit/<?php echo $program ->id?>'>edit</a> -->
	<!-- <a class='btn btn-default' href='<?php echo base_url(); ?>edit-the-course/<?php echo $coursename ?>/<?php echo $program ->id?>'>edit</a> -->
	<?php if($program->course_type=='2' && $program->webstatus=='active'){ ?>
			<a class='btn btn-edi' title="Edit Course" href='<?php echo base_url(); ?>edit-webinar/<?php echo $coursename ?>/<?php echo $program ->id?>'><i class="entypo-pencil"></i></a>
	<?php } else { ?>
	<!-- <a class='btn btn-edi' title="Edit Course" href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'><i class="entypo-pencil"></i></a> -->
	<!-- <?php echo $coursename ?>/ -->
	<?php }
}

if($maccessarr['courses']=='own')
{
	?>
	<!-- <a class="btn btn-danger" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>programs/trash/<?php echo $program->id?>'><?php echo lang('web_delete')?></a> -->
	<?php 
	$users_id = $this->programs_model->getBuyUsers($program ->id);
	if($program->author == $u_data['id'] || $u_data['id'] =='1') 
	{
	?>
	<input type="hidden" value="<?php echo $users_id ? '1' :'0' ?>" id="id_<?php echo $program->id?>" >
	<!-- <a class="btn btn-del" title="Delete" onClick="return deleteconfirm('<?php echo $program->id?>')" >-->
    <!--  <?php echo lang('web_delete')?> --><!--  <i class="entypo entypo-trash"></i></a>  -->
	<?php
   }
}
else
echo "No Access";
?>
</div>
</td>
</tr>
<?php
$iii++;
endforeach ?>
<?php else: ?>
<tr>
<td colspan="8">
<!-- <?php echo 'No course(s) found. Create a new one here.';?> -->
No course(s) found. <a href="<?php echo base_url(); ?>admin/course-manager">Create a one now ! </a>
</td>

</tr>

<?php endif ?>

</tbody>

<?php echo form_close();?>

</table>

</div>       
</div>      

<!---Pagination-->       
<?php 
if($this->pagination->create_links()) 
{ 
?>     
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countprograms; ?> entries</div>
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
</div>    
</div> 
</div> 
</div>
<div style="clear:both;"></div>

<script type="text/javascript">
	$("p").click(function(){
	//var description = jQuery('.mce-container').val();
	var description =tinymce.get('dummy').getContent();
    alert(description);
    $('#dummy1').val(description);
});
</script>


<script>
function addtopublish(id)
{
$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>programs/addToPublish",
		data: {id:id}, 
		success: function(data)
		{	
					
			$("#publishDiv"+id).html("<a title='Unpublish Item' onclick='removetopublish("+ id +");'><img alt='Published' src='<?php echo base_url()?>public/images/admin/tick.png'></a>");
			
		}
	});
}

function removetopublish(id)
{

$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>programs/removeToPublish",
		data: {id:id}, 
		success: function(data)
		{	
					
			$("#publishDiv"+id).html("<a title='publish Item' onclick='addtopublish("+ id +");'><img alt='Published' src='<?php echo base_url()?>public/images/admin/publish_x.png'></a>");
			
		}
	});
}
</script>


<!-- tool tip script -->
<script type="text/javascript">
	jQuery(document).ready(function() {
			jQuery('.tooltipicon').click(function(){
				var dispdiv = jQuery(this).attr('id');	
				jQuery('.'+dispdiv).css('display','inline-block');	
				});	

				jQuery('.closetooltip').click(function(){	
					jQuery(this).parent().css('display','none');	
		});	

		});	
</script><!-- tool tip script finish -->
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
function deleteconfirm(id) 
       {
                  var isit = $("#id_"+id).val();
                                  if(isit == 1)
                                  {
                                          $j.alert({
                                           title: 'Sorry!',
		                                   content: '<p class="para-style">Users are Enrolled to this Course. You cannot delete it.!</p>',
		                                   confirm: function()
                                                   {
                                                           return true;
                                               //document.location.href = window.location.origin+'/admin/programs/';
                                                   }
                                               });
                                  }
                                  else
                                  {   
                       $j.confirm({
                           title: 'Do you really want to delete Course ?',
                           content: ' ',
                           confirm: function(){ 
                                            window.location.href = "<?php echo base_url(); ?>programs/trash/"+id;
       
                                                           },
                           cancel: function(){        
                                           return true;
                                                   }
                                         });
                       }
               }
    </script>
              