<?php
	$u_data=$this->session->userdata('logged_in');
	$maccessarr=$this->session->userdata('maccessarr');
	/*echo '<pre>';
	print_r($maccessarr);
	echo '</pre>';*/
?>
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
<style type="text/css">
.fancybox-custom .fancybox-skin {
	box-shadow: 0 0 50px #222;
}
/*css*/
.jconfirm .jconfirm-box div.title {
  background-color: #fff;
  color: #333;
  text-transform: uppercase!important;
  font-size: 18px!important;
  line-height: 28px;
  font-weight: 400!important;
  text-align: center!important;
  padding: 4% 2% 2% 2% !important;
  border-bottom: 0px!important;
  height: 38px!important;
  font-family: 'AvenirNextLTPro-Regular'!important;
  border-radius: 6px;
}
.jconfirm .jconfirm-box .buttons {
  padding: 3% 15px 4%;
  border-top: 1px dotted #999;
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
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  padding-left: 20px!important;
  padding-right: 20px!important;
  margin: 28px 0 10px 0!important;
  text-align: center!important;
  font-weight: bold!important;
}
@media(max-width:1999px){
.jconfirm .jconfirm-box div.title{
  height: 55px; 
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
<style>
label {
	padding: 0 !important;
	margin-bottom: 10px !important;
	width:auto !important;
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

<!--/lightbox scripts and style-->

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
        <div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0px;"> 
        	<a href="#" class="sidebar-collapse-icon with-animation"> 
          	<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
          	<i class="entypo-menu"></i></a> 
        </div>

<div class="txt-pyara"><p class="right_course_txt">Here you can manage your media library. You can add any type of media, including text, video, audio, files, documents, etc. </p></div>
<div id="sticky-anchor"></div>
<div id="sticky">
        
        <?php

if((@$maccessarr['course media']=='modify_all') || (@$maccessarr['course media']=='own'))
{
?>
        <a href="<?php echo base_url(); ?>course-media/create" onclick="Joomla.submitbutton('edit')" class="btn btn-success" style="float: right;"><i class="entypo entypo-login"></i> New </a> 
        <a href="<?php echo base_url(); ?>course-media/copy" onclick="Joomla.submitbutton('edit')" class="btn btn-orange" style="float: right; margin-right:10px;"><i class="entypo entypo-docs"></i> Copy </a>
        <?php
}
?>

</div>

<div class="clr"></div>

<?php
$attributes = array('class' => 'tform', 'name' => 'topform11');

echo form_open_multipart(base_url().'course-media/manage',$attributes);
?>
        <div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <div class="row">
            <div class="course_search" style="float:right;">
              <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Media Library" class="textbox" style="float:left; margin-right:10px; height:30px;">
              <button type="submit" value="Search" name="submit_search" class="btn btn-info"><span class="lnr lnr-magnifier"></span></button>
            </div>
            <div class="course_search" style="float:right;">
              <label style="display: inline-block; margin-bottom:0px; padding:0px; width:auto;"> Media Category :
                <select  name="catid" size="1" onchange="document.topform11.submit()">
                  <option value="">All</option>
                  <?php
		foreach ($categories as $category): ?>
                  <option value='<?php echo $category->id?>' <?php //echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>
                  <?php endforeach ?>
                </select>
              </label>
              <label style="display: inline-block; margin-bottom:0px; padding:0px; width:auto;"> Media Type :
                <select onchange="document.topform11.submit()" size="1" name="type" id="type">
                  <option value="">- select -</option>
                  <option value="Image">Image</option>
                  <option value="Video">Video</option>
                  <option value="Audio">Audio</option>
                  <option value="Document">Document</option>
                  <option value="Flash">Flash</option>

                 <!--  hh<?php foreach($mediatype as $type){ ?>
                  <option value="<?php echo @$type->name;?>"><?php echo @$type->title;?></option>
                  <?php } ?>gg -->
                </select>
              </label>
            </div>
          </div>
          <?php echo form_close(); ?>
          <div style="clear:both;"></div>
        
          <div class="table-scroll-resp">
            <table class="table table-bordered responsive inner_pages_table">
              <thead>
                <tr>
                 
                  <th>Media Storage</th>
                  <th>Type</th>
                  <th>Category</th>
                  <!-- <th>Preview</th> -->
                  <th>Published</th>
                  <th>Options</th>
                </tr>
              </thead>
              <?php if ($medias):  ?>
              <tbody>
                <?php $i=0;

?>
                <?php foreach ($medias as $media): ?>
                <tr> 
                <td class="product_name"><?php /* ?>	<a href="<?php echo base_url(); ?>medias/edit/<?php echo $media ->id?>" class="a_mlms"> <?php */ ?>
                    <?php echo $media->alt_title?>
                    <?php /* ?></a> <?php */ ?></td>
                  <td><?php /* ?>
	   			<a href="<?php echo base_url(); ?>medias/edit/<?php echo $media ->id?>" class="a_mlms">  <?php */ ?>
                    <?php //echo $media->type;
                   // echo $media->type;
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
                    <?php /* ?>
				</a> 
			<?php */ ?></td>
<td><?php echo $media->catname?></td>
<?php
			$urlmedia = strtolower($media->alt_title);			
			$urlmedia = trim(str_replace(' ', '-', $urlmedia));
			$urlmedia = preg_replace('/[^A-Za-z0-9\-]/', '', $urlmedia);
?>
<!-- <td><a href="<?php echo base_url(); ?>medias/preview/<?php echo $media->type;?>/<?php echo $media ->id?>" >Preview</a></td> -->
<!-- <td><a href="<?php echo base_url(); ?>course-media/<?php echo $urlmedia ? $urlmedia :'media' ?>/<?php echo $media->type;?>/<?php echo $media ->id?>" class="preview">Preview</a></td> -->
<td align="center">
<?php
if((@$maccessarr['course media']=='modify_all') || (@$maccessarr['course media']=='own'))
{
?>
    <?php if($media->publish){?>
    <div style="margin: 0 auto;text-align: center;" id="publishDiv<?php echo $media ->id?>" ><a title="Unpublish Item" onclick ="removetopublished(<?php echo $media ->id?>)" ><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a></div>
    <?php }else{?>
    <div style="margin: 0 auto;text-align: center;" id="publishDiv<?php echo $media ->id?>" ><a title="Publish Item" onclick ="addtopublished(<?php echo $media ->id?>)" ><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a></div>
    <?php }?>
    <?php
}
else

echo "No Access";

?></td>

<td>
<div class="button-sect">
<a href="<?php echo base_url(); ?>course-media/<?php echo $urlmedia ? $urlmedia :'media' ?>/<?php echo $media->type;?>/<?php echo $media ->id?>" class="preview btn btn-pre"><i class="entypo entypo-eye" title="Preview"></i></a>
<?php


if((@$maccessarr['course media']=='own') || (@$maccessarr['course media']=='modify_all'))
{
?>
    <a title="Edit" class='btn btn-default btn-edi' href='<?php echo base_url(); ?>medias/edit/<?php echo $media->id?>'><!-- <?php echo lang('web_edit')?> --><i class="entypo-pencil"></i></a>
    <?php
}
if((@$maccessarr['course media']=='own'))
{
	?>
	<!-- <a class='btn btn-danger' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>medias/delete/<?php echo $media->id?>'> <?php echo lang('web_delete')?></a> -->
	<a title="Delete" class='btn btn-danger btn-del' onClick="return deleteconfirm(<?php echo $media->id?>)" > <!-- <?php echo lang('web_delete')?> --><i class="entypo entypo-trash"></i></a>
	<?php $mediarel_id = $this->medias_model->getmediarelProgram($media->id); ?>
	<input type="hidden" value="<?php echo $mediarel_id ? '1':'0'; ?>" id="id_<?php echo $media->id?>">
	<?php
}
else
echo "No Access";
?>
</div>
</td>
                </tr>
                <?php endforeach ?>
                <?php else: ?>
                <tr>
                  <td colspan="7"><!-- <?=lang('web_no_elements');?> -->
                   No media created in library. <a href="<?php echo base_url(); ?>course-media/create">Create a one now !</a></td>
                </tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>
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
<script>
			//(function($) {
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
			//}) (jQuery);
	</script> 
	<script>
	function removetopublished(id)
	{
	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>medias/removeToPublish",
			data: {id:id}, 
			success: function(data)
			{
			
				$("#publishDiv"+id).html("<a title='Publish Item' onclick ='addtopublished("+ id +")' ><img alt='Published' src='<?php echo base_url(); ?>public/images/admin/publish_x.png'></a>");
			}
		  });	
	}

	function addtopublished(id)
	{
	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>medias/addToPublish",
			data: {id:id}, 
			success: function(data)
			{
			
				$("#publishDiv"+id).html("<a title='Unpublish Item' onclick ='removetopublished("+ id +")' ><img alt='Published' src='<?php echo base_url(); ?>public/images/admin/tick.png'></a>");
			}
		  });	
	}
	</script>

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
		var isit = $j("#id_"+id).val();
							if(isit == '1')
                                  {
                                          $j.alert({
                                           title: 'Sorry!',
                                   content: 'This media must be assigned to any of the course. You cannot delete it.!',
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
    			title: 'Do you really want to delete media ? ',
   				 content: ' ',
    			confirm: function(){
        			window.location.href = "<?php echo base_url(); ?>medias/delete/"+id;
    			},
    			cancel: function(){
       			 return true;
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
                       $j(".preview").colorbox({
                               iframe:true,
                               width:"600px", 
                               height:"420px",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,
                                                                                                 
                                               })
                       

                   });

                        </script>