<style type="text/css">
	textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input{
		width: 220px;
	}


</style>
<style type="text/css">
.validateerror {
   float: left;
   text-align: center;
   width: 40%;
   margin-left: 235px;
   color: red;
}
.help-block {
   display: block;
   width: 100% !important;
   margin: 0 -229px auto !important;
}

.validateerrorbox
{
	border-color: red !important;
}
</style>
<script type="text/javascript">
  function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>
<script type="text/javascript">
//var $ =jQuery.noConflict();
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
// $( "#endpublish" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
// });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
<script src="<?php echo base_url()?>public/js/jquery.tablednd.js"></script>
<!--<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
<link href="<?php echo base_url(); ?>public/css/datetimepicker.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
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
<!--/lightbox scripts and style ------------------------ -->

<div>
    <h2><?php echo ($updType == 'create') ? lang('web_add_program') : lang('web_edit_program')?></h2>

    <?php if($updType != 'edit'){

	$qid = '';

	}?>

<!--<script>



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

<header>
	<section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>
            <?php echo (($updType == 'edit')?'Edit Exam':'Create Exam');?> </h2>
        </div>
      </div>
    </div>
  </section>
</header>

<div class="page-container">
<?php
   $this->load->view(getOverridePath($tmpl,'slide_menu','indexviews'));
?>  

<div class="main-content" style="min-height: 820px;">
	<div class="row">
<div class="sidebar-collapse sb-toggle-left" style="float: left; margin-top:5px; margin-right:20px; margin-bottom:10px;">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>

<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open_multipart(base_url().'quizzes/create', $attributes) : form_open_multipart(base_url().'quizzes/edit/'.$qid, $attributes);
?>
<div id="sticky-anchor"></div>
<div id="sticky" class="">
<?php if ($updType == 'create'): ?>
<?php if ($parent_id != "0"): ?>
	<?php
	if($this->session->userdata('addExamToCourse'))
	{
		?>
		<a href='<?php echo base_url().$this->session->userdata('addExamToCourse');?>' style="float: right;" class='btn btn-danger'>Cancel</a>
		<?php
	}else
	{
		?>
		<a href='<?php echo base_url(); ?>manage-exams' style="float: right;" class='btn btn-danger'>Cancel</a>
		<?php
	}
	?>
<?php else: ?>
<a href='<?php echo base_url(); ?>quizzes/<?php echo $page?>/' style="float: right;" class='btn btn-danger'>Cancel</a>
<?php endif ?>
<?php else: ?>
<?php if ($qid != "0"): ?>

    	<a href='<?php echo base_url(); ?>manage-exams' style="float: right;" class='btn btn-danger'>Cancel</a>

	    <?php else: ?>

	    	 <a href='<?php echo base_url(); ?>quizzes/newque/<?php echo $page?>/' style="float: right;" class='btn btn-dangers'>Cancel</a>

	    <?php endif ?>

    <?php endif ?>

<a style="float: right; margin-right:10px; margin-top: 2px;">
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'")); ?>
            </a>
</div>
<div>
<span class="clearFix"> </span>
</div>
			<div class="clr"></div>

<hr />



