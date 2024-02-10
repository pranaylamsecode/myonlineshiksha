<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<?php
$start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
$first = $start + 1;
$u_data=$this->session->userdata('loggedin');
$maccessarr=$this->session->userdata('maccessarr');
?>
<style>
#message {
    position: fixed; 
    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 9999;
}

.jconfirm .jconfirm-box div.title {
  background-color: #f1f1f1!important;
  color: #c42140;
  text-transform: uppercase!important;
  font-size: 19px!important;
  font-weight: bold!important;
  text-align: center!important;
  padding: 7px 30px 0 13px !important;
  border-bottom: 0px!important;
  height: 65px!important;
  font-family: inherit;
}
.btn-success {
  background-color: #04A600;
}
</style>
<?php
	 $CI = & get_instance();
	 $CI->load->model('admin/programs_model'); 
  ?>
  <span id="message"></span> 
  <div class="main-container">
<div id="toolbar-box">
    <div class="m">
         <div class="pagetitle icon-48-generic"><h2>Course Categories</h2></div>
        <div id="toolbar" class="toolbar-list">
          <?php
          if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
          {
          ?>
          <div id="sticky-anchor"></div>
            <ul id="sticky" style="list-style: none; float: right;">
                <li id="toolbar-new" class="listbutton">
                    <a href="<?php echo base_url(); ?>admin/create/course-categories/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">
                    <i class="entypo entypo-popup"></i>
                    <span class="icon-32-new">
                    </span>
                    New
                    </a>
                </li>
            </ul>
          <?php
          }
          ?>
       
        </div>
       
    </div>
</div>
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/pcategories/',$attributes);
?>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">

<!--<form action="<?=site_url('admin/quizzes/')?>" method="post">-->
    <div class=" top-head-box">
      <!-- <div class="dataTables_filter" id="table-3_filter"> -->
      <!-- <div id="table-3_filter"> -->
      <div id="table-3_length">
        <span>
        <input type="text" class="form-control form-height" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text" placeholder="Course Category">
    </span>
    <span>
       <!--  <div id="table-3_length"> -->
          <button type="submit" value="Search" name="submit_search" class="search-btn"><span class="lnr lnr-magnifier"></span></button>    
    </span>    
      <!-- </div> -->
      </div>    
   </div>

<?php echo form_close(); ?>


<?php
$attributes = array('class' => 'tform', 'name' => 'orderform');
// echo form_open_multipart(base_url().'admin/pcategories/',$attributes);
?>

<div class="card">
<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
   	<tr role="row">   
      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Category</div></th>

      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Category Images</div></th>
      
      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="No of Courses"><div class="col-sm-12 no-padding table-title">No. of Courses</div></th>
      
      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Parent Category</div></th>
      
      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title">Published</div></th>
      
      <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" ><div class="col-sm-12 no-padding table-title"><?php echo lang('web_options')?></div></th>
    </tr>
	</thead>

<?php if ($categories): ?>

<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;
      $iii = 0;
   foreach ($categories as $category): ?>

<tr class="odd" id='<?php echo $category->id?>'>
			<td class="field-title" ><?php echo $category->name; ?></td>
      <td class="field-title">
        <img src="<?php echo base_url();?>public/uploads/pcategories/img/<?php if(!empty($category->image)){echo $category->image;}else{echo 'no_images.jpg';} ?>" width='110px'>
      </td>
			<td><?php $ccount = $this->Crud_model->get_single('mlms_program',"catid = ".$category->id,"count(id) as total");
        echo $ccount->total;
       ?></td>
			<td class="field-title " style="text-transform: capitalize;color: #666;">
        <?php if(isset($category->parent_id) && $category->parent_id>0)
        {
            $cate = $CI->programs_model->category_name($category->parent_id);
            echo $cate->name;
        }
        else{ echo "<center> _ </center>"; } ?>
      
            </td>

            <td class="pub">
            <?php
                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
                {
                ?>
                    <?php if($category->published){?>
                    <a title="Click to Unpublish Category" type="button" onclick="return change_Status(<?php echo $category ->id.','.$category->published; ?>)">
                      <div class='sprite 9999published ' style="background-position: -340px 0;"></div></a>
                    <?php }else{?>
                    <a title="Click to Publish Category" type="button" onclick="return change_Status(<?php echo $category ->id.','.$category->published;?>)"><div class='sprite 999publish ' style=" background-position: -308px 0;"></div></a>
                    
                    <?php }?>
                <?php
                }
                else
                echo "No Access";
                ?>
            </td>
			
             <td class="editdelete">
                <?php
                if(!isset($category->is_template) || $category->is_template !=='1')
                    {
                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
                {
                    
                 
                ?>
        <a class='' href='<?php echo base_url(); ?>admin/edit/course-categories/<?php echo $category->id?>/'><div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div></a>
                <?php  }
                
                else
                     echo "Edit : No Access";
                ?>
          
                <?php
                if(($u_data['groupid']=='4') || ($maccessarr['courses']=='modify_all') || ($maccessarr['courses']=='own'))
                {
                	$is_delete = $CI->programs_model->isAllowToDelete($category->id);
                	$is_delete2 = $CI->programs_model->isAllowToDelete2($category->id);
                	if($is_delete > 0 && $is_delete2 > 0)
                	{
	                ?>
	                     <a class='' onClick="return noallowdelete(<?php echo $category->id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
                  <?php
	            	}else
	            	{
	            		?>
                   <a class='' onClick="return deleteconfirm(<?php echo $category->id?>)" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
                    <?php
	            	  } 
                }
                else
                    echo "Delete : No Access";
                }
                ?>
            </td>

			
		</tr>
        <?php
    $i++;
	$iii++;
    endforeach ?>
	
	<?php else: ?>



           <tr><td colspan="11">


		          <p class='text'><?=lang('web_no_elements');?></p>
		      </td>
              </tr>
             <?php endif ?>
	
	
	
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="checkval" value=""/>
        </tbody>

