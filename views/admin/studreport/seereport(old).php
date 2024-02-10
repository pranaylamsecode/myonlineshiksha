<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script> 
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
$certidetailarr=array('1'=>'No Certificate','2'=>'Complete all the lessons','3'=>'Pass the Final exam','4'=>'Pass The Exams In Average','5'=>'Finish All Lessons And Pass Final Exam','6'=>'Finish All Lessons And Exams In Average');
?>

<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
		<ul style="list-style:none; float: right;">
		<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
						<!--<a href="<?php echo base_url(); ?>admin/programs/enrolled/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">-->
						<a href="<?php echo base_url(); ?>admin/enrolled/users/<? echo $this->uri->segment(5); ?>" class="btn btn-blue">						
						<span class="icon-32-new">
						</span>
						Back</a>
						</li>
		</ul>
		<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Report Manager</h2></div>
		<h4>Course :- <?php echo $courseinfo->name;?></h4>
	</div>
</div>

<div style="text-align:center; margin-bottom:5px;"></div>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=2 class="text-center"><b>User Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td class="text-center">User ID</td>
				<td><?php echo $userinfo->id; ?></td>
			</tr>			
			<tr>
				<td class="text-center">User Name</td>
				<td><?php echo $userinfo->username; ?></td>				
			</tr>			
			<tr>
				<td class="text-center">Full Name</td>
				<td><?php echo $userinfo->first_name .' '. $userinfo->last_name; ?></td>				
			</tr>			
			<tr>
				<td class="text-center">Email</td>
				<td><?php echo $userinfo->email; ?></td>				
			</tr>			
		</tbody>
</table>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=2 class="text-center"><b>Course Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td class="text-center">Course ID</td>
				<td><?php echo $courseinfo->id; ?></td>
			</tr>			
			<tr>
				<td class="text-center">Trainer</td>
				<td><?php echo (($courseinfo->author)?$this->programs_model->getUserName($courseinfo->author):'');?></td>				
			</tr>			
			<tr>
				<td class="text-center">Has Final Exam</td>
				<td><?php echo (($courseinfo->id_final_exam)?'Yes':'No');?></td>				
			</tr>			
			<tr>
				<td class="text-center">Has Certificate</td>
				<td><?php echo (($courseinfo->certificate_term=='1')?'No':'Yes');?></td>				
			</tr>			
		</tbody>
