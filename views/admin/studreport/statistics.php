<?php
$CI =& get_instance();
$CI->load->model('programs_model');
//$author = $this->uri->segment(3);
//$getProgram = $CI->programs_model->getProgram();

$sessionarray = $this->session->userdata('loggedin');
?>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/fusioncharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/fusioncharts.theme.fint.js"></script>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "column2d",
        "renderAt": "chartContainer",
        "width": "800",
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
			foreach($programs as $getProg)
			{
				$getEnrolled = $CI->programs_model->getEnrolledUserCount($getProg->id);
				
				?>
				{			
				   "label": "<?php echo $getProg->name?>",
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

<section class="container courses" style="width:100%">
	<div class="row" >	
		<div id="chartContainer" style='text-align: center;'>Course Statistics will load here!</div>
	</div>
</section>