</table>
<!-- <?php echo form_close(); ?> -->

<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
<div class="row pagination">
    <div class="col-xs-6 col-left">
        <div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countpcat; ?> entries</div>
    </div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
        <?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>

<?php } ?>
</div>

<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<script>
function change_Status(id,status)
{
  var base_url = $("#base_url").val();
  // alert(base_url);return false;
    $.ajax({
          type:'POST',
          cache:false,
          url:base_url+"admin/pcategories/changeStatus",
          data:{
            id:id,status:status
          },
          success:function(returndata)
          {
              $(".dataTable").load(location.href+" #table-2");
              // $("#statusModal").modal('show');
              var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+returndata+'</div>';
              var note = $(document).find('#message');
              note.html(str);
              note.show();
              note.fadeIn().delay(3000).fadeOut();
              // alert(returndata);return false; 
          } 
    });
}

    function isChecked(isitchecked) {
        if (isitchecked == true) {
        document.orderform.boxchecked.value++;
        } else {
        document.orderform.boxchecked.value--;
        }
    }
    function listItemTask(id, task) {
        var f = document.orderform;
        var cb = f[id];
        $("#tr"+id).remove();

        if (cb) {
        for (var i = 0; true; i++) {
        var cbx = f['cb'+i];
        if (!cbx)
        break;
        cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        var checkval = $('#'+id+':checked').val();
        document.orderform.checkval.value = checkval;
        submitbutton(task);
        }
        return false;
    }
    function submitbutton(pressbutton) {
        var form = document.orderform;

        submitform ( pressbutton );
    }
    function submitform(pressbutton) {

        if (pressbutton) {
        document.orderform.task.value = pressbutton;
        }
        if (typeof document.orderform.onsubmit == "function") {
        document.orderform.onsubmit();
        }
        if (typeof document.orderform.fireEvent == "function") {
        document.orderform.fireEvent('submit');
        }
        document.orderform.submit();
    }
    function saveorder(n, task) {
        checkAll_button(n, task);
    }
    function checkAll_button(n, task) {
        if (!task) {
        task = 'saveorder';
        }
        document.orderform.submit();
    }
</script>
<!-- The JavaScript -->
	
        
        <script>
var 	$ =jQuery.noConflict();

		function deleteconfirm(id) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete ?',
    			content: ' ',
    			confirm: function(){ 
    					 // window.location.href = "<?php echo base_url(); ?>admin/pcategories/delete/"+id;
                $.ajax({
                      type:"POST",
                      cache:false,        
                      url:"<?php echo base_url(); ?>admin/pcategories/delete",
                      data:{id:id},
                      success:function(returndata)
                      {
                          $(".dataTable").load(location.href + " #table-2");

                          var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+returndata+'</div>';
                          var note = $(document).find('#message');
                          note.html(str);
                          note.show();
                          note.fadeIn().delay(3000).fadeOut();
                      }
                });
   				},
    			cancel: function(){        
    					return true;
    						}
					  });
			
		}

		function noallowdelete(oldId) 
	    {		
			var str ="<select id='categorycombo' class='form-control' style='margin-left: 133px;margin-top: 28px; margin-bottom: 17px; width: 50%;'>";
			<?php foreach ($categories as $category){?>
			 str+="<option value='<?php echo $category->id; ?>'><?php echo $category->name; ?></option>";
			 <?php }?>			 
			 str+="</select>";

		 	$.confirm({
    			title: 'Assign this Category Courses to another Category',
    			content: str,
    			confirm: function(){    					 
        						var newId = $("#categorycombo").val();        						
							     $.ajax({
										type: "POST",
										url: "<?php echo base_url(); ?>admin/pcategories/assigncategory",
										data: {oldId:oldId,newId:newId}, 
										success: function(data)
										{		
											if(data)
											{									
												$.confirm({
							    			title: 'Do you really want to delete ?',
							    			content: '',
							    			confirm: function(){
							    					window.location.href = "<?php echo base_url(); ?>admin/pcategories/delete/"+oldId;
							    					window.location.href = "<?php echo base_url(); ?>admin/pcategories";		
							    								},
								    			cancel: function(){ 							    					
								    					window.location.href = "<?php echo base_url(); ?>admin/pcategories";
								    						}
													  }); 
											 }
											 else
											 {
											 	alert("Category delete Failed");
											 }
											
										}
									  });

   							 },
    			cancel: function(){        
    					return true;
    						}
					  });

		}
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