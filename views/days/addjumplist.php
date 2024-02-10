

<script src="<?php echo base_url(); ?>public/js/jquery-1.7.1.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
function on_over(id){
document.getElementById(id).style.backgroundColor = "#C8BBBE";
}
function on_out(id){

       var jump_step = document.getElementById("jump_step").value;
       var jump_id = "lesson"+jump_step;
       //alert(id);
  if(jump_id!=id){
			document.getElementById(id).style.background="#FFFFFF";
	   	}
//document.getElementById(id).style.backgroundColor = "#fff";
}

function on_click(taskid, dayid, typesel, tid){
  
document.getElementById("jump_step").value=taskid;
document.getElementById("module_id").value=dayid;
document.getElementById("type_selected").value=typesel;
document.getElementById(tid).style.backgroundColor = "#C8BBBE";
}


	function addJumpButton() {

	if(document.getElementById("jumptxt").value == ''){
	alert("Jump button text can not be blank! ");
	return false;
	}
	if(document.getElementById("jump_step").value == 0 && document.getElementById("module_id").value == 0){
	alert("Please select jump location ! ");
	return false;
	}
	var jump_stepval = document.getElementById("jump_step").value;
	var module_idval = document.getElementById("module_id").value;
	var type_selectedval = document.getElementById("type_selected").value;
	var butsrnoval = document.getElementById("butsrno").value;
	var jumpbutidval = document.getElementById("jumpbutid").value;	
	var jumptxtval = document.getElementById("jumptxt").value;	
	
	var url = "<?php echo base_url();?>days/ajaxjumpbutton"
			jQuery.post(url, { jump_step : jump_stepval, module_id : module_idval, type_selected : type_selectedval, butsrno : butsrnoval, jumpbutid : jumpbutidval, jumptxt : jumptxtval })
			.done(function(data) {
			if(data!=''){
			document.getElementById("jumpbutid").value = data;
			jumpbutidval = document.getElementById("jumpbutid").value;

			}
			window.parent.document.getElementById("jumpbutton<?php echo $butsrno;?>").value = jumpbutidval;
			for(var sno = 1; sno <= 12; sno++ ){
			window.parent.document.getElementById("jmp<?php echo $butsrno;?>L"+sno).style.backgroundColor = "#0000FF";
			window.parent.document.getElementById("jmp<?php echo $butsrno;?>L"+sno).style.color = "#fff";
			window.parent.document.getElementById("jmp<?php echo $butsrno;?>L"+sno).style.padding = "10px 0px";
			window.parent.document.getElementById("jmp<?php echo $butsrno;?>L"+sno).style.fontWeight = "bold";
			window.parent.document.getElementById("jmp<?php echo $butsrno;?>L"+sno).style.textAlign = "center";
			window.parent.document.getElementById("jumptitle<?php echo $butsrno;?>L"+sno).innerHTML = jumptxtval;
			window.parent.document.getElementById("jump<?php echo $butsrno;?>L"+sno).href = "<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/<?php echo $butsrno;?>/"+jumpbutidval;
			window.parent.document.getElementById("jump<?php echo $butsrno;?>L"+sno).style.color = "#fff";
			}
			parent.jQuery('#cboxClose').click();
	        return true;
			});
		}
	</script>
<!--/treemenu scripts and style-->

<!--lightbox scripts and style
	<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />
	

	<!--<script type="text/javascript">

<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>-->
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
<!--/lightbox scripts and style-->
<div class='clear'></div>

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

<?php //if ($days): ?>


	<table class='table table-bordered responsive' style="width:100%">

		<thead>
			<th></th>

			<th></th>
			
		</thead>

		<tbody>
			<?php //foreach ($categories as $category): 
			//print_r($jmpbutinfo);
			?>
				
				
					<tr>
					<td>Jump text * :</td>
					<td>
					<input id="jumptxt" type="text" name="jumptxt" maxlength="256" value="<?php echo set_value('jumptxt', (isset($jmpbutinfo->text)) ? $jmpbutinfo->text : ''); ?>"  /></td>
					<!-- tooltip area -->
						<span class="tooltipcontainer">
						<span type="text" id="title-target" class="tooltipicon"></span>
						<span class="title-target  tooltargetdiv" style="display: none;" >
						<span class="closetooltip"></span>
						<!--tip containt-->
						<?php echo lang('section_fld_title');?>
                         <!--/tip containt-->
						</span>
						</span>
