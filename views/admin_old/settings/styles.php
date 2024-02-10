<?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'save') ? form_open_multipart(base_url().'admin/settings/styles', $attributes) : form_open_multipart(base_url().'admin/settings/styles');
?>
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
		<div class="pagetitle icon-48-generic"><h2><?php echo 'Style Settings';?></h2></div>
	</div>
</div>

<div class="zone_description">Here you can set up classes for each element on the mlms front end. On the right side you can modify the CSS file. If you don't know CSS, please don't touch this.</div>

	<fieldset class="adminform">
	<legend>Style Settings</legend>

<table width="100%" cellspacing="0" cellpadding="0" class="layout_table">
	</table><table width="100%" cellspacing="0" cellpadding="0">
		<tbody><tr>
			<td width="50%" valign="top">
				<table width="100%" cellspacing="0" cellpadding="0" class="layout_table">
					<!-- ------------------------------- List of categories ------------------------------- -->
					<tbody><tr class="header_row">
						<td>List of categories</td>
						<td>Class</td>
					</tr>
					<tr>
						<td>Page Title</td>
						<td><input type="text" value="<?php echo $st_ctgspage->ctgs_page_title; ?>" name="ctgs_page_title"></td>
					</tr>
					<tr>
						<td>Categories Name</td>
						<td><input type="text" value="<?php echo $st_ctgspage->ctgs_categ_name; ?>" name="ctgs_categ_name"></td>
					</tr>
					<tr>
						<td>Image</td>
						<td><input type="text" value="<?php echo $st_ctgspage->ctgs_image; ?>" name="ctgs_image">            </td>
					</tr>
					<tr>
						<td>Description</td>
						<td><input type="text" value="<?php echo $st_ctgspage->ctgs_description; ?>" name="ctgs_description"></td>
					</tr>
					<tr>
						<td>Read More</td>
						<td>
							<input type="text" value="<?php echo $st_ctgspage->ctgs_st_read_more; ?>" name="ctgs_st_read_more">
						</td>
					</tr>

					<!-- ------------------------------- Category Page ------------------------------- -->
					<tr class="header_row">
						<td colspan="2">Category page</td>
					</tr>
					<tr>
						<td>Category name</td>
						<td>
							<input type="text" value="<?php echo $st_ctgpage->ctg_name; ?>" name="ctg_name">
						</td>
					</tr>
					<tr>
						<td>Image</td>
						<td>
							<input type="text" value="<?php echo $st_ctgpage->ctg_image; ?>" name="ctg_image">
						</td>
					</tr>

					<tr>
						<td>Description</td>
						<td>
							<input type="text" value="<?php echo $st_ctgpage->ctg_description; ?>" name="ctg_description">
						</td>
					</tr>

					<tr>
						<td>Sub Title</td>
						<td>
							<input type="text" value="<?php echo $st_ctgpage->ctg_sub_title; ?>" name="ctg_sub_title">
						</td>
					</tr>

					<!-- ------------------------------- List of Courses ------------------------------- -->
					<tr class="header_row">
						<td colspan="2">List of Courses</td>
					</tr>
					<tr>
						<td>Page Title</td>
						<td>
							<input type="text" value="<?php echo $st_psgspage->courses_page_title; ?>" name="courses_page_title">
						</td>
					</tr>
					<tr>
						<td>Courses Name </td>
						<td>
							<input type="text" value="<?php echo $st_psgspage->courses_name; ?>" name="courses_name">
						</td>
					</tr>
					<tr>
						<td>Image </td>
						<td>
							<input type="text" value="<?php echo $st_psgspage->courses_image; ?>" name="courses_image">
						</td>
					</tr>

					<tr>
						<td>Description	</td>
						<td>
							<input type="text" value="<?php echo $st_psgspage->courses_description; ?>" name="courses_description">
						</td>
					</tr>

					<tr>
						<td>Read More</td>
						<td>
							<input type="text" value="<?php echo $st_psgspage->courses_st_read_more; ?>" name="courses_st_read_more">
						</td>
					</tr>

					<!-- ------------------------------- Course Page ------------------------------- -->
					<tr class="header_row">
						<td colspan="2">Course Page</td>
					</tr>
					<tr>
						<td>Course Name</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_name; ?>" name="course_name">
						</td>
					</tr>
					<tr class="header_row2">
						<td colspan="3">Top Area</td>
					</tr>
					<tr>
						<td>Image</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_image; ?>" name="course_image">
						</td>
					</tr>
					<tr>
						<td>Field Name</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_top_field_name; ?>" name="course_top_field_name">
						</td>
					</tr>
					<tr>
						<td>Field Value</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_top_field_value; ?>" name="course_top_field_value">
						</td>
					</tr>

					<tr class="header_row2">
						<td colspan="3">Tabs</td>
					</tr>
					<tr>
						<td colspan="2">Table of Contents</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Module Name</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_tabs_module_name; ?>" name="course_tabs_module_name">
						</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Lesson name</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_tabs_step_name; ?>" name="course_tabs_step_name">
						</td>
					</tr>
					<tr>
						<td>Description</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_description; ?>" name="course_description">
						</td>
					</tr>
					<tr>
						<td colspan="2">Price </td>
					</tr>

					<tr>
						<td style="padding-left:30px;">Field Name</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_price_field_name; ?>" name="course_price_field_name">
						</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Field Value</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_price_field_value; ?>" name="course_price_field_value">
						</td>
					</tr>
					<tr>
						<td colspan="2">Teacher</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Teacher Name</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_author_name; ?>" name="course_author_name">
						</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Bio</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_author_bio; ?>" name="course_author_bio">
						</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Image</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_author_image; ?>" name="course_author_image">
						</td>
					</tr>
					<tr>
						<td colspan="2">Requirements</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Field Name</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_req_field_name; ?>" name="course_req_field_name">
						</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Field Value</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_req_field_value; ?>" name="course_req_field_value">
						</td>
					</tr>
					<tr class="header_row2">
						<td colspan="3">Buy Now Button</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Button</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_other_button; ?>" name="course_other_button">
						</td>
					</tr>
					<tr>
						<td style="padding-left:30px;">Background</td>
						<td>
							<input type="text" value="<?php echo $st_psgpage->course_other_background; ?>" name="course_other_background">
						</td>
					</tr>

					<!-- ------------------------------- List of Authors ------------------------------- -->
					<tr class="header_row">
						<td colspan="2">List of Teachers</td>
					</tr>

					<tr>
						<td>Page Title </td>
						<td>
							<input type="text" value="<?php echo $st_authorspage->authors_page_title; ?>" name="authors_page_title">
						</td>
					</tr>

					<tr>
						<td>Teachers Name</td>
						<td>
							<input type="text" value="<?php echo $st_authorspage->authors_name; ?>" name="authors_name">
						</td>
					</tr>

					<tr>
						<td>Image</td>
						<td>
							<input type="text" value="<?php echo $st_authorspage->authors_image; ?>" name="authors_image">
						</td>
					</tr>

					<tr>
						<td>Description	</td>
						<td>
							<input type="text" value="<?php echo $st_authorspage->authors_description; ?>" name="authors_description">
						</td>
					</tr>

					<tr>
						<td>Read More</td>
						<td>
							<input type="text" value="<?php echo $st_authorspage->authors_st_read_more; ?>" name="authors_st_read_more">
						</td>
					</tr>

					<!-- ------------------------------- Author Page ------------------------------- -->
					<tr class="header_row">
						<td colspan="2">Teacher Page </td>
					</tr>

					<tr>
						<td>Teachers Name</td>
						<td>
							<input type="text" value="<?php echo $st_authorpage->author_name; ?>" name="author_name">
						</td>
					</tr>

					<tr>
						<td>Image </td>
						<td>
							<input type="text" value="<?php echo $st_authorpage->author_image; ?>" name="author_image">
						</td>
					</tr>

					<tr>
						<td>Description</td>
						<td>
							<input type="text" value="<?php echo $st_authorpage->author_description; ?>" name="author_description">
						</td>
					</tr>

					<tr>
						<td>Read More</td>
						<td>
							<input type="text" value="<?php echo $st_authorpage->author_st_read_more; ?>" name="author_st_read_more">
						</td>
					</tr>
				</tbody></table>
			</td>
			<td valign="top">
				<textarea name="css_file" rows="40" cols="67" class="sty_set">
