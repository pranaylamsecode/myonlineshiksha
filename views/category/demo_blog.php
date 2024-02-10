<link rel="stylesheet" href="<?php echo base_url();?>public/css/template_load.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/icomoon@1.0.0/style.css">
<style type="text/css">
.leftcontent .col-md-12, .leftcontent .col-xs-12, .leftcontent .col-sm-12 {
  width: 100% !important;
  display: inline-block;
}
.leftcontent input, textarea {
  border: 1px solid #ccc !important; 
  color: #090909 !important;
}
.leftcontent textarea {
  height: 150px;
}
.contactmap
{
  height: 350px; 
  margin-bottom: 5% !important; 
  padding: 0;

}
.contactmap .information
{
  line-height: 150%; 
  color: #fff; 
  padding: 5px 10px 0 0;
  font-size:17px;
  word-break: break-all;
  word-wrap:  break-word;
}
.Contact.Us .row {
    padding: 0 !important;
    margin: 0;
}

.contactmap .information span
{
  font-weight: bold;
} 

.contactmap .main_cont_title
{
  margin: 13px 0 20px 0px;
  color: #fff;
  padding-bottom: 5px;
  font-size: 1.8em;
  font-weight: bold;
}
.actual_loct_map
{
  background-color: #fff; 
  height: 100%; 
  display: block; 
  overflow: hidden;
  margin: 0; 
  padding: 0; 
  float:right;
}
.btm-hed-cont {
  color: #626263;
  background: #f7f5f2;
  border: 1px solid #bbb;
  box-shadow: 0 1px rgba(0,0,0,0);
  padding: 14px 24px;
  font-size: 13px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 0.2em;
  border-radius: 5px;
  display: inline-block;
  line-height: 20px;
  text-align: center;
  position: relative;
  z-index: 2;
}

.botm_cont
{
  position: relative;
  text-align: center;
  display: block;
  margin-bottom: 2% !important;
}

.botm_cont hr {
  height: 3px;
  width: 100%;
  display: block;
  position: absolute;
  background-color: #bbb;
  top: 12%;
  left: 0;
  z-index: 1;
}
.contact_fom_body
{
  background: #fff;
  padding: 2%;
  display: inline-block;
}
.contact_fom_body form{
  width: 600px;
  display: inline-block;
  margin:0 auto;
}
.contact_fom_body .leftcontent {
  position: relative;
  margin: 0px auto;  
  min-height: 200px;
  z-index: 100;
  padding: 30px;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
}
.contact_fom_body .leftcontent:after {
  margin: 10px;
  position: absolute;
  content: " ";
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  z-index: -1;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
}
@media screen and (min-width: 1200px){
  .span12 {
    width: 1141px;
  }
  .span8 {
    width: 750px;
  }
  .span4 {
    width: 350px;
  }
}
@media screen and (max-width: 1200px)
{
  .row-fluid .span8 {
    float: right;
  }
}
@media screen and (max-width: 980px)
{
  .contactmap
  {
    float: none !important;
    height: 100%;
    margin-bottom: 5% !important;
    padding: 0;
  }
  .span4.first_com {
    float: none;
    padding: 20px;
  }
  .span8.actual_loct_map
  {
    float: none;
    padding: 0px;
    margin-top: 40px;
    margin-left: 0 !important;
    width: 100% !important;
  }
}
@media screen and (max-width: 768px)
{
  .first_com
  {
    padding: 30px 20px 50px 20px;
  }
  .contactmap {
    margin-bottom: 5% !important;
  }
  .contact_fom_body form{
  width: 100%;
  display: inline-block;
  margin:0 auto;
  }
  .leftcontent .col-md-12, .leftcontent .col-xs-12, .leftcontent .col-sm-12, .leftcontent .col-md-6, .contact_fom_body .leftcontent {
    padding: 0px;
  }
  #send {
    width: 130px;
    font-size: 18px;
    height: 45px;
  }
}
@media screen and (max-width: 480px)
{
  .contactmap {
    margin-bottom: 5% !important;
  }  
  .contact_fom_body .leftcontent
  {
    width: 100% !important;
    margin: 0 auto !important;
  }
  .first_com
  {
    padding: 30px 20px 30px 20px;
  }
}
@media (max-width: 382px){
  .contact_fom_body form textarea {
    border: 1px solid #ccc !important;
  }
}
input.form-height{
  height: 47px !important;
}
.form-height{
  height: 47px;
  border: 1px solid #ccc !important;
  border-radius: 0px !important;
}
.form-control{display:block;
  width:100%;
  padding:6px 12px;
  line-height:1.42857143;
  background-color: #fff;
}
.btn-primary_red{
      width: 165px;
      height: 45px;
      font-size: 18px;
  }

