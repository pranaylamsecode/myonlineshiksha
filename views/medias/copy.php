<div class="page-container" style="min-height:500px;">
  <div style="background-color: #F5F5F5; display:-webkit-box;">
    <div class="sidebar-menu sb-left"> 
      <!-- Your left Slidebar content. --> 
      <!-- Classes Examples -->
       <ul id="main-menu">
        <li class="root-level"><a href="<?php echo base_url(); ?>manage/courses"><span>Courses You Teach</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>manage-exams"><span>Your Question Papers</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>questions/manage"><span>Your Questions</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media-category/manage"><span>Media Category</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>course-media/manage"><span>Media Library</span></a></li>
        <li class="root-level"><a href="<?php echo base_url(); ?>student-course-report"><span>Certificates Approval</span></a></li>
      </ul>
    </div>
    <div class="main-content">
      <div class="row">
        <div class="sidebar-collapse sb-toggle-left"> <a href="#" class="sidebar-collapse-icon with-animation"> 
          <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
          <i class="entypo-menu"></i> </a> 
        </div>


<div class="col-md-12">
<div class="panel panel-primary" data-collapsed="0"> 
          <div class="panel-heading">
          <div class="panel-title" style="padding-bottom: 0px;">  
            <h3 style="margin-top: 0;">Copy Media Module</h3>
          </div>
          <div  class="panel-options">

          </div>  
        </div>


        <div class="panel-body form-horizontal form-groups-bordered"> 

          <?php
$attributes = array('class' => 'tform', 'id' => '');
echo form_open_multipart(base_url().'medias/copy', $attributes);
?>
        <div class="form-group">
          <label class='col-sm-3 control-label'>Select Media To Copy :</label>
          <?php
          $comboMedia = $this->medias_model->getMediaCombo();
          ?>
          <div class="col-sm-5">
            <select name='CbMedia' id='CbMedia'  class='form-control'>
              <option value="" >-- Select Media To Copy --</option>
              <?php         
                foreach($comboMedia as $comboMd)
                {
                  ?>
              <option value="<?php echo $comboMd['id']?>" ><?php echo $comboMd['name'];?></option>
              <?php 
                }
                ?>
            </select>
      <!-- tooltip area --> 
            <span class="tooltipcontainer"> <span type="text" id="reg_quizz_published-target" class="tooltipicon"></span> <span class="reg_quizz_published-target  tooltargetdiv" style="display: none;" > <span class="closetooltip"></span> 
            <!--tip containt--> 
            <?php echo lang('media_to_copy');?> 
            <!--/tip containt--> 
            </span> </span> 
            <!-- tooltip area finish --> 
            <?php echo form_error('CbMedia'); ?> <br />
           
            
          </div>
        </div>

          <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-5"> 
               <input type='submit' name='btnSubmit' id='btnSubmit' value='Copy Media' class='btn btn-success'>
            <a href="<?php echo base_url();?>manage-exams" class="btn btn-danger">Cancel</a> 
            </div> 
          </div> 
        </div>
</div></div>
        
      </div>
    </div>
  </div>
</div>
<script>
		//	(function($) {
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
		//	}) (jQuery);
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