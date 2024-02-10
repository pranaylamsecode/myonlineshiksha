<!-- ---------------------------------------------Paragraph-POP-UP-Start----------------------------------------------- -->
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/lecture_preview.css">
<style>
#progress {
  top: 14px;
}
#percent_gallery, #percent_video, #percent_audio, #percent_pdf, #percent_flash {
  left: 0%;
}
#percent{
  left:50%;
}
.renew-top-close-btn{
  margin-top:2%!important;
}
.para_popup{
  top: 10%;
}
.para_popup .modal-dialog{
  width: 735px;
}
.para_popup .form-body{
  width: 100%;
}
</style>
<div class="modal fade para_popup" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">Paragraph</h4>
        </div>
        <div class="modal-body" style="display:-webkit-box;padding-bottom:0px;">
          <div class="form-body"> 
            <div class="col-md-12" style="padding-top:4%;"> 
              <div class="form-group">
               <input type="hidden" name="txtparagraph" id="txtparagraph" value="">
               <input type="hidden" name="tempval" id="tempval" value="">
          <label for="Paragraph" class="field-title" id="label">Enter Your Text:</label>
         <!--  <textarea class="form-control paragraphclass" rows="5" id="paragraph"></textarea> -->
        <textarea class="form-control paragraphclass" rows="5" id="paragraph"></textarea>
        </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer" style="border:0px;margin-top: 0;">
         <button type="button" class="btn btn-blue" id="applyChanges" onclick="setText()">Apply changes</button>
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Paragraph-POP-UP-End----------------------------------------------- -->
<!-- ---------------------------------------------Image-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
        
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">Image</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    

      <div> 
        <ul class="nav nav-tabs bordered blue-border">
          <li class="active" id="image_file" style="border-left:none!important;"> 
            <a href="#upfil" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-home"></i></span> 
            <span class="hidden-xs">Upload File</span> 
            </a> 
          </li> 
          <li id="image_library"> 
            <a href="#medlib" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Media Library</span> 
            </a> 
          </li>
          <li id="image_url"> 
            <a href="#medins" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Insert URL</span> 
            </a> 
          </li>
        </ul> 

        <div class="tab-content tab-box" style="display: -webkit-box;">
          <div class="tab-pane active" id="upfil" style="width:100%;"> 
           <form id="myForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group form-border "> 
              <label class="col-sm-12 field-title control-label no-padding">Image Upload</label> 

              <div class="col-sm-12 no-padding"> 
                <div class="fileinput fileinput-new" data-provides="fileinput" style="width:100%;margin-bottom:0px;">
                  
                  <input type="hidden"> 
                  
                  <div class="col-sm-6 fileinput-new thumbnail" style="padding:0px;" data-trigger="fileinput"> 
                  <img src="http://placehold.it/200x150" alt="..." id="imgname" class="img-responsive profile-image"> 
                  <img id="blah" src="#" width="125px" height="130px" alt="your image" class="img-responsive profile-image">
                  </div> 
                  
                  <div class="col-sm-6 fileinput-preview fileinput-exists thumbnail" style="padding:0px;max-width: 200px; max-height: 150px; line-height: 10px;"></div> 

                  <div class="col-sm-6"> 
                  <!-- <form id="myForm" action="<?php echo base_url(); ?>tasks/upload_image" method="post" enctype="multipart/form-data"> -->
                    <span class="btn btn-white btn-file btn-border-blue"> 
                    <span class="fileinput-new">Select image</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="image/*" id="file_i" name="file_i" data-filename-placement="inside"> </span> 
                    <a href="#" class="btn btn-border-green fileinput-exists" data-dismiss="fileinput">Remove</a> 
                    <!-- <input type="button" id="remove_id" value="Remove" class="btn btn-red" /> -->
                    <span id="profineDiv"></span>
                  </div>                  
                   
                   
                  <br/>
                   
                  <div id="message"></div>

                  <!-- new code end here -->
                </div> 
                <div id="progress" class="progressBar" style="margin-bottom:3%;">
                          <div id="bar"></div>
                          <div id="percent">0%</div >
                  </div>
              </div> 

            </div>
            
            <div class="form-group form-border" style="margin-bottom:8%;">
            <label class="control-label"></label> 

              <div class="col-sm-12 no-padding"> 
                  <input type="hidden" value="" id="img_div_id" name="img_div_id">
                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Image" class="form-control">
                <input type="submit" id="submit" class="btn btn-blue btn-success" value="Upload Image"/>
              </div>

            </div>
            </form>
          </div> 

          <div class="tab-pane" id="medlib" style="width:100%;"> 
            <div class="col-sm-12" id="row_list" >
            <!-- empty Div row for prepend column start-->
            <div class="row" id="images_list" style="padding: 0 0 10px 0;">
            </div>
            <!-- empty Div row for prepend column end-->
            
            <!-- ll<?php
            $imagecount =0; 
            $counter = 0;
            if($loadImage)
            {
            foreach($loadImage as $key => $imagedata) 
            { 
              if($counter == 0)
              { 
            ?>
            <div class="row" style="padding: 0 0 10px 0;">
            <?php } ?>
            
              
              <div class="col-sm-3">                
                <img src="<?php echo base_url();?>public/uploads/images/<?php echo $imagedata->media_title;?>" alt="<?php echo $imagedata->media_title;?>_<?php echo $imagedata->id;?>" width="100%"> 
              </div>
                  
              <?php
              $counter =1;
              if(($key+1) %4 == 0)
              {
                
              ?>                
              </div>
            <?php 
            $counter = 0;       
              }
            $imagecount++;
            } 
          }
          else
          {
            echo"Image Not Available";
          } 
            ?>
                             
              <?php 
            if($imagecount % 4 != 0) 
            {
            ?>
              </div>
            <?php
               }
            ?>ll -->
            </div>

            <div class="col-sm-12" style="display:block;padding-top: 20px;padding-left:0px;padding-right:0px;">
            <form id="save_image_data" name="save_image_data" action="<?php echo base_url(); ?>admin/tasks/update_images_data" method="post" enctype="multipart/form-data">
              <div class="form-group form-border">
              <label class="col-sm-12 control-label no-padding field-title">Title</label> 
                <div class="col-sm-12 no-padding"> 
                  <input type="hidden" name="image_id" id="image_id" class="form-height form-control">
                  <input type="hidden" name="title_media" id="title_media" class="form-height form-control">
                  <input type="text" name="alt_title_image" id="alt_title_image" class="form-height form-control">
                </div>
              </div>

              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="submit" id="save_image" class="btn btn-blue btn-success" value="Save" onclick=""/>
                </div>

              </div>  
              </form>
            </div>

          </div> 

          <div class="tab-pane" id="medins" style="width:100%;"> 

            <div class="col-sm-12 no-padding" style="display:block;">

              <div class="form-group form-border">
              <label class="col-sm-12 field-title control-label no-padding">Insert Image URL</label> 
                <div class="col-sm-12 no-padding"> 
                  <input type="text" id="txt_image_url" name="txt_image_url" class="form-height form-control">
                </div>
              </div>


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="button" id="submit" class="btn btn-blue" value="Save" onclick="addImageUrl()"/>
                </div>

              </div>  

            </div>


          </div> 

        </div> 

      </div>

    </div>
    
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Image-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------Button-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalbutton" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">Button</h4>
        </div>
        <div class="modal-body">
              <!-- new code -->       
        <div class="form-body" style="display: -webkit-box;">             
            <div class="col-md-12"> 
                  <div class="form-group form-border">
                
                <label class="col-sm-12 field-title control-label" style="padding:0px;">Title of Button</label>       
                 <div class="col-sm-12" style="padding:0px;">
                  <input type="hidden" name="btn_div_id" id="btn_div_id" value="">  
                   <input type="hidden" name="courseg" id="courseg" value="<?php echo $this->uri->segment(3)=="edit"? $this->uri->segment(6): $this->uri->segment(5); ?>">        
                  <input type="text" name="title_button" id="title_button" class="form-height form-control">
                </div>
               </div>

               <div class="form-group form-border">
               <label class="col-sm-12 field-title control-label" style="padding:0px;">Description</label>  
               <div class="col-sm-12" style="padding:0px;">
                <textarea class="select-box-border" id="msgforbtn" name="msgforbtn" style="width: 100%;"></textarea>
                </div>
               </div>

               <div class="form-group form-border">        
                  <div class="grey-background">    
                <div class="checkbox">                
                  <label><input type="checkbox" onclick="this.checked=true; loadCourses(this.id)" id="self_course" name="group2[]" value="">Self Course</label>
                </div>
                <div class="checkbox" style="margin-left: 6%!important;">
                  <label><input type="checkbox" onclick="this.checked=true; loadCourses(this.id)" id="other_courses" name="group2[]" value="">Other Courses</label>
                </div>
              </div>
                  
                </div>

               <div class="form-group">
                  <ul class="lay-ul" id="ULloadcurse">                    
                          </ul>
                    </div>

            </div>            
                
      </div>

          <!-- new code end -->
        </div>
        <div class="modal-footer" style="border:none;">
         <!-- <button type="button" class="btn btn-success" id="applyChanges1">Apply changes</button> -->
        </div>
      </div>
      
    </div>
    
  </div>