.close-layout-btn,.drag-layout-btn,.info-layout-btn,.preview,.remove,.element-drag-btn,.element-copy-btn,.element-warning-btn,select[name='Alignment']{
		display: none;
}
.ui-sortable{padding: 0px;}
@font-face{font-family:"proxima-nova-regular";src:url("https://mos.veerit.com/public/css/fonts/ProximaNova-Regular.ttf");}
@font-face{font-family:'Alegreya Sans Light';font-style:normal;font-weight:normal;src:local('Alegreya Sans Light'), url('https://www.createonlineacademy.com/fonts/AlegreyaSans-Light.woff') format('woff');}
@font-face{font-family:'icomoon';src: url('https://mos.veerit.com/public/css/fonts/icomoon.woff') format('woff'),     url('https://mos.veerit.com/public/css/fonts/IcoMoon-Free.ttf') format('truetype');font-weight:normal;font-style:normal;}
.box.box-element.ui-draggable{
	display: block !important;
}
.mock{
	display: none;
}
footer{
	border-top: 0px;
}
.features_btn p{
	display: inline-block;
}
.box, .coa-homepage-s2{
	background: white;
}
.fa-floppy-o{
	padding-right: 5px;
}
textarea:focus,textarea:active{
	-webkit-box-shadow: none;
	box-shadow: none;
}
</style>
<div class="preview_html">
<?php echo $content;
?>
</div>
<?php
if($this->uri->segment(3) == 1){
  $getpage = $this->Crud_model->get_single('mlms_pagecreater',"page_id = 1","settings");
  if($getpage->settings)
  {
    $settingarr=json_decode($getpage->settings);
    $address=$settingarr->address;
    $phone=$settingarr->phone;
    $email=$settingarr->email;
    $weburl=$settingarr->weburl;
    $mapcode=$settingarr->mapcode;
  }else{
    $address="";
    $phone="";
    $email="";
    $weburl="";
    $mapcode="";
  }
?>
<div style="padding: 30px 25%;">
  <div class="col-sm-6" style="width: 50%;">						
  	<div class="form-group">
    <input class="form-control form-height" type="text" placeholder="Name" id="ISContactForm_name" name="name" value="">
    <span class="error"></span>
  </div>
  </div>
  <div class="col-sm-6" style="width: 50%;">						
  	<div class="form-group ">
    <input class="form-control form-height" type="text" placeholder="E-mail" id="ISContactForm_email" name="email" value="">
    <span class="error"></span>
  </div>
  </div>
  <div class="col-sm-12">						
  	<div class="form-group">
    <input class="form-control form-height" type="text" placeholder="Subject" id="ISContactForm_subject" name="subject" maxlength="128" size="60" value="">
    <span class="error"></span> 
  </div>
  </div>
  <div class="col-sm-12">						
  	<div class="form-group">
    <textarea class="form-control form-height" id="ISContactForm_body" placeholder="Message" name="body" cols="30" rows="11"></textarea>
    <span class="error"></span>
    </div> 
  </div>
  <div class="text-right col-sm-12">
  	<div class="form-group">
    <button class="btn-primary_red" type="submit" name="send" id="send" value="send">SEND</button>    
    </div>                
  </div>
</div>

<div class="" style="padding:30px !important;">
  <div class="span12 contactmap top" style="margin-top: 3%;">
    <div class="span4 first_com">
      <h2 class="main_cont_title">Contact Us</h2>
      <p class="information">
        <span><span class="lnr lnr-map-marker"></span> ADDRESS: </span><?php echo $address;?>
      </p>
      <p class="information">
        <span><span class="lnr lnr-phone-handset"></span> TELEPHONE: </span> <?php echo $phone;?>    
      </p>
      <p class="information">
        <span><span class="lnr lnr-envelope"></span> E-MAIL: </span> <?php echo $email;?>    
      </p>
      <p class="information">
        <span><span class="lnr lnr-link"></span> WEB-URL: </span> <?php echo $weburl;?>          
      </p>
      <ul class="social-networks" style="padding: 0px 0 0 30px;">
        <li style="margin-right: 10px">
          <a href="#">
          <img alt="" src="https://alert2learn.createonlineacademy.com/public/images/google-plus-symbol.png">
          </a>
        </li>
        <li>
          <a href="#">
          <img alt="" src="https://alert2learn.createonlineacademy.com/public/images/facebook-logo.png">
          </a>
        </li>
      </ul>
      <p></p>
    </div>
    <div class="span8 actual_loct_map">
      <?php echo $mapcode;?>  
    </div>
  </div>
</div>
<?php }