.title {
	font-size:24px;
	margin:0 0 15px;
}

.name {
	font-size:14px;
	font-weight:bold;
	margin:0 0 9px;
}

.image {
	background:#FFFFFF none repeat scroll 0 0;
	border:1px solid #DDDDDD;
	float:left;
	margin:5px;
	padding:2px;
}

.description {
	font-size:12px;
}

.description_bigger {
	font-size:16px;
}

.sub_title {
	color:#777777;
	font-size:12px;
	font-style:italic;
	font-weight:bold;
	margin:0 0 5px;
	padding:0 0 5px;
}

.field_name {

}

.field_value {

}

.step_name {

}


.course_cell {
	display:block;
	float:left;
}

.course_row {
	float:left;
	padding-top: 15px;
	width:100% !important;
}

.teacher_cell {
	display:block;
	float:left;
}

.teacher_site {
	background-position:0 -16px;
}

.teacher_blog {
	background-position:0 -32px;
}

.teacher_twitter {
	background-position:0 -48px;
}

.teacher_facebook {
	background-position:0 -64px;
}

.teacher_courses_heading {
	color:#777777;
	font-size:12px;
	font-style:italic;
	font-weight:bold;
	margin:0 0 5px;
	padding:0 0 5px;
}

.courses_table_header{
	background-color:#CCCCCC;
}

