<?php
    $u_data=$this->session->userdata('logged_in');
    $maccessarr=$this->session->userdata('maccessarr');
?>
<style type="text/css">label {
  padding: 0 !important;
  margin-bottom: 10px !important;
  width:auto !important;
}
</style>

<header>
    <section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>Course Webinars</h2>
        </div>
      </div>
    </div>
  </section>
</header>

<div class="page-container" >
<div style="background-color: #F5F5F5; display:-webkit-box;">
    <div class="sidebar-menu sb-left">
    	<ul id="main-menu">
    		<li class="root-level"><a href="<?php echo base_url(); ?>manage/courses"><span>Your Courses</span></a></li>  
    		<li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>Your Exams</span></a></li>   
    		<li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>  
    		<li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
    	</ul>
    </div>


<div class="main-content" style="min-height:500px;">
    <div class="row">
      <div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 12px;">
      	<a href="#" class="sidebar-collapse-icon with-animation">
      		<i class="entypo-menu" ></i>
      	</a>
      </div>
      <?php
          $this->load->model('admin/programs_model');
            $coursename=$this->programs_model->getCoursename5($proid);      

            $urlCourse = strtolower($coursename->name);     
            $urlCourse = trim(str_replace(' ', '-', $urlCourse));
            $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

           

    if($webinar_limit >= $total_webinar)
    {

  		if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
      {
        ?>
        <a href="<?php echo base_url(); ?><?php echo $urlCourse; ?>/webinar/<?php echo $proid?>/create" onclick="Joomla.submitbutton('edit')" class="btn btn-success" style="float: right;">New</a> 
        <?php
      }
    }
?>
<a href="<?php echo base_url(); ?>manage/courses" class="btn btn-danger" style="float: right; margin-right:5px;">Back</a> 
<div class='clear'></div>

<hr />
  
  <div>
    <h2>
      <?php //echo lang('web_category_list')?>
    </h2>
  </div>


<?php
    $attributes = array('class' => 'tform', 'name' => 'topform1');
    echo form_open_multipart(base_url().'webinars/',$attributes);
?>
  
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
  <div class="row">
        <div class="course_search" style="float:left;">
          <input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">
          <input type="submit" value="Search" name="submit_search" class="btn btn-info">
          <input type="submit" value="Reset" name="reset"  class="btn btn-danger">
        </div>
        <div class="course_search" style="float:right; margin-top: 0px;"></div>
  </div>
  <?php echo form_close(); ?>
  <div class='clear'></div>
<hr />

<div class="table-scroll-resp">   
    <table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <?php
          $attributes = array('class' => 'tform', 'name' => 'orderform');
          echo form_open_multipart('webinars/',$attributes);
      ?>    
      <?php
      if (@$webinars)
      {
          ?>
          <thead>
          <!--<th>ID</th>-->
        	<th><?php echo lang('web_name')?></th>
          <!--<th>Sub Categories</th>
              <th>Order<a class="saveorder" href="javascript: saveorder(<?php echo count($webinars)-1; ?>, 'saveorder')">__</a></th>-->
          <th align="center">Published</th>
          <th colspan='2'><?php echo lang('web_options')?></th>
          </thead>
        
          <tbody>
          <?php $i=0; foreach ($webinars as $webinar): ?>
          <tr id='<?php echo $webinar->id?>'> 
            <td width='400'><?php echo $webinar->title; ?></td>
            <td width='150' align="center">
            <?php
      		  //if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))

      			if($webinar->status=='active')
      			{
      				?>
      				<a title="Unpublish Item" href="<?php echo base_url(); ?>webinars/unpublish/<?php echo $webinar ->id?>/<?php echo $proid?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>
      				<?php 
      			}
      			else
      			{
      				?>
      				<a title="Publish Item" href="<?php echo base_url(); ?>webinars/publish/<?php echo $webinar ->id?>/<?php echo $proid?>"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>
      				<?php 
      			}
            ?>
            </td>
      		  <td width="60"><?php

      		  if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
            {
                $urlCourse1 = strtolower($webinar->title);     
                $urlCourse1= trim(str_replace(' ', '-', $urlCourse1));
                $urlCourse1 = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse1);
            		?>
                <a class='btn btn-default' href='<?php echo base_url(); ?><?php echo $urlCourse1;?>/webinar/<?php echo $webinar->id?>/<?php echo $proid?>/edit'><i class="entypo-pencil"></i><?php echo lang('web_edit')?></a>
                <?php
            }
      		  else
      			echo "Edit : No Access";
      		  ?>
            </td>
      		  <td width="60" style="padding: 0 10px;">
            <!-- <a class="btn btn-danger" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>webinars/delete/<?php echo $webinar->id?>/<?php echo $proid?>'><?php echo lang('web_delete')?></a> -->
            <a class="btn btn-danger" onClick="return deleteconfirm(<?php echo $webinar->id?>,<?php echo $proid?>)" ><?php echo lang('web_delete')?></a>
            </td>
            </tr>
            <?php
            $i++;
            endforeach ?>
        
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="checkval" value=""/>
            </tbody>  
            <?php 
      }
      else
      {
          ?>
          <p class='text'><?php echo lang('web_no_elements');?></p>
          <?php
      }
      ?>
      </table>
</div>
</div>


<?php echo form_close(); ?>
<div class="containerpg">
  <div class="pagination"> <?php echo $this->pagination->create_links();  ?> </div>
</div>


</div>
</div>
</div>
</div>
<div style="clear:both;"></div>


<script>
      //(function(jQuery) {

        var $ =jQuery.noConflict();
        jQuery(document).ready(function() {
          var mySlidebars = new jQuery.slidebars();
          
          jQuery('.toggle-left').on('click', function() {
            mySlidebars.toggle('left');
            //jQuery('.container').css({"margin-left":"0"});

          });
          
          jQuery('.toggle-right').on('click', function() {
            mySlidebars.toggle('right');
          });
        });
      //}) (jQuery);
</script>

<script>
    function isChecked(isitchecked) 
    {
        if (isitchecked == true) {

        document.orderform.boxchecked.value++;

        } else {

        document.orderform.boxchecked.value--;
        }
    }

    function listItemTask(id, task) 
    {
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

    function submitbutton(pressbutton) 
    {
        var form = document.orderform;
        submitform ( pressbutton );
    }

    function submitform(pressbutton) 
    {
        if (pressbutton) 
        {
          document.orderform.task.value = pressbutton;
        }

        if (typeof document.orderform.onsubmit == "function") 
        {
          document.orderform.onsubmit();
        }

        if (typeof document.orderform.fireEvent == "function") 
        {
            document.orderform.fireEvent('submit');
        }
        document.orderform.submit();
    }

    function saveorder(n, task) 
    {
        checkAll_button(n, task);
    }

    function checkAll_button(n, task) 
    {
        if (!task) 
        {
            task = 'saveorder';
        }
        document.orderform.submit();
    }
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
  function deleteconfirm(id,pid)
       {         
         $j.confirm({
        title: 'Do you really want to delete webinar ?',
        content: ' ',
        confirm: function(){
            window.location.href = "<?php echo base_url(); ?>webinars/delete/"+id+"/"+pid;
           },
        cancel: function(){
                      return true;
                     }
              });  
                       
       }
</script>