$uri = $this->uri->segment(2);
if($uri == 'preview_template'){
if($edpage_id == 1){
?>
<div style="padding: 30px 25%;">
  <div class="col-sm-6" style="width: 50%;">						
  	<div class="form-group">
    <input class="form-control form-height" type="text" placeholder="Name" id="ISContactForm_name" name="name" value="">
    <span class="error"></span>
  </div>
  </div>
  <div class="col-sm-6" style="width: 50%;">						
  	<div class="form-group ">
    <input class="form-control form-height" type="text" placeholder="E-mail" id="ISContactForm_email" name="email" value="">
    <span class="error"></span>
  </div>
  </div>
  <div class="col-sm-12">						
  	<div class="form-group">
    <input class="form-control form-height" type="text" placeholder="Subject" id="ISContactForm_subject" name="subject" maxlength="128" size="60" value="">
    <span class="error"></span> 
  </div>
  </div>
  <div class="col-sm-12">						
  	<div class="form-group">
    <textarea class="form-control form-height" id="ISContactForm_body" placeholder="Message" name="body" cols="30" rows="11"></textarea>
    <span class="error"></span>
    </div> 
  </div>
  <div class="text-right col-sm-12">
  	<div class="form-group">
    <button class="btn-primary_red" type="submit" name="send" id="send" value="send">SEND</button>    
    </div>                
  </div>
</div>

<div class="" style="padding:30px !important;">
  <div class="span12 contactmap top" style="margin-top: 3%;">
    <div class="span4 first_com">
      <h2 class="main_cont_title">Contact Us</h2>
      <p class="information">
        <span><span class="lnr lnr-map-marker"></span> ADDRESS: </span><?php echo $address;?>
      </p>
      <p class="information">
        <span><span class="lnr lnr-phone-handset"></span> TELEPHONE: </span> <?php echo $phone;?>    
      </p>
      <p class="information">
        <span><span class="lnr lnr-envelope"></span> E-MAIL: </span> <?php echo $email;?>    
      </p>
      <p class="information">
        <span><span class="lnr lnr-link"></span> WEB-URL: </span> <?php echo $weburl;?>          
      </p>
      <ul class="social-networks" style="padding: 0px 0 0 30px;">
        <li style="margin-right: 10px">
          <a href="#">
          <img alt="" src="https://alert2learn.createonlineacademy.com/public/images/google-plus-symbol.png">
          </a>
        </li>
        <li>
          <a href="#">
          <img alt="" src="https://alert2learn.createonlineacademy.com/public/images/facebook-logo.png">
          </a>
        </li>
      </ul>
      <p></p>
    </div>
    <div class="span8 actual_loct_map">
      <?php echo $mapcode;?>   
    </div>
  </div>
</div>
<?php } ?>

<span id="message"></span>
<div class="sticky">
	<button class="btn btn-success" onclick="return update_page();"><i class="fa fa-floppy-o"></i> Save</button>
</div>
<style>
.sticky {
  position: fixed;
  bottom: 0;
  font-size: 20px;
  z-index: 1;
  left: 0;
  width: 100%;
  text-align: center;
  padding: 10px 0px;
  background-color: #373737;
}
.sticky .btn {
    background: #f16334;
    color: #fff;
    padding: 7px 25px;
    font-size: 16px;
}
.Preview.Template.Category {
    padding-bottom: 60px;
}
#message {
    position: fixed; 
/*    color: green;
*/    right: 0;
    float: right;
    clear: both;
    margin-right: 10px;
    font-size: 18px;
    top: 0;
    z-index: 10000;
}
</style>
<input type="hidden" id="edpage_id" value="<?php echo $edpage_id;?>">
<input type="hidden" id="current_uri" value="<?php echo $uri;?>">


