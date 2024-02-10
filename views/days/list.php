  <style>
  /*#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
  html>body #sortable li { height: 1.5em; line-height: 1.2em; }
  .ui-state-highlight { height: 1.5em; line-height: 1.2em; }*/
  #sortable { }
  #sortable li {  }
  html>body #sortable li { }
  .ui-state-highlight {height: 3.5em; line-height: 3.2em;}
  </style>


<!-- new code end here -->
<link rel="stylesheet" href="<?php echo base_url();?>/public/css/css_for_buttons.css">
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/sprite_frontend.css"> 
<style type="text/css">
a .crosslink:hover {
    color: #818da2;
}
.crosslink{
      margin-left: 7px;
        font-size: 14px;
        color: #555;
        margin-bottom: 3px;
        font-weight: 600;
        font-family: arial;
    }
  #coursesection .titledemp {
    margin-top: 22px;
    display: inline-block;
    font-size: 14px;
    font-weight: 600;
    padding: 10px;
    border-bottom: 1px solid #f0f0f0;
    background-color: #eee;
    width: 100%;
    box-shadow: 0 1px 13px rgba(0, 0, 0, 0.1) inset;
}

.dempbtnrigtsc{
  float: left;
}
.btn-orange {
  color: #fff;
  background-color: #ff9600;
  border-color: #ff9600;
}
.btn {
  display: inline-block;
  margin-bottom: 0;
  font-weight: 400;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 12px;
  font-size: 12px;
  line-height: 1.42857143;
  border-radius: 3px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0) !important;
}
.btn-orange:hover, .btn-orange:focus, .btn-orange:active, .btn-orange.active, .open .dropdown-toggle.btn-orange {
  color: #fff;
  background-color: #d67e00;
  border-color: #c27200;
}

.btn-web {
  color: #fff;
  background-color: #547bbe;
  border-color: #335ca1;
}
.btn-web:hover, .btn-web:focus, .btn-web:active, .btn-web.active, .open .dropdown-toggle.btn-web {
  color: #fff;
  background-color: #335ca1;
  border-color: #547bbe;
}
.btn-gold {
  color: #846e20;
  background-color: #fcd036;
  border-color: #fcd036;
}
.btn-gold:hover, .btn-gold:focus, .btn-gold:active, .btn-gold.active, .open .dropdown-toggle.btn-gold {
  color: #846e20;
  background-color: #fbc70e;
  border-color: #f1bc04;
}

.cattext11:hover {
  /*background-color: rgba(250, 247, 247, 0);*/
  /*background-color:#E8E8E8;*/
  background-color:#E4E4E4;
}

.cattext11 {
    background-color: #EEEEEE;
    padding: 10px 10px 25px 10px;
    cursor: move;
    box-shadow: 0 1px 13px rgba(0, 0, 0, 0.1) inset;
    /* cursor: url(/public/img/move-icon.png), auto; */
    margin-top: 10px;
}

.smltext11 {
  font-size: 14px;
  padding: 10px 10px 10px 10px;
  display: block;
  overflow: hidden;
  background: #fff;
  cursor:move;
  /*cursor: url(/public/img/move-icon.png), auto;*/
}
.smltext11 a.btn-danger{
  margin-top: 0 !important;
}

ul.dd-list {
  margin: 0 30px;
}
.ui-state-default {
  background:none !important;
  border:none !important;
}


.entypo-pencil_hover {
  content: "" !important;
  color:green;  
}
a>.img_hov{
  display: none;
}
a:hover>.img_hov { display: inline-block;}
</style>

<script>
$(document).ready(function(){
    $("i.entypo-pencil").mouseover(function(){
        $("i.entypo-pencil").("entypo-pencil_hover");
    });
    $("i.entypo-pencil").mouseout(function(){
        $("i.entypo-pencil").("");
    });
});
</script>
<header>
  <section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2><?php echo "Section Management";//echo lang('web_category_list')?> </h2>
          <p>A Single Course is made up of several sections. In the Sections you can add Lectures and Exam / Quizzes for the course. Exams / Quizzes have to be created separately in the Exams manager and can be added through that page.<br/>
