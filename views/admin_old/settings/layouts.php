
<style type="text/css">
	.p2 {
  text-align: -webkit-center;
  padding-right: 4px;
}
</style>
<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/layouts', $attributes) : form_open_multipart(base_url().'admin/settings/layouts');

//print_r($settings);

?>
	

	<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<div id="toolbar-box">

	<div class="m">

		<div class="pagetitle icon-48-generic"><h2><?php echo 'Design Settings';?></h2></div>

	</div>

</div>



<?php //echo form_submit( 'submit', "Save Settings","id='submit' class='beditform'"); ?>



<div class="tab-content">

	<!--Main fieldset-->

	



<fieldset class="adminform">

	<legend></legend>

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

<?php

//print_r($settings);

//$settings[0]['layouttheme'];

 //print_r($ctgspage) ?>

<table cellspacing="0" cellpadding="0" class="layout_table" width="100%">

	<!-- ------------------------------- List of categories ------------------------------- -->

	<tbody>

	

	<!--<tr>

		<td class="layout_table_column1">

			Layouts		</td>

		<td class="layout_table_column2">

			<select onchange="javascript:changeStyleColumns(this.value, 'td_ctgscols');" name="ctgslayout" id="ctgslayout">

				<option value="0" <?php //echo ( $ctgspage->ctgslayout == '0' )? 'selected="selected"' : ''?>>Tree</option>

				<option value="1" <?php //echo ( $ctgspage->ctgslayout == '1' )? 'selected="selected"' : ''?>>Mini Profile</option>

			</select>

		</td>

		<td style="display:block;" id="td_ctgscols">			

			<select name="ctgscols" id="ctgscols">

				<option value="cols">Columns</option>

				<option value="1" <?php //echo ( $ctgspage->ctgscols == '1' )? 'selected="selected"' : ''?>>1</option>

				<option value="2" <?php //echo ( $ctgspage->ctgscols == '2' )? 'selected="selected"' : ''?>>2</option>

				<option value="3" <?php //echo ( $ctgspage->ctgscols == '3' )? 'selected="selected"' : ''?>>3</option>				

				<option value="4" <?php //echo ( $ctgspage->ctgscols == '4' )? 'selected="selected"' : ''?>>4</option>				

			</select>

			Columns (If tree layout, all the parameters below will be ignored)



	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="<?php //echo $ctgspage->ctgs_image_size;?>" name="ctgs_image_size" id="ctgs_image_size" typed="text">

		</td>		

		<td>

			<select name="ctgs_image_size_type" id="ctgs_image_size_type">

				<option value="0" <?php //echo ( $ctgspage->ctgs_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>

				<option value="1" <?php //echo ( $ctgspage->ctgs_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>				

			</select>

		</td>

	</tr>

	-->

	

	<!-- <tr>

		<td class="layout_table_column1">

			Wrap Image		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="ctgs_wrap_image" id="ctgs_wrap_image">

				<option value="0" <?php //echo ( $ctgspage->ctgs_image_alignment == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $ctgspage->ctgs_image_alignment == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>

			

		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Length&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="<?php //echo $ctgspage->ctgs_description_length;?>" name="ctgs_description_length" id="ctgs_description_length" typed="text">

		</td>		

		<td>

			<select name="ctgs_description_type" id="ctgs_description_type">

				<option value="0" <?php //echo ( $ctgspage->ctgs_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>

				<option value="1" <?php //echo ( $ctgspage->ctgs_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>				

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="ctgs_description_alignment" id="ctgs_description_alignment">

				<option value="0" <?php //echo ( $ctgspage->ctgs_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $ctgspage->ctgs_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Read More		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="ctgs_read_more" id="ctgs_read_more">

				<option value="0" <?php //echo ( $ctgspage->ctgs_read_more == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $ctgspage->ctgs_read_more == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>

			

		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Read More alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="ctgs_read_more_align" id="ctgs_read_more_align">

				<option value="0" <?php //echo ( $ctgspage->ctgs_read_more_align == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $ctgspage->ctgs_read_more_align == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>

		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Show empty categories		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="ctgs_show_empty_catgs" id="ctgs_show_empty_catgs">

				<option value="0" <?php //echo ( $ctgspage->ctgs_show_empty_catgs == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $ctgspage->ctgs_show_empty_catgs == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>

		</td>

	</tr>-->

	



	<!-- ------------------------------- Category Page ------------------------------- -->



	


	<!--<tr>

		<td class="layout_table_column1">

			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="<?php //echo $ctgpage->ctg_image_size?>" name="ctg_image_size" id="ctg_image_size" typed="text">			

		</td>		

		<td>

			<select name="ctg_image_size_type" id="ctg_image_size_type">

				<option value="0" <?php //echo ( $ctgpage->ctg_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>

				<option value="1" <?php //echo ( $ctgpage->ctg_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>				

			</select>

		</td>

	</tr>-->

	


	

	<!--<tr>

		<td class="layout_table_column1">

			Wrap Image		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="ctg_wrap_image" id="ctg_wrap_image">

				<option value="0" <?php //echo ( $ctgpage->ctg_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $ctgpage->ctg_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>

		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Length&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="<?php //echo $ctgpage->ctg_description_length;?>" name="ctg_description_length" id="ctg_description_length" typed="text">

		</td>		

		<td>

			<select name="ctg_description_type" id="ctg_description_type">

				<option value="0" <?php //echo ( $ctgpage->ctg_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>

				<option value="1" <?php //echo ( $ctgpage->ctg_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>				

			</select>

		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="ctg_description_alignment" id="ctg_description_alignment">

				<option value="0" <?php //echo ( $ctgpage->ctg_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $ctgpage->ctg_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>

			

		</td>

	</tr>-->

	

	

	<!-- ------------------------------- List of Courses ------------------------------- -->

	

	
	

	<!--<tr>

		<td class="layout_table_column1">

			Layouts		</td>

		<td class="layout_table_column2">

			<select onchange="javascript:changeStyleColumns(this.value, 'td_coursescols');" name="courseslayout" id="courseslayout">

                 <option value="0" <?php //echo ( $psgspage->courseslayout == '0' )? 'selected="selected"' : ''?>>Tree</option>

				<option value="1" <?php //echo ( $psgspage->courseslayout == '1' )? 'selected="selected"' : ''?>>Mini Profile</option>

                <!--<option value="0">Tree</option>

				<option selected="selected" value="1">Mini Profile</option>-->

			<!--</select>

			<span title="" class="editlinktip hasTip">

				<img border="0" src="components/com_guru/images/icons/tooltip.png">

			</span>

		</td>		

		<td style="display:block;" id="td_coursescols">

			<select name="coursescols" id="coursescols">

                <option value="">Columns</option>

                <option value="1" <?php ////echo ( $psgspage->coursescols == '1' )? 'selected="selected"' : ''?>>1</option>

				<option value="2" <?php //echo ( $psgspage->coursescols == '2' )? 'selected="selected"' : ''?>>2</option>

				<option value="3" <?php //echo ( $psgspage->coursescols == '3' )? 'selected="selected"' : ''?>>3</option>

				<option value="4" <?php //echo ( $psgspage->coursescols == '4' )? 'selected="selected"' : ''?>>4</option>



			</select>

			Columns (If tree layout, all the parameters below will be ignored)		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="<?php //echo $psgspage->courses_image_size; ?>" name="courses_image_size" id="courses_image_size" typed="text">

		</td>		

		<td>

			<select name="courses_image_size_type" id="courses_image_size_type">

                <option value="0" <?php //echo ( $psgspage->courses_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>

				<option value="1" <?php //echo ( $psgspage->courses_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>

                <!--<option selected="selected" value="0">Wide</option>

				<option value="1">Height</option>-->

			<!--</select>



		</td>

	</tr>-->

	

	

	<!--<tr>

		<td class="layout_table_column1">

			Wrap Image		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="courses_wrap_image" id="courses_wrap_image">

				<option value="0" <?php //echo ( $psgspage->courses_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $psgspage->courses_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Length&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="<?php //echo $psgspage->courses_description_length;?>" name="courses_description_length" id="courses_description_length" typed="text">

		</td>		

		<td>

			<select name="courses_description_type" id="courses_description_type">

				<option value="0" <?php //echo ( $psgspage->courses_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>

				<option value="1" <?php //echo ( $psgspage->courses_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="courses_description_alignment" id="courses_description_alignment">

				<option value="0" <?php //echo ( $psgspage->courses_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $psgspage->courses_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Read More		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="courses_read_more" id="courses_read_more">

				<option value="0" <?php //echo ( $psgspage->courses_read_more == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $psgspage->courses_read_more == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Read More alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="courses_read_more_align" id="courses_read_more_align">

				<option value="0" <?php //echo ( $psgspage->courses_read_more_align == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $psgspage->courses_read_more_align == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>

	</tr>-->

	

	

	<!-- ------------------------------- Course Page ------------------------------- -->

	

	<!--<tr>

		<td class="layout_table_column1">

			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="<?php //echo $psgpage->course_image_size; ?>" name="course_image_size" id="course_image_size" typed="text">

		</td>		

		<td>

			<select name="course_image_size_type" id="course_image_size_type">



				<option value="0" <?php //echo ( $psgpage->course_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>

				<option value="1" <?php //echo ( $psgpage->course_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>

			</select>



		</td>

	</tr>-->

	


	<!--<tr>

		<td class="layout_table_column1">

			Wrap Image		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_wrap_image" id="course_wrap_image">

				<option value="0" <?php //echo ( $psgpage->course_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $psgpage->course_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Show Image		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="show_course_image" id="show_course_image">

				<option value="0" <?php //echo ( $psgpage->show_course_image == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $psgpage->show_course_image == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Teacher Name		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_author_name_show" id="course_author_name_show">

				<option value="0" <?php //echo ( $psgpage->course_author_name_show == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_author_name_show == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Released Date		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_released_date" id="course_released_date">

				<option value="0" <?php //echo ( $psgpage->course_released_date == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_released_date == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Level		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_level" id="course_level">

				<option value="0" <?php //echo ( $psgpage->course_level == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_level == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Price		</td>

		<td class="layout_table_column2">

			<select name="course_price" id="course_price">

				<option value="0" <?php //echo ( $psgpage->course_price == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_price == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>

		</td>

		<td>

			<select name="course_price_type" id="course_price_type">

				<option value="0" <?php //echo ( $psgpage->course_price_type == '0' )? 'selected="selected"' : ''?>>Lowest Plan</option>

				<option value="1" <?php //echo ( $psgpage->course_price_type == '1' )? 'selected="selected"' : ''?>>Price Range</option>

			</select>



		</td>

	</tr>

    <tr>

		<td class="layout_table_column1">

			Lesson Release		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_lesson_release" id="course_lesson_release">

				<option value="0" <?php //echo ( $psgpage->course_released_date == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_released_date == '1' )? 'selected="selected"' : ''?>>Hide</option>

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

				<option value="0" <?php //echo ( $psgpage->course_table_contents == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_table_contents == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_description_show" id="course_description_show">

				<option value="0" <?php //echo ( $psgpage->course_description_show == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_description_show == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Price		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_tab_price" id="course_tab_price">

				<option value="0" <?php //echo ( $psgpage->course_tab_price == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_tab_price == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Teacher		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_author" id="course_author">

				<option value="0" <?php //echo ( $psgpage->course_author == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_author == '1' )? 'selected="selected"' : ''?>>Hide</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Requirements		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_requirements" id="course_requirements">

				<option value="0" <?php //echo ( $psgpage->course_requirements == '0' )? 'selected="selected"' : ''?>>Show</option>

				<option value="1" <?php //echo ( $psgpage->course_requirements == '1' )? 'selected="selected"' : ''?>>Hide</option>

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

				<option value="0" <?php //echo ( $psgpage->course_buy_button == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $psgpage->course_buy_button == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			'Buy Now' Location		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="course_buy_button_location" id="course_buy_button_location">

				<option value="0" <?php //echo ( $psgpage->course_buy_button_location == '0' )? 'selected="selected"' : ''?>>Top</option>

				<option value="1" <?php //echo ( $psgpage->course_buy_button_location == '1' )? 'selected="selected"' : ''?>>Bottom</option>

				<option selected="selected" value="2">Top and bottom</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Show 'Close All/Show all'		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="show_all_cloase_all" id="show_all_cloase_all">

				<option value="0" <?php //echo ( $psgpage->show_all_cloase_all == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $psgpage->show_all_cloase_all == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	-->

	

	<!-- ------------------------------- List of authors ------------------------------- -->

	

	
	

	

	

		<!--<<td>

			<select name="authors_image_size_type" id="authors_image_size_type">

				<option value="0" <?php //echo ( $authorspage->authors_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>

				<option value="1" <?php //echo ( $authorspage->authors_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>

			</select>	



		</td>-->

	</tr>

	

	<!--<tr>

		<td class="layout_table_column1">

			Image Alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="authors_image_alignment" id="authors_image_alignment">

				<option value="0" <?php //echo ( $authorspage->authors_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $authorspage->authors_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Wrap Image		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="authors_wrap_image" id="authors_wrap_image">

				<option value="0" <?php //echo ( $authorspage->authors_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $authorspage->authors_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Length<span style="color:#FF0000">*</span>

		</td>

		<td class="layout_table_column2">

			<input value="300" name="authors_description_length" id="authors_description_length" typed="text">

		</td>		

		<td>

			<select name="authors_description_type" id="authors_description_type">

				<option value="0" <?php //echo ( $authorspage->authors_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>

				<option value="1" <?php //echo ( $authorspage->authors_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="authors_description_alignment" id="authors_description_alignment">

				<option value="0" <?php //echo ( $authorspage->authors_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $authorspage->authors_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Read More		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="authors_read_more" id="authors_read_more">

				<option value="0" <?php //echo ( $authorspage->authors_read_more == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $authorspage->authors_read_more == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Read More alignment		</td>

		<td colspan="2" class="layout_table_column2">

			<select name="authors_read_more_align" id="authors_read_more_align">

				<option value="0" <?php //echo ( $authorspage->authors_read_more_align == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $authorspage->authors_read_more_align == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>-->

	</tr>

	

	

	<!-- ------------------------------- Author Page ------------------------------- -->

	

	<!--<tr class="header_row">

		<td colspan="3">

             <?php //print_r($authorpage); ?>

			Teacher Page		</td>

	</tr>	



	<tr>

		<td class="layout_table_column1">

			Image size (in pixels)&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="">

			<input value="<?php //echo $authorpage->author_image_size; ?>" name="author_image_size" id="author_image_size" typed="text">

		</td>		

		<td>

			<select name="author_image_size_type" id="author_image_size_type">

				<option value="0" <?php //echo ( $authorpage->author_image_size_type == '0' )? 'selected="selected"' : ''?>>Wide</option>

				<option value="1" <?php //echo ( $authorpage->author_image_size_type == '1' )? 'selected="selected"' : ''?>>Height</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Image Alignment		</td>

		<td colspan="2" class="">

			<select name="author_image_alignment" id="author_image_alignment">

				<option value="0" <?php //echo ( $authorpage->author_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $authorpage->author_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Wrap Image		</td>

		<td colspan="2" class="">

			<select name="author_wrap_image" id="author_wrap_image">

				<option value="0" <?php //echo ( $authorpage->author_wrap_image == '0' )? 'selected="selected"' : ''?>>Yes</option>

				<option value="1" <?php //echo ( $authorpage->author_wrap_image == '1' )? 'selected="selected"' : ''?>>No</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Length&nbsp;<span style="color:#FF0000">*</span>

		</td>

		<td class="">

			<input value="<?php //echo $authorpage->author_description_length; ?>" name="author_description_length" id="author_description_length" typed="text">

		</td>		

		<td>

			<select name="author_description_type" id="author_description_type">

				<option value="0" <?php //echo ( $authorpage->author_description_type == '0' )? 'selected="selected"' : ''?>>Characters</option>

				<option value="1" <?php //echo ( $authorpage->author_description_type == '1' )? 'selected="selected"' : ''?>>Words</option>

			</select>



		</td>

	</tr>

	

	<tr>

		<td class="layout_table_column1">

			Description Alignment		</td>

		<td colspan="2" class="">

			<select name="author_description_alignment" id="author_description_alignment">

				<option value="0" <?php //echo ( $authorpage->author_description_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php //echo ( $authorpage->author_description_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>



		</td>

	</tr>-->

