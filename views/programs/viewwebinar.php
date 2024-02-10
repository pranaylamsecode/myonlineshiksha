<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/my_frontend.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/classic/css/green.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/classic/css/template.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/courses_css/onlineshiksha.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/css/font-icons/entypo/css/entypo.css" media="screen" />
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<?php
$session_data =  $this->session->userdata('logged_in');


// $url = $webinarinfo->wiziq_attendee_url;

// $url_field = explode(",",$url);



// foreach($url_field as $url_value)
//              {
//                $users_id = explode("^",$url_value);
//              $userid_array[] = $users_id;
//              }
//             // print_r($userid_array); echo count($userid_array)."<br>";
//             // print_r($session_data);
//             // exit("url");  
//      $perfect_url = NULL;       
// for($i=0;$i<count($userid_array);$i++)
//               {
//               //  print_r($userid_array[$i]);
//                 if(in_array($session_data['id'],$userid_array[$i]))
//                 {

//                   $perfect_url = $userid_array[$i][1];
//                 }              
                 
//               }
// //                echo "<br><br>";
// //  print_r($session_data);
// //                echo "<br><br>";
// // print_r($perfect_url); exit("me");


?>

  <!--   <section class="breadcrumb">
    <div class="container">
      <div class="row">
        <div class="">
          <h2>
            Webinar Schedule          
          </h2>
        </div>
      </div>
    </div>
  </section> -->


<style type="text/css">
.container {
    width: 100%;
}
.numbers {
    border-style: ridge;    /* options are none, dotted, dashed, solid, double, groove, ridge, inset, outset */
    border-width: 2px;
    border-color: #666666;  /* change the border color using the hexadecimal color codes for HTML */
    background: #222222;    /* change the background color using the hexadecimal color codes for HTML */
    padding: 2px 0px;
    width: 55px;
    text-align: center; 
    font-family: Arial; 
    font-size: 28px;
    font-weight: bold;   /* options are normal, bold, bolder, lighter */
    font-style: normal;  /* options are normal or italic */
    color: #FFFFFF;      /* change color using the hexadecimal color codes for HTML */
    }
.title {        /* the styles below will affect the title under the numbers, i.e., “Days”, “Hours”, etc. */
    border: none;    
    padding: 0px;
    width: 55px;
    text-align: center; 
    font-family: Arial; 
    font-size: 10px; 
    font-weight: normal; /* options are normal, bold, bolder, lighter */
    color: #000;      /* change color using the hexadecimal color codes for HTML */
    background: transparent;  /* change the background color using the hexadecimal color codes for HTML */
    }
#table {
    width: 400px;
    border: none;        /* options are none, dotted, dashed, solid, double, groove, ridge, inset, outset */
    }
   #headtop1 {
    margin-right: 4%;
}
#headtop2 {
    margin-left: 4%;
}
nav{
  padding-left: 2%;
  padding-right: 2%;
}
</style>

<section class="container courses">
<div class="row">

<div id="main" role="main">

<div class="holder" id="mrp-container2">    

<div class="course_row" style="padding: 0 20px;">

<?php

