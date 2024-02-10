<script type="text/javascript" src="<?php echo base_url("assets/js/toastr.js"); ?>" id="script-resource-15" ></script>
<style>
.toast-title{font-weight:bold}.toast-message{-ms-word-wrap:break-word;word-wrap:break-word}.toast-message a,.toast-message label{color:#fff}.toast-message a:hover{color:#ccc;text-decoration:none}.toast-close-button{position:relative;right:-0.3em;top:-0.3em;float:right;font-size:20px;font-weight:bold;color:#fff;-webkit-text-shadow:0 1px 0 #fff;text-shadow:0 1px 0 #fff;-webkit-opacity:.8;-moz-opacity:.8;-ms-filter:alpha(opacity=80);opacity:.8;filter:alpha(opacity=80)}.toast-close-button:hover,.toast-close-button:focus{color:#000;text-decoration:none;cursor:pointer;-webkit-opacity:.4;-moz-opacity:.4;-ms-filter:alpha(opacity=40);opacity:.4;filter:alpha(opacity=40)}button.toast-close-button{padding:0;cursor:pointer;background:transparent;border:0;-webkit-appearance:none}
.toast-top-full-width{top:0;right:0;width:100%;margin-top:10px;margin-bottom:10px}.toast-bottom-full-width{bottom:0;right:0;width:100%}.toast-top-left{top:12px;left:12px}.toast-top-right{top:12px;right:12px}.toast-bottom-right{right:12px;bottom:12px}.toast-bottom-left{bottom:12px;left:12px}#toast-container{position:fixed;z-index:999999}#toast-container *{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}#toast-container>div{margin:0 0 6px;padding:15px 15px 15px 50px;width:300px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;background-position:15px center;background-repeat:no-repeat;color:#fff;-webkit-opacity:.8;-moz-opacity:.8;-ms-filter:alpha(opacity=80);opacity:.8;filter:alpha(opacity=80)}#toast-container>:hover{-webkit-opacity:1;-moz-opacity:1;-ms-filter:alpha(opacity=100);opacity:1;filter:alpha(opacity=100);cursor:pointer}#toast-container>.toast-info{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGwSURBVEhLtZa9SgNBEMc9sUxxRcoUKSzSWIhXpFMhhYWFhaBg4yPYiWCXZxBLERsLRS3EQkEfwCKdjWJAwSKCgoKCcudv4O5YLrt7EzgXhiU3/4+b2ckmwVjJSpKkQ6wAi4gwhT+z3wRBcEz0yjSseUTrcRyfsHsXmD0AmbHOC9Ii8VImnuXBPglHpQ5wwSVM7sNnTG7Za4JwDdCjxyAiH3nyA2mtaTJufiDZ5dCaqlItILh1NHatfN5skvjx9Z38m69CgzuXmZgVrPIGE763Jx9qKsRozWYw6xOHdER+nn2KkO+Bb+UV5CBN6WC6QtBgbRVozrahAbmm6HtUsgtPC19tFdxXZYBOfkbmFJ1VaHA1VAHjd0pp70oTZzvR+EVrx2Ygfdsq6eu55BHYR8hlcki+n+kERUFG8BrA0BwjeAv2M8WLQBtcy+SD6fNsmnB3AlBLrgTtVW1c2QN4bVWLATaIS60J2Du5y1TiJgjSBvFVZgTmwCU+dAZFoPxGEEs8nyHC9Bwe2GvEJv2WXZb0vjdyFT4Cxk3e/kIqlOGoVLwwPevpYHT+00T+hWwXDf4AJAOUqWcDhbwAAAAASUVORK5CYII=") !important}#toast-container>.toast-error{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHOSURBVEhLrZa/SgNBEMZzh0WKCClSCKaIYOED+AAKeQQLG8HWztLCImBrYadgIdY+gIKNYkBFSwu7CAoqCgkkoGBI/E28PdbLZmeDLgzZzcx83/zZ2SSXC1j9fr+I1Hq93g2yxH4iwM1vkoBWAdxCmpzTxfkN2RcyZNaHFIkSo10+8kgxkXIURV5HGxTmFuc75B2RfQkpxHG8aAgaAFa0tAHqYFfQ7Iwe2yhODk8+J4C7yAoRTWI3w/4klGRgR4lO7Rpn9+gvMyWp+uxFh8+H+ARlgN1nJuJuQAYvNkEnwGFck18Er4q3egEc/oO+mhLdKgRyhdNFiacC0rlOCbhNVz4H9FnAYgDBvU3QIioZlJFLJtsoHYRDfiZoUyIxqCtRpVlANq0EU4dApjrtgezPFad5S19Wgjkc0hNVnuF4HjVA6C7QrSIbylB+oZe3aHgBsqlNqKYH48jXyJKMuAbiyVJ8KzaB3eRc0pg9VwQ4niFryI68qiOi3AbjwdsfnAtk0bCjTLJKr6mrD9g8iq/S/B81hguOMlQTnVyG40wAcjnmgsCNESDrjme7wfftP4P7SP4N3CJZdvzoNyGq2c/HWOXJGsvVg+RA/k2MC/wN6I2YA2Pt8GkAAAAASUVORK5CYII=") !important}#toast-container>.toast-success{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADsSURBVEhLY2AYBfQMgf///3P8+/evAIgvA/FsIF+BavYDDWMBGroaSMMBiE8VC7AZDrIFaMFnii3AZTjUgsUUWUDA8OdAH6iQbQEhw4HyGsPEcKBXBIC4ARhex4G4BsjmweU1soIFaGg/WtoFZRIZdEvIMhxkCCjXIVsATV6gFGACs4Rsw0EGgIIH3QJYJgHSARQZDrWAB+jawzgs+Q2UO49D7jnRSRGoEFRILcdmEMWGI0cm0JJ2QpYA1RDvcmzJEWhABhD/pqrL0S0CWuABKgnRki9lLseS7g2AlqwHWQSKH4oKLrILpRGhEQCw2LiRUIa4lwAAAABJRU5ErkJggg==") !important}
#toast-container>.toast-warning{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGYSURBVEhL5ZSvTsNQFMbXZGICMYGYmJhAQIJAICYQPAACiSDB8AiICQQJT4CqQEwgJvYASAQCiZiYmJhAIBATCARJy+9rTsldd8sKu1M0+dLb057v6/lbq/2rK0mS/TRNj9cWNAKPYIJII7gIxCcQ51cvqID+GIEX8ASG4B1bK5gIZFeQfoJdEXOfgX4QAQg7kH2A65yQ87lyxb27sggkAzAuFhbbg1K2kgCkB1bVwyIR9m2L7PRPIhDUIXgGtyKw575yz3lTNs6X4JXnjV+LKM/m3MydnTbtOKIjtz6VhCBq4vSm3ncdrD2lk0VgUXSVKjVDJXJzijW1RQdsU7F77He8u68koNZTz8Oz5yGa6J3H3lZ0xYgXBK2QymlWWA+RWnYhskLBv2vmE+hBMCtbA7KX5drWyRT/2JsqZ2IvfB9Y4bWDNMFbJRFmC9E74SoS0CqulwjkC0+5bpcV1CZ8NMej4pjy0U+doDQsGyo1hzVJttIjhQ7GnBtRFN1UarUlH8F3xict+HY07rEzoUGPlWcjRFRr4/gChZgc3ZL2d8oAAAAASUVORK5CYII=") !important}#toast-container.toast-top-full-width>div,#toast-container.toast-bottom-full-width>div{width:96%;margin:auto}#toast-container .toast-success.black,#toast-container .toast-error.black,#toast-container .toast-info.black,#toast-container .toast-warning.black{background-color:rgba(0,0,0,0.7);color:#fff}.toast{background-color:#030303}.toast-success{background-color:#00a651}.toast-error{background-color:#cc2424}.toast-info{background-color:#21a9e1}.toast-warning{background-color:#f89406}@media all and (max-width:240px){#toast-container>div{padding:8px 8px 8px 50px;width:11em}#toast-container .toast-close-button{right:-0.2em;top:-0.2em}}@media all and (min-width:241px) and (max-width:480px){#toast-container>div{padding:8px 8px 8px 50px;width:18em}#toast-container .toast-close-button{right:-0.2em;top:-0.2em}}@media all and (min-width:481px) and (max-width:768px){#toast-container>div{padding:15px 15px 15px 50px;width:25em}}*,*:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
</style>
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
	"timeOut": "10000",
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
	"positionClass": "toast-top-full-width", //toast-bottom-right
	"onclick": null,
	"showDuration": "100",
	"hideDuration": "1000",
	"timeOut": "10000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	};

	//success

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
			if($message['type'] == 'success')
			{
				$save_msg = $message['text'];		
				echo '<script type="text/javascript">toastr.success("'.$save_msg.'", "Success", opts);</script>';	
			}
			if($message['type'] == 'error')
			{
				$save_msg = $message['text'];		
				echo '<script type="text/javascript">toastr.error("'.$save_msg.'", "Alert", opts1);</script>';	
			}
			if($message['type'] == 'warning')
			{
				$save_msg = $message['text'];		
				echo '<script type="text/javascript">toastr.error("'.$save_msg.'", "Warning Found", opts2);</script>';	
			}			
		}
    }	
?>