<div class="modal fade" id="myModal" role="dialog" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body btn_modaldet">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	<div class="col-sm-12 form-group">
			  		<label>Text :</label>
			  		<input type="text" class="form-control form-height" id="btnText">
			  	</div>
			  	<div class="col-sm-12 form-group">
			  		<label>URL :</label>
			  		<input type="text" class="form-control form-height" id="btnUrl">
			  	</div>
			  	<div class="col-sm-12 form-group">
			  		<label><input type="checkbox" id="chk_newtab"> open link in new tab?</label>
			  	</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="a_id" value="">
			  	<button type="button" class="btn btn-default" id="btn_change">Update</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal_img" role="dialog" style="display: none;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body btn_modaldet">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	<div class="col-sm-12 form-group">
			  		<label>Image :</label>
			  		<input type="file" id="img_file">
			  	</div>			  	
			</div>
			<div class="modal-footer">
				<input type="hidden" id="img_id" value="">
			  	<button type="button" class="btn btn-default" id="btn_upload">Update</button>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<script type="text/javascript">
	$(".btn_modaldet button.close").on('click',function(){
		$('.modal').modal('hide');
	});
$("#btn_change").on('click',function(){
	var id = $("#a_id").val().trim();
	$("#"+id).text($("#btnText").val().trim());
	$("#"+id).attr('href',$("#btnUrl").val().trim());
	if($('#chk_newtab').prop('checked') == true){
		$("#"+id).attr('data-target','_blank');
	}else{
		$("#"+id).removeAttr('data-target');
	}
	$('#chk_newtab').removeAttr('checked');
	$("#myModal").modal('hide');
});
// code to change the text and link of button
	$(".lyrow a").on('click',function(){
		$(".btn_modaldet #btnText").val($(this).text());
		$(".btn_modaldet #btnUrl").val($(this).attr('href'));
		$("#a_id").val($(this).attr('id'));
		var datatarget = $(this).attr('data-target');
		if(datatarget == '_blank'){
			$("#chk_newtab").addClass('checked');
			$("input.checked").prop('checked',true);
		}else{
			$("#chk_newtab").removeAttr('checked');
		}
		$("#myModal").modal('show');
	});

// code to upload image
	$(".lyrow img").on('click',function(){
		$("#img_id").val($(this).attr('id'));
		$("#myModal_img").modal('show');
	});

