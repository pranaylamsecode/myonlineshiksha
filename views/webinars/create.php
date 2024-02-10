<?php
// exit('jyoti');
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

 
//$timezone = new DateTimeZone($configarr[0]['time_zone']); 
    
    $date = new DateTime();   
 //   $date->setTimezone($timezone);    
    $currdate1 = $date->format( 'Y-m-d' );          
    $currtime1 = $date->format( 'h:i' );    
    $currdateandtime = $date->format( 'Y-m-d h:ia' ); 
?>



<?php

$attributes = array('class' => 'tform', 'id' => 'tform', 'onsubmit' => 'sub_val()');

echo ($updType == 'create') ? form_open(base_url().'webinars/create/'.$proid, $attributes) : form_open(base_url().'webinars/edit/'.$proid, $attributes);

?>

<style>
label
{
margin-bottom: 0;
padding:0 0 0 20px;
}
</style>


<header>
    <section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
         <h2><?php echo ($updType == 'create') ? "Create Webinar" : "Edit Webinar"?></h2>
        </div>
      </div>
    </div>
  </section>
</header>


<div class="page-container">
<div class="sidebar-menu">
  <ul id="main-menu" class="" style="min-height:895px;">
              <li class="root-level"><a href="<?php echo base_url(); ?>programs/lists/"><span>My Courses</span></a></li>  
              <li class="root-level"><a href="<?php echo base_url(); ?>quizzes/"><span>My Quizzes</span></a></li>   
              <li class="root-level"><a href="<?php echo base_url(); ?>mcategories/"><span>Media Category</span></a></li>  
              <li class="root-level"><a href="<?php echo base_url(); ?>medias/"><span>Media Library</span></a></li>
      </ul>
</div>


<div class="main-content" style="min-height: 820px;">
<div class="row">
    
<div class="sidebar-collapse" style="float:none; margin-top:10px; margin-right:20px; margin-bottom:10px;">
  <a href="#" class="sidebar-collapse-icon with-animation">
    <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
    <i class="entypo-menu"></i>
  </a>
</div>


<div class="panel panel-primary" data-collapsed="0"> 

  <div class="panel-heading">
    <div class="panel-title" style="padding-bottom: 0px;">  
      <h3 style="margin-top: 0;"><?php echo ($updType == 'create') ? "Create webinar for ".$programs->name : "Edit webinar"?></h3>
    </div>
    
  </div>


  <div class="panel-body form-horizontal form-groups-bordered"> 

    <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Subject'?> <span class="required">*</span></label> 

      <div class="col-sm-5"> 

        <input class="form-control" id="title" type="text" name="title" maxlength="256" value="<?php echo set_value('title', (isset($webinar->title)) ? $webinar->title : ''); ?>"  />

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
 <span class="error"><?php echo form_error('title'); ?></span>

      </div> 
    </div>

    <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Type'?> <span class="required">*</span></label> 

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
            <span class="error"><?php echo form_error('type'); ?></span> 
      </div> 
    </div>

    <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Privacy'?> <span class="required">*</span></label> 

      <div class="col-sm-5">



                      
               <select id="privacy" name="privacy"  class="form-control">


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

                    <span class="error"><?php echo form_error('privacy'); ?></span>
      </div> 
    </div>
