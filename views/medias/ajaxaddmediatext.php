<?php
  
    $start = ( $this->uri->segment(6))  ? $this->uri->segment(6) : 0;
	$first = $start + 1;
?>

<link rel="stylesheet" href="<?php echo base_url() ?>public/css/my_frontend.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>public/classic/css/bootstrap.css" media="screen"  />
<link rel="stylesheet" href="<?php echo base_url() ?>public/classic/css/bootstrap-responsive.css" media="screen"  />

<script type="text/javascript">
function addmedia(mediaid,medtype,medname,mediagroup){
	if(mediagroup == 'secondtext'){
	parent.jQuery('#text_11').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/11");
	window.parent.document.getElementById("db_text_11").value = mediaid;
	window.parent.document.getElementById("before_menu_txt_11").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_11").style.display = "";
	}
	if(mediagroup == 'firsttext'){
	parent.jQuery('#text_1').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/1");
	parent.jQuery('#text_2').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/2");
	parent.jQuery('#text_3').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/3");
	parent.jQuery('#text_4').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/4");
	parent.jQuery('#text_5').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/5");
	parent.jQuery('#text_6').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/6");
	parent.jQuery('#text_7').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/7");
	parent.jQuery('#text_8').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/8");
	parent.jQuery('#text_9').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/9");
	parent.jQuery('#text_10').load("<?php echo base_url();?>medias/ajaxmediaview/"+mediaid+"/10");
	
	window.parent.document.getElementById("db_text_1").value = mediaid;
	window.parent.document.getElementById("db_text_2").value = mediaid;
	window.parent.document.getElementById("db_text_3").value = mediaid;
	
	window.parent.document.getElementById("db_text_4").value = mediaid;
	window.parent.document.getElementById("db_text_5").value = mediaid;
	
	window.parent.document.getElementById("db_text_6").value = mediaid;
	window.parent.document.getElementById("db_text_7").value = mediaid;
	
	window.parent.document.getElementById("db_text_8").value = mediaid;
	window.parent.document.getElementById("db_text_9").value = mediaid;
	
	window.parent.document.getElementById("db_text_10").value = mediaid;
	
	window.parent.document.getElementById("before_menu_txt_1").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_1").style.display = "";
	window.parent.document.getElementById("before_menu_txt_2").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_2").style.display = "";
	window.parent.document.getElementById("before_menu_txt_3").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_3").style.display = "";
	window.parent.document.getElementById("before_menu_txt_4").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_4").style.display = "";
	
	window.parent.document.getElementById("before_menu_txt_5").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_5").style.display = "";
	window.parent.document.getElementById("before_menu_txt_6").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_6").style.display = "";
	
	window.parent.document.getElementById("before_menu_txt_7").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_7").style.display = "";
	window.parent.document.getElementById("before_menu_txt_8").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_8").style.display = "";
	window.parent.document.getElementById("before_menu_txt_9").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_9").style.display = "";
	
	window.parent.document.getElementById("before_menu_txt_10").style.display = "none";
	window.parent.document.getElementById("after_menu_txt_10").style.display = "";
	}
 //parent.jQuery.fancybox.close();
 //return true;

 parent.jQuery('#cboxClose').click();
	return true;

//parent.jQuery.fancybox.close();
}
</script>

