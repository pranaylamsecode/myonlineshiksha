	<hr>
					<h3>Questions Setting:</h3><br>
					<input type="hidden" name="" id="availQues_sec" value="">
						<div class="form-group">
						<label class='col-sm-12 no-padding control-label' for="name">Select category<span class="required">*</span></label>
						<div class="col-sm-12 no-padding">
						<select class="autoQue Quecat" style="float:left !important;" name="Quecat" id="Quecat_sec">
						                	<option value="" selected="selected">SELECT CATEGORY</option>
						                <?php $CI = & get_instance(); //used to load model inside view page
										$CI->load->model('admin/exam_model');
						               $Qcat = $CI->exam_model->getQuecategory(); 
						                foreach ($Qcat as $Quecat) { ?>
						                 	<option value="<?php echo $Quecat->que_category ?>" ><?php echo $Quecat->que_category ?></option>
						               <?php  } ?>
						                  <?php //echo ($this->input->post('is_final') == '0') ? 'selected="selected"' : (isset($quiz->is_final) && $quiz->is_final == '0') ? 'selected="selected"' : '' ?>
										</select>
						</div>
								</div>
						<br>
						<div class="form-group">
						<label class='col-sm-12 control-label no-padding' for="name">Select sub-category<span class="required">*</span></label>
									<div class="col-sm-12 no-padding">
										
						 <select class="autoQue Quesubcat" style="float:left !important;" name="Quesubcat" id="Quesubcat_sec">
						                	<option value="" selected="selected">SELECT SUB-CATEGORY</option>
						               
										</select>
						</div>
								</div>
						<br>
								<div class="form-group">
						<label class='col-sm-12 no-padding control-label' for="name">Select type of Question <span class="required">*</span></label>
						<div class="col-sm-12 no-padding">
										
						                <select class="autoQue Questype" style="float:left !important;" name="Questype" id="Questype_sec">
						                	<option value="" selected="selected">SELECT TYPE OF QUESTIONS
						                	</option>
										</select>
						</div>
								</div>
										<br>
						<div class="form-group">
												
									<label class='number_of_que col-sm-12 no-padding control-label' for="name">No.of Questions to show<span class="required">*</span></label>
									<div class="col-sm-12 no-padding">
						 <input id="NumQues_sec" type="number" class="autoQue NumQues" name="NumQues" maxlength="256"  data-validation-error-msg="Enter no. of questions want to show in the section." />
						                <span id='counterror_sec' style="color: red"></span>
						</div>
								</div><br>