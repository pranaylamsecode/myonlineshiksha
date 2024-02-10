   
<?php

 /* echo '<pre>';
	print_r($teacher_info);
  echo '</pre>'; */
?>
<style>

.btn-primary_red:hover {
  background-color: #002157;
}

.btn-primary_red {
  background-color: #016ac1;
}

.btn-primary_red {
  /* float: left; */
  color: #fff;
  padding: 5px 10px 5px 10px;
  font-size: 14px;
  font-family: 'Open Sans', sans-serif;
  font-weight: 600;
  line-height: 31px;
  margin: 10px auto;
  display: block;
  height: 40px;
  border: 0;
  border-radius: 4px;
  text-align: center;
  text-transform: uppercase;
  text-shadow: none;
}

button:hover, button:focus, #form-login div.button1 a:focus {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

.fancybox-wrap {
  width: 475px !important;
  height: auto !important;
  position: absolute !important;
  top: 25% !important;
  left: 0px !important;
  opacity: 1 !important;
  margin: 0 auto;
  right: 0 !important;
  overflow: visible !important;
  z-index: 8020;
}

body {
font-family: 'Open Sans', sans-serif;
color: #555555;
font-weight: 400;
font-size: 14px;
line-height: 20px;
}
label
{
margin-bottom:0 !important;
padding: 10px !important;
width:20%;
}
.span2 .tech_img
{
border-radius:10px;
margin-left:0%;
}
@media (max-width: 1280px) 
{
.span2 .tech_img
{
border-radius:10px;
margin-left:0% !important;
}		
}
@media (max-width: 980px) 
{
label
{
margin-bottom:0 !important;
padding: 10px !important;
width:auto !important;
}
.span2 .tech_img
{
border-radius:10px;
margin-left:0% !important;
}	
}
.btn {
display: inline-block;
padding: 4px 12px;
margin: 4px 0;
font-size: 14px;
line-height: 20px;
color: #333333;
text-align: center;
text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
vertical-align: middle;
cursor: pointer;
background-color: #f5f5f5;
background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
background-repeat: repeat-x;
border: 1px solid #cccccc;
border-color: #e6e6e6 #e6e6e6 #bfbfbf;
border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
border-bottom-color: #b3b3b3;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.tform textarea {
width: 400px;
height: 120px;
padding: 4px;
font-size: 12px;
font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
}

textarea {
-webkit-appearance: textarea;
overflow: auto;
-webkit-rtl-ordering: logical;
-webkit-user-select: text;
flex-direction: column;
resize: auto;
cursor: auto;
white-space: pre-wrap;
word-wrap: break-word;
letter-spacing: normal;
word-spacing: normal;
text-transform: none;
text-indent: 0px;
text-shadow: none;
text-align: start;
}

textarea {
font-family: inherit;
}

textarea {
background-color: #ffffff;
border: 1px solid #c7c8b2;
}
hr {
margin: 20px 0;
border: 0;
  border-top: 1px solid #D4D3D3;
  border-bottom: 1px solid #ffffff;
}
</style>

<div class="page-container">
<div style="background-color: #F5F5F5; display:-webkit-box; height:100%;">
<!--<div class="sidebar-menu sb-left">-->
<!-- Your left Slidebar content. -->
<!-- Classes Examples -->
	<!--<ul id="main-menu" class="">
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myaccount">My account</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycourses">My courses</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myorder">My Orders</a></li> 
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/myquizandfexam">My Quizzes/Final Exams</a></li>
		<li class="root-level"><a href="<?php echo base_url(); ?>myinfo/mycertificates">My Certificates</a></li>
	</ul>
</div>-->


<div class="main-content">
	<div class="row">
    <div class="holder" id="mrp-container2">
<div id="system-message-container">
</div>
<?php
   
$attributes = array('class' => 'tform', 'id' => '');
echo form_open_multipart('tasks/inform_students', $attributes);/*echo '<pre>';print_r($user);echo '</pre>';*/
?>
<div class="content">
	
<div class="sidebar-collapse sb-toggle-left">
	<a href="#" class="sidebar-collapse-icon with-animation">
		<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
		<i class="entypo-menu"></i>
	</a>
</div>


 


<div class="table-scroll-resp" style="overflow-x:auto;">
	<div style="padding:0 20px;">
		<div class="admintable">
            <h2 style="color: #c42140; ">Send Message</h2>


            <hr />
           <!-- <div class="span2">
		<img src="<?php echo base_url();?>public/uploads/users/img/thumbs/<?php echo (isset($teacher_info->images)) ? $teacher_info->images : 'temp.jpg'; ?>" width="150" id="imgname" class="tech_img">			   
			</div>
            
            <div class="span10">
			<p style="font-weight:600;"><?php echo $teacher_info->first_name.' '.$teacher_info->last_name; ?></p>
			<div>
            	<span style="color: #c42140;">Designation:</span>
            	<?php echo $teacher_info->designation; ?>
            </div>
                <input type="hidden" name="teacher_id" value="<?php echo $teacher_info->id; ?>" />
				<input type="hidden" name="teacher_email" value="<?php echo $teacher_info->email; ?>" />
				<input type="hidden" name="your_name" value='<?php echo $name; ?>' />
				<input type="hidden" name="program_id" value='<?php echo $program_id; ?>' />
               
                
                
        </div><p style="color: #c42140;">Professional Details:</p>
				
					<?php echo $teacher_info->prof_info; ?>
        <hr />-->
		
		
		
        <table width="90%">
        	<tr>
            	<td><span style="color: #c42140;"> Write and send your message to all registerd Students.</span></td>
            </tr>

            <tr>
            	<td><br></td>
            </tr>
            <tr>
            	<td><br></td>
            </tr>
            
            <tr>
            	<td><textarea  name="inform_message" id="inform_message" class="tform" required></textarea></td>
            </tr>
            
            <tr>
                <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>" />
                <input type="hidden" name="sec_id" value='<?php echo $sec_id; ?>' />
                <input type="hidden" name="lec_id" value='<?php echo $lec_id; ?>' />
                <td align="center"><input type="submit" name ="btnsubmit" class="btn-primary_red"  value="Send Message" /></td>
            </tr>
            
            <tr>
           
            	<td><span id="msgsuccess" style="color: #c42140; "> </span></td>
            </tr>
        </table>
	     	
            

        <div style="clear:both;"></div>
        </div>
		
        
	</div>
    </div>
</div>

<?php 
echo form_close(); ?>
    </div>
</div>

</div>

<script type="text/javascript">
function sendmsg(pro_id, sec_id, lec_id)//for add to favorites
    {
      
	jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>tasks/inform_students",
			data: {pro_id:pro_id,sec_id:sec_id,lec_id:lec_id}, 
			success: function(msg)
			{
				alert(data);
				jQuery("#msgsuccess").html('Email Successfully Send');
				
			}
		  }); 
 	}
</script>





 
 

