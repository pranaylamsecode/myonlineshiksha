 <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
 <link rel="stylesheet" href="<?php echo base_url("assets/css/font-icons/entypo/css/entypo.css"); ?>" id="style-resource-2">
 <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>" id="script-resource-3"></script> 
 <link href='//fonts.googleapis.com/css?family=Leckerli One' rel='stylesheet'>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script>$.noConflict();</script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/public/css/courses_css/courses_form.css">
<?php $this->load->view('admin/progressbar/academyrenewal'); ?>

<style type="text/css">
.main_container	{
    background: url(<?php echo base_url();?>public/css/image/academy_expired.jpg) 0 no-repeat;
    height: 100%;
    width: 100%;
    background-color: #2676B5;
    background-size: cover;
}
/*body{
	color: white;
	font-family: 'Leckerli One';
	font-size: 30px !important;
}*/
.inner_block {
    background: rgba(240, 248, 255, 0.32);
    margin: 15% 0 0 0;
    height: 436px;
}
.head_font{
	 padding-top: 28px;
	font-size: 63px;
	text-align: center;
	color: white;
	font-family: 'Leckerli One';
}
.block_text{
	    margin: 68px 30px 0 30px;
}
.block_text p{
	font-family: 'Leckerli One';
	font-size: 22px;
	text-align: justify;
	color: white;
}
.block_btn {
    margin: 68px 19px 0 3px;
}
.block_btn a{
	font-family: 'Leckerli One';
    font-size: 15px;
}
#renewalpopup .modal-content{
    border-radius: 6px!important;
    height: 230px;
}
#accountoption .modal-content{
    border-radius: 6px!important;
    height: 86%;
}
</style> 
<?php
$CI =& get_instance();
$CI->load->model('admin/settings_model');
$auth = $this->session->userdata('logged_in');
//print_r($auth);
?>
<body>
	<div class="main_container">
	    <div class="container">
	    	<div class="col-sm-2">
			</div>
			<div class="col-sm-8">
				<div class="inner_block">
					<div class="block_contents">

						<div>
							<h2 class="head_font"><b>Ooops!</b></h2>
						</div>
						<?php if($auth['groupid'] != 4){ ?>
						<div class="block_text">
							<p>Your academy has been expired.</p>
							<p>To continue you have to contact with site Administrator</p>
						</div>
						<div class="block_btn col-sm-12">
							<div class="col-sm-6">
								<a class="btn btn-orange" style="padding: 10px 22px 12px 19px;">Contact</a>
							</div>
						</div>
						<?php } else{ ?>
						<div class="block_text">
							<p>Your academy has been expired.</p>
							<p>To continue you have to subscribe to subscription plan by paying the respective subscription plan price.</p>
						</div>

						<div class="block_btn col-sm-12">
							<div class="col-sm-6">
								<a class="btn btn-success" onclick="openRenewalPopup1('#renewalpopup'); " style="padding: 10px 51px 12px 34px;"><i class="entypo entypo-retweet"></i>Renew</a>
							</div>
							<div class="col-sm-6">
								<a class="btn btn-orange" onclick="openRenewalPopup1('#accountoption');" style="float: right;padding: 10px 22px 12px 19px;"><i class="entypo entypo-list"></i>Account Options</a>
							</div>
						</div>
					<?php }?>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
			</div>
		</div>
	</div>
</body>



<script type="text/javascript">

function openRenewalPopup1(element)
 {          
     //alert(element)  
      if(element =='#renewalpopup')
       {     
       	//alert('yes');
             jQuery('.modal-backdrop').css('display','none');
             jQuery('#accountoption').css('display','none');
             

             jQuery('#renewalpopup').modal("show");
             jQuery('.modal-backdrop').last().css('display','block');
             jQuery('#renewalpopup.modal').css('display','block');
       }
       else if(element =='#accountoption')
       {     
             jQuery('.modal-backdrop').css('display','none');
             jQuery('#renewalpopup').css('display','none');             


             jQuery('#accountoption').modal("show");
             jQuery('.modal-backdrop').last().css('display','block');
             jQuery('#accountoption.modal').css('display','block');
       }
       
           
     
 }

</script>