<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script> 
<script type="text/javascript">
var $ = jQuery;
		$(document).ready(function() 
		{
		$('.fancybox').fancybox();
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();
			/*
			 *  Different effects
			 */
			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});
			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',
				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color

			$(".fancybox-effects-c").fancybox({

				wrapCSS    : 'fancybox-custom',

				closeClick : true,

				openEffect : 'none',

				helpers : {

					title : {

						type : 'inside'

					},

					overlay : {

						css : {

							'background' : 'rgba(238,238,238,0.85)'

						}

					}

				}

			});


			// Remove padding, set opening and closing animations, close if clicked and disable overlay

			$(".fancybox-effects-d").fancybox({

				padding: 0,

				openEffect : 'elastic',

				openSpeed  : 150,

				closeEffect : 'elastic',

				closeSpeed  : 150,

				closeClick : true,

				helpers : {

					overlay : null

				}

			});

			/*

			 *  Button helper. Disable animations, hide close button, change title type and content

			 */

			$('.fancybox-buttons').fancybox({

				openEffect  : 'none',

				closeEffect : 'none',

				prevEffect : 'none',

				nextEffect : 'none',

				closeBtn  : false,

				helpers : {

					title : {

						type : 'inside'

					},

					buttons	: {}

				},

				afterLoad : function() {

					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');

				}

			});

			/*

			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked

			 */

			$('.fancybox-thumbs').fancybox({

				prevEffect : 'none',

				nextEffect : 'none',

				closeBtn  : false,

				arrows    : false,

				nextClick : true,

				helpers : {

					thumbs : {

						width  : 50,

						height : 50

					}

				}

			});

			/*

			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.

			*/

			$('.fancybox-media')

				.attr('rel', 'media-gallery')

				.fancybox({

					openEffect : 'none',

					closeEffect : 'none',

					prevEffect : 'none',

					nextEffect : 'none',

					arrows : false,

					helpers : {

						media : {},

						buttons : {}

					}

				});

			/*

			 *  Open manually

			 */

			$("#fancybox-manual-a").click(function() {

				$.fancybox.open('1_b.jpg');

			});

			$("#fancybox-manual-b").click(function() {

				$.fancybox.open({

					href : 'iframe.html',

					type : 'iframe',				

					padding : 5

				});

			});


			$("#fancybox-manual-c").click(function() {

				$.fancybox.open([

					{

						href : '1_b.jpg',

						title : 'My title'

					}, {

						href : '2_b.jpg',

						title : '2nd title'

					}, {

						href : '3_b.jpg'

					}

				], {

					helpers : {

						thumbs : {

							width: 75,

							height: 50

						}

					}

				});

			});
		});
	</script> 
<?php 
$this->load->model('admin/programs_model');
$this->load->model('admin/studreport_model');

?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
		<ul style="list-style:none; float: right;">
		<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
						<!--<a href="<?php echo base_url(); ?>admin/programs/enrolled/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">-->
						<a href="<?php echo base_url(); ?>admin/studreport/viewusers/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">						
						<span class="icon-32-new">
						</span>
						Back</a>
						</li>
		</ul>
		<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Exam Details</h2></div>
		<h4>Exam :- </h4>
	</div>
</div>

<div style="text-align:center; margin-bottom:5px;"></div>

