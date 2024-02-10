<?php
  $start = ( $this->uri->segment(3))  ? $this->uri->segment(3) : 0;
  $first = $start + 1;
?>
<script>
function saveorder(n, task) {
checkAll_button(n, task);
}

function checkAll_button(n, task) {
	if (!task) {
		task = 'saveorder';
	}
    document.orderform.submit();
}
</script>

<?php

  $u_data=$this->session->userdata('logged_in');
  $maccessarr=$this->session->userdata('maccessarr');

?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/my_frontend.css" type="text/css" media="screen" />

<style type="text/css">
.cart_page .buy_section_cart {
    width: 27%;
    float: left;
    padding-left: 30px !important;
}
.cart_page .courses_list_cart {
    width: 73%;
    float: left;
    padding: 0px 0px 0px 0px;
    margin: 0px;
}
.cart_page .buy_section_cart .current_price i {
    font-size: 38px !important;
    width: 10px;
}
.cart_page .buy_section_cart h2 {
    margin: 0px 0px 10px 0px;
    color: #444;
    font-size: 20px !important;
}
p.course_price i {
    margin-right: 3px;
}
p.course_price {
    color: #34af23;
    font-size: 16px;
    font-weight: bold;
}
p.course_price strike {
    color: #555;
    font-size: 14px;
}
p.course_price strike{
	margin-left: 7px;
}
.courses_list_cart .row div {
    padding-left: 0px;
    padding-right: 0px;
}
.courses_list_cart form .row {
    border: 0px;
    margin: 0px 0px 15px 0px;
    padding: 0px 15px;
    box-shadow: 0px 0px 2px #ccc;
}
.cart_page .buy_section_cart .current_price {
    display: block;
    margin-bottom: 15px;
    color: #333;
    font-weight: 600;
    font-size: 42px;
}
.courses_list_cart .course_pay_method button:hover {
    color: #003845;
}
.courses_list_cart .course_pay_method button {
    background: transparent;
    border: 0px;
    padding: 0px;
    color: #007791;
}
.o.buy_section_cart .buy_course_btn {
    width: 100% !important;
    display: block;
    background: #2d3b92;
    font-size: 16px;
    margin: 0px 0px 15px 0px !important;
    max-width: 100% !important;
    padding: 15px;
}
span.apply_coupon_cart a {
    color: #2d3b92;
}
span.apply_coupon_cart a:hover {
    color: #495183;
}
.buy_section_cart #promo_code form {
    padding: 0px;
    width: 100%;
}
.buy_section_cart #promo_code form .input-group.btn-block {
    width: 100% !important;
    display: flex;
    max-width: 100% !important;
}
.buy_section_cart #promo_code form button {
    width: auto;
    background: #34af23;
    transition: 0.3s ease;
    color: #fff;
    font-size: 16px;
    padding: 8px 18px;
    text-transform: capitalize;
    border-radius: 0px;
    border: 0px;
}
.buy_section_cart #promo_code form button:hover {
    background: #48bf37;
}
.courses_list_cart .heading {
    font-size: 20px;
    color: #444;
    line-height: 1em;
    margin-bottom: 20px;
}
.buy_section_cart #promo_code form .input-group.btn-block input {
    width: 100% !important;
    font-size: 16px;
    border-bottom: 1px solid #777 !important;
    height: 40px !important;
    padding: 0px 10px 0px 0px !important;
    color: #333;
}
.buy_section_cart #promo_code form .input-group.btn-block input::placeholder {
    color: #333;
}
.cart_section {
    display: inline-block;
    margin: 0px;
    padding: 50px 0px;
}
.strikediag{
  text-decoration: line-through;
}
.orders_list .btn.btn-default {
	padding: 5px 15px;
	font-size: 14px;
	border: 1px solid #2d3b92;
	color: #2d3b92;
	margin-left: 0px;
}
.orders_list .btn.btn-default:hover {
	background: #2d3b92;
	color: #fff;
}
.orders_list {
	border-bottom: 0px;
	display: inline-block;
	width: 100%;
	padding: 15px 0px 15px 0px !important;
}
.orders_list div {
    padding: 0px 10px 0px 0px;
    font-size: 14px;
}
.heading div {
    padding: 5px 5px 5px 0px !important;
}
.course_img img {
    object-fit: cover;
    width: auto;
    max-width: 100%;
    height: auto;
    max-height: 100%;
}
.course_img {
    padding-right: 0px !important;
}
.product_name {
    padding-left: 15px !important;
}
.table-scroll-resp.order_scroll.inner_pages_table .row:last-child .orders_list {
    border-bottom: 0px;
}
@media (max-width: 767px){
	.orders_list .btn.btn-default {
		width: 190px;
		margin: 10px 0px 0px 0px;
	}
	.courses_list_cart form .row {
    border: 0px;
    margin: 0px 0px 1px 0px !important;
    padding: 10px 0px 5px 0px !important;
    box-shadow: 0px 0px 1px #ccc;
}
	.cart_section {
    display: flex;
    margin: 0px;
    padding: 30px 5px;
    flex-direction: column;
}
.cart_page .buy_section_cart {
    width: 300px;
    float: unset;
    margin-bottom: 35px;
    order: 1;
    max-width: 100%;
    padding-left: 0px !important;
}
#promo_code .navbar-form {
    margin: 0px 0px !important;
}
.cart_page .buy_section_cart .current_price i {
    font-size: 33px !important;
    width: 10px;
}
.cart_page .buy_section_cart .current_price {
    font-size: 36px;
}
.courses_list_cart .row .product_name a {
    font-size: 15px;
    line-height: 1.3em;
    font-weight: bold;
}
.cart_page .courses_list_cart {
    width: 100%;
    float: unset;
    padding: 0px 0px 0px 0px;
    order: 2;
    overflow: hidden;
    margin: 0px;
}
.courses_list_cart .heading {
    font-size: 18px;
}
.o.buy_section_cart .buy_course_btn {
    width: 300px !important;
    font-size: 16px;
    margin: 0px 0px 15px 0px !important;
    max-width: 100% !important;
    padding: 12px;
    max-width: 100% !important;
}
}
@media (max-width: 500px){
	.orders_list .btn.btn-default {
	width: 100%;
}
}
</style>
<style>
label {
padding: 0 !important;
margin-bottom: 10px !important;
width:auto !important;
}
.table>tbody>tr>td{
	background: #fff !important;
}
</style>
<div class="page-container myinfo_page cart_page">
	<div class="main-content">
			<div class="info_page_breadcrumb">
				<div class="info_container">
					<h3>My Cart Courses</h3>
					<p>Here you can view your added to cart courses and purches it.</p>
				</div>
			</div>
			<div class="content cources_main_content">
				<div class="info_container">
					<div style="height: 0px">
					    
					    <span class="clearFix">&nbsp;</span>
					</div>
					<?php 
					$course_ids = array();
					$ids = array();
					$ids_str = '';
					$tot_amount = 0; ?>
					<div id="table-2_wrapper" class="dataTables_wrapper form-inline cart_section" role="grid">
						
			 			<?php echo form_close(); ?>
						<div class="table-scroll-resp order_scroll inner_pages_table courses_list_cart" >
							<div class="heading">
								<?php echo $total_rows; 
								if($total_rows == 1){
									echo " Course";
								}else{
									echo " Courses";
								}
								?> 
								
								 in Cart
							</div>
							<!-- <div class="row">
								<div class="col-sm-12"> -->
									
									<!-- <div class="col-xs-6"><h4>Courses</h4></div>
									<div class="col-xs-6">
										<div class="col-xs-3">Cart Date</div>
										<div class="col-xs-3">Price</div>
										<div class="col-xs-3">Option</div> -->
										<!-- <div class="col-xs-3">Invoice</div> -->
									<!-- </div>
								</div>
							</div> -->
							<?php
								$attributes = array('class' => 'tform', 'name' => 'orderform');
								echo form_open_multipart('admin/programs/',$attributes);
								if ($carts){
								$i=0;
							   	$iii = 0;
							   
								foreach ($carts as $cart){
									$i++;
									// $get_courses = $this->orders_model->getProgramName($order->courses);
								
							  // 	$coursearr=explode('-',$order->courses);
							  	$plan_id = $this->orders_model->getPlanId($cart->id);
							  	$ids[] = $cart->id;
							  	$ids_str = $ids_str.$cart->id.', ';
								  	// $signs = $this->settings_model->getCurrenciesign($order->currency);
							  // 	$course_name = $this->orders_model->getProgramName(@$coursearr[0]);
							  // 	$urlCourse = $course_name->slug;
							?>
							<div class="row" id="cart_<?php echo $i ?>">
								<div class="col-sm-12 orders_list" style="padding: 10px;">
									<div class="col-xs-4 col-sm-2 course_img">
										<img src="<?php echo $cart->image; ?>" width="100%">
									</div>
									<div class="col-xs-8 col-sm-6 product_name">
										<a href="<?php echo base_url()?>online-courses/<?php echo $cart->slug ?>"><?php echo $cart->name;?></a>
										<p><?php if(!empty(@$plan_id)){echo $this->orders_model->getPlanName(@$plan_id);}else{echo "";}?></p>
										<p class="course_price">
											<?php  
											if($cart->demoprice=="" && $cart->fixedrate == "0.00")
                							{
                								echo "Free";
                							}
                							else{
												echo " ".@$signs->sign.$cart->fixedrate;
												$tot_amount = $tot_amount + $cart->fixedrate;
												if($cart->demoprice){ echo "<strike>".@$signs->sign.$cart->demoprice."</strike>"; }
											}
											?>

										</p>

									</div>
									
									<div class="col-xs-4 col-sm-2 course_date"><?php echo date('d-m-Y',strtotime($cart->wishlist_date));?>
									</div>
									
									<div class="col-xs-14 col-sm-2 course_pay_method">
											<button type="button" id="<?php echo $i  ?>" onclick="ajax_deletewishlist('<?php echo $i; ?>','<?php echo $cart->id ?>', '<?php echo $cart->wishlist_id ?>', '2')">Remove</button>
									</div>
										
								</div>
							</div>
							<?php $iii++; 
			    				}
			    				
							} else { ?>
							<div class="col-sm-12 orders_list datatable dataTable">
								No orders yet. <a href="<?php echo base_url(); ?>courses">Create a one now !</a>
							</div>
							<?php }
							echo form_close(); ?>
						</div>

						<div class="o buy_section_cart" style="<?php echo $carts ? 'display: block' : 'display: none'; ?>"><h2 style="font-size: 24px;">Total:</h2>
						 <?php echo "<span id='pricerate1' class='pricerate2 current_price' >". $signs->sign." ". $tot_amount."</span>" ?> 
						<span id='pricerate2' class='pricerate2'></span>
						
          					<input type="hidden" id="coupencode_payU" name="coupencode" value="" />

						<button class="btn btn-lg btn-primary btn-block buy_course_btn" onclick="getHash()">Buy Now</button></h2>
						<span class="apply_coupon_cart"><a href="javascript:void(0)" id="hv_coupon" class="coupon">Have a Coupon?</a>

						</span>

							<div id="promo_code" style="display: none">

			                  <form class="navbar-form" role="search">
			                    <div class="input-group btn-block">
			                        <input type="hidden" value="" id="coupon_code" name="coupon_code">
			                        <input type="text" class="form-control" placeholder="Enter coupon code" value="" id="promocode" name="promocode" >
			                        <button class="btn apply" type="button" value="Apply" onclick="promoApply()" id="btn_redeem">apply</button>
			                            <div id="please_waitt" class="form-group text-center" style="display: none; float: center;">
			                                <img src="https://myonlineshiksha.com/public/images/loading.gif" height="25px">
			                                <span style="padding-left: 10px;">Please Wait</span>
			                            </div>
			                        </div>
			                    </div>
			                    <div style="width: 100%;"><span id="promoMSg" ></span></div>
			<script type="text/javascript">
			  function sync()
			{
			  var n1 = document.getElementById('coupon_code');
			  var n2 = document.getElementById('promocode');
			  n1.value = n2.value;
			}
			</script>
			              </form>           
			            </div>

					</div>
					</div>
				</div>       
			    <!---Pagination-->       
			 	<?php if($this->pagination->create_links()) { ?>     
				<div class="row">
					<div class="col-xs-6 col-left">
						<div class="dataTables_info" id="table-2_info">Showing <?php echo $first;?> to <?php echo $start+$iii; ?> of <?php echo $countorders; ?> entries</div>
					</div>
				 
				    <div class="col-xs-6 col-right">
					    <div class="dataTables_paginate paging_bootstrap">
						    <ul class="pagination pagination-sm">
								<?php echo $this->pagination->create_links(); ?>
						    </ul>
					    </div>
				    </div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>    
</div>
<style type="text/css">
  .data{
   margin:4%; 
   display: none;
  }

</style>
<script>
var $ =jQuery.noConflict();
			//(function($) {
				$(document).ready(function() {

					$('#more').click( function(){
				        $(this).find('i').toggleClass(' glyphicon glyphicon-plus').toggleClass('glyphicon glyphicon-minus');
				      });

					var mySlidebars = new $.slidebars();
					
					$('.toggle-left').on('click', function() {
						mySlidebars.toggle('left');
					});
					
					$('.toggle-right').on('click', function() {
						mySlidebars.toggle('right');
					});
				});
			//}) (jQuery);
</script>


<!-- tool tip script --><script type="text/javascript">$(document).ready(function(){	$('.tooltipicon').click(function(){	var dispdiv = $(this).attr('id');	$('.'+dispdiv).css('display','inline-block');	});	$('.closetooltip').click(function(){	$(this).parent().css('display','none');	});	});	</script><!-- tool tip script finish -->
<!-- <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524"
 bolt-logo="<?php echo base_url() ?>public/uploads/settings/img/logo/<?php echo $configarr['0']['favicon'] ?>"></script>
 --><script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="<?php echo base_url() ?>public/uploads/settings/img/logo/<?php echo $configarr['0']['favicon'] ?>"></script>

<div id="payment_lean_overlay" style="display: none; opacity: 0.5;"> </div>

<script>
function ajax_deletewishlist(id,pro_id,wishlist_id,type)
{  
	$.ajax({
		type: "POST",
		cache: false,
		url: "<?php echo base_url();?>programs/delete_wishlist",
		data: {'wishlist_id':wishlist_id,'pro_id':pro_id,'type':type},
		success: function(data){
			if(type == 2)
			{
				$(document).find('#cart_'+id).remove();
				$num = parseInt($(document).find('#cart_info').text()) - 1;
				if($num <= 0){ $num = 0; 
					$(document).find('.buy_section_cart').hide(); 
				}
				$(document).find('#cart_info').text($num);
				
				if($num > 1)
					$(document).find('.heading').text($num+" Courses in Cart");
				else
					$(document).find('.heading').text($num+" Course in Cart");

			}
		}
	});
}

function promoApply()
  {
  	 var promocode = $("#promocode").val();
       var course_ids = <?php echo json_encode($ids) ?>;
       if(promocode)
       {
       	$.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>programs/promoCodeApply_cart",
           data: {'promocode':promocode,'course_ids':course_ids},
            success: function(data)
          	{
          		console.log(data);
          		 if(data == "Failed")
                    {
                      $("#promoMSg").html('The coupon code entered is not valid for this course. Perhaps you used the wrong coupon code?');
                      $("#promoMSg").css("color","red");
                      setTimeout(function () {
                          $("#promoMSg").html("");
                       }, 5000);
                      // document.getElementById("go").click();
                     
                    }
                    else
                    {
                       
                        var org = $('#pricerate1').text();
                         org_cost = org.split('.');
                       org_cost = parseInt(org_cost[0].replace(/[^0-9]/g,''));
                       console.log(org_cost);
                       $("#coupencode_paypal").val(promocode);
                       $("#coupencode_payU").val(promocode);
                       $("#pricerate1").addClass("strikediag");
                       $("#pricerate1").attr('style','font-size: 20px;');
                       $("#pricerate1").removeClass("pricerate2 current_price");
                       $("#pricerate1").addClass("pricerate1");  
                       $("#pricerate2").addClass("current_price");  
                      // str_split((($programs->fixedrate/$programs->demoprice)*100), 5);
                       
                        var cut_amt = parseInt(org_cost) - parseInt(data);
                        var dis = Math.round((parseInt(cut_amt)*100/parseInt(org_cost)));
                      
                       // var old_dis = $('.per_off').html();
                      if($('.per_off').length){
                         $('.per_off').html(dis);
                     } else {
                        $(document).find('#price_block').append('<span class="price2"><span class="per_off">'+dis+'</span>% off</span>');
                     }
                       $("#pricerate2").html('<?php echo $signs->sign ?>'+data);

                       $("#promoapply").attr("disabled",true);
                       $("#promoMSg").css("color","green");
                       $("#promoMSg").html('Congratulation! Coupon code has been applied');
                    }
               }
            });
       }
       else
       {
        $("#promoMSg").html("Please enter coupon code here");
        setTimeout(function () {
            $("#promoMSg").html("");
         }, 3000);
        $("#promoMSg").css("color","red");
       } 

      
  }

    $('#hv_coupon').click(function(){
    $('#promo_code').show();
    $('#hv_coupon').hide();
  });

