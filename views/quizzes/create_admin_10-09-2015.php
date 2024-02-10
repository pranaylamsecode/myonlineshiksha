<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery("#quizzestoaddlist").tableDnD();
});

function adddragable(){

 jQuery("#quizzestoaddlist").tableDnD();

}

</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
// $(function() {
// $( "#startpublish" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
//  $( "#endpublish" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
// });
</script>
<!--lightbox scripts and style

	<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>-->

	<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

    <script src="<?php echo base_url()?>public/js/jquery.tablednd.js"></script>
	
	<!--<script>
		jQuery(document).ready(function() {
		  
		    jQuery('#description').redactor();
		 
		});
	
	</script>-->

    <!--<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">-->

    <link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

	<script type="text/javascript">

        var $ = jQuery;  
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

<div>



    <h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>



    <?php if($updType != 'edit'){



	$qid = '';



	}?>






<!--
<script type="text/javascript">

			$(function(){

			  //alert($('dl.tabs dt.selected').text());

              var first_tab = $('dl.tabs dt.selected').text();

              if(first_tab == 'General'){

                 $('#description').redactor();

              }

				$('dl.tabs dt').click(function(){

				var tab_name = $(this).text();

               // alert(tab_name);

					$(this)

						.siblings().removeClass('selected').end()

						.next('dd').andSelf().addClass('selected');

                        if(tab_name == 'General'){

                        $('#description').redactor();

                        }

				});

			});

