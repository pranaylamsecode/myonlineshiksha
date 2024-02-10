<!-- ---------------------------------------------Paragraph-POP-UP-Start----------------------------------------------- -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/progressbar/progressbar.js"></script>
<div class="modal" id="homeLogoImage" role="dialog" style="display:none">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Home Page Setting</h4>
        </div>
        <div class="modal-body" id="prograss_content">
             
            <div class="col-md-12"> 
             <div class="form-group">
               
                  <label for="Paragraph" id="label">Academy Name :</label>
                  <input type="text" class="form-control" name="academy_name" id="academy_name" value="<?php echo $data[0]['institute_name']; ?>">
         
             </div>
            </div>

              
            <div class="col-md-12"> 
              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Logo :</label>            
                <div class="col-sm-5">
                    <input type="hidden" class="form-control" value="1916_12-19-2015.png" name="imagename" id="imagename">

                    <div id="localimage_i">
                      <img src="<?php echo base_url(); ?>public/uploads/settings/img/logo/<?php echo $data[0]['logoimage']; ?>" width="150" id="imgnamelogo">
                      <a href="<?php echo base_url(); ?>admin/templates/croplogo/logo" class="addlogo_pop btn btn-success cboxElement">Add Logo</a>
                    </div>

                   <span class="error"></span><span class="help-inline">Logo (164px X 44px)</span>
                     
                </div>
                <p class="pdesign">Please make sure that the name of the file for the logo does not contain any spaces or special characters.</p>
              </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Favicon :</label>                
                <div class="col-sm-5">
                  <input type="hidden" class="form-control" value="2623_09-14-2015.png" name="favname" id="favname">

                  <div id="localimage_i">
                     <img src="<?php echo base_url(); ?>public/uploads/settings/img/logo/<?php echo $data[0]['favicon']; ?>" width="25" id="imgnameficon">
                      <a href="<?php echo base_url(); ?>admin/templates/croplogo/icon" class="addfev_pop btn btn-success cboxElement" style="margin-left: 128px;">Add Favicon</a>
                  </div>
                  <span class="error"></span><span class="help-inline"></span>
               </div>
                <div class="col-sm-4">
                  <p style="text-align: center;" class="pdesign"><a href="https://en.wikipedia.org/wiki/Favicon" target="_blank">What is Favicon?</a></p>
                </div>
            </div>
          </div>
            
          
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="saveHome('#paymentsetting')">Next</button>
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Paragraph-POP-UP-End----------------------------------------------- -->
<!-- ---------------------------------------------payment setting-POP-UP-Start----------------------------------------------- -->