<!-- tooltip area finish -->
					</tr>


					<tr>
						<td valign="top" style="padding-top:16px;">Jump to * :</td>
						<td width="70%" valign="top">
						<?php
                       
						$num=0;
						$node=0;?>
						<ul style="padding-left: 0;">
							<li>
							<!--<span style="margin-top: -10px; color: black; font-family:Arial,Helvetica,sans-serif; font-size:17px;"><b><?php echo $program->name;?></b></span>-->
							
							<?php if ($days): ?>	
								<ul id="" style="padding-left: 0;" class="filetree">
								<?php 
								foreach ($days as $day): 
								$num++;
								?>
									<li style="padding-left: 0;">
									<span class="folder">
									<span id="module<?php echo $day->id;?>" onclick="javascript:on_click('<?php echo $day->id;?>', '<?php echo $day->id;?>', 'module',this.id)" onmouseout="javascript:on_out(this.id)" onmouseover="javascript:on_over(this.id)"><?php echo $day->title;?></span></span>


										<ul style="padding-left: 0;">
											<?php
											$lessons = $this->days_model->getLessons($day->id);											
											if ($lessons):									
											foreach ($lessons as $lesson): 																					
											$module_text = (isset($jmpbutinfo->jump_step) && $jmpbutinfo->jump_step == $lesson->media_id)? 'style="background-color: #C8BBBE;"' : '';
											$node++;
											?>
											<li>
											<span class="screen<?php echo $lesson->layoutid?>tn">
											<span id="lesson<?php echo $lesson->id;?>" <?php echo $module_text; ?> onclick="javascript:on_click('<?php echo $lesson->id;?>','<?php echo $day->id;?>','',this.id)" onmouseout="javascript:on_out(this.id)" onmouseover="javascript:on_over(this.id)" >
											<?php echo $lesson->name;?></span>

											</li>
											<?php endforeach?>
											<?php endif ?>
										</ul>
									</li>
								<?php endforeach?>
								</ul>
							<?php else: ?>
								<p class='text'><?=lang('web_no_elements');?></p>
							<?php endif ?>
							</li>
						</ul>
			
						</td>
						
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
						<input name="savebutton" id="savebutton" onclick="addJumpButton()" type="button" size="16" value="Save" class="btn btn-default" >
						</td>

				
					
				</tr>
				<?php //print_r($jmpbutinfo)?>
				<input type="hidden" name="programid" id="programid" value="<?php echo $pid;?>">
				<input type="hidden" name="butsrno" id="butsrno" value="<?php echo $butsrno;?>">
				<input type="hidden" name="jump_step" id="jump_step" value="<?php echo (isset($jmpbutinfo->jump_step)) ? $jmpbutinfo->jump_step : 0;?>">
				<input type="hidden" name="module_id" id="module_id" value="<?php echo (isset($jmpbutinfo->module_id)) ? $jmpbutinfo->module_id : 0;?>">
				<input type="hidden" name="type_selected" id="type_selected" value="<?php echo (isset($jmpbutinfo->type_selected )) ? $jmpbutinfo->type_selected : '';?>">
				<input type="hidden" name="jumpbutid" id="jumpbutid" value="<?php echo (isset($jmpbutinfo->id)) ? $jmpbutinfo->id : 0;?>">
				
			<?php //endforeach ?>
		</tbody>

	</table>

<?php //else: ?>

	<!--<p class='text'></p>-->

<?php //endif ?>

<!-- tool tip script -->
<script type="text/javascript">
$(document).ready(function(){
	$('.tooltipicon').click(function(){
	var dispdiv = $(this).attr('id');
	$('.'+dispdiv).css('display','inline-block');
	});
	$('.closetooltip').click(function(){
	$(this).parent().css('display','none');
	});
	});
</script>
<!-- tool tip script finish -->