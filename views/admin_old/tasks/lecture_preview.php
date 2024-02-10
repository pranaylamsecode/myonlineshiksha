<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>public/Session_Plugin_master/jquery.session.js"></script>

<script src="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="<?php echo base_url(); ?>public/js/bxslider/dist/jquery.bxslider.css" rel="stylesheet" />

<script>
var $ =jQuery.noConflict();
var obj = JSON.parse($.session.get('preview1')) 

$(document).ready(function()
               {
    $(".bx-controls").last().remove();
});
</script>

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
 $j(document).ready(function()
               {
                 $j('.bxslider1').bxSlider({                 
                  auto: true,
                  autoControls: true
                });
                 $j('.bxslider12').bxSlider();
               });
</script>
<style type="text/css">

a#go-back {
    margin-top: 24px !important;
}
.prev-lecture {
    top: 24px !important;
  }
.text-topaz{
  width: 30%;      
}
.main_head{
  width: 33%;
  margin: 9px auto;
}
.pre_head {
    width: 100%;
    color: white;
    margin: 0px auto;
    text-align: center;
}
.close_btn {
    float: right;
    margin-top: -38px;
    background: #4CAF50;
    width: 11%;
    padding: 5px 6px 5px 3px;
}
.close_btn a {
    color: white !important;
}
.close_btn a {
    color: #555555;
}
#course-taking-page{
  margin: 0 auto !important
}
.asset-container{
  bottom: 25px !important;
  background: #fff !important;
  top: 68px !important;
}
#course-taking-page .main {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 10% !important; 
    width: 80%;
    right: 50% !important;
    z-index: 1;
    margin: 0 auto;
}
.mock{
  display: none!important;
}
select[name='Alignment'] { 
    display: none;
}
.asset-container p{
	color: #555555;
}
.lyrow {
    margin-bottom: 10px;
    height: auto !important;
}
.box, .lyrow {
    position: relative;
}

 .drag,  .configuration,  .remove,  .clone {
    display: none !important;
}

.preview {
    display: none;
}
 .box,  .row {
    padding-top: 0;
    background: none;
}
.sourcepreview .column, .sourcepreview .row, .sourcepreview .box {
    margin: 0px 0;
    padding: 0px;
    background: none;
    border: none;
    -webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.00);
    -moz-box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.00);
    box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0.00);
}
.btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before, .btn-toolbar:after, .btn-toolbar:before, .clearfix:after, .clearfix:before, .container-fluid:after, .container-fluid:before, .container:after, .container:before, .dl-horizontal dd:after, .dl-horizontal dd:before, .form-horizontal .form-group:after, .form-horizontal .form-group:before, .modal-footer:after, .modal-footer:before, .nav:after, .nav:before, .navbar-collapse:after, .navbar-collapse:before, .navbar-header:after, .navbar-header:before, .navbar:after, .navbar:before, .pager:after, .pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before {
    display: table;
    content: " ";
}
 .column {
    padding-top: 19px;
    padding-bottom: 19px;
}
.preview {
    display: none;
}
.box .view {
    display: block;
    padding-top: 30px;
}



.lyrow.ui-draggable .view .row .col-md-12 .box-element .view iframe.img-responsive{
	height: 480px;
}







.delspan {
  position: absolute;
  bottom: 0;
  left: 60px;
}

.btn-orange {
  color: #ffffff;
  background-color: #ff9600;
  border-color: #ff9600;
}
.btn-orange:hover, .btn-orange:focus, .btn-orange:active, .btn-orange.active, .open .dropdown-toggle.btn-orange {
  color: #ffffff;
  background-color: #d67e00;
  border-color: #c27200;
}

.w130 {
  line-height: 1.5;
}

#course-taking-page .main:before{
	content:'';
	width:5px;
	height:100%;
	position:fixed;
	left: 179px;
	background:url("<?php echo base_url(); ?>/public/default/images/timeline-bar.png");
}	

.custom-bdcrumb {
  font-size: 14px;
  position: absolute;
  left: 200px;
  right: auto;
  top: 14px;
  text-align: left;
}
/*.custom-bdcrumb{
  font-size: 20px;
  position: absolute;
  left: 100px;
  right: 0;
  top: 10px;
  text-align: center;
}*/

