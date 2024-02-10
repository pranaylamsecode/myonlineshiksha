<div class="panel-heading">
   <div class="panel-title mb_20" style="padding: 0;width:100%;">
      <h2 class="tab_heading"><?= $type; ?> Assessments</h2>
      <p>Manage the <?= $type; ?>s assessment</p>
   </div>
</div>
<div class="row">
      <div class="form-group form-border">
         <label for="field-1" class="col-sm-12 field-title control-label">Reseller Type ( it can't get changed if its Sub-Reseller. )<span id="err_type"></span></label>
         <div class="col-sm-12">
            <select name="partner_type" id="partner_type" class="form-control form-height">
               <option value="0" <?php if(!empty($assess_info)){if($assess_info->ass_type==2){echo "disabled";}} ?>>Select type</option>
               <option value="1" <?php if(!empty($assess_info)){if($assess_info->ass_type==1){echo "selected";}if($assess_info->ass_type==2){echo "disabled";}} ?>>Reseller</option>
               <option value="2" disabled="" <?php if(!empty($assess_info)){if($assess_info->ass_type==2){echo "selected";}} ?>>Sub-Reseller</option>
            </select>
         </div>
      </div>
      <div class="form-group form-border">
         <label for="field-1" class="col-sm-12 field-title control-label">Assessment Type :</label>
         <div class="col-sm-1">
            <label style="font-size: 18px"><input type="radio" name="assess_type" id="assess_type" value="2" checked=""> <b>%</b></label>
         </div>   
      </div>
      <div class="form-group form-border">
         <label for="field-1" class="col-sm-12 field-title control-label">Assessment Rate <span style="color:red" id="err_rate"></span></label>
         <div class="col-sm-12">
            <input type="text" class="form-control form-height" value="<?php if(!empty($assess_info->assessment)){echo $assess_info->assessment;} ?>" name="referred" id="referred" onkeypress="return only_number(event)" maxlength="2">
         </div>
      </div>
      <div class="form-group form-border" style="padding-top:2.5%!important;">
         <div class="col-sm-3">
            <button type="button" onclick="return check_assess()" id="btnassess" class="btn btn-success btn-lg" style="width: 75% !important"><?php echo $updType;?></button>
         </div>
      </div>
</div>