<!-- ---------------------------------------------Button-POP-UP-End----------------------------------------------- -->


<!-- ---------------------------------------------Video-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalyoutube" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">Videos</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    

      <div> 
        <ul class="nav nav-tabs bordered blue-border">
          <li class="active" id="video_file" style="border-left:none!important;"> 
            <a href="#video-upfil" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-home"></i></span> 
            <span class="hidden-xs">Upload File</span> 
            </a> 
          </li> 
          <li id="video_library"> 
            <a href="#video-medlib" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Media Library</span> 
            </a> 
          </li>
          <li id="video_url"> 
            <a href="#videoins" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Insert Videos URL</span> 
            </a> 
          </li>
          <li id="video_url"> 
            <a href="#videoiframe" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Insert Videos code</span> 
            </a> 
          </li>
          
        </ul> 

        <div class="tab-content tab-box" style="display: -webkit-box;">
          <div class="tab-pane active" id="video-upfil" style="width:100%;"> 
          <form id="videoForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group"> 
              <label class="col-sm-12 txt_cntr_algn field-title control-label">Upload File</label> 

              <div class="col-sm-12 txt_cntr_algn"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <input type="hidden" value="" name="..."> 

                  <span id="uploadFile" class="btn btn-info btn-file btn-border-blue"> 
                    <span class="fileinput-new">Select file</span> 
                    <span class="fileinput-exists">Change</span> 
                    <!-- <input type="file" accept="video/*" name="file_i" id="file_v">  -->
                  </span>

                  

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div> 
                <div id="progress_video" class="txt_cntr_algn progressBar center_progress">
                          <div id="bar_video"></div>
                          <div id="percent_video">0%</div >
                  </div> 
              </div>

            </div>
          
            <div class="form-group">
            <label class="control-label"></label> 

              <div class="col-sm-12 txt_cntr_algn"> 
                  <input type="hidden" value="" id="video_div_id" name="video_div_id">
                  <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">                  
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Video" class="form-control">
                <!-- <input type="submit" id="submitvideo" class="btn btn-blue" value="Save"/> -->
                <input type="button" id="submitvideo" class="btn btn-blue" value="Save"/>
              </div>

            </div>
           </form>
          </div> 
          <div class="tab-pane" id="video-medlib" style="width:100%;"> 
            <div class="col-sm-12" id="video_row_list" style="height: 175px;overflow: auto;">

              <!-- empty Div row for prepend column start-->
            <div class="row" id="video_list" style="padding: 0 0 10px 0;">
            </div>
            <!-- empty Div row for prepend column end-->
            
           <!--  ll<?php
            $videocount =0; 
            $counter = 0;
            if($loadVideo)
            {
            foreach ($loadVideo as $key => $videodata) 
            { 
              if($counter == 0)
              { 
            ?>
            <div class="row" style="padding: 0 0 10px 0;">
            <?php } ?>
            
              
              <div class="col-sm-3">  
              
              <img src="" width="125" height="100" alt="<?php echo $videodata->media_title;?>#_#<?php echo $videodata->id;?>">              
                
              </div>
                  
              <?php
              $counter =1;
              if(($key+1) %4 == 0)
              {
                
              ?>                
              </div>
            <?php 
            $counter = 0;       
              }
              $videocount++;
            }
          }
          else
          {
            echo"Videos Not Available";
          }  
            ?>
           
            <?php 
            if($videocount % 4 != 0) 
            {
            ?>
              </div>
            <?php
               }
            ?>ll -->
                          
              
            </div>

            <div class="col-sm-12" style="display:block;padding-top: 20px;padding-left:0px;padding-right:0px;">
            <form id="save_video_data" name="save_video_data" action="<?php echo base_url(); ?>admin/tasks/update_video_data" method="post" enctype="multipart/form-data">
              <div class="form-group form-border">
              <label class="col-sm-12 no-padding field-title control-label">Title</label> 
                <div class="col-sm-12 no-padding">      

                  <input type="hidden" name="video_id" id="video_id" class="form-height form-control">
                  <input type="hidden" name="title_video" id="title_video" class="form-height form-control">
                  <input type="text" name="alt_title_video" id="alt_title_video" class="form-height form-control">

                </div>
              </div>            


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="submit"  class="btn btn-blue" value="Save" />
                </div>

              </div>  
              </form>
            </div>


          </div> 

          <div class="tab-pane" id="videoins" style="width:100%;"> 

            <div class="col-sm-12" style="display:block;padding: 0px;">

              <div class="form-group form-border">
              <label class="col-sm-12 no-padding filed-title control-label">Insert Videos URL</label> 
                <div class="col-sm-12 no-padding"> 
                  <input type="text" class="form-control form-height" id="txt_video_url">
                </div>
              </div>


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="button" id="videourl" class="btn btn-blue" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
                </div>

              </div>  

            </div>


          </div> 

          <div class="tab-pane" id="videoiframe" style="width:100%;"> 

            <div class="col-sm-12" style="display:block;padding:0px;">

              <div class="form-group form-border">
              <label class="col-sm-12 field-title no-padding control-label">Insert Videos code</label> 
                <div class="col-sm-12 no-padding"> 
                  <!-- <input type="text" class="form-control" id="txt_video_embed"> -->
                  <textarea class="form-control select-box-border" id="txt_video_embed" rows="3"></textarea>
                </div>
              </div>


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="button" id="videoembed" class="btn btn-blue" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
                </div>

              </div>  

            </div>


          </div>

        </div> 

      </div>

    </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Video-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------PDF-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalpdf" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">PDF</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 


      <div> 
        <ul class="nav nav-tabs bordered blue-border">
          <li class="active" id="pdf_file" style="border-left:none!important;"> 
            <a href="#pdf-upfil" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-home"></i></span> 
            <span class="hidden-xs">Upload File</span> 
            </a> 
          </li> 
          <li id="pdf_library"> 
            <a href="#pdf-medlib" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Media Library</span> 
            </a> 
          </li>
          <li> 
            <a href="#pdfins" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Insert PDF URL</span> 
            </a> 
          </li>
        </ul> 

        <div class="tab-content tab-box" style="display: -webkit-box;">
          <div class="tab-pane active" id="pdf-upfil" style="width:100%;"> 
          <form id="pdfForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group form-border"> 
              <label class="col-sm-12 txt_cntr_algn no-padding field-title control-label">Upload File</label> 

              <div class="col-sm-12 no-padding txt_cntr_algn"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <input type="hidden" value="" name="..."> 

                  <span class="btn btn-info btn-file btn-border-blue"> 
                    <span class="fileinput-new">Select file</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="Documents/*" name="file_i" id="file_d"> 
                  </span> 

                  

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div>
                <div id="progress_pdf" class="progressBar txt_cntr_algn center_progress">
                          <div id="bar_pdf"></div>
                          <div id="percent_pdf">0%</div >
                  </div> 
              </div>

            </div>

            <div class="form-group form-border">
            <label class="control-label"></label> 

              <div class="col-sm-12 txt_cntr_algn no-padding"> 
                  <input type="hidden" value="" id="pdf_div_id" name="pdf_div_id">
                  <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">                  
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Document" class="form-control">
                <input type="submit" id="submitPDF" class="btn btn-success btn-blue" value="Upload"/>
              </div>

            </div>
          </form>
          </div> 

          <div class="tab-pane" id="pdf-medlib" style="width:100%;"> 
            <div class="col-sm-12" id="pdf_row_list" style="height: 175px;overflow: auto;">

              <!-- empty Div row for prepend column start-->
            <div class="row" id="pdf_list" style="padding: 0 0 10px 0;">
            </div>
            <!-- empty Div row for prepend column end-->
            
           <!--  ll<?php 
            $divcount =0;
            $counter = 0;
            if($loadPdf)
            {
            foreach ($loadPdf as $key => $pdfdata) 
            { 
              if($counter == 0)
              { 
            ?>
            <div class="row" style="padding: 0 0 10px 0;">
            <?php } ?>
            
              
              <div class="col-sm-3">              
              <div class="overlay-imf-pdf" alt="<?php echo $pdfdata->media_title;?>#_#<?php echo $pdfdata->id;?>"></div>             
              <img src="" width="125" height="100" alt="<?php echo $pdfdata->media_title;?>#_#<?php echo $pdfdata->id;?>">
              </div>
                  
              <?php
              $counter =1;
              if(($key+1) %4 == 0)
              {
                
              ?>                
              </div>
            <?php 
            $counter = 0;       
              }
              $divcount++;
            }
          }
          else
          {
            echo"Documents Not Available";
          }  

            ?>
            <?php 
            if($divcount % 4 != 0) 
            {
            ?>
              </div>
            <?php
               }
            ?>ll -->
            


              
            </div>

            <div class="col-sm-12 no-padding" style="display:block;">

              <form id="save_pdf_data" name="save_pdf_data" action="<?php echo base_url(); ?>admin/tasks/update_pdf_data" method="post" enctype="multipart/form-data">
              <div class="form-group form-border">
              <label class="col-sm-12 field-title control-label no-padding">Title</label> 
                <div class="col-sm-12 no-padding">      

                  <input type="hidden" name="pdf_id" id="pdf_id" class="form-height form-control">
                  <input type="hidden" name="title_pdf" id="title_pdf" class="form-height form-control">
                  <input type="text" name="alt_title_pdf" id="alt_title_pdf" class="form-height form-control">

                </div>
              </div>
              

              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="submit" class="btn btn-success btn-blue" value="Save"/>
                </div>

              </div>  
            </form>
            </div>


          </div> 

          <div class="tab-pane" id="pdfins" style="width:100%;"> 

            <div class="col-sm-12 no-padding" style="display:block;">

              <div class="form-group form-border">
              <label class="col-sm-12 filed-title control-label no-padding">Insert Image URL</label> 
                <div class="col-sm-12 no-padding"> 
                  <input type="text" id="txt_pdf_url" class="form-height form-control">
                </div>
              </div>


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="button" class="btn btn-success btn-blue" value="Save" onclick="addPdfUrl()"/>
                </div>

              </div>  

            </div>


          </div>

        </div> 

      </div>

    </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- ---------------------------------------------PDF-POP-UP-End----------------------------------------------- -->
