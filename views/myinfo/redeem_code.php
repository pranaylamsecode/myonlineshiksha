<style type="text/css">
	.centerred{
		width: 400px;
		height: 100px;
		
		position: absolute;
		top:0;
		bottom: 0;
		left: 0;
		right: 0;
	  	
		margin: auto;
	}
	@media (max-width: 767px)
	{
		.centerred{
			position: unset;
			margin: 40px 0px;
			width: 100%;
		}
	}
</style>
<style type="text/css">
   #message1 {
    position: fixed; 
  	right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 15px;
    top: 0;
    z-index: 9999;    
}
</style>
<div id="message1"></div>
<div class="container">
	<div class="centerred">
		<div class="form-group">
			<input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter Coupon Code">
			<span id="err_name"></span>
		</div>
		<div id="please_waitt" class="form-group text-center" style="display: none; float: center;">
          	<img src="https://myonlineshiksha.com/public/images/loading.gif" height="50px">
          	<span style="padding-left: 10px;">Please Wait</span>
        </div>
		<div class="form-group text-center" id="btn_redeem">
			<button class="btn btn-success btn-md" onclick="return check_redeem()">Redeem Now</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	function check_redeem(){
		var coupon_code = $("#coupon_code").val().trim();
		if(coupon_code=='')
		{
			$("#err_name").fadeIn().html("Please enter Coupon code").css('color','red');
			setTimeout(function(){$("#err_name").html("");},3000);
			$("#coupon_code").focus();
			return false;
		}
		$("#please_waitt").css("display","block");
		$("#btn_redeem").css('display',"none");
		$.ajax({
				type : "post",
				cache : false,
				url: '<?php echo base_url();?>myinfo/check_code',
				data:{
					coupon_code : coupon_code
				},
				success: function(data)
				{
					$("#please_waitt").css('display',"none");
					$("#btn_redeem").css('display',"block");
					if(data!=0)
					{
						var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong>You have successfully enrolled to the course - <span style="text-transform: capitalize;">'+data+'</span></div>';
                            // var note = $(document).find('#message');
                        $('#message1').html(str);
                        setTimeout(function(){$("#message1").html("");},2500);
						window.setTimeout(function () {
					       	window.open('<?php echo base_url();?>my-courses');
					    }, 3000);
					}
					else{
						$("#coupon_code").val('');
						$("#err_name").fadeIn().html("Invalid Coupon or Coupon already used!").css('color','red');
						setTimeout(function(){$("#err_name").html("");},3000);
						$("#coupon_code").focus();
						return false;
					}
				},
				error: function() {
						$("#please_waitt").css('display',"none");
						$("#btn_redeem").css('display',"block");
				  		$("#coupon_code").val('');
						$("#err_name").fadeIn().html("Invalid Response sent! try after few minutes!").css('color','red');
						setTimeout(function(){$("#err_name").html("");},3000);
						$("#coupon_code").focus();
						return false;
				}
		});
	}
</script>