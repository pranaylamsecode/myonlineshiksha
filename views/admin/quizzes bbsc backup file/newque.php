<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			
			<div class="clr"></div>

		</div>

		<div class="pagetitle icon-48-generic"><h2><?php echo 'Select Exam';?></h2></div>

	</div>

</div>

<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Select Exam
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
	
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<div class="radio">
								<label>
									
                                    
                                    <input type="radio" name="quiz_type" onclick="window.parent.location.href = '<?php echo base_url(); ?>admin/quizzes/create';" value="0">Regular Exam
&nbsp;&nbsp;
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="regular_quiz-target" class="tooltipicon"></span>
						<span class="regular_quiz-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('quizz_fld_regular-quiz');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="quiz_type" onclick="window.parent.location.href = '<?php echo base_url(); ?>admin/quizzes/create_final';" value="1">Final Exam
&nbsp;&nbsp;
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="newfinal_exam-target" class="tooltipicon"></span>
						<span class="newfinal_exam-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('quizz_fld_new-final-exam');?>
						<!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
								</label>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							
                             <a href='<?php echo base_url(); ?>admin/quizzes/' class='btn btn-default'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>


<!-- tool tip script -->
<script type="text/javascript">
var $ = jQuery;
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