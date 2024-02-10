

<style>



.error{
	color: red;
	font-size:13px;
	display: none;
}

.redactor-editor {
  min-width: 0px!important; 
}
.main-table {
  display: block!important;
  width: 100%!important;
}
</style>

<div class="main-container">
<?php

  $attributes = array('class' => 'tform', 'id' => 'frm_save_lecture');

echo form_open(base_url().'admin/tasks/save_lecture/'.$did.'/'.$pid, $attributes);


?>


<div class="field_container">
<div class="col-sm-12">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
<div class="panel primary-border panel-primary" data-collapsed="0">
	
<div class="panel-body form-body main-table">
				
				<fieldset class="adminform form-horizontal form-groups-bordered" style="width:100%;">	
				
                    <div class="col-sm-6 no-padding">
              <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" for="Lesson"><?php echo 'Lecture title:'//echo lang('web_name')?> <span class="required">*</span></label>
              <div class="col-sm-12 no-left-padding">

        <input id="name" class="form-control form-height" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>"  />
                               



        <span class="error"><?php echo form_error('name'); ?> </span>
                                
              </div>
            </div>            
           <div class="col-sm-3 no-padding">
              <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" >
                Type 
              </label>
              <div class="col-sm-12 no-left-padding">
                <select id="lecture_type" name="lecture_type" class="form-control form-height"  size="1" >
                <option value="video" <?php echo preset_select('lecture_type', 'Video', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?> >Video</option>

                <option value="PDF / Doc" <?php echo preset_select('lecture_type', 'PDF / Doc', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>PDF / Doc</option>

                <option value="Audio" <?php echo preset_select('lecture_type', 'Audio', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Audio</option>

                <option value="Text" <?php echo preset_select('lecture_type', 'Text', (isset($task->lecture_type)) ? $task->lecture_type : ''); ?>>Text</option>

                <!-- <option value="exam">Exam</option> -->
                </select>
              </div>
           </div>
           <div class="col-sm-3 no-padding">
             <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" for="Lesson">
             Duration
             </label>
             <div class="col-sm-12 no-left-padding">

                <input id="lecture_duration" class="form-control form-height" type="text" name="lecture_duration" placeholder="ex.1:00 Hrs" value="10 Min" />
              </div>
           </div>


            <div class="form-group form-border" style="margin:0;padding-top: 0;">
            <div class="col-sm-12 no-padding">
          <div class="grey-background" style="display: -webkit-box;">
             <!--  <label class="col-sm-3 control-label"> </label> -->
             
                <div class="col-sm-1 no-padding" style="width:3%;">                
               <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? 'checked="checked"' : (isset($task->published) && $task->published == '1') ? 'checked="checked"' : ''?> <?php echo $updType == 'create' ? 'checked="checked"':''; ?>/>
              </div>
               <label class='col-sm-11 no-padding control-label dark_label' style="padding-top: 2px;" for='active'>Publish <?//=lang('web_is_active')?> </label>

           </div>
       </div>
   </div>
					
					</fieldset>
                    
      </div>
  </div>
</div>

	<ul id="sticky" class="main-content-btn" style="list-style: none; float: right;">



            <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">
				  <a><input type="submit" id='lecture_save' name="lecture_save" class='btn btn-success btn-green' value="Save"  ></a> 
<!-- onclick="save_lecture(); -->

			</li>
			
			<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



			<a href='#' class='btn btn-danger btn-dark-grey cross_icon' id="forward" style="color:#FFF;">Cancel</a>



			</li>            



			</ul>



	<!-- <?php echo form_hidden('parent_id',$parent_id) ?>	 -->







<?php if ($updType == 'edit'): ?>



	<?php echo form_hidden('id',$day->id) ?>



<?php endif ?>


	
</div>
</div>


<?php echo form_close(); ?>
<?php  ?>

<script>
  


var optionsignin2 = { 
  dataType: "json",
    beforeSend: function() 
    {
        var name = $('#name').val();
        if(name == '')
        {
                        // $('#title').append('<span class="error">Please enter title</span> ');

            $('.error').text('Please enter title');
            $('.error').show();
            $('.error').fadeIn().delay(1000).fadeOut();
            
            return false;
        }
    },
   
    success: function() 
    {
        
    
    },
    complete: function(data) 
    {          
        //         $.alert({
        
        //     title: "Successfully created the lecture",
        //     content: ' ',
        // });

                   var msg = "Lecture Successfully Created.";
                 var obj = data.responseJSON;
                 if(obj.lecture_type == 'Text')
                    var msgupload = "Text not added.";
                  else
                    var msgupload = obj.lecture_type+" not Uploaded";
                 
                  // console.log(obj.tid); 
         var str = '<li class="dd-item right-sect" id="'+obj.did+'_'+obj.tid+'"><div class="col-sm-1 dd-content light-green-bg" style="padding-left:10px!important; background-color:#00C3AA"><div class="col-sm-12 no-padding top-menu-icon"><a id="nodeATag2"  title="Edit Lecture"  href="<?php echo base_url(); ?>admin/edit/lecture/'+obj.tid+'/'+obj.did+'/'+obj.pid+'"><div class="sprite 8menu" style="background-position: -216px 0; height: 18px;" title="Edit Lecture"></div></a></div><div class="col-sm-12 no-padding bottom-close-icon" style="margin-right: 0!important;"><a  style="cursor:pointer" onClick="return deleteconfirm2('+obj.tid+','+obj.did+','+obj.pid+')" ><div class="sprite 99close" style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div></a></div></div><div class="col-sm-11 white-bg"><div class="col-sm-12 grey-bg"><a href="<?php echo base_url(); ?>admin/edit/lecture/'+obj.tid+'/'+obj.did+'/'+obj.pid+'"><h5 class="lec_name">'+obj.name+'</h5></a></div><div class="curriculum_corse_feat"><ul><li>'+obj.published+'</li><li>Type: '+obj.lecture_type+'</li><li style="background-color: red;color: white;"> '+ msgupload +'</li></ul></div></div></li>';

        $(document).find('#s_'+obj.did).find('ul#'+obj.did).append(str); 
         $('.course_popup').hide(); 
       $('.popup_overlay_lec').hide();

        var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+msg+' </div>';
             var note = $(document).find('#message');
              note.html(str);
            note.show();
            note.fadeIn().delay(3000).fadeOut();
            
    },
    error: function()
    {   
      alert('error'); 
    }
 
}; 
 
$("#frm_save_lecture").ajaxForm(optionsignin2);

</script>
