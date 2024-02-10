
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css">
<style>
  .tab-content .mce-tinymce .mce-btn  button{

    border: 1px solid transparent !important;
    border-radius: 0!important;
    line-height: 1.5em !important;
    transition: box-shadow .25s ease,transform .25s ease;
    background: transparent!important;
    color: #000 !important;
    font-size: 15px !important;
    padding: 8px 12px !important;
    display: inline-block;

  }
 .tab-content .mce-btn i {
  
    font-size: 16px!important;
}
</style>
<div class="main-container">
<?php

$attributes = array('class' => 'tform', 'id' => 'cform');

echo ($updType == 'save') ? form_open_multipart(base_url().'admin/certificates/', $attributes) : form_open_multipart(base_url().'admin/certificates/');

?>


<div id="toolbar-box">



	<div class="m">



	<!-- 	<div id="toolbar" class="toolbar-list">

		</div> -->

		<div class="pagetitle icon-48-generic"><h2 class="tab_heading"><?php echo 'Certificate Design Settings';?></h2></div>

	</div>

</div>

<div class="field_container">
<div class=""> 
<div class="" style="width: 100%;">
    
    <div class="panel primary-border panel-primary" data-collapsed="0">
		
			
			<div class="panel-body form-body main-table">
				
                <form role="form" class="form-horizontal form-groups-bordered">
                <dd class="selected">



          <fieldset class="adminform">

            <table>

            	<tbody>

                    <tr>

                		<td>


                		</td>

           	         </tr>

                </tbody>

            </table>

    		<table class="adminformCertificate homepage-table">

                <tbody>

                    <tr>

            	        <td style="padding-left:6px; position: relative;">

                        <br>

            	    	<label class="col-sm-12 field-title no-padding">Pick a premade theme</label>

					

						</span>

						</span>


                        </td>

                    </tr>



                    <tr>

                    	<td colspan="8">

                            <table>

                                 <tbody>

                                 <tr>

                                  <?php

                                  $count = 0;
// $ftpfiles = directory_map($path,1, false);
                                  $path ="public/uploads/certificates/";
