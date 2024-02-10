<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
.page-container .main-content {
    padding: 10px 30px 68px 30px !important;
}
.pagetitle {
    padding: 15px 0px 0px 0px;
}
.pagetitle{
  margin-bottom: 25px;
}
@media (max-width: 991px){
footer.main {
    padding: 20px 15px 20px 10px !important;
    width: 100%;
    left: 0px;
}
  .reseller_table_section .control-label.field-title {
    padding: 15px 0px 10px 0px;
    font-size: 20px !important;
    margin-bottom: 0px;
}
.pagetitle {
    padding: 15px 0px 5px 0px;
    margin-bottom: 0px;
}
.pagetitle h2 {
    margin: 0px 0px 15px 0px !important;
    font-size: 26px;
}
.pagetitle h4 {
    font-size: 16px;
    line-height: 1.5em;
}
.panel-body.form-body {
    border: 1px solid #ebebeb!important;
    border-radius: 2px!important;
    padding: 25px 15px 40px 15px!important;
    margin: 0px 0px 25px 0px;
}
.panel-body.form-body .col-md-8, .panel-body.form-body .col-md-4, .panel-body.form-body .col-sm-12 {
    padding: 0px !important;
}
  .main-content .admin_header {
    padding: 3px 0px 13px 0px !important;
    margin-left: -15px !important;
    margin-right: -15px !important;
  }
  .page-container #sidemenu.sidebar-menu .logo-env {
    padding: 10px 10px 10px 10px !important;
    display: flex;
}
  .sidebar-collapsed .sidebar-menu .sidebar-collapse-icon span.lnr{
    margin-right: 3px !important;
    color: #333 !important;
    font-size: 30px;
  }
   .page-container .main-content {
    padding: 10px 15px 68px 15px !important;
    left: 0px !important;
  }
  .reseller_table_section {
    padding: 0px;
    margin-bottom: 40px;
  }
  .reseller_table_section table{
    width: 100%;
  }
  .open_mobile_sidebar{
    display: inline-block !important;
    position: absolute;
    left: 10px;
    top: 5px;
  }
  .close_mobile_sidebar {
    display: inline-block !important;
    position: unset;
    text-align: right;
    width: 15%;
    order: 3;
}
.page-body .page-container .sidebar-menu .logo-env > div.logo {
    width: 70% !important;
    order: 2;
    text-align: center;
    display: inline-block !important;
}
.page-body .page-container .sidebar-menu .logo-env > div.logo img {
    margin: 0px !important;
    width: auto !important;
    max-width: 100% !important;
    max-height: 60px !important;
    padding: 0px;
    height: auto !important;
}
.close_mobile_sidebar span {
    font-size: 25px;
    color: #5a5a5a;
}
body .page-container #sidemenu.sidebar-menu.sidebar-menu.sidemenu_mobile .home_link {
    order: 1;
    text-align: left;
    display: flex;
    width: 15%;
}


body .page-container #sidemenu.sidebar-menu.sidebar-menu.sidemenu_mobile .home_link img {
    width: auto;
    height: auto;
}
  body .page-container #sidemenu.sidebar-menu.sidebar-menu{
    position: fixed !important;
    left: -280px !important;
    z-index: 9999 !important;
    height: 100vh;
    width: 280px !important;
     transition: 0.5s;
  }
  .page-body .page-container .sidebar-menu li .list_text {
    display: inline-block !important;
}
.page-container .sidebar-menu #main-menu li ul {
    visibility: visible !important;
    height: auto !important;
}
  .fix_logo_btm {
    display: none !important;
}
  .page-container{
    padding-left: 0px !important;
  }
  body .page-container #sidemenu.sidebar-menu.sidebar-menu.sidemenu_mobile{
      left: 0px !important;
    height: 100vh;
    top: 0px !important;
    overflow: auto;
   
}

}

</style>
<div class="main-container">
<div class="col-sm-12 pagetitle" >
	<h2>Profile Settings</h2>
