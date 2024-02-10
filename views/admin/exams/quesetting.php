	<hr>
					<h3>Questions Setting:</h3><br>
					<input type="hidden" name="" id="availQues_que" value="">
						<div class="form-group">
						<label class='col-sm-12 no-padding control-label' for="name">Select Class<span class="required">*</span></label>
						<div class="col-sm-12 no-padding">
						<select class="autoQue Quecat" style="float:left !important;" name="Quecat" id="Quecat_que">
						                	<option value="" selected="selected">SELECT CLASS</option>
						               <?php $CI = & get_instance(); //used to load model inside view page
						$CI->load->model('admin/exam_model');
		                $Qcat = $CI->exam_model->getClasscategory(); 
		                foreach ($Qcat as $Quecat) { ?>
		                 	<option value="<?php echo $Quecat->name ?>" ><?php echo $Quecat->name ?></option>
		               <?php  } ?>
						                  <?php //echo ($this->input->post('is_final') == '0') ? 'selected="selected"' : (isset($quiz->is_final) && $quiz->is_final == '0') ? 'selected="selected"' : '' ?>
										</select>
						</div>
								</div>
						<br>
						<div class="form-group">
						<label class='col-sm-12 control-label no-padding' for="name">Select Subject<span class="required">*</span></label>
						<div class="col-sm-12 no-padding">
										
						<!--  <select class="autoQue Quesubcat" style="float:left !important;" name="Quesubcat" id="Quesubcat_que">
						                	<option value="" selected="selected">SELECT SUBJECT</option>
						               
										</select> -->
							<select class="autoQue Quesubcat1" style="float:left !important;" name="Quesubcat" id="Quesubcat_que2">
			                	<option value="" selected="selected">SELECT CLASS</option>
				                <?php $CI = & get_instance(); //used to load model inside view page
								$CI->load->model('admin/exam_model');
				                $Qcat = $CI->exam_model->getSubjectcategory(); 
				                foreach ($Qcat as $Quecat) { ?>
				                 	<option value="<?php echo $Quecat->name ?>" ><?php echo $Quecat->name ?></option>
				               <?php  } ?>
				                  <?php //echo ($this->input->post('is_final') == '0') ? 'selected="selected"' : (isset($quiz->is_final) && $quiz->is_final == '0') ? 'selected="selected"' : '' ?>
							</select>
						</div>
								</div>
						<br>
								<div class="form-group">
						<label class='col-sm-12 no-padding control-label' for="name">Select type of Question <span class="required">*</span></label>
						<div class="col-sm-12 no-padding">
										
						                <select class="autoQue Questype" style="float:left !important;" name="Questype" id="Questype_que">
						                	<option value="" selected="selected">SELECT TYPE OF QUESTIONS
						                	</option>
										</select>
						</div>
								</div>
										<br>
						<div class="form-group">
												
									<label class='number_of_que col-sm-12 no-padding control-label' for="name">No.of questions to list-down<span class="required">*</span></label>
									<div class="col-sm-12 no-padding">
						 <input id="NumQues_que" type="number" class="autoQue NumQues" name="NumQues" maxlength="256"  data-validation-error-msg="Enter no. of questions want to show in the section." />
						                <span id='counterror_que' style="color: red"></span>
						</div>
								</div><br>

								<div class="form-group">
												
									<label class='number_of_que col-sm-12 no-padding control-label' for="name">No.of questions to add<span class="required">*</span></label>
									<div class="col-sm-12 no-padding">
						 <input id="NumAdd_que" type="number" class="autoQue NumAddQ" name="" maxlength="256"  data-validation-error-msg="Enter no. of questions want to show in the section." />
						                <span id='Adderror_que' style="color: red"></span>
						</div>
								</div><br>