$ftpimage = preg_grep('/^([^.])/', scandir($path, 1));
 // print_r($ftpfiles); exit('ftp');
                                  foreach($ftpimage as $images){

                                    if( ($count % 4) == 0 ) {

                                      echo '</tr><tr>';
									  
                                   }
                                  ?>


                                    <td>
                                   
                                    <img onClick="javascript:ChangeLayoutC('<?php echo $images; ?>');" src="<?php echo base_url($path.''.$images);?>" width="150" id="imgname">
                                    </td>


                                    <?php $count++;

                                   } ?>



                                 </tr>

                                 </tbody>

                            </table>

                        </td>

                  </tr>


                  <tr>

                       <td colspan="6">

                        <div class=""></div>

                       </td>

            	  </tr>

                 <tr>
                 
                     <td>

                     <br>

                     <label class="col-sm-12 field-title  no-padding">Customize your own</label>


              		</td>

                </tr>

                <tr class="br-botom">

                    <td colspan="5">

                 	<p class="pcertificate">See your changes instantly; they're not saved until you click Save &amp; Close or Save</p>
                    <p class="pcertificate">Note: Make sure that the title of uploaded images doesn't have spaces.</p>

                    </td>
                    
               </tr>
               
                <tr >

                   <td>

                   <label class="col-sm-12 field-title no-padding">Active background</label>

                   </td>
                 </tr>
                 <tr class="br-botom">
                   <td>


                   <div id="background_image">

                      <div id="localimage_i">
                      	<div class="col-sm-7 img-grey-border">
                         

                    <input type="hidden" id="certibg" name ="certibg" value="<?php echo $design_background ?>">
						  <img src="<?php echo base_url().''.$path.''.$design_background ?>" width="150" id="imgname">
                      </div>
                     
                       </div>

                   </div>

                   </td>



                   <td class="col-sm-5">

        	   		  

                        <input type="hidden" value="<?php echo $design_background ?>" id="image" name="image">&nbsp;
        

                   </td>

               </tr>
               
               <tr>

                   <td>
                   	<label class="col-sm-12 field-title no-padding">Upload your own background</label>
                   

                   </td>
                   </tr>
                   <tr>
                   <td>

                      <div id="fileUploader">

                      <div class="qq-uploader"><div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>

                      <div class="qq-upload-button col-sm-4" style="text-align: center;position: relative; overflow: hidden; direction: ltr;">

                Choose file

                <input type="file" name="file_i" id="file_i" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">

                       </div>
                    <div class="delete_background_cert">
                        <input type="button" id="deletebtn" onclick="javascript:deleteImage();" value="Delete this background" class="img-align " style="top: 0;right: 0%;">
                    </div>
                    <input type="hidden" value="<?php echo $design_background ?>" name="imagename" id="imagename">

                    <ul class="qq-upload-list"></ul>

                    </div>

                    </div>

                 </td>

           </tr>

           
           <tr class="br-botom">

             	<td colspan="5">

              	    <span style="color:#CC0000">Background size should be 800x600 pixels</span>

                </td>

          </tr>

            



           </tbody></table>

	</fieldset>


     </dd>
               
     
                    
					<div class="form-group form-border">
						<label for="field-ta" class="col-sm-4 field-title control-label no-padding">Text Color</label>
						
						<div class="col-sm-6">
							<div style="float:left;">

                     

                    <input type="text" class="form-control form-height color" onkeyup="if (this.value.length == 6) {relateColor('pick_ydonecolor', this.value); changeBcolor();}" maxlength="6" onchange="if (this.value.length == 6) {relateColor('pick_ydonecolor', this.value);}" value="<?php echo $design_text_color; ?>" id="pick_ydonecolorfield" name="st_donecolor2" size="7">

					

                   </div>


                    <script language="javascript">relateColor('pick_ydonecolor', getObj('pick_ydonecolorfield').value);</script>

                    <span id="show_hide_box"></span>
		
						</div>
					</div>
								
					
					
					<div class="form-group form-border ">
						<label class="col-sm-4 field-title control-label no-padding">Font</label>
						
						<div class="col-sm-6">
							
                            <select id="font" name="font" class="form-control form-height">

                <option value="courier" <?php echo ($font_certificate == 'courier') ? 'selected="selected"' : ''?>>Courier </option>
                <option value="courierB" <?php echo ($font_certificate == 'courierB') ? 'selected="selected"' : ''?>>Courier Bold </option>
                <option value="courierBI" <?php echo ($font_certificate == 'courierBI') ? 'selected="selected"' : ''?>>Courier Bold Italic </option>
                <option value="courierI" <?php echo ($font_certificate == 'courierI') ? 'selected="selected"' : ''?>>Courier Italic </option>
                <option value="helvetica" <?php echo ($font_certificate == 'helvetica') ? 'selected="selected"' : ''?>>Helvetica </option>
                <option value="helveticaB" <?php echo ($font_certificate == 'helveticaB') ? 'selected="selected"' : ''?>>Helvetica Bold </option>
                <option value="helveticaBI" <?php echo ($font_certificate == 'helveticaBI') ? 'selected="selected"' : ''?>>Helvetica Bold Italic </option>
                <option value="helveticaI" <?php echo ($font_certificate == 'helveticaI') ? 'selected="selected"' : ''?>>Helvetica Italic </option>
                <option value="symbol" <?php echo ($font_certificate == 'symbol') ? 'selected="selected"' : ''?>>Symbol </option>
                <option value="times" <?php echo ($font_certificate == 'times') ? 'selected="selected"' : ''?>>Times New Roman </option>
                <option value="timesB" <?php echo ($font_certificate == 'timesB') ? 'selected="selected"' : ''?>>Times New Roman Bold </option>
                <option value="timesBI" <?php echo ($font_certificate == 'timesBI') ? 'selected="selected"' : ''?>>Times New Roman Bold Italic </option>
                <option value="timesI" <?php echo ($font_certificate == 'timesI') ? 'selected="selected"' : ''?>>Times New Roman Italic </option>
                <option value="zapfdingbats" <?php echo ($font_certificate == 'zapfdingbats') ? 'selected="selected"' : ''?>>Zapf Dingbats </option>
              </select>


						</div>
					</div>
                    <!-- <br />
                    <br /> -->
				
                   <dl class="tabs">



     <dt class="selected certificate-design open"></dt>



      