</tbody>
</table>

	

</fieldset>

<input type="hidden" value="1" name="id">

</div>

<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<h3>Edit Design</h3> (Here you can modify and control the design of your Online Academy.)
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
					
                    <!--<div><h4>Home Page</h4></div>-->
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Logo :</label>
						
						<div class="col-sm-5">
                                  <input type="file" name="file_i" id="file_i" class="form-control">

                                  <input type="hidden" class="form-control" value="<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" name="imagename" id="imagename">

                     

					<div id="localimage_i">

						<img src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo ($this->input->post('imagename')) ? $this->input->post('imagename') : $settings[0]['logoimage']; ?>" width="150" id="imgname">

                    </div>

                    <span class="error"><?php echo form_error('file_i'); ?></span><span class="help-inline">Logo (164px X 44px)</span>


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



$(function() {
	$('#layouttemplate').change(function(){
		var selectedval = $('#layouttemplate option:selected').val();
		var alllayouts = JSON.parse('<?php echo $alllayouts;?>');
		var childThemesbox=document.getElementById('layouttheme');
		var selectedtemplate = "<?php echo $settings[0]['layout_template'];?>";
		var selectedtheme = "<?php echo $settings[0]['layouttheme'];?>";
		$('#layouttheme').children().remove();
		for (var key in alllayouts) {
			var template = key;
			if(selectedval == key){
			var allthemes = alllayouts[key];
				$.each( allthemes, function( ckey, cvalue ) {
					var name = cvalue.name;
					var displayname = name.substring(0, name.length - 4);
					var isselected = false;
					if (selectedtemplate == key && selectedtheme == name) {
					isselected = true;
					}
					childThemesbox.options[ckey] =new Option(displayname, name, isselected, isselected);
				  
				});
				}
		}
		/*if($('#layouttemplate').val() == 'corporate'){
			$('.themegroup1').hide();
			$('.themegroup2').show();
		}else{
			$('.themegroup2').hide();
			$('.themegroup1').show();
		}*/
	});
	$('#banner_image').live('change',function(e) {

	 var ftpfilearray;

	 e.preventDefault();

		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>admin/settings/upload_banner/',

		secureuri :false,

		fileElementId :'banner_image',

		dataType : 'json',

		data : {

		'type' : $('select#type').val()

		},

		success : function (data, status)

		{

			if(data.status != 'error')

			{

			$('#msgstatus_i').html('<p>Reloading files...</p>');

			$('#banner_image').val('');

			$('#msgstatus_i').html('');

			ftpfileoptions = '<img src="<?php echo base_url(); ?>/public/uploads/settings/img/'+data.ftpfilearray+'" width="150">';

			$('#bannerlocalimage_i').html(ftpfileoptions);

			ftpfilearray = data.ftpfilearray;

			document.getElementById("bannerimagename").value = ftpfilearray;

			//alert(document.getElementById("bannerimagename").value);

			}

		}

		});

	 return false;

	});

});