<div class="modal" id="paymentsetting" role="dialog" style="display:none">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Setting</h4>
        </div>

        <div class="modal-body"> 
        <form method="post" accept-charset="utf-8" class="tform" id="paymentsettingForm" enctype="multipart/form-data">                 
          
          <div class="row">
            <div class="col-md-12">      
              <div class="panel panel-primary" data-collapsed="0">      
                <div class="panel-heading">
                  <div class="panel-title">
                    Payment&nbsp;Setting
                  </div>
                </div>
                <div class="panel-body">
                    <fieldset role="form" class="adminform form-horizontal form-groups-bordered">         
                      <div class="form-group">
                      <input style="margin-left: 363px;" id="paypalckb" type="checkbox" <?php if($pay_setting['0']['paypal_status'] == 1) echo 'checked' ?> name="paypalckb" value="1" onclick="showhidePaypal();"> &nbsp; Paypal <br>

                      <input style="margin-left: 363px;" id="otherckb" type="checkbox" <?php if($pay_setting['0']['directpay_status'] == 1) echo 'checked' ?> name="otherckb" value="1" onclick="showhideOther();"> &nbsp; Other Payment Information
                      </div>
                    </fieldset>
                </div>

              </div>
            </div>
        </div>  

           <!-- @@@@@@@@@@@@@@@@@@@@@  -->

           <div class="row" id="paypalpanal" style="display: block;">
                  <div class="col-md-12">                    
                    <div class="panel panel-primary" data-collapsed="0">                    
                      <div class="panel-heading">
                        <div class="panel-title">
                          Paypal&nbsp;Setting                          
                        </div>
                        <p class="ptext2"> Don't have a PayPal Account? Click on the link and create one now !<a href="https://www.paypal.com" target="_blank"> click here </a></p>
                        <div class="panel-options">
                          <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                          <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                        </div>
                      </div>
                            <div class="panel-body">
                        
                        <fieldset role="form" class="adminform form-horizontal form-groups-bordered">
                  
                          
                          <div class="form-group">
                            <label for="first Name" class="col-sm-3 control-label">PayPal Username<span style="color:#FF0000;" class="error">*</span></label>
                            
                            <div class="col-sm-5">
                                            
                                <input id="api_username" type="text" name="api_username" class="form-control" placeholder="Enter API Username" maxlength="256" value="<?php echo $pay_setting[0]['api_username']; ?>">
                              <span class="tooltipcontainer">

                            <span type="text" id="api_uname-target" class="tooltipicon"></span>

                            <span class="api_uname-target  tooltargetdiv" style="display: none;">

                            <span class="closetooltip"></span>
                           
                              Enter API Username                                        

                            </span>

                            </span>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="first Name" class="col-sm-3 control-label">PayPal Password<span style="color:#FF0000;" class="error">*</span></label>
                            
                            <div class="col-sm-5">
                                            
                                            <input id="api_password" type="password" name="api_password" class="form-control" placeholder="Enter API password" maxlength="256" value="<?php echo $pay_setting[0]['api_password'];  ?>">
                                            
                                           

                            <span class="tooltipcontainer">

                            <span type="text" id="apipwd-target" class="tooltipicon"></span>

                            <span class="apipwd-target  tooltargetdiv" style="display: none;">

                            <span class="closetooltip"></span>

                            <!--tip containt-->

                            Enter API Password
                                         <!--/tip containt-->

                            </span>

                            </span>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="first Name" class="col-sm-3 control-label">PayPal Signature<span style="color:#FF0000;" class="error">*</span></label>
                            
                            <div class="col-sm-5">
                                            
                                            <input id="api_signature" type="text" name="api_signature" class="form-control" placeholder="Enter API Signature" maxlength="256" value="<?php echo $pay_setting[0]['api_signature'];  ?>">
                                            
                                            <!-- tooltip area -->

                            <span class="tooltipcontainer">

                            <span type="text" id="apisign-target" class="tooltipicon"></span>

                            <span class="apisign-target  tooltargetdiv" style="display: none;">

                            <span class="closetooltip"></span>

                            <!--tip containt-->

                            Enter API Signature
                                         <!--/tip containt-->

                            </span>

                            </span>

                <!-- tooltip area finish -->
                  

                            </div>
                          </div>          
                          
                          
                          <div class="form-group">
                            <label for="first Name" class="col-sm-3 control-label">Name<span style="color:#FF0000;" class="error">*</span></label>
                            
                            <div class="col-sm-5">
                                            
                                            <input id="name" type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="256" value="<?php echo $pay_setting[0]['name']; ?>">
                                            
                                           

                            <span class="tooltipcontainer">

                            <span type="text" id="name-target" class="tooltipicon"></span>

                            <span class="name-target  tooltargetdiv" style="display: none;">

                            <span class="closetooltip"></span>

                           

                            Enter Name
                                         

                            </span>

                            </span>
                            </div>
                            <div class="col-sm-4">
                            Has to be the same as in your Paypal Account
                            </div>
                          </div>
                          
                          
                          <div class="form-group">
                                    
                            <div class="col-sm-offset-3 col-sm-5">
                                        
                              <div class="checkbox">
                                <label>
                                  
                                                    
                                    <input id="isLive" type="checkbox" <?php if($pay_setting[0]['status'] == 1) echo 'checked'; ?> name="isLive" value="1">Activate the PayPal Gateway(You won't be receiving any payment through PayPal till you activate.)
                                   



                <!-- tooltip area -->

                            <span class="tooltipcontainer">

                            <span type="text" id="active-target" class="tooltipicon"></span>

                            <span class="active-target  tooltargetdiv" style="display: none;">

                            <span class="closetooltip"></span>

                            <!--tip containt-->

                            Is Live mode Active?
                                         <!--/tip containt-->

                            </span>

                            </span>

                <!-- tooltip area finish -->
                                </label>
                              </div>
                              
                              
                            </div>
                          </div>
                                    

                          
                        </fieldset>
                        
                      </div>
                          </div>
                  
                  </div>
</div>

           <!-- @@@@@@@@@@@@@@ -->

           <div class="row" id="otherpanal" style="display: block;">
          <div class="col-md-12">
    
            <div class="panel panel-primary" data-collapsed="0">
    
              <div class="panel-heading">
                <div class="panel-title">               
                  Other Payment Information
                  <p style="padding-left: 284px" ;="">Here you can put the alternative options of receiving payment from the Academy Users</p>
                </div>

                <div class="panel-options">
                  <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                  <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                  <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                  <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
              </div>
              <div class="panel-body">
        
                  <fieldset role="form" class="adminform form-horizontal form-groups-bordered">         
                    <div class="form-group">
                    <!-- <textarea></textarea> -->
                      <label for="first Name" class="col-sm-3 control-label">Other Payment Information<!-- <span style="color:#FF0000;" class="error">*</span> --></label>
                    <div class="col-sm-5">
                    
                                      <textarea id="othertxt" name="othertxt" class="form-control"><?php echo $pay_setting[0]['directinfo']; ?></textarea>
                                        </div>
                    </div>
                  </fieldset>
              </div>

            </div>
          </div>
        </div>
          </form>
          <!-- @@@@@@@@@@@@@@@@@@@@ -->
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="savePaymentSetting('#sociallgins')">Next</button>
        </div>
      </div>
      
    </div>
    
  </div>


  <!-- ============================================================================== -->


  <div class="modal" id="sociallgins" role="dialog" style="display:none">
    <div class="modal-dialog">
    
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Course</h4>
        </div>
        <div class="modal-body">
           <form method="post" accept-charset="utf-8" class="tform" id="createCourseForm" enctype="multipart/form-data">                 
            <div class="col-md-12"> 
               <div class="form-group"> 
                  <div class="col-md-4">              
                    <label for="Paragraph" id="label">Course Name :</label>
                  </div>
                  <div class="col-md-8"> 
                    <input type="text" class="form-control" name="coursename" id="coursename" value="">
                   </div>
               </div>
            </div>
            <div class="clear"></div>
            <div class="col-md-12"> 
               <div class="form-group"> 
                  <div class="col-md-4">              
                    <label for="Paragraph" id="label">Upload Image :</label>
                  </div>
                  <div class="col-md-8"> 
                          <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
                            <div id="localimage_i">
                              <img src="<?php echo base_url(); ?>public/uploads/programs/img/thumb_232_216/no_images.jpg" width="150" name="imagename" id="imagname">
                                  <div><a href="<?php echo base_url(); ?>admin/programs/cropcourseimg/coursecreate" class="upimg_pop btn btn-success cboxElement">Upload Image</a></div>
                                  <img id="blah" src="#" alt="your image" width="150" style="display: none;">
                                  <input type="hidden" name="cropimage" id="cropimage" value="no_images.jpg">
                            </div>
                            <br>
                            <input type="file" name="file_i" id="file_i" class="upload_btn" style="display: none;">     
                            <input type="button" id="remove_id" value="remove" class="btn btn-danger" style="display: none;">
                             
                          </div>
                   </div>
               </div>
            </div>
            <div class="clear"></div>
            <div class="col-md-12"> 
               <div class="form-group"> 
                  <div class="col-md-4">              
                    <label for="Paragraph" id="label">Description :</label>
                  </div>
                  <div class="col-md-8"> 
                    <textarea id="descriptionpop" name="descriptionpop"></textarea>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
             <div class="col-md-12"> 
               <div class="form-group"> 
                  <div class="col-md-4">              
                    <label for="Paragraph" id="label">Course Price :</label>
                  </div>
                  <div class="col-md-8"> 
                    <input type="checkbox" class="checkclass" name="courseprice[]" onclick="this.checked=true;" id="courseprice" checked value="free">Free</br></br>
                    <input type="checkbox" class="checkclass" name="courseprice[]" onclick="this.checked=true;" id="courseprice" value="paid">Fixed Rate
                    <input type="text" style="display:none" class="form-control" name="fixedrate" id="fixedrate" value="">
                  </div>
                   
               </div>
            </div>
            </form>
            <div class="clear"></div>
          
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="createCourse('#emailsetting')">Next</button>
        </div>
      </div>
      
    </div>
    
  </div>

  <!-- ======================================================================== -->
  <div class="modal" id="emailsetting" role="dialog" style="display:none">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Lecture</h4>
        </div>
        <div class="modal-body">
          
            <div class="col-md-12"> 
              <div class="form-group">
                  <div class="col-md-4">
                      <label for="Paragraph" id="label">Lecture Name :</label>
                  </div>
                  <div class="col-md-8">
                      <input type="text" class="form-control" name="lecturename" id="lecturename" value="">
                  </div>
              </div>
            </div>
            <div class="clear"></div>
             <div class="col-md-12"> 
                <div class="form-group">
                  <div class="col-md-4">              
                    <label for="Paragraph" id="label">Lecture type :</label>
                  </div>
                  <div class="col-md-8"> 
                    <input type="checkbox" class="checkclass" name="lecturetype[]" onclick="this.checked=true;" id="lecturetype" checked value="text_lecture">Text Lecture
                    <input type="checkbox" class="checkclass" name="lecturetype[]" onclick="this.checked=true;" id="lecturetype" value="media_lecture">Media Lecture
                   
                    <div class="col-md-8" id="file_mediaDiv" style="display:none"> 
                    <input  type="file" id="file_media" name="file_media">
                    </div>
                  </div>
                  <div class="clear"></div>
                   <div class="col-md-12" id="lectureTextDiv"> 
                    <textarea  id="lectureText" name="lectureText"></textarea>
                    </div>
                </div>
            </div>
          <div class="clear"></div>
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="openProgressbarpop()">Next</button>
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
        
      openProgressbarpop("#homeLogoImage"); 
     // openProgressbarpop("#paymentsetting");
      //openProgressbarpop("#sociallgins");
       //openProgressbarpop("#emailsetting");
        
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


