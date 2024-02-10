<link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<style type="text/css">
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
</style>
<?php
    $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
	$first = $start + 1;
?>
<span id="message"></span> 
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
      <div class="pagetitle icon-48-generic"><h2><?php echo 'Coupons';?></h2>
      <h6 class="pmaintitle main_subtitle">Discount coupons for courses will help increase sales volume, allow you to track specific marketing campaign, and best of all, saves your student’s money.</h6></div>
		<div id="toolbar" class="toolbar-list">
			<ul style="float:right; list-style:none;">
			<li id="toolbar-new" class="listbutton">
            <a href="<?php echo base_url(); ?>admin/promocodes/create" onclick="Joomla.submitbutton('edit')" class="btn">
            <i class="entypo entypo-popup"></i>
            <span class="icon-32-new">
            </span>
            Add Coupon
            </a>
			</li>
			</ul>
			
		</div>
	
	</div>
</div>

<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'admin/promocodes/',$attributes);
?>

<div class="top-head-box">
    <div id="table-3_length">
      <span >
      	<input type="text" name="search_promos" value="" class="form-height form-control"placeholder="Promocodes">
      </span>
          <span >      
              <select name="promos_publ_status" onchange="document.topform1.submit()" class="form-height form-control">
              <option value="">Select Published status</option>
              <option value="1">Published</option>
              <option value="0">Unpublished</option>
            </select>
          </span>
          <span>
            <button type="submit" name="submit_src" value="Search" class="search-btn"><span class="lnr lnr-magnifier" ></span></button>   
          </span>
    </div>
</div>

<?php echo form_close(); ?>
<div class="card">
<table class="table table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
	<tr role="row"><th class="sorting_disabled col-sm-1" role="columnheader" rowspan="1" colspan="1" aria-label="" style="text-align:center">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</th>
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Code</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Description</div></th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Curriculum / Occupation: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Date</div></th>
             
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Time used</div></th>
              
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Usage left</div></th>
               
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Published</div></th>
            
            <th class="sorting col-sm-1" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending"><div class="col-sm-12 no-padding table-title">Options</div></th>
            
        </tr>
	</thead>
<?php if ($promocodes):
?>
<?php $i=0;?>
<tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php
        $iii = 0;
        foreach($promocodes as $promocode)
		{
            $active = 1;
            $sit=NULL;
    	    $time_now = date('Y-m-d H:i:s', time());
            $promocode->codestart;
            $promocode->codeend;
            if($time_now<$promocode->codestart){
        		  $active = 0; $sit=1;
        	}elseif(($promocode->codeend!='0000-00-00 00:00:00')&&($time_now>$promocode->codeend)){                      $active = 0; $sit=2;
        	}elseif(isset($promocode->codelimit)&&($promocode->codelimit!=0)&&($promocode->codeused>=$promocode->codelimit)){
        		  $active = 0; $sit=3;
    	    }
        ?>
<tr class="odd camp<?php echo $i;?>">
			<td class=" sorting_1" align="center">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" id="chk-1"><div class="checked"></div></label>
				</div>
			</td>
            <td class="field-title "><?php echo $promocode->code;  ?></td>
			<td class="field-title">
            <a href="<?php echo base_url(); ?>admin/promocodes/edit/<?php echo $promocode->id;?> "class="a_mlms"><?php echo $promocode->title;  ?></a>
            </td>
			<td class="field-title "><?php echo $promocode->codestart; ?></td>
            <td class="field-title "><?php echo $promocode->codeused;  ?></td>
            <td class="field-title " ><?php echo $promocode->codelimit - $promocode->codeused  ?></td>
            <td class=" ">
			<?php if($promocode->published){?>
                  <a title="Publish coupon" type="button" onclick="return change_Status(<?php echo $promocode->id.','.$promocode->published; ?>)"><div class="sprite 9999published" style="background-position: -340px 0;" ></div></a>
                  <?php }else{?>
                  <a title="Unpublish coupon" type="button" onclick="return change_Status(<?php echo $promocode->id.','.$promocode->published; ?>)"><div class="sprite 999publish" style=" background-position: -308px 0;"></div></a>
                  <?php }?>
                  </td>
			<td class="editdelete">
                 <a class='' href="<?php echo base_url(); ?>admin/promocodes/edit/<?php echo $promocode->id?>" >
                 <div class='sprite 2edit' style="background-position: -32px 0;" title="Edit"></div></a>
                  <a class='' onClick="return deleteconfirm(<?php echo $promocode->id?>)" type="button"><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
			</td>
		</tr>
         <?php 
		   $iii++;
		 }  ?>    
         <?php else: ?>
           <tr><td colspan="11">
		          <p class='text'><?=lang('web_no_elements');?></p>
		      </td>
              </tr>
             <?php endif ?>	
        </tbody>
</table>
<?php if($this->pagination->create_links()) { ?>   
<div class="row pagination">
	<div class="col-xs-6 col-left">
		<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countpromo; ?> entries</div>
	</div>
 
    <div class="col-xs-6 col-right">
    <div class="dataTables_paginate paging_bootstrap">
    <ul class="pagination pagination-sm">
		<?php echo $this->pagination->create_links(); ?>
    </ul>
    </div>
    </div>
</div>
</div>
<?php } ?>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<script type="text/javascript">
  function change_Status(id,status)
{
  var base_url = $("#base_url").val();
    $.ajax({
          type:'POST',
          cache:false,
          url:base_url+"admin/promocodes/changeStatus",
          data:{
            id:id,status:status
          },
          success:function(returndata)
          {
              $(".dataTable").load(location.href+" #table-2");
              var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>'+returndata+'</div>';
              var note = $(document).find('#message');
              note.html(str);
              note.show();
              note.fadeIn().delay(3000).fadeOut();
          } 
    });
}

function deleteconfirm(id) 
{     
    $.confirm({
        title: 'Do you really want to delete ?',
        content: ' ',
        confirm: function(){ 
              $.ajax({
                    type:"POST",
                    cache:false,        
                    url:"<?php echo base_url();?>admin/promocodes/delete",
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
</script>