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
#message {
    position: fixed; 
    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}
</style>
<span id="message"></span>
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
				<!-- <form method="post" action="<?php echo $action_url;?>" enctype="multipart/form-data" id="info_form"> -->
					<div class="form-group form-border">
						<label for="first Name" class="col-sm-12 control-label field-title">User Name <span class="error">* </span><span id="err_userid" class="error"></span></label>
						<div class="col-sm-6">
              <select id="user_id" class="form-control form-height" onchange="return get_userdetails(this.value)">
                <option value="">Select user</option>
                <?php foreach ($users as $key){ ?>
                <option value="<?php echo $key->id;?>"><?php echo ucwords($key->first_name." ".$key->last_name); ?></option>
                <?php } ?>
              </select>
						</div>
            <div class="col-sm-6">
              <input class="form-control form-height" placeholder="Search users by keywords" type="text" id="search_user" oninput="return get_users(this.value)">
            </div>
					</div>
	        <div class="form-group form-border">
						<label for="Email" class="col-sm-12 field-title control-label">Email</label>
						<div class="col-sm-12">
              <input class="form-control form-height" placeholder="Enter email id" type="text" id="email" disabled="">
						</div>
					</div>
					<div class="form-group form-border">
						<label class="col-sm-12 field-title control-label">Contact No.</label>
						<div class="col-sm-12">
              <input id="mobile" class="form-control form-height" placeholder="Enter Contact No." type="text" disabled="">
						</div>
					</div>
          <div class="form-group form-border">
            <label for="Last Name" class="col-sm-12 field-title control-label">Course Name <span class="error">* </span><span id="err_courseid" class="error"></span></label>
            <div class="col-sm-6">
              <select id="course_id" class="form-control form-height">
                <option value="">Select Course</option>
                <?php foreach ($programs as $key1){ ?>
                <option value="<?php echo $key1->id;?>"><?php echo ucwords($key1->name). " - (".number_format($key1->fixedrate,2).")"; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-6">
              <input class="form-control form-height" placeholder="Search Programs by keywords" type="text" id="search_programs" oninput="return get_programs(this.value)">
            </div>
          </div>
          <div class="form-group form-border" style="padding-top:2.5%!important">
						<div class="col-sm-3 col-md-3">
              <button type="submit" id="btncheck" class="btn btn-success btn-lg" style="width: 75% !important;" onclick="return validation()"> Create
              </button>
              <button id="please_wait" class="btn btn-success btn-md" style="display: none;font-size:16px !important;margin-bottom:0px !important">
                <img src="<?php echo base_url('public/images/loader_white.gif');?>" style="margin-right:3px" height="28px"> Please Wait</button>
						</div>
					</div>
				<!-- </form> -->
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
<script type="text/javascript" src="<?= base_url();?>assets/js/custom_js/common.js"></script>
<script type="text/javascript">
  function get_users(val){
    $.ajax({
        type : "POST",
        cache : false,
        url : "<?php echo base_url();?>salesTeam/filter_users",
        data : {searchtext : val},
        success : function(response){
          $("#user_id").html(response);
        }
    });
  }
  function get_programs(val){
    $.ajax({
        type : "POST",
        cache : false,
        url : "<?php echo base_url();?>salesTeam/filter_programs",
        data : {searchtext : val},
        success : function(response){
          $("#course_id").html(response);
        }
    });
  }

  function get_userdetails(id){
    $.ajax({
        type : "POST",
        cache : false,
        url : "<?php echo base_url();?>salesTeam/get_userdetails",
        data : {id : id},
        success : function(response){
          var obj = $.parseJSON(response);
          $("#email").val(obj.email);
          $("#mobile").val(obj.mobile);
        }
    });
  }

  function validation()
  {
    var user_id = $("#user_id").val().trim();
    var course_id = $("#course_id").val().trim();
    
    if(user_id == ''){
      $("#err_userid").html("Please select User").fadeIn();
      setTimeout(function(){$("#err_userid").html('').fadeOut();$("#user_id").css("borderColor","#00A654");},3000);
      $("#user_id").focus().css("border-color","red");
      return false;
    }
    if(course_id == ''){
      $("#err_courseid").html("Please select Course").fadeIn();
      setTimeout(function(){$("#err_courseid").html('').fadeOut();$("#course_id").css("borderColor","#00A654");},3000);
      $("#course_id").focus().css("border-color","red");
      return false;
    }
    $("#btncheck").css('display',"none");
    $("#please_wait").css('display',"block");
    $.ajax({
        type : "post",
        cache: false,
        url : "<?php echo base_url();?>salesTeam/order_action",
        data : {user_id : user_id, course_id : course_id},
        success : function(response){
          $("#btncheck").css('display',"block");
          $("#please_wait").css('display',"none");
          
          if(response == '1'){
            $("#message").html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-check" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Course Assigned.</span></div>').fadeIn();
            setTimeout(function(){
              $("#message").html('').fadeOut();
              window.location.replace("<?php echo base_url();?>SalesTeam/orders/");
            },2000);
          }else if (response == '0'){
            $("#message").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-warning" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Course already purchased by User.</span></div>').fadeIn();
            setTimeout(function(){
              $("#message").html('').fadeOut();
            },3000);
            $("#course_id").focus().css("border-color","red");
          }
        }
    });
  }
</script>