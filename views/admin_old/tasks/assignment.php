<base href="<?php echo $this->config->item('base_url') ?>/public/" />
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontsize/fontsize.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontfamily/fontfamily.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/fontcolor/fontcolor.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/video/video.js"></script> 
<script src="<?php echo base_url(); ?>public/js/redactor123/assets/plugins/imagelink/imagelink.js"></script> 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dragdrop/theme_admin.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="/public/css/assignment/assignment.css">


<style>
.nameicon
{
    border-style: 1.5px solid;
    border-radius: 50%;
    padding: 1%;
    text-transform: uppercase;
    margin-right: 2%;
   /* padding-left: 2%;
    padding-right: 2%;*/
}
button.close {
    padding: 0;
    cursor: pointer;
    background: transparent;
    border: 0;
    z-index: 999;
    font-size: 30px;
    -webkit-appearance: none;
}
.progress-bar{
  width: 100% ;
}
.field-title {
    text-align: left!important;
    font-family: 'Regular'!important;
    font-size: 16px!important;
    color: #171717ed!important;
    margin-bottom: 10px!important;
}
.redactor-box {
    border: 5px #edeef0 solid;
    margin-bottom: 0!important;
}
#style-2::-webkit-scrollbar-track
{
    border-radius: 0px;
    background-color: transparent;
}
#style-2::-webkit-scrollbar
{
    width: 0px;
    background-color: transparent;
}
#style-2::-webkit-scrollbar-thumb
{
    border-radius: 0px;
    background-color:transparent;
}
.scrollbar2 {
  overflow-y: scroll;
  overflow-x: hidden;
}

.element-view-content:hover {
    opacity: 0.5 !important;
    cursor: pointer;
    /*padding: 135px 15px 60px 15px!important;*/
}
.element-view-content:hover .mock {
    color: white;
}
.element-view-content:hover:before{
  content: 'Click Here to Add / Edit';
    color: black;
    font-weight: 500;
    font-size: 23px;
    position: absolute;
    top: 45%;
    left: 36%;


}
.hoveredit
{
  position: absolute;
  width: 100%;
  height: 100%;
  top: 28px;
  background-color: rgb(230, 230, 230);
  opacity: 0.7;
  display: none;
}
.highlight {height: 12em; line-height: 12em;border: 1px dashed rgba(21, 20, 20, 0.52);}
.highlight2 {height: 3.4em; line-height: 3.4em;border: 1px dashed rgba(21, 20, 20, 0.52);}

ul.lay-ul2 {
  padding: 0;
  margin: 0;
  list-style: none;
  height: auto;
  /*overflow: auto;*/
  }
.not-active {
 pointer-events: none;
 cursor: default;
}
.overlay-imf-pdf {
  position: absolute;
  z-index: 1;
  display: block;
  width: 100%;
  height: 100px;
  background: rgba(8, 8, 8, 0.03);
  cursor: pointer;
}

.abc{
 border: 3px solid #5b9dd9; 
 cursor: pointer;
}
i.fa.fa-check-square {
   position: absolute;   
   left: 91px;
   font-size: 20px;
   color: #5b9dd9;
}

/*form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }*/
.progressBar {
    width: 200px;
    height: 18px;
    background-color: orange;
    display: none;
}

.progressBar #bar, #bar_gallery, #bar_video, #bar_audio, #bar_pdf, #bar_flash {
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

#progress {     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 21px;
}
#progress_gallery{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_video{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_audio{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_pdf{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_pdf{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
#progress_flash{     
  position: relative;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 10px; 
    top: 14px;
}
/*#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }*/
#percent, #percent_gallery, #percent_video, #percent_audio, #percent_pdf, #percent_flash { 
  position: relative;
    display: inline-block;
    top: -14px;
    left: 50%;
    color: black;
 }
/*#progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
#percent { position:absolute; display:inline-block; top:3px; left:48%; }*/

.img-pop-active {
    -webkit-box-shadow: inset 0 0 0 3px #fff,inset 0 0 0 7px #0073aa;
    box-shadow: inset 0 0 0 3px #fff,inset 0 0 0 7px #0073aa;
} 
.fileinput .btn {
    vertical-align: middle;
}
.btn-file {
    overflow: hidden;
    position: relative;
    vertical-align: middle;
}

.fileinput-exists .fileinput-new, .fileinput-new .fileinput-exists {
    display: none;
}
.btn-file > input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    opacity: 0;
    filter: alpha(opacity=0);
    transform: translate(-300px, 0) scale(4);
    font-size: 23px;
    direction: ltr;
    cursor: pointer;
}
input[type="file"] {
    display: block;
}
.jconfirm .jconfirm-box div.title {
  background: transparent;
  font-size: 18px;
  font-weight: 600;
  font-family: inherit;
  padding: 10px 15px 10px;
  text-align: center;
  display: block;
  color: #c42140;
  text-transform: uppercase;
  font-size: 21px!important;
  font-weight: bold;
  text-align: center!important;
  padding: 17px 30px 0 13px !important;
  border-bottom: 0px!important;
  margin-top: 0px!important;
  background-color: #f1f1f1!important;
  height: 73px!important;
}
.jconfirm .jconfirm-box div.content {
  padding: 0px;
  text-align: center;
  font-size: 15px;
  margin: 4% 0px 2%;
  font-weight: bold!important;
}
button.btn.btn-success {
  background-color: #04A600!important;
}
.dragboxhide{
  margin-top: -15px;
  color: black;
}
/*.element-view-content img{
  width: auto !important;
}*/
@media(max-width:480px){
.page-body .page-container {
  padding-left: 0;
  top: 0;
  bottom: 0;
  position: fixed;
  overflow-y: scroll;
}
.page-body .page-container .main-content{
  max-width: 1000px;
  min-width: 1000px;  
}
#cart2 {
  width: 75%;
  float: right;
}
.sidebar-nav{
   float: left; 
}
#column_1 {
  width: 100%;
}
.page-container .sidebar-menu .sidebar-user-info .user-link img{
   max-width: 80px; 
}
.col-md-12 .element-view-content {
  width: 93.5%!important;
}
.col-md-3 .element-view-content {
  width: 93%;
}
.col-md-6 .element-view-content {
  width: 93%;
}
.col-md-4 .element-view-content {
  width: 93%;
}
.col-md-8 .element-view-content {
  width: 93%;
}
}
</style>

<script>	 
   jQuery(document).ready(
		function()
		{
			//jQuery('#description').redactor();
			jQuery('#lec_content').redactor({
			        focus: true,
			        imageUpload: window.location.origin+'/admin/tasks/getImage',
			        'plugins': ['fontsize','fontcolor','fontfamily','video','imagelink'],
	                
			});
			// jQuery('.texteditorfield').redactor({
			//         focus: true,
			//         imageUpload: window.location.origin+'/admin/tasks/getImage',
			//         'plugins': ['fontsize','fontcolor','fontfamily','video','imagelink'],
	                
			// });

		}
	);
</script>

	<style type="text/css">

body {
  overflow-x: hidden;
}

.btnFloat
{
	display: inline-block;
	float: left;
	  margin: 10px 4px 2px 0;
}
		.fancybox-custom .fancybox-skin {

			box-shadow: 0 0 50px #222;

		}


      .error{



      	color: red;



      	font-size:13px;



      }
      .ptext
      {
  display: block;
  float: right;
  width: 31.5%;
  margin-top: -5px;
  padding: 10px;
      }
.redactor_box {
  min-height: 500px;
}
	</style>

 <script type="text/javascript">
 jQuery(function(){
   jQuery("#forward").click(function() {
   window.parent.location.href = "<?php echo base_url(); ?>admin/days/<?php echo $pid?>";

    });

    	});

</script>

<div class="main-container">

<?php



	$attributes = array('class' => 'tform', 'id' => 'proform');

echo form_open_multipart(base_url().'programs/uploadAssign', $attributes);


//echo ($updType == 'create') ? form_open(base_url().'admin/tasks/create', $attributes) : form_open(base_url().'admin/tasks/edit/'.$task->tid.'/'.$did.'/'.$pid, $attributes);



?>



<style>

</style>


<div class='uname' style='display:none'><?php echo $instuctor; ?></div>
<div id="toolbar-box">



	<div class="m top_main_content">



		<div id="toolbar" class="toolbar-list">


			<div id="sticky-anchor"></div>
			<ul id="sticky" class="main-content-btn" style="list-style: none; float: right;">

			 <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">

			 	<!-- <a id="preview_btn" onclick="lecture_preview();" class="btn btn-success btn-blue" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Lecture Preview</a> -->
<!--         <a id="preview_btn" onclick="openmyModalpreview();" class="btn btn-success btn-blue" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Lecture Preview</a>
 -->   <button type="button" class="btn btn-success btn-blue" onclick="preview11()" id="myBtn"  >Preview Assignment</button>

    			<a>

			<?php 
				if($updType == 'edit')
				{
			?>
				<a  class='btn btn-primary btn-blue' id="inform_btn" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Save and Inform</a>

			<?php
					
				} 
				?>	

				</a>
				</li>



                <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



    			<!-- <a>



    			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'  ") ); ?>



    			</a> -->
          <?php  $sec_id = $this->uri->segment(4);
            $pro_id = $this->uri->segment(5); 

             ?>
                          <img id='loading' style='display:none;width:30px;' src="http://loadinggif.com/images/image-selection/3.gif">
			<a><input type="button" id='lecture_save' id='subtn' name="lecture_save" class='btn btn-success btn-green' value="Save" onclick="save_assignment('<?php echo $sec_id;  ?>','<?php echo $pro_id;  ?>','<?php echo $course_name->name; ?>')" ></a> 

    			</li>



    			<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



    			<a href='<?php echo base_url(); ?>admin/section-management/<?php echo $pid?>' class='btn btn-danger btn-dark-grey' id="forward"><span class="icon-32-cancel"> </span>Close</a>



    			</li>



			</ul>



			<div class="clr"></div>



		</div>



<div class="pagetitle"><h2><?php echo ($updType == 'create') ? "Create Assignment" : "Edit Assignment";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2></div>



	</div>


	<div id="inform_txt">
		<textarea style="width: 29%; height: 81px; margin-left: 731px;" name="inform_msg" id="inform_msg"  placeholder="Enter information about modification and Click on Save button."   class="form-control"></textarea>
	</div>



</div>



<div>
<br />


</div>