Click on Name of Section/Lecture to Edit.</p>
        </div>
        <ol class="breadcrumb bc-3">
      <li>
        <?php
        if ($this->uri->segment(2))
        {
        $nav_home =  "<a href='".base_url()."manage/courses'>".lang('web_home')."</a> &nbsp;&nbsp;>&nbsp;&nbsp; ";
        $nav = $program->name;
  
        //while(! is_null($program->name ) )
        //{
        $nav = "<a href='".base_url()."sections-manage/".$program->id."/index'>".$program->name . "</a>";

        //$category = $category->category;
        //}

        echo "<div id='nav_categories'>$nav_home $nav</div>";
        }
        ?>
      </li>
          
        <!--<li class="active">
          <strong>Nestable Lists</strong>
        </li>-->
      </ol>
      </div>
    </div>
  </section>
</header>
<section class="container courses">
 
      <?php 
      $num=0;
      $node=0;

            $urlCourse = strtolower($program->name);      
        $urlCourse = trim(str_replace(' ', '-', $urlCourse));
        $urlCourse = preg_replace('/[^A-Za-z0-9\-]/', '', $urlCourse);

      ?>
      
      <div class="leftcontent">
        <div id="coursesection">
        <div style="float: right;padding-top: 19px;">
        <a class="link_page" style="float: right;color: #00ADEF!important;" href='<?php echo base_url(); ?>edit/courses/<?php echo $program ->id?>'><div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div></a>
        </div>
          <div class="titledemp" style="display: inline-block;">
      <!--<span style="float:left; margin-top: 10px; margin-left: 10px;">-->
      <span style="color: #c42140; float: left; font-size: 20px; margin-left: 10px; margin-top: 10px; text-transform: uppercase;"><?php echo $program->name;?></span>
          <!-- <a style="float:right" href='<?php echo base_url(); ?>days/create/<?php echo $this->uri->segment(3)?>' class='btn btn-orange'>Add New Section</a>  -->
          <!-- <a style="float:right" href='<?php echo base_url(); ?>new-section/<?php echo $urlCourse;?>/<?php echo $this->uri->segment(2)?>' class='btn btn-orange'>Add New Section</a>  -->
         <?php
         $maccessarr=$this->session->userdata('maccessarr');                
               if(($maccessarr['courses']=='own') || ($maccessarr['courses']=='modify_all'))
               {


         ?>
         <div style="float:right">
          <a href='javascript:void(0)' style="display:none" id="savechanges" class='btn btn-success'><i class="entypo-book" ></i>Save Ordering</a>
          <a href='<?php echo base_url(); ?><?php echo $urlCourse;?>/create-section/<?php echo $this->uri->segment(2)?>' class='btn btn-orange'><i class="entypo-book" ></i>Add New Section</a> 
          </div>
          <?php
              }
          ?>
          </div>
          
          <div id="coursesectionlecture">
            <ul class="course_cat1 sortable1">

            <?php if ($days) { ?>
         
            <?php 
      foreach ($days as $day): 
      $num++;
      ?>
            
            <li class="dd-item"  style="margin-bottom:10px;" id="s_<?php echo $day->id;?>">
             
             <div class="cattext11">
          
              <h4 style="display:inline-block; float: left; margin-right: 30px;"> 
              <!-- <a href="<?php echo base_url(); ?>days/edit/<?php echo $day->id;?>/<?php echo $program->id; ?>"><i class="entypo-book" style="margin-right:15px;"></i><?php echo $day->title;?></a>  -->
              <!-- <a href="<?php echo base_url(); ?>edit-section/<?php echo $urlCourse;?>/<?php echo $day->id;?>/<?php echo $program->id; ?>"><i class="entypo-book" style="margin-right:15px;"></i><?php echo $day->title;?></a>  -->
              <a title="Edit Section" href="<?php echo base_url(); ?><?php echo $urlCourse;?>/edit-section/<?php echo $day->id;?>/<?php echo $program->id; ?>"><img src="http://create-online-academy.com/public/images/admin/sections-icon.png" style="margin-left: 12px;margin-right: 7px;"><?php echo $day->title;?> <img src="http://create-online-academy.com/public/images/admin/pencil-red.png"></a> 
              <!-- <a class='ldelete' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>days/delete/<?php echo $day->id?>/<?php echo $this->uri->segment(2)?>' class='btn btn-orange'>Delete</a> -->       </h4>
              
              <!-- <a style="float:right" href='<?php echo base_url(); ?>tasks/create/<?php echo $day->id;?>/<?php echo $program->id;?>' class='btn btn-orange'>Add New Lecture</a>  -->
              <!-- <a style="float:right" href='<?php echo base_url(); ?>create-lecture/<?php echo $urlCourse;?>/<?php echo $day->id;?>/<?php echo $program->id;?>' class='btn btn-orange'>Add New Lecture</a>  -->
              <?php
                //$maccessarr=$this->session->userdata('maccessarr');               
               if(($maccessarr['courses']=='own') || ($maccessarr['courses']=='modify_all'))
               {
               ?>
             
              <?php
                if(($maccessarr['courses']=='own'))
                {
              ?>
              <div style="float: right;">
                <!-- <a  onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>days/delete/<?php echo $day->id?>/<?php echo $this->uri->segment(2)?>' class='btn btn-danger'>Delete</a> -->
              <!--<a  onClick="return deleteconfirm('<?php //echo $day->id?>','<?php //echo $this->uri->segment(2)?>')"  class='btn btn-danger'>Delete</a>-->
              <a  onClick="return deleteconfirm('<?php echo $day->id?>','<?php echo $this->uri->segment(2)?>')"><img src="/public/css/image/delete-black-icon.png" border="0" alt="Delete Section" title="Delete Section" /></a>
              </div>
              <?php
                }
              ?>
              <div style="clear:both;"></div>
               <div class="button-sect">
                <?php if($program->webstatus == 'active') { ?>
              <a title="Add New Webinar" style="float:right;" href='<?php echo base_url(); ?>webinars/create/<?php echo $urlCourse; ?>/<?php echo $day->id;?>/<?php echo $program->id;?>' class=''><i style="color: #03A9F4" class="entypo-network"></i></a> 
             <?php } ?>
              <a title="Add New Assignment" style="float:right;" href='<?php echo base_url(); ?>programs/assignment/<?php echo $day->id;?>/<?php echo $program->id;?>' class=''><i style="color: #f44336" class="entypo-docs"></i></a> 
              <a title="Add New Exam" style="float:right;" href='<?php echo base_url(); ?>tasks/quiz/<?php echo $day->id;?>/<?php echo $program->id;?>' class=' '>
                <i style="color: #ff9800" class="entypo-clipboard"></i></a> 
              <a title="Add New Lecture" style="float:right" href='<?php echo base_url(); ?><?php echo $urlCourse;?>/create-lecture/<?php echo $day->id;?>/<?php echo $program->id;?>' class=' '><i  style="color: #3f51b5" class="entypo-book-open" ></i></a> 
              </div>
             
              <div style="clear:both;"></div>
              <?php 
                }
              
               ?>
              
                <ul class="dd-list sortable" id="<?php echo $day->id;?>" style="min-height: 10px;" >
                <?php
                $lessons = $this->days_model->getLessonNew($day->id);
        //$lessons = $this->days_model->getLessons($day->id);
        // echo"<pre>";
        if ($lessons): 

        foreach ($lessons as $lesson):
        $node++; 
        ?>
               <li class="dd-item ui-state-default" id="<?php echo $day->id.'_'.$lesson->id.'_1';?>"> 
                
                  <div class="smltext11" style="margin-top:12px;"> 
                     <?php
                   if($lesson->layoutid == '12')
            {
          ?>
                    <a id="nodeATag2"  title="Edit Exam" href="<?php echo base_url(); ?><?php if($lesson->layoutid == '12') { echo 'tasks/quizedit'; } else { echo $urlCourse.'/edit-lecture';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>"><i class="entypo-clipboard" style="margin-right:15px;color: #ff9800"></i><?php echo $lesson->name;?> <span class="img_hov"><img src="http://create-online-academy.com/public/images/admin/pencil.png"></span></a> 
                    
                    <?php
            }
            else if($lesson->layoutid == '2' && $lesson->is_assignment != '0')
             {   ?>
                    <a id="nodeATag2"  title="Edit Assignment" href="<?php echo base_url(); ?>programs/edit_assignment/<?php echo $day->id;?>/<?php echo $program->id;?>/<?php echo $lesson->is_assignment; ?>"><i class="entypo-docs" style="margin-right:15px;color: #f44336"></i><?php echo $lesson->name;?> <span class="img_hov"><img src="http://create-online-academy.com/public/images/admin/pencil.png"></span></a> 
                    
                    <?php
            }
            else if($lesson->layoutid == '22' || $lesson->is_webinar != '0')
            {
               $webinar = $this->days_model->getWebinarNew($lesson->is_webinar); 
                if ($webinar)
                { ?>
                  <a id="nodeATag2" title="Edit Webinar"  href="<?php echo base_url(); ?>webinars/edit/<?php echo $urlCourse; ?>/<?php echo $day->id;?>/<?php echo $program->id;?>/<?php echo $webinar->id; ?>">
                      <i class="entypo-network" style="margin-right:15px;color: #03A9F4"></i>
                      <?php echo $webinar->title;?> <span class="img_hov">
                      <img src="http://create-online-academy.com/public/images/admin/pencil.png"></span></a>  
             <?php  }
            }
            else
            {
          ?>
          <a id="nodeATag2" title="Edit Lecture"  href="<?php echo base_url(); ?><?php if($lesson->layoutid == '12') { echo 'tasks/quizedit'; } else { echo $urlCourse.'/edit-lecture';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>"> <i class="entypo-book-open" style="margin-right:15px;color: #3f51b5"></i><?php echo $lesson->name;?> <span class="img_hov"><img src="http://create-online-academy.com/public/images/admin/pencil.png"></span></a>                   
                   <?php
                      }
           
                   if(($maccessarr['courses']=='own'))
              {
                if($lesson->layoutid == '22' || $lesson->is_webinar != '0')
                {
               $webinar = $this->days_model->getWebinarNew($lesson->is_webinar); 
                if ($webinar)
                { 
                   $web_schedule = $webinar->fromdate.' '.$webinar->fromtime;
                     $currentgmt = gmdate('Y-m-d H:i');
                     if($currentgmt < $web_schedule )
                     {
                    ?>
                  <a style="float:right"  onClick="return deleteWeb('<?php echo $webinar->id;?>','<?php echo $day->id?>','<?php echo $program->id;?>','<?php echo $lesson->name;?>')"><img src="/public/css/image/red-del-icon.jpg" border="0" alt="Delete Webinar" title="Delete Webinar" /></a>
                  <?php } 
                  else { ?>
                  <a style="float:right"  onClick="return deleteWebExp('<?php echo $webinar->id;?>','<?php echo $day->id?>','<?php echo $program->id;?>','<?php echo $lesson->name;?>')"><img src="/public/css/image/red-del-icon.jpg" border="0" alt="Delete Webinar" title="Delete Webinar" /></a>
                  <?php }
                 }  
              }
              else if($lesson->layoutid == '2' && $lesson->is_assignment != '0') 
                {  ?>  
                    <!-- <a style="float:right"  onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>tasks/delete/<?php echo $lesson->tid;?>/<?php echo $day->id;?>/<?php echo $program->id;?>' class='btn btn-danger'>Delete</a>  -->
                  <!--<a style="float:right"  onClick="return deleteconfirm2('<?php //echo $lesson->id;?>','<?php //echo $day->id?>','<?php echo $program->id;?>')"  class='btn btn-danger'>Delete</a>--> 
                  <a style="float:right"  onClick="return deleteAssignment('<?php echo $lesson->is_assignment;?>','<?php echo $day->id?>','<?php echo $program->id;?>')"><img src="/public/css/image/red-del-icon.jpg" border="0" alt="Delete Assignment" title="Delete Assignment" /></a>
                  <?php } 
              else {  ?>  
                    <!-- <a style="float:right"  onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>tasks/delete/<?php echo $lesson->tid;?>/<?php echo $day->id;?>/<?php echo $program->id;?>' class='btn btn-danger'>Delete</a>  -->
                  <!--<a style="float:right"  onClick="return deleteconfirm2('<?php //echo $lesson->id;?>','<?php //echo $day->id?>','<?php echo $program->id;?>')"  class='btn btn-danger'>Delete</a>--> 
                  <a style="float:right"  onClick="return deleteconfirm2('<?php echo $lesson->id;?>','<?php echo $day->id?>','<?php echo $program->id;?>')"><img src="/public/css/image/red-del-icon.jpg" border="0" alt="Delete Lecture" title="Delete Lecture" /></a>
                  <?php }
                   } ?>
                  </div>
                  
                </li>
                
                <?php endforeach?>
                <?php endif ?>
               
              </ul>
              
              
              </div>
            </li>
            <?php endforeach?>
            <?php  } else { ?>
        <!-- <p class='text'><?=lang('web_no_elements');?></p> -->
      <?php } ?>
          
            </ul>
          </div>
        </div>
        <!-- course section End --> 
        
      </div>
      

      
    </div>
 <div style="float: right;">
        <a class="link_page" style="float: right;color: #00ADEF!important;" href='<?php echo base_url(); ?>edit/courses/<?php echo $program ->id?>'><div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Content"></div><span class="crosslink">Edit Course Settings</span></a>
        </div>
