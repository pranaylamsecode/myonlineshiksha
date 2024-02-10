<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/pieprogress/dist/css/asPieProgress.css">
<script src="<?php echo base_url(); ?>public/js/pieprogress/dist/jquery-asPieProgress.js"></script>

<!--start progress bar css asPieProgress.css  -->
<style type="text/css">

.progressDivWelcome {
  width: 100%;
  max-width: 50%;
  margin: 0px auto;
  padding-top: 5%;
}
.progressDivLi {
  width: 100%;
  max-width: 50%;
  margin: 0px auto;
  font-size: 9px;
  padding-bottom: 4%;
}
.progress {
    width: 200px;
    height: 18px;
    background-color: orange;
    display: none;
}

.progress #bar{
     height: 100%;
    color: #fff;
    width: 0;
    text-align: right;
    line-height: 22px;
    border-radius: 19px;
    background-color: orange;
    background: url('http://www.cssdeck.com/uploads/media/items/7/7uo1osj.gif') repeat-x;
    opacity: 0.7;
}
.pie_progress__number {
  font-size: 24px;
}

#progress {     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 0px;
}

#percent { 
  position: relative;
    display: inline-block;
    top: -14px;
    left: 50%;
    color: black;
    line-height: 1.2;
 }
.lectureContent{
  display: none;
}
.modal-header {
  display: -webkit-box;
  padding: 15px 15px 0px;
}
.panel-primary {
  margin: 45px 0 -25px 0;
}
.redactor-editor {
  min-width:308px;
}
.prgb-container {
  width: 100%;
  margin: 0 auto;
  padding: 0px 5px; 
}
.progressbar {
  margin: 0;
  padding: 0;
  counter-reset: step;
}
.progressbar li {
  list-style-type: none;
  width: 14%;
  float: left;
  font-size: 10px;
  position: relative;
  text-align: center;
  text-transform: uppercase;
  color: #7d7d7d;
  margin: 0 0 15px 0;
}
/*.progressbar li:before {
  width: 30px;
  height: 30px;
  content: counter(step);
  counter-increment: step;
  line-height: 30px;
  border: 2px solid #7d7d7d;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  background-color: white;
}*/
.redactor-editor{
  height:160px!important;
}
.progressbar li:after {
  width: 50px;
  height: 2px;
  content: '';
  position: absolute;
  background-color: #7d7d7d;
  top: 23px;
  left: -27%;
}
.progressbar li:first-child:after {
  content: none;
}
.progressbar li.active {
  color: green;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.05em;
  text-align:center;
}
.progressbar li.active:before {
  border-color: #55b776;
}
.progressbar li.active + li:after {
  background-color: #55b776;
  z-index: 9;
  width: 49px;
  left: -24px;
}
.modal-body {
  position: relative;
  padding: 20px 20px 30px;
}
.modal-content {
  border-radius: 10px!important;
}
@media(max-width:767px){
.progressbar li.active + li:after {
  background-color: #55b776;
  z-index: 9;
  width: 111px;
  left: -56px;
  }
}
</style>
<!--end progress bar css-->
<?php
  $CI =& get_instance();
  $CI->load->model('admin/settings_model'); 
  $getTheme = $CI->settings_model->getItems();
  $getsocialstatus = $CI->settings_model->getSocialStatus(1,"mlms_socialstatus");
  $totalprogress1 = $getsocialstatus->home_status + $getsocialstatus->payment_status + $getsocialstatus->course_status + $getsocialstatus->lecture_status + $getsocialstatus->social_status;
  $totalprogress = $totalprogress1 * 20;

  $home_status = $getsocialstatus->home_status == 1 ? 100 :0;
  $payment_status = $getsocialstatus->payment_status  == 1 ? 100 :0;
  $course_status = $getsocialstatus->course_status  == 1 ? 100:0;
  $lecture_status = $getsocialstatus->lecture_status  == 1 ? 100:0;
  $social_status = $getsocialstatus->social_status == 1 ? 100 :0;
?>
<!-- ---------------------------------------------Paragraph-POP-UP-Start----------------------------------------------- -->
<script src="<?php echo base_url(); ?>/public/js/form-master/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/progressbar/progressbar.js"></script>
<div class="">

