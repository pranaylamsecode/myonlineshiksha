<base href="<?php echo $this->config->item('base_url') ?>public/" />

	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />



	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />



	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />


	<link rel="stylesheet" href="<?php echo base_url()?>public/css/bstyles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/colour_standard.css" type="text/css" media="screen" />
    <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>
    <style>
         .ui-widget-header {
            background: #cedc98;
            border: 1px solid #DDDDDD;
            color: #333333;
            font-weight: bold;
         }
    </style>
      <script>
         /*$(function() {
            
         });*/
      </script>
    <style type="text/css">
    body{
    	background: inherit;
    	}
    </style>
	<script type="text/javascript">

$(function() {

	$('#file_i').live('change',function(e) {

	 var ftpfilearray;

	 e.preventDefault();
$('#file_i').hide();
$('#progressbar-1').show();
$( "#progressbar-1" ).progressbar({value: 20});
		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>admin/templates/layout_upload/',

		secureuri :false,

		fileElementId :'file_i',

		dataType : 'json',

		data : {

		'type' : 'aa'

		},

		success : function (data, status)

		{

			if(data.status != 'error')

			{
				$( "#progressbar-1" ).progressbar({value: 60});
				$.ajax({
				  type: "POST",
				  url: '<?php echo base_url(); ?>admin/templates/layout_install/',
				  data: { filename: data.ftpfilearray, location: "Boston" }
				})
				  .done(function( idata ) {
				    idata = JSON.parse(idata);
				   	if (idata.status == 'success') {
				   		$( "#progressbar-1" ).progressbar({value: 100});
				  	$('#msgstaus').html('<div class="msg_success"><span>'+idata.msg+'</span></div>');
				  	} else{
				  		$('#progressbar-1').hide();
				  		$('#file_i').show();
						$('#msgstaus').html('<div class="msg_error"><span>'+idata.msg+'</span></div>');
					};
				    
				  });
			}else{
				$('#progressbar-1').hide();
				  		$('#file_i').show();
				$('#msgstaus').html('<div class="msg_error"><span>'+data.msg+'</span></div>');
			}

		}

		});

	 return false;

	});

});
</script>
    <form action="" method="post" enctype="multipart/formdata">
<div id="toolbar-box">

	<div class="m">

		<div id="toolbar" class="toolbar-list">


			<div class="clr"></div>

		</div>

<div class="pagetitle"><h2>Template installation</h2></div>

	</div>

</div>
<div id="msgstaus"></div>
<fieldset class="adminform">
<legend>Template installation</legend>
<table class="adminform">
	<tbody>
		<tr>
<!-- 			<td width="15%">
				<label class="labelform" for="Lesson">Lecture Name: <span class="required">*</span></label>
			</td> -->
			<td>
			<input id="file_i" type="file" name="file_i">
			<div id="progressbar-1" style="display:none;"></div> 

			<span class="tooltipcontainer">
						<span type="text" id="upload-theme-area" class="tooltipicon"></span>
						<span class="upload-theme-area  tooltargetdiv" style="display: none;">
						<span class="closetooltip"></span>
						<!--tip containt-->
						
						<?php echo lang('upload-theme-area');  ?>
						                         <!--/tip containt-->
						</span>
						</span>
			<span class="error"> </span>
			</td>
		</tr>
		<!-- <tr>
			<td width="15%"></td>
			<td><input type="button" id="installbutton"  name="installbutton" value="INSTALL"></td>
		</tr> -->
	</tbody>
</table>
</fieldset>
</form>

<!-- tool tip script -->

<script type="text/javascript">

jQuery(document).ready(function(){

	jQuery('.tooltipicon').click(function(){

	var dispdiv = jQuery(this).attr('id');

	jQuery('.'+dispdiv).css('display','inline-block');

	});

	jQuery('.closetooltip').click(function(){

	jQuery(this).parent().css('display','none');

	});

	});

	</script>

<!-- tool tip script finish -->