<?php //print_r($webinar);
// $gmtime = gmdate("h:i");
// $gmdate = gmdate("Y-m-d"); ?>

    <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Starts On'?> <span class="required">*</span></label> 

      <div class="col-sm-5"> 

      <div class="col-md-3" style="float:left; padding: 0;"> 
        <!-- if($updType=='create'){echo $gmdate;} else{ -->
                       <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php if($updType=='create'){echo $currdate1;} else{ echo set_value('fromdate', (isset($webinar->fromdate)) ? $webinar->fromdate : ''); } ?>"  />  
                       <!-- <?php echo date("m-d-Y"); ?> -->
                       <!-- <input class="" id="fromdate" type="date" name="fromdate" maxlength="256" value="<?php echo date("m-d-Y"); ?>"  /> -->  
                     </div> 
                    
                    <div class="col-sm-2" style="float:left;"> 
                      <input name="fromtime11" id="fromtime11" type="hidden"> 
                      <input type="time" name="fromtime" id="fromtime" value="<?php if($updType=='create'){echo $currtime1;} else{ echo set_value('fromtime', (isset($webinar->fromtime)) ? $webinar->fromtime : ''); }?>">
                        <!-- <select class="" id="fromtime" name="fromtime">

<option value='0'>Select time</option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:00 AM") echo "selected"; ?>>12:00 AM</option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:15 AM") echo "selected"; ?>>12:15 AM</option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:30 AM") echo "selected"; ?>>12:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:45 AM") echo "selected"; ?>>12:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:00 AM") echo "selected"; ?>>01:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:15 AM") echo "selected"; ?>>01:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:30 AM") echo "selected"; ?>>01:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:45 AM") echo "selected"; ?>>01:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:00 AM") echo "selected"; ?>>02:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:15 AM") echo "selected"; ?>>02:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:30 AM") echo "selected"; ?>>02:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:45 AM") echo "selected"; ?>>02:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:00 AM") echo "selected"; ?>>03:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:15 AM") echo "selected"; ?>>03:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:30 AM") echo "selected"; ?>>03:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:45 AM") echo "selected"; ?>>03:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:00 AM") echo "selected"; ?>>04:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:15 AM") echo "selected"; ?>>04:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:30 AM") echo "selected"; ?>>04:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:45 AM") echo "selected"; ?>>04:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:00 AM") echo "selected"; ?>>05:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:15 AM") echo "selected"; ?>>05:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:30 AM") echo 'selected="selected"'; ?>>05:30 AM </option> 

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:45 AM") echo "selected"; ?>>05:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:00 AM") echo "selected"; ?>>06:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:15 AM") echo "selected"; ?>>06:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:30 AM") echo "selected"; ?>>06:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:45 AM") echo "selected"; ?>>06:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:00 AM") echo "selected"; ?>>07:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:15 AM") echo "selected"; ?>>07:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:30 AM") echo "selected"; ?>>07:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:45 AM") echo "selected"; ?>>07:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:00 AM") echo "selected"; ?>>08:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:15 AM") echo "selected"; ?>>08:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:30 AM") echo "selected"; ?>>08:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:45 AM") echo "selected"; ?>>08:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:00 AM") echo "selected"; ?>>09:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:15 AM") echo "selected"; ?>>09:15 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:30 AM") echo "selected"; ?>>09:30 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:45 AM") echo "selected"; ?>>09:45 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:00 AM") echo "selected"; ?>>10:00 AM </option>

<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:15 AM") echo "selected"; ?>>10:15 AM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:30 AM") echo "selected"; ?>>10:30 AM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:45 AM") echo "selected"; ?>>10:45 AM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:00 AM") echo "selected"; ?>>11:00 AM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:15 AM") echo "selected"; ?>>11:15 AM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:30 AM") echo "selected"; ?>>11:30 AM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:45 AM") echo "selected"; ?>>11:45 AM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:00 PM") echo "selected"; ?>>12:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:15 PM") echo "selected"; ?>>12:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:30 PM") echo "selected"; ?>>12:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "12:45 PM") echo "selected"; ?>>12:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:00 PM") echo "selected"; ?>>01:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:15 PM") echo "selected"; ?>>01:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:30 PM") echo "selected"; ?>>01:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "01:45 PM") echo "selected"; ?>>01:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:00 PM") echo "selected"; ?>>02:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:15 PM") echo "selected"; ?>>02:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:30 PM") echo "selected"; ?>>02:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "02:45 PM") echo "selected"; ?>>02:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:00 PM") echo "selected"; ?>>03:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:15 PM") echo "selected"; ?>>03:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:30 PM") echo "selected"; ?>>03:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "03:45 PM") echo "selected"; ?>>03:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:00 PM") echo "selected"; ?>>04:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:15 PM") echo "selected"; ?>>04:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:30 PM") echo "selected"; ?>>04:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "04:45 PM") echo "selected"; ?>>04:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:00 PM") echo "selected"; ?>>05:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:15 PM") echo "selected"; ?>>05:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:30 PM") echo "selected"; ?>>05:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "05:45 PM") echo "selected"; ?>>05:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:00 PM") echo "selected"; ?>>06:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:15 PM") echo "selected"; ?>>06:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:30 PM") echo "selected"; ?>>06:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "06:45 PM") echo "selected"; ?>>06:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:00 PM") echo "selected"; ?>>07:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:15 PM") echo "selected"; ?>>07:15 PM </option>


 
<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:30 PM") echo "selected"; ?>>07:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "07:45 PM") echo "selected"; ?>>07:45 PM</option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:00 PM") echo "selected"; ?>>08:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:15 PM") echo "selected"; ?>>08:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:30 PM") echo "selected"; ?>>08:30 PM </option>


 
<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "08:45 PM") echo "selected"; ?>>08:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:00 PM") echo "selected"; ?>>09:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:15 PM") echo "selected"; ?>>09:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:30 PM") echo "selected"; ?>>09:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "09:45 PM") echo "selected"; ?>>09:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:00 PM") echo "selected"; ?>>10:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:15 PM") echo "selected"; ?>>10:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:30 PM") echo "selected"; ?>>10:30 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "10:45 PM") echo "selected"; ?>>10:45 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:00 PM") echo "selected"; ?>>11:00 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:15 PM") echo "selected"; ?>>11:15 PM </option>



