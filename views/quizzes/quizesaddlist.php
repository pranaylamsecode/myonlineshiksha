<base href="<?php echo $this->config->item('base_url') ?>/public/" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
$('#addbut').live('click',function(e) {
  var ischecked = $("input:checked").length;
           if (ischecked == 0){
			alert("Please select at least one quiz.");
			return false;
		}
        var chks = document.getElementsByName('checkquizzes[]');
        for (var i = 0; i < chks.length; i++){
            if (chks[i].checked){
               $('.checkquizzes:checked').each(function() {
                if ($('.noelement',parent.document).length > 0){
                	$('.noelement',parent.document).remove();
                	}
                   // alert($('#qli'+$(this).val(),parent.document));
                if ($('#qli'+$(this).val(),parent.document).length > 0) {
                }
                else{
                 var qname = $("span#queezname"+$(this).val()).html();
                 //alert(qname);
                  $("#quizzestoaddlist",parent.document).append('<tr id="qli'+$(this).val()+'" style="cursor: move;" class="quizrow" onclick="adddragable();"><td>'+$(this).val()+'</td><td>'+qname+'</td><td><span class="removespan"><a href="javascript:void(0);" onclick="deleteRow(this)"; class="removeele" id="remove'+$(this).val()+'">Remove</a></span></td><td hidden="hidden"><td hidden="hidden"><input type="hidden" name="qidck[]" id="qidck" value="'+$(this).val()+'"></td></tr>');


                }
                });
               parent.jQuery.fancybox.close();
               return true;
        }
   }

 // quiz = document.getElementById('checkquizzes').value;
//  alert(chks.length);


//parent.jQuery.fancybox.close();
/*else{
 var qname = $("span#queezname"+$(this).val()).html();
 $("#quizzestoaddlist",parent.document).append('<li id="qli'+$(this).val()+'"><input type="checkbox" name="qidck[]" checked="checked" value="'+$(this).val()+'">'+qname+'<span class="removespan"><a href="javascript:void(0);" class="removeele" id="remove'+$(this).val()+'">Remove</a></span></li>');
}
} */

//);
});
});
</script>
 <script type="text/javascript">
 $(function(){
  $("#forward").click(function() {
   window.parent.location.href = "<?php echo base_url(); ?>quizzes/create_final/";
   });
});
</script>

<!--<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/colour_standard.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />-->

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
width: 46%;
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

hr {
margin: 15px 0;
border: 0;
border-top: 1px solid #eeeeee;
border-bottom: 1px solid #ffffff;
}
</style>

<div class="col-md-12" style="overflow-x:scroll;">

<div id="content-top">
    <h2>Quiz List</h2>
    <?php if (isset($control)): ?>
    	<a href='<?php echo base_url(); ?>/pcategories/<?=$parent_category?>' class='bforward bforwardmargin'><?=lang('web_category_back')?></a>
    <?php endif ?>
</div>

<div class='clear'></div>
 <?php
$attributes = array('class' => 'tform', 'id' => '','name'=>'search_quiz');
echo ($updType == 'create') ? form_open('/quizzes/quizesaddlist', $attributes) : form_open('/quizzes/editque/'.$question->id.'/'.$qid, $attributes);
?>
<hr /> 
<div class="col-bcl-6 col-left">
<div id="table-3_length" class="dataTables_length">
<input type="text" value="" name="search_text" class="form-control" style="width:auto;">
<input type="submit" value="Search" name="submit_search" class="btn btn-blue">
<input type="submit" value="Reset" name="reset" class="btn btn-danger">    
</div>
</div>

<div class="col-bcr-6 col-right">
<div class="dataTables_filter" id="table-3_filter">
<a style="float: right;"><input type="button" class="btn btn-success" value="Save" id="addbut" name="addbut"></a>
</div>
</div>
<div class="clr"></div>
<hr /> 
    <?php echo form_close(); ?>
 <?php
$attributes = array('class' => 'tform', 'id' => '');
echo ($updType == 'create') ? form_open('/quizzes/quizesaddlist', $attributes) : form_open('/quizzes/editque/'.$question->id.'/'.$qid, $attributes);
?>
<hr /> 
<table class="table table-bordered responsive" style="width: 100%;">
	<thead>
		<tr>
			<th width="5"><input type="checkbox" value="" name="toggle" onclick="checkAll(5)"></th>
			<th width="20">ID</th>
			<th>Quiz</th>
			<th>Questions</th>
			
		</tr>
	</thead>

<?php if ($quizzes): ?>
<tbody>
<?php $i=0;?>
<?php foreach ($quizzes as $quiz):  ?>
	<tr class="camp<?php echo $i;?>"> 	    
		<td>
        <input type="checkbox" title="Checkbox for row <?php echo $i;?>" value="<?php echo $quiz->id?>" name="checkquizzes[]" id="checkquizzes[]" class="checkquizzes">
        </td>
	    <td><?php echo $quiz->id;?></td>
	    <td><span id="queezname<?php echo $quiz->id?>"><?php echo $quiz->name?></span></td>
		<td><?php echo $this->quizzes_model->get_count_questions($quiz->id)?></td>
	</tr>
<?php
endforeach ?>
  <!--<input type="button" value="Add Selected" id="addbut" name="addbut">     -->

</tbody>
  
</table>
<div class="containerpg"><div class="pagination">
              <?php echo $this->pagination->create_links();  ?>

        </div>
        </div>
<?php echo form_close(); ?>
<?php else: ?>

	<p class='text'><?=lang('web_no_elements');?></p>

<?php endif ?>
</div>