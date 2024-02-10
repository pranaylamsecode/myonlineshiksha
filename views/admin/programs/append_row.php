<tr class="odd camp<?php echo $program->id ?>" id="tr_<?php echo $program->id ?>">
<td class="tr_border"> 
      <div class="col-sm-12 div_row_padding course_picture">
        <!--new content -->
        <img src="http://ideal.createonlineacademy.com/public/uploads/programs/img/thumb_232_216/<?php echo $program->image ? $program->image : 'no_images_course.png' ?>">
        
          <a href="<?php echo base_url('admin/edit/courses/'.$program->id) ?>" class="a_mlms field-title course-title"><?php echo ucfirst($course_name);?></a>

                </div>
    </td>
 

        <td class="course_description">
          <div class="course_description_sec">
            <div class="col-sm-12 no-padding course-title_sec" style="color: #949494;">
              <a href="<?php echo base_url('admin/section-management/'.$program->id) ?>" class="a_mlms field-title course-title"><?php echo ucfirst($course_name);?></a>
            </div>
            <div class="col-sm-12 no-padding field-title cat_name">

              <?php echo ucfirst($this->programs_model->getCatNameByCatID($program->catid))?></div>
            <div class="col-sm-12 no-padding course_author">
              <?php $userinfo=$this->programs_model->getUserInfo($program->author);
              echo $userinfo->first_name.' '.$userinfo->last_name; ?>
              	
            </div>
          </div>
        </td>
     
   
  <td class="pub no-padding">


          <?php if($program->published){?>

              <a title="Publish Item" href="<?php echo base_url(); ?>admin/programs/unpublish/<?php echo $program ->id?>"><!-- <img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png"> --><div class='sprite 9999published center' style="background-position: -340px 0;"></div></a>
              
            <?php }else{?>

              <a title="Unpublish Item" href="<?php echo base_url(); ?>admin/programs/publish/<?php echo $program ->id?>"><!-- <img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png"> --><div class='sprite 999publish center' style=" background-position: -308px 0;"></div></a>

        
    <?php }?>
</td>

          
            <td class="editdelete no-padding">
            <div class="col-sm-12 no-padding center" style="text-align: center;padding-left:20px !important;padding-right:20px !important;">
              <!-- New Content -->
                  <div class="draft">
                  <p><?php echo $program->published == '1' ? 'Published' : 'Draft' ?></p>
                  <p class="modified">Modified on: <?php echo $program->modify_date; ?>
                   <!-- Jan 23, 2019  -->
                  </p></div>
                  <div class="edit-menu">
                    <i class="fas fa-ellipsis-h open_setting showmenu" id="showmenu_<?php echo $program ->id?>"></i>
                    <div id="menu_<?php echo $program ->id?>" class="course_setting" style="">
                      <ul>

                        <li><a href="<?php echo base_url('admin/create/section/'.$program->id) ?>"><span class="lnr lnr-plus-circle"></span>Add new content</a></li>

                        <li><a href="<?php echo base_url('admin/section-management/'.$program->id) ?>"><span class="lnr lnr-pencil"></span>Edit content</a></li>

                        <li><a><span class="lnr lnr-bubble"></span>Discussions</a></li>
                         <li><a><span class="lnr lnr-magnifier"></span>Reviews</a></li>

                        <li><a href="<?php echo base_url('admin/edit/courses/'.$program->id); ?>"><span class="lnr lnr-cog"></span>Settings</a></li>
                        
                         <?php if($ii != 0){ ?>
                        <li>
                          
                          <a href="<?php echo base_url(); ?>admin/course/preview/<?php echo $program->id ?>/<?php echo @$days[0]->id ?>/<?php echo @$lessons[0]->id; ?>" target="_blank" id="pre_link" ><span class="lnr lnr-eye"></span>Preview course</a></li>
                        <?php } ?>

                        <li><a onclick="copyCourse('<?php echo $program->id ?>')" ><span class="lnr lnr-book"></span>Copy course</a></li>
                        
                        <!-- <li class="blue_anchors"><a>Collapse</a><span class="line">|</span><a>Expand</a></li> -->
                        <li><a onclick="deleteconfirm(<?php echo $program->id ?>)"><span class="lnr lnr-trash"></span>Delete course</a></li>

                     
                      </ul>
                    </div>
                  </div>
         
                 <?php if($ii == 0){ ?>
               <a href="javascript:void()" class="col-sm-2 no-padding sprite_margin hide_old_sec" target="_blank" id="pre_link" >
               <i class="entypo entypo-block" title="No Preview"></i>
               <?php } 
               else { ?>
               <a href="<?php echo base_url(); ?>admin/course/preview/<?php echo $program->id ?>/<?php echo @$days[0]->id ?>/<?php echo @$lessons[0]->id; ?>" class="col-sm-2 no-padding sprite_margin hide_old_sec" target="_blank" id="pre_link" >
                <div class='sprite 5preview' style="background-position: -120px 0; height: 14px;" title="Preview"></div>
              </a>
           
            <?php
           } if($u_data['groupid']=='4')

