<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/quizcountdown', $attributes) : form_open_multipart(base_url().'admin/settings/quizcountdown');



?>



<div id="toolbar-box">



	<div class="m">



		<div id="toolbar" class="toolbar-list">



			

			<div class="clr"></div>



		</div>



		<div class="pagetitle icon-48-generic"><h2><?php echo 'Quiz Countdown Settings';?></h2></div>



	</div>



</div>



<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/colorpicker.js"></script>




<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Quiz Countdown
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
						<label class="col-sm-3 control-label">Alignment</label>
						
						<div class="col-sm-5">
							
                            <select name="timer_alignement" id="timer_alignement" class="form-control" style="width: 50%;">



                    <option value="1" <?php echo ( $qct_alignment == '1' )? 'selected="selected"' : ''?>>Left</option>



			    	<option value="2" <?php echo ( $qct_alignment == '2' )? 'selected="selected"' : ''?>>Right</option>



				    <option value="3" <?php echo ( $qct_alignment == '3' )? 'selected="selected"' : ''?>>Center</option>



				</select>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="timer_alignement-target" class="tooltipicon"></span>

						<span class="timer_alignement-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_timer_alignement');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Border color</label>
						
						<div class="col-sm-5">
							
                            <div>



                    <div style="float:left;">



                    	<input type="text" size="7" name="st_donecolor" ID="pick_donecolorfield" value="<?php echo $qct_border_color;?>" onChange="if (this.value.length == 6) {relateColor('pick_donecolor', this.value);}" size="6" maxlength="6" onkeyup="if (this.value.length == 6) {relateColor('pick_donecolor', this.value);}" class="form-control" />





                    </div>
					

                        &nbsp;



                        <a href="javascript:pickColor('pick_donecolor');" onClick="document.getElementById('show_hide_box').style.display='none';" id="pick_donecolor" style="border: 1px solid #000000; font-family:Verdana; font-size:10px; text-decoration: none;">



                        &nbsp;&nbsp;&nbsp;



                        </a>



                        <SCRIPT LANGUAGE="javascript">relateColor('pick_donecolor', getObj('pick_donecolorfield').value);</script>



                        &nbsp;&nbsp;&nbsp;


<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="border_color-target" class="tooltipicon"></span>

						<span class="border_color-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_border-color');?>

                         <!--/tip containt-->

						</span>

						</span>

						<!-- tooltip area finish -->

                	</div>
                            
					</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Minutes &amp; Seconds Color</label>
						
						<div class="col-sm-5">
							
                            <div>



                	<div style="float:left;">



                    	<input type="text" onkeyup="if (this.value.length == 6) {relateColor('pick_notdonecolor', this.value); changeBcolor();}" maxlength="6" onchange="changeBcolor(); relateColor('pick_notdonecolor', this.value);" value="<?php echo $qct_minsec; ?>" id="pick_notdonecolorfield" name="st_notdonecolor" size="7" class="form-control">



                        


                    </div>
					&nbsp;



                        <a style="border: 1px solid rgb(0, 0, 0); font-family: Verdana; font-size: 10px; text-decoration: none; background: none repeat scroll 0% 0% rgb(0, 0, 0); color: rgb(0, 0, 0);" id="pick_notdonecolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_notdonecolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a>







                        <script language="javascript">relateColor('pick_notdonecolor', getObj('pick_notdonecolorfield').value);</script>



                        <span id="show_hide_box"></span>



                        &nbsp;&nbsp;&nbsp;



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="text_color-target" class="tooltipicon"></span>

						<span class="text_color-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_text-color');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                    <div style="float:left;">







                    </div>



                </div>
                            
						</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Title color</label>
						
						<div class="col-sm-5">

                            <div>



                	<div style="float:left;">



                    	<input type="text" onkeyup="if (this.value.length == 6) {relateColor('pick_txtcolor', this.value);}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_txtcolor', this.value);}" value="<?php echo $qct_title_color; ?>" id="pick_txtcolorfield" name="st_txtcolor" size="7" class="form-control">



                        


                    </div>

					&nbsp;



                        <a style="border: 1px solid rgb(0, 0, 0); font-family: Verdana; font-size: 10px; text-decoration: none; background: none repeat scroll 0% 0% rgb(255, 255, 255); color: rgb(255, 255, 255);" id="pick_txtcolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_txtcolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a>



                        <script language="javascript">relateColor('pick_txtcolor', getObj('pick_txtcolorfield').value);</script>



                        <span id="show_hide_box"></span>



                        &nbsp;&nbsp;&nbsp;