<table class="table table-bordered">
		

		 <thead>
                    <tr class="guru_orderhead">
                        <th width="15%">Question No.</th>
                         <th width="15%">Question</th>
                        <th width="15%">Question Type</th>
                        <th width="15%">Correct Answer</th>   
                        <th width="15%">Given Answer</th>   
                                      
           
                    </tr>
                </thead>
		
		<tbody>
				<?php
				 

				   $iii = 1;
					foreach($activeData as $examinfo)
					{
						$ques_opt = $this->questions_model->getAnsOptions($examinfo->question_id);

						$questionData =  $this->questions_model->getQuestions($examinfo->question_id);
                        
                      
						 $answer = $this->questions_model->getAnswer($examinfo->question_id,$questionData->question_type);
                  						
				?>
			<tr>
				<td><?php echo $iii;   ?></td>
				<td><?php echo $examinfo->question; ?></td>
				<td><?php echo $questionData->question_type; ?></td>
				<td><?php echo $answer; ?></td>
					<?php
						if($questionData->question_type == 'true_false' || $questionData->question_type == 'subjective' )
						{
					?>
				<td><?php echo $examinfo->answers_gived; ?></td>
					<?php
						}
						else
						{
					?>
				<td><?php echo $this->questions_model->getgivenAns($examinfo->answers_gived); ?></td>
					<?php
						}
					?>
				
			</tr>
			<?php
					 $iii++;
				}
			?>
		
		</tbody>
</table>

<table class="table table-bordered">
		
		<thead>
			<tr>
				<th class="text-center">Attempt</th>
				<th class="text-center">Exam Name</th>
				<th class="text-center">Exam Type</th>
				<th class="text-center">Passing Min Score(%)</th>
				<th class="text-center">Exam Score(%)</th>
				<th class="text-center">Result</th>
				<th class="text-center">Exam On</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>	
		
		<tbody>
		<?php 
	//	ECHO '<PRE>';print_r($quizdetail);ECHO '</PRE>';

		
		?>
			<tr>
				<td><?php echo $quizdetail->attempt_no;?></td>
				<td><?php echo ucfirst($this->programs_model->getQuizNameById($quizdetail->quiz_id));?></td>
				<?php
					if($quizdetail->snapfoldername !='')
                    {
				?>				
				<td>Final Exam</td>
				<?php
					}
					else
					{
				?>
				<td>Regular Exam</td>
				<?php
					}
				?>
				
				
				<td><?php echo $maxscore=$this->programs_model->getQuizMaxScoreById($quizdetail->quiz_id);?></td>
				<td><?php
					if($quizdetail->score_quiz)
					{
	                    list($rq,$tq)=explode('|',$quizdetail->score_quiz);
	                    if($rq == '0' || $tq == '0')
	                    {
	                      echo '0';
	                    }
	                    else
	                    {
	                       $avg=($rq/$tq)*100;
	                       echo round($avg,2);
	                    }
	                }else
	                {
	                	echo '';
	                }
                    ?></td>
				
				<?php
					if($quizdetail->result == 'Pending')
					{
						$user = $this->uri->segment(6);
						$program = $this->uri->segment(7);
						$quiz = $quizdetail->quiz_id;
						$attempt = $quizdetail->attempt_no;
						?>
						<td><?php echo $quizdetail->result;?></td>
						<?php
					}
					else if($quizdetail->result == '')//for recalculating
					{
						$user = $this->uri->segment(6);
						$program = $this->uri->segment(7);
						$quiz = $quizdetail->quiz_id;
						$attempt = $quizdetail->attempt_no;
						$attempt_code = $quizdetail->attempt_code;
						?>
						<td>Re-Calculate</td>
						<?php
					}
					else
					{
						?>
						<td><?php echo $quizdetail->result;?></td>
						<?php
					}
				?>
				
				
				
				<td><?php echo $quizdetail->date_taken_quiz.' GMT'; ?></td>
				<td><?php
                $webcamstatus=$this->programs_model->checkWebcamStatus($quizdetail->pid);
                if($webcamstatus)
                {
                    if($quizdetail->snapfoldername !='')
                    {
                    ?>
                    <a class='<?php echo "fancybox fancybox.iframe";?>' href="<?php echo base_url(); ?>admin/studreport/viewsnap/<?php echo $quizdetail->snapfoldername.'/'.$quizdetail->attempt_no.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$quizdetail->attempt_code;?>" style='text-decoration:none' class='fancybox fancybox.iframe'>View Snap</a>
					<?php
                    }
                    else
                    {
                      echo "No Snaps";
                    }
                }
                else
                {
                    echo "No Snaps";
                }
                ?></td>
			</tr>		
		
		</tbody>
</table>