</script>-->
<!--
<script>

  $(function() {

    $( "#startpublish" ).datepicker({

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

    $( "#endpublish" ).datepicker({

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



<span class="clearFix">&nbsp;</span>



</div>


<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/quizzes/create', $attributes) : form_open_multipart(base_url().'admin/quizzes/edit/'.$qid, $attributes);

?>



<div id="toolbar-box">



	<div class="m">



		<div id="toolbar" class="toolbar-list">



			<ul style="float:right; list-style:none; width: 17%;">



            <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
            
            <a>
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?>
            </a>

            </li>



			<li id="toolbar-new" class="listbutton">



            <?php if ($updType == 'create'): ?>


	    	<?php if ($parent_id != "0"): ?>

    			
    			
	    		<?php
    			if($this->session->userdata('addExamToCourse'))
    			{
    				?>
    				<a href='<?php echo base_url().$this->session->userdata('addExamToCourse');?>' class='btn btn-danger' id="forward"><span class="icon-32-cancel"> </span>Cancel</a>
    				<?php
    			}else
    			{
	    			?>
	    			<a href='<?php echo base_url(); ?>admin/quizzes' class='btn btn-danger'><span class="icon-32-cancel"></span>Cancel</a>
	    			<?php
    			}
    			?>


	    	



	    <?php else: ?>



	    	 <a href='<?php echo base_url(); ?>admin/quizzes/newque/<?php echo $page?>/' class='btn btn-danger'><span class="icon-32-cancel"></span>Cancel</a>



	    <?php endif ?>







    <?php else: ?>







 	    <?php if ($qid != "0"): ?>



    		<a href='<?php echo base_url(); ?>admin/quizzes' class='btn btn-danger'><span class="icon-32-cancel"></span>Cancel</a>



	    <?php else: ?>



	    	 <a href='<?php echo base_url(); ?>admin/quizzes/newque/<?php echo $page?>/' class='btn btn-dangers'><span class="icon-32-cancel"></span>Cancel</a>



	    <?php endif ?>







    <?php endif ?>



			</li>



			</ul>



			<div class="clr"></div>



		</div>



		<div class="pagetitle"><h2><?php echo ($updType == 'create') ? 'Create Exam Paper' : 'Edit Exam Paper'?></h2></div>



	</div>



</div>



<div class="col-md-12">
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="active">
				<a href="#home" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">General</span>
				</a>
			</li>
			<?php
				/*if($updType == 'edit')
				{
					if(!$quiz_pending)
					{*/
		    ?>

			<li>
				<a href="#profile" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Questions</span>
				</a>
			</li>
			
			<!--<li>
				<a href="#messages" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-mail"></i></span>
					<span class="hidden-xs">Publishing</span>
				</a>
			</li>
			<li>
				<a href="#settings" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-cog"></i></span>
					<span class="hidden-xs">Settings</span>
				</a>
			</li>-->
		</ul>
		
<div class="tab-content">

<div class="tab-pane active" id="home">
				
<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
	<div class="scrollable" data-height="120" style="overflow: hidden; width: auto; height: auto;">
					
                    
<dd class="<?php echo ($questions)?'':'selected' ?>">           
                    <div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
				<?php if($updType == 'create'){ ?>
				New Exam
				<?php } ?>
				<?php if($updType == 'edit'){ ?>
				Edit Exam
				<?php } ?>
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				
				<!--<form role="form" class="form-horizontal form-groups-bordered">-->
				
                
                
					<div class="form-group">
						
						<label class='col-sm-3 control-label' for="name">Exam Paper Title <span class="required">*</span></label>
						<div class="col-sm-5">
							
                            <input id="name" type="text" class="form-control" name="name" maxlength="256" value="<?php echo set_value('name', (isset($quiz->name)) ? $quiz->name : ''); ?>"  />

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_name-target" class="tooltipicon"></span>

						<span class="reg_quizz_name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-name');?>

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
					
					<div class="form-group">
						
						<label class="col-sm-3 control-label" for="description"><?php echo lang('web_description')?></label>



						
						<div class="col-sm-8">
							
                             <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''));?>

                      	<textarea id="description"  name="description"  class="form-control" rows="4"/><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>
                      	<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_desc-target" class="tooltipicon"></span>

						<span class="reg_quizz_desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-description');?>

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

                    <div class="form-group">
                   
                    <label class='col-sm-3 control-label'>Activate<?php //echo lang('web_active')?></label>
						<div class="col-sm-5">
                        
						<div class="checkbox">
								<label class='labelforminline' for='published'>
								   <!--<input id="status" type="checkbox" name="status" value='1' <?php echo ($this->input->post('status') == '1') ? "checked" : (isset($page[0]['status']) && $page[0]['status'] == '1') ? "checked" : ''?> />  Is It Active?-->
								  
								   </label>
								   <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($quiz->published) && $quiz->published == 1) ? 'checked' : '' ?> /> 
								
								  <label class='labelforminline' for='published'> <?php //echo lang('web_is_active')?> </label>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_published-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-published-active');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
								</label>
							</div>
							
						</div>
					</div>
                    <br />
                    <br />
                    <br />
                    <br />

                    <div class="form-group">
						<label class="col-sm-3 control-label">Exam Type:</label>
						
						<div class="col-sm-5">
							
                            <select class="form-control" style="float:left !important;" onchange="changeTip(this.value)" name="quiz_type" id="quiz_type">



                             		<option value="0" <?php echo ($this->input->post('quiz_type') == '0') ? 'selected="selected"' : (isset($quiz->is_final) && $quiz->is_final == '0') ? 'selected="selected"' : '' ?> >Term Exam</option>



                            		<option value="1" <?php echo ($this->input->post('quiz_type') == '1') ? 'selected="selected"' : (isset($quiz->is_final) && $quiz->is_final == '1') ? 'selected="selected"' : '' ?> >Final Exam</option>



							</select>




						</div>
                        
						<p id="tips" style="text-align: -webkit-center; padding-right: 4px;position: inherit; padding-left: 598px;color: black;">This type is a less formal exam and can be used to give learners a tool to check out their level of knowledge adequacy. For this type of exam the score is not important and no certificate can be issued upon even if the learner passes. Note: After saving your exam you cannot change the type.</p>
					</div>
                    <br />
                    
                    
                    
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Minimum score to pass the Exam :</label>
						
						<div class="col-sm-2" style="float:left;">
							<?php
                				$max_score = (isset($_POST['max_score_pass'])) ? $_POST['max_score_pass'] : '';
				            ?>
 							<input type="text" style="float:left !important;" value="<?php echo set_value('max_score_pass', (isset($quiz->max_score)) ? $quiz->max_score : $max_score); ?>" size="6" name="max_score_pass" id="max_score_pass" class="form-control">&nbsp;
                        </div>  
                        <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;%&nbsp;&nbsp;</span>
                    <div class="col-sm-2" style="float:left;">
                           
                        <select class="form-control" name="show_max_score_pass" id="show_max_score_pass">
                            <option value="0" <?php echo ($this->input->post('show_max_score_pass') == '0') ? 'selected="selected"' : (isset($quiz->pbl_max_score) && $quiz->pbl_max_score == '0') ? 'selected="selected"' : '' ?>   >Show</option>
                            <option value="1" <?php echo ($this->input->post('show_max_score_pass') == '1') ? 'selected="selected"' : (isset($quiz->pbl_max_score) && $quiz->pbl_max_score == '1') ? 'selected="selected"' : '' ?>   >Hide</option>
	 					</select> 

	 					<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_show_max_score_pass-target" class="tooltipicon"></span>

						<span class="reg_quizz_show_max_score_pass-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('quizz_fld_regular-max-score-pass');?>

						</span>

						</span>

                     	<span class="error"><?php echo form_error('max_score_pass'); ?></span>
					</div>

						
					</div>
                    <br />
                    <br />                  
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Exam can be taken up to :</label>
						
						<div class="col-sm-2" style="float:left;">                            
                            <select class="form-control" style="float:left !important;" name="nb_quiz_taken" id="nb_quiz_taken">

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
                            
                            <select class="form-control" style="float:left !important;" name="show_nb_quiz_taken" id="show_nb_quiz_taken">

                        <option value="0" <?php echo ($this->input->post('show_nb_quiz_taken') == '0') ? 'selected="selected"' : (isset($quiz->show_nb_quiz_taken) && $quiz->show_nb_quiz_taken == '0') ? 'selected="selected"' : '' ?>   >Show</option>


                        <option value="1" <?php echo ($this->input->post('show_nb_quiz_taken') == '1') ? 'selected="selected"' : (isset($quiz->show_nb_quiz_taken) && $quiz->show_nb_quiz_taken == '1') ? 'selected="selected"' : '' ?>   >Hide</option>


							</select>

							<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_show_nb_quiz_taken-target" class="tooltipicon"></span>

						<span class="reg_quizz_show_nb_quiz_taken-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('quizz_fld_regular-show_nb_quiz_taken');?>
						</span>
						</span>     
                    
						</div>
                        

  					                   
					</div>
                    <br />
                    <br />
                 
                    
                    <!--<div class="form-group">
						<label class="col-sm-3 control-label">Select Atleast:</label>
						
						<div class="col-sm-2" style="float:left;">
							
                    	<select class="form-control" style="float:left !important;" name="nb_quiz_select_up" id="nb_quiz_select_up">
                        <?php
							if(isset($count_que) && $count_que !=0)
							{
								for($i=$count_que; $i>=1; $i--)
								{
					             //($this->input->post('nb_quiz_select_up')) ? 'selected="selected"' : (isset($quiz->nb_quiz_select_up) && $quiz->nb_quiz_select_up == $i) ? 'selected="selected"' : '';
                                ?>
	                           		<option value="<?php echo $i;?>" <?php echo ($this->input->post('nb_quiz_select_up')) ? 'selected="selected"' : (isset($quiz->nb_quiz_select_up) && $quiz->nb_quiz_select_up == $i) ? 'selected="selected"' : '';?> ><?php echo $i;?></option>
                            	<?php
								}
							}
							else
							{
							?>
								<option value="text1"><?php echo "Please add questions first";?></option>
							<?php
							}
						?>
                    </select>                  
                           </div>
                           <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;questions to construct the exam&nbsp;&nbsp;</span>
                <div class="col-sm-2" style="float:left;">  
                    <select  class="form-control" style="float:left !important;" name="show_nb_quiz_select_up" id="show_nb_quiz_select_up">
                        <option value="0" <?php echo ($this->input->post('show_nb_quiz_select_up') == '0') ? 'selected="selected"' : (isset($quiz->show_nb_quiz_select_up) && $quiz->show_nb_quiz_select_up == '0') ? 'selected="selected"' : '' ?>   >Show</option>
	                    <option value="1" <?php echo ($this->input->post('show_nb_quiz_select_up') == '1') ? 'selected="selected"' : (isset($quiz->show_nb_quiz_select_up) && $quiz->show_nb_quiz_select_up == '1') ? 'selected="selected"' : '' ?>   >Hide</option>

					</select>
						</div>     

						<span class="tooltipcontainer">
						<span type="text" id="reg_quizz_show_nb_quiz_select_up-target" class="tooltipicon"></span>
						<span class="reg_quizz_show_nb_quiz_select_up-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<?php echo lang('quizz_fld_regular-show_nb_quiz_select_up');?>
						</span>
						</span>

					</div>
                    <br />
                    <br />-->
                   
                    <legend style="font-size: 16px;">Timer:</legend>
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Limit time for exam:</label>
						
						<div class="col-sm-2" style="float:left;">
						                          
                            <input type="text" style="float:left !important;" value="<?php echo ($this->input->post('limit_time_l')) ? $this->input->post('limit_time_l') : ((isset($quiz->limit_time)) ? $quiz->limit_time : '') ?>" maxlength="255" size="5" name="limit_time_l" id="limit_time_l" class="form-control">

                        </div>  
                        <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;Minutes&nbsp;&nbsp;</span>
                        <div class="col-sm-2" style="float:left;">
                           
                            <select class="form-control" style="float:left !important;" name="show_limit_time" id="show_limit_time">

                             <option value="0" <?php echo ($this->input->post('show_limit_time') == '0') ? 'selected="selected"' : (isset($quiz->show_limit_time) && $quiz->show_limit_time == '0') ? 'selected="selected"' : '' ?> >Show</option>

                            <option value="1" <?php echo ($this->input->post('show_limit_time') == '1') ? 'selected="selected"' : (isset($quiz->show_limit_time) && $quiz->show_limit_time == '1') ? 'selected="selected"' : '' ?> >Hide</option>

					</select>  

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_show_limit_time-target" class="tooltipicon"></span>

						<span class="reg_quizz_show_limit_time-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<?php echo lang('quizz_fld_regular-show_limit_time');?>

						</span>

						</span>

                     <span class="error"><?php echo form_error('limit_time_l'); ?></span> 
						</div>
						
					</div>
                    <br />
                    <br />
                    <br />
                 
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Show count down:</label>
						
						<div class="col-sm-5">
							
                            <select class="form-control" style="float:left !important;" name="show_countdown" id="show_countdown">



                             <option value="0" <?php echo ($this->input->post('show_countdown') == '0') ? 'selected="selected"' : (isset($quiz->show_countdown) && $quiz->show_countdown == '0') ? 'selected="selected"' : '' ?> >Show</option>



                            <option value="1" <?php echo ($this->input->post('show_countdown') == '1') ? 'selected="selected"' : (isset($quiz->show_countdown) && $quiz->show_countdown == '1') ? 'selected="selected"' : '' ?> >Hide</option>



					</select>


						<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_show_countdown-target" class="tooltipicon"></span>

						<span class="reg_quizz_show_countdown-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-show_countdown');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
                        
					</div>
                    <br />
                    <br />
                 
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Time finished alert:</label>
						
						<div class="col-sm-2" style="float:left;">
							
                            
                             <?php



                    $limit_time_f = (isset($_POST['limit_time_f'])) ? $_POST['limit_time_f'] : '';  ?>



                    <input type="text" style="float:left !important;" value="<?php echo set_value('limit_time_f', (isset($quiz->limit_time_f)) ? $quiz->limit_time_f : $limit_time_f); ?>" maxlength="255" size="5" name="limit_time_f" id="limit_time_f" class="form-control">

                    <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_show_finish_alert-target" class="tooltipicon"></span>

						<span class="reg_quizz_show_finish_alert-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-show_finish_alert');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->



                        </div> 
                        <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;Minutes before the time is up&nbsp;&nbsp;</span>
                       

                    <span class="error"><?php echo form_error('limit_time_f'); ?></span> 
                        <div class="col-sm-2" style="float:left;">
                           
                            <select class="form-control" style="float:left !important;" name="show_finish_alert" id="show_finish_alert">



                             <option value="0" <?php echo ($this->input->post('show_finish_alert') == '0') ? 'selected="selected"' : (isset($quiz->show_finish_alert) && $quiz->show_finish_alert == '0') ? 'selected="selected"' : '' ?> >Show</option>



                            <option value="1" <?php echo ($this->input->post('show_finish_alert') == '1') ? 'selected="selected"' : (isset($quiz->show_finish_alert) && $quiz->show_finish_alert == '1') ? 'selected="selected"' : '' ?> >Hide</option>



					</select>



                               
						</div> 
                        
					</div>
                    <br />
                    <br />
                   
					
					
					
				<!---</form>-->
				
			</div>
		
		</div>
	
	</div>
                    
</dd>
		
	</div>
                
	<div class="slimScrollBar" style="background-color: rgb(0, 0, 0); width: 6px; position: absolute; top: 0px; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; z-index: 99; right: 1px; height: 47.05882352941176px; display: none; opacity: 0.3; background-position: initial initial; background-repeat: initial initial;"></div>
                <div class="slimScrollRail" style="width: 6px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div>
                
                </div>
				
</div>
            
            
<div class="tab-pane" id="profile">

<dd class="<?php echo ($questions)?'selected': ''?>">
<?php
		if($updType == 'edit')
		{
				if(!$quiz_pending)
				{
		    ?>
<div class="tab-content">

		 <?php if($updType == 'create'){ ?>

		 <legend style="font-size: 16px;">New Exam</legend>

         <?php } ?>

         <?php if($updType == 'edit'){ ?>

		 <legend style="font-size: 16px;">Edit Exam</legend>

         <?php } ?>
                
           
<table class="adminform">
<tbody>    
	<tr>
		<td>
			<!--<a href='<?php echo base_url(); ?>admin/quizzes/createque/<?php echo ($qid != "")  ? $qid : ''?>/<?php //echo $page?>' class='fancybox fancybox.iframe btn btn-primary'>
			<i class="entypo-plus"></i>Add Question</a>&nbsp;-->
			<a href='<?php echo base_url(); ?>admin/quizzes/questlist/<?php echo ($qid != "")  ? $qid : ''?>/<?php //echo $page?>' class='fancybox fancybox.iframe btn btn-primary'>
			<i class="entypo-plus"></i>Select Questions</a>&nbsp;

			<a href='<?php echo base_url(); ?>admin/quizzes/addquestion' class='fancybox fancybox.iframe btn btn-primary'>
			<i class="entypo-plus"></i>Add Questions</a>&nbsp;
				<?php 
				$totalMarksOutOf = 0;
				$quizid = $this->uri->segment(4) ? $this->uri->segment(4) :0; 
           			$CI = & get_instance();
				$CI->load->model('admin/questions_model');
           		$quiz_quesarr = $this->quizzes_model->get_count_ques($quizid); 
           		 if($quiz_quesarr)
           		 {
           		 $quescore1 =0;    
           		 $cnt = explode(',', $quiz_quesarr->quizzes_ids);
         		 	$totalMarksOutOfff =0;
           		 	$totalMarksOutOf =0;
           		 	$totalMarksObtained =0;
           		 	$CI = & get_instance();
					$CI->load->model('lessons_model');
					$quizzes_ids = $CI->lessons_model->getQuestionIds($quiz->id);
				//print_r($quizzes_ids);
				foreach($quizzes_ids as $ids)
				{
					//$idd = explode(',', $ids->quizzes_ids);
					$cnt = explode(',', $ids->quizzes_ids);
					foreach($cnt as $key=>$my_quiz)
					{
						$data_right1 = $CI->lessons_model->getQuizRightAnswersForPendings($my_quiz);
						
						foreach($data_right1 as $correctans)
               			{

                     		if($correctans->is_correct_answer == 1  || $correctans->is_correct_answer == 'True'  || $correctans->is_correct_answer == 'False'  || $correctans->ans_option == 'subjective' || $correctans->question_type == 'match_the_pair' || ($correctans->question_type == 'multiple_type' && $correctans->is_correct_answer == 0))
                     		{
                        		 $totalMarksOutOfff+= $correctans->points;
                     		}   
                 		}


						$data_right = $CI->lessons_model->getQuizRightAnswers($my_quiz);						

						foreach($data_right as $rights)
						{
							//for right answer							
							if($rights->question_type == 'match_the_pair')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'true_false')
							{							
								if($rights->is_correct_answer == 'True' || $rights->is_correct_answer == 'False')
								{
									$totalMarksOutOf+= $rights->points;
								}
							}
							else if($rights->question_type == 'multiple_type')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else // if($rights->is_correct_answer == 1)
							{
								$totalMarksOutOf+= $rights->points;
							}

										
						}
					}
					//echo $totalMarksOutOf."<br/>";
					//echo $totalMarksOutOfff;
					}
					}	
                	
		            ?>
		  			<p id="Total_Marks" style="font-size: 21px; margin-left: 791px; margin-top: -33px; margin-bottom: -8px;">Total Marks:
		  			<input type="text" value="<?php echo $totalMarksOutOfff ? $totalMarksOutOfff :'0'; ?>" id="totalmark" readonly style="width:50px"></p>	
<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_add_quiz-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="reg_quizz_add_quiz-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-add_quiz');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

					<br/>

					<br/>

                <?php

				$qidin = array();

               // print_r($questions);exit;

				if ($questions): ?>
<!--
				<script>

				//var jque = $.noConflict();

			   $(document).ready(function(){

					$(".removeque").click(function(){

					var id = $(this).attr("removeid");

					var strqueids = $('input#qidin').attr('value');

					var strarray = strqueids.split(',');

					strarray = $.grep(strarray,function(v){return v!=id;})

					<?php if($updType == 'edit'){?>

					var delstring = $('input#delids').attr("value");

				    if(delstring.length==0)

				    {delstring = id;}

				    else{delstring = delstring+','+id;}

					$('input#delids').val(delstring);

					<?php }?>

					strqueids = strarray.toString();

					$("input#qidin").val(strqueids);

                    $("input#qidin").val(strqueids);

                   // alert("#row"+id);

				   //	$("tr").remove("#row"+id);

                    $("#row"+id).hide();

					});

				});

				</script>-->

						<?php else: ?>

							<p class='text'><?=lang('web_no_elements');?></p>

						<?php endif ?>

						<?php 

						$qidinstring = implode(",",$qidin);?>

						<input type="hidden" name="qidin" id="qidin" value="<?php echo $qidinstring;?>">

                        <span class="error"><?php echo form_error('qidin'); ?></span>

						<?php
						if($updType == 'edit')
						{
							?>
							<input type="hidden" name="delids" id="delids" value="">
							<?php
						}
						?>
                </td>

            </tr>

        </tbody>
</table>

<table class="table table-bordered responsive" id="quizzestoaddlist">
	<thead>
		<tr role="row">      	
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="ID">ID</th>
            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">Questions</th>
            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">Questions Marks</th>
            <th class="sorting" role="columnheader" tabindex="2" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Remove">Remove</th>
            <!--<th>Re-order<a href="javascript: saveorder(4, 'saveorder')" class="saveorder"></a></th> -->
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Edit</th>            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Published</th>-->
            
		</tr>
	</thead>
	
	
<tbody> 
<?php $i = 0;?>
<?php 
//foreach ($questions as $question):



$queid = $qid;
if(!empty($questions->quizzes_ids))
{
	$questionArray = explode(',',$questions->quizzes_ids);
}

if(isset($questionArray) && $questionArray != '')
{
	foreach($questionArray as $key => $qzid)
	{
		if(isset($qzid) && $qzid!='' )
		{
			$gotQuestion = $this->quizzes_model->getQuestionsNewForEdit($qzid);
		?>

		<tr id="qli<?php echo $qzid; //$queid;?>">			
			<td class=" ">
	            <!-- <a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe"> -->
				<?php echo $gotQuestion->question_id?><!-- </a> -->
			</td>
			
            <td class=" ">
	            <!--<a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe">-->
				<?php echo $gotQuestion->question?>
			</td>
			<?php         			
         		 	
           		 	$totalMarksOutOf =0;
           		 	$totalMarksObtained =0;
           		 	$CI = & get_instance();
					$CI->load->model('lessons_model');
					//$quizzes_ids = $CI->lessons_model->getQuestionIds($quest->question_id);
				
						$data_right = $CI->lessons_model->getQuizMarks($gotQuestion->question_id);	
							// echo"<pre>";
							// print_r($data_right);
							// echo"</pre>";					
						foreach($data_right as $rights)
						{
							//for right answer							
							if($rights->question_type == 'match_the_pair')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'true_false')
							{							
								// if($rights->is_correct_answer == 'True')
								// {
								 	$totalMarksOutOf = $rights->points;
								// }
							}
							else if($rights->question_type == 'multiple_type')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'subjective')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else 
							{
								$totalMarksOutOf = $rights->points;
							}

										
						}
					
					//echo $totalMarksOutOf;               	
           ?>
            <td class=" ">
	            <!--<a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe">-->
				<span id="totalM<?php echo $queid;?>"><?php echo $totalMarksOutOf?></span>
			</td>

        	<td class=" ">
        	<!--<div class='removeque' removeid="<?php echo $queid;?>" id="remove<?php $queid;?>">remove</div>-->
        	<span class="removespan"><a href="javascript:void(0);" onclick="deleteRow(this,<?php echo $totalMarksOutOf?>);" class="removeele" id="remove'+$(this).val()+'">Remove</a></span>
        	</td>

        	<!--<td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="'+$(this).val()+'"></td>-->
        	<td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="<?php echo $gotQuestion->question_id?>"></td>
			
	        <!--<td class=" ">            
	            <a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?><?php //echo ($category_id != "") ? $category_id : "0" ?>/<?php //echo $page?>" class ="fancybox fancybox.iframe btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>           
	        </td>-->
			
       		<!--<td class=" ">
				<?php if($question->published){?>
				<a title="Unpublish Item" href="<?php echo base_url(); ?>/admin/quizzes/activation/deactivate/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php echo $updType; ?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>
				<?php }else{?>
				<a title="Publish Item" href="<?php echo base_url(); ?>/admin/quizzes/activation/activate/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php echo $updType; ?>"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>
				 <?php }?>
			</td>-->            
		</tr>

		<?php
	}}}
		$qidin[] = $qid;?>
		<?php //endforeach		
		?>
	</tbody>
</table>


</div>

<?php
	}
	else
	{
	?>
	<div class="tab-content">
			<div style="color: red;font-size: large;">You cannot Edit this section because of pending result. You have to finalize the pending result first.</div>

			<table class="table table-bordered responsive" id="quizzestoaddlist">
			<thead>
				<tr role="row">      	
		            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="ID">User ID</th>
		            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">User Name</th>
		            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">Result</th>
		            <th class="sorting" role="columnheader" tabindex="2" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Remove">Action</th>
		           
				</tr>
			</thead>
			
			
			<tbody> 
			     <?php
			       if($quiz_pending)
			       {
			       	// echo"<pre>";
			       	// print_r($quiz_pending);
			     		foreach($quiz_pending as $qdata)
			     		{
			     			if($qdata->user_id)
			     			{
			     				 $studname = $this->Studreport_model->getUserName2($qdata->user_id);
			     				 if($studname)
			     				 {
			     ?>
				<tr>
					<td><?php echo $qdata->user_id; ?></td>
					<td><?php echo $studname->first_name.' '.$studname->last_name; ?></td>
					<td><?php echo $qdata->result; ?></td>
					<td><a href="<?php echo base_url(); ?>admin/studreport/viewuserreport/<?php echo $qdata->user_id ?>/<?php echo $qdata->pid; ?>/" class="btn btn-primary" >View</a></td>
				</tr>
				<?php
								}
							}
						}
			       }
				?>
			</tbody>
			</table>
	</div>
<?php	
	}
  }
  else
  {

?>

<div class="tab-content">

		 <?php if($updType == 'create'){ ?>

		 <legend style="font-size: 16px;">New Exam</legend>

         <?php } ?>

         <?php if($updType == 'edit'){ ?>

		 <legend style="font-size: 16px;">Edit Exam</legend>

         <?php } ?>
                
           
<table class="adminform">
<tbody>    
	<tr>
		<td>
			<!--<a href='<?php echo base_url(); ?>admin/quizzes/createque/<?php echo ($qid != "")  ? $qid : ''?>/<?php //echo $page?>' class='fancybox fancybox.iframe btn btn-primary'>
			<i class="entypo-plus"></i>Add Question</a>&nbsp;-->
			<a href='<?php echo base_url(); ?>admin/quizzes/questlist/<?php echo ($qid != "")  ? $qid : ''?>/<?php //echo $page?>' class='fancybox fancybox.iframe btn btn-primary'>
			<i class="entypo-plus"></i>Select Questions</a>&nbsp;

			<a href='<?php echo base_url(); ?>admin/quizzes/addquestion' class='fancybox fancybox.iframe btn btn-primary'>
			<i class="entypo-plus"></i>Add Questions</a>&nbsp;
				<?php 
				$totalMarksOutOf = 0;
				$quizid = $this->uri->segment(4) ? $this->uri->segment(4) :0; 
           			$CI = & get_instance();
				$CI->load->model('admin/questions_model');
           		$quiz_quesarr = $this->quizzes_model->get_count_ques($quizid); 
           		 if($quiz_quesarr)
           		 {
           		 $quescore1 =0;    
           		 $cnt = explode(',', $quiz_quesarr->quizzes_ids);
         		 	
           		 	$totalMarksOutOf =0;
           		 	$totalMarksObtained =0;
           		 	$CI = & get_instance();
					$CI->load->model('lessons_model');
					$quizzes_ids = $CI->lessons_model->getQuestionIds($quiz->id);
				//print_r($quizzes_ids);
				foreach($quizzes_ids as $ids)
				{
					//$idd = explode(',', $ids->quizzes_ids);
					$cnt = explode(',', $ids->quizzes_ids);
					foreach($cnt as $key=>$my_quiz)
					{
						$data_right = $CI->lessons_model->getQuizRightAnswers($my_quiz);	
												
						foreach($data_right as $rights)
						{
							//for right answer							
							if($rights->question_type == 'match_the_pair')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'true_false')
							{							
								if($rights->is_correct_answer == 'True')
								{
									$totalMarksOutOf+= $rights->points;
								}
							}
							else if($rights->question_type == 'multiple_type')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else // if($rights->is_correct_answer == 1)
							{
								$totalMarksOutOf+= $rights->points;
							}

										
						}
					}
					//echo $totalMarksOutOf;
					}
					}	
                	
		            ?>
		  			<p id="Total_Marks" style="font-size: 21px; margin-left: 791px; margin-top: -33px; margin-bottom: -8px;">Total Marks:
		  			<input type="text" value="<?php echo $totalMarksOutOf ? $totalMarksOutOf :'0'; ?>" id="totalmark" readonly style="width:50px"></p>	
