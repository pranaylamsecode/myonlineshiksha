<script type="text/javascript">
function deleteRow(){
    if (!document.getElementsByTagName || !document.createTextNode) return;
    var rows = document.getElementById('quizzestoaddlist').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (i = 0; i < rows.length; i++) {
        rows[i].onclick = function() {
            //alert(this.rowIndex);
			if(this.rowIndex != 0)
			document.getElementById('quizzestoaddlist').deleteRow(this.rowIndex);
        }
    }
}
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
					<script src="//code.jquery.com/jquery-1.10.2.js"></script>
					<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
					<script>
					$(function() {
					$( "#startpublish" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
					$( "#endpublish" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
					});
					</script>
<!--lightbox scripts and style



	<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>-->



	<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>



	<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>



    <script src="<?php echo base_url()?>public/js/jquery.tablednd.js"></script>



<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />-->



<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>











<script>



 $(document).ready(



 function()



 {



   //	$('#description').redactor();



 }



 );



 </script>



<!--<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">



<link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">



	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />-->

 

	<script type="text/javascript">



		$(document).ready(function() {



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











      $(document).ready(function() {



         $("span.error").each(function() {



         var parent = $(this).closest('dd').attr('sno');



         var get_error = $(this).text();



          if(get_error != ''){



                $(this).closest('dd').prev('dt').css('background-color', 'red');



           }







        });







     });















	</script>



	<style type="text/css">



		.fancybox-custom .fancybox-skin {



			box-shadow: 0 0 50px #222;



		}



	</style>



<!--/lightbox scripts and style-->




<div class="page-container">

<div class="sidebar-menu">
	<ul id="main-menu" class="" style="min-height:820px;">
              <li class="root-level"><a href="<?php echo base_url();?>programs/lists/"><span>My Courses</span></a></li>  
              <li class="root-level"><a href="<?php echo base_url();?>quizzes/"><span>My Quizzes</span></a></li>   
              <li class="root-level"><a href="<?php echo base_url();?>mcategories/"><span>Media Category</span></a></li>  
              <li class="root-level"><a href="<?php echo base_url();?>medias/"><span>Media Library</span></a></li>
      </ul>
</div>

<div class="main-content" style="min-height: 820px;">
<div class="row">

<div class="sidebar-collapse" style="float: left; margin-top:10px; margin-right:20px; margin-bottom:10px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<div style="display:block;">
	<h3 style="float:left;"><?php echo ($updType == 'create') ? 'Add quiz' : 'Edit quiz'?></h3>

	<div style="float:right;">
	<a><?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?></a>
	<a href='<?php echo base_url(); ?>quizzes/newque' class='btn btn-danger'>Cancel</a>
	</div>
</div>
		
<div class="clr"></div>
<hr />



    <h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>



    <?php if($updType != 'edit'){



	$qid = '';



	}?>







<script type="text/javascript">



			$(function(){



				$('dl.tabs dt').click(function(){



					$(this)



						.siblings().removeClass('selected').end()



						.next('dd').andSelf().addClass('selected');



				});



			});



</script>




<?php



//print_r($quiz);



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'create') ? form_open_multipart('quizzes/create_final', $attributes) : form_open_multipart('quizzes/editFinalQuiz/'.$qid, $attributes);



?>


<div class="col-md-12">
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active">
				<a href="#home" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">General</span>
				</a>
			</li>
			<li>
				<a href="#profile" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Questions</span>
				</a>
			</li>
			<li>
				<a href="#messages" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-mail"></i></span>
					<span class="hidden-xs">Publishing</span>
				</a>
			</li>
			<!--<li>
				<a href="#settings" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Settings</span>
				</a>
			</li>-->
		</ul>
		
<div class="tab-content">

<div class="tab-pane active" id="home">

	<div class="tab-content">				
	
			<div class="panel-body">
				
				<form role="form" class="form-horizontal form-groups-bordered">
				
                <?php if($updType == 'create'){ ?>
				<legend style="font-size: 16px;">New Quiz</legend>
				<?php } ?>
				<?php if($updType == 'edit'){ ?>
				<legend style="font-size: 16px;">Edit Quiz</legend>
				<?php } ?>
                
					<div class="form-group">
						
                        <label class='col-sm-3 control-label' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						
						<div class="col-sm-5">
							
                            <input id="name" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($quiz->name)) ? $quiz->name : ''); ?>"  />



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_name-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-name');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->



                    <span class="error"><?php echo form_error('name'); ?></span>
						</div>
					</div>
                    <br />
                    <br />
                    <br />
                    <br />
                 
					
					<div class="form-group">
						
						<label class="col-sm-3 control-label" for="description"><?php echo lang('web_description')?></label>




						<div class="col-sm-5">
							
                            <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''));?>
						<textarea id="description"  name="description" rows="6"/><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>
						<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_desc-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-description');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>
                     <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
               
                    
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Minimum score to pass the quiz :</label>
						
						<div class="col-sm-2" style="float:left;">
                            
                            <input type="text" style="float:left !important;" value="<?php echo set_value('max_score_pass', (isset($quiz->max_score)) ? $quiz->max_score : ''); ?>" size="6" name="max_score_pass" id="max_score_pass" class="form-control">&nbsp;

                        </div>  
                        <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;%&nbsp;&nbsp;</span>
                        <div class="col-sm-2" style="float:left;">
                            
                        <select style="float:left !important;" name="show_max_score_pass" id="show_max_score_pass">

                            <option value="0" <?php echo  preset_select('show_max_score_pass', (isset($quiz->pbl_max_score)) ? $quiz->pbl_max_score : '' , '0' ) ?>>Show</option>

                            <option value="1" <?php echo  preset_select('show_max_score_pass', (isset($quiz->pbl_max_score)) ? $quiz->pbl_max_score : '' , '1')  ?>>Hide</option>

						</select>  
						</div>
                        <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_show_max_score_pass-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_show_max_score_pass-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-max-score-pass');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                        <span class="error"><?php echo form_error('max_score_pass'); ?></span>
					</div>
                    <br />
                    <br />
            
                  
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Exam can be taken up to :</label>
						
						<div class="col-sm-2" style="float:left;">
							
                            <select style="float:left !important;" name="nb_quiz_taken" id="nb_quiz_taken">



                            <option value="1" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "1"){echo 'selected="selected"'; }?> >1</option>



                            <option value="2" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "2"){echo 'selected="selected"'; }?> >2</option>



                            <option value="3" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "3"){echo 'selected="selected"'; }?> >3</option>



                            <option value="4" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "4"){echo 'selected="selected"'; }?> >4</option>



                            <option value="5" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "5"){echo 'selected="selected"'; }?> >5</option>



                            <option value="6" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "6"){echo 'selected="selected"'; }?> >6</option>



                            <option value="7" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "7"){echo 'selected="selected"'; }?> >7</option>



                            <option value="8" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "8"){echo 'selected="selected"'; }?> >8</option>



                            <option value="9" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "9"){echo 'selected="selected"'; }?> >9</option>



                            <option value="10"<?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "10"){echo 'selected="selected"'; }?> >10</option>



                            <option value="11" <?php if(isset($quiz->time_quiz_taken) && $quiz->time_quiz_taken == "11"){echo 'selected="selected"'; }?>>Unlimited</option>



					</select>


                          </div>
						<span style="float:left !important;padding-top:4px;padding-left:2px;">&nbsp;&nbsp;Times&nbsp;&nbsp;</span>
                        <div class="col-sm-2" style="float:left;">  
                           
						<select style="float:left !important;" name="show_nb_quiz_taken" id="show_nb_quiz_taken">



                           <option value="0" <?php echo  preset_select('show_nb_quiz_taken', (isset($quiz->show_nb_quiz_taken)) ? $quiz->show_nb_quiz_taken : '' , '0' ) ?>>Show</option>



                           <option value="1" <?php echo  preset_select('show_nb_quiz_taken', (isset($quiz->show_nb_quiz_taken)) ? $quiz->show_nb_quiz_taken : '' , '1')  ?>>Hide</option>

						</select>
						</div>
                        
