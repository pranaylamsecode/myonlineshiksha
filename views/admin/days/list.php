<!--treemenu scripts and style
<link rel="stylesheet" href="<?php echo base_url() ?>public/css/jquery.treeview.css" />
<script src="<?php echo base_url() ?>public/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>public/js/jquery.treeview.js" type="text/javascript"></script>-->
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
	<style type="text/css">
	#message {
    position: fixed; 
/*    color: green;
*/    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 99999;
}
	.grey-bg h5{ display: inline-block; }
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
		.main-table{
 		 	display: flex!important;
  			width:100%!important;
		}
		.crosslink{
			margin-left: 7px;
		    font-size: 14px;
		    color: #686c70;
		    margin-bottom: 3px;
		    font-weight: 600;
		    font-family: arial;
		}
		a .crosslink:hover {
    color: #818da2;
}

.sprite.settings {
  background: url('/public/css/image/sprite.png') no-repeat top left;
  width: 26px;
  height: 23px;
  display: inline-block;
  margin-left: 10px;
}
.panel-title.course_setting_sec {
  padding: 10px 15px !important;
}
.course_text{
  float: right;
}
.main-sect .edit_icon {
	font-size: 24px;
}
.main-sect .delete_sec {
	font-size: 26px;
	position: relative;
	top: 8px;
	left: -4px;
}
.main-sect .top-menu-icon {
	top: 0px;
}
.main-sect .orange-bg {
	padding: 5px 15px 10px 15px;
}
.add_icon {
	color: #fff;
	border-radius: 50%;
	font-size: 12px;
	width: 22px;
	height: 22px;
	text-align: center;
	padding-top: 5px;
}
.add_lecture_icon{
	 background: #00c3aa;
}
.add_exam_icon{
	 background: #355df2;
}
.add_chapter_icon {
	color: #454545;
	border: 1px solid #454545;
	padding-top: 4px;
}
.panel {
	padding-bottom: 15px;
}
	</style>



<div class="main-container">
<div id="content-top">
	
<h2><?php echo $program->name;?></h2>    
    
</div>
<div><p class="quick_course"> A Single Course is made up of several chapters. In the chapters you can add Lectures and Quizzes for the course.</p></div>
<span id="message"></span>
            