<div class="row">
<div class="col-md-6" style="width: 100%;">
  <ul class="nav nav-tabs bordered grey-border blue-border">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active" style="border-left:none;"> 
    <a href="#INFO" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-home"></i></span> 
    <span class="hidden-xs">BASIC INFO</span> 
    </a> 
    </li>
    <li> 
    <a href="#instruction" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-user"></i></span> 
    <span class="hidden-xs">INSTRUCTIONS</span> 
    </a> 
    </li>
    <li>    
    <a href="#question" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-user"></i></span> 
    <span class="hidden-xs">QUESTIONS</span> 
    </a> 
    </li>
  </ul>

  <div class="tab-content tab-box">
   
   
    <div class="tab-pane active" id="INFO">
      <dd class="" sno="1">
        <div class="tab-content">
        
        <hr />
        <!-- form assignment -->
        <div class="form-group">
            
                        <label class='col-sm-12 no-left-padding control-label field-title' for="name"><?php echo lang('web_name')?> <span class="required">*</span></label>
            
            <div class="col-sm-12">              
                            
                        <input class="form-control form-height" id="name" type="text" name="assign_title" maxlength="256" value="<?php echo set_value('assign_title', (isset($program->assign_title)) ? $program->assign_title : ''); ?>"  title="Enter Assignment Name"  data-validation="required" /> 
                        <span id="cname" class="error" style="color: red"><?php echo form_error('name'); ?></span>
                            
            </div>
        </div>

         <div class="form-group" id="ass_dis" >           
            <label class='col-sm-12 no-left-padding control-label field-title' for="description"><?php echo lang('web_description')?><span class="required">*</span></label>           
      <div class="col-sm-12">
        <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>
                <textarea style="display:none" name="assign_description" data-validation="required"  id="assign_description" class="form-control form-height adminform" rows="6"> </textarea>
                <textarea  name="assign_description1" data-validation="required"  id="description" class="form-control form-height adminform texteditorfield" rows="6"><?php echo ($this->input->post('assign_description')) ? $this->input->post('assign_description') : ((isset($program->assign_description)) ? $program->assign_description : '');?></textarea>
                <input name="image" type="file" id="upload1" class="hidden hide_img" onchange="">
                <span id="descriptionerror" class="error" style="color: red"><?php echo form_error('description'); ?></span>
      </div>
    </div>

    <div class="form-group">
        
                <label class='col-sm-12 no-left-padding control-label field-title' for="time"><?php echo "Estimated Duration"; ?></label>
        
        <div class="col-sm-10">              
                    
                <input class="form-control form-height" id="time"  placeholder="Enter duration" name="estimated_time" maxlength="256" value="<?php echo set_value('estimated_time', (isset($program->estimated_time)) ? $program->estimated_time : ''); ?>"  title="Enter Estimated Time"  data-validation="required" />  
                <span id="cname" class="error" style="color: red"><?php echo form_error('name'); ?></span>
                    
        </div>
    </div>
  </div>
        <!-- end form -->
        <!-- new code start form here -->

        <!-- third  strat-->

			  
			      <div id="sticky-anchor1"></div>
			     
<!-- third  end-->

        <!-- new code end here -->
      </dd>
      <div style="clear:both;"></div>
    </div>

    <div class="tab-pane" id="instruction">
      <dd class="" sno="2">
        <div class="tab-content">

         <div class="form-group" > <hr>           
            <label class="col-sm-12 control-label field-title" for="description"><?php echo "Assignment Instructions :"?><span class="required">*</span></label>           
            <br>
            <div class="col-sm-12">
                <textarea style="display:none" name="assign_instruction" data-validation="required"  id="assign_instruction" class="form-control" rows="6"> </textarea>
                <textarea  name="assign_instruction1" data-validation="required"  id="instruction" class="form-control texteditorfield" rows="6"><?php echo ($this->input->post('assign_instruction')) ? $this->input->post('assign_instruction') : ((isset($program->assign_instruction)) ? $program->assign_instruction : '');?></textarea>
                <input name="image" type="file" id="upload" class="hidden" onchange="">
                <span id="descriptionerror" class="error" style="color: red"><br/><?php echo form_error('description'); ?></span>
            </div>
         </div> 

         <div id="video">
            <div class="form-group">
              
                      <label class='col-sm-3 no-padding control-label field-title' for="time"><h4><?php echo "Have Any Instruction Video?"; ?></h4></label>
            
             <div class="col-sm-6">
           
                <input type="file" name="video" onchange="getfile()"  accept="audio/*,video/*" class="filevideo choose-file" data-icon="true" id="filestyle-0"  style="position: absolute; clip: rect(0px 0px 0px 0px);">
                <div class="bootstrap-filestyle input-group">
                  <input type="text" name="Instvideo" id="getname" style="display:none" class="form-control form-height" value=""> 
                  
                  <label for="filestyle-0" class="btn btn-info uploadbutton " >
                    <span class="buttonText">Choose file</span>
                  </label></div>
              </div>
            </div>
          </div>

          <br><br>
          <div class="linkedfile">  </div>

          <div id="resources">
           <div class="form-group">
        
                <label class='col-sm-3 no-padding control-label field-title' for="time"><h4><?php echo "Have Any Resource File?"; ?></h4></label>
      
              <div class="col-sm-6">
                      <input  type="file"  name="src_file" onchange="getfileResource()"  accept="image/*,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/plain,text/html,text/*,.pdf,.doc,.docx" class="fileResource"  id="filestyle-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
                      <div class="bootstrap-filestyle input-group">
                        <input type="text" name="InstResource" id="getnameResource" class="form-control" style="display:none" value=""> 
                        
                        <label for="filestyle-1" class="btn btn-info uploadbutton " >
                          <span class="buttonText">Choose file</span>
                        </label>
                      </div>
                </div>
              </div>
          </div>
             
        </div>
      </dd>
            <div style="clear:both;"></div>
    </div>

 <div class="tab-pane" id="question">
      <dd class="" sno="3">
        <div class="tab-content">
          <hr>
         <div class="panel-heading"> 
            <div class="panel-title que_para" style="  float: none;"><h3>HERE TO ADD ASSIGNMENT QUESTIONS !</h3></div> 
         </div> 
      
      <div class="panel-body form-horizontal form-groups-bordered">
        <div class="QuesList"></div>
      <div class="form-group" > <hr>          
            <label class="col-sm-3 control-label field-title" for="description"><?php echo "Enter Question :"?></label>           
      <div class="col-sm-12">
        <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($program->description)) ? $program->description : ''));?>

                <textarea  name="assign_qestions" data-validation="required"  id="ques" class="form-control texteditorfield" rows="6"><?php echo ($this->input->post('assign_instruction')) ? $this->input->post('assign_instruction') : ((isset($program->assign_instruction)) ? $program->assign_instruction : '');?></textarea>
                <input name="image" type="file" id="upload" class="hidden" onchange="">
       
                <span id="descriptionerror" class="error" style="color: red"><br/><?php echo form_error('description'); ?></span>
         <div class='quefiles'></div>
<!--         <i class="fa fa-spinner fa-spin loader" style="font-size:24px;display:none;"></i>
 -->         <div style='float:right' class="bottom_assgnmt_btn">
          <span class='attachment' >
            <label for="filestyle-2" class="btn btn-info uploadbutton">
              <span > Add Attachment</span>
            </label>
              <input type="file" name="Que_f" onchange="Quefile()"   class="Quefile" data-icon="true" id="filestyle-2"  style="position: absolute; clip: rect(0px 0px 0px 0px);">
         </span>
          <input type='submit' id='upQattach' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>
              <div id='progress_Qattach' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Qattach' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Qattach'></div></div></div></span>

          <button type="button" class="btn btn-success" onclick="QueAdd()"> Submit </button>
        </div>
               
        
<!--              <button type="button" class="btn btn-danger" onclick="QueClear()"> Reset </button>
 -->      </div>
      </div>
              
    </div> 


        
             
        </div>
      </dd>
            <div style="clear:both;"></div>
    </div>

    
    
  </div>
</div>
</div>
<div class="modal fade in" id="myModal" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-head">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h3>Assignment : <span id="title"> </span> </h3>
        </div>
        <div id="start_ass" style="display:inline-block; padding:0%; overflow-y:auto">
          <br>
            <a id="timegiven" ></a>
            
            <!-- <h4 id="assign_desc"></h4>
            <br> -->
        </div>
        <div id="wrapper" style="display:none"> 
          <div class="modal-header assgnmt_progress">
              <div class="progress_circle">
                <span class='bartext'>Instruction</span><br>
                <span class='baricon'>1</span>
                <span id="bar1" class='progress_bar'></span>
              </div>
              <div class="progress_circle">
                <span class='bartext'>submission</span><br>
                <span class='baricon'>2</span>
              <span id="bar2" class='progress_bar'></span>
              </div>
              <div class="progress_circle">
                <span class='bartext'>Instructor Example</span><br>
                <span class='baricon'>3</span>
              </div>
              <br>
          </div>
          <div class="modal-body assgnmt_body" id="style-1">
        
        <div id="instruct">
         <h2>Assignment Instructions<br></h2>
        <!--  <a id="timegiven" ></a> -->
<!--       <input class="btn btn-info btn2" id="next1" type="button"  value="Next" onclick="show_next('instruct','submission','bar1');">
 -->      <br>
        </div>

        <div id="submission">
          <div class="assgnmt_grp_btn">
           <!--  <h3>Assignment Submission</h3> -->
            <div class="fixed_btn">
              <!-- <input  class="btn btn-info btn1" type="button" value="Previous" onclick="show_prev('instruct','bar1');">
              <input class="btn btn-info btn2" type="button" value="Next" onclick="show_next('submission','instructor_ex','bar2');">
             --></div>
          </div>
            <p><h2>Assignment Submission</h2>Submit you work | <span id='status_ass' style='display:none' class='assgnmt_submit'> Assignment Submitted</span></p>
        </div>
          
        <div id="instructor_ex">
        <div class="assgnmt_grp_btn">
          <h3>How did you do?</h3>
          <div class="fixed_btn">
<!--              <input class="btn btn-info btn2" type="button" value="Previous" onclick="show_prev('submission','bar2');">
 --><!--              <input class="btn btn-success" type="Submit" value="Submit">
 -->          </div>
        </div> 
          <p>Compare the instructor's example to your own</p>
      <div id='alertsubmit'><div class="alert alert-info">
            <strong >You haven't submitted your assignment!</strong>
          </div></div>
        </div>
        <!-- </form> -->
      </div>
       </div>
          <div class="modal-footer">
            <input class="btn btn-info btn2" id="pre2"  style="display:none" type="button" value="Previous" onclick="show_prev('submission','bar2');">
            
            <input  class="btn btn-info btn1"  id="pre1"  style="display:none" type="button" value="Previous" onclick="show_prev('instruct','bar1');">
            <input class="btn btn-info btn2"  id="next2"  style="display:none" type="button" value="Next" onclick="show_next('submission','instructor_ex','bar2');">
           
            <input class="btn btn-info btn2" id="next1" style="display:none" type="button"  value="Next" onclick="show_next('instruct','submission','bar1');">
            
            <button  type="button" id='btn-start' onclick="start_assign()">Start assignment</button>
