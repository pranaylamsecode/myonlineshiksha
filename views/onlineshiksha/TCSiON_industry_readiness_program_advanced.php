<?php $this->load->view('new_template_design/header-landing');
$currency = "INR";
$auth = $this->session->userdata('logged_in');
$user_id = $auth['id'];
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/themestyle.css">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500;600;700&display=swap" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
<!-- <section class="fullWidthBanner">
    <img src="<?php //echo base_url();?>public/uploads/mos-full.png">
</section> -->
<style type="text/css"> 
.spn-terms a{
    border-bottom: 1px solid;
}
.spn-terms a:hover{
    color: #1c96f0;
    border-bottom: 1px solid #1c96f0;
}

.overview ul{
    list-style-type: disc;
    padding-left: 50px;
}
.curriculumRow{
  padding: 0 50px;
}
section.programHighlightSection::before {
    height: 450px;
}
@media (max-width: 767px){
    .overview ul{
        padding-left: 15px;
    }
    section.programHighlightSection {
        padding: 0px 0 20px;
    }
    .curriculumRow{
      padding-left: 10px;
    }
    .curriculumRowImage{
      display: none;
    }
    section.programHighlightSection::before{
      height: 750px;
    }
}
.curriculumSection li i.fa-sort-up{
  font-size: 20px !important;
}
.advantagerow{
  box-shadow: 7px 7px 7px 2px #777;
  border-radius: 75px;
}
h3 span{
  font-weight: 200;
}
.points {
    padding: 15px 0px 0 0;
}
.points p {
    padding-top: 10px;
}
.curriculumRowText li {
    font-weight: 601;
}
.points img{
  width: 115px;
}
</style>
<span id="message"></span>
<section class="courseDetailInfo">
	<div class="container">
		<div class="innerSection">
			<div class="row">
				<div class="col-sm-8">
					<div class="courseDetails">
						<h2>Industry Readiness Program: Advanced <span>with TCS iON Remote Internship</span></h2>
						<!-- <div class="timeDetails">
                            <div class="timeCol">
                                <h6><i class="fa fa-calendar"></i> 18 Sept 2021</h6>
                                <span>8 am - 11 am</span>
                            </div>
                            <div class="categoryCol">
                                <div class="categoryColImg">
                                    <img src="<?php //echo base_url().'public/uploads/healthcare-icon.png'?>">
                                </div>
                                <div class="categoryColText">
                                    <h6>IRP</h6>
                                    <span>Categories</span>
                                </div>
                            </div>
                        </div> -->

						<div class="overview">
							<img src="<?php echo base_url().'public/uploads/mos-banner.png'?>">
							<h3>Program Overview</h3>
							<!-- <p>An open source automation testing tool, Selenium is used for testing the most dynomic of web applications. Selernum works across operating systems and w. browsers. Test scripts can be written in programming languages like java, Python, C#, PHP, Ruby, Perl and .Net and since Selenium is an open-source toot there's no licensing cost involved.</p> -->
							<p>Self-paced courses on Interview Techniques,Public Speaking & Personality Development + Industry Readiness Program with TCS iON RIO-210 Internship, having an Industry mentor for the project work of 210 hours with supportive elements self-learning content,webinars, daily activity reports, knowledge sharing, tests and viva online to help the students complete the projects successfully leading to certification by TCS iON.</p>
                            <p>The Industry Readiness Program is specifically designed to bridge the skill gap and make the under-graduates ready for the wider domains of Industry. This program is product of collaboration between MyOnlineShiksha and TCS Ion.</p>
                            <p>This program will let you work on real projects with Tata Consultancy Services with an expert mentor and lets you make an impact in the business world – before you even graduate This in turn significantly improves the placement chance of these graduates.</p>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="courseInfo">
						<div class="fees">
							<div class="label">
								<p>Course Fee</p>
							</div>
							<div class="value">
								<p><i class="fa fa-inr"></i> 5000</p>
							</div>
						</div>
						<div class="duration">
                            <div class="label">
                                <p>Duration</p>
                            </div>
                            <div class="value">
                                <p>45 Days</p>
                            </div>
                        </div>
                        <div class="duration">
                            <div class="label">
                                <p>Project Work</p>
                            </div>
                            <div class="value">
                                <p>210 Hours</p>
                            </div>
                        </div>
                        <!-- <div class="date">
                            <div class="label">
                                <p>Program Start Date</p>
                                <span>18/09/2021</span>
                            </div>
                            <div class="value">
                                <p>Enroll Before<br>15/09/2021</p>
                            </div>
                        </div> -->
						<div class="form-div">
							<input type="text" id="full_name" class="form-inputs" placeholder="Full Name*">
							<span class="error" id="error_full_name"></span>
						</div>
						<div class="form-div">
							<input type="text" id="email" class="form-inputs" placeholder="Email*">
							<span class="error" id="error_email"></span>
						</div>
						<div class="form-div">
							<input type="text" id="contact_no" class="form-inputs" placeholder="Contact No*" onkeypress="return only_number(event)" maxlength="10">
							<span class="error" id="error_contact_no"></span>
						</div>
                        <div class="form-div">
                            <span id="message11"></span>
                        </div>
                        <div class="form-div">
                            <span class="spn-terms"><input type="checkbox" checked=""> I agree to the <a href="<?php echo base_url();?>terms-for-remote-internships/">Terms of Use & Privacy Policy </a> for this program.</span>
                        </div>
						<div class="enrollBtn">
						      <button id="payRazor" class="btn">Enrol Now</button>
						</div>
                        <div class="downloadBtn">
                          <a class="btn" href="javascript:void(0)" onclick="return download_brochure('<?php echo $course_name;?>','download brochure form')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> download brochure</a>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="benefitSection">
    <div class="container">
        <div class="benefitRow advantagerow">
            <h2><span>Industry Readiness Program </span> Advantages</h2>
            <ul>
                <li>
                    <img src="https://myonlineshiksha.com/public/uploads/1_2.png">
                    <span>Guaranteed Internship on trending topics, right from your home.</span>
                </li>
                <li>
                    <img src="https://myonlineshiksha.com/public/uploads/1_1.png">
                    <span>Online Course to prepare you for Job Interviews.</span>
                </li>
                <li>
                    <img src="https://myonlineshiksha.com/public/uploads/1_2.png">
                    <span>Graduates, Under-Graduates across various domains can add value to their resumes.</span>
                </li>
                <li>
                    <img src="https://myonlineshiksha.com/public/uploads/1_1.png">
                    <span>Get Two Certificate from TCS iON (A Tata Group Company) and MyOnlineShiksha (an Educron Education Portal)</span>
                </li>
                <li>
                    <img src="https://myonlineshiksha.com/public/uploads/1_2.png">
                    <span>Get 1 Credit point by TCS iON, which will also be taken into account in your future interviews, especially in Tata group companies.</span>
                </li>
            </ul>
        </div>
    </div>    