<style>
body
{
font-family: "Helvetica Neue", Helvetica, "Noto Sans", sans-serif, Arial, sans-serif;
font-size: 12px;
line-height: 1.42857143;
color: #949494;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
h2, .h2 {
font-size: 25px;
}
h1, h2, h3 {
margin-top: 17px;
margin-bottom: 8.5px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
font-family: inherit;
font-weight: 500;
line-height: 1.1;
color: #373e4a;
}
a {
color: #373e4a;
text-decoration: none;
}
button, html input[type="button"], input[type="reset"], input[type="submit"] {
-webkit-appearance: button;
cursor: pointer;
}
.btn-success, .btn-green {
color: #fff;
background-color: #00a651;
border-color: #00a651;
}
.btn {
display: inline-block;
margin-bottom: 0;
font-weight: 400;
text-align: center;
vertical-align: middle;
cursor: pointer;
background-image: none;
border: 1px solid transparent;
white-space: nowrap;
padding: 6px 12px;
font-size: 12px;
line-height: 1.42857143;
border-radius: 3px;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}
.btn-success, .btn-green {
color: #ffffff;
background-color: #00a651;
border-color: #00a651;
}

input, button, select, textarea {
font-family: inherit;
font-size: inherit;
line-height: inherit;
}
input {
line-height: normal;
}
button, input, optgroup, select, textarea {
color: inherit;
font: inherit;
margin: 0;
}
.btn-danger {
color: #fff;
background-color: #cc2424;
border-color: #cc2424;
}
.btn {
display: inline-block;
margin-bottom: 0;
font-weight: 400;
text-align: center;
vertical-align: middle;
cursor: pointer;
background-image: none;
border: 1px solid transparent;
white-space: nowrap;
padding: 6px 12px;
font-size: 12px;
line-height: 1.42857143;
border-radius: 3px;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}
@media (min-width: 992px)
.col-md-12 {
width: 100%;
}
.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
position: relative;
min-height: 1px;
padding-left: 15px;
padding-right: 15px;
}
legend {
display: block;
width: 100%;
padding: 0;
margin-bottom: 17px;
font-size: 18px;
line-height: inherit;
color: #7d8086;
border: 0;
border-bottom: 1px solid #e5e5e5;
}