<!--            <button type="button" class="btn btn-default close" style="float:left">Close</button>
 -->          </div>
       
      </div>
    </div>
  </div>

</div> 

<?php echo form_close(); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
 <script>
 $(document).ready(function(){

var isVisible = $("#ass_dis").find('div').is('.mce-tinymce');
  if(isVisible == false)
  {
   tinymce.init({
    selector : ".texteditorfield",
  plugins: [
  "eqneditor advlist autolink lists link image charmap print preview anchor",
  "searchreplace visualblocks code fullscreen",
  "insertdatetime media table contextmenu paste" ],
  toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
    image_title: true,
    automatic_uploads: true,
    images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
    file_picker_types: 'image',
     image_advtab: true, 
    file_picker_callback: function(callback, value, meta) {
          if (meta.filetype == 'image') {
            $('#upload').trigger('click');
            $('#upload').on('change', function() {
              var file = this.files[0];
              var reader = new FileReader();
              reader.onload = function(e) {
                callback(e.target.result, {
                  alt: ''
                });
              };
              reader.readAsDataURL(file);
            });
          }
        },

});
}
});
</script>
<script type="text/javascript">
var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
 btn.onclick = function() {
    // function preview11() {
    
    $('#next1').css('display','none');
    $('#pre1').css('display','none');
    $('#pre2').css('display','none');
    $('#next2').css('display','none');
    $('#btn-start').css('display','block');
    $('#start_ass').css('display','block');
    $('#instruct').css('display','none');
    $('#submission').css('display','none');
    $('#wrapper').css('display','none');
 
               modal.style.display = "block";
        var name = $('#name').val();
      $('#title').text(name);
       $('#status_ass').css('display','none');
      var description = tinymce.get('description').getContent();
      if(description)
      {
        var str = "<div id='descview'>"+description+"</div>";
        var isVisible = $('#start_ass').find('div').is('#descview');
         if(isVisible == false)
         {
           $("#start_ass").append(str); 
         }
         else
         {
          $('#start_ass').find('#descview').remove();
          $("#start_ass").append(str);
         }
      }
      else
      {
        $('#start_ass').find('#descview').remove();
      }
      //$('#assign_desc').html($(description).text());

       var time = $('#time').val();
       if(time){
        $('#timegiven').html('<b>Duration: </b> &nbsp '+time+' to complete');
       }

       var video = $('.filevideo').val();
       if(video){
        var video =  video.substring(12);

        var str = "<div id='video11' ><center><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+video+"' type='video/mp4'></video></center><br></div>";
        var isVisible = $('#instruct').find('source').is('#r_video');
         if(isVisible == false)
         {
          $("#instruct").append(str); 
         }
         else{
          $('#instruct').find('#video11').remove();
           $("#instruct").append(str);
         }
        //$j('#r_video').attr('src','<?php echo base_url() ?>public/images/'+video);
       }
       else
       {
        $('#instruct').find('#video11').remove();
       }

       var instruction =tinymce.get('instruction').getContent();
       if(instruction)
       {
        var str = "<div id='instview'><br>"+instruction+"</div>";
         var isVisible = $('#instruct').find('div').is('#instview');
         if(isVisible == false)
         {
           $("#instruct").append(str); 
         }
         else
         {
          $('#instruct').find('#instview').remove();
          $("#instruct").append(str);
         }
      }
      else
      {
        $('#instruct').find('#instview').remove();
      }

      var count =0;
      
      $(".QuesList").find('.Qlist').each(function(){
        count++;
      });
      var str = "<div id='Queview'><b>Questions for this Assignment</b><br><br>";
      for (var i = 1; i <= count; i++) {
        var Qtext = $('#Qcontent_'+i).text();
            str += "<b> "+i+". "+Qtext+"</b><br>";
            
            var attvisible = $(".QuesList").find('.Qlist').find('#Qatt_'+i).is(':visible');
            if(attvisible == true)
            {
              var filename = $(".QuesList").find('.Qlist').find('#Qatt_'+i).find('#attname_'+i).text();
              var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();   
               var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
               str += "<div id='srcview_"+i+"'>";
              
              if ($.inArray(arr, fileExtension) >= '1')
              { 
                  str += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
              //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
              }
              
              else{
                var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

                  if($.inArray(arr, videoExtension) >= '1')
                  {  
                      str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
                  }
                  else
                  {
                    str += "<br><a>"+filename+"</a></div>";
                  }
              }
            }

      };

        str += "<br></div>";
       
      if(count > 0)
      {
         var isVisible = $('#instruct').find('div').is('#Queview');
         if(isVisible == false)
         {
           $("#instruct").append(str); 
         }
         else
         {
          $('#instruct').find('#Queview').remove();
          $("#instruct").append(str);
         }
      }
      else
      {
        $('#instruct').find('#Queview').remove();
      }

      
      //instruct
       var r_file = $('.fileResource').val();
       if(r_file)
       {
        var r_file =  r_file.substring(12);
         var arr =  r_file.substring(r_file.lastIndexOf('.') + 1).toLowerCase();
       
      // console.log(arr[1]);
         var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
          var str = "<div id='srcview'>";
        if ($.inArray(arr, fileExtension) >= '1')
        {
            str += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+r_file+"'></center><br>";         
        //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
        }
        
        else{
          var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

              if($.inArray(arr, videoExtension) >= '1')
              {  
                  str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+r_file+"' type='video/mp4'></video></center><br>";
              }
           else{
            str += "<br><a>"+r_file+"</a>";
            }
        }
          str += "</div>";

          var isVisible = $('#instruct').find('div').is('#srcview');
         if(isVisible == false)
         {
           $("#instruct").append(str); 
         }
         else
         {
          $('#instruct').find('#srcview').remove();
          $("#instruct").append(str);
         }
      }
      else
      {
        $('#instruct').find('#srcview').remove();
      }

      //submission
      var str = "<div id='submitview'><b>Questions for this Assignment</b><br>";
      for (var i = 1; i <= count; i++) 
      {
        var Qtext = $('#Qcontent_'+i).text();
            str += "<b> "+i+". "+Qtext+"</b> <br>";

            var attvisible = $(".QuesList").find('.Qlist').find('#Qatt_'+i).is(':visible');
            if(attvisible == true)
            {
              var filename = $(".QuesList").find('.Qlist').find('#Qatt_'+i).find('#attname_'+i).text();
            var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
             var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
              
               str += "<div id='srcview_"+i+"'>";
              
               if ($.inArray(arr, fileExtension) >= '1')
              {
                  str += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
              //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
              }
             
              else{
                 var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

              if($.inArray(arr, videoExtension) >= '1')
              {  
                  str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
              }
              else{    
                str += "<br><a>"+filename+"</a></div>";
                }
              }
            }

            str += "<div class='textview' id='textview_"+i+"' ><textarea class='col-sm-5 Ansview'  name='ansview[]' id='ansview_"+i+"' style=' width: 40.5%;' placeholder='Add your submission' ></textarea>";
            str += "<div id='stuansfiles_"+i+"'></div><span class='stuAttachment' id='stuAttachment_"+i+"'><label for='stufilestyle_"+i+"' class='btn btn-info uploadbutton ' >Add Attachment</label>";      
            str += "<input type='file' name='stu_Att[]' onchange='stuAnsfile(this)'  class='stu_Att' data-icon='true' id='stufilestyle_"+i+"'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span></div>";
            str += "<div class='subview' id='subview_"+i+"' style='diaplay:none' ></div>";
            // str += "<br><button type='button' id='addsubans_"+i+"' onclick='addstuans()' >ADD</button></div>";
            str += "<div id='progress_stuattach_"+i+"' class=' progress progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_stuattach_"+i+"' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div class='percent-bar' id='percent_stuattach_"+i+"'></div></div></div>";

      };
        str += "<button type='button' class='subconfirm btn btn-success' onclick='submit_confirm()' style='float:right' >Submit</button></div>";
      if(count > 0)
      {
         var isVisible = $('#submission').find('div').is('#submitview');
         if(isVisible == false)
         {
           $("#submission").append(str); 
         }
         else
         {
          $('#submission').find('#submitview').remove();
          $("#submission").append(str);
         }

         
        $('.Ansview').redactor({
              focus: true,
              imageUpload: window.location.origin+'/tasks/getImage', 
              fileUpload: window.location.origin+'/admin/widgets/getImage',                
      });
    
      
    }
      else
      {
        $('#submission').find('#submitview').remove();
      } 

  }

  function start_assign()
  { 
    $('#instruct').css('display','block');
    $('#submission').css('display','none');
    $('#instructor_ex').css('display','none');
    $('#next1').css('display','block');
    $('#pre2').css('display','none');
    $('#btn-start').css('display','none');
    $('#start_ass').css('display','none');
    $('#wrapper').css('display','block');

  
  }

   // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        $('#start_ass').css('display','block');
    $('#wrapper').css('display','none');
    $('#btn-start').css('display','block');
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

     function submit_confirm()
    {
      var strcontent1 ='<center><h4 style="padding:5%;">You will not able to edit after you submit.</h4></center>';
      
      $j.confirm({
         title: "Are you sure?",
      content: strcontent1,
        confirmButton: 'submit',
     confirm: function()
                 {  
                  submit_ans();
                 },
     cancel: function()
            {
              return true;
            }
             });
    }

   
    function submit_ans()
    {
      $('#instructor_ex').find('#alertsubmit').css('display','none');
      var count =0;
      
      $(".QuesList").find('.Qlist').each(function(){
        count++;
      });
      var instuct = $('.uname').text();
     // var chr = instuct.charAt(0);
      var ele_name = instuct.split(' ');
          var chr = ele_name[0].charAt(0);
          if(ele_name.length > 1)
          {
           chr += ele_name[1].charAt(0);
          }
        var str2 = "<div class='InstructorView' id='instrutorsubmitview' ><br><b>Instructor Examples</b><h4 style='color: #4985b8;'><span class='nameicon'>"+chr+"</span>"+instuct+"</h4><br>";
        var str = "<div class='InstructorView' id='yoursubmitview' ><br><b>Your Submission</b><h4 style='color: #4985b8;'><span class='nameicon'>"+chr+"</span>"+instuct+"</h4><br>";


      for (var i = 1; i <= count; i++) 
      {
      //$('.Ansview').css('display','none');
        var content = $("#submitview").find("#textview_"+i).find(".redactor-editor").text();

        var Instructcontent= $('#Q_'+i).find('#ansdiv_'+i).find('#Qanswer_'+i).html();

        $('#submitview').find('#subview_'+i).text(content);

        var Qtext = $('#Qcontent_'+i).text();
         
            str2 += "<b> "+i+". "+Qtext+"</b><br>";
            
             var attvisible = $(".QuesList").find('.Qlist').find('#Qatt_'+i).is(':visible');
            if(attvisible == true)
            {
              var filename = $(".QuesList").find('.Qlist').find('#Qatt_'+i).find('#attname_'+i).text();
             var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
             var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
              
               str2 += "<div id='srcview_"+i+"'>";
              
               if ($.inArray(arr, fileExtension) >= '1')
              {
                  str2 += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
              //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
              }
             
              else{
                 var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

              if($.inArray(arr, videoExtension) >= '1')
              {  
                  str2 += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
              }
              else{
                  str2 += "<br><a>"+filename+"</a></div>";
                }
              }
            }

             if(Instructcontent)
            {               
              str2 += "<div><br>"+Instructcontent+"</div><br>";

                   var attvisible = $(".QuesList").find('.Qlist').find('#Afile_'+i).is(':visible');
                  if(attvisible == true)
                  {
                    var filename = $(".QuesList").find('.Qlist').find('#Afile_'+i).find('#admin_ans_att_'+i).text();
                   var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                   var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                    
                     str2 += "<div id='srcview_"+i+"'>";
                    
                    if ($.inArray(arr, fileExtension) >= '1')
                    {
                        str2 += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
                    //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                    }
                    
                    else{
                      var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

                    if($.inArray(arr, videoExtension) >= '1')
                    {  
                        str2 += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
                    }
                    else{
                        str2 += "<br><a>"+filename+"</a></div>";
                      }
                    }
                  }

              }

             str += "<b> "+i+". "+Qtext+" </b><br>";
             if(content)
            {               
              str += "<div class='subcontent' ><br>"+content+"</div><br>";

              var attvisible = $("#submission").find('#submitview').find('#stufile_'+i).is(':visible');
                  if(attvisible == true)
                  {
                    var filename = $("#submission").find('#submitview').find('#stu_ans_att_'+i).text();
                   var arr =  filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
                   var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                    
                     str += "<div id='srcview_"+i+"'>";
                    
                     if ($.inArray(arr, fileExtension) >= '1')
                    {
                        str += "<br><center><img id='r_file' max-width='420' max-height='280' src='<?php echo base_url() ?>public/images/"+filename+"'></center><br></div>";         
                    //$j('#r_file').attr('src','<?php echo base_url() ?>public/images/'+r_file);
                    }
                    
                    else{
                      var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

                    if($.inArray(arr, videoExtension) >= '1')
                    {  
                        str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+filename+"' type='video/mp4'></video></center><br>";
                    }
                    else{
                        str += "<br><a>"+filename+"</a></div>";
                      }
                    }
                  }
            }
      };
      $('#submitview').find('.textview').css('display','none');
      
      $('#submitview').find('.subview').css('display','block');

      $('#submitview').find('.subconfirm').css('display','none');
      $('#status_ass').css('display','block');

      //instructor ex

      // var str = "<div id='yoursubmitview' style='box-shadow: 0 0 1em silver;padding:2%;'><br><b>Your Submission</b><br><br>";
      // for (var i = 1; i <= count; i++) 
      // {
      //   var Qtext = $j('#Qcontent_'+i).text();
      //       str += "<b> "+i+".</b> "+Qtext+"<br>";
      //       var cont = $('#submitview').find('#subview_'+i).text();
      //       console.log(cont);
      //       if(cont)
      //       {
      //         str += "<div>"+cont+"</div><br>";
      //       }
      // };

      if(count > 0)
      {
        var isVisible2 = $('#instructor_ex').find('div').is('#instrutorsubmitview');
         if(isVisible2 == false)
         {
           $("#instructor_ex").append(str2); 
         }
         else
         {
          $('#instructor_ex').find('#instrutorsubmitview').remove();
          $("#instructor_ex").append(str2);
         } 

         var isVisible = $('#instructor_ex').find('div').is('#yoursubmitview');

         if(isVisible == false)
         {
            $("#instructor_ex").append(str); 
         }
         else
         {
          $('#instructor_ex').find('#yoursubmitview').remove();
          $("#instructor_ex").append(str);
         }    
      }
      else
      {
        $('#instructor_ex').find('#yoursubmitview').remove();
        $('#instructor_ex').find('#instrutorsubmitview').remove();
      } 
    }
</script>

 

<!-- tool tip script -->

<script type="text/javascript">


jQuery(document).ready(function(){

	jQuery('.tooltipicon').click(function(){

	var dispdiv = jQuery(this).attr('id');

	jQuery('.'+dispdiv).css('display','inline-block');

	});

	jQuery('.closetooltip').click(function(){

	jQuery(this).parent().css('display','none');

	});

	});

</script>
<!-- tool tip script finish -->

<script>
   
   jQuery(document).ready(
		function()
		{
			jQuery('#inform_txt').hide();
		});

	jQuery('#inform_btn').click(function() {

		jQuery('#inform_txt').toggle();
	});
	
</script>

<script>
var $ =jQuery.noConflict();
function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        $('#sticky').addClass('stick');
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});
</script>