</script>

<script>

    function pay_close(){
       $("#payment").hide();     
         $("#payment_lean_overlay").hide();
         $("#lean_overlay").hide();
         
    }

    
    


</script> 

<script>
function getHash()
{

		var arr = <?php echo json_encode($ids) ?>;
      if(arr)
      {
        var promocode = $("#promocode").val();
        var plan_id = $("#plan_id").val(); 
        
$.ajax({
        url: '<?php echo base_url(); ?>paymentprocess/payUMoney_Process_ajax',
          type: 'post',          
          data:{"course_id":arr,'plan_id':plan_id,'coupencode':promocode},
          beforeSend: function(){
            // $('.buy_course_btn').hide();
            // $('#buy_loader').show();

          },
          success: function(data) {
            // alert(data);return false;
            console.log(data);
             $('.buy_course_btn').show();
            $('#buy_loader').hide();
            var responseData = JSON.parse(data);
            console.log('rrrrrr:');
            console.log(responseData.data);
            if(responseData.status = "200")
            { 
                 var rrr = responseData.data;
                pay_close();
                launchBOLT(rrr);
            }
            else
            {
              alert("Something went wrong");
            }
            
            
            //console.log(responseData.hash);
            //pay_close();
            //launchBOLT(responseData);
          }
        });
    }
    else
    {
      alert("sorry,Something wnet wrong");
    }

}
</script>