</section>
<section class="programHighlightSection programobjective_section">
    <div class="container">
      <div class="innerSection">
          <h2>Objectives</h2>
          <div class="row">
            <div class="col-sm-4">
              <div class="points">
                <img src="<?php echo base_url();?>public/uploads/Ielts Online Preparation-13.png">
                <p>Offering you a globally respected Internship from the comforts of your home.</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="points">
                <img src="<?php echo base_url();?>public/uploads/Ielts Online Preparation-12.png">
                <p>To provide end-to-end solution to help you prepare for a career.</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="points">
                <img src="<?php echo base_url();?>public/uploads/Ielts Online Preparation-11.png">
                <p>To test your knowledge and kickstart a Career.</p>
              </div>
            </div>
          </div>
      </div>   
    </div>
  </section>
<section class="benefitSection">
	<div class="container">
		<div class="benefitRow">
			<h2><span>Program </span> Content</h2>
			<ul>
				<li>
					<img src="<?php echo base_url();?>public/uploads/1_2 (1).png">
					<span>IRP with TCS iON Remote Internships, a digital internship program, is designed to provide a large number of internship opportunities across various trending topics/domains. It facilitates “Internship Anytime, Anywhere”, where students can work at their comfort without any location constraints. The program complements the whole internship experience with enablers for collaborative learning with peers, connect with industry mentors and projects.</span>
				</li>
				<li>
					<img src="<?php echo base_url();?>public/uploads/1_1 (1).png">
					<span>Interview Techniques for Job Aspirants, a self-paced online course by well known Corporate Trainers.</span>
				</li>
				<li>
					<img src="<?php echo base_url();?>public/uploads/1_2 (1).png">
					<span>Complete Personality Development,  a self-paced online course from an experienced Mind Control Expert. </span>
				</li>
				<li>
					<img src="<?php echo base_url();?>public/uploads/1_1 (1).png">
					<span>Public Speaking, a self-paced online course to master public speaking.</span>
				</li>				
			</div>
		</div>
	</div>
</section>