<option <?php if(isset($webinar->fromtime) && $webinar->fromtime == "11:30 PM") echo "selected"; ?>>11:30 PM </option>







</select> -->
<span>GMT</span>

</div>
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

          
                    <span class="error"><?php echo form_error('fromdate'); ?></span><span class="error"><?php echo form_error('fromtime'); ?></span> 

      </div> 
    </div>
    <div class="form-group"> 
      <label class="col-sm-3 control-label">
        Duration<span class="required">*</span>
      </label>
      <div class="col-sm-5">

        <div class="col-md-3" style="float:left; padding: 0;"> 
        <input type="text" placeholder="Ex.30" value="<?php if($updType=='create'){echo '30';} else{ echo set_value('web_duration', (isset($webinar->web_duration)) ? $webinar->web_duration : ''); }?>" id="web_duration" name="web_duration"> (Enter duration between 30 to 300 minutes.)
        </div>
        </div>
    </div>

   <!--  <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'To'?> <span class="required">*</span></label> 

      <div class="col-sm-5">

      <div class="col-md-3" style="float:left; padding: 0;"> 
                        <input  class="" id="todate" type="date" name="todate" maxlength="256" value="<?php echo set_value('todate', (isset($webinar->fromdate)) ? $webinar->todate : ''); ?>"  /> 
                        </div>
                    <div class="col-md-2" style="float:left;"> 
                      
                        <select id="totime"  class="" onchange="ValidateDate()" name="totime">