</div>
<div class="field_container">
<div class="row">
	<div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-primary primary-border" data-collapsed="0">
			<div class="panel-heading">
			</div>
			<div class="panel-body form-body">
				<form method="post" action="<?php echo base_url();?>partner/setting" enctype="multipart/form-data">
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 control-label field-title">First Name<span class="error">* </span><span id="err_fname"></span></label>
						<div class="col-sm-12">
              <input id="first_name" type="text" name="first_name" class="form-control form-height" placeholder="Enter first name" maxlength="256" value="<?php if(!empty($reseller->first_name)){echo $reseller->first_name;} ?>" /> <span>&nbsp;</span>
						</div>
					</div>
	                <div class="form-group form-border">
						<label for="Last Name" class="col-sm-12 field-title control-label">Last Name<span class="error">* </span><span id="err_lname"></span></label>
						<div class="col-sm-12">
              <input id="last_name" class="form-control form-height" placeholder="Enter last name" type="text" name="last_name" maxlength="256" value="<?php if(!empty($reseller->last_name)){echo $reseller->last_name;} ?>"/><span>&nbsp;</span>
						</div>
					</div>
	                <div class="form-group form-border">
						<label for="Email" class="col-sm-12 field-title control-label">Email</label>
						<div class="col-sm-12">
              <input class="form-control form-height" placeholder="Enter email id" type="text" value="<?php if(!empty($reseller->email)){echo $reseller->email;} ?>" name="email" /><span>&nbsp;</span>
						</div>
					</div>
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Contact No. <span id="err_contactno"></span></label>
						<div class="col-sm-12">
              <input id="mobile" class="form-control form-height" placeholder="Enter Contact No." type="text" name="mobile" maxlength="12" value="<?php if(!empty($reseller->mobile)){echo $reseller->mobile;} ?>" autocomplete="off" onkeypress="return only_number(event)" /><span>&nbsp;</span>
						</div>
					</div>
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Business Name <span id="err_businessName"></span></label>
						<div class="col-sm-12">
              <input id="business_name" class="form-control form-height" placeholder="Enter Business / Shop / Institute Name" type="text" name="business_name" value="<?php if(!empty($reseller->business_name)){echo $reseller->business_name;} ?>" autocomplete="off" style="text-transform: capitalize;" /><span>&nbsp;</span>
						</div>
					</div>
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Password <span id="err_password"></span></label>
						<div class="col-sm-12">
              <input id="password" class="form-control form-height" type="text" name="password"/><span>&nbsp;</span>
						</div>
					</div>
					
					<div class="form-group form-border" style="margin:0;">
						<label class="col-sm-12 field-title control-label">Upload image <span class="error" id="image_err"></span></label>
						<div class="col-sm-12">
							<input type="file" name="profile" id="profile" class="form-control" accept="image/*" onchange="preview_image(event)"><span>&nbsp;</span>
						</div>
						<div class="col-md-3">
                            <div class="form-group">
                                <div id="quots_preview">
                            		<img id="output_image"/>
                                </div>
                            </div>
                        </div>
						<?php if(!empty($reseller->images)){ ?>
                        <div class="col-md-3" style="padding-bottom: 10px;" id="file_table">
                            <div class="form-group">
                                <img src="<?php echo base_url();?>public/uploads/users/img/<?php echo $reseller->images; ?>" height="150px" width="150px">
                                <input name="old_image" value="<?php echo $reseller->images; ?>" type="hidden">
                            </div>
                        </div>
                        <?php } ?>
					</div>
					<input type="hidden" value="<?php echo $reseller->id;?>" name="reseller_id">

					<div class="form-group form-border">
						<div class="col-sm-12">
	             <button type="submit" class="btn btn-default btn-green" onclick="return validation()">Update</button>
						</div>
					</div>
				</form>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url();?>assets/js/custom_js/common.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/custom_js/reseller_setting.js"></script>
<style>
#quots_preview
{
 	text-align:center;
 	margin:0 auto;
 	padding:0px;
}
#output_image
{
 	max-width:200px;
 	max-height: 200px;
}
</style>