<script type="text/javascript"><!--
function launchBOLT(responseData)
{
    console.log('launchBOLT:res:');

console.log(responseData);
  bolt.launch({
  key: responseData.key,
  txnid: responseData.txnid, 
  hash: responseData.hash,
  amount: responseData.amount,
  firstname: responseData.fname,
  email: responseData.email,
  phone: responseData.mobile,
  productinfo: responseData.pinfo,
  udf5: responseData.udf5,
  surl : responseData.surl,
  furl: responseData.surl,
  mode: 'dropout' 
},{ responseHandler: function(BOLT){
  // $(document).find('.brandlogo').remove();
  // console.log( BOLT.response.txnStatus );   
  if(BOLT.response.txnStatus != 'CANCEL')
  {
    alert(BOLT.response);
    console.log(BOLT.response);
    //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
    // var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
    // '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
    // '<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
    // '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
    // '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
    // '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
    // '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
    // '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
    // '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
    // '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
    // '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
    // '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
    // '</form>';
    // var form = jQuery(fr);
    // jQuery('body').append(form);                
    // form.submit();
  }
},
  catchException: function(BOLT){
    alert( BOLT.message );
  }
});
}
//--

// var buy_section_cart_offset = jQuery('.buy_section_cart').offset().top;
// buy_section_cart_height = jQuery('.buy_section_cart').height();
// buy_section_cart_offset = buy_section_cart_offset - parseInt(buy_section_cart_height);
// jQuery(window).scroll(function() {                

//  	var currentScroll = jQuery(window).scrollTop(); 

//       if (currentScroll > buy_section_cart_offset) {
//       // apply position: fixed if you
//           jQuery('.buy_section_cart').addClass("fixed_cart_sec");
        
//       } else {                                 
//           jQuery('.buy_section_cart').removeClass("fixed_cart_sec");

//       };
// });
</script>