.white_bg td{
	padding-bottom:2px;
	padding-left:5px;
	padding-top:2px;
}

.subcat_box {
	margin-left:0px;
}

.categ_name {
	font-size:24px;
	margin:0 0 15px;
}

.categories {
	color:#777777;
	font-size:12px;
	font-style:italic;
	font-weight:bold;
	margin:0 0 5px;
	padding:0 0 5px;
}

li.level1{
	list-style:disc;
	line-height:normal;
}

li.level2{
	list-style:circle;
	line-height:normal;
}
.buynow {
	-moz-box-shadow:inset 0px 1px 0px 0px #fff6af;
	-webkit-box-shadow:inset 0px 1px 0px 0px #fff6af;
	box-shadow:inset 0px 1px 0px 0px #fff6af;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffec64), color-stop(1, #ffab23) );
	background:-moz-linear-gradient( center top, #ffec64 5%, #ffab23 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffec64', endColorstr='#ffab23');
	background-color:#ffec64;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #ffaa22;
	display:inline-block;
	color:#333333;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffee66;
}.buynow:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffab23), color-stop(1, #ffec64) );
	background:-moz-linear-gradient( center top, #ffab23 5%, #ffec64 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffab23', endColorstr='#ffec64');
	background-color:#ffab23;
}

.loginformbutton{
-moz-box-shadow:inset 0px 1px 0px 0px #fff6af;
	-webkit-box-shadow:inset 0px 1px 0px 0px #fff6af;
	box-shadow:inset 0px 1px 0px 0px #fff6af;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffec64), color-stop(1, #ffab23) );
	background:-moz-linear-gradient( center top, #ffec64 5%, #ffab23 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffec64', endColorstr='#ffab23');
	background-color:#ffec64;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #ffaa22;
	display:inline-block;
	color:#333333;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 6px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffee66;
}.loginformbutton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffab23), color-stop(1, #ffec64) );
	background:-moz-linear-gradient( center top, #ffab23 5%, #ffec64 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffab23', endColorstr='#ffec64');
	background-color:#ffab23;
}


.buy_background{
	background-color:#E8F1FF;
	font-weight:bold;
	height:50px;
	line-height:50px;
	text-align:center;
}

.bought_background{
	background-color:#FFF7D5;
	font-weight:bold;
	height:50px;
	line-height:35px;
	text-align:center;
}

tr, td {
    border: none !important;
}

.list_courses{
    text-align: left !important;
    line-height: 30px !important;
}
</textarea>
			</td>
		</tr>
</tbody></table>	</fieldset>
     <input type="hidden" value="1" name="id">

	<input type="hidden" value="3" name="tab">
<?php echo form_close(); ?>