<option value='0'>Select time</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:00AM") echo "selected"; ?>>12:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:15AM") echo "selected"; ?>>12:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:30AM") echo "selected"; ?>>12:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:45AM") echo "selected"; ?>>12:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:00AM") echo "selected"; ?>>01:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:15AM") echo "selected"; ?>>01:15 AM</option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:30AM") echo "selected"; ?>>01:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:45AM") echo "selected"; ?>>01:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:00AM") echo "selected"; ?>>02:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:15AM") echo "selected"; ?>>02:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:30AM") echo "selected"; ?>>02:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:45AM") echo "selected"; ?>>02:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:00AM") echo "selected"; ?>>03:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:15AM") echo "selected"; ?>>03:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:30AM") echo "selected"; ?>>03:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:45AM") echo "selected"; ?>>03:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:00AM") echo "selected"; ?>>04:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:15AM") echo "selected"; ?>>04:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:30AM") echo "selected"; ?>>04:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:45AM") echo "selected"; ?>>04:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:00AM") echo "selected"; ?>>05:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:15AM") echo "selected"; ?>>05:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:30AM") echo "selected"; ?>>05:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:45AM") echo "selected"; ?>>05:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:00AM") echo "selected"; ?>>06:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:15AM") echo "selected"; ?>>06:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:30AM") echo "selected"; ?>>06:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:45AM") echo "selected"; ?>>06:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:00AM") echo "selected"; ?>>07:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:15AM") echo "selected"; ?>>07:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:30AM") echo "selected"; ?>>07:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:45AM") echo "selected"; ?>>07:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:00AM") echo "selected"; ?>>08:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:15AM") echo "selected"; ?>>08:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:30AM") echo "selected"; ?>>08:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:45AM") echo "selected"; ?>>08:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:00AM") echo "selected"; ?>>09:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:15AM") echo "selected"; ?>>09:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:30AM") echo "selected"; ?>>09:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:45AM") echo "selected"; ?>>09:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:00AM") echo "selected"; ?>>10:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:15AM") echo "selected"; ?>>10:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:30AM") echo "selected"; ?>>10:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:45AM") echo "selected"; ?>>10:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:00AM") echo "selected"; ?>>11:00 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:15AM") echo "selected"; ?>>11:15 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:30AM") echo "selected"; ?>>11:30 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:45AM") echo "selected"; ?>>11:45 AM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:00PM") echo "selected"; ?>>12:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:15PM") echo "selected"; ?>>12:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:30PM") echo "selected"; ?>>12:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "12:45PM") echo "selected"; ?>>12:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:00PM") echo "selected"; ?>>01:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:15PM") echo "selected"; ?>>01:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:30PM") echo "selected"; ?>>01:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "01:45PM") echo "selected"; ?>>01:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:00PM") echo "selected"; ?>>02:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:15PM") echo "selected"; ?>>02:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:30PM") echo "selected"; ?>>02:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "02:45PM") echo "selected"; ?>>02:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:00PM") echo "selected"; ?>>03:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:15PM") echo "selected"; ?>>03:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:30PM") echo "selected"; ?>>03:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "03:45PM") echo "selected"; ?>>03:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:00PM") echo "selected"; ?>>04:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:15PM") echo "selected"; ?>>04:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:30PM") echo "selected"; ?>>04:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "04:45PM") echo "selected"; ?>>04:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:00PM") echo "selected"; ?>>05:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:15PM") echo "selected"; ?>>05:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:30PM") echo "selected"; ?>>05:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "05:45PM") echo "selected"; ?>>05:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:00PM") echo "selected"; ?>>06:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:15PM") echo "selected"; ?>>06:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:30PM") echo "selected"; ?>>06:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "06:45PM") echo "selected"; ?>>06:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:00PM") echo "selected"; ?>>07:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:15PM") echo "selected"; ?>>07:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:30PM") echo "selected"; ?>>07:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "07:45PM") echo "selected"; ?>>07:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:00PM") echo "selected"; ?>>08:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:15PM") echo "selected"; ?>>08:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:30PM") echo "selected"; ?>>08:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "08:45PM") echo "selected"; ?>>08:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:00PM") echo "selected"; ?>>09:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:15PM") echo "selected"; ?>>09:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:30PM") echo "selected"; ?>>09:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "09:45PM") echo "selected"; ?>>09:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:00PM") echo "selected"; ?>>10:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:15PM") echo "selected"; ?>>10:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:30PM") echo "selected"; ?>>10:30 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "10:45PM") echo "selected"; ?>>10:45 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:00PM") echo "selected"; ?>>11:00 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:15PM") echo "selected"; ?>>11:15 PM </option>



<option <?php if(isset($webinar->totime) && $webinar->totime == "11:30PM") echo "selected"; ?>>11:30 PM </option>







</select>
  <span>GMT</span>