<!-- ---------------------------------------------Code-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalCode" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">Code</h4>
        </div>
        <div class="modal-body">
          <div class="form-body" style="display: -webkit-box;padding-top:4%;"> 
            <div class="col-md-12"> 
              <div class="form-group">
               <input type="hidden" name="txtcode" id="txtcode" value="">
               <input type="hidden" name="tempvalforcode" id="tempvalforcode" value="">
          <label for="Paragraph" id="label">Enter Your Code:</label>
          <textarea class="form-control paragraphclass" rows="5" id="codearea"></textarea>
        </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer" style="border:none;">
         <button type="button" class="btn btn-blue" id="applyChanges" onclick="setCode()">Apply changes</button>
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Code-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------Save-Template-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="savetemplate" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="renew-top-close-btn close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">Save Template</h4>
        </div>
        <div class="modal-body">
          <div class="form-body" style="display: -webkit-box;padding-top:4%;"> 
            <div class="col-md-12"> 
            <p>You can save the Lecture Layout for later use here.</p>
              <div class="form-group">
               <input type="hidden" name="txtcode" id="txtcode" value="">
               <input type="hidden" name="tempvalforcode" id="tempvalforcode" value="">
          <label for="Paragraph" id="label">Layout Name :</label>
          <input type="text" id="txt_templates_name" class="form-height form-control">
        </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer" style="border:none;">
         <input type="button" class="btn btn-blue" value="Save Template" onclick="saveTemplates()">
         <!-- <input type="button" class="btn btn-default" value="Close Window"> -->
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Save-Template-End----------------------------------------------- -->