.custom-bdcrumb{
	color: #84848C !important;
}

.custom-bdcrumb span{
	color: #84848C !important;
	  font-weight: 700;
	  padding-left: 5px;
}



</style>
<?php
		//$layoutid = "<script>document.write(obj['layoutno']);</script>";
		// echo $layoutid."ok";
  //        exit('yes');
 ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/assets/css/font-icons/entypo/css/entypo.css" media="screen">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
<script type="text/javascript">
	
// window.onload = function() {
//     if(!window.location.hash) {
//     	//alert('yes');
//         window.location = window.location + '#loaded';
//         window.location.reload();
//     }
// }
</script>>
<style type="text/css">
.delspan {
  position: absolute;
  bottom: 0;
  left: 60px;
}

.btn-orange {
  color: #ffffff;
  background-color: #ff9600;
  border-color: #ff9600;
}
.btn-orange:hover, .btn-orange:focus, .btn-orange:active, .btn-orange.active, .open .dropdown-toggle.btn-orange {
  color: #ffffff;
  background-color: #d67e00;
  border-color: #c27200;
}

.w130 {
  line-height: 1.5;
}

#course-taking-page .main:before{
	content:'';
	width:5px;
	height:100%;
	position:fixed;
	left: 179px;
	background:url("<?php echo base_url(); ?>/public/default/images/timeline-bar.png");
}	

.custom-bdcrumb {
  font-size: 14px;
  position: absolute;
  left: 200px;
  right: auto;
  top: 14px;
  text-align: left;
}
/*.custom-bdcrumb{
  font-size: 20px;
  position: absolute;
  left: 100px;
  right: 0;
  top: 10px;
  text-align: center;
}*/

.custom-bdcrumb{
	color: #84848C !important;
}

.custom-bdcrumb span{
	color: #84848C !important;
	  font-weight: 700;
	  padding-left: 5px;
}

#media_1, #media_2, #media_3,
#media_4, #media_5, #media_6,
#media_7, #media_8, #media_9,
#media_10, #media_11, #media_12, #media_13 {
padding-top: 20px;
padding-left: 20px;
padding-right: 20px;
}



.asset-container .content11, 
.asset-container #text_1 #movieframe1 p, 
.asset-container #text_5 #movieframe5 p, 
.asset-container #text_6 #movieframe6 p, 
.asset-container #text_8 #movieframe8 p{
padding: 20px !important;	
}

.asset-container .ud-lectureangular #media_2 {
  padding: 20px !important;
}

#media_1 #movieframe1 iframe, #media_2 #movieframe1 iframe, 
#media_4 #movieframe1 iframe, #media_5 #movieframe1 iframe, #media_6 #movieframe1 iframe,
#media_7 #movieframe1 iframe, #media_8 #movieframe1 iframe, #media_9 #movieframe1 iframe {
height: 325px !important;
}
/*new added*/

#media_9 #movieframe9
{
	width: 50%;
  float: right;
  padding-top: 20px;
}

#media_12 {
  float: left;
  width: 50%;
}

#media_13 #movieframe13{
	height: 325px;
}

#media_8 #movieframe1 #mediaspace1_wrapper
{
	 width: 100% !important;
}

/*css for layout 2 start*/
		#media_3 #movieframe1 #mediaspace1_wrapper
		{
			 width: 100% !important;
			 height: 325px !important; 
		}

		#media_2 #movieframe2 #mediaspace2_wrapper
		{
			 width: 100% !important;
			 height: 325px !important; 
		}

		#media_2 #movieframe2 iframe
		 {
		  width: 100% !important;
		  float: left;
		  z-index: 4 !important;
		  /*height: 400px;*/
		 }
		 #media_3 #movieframe1 iframe
		 {
		 	width: 100%;
		 }


/*css for layout 2 end */
/*css for layout 8 start*/

#media_9 #movieframe9 #mediaspace9_wrapper
{
	 width: 100% !important;
	 height: 325px !important; 
}

#media_9 #movieframe1 iframe
{
	 width: 100% !important;
} 

#media_8 #movieframe8 iframe
{
	 width: 100% !important;
}
#media_9 #movieframe9 iframe
{
	 width: 100% !important;
}
/*css for layout 8 end */
#media_5 #movieframe5 #mediaspace5_wrapper
{
	 width: 100% !important;
	 height: 325px !important; 
}
#media_6 #movieframe6 #mediaspace6_wrapper
{
	 width: 100% !important;
	 height: 325px !important; 
}



