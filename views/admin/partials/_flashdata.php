<script type="text/javascript" src="<?php echo base_url("assets/js/toastr.js"); ?>" id="script-resource-15"></script>
<script type="text/javascript">
//success
var opts = {
	"closeButton": true,
	"debug": false,	
	"positionClass": "toast-bottom-left",
	"onclick": null,			
	"showDuration": "300",	
	"hideDuration": "1000",	
	"timeOut": "5000",		
	"extendedTimeOut": "1000",	
	"showEasing": "swing",		
	"hideEasing": "linear",		
	"showMethod": "fadeIn",		
	"hideMethod": "fadeOut"		
	};

//error						
var opts1 = {
	"closeButton": true,
	"debug": false,
	"positionClass": "toast-top-full-width",
	"onclick": null,
	"showDuration": "300",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	};						

//warning
var opts2 = {
	"closeButton": true,
	"debug": false,
	"positionClass": "toast-bottom-right",
	"onclick": null,
	"showDuration": "300",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	};
//toastr.success("Some by marianne admitted speaking.", "This is a title", opts);

</script>
<?php   
$message = $this->session->flashdata('message');
    if($message)
    {  
		if ( is_array($message['text']))    
		{		
			echo '<script type="text/javascript">toastr.success("Some by marianne admitted speaking.", "This is a title", opts);</script>';
			echo "<div class='msg_".$message['type']."'>";   
			echo "<ul>";       
			foreach ($message['text'] as $msg) 		
			{                  
			echo "<li><span>".$msg."</span></li>";	
			}
			echo "<ul>";
			echo "</div>";	 
		}    
		else    	
		{	     
			/*echo "<div class='msg_".$message['type']."'>";     
			echo "<span>".$message['text'] . "</span>";	  
			echo "</div>";*/	
			if($message['type'] == 'success')
			{
				$save_msg = $message['text'];		
				echo '<script type="text/javascript">toastr.success("'.$save_msg.'", "Success", opts);</script>';	
			}
			if($message['type'] == 'error')
			{
				$save_msg = $message['text'];		
				echo '<script type="text/javascript">toastr.error("'.$save_msg.'", "Access Denied", opts1);</script>';	
			}
			if($message['type'] == 'warning')
			{
				$save_msg = $message['text'];		
				echo '<script type="text/javascript">toastr.error("'.$save_msg.'", "Warning Found", opts2);</script>';	
			}
		}
    }	
?>