<!-- ---------------------------------------------Save-Template-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="loadtemplate" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">Load Template</h4>
        </div>
        <div class="modal-body">
          <div class="form-body" style="display: -webkit-box;padding-top:4%;"> 
            <div class="col-md-12"> 
              
            <ul class="lay-ul">
              <?php 
              if(!empty($templatelist))
              {
              foreach ($templatelist as $templatedetails) 
              {
              ?>

              <li class="lay-li" id="li_<?php echo $templatedetails->id; ?>">

                <b><?php echo $templatedetails->template_title; ?></b>

                

              </li>
              <span class="layout_buttons">
                  <a href="javascript:void(0)" class="btn btn-green" onclick="loadTemplates(<?php echo $templatedetails->id; ?>);">Load</a>
                  <a href="javascript:void(0)" class="btn btn-blue" onclick="deleteTemplates(<?php echo $templatedetails->id; ?>);">Delete</a>
                </span>
              <?php
              }
             }
              else
              {
                echo"No Templates Available";
              }
               ?>
              

              <!-- <li class="lay-li">

                <b>Second Template</b>

                <span class="layout_buttons">
                  <a href="#" class="btn btn-default">Load</a>
                  <a href="#" class="btn btn-danger">Delete</a>
                </span>

              </li>

              <li class="lay-li">

                <b>Third Template</b>

                <span class="layout_buttons">
                  <a href="#" class="btn btn-default">Load</a>
                  <a href="#" class="btn btn-danger">Delete</a>
                </span>

              </li>

              <li class="lay-li">

                <b>Forth Template</b>

                <span class="layout_buttons">
                  <a href="#" class="btn btn-default">Load</a>
                  <a href="#" class="btn btn-danger">Delete</a>
                </span>

              </li>

              <li class="lay-li">

                <b>Fifth Template</b>

                <span class="layout_buttons">
                  <a href="#" class="btn btn-default">Load</a>
                  <a href="#" class="btn btn-danger">Delete</a>
                </span>

              </li> -->

            </ul>

            </div>
          </div>
          
        </div>
        <div class="modal-footer">
        <input type="checkbox" value="1" id="overridechk" onclick="this.checked=true;" name="group1[]" style="float: left;" checked><label style="float: left;margin-left: 2%;padding-top: 3px;">Overwrite the content in the Container.</label>
        <br><br>
        <input type="checkbox" value="1" id="appendchk" onclick="this.checked=true;" name="group1[]" style="float: left;"><label style="float: left;margin-left: 2%;padding-top: 3px;">Append below the container content.</label>

         <!-- <input type="button" class="btn btn-success" value="Load"> -->
         <!-- <input type="button" class="btn btn-default" value="Close Window"> -->
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Save-Template-End----------------------------------------------- -->
<!-- ---------------------------------------------audio POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalaudio" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">audios</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    

      <div> 
        <ul class="nav nav-tabs bordered blue-border">
          <li class="active" id="audio_file" style="border-left:none!important;"> 
            <a href="#audio-upfil" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-home"></i></span> 
            <span class="hidden-xs">Upload File</span> 
            </a> 
          </li> 
          <li id="audio_library"> 
            <a href="#audio-medlib" data-toggle="tab"> 
            <span class="visible-xs"><i class="entypo-user"></i></span> 
            <span class="hidden-xs">Media Library</span> 
            </a> 
          </li>
          
          
        </ul> 

        <div class="tab-content tab-box" style="display: -webkit-box;">
          <div class="tab-pane active" id="audio-upfil" style="width:100%;"> 
          <form id="audioForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group form-border"> 
              <label class="col-sm-12 field-title txt_cntr_algn no-padding control-label">Upload File</label> 

              <div class="col-sm-12 txt_cntr_algn no-padding"> 
                <div class="fileinput fileinput-new" data-provides="fileinput" style="padding-left:0px;">
                  <input type="hidden" value="" name="..."> 

                  <span class="btn btn-info btn-file btn-border-blue"> 
                    <span class="fileinput-new">Select file</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="audio/*" name="file_i" id="file_a"> 
                  </span>

                   

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div> 
                <div id="progress_audio" class="progressBar txt_cntr_algn center_progress">
                          <div id="bar_audio"></div>
                          <div id="percent_audio">0%</div >
                  </div>
              </div>

            </div>
          
            <div class="form-group txt_cntr_algn">
            <label class="control-label"></label> 

              <div class="col-sm-12 no-padding"> 
                  <input type="hidden" value="" id="audio_div_id" name="audio_div_id">
                  <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-height form-control">                  
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-height form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Audio" class="form-height form-control">
                <input type="submit" id="submitaudio" class="btn btn-blue" value="Save"/>
              </div>

            </div>
           </form>
          </div> 
          <div class="tab-pane" id="audio-medlib" style="width:100%;"> 
            <div class="col-sm-12" id="audio_row_list" style="height: 175px;overflow: auto;">

              <!-- empty Div row for prepend column start-->
            <div class="row" id="audio_list" style="padding: 0 0 10px 0;">
            </div>
            <!-- empty Div row for prepend column end-->
            
            <!-- ll<?php
            $audiocount =0; 
            $counter = 0;
            if($loadAudio)
            {
            foreach ($loadAudio as $key => $audiodata) 
            { 
              if($counter == 0)
              { 
            ?>
            <div class="row" style="padding: 0 0 10px 0;">
            <?php } ?>
            
              
              <div class="col-sm-3"> 
              
              <img src="" width="125" height="100" alt="<?php echo $audiodata->media_title;?>#_#<?php echo $audiodata->id;?>">              
                
              </div>
                  
              <?php
              $counter =1;
              if(($key+1) %4 == 0)
              {
                
              ?>                
              </div>
            <?php 
            $counter = 0;       
              }
              $audiocount++;
            }
          }
          else
          {
            echo"Audios Not Available";
          }  
            ?>
            
            <?php 
            if($audiocount % 4 != 0) 
            {
            ?>
              </div>
            <?php
               }
            ?>ll -->
                          
              
            </div>

            <div class="col-sm-12 no-padding" style="display:block;">
            <form id="save_audio_data" name="save_audio_data" action="<?php echo base_url(); ?>admin/tasks/update_audio_data" method="post" enctype="multipart/form-data">
              <div class="form-group form-border">
              <label class="col-sm-12 field-title no-padding control-label">Title</label> 
                <div class="col-sm-12 no-padding">      

                  <input type="hidden" name="audio_id" id="audio_id" class="form-height form-control">
                  <input type="hidden" name="title_audio" id="title_audio" class="form-height form-control">
                  <input type="text" name="alt_title_audio" id="alt_title_audio" class="form-height form-control">

                </div>
              </div>            


              <div class="form-group form-border">
                <label class="control-label"></label> 

                <div class="col-sm-12 no-padding"> 
                  <input type="submit"  class="btn btn-blue" value="Save" />
                </div>

              </div>  
              </form>
            </div>


          </div> 

          

        </div> 

      </div>

    </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
