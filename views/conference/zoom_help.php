<style>
.pagetitle {
    padding: 15px 0px 0px 0px;
    margin-bottom: 15px;
}
.panel-body.form-body {
    padding: 10px 0px !important;
}
@media (max-width: 991px){
  footer.main {
      padding: 20px 15px 20px 10px !important;
      width: 100%;
      left: 0px;
  }
  .pagetitle {
      padding: 15px 0px 5px 0px;
      margin-bottom: 0px;
  }
  .pagetitle h2 {
      margin: 0px 0px 15px 0px !important;
      font-size: 26px;
  }
  .panel-body.form-body {
      border: 1px solid #ebebeb!important;
      border-radius: 2px!important;
      padding: 25px 15px 40px 15px!important;
      margin: 0px 0px 25px 0px;
  }
  .panel-body.form-body .col-sm-12 {
      padding: 0px !important;
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
.form-body button {
    margin: 20px 0px 0px 0px;
}
</style>
<div id="message"></div>
<div class="main-container">
  <div class="col-sm-12 pagetitle" >
  	<h2><?php echo $heading; ?></h2>
  </div>
  <div class="field_container">
    <div class="row">
    	<div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
    		<div class="panel panel-primary primary-border" data-collapsed="0">
  			<!-- <div class="panel-heading">
  			</div> -->
          <div class="panel-body form-body" style="padding-bottom: 1.5% !important">
  					<div class="form-group form-border row">
  						<label class="col-sm-12 control-label field-title">User Name <span class="error">* </span><span id="err_account" style="color: red"></span></label>
  						<div class="col-sm-12">
                <input id="merchant_id" type="text" class="form-control form-height" placeholder="uername associated with Zoom account" value="<?php echo $merchant_id;?>" />
  						</div>

              <label for="zoom_token" class="col-sm-12 control-label field-title" style="padding-top: 15px;">Zoom JWT Token <span class="error">* </span><span id="err_token" style="color: red"></span></label>
              <div class="col-sm-12">
                <input id="zoom_token" type="text" class="form-control form-height" placeholder="Zoom JWT token" value="<?php echo $zoom_token;?>" />
              </div>
              <div class="col-sm-12">
                <label class="control-label field-title"><input id="chk_zoom" type="checkbox" <?php if($status == 'active'){echo "checked";}?> > Activate </label>
              </div>
  					</div>
            
                <button type="button" id="upd_btn" class="btn"  onclick="return update_settings()">Update Settings
                </button>
  						
  					
          </div>
  		  </div>
  		</div>
      <!-- tutorials for zoom jwt token -->
      <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
       
          <h4>
            if you don't have token ? create one by using following steps
          </h4>
          <br>
          <div class="form-body" style="padding-bottom: 1.5% !important">
            <div class="form-group form-border">
              <ol>
                <li style="padding-left: 10px;"> go to Zoom app marketplace by <a href="https://marketplace.zoom.us/" target="_blank">https://marketplace.zoom.us</a> <br> If you have a zoom account then login with your account details if not then register yourself with zoom and then log in.<br><br></li>
                <li style="padding-left: 10px;"> <b>Register Your App</b><br>
To register your app, click on the Develop option in the dropdown on the top-right corner and select Build App. A page with various app types will be displayed. Select JWT as the app type and click on Create.<br><br></li>
                <li style="padding-left: 10px;"> <b>App Information</b><br>
After creating your app, your first step is to fill out descriptive and contact information. Here you enter a short description along with your company name. This is also where you can change the name you’ve just given to your app. Please note that this unique app name will be visible, even if your app is not submitted publicly.<br>

Next add Developer Contact name and email, which may be used by the Zoom Marketplace Team or your users for any inquiries regarding your app.<br>

On this page you can also include optional links for your users to access your Privacy Policy or Support pages.<br>

This is also a good time to upload an optional App Icon for your app. The icon should be a square image between 160px and 400px width and height in GIF/JPG/JPEG/PNG format, and cannot be more than 1MB in size.<br>
<br>
<img src="https://s3.amazonaws.com/user-content.stoplight.io/19807/1560354974584" width="70%"><br>
</li><br>
<br>
                <li style="padding-left: 10px;"> <b>Generate App Credentials</b><br>
In order to allow your app to integrate, the Zoom platform generates a set of unique credentials used to generate the tokens needed to authorize each request. <br>
<br>
<img src="https://s3.amazonaws.com/user-content.stoplight.io/19807/1560025082715" width="70%"><br>
<br>
Clicking ‘View JWT Token’, you’ll see a unique token generated for you by the Zoom Marketplace containing the <b>API Key</b> and <b>API Secret</b> based on the <b>Expiration Time</b> you select below. This token here is intended for temporary usage in development to test how Zoom APIs will retrieve and send information to your account.<br><br>
</li>
                <li style="padding-left: 10px;"> <b>Copy Token</b><br>You can set <b>user-defined expiration time</b> by selecting <b>other</b> and set the duration in the format shown up there. Once you’ve accessed your API Key and Secret and copied over any needed tokens, click Continue.<br>
                  <br>
                  <img src="https://s3.amazonaws.com/user-content.stoplight.io/19807/1560025161259" width="70%"><br>
<br>
                </li>
                <li style="padding-left: 10px;"> <b>Add App Features</b><br>
<b>Event Subscriptions</b> are <b>OPTIONAL</b> features which allow apps to use Zoom’s webhooks to return information when a certain event or action is triggered. In many cases, Event Subscriptions can replace the need for repeated API calls. For example, you might want to add a feature that sends automated notifications to your app every time a User has activated their account or every time a Recording has started.<br>
To create an Event Subscription, click the toggle on. Click <b>+ Add new event subscription</b>. Choose an optional Subscription Name, and add an <b>Event Notification Endpoint URL</b> for both development and production. These URLs will receive POST requests containing data on the notification for each subscribed event. Note: Event Notification Endpoint URLs must be secured over HTTPS.<br>
<b>Note</b>: Event Subscription names have no effect on the payload of the request.<br>
Add the event types for this Event Subscription and click Save.<br>
To add additional Event Subscriptions, click <b>+ Add new event subscription</b> again. Although you can subscribe to as many events as needed for each event subscription, you can only have a maximum of ten event subscriptions per app.<br>
Event subscriptions can have duplicate Events. For example, one Event Subscription could have Meetings and User Events, and a second Event Subscription can have Meetings and Recordings events.
<br><br>
<img src="https://s3.amazonaws.com/user-content.stoplight.io/19807/1574813088653" width="70%"><br>
<br>
To utilize Event Subscriptions, you will need to provide a Destination URL to receive incoming events from Zoom. This could be a URL like <b>‘https://www.yourcompany.com/user_added’</b>, which we explore in our Webhook guide.<br>
<b>Note</b>: This URL must be secured over HTTPS.<br>
Once you enter your Event types and Destination URL, you must click <b>'Save'</b>. Once you are completed here, click <b>‘Continue’</b>.<br><br>
</li>
                <li style="padding-left: 10px;"><b>Activation</b><br>
Having retrieved your App Credentials and set any Event Subscriptions, your app is all set to make requests to any Zoom APIs. You may want to refer back to any of the above settings to manage your app or if you need to regenerate your API Secrets or tokens.<br>
You also have the option to <b>Deactivate</b> or <b>Reactivate</b> your app. If Deactivated, your app will not be authorized to make requests to Zoom APIs.<br>
<br>
<img src="https://s3.amazonaws.com/user-content.stoplight.io/19807/1560024698195" width="70%">
</li>
<br>
<br>
              </ol>
            </div>
          </div>
        
      </div>
	  </div>
	</div>
</div>
<script type="text/javascript">
function update_settings(){
    var merchant_id = $("#merchant_id").val().trim();
    var zoom_token = $("#zoom_token").val().trim();
    
    if(merchant_id == ''){
        $("#err_account").fadeIn().html(" Please enter Zoom username");
        setTimeout(function(){$("#err_account").html("");},2000);
        $("#merchant_id").focus();
        return false;
    }
    if(zoom_token == ''){
        $("#err_token").fadeIn().html(" Please enter JWT app token");
        setTimeout(function(){$("#err_token").html("");},2000);
        $("#zoom_token").focus();
        return false;
    }
    var chk_zoom = document.getElementById("chk_zoom").checked;
    if(chk_zoom == true){
        chk_zoom = 1;
    }else{
        chk_zoom = 0;
    }
    $('#upd_btn').html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Please wait');
    $.ajax({
        type: 'post',
        cache: false,
        url:"update-settings/",
        data:{ merchant_id : merchant_id, zoom_token : zoom_token, chk_zoom : chk_zoom },
        success: function(response){
            $('#upd_btn').html('Update Settings');
            if(response == 'inactive'){
               var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-exclamation-triangle" aria-hidden="true"></strong> Zoom Deactivated. </div>';
            }else{
             var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Zoom Activated. </div>';
            }
              var msg = $(document).find('#message');

            msg.html(str).show().fadeIn().delay(3000).fadeOut();

        }
    });
}
</script>