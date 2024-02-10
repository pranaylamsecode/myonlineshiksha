<div class="panel-heading">
	<div class="panel-title mb_20" style="padding: 0;width:100%;">
		<h2 class="tab_heading"><?= $type; ?> Information</h2>
		<p>Manage the <?= $type; ?>s information</p>
	</div>
</div>
<div class="row">
   <form method="post" action="<?php echo base_url('admin/resellers/'.$btnAction);?>" id="info_form">
	   <div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">First Name <span style="color:red">*</span><span style="color:red" id="err_fname"></span></label>
	      <div class="col-sm-12">
	         <input type="text" class="form-control form-height" value="<?php if(!empty($reff_info->first_name)){ echo $reff_info->first_name;}?>" name="fname" id='fname'>
	      </div>
	   </div>
	   <div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">Last Name <span style="color:red">*</span><span style="color:red" id="err_lname"></span></label>
	      <div class="col-sm-12">
	         <input type="text" class="form-control form-height" value="<?php if(!empty($reff_info->last_name)){ echo $reff_info->last_name;}?>" name="lname" id="lname">
	      </div>
	   </div>
	   <div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">E-mail <span style="color:red" id="err_email"></span></label>
	      <div class="col-sm-12">
	         <input type="text" class="form-control form-height" value="<?php if(!empty($reff_info->email)){ echo $reff_info->email;}?>" name="email" id="email">
	      </div>
	   </div>
	   <div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">Contact no. <span style="color:red">*</span><span style="color:red" id="err_contact"></span></label>
	      <div class="col-sm-12">
	         <input type="text" class="form-control form-height" name="contact_no" id="contact_no" value="<?php if(!empty($reff_info->mobile)){ echo $reff_info->mobile;}?>" onkeypress="return only_number(event)" maxlength="12" >
	      </div>
	   </div>
	   <?php if(!empty($reff_info)){ ?>
	   	<div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">Referral code </label>
	      <div class="col-sm-12">
	         <input type="text" class="form-control form-height" value="<?php echo $reff_info->referral_code; ?>" name="referral_code" readonly="">
	      </div>
	   	</div>
	   	<?php }if($updType=="Create"){ ?>
	   	<div class="form-group form-border">
         	<label for="field-1" class="col-sm-12 field-title control-label"><?= $type; ?> Type <span style="color:red" id="err_type"></span></label>
         	<div class="col-sm-12">
            	<select name="partner_type" id="partner_type" class="form-control form-height" onchange="show_parent(this.value)">
					<option value="0">Select type</option>
					<option value="1" <?php if(!empty($assess_info)){if($assess_info->ass_type==1){echo "selected";}} ?>>Reseller</option>
					<option value="2" <?php if(!empty($assess_info)){if($assess_info->ass_type==2){echo "selected";}} ?>>Sub-Reseller</option>
	            </select>
         	</div>
      	</div>
      	<div class="form-group form-border" style="display: none" id="rparent_div">
         	<label for="field-1" class="col-sm-12 field-title control-label">Parent Reseller <span style="color:red">*</span><span style="color:red" id="err_parent"></span></label>
         	<div class="col-sm-12">
            	<select name="parent_id" id="parent_id" class="form-control form-height" onchange="$('#referred').val('');">
					<option value="">Select Reseller</option>
					<?php if(!empty($parent_reseller)){
					foreach ($parent_reseller as $key) { ?>
					<option value="<?php echo $key->id; ?>" commission-value="<?= $key->assessment; ?>"><?php echo $key->first_name." ".$key->last_name." ( ".$key->assessment." %)";?></option>
					<?php } } ?>
	            </select>
         	</div>
      	</div>
		<div class="form-group form-border">
         	<label for="field-1" class="col-sm-12 field-title control-label">Assessment Rate <span style="color:red">*</span><span style="color:red" id="err_assess"></span></label>
         	<div class="col-sm-12">
            	<input type="text" class="form-control form-height" value="<?php if(!empty($assess_info->assessment)){echo $assess_info->assessment;} ?>" name="referred" id="referred" onkeypress="return only_number(event)" onkeyup="checkmax(this.value)" maxlength="2">
         	</div>
      	</div>
      <?php } ?>

	   <div class="form-group form-border">
	      <label for="field-1" class="col-sm-12 field-title control-label">Status </label>
	      <div class="col-sm-2">
	         <label style="font-size: 18px"><input type="radio" name="active" id="active" <?php if($reff_info->active=='1'){echo 'checked';}if ($updType=='Create') {echo 'checked'; } ?> value="1"> <b>Active</b></label>
	      </div>
	      <div class="col-sm-2">
	         <label style="font-size: 18px"><input type="radio" name="active" id="active" <?php if($reff_info->active=='0'){echo 'checked';} ?> value="0"> <b>Inactive</b></label>
	      </div> 
	   </div>
	   
	   <div class="form-group form-border" style="padding-top:2.5%!important">
	      	<div class="col-sm-3">
	        	<button type="button" id="btncheck" class='btn btn-success btn-lg' style="width: 75% !important" onclick="check_info();"><?php echo $updType;?></button>
	      	</div>
	   </div>
	   <input type="hidden" name="user_id" id="user_id" value="<?php if(!empty($reff_info)){echo $reff_info->id;}?>">
   </form>
</div>