if(isset($addstudresponse)){//echo $addstudresponse; ?>

<div style="width:800px;height:600px">    

<?php echo $addstudresponse; ?>

</div>

<?php }else{

 

?>

<div class="">
<h2>Webinar Schedule  </h2>
                    
<h3 style="float:left;"><?php echo $webinarinfo->title;?></h3>

<a href="<?php echo base_url().'programs/programs/'.$progid;?>" style="float:right; margin-top:20px;" class="btn">Back to course</a>

</div>

<div style="clear:both;"></div>



<div class="teacher_info">

<?php
//print_r($webinarinfo);
$yourdate =  $webinarinfo->fromdate.' '.$webinarinfo->fromtime;
$gmdate = date("Y-m-d h:i A");
$url = base_url();
$duration = $webinarinfo->web_duration;
// echo $gmdate.'</br>';
// echo $yourdate; ?>
<?php if( $gmdate == $yourdate) {
  echo 'yes';
 ?>
 <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script>
  
    var duration = '<?php echo $duration; ?>';
    alert(duration);
    duration1 = duration * 1000;
    setTimeout(function(){ window.location.href = '<?php echo $url; ?>' }, duration1);
  
  </script>
<?php }
?>

<p><strong style="color: #55b00d;">Start from</strong> <?php echo $webinarinfo->fromdate;?> <strong style="color: #55b00d;">at</strong> <?php echo $webinarinfo->fromtime.' GMT';?>&nbsp;

<!-- <strong>To</strong> <?php echo $webinarinfo->todate;?> <strong>at</strong> <?php echo $webinarinfo->totime.' GMT';?></p> -->

</div>

<?php 
    
   $start_date = $webinarinfo->fromdate.' '.$webinarinfo->fromtime;
   // date_default_timezone_set("Asia/Kolkata");
  $current_date = date("Y-m-d H:iA");
 
} 
if(@$webrecording)
{ 
  $arr_url = explode(':', $webrecording);
  if($arr_url[0] == "http")
  {
         $webrecording = str_replace("http","https",$webrecording);
  }
  ?>

     <iframe src="<?php echo $webrecording; ?>" style="width:100%;height:700px" ></iframe>
<?php
}
else if($webinarinfo->created_by == $session_data['id'])
{ 
?>



</div>

</div>



<!-- <center>
<table id="table" border="0">
    <tr>
        <td align="center" colspan="6"><div class="numbers" id="count2" style="padding: 10px; "></div></td>
    </tr>
    <tr id="spacer1">
        <td align="center" ><div class="title" ></div></td>
        <td align="center" ><div class="numbers" id="dday"></div></td>
        <td align="center" ><div class="numbers" id="dhour"></div></td>
        <td align="center" ><div class="numbers" id="dmin"></div></td>
        <td align="center" ><div class="numbers" id="dsec"></div></td>
        <td align="center" ><div class="title" ></div></td>
    </tr>
    <tr id="spacer2">
        <td align="center" ><div class="title" ></div></td>
        <td align="center" ><div class="title" id="days">Days</div></td>
        <td align="center" ><div class="title" id="hours">Hours</div></td>
        <td align="center" ><div class="title" id="minutes">Minutes</div></td>
        <td align="center" ><div class="title" id="seconds">Seconds</div></td>
        <td align="center" ><div class="title" ></div></td>
    </tr>
</table>
</center> -->

<div class="iframe_div">
  <?php $https_url = $webinarinfo->wiziq_presenter_url;
  $arr_url = explode(':', $https_url);
  if($arr_url[0] == "http")
  {
         $https_url = str_replace("http","https",$https_url);
  }
   ?>
   <iframe src="<?php echo $https_url; ?>" style="width:100%;height:700px" ></iframe>
<!-- <iframe src="<?php echo $webinarinfo->wiziq_presenter_url; ?>" style="width:100%;height:700px" ></iframe> -->

<?php
}
else
{ 
 if($perfect_url)
 {
  $arr_url = explode(':', $perfect_url);
  if($arr_url[0] == "http")
  {
         $perfect_url = str_replace("http","https",$perfect_url);
  }
?>
<iframe src="<?php echo $perfect_url; ?>" style="width:100%;height:700px" ></iframe>
<?php
 }
 else{
   if($_SESSION['errormsg'])
   {
     echo "<center>".$_SESSION['errormsg']."</center>";
     
     //$this->session->unset_userdata('errormsg');
    // echo "<center>Buy this course to view Webinar</center>";
     }
 }
}
?>
</div>
</section>
<div style="text-align: center; margin-top: -37px;">

<img border="0" alt="" src="<?php echo base_url(); ?>/public/uploads/settings/img/logo/1264_12-29-2016.png" width="209px" height="80px">
</div>
<?php
   $date = explode('-',$webinarinfo->fromdate);
   
   $time = explode(':',$webinarinfo->fromtime); 
   
   $minutes = substr(@$time[1],0,2);
   $ampm = substr(@$time[1],-2); //AM/PM
   
   if($ampm == "PM")
   {
     $hours = $time[0]+12;
   }
   else
   {
     $hours = $time[0];
   }
  