$("#btn_upload").on('click',function(){
  
  var img_id = $("#img_id").val().trim();
  var img_file = $("#img_file")[0].files[0];
  var new_formdata= new FormData();
  new_formdata.append('upload_image',img_file);
  $("#btn_upload").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> wait...');
  var base_url = $("#base_url").val();
  $.ajax({
    type:"post",
    cache:false,
    contentType:false,
    processData:false,
    url:base_url + "admin/pagecreator/upload_blog_image/",
    data:new_formdata,
    success:function(returndata)
    {
      if(returndata != ''){
        $("#"+img_id).removeAttr('src').attr('src',returndata);
        $("#img_file").val('');
      }
      $("#btn_upload").html('Update');
      jQuery('#myModal_img').modal("hide");
    }
  });
});
		var im = 0;
		$(".center-image").each(function(){
			$(this).attr('id',"centerimage_"+im);
			im++;
		});
	function update_page(){
		$(".lyrow a").each(function(){
			var datatarget = $(this).attr('data-target');
			if(datatarget == '_blank'){
				$(this).attr('target',"_blank");
			}
		});


		// jQuery(".lyrow p, .lyrow h1, .lyrow h2, .lyrow h3, .lyrow h4, .lyrow h5, .lyrow h6, .lyrow ul").removeAttr('contenteditable');
		// jQuery(".lyrow a").removeAttr('contenteditable');
		var preview_html = $(".preview_html").html();
		var edpage_id = $("#edpage_id").val().trim();
		if(edpage_id != ''){
			$.ajax({
				type :"post",
				url : "<?php echo base_url();?>category/update_page",
				cache : false,
				data : {preview_html : preview_html, edpage_id : edpage_id},
				success : function(data){
					$(".lyrow a").removeAttr('target');
					var str = '<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times" aria-hidden="true"></i></a><strong class="fa fa-check" aria-hidden="true"></strong> Successfully updated the page. </div>';
					$('#message').html(str);
			        $('#message').show();
			        setTimeout(function(){$("#message").html('');},2000);
			        jQuery(".lyrow p, .lyrow h1, .lyrow h2, .lyrow h3, .lyrow h4, .lyrow h5, .lyrow h6, .lyrow ul").attr('contenteditable',true);
					jQuery(".lyrow a").attr('contenteditable',true);
				}
			});
		}
	}

	$(document).ready(function(){
		var i = 0;
		$("a").each(function(){
			$(this).attr('id',$(this).attr('id')+i);
			i++;
		});
		$(".lyrow p").each(function(){ 
			// $(this).removeAttr('onclick');
		   /*	if($(this).html().trim() == '' || $(this).html().trim() == ' ')
		   		$(this).remove();*/
		});
		$("div").each(function(){ 
			// $(this).removeAttr('onclick');
		});
	});
	
	jQuery(".lyrow p, .lyrow h1, .lyrow h2, .lyrow h3, .lyrow h4, .lyrow h5, .lyrow h6, .lyrow ul").attr('contenteditable','true');
	jQuery('nav a, .top a').removeAttr('href');
	jQuery('.top li').removeAttr('onclick');
	jQuery(".lyrow a").parent().removeAttr('contenteditable');
	jQuery(".lyrow a").attr('contenteditable',true);
	jQuery("form[name='search_box']").removeAttr('action method');
	jQuery("form[name='search_box']").find('button').remove();
	jQuery("p#headtop2").append('<button type="button" class="btn btn-lg btn-icon"><span class="lnr lnr-magnifier"></span></button>');
</script>
<?php }else{
	$social = $this->Crud_model->get_single('mlms_config',"social_icon = 1","socialbuttons,social_icon");
	$social_icon = json_decode($social->socialbuttons);
?>

<div class="icons-bar">
  <a href="<?php echo $social_icon[0]->siteurl;?>" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="<?php echo $social_icon[1]->siteurl;?>" class="twitter"><i class="fa fa-twitter"></i></a> 
  <!-- <a href="#" class="google"><i class="fa fa-google"></i></a>  -->
  <a href="<?php echo $social_icon[2]->siteurl;?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
  <a href="<?php echo $social_icon[3]->siteurl;?>" class="youtube"><i class="fa fa-youtube"></i></a> 
</div>
<script type="text/javascript">
	$(document).ready(function(){
		jQuery(".lyrow p, .lyrow h1, .lyrow h2, .lyrow h3, .lyrow h4, .lyrow h5, .lyrow h6, .lyrow ul").removeAttr('contenteditable');
		jQuery(".lyrow a").removeAttr('contenteditable');
		$("p").each(function(){ 
			$(this).removeAttr('onclick');
		});
		$("div").each(function(){ 
			$(this).removeAttr('onclick');
		});
	});
</script>
<?php } ?>