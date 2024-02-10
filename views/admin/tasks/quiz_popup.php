

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

 $attributes = array('class' => 'tform', 'id' => 'frm_save_quiz');
echo form_open(base_url().'admin/tasks/save_exam/'.$did.'/'.$pid, $attributes);



?>


<div class="field_container">
<div class="col-sm-12">
<div class="col-md-6 col-md-6 col-sm-6 col-xs-6 field_content" style="width: 100%;">
<div class="panel primary-border panel-primary" data-collapsed="0">
  
<div class="panel-body form-body main-table">
        
        <fieldset class="adminform form-horizontal form-groups-bordered" style="width:100%;"> 
        
                    <div class="col-sm-12 no-padding">
              <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" for="Lesson"><?php echo 'Quiz Name:'//echo lang('web_name')?> <span class="required">*</span></label>
              <div class="no-left-padding">

        <input id="name" class="form-control form-height" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>" />



        <span class="error err_name"><?php echo form_error('name'); ?> </span>
                                
              </div>
            </div>            
           <!-- <div class="col-sm-3 no-padding">
              <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" >
                Level 
              </label>
              <div class="col-sm-12 no-left-padding">
                <select id="difficultylevel" name="difficultylevel" class="form-control form-height"  size="1" >



                                    <option value="">Select Level</option>



                                    <option value="easy" <?php echo preset_select('difficultylevel', 'easy', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Easy</option>



                                    <option value="medium" <?php echo preset_select('difficultylevel', 'medium', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Medium</option>



                                    <option value="hard" <?php echo preset_select('difficultylevel', 'hard', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Hard</option>



                  </select>
                          

              </div>
              <span class="error err_difficultylevel"><?php echo form_error('difficultylevel'); ?> </span>
           </div> -->
          <!--  <div class="col-sm-3 no-padding">
             <label class='col-sm-12 control-label field-title'class='col-sm-12 no-left-padding control-label field-title' style="padding-left:0;" for="Lesson">
             Duration
             </label>
             <div class="col-sm-12 no-left-padding">

                <input id="lecture_duration" class="form-control form-height" type="text" name="lecture_duration" placeholder="1:00 Hrs" value="<?php echo set_value('lecture_duration', (isset($task->lecture_duration)) ? $task->lecture_duration : '1:00 Hrs'); ?>" />
                <span class="error err_duration"><?php echo form_error('difficultylevel'); ?> </span>
              </div>
           </div> -->


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
          <a><input type="submit" id='quiz_save' name="quiz_save" class='btn btn-success btn-green' value="Save"  ></a> 
<!-- onclick="save_lecture(); -->

      </li>
      
      <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



      <a href='#' class='btn btn-danger btn-dark-grey cross_icon' id="forward" style="color:#FFF;">Cancel</a>



      </li>            



      </ul>



  <!-- <?php echo form_hidden('parent_id',$parent_id) ?>  -->







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
        var name = $("#name").val();
        /*var level = $("#difficultylevel").val();
        var lecture_duration = $("#lecture_duration").val();*/
        /*if(name == '' || level == '' || lecture_duration == '')
        {
         
             if(name == '')
            {
                            // $('#title').append('<span class="error">Please enter title</span> ');
                $('.err_name').text('Please enter name!');
                $('.err_name').show();
                $('.err_name').fadeIn().delay(1000).fadeOut();
                
                // return false;
            }
            if(level == '')
            {
                            // $('#title').append('<span class="error">Please enter title</span> ');
                $('.err_difficultylevel').text('Please select level!');
                $('.err_difficultylevel').show();
                $('.err_difficultylevel').fadeIn().delay(1000).fadeOut();
                
                // return false;
            }
            if(lecture_duration == '')
            {
                            // $('#title').append('<span class="error">Please enter title</span> ');
                $('.err_duration').text('Please mention exam duration!');
                $('.err_duration').css('display', 'block!important').show();
                $('.err_duration').fadeIn().delay(1000).fadeOut();
                
                // return false;
            }

            return false;
        }*/
         if(name == '')
            {
                $('.err_name').text('Please enter name!');
                $('.err_name').show();
                $('.err_name').fadeIn().delay(1000).fadeOut();
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

                   var msg = "Quiz Successfully Created."
                 var obj = data.responseJSON;
                  // console.log(obj.tid); 
         var str = '<li class="dd-item right-sect" id="'+obj.did+'_'+obj.tid+'"><div class="col-sm-1 dd-content light-green-bg" style="padding-left:10px!important; background-color:#008BDB"><div class="col-sm-12 no-padding top-menu-icon"><a id="nodeATag2" title="Edit Exam" href="<?php echo base_url() ?>admin/edit/exam/'+obj.tid+'/'+obj.did+'/'+obj.pid+'"><span class="lnr lnr-list edit_icon"></span></a></div><div class="col-sm-12 no-padding bottom-close-icon" style="margin-right: 0!important;"><a style="cursor:pointer" onclick="return deleteconfirm2('+obj.tid+','+obj.did+','+obj.pid+')"><span class="lnr lnr-cross delete_sec"></span></a></div></div><div class="col-sm-11 white-bg"><div class="col-sm-12 grey-bg"><a href="<?php echo base_url() ?>admin/edit/exam/'+obj.tid+'/'+obj.did+'/'+obj.pid+'"><h5 class="lec_name">'+obj.name+'</h5></a><a style="float: right;padding-top: 4px;"></a></div><div class="curriculum_corse_feat col-sm-12"><ul><li>'+obj.published+'</li><li>Level: '+obj.difficultylevel+'</li><li style="background-color: red;color: white;">No questions</li></ul></div></div></li>';

        $(document).find('#s_'+obj.did).find('ul#'+obj.did).append(str); 
         $('.course_popup').hide(); 
       $('.popup_overlay_lec').hide();

        var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+msg+' </div>';
             var note = $(document).find('#message');
              note.html(str);
            note.show();
            note.fadeIn().delay(3000).fadeOut();
            
    },
    error: function(data)
    {   
       var r = jQuery.parseJSON(data.responseText);
                       alert("Message: " + r.Message);
    }
 
}; 
 
$("#frm_save_quiz").ajaxForm(optionsignin2);

</script>