<div class="col-sm-12">
		
		<div class="panel panel-primary" data-collapsed="0">
			<?php 
			$num=0;
			$node=0;?>		
			<div class="panel-heading">
				
                <div class="col-sm-12 panel-title  course_setting_sec">
					<!-- <h3 style="float:left"><?php echo $program->name;?></h3> -->
                   <h3 style="float:left">Curriculum</h3>
                    	
                     	<div class="settings" style="float:right;width: 15%;" title="Save changes of Sorted list">
                     		<!-- <input type="button" id="savechanges" value="Save Changes"> -->
                     		<a class="btn btn-success btn-green"  style="display:none; margin-left: 20px; margin-right: -20px " id="savechanges">Save Changes</a>
                     	</div> 
                     	 <a href="<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>" style="float: right;"><span class="sprite settings" style="background-position: -184px 0" title="Course Settings"></span><span class="course_text">Course settings</span>  </a>
                    	  <a href="<?php echo base_url(); ?>admin/course/preview/<?php echo $program ->id?>" target="_blank" id="pre_link" style="float: right;margin-right: 7px"><span class="lnr lnr-eye" style="font-size: 25px;margin-right:6px;position:relative;top:-1px;" title="Course Preview"></span><span class="course_text">Course preview</span>  </a>
                    	    
					
                   
				</div>



			
			</div>
			
			<div class="panel-body" style="padding-bottom:0px;">
				<div class="col-sm-12">	
				<div id="list-2" class="nested-list dd with-margins custom-drag-button drag-button-on-hover">	
				                    <ul class="dd-list main-sect sortable1 sortableconnect">
				
					<?php if ($days){ ?>
					<?php 
								foreach ($days as $day){ 
								$num++;
								?>	
						<li class="dd-item main-table" id="s_<?php echo $day->id;?>">
            <!--<button data-action="collapse" type="button">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>-->
							<div class="col-sm-1 orange-bg">
								<div class="col-sm-12 no-padding top-menu-icon">
									<!-- <?php echo base_url(); ?>admin/edit/section/<?php echo $day->id;?>/<?php echo $program->id; ?> -->
									<a href="#chapter" class="add_chapter edit" id="edit_<?php echo $day->id.'_'. $program->id; ?>" title="Edit Chapter" >
										<span class="lnr lnr-list edit_icon"></span>
									</a>
								</div>
								<div class="col-sm-12 no-padding bottom-close-icon">
									<a style="cursor:pointer" onClick="return deleteconfirm('<?php echo $day->id;?>','<?php echo $program->id;?>')">
                                    	<span class="lnr lnr-cross delete_sec"></span>
									</a>
								</div>
							</div>
							
							<div class="col-sm-11 dd-content no-left-padding light-grey-bg">
							  
								<div class="col-sm-12 chap_title">
									<h4><?php echo $day->title;?></h4>
								</div>
							
							<ul class="dd-list left-padding sortable sortableconnect" id="<?php echo $day->id;?>">
							
							<?php
											$lessons = $this->days_model->getLessons($day->id);							
											if ($lessons){
											foreach ($lessons as $lesson){
											$node++;
											?>

								<li class="dd-item right-sect" id="<?php echo $day->id.'_'.$lesson->id;?>">
									
									<div class="col-sm-1 dd-content light-green-bg" style='padding-left:10px!important; background-color:<?php echo $lesson->layoutid == '12' ? '#008BDB':'#00C3AA'; ?>'>
										<div class="col-sm-12 no-padding top-menu-icon">

									   <?php
									   	if($lesson->layoutid == '12')
									   	{
									   		?>
									   		<a id="nodeATag2" title="<?php if($lesson->layoutid == '12') { echo 'Edit Exam'; } else { echo 'Edit Lecture'; } ?>"  href="<?php echo base_url(); ?><?php if($lesson->layoutid == '12') { echo 'admin/edit/exam'; } else { echo 'admin/edit/lecure';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>">
												<span class="lnr lnr-list edit_icon"></span>
											</a>
											<?php
									   	}
									   	else
									   	{
									   		?>
									   		<a id="nodeATag2"  title="<?php if($lesson->layoutid == '12') { echo 'Edit Exam'; } else { echo 'Edit Lecture'; } ?>"  href="<?php echo base_url(); ?><?php if($lesson->layoutid == '12') { echo 'admin/edit/exam'; } else { echo 'admin/edit/lecture';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>">
												<span class="lnr lnr-list edit_icon"></span>
											</a>
											<?php
									   	}
									   ?>
									    
										<!--<a id="nodeATag2"  title="<?php if($lesson->layoutid == '12') { echo 'Edit Exam'; } else { echo 'Edit Lecture'; } ?>" class="fancybox fancybox.iframe" href="<?php echo base_url(); ?>admin/tasks/<?php if($lesson->layoutid == '12') { echo 'quizedit'; } else { echo 'edit';} ?>/<?php echo $lesson->tid;?>/<?php echo $day->id;?>/<?php echo $program->id;?>">
											<?php echo $lesson->name;?></a>-->

											<!-- <a style="float:right;"  class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/tasks/delete/<?php echo $lesson->tid;?>/<?php echo $day->id;?>/<?php echo $program->id;?>'><i class="entypo-cancel"></i>Delete</a> -->
									</div>
									<div class="col-sm-12 no-padding bottom-close-icon" style="margin-right: 0!important;">
										<a  style="cursor:pointer" onClick="return deleteconfirm2('<?php echo $lesson->id;?>','<?php echo $day->id;?>','<?php echo $program->id ?>','<?php echo $lesson->layoutid;?>')" >
											<span class="lnr lnr-cross delete_sec"></span>
										</a>
									</div>
									</div>
									<div class="col-sm-11 white-bg">
										<div class="col-sm-12 grey-bg">
											<!-- <a href="<?php echo base_url(); ?>admin/tasks/<?php if($lesson->layoutid == '12') { echo 'quizedit'; } else { echo 'edit';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>"><h5 class="lec_name"><?php echo $lesson->name;?></h5></a> -->
											<a href="<?php echo base_url(); ?>admin/edit/<?php if($lesson->layoutid == '12') { echo 'exam'; } else { echo 'lecture';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>"><h5 class="lec_name"><?php echo $lesson->name;?></h5></a>

											<a style="float: right;padding-top: 4px;"><?php
											 if(isset($program->release_type) && $program->release_type != ''){ 
											 	if(isset($lesson->release_date) && $lesson->release_date > 0){
												if($program->release_type == '1'){
													echo "Lecture release on: ".$lesson->release_date;	
												}
												else if($program->release_type == '2'){
												$lect_date = date('Y-m-d',strtotime("+".$lesson->release_date." days"));
												echo "Lecture release on: ".$lect_date;
												}
											  }
											} ?></a>
										</div>
										
										<?php // print_r($lesson); ?>
										<div class="curriculum_corse_feat col-sm-12">
										    <ul>
										        <li><?php echo $lesson->published == 1 ? 'Published' : 'Draft' ?></li>
										        <?php if($lesson->layoutid == '12'){ ?>
										        <li><?php echo "Level: ".$lesson->difficultylevel; ?></li>
										        <?php } else { ?>
										        	<li><?php echo "Type: ".$lesson->lecture_type; ?></li>
										        <?php }
										        if($lesson->lecture_type == 'video' && empty($lesson->lecture_video))
										        	echo "<li style='color: white !important; background-color:red !important;'>Video not Uploaded</li>";
										        if($lesson->lecture_type == 'PDF / Doc' && empty($lesson->lecture_content))
										        	echo "<li style='color: white !important; background-color:red !important;'>PDF / Doc not Uploaded</li>";
										        if($lesson->lecture_type == 'Audio' && empty($lesson->lecture_content))
										        	echo "<li style='color: white !important; background-color:red !important;'>Audio not Uploaded</li>";
										        if($lesson->lecture_type == 'Text' && empty($lesson->lecture_content))
										        	echo "<li style='color: white !important; background-color:red !important;'>Text not added.</li>";
										        if($lesson->layoutid == 12 && $lesson->is_exam == 0)
										        	echo "<li style='color: white !important; background-color:red !important;'>Quiz not attached.</li>";
										        ?>
										    </ul>
										</div>
									</div>
								</li>
							<?php } }
							$assignment = $this->Crud_model->GetData('mlms_assignment',"assign_id,assign_title","section_id = ".$day->id." and trash = 0");
								if(!empty($assignment))
								{
									foreach ($assignment as $key) {
								?>
								<li class="dd-item right-sect" id="assign_<?php echo $key->assign_id;?>">
									<div class="col-sm-1 dd-content light-green-bg" style='padding-left:10px!important; background-color:#008BDB'>
										<div class="col-sm-12 no-padding top-menu-icon">
									   		<a id="nodeATag2" title="Edit Assignment" href="<?php echo base_url().'admin/programs/edit-assignment/'.$key->assign_id;?>">
												<span class="lnr lnr-list edit_icon"></span>
											</a>
										</div>
										<div class="col-sm-12 no-padding bottom-close-icon" style="margin-right: 0!important;">
											<a style="cursor:pointer" onclick="return delete_assign('<?php echo $key->assign_id;?>');">
												<span class="lnr lnr-cross delete_sec"></span>
											</a>
											<!-- <a onclick="return delete_assign()"></a> -->
										</div>
									</div>
									<div class="col-sm-11 white-bg">
										<div class="col-sm-12 grey-bg">
											<a href="<?php echo base_url().'admin/programs/edit-assignment/'.$key->assign_id;?>"><h5 class="lec_name"><?php echo ucfirst($key->assign_title);?></h5></a>
										</div>
										<div class="curriculum_corse_feat col-sm-12">
										    <ul>
										        <li>Published</li>
										        <li>Type : Assignment</li>
										    </ul>
										</div>
									</div>
								</li>
								<?php } }
							?>
								
								
							</ul>
							<div class="col-sm-12 bottom-sect">
								<!-- <i class="entypo-right sect"></i> -->
									<!-- <a class='sect inline-position' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/days/delete/<?php echo $day->id?>/<?php echo $this->uri->segment(3)?>'>
										<div class='sprite 99close' style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
									</a> -->
									<!-- href='<?php echo base_url(); ?>admin/create/lecture/<?php //echo $day->id;?>/<?php echo $program->id;?>' -->

									<a style="cursor:pointer" href="#lecture" class='sect inline-position add_lecture create' id="lecture_<?php echo $day->id;?>_<?php echo $program->id;?>" >
                                    	<!-- <div style="margin-right: 6%;" title="Add New" class='sprite 1addnew' style="width: 22px; height: 22px; "> -->
                                    	<div style="margin-right: 6%;" title="Add New" class=''>
                                    		<i class="fas fa-plus add_icon add_lecture_icon"></i>
                                    	</div><p style="padding-top: 2%;">Add Lecture</p>
                                    </a>
                                    <!-- href='<?php echo base_url(); ?>admin/create/exam/<?php echo $day->id;?>/<?php echo $program->id;?>' -->
                                    <a style="cursor:pointer" style="padding-left:3%" class=' add_quiz sect inline-position '  id="quiz_<?php echo $day->id;?>_<?php echo $program->id;?>"  >
                                    	<!-- <div style="margin-right: 6%;" title="Add New" class='sprite 1addnew' style="width: 22px; height: 22px; "> --><div style="margin-right: 6%;" title="Add New" class=''>
                                    		<i class="fas fa-plus add_icon add_exam_icon"></i></div><p style="padding-top: 2%;">Add Quiz</p>
                                    </a>
                                 	<a style="cursor:pointer" style="padding-left:3%" class='sect inline-position' id="quiz_<?php echo $day->id;?>_<?php echo $program->id;?>" href="<?php echo base_url().'admin/programs/assignment/'.$program->id.'/'.$day->id;?>">
	                               		<div style="margin-right: 6%;" title="Add New">
	                                		<i class="fas fa-plus add_icon add_exam_icon"></i></div><p style="padding-top: 2%;">Add Assignment</p>
	                                </a>                
								</div>
                            </div>
						</li>
                        <?php } ?>
					
			

		

<?php } else{ ?>
	<!-- <p class='text'><?=lang('web_no_elements');?></p> -->
	<p class='text sect-para'>No Section Found In Course</p>
<?php } ?>
</ul>
<!-- </ul> -->
						
				</div>
							</div>
			</div>
