
<style>
	body .table > tbody > tr > td, body #table-2 > tbody > tr > td {
    background-color: transparent!important;

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
.tab-pane h2.tab_heading{
	margin-bottom: 0!important;
	text-align: left!important
}
.tab-pane i.entypo {
	font-size: 16px!important;
    color: #fff!important;
}
.tab-content>.tab-pane {
    margin-top: 20px;
}
.panel-body.tab-box {
    padding-bottom: 15px!important;
}
</style>
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
		<div class="pagetitle icon-48-generic"><h2 class="tab_heading">Subscription Plans Manager</h2>
			<!-- <div class="pmaintitle main_subtitle mb_20" style="padding-bottom: 0px"> --><h6>You can set your courses in your academy to be a one-time payment or subscription based. Here you can manage the subscription plans. These plans will appear in the course pricing settings.</h6><!-- </div> -->
		</div>
		<div id="toolbar" class="toolbar-list">
		<div id="sticky-anchor"></div>
			<ul id="sticky" style="list-style: none; float: right;">
				<li id="toolbar-new" class="listbutton">
	            <a href="<?php echo base_url(); ?>admin/subplans/create/" onclick="Joomla.submitbutton('edit')" class="btn btn-green">
				<span class="icon-32-new">
				</span><i class="entypo entypo-popup"></i>
				New</a>
				</li>
			</ul>

			
		</div>
	</div>
</div>


<div>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>admin/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>


    <?php endif ?>


</div>



<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
	<thead>
		<tr role="row">
			<!--<th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="
				
					
				
			" style="width: 28px;">
				<div class="checkbox checkbox-replace neon-cb-replacement">
					<label class="cb-wrapper"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"><div class="checked"></div></label>
				</div>
			</th>-->
            <th class="sorting col-sm-3" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending">Name</th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">Term</th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">Period</th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Average Grade: activate to sort column ascending">Published</th>
            
            <th class="sorting col-sm-2" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Options</th>
            
         </tr>
	
    </thead>
<?php if ($subplans): ?>
	
<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php $i=0;?>


<?php foreach ($subplans as $palns): ?>
		<tr class="camp<?php echo $i;?>">
			
			<td class="field-title"><a href="<?php echo base_url(); ?>admin/subplans/edit/<?php echo $palns ->id?>">


			<?php echo $palns->name?></a></td>
			<td class="field-title" ><?php echo $palns->term?></td>
            
            <td class="field-title"><?php echo $palns->period?></td>
            
            <td class="pub"><?php if($palns->published){?>	


		<a title="Publish" href="<?php echo base_url(); ?>admin/subplans/unpublish/<?php echo $palns ->id?> /"><div class="sprite 9999published" style="background-position: -340px 0;"></div></a>


		<?php }else{?>


		<a title="Unpublish" href="<?php echo base_url(); ?>admin/subplans/publish/<?php echo $palns ->id?> /"><div class="sprite 999publish" style=" background-position: -308px 0;"></div></a>


		<?php }?></td>

			<td class="editdelete">
			
		<a class='no-padding' href='<?php echo base_url(); ?>admin/subplans/edit/<?php echo $palns ->id?>'><div class='sprite 2edit' style="background-position: -32px 0;" title="Edit plan"></div></a>	
				
		<a class='' onClick="return deleteconfirm(<?php echo $palns->id?>,'<?php echo $this->uri->segment(3)?>')" ><div class='sprite 4delete' style="background-position: -92px 0; width: 18px;" title="Delete"></div></a>
			</td>
		</tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php else: ?>  
	<p class='text'><?=lang('web_no_elements');?></p>
<?php endif ?>
<!---Pagination-->       
 <?php if($this->pagination->create_links()) { ?>     
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
</div>
<?php } ?>

<!-- The JavaScript -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<!-- <script type="text/javascript" src="<?php echo base_url(); ?>public/tour/js/jquery.easing.1.3.js"></script> -->
       



<script>
var 	$ =jQuery.noConflict();

		function deleteconfirm(id1,id2) 
	      {
		      
			$.confirm({
    			title: 'Do you really want to delete plan ?',
    			content: ' ',
    			confirm: function(){ 
    					 window.location.href = "<?php echo base_url(); ?>admin/subplans/delete/"+id1+"/"+id2;
        
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