<base href="<?php echo $this->config->item('base_url') ?>/public/" />

   <!-- <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />-->

	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />

	<!--<link rel="stylesheet" href="css/colour_standard.css" type="text/css" media="screen" />-->

	<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>

	<script src="js/jquery-ui-1.8.21.custom.min.js" type="text/javascript"></script>

    <!--<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />-->

    <link rel="stylesheet" href="css/datetimepicker.css" type="text/css" media="screen" />

<!--lightbox scripts and style

	<script type="text/javascript" src="<?php //echo base_url(); ?>/public/js/jquery-1.9.0.min.js"></script>-->

	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.mousewheel-3.0.6.pack.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.js?v=2.1.4"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/jquery.fancybox.css?v=2.1.4" media="screen" />

	<script type="text/javascript">

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


	</script>


	<style type="text/css">

body {
  overflow-x: hidden;
}

.btnFloat
{
	display: inline-block;
	float: left;
	  margin: 10px 4px 2px 0;
}
		.fancybox-custom .fancybox-skin {

			box-shadow: 0 0 50px #222;

		}


      .error{



      	color: red;



      	font-size:13px;



      }
      .ptext
      {
  display: block;
  float: right;
  width: 31.5%;
  margin-top: -5px;
  padding: 10px;
      }
.redactor_box {
  min-height: 500px;
}
	</style>



<!--/lightbox scripts and style-->



 <script type="text/javascript">



 $(function(){



   $("#forward").click(function() {



   window.parent.location.href = "<?php echo base_url(); ?>admin/days/<?php echo $pid?>";



    });



    	});











</script>



<?php



	$attributes = array('class' => 'tform', 'id' => '');




echo ($updType == 'create') ? form_open(base_url().'admin/tasks/create', $attributes) : form_open(base_url().'admin/tasks/edit/'.$task->tid.'/'.$did.'/'.$pid, $attributes);



?>



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
margin-bottom: 0px;
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

.lee_cont
{
	padding: 20px;
	background-color: rgba(0, 0, 0, 0.08);
}
</style>



<div id="toolbar-box">



	<div class="m">



		<div id="toolbar" class="toolbar-list">



			<ul style="list-style: none; float: right;">

			 <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



    			<a>

			<?php 
				if($updType == 'edit')
				{
			?>
				<a  class='btn btn-primary' id="inform_btn" title="Inform about this change made in lecture to all the enrolled students of this course." ><span class="icon-32-cancel"> </span>Save and Inform</a>

			<?php
					
				} 
				?>	

				</a>
				</li>



                <li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



    			<a>



    			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-success'" : "id='submit' class='btn btn-success'  ") ); ?>



    			</a>



    			</li>



    			<li id="toolbar-new" class="listbutton" style="float: left; margin-right: 10px;">



    			<a href='<?php echo base_url(); ?>admin/days/<?php echo $pid?>' class='btn btn-danger' id="forward"><span class="icon-32-cancel"> </span>Cancel</a>



    			</li>



			</ul>



			<div class="clr"></div>



		</div>



<div class="pagetitle"><h2><?php echo ($updType == 'create') ? "Create Lecture" : "Edit Lecture";//echo lang(($updType == 'create') ? "web_add_category" : "web_edit_category")?></h2></div>



	</div>


	<div id="inform_txt">
		<textarea style="width: 29%; height: 81px; margin-left: 731px;" name="inform_msg" id="inform_msg"  class="form-control"></textarea>
	</div>



</div>



<div>
<br />







<script type="text/javascript">



			$(function(){



				$('dl.tabs dt').click(function(){



					$(this)



						.siblings().removeClass('selected').end()



						.next('dd').andSelf().addClass('selected');



				});



			});



			function ChangeLayout(number){



			for(i=1; i<=12; i++)



			if(i==number){



			document.getElementById('layout_img_'+i).style.border = '3px solid #0000FF';



			document.getElementById('layout'+i).style.display = '';



			}



			else{



			document.getElementById('layout_img_'+i).style.border = '';



			document.getElementById('layout'+i).style.display = 'none';



			}



			document.getElementById('layout_db').value = number;



			}



			



		function deleteJumpButton(id,sno,lid)



		{

			var  jump_button_id = id;

			var jmp = 'jmp'+sno+'L'+lid;
			var jumpbutton = 'jumpbutton'+sno;
			var jumptitle = 'jumptitle'+sno+'L'+lid;
			var deljmp = 'deljmp'+sno+'L'+lid;
			var jumpanch = 'jump'+sno+'L'+lid;
			var changejumptext = "Add a Jump Button";

        	
			
	        $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin/tasks/delete_jumpbutton",
	            data    : {'jump_button_id':jump_button_id},
	 			success: function(data){
	 				
                      
					document.getElementById(jumptitle).innerHTML = changejumptext;
					document.getElementById(jumpbutton).value = 0;
					document.getElementById(jmp).style.backgroundColor = "#FF99FF";
					document.getElementById(deljmp).style.display = 'none';
					document.getElementById(jumpanch).href = "<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/"+sno+"/"+"0";
				}
	 			});		

		}




     $(document).ready(function() {



         $("span.error").each(function() {



         var get_error = $(this).text();



         if (get_error.length > 1) {



                $(this).closest('dd').prev('dt').css('background-color', 'red');







           }



        });







     });



</script>



</div>










<div class="row">
<div class="col-md-6" style="width: 100%;">
  <ul class="nav nav-tabs bordered">
    <!-- available classes "bordered", "right-aligned" -->
    <li class="active"> 
    <a href="#Lecture" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-home"></i></span> 
    <span class="hidden-xs">Lecture Detail</span> 
    </a> 
    </li>
    <li> 
    <a href="#Publishing" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-user"></i></span> 
    <span class="hidden-xs">Publishing</span> 
    </a> 
    </li>
    <li> 
    <a href="#Meta" data-toggle="tab"> 
    <span class="visible-xs"><i class="entypo-user"></i></span> 
    <span class="hidden-xs">Meta Tags</span> 
    </a> 
    </li>
  </ul>
  <div class="tab-content">
   
   
    <div class="tab-pane active" id="Lecture">
      <dd class="" sno="1">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
                        <legend></legend>
            
			
            <div class="form-group">
              <label class='col-sm-3 control-label' for="Lesson"><?php echo 'Lecture Name:'//echo lang('web_name')?> <span class="required">*</span></label>
              <div class="col-sm-5">

				<input id="name" class="form-control" type="text" name="name" maxlength="256" value="<?php echo set_value('name', (isset($task->name)) ? $task->name : ''); ?>"  />

<!-- tooltip area -->
						<span class="tooltipcontainer">

						<span type="text" id="name-target" class="tooltipicon"></span>

						<span class="name-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_name');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

				<span class="error"><?php echo form_error('name'); ?> </span>
                                
              </div>
            </div>
            
            <div class="form-group">
              <label class='col-sm-3 control-label' for="Alias"><?php echo 'Alias:'//echo lang('web_name')?></label>
              <div class="col-sm-5">
                            
                 <input id="alias" type="text" class="form-control" name="alias" maxlength="256" value="<?php echo set_value('alias', (isset($task->alias)) ? $task->alias : ''); ?>"/>