</div> 



            <span class="tooltipcontainer">

            <span type="text" id="todate-target" class="tooltipicon"></span>

            <span class="todate-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>


            <?php echo lang('webinar_fld_todate');?>

                     
            </span>

            </span>



          
                    <span class="error"><?php echo form_error('todate'); ?></span><span class="error"><?php echo form_error('totime'); ?></span>

      </div> 
    </div> -->

   <!-- <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'All day'?> <span class="required">*</span></label> 

      <div class="col-sm-5"> <div class="checkbox"> 
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
      <label class="col-sm-3 control-label"><?php echo 'Repeate'?> <span class="required">*</span></label> 

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





                    <span class="error"><?php echo form_error('repeate'); ?></span> 

      </div> 
    </div>

    <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Untill Date'?> <span class="required">*</span></label> 

      <div class="col-sm-5"> 
        <input id="untilldate" class="form-control" type="text" name="untilldate" maxlength="256" value="<?php echo set_value('untilldate', (isset($webinar->untilldate)) ? $webinar->untilldate : ''); ?>"  />





            <span class="tooltipcontainer">

            <span type="text" id="untildate-target" class="tooltipicon"></span>

            <span class="untildate-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

            

            <?php echo lang('webinar_fld_untildate');?>

                        

            </span>

            </span>


                    <span class="error"><?php echo form_error('untilldate'); ?></span>
      </div> 
    </div>

    <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Start Recording'?> <span class="required">*</span></label> 

      <div class="col-sm-5"> <div class="checkbox"> 
                          <label> <input id="start_recording" type="checkbox" name="start_recording" <?php if(isset($webinar->start_recording) && $webinar->start_recording == 1) echo "checked"; ?>/></label> 




            <span class="tooltipcontainer">

            <span type="text" id="start_recording-target" class="tooltipicon"></span>

            <span class="start_recording-target  tooltargetdiv" style="display: none;" >

            <span class="closetooltip"></span>

          

            <?php echo lang('webinar_fld_start-recording');?>

                         

            </span>

            </span>


                         <span class="error"><?php echo form_error('start_recording'); ?></span>
      </div> 
    </div>
    </div>-->

    <div class="form-group"> 
      <label class="col-sm-3 control-label"><?php echo 'Status'?> <span class="required">*</span></label> 

      <div class="col-sm-5"> 

       <select id="status" name="status" class="form-control">



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



                    <span class="error"><?php echo form_error('status'); ?></span>

      </div> 
    </div>



<div class="form-group"> 
            <div class="col-sm-offset-3 col-sm-5"> 
<!--                             <a onclick="print()"><?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'") ); ?></a>
 -->           
              <?php 
              $sec_id = $this->uri->segment(4);
              $c_id = $this->uri->segment(5);
              $w_id = $this->uri->segment(6);  ?>
                           <img id='loading' style='display:none;margin-right: 50%;float: right;' src="http://loadinggif.com/images/image-selection/3.gif">

              <input type="button" value="Save" name="submit" id="submit"  class="btn btn-success" onclick="save_webinar('<?php echo $sec_id; ?>','<?php echo $c_id; ?>','<?php echo $w_id; ?>')"> 