<!-- ---------------------------------------------Audio-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------flash-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalflash" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">flash</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 


            <div> 
                <ul class="nav nav-tabs bordered blue-border">
                    <li class="active" id="flash_file" style="border-left:none!important;"> 
                        <a href="#flash-upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li id="flash_library"> 
                        <a href="#flash-medlib" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    <li> 
                        <a href="#flashins" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Insert flash URL</span> 
                        </a> 
                    </li>
                </ul> 

                <div class="tab-content tab-box" style="display: -webkit-box;">
                    <div class="tab-pane active" id="flash-upfil" style="width:100%;"> 
                    <form id="flashForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group form-border"> 
                            <label class="col-sm-12 txt_cntr_algn no-padding field-title control-label">Upload File</label> 

                            <div class="col-sm-12 txt_cntr_algn no-padding"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file btn-border-blue"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" name="file_i" id="file_f"> 
                                    </span> 

                                    

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                                <div id="progress_flash" class="progressBar txt_cntr_algn center_progress">
                                            <div id="bar_flash"></div>
                                            <div id="percent_flash">0%</div >
                                    </div>
                            </div>

                        </div>

                        <div class="form-group txt_cntr_algn ">
                        <label class="control-label"></label> 

                            <div class="col-sm-12 no-padding"> 
                                    <input type="hidden" value="" id="flash_div_id" name="flash_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-height form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-height form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Flash" class="form-height form-control">
                                <input type="submit" id="submitflash" class="btn btn-success btn-blue" value="Upload"/>
                            </div>

                        </div>
                    </form>
                    </div> 

                    <div class="tab-pane" id="flash-medlib" style="width:100%;"> 
                        <div class="col-sm-12" id="flash_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="flash_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                        
                        <!-- ll<?php 
                        $divcount =0;
                        $counter = 0;
                        if($loadflash)
                        {
                        foreach ($loadflash as $key => $flashdata) 
                        { 
                            if($counter == 0)
                            {   
                        ?>
                        <div class="row" style="padding: 0 0 10px 0;">
                        <?php } ?>
                        
                            
                            <div class="col-sm-3">                            
                            <div class="overlay-imf-pdf" alt="<?php echo $flashdata->media_title;?>#_#<?php echo $flashdata->id;?>"></div>
                            <img src="" width="125" height="100">
                            </div>
                                    
                            <?php
                            $counter =1;
                            if(($key+1) %4 == 0)
                            {
                                
                            ?>                              
                            </div>
                      <?php 
                      $counter = 0;             
                            }
                            $divcount++;
                        }
                    }
                    else
                    {
                        echo"Documents Not Available";
                    }  

                        ?>
                        <?php 
                        if($divcount % 4 != 0) 
                        {
                        ?>
                            </div>
                        <?php
                         }
                        ?>ll -->
                        


                            
                        </div>

                        <div class="col-sm-12 no-padding" style="display:block;">

                            <form id="save_flash_data" name="save_flash_data" action="<?php echo base_url(); ?>admin/tasks/update_flash_data" method="post" enctype="multipart/form-data">
                            <div class="form-group form-border">
                            <label class="col-sm-12 field-title no-padding control-label">Title</label> 
                                <div class="col-sm-12 no-padding">          

                                    <input type="hidden" name="flash_id" id="flash_id" class="form-height form-control">
                                    <input type="hidden" name="title_flash" id="title_flash" class="form-height form-control">
                                    <input type="text" name="alt_title_flash" id="alt_title_flash" class="form-height form-control">

                                </div>
                            </div>
                            

                            <div class="form-group form-border">
                                <label class="control-label"></label> 

                                <div class="col-sm-12 no-padding"> 
                                    <input type="submit" class="btn btn-success btn-blue" value="Save"/>
                                </div>

                            </div>  
                        </form>
                        </div>


                    </div> 

                    <div class="tab-pane" id="flashins" style="width:100%;"> 

                        <div class="col-sm-12 no-padding" style="display:block;">

                            <div class="form-group form-border">
                            <label class="col-sm-12 field-title control-label no-padding">Insert Image URL</label> 
                                <div class="col-sm-12 no-padding"> 
                                    <input type="text" id="txt_flash_url" class="form-height form-control">
                                </div>
                            </div>


                            <div class="form-group form-border">
                                <label class="control-label"></label> 

                                <div class="col-sm-12 no-padding"> 
                                    <input type="button" class="btn btn-success btn-blue" value="Save" onclick="addflashUrl()"/>
                                </div>

                            </div>  

                        </div>


                    </div>

                </div> 

            </div>

        </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>
  
