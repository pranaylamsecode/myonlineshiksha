<?php

if($this->input->get('msg') == 1012)
 {
  echo 'Given time slot is already scheduled. Schedule webinar at another time slot.'; 
 }
 if($this->input->get('msg') == 1022)
 {
  echo 'Given Datetime is invalid.'; 
 }
 if($this->input->get('msg') == 1004)
 {
  echo 'Start Date and Time parameter cannot precede Current Datetime.'; 
 }
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#todate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
	$( "#untilldate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  });
  </script>
<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>



<!--<script type="text/javascript">



 function validate() {



        if (document.getElementById('allday').checked) {



            document.getElementById("todatearea").style.display="none";



        } else {



            document.getElementById("todatearea").style.display="";



        }



    }

</script>-->






<?php



//print_r($category);



$attributes = array('class' => 'tform', 'id' => 'tform');



echo ($updType == 'create') ? form_open(base_url().'admin/webinars/create', $attributes) : form_open(base_url().'admin/webinars/edit/', $attributes);



?>






			






<div class="pagetitle icon-48-generic"><h2><?php echo ($updType == 'create') ? "Create Webinar" : "Edit Webinar"?></h2></div>








<div class="col-md-12"> 
	<div class="panel panel-primary" data-collapsed="0"> 
		<div class="panel-heading"> 
			<div class="panel-title"><?php echo ($updType == 'create') ? "Create webinar for ".$programs->name : "Edit webinar"?></div> 
			<div class="panel-options"> 
            	<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a> 
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> 
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> 
			</div> 
		</div> 
        <div class="panel-body"> 
        	<fieldset class="adminform form-horizontal form-groups-bordered"> 
            	
                <div class="form-group"> 
                    <label class="col-sm-3 control-label" for="title"><?php echo 'Subject'?> <span class="required">*</span></label> 
                    <div class="col-sm-5"> 
                        <input id="title" type="text" name="title" maxlength="256" class="form-control" value="<?php echo set_value('title', (isset($webinar->title)) ? $webinar->title : ''); ?>"  />

<input class="form-control" type="hidden" name="class_id" maxlength="256" value="<?php echo set_value('wiziq_class_id', (isset($webinar->wiziq_class_id)) ? $webinar->wiziq_class_id : ''); ?>"  />        
<input class="form-control" type="hidden" name="created_by" maxlength="256" value="<?php echo set_value('created_by', (isset($webinar->created_by)) ? $webinar->created_by : ''); ?>"  />        



  <!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="subject-target" class="tooltipicon"></span>

						<span class="subject-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_subject');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
					</div> 
                    <span class="error"><?php echo form_error('title'); ?></span>
				</div> 
                
                <div class="form-group"> 
                    <label class="col-sm-3 control-label" for="type"><?php echo 'Type'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    
                        <select id="type" name="type" class="form-control">



	<option value="webinar" <?php if(isset($webinar->type) && $webinar->type == "webinar") echo "selected"; ?>>Webinar</option>



	<option value="meeting" <?php if(isset($webinar->type) && $webinar->type == "meeting") echo "selected"; ?>>Meeting</option>



	</select>



<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="type-target" class="tooltipicon"></span>

						<span class="type-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_type');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->
					</div>
                    <span class="error"><?php echo form_error('type'); ?></span> 
				</div>
                
                <div class="form-group"> 
                	
                    <label class="col-sm-3 control-label" for="privacy"><?php echo 'Privacy'?> <span class="required">*</span></label>

                    <div class="col-sm-5"> 
                    	
                        <select id="privacy" name="privacy" class="form-control">


							<option value="private" <?php if(isset($webinar->privacy) && $webinar->privacy == "private") echo "selected"; ?>>Private</option>



							<option value="public" <?php if(isset($webinar->privacy) && $webinar->privacy == "public") echo "selected"; ?>>Public</option>



						</select>



					<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="privacy-target" class="tooltipicon"></span>

						<span class="privacy-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_privacy');?>

                         <!--/tip containt-->

						</span>

						</span>

						<!-- tooltip area finish -->

					</div> 
                    <span class="error"><?php echo form_error('privacy'); ?></span>
				</div> 
				<?php //print_r($webinar);
$gmtime = date("h:i");
$gmdate = date("Y-m-d"); ?>
<!--                 <div class="col-md-3" style="float:left; padding: 0;"> 
 -->        <!-- if($updType=='create'){echo $gmdate;} else{ -->
<!--                        <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php if($updType=='create'){echo $gmdate;} else{ echo set_value('fromdate', (isset($webinar->fromdate)) ? $webinar->fromdate : ''); } ?>"  />  
 -->                       <!-- <?php echo date("m-d-Y"); ?> -->
                       <!-- <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php echo date("m-d-Y"); ?>"  /> -->  
<!--                      </div> 
 -->                    
                    <!-- <div class="col-sm-2" style="float:left;"> 
                      <input name="fromtime11" id="fromtime11" type="hidden"> 
                      <input type="time" name="fromtime" id="fromtime" value="<?php if($updType=='create'){echo $gmtime;} else{ echo set_value('fromtime', (isset($webinar->fromtime)) ? $webinar->fromtime : ''); }?>">
                    
					<span>GMT</span>

					</div> -->
				<div class="form-group"> 
                    <label class='col-sm-3 control-label' for="fromdate"><?php echo 'Starts On'?> <span class="required">*</span></label>
                    <div class="col-sm-3"> 
                    	<input class="form-control" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php if($updType=='create'){echo $gmdate;} else{ echo set_value('fromdate', (isset($webinar->fromdate)) ? $webinar->fromdate : ''); } ?>"  />  
<!--                         <input class="form-control" id="fromdate" type="text" name="fromdate" maxlength="256" value="<?php echo set_value('fromdate', (isset($webinar->fromdate)) ? $webinar->fromdate : ''); ?>"  /> 
 -->					</div> 
                    <div class="col-sm-2" style="float:left;"> 
                    	 <input name="fromtime11" id="fromtime11" type="hidden"> 
                      <input type="time" name="fromtime" id="fromtime" value="<?php if($updType=='create'){echo $gmtime;} else{ echo set_value('fromtime', (isset($webinar->fromtime)) ? $webinar->fromtime : ''); }?>">
                    <span>GMT</span>




<!-- tooltip area -->

						<span class="tooltipcontainer">

						<span type="text" id="fromdate-target" class="tooltipicon"></span>

						<span class="fromdate-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						<!--tip containt-->

						<?php echo lang('webinar_fld_fromdate');?>

                         <!--/tip containt-->

						</span>

						</span>

<!-- tooltip area finish -->

					</div> 
                    <span class="error"><?php echo form_error('fromdate'); ?></span><span class="error"><?php echo form_error('fromtime'); ?></span> 
                    <!--  <span >GMT</span> -->
				</div> 
                
                <!-- <div class="form-group"> 
                    <label class='col-sm-3 control-label' for="todate"><?php echo 'To'?> <span class="required">*</span></label> 
                    <div class="col-sm-3"> 
                        <input class="form-control" id="todate" type="text" name="todate" maxlength="256" value="<?php echo set_value('todate', (isset($webinar->fromdate)) ? $webinar->todate : ''); ?>"  /> 
					</div> 
                    <div class="col-sm-2"> 
                    	
                        <select class="form-control" onchange="ValidateDate()" id="totime" name="totime">







</select>



<!-- tooltip area -->

						<!-- <span class="tooltipcontainer">

						<span type="text" id="todate-target" class="tooltipicon"></span>

						<span class="todate-target  tooltargetdiv" style="display: none;" > -->

						<!-- <span class="closetooltip"></span> -->

						<!--tip containt-->

						<?php //echo lang('webinar_fld_todate');?>

                         <!--/tip containt-->

						<!-- </span>

						</span>
 -->
<!-- tooltip area finish -->

					<!-- </div> 
                    <span class="error"><?php echo form_error('todate'); ?></span><span class="error"><?php echo form_error('totime'); ?></span>
                    <span>GMT</span>
				</div>  --> 
                
           <!--<div class="form-group"> 
                	<label class="col-sm-3 control-label" for="allday"><?php echo 'All day'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    	<div class="checkbox"> 
                        	<label> 
                            <input id="allday" type="checkbox" name="allday"  <?php if(isset($webinar->allday) && $webinar->allday == 1) echo "checked"; ?>/>
							</label> 



						<span class="tooltipcontainer">

						<span type="text" id="allday_published-target" class="tooltipicon"></span>

						<span class="allday_published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

						
						<?php echo lang('webinar_fld_allday-published');?>



						</span>

						</span>



                        </div> 
                        <span class="error"><?php echo form_error('allday'); ?></span>
                         
					</div> 
				</div> 
                
                <div class="form-group"> 
                    <label class='col-sm-3 control-label' for="repeate"><?php echo 'Repeate'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    	
                        <select id="repeate" name="repeate" class="form-control">



	<option value="never" <?php if(isset($webinar->repeate) && $webinar->repeate == "never") echo "selected"; ?>>Never</option>



	<option value="every_day" <?php if(isset($webinar->repeate) && $webinar->repeate == "every_day") echo "selected"; ?>>Every Day</option>



	<option value="every_week" <?php if(isset($webinar->repeate) && $webinar->repeate == "every_week") echo "selected"; ?>>Every Week</option>



	<option value="every_month" <?php if(isset($webinar->repeate) && $webinar->repeate == "every_month") echo "selected"; ?>>Every Month</option>



	</select>





						<span class="tooltipcontainer">

						<span type="text" id="repeat-target" class="tooltipicon"></span>

						<span class="repeat-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>


						<?php echo lang('webinar_fld_repeat');?>

                         

						</span>

						</span>




					</div> 
                    <span class="error"><?php echo form_error('repeate'); ?></span> 
				</div> 
                
                <div class="form-group"> 
                
                    <label class='col-sm-3 control-label' for="untilldate"><?php echo 'Untill Date'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                        <input id="untilldate" type="text" name="untilldate" class="form-control" maxlength="256" value="<?php echo set_value('untilldate', (isset($webinar->untilldate)) ? $webinar->untilldate : ''); ?>"  />





						<span class="tooltipcontainer">

						<span type="text" id="untildate-target" class="tooltipicon"></span>

						<span class="untildate-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('webinar_fld_untildate');?>

              

						</span>

						</span>

					</div> 
                    <span class="error"><?php echo form_error('untilldate'); ?></span>
				</div> 
                
                <div class="form-group"> 
                <label class='col-sm-3 control-label' for="start_recording"><?php echo 'Start Recording'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    
                    	<div class="checkbox"> 
                        	<label> <input id="start_recording" type="checkbox" name="start_recording" <?php if(isset($webinar->start_recording) && $webinar->start_recording == 1) echo "checked"; ?>/></label> 





						<span class="tooltipcontainer">

						<span type="text" id="start_recording-target" class="tooltipicon"></span>

						<span class="start_recording-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('webinar_fld_start-recording');?>

               

						</span>

						</span>


                        </div> 
                         <span class="error"><?php echo form_error('start_recording'); ?></span>
					</div> 
				</div> -->
                    <div class="form-group"> 
      <label class="col-sm-3 control-label">
        Duration<span class="required">*</span>
      </label>
      <div class="col-sm-5">

        <div class="" style="float:left; padding: 0;"> 
        <input type="text" placeholder="Ex.30" value="<?php if($updType=='create'){echo '30';} else{ echo set_value('web_duration', (isset($webinar->web_duration)) ? $webinar->web_duration : ''); }?>" id="web_duration" name="web_duration"> (Enter duration between 30 to 300 minutes.)
        </div>
        </div>
    </div>
                <div class="form-group"> 
                    <label class='col-sm-3 control-label' for="status"><?php echo 'Status'?> <span class="required">*</span></label>
                    <div class="col-sm-5"> 
                    
                        <select class="form-control" id="status" name="status">



	<option value="active" <?php if(isset($webinar->status) && $webinar->status == "active") echo "selected"; ?>>Active</option>



	<option value="deactive" <?php if(isset($webinar->status) && $webinar->status == "deactive") echo "selected"; ?>>Deactive</option>



	</select>






						<span class="tooltipcontainer">

						<span type="text" id="published-target" class="tooltipicon"></span>

						<span class="published-target  tooltargetdiv" style="display: none;" >

						<span class="closetooltip"></span>

					

						<?php echo lang('webinar_fld_published');?>

               

						</span>

						</span>

					</div> 
                    <span class="error"><?php echo form_error('status'); ?></span>
				</div> 
                
                <div class="form-group"> 
                	<div class="col-sm-offset-3 col-sm-5"> 
                		 <?php 
              $sec_id = $this->uri->segment(4);
              $c_id = $this->uri->segment(5);
              $w_id = $this->uri->segment(6);  ?>
              <input type="button" value="Save" name="submit" id="submit" class="btn btn-success" onclick="save_webinar('<?php echo $sec_id; ?>','<?php echo $c_id; ?>','<?php echo $w_id; ?>')"> 

<!--                     <a><?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'") ); ?></a>
 -->					<a href='<?php echo base_url(); ?>admin/webinars/listings/<?php echo $proid?>' class='btn btn-red'><span class="icon-32-cancel"> </span>Cancel </a>
                    </div> 
				</div> 
			</fieldset> 
		</div> 
	</div> 
</div>

<?php echo form_hidden('proid',$id) ?>

<?php if ($updType == 'edit'): ?>


	<?php echo form_hidden('id',$webinar->id) ?>


<?php endif ?>

<?php echo form_close(); ?>



<link rel="stylesheet" href="<?php echo base_url(); ?>js/redactor/css/redactor.css" />



<script src="<?php echo base_url(); ?>js/redactor/redactor.js"></script>



<!--<script>



 $(document).ready(



 function()



 {



 validate();



   	$('#description').redactor(); 



  });


 </script>





 <!-- tool tip script --> 

<script type="text/javascript">

function ValidateDate()
{
	var start_time = $('#fromtime').val();

	var end_time = $('#totime').val();

	var start_date = $('#fromdate').val();

	var end_date = $('#todate').val();
	

	var dtStart = new Date(start_date+' '+ start_time);
	var dtEnd = new Date(end_date+' '+ end_time);
	var difference_in_milliseconds = dtEnd - dtStart;
	if (difference_in_milliseconds < 0)
	{
	alert("End Time is before Start Time!");
	}

}

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

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />
<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
var $j =jQuery.noConflict();
function validatepop(strtitle,strcontent)
  {   
      //var strtitle ='Name Required';  
      var strcontent1 ='<p style="text-align: center;font-weight: 700;font-size: 15px;">'+strcontent+'</p>';
    //   var validmsg='<div class="validateerror alert alert-danger">';
    //       validmsg+='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    //   validmsg+='<strong>Warning!</strong>'+strcontent+' </div>';
    //    if($j("div").is('.alert-danger') == true)
    //    {  alert('fdf');
    //      validmsg1 ='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    //   validmsg1+='<strong>Warning!</strong>'+strcontent;
        
    //      $j(".alert-danger").html(validmsg1);
    // }
    // else
    // {    alert('fdfsss');
    //  //$j("#sticky-anchor").before(validmsg);
    //    $j("#proform").prepend(validmsg);
    // }
    $j.alert({
           title: strtitle,
        content: strcontent1,
       confirm: function()
                   {                        
              
                   }
               });
  }</script>

<script type="text/javascript">
function print() {
  t = document.getElementById('fromtime').value
  h = t.substr(0,2);
  ms = t.substr(2)
  document.getElementById('fromtime11').value = ((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');
  console.log((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');
}
</script>

	<script type="text/javascript">
function save_webinar(s_id,c_id,w_id)
{ 
    t = document.getElementById('fromtime').value
  h = t.substr(0,2);
  ms = t.substr(2)
  document.getElementById('fromtime11').value = ((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');
  console.log((h%12+12*(h%12==0))+ms, h >= 12 ? 'PM' : 'AM');

   var c_id = c_id;
   var w_id = w_id;
   var s_id = s_id;
   var title = $("#title").val();
   var fromdate = $("#fromdate").val();
   var fromtime = $("#fromtime").val();
   var web_duration = $("#web_duration").val();

   if(title.trim() =="")
    {
      
      validatepop('Webinar Title Required','Please Enter Title For Webinar!');   
      return false;
    }
    else if(fromdate.trim() =="")
    {
      
      validatepop('Startup Date Required','Please Fill Date of Webinar!');   
      return false;
    }
    else if(fromtime.trim() =="")
    {
      
      validatepop('Startup Time Required','Please Fill Time of Webinar!');   
      return false;
    }
    else if(web_duration.trim() =="")
    {
      
      validatepop('Time Duration Required','Please Enter Required Duration For Webinar!');   
      return false;
    }
    else
    {
    
       var updType ="<?php echo $updType; ?>";

        if(updType == 'create' )
        {
          post_webinar(s_id,c_id);
        }
        else {
          edit_webinar(s_id,c_id,w_id);
        }
    }
}


function post_webinar(s_id,idd)
{

   $.ajax({
         
          type: "POST",
          url: " <?php echo base_url()?>webinars/create2/"+s_id+"/"+idd, //<?php echo base_url('tasks/save_lecture/')?>",
          data: $("#tform").serialize(),
         //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
          success: function(msg)
          {    console.log(msg);
            //alert(msg);
              if(msg == "success")
              {
                  $.alert({
                    // type: 'error',
                    
                   title: "Success",
                 content: '<center><b><h4 style="padding:2%;">Webinar Created Successfully! </h4></b></center>',
                  confirm: function()
                            {
                              // <?php echo base_url(); ?>sections-manage/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(1); ?>"
                              window.location ="<?php echo base_url(); ?>admin/section-management/<?php echo $this->uri->segment(5); ?>";
                 
                             }
                         });

              } 

             else
              {
                  $.alert({
                    // type: 'error',
                    
                   title: "Error",
                 content: '<center><b><h4 style="padding:2%;">'+msg+' </h4></b></center>',
                  confirm: function()
                            {
                            // window.location ="<?php echo base_url();?>sections-manage/"+seg4+"/index";
                              $('.error').remove();
                            return true;
                 
                             }
                         });

              }
              
          }
      });
}


function edit_webinar(s_id,c_id,w_id)
{
  //alert(w_id);
  // var id = <?php echo $this->uri->segment(3); ?>
  // alert(id);
   $.ajax({
         
          type: "POST",
          url: " <?php echo base_url()?>webinars/edit2/"+s_id+"/"+c_id+"/"+w_id, //<?php echo base_url('tasks/save_lecture/')?>",
          data: $("#tform").serialize(),
         //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
          success: function(msg)
          {    console.log(msg);
           // alert(msg);
              if(msg == "success")
              {
                  $j.alert({
                    // type: 'error',
                    
                   title: "Success",
                 content: '<center><b><h4 style="padding:2%;">Webinar Updated Successfully! </h4></b></center>',
                  confirm: function()
                           {
                              window.location ="<?php echo base_url(); ?>admin/section-management/<?php echo $this->uri->segment(5); ?>";
                            }
                         });

              } 

             else
              {
                  $j.alert({
                    // type: 'error',
                    
                   title: "Error",
                 content: '<center><b><h4 style="padding:2%;">'+msg+' </h4></b></center>',
                  confirm: function()
                            {
                            // window.location ="<?php echo base_url();?>sections-manage/"+seg4+"/index";
                              $('.error').remove();
                            return true;
                 
                             }
                         });

              }
              
          }
      });
}
 </script>