<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="title_color-target" class="tooltipicon"></span>

						<span class="title_color-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_title-color');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                    <div style="float:left;">



                    </div>



                </div>
						</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Background color</label>
						
						<div class="col-sm-5">
							
                            <div>



                	<div style="float:left;">



                    	<input type="text" onkeyup="if (this.value.length == 6) {relateColor('pick_xdonecolor', this.value);}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_xdonecolor', this.value);}" value="<?php echo $qct_bg_color; ?>" id="pick_xdonecolorfield" name="st_xdonecolor" size="7" class="form-control">



                        


                    </div>


						&nbsp;



                        <a style="border: 1px solid rgb(0, 0, 0); font-family: Verdana; font-size: 10px; text-decoration: none; background: none repeat scroll 0% 0% rgb(255, 255, 204); color: rgb(255, 255, 204);" id="pick_xdonecolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_xdonecolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a>







                        <script language="javascript">relateColor('pick_xdonecolor', getObj('pick_xdonecolorfield').value);</script>



                        <span id="show_hide_box"></span>



                        &nbsp;&nbsp;&nbsp;

 <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="bg_color-target" class="tooltipicon"></span>

						<span class="bg_color-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_background-color');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                    <div style="float:left;">



                    </div>



                </div>
                            
                            
						</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Font Family</label>
						
						<div class="col-sm-5">
							
                            <select onchange="javascript:guruchangeFont(value)" name="font" id="font" class="form-control" style="width: 50%;">



				<option value="Arial" <?php echo ( $qct_font == 'Arial' )? 'selected="selected"' : ''?>>Arial</option>



				<option value="Helvetica" <?php echo ( $qct_font == 'Helvetica' )? 'selected="selected"' : ''?>>Helvetica</option>



				<option value="Garamond" <?php echo ( $qct_font == 'Garamond' )? 'selected="selected"' : ''?>>Garamond</option>



				<option value="sans-serif" <?php echo ( $qct_font == 'sans-serif' )? 'selected="selected"' : ''?>>Sans Serif</option>



				<option value="Verdana" <?php echo ( $qct_font == 'Verdana' )? 'selected="selected"' : ''?>>Verdana</option>



			</select>





<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="font-target" class="tooltipicon"></span>

						<span class="font-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_font-family');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Width</label>
						
						<div class="col-sm-5">
							
                            <div>



                	<div style="float:left;">



                    	<input type="text" onchange="javascript:guruchangeSizeW(value)" value="<?php echo $qct_width; ?>" id="st_width" name="st_width" size="7" class="form-control">



                    </div>



                    



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="width-target" class="tooltipicon"></span>

						<span class="width-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_width');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                    <div style="float:left;">



                    	&nbsp;&nbsp; px &nbsp;



                    </div>


                </div>
						</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Height</label>
						
						<div class="col-sm-5">
							
                            <div>



                	<div style="float:left;">



                    	<input type="text" onchange="javascript:guruchangeSizeH(value)" value="<?php echo $qct_height; ?>" id="st_height" name="st_height" size="7" class="form-control">



                    </div>



                    <div style="float:left;">



                    	&nbsp;&nbsp; px &nbsp;



                    </div>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="height-target" class="tooltipicon"></span>

						<span class="height-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_height');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                    <div style="float:left;">



                    </div>



                </div>
						</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Numbers font size</label>
						
						<div class="col-sm-5">
							
                            
                            <div>



                	<div style="float:left; width: 50%;">



                    	<select onchange="javascript:guruchangeSizeFN(value)" style="float:none !important; " name="fontnb" id="fontnb" class="form-control">



                            <?php for($i=10;$i<=50;$i++){ ?>



                              <option value="<?php echo $i; ?>" <?php echo ( $qct_font_nb == $i )? 'selected="selected"' : ''?>><?php echo $i; ?></option>



                            <?php } ?>



                         </select>

                    

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="numbers_font_size-target" class="tooltipicon"></span>

						<span class="numbers_font_size-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_numbers-font-size');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                    </div>

                    <div style="display:inline;"> &nbsp;&nbsp; px &nbsp; </div>



                </div>
						</div>
					</div>
                    <br />
                    <br />
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Words font size</label>
						
						<div class="col-sm-5">
							
                            <div>



                	<div style="float:left; width: 50%;">



                    	<select onchange="javascript:guruchangeSizeFW(value)" style="float:none !important;" name="fontwords" id="fontwords" class="form-control">



                            <?php for($i=10;$i<=50;$i++){ ?>



                              <option value="<?php echo $i; ?>" <?php echo ( $qct_font_words == $i )? 'selected="selected"' : ''?>><?php echo $i; ?></option>



                            <?php } ?>



                        </select>

                    

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="words_font_size-target" class="tooltipicon"></span>

						<span class="words_font_size-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('quizCountdown_fld_words-font-size');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->                    

                    </div>

                    <div style="display:inline;"> &nbsp;&nbsp; px &nbsp; </div>



                </div>
						</div>
					</div>
                    <br />
                    <br />
					<br />
                    <br />
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Preview</label>
						
						<div class="col-sm-5">
							<div style="width:<?php echo $qct_width; ?>px; height:<?php echo $qct_height; ?>px; border: 1px solid; border-color:#<?php echo $qct_border_color; ?>; font-family:<?php echo $qct_font; ?>; background-color:#<?php echo $qct_bg_color; ?>;" id="divtotal">



                <div align="center" style="border-bottom:1px #000000 solid; font-size:18px; color:#<?php echo $qct_minsec; ?>; background-color:#<?php echo $qct_border_color; ; ?>;" id="timeleft">Time left</div>



                	<div style="background-color:#<?php echo $qct_bg_color; ?>;" id="totalbg">



                        <div align="center" style="font-size:28px; color:#<?php echo $qct_title_color; ?>;" id="timetest">04  &nbsp;  26</div>



                        <div align="center" style="font-size:18px;" id="minsec">Minutes  Seconds</div>



                    </div>



                </div>
						</div>
					</div>
                    
                    
                    
                    
                    



				<br />
                <br />

				<br />
                <br />
                
				<br />
                <br />
					
					
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
                            <a>
								<?php echo form_submit( 'submit', "Save","id='submit' class='btn btn-default'"); ?>
							</a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>





<div class="clr"></div>



<noscript>



  Warning! JavaScript must be enabled for proper operation of the Administrator backend.



</noscript>







<?php echo form_close(); ?>





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