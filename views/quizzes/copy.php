<header>
  <section class="breadcrumb">
<div class="container">

<span class="page-title">
<?php echo 'Copy Exam';?> 
</span>

<div class="bread-view">
<a href="<?php echo base_url(); ?>"><i class="entypo-home"></i></a>
<span class="ng-hide">/ </span>
<a href="#"><?php echo 'Copy Exam';?></a>
</div>

</div>
</section>
</header>

<div class="page-container" style="min-height:500px;">
  <div style="background-color: #F5F5F5; display:-webkit-box;">
    <?php
      $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
    ?>    

    <div class="main-content" style="min-height:500px;">
          <div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top: 0; margin-left: 20px;"> 
            <a href="#" class="sidebar-collapse-icon with-animation"> 
            <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition --> 
            <i class="entypo-menu"></i> </a> 
          </div>
      <div class="row">




      <div class="col-md-12"> 
    <div class="panel panel-primary" data-collapsed="0"> 
      <div class="panel-heading"> 
        
      <?php
$attributes = array('class' => 'tform', 'id' => '');
echo form_open_multipart(base_url().'/quizzes/copy', $attributes);
?>
      <div class="panel-body form-horizontal form-groups-bordered"> 


          <div class="form-group"> 
                      <label class='col-sm-3 control-label'>Select Exam To Copy :</label>
          <?php
$comboQuiz = $this->quizzes_model->getQuizCombo();
?>
          <div class="col-sm-5">
            <select class="form-control" name='CbQuiz' id='CbQuiz'>
              <option value="" >-- Select Exams To Copy --</option>
              <?php         
foreach($comboQuiz as $comboQz)
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
            <?php echo lang('quiz_to_copy');?> 
            <!--/tip containt--> 
            </span> </span> 
            <!-- tooltip area finish -->
            </div> 
          </div> 

          <div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-5"> 
              <?php echo form_error('CbQuiz'); ?>
          <input type='submit' name='btnSubmit' id='btnSubmit' value='Copy Quiz' class='btn btn-success'>
    <a style="margin-top:0px;" href="<?php echo base_url();?>manage-exams" class="btn btn-danger">Cancel</a> 
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