<link rel="stylesheet" href="<?php echo base_url(); ?>/public/colorbox-master/example1/colorbox.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>/public/colorbox-master/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				
				//$(".iframe").colorbox({iframe:true, width:"800px", height:"600px"});				
				
			});
		</script>

	




<script type="text/javascript">
	$(document).ready(function() 
	{
	//$('.sidebar-collapse').find('a').click();
	
	$('div.sidebar-collapse').remove();
	$('.page-container').addClass('sidebar-collapsed');
	
    });
</script>

<script type="text/javascript">

 function sticky_relocate1() {
    var window_top = $(window).scrollTop();
    var div_top = $('#sticky-anchor1').offset().top;
    if (window_top > div_top) {
        $('#sidebar').addClass('stick');
    } else {
        $('#sidebar').removeClass('stick');
    }
}

$(function () {
    $(window).scroll(sticky_relocate1);
    sticky_relocate1();
});

// $(document).ready(function() {
//     var s = $("#sidebar");
//     var pos = s.offset().top;  

//     $(window).scroll(function() {
//         var windowpos = $(window).scrollTop() ;

//         if(windowpos + $(window).height() == $(document).height()){
//             s.removeClass('stick');
//         }else if(windowpos >= pos){
//             s.addClass('stick');
//         }else{
//             s.removeClass('stick');
//         }
//     });
// });   
</script>



<script src="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.css" rel="stylesheet" />



  <script src='<?php echo base_url(); ?>/public/js/tinymce/tinymce.min.js'></script>

  <script>
   tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent ",
selector : "#paragraph"
});
</script> 
<script type="text/javascript">
function QueAdd()
{

  var Que =tinymce.get('ques').getContent();

 //var Que = $('.redactor-editor').text();
 
  var isVisible =  $(".quefiles").find('.Qfile').is(':visible');

  if(Que)
  {
    $('.loader').show();
    var count =0;
      
      $(".QuesList").find('.Qlist').each(function(){
        count++;
      });
  
    var no = count+1 ;  
    var str = "<div id='Q_"+no+"'  class='Qlist'>";
    if(Que) 
    {  
      str += "<label class='form-group col-sm-2 control-label' style='width:190px'>Question "+no+": </label><div class='Qcontent' id='Qcontent_"+no+"' >"+Que+"</div>";
    }
 

      str += "<div class='questiondiv' id='questiondiv_"+no+"' >";
      str += "<textarea class='col-sm-5 Quetext'  name='question[]' id='Quetext_"+no+"' style='display:none; width: 40.5%;'>"+Que+"</textarea></div>";
      str += "<div id='QF_attach_"+no+"'></div>";
           if(isVisible == true) 
           { 
             str += "<div class='Q_attach' id='Qatt_"+no+"' ><button style='float:right; margin-top: -5px;display:none' id='Qremove_"+no+"' type='button' class='btn btn-danger' onclick='remove_Que_file(this)'  >X</button>";
             var att = $('.Quefile').val();
                 att = att.substr(12);
                 str += "<div id='attname_"+no+"' style='display:none'>"+att+"</div>";
                 str += "<input name='Q_att[]' id='Q_att_"+no+"' style='display:none' value='"+att+"'>";
                 var arr =  att.substring(att.lastIndexOf('.') + 1).toLowerCase();
                 var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                  if($.inArray(arr, fileExtension) >= '1')
                  {
                  str += "<br><img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+att+"' >";
                }
             
                else{
                    var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

                   if($.inArray(arr, videoExtension) >= '1')
                    {  
                        str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+att+"' type='video/mp4'></video></center><br>";
                    }
                    else{
                       str += "<a style='width:250px; word-wrap:break-word;' >"+att+"</a>";
                     }
                }
            
              str += "</div><br>";
           }
           else{
                str += "<div id='Qatt_value_"+no+"'><input name='Q_att[]' id='Q_att_"+no+"' style='display:none' value='"+no+"'></div>";
           }

      str += "<div class='ansdiv' id='ansdiv_"+no+"' style='display:none' ><label class='form-group col-sm-2 control-label'style='width:190px' >Your Answer : </label><div class='Qanswer' id='Qanswer_"+no+"' style='display:none' > </div>";
      
      str += "<textarea class='col-sm-offset-2 Anstext'  name='answer[]' id='Anstext_"+no+"' style='display:none; width: 40.5%;'> </textarea>"
     
      str += "<div id='ansfiles_"+no+"'><button style='display:none' id='remove_"+no+"' type='button' class='btn btn-danger cross_btn' onclick='remove_admin_file(this)'  >X</button></div>";
      str += "<span class='attachment_ans' id='attachment_ans_"+no+"'><label for='filestyle_"+no+"' class='btn btn-info uploadbutton ' >Add Attachment</label>";      
      str += "<input type='file' name='Ans_f' onchange='Ansfile(this)'  class='Ansfile' data-icon='true' id='filestyle_"+no+"'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span></div>";
      str += "<div id='progress_Ansattach_"+no+"' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Ansattach_"+no+"' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Ansattach_"+no+"'></div></div></div></span>";
      str += "<div id='ans_att_"+no+"' ><input name='ans_att[]' style='display:none' value='"+no+"'></div>";
      str += "<div class='btn_grp'>";
      str += "<button type='button' class='btn btn-info ans' id='Qans_"+no+"' style='margin-right:0.5%'  onclick='Addans(this)' ><i class='fa fa-clock-o'>Your Answer</i></button>";
      str += "<button type='button' class='btn btn-info Asubmit' id='Asubmit_"+no+"' style='margin-right:1%; display:none;' onclick='Addans(this)'><i class='fa fa-clock-o'>Save Answer</i></button>";
      str += "<button type='button' class='btn btn-success edit' id='Qedit_"+no+"' style='margin-right:1%' onclick='editQue(this)' ><i class='fa fa-clock-o'>Edit Question</i></button>";

      str += "<span style='display:none' class='attachment_Que' id='attachment_Que_"+no+"'><label for='Qfilestyle_"+no+"' class='btn btn-info uploadbutton ' >Add Attachment</label>";      
      str += "<input type='file' name='Que_file' onchange='Quefile2(this)'  class='Quefile2' data-icon='true' id='Qfilestyle_"+no+"'  style='position: absolute; clip: rect(0px 0px 0px 0px);'></span></div>"
      str +="<div id='progress_Queattach_"+no+"' class='progress progress-bar progress-bar-striped progress-bar-animated' style='display:none'><div id='bar_Queattach_"+no+"' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_Queattach_"+no+"'></div></div></div></span>";
      //str += "<div id='Que_att_"+no+"' ><input name='Q_att[]' style='display:block' value=''></div>";
      
      str += "<button type='button' class='btn btn-success submit' id='Qsubmit_"+no+"' style='margin-right:1%; display:none;' onclick='editQue(this)'><i class='fa fa-clock-o'>Submit Question</i></button>";
      str += "<button type='button' class='btn btn-danger delete' id='Qdelete_"+no+"' style='margin-right:1%' onclick='deleteQue(this)' ><i class='fa fa-clock-o'>Delete</i></button></div></div><hr>";
    $(".QuesList").append(str); 
    $(".quefiles").find('.Qfile').remove();
    $('.attachment').show();
     tinymce.get('ques').setContent(''); 
  // $('.redactor-editor').text('');
      $('.loader').hide();
    

  }
  else
  {
    validatepop('Question Required ','Question can`t be Blank!' );
          return false;
  }
}