<!-- ======================================================================== -->
    <div class="modal" id="welcome" role="dialog" style="display:none">
    <div class="modal-dialog welcome-modal-box">
      <span id="close-upload" class="closeUploadProfile close" data-dismiss="modal">
        <img src="http://create-online-academy.com/public/uploads/settings/img/cancel-icon.png" width="30px">
      </span>
      <!-- Modal content-->
      <div class="modal-content">       
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <!--<h4 class="modal-title">Create Lecture</h4>-->
        <div class="prgb-container">
            <ul class="welcome-progressbar progressbar">
                <li class="active">
                  <div class="progressDiv progressDivLi" >
                    <div class="Welcome_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <div class="pie_progress__label">Welcome</div> 
                    </div>
                  </div>
                </li>
                <li><div class="progressDiv progressDivLi">
                    <div class="HomePage_progress" role="progressbar" data-goal="<?php echo $home_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $home_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Home Page Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="payment_progress" role="progressbar" data-goal="<?php echo $payment_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $payment_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Payment Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="course_progress" role="progressbar" data-goal="<?php echo $course_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $course_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Course
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="lecture_progress" role="progressbar" data-goal="<?php echo $lecture_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $lecture_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Lecture
                </li>
                <li>
                <div class="progressDiv progressDivLi">
                    <div class="social_progress" role="progressbar" data-goal="<?php echo $social_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $social_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Social Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="endofpopup_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div> End Of Popup
                </li>
            </ul>
        </div>
        </div>
          
        <div class="modal-body welcome-content scrollbar" id="style-1">
        <div class="row">
        <div class="col-sm-6 clear border-right"> 
            <h3 class="progress-head welcome-head" style="text-align:center">Welcome</h3>
            <span class="welcome-border-btm"></span>
            <p class="progress-txt" style="text-align:center">Write the goals and ambitions of your online academy and introduce yourself and your team in this page. Let everyone, who visits your online academy, fall in love with your academy.</p>
            
            <div class="progressDiv progressDivWelcome">
            
                <div class="pie_progress" role="progressbar" data-goal="<?php echo $totalprogress; ?>">

                <div class="pie_progress__number" style="20%"><?php echo $totalprogress; ?>%</div>

                <div class="pie-progress-txt pie_progress__label">Completed</div>

                </div>



            </div>

            </div>
             <div class="col-sm-6 img-section"> 
                <div class="form-group form-border" style="margin: 0 0 60px 0;">
                  <label for="field-12" class="col-sm-12 no-padding control-label field-title" style="padding-bottom:2%;">Profile Photo</label>
                  <!-- <img src="http://create-online-academy.com/public/uploads/settings/img/profile-img.jpg" style="cursor: pointer;width: 100%;height: auto;margin-bottom:4%;" height="250px" width="250px"> -->
                  
                  <img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $getTheme[0]['logoimage'];?>" alt="">
                </div>
            </div>
            </div>
          </div>
        
        
        
        </div>
        <div class="modal-footer footer-sect">
       <a class="skip_button skip_button-2" onclick="openProgressbarpop('#homeLogoImage')">Skip</a>
        
         <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="openProgressbarpop('#homeLogoImage')">Next</button>
        </div>
      </div>
      
    </div>
    

<!-- ======================================================================== -->
<div class="modal" id="homeLogoImage" role="dialog" style="display:none">
    <div class="modal-dialog modal-box">
      <span id="close-upload" class="closeUploadProfile close" data-dismiss="modal">
        <img src="http://create-online-academy.com/public/uploads/settings/img/cancel-icon.png" width="30px">
      </span>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <!--<h4 class="modal-title">Home Page Setting</h4>-->           
          <div class="prgb-container">
            <ul class="progressbar">
                 <li class="active">
                  <div class="progressDiv progressDivLi" >
                    <div class="Welcome_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <div class="pie_progress__label">Welcome</div> 
                    </div>
                  </div>
                </li>
                <li><div class="progressDiv progressDivLi">
                    <div class="HomePage_progress" role="progressbar" data-goal="<?php echo $home_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $home_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Home Page Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="payment_progress" role="progressbar" data-goal="<?php echo $payment_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $payment_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Payment Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="course_progress" role="progressbar" data-goal="<?php echo $course_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $course_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Course
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="lecture_progress" role="progressbar" data-goal="<?php echo $lecture_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $lecture_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Lecture
                </li>
                <li>
                <div class="progressDiv progressDivLi">
                    <div class="social_progress" role="progressbar" data-goal="<?php echo $social_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $social_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Social Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="endofpopup_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div> End Of Popup
                </li>
            </ul>
        </div>
        </div>
          
        <!-- <div class="modal-body scrollbar" id="prograss_content style-1"> -->
        <div class="modal-body scrollbar" id="style-1">
              <?php
               $CI = & get_instance();
               $CI->load->model('settings_model');
               $data = $this->settings_model->getItems(); 
              ?>

              <div class="row">
              <div class="col-sm-4 clear border-right"> 
                <h3 class="progress-head">Home page setting</h3>
                <span class="srt-border-btm"></span>
                <p class="progress-txt">Write the goals and ambitions of your online academy and introduce yourself and your team in this page. Let everyone, who visits your online academy, fall in love with your academy. Remember this page creates the ultimate impression to the visitors and the things you write here can change a casual surfer to a potential client. Go to the administrative end of your webpage and edit the content of this page.</p>
                 
                 <div class="progressDiv progressDivWelcome">
                      <div class="pie_progress" role="progressbar" data-goal="<?php echo $totalprogress; ?>">

                    <div class="pie_progress__number" style="20%"><?php echo $totalprogress; ?>%</div>

                    <div class="pie-progress-txt pie_progress__label">Completed</div>

                    </div>
                  </div>

            </div>

          <div class="col-sm-8 no-padding"> 
              <div class="form-group form-border">
               
                  <label class='col-sm-12 control-label field-title' for="Paragraph" id="label">Academy Name :</label>
                <div class="col-sm-12">  
                  <input type="text" class="form-control form-height" name="academy_name" id="academy_name" value="<?php echo $data[0]['institute_name']; ?>">
              </div>
             </div>
              <div class="form-group form-border" style="margin: 0 0 60px 0;">
                <label for="field-12" class="col-sm-12 control-label field-title">Logo :
                <p>(Please make sure that the name of the file for the logo does not contain any spaces or special characters.)</p>
                </label>            
                <div class="col-sm-12">
                    <input type="hidden" class="form-control" value="1916_12-19-2015.png" name="imagename" id="imagename">

                    <div class="col-sm-6 col-xs-12 img-grey-border" id="localimage_i">
                      <img src="<?php echo base_url(); ?>public/uploads/settings/img/logo/<?php echo $data[0]['logoimage']; ?>" width="150" id="imgnamelogo">
                      
                    </div>
                    <div class="col-sm-6 col-xs-12">
                    <a href="<?php echo base_url(); ?>admin/templates/croplogo/logo" class="btn-border-blue addlogo_pop btn btn-success cboxElement">Add Logo</a><br>
                    
                    </div>
                    <span class="error"></span>
                    <p class="col-sm-6 col-xs-12 help-inline">Logo (164px X 44px)</p>
                 </div>
                
              </div>
              <div class="form-group form-border">
                <label for="field-1" class="col-sm-12 control-label field-title">Favicon :
                <p><a href="https://en.wikipedia.org/wiki/Favicon" target="_blank">(What is Favicon?)</a></p>
                </label>                
                <div class="col-sm-12">
                  <input type="hidden" class="form-control" value="2623_09-14-2015.png" name="favname" id="favname">

                  <div class="col-sm-6 col-xs-12 light-grey-bg-border" id="localimage_i">
                     <img src="<?php echo base_url(); ?>public/uploads/settings/img/logo/<?php echo $data[0]['favicon']; ?>" width="25" id="imgnameficon">
                      
                  </div>
                  <div class="col-sm-6 col-xs-12">
                    <a href="<?php echo base_url(); ?>admin/templates/croplogo/icon" class="btn-border-blue addfev_pop btn btn-success cboxElement">Add Favicon</a>
                  </div>
                  <span class="error"></span><span class="help-inline"></span>
               </div>
                
            </div>
          </div>
          </div>
          </div>
        </div>
    <div class="modal-footer footer-sect" style="margin-top:0;">
    <button type="button" class="btn btn-success btn-green" id="applyChanges" onclick="openProgressbarpop('#welcome')" style="float:left;">Previous</button>
         <a class="skip_button skip_button-2" onclick="openProgressbarpop('#paymentsetting')">Skip</a>
         <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="saveHome('#paymentsetting')">Next</button>
    </div>
      </div>
  </div>

