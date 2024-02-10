<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/tour/css/jquerytour.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/courses_form.css"> 
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/font-awesome/css/font-awesome.min.css">
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
.clearFix{
	padding-top: 10px;
	padding-bottom: 10px;
}
</style>
<span id="message"></span>
<div class="main-container">
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul id="sticky" style="list-style:none; float: right;  display: flex;">
				<li id="toolbar-new" class="listbutton">
					<a href="<?php echo base_url('partner/create-sub-reseller');?>" class="btn btn-green">
						<span class="icon-32-new"></span><i class="entypo entypo-popup"></i> Add Sub-Reseller
					</a>
				</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2>Manage Sub Reseller</h2></div>
	</div>
</div>
<div class="clearFix">
&nbsp;
</div>
<div id="table-2_wrapper" class="dataTables_wrapper form-inline" role="grid">
	<label class="col-sm-12 control-label field-title">Sub-Resellers You created</label>
	<table class="table table-bordered table-striped datatable dataTable" id="table-2" aria-describedby="table-2_info">
      <thead>
         <tr role="row">
            <th class="sorting col-md-1 col-sm-1 col-xs-1" role="columnheader" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">#</div>
            </th>
            <th class="sorting col-md-3 col-sm-3 col-xs-3" role="columnheader" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">sub-Reseller Name</div>
            </th>
            <th class="sorting col-md-3 col-sm-3 col-xs-3" role="columnheader" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">E-mail</div>
            </th>
            <th class="sorting col-md-2 col-sm-2 col-xs-2" role="columnheader" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Contact No.</div>
            </th>
            <th class="sorting col-md-2 col-sm-2 col-xs-2" role="columnheader" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Commission (%)</div>
            </th>
            <th class="sorting col-md-1 col-sm-1 col-xs-1" role="columnheader" style="text-align: center;">
               <div class="col-sm-12 no-padding table-title">Options</div>
            </th>
         </tr>
      </thead>
      <tbody role="alert" aria-live="polite" aria-relevant="all">
         <?php  $i = 1;
         foreach ($getchilds as $key) {
         ?>
         <tr class="camp0">
            <td class="field-title" style="color: #949494; text-align:center !important;"><?php echo $i;?></td>
            <td class="field-title" style="text-transform: capitalize; color: #949494; text-align:center !important;"><?php echo $key->first_name." ".$key->last_name;?></td>
            <td class="field-title" style="color: #949494; text-align:center !important;"><?php echo $key->email;?></td>
            <td class="field-title" style="color: #949494; text-align:center !important;"><?php echo $key->mobile;?></td>
            <td class="field-title" style="color: #949494; text-align:center !important;"><?php echo $key->assessment; ?> %</td>
            <td class="field-title" style="color: #949494; text-align:center !important;display: flex;">
              <a class="col-sm-4" href="<?php echo base_url('partner/update-sub-reseller/'.$key->user_id);?>" target="_blank"><div class="sprite 2edit" style="background-position: -32px 0;" title="Edit User"></div></a>
            </td>
         </tr>
         <?php $i++;} ?>
      </tbody>
   </table>
<!--Pagination--> 
</div>
</div>