</script>
                            
                            
						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    
                    <!--<div>
                    	<h4>Template</h4>
                    </div>-->
                     <!--<div>
                    	<h5><a href="<?php echo base_url().'admin/settings/addlayout';?>" style="color: #2BB8AC;
text-decoration: underline;" class="fancybox fancybox.iframe">Add New Layout</a></h5>
                    </div>
                    <div class="form-group" style="margin-top:20px;">
						<label class="col-sm-3 control-label">Template Name :</label>
						
						<div class="col-sm-5">
							
                            <?php $allLayouts = json_decode($alllayouts);
					
					$templates = array();
					$themes = array();
					foreach ($allLayouts as $key => $values) {
						$templates[] = $key;
						if ($settings[0]['layout_template'] == $key) {
							foreach ($values as $ckey => $cvalue) {
							$themes[] = $cvalue->name;
							}
						}
					}
					?>
					<select name="layouttemplate" id="layouttemplate" class="form-control">
					<?PHP foreach ($templates as $key => $value) {
					?>
					<option value="<?php echo $value;?>" <?php echo ( $settings[0]['layout_template'] == $value )? 'selected="selected"' : ''?>><?php echo $value;?></option>
					<?php
					}?>
					</select>
					<!-- tooltip area -->
				<!--<span class="tooltipcontainer">
					<span type="text" id="layouttemplate-target" class="tooltipicon"></span>
					<span class="layouttemplate-target  tooltargetdiv" style="display: none;" >
					<span class="closetooltip"></span>
					<!--tip containt-->
					<?php echo lang('layout_fld_template');?>
					<!--/tip containt-->
					<!--</span>
					</span>	
					<!-- tooltip area finish -->
						<!--</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>-->
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Style :</label>
						
						<div class="col-sm-5">
							
                            <!--theme group for template 1-->