<!-- ---------------------------------------------Paragraph-POP-UP-End----------------------------------------------- -->
<!-- ---------------------------------------------payment setting-POP-UP-Start----------------------------------------------- -->
<?php
    $currency = NULL;    
    $currencies = $this->settings_model->getCurrencies();
    $pay_setting = $this->settings_model->getAccountMode();
?>
<div class="modal" id="paymentsetting" role="dialog" style="display:none">
    <div class="modal-dialog modal-box">
    <span id="close-upload" class="closeUploadProfile close" data-dismiss="modal">
        <img src="http://create-online-academy.com/public/uploads/settings/img/cancel-icon.png" width="30px">
      </span>
      <div class="modal-content">
        <div class="modal-header">
          <div class="prgb-container">
            <ul class="progressbar">
                 <li class="active">
                  <div class="progressDiv progressDivLi" >
                    <div class="Welcome_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <div class="pie_progress__label">Welcome</div> 
                    </div>
                  </div>
                </li>
                <li><div class="progressDiv progressDivLi">
                    <div class="HomePage_progress" role="progressbar" data-goal="<?php echo $home_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $home_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Home Page Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="payment_progress" role="progressbar" data-goal="<?php echo $payment_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $payment_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Payment Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="course_progress" role="progressbar" data-goal="<?php echo $course_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $course_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Course
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="lecture_progress" role="progressbar" data-goal="<?php echo $lecture_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $lecture_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Lecture
                </li>
                <li>
                <div class="progressDiv progressDivLi">
                    <div class="social_progress" role="progressbar" data-goal="<?php echo $social_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $social_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Social Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="endofpopup_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div> End Of Popup
                </li>
            </ul>
        </div>  
        </div>
                    
        <div class="modal-body scrollbar" id="style-1"> 
        <form method="post" accept-charset="utf-8" class="tform" id="paymentsettingForm" enctype="multipart/form-data">                 
          
          <div class="row">
          <div class="col-sm-4 clear"> 
                <h3 class="progress-head">Payment setting</h3>
                <span class="srt-border-btm"></span>
                <p class="progress-txt">Write the goals and ambitions of your online academy and introduce yourself and your team in this page. Let everyone, who visits your online academy, fall in love with your academy. Remember this page creates the ultimate impression to the visitors and the things you write here can change a casual surfer to a potential client. Go to the administrative end of your webpage and edit the content of this page.</p>
                
                 <div class="progressDiv progressDivWelcome">
                 <div class="pie_progress" role="progressbar" data-goal="<?php echo $totalprogress; ?>">

                    <div class="pie_progress__number" style="20%"><?php echo $totalprogress; ?>%</div>

                    <div class="pie-progress-txt pie_progress__label">Completed</div>

                    </div>
                  </div>
            </div>
            <div class="col-sm-8 border-left">      
              <div class="panel no-margin panel-primary" data-collapsed="0">      
                <div class="panel-heading" style="border-bottom:none;">
                  <div class="panel-title tile_fld field-title" style="margin-top: 10px;margin-left: 15px;">
                    Payment&nbsp;Setting
                  </div>
                </div>
                <div class="panel-body">
                    <fieldset role="form" class="adminform form-horizontal form-groups-bordered">         
                      <div class="col-sm-12 form-border form-group" style="padding:0;margin:0;">
                        <div class="grey-background" style="display: -webkit-box;">  
                          <input class="dark_label" id="paypalckb" type="checkbox" <?php if($pay_setting['0']['paypal_status'] == 1) echo 'checked' ?> name="paypalckb" value="1" onclick="showhidePaypal();"> &nbsp; Paypal <br>

                          <input class="dark_label" id="otherckb" type="checkbox" <?php if($pay_setting['0']['directpay_status'] == 1) echo 'checked' ?> name="otherckb" value="1" onclick="showhideOther();"> &nbsp; Other Payment Information
                        </div>
                      </div>
                    </fieldset>
                </div>

              </div>

               <div class="panel no-margin panel-primary" id="paypalpanal" data-collapsed="0">                    
                      <div class="panel-heading" style="border-bottom:none;">
                      <div class="col-sm-12">
                        <p style="text-align:left;padding-top: 2%"> Don't have a PayPal Account? Click on the link and create one now !<a href="https://www.paypal.com" target="_blank"> click here </a></p>
                      </div>
                        <div class="panel-title tile_fld field-title" style="margin-left: 15px;margin-bottom: 2%;">
                          Paypal&nbsp;Setting                          
                        </div>
                        
                        <!-- <div class="panel-options">
                          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                        </div> -->
                      </div>
                            <div class="panel-body form-body main-table" style="margin:3%;">
                        
                        <fieldset role="form" class="adminform form-horizontal form-groups-bordered">
                  
                          <div class="form-group form-border">
                            <label for="first Name" class="col-sm-12 field-title control-label">PayPal Business Email<span style="color:#FF0000;" class="error">*</span></label>
                            
                            <div class="col-sm-12">                                            
                                <input id="paypal_bsns_email" type="text" name="paypal_bsns_email" class="form-control form-height" placeholder="Enter API Username" maxlength="256" value="<?php echo $pay_setting[0]['paypal_bsns_email']; ?>">                              
                            </div>
                          </div>
                          
                          <!-- <div class="form-group form-border">
                            <label for="first Name" class="col-sm-12 field-title control-label">PayPal Username<span style="color:#FF0000;" class="error">*</span></label>
                            
                            <div class="col-sm-12">                                            
                                <input id="api_username" type="text" name="api_username" class="form-control form-height" placeholder="Enter API Username" maxlength="256" value="<?php echo $pay_setting[0]['api_username']; ?>">                              
                            </div>
                          </div>
                          
                          <div class="form-group form-border">
                            <label for="first Name" class="col-sm-12 field-title control-label">PayPal Password<span style="color:#FF0000;" class="error">*</span>
                                <p>Enter API Password</p>
                            </label>
                            
                            <div class="col-sm-12">                                            
                              <input id="api_password" type="password" name="api_password" class="form-control form-height" placeholder="Enter API password" maxlength="256" value="<?php echo $pay_setting[0]['api_password'];  ?>">                             
                            </div>
                          </div>
                          
                          <div class="form-group form-border">
                            <label for="first Name" class="col-sm-12 field-title control-label">PayPal Signature<span style="color:#FF0000;" class="error">*</span></label>
                            
                            <div class="col-sm-12">                                            
                              <input id="api_signature" type="text" name="api_signature" class="form-control form-height" placeholder="Enter API Signature" maxlength="256" value="<?php echo $pay_setting[0]['api_signature'];  ?>">                                            
                            </div>
                          </div>  -->         
                          
                          
                          <!-- <div class="form-group form-border">
                            <label for="first Name" class="col-sm-12 field-title control-label">Name<span style="color:#FF0000;" class="error">*</span>
                            <p>Has to be the same as in your Paypal Account</p>
                            </label>
                            
                            <div class="col-sm-12">                                            
                                <input id="name" type="text" name="name" class="form-height form-control" placeholder="Enter Name" maxlength="256" value="<?php echo $pay_setting[0]['name']; ?>">                              
                            </div>
                            
                          </div> -->
                          
                          
                          <div class="form-group form-border">
                                    
                            <div class="col-sm-12">
                             <div class="grey-background" style="display: -webkit-box;">           
                              <div class="checkbox">
                                <label>
                                  
                                                    
                                    <input id="isLive" type="checkbox" <?php if($pay_setting[0]['status'] == 1) echo 'checked'; ?> name="isLive" value="1">Activate the PayPal Gateway
                                   
                                      <p>(You won't be receiving any payment through PayPal till you activate.)</p>


                
                                </label>
                              </div>
                              
                              </div>
                            </div>
                          </div>
                                    

                          
                        </fieldset>
                        
                      </div>
                          </div>
                  
                 

           <!-- @@@@@@@@@@@@@@ -->

           <div class="panel no-margin panel-primary" id="otherpanal" data-collapsed="0">
    
              <div class="panel-heading" style="border-bottom:none;">
                <div class="col-sm-12">
                  <p style="text-align:left;padding-top: 2%">Here you can put the alternative options of receiving payment from the Academy Users</p>
                </div>
                <div class="panel-title tile_fld field-title" style="margin-left: 15px;margin-bottom: 2%;">               
                  Other Payment Information
                  
                </div>

                <!-- <div class="panel-options">
                  <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                  <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                  <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                  <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div> -->
              </div>
              <div class="panel-body form-body main-table" style="margin:3%;">
        
                  <fieldset role="form" class="adminform form-horizontal form-groups-bordered">         
                    <div class="form-group form-border">
                    <!-- <textarea></textarea> -->
                      <label for="first Name" class="col-sm-12 field-title control-label">Other Payment Information<!-- <span style="color:#FF0000;" class="error">*</span> --></label>
                    <div class="col-sm-12">
                    
                                      <textarea id="othertxt" name="othertxt" class="form-control select-box-border"><?php echo $pay_setting[0]['directinfo']; ?></textarea>
                                        </div>
                    </div>
                  </fieldset>
              </div>

            </div>

            </div>
        </div>  

           <!-- @@@@@@@@@@@@@@@@@@@@@  -->

                               
                   

           
    
            
         
          </form>
          <!-- @@@@@@@@@@@@@@@@@@@@ -->
        </div>
        
      </div>
      <div class="modal-footer footer-sect">
      <a class="skip_button skip_button-2" onclick="openProgressbarpop('#createCourse')">Skip</a>
        <button type="button" class="btn btn-success btn-green" id="applyChanges" onclick="openProgressbarpop('#homeLogoImage')" style="float:left;">Previous</button>
         <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="savePaymentSetting('#createCourse')">Next</button>
        </div> 
    </div>
    
  </div>


  <!-- ============================================================================== -->


  <div class="modal" id="createCourse" role="dialog" style="display:none">
    <div class="modal-dialog modal-box">
    <span id="close-upload" class="closeUploadProfile close" data-dismiss="modal">
        <img src="http://create-online-academy.com/public/uploads/settings/img/cancel-icon.png" width="30px">
      </span>
    
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <!--<h4 class="modal-title">Create Course</h4>-->
          <div class="prgb-container">
            <ul class="progressbar">
                 <li class="active">
                  <div class="progressDiv progressDivLi" >
                    <div class="Welcome_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <div class="pie_progress__label">Welcome</div> 
                    </div>
                  </div>
                </li>
                <li><div class="progressDiv progressDivLi">
                    <div class="HomePage_progress" role="progressbar" data-goal="<?php echo $home_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $home_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Home Page Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="payment_progress" role="progressbar" data-goal="<?php echo $payment_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $payment_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Payment Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="course_progress" role="progressbar" data-goal="<?php echo $course_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $course_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Course
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="lecture_progress" role="progressbar" data-goal="<?php echo $lecture_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $lecture_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Lecture
                </li>
                <li>
                <div class="progressDiv progressDivLi">
                    <div class="social_progress" role="progressbar" data-goal="<?php echo $social_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $social_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Social Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="endofpopup_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div> End Of Popup
                </li>
            </ul>
        </div>
        </div>
          
        <div class="modal-body scrollbar" id="style-1">
           <form method="post" accept-charset="utf-8" class="tform" id="createCourseForm" enctype="multipart/form-data">                 
            <div class="row">
            <div class="col-sm-4 clear"> 
                <h3 class="progress-head">Create Course</h3>
                <span class="srt-border-btm"></span>
                <p class="progress-txt">Write the goals and ambitions of your online academy and introduce yourself and your team in this page. Let everyone, who visits your online academy, fall in love with your academy. Remember this page creates the ultimate impression to the visitors and the things you write here can change a casual surfer to a potential client. Go to the administrative end of your webpage and edit the content of this page.</p>
                
                 <div class="progressDiv progressDivWelcome">
                  <div class="pie_progress" role="progressbar" data-goal="<?php echo $totalprogress; ?>">

                    <div class="pie_progress__number" style="20%"><?php echo $totalprogress; ?>%</div>

                    <div class="pie-progress-txt pie_progress__label">Completed</div>

                    </div>
                  </div>
            </div>
            <div class="col-sm-8 no-padding border-left"> 
               <div class="form-group form-border"> 
                                
                    <label class='col-sm-12 control-label field-title' for="Paragraph" id="label">Course Name :</label>
                 
                  <div class="col-sm-12"> 
                    <input type="text" class="form-control form-height" name="coursename" id="coursename" value="">
                   </div>
               </div>

               <div class="form-group form-border"> 
                               
                    <label class='col-sm-12 control-label field-title' for="Paragraph" id="label">Upload Image :</label>
                  
                  <div class="col-sm-12"> 
                          <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
                            <div id="localimage_i" class="col-sm-6 img-grey-border">
                              <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/no_images.jpg" width="150" name="imagename" id="imagname">
                                  
                                  <img id="blah" src="#" alt="your image" width="150" style="display: none;">
                                  <input type="hidden" name="cropimage" id="cropimage" value="no_images.jpg">
                            </div>
                            <div class="col-sm-6">
                              <a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/coursecreate" class="upimg_pop btn btn-success btn-border-blue img-align cboxElement">Upload Image</a>
                            </div>
                            <br>
                            <input type="file" name="file_i" id="file_i" class="upload_btn" style="display: none;">     
                            <input type="button" id="remove_id" value="remove" class="btn btn-danger" style="display: none;">
                             
                          </div>
                   </div>
               </div>

               <div class="form-group form-border"> 
                               
                    <label class='col-sm-12 control-label field-title' for="Paragraph" id="label">Description :</label>
                 
                  <div class="col-sm-12"> 
                    <textarea id="descriptionpop" name="descriptionpop"></textarea>
                  </div>
               </div>

               <div class="form-group form-border"> 
                                
                    <label class='col-sm-12 control-label field-title' for="Paragraph" id="label">Course Price :</label>
                  
                  <div class="col-sm-12"> 
                  <div class="grey-background">
                    <input type="checkbox" class="checkclass" name="courseprice[]" onclick="this.checked=true;" id="courseprice" checked value="free">Free</br>
                    <input type="checkbox" class="checkclass" name="courseprice[]" onclick="this.checked=true;" id="courseprice" value="paid">Fixed Rate
                    <input type="text" style="display:none" class="form-control" name="fixedrate" id="fixedrate" value="">
                  </div>
                   </div>
               </div>
            </div>
            <div class="clear"></div>
            
           
            
               
            </div>
            
             
               
            
            </form>
            
          
          
        </div>
        
      </div>
      <div class="modal-footer footer-sect">
      <a class="skip_button skip_button-2" onclick="openProgressbarpop('#socialsetting')">Skip</a>
        <button type="button" class="btn btn-success btn-green" id="applyChanges" onclick="openProgressbarpop('#paymentsetting')" style="float:left;">Previous</button>
         <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="createCourse('#lectureCreate')">Next</button>
        </div>
    </div>
    
  </div>

  <!-- ======================================================================== -->
  <div class="modal" id="lectureCreate" role="dialog" style="display:none">
    <div class="modal-dialog modal-box">
      <span id="close-upload" class="closeUploadProfile close" data-dismiss="modal">
        <img src="http://create-online-academy.com/public/uploads/settings/img/cancel-icon.png" width="30px">
      </span>
      <!-- Modal content-->
      <div class="modal-content">
      <form method="post" action="<?php echo base_url(); ?>admin/templates/createLecture" accept-charset="utf-8" class="tform" id="createLectureForm" enctype="multipart/form-data">                 
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <!--<h4 class="modal-title">Create Lecture</h4>-->
          <div class="prgb-container">
            <ul class="progressbar">
                 <li class="active">
                  <div class="progressDiv progressDivLi" >
                    <div class="Welcome_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <div class="pie_progress__label">Welcome</div> 
                    </div>
                  </div>
                </li>
                <li><div class="progressDiv progressDivLi">
                    <div class="HomePage_progress" role="progressbar" data-goal="<?php echo $home_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $home_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Home Page Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="payment_progress" role="progressbar" data-goal="<?php echo $payment_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $payment_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Payment Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="course_progress" role="progressbar" data-goal="<?php echo $course_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $course_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Course
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="lecture_progress" role="progressbar" data-goal="<?php echo $lecture_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $lecture_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Lecture
                </li>
                <li>
                <div class="progressDiv progressDivLi">
                    <div class="social_progress" role="progressbar" data-goal="<?php echo $social_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $social_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Social Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="endofpopup_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div> End Of Popup
                </li>
            </ul>
        </div>
        </div>
          
        <div class="modal-body scrollbar" id="style-1">
           <!-- <form method="post" action="<?php echo base_url(); ?>admin/templates/createLecture" accept-charset="utf-8" class="tform" id="createLectureForm" enctype="multipart/form-data">                  -->
            <div class="row">
            <div class="col-sm-4 clear"> 
                <h3 class="progress-head">Create Lecture</h3>
                <span class="srt-border-btm"></span>
                <p class="progress-txt">Write the goals and ambitions of your online academy and introduce yourself and your team in this page. Let everyone, who visits your online academy, fall in love with your academy. Remember this page creates the ultimate impression to the visitors and the things you write here can change a casual surfer to a potential client. Go to the administrative end of your webpage and edit the content of this page.</p>
                
                 <div class="progressDiv progressDivWelcome" >
                  <div class="pie_progress" role="progressbar" data-goal="<?php echo $totalprogress; ?>">

                    <div class="pie_progress__number" style="20%"><?php echo $totalprogress; ?>%</div>

                    <div class="pie-progress-txt pie_progress__label">Completed</div>

                    </div>
                  </div>
            </div>
            <div class="col-sm-8 border-left"> 
              <div class="form-group form-border">
      
                      <label class='col-sm-12 control-label field-title' for="Paragraph" id="label">Lecture Name :</label>
                  
                  <div class="col-sm-12">
                      <input type="text" class="form-control form-height" name="lecturename" id="lecturename" value="">
                  </div>
              </div>
              <div class="form-group form-border" style="line-height: 40px;">
                          
                    <label class='col-sm-12 control-label field-title' for="Paragraph" id="label">Lecture Contents :</label>
                  
                  <div class="col-sm-12"> 
                  <!-- <div class="grey-background">
                    <input type="checkbox" class="checkclass" name="lecturetype[]" onclick="this.checked=true;" id="lecturetype" checked value="text_lecture">Text Lecture
                    <input type="checkbox" class="checkclass" name="lecturetype[]" onclick="this.checked=true;" id="lecturetype" value="media_lecture" style="padding-left:2%;">Media Lecture
                   
                   </div> -->
                    <div class="col-sm-12 no-left-padding" id="file_mediaDiv"> 
                    <!-- ================= -->
                    <div id="progress" class="progress">
                          <div id="bar"></div>
                          <div id="percent">0%</div>
                   </div>
                    <!-- ===================== -->
                    <input  type="file" id="file_i" name="file_i">
                    </div>
                  </div>
                  <div class="clear"></div>
                   <div class="col-sm-12" id="lectureTextDiv" style="padding-top: 2%;"> 
                    <textarea  id="lectureText1" name="lectureText1"></textarea>
                    <textarea style="display:none;" id="lectureText" name="lectureText"></textarea>                    
                    </div>
                </div>
                <div id="lectureContent" class="lectureContent">
            <!-- ===================== -->          

            <!-- =========================== -->
            </div>

            </div>
            <div class="clear"></div>
            
                
            
            
            <input type="submit" class="lectureContent" id="lectureBtn" name="lectureBtn" >
            <!-- </form> -->
          <div class="clear"></div>
          </div>
        </div>
        
        </form>
      </div>
      <div class="modal-footer footer-sect">
       <a class="skip_button skip_button-2" onclick="openProgressbarpop('#socialsetting')">Skip</a>
        <button type="button" class="btn btn-success btn-green" id="applyChanges" onclick="openProgressbarpop('#createCourse')" style="float:left;">Previous</button>
         <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="createLecture('#socialsetting')">Next</button>
       
        </div>
    </div>
    </div>

    <!-- ======================================================================== -->
    <div class="modal" id="socialsetting" role="dialog" style="display:none">
    <div class="modal-dialog modal-box">
      <span id="close-upload" class="closeUploadProfile close" data-dismiss="modal">
        <img src="http://create-online-academy.com/public/uploads/settings/img/cancel-icon.png" width="30px">
      </span>
      <!-- Modal content-->
      <div class="modal-content">
       <form method="post" accept-charset="utf-8" class="tform" id="createSocialForm" enctype="multipart/form-data">                 
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <!--<h4 class="modal-title">Create Lecture</h4>-->
        <div class="prgb-container">
            <ul class="progressbar">
                 <li class="active">
                  <div class="progressDiv progressDivLi" >
                    <div class="Welcome_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <div class="pie_progress__label">Welcome</div> 
                    </div>
                  </div>
                </li>
                <li><div class="progressDiv progressDivLi">
                    <div class="HomePage_progress" role="progressbar" data-goal="<?php echo $home_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $home_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Home Page Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="payment_progress" role="progressbar" data-goal="<?php echo $payment_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $payment_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Payment Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="course_progress" role="progressbar" data-goal="<?php echo $course_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $course_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Course
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="lecture_progress" role="progressbar" data-goal="<?php echo $lecture_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $lecture_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Lecture
                </li>
                <li>
                <div class="progressDiv progressDivLi">
                    <div class="social_progress" role="progressbar" data-goal="<?php echo $social_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $social_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Social Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="endofpopup_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div> End Of Popup
                </li>
            </ul>
        </div>
        </div>
          
        <div class="modal-body scrollbar" id="style-1">
        <div class="row">
        <div class="col-sm-4 clear border-right"> 
                <h3 class="progress-head">Social Setting</h3>
                <span class="srt-border-btm"></span>
                <p class="progress-txt">Write the goals and ambitions of your online academy and introduce yourself and your team in this page. Let everyone, who visits your online academy, fall in love with your academy. Remember this page creates the ultimate impression to the visitors and the things you write here can change a casual surfer to a potential client. Go to the administrative end of your webpage and edit the content of this page.</p>
                
                 <div class="progressDiv progressDivWelcome">
                  <div class="pie_progress" role="progressbar" data-goal="<?php echo $totalprogress; ?>">

                    <div class="pie_progress__number" style="20%"><?php echo $totalprogress; ?>%</div>

                    <div class="pie-progress-txt pie_progress__label">Completed</div>

                    </div>
                  </div>
            
            </div>
             <div class="col-sm-8"> 
                <div class="form-group form-border" style="line-height: 40px;">
                          
                    <label class='col-sm-4 col-md-4 control-label field-title' for="Paragraph" id="label">Social Login:</label>
                  
                  <div class="col-md-8 col-sm-8"> 
                    <div class="onoffswitch">
              <input type="checkbox" name="socialLogin" class="onoffswitch-checkbox" id="myonoffswitch" value="1" checked>
              <label class="onoffswitch-label" for="myonoffswitch">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
              </label>
                </div>
              </div>
            </div>
                <div class="form-group form-border" style="line-height: 40px;">
                          
                    <label class='col-sm-4 col-md-4 control-label field-title' for="Paragraph" id="label">Social Icon:</label>
                  
                  <div class="col-md-8 col-sm-8"> 
                    <div class="onoffswitch">
              <input type="checkbox" name="socialIcon" class="onoffswitch-checkbox" id="myonoffswitch1" value="1" checked>
              <label class="onoffswitch-label" for="myonoffswitch1">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
              </label>
          </div>
                  </div>
                </div>
            </div>
          <div class="clear"></div>
          </div>
        </div>
        
        </form>
      </div>
      <div class="modal-footer footer-sect">
       <a class="skip_button skip_button-2" onclick="openProgressbarpop('#endofpopup')">Skip</a>
        <!-- <button type="button" class="btn btn-success btn-green" id="applyChanges" onclick="savePaymentSetting('#sociallgins')" style="float:left;">Previous</button> -->
         <button type="button" class="btn btn-success btn-green" id="applyChanges" onclick="openProgressbarpop('#lectureCreate')" style="float:left;">Previous</button>
         <!-- <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="social_status()">Next</button> -->
          <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="social_status('#endofpopup')">Next</button>
        </div>
    </div>
    </div>
    
<!-- ======================================================================== -->
    <!-- ======================================================================== -->
    <div class="modal" id="endofpopup" role="dialog" style="display:none">
    <div class="modal-dialog welcome-modal-box">
      <span id="close-upload" class="closeUploadProfile close" data-dismiss="modal">
        <img src="http://create-online-academy.com/public/uploads/settings/img/cancel-icon.png" width="30px">
      </span>
      <!-- Modal content-->
      <div class="modal-content">       
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <!--<h4 class="modal-title">Create Lecture</h4>-->
        <div class="prgb-container">
            <ul class="welcome-progressbar progressbar">
                <li class="active">
                  <div class="progressDiv progressDivLi" >
                    <div class="Welcome_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <div class="pie_progress__label">Welcome</div> 
                    </div>
                  </div>
                </li>
                <li><div class="progressDiv progressDivLi">
                    <div class="HomePage_progress" role="progressbar" data-goal="<?php echo $home_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $home_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Home Page Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="payment_progress" role="progressbar" data-goal="<?php echo $payment_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $payment_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Payment Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                    <div class="course_progress" role="progressbar" data-goal="<?php echo $course_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $course_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Course
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="lecture_progress" role="progressbar" data-goal="<?php echo $lecture_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $lecture_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Create Lecture
                </li>
                <li>
                <div class="progressDiv progressDivLi">
                    <div class="social_progress" role="progressbar" data-goal="<?php echo $social_status; ?>">
                      <div class="pie_progress__number" style="font-size: 10px;"><?php echo $social_status; ?>%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div>Social Setting
                </li>
                <li>
                  <div class="progressDiv progressDivLi">
                   <div class="endofpopup_progress" role="progressbar" data-goal="0">
                      <div class="pie_progress__number" style="font-size: 10px;">0%</div>
                      <!-- <div class="pie_progress__label">Welcome</div> -->
                    </div>
                 </div> End Of Popup
                </li>
            </ul>
        </div>
        </div>
          
        <div class="modal-body welcome-content scrollbar" id="style-1">
        <div class="row">
        <div class="col-sm-6 clear border-right"> 
            <h3 class="progress-head welcome-head" style="text-align:center">Bye Bye</h3>
            <span class="welcome-border-btm"></span>
            <p class="progress-txt" style="text-align:center">Write the goals and ambitions of your online academy and introduce yourself and your team in this page. Let everyone, who visits your online academy, fall in love with your academy.</p>
        
             <div class="progressDiv progressDivWelcome">
                  <div class="pie_progress" role="progressbar" data-goal="<?php echo $totalprogress; ?>">

                    <div class="pie_progress__number" style="20%"><?php echo $totalprogress; ?>%</div>

                    <div class="pie-progress-txt pie_progress__label">Completed</div>

                    </div>
            </div>
        </div>
             <div class="col-sm-6"> 
                <div class="form-group form-border" style="margin: 0 0 60px 0;">
                  <label for="field-12" class="col-sm-12 no-padding control-label field-title" style="padding-bottom:2%;">Profile Photo</label>
                  <img src="http://create-online-academy.com/public/uploads/settings/img/profile-img.jpg" style="cursor: pointer;width: 100%;height: auto;margin-bottom:4%;" height="250px" width="250px">
                  <a href="#" style="text-decoration: underline;">Edit Image
                </div>
            </div>
            </div>
          </div>
        
        
        
        </div>
        <div class="modal-footer footer-sect">
       
        <button type="button" class="btn btn-success btn-green" id="applyChanges" onclick="openProgressbarpop('#socialsetting')" style="float:left;">Previous</button>
         <!-- <a class="skip_button skip_button-2">Skip</a> -->
         <button type="button" class="btn btn-success btn-blue" id="applyChanges" onclick="openProgressbarpop('#stopProgress')">Next</button>
         
        </div>
      </div>
      
    </div>

  </div>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/colorbox-master/example1/colorbox.css" />

<script src="<?php echo base_url(); ?>public/colorbox-master/jquery.colorbox.js"></script>
<script>
    //var $j = jQuery.noConflict();
    $(document).ready(function(){
    
    $(".addlogo_pop").colorbox({
    iframe:true,
    width:"500px", 
    height:"50%",
    fadeOut:500,
    fixed:true,
    reposition:true,  
    })

    $(".addfev_pop").colorbox({
    iframe:true,
    width:"500px", 
    height:"50%",
    fadeOut:500,
    fixed:true,
    reposition:true,  
    })   
        

    $(".upimg_pop").colorbox({
    iframe:true,
    width:"600px", 
    height:"60%",
    fadeOut:500,
    fixed:true,
    reposition:true,  
    }) 
         console.log(<?php echo $home_status ?>);
         console.log(<?php echo $payment_status ?>);
         console.log(<?php echo $course_status ?>);
         console.log(<?php echo $lecture_status ?>);
         console.log(<?php echo $social_status ?>);


        <?php
       if($home_status==0 || $payment_status ==0 || $course_status==0 || $lecture_status==0 || $social_status ==0)
         {
       ?>
       openProgressbarpop("#welcome"); 
       <?php
         }
         else if($home_status == 0)
        {
       ?>
       openProgressbarpop("#homeLogoImage"); 
       <?php
          }
          else if($payment_status == 0)
          {
       ?>
       openProgressbarpop("#paymentsetting"); 
       <?php
          }
          else if($course_status == 0)
          {
       ?>
       openProgressbarpop("#createCourse"); 
       <?php
          }
          else if($lecture_status == 0)
          {
       ?>
       openProgressbarpop("#lectureCreate"); 
       <?php
          }
          else if($social_status == 0)
          {
       ?>
       openProgressbarpop("#socialsetting"); 
       <?php
          }
          
       ?>
       
      //openProgressbarpop("#homeLogoImage"); 
      //openProgressbarpop("#paymentsetting");
      //openProgressbarpop("#createCourse");
      //openProgressbarpop("#lectureCreate");
      //openProgressbarpop("#socialsetting");
      //openProgressbarpop("#endofpopup"); 
        
     });
    </script>

  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 
<script>

  $(document).ready(function(){
$("input:checkbox").on('click', function() {
  
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[id='" + $box.attr("id") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});


// jQuery('#lectureText').redactor({
//               focus: true,
//               //imageUpload: window.location.origin+'/admin/widgets/getImage',
//               'plugins': ['fontsize','fontcolor','fontfamily'],  //'video','imagelink'
                              
//       });

});
</script>

<script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>
  <script>

 //    jQuery(document).ready(function() 
 //    {
 //      tinymce.init({
 //  selector: '#lectureText1',
 //  height: 180,
 // // min_width: 400,
 //  theme: 'modern',
 //  plugins: [
 //    'advlist autolink lists print preview hr anchor pagebreak',
 //    'searchreplace wordcount visualblocks visualchars code fullscreen',
 //    'insertdatetime nonbreaking save table contextmenu directionality',
 //    'paste textcolor colorpicker textpattern'
 //  ],
 //  menubar: 'file edit insert view format table',
 //  toolbar1: 'undo redo | bold italic | alignleft aligncenter | alignright alignjustify | bullist numlist | outdent indent | forecolor backcolor fontselect fontsizeselect | print preview fullscreen',
 //  //toolbar2: 'print preview | forecolor backcolor',
 //  //toolbar2:'fontselect fontsizeselect | styleselect',
 //  image_advtab: true,
 //  paste_as_text: true,  
 //  // templates: [
 //  //   { title: 'Test template 1', content: 'Test 1' },
 //  //   { title: 'Test template 2', content: 'Test 2' }
 //  // ],
 //  content_css: [
 //    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
 //    '//www.tinymce.com/css/codepen.min.css'
 //  ]
 // });
 //   });

   tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
selector : "#lectureText1,#descriptionpop"
});
  </script>


