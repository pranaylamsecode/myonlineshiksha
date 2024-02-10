<form method="post" action="" enctype="multipart/form-data" id="form_demo">
	<div class="panel-heading">
		<div class="panel-title mb_20" style="padding: 0;width:100%;">
			<h2 class="tab_heading">Basic Information</h2>
		</div>
	   	<div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">Name <span style="color:red">*</span><span style="color:red" id="err_name"></span></label>
	      <div class="col-sm-12">
	         <input type="text" class="form-control form-height" value="<?php echo $assign_title;?>" name="name" id='name'>
	      </div>
	   </div>
	   <div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">Description <span style="color:red">*</span><span style="color:red" id="err_desc"></span></label>
	      <div class="col-sm-12">
	         <textarea id="description" name="description" class="form-control select-box-border description" rows="5">
	         	<?php echo $assign_description; ?>
	         </textarea>
	         <input name="image" type="file" id="upload" class="hidden" onchange="">
	      </div>
	   </div>
	</div>
	<div style="border-bottom: 2px solid;margin-bottom: 25px;margin-top: 25px;"></div>
	<div class="panel-heading">
		<div class="panel-title mb_20" style="padding: 0;width:100%;">
			<h2 class="tab_heading">Assignment Instructions</h2>
		</div>
	   <div class="form-group">
	      <label for="field-1" class="col-sm-12 field-title control-label">Description <span style="color:red">*</span><span style="color:red" id="err_instr"></span></label>
	      <div class="col-sm-12">
	         <textarea id="instruction" name="instruction" class="form-control select-box-border description" rows="5">
	         	<?php echo $assign_instruction; ?>
	         </textarea>
	      </div>
	   </div>
	   <div class="form-group">
	      <label for="field-1" class="col-sm-12 field-title control-label">Have Any Instruction Video ?<span style="color:red" id="err_fname"></span></label>
	      <div class="col-sm-12">
	         <input type="file" class="" name="instruction_videos" id='instruction_videos' accept="video/*">
	      </div>
	      <?php if(!empty($instruction_videos) && !file_exists("/public/uploads/assignments/instr_vdo/".$instruction_videos)){ ?>
			<video style="width:360px !important;height:240px !important;" controls>
			  <source src="<?php echo base_url().'public/uploads/assignments/instr_vdo/'.$instruction_videos;?>">
			  Your browser does not support the video tag.
			</video>
			<input type="hidden" id="old_video" value="<?php echo $instruction_videos;?>">
	  		<?php } ?>
	   </div>
	   <div class="form-group">
	      <label for="field-1" class="col-sm-12 field-title control-label">Have Any Resource File ?<span style="color:red" id="err_fname"></span></label>
	      <div class="col-sm-12">
	         <input type="file" class="" name="resources_files" id='resources_files'>
	      </div>
	    <?php if(!empty($resources_files) && !file_exists("/public/uploads/assignments/resource_file/".$resources_files)){ ?>
	      	<div class="col-sm-6">
	      		<iframe src="<?php echo base_url().'public/uploads/assignments/resource_file/'.$resources_files;?>" style="margin-top: 20px;margin-bottom: 10px;width: 360px;height: 240px;"></iframe>
	      		<a class="col-sm-12" style="float: left;font-size: 15px;" href="<?php echo base_url().'public/uploads/assignments/resource_file/'.$resources_files;?>" target="_blank"><?php echo $resources_files; ?></a>
	      	</div>
	      
	  		<?php } ?>
	   </div>
	   <div class="form-group form-border" style="padding-top:2.5%!important">
	      	<div class="col-sm-3">
	        	<button type="button" id="btncheck" class='btn btn-success btn-lg' style="width: 75% !important" onclick="return validation()"><?php echo $updType;?></button>
	      	</div>
	   </div>
	   <input type="hidden" name="assign_id" id="assign_id" value="<?php echo $assign_id; ?>">
	   <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>">
	   <input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>">
	</div>
</form>