<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_add_quiz-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="reg_quizz_add_quiz-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-add_quiz');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

					<br/>

					<br/>

                <?php

				$qidin = array();

               // print_r($questions);exit;

				if ($questions): ?>
<!--
				<script>

				//var jque = $.noConflict();

			   $(document).ready(function(){

					$(".removeque").click(function(){

					var id = $(this).attr("removeid");

					var strqueids = $('input#qidin').attr('value');

					var strarray = strqueids.split(',');

					strarray = $.grep(strarray,function(v){return v!=id;})

					<?php if($updType == 'edit'){?>

					var delstring = $('input#delids').attr("value");

				    if(delstring.length==0)

				    {delstring = id;}

				    else{delstring = delstring+','+id;}

					$('input#delids').val(delstring);

					<?php }?>

					strqueids = strarray.toString();

					$("input#qidin").val(strqueids);

                    $("input#qidin").val(strqueids);

                   // alert("#row"+id);

				   //	$("tr").remove("#row"+id);

                    $("#row"+id).hide();

					});

				});

				</script>-->

						<?php else: ?>

							<p class='text'><?=lang('web_no_elements');?></p>

						<?php endif ?>

						<?php 

						$qidinstring = implode(",",$qidin);?>

						<input type="hidden" name="qidin" id="qidin" value="<?php echo $qidinstring;?>">

                        <span class="error"><?php echo form_error('qidin'); ?></span>

						<?php
						if($updType == 'edit')
						{
							?>
							<input type="hidden" name="delids" id="delids" value="">
							<?php
						}
						?>
                </td>

            </tr>

        </tbody>