<hr class="horizontal-line" />

    <div class="panel-title">
		<label class="">Templates</label>
	</div>


	 <dd class="">

	   <fieldset class="adminform">

		 <!--	<legend>Templates</legend>-->

<div class="col-md-12 no-padding">
<label class="field-title">Available Variables:</label>
<div>
<p class="pcertificate">
Listed below are the text message variables in […] brackets which will automatically be substituted by the text which are already been inputed in your online academy. While designing the Certificates please don't change the text inside these square brackets. However, you can upload your logo/images and amend the content of the certificate according to your choice. Designing of the Certificate is a one-time process and henceforth can be issued with a single click.
</p>
</div>
<table class="table table-bordered responsive"> 
	<thead> 
    <tr> 
    </tr> 
  </thead> 
    
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
            <td>Email Signature</td>
             <td>[ACADEMY_SIGNATURE]</td>
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



                                <td style="padding-left:20px;">Certificate Author name (Teacher name / Author name of the Course)</td>



                                <td>[AUTHOR_NAME]</td>
                                
                                <td>Academy Name</td>
                                
                                <td>[ACADEMY]</td>
                            </tr>

                           <tr>
                              <td>Site Logo</td>
                                
                                <td>[LOGO_IMG]</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                          </tr>
                        </tbody></table>

                </td>



            </tr>



        </tbody>
</table> 
</div>

<hr class="horizontal-line"/>

<table>
	<tbody>
		<tr>
        	<td>
            <div style="padding:5px;">
				<p class="">
 					This is the template for the actual certificate. Your students can view the certificate online or download it as PDF<br/>
          While designing the Certificates please don't change the text inside these square brackets. However, you can upload your logo/images and amend the content of the certificate according to your choice. Designing of the Certificate is a one-time process and henceforth can be issued with a single click.
				</p>
				</div>
			</td>
		</tr>
	<tr >
		<td>
		<div class="delete_background_cert" style="margin-bottom: 9px;">
        <input type="button" id="resetBtn" onclick="javascript:defaultSet();" value="Reset to default layout" class="">
			</div></td>
			<td>
			<div class="panel-title"style="margin-bottom: 11px;">
		<b><a class="btn" onclick="openWinCertificate1('<?php echo @$urlCourse; ?>','<?php echo @$urlname ?>','<?php echo @$certificateid ?>','<?php echo @$date_completed ?>','<?php echo @$cid;?>','<?php echo @$quizzz->user_id; ?>')" >Preview Certificate</a></b> <!--href="<?php echo base_url(); ?>admin/settings/pdf/1/" target="_blank" -->
	</div>
            </td>  

		</tr>
        
		<tr>
			<td colspan="2">
               
				<textarea name="templates1" id="templates1" class="form-control" rows="6" placeholder="Description"><?php echo $templates1;?></textarea>
				<?php echo form_error('description'); ?>
			</td>
		</tr>
	</tbody>
</table>


<br>


<hr class="horizontal-line">

    <div class="panel-title">
		<label class="">Certificate Page</label>
	</div>


        <table>
        <tbody>
		<tr>
			<td>
            <div style="padding:5px;">
				<p class="pcertificate">
 					This is the template for the page that contains the certificate. Your students will find same under the sub-menu "My Certificate" available in the menu "My Learning Zone"
				</p>
			</div>
            
           </td>
        </tr>
        

        <tr>
            <td colspan="2">
                <?php //$this->ckeditor->editor("templates2",set_value('templates2', (isset($templates2)) ? $templates2 : ''));
                //$this->ckeditor->editor("templates2", $templates2);
				?>
				<textarea name="templates2" id="templates2" class="form-control" rows="6" placeholder="Description"><?php echo $templates2;?></textarea>
				<?php echo form_error('templates2'); ?>
            </td>
        </tr>
        </tbody></table>

<br>


<hr class="horizontal-line">

    <div class="panel-title">
		<label class="">Email Template</label>
	</div>

<div style="padding:5px;">
<p class="pcertificate">
This is the template for the email which your students will recieve once you approve ther certificate
</p>
</div>

<div class="form-group"> 