<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_show_nb_quiz_taken-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_show_nb_quiz_taken-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-show_nb_quiz_taken');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
					</div>
                    <br />
                    <br />
                 
                 
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Select up to :</label>
						
						<div class="col-sm-2" style="float:left;">
                            <select class="form-control" style="float:left !important;" name="nb_quiz_select_up" id="nb_quiz_select_up">
								<option value="1">1</option>
							</select>
						</div>
                        
                          <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;of the questions randomly to construct the exam&nbsp;&nbsp;</span>
						
                        <div class="col-sm-2" style="float:left;">  
                            
						<select style="float:left;" name="show_nb_quiz_select_up" id="show_nb_quiz_select_up">

                             <option value="0" <?php echo  preset_select('show_nb_quiz_select_up', (isset($quiz->show_nb_quiz_select_up)) ? $quiz->show_nb_quiz_select_up : '' , '0' ) ?>>Show</option>

                            <option value="1" <?php echo  preset_select('show_nb_quiz_select_up', (isset($quiz->show_nb_quiz_select_up)) ? $quiz->show_nb_quiz_select_up : '' , '1')  ?>>Hide</option>
							
						</select>

						</div>
                        <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_show_nb_quiz_select_up-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_show_nb_quiz_select_up-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-show_nb_quiz_select_up');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
                            
					</div>
                    <br />
                    <br />
                  
                   
                    <legend style="font-size: 16px;">Timer:</legend>
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Limit time for exam :</label>
						
						<div class="col-sm-2" style="float:left;">
                            <input type="text" style="float:left" value="<?php echo set_value('limit_time_l', (isset($quiz->limit_time)) ? $quiz->limit_time : ''); ?>" maxlength="255" size="5" name="limit_time_l" id="limit_time_l">
                        </div>
                        <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;Minutes&nbsp;&nbsp;</span>  
                        <div class="col-sm-2" style="float:left;">
                           
						<select class="form-control" style="float:left !important;" name="show_limit_time" id="show_limit_time">

							<option value="0" <?php echo  preset_select('show_limit_time', (isset($quiz->show_limit_time)) ? $quiz->show_limit_time : '' , '0' ) ?>>Show</option>

                            <option value="1" <?php echo  preset_select('show_limit_time', (isset($quiz->show_limit_time)) ? $quiz->show_limit_time : '' , '1')  ?>>Hide</option>

						</select>   
						</div>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_show_limit_time-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_show_limit_time-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-show_limit_time');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                     <span class="error"><?php echo form_error('limit_time_l'); ?></span>
					</div>
                    <br />
                    <br />
                    <br />
           
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Show count down :</label>
						
						<div class="col-sm-5">
						
						<select style="float:left !important;" name="show_countdown" id="show_countdown">

							<option value="0" <?php echo  preset_select('show_countdown', (isset($quiz->show_countdown)) ? $quiz->show_countdown : '' , '0' ) ?>>Show</option>

                            <option value="1" <?php echo  preset_select('show_countdown', (isset($quiz->show_countdown)) ? $quiz->show_countdown : '' , '1')  ?>>Hide</option>

						</select>


						</div>
                        

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_show_countdown-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_show_countdown-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-show_countdown');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
					</div>
                    <br />
                    <br />
                
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Time finished alert :</label>
						
						<div class="col-sm-2" style="float:left;">
							
                            <input type="text" style="float:left !important;" value="<?php echo set_value('limit_time_f', (isset($quiz->limit_time_f)) ? $quiz->limit_time_f : ''); ?>" maxlength="255" size="5" name="limit_time_f" id="limit_time_f" class="form-control">
                        </div>
                        <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;Minutes before the time is up&nbsp;&nbsp;</span>  
                        <div class="col-sm-2" style="float:left;">
                            
                            <select style="float:left !important;" name="show_finish_alert" id="show_finish_alert">

                            <option value="0" <?php echo  preset_select('show_finish_alert', (isset($quiz->show_finish_alert)) ? $quiz->show_finish_alert : '' , '0' ) ?>>Show</option>

                            <option value="1" <?php echo  preset_select('show_finish_alert', (isset($quiz->show_finish_alert)) ? $quiz->show_finish_alert : '' , '1')  ?>>Hide</option>

							</select>

						</div>
                        <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_show_finish_alert-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_show_finish_alert-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-show_finish_alert');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                    <span class="error"><?php echo form_error('limit_time_f'); ?></span>
					</div>
               		<br />
                    <br />
			
				</form>
				
			</div>
		
	</div>
		