</table>

<table class="table table-bordered responsive" id="quizzestoaddlist">
	<thead>
		<tr role="row">      	
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="ID">ID</th>
            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">Questions</th>
            <th class="sorting" role="columnheader" tabindex="1" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Questions">Questions Marks</th>
            <th class="sorting" role="columnheader" tabindex="2" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Remove">Remove</th>
            <!--<th>Re-order<a href="javascript: saveorder(4, 'saveorder')" class="saveorder"></a></th> -->
            <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending" style="width: 125px;">Edit</th>            
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 321px;">Published</th>-->
            
		</tr>
	</thead>
	
	
<tbody> 
<?php $i = 0;?>
<?php 
//foreach ($questions as $question):



$queid = $qid;
if(!empty($questions->quizzes_ids))
{
	$questionArray = explode(',',$questions->quizzes_ids);
}

if(isset($questionArray) && $questionArray != '')
{
	foreach($questionArray as $key => $qzid)
	{
		if(isset($qzid) && $qzid!='' )
		{
			$gotQuestion = $this->quizzes_model->getQuestionsNewForEdit($qzid);
		?>

		<tr id="row<?php echo $queid;?>">			
			<td class=" ">
	            <a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe">
				<?php echo $gotQuestion->question_id?></a>
			</td>
			
            <td class=" ">
	            <!--<a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe">-->
				<?php echo $gotQuestion->question?>
			</td>
			<?php         			
         		 	
           		 	$totalMarksOutOf =0;
           		 	$totalMarksObtained =0;
           		 	$CI = & get_instance();
					$CI->load->model('lessons_model');
					//$quizzes_ids = $CI->lessons_model->getQuestionIds($quest->question_id);
				
						$data_right = $CI->lessons_model->getQuizMarks($gotQuestion->question_id);	
							// echo"<pre>";
							// print_r($data_right);
							// echo"</pre>";					
						foreach($data_right as $rights)
						{
							//for right answer							
							if($rights->question_type == 'match_the_pair')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'true_false')
							{							
								// if($rights->is_correct_answer == 'True')
								// {
								 	$totalMarksOutOf = $rights->points;
								// }
							}
							else if($rights->question_type == 'multiple_type')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else if($rights->question_type == 'subjective')
							{								
								$totalMarksOutOf+= $rights->points;								
							}
							else 
							{
								$totalMarksOutOf = $rights->points;
							}

										
						}
					
					//echo $totalMarksOutOf;               	
           ?>
            <td class=" ">
	            <!--<a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe">-->
				<span id="totalM<?php echo $queid;?>"><?php echo $totalMarksOutOf?></span>
			</td>

        	<td class=" ">
        	<!--<div class='removeque' removeid="<?php echo $queid;?>" id="remove<?php $queid;?>">remove</div>-->
        	<span class="removespan"><a href="javascript:void(0);" onclick="deleteRow(this,<?php echo $totalMarksOutOf?>);" class="removeele" id="remove'+$(this).val()+'">Remove</a></span>
        	</td>

        	<!--<td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="'+$(this).val()+'"></td>-->
        	<td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="<?php echo $gotQuestion->question_id?>"></td>
			
	        <!--<td class=" ">            
	            <a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?><?php //echo ($category_id != "") ? $category_id : "0" ?>/<?php //echo $page?>" class ="fancybox fancybox.iframe btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>           
	        </td>-->
			
       		<!--<td class=" ">
				<?php if($question->published){?>
				<a title="Unpublish Item" href="<?php echo base_url(); ?>/admin/quizzes/activation/deactivate/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php echo $updType; ?>"><img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"></a>
				<?php }else{?>
				<a title="Publish Item" href="<?php echo base_url(); ?>/admin/quizzes/activation/activate/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php echo $updType; ?>"><img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"></a>
				 <?php }?>
			</td>-->            
		</tr>

		<?php
	}}}
		$qidin[] = $qid;?>
		<?php //endforeach		
		?>
	</tbody>