<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="alias-target" class="tooltipicon"></span>

						<span class="alias-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_alias');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
               
              </div>
			  
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label">Level:<span class="required">*</span></label>
              <div class="col-sm-5">
               <select id="difficultylevel" name="difficultylevel" class="form-control"  size="1" >



                                    <option value="">Select Level</option>



                                    <option value="easy" <?php echo preset_select('difficultylevel', 'easy', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Easy</option>



                                    <option value="medium" <?php echo preset_select('difficultylevel', 'medium', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Medium</option>



                                    <option value="hard" <?php echo preset_select('difficultylevel', 'hard', (isset($task->difficultylevel)) ? $task->difficultylevel : ''); ?>>Hard</option>



									</select>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="difficultylevel-target" class="tooltipicon"></span>

						<span class="difficultylevel-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_difficultylevel');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                                    <span class="error"><?php echo form_error('difficultylevel'); ?> </span>
              </div>
			  
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label">Who can access this lecture:</label>
              <div class="col-sm-5">
                   <select class="form-control" name="step_access">



                                        <!-- <option value="">Select Group</option> -->



										<option value="0" <?php echo preset_select('step_access', '0', (isset($task->step_access) && $task->step_access == '0') ? '0' : ''); ?>>Students</option>



										<option value="1" <?php echo preset_select('step_access', '1', (isset($task->step_access) && $task->step_access == '1') ? '1' : ''); ?>>Members</option>



										<option value="2" <?php echo preset_select('step_access', '2', (isset($task->step_access) && $task->step_access == '2') ? '2' : ''); ?>>Guests</option>



									</select>





						<span class="tooltipcontainer">

						<span type="text" id="access-target" class="tooltipicon"></span>

						<span class="access-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('lecture_fld_access');?>

                      

						</span>

						</span>


                                    <span class="error"><?php echo form_error('step_access'); ?> </span>
               
              </div>
			  
            </div>


          </fieldset>
          
        </div>
        
        <hr />
        
        <fieldset class="adminform" style="padding: 5px;">



		<h2>Select Lecture Layout</h2>

	<table class="table table-bordered responsive" style="width:100%;">



		<tbody><tr>



			<td>



				Select Layout&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/images/admin/layouts/media_back.gif" alt="media">



				media storage&nbsp;&nbsp;<img src="<?php echo base_url(); ?>public/images/admin/layouts/text_back.gif" alt="text">



				text only



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="layout-target" class="tooltipicon"></span>

						<span class="layout-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_layout');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish --></td>



		</tr>



		<tr>



			<td>



				<table style="width:550px;">



					<tbody><tr>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(6);" id="layout_img_6" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='6') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?><?php echo set_value('layout_db', (isset($task->layoutid)) ? '' : 'border:3px; border-style:solid; border-color:#0000FF;'); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-6.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(5);" id="layout_img_5" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='5') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-5.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(12);" id="layout_img_12" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='12') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-12.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(1);" id="layout_img_1" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='1') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-1.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(7);" id="layout_img_7" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='7') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-7.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(2);" id="layout_img_2" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='2') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-2.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(8);" id="layout_img_8" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='8') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-8.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(3);" id="layout_img_3" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='3') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-3.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(9);" id="layout_img_9" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='9') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-9.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(4);" id="layout_img_4" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='4') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-4.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(10);" id="layout_img_10" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='10') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-10.gif" alt="">



						</td>



						<td style="width:50px;">



							<img onclick="javascript:ChangeLayout(11);" id="layout_img_11" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='11') ? 'border:3px; border-style:solid; border-color:#0000FF;' : ''); ?>" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-11.gif" alt="">



						</td>														



					</tr>	



				</tbody></table>



			</td>



		</tr>

		</tbody></table>



<div class="lee_cont">

<h3 style="font-size: 20px; margin-top: 0;">Lecture Content</h3>

<hr>

<table class="table table-bordered responsive" style="width:100%;">