</div>
                
<div class="tab-pane" id="profile">
<div class="panel-body">
		<?php if($updType == 'create'){ ?>

		 <legend style="font-size: 16px;">New Quiz</legend>

         <?php } ?>

         <?php if($updType == 'edit'){ ?>

		 <legend style="font-size: 16px;">Edit Quiz</legend>

         <?php } ?>
	
<!--<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
        	
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 239px;">Student Name</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" style="width: 125px;">Average Grade</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 299px;">Curriculum / Occupation</th>
            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Actions</th>
            
		</tr>
	</thead>
	
	
	<tbody role="alert" aria-live="polite" aria-relevant="all">

		<tr class="odd">
			
			<td class=" ">Randy S. Smith</td>
			<td class=" ">8.7</td>
			<td class=" ">Social and human service</td>
			<td class=" ">
				<a href="#" class="btn btn-default btn-sm btn-icon icon-left">
					<i class="entypo-pencil"></i>
					Edit
				</a>
				
				<a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
					<i class="entypo-cancel"></i>
					Delete
				</a>
			</td>
		</tr>
	</tbody>
</table>-->                
   
<div class="tab-content">

    <form class="adminform form-horizontal form-groups-bordered">

        <table class="table table-bordered responsive">

		<tbody>
             
            <tr>
             
                <td>

					<div>

                        <div style="float:left;">

                            <a href='<?php echo base_url(); ?>/quizzes/quizesaddlist/<?php echo ($qid != "")  ? $qid : "0"?>' class='fancybox fancybox.iframe btn btn-primary'><i class="entypo-plus"></i>Add Quiz</a>&nbsp;

                        </div>

                	</div>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_add_quiz-target" class="tooltipicon"></span>

						<span class="final_quizz_add_quiz-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-add_quiz');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

					<br/>

					<br/>

				<!--<script type="text/javascript">

				$(document).ready(function(){

					$(".removeele").live('click',function(){

					var id = $(this).attr("id");

					id = id.substr(6);

					$("#qli"+id).remove();

					});

				});

				</script>

                <script type="text/javascript">

                    $(document).ready(function() {

                        $("#quizzestoaddlist").tableDnD();

                    });


                    function adddragable(){

                     $("#quizzestoaddlist").tableDnD();

                    }

                    </script>-->

                <div id="quiz_div" style="clear: left;">

			        <table id="quizzestoaddlist" class="table table-bordered responsive">

						<thead>

                        <tr>

								<th>Id</th>

								<th>Questions</th>

								<th>Remove</th>

								<!--<th>Edit</th>-->

								<span class="error" id="error_21"><?php echo form_error('qidck'); ?></span>

                        </tr>
                          
                        </thead>
                        <?php

                          if($updType == 'create' && isset($get_quiz_ids) && $get_quiz_ids!= ''){

                                foreach($get_quiz_ids as $get_quiz_id){

                                $quizzInfoById = $this->quizzes_model->getItems($get_quiz_id); ?>

                                <tr id="qli<?php echo $get_quiz_id;?>" class="quizrow">

									<td>

                                      <?php echo $get_quiz_id;?>



                                  </td>



                                  <td>



                                      <?php echo (isset($quizzInfoById->name)) ? $quizzInfoById->name : '';?>



                                 </td>



                                 <td>



                                     <span class="removespan">



                                     <a href="javascript:void(0);" class="removeele" id="remove<?php echo $get_quiz_id;?>">Remove</a>                       <input type="hidden" value="<?php echo $get_quiz_id;?>" name="qidck[]" id="qidck">



                                  </span>



                                </td>



                             </tr>







                              <?php //}



                               }



                          }



                          if($updType == 'edit'){



                              if(isset($get_quiz_ids) && $get_quiz_ids!= ''){



                              $quizzInfoById = $this->quizzes_model->getItems($get_quiz_id);



                                 foreach($quizzInfoById as $quizzInfo){   ?>



                                  <tr id="qli<?php echo $get_quiz_id;?>" class="quizrow">



                                    <td>



                                        <?php echo $get_quiz_id;?>



                                    </td>



                                    <td>



                                        <?php echo (isset($quizzInfo->name)) ? $quizzInfo->name : '';?>



                                    </td>



                                    <td>



                                       <span class="removespan">



                                       <a href="javascript:void(0);" class="removeele" id="remove<?php echo $get_quiz_id;?>">Remove</a>                <input type="hidden" value="<?php echo $get_quiz_id;?>" name="qidck[]" id="qidck">



                                    </span>



                                   </td>



                               </tr>



                                <?php }



                              }else{



                            $quizzes_id = (isset($quizzes->quizzes_ids)) ? $quizzes->quizzes_ids : '';



                            $quizzarray = explode(',',$quizzes_id);



                           // print_r($quizzarray);



                            if(isset($quizzarray) && $quizzarray != ''){



            					foreach($quizzarray as $key => $qzid){



                					if(isset($qzid) && $qzid!='' ){



                					$quizzinfo = $this->quizzes_model->getItems($qzid);



                                    ?>



                                    <tr id="qli<?php echo $qzid;?>">



                                            <td><?php echo $qzid;?></td>



                                            <td><?php echo (isset($quizzinfo->name)) ? $quizzinfo->name : '';?>



                                           </td>



                                            <td>



                                                <span class="removespan">



                                                    <a href="javascript:void(0);" class="removeele" id="remove<?php echo $qzid;?>">Remove</a>



                                                </span>



                                             </td>



                                            <td>



                                            <input type="hidden" value="<?php echo $qzid;?>" name="qidck[]" id="qidck">







                                           </td>



                                  </tr>



                                   <?php



                                    }



                                }



                             }



                           }



                   }



                   ?>



                        </table>







                       </div> 



                </td>

            </tr>

        </tbody>
        
        </table>

	</form>

