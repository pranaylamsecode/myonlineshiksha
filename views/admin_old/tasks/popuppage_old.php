<link rel="stylesheet" type="text/css" href="/public/css/courses_css/lecture_preview.css">

<!-- ---------------------------------------------Paragraph-POP-UP-Start----------------------------------------------- -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Paragraph</h4>
        </div>
        <div class="modal-body">
          <div > 
            <div class="col-md-12"> 
              <div class="form-group">
               <input type="hidden" name="txtparagraph" id="txtparagraph" value="">
               <input type="hidden" name="tempval" id="tempval" value="">
          <label for="Paragraph" id="label">Enter Your Text:</label>
         <!--  <textarea class="form-control paragraphclass" rows="5" id="paragraph"></textarea> -->
        <textarea class="form-control paragraphclass" rows="5" id="paragraph"></textarea>
        </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="setText()">Apply changes</button>
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
        <div class="modal-header">
        
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Image</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    

      <div> 
        <ul class="nav nav-tabs bordered">
          <li class="active" id="image_file"> 
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

        <div class="tab-content">
          <div class="tab-pane active" id="upfil"> 
           <form id="myForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group"> 
              <label class="col-sm-3 control-label">Image Upload</label> 

              <div class="col-sm-5"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  
                  <input type="hidden"> 
                  
                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput"> 
                  <img src="http://placehold.it/200x150" alt="..." id="imgname" class="img-responsive profile-image"> 
                  <img id="blah" src="#" width="125px" height="130px" alt="your image" class="img-responsive profile-image">
                  </div> 
                  
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div> 

                  <div> 
                  <!-- <form id="myForm" action="<?php echo base_url(); ?>tasks/upload_image" method="post" enctype="multipart/form-data"> -->
                    <span class="btn btn-white btn-file"> 
                    <span class="fileinput-new">Select image</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="image/*" id="file_i" name="file_i" data-filename-placement="inside"> </span> 
                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a> 
                    <!-- <input type="button" id="remove_id" value="Remove" class="btn btn-red" /> -->
                    <span id="profineDiv"></span>
                  </div>                  
                   
                   
                  <br/>
                   
                  <div id="message"></div>

                  <!-- new code end here -->
                </div> 
                <div id="progress" class="progressBar">
                          <div id="bar"></div>
                          <div id="percent">0%</div >
                  </div>
              </div> 

            </div>
            
            <div class="form-group" style="padding-top:20px;">
            <label class="col-sm-3 control-label"></label> 

              <div class="col-sm-5"> 
                  <input type="hidden" value="" id="img_div_id" name="img_div_id">
                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Image" class="form-control">
                <input type="submit" id="submit" class="btn btn-success" value="Upload Image"/>
              </div>

            </div>
            </form>
          </div> 

          <div class="tab-pane" id="medlib"> 
            <div class="col-sm-12" id="row_list" style="height: 175px;overflow: auto;">
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

            <div class="col-sm-12" style="display:block;padding-top: 20px;">
            <form id="save_image_data" name="save_image_data" action="<?php echo base_url(); ?>admin/tasks/update_images_data" method="post" enctype="multipart/form-data">
              <div class="form-group">
              <label class="col-sm-3 control-label">Title</label> 
                <div class="col-sm-5"> 
                  <input type="hidden" name="image_id" id="image_id" class="form-control">
                  <input type="hidden" name="title_media" id="title_media" class="form-control">
                  <input type="text" name="alt_title_image" id="alt_title_image" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="submit" id="save_image" class="btn btn-success" value="Save" onclick=""/>
                </div>

              </div>  
              </form>
            </div>

          </div> 

          <div class="tab-pane" id="medins"> 

            <div class="col-sm-12" style="display:block;padding-top: 20px;">

              <div class="form-group">
              <label class="col-sm-3 control-label">Insert Image URL</label> 
                <div class="col-sm-5"> 
                  <input type="text" id="txt_image_url" name="txt_image_url" class="form-control">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="button" id="submit" class="btn btn-success" value="Save" onclick="addImageUrl()"/>
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Button</h4>
        </div>
        <div class="modal-body">
              <!-- new code -->       
        <div>             
            <div class="col-md-12"> 
                  <div class="form-group">
                
                <label class="col-sm-3 control-label">Title of Button</label>       
                 <div class="col-sm-9">
                  <input type="hidden" name="btn_div_id" id="btn_div_id" value="">  
                   <input type="hidden" name="courseg" id="courseg" value="<?php echo $this->uri->segment(3)=="edit"? $this->uri->segment(6): $this->uri->segment(5); ?>">        
                  <input type="text" name="title_button" id="title_button" class="form-control">
                </div>
               </div>

               <div class="form-group">
               <label class="col-sm-3 control-label">Description</label>  
               <div class="col-sm-9">
                <textarea id="msgforbtn" name="msgforbtn" style="width: 100%;"></textarea>
                </div>
               </div>

               <div class="form-group" style="padding-left: 123px;">        
                      
                <div class="checkbox">                
                  <label><input type="checkbox" onclick="this.checked=true; loadCourses(this.id)" id="self_course" name="group2[]" value="">Self Course</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" onclick="this.checked=true; loadCourses(this.id)" id="other_courses" name="group2[]" value="">Other Courses</label>
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
        <div class="modal-footer">
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Videos</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    

      <div> 
        <ul class="nav nav-tabs bordered">
          <li class="active" id="video_file"> 
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

        <div class="tab-content">
          <div class="tab-pane active" id="video-upfil"> 
          <form id="videoForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group"> 
              <label class="col-sm-3 control-label">Upload File</label> 

              <div class="col-sm-5"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <input type="hidden" value="" name="..."> 

                  <span class="btn btn-info btn-file"> 
                    <span class="fileinput-new">Select file</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="video/*" name="file_i" id="file_v"> 
                  </span>

                  

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div> 
                <div id="progress_video" class="progressBar">
                          <div id="bar_video"></div>
                          <div id="percent_video">0%</div >
                  </div> 
              </div>

            </div>
          
            <div class="form-group" style="padding-top:20px;">
            <label class="col-sm-3 control-label"></label> 

              <div class="col-sm-5"> 
                  <input type="hidden" value="" id="video_div_id" name="video_div_id">
                  <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">                  
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Video" class="form-control">
                <input type="submit" id="submitvideo" class="btn btn-success" value="Save"/>
              </div>

            </div>
           </form>
          </div> 
          <div class="tab-pane" id="video-medlib"> 
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

            <div class="col-sm-12" style="display:block;padding-top: 20px;">
            <form id="save_video_data" name="save_video_data" action="<?php echo base_url(); ?>admin/tasks/update_video_data" method="post" enctype="multipart/form-data">
              <div class="form-group">
              <label class="col-sm-3 control-label">Title</label> 
                <div class="col-sm-5">      

                  <input type="hidden" name="video_id" id="video_id" class="form-control">
                  <input type="hidden" name="title_video" id="title_video" class="form-control">
                  <input type="text" name="alt_title_video" id="alt_title_video" class="form-control">

                </div>
              </div>            


              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="submit"  class="btn btn-success" value="Save" />
                </div>

              </div>  
              </form>
            </div>


          </div> 

          <div class="tab-pane" id="videoins"> 

            <div class="col-sm-12" style="display:block;padding-top: 20px;">

              <div class="form-group">
              <label class="col-sm-3 control-label">Insert Videos URL</label> 
                <div class="col-sm-5"> 
                  <input type="text" class="form-control" id="txt_video_url">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="button" id="videourl" class="btn btn-success" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
                </div>

              </div>  

            </div>


          </div> 

          <div class="tab-pane" id="videoiframe"> 

            <div class="col-sm-12" style="display:block;padding-top: 20px;">

              <div class="form-group">
              <label class="col-sm-3 control-label">Insert Videos code</label> 
                <div class="col-sm-5"> 
                  <!-- <input type="text" class="form-control" id="txt_video_embed"> -->
                  <textarea class="form-control" id="txt_video_embed" rows="3"></textarea>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="button" id="videoembed" class="btn btn-success" value="Save" onclick="addVideoUrlNEmbed(this.id)"/>
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PDF</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 


      <div> 
        <ul class="nav nav-tabs bordered">
          <li class="active" id="pdf_file"> 
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

        <div class="tab-content">
          <div class="tab-pane active" id="pdf-upfil"> 
          <form id="pdfForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group"> 
              <label class="col-sm-3 control-label">Upload File</label> 

              <div class="col-sm-5"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <input type="hidden" value="" name="..."> 

                  <span class="btn btn-info btn-file"> 
                    <span class="fileinput-new">Select file</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="Documents/*" name="file_i" id="file_d"> 
                  </span> 

                  

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div>
                <div id="progress_pdf" class="progressBar">
                          <div id="bar_pdf"></div>
                          <div id="percent_pdf">0%</div >
                  </div> 
              </div>

            </div>

            <div class="form-group" style="padding-top:20px;">
            <label class="col-sm-3 control-label"></label> 

              <div class="col-sm-5"> 
                  <input type="hidden" value="" id="pdf_div_id" name="pdf_div_id">
                  <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">                  
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Document" class="form-control">
                <input type="submit" id="submitPDF" class="btn btn-success" value="Upload"/>
              </div>

            </div>
          </form>
          </div> 

          <div class="tab-pane" id="pdf-medlib"> 
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

            <div class="col-sm-12" style="display:block;padding-top: 20px;">

              <form id="save_pdf_data" name="save_pdf_data" action="<?php echo base_url(); ?>admin/tasks/update_pdf_data" method="post" enctype="multipart/form-data">
              <div class="form-group">
              <label class="col-sm-3 control-label">Title</label> 
                <div class="col-sm-5">      

                  <input type="hidden" name="pdf_id" id="pdf_id" class="form-control">
                  <input type="hidden" name="title_pdf" id="title_pdf" class="form-control">
                  <input type="text" name="alt_title_pdf" id="alt_title_pdf" class="form-control">

                </div>
              </div>
              

              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="submit" class="btn btn-success" value="Save"/>
                </div>

              </div>  
            </form>
            </div>


          </div> 

          <div class="tab-pane" id="pdfins"> 

            <div class="col-sm-12" style="display:block;padding-top: 20px;">

              <div class="form-group">
              <label class="col-sm-3 control-label">Insert Image URL</label> 
                <div class="col-sm-5"> 
                  <input type="text" id="txt_pdf_url" class="form-control">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="button" class="btn btn-success" value="Save" onclick="addPdfUrl()"/>
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Code</h4>
        </div>
        <div class="modal-body">
          <div > 
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
        <div class="modal-footer">
         <button type="button" class="btn btn-success" id="applyChanges" onclick="setCode()">Apply changes</button>
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Save Template</h4>
          <p>You can save the Lecture Layout for later use here.</p>
        </div>
        <div class="modal-body">
          <div > 
            <div class="col-md-12"> 
              <div class="form-group">
               <input type="hidden" name="txtcode" id="txtcode" value="">
               <input type="hidden" name="tempvalforcode" id="tempvalforcode" value="">
          <label for="Paragraph" id="label">Layout Name :</label>
          <input type="text" id="txt_templates_name" class="form-control">
        </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
         <input type="button" class="btn btn-success" value="Save Template" onclick="saveTemplates()">
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Load Template</h4>
        </div>
        <div class="modal-body">
          <div > 
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

                <span class="layout_buttons">
                  <a href="javascript:void(0)" class="btn btn-default" onclick="loadTemplates(<?php echo $templatedetails->id; ?>);">Load</a>
                  <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteTemplates(<?php echo $templatedetails->id; ?>);">Delete</a>
                </span>

              </li>

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
        <input type="checkbox" value="1" id="overridechk" onclick="this.checked=true;" name="group1[]" style="float: left;" checked><label style="float: left;">Overwrite the content in the Container.</label>
        <br><br>
        <input type="checkbox" value="1" id="appendchk" onclick="this.checked=true;" name="group1[]" style="float: left;"><label style="float: left;">Append below the container content.</label>

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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">audios</h4>
        </div>
    <div class="panel-body" style="padding-top: 20px;"> 
    

      <div> 
        <ul class="nav nav-tabs bordered">
          <li class="active" id="audio_file"> 
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

        <div class="tab-content">
          <div class="tab-pane active" id="audio-upfil"> 
          <form id="audioForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
            <div class="form-group"> 
              <label class="col-sm-3 control-label">Upload File</label> 

              <div class="col-sm-5"> 
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <input type="hidden" value="" name="..."> 

                  <span class="btn btn-info btn-file"> 
                    <span class="fileinput-new">Select file</span> 
                    <span class="fileinput-exists">Change</span> 
                    <input type="file" accept="audio/*" name="file_i" id="file_a"> 
                  </span>

                   

                  <span class="fileinput-filename"></span> 
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                </div> 
                <div id="progress_audio" class="progressBar">
                          <div id="bar_audio"></div>
                          <div id="percent_audio">0%</div >
                  </div>
              </div>

            </div>
          
            <div class="form-group" style="padding-top:20px;">
            <label class="col-sm-3 control-label"></label> 

              <div class="col-sm-5"> 
                  <input type="hidden" value="" id="audio_div_id" name="audio_div_id">
                  <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">                  
                  <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  <input type="hidden" name="media_type" id="media_type" value="Audio" class="form-control">
                <input type="submit" id="submitaudio" class="btn btn-success" value="Save"/>
              </div>

            </div>
           </form>
          </div> 
          <div class="tab-pane" id="audio-medlib"> 
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

            <div class="col-sm-12" style="display:block;padding-top: 20px;">
            <form id="save_audio_data" name="save_audio_data" action="<?php echo base_url(); ?>admin/tasks/update_audio_data" method="post" enctype="multipart/form-data">
              <div class="form-group">
              <label class="col-sm-3 control-label">Title</label> 
                <div class="col-sm-5">      

                  <input type="hidden" name="audio_id" id="audio_id" class="form-control">
                  <input type="hidden" name="title_audio" id="title_audio" class="form-control">
                  <input type="text" name="alt_title_audio" id="alt_title_audio" class="form-control">

                </div>
              </div>            


              <div class="form-group">
                <label class="col-sm-3 control-label"></label> 

                <div class="col-sm-5"> 
                  <input type="submit"  class="btn btn-success" value="Save" />
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">flash</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 


            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="flash_file"> 
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

                <div class="tab-content">
                    <div class="tab-pane active" id="flash-upfil"> 
                    <form id="flashForm" action="<?php echo base_url(); ?>admin/tasks/upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label">Upload File</label> 

                            <div class="col-sm-5"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" name="file_i" id="file_f"> 
                                    </span> 

                                    

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                                <div id="progress_flash" class="progressBar">
                                            <div id="bar_flash"></div>
                                            <div id="percent_flash">0%</div >
                                    </div>
                            </div>

                        </div>

                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="flash_div_id" name="flash_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Flash" class="form-control">
                                <input type="submit" id="submitflash" class="btn btn-success" value="Upload"/>
                            </div>

                        </div>
                    </form>
                    </div> 

                    <div class="tab-pane" id="flash-medlib"> 
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

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <form id="save_flash_data" name="save_flash_data" action="<?php echo base_url(); ?>admin/tasks/update_flash_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5">          

                                    <input type="hidden" name="flash_id" id="flash_id" class="form-control">
                                    <input type="hidden" name="title_flash" id="title_flash" class="form-control">
                                    <input type="text" name="alt_title_flash" id="alt_title_flash" class="form-control">

                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="submit" class="btn btn-success" value="Save"/>
                                </div>

                            </div>  
                        </form>
                        </div>


                    </div> 

                    <div class="tab-pane" id="flashins"> 

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">

                            <div class="form-group">
                            <label class="col-sm-3 control-label">Insert Image URL</label> 
                                <div class="col-sm-5"> 
                                    <input type="text" id="txt_flash_url" class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" class="btn btn-success" value="Save" onclick="addflashUrl()"/>
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
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">gallery</h4>
        </div>
        <div class="panel-body" style="padding-top: 20px;"> 
        

            <div> 
                <ul class="nav nav-tabs bordered">
                    <li class="active" id="gallery_file"> 
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

                <div class="tab-content">
                    <div class="tab-pane active" id="gallery-upfil"> 
                    <form id="galleryForm" action="<?php echo base_url(); ?>admin/tasks/multi_upload_media" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label class="col-sm-3 control-label">Upload File</label> 

                            <div class="col-sm-5"> 
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <input type="hidden" value="" name="..."> 

                                    <span class="btn btn-info btn-file"> 
                                        <span class="fileinput-new">Select file</span> 
                                        <span class="fileinput-exists">Change</span> 
                                        <input type="file" accept="images/*" name="file_i[]" id="file_g" multiple=""> 
                                    </span>

                                     

                                    <span class="fileinput-filename"></span> 
                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a> 
                                </div> 
                                <div id="progress_gallery" class="progressBar">
                                            <div id="bar_gallery"></div>
                                            <div id="percent_gallery">0%</div >
                                    </div>
                            </div>

                        </div>
                    
                        <div class="form-group" style="padding-top:20px;">
                        <label class="col-sm-3 control-label"></label> 

                            <div class="col-sm-5"> 
                                    <input type="hidden" value="" id="gallery_div_id" name="gallery_div_id">
                                    <input type="hidden" name="section_id" id="section_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">                                  
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                                    <input type="hidden" name="media_type" id="media_type" value="Image" class="form-control">
                                <input type="submit" id="submitgallery" class="btn btn-success" value="Upload"/>
                            </div>

                        </div>
                     </form>
                    </div> 
                    <div class="tab-pane" id="gallery-medlib"> 
                        <div class="col-sm-12" id="gallery_row_list" style="height: 175px;overflow: auto;">

                            <!-- empty Div row for prepend column start-->
                        <div class="row" id="gallery_list" style="padding: 0 0 10px 0;">
                        </div>
                        <!-- empty Div row for prepend column end-->
                                                
                            
                        </div>

                        <div class="col-sm-12" style="display:block;padding-top: 20px;">
                        <form id="save_gallery_data" name="save_gallery_data" action="<?php echo base_url(); ?>admin/tasks/update_gallery_data" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label> 
                                <div class="col-sm-5">          

                                    <input type="hidden" name="gallery_id" id="gallery_id" class="form-control">
                                    <input type="hidden" name="title_gallery" id="title_gallery" class="form-control">
                                    <input type="text" name="alt_title_gallery" id="alt_title_gallery" class="form-control">

                                </div>
                            </div>                      

                            <div class="form-group">
                                <!-- <label class="col-sm-1 control-label"><input type="checkbox" value="1" id="gridchk" onclick="this.checked=true;" name="gallerychk[]" ></label>  -->

                               <!--  <div class="col-sm-5"> 
                          Gird 
                                </div> -->

                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label"><input type="checkbox" value="1" id="sliderchk" onclick="this.checked=true;" name="gallerychk[]" checked></label> 

                                <div class="col-sm-5"> 
                               Slider
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label> 

                                <div class="col-sm-5"> 
                                    <input type="button" onclick="makeGallery();" class="btn btn-success" value="Add Gallery" />
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