<!--               <a onclick="save_webinar('<?php echo $c_id; ?>','<?php echo $w_id; ?>')"><?php echo form_submit( 'submit', ($updType == 'edit') ? 'Save' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-default'" : "id='submit' class='btn btn-default'") ); ?></a>
 -->          
          <a href='<?php echo base_url(); ?>sections-manage/<?php echo $c_id; ?>/<?php echo $this->uri->segment(3);?>' class='btn btn-danger'>Cancel</a>
            </div> 
          </div> 
  </div>

</div>    


 

</div>

</div>

</div>

<div style="clear:both;"></div>

<?php echo form_hidden('proid',$id) ?>

<?php if ($updType == 'edit'): ?>

<?php echo form_hidden('id',$webinar->id) ?>

<?php endif ?>

<?php echo form_close(); ?>




<!--<script>

                      
                               jQuery(document).ready(function() {
                                       var mySlidebars = new jQuery.slidebars();
                                       
                                       jQuery('.toggle-left').on('click', function() {
                                               mySlidebars.toggle('left');
                                       });
                                       
                                       jQuery('.toggle-right').on('click', function() {
                                               mySlidebars.toggle('right');
                                       });
                               });
                    
</script>-->
 
<!-- tool tip script -->

<!--<script src="<?php echo base_url()?>public/js/ajaxfileupload.js"></script>-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />    
  
   <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script>
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
 $j(document).ready(function(){
  $j("#fromdate").datepicker({ dateFormat: 'yy-mm-dd' }).val();
     $j( "#todate" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
     $j( "#untilldate" ).datepicker({dateFormat: 'yy-mm-dd'}).val();
 });

</script>

<script type="text/javascript">



function ValidateDate()
{
  // var start_time = $('#fromtime').val();

  // var end_time = $('#totime').val();

  // var start_date = $('#fromdate').val();

  // var end_date = $('#todate').val();
  

  // var dtStart = new Date(start_date+' '+ start_time);
  // var dtEnd = new Date(end_date+' '+ end_time);
  // var difference_in_milliseconds = dtEnd - dtStart;
  // if (difference_in_milliseconds < 0)
  // {
  // alert("End Time is before Start Time!");
  // }

}

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
<script type="text/javascript">
  function sub_val(){
  var dur = jQuery("#web_duration").val();
  var date1 = jQuery("#fromdate").val(); 
  var time = jQuery("#fromtime").val();
  var dattime = date1+" "+time;
  var dateObj= new Date() ;
  var month = ('0' + (dateObj.getMonth() + 1)).slice(-2);
  var date = ('0' + dateObj.getDate()).slice(-2);
  var year = dateObj.getFullYear();
  var shortDate = year + '-' + month + '-' + date;
  // alert(shortDate+" "+date1);
  // if(date1 >= shortDate){
  //  alert('yes');
  // }else{
  //  alert('Select proper date');
  //  return false;
  // }
  
    if(dur>=30 && dur<=300){

    }
    else{
      alert("Please enter duration between 30 to 300 minutes.");
      return false;
    }
  }
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
     else if(web_duration.trim() < 30)
    { 
      validatepop('Given Duration is too short!',' Required Minimum 30 Minutes of duration!');   
      return false;
    }
    else
    {
       $('#loading').show();
       $('#submit').addClass('disabled');
       var updType ="<?php echo $updType; ?>";
       // alert(updType);
        if(updType == 'create' )
        {
           // alert('jyoti');
          post_webinar(s_id,c_id);
        }
        else {
           // alert(updType);
          edit_webinar(s_id,c_id,w_id);
        }
    }
}


function post_webinar(s_id,idd)
{
 // alert('jyoti');
   $.ajax({
         
          type: "POST",
          url: " <?php echo base_url()?>webinars/create2/"+s_id+"/"+idd, //<?php echo base_url('tasks/save_lecture/')?>",
          data: $("#tform").serialize(),
         //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
          success: function(msg)
          {  
               $('#loading').hide();
               $('#submit').removeClass('disabled');
                 console.log(msg);
            //alert(msg);
              if(msg == "success")
              { 
                
                  $j.alert({
                    // type: 'error',
                    
                   title: "Success",
                 content: '<center><h4 style="color:#016ac1;padding:2%;font-weight:bold;">Webinar Created Successfully! </h4></center>',
                  confirm: function()
                            {  

                              // <?php echo base_url(); ?>sections-manage/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(1); ?>"
                              window.location ="<?php echo base_url(); ?>sections-manage/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(3); ?>";
                 
                             }
                         });

              } 

             else
              {
                  $j.alert({
                    // type: 'error',
                    
                   title: "Error",
                 content: '<center><h4 style="color:#016ac1;padding:2%;font-weight:bold;">'+msg+'</h4></center>',
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
// alert(w_id);
  // var id = <?php echo $this->uri->segment(3); ?>
  // alert(id);
   $.ajax({
         
          type: "POST",
          url: " <?php echo base_url()?>webinars/edit2/"+s_id+"/"+c_id+"/"+w_id, //<?php echo base_url('tasks/save_lecture/')?>",
          data: $("#tform").serialize(),
         //  beforeSend : function(msg){ <div id="overlay"><img  style="width: 35px; margin-left: 95px;height: 26px;" src="<?php echo base_url(); ?>public/images/loading.gif" /></div> },
          success: function(msg)
          {    console.log(msg);
            $('#loading').hide();
            $('#submit').removeClass('disabled');
           // alert(msg);
              if(msg == "success")
              {
                  $j.alert({
                    // type: 'error',
                    
                   title: "Success",
                 content: '<center><b><h4 style="color:#016ac1;padding:2%;font-weight:bold;">Webinar Updated Successfully! </h4></b></center>',
                  confirm: function()
                           {  
                              window.location ="<?php echo base_url(); ?>sections-manage/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(3); ?>";
                            }
                         });

              } 

             else
              {
                  $j.alert({
                    // type: 'error',
                    
                   title: "Error",
                 content: '<center><b><h4 style="color:#016ac1;padding:2%;font-weight:bold;">'+msg+' </h4></b></center>',
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