<div>
		
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
        <div>
		
		<div class="" data-collapsed="0">		
			 
			<div class="panel-body form-horizontal form-groups-bordered">
				
				
                <?php if($updType == 'create'){ ?>
				<!--<legend style="font-size: 16px; color: #c42140;">New Exam</legend>-->
                <legend style="font-size:14px; color: #09C; font-weight:bold; text-transform: uppercase;">New Exam</legend>
				<?php } ?>
				<?php if($updType == 'edit'){ ?>
				<!--<legend style="font-size: 16px;">Edit Exam</legend>-->
                <legend style="color: #09c; font-size: 14px; font-weight: bold; text-transform: uppercase;">Edit Exam</legend>
				<?php } ?>
                
					<div class="form-group">
						
						<label class='col-sm-3 control-label' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
						<div class="col-sm-5">
							
                            <input id="name" type="text" class="" name="name" maxlength="256" value="<?php echo set_value('name', (isset($quiz->name)) ? $quiz->name : ''); ?>" data-validation="required"  data-validation-error-msg="Enter valid exam name." />

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

                   
					
					<div class="form-group">
						
						<label class="col-sm-3 control-label" for="description"><?php echo lang('web_description')?></label>


						<div class="col-sm-5">
							
                             <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''));?>



                      	<textarea id="description"  name="description"  class="" rows="6"/><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($quiz->description)) ? $quiz->description : ''); ?></textarea>
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


                    <div class="form-group">
                    
                    <label class='col-sm-3 control-label'><?php echo lang('web_active')?></label>
					
                    	<div class="col-sm-5">  
                        
							<div class="checkbox">
                            <?php //$published = ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''; ?>
								<label class="cb-wrapper" style="margin-bottom:0; width:auto;">
                                <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published')) ? "checked" : (isset($quiz->published)) ? "checked" : ''?> <?php echo $updType == 'create' ? 'checked' :''; ?> />
                              
                                </label>
								
								<label class='labelforminline' for='published' style="margin-bottom:0; width:auto;"> <?php echo lang('web_is_active')?> </label>

								<?php echo form_error('published'); ?>
								<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_published-target" class="tooltipicon"></span>

						<span class="reg_quizz_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

				

						<?php echo lang('quizz_fld_regular-published-active');?>


						</span>

						</span>
							</div>
						

						


						</div>
					</div>

                                     
                    <div class="form-group">
						<label class="col-sm-3 control-label">Exam Type:</label>
						
						<div class="col-sm-5">
							
                            <select class="" style="float:left !important;" name="quiz_type" id="quiz_type">



                             <option value="0" <?php echo ($this->input->post('is_final') == '0') ? 'selected="selected"' : (isset($quiz->is_final) && $quiz->is_final == '0') ? 'selected="selected"' : '' ?> >Term Exam </option>

                          <?php
                          	if($this->uri->segment(3) != 'addExamToCourse')
    						{

                          ?>

                            <option value="1" <?php echo ($this->input->post('is_final') == '1') ? 'selected="selected"' : (isset($quiz->is_final) && $quiz->is_final == '1') ? 'selected="selected"' : '' ?> >Final Exam</option>

                           <?php
                           	}
                           ?>

					</select>
					 <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="quiz_type-target" class="tooltipicon"></span>

						<span class="quiz_type-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo 'Select Exam Type'; //echo lang('quizz_fld_regular-show_countdown');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->




						</div>
                       
					</div>

                    
                    
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Minimum score to pass the exam<span class="required">*</span> :</label>
						
						<div class="col-sm-2" style="float:left;">                           
                            
                            <?php
				                $max_score = (isset($_POST['max_score_pass'])) ? $_POST['max_score_pass'] : '';
				            ?>
							<input type="text" style="float:left !important;" value="<?php echo set_value('max_score_pass', (isset($quiz->max_score)) ? $quiz->max_score : $max_score); ?>" size="6" name="max_score_pass" id="max_score_pass" class=" " data-validation="number" data-validation-error-msg="Please enter valid minimum score to pass the exam." onkeypress="return isNumberKey(event)">&nbsp;%
                            </div>  
                        <span style="float:left !important; padding-top:4px; padding-left:2px;"></span>
                        <div class="col-sm-2" style="float:left;">
                           
                            <select class="" name="show_max_score_pass" id="show_max_score_pass">



                            <option value="0" <?php echo ($this->input->post('show_max_score_pass') == '0') ? 'selected="selected"' : (isset($quiz->pbl_max_score) && $quiz->pbl_max_score == '0') ? 'selected="selected"' : '' ?>   >Show</option>







                            <option value="1" <?php echo ($this->input->post('show_max_score_pass') == '1') ? 'selected="selected"' : (isset($quiz->pbl_max_score) && $quiz->pbl_max_score == '1') ? 'selected="selected"' : '' ?>   >Hide</option>



					 </select> 
					 <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_show_max_score_pass-target" class="tooltipicon"></span>

						<span class="reg_quizz_show_max_score_pass-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-max-score-pass');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
                         



                     <span class="error"><?php echo form_error('max_score_pass'); ?></span>
					</div>

                  
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Exam can be taken up to :</label>
						
						<div class="col-sm-2" style="float:left;">
                            
                            <select class="" style="float:left !important;" name="nb_quiz_taken" id="nb_quiz_taken">

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
                            
                            <select class="" style="float:left !important;" name="show_nb_quiz_taken" id="show_nb_quiz_taken">

                        <option value="0" <?php echo ($this->input->post('show_nb_quiz_taken') == '0') ? 'selected="selected"' : (isset($quiz->show_nb_quiz_taken) && $quiz->show_nb_quiz_taken == '0') ? 'selected="selected"' : '' ?>   >Show</option>


                        <option value="1" <?php echo ($this->input->post('show_nb_quiz_taken') == '1') ? 'selected="selected"' : (isset($quiz->show_nb_quiz_taken) && $quiz->show_nb_quiz_taken == '1') ? 'selected="selected"' : '' ?>   >Hide</option>


							</select>
							<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="reg_quizz_show_nb_quiz_taken-target" class="tooltipicon"></span>

						<span class="reg_quizz_show_nb_quiz_taken-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizz_fld_regular-show_nb_quiz_taken');?>

						<!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
                    
						</div>
                        


                            
					</div>

                 
                    
                    <!--<div class="form-group">
						<label class="col-sm-3 control-label">Select atleast:</label>
						
						<div class="col-sm-2" style="float:left;">
							
                            <select class=" " style="float:left !important;" name="nb_quiz_select_up" id="nb_quiz_select_up">



                        <?php



							if(isset($count_que) && $count_que !=0 ){



								for($i=$count_que; $i>=1; $i--){



             //($this->input->post('nb_quiz_select_up')) ? 'selected="selected"' : (isset($quiz->nb_quiz_select_up) && $quiz->nb_quiz_select_up == $i) ? 'selected="selected"' : '';



                                ?>



                            		<option value="<?php echo $i;?>" <?php echo ($this->input->post('nb_quiz_select_up')) ? 'selected="selected"' : (isset($quiz->nb_quiz_select_up) && $quiz->nb_quiz_select_up == $i) ? 'selected="selected"' : '';?> ><?php echo $i;?></option>



                            	<?php



								}



							}



							else{



							?>



								<option value="text1"><?php echo "Please add questions first";?></option>







							<?php



							}



							?>



                    </select>





                   



                   

                          </div>
                           <span style="float:left !important; padding-top:4px; padding-left:2px;">&nbsp;&nbsp;questions to construct the exam&nbsp;&nbsp;</span>
                          <div class="col-sm-2" style="float:left;">  
                           
                            <select  class=" " style="float:left !important;" name="show_nb_quiz_select_up" id="show_nb_quiz_select_up">







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
                   
                    <!--<legend style="font-size: 16px; clear:both;">Timer:</legend>-->
                    <legend style="font-size:14px; color: #09C; font-weight:bold; text-transform: uppercase;">Timer:</legend>
                    
                    <div class="form-group">
						<!--<label class="col-sm-2 control-label">Limit time for exam:</label>-->
                        <label class="col-sm-3 control-label">Limit time for exam<span class="required">*</span>:</label>						
						<!--<div class="col-sm-4" style="float:left;">-->
                        <div class="col-sm-2" style="float:left;">                           
                            <input type="text" style="float:left !important;" value="<?php echo ($this->input->post('limit_time_l')) ? $this->input->post('limit_time_l') : ((isset($quiz->limit_time)) ? $quiz->limit_time : '') ?>" maxlength="255" size="5" name="limit_time_l" id="limit_time_l" class="" data-validation="number" data-validation-error-msg="Please enter valid time limit for exam." onkeypress="return isNumberKey(event)">
                        </div>  
                        <label class="col-sm-2 control-label">Minutes</label>
                        <div class="col-sm-4" style="float:left;">                           
                            <select class="" style="float:left !important;" name="show_limit_time" id="show_limit_time">
	                            <option value="0" <?php echo ($this->input->post('show_limit_time') == '0') ? 'selected="selected"' : (isset($quiz->show_limit_time) && $quiz->show_limit_time == '0') ? 'selected="selected"' : '' ?> >Show</option>
		                        <option value="1" <?php echo ($this->input->post('show_limit_time') == '1') ? 'selected="selected"' : (isset($quiz->show_limit_time) && $quiz->show_limit_time == '1') ? 'selected="selected"' : '' ?> >Hide</option>
							</select>   
							<!-- tooltip area -->
							<span class="tooltipcontainer">
							<span type="text" id="reg_quizz_show_limit_time-target" class="tooltipicon"></span>
							<span class="reg_quizz_show_limit_time-target  tooltargetdiv" style="display: none;" >
							<span class="closetooltip"></span>
							<!--tip containt-->
							<?php echo lang('quizz_fld_regular-show_limit_time');?>
							<!--/tip containt-->
							</span>
							</span>
							<!-- tooltip area finish -->
	                     	<span class="error"><?php echo form_error('limit_time_l'); ?></span>
						</div>                        
					</div>                 
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Show count down:</label>						
						<div class="col-sm-5">							
                            <select class="" style="float:left !important;" name="show_countdown" id="show_countdown">
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
                    
                    <div class="form-group">
						<!--<label class="col-sm-2 control-label">Time finished alert:</label>-->	
                        <label class="col-sm-3 control-label">Time finished alert:</label>					
						<!--<div class="col-sm-3" style="float:left;">-->
                        <div class="col-sm-2" style="float:left;">                         
                            <?php
                    			$limit_time_f = (isset($_POST['limit_time_f'])) ? $_POST['limit_time_f'] : '';  ?>
                    			<input type="text" style="float:left !important;" value="<?php echo set_value('limit_time_f', (isset($quiz->limit_time_f)) ? $quiz->limit_time_f : $limit_time_f); ?>" maxlength="255" size="5" name="limit_time_f" id="limit_time_f" class="" onkeypress="return isNumberKey(event)">
 								<span class="error"><?php echo form_error('limit_time_f'); ?></span> 
                        </div> 
                        
                        <label class="col-sm-2 control-label">Minutes before the time is up&nbsp;&nbsp;</label>
                        <div class="col-sm-3" style="float:left;">                           
                            <select class="" style="float:left !important;" name="show_finish_alert" id="show_finish_alert">
                             	<option value="0" <?php echo ($this->input->post('show_finish_alert') == '0') ? 'selected="selected"' : (isset($quiz->show_finish_alert) && $quiz->show_finish_alert == '0') ? 'selected="selected"' : '' ?> >Show</option>
  	                            <option value="1" <?php echo ($this->input->post('show_finish_alert') == '1') ? 'selected="selected"' : (isset($quiz->show_finish_alert) && $quiz->show_finish_alert == '1') ? 'selected="selected"' : '' ?> >Hide</option>
							</select>

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
					</div>		
				</form>				
			</div>		
		</div>	
	</div>                    