<tbody>

		<input name="text_is_quiz" type="hidden" value="0">
      
      <tr>
									<td>
									<label style="font-size: 14px; margin-top: -10px;">Enter Lecture Content :</label>
										<textarea name="lec_content" id="lec_content">
										<?php  echo @$task->content; ?>
										</textarea>
									</td>
								</tr>	


	<tr id="layout1" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='1') ? '' : 'display:none'); ?>">



			<?php 



			$layout_text1_flag = (isset($db_mediatext[0]->media_id)) ? true : false;



			$layout_media1_flag = (isset($db_media[0]->media_id)) ? true : false;



			?>



			<td>



				<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



					<tbody><tr>



						<td>



							<table align="center">



								<tbody>

								<tr>



									<td style="text-align:center" id="menu_med_1">



                                    <?php
                                    //echo $updType;
                                    // echo $db_mediatext[0]->media_id;
                                    if($updType == 'edit' && $db_media[0]->media_id != '0')
                                    {
                                    ?>
										<div id="before_menu_med_1" style="display:none" class='btnFloat'>
											<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe btn btn-info">Select media</a>
										</div>
                                        <?php 
                                    }
                                    else
                                   	{
                                   		?>
                                        <div id="before_menu_med_1" class='btnFloat'>
											<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe btn btn-info">Select media</a>
										</div>
                                        <?php
                                    }
                                    ?>
                                        <div id="before_menu_med_1" class='btnFloat'>
											<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/1' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>
										</div>
                                      
                                        <?php if($updType == 'edit' && $db_media[0]->media_id != '0'){ ?>
										<div id="after_menu_med_1" class='btnFloat'>
 										<table>
												<tbody><tr>
													<td width="33%" style="text-align:center">
														<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe btn btn-info">Replace media</a>
													</td>
 													</tr>
										</tbody></table>
									  </div>



                                      <?php }else{ ?>



                                     <div id="after_menu_med_1" style="display:none" class='btnFloat'>



											<table>



												<tbody><tr>



													<td width="33%" style="text-align:center">



														<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/1' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



													</td>







											</tr>



										</tbody></table>



									</div>







                                    <?php }?>



								</td>



							</tr>



						</tbody>

						</table>



					</td>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                   <?php if($updType == 'edit' && $db_mediatext[0]->media_id != '0'){ ?>



									<div id="before_menu_txt_1" style="display:none" class='btnFloat'>



										<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe btn btn-info">Select text</a>







									</div>



                                    <?php }else{?>



                                    <div id="before_menu_txt_1" class='btnFloat'>



										<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe btn btn-info">Select text</a>







									</div>







                                    <?php } ?>

                                     <div id="before_menu_txt_1" class='btnFloat'>



										<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/1' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>







									</div>

                                    <?php if($updType == 'edit' && $db_mediatext[0]->media_id != '0'){ ?>



									<div id="after_menu_txt_1">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_1" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/1' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>







                                    <?php }?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



									<div id="media_1">



									<?php if($layout_media1_flag && $db_media[0]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[0]->media_id;?>/1");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
										<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



									<div id="text_1">



									<?php 



										if($layout_text1_flag && $db_mediatext[0]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_1').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[0]->media_id;?>/1");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
										<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



										<?php }?>



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>					



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							  <tr>

 

								<td>



                                    <div id="jmp1L1" >



                                  <a id="jump1L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L1"> <?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button" ;?> </span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L1" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L1" >



                                  <a id="jump2L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L1"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L1" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L1" >



                                  <a id="jump3L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L1"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L1" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L1" >



                                  <a id="jump4L1" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L1"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L1" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,1); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	<tr id="layout2" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='2') ? '' : 'display:none'); ?>">



	<?php



	$layout_media2_flag = (isset($db_media[1]->media_id)) ? true : false;



	$layout_media3_flag = (isset($db_media[2]->media_id)) ? true : false;



	$layout_text2_flag = (isset($db_mediatext[1]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_2">



                                    <?php if($updType == 'edit' && $db_media[1]->media_id != '0'){ ?>



									<div id="before_menu_med_2" style="display:none" class='btnFloat'>



                                     <a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									</div>



                                    <?php }else{ ?>



                                     <div id="before_menu_med_2" class='btnFloat'>



                                     <a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									</div>







                                    <?php } ?>

                                    <div id="before_menu_med_2" class='btnFloat'>



                                     <a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/2' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									</div>



                                    <?php if($updType == 'edit' && $db_media[1]->media_id != '0'){ ?>



									<div id="after_menu_med_2" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_2" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/2' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                <?php if($updType == 'edit' && $db_mediatext[1]->media_id != '0'){ ?>



									<div id="before_menu_txt_2" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_2"  class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									</div>







                                    <?php } ?>


                                    <div id="before_menu_txt_2" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/3' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									</div>


                                    <?php if($updType == 'edit' && $db_mediatext[1]->media_id != '0'){ ?>




									<div id="after_menu_txt_2">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/2' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_2" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/2' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>











                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_2">



										<?php if($layout_media2_flag && $db_media[1]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_2').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[1]->media_id;?>/2");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



					</td>



					<td valign="top" rowspan="3">



						<table>



							<tbody><tr>



								<td>



								<div id="text_2">



								<?php 	if($layout_text2_flag && $db_mediatext[1]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_2').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[1]->media_id;?>/2");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
								 <img height="530px" width="440px" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



											<?php }?>



								</div>	 						



								</td>



							</tr>



						</tbody></table>



					</td>					



				</tr>







				<tr>



					<td valign="top">



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_3">



                                 <?php if($updType == 'edit' && $db_media[2]->media_id != '0'){ ?>



									<div id="before_menu_med_3" style="display:none;" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_3" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>







                                    <?php }?>

                                      <div id="before_menu_med_3" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/secondmedia/3' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php if($updType == 'edit' && $db_media[2]->media_id != '0'){ ?>



									<div id="after_menu_med_3" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_3" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/3' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>











                                    <?php }?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>					



				



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_3">



								<?php 	if($layout_media3_flag && $db_media[2]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_3').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[2]->media_id;?>/3");



										</script>



										<?php }else{?>


									<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>							



								</div>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L2" >



                                  <a id="jump1L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L2"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L2" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L2" >



                                  <a id="jump2L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L2"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L2" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L2" >



                                  <a id="jump3L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L2"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L2" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L2" >



                                  <a id="jump4L2" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L2"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L2" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,2); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>







		</td>



	</tr>



	<tr id="layout3" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='3') ? '' : 'display:none'); ?>">



	<?php



   // print_r($db_media[3]->media_id);



   // print_r($db_mediatext[2]->media_id);  exit;



	$layout_media4_flag = (isset($db_media[3]->media_id)) ? true : false;



	$layout_text3_flag = (isset($db_mediatext[2]->media_id)) ? true : false;



	?>	<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_4">



                                <?php if($updType == 'edit' && $db_media[3]->media_id != '0'){ ?>



									<div id="before_menu_med_4" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{  ?>



                                    <div id="before_menu_med_4" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>







                                    <?php } ?>

                                  <div id="before_menu_med_4" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/4' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php if($updType == 'edit' && $db_media[3]->media_id != '0'){ ?>



									<div id="after_menu_med_4" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_4" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/4' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>











                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_4">



									<?php if($layout_media4_flag && $db_media[3]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_4').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[3]->media_id;?>/4");



										</script>



										<?php }else{?>


									<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



									<?php }?>



								</div>								



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                    <?php if($updType == 'edit' && $db_mediatext[2]->media_id != '0'){ ?>



									<div id="before_menu_txt_3" style="display:none" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;  </div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_3" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;  </div>



                                    <?php }?>


                                     <div id="before_menu_txt_3"  class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/3' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;  </div>



                                    <?php if($updType == 'edit' && $db_mediatext[2]->media_id != '0'){ ?>



									<div id="after_menu_txt_3">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_3" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/3' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="text_3">



								<?php if($layout_text3_flag && $db_mediatext[2]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_3').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[2]->media_id;?>/3");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



											<?php }?>



								</div>	



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L3" >



                                  <a id="jump1L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L3"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L3" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L3" >



                                  <a id="jump2L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L3"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L3" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L3" >



                                  <a id="jump3L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L3"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L3" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L3" >



                                  <a id="jump4L3" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L3"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L3" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,3); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	<tr id="layout4" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='4') ? '' : 'display:none'); ?>">



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_5">



                                  <?php if($updType == 'edit' && $db_media[4]->media_id  != '0'){ ?>



									<div id="before_menu_med_5" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_5" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php } ?>

                                    <div id="before_menu_med_5" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/5' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php if($updType == 'edit' && $db_media[4]->media_id  != '0'){ ?>



									<div id="after_menu_med_5" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    	<div id="after_menu_med_5" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/5' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>



					</td>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_6" class='btnFloat'>



                                   <?php if($updType == 'edit' && $db_media[5]->media_id  != '0'){ ?>



                                   	<div id="before_menu_med_6" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



                                    </div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_6" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



                                    </div>



                                    <?php } ?>

                                     <div id="before_menu_med_6" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/secondmedia/6' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



                                    </div>



                                    <?php if($updType == 'edit' && $db_media[5]->media_id  != '0'){ ?>



									<div id="after_menu_med_6" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_6" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/6' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>











                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



									<div id="media_5">



										<?php 



										$layout_media5_flag = (isset($db_media[4]->media_id)) ? true : false;



										if($layout_media5_flag && $db_media[4]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_5').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[4]->media_id;?>/5");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



											<?php }?>							



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



									<div id="media_6">



									<?php



										$layout_media6_flag = (isset($db_media[5]->media_id)) ? true : false;



										if($layout_media6_flag && $db_media[5]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_6').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[5]->media_id;?>/6");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>								



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>					



				</tr>



				<tr>



					<td valign="top" colspan="2">



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                  <?php if($updType == 'edit' && $db_mediatext[3]->media_id  != '0'){ ?>



									<div id="before_menu_txt_4" style="display:none" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_4" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>







                                    <?php } ?>


                                    <div id="before_menu_txt_4" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/4' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php if($updType == 'edit' && $db_mediatext[3]->media_id  != '0'){ ?>



									<div id="after_menu_txt_4">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{   ?>



                                    <div id="after_menu_txt_4" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/4' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>







                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>				



				<tr>



					<td valign="top" colspan="2">



						<table>



							<tbody><tr>



								<td>



								<div id="text_4">



								<?php 



										$layout_text4_flag = (isset($db_mediatext[3]->media_id)) ? true : false;



										if($layout_text4_flag && $db_mediatext[3]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_4').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[3]->media_id;?>/4");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
									<img height="240" width="775" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



											<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                     <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>

								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L4" >



                                  <a id="jump1L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-default">



                                      <span id="jumptitle1L4"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L4" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L4" >



                                  <a id="jump2L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L4"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L4" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L4" >



                                  <a id="jump3L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L4"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L4" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L4" >



                                  <a id="jump4L4" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L4"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L4" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,4); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	<tr id="layout5" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='5') ? '' : 'display:none'); ?>">



	<?php



	$layout_text5_flag = (isset($db_mediatext[4]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                <?php if($updType == 'edit' && $db_mediatext[4]->media_id != '0'){ ?>



									<div id="before_menu_txt_5" style="display:none" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                   <?php }else{ ?>



                                     <div id="before_menu_txt_5"  class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>







                                   <?php } ?>

                                   <div id="before_menu_txt_5" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/5' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php if($updType == 'edit' && $db_mediatext[4]->media_id != '0'){ ?>



									<div id="after_menu_txt_5">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_5" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/5' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>







                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="text_5">



										<?php if($layout_text5_flag && $db_mediatext[4]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_5').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[4]->media_id;?>/5");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
									<img height="359" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



										<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L5" >



                                  <a id="jump1L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L5"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L5" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L5" >



                                  <a id="jump2L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L5"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L5" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L5" >



                                  <a id="jump3L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L5"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>                                 </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L5" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L5" >



                                  <a id="jump4L5" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L5"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L5" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,5); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	<tr id="layout6" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='6') ? '' : 'display:none'); ?><?php echo set_value('layout_db', (isset($task->layoutid)) ? '' : 'display:block'); ?>">



	<?php



   $layout_media7_flag = (isset($db_media[6]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody>

								

							<tr>



								<td style="text-align:center" id="menu_med_7" colspan="10">



                                <?php if($updType == 'edit' && $db_media[6]->media_id != '0'){ ?>



									<div id="before_menu_med_7" style="display:none; margin:10px;"  class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe btn btn-default btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_7" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe btn btn-default btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php } ?>



                                     <div id="before_menu_med_7" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/7' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php if($updType == 'edit' && $db_media[6]->media_id != '0'){ ?>



									<div id="after_menu_med_7" class='btnFloat'>



										<table>



							   	<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_7" style="display:none" class='btnFloat'>



										<table>



							   	<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/7' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



									<div id="media_7">



										<?php



                                       // echo $layout_media7_flag;



                                         if($layout_media7_flag && $db_media[6]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_7').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[6]->media_id;?>/7");



										</script>



										<?php }else{?>

                                           
                                         <div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>  
										<img height="359" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



						<table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>

								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>

								<td style="padding:10px;">



                                    <div id="jmp1L6">



                                  <a id="jump1L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L6"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php 
									
								if(isset($jump_but1)){

									?>



									<div id="deljmp1L6" style="float:right; margin-top:0px;">



									<a style="color:#fff;" class="btn btn-default" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td style="padding:10px;"><div id="jmp2L6">



                                  <a id="jump2L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L6"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L6" style="float:right; margin-top:0px;">



									<a style="color:#fff;" class="btn btn-default" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td style="padding:10px;">



                                <div id="jmp3L6">



                                  <a id="jump3L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L6"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L6" style="float:right; margin-top:0px;">



									<a style="color:#fff;" class="btn btn-default" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td style="padding:10px;">



                                <div id="jmp4L6">



                                  <a id="jump4L6" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L6"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>

						

                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L6" style="float:right; margin-top:0px;">



									<a style="color:#fff;" class="btn btn-default" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,6); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	<tr id="layout7" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='7') ? '' : 'display:none'); ?>">



	<?php



	$layout_text6_flag = (isset($db_mediatext[5]->media_id)) ? true : false;



	$layout_media8_flag = (isset($db_media[7]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                    <?php if($updType == 'edit' && $db_mediatext[5]->media_id != '0'){ ?>



									<div id="before_menu_txt_6" style="display:none" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_6" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php } ?>

                                      <div id="before_menu_txt_6" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/6' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php if($updType == 'edit' && $db_mediatext[5]->media_id != '0'){ ?>



									<div id="after_menu_txt_6">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_6" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/6' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>







                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_8">



                                    <?php if($updType == 'edit' && $db_media[7]->media_id != '0'){ ?>



									<div id="before_menu_med_8" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe btn btn-default btn btn-info">Select media</a>







									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_8" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe btn btn-default btn btn-info ">Select media</a>







									</div>



                                    <?php } ?>


                                    <div id="before_menu_med_8" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/8' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>







									</div>



                                    <?php if($updType == 'edit' && $db_media[7]->media_id != '0'){ ?>



									<div id="after_menu_med_8" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_8" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/8' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>











                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="text_6">



								<?php if($layout_text6_flag && $db_mediatext[5]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_6').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[5]->media_id;?>/6");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



									<?php }?>



								</div>										



								</td>



							</tr>



						</tbody></table>



					</td>					



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_8">



										<?php if($layout_media8_flag && $db_media[7]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_8').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[7]->media_id;?>/8");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



									<?php }?>



								</div>	



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L7" >



                                  <a id="jump1L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L7"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L7" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L7" >



                                  <a id="jump2L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L7"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L7" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L7" >



                                  <a id="jump3L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L7"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L7" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L7" >



                                  <a id="jump4L7" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L7"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L7" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,7); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	<tr id="layout8" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='8') ? '' : 'display:none'); ?>">



	<?php



	$layout_text7_flag = (isset($db_mediatext[7]->media_id)) ? true : false;



	$layout_media9_flag = (isset($db_media[8]->media_id)) ? true : false;



	$layout_media10_flag = (isset($db_media[9]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>



									<div id="before_menu_txt_7" style="display:none" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{?>



                                     <div id="before_menu_txt_7" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>







                                    <?php } ?>


                                    <div id="before_menu_txt_7" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/7' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                     <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>



									<div id="after_menu_txt_7" style="margin:10px;">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{    ?>



                                     <div id="after_menu_txt_7" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/7' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                     <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



					<td>



						<table align="center">



							<tbody><tr>

   

								<td style="text-align:center" id="menu_med_9">



                                <?php if($updType == 'edit' && $db_media[8]->media_id != '0'){ ?>



									<div id="before_menu_med_9" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe btn btn-default btn btn-info ">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_9" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe btn btn-default btn btn-info ">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php } ?>

                                    <div id="before_menu_med_9" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/9' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php if($updType == 'edit' && $db_media[8]->media_id != '0'){ ?>



									<div id="after_menu_med_9" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                     <div id="after_menu_med_9" style="display:none" class='btnFloat'>
 


										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/9' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>







                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top" rowspan="3">



						<table>



							<tbody><tr>



								<td>



								<div id="text_7">



								<?php if($layout_text7_flag && $db_mediatext[7]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_7').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[7]->media_id;?>/7");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
									<img height="530px" width="440px" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



										<?php }?>	



								</div>	 						



								</td>



							</tr>



						</tbody></table>



					</td>







					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_9">



								<?php if($layout_media9_flag && $db_media[8]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_9').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[8]->media_id;?>/9");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



					</td>



					



				</tr>







				<tr>



					<td valign="top">



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_10">



                                 <?php if($updType == 'edit' && $db_media[9]->media_id != '0'){ ?>



									<div id="before_menu_med_10" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe btn btn-default btn btn-info ">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php }else{  ?>



                                     <div id="before_menu_med_10" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe btn btn-default btn btn-info ">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>







                                    <?php } ?>


                                    <div id="before_menu_med_10" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/secondmedia/10' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;







									</div>



                                    <?php if($updType == 'edit' && $db_media[9]->media_id != '0'){ ?>



									<div id="after_menu_med_10" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_10" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/10' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>











                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>					



				



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_10">



										<?php if($layout_media10_flag && $db_media[9]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_10').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[9]->media_id;?>/10");



										</script>



										<?php }else{?>


                                     <div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>							



								</div>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L8" >



                                  <a id="jump1L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L8"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L8" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L8" >



                                  <a id="jump2L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L8"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L8" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>




							<tr>



								<td>



                                <div id="jmp3L8" >



                                  <a id="jump3L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L8"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L8" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L8" >



                                  <a id="jump4L8" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L8"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L8" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,8); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>			



			</tbody></table>







		</td>



	</tr>



	<tr id="layout9" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='9') ? '' : 'display:none'); ?>">



	<?php



	$layout_text8_flag = (isset($db_mediatext[7]->media_id)) ? true : false;



	$layout_media11_flag = (isset($db_media[10]->media_id)) ? true : false;



	?>	



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>



									<div id="before_menu_txt_8" style="display:none" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_8" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php } ?>

                                     <div id="before_menu_txt_8" class="btnFloat">



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/8' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php if($updType == 'edit' && $db_mediatext[7]->media_id != '0'){ ?>



									<div id="after_menu_txt_8">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_8" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/8' class="fancybox fancybox.iframe btn btn-default btn btn-default">Replace text</a>



												</td>







											</tr>



										</tbody></table>



									</div>







                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>						



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="text_8">



								<?php if($layout_text8_flag && $db_mediatext[7]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_8').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[7]->media_id;?>/8");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
								<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



										<?php }?>



								</div>	



								</td>



							</tr>



						</tbody></table>



					</td>					



				</tr>



				<tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_11">



                                <?php if($updType == 'edit' && $db_media[10]->media_id != '0'){ ?>



									<div id="before_menu_med_11" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe btn btn-default btn btn-info ">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_11" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe btn btn-default btn btn-info ">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>







                                    <?php } ?>

                                     <div id="before_menu_med_11" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/11' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>

                                    <?php if($updType == 'edit' && $db_media[10]->media_id != '0'){ ?>



									<div id="after_menu_med_11" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    	<div id="after_menu_med_11" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/11' class="fancybox fancybox.iframe btn btn-info">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_11">



								<?php if($layout_media11_flag && $db_media[10]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_11').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[10]->media_id;?>/11");



										</script>



										<?php }else{?>


                                     <div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>



								</div>								



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                       <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L9" >



                                  <a id="jump1L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L9"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L9" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L9" >



                                  <a id="jump2L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L9"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L9" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L9" >



                                  <a id="jump3L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L9"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L69" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L9" >



                                  <a id="jump4L9" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L9"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L9" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,9); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	<tr id="layout10" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='10') ? '' : 'display:none'); ?>">



	<?php 



	$layout_text9_flag = (isset($db_mediatext[8]->media_id)) ? true : false;



	$layout_media12_flag = (isset($db_media[11]->media_id)) ? true : false;



	$layout_media13_flag = (isset($db_media[12]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td valign="top" colspan="2">



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                 <?php if($updType == 'edit' && $db_mediatext[8]->media_id != '0'){ ?>



									<div id="before_menu_txt_9" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/9' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_9" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/9' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php } ?>

                                      <div id="before_menu_txt_9" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/9' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php if($updType == 'edit' && $db_mediatext[8]->media_id != '0'){ ?>



									<div id="after_menu_txt_9">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a  href="index.php?option=com_guru&amp;controller=guruTasks&amp;task=addtext&amp;tmpl=component&amp;cid[]=&amp;txt=9" class="modal2">Replace text</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_9" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a  href="index.php?option=com_guru&amp;controller=guruTasks&amp;task=addtext&amp;tmpl=component&amp;cid[]=&amp;txt=9" class="modal2">Replace text</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>				



				<tr>



					<td valign="top" colspan="2">



						<table>



							<tbody><tr>



								<td>



								<div id="text_9">



									<?php if($layout_text9_flag && $db_mediatext[8]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_9').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[8]->media_id;?>/9");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
									<img height="240" width="775" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



										<?php }?>



								</div>	



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>				



				<tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_12">



                                <?php if($updType == 'edit' && $db_media[11]->media_id != '0'){ ?>



									<div id="before_menu_med_12" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									</div>



                                    <?php }else{  ?>



                                    <div id="before_menu_med_12" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									</div>



                                    <?php }?>

                                     <div id="before_menu_med_12" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/12' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									</div>







                                    <?php if($updType == 'edit' && $db_media[11]->media_id != '0'){ ?>



									<div id="after_menu_med_12" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{  ?>



                                    <div id="after_menu_med_12" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/12' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }?>



								</td>



							</tr>



						</tbody></table>



					</td>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_13">



                                    <?php if($updType == 'edit' && $db_media[12]->media_id != '0'){ ?>



									<div id="before_menu_med_13" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_13" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe btn btn-info">Select media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>







                                    <?php } ?>

                                    <div id="before_menu_med_13" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/secondmedia/13' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



									&nbsp;&nbsp;&nbsp;&nbsp;



									</div>



                                     <?php if($updType == 'edit' && $db_media[12]->media_id != '0'){ ?>



									<div id="after_menu_med_13" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_13" style="display:none" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/secondmedia/13' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>







											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



									<div id="media_12">



									<?php if($layout_media12_flag && $db_media[11]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_12').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[11]->media_id;?>/12");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>				



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



									<div id="media_13">



										<?php if($layout_media13_flag && $db_media[12]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_13').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[12]->media_id;?>/13");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
										<img height="240" width="380" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>				



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>					



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L10" >



                                  <a id="jump1L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L10"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L10" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L10" >



                                  <a id="jump2L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L10"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L10" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L10" >



                                  <a id="jump3L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L10"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L10" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L10" >



                                  <a id="jump4L10" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L10"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L10" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,10); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



				



			</tbody></table>



		</td>



	</tr>



	<tr id="layout11" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='11') ? '' : 'display:none'); ?>">



	<?php 



	$layout_text10_flag = (isset($db_mediatext[9]->media_id)) ? true : false;



	$layout_media14_flag = (isset($db_media[13]->media_id)) ? true : false;



	$layout_text11_flag = (isset($db_mediatext[10]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                    <?php if($updType == 'edit' && $db_mediatext[9]->media_id != '0'){ ?>



									<div id="before_menu_txt_10" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe btn btn-info">Select text</a>







									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_10" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe btn btn-info">Select text</a>







									</div>



                                    <?php } ?>


                                    <div id="before_menu_txt_10" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/firsttext/10' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>







									</div>



                                    <?php if($updType == 'edit' && $db_mediatext[9]->media_id != '0'){ ?>



									<div id="after_menu_txt_10">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_10" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/firsttext/10' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>						



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="text_10">



										<?php if($layout_text10_flag && $db_mediatext[9]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_10').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[9]->media_id;?>/10");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



										<?php }?>



								</div>	



								</td>



							</tr>



						</tbody></table>



					</td>					



				</tr>



				<tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center" id="menu_med_14">



                                    <?php if($updType == 'edit' && $db_media[13]->media_id != '0'){ ?>



									<div id="before_menu_med_14" style="display:none;" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe btn btn-info">Select media</a>







									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_med_14" class='btnFloat'>



                                    <a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe btn btn-info">Select media</a>



                                     </div>



                                    <?php } ?>

                                     <div id="before_menu_med_14" class='btnFloat'>



                                    <a href='<?php echo base_url(); ?>/admin/medias/createlecturemedia/firstmedia/14' class="fancybox fancybox.iframe btn btn-primary">Add New media</a>



                                     </div>



                                    <?php if($updType == 'edit' && $db_media[13]->media_id != '0'){ ?>







                                    <div id="after_menu_med_14" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_med_14" style="display:none;" class='btnFloat'>



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmedia/firstmedia/14' class="fancybox fancybox.iframe btn btn-default">Replace media</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="media_14">



										<?php if($layout_media14_flag && $db_media[13]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#media_14').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_media[13]->media_id;?>/14");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>			



								</div>								



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				



				<tr>



					<td>



						<table align="center">



							<tbody><tr>



								<td style="text-align:center">



                                    <?php if($updType == 'edit' && $db_mediatext[10]->media_id != '0'){ ?>



									<div id="before_menu_txt_11" style="display:none" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									</div>



                                    <?php }else{ ?>



                                    <div id="before_menu_txt_11" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe btn btn-info">Select text</a>



									</div>



                                    <?php } ?>

                                    <div id="before_menu_txt_11" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/medias/createlecturetext/secondtext/11' class="fancybox fancybox.iframe btn btn-primary">Add New text</a>



									</div>



                                    <?php if($updType == 'edit' && $db_mediatext[10]->media_id != '0'){ ?>



									<div id="after_menu_txt_11">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php }else{ ?>



                                    <div id="after_menu_txt_11" style="display:none">



										<table>



											<tbody><tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/medias/ajaxaddmediatext/secondtext/11' class="fancybox fancybox.iframe btn btn-default">Replace text</a>



												</td>



											</tr>



										</tbody></table>



									</div>



                                    <?php } ?>



								</td>



							</tr>



						</tbody></table>



					</td>						



				</tr>



				<tr>



					<td valign="top">



						<table>



							<tbody><tr>



								<td>



								<div id="text_11">



								<?php if($layout_text11_flag && $db_mediatext[10]->media_id != '0'){ ?>



										<script type="text/javascript">



										jQuery('#text_11').load("<?php echo base_url();?>admin/medias/ajaxmediaview/<?php echo $db_mediatext[10]->media_id;?>/11");



										</script>



										<?php }else{?>

										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Text will come here</div>

									<img height="240" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-text.gif" alt="">



										<?php }?>



								</div>	



								</td>



							</tr>



						</tbody></table>



					</td>					



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L11" >



                                  <a id="jump1L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L11"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L11 style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L11" >



                                  <a id="jump2L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L11"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L11 style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L11" >



                                  <a id="jump3L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L11"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L11" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L11" >



                                  <a id="jump4L11" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L11"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L11" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,11); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>




						</div>



					</td>



				</tr>







			</tbody></table>



		</td>



	</tr>



	<tr id="layout12" style="<?php echo set_value('layout_db', (isset($task->layoutid) && $task->layoutid=='12') ? '' : 'display:none'); ?>">



	<?php 



	$layout_media15_flag = (isset($db_media[14]->media_id)) ? true : false;



	?>



		<td>



			<table style="border-bottom:1px solid #eeeeee; border-left:1px solid #eeeeee; border-top:1px solid #eeeeee; border-right:1px solid #eeeeee;margin: 0 auto;">



				<tbody><tr>



					<td>



						<table align="center">



							<tbody>


							<tr>



								<td style="text-align:center;" id="menu_med_15" >



									<div id="before_menu_med_15" class='btnFloat'>



									<a href='<?php echo base_url(); ?>/admin/quizzes/quizesaddtotask/15' class="fancybox fancybox.iframe btn btn-info">Select Exams</a>



                                        <!--<script type="text/javascript">



											document.write('&nbsp;&nbsp;&nbsp;&nbsp;<a class="modal2" rel="{handler: \'iframe\', size: {x: (document.adminForm.page_width.value-20), y: (document.adminForm.page_height.value-20)}}" href="index.php?option=com_guru&controller=guruQuiz&task=editsboxx&cid[]=0&tmpl=component">New Exam</a>');



										</script>



										<a href='<?php echo base_url(); ?>/admin/quizzes/quizesaddtotask/15' class="fancybox fancybox.iframe btn btn-default">New Exam</a>-->



									</div>



									<div id="after_menu_med_15" style="display:none" class='btnFloat'>



										<table>



											<tbody>
												<tr>
													<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
												</tr>
											<tr>



												<td width="33%" style="text-align:center">



													<a href='<?php echo base_url(); ?>/admin/quizzes/quizesaddtotask/15' class="fancybox fancybox.iframe btn btn-default">Replace Exam</a>



												</td>



                                               <!--	<td width="33%" style="text-align:center">



													<script type="text/javascript">



														document.write('<a id="a_edit_media_15" class="modal2" rel="{handler: \'iframe\', size: {x: (document.adminForm.page_width.value-20), y: (document.adminForm.page_height.value-20)}}" href="index.php?option=com_guru&controller=guruQuiz&tmpl=component&task=editsboxx&cid[]=0&scr=&type=quiz">Edit Exam</a>');



													</script><a id="a_edit_media_15" class="modal2"  href="index.php?option=com_guru&amp;controller=guruQuiz&amp;tmpl=component&amp;task=editsboxx&amp;cid[]=0&amp;scr=&amp;type=quiz">Edit Exam</a>



												</td>



												<td width="33%" style="text-align: center">



													<script type="text/javascript">



														document.write('<a class="modal2" rel="{handler: \'iframe\', size: {x: (document.adminForm.page_width.value-20), y: (document.adminForm.page_height.value-20)}}" href="index.php?option=com_guru&controller=guruQuiz&task=editsboxx&cid[]=0&tmpl=component">New Exam</a>');



													</script><a class="modal2"  href="index.php?option=com_guru&amp;controller=guruQuiz&amp;task=editsboxx&amp;cid[]=0&amp;tmpl=component">New Exam</a>



												</td>-->



											</tr>



										</tbody></table>



									</div>	



								</td>



							</tr>



						</tbody></table>	



					</td>



				</tr>



				<tr>



					<td valign="top">



						<table width="100%">



							<tbody>
								
							<tr>



								<td>



									<div id="media_15">



									<?php if($layout_media15_flag){ ?>



										<script type="text/javascript">



										jQuery('#media_15').load("<?php echo base_url();?>admin/quizzes/ajaxquizztotask/<?php echo $db_media[14]->media_id;?>/15");



										</script>



										<?php }else{?>


										<div style="position: absolute; padding: 17px 63px; padding: 17px 63px;font-size: 17px;color: black;">Your Media will come here</div>
										<img height="359" width="778" src="<?php echo base_url(); ?>public/images/admin/layouts/screen-media.gif" alt="">



										<?php }?>



									</div>



								</td>



							</tr>



						</tbody></table>



					</td>



				</tr>



				<tr colspan="2">



					<td colspan="2">



						<div style="margin: 0 auto;width: 280px;">



                        <table width="100%" cellpadding="20" cellspacing="20" style="width: 320px;">



							<tbody>
								<tr>
									<td colspan="2">Add Jump buttons to lessons to take students to another lesson, relevant to them</td>
								</tr>
							<tr>



								<td>



                                    <div id="jmp1L12" >



                                  <a id="jump1L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/1/<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle1L12"><?php echo (isset($jump_but1->text)) ? $jump_but1->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but1)){?>



									<div id="deljmp1L12" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but1->id; ?>,1,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td><div id="jmp2L12" >



                                  <a id="jump2L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/2/<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle2L12"><?php echo (isset($jump_but2->text)) ? $jump_but2->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but2)){?>



									<div id="deljmp2L12" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but2->id; ?>,2,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>







								</div>



								</td>



							</tr>



							<tr>



								<td>



                                <div id="jmp3L12" >



                                  <a id="jump3L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/3/<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle3L12"><?php echo (isset($jump_but3->text)) ? $jump_but3->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but3)){?>



									<div id="deljmp3L12" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but3->id; ?>,3,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



								<td>



                                <div id="jmp4L12" >



                                  <a id="jump4L12" href="<?php echo base_url(); ?>admin/days/addjumplist/<?php echo $pid;?>/4/<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>" class="fancybox fancybox.iframe btn btn-red">



                                      <span id="jumptitle4L12"><?php echo (isset($jump_but4->text)) ? $jump_but4->text : "Add a Jump Button";?></span>



                                  </a>



								<?php if(isset($jump_but4)){?>



									<div id="deljmp4L12" style="float:right; margin-top:0px;">



									<a style="color:#fff;" onclick="javascript:deleteJumpButton(<?php  echo $jump_but4->id; ?>,4,12); return false;" href="#"><img border="0" src="<?php echo base_url(); ?>public/images/admin/layouts/delete.gif"></a>



									</div>



								<?php }?>



								</div>



								</td>



							</tr>



						</tbody></table>



						</div>



					</td>



				</tr>



			</tbody></table>



		</td>



	</tr>



	</tbody></table>

	</div>



	</fieldset>
      </dd>
      <div style="clear:both;"></div>
    </div>



    <div class="tab-pane" id="Publishing">
      <dd class="" sno="2">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">

			<legend>Publishing</legend>
           
            <div class="form-group">
            
              <label class='col-sm-3 control-label'>Keywords :</label>
              
              <div class="col-sm-5">
                                <input type="text" value="" maxlength="255" size="40" name="metatitle" class="form-control">
                <span class="tooltipcontainer"> <span type="text" id="metatitle-target" class="tooltipicon" title="Click Here"></span> <span class="metatitle-target  tooltargetdiv" style="display: none;"> <span class="closetooltip"></span> 
                
                <!--tip containt--> 
                
                Seconds </span> </span> </div>
                &nbsp &nbsp&nbsp <span class="ptext">(Put relevant keyword to make your lecture searchable in your Online Academy)</span>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"> </label>
              <div class="col-sm-5">
                                
               <input id="published" type="checkbox" name="published" value='1' <?php echo ($this->input->post('published') == '1') ? 'checked="checked"' : (isset($task->published) && $task->published == '1') ? 'checked="checked"' : ''?> />
              
               <label class='col-sm-3 control-label' for='active'>Activate <?//=lang('web_is_active')?> </label>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_published');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

								<?php echo form_error('published'); ?>
               </div>
            </div>
            
           <!-- <div class="form-group">
            <label class="col-sm-3 control-label">Start publishing Date :</label>
              <div class="col-sm-5">
                                
             <div class="controls input-append date form_datetime" data-link-field="dtp_input1">



										<input  type="text" maxlength="19" size="25" id="startpublish"  class='form-control' value="<?php echo ($this->input->post('startpublish')) ? $this->input->post('startpublish') : ((isset($task->startpublish) && $task->startpublish!='') ? $task->startpublish : ''); ?>"  name="startpublish" readonly>





						<span class="tooltipcontainer">

						<span type="text" id="start_published-target" class="tooltipicon"></span>

						<span class="start_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						

						<?php echo lang('lecture_fld_start-published');?>

                      

						</span>

						</span>



							    </div>

               </div>
            </div>
            
            <div class="form-group">
            <label class="col-sm-3 control-label">End publishing Date:</label>
              <div class="col-sm-5">
              
              <div class="controls input-append date form_datetime" data-link-field="dtp_input1">



										<input  type="text" maxlength="19" size="25" id="endpublish" class='form-control' value="<?php echo ($this->input->post('endpublish')) ? $this->input->post('endpublish') : ((isset($task->endpublish) && $task->endpublish!='') ? $task->endpublish : ''); ?>"  name="endpublish" readonly>







						<span class="tooltipcontainer">

						<span type="text" id="end_published-target" class="tooltipicon"></span>

						<span class="end_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('lecture_fld_end-published');?>

                    

						</span>

						</span>





							</div>
                                
             
               </div>
            </div>-->
            
            
          </fieldset>
        </div>
      </dd>
    </div>
    
    <div class="tab-pane" id="Meta">
      <dd class="" sno="3">
        <div class="tab-content">
          <fieldset class="adminform form-horizontal form-groups-bordered">
                        <legend>Meta Tags <p style="margin-top: -19px; padding-left: 127px;margin-right: 82px;">The Information that you provide in meta tag is used by search engine to index a page so that someone search for the kind of information the page contains able to find it.</p></legend>
            <div class="form-group">

              <label class='col-sm-3 control-label' for="Title"><?php echo 'Title:'//echo lang('web_name')?></label>
              
              
              <div class="col-sm-5">
                <input id="title" type="text" name="title" class='form-control' maxlength="256" value="<?php echo ($this->input->post('title')) ? $this->input->post('title') : ((isset($task->metatitle)) ? $task->metatitle : ''); ?>"  />



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="meta_title-target" class="tooltipicon"></span>

						<span class="meta_title-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_meta-title');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

            </div>
            &nbsp &nbsp <p class="ptext"> (This Title showup in the Search Engine Result Page)</p>
            </div>
            
            <div class="form-group">

              <label class='col-sm-3 control-label' for="key_description"><?php echo 'Keywords:'//echo lang('web_name')?></label>
              
              <div class="col-sm-5">
              
                                    <?php //$this->ckeditor->editor("key_description",($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''));?>


                                  <textarea id="key_description" class="form-control"  name="key_description"  /><?php echo ($this->input->post('key_description')) ? $this->input->post('key_description') : ((isset($task->metakwd)) ? $task->metakwd : ''); ?></textarea>


<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="meta_desc-target" class="tooltipicon"></span>

						<span class="meta_desc-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_meta-desc');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                                
              </div> 
              &nbsp &nbsp <p class="ptext"> (Those are the Keywords that you expect people to search in a search engine to land in your lecture page.)</p>  
			 </div>
             
             
             <div class="form-group">

              <label class='col-sm-3 control-label' for="description"><?php echo 'Description:'//echo lang('web_name')?></label>
              
              <div class="col-sm-5">
				   <?php //$this->ckeditor->editor("description",($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''));?>



                                        <textarea id="description"  class='form-control' name="description"  /><?php echo ($this->input->post('description')) ? $this->input->post('description') : ((isset($task->metadesc)) ? $task->metadesc : ''); ?></textarea>





<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="meta_keyword-target" class="tooltipicon"></span>

						<span class="meta_keyword-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('lecture_fld_meta-keyword');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

                                
              </div> 
               &nbsp &nbsp <p class="ptext"> (The purpose of the meta description tag is to provide a brief and concise summary of your lectures content in the search engine result page.)</p>  
			 </div>
             
          </fieldset>
        </div>
      </dd>
    </div>
  </div>
</div>
<div style="clear:both;"></div>





<input id="oldTitle" type="hidden" value="bbbnnn" name="oldTitle">



<input id="layout_db" type="hidden" value="<?php echo set_value('layout_db', (isset($task->layoutid)) ? $task->layoutid : '6'); ?>" name="layout_db">



<input id="db_media_1" type="hidden" value="<?php echo set_value('db_media_1', (isset($db_media[0]->media_id)) ? $db_media[0]->media_id : '0'); ?>" name="db_media_1">



<input id="db_media_2" type="hidden" value="<?php echo set_value('db_media_2', (isset($db_media[1]->media_id)) ? $db_media[1]->media_id : '0'); ?>" name="db_media_2">



<input id="db_media_3" type="hidden" value="<?php echo set_value('db_media_3', (isset($db_media[2]->media_id)) ? $db_media[2]->media_id : '0'); ?>" name="db_media_3">



<input id="db_media_4" type="hidden" value="<?php echo set_value('db_media_4', (isset($db_media[3]->media_id)) ? $db_media[3]->media_id : '0'); ?>" name="db_media_4">



<input id="db_media_5" type="hidden" value="<?php echo set_value('db_media_5', (isset($db_media[4]->media_id)) ? $db_media[4]->media_id : '0'); ?>" name="db_media_5">



<input id="db_media_6" type="hidden" value="<?php echo set_value('db_media_6', (isset($db_media[5]->media_id)) ? $db_media[5]->media_id : '0'); ?>" name="db_media_6">



<input id="db_media_7" type="hidden" value="<?php echo set_value('db_media_7', (isset($db_media[6]->media_id)) ? $db_media[6]->media_id : '0'); ?>" name="db_media_7">



<input id="db_media_8" type="hidden" value="<?php echo set_value('db_media_8', (isset($db_media[7]->media_id)) ? $db_media[7]->media_id : '0'); ?>" name="db_media_8">



<input id="db_media_9" type="hidden" value="<?php echo set_value('db_media_9', (isset($db_media[8]->media_id)) ? $db_media[8]->media_id : '0'); ?>" name="db_media_9">



<input id="db_media_10" type="hidden" value="<?php echo set_value('db_media_10', (isset($db_media[9]->media_id)) ? $db_media[9]->media_id : '0'); ?>" name="db_media_10">



<input id="db_media_11" type="hidden" value="<?php echo set_value('db_media_11', (isset($db_media[10]->media_id)) ? $db_media[10]->media_id : '0'); ?>" name="db_media_11">



<input id="db_media_12" type="hidden" value="<?php echo set_value('db_media_12', (isset($db_media[11]->media_id)) ? $db_media[11]->media_id : '0'); ?>" name="db_media_12">



<input id="db_media_13" type="hidden" value="<?php echo set_value('db_media_13', (isset($db_media[12]->media_id)) ? $db_media[12]->media_id : '0'); ?>" name="db_media_13">



<input id="db_media_14" type="hidden" value="<?php echo set_value('db_media_14', (isset($db_media[13]->media_id)) ? $db_media[13]->media_id : '0'); ?>" name="db_media_14">



<input id="db_media_15" type="hidden" value="<?php echo set_value('db_media_15', (isset($db_media[14]->media_id)) ? $db_media[14]->media_id : '0'); ?>" name="db_media_15">



<input id="db_text_1" type="hidden" value="<?php echo set_value('db_text_1', (isset($db_mediatext[0]->media_id)) ? $db_mediatext[0]->media_id : '0'); ?>" name="db_text_1">



<input id="db_text_2" type="hidden" value="<?php echo set_value('db_text_2', (isset($db_mediatext[1]->media_id)) ? $db_mediatext[1]->media_id : '0'); ?>" name="db_text_2">



<input id="db_text_3" type="hidden" value="<?php echo set_value('db_text_3', (isset($db_mediatext[2]->media_id)) ? $db_mediatext[2]->media_id : '0'); ?>" name="db_text_3">



<input id="db_text_4" type="hidden" value="<?php echo set_value('db_text_4', (isset($db_mediatext[3]->media_id)) ? $db_mediatext[3]->media_id : '0'); ?>" name="db_text_4">



<input id="db_text_5" type="hidden" value="<?php echo set_value('db_text_5', (isset($db_mediatext[4]->media_id)) ? $db_mediatext[4]->media_id : '0'); ?>" name="db_text_5">



<input id="db_text_6" type="hidden" value="<?php echo set_value('db_text_6', (isset($db_mediatext[5]->media_id)) ? $db_mediatext[5]->media_id : '0'); ?>" name="db_text_6">



<input id="db_text_7" type="hidden" value="<?php echo set_value('db_text_7', (isset($db_mediatext[6]->media_id)) ? $db_mediatext[6]->media_id : '0'); ?>" name="db_text_7">



<input id="db_text_8" type="hidden" value="<?php echo set_value('db_text_8', (isset($db_mediatext[7]->media_id)) ? $db_mediatext[7]->media_id : '0'); ?>" name="db_text_8">



<input id="db_text_9" type="hidden" value="<?php echo set_value('db_text_9', (isset($db_mediatext[8]->media_id)) ? $db_mediatext[8]->media_id : '0'); ?>" name="db_text_9">



<input id="db_text_10" type="hidden" value="<?php echo set_value('db_text_10', (isset($db_mediatext[9]->media_id)) ? $db_mediatext[9]->media_id : '0'); ?>" name="db_text_10">



<input id="db_text_11" type="hidden" value="<?php echo set_value('db_text_11', (isset($db_mediatext[10]->media_id)) ? $db_mediatext[10]->media_id : '0'); ?>" name="db_text_11">



<input type="hidden" name="jumpbutton1" id="jumpbutton1" value="<?php echo (isset($jump_but1->id)) ? $jump_but1->id : 0;?>">



<input type="hidden" name="jumpbutton2" id="jumpbutton2" value="<?php echo (isset($jump_but2->id)) ? $jump_but2->id : 0;?>">



<input type="hidden" name="jumpbutton3" id="jumpbutton3" value="<?php echo (isset($jump_but3->id)) ? $jump_but3->id : 0;?>">



<input type="hidden" name="jumpbutton4" id="jumpbutton4" value="<?php echo (isset($jump_but4->id)) ? $jump_but4->id : 0;?>">



<input id="temp_lays" type="hidden" value="0" name="temp_lays">



<input id="day" type="hidden" value="2" name="day">



<input id="db_media_99" type="hidden" value="0" name="db_media_99">



<input type="hidden" value="" name="my_menu_id">



	<?php echo form_hidden('pid',$pid) ?>



	<?php echo form_hidden('did',$did) ?>







<?php if ($updType == 'edit'): ?>



	<?php echo form_hidden('id',$task->tid) ?>



<?php endif ?>

<?php echo form_close(); ?>



<script>
$(function() {
    $( "#startpublish" ).datepicker({

		dateFormat: "yy-mm-dd",
	
		defaultDate: "+1w",
	
		changeMonth: true,
	
		numberOfMonths: 1,
	
		showOn: "button",
	
		buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",
	
		buttonImageOnly: true,
	
		onClose: function( selectedDate ) 
		{

			$( "#todate" ).datepicker( "option", "minDate", selectedDate );

		}
		
    });

    $( "#endpublish" ).datepicker({

		dateFormat: "yy-mm-dd",
	
		defaultDate: "+1w",
	
		changeMonth: true,
	
		numberOfMonths: 1,
	
		showOn: "button",
	
		buttonImage: "<?php echo base_url()?>public/images/admin/calendar.png",
	
		buttonImageOnly: true,
	
		onClose: function( selectedDate ) 
		{
	
			$( "#fromdate" ).datepicker( "option", "maxDate", selectedDate );
	
		}

    });

	});
</script>

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



<script>
   
   jQuery(document).ready(
		function()
		{
			jQuery('#inform_txt').hide();
		});

	jQuery('#inform_btn').click(function() {

		jQuery('#inform_txt').toggle();
	});


	jQuery(document).ready(
		function()
		{
			//jQuery('#description').redactor();
			jQuery('#lec_content').redactor({
			        focus: true,
			        imageUpload: window.location.origin+'/admin/tasks/getImage',
	                
			});

		}
	);
</script>