{

?>

      <!-- <a class='btn btn-default btn-sm btn-icon icon-left' href='<?php echo base_url(); ?>admin/programs/edit/<?php echo $program ->id?>'><i class="entypo-pencil"></i>edit</a> -->
      
      <a href="<?php echo base_url(); ?>admin/section-management/<?php echo $program ->id?>" class='col-sm-2 no-padding sprite_margin hide_old_sec'>
        <div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content">
        </div>
      </a>

      

<?php

}
?>

<a  class='col-sm-2 no-padding sprite_margin hide_old_sec' href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'>
<div class='sprite 7settings' style="background-position: -184px 0" title="Course Settings"></div></a>
<a class="col-sm-2 no-padding sprite_margin hide_old_sec copy_link" id="link_id<?php echo $program ->id?>">
<div class='sprite 3copy' style="background-position: -64px 0; width: 18px;" title="Copy"></div>
</a>

<div class="modal fade copydiv" id="copy_popup<?php echo $program ->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="post" action="<?php echo base_url();?>admin/programs/copy/"  class="tform" id="copy_form<?php echo $program ->id?>">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="text-transform: inherit !important;">Copy a Course</h4>
      </div>
      <div class="modal-body">
       
            
              <div class="form-group col-sm-12">
              
              <label class='col-sm-5 control-label'>Make a copy of this course</label>
              <?php
              $comboCourse = $this->programs_model->getCourseCombo();
              ?>
          
              <div class="col-sm-7">
              <input type="text" value="<?php echo ucfirst($course_name) ?> - Copy" name="Coursename_<?php echo $program->id ?>" id="Coursename_<?php echo $program->id ?>" style="height: 31px;padding: 14px 10px;width: 100% !important">
              <input type="hidden" value="<?php echo $program->id ?>" name="CbCourse_<?php echo $program->id ?>" id="CbCourse_<?php echo $program->id ?>">
                            
              <?php echo form_error('CbCourse'); ?>
            
                
            </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button name='btnSubmit_<?php echo $program->id ?>' id='btnSubmit_<?php echo $program->id ?>' onclick="copyCourse('<?php echo $program->id ?>')" type="button" class="btn btn-primary">Copy</button> 
        <!-- <input type='button' name='btnSubmit_<?php echo $program->id ?>' id='btnSubmit_<?php echo $program->id ?>' value='Copy Course' onclick="copyCourse('<?php echo $program->id ?>')" class='btn btn-primary copyCourse'> -->
              <!-- <a href="<?php echo base_url();?>admin/course-manager/" class="btn btn-default"> --><a href="" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span class="icon-32-cancel"> </span>Cancel</a>
      </div>
    </div>
  </div>
  </form>
</div>


     <?php
if($u_data['groupid']=='4')

{
?>
<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/programs/trash/<?php echo $program->id?>'>
      <i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
<!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onClick="deleteconfirm(<?php echo $program->id?>)">
      <i class="entypo-cancel"></i><?php echo lang('web_delete')?></a> -->
      <a class="icon-left col-sm-2 no-padding hide_old_sec" onClick="deleteconfirm(<?php echo $program->id?>)">
      <div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div>
      <!-- <i class="entypo-cancel"></i><?php echo lang('web_delete')?> --></a>
      <?php 
       $users_id = $this->programs_model->getBuyUsers($program->id);
        $users_id2 = $this->programs_model->getBuyUsers2($program->id);
       
       ?>
      <input type="hidden" value="<?php echo $users_id ? '1' : '0'; ?>" id="id_<?php echo $program->id?>">
      <input type="hidden" value="<?php echo $users_id2 ? '1' : '0'; ?>" id="id2_<?php echo $program->id?>">

<?php

}

else

echo "No Access";

?>
        </div>
            </td>
    </tr>