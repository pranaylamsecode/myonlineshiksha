<div class="page-container" style="min-height:500px;">
  <div style="background-color: #F5F5F5; display:-webkit-box;">
    <?php
      $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
    ?>    

    <div class="main-content" style="min-height:500px;">
      <div class="row">
        <div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 12px; margin-left: 15px;"> 
          <a href="#" class="sidebar-collapse-icon with-animation"> 
          <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
          <i class="entypo-menu"></i> </a> 
        </div>


        <div class="col-md-12"> 
    <div class="panel panel-primary" data-collapsed="0"> 
      <div class="panel-heading"> 
        <div class="panel-title"><h3>Copy Course</h3></div> 
        
       
      </div> 
      <div class="panel-body"> 
      <!-- <form role="form" class="form-horizontal form-groups-bordered"> -->

<?php
$attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => '', 'role' => 'form');
echo form_open_multipart(base_url().'/programs/copy', $attributes);
?>
          <div class="form-group"> 
            <label class="col-sm-3 control-label">Select Course To Copy :</label> 
          <?php
          $comboCourse = $this->program_model->getCourseCombo();
          ?>
            <div class="col-sm-5"> 
            <select name='CbCourse' id='CbCourse' class='form-control'>
              <option value="" >-- Select Course To Copy --</option>
              <?php         
                foreach($comboCourse as $comboQz)
                {
                  ?>
              <option value="<?php echo $comboQz['id']?>" ><?php echo $comboQz['name'];?></option>
              <?php 
                }
                ?>
            </select>
              <!-- tooltip area --> 
            <span class="tooltipcontainer"> <span type="text" id="reg_quizz_published-target" class="tooltipicon"></span> <span class="reg_quizz_published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            <!--tip containt--> 
            <?php echo lang('course_to_copy');?> 
            <!--/tip containt--> 
            </span> </span> 
            <!-- tooltip area finish --> 
            </div> 
            <?php echo form_error('CbCourse'); ?>
           
          </div> 




          <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-5"> 
               <input type='submit' name='btnSubmit' id='btnSubmit' value='Copy Course' class='btn btn-success'>
               <a href="<?php echo base_url();?>manage/courses" class="btn btn-danger">Cancel</a> 
            </div> 
          </div> 
        </form> 
      </div> 
    </div> 
  </div> 
      </div>
    </div>
  </div>
</div>


<!-- tool tip script -->
<script type="text/javascript">

jQuery(document).ready(function(){
	jQuery('.tooltipicon').click(function(){
		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.closetooltip').click(function(){
	jQuery(this).parent().css('display','none');
	});
	});
</script>