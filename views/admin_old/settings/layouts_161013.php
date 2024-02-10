<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'save') ? form_open_multipart('admin/settings/layouts', $attributes) : form_open_multipart('admin/settings/layouts');
?>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
<div id="toolbar-box">
	<div class="m">
		<div id="toolbar" class="toolbar-list">
			<ul>
			<li id="toolbar-new" class="listbutton">
			<a>
			<?php echo form_submit( 'submit', "","id='submit' class='save_btn'"); ?><br />Save
			</a>
			</li>
			</ul>
			<div class="clr"></div>
		</div>
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Layout Settings';?></h2></div>
	</div>
</div>

<?php //echo form_submit( 'submit', "Save Settings","id='submit' class='beditform'"); ?>

<div class="tab-content">
	<!--Main fieldset-->
	<div class="zone_description">Here you can modify and control the layout of each page and element on the front end. Watch the video tutorial on the right for more information.</div>

	<fieldset class="adminform">
		<legend>Edit layouts</legend>

<script type="text/javascript" language="javascript">
	function IsValidNumeric(sText){
		var ValidChars = "0123456789.";
		var IsNumber=true;
		var Char;
		for (i = 0; i &lt; sText.length &amp;&amp; IsNumber == true; i++) { 
			Char = sText.charAt(i); 
			if (ValidChars.indexOf(Char) == -1)  { IsNumber = false; }
		}
		return IsNumber;
	}
	
	function submitbutton(task){	
		if(document.adminForm.ctgs_image_size.value == ""){
			alert("Categories image size is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.ctgs_image_size.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.ctgs_image_size.value)){
			alert("Categories image size is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.ctgs_description_length.value == ""){
			alert("Categories description length is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.ctgs_description_length.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.ctgs_description_length.value)){
			alert("Categories description length is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.ctg_image_size.value == ""){
			alert("Category image size is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.ctg_image_size.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.ctg_image_size.value)){
			alert("Category image size is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.ctg_description_length.value == ""){
			alert("Category description length is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.ctg_description_length.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.ctg_description_length.value)){
			alert("Category description length is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.courses_image_size.value == ""){
			alert("Courses image size is mandatory and this should be a numeric value! ");
			return false;
		}
		else if(document.adminForm.courses_image_size.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.courses_image_size.value)){
			alert("Courses image size is mandatory and this should be a numeric value! ");
			return false;
		}
		
		else if(document.adminForm.courses_description_length.value == ""){
			alert("Courses description length is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.courses_description_length.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.courses_description_length.value)){
			alert("Courses description length is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.course_image_size.value == ""){
			alert("Course image size is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.course_image_size.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.course_image_size.value)){
			alert("Course image size is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.authors_image_size.value == ""){
			alert("Teachers images size is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.authors_image_size.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.authors_image_size.value)){
			alert("Teachers images size is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.authors_description_length.value == ""){
			alert("Teachers description length is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.authors_description_length.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.authors_description_length.value)){
			alert("Teachers description length is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.author_image_size.value == ""){
			alert("Teacher image size is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.author_image_size.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.author_image_size.value)){
			alert("Teacher image size is mandatory and this should be a numeric value!");
			return false;
		}
		
		else if(document.adminForm.author_description_length.value == ""){
			alert("Teacher description length is mandatory and this should be a numeric value!");
			return false;
		}
		else if(document.adminForm.author_description_length.value != "" &amp;&amp; !IsValidNumeric(document.adminForm.author_description_length.value)){
			alert("Teacher description length is mandatory and this should be a numeric value!");
			return false;
		}
		submitform(task);
	}
</script>


<script type="text/javascript" language="javascript">
	function changeStyleColumns(value, id){
		if(value == 0){
			document.getElementById(id).style.display = "none";
		}
		else{
			document.getElementById(id).style.display = "block";
		}
	}
</script>
<?php //print_r($ctgspage) ?>
<table cellspacing="0" cellpadding="0" class="layout_table">
	<!-- ------------------------------- List of categories ------------------------------- -->
	<tbody>

    <tr class="header_row">
		<td colspan="3">
			Home Page
        </td>
	</tr>

    <tr>
		<td class="layout_table_column1">Logo</td>
		<td class="layout_table_column2">
        <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
				        Choose file
                      <input type="file" name="file_i" id="file_i" class="upload_btn">
                      <input type="hidden" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : ''; ?>" name="imagename" id="imagename">
                           <div id="localimage_i">
                            <img src="<?php echo base_url();?>public/uploads/settings/img/<?php if($this->input->post('imagename')) echo $this->input->post('imagename'); ?>" width="150" id="imgname">
                           </div>
                      </div>
                      <span class="error"><?php echo form_error('file_i'); ?></span><span class="help-inline">Logo (164px X 44px)</span>
		</td>
        <td>
<script type="text/javascript">
$(function() {
	$('#file_i').live('change',function(e) {
	 var ftpfilearray;
	 e.preventDefault();
		$.ajaxFileUpload({
		url :'<?php echo base_url(); ?>admin/settings/upload_image/',
		secureuri :false,
		fileElementId :'file_i',
		dataType : 'json',
		data : {
		'type' : $('select#type').val()
		},
		success : function (data, status)
		{
			if(data.status != 'error')
			{
			$('#msgstatus_i').html('<p>Reloading files...</p>');
			$('#file_i').val('');
			$('#msgstatus_i').html('');
			ftpfileoptions = '<img src="<?php echo base_url(); ?>/public/uploads/settings/img/'+data.ftpfilearray+'" width="150">';
			$('#localimage_i').html(ftpfileoptions);
			ftpfilearray = data.ftpfilearray;
			document.getElementById("imagename").value = ftpfilearray;
			//alert(document.getElementById("imagename").value);
			}
		}
		});
	 return false;
	});
});
</script>
        </td>
    </tr>

    <tr class="header_row">
		<td colspan="3">
			List of categories
        </td>
	</tr>
	<tr>
		<td class="layout_table_column1">
			Layouts		</td>
		<td class="layout_table_column2">
			<select onchange="javascript:changeStyleColumns(this.value, 'td_ctgscols');" name="ctgslayout" id="ctgslayout">
				<option value="0" <?php echo ( $ctgspage->ctgslayout == '0' )? 'selected="selected"' : ''?>>Tree</option>
				<option value="1" <?php echo ( $ctgspage->ctgslayout == '1' )? 'selected="selected"' : ''?>>Mini Profile</option>
			</select>
		</td>
		<td style="display:block;" id="td_ctgscols">			
			<select name="ctgscols" id="ctgscols">
				<option value="cols">Columns</option>
				<option value="1" <?php echo ( $ctgspage->ctgscols == '1' )? 'selected="selected"' : ''?>>1</option>
				<option value="2" <?php echo ( $ctgspage->ctgscols == '2' )? 'selected="selected"' : ''?>>2</option>
				<option value="3" <?php echo ( $ctgspage->ctgscols == '3' )? 'selected="selected"' : ''?>>3</option>				
				<option value="4" <?php echo ( $ctgspage->ctgscols == '4' )? 'selected="selected"' : ''?>>4</option>				
			</select>
			Columns (If tree layout, all the parameters below will be ignored)		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $ctgspage->ctgs_image_size;?>" name="ctgs_image_size" id="ctgs_image_size" typed="text">
		</td>		
		<td>
			<select name="ctgs_image_size_type" id="ctgs_image_size_type">
				<option value="0" <?php echo ( $ctgspage->ctgs_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>				
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctgs_image_alignment" id="ctgs_image_alignment">
				<option value="0" <?php echo ( $ctgspage->ctgs_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>
			
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Wrap Image		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctgs_wrap_image" id="ctgs_wrap_image">
				<option value="0" <?php echo ( $ctgspage->ctgs_image_alignment == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_image_alignment == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>
			
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Length&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $ctgspage->ctgs_description_length;?>" name="ctgs_description_length" id="ctgs_description_length" typed="text">
		</td>		
		<td>
			<select name="ctgs_description_type" id="ctgs_description_type">
				<option value="0" <?php echo ( $ctgspage->ctgs_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>				
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctgs_description_alignment" id="ctgs_description_alignment">
				<option value="0" <?php echo ( $ctgspage->ctgs_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Read More		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctgs_read_more" id="ctgs_read_more">
				<option value="0" <?php echo ( $ctgspage->ctgs_read_more == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_read_more == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>
			
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Read More alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctgs_read_more_align" id="ctgs_read_more_align">
				<option value="0" <?php echo ( $ctgspage->ctgs_read_more_align == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_read_more_align == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Show empty categories		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctgs_show_empty_catgs" id="ctgs_show_empty_catgs">
				<option value="0" <?php echo ( $ctgspage->ctgs_show_empty_catgs == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $ctgspage->ctgs_show_empty_catgs == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>
		</td>
	</tr>
	

	<!-- ------------------------------- Category Page ------------------------------- -->

	<tr class="header_row">
		<td colspan="3">
			Category page		</td>
	</tr>

	<tr>
		<td class="layout_table_column1">
			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $ctgpage->ctg_image_size?>" name="ctg_image_size" id="ctg_image_size" typed="text">			
		</td>		
		<td>
			<select name="ctg_image_size_type" id="ctg_image_size_type">
				<option value="0" <?php echo ( $ctgpage->ctg_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>
				<option value="1" <?php echo ( $ctgpage->ctg_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>				
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctg_image_alignment" id="ctg_image_alignment">
				<option value="0" <?php echo ( $ctgpage->ctg_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $ctgpage->ctg_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Wrap Image		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctg_wrap_image" id="ctg_wrap_image">
				<option value="0" <?php echo ( $ctgpage->ctg_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $ctgpage->ctg_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Length&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $ctgpage->ctg_description_length;?>" name="ctg_description_length" id="ctg_description_length" typed="text">
		</td>		
		<td>
			<select name="ctg_description_type" id="ctg_description_type">
				<option value="0" <?php echo ( $ctgpage->ctg_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>
				<option value="1" <?php echo ( $ctgpage->ctg_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>				
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="ctg_description_alignment" id="ctg_description_alignment">
				<option value="0" <?php echo ( $ctgpage->ctg_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $ctgpage->ctg_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>
			
		</td>
	</tr>
	
	
	<!-- ------------------------------- List of Courses ------------------------------- -->
	
	<tr class="header_row">
		<td colspan="3">

			List of Courses		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Layouts		</td>
		<td class="layout_table_column2">
			<select onchange="javascript:changeStyleColumns(this.value, 'td_coursescols');" name="courseslayout" id="courseslayout">
                 <option value="0" <?php echo ( $psgspage->courseslayout == '0' )? 'selected="selected"' : ''?>>Tree</option>
				<option value="1" <?php echo ( $psgspage->courseslayout == '1' )? 'selected="selected"' : ''?>>Mini Profile</option>
                <!--<option value="0">Tree</option>
				<option selected="selected" value="1">Mini Profile</option>-->
			</select>
			<span title="" class="editlinktip hasTip">
				<img border="0" src="components/com_guru/images/icons/tooltip.png">
			</span>
		</td>		
		<td style="display:block;" id="td_coursescols">
			<select name="coursescols" id="coursescols">
                <option value="">Columns</option>
                <option value="1" <?php echo ( $psgspage->coursescols == '1' )? 'selected="selected"' : ''?>>1</option>
				<option value="2" <?php echo ( $psgspage->coursescols == '2' )? 'selected="selected"' : ''?>>2</option>
				<option value="3" <?php echo ( $psgspage->coursescols == '3' )? 'selected="selected"' : ''?>>3</option>
				<option value="4" <?php echo ( $psgspage->coursescols == '4' )? 'selected="selected"' : ''?>>4</option>

			</select>
			Columns (If tree layout, all the parameters below will be ignored)		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $psgspage->courses_image_size; ?>" name="courses_image_size" id="courses_image_size" typed="text">
		</td>		
		<td>
			<select name="courses_image_size_type" id="courses_image_size_type">
                <option value="0" <?php echo ( $psgspage->courses_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>
				<option value="1" <?php echo ( $psgspage->courses_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>
                <!--<option selected="selected" value="0">Wide</option>
				<option value="1">Height</option>-->
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="courses_image_alignment" id="courses_image_alignment">
                <option value="0" <?php echo ( $psgspage->courses_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $psgspage->courses_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
                <!--<option selected="selected" value="0">Left</option>
				<option value="1">Right</option>-->
			</select>
			<
		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Wrap Image		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="courses_wrap_image" id="courses_wrap_image">
				<option value="0" <?php echo ( $psgspage->courses_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $psgspage->courses_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Length&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $psgspage->courses_description_length;?>" name="courses_description_length" id="courses_description_length" typed="text">
		</td>		
		<td>
			<select name="courses_description_type" id="courses_description_type">
				<option value="0" <?php echo ( $psgspage->courses_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>
				<option value="1" <?php echo ( $psgspage->courses_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="courses_description_alignment" id="courses_description_alignment">
				<option value="0" <?php echo ( $psgspage->courses_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $psgspage->courses_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Read More		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="courses_read_more" id="courses_read_more">
				<option value="0" <?php echo ( $psgspage->courses_read_more == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $psgspage->courses_read_more == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Read More alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="courses_read_more_align" id="courses_read_more_align">
				<option value="0" <?php echo ( $psgspage->courses_read_more_align == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $psgspage->courses_read_more_align == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	
	<!-- ------------------------------- Course Page ------------------------------- -->
	<tr class="header_row">
		<td colspan="3">
			Course Page		</td>
	</tr>
	
	<tr class="header_row2">
		<td colspan="3">
			Top Area		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $psgpage->course_image_size; ?>" name="course_image_size" id="course_image_size" typed="text">
		</td>		
		<td>
			<select name="course_image_size_type" id="course_image_size_type">

				<option value="0" <?php echo ( $psgpage->course_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>
				<option value="1" <?php echo ( $psgpage->course_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_image_alignment" id="course_image_alignment">
				<option value="0" <?php echo ( $psgpage->course_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $psgpage->course_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Wrap Image		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_wrap_image" id="course_wrap_image">
				<option value="0" <?php echo ( $psgpage->course_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $psgpage->course_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Show Image		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="show_course_image" id="show_course_image">
				<option value="0" <?php echo ( $psgpage->show_course_image == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $psgpage->show_course_image == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Teacher Name		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_author_name_show" id="course_author_name_show">
				<option value="0" <?php echo ( $psgpage->course_author_name_show == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_author_name_show == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Released Date		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_released_date" id="course_released_date">
				<option value="0" <?php echo ( $psgpage->course_released_date == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_released_date == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Level		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_level" id="course_level">
				<option value="0" <?php echo ( $psgpage->course_level == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_level == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Price		</td>
		<td class="layout_table_column2">
			<select name="course_price" id="course_price">
				<option value="0" <?php echo ( $psgpage->course_price == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_price == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>
		</td>
		<td>
			<select name="course_price_type" id="course_price_type">
				<option value="0" <?php echo ( $psgpage->course_price_type == '0' )? 'selected="selected"' : ''?>>Lowest Plan</option>
				<option value="1" <?php echo ( $psgpage->course_price_type == '1' )? 'selected="selected"' : ''?>>Price Range</option>
			</select>

		</td>
	</tr>
    <tr>
		<td class="layout_table_column1">
			Lesson Release		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_lesson_release" id="course_lesson_release">
				<option value="0" <?php echo ( $psgpage->course_released_date == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_released_date == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr class="header_row2">
		<td colspan="3">
			Tabs		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Table of Contents		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_table_contents" id="course_table_contents">
				<option value="0" <?php echo ( $psgpage->course_table_contents == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_table_contents == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_description_show" id="course_description_show">
				<option value="0" <?php echo ( $psgpage->course_description_show == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_description_show == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Price		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_tab_price" id="course_tab_price">
				<option value="0" <?php echo ( $psgpage->course_tab_price == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_tab_price == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Teacher		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_author" id="course_author">
				<option value="0" <?php echo ( $psgpage->course_author == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_author == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Requirements		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_requirements" id="course_requirements">
				<option value="0" <?php echo ( $psgpage->course_requirements == '0' )? 'selected="selected"' : ''?>>Show</option>
				<option value="1" <?php echo ( $psgpage->course_requirements == '1' )? 'selected="selected"' : ''?>>Hide</option>
			</select>

		</td>
	</tr>
	
	<tr class="header_row2">
		<td colspan="3">
			Others		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Show 'Buy Now' button		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_buy_button" id="course_buy_button">
				<option value="0" <?php echo ( $psgpage->course_buy_button == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $psgpage->course_buy_button == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			'Buy Now' Location		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="course_buy_button_location" id="course_buy_button_location">
				<option value="0" <?php echo ( $psgpage->course_buy_button_location == '0' )? 'selected="selected"' : ''?>>Top</option>
				<option value="1" <?php echo ( $psgpage->course_buy_button_location == '1' )? 'selected="selected"' : ''?>>Bottom</option>
				<option selected="selected" value="2">Top and bottom</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Show 'Close All/Show all'		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="show_all_cloase_all" id="show_all_cloase_all">
				<option value="0" <?php echo ( $psgpage->show_all_cloase_all == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $psgpage->show_all_cloase_all == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	
	<!-- ------------------------------- List of authors ------------------------------- -->
	
	<tr class="header_row">

		<td colspan="3">

        List of Teachers</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Layouts		</td>
		<td class="layout_table_column2">
			<select onchange="javascript:changeStyleColumns(this.value, 'td_authorscols');" name="authorslayout" id="authorslayout">
				<option value="0" <?php echo ( $authorspage->authorslayout == '0' )? 'selected="selected"' : ''?>>Tree</option>
				<option value="1" <?php echo ( $authorspage->authorslayout == '1' )? 'selected="selected"' : ''?>>Mini Profile</option>
			</select>

		</td>		
		<td style="display:block;" id="td_authorscols">
			<select name="authorscols" id="authorscols">
				<option value="cols">Columns</option>
				<option value="1" <?php echo ( $authorspage->authorscols == '1' )? 'selected="selected"' : ''?>>1</option>
				<option value="2" <?php echo ( $authorspage->authorscols == '2' )? 'selected="selected"' : ''?>>2</option>
				<option value="3" <?php echo ( $authorspage->authorscols == '3' )? 'selected="selected"' : ''?>>3</option>
				<option value="4" <?php echo ( $authorspage->authorscols == '4' )? 'selected="selected"' : ''?>>4</option>
			</select>
			Columns (If tree layout, all the parameters below will be ignored)		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $authorspage->authors_image_size; ?>" name="authors_image_size" id="authors_image_size" typed="text">
		</td>
		<td>
			<select name="authors_image_size_type" id="authors_image_size_type">
				<option value="0" <?php echo ( $authorspage->authors_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>
				<option value="1" <?php echo ( $authorspage->authors_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="authors_image_alignment" id="authors_image_alignment">
				<option value="0" <?php echo ( $authorspage->authors_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $authorspage->authors_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Wrap Image		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="authors_wrap_image" id="authors_wrap_image">
				<option value="0" <?php echo ( $authorspage->authors_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $authorspage->authors_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Length&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="300" name="authors_description_length" id="authors_description_length" typed="text">
		</td>		
		<td>
			<select name="authors_description_type" id="authors_description_type">
				<option value="0" <?php echo ( $authorspage->authors_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>
				<option value="1" <?php echo ( $authorspage->authors_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="authors_description_alignment" id="authors_description_alignment">
				<option value="0" <?php echo ( $authorspage->authors_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $authorspage->authors_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Read More		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="authors_read_more" id="authors_read_more">
				<option value="0" <?php echo ( $authorspage->authors_read_more == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $authorspage->authors_read_more == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Read More alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="authors_read_more_align" id="authors_read_more_align">
				<option value="0" <?php echo ( $authorspage->authors_read_more_align == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $authorspage->authors_read_more_align == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	
	<!-- ------------------------------- Author Page ------------------------------- -->
	
	<tr class="header_row">
		<td colspan="3">
             <?php //print_r($authorpage); ?>
			Teacher Page		</td>
	</tr>	

	<tr>
		<td class="layout_table_column1">
			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $authorpage->author_image_size; ?>" name="author_image_size" id="author_image_size" typed="text">
		</td>		
		<td>
			<select name="author_image_size_type" id="author_image_size_type">
				<option value="0" <?php echo ( $authorpage->author_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>
				<option value="1" <?php echo ( $authorpage->author_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Image Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="author_image_alignment" id="author_image_alignment">
				<option value="0" <?php echo ( $authorpage->author_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $authorpage->author_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Wrap Image		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="author_wrap_image" id="author_wrap_image">
				<option value="0" <?php echo ( $authorpage->author_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>
				<option value="1" <?php echo ( $authorpage->author_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Length&nbsp;<span style="color:#FF0000">*</span>
		</td>
		<td class="layout_table_column2">
			<input value="<?php echo $authorpage->author_description_length; ?>" name="author_description_length" id="author_description_length" typed="text">
		</td>		
		<td>
			<select name="author_description_type" id="author_description_type">
				<option value="0" <?php echo ( $authorpage->author_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>
				<option value="1" <?php echo ( $authorpage->author_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>
			</select>

		</td>
	</tr>
	
	<tr>
		<td class="layout_table_column1">
			Description Alignment		</td>
		<td colspan="2" class="layout_table_column2">
			<select name="author_description_alignment" id="author_description_alignment">
				<option value="0" <?php echo ( $authorpage->author_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>
				<option value="1" <?php echo ( $authorpage->author_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>
			</select>

		</td>
	</tr>
</tbody></table>	</fieldset>
<input type="hidden" value="1" name="id">


</div>
 <?php echo form_close(); ?>         
<?php if ($updType == 'edit'): ?>
	<?php echo form_hidden('id',$id) ?>
<?php endif ?>
<?php echo form_close(); ?>
