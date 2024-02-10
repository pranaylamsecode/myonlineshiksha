<div class="page-container">
<div class="sidebar-menu">
	<ul id="main-menu" class="" style="min-height:820px;">
              <li class="root-level"><a href="<?php echo base_url(); ?>programs/lists/"><span>My Courses</span></a></li>  
              <li class="root-level"><a href="<?php echo base_url(); ?>quizzes/"><span>My Quizzes</span></a></li>   
              <li class="root-level"><a href="<?php echo base_url(); ?>mcategories/"><span>Media Category</span></a></li>  
              <li class="root-level"><a href="<?php echo base_url(); ?>medias/"><span>Media Library</span></a></li>
      </ul>
</div>


<div class="main-content" style="min-height: 820px;">
	<div class="row">

<div class="sidebar-collapse" style="float: left; margin-top:5px; margin-right:20px; margin-bottom:10px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<div>
		
		<div style="display: inline-block;">
		
			<div>
				<div class="panel-title">
					<h4>Select Quizzes</h4>
				</div>
				
			
			</div>
            <hr />
			
			<div style="margin:20px 0;">
				
				<form role="form">
	
					
					
							<div>
								<label style="width:auto; padding:0;">
									
                                    
                                    <input type="radio" name="quiz_type" onclick="window.parent.location.href = '<?php echo base_url(); ?>quizzes/create';" value="0">&nbsp;&nbsp;Regular quiz
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
							<div>
								<label  style="width:auto; padding:0;">
									<input type="radio" name="quiz_type" onclick="window.parent.location.href = '<?php echo base_url(); ?>quizzes/create_final';" value="1">&nbsp;&nbsp;New Final Exam
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
				
					
					
						<div>
							
                             <a href='<?php echo base_url(); ?>quizzes/' class='btn-primary_rockon'>Cancel</a>
						</div>
				
				</form>
				
			</div>
		
		</div>
	
	</div>
	</div>
	
	</div>
</div>


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