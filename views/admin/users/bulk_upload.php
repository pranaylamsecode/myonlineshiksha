

     <div style="">
  <form  enctype="multipart/form-data" id="upfile" method="post" action="<?php echo base_url(); ?>admin/users/excel_upload">
  	<input type="hidden" value="users" name="type">
  <label>Upload Users<br>(only in .csv format)</label>            
    <input type='file' id="file_i" name="file_i" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
    <input type="submit" value="Upload" id="submitbtn" style="display: block;">
<!--     <div id='mImg' style="display:none"><img style="max-width:225px;max-height:175px" src=""></div>
 -->  </form>
</div>

    <div style="">
  <form  enctype="multipart/form-data" id="upfile" method="post" action="<?php echo base_url(); ?>admin/users/excel_upload">
  	  	<input type="hidden" value="reviews" name="type">
  <label>Upload reviews<br>(only in .csv format)</label>            
    <input type='file' id="file_i" name="file_i" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
    <input type="submit" value="Upload" id="submitbtn" style="display: block;">
<!--     <div id='mImg' style="display:none"><img style="max-width:225px;max-height:175px" src=""></div>
 -->  </form>
</div>
 