<!-- ---------------------------------------------flash-POP-UP-End----------------------------------------------- -->

<!-- ---------------------------------------------gallery POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModalgallery" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header renew-top-head">
          <button type="button" class="close renew-top-close-btn" data-dismiss="modal">&times;</button>
          <h4 class="modal-title renew-head">gallery</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 
        

            <div> 
                <ul class="nav nav-tabs bordered blue-border">
                    <li class="active" id="gallery_file" style="border-left:none!important;"> 
                        <a href="#gallery-upfil" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-home"></i></span> 
                        <span class="hidden-xs">Upload File</span> 
                        </a> 
                    </li> 
                    <li> 
                        <a href="#gallery-medlib" id="gallery_library" data-toggle="tab"> 
                        <span class="visible-xs"><i class="entypo-user"></i></span> 
                        <span class="hidden-xs">Media Library</span> 
                        </a> 
                    </li>
                    
                    
                </ul> 

                <div class="tab-content tab-box" style="display: -webkit-box;">
                    <div class="tab-pane active" id="gallery-upfil" style="width:100%;"> 
                    <form id="galleryForm" action="<?php echo base_url(); ?>admin/tasks/multi_upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group form-border"> 
                            <label class="col-sm-12 txt_cntr_algn no-padding field-title control-label">Upload File</label> 

                            <div class="col-sm-12 txt_cntr_algn no-padding"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file btn-border-blue"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" accept="images/*" name="file_i[]" id="file_g" multiple=""> 
                                    </span>

                                     

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                                <div id="progress_gallery" class="progressBar txt_cntr_algn center_progress">
                                            <div id="bar_gallery"></div>
                                            <div id="percent_gallery">0%</div >
                                    </div>
                            </div>

                        </div>
                    
                        <div class="form-group txt_cntr_algn">
                        <label class="control-label"></label> 

                            <div class="col-sm-12 no-padding"> 
                                    <input type="hidden" value="" id="gallery_div_id" name="gallery_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-height form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-height form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Image" class="form-height form-control">
                                <input type="submit" id="submitgallery" class="btn btn-success btn-blue" value="Upload"/>
                            </div>

                        </div>
                     </form>
                    </div> 
                    <div class="tab-pane" id="gallery-medlib" style="width:100%;"> 
                        <div class="col-sm-12" id="gallery_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="gallery_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                                                
                            
                        </div>

                        <div class="col-sm-12" style="display:block;padding:0px;">
                        <form id="save_gallery_data" name="save_gallery_data" action="<?php echo base_url(); ?>admin/tasks/update_gallery_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-12 no-padding field-title control-label">Title</label> 
                                <div class="col-sm-12 no-padding">          

                                    <input type="hidden" name="gallery_id" id="gallery_id" class="form-height form-control">
                                    <input type="hidden" name="title_gallery" id="title_gallery" class="form-height form-control">
                                    <input type="text" name="alt_title_gallery" id="alt_title_gallery" class="form-height form-control">

                                </div>
                            </div>                      

                            <div class="form-group">
                                <!-- <label class="col-sm-1 control-label"><input type="checkbox" value="1" id="gridchk" onclick="this.checked=true;" name="gallerychk[]" ></label>  -->

                               <!--  <div class="col-sm-5"> 
                          Gird 
                                </div> -->

                            </div>
                            <div class="form-group form-border">
                            <div class="grey-background" style="display: -webkit-box;">
                                <label class="col-sm-1 control-label"><input type="checkbox" value="1" id="sliderchk" onclick="this.checked=true;" name="gallerychk[]" checked></label> 

                                <div class="col-sm-11"> 
                               Slider
                                </div>
                            </div>
                            </div>

                            <div class="form-group form-border">
                                <label class="control-label"></label> 

                                <div class="col-sm-12 no-padding"> 
                                    <input type="button" onclick="makeGallery();" class="btn btn-blue" value="Add Gallery" />
                                </div>

                            </div>  
                            </form>
                        </div>


                    </div> 

                    

                </div> 

            </div>

        </div>
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
    
  </div>

  <script src="<?php echo base_url()?>public/js/lectureseditor/lectureeditor_admin.js"></script>