</dd>
</div>
</div>
</div>
            
<div class="tab-pane" id="profile">
<dd class="<?php echo ($questions)?'selected': ''?>">
<div class="tab-content">
<div class="panel panel-primary" data-collapsed="0" style="margin-top: 20px; margin-right: 10px;"> 
	<div class="panel-heading"> 
		<div class="panel-title" style="font-size:14px; color: #09C; font-weight:bold; text-transform: uppercase;">
			<?php 
			if($updType == 'create')
			{
				echo 'New Exam';
	       	}
	       	if($updType == 'edit')
	       	{
	       		echo 'Edit Exam';
	        }
	        ?>
		</div> 
	</div> 
	<div class="panel-body"> 
			<div class="form-group"> 
				<label class="col-sm-3 control-label"></label> 
						
				<div class="col-sm-5"> 
					<a href='<?php echo base_url(); ?>quizzes/questlist/<?php echo ($qid != "")  ? $qid : "0"?>/<?php //echo $page?>' class='btn btn-primary create selectquestion'>
					<i class="entypo-plus"></i>Select Question</a>&nbsp;

			<a href='<?php echo base_url(); ?>quizzes/addquestion' class='btn btn-primary create addquestions'>
			<i class="entypo-plus"></i>Add Questions</a>&nbsp;
  			
  			<?php 
  			$totalMarksOutOfff =0;
				$totalMarksOutOf = 0;
				$quizid = $this->uri->segment(3) ? $this->uri->segment(3) :0; 
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
						// echo"<pre>";
						// print_r($data_right1);
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
					</div>
				</div>

				<div class="form-group"> 
					<label class="col-sm-3 control-label">Total Marks:</label> 
					
					<div class="col-sm-5"> 
						<input  class="form-control" type="text" value="<?php echo $totalMarksOutOfff ? $totalMarksOutOfff :'0'; ?>" id="totalmark"  readonly style="width:50px">	
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
				if ($questions): ?>
						<?php else: ?>
							 <p id="norecord" style="display:block" class='text'>There is no Question Selected,please Select Question or Add Question</p>
						<?php endif ?>
						<?php 
						$qidinstring = implode(",",$qidin);?>
						<input type="hidden" name="qidin" id="qidin" value="<?php echo $qidinstring;?>">
                         <span class="error"><?php echo form_error('qidin'); ?></span>
						<?php if($updType == 'edit'){?>
						<input type="hidden" name="delids" id="delids" value="">
					<?php }?>
						</div> 
					</div> 
			</div> 
		</div> 

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

		 <!-- <tr id="row<?php echo $queid;?>">  -->
		
		 <tr id="qli<?php echo $qzid;?>" >			
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
           ?>
            <td class=" ">
	            <!--<a href="<?php echo base_url(); ?>/admin/quizzes/editque/<?php echo $queid?>/<?php echo ($qid != "") ? $qid : "0" ?>/<?php //echo $page?>" class ="create fancybox fancybox.iframe">-->
				<span id="totalM<?php echo $queid;?>"><?php echo $totalMarksOutOf?></span>
			</td>

        	<td class=" ">
        	<span class="removespan"><a href="javascript:void(0);" onclick="deleteRow(this, <?php echo $totalMarksOutOf?>)" class="removeele" id="remove'+$(this).val()+'">Remove</a></span>
        	</td>

        	<td hidden="hidden">
        		<input type="hidden" name="qidck[]" id="qidck" value="<?php echo $gotQuestion->question_id?>">
        	</td>
		</tr>
		<?php
		}}}
		$qidin[] = $qid;?>
		<?php //endforeach		
		?>
	</tbody>
