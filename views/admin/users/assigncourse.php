<?php

  
/*$date = date('d');
$month = date('m');
$year = date('Y');
$random_no = rand(1000,5000);
echo $generate = $random_no.'_'.$year.'-'.$month.'-'.$date; */
?>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>


<!--<script type="text/javascript">

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



</script>-->

<!--<script type="text/javascript">
function showhidedetails(){

	var selvalue = document.getElementById("add_button").value;

   //alert(selvalue);

	if(selvalue == 'add')

	{

	document.getElementById("desig_field").style.display="block";
	document.getElementById("details_field").style.display="block";

	}else

	{

	document.getElementById("desig_field").style.display="none";
	document.getElementById("details_field").style.display="none";

	}

}

</script>-->




</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>

 $(function() {    $( document ).tooltip();  });

</script>





<form method="post" action = "<?php echo base_url(); ?>admin/users/assign_trainer" >


<h2>Assign Course</h2>

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					<?php echo 'Assign Course'; ?>
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
						<label for="first Name" class="col-sm-3 control-label">Courses of Trainer<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-5">
                            
                           <select name="program_id[]" multiple="multiple" readonly>
                           <?php
                           		foreach($programs as $pro)
                           		{
                           			
                           			
                           ?>

                           		<option readonly value="<?php echo $pro['id']; ?>" selected readonly><?php echo $pro['name'];  ?></option>
                           		
                           	<?php

                           		}

                           	?>

                           </select>

                              
                            
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



      <?php echo form_error('first_name'); ?><b>&nbsp;</b>

						</div>
					</div>   
                    
             

                   
					
                    <div class="clear"></div>
                    
					<div class="form-group">
						<label class="col-sm-3 control-label">Assign To<span style="color:#FF0000;" class="error">*</span></label>
						
						<div class="col-sm-5">
							
                           
                            <select onchange="javascript:showhidefields(this.selectedIndex)"  name='assign_to' id='assign_to' class="form-control">
                              <option value='<?php echo $user_id; ?>'>Admin</option>
                            <?php
                            	foreach($user_id as $id)
                            	{
                            ?>

                           <option value='<?php echo $id->id ?>'><?php echo $id->first_name;  ?></option>

                            <?php
                            	}
                            ?>

                       </select>
					   
					 
					 
					   <?php if(@$user->group_id == 2 || @$user->group_id == 4) { ?>
					   <div class="">
							<input type="button" class="btn btn-default" name="add_button" id="add_button"  value="Add" />
						</div>
					   
					   <?php }   ?>





<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="group_id-target" class="tooltipicon"></span>

						<span class="group_id-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('user_fld_group');?>

                         <!--/tip containt-->

						</span>

						</span>

                        <?php echo form_error('group_id'); ?>

<!-- tooltip area finish -->
						</div>
					</div>

					<input type="hidden" name="trainer_id" value="<?php echo $trainer_id; ?>" />
					
					<div class="clear"></div>
					
					
                 
                    
                    
 
                    
                   
                    
                   
                    <div class="clear"></div>
					
                    
					<div class="clear"></div>
                    
					<div class="form-group">
						
                        <div class="col-sm-offset-3 col-sm-5">


						   
			<?php echo form_submit( 'submit', "Save", "id='submit' class='btn btn-default'"); ?>
            
            <a href='<?php echo base_url() ?>admin/users/' class='btn btn-red'><span class="icon-32-cancel"> </span>Cancel</a>
						</div>
					</div>
				</fieldset>
				
			</div>
		
		</div>
	
	</div>
</div>
</form>


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