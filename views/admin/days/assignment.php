<div class="panel-heading">
	<div class="panel-title mb_20" style="padding: 0;width:100%;">
		<h2 class="tab_heading">Assignment Questions </h2>
		<p>Here to add Assignment Questions !</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h4>Questions List</h4>
			<form id="ques_form" method="post" action="" enctype="multipart/form-data">
				<table class="table table-bordered table-condensed table-stripped table-responsive">
					<thead>
						<tr class="text-center">
							<td style="width:42%" id="td_que">Question</td>
							<td style="width:41%" id="td_ans">Answer</td>
							<td style="width:17%">Action</td>
						</tr>
					</thead>
					<tbody id="append_data">
					<?php if(!empty($assign_ques)){
			foreach ($assign_ques as $key) { ?>
			<tr id="row_<?php echo $key->q_id; ?>">
				<td>
					<span style="word-wrap:anywhere" id="span_que_<?php echo $key->q_id;?>"><?php echo strip_tags($key->que_text);?></span>
					<textarea name="question[]" id="que_<?php echo $key->q_id;?>" style="display:none"><?php echo $key->que_text;?></textarea>
				</td>
				<td>
					<span style="word-wrap:anywhere" class="span_ans" id="span_ans_<?php echo $key->q_id; ?>"><?php echo strip_tags($key->ans_text);?>
					</span>
					<?php if (!empty($key->ans_attachment)){ ?>
					<a href="<?php echo base_url().'public/uploads/assignments/answer/'.$key->ans_attachment;?>" target='_blank'> <i class="fa fa-download" aria-hidden="true" style="font-size: 18px;float: right;"> </i> </a>
					<?php } ?>

					<div style="display: none" class="ans_class" id="div_ans_<?php echo $key->q_id; ?>">

						<textarea class="form-control description" id="answer_<?php echo $key->q_id; ?>" name="answer[]"><?php echo $key->ans_text;?></textarea>
						<span id="err_ans"></span>
						<label class="col-sm-12 field-title control-label">Add Answer Attachment</label>
						<div class="ans_attachment<?php echo $key->q_id; ?>">
							<input type="file" id="ans_attachment_<?php echo $key->q_id; ?>" value="" onchange="return attach_ans_file(<?php echo $key->q_id; ?>)" style="width: 100%">
				      	</div>
						<button type="button" class='btn btn-success btn-lg' style="width: 25% !important;margin-top: 10px" onclick="add_ans(<?php echo $key->q_id;?>)">Save</button>
					</div>
				</td>
				<td>
					<button class="btn btn-info btn-md" title="Answer" type="button" id="btn_ans_<?php echo $key->q_id; ?>" onclick="return add_answer(<?php echo $key->q_id; ?>)"><span class="lnr lnr-text-format"></span>
					</button> | 
					<button class="btn btn-success btn-md" title="Edit Question" type="button" id="btn_que_<?php echo $key->q_id; ?>" onclick="return edit_ques(<?php echo $key->q_id; ?>)"><span class="lnr lnr-pencil"></span>
					</button> | 
					<button class="btn btn-danger btn-md" title="Delete" type="button" id="btn_del_<?php echo $key->q_id; ?>" onclick="delete_row(<?php echo $key->q_id; ?>)"><span class="lnr lnr-trash"></span>
					</button>
				</td>
			</tr>
				<?php } } ?>
					</tbody>
				</table>
			</form>
		</div>
		<hr style="border-top: 1px solid #c8c8c8 !important">
	</div>
   	<div class="form-group form-border div_que">
      	<label for="field-1" class="col-sm-12 field-title control-label">Enter Question <span style="color:red">*</span> <span style="color:red" id="err_ques"></span></label>
      	<div class="col-sm-12">
         	<textarea id="que_text" name="que_text" class="form-control select-box-border description" rows="5"></textarea>
      	</div>
   	</div>
   	<div class="form-group form-border">
      	<label for="field-1" class="col-sm-12 field-title control-label">Add Attachment</label>
      	<div class="col-sm-12 que_attachment">
         	<div class="col-sm-6 div_que"><input type="file" name="que_attachment" id='que_attachment' value="" onchange="return attach_file()" style="width: 100%"></div>
      	</div>
   	</div>

   	<div class="form-group form-border" style="padding-top:2.5%!important">
   		<input type="hidden" id="q_id" value="">
      	<div class="col-sm-3">
        	<button type="button" id="btncheck" class='btn btn-info btn-lg' style="width: 75% !important" onclick="add_ques();">Add more Question</button>
      	</div>
      	<div class="col-sm-3">
        	<form method="post" action="<?php echo base_url('admin/section-management/'.$course_id);?>">
        		<button type="submit" id="btnsave" class='btn btn-success btn-lg' style="width: 75% !important">Save & Exit</button>
        	</form>
      	</div>
   	</div>
</div>