</table>
</div>
</dd>	
</div>
</div>		
</div>
</div>		
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
    for (i = 0; i < rows.length; i++) {
        rows[i].onclick = function()
        {
         	document.getElementById('totalmark').value = parseFloat(document.getElementById('totalmark').value - parseInt(para));
			if(this.rowIndex != 0)
			document.getElementById('quizzestoaddlist').deleteRow(this.rowIndex);
        }
    }
}
</script>

<!-- tool tip script -->
<script type="text/javascript">
//$(document).ready(function(){
//	$('.tooltipicon').click(function(){
//	var dispdiv = $(this).attr('id');
//	$('.'+dispdiv).css('display','inline-block');
//	});
//	$('.closetooltip').click(function(){
//	$(this).parent().css('display','none');
//	});
//	});
jQuery(document).ready(function(){
	jQuery('.tooltipicon').mouseenter(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.tooltipicon').mouseleave(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','none');
	});
	});
	</script>

<!-- tool tip script finish -->

<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
		<script>
		   var $j = jQuery.noConflict();
			$j(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				
			  //$j(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});			
			$j(".addquestions").colorbox({
				iframe:true,
				width:"55%", 
				height:"87%",
				fadeOut:500,
				fixed:true,
				reposition:true,								  
						})

			$j(".selectquestion").colorbox({
				iframe:true,
				width:"700px", 
				height:"700px",
				fadeOut:500,
				fixed:true,
				reposition:true,								  
						})
				});
			</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.23/jquery.form-validator.min.js"></script>
<script>
$j(document).ready(function(){
$j.validate({
	errorElementClass:"validateerrorbox",
	errorMessageClass:"validateerror",
	borderColorOnError:"red",
	errorMessagePosition:"top",
	 modules : 'logic',
});  //$('#my-textarea').restrictLength( $('#max-length-element') );

});  
</script>  
<script>
 function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
               return false;

   return true;
}

</script>