<div class="col-sm-12 new-sect">

				<a style="cursor:pointer" class="inline-position add_chapter create" href='#chapter'>
					<div style="margin-right: 6%;" title="Add New">
						<i class="fas fa-plus add_icon add_chapter_icon"></i>
					</div><p style="padding-top:4%;">Add Chapter</p>
				</a>
				<!-- <div style="float: right;">
				<a class="link_page" style="float: right;color: #00ADEF!important;margin-right: 36px;" href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'><div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Settings"></div><span class="crosslink">Course Settings</span></a>
				</div> -->
			</div>

			</div>

		</div>


	</div>
<script type="text/javascript">
	$(document).ready(function(){
	
	// first example
	$("#modulebrowser").treeview();
	
	// second example
	$("#navigation").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});
	
	// third example
	$("#red").treeview({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "cookie",
		toggle: function() {
			window.console && console.log("%o was toggled", this);
		}
	});
	
	// fourth example
	$("#black, #gray").treeview({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "treeview-black"
	});


});
	</script>

	<script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.mousewheel-3.0.6.pack.js"></script>
	
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
     // placeholder: "ui-state-highlight",
      connectWith: ".sortable1 .sortable",
      dropOnEmpty: true,

      receive: function( event, ui ) {
      	 var eleId = ui.item.attr("id"); 
      	 var parent_id = $("#"+ui.item.attr("id")).parent().attr('id');  
      	 //console.log("eleId "+eleId);
      	// console.log("parent_id "+parent_id);    	
   //    	 $j.ajax({
			// type: "POST",
			// url: "<?php echo base_url(); ?>admin/days/relationUpdate",
			// data: {eleId:eleId,parent_id:parent_id}, 
			// success: function(data)
			// {				
			// 	location.reload();				
			// }
		 //  }); 

      	},

      update: function( event, ui ) {
      	var sortedIDs = $j(this).sortable("toArray"); 
      	// $("#savechanges").css("display","block");    
      	saveSequence();  		
      	//console.log("sortedIDs "+sortedIDs);
   //    		$j.ajax({
			// type: "POST",
			// url: "<?php echo base_url(); ?>admin/days/sortingorder",
			// data: {sortedIDs:sortedIDs}, 
			// success: function(data)
			// {
			// 	//alert(data);				
			// }
		 //  }); 
      	
      }  
         
    });

    $j( ".sortable" ).disableSelection();
    
  });

  $j(function() {
    $j( ".sortable1" ).sortable({
      //placeholder: "ui-state-highlight",
      connectWith: ".sortable1",

      update: function( event, ui ) {
      	var sortedIDs = $j(this).sortable("toArray");       		
      // $("#savechanges").css("display","block"); 
      saveSequence();
      
   //    		$j.ajax({
			// type: "POST",
			// url: "<?php echo base_url(); ?>admin/days/sortingsection",
			// data: {sortedIDs:sortedIDs}, 
			// success: function(data)
			// {
			// 	//alert(data);				
			// }
		 //  }); 
      
      }  

    });
    $j( ".sortable1" ).disableSelection();
  });
  </script>