</section>
 

<!-- ff<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

  ff<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  ff<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  ff<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

  <!-- ll<script src="<?php echo base_url(); ?>/public/js/jquery-ui/external/jquery/jquery.js" type="text/javascript"></script>  ll -->
  <script src="<?php echo base_url(); ?>/public/js/jquery-ui/jquery-ui.js"></script>
  <link href="<?php echo base_url(); ?>/public/js/jquery-ui/jquery-ui.css" rel="stylesheet">
       <script>
       jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

  var $j =jQuery.noConflict();
  
  $j(function() {
    $j( ".sortable" ).sortable({
      placeholder: "ui-state-highlight",
      connectWith: ".sortable1 .sortable",

      receive: function( event, ui ) {
         var eleId = ui.item.attr("id"); 
         var parent_id = $("#"+ui.item.attr("id")).parent().attr('id');       
   //      $j.ajax({
      // type: "POST",
      // url: "<?php echo base_url(); ?>days/relationUpdate",
      // data: {eleId:eleId,parent_id:parent_id}, 
      // success: function(data)
      // {
      //  //alert(data);
      //  location.reload();        
      // }
     //  }); 

        },

      update: function( event, ui ) {
        var sortedIDs = $j(this).sortable("toArray");  
        $("#savechanges").css("display","");        
        //new code start here
   //       $j.ajax({
      // type: "POST",
      // url: "<?php echo base_url(); ?>days/sortingorder",
      // data: {sortedIDs:sortedIDs}, 
      // success: function(data)
      // {
      //  //alert(data);        
      // }
     //  }); 
        //new code end here
      }  
         
    });

    $j( ".sortable" ).disableSelection();
    
  });

  $j(function() {
    $j( ".sortable1" ).sortable({
      placeholder: "ui-state-highlight",
      connectWith: ".sortable1",

      update: function( event, ui ) {
        var sortedIDs = $j(this).sortable("toArray"); 
        $("#savechanges").css("display","");          
        //new code start here
      
   //       $j.ajax({
      // type: "POST",
      // url: "<?php echo base_url(); ?>days/sortingsection",
      // data: {sortedIDs:sortedIDs}, 
      // success: function(data)
      // {
      //  //alert(data);        
      // }
     //  }); 
        //new code end here
      }  

    });
    $j( ".sortable1" ).disableSelection();
  });
  </script>


  <script>
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

  var $j =jQuery.noConflict();