</table>


</div>

<?php
}
?>

</dd>	

</div>
			

<div class="tab-pane" id="messages">

<dd class="">
	<div class="tab-content">
					
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php if($updType == 'create'){ ?>

						New Exam

                        <?php } ?>

                        <?php if($updType == 'edit'){ ?>

						Edit Exam

					<?php } ?>
				
                </div>
				
				<!--<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>-->
			</div>
			
			<div class="panel-body">
				
				<fieldset role="form" class="form-horizontal form-groups-bordered">
					
                    <div class="form-group">
                   
                    <label class='col-sm-3 control-label'>Activate<?php //echo lang('web_active')?></label>
						<div class="col-sm-5">
                        
						<div class="checkbox">
								<label class='labelforminline' for='published'>
								   <!--<input id="status" type="checkbox" name="status" value='1' <?php echo ($this->input->post('status') == '1') ? "checked" : (isset($page[0]['status']) && $page[0]['status'] == '1') ? "checked" : ''?> />  Is It Active?-->
								  
								   </label>
								   <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? "checked" : (isset($quiz->published) && $quiz->published == 1) ? 'checked' : '' ?> /> 
								
								  <label class='labelforminline' for='published'> <?php //echo lang('web_is_active')?> </label>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="final_quizz_published-target" class="tooltipicon" title="Cleck Here"></span>

						<span class="final_quizz_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_final-published-active');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
								</label>
							</div>
							
						</div>
					</div>
                    <br />
                    <br />
					
					 
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Start publishing Date :</label>
						
						<div class="col-sm-5">
							
                            <div>
							<input type="text" maxlength="19" size="25" id="startpublish" class="form-control" value="<?php echo ($this->input->post('startpublish')) ? $this->input->post('startpublish') : ((isset($quiz->startpublish)) ? $quiz->startpublish : '')?>" name="startpublish" readonly>
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
						
						<div class="col-sm-5">
							
                             <div>
							<input type="text" maxlength="19" size="25" id="endpublish" class="form-control" value="<?php echo ($this->input->post('endpublish')) ? $this->input->post('endpublish') : ((isset($quiz->endpublish)) ? $quiz->endpublish : '')?>" name="endpublish" readonly>

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
					
				</fieldset>
				
			</div>
		
		</div>
	
	</div>