<!-- ---------------------------------------------gallery-POP-UP-End----------------------------------------------- -->
<!-- ---------------------------------------------LecturePreview-POP-UP-START----------------------------------------------- -->

<div class="modal fade" id="myModalLectpreview" role="dialog">
    <div class="modal-dialog full-width">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><h3>Preview Mode</h3>
          <b>  This is how your lecture will be displayed to students</b>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    <div id="preview_container">
      
    </div>

    </div>
    
        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
</div>

<!-- ---------------------------------------------LecturePreview-POP-UP-End----------------------------------------------- -->

<script>
  
$("#myModalLectpreview").find(".close").click(function(){
  $("#sticky").css("display","block");
    $('#preview_container').html('');

});

$(document).ready(function(){
  $(document).find('.vjs-play-control, .vjs-big-play-button').on('click', function(){
   $("video.vjs-tech").each(function (videoIndex) {
    var videoId = $(this).attr('id');
    // console.log(videoId);

    videojs(videoId).ready(function(){
        this.on("play", function(e) {
            //pause other video
            $(".video-js").each(function (index) {
                if (videoIndex !== index) {
                    this.player.pause();
                }
            });
        });

    });
});
 });


});

 jQuery(document).ready(function(){

 $(".preview_container").find(".video-js").each(function () {
            var videoId = $(this).attr('id');  
            videojs(document.getElementById(videoId));      
       });
 
});

</script>

<?php exit(); ?>