#media_8 #movieframe8 #mediaspace8_wrapper
{
	 width: 100%;
  	float: left;
  	height: 50%;
}

#media_8  {
  float: right;
  width: 50%;
  padding-left: 1px !important;
}

 .asset-container #media_5 #mediaspace5_wrapper, .asset-container #media_12 #mediaspace12_wrapper{
 	padding-left: 0 !important;
 }
 

 #media_2 #movieframe1 iframe
 {
 	width: 50% !important;
    float: left;
    z-index:1 !important;
 }
/*new added end*/
.my_main{
  padding-right: 50px;
}

@media (max-width: 1024px){
#course-taking-page.wrapper .main ul#timeline>li .prev-lecture {
display: none;
}

.asset-container .ud-lectureangular .texteditor_layoout {
  padding: 0px 20px !important;
}

#media_1, #media_2, #media_3,
#media_4, #media_5, #media_6,
#media_7, #media_8, #media_9,
#media_10, #media_11, #media_12 , #media_13 {
  padding-top: 20px !important;
  padding-left: 20px !important;
  padding-right: 20px !important;
  float: none !important;
  width: 100% !important;
}

#media_1 #movieframe1 iframe, #media_2 #movieframe1 iframe, #media_4 #movieframe1 iframe, #media_5 #movieframe1 iframe, #media_6 #movieframe1 iframe, #media_7 #movieframe1 iframe, #media_8 #movieframe1 iframe, #media_9 #movieframe1 iframe {
  height: auto !important;
  width: 100% !important;
}

 #media_2 #movieframe1 iframe
 {
 	width: 100% !important;
    float: none;
    z-index:1 !important;
 }

 #media_8  {
  float: none;
  width: 100%;
  padding-left: 1px !important;
}

#media_8 #movieframe8 #mediaspace8_wrapper
{
	 width: 100%;
  	float: none;
  	height: auto;
}

#media_9 #movieframe9
{
	width: 100%;
  float: none;
  padding-top: 20px;
}

.asset-container #text_1, .asset-container #text_2, .asset-container #text_3,
.asset-container #text_4, .asset-container #text_5, .asset-container #text_6,
.asset-container #text_7, .asset-container #text_8, .asset-container #text_9 {
  float: none !important;
  width: 100% !important;
}

#course-taking-page.wrapper .main ul#timeline>li .prev-lecture {
  left: 20% !important;
  margin-left: 0 !important;
}


#media_9 #movieframe9 #mediaspace9_wrapper
{
	 width: 100% !important;
	 height: auto !important; 
}

#media_9 #movieframe1 iframe
{
	 width: 100% !important;
} 

#media_8 #movieframe8 iframe
{
	 width: 100% !important;
}
#media_9 #movieframe9 iframe
{
	 width: 100% !important;
}
/*css for layout 8 end */
#media_5 #movieframe5 #mediaspace5_wrapper
{
	 width: 100% !important;
	 height: auto !important; 
}
#media_6 #movieframe6 #mediaspace6_wrapper
{
	 width: 100% !important;
	 height: auto !important; 
}


.asset-container #media_5 #mediaspace5_wrapper, .asset-container #media_12 #mediaspace12_wrapper {
  float: none !important;
  padding-left: 0px !important;
}

.asset-container #media_6 #mediaspace6_wrapper, .asset-container #media_13 #mediaspace13_wrapper{
	  float: none !important;
  padding-right: 0px !important;
}

}

</style>


