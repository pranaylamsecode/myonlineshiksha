<?php



$attributes = array('class' => 'tform', 'id' => '');



echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/progressbar', $attributes) : form_open_multipart(base_url().'admin/settings/progressbar');



?>



<div id="toolbar-box">



	<div class="m">

		<div class="pagetitle icon-48-generic"><h2><?php echo 'Progress Bar Settings';?></h2></div>

	</div>



</div>



<script type="text/javascript" src="<?php echo base_url(); ?>public/js/colorpicker.js"></script>







<div class="zone_description"></div>



	<fieldset class="adminform">



	<legend></legend>



	<table class="adminform">



		<tbody>
        
        <tr>



			<td width="15%">


			</td>



			<td>



				



			</td>



		</tr>



		<tr>



			<td width="15%">



			</td>



			<td>



            	


			</td>



		</tr>



		<tr>



			<td>



							</td>



			<td>



            	

			</td>



		</tr>



		<tr>



			<td>



							</td>



			<td>



            	



			</td>



		</tr>



		<tr>



			<td>



							</td>



			<td>



            	



			</td>



		</tr>



		<tr>



			<td>



							</td>



			<td>



			</td>



		</tr>



	</tbody></table>



	</fieldset>



	    <input type="hidden" value="1" name="id">


<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<h3>Progress Bar</h3>(Here you can set up the colors and size of the progress bar that shows up on the lesson page on the front end.)
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
						<label class="col-sm-3 control-label">Show Progress Bar :</label>
						
						<div class="col-sm-5">
							
                        <select name="progress_bar" id="progress_bar" class="form-control" style="width:200px;">

                  				<option value="0" <?php echo ( $progress_bar == '0' )? 'selected="selected"' : ''?> >Yes</option>

			        			<option value="1" <?php echo ( $progress_bar == '1' )? 'selected="selected"' : ''?>>No</option>

						</select>


<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="progress_bar-target" class="tooltipicon"></span>

						<span class="progress_bar-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('progressBar_fld_show');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Done Color :</label>
						
						<div class="col-sm-5">
							
                    	<input type="text" onkeyup="if (this.value.length == 6) {relateColor('pick_rdonecolor', this.value);}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_rdonecolor', this.value);}" value="<?php echo $st_donecolor; ?>" style="width:200px; float:left;" class="form-control" id="pick_rdonecolorfield" name="st_donecolor" size="7">


                        &nbsp;


						<div class="col-sm-5" style="margin-top:8px;">
                        <a style="border: 1px solid rgb(0, 0, 0); font-family: Verdana; font-size: 10px; text-decoration: none; background: none repeat scroll 0% 0% rgb(51, 153, 0); color: rgb(51, 153, 0);" id="pick_rdonecolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_rdonecolor');">

                        &nbsp;&nbsp;&nbsp;

                        </a>
						


                        <script language="javascript">relateColor('pick_rdonecolor', getObj('pick_rdonecolorfield').value);</script>



                        &nbsp;&nbsp;&nbsp;

                      </div>
<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="donecolor-target" class="tooltipicon"></span>

						<span class="donecolor-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('progressBar_fld_done-color');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Not Done Color :</label>
						
						<div class="col-sm-5">
							
                    	<input type="text" class="form-control" style="width:200px; float:left;" onkeyup="if (this.value.length == 6) {relateColor('pick_pnotdonecolor', this.value);}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_pnotdonecolor', this.value);}" value="<?php echo $st_notdonecolor; ?>" id="pick_pnotdonecolorfield" name="st_notdonecolor" size="7">



                        &nbsp;

						<div class="col-sm-5" style="margin-top:8px;">

                        <a style="border: 1px solid rgb(0, 0, 0); font-family: Verdana; font-size: 10px; text-decoration: none; background: none repeat scroll 0% 0% rgb(153, 0, 0); color: rgb(153, 0, 0);" id="pick_pnotdonecolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_pnotdonecolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a>



                        <script language="javascript">relateColor('pick_pnotdonecolor', getObj('pick_pnotdonecolorfield').value);</script>



                        <span id="show_hide_box"></span>



                        &nbsp;&nbsp;&nbsp;

                       </div>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="notdonecolor-target" class="tooltipicon"></span>

						<span class="notdonecolor-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('progressBar_fld_not-done-color');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Current Lesson Color :</label>
						
						<div class="col-sm-5">
					
                    	<input type="text" style="width:200px; float:left;" class="form-control" onkeyup="if (this.value.length == 6) {relateColor('pick_stxtcolor', this.value);}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_stxtcolor', this.value);}" value="<?php echo $st_txtcolor; ?>" id="pick_stxtcolorfield" name="st_txtcolor" size="7">

                         &nbsp;

                         <div class="col-sm-5" style="margin-top:8px;">


                        <a style="border: 1px solid rgb(0, 0, 0); font-family: Verdana; font-size: 10px; text-decoration: none; background: none repeat scroll 0% 0% rgb(255, 204, 0); color: rgb(255, 204, 0);" id="pick_stxtcolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_stxtcolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a>



                        <script language="javascript">relateColor('pick_stxtcolor', getObj('pick_stxtcolorfield').value);</script>



                        <span id="show_hide_box"></span>



                        &nbsp;&nbsp;&nbsp;

                       </div>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="lessoncolor-target" class="tooltipicon"></span>

						<span class="lessoncolor-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('progressBar_fld_lesson-color');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Width :</label>
						
					<div class="col-sm-5">
							                      
                	<div style="float:left;">

                    	<input type="text" value="<?php echo $st_width; ?>" class="form-control" style="width:200px;" name="st_width" size="4">

                    </div>

                    <div style="float:left;">

                    	&nbsp; &nbsp; px &nbsp;

                    </div>


<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="st_width-target" class="tooltipicon"></span>

						<span class="st_width-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('progressBar_fld_width');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
							
						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Height :</label>
						
						<div class="col-sm-5">
						
                            <div style="float:left;">



                    	<input type="text" value="<?php echo $st_height; ?>" name="st_height" size="4" class="form-control" style="width:200px;">



                    </div>



                    <div style="float:left;">



                    	&nbsp; &nbsp; px &nbsp;



                    </div>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="st_height-target" class="tooltipicon"></span>

						<span class="st_height-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('progressBar_fld_height');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
					
					
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
                            <?php echo form_submit( 'submit', "Save","id='submit' class='btn btn-default'"); ?><br />
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>
</div>




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