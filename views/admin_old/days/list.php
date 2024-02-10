<!--treemenu scripts and style
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/jquery.treeview.css" />
<script src="<?php echo base_url(); ?>/public/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/public/js/jquery.treeview.js" type="text/javascript"></script>-->
<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
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
<!--/treemenu scripts and style-->

<!--lightbox scripts and style
	<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>

	<style type="text/css">
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
	</style>

<!--/lightbox scripts and style-->
<div class="main-container">
<div id="content-top">
    <h2><?php echo "Section Management";	
    //echo lang('web_category_list')?></h2>
    
    <span class="clearFix">&nbsp;</span>
    
</div>
<div><p>A Single Course is made up of several sections. In the Sections you can add Lectures and Exam / Quizzes for the course. Exams / Quizzes have to be created separately in the Exams manager and can be added through that page.<br/>Click on Name of Section/Lecture to Edit.</p></div>


<ol class="breadcrumb bc-3">
			<li>
				<?php
				if ($this->uri->segment(3))
				{
				$nav_home =  "<a href='".base_url()."admin/course-manager'>".lang('web_home')."</a> &nbsp;&nbsp;>&nbsp;&nbsp; ";
				$nav = $program->name;
	
				//while(! is_null($program->name ) )
				//{
				$nav = "<a href='".base_url()."admin/course-manager/".$program->id."'>".$program->name . "</a>";

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
            
            
            
<div class="col-sm-12">
		
		<div class="panel panel-primary" data-collapsed="0">
			<?php 
			$num=0;
			$node=0;?>		
			<div class="panel-heading">
				
                <div class="col-sm-12 panel-title">
					<h3 style="float:left"><?php echo $program->name;?></h3>
                   
                    	 <a href="<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>"><div class="sprite 7settings" style="float:right;background-position: -184px 0" title="Course Settings"></div> </a>
                     	<div class="7settings" style="float:right;width: 15%;" title="Save changes of Sorted list">
                     		<!-- <input type="button" id="savechanges" value="Save Changes"> -->
                     		<a class="btn btn-success btn-green"  style="display:none" id="savechanges">Save Changes</a>
                     	</div>    
					
                   
				</div>
				
				<!-- <div class="panel-options">
                
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    
				</div> -->
			</div>
			
			<div class="panel-body" style="padding-bottom:0px;">
				<div class="col-sm-12">	
				<div id="list-2" class="nested-list dd with-margins custom-drag-button drag-button-on-hover">					
					<?php if ($days): ?>
                    <ul class="dd-list main-sect sortable1 sortableconnect">
					<?php 
								foreach ($days as $day): 
								$num++;
								?>	
						<li class="dd-item main-table" id="s_<?php echo $day->id;?>">
            <!--<button data-action="collapse" type="button">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>-->
							<div class="col-sm-1 orange-bg">
								<div class="col-sm-12 no-padding top-menu-icon">
									<a href="<?php echo base_url(); ?>admin/edit/section/<?php echo $day->id;?>/<?php echo $program->id; ?>" title="Edit Section" >
										<div class="sprite 8menu" style="background-position: -216px 0; height: 18px;" title="Course Menu"></div>
									</a>
								</div>
								<div class="col-sm-12 no-padding bottom-close-icon">
									<a title="Delete Section" style="cursor:pointer" onClick="return deleteconfirm('<?php echo $day->id;?>','<?php echo $program->id;?>')">
                                    	<div class='sprite 99close' style="background-position: -280px 0; width: 18px; height: 18px;" title="Delete Section"></div>
									</a>
								</div>
							</div>
							<!-- <?php $list = $this->days_model->maxListorder();
							print_r($list);
							 ?> -->
							<div class="col-sm-11 dd-content no-left-padding light-grey-bg">
							  
								<div class="col-sm-12">
									<h4><?php echo $day->title;?></h4>
								</div>
							
							<ul class="dd-list left-padding sortable sortableconnect" id="<?php echo $day->id;?>">
							
							<?php
											$lessons = $this->days_model->getLessons($day->id);											
											if ($lessons):
											 // print_r($lessons);
											foreach ($lessons as $lesson):
											$node++;
											?>
								<li class="dd-item right-sect" id="<?php echo $day->id.'_'.$lesson->id;?>">
									
									<div class="col-sm-1 dd-content light-green-bg" style="padding-left:10px!important; background-color:<?php if($lesson->layoutid == 12){ echo '#9ca6ce'; } else if($lesson->layoutid == 22){ echo '#74c3ca'; } else if($lesson->layoutid == 2){ echo '#a9d795'; } else{ echo '#00C3AA'; }?>">
										<div class="col-sm-12 no-padding top-menu-icon">

									     <?php
									  //  	if($lesson->layoutid == '12')
									  //  	{
									  //  		?>
									    		<!-- <a id="nodeATag2" title="<?php if($lesson->layoutid == '12') { echo 'Edit Exam'; } else { echo 'Edit Lecture'; } ?>"  href="<?php echo base_url(); ?><?php if($lesson->layoutid == '12') { echo 'admin/edit/exam'; } else { echo 'admin/edit/lecure';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>">
											// 	<div class="sprite 8menu" style="background-position: -216px 0; height: 18px;" title="Edit Exam"></div>
											// </a> -->
										 <?php
									  //  	}
									  //  	else 
									   		if($lesson->layoutid == '22')
									   	{
									   		?>
									   		<a id="nodeATag2" title="Edit Webinar"  href='<?php echo base_url(); ?>admin/webinars/edit/<?php echo $day->id;?>/<?php echo $program->id;?>/<?php echo $lesson->is_webinar;?>'>
												<div class="sprite 8menu" style="background-position: -216px 0; height: 18px;" title="Edit Exam"></div>
											</a>
											<?php
									   	}
									   	else if($lesson->layoutid == '2')
									   	{
									   		?>
									   		<a id="nodeATag2" title="Edit Assignment" href="<?php echo base_url(); ?>admin/tasks/edit_assignment/<?php echo $day->id;?>/<?php echo $program->id;?>/<?php echo $lesson->is_assignment;?>">
												<div class="sprite 8menu" style="background-position: -216px 0; height: 18px;" title="Edit Assignment"></div>
											</a>
											<?php
									   	}
									   	else
									   	{
									   		?>
									   		<a id="nodeATag2"  title="<?php if($lesson->layoutid == '12') { echo 'Edit Exam'; } else { echo 'Edit Lecture'; } ?>"  href="<?php echo base_url(); ?><?php if($lesson->layoutid == '12') { echo 'admin/edit/exam'; } else { echo 'admin/edit/lecture';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>">
												<div class="sprite 8menu" style="background-position: -216px 0; height: 18px;" title="Edit Lecture"></div>
											</a>
											<?php
									   	}
									   ?>
									    
										<!--<a id="nodeATag2"  title="<?php if($lesson->layoutid == '12') { echo 'Edit Exam'; } else { echo 'Edit Lecture'; } ?>" class="fancybox fancybox.iframe" href="<?php echo base_url(); ?>admin/tasks/<?php if($lesson->layoutid == '12') { echo 'quizedit'; } else { echo 'edit';} ?>/<?php echo $lesson->tid;?>/<?php echo $day->id;?>/<?php echo $program->id;?>">
											<?php echo $lesson->name;?></a>-->

											<!-- <a style="float:right;"  class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/tasks/delete/<?php echo $lesson->tid;?>/<?php echo $day->id;?>/<?php echo $program->id;?>'><i class="entypo-cancel"></i>Delete</a> -->
									</div>
									<div class="col-sm-12 no-padding bottom-close-icon" style="margin-right: 0!important;">
										 <?php if($lesson->layoutid == '2') { //print_r($lesson);?>

										<a title="Delete Assignment" style="cursor:pointer" onClick="return deleteAssignment('<?php echo $lesson->is_assignment;?>','<?php echo $day->id;?>','<?php echo $program->id;?>')" >
											<div class='sprite 99close' style="background-position: -280px 0; width: 18px; height: 18px;" ></div>
										</a>
										<?php }
										else if($lesson->layoutid == '22' || $lesson->is_webinar != '0')
						                { 
						                //  	$this->load->model('days_model');
						                // $webinar = $this->days_model->getWebinarNew($lesson->is_webinar); 
						                // if ($webinar)
						                // { 
						                //    $web_schedule = $webinar->fromdate.' '.$webinar->fromtime;
						                //      $currentgmt = gmdate('Y-m-d H:i');
						                //      if($currentgmt < $web_schedule )
						                //       { 
						                      	?>
						                 		<!-- <a  title="Delete Webinar" style="cursor:pointer" onClick="return deleteWeb('<?php echo $lesson->is_webinar;?>','<?php echo $day->id?>','<?php echo $program->id;?>')" >
													<div class='sprite 99close' style="background-position: -280px 0; width: 18px; height: 18px;" ></div>
												</a>  -->
											<?php
											 // } else {
											  ?>
                 							 <a title="Delete Webinar" style="cursor:pointer" onClick="return deleteWebExp('<?php echo $lesson->is_webinar;?>','<?php echo $day->id?>','<?php echo $program->id;?>')" >
													<div class='sprite 99close' style="background-position: -280px 0; width: 18px; height: 18px;" ></div>
												</a> 
											<?php
											 // } 
            //           						}  
              							}
                     				else { ?>
										<a title="<?php if($lesson->layoutid == '12') { echo 'Delete Exam'; } else{ echo "Delete Lecture"; } ?>" style="cursor:pointer" onClick="return deleteconfirm2('<?php echo $lesson->id;?>','<?php echo $day->id;?>','<?php echo $program->id ?>')" >
											<div class='sprite 99close' style="background-position: -280px 0; width: 18px; height: 18px;" ></div>
										</a>
										<?php } ?>
									</div>
									</div>
									<div class="col-sm-11 white-bg">
										<div class="col-sm-12 grey-bg">
											<!-- <a href="<?php echo base_url(); ?>admin/tasks/<?php if($lesson->layoutid == '12') { echo 'quizedit'; } else { echo 'edit';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>"><h5 class="lec_name"><?php echo $lesson->name;?></h5></a> -->
											
											<?php if($lesson->layoutid == '2'){  ?>
												<a title="Edit Assignment" href="<?php echo base_url(); ?>admin/tasks/edit_assignment/<?php echo $day->id;?>/<?php echo $program->id;?>/<?php echo $lesson->is_assignment;?>"><h5 class="lec_name"><?php echo $lesson->name;?></h5></a>
											<?php }
											else if($lesson->layoutid == '22'){  ?>
												<a title="Edit Webinar" href='<?php echo base_url(); ?>admin/webinars/edit/<?php echo $day->id;?>/<?php echo $program->id;?>/<?php echo $lesson->is_webinar;?>'><h5 class="lec_name"><?php echo $lesson->name;?></h5></a>
											<?php } else{ ?>
											<a title="<?php if($lesson->layoutid == '12') { echo 'Edit Exam'; } else{ echo "Edit Lecture"; } ?>" href="<?php echo base_url(); ?>admin/edit/<?php if($lesson->layoutid == '12') { echo 'quizedit'; } else { echo 'lecture';} ?>/<?php echo $lesson->id;?>/<?php echo $day->id;?>/<?php echo $program->id;?>"><h5 class="lec_name"><?php echo $lesson->name;?></h5></a>
											<?php } ?>
										</div>
									</div>
								</li>
							<?php endforeach?>
							<?php endif ?>
								
								
							</ul>
							<div class="col-sm-12 bottom-sect">
									<!-- <i class="entypo-right sect"></i> -->
										<!-- <a class='sect inline-position' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/days/delete/<?php echo $day->id?>/<?php echo $this->uri->segment(3)?>'>
											<div class='sprite 99close' style="background-position: -280px 0; width: 18px; height: 18px;" title="Close"></div>
										</a> -->
										
										<a title="Add New Lecture" style="cursor:pointer" class='sect inline-position' href='<?php echo base_url(); ?>admin/create/lecture/<?php echo $day->id;?>/<?php echo $program->id;?>'>
	                                    	<!-- <div style="margin-right: 6%;" title="Add New" class='sprite 1addnew' style="width: 22px; height: 22px; "> -->
	                                    	<div style="margin-right: 6%;" class=''>
	                                    		<img src="<?php echo base_url(); ?>/public/css/image/plus-green.png">
	                                    	</div><p style="padding-top: 2%;">Add Lecture</p>
	                                    </a>
	                                    <a title="Add New Exam" style="cursor:pointer" style="padding-left:3%" class='sect inline-position' href='<?php echo base_url(); ?>admin/create/exam/<?php echo $day->id;?>/<?php echo $program->id;?>'>
	                                    	<!-- <div style="margin-right: 6%;" title="Add New" class='sprite 1addnew' style="width: 22px; height: 22px; "> --><div style="margin-right: 6%;"  class=''>
	                                    		<img src="<?php echo base_url(); ?>/public/css/image/plus-blue.png"></div><p style="padding-top: 2%;">Add Exams</p>
	                                    </a>
	                                    <a title="Add New Assignment" style="cursor:pointer" style="padding-left:3%" class='sect inline-position' href='<?php echo base_url(); ?>admin/tasks/assignment/<?php echo $day->id;?>/<?php echo $program->id;?>'>
	                                    	<!-- <div style="margin-right: 6%;" title="Add New" class='sprite 1addnew' style="width: 22px; height: 22px; "> --><div style="margin-right: 6%;"  class=''>
	                                    		<img src="<?php echo base_url(); ?>/public/css/image/add-circular-green1.png"></div><p style="padding-top: 2%;">Add Assignment</p>
	                                    </a>
	                                    <?php if($program->webstatus == 'active') { ?>
							              <a title="Add New Webinar" style="cursor:pointer" class='sect inline-position' href='<?php echo base_url(); ?>admin/webinars/create/<?php echo $day->id;?>/<?php echo $program->id;?>' class='btn btn-web'>
							              	<div style="margin-right: 6%;"  class=''>
	                                    		<img src="<?php echo base_url(); ?>/public/css/image/add-circular-blue1.png">
	                                    	</div><p style="padding-top: 2%;">Add Webinar</p>
	                                    </a> 
							             <?php } ?>
	                                    <!-- <a  style="float:right;" class='btn btn-danger btn-sm btn-icon icon-left' onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/days/delete/<?php echo $day->id;?>/<?php echo $program->id;?>' class='btn btn-white'>
	                                    <i class="entypo-cancel"></i>Delete </a> -->
	                                    
								</div>
                            </div>
						</li>
                        <?php endforeach?>
					</ul>
						
				</div>
							</div>
			</div>
			<!-- <div class="col-sm-12 new-sect">
				<a class="inline-position" href='<?php echo base_url(); ?>admin/days/create/<?php echo $this->uri->segment(3)?>'>
					<div style="margin-right: 6%;" class='sprite 1addnew' style="width: 22px; height: 22px; "></div><p style="padding-top:4%;">Add New Section</p>
				</a>
			</div> -->
		

<?php else: ?>
	<!-- <p class='text'><?=lang('web_no_elements');?></p> -->
	<p class='text sect-para'>No Section Found In Course</p>
<?php endif ?>

<div class="col-sm-12 new-sect">
				<a style="cursor:pointer" class="inline-position" href='<?php echo base_url(); ?>admin/create/section/<?php echo $this->uri->segment(3)?>'>
					<div style="margin-right: 6%;" title="Add New" class='sprite 1addnew' style="width: 22px; height: 22px; "></div><p style="padding-top:4%;">Add New Section</p>
				</a>
				<div style="float: right;">
				<a class="link_page" style="float: right;color: #00ADEF!important;margin-right: 36px;" href='<?php echo base_url(); ?>admin/edit/courses/<?php echo $program ->id?>'><div class="sprite 7settings" style="float:left;background-position: -184px 0" title="Course Settings"></div><span class="crosslink">Edit Course Settings</span></a>
				</div>
			</div>

			</div>

		</div>


	</div>

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
      	$("#savechanges").css("display","block");      		
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
      $("#savechanges").css("display","block"); 
      
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
	$.confirm({
       title: 'Do you really want to delete Section ?',
       content: ' ',
       confirm: function(){ 
                        window.location.href = "<?php echo base_url(); ?>admin/days/delete/"+id+"/"+seg;
                        						
                                       },
       cancel: function(){        
                       return true;
                               }
                     });
    }

    function deleteconfirm2(lid,id,seg) 
       {
                  
        $.confirm({
              title: 'Do you really want to delete lecture ?',
               content: ' ',
               confirm: function(){ 
                                window.location.href = "<?php echo base_url(); ?>admin/tasks/delete/"+lid+"/"+id+"/"+seg;
														
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
                                window.location.href = "<?php echo base_url(); ?>programs/delete_assignment/"+assign_id+"/"+cid+"/<?php echo $this->uri->segment(3); ?>/admin";
                          
                                   },
                cancel: function(){        
                                 return true;
                                           }
                                 });
               
       }
       function deleteWeb(wid,secid,cid) 
              {
                  
                $j.confirm({
                      title: 'Do you really want to delete webinar ?',
                       content: ' ',
                       confirm: function(){ 
                                        window.location.href = "<?php echo base_url(); ?>webinars/delete/"+wid+"/"+cid+"/admin";
                                  
                                           },
                        cancel: function(){        
                                         return true;
                                                   }
                                         });
                       
               }
               function deleteWebExp(wid,secid,cid) 
              {
                  
                $j.confirm({
                      title: 'Session created in this webinar. Do you really want to delete the webinar ?',
                       content: ' ',
                       confirm: function(){ 
                                        window.location.href = "<?php echo base_url(); ?>webinars/delete2/"+wid+"/"+cid+"/admin";
                                  
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

		    $.confirm({
       title: 'Do you really want to save changes ?',
       content: ' ',
       confirm: function(){              
                        	

                        $j.ajax({
								type: "POST",
								url: "<?php echo base_url(); ?>admin/days/sortingorder",
								data: {sectionSorting:sectionSorting,sectionSortIDS:sectionSortIDS,lectureSortIDS:lectureSortIDS}, 
								success: function(data)
									{	
										//alert(data);
										// if(data == "success")
										// {
										 window.location.href = "<?php echo base_url(); ?>admin/section-management/<?php echo $this->uri->segment(3); ?>";
										//}		
									}
					  		   }); 

                          },
       cancel: function(){        
                       return true;
                         }
                     });

		    

    });
               
</script>
<script type="text/javascript">
	// $j(document).ready(function()
	// {
	// 	if ($('title:contains("Edit Exam")')){
	// 		$('.light-green-bg').css('background-color', 'black');
	// 	}else if($('title:contains("Edit Lecture")')){
	// 		$('.light-green-bg').css('background-color', 'white');

	// 	}
	// });
</script>