<?php
$remainAttempts=0;
function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;
    if( $estimate_time < 1 )
    {
        return 'Just Now';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;
        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<!--<html lang="en-gb" dir="ltr" xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" slick-uniqueid="3">-->

<head>
<title></title>
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-core.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/modal.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/mootools-more.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/programs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/default/js/jquery-1.7.1.min.js"></script>
<!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/default/css/style.css" />-->
<link rel="stylesheet" href="<?php echo base_url();?>/public/default/css/lecture_dashboard.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/default/css/my_lecture_style.css">

<div id="course-taking-page" class="ud-dashboard wrapper">
<div class="main"> <a id="go-back" href="<?php echo base_url(); ?>" class="pos-r zi1 ml15 mt15 dif text-topaz fs12 bold ml0-md"> <i class="icon-chevron-sign-left fs16 mr5"></i> <span class="fs10-md w130 ellipsis-2lines">Back to Course</span> </a>
  <span id="Course_Name" class="custom-bdcrumb">
   
    </span>

  <ul id="timeline" style="transform: translateY(-100%);">
    <li class="chapter"> <span class="percent chapter-number"> <span>Section</span> 1 </span>
      <div class="note"> </div>
      <div class="bottom"> <a href="" class="next-lecture continue">Continue</a> </div>
    </li>
    <li class="on" data-lectureid="2335868">
		<div class="prev-lecture" id="prev-lecture" style="display:block">
	       
	<a href="javascript:void(0)"><i class="icon-chevron-up"></i></a><span style="cursor:pointer">Previous Lecture</span>
				
		</div>
   <div class="main_head"> 
       <div class="pre_head"> <b style="font-size: 16px;color: seashell;">Preview Mode </b><div> This is how your lecture will be displayed to students</div></div>  
   </div>
    <div class="close_btn" style=""> <a href="#"><i class="entypo-cancel"></i> Close Preview </a></div>
		<span class="view-supplementary fs10-force-md mt0-force-md dn-force-xs dn-md none"> View resources </span>
		<div class="asset-container scrollbar">
		

		<script>document.write(obj['contentLecture']);</script>
        <?php
        
        

        $layoutid = 0; 

		if($layoutid=='1')
		{
			?>
			<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
			<div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>
			
			<div id="media_1"> 
            <script>document.write(obj['media1']);</script>
			</div>
			<div id="text_1" class="content11"><p>
			 <script>document.write(obj['txt_area']);</script>
					</p>
        	</div>
        	<div class="texteditor_layoout">
				 <script>document.write(obj['txt_data']);</script>
			</div>
          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>
        <?php
		exit();}
		elseif($layoutid=='2')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
			<div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div >


		  <div id="media_2" style="width: 50%;float: left;">
           <script>document.write(obj['media1']);</script>
          </div>
          <div id="text_2" class="content11">
           <script>document.write(obj['txt_area']);</script>
          </div>
          <div id="media_3" style="float: width: 50%;float: left;;">
            <div style="text-align:center"><i></i></div>
            <script>document.write(obj['media2']);</script>
          </div>
          <div class="texteditor_layoout">
				<script>document.write(obj['txt_data']);</script>
			</div>

          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>


        </div>
        <?php 
		}
		elseif($layoutid=='3') 
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
          <div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>


		  <div id="media_3">
            <div style="text-align:center"><i></i></div>
            <script>document.write(obj['media1']);</script>
          </div>
          <div id="text_3" class="content11">
            <script>document.write(obj['txt_area']);</script>
          </div>
          <div class="texteditor_layoout">
				 <script>document.write(obj['txt_data']);</script>	
			</div>

          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>


        </div>

        <?php 
		}
		elseif($layoutid=='4')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
          <div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>


		  <div id="media_5" style="width: 50%;float: left;">
           <script>document.write(obj['media1']);</script>
          </div>
          <div id="media_6" style="width: 50%;float: left;">
           <script>document.write(obj['media2']);</script>
          </div>
          <div id="text_4" class="content11" style='float: inherit;'>
            <script>document.write(obj['txt_area']);</script>
          </div>

          	<div class="texteditor_layoout">
				<script>document.write(obj['txt_data']);</script>
			</div>
          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>
        <?php 
		}
		elseif($layoutid=='5')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
			<div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>


		 <div id="text_5" class="content11">
            <script>document.write(obj['txt_area']);</script>
          </div>
          <div class="texteditor_layoout">
			<script>document.write(obj['txt_data']);</script>
		</div>

          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>

        
        <?php 
		} 
		elseif($layoutid=='6')
		{
			?>
			<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
				<div id="overlay">
					<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" />					 -->
				</div>
				
				<div id="media_7" style="position: relative;height: 360px;">
				<script>document.write(obj['media1']);</script>
				</div>
				<div class="texteditor_layoout">
				<script>document.write(obj['txt_data']);</script>
			</div>

				<table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
					<tbody>
					<!-- <tr>
						<td>
							<?php if(isset($jump_but1)){?>
							<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
							<?php }?>
						</td>
						<td>
							<?php if(isset($jump_but2)){?>
							<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
							<?php }?>
						</td>
						<td>
							<?php if(isset($jump_but3)){?>
							<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
							<?php }?>
						</td>
						<td>
							<?php if(isset($jump_but4)){?>
							<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
							<?php }?>
						</td>
					</tr> -->
				</tbody></table>
			</div>
			<?php 
		}
		elseif($layoutid=='7')
		{ 
			?>
        	<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
          	<div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>

		  <div id="text_6" class="content11">
           <script>document.write(obj['txt_area']);</script>
          </div>
          <div style="float: left !important;width: 50%;" id="media_8">            
          <script>document.write(obj['media1']);</script>
            
          </div>
          <div class="texteditor_layoout">
			<script>document.write(obj['txt_data']);</script>	
		  </div>

          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>
        <?php 
		} 
		elseif($layoutid=='8')
		{ 
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
			<div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>
			
		  <div id="text_7" class="content11">
             <script>document.write(obj['txt_area']);</script>
           
          </div>
          <div id="media_8">
             <script>document.write(obj['media1']);</script>
          </div>
          <div id="media_9">
            <script>document.write(obj['media2']);</script>
          </div>
          <div class="texteditor_layoout">
				 <script>document.write(obj['txt_data']);</script>
		  </div>

          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>
        <?php 
		} 
		elseif($layoutid=='9')
		{ 
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
          
		  <div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>
			
		  <div id="text_8" class="content11">
            <script>document.write(obj['txt_area']);</script>
          </div>
          <div id="media_11">
             <script>document.write(obj['media1']);</script>
          </div>

          	<div class="texteditor_layoout">
				 <script>document.write(obj['txt_data']);</script>	
			</div>
          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>
        <?php 
		}
		elseif($layoutid=='10')
		{
			?>
        	<div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
			<div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>

		 
		 <div id="text_9" class="content11">
            <script>document.write(obj['txt_area']);</script>
          </div>
          <div id="media_12">
             <script>document.write(obj['media1']);</script>
          </div>
          <div id="media_13" style="width: 50%;float: left;">
             <script>document.write(obj['media2']);</script>
          </div>
          <div class="texteditor_layoout">
			 <script>document.write(obj['txt_data']);</script>	
			</div>

          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>
        <?php 
		} 
		elseif($layoutid=='11')
		{
			?>
        <div class="ud-lectureangular scrollbar" style="color:#fff;" id="style-5">
			<div id="overlay">
				<!-- <img src="<?php echo base_url('public/images/loading.gif'); ?>" alt="Loading" /> -->
					
			</div>

          <div id="text_10" class="content11">
            <script>document.write(obj['txt_area']);</script>
           
          </div>
          <div id="media_14">
            <div style="text-align:center"><i></i></div>
           <script>document.write(obj['media1']);</script>
          </div>
          <div id="text_11" class="content11"> 
           <script>document.write(obj['txt_data1']);</script>
          </div>


          <table cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 320px;">
									<tbody>
									<!-- <tr>
										<td>
											<?php if(isset($jump_but1)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but1->module_id.'/'.$jump_but1->jump_step;?>'" value="<?php echo $jump_but1->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but2)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but2->module_id.'/'.$jump_but2->jump_step;?>'" value="<?php echo $jump_but2->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but3)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but3->module_id.'/'.$jump_but3->jump_step;?>'" value="<?php echo $jump_but3->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
										<td>
											<?php if(isset($jump_but4)){?>
											<input type="button" onclick="document.location.href='<?php echo base_url();?>lessons/lesson/<?php echo $program_id.'/'.$jump_but4->module_id.'/'.$jump_but4->jump_step;?>'" value="<?php echo $jump_but4->text;?>" name="JumpButton" class="">
											<?php }?>
										</td>
									</tr> -->
								</tbody></table>
        </div>
        <?php 
		} 
		?>

      	<!--Jump Buttons-->


      	
<!-- --------------------------------------------------Main-cont-panel-end---------------------------------------------------------------- --> 

<!-- --------------------------------------------------Sidebar-code---------------------------------------------------------------- -->