<div class="themegroup1">
	<select name="layouttheme" id="layouttheme" class="form-control">
		<?php foreach ($themes as $key => $value) {
		?>
		<option value="<?php echo $value;?>" <?php echo ( $settings[0]['layouttheme'] == $value )? 'selected="selected"' : ''?>><?php echo substr($value, 0, -4);?></option>
		<?php	
		}?>
	</select>
</div>
<!--theme group for template 2-->
<!-- <div class="themegroup2" <?php //echo ( $settings[0]['layout_template'] == 'default' )? 'style="display:none;"' : ''?>>
<select name="layouttheme2" id="layouttheme2">
<option value="red.css" <?php //echo ( $settings[0]['layouttheme'] == 'red.css' )? 'selected="selected"' : ''?>>Style Red </option>
<option value="blue.css" <?php //echo ( $settings[0]['layouttheme'] == 'blue.css' )? 'selected="selected"' : ''?>>Style Blue</option>
<option value="green.css" <?php// echo ( $settings[0]['layouttheme'] == 'green.css' )? 'selected="selected"' : ''?>>Style Green</option>
<option value="orange.css" <?php //echo ( $settings[0]['layouttheme'] == 'orange.css' )? 'selected="selected"' : ''?>>Style Orange</option>
</select></div> -->
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="layouttheme2-target" class="tooltipicon"></span>
						<span class="layouttheme2-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_themes');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    <!--<div>
                    	<h4>Menu Position</h4>
                    </div>-->
                    <div class="form-group">
						<label class="col-sm-3 control-label">Menu Position :</label>
						
						<div class="col-sm-5">
							
                            <select name="ctgs_image_alignment" id="ctgs_image_alignment" class="form-control">

				<option value="0" <?php echo ( $ctgspage->ctgs_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php echo ( $ctgspage->ctgs_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="menu_alignment-target" class="tooltipicon"></span>
						<span class="menu_alignment-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_menu-alignment');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->


					</div>
						<p class="p2">This is the Nevigational Menu visible at the top of your Online Academy.</p>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                   <!-- <div>
                    	<h4>Search Position</h4>
                    </div>-->
                    <div class="form-group">
						<label class="col-sm-3 control-label">Search Box :</label>
						
						<div class="col-sm-5">
							
                            <select name="ctg_image_alignment" id="ctg_image_alignment" class="form-control">

				<option value="0" <?php echo ( $ctgpage->ctg_image_alignment == '0' )? 'selected="selected"' : ''?>>Enable</option>

				<option value="1" <?php echo ( $ctgpage->ctg_image_alignment == '1' )? 'selected="selected"' : ''?>>Disabled</option>

			</select>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="search_alignment-target" class="tooltipicon"></span>
						<span class="search_alignment-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_search-alignment');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    <!--<div>
                    	<h4>Signup Position</h4>
                    </div>-->
                    <div class="form-group">
						<label class="col-sm-3 control-label">Sign-up Box Position :</label>
						
						<div class="col-sm-5">
							
                            <select name="courses_image_alignment" id="courses_image_alignment" class="form-control">

                <option value="0" <?php echo ( $psgspage->courses_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php echo ( $psgspage->courses_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="signup_alignment-target" class="tooltipicon"></span>
						<span class="signup_alignment-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_signup-alignment');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
						<div>
						<p class="p2">This is the place through which users will login/register in your Online Academy.</p>
					</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    <!--<div>
                    	<h4>Sidebar Position</h4>
                    </div>-->
                    <div class="form-group">
						<label class="col-sm-3 control-label">Sidebar Block Position</label>
						
						<div class="col-sm-5">
						
			<select name="course_image_alignment" id="course_image_alignment" class="form-control">

				<option value="0" <?php echo ( $psgpage->course_image_alignment == '0' )? 'selected="selected"' : ''?>>Left</option>

				<option value="1" <?php echo ( $psgpage->course_image_alignment == '1' )? 'selected="selected"' : ''?>>Right</option>

			</select>

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="sidebar_alignment-target" class="tooltipicon"></span>
						<span class="sidebar_alignment-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_sidebar-alignment');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->

						</div>
						
						<div>
						<p class="p2">This block appearing in your Online Academy Home page whose type and content you can manage from Widget Manager.</p>
					</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
				
					
                    <div>
                    	<h4>Banner</h4>
                    </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Banner Title :</label>
						
						<div class="col-sm-5">
				
                            <input type="text" class="form-control" placeholder="Enter Your Bannner Title" name="banner_title" id="banner_title" value="<?php echo $authorspage->banner_title;?>">

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="banner_title-target" class="tooltipicon"></span>
						<span class="banner_title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_banner-title');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    
                    
                    <div class="form-group">
						<label class="col-sm-3 control-label">Banner Image</label>
						
						<div class="col-sm-5">
							
							<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">								                    
                                <div class="fileinput-new thumbnail"  data-trigger="fileinput">
								<input type="file" name="banner_image" id="banner_image" class="upload_btn">
								<input type="hidden" value="<?php echo ($this->input->post('banner_image')) ? $this->input->post('banner_image') : $authorspage->banner_image; ?>" name="bannerimagename" id="bannerimagename">
								</div>			

								<div id="bannerlocalimage_i">
									<img src="<?php echo base_url();?>public/uploads/settings/img/<?php echo ($this->input->post('banner_image')) ? $this->input->post('banner_image') : $authorspage->banner_image; ?>" width="150" id="imgname">
								</div>		                                
							</div>							
						</div>
					</div> 
                    <br />
                    <br />
                    <div style="clear:both;"></div>
                    
                    <div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label">Banner Description :</label>
						
						<div class="col-sm-9">
							
                            
                            <!-- <textarea name="banner_desc" id="banner_desc"><?php //echo $authorspage->banner_desc;?></textarea>-->

			

			<textarea name="banner_desc" id="banner_desc" class="form-control" rows="6">

      <?php echo ($this->input->post('banner_desc')) ? $this->input->post('banner_desc') : ((isset($authorspage->banner_desc) && $authorspage->banner_desc!='') ? $authorspage->banner_desc : ''); ?></textarea>

                            
                            <br />
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="banner_desc-target" class="tooltipicon"></span>
						<span class="banner_desc-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_banner-description');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
                    <br />
                    <br />
                    <br />

                    <div style="clear:both;"></div>
     <!--new code here start -->
                    <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Meta Title :</label>
						
						<div class="col-sm-5">
				
                            <input type="text" class="form-control" placeholder="Enter Your Meta Title" name="meta_title" id="meta_title" value="<?php echo $settings[0]['meta_title'] ?>">

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="meta_title-target" class="tooltipicon"></span>
						<span class="meta_title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_meta-title');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
						
                    <br />
                    <br />
					<div style="clear:both;"></div>
					<!--newnnnn -->
					<div class="form-group">
						<label for="field-ta" class="col-sm-3 control-label">Meta Description :</label>
						
						<div class="col-sm-9">   
			
			<textarea name="meta_desc" id="meta_desc" class="form-control" rows="6">

      <?php echo ($this->input->post('banner_desc')) ? $this->input->post('banner_desc') : ((isset($settings[0]['meta_desc']) && $settings[0]['meta_desc']!='') ? $settings[0]['meta_desc'] : ''); ?></textarea>

                            
                            <br />
<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="meta_desc-target" class="tooltipicon"></span>
						<span class="meta_desc-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_meta-description');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
<!--newwww -->
 <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Meta Keywords :</label>
						
						<div class="col-sm-5">
				
                            <input type="text" class="form-control" placeholder="Enter Meta Keywords" name="meta_keyword" id="meta_keyword" value="<?php echo $settings[0]['meta_keyword'];?>">

<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="meta_keyword-target" class="tooltipicon"></span>
						<span class="meta_keyword-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('layout_fld_meta_keyword');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
						</div>
					</div>
						<br />
                    <br />
                    <br />
					<div style="clear:both;"></div>
					<br />
                    <br />

     <!--new code here end -->
    
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<?php echo form_submit( 'submit', "Save","id='submit' class='btn btn-default'"); ?><br />
						</div>
					</div>
				
			</div>
		
		</div>
	
	</div>







<?php echo form_close(); ?>         

<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$id) ?>

<?php endif ?>

<?php echo form_close(); ?>

<script>
 jQuery(document).ready(
	 function()
	 {
		jQuery('#banner_desc').redactor();
		jQuery('#meta_desc').redactor();
	 }
 );
 </script>


<!-- tool tip script -->

<script type="text/javascript">

//jQuery(document).ready(function(){

//	jQuery('.tooltipicon').click(function(){

//	var dispdiv = jQuery(this).attr('id');

//	jQuery('.'+dispdiv).css('display','inline-block');

//	});

//	jQuery('.closetooltip').click(function(){

//	jQuery(this).parent().css('display','none');

//	});

//	});

jQuery(document).ready(function(){
	jQuery('.tooltipicon').mouseenter(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','inline-block');
	});
	jQuery('.tooltipicon').mouseleave(function(){		
	var dispdiv = jQuery(this).attr('id');
	jQuery('.'+dispdiv).css('display','none');
	});
	});

	</script>

<!-- tool tip script finish -->