<label for="field-1" class="col-sm-3 control-label no-padding">Email Subject :</label> 
<div class="col-sm-9"> 
<input type="text" class="form-control form-height" value="<?php echo $subjectt3; ?>" name="subjectt3" id="subjectt3" size="100">
</div> 

</div>

<br>
<br>
<br>
<table>
        <tbody>
	        <tr>
            <td colspan="2" style="width: 767px;">
            <?php //$this->ckeditor->editor("templates3",set_value('templates3', (isset($templates3)) ? $templates3 : ''));
            //$this->ckeditor->editor("templates3", $templates3);
            ?>
			<textarea name="templates3" id="templates3" class="form-control" rows="6" placeholder="Description"><?php echo $templates3;?></textarea>
			<?php echo form_error('templates3'); ?>
            </td>
			</tr>
        </tbody>
</table>

</fieldset>
</dd>
</dl>	


					
					
					<div class="form-group">
						<div class="col-sm-12 no-padding">
                            <a>
                   <button type="button" id="cert_submit" class='btn btn-default btn-green'>Update</button>           
								<?php //echo form_submit( 'submit', "Save Changes","id='submit' class='btn btn-default btn-green'"); ?>
							</a>
						</div>
					</div>
				</form>
				
			</div>
		
		</div>
	
	</div>


 <?php echo form_close(); ?>


</div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>public/js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/js/jscolor/jscolor.js"></script>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<script type="text/javascript">
   function defaultSet()    
    {
      var data1 = confirm('Are you really want to reset?');
      if(data1 == true)
      {
       
        $('#templates1').redactor('code.set', "<h1 style='text-align: center;'><strong><i>Certificate Of Completion</i></strong></h1><hr><h1 style='text-align: center;'><strong>[STUDENT_FIRST_NAME] [STUDENT_LAST_NAME]</strong></h1><p style='text-align: center;'><i>has successfully completed<br></i></p><p style='text-align: center;'>[COURSE_NAME]          </p>          <h2 style='text-align: center;'><i>Presented by [ACADEMY]</i></h2>          <p><i><br></i>          </p>          <p><i>Completion Date: [COMPLETION_DATE]</i>          </p>          <p><i>Site Name: [SITENAME]</i>          </p>          <p><i>Author : [AUTHOR_NAME]</i>          </p>");
      }

    }
</script>
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
  <script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
<script type="text/javascript">
  // jQuery(document).ready(
  //   function()
  //   {
      // jQuery('#templates1').redactor({
   //            focus: true,
   //           // imageUpload: window.location.origin+'/admin/certificates/getImage',
   //           'plugins': ['fontsize','fontcolor','fontfamily'],
                  
   //    });
      // jQuery('#templates2').redactor({
   //            focus: true,
   //           // imageUpload: window.location.origin+'/admin/certificates/getImage',
                  
   //    });
      // jQuery('#templates3').redactor({
   //            focus: true,
   //            //imageUpload: window.location.origin+'/admin/certificates/getImage',
                  
   //    });
      // jQuery('#templates4').redactor({
      //         focus: true,
      //        // imageUpload: window.location.origin+'/admin/certificates/getImage',
                  
      // });     
  //   }
  // );
</script>
<script type="text/javascript">
var $ = jQuery;
$(function() {
  $('#file_i').on('change',function(e) {
  var ftpfilearray;
  e.preventDefault();
    $.ajaxFileUpload({
    url :'<?php echo base_url(); ?>admin/certificates/upload_image/',
    secureuri :false,
    fileElementId :'file_i',
    dataType : 'json',
    data : {
    'type' : $('select#type').val()
    },
    success : function (data, status)
    {
      if(data.status != 'error')
      {
      $('#msgstatus_i').html('<p>Reloading files...</p>');
      $('#file_i').val('');
      $('#msgstatus_i').html('');
      ftpfileoptions = '<img src="<?php echo base_url() ?>public/uploads/settings/img/'+data.ftpfilearray+'" width="150">';
      $('#localimage_i').html(ftpfileoptions);
      ftpfilearray = data.ftpfilearray;    
      document.getElementById("imagename").value = ftpfilearray;
      }
    }
    });
   return false;
  });
});
</script>

