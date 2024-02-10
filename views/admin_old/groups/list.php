<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css"> 
<style>
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
  padding: 22px 30px 0 13px !important;
  border-bottom: 0px!important;
  margin-top: 0px!important;
  background-color: #f1f1f1!important;
  height: 73px!important;
}
button.btn.btn-success {
  background-color: #04A600!important;
}
.jconfirm .jconfirm-box .buttons {
  padding: 20px 15px!important;
}
</style>
<?php
   

  $u_data=$this->session->userdata('loggedin');


  $maccessarr=$this->session->userdata('maccessarr');

?>
<div class="main-container">
<div id="toolbar-box">

	<div class="m">

		<div id="toolbar" class="toolbar-list">

        <?php
		if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
		{
        ?>
        <div id="sticky-anchor"></div>
		<ul id="sticky" style="list-style:none; float: right;">        
			<li id="toolbar-new" class="listbutton">
            	<a href="<?php echo base_url(); ?>admin/create/category/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">
				<span class="icon-32-new">
				</span><i class="entypo entypo-popup"></i>
				New
				</a>
			</li>
		</ul>
        <?php
        }
        ?>

		<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'User Category Manager';?></h2></div>
	</div>
</div>


<div>
   <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
    <span class="clearFix">&nbsp;</span>
</div>

<div class='clear'></div>
<!--<table cellspacing="5" cellpadding="5" bgcolor="#FFFFFF" style="width:90%;">
		<tbody><tr>
			<td>
				<input type="text" value="" name="search_text">
				<input type="submit" value="Search" name="submit_search">
			</td>

			<td>Published status
				<select name="course_publ_status" onchange="document.topform1.submit()">
					<option value="YN">- select -</option>
					<option value="Y">Published</option>
					<option value="N">Unpublished</option>
				</select>
			</td>
		</tr><tr>
	</tr></tbody></table>-->

    <!--<table class="zone_description" style="width:90%;">
	<tbody><tr>


		<td style=" padding-left: 5px;">Here's where you set up subscription plans for your courses. You can keep the default plans or create new ones</td>


	</tr>


</tbody></table>-->





<!------------ my code ----------- -->

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid"><table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
			
            <th class="sorting col-sm-6" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Category Names</div></th>            
            <th class="sorting col-sm-6" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Actions</div></th>
        </tr>
	</thead>
	
<?php if ($groups): ?>

<tbody role="alert" aria-live="polite" aria-relevant="all">

<?php $i=0;

//$grpidarr=array('1','2','3','4');
$grpidarr=array('1','2','4');
?>

<?php foreach ($groups as $group): ?>

		<tr class="odd">
        
        
			<td class="field-title" style="color: #949494;text-transform: capitalize;"><?php echo $group->title?></td>
			
			<td class=" ">
				
                <?php
              // if(($u_data['groupid']=='4') || ($maccessarr['users']=='modify_all'))
              // {
                if(!in_array($group ->id,$grpidarr))
                     {
              ?>
              
              <a class="col-sm-2" href="<?php echo base_url(); ?>admin/edit/category/<?php echo $group ->id?>/">
              <div class='sprite 2edit' style="background-position: -32px 0;" title="Course Content"></div>
              </a>

                     <?php
                     if(!in_array($group ->id,$grpidarr))
                     {
                     ?>

              <!-- <a class="btn btn-danger btn-sm btn-icon icon-left" onClick="return confirm('<?php echo lang('web_confirm_delete')?>')" href='<?php echo base_url(); ?>admin/groups/delete/<?php echo $group->id?>'><i class="entypo-cancel"></i>Delete</a> -->
              <a class="col-sm-2" onClick="return deleteconfirm('<?php echo $group->id?>')" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>

                     <?php
                     }
                     ?>
              <?php
              }
              else
              {
              echo "No Access";
              }
          	  ?>
			</td>
		</tr>
        
        
<?php endforeach ?>
    </tbody>
</table>
<?php  if($this->pagination->create_links()) { ?>
<div class="row">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div>
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
<!--<div class="row">
	<div class="col-xs-6 col-left">
    	<div class="dataTables_info" id="table-2_info">Showing 1 to 8 of 60 entries</div>
    </div>
    <div class="col-xs-6 col-right">
    	<div class="dataTables_paginate paging_bootstrap">
        	<ul class="pagination pagination-sm">
            	<li class="prev disabled">
                <a href="#">
                <i class="entypo-left-open"></i>
                </a>
                </li>
                
                <li class="active">
                <a href="#">1</a>
                </li>
                
                <li>
                <a href="#">2</a>
                </li>
                
                <li>
                <a href="#">3</a>
                </li>
                
                <li>
                <a href="#">4</a>
                </li>
                
                <li>
                <a href="#">5</a>
                </li>
                
                <li class="next">
                <a href="#">
                <i class="entypo-right-open"></i>
                </a>
                </li>
           </ul>
        </div>
      </div>
    </div>
</div>-->



<?php else: ?>

	<p class='text'><?=lang('web_no_elements');?></p>

<?php endif ?>


<script>
var   $ =jQuery.noConflict();

    function deleteconfirm(id) 
        {
          
      $.confirm({
          title: 'Do you really want to delete ?',
          content: ' ',
          confirm: function(){ 
               window.location.href = "<?php echo base_url(); ?>admin/groups/delete/"+id;
        
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