?>


<div id="footer_wrapbot">
  <div id="footer"></div>
  
  <input type="hidden" value="" id="customer-chat-contact-name2">
  <input type="hidden" value="" id="customer-chat-contact-mail2">
</div>
<!-- <div id="lean_overlay_hp" style="display: none; opacity: 0;"></div> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="http://myonlineshiksha.createonlineacademy.com/public/Session_Plugin_master/jquery.session.js"></script> -->

    




<script type="text/javascript">

/*
Count down until any date script-
By JavaScript Kit (www.javascriptkit.com)
Over 200+ free scripts here!
Modified by Robert M. Kuhnhenn, D.O. 
on 5/30/2006 to count down to a specific date AND time,
and on 1/10/2010 to include time zone offset.
*/

/*  Change the items below to create your countdown target date and announcement once the target date and time are reached.  */
//var current="Webinar expired!";        //—>enter what you want the script to display when the target date and time are reached, limit to 20 characters
var year=<?php echo $date[0]; ?>;        //—>Enter the count down target date YEAR
var month=<?php echo $date[1]; ?>;          //—>Enter the count down target date MONTH
var day=<?php echo $date[2];  ?>;           //—>Enter the count down target date DAY
var hour=<?php echo $hours; ?>;          //—>Enter the count down target date HOUR (24 hour clock)
var minute=<?php echo $minutes; ?>;        //—>Enter the count down target date MINUTE
var tz=+5.50;           //—>Offset for your timezone in hours from UTC (see http://wwp.greenwichmeantime.com/index.htm to find the timezone offset for your location)

//—>    DO NOT CHANGE THE CODE BELOW!    <—
var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

function countdown(yr,m,d,hr,min){
theyear=yr;themonth=m;theday=d;thehour=hr;theminute=min;
var today=new Date();
var todayy=today.getYear();
if (todayy < 1000) {
todayy+=1900; }
var todaym=today.getMonth();
var todayd=today.getDate();
var todayh=today.getHours();
var todaymin=today.getMinutes();
var todaysec=today.getSeconds();
var todaystring1=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec;
var todaystring=Date.parse(todaystring1)+(tz*1000*60*60);
var futurestring1=(montharray[m-1]+" "+d+", "+yr+" "+hr+":"+min);
var futurestring=Date.parse(futurestring1)-(today.getTimezoneOffset()*(1000*60));
var dd=futurestring-todaystring;
var dday=Math.floor(dd/(60*60*1000*24)*1);
var dhour=Math.floor((dd%(60*60*1000*24))/(60*60*1000)*1);
var dmin=Math.floor(((dd%(60*60*1000*24))%(60*60*1000))/(60*1000)*1);
var dsec=Math.floor((((dd%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1);
if(dday<=0&&dhour<=0&&dmin<=0&&dsec<=0){
//document.getElementById('count2').innerHTML=current;
document.getElementById('count2').style.display="block";
document.getElementById('count2').style.width="390px";
document.getElementById('dday').style.display="none";
document.getElementById('dhour').style.display="none";
document.getElementById('dmin').style.display="none";
document.getElementById('dsec').style.display="none";
document.getElementById('days').style.display="none";
document.getElementById('hours').style.display="none";
document.getElementById('minutes').style.display="none";
document.getElementById('seconds').style.display="none";
document.getElementById('spacer1').style.display="none";
document.getElementById('spacer2').style.display="none";
return;
}
else {
document.getElementById('count2').style.display="none";
document.getElementById('dday').innerHTML=dday;
document.getElementById('dhour').innerHTML=dhour;
document.getElementById('dmin').innerHTML=dmin;
document.getElementById('dsec').innerHTML=dsec;
setTimeout("countdown(theyear,themonth,theday,thehour,theminute)",1000);
}
}

countdown(year,month,day,hour,minute);

</script>

<?php //include 'application/views/template/classic/footer.php';?>