function Addans(ele)
{

  var name = $(ele).attr('id');
  var ele_id = name.split('_');
  var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('div').is('.mce-tinymce');
  if(isVisible == false)
      {
        tinymce.init({
        selector : ".Anstext",
      plugins: [
      "eqneditor advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen",
      "insertdatetime media table contextmenu paste" ],
      toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
        image_title: true,
        automatic_uploads: true,
        images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
        file_picker_types: 'image',
         image_advtab: true, 
        file_picker_callback: function(callback, value, meta) {
              if (meta.filetype == 'image') {
                $('#upload').trigger('click');
                $('#upload').on('change', function() {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    callback(e.target.result, {
                      alt: ''
                    });
                  };
                  reader.readAsDataURL(file);
                });
              }
            },

    });
    
    $('#Qanswer_'+ele_id[1]).css('display','none');
    $('#Qans_'+ele_id[1]).css('display','none');
    $('#Qedit_'+ele_id[1]).css('display','none');

    $('#Asubmit_'+ele_id[1]).css('display','block');
     $('#ansdiv_'+ele_id[1]).css('display','block');

    $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
    $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('visibility','visible');
  //  alert('11');
     
    // if($('#remove_'+ele_id[1]).is(':visible'))
    //     {
    //         $('#remove_'+ele_id[1]).css('display','none');
    //     }
    //     else
    //     {
    //         $('#remove_'+ele_id[1]).css('display','block');
    //     }

      if($('#Afile_'+ele_id[1]).is(':visible'))
       {
         $('#remove_'+ele_id[1]).css('display','block');
          $('#attachment_ans_'+ele_id[1]).css('display','none');
        }
        else{
           $('#remove_'+ele_id[1]).css('display','none');
           $('#attachment_ans_'+ele_id[1]).css('display','block');
        }


  }
  else
  {
    //alert('22');
    var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').is(':visible');
    if(isVisible == true)
    {
      
      //$('#Qanswer_'+ele_id[1]).css('display','block');
      $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('display','none');
       $('#Qedit_'+ele_id[1]).css('display','block');
        $('#Asubmit_'+ele_id[1]).css('display','none');
        // $('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]).html("Edit answer");
       $('#Qans_'+ele_id[1]).css('display','block');

          var Quetext =tinymce.get('Anstext_'+ele_id[1]).getContent();
          //alert(Quetext);
          if(Quetext)
          {
            $('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]).html("Edit answer");
            $('#Qanswer_'+ele_id[1]).css('display','block');
            $('#ansdiv_'+ele_id[1]).css('display','block');
            $('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html(Quetext);
            $('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Anstext_'+ele_id[1]).text(Quetext);
          }
          else{
            $('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]).html("Your answer");
            $('#Qanswer_'+ele_id[1]).css('display','none');
            $('#ansdiv_'+ele_id[1]).css('display','none');
            //tinymce.get('Anstext_'+ele_id[1]).setContent('');
            // $('#Q_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html(Quetext);
          }

          $('#attachment_ans_'+ele_id[1]).css('display','none');
           if($('#Afile_'+ele_id[1]).is(':visible'))
          {
            if($('#remove_'+ele_id[1]).is(':visible'))
            {
                $('#remove_'+ele_id[1]).css('display','none');
            }
            else
            {
                $('#remove_'+ele_id[1]).css('display','block');
            }
          }
          
          
    }
    else{
      
       //$(this).find('#Qcontent_'+ele_id[1]).html(Quetext);

      //$('#Qanswer_'+ele_id[1]).css('display','none');
//alert('33');

       // if($('#remove_'+ele_id[1]).is(':visible'))
       //  {
       //      $('#remove_'+ele_id[1]).css('display','none');
       //  }
       //  else
       //  {
       //      $('#remove_'+ele_id[1]).css('display','block');
       //  }

     if($('#Afile_'+ele_id[1]).is(':visible'))
     {
      $('#remove_'+ele_id[1]).css('display','block');
        $('#attachment_ans_'+ele_id[1]).css('display','none');
      }
      else{
         $('#remove_'+ele_id[1]).css('display','none');
         $('#attachment_ans_'+ele_id[1]).css('display','block');
      }


      $(".QuesList").find('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
      $('#Qedit_'+ele_id[1]).css('display','none');
        $('#Asubmit_'+ele_id[1]).css('display','block');
        $('#Qans_'+ele_id[1]).css('display','none');

         var Answertext= $('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html();
         if(Answertext)
          {
            //$('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]).html("Edit answer");
            $('#Qanswer_'+ele_id[1]).css('display','none');
            $('#ansdiv_'+ele_id[1]).css('display','block');
            tinymce.get('Anstext_'+ele_id[1]).setContent(Answertext);
            // $('#Q_'+ele_id[1]).find('#Qanswer_'+ele_id[1]).html(Quetext);
            $('#Q_'+ele_id[1]).find('#ansdiv_'+ele_id[1]).find('#Anstext_'+ele_id[1]).text(Answertext);
          }
          else{
            $('#Q_'+ele_id[1]).find('#Qans_'+ele_id[1]).html("Your answer");
            //tinymce.get('Anstext_'+ele_id[1]).setContent(Answertext);
            $('#Qanswer_'+ele_id[1]).css('display','block');
            $('#ansdiv_'+ele_id[1]).css('display','none');
          }
         // alert(Questiontext);

    }
  }
}

function remove_admin_file(ele)
{ 
  var name = $j(ele).attr('id');
  var ele_id = name.split('_');
   $("#ansdiv_"+ele_id[1]).find('#Afile_'+ele_id[1]).remove();
    $('#remove_'+ele_id[1]).css('display','none');
   $('#attachment_ans_'+ele_id[1]).css('display','block');
}

function remove_Que_file(ele)
{ 
  var name = $j(ele).attr('id');
  var ele_id = name.split('_');
   $("#Qatt_"+ele_id[1]).remove();
    $('#Qremove_'+ele_id[1]).css('display','none');
   $('#attachment_Que_'+ele_id[1]).css('display','block');
  var str ="<div id='Qatt_value_"+ele_id[1]+"'><input name='Q_att[]' id='Q_att_"+ele_id[1]+"' style='display:none' value='"+ele_id[1]+"'></div>";
  $("#Q_"+ele_id[1]).find("#QF_attach_"+ele_id[1]).append(str);
}

function editQue(ele)
{
  // alert($(ele).attr('id'));
  var name = $(ele).attr('id');
  var ele_id = name.split('_');
   $('#Qcontent_'+ele_id[1]).css('display','none');
    $('#Qedit_'+ele_id[1]).css('display','none');
    $('#ans_'+ele_id[1]).css('display','none');
     $('#Qsubmit_'+ele_id[1]).css('display','block');

  var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('div').is('.mce-tinymce');

      if(isVisible == false)
      {
        tinymce.init({
        selector : ".Quetext",
      plugins: [
      "eqneditor advlist autolink lists link image charmap print preview anchor",
      "searchreplace visualblocks code fullscreen",
      "insertdatetime media table contextmenu paste" ],
      toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent fullscreen",
        image_title: true,
        automatic_uploads: true,
        images_upload_url: window.location.origin+'/admin/pagecreator/getImage',    //'postAcceptor.php',
        file_picker_types: 'image',
         image_advtab: true, 
        file_picker_callback: function(callback, value, meta) {
              if (meta.filetype == 'image') {
                $('#upload').trigger('click');
                $('#upload').on('change', function() {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    callback(e.target.result, {
                      alt: ''
                    });
                  };
                  reader.readAsDataURL(file);
                });
              }
            },

    });
    $('#Qans_'+ele_id[1]).css('display','none');
    $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
    $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('visibility','visible');

    if($('#Qatt_'+ele_id[1]).is(':visible'))
       {
         $('#Qremove_'+ele_id[1]).css('display','block');
          $('#attachment_Que_'+ele_id[1]).css('display','none');
        }
        else{
           $('#Qremove_'+ele_id[1]).css('display','none');
           $('#attachment_Que_'+ele_id[1]).css('display','block');
        }

  }
  else
  {  

    $('#attachment_Que_'+ele_id[1]).css('display','none');

          if($('#Qremove_'+ele_id[1]).is(':visible'))
          {
              $('#Qremove_'+ele_id[1]).css('display','none');
          }
          else
          {
              $('#Qremove_'+ele_id[1]).css('display','block');
          }

    var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').is(':visible');
    if(isVisible == true)
    {
      

      $('#Qcontent_'+ele_id[1]).css('display','block');
      $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('display','none');
       $('#Qedit_'+ele_id[1]).css('display','block');
        $('#Qsubmit_'+ele_id[1]).css('display','none');
        $('#Qans_'+ele_id[1]).css('display','block');

          var Quetext =tinymce.get('Quetext_'+ele_id[1]).getContent();
          if(Quetext){
           $('#Q_'+ele_id[1]).find('#Qcontent_'+ele_id[1]).html(Quetext);
          $('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('#Quetext_'+ele_id[1]).text(Quetext);
          }
        else{
          validatepop('Question Required ','Question can`t be Blank!' );
          return false;
        }
    }
    else{
      
       //$(this).find('#Qcontent_'+ele_id[1]).html(Quetext);
       if($('#Qatt_'+ele_id[1]).is(':visible'))
       {
         $('#Qremove_'+ele_id[1]).css('display','block');
          $('#attachment_Que_'+ele_id[1]).css('display','none');
        }
        else{
           $('#Qremove_'+ele_id[1]).css('display','none');
           $('#attachment_Que_'+ele_id[1]).css('display','block');
        }

      $('#Qcontent_'+ele_id[1]).css('display','none');
      $('#Qans_'+ele_id[1]).css('display','none');
      $(".QuesList").find('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('.mce-tinymce').css('display','block');
      $('#Qedit_'+ele_id[1]).css('display','none');
        $('#Qsubmit_'+ele_id[1]).css('display','block');
         var Questiontext= $('#Q_'+ele_id[1]).find('#Qcontent_'+ele_id[1]).html();
         // alert(Questiontext);
         if(Questiontext){
             tinymce.get('Quetext_'+ele_id[1]).setContent(Questiontext);
             $('#Q_'+ele_id[1]).find('#questiondiv_'+ele_id[1]).find('#Quetext_'+ele_id[1]).text(Questiontext);
         }
         else{
          validatepop('Question Required ','Question can`t be Blank!' );
          return false;
         }

    }


  }

}

function deleteQue(ele)
{
  var name = $(ele).attr('id');
  var ele_id = name.split('_');
  var isVisible = $(".QuesList").find('#Q_'+ele_id[1]).is(':visible');
  if(isVisible == true)
  {
    $(".QuesList").find('#Q_'+ele_id[1]).remove();
         var count = 1;
    $(".QuesList").find('.Qlist').each(function()
    {
             $(this).attr("id",'Q_'+count);
             $(this).find('label').html("Question "+count);
             $(this).find('.Qlist').find('textarea').attr("id",'Quetext_'+count);
              $(this).find('.Qcontent').attr("id",'Qcontent_'+count);
              $(this).find('.edit').attr("id",'Qedit_'+count);
              $(this).find('.submit').attr("id",'Qsubmit_'+count);
              $(this).find('.delete').attr("id",'Qdelete_'+count);

             $(this).find('.ansdiv').find('.Anstext').attr("id",'Anstext_'+count);
             $(this).find('.ansdiv').find('label').html("Your answer");
              $(this).find('.ansdiv').attr("id",'ansdiv_'+count);
              $(this).find('.Qanswer').attr("id",'Qanswer_'+count);
              $(this).find('.questiondiv').attr("id",'questiondiv_'+count);
              $(this).find('.ans').attr("id",'Qans_'+count);
              $(this).find('.Asubmit').attr("id",'Asubmit_'+count);
               $(this).find('.ansdiv').find('iframe').attr("id",'Anstext_'+count+'_ifr');
        count++;
      });
  }

}




</script>

<script type="text/javascript">
function removeelemnt(idu)
{
  var name = $(idu).attr('id');
  var ele_id = name.split('_');
  var isVisible = $(".linkedfile").find('#file_'+ele_id[1]).is(':visible');
  
  if(isVisible == true)
  {
    $(".linkedfile").find('#file_'+ele_id[1]).remove();
    
    
    if(ele_id[2] == 'file')
    {     
      $("#resources").show();
    } else if(ele_id[2] == 'video')
    {
      $("#video").show();
    }
  }

}
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 


<script type="text/javascript">

//var $j =jQuery.noConflict();




function stuAnsfile(id)
{
  var name = $(id).attr('id');
   var ele_id = name.split('_');

  var name = $j('#stufilestyle_'+ele_id[1]).val();
  name = name.replace('C:\\fakepath\\', '');
   if(name)
    {   
      $('#stuAttachment_'+ele_id[1]).css('display','none');  
$('#progress_stuattach_'+ele_id[1]).css('display','block');
     // up_attchQue(name);
     var optionsQattach = { 

    beforeSend: function() 
    { 
        $(".loader").show();
       // clear everything
        $("#bar_stuattach_"+ele_id[1]).width('0%');
        // $("#message").html("");
        $("#percent_stuattach_"+ele_id[1]).html("0%");
         $('#progress_stuattach_'+ele_id[1]+ele_id[1]).css('display','block');
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
    
       $(".loader").show();
        $("#bar_stuattach_"+ele_id[1]).width(percentComplete+'%');
        $("#percent_stuattach_"+ele_id[1]).html(percentComplete+'%');
    },
    success: function(response) 
    { 
       $(".loader").hide();
       console.log(response);
         $('#progress_stuattach_'+ele_id[1]).hide();
 //         $(".linkedfile").find("#message").show();
 // $(".linkedfile").find("#message").html("Uploaded");

        
    },
    complete: function(response) 
    {      
     //alert(response); 
      var str = "<div style='padding:2%' id='stufile_"+ele_id[1]+"' class='stufile'>";   
    var arr =  name.substring(name.lastIndexOf('.') + 1).toLowerCase();
    console.log(arr);
     var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
      var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

      if ($.inArray(arr, fileExtension) >= '1')
      {

        str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+name+"' onclick='return false' id='"+name+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><img style='width:250px;' id='"+name+"' src='<?php echo base_url(); ?>public/images/"+name+"' ></a>";
      }
      else{
          if($.inArray(arr, videoExtension) >= '1')
      {  
      str += "<br><a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+name+"' onclick='return false' id='"+name+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' ><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+name+"' type='video/mp4'></video></a></center>";
      }

        else{
          //id='"+name+"' href='<?php echo base_url(); ?>lessons/filedownload/"+name+"'
          var ext = name.split('.');
          if(ext[1]){
          str += "<a style='width:250px; word-wrap:break-word;' href='<?php echo base_url(); ?>lessons/filedownload/"+name+"' onclick='return false' id='"+name+"' ondblclick=filedownload(this) data-toggle='tooltip'  title='Double click to download' >"+name+"</a>";
          }
        }
      }
      str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger btn_remove' id='remove_"+ele_id[1]+"' onclick='remove_ansfile(this)' >X</button><br></div>";
      $('#stuansfiles_'+ele_id[1]).append(str);
      //$('.attachment').hide();

      $('#stuansfiles_'+ele_id[1]).show();
      $('#stuansfiles_'+ele_id[1]).find('input').val(name);
    
       return true;
        //alert('video');
    },
    error: function()
    {  
      alert('error');
          // $('#file_v').val('');
          // $("#progress_video").hide();
         
    }

}; 
$j("#proform").ajaxForm(optionsQattach);
    
     $('#upQattach').click(); 
       
    }  

   

      //up_attchQue('2');
    //   var str = "<div class='stufile' id='stufile_"+ele_id[1]+"'  ><span style='width:250px; word-wrap:break-word;'><b>Attachment : </b> ";
    //       str += "<div id='stu_ans_att_"+ele_id[1]+"' style='display:none' >"+name+"</div>";
    //       var arr =  name.substring(name.lastIndexOf('.') + 1).toLowerCase();
    //      var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    //       if ($.inArray(arr, fileExtension) >= '1')
    //       {
    //         str += "<br><img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+name+"' >";
    //       }
         
    //       else{
    //          var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

    //           if($.inArray(arr, videoExtension) >= '1')
    //           {  
    //               str += "<b>Resource Media</b><br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+name+"' type='video/mp4'></video></center><br>";
    //           }
    //           else{
    //             str += "<a style='width:250px; word-wrap:break-word;'>"+name+"</a>";
    //           }
    //       }
     
    //   // str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger' onclick='remove_file(this)' >X</button><br>
    //     str += "</span></div>";
    //   var isVisible = $("#stuansfiles_"+ele_id[1]).find('#stufile_'+ele_id[1]).is(':visible');
    //   if(isVisible == true)
    //   {
    //     $("#stuansfiles_"+ele_id[1]).find('#stufile_'+ele_id[1]).remove();
    //      $("#stuansfiles_"+ele_id[1]).append(str);
    //   }
    //   else{
    //     $("#stuansfiles_"+ele_id[1]).append(str);
    //   }
      
    //   $('#stuAttachment_'+ele_id[1]).hide();
    //   $('#stuansfiles_'+ele_id[1]).show();
    //   // $('.attachment').css('display','none');
    // }
 
}

 function remove_ansfile(id)
{
 var name = $(id).attr('id');
  var ele_id = name.split('_');
  $("#stuansfiles_"+ele_id[1]).find('.stufile').remove();
  $('#stuAttachment_'+ele_id[1]).css('display','block');

}

function remove_file(id)
{

  $(".quefiles").find('.Qfile').remove();
  $('.attachment').css('display','block');

}

function getfile()
{
  // var idu = '2';
  var name = $j('.filevideo').val();
  $j('#getname').val(name);
  $j('#video').hide();
  //alert(name);
            
           name = name.replace('C:\\fakepath\\', '');

           console.log(name);
 var str = "<div id='file_2'>";
str += "<h4><b>Instruction Video </b></h4><br>";
           // str += "<b style='width:20%; float:left;'>Media File</b>";
           str += "<div class='main_table'>";
             str += "<div class='grey_table'>"; 
           str += "<b class='col-sm-4 rowlist' float:left;'>File Name</b>";
           str += "<b class='col-sm-3 rowlist' float:left;'>Type</b>";
           str += "<b class='col-sm-3 rowlist' float:left;'>Satus</b>";

           // str += "<span style='width:20%; float:left;'>"+name+"</span>";
           str += "</div>";
           str += "<div class='content_table'>"; 
           str += "<span class='col-sm-4 rowlist' >"+name+"</span>";
           str += "<span class='col-sm-3 rowlist' float:left;'>video</span>";
            str += "<span class='col-sm-3 rowlist' float:left;'><div id='message2'></div>";
            str += "<div id='progress_video2' class='progress ' style='display:none'><div id='bar_video2' class='progress-bar bg-info progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_video2'></div></div></div></span>";
          str += "<input type='submit' id='uploadsubmit2' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>";
           //  str += '<input type="hidden" value="'+idu+'_'+img_type+'" name="media_id[]"/>';
            str += "<span class='col-sm-1'>";
            // str += "<a type='button' href ='<?php echo base_url(); ?>medias/addmedia2/2/'  onclick='removeelemnt(this)' id='change_"+idu+"_video' class='btn btn-info existingfiles cboxElement'  name='change'>Change</a>";
            // str += "<button style='margin-left:2%' type='button' class='btn btn-danger' onclick='removeelemnt(this)' id='remove_"+idu+"_video' name='change'>Remove</button>";
            str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger' id='close_2' onclick='removefile(this)' >X</button>";
            str += "</span></div></div</div><br>";
     $(".linkedfile").append(str);  
     Up_video();
     $(".linkedfile").find('#uploadsubmit2').click();  
    
}</script>


    <script> 
   //$(document).ready(function() { 
    function Up_file()
    {

        var optionsvideo = { 

    beforeSend: function() 
    {
        $("#progress_video").show();
        //clear everything
        $("#bar_video").width('0%');
        $("#message").html("");
        $("#percent_video").html("0%");
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
     
        $("#bar_video").width(percentComplete+'%');
        $("#percent_video").html(percentComplete+'%');
        
 
    },
    success: function(response) 
    { 
      console.log(response);
         $("#progress_video").hide();
         $(".linkedfile").find("#message").show();
 $(".linkedfile").find("#message").html("Uploaded");

        
    },
    complete: function(response) 
    {       
      
    },
    error: function()
    {  
      
          // $('#file_v').val('');
          $("#progress_video").hide();
       alert('error');
        $(".linkedfile").find("#message").html("<font color='red'> ERROR: unable to upload files</font>");
 
    }

}; 
 
$j("#proform").ajaxForm(optionsvideo);
}

    function Up_video()
    {
        var optionsvideo = { 
    beforeSend: function() 
    {
      

        $("#progress_video2").show();
        //clear everything
        $("#bar_video2").width('0%');
        $("#message2").html("");
        $("#percent_video2").html("0%");
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {

        $("#bar_video2").width(percentComplete+'%');
        $("#percent_video2").html(percentComplete+'%');
        
 
    },
    success: function(response) 
    { 
    
        console.log(response);
         $("#progress_video2").hide();
         $(".linkedfile").find("#message2").show();
 $(".linkedfile").find("#message2").html("Uploaded");
 
    },
    complete: function(response) 
    {       
      
        //alert('image');
    },
    error: function()
    {  
      // alert('44');
     //      $('#file_v').val('');
          $("#progress_video2").hide();
       alert('error');
        $("#message2").html("<font color='red'> ERROR: unable to upload files</font>");
 
    }
 
}; 
 
$j("#proform").ajaxForm(optionsvideo);
} 

    </script>
<script>

function getfileResource()
{
  var name = $j('.fileResource').val();
  $j('#getnameResource').val(name);
  // var idu = '1';
  $j('#resources').hide();

  name = name.replace('C:\\fakepath\\', '');
           console.log(name);
   var str = "<div id='file_1'>";
  str += "<h4><b>Instruction Resource File </b></h4><br>";
             // str += "<b style='width:20%; float:left;'>Media File</b>";
             str += "<div class='main_table'>";
             str += "<div class='grey_table'>";     
             str += "<b class='col-sm-4 rowlist' float:left;'>File Name</b>";
             str += "<b class='col-sm-3 rowlist' float:left;'>Type</b>";
             str += "<b class='col-sm-3 rowlist' float:left;'>Status</b>";
             // str += "<span style='width:20%; float:left;'>"+name+"</span>";
             str += "</div>";
             str += "<div class='content_table'>"; 
             str += "<span class='col-sm-4 rowlist' >"+name+"</span>";
             str += "<span class='col-sm-3 rowlist' float:left;'>file</span>";
             str += "<span class='col-sm-3 rowlist' float:left;'><div id='message'></div>";
            str += "<div id='progress_video' class='progress progress-bar progress-bar-striped progress-bar-animated'><div id='bar_video' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'><div id='percent_video'></div></div></div></span>";
          str += "<input type='submit' id='uploadsubmit' class='btn btn-blue btn-success' style='display:none' value='Upload Image'>";
          
             //  str += '<input type="hidden" value="'+idu+'_'+img_type+'" name="media_id[]"/>';
              str += "<span class='col-sm-1' >";
              // str += "<a type='button' href ='<?php echo base_url(); ?>medias/addmedia2/2/'  onclick='removeelemnt(this)' id='change_"+idu+"_video' class='btn btn-info existingfiles cboxElement'  name='change'>Change</a>";
              // str += "<button style='margin-left:2%' type='button' class='btn btn-danger' onclick='removeelemnt(this)' id='remove_"+idu+"_video' name='change'>Remove</button>";
              str += "<button style='margin-left:2%; margin-top: -5px;' type='button' class='btn btn-danger red_btn' id='close_1' onclick='removefile(this)' >X</button>";
              str += "</span></div></div></div><br>";
       $(".linkedfile").append(str); 
            Up_file();
                $(".linkedfile").find('#uploadsubmit').click();    
    

}

function removefile(ele)
{
  var name = $(ele).attr('id');
    var ele_id = name.split('_');
    var isVisible = $(".linkedfile").find('#file_'+ele_id[1]).is(':visible');
  
  if(isVisible == true)
  {
    $(".linkedfile").find('#file_'+ele_id[1]).remove();
    
    
    if(ele_id[1] == '1')
    {     
      $j('.fileResource').val('');
    $j('#getnameResource').val('');
      $("#resources").show();
    } 
    else if(ele_id[1] == '2')
    {
      $j('.filevideo').val('');
    $j('#getname').val('');
      $("#video").show();
    }
  }

}
</script>


<SCRIPT TYPE="text/javascript">
function show_next(id,nextid,bar)
{  // alert(bar);
  if(bar == 'bar1')
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','block');
       $('#next2').css('display','block');
  }
  else
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','none');
       $('#next2').css('display','none');
        $('#pre2').css('display','block');
  }
  $('.modal-backdrop.fade.in').remove();
  var ele=document.getElementById(id).getElementsByTagName("input");
  var error=0;
  for(var i=0;i<ele.length;i++)
  {
    if(ele[i].type=="text" && ele[i].value=="")
    {
      error++;
    }
  }
  
  if(error==0)
  {
    document.getElementById("instruct").style.display="none";
    document.getElementById("submission").style.display="none";
    document.getElementById("instructor_ex").style.display="none";
    $("#"+nextid).fadeIn();
    document.getElementById(bar).style.backgroundColor="#2f96b4";
  }
  else
  { 
    alert("Fill All The details");
  }
}

function show_prev(previd,bar)
{

  if(bar == 'bar1')
  {
     $('#next1').css('display','block');
      $('#pre1').css('display','none');
       $('#next2').css('display','none');
  }
  else
  {
     $('#next1').css('display','none');
      $('#pre1').css('display','block');
       $('#next2').css('display','block');
        $('#pre2').css('display','none');
  }
  $('.modal-backdrop.fade.in').remove();
  document.getElementById("instruct").style.display="none";
  document.getElementById("submission").style.display="none";
  document.getElementById("instructor_ex").style.display="none";
  $("#"+previd).fadeIn();
  document.getElementById(bar).style.backgroundColor="#D8D8D8";
}</SCRIPT>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>

<script type="text/javascript">
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
  
  function save_assignment(sid,pid,cname)
  {

    var name = $j('#name').val();
    var description =tinymce.get('description').getContent();
    $('#assign_description').text(description);
    var instruction =tinymce.get('instruction').getContent();
    $('#assign_instruction').text(instruction);
    //var Quetext =tinymce.get('Quetext_1').getContent();
    var Quetions = document.getElementById("Quetext_1");
    // alert(Quetions);
    // var Answer = document.getElementById("Anstext_1").value;
    // alert(Answer);
    
    if(name.trim() =="")
      {
        validatepop('Assignment Name Required','Please Enter Name of Assignment!');   
        return false;
      }
      else if(description.trim() =="")
      {
        validatepop('Assignment Description Required','Please Enter Description of Assignment!');     
          return false;
      }
      else if(instruction.trim() =="")
      {
        validatepop('Assignment Instruction Required','Please Enter Instruction for Assignment!');      
          return false;
      }
      if(!Quetions)
      {
        validatepop('Assignment can not be Blank','Please Fill Assignment Contents!' );   
        return false;
      }
      else
      {
       // var post_vars = $('#my-form').serializeArray();
       // $.ajax({ url: '//site.com/script.php', 
       //   method: 'POST', 
       //   data: post_vars, 
       //   complete: function() 
       //   { 
       //     $.ajax({ url: '//site.com/script2.php',
       //      method: 'POST', 
       //      data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }) 
       //     }); 
       //   } 
       // });

        $.ajax({
          //var post_vars = $('#proform').serializeArray();
         
          type: "POST",
          url: " <?php echo base_url()?>programs/assignment_submit/"+sid+"/"+pid,
          // data: post_vars, 
          // data: post_vars.concat({ name: 'EXTRA_VAR', value: 'WOW THIS WORKS!' }), 
             data: $("#proform").serialize(),
         //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
        beforeSend: function()
          {
            $('#loading').show();
            $("#subtn").attr("disabled", true);
          }, 
          success: function(msg)
          {   // console.log(msg);
             $('#loading').hide();
            $('#subtn').removeAttr("disabled");
           //   console.log(msg);
          //   alert(msg);
              if(msg == "success")
              {

                 
        var strcontent1 ='<center><b><h4 style="padding:2%;">Assignment Successfully Created! </h4></b></center>';
  
          $j.alert({
                 title: "Success",
              content: strcontent1,
             confirm: function()
                         {                        
                          window.location ="<?php echo base_url();?>admin/section-management/"+pid;
                         }
                     });


              } 

             else
              {
                  $j.alert({
                    // type: 'error',
                    
                   title: "Error",
                 content: '<center><b><h4 style="padding:2%;">'+msg+' </h4></b></center>',
                  confirm: function()
                            {
                              // window.location ="<?php echo base_url();?>sections-manage/"+pid+"/"+cname;
                              $('.error').remove();
                            return true;
                 
                             }
                         });

              }
              
          }
      });
      }

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

  
  function validatepop(strtitle,strcontent)
  {   
      var strcontent1 ='<p style="text-align: center;font-weight: 700;font-size: 15px;">'+strcontent+'</p>';
  
    $j.alert({
           title: strtitle,
        content: strcontent1,
       confirm: function()
                   {                        
              
                   }
               });
  }

  function Quefile()
{
  var name1 = $('.Quefile').val();
  name = name1.replace('C:\\fakepath\\', '');

   if(name)
    { 
       $('.attachment').css('display','none');  

     // up_attchQue(name);
     var optionsQattach = { 

    beforeSend: function() 
    {  
        $(".loader").show();
       // clear everything
        $("#bar_Qattach").width('0%');
        // $("#message").html("");
        $("#percent_Qattach").html("0%");
         $('#progress_Qattach').css('display','block');
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
      
    
       $(".loader").show();
        $("#bar_Qattach").width(percentComplete+'%');
        $("#percent_Qattach").html(percentComplete+'%');
        
 
    },
    success: function(response) 
    { 
       $(".loader").hide();
       console.log(response);
         $("#progress_Qattach").hide();
 //         $(".linkedfile").find("#message").show();
 // $(".linkedfile").find("#message").html("Uploaded");

        
    },
    complete: function(response) 
    {       
      var str = "<div style='padding:2%' class='Qfile'>";   
    var arr =  name.substring(name.lastIndexOf('.') + 1).toLowerCase();
    console.log(arr);
     var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
      if ($.inArray(arr, fileExtension) >= '1')
      {

        str += "<img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+name+"' >";
      }
      
      else{
        var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

        if($.inArray(arr, videoExtension) >= '1')
        {  
            str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+name+"' type='video/mp4'></video></center><br>";
        }
        else{
        str += "<a style='width:250px; word-wrap:break-word;'>"+name+"</a>";
        }
      }
      str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger btn_remove' onclick='remove_file(this)' >X</button><br></div>";
      $(".quefiles").append(str);
      $('.attachment').hide();
      $('.quefiles').show();
    
       return true;
        //alert('video');
    },
    error: function()
    {  
      alert('error');
          // $('#file_v').val('');
          // $("#progress_video").hide();
         
    }

}; 

$j("#proform").ajaxForm(optionsQattach);
       //  $("#exe_f").find('#upQattach').click(); 

     $('#upQattach').click(); 
       
    }
 
  // alert(name);
}

function Quefile2(Queid)
{  
  var idd = $(Queid).attr('id'); 
  var ele_id = idd.split('_');
  
  var name1 = $('#Qfilestyle_'+ele_id[1]).val();

  name = name1.replace('C:\\fakepath\\', '');
   if(name)
    { 
       $('#attachment_Que_'+ele_id[1]).css('display','none');  

     // up_attchQue(name);
     var optionsQattach = { 

    beforeSend: function() 
    { 
        

        $(".loader").show();
       // clear everything
        $("#bar_Queattach_"+ele_id[1]).width('0%');
        // $("#message").html("");
        $("#percent_Queattach_"+ele_id[1]).html("0%");
         $('#progress_Queattach_'+ele_id[1]).css('display','block');
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
    
       $(".loader").show();
        $("#bar_Queattach_"+ele_id[1]).width(percentComplete+'%');
        $("#percent_Queattach_"+ele_id[1]).html(percentComplete+'%');
        
 
    },
    success: function(response) 
    { 
       $(".loader").hide();
       console.log(response);
         $("#progress_Queattach_"+ele_id[1]).hide();
 //         $(".linkedfile").find("#message").show();
 // $(".linkedfile").find("#message").html("Uploaded");

        
    },
    complete: function(response) 
    {   
      // var str = "<div id='Q_"+ele_id[1]+"'  class='Qlist'>";
      var str = "<div class='Q_attach col-sm-offset-2' id='Qatt_"+ele_id[1]+"' ><br><br><button style='float:right; margin-top: -5px;display:none' id='Qremove_"+ele_id[1]+"' type='button' class='btn btn-danger' onclick='remove_Que_file(this)'>X</button>";
             var att = $('#Qfilestyle_'+ele_id[1]).val();
                 att = att.substr(12);
                 str += "<div id='attname_"+ele_id[1]+"' style='display:none'>"+att+"</div>";
                 str += "<input name='Q_att[]' id='Q_att_"+ele_id[1]+"' style='display:none' value='"+att+"'>";
                 var arr =  att.substring(att.lastIndexOf('.') + 1).toLowerCase();
                 var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                  if ($.inArray(arr, fileExtension) >= '1')
                  {
                  str += "<br><img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+att+"' >";
                }
                
                else{
                  var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

                  if($.inArray(arr, videoExtension) >= '1')
                  {  
                      str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+att+"' type='video/mp4'></video></center><br>";
                  }
                  else{
                  str += "<a style='width:250px; word-wrap:break-word;' >"+att+"</a>";
                  }
                }
            
              str += "</div><br>";   
              
              $("#Qatt_value_"+ele_id[1]).remove();
               $("#Q_"+ele_id[1]).find("#QF_attach_"+ele_id[1]).append(str);  
               $('#Qremove_'+ele_id[1]).css('display','block');

    //   var str = "<div style='padding:2%' class='Qfile'>";   
    // var arr =  name.substring(name.lastIndexOf('.') + 1).toLowerCase();
    // console.log(arr);
    //  var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    //   if ($.inArray(arr, fileExtension) >= '1')
    //   {

    //     str += "<img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+name+"' >";
    //   }
    //   else{
    //     str += "<a style='width:250px; word-wrap:break-word;'>"+name+"</a>";
    //   }
    //   str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger btn_remove' onclick='remove_file(this)' >X</button><br></div>";
    //   $(".quefiles").append(str);
    //   $('.attachment').hide();
    //   $('.quefiles').show();
    
       return true;
        //alert('video');
    },
    error: function()
    {  
      alert('error');
          // $('#file_v').val('');
          // $("#progress_video").hide();
         
    }

}; 
$j("#proform").ajaxForm(optionsQattach);
    
     //$("#exe_f").find('#upQattach').click(); 
     $('#upQattach').click(); 
       
    }
 
  // alert(name);
}



function Ansfile(Ansid)
{

  var idd = $(Ansid).attr('id'); 
  var ele_id = idd.split('_');

  var name = $j('#filestyle_'+ele_id[1]).val();
  name = name.replace('C:\\fakepath\\', '');
   if(name)
    {  
        $('#attachment_ans_'+ele_id[1]).hide();

         var optionsQattach = { 

    beforeSend: function() 
    { 
        

        $(".loader").show();
       // clear everything
        $("#bar_Ansattach_"+ele_id[1]).width('0%');
        // $("#message").html("");
        $("#percent_Ansattach_"+ele_id[1]).html("0%");
         $('#progress_Ansattach_'+ele_id[1]).css('display','block');
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
       
       $(".loader").show();
        $("#bar_Ansattach_"+ele_id[1]).width(percentComplete+'%');
        $("#percent_Ansattach_"+ele_id[1]).html(percentComplete+'%');
        
 
    },
    success: function(response) 
    { 
       $(".loader").hide();
       console.log(response);
         $("#progress_Ansattach_"+ele_id[1]).hide();
 //         $(".linkedfile").find("#message").show();
 // $(".linkedfile").find("#message").html("Uploaded");

        
    },
    complete: function(response) 
    {       
      var str = "<div style='padding:0%' class='Afile' id='Afile_"+ele_id[1]+"'  ><span style='word-wrap:break-word;'>";
          str += "<div id='admin_ans_att_"+ele_id[1]+"' style='display:none' >"+name+"</div>";
          // str += "<input name='ans_att[]' id='ans_att_"+ele_id[1]+"' style='display:none' value='"+name+"'>";
          $(".QuesList").find('.Qlist').find('#ans_att_'+ele_id[1]).find('input').attr('value', name);
          var arr =  name.substring(name.lastIndexOf('.') + 1).toLowerCase();
          var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
          if ($.inArray(arr, fileExtension) >= '1')
          {
            str += "<br><img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+name+"' >";
          }
       
          else{
               var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

        if($.inArray(arr, videoExtension) >= '1')
        {  
            str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+name+"' type='video/mp4'></video></center><br>";
        }
        else{
            str += "<a style='width:250px; word-wrap:break-word;'>"+name+"</a>";
            }
          }
     
      // str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger' onclick='remove_file(this)' >X</button><br>
        str += "</span></div>";
      var isVisible = $("#ansfiles_"+ele_id[1]).find('#Afile_'+ele_id[1]).is(':visible');
      if(isVisible == true)
      {
        $("#ansfiles_"+ele_id[1]).find('#Afile_'+ele_id[1]).remove();
         $("#ansfiles_"+ele_id[1]).append(str);
      }
      else{
        $("#ansfiles_"+ele_id[1]).append(str);
      }
      
      // $('#attachment_ans_'+ele_id[1]).hide();
      $('#ansfiles_'+ele_id[1]).show();
    $('#remove_'+ele_id[1]).css('display','block');  
       return true;
        //alert('video');
    },
    error: function()
    {  
      alert('error');
          // $('#file_v').val('');
          // $("#progress_video").hide();
         
    }

}; 
$j("#proform").ajaxForm(optionsQattach);
    
     $('#upQattach').click(); 
       
    }
    
      
      // $('.attachment').css('display','none');
    
 
  // alert(name);
}

function up_attchQue()
{
   var optionsQattach = { 

    beforeSend: function() 
    { 
        

        $(".loader").show();
       // clear everything
        $("#bar_Qattach").width('0%');
        // $("#message").html("");
        $("#percent_Qattach").html("0%");
         $('#progress_Qattach').css('display','block');
        
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
    
       $(".loader").show();
        $("#bar_Qattach").width(percentComplete+'%');
        $("#percent_Qattach").html(percentComplete+'%');
        
 
    },
    success: function(response) 
    { 
       $(".loader").hide();
       console.log(response);
         $("#progress_Qattach").hide();
 //         $(".linkedfile").find("#message").show();
 // $(".linkedfile").find("#message").html("Uploaded");

        
    },
    complete: function(response) 
    {       
      var str = "<div style='padding:2%' class='Qfile'>";   
    var arr =  name.substring(name.lastIndexOf('.') + 1).toLowerCase();
    console.log(arr);
     var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
      if ($.inArray(arr, fileExtension) >= '1')
      {

        str += "<img style='width:250px;' src='<?php echo base_url(); ?>public/images/"+name+"' >";
      }
     
      else{
         var videoExtension = ['webm', 'mp4', 'ogv', 'mid'];

        if($.inArray(arr, videoExtension) >= '1')
        {  
            str += "<br><video width='420' height='280' controls><source id='r_video' src='<?php echo base_url() ?>public/images/"+name+"' type='video/mp4'></video></center><br>";
        }
        else{
        str += "<a style='width:250px; word-wrap:break-word;'>"+name+"</a>";
        }
      }
      str += "<button style='float:right; margin-top: -5px;' type='button' class='btn btn-danger btn_remove' onclick='remove_file(this)' >X</button><br></div>";
      $(".quefiles").append(str);
      $('.attachment').hide();
      $('.quefiles').show();
    
       return true;
        //alert('video');
    },
    error: function()
    {  
      alert('error');
          // $('#file_v').val('');
          // $("#progress_video").hide();
         
    }

}; 
$j("#proform").ajaxForm(optionsQattach);
}

</script>

 