</div>

</dd>

</div>
			
<!--<div class="tab-pane" id="settings">
					
					
</div>-->

</div>
		
</div>

<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$quiz->id) ?>

<?php endif ?>

<?php echo form_close(); ?>
<script type="text/javascript">
function deleteRow(thisiss, para)
{
    if (!document.getElementsByTagName || !document.createTextNode) return;
    var rows = document.getElementById('quizzestoaddlist').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (i = 0; i < rows.length; i++) 
    {
        rows[i].onclick = function() 
        {
        	document.getElementById('totalmark').value = parseFloat(document.getElementById('totalmark').value - parseInt(para));
        	if(this.rowIndex != 0)
			document.getElementById('quizzestoaddlist').deleteRow(this.rowIndex);
			 //var vvv = $(this.rowIndex).val();
			 //var vvv= document.getElementById('totalM10'+rows[i]).value;			 
        }

    }

}

/*
function substractMark(mark)
{
	//document.getElementById('totalmark').value = parseFloat(document.getElementById('totalmark').value - mark);
}*/
</script>


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
	<script>
	function deletetotal(x)
	{
		alert(x);
	}
	</script>

<!-- tool tip script finish -->

<script type="text/javascript">
	function changeTip(val)
	{
		if(val == '1')
		{
			jQuery('#tips').html('This is a formal fool-proof exam. The score is important and a certificate can be awarded. To protect the quality of the exam each user should get a different set of questions. To ensure this create a large number of potential questions (e.g. 100) and set a lower number of random questions the learner has to answer (e.g. 15).')
		}
		if(val == '0')
		{
			jQuery('#tips').html('This type is a less formal exam and can be used to give learners a tool to check out their level of knowledge adequacy. For this type of exam the score is not important and no certificate can be issued upon even if the learner passes. Note: After saving your exam you cannot change the type.')
		}
	}
</script>