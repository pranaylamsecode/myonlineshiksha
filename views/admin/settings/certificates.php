<style>
.qq-upload-button {
  background: none repeat scroll 0 0 #ECE9D8;
  border: 1px solid silver;
  color: #000000;
  display: block;
  padding: 3px 0;
  text-align: center;
  width: 105px;
}
.tab-content>.tab-pane {
    margin-top: 20px;
}
</style>
<?php

$attributes = array('class' => 'tform', 'id' => 'cform');

echo ($updType == 'save') ? form_open_multipart(base_url().'admin/certificates/certificates', $attributes) : form_open_multipart(base_url().'admin/certificates/certificates');
//print_r($result);

?>
  <dl class="tabs"> <dt class="selected certificate-design open">Design</dt>
    <dd class="selected">
      <fieldset class="adminform">
        <!--  <legend>Design</legend>     -->
        <table">
          <tbody>
            <tr>
              <td>
                <input type="submit" value="Preview Certificate" name="previewcertificate" id="previewcertificate" onclick="windowopen();" class="mlms_buynow"> </td>
            </tr>
          </tbody>
        </table>
        <table class="adminformCertificate">
          <tbody>
            <tr>
              <td style="padding-left:6px;">
                <br> <b>Pick a premade theme</b> </td>
            </tr>
            <tr style="margin-bottom:25px">
              <td colspan="8">
                <table>
                  <tbody>
                    <tr>
                      <?php
                  $count = 0;
                  foreach($ftpimage as $images){
                    if( ($count % 4) == 0 ) {
                      echo '</tr><tr>';

                   }
                  //if($count % 2 == 0) echo '<tr>';
                  ?>
                        <td> <img onClick="javascript:ChangeLayoutC('<?php echo $images->filename; ?>');" src="<?php echo base_url().''.$images->filepath.''.$images->filename;?>" width="150" id="imgname"> </td>
                        <?php $count++;
                   //if($count % 4 == 0) echo '</tr>';
                   } ?>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <br><!-- divider -->
            <tr style="margin-bottom:25px">
              <td colspan="6">
                <hr style="color:#D5D5D5; background-color:#F7F7F7; height:2px; border: none;"> </td>
            </tr>
            <tr>
              <td style="padding-left:6px;">
                <br> <b>Customize your own</b> </td>
            </tr>
            <tr>
              <td colspan="5" style="padding:6px;"> See your changes instantly; they're not saved until you click Save &amp; Close or Save
                <br> Note: Make sure that the title of uploaded images doesn't have spaces. </td>
            </tr>
            <br><!-- divider -->
            <tr style="margin-bottom:25px">
              <td style="padding-left:6px;"> Active background </td>
              <td>
                <div id="background_image">
                  <div id="localimage_i"> <img src="<?php echo base_url();?>public/uploads/settings/img/thumbs/<?php echo $design_background ?>" width="150" id="imgname"> </div>
                </div>
              </td>
              <td colspan="5" style="padding-right:30px;">
                <input type="button" id="deletebtn" onclick="deleteImage();" value="Delete this background" style="background-color:#EDE5D6; height: 30px; width:200px;">
                <input type="hidden" value="" id="image" name="image">&nbsp;
                <!-- tooltip area --><span class="tooltipcontainer">

            <span type="text" id="customize_own-target" class="tooltipicon"></span> <span class="customize_own-target  tooltargetdiv" style="display: none;">

            <span class="closetooltip"></span>
                <!--tip containt-->
                <?php echo lang('certificates_fld_customize-your-own');?>
                  <!--/tip containt-->
                  </span>
                  </span>
                  <!-- tooltip area finish -->
              </td>
            </tr>
            <br><!-- divider -->
            <tr style="margin-bottom:25px">
              <td style="padding-left:6px;"> Upload your own background </td>
              <td>
                <div id="fileUploader">
                  <div class="qq-uploader">
                    <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                    <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;"> Choose file
                      <input type="file" name="file_i" id="file_i" class="upload_btn"> </div>
                    <input type="hidden" value="" name="imagename" id="imagename">
                    <ul class="qq-upload-list"></ul>
                  </div>
                </div>
              </td>
            </tr>
            <br><!-- divider -->
            <tr style="margin-bottom:25px">
              <td colspan="5"> <span style="padding-left:140px; color:#CC0000">Background size should be 800x600 px</span> </td>
            </tr>
            <tr>
              <td style="padding-left:6px;"> Background color </td>
              <td>
                <div style="float:left;"> <a style="border-radius: 4px 4px 4px 4px;



    float: left; height: 30px; margin-right: 10px; width: 110px; background-color:#ACE0F6" id="pick_zdonecolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_zdonecolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a>
                  <input type="text" onkeyup="if (this.value.length == 6) {relateColor('pick_zdonecolor', this.value); changeBcolor();}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_zdonecolor', this.value);}" value="<?php echo $design_background_color; ?>" id="pick_zdonecolorfield" name="st_donecolor1" size="7">
                  <script language="javascript">
                  relateColor('pick_xdonecolor', getObj('pick_zdonecolorfield').value);
                  </script> <span id="show_hide_box"></span> </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:6px;"> Text Color </td>
              <td>
                <div style="float:left;"> <a style="border-radius: 4px 4px 4px 4px; float: left; height: 30px; margin-right: 10px; width: 110px; background: none repeat scroll 0% 0% rgb(51, 51, 51); color: rgb(51, 51, 51);" id="pick_ydonecolor" onclick="document.getElementById('show_hide_box').style.display='none';" href="javascript:pickColor('pick_ydonecolor');">



                        &nbsp;&nbsp;&nbsp;



                        </a>
                  <input type="text" onkeyup="if (this.value.length == 6) {relateColor('pick_ydonecolor', this.value); changeBcolor();}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_ydonecolor', this.value);}" value="<?php echo $design_text_color; ?>" id="pick_ydonecolorfield" name="st_donecolor2" size="7">
                  <script language="javascript">
                  relateColor('pick_ydonecolor', getObj('pick_ydonecolorfield').value);
                  </script> <span id="show_hide_box"></span> </div>
              </td>
            </tr>
            <tr>
              <td style="padding-left:6px;"> Font </td>
              <td>
                <select id="font" name="font">
                  <option style="font-family : Arial" value="Arial" <?php echo ( $font_certificate=='Arial' )? 'selected="selected"' : ''?>>Arial</option>
                  <option style="font-family : Courier" value="Courier" <?php echo ( $font_certificate=='Courier' )? 'selected="selected"' : ''?>>Courier</option>
                  <option style="font-family : Tahoma" value="Tahoma" <?php echo ( $font_certificate=='Tahoma' )? 'selected="selected"' : ''?>>Tahoma</option>
                  <option style="font-family : 'Times New Roman'" value="Times New Roman" <?php echo ( $font_certificate=='Times New Roman' )? 'selected="selected"' : ''?>>Times New Roman</option>
                  <option style="font-family : Verdana" value="Verdana" <?php echo ( $font_certificate=='Verdana' )? 'selected="selected"' : ''?>>Verdana</option>
                  <option style="font-family : Georgia" value="Georgia" <?php echo ( $font_certificate=='Georgia' )? 'selected="selected"' : ''?>>Georgia</option>
                  <option style="font-family : Palatino Linotype" value="Palatino Linotype" <?php echo ( $font_certificate=='Palatino Linotype' )? 'selected="selected"' : ''?>>Palatino Linotype</option>
                  <option style="font-family : Arial Black" value="Arial Black" <?php echo ($font_certificate=='Arial Black' )? 'selected="selected"' : ''?>>Arial Black</option>
                  <option style="font-family : Comic Sans MS" value="Comic Sans MS" <?php echo ( $font_certificate=='Comic Sans MS' )? 'selected="selected"' : ''?>>Comic Sans MS</option>
                  <option style="font-family : Lucida Console" value="Lucida Console" <?php echo ( $font_certificate=='Lucida Console' )? 'selected="selected"' : ''?>>Lucida Console</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" value="submit" name="submit" style="border: 1px solid black;">
                <!--<input type="button" value="Save" name="button" onclick="document.adminForm.task.value='save'; submitform();" style="border: 1px solid black;"> -->
              </td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </dd>
    <br><!-- divider -->
    <dt class="certificate-templates closed" style="margin-bottom:25px">Templates</dt>
    <dd class="">
      <!--<dt class="certificate-design open" style="cursor: pointer;">-->
      <!-- <dt class="certificate-templates closed" style="cursor: pointer;"><span>Templates</span></dt>



     </dl><div class="current"><dd style="display: block;">-->
      <fieldset class="adminform">
        <legend>Templates</legend>
        <table>
          <tbody>
            <tr>
              <td style="padding:5px;"><b>Available Variables:</b></td>
            </tr>
            <tr>
              <td style="padding:5px;"> Use any of the variables bellow to construct your certificate. Your students will be able to download a PDF file with the certificate and print it. You can also add any images (logo, etc.) to this certificate.</td>
            </tr>
            <tr>
              <td width="100%" valign="top" colspan="2">
                <table class="certbox">
                  <tbody>
                    <tr>
                      <td>First name</td>
                      <td>[STUDENT_FIRST_NAME]</td>
                      <td style="padding-left:20px;">Certificate ID</td>
                      <td>[CERTIFICATE_ID]</td>
                      <td>Certificate URL</td>
                      <td>[CERTIFICATE_URL]</td>
                    </tr>
                    <tr>
                      <td>Last name</td>
                      <td>[STUDENT_LAST_NAME]</td>
                      <td style="padding-left:20px;">Course name</td>
                      <td>[COURSE_NAME]</td>
                      <td>My Certificate Message</td>
                      <td>[CERT_MESSAGE]</td>
                    </tr>
                    <tr>
                      <td>Site URL</td>
                      <td>[SITEURL]</td>
                      <td style="padding-left:20px;">Completion Date</td>
                      <td>[COMPLETION_DATE]</td>
                      <td style="padding-left:5px;">Certificate course message</td>
                      <td>[COURSE_MSG]</td>
                    </tr>
                    <tr>
                      <td>Site name</td>
                      <td>[SITENAME]</td>
                      <td style="padding-left:20px;">Author</td>
                      <td>[AUTHOR_NAME]</td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
        <br>
        <div style=" background-color:#F7F7F7; height:25px; padding-left:7px;"><b>Certificate</b></div>
        <table>
          <tbody>
            <tr>
              <td>This is the template for the actual certificate. Your students can view the certificate online or download is as PDF</td>
            </tr>
            <tr> </tr>
            <tr> </tr>
          </tbody>
        </table>
        <br>
        <div style=" background-color:#F7F7F7; height:25px; padding-left:7px;"><b>Certificate Page</b></div>
        <table>
          <tbody>
            <tr>
              <td>This is the template for the page that contains the certificate. Your students will link to this page using the URL they can find on My Certificates</td>
            </tr>
            <tr> </tr>
            <tr> </tr>
          </tbody>
        </table>
        <br>
        <div style=" background-color:#F7F7F7; height:25px; padding-left:7px;"><b>Email Template</b></div>
        <br>
        <table>
          <tbody>
            <tr>
              <td colspan="2">This is the template for the email your students will send out to let others know about their certificate</td>
            </tr>
            <tr>
              <td width="73px;">Email Subject</td>
              <td>
                <input type="text" value="Certificate for [STUDENT_FIRST_NAME] [STUDENT_LAST_NAME] from [SITENAME]" name="subjectt3" id="subjectt3" size="100">
              </td>
            </tr>
            <tr> </tr>
          </tbody>
        </table>
        </span>
        <div class="toggle-editor">
          <div class="button2-left">
            <div class="blank"><a title="Toggle editor" onclick="tinyMCE.execCommand('mceToggleEditor', false, 'email_template');return false;" href="#">Toggle editor</a></div>
          </div>
        </div>
        <br>
        <div style=" background-color:#F7F7F7; height:25px; padding-left:7px;"><b>Email My Certificate</b></div>
        <br>
        <table>
          <tbody>
            <tr>
              <td colspan="2">This is the template for the email your students will send out to others with their certificate details</td>
            </tr>
            <tr>
              <td width="73px;">Email Subject</td>
              <td>
                <input type="text" value="Certificate for [STUDENT_FIRST_NAME] [STUDENT_LAST_NAME] from [SITENAME]" name="subjectt4" id="subjectt4" size="100">
              </td>
            </tr>
            <tr> </tr>
          </tbody>
        </table>
      </fieldset>
    </dd>
  </dl>
  </form>
  <script type="text/javascript" src="<?php echo base_url(); ?>public/js/colorpicker.js"></script>
  <script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
  <script type="text/javascript">
  $(function() {
    $('#file_i').live('change', function(e) {
      var ftpfilearray;
      e.preventDefault();
      $.ajaxFileUpload({
        url: '<?php echo base_url(); ?>admin/certificates/upload_image/',
        secureuri: false,
        fileElementId: 'file_i',
        dataType: 'json',
        data: {
          'type': $('select#type').val()
        },
        success: function(data, status) {
          alert(data);
          if(data.status != 'error') {
            $('#msgstatus_i').html('<p>Reloading files...</p>');
            $('#file_i').val('');
            $('#msgstatus_i').html('');
            ftpfileoptions = '<img src="<?php echo base_url(); ?>public/uploads/settings/img/thumbs/' + data.ftpfilearray + '" width="150">';
            alert(ftpfileoptions);
            $('#localimage_i').html(ftpfileoptions);
            ftpfilearray = data.ftpfilearray;
            document.getElementById("imagename").value = ftpfilearray;
          }
        }
      });
      return false;
    });
  });
  $(function() {
    $('dl.tabs dt').click(function() {
      $(this).siblings().removeClass('selected').end().next('dd').andSelf().addClass('selected');
    });
  });

  function ChangeLayoutC(file) {
    var img12 = document.getElementById("localimage_i").innerHTML = "<img id='imgname' width='150' src='<?php echo base_url()."
    public / uploads / settings / img / thumbs / ";?>" + file + "' alt=''/>";
    // document.forms['cform'].image.value = "public/uploads/settings/img/thumbs/"+file;
    document.forms['cform'].imagename.value = file;
  }
  </script>