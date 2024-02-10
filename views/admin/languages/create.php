<?php
 
  //exit('red');
?>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>

<script type="text/javascript">

$(function() {

	$('#file_i').live('change',function(e) {

	 var ftpfilearray;

	 e.preventDefault();

		$.ajaxFileUpload({

		url :'<?php echo base_url(); ?>admin/users/upload_image/',

		secureuri :false,

		fileElementId :'file_i',

		dataType : 'json',

		data : {

		'type' : $('select#type').val()

		},

		success : function (data, status)

		{

		//alert(data);

			if(data.status != 'error')

			{

			$('#msgstatus_i').html('<p>Reloading files...</p>');

			$('#file_i').val('');

			$('#msgstatus_i').html('');

			ftpfileoptions = '<img src="<?php echo base_url() ?>public/uploads/users/img/thumbs/'+data.ftpfilearray+'">';

		  //	alert(ftpfileoptions);

			$('#localimage_i').html(ftpfileoptions);

			ftpfilearray = data.ftpfilearray;

           // alert(ftpfilearray);

			document.getElementById("imagename").value = ftpfilearray;

			}

		}

		});

	 return false;

	});

});



</script>

<script type="text/javascript">

window.onload = function() {

showhidefields();

}

function showhidefields(){

	var selvalue = document.getElementById("group_id").selectedIndex;

    //alert(selvalue);

    if(selvalue == '1')

	{

    $('#full_bio').redactor();

	document.getElementById("twitter_td").style.display="table-row";

	document.getElementById("facebook_td").style.display="table-row";

	document.getElementById("blogurl_td").style.display="table-row";

	document.getElementById("websiteurl_td").style.display="table-row";

	document.getElementById("bio_td").style.display="table-row";

    document.getElementById("email_td").style.display="table-row";

	document.getElementById("title_td").style.display="table-row";

	document.getElementById("stdemail_td").style.display="none";



	}else

	{

    document.getElementById("twitter_td").style.display="none";

	document.getElementById("facebook_td").style.display="none";

	document.getElementById("blogurl_td").style.display="none";

	document.getElementById("websiteurl_td").style.display="none";

	document.getElementById("bio_td").style.display="none";

    document.getElementById("email_td").style.display="none";

	document.getElementById("title_td").style.display="none";

    document.getElementById("stdemail_td").style.display="table-row";



	}

}

</script>



<script>

/*function checkvalid(){

	if (document.checkuser.email.value=='') {

			alert("You must have at least one answer for your question");

			return true;

	   }

      //return true;

}*/

</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>

 $(function() {    $( document ).tooltip();  });

</script>



<?php

$attributes = array('class' => 'tform', 'id' => '');

echo ($updType == 'create') ? form_open_multipart(base_url().'admin/languages/create', $attributes) : form_open_multipart(base_url().'admin/languages/edit/'.$id, $attributes);

?>




<h2><?php echo (($updType == 'edit')?'Edit Language':'Create Language');?></h2>

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo (($updType == 'edit')?'Edit Language':'Create Language');?>
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
				
				<fieldset role="form" class="adminform form-horizontal form-groups-bordered">

                    
					<div class="form-group">
						<label for="Language" class="col-sm-3 control-label">Language<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-5">
                            
                            <input id="language" type="text" name="language"  class="form-control" placeholder="Enter Language" maxlength="256" value="<?php echo set_value('language', (isset($language->name)) ? $language->name : ''); ?>"  />
                            
                            <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="firstname-target" class="tooltipicon"></span>

						<span class="firstname-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('user_fld_first-name');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->



      <?php echo form_error('language'); ?><b>&nbsp;</b>

						</div>
					</div>
                 
                    
                    <div class="clear"></div>            
                    

					<div class="form-group">
                    
						<div class="col-sm-offset-3 col-sm-5">
                        
							<div class="checkbox">
								<label>
									
                                    
                                     <input id="active" type="checkbox" name="active" value='1' <?php echo ($this->input->post('active') == '1') ? "checked" : (isset($language->active) && $language->active == '1') ? "checked" : ''?> />  Is It Active?



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="active-target" class="tooltipicon"></span>

						<span class="active-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('user_fld_active');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
								</label>
							</div>
							
							
						</div>
					</div>
					
					
					<div class="clear"></div>
                    
					<div class="form-group">
						
                        <div class="col-sm-offset-3 col-sm-5">
						   
			<?php echo form_submit( 'submit', ($updType == 'edit') ? "Save" : "Save", (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'")); ?>
            
            <a href='<?php echo base_url() ?>admin/languages/' class='btn btn-red'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</fieldset>
				
			</div>
		
		</div>
	
	</div>
</div>

 <link rel="stylesheet" href="<?php echo base_url() ?>js/redactor/css/redactor.css" />

<script src="<?php echo base_url() ?>js/redactor/redactor.js"></script>

<script>

 $(document).ready(

 function()

 {

   //	$('#full_bio').redactor();

 }

 );

 </script>



<?php if ($updType == 'edit'): ?>

	<?php echo form_hidden('id',$language->id); ?>

<?php endif ?>

<?php echo form_close(); ?>



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