<section class="curriculumSection">
  <div class="container">
    <div class="curriculumRow">
      <h3><span>Remote Internship </span> Features</h3>
      <div class="row">
        <div class="col-sm-8 curriculumRowText">
          <ul>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">No. of Days : </span> 45<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">No. of Hours : </span> 210<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Credits Earned : </span> 1<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Learning References : </span> Yes<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">No. of Hours in Industry Projects : </span> 15 (<a href="<?php echo base_url();?>public/uploads/IRP-Advanced-Projects.xls" target="_blank" download="" style="color: #14b04d;text-decoration: underline;">Check the List of the Projects</a>)<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Learning Resources : </span> Online Course: Interview Techniques for Jobs Aspirants<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Daily Activity and Project Reports : </span> Yes, a mentor will be allotted<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Daily Discussion Rooms :</span> Yes<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Tests and Viva : </span> Yes<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Access to Industry Mentor : </span> Yes<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Credits aligned to AICTE and UGC : </span> Yes<p></p>
            </li>
            <li><i class="fa fa-sort-up"></i> <span class="txtcnt">Certification : </span> Two Certificates by TCS iON & MyOnlineShiksha<p></p>
            </li>
          </ul>
        </div>
        <div class="col-sm-4 curriculumRowImage">
          <img src="https://digitalaicademy.com/public/uploads/section_images/images/Selenium-14.png">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="partnerSection">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="goalLeft">
                    <div class="item">
                        <h2>Career <br> <span>Opportunities</span></h2>
                        <ul>
                            <li><span>Change the way you apply for internship programmes.</span></li><br>
                            <li><span>Industry Readiness Program with TCS iON Remote Internships are the career-starter you can depend on. With relevant industry experience - graduates, post-graduates, students across various domains, even freshers can add value to their resumes from our wide variety of internship programmes. Our end-to-end upskilling solutions help you prepare, test and analyse your knowledge and kickstart a career from the comfort of your home. </span></li><br>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="goalRight">
                    <img src="<?php echo base_url();?>public/uploads/TCS ION SECOND PAGE IMAGE 2.png">
                </div>
            </div>
        </div>   
    </div>
</section>

<section class="certificateSection">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="certificateImage">
                    <img src="<?php echo base_url();?>public/uploads/TCS ION SECOND PAGE IMAGE.png">
                </div>
            </div>
            <div class="col-md-5">
                <div class="certificateText">
                    <h2><span>Why </span>Industry Readiness Program <span> with TCS iON Remote Internships? </span> </h2>
                    <p>IRP with TCS iON is one of the largest online platforms for students with the TCS iON Digital Learning Hub offering a wide range of courses, assessments, and events.</p>
                    <p>IRP with TCS iON Digital Learning Hub also hosts digital discussion rooms designed for students to collaborate, share knowledge, participate in activities like quizzes and provide feedback.</p>
                    <p>IRP with TCS iON offers end-to-end support in upskilling self-learners right from K-12 to working professionals.</p>
                </div>
            </div>
        </div>   
    </div>
</section>

<?php $this->load->view('new_template_design/footer');
	$description        = "Product Description";
	$txnid              = date("ymdHis");
    $key                = $this->config->item('keyId');
	$currency_code      = "INR";            
	$total              = intval(5000) * 100; // 100 = 1 indian rupees
	$amount             = 5000;
	$merchant_order_id  = "TXN-".$txnid;
	$name               = "MYOnlineShiksha";
	$callback_url       = base_url().'welcome/callback';
	$surl               = base_url().'welcome/razor_success';
	$furl               = base_url().'welcome/razor_failed';
    $this->session->set_userdata('lasturl',$this->uri->segment(1));
    $this->session->set_userdata('page','advanced');
?>