function deleteconfirm(id,seg) 
       {
                  
                $j.confirm({
                      title: 'Do you really want to delete Section ?',
                       content: ' ',
                       confirm: function(){ 
                                        window.location.href = "<?php echo base_url(); ?>days/delete/"+id+"/"+seg;
       
                                           },
                        cancel: function(){        
                                         return true;
                                                   }
                                         });
                       
               }

               function deleteconfirm2(lid,id,seg) 
              {
                  
                $j.confirm({
                      title: 'Do you really want to delete lecture ?',
                       content: ' ',
                       confirm: function(){ 
                                        window.location.href = "<?php echo base_url(); ?>tasks/delete/"+lid+"/"+id+"/"+seg;
                                  
                                           },
                        cancel: function(){        
                                         return true;
                                                   }
                                         });
                       
               }
              function deleteWeb(wid,secid,cid,cname) 
              {
                  
                $j.confirm({
                      title: 'Do you really want to delete webinar ?',
                       content: ' ',
                       confirm: function(){ 
                                        window.location.href = "<?php echo base_url(); ?>webinars/delete/"+wid+"/"+cid+"/front/"+cname;
                                  
                                           },
                        cancel: function(){        
                                         return true;
                                                   }
                                         });
                       
               }
               function deleteWebExp(wid,secid,cid,cname) 
              {
                  
                $j.confirm({
                      title: 'Session created in this webinar. Do you really want to delete the webinar ?',
                       content: ' ',
                       confirm: function(){ 
                                        window.location.href = "<?php echo base_url(); ?>webinars/delete2/"+wid+"/"+cid+"/front/"+cname;
                                  
                                           },
                        cancel: function(){        
                                         return true;
                                                   }
                                         });
                       
               }

               function deleteAssignment(assign_id,secid,cid) 
              {
                  
                $j.confirm({
                      title: 'Do you really want to delete assignment ?',
                       content: ' ',
                       confirm: function(){ 
                                        window.location.href = "<?php echo base_url(); ?>programs/delete_assignment/"+assign_id+"/"+cid+"/<?php echo $this->uri->segment(3); ?>";
                                  
                                           },
                        cancel: function(){        
                                         return true;
                                                   }
                                         });
                       
               }


               $j("#savechanges").click(function(){       
        
        var sectionSortIDS = [];
        var lectureSortIDS = [];
        var sectionSorting = [];
        
        $j('ul.sortable').each(function()
        {           
          var sectionIDs = $(this).attr("id");
          var sortedIDs = $j(this).sortable("toArray");
          // alert(sortedIDs);
          
          sectionSortIDS.push(sectionIDs);
          lectureSortIDS.push(sortedIDs); 
            
        }); 

        $j('ul.sortable1').each(function()
        { 
          var sectionSortedIDs = $j(this).sortable("toArray");          
          sectionSorting.push(sectionSortedIDs);      
            
        });            

        $j.confirm({
       title: 'Do you really want to save changes ?',
       content: ' ',
       confirm: function(){              
                          
            $j.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>days/sortingorder",
                data: {sectionSorting:sectionSorting,sectionSortIDS:sectionSortIDS,lectureSortIDS:lectureSortIDS}, 
                success: function(data)
                  { 
                    if(data == "success")
                    {
                     window.location.href = "<?php echo base_url(); ?>sections-manage/<?php echo $this->uri->segment(2); ?>/<?php echo $this->uri->segment(3); ?>";
                    }   
                  }
                   }); 

                          },
       cancel: function(){        
                       return true;
                         }
                     });

        

    });
               </script>