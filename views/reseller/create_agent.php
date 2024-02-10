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
	<h2><?php echo $heading; ?></h2>
</div>
<div class="field_container">
<div class="row">
	<div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-primary primary-border" data-collapsed="0">
			<div class="panel-heading">
			</div>
			<div class="panel-body form-body">
				<form method="post" action="<?php echo $action_url;?>" enctype="multipart/form-data" id="info_form">
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 control-label field-title">First Name<?php if($button=="Create"){ ?><span class="error">* </span><span id="err_fname"></span><?php } ?></label>
						<div class="col-sm-12">
              <input id="first_name" type="text" name="first_name" class="form-control form-height" placeholder="Enter first name" value="<?php echo $first_name; ?>" <?php if($button=='Update'){echo 'readonly';}?> />
						</div>
					</div>
	                <div class="form-group form-border">
						<label for="Last Name" class="col-sm-12 field-title control-label">Last Name<?php if($button=="Create"){ ?><span class="error">* </span><span id="err_lname"></span><?php } ?></label>
						<div class="col-sm-12">
              <input id="last_name" class="form-control form-height" placeholder="Enter last name" type="text" name="last_name" maxlength="256" value="<?php echo $last_name; ?>" <?php if($button=='Update'){echo 'readonly';}?> />
						</div>
					</div>
	       <div class="form-group form-border">
						<label for="Email" class="col-sm-12 field-title control-label">Email <?php if($button=="Create"){ ?><span id="err_email"></span><?php } ?></label>
						<div class="col-sm-12">
              <input class="form-control form-height" placeholder="Enter email id" type="text" value="<?php echo $email; ?>" id="email" name="email" <?php if($button=='Update'){echo 'readonly';}?> />
						</div>
					</div>
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Contact No.<?php if($button=="Create"){ ?><span class="error">* </span><span id="err_contactno"></span><?php } ?></label>
						<div class="col-sm-12">
              <input id="mobile" class="form-control form-height" placeholder="Enter Contact No." type="text" name="mobile" maxlength="12" value="<?php echo $mobile; ?>" autocomplete="off" onkeypress="return only_number(event)" <?php if($button=='Update'){echo 'readonly';}?> />
						</div>
					</div>
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Commission <span class="error">* </span><span id="err_comm"></span></label>
						<div class="col-sm-12">
              <input id="commission" class="form-control form-height" placeholder="Enter Commission" type="text" name="commission" value="<?php echo $commission; ?>" onkeypress="return only_number(event)" maxlength="2" onkeyup="check_max(this.value)" />
						</div>
					</div>
					<input type="hidden" value="<?php echo $id;?>" name="agent_id" id="agent_id">
          <input type="hidden" value="<?php echo $maxcomm;?>" name="maxcomm" id="maxcomm">
					<div class="form-group form-border" style="padding-top:2.5%!important">
						<div class="col-sm-3 col-md-3">
              <button type="button" id="btncheck" class="btn btn-success btn-lg" style="width: 75% !important;" <?php if($button=="Create"){ echo 'onclick="return validation()"';}else{ ?>onclick="return update_check();" <?php } ?>>
               <span id="btn_span"><?= $button;?></span>
              <div id="please_wait" style="display: none;font-size:16px !important;margin-bottom:0px !important">
                <img src="<?php echo base_url('public/images/loader_white.gif');?>" style="margin-right:3px" height="28px"> Please Wait</div>
              </button>
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
<script type="text/javascript" src="<?= base_url();?>public/js/custom_js/agent.js"></script>