<script>
var $ =jQuery.noConflict();
	function deleteconfirm(id,seg) 
       {
       	var has_lect = $(document).find('#s_'+id).find('.dd-item').length;
		var content = ' ';
       	if(has_lect > 0) 
       		content =  '<div class="formName" style="text-align: center;">' +
          '<h3>This chapter has lectures.</h3>'+
          '<div style="font-size: 16px;color: #000000"><input type="checkbox" name="del_lecture" style="margin-right: 5px;" class="del_lecture"><span>Delete all lectures</span><div>'+
          '</div>';

	$.confirm({
       title: 'Do you really want to delete the chapter?',
       content: content,      
       confirm: function(){ 
       	if($(document).find('.formName').find('.del_lecture').prop("checked") == true)  
       		var del_lecture = "1";
       	else var del_lecture = "0";
       	  // $(document).find('.formName').find('.del_lecture').prop();
                        // window.location.href = "<?php echo base_url(); ?>admin/days/delete/"+id+"/"+seg;
                    $.ajax({
                        cache: false,
                        type: "POST",
                        data: {'del_lecture': del_lecture },
                        url: "<?php echo base_url(); ?>admin/days/delete/"+id+"/"+seg,
                        beforeSend: function(){
                              $('.new_course_popup, .popup_overlay').hide();
                        },
                        success: function(response){
                        	if(response == "success"){
                           $(document).find('#s_'+id).html('<h4 style="color:green">The chapter has been deleted.</h4>');
                        		 setTimeout(function(){
								  $(document).find('#s_'+id).remove();
								}, 3000);
                        	}
                        	else{
                        		 $.alert({
					                title: response,
					                content: ' ',
					            });
                        	}
        
                       }
                     });




                    },
       cancel: function(){        
                       return true;
                        }
                     });
    }

    function deleteconfirm2(lid,id,seg,layoutid) 
       {
       	var msg = "lecture";
                  if(layoutid == '12'){ msg = 'quiz'; }
                $.confirm({
                      title: 'Do you really want to delete the '+msg+'?',
                       content: ' ',
                       confirm: function(){ 
                                        //window.location.href = "<?php echo base_url(); ?>admin/tasks/delete/"+lid+"/"+id+"/"+seg;
       							        
							 $.post("<?php echo base_url(); ?>admin/tasks/delete/"+lid+"/"+id+"/"+seg, function(response){ 
                        	if(response == "success"){
                 //        		 $.alert({
					            //     title: 'The lecture has been deleted.',
					            //     content: ' ',
					            // });
					             $(document).find('#s_'+id).find('ul#'+id).find('li#'+id+'_'+lid).html('<h4 style="color:green">The '+msg+' has been deleted.</h4>');
                        		 setTimeout(function(){
								  $(document).find('#s_'+id).find('ul#'+id).find('li#'+id+'_'+lid).remove();
								}, 3000);
                        		 		
								// $(document).find('#s_'+id).find('ul#'+id).find('li#'+id+'_'+lid).remove(); 
                        	}
                        	else{
                        		 $.alert({
					                title: response
					            });
                        	}
						      
						});
                                           },
                        cancel: function(){        
                                         return true;
                                                   }
                                         });
                       
               }


    // $j(document).on('click', "#savechanges", function(){		  
    function saveSequence(){  
		    
    		var sectionSortIDS = [];
		    var lectureSortIDS = [];
		    var sectionSorting = [];
		    
		    $('ul.sortable').each(function()
		    { 		    	
		    	var sectionIDs = $(this).attr("id");
		    	var sortedIDs = $j(this).sortable("toArray");
		    	
		    	sectionSortIDS.push(sectionIDs);
		    	lectureSortIDS.push(sortedIDs);	
		    		
		    });	

		    $('ul.sortable1').each(function()
		    { 
		    	var sectionSortedIDs = $j(this).sortable("toArray");		    	
		    	sectionSorting.push(sectionSortedIDs);    	
		    		
		    });		    	   

		    // $.confirm({
      //  title: '',
      //  content: '<h2 style="">Do you want to change the sequence ordering of course content?</h2>',
      //  confirm: function(){              
                        	

                        $j.ajax({
								type: "POST",
								url: "<?php echo base_url(); ?>admin/days/sortingorder",
								data: {sectionSorting:sectionSorting,sectionSortIDS:sectionSortIDS,lectureSortIDS:lectureSortIDS}, 
								success: function(data)
									{	
										// //alert(data);
										// // if(data == "success")
										// // {
										//  window.location.href = "<?php echo base_url(); ?>admin/section-management/<?php echo $this->uri->segment(3); ?>";
										// //}
										// var msg = "Course Content has been updated!";
										// var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+msg+' </div>';
							   //           var note = $(document).find('#message');
							   //            note.html(str);
							   //          note.show();
							   //          note.fadeIn().delay(3000).fadeOut();

									}
					  		   }); 

                          // },
       // cancel: function(){        
       //                 return true;
       //                   }
       //               });

		    return true;

    }
    // );