<!-- razorpay form starts here -->
<form name="razorpay-form" id="razorpay-form" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value=""/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
  <input type="hidden" name="currency_code" id="currency_code" value="<?php echo $currency_code; ?>"/>
  <input type="hidden" name="card_holder_email" id="card_holder_email" value=""/>
  <input type="hidden" name="card_holder_contact" id="card_holder_contact" value=""/>
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
var razorpay_pay_btn, instance;
$(document).on('click', '#payRazor', function (e) {
	var full_name = $("#full_name").val().trim();
    var email = $("#email").val().trim().toLowerCase();
    var email_pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
    var contact_no = $("#contact_no").val().trim();
    if(full_name == ''){
        $("#error_full_name").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Enter Full Name.");
        setTimeout(function(){ $("#error_full_name").html(""); },2000);
        $("#full_name").focus();
        return false;
    }
    if(email == ''){
        $("#error_email").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Enter Email.");
        setTimeout(function(){ $("#error_email").html(""); },2000);
        $("#email").focus();
        return false;
    }
    if(!email_pattern.test(email)){
        $("#error_email").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Invalid Email");
        setTimeout(function(){ $("#error_email").html(""); },2000);
        $("#email").focus();
        return false;
    }
    if(contact_no == ''){
        $("#error_contact_no").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Enter Contact No.");
        setTimeout(function(){ $("#error_contact_no").html(""); },2000);
        $("#contact_no").focus();
        return false;
    }
    if(contact_no.length < 10){
        $("#error_contact_no").fadeIn().html("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Invalid Contact No.");
        setTimeout(function(){ $("#error_contact_no").html(""); },2000);
        $("#contact_no").focus();
        return false;
    }

    var course_name = '<?php echo $course_name;?>';
    var form_name = 'Payment Process Page';
    var enq_city = null;
    var enq_country = null;
    var enq_state = null;
    var enq_subject = null;
    $.ajax({
        type : "post",
        cache : false,
        url : "<?php echo base_url();?>welcome/make_inquiry/",
        data : {course_name : course_name , enq_name : full_name , enq_email : email , enq_contact_no : contact_no , enq_city : enq_city , enq_country : enq_country , enq_state : enq_state , enq_subject : enq_subject , form_name : form_name },
        success: function(res){
        }
    });

    
    $('#card_holder_name_id').val(full_name);
    $('#card_holder_email').val(email);
    $('#card_holder_contact').val(contact_no);
    $("#payRazor").html(' <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> ').removeAttr('onclick');
  	var merchant_order_id = jQuery('form#razorpay-form').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-form').find('input#merchant_surl_id').val();
    var merchant_furl_id = jQuery('form#razorpay-form').find('input#merchant_furl_id').val();
    var card_holder_name_id = jQuery('form#razorpay-form').find('input#card_holder_name_id').val();
    var merchant_total = jQuery('form#razorpay-form').find('input#merchant_total').val();
    var merchant_amount = jQuery('form#razorpay-form').find('input#merchant_amount').val();
    var currency_code = jQuery('form#razorpay-form').find('input#currency_code').val();    
    var card_holder_email = jQuery('form#razorpay-form').find('input#card_holder_email').val();    
    var card_holder_contact = jQuery('form#razorpay-form').find('input#card_holder_contact').val();    
    var course_name = 'TCSiON Industry Readiness Program Advanced'; 
    
    var options = {
        // key:            "rzp_test_6MFfxqebE6WWyY",
        key:            "<?php echo $key;?>",
        amount:         merchant_total,
        name:           "<?php echo $name;?>",
        description:    merchant_order_id,
        netbanking:     true,
        currency:       currency_code, // INR
        image:          '<?php echo base_url();?>public/uploads/settings/img/logo/4937_02-12-2019.png',
        prefill: {
            name:       card_holder_name_id,
            email:      card_holder_email,
            contact:    card_holder_contact
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
            $.ajax({
                url:'<?php echo $callback_url;?>',
                type: 'post',
                cache : false,
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code: currency_code, email : card_holder_email, contact_no : card_holder_contact,course_name : course_name},
                dataType: 'json',
                success: function (res){
                    $('#payRazor').html('Enrol Now');
                    if(res.msg){
                        $("#message11").html(res.msg).fadeIn("slow").removeAttr('class').addClass('message_err');
		                setTimeout(function(){
			                $("#message11").html('');
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
                                $("#full_name").val('');
                                $("#email").val('');
                                $("#contact_no").val('');
		                        console.log("<?php echo $this->session->userdata('lasturl');?>");
                                window.location.href = "<?php echo base_url();?>thank-you/";
		                    }
		                }
		            });
		        }
		    },
		    failure : function(res)
		    {
		      	$("#message11").html('ERROR : '+res).fadeIn("slow").removeAttr('class').addClass('message_err');
		    	setTimeout(function(){
		    		$("#message11").html('');
		        },2500);
		    }
		});
	},
    "modal": {
        "ondismiss": function(){
            // location.reload();
            $('#payRazor').html('Enrol Now');
            $("#full_name").val('');
            $("#email").val('');
            $("#contact_no").val('');
        }
    }
};
  instance = new Razorpay(options);
  instance.open();
    e.preventDefault();
  });
</script>
<script type="text/javascript">
function only_number(event) {
    var x = event.which || event.keyCode;
    console.log(x);
    if ((x >= 48) && (x <= 57) || x == 8 | x == 9 || x == 13) {
        return;
    } else {
        event.preventDefault();
    }
}
$('#contact_no').keyup(function(e){
    if (/\D/g.test(this.value))
    {
      	this.value = this.value.replace(/\D/g, '');
    }
});
</script>