</div>
					
</div>

</div>



<div class="tab-pane" id="messages">

<div class="tab-content">
					

		
			<div class="panel-heading">
				<div style="padding:15px; display:block;">
					<?php if($updType == 'create'){ ?>

                		 <legend style="font-size: 16px;">New Quiz</legend>

                         <?php } ?>

                         <?php if($updType == 'edit'){ ?>

                		 <legend style="font-size: 16px;">Edit Quiz</legend>

					<?php } ?>
				</div>
			</div>
				
			
			<div class="panel-body">
				
				<form role="form" class="adminform">
					
                    <div class="form-group">
                   
                    <label class='col-sm-3 control-label'><?php echo lang('web_active')?></label>
						<div>
                        
							<div>
                            <?php //$published = ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''; ?>
								<label class="cb-wrapper" style="margin-bottom:0; width:auto;">
                                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''?> />
                              
                                </label>
								
								<label class='labelforminline' for='published' style="margin-bottom:0; width:auto;"> <?php echo lang('web_is_active')?> </label>

								<?php echo form_error('published'); ?>
							</div>
							<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_published-target" class="tooltipicon"></span>

						<span class="reg_quizz_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-published-active');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
                        
                        
                        
                        
					</div>
                    <br />
                    <br />
                  
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Start publishing Date :</label>
						
						<div>
							
                            <div>
							<input type="text" maxlength="19" size="25" id="startpublish" value="<?php echo ($this->input->post('startpublish')) ? $this->input->post('startpublish') : ((isset($quiz->startpublish)) ? $quiz->startpublish : '')?>" name="startpublish" readonly>
      						<!--<span class="add-on"><i class="icon-remove"></i></span>
							<span class="add-on"><i class="icon-th"></i></span>-->
							</div>
                            <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_startpublish-target" class="tooltipicon"></span>

						<span class="reg_quizz_startpublish-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-startpublish-date');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->





									  <!--	<input type="hidden" id="dtp_input1" value="" /><br/>  -->
						</div>
					</div>
                    <br />
                    <br />
                  
					
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">End publishing Date :</label>
						
						<div>
							
                             <div>
							<input type="text" maxlength="19" size="25" id="endpublish" value="<?php echo ($this->input->post('endpublish')) ? $this->input->post('endpublish') : ((isset($quiz->endpublish)) ? $quiz->endpublish : '')?>" name="endpublish" readonly>

					         </div>
                             <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_endpublish-target" class="tooltipicon"></span>

						<span class="reg_quizz_endpublish-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-endpublish-date');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                  

				</form>
				
			</div>
		
</div>
	
</div>







					


 <!--<script>



  $(function() {



    $( "#fromdate" ).datepicker({



      dateFormat: "yy-mm-dd",



      defaultDate: "+1w",



      changeMonth: true,



      numberOfMonths: 1,



      showOn: "button",



      buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",



      buttonImageOnly: true,



      onClose: function( selectedDate ) {



        $( "#todate" ).datepicker( "option", "minDate", selectedDate );



      }



    });



    $( "#todate" ).datepicker({



      dateFormat: "yy-mm-dd",



      defaultDate: "+1w",



      changeMonth: true,



      numberOfMonths: 1,



      showOn: "button",



      buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",



      buttonImageOnly: true,



      onClose: function( selectedDate ) {



        $( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );



      }



    });



  });



  </script>-->



							



</div>





</div>
			
			<!--<div class="tab-pane" id="settings">
					
					
			</div>-->
		</div>
		
		
</div>
</div>
</div>	
</div>


<?php if ($updType == 'edit'): ?>



	<?php echo form_hidden('id',$quiz->id) ?>



<?php endif ?>







<?php echo form_close(); ?>



<div style="clear:both;"></div>

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