/////chapter popup

  	 $(document).on('click', '.add_chapter', function() {
  	 	

  	 var updType = $(this).hasClass('edit');
  	 if(updType)
  	 {
  	 	var heading = 'Edit Chapter';
  	 	var id = $(this).attr('id');
  	 	var ele = id.split('_');
  	 	console.log(ele);
  	 	var url = "<?php echo base_url() ?>admin/days/section_edit/"+ele[1]+"/"+ele[2];

  	 }
  	 else{
  	 	var heading = 'Create New Chapter';
  	 	var url = "<?php echo base_url() ?>admin/days/section_ajax/<?php echo $this->uri->segment(3)?>";

  	 }


  	  $.ajax({
  	  	url: url,
  	  	type: "POST",
  	  	beforeSend: function(){
  	  		 $(document).find('.popup_heading').text(heading);
  	  		   	// $('.course_select_sec').html('');
		  	 	$('.course_popup').show('slow');
		  	  $('.popup_overlay_lec').show(); 
  	  	},
  	  	success: function(msg)
  	  	{
  	  		$('.course_select_sec').html(msg);
  	  	}

  	  });
  	}); 

///lecture popup
  	 $(document).on('click', '.add_lecture', function() {
  	 	var id = $(this).attr('id');
  	 	var ele = id.split('_');


  	  $.ajax({
  	  	url: "<?php echo base_url() ?>admin/tasks/lecture_popup/"+ele[1]+"/"+ele[2],
  	  	type: "POST",
  	  	beforeSend: function(){
  	  		 $(document).find('.popup_heading').text('Create New Lecture');
  	  		 // $('.course_select_sec').html('');
		  	 	$('.course_popup').show('slow');
		  	  $('.popup_overlay_lec').show(); 
  	  	},
  	  	success: function(response)
  	  	{	 
  	  		$('.course_select_sec').html(response);
  	  	 },
	    error: function()
	    {   
	      alert('error');
	       
	 
	    }

  	  });
  	}); 

  	 $(document).on('click', '.add_quiz', function() {
  	 	var id = $(this).attr('id');
  	 	var ele = id.split('_');


  	  $.ajax({
  	  	url: "<?php echo base_url() ?>admin/tasks/quiz_popup/"+ele[1]+"/"+ele[2],
  	  	type: "POST",
  	  	beforeSend: function(){
  	  		 $(document).find('.popup_heading').text('Create New Quiz');
  	  		 // $('.course_select_sec').html('');
		  	 	$('.course_popup').show('slow');
		  	  $('.popup_overlay_lec').show(); 
  	  	},
  	  	success: function(response)
  	  	{	 
  	  		$('.course_select_sec').html(response);
  	  	 },
	    error: function()
	    {   
	      alert('error');
	       
	 
	    }

  	  });
  	}); 

  	$(document).on('click', '.cross_icon', function() {
  	   $('.course_popup').hide(); 
  	   $('.popup_overlay_lec').hide(); 
  	}); 

$(document).ready(function(){
var add = $('.grey-bg').find('a').attr('href');
var ele = add.split('/');
var ele2 = ele.slice(Math.max(ele.length - 3, 1));
$('#pre_link').attr('href', "<?php echo base_url(); ?>admin/course/preview/<?php echo $program ->id?>/"+ele2['1']+"/"+ele2['0']);
});
</script>

<script type="application/javascript">
	function delete_assign(id)
	{
		$.confirm({
          	title: 'Do you really want to delete the Assignment ?',
           	content: ' ',
           	confirm: function(){
				$.ajax({
					type : 'post',
					cache : false,
					url : '<?php echo base_url();?>admin/days/delete_assign',
					data : {id:id},
					success : function (data){
						$("#assign_"+id).html('<h4 style="color:green">Assignment deleted successfully.</h4>');
						setTimeout(function(){ $("#assign_"+id).remove(); }, 2000);
					}
				});
			},
			cancel: function(){        
		       	return true;
	        }
	    });

	}
</script>