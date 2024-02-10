<?php
$user = $this->user;

$CI =& get_instance();
$CI->load->model('admin/settings_model');
$data_Item = $this->settings_model->getItems();

  $blocked = $data_Item[0]['is_block'];

  if($blocked == '1')
  {
  	//echo 'Website has been Blocked';
  	//exit();
  		redirect('admin/users/blocked');
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">  
<head>  	
<title><? echo $template['title'];?></title>	
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<meta http-equiv='expires' content='1200' />	
	<meta http-equiv='content-language' content='<?php echo $this->config->item('prefix_language') ?>' />	
	<!--<base href="<?php //echo $this->config->item('base_url') ?>/public/" />	
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />	
	<link rel="stylesheet" href="css/fstyles.css?<?php //echo time();?>" type="text/css" media="screen" />	
	<link rel="stylesheet" href="css/style.css?<?php //echo time();?>" type="text/css" media="screen" />-->		
	
	<!--<link rel="stylesheet" href="http://demo.neontheme.com/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css" id="style-resource-1">-->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/font-icons/entypo/css/entypo.css"); ?>" id="style-resource-2">	
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" id="style-resource-3">	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-min.css"); ?>" id="style-resource-4">	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/neon-core-min.css"); ?>" id="style-resource-5">	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/neon-theme-min.css"); ?>" id="style-resource-6">	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/neon-forms-min.css"); ?>" id="style-resource-7">	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/custom-min.css"); ?>" id="style-resource-8">	
								
	<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>	
	<script>$.noConflict();</script>
	<style type="text/css">
	body.page-body{
			background: url('<?php echo base_url();?>public/images/coa_bg.png');
		 	background-size: cover;
		  	background-position:center; 
		  	background-attachment: fixed;
		  	    background-color: #045477;
		}
		.login-out-content {
		  position: relative;
		  margin: 0 auto;
		  border-radius: 10px;
		  padding: 30px;
		  text-align: center;
		  padding: 20px 0;
		  -moz-transition: all 550ms ease-in-out;
		  -o-transition: all 550ms ease-in-out;
		  -webkit-transition: all 550ms ease-in-out;
		  transition: all 550ms ease-in-out;
}
.login-content a {
  color: #fff !important;
}
.login-content a:hover {
    text-decoration: underline;
}
.login-bottom-links {
  color: #fff !important;
}
.login-bottom-links a{
  color: #fff !important;
}
.login-bottom-links a:hover{
  color: #858688 !important;
}
.wodemos2 {
  background: #0099e3;
  border-color: #0099e3;
  color: #FFFFFF !important;
  border: 2px solid #0099e3;
  border-radius: 5px;
  height: 40px;
  width: 222px;
  padding: 15px 20px 15px 20px;
  font-size: 14px;
  -webkit-box-shadow: 0 20px 0 0 rgba(255, 255, 255, .12) inset;
  box-shadow: 0 20px 0 0 rgba(255, 255, 255, .12) inset;
  -webkit-transition: all .3s ease;
  -moz-transition: all .3s ease;
  -ms-transition: all .3s ease;
  -o-transition: all .3s ease;
  transition: all .3s ease;
  -webkit-backface-visibility: hidden;
}
.wodemos2:hover {
  -webkit-box-shadow: 0 40px 0 0 rgba(255, 255, 255, .12) inset;
  box-shadow: 0 40px 0 0 rgba(255, 255, 255, .12) inset;
  text-decoration: none;
  color: #FFFFFF !important;
}
.error{
color: red !important;
	}
	.input-group-addon {
  padding: 6px 12px;
  font-size: 12px;
  font-weight: normal;
  line-height: 1;
  color: #555;
  text-align: center;
  background-color: #2584C5 !important;
  border: 1px solid #ebebeb;
  border-radius: 3px;
  color: #ebebeb !important;
}
	</style>	

</head>
<?


?>
<body class="page-body login-form-fall loaded login-form-fall-init">		
<div class="login-container">	
	<div class="login-header login-caret">		
		<div class="login-out-content">			
			<a href="index.html" class="logo">
				 <img width="210" src="<?php echo base_url();?>public/uploads/settings/img/logo/<?php echo $data_Item[0]['logoimage'];?>" alt="">
			</a>
			
			<div class="login-content">					
				<?php $this->load->view("admin/partials/_flashdata");?>
				<?php echo $template['body']; ?>			
			</div>

		</div>		
	</div>
	<?php 
	$CI =& get_instance();
	$CI->load->model('admin/settings_model');
$configarr = $this->settings_model->getItems();
	$institute_name = $configarr[0]['institute_name'];
?>
	<div class="login-bottom-links trademark" style="font-weight: normal">© <?php echo date("Y").' '.$institute_name.',  Powered by ';?>
		<a target="_top" href="http://createonlineacademy.com/" id="link-forgot-passwd">
    	 <span>CreateOnlineAcademy™</span>
        </a>
	</div>
	<div class="login-progressbar">
		<div></div>
	</div>
	

</div>	

<script src="<?php echo base_url("assets/js/gsap/main-gsap.js"); ?>" id="script-resource-1"></script>	
<script src="<?php echo base_url("assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"); ?>" id="script-resource-2"></script>	
<script src="<?php echo base_url("assets/js/bootstrap.js"); ?>" id="script-resource-3"></script>	
<script src="<?php echo base_url("assets/js/joinable.js"); ?>" id="script-resource-4"></script>	
<script src="<?php echo base_url("assets/js/resizeable.js"); ?>" id="script-resource-5"></script>	
<script src="<?php echo base_url("assets/js/neon-api.js"); ?>" id="script-resource-6"></script>	
	
<script src="<?php echo base_url("assets/js/jquery.validate.min.js"); ?>" id="script-resource-8"></script>	
<script src="<?php echo base_url("assets/js/neon-login.js"); ?>" id="script-resource-9"></script>	
<script src="<?php echo base_url("assets/js/neon-custom.js"); ?>" id="script-resource-10"></script>	
<script src="<?php echo base_url("assets/js/neon-demo.js"); ?>" id="script-resource-11"></script>	
<!--<script src="<?php echo base_url("assets/js/neon-register.js"); ?>" id="script-resource-12"></script>	-->

<!-- Bottom Scripts -->
<!--
<script src="http://demo.neontheme.com/assets/js/jquery-1.11.0.min.js"></script>-->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.css" />

<script src="<?php echo base_url(); ?>public/craftpip-jquery-confirm/dist/jquery-confirm.min.js" type="text/javascript"></script>
<script type="text/javascript">
			var seg ="<?php echo $this->uri->segment(4); ?>";
			if(seg == 'invalid')
			{
	$(document).ready(function() 
	{
	$.alert({
                title: 'Sorry!',
               content: 'Invalid UserName or Password.',
                confirm: function()
                {
                return true;
                 //document.location.href = window.location.origin+'/admin/programs/';
                }
                 });
	});
  }
  // $(document).ready(function() {
  // 	$('#loginbutton').text('Login');
  // });
</script>
</body>
</html>