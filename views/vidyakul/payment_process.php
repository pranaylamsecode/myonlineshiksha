<?php
$currency = "INR";
$auth = $this->session->userdata('logged_in');
$user_id = $auth['id'];
if(!empty($user_id)){
/*rzp_test_xzC3d0V2ohVitK
FGQEEqfihE81f078w9kjgquT*/

  $user = $this->Crud_model->get_single('mlms_users',"id = ".$user_id,'email,mobile,first_name,last_name');
  $pname = $user->first_name.' '.$user->last_name;
  $u_email = $user->email;
  $u_mobile = $user->mobile;
    // $fixedrate = 1;
	$description        = "Product Description";
	$txnid              = date("ymdHis");     
	// $key_id             = $this->config->item('keyId');
	$key_id             = 'rzp_test_6MFfxqebE6WWyY';
	$currency_code      = "INR";            
	$total              = intval($price) * 100; // 100 = 1 indian rupees
	$amount             = $price;
	$merchant_order_id  = "TXN-".$txnid;
	$card_holder_name   = ucwords(trim($pname));
	$email              = $u_email;
	$phone              = $u_mobile;
	$name               = "MYOnlineShiksha";
	$callback_url       = base_url().'orders/callback';
	$surl               = base_url().'orders/razor_success';
	$furl               = base_url().'orders/razor_failed';
	// if($stripe->status == 'active' && $stripe->mode == 'live'){
?>
<!-- razorpay form starts here -->
<form name="razorpay-form" id="razorpay-form" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
  <input type="hidden" name="currency_code" id="currency_code" value="<?php echo $currency_code; ?>"/>
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var razorpay_pay_btn, instance;
$(document).on('click', '#Payrazor', function (e) {
  const d = new Date();
let time = d.getTime();
jQuery('form#razorpay-form').find('input#merchant_order_id').val('TXN-'+time);
  	$(this).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i><span style="padding-left:10px;">Please wait...</span>');
    var merchant_order_id = jQuery('form#razorpay-form').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-form').find('input#merchant_surl_id').val();
    var merchant_furl_id = jQuery('form#razorpay-form').find('input#merchant_furl_id').val();
    var card_holder_name_id = jQuery('form#razorpay-form').find('input#card_holder_name_id').val();
    var merchant_total = jQuery('form#razorpay-form').find('input#merchant_total').val();
    var merchant_amount = jQuery('form#razorpay-form').find('input#merchant_amount').val();
    var currency_code = jQuery('form#razorpay-form').find('input#currency_code').val();
    var user_id = '<?php echo $user_id;?>';
    var course_name = '<?php echo $course_name; ?>';
    $.ajax({
        type : 'post',
        cache : false,
        url : '<?php echo base_url();?>orders/create_order/',
        data : {user_id: user_id, course_name: course_name, merchant_amount : merchant_amount, merchant_order_id :merchant_order_id,currency_code :currency_code},
        success : function(res){
        }
    });
    var options = {
      key:            "<?php echo $key_id; ?>",
      amount:         merchant_total,
      name:           "<?php echo $name; ?>",
      description:    merchant_order_id,
      netbanking:     true,
      currency:       currency_code, // INR
      image:      '<?php echo base_url();?>public/uploads/settings/img/logo/4937_02-12-2019.png',
      prefill: {
          name:       card_holder_name_id,
          email:      "<?php echo $email; ?>",
          contact:    "<?php echo $phone; ?>"
      },
      notes: {
          soolegal_order_id: merchant_order_id,
      },
      handler: function (transaction) {
        /*document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();*/
        $.ajax({
            url:'<?php echo $callback_url;?>',
            type: 'post',
            cache : false,
            data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code: currency_code, user_id: user_id, course_name: course_name},
            dataType: 'json',
            success: function (res){
                $('#Payrazor').html('Pay with Razorpay');
                if(res.msg){
                    $("#paymsg").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-exclamation-triangle" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> '+res.msg+' </span></div>').fadeIn("slow");
                setTimeout(function(){
                    $("#paymsg").html('');
                },3000);
                    return false;
                }else{
            $.ajax({
              type: "post",
              cache : false,
              url : res.redirectURL,
              data:"",
              success : function(response){
                if(response == 1){
                        $("#paymsg").html('<div class="alert alert-success alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-check" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Enrolled Successfully. </span></div>').fadeIn("slow");
                        setTimeout(function(){
                    $("#paymsg").html('');
                    window.location.reload();
              },2000);
                      }else{
                  $("#paymsg").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-exclamation-triangle" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Payment processing Failed. try again after some time. </span></div>').fadeIn("slow");
                  setTimeout(function(){
                    $("#paymsg").html('');
                          // window.location.href = res.redirectURL;
              },2500);
                }
              }
            });
                }
            },
            failure : function(res)
            {
              $("#paymsg").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-exclamation-triangle" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> ERROR : '+res+' </span></div>').fadeIn("slow");
              setTimeout(function(){
                  $("#paymsg").html('');
              },2500);
            }
          });
      },
      "modal": {
          "ondismiss": function(){
              // location.reload();
            $.ajax({
                type : 'post',
                cache : false,
                url : '<?php echo base_url();?>orders/update_order/',
                data : {merchant_order_id :merchant_order_id},
                success : function(res){
                  $("#paymsg").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-exclamation-triangle" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Order Cancelled. </span></div>').fadeIn("slow");
                  setTimeout(function(){
                      $("#paymsg").html('');
                  },2500);
                }
            });
            $('#Payrazor').html('Pay with Razorpay');
          }
      }
    };
  instance = new Razorpay(options);
    $.ajax({
      type: "get",
      cache : false,
      url : "<?php echo base_url();?>paymentprocess/check_login",
      data:"",
      success : function(data){
        if(data == 1){
          instance.open();
        }else{
          $("#paymsg").html('<div class="alert alert-danger alert-dismissible fade in"> <a href="#" class="close" data-dismiss="alert" aria-label="close"> <i class="fa fa-times" aria-hidden="true" style="margin-top:10px !important;"></i> </a><strong class="fa fa-exclamation-triangle" aria-hidden="true"> </strong> <span style="margin-right:10px !important;"> Session expired. please login again. </span></div>').fadeIn("slow");
        setTimeout(function(){
          location.reload();
        },2500);
        }
      }
    });
    e.preventDefault();
  });
    /*function razorpaySubmit(el) {
        if(typeof Razorpay == 'undefined') {
            setTimeout(razorpaySubmit, 200);
            if(!razorpay_pay_btn && el) {
                razorpay_pay_btn    = el;
                el.disabled         = true;
                el.value            = 'Please wait...';  
            }
        } else {
            if(!instance) {
                instance = new Razorpay(options);
                if(razorpay_pay_btn) {
                razorpay_pay_btn.disabled   = false;
                razorpay_pay_btn.value      = "Pay Now";
                }
            }
            instance.open();
        }
    }*/  
</script>
<?php } ?>