</table>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=10 class="text-center"><b>Exam Details</b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td colspan=4 class="text-center">Final Exam Completed</td>
				<td colspan=6><?php echo ((@$finalexamcompleted == 'Pass') ? 'Yes' : 'No');?></td>
			</tr>	
		</tbody>

		<thead>
			<tr>
				<th class="text-center">Attempt</th>
				<th class="text-center">Exam Name</th>
				<th class="text-center">Exam Type</th>
				<th class="text-center">Passing Min Score(%)</th>
				<th class="text-center">Exam Score(%)</th>
				<th class="text-center">Result</th>
				<th class="text-center">Exam On</th>
				<th class="text-center">Moderate Exam</th>
				<th class="text-center">Actions</th>
				<th class="text-center">Archive</th>
			</tr>
		</thead>	
		
		<tbody>
		<?php 
		//ECHO '<PRE>';print_r($coursequizinfo);ECHO '</PRE>';

		foreach($coursequizinfo as $eachquiz)
        {
		?>
			<tr>
				<td><?php echo $eachquiz['attempt_no'];?></td>
				<td><a href="<?php echo base_url()?>admin/studreport/viewexam/<?php echo $eachquiz['id']; ?>/<?php echo $eachquiz['attempt_code']; ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>"><?php echo ucfirst($this->programs_model->getQuizNameById($eachquiz['quiz_id']));?></a></td>
				<?php
					if($eachquiz['snapfoldername'] !='')
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
				<td><?php echo $maxscore=$this->programs_model->getQuizMaxScoreById($eachquiz['quiz_id']);?></td>
				<td><?php
					if($eachquiz['score_quiz'])
					{
	                    list($rq,$tq)=explode('|',$eachquiz['score_quiz']);
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
					if($eachquiz['result'] == 'Pending')
					{
						$user = $this->uri->segment(4);
						$program = $this->uri->segment(5);
						$quiz = $eachquiz['quiz_id'];
						$attempt = $eachquiz['attempt_no'];
						?>
						<td><a href='<?php echo base_url(); ?>admin/studreport/pendings/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>'><?php echo $eachquiz['result'];?></a></td>
						<?php
					}
					else if($eachquiz['result'] == '')//for recalculating
					{
						$user = $this->uri->segment(4);
						$program = $this->uri->segment(5);
						$quiz = $eachquiz['quiz_id'];
						$attempt = $eachquiz['attempt_no'];
						$attempt_code = $eachquiz['attempt_code'];
						?>
						<td><a href='<?php echo base_url(); ?>admin/studreport/recalculate/<?php echo $user;?>/<?php echo $program;?>/<?php echo $quiz;?>/<?php echo $attempt;?>/<?php echo $attempt_code;?>'>Re-Calculate</a></td>
						<?php
					}
					else
					{
						?>
						<td><?php echo $eachquiz['result'];?></td>
						<?php
					}
				?>
				
				<td><?php echo $eachquiz['date_taken_quiz'].' GMT'; ?></td>
				<td><a href="<?php echo base_url()?>admin/studreport/viewexam/<?php echo $eachquiz['id']; ?>/<?php echo $eachquiz['attempt_code']; ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>">View Exam</a></td>
				<td><?php
                $webcamstatus=$this->programs_model->checkWebcamStatus($eachquiz['pid']);
                if($webcamstatus)
                {
                    if($eachquiz['snapfoldername'] !='')
                    {
                    ?>
                    <a  href="<?php echo base_url(); ?>admin/studreport/viewsnap/<?php echo $eachquiz['snapfoldername'].'/'.$eachquiz['attempt_no'].'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$eachquiz['attempt_code'];?>" style='text-decoration:none' class='viewsnap'>View Snap</a>
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
                <td>
                	<input type="checkbox" onclick="getRadioVal('<?php echo $eachquiz['id']; ?>')" name="archive<?php echo $eachquiz['id']; ?>" id="archive<?php echo $eachquiz['id']; ?>" <?php if($eachquiz['archive'] == '1') { echo 'checked';}?>  value="<?php echo $eachquiz['archive']; ?>" /><span id="span<?php echo $eachquiz['id']; ?>" style="color:green;"></span>

                </td>
			</tr>		
		<?php
		}
		?>
		</tbody>
</table>

<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan=2 class="text-center"><b>Certificate Details<b></th>
			</tr>
		</thead>		
		<tbody>
			<tr>
				<td class="text-center">Certificate Term</td>
				<td><?php 
					//print_r($courseinfo->certificate_term);
					$ct=$courseinfo->certificate_term;
                    echo $certidetailarr[$ct];
					?></td>
			</tr>			
			
<?php
$certiStatus=$this->programs_model->checkCertificateStatus($userinfo->id,$courseinfo->id);
if($certiStatus)
{
?>
	<tr>
		<td class="text-center">Status</td>
		<td>Satisfies all certificate terms</td>			
	</tr>	

	<tr>
	<td class="text-center">Issued</td>
	<td align='left'>Yes</td>
	</tr>

	<tr>
	<td class="text-center">Issued By</td>
	<td align='left'><?php echo $this->programs_model->getUserName($certiStatus->issued_by); ?></td>
	</tr>
	
	<tr>
	<td class="text-center">Issued On</td>
	<td align='left'><?php echo $certiStatus->issued_on.' GMT';?></td>
	</tr>

	<!--<tr>
	<td></td>
	<td align='left'>
	<a href="<?php echo base_url(); ?>admin/studreport/rejectcerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Reject Certificate</a>
	</td>
	</tr>-->
	<?php
}
else
{
	$statusCerti = $this->Studreport_model->getCompletedStatus($userinfo->id,$courseinfo->id);
	
	if(@$courseinfo->certificate_term == @$statusCerti->certificate_term && @$statusCerti->completed == '1')
	{
	?>
	<tr>
		<td class="text-center">Status</td>
		<td>Satisfies all certificate terms</td>				
	</tr>	
	<tr>
		<td></td>
		<td align='left'>
		<a href="<?php echo base_url(); ?>admin/studreport/aprovecerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Approve Certificate</a>
		</td>
	</tr>
	<?php
	}else
	{
		?>
			<!-- <tr>
				<td class="text-center">Status</td>
				<td>Not Satisfying all certificate terms</td>				
			</tr> -->	

			<!-- new code start here -->

			<?php
			// echo"<pre>";  
   //      	 print_r($coursequizinfo2);
			$ct=$courseinfo->certificate_term;		
        	if( $ct == 3 && $coursequizinfo2)
        	{ 	
        		  
        		 			
        			if($coursequizinfo2)
        			{
        				
        				?>
        				<tr>
							<td class="text-center">Status</td>
							<td>Satisfies all certificate terms</td>				
	   					</tr>	
	    				<tr>
							<td></td>
							<td align='left'>
							<a href="<?php echo base_url(); ?>admin/studreport/aprovecerti/<?php echo $userinfo->id; ?>/<?php echo $courseinfo->id; ?>" style='text-decoration:none'>Approve Certificate</a>
							</td>
	   					 </tr>
        				<?php        				
        			}
        					
        	    
            }
          else
           { 
		 ?>
						<tr>
							<td class="text-center">Status </td>
							<td>Not Satisfying all certificate terms</td>				
						</tr> 
			<!-- new code end here -->
		<?php
	     }
	}
}
?>
</tbody>
</table>


<script>
	function getRadioVal(id)
	{
	
		var arc_val = document.getElementById('archive'+id).value;

		if(arc_val == '0')
		{
			document.getElementById('archive'+id).value = '1';
		}
		else
		{
			document.getElementById('archive'+id).value = '0';
		}
		

		    $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>admin/studreport/doArchive",
            data: {'id':id,'arc_val':arc_val}, 
            success: function(response) 
			{
                
				
				if(response =='archived')
				{
					
				$("#span"+id).html('archived');
				setTimeout(
						function() 
						{
							
						$("#span"+id).slideUp('slow');

						}, 2500);
				$("#span"+id).show();
			}
			else
			{
				
				$("#span"+id).html('Unarchived');
				setTimeout(
						function() 
						{
							
						$("#span"+id).slideUp('slow');

						}, 2500);
				$("#span"+id).show();
			}
			}
		});


	}
</script>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
               <script>
                  var $j = jQuery.noConflict();
                       $j(document).ready(function(){
                               //Examples of how to assign the Colorbox event to elements
                               
                         //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});                        
                       $j(".viewsnap").colorbox({
                               iframe:true,
                               width:"700px", 
                               height:"100%",
                               fadeOut:500,
                               fixed:true,
                               reposition:true,                                                                  
                                               })
                   });
                        </script>