<style type="text/css">  
  .reg_div, .login_div{
    padding: 35px;
    text-align: center;
  }
  .reg_div{
    /*border-left: 1px #ccc solid;*/
    margin-bottom: 15px;
  }
  .reg_div input, .login_div input{
    border: 1px solid #ccc;
    font-size: 16px;
    padding: 10px 15px;
    height: 45px;
    background: transparent;
    width: 90%;
    margin: 10px;
  }
  .reg_div button:hover, .login_div button:hover{
    background: #fff !important;
    border: 1px solid #ff6452;
    color: #ff6452;
  }
  .reg_div button, .login_div button{
      font-size: 16px;
      font-weight: 600;
      width: 90%;
      background: #ff6452;
      text-transform: inherit;
      border: 1px solid #ff6452;
      margin: 10px 15px;
      height: 45px;
      color: #fff;
      border-radius: 5px;
  }
  .main_div{
    padding: 25px 0 25px 0;
    text-align: center;
  }
  @media (max-width: 767px){
    .login_div{
      display: none;
    }
    .reg_div input, .login_div input,.reg_div button, .login_div button{
      width: 100%;
      margin: 10px 0;
    }
  }
  @media (min-width: 768px){
    .bottom_panel_login, .bottom_panel_register{
      display: block;
    }
  }
</style>
<div class="col-sm-6 col-xs-12 col-md-6 col-sm-offset-3 col-md-offset-3 main_div">
  <!-- <div class="col-sm-6 col-xs-12 col-md-6 login_div">
    <h2>Login</h2><hr>
    <input id="login_mobile" placeholder="Mobile No." type="text" maxlength="10" value="" autocomplete="off" onkeypress="only_number(event)">
    <span id="err_mo_login">
    </span>
    <input id="login_password" placeholder="Password" type="text" maxlength="256" value="" autocomplete="off">
    <span id="err_log_pass">
    </span>
    <button type="button" id="btn_login" onclick="return check_login()">Login</button>
  </div> -->


  <div class="col-sm-12 col-xs-12 col-md-12 reg_div">
    <!-- registration div -->
    <h2>Register</h2><hr>
    <input id="new_full_name" placeholder="Full name" type="text" maxlength="256" value="" autocomplete="off">
    <span id="err_reg_name"></span>
    <input id="new_reg_mobile" placeholder="Mobile No." type="text" maxlength="10" value="" autocomplete="off" onkeypress="only_number(event)">
    <span id="err_reg_mo"></span>
    <input id="new_reg_password" placeholder="Password" type="text" maxlength="256" value="" autocomplete="off">
    <span id="err_reg_pass"></span>
    
    <button type="button" id="register_btn" onclick="return check_register();">Join</button>
     
    <div class="bottom_panel bottom_panel_register">
      <span class="login_footer">Have an account?  <!-- <a href="#" onclick="show_divs('login_div','reg_div')">Login </a> -->
        
        <a onclick="closeRegi();" id="go" class="sign_up_text" rel="leanModal" name="signup" href="#signup">Login </a>
      </span>
      <!-- <a onclick="closeRegi();" id="go" class="sign_up_text" rel="leanModal" name="signup" href="#signup">Login </a> -->
    </div>
  </div>
  <a href="https://play.google.com/store/apps/details?id=com.academy.myonlineshiksha">
    <img src="<?php echo base_url();?>public/images/google-btn.png" alt="MyOnlineShiksha" style="width: 175px;">
  </a>
  <p class="agree_text">By signing up, you agree to our <a href="<?php echo base_url();?>terms-of-use">Terms of Use</a> and <a href="<?php echo base_url();?>privacy-policy">Privacy Policy</a>.</p>
</div>
<?php $this->load->view('new_template_design/footer'); ?>
<script type="text/javascript">
  function check_register(){
    var full_name = $("#new_full_name").val().trim();
    var reg_mobile = $("#new_reg_mobile").val().trim();
    var reg_password = $("#new_reg_password").val().trim();
    if (full_name == "")
    {
      $("#err_reg_name").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter Full Name").css('color','red');
      setTimeout(function(){$("#err_reg_name").html("");},2000);
      $("#new_full_name").focus();
      return false;
    }
    if (reg_mobile == "")
    {
      $("#err_reg_mo").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter Mobile No.").css('color','red');
      setTimeout(function(){$("#err_reg_mo").html("");},2000);
      $("#new_reg_mobile").focus();
      return false;
    }else if (reg_mobile.length != 10)
    {
      $("#err_reg_mo").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Invalid Mobile No.").css('color','red');
      setTimeout(function(){$("#err_reg_mo").html("");},2000);
      $("#new_reg_mobile").focus();
      return false;
    }
    if (reg_password == "")
    {
      $("#err_reg_pass").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Please enter Password").css('color','red');
      setTimeout(function(){$("#err_reg_pass").html("");},2000);
      $("#new_reg_password").focus();
      return false;
    }
    $("#register_btn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Please wait...').removeAttr('onclick');
    $.ajax({
        type : 'post',
        cache : false,
        url : "<?php echo base_url();?>welcome/register/",
        data : {full_name : full_name, reg_mobile : reg_mobile, reg_password : reg_password },
        success : function(data){
            if(data == 'failed'){
                $("#err_reg_mo").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Mobile No. already exists.").css('color','red');
                setTimeout(function(){$("#err_reg_mo").html("");},3000);
                $("#new_reg_mobile").focus();
                $("#register_btn").html('Join').attr('onclick',"return check_register();");
            }else{
                window.location.href = "<?php echo base_url();?>success/";
            }
        }
    });
  }

</script>