<?php
$CI =& get_instance();
$CI->load->model('program_model');
$author = $this->uri->segment(3);
$getProgram = $CI->program_model->getProgramAuthor($author);

$sessionarray = $this->session->userdata('logged_in');
?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/fusioncharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/fusioncharts.theme.fint.js"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "column2d",
        "renderAt": "chartContainer",
        "width": "100%",
        "height": "450",
        "dataFormat": "json",
        "dataSource":  {
          "chart": {
            "caption": "Enrolled Students To Courses",
            "subCaption": "Author : <?php echo $sessionarray['first_name'];?>",
            "xAxisName": "Course",
            "yAxisName": "Students(In Numbers)",
            "theme": "fint"
         },
         "data": [
		 <?php
			foreach($getProgram as $getProg)
			{
				$getEnrolled = $CI->program_model->getEnrolledUserCount($getProg['id']);
				
				?>
				{			
				   "label": "<?php echo $getProg['name']?>",
				   "value": "<?php echo $getEnrolled;?>"
				},
				<?php 
			}
			?>
          ]
      }

  });
revenueChart.render();
})
</script>
<section class="breadcrumb" style="padding: 0px 15px;">
	<div class="container">
    	<div class="row">                       
			<div class="col-sm-12">
            	<h2>Statistics</h2>
			</div>
		</div>
	</div>
</section>
<br />
                
<section class="container courses" style="min-height:500px">
	<div class="row">	
    	<div class="static_gp">
		<div id="chartContainer">Course Statistics will load here!</div>
        </div>
	</div>
</section>