.table-bordered {
border: 1px solid #ebebeb;
}
.table {
width: 100%;
margin-bottom: 17px;
}
table {
max-width: 100%;
background-color: transparent;
}
table {
border-collapse: collapse;
border-spacing: 0;
}
table {
display: table;
border-collapse: separate;
border-spacing: 2px;
border-color: gray;
}
.table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td {
border-top: 0;
}
.table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
border: 1px solid #ebebeb;
}
.table>thead>tr>th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
.table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
border: 1px solid #ebebeb;
}
.table>thead>tr>th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
.table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
border: 1px solid #ebebeb;
}
.table>thead>tr>th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
.table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
border: 1px solid #ebebeb;
}
.table>thead>tr>th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
.table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
border: 1px solid #ebebeb;
}
.table > thead > tr > th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
.table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
border: 1px solid #ebebeb;
}
.table > thead > tr > th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
.table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
border: 1px solid #ebebeb;
}
.table > thead > tr > th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
.table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
background-color: #f5f5f6;
border-bottom-width: 1px;
color: #a6a7aa;
}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
border: 1px solid #ebebeb;
}
.table > thead > tr > th {
vertical-align: bottom;
border-bottom: 2px solid #ebebeb;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ebebeb;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
td, th {
padding: 0;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
th {
text-align: left;
font-weight: 400;
color: #303641;
}
td, th {
padding: 0;
}

.form-control {
float: left;
display: inline-block;
width: 90%;
margin-right: 10px;
margin-bottom: 10px;
height: 31px;
padding: 6px 12px;
font-size: 12px;
line-height: 1.42857143;
color: #555555;
background-color: #ffffff;
background-image: none;
border: 1px solid #ebebeb;
border-radius: 3px;
-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
-moz-transition: border-color ease-in-out .15s, -moz-box-shadow ease-in-out .15s;
-moz-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
-webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
input:not([type]), input[type="email" i], input[type="number" i], input[type="password" i], input[type="tel" i], input[type="url" i], input[type="text" i] {
padding: 1px 0px;
}
user agent stylesheetinput, input[type="password" i], input[type="search" i] {
-webkit-appearance: textfield;
padding: 1px;
background-color: white;
border: 2px inset;
border-image-source: initial;
border-image-slice: initial;
border-image-width: initial;
border-image-outset: initial;
border-image-repeat: initial;
-webkit-rtl-ordering: logical;
-webkit-user-select: text;
cursor: auto;
}
user agent stylesheetinput, textarea, keygen, select, button {
margin: 0em;
font: -webkit-small-control;
color: initial;
letter-spacing: normal;
word-spacing: normal;
text-transform: none;
text-indent: 0px;
text-shadow: none;
display: inline-block;
text-align: start;
}
user agent stylesheetinput, textarea, keygen, select, button, meter, progress {
-webkit-writing-mode: horizontal-tb;
}
textarea.form-control {
height: auto;
}
.form-control1 {
display: block;
width: 100%;
height: auto;
padding: 6px 12px;
font-size: 12px;
line-height: 1.42857143;
color: #555555;
background-color: #ffffff;
background-image: none;
border: 1px solid #ebebeb;
border-radius: 3px;
-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
-moz-transition: border-color ease-in-out .15s, -moz-box-shadow ease-in-out .15s;
-moz-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
-webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
textarea {
overflow: auto;
}
button, input, optgroup, select, textarea {
color: inherit;
font: inherit;
margin: 0;
}
textarea {
font-family: monospace;
border-color: rgb(169, 169, 169);
}
textarea {
-webkit-appearance: textarea;
background-color: white;
border: 1px solid;
border-image-source: initial;
border-image-slice: initial;
border-image-width: initial;
border-image-outset: initial;
border-image-repeat: initial;
-webkit-rtl-ordering: logical;
-webkit-user-select: text;
flex-direction: column;
resize: auto;
cursor: auto;
padding: 2px;
white-space: pre-wrap;
word-wrap: break-word;
}
input, textarea, keygen, select, button {
margin: 0em;
font: -webkit-small-control;
color: initial;
letter-spacing: normal;
word-spacing: normal;
text-transform: none;
text-indent: 0px;
text-shadow: none;
display: inline-block;
text-align: start;
}
input, textarea, keygen, select, button, meter, progress {
-webkit-writing-mode: horizontal-tb;
}

.btn-blue {
color: #fff;
background-color: #0072bc;
border-color: #0072bc;
}
.btn {
display: inline-block;
margin-bottom: 0;
font-weight: 400;
text-align: center;
vertical-align: middle;
cursor: pointer;
background-image: none;
border: 1px solid transparent;
white-space: nowrap;
padding: 6px 12px;
font-size: 12px;
line-height: 1.42857143;
border-radius: 3px;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}
.dataTables_wrapper .col-left {
padding-right: 0;
}
.dataTables_wrapper .col-left {
padding-right: 0;
}
.col-bcl-6 {
width: 45%;
}
.col-bcl-6 {
float: left;
}
.col-bcl-6 {
position: relative;
min-height: 1px;
padding-left: 15px;
padding-right: 15px;
}

.dataTables_wrapper .dataTables_length {
border-right: 0;
-webkit-border-radius: 3px 0 0 0;
-webkit-background-clip: padding-box;
-moz-border-radius: 3px 0 0 0;
-moz-background-clip: padding;
border-radius: 3px 0 0 0;
background-clip: padding-box;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {
background: #fff;
border: 1px solid #ebebeb;
border-bottom: 0;
padding: 15px 12px;
height: 58px;
}


.dataTables_wrapper .col-right {
padding-left: 0;
}

.col-bcr-6{
width: 45%;
}
.col-bcr-6{
float: right;
}
.col-bcr-6{
position: relative;
min-height: 1px;
padding-left: 15px;
padding-right: 15px;
}

.dataTables_wrapper .dataTables_filter {
border-left: 0;
padding-top: 13px;
-webkit-border-radius: 0 3px 0 0;
-webkit-background-clip: padding-box;
-moz-border-radius: 0 3px 0 0;
-moz-background-clip: padding;
border-radius: 0 3px 0 0;
background-clip: padding-box;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter {
background: #fff;
border: 1px solid #ebebeb;
border-bottom: 0;
padding: 15px 12px;
height: 58px;
}

.dataTables_wrapper .dataTables_length:after, .dataTables_wrapper .dataTables_filter:after {
clear: both;
}
.dataTables_wrapper .dataTables_length:before, .dataTables_wrapper .dataTables_filter:before, .dataTables_wrapper .dataTables_length:after, .dataTables_wrapper .dataTables_filter:after {
content: " ";
display: table;
}

</style>


<base href="<?php echo  base_url(uri_string()); ?>" />

<div class="col-md-12">
<div id="content-top">
    <h2>List Media</h2>
    <span class="clearFix">&nbsp;</span>
</div>
</div>

<div class='clear'></div>
<?php
$attributes = array('class' => 'tform', 'name' => 'topform1');
echo form_open_multipart(base_url().'medias/ajaxaddmediatext/'.$medfldgroup."/".$medfldid,$attributes);
?>
<!--<table class="table table-bordered responsive" style="width: 100%;">
		<tbody><tr>
			<td>
				<input type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">
				<input type="submit" value="Search" name="submit_search">
                <input type="submit" value="Reset" name="reset">
			</td>
			<td>
				Media category
				<select name="catid" size="1" class="inputbox" onchange="document.topform1.submit()">
				<option value="">All</option>
				<?php
					foreach ($categories as $category): ?>
					<option value='<?php echo $category->id?>' <?php //echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>
					<?php endforeach ?>
						</select>
			</td>

			<td>
			<select onchange="document.topform1.submit()" size="1" name="type" id="type">
			<option value="">- select -</option>
			<?php foreach($mediatype as $type){
			?>
			<option value="<?php echo $type->name;?>"><?php echo $type->title;?></option>
			<?php
			}
			?>
			</select>
			</td>

		</tr><tr>
	</tr></tbody></table>-->



<div class="col-bcl-6 col-left">
<div id="table-3_length" class="dataTables_length">

<input class="form-control" style="width:auto;" type="text" value="<?php echo set_value('name', (isset($search_string)) ? $search_string : ''); ?>" name="search_text">
				<input type="submit" value="Search" name="submit_search"  class="btn btn-blue">
                <input type="submit" value="Reset" name="reset" class="btn btn-danger">

</div>
</div>


<div class="col-bcr-6 col-right">
<div class="dataTables_filter" id="table-3_filter">



<select name="catid" size="1" class="form-control" style="width:auto;" onchange="document.topform1.submit()">
				<option value="">All</option>
				<?php
					foreach ($categories as $category): ?>
					<option value='<?php echo $category->id?>' <?php //echo  preset_select('category_id', $category->id, (isset($media->catid)) ? $media->catid : $parent_id  ) ?>><?php echo $category->name?></option>
					<?php endforeach ?>
						</select>

<select onchange="document.topform1.submit()" size="1" name="type" id="type" class="form-control" style="width:auto;">
			<option value="">- select -</option>
			<?php foreach($mediatype as $type){
			?>
			<option value="<?php echo $type->name;?>"><?php echo $type->title;?></option>
			<?php
			}
			?>
			</select>


</div>
</div>
    <?php echo form_close(); ?>
<table class="table table-bordered responsive" style="width: 100%;">
<thead>
	 <tr>
		<!--<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>-->
		<th width="20">	ID </th>
		<th>Media Storage</th>
		<th>Type </th>
		<th>Category</th>
		<!--<th>Publish</th>-->
     </tr>
</thead>
<?php if ($medias): ?>
<tbody>
    <?php $i=0;
    	  $iii = 0;	
    ?>
    <?php foreach ($medias as $media): ?>
	<tr class="camp<?php echo $i;?>"> 	    
		<!--<td><?php //print_r($media);?><input type="checkbox" title="Checkbox for row <?php echo $i;?>" onclick="" value="2" name="cid[]" id="cb<?php echo $media->id?>"></td>	  -->
		<td>
	     	<?php echo $media->id;?></td>		
	    <td>
			<a href="javascript:addmedia('<?php echo $media->id?>','<?php echo $media->type?>','<?php echo $media->name?>','<?php echo $medfldgroup?>')" class="a_mlms">
			<?php echo $media->name?></a>
		</td>
		<td>
			<?php echo $media->type?>
		</td>
		<td>
			<?php echo $media->catname?>
        </td>
		<!--<td align="center">
            <?php if($media->published){?>
    		<img alt="Published" src="<?php echo base_url(); ?>public/images/admin/tick.png">
    		<?php }else{?>
    		<img alt="Unpublished" src="<?php echo base_url(); ?>public/images/admin/publish_x.png">
    		<?php }?>
    	</td>-->

	 </tr>
     <?php 
		$iii++;
	endforeach 
     
   
	?>

	<tr>
    	<td colspan="8"><div class="containerpg">
        <div class="pagination">
          <?php echo $this->pagination->create_links();  ?>
        </div>
        </div>
        </td>
   	</tr>
	<?php 
    
	else: ?>

	<tr>

    <td colspan="8">

<?=lang('web_no_elements');?>

</td>

</tr>

<?php endif ?>

<?php echo form_close(); ?>
</tbody>

</table>
</div>