<script type="text/javascript">
      $(function(){
        $('dl.tabs dt').click(function(){
          $(this)
            .siblings().removeClass('selected').end()
            .next('dd').andSelf().addClass('selected');
        });
      });
</script>



<script type="text/javascript">
function ChangeLayoutC(file)
{
  var img12 =  document.getElementById("localimage_i").innerHTML="<img id='imgname' width='150' src='<?php echo base_url()."public/uploads/certificates/";?>"+file+"' alt=''/>";
    //document.forms['cform'].image.value = "public/uploads/settings/img/thumbs/"+file;
    document.forms['cform'].image.value = file;
    document.getElementById("imagename").value = file;
}

function deleteImage()
{
    document.getElementById("localimage_i").innerHTML="<img id='imgname' width='150' src='' alt=''/>";
    document.getElementById("imagename").value = '';
}


</script>
  
<script>
 $(document).on('click', '#cert_submit', function(){
    $templates1 = tinyMCE.get('templates1').getContent();
    $templates2 = tinyMCE.get('templates2').getContent();
    $templates3 = tinyMCE.get('templates3').getContent();
    // $templates4 = tinyMCE.get('templates4').getContent();
    var data = $("#cform").serializeArray();
data.push({name: 'templates11', value:$templates1}), 
data.push({name: 'templates21', value:$templates2}),
data.push({name: 'templates31', value:$templates3}),
// templates21:$templates2, templates31:$templates3});
// console.log(data);
    $.ajax({
    type: 'POST',
    data: data,
    url: "<?php echo base_url(); ?>admin/certificates/set_certificate",
    beforeSend: function(){
      window.scrollTo(0,0);
    },
    success: function(msg){
      var alt_msg = $(document).find('#message');
       if(msg)
            {
               var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Successfully updated. </div>';         
            }
            else{
              var str = '<div class="alert alert-danger alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-warning" aria-hidden="true"></strong> Fail to updated, Please try again! </div>';
            } 

            alt_msg.html(str);
            alt_msg.show();
            alt_msg.fadeIn().delay(3000).fadeOut();
            // $('#lecture_save').prop('disabled', false);

        
      
    }
  });
  });

</script>

<!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){

//	jQuery('.tooltipicon').click(function(){

//	var dispdiv = jQuery(this).attr('id');

//	jQuery('.'+dispdiv).css('display','inline-block');

//	});

//	jQuery('.closetooltip').click(function(){

//	jQuery(this).parent().css('display','none');

//	});

//	});

jQuery(document).ready(function(){
 jQuery('.tooltipicon').mouseenter(function(){   
 var dispdiv = jQuery(this).attr('id');
 jQuery('.'+dispdiv).css('display','inline-block');
 });
 jQuery('.tooltipicon').mouseleave(function(){   
  var dispdiv = jQuery(this).attr('id');
  jQuery('.'+dispdiv).css('display','none');
  });
  });

	</script>

<!-- tool tip script finish -->

<script>
	function openWinCertificate1(t1,t2,t3,t4,t5,t6)
    {
    	//var t11 =$("#templates1").val();  //certibg
      var t11 = tinyMCE.get('templates1').getContent();
      var t12 =$("#imagename").val();
      //var t12 =$("#imgname").attr('src'); 
      //var t12 = t11.replace(/[&\/\\#,+()$~.'":*?<>{}]/g, '');
       // myWindow=window.open('<?php echo base_url(); ?>admin/settings/pdf/1/','width=800,height=600, resizable = 0');
		// myWindow.focus();
    //alert(t12);
      $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>admin/settings/addvaluessession",
      data: {t11:t11,t12:t12}, 
      success: function(data)
      {
        //alert(data);
       window.open('<?php echo base_url(); ?>admin/settings/pdf/1/','popupWindow','width=800,height=600, resizable = 0');
       //myWindow.focus();        
      }
      }); 
    
    }
  
   
</script>

<script src='<?php echo base_url() ?>public/js/tinymce/tinymce.min.js'></script>
  <script>

    jQuery(document).ready(function() 
    {
      tinymce.init({
  selector: '#templates1,#templates2,#templates3',
  height: 180,
 // min_width: 400,
  plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen"
 